<?php
namespace GpsNose\SDK\Mashup\Api\Modules;

use GpsNose\SDK\Mashup\Model\GnResponseType;
use GpsNose\SDK\Mashup\Framework\GnSettings;

/**
 * Community functionality API.
 */
class GnCommunityApi extends GnApiModuleBase
{

    /**
     * GnCommunityApi __construct
     *
     * @param GnLoginApiBase $loginApi
     */
    public function __construct(GnLoginApiBase $loginApi)
    {
        parent::__construct($loginApi);
    }

    /**
     * Page through the members in the creational order.
     * The community's members-paging can be enabled/disabled in the mobile app: long press a community, go to edit details, disable members-paging.
     *
     * @param int $lastKnownTicks
     *            To start paging, leave out or set to current or future UTC. Later use the last-known ticks from the last page.
     * @param string $community
     *            Which sub/community to page through. Default: the main web-community.
     * @param int $pageSize
     *            Page size. Default 12, or [1..20].
     * @return array(\GpsNose\SDK\Mashup\Model\GnMember) Member names with their creation-ticks.
     */
    public function GetMembersPage(int $lastKnownTicks = GnSettings::FAR_FUTURE_TICKS, string $community = NULL, int $pageSize = NULL)
    {
        $result = $this->ExecuteCall("PageCommunityMembers", (object) [
            "community" => $community,
            "lastKnownTicks" => $lastKnownTicks,
            "pageSize" => $pageSize
        ], GnResponseType::ListGnMembers);

        return $result;
    }

    /**
     * Get the community details.
     *
     * @param string $community
     *            The sub/community; default is the main web-community, or can be a sub-community like %www.geohamster.com@honolulu
     * @return \GpsNose\SDK\Mashup\Model\GnCommunity The community details.
     */
    public function GetCommunity(string $community = NULL)
    {
        $result = $this->ExecuteCall("GetCommunity", (object) [
            "community" => $community
        ], GnResponseType::GnCommunity);

        return $result;
    }

    /**
     * @param string $community
     * @return mixed
     */
    public function GenerateQrCodeForCommunityJoin(string $community = NULL)
    {
        $buf = $this->ExecuteCall("GenerateQrCodeForCommunityJoin", (object) [
            "community" => $community
        ], GnResponseType::Json, FALSE, 24 * 60 * 60);

        return $buf;
    }

    /**
     * Sends a nose-mail invitation to a new community member.
     *
     * @param string $toLoginName
     *            To whom to send the invitation.
     * @param string $community
     *            Which community invite into; default is the main mashup community.
     */
    public function InviteMemberToCommunity(string $toLoginName, string $community = NULL)
    {
        $this->ExecuteCall("InviteMemberToCommunity", (object) [
            "community" => $community,
            "toLoginName" => $toLoginName
        ], GnResponseType::Json, FALSE, PHP_INT_MAX);
    }
}
