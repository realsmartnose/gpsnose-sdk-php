<?php

namespace GpsNose\SDK\Mashup\Model;

use GpsNose\SDK\Mashup\Framework\GnUtil;

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
            $this->LoginName = GnUtil::GetSaveProperty($json, "LoginName");
            $this->IsActivated = GnUtil::GetSaveProperty($json, "IsActivated");
            $this->FullName = GnUtil::GetSaveProperty($json, "FullName");
            $this->Communities = GnUtil::GetSaveProperty($json, "Communities") ?: [];
            $this->Email = GnUtil::GetSaveProperty($json, "Email");
            $this->IsSafeMode = GnUtil::GetSaveProperty($json, "IsSafeMode");
            $this->Latitude = floatval(GnUtil::GetSaveProperty($json, "Latitude"));
            $this->Longitude = floatval(GnUtil::GetSaveProperty($json, "Longitude"));
        }
    }

    /**
     * @var string
     */
    public $LoginName = "";

    /**
     * @var bool
     */
    public $IsActivated = false;

    /**
     * @var string
     */
    public $FullName = "";

    /**
     * @var array
     */
    public $Communities = [];

    /**
     * @var string
     */
    public $Email = "";

    /**
     * @var bool
     */
    public $IsSafeMode = false;

    /**
     * @var float
     */
    public $Latitude = 0.0;

    /**
     * @var float
     */
    public $Longitude = 0.0;
}
