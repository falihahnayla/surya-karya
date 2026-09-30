<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SpesifikasiBangunan;
use Illuminate\Http\Request;

class SpesifikasiBangunanController extends Controller
{
    public function index()
    {
        $items = SpesifikasiBangunan::latest()->get();
        return view('admin.spesifikasi-bangunan.index', compact('items'));
    }

    public function create()
    {
        return view('admin.spesifikasi-bangunan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:225',
            'content' => 'required|string|max:255',
        ]);

        SpesifikasiBangunan::create($request->only('title', 'content'));

        return redirect()->route('admin.spesifikasi-bangunan.index')->with('success', 'Data Spesifikasi Bangunan berhasil ditambahkan.');
    }

    public function edit(SpesifikasiBangunan $spesifikasiBangunan)
    {
        return view('admin.spesifikasi-bangunan.edit', compact('spesifikasiBangunan'));
    }

    public function update(Request $request, SpesifikasiBangunan $spesifikasiBangunan)
    {
        $request->validate([
            'title' => 'required|string|max:225',
            'content' => 'required|string|max:255',
        ]);

        $spesifikasiBangunan->update($request->only('title', 'content'));

        return redirect()->route('admin.spesifikasi-bangunan.index')->with('success', 'Data Spesifikasi Bangunan berhasil diperbarui.');
    }

    public function destroy(SpesifikasiBangunan $spesifikasiBangunan)
    {
        $spesifikasiBangunan->delete();
        return redirect()->route('admin.spesifikasi-bangunan.index')->with('success', 'Data Spesifikasi Bangunan berhasil dihapus.');
    }
}
