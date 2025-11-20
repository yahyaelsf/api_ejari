<?php

namespace App\Http\Controllers\Admin;

use App\Filters\ParentFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreEvaluationRequest;
use App\Models\TEvaluation;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    protected $model;

    public function __construct(TEvaluation $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $pageTitle = trans('navigation.evaluations');
        $pageDescription = trans('navigation.evaluations');

        return view('admin.evaluations.index', compact('pageTitle', 'pageDescription'));
    }


    public function form()
    {
        $id = request('id');
        $evaluation = null;

        if ($id) {
            $evaluation = $this->model->findOrFail($id);
        }

        $inputs = [
            [
                'name' => 's_name',
                'type' => 'text',
                'label' => __('general.title'),
            ],
        ];


        return response()->json(
            [
                'title' => trans('general.add_edit'),
                'page' => view('admin.evaluations.form', compact('evaluation', 'inputs'))->render()
            ]
        );
    }

    public function store(StoreEvaluationRequest $request)
    {

        $input = $request->all();
        $localizable = $request->get('localizable');
        if ($id = $request->get('pk_i_id')) {
            $evaluation = $this->model->find($id);
            $evaluation->update($input);
        } else {
            $evaluation = $this->model->create($input);
        }
        $evaluation->syncTranslations($localizable);

        return response()->json([
            'success' => true,
            'message' => trans('alerts.successfully_added'),
            'data' => $evaluation
        ]);
    }

    public function updateStatus(Request $request)
    {
        $evaluation = $this->model->findOrFail($request->id);
        $evaluation->b_enabled = (int)$request->enabled;
        $evaluation->save();

        return response()->json(['message' => 'User status updated successfully.']);
    }


    public function destroy(TEvaluation $evaluation)
    {
        $evaluation->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', trans('alerts.successfully_deleted'));
    }


    public function datatable(ParentFilter $filters)
    {
        $evaluations = $this->model->select('t_evaluations.*')->filter($filters)->distinct();

        return datatables($evaluations)->addColumn('actions_column', function ($row) {
            return view('admin.evaluations.datatable.actions', compact('row'));
        })->rawColumns(['enabled_html', 'actions_column'])->make(true);
    }
}
