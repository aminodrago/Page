<?php

namespace Lavalite\Page\Http\Controllers;

use Former;
use Response;
use App\Http\Controllers\AdminController as AdminController;

use Lavalite\Page\Http\Requests\PageRequest;
use Lavalite\Page\Interfaces\PageRepositoryInterface;

/**
 *
 * @package Pages
 */

class PageAdminController extends AdminController
{

    /**
     * Initialize page controller
     * @param type PageRepositoryInterface $page
     * @return type
     */
    public function __construct(PageRepositoryInterface $page)
    {
        $this->model = $page;
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(PageRequest $request)
    {
        $this->theme->prependTitle(trans('page::page.names').' :: ');

        return $this->theme->of('page::admin.page.index')->render();
    }

    /**
     * Return list of pages as json.
     *
     * @param  Request  $request
     *
     * @return Response
     */
    public function lists(PageRequest $request)
    {
        $array = $this->model->json();

        foreach ($array as $key => $row) {
            $row['slug'] = $row['slug'].'.htm';
            $array[$key] = array_only($row, config('pages.page.listfields'));
        }

        return array('data' => $array);
    }

    /**
     * Display the specified resource.
     *
     * @param  Request  $request
     * @param  int  $id
     *
     * @return Response
     */
    public function show(PageRequest $request, $id)
    {
        $page = $this->model->findOrNew($id);

        Former::populate($page);

        return view('page::admin.page.show', compact('page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  Request  $request
     * @return Response
     */
    public function create(PageRequest $request)
    {
        $page = $this->model->findOrNew(0);
        Former::populate($page);

        return view('page::admin.page.create', compact('page'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(PageRequest $request)
    {
        if ($row = $this->model->create($request->all())) {
            return Response::json(['message' => 'Page created sucessfully', 'type' => 'success', 'title' => 'Success'], 201);
        } else {
            return Response::json(['message' => $e->getMessage(), 'type' => 'error', 'title' => 'Error'], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function edit(PageRequest $request, $id)
    {
        $page = $this->model->find($id);

        Former::populate($page);

        return view('page::admin.page.edit', compact('page'));
    }

    /**
     * Update the specified resource.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(PageRequest $request, $id)
    {
        if ($row = $this->model->update($request->all(), $id)) {
            return Response::json(['message' => 'Page updated sucessfully', 'type' => 'success', 'title' => 'Success'], 201);
        } else {
            return Response::json(['message' => $e->getMessage(), 'type' => 'error', 'title' => 'Error'], 400);
        }
    }

    /**
     * Remove the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(PageRequest $request, $id)
    {
        try {
            $this->model->delete($id);
            return Response::json(['message' => 'Page deleted sucessfully'.$id, 'type' => 'success', 'title' => 'Success'], 201);
        } catch (Exception $e) {
            return Response::json(['message' => $e->getMessage(), 'type' => 'error', 'title' => 'Error'], 400);
        }
    }
}
