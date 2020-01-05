<?php

namespace App\Models;

use App\Traits\DateHuman;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\ArticleComment
 *
 * @property int $id
 * @property int $author_id
 * @property int $article_id
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Article $article
 * @property-read \App\Models\User $author
 * @property-read string $created_date_human
 * @property-read string $updated_date_human
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleComment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleComment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleComment whereArticleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleComment whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleComment whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleComment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleComment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ArticleComment extends Model
{
    use DateHuman;

    /**
     * @var string
     */
    protected $table = 'article_comments';

    /**
     * @var array
     */
    protected $fillable = [
        'author_id',
        'article_id',
        'content',
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
     * @var bool
     */
    public $timestamps = true;

    /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }
}