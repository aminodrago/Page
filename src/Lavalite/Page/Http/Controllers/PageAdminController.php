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
        parent::__construct();
        $this->model = $page;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(PageAdminRequest $request)
    {

        if ($request->wantsJson()) {
            $array = $this->model->setPresenter('\\Lavalite\\Page\\Repositories\\Presenter\\PageListPresenter')->all(['*']);

            return $array;
        }

        $this->theme->prependTitle(trans('page::page.names').' :: ');

        return $this->theme->of('page::admin.page.index')->render();
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
            if ($request->wantsJson()) {
                return [];
            }

            return view('page::admin.page.new');
        }

        if ($request->wantsJson()) {
            return $page;
        }

        Form::populate($page);

        return view('page::admin.page.show', compact('page'));
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

        $page = $this->model->find(0);

        Form::populate($page);

        return view('page::admin.page.create', compact('page'));
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

            return $this->success(trans('messages.success.created', ['Module' => 'Page']), 201);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
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

        return view('page::admin.page.edit', compact('page'));
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

            return $this->success(trans('messages.success.updated', ['Module' => 'Page']), 201);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
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

            return $this->success(trans('messages.success.deleted', ['Module' => 'Page']), 201);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
