<?php

namespace GpsNose\SDK\Mashup\Model;

use GpsNose\SDK\Mashup\Framework\GnUtil;

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
            $this->Creator = GnUtil::GetSaveProperty($json, "Creator");
            $this->CreationTicks = GnUtil::GetSaveProperty($json, "CreationTicks");
            $this->Keywords = GnUtil::GetSaveProperty($json, "Keywords");
            $this->Latitude = floatval(GnUtil::GetSaveProperty($json, "Latitude") + 0);
            $this->Longitude = floatval(GnUtil::GetSaveProperty($json, "Longitude") + 0);
            $this->Altitude = floatval(GnUtil::GetSaveProperty($json, "Altitude") + 0);
            $this->DistanceMetersExact = GnUtil::GetSaveProperty($json, "DistanceMetersExact") + 0;
            $this->DistanceMetersObfuscated = GnUtil::GetSaveProperty($json, "DistanceMetersObfuscated") + 0;
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
