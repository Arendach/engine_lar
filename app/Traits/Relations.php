<?php

namespace App\Traits;

use App\Models\Model;
use Illuminate\Database\Eloquent\Collection;

trait Relations
{
    public function existsRelation(string $key): bool
    {
        if (!$this->relationLoaded($key)) {
            return false;
        }

        $relation = $this->getRelation($key);

        if ($relation instanceof Collection) {
            return (bool)$relation->count() > 0;
        }

        if ($relation instanceof Model) {
            return true;
        }

        return false;
    }
}