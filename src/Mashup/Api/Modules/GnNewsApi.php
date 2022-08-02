<?php

namespace GpsNose\SDK\Mashup\Api\Modules;

use GpsNose\SDK\Mashup\Model\GnResponseType;
use GpsNose\SDK\Mashup\Framework\GnSettings;

class GnNewsApi extends GnApiModuleBase
{
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
     * GetNewsPage
     *
     * @param string $subCommunity
     * @param int $pageSize
     * @param int $lastKnownTicks
     * @return array(\GpsNose\SDK\Mashup\Model\GnNews)
     */
    public function GetNewsPage(string $subCommunity = null, int $pageSize = 50, int $lastKnownTicks = GnSettings::FAR_FUTURE_TICKS)
    {
        $result = $this->ExecuteCall("GetNewsPage", (object)[
            "community" => $subCommunity,
            "pageSize" => $pageSize,
            "lastKnownTicks" => $lastKnownTicks
        ], GnResponseType::ListGnNews);

        return $result;
    }
}
