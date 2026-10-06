<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Renovasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class RenovasiController extends Controller
{
    public function index()
    {
        $cards = Renovasi::where('item_type', 'card')->latest()->get();
        $photos = Renovasi::where('item_type', 'photo')->latest()->get();
        return view('admin.renovasi.index', compact('cards', 'photos'));
    }

    public function create(Request $request)
    {
        $type = $request->query('type', 'card');
        return view('admin.renovasi.create', compact('type'));
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

        Renovasi::create($validated);

        return redirect()->route('admin.renovasi.index')
            ->with('success', 'Data Renovasi berhasil ditambahkan.');
    }

    public function edit(Renovasi $renovasi)
    {
        return view('admin.renovasi.edit', compact('renovasi'));
    }

    public function update(Request $request, Renovasi $renovasi)
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
            $this->deleteImage($renovasi->image);
            $validated['image'] = $this->uploadImage($request->file('image_file'));
        }
        unset($validated['image_file']);

        $renovasi->update($validated);

        return redirect()->route('admin.renovasi.index')
            ->with('success', 'Data Renovasi berhasil diperbarui.');
    }

    public function destroy(Renovasi $renovasi)
    {
        $this->deleteImage($renovasi->image);
        $renovasi->delete();

        return redirect()->route('admin.renovasi.index')
            ->with('success', 'Data Renovasi berhasil dihapus.');
    }

    private function uploadImage($file): string
    {
        $name = Str::random(20) . '.' . $file->extension();
        $file->move(public_path('uploads/renovasi'), $name);
        return 'uploads/renovasi/' . $name;
    }

    private function deleteImage(?string $path): void
    {
        if ($path && File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}
