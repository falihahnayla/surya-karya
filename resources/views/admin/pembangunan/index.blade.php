@extends('layouts.admin')

@section('title', 'Manajemen Pembangunan - Surya Karya')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-2 gap-4 border-b border-surface-container-high/60">
        <div class="flex flex-col gap-1">
            <h1 class="text-3xl font-normal text-primary tracking-tight" style="font-family: 'Cormorant Garamond', serif;">Manajemen Pembangunan</h1>
            <p class="text-sm text-on-surface-variant font-normal" style="font-family: 'Inter', sans-serif;">Kelola card topik utama dan foto referensi layanan pembangunan.</p>
        </div>
        <div class="flex flex-wrap items-center gap-3" style="font-family: 'Inter', sans-serif;">
            <a href="{{ route('admin.pembangunan.create', ['type' => 'card']) }}" class="px-4 py-2.5 rounded-DEFAULT bg-[#0a2569] text-white text-sm font-medium hover:bg-[#081d52] transition-colors inline-flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                + Tambah Card Topik Utama
            </a>
            <a href="{{ route('admin.pembangunan.create', ['type' => 'photo']) }}" class="px-4 py-2.5 rounded-DEFAULT bg-amber-600 text-white text-sm font-medium hover:bg-amber-700 transition-colors inline-flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                + Tambah Foto Referensi
            </a>
        </div>
    </div>

    <!-- TABEL 1: Card Topik Utama -->
    <div class="bg-surface-container-lowest rounded-DEFAULT border border-surface-container-high shadow-sm overflow-hidden mb-6">
        <div class="p-6 border-b border-surface-container-high flex justify-between items-center">
            <div>
                <h3 class="text-2xl font-normal text-primary tracking-tight" style="font-family: 'Cormorant Garamond', serif;">Card Topik Utama</h3>
                <p class="text-sm text-on-surface-variant mt-0.5" style="font-family: 'Inter', sans-serif;">Kartu berisi judul, deskripsi, dan poin-poin (+) spesifikasi pembangunan.</p>
            </div>
        </div>
        <div class="overflow-x-auto" style="font-family: 'Inter', sans-serif;">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-surface-container-high text-outline text-xs uppercase tracking-wider bg-surface-container-low/30">
                        <th class="py-4 px-6 font-medium w-16">No</th>
                        <th class="py-4 px-6 font-medium">Judul Card</th>
                        <th class="py-4 px-6 font-medium">Deskripsi</th>
                        <th class="py-4 px-6 font-medium">Poin Checklist (+)</th>
                        <th class="py-4 px-6 font-medium text-right w-44">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-container-high text-sm text-on-surface">
                    @forelse($cards as $index => $item)
                        <tr class="hover:bg-surface-container-low/40 transition-colors">
                            <td class="py-5 px-6 font-medium text-slate-500">{{ $index + 1 }}</td>
                            <td class="py-5 px-6 font-medium text-primary text-base" style="font-family: 'Cormorant Garamond', serif;">{{ $item->title }}</td>
                            <td class="py-5 px-6 text-on-surface-variant max-w-xs truncate">{{ $item->content }}</td>
                            <td class="py-5 px-6">
                                <ul class="list-disc list-inside text-xs text-slate-600 space-y-1">
                                    @foreach($item->checklist_items as $bullet)
                                        <li class="truncate max-w-xs">+ {{ $bullet }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="py-5 px-6 text-right space-x-2">
                                <a href="{{ route('admin.pembangunan.edit', $item->id) }}" class="inline-flex items-center gap-1 text-xs font-semibold text-amber-600 hover:text-amber-800 bg-amber-50 hover:bg-amber-100 px-3 py-1.5 rounded-DEFAULT transition-colors">
                                    Edit
                                </a>
                                <form action="{{ route('admin.pembangunan.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus card ini?')">
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
                            <td colspan="5" class="py-8 text-center text-slate-400">Belum ada card topik utama.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- TABEL 2: Foto Referensi & Contoh Visual -->
    <div class="bg-surface-container-lowest rounded-DEFAULT border border-surface-container-high shadow-sm overflow-hidden">
        <div class="p-6 border-b border-surface-container-high flex justify-between items-center">
            <div>
                <h3 class="text-2xl font-normal text-primary tracking-tight" style="font-family: 'Cormorant Garamond', serif;">Foto Referensi / Contoh Visual</h3>
                <p class="text-sm text-on-surface-variant mt-0.5" style="font-family: 'Inter', sans-serif;">Galeri foto contoh pekerjaan lengkap dengan tag dan judul foto.</p>
            </div>
        </div>
        <div class="overflow-x-auto" style="font-family: 'Inter', sans-serif;">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-surface-container-high text-outline text-xs uppercase tracking-wider bg-surface-container-low/30">
                        <th class="py-4 px-6 font-medium w-16">No</th>
                        <th class="py-4 px-6 font-medium">Gambar</th>
                        <th class="py-4 px-6 font-medium">Tag / Label</th>
                        <th class="py-4 px-6 font-medium">Judul Foto</th>
                        <th class="py-4 px-6 font-medium text-right w-44">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-container-high text-sm text-on-surface">
                    @forelse($photos as $index => $item)
                        <tr class="hover:bg-surface-container-low/40 transition-colors">
                            <td class="py-5 px-6 font-medium text-slate-500">{{ $index + 1 }}</td>
                            <td class="py-5 px-6">
                                @if($item->image)
                                    <img src="{{ (str_starts_with($item->image, 'http://') || str_starts_with($item->image, 'https://')) ? $item->image : asset($item->image) }}" class="w-16 h-12 object-cover rounded border border-slate-200">
                                @else
                                    <span class="text-xs text-slate-400">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td class="py-5 px-6 font-semibold text-xs text-amber-700 uppercase tracking-wider">{{ $item->tag ?? '-' }}</td>
                            <td class="py-5 px-6 font-medium text-slate-900" style="font-family: 'Cormorant Garamond', serif;">{{ $item->title }}</td>
                            <td class="py-5 px-6 text-right space-x-2">
                                <a href="{{ route('admin.pembangunan.edit', $item->id) }}" class="inline-flex items-center gap-1 text-xs font-semibold text-amber-600 hover:text-amber-800 bg-amber-50 hover:bg-amber-100 px-3 py-1.5 rounded-DEFAULT transition-colors">
                                    Edit
                                </a>
                                <form action="{{ route('admin.pembangunan.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?')">
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
                            <td colspan="5" class="py-8 text-center text-slate-400">Belum ada foto referensi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
