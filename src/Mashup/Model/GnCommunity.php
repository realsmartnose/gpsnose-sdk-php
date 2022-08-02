<?php

namespace GpsNose\SDK\Mashup\Model;

use GpsNose\SDK\Mashup\Framework\GnUtil;

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
            $this->CreationUtcTicks = GnUtil::GetSaveProperty($json, "CreationUtcTicks");
            $this->CreatorLoginName = GnUtil::GetSaveProperty($json, "CreatorLoginName");
            $this->MembersCount = GnUtil::GetSaveProperty($json, "MembersCount") + 0;
            $this->Description = GnUtil::GetSaveProperty($json, "Description");
            $this->AclsInt = GnUtil::GetSaveProperty($json, "AclsInt") + 0;
            $this->Admins = GnUtil::GetSaveProperty($json, "Admins") ?: [];
        }
    }

    /**
     * @var string
     */
    public $CreationUtcTicks = "0";

    /**
     * @var string
     */
    public $CreatorLoginName = "";

    /**
     * @var int
     */
    public $MembersCount = 0;

    /**
     * @var string
     */
    public $Description = "";

    /**
     * @var int
     */
    public $AclsInt = 0;

    /**
     * @var array
     */
    public $Admins = [];

    /**
     * @return bool
     */
    public function CanListMembers()
    {
        return ($this->AclsInt & GnCommunityAcl::ListMembers) == GnCommunityAcl::ListMembers;
    }

    /**
     * @return bool
     */
    public function CanMemberInviteMember()
    {
        return ($this->AclsInt & GnCommunityAcl::MembersInviteMembers) == GnCommunityAcl::MembersInviteMembers;
    }

    /**
     * @return bool
     */
    public function CanMemberComment()
    {
        return ($this->AclsInt & GnCommunityAcl::CommentsFromMembers) == GnCommunityAcl::CommentsFromMembers;
    }
}
