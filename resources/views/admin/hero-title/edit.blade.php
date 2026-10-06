@extends('layouts.admin')

@section('title', 'Edit Hero Title - Surya Karya')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-2 gap-4 border-b border-surface-container-high/60">
        <div class="flex flex-col gap-1">
            <h1 class="text-3xl font-normal text-primary tracking-tight" style="font-family: 'Cormorant Garamond', serif;">Edit Hero Title</h1>
            <p class="text-sm text-on-surface-variant font-normal" style="font-family: 'Inter', sans-serif;">Perbarui data hero title halaman.</p>
        </div>
        <a href="{{ route('admin.hero-title.index') }}" class="px-4 py-2 rounded-DEFAULT bg-slate-100 text-slate-700 text-sm font-medium hover:bg-slate-200 transition-colors inline-flex items-center gap-2" style="font-family: 'Inter', sans-serif;">
            &larr; Kembali
        </a>
    </div>

    <div class="bg-surface-container-lowest p-8 rounded-DEFAULT border border-surface-container-high shadow-sm max-w-2xl" style="font-family: 'Inter', sans-serif;">
        <form action="{{ route('admin.hero-title.update', $heroTitle->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-6">
            @csrf
            @method('PUT')

            <div>
                <label for="page" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Halaman (Page - Unique) <span class="text-rose-500">*</span></label>
                <select name="page" id="page" required class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white">
                    <option value="pembangunan" {{ old('page', $heroTitle->page) == 'pembangunan' ? 'selected' : '' }}>Pembangunan</option>
                    <option value="renovasi" {{ old('page', $heroTitle->page) == 'renovasi' ? 'selected' : '' }}>Renovasi</option>
                    <option value="spesifikasi_bangunan" {{ old('page', $heroTitle->page) == 'spesifikasi_bangunan' ? 'selected' : '' }}>Spesifikasi Bangunan</option>
                    <option value="standar_mutu" {{ old('page', $heroTitle->page) == 'standar_mutu' ? 'selected' : '' }}>Standar Mutu</option>
                    <option value="alur_kerja" {{ old('page', $heroTitle->page) == 'alur_kerja' ? 'selected' : '' }}>Alur Kerja Sama Kontraktor</option>
                    <option value="portofolio" {{ old('page', $heroTitle->page) == 'portofolio' ? 'selected' : '' }}>Portofolio</option>
                    <option value="faq" {{ old('page', $heroTitle->page) == 'faq' ? 'selected' : '' }}>FAQ</option>
                </select>
                @error('page') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="title" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Judul (Title)</label>
                <input type="text" name="title" id="title" value="{{ old('title', $heroTitle->title) }}" class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white">
                @error('title') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="deskripsi" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="3" class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white">{{ old('deskripsi', $heroTitle->deskripsi) }}</textarea>
                @error('deskripsi') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div id="image_container">
                <label for="image_file" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Upload Gambar Banner Baru dari Perangkat (File Explorer)</label>
                <input type="file" name="image_file" id="image_file" accept="image/*" class="w-full px-4 py-2.5 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white file:mr-4 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
                @error('image_file') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror

                @if(!empty($heroTitle->image))
                <div class="mt-3 mb-2 flex items-center gap-3">
                    <span class="text-xs text-slate-500">Gambar saat ini:</span>
                    <img src="{{ (str_starts_with($heroTitle->image, 'http://') || str_starts_with($heroTitle->image, 'https://')) ? $heroTitle->image : asset($heroTitle->image) }}" class="h-16 w-28 object-cover rounded border border-slate-200 shadow-sm">
                </div>
                @endif

                <div class="my-2.5 text-xs text-slate-400 font-medium">ATAU GUNAKAN URL (OPSIONAL)</div>

                <label for="image" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">URL Gambar Banner (Image URL)</label>
                <input type="text" name="image" id="image" value="{{ old('image', $heroTitle->image) }}" class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white">
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const pageSelect = document.getElementById('page');
        const imageContainer = document.getElementById('image_container');

        function toggleImageContainer() {
            if (pageSelect.value === 'portofolio') {
                imageContainer.style.display = 'none';
            } else {
                imageContainer.style.display = 'block';
            }
        }

        if (pageSelect && imageContainer) {
            pageSelect.addEventListener('change', toggleImageContainer);
            toggleImageContainer();
        }
    });
</script>
@endsection
