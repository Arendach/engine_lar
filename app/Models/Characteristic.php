<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Characteristic
 *
 * @property int $id
 * @property string $name
 * @property string|null $prefix
 * @property string|null $postfix
 * @property string|null $value
 * @property string $name_ru
 * @property string|null $prefix_ru
 * @property string|null $postfix_ru
 * @property string|null $value_ru
 * @property string $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic wherePostfix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic wherePostfixRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic wherePrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic wherePrefixRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic whereValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic whereValueRu($value)
 * @mixin \Eloquent
 */
class Characteristic extends Model
{
    protected $table = 'characteristics';

    protected $fillable = [
        'name',
        'prefix',
        'postfix',
        'value',
        'name_ru',
        'prefix_ru',
        'postfix_ru',
        'type'
    ];

    public $timestamps = false;

    private $types = [
        'slider'          => 'Слайдер',
        'slider-diapason' => 'Слайдер-Діапазон',
        'switch'          => 'Перемикач',
        'flags'           => 'Прапорець'
    ];

    public static function getTypes()
    {
        return (new static)->types;
    }
}
