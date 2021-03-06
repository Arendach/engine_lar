<?php

Route::get('login', 'UserController@sectionLogin');
Route::post('login', 'UserController@actionAuthorize')->name('login');
Route::get('exit', 'UserController@sectionunAuthorize')->name('exit');
Route::get('/shop/main', 'Shop\\MainController@main')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'MainController@index')->name('home');
    Route::resource('setting', 'SettingController');

    Route::get('/{controller}/{method}', function ($controller, $method) {
        return router($controller, $method, 'section');
    });

    Route::post('/{controller}/{method}', function ($controller, $method) {
        return router($controller, $method, 'action');
    });

    Route::get('shop/{controller}/{method}', function ($controller, $method) {
        return router($controller, $method, 'section', [
            'namespace' => '\\App\\Http\\Controllers\\Shop'
        ]);
    });

    Route::get('rozetka/{controller}/{method}', function ($controller, $method) {
        return router($controller, $method, 'section', [
            'namespace' => '\\App\\Http\\Controllers\\Rozetka'
        ]);
    });

    Route::post('shop/{controller}/{method}', function ($controller, $method) {
        return router($controller, $method, 'action', [
            'namespace' => '\\App\\Http\\Controllers\\Shop'
        ]);
    });
});

