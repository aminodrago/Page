<?php namespace Lavalite\Page;

use Config, App, URL, Sentry, View;

class Page
{

    protected $model;

    public function __construct(\Lavalite\Page\Interfaces\PageInterface $page)
    {
        $this->model 	= $page;
    }

    public function model()
    {
        return $this->model->getModel();
    }

    public function __call($name, $arguments)
    {

        return $this->model->$name($arguments[0]);
    }

    public function gadget($perpage = 10)
    {
        $data['pages']  = $this->model->paginate($perpage);
        $data['permissions']  = $this->permissions();
        return View::make('page::admin.gadget', $data);
    }

    protected function permissions()
    {
        $p              = array();

        $permissions    = Config::get('page::permissions');

        foreach ($permissions as $key => $value) {
            $p[$value]  = Sentry::getUser()->hasAccess('page.'.$value);
        }

        return $p;
    }

}
