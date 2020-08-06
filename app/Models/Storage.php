<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Storage extends Model
{
    use SoftDeletes;

    protected $table = 'storage';
    protected $guarded = [];
    public $timestamps = false;

    public function builder(): array
    {
        return [
            'title'  => 'Склади',
            'model'  => Storage::class,
            'fields' => [
                'is_delivery' => [
                    'title' => 'Показувати в доставках',
                    'type'  => 'boolean'
                ],
                'is_self'     => [
                    'title' => 'Показувати в самовивозах',
                    'type'  => 'boolean'
                ],
                'is_sending'  => [
                    'title' => 'Показувати в відправках',
                    'type'  => 'boolean'
                ],
                'name'        => [
                    'type'     => 'text',
                    'title'    => 'Назва',
                    'required' => true
                ],
                'priority'    => [
                    'type'  => 'text',
                    'title' => 'Пріоритет'
                ],
                'info'        => [
                    'type'  => 'text',
                    'title' => 'Значення'
                ]
            ]
        ];
    }
}