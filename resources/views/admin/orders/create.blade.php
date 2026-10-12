@extends('layouts.admin')

@section('title', 'Tambah Pesanan - Surya Karya')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-2 gap-4 border-b border-surface-container-high/60">
        <div class="flex flex-col gap-1">
            <h1 class="text-3xl font-normal text-primary tracking-tight" style="font-family: 'Cormorant Garamond', serif;">Tambah Pesanan</h1>
            <p class="text-sm text-on-surface-variant font-normal" style="font-family: 'Inter', sans-serif;">Isi formulir di bawah untuk menambahkan pesanan baru. Kode pesanan dibuat otomatis.</p>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 rounded-DEFAULT bg-slate-100 text-slate-700 text-sm font-medium hover:bg-slate-200 transition-colors inline-flex items-center gap-2" style="font-family: 'Inter', sans-serif;">
            &larr; Kembali
        </a>
    </div>

    <div class="bg-surface-container-lowest p-8 rounded-DEFAULT border border-surface-container-high shadow-sm max-w-3xl" style="font-family: 'Inter', sans-serif;">
        <form action="{{ route('admin.orders.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-6">
            @csrf

            @php
                $o = $order ?? null;
                $input = 'w-full px-4 py-3 rounded-DEFAULT border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#0a2569] text-sm text-slate-900 bg-white';
                $label = 'block text-xs uppercase tracking-wider text-outline font-medium mb-2';
            @endphp

            {{-- Identitas --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="{{ $label }}">Nama Lengkap <span class="text-rose-500">*</span></label>
                    <input type="text" name="name" id="name" maxlength="100" required value="{{ old('name', $o->name ?? '') }}" class="{{ $input }}">
                    @error('name') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="company_name" class="{{ $label }}">Nama Perusahaan</label>
                    <input type="text" name="company_name" id="company_name" maxlength="100" value="{{ old('company_name', $o->company_name ?? '') }}" class="{{ $input }}">
                    @error('company_name') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="phone" class="{{ $label }}">Nomor WhatsApp <span class="text-rose-500">*</span></label>
                    <input type="tel" inputmode="numeric" name="phone" id="phone" maxlength="15" required value="{{ old('phone', $o->phone ?? '') }}" placeholder="Contoh: 08123456789" class="{{ $input }}">
                    @error('phone') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="email" class="{{ $label }}">Email</label>
                    <input type="email" name="email" id="email" maxlength="100" value="{{ old('email', $o->email ?? '') }}" placeholder="alamat.email@domain.com" class="{{ $input }}">
                    @error('email') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- Alamat --}}
            <div>
                <label for="address" class="{{ $label }}">Alamat Proyek <span class="text-rose-500">*</span></label>
                <textarea name="address" id="address" rows="2" maxlength="500" required class="{{ $input }}">{{ old('address', $o->address ?? '') }}</textarea>
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
                    <input type="text" name="building_position" id="building_position" maxlength="100" value="{{ old('building_position', $o->building_position ?? '') }}" class="{{ $input }}">
                    @error('building_position') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="building_area" class="{{ $label }}">Luas Bangunan (m²)</label>
                    <input type="number" name="building_area" id="building_area" min="1" max="1000000" step="1" value="{{ old('building_area', $o->building_area ?? '') }}" class="{{ $input }}">
                    @error('building_area') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="land_area" class="{{ $label }}">Luas Lahan (m²)</label>
                    <input type="number" name="land_area" id="land_area" min="1" max="1000000" step="1" value="{{ old('land_area', $o->land_area ?? '') }}" class="{{ $input }}">
                    @error('land_area') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label for="project_detail" class="{{ $label }}">Kebutuhan Proyek <span class="text-rose-500">*</span></label>
                <textarea name="project_detail" id="project_detail" rows="3" maxlength="2000" required class="{{ $input }}">{{ old('project_detail', $o->project_detail ?? '') }}</textarea>
                @error('project_detail') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            {{-- Dokumen --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="denah_image" class="{{ $label }}">Gambar Denah</label>
                    <input type="file" name="denah_image" id="denah_image" accept=".jpg,.jpeg,.png,.pdf" class="{{ $input }}">
                    @if($o && $o->denah_url)
                        <a href="{{ $o->denah_url }}" target="_blank" rel="noopener" class="text-xs text-[#0a2569] hover:underline mt-1 inline-block">Lihat file saat ini</a>
                    @endif
                    @error('denah_image') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="lahan_image" class="{{ $label }}">Gambar Lahan</label>
                    <input type="file" name="lahan_image" id="lahan_image" accept=".jpg,.jpeg,.png,.pdf" class="{{ $input }}">
                    @if($o && $o->lahan_url)
                        <a href="{{ $o->lahan_url }}" target="_blank" rel="noopener" class="text-xs text-[#0a2569] hover:underline mt-1 inline-block">Lihat file saat ini</a>
                    @endif
                    @error('lahan_image') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label for="notes" class="{{ $label }}">Catatan Tambahan</label>
                <textarea name="notes" id="notes" rows="2" maxlength="1000" class="{{ $input }}">{{ old('notes', $o->notes ?? '') }}</textarea>
                @error('notes') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            {{-- Pembayaran --}}
            <div>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-6">
                    @foreach(['total' => 'Total', 'termin_1' => 'Termin 1', 'termin_2' => 'Termin 2', 'termin_3' => 'Termin 3'] as $field => $text)
                        @php
                            $val = old($field, '');
                            if (is_numeric($val) && (float) $val > 0) {
                                $val = number_format((float) $val, 0, ',', '.');
                            }
                        @endphp
                        <div>
                            <label for="{{ $field }}" class="{{ $label }}">{{ $text }} (Rp)</label>
                            <input type="text" inputmode="numeric" name="{{ $field }}" id="{{ $field }}" value="{{ $val }}" placeholder="0" class="nominal-input {{ $input }}">
                            @error($field) <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    @endforeach
                </div>
                <p class="text-xs text-slate-500 mt-2">
                    Isi nominal dalam Rupiah. Boleh memakai titik atau koma sebagai pemisah ribuan, contoh: 100.000 atau 100,000 (= Rp 100.000). Jangan tulis desimal.
                </p>
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
                    Simpan Data
                </button>
                <a href="{{ route('admin.orders.index') }}" class="px-5 py-2.5 rounded-DEFAULT bg-slate-100 text-slate-600 text-sm font-medium hover:bg-slate-200 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // 1. Nomor WhatsApp: hanya angka
    const phoneInput = document.getElementById('phone');
    if (phoneInput) {
        const cleanPhone = function () {
            phoneInput.value = phoneInput.value.replace(/\D/g, '');
        };
        phoneInput.addEventListener('input', cleanPhone);
        phoneInput.addEventListener('paste', function () {
            setTimeout(cleanPhone, 0);
        });
    }

    // 2. Format nominal otomatis dengan pemisah ribuan titik tanpa merusak posisi kursor
    document.querySelectorAll('.nominal-input').forEach(function (input) {
        function formatDigits(val) {
            const digits = val.replace(/\D/g, '');
            if (!digits) return '';
            return digits.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        function handleFormat() {
            const val = input.value;
            const cursor = input.selectionStart || 0;
            const digitsBefore = val.slice(0, cursor).replace(/\D/g, '').length;

            const formatted = formatDigits(val);
            input.value = formatted;

            let newCursor = 0;
            let count = 0;
            for (let i = 0; i < formatted.length; i++) {
                if (/\d/.test(formatted[i])) count++;
                if (count === digitsBefore) {
                    newCursor = i + 1;
                    break;
                }
            }
            if (digitsBefore === 0) newCursor = 0;
            input.setSelectionRange(newCursor, newCursor);
        }

        input.addEventListener('input', handleFormat);
        input.addEventListener('paste', function () {
            setTimeout(handleFormat, 0);
        });
    });
});
</script>
@endpush
@endsection