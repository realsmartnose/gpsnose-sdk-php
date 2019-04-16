<?php
namespace GpsNose\SDK\Mashup\Model;

class GnMail
{
    /**
     * GnMail __construct
     *
     * @param object $json
     */
    public function __construct($json = NULL)
    {
        if ($json != NULL) {
            $this->CreationTicks = $json->{"CreationTicks"};
            $this->FromLoginName = $json->{"FromLoginName"};
            $this->Body = $json->{"Body"};
        }
    }

    /**
     * @var string
     */
    public $CreationTicks = "0";

    /**
     * @var string
     */
    public $FromLoginName = "";

    /**
     * @var string
     */
    public $Body = "";
}
