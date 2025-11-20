<?php

namespace App\Http\Controllers\Admin;

use App\Filters\ParentFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRecordRequest;
use App\Models\TRecord;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    protected $model;

    public function __construct(TRecord $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $pageTitle = trans('navigation.records');
        $pageDescription = trans('navigation.records');

        return view('admin.records.index', compact('pageTitle', 'pageDescription'));
    }


    public function form()
    {
        $id = request('id');
        $record = null;

        if ($id) {
            $record = $this->model->findOrFail($id);
        }

        $inputs = [
            [
                'name' => 's_title',
                'type' => 'text',
                'label' => __('general.title'),
            ],
            [
                'name' => 's_description',
                'type' => 'textarea',
                'label' => __('general.description'),
                'rows' => '2'
            ]
        ];


        return response()->json(
            [
                'title' => trans('general.add_edit'),
                'page' => view('admin.records.form', compact('record', 'inputs'))->render()
            ]
        );
    }

    public function store(StoreRecordRequest $request)
    {

        $input = $request->except('s_cover');
        $localizable = $request->get('localizable');

        if ($request->hasFile('s_cover')) {
            $input['s_cover'] = $request->file('s_cover')->store('uploads/records');
        }

        if ($id = $request->get('pk_i_id')) {
            $record = $this->model->find($id);
            $record->update($input);
        } else {
            $record = $this->model->create($input);
        }

        $record->syncTranslations($localizable);

        return response()->json([
            'success' => true,
            'message' => trans('alerts.successfully_added'),
            'data' => $record
        ]);
    }

    public function updateStatus(Request $request)
    {
        $record = $this->model->findOrFail($request->id);
        $record->b_enabled = (int)$request->enabled;
        $record->save();

        return response()->json(['message' => 'User status updated successfully.']);
    }


    public function destroy(TRecord $record)
    {
        $record->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', trans('alerts.successfully_deleted'));
    }


    public function datatable(ParentFilter $filters)
    {
        $records = $this->model->select('t_records.*')->filter($filters)->distinct();

        return datatables($records)->addColumn('actions_column', function ($row) {
            return view('admin.records.datatable.actions', compact('row'));
        })->rawColumns(['enabled_html', 'actions_column'])->make(true);
    }
}
