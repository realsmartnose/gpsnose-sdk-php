<?php
namespace GpsNose\SDK\Framework;

use GpsNose\SDK\Framework\Logging\GnLogger;
use GpsNose\SDK\Mashup\Api\GnApi;
use GpsNose\SDK\Mashup\Framework\GnUtil;

class GnCache
{

    /**
     * Disables the cache
     *
     * @var bool
     */
    public static $DisableCache = false;

    /**
     * Memcache Server
     *
     * @var string
     */
    public static $MemcacheServer = '127.0.0.1';

    /**
     * Memcache Port
     *
     * @var int
     */
    public static $MemcachePort = 11211;

    /**
     * External cache-handler
     *
     * @var IGnCacheHandler
     */
    public static $CacheHandler;

    /**
     *
     * @var \Memcached
     */
    private $_memcached;

    /**
     * Call this method to get singleton
     *
     * @return GnCache
     */
    public static function Instance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new GnCache();
        }
        return $inst;
    }

    /**
     * GnCache __construct
     */
    private function __construct()
    {
        if (! static::$CacheHandler && ! static::$DisableCache) {
            $this->_memcached = new \Memcached();
            $this->_memcached->addServer(static::$MemcacheServer, static::$MemcachePort);
        }
    }

    /**
     * @return bool
     */
    private function isMemcachedConnected()
    {
        return $this->_memcached && $this->_memcached->getStats();
    }

    /**
     * Returns a cached item
     *
     * @param string $propName
     * @param string $groupName
     * @param int $expiriesIn
     * @param void $initFunc
     * @return object
     */
    public function GetCachedItem(string $propName, string $groupName, int $expiriesIn, $initFunc)
    {
        if (static::$DisableCache && $initFunc) {
            if (GnApi::$Debug) {
                GnLogger::Verbose("Cache is disable");
            }
            return $initFunc();
        }

        // In case memcached is not available, use no cache
        if (! static::$CacheHandler && ! $this->isMemcachedConnected() && $initFunc) {
            if (GnApi::$Debug) {
                GnLogger::Warning("No cache-handler configured and Memcached not available");
            }
            return $initFunc();
        }

        $val = static::$CacheHandler ? static::$CacheHandler->get($propName) : $this->_memcached->get($propName);
        if (! $val && $initFunc) {
            $val = $initFunc();
            if (static::$CacheHandler) {
                static::$CacheHandler->set($propName, $groupName, $val, $expiriesIn);
            } else if ($this->isMemcachedConnected()) {
                $this->_memcached->set($propName, $val, time() + $expiriesIn);
            }
        } elseif (GnApi::$Debug) {
            GnLogger::Verbose("Found cache '{$propName}'");
        }
        return $val;
    }

    /**
     * Clears the items from the cache.
     *
     * @param string $keyPattern The items to be cleared by a regexp-pattern of the key. If null, everything is removed.
     */
    public function ClearCache(string $keyPattern = null)
    {
        if (GnApi::$Debug) {
            GnLogger::Verbose("Clear cache '{$keyPattern}'");
        }

        if (static::$CacheHandler) {
            static::$CacheHandler->deleteKey($keyPattern);
            static::$CacheHandler->deleteGroup($keyPattern);
        } else if ($this->isMemcachedConnected()) {
            $keys = $this->_memcached->getAllKeys();
            if (GnUtil::IsNullOrEmpty($keyPattern)) {
                // remove all items
                foreach ($keys as $key) {
                    $this->_memcached->delete($key);
                }
                return;
            }

            // remove key-patterns only
            foreach ($keys as $key) {
                $matches = array();
                $ret = preg_match("/" . preg_quote($keyPattern, '/') . "/", $key, $matches);
                if ($ret > 0) {
                    $this->_memcached->delete($key);
                }
            }
        }
    }
}
