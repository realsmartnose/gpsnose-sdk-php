# gpsnose-sdk-php

## How to integrate GpsNose

Read the basic usage on the [GpsNose WIKI](https://wiki.gpsnose.com/sdk/)

The SDK is used in the [TYPO3 plugin](https://github.com/realsmartnose/gpsnose-typo3-ext), you may use this as an example and a how to...

## Caching in PHP

In PHP there is another implementation for Cache then in C#. The default implemantation is memcache, if your server has installed this extension, you have to tell the SDK where to find the Server:

```php
GnCache::$MemcacheServer = '127.0.0.1';
GnCache::$MemcachePort = '11211';
```

### Implementing own Cache-Handler

Find an example [here]https://github.com/realsmartnose/gpsnose-typo3-ext/blob/master/Classes/Utility/GnCacheHandler.php how to implement an own Cache-Handler

You have to implement the "\GpsNose\SDK\Framework\IGnCacheHandler" Interface of this SDK

To initiate the new created Cache handler, you have to set the Cache-Handler:

```php
GnCache::$CacheHandler = new GnCacheHandler();
```

