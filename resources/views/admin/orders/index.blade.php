@extends('layouts.admin')

@section('title', 'Tabel Pesanan Masuk - Surya Karya')

@section('content')
@php
    $filters = request()->only('q', 'status');
    $rp = fn ($v) => 'Rp ' . number_format((float) $v, 0, ',', '.');
    $tabs = ['' => 'Semua'] + \App\Models\Order::STATUSES;
@endphp
<div class="flex flex-col w-full gap-space-xl">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-end justify-between pb-2 gap-4 border-b border-surface-container-high/60">
        <div class="flex flex-col gap-1">
            <span class="text-[11px] uppercase tracking-widest text-outline font-medium" style="font-family: 'Inter', sans-serif;">Admin Console</span>
            <h1 class="text-3xl font-normal text-primary tracking-tight" style="font-family: 'Cormorant Garamond', serif;">Tabel Pesanan Masuk</h1>
        </div>
        <div class="flex items-center gap-3" style="font-family: 'Inter', sans-serif;">
            <div class="px-4 py-2 rounded-DEFAULT bg-surface-container-lowest border border-surface-container-high text-xs text-on-surface-variant">
                Total <span class="font-semibold text-primary">{{ $totalAll }}</span> Pesanan
            </div>
            <a href="{{ route('admin.orders.create') }}" class="px-5 py-2.5 rounded-DEFAULT bg-[#0a2569] text-white text-sm font-medium hover:bg-[#081d52] transition-colors inline-flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Pesanan
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="px-4 py-3 rounded-DEFAULT bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm" style="font-family: 'Inter', sans-serif;">{{ session('success') }}</div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6" style="font-family: 'Inter', sans-serif;">
        {{-- ============ LIST (kiri) ============ --}}
        <div class="lg:col-span-4 bg-surface-container-lowest rounded-DEFAULT border border-surface-container-high shadow-sm overflow-hidden self-start">
            <div class="p-4 border-b border-surface-container-high flex flex-col gap-3">
                <form method="GET" action="{{ route('admin.orders.index') }}" class="relative">
                    @if(request('status')) <input type="hidden" name="status" value="{{ request('status') }}"> @endif
                    <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-outline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/></svg>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama atau nomor pesanan..." class="w-full pl-9 pr-3 py-2.5 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white">
                </form>
                <div class="flex flex-nowrap items-center gap-1.5 overflow-x-auto">
                    @foreach($tabs as $key => $label)
                        @php $active = (string) request('status', '') === (string) $key; @endphp
                        <a href="{{ route('admin.orders.index', array_filter(['q' => request('q'), 'status' => $key])) }}"
                        class="shrink-0 whitespace-nowrap px-3 py-1 rounded-DEFAULT text-xs font-medium transition-colors {{ $active ? 'bg-[#0a2569] text-white' : 'text-slate-600 hover:bg-slate-100' }}">{{ $label }}</a>
                    @endforeach
                </div>
            </div>

            <div class="divide-y divide-surface-container-high">
                @forelse($items as $item)
                    @php $isActive = $selected && $selected->id === $item->id; @endphp
                    <a href="{{ route('admin.orders.index', $filters + ['selected' => $item->id]) }}"
                       class="block p-5 transition-colors border-l-4 {{ $isActive ? 'border-[#0a2569] bg-surface-container-low/60' : 'border-transparent hover:bg-surface-container-low/40' }}">
                        <div class="flex items-start justify-between gap-2">
                            <span class="text-[11px] text-outline tracking-wide">#{{ $item->order_code }}</span>
                            <span class="px-2 py-0.5 rounded text-[10px] font-semibold {{ $item->status_badge_class }}">{{ $item->status_label }}</span>
                        </div>
                        <div class="text-lg text-primary mt-1 leading-snug" style="font-family: 'Cormorant Garamond', serif;">{{ $item->name }}</div>
                        <div class="text-[11px] text-outline mt-1">{{ $item->created_at->translatedFormat('d M Y') }}</div>
                    </a>
                @empty
                    <div class="py-8 px-4 text-center text-slate-400 text-sm">Belum ada pesanan.</div>
                @endforelse
            </div>

            @if($items->hasPages())
                <div class="p-4 border-t border-surface-container-high text-xs">{{ $items->links() }}</div>
            @endif
        </div>

        {{-- ============ DETAIL (kanan) ============ --}}
        <div class="lg:col-span-8 bg-surface-container-lowest rounded-DEFAULT border border-surface-container-high shadow-sm p-6 sm:p-8">
            @if($selected)
                {{-- Header detail --}}
                <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                    <div>
                        <span class="text-[11px] uppercase tracking-widest text-outline font-medium">Rincian Pesanan</span>
                        <h2 class="text-3xl font-normal text-primary tracking-tight mt-1" style="font-family: 'Cormorant Garamond', serif;">#{{ $selected->order_code }}</h2>
                    </div>
                    <div class="flex items-center gap-2 flex-wrap">
                        <form action="{{ route('admin.orders.status', $selected->id) }}" method="POST">
                            @csrf @method('PATCH')
                            <select name="status" onchange="this.form.submit()" class="px-3 py-2.5 rounded-DEFAULT border border-slate-200 bg-slate-50 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#0a2569] cursor-pointer">
                                @foreach(\App\Models\Order::STATUSES as $val => $label)
                                    <option value="{{ $val }}" @selected($selected->status === $val)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </form>
                        <a href="{{ $selected->customer_whatsapp_url }}" target="_blank" rel="noopener" class="px-4 py-2.5 rounded-DEFAULT bg-emerald-600 text-white text-sm font-medium hover:bg-emerald-700 transition-colors inline-flex items-center gap-2">
                            Hubungi via WhatsApp
                        </a>
                    </div>
                </div>

                {{-- Identitas --}}
                <h3 class="text-xl text-primary mt-8 pb-2 border-b border-surface-container-high" style="font-family: 'Cormorant Garamond', serif;">Identitas Pemesan</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-5 mt-5 text-sm">
                    <div><div class="text-[11px] uppercase tracking-wider text-outline">Nama Lengkap</div><div class="mt-1 font-medium text-slate-900">{{ $selected->name }}</div></div>
                    <div><div class="text-[11px] uppercase tracking-wider text-outline">Perusahaan / Afiliasi</div><div class="mt-1 text-slate-900">{{ $selected->company_name ?: '-' }}</div></div>
                    <div><div class="text-[11px] uppercase tracking-wider text-outline">Nomor WhatsApp</div><div class="mt-1 font-medium text-[#0a2569]">{{ $selected->phone }}</div></div>
                    <div><div class="text-[11px] uppercase tracking-wider text-outline">Email</div><div class="mt-1 text-slate-900 break-all">{{ $selected->email ?: '-' }}</div></div>
                </div>

                {{-- Lokasi --}}
                <h3 class="text-xl text-primary mt-8 pb-2 border-b border-surface-container-high" style="font-family: 'Cormorant Garamond', serif;">Lokasi &amp; Jenis Layanan</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-5 mt-5 text-sm">
                    <div class="sm:col-span-2"><div class="text-[11px] uppercase tracking-wider text-outline">Alamat Proyek</div><div class="mt-1 text-slate-900">{{ $selected->address }}</div></div>
                    <div><div class="text-[11px] uppercase tracking-wider text-outline">Jenis Layanan</div><div class="mt-1 text-slate-900">{{ $selected->layanan->title ?? '-' }}</div></div>
                    <div><div class="text-[11px] uppercase tracking-wider text-outline">Luas Bangunan</div><div class="mt-1 text-slate-900">{{ $selected->building_area ? $selected->building_area . ' m²' : '-' }}</div></div>
                    <div><div class="text-[11px] uppercase tracking-wider text-outline">Luas Lahan</div><div class="mt-1 text-slate-900">{{ $selected->land_area ? $selected->land_area . ' m²' : '-' }}</div></div>
                    <div><div class="text-[11px] uppercase tracking-wider text-outline">Posisi Bangunan</div><div class="mt-1 text-slate-900">{{ $selected->building_position ?: '-' }}</div></div>
                </div>

                {{-- Deskripsi --}}
                <h3 class="text-xl text-primary mt-8 pb-2 border-b border-surface-container-high" style="font-family: 'Cormorant Garamond', serif;">Deskripsi Kebutuhan</h3>
                <div class="mt-5 p-4 rounded-DEFAULT bg-surface-container-low/50 border border-surface-container-high text-sm text-slate-700 leading-relaxed whitespace-pre-line">{{ $selected->project_detail }}</div>
                @if($selected->notes)
                    <div class="mt-3 text-sm text-slate-600"><span class="text-[11px] uppercase tracking-wider text-outline block mb-1">Catatan</span>{{ $selected->notes }}</div>
                @endif

                {{-- Dokumen (gambar dibaca lewat route, tanpa storage:link) --}}
                <h3 class="text-xl text-primary mt-8 pb-2 border-b border-surface-container-high" style="font-family: 'Cormorant Garamond', serif;">Dokumen Terlampir</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-5 text-sm">
                    @foreach(['Gambar Denah' => ['denah', $selected->denah_image], 'Gambar Lahan' => ['lahan', $selected->lahan_image]] as $label => [$type, $path])
                        @if($path)
                            @php
                                $url   = route('admin.orders.file', [$selected->id, $type]) . '?v=' . optional($selected->updated_at)->timestamp;
                                $isPdf = strtolower(pathinfo($path, PATHINFO_EXTENSION)) === 'pdf';
                            @endphp
                            <div class="rounded-DEFAULT bg-surface-container-low/50 border border-surface-container-high overflow-hidden">
                                <a href="{{ $url }}" target="_blank" rel="noopener" class="block bg-white">
                                    @if($isPdf)
                                        <div class="h-48 flex flex-col items-center justify-center gap-2 text-slate-500">
                                            <svg class="w-12 h-12" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                                            <span class="text-xs font-medium">Dokumen PDF</span>
                                        </div>
                                    @else
                                        <img src="{{ $url }}" alt="{{ $label }}" loading="lazy"
                                             class="w-full h-48 object-cover hover:opacity-90 transition-opacity"
                                             onerror="this.outerHTML='<div class=&quot;h-48 flex items-center justify-center px-4 text-center text-xs text-slate-400&quot;>File gambar tidak ditemukan di penyimpanan.</div>'">
                                    @endif
                                </a>
                                <div class="p-3 flex items-center justify-between gap-3 border-t border-surface-container-high">
                                    <div class="min-w-0">
                                        <div class="font-medium text-slate-800">{{ $label }}</div>
                                        <div class="text-[11px] text-outline truncate">{{ basename($path) }}</div>
                                    </div>
                                    <a href="{{ $url }}" target="_blank" rel="noopener" class="shrink-0 text-xs font-semibold text-[#0a2569] hover:underline">Buka</a>
                                </div>
                            </div>
                        @else
                            <div class="p-4 rounded-DEFAULT border border-dashed border-surface-container-high text-slate-400">{{ $label }}: tidak ada</div>
                        @endif
                    @endforeach
                </div>

                {{-- Pembayaran --}}
                <h3 class="text-xl text-primary mt-8 pb-2 border-b border-surface-container-high" style="font-family: 'Cormorant Garamond', serif;">Rincian Pembayaran</h3>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-5 text-sm">
                    <div class="p-4 rounded-DEFAULT bg-surface-container-low/50 border border-surface-container-high"><div class="text-[11px] uppercase tracking-wider text-outline">Total</div><div class="mt-1 font-semibold text-primary">{{ $rp($selected->total) }}</div></div>
                    <div class="p-4 rounded-DEFAULT bg-surface-container-low/50 border border-surface-container-high"><div class="text-[11px] uppercase tracking-wider text-outline">Termin 1</div><div class="mt-1 text-slate-900">{{ $rp($selected->termin_1) }}</div></div>
                    <div class="p-4 rounded-DEFAULT bg-surface-container-low/50 border border-surface-container-high"><div class="text-[11px] uppercase tracking-wider text-outline">Termin 2</div><div class="mt-1 text-slate-900">{{ $rp($selected->termin_2) }}</div></div>
                    <div class="p-4 rounded-DEFAULT bg-surface-container-low/50 border border-surface-container-high"><div class="text-[11px] uppercase tracking-wider text-outline">Termin 3</div><div class="mt-1 text-slate-900">{{ $rp($selected->termin_3) }}</div></div>
                </div>

                {{-- Aksi --}}
                <div class="flex items-center gap-2 mt-8 pt-6 border-t border-surface-container-high">
                    <a href="{{ route('admin.orders.edit', $selected->id) }}" class="inline-flex items-center gap-1 text-xs font-semibold text-amber-600 hover:text-amber-800 bg-amber-50 hover:bg-amber-100 px-4 py-2 rounded-DEFAULT transition-colors">Edit Pesanan</a>
                    <form action="{{ route('admin.orders.destroy', $selected->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="inline-flex items-center gap-1 text-xs font-semibold text-rose-600 hover:text-rose-800 bg-rose-50 hover:bg-rose-100 px-4 py-2 rounded-DEFAULT transition-colors">Hapus</button>
                    </form>
                </div>
            @else
                <div class="py-16 text-center text-slate-400 text-sm">Pilih pesanan di sebelah kiri untuk melihat rinciannya.</div>
            @endif
        </div>
    </div>
</div>
@endsection