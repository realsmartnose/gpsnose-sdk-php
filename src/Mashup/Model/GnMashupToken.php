<?php

namespace GpsNose\SDK\Mashup\Model;

use GpsNose\SDK\Mashup\Framework\GnUtil;

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
            $this->Payload = GnUtil::GetSaveProperty($json, "Payload");
            $this->ScannedByLoginName = GnUtil::GetSaveProperty($json, "ScannedByLoginName");
            $this->ScannedTicks = GnUtil::GetSaveProperty($json, "ScannedTicks");
            $this->RecordedTicks = GnUtil::GetSaveProperty($json, "RecordedTicks");
            $this->ScannedLatitude = GnUtil::GetSaveProperty($json, "ScannedLatitude") + 0;
            $this->ScannedLongitude = GnUtil::GetSaveProperty($json, "ScannedLongitude") + 0;
            $this->CallbackResponseHttpCode = GnUtil::GetSaveProperty($json, "CallbackResponseHttpCode") + 0;
            $this->CallbackResponseMessage = GnUtil::GetSaveProperty($json, "CallbackResponseMessage");
            $this->IsBatchCompleted = strtolower(GnUtil::GetSaveProperty($json, "IsBatchCompleted")) == "true";
            $this->Amount = GnUtil::GetSaveProperty($json, "Amount") + 0;
            $this->Comment = GnUtil::GetSaveProperty($json, "Comment");
            $this->IsGpsSharingWanted = strtolower(GnUtil::GetSaveProperty($json, "IsGpsSharingWanted")) == "true";
            $this->ValuePerUnit = GnUtil::GetSaveProperty($json, "ValuePerUnit") + 0;
            $this->Label = GnUtil::GetSaveProperty($json, "Label");
            $this->ValidUntilTicks = GnUtil::GetSaveProperty($json, "ValidUntilTicks");
            $this->CreationTicks = GnUtil::GetSaveProperty($json, "CreationTicks");
            $this->CreatedByLoginName = GnUtil::GetSaveProperty($json, "CreatedByLoginName");
            $this->BatchCreationTicks = GnUtil::GetSaveProperty($json, "BatchCreationTicks");
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
