<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroTitle;
use Illuminate\Http\Request;

class HeroTitleController extends Controller
{
    public function index()
    {
        $heroTitles = HeroTitle::latest()->get();
        return view('admin.hero-title.index', compact('heroTitles'));
    }

    public function create()
    {
        return view('admin.hero-title.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'page' => 'required|string|unique:hero_titles,page|max:255',
            'title' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        HeroTitle::create($request->all());

        return redirect()->route('admin.hero-title.index')->with('success', 'Data Hero Title berhasil ditambahkan.');
    }

    public function edit(HeroTitle $heroTitle)
    {
        return view('admin.hero-title.edit', compact('heroTitle'));
    }

    public function update(Request $request, HeroTitle $heroTitle)
    {
        $request->validate([
            'page' => 'required|string|max:255|unique:hero_titles,page,' . $heroTitle->id,
            'title' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $heroTitle->update($request->all());

        return redirect()->route('admin.hero-title.index')->with('success', 'Data Hero Title berhasil diperbarui.');
    }

    public function destroy(HeroTitle $heroTitle)
    {
        $heroTitle->delete();
        return redirect()->route('admin.hero-title.index')->with('success', 'Data Hero Title berhasil dihapus.');
    }
}
