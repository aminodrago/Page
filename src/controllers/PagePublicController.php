<?php namespace Lavalite\Page;

class PagePublicController extends \PublicController{


	/**
	 * Layout instance.
	 *
	 * @var \Teepluss\Layout\Layout
	 */
	protected $layout 	= 'page';

	/**
	 * Model instance.
	 *
	 * @var \Pages\Model\Pages
	 */
	protected $model;

	public function __construct(\Lavalite\Page\Interfaces\PageInterface $page)
	{
		$this->model 	= $page;
		parent::setupTheme();

	}

	protected function getPage($slug) {
		$data['page'] = $this->model->getPage($slug);
		$this -> theme -> setTitle($data['page'] -> title);
		$this -> theme -> setKeywords($data['page'] -> keyword);
		$this -> theme -> setDescription($data['page'] -> description);
		return $this->theme->of('page::public.page', $data)->render();
	}

    public function showIndex()
    {
		$data['page'] = $this->model->getPage('home');
    	$this->theme->layout('home');
		$this -> theme -> setTitle($data['page'] -> title);
		$this -> theme -> setKeywords($data['page'] -> keyword);
		$this -> theme -> setDescription($data['page'] -> description);
		return $this->theme->of('page::public.home', $data)->render();
    }
}