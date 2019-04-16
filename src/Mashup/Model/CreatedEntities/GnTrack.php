<?php
namespace GpsNose\SDK\Mashup\Model\CreatedEntities;

use GpsNose\SDK\Mashup\Model\GnAroundBase;

class GnTrack extends GnAroundBase
{
    /**
     * GnTrack __construct
     *
     * @param object $json
     */
    public function __construct($json = NULL)
    {
        parent::__construct($json);
        if ($json != NULL) {
            $this->Name = $json->{"Name"};
            $this->Description = $json->{"Description"};
            $this->TrackType = $json->{"TrackType"} + 0;
            $this->EndedUtcTicks = $json->{"EndedUtcTicks"};
            $this->RatingCount = $json->{"RatingCount"} + 0;
            $this->RatingAvgPercent = $json->{"RatingAvgPercent"} + 0;
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
