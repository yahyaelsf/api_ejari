<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class LocalizationController extends Controller
{
    public function __invoke()
    {

        $language = request()->get('language');


        if (in_array($language, ['ar', 'en'])) {
            session(['language' => $language]);
            app()->setLocale($language);
        }

        return back();
    }
}
