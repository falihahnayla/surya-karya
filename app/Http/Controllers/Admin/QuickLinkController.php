<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuickLink;
use Illuminate\Http\Request;

class QuickLinkController extends Controller
{
    public function index()
    {
        $items = QuickLink::orderBy('id')->paginate(15);

        return view('admin.quick-links.index', compact('items'));
    }

    public function create()
    {
        return view('admin.quick-links.create');
    }

    public function store(Request $request)
    {
        QuickLink::create($request->validate($this->rules(), $this->messages()));

        return redirect()->route('admin.quick-links.index')
            ->with('success', 'Quick link berhasil ditambahkan.');
    }

    public function edit(QuickLink $quick_link)
    {
        return view('admin.quick-links.edit', ['item' => $quick_link]);
    }

    public function update(Request $request, QuickLink $quick_link)
    {
        $quick_link->update($request->validate($this->rules(), $this->messages()));

        return redirect()->route('admin.quick-links.index')
            ->with('success', 'Quick link berhasil diperbarui.');
    }

    public function destroy(QuickLink $quick_link)
    {
        $quick_link->delete();

        return redirect()->route('admin.quick-links.index')
            ->with('success', 'Quick link berhasil dihapus.');
    }

    private function rules(): array
    {
        return [
            'title' => 'required|string|max:10',
            // Harus diawali "/" (halaman internal) atau http:// / https:// (website lain)
            'url'   => ['required', 'string', 'max:255', 'regex:/^(\/|https?:\/\/)/i'],
        ];
    }

    private function messages(): array
    {
        return [
            'title.max'  => 'Judul maksimal 10 karakter.',
            'url.regex'  => 'URL harus diawali "/" (contoh: /faq) atau "https://".',
        ];
    }
}