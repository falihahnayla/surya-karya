<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SpesifikasiBangunan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SpesifikasiBangunanController extends Controller
{
    public function index()
    {
        $cards = SpesifikasiBangunan::where('item_type', 'card')->latest()->get();
        $photos = SpesifikasiBangunan::where('item_type', 'photo')->latest()->get();
        return view('admin.spesifikasi-bangunan.index', compact('cards', 'photos'));
    }

    public function create(Request $request)
    {
        $type = $request->query('type', 'card');
        return view('admin.spesifikasi-bangunan.create', compact('type'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_type'  => 'required|in:card,photo',
            'title'      => 'required|string|max:225',
            'tag'        => 'nullable|string|max:225',
            'content'    => 'nullable|string',
            'checklist'  => 'nullable|string',
            'image'      => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:5120',
        ]);

        if ($request->hasFile('image_file')) {
            $validated['image'] = $this->uploadImage($request->file('image_file'));
        }
        unset($validated['image_file']);

        SpesifikasiBangunan::create($validated);

        return redirect()->route('admin.spesifikasi-bangunan.index')
            ->with('success', 'Data Spesifikasi Bangunan berhasil ditambahkan.');
    }

    public function edit(SpesifikasiBangunan $spesifikasi_bangunan)
    {
        return view('admin.spesifikasi-bangunan.edit', compact('spesifikasi_bangunan'));
    }

    public function update(Request $request, SpesifikasiBangunan $spesifikasi_bangunan)
    {
        $validated = $request->validate([
            'item_type'  => 'required|in:card,photo',
            'title'      => 'required|string|max:225',
            'tag'        => 'nullable|string|max:225',
            'content'    => 'nullable|string',
            'checklist'  => 'nullable|string',
            'image'      => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:5120',
        ]);

        if ($request->hasFile('image_file')) {
            $this->deleteImage($spesifikasi_bangunan->image);
            $validated['image'] = $this->uploadImage($request->file('image_file'));
        }
        unset($validated['image_file']);

        $spesifikasi_bangunan->update($validated);

        return redirect()->route('admin.spesifikasi-bangunan.index')
            ->with('success', 'Data Spesifikasi Bangunan berhasil diperbarui.');
    }

    public function destroy(SpesifikasiBangunan $spesifikasi_bangunan)
    {
        $this->deleteImage($spesifikasi_bangunan->image);
        $spesifikasi_bangunan->delete();

        return redirect()->route('admin.spesifikasi-bangunan.index')
            ->with('success', 'Data Spesifikasi Bangunan berhasil dihapus.');
    }

    private function uploadImage($file): string
    {
        $name = Str::random(20) . '.' . $file->extension();
        $file->move(public_path('uploads/spesifikasi-bangunan'), $name);
        return 'uploads/spesifikasi-bangunan/' . $name;
    }

    private function deleteImage(?string $path): void
    {
        if ($path && File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}
