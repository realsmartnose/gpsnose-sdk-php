<?php
namespace GpsNose\SDK\Framework\Logging;

interface GnILogListener
{

    /**
     * WriteToLog
     *
     * @param GnLogLevel $level
     * @param string $message
     */
    function WriteToLog(int $level = GnLogLevel::Off, string $message = null);
}
