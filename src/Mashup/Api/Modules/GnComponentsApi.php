<?php
namespace GpsNose\SDK\Mashup\Api\Modules;

/**
 * Provides access to the real-world data around your end-user, like impressions, Noses, PoIs, Tracks, Events etc.
 * All the API calls accepts an optional sub-community, or defaults to the one mapped to your app-key.
 * When an item has a picture, you can get it referring the corresponding URL address using the item's creation-key.
 */
class GnComponentsApi extends GnApiModuleBase
{
    /**
     * @var string
     */
    public $ControllerBasePath = "Components";

    /**
     * GnComponentsApi __construct
     *
     * @param GnLoginApiBase $loginApi
     */
    public function __construct(GnLoginApiBase $loginApi)
    {
        parent::__construct($loginApi);
    }

    /**
     * GetQrCode
     *  
     * @param string $tag
     */
    public function GetQrCode(string $tag = NULL)
    {
        return $this->ExecuteGet("QrCode", [
            "tag" => $tag
        ], 7 * 60 * 60); // 7h
    }
}
