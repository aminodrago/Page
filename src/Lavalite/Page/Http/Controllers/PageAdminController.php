<?php namespace Lavalite\Page\Http\Controllers;

use App;
use User;
use Former;
use Response;
use Request;
use App\Http\Controllers\AdminController as AdminController;

use Lavalite\Page\Http\Requests\ViewPageRequest;
use Lavalite\Page\Http\Requests\UpdatePageRequest;
use Lavalite\Page\Http\Requests\StorePageRequest;
use Lavalite\Page\Http\Requests\DeletePageRequest;

use Lavalite\Page\Interfaces\PageInterface;

class PageAdminController extends AdminController
{

    public function __construct(PageInterface $page)
    {
        $this->model 	= $page;
        parent::__construct();
    }

    public function index(ViewPageRequest $request)
    {
        $data['pages']          = $this->model->all();
        $this->theme->prependTitle(trans('page::page.names') . ' :: ');
        return $this->theme->of('page::admin.page.index', $data)->render();
    }

    public function lists(ViewPageRequest $request)
    {
        $array = $this->model->json();
        foreach ($array as $key => $row){
            $row['slug']     = $row['slug'].'.htm';
            $array[$key]    = array_only($row, config('pages.page.listfields'));
        }
        return array('data' => $array);
    }

    public function show(ViewPageRequest $request, $id)
    {

        $page	= $this->model->find($id);


        Former::populate($page);
        return view('page::admin.page.show', compact('page'));
    }

    public function create(StorePageRequest $request)
    {
        $page	= $this->model->instance();
        Former::populate($page);
        return view('page::admin.page.create', compact('page'));
    }

    public function store(StorePageRequest $request)
    {
        if ($row = $this->model->create($request->all())) {
            return Response::json(['message' => 'Page created sucessfully', 'type' => 'success', 'title' => 'Success'], 200);
        } else {
            return Response::json(['message' => $e->getMessage(), 'type' => 'error', 'title' => 'Error'], 400);
        }

    }

    public function edit(UpdatePageRequest $request, $id)
    {

        $page		= $this->model->find($id);
        Former::populate($page);
        return view('page::admin.page.edit', compact('page'));

    }

    public function update(UpdatePageRequest $request, $id)
    {

        if ($row = $this->model->update($id, $request->all())) {
            return Response::json(['message' => 'Page updated sucessfully', 'type' => 'success', 'title' => 'Success'], 203);
        } else {
            return Response::json(['message' => $e->getMessage(), 'type' => 'error', 'title' => 'Error'], 400);
        }
    }

    public function destroy(DeletePageRequest $request, $id)
    {
        if ($this->model->delete($id)){
            return Response::json(['message' => 'Page deleted sucessfully', 'type' => 'success', 'title' => 'Success'], 200);
        } else {
            return Response::json(['message' => $e->getMessage(), 'type' => 'error', 'title' => 'Error'], 400);
        }
    }
}