<?php

namespace Lavalite\Page\Http\Requests;

use App\Http\Requests\Request;

class PageAdminRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(\Illuminate\Http\Request $request)
    {
        $page = $this->route('page');

// Determine if the user is authorized to access page module,
        if (is_null($page)) {
            return $request->user('admin.web')->canDo('page.page.view');
        }

// Determine if the user is authorized to create an entry,
        if ($request->isMethod('POST') || $request->is('*/create')) {
            return $request->user('admin.web')->can('create', $page);
        }

// Determine if the user is authorized to update an entry,
        if ($request->isMethod('PUT') || $request->isMethod('PATCH') || $request->is('*/edit')) {
            return $request->user('admin.web')->can('update', $page);
        }

// Determine if the user is authorized to delete an entry,
        if ($request->isMethod('DELETE')) {
            return $request->user('admin.web')->can('delete', $page);
        }

        // Determine if the user is authorized to view the module.
        return $request->user('admin.web')->can('view', $page);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(\Illuminate\Http\Request $request)
    {

// validation rule for create request.
        if ($request->isMethod('POST')) {
            return [
                'name'    => 'required',
                'content' => 'required',
            ];
        }

// Validation rule for update request.
        if ($request->isMethod('PUT') || $request->isMethod('PATCH')) {
            return [
                'name' => 'required',
            ];
        }

        // Default validation rule.
        return [

        ];
    }

}
