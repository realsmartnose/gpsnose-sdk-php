<?php

namespace GpsNose\SDK\Mashup\Model;

use GpsNose\SDK\Mashup\Framework\GnUtil;
use GpsNose\SDK\Mashup\Model\CreatedEntities\GnTrackType;

class GnNews
{
    /**
     * GnNews __construct
     *
     * @param object $json
     */
    public function __construct($json = null)
    {
        if ($json != null) {
            $this->NewsType = GnUtil::GetSaveProperty($json, "NewsType");
            $this->CreationTicks = GnUtil::GetSaveProperty($json, "CreationTicks");
            $this->Title = GnUtil::GetSaveProperty($json, "Title");
            $this->Description = GnUtil::GetSaveProperty($json, "Description");
            $this->Creator = GnUtil::GetSaveProperty($json, "Creator");
            $this->Keywords = GnUtil::GetSaveProperty($json, "Keywords");
            $this->IsNowDeleted = GnUtil::GetSaveProperty($json, "IsNowDeleted");
            $this->TargetCommunity = GnUtil::GetSaveProperty($json, "TargetCommunity");

            // about
            $this->About_NewAbout = GnUtil::GetSaveProperty($json, "About_NewAbout");

            // profile-image
            $this->ProfileImage_WasDataUploaded = GnUtil::GetSaveProperty($json, "ProfileImage_WasDataUploaded");

            // published-poi
            $this->PoiPublished_Latitude = floatval(GnUtil::GetSaveProperty($json, "PoiPublished_Latitude"));
            $this->PoiPublished_Longitude = floatval(GnUtil::GetSaveProperty($json, "PoiPublished_Longitude"));
            $this->PoiPublished_Name = GnUtil::GetSaveProperty($json, "PoiPublished_Name");
            $this->PoiPublished_CreationTicks = GnUtil::GetSaveProperty($json, "PoiPublished_CreationTicks");

            // rating
            $this->Rating_Comment = GnUtil::GetSaveProperty($json, "Rating_Comment");
            $this->Rating_Percent = GnUtil::GetSaveProperty($json, "Rating_Percent") + 0;
            $this->Rating_RatedItemId = GnUtil::GetSaveProperty($json, "Rating_RatedItemId");
            $this->Rating_RatedItemName = GnUtil::GetSaveProperty($json, "Rating_RatedItemName");
            $this->Rating_RatedItemType = GnUtil::GetSaveProperty($json, "Rating_RatedItemType");
            $this->Rating_RatedItemLatitude = floatval(GnUtil::GetSaveProperty($json, "Rating_RatedItemLatitude"));
            $this->Rating_RatedItemLongitude = floatval(GnUtil::GetSaveProperty($json, "Rating_RatedItemLongitude"));

            // impressions
            $this->Impression_CreationTicks = GnUtil::GetSaveProperty($json, "Impression_CreationTicks");
            $this->Impression_Mood = GnUtil::GetSaveProperty($json, "Impression_Mood");
            $this->Impression_Text = GnUtil::GetSaveProperty($json, "Impression_Text");
            $this->Impression_IsNavigable = GnUtil::GetSaveProperty($json, "Impression_IsNavigable");

            // comments
            $this->Comment_Mood = GnUtil::GetSaveProperty($json, "Comment_Mood");
            $this->Comment_Text = GnUtil::GetSaveProperty($json, "Comment_Text");
            $this->Comment_CommentItemId = GnUtil::GetSaveProperty($json, "Comment_CommentItemId");
            $this->Comment_CommentItemName = GnUtil::GetSaveProperty($json, "Comment_CommentItemName");
            $this->Comment_CommentItemType = GnUtil::GetSaveProperty($json, "Comment_CommentItemType");
            $this->Comment_CommentItemLatitude = floatval(GnUtil::GetSaveProperty($json, "Comment_CommentItemLatitude"));
            $this->Comment_CommentItemLongitude = floatval(GnUtil::GetSaveProperty($json, "Comment_CommentItemLongitude"));

            // tours
            $this->Track_CreationTicks = GnUtil::GetSaveProperty($json, "Track_CreationTicks");
            $this->Track_Name = GnUtil::GetSaveProperty($json, "Track_Name");
            $this->Track_Description = GnUtil::GetSaveProperty($json, "Track_Description");
            $this->Track_StartLatitude = floatval(GnUtil::GetSaveProperty($json, "Track_StartLatitude"));
            $this->Track_StartLongitude = floatval(GnUtil::GetSaveProperty($json, "Track_StartLongitude"));
            $this->Track_StartAltitude = floatval(GnUtil::GetSaveProperty($json, "Track_StartAltitude"));
            $this->Track_TrackType = GnUtil::GetSaveProperty($json, "Track_TrackType") + 0;

            // events
            $this->Event_CreationTicks = GnUtil::GetSaveProperty($json, "Event_CreationTicks");
            $this->Event_Name = GnUtil::GetSaveProperty($json, "Event_Name");
            $this->Event_Description = GnUtil::GetSaveProperty($json, "Event_Description");
            $this->Event_LocationAddress = GnUtil::GetSaveProperty($json, "Event_LocationAddress");
            $this->Event_Latitude = floatval(GnUtil::GetSaveProperty($json, "Event_Latitude"));
            $this->Event_Longitude = floatval(GnUtil::GetSaveProperty($json, "Event_Longitude"));

            // mashup
            $this->Mashup_CommunityTag = GnUtil::GetSaveProperty($json, "Mashup_CommunityTag");
        }
    }

    /**
     * @var int
     */
    public $NewsType = 0;

    /**
     * @var string
     */
    public $CreationTicks = "0";

    /**
     * @var string
     */
    public $Title = "";

    /**
     * @var string
     */
    public $Description = "";

    /**
     * not set in user-scoped-news
     *
     * @var string
     */
    public $Creator = "";

    /**
     * @var string
     */
    public $Keywords = "";

    /**
     * @var bool
     */
    public $IsNowDeleted = false;

    /**
     * not set in user-scoped-news
     *
     * @var string
     */
    public $TargetCommunity = "";

    // about

    /**
     * @var string
     */
    public $About_NewAbout = "";

    // profile-image

    /**
     * @var bool
     */
    public $ProfileImage_WasDataUploaded = false;

    // published-poi

    /**
     * @var float
     */
    public $PoiPublished_Latitude = 0.0;

    /**
     * @var float
     */
    public $PoiPublished_Longitude = 0.0;

    /**
     * @var string
     */
    public $PoiPublished_Name = "";

    /**
     * @var string
     */
    public $PoiPublished_CreationTicks = "0";

    // rating

    /**
     * @var string
     */
    public $Rating_Comment = "";

    /**
     * @var int
     */
    public $Rating_Percent = 0;

    /**
     * @var string
     */
    public $Rating_RatedItemId = "";

    /**
     * @var string
     */
    public $Rating_RatedItemName = "";

    /**
     * @var string
     */
    public $Rating_RatedItemType = "";

    /**
     * @var float
     */
    public $Rating_RatedItemLatitude = 0.0;

    /**
     * @var float
     */
    public $Rating_RatedItemLongitude = 0.0;

    // blogs

    /**
     * @var string
     */
    public $Impression_CreationTicks = "0";

    /**
     * @var string
     */
    public $Impression_Mood = "";

    /**
     * @var string
     */
    public $Impression_Text = "";

    /**
     * @var bool
     */
    public $Impression_IsNavigable = false;

    // comments

    /**
     * @var string
     */
    public $Comment_Mood = "";

    /**
     * @var string
     */
    public $Comment_Text = "";

    /**
     * @var string
     */
    public $Comment_CommentItemId = "";

    /**
     * @var string
     */
    public $Comment_CommentItemName = "";

    /**
     * @var string
     */
    public $Comment_CommentItemType = "";

    /**
     * @var float
     */
    public $Comment_CommentItemLatitude = 0.0;

    /**
     * @var float
     */
    public $Comment_CommentItemLongitude = 0.0;

    // tours

    /**
     * @var string
     */
    public $Track_CreationTicks = "0";

    /**
     * @var string
     */
    public $Track_Name = "";

    /**
     * @var string
     */
    public $Track_Description = "";

    /**
     * @var float
     */
    public $Track_StartLatitude = 0.0;

    /**
     * @var float
     */
    public $Track_StartLongitude = 0.0;

    /**
     * @var float
     */
    public $Track_StartAltitude = 0.0;

    /**
     * @var int
     */
    public $Track_TrackType = GnTrackType::Unspecified;

    // events

    /**
     * @var string
     */
    public $Event_CreationTicks = "0";

    /**
     * @var string
     */
    public $Event_Name = "";

    /**
     * @var string
     */
    public $Event_Description = "";

    /**
     * @var string
     */
    public $Event_LocationAddress = "";

    /**
     * @var float
     */
    public $Event_Latitude = 0.0;

    /**
     * @var float
     */
    public $Event_Longitude = 0.0;

    // mashup

    /**
     * @var string
     */
    public $Mashup_CommunityTag = "";
}
