<?php namespace Lavalite\Page\Controllers;

use Theme;
use View;

class PublicController extends \PublicController
{

    protected $layout   = 'page';

    public function __construct(\Lavalite\Page\Interfaces\PageInterface $page)
    {
        $this->model 	= $page;
         parent::__construct();

    }

    protected function getPage($slug)
    {
        $data['page'] = $this->model->getPage($slug);
        $this -> theme -> setTitle($data['page'] -> title);
        $this -> theme -> setKeywords($data['page'] -> keyword);
        $this -> theme -> setDescription($data['page'] -> description);

        $view   = $data['page'] -> view;
        $view   = View::exists('page::'.$view) ? $view : 'page';
        return $this->theme->of('page::'.$view, $data)->render();
    }

}
