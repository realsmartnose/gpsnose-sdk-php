<?php
namespace GpsNose\SDK\Framework\Logging;

class GnLogConfig
{

    /**
     * @var array
     */
    private static $Listeners = [];

    /**
     * Get Listeners
     *
     * @return array(GnILogListener)
     */
    public static function getListeners()
    {
        return self::$Listeners;
    }

    /**
     * Add Listener
     *
     * @param GnILogListener $listener
     */
    public static function AddListener(GnILogListener $listener)
    {
        if (! array_key_exists(get_class($listener), self::$Listeners)) {
            self::$Listeners[get_class($listener)] = $listener;
        }
    }

    /**
     * Remove Listener
     *
     * @param GnILogListener $listener
     */
    public static function RemoveListener(GnILogListener $listener)
    {
        unset(self::$Listeners[get_class($listener)]);
    }
}
