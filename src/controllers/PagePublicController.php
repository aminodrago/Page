<?php namespace Lavalite\Page;

class PagePublicController extends PublicController{

	/**
	 * Theme instance.
	 *
	 * @var \Teepluss\Theme\Theme
	 */
	protected $theme;

	/**
	 * Module.
	 */
	protected $module = 'page';

	/**
	 * Model instance.
	 *
	 * @var \Pages\Model\Pages
	 */
	protected $model;

	public function __construct(\Lavalite\Page\Interfaces\PageInterface $page)
	{
		$this->model 	= $page;
		$this->theme = \Theme::uses('public')->layout('default'); //$this->setupTheme('admin', 'default');
		\Former::framework('TwitterBootstrap3');
		\Former::config('fetch_errors', true);

	}

	protected function getPage($slug) {
		 $data['page'] = $this->model->getPage($slug);
		return $this->theme->of('page::public.page', $data)->render();
	}

}