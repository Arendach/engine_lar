<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SmsMessage
 *
 * @property int $id
 * @property int $order_id
 * @property string $text
 * @property string $date
 * @property int $message_id
 * @property string $phone
 * @property string $status
 * @property-read mixed $status_name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsMessage whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsMessage whereMessageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsMessage whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsMessage wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsMessage whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsMessage whereText($value)
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsMessage whereUpdatedAt($value)
 */
class SmsMessage extends Model
{
    protected $table = 'sms_messages';

    protected $fillable = [
        'order_id',
        'text',
        'created_at',
        'updated_at',
        'message_id',
        'phone',
        'status'
    ];

    public $timestamps = true;

    public function getStatusNameAttribute()
    {
        return assets('sms_statuses')[$this->status] ?? 'Невідмий';
    }
}