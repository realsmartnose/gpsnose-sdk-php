<?php
namespace GpsNose\SDK\Mashup\Model;

class GnMashupToken
{

    /**
     * GnMashupToken __construct
     *
     * @param object $json
     */
    public function __construct($json = null)
    {
        if ($json != null) {
            $this->Payload = $json->{"Payload"};
            $this->ScannedByLoginName = $json->{"ScannedByLoginName"};
            $this->ScannedTicks = $json->{"ScannedTicks"};
            $this->RecordedTicks = $json->{"RecordedTicks"};
            $this->ScannedLatitude = $json->{"ScannedLatitude"} + 0;
            $this->ScannedLongitude = $json->{"ScannedLongitude"} + 0;
            $this->CallbackResponseHttpCode = $json->{"CallbackResponseHttpCode"} + 0;
            $this->CallbackResponseMessage = $json->{"CallbackResponseMessage"};
            $this->IsBatchCompleted = boolval($json->{"IsBatchCompleted"});
            $this->Amount = $json->{"Amount"} + 0;
            $this->Comment = $json->{"Comment"};
            $this->IsGpsSharingWanted = boolval($json->{"IsGpsSharingWanted"});
        }
    }

    /**
     *
     * @var string
     */
    public $Payload = "";

    /**
     *
     * @var string
     */
    public $ScannedByLoginName = "";

    /**
     *
     * @var string
     */
    public $ScannedTicks = "0";

    /**
     *
     * @var string
     */
    public $RecordedTicks = "0";

    /**
     *
     * @var number
     */
    public $ScannedLatitude = 0.0;

    /**
     *
     * @var number
     */
    public $ScannedLongitude = 0.0;

    /**
     *
     * @var int
     */
    public $CallbackResponseHttpCode = 0;

    /**
     *
     * @var string
     */
    public $CallbackResponseMessage = "";

    /**
     *
     * @var boolean
     */
    public $IsBatchCompleted = FALSE;

    /**
     *
     * @var int
     */
    public $Amount = 0;

    /**
     *
     * @var string
     */
    public $Comment = "";

    /**
     *
     * @var boolean
     */
    public $IsGpsSharingWanted = FALSE;
}

