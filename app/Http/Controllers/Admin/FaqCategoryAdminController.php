<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqCategoryAdminController extends Controller
{
    public function index()
    {
        $items = FaqCategory::latest()->get();

        return view('admin.faq_categories.index', compact('items'));
    }

    public function create()
    {
        return view('admin.faq_categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
        ]);

        FaqCategory::create($validated);

        return redirect()
            ->route('admin.faq_categories.index')
            ->with('success', 'Kategori FAQ berhasil ditambahkan.');
    }

    public function edit(FaqCategory $faqCategory)
    {
        return view('admin.faq_categories.edit', compact('faqCategory'));
    }

    public function update(Request $request, FaqCategory $faqCategory)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
        ]);

        $faqCategory->update($validated);

        return redirect()
            ->route('admin.faq_categories.index')
            ->with('success', 'Kategori FAQ berhasil diperbarui.');
    }

    public function destroy(FaqCategory $faqCategory)
    {
        $faqCategory->delete();

        return redirect()
            ->route('admin.faq_categories.index')
            ->with('success', 'Kategori FAQ berhasil dihapus.');
    }
}