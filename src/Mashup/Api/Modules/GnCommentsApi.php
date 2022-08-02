<?php

namespace GpsNose\SDK\Mashup\Api\Modules;

use GpsNose\SDK\Mashup\Model\GnCommentItemType;
use GpsNose\SDK\Mashup\Model\GnResponseType;
use GpsNose\SDK\Mashup\Framework\GnSettings;

/**
 * Comments reading/writing API.
 */
class GnCommentsApi extends GnApiModuleBase
{
    /**
     * @var array
     */
    private const CLEAR_CACHE_PATTERNS = [
        "GetCommentsPage"
    ];

    /**
     * GnCommentsApi __construct
     *
     * @param GnLoginApiBase $loginApi
     */
    public function __construct(GnLoginApiBase $loginApi)
    {
        parent::__construct($loginApi);
    }

    /**
     * Gets the comments page for a specified item type/key, or for the sub/community itself
     *
     * @param int $itemType
     * @param string $itemKey
     * @param int $pageSize
     * @param int $lastKnownTicks
     * @return array(\GpsNose\SDK\Mashup\Model\GnComment)
     */
    public function GetCommentsPage(int $itemType = GnCommentItemType::Community, string $itemKey = null, int $pageSize = null, int $lastKnownTicks = GnSettings::FAR_FUTURE_TICKS)
    {
        $result = $this->ExecuteCall("GetCommentsPage", (object)[
            "itemType" => $itemType,
            "itemKey" => $itemKey,
            "pageSize" => $pageSize,
            "lastKnownTicks" => $lastKnownTicks
        ], GnResponseType::ListGnComment);

        return $result;
    }

    /**
     * Adds a new comment.
     *
     * @param string $text
     * @param int $itemType
     * @param string $itemKey
     * @return string
     */
    public function AddComment(string $text, int $itemType = GnCommentItemType::Community, string $itemKey = null)
    {
        $result = $this->ExecuteCall("AddComment", (object)[
            "itemType" => $itemType,
            "itemKey" => $itemKey,
            "text" => $text
        ], GnResponseType::Json, false, PHP_INT_MAX);

        $this->ClearCacheForActionNames($this::CLEAR_CACHE_PATTERNS);

        return $result;
    }

    /**
     * Updates or deletes an existing comment.
     *
     * @param string $commentTicks
     * @param string $text
     * @param int $itemType
     * @param string $itemKey
     */
    public function UpdateComment(string $commentTicks, string $text, int $itemType = GnCommentItemType::Community, string $itemKey = null)
    {
        $this->ExecuteCall("UpdateComment", (object)[
            "commentTicks" => ($commentTicks + 0),
            "itemType" => $itemType,
            "itemKey" => $itemKey,
            "text" => $text
        ], GnResponseType::Json, false, PHP_INT_MAX);

        $this->ClearCacheForActionNames($this::CLEAR_CACHE_PATTERNS);
    }
}
