<?php
namespace GpsNose\SDK\Framework;

interface IGnCacheHandler
{
    function get(string $key);
    function set(string $key, string $group, $val, $expiriesIn);
    function deleteKey(string $key = null);
    function deleteGroup(string $keyPattern = null);
}