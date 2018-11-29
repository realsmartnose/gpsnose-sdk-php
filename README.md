# GpsNose.SDK for PHP

Welcome to the GpsNose web-integration package ;-)!

You can use the login, real geo-data and nearby anonymous communication from the GpsNose platform in your web-site.

Please, check the developer's manual with code-samples and HowTos available here:

https://wiki.gpsnose.com/wp-content/uploads/2018/11/GpsNose_DeveloperManual.pdf

## Key-points

- Your web-users can enter the web-community of your website (%www.YOURDOMAIN.com) or a sub-community (%www.YOURDOMAIN.com@fishing)
- Your otherwise virtual users are immediately real geo-enabled, can communicate in real-world and real-time also outside your web.
- The data your users generate are available at your website, such as users, PoIs, events, tracks..
- This SDK contains the most useful web-wrappers for the underlying GpsNose.SDK framework API calls
- You can make your own web-modules as you like, using the GpsNose.SDK or writing your own one

## Important

- To use this web SDK, you must first setup a valid web-community mashup to GpsNose at the mashup-admin:
    https://www.gpsnose.com/Developer/MashupAdmin

## For end-users

- Home-page: https://www.gpsnose.com
- User-guide: https://www.gpsnose.com/home/doc

## For devs

- Wiki: https://wiki.gpsnose.com
- SDK/CMS modules/sources download: https://wiki.gpsnose.com/download/
- Mashup-admin: https://www.gpsnose.com/Developer/MashupAdmin

## How to integrate

Read the basic usage on the [GpsNose WIKI](https://wiki.gpsnose.com/sdk/)

The SDK is used in the [TYPO3 plugin](https://github.com/realsmartnose/gpsnose-typo3-ext), you may use this as an example and a how to...

## Caching in PHP

In PHP there is another implementation for Cache then in C#. The default implemantation is memcache, if your server has installed this extension, you have to tell the SDK where to find the Server:

```php
\GpsNose\SDK\Framework\GnCache::$MemcacheServer = '127.0.0.1';
\GpsNose\SDK\Framework\GnCache::$MemcachePort = '11211';
```

## Implementing own Cache-Handler

Find an example [here](https://github.com/realsmartnose/gpsnose-typo3-ext/blob/master/Classes/Utility/GnCacheHandler.php) how to implement an own Cache-Handler

You have to implement the "\GpsNose\SDK\Framework\IGnCacheHandler" Interface of this SDK

To initiate the new created Cache handler, you have to set the Cache-Handler:

```php
\GpsNose\SDK\Framework\GnCache::$CacheHandler = new \your\namespace\GnCacheHandler();
```

## Change crypt-password

Here is how to set an own password:

```php
\GpsNose\SDK\Framework\GnCryptor::$pass = 'my-crypt-password';
```

