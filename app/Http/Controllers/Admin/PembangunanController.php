<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembangunan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PembangunanController extends Controller
{
    public function index()
    {
        $cards = Pembangunan::where('item_type', 'card')->latest()->get();
        $photos = Pembangunan::where('item_type', 'photo')->latest()->get();
        return view('admin.pembangunan.index', compact('cards', 'photos'));
    }

    public function create(Request $request)
    {
        $type = $request->query('type', 'card');
        return view('admin.pembangunan.create', compact('type'));
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

        Pembangunan::create($validated);

        return redirect()->route('admin.pembangunan.index')
            ->with('success', 'Data Pembangunan berhasil ditambahkan.');
    }

    public function edit(Pembangunan $pembangunan)
    {
        return view('admin.pembangunan.edit', compact('pembangunan'));
    }

    public function update(Request $request, Pembangunan $pembangunan)
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
            $this->deleteImage($pembangunan->image);
            $validated['image'] = $this->uploadImage($request->file('image_file'));
        }
        unset($validated['image_file']);

        $pembangunan->update($validated);

        return redirect()->route('admin.pembangunan.index')
            ->with('success', 'Data Pembangunan berhasil diperbarui.');
    }

    public function destroy(Pembangunan $pembangunan)
    {
        $this->deleteImage($pembangunan->image);
        $pembangunan->delete();

        return redirect()->route('admin.pembangunan.index')
            ->with('success', 'Data Pembangunan berhasil dihapus.');
    }

    private function uploadImage($file): string
    {
        $name = Str::random(20) . '.' . $file->extension();
        $file->move(public_path('uploads/pembangunan'), $name);
        return 'uploads/pembangunan/' . $name;
    }

    private function deleteImage(?string $path): void
    {
        if ($path && File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}
