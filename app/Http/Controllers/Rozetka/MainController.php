<?php

namespace App\Http\Controllers\Rozetka;

use App\Http\Controllers\Controller;
use App\Rozetka\Exceptions\AuthFailedException;
use App\Rozetka\Services\TestConnectionService;

class MainController extends Controller
{
    public function sectionMain()
    {

    }

    public function sectionTest()
    {
        try {
            $result = app(TestConnectionService::class)->test();

            dd($result);
        } catch (AuthFailedException $exception) {
            echo $exception->getMessage();
        }

    }
}