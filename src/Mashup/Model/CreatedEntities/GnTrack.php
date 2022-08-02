<?php

namespace GpsNose\SDK\Mashup\Model\CreatedEntities;

use GpsNose\SDK\Mashup\Framework\GnUtil;
use GpsNose\SDK\Mashup\Model\GnAroundBase;

class GnTrack extends GnAroundBase
{
    /**
     * GnTrack __construct
     *
     * @param object $json
     */
    public function __construct($json = null)
    {
        parent::__construct($json);
        if ($json != null) {
            $this->Name = GnUtil::GetSaveProperty($json, "Name");
            $this->Description = GnUtil::GetSaveProperty($json, "Description");
            $this->TrackType = GnUtil::GetSaveProperty($json, "TrackType") + 0;
            $this->EndedUtcTicks = GnUtil::GetSaveProperty($json, "EndedUtcTicks");
            $this->RatingCount = GnUtil::GetSaveProperty($json, "RatingCount") + 0;
            $this->RatingAvgPercent = GnUtil::GetSaveProperty($json, "RatingAvgPercent") + 0;
        }
    }

    /**
     * @var string
     */
    public $Name = "";

    /**
     * @var string
     */
    public $Description = "";

    /**
     * @var int
     */
    public $TrackType = GnTrackType::Unspecified;

    /**
     * @var string
     */
    public $EndedUtcTicks = "0";

    /**
     * @var int
     */
    public $RatingCount = 0;

    /**
     * @var int
     */
    public $RatingAvgPercent = 0;
}
