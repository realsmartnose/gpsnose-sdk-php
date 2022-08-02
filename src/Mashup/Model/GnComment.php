<?php

namespace GpsNose\SDK\Mashup\Model;

use GpsNose\SDK\Mashup\Framework\GnUtil;

class GnComment
{
    /**
     * GnComment __construct
     *
     * @param object $json
     */
    public function __construct($json = null)
    {
        if ($json != null) {
            $this->CreationTicks = GnUtil::GetSaveProperty($json, "CreationTicks");
            $this->Creator = GnUtil::GetSaveProperty($json, "Creator");
            $this->Mood = GnUtil::GetSaveProperty($json, "Mood");
            $this->Text = GnUtil::GetSaveProperty($json, "Text");
        }
    }

    /**
     * @var string
     */
    public $CreationTicks = "";

    /**
     * @var string
     */
    public $Creator = "";

    /**
     * @var string
     */
    public $Mood = "";

    /**
     * @var string
     */
    public $Text = "";
}
