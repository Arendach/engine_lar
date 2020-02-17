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

        foreach ($this->request->toArray() as $field => $value)
            if (method_exists($this, $field))
                $this->{$field}($value);


        foreach (get_class_methods($this) as $method) {
            if (preg_match('/^default_/', $method)) {
                $field = str_replace('default_', '', $method);

                if (!$this->request->has($field))
                    $this->{$method}();
            }
        }

        if (method_exists($this, 'default')) {
            $this->default();
        }

        return $this->builder;
    }
}