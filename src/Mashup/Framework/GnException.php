<?php
namespace GpsNose\SDK\Mashup\Framework;

use GpsNose\SDK\Framework\Logging\GnLogger;

class GnException extends \Exception
{
    /**
     * GnException __construct
     * @param string $msg
     */
    public function __construct(string $msg = NULL)
    {
        parent::__construct($msg, NULL, NULL);
        GnLogger::LogException($this);
    }
}
