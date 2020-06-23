<?php

namespace App\Traits;

use Exception;
use Carbon\Carbon;

trait DateHuman
{
    public function getCreatedDateHumanAttribute(): string
    {
        return date_for_humans($this->created_at->format('Y-m-d'));
    }

    public function getUpdatedDateHumanAttribute(): string
    {
        return date_for_humans($this->updated_at->format('Y-m-d'));
    }

    public function human(string $field = 'created_at', bool $withTime = false): ?string
    {
        if (!($this->$field instanceof Carbon)) {
            throw new Exception("Field $field is not date field");
        }

        return $withTime
            ? date_for_humans($this->{$field}->format('Y-m-d')) . ' в ' . $this->$field->format('H:i')
            : date_for_humans($this->{$field}->format('Y-m-d'));
    }
}