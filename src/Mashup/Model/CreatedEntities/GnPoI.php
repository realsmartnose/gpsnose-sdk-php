<?php
namespace GpsNose\SDK\Mashup\Model\CreatedEntities;

use GpsNose\SDK\Mashup\Model\GnAroundBase;

class GnPoI extends GnAroundBase
{
    /**
     * GnEvent __construct
     *
     * @param object $json
     */
    public function __construct($json = NULL)
    {
        parent::__construct($json);
        if ($json != NULL) {
            $this->Name = $json->{"Name"};
            $this->Address = $json->{"Address"};
            $this->RatingCount = $json->{"RatingCount"} + 0;
            $this->RatingAvgPercent = $json->{"RatingAvgPercent"} + 0;
            $this->ChangedTicks = $json->{"ChangedTicks"};
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
