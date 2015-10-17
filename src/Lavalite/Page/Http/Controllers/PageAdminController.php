<?php
namespace Lavalite\Page\Http\Controllers;

use Former;
use App\Http\Controllers\AdminController as AdminController;

use Lavalite\Page\Http\Requests\PageAdminRequest;
use Lavalite\Page\Interfaces\PageRepositoryInterface;

/**
 *
 * @package Page
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
    public function index(PageAdminRequest $request)
    {
        $this->theme->prependTitle(trans('page::page.names').' :: ');

        return $this->theme->of('page::admin.page.index')->render();
    }

    /**
     * Return list of page as json.
     *
     * @param  Request  $request
     *
     * @return Response
     */
    public function lists(PageAdminRequest $request)
    {
        $array = $this->model->json();

        foreach ($array as $key => $row) {
            $array[$key] = array_only($row, config('page.page.listfields'));
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
    public function show(PageAdminRequest $request, $id)
    {
        $page = $this->model->find($id);

        if (empty($page)) {

            if($request->wantsJson())
                return [];

            return view('page::admin.page.new');
        }

        if($request->wantsJson())
            return $page;

        Former::populate($page);

        return view('page::admin.page.show', compact('page'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  Request  $request
     * @return Response
     */
    public function create(PageAdminRequest $request)
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
    public function store(PageAdminRequest $request)
    {

        try {
            $attributes     = $request->all();
            $page           = $this->model->create($attributes);
            return $this->success(trans('messages.success.created', ['Module' => 'Page']), 201);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function edit(PageAdminRequest $request, $id)
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
    public function update(PageAdminRequest $request, $id)
    {
        try {
            $attributes     = $request->all();
            $page           = $this->model->update($attributes, $id);
            return $this->success(trans('messages.success.updated', ['Module' => 'Page']), 201);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Remove the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(PageAdminRequest $request, $id)
    {
        try {
            $this->model->delete($id);
            return $this->success(trans('messages.success.deleted', ['Module' => 'Page']), 201);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

}