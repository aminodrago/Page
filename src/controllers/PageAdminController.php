<?php namespace Lavalite\Page;
use Lavalite\Page\Models\Page as Page;

class PageAdminController extends AdminController{

	/**
	 * Theme instance.
	 *
	 * @var \Teepluss\Theme\Theme
	 */
	protected $theme;

	/**
	 * Model instance.
	 *
	 * @var \Pages\Model\Pages
	 */
	protected $model;

	public function __construct(\Lavalite\Page\Interfaces\PageInterface $page)
	{
		$this->model 	= $page;
		$this->theme = \Theme::uses('admin')->layout('default'); //$this->setupTheme('admin', 'default');
		\Former::framework('TwitterBootstrap3');
		\Former::config('fetch_errors', true);

	}

	public function index()
	{
		$data['q']		= \Input::get('q');
		$this->hasAccess();
		$data[(str_plural('page'))]	= $this->model->paginate(15);
		$data['permissions']	= $this->permissions();
		$this->setTheme('index', $data);
		return $this->theme->of('page::admin.index', $data)->render();
	}

	public function show($id)
	{
		$this->hasAccess('page.show');
		$data['page']	= $this->model->find($id);
		$this->setTheme('show', $data);
		$data['permissions']	= $this->permissions();
		return $this->theme->of('page::admin.show', $data)->render();
	}

	public function create()
	{
		$this->hasAccess('page.create');
		$this->setTheme('create');
		$data['page']	= new Page(); 
		return $this->theme->of('page::admin.create', $data)->render();
	}

	public function store()
	{
		
		$this->hasAccess('page.create');
		$row = new Page();	
		if ($row->save()) {

			\Session::flash('success',  \Lang::get('messages.success.create', array('Module' => \Lang::get('page::module.name'))));
			return \Redirect::to('/admin/page');

		} else {
			\Former::withErrors($row->errors());
			\Former::populate(\Input::all());
			$data['page']	=  $this->model->find(0); 
			return $this->theme->of('page::admin.create', $data)->render();
		}

	}

	public function edit($id)
	{

		$this->hasAccess('page.edit');
		$data['page']		= $this->model->find($id);


		$this->setTheme('edit', $data);
		\Former::populate($data['page']);
		return $this->theme->of('page::admin.edit', $data)->render();

	}

	public function update($id)
	{
		
		$this->hasAccess('page.edit');
		$row = $this->model->find($id);

		if ($row->save()) {
			\Session::flash('success',  \Lang::get('messages.success.update', array('Module' => \Lang::get('page::module.name'))));
			return \Redirect::to('/admin/page');
		}
		else
		{
			\Former::withErrors($row->errors());
			\Former::populate($this -> getInputs());
			$data['page']		= $this->model->find($id);
			return $this->theme->of('page::admin.edit', $data)->render();
		}

	}

	public function destroy($id)
	{
		$this->hasAccess('page.delete');
		$this->model->delete($id);
		\Session::flash('success', \Lang::get('messages.success.delete', array('Module' => \Lang::get('page::module.name'))));
		return \Redirect::to('/admin/page');

	}

}