<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AlurKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AlurKerjaController extends Controller
{
    public function index()
    {
        $items = AlurKerja::orderBy('no')->get();

        return view('admin.alur-kerja.index', compact('items'));
    }

    public function create()
    {
        return view('admin.alur-kerja.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no'      => 'required|integer|min:1',
            'title'   => 'required|string|max:225',
            'content' => 'required|string|max:255',
            'image'   => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['image'] = $this->uploadImage($request->file('image'));

        AlurKerja::create($validated);

        return redirect()->route('admin.alur-kerja.index')
            ->with('success', 'Data alur kerja sama berhasil ditambahkan.');
    }

    public function edit(AlurKerja $alur_kerja)
    {
        return view('admin.alur-kerja.edit', compact('alur_kerja'));
    }

    public function update(Request $request, AlurKerja $alur_kerja)
    {
        $validated = $request->validate([
            'no'      => 'required|integer|min:1',
            'title'   => 'required|string|max:225',
            'content' => 'required|string|max:255',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $this->deleteImage($alur_kerja->image);
            $validated['image'] = $this->uploadImage($request->file('image'));
        } else {
            unset($validated['image']);
        }

        $alur_kerja->update($validated);

        return redirect()->route('admin.alur-kerja.index')
            ->with('success', 'Data alur kerja sama berhasil diperbarui.');
    }

    public function destroy(AlurKerja $alur_kerja)
    {
        $this->deleteImage($alur_kerja->image);

        $alur_kerja->delete();

        return redirect()->route('admin.alur-kerja.index')
            ->with('success', 'Data alur kerja sama berhasil dihapus.');
    }

    /**
     * Simpan gambar ke public/uploads/alur-kerja dan kembalikan path relatifnya.
     */
    private function uploadImage($file): string
    {
        $name = Str::random(20) . '.' . $file->extension();
        $file->move(public_path('uploads/alur-kerja'), $name);

        return 'uploads/alur-kerja/' . $name;
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