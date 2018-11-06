<?php
namespace GpsNose\SDK\Mashup\Model;

class GnMashupToken
{

    /**
     * GnMashupToken __construct
     *
     * @param object $json
     */
    public function __construct($json = null)
    {
        if ($json != null) {
            $this->Payload = $json->{"Payload"};
            $this->ScannedByLoginName = $json->{"ScannedByLoginName"};
            $this->ScannedTicks = $json->{"ScannedTicks"};
            $this->ScannedLatitude = $json->{"ScannedLatitude"} + 0;
            $this->ScannedLongitude = $json->{"ScannedLongitude"} + 0;
        }
    }

    /**
     *
     * @var string
     */
    public $Payload = "";

    /**
     *
     * @var string
     */
    public $ScannedByLoginName = "";

    /**
     *
     * @var string
     */
    public $ScannedTicks = "0";

    /**
     *
     * @var number
     */
    public $ScannedLatitude = 0.0;

    /**
     *
     * @var number
     */
    public $ScannedLongitude = 0.0;
}

