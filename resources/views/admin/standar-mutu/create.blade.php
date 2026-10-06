@extends('layouts.admin')

@section('title', ($type === 'card' ? 'Tambah Card Topik Utama' : 'Tambah Foto Referensi') . ' Standar Mutu - Surya Karya')

@section('content')
@php
    $currentType = old('item_type', $type ?? 'card');
@endphp
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-2 gap-4 border-b border-surface-container-high/60">
        <div class="flex flex-col gap-1">
            <h1 class="text-3xl font-normal text-primary tracking-tight" style="font-family: 'Cormorant Garamond', serif;">
                {{ $currentType === 'card' ? 'Tambah Card Topik Utama' : 'Tambah Foto Referensi' }} Standar Mutu
            </h1>
            <p class="text-sm text-on-surface-variant font-normal" style="font-family: 'Inter', sans-serif;">
                {{ $currentType === 'card' ? 'Isi judul, deskripsi, dan poin-poin checklist (+).' : 'Upload foto referensi (atau sertakan URL), masukan tag, dan judul foto.' }}
            </p>
        </div>
        <a href="{{ route('admin.standar-mutu.index') }}" class="px-4 py-2 rounded-DEFAULT bg-slate-100 text-slate-700 text-sm font-medium hover:bg-slate-200 transition-colors inline-flex items-center gap-2" style="font-family: 'Inter', sans-serif;">
            &larr; Kembali
        </a>
    </div>

    <div class="bg-surface-container-lowest p-8 rounded-DEFAULT border border-surface-container-high shadow-sm max-w-3xl" style="font-family: 'Inter', sans-serif;">
        <form action="{{ route('admin.standar-mutu.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-6">
            @csrf
            <input type="hidden" name="item_type" value="{{ $currentType }}">

            @if($currentType === 'card')
                <!-- MODE CARD TOPIK UTAMA -->
                <div class="flex flex-col gap-6">
                    <div>
                        <label for="title_card" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Judul Card (Title) <span class="text-rose-500">*</span></label>
                        <input type="text" name="title" id="title_card" value="{{ old('title') }}" required class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white" placeholder="Contoh: Standar Pengawasan Kualitas">
                        @error('title') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="content_card" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Deskripsi Card (Description)</label>
                        <textarea name="content" id="content_card" rows="3" class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white" placeholder="Pengendalian mutu konstruksi secara ketat dari tahap tes tanah hingga finishing...">{{ old('content') }}</textarea>
                        @error('content') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="checklist" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Poin-poin Spesifikasi / Checklist (+)</label>
                        <p class="text-xs text-slate-500 mb-2">Tuliskan 1 poin per baris. Tanda '+' akan muncul otomatis di tampilan depan.</p>
                        <textarea name="checklist" id="checklist" rows="5" class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white" placeholder="Inspeksi Berkala Mandor & Tim Arsitek&#10;Pengujian Kuat Tekan Beton Slump Test&#10;Garansi Pemeliharaan Pasca Konstruksi">{{ old('checklist') }}</textarea>
                        @error('checklist') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
            @else
                <!-- MODE FOTO REFERENSI -->
                <div class="flex flex-col gap-6">
                    <div>
                        <label for="tag" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Tag / Label Kecil (Gold Badge)</label>
                        <input type="text" name="tag" id="tag" value="{{ old('tag') }}" class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white" placeholder="Contoh: KONTROL KUALITAS, UJI KELAYAKAN">
                        @error('tag') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="title_photo" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Judul Foto / Pekerjaan <span class="text-rose-500">*</span></label>
                        <input type="text" name="title" id="title_photo" value="{{ old('title') }}" required class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white" placeholder="Contoh: Supervisi Lapangan Oleh Arsitek Senior">
                        @error('title') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="image_file" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Upload Gambar dari Perangkat (File Explorer)</label>
                        <input type="file" name="image_file" id="image_file" accept="image/*" class="w-full px-4 py-2.5 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white file:mr-4 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
                        @error('image_file') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror

                        <div class="my-2.5 text-xs text-slate-400 font-medium">ATAU GUNAKAN URL (OPSIONAL)</div>

                        <label for="image" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">URL Gambar (Image URL)</label>
                        <input type="text" name="image" id="image" value="{{ old('image') }}" class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white" placeholder="https://example.com/photo.jpg">
                        @error('image') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
            @endif

            <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                <button type="submit" class="px-6 py-2.5 rounded-DEFAULT bg-[#0a2569] text-white text-sm font-medium hover:bg-[#081d52] transition-colors">
                    Simpan Data
                </button>
                <a href="{{ route('admin.standar-mutu.index') }}" class="px-5 py-2.5 rounded-DEFAULT bg-slate-100 text-slate-600 text-sm font-medium hover:bg-slate-200 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
