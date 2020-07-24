<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Filter
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Builder
     */
    protected $builder;

    public $simple = [];

    public $like = [];

    /**
     * Filter constructor.
     */
    public function __construct()
    {
        $this->request = request();
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->request->toArray() as $field => $value) {
            if (method_exists($this, $field)) {
                $this->{$field}($value);
            }
        }


        foreach (get_class_methods($this) as $method) {
            if (preg_match('/^default_/', $method)) {
                $field = str_replace('default_', '', $method);

                if (!$this->request->has($field)){
                    $this->{$method}();
                }
            }
        }

        foreach ($this->simple as $item) {
            if ($this->request->get($item)) {
                $this->builder->where($item, $this->request->get($item));
            }
        }

        foreach ($this->like as $item) {
            if ($this->request->get($item)) {
                $this->builder->where($item, 'like', "%{$this->request->get($item)}%");
            }
        }

        if (method_exists($this, 'default')) {
            $this->default();
        }

        return $this->builder;
    }
}