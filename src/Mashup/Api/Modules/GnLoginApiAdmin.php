<?php
namespace GpsNose\SDK\Mashup\Api\Modules;

use GpsNose\SDK\Mashup\Framework\GnException;
use GpsNose\SDK\Mashup\Api\GnApi;
use GpsNose\SDK\Mashup\Framework\GnSettings;
use GpsNose\SDK\Mashup\Model\GnMashupLoginAcl;

/**
 * The login-api for the admin-user.
 */
class GnLoginApiAdmin extends GnLoginApiBase
{
    /**
     * Generate the login QR-code for the admin-user.
     * This QrCode is useful for admin use-cases, when the target community is not known before (e.g. registering new mashups).
     * 
     * @param int $acls The ACLs defining which data you will get about the logged-in user.
     * @return array The QR-code image, which you must display to your user, to be scanned-in with his GpsNose mobile-app.
     */
    public function GenerateQrCode(int $acls = GnMashupLoginAcl::None)
    {
        $qrCode = parent::GenerateQrCodeInternal(GnSettings::GPSNOSE_COMMUNITY, TRUE, TRUE, $acls);

        return $qrCode;
    }

    /**
     * Gets the GnAdminApi for the admin user.
     * This GnLoginApi instance must be created using <see cref="GnApi.GetLoginApiForAdmin"/> to use this function.
     *
     * @throws GnException
     * @return \GpsNose\SDK\Mashup\Api\Modules\GnAdminApi
     */
    public function GetAdminApi()
    {
        $this->AssureLoggedInAlready();

        return new GnAdminApi($this);
    }

    /**
     * GnLoginApiAdmin __construct
     *
     * @param \GpsNose\SDK\Mashup\Api\GnApi $api
     * @param string $loginId
     * @param string $langId
     */
    public function __construct(GnApi $api, $loginId, $langId)
    {
        parent::__construct($api, NULL, $loginId, $langId);
    }
}
