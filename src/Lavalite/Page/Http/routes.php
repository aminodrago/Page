<?php

Route::group(array('prefix' => 'admin'), function () {
    Route::get('/page/list', '\Lavalite\Page\Http\Controllers\PageAdminController@lists');
    Route::resource('/page', '\Lavalite\Page\Http\Controllers\PageAdminController');
});

Route::get('/{slug}.html', '\Lavalite\Page\Http\Controllers\PublicController@getPage');
