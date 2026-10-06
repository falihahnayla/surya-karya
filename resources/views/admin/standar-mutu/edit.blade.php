@extends('layouts.admin')

@section('title', ($standar_mutu->item_type === 'card' ? 'Edit Card Topik Utama' : 'Edit Foto Referensi') . ' Standar Mutu - Surya Karya')

@section('content')
@php
    $currentType = old('item_type', $standar_mutu->item_type);
@endphp
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-2 gap-4 border-b border-surface-container-high/60">
        <div class="flex flex-col gap-1">
            <h1 class="text-3xl font-normal text-primary tracking-tight" style="font-family: 'Cormorant Garamond', serif;">
                {{ $currentType === 'card' ? 'Edit Card Topik Utama' : 'Edit Foto Referensi' }} Standar Mutu
            </h1>
            <p class="text-sm text-on-surface-variant font-normal" style="font-family: 'Inter', sans-serif;">
                Perbarui data {{ $currentType === 'card' ? 'Card Topik Utama' : 'Foto Referensi / Showcase' }}.
            </p>
        </div>
        <a href="{{ route('admin.standar-mutu.index') }}" class="px-4 py-2 rounded-DEFAULT bg-slate-100 text-slate-700 text-sm font-medium hover:bg-slate-200 transition-colors inline-flex items-center gap-2" style="font-family: 'Inter', sans-serif;">
            &larr; Kembali
        </a>
    </div>

    <div class="bg-surface-container-lowest p-8 rounded-DEFAULT border border-surface-container-high shadow-sm max-w-3xl" style="font-family: 'Inter', sans-serif;">
        <form action="{{ route('admin.standar-mutu.update', $standar_mutu->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-6">
            @csrf
            @method('PUT')
            <input type="hidden" name="item_type" value="{{ $currentType }}">

            @if($currentType === 'card')
                <!-- MODE CARD TOPIK UTAMA -->
                <div class="flex flex-col gap-6">
                    <div>
                        <label for="title_card" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Judul Card (Title) <span class="text-rose-500">*</span></label>
                        <input type="text" name="title" id="title_card" value="{{ old('title', $standar_mutu->title) }}" required class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white">
                        @error('title') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="content_card" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Deskripsi Card (Description)</label>
                        <textarea name="content" id="content_card" rows="3" class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white">{{ old('content', $standar_mutu->content) }}</textarea>
                        @error('content') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="checklist" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Poin-poin Spesifikasi / Checklist (+)</label>
                        <p class="text-xs text-slate-500 mb-2">Tuliskan 1 poin per baris. Tanda '+' akan muncul otomatis di tampilan depan.</p>
                        <textarea name="checklist" id="checklist" rows="5" class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white">{{ old('checklist', $standar_mutu->checklist) }}</textarea>
                        @error('checklist') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
            @else
                <!-- MODE FOTO REFERENSI -->
                <div class="flex flex-col gap-6">
                    <div>
                        <label for="tag" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Tag / Label Kecil (Gold Badge)</label>
                        <input type="text" name="tag" id="tag" value="{{ old('tag', $standar_mutu->tag) }}" class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white" placeholder="Contoh: KONTROL KUALITAS, UJI KELAYAKAN">
                        @error('tag') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="title_photo" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Judul Foto / Pekerjaan <span class="text-rose-500">*</span></label>
                        <input type="text" name="title" id="title_photo" value="{{ old('title', $standar_mutu->title) }}" required class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white">
                        @error('title') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="image_file" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Upload Gambar Baru dari Perangkat (File Explorer)</label>
                        <input type="file" name="image_file" id="image_file" accept="image/*" class="w-full px-4 py-2.5 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white file:mr-4 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
                        @error('image_file') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror

                        @if(!empty($standar_mutu->image))
                        <div class="mt-3 mb-2 flex items-center gap-3">
                            <span class="text-xs text-slate-500">Gambar saat ini:</span>
                            <img src="{{ (str_starts_with($standar_mutu->image, 'http://') || str_starts_with($standar_mutu->image, 'https://')) ? $standar_mutu->image : asset($standar_mutu->image) }}" class="h-16 w-24 object-cover rounded border border-slate-200 shadow-sm">
                        </div>
                        @endif

                        <div class="my-2.5 text-xs text-slate-400 font-medium">ATAU GUNAKAN URL (OPSIONAL)</div>

                        <label for="image" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">URL Gambar (Image URL)</label>
                        <input type="text" name="image" id="image" value="{{ old('image', $standar_mutu->image) }}" class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white">
                        @error('image') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
            @endif

            <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                <button type="submit" class="px-6 py-2.5 rounded-DEFAULT bg-[#0a2569] text-white text-sm font-medium hover:bg-[#081d52] transition-colors">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.standar-mutu.index') }}" class="px-5 py-2.5 rounded-DEFAULT bg-slate-100 text-slate-600 text-sm font-medium hover:bg-slate-200 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
