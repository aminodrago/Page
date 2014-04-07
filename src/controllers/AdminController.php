<?php namespace Lavalite\Page;

class AdminController extends \BaseController{

	/**
	 * Theme instance.
	 *
	 * @var \Teepluss\Theme\Theme
	 */
	protected $theme;

	/**
	 * Model instance.
	 *
	 * @var \Pages\Model\Pages
	 */
	protected $model;


	protected function hasAccess() {

		if(!\Sentry::getUser()->hasAccess('page')) 
			\App::abort(401, \Lang::get('messages.error.auth'));

		return true;
	}

	protected function permissions() {
		$p				= array();

		$permissions 	= \Config::get('page::permissions');

		foreach ($permissions as $key => $value) {
			$p[$value]	= \Sentry::getUser()->hasAccess('page.'.$value);
		}

		return $p;
	}

	protected function setTheme() {
	}

}