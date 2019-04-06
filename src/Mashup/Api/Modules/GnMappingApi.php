<?php
namespace GpsNose\SDK\Mashup\Api\Modules;

use GpsNose\SDK\Mashup\Model\GnResponseType;

class GnMappingApi extends GnApiModuleBase
{

    /**
     * @var int
     */
    public const MAX_ZOOM = 28;

    /**
     * GnNewsApi __construct
     *
     * @param GnLoginApiBase $loginApi
     */
    public function __construct(GnLoginApiBase $loginApi)
    {
        parent::__construct($loginApi);
    }

    /**
     * Gets a rectangular from-to lat/lon from a geo-ip string.
     *
     * @param string $gip
     *            The geo-ip
     * @return \GpsNose\SDK\Mashup\Framework\GnMapRectangle The map-rectangle, which the gip describes.
     */
    public function GetLatLonRectangleFromGIp(string $gip)
    {
        $result = $this->ExecuteCall("GetLatLonRectangleFromGIp", (object) [
            "gip" => $gip
        ], GnResponseType::GnMapRectangle);

        return $result;
    }

    /**
     * Convert the given lat/lon into a geo-ip string.
     *
     * @param float $lat
     *            Latitude for the wanted location.
     * @param float $lon
     *            Longitude for the wanted location.
     * @param int $zoom
     *            Zoom level [0..28]
     * @return string The geo-ip encoded location with a given zoom.
     */
    public function GetGipFromLatLon(float $lat, float $lon, int $zoom = $this::MAX_ZOOM)
    {
        $result = $this->ExecuteCall("GetGipFromLatLon", (object) [
            "lat" => $lat,
            "lon" => $lon,
            "zoom" => $zoom
        ], GnResponseType::String);

        return $result;
    }
}
