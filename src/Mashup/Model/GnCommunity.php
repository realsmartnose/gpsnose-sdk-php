<?php
namespace GpsNose\SDK\Mashup\Model;

class GnCommunity
{

    /**
     * GnCommunity __construct
     *
     * @param object $json
     */
    public function __construct($json = null)
    {
        if ($json != null) {
            $this->CreationUtcTicks = $json->{"CreationUtcTicks"};
            $this->CreatorLoginName = $json->{"CreatorLoginName"};
            $this->MembersCount = $json->{"MembersCount"} + 0;
            $this->Description = $json->{"Description"};
            $this->AclsInt = $json->{"AclsInt"} + 0;
            $this->Admins = $json->{"Admins"} ?: [];
        }
    }

    /**
     *
     * @var string
     */
    public $CreationUtcTicks = "0";

    /**
     *
     * @var string
     */
    public $CreatorLoginName = "";

    /**
     *
     * @var int
     */
    public $MembersCount = 0;

    /**
     *
     * @var string
     */
    public $Description = "";

    /**
     *
     * @var int
     */
    public $AclsInt = 0;

    /**
     *
     * @var array
     */
    public $Admins = [];

    public function CanListMembers()
    {
        return ($this->AclsInt & GnCommunityAcl::ListMembers) == GnCommunityAcl::ListMembers;
    }

    public function CanMemberInviteMember()
    {
        return ($this->AclsInt & GnCommunityAcl::MembersInviteMembers) == GnCommunityAcl::MembersInviteMembers;
    }

    public function CanMemberComment()
    {
        return ($this->AclsInt & GnCommunityAcl::CommentsFromMembers) == GnCommunityAcl::CommentsFromMembers;
    }
}