<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StandarMutu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class StandarMutuController extends Controller
{
    public function index()
    {
        $cards = StandarMutu::where('item_type', 'card')->latest()->get();
        $photos = StandarMutu::where('item_type', 'photo')->latest()->get();
        return view('admin.standar-mutu.index', compact('cards', 'photos'));
    }

    public function create(Request $request)
    {
        $type = $request->query('type', 'card');
        return view('admin.standar-mutu.create', compact('type'));
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

        StandarMutu::create($validated);

        return redirect()->route('admin.standar-mutu.index')
            ->with('success', 'Data Standar Mutu berhasil ditambahkan.');
    }

    public function edit(StandarMutu $standar_mutu)
    {
        return view('admin.standar-mutu.edit', compact('standar_mutu'));
    }

    public function update(Request $request, StandarMutu $standar_mutu)
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
            $this->deleteImage($standar_mutu->image);
            $validated['image'] = $this->uploadImage($request->file('image_file'));
        }
        unset($validated['image_file']);

        $standar_mutu->update($validated);

        return redirect()->route('admin.standar-mutu.index')
            ->with('success', 'Data Standar Mutu berhasil diperbarui.');
    }

    public function destroy(StandarMutu $standar_mutu)
    {
        $this->deleteImage($standar_mutu->image);
        $standar_mutu->delete();

        return redirect()->route('admin.standar-mutu.index')
            ->with('success', 'Data Standar Mutu berhasil dihapus.');
    }

    private function uploadImage($file): string
    {
        $name = Str::random(20) . '.' . $file->extension();
        $file->move(public_path('uploads/standar-mutu'), $name);
        return 'uploads/standar-mutu/' . $name;
    }

    private function deleteImage(?string $path): void
    {
        if ($path && File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}
