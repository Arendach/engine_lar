<?php

/**
 * @param array $parameters
 * @return string
 */
function parameters(array $parameters): string
{
    $string = '?';
    foreach ($parameters as $key => $value) $string .= "$key=$value&";

    return trim($string, '&');
}

/**
 * @param array $parameters
 * @return null|string|string[]
 */
function params(array $parameters)
{
    return preg_replace('@^\?@', '', parameters($parameters));
}

/**
 * @param $part
 * @param string $parameters
 * @param string $hash
 * @return string
 */
function uri($part, $parameters = '', $hash = '')
{
    $str = trim($part, '/');

    if (is_array($parameters))
        $str .= parameters($parameters);

    if ($hash != '')
        $str .= '#' . $hash;

    return '/' . $str;
}