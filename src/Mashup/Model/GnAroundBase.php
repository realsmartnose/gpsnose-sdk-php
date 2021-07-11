<?php
namespace GpsNose\SDK\Mashup\Model;

class GnAroundBase
{
    /**
     * GnCreatedEntity __construct
     *
     * @param object $json
     */
    public function __construct($json = null)
    {
        if ($json != null) {
            $this->Creator = $json->{"Creator"};
            $this->CreationTicks = $json->{"CreationTicks"};
            $this->Keywords = $json->{"Keywords"};
            $this->Latitude = floatval($json->{"Latitude"} + 0);
            $this->Longitude = floatval($json->{"Longitude"} + 0);
            $this->Altitude = floatval($json->{"Altitude"} + 0);
            $this->DistanceMetersExact = $json->{"DistanceMetersExact"} + 0;
            $this->DistanceMetersObfuscated = $json->{"DistanceMetersObfuscated"} + 0;
        }
    }

    /**
     * @var string
     */
    public $Creator = "";

    /**
     * @var string
     */
    public $CreationTicks = "0";

    /**
     * @var string
     */
    public $Keywords = "";

    /**
     * @var float
     */
    public $Latitude = 0.0;

    /**
     * @var float
     */
    public $Longitude = 0.0;

    /**
     * @var float
     */
    public $Altitude = 0.0;

    /**
     * @var int
     */
    public $DistanceMetersExact = 0;

    /**
     * @var int
     */
    public $DistanceMetersObfuscated = 0;
}
