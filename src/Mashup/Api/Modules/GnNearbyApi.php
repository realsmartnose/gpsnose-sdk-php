<?php
namespace GpsNose\SDK\Mashup\Api\Modules;

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
    public function GetNosesAround(string $community = NULL)
    {
        $result = $this->ExecuteCall("GetNosesAround", (object) [
            "community" => $community
        ], GnResponseType::ListGnNose, FALSE, PHP_INT_MAX);

        return $result;
    }

    /**
     * Return the Impressions (texts or pictures) around.
     *
     * @param string $community
     * @return array(\GpsNose\SDK\Mashup\Model\GnImpression)
     */
    public function GetImpressionsAround(string $community = NULL)
    {
        $result = $this->ExecuteCall("GetImpressionsAround", (object) [
            "community" => $community
        ], GnResponseType::ListGnImpression, FALSE, PHP_INT_MAX);

        return $result;
    }

    /**
     * Return the PoIs (points of interesst) around.
     *
     * @param string $community
     * @return array(\GpsNose\SDK\Mashup\Model\GnPoI)
     */
    public function GetPoIsAround(string $community = NULL)
    {
        $result = $this->ExecuteCall("GetPoIsAround", (object) [
            "community" => $community
        ], GnResponseType::ListGnPoI, FALSE, PHP_INT_MAX);

        return $result;
    }

    /**
     * Return the Events (what is happing where, with voting for date, subscribing etc.) around.
     *
     * @param string $community
     * @return array(\GpsNose\SDK\Mashup\Model\GnEvent)
     */
    public function GetEventsAround(string $community = NULL)
    {
        $result = $this->ExecuteCall("GetEventsAround", (object) [
            "community" => $community
        ], GnResponseType::ListGnEvent, FALSE, PHP_INT_MAX);

        return $result;
    }

    /**
     * Return the Tracks around.
     *
     * @param string $community
     * @return array(\GpsNose\SDK\Mashup\Model\GnTrack)
     */
    public function GetTracksAround(string $community = NULL)
    {
        $result = $this->ExecuteCall("GetTracksAround", (object) [
            "community" => $community
        ], GnResponseType::ListGnTrack, FALSE, PHP_INT_MAX);

        return $result;
    }
}
