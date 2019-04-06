<?php
namespace GpsNose\SDK\Mashup;

use GpsNose\SDK\Mashup\Framework\GnException;

class GnPaths
{
    /**
     * HomeUrl
     * @var string
     */
    public static $HomeUrl = "http://www.gpsnose.com";


    /**
     * HomeUrlSslNeeded
     * @return string
     */
    public static function HomeUrlSslNeeded()
    {
        $url = static::$HomeUrl;
        if (substr($url, 0, 22) == "http://www.gpsnose.com") {
            $url = str_replace("http://", "https://", $url);
        }

        return $url;
    }


    /**
     * DataUrl
     * @var string
     */
    public static $DataUrl = "http://data.gpsnose.com";


    /**
     * ProfileLink
     * @param string $userName
     * @return string
     */
    public static function ProfileLink(string $userName = NULL)
    {
        $s = static::$HomeUrl . "/{$userName}";
        return $s;
    }


    /**
     * ProfileImage
     * @param string $userName
     * @param int $size
     * @return string
     */
    public static function ProfileImage(string $userName = NULL, int $size = 0)
    {
        $sizeSuffix = $size == 0 ? "" : "@{$size}";
        $s = static::$DataUrl . "/profimg/{$userName}{$sizeSuffix}";
        return $s;
    }


    /**
     * Gets the details-page at www.gpsnose.com for an item-type.
     * @param int $itemType
     * @param string $itemKey
     * @throws \GpsNose\SDK\Mashup\Framework\GnException
     * @return string
     */
    public static function GetUrlForDetails(int $itemType = GnUrlItemType::Community, string $itemKey = NULL)
    {
        switch ($itemType)
        {
            case GnUrlItemType::Community: return static::$HomeUrl . "/community/index/?profileTag={$itemKey}";
            case GnUrlItemType::Event: return static::$HomeUrl . "/event/detail/{$itemKey}";
            case GnUrlItemType::Impression: return static::$HomeUrl . "/impression/detail/{$itemKey}";
            case GnUrlItemType::Nose: return static::$HomeUrl . "/{$itemKey}";
            case GnUrlItemType::PoI: return static::$HomeUrl . "/poi/detail/{$itemKey}";
            case GnUrlItemType::Track: return static::$HomeUrl . "/tour/detail/{$itemKey}";
        }

        throw new GnException("unexpected itemType={$itemType}");
    }


    /**
     * Returns an image-url from www.gpsnose.com for an item.
     * @param int $itemType
     * @param string $itemKey
     * @param int $sizeType
     * @throws \GpsNose\SDK\Mashup\Framework\GnException
     * @return string
     */
    public static function GetUrlForImage(int $itemType = GnUrlItemType::Community, string $itemKey = NULL, int $sizeType = GnThumbnailSize::Size_Full)
    {
        $sizeSuffix = $sizeType == GnThumbnailSize::Size_Full ? "" : "@{$sizeType}";

        switch ($itemType)
        {
            case GnUrlItemType::Community: return static::$DataUrl . "/commimg/{$itemKey}{$sizeSuffix}";
            case GnUrlItemType::Event: return static::$DataUrl . "/eventsimg/{$itemKey}{$sizeSuffix}";
            case GnUrlItemType::Impression: return static::$DataUrl . "/impression/{$itemKey}{$sizeSuffix}";
            case GnUrlItemType::Nose: return static::$DataUrl . "/profimg/{$itemKey}{$sizeSuffix}";
            case GnUrlItemType::PoI: return static::$DataUrl . "/locimg/{$itemKey}{$sizeSuffix}";

            // track has no image
            case GnUrlItemType::Track: break;
        }

        throw new GnException("unexpected itemType={$itemType}");
    }
}
