<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Characteristic extends Model
{
    protected $table = 'characteristics';

    protected $guarded = [];

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
