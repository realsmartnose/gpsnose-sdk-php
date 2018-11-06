<?php
namespace GpsNose\SDK\Web\Login;

use GpsNose\SDK\Framework\GnCryptor;

class GnAuthentication
{

    /**
     * IsAuthenticatedRequest
     *
     * @return boolean
     */
    public static function IsAuthenticatedRequest()
    {
        return isset($_COOKIE['GpsNoseAuthentication']);
    }

    /**
     * Login
     *
     * @param GnAuthenticationData $gnAuthData
     */
    public static function Login(GnAuthenticationData $gnAuthData)
    {
        $cryptor = new GnCryptor();
        $gnPrincipal = new GnPrincipal($gnAuthData);
        $time = time() + 60 * 60 * 24 * 30 * 12; // 1year
        setcookie('GpsNoseAuthentication', $cryptor->encrypt(json_encode($gnPrincipal)), $time, '/');
    }

    /**
     * Logout
     */
    public static function Logout()
    {
        if (static::IsAuthenticatedRequest()) {
            unset($_COOKIE['GpsNoseAuthentication']);
            setcookie('GpsNoseAuthentication', null, time() - 3600, '/');
        }
    }

    /**
     * CurrentUser
     *
     * @return GnPrincipal
     */
    public static function CurrentUser()
    {
        if (static::IsAuthenticatedRequest()) {
            $cryptor = new GnCryptor();
            $cookie = $cryptor->decrypt($_COOKIE['GpsNoseAuthentication']);
            $json = json_decode($cookie);
            $gnPrincipal = new GnPrincipal();
            $gnPrincipal->LoginName = $json->{"LoginName"};
            $gnPrincipal->LoginId = $json->{"LoginId"};
            $gnPrincipal->ProfileTags = $json->{"ProfileTags"};
            return $gnPrincipal;
        }
        return null;
    }
}