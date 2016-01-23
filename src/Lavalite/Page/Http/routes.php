<?php

Route::group(
[
'prefix' => Trans::setLocale().'/admin/page'
],
function () {
    Route::resource('page', 'PageAdminController');
});

Route::group(
[
'prefix' => Trans::setLocale().'/user/page'
],
function () {
    Route::resource('page', 'PageUserController');
});

Route::get('/{slug}.html', 'PublicController@getPage');
