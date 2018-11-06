<?php
namespace GpsNose\SDK\Mashup\Model;

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
            $this->CommunityTag = $json->{"CommunityTag"};
            $this->ValidationKey = $json->{"ValidationKey"};
            $this->AppKey = $json->{"AppKey"};
            $this->ValidationTicks = $json->{"ValidationTicks"};
            $this->SubCommunities = $json->{"SubCommunities"} ?: [];
            $this->Hosts = $json->{"Hosts"} ?: [];
            $this->CallHistory = $json->{"CallHistory"} ?: [];
            $this->ExceededQuotaHistory = $json->{"ExceededQuotaHistory"} ?: [];
            $this->MaxCallsDaily = $json->{"MaxCallsDaily"} + 0;
            $this->MaxCallsMonthly = $json->{"MaxCallsMonthly"} + 0;
            $this->MaxSubSites = $json->{"MaxSubSites"} + 0;
            $this->MaxHosts = $json->{"MaxHosts"} + 0;
        }
    }

    /**
     *
     * @var string
     */
    public $CommunityTag = "";

    /**
     *
     * @var string
     */
    public $ValidationKey = "";

    /**
     *
     * @var string
     */
    public $AppKey = "";

    /**
     *
     * @var string
     */
    public $ValidationTicks = "0";

    /**
     *
     * @var array
     */
    public $SubCommunities = [];

    /**
     *
     * @var array
     */
    public $Hosts = [];

    /**
     *
     * @var array
     */
    public $CallHistory = [];

    /**
     *
     * @var array
     */
    public $ExceededQuotaHistory = [];

    /**
     *
     * @var int
     */
    public $MaxCallsDaily = 0;

    /**
     *
     * @var int
     */
    public $MaxCallsMonthly = 0;

    /**
     *
     * @var int
     */
    public $MaxSubSites = 0;

    /**
     *
     * @var int
     */
    public $MaxHosts = 0;
}

