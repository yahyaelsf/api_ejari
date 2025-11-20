<?php

namespace App\Http\Controllers\Admin;

use App\Filters\ParentFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Models\TUser;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $model;

    public function __construct(TUser $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $pageTitle = trans('navigation.users');
        $pageDescription = trans('navigation.users');

        return view('admin.users.index', compact('pageTitle', 'pageDescription'));
    }


    public function form()
    {
        $id = request('id');
        $user = null;

        if ($id) {
            $user = $this->model->findOrFail($id);
        }

        return response()->json(
            [
                'title' => trans('general.add_edit'),
                'page' => view('admin.users.form', compact('user'))->render()
            ]
        );
    }

    public function store(StoreUserRequest $request)
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
            $user = $this->model->find($id);
            $user->update($input);
        } else {
            $user = $this->model->create($input);
        }


        return response()->json([
            'success' => true,
            'message' => trans('alerts.successfully_added'),
            'data' => $user
        ]);
    }

    public function updateStatus(Request $request)
    {
        $user = $this->model->findOrFail($request->id);
        $user->b_enabled = $request->enabled;
        $user->save();

        return response()->json(['message' => 'User status updated successfully.']);
    }


    public function destroy(TUser $user)
    {
        $user->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', trans('alerts.successfully_deleted'));
    }


    public function datatable(ParentFilter $filters)
    {
        $users = $this->model->filter($filters);

        return datatables($users)->addColumn('actions_column', function ($row) {
            return view('admin.users.datatable.actions', compact('row'));
        })->rawColumns(['enabled_html', 'actions_column'])->make(true);
    }
}
