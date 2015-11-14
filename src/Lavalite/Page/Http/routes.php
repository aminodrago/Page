<?php

Route::group(['prefix' => 'admin/page'], function () {
    Route::resource('page', 'PageAdminController');
});

Route::get('/{slug}.html', 'PublicController@getPage');
