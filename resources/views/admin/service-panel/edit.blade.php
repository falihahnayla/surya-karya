@extends('layouts.admin')

@section('title', 'Edit Panel Layanan - Surya Karya')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-2 gap-4 border-b border-surface-container-high/60">
        <div class="flex flex-col gap-1">
            <h1 class="text-3xl font-normal text-primary tracking-tight" style="font-family: 'Cormorant Garamond', serif;">Edit Panel Layanan (Split Panel)</h1>
            <p class="text-sm text-on-surface-variant font-normal" style="font-family: 'Inter', sans-serif;">Perbarui data tampilan panel layanan utama.</p>
        </div>
        <a href="{{ route('admin.hero-title.index') }}" class="px-4 py-2 rounded-DEFAULT bg-slate-100 text-slate-700 text-sm font-medium hover:bg-slate-200 transition-colors inline-flex items-center gap-2" style="font-family: 'Inter', sans-serif;">
            &larr; Kembali
        </a>
    </div>

    <div class="bg-surface-container-lowest p-8 rounded-DEFAULT border border-surface-container-high shadow-sm max-w-2xl" style="font-family: 'Inter', sans-serif;">
        <form action="{{ route('admin.service-panel.update', $servicePanel->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-6">
            @csrf
            @method('PUT')

            <div>
                <label for="panel_key" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Tipe Panel Layanan <span class="text-rose-500">*</span></label>
                <select name="panel_key" id="panel_key" required class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white">
                    <option value="pembangunan" {{ old('panel_key', $servicePanel->panel_key) == 'pembangunan' ? 'selected' : '' }}>Panel Pembangunan (Halaman Pembangunan & Renovasi)</option>
                    <option value="renovasi" {{ old('panel_key', $servicePanel->panel_key) == 'renovasi' ? 'selected' : '' }}>Panel Renovasi (Halaman Pembangunan & Renovasi)</option>
                    <option value="spesifikasi_bangunan" {{ old('panel_key', $servicePanel->panel_key) == 'spesifikasi_bangunan' ? 'selected' : '' }}>Panel Spesifikasi Bangunan (Halaman Spesifikasi & Standar)</option>
                    <option value="standar_mutu" {{ old('panel_key', $servicePanel->panel_key) == 'standar_mutu' ? 'selected' : '' }}>Panel Standar Mutu (Halaman Spesifikasi & Standar)</option>
                </select>
                @error('panel_key') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="eyebrow" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Teks Atas Kuning (Eyebrow Tag)</label>
                <input type="text" name="eyebrow" id="eyebrow" value="{{ old('eyebrow', $servicePanel->eyebrow) }}" class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white" placeholder="Contoh: PEMBANGUNAN HUNIAN & PROPERTI">
                <span class="text-[11px] text-slate-400 mt-1 block">Teks kecil berwarna kuning di atas judul panel.</span>
                @error('eyebrow') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="title" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Judul Panel (Title)</label>
                <input type="text" name="title" id="title" value="{{ old('title', $servicePanel->title) }}" class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white" placeholder="Contoh: Pembangunan">
                @error('title') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="deskripsi" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Deskripsi Panel</label>
                <textarea name="deskripsi" id="deskripsi" rows="3" class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white" placeholder="Layanan pembangunan hunian dan properti dengan perencanaan matang...">{{ old('deskripsi', $servicePanel->deskripsi) }}</textarea>
                @error('deskripsi') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="image_file" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Upload Background Panel Baru (Khusus Potrait / 1:1)</label>
                <input type="file" name="image_file" id="image_file" accept="image/*" class="w-full px-4 py-2.5 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white file:mr-4 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
                <span class="text-[11px] text-amber-600 mt-1 block font-medium">Disarankan menggunakan gambar rasio Potrait atau 1:1 agar tampilan split-panel presisi.</span>
                @error('image_file') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror

                @if(!empty($servicePanel->image))
                <div class="mt-3 mb-2 flex items-center gap-3">
                    <span class="text-xs text-slate-500">Gambar saat ini:</span>
                    <img src="{{ (str_starts_with($servicePanel->image, 'http://') || str_starts_with($servicePanel->image, 'https://')) ? $servicePanel->image : asset($servicePanel->image) }}" class="h-20 w-20 object-cover rounded border border-slate-200 shadow-sm">
                </div>
                @endif

                <div class="my-2.5 text-xs text-slate-400 font-medium">ATAU GUNAKAN URL (OPSIONAL)</div>

                <label for="image" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">URL Background Gambar (Image URL)</label>
                <input type="text" name="image" id="image" value="{{ old('image', $servicePanel->image) }}" class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white" placeholder="https://example.com/panel-portrait.jpg">
                @error('image') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="px-6 py-2.5 rounded-DEFAULT bg-[#0a2569] text-white text-sm font-medium hover:bg-[#081d52] transition-colors">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.hero-title.index') }}" class="px-5 py-2.5 rounded-DEFAULT bg-slate-100 text-slate-600 text-sm font-medium hover:bg-slate-200 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
