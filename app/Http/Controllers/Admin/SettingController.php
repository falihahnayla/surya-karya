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
        $data = $request->validate([
            'company'     => 'nullable|string|max:255',
            'address'     => 'nullable|string|max:255',
            'phone'       => 'nullable|string|max:255',
            'email'       => 'nullable|string|email|max:255',
            'website'     => 'nullable|string|max:255',
            'whatsapp'    => ['nullable', 'string', 'max:50', 'regex:/^\+?[0-9\s\-]{8,20}$/'],
            'favicon'     => 'nullable|string',
            'description' => 'nullable|string',
            'logo'        => 'nullable|string',
            'footer_text' => 'nullable|string',
        ], [
            'whatsapp.regex' => 'Format nomor WhatsApp tidak valid. Contoh: 08123456789 atau 628123456789.',
        ]);

        $setting = Setting::first();

        if ($setting) {
            $setting->update($data);
        } else {
            Setting::create($data);
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Pengaturan Website (Settings) berhasil disimpan.');
    }
}