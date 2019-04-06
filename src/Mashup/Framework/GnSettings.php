<?php
namespace GpsNose\SDK\Mashup\Framework;

/**
 * GnSettings
 */
class GnSettings
{
    /**
     * @var string
     */
    const PUBLIC_COMMUNITY_PREFIX = "%";

    /**
     * @var string
     */
    const CLOSED_COMMUNITY_PREFIX = "@";

    /**
     * @var string
     */
    const PRIVATE_COMMUNITY_PREFIX = "*";

    /**
     * @var int
     */
    const FAR_FUTURE_TICKS = 3155378975999999999; //DateTime.MaxValue.Ticks;

    /**
     * @var string
     */
    const GPSNOSE_COMMUNITY = "%www.gpsnose.com";

    /**
     * @var string
     */
    public static $CurrentLangId = "en";
}
