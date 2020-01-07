<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\StorageId
 *
 * @property int $id
 * @property string $level1
 * @property string $level2
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StorageId newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StorageId newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StorageId query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StorageId whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StorageId whereLevel1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StorageId whereLevel2($value)
 * @mixin \Eloquent
 */
class StorageId extends Model
{
    protected $table = 'storage_ids';

    protected $fillable = ['level1', 'level2'];

    public $timestamps = false;

    public static function tree()
    {
        $items = StorageId::all();

        $result = [];
        foreach ($items as $item) {
            $level1 = trim($item->level1);
            $level2 = trim($item->level2);

            if (!isset($result[$level1])) {
                $result[$level1] = [];
            }

            $result[$level1][] = $level2;
        }

        return $result;
    }
}
