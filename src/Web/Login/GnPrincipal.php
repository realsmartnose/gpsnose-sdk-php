<?php
namespace GpsNose\SDK\Web\Login;

class GnPrincipal
{

    /**
     * GnPrincipal __construct
     * @param GnAuthenticationData $gnAuthData
     */
    public function __construct(GnAuthenticationData $gnAuthData = NULL)
    {
        if ($gnAuthData != NULL) {
            $this->LoginName = $gnAuthData->LoginName;
            $this->LoginId = $gnAuthData->LoginId;
            $this->ProfileTags = $gnAuthData->ProfileTags ?: [];
        }
    }

    /**
     * IsInRole
     * @param string $role
     * @return bool
     */
    public function IsInRole(string $role)
    {
        return in_array($role, $this->ProfileTags);
    }

    /**
     * @var string
     */
    public $LoginName;

    /**
     * @var string
     */
    public $LoginId;

    /**
     * @var array
     */
    public $ProfileTags;

}
