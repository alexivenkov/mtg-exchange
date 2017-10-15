<?php

Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function () {
    Route::get('test', function () {
        return \App\Models\User::first();
    });

    Route::group(['namespace' => 'API'], function () {
        Route::get('search', 'CardController@addCard');
    });
});