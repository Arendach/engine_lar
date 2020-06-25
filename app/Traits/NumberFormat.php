<?php

namespace App\Traits;

use Exception;

trait NumberFormat
{
    public function numberFormat($field): ?string
    {
        if (is_string($field) && is_numeric($this->$field)) {
            return number_format($this->$field);
        }

        if (is_numeric($field)) {
            return number_format($field);
        }

        if (is_null($this->$field)) {
            return '0';
        }

        throw new Exception("Field is not numeric");
    }
}