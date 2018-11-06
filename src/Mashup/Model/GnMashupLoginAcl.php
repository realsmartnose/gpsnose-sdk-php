<?php
namespace GpsNose\SDK\Mashup\Model;

class GnMashupLoginAcl
{

    const None = 0;

    const FullName = 1;

    const Email = 2;

    const CommunitiesNonprivate = 4;

    const IsSafeMode = 8;

    const GpsLocation = 16;
}