<?php
namespace GpsNose\SDK\Mashup\Api\Modules;

use GpsNose\Framework\GnUtility;
use GpsNose\SDK\Framework\Logging\GnLogger;
use GpsNose\SDK\Mashup\Model\GnComment;
use GpsNose\SDK\Mashup\Model\GnResponseType;
use GpsNose\SDK\Mashup\Model\GnLogin;
use GpsNose\SDK\Mashup\Model\GnCommunity;
use GpsNose\SDK\Mashup\Model\GnMashup;
use GpsNose\SDK\Mashup\Model\GnNose;
use GpsNose\SDK\Mashup\Model\GnNews;
use GpsNose\SDK\Mashup\Model\GnMember;
use GpsNose\SDK\Mashup\Model\GnMashupStorageItem;
use GpsNose\SDK\Mashup\Model\CreatedEntities\GnImpression;
use GpsNose\SDK\Mashup\Model\CreatedEntities\GnPoI;
use GpsNose\SDK\Mashup\Model\CreatedEntities\GnEvent;
use GpsNose\SDK\Mashup\Model\CreatedEntities\GnTrack;
use GpsNose\SDK\Mashup\Framework\GnUtil;
use GpsNose\SDK\Mashup\Api\GnApi;
use GpsNose\SDK\Mashup\Framework\GnException;
use GpsNose\SDK\Framework\GnCache;
use GpsNose\SDK\Mashup\Model\GnMashupToken;
use GpsNose\SDK\Mashup\Model\GnMail;
use GpsNose\SDK\Mashup\Framework\GnMapRectangle;
use GpsNose\SDK\Mashup\GnPaths;

/**
 * Internal base-class for any concrete API module.
 */
abstract class GnApiModuleBase
{
    /**
     * @var int
     */
    private const QUOTA_WAIT_SECS_AFTER_EXCEEDED = 2;

    /**
     * @var int
     */
    private const QUOTA_MAX_CALLS = 3;

    /**
     * @var int
     */
    private const DEFAULT_CACHE_TTL_MINUTES = 15;

    /**
     * @var int
     */
    private $_quota_CallCounter = 0;

    /**
     * @var \DateTime
     */
    private $_quota_LastCall = null;

    /**
     * @var string
     */
    private $cacheGroup = "";

    /**
     * @var string
     */
    private $cacheKey = "";

    /**
     * @var GnLoginApiBase
     */
    private $_loginApi;

    /**
     * @return GnLoginApiBase
     */
    public function getLoginApi()
    {
        return $this->_loginApi;
    }

    /**
     * @var string
     */
    public $ControllerBasePath = "MashupApi";

    /**
     * GnApiModuleBase __construct
     *
     * @param GnLoginApiBase $loginApi
     */
    protected function __construct(GnLoginApiBase $loginApi = null)
    {
        if ($loginApi != null) {
            $this->_loginApi = $loginApi;
        } else {
            // notice: only GnLoginApi may call this constructor!
            $this->_loginApi = $this;
        }
    }

    /**
     * @param string $actionName
     */
    protected function ClearCacheForActionName(string $actionName)
    {
        $keyPattern = $this->GetCacheGroup($actionName);
        GnCache::Instance()->ClearCache($keyPattern);
    }

    /**
     * @param array $actionNames
     */
    protected function ClearCacheForActionNames(array $actionNames)
    {
        foreach ($actionNames as $actionName)
            $this->ClearCacheForActionName($actionName);
    }

    /**
     *
     */
    protected function ResetCachedResut()
    {
        GnCache::Instance()->ClearCache($this->cacheKey);
    }

    /**
     * @param string $actionName
     * @return string
     */
    protected function GetCacheGroup(string $actionName)
    {
        return "{$this->ControllerBasePath}/{$actionName}";;
    }

    /**
     * Call the server API with a response-type as a parameter.
     *
     * @param string $actionName
     * @param object $request
     * @param int $responseType
     * @param bool $ignoreNotFound
     * @param int $cacheTtl
     * @throws \GpsNose\SDK\Mashup\Framework\GnException
     * @return mixed
     */
    protected function ExecuteCall(string $actionName, $request, int $responseType = GnResponseType::Json, bool $ignoreNotFound = false, int $cacheTtl = 0, bool $isGet = false)
    {
        $this->HandleCallQuota();

        $url = GnApi::ApiRoot() . "/{$this->ControllerBasePath}/{$actionName}";

        if ($this->_loginApi) {
            $urlParams = [];
            // login needed?
            if ($this->_loginApi->getIsLoggedIn()) {
                $urlParams["lid"] = $this->_loginApi->getLoginId();
            }

            // ..language
            $urlParams["lang"] = $this->_loginApi->getLangId();
            $url = GnUtility::GetQueryStringFromKeyVals($url, $urlParams);

            // app-key needed?
            if (!GnUtil::IsNullOrEmpty($this->_loginApi->getAppKey())) {
                $request->appKey = $this->_loginApi->getAppKey();
            }
        }

        $reqJson = json_encode($request);
        if ($isGet) {
            $reqGet = http_build_query($request);
        }

        // setup cache
        $this->cacheGroup = $this->GetCacheGroup($actionName);
        if ($reqGet) {
            $url .= '&' . $reqGet;
            $this->cacheKey = "{$url}";
        } else {
            $this->cacheKey = "{$url}#{$reqJson}";
        }
        if ($cacheTtl == 0) {
            $cacheTtl = self::DEFAULT_CACHE_TTL_MINUTES * 60;
        } elseif ($cacheTtl == PHP_INT_MAX) {
            $cacheTtl = 0;
        }

        if (GnApi::$Debug) {
            GnLogger::Verbose("Request:" . $url . " | " . $actionName . " | " . $reqJson . " | " . $responseType);
        }

        // use cache|POST to read the result
        $resData = (string)GnCache::Instance()->GetCachedItem($this->cacheKey, $this->cacheGroup, $cacheTtl, function () use ($url, $reqJson, $reqGet) {
            $ch = curl_init($url);
            if (! $reqGet) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $reqJson);
            }
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type:application/json'
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);

            return $result;
        });

        if (strlen($resData) == 0) {
            $this->ResetCachedResut();
            return null;
        }

        $json = json_decode($resData);

        if ($json === null) {
            if (GnApi::$Debug) {
                GnLogger::Verbose("Response:" . $actionName . " | " . (ctype_print($resData) || substr($resData, 0, 1) === '<' ? $resData : "binary") . " | " . $responseType);
            }
            return $resData;
        } else {
            if (GnApi::$Debug) {
                GnLogger::Verbose("Response:" . $actionName . " | " . $resData . " | " . $responseType);
            }

            // ok or err?
            $errCode = $json->{"ErrorCode"} + 0;
            if ($errCode > 0) {
                $this->ResetCachedResut();

                $msg = $json->{"Message"};
                if (GnApi::$Debug) {
                    GnLogger::Error("GpsNose API error: {$msg}");
                }
                throw new GnException("GpsNose API error: {$msg}");
            }

            switch ($responseType) {

                case GnResponseType::Json:
                    return $json;

                case GnResponseType::Boolean:
                    return strtolower($resData) == 'true';

                case GnResponseType::Number:
                    return $resData + 0;

                case GnResponseType::String:
                    return $json;

                case GnResponseType::GnLogin:
                    return new GnLogin($json);

                case GnResponseType::GnCommunity:
                    return new GnCommunity($json);

                case GnResponseType::GnComment:
                    return new GnComment($json);

                case GnResponseType::GnMashupStorageItem:
                    return new GnMashupStorageItem($json);

                case GnResponseType::GnMapRectangle:
                    return new GnMapRectangle($json);

                case GnResponseType::ListGnMashup:
                    $mashups = array();
                    foreach ($json as $item) {
                        array_push($mashups, new GnMashup($item));
                    }
                    return $mashups;

                case GnResponseType::ListGnNose:
                    $noses = array();
                    foreach ($json as $item) {
                        array_push($noses, new GnNose($item));
                    }
                    return $noses;

                case GnResponseType::ListGnNews:
                    $news = array();
                    foreach ($json as $item) {
                        array_push($news, new GnNews($item));
                    }
                    return $news;

                case GnResponseType::ListGnMembers:
                    $members = array();
                    foreach ($json as $key => $val) {
                        array_push($members, new GnMember($key, $val));
                    }
                    return $members;

                case GnResponseType::ListGnImpression:
                    $impressions = array();
                    foreach ($json as $item) {
                        array_push($impressions, new GnImpression($item));
                    }
                    return $impressions;

                case GnResponseType::ListGnPoI:
                    $pois = array();
                    foreach ($json as $item) {
                        array_push($pois, new GnPoI($item));
                    }
                    return $pois;

                case GnResponseType::ListGnEvent:
                    $events = array();
                    foreach ($json as $item) {
                        array_push($events, new GnEvent($item));
                    }
                    return $events;

                case GnResponseType::ListGnTrack:
                    $tracks = array();
                    foreach ($json as $item) {
                        array_push($tracks, new GnTrack($item));
                    }
                    return $tracks;

                case GnResponseType::ListGnComment:
                    $comments = array();
                    foreach ($json as $item) {
                        array_push($comments, new GnComment($item));
                    }
                    return $comments;

                case GnResponseType::ListGnMashupToken:
                    $mashupTokens = array();
                    foreach ($json as $item) {
                        array_push($mashupTokens, new GnMashupToken($item));
                    }
                    return $mashupTokens;
                    break;

                case GnResponseType::ListGnMail:
                    $mails = array();
                    foreach ($json as $item) {
                        array_push($mails, new GnMail($item));
                    }
                    return $mails;
                    break;

                case GnResponseType::ListGnMashupStorageItem:
                    $mashupStorgeItems = array();
                    foreach ($json as $item) {
                        array_push($mashupStorgeItems, new GnMashupStorageItem($item));
                    }
                    return $mashupStorgeItems;
                    break;

                default:
                    echo $responseType;
                    die();
            }
        }
    }

    /**
     * To avoid unneeded traffic to the server, slow-down a bit.
     * Server checks this anyway, so to preserve the client's traffic, avoid excessive usage.
     */
    private function HandleCallQuota()
    {
        if ($this->_quota_LastCall == null) {
            $this->_quota_LastCall = new \DateTime();
            $this->_quota_LastCall->setTimestamp(0);
        }

        $now = new \DateTime();
        $secsFromLastCall = $now->getTimestamp() - $this->_quota_LastCall->getTimestamp();

        if ($secsFromLastCall > self::QUOTA_WAIT_SECS_AFTER_EXCEEDED) {
            // time-frame is ok
            $this->_quota_CallCounter = 0;
        } else {
            // time-frame too short
            $this->_quota_CallCounter++;
            if ($this->_quota_CallCounter >= self::QUOTA_MAX_CALLS) {
                // counter exceeded: wait a bit..
                sleep(self::QUOTA_WAIT_SECS_AFTER_EXCEEDED);
                $this->_quota_CallCounter = 0;
            }
        }

        $this->_quota_LastCall = new \DateTime("now");
    }

    /**
     * Call the server with a simple return-type in a named result-property.
     *
     * @param string $actionName
     * @param object $request
     * @param string $resultPropName
     * @param int $cacheTtl
     */
    protected function SimpleResultCall(string $actionName, $request, string $resultPropName, int $cacheTtl = 0)
    {
        $response = $this->ExecuteCall($actionName, $request, GnResponseType::Json, false, $cacheTtl);
        $result = $response->{$resultPropName};
        return $result;
    }

    /**
     * Call a server-url with params
     *
     * @param string $actionName
     * @param array $urlParams
     * @param int $cacheTtl
     * @return array(\GpsNose\SDK\Mashup\Model\GnNose)
     */
    protected function ExecuteGet(string $actionName, array $urlParams = [], int $cacheTtl = 0)
    {
        $url = GnPaths::HomeUrlSslNeeded() . "/{$this->ControllerBasePath}/{$actionName}";
        $cacheKey = "none";
        if (count($urlParams) > 0) {
            $url = GnUtility::GetQueryStringFromKeyVals($url, $urlParams);
            $cacheKey = json_encode($urlParams);
        }

        // setup cache
        $this->cacheGroup = $this->GetCacheGroup($actionName);
        $this->cacheKey = $cacheKey;
        if ($cacheTtl == 0) {
            $cacheTtl = self::DEFAULT_CACHE_TTL_MINUTES * 60;
        } elseif ($cacheTtl == PHP_INT_MAX) {
            $cacheTtl = 0;
        }

        if (GnApi::$Debug) {
            GnLogger::Verbose("Request:" . $url . " | " . $actionName);
        }

        // use cache|GET to read the result
        $resData = (string)GnCache::Instance()->GetCachedItem($this->cacheKey, $this->cacheGroup, $cacheTtl, function () use ($url) {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type:image/png'
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);

            return $result;
        });

        if (strlen($resData) == 0) {
            $this->ResetCachedResut();
            return null;
        }

        if (GnApi::$Debug) {
            GnLogger::Verbose("Response:" . $actionName . " | " . (ctype_print($resData) || substr($resData, 0, 1) === '<' ? $resData : "binary"));
        }

        return $resData;
    }
}
