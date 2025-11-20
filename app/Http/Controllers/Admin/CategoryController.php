<?php

namespace App\Http\Controllers\Admin;

use App\Filters\ParentFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Models\TCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
        protected $model;

    public function __construct(TCategory $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $pageTitle = trans('navigation.categories');
        $pageDescription = trans('navigation.categories');

        return view('admin.categories.index', compact('pageTitle', 'pageDescription'));
    }


    public function form()
    {
        $id = request('id');
        $category = null;

        if ($id) {
            $category = $this->model->findOrFail($id);
        }

        $inputs = [
            [
                'name' => 's_name',
                'type' => 'text',
                'label' => __('general.name'),
            ]
        ];


        return response()->json(
            [
                'title' => trans('general.add_edit'),
                'page' => view('admin.categories.form', compact('category', 'inputs'))->render()
            ]
        );
    }

    public function store(StoreCategoryRequest $request)
    {

        $input = $request->except('s_cover');

        if ($request->hasFile('s_cover')) {
            $input['s_cover'] = $request->file('s_cover')->store('uploads/categories');
        }

        if ($id = $request->get('pk_i_id')) {
            $category = $this->model->find($id);
            $category->update($input);
        } else {
            $category = $this->model->create($input);
        }


        return response()->json([
            'success' => true,
            'message' => trans('alerts.successfully_added'),
            'data' => $category
        ]);
    }

    public function updateStatus(Request $request)
    {
        $category = $this->model->findOrFail($request->id);
        $category->b_enabled = (int)$request->enabled;
        $category->save();

        return response()->json(['message' => 'User status updated successfully.']);
    }


    public function destroy(TCategory $category)
    {
        $category->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', trans('alerts.successfully_deleted'));
    }


    public function datatable(ParentFilter $filters)
    {
        $categories = $this->model->select('t_categories.*')->filter($filters)->distinct();

        return datatables($categories)->addColumn('actions_column', function ($row) {
            return view('admin.categories.datatable.actions', compact('row'));
        })->rawColumns(['enabled_html', 'actions_column'])->make(true);
    }
}
