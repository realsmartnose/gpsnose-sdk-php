<?php
namespace GpsNose\SDK\Mashup\Api\Modules;

use GpsNose\SDK\Mashup\Framework\GnException;
use GpsNose\SDK\Mashup\Api\GnApi;
use GpsNose\SDK\Mashup\Framework\GnUtil;
use GpsNose\SDK\Mashup\Framework\GnSettings;
use GpsNose\SDK\Mashup\Model\GnResponseType;
use GpsNose\SDK\Mashup\Model\GnMashupLoginAcl;

/**
 * The main entry point for all other use-case specific API modules.
 * The GnLoginApi instance is read by <see cref="GnApi.GetLoginApi"/> or <see cref="GnApi.GetLoginApiForAdmin"/>.
 * The GnLoginApi can be in a state logged-in/out (<see cref="IsLoggedIn"/>) and can be user/admin type (<see cref="IsMashupAdmin"/>).
 *
 * Some API calls can be called only as a mashup admin, some needs an end-user login and some can be called as an anonymous guest user.
 * The login can be used either once passively or fully GpsNose based actively:
 * 1. Passively
 * When your user logs-in once, you can take the <see cref="GnLogin.LoginName"/> for your own application specific user-management.
 * You don't need to check the <see cref="CheckIfIsStillLoggedId"/> or care about time-to-live etc.
 *
 * 2. Actively
 * You can fully rely on GpsNose user-management and don't store locally the available <see cref="GnLogin"/> data.
 * In such case, you have to make sure the loginId you use is valid throughout the login-session, calling <see cref="CheckIfIsStillLoggedId"/>.
 */
class GnLoginApiBase extends GnApiModuleBase
{
    /**
     * @var string
     */
    public $ControllerBasePath = "Login";

    /**
     * @var \GpsNose\SDK\Mashup\Api\GnApi
     */
    protected $_api;

    /**
     * @return \GpsNose\SDK\Mashup\Api\GnApi;
     */
    public function getApi()
    {
        return $this->_api;
    }

    /**
     *
     * @var string
     */
    protected $_appKey;

    /**
     * @return string;
     */
    public function getAppKey()
    {
        return $this->_appKey;
    }

    /**
     * Holds if this instance was already successfully logged-in or not yet (i.e.
     * guest).
     *
     * @var bool
     */
    protected $_isLoggedIn;

    /**
     * @return bool;
     */
    public function getIsLoggedIn()
    {
        return $this->_isLoggedIn;
    }

    /**
     * Whether the caller is a mashup-admin or not (i.e.
     * normal end-user).
     *
     * @var bool
     */
    public function IsMashupAdmin()
    {
        return $this instanceof GnLoginApiAdmin;
    }

    /**
     * The login-id denotes a concrete login-session.
     * If generated by the lib, it's GUID. Otherwise it's the
     *
     * @var string
     */
    protected $_loginId;

    public function getLoginId()
    {
        return $this->_loginId;
    }

    /**
     * The 2-letter lowercase language-id for language-specific server results.
     * Some API-calls results are language specific, like for example the items' keywords.
     *
     * @var string
     */
    protected $_langId;

    public function getLangId()
    {
        return $this->_langId;
    }

    /**
     * GnLoginApiBase __construct
     *
     * @param \GpsNose\SDK\Mashup\Api\GnApi $api
     * @param string $appKey
     * @param string $loginId
     * @param string $langId
     */
    public function __construct(GnApi $api, string $appKey = NULL, string $loginId = NULL, string $langId = NULL)
    {
        $this->_isLoggedIn = NULL;

        $this->_api = $api;
        $this->_appKey = $appKey;

        $this->_loginId = $loginId ?: GnUtil::NewGuid();

        // language must be supplied and will be only the 2-letter lowevercase ISO-code
        if (GnUtil::IsNullOrEmpty($langId) || strlen($langId) < 2) {
            throw new GnException("langId must be supplied");
        }

        $this->_langId = strtolower(substr($langId, 0, 2));

        parent::__construct($this);
    }

    /**
     * Makes sure this GnLoginApi is already logged-in.
     *
     * @throws \GpsNose\SDK\Mashup\Framework\GnException
     */
    public function AssureLoggedInAlready()
    {
        if ($this->_isLoggedIn == NULL) {
            $this->GetVerified();
        }

        if (!$this->_isLoggedIn) {
            throw new GnException("The loginId={$this->_loginId} is not yet logged-in");
        }
    }

    /**
     * Returns a QR-code image for logging in.
     *
     * @param string $community
     *            The target mashup community. For mashup-admin, it's the %www.gpsnose.com community.
     * @param bool $mustJoin
     *            If the user logging-in must first join the community.
     * @param bool $needsActivation
     *            If only activated users are allowed.
     * @param int $acls
     *            What additional params should be returned from the platform.
     * @return array
     *            Default only the user login-name, but additional params are possible by the ACLs.
     */
    protected function GenerateQrCodeInternal($community = GnSettings::GPSNOSE_COMMUNITY, bool $mustJoin = FALSE, bool $needsActivation = FALSE, int $acls = GnMashupLoginAcl::None)
    {
        if ($this->IsMashupAdmin()) {
            if ($community !== GnSettings::GPSNOSE_COMMUNITY) {
                throw new GnException("community for mashup-admin must be {GnSettings.GPSNOSE_COMMUNITY}");
            }
        } else {
            if ($community === GnSettings::GPSNOSE_COMMUNITY) {
                throw new GnException("community for mashup-admin must be not {GnSettings.GPSNOSE_COMMUNITY}");
            }
        }

        $res = $this->ExecuteCall("GenerateQrCode", (object)[
            "loginId" => $this->_loginId,
            "community" => strtolower(trim($community)),
            "activation" => $needsActivation,
            "mustJoin" => $mustJoin,
            "acls" => (string)((int)$acls)
        ]);

        return $res;
    }

    /**
     * Returns the login-verification data for this instance/loginId.
     * The data provided in GnLogin depends on which flags has been set in the generated QR-code when <see cref="GenerateQrCode"/> was called.
     *
     * @return \GpsNose\SDK\Mashup\Model\GnLogin
     */
    public function GetVerified()
    {
        // mark as already-called
        $this->_isLoggedIn = FALSE;

        $gnLoginResult = $this->ExecuteCall("GetVerified", (object)[
            "loginId" => $this->_loginId
        ], GnResponseType::GnLogin, FALSE, PHP_INT_MAX);

        if ($gnLoginResult != NULL && !GnUtil::IsNullOrEmpty($gnLoginResult->LoginName)) {
            $this->_isLoggedIn = TRUE;
        }

        return $gnLoginResult;
    }

    /**
     * Checks the logged-in state for this instance/loginId.
     * This call touches the sliding-expiration of the logged-in loginId.
     * The TTL is 30 minutes.
     * When you need to keep the logged-in state, you can call this once every 25 minutes or so.
     *
     * @return bool
     */
    public function CheckIfIsStillLoggedId()
    {
        $gnLoginResult = $this->ExecuteCall("IsStillLoggedIn", (object)[
            "loginId" => $this->_loginId
        ], GnResponseType::Boolean, FALSE, PHP_INT_MAX);

        return $gnLoginResult;
    }

    /**
     * Waits async for successful login in an own thread.
     * The successful login comes from scanning the generated QR-code (<see cref="GenerateQrCode"/>) by the mobile app.
     */
    public function WaitForLogin()
    {
        // TODO: Do we need this in PHP?
    }
}
