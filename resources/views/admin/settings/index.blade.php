@extends('layouts.admin')

@section('title', 'Pengaturan Website - Surya Karya')

@section('content')
@php
    $input = 'w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white';
    $label = 'block text-xs uppercase tracking-wider text-outline font-medium mb-2';
@endphp
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col gap-1 pb-2 border-b border-surface-container-high/60">
        <span class="text-[11px] uppercase tracking-widest text-outline font-medium" style="font-family: 'Inter', sans-serif;">Admin Console</span>
        <h1 class="text-3xl font-normal text-primary tracking-tight" style="font-family: 'Cormorant Garamond', serif;">Pengaturan Website</h1>
        <p class="text-sm text-on-surface-variant font-normal" style="font-family: 'Inter', sans-serif;">Data kontak di sini dipakai di footer dan tombol WhatsApp pada form pemesanan.</p>
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
        <form action="{{ route('admin.settings.update') }}" method="POST" class="flex flex-col gap-6">
            @csrf

            {{-- WhatsApp (utama) --}}
            <div class="p-4 rounded-DEFAULT bg-emerald-50/60 border border-emerald-200">
                <label for="whatsapp" class="{{ $label }}">Nomor WhatsApp Admin</label>
                <input type="text" name="whatsapp" id="whatsapp" maxlength="50"
                       value="{{ old('whatsapp', $setting->whatsapp) }}"
                       placeholder="Contoh: 08123456789 atau 628123456789" class="{{ $input }}">
                <p class="text-[11px] text-slate-500 mt-2 leading-relaxed">
                    Dipakai sebagai tujuan pesan WhatsApp dari form pemesanan dan di footer.
                    Kosongkan untuk memakai nomor bawaan sistem
                    (<span class="font-medium">{{ $siteWa['display'] ?? '' }}</span>).
                </p>
                @error('whatsapp') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="company" class="{{ $label }}">Nama Perusahaan</label>
                    <input type="text" name="company" id="company" maxlength="255" value="{{ old('company', $setting->company) }}" class="{{ $input }}">
                    @error('company') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="phone" class="{{ $label }}">Telepon</label>
                    <input type="text" name="phone" id="phone" maxlength="255" value="{{ old('phone', $setting->phone) }}" class="{{ $input }}">
                    @error('phone') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="email" class="{{ $label }}">Email</label>
                    <input type="email" name="email" id="email" maxlength="255" value="{{ old('email', $setting->email) }}" class="{{ $input }}">
                    @error('email') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="website" class="{{ $label }}">Website</label>
                    <input type="text" name="website" id="website" maxlength="255" value="{{ old('website', $setting->website) }}" class="{{ $input }}">
                    @error('website') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label for="address" class="{{ $label }}">Alamat</label>
                <input type="text" name="address" id="address" maxlength="255" value="{{ old('address', $setting->address) }}" class="{{ $input }}">
                @error('address') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="description" class="{{ $label }}">Deskripsi Website</label>
                <textarea name="description" id="description" rows="3" class="{{ $input }}">{{ old('description', $setting->description) }}</textarea>
                @error('description') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="logo" class="{{ $label }}">Logo (URL / path)</label>
                    <input type="text" name="logo" id="logo" value="{{ old('logo', $setting->logo) }}" placeholder="images/logo.jpg" class="{{ $input }}">
                    @error('logo') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="favicon" class="{{ $label }}">Favicon (URL / path)</label>
                    <input type="text" name="favicon" id="favicon" value="{{ old('favicon', $setting->favicon) }}" placeholder="images/favicon.ico" class="{{ $input }}">
                    @error('favicon') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label for="footer_text" class="{{ $label }}">Teks Footer</label>
                <textarea name="footer_text" id="footer_text" rows="2" class="{{ $input }}">{{ old('footer_text', $setting->footer_text) }}</textarea>
                @error('footer_text') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="px-6 py-2.5 rounded-DEFAULT bg-[#0a2569] text-white text-sm font-medium hover:bg-[#081d52] transition-colors">
                    Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection