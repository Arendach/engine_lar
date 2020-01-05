<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\ArticleView
 *
 * @property int $id
 * @property int $user_id
 * @property int $article_id
 * @property int $is_viewed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleView newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleView newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleView query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleView whereArticleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleView whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleView whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleView whereIsViewed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleView whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleView whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Article $article
 * @property-read \App\Models\User $user
 */
class ArticleView extends Model
{
    /**
     * @var string
     */
    protected $table = 'article_views';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'article_id',
        'is_viewed',
        'created_at',
        'updated_at'
    ];

    /**
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * @return BelongsTo
     */
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}