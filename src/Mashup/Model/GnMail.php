<?php

namespace GpsNose\SDK\Mashup\Model;

use GpsNose\SDK\Mashup\Framework\GnUtil;

class GnMail
{
    /**
     * GnMail __construct
     *
     * @param object $json
     */
    public function __construct($json = null)
    {
        if ($json != null) {
            $this->CreationTicks = GnUtil::GetSaveProperty($json, "CreationTicks");
            $this->FromLoginName = GnUtil::GetSaveProperty($json, "FromLoginName");
            $this->Body = GnUtil::GetSaveProperty($json, "Body");
        }
    }

    /**
     * @var string
     */
    public $CreationTicks = "0";

    /**
     * @var string
     */
    public $FromLoginName = "";

    /**
     * @var string
     */
    public $Body = "";
}
