<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServicePanel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ServicePanelController extends Controller
{
    public function create()
    {
        return view('admin.service-panel.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'panel_key'  => 'required|string|unique:service_panels,panel_key|max:255',
            'eyebrow'    => 'nullable|string|max:255',
            'title'      => 'nullable|string|max:255',
            'deskripsi'  => 'nullable|string',
            'image'      => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:5120',
        ]);

        if ($request->hasFile('image_file')) {
            $validated['image'] = $this->uploadImage($request->file('image_file'));
        }
        unset($validated['image_file']);

        ServicePanel::create($validated);

        return redirect()->route('admin.hero-title.index')->with('success', 'Data Panel Layanan berhasil ditambahkan.');
    }

    public function edit(ServicePanel $servicePanel)
    {
        return view('admin.service-panel.edit', compact('servicePanel'));
    }

    public function update(Request $request, ServicePanel $servicePanel)
    {
        $validated = $request->validate([
            'panel_key'  => 'required|string|max:255|unique:service_panels,panel_key,' . $servicePanel->id,
            'eyebrow'    => 'nullable|string|max:255',
            'title'      => 'nullable|string|max:255',
            'deskripsi'  => 'nullable|string',
            'image'      => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:5120',
        ]);

        if ($request->hasFile('image_file')) {
            $this->deleteImage($servicePanel->image);
            $validated['image'] = $this->uploadImage($request->file('image_file'));
        }
        unset($validated['image_file']);

        $servicePanel->update($validated);

        return redirect()->route('admin.hero-title.index')->with('success', 'Data Panel Layanan berhasil diperbarui.');
    }

    public function destroy(ServicePanel $servicePanel)
    {
        $this->deleteImage($servicePanel->image);
        $servicePanel->delete();
        return redirect()->route('admin.hero-title.index')->with('success', 'Data Panel Layanan berhasil dihapus.');
    }

    private function uploadImage($file): string
    {
        $name = Str::random(20) . '.' . $file->extension();
        $file->move(public_path('uploads/service-panel'), $name);
        return 'uploads/service-panel/' . $name;
    }

    private function deleteImage(?string $path): void
    {
        if ($path && File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}
