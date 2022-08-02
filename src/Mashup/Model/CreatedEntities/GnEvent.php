<?php

namespace GpsNose\SDK\Mashup\Model\CreatedEntities;

use GpsNose\SDK\Mashup\Framework\GnUtil;
use GpsNose\SDK\Mashup\Model\GnAroundBase;

class GnEvent extends GnAroundBase
{
    /**
     * GnEvent __construct
     *
     * @param object $json
     */
    public function __construct($json = null)
    {
        parent::__construct($json);
        if ($json != null) {
            $this->Name = GnUtil::GetSaveProperty($json, "Name");
            $this->PossibleUtcTicks = GnUtil::GetSaveProperty($json, "PossibleUtcTicks") ?: [];
            $this->ConfirmedUtcTicks = GnUtil::GetSaveProperty($json, "ConfirmedUtcTicks");
            $this->TimeZone = GnUtil::GetSaveProperty($json, "TimeZone");
        }
    }

    /**
     * @var string
     */
    public $Name = "";

    /**
     * @var array(int)
     */
    public $PossibleUtcTicks = [];

    /**
     * @var string
     */
    public $ConfirmedUtcTicks = "0";

    /**
     * @var string
     */
    public $TimeZone = "";
}
