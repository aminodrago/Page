<?php

namespace Lavalite\Page\Repositories\Eloquent;

use Lavalite\Page\Interfaces\PageRepositoryInterface;
use Litepie\Database\Eloquent\BaseRepository;

class PageRepository extends BaseRepository implements PageRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return config('package.page.page.model');
    }

    /**
     * Get page by id or slug.
     *
     * @return void
     */
    public function getPage($var)
    {
        if (is_numeric($var)) {
            return $this->find($var);
        }

        if (is_string($var)) {
            return $this->findBySlug($var);
        }
    }
}
