@extends('layouts.admin')

@section('title', 'Dashboard Admin - Surya Karya')

@section('content')
@php
    $rp = fn ($v) => 'Rp ' . number_format((float) $v, 0, ',', '.');
@endphp

<div class="flex flex-col w-full gap-space-xl">

    {{-- Judul --}}
    <div class="flex flex-col gap-1 pb-4 border-b border-surface-container-high/60">
        <h1 class="text-3xl font-normal text-primary tracking-tight" style="font-family: 'Cormorant Garamond', serif;">Dashboard Admin</h1>
        <p class="text-sm text-on-surface-variant font-normal" style="font-family: 'Inter', sans-serif;">Ringkasan status proyek konstruksi dan pelacakan pembayaran termin PT Surya Karya.</p>
    </div>

    <div class="flex flex-col gap-space-xl" style="font-family: 'Inter', sans-serif;">

        {{-- Kartu status pesanan --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['Total Pengajuan', $totalPengajuan, 'text-primary',   'bg-[#002271]/40'],
                ['Pending',         $totalPending,   'text-[#1b1b1e]', 'bg-amber-500'],
                ['Deal',            $totalDeal,      'text-primary',   'bg-emerald-600'],
                ['Cancel',          $totalCancel,    'text-[#1b1b1e]', 'bg-rose-500'],
            ] as [$label, $value, $textColor, $dot])
                <div class="bg-surface-container-lowest p-6 rounded-DEFAULT border border-surface-container-high shadow-sm">
                    <span class="text-xs uppercase tracking-wider text-outline font-medium">{{ $label }}</span>
                    <div class="mt-3 flex items-baseline justify-between">
                        <span class="text-4xl {{ $textColor }} tracking-tight" style="font-family: 'Cormorant Garamond', serif;">{{ $value }}</span>
                        <span class="w-2.5 h-2.5 rounded-full {{ $dot }}"></span>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Ringkasan pembayaran & termin --}}
        <section class="bg-surface-container-lowest p-8 rounded-DEFAULT border border-surface-container-high shadow-sm flex flex-col gap-6">
            <div>
                <h2 class="text-2xl font-normal text-primary tracking-tight" style="font-family: 'Cormorant Garamond', serif;">Ringkasan Pembayaran &amp; Termin</h2>
                <p class="text-sm text-on-surface-variant">Ikhtisar perputaran termin dan realisasi arus kas proyek berjalan.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-surface-container-low/60 p-5 rounded-DEFAULT">
                    <span class="text-xs uppercase tracking-wider text-outline font-medium">Total Nilai Proyek</span>
                    <div class="text-3xl font-medium text-primary mt-2" style="font-family: 'Cormorant Garamond', serif;">{{ $totalNilaiProyek }}</div>
                    <div class="text-xs text-on-surface-variant mt-1">{{ $totalNilaiProyekFull }}</div>
                </div>

                <div class="bg-surface-container-low/60 p-5 rounded-DEFAULT">
                    <div class="flex items-center justify-between">
                        <span class="text-xs uppercase tracking-wider text-rose-800 font-medium">Total Outstanding</span>
                        <span class="text-xs font-semibold text-rose-700">{{ $outstandingPercent }}%</span>
                    </div>
                    <div class="text-3xl font-medium text-rose-800 mt-2" style="font-family: 'Cormorant Garamond', serif;">{{ $outstanding }}</div>
                    <div class="text-xs text-on-surface-variant mt-1">{{ $outstandingFull }}</div>
                </div>
            </div>

            <div class="flex flex-col gap-2">
                <div class="flex flex-wrap justify-between gap-x-6 gap-y-1 text-xs text-outline font-medium">
                    <span>Termin 1–3: {{ $totalTermin }} ({{ $totalTerminPercent }}%)</span>
                    <span>Outstanding: {{ $outstanding }} ({{ $outstandingPercent }}%)</span>
                </div>
                <div class="w-full h-3 bg-surface-container-high rounded-full overflow-hidden flex">
                    <div class="h-full bg-primary" style="width: {{ $totalTerminPercent }}%"></div>
                    <div class="h-full bg-amber-400/70" style="width: {{ $outstandingPercent }}%"></div>
                </div>
            </div>
        </section>

        {{-- 3 kartu termin --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($termin as $no => $t)
                <div class="bg-surface-container-lowest p-6 rounded-DEFAULT border border-surface-container-high shadow-sm flex flex-col gap-3">
                    <span class="text-xs uppercase tracking-wider text-outline font-medium">Total Pembayaran Termin {{ $no }}</span>
                    <div class="text-3xl font-medium text-primary" style="font-family: 'Cormorant Garamond', serif;">{{ $t['short'] }}</div>
                    <div class="text-xs text-on-surface-variant">{{ $t['full'] }}</div>
                    <div class="w-full h-1.5 bg-surface-container-high rounded-full overflow-hidden">
                        <div class="h-full bg-emerald-600" style="width: {{ $t['percent'] }}%"></div>
                    </div>
                    <div class="flex justify-between text-xs text-outline">
                        <span>Sudah bayar {{ $t['paid'] }} dari {{ $totalPengajuan }} pesanan</span>
                        <span class="font-medium text-emerald-700">{{ $t['percent'] }}%</span>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Tabel termin --}}
        <section class="bg-surface-container-lowest rounded-DEFAULT border border-surface-container-high shadow-sm overflow-hidden">
            <div class="p-6 border-b border-surface-container-high">
                <h3 class="text-2xl font-normal text-primary tracking-tight" style="font-family: 'Cormorant Garamond', serif;">Tabel Termin Pembayaran</h3>
                <p class="text-sm text-on-surface-variant mt-0.5">Nominal termin yang sudah dibayar per pesanan. Tanda - berarti belum bayar.</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-surface-container-high text-outline text-xs uppercase tracking-wider bg-surface-container-low/30">
                            <th class="py-4 px-6 font-medium">Nama Proyek &amp; Klien</th>
                            <th class="py-4 px-6 font-medium">Termin 1</th>
                            <th class="py-4 px-6 font-medium">Termin 2</th>
                            <th class="py-4 px-6 font-medium">Termin 3</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-container-high text-sm text-on-surface">
                        @forelse($pesanan as $order)
                            <tr class="hover:bg-surface-container-low/40 transition-colors">
                                <td class="py-5 px-6">
                                    <a href="{{ route('admin.orders.index', ['selected' => $order->id]) }}" class="flex flex-col">
                                        <span class="font-medium text-primary text-base" style="font-family: 'Cormorant Garamond', serif;">{{ $order->name }}</span>
                                        <span class="text-xs text-on-surface-variant">
                                            {{ $order->layanan->title ?? '-' }} • {{ $order->order_code }}
                                        </span>
                                    </a>
                                </td>

                                @foreach([1, 2, 3] as $no)
                                    @php $nominal = (float) $order->{"termin_$no"}; @endphp
                                    <td class="py-5 px-6">
                                        @if($nominal > 0)
                                            <span class="font-medium text-on-surface">{{ $rp($nominal) }}</span>
                                        @else
                                            <span class="text-slate-400">-</span>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-8 text-center text-slate-400">Belum ada data pesanan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-5 border-t border-surface-container-high flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-outline">
                  <span>Menampilkan {{ $pesanan->count() }} pesanan terakhir diperbarui dari {{ $totalPengajuan }} pesanan</span>
                  <a href="{{ route('admin.orders.index') }}" class="font-semibold text-[#0a2569] hover:underline">Lihat semua pesanan</a>
            </div>
        </section>

    </div>
</div>
@endsection