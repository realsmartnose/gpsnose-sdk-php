<?php
namespace GpsNose\SDK\Mashup\Framework;

class GnSettings
{
    const PUBLIC_COMMUNITY_PREFIX = "%";
    const CLOSED_COMMUNITY_PREFIX = "@";
    const PRIVATE_COMMUNITY_PREFIX = "*";

    const FAR_FUTURE_TICKS = 3155378975999999999; //DateTime.MaxValue.Ticks;

    const GPSNOSE_COMMUNITY = "%www.gpsnose.com";

    public static $CurrentLangId = "en";
}