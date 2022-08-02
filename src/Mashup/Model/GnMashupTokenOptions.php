<?php

namespace GpsNose\SDK\Mashup\Model;

class GnMashupTokenOptions
{
    /**
     * @var int
     */
    const NoOptions = 0;

    /**
     * @var int
     */
    const BatchScanning = 1;

    /**
     * @var int
     */
    const CanSelectAmount = 2;

    /**
     * @var int
     */
    const CanComment = 4;

    /**
     * @var int
     */
    const AskGpsSharing = 8;
}
