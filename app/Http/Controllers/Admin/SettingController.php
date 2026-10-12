<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

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
            'company'      => 'nullable|string|max:100',
            'address'      => 'nullable|string|max:500',
            'phone'        => 'nullable|string|max:50',
            'email'        => ['nullable', 'string', 'max:100', new \App\Rules\ValidEmailDns()],
            'website'      => 'nullable|string|max:255',
            'whatsapp'     => ['nullable', 'string', 'max:50', 'regex:/^\+?[0-9\s\-]{8,20}$/'],
            'favicon'      => 'nullable|string|max:255',
            'favicon_file' => 'nullable|file|mimes:ico,png,jpg,jpeg,webp,svg|max:2048',
            'description'  => 'nullable|string|max:2000',
            'logo'         => 'nullable|string|max:255',
            'logo_file'    => 'nullable|file|mimes:jpg,jpeg,png,webp,svg,ico|max:5120',
            'footer_text'  => 'nullable|string|max:1000',
        ], [
            'whatsapp.regex' => 'Format nomor WhatsApp tidak valid. Contoh: 08123456789 atau 628123456789.',
            'company.max'    => 'Nama perusahaan maksimal 100 karakter.',
            'address.max'    => 'Alamat maksimal 500 karakter.',
            'email.max'      => 'Email maksimal 100 karakter.',
        ]);

        $setting = Setting::first();

        // Handle upload Logo
        if ($request->hasFile('logo_file')) {
            if ($setting && $setting->logo && File::exists(public_path($setting->logo))) {
                File::delete(public_path($setting->logo));
            }
            $file = $request->file('logo_file');
            $name = 'logo_' . Str::random(15) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/settings'), $name);
            $data['logo'] = 'uploads/settings/' . $name;
        }
        unset($data['logo_file']);

        // Handle upload Favicon
        if ($request->hasFile('favicon_file')) {
            if ($setting && $setting->favicon && File::exists(public_path($setting->favicon))) {
                File::delete(public_path($setting->favicon));
            }
            $file = $request->file('favicon_file');
            $name = 'favicon_' . Str::random(15) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/settings'), $name);
            $data['favicon'] = 'uploads/settings/' . $name;
        }
        unset($data['favicon_file']);

        if ($setting) {
            $setting->update($data);
        } else {
            Setting::create($data);
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Pengaturan Website (Settings) berhasil disimpan.');
    }
}