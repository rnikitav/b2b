<?php

$url = 'https://www.somehost.com/test/index.html?param1=4&param2=3&param3=2&param4=1&param5=3';
$result = 'https://www.somehost.com/?param4=1&param3=2&param1=4&url=%2Ftest%2Findex.html';
$delEl = '3';

if ($result === prepareUrl($url,$delEl)) {
    echo "Ok";
}


/**
 * Подготавливает URL строку
 * @param $url string
 * @param $delEl string
 * @return string
 */
function prepareUrl(string $url, string $delEl): string
{
    $parsed_url = parse_url($url);
    $scheme   = isset($parsed_url['scheme']) ? $parsed_url['scheme'] . '://' : '';
    $host     = $parsed_url['host'] ?? '';
    $path     = $parsed_url['path'] ?? '';
    $query    = $parsed_url['query'] ?? '';
    $query = prepareQueryParams($query, $delEl);
    return $scheme . $host . '/?'. $query . '&url=' . urlencode($path);
}

/**
 * Подготавливает строку с параметрами
 * @param $query string
 * @param $delEl string
 * @return string
 */
function prepareQueryParams(string $query, string $delEl): string
{
    parse_str($query, $res);
    foreach ($res as $key => $value){
        if ($value != $delEl){
            $result[$key] = $value;
        }
    }
    asort($result);
    return http_build_query($result);
}
