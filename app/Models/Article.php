<?php

namespace App\Models;

use App\Traits\DateHuman;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Article
 *
 * @property int $id
 * @property string $title
 * @property string $type
 * @property string $short_content
 * @property string $content
 * @property int $author_id
 * @property int $is_comment
 * @property int $priority
 * @property int $is_fixed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $author
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article articles()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article news()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereIsComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereIsFixed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereShortContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read mixed $created_date_human
 * @property-read mixed $updated_date_human
 * @property-read mixed $type_name
 */
class Article extends Model
{
    use DateHuman;
    /**
     * @var string
     */
    protected $table = 'articles';

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'type',
        'short_content',
        'content',
        'author_id',
        'is_comment',
        'priority',
        'is_fixed',
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
     * @var array
     */
    public $types = [
        'news'    => 'Новина',
        'article' => 'Стаття'
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
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * @param Builder $query
     */
    public function scopeArticles(Builder $query): void
    {
        $query->where('type', 'article');
    }

    /**
     * @param Builder $query
     */
    public function scopeNews(Builder $query): void
    {
        $query->where('type', 'news');
    }


    /**
     * @return string|null
     */
    public function getTypeNameAttribute(): ?string
    {
        return $this->types[$this->type] ?? null;
    }
}