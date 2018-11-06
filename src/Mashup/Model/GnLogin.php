<?php
namespace GpsNose\SDK\Mashup\Model;

class GnLogin
{

    /**
     * GnLogin __construct
     *
     * @param object $json
     */
    public function __construct($json = null)
    {
        if ($json != null) {
            $this->LoginName = $json->{"LoginName"};
            $this->IsActivated = $json->{"IsActivated"};
            $this->FullName = $json->{"FullName"};
            $this->Communities = $json->{"Communities"} ?: [];
            $this->Email = $json->{"Email"};
            $this->IsSafeMode = $json->{"IsSafeMode"};
            $this->Latitude = floatval($json->{"Latitude"});
            $this->Longitude = floatval($json->{"Longitude"});
        }
    }

    /**
     *
     * @var string
     */
    public $LoginName = "";

    /**
     *
     * @var boolean
     */
    public $IsActivated = false;

    /**
     *
     * @var string
     */
    public $FullName = "";

    /**
     *
     * @var array
     */
    public $Communities = [];

    /**
     *
     * @var string
     */
    public $Email = "";

    /**
     *
     * @var boolean
     */
    public $IsSafeMode = false;

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