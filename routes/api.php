<?php

Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function () {
    Route::get('test', function () {
        return \App\Models\User::first();
    });

    Route::group(['namespace' => 'API'], function () {
        Route::get('add', 'CardController@addCard');
    });
});

Route::any('/upload', function () {
    $file = request()->file('file');
    $file_path = $file->store('test', 'public');
    return response()->json([
        'message'      => 'api dump',
        'request_data' => ['path' => $file_path],
    ]);
});
