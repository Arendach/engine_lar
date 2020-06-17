<?php

Route::post('new_post/search_cities', 'Api\NewPostController@searchCities');
Route::post('new_post/search_warehouses', 'Api\NewPostController@searchWarehouses');
Route::post('streets/search', 'Api\StreetController@search');