<?php

namespace Lavalite\Page\Repositories\Eloquent;

use Lavalite\Page\Interfaces\PageRepositoryInterface;

class PageRepository extends BaseRepository implements PageRepositoryInterface
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return "Lavalite\\Page\\Models\\Page";
    }

    /**
     * Get page by slug
     *
     * @return void
     */
    public function getPageBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    /**
     * Get page by id
     *
     * @return void
     */
    public function getPageById($id)
    {
        return $this->model->find($id);
    }

    /**
     * Get page by id or slug
     *
     * @return void
     */
    public function getPage($var)
    {
        if (is_numeric($var))
            return $this->getPageById($var);

        if (is_string($var))
            return $this->getPageBySlug($var);
    }

}
