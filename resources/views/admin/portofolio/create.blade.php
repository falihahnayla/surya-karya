@extends('layouts.admin')

@section('title', 'Tambah Portofolio - Surya Karya')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-2 gap-4 border-b border-surface-container-high/60">
        <div class="flex flex-col gap-1">
            <h1 class="text-3xl font-normal text-primary tracking-tight" style="font-family: 'Cormorant Garamond', serif;">Tambah Portofolio</h1>
            <p class="text-sm text-on-surface-variant font-normal" style="font-family: 'Inter', sans-serif;">Isi formulir untuk menambahkan karya portofolio baru.</p>
        </div>
        <a href="{{ route('admin.portofolio.index') }}" class="px-4 py-2 rounded-DEFAULT bg-slate-100 text-slate-700 text-sm font-medium hover:bg-slate-200 transition-colors inline-flex items-center gap-2" style="font-family: 'Inter', sans-serif;">
            &larr; Kembali
        </a>
    </div>

    <div class="bg-surface-container-lowest p-8 rounded-DEFAULT border border-surface-container-high shadow-sm max-w-3xl" style="font-family: 'Inter', sans-serif;">
        <form action="{{ route('admin.portofolio.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="title" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Judul Proyek (Title) <span class="text-rose-500">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white" placeholder="Contoh: Villa Modern Canggu">
                    @error('title') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="category_id" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Kategori (Category)</label>
                    <select name="category_id" id="category_id" class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->title }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="location" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Lokasi (Location)</label>
                    <input type="text" name="location" id="location" value="{{ old('location') }}" class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white" placeholder="Contoh: Badung, Bali">
                    @error('location') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="status" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Status Publikasi <span class="text-rose-500">*</span></label>
                    <select name="status" id="status" required class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white">
                        <option value="Show" {{ old('status') == 'Show' ? 'selected' : '' }}>Show (Tampilkan)</option>
                        <option value="Hide" {{ old('status') == 'Hide' ? 'selected' : '' }}>Hide (Sembunyikan)</option>
                    </select>
                    @error('status') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $portofolio->is_featured ?? false) ? 'checked' : '' }} class="w-4 h-4 rounded border-slate-300 text-[#0a2569] focus:ring-[#0a2569]">
                <label for="is_featured" class="text-sm text-slate-700 font-medium">Tandai sebagai Proyek Unggulan (tampil di halaman Home)</label>
            </div>

            <div>
                <label for="image_file" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Upload Gambar dari Perangkat (File Explorer)</label>
                <input type="file" name="image_file" id="image_file" accept="image/*" class="w-full px-4 py-2.5 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white file:mr-4 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
                @error('image_file') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror

                <div class="my-2.5 text-xs text-slate-400 font-medium">ATAU GUNAKAN URL (OPSIONAL)</div>

                <label for="image" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">URL Gambar (Image URL)</label>
                <input type="text" name="image" id="image" value="{{ old('image') }}" class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white" placeholder="https://example.com/image.jpg">
                @error('image') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="description" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Deskripsi Proyek (Description)</label>
                <textarea name="description" id="description" rows="4" class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white" placeholder="Penjelasan detail mengenai proyek...">{{ old('description') }}</textarea>
                @error('description') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="px-6 py-2.5 rounded-DEFAULT bg-[#0a2569] text-white text-sm font-medium hover:bg-[#081d52] transition-colors">
                    Simpan Portofolio
                </button>
                <a href="{{ route('admin.portofolio.index') }}" class="px-5 py-2.5 rounded-DEFAULT bg-slate-100 text-slate-600 text-sm font-medium hover:bg-slate-200 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
