@extends('layouts.admin')

@section('title', 'Kategori Portofolio - Surya Karya')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-2 gap-4 border-b border-surface-container-high/60">
        <div class="flex flex-col gap-1">
            <h1 class="text-3xl font-normal text-primary tracking-tight" style="font-family: 'Cormorant Garamond', serif;">Kategori Portofolio</h1>
            <p class="text-sm text-on-surface-variant font-normal" style="font-family: 'Inter', sans-serif;">Kelola pengelompokan kategori untuk hasil karya portofolio.</p>
        </div>
        <div class="flex items-center gap-3" style="font-family: 'Inter', sans-serif;">
            <a href="{{ route('admin.portofolio-category.create') }}" class="px-5 py-2.5 rounded-DEFAULT bg-[#0a2569] text-white text-sm font-medium hover:bg-[#081d52] transition-colors inline-flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Kategori
            </a>
        </div>
    </div>

    <!-- Data Table Card -->
    <div class="bg-surface-container-lowest rounded-DEFAULT border border-surface-container-high shadow-sm overflow-hidden">
        <div class="p-6 border-b border-surface-container-high">
            <h3 class="text-2xl font-normal text-primary tracking-tight" style="font-family: 'Cormorant Garamond', serif;">Daftar Kategori</h3>
            <p class="text-sm text-on-surface-variant mt-0.5" style="font-family: 'Inter', sans-serif;">Menampilkan seluruh kategori portofolio.</p>
        </div>
        <div class="overflow-x-auto" style="font-family: 'Inter', sans-serif;">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-surface-container-high text-outline text-xs uppercase tracking-wider bg-surface-container-low/30">
                        <th class="py-4 px-6 font-medium w-16">No</th>
                        <th class="py-4 px-6 font-medium">Judul Kategori (Title)</th>
                        <th class="py-4 px-6 font-medium">Jumlah Portofolio</th>
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
                            <td colspan="4" class="py-8 text-center text-slate-400">Belum ada kategori portofolio. Klik tombol di atas untuk membuat data baru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
