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
    public function __construct($json = null)
    {
        if ($json != null) {
            $this->Zoom = GnUtil::GetSaveProperty($json, "Zoom") + 0;
            $this->Center = new GnMapPoint(GnUtil::GetSaveProperty($json, "Center"));
            $this->Vertex0 = new GnMapPoint(GnUtil::GetSaveProperty($json, "Vertex0"));
            $this->Vertex1 = new GnMapPoint(GnUtil::GetSaveProperty($json, "Vertex1"));
            $this->Vertex2 = new GnMapPoint(GnUtil::GetSaveProperty($json, "Vertex2"));
            $this->Vertex3 = new GnMapPoint(GnUtil::GetSaveProperty($json, "Vertex3"));
        }
    }

    /**
     * @var int
     */
    public $Zoom = 0;

    /**
     * @var GnMapPoint
     */
    public $Center = null;

    /**
     * @var GnMapPoint
     */
    public $Vertex0 = null;

    /**
     * @var GnMapPoint
     */
    public $Vertex1 = null;

    /**
     * @var GnMapPoint
     */
    public $Vertex2 = null;

    /**
     * @var GnMapPoint
     */
    public $Vertex3 = null;
}
