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
        $home = Home::first() ?? new Home();

        return view('admin.home.index', compact('home'));
    }

    public function update(Request $request)
    {
        $home = Home::first();

        // Jika data belum ada, gambar wajib diupload. Jika sudah ada, gambar opsional.
        $imageRule = ($home ? 'nullable' : 'required') . '|image|mimes:jpg,jpeg,png,webp|max:2048';

        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'subtitle'      => 'required|string|max:500',
            'image_bg'      => $imageRule,
            'image_about'   => $imageRule,
            'content_about' => 'required|string|max:2000',
            'img_desc'      => 'required|string|max:255',
            'service_title' => 'required|string|max:100',
            'service_desc'  => 'required|string|max:255',
        ]);

        foreach (['image_bg', 'image_about'] as $field) {
            if ($request->hasFile($field)) {
                if ($home) {
                    $this->deleteImage($home->$field);
                }
                $validated[$field] = $this->uploadImage($request->file($field));
            } else {
                unset($validated[$field]);
            }
        }

        if ($home) {
            $home->update($validated);
        } else {
            Home::create($validated);
        }

        return redirect()->route('admin.home.index')
            ->with('success', 'Data home berhasil disimpan.');
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