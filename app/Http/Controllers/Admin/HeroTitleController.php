<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroTitle;
use App\Models\ServicePanel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class HeroTitleController extends Controller
{
    public function index()
    {
        $heroTitles = HeroTitle::latest()->get();
        $servicePanels = ServicePanel::latest()->get();
        return view('admin.hero-title.index', compact('heroTitles', 'servicePanels'));
    }

    public function create()
    {
        return view('admin.hero-title.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'page'       => 'required|string|unique:hero_titles,page|max:255',
            'title'      => 'nullable|string',
            'deskripsi'  => 'nullable|string',
            'image'      => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:5120',
        ]);

        if ($request->hasFile('image_file')) {
            $validated['image'] = $this->uploadImage($request->file('image_file'));
        }
        unset($validated['image_file']);

        HeroTitle::create($validated);

        return redirect()->route('admin.hero-title.index')->with('success', 'Data Hero Title berhasil ditambahkan.');
    }

    public function edit(HeroTitle $heroTitle)
    {
        return view('admin.hero-title.edit', compact('heroTitle'));
    }

    public function update(Request $request, HeroTitle $heroTitle)
    {
        $validated = $request->validate([
            'page'       => 'required|string|max:255|unique:hero_titles,page,' . $heroTitle->id,
            'title'      => 'nullable|string',
            'deskripsi'  => 'nullable|string',
            'image'      => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:5120',
        ]);

        if ($request->hasFile('image_file')) {
            $this->deleteImage($heroTitle->image);
            $validated['image'] = $this->uploadImage($request->file('image_file'));
        }
        unset($validated['image_file']);

        $heroTitle->update($validated);

        return redirect()->route('admin.hero-title.index')->with('success', 'Data Hero Title berhasil diperbarui.');
    }

    public function destroy(HeroTitle $heroTitle)
    {
        $this->deleteImage($heroTitle->image);
        $heroTitle->delete();
        return redirect()->route('admin.hero-title.index')->with('success', 'Data Hero Title berhasil dihapus.');
    }

    private function uploadImage($file): string
    {
        $name = Str::random(20) . '.' . $file->extension();
        $file->move(public_path('uploads/hero-title'), $name);
        return 'uploads/hero-title/' . $name;
    }

    private function deleteImage(?string $path): void
    {
        if ($path && File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}
