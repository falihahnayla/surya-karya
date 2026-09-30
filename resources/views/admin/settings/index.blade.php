@extends('layouts.admin')

@section('title', 'Pengaturan Website (Settings) - Surya Karya')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-2 gap-4 border-b border-surface-container-high/60">
        <div class="flex flex-col gap-1">
            <h1 class="text-3xl font-normal text-primary tracking-tight" style="font-family: 'Cormorant Garamond', serif;">Pengaturan Website (Settings)</h1>
            <p class="text-sm text-on-surface-variant font-normal" style="font-family: 'Inter', sans-serif;">Kelola profil perusahaan, kontak, logo, footer, dan meta data publik.</p>
        </div>
    </div>

    <div class="bg-surface-container-lowest p-8 rounded-DEFAULT border border-surface-container-high shadow-sm max-w-4xl" style="font-family: 'Inter', sans-serif;">
        <form action="{{ route('admin.settings.update') }}" method="POST" class="flex flex-col gap-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="company" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Nama Perusahaan (Company)</label>
                    <input type="text" name="company" id="company" value="{{ old('company', $setting->company) }}" class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white" placeholder="PT Surya Karya">
                </div>

                <div>
                    <label for="website" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Website</label>
                    <input type="text" name="website" id="website" value="{{ old('website', $setting->website) }}" class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white" placeholder="https://suryakarya.co.id">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="phone" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Telepon (Phone)</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $setting->phone) }}" class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white" placeholder="08123456789">
                </div>

                <div>
                    <label for="whatsapp" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">WhatsApp</label>
                    <input type="text" name="whatsapp" id="whatsapp" value="{{ old('whatsapp', $setting->whatsapp) }}" class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white" placeholder="628123456789">
                </div>

                <div>
                    <label for="email" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $setting->email) }}" class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white" placeholder="info@suryakarya.co.id">
                </div>
            </div>

            <div>
                <label for="address" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Alamat Perusahaan (Address)</label>
                <input type="text" name="address" id="address" value="{{ old('address', $setting->address) }}" class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white" placeholder="Jl. Sudirman No. 123, Jakarta">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="logo" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">URL Logo</label>
                    <input type="text" name="logo" id="logo" value="{{ old('logo', $setting->logo) }}" class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white">
                </div>

                <div>
                    <label for="favicon" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">URL Favicon</label>
                    <input type="text" name="favicon" id="favicon" value="{{ old('favicon', $setting->favicon) }}" class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white">
                </div>
            </div>

            <div>
                <label for="description" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Deskripsi Perusahaan (Description)</label>
                <textarea name="description" id="description" rows="3" class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white">{{ old('description', $setting->description) }}</textarea>
            </div>

            <div>
                <label for="footer_text" class="block text-xs uppercase tracking-wider text-outline font-medium mb-2">Teks Footer (Footer Text)</label>
                <textarea name="footer_text" id="footer_text" rows="2" class="w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white">{{ old('footer_text', $setting->footer_text) }}</textarea>
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
