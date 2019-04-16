<?php
namespace GpsNose\SDK\Mashup\Model;

class GnMashupStorageItem
{
    /**
     * GnLogin __construct
     *
     * @param object $json
     */
    public function __construct($json = NULL)
    {
        if ($json != NULL) {
            $this->Key = $json->{"Key"};
            $this->Value = $json->{"Value"};
            $this->UpdatedTicks = $json->{"UpdatedTicks"};
        }
    }

    /**
     * @var string
     */
    public $Key = "";

    /**
     * @var string
     */
    public $Value = "";

    /**
     * @var string
     */
    public $UpdatedTicks = "0";
}
