<?php

namespace GpsNose\SDK\Mashup\Framework;

class GnUtil
{
    /**
     * IsNullOrEmpty
     *
     * @param mixed $input
     * @return bool
     */
    public static function IsNullOrEmpty($input)
    {
        return (!isset($input) || trim($input) === '');
    }

    /**
     * NewGuid
     *
     * @return string
     */
    public static function NewGuid()
    {
        if (function_exists('com_create_guid')) {
            return trim(com_create_guid(), "{}");
        } else {
            $charid = strtolower(bin2hex(openssl_random_pseudo_bytes(16)));
            $hyphen = chr(45);
            $uuid = substr($charid, 0, 8) . $hyphen . substr($charid, 8, 4) . $hyphen . substr($charid, 12, 4) . $hyphen . substr($charid, 16, 4) . $hyphen . substr($charid, 20, 12);
            return $uuid;
        }
    }

    /**
     * TicksFromDate
     *
     * @param \DateTime $date
     * @return int
     */
    public static function TicksFromDate(\DateTime $date)
    {
        return ($date->getTimestamp() * 10000000) + 621355968000000000;
    }

    /**
     * DateFromTicks
     *
     * @param mixed $ticks
     * @return \DateTime
     */
    public static function DateFromTicks($ticks)
    {
        $date = new \DateTime();
        if (is_string($ticks)) {
            $ticksLong = intval($ticks);
            $date->setTimestamp(intval(($ticksLong - 621355968000000000) / 10000000));
        } else if (is_integer($ticks)) {
            $date->setTimestamp(intval(($ticks - 621355968000000000) / 10000000));
        } else {
            $date->setTimestamp(0);
        }
        return $date;
    }

    /**
     * Creates a random string
     *
     * @param int $length
     * @return string
     */
    public static function GenerateRandomString(int $length = 20)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * Check if the property exists on the object and returns the value (without warning)
     *
     * @param object $object
     * @param string $property
     * @return mixed
     */
    public static function GetSaveProperty($object, $property)
    {
        if (is_array($object)) {
            if (key_exists($property, $object)) {
                return $object[$property];
            }
            return null;
        }
        if (property_exists($object, $property)) {
            return $object->{$property};
        }
        return null;
    }
}
