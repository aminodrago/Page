<?php namespace Lavalite\Page\Controllers;

use Lavalite\Page\Models\Page as Page;

use App;
use Lang;
use Input;
use Config;
use Former;
use Sentry;
use Session;
use Redirect;

class PageAdminController extends \AdminController
{

    public function __construct(\Lavalite\Page\Interfaces\PageInterface $page)
    {
        $this->model 	= $page;
        parent::__construct();
    }

    protected function hasAccess()
    {
        if(!Sentry::getUser()->hasAnyAccess(array('menu', 'admin', 'developer')))
            App::abort(401, Lang::get('messages.error.auth'));

        return true;
    }

    protected function permissions()
    {
        $p				= array();

        $permissions 	= Config::get('page::page.permissions.admin');

        foreach ($permissions as $key => $value) {
            $p[$value]	= Sentry::getUser()->hasAccess($value);
        }

        return $p;
    }

    public function index()
    {
        $data['q']		= Input::get('q');
        $this->hasAccess();
        $data[(str_plural('page'))]	= $this->model->paginate(15);
        $data['permissions']		= $this->permissions();
        $this->theme->prependTitle(Lang::get('page::page.names') . ' :: ');

        return $this->theme->of('page::admin.index', $data)->render();
    }

    public function show($id)
    {
        $this->hasAccess('page.show');
        $data['page']	= $this->model->find($id);
        $data['permissions']	= $this->permissions();
        $this->theme->prependTitle(Lang::get('app.view') . ' ' . Lang::get('page::page.name') . ' :: ');

        return $this->theme->of('page::admin.show', $data)->render();
    }

    public function create()
    {
        $this->hasAccess('page.create');
        $data['page']	= new $this->instance();
        $this->theme->prependTitle(Lang::get('app.new') . ' ' . Lang::get('page::page.name') . ' :: ');

        return $this->theme->of('page::admin.create', $data)->render();
    }

    public function store()
    {

        $this->hasAccess('page.create');
        if ($this->model->create(Input::all())) {

            Session::flash('success',  Lang::get('messages.success.create', array('Module' => Lang::get('page::page.name'))));

            return Redirect::to('/admin/page');

        } else {
            Former::withErrors($row->getErrors());
            Former::populate(Input::all());
            $data['page']	=  $this->model->instance();
            $this->theme->prependTitle(Lang::get('app.new') . ' ' . Lang::get('page::page.name') . ' :: ');

            return $this->theme->of('page::admin.create', $data)->render();
        }

    }

    public function edit($id)
    {

        $this->hasAccess('page.edit');
        $data['page']		= $this->model->find($id);

        Former::populate($data['page']);
        $this->theme->prependTitle(Lang::get('app.edit') . ' ' . Lang::get('page::page.name') . ' :: ');

        return $this->theme->of('page::admin.edit', $data)->render();

    }

    public function update($id)
    {

        $this->hasAccess('page.edit');
        $row = $this->model->find($id);

        if ($row->save()) {
            Session::flash('success',  Lang::get('messages.success.update', array('Module' => Lang::get('page::page.name'))));

            return Redirect::to('/admin/page');
        } else {
            Former::withErrors($row->getErrors());
            Former::populate($this -> getInputs());
            $data['page']		= $this->model->find($id);

            return $this->theme->of('page::admin.edit', $data)->render();
        }

    }

    public function destroy($id)
    {
        $this->hasAccess('page.delete');
        $this->model->delete($id);
        Session::flash('success', Lang::get('messages.success.delete', array('Module' => Lang::get('page::page.name'))));

        return Redirect::to('/admin/page');

    }

}
