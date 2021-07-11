<?php
namespace GpsNose\SDK\Mashup\Model;

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
            $this->CreationTicks = $json->{"CreationTicks"};
            $this->Creator = $json->{"Creator"};
            $this->Mood = $json->{"Mood"};
            $this->Text = $json->{"Text"};
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
