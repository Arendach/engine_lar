<?php

namespace App\Rozetka\Services;

use App\Rozetka\Base\Request;

class TestConnectionService
{
    private $request;

    public function __construct()
    {
        $this->request = app(Request::class);
    }

    public function test()
    {
        return $this->request->get('/markets/business-types');
    }
}