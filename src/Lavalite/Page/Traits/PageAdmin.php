<?php namespace Lavalite\Page\Traits;

use App;
use Lang;
use View;
use Input;
use Former;
use Sentry;
use Config;
use Session;
use Redirect;
use Lavalite\Page\Models\Page as Page;

class PageAdmin extends \AdminController
{

    public function __construct(\Lavalite\Page\Interfaces\PageInterface $page)
    {
        $this->model 	= $page;
        parent::__construct();
    }

    protected function hasAccess($permission = 'view')
    {
        if(!Sentry::getUser()->hasAccess('page::page.permissions.admin.'.$permission))
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
        $q		        = Input::get('q');
        $this->hasAccess('view');
        $pages	        = $this->model->paginate(15);
        $permissions	= $this->permissions();
        $this->theme->prependTitle(Lang::get('page::page.names') . ' :: ');
        return $this->theme->of('page::admin.index', compact($q, $pages, $permissions)->render();
    }

    public function show($id)
    {
        $this->hasAccess('view');
        $data['page']	= $this->model->find($id);
        $data['permissions']	= $this->permissions();
        $this->theme->prependTitle(Lang::get('app.view') . ' ' . Lang::get('page::page.name') . ' :: ');

        return $this->theme->of('page::admin.show', $data)->render();
    }

    public function create()
    {
        $this->hasAccess('create');
        $data['page']	= $this->model->instance();
        $this->theme->prependTitle(Lang::get('app.new') . ' ' . Lang::get('page::page.name') . ' :: ');

        return $this->theme->of('page::admin.create', $data)->render();
    }

    public function store()
    {

        $this->hasAccess('create');
        if ($this->model->create(Input::all())) {

            Session::flash('success',  Lang::get('messages.success.create', array('Module' => Lang::get('page::page.name'))));

            return Redirect::to('/admin/page');

        } else {
            Former::withErrors($this->model->getErrors());
            Former::populate(Input::all());
            $data['page']	=  $this->model->instance();
            $this->theme->prependTitle(Lang::get('app.new') . ' ' . Lang::get('page::page.name') . ' :: ');

            return $this->theme->of('page::admin.create', $data)->render();
        }

    }

    public function edit($id)
    {

        $this->hasAccess('edit');
        $data['page']		= $this->model->find($id);

        Former::populate($data['page']);
        $this->theme->prependTitle(Lang::get('app.edit') . ' ' . Lang::get('page::page.name') . ' :: ');

        return $this->theme->of('page::admin.edit', $data)->render();

    }

    public function update($id)
    {

        $this->hasAccess('edit');

        if ($r = $this->model->update($id, Input::all())) {
            Session::flash('success',  Lang::get('messages.success.update', array('Module' => Lang::get('page::page.name'))));
            return Redirect::to('/admin/page');
        } else {
//            dd(print_r($r));
            Former::withErrors($this->model->getErrors());
            Former::populate(Input::all());
            $data['page']		= $this->model->find($id);

            return $this->theme->of('page::admin.edit', $data)->render();
        }

    }

    public function destroy($id)
    {
        $this->hasAccess('delete');
        $this->model->delete($id);
        Session::flash('success', Lang::get('messages.success.delete', array('Module' => Lang::get('page::page.name'))));

        return Redirect::to('/admin/page');

    }

}
