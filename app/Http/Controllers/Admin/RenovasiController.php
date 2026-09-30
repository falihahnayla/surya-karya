<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Renovasi;
use Illuminate\Http\Request;

class RenovasiController extends Controller
{
    public function index()
    {
        $items = Renovasi::latest()->get();
        return view('admin.renovasi.index', compact('items'));
    }

    public function create()
    {
        return view('admin.renovasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:225',
            'content' => 'required|string|max:255',
        ]);

        Renovasi::create($request->only('title', 'content'));

        return redirect()->route('admin.renovasi.index')->with('success', 'Data Renovasi berhasil ditambahkan.');
    }

    public function edit(Renovasi $renovasi)
    {
        return view('admin.renovasi.edit', compact('renovasi'));
    }

    public function update(Request $request, Renovasi $renovasi)
    {
        $request->validate([
            'title' => 'required|string|max:225',
            'content' => 'required|string|max:255',
        ]);

        $renovasi->update($request->only('title', 'content'));

        return redirect()->route('admin.renovasi.index')->with('success', 'Data Renovasi berhasil diperbarui.');
    }

    public function destroy(Renovasi $renovasi)
    {
        $renovasi->delete();
        return redirect()->route('admin.renovasi.index')->with('success', 'Data Renovasi berhasil dihapus.');
    }
}
