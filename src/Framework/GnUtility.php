<?php
namespace GpsNose\Framework;

class GnUtility
{

    /**
     * Returns the value of a param from a query-string
     *
     * @param string $url
     * @param array $keyVals
     * @return string
     */
    public static function GetQueryStringFromKeyVals(string $url, array $keyVals)
    {
        if ($url == NULL) {
            throw new \InvalidArgumentException('url');
        }

        if ($keyVals == NULL) {
            throw new \InvalidArgumentException('keyVals');
        }

        $anchorIndex = strpos($url, '#');
        $resultUri = $url;
        $anchorText = "";
        if ($anchorIndex !== FALSE) {
            $anchorText = substr($url, $anchorIndex);
            $resultUri = substr($url, 0, $anchorIndex);
        }

        $queryIndex = strpos($resultUri, '?');
        $hasQuery = $queryIndex !== FALSE;

        $sb = '';
        $sb .= $resultUri;
        foreach ($keyVals as $keyKey => $keyVal) {
            $sb .= $hasQuery ? '&' : '?';
            $sb .= urlencode($keyKey);
            $sb .= '=';
            $sb .= urlencode($keyVal);
            $hasQuery = TRUE;
        }

        $sb .= $anchorText;

        return $sb;
    }
}
