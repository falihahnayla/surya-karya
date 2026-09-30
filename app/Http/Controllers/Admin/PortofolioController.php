<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portofolio;
use App\Models\PortofolioCategory;
use Illuminate\Http\Request;

class PortofolioController extends Controller
{
    public function index()
    {
        $portofolios = Portofolio::with('category')->latest()->get();
        return view('admin.portofolio.index', compact('portofolios'));
    }

    public function create()
    {
        $categories = PortofolioCategory::all();
        return view('admin.portofolio.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'nullable|exists:portofolio_categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|string',
            'status' => 'required|in:Show,Hide',
        ]);

        Portofolio::create($request->all());

        return redirect()->route('admin.portofolio.index')->with('success', 'Data Portofolio berhasil ditambahkan.');
    }

    public function edit(Portofolio $portofolio)
    {
        $categories = PortofolioCategory::all();
        return view('admin.portofolio.edit', compact('portofolio', 'categories'));
    }

    public function update(Request $request, Portofolio $portofolio)
    {
        $request->validate([
            'category_id' => 'nullable|exists:portofolio_categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|string',
            'status' => 'required|in:Show,Hide',
        ]);

        $portofolio->update($request->all());

        return redirect()->route('admin.portofolio.index')->with('success', 'Data Portofolio berhasil diperbarui.');
    }

    public function destroy(Portofolio $portofolio)
    {
        $portofolio->delete();
        return redirect()->route('admin.portofolio.index')->with('success', 'Data Portofolio berhasil dihapus.');
    }
}
