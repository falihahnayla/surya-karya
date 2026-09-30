<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembangunan;
use Illuminate\Http\Request;

class PembangunanController extends Controller
{
    public function index()
    {
        $items = Pembangunan::latest()->get();
        return view('admin.pembangunan.index', compact('items'));
    }

    public function create()
    {
        return view('admin.pembangunan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:225',
            'content' => 'required|string|max:255',
        ]);

        Pembangunan::create($request->only('title', 'content'));

        return redirect()->route('admin.pembangunan.index')->with('success', 'Data Pembangunan berhasil ditambahkan.');
    }

    public function edit(Pembangunan $pembangunan)
    {
        return view('admin.pembangunan.edit', compact('pembangunan'));
    }

    public function update(Request $request, Pembangunan $pembangunan)
    {
        $request->validate([
            'title' => 'required|string|max:225',
            'content' => 'required|string|max:255',
        ]);

        $pembangunan->update($request->only('title', 'content'));

        return redirect()->route('admin.pembangunan.index')->with('success', 'Data Pembangunan berhasil diperbarui.');
    }

    public function destroy(Pembangunan $pembangunan)
    {
        $pembangunan->delete();
        return redirect()->route('admin.pembangunan.index')->with('success', 'Data Pembangunan berhasil dihapus.');
    }
}
