<?php

namespace App\Http\Controllers\Admin;

use App\Filters\ParentFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PackageRequest;
use App\Models\TPackage;
use Illuminate\Http\Request;

class PackageController extends Controller
{
            protected $model;

    public function __construct(TPackage $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $pageTitle = trans('navigation.packages');
        $pageDescription = trans('navigation.packages');

        return view('admin.packages.index', compact('pageTitle', 'pageDescription'));
    }


    public function form()
    {
        $id = request('id');
        $package = null;

        if ($id) {
            $package = $this->model->findOrFail($id);
        }

        $inputs = [
            [
                'name' => 's_title',
                'type' => 'text',
                'label' => __('general.name'),
            ],
            [
                'name' => 's_instruction',
                'type' => 'textarea',
                'label' => __('general.instruction'),
                'rows' => '2'
            ]
        ];


        return response()->json(
            [
                'title' => trans('general.add_edit'),
                'page' => view('admin.packages.form', compact('package', 'inputs'))->render()
            ]
        );
    }

    public function store(PackageRequest $request)
    {

        $input = $request->except('s_cover');

        if ($request->hasFile('s_cover')) {
            $input['s_cover'] = $request->file('s_cover')->store('uploads/packages');
        }

        if ($id = $request->get('pk_i_id')) {
            $package = $this->model->find($id);
            $package->update($input);
        } else {
            $package = $this->model->create($input);
        }


        return response()->json([
            'success' => true,
            'message' => trans('alerts.successfully_added'),
            'data' => $package
        ]);
    }

    public function updateStatus(Request $request)
    {
        $package = $this->model->findOrFail($request->id);
        $package->b_enabled = (int)$request->enabled;
        $package->save();

        return response()->json(['message' => 'User status updated successfully.']);
    }


    public function destroy(TPackage $package)
    {
        $package->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', trans('alerts.successfully_deleted'));
    }


    public function datatable(ParentFilter $filters)
    {
        $packages = $this->model->select('t_packages.*')->filter($filters)->distinct();

        return datatables($packages)->addColumn('actions_column', function ($row) {
            return view('admin.packages.datatable.actions', compact('row'));
        })->rawColumns(['enabled_html', 'actions_column'])->make(true);
    }
}
