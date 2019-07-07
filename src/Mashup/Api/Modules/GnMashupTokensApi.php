<?php
namespace GpsNose\SDK\Mashup\Api\Modules;

use GpsNose\SDK\Mashup\Model\GnMashupTokenOptions;
use GpsNose\SDK\Mashup\Model\GnResponseType;

/**
 * Use this API to generate and read the user-scanned QR-tokens for your mashup site.
 *
 * These QR-tokens are general-purpose, i.e. you generate a "token", which is an QR-code.
 * Such QR-code can be printed/sent somewhere, so your community-members can scan it.
 * Later, your website service pulls these tokens and get who/where/when/what was scanned.
 * Imagine any membership-workflows, geo-games, check-ins in the field etc.
 *
 * Notice: never give your app-key away, as it can be used for reading the scanned tokens.
 * The code-generation API call needs a valid user-login (so the later scanned-code has this creator-information),
 * but the reading service has no user-login when calling the API, only the app-key, when reading the scanned-tokens data.
 */
class GnMashupTokensApi extends GnApiModuleBase
{
    /**
     * GnAdminApi __construct
     *
     * @param GnLoginApiBase $loginApi
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
     * @param float $valuePerUnit
     *
     * @param string $label
     *
     * @param int $options
     *            App-options for the UI when scanning this token.
     * @return mixed The QR-image
     */
    public function GenerateQrTokenForMashup(string $payload, int $validToTicks = 0, float $valuePerUnit = 0.0, string $label = NULL, int $options = GnMashupTokenOptions::NoOptions)
    {
        $buf = $this->ExecuteCall("GenerateQrTokenForMashup", (object)[
            "payload" => $payload,
            "validToTicks" => $validToTicks,
            "valuePerUnit" => $valuePerUnit,
            "label" => $label,
            "options" => $options
        ], GnResponseType::Json, FALSE, 24 * 60 * 60);

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
     * @return array(\GpsNose\SDK\Mashup\Model\GnLogin|\GpsNose\SDK\Mashup\Model\GnMashupToken)
     */
    public function GetMashupTokensPage(string $tag, int $lastKnownScanTicks = 0, int $pageSize = 50)
    {
        $tokens = $this->ExecuteCall("GetMashupTokensPage", (object)[
            "tag" => $tag,
            "lastKnownScanTicks" => $lastKnownScanTicks,
            "pageSize" => $pageSize
        ], GnResponseType::ListGnMashupToken, FALSE, PHP_INT_MAX);

        return $tokens;
    }
}
