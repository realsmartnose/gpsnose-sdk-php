<?php

namespace GpsNose\SDK\Mashup\Model;

use GpsNose\SDK\Mashup\Framework\GnUtil;

class GnMashup
{
    /**
     * GnMashup __construct
     *
     * @param object $json
     */
    public function __construct($json = null)
    {
        if ($json != null) {
            $this->CommunityTag = GnUtil::GetSaveProperty($json, "CommunityTag");
            $this->ValidationKey = GnUtil::GetSaveProperty($json, "ValidationKey");
            $this->AppKey = GnUtil::GetSaveProperty($json, "AppKey");
            $this->ValidationTicks = GnUtil::GetSaveProperty($json, "ValidationTicks");
            $this->SubCommunities = GnUtil::GetSaveProperty($json, "SubCommunities") ?: [];
            $this->Hosts = GnUtil::GetSaveProperty($json, "Hosts") ?: [];
            $this->CallHistory = GnUtil::GetSaveProperty($json, "CallHistory") ?: [];
            $this->ExceededQuotaHistory = GnUtil::GetSaveProperty($json, "ExceededQuotaHistory") ?: [];
            $this->MaxCallsDaily = GnUtil::GetSaveProperty($json, "MaxCallsDaily") + 0;
            $this->MaxCallsMonthly = GnUtil::GetSaveProperty($json, "MaxCallsMonthly") + 0;
            $this->MaxSubSites = GnUtil::GetSaveProperty($json, "MaxSubSites") + 0;
            $this->MaxHosts = GnUtil::GetSaveProperty($json, "MaxHosts") + 0;
            $this->MashupTokenCallbackUrl = GnUtil::GetSaveProperty($json, "MashupTokenCallbackUrl");
        }
    }

    /**
     * @var string
     */
    public $CommunityTag = "";

    /**
     * @var string
     */
    public $ValidationKey = "";

    /**
     * @var string
     */
    public $AppKey = "";

    /**
     * @var string
     */
    public $ValidationTicks = "0";

    /**
     * @var array
     */
    public $SubCommunities = [];

    /**
     * @var array
     */
    public $Hosts = [];

    /**
     * @var array
     */
    public $CallHistory = [];

    /**
     * @var array
     */
    public $ExceededQuotaHistory = [];

    /**
     * @var int
     */
    public $MaxCallsDaily = 0;

    /**
     * @var int
     */
    public $MaxCallsMonthly = 0;

    /**
     * @var int
     */
    public $MaxSubSites = 0;

    /**
     * @var int
     */
    public $MaxHosts = 0;

    /**
     * @var string
     */
    public $MashupTokenCallbackUrl = "";
}
