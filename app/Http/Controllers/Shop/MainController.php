<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class MainController extends Controller
{
    public function main(): View
    {
        return view('shop.main');
    }
    public function sectionIndex()
    {

        return view('shop.index');
    }
}