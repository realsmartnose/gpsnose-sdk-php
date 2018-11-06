<?php
namespace GpsNose\Framework;

class GnUtility
{

    public static function GetQueryStringFromKeyVals(string $url, array $keyVals)
    {
        if ($url == null) {
            throw new \InvalidArgumentException('url');
        }

        if ($keyVals == null) {
            throw new \InvalidArgumentException('keyVals');
        }

        $anchorIndex = strpos($url, '#');
        $resultUri = $url;
        $anchorText = "";
        if ($anchorIndex !== false) {
            $anchorText = substr($url, $anchorIndex);
            $resultUri = substr($url, 0, $anchorIndex);
        }

        $queryIndex = strpos($resultUri, '?');
        $hasQuery = $queryIndex !== false;

        $sb = '';
        $sb .= $resultUri;
        foreach ($keyVals as $keyKey => $keyVal) {
            $sb .= $hasQuery ? '&' : '?';
            $sb .= urlencode($keyKey);
            $sb .= '=';
            $sb .= urlencode($keyVal);
            $hasQuery = true;
        }

        $sb .= $anchorText;

        return $sb;
    }
}