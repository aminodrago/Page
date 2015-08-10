<?php

namespace Lavalite\Page;

use Config;
use User;
use View;

class Page
{
    protected $model;

    /**
     * @param Interfaces\PageInterface $page
     */
    public function __construct(\Lavalite\Page\Interfaces\PageInterface $page)
    {
        $this->model = $page;
    }

    public function model()
    {
        return $this->model->getModel();
    }

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
        $data['permissions'] = $this->permissions();

        return View::make('page::admin.page.gadget', $data);
    }

    /**
     * @return array
     */
    protected function permissions()
    {
        $p = array();

        $permissions = Config::get('page::page.permissions.admin');

        foreach ($permissions as $key => $value) {
            $p[$value] = User::hasAccess($value);
        }

        return $p;
    }
}
