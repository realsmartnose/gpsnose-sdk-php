<?php
namespace GpsNose\SDK\Mashup\Framework;

/**
 * Holds a lat/lon point on the map.
 *
 * @author jurgenfurrer
 */
class GnMapPoint
{
    /**
     * GnMapPoint __construct
     *
     * @param object $json
     */
    public function __construct($json = NULL)
    {
        if ($json != NULL) {
            $this->Latitude = $json->{"Latitude"} + 0;
            $this->Longitude = $json->{"Longitude"} + 0;
        }
    }

    /**
     *
     * @var float
     */
    public $Latitude = 0.0;

    /**
     *
     * @var float
     */
    public $Longitude = 0.0;
}
