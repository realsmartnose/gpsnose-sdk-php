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
            $this->IsBatchCompleted = strtolower($json->{"IsBatchCompleted"}) == "true";
            $this->Amount = $json->{"Amount"} + 0;
            $this->Comment = $json->{"Comment"};
            $this->IsGpsSharingWanted = strtolower($json->{"IsGpsSharingWanted"}) == "true";
            $this->ValuePerUnit = $json->{"ValuePerUnit"} + 0;
            $this->Label = $json->{"Label"};
            $this->ValidUntilTicks = $json->{"ValidUntilTicks"};
            $this->CreationTicks = $json->{"CreationTicks"};
            $this->CreatedByLoginName = $json->{"CreatedByLoginName"};
            $this->BatchCreationTicks = $json->{"BatchCreationTicks"};
        }
    }

    /**
     * @var string
     */
    public $Payload = "";

    /**
     * @var string
     */
    public $ScannedByLoginName = "";

    /**
     * @var string
     */
    public $ScannedTicks = "0";

    /**
     * @var string
     */
    public $RecordedTicks = "0";

    /**
     * @var float
     */
    public $ScannedLatitude = 0.0;

    /**
     * @var float
     */
    public $ScannedLongitude = 0.0;

    /**
     * @var int
     */
    public $CallbackResponseHttpCode = 0;

    /**
     * @var string
     */
    public $CallbackResponseMessage = "";

    /**
     * @var bool
     */
    public $IsBatchCompleted = false;

    /**
     * @var int
     */
    public $Amount = 0;

    /**
     * @var string
     */
    public $Comment = "";

    /**
     * @var bool
     */
    public $IsGpsSharingWanted = false;

    /**
     * @var float
     */
    public $ValuePerUnit = 0.0;

    /**
     * @var string
     */
    public $Label = "";

    /**
     * @var string
     */
    public $ValidUntilTicks = "0";

    /**
     * @var string
     */
    public $CreationTicks = "0";

    /**
     * @var string
     */
    public $CreatedByLoginName = "0";

    /**
     * @var string
     */
    public $BatchCreationTicks = "0";
}
