<?php
namespace GpsNose\SDK\Mashup\Model;

class GnResponseType
{
    const Json = 0;
    const Boolean = 1;
    const Number = 2;
    const String = 3;

    const GnLogin = 10;
    const GnCommunity = 11;
    const GnComment = 12;

    const ListGnMashup = 20;
    const ListGnNose = 21;
    const ListGnNews = 22;
    const ListGnMembers = 23;
    const ListGnImpression = 24;
    const ListGnPoI = 25;
    const ListGnEvent = 26;
    const ListGnTrack = 27;
    const ListGnComment = 28;
    const ListGnMashupToken = 29;
}