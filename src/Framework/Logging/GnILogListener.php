<?php

namespace GpsNose\SDK\Framework\Logging;

interface GnILogListener
{

    /**
     * WriteToLog
     *
     * @param int $level
     * @param string $message
     */
    function WriteToLog(int $level = GnLogLevel::Off, string $message = null);
}
