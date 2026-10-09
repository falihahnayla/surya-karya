@extends('layouts.admin')

@section('title', 'Manajemen Visi & Misi - Surya Karya')

@section('content')
@php
    $input = 'w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white';
    $label = 'block text-xs uppercase tracking-wider text-outline font-medium mb-2';
@endphp
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col gap-1 pb-2 border-b border-surface-container-high/60">
        <span class="text-[11px] uppercase tracking-widest text-outline font-medium" style="font-family: 'Inter', sans-serif;">Admin Console</span>
        <h1 class="text-3xl font-normal text-primary tracking-tight" style="font-family: 'Cormorant Garamond', serif;">Manajemen Visi &amp; Misi</h1>
        <p class="text-sm text-on-surface-variant font-normal" style="font-family: 'Inter', sans-serif;">Kelola judul dan konten visi &amp; misi PT Surya Karya.</p>
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
        <form action="{{ route('admin.visi-misi.update') }}" method="POST" class="flex flex-col gap-6">
            @csrf

            {{-- VISI --}}
            <div class="flex flex-col gap-5 p-5 rounded-DEFAULT bg-slate-50 border border-slate-200">
                <h3 class="text-xl font-normal text-primary tracking-tight" style="font-family: 'Cormorant Garamond', serif;">Visi</h3>

                <div>
                    <label for="visi_title" class="{{ $label }}">Judul Visi</label>
                    <input type="text" name="visi_title" id="visi_title" maxlength="100"
                           value="{{ old('visi_title', $visiMisi->visi_title) }}"
                           placeholder="Contoh: VISI" class="{{ $input }}">
                    @error('visi_title') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="visi_content" class="{{ $label }}">Konten Visi</label>
                    <textarea name="visi_content" id="visi_content" rows="4" maxlength="500" class="{{ $input }}">{{ old('visi_content', $visiMisi->visi_content) }}</textarea>
                    @error('visi_content') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- MISI --}}
            <div class="flex flex-col gap-5 p-5 rounded-DEFAULT bg-slate-50 border border-slate-200">
                <h3 class="text-xl font-normal text-primary tracking-tight" style="font-family: 'Cormorant Garamond', serif;">Misi</h3>

                <div>
                    <label for="misi_title" class="{{ $label }}">Judul Misi</label>
                    <input type="text" name="misi_title" id="misi_title" maxlength="100"
                           value="{{ old('misi_title', $visiMisi->misi_title) }}"
                           placeholder="Contoh: MISI" class="{{ $input }}">
                    @error('misi_title') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="misi_content" class="{{ $label }}">Konten Misi</label>
                    <textarea name="misi_content" id="misi_content" rows="4" maxlength="500" class="{{ $input }}">{{ old('misi_content', $visiMisi->misi_content) }}</textarea>
                    @error('misi_content') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="px-6 py-2.5 rounded-DEFAULT bg-[#0a2569] text-white text-sm font-medium hover:bg-[#081d52] transition-colors">
                    Simpan Visi &amp; Misi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection