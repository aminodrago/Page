<?php
Route::group(array('prefix' => Localization::setLocale()), function()
{
	Route::group(array('prefix' => 'admin', 'before' => 'auth.admin'), function()
	{
		Route::resource('page', '\Lavalite\Page\PageAdminController');
	});
	Route::get('/',  'Lavalite\Page\PagePublicController@showIndex');
	Route::get('/{slug}.html', '\Lavalite\Page\PagePublicController@getPage');

});