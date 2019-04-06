<?php
namespace GpsNose\SDK\Mashup\Model\CreatedEntities;

use GpsNose\SDK\Mashup\Model\GnAroundBase;

class GnImpression extends GnAroundBase
{

    /**
     * GnImpression __construct
     *
     * @param object $json
     */
    public function __construct($json = NULL)
    {
        parent::__construct($json);
        if ($json != NULL) {
            $this->Text = $json->{"Text"};
            $this->Mood = $json->{"Mood"};
            $this->RatingAvgPercent = $json->{"RatingAvgPercent"} + 0;
            $this->RatingCount = $json->{"RatingCount"} + 0;
        }
    }

    /**
     *
     * @var string
     */
    public $Text = "";

    /**
     *
     * @var string
     */
    public $Mood = "";

    /**
     *
     * @var int
     */
    public $RatingAvgPercent = 0;

    /**
     *
     * @var int
     */
    public $RatingCount = 0;
}
