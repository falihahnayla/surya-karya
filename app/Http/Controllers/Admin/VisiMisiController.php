<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisiMisi;
use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    public function index()
    {
        $visiMisi = VisiMisi::first() ?? new VisiMisi();

        return view('admin.visi-misi.index', compact('visiMisi'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'visi_title'   => 'required|string|max:100',
            'visi_content' => 'required|string|max:500',
            'misi_title'   => 'required|string|max:100',
            'misi_content' => 'required|string|max:500',
        ]);

        $visiMisi = VisiMisi::first();

        if ($visiMisi) {
            $visiMisi->update($validated);
        } else {
            VisiMisi::create($validated);
        }

        return redirect()->route('admin.visi-misi.index')
            ->with('success', 'Data visi & misi berhasil disimpan.');
    }
}