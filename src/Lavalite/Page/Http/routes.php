<?php

Route::group(
[
'prefix' => Trans::setLocale().'/admin/page'
],
function () {
    Route::resource('page', 'PageAdminController');
});

Route::get('/{slug}.html', 'PublicController@getPage');
