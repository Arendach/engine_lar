<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
 */
class Task extends Model
{
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
        'approve'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
