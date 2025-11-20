<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;

class AuthController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function login(LoginRequest $request)
    {
        $email = trim($request->get('s_email'));
        $password = $request->get('s_password');

        if (auth('admin')->attempt(['s_email' => $email, 'password' => $password], false)) {
            return redirect()->route('admin.home');
        }

        return view('admin.login')->with('loginError', trans('alerts.wrong_credentials'));
    }

    public function logout()
    {
        auth('admin')->logout();
        return redirect()->route('admin.login');
    }
}
