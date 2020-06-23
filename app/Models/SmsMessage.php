<?php

namespace App\Models;

class SmsMessage extends Model
{
    protected $guarded = [];

    public function getStatusNameAttribute()
    {
        return assets('sms_statuses')[$this->status] ?? 'Невідмий';
    }
}