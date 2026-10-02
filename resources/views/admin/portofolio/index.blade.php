@extends('layouts.admin')

@section('title', 'Manajemen Portofolio & Kategori - Surya Karya')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-2 gap-4 border-b border-surface-container-high/60">
        <div class="flex flex-col gap-1">
            <h1 class="text-3xl font-normal text-primary tracking-tight" style="font-family: 'Cormorant Garamond', serif;">Manajemen Portofolio &amp; Kategori</h1>
            <p class="text-sm text-on-surface-variant font-normal" style="font-family: 'Inter', sans-serif;">Kelola kategori portofolio dan daftar karya proyek PT Surya Karya dalam satu tempat.</p>
        </div>
    </div>

    <!-- TABEL 1: Kategori Portofolio -->
    <div class="bg-surface-container-lowest rounded-DEFAULT border border-surface-container-high shadow-sm overflow-hidden">
        <div class="p-6 border-b border-surface-container-high flex items-center justify-between">
            <div>
                <h3 class="text-2xl font-normal text-primary tracking-tight" style="font-family: 'Cormorant Garamond', serif;">Tabel Kategori Portofolio</h3>
                <p class="text-sm text-on-surface-variant mt-0.5" style="font-family: 'Inter', sans-serif;">Pengelompokan kategori karya portofolio.</p>
            </div>
            <a href="{{ route('admin.portofolio-category.create') }}" class="text-xs font-semibold text-[#0a2569] hover:underline" style="font-family: 'Inter', sans-serif;">+ Tambah Kategori Baru</a>
        </div>
        <div class="overflow-x-auto" style="font-family: 'Inter', sans-serif;">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-surface-container-high text-outline text-xs uppercase tracking-wider bg-surface-container-low/30">
                        <th class="py-4 px-6 font-medium w-16">No</th>
                        <th class="py-4 px-6 font-medium">Judul Kategori (Title)</th>
                        <th class="py-4 px-6 font-medium">Jumlah Proyek</th>
                        <th class="py-4 px-6 font-medium text-right w-44">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-container-high text-sm text-on-surface">
                    @forelse($categories as $index => $cat)
                        <tr class="hover:bg-surface-container-low/40 transition-colors">
                            <td class="py-5 px-6 font-medium text-slate-500">{{ $index + 1 }}</td>
                            <td class="py-5 px-6 font-medium text-primary text-base" style="font-family: 'Cormorant Garamond', serif;">{{ $cat->title }}</td>
                            <td class="py-5 px-6 text-on-surface-variant">
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">
                                    {{ $cat->portofolios_count ?? 0 }} proyek
                                </span>
                            </td>
                            <td class="py-5 px-6 text-right space-x-2">
                                <a href="{{ route('admin.portofolio-category.edit', $cat->id) }}" class="inline-flex items-center gap-1 text-xs font-semibold text-amber-600 hover:text-amber-800 bg-amber-50 hover:bg-amber-100 px-3 py-1.5 rounded-DEFAULT transition-colors">
                                    Edit
                                </a>
                                <form action="{{ route('admin.portofolio-category.destroy', $cat->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
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
                            <td colspan="4" class="py-6 text-center text-slate-400">Belum ada kategori portofolio.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- TABEL 2: Karya Portofolio -->
    <div class="bg-surface-container-lowest rounded-DEFAULT border border-surface-container-high shadow-sm overflow-hidden">
        <div class="p-6 border-b border-surface-container-high flex items-center justify-between">
            <div>
                <h3 class="text-2xl font-normal text-primary tracking-tight" style="font-family: 'Cormorant Garamond', serif;">Tabel Karya Portofolio</h3>
                <p class="text-sm text-on-surface-variant mt-0.5" style="font-family: 'Inter', sans-serif;">Daftar proyek dan karya portofolio yang terdaftar.</p>
            </div>
            <a href="{{ route('admin.portofolio.create') }}" class="text-xs font-semibold text-[#0a2569] hover:underline" style="font-family: 'Inter', sans-serif;">+ Tambah Portofolio Baru</a>
        </div>
        <div class="overflow-x-auto" style="font-family: 'Inter', sans-serif;">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-surface-container-high text-outline text-xs uppercase tracking-wider bg-surface-container-low/30">
                        <th class="py-4 px-6 font-medium w-16">No</th>
                        <th class="py-4 px-6 font-medium">Proyek &amp; Gambar</th>
                        <th class="py-4 px-6 font-medium">Kategori</th>
                        <th class="py-4 px-6 font-medium">Lokasi</th>
                        <th class="py-4 px-6 font-medium">Status</th>
                        <th class="py-4 px-6 font-medium text-right w-44">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-container-high text-sm text-on-surface">
                    @forelse($portofolios as $index => $item)
                        <tr class="hover:bg-surface-container-low/40 transition-colors">
                            <td class="py-5 px-6 font-medium text-slate-500">{{ $index + 1 }}</td>
                            <td class="py-5 px-6">
                                <div class="flex items-center gap-3">
                                    @if($item->image)
                                        <img src="{{ $item->image }}" alt="{{ $item->title }}" class="w-12 h-12 rounded-DEFAULT object-cover border border-slate-200 shrink-0">
                                    @else
                                        <div class="w-12 h-12 rounded-DEFAULT bg-slate-100 border border-slate-200 shrink-0 flex items-center justify-center text-slate-400 text-xs font-semibold">No Image</div>
                                    @endif
                                    <div class="flex flex-col">
                                        <span class="font-medium text-primary text-base" style="font-family: 'Cormorant Garamond', serif;">{{ $item->title }}</span>
                                        <span class="text-xs text-slate-500 line-clamp-1 max-w-xs">{{ $item->description }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-5 px-6 text-on-surface-variant">
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                                    {{ $item->category->title ?? 'Tanpa Kategori' }}
                                </span>
                            </td>
                            <td class="py-5 px-6 text-on-surface-variant">{{ $item->location ?? '-' }}</td>
                            <td class="py-5 px-6">
                                @if($item->status === 'Show')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span> Show
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Hide
                                    </span>
                                @endif
                            </td>
                            <td class="py-5 px-6 text-right space-x-2">
                                <a href="{{ route('admin.portofolio.edit', $item->id) }}" class="inline-flex items-center gap-1 text-xs font-semibold text-amber-600 hover:text-amber-800 bg-amber-50 hover:bg-amber-100 px-3 py-1.5 rounded-DEFAULT transition-colors">
                                    Edit
                                </a>
                                <form action="{{ route('admin.portofolio.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus proyek portofolio ini?')">
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
                            <td colspan="6" class="py-8 text-center text-slate-400">Belum ada portofolio. Klik tombol di atas untuk membuat data baru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
