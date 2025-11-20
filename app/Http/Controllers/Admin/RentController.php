<?php

namespace App\Http\Controllers\Admin;

use App\Filters\ContactUsFilters;
use App\Http\Controllers\Controller;
use App\Models\TRentRequest;
use Illuminate\Http\Request;

class RentController extends Controller
{
        protected $model;

    public function __construct(TRentRequest $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $pageTitle = trans('navigation.rent_request');
        $pageDescription = trans('navigation.rent_request');

        return view('admin.rent_requests.index', compact('pageTitle', 'pageDescription'));
    }


    public function updateStatus(Request $request)
    {
        $rent_request = $this->model->findOrFail($request->id);
        $rent_request->b_enabled = !$rent_request->b_enabled;
        $rent_request->save();

        return response()->json(['message' => 'contact status updated successfully.']);
    }


    public function destroy(TRentRequest $rent_request)
    {
        $rent_request->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', trans('alerts.successfully_deleted'));
    }

    public function datatable(ContactUsFilters $filters)
    {
        $rent_requests = $this->model->with('category','user')->filter($filters);

        return datatables($rent_requests)->addColumn('actions_column', function ($row) {
            return view('admin.rent_requests.datatable.actions', compact('row'));
        })->addColumn('furnished_label', function ($row) {
            return trans('general.' . strtolower($row->e_furnished));
        })->addColumn('status_label', function ($row) {
           return trans('general.' . strtolower($row->e_status));
        })->rawColumns(['enabled_html', 'actions_column', 'status_label','furnished_label'])->make(true);
    }
}
