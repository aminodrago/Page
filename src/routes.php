<?php
Route::group(array('prefix' => Localization::setLocale()), function () {
    Route::resource('admin/page', '\Lavalite\Page\Controllers\PageAdminController');
    Route::get('admin/page/{id}/{field}/{no}', '\Lavalite\Page\Controllers\PageAdminController@removeFile');

    Route::get('/{slug}.html', '\Lavalite\Page\Controllers\PublicController@getPage');
});
