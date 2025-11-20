<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $pageTitle = trans('navigation.dashboard');
        $pageDescription = trans('navigation.dashboard');

        return view('admin.home', compact('pageTitle', 'pageDescription'));
    }
    public function privacyPolicy(){
        return view('admin.privacy_policy');
    }
}
