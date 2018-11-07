<?php
namespace GpsNose\SDK\Mashup\Api\Modules;

use GpsNose\SDK\Mashup\Model\GnResponseType;

/**
 * Used for managing your mashups.
 * You can register the mashup, verify it, regenerate its app-key, add/del sub-communities etc.
 */
class GnMashupTokensApi extends GnApiModuleBase
{

    /**
     * GnAdminApi __construct
     *
     * @param GnLoginApiBase $api
     * @param string $loginId
     */
    public function __construct(GnLoginApiBase $loginApi)
    {
        parent::__construct($loginApi);
    }

    /**
     * Generates a user-scannable QR-token.
     * The QR-token contains encrypted token-data, which when scanned, are save to the GpsNose platform.
     * The mashup site then can read all the scanned user-tokens back, to get who/where/when/what was scanned.
     *
     * @param string $payload
     *            Any custom data, which can be read-in as scanned-tokens by the mashup-site.
     * @param int $validToTicks
     *            Until when is the token valid; default=0: forever
     * @return mixed The QR-image
     */
    public function GenerateQrTokenForMashup(string $payload, int $validToTicks = 0)
    {
        $buf = $this->ExecuteCall("GenerateQrTokenForMashup", (object) [
            "payload" => $payload,
            "validToTicks" => $validToTicks
        ], GnResponseType::Json, false, 24 * 60 * 60);

        return $buf;
    }

    /**
     * Get a page of user-scanned QR-tokens, from the oldest already read toward the newer ones.
     *
     * @param string $tag
     *            The main- or sub-community tag for the tokens coming from. Default: the main community.
     * @param int $lastKnownScanTicks
     *            The last (oldest) already known scanned token.
     * @param int $pageSize
     *            How many tokens to return in one page. Default is max: 50
     * @return \GpsNose\SDK\Mashup\Model\GnLogin|\GpsNose\SDK\Mashup\Model\GnCommunity|\GpsNose\SDK\Mashup\Model\GnComment|array
     */
    public function GetMashupTokensPage(string $tag, int $lastKnownScanTicks, int $pageSize = 50)
    {
        $tokens = $this->ExecuteCall("GetMashupTokensPage", (object) [
            "tag" => $tag,
            "lastKnownScanTicks" => $lastKnownScanTicks,
            "pageSize" => $pageSize
        ], GnResponseType::ListGnMashupToken);

        return $tokens;
    }
}