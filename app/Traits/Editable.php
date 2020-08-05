<?php

namespace App\Traits;

use App\Editable\Checkbox;
use App\Editable\Input;
use App\Editable\Select;

trait Editable
{
    public function editable(string $field)
    {
        $value = $this->$field;
        $model = $this;

        return (new Input($model))->value($value)->field($field);
    }

    public function switch(string $field)
    {
        $isCheck = $this->$field;
        $model = $this;

        return (new Checkbox($model))->value($isCheck)->field($field);
    }

    public function select(string $field, $options): Select
    {
        $value = $this->$field;
        $model = $this;

        return (new Select($model))->value($value)->options($options)->field($field);
    }

    public static function toOptions(string $valueField = 'name', string $keyField = 'id', callable $callback = null): array
    {
        return self::when(!is_null($callback), $callback)
            ->get()
            ->mapWithKeys(function ($item) use ($valueField, $keyField) {
                return [
                    $item->{$keyField} => $item->{$valueField}
                ];
            })
            ->toArray();
    }
}