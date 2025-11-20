<?php

namespace App\Http\Controllers\Admin;

use App\Models\TAdmin;
use App\Models\TPermission;
use App\Models\TRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    protected $model;

    public function __construct(TRole $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $pageTitle = trans('navigation.roles_and_permissions');
        $pageDescription = trans('navigation.roles_and_permissions');

        return view('admin.roles.index', compact('pageTitle','pageDescription'));
    }


    public function form()
    {
        $id = request('id');
        $role = null;

        if ($id) {
            $role = $this->model->findOrFail($id);
        }

        $basicPermissions = TPermission::whereNull('parent_id')->get();

        return response()->json(
            [
                'title' => trans('general.add_edit'),
                'page' => view('admin.roles.form', compact('role', 'basicPermissions'))->render()
            ]
        );
    }

    public function process(Request $request)
    {
        $input = $request->only(['name', 'display_name']);
        $input['guard_name'] = "admin";

        if ($id = $request->get('pk_i_id')) {
            $role = $this->model->find($id);
            $role->update($input);
            $action = 'update';
        } else {
            $role = $this->model->create($input);
        }

        $permissions = $request->get("permissions");
        $role->syncPermissions($permissions);

        return response()->json([
            'success' => true,
            'message' => $id ? trans('alerts.successfully_updated') : trans('alerts.successfully_added'),
            'action' => $action ?? '',
            'data' => $role
        ]);
    }

    public function destroy(TRole $role)
    {
        if($role->name == "admin") {
            return response()->json(['success' => false]);
        }

        $role->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }
    }



    public function datatable(Request $request)
    {
        $roles = $this->model->all();

        return datatables()->of($roles)->addColumn('actions_column', function ($row) {
            return view('admin.roles.datatable.actions', compact('row'));
        })->rawColumns(['b_enabled_html', 'actions_column'])->make(true);
    }
}
