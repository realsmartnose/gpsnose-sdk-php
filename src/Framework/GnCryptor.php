<?php
namespace GpsNose\SDK\Framework;

use GpsNose\SDK\Framework\Logging\GnLogger;

class GnCryptor
{

    /**
     * @var string
     */
    public static $pass = null;

    /**
     * @var string
     */
    private static $algorithm = "AES-256-ECB";

    /**
     * GnCryptor __construct
     */
    public function __construct()
    {
        if (! self::$pass) {
            self::$pass = "GpsNoseQWERT" . session_id();
            GnLogger::Warning("Crypt-Pass not set. We use session-based password now...");
        }
    }

    /**
     * Encript data
     *
     * @param string $data
     * @return string
     */
    public function encrypt($data)
    {
        try {
            return openssl_encrypt($data, self::$algorithm, self::$pass);
        } catch (\Exception $e) {
            return $data;
        }
    }

    /**
     * Decrypt data
     *
     * @param string $data
     * @return string
     */
    public function decrypt($data)
    {
        try {
            return openssl_decrypt($data, self::$algorithm, self::$pass);
        } catch (\Exception $e) {
            return $data;
        }
    }
}
