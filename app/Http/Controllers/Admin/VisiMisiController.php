<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisiMisi;
use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    public function index()
    {
        $items = VisiMisi::latest()->get();

        return view('admin.visi-misi.index', compact('items'));
    }

    public function create()
    {
        return view('admin.visi-misi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'   => 'required|string',
            'content' => 'required|string|max:255',
        ]);

        VisiMisi::create($validated);

        return redirect()->route('admin.visi-misi.index')
            ->with('success', 'Data visi & misi berhasil ditambahkan.');
    }

    public function edit(VisiMisi $visi_misi)
    {
        return view('admin.visi-misi.edit', compact('visi_misi'));
    }

    public function update(Request $request, VisiMisi $visi_misi)
    {
        $validated = $request->validate([
            'title'   => 'required|string',
            'content' => 'required|string|max:255',
        ]);

        $visi_misi->update($validated);

        return redirect()->route('admin.visi-misi.index')
            ->with('success', 'Data visi & misi berhasil diperbarui.');
    }

    public function destroy(VisiMisi $visi_misi)
    {
        $visi_misi->delete();

        return redirect()->route('admin.visi-misi.index')
            ->with('success', 'Data visi & misi berhasil dihapus.');
    }
}