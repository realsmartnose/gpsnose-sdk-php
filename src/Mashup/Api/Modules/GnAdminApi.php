<?php

namespace GpsNose\SDK\Mashup\Api\Modules;

use GpsNose\SDK\Mashup\Framework\GnUtil;
use GpsNose\SDK\Mashup\Model\GnResponseType;
use GpsNose\SDK\Mashup\Model\GnCommunityAcl;

/**
 * Used for managing your mashups.
 * You can register the mashup, verify it, regenerate its app-key, add/del sub-communities etc.
 */
class GnAdminApi extends GnApiModuleBase
{
    /**
     * @var string
     */
    public $ControllerBasePath = "MashupAdmin";

    /**
     * GnAdminApi __construct
     *
     * @param GnLoginApiAdmin $loginApi
     */
    public function __construct(GnLoginApiAdmin $loginApi)
    {
        parent::__construct($loginApi);
    }

    /**
     * Registers a new web-community.
     * Every web-community is in the form: %|@|*www.mydomain.com, where the prefix specifies the privacy level:
     * % = public mashup: anybody can join, anybody can read community data
     * @ = closed mashup: invitation needed for join, but anybody can read community data
     * * = private mashup: invitation needed for join, only members can read community data
     * Important: the mashup's privacy level can ONLY be set here and can't be changed later!
     *
     * @param string $tag
     *            The community's tag, prefixed with the privacy level.
     * @throws \InvalidArgumentException
     * @return string Validation key, which must be validated for the new web-community.
     */
    public function RegisterCommunityWeb(string $tag = null)
    {
        if (GnUtil::IsNullOrEmpty($tag)) {
            throw new \InvalidArgumentException("tag required");
        }

        $result = $this->SimpleResultCall("RegisterCommunityWeb", (object)[
            "tag" => $tag
        ], "ValidationKey", PHP_INT_MAX);
        return $result;
    }

    /**
     * Regenerates the app-key for a web-community.
     *
     * @param string $tag
     *            The community tag.
     * @throws \InvalidArgumentException
     * @return string The new app-key
     */
    public function RegenerateAppKey(string $tag = null)
    {
        if (GnUtil::IsNullOrEmpty($tag)) {
            throw new \InvalidArgumentException("tag required");
        }

        $result = $this->SimpleResultCall("RegenerateAppKey", (object)[
            "tag" => $tag
        ], "AppKey", PHP_INT_MAX);
        return $result;
    }

    /**
     * Validates a web-community.
     * Before a web-community can be used, it must be validated.
     * The validation key is provided while a web-community has been created with RegisterCommunityWeb().
     * The key can be placed into:
     * a.) your website's default home document as a meta-tag named "gpsnose-validation-key" (and content is the key), or
     * b.) a file named as the key: without any extension or with .txt|.htm |.html extensions
     *
     * @param string $tag
     *            Which web-community is to be validated.
     * @throws \InvalidArgumentException
     * @return string The app-key for the validated web-community.
     */
    public function ValidateCommunityWeb(string $tag = null)
    {
        if (GnUtil::IsNullOrEmpty($tag)) {
            throw new \InvalidArgumentException("tag required");
        }

        $result = $this->SimpleResultCall("ValidateCommunityWeb", (object)[
            "tag" => $tag
        ], "AppKey", PHP_INT_MAX);
        return $result;
    }

    /**
     * Adds a sub-community to an existing validated web-community.
     * A connected website could have more sub-communities, like @www.geohamster.com@admins.
     * A sub-community prefix defines the community protection-level: %=public, @=closed, *=private
     *
     * @param string $tag
     *            The sub-community tag in the form: %www.mydomain.com@subcommunityname
     * @param int $acls
     *            The new sub-community will get these ACLs when access by members.
     * @throws \InvalidArgumentException
     */
    public function AddSubCommunity(string $tag, int $acls = GnCommunityAcl::CommentsFromMembers | GnCommunityAcl::ListMembers | GnCommunityAcl::MembersInviteMembers)
    {
        if (GnUtil::IsNullOrEmpty($tag)) {
            throw new \InvalidArgumentException("tag required");
        }

        $this->ExecuteCall("AddSubCommunity", (object)[
            "tag" => $tag,
            "acls" => $acls
        ], GnResponseType::Json, false, PHP_INT_MAX);
    }

    /**
     * Deletes an existing sub-community from a web-community.
     *
     * @param string $tag
     *            The sub-community tag, like *www.geohamster.com@level-10
     * @throws \InvalidArgumentException
     */
    public function DelSubCommunity(string $tag = null)
    {
        if (GnUtil::IsNullOrEmpty($tag)) {
            throw new \InvalidArgumentException("tag required");
        }

        $this->ExecuteCall("DelSubCommunity", (object)[
            "tag" => $tag
        ], GnResponseType::Json, false, PHP_INT_MAX);
    }

    /**
     * Updates a web-community.
     *
     * @param string $tag
     *            The main web-community, like %www.mydomain.com
     * @param array $hosts
     *            Optional: allowed calling hosts. If null: will be removed.
     * @param string $mashupTokenCallbackUrl
     *            Optional: which mashup callback-url to call sync immediately while scanning the token. If null: will be removed.
     * @throws \InvalidArgumentException
     */
    public function UpdateCommunityWeb(string $tag = null, array $hosts = [], string $mashupTokenCallbackUrl = null)
    {
        if (GnUtil::IsNullOrEmpty($tag)) {
            throw new \InvalidArgumentException("tag required");
        }

        $this->ExecuteCall("UpdateCommunityWeb", (object)[
            "tag" => $tag,
            "hosts" => $hosts,
            "mashupTokenCallbackUrl" => $mashupTokenCallbackUrl
        ], GnResponseType::Json, false, PHP_INT_MAX);
    }

    /**
     * Gets the user's mashups.
     * Mashups waiting for validation are not returned: these do NOT belong the user until they have been successfully validated.
     *
     * @return array(\GpsNose\SDK\Mashup\Model\GnMashup) A list of successfully registered and validated mashups.
     */
    public function GetOwnMashups()
    {
        $result = $this->ExecuteCall("GetOwnMashups", null, GnResponseType::ListGnMashup, false, 1);
        return $result;
    }
}
