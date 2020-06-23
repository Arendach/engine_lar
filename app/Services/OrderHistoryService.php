<?php

namespace App\Services;

use App\Models\OrderHistory;
use App\Models\Order;

class OrderHistoryService
{
    /** @var OrderHistory $model */
    private $model;

    /** @var Order $order */
    private $order;

    private $except = [
        'created_at',
        'updated_at'
    ];

    private $relations = [
        'shop_id'               => 'App\Models\Shop',
        'site_id'               => 'App\Models\Site',
        'hint_id'               => 'App\Models\OrderHint',
        'logistic_id'           => 'App\Models\Logistic',
        'courier_id'            => 'App\Models\User',
        'new_post_city_id'      => 'App\Models\NewPostCity',
        'new_post_warehouse_id' => 'App\Models\NewPostWarehouse',
        'order_professional_id' => 'App\Models\OrderProfessional',
        'liable_id'             => 'App\Models\User'
    ];

    private $customMethodsEqual = [
        'time_with' => 'timeEqual',
        'time_to'   => 'timeEqual'
    ];

    private $type = 'update_fields';

    public function __construct()
    {
        $this->model = app(OrderHistory::class);
    }

    public function setModel(Order $order): self
    {
        $this->order = $order;

        return $this;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function update(): Order
    {
        $changes = $this->getUniversalFields();

        if (count($changes) && $this->order->save()) {
            $this->save($changes, $this->type);
        }

        return $this->order;
    }

    public function create(array $products): void
    {
        $data = array_merge($this->order->toArray(), [
            'products' => $products
        ]);

        $this->save($data, 'created');
    }

    private function save(array $data, string $type = 'update_fields'): void
    {
        $this->model->create([
            'data'     => $data,
            'order_id' => $this->order->id,
            'type'     => $type,
            'user_id'  => user()->id
        ]);
    }

    private function getUniversalFields(): array
    {
        $changes = $this->order->getDirty();

        $changes = array_filter($changes, function ($value) {
            return !in_array($value, $this->except);
        }, ARRAY_FILTER_USE_KEY);

        $result = [];
        foreach ($changes as $key => $newValue) {
            $oldValue = $this->order->getOriginal($key);
            $newValue = $this->toType($newValue);

            if (empty($oldValue) && empty($newValue)) {
                continue;
            }

            if (isset($this->customMethodsEqual[$key])) {
                $isEqual = $this->{$this->customMethodsEqual[$key]}($key, $newValue, $oldValue);

                if ($isEqual) {
                    continue;
                }
            }

            if (isset($this->relations[$key])) {
                $result[$key] = $this->prepareRelation($key, $newValue, $oldValue);
            } else {
                $result[$key] = [
                    'old' => $oldValue,
                    'new' => $newValue
                ];
            }
        }

        return $result;
    }

    private function prepareRelation(string $field, $newId, $oldId): array
    {
        $model = $this->relations[$field];
        $newRecord = $model::find($newId);
        $oldRecord = $model::find($oldId);

        $newValue = is_null($newRecord) ? null : $newRecord->{$newRecord->titleAttribute};
        $oldValue = is_null($oldRecord) ? null : $oldRecord->{$oldRecord->titleAttribute};

        return [
            'old' => $oldValue,
            'new' => $newValue
        ];
    }

    private function toType($input)
    {
        if (is_numeric($input)) {
            return (int)$input;
        } elseif (is_float($input)) {
            return (float)$input;
        } else {
            return $input;
        }
    }

    private function timeEqual(string $field, $newValue, $oldValue): bool
    {
        $newValue = mb_substr($newValue, 0, 5, 'UTF-8');
        $oldValue = mb_substr($oldValue, 0, 5, 'UTF-8');

        return $newValue == $oldValue;
    }
}