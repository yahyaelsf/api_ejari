<?php

namespace App\Http\Controllers\Admin;

use App\Filters\ContactUsFilters;
use App\Http\Controllers\Controller;
use App\Models\TProperty;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    protected $model;

    public function __construct(TProperty $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $pageTitle = trans('navigation.properties');
        $pageDescription = trans('navigation.properties');

        return view('admin.properties.index', compact('pageTitle', 'pageDescription'));
    }


    public function updateStatus(Request $request)
    {
        $property = $this->model->findOrFail($request->id);
        $property->b_enabled = !$property->b_enabled;
        $property->save();

        return response()->json(['message' => 'contact status updated successfully.']);
    }


    public function destroy(TProperty $property)
    {
        $property->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', trans('alerts.successfully_deleted'));
    }

    public function datatable(ContactUsFilters $filters)
    {
        $properties = $this->model->with('category','user')->filter($filters);

        return datatables($properties)->addColumn('actions_column', function ($row) {
            return view('admin.properties.datatable.actions', compact('row'));
        })->addColumn('furnished_label', function ($row) {
            return trans('general.' . strtolower($row->e_furnished));
        })->addColumn('status_label', function ($row) {
           return trans('general.' . strtolower($row->e_status));
        })->rawColumns(['enabled_html', 'actions_column', 'status_label','furnished_label'])->make(true);
    }
}
