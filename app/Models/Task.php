<?php

namespace App\Models;

use App\Traits\DateHuman;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Task
 *
 * @property int $id
 * @property int $user
 * @property int $author
 * @property string $date
 * @property string $content
 * @property string $type
 * @property int $success
 * @property string $comment
 * @property float $price
 * @property int $approve
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereApprove($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereSuccess($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereUser($value)
 * @mixin \Eloquent
 * @property int $user_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property int $is_success
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereIsSuccess($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereUserId($value)
 * @property int $author_id
 * @property int $is_approve
 * @property-read string $created_date_human
 * @property-read mixed $status_name
 * @property-read string $updated_date_human
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task my()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Task whereIsApprove($value)
 */
class Task extends Model
{
    use DateHuman;

    protected $table = 'tasks';

    protected $fillable = [
        'user_id',
        'author_id',
        'created_at',
        'updated_at',
        'content',
        'type',
        'is_success',
        'comment',
        'price',
        'is_approve'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function getStatusNameAttribute()
    {
        if ($this->success == 0) {
            return '<span class="text-primary">Чекає на виконання</span>';
        } elseif ($this->success == 1) {
            return '<span class="text-success">Виконано</span>';
        } else {
            return '<span class="text-danger">Не виконано</span>';
        }
    }

    public function scopeMy(Builder $query): void
    {
        $query->where('user_id', user()->id);
    }
}
