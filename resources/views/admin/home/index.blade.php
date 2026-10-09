@extends('layouts.admin')

@section('title', 'Manajemen Home - Surya Karya')

@section('content')
@php
    $input = 'w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white';
    $label = 'block text-xs uppercase tracking-wider text-outline font-medium mb-2';
    $fileInput = 'w-full px-4 py-2 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white file:mr-3 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200';
    $imgUrl = fn ($path) => (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) ? $path : asset($path);
@endphp
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col gap-1 pb-2 border-b border-surface-container-high/60">
        <span class="text-[11px] uppercase tracking-widest text-outline font-medium" style="font-family: 'Inter', sans-serif;">Admin Console</span>
        <h1 class="text-3xl font-normal text-primary tracking-tight" style="font-family: 'Cormorant Garamond', serif;">Manajemen Home</h1>
        <p class="text-sm text-on-surface-variant font-normal" style="font-family: 'Inter', sans-serif;">Kelola konten halaman beranda PT Surya Karya.</p>
    </div>

    @if(session('success'))
        <div class="px-4 py-3 rounded-DEFAULT bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm" style="font-family: 'Inter', sans-serif;">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="px-4 py-3 rounded-DEFAULT bg-rose-50 border border-rose-200 text-rose-700 text-sm" style="font-family: 'Inter', sans-serif;">
            <ul class="list-disc pl-5 space-y-0.5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-surface-container-lowest p-8 rounded-DEFAULT border border-surface-container-high shadow-sm max-w-3xl" style="font-family: 'Inter', sans-serif;">
        <form action="{{ route('admin.home.update') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-6">
            @csrf

            {{-- Hero --}}
            <div>
                <label for="title" class="{{ $label }}">Judul (Title)</label>
                <input type="text" name="title" id="title" maxlength="255" value="{{ old('title', $home->title) }}" class="{{ $input }}">
                @error('title') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="subtitle" class="{{ $label }}">Subtitle</label>
                <textarea name="subtitle" id="subtitle" rows="3" class="{{ $input }}">{{ old('subtitle', $home->subtitle) }}</textarea>
                @error('subtitle') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            {{-- Gambar --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 p-5 rounded-DEFAULT bg-slate-50 border border-slate-200">
                <div>
                    <label for="image_bg" class="{{ $label }}">Gambar Background</label>
                    <input type="file" name="image_bg" id="image_bg" accept="image/*" class="{{ $fileInput }}">
                    <p class="text-[11px] text-slate-400 mt-1">JPG, PNG, WEBP. Maks 2 MB.@if($home->exists) Kosongkan jika tidak ingin mengganti.@endif</p>
                    @error('image_bg') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror

                    @if(!empty($home->image_bg))
                        <div class="mt-3 flex flex-col gap-2">
                            <span class="text-xs text-slate-500 font-medium">Gambar saat ini:</span>
                            <img src="{{ $imgUrl($home->image_bg) }}" alt="Background" class="h-24 w-full max-w-[220px] object-cover rounded border border-slate-200 p-1 bg-white shadow-sm">
                        </div>
                    @endif
                </div>

                <div>
                    <label for="image_about" class="{{ $label }}">Gambar About</label>
                    <input type="file" name="image_about" id="image_about" accept="image/*" class="{{ $fileInput }}">
                    <p class="text-[11px] text-slate-400 mt-1">JPG, PNG, WEBP. Maks 2 MB.@if($home->exists) Kosongkan jika tidak ingin mengganti.@endif</p>
                    @error('image_about') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror

                    @if(!empty($home->image_about))
                        <div class="mt-3 flex flex-col gap-2">
                            <span class="text-xs text-slate-500 font-medium">Gambar saat ini:</span>
                            <img src="{{ $imgUrl($home->image_about) }}" alt="About" class="h-24 w-full max-w-[220px] object-cover rounded border border-slate-200 p-1 bg-white shadow-sm">
                        </div>
                    @endif
                </div>
            </div>

            {{-- About --}}
            <div>
                <label for="content_about" class="{{ $label }}">Konten About</label>
                <textarea name="content_about" id="content_about" rows="3" maxlength="255" class="{{ $input }}">{{ old('content_about', $home->content_about) }}</textarea>
                @error('content_about') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="img_desc" class="{{ $label }}">Deskripsi Gambar</label>
                <input type="text" name="img_desc" id="img_desc" maxlength="255" value="{{ old('img_desc', $home->img_desc) }}" class="{{ $input }}">
                @error('img_desc') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            {{-- Service --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="service_title" class="{{ $label }}">Judul Service</label>
                    <input type="text" name="service_title" id="service_title" maxlength="100" value="{{ old('service_title', $home->service_title) }}" class="{{ $input }}">
                    @error('service_title') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="service_desc" class="{{ $label }}">Deskripsi Service</label>
                    <input type="text" name="service_desc" id="service_desc" maxlength="100" value="{{ old('service_desc', $home->service_desc) }}" class="{{ $input }}">
                    @error('service_desc') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="px-6 py-2.5 rounded-DEFAULT bg-[#0a2569] text-white text-sm font-medium hover:bg-[#081d52] transition-colors">
                    Simpan Home
                </button>
            </div>
        </form>
    </div>
</div>
@endsection