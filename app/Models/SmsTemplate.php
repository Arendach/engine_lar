<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class SmsTemplate extends Model
{
    protected $table = 'sms_templates';

    public $timestamps = false;
    /*
        protected $fillable = [
            'name',
            'text',
            'type'
        ];*/

    protected $guarded = [];

    public function scopeType(Builder $query, string $type): void
    {
        $query->where('type', $type);
    }
}