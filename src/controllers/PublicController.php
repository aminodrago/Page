<?php namespace Lavalite\Page\Controllers;


class PublicController extends \PublicController
{


    public function __construct(\Lavalite\Page\Interfaces\PageInterface $page)
    {
        $this->model 	= $page;
        $this->setupTheme('public', 'page');

    }

    protected function getPage($slug)
    {
        $data['page'] = $this->model->getPage($slug);
        $this -> theme -> setTitle($data['page'] -> title);
        $this -> theme -> setKeywords($data['page'] -> keyword);
        $this -> theme -> setDescription($data['page'] -> description);
//print_r($data);
//        $data['content']	= Theme::blader($data['content'], array());
        return $this->theme->of('page::public.page', $data)->render();
    }

}
