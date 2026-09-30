<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StandarMutu;
use Illuminate\Http\Request;

class StandarMutuController extends Controller
{
    public function index()
    {
        $items = StandarMutu::latest()->get();
        return view('admin.standar-mutu.index', compact('items'));
    }

    public function create()
    {
        return view('admin.standar-mutu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:225',
            'content' => 'required|string|max:255',
        ]);

        StandarMutu::create($request->only('title', 'content'));

        return redirect()->route('admin.standar-mutu.index')->with('success', 'Data Standar Mutu berhasil ditambahkan.');
    }

    public function edit(StandarMutu $standarMutu)
    {
        return view('admin.standar-mutu.edit', compact('standarMutu'));
    }

    public function update(Request $request, StandarMutu $standarMutu)
    {
        $request->validate([
            'title' => 'required|string|max:225',
            'content' => 'required|string|max:255',
        ]);

        $standarMutu->update($request->only('title', 'content'));

        return redirect()->route('admin.standar-mutu.index')->with('success', 'Data Standar Mutu berhasil diperbarui.');
    }

    public function destroy(StandarMutu $standarMutu)
    {
        $standarMutu->delete();
        return redirect()->route('admin.standar-mutu.index')->with('success', 'Data Standar Mutu berhasil dihapus.');
    }
}
