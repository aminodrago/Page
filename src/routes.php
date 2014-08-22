<?php
Route::group(array('prefix' => Localization::setLocale()), function () {
    Route::resource('admin/page', '\Lavalite\Page\Controllers\PageAdminController');
    Route::get('/{slug}.html', '\Lavalite\Page\Controllers\PublicController@getPage');
});
