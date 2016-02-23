<?php

// Admin routes for module
Route::group(['prefix' => trans_setlocale().'/admin/page', 'middleware' => ['web', 'auth.role:admin']], function () {
    Route::resource('page', 'PageAdminController');
});

// User routes for module
Route::group(['prefix' => trans_setlocale().'/user/page', 'middleware' => ['web', 'auth.role:user']], function () {
    Route::resource('page', 'PageUserController');
});

// Public routes for module
Route::group(['prefix' => trans_setlocale(), 'middleware' => ['web']], function () {
	Route::get('/{slug}.html', 'PublicController@getPage');
});
