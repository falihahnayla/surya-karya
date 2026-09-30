@extends('layouts.admin')

@section('title', 'Tambah Hero Title - Surya Karya')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-2 gap-4 border-b border-surface-container-high/60">
        <div class="flex flex-col gap-1">
            <h1 class="text-3xl font-normal text-primary tracking-tight" style="font-family: 'Cormorant Garamond', serif;">Tambah Hero Title</h1>
            <p class="text-sm text-on-surface-variant font-normal" style="font-family: 'Inter', sans-serif;">Pilih halaman dan isi konten hero banner.</p>
        </div>
        <a href="{{ route('admin.hero-title.index') }}" class="px-4 py-2 rounded-DEFAULT bg-slate-100 text-slate-700 text-sm font-medium hover:bg-slate-200 transition-colors inline-flex items-center gap-2" style="font-family: 'Inter', sans-serif;">
            &larr; Kembali
        </a>
    </div>

    <div class="bg-surface-container-lowest p-8 rounded-DEFAULT border border-surface-container-high shadow-sm max-w-2xl" style="font-family: 'Inter', sans-serif;">
        <form action="{{ route('admin.hero-title.store') }}" method="POST" class="flex flex-col gap-6">
            @csrf

            <div>
                <label for="page" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Halaman (Page - Unique) <span class="text-rose-500">*</span></label>
                <select name="page" id="page" required class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white">
                    <option value="">-- Pilih Halaman --</option>
                    <option value="pembangunan" {{ old('page') == 'pembangunan' ? 'selected' : '' }}>Pembangunan</option>
                    <option value="renovasi" {{ old('page') == 'renovasi' ? 'selected' : '' }}>Renovasi</option>
                    <option value="spesifikasi_bangunan" {{ old('page') == 'spesifikasi_bangunan' ? 'selected' : '' }}>Spesifikasi Bangunan</option>
                    <option value="standar_mutu" {{ old('page') == 'standar_mutu' ? 'selected' : '' }}>Standar Mutu</option>
                    <option value="alur_kerja" {{ old('page') == 'alur_kerja' ? 'selected' : '' }}>Alur Kerja</option>
                    <option value="kontraktor" {{ old('page') == 'kontraktor' ? 'selected' : '' }}>Kontraktor</option>
                    <option value="portofolio" {{ old('page') == 'portofolio' ? 'selected' : '' }}>Portofolio</option>
                    <option value="faq" {{ old('page') == 'faq' ? 'selected' : '' }}>FAQ</option>
                </select>
                @error('page') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="title" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Judul (Title)</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white">
                @error('title') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="deskripsi" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="3" class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white">{{ old('deskripsi') }}</textarea>
                @error('deskripsi') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="image" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">URL Gambar Banner (Image)</label>
                <input type="text" name="image" id="image" value="{{ old('image') }}" class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white">
                @error('image') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="px-6 py-2.5 rounded-DEFAULT bg-[#0a2569] text-white text-sm font-medium hover:bg-[#081d52] transition-colors">
                    Simpan Hero Title
                </button>
                <a href="{{ route('admin.hero-title.index') }}" class="px-5 py-2.5 rounded-DEFAULT bg-slate-100 text-slate-600 text-sm font-medium hover:bg-slate-200 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
