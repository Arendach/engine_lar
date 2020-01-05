<?php

namespace App\Traits;

trait DateHuman
{
    /**
     * @return string
     */
    public function getCreatedDateHumanAttribute(): string
    {
        return date_for_humans($this->created_at->format('Y-m-d'));
    }

    /**
     * @return string
     */
    public function getUpdatedDateHumanAttribute(): string
    {
        return date_for_humans($this->updated_at->format('Y-m-d'));
    }
}