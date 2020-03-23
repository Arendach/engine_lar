<?php

namespace App\Traits;

use Exception;

trait NumberFormat
{
    public function numberFormat(string $field): string
    {
        if (!is_numeric($this->$field)) {
            throw new Exception("Field $field is not numeric");
        }

        return number_format($this->$field);
    }
}