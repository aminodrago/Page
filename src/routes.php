<?php
Route::group(array('prefix' => LaravelLocalization::setLocale()), function()
{
	Route::group(array('prefix' => 'admin', 'before' => 'auth.admin'), function()
	{
		Route::resource('page', '\Lavalite\Page\PageAdminController');
	});
	Route::get('/{slug}.html', '\Lavalite\Page\PagePublicController@getPage');

});