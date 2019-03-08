<?php
namespace GpsNose\SDK\Mashup\Api\Modules;

use GpsNose\SDK\Mashup\Model\GnResponseType;

/**
 * Storage reading/writing API.
 *
 * Use this general storage API for saving/retrieving any kind of data items you need.
 * Ever item belongs to a mashup-site and storage-name and is owned by a specific user.
 * When saving/loading, you can impersonate an owner, as long as you are logged-in as the mashup-creator.
 */
class GnStorageApi extends GnApiModuleBase
{

    private const CLEAR_CACHE_PATTERNS = [
        "PutStorageItem"
    ];

    /**
     * GnStorageApi __construct
     *
     * @param GnLoginApiBase $loginApi
     */
    public function __construct(GnLoginApiBase $loginApi)
    {
        parent::__construct($loginApi);
    }

    /**
     * Gets the raw storage-items page from a specific storage for an user.
     * You can use this raw paging version when needing the internal JSON data and/or the UpdatedTicks.
     *
     * @param string $storage
     * @param int $pageSize
     * @param string $lastKnownKey
     * @param string $ownerUserName
     * @return array(\GpsNose\SDK\Mashup\Model\GnMashupStorageItem)
     */
    public function GetStorageItemsPage(string $storage, int $pageSize = 50, string $lastKnownKey = null, string $ownerUserName = null)
    {
        $result = $this->ExecuteCall("GetStorageItemsPage", (object) [
            "storage" => $storage,
            "pageSize" => $pageSize,
            "lastKnownKey" => $lastKnownKey,
            "ownerUserName" => $ownerUserName
        ], GnResponseType::ListGnMashupStorageItem);

        return $result;
    }

    /**
     * Gets a storage-item from a specific storage for an user by a given key.
     * Use this call to retrieve the internal value, possible with json inside.
     * It's useful when needing the UpdatedTicks value for example.
     *
     * @param string $storage
     * @param string $key
     * @param string $ownerUserName
     * @return \GpsNose\SDK\Mashup\Model\GnMashupStorageItem
     */
    public function GetStorageItem(string $storage, string $key, string $ownerUserName = null)
    {
        $result = $this->ExecuteCall("GetStorageItem", (object) [
            "storage" => $storage,
            "key" => $key,
            "ownerUserName" => $ownerUserName
        ], GnResponseType::GnMashupStorageItem);

        return $result;
    }

    /**
     * Puts/deletes a storage-item into/from a specific storage for an user.
     * To delete an item, set the value to null.
     *
     * @param string $storage
     *            The storage name: use this as you like, it's a kind of "table" name for organizing your key/values for an user.
     * @param string $key
     *            The item's key: most non-special chars can be used.
     * @param object $value
     *            The item's value or null: anything can be used, but the JSON serialized value should be less than approx 60KB.
     * @param string $ownerUserName
     *            Whom the item will belong; default is the API caller. Only the mashup-creator is allowed to override the owner's name.
     */
    public function PutStorageItem(string $storage, string $key, object $value, string $ownerUserName = null)
    {
        // if the value is already a string, leave it as-is; otherwise, get the json
        $json = json_encode($value);

        $this->ExecuteCall("PutStorageItem", (object) [
            "storage" => $storage,
            "key" => $key,
            "value" => $json,
            "ownerUserName" => $ownerUserName
        ]);

        $this->ClearCacheForActionNames(CLEAR_CACHE_PATTERNS);
    }
}