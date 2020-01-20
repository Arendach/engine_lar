<?php

include __DIR__ . '/constants.php';
include __DIR__ . '/router.php';
include __DIR__ . '/date.php';
include __DIR__ . '/blade.php';
include __DIR__ . '/filesystem.php';
include __DIR__ . '/urls.php';

/**
 * @param string $key
 * @return bool
 */
function cannot(string $key = 'ROOT'): bool
{
    return !can($key);
}

/**
 * Перевірка користувача на наявніть ключа доступу
 *
 * @param string $key
 * @return bool
 */
function can(string $key = 'ROOT'): bool
{
    return user()->accessCheck($key);
}

/**
 * @param array $array
 * @return bool
 */
function can_keys(array $array)
{
    foreach ($array as $key)
        if (cannot($key))
            return false;

    return true;
}

/**
 * @param int $id
 * @return \App\Models\User|\App\Models\User[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
 */
function user($id = 0)
{
    if ($id === 'all') {
        return \App\Models\User::all();
    }

    if ($id > 0)
        return \App\Models\User::find($id);

    return User::get();
}

/**
 * Возвращает сумму прописью
 * @author runcore
 * @uses morph(...)
 */
function num2str($num)
{
    $nul = 'нуль';
    $ten = array(
        array('', 'один', 'два', 'три', 'чотири', 'пять', 'шість', 'сім', 'вісім', 'девять'),
        array('', 'одна', 'дві', 'три', 'чотири', 'пять', 'шість', 'сім', 'вісім', 'девять'),
    );
    $a20 = array('десять', 'одиннадцать', 'дванадцать', 'тринадцать', 'чотирнадцать', 'пятнадцать', 'шістнадцать', 'сімнадцать', 'вісімнадцать', 'девятнадцять');
    $tens = array(2 => 'двадцать', 'тридцать', 'сорок', 'пятдесят', 'шістьдесят', 'сімдесят', 'вісімьдесят', 'девяносто');
    $hundred = array('', 'сто', 'двісті', 'триста', 'чотириста', 'пятсот', 'шістсот', 'сімсот', 'вісімсот', 'девятсот');
    $unit = array( // Units
        array('копійка', 'копійки', 'копійок', 1),
        array('гривня', 'гривні', 'гривнів', 0),
        array('тисяча', 'тисячі', 'тисяч', 1),
        array('мільйон', 'мільйони', 'мільйонів', 0),
        array('мільярд', 'мільярди', 'мільярдів', 0),
    );
    //
    list($rub, $kop) = explode('.', sprintf("%015.2f", floatval($num)));
    $out = array();
    if (intval($rub) > 0) {
        foreach (str_split($rub, 3) as $uk => $v) { // by 3 symbols
            if (!intval($v)) continue;
            $uk = sizeof($unit) - $uk - 1; // unit key
            $gender = $unit[$uk][3];
            list($i1, $i2, $i3) = array_map('intval', str_split($v, 1));
            // mega-logic
            $out[] = $hundred[$i1]; # 1xx-9xx
            if ($i2 > 1) $out[] = $tens[$i2] . ' ' . $ten[$gender][$i3]; # 20-99
            else $out[] = $i2 > 0 ? $a20[$i3] : $ten[$gender][$i3]; # 10-19 | 1-9
            // units without rub & kop
            if ($uk > 1) $out[] = morph($v, $unit[$uk][0], $unit[$uk][1], $unit[$uk][2]);
        } //foreach
    } else $out[] = $nul;
    $out[] = morph(intval($rub), $unit[1][0], $unit[1][1], $unit[1][2]); // rub
    $out[] = $kop . ' ' . morph($kop, $unit[0][0], $unit[0][1], $unit[0][2]); // kop
    return trim(preg_replace('/ {2,}/', ' ', join(' ', $out)));
}

/**
 * Склоняем словоформу
 * @author runcore
 */
function morph($n, $f1, $f2, $f5)
{
    $n = abs(intval($n)) % 100;
    if ($n > 10 && $n < 20) return $f5;
    $n = $n % 10;
    if ($n > 1 && $n < 5) return $f2;
    if ($n == 1) return $f1;
    return $f5;
}

/**
 * @param $phone
 * @return string
 */
function get_number_world_format($phone)
{
    if (preg_match('/\+38[0-9]{10,10}/', $phone)) {
        return $phone;
    }

    if (preg_match('@38[0-9]{10,10}@', $phone)) {
        return '+' . $phone;
    }

    if (preg_match('@[0-9]{10,10}@', $phone)) {
        return '+38' . $phone;
    }

    if (preg_match('@[0-9]{9,9}@', $phone)) {
        return '+380' . $phone;
    }

    return 'error!!';
}

/**
 * @return string
 */
function rand32(): string
{
    return md5(md5(rand(1000, 9999) . date('YmdHis') . rand(10000, 99999)));
}

/**
 * Point to slash
 *
 * @param $str
 * @return mixed
 */
function p2s(string $str): string
{
    $str = str_replace('.js', '', $str);
    $str = str_replace('.css', '', $str);
    $str = str_replace('.', '/', $str);
    return (string)$str;
}


/**
 * snake_case to CamelCase
 *
 * @param string $str
 * @return string
 */
function s2c(string $str): string
{
    $str = ucwords($str, "_");
    $str = str_replace('_', '', $str);
    return ($str);
}

/**
 * CamelCase to snake_case
 *
 * @param string $str
 * @return string
 */
function c2s(string $str): string
{
    preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $str, $matches);
    $ret = $matches[0];
    foreach ($ret as &$match) {
        $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
    }
    return implode('_', $ret);

}

function time_load_stat()
{
    create_folder('/server/stat/');
    $file = fopen(ROOT . '/server/stat/' . date('Y-m-d') . '.txt', 'a+');

    if (preg_match('/\/[a-zA-Z_]+/', $_SERVER['REQUEST_URI'], $matches)) {
        $controller = $matches[0];
    } else {
        $controller = 'Undefined';
    }

    $string = $_SERVER['REQUEST_METHOD'];
    $string .= '@';
    $string .= $controller;
    $string .= '@';
    $string .= $_SERVER['REQUEST_URI'];
    $string .= '@';
    $string .= round(microtime(1) - START, 3);
    $string .= PHP_EOL;

    fwrite($file, $string);

    fclose($file);
}

/**
 * Створює папку якщо не існує
 *
 * @param string $name
 */
function create_folder(string $name): void
{
    if (!file_exists(ROOT . $name))
        mkdir(ROOT . $name, 0777, true);
}

/**
 * Створює файл якщо не існує
 *
 * @param string $name
 * @param string $content
 */
function create_file(string $name, string $content = '')
{
    if (!file_exists(ROOT . $name)) {
        $fp = fopen(ROOT . $name, 'w');
        fwrite($fp, $content);
        fclose($fp);
    }
}

function count_working_days($year = null, $month = null): int
{
    if ($year == null) $year = date('Y');
    if ($month == null) $month = date('m');

    $working_days = 0;
    $count_days = date('t', strtotime($year . '-' . $month . '-01'));

    for ($i = 1; $i <= $count_days; $i++) {
        $day = date('D', strtotime($year . '-' . $month . '-' . $i));
        if ($day != 'Sat' && $day != 'Sun') $working_days++;
    }

    return $working_days;
}

function count_holidays($year = null, $month = null)
{
    if ($year == null) $year = date('Y');
    if ($month == null) $month = date('m');

    $working_days = count_working_days($year, $month);

    $holidays = date('t', strtotime($year . '-' . $month . '-1')) - $working_days;

    return $holidays;
}

/**
 * @param string $asset
 * @return array
 */
function assets(string $asset): array
{
    return require base_path("assets/$asset.php");
}