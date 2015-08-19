<?php

namespace Lavalite\Page\Http\Controllers;

use App\Http\Controllers\PublicController as CmsPublicController;

class PublicController extends CmsPublicController
{
    /**
     * Constructor
     * @param type \Lavalite\Page\Interfaces\PageInterface $page
     *
     * @return type
     */
    public function __construct(\Lavalite\Page\Interfaces\PageInterface $page)
    {
        $this->model = $page;
        parent::__construct();
    }

    /**
     * Show page
     * @param string $slug
     *
     * @return response
     */
    protected function getPage($slug)
    {
        // get page by slug
        $data['page'] = $this->model->getPage($slug);

        //Set theme variables
        $this->theme->setTitle($data['page']->title);
        $this->theme->setKeywords($data['page']->keyword);
        $this->theme->setDescription($data['page']->description);

        // Get view
        $view = $data['page']->view;
        $view = view()->exists('page::'.$view) ? $view : 'page';

        // display page
        return $this->theme->of('page::'.$view, $data)->render();
    }
}
