<?php
namespace GpsNose\SDK\Mashup\Model;

class GnMashupLoginAcl
{
    /**
     * @var int
     */
    const None = 0;

    /**
     * @var int
     */
    const FullName = 1;

    /**
     * @var int
     */
    const Email = 2;

    /**
     * @var int
     */
    const CommunitiesNonprivate = 4;

    /**
     * @var int
     */
    const IsSafeMode = 8;

    /**
     * @var int
     */
    const GpsLocation = 16;
}