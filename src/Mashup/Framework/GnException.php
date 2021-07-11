<?php
namespace GpsNose\SDK\Mashup\Framework;

use GpsNose\SDK\Framework\Logging\GnLogger;

class GnException extends \Exception
{
    /**
     * GnException __construct
     * @param string $msg
     */
    public function __construct(string $msg = null)
    {
        parent::__construct($msg, null, null);
        GnLogger::LogException($this);
    }
}
