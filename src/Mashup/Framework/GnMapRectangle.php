<?php
namespace GpsNose\SDK\Mashup\Framework;

/**
 * Holds a from-to rectangular map-area.
 *
 * @author jurgenfurrer
 */
class GnMapRectangle
{

    /**
     * GnMapRectangle __construct
     *
     * @param object $json
     */
    public function __construct($json = NULL)
    {
        if ($json != NULL) {
            $this->Zoom = $json->{"Zoom"} + 0;
            $this->Center = new GnMapPoint($json->{"Center"});
            $this->Vertex0 = new GnMapPoint($json->{"Vertex0"});
            $this->Vertex1 = new GnMapPoint($json->{"Vertex1"});
            $this->Vertex2 = new GnMapPoint($json->{"Vertex2"});
            $this->Vertex3 = new GnMapPoint($json->{"Vertex3"});
        }
    }

    /**
     * @var int
     */
    public $Zoom = 0;

    /**
     * @var GnMapPoint
     */
    public $Center = NULL;

    /**
     * @var GnMapPoint
     */
    public $Vertex0 = NULL;

    /**
     * @var GnMapPoint
     */
    public $Vertex1 = NULL;

    /**
     * @var GnMapPoint
     */
    public $Vertex2 = NULL;

    /**
     * @var GnMapPoint
     */
    public $Vertex3 = NULL;
}
