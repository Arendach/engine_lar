<?php

/**
 * @param $variable
 * @param $data
 * @return string
 */
function blade_share($variable, $data): string
{
    if (is_numeric($data)) {
        $exp = "window.$variable = $data;";
    } elseif (is_string($data)) {
        $exp = "window.$variable = '$data;";
    } elseif (is_array($data)) {
        $encode = json_encode($data);
        $exp = "window.$variable = $encode;";
    } else {
        $exp = '';
    }

    return "<script>$exp</script>";
}

/**
 * @param mixed $param1
 * @param null|mixed $param2
 * @return string
 */
function blade_selected($param1, $param2 = null): string
{
    if (is_bool($param1)) {
        return $param1 ? 'selected' : '';
    } else {
        return request()->get($param1) === $param2 ? 'selected' : '';
    }
}

/**
 * @param bool $boolean
 * @param $statement
 * @return string
 */
function blade_display_if(bool $boolean, $statement): string
{
    return $boolean ? $statement : '';
}

/**
 * @param array $data
 * @return string
 */
function blade_data(array $data): string
{
    $result = '';
    foreach ($data as $key => $value) {
        if (is_array($value)) $value = params($value);
        $result .= " data-$key=\"$value\" ";
    }

    return $result;
}