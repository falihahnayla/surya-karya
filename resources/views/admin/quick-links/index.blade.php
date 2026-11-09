@extends('layouts.admin')

@section('title', 'Quick Links - Surya Karya')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-2 gap-4 border-b border-surface-container-high/60">
        <div class="flex flex-col gap-1">
            <h1 class="text-3xl font-normal text-primary tracking-tight" style="font-family: 'Cormorant Garamond', serif;">Quick Links</h1>
            <p class="text-sm text-on-surface-variant font-normal" style="font-family: 'Inter', sans-serif;">Daftar tautan cepat yang tampil di footer website.</p>
        </div>
    </div>

    <!-- Data Table Card -->
    <div class="bg-surface-container-lowest rounded-DEFAULT border border-surface-container-high shadow-sm overflow-hidden">
        <div class="p-4 sm:p-6 border-b border-surface-container-high flex flex-col sm:flex-row sm:items-center justify-between gap-3 sm:gap-4">
            <div>
                <h3 class="text-2xl font-normal text-primary tracking-tight" style="font-family: 'Cormorant Garamond', serif;">Daftar Quick Links</h3>
                <p class="text-sm text-on-surface-variant mt-0.5" style="font-family: 'Inter', sans-serif;">Tautan navigasi cepat yang terhubung di footer website.</p>
            </div>
            <a href="{{ route('admin.quick-links.create') }}" class="text-xs font-semibold text-[#0a2569] hover:underline shrink-0 self-start sm:self-auto" style="font-family: 'Inter', sans-serif;">+ Tambah Quick Link</a>
        </div>
        <div class="overflow-x-auto" style="font-family: 'Inter', sans-serif;">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-surface-container-high text-outline text-xs uppercase tracking-wider bg-surface-container-low/30">
                        <th class="py-4 px-6 font-medium w-16">No</th>
                        <th class="py-4 px-6 font-medium">Judul</th>
                        <th class="py-4 px-6 font-medium">URL</th>
                        <th class="py-4 px-6 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-container-high text-sm text-on-surface">
                    @forelse($items as $item)
                        <tr class="hover:bg-surface-container-low/40 transition-colors">
                            <td class="py-4 px-6 text-on-surface-variant">{{ $items->firstItem() + $loop->index }}</td>
                            <td class="py-4 px-6 font-medium text-primary">{{ $item->title }}</td>
                            <td class="py-4 px-6 text-on-surface-variant break-all">
                                <a href="{{ $item->href }}" target="_blank" rel="noopener" class="hover:underline">{{ $item->url }}</a>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.quick-links.edit', $item->id) }}" class="inline-flex items-center text-xs font-semibold text-amber-600 hover:text-amber-800 bg-amber-50 hover:bg-amber-100 px-4 py-2 rounded-DEFAULT transition-colors">Edit</a>
                                    <form action="{{ route('admin.quick-links.destroy', $item->id) }}" method="POST" data-confirm="Apakah Anda yakin ingin menghapus quick link ini?">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="inline-flex items-center text-xs font-semibold text-rose-600 hover:text-rose-800 bg-rose-50 hover:bg-rose-100 px-4 py-2 rounded-DEFAULT transition-colors">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-10 text-center text-slate-400">Belum ada quick link.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($items->hasPages())
            <div class="p-5 border-t border-surface-container-high text-xs">{{ $items->links() }}</div>
        @endif
    </div>
</div>
@endsection