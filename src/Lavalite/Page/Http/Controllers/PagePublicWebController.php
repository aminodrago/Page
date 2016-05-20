<?php

namespace Lavalite\Page\Http\Controllers;

use App\Http\Controllers\PublicWebController as PublicController;

class PagePublicWebController extends PublicController
{
    /**
     * Constructor.
     *
     * @param type \Lavalite\Page\Interfaces\PageInterface $page
     *
     * @return type
     */
    public function __construct(\Lavalite\Page\Interfaces\PageRepositoryInterface $page)
    {
        $this->model = $page;
        parent::__construct();
    }

    /**
     * Show page.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function getPage($slug)
    {
        // get page by slug
        $page = $this->model->getPage($slug);

        //Set theme variables
        $this->theme->setTitle($page->title);
        $this->theme->setKeywords($page->keyword);
        $this->theme->setDescription($page->description);

        // Get view
        $view = $page->view;
        $view = view()->exists('page::public.' . $view) ? $view : 'page';

        // display page
        return $this->theme->of('page::public.' . $view, compact('page'))->render();
    }
}
