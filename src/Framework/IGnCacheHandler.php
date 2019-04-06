<?php
namespace GpsNose\SDK\Framework;

interface IGnCacheHandler
{
    /**
     * @param string $key
     */
    function get(string $key);

    /**
     * @param string $key
     * @param string $group
     * @param string $val
     * @param int $expiriesIn
     */
    function set(string $key, string $group, $val, $expiriesIn);

    /**
     * @param string $key
     */
    function deleteKey(string $key = NULL);

    /**
     * @param string $keyPattern
     */
    function deleteGroup(string $keyPattern = NULL);
}
