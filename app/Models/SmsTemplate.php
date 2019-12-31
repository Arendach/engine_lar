<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SmsTemplate
 *
 * @property int $id
 * @property string $name
 * @property string $text
 * @property string $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsTemplate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsTemplate whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsTemplate whereType($value)
 * @mixin \Eloquent
 */
class SmsTemplate extends Model
{
    protected $table = 'sms_templates';

}