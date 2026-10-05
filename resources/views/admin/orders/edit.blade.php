@extends('layouts.admin')

@section('title', 'Edit Pesanan - Surya Karya')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-2 gap-4 border-b border-surface-container-high/60">
        <div class="flex flex-col gap-1">
            <h1 class="text-3xl font-normal text-primary tracking-tight" style="font-family: 'Cormorant Garamond', serif;">Edit Pesanan #{{ $order->order_code }}</h1>
            <p class="text-sm text-on-surface-variant font-normal" style="font-family: 'Inter', sans-serif;">Perbarui data pesanan, nilai kontrak, termin, dan status.</p>
        </div>
        <a href="{{ route('admin.orders.index', ['selected' => $order->id]) }}" class="px-4 py-2 rounded-DEFAULT bg-slate-100 text-slate-700 text-sm font-medium hover:bg-slate-200 transition-colors inline-flex items-center gap-2" style="font-family: 'Inter', sans-serif;">
            &larr; Kembali
        </a>
    </div>

    <div class="bg-surface-container-lowest p-8 rounded-DEFAULT border border-surface-container-high shadow-sm max-w-3xl" style="font-family: 'Inter', sans-serif;">
        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-6">
            @csrf
            @method('PUT')

            @php
                $o = $order ?? null;
                $input = 'w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white';
                $label = 'block text-xs uppercase tracking-wider text-outline font-medium mb-2';
            @endphp

            {{-- Identitas --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="{{ $label }}">Nama Lengkap <span class="text-rose-500">*</span></label>
                    <input type="text" name="name" id="name" maxlength="255" required value="{{ old('name', $o->name ?? '') }}" class="{{ $input }}">
                    @error('name') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="company_name" class="{{ $label }}">Nama Perusahaan</label>
                    <input type="text" name="company_name" id="company_name" maxlength="255" value="{{ old('company_name', $o->company_name ?? '') }}" class="{{ $input }}">
                    @error('company_name') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="phone" class="{{ $label }}">Nomor WhatsApp <span class="text-rose-500">*</span></label>
                    <input type="text" name="phone" id="phone" maxlength="50" required value="{{ old('phone', $o->phone ?? '') }}" class="{{ $input }}">
                    @error('phone') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="email" class="{{ $label }}">Email</label>
                    <input type="email" name="email" id="email" maxlength="255" value="{{ old('email', $o->email ?? '') }}" class="{{ $input }}">
                    @error('email') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- Alamat --}}
            <div>
                <label for="address" class="{{ $label }}">Alamat Proyek <span class="text-rose-500">*</span></label>
                <textarea name="address" id="address" rows="2" required class="{{ $input }}">{{ old('address', $o->address ?? '') }}</textarea>
                @error('address') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            {{-- Detail --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="layanan_id" class="{{ $label }}">Jenis Layanan <span class="text-rose-500">*</span></label>
                    <select name="layanan_id" id="layanan_id" required class="{{ $input }}">
                        <option value="" disabled {{ old('layanan_id', $o->layanan_id ?? '') ? '' : 'selected' }}>Pilih Layanan</option>
                        @foreach($layanan as $item)
                            <option value="{{ $item->id }}" @selected((string) old('layanan_id', $o->layanan_id ?? '') === (string) $item->id)>{{ $item->title }}</option>
                        @endforeach
                    </select>
                    @error('layanan_id') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="building_position" class="{{ $label }}">Posisi Bangunan</label>
                    <input type="text" name="building_position" id="building_position" maxlength="255" value="{{ old('building_position', $o->building_position ?? '') }}" class="{{ $input }}">
                    @error('building_position') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="building_area" class="{{ $label }}">Luas Bangunan (m²)</label>
                    <input type="number" name="building_area" id="building_area" min="0" step="1" value="{{ old('building_area', $o->building_area ?? '') }}" class="{{ $input }}">
                    @error('building_area') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="land_area" class="{{ $label }}">Luas Lahan (m²)</label>
                    <input type="number" name="land_area" id="land_area" min="0" step="1" value="{{ old('land_area', $o->land_area ?? '') }}" class="{{ $input }}">
                    @error('land_area') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label for="project_detail" class="{{ $label }}">Kebutuhan Proyek <span class="text-rose-500">*</span></label>
                <textarea name="project_detail" id="project_detail" rows="3" required class="{{ $input }}">{{ old('project_detail', $o->project_detail ?? '') }}</textarea>
                @error('project_detail') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            {{-- Dokumen (preview foto saat ini + input ganti file) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                @foreach(['denah' => 'Gambar Denah', 'lahan' => 'Gambar Lahan'] as $type => $text)
                    @php
                        $field = $type . '_image';
                        $path  = $o->$field ?? null;
                        $url   = $path ? route('admin.orders.file', [$o->id, $type]) . '?v=' . optional($o->updated_at)->timestamp : null;
                        $isPdf = $path && strtolower(pathinfo($path, PATHINFO_EXTENSION)) === 'pdf';
                    @endphp
                    <div>
                        <label for="{{ $field }}" class="{{ $label }}">{{ $text }}</label>

                        @if($url)
                            <div class="mb-3 rounded-DEFAULT border border-slate-200 bg-slate-50 overflow-hidden">
                                <a href="{{ $url }}" target="_blank" rel="noopener" class="block bg-white">
                                    @if($isPdf)
                                        <div class="h-40 flex flex-col items-center justify-center gap-2 text-slate-500">
                                            <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                                            <span class="text-xs font-medium">Dokumen PDF</span>
                                        </div>
                                    @else
                                        <img src="{{ $url }}" alt="{{ $text }} saat ini" loading="lazy"
                                             class="w-full h-40 object-cover hover:opacity-90 transition-opacity"
                                             onerror="this.outerHTML='<div class=&quot;h-40 flex items-center justify-center px-4 text-center text-xs text-slate-400&quot;>File gambar tidak ditemukan di penyimpanan.</div>'">
                                    @endif
                                </a>
                                <div class="px-3 py-2 flex items-center justify-between gap-3 border-t border-slate-200">
                                    <span class="text-[11px] text-outline truncate">{{ basename($path) }}</span>
                                    <a href="{{ $url }}" target="_blank" rel="noopener" class="shrink-0 text-xs font-semibold text-[#0a2569] hover:underline">Buka</a>
                                </div>
                            </div>
                            <p class="text-[11px] text-slate-500 mb-2">Pilih file baru di bawah hanya jika ingin mengganti.</p>
                        @else
                            <p class="text-[11px] text-slate-400 mb-2">Belum ada file terlampir.</p>
                        @endif

                        <input type="file" name="{{ $field }}" id="{{ $field }}" accept=".jpg,.jpeg,.png,.pdf" class="{{ $input }}">
                        @error($field) <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                @endforeach
            </div>

            <div>
                <label for="notes" class="{{ $label }}">Catatan Tambahan</label>
                <textarea name="notes" id="notes" rows="2" class="{{ $input }}">{{ old('notes', $o->notes ?? '') }}</textarea>
                @error('notes') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            {{-- Pembayaran --}}
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-6">
                @foreach(['total' => 'Total', 'termin_1' => 'Termin 1', 'termin_2' => 'Termin 2', 'termin_3' => 'Termin 3'] as $field => $text)
                    <div>
                        <label for="{{ $field }}" class="{{ $label }}">{{ $text }} (Rp)</label>
                        <input type="number" name="{{ $field }}" id="{{ $field }}" min="0" step="0.01" value="{{ old($field, $o->$field ?? '') }}" class="{{ $input }}">
                        @error($field) <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                @endforeach
            </div>

            {{-- Status --}}
            <div class="max-w-xs">
                <label for="status" class="{{ $label }}">Status <span class="text-rose-500">*</span></label>
                <select name="status" id="status" required class="{{ $input }}">
                    @foreach(\App\Models\Order::STATUSES as $val => $text)
                        <option value="{{ $val }}" @selected(old('status', $o->status ?? 'pending') === $val)>{{ $text }}</option>
                    @endforeach
                </select>
                @error('status') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="px-6 py-2.5 rounded-DEFAULT bg-[#0a2569] text-white text-sm font-medium hover:bg-[#081d52] transition-colors">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.orders.index', ['selected' => $order->id]) }}" class="px-5 py-2.5 rounded-DEFAULT bg-slate-100 text-slate-600 text-sm font-medium hover:bg-slate-200 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection