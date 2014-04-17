<?php namespace Lavalite\Page;

class PublicController extends \BaseController{

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

	public function __construct(\Lavalite\Page\Interfaces\PageInterface $page)
	{
		$this->model 	= $page;
		$this->theme = \Theme::uses('admin')->layout('page'); //$this->setupTheme('admin', 'default');
		\Former::framework('TwitterBootstrap3');
		\Former::config('fetch_errors', true);

	}


}