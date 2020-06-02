<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StorageId extends Model
{
    protected $table = 'storage_ids';

    protected $guarded = [];
    // protected $fillable = ['level1', 'level2'];

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
