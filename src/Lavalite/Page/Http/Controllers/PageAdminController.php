<?php

namespace Lavalite\Page\Http\Controllers;

use App\Http\Controllers\AdminController as AdminController;
use Form;
use Lavalite\Page\Http\Requests\PageAdminRequest;
use Lavalite\Page\Interfaces\PageRepositoryInterface;
use Lavalite\Page\Models\Page;

/**
 *
 */
class PageAdminController extends AdminController
{
    /**
     * Initialize page controller.
     *
     * @param type PageRepositoryInterface $page
     *
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
        $pages  = $this->model->setPresenter('\\Lavalite\\Page\\Repositories\\Presenter\\PageListPresenter')->paginate(NULL, ['*']);
        $this   ->theme->prependTitle(trans('page::page.names').' :: ');
        $view   = $this->theme->of('page::admin.page.index')->render();

        $this->responseCode = 200;
        $this->responseMessage = trans('messages.success.loaded', ['Module' => 'Page']);
        $this->responseData = $pages['data'];
        $this->responseMeta = $pages['meta'];
        $this->responseView = $view;
        $this->responseRedirect = '';
        return $this->respond($request);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function show(PageAdminRequest $request, Page $page)
    {
        if (!$page->exists) {
            $this->responseCode = 404;
            $this->responseMessage = trans('messages.success.notfound', ['Module' => 'Page']);
            $this->responseData = $page;
            $this->responseView = view('page::admin.page.new');
            return $this -> respond($request);
        }

        Form::populate($page);
        $this->responseCode = 200;
        $this->responseMessage = trans('messages.success.loaded', ['Module' => 'Page']);
        $this->responseData = $page;
        $this->responseView = view('page::admin.page.show', compact('page'));
        return $this -> respond($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(PageAdminRequest $request)
    {

        $page = $this->model->newInstance([]);

        Form::populate($page);

        $this->responseCode = 200;
        $this->responseMessage = trans('messages.success.loaded', ['Module' => 'Page']);
        $this->responseData = $page;
        $this->responseView = view('page::admin.page.create', compact('page'));
        return $this -> respond($request);

    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(PageAdminRequest $request)
    {
        try {
            $attributes = $request->all();
            $page = $this->model->create($attributes);

            $this->responseCode = 201;
            $this->responseMessage = trans('messages.success.created', ['Module' => 'Page']);
            $this->responseData = $page;
            $this->responseMeta = '';
            $this->responseRedirect = trans_url('/admin/page/page/'.$page->getRouteKey());
            $this->responseView = view('page::admin.page.create', compact('page'));

            return $this -> respond($request);

        } catch (Exception $e) {
            $this->responseCode = 400;
            $this->responseMessage = $e->getMessage();
            return $this -> respond($request);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function edit(PageAdminRequest $request, Page $page)
    {
        Form::populate($page);
        $this->responseCode = 200;
        $this->responseMessage = trans('messages.success.loaded', ['Module' => 'Page']);
        $this->responseData = $page;
        $this->responseView = view('page::admin.page.edit', compact('page'));

        return $this -> respond($request);
    }

    /**
     * Update the specified resource.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function update(PageAdminRequest $request, Page $page)
    {
        try {

            $attributes = $request->all();

            $page->update($attributes);

            $this->responseCode = 204;
            $this->responseMessage = trans('messages.success.updated', ['Module' => 'Page']);
            $this->responseData = $page;
            $this->responseRedirect = trans_url('/admin/page/page/'.$page->getRouteKey());

            return $this -> respond($request);

        } catch (Exception $e) {

            $this->responseCode = 400;
            $this->responseMessage = $e->getMessage();
            $this->responseRedirect = trans_url('/admin/page/page/'.$page->getRouteKey());

            return $this -> respond($request);
        }
    }

    /**
     * Remove the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy(PageAdminRequest $request, Page $page)
    {

        try {

            $t = $page->delete();

            $this->responseCode = 202;
            $this->responseMessage = trans('messages.success.deleted', ['Module' => 'Page']);
            $this->responseData = $page;
            $this->responseMeta = '';
            $this->responseRedirect = trans_url('/admin/page/page/0');

            return $this -> respond($request);

        } catch (Exception $e) {

            $this->responseCode = 400;
            $this->responseMessage = $e->getMessage();
            $this->responseRedirect = trans_url('/admin/page/page/'.$page->getRouteKey());

            return $this -> respond($request);

        }
    }
}
