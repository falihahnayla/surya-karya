<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portofolio;
use App\Models\PortofolioCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PortofolioController extends Controller
{
    public function index()
    {
        $categories = PortofolioCategory::withCount('portofolios')->latest()->get();
        $portofolios = Portofolio::with('category')->latest()->get();
        return view('admin.portofolio.index', compact('categories', 'portofolios'));
    }

    public function create()
    {
        $categories = PortofolioCategory::all();
        return view('admin.portofolio.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->merge(['is_featured' => $request->boolean('is_featured')]);

        $validated = $request->validate([
            'category_id' => 'nullable|exists:portofolio_categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:5120',
            'status' => 'required|in:Show,Hide',
            'is_featured' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image_file')) {
            $validated['image'] = $this->uploadImage($request->file('image_file'));
        }

        unset($validated['image_file']);

        Portofolio::create($validated);

        return redirect()->route('admin.portofolio.index')->with('success', 'Data Portofolio berhasil ditambahkan.');
    }

    public function edit(Portofolio $portofolio)
    {
        $categories = PortofolioCategory::all();
        return view('admin.portofolio.edit', compact('portofolio', 'categories'));
    }

    public function update(Request $request, Portofolio $portofolio)
    {
        $request->merge(['is_featured' => $request->boolean('is_featured')]);

        $validated = $request->validate([
            'category_id' => 'nullable|exists:portofolio_categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:5120',
            'status' => 'required|in:Show,Hide',
            'is_featured' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image_file')) {
            $this->deleteImage($portofolio->image);
            $validated['image'] = $this->uploadImage($request->file('image_file'));
        }

        unset($validated['image_file']);

        $portofolio->update($validated);

        return redirect()->route('admin.portofolio.index')->with('success', 'Data Portofolio berhasil diperbarui.');
    }

    public function destroy(Portofolio $portofolio)
    {
        $this->deleteImage($portofolio->image);
        $portofolio->delete();
        return redirect()->route('admin.portofolio.index')->with('success', 'Data Portofolio berhasil dihapus.');
    }

    private function uploadImage($file): string
    {
        $name = Str::random(20) . '.' . $file->extension();
        $file->move(public_path('uploads/portofolio'), $name);

        return 'uploads/portofolio/' . $name;
    }

    private function deleteImage(?string $path): void
    {
        if ($path && File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}
