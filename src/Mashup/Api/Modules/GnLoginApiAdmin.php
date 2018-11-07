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
     *
     * @param \GpsNose\SDK\Mashup\Model\GnMashupLoginAcl $acls
     * @return array(Byte)
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
     * @param string $appKey
     * @param string $loginId
     * @param string $langId
     */
    public function __construct(GnApi $api, $appKey, $loginId, string $langId)
    {
        parent::__construct($api, $appKey, $loginId, $langId);
    }
}
