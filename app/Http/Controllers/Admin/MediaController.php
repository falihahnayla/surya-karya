<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index()
    {
        $mediaItems = Media::latest()->get();
        return view('admin.media.index', compact('mediaItems'));
    }

    public function create()
    {
        return view('admin.media.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'url' => 'required|string',
        ]);

        Media::create($request->only('title', 'url'));

        return redirect()->route('admin.media.index')->with('success', 'Data Media / Sosial Media berhasil ditambahkan.');
    }

    public function edit(Media $medium)
    {
        return view('admin.media.edit', compact('medium'));
    }

    public function update(Request $request, Media $medium)
    {
        $request->validate([
            'title' => 'required|string',
            'url' => 'required|string',
        ]);

        $medium->update($request->only('title', 'url'));

        return redirect()->route('admin.media.index')->with('success', 'Data Media / Sosial Media berhasil diperbarui.');
    }

    public function destroy(Media $medium)
    {
        $medium->delete();
        return redirect()->route('admin.media.index')->with('success', 'Data Media / Sosial Media berhasil dihapus.');
    }
}
