<?php

namespace GpsNose\SDK\Mashup\Model\CreatedEntities;

use GpsNose\SDK\Mashup\Framework\GnUtil;
use GpsNose\SDK\Mashup\Model\GnAroundBase;

class GnPoI extends GnAroundBase
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
            $this->Address = GnUtil::GetSaveProperty($json, "Address");
            $this->RatingCount = GnUtil::GetSaveProperty($json, "RatingCount") + 0;
            $this->RatingAvgPercent = GnUtil::GetSaveProperty($json, "RatingAvgPercent") + 0;
            $this->ChangedTicks = GnUtil::GetSaveProperty($json, "ChangedTicks");
        }
    }

    /**
     * @var string
     */
    public $Name = "";

    /**
     * @var string
     */
    public $Address = "";

    /**
     * @var int
     */
    public $RatingCount = 0;

    /**
     * @var int
     */
    public $RatingAvgPercent = 0;

    /**
     * @var string
     */
    public $ChangedTicks = "0";
}
