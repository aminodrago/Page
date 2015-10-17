<?php

namespace Lavalite\Page;

use Config;
use User;
use View;

/**
 *
 * @package Page facade
 */
class Page
{

    // Page modal
    protected $model;

    /**
     * Initialize page facade.
     *
     * @param type \Lavalite\Page\Interfaces\PageRepositoryInterface $page
     * @return none
     *
     */
    public function __construct(\Lavalite\Page\Interfaces\PageRepositoryInterface $page)
    {
        $this->model = $page;
    }

    /**
     * Calls page repository function
     *
     * @param string $name
     * @param array $arguments
     *
     * @return mixed
     */

    public function __call($name, $arguments)
    {
        return $this->model->$name($arguments[0]);
    }

    /**
     * @param int $perpage
     *
     * @return mixed
     */
    public function gadget($perpage = 10)
    {
        $data['pages'] = $this->model->paginate($perpage);
        return View::make('page::admin.page.gadget', $data);
    }

    /**
     * Return return field value of a page
     *
     * @param mixed $idslug
     * @param string $field
     *
     * @return string
     */
    public function pages($idslug, $field)
    {
        $page = $this->model->getPage($idslug);
        return $page[$field];
    }

    /**
     * Returns page object
     *
     * @param mixed $idslug
     * @param string $field
     *
     * @return mixed
     */
    public function page($idslug)
    {
        return  $this->model->getPage($idslug);
    }

    /**
     * Returns count of pages
     *
     * @param array $filter
     *
     * @return integer
     */
    public function count(array $filters = NULL)
    {
        return  $this->model->count();
    }

}
