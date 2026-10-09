@extends('layouts.admin')

@section('title', 'Manajemen Hero Title & Panel Layanan - Surya Karya')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-2 gap-4 border-b border-surface-container-high/60">
        <div class="flex flex-col gap-1">
            <h1 class="text-3xl font-normal text-primary tracking-tight" style="font-family: 'Cormorant Garamond', serif;">Manajemen Hero Title &amp; Panel Layanan</h1>
            <p class="text-sm text-on-surface-variant font-normal" style="font-family: 'Inter', sans-serif;">Kelola judul hero banner halaman serta tampilan split-panel layanan utama website.</p>
        </div>
        <div class="flex items-center gap-3 flex-wrap" style="font-family: 'Inter', sans-serif;">
            <a href="{{ route('admin.hero-title.create') }}" class="px-4 py-2.5 rounded-DEFAULT bg-[#0a2569] text-white text-xs font-medium hover:bg-[#081d52] transition-colors inline-flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                + Tambah Hero Title
            </a>
            <a href="{{ route('admin.service-panel.create') }}" class="px-4 py-2.5 rounded-DEFAULT bg-amber-600 text-white text-xs font-medium hover:bg-amber-700 transition-colors inline-flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                + Tambah Panel Layanan
            </a>
        </div>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
    <div class="p-4 rounded-DEFAULT bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-medium">
        {{ session('success') }}
    </div>
    @endif

    <!-- Data Table 1: Hero Banner Halaman -->
    <div class="bg-surface-container-lowest rounded-DEFAULT border border-surface-container-high shadow-sm overflow-hidden">
        <div class="p-6 border-b border-surface-container-high flex items-center justify-between">
            <div>
                <h3 class="text-2xl font-normal text-primary tracking-tight" style="font-family: 'Cormorant Garamond', serif;">Hero Banner Halaman</h3>
                <p class="text-sm text-on-surface-variant mt-0.5" style="font-family: 'Inter', sans-serif;">Menampilkan judul, deskripsi, dan banner utama untuk setiap halaman website.</p>
            </div>
            <a href="{{ route('admin.hero-title.create') }}" class="px-3.5 py-1.5 rounded-DEFAULT bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
                + Tambah Hero Title
            </a>
        </div>
        <div class="overflow-x-auto" style="font-family: 'Inter', sans-serif;">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-surface-container-high text-outline text-xs uppercase tracking-wider bg-surface-container-low/30">
                        <th class="py-4 px-6 font-medium w-16">No</th>
                        <th class="py-4 px-6 font-medium">Halaman (Page)</th>
                        <th class="py-4 px-6 font-medium">Judul (Title)</th>
                        <th class="py-4 px-6 font-medium">Deskripsi</th>
                        <th class="py-4 px-6 font-medium text-right w-44">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-container-high text-sm text-on-surface">
                    @forelse($heroTitles as $index => $item)
                        <tr class="hover:bg-surface-container-low/40 transition-colors">
                            <td class="py-5 px-6 font-medium text-slate-500">{{ $index + 1 }}</td>
                            <td class="py-5 px-6 font-semibold text-slate-800 uppercase tracking-wide text-xs">
                                <span class="px-2.5 py-1 rounded-DEFAULT bg-slate-100 border border-slate-200">
                                    {{ $item->page == 'alur_kerja' ? 'Alur Kerja Sama Kontraktor' : str_replace('_', ' ', $item->page) }}
                                </span>
                            </td>
                            <td class="py-5 px-6 font-medium text-primary text-base" style="font-family: 'Cormorant Garamond', serif;">{{ $item->title }}</td>
                            <td class="py-5 px-6 text-on-surface-variant max-w-xs truncate">{{ $item->deskripsi }}</td>
                            <td class="py-5 px-6 text-right space-x-2">
                                <a href="{{ route('admin.hero-title.edit', $item->id) }}" class="inline-flex items-center gap-1 text-xs font-semibold text-amber-600 hover:text-amber-800 bg-amber-50 hover:bg-amber-100 px-3 py-1.5 rounded-DEFAULT transition-colors">
                                    Edit
                                </a>
                                <form action="{{ route('admin.hero-title.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus hero title ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-1 text-xs font-semibold text-rose-600 hover:text-rose-800 bg-rose-50 hover:bg-rose-100 px-3 py-1.5 rounded-DEFAULT transition-colors">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-slate-400">Belum ada data hero title. Klik tombol di atas untuk membuat data baru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Data Table 2: Panel Layanan Utama (Split Panel Selection) -->
    <div class="bg-surface-container-lowest rounded-DEFAULT border border-surface-container-high shadow-sm overflow-hidden mt-6">
        <div class="p-6 border-b border-surface-container-high flex items-center justify-between">
            <div>
                <h3 class="text-2xl font-normal text-primary tracking-tight" style="font-family: 'Cormorant Garamond', serif;">Panel Layanan Utama (Split Panel Selection)</h3>
                <p class="text-sm text-on-surface-variant mt-0.5" style="font-family: 'Inter', sans-serif;">Menampilkan konfigurasi card split-panel (Pembangunan, Renovasi, Spesifikasi, &amp; Standar Mutu).</p>
            </div>
            <a href="{{ route('admin.service-panel.create') }}" class="px-3.5 py-1.5 rounded-DEFAULT bg-amber-50 hover:bg-amber-100 text-amber-700 border border-amber-200 text-xs font-semibold transition-colors">
                + Tambah Panel Layanan
            </a>
        </div>
        <div class="overflow-x-auto" style="font-family: 'Inter', sans-serif;">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-surface-container-high text-outline text-xs uppercase tracking-wider bg-surface-container-low/30">
                        <th class="py-4 px-6 font-medium w-16">No</th>
                        <th class="py-4 px-6 font-medium">Gambar Background (Potrait / 1:1)</th>
                        <th class="py-4 px-6 font-medium">Tipe Panel</th>
                        <th class="py-4 px-6 font-medium">Teks Kuning (Eyebrow)</th>
                        <th class="py-4 px-6 font-medium">Judul (Title)</th>
                        <th class="py-4 px-6 font-medium">Deskripsi</th>
                        <th class="py-4 px-6 font-medium text-right w-44">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-container-high text-sm text-on-surface">
                    @forelse($servicePanels as $index => $panel)
                        <tr class="hover:bg-surface-container-low/40 transition-colors">
                            <td class="py-5 px-6 font-medium text-slate-500">{{ $index + 1 }}</td>
                            <td class="py-5 px-6">
                                @if(!empty($panel->image_url))
                                    <img src="{{ $panel->image_url }}" class="h-16 w-16 object-cover rounded border border-slate-200 shadow-sm" alt="{{ $panel->title }}">
                                @else
                                    <span class="text-xs text-slate-400 italic">Default</span>
                                @endif
                            </td>
                            <td class="py-5 px-6 font-semibold text-slate-800 uppercase tracking-wide text-xs">
                                <span class="px-2.5 py-1 rounded-DEFAULT bg-amber-50 text-amber-800 border border-amber-200">
                                    {{ str_replace('_', ' ', $panel->panel_key) }}
                                </span>
                            </td>
                            <td class="py-5 px-6 font-semibold text-xs text-amber-700 tracking-wider">{{ $panel->eyebrow ?? '-' }}</td>
                            <td class="py-5 px-6 font-medium text-primary text-base" style="font-family: 'Cormorant Garamond', serif;">
                                {!! $panel->formatted_title !!}
                            </td>
                            <td class="py-5 px-6 text-on-surface-variant max-w-xs truncate">{{ $panel->deskripsi }}</td>
                            <td class="py-5 px-6 text-right space-x-2">
                                <a href="{{ route('admin.service-panel.edit', $panel->id) }}" class="inline-flex items-center gap-1 text-xs font-semibold text-amber-600 hover:text-amber-800 bg-amber-50 hover:bg-amber-100 px-3 py-1.5 rounded-DEFAULT transition-colors">
                                    Edit
                                </a>
                                <form action="{{ route('admin.service-panel.destroy', $panel->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus panel layanan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-1 text-xs font-semibold text-rose-600 hover:text-rose-800 bg-rose-50 hover:bg-rose-100 px-3 py-1.5 rounded-DEFAULT transition-colors">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-slate-400">Belum ada data panel layanan. Klik tombol di atas untuk membuat data baru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
