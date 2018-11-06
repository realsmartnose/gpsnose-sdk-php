<?php
namespace GpsNose\SDK\Framework;

use GpsNose\SDK\Framework\Logging\GnLogger;

class GnCryptor
{

    public static $pass = NULL;

    private static $algorithm = "AES-256-ECB";

    public function __construct()
    {
        if (! self::$pass) {
            self::$pass = "GpsNoseQWERT" . session_id();
            GnLogger::Warning("Crypt-Pass not set. We use session-based password now...");
        }
    }

    public function encrypt($data)
    {
        try {
            return openssl_encrypt($data, self::$algorithm, self::$pass);
        } catch (\Exception $e) {
            return $data;
        }
    }

    public function decrypt($data)
    {
        try {
            return openssl_decrypt($data, self::$algorithm, self::$pass);
        } catch (\Exception $e) {
            return $data;
        }
    }
}