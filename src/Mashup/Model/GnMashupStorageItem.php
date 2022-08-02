<?php

namespace GpsNose\SDK\Mashup\Model;

use GpsNose\SDK\Mashup\Framework\GnUtil;

class GnMashupStorageItem
{
    /**
     * GnLogin __construct
     *
     * @param object $json
     */
    public function __construct($json = null)
    {
        if ($json != null) {
            $this->Key = GnUtil::GetSaveProperty($json, "Key");
            $this->Value = GnUtil::GetSaveProperty($json, "Value");
            $this->UpdatedTicks = GnUtil::GetSaveProperty($json, "UpdatedTicks");
        }
    }

    /**
     * @var string
     */
    public $Key = "";

    /**
     * @var string
     */
    public $Value = "";

    /**
     * @var string
     */
    public $UpdatedTicks = "0";
}
