<?php
namespace GpsNose\SDK\Mashup;

class GnLocalSettings
{
    /**
     * Overwrite from your app-start with your app-key.
     * @var string
     */
    public static $AppKey = "YOUR-APP-KEY";


    /**
     * Overwrite from your app-start with your main web-community.
     * @var string
     */
    public static $Community = "%www.YOUR-WEB-DOMAIN.com";


    /**
     * Overwrite from your app-start with your local-web GpsNose images path.
     * @var string
     */
    public static $GnImagesPath = "/Content/GpsNose/Images";


    /**
     * Returns the item's placeholder image path for things like img's onerror usage.
     * When an item's image doesn't exist, you can set the img's error-handler to set this placeholder instead.
     * &lt;img src="..." onerror="this.src='GetEmptyImagePath(...)'" /&gt;
     */
    public static function GetEmptyImagePath(int $itemType = GnUrlItemType::Impression, string $itemKey = null)
    {
        $fileName = "EmptyImage.png";

        switch ($itemType) {
            case GnUrlItemType::Community:
                $fileName = "EmptyCommunity.png";
                break;

            case GnUrlItemType::Nose:
                $fileName = "EmptyUser.png";
                break;

            case GnUrlItemType::Track:
                $fileName = "EmptyMap.png";
                break;
        }

        return static::GnImagesPath . "/{$fileName}";
    }
}