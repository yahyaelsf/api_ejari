<?php

namespace App\Http\Controllers\Admin;

use App\Filters\ParentFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Http\Requests\Admin\StoreAdminRequest;
use App\Models\TAdmin;
use App\Models\TRole;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $model;

    public function __construct(TAdmin $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $pageTitle = trans('navigation.admins');
        $pageDescription = trans('navigation.admins');

        return view('admin.admins.index', compact('pageTitle','pageDescription'));
    }


    public function form()
    {
        $id = request('id');
        $admin = null;

        if ($id) {
            $admin = $this->model->findOrFail($id);
        }

        $roles = TRole::pluck('display_name', 'id')->prepend( __('general.please_choose'), '');

        return response()->json(
            [
                'title' => trans('general.add_edit'),
                'page' => view('admin.admins.form', compact('admin', 'roles'))->render()
            ]
        );
    }

    public function store(StoreAdminRequest $request)
    {
        $input = $request->except('s_confirm_password', 's_password');
        $s_password = $request->get('s_password');

        if ($s_password) {
            $input['s_password'] = $s_password;
        }

        if ($request->hasFile('s_avatar')) {
            $input['s_avatar'] = $request->file('s_avatar')->store('uploads/avatars');
        }


        if ($id = $request->get('pk_i_id')) {
            $admin = $this->model->find($id);
            $admin->update($input);
        } else {
            $admin = $this->model->create($input);
        }

        $admin->syncRoles($input['fk_i_role_id']);

        return response()->json([
            'success' => true,
            'message' => trans('alerts.successfully_added'),
            'data' => $admin
        ]);
    }

    public function updateStatus(Request $request)
    {
        $admin = $this->model->findOrFail($request->id);
        $admin->b_enabled = (int) $request->enabled;
        $admin->save();

        return response()->json(['message' => 'User status updated successfully.']);
    }


    public function destroy(TAdmin $admin)
    {
        $admin->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', trans('alerts.successfully_deleted'));
    }


    public function datatable(ParentFilter $filters)
    {
        $admins = $this->model->filter($filters);

        return datatables($admins)->addColumn('actions_column', function ($row) {
            return view('admin.admins.datatable.actions', compact('row'));
        })->rawColumns(['enabled_html', 'actions_column'])->make(true);
    }
}
