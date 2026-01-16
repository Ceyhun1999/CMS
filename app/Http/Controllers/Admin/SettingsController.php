<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SystemSetting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{

    public function index() {
        $settings = SystemSetting::query()->first();
        return view('admin.settings.index', [
            'settings' => $settings
        ]);
    }

    public function update(Request $request)
    {
        //Нужно будет кэшировать
        $validated = $request->validate([
            'website_name' => ['required', 'string', 'max:255'],
            'website_shortname' => ['nullable', 'string', 'max:100'],
            'website_url' => ['required', 'url', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:1000'],
            'meta_keywords' => ['nullable', 'string', 'max:1000'],
            'website_offline' => ['boolean'],
        ]);

        $settings = SystemSetting::first();

        if (!$settings) {
            $settings = SystemSetting::create($validated);
        } else {
            $settings->update($validated);
        }
        
        return redirect()->route('admin.settings')->with('success', 'Настройки успешно сохранены');
    }
}
