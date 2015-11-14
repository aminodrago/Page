<?php

Route::group(array('prefix' => 'admin/page'), function () {
    Route::resource('page', 'PageAdminController');
});

Route::get('/{slug}.html', 'PublicController@getPage');
