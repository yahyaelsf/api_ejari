<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StoreSettingsRequest;
use App\Models\TSetting;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function edit()
    {
        $pageTitle = trans('navigation.settings');
        $pageDescription = trans('navigation.settings');

        $settingsConfig = config('settings');
        $settings = TSetting::pluck('s_value', 's_key')->toArray();

        return view('admin.settings.edit', compact('settingsConfig', 'settings', 'pageTitle', 'pageDescription'));
    }


    public function update(StoreSettingsRequest $request)
    {
        $inputs = $request->all();
        foreach ($inputs as $key => $value) {
            $settings = TSetting::updateOrCreate(['s_key' => $key], ['s_value' => $value]);
        }
        return back()->with('success', trans('alerts.settings_updated'));
    }
}
