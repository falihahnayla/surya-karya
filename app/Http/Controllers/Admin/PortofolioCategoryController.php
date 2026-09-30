<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortofolioCategory;
use Illuminate\Http\Request;

class PortofolioCategoryController extends Controller
{
    public function index()
    {
        $categories = PortofolioCategory::withCount('portofolios')->latest()->get();
        return view('admin.portofolio-category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.portofolio-category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
        ]);

        PortofolioCategory::create($request->only('title'));

        return redirect()->route('admin.portofolio-category.index')->with('success', 'Kategori Portofolio berhasil ditambahkan.');
    }

    public function edit(PortofolioCategory $portofolioCategory)
    {
        return view('admin.portofolio-category.edit', compact('portofolioCategory'));
    }

    public function update(Request $request, PortofolioCategory $portofolioCategory)
    {
        $request->validate([
            'title' => 'required|string|max:100',
        ]);

        $portofolioCategory->update($request->only('title'));

        return redirect()->route('admin.portofolio-category.index')->with('success', 'Kategori Portofolio berhasil diperbarui.');
    }

    public function destroy(PortofolioCategory $portofolioCategory)
    {
        $portofolioCategory->delete();
        return redirect()->route('admin.portofolio-category.index')->with('success', 'Kategori Portofolio berhasil dihapus.');
    }
}
