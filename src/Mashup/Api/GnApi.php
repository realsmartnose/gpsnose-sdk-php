<?php
namespace GpsNose\SDK\Mashup\Api;

use GpsNose\SDK\Mashup\GnPaths;
use GpsNose\SDK\Mashup\Framework\GnUtil;
use GpsNose\SDK\Mashup\Framework\GnSettings;

/**
 * The main GpsNose API entry point.
 * Can be reused once instantiated.
 * Use the GnLoginApi() to get the concrete use-case specific APIs.
 *
 * @example $api = new GnApi();
 *          $loginApi = $api->GetLoginApi("KEY");
 *          $newsApi = $loginApi->GetNewsApi();
 *          $news = $newsApi->GetNewsPage();
 */
class GnApi
{

    /**
     * If set, debug will be on
     *
     * @var boolean
     */
    public static $Debug = FALSE;

    /**
     * ApiRoot
     *
     * @return string
     */
    public static function ApiRoot()
    {
        return GnPaths::HomeUrlSslNeeded() . "/Mashup";
    }

    /**
     * Get the GnLoginApi used for mashup-admin calls.
     *
     * @param string $loginId If provided: any alphanumerical random string, at least 10 chars long.
     * @param string $langId The 2-letter lowercase ISO-code for language-specific API results
     * @return \GpsNose\SDK\Mashup\Api\Modules\GnLoginApi
     */
    public function GetLoginApiForAdmin(string $loginId = null, string $langId = null)
    {
        if (GnUtil::IsNullOrEmpty($langId)) {
            $langId = GnSettings::$CurrentLangId;
        }

        $loginApi = new Modules\GnLoginApi($this, null, $loginId, true, $langId);

        return $loginApi;
    }

    /**
     * The GnLoginApi used for end-user API calls.
     *
     * @param string $appKey The mashup's appKey
     * @param string $loginId If provided: any alphanumerical random string, at least 10 chars long.
     * @param string $langId  The 2-letter lowercase ISO-code for language-specific API results
     * @return \GpsNose\SDK\Mashup\Api\Modules\GnLoginApi
     */
    public function GetLoginApi(string $appKey = null, string $loginId = null, string $langId = null)
    {
        if (GnUtil::IsNullOrEmpty($langId)) {
            $langId = GnSettings::$CurrentLangId;
        }

        $loginApi = new Modules\GnLoginApi($this, $appKey, $loginId, false, $langId);

        return $loginApi;
    }
}