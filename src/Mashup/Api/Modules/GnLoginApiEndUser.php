<?php
namespace GpsNose\SDK\Mashup\Api\Modules;

use GpsNose\SDK\Mashup\Framework\GnException;
use GpsNose\SDK\Mashup\Api\GnApi;
use GpsNose\SDK\Mashup\Model\GnMashupLoginAcl;

/**
 * The login-api for the end-user.
 */
class GnLoginApiEndUser extends GnLoginApiBase
{
    /**
     * Generate the login QR-code for the end-user.
     *
     * @param bool $mustJoin
     *            If the user must join the target community (it's the one belonging to your mashup's app-key)
     * @param bool $needsActivation
     *            If the user must be activated, i.e. his email is verified already.
     * @param int $acls
     *            The ACLs defining which data you will get about the logged-in user.
     * @return array(Byte) The QR-code image, which you must display to your user, to be scanned-in with his GpsNose mobile-app.
     */
    public function GenerateQrCode(bool $mustJoin = FALSE, bool $needsActivation = FALSE, int $acls = GnMashupLoginAcl::None)
    {
        $qrCode = parent::GenerateQrCodeInternal(NULL, $mustJoin, $needsActivation, $acls);

        return $qrCode;
    }

    /**
     * Gets the utilities related to mapping.
     *
     * @return \GpsNose\SDK\Mashup\Api\Modules\GnMappingApi
     */
    public function GetGnMappingApi()
    {
        return new GnMappingApi($this);
    }

    /**
     * Get the GnNewsApi for an end-user.
     * Not available for admin-user.
     *
     * @throws GnException
     * @return \GpsNose\SDK\Mashup\Api\Modules\GnNewsApi
     */
    public function GetNewsApi()
    {
        return new GnNewsApi($this);
    }

    /**
     * The the GnMailsApi for an end-user or the community-creator.
     *
     * When the calling user is not logged-in, the community-creator is assumed.
     * Be careful to first test, if you really want to get and use the community-creator's mails ;-)!
     *
     * @return \GpsNose\SDK\Mashup\Api\Modules\GnMailsApi
     */
    public function GetMailsApi()
    {
        return new GnMailsApi($this);
    }

    /**
     * Get the GnCommentsApi for an end-user.
     * Not available for admin-user.
     *
     * @throws GnException
     * @return \GpsNose\SDK\Mashup\Api\Modules\GnCommentsApi
     */
    public function GetCommentsApi()
    {
        return new GnCommentsApi($this);
    }

    /**
     * Get the GnNearbyApi for an end-user.
     * Not available for admin-user.
     *
     * @throws GnException
     * @return \GpsNose\SDK\Mashup\Api\Modules\GnNearbyApi
     */
    public function GetNearbyApi()
    {
        return new GnNearbyApi($this);
    }

    /**
     * Get the GnCommunityApi for an end-user.
     * Not available for admin-user.
     *
     * @throws GnException
     * @return \GpsNose\SDK\Mashup\Api\Modules\GnCommunityApi
     */
    public function GetCommunityApi()
    {
        return new GnCommunityApi($this);
    }

    /**
     * Get the GnStorageApi for an end-user.
     * The user must be logged-in.
     *
     * @return \GpsNose\SDK\Mashup\Api\Modules\GnStorageApi
     */
    public function GetStorageApi()
    {
        return new GnStorageApi($this);
    }

    /**
     * Get the GnMashupTokensApi for an end-user.
     * Be careful not to publish your app-key, as this API allows the end-user to read the scanned tokens!
     *
     * @throws GnException
     * @return \GpsNose\SDK\Mashup\Api\Modules\GnMashupTokensApi
     */
    public function GetMashupTokensApi()
    {
        return new GnMashupTokensApi($this);
    }

    /**
     * GnLoginApiEndUser __construct
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
