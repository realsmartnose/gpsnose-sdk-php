<?php

namespace GpsNose\SDK\Framework\Logging;

class GnLogger
{

    /**
     * @param string $msg
     */
    public static function Verbose(string $msg)
    {
        $bt = debug_backtrace();
        $caller = $bt[1];
        self::WriteLog(GnLogLevel::Verbose, $msg, $caller['line'], $caller['class'] . "::" . $caller['function'], $caller['file']);
    }

    /**
     * @param string $msg
     */
    public static function Info(string $msg)
    {
        $bt = debug_backtrace();
        $caller = $bt[1];
        self::WriteLog(GnLogLevel::Information, $msg, $caller['line'], $caller['class'] . "::" . $caller['function'], $caller['file']);
    }

    /**
     * @param string $msg
     */
    public static function Warning(string $msg)
    {
        $bt = debug_backtrace();
        $caller = $bt[1];
        self::WriteLog(GnLogLevel::Warning, $msg, $caller['line'], $caller['class'] . "::" . $caller['function'], $caller['file']);
    }

    /**
     * @param string $msg
     */
    public static function Error(string $msg)
    {
        $bt = debug_backtrace();
        $caller = $bt[1];
        self::WriteLog(GnLogLevel::Error, $msg, $caller['line'], $caller['class'] . "::" . $caller['function'], $caller['file']);
    }

    /**
     * @param string $msg
     */
    public static function Critical(string $msg)
    {
        $bt = debug_backtrace();
        $caller = $bt[1];
        self::WriteLog(GnLogLevel::Critical, $msg, $caller['line'], $caller['class'] . "::" . $caller['function'], $caller['file']);
    }

    /**
     * @param int $level
     * @param string $msg
     * @param string $linenumber
     * @param string $caller
     * @param string $filepath
     */
    private static function WriteLog(int $level, string $msg, $linenumber, $caller, $filepath)
    {
        $msg = "{$msg} {$filepath} {$linenumber} {$caller}";

        foreach (GnLogConfig::getListeners() as $listener) {
            $listener->WriteToLog($level, $msg);
        }
    }

    /**
     * @param \Exception $ex
     */
    public static function LogException(\Exception $ex)
    {
        $msg = self::GetAllMessagesFromException($ex);
        $bt = debug_backtrace();
        $caller = $bt[1];
        self::WriteLog(GnLogLevel::Critical, $msg, $caller['line'], $caller['function'], $caller['file']);
    }

    /**
     * @param \Exception $ex
     * @param int $level
     */
    private static function GetAllMessagesFromException(\Exception $ex, int $level = 0)
    {
        $msg = self::GetMsgFromEx($ex, $level == 0);
        return $msg;
    }

    /**
     * @param \Exception $ex
     * @param bool $includeStack
     */
    private static function GetMsgFromEx(\Exception $ex, bool $includeStack)
    {
        $msg = "[{$ex->getCode()}] {$ex->getMessage()}";

        if ($includeStack) {
            $msg .= " - {$ex->getTraceAsString()}";
        }

        return $msg;
    }
}
