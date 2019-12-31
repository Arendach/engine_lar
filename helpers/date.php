<?php

/**
 * @param $int
 * @return string
 */
function month_valid($int)
{
    if (mb_strlen($int) == 1) return "0" . $int;
    else return $int;
}


/**
 * Кількість днів в місяці
 *
 * @param int $month
 * @param int $year
 * @return int
 */
function day_in_month(int $month, int $year): int
{
    return (int)date('t', strtotime("$year-$month-01"));
}

/**
 * @param bool $string
 * @return string
 */
function date_for_humans($string = false): string
{
    if ($string == false) {
        return date('d') . ' ' . int_to_month(date('m'), 1) . ' ' . date('Y');
    } else {
        $date = date_parse($string);
        if (date('Y') != $date['year'])
            return $date['day'] . ' ' . int_to_month($date['month'], 1) . ' ' . $date['year'];
        else
            return $date['day'] . ' ' . int_to_month($date['month'], 1);
    }
}

/**
 * Назва місяця(укр)
 *
 * @param int $int
 * @param bool $v
 * @return string
 */
function int_to_month(int $int, bool $v = false): string
{
    if ($int == 1) {
        return $v ? 'Січня' : 'Січень';
    } elseif ($int == 2) {
        return $v ? 'Лютого' : 'Лютий';
    } elseif ($int == 3) {
        return $v ? 'Березня' : 'Березень';
    } elseif ($int == 4) {
        return $v ? 'Квітня' : 'Квітень';
    } elseif ($int == 5) {
        return $v ? 'Травня' : 'Травень';
    } elseif ($int == 6) {
        return $v ? 'Червня' : 'Червень';
    } elseif ($int == 7) {
        return $v ? 'Липня' : 'Липень';
    } elseif ($int == 8) {
        return $v ? 'Серпня' : 'Серпень';
    } elseif ($int == 9) {
        return $v ? 'Вересня' : 'Вересень';
    } elseif ($int == 10) {
        return $v ? 'Жовтня' : 'Жовтень';
    } elseif ($int == 11) {
        return $v ? 'Листопада' : 'Листопад';
    } elseif ($int == 12) {
        return $v ? 'Грудня' : 'Грудень';
    } else {
        return '';
    }
}

/**
 * Назва дня тижня(укр)
 *
 * @param string $date
 * @return string
 */
function date_to_day(string $date): string
{
    $day = date('D', strtotime($date));
    if ($day == 'Fri') {
        return 'Пятниця';
    } elseif ($day == 'Sat') {
        return 'Субота';
    } elseif ($day == 'Sun') {
        return 'Неділя';
    } elseif ($day == 'Mon') {
        return 'Понеділок';
    } elseif ($day == 'Tue') {
        return 'Вівторок';
    } elseif ($day == 'Wed') {
        return 'Середа';
    } elseif ($day == 'Thu') {
        return 'Четвер';
    }
    return '';
}


/**
 * @param string $str
 * @return string
 */
function string_to_time(string $str): string
{
    if (preg_match('/[0-9]{1,2}:[0-9]{1,2}/', $str)) $str = time_to_string($str);

    if (mb_strlen($str) == 4)
        return $str[0] . $str[1] . ':' . $str[2] . $str[3];
    elseif (mb_strlen($str) == 3)
        return $str[0] . $str[1] . ':' . $str[2] . '0';
    elseif (mb_strlen($str) == 2)
        return $str[0] . $str[1] . ':' . '00';
    else if (mb_strlen($str) == 1)
        return '0' . $str[0] . ':00';

    return '00:00';
}

/**
 * @param string $time
 * @return string
 */
function time_to_string(string $time): string
{
    if (mb_strlen($time) > 5) $time = substr($time, 0, 5);

    if (preg_match('/^([0-9]{1,2}):([0-9]{1,2})$/', $time, $matches)) {
        return $matches[1] . $matches[2];
    } elseif (preg_match('/^[0-9]{1,4}$/', $time, $matches)) {
        return time_to_string(string_to_time($matches[0]));
    }

    return '0000';
}

/**
 * @param string $year
 * @param string $month
 * @return array
 */
function previous_month_with_year(string $year = '', string $month = ''): array
{
    if ($month === '') $month = date('m');
    if ($year === '') $year = date('Y');

    $date = \Carbon\Carbon::parse('first day of previous month');

    return ['month' => $date->month, 'year' => $date->year];
}

/**
 * @param string $year
 * @param string $month
 * @return string
 */
function previous_month(string $year = '', string $month = ''): string
{
    return previous_month_with_year($year, $month)['month'];
}