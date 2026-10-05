@extends('layouts.admin')

@section('title', 'Edit Alur Kerja Sama - Surya Karya')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-2 gap-4 border-b border-surface-container-high/60">
        <div class="flex flex-col gap-1">
            <h1 class="text-3xl font-normal text-primary tracking-tight" style="font-family: 'Cormorant Garamond', serif;">
                Edit Alur Kerja Sama
            </h1>
            <p class="text-sm text-on-surface-variant font-normal" style="font-family: 'Inter', sans-serif;">
                Perbarui informasi tahapan alur kerja sama kontraktor PT Surya Karya.
            </p>
        </div>
        <a href="{{ route('admin.alur-kerja.index') }}" class="px-5 py-2.5 rounded-DEFAULT border border-surface-container-high text-sm font-medium text-on-surface hover:bg-surface-container-low transition-colors inline-flex items-center gap-2" style="font-family: 'Inter', sans-serif;">
            Kembali
        </a>
    </div>

    <div class="bg-surface-container-lowest rounded-DEFAULT border border-surface-container-high shadow-sm overflow-hidden">
        <div class="p-6 border-b border-surface-container-high">
            <h3 class="text-2xl font-normal text-primary tracking-tight" style="font-family: 'Cormorant Garamond', serif;">
                Form Edit Alur Kerja Sama
            </h3>
            <p class="text-sm text-on-surface-variant mt-0.5" style="font-family: 'Inter', sans-serif;">
                Ubah data tahapan alur kerja sama yang dipilih.
            </p>
        </div>

        <form action="{{ route('admin.alur-kerja.update', $alur_kerja->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="p-6 space-y-6" style="font-family: 'Inter', sans-serif;">
                <div>
                    <label for="no" class="block text-sm font-medium text-on-surface mb-2">
                        Nomor
                    </label>
                    <input
                        type="number"
                        name="no"
                        id="no"
                        value="{{ old('no', $alur_kerja->no) }}"
                        min="1"
                        required
                        class="w-full rounded-DEFAULT border border-surface-container-high bg-white px-4 py-3 text-sm text-on-surface focus:outline-none focus:ring-2 focus:ring-[#0a2569]/20 focus:border-[#0a2569]"
                        placeholder="Contoh: 1"
                    >
                    @error('no')
                        <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="title" class="block text-sm font-medium text-on-surface mb-2">
                        Judul
                    </label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        value="{{ old('title', $alur_kerja->title) }}"
                        maxlength="225"
                        required
                        class="w-full rounded-DEFAULT border border-surface-container-high bg-white px-4 py-3 text-sm text-on-surface focus:outline-none focus:ring-2 focus:ring-[#0a2569]/20 focus:border-[#0a2569]"
                        placeholder="Masukkan judul tahapan"
                    >
                    @error('title')
                        <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="content" class="block text-sm font-medium text-on-surface mb-2">
                        Konten
                    </label>
                    <textarea
                        name="content"
                        id="content"
                        rows="5"
                        maxlength="255"
                        required
                        class="w-full rounded-DEFAULT border border-surface-container-high bg-white px-4 py-3 text-sm text-on-surface focus:outline-none focus:ring-2 focus:ring-[#0a2569]/20 focus:border-[#0a2569] resize-none"
                        placeholder="Masukkan penjelasan tahapan alur kerja sama"
                    >{{ old('content', $alur_kerja->content) }}</textarea>
                    @error('content')
                        <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-on-surface mb-2">
                        Gambar Saat Ini
                    </label>

                    <div class="mb-4">
                        <img
                            src="{{ asset($alur_kerja->image) }}"
                            alt="{{ $alur_kerja->title }}"
                            class="w-48 h-32 object-cover rounded-DEFAULT border border-surface-container-high"
                        >
                    </div>

                    <label for="image" class="block text-sm font-medium text-on-surface mb-2">
                        Ganti Gambar
                    </label>

                    <input
                        type="file"
                        name="image"
                        id="image"
                        accept="image/jpeg,image/png,image/webp"
                        class="w-full rounded-DEFAULT border border-surface-container-high bg-white px-4 py-3 text-sm text-on-surface file:mr-4 file:rounded-DEFAULT file:border-0 file:bg-[#0a2569] file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:bg-[#081d52]"
                    >

                    <p class="mt-1.5 text-xs text-on-surface-variant">
                        Kosongkan jika tidak ingin mengganti gambar. Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                    </p>

                    @error('image')
                        <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 px-6 py-5 border-t border-surface-container-high bg-surface-container-low/20" style="font-family: 'Inter', sans-serif;">
                <a href="{{ route('admin.alur-kerja.index') }}" class="px-5 py-2.5 rounded-DEFAULT border border-surface-container-high text-sm font-medium text-on-surface hover:bg-surface-container-low transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2.5 rounded-DEFAULT bg-[#0a2569] text-white text-sm font-medium hover:bg-[#081d52] transition-colors">
                    Perbarui Alur Kerja
                </button>
            </div>
        </form>
    </div>
</div>
@endsection