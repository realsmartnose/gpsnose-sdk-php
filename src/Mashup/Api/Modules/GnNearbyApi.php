<?php

namespace GpsNose\SDK\Mashup\Api\Modules;

use GpsNose\SDK\Mashup\Model\CreatedEntities\GnTrackType;
use GpsNose\SDK\Mashup\Model\GnResponseType;

/**
 * Provides access to the real-world data around your end-user, like impressions, Noses, PoIs, Tracks, Events etc.
 * All the API calls accepts an optional sub-community, or defaults to the one mapped to your app-key.
 * When an item has a picture, you can get it referring the corresponding URL address using the item's creation-key.
 */
class GnNearbyApi extends GnApiModuleBase
{
    /**
     * GnNearbyApi __construct
     *
     * @param GnLoginApiBase $loginApi
     */
    public function __construct(GnLoginApiBase $loginApi)
    {
        parent::__construct($loginApi);
    }

    /**
     * Return the Noses (other GpsNose users) around.
     *
     * @param string $community
     * @return array(\GpsNose\SDK\Mashup\Model\GnNose)
     */
    public function GetNosesAround(string $community = null)
    {
        $result = $this->ExecuteCall("GetNosesAround", (object)[
            "community" => $community
        ], GnResponseType::ListGnNose);

        return $result;
    }

    /**
     * Return the Impressions (texts or pictures) around.
     *
     * @param string $community
     * @return array(\GpsNose\SDK\Mashup\Model\GnImpression)
     */
    public function GetImpressionsAround(string $community = null)
    {
        $result = $this->ExecuteCall("GetImpressionsAround", (object)[
            "community" => $community
        ], GnResponseType::ListGnImpression);

        return $result;
    }

    /**
     * Return the PoIs (points of interesst) around.
     *
     * @param string $community
     * @return array(\GpsNose\SDK\Mashup\Model\GnPoI)
     */
    public function GetPoIsAround(string $community = null)
    {
        $result = $this->ExecuteCall("GetPoIsAround", (object)[
            "community" => $community
        ], GnResponseType::ListGnPoI);

        return $result;
    }

    /**
     * Return the Events (what is happing where, with voting for date, subscribing etc.) around.
     *
     * @param string $community
     * @return array(\GpsNose\SDK\Mashup\Model\GnEvent)
     */
    public function GetEventsAround(string $community = null)
    {
        $result = $this->ExecuteCall("GetEventsAround", (object)[
            "community" => $community
        ], GnResponseType::ListGnEvent);

        return $result;
    }

    /**
     * Return the Tracks around.
     *
     * @param string $community
     * @param int $trackType
     * @return array(\GpsNose\SDK\Mashup\Model\GnTrack)
     */
    public function GetTracksAround(string $community = null, int $trackType = GnTrackType::Unspecified)
    {
        $result = $this->ExecuteCall("GetTracksAround", (object)[
            "community" => $community,
            "trackType" => $trackType
        ], GnResponseType::ListGnTrack);

        return $result;
    }
}
