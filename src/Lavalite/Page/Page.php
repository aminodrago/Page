<?php namespace Lavalite\Page;

use App;
use Config;
use User;
use URL;
use View;

class Page
{

    protected $model;
    protected $category;
    protected $tag;

    /**
     * @param Interfaces\PageInterface $page
     */
    public function __construct(\Lavalite\Page\Interfaces\PageInterface $page,
                                \Lavalite\Page\Interfaces\CategoryInterface $category)
    {
        $this->model = $page;
        $this->category = $category;
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

    /**
     *
     * @return array
     */
    public function categories()
    {
        $data   = $this->category->categories();
        $data[0] = 'None';
        return $data;
    }

}
