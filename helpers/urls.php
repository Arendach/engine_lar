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
function uri($part, $parameters = null, $hash = null): string
{
    $url = trim($part, '/');

    if (preg_match('~@~', $url)) {
        [$controller, $action] = explode('@', $url);

        $controller = preg_replace('~Controller$~', '', $controller);
        $action = preg_replace('~^(action|section|api)~', '', $action);

        $controller = c2s($controller);
        $action = c2s($action);

        $url = "$controller/$action";
    }

    if (is_array($parameters))
        $url .= parameters($parameters);

    if ($hash != '')
        $url .= '#' . $hash;


    return '/' . $url;
}