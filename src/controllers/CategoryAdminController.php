<?php namespace Lavalite\Page\Controllers;

use App;
use Lang;
use Input;
use Former;
use Sentry;
use Config;
use Session;
use Redirect;

class CategoryAdminController extends \AdminController
{

    /**
     * Model instance.
     *
     * @var \Categories\Model\Categories
     */
    protected $model;

    protected $package      = 'page' ;

    protected $module       = 'category';

    public function __construct(\Lavalite\Page\Interfaces\CategoryInterface $category)
    {
        $this->model 	= $category;
        parent::__construct();
    }

    protected function hasAccess($permission = 'view')
    {
        if(!Sentry::getUser()->hasAccess('page::category.permissions.admin.'.$permission))
            App::abort(401, Lang::get('messages.error.auth'));

        return true;
    }

    protected function permissions()
    {
        $p				= array();
        $permissions 	= Config::get('page::category.permissions.admin');
        foreach ($permissions as $key => $value) {
            $p[$value]	= Sentry::getUser()->hasAnyAccess(array('page.category.'.$value));
        }

        return $p;
    }

    public function index()
    {

        $this->hasAccess('view');

        $q					= Input::get('q');
        $categories			= $this->model->paginate(15);
        $permissions		= $this->permissions();

        $this->theme->prependTitle(Lang::get('page::category.names') . ' :: ');

        return $this->theme->of('page::category.admin.index', compact($q, $categories, $permissions))->render();
    }

    public function show($id)
    {
        $this->hasAccess('view');
        $data['category']		= $this->model->find($id);
        $data['permissions']	= $this->permissions();

        $this->theme->prependTitle(Lang::get('app.view') . ' ' . Lang::get('page::category.names') . ' :: ');

        return $this->theme->of('page::category.admin.show', $data)->render();
    }

    public function create()
    {
        $this->hasAccess('create');
        $data['category']		= $this->model->instance();
        $this->theme->prependTitle(Lang::get('app.new') . ' ' . Lang::get('page::category.names') . ' :: ');

        return $this->theme->of('page::category.admin.create', $data)->render();
    }

    public function store()
    {

        $this->hasAccess('create');
        $row = $this->model->instance();
        if ($this->model->create(Input::all())) {
            Session::flash('success',  Lang::get('messages.success.create', array('Module' => Lang::get('page::category.names'))));

            return Redirect::to('/admin/page/category');

        } else {
            Former::withErrors($this->model->getErrors());
            Former::populate(Input::all());
            $data['category']	    = $this->model->instance();
            $this->theme->prependTitle(Lang::get('app.new') . ' ' . Lang::get('page::category.names') . ' :: ');

            return $this->theme->of('page::category.admin.create', $data)->render();
        }

    }

    public function edit($id)
    {

        $this->hasAccess('edit');
        Session::put('category_id',$id);
        $data['category']		= $this->model->find($id);

        Former::populate($data['category']);
        $this->theme->prependTitle(Lang::get('app.edit') . ' ' . Lang::get('page::category.names') . ' :: ');

        return $this->theme->of('page::category.admin.edit', $data)->render();
    }

    public function update($id)
    {
        $this->hasAccess('edit');
        if ($this->model->update($id, Input::all())) {
            Session::flash('success',  Lang::get('messages.success.update', array('Module' => Lang::get('page::category.names'))));

            return Redirect::to('/admin/page/category');

        } else {

            Former::withErrors($this->model->getErrors());
            Former::populate(Input::all());
            $data['category']		= $this->model->find($id);
            $data['image']          = $this->imageArray(array('id' => $id));

            return $this->theme->of('page::category.admin.edit', $data)->render();
        }

    }

    public function destroy($id)
    {
        $this->hasAccess('delete');
        $this->model->delete($id);
        Session::flash('success', Lang::get('messages.success.delete', array('Module' => Lang::get('page::category.names'))));

        return Redirect::to('/admin/page/category');

    }

}
