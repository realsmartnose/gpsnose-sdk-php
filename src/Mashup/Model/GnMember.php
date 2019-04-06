<?php
namespace GpsNose\SDK\Mashup\Model;

class GnMember
{

    /**
     * GnMember __construct
     *
     * @param string $loginName
     * @param string $joinTicks
     */
    public function __construct(string $loginName = NULL, string $joinTicks = NULL)
    {
        $this->LoginName = $loginName;
        $this->JoinTicks = $joinTicks;
    }

    /**
     *
     * @var string
     */
    public $LoginName = "";

    /**
     *
     * @var string
     */
    public $JoinTicks = "0";
}
