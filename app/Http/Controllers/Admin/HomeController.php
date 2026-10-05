<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        $items = Home::latest()->get();

        return view('admin.home.index', compact('items'));
    }

    public function create()
    {
        return view('admin.home.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'subtitle'      => 'required|string',
            'image_bg'      => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image_about'   => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'content_about' => 'required|string|max:255',
            'img_desc'      => 'required|string|max:255',
            'service_title' => 'required|string|max:100',
            'service_desc'  => 'required|string|max:100',
        ]);

        $validated['image_bg']    = $this->uploadImage($request->file('image_bg'));
        $validated['image_about'] = $this->uploadImage($request->file('image_about'));

        Home::create($validated);

        return redirect()->route('admin.home.index')
            ->with('success', 'Data home berhasil ditambahkan.');
    }

    public function edit(Home $home)
    {
        return view('admin.home.edit', compact('home'));
    }

    public function update(Request $request, Home $home)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'subtitle'      => 'required|string',
            'image_bg'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image_about'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'content_about' => 'required|string|max:255',
            'img_desc'      => 'required|string|max:255',
            'service_title' => 'required|string|max:100',
            'service_desc'  => 'required|string|max:100',
        ]);

        foreach (['image_bg', 'image_about'] as $field) {
            if ($request->hasFile($field)) {
                $this->deleteImage($home->$field);
                $validated[$field] = $this->uploadImage($request->file($field));
            } else {
                unset($validated[$field]);
            }
        }

        $home->update($validated);

        return redirect()->route('admin.home.index')
            ->with('success', 'Data home berhasil diperbarui.');
    }

    public function destroy(Home $home)
    {
        $this->deleteImage($home->image_bg);
        $this->deleteImage($home->image_about);

        $home->delete();

        return redirect()->route('admin.home.index')
            ->with('success', 'Data home berhasil dihapus.');
    }

    /**
     * Simpan gambar ke public/uploads/home dan kembalikan path relatifnya.
     */
    private function uploadImage($file): string
    {
        $name = Str::random(20) . '.' . $file->extension();
        $file->move(public_path('uploads/home'), $name);

        return 'uploads/home/' . $name;
    }

    /**
     * Hapus file gambar di folder public (jika ada).
     */
    private function deleteImage(?string $path): void
    {
        if ($path && File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}