<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first() ?? new Setting();
        return view('admin.settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'company' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'website' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:50',
            'favicon' => 'nullable|string',
            'description' => 'nullable|string',
            'logo' => 'nullable|string',
            'footer_text' => 'nullable|string',
        ]);

        $setting = Setting::first();
        if ($setting) {
            $setting->update($request->all());
        } else {
            Setting::create($request->all());
        }

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan Website (Settings) berhasil disimpan.');
    }
}
