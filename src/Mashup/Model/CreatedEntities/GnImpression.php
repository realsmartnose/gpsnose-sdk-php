<?php

namespace GpsNose\SDK\Mashup\Model\CreatedEntities;

use GpsNose\SDK\Mashup\Framework\GnUtil;
use GpsNose\SDK\Mashup\Model\GnAroundBase;

class GnImpression extends GnAroundBase
{
    /**
     * GnImpression __construct
     *
     * @param object $json
     */
    public function __construct($json = null)
    {
        parent::__construct($json);
        if ($json != null) {
            $this->Text = GnUtil::GetSaveProperty($json, "Text");
            $this->Mood = GnUtil::GetSaveProperty($json, "Mood");
            $this->RatingAvgPercent = GnUtil::GetSaveProperty($json, "RatingAvgPercent") + 0;
            $this->RatingCount = GnUtil::GetSaveProperty($json, "RatingCount") + 0;
        }
    }

    /**
     * @var string
     */
    public $Text = "";

    /**
     * @var string
     */
    public $Mood = "";

    /**
     * @var int
     */
    public $RatingAvgPercent = 0;

    /**
     * @var int
     */
    public $RatingCount = 0;
}
