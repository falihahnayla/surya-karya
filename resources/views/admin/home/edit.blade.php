@extends('layouts.admin')

@section('title', 'Edit Home - Surya Karya')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-2 gap-4 border-b border-surface-container-high/60">
        <div class="flex flex-col gap-1">
            <h1 class="text-3xl font-normal text-primary tracking-tight" style="font-family: 'Cormorant Garamond', serif;">Edit Home</h1>
            <p class="text-sm text-on-surface-variant font-normal" style="font-family: 'Inter', sans-serif;">Perbarui data konten beranda.</p>
        </div>
        <a href="{{ route('admin.home.index') }}" class="px-4 py-2 rounded-DEFAULT bg-slate-100 text-slate-700 text-sm font-medium hover:bg-slate-200 transition-colors inline-flex items-center gap-2" style="font-family: 'Inter', sans-serif;">
            &larr; Kembali
        </a>
    </div>

    <div class="bg-surface-container-lowest p-8 rounded-DEFAULT border border-surface-container-high shadow-sm max-w-2xl" style="font-family: 'Inter', sans-serif;">
        <form action="{{ route('admin.home.update', $home->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-6">
            @csrf
            @method('PUT')
            <div>
                <label for="title" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Judul (Title) <span class="text-rose-500">*</span></label>
                <input type="text" name="title" id="title" maxlength="255" value="{{ old('title', $home->title) }}" required class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white">
                @error('title') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="subtitle" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Subtitle <span class="text-rose-500">*</span></label>
                <textarea name="subtitle" id="subtitle" rows="4" required class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white">{{ old('subtitle', $home->subtitle) }}</textarea>
                @error('subtitle') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="image_bg" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Gambar Background</label>
                @if($home->image_bg)
                    <img src="{{ asset($home->image_bg) }}" alt="Gambar Background" class="h-28 w-auto object-cover rounded-DEFAULT border border-slate-200 mb-3">
                @endif
                <input type="file" name="image_bg" id="image_bg" accept="image/*" class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white">
                <p class="text-xs text-slate-400 mt-1">Kosongkan jika tidak ingin mengganti gambar.</p>
                @error('image_bg') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="image_about" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Gambar About</label>
                @if($home->image_about)
                    <img src="{{ asset($home->image_about) }}" alt="Gambar About" class="h-28 w-auto object-cover rounded-DEFAULT border border-slate-200 mb-3">
                @endif
                <input type="file" name="image_about" id="image_about" accept="image/*" class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white">
                <p class="text-xs text-slate-400 mt-1">Kosongkan jika tidak ingin mengganti gambar.</p>
                @error('image_about') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="content_about" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Konten About <span class="text-rose-500">*</span></label>
                <textarea name="content_about" id="content_about" maxlength="255" rows="4" required class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white">{{ old('content_about', $home->content_about) }}</textarea>
                @error('content_about') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="img_desc" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Deskripsi Gambar <span class="text-rose-500">*</span></label>
                <input type="text" name="img_desc" id="img_desc" maxlength="255" value="{{ old('img_desc', $home->img_desc) }}" required class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white">
                @error('img_desc') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="service_title" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Judul Service <span class="text-rose-500">*</span></label>
                <input type="text" name="service_title" id="service_title" maxlength="100" value="{{ old('service_title', $home->service_title) }}" required class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white">
                @error('service_title') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="service_desc" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Deskripsi Service <span class="text-rose-500">*</span></label>
                <input type="text" name="service_desc" id="service_desc" maxlength="100" value="{{ old('service_desc', $home->service_desc) }}" required class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white">
                @error('service_desc') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="px-6 py-2.5 rounded-DEFAULT bg-[#0a2569] text-white text-sm font-medium hover:bg-[#081d52] transition-colors">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.home.index') }}" class="px-5 py-2.5 rounded-DEFAULT bg-slate-100 text-slate-600 text-sm font-medium hover:bg-slate-200 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection