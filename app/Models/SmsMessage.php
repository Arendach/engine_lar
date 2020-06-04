<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsMessage extends Model
{
    protected $table = 'sms_messages';

/*    protected $fillable = [
        'order_id',
        'text',
        'created_at',
        'updated_at',
        'message_id',
        'phone',
        'status'
    ];*/

    protected $guarded = [];

    public $timestamps = true;

    public function getStatusNameAttribute()
    {
        return assets('sms_statuses')[$this->status] ?? 'Невідмий';
    }
}