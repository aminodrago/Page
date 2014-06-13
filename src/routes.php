<?php
Route::group(array('prefix' => Localization::setLocale()), function () {
    Route::group(array('prefix' => 'admin', 'before' => 'auth.admin'), function () {
        Route::resource('page', '\Lavalite\Page\Controllers\PageAdminController');
    });
    Route::get('/{slug}.html', '\Lavalite\Page\Controllers\PublicController@getPage');
});
