<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StorePermissionRequest;
use App\Models\TPermission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    protected $model;

    public function __construct(TPermission $model)
    {
        $this->model = $model;
    }


    public function index()
    {
        return view('admin.permissions.index');
    }


    public function form()
    {
        $id = intval(request('id'));
        $permission = null;

        if ($id) {
            $permission = $this->model->findOrFail($id);
        }

        $parents = TPermission::whereNull('parent_id')->pluck('display_name', 'id')->prepend( __('general.please_choose'), '');

        return response()->json(
            [
                'title' => trans('general.add_edit'),
                'page' => view('admin.permissions.form', compact('permission', 'parents'))->render()
            ]
        );
    }

    public function process(StorePermissionRequest $request)
    {
        $id = $request->get('pk_i_id');
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        if ($id) {
            $permission = $this->model->find($id);
            $permission->update($request->only(['display_name', 'parent_id']));
            $action = 'update';
        } else {
            $permission = $this->model->create($request->only(['name', 'display_name', 'parent_id']));
        }



        return response()->json([
            'success' => true,
            'message' => $id ? trans('alerts.successfully_updated') : trans('alerts.successfully_added'),
            'action' => $action ?? '',
            'data' => $permission
        ]);
    }


    public function destroy(TPermission $permission)
    {
        $permission->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', trans('alerts.successfully_deleted'));
    }


    public function datatable(Request $request)
    {
        $permissions = $this->model->select('permissions.*')->whereNotNull('parent_id');;
        return datatables()->of($permissions)->addColumn('actions_column', function ($row) {
            return view('admin.permissions.datatable.actions', compact('row'));
        })->rawColumns(['actions_column'])->make(true);
    }
}
