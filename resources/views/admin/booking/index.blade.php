@extends('layouts.sidebar')
@section('title', 'Admin | Sewa Mobil')
@section('content')

    <style>
        /* ── 1. Reset & CSS Variables ─────────────────────────────── */
        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --navy: #2f4b7c;
            --navy-dark: #1f3a60;
            --navy-deep: #0f2c4f;
            --green: #2ecc71;
            --cream: #f6f1d1;
            --bg-soft: #f8fafc;
            --bg-light: #f1f5f9;
            --border: #e2e8f0;
            --border-mid: #edf2f7;
            --border-top: #eef2f6;
            --text-base: #1e293b;
            --text-muted: #5b6e8c;
            --radius-card: 24px;
            --radius-btn: 14px;
            --radius-full: 9999px;
            --spacing-1: 0.25rem;
            --spacing-2: 0.5rem;
            --spacing-3: 1rem;
            --spacing-4: 1.5rem;
            --spacing-5: 2rem;
            --spacing-6: 2.5rem;
            --shadow-sm: 0 4px 12px rgba(0, 0, 0, 0.03), 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 10px 25px -5px rgba(47, 75, 124, 0.08), 0 8px 10px -6px rgba(0, 0, 0, 0.02);
            --shadow-lg: 0 20px 30px -12px rgba(47, 75, 124, 0.15);
        }

        body {
            background-color: var(--cream);
            font-family: 'Inter', sans-serif;
            line-height: 1.5;
            color: var(--text-base);
        }

        /* ── 2. Layout & Container ────────────────────────────────── */
        .dashboard-wrapper {
            max-width: 1440px;
            margin: 0 auto;
            padding: var(--spacing-1);
        }

        .dashboard-container {
            width: 100%;
        }

        /* ── 3. Typography ───────────────────────────────────────── */
        .text-dark-primary {
            color: var(--navy) !important;
        }

        .text-accent {
            color: var(--green) !important;
        }

        .text-muted-light {
            color: var(--text-muted);
        }

        .text-center {
            text-align: center;
        }

        .fw-semibold {
            font-weight: 600;
        }

        .fw-bold {
            font-weight: 700;
        }

        .fw-extrabold {
            font-weight: 800;
        }

        .fs-sm {
            font-size: 0.875rem;
        }

        .fs-xs {
            font-size: 0.75rem;
        }

        .fs-2 {
            font-size: 1.5rem;
        }

        /* ── 4. Spacing Utilities ─────────────────────────────────── */
        .mb-1 {
            margin-bottom: var(--spacing-1);
        }

        .mb-2 {
            margin-bottom: var(--spacing-2);
        }

        .mb-3 {
            margin-bottom: var(--spacing-3);
        }

        .mb-4 {
            margin-bottom: var(--spacing-4);
        }

        .mb-6 {
            margin-bottom: var(--spacing-6);
        }

        .mt-1 {
            margin-top: var(--spacing-1);
        }

        .mt-2 {
            margin-top: var(--spacing-2);
        }

        .mt-3 {
            margin-top: var(--spacing-3);
        }

        .mt-4 {
            margin-top: var(--spacing-4);
        }

        .mt-auto {
            margin-top: auto;
        }

        .me-1 {
            margin-right: var(--spacing-1);
        }

        .me-2 {
            margin-right: var(--spacing-2);
        }

        .me-3 {
            margin-right: var(--spacing-3);
        }

        .ms-1 {
            margin-left: var(--spacing-1);
        }

        .ms-2 {
            margin-left: var(--spacing-2);
        }

        .p-3 {
            padding: var(--spacing-3);
        }

        .p-4 {
            padding: var(--spacing-4);
        }

        .p-5 {
            padding: var(--spacing-5);
        }

        .py-2 {
            padding-top: var(--spacing-2);
            padding-bottom: var(--spacing-2);
        }

        .py-3 {
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
        }

        .px-4 {
            padding-left: var(--spacing-4);
            padding-right: var(--spacing-4);
        }

        /* ── 5. Display & Flexbox ─────────────────────────────────── */
        .d-flex {
            display: flex;
        }

        .d-block {
            display: block;
        }

        .flex-wrap {
            flex-wrap: wrap;
        }

        .flex-column {
            flex-direction: column;
        }

        .align-items-center {
            align-items: center;
        }

        .align-items-start {
            align-items: flex-start;
        }

        .justify-content-between {
            justify-content: space-between;
        }

        .justify-content-end {
            justify-content: flex-end;
        }

        .justify-content-center {
            justify-content: center;
        }

        .gap-1 {
            gap: var(--spacing-1);
        }

        .gap-2 {
            gap: var(--spacing-2);
        }

        .gap-3 {
            gap: var(--spacing-3);
        }

        .w-100 {
            width: 100%;
        }

        .h-100 {
            height: 100%;
        }

        /* ── 6. Border Radius & Shadow ───────────────────────────── */
        .rounded-xl {
            border-radius: 20px;
        }

        .rounded-2xl {
            border-radius: var(--radius-card);
        }

        .rounded-full {
            border-radius: var(--radius-full);
        }

        .shadow-sm {
            box-shadow: var(--shadow-sm);
        }

        .shadow-md {
            box-shadow: var(--shadow-md);
        }

        .shadow-hover {
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .shadow-hover:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-lg);
        }

        /* ── 7. Grid System ──────────────────────────────────────── */
        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin: 0;
        }

        .col {
            flex: 1;
            padding: 0;
        }

        .col-12 {
            width: 100%;
            padding: 0;
        }

        .col-md-4 {
            flex: 0 0 calc(33.333% - 1rem);
            padding: 0;
        }

        .col-xl-6 {
            flex: 0 0 calc(50% - 0.75rem);
            padding: 0;
        }

        .g-4 {
            gap: 1.75rem;
        }

        /* ── 8. Stat Card ────────────────────────────────────────── */
        .stat-card {
            background: white;
            border-radius: var(--radius-card);
            padding: var(--spacing-4);
            height: 100%;
            min-height: 130px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .stat-icon-wrapper {
            width: 56px;
            height: 56px;
            background: rgba(47, 75, 124, 0.08);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--navy);
            flex-shrink: 0;
        }

        .stat-content {
            flex: 1;
        }

        /* ── 9. Card Component ───────────────────────────────────── */
        .card-saas {
            margin-top: var(--spacing-5);
            background: #ffffff;
            border-radius: var(--radius-card);
            border: 1px solid rgba(47, 75, 124, 0.06);
            transition: all 0.25s ease;
            overflow: hidden;
        }

        .card-body {
            padding: var(--spacing-4);
        }

        .card-footer {
            background: #fafcff;
            border-top: 1px solid var(--border-mid);
            padding: 0.9rem var(--spacing-4);
        }

        .bg-light-soft {
            background: var(--bg-soft);
        }

        /* ── 10. Info Row ────────────────────────────────────────── */
        .info-row {
            display: flex;
            flex-wrap: wrap;
            gap: var(--spacing-3);
            margin: 0;
        }

        .info-col {
            flex: 1;
            min-width: 140px;
            padding: 0;
        }

        /* ── 11. Status Badge ────────────────────────────────────── */
        .status-badge {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            padding: 0.35rem 1rem;
            border-radius: 40px;
            display: inline-block;
            line-height: 1.3;
        }

        .bg-pending {
            background: #fef9c3;
            color: #854d0e;
        }

        .bg-disetujui {
            background: #d9f0ff;
            color: #0369a1;
        }

        .bg-dibayar {
            background: #d1fae5;
            color: #065f46;
        }

        .bg-selesai {
            background: #e0e7ff;
            color: #1e40af;
        }

        .bg-default {
            background: #fee2e2;
            color: #991b1b;
        }

        /* ── 12. Button ──────────────────────────────────────────── */
        .btn-navy {
            background-color: var(--navy);
            color: var(--cream);
            border: none;
            border-radius: var(--radius-btn);
            padding: 0.7rem 1.5rem;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: var(--spacing-2);
            text-decoration: none;
            white-space: nowrap;
        }

        .btn-navy:hover {
            background-color: var(--navy-dark);
            color: white;
            box-shadow: 0 6px 14px rgba(47, 75, 124, 0.25);
            transform: translateY(-2px);
        }

        .btn-outline-filter {
            background: white;
            border-radius: 16px;
            padding: 0.7rem 1.4rem;
            font-weight: 600;
            font-size: 0.9rem;
            border: 1px solid var(--border);
            color: var(--navy);
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.02);
        }

        .btn-outline-filter:hover {
            background-color: var(--bg-soft);
            border-color: #cbd5e1;
        }

        /* ── 13. Dropdown ────────────────────────────────────────── */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-menu-custom {
            position: absolute;
            top: 110%;
            right: 0;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.1);
            min-width: 190px;
            padding: 0.5rem;
            z-index: 100;
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s;
            border: 1px solid var(--border-top);
        }

        .dropdown.open .dropdown-menu-custom {
            opacity: 1;
            visibility: visible;
        }

        .dropdown-item {
            display: block;
            padding: 0.65rem 1rem;
            border-radius: var(--radius-btn);
            color: var(--text-base);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: background 0.15s;
        }

        .dropdown-item:hover {
            background-color: var(--bg-light);
            color: var(--navy);
        }

        .dropdown-divider {
            height: 1px;
            background: var(--border);
            margin: 0.4rem 0;
        }

        /* ── 14. Divider & Avatar ────────────────────────────────── */
        .divider-dash {
            border-top: 1.5px dashed #e2edf2;
            margin: 1.25rem 0;
        }

        .avatar-initials {
            width: 34px;
            height: 34px;
            background: var(--navy);
            border-radius: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.75rem;
            flex-shrink: 0;
        }

        /* ── 15. Empty State ─────────────────────────────────────── */
        .empty-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem 0;
        }

        .empty-illustration img {
            opacity: 0.85;
        }

        /* ── 16. Responsive (Mobile) ─────────────────────────────── */
        @media (max-width: 768px) {
            .dashboard-wrapper {
                padding: 1rem 1.25rem;
            }

            /* Hanya baris pertama (stats) yang horizontal */
            .row:first-of-type {
                display: flex !important;
                flex-direction: row !important;
                flex-wrap: nowrap !important;
                gap: 0.75rem;
                overflow-x: auto;
            }

            .row:first-of-type .col-md-4 {
                flex: 0 0 auto !important;
                width: calc(33.333% - 0.5rem) !important;
                min-width: 110px;
            }

            /* Row lainnya tetap vertikal */
            .row:not(:first-of-type) {
                flex-direction: column !important;
            }

            .col-md-4,
            .col-xl-6,
            .col-12 {
                width: 100%;
                padding: 0;
                flex: 0 0 100%;
            }

            .stat-card {
                padding: 0.75rem !important;
                min-height: auto !important;
            }

            .stat-icon {
                width: 36px !important;
                height: 36px !important;
                margin-right: 0.5rem !important;
            }

            .stat-icon i {
                font-size: 1.2rem !important;
            }

            .stat-card .fw-extrabold {
                font-size: 1rem !important;
            }

            .stat-card .fs-sm {
                font-size: 0.6rem !important;
            }

            .stat-card .fs-xs {
                font-size: 0.5rem !important;
            }

            .btn-navy {
                padding: 0.5rem 1.2rem;
                font-size: 0.8rem;
            }

            .card-body {
                padding: 1.25rem;
            }
        }
    </style>

    <div class="dashboard-wrapper">

        <div class="dashboard-container">

            {{-- ── Header & Filter ──────────────────────────────────────── --}}
            <x-page-header>
                <x-slot:title>Booking Operasional</x-slot:title>
                <x-slot:subtitle>Kelola pesanan masuk dan pantau performa bisnis Anda.</x-slot:subtitle>
                <x-slot:actions>
                    <div class="dropdown" id="statusDropdown">
                        <button class="btn-outline-filter" type="button" id="dropdownBtn">
                            <i class='bx bx-sort-alt-left me-1'></i>
                            Status: <span id="selectedStatusLabel">
                                {{ request('status', 'Semua') == 'all' ? 'Semua' : ucfirst(request('status', 'Semua')) }}
                            </span>
                            <i class='bx bx-chevron-down ms-1'></i>
                        </button>
                        <div class="dropdown-menu-custom">
                            <a href="{{ route('admin.bookings') }}" class="dropdown-item status-option"
                                data-status="all">Semua
                                Pesanan</a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('admin.bookings', ['status' => 'pending']) }}" class="dropdown-item"
                                data-status="pending">Pending</a>
                            <a href="{{ route('admin.bookings', ['status' => 'disetujui']) }}" class="dropdown-item"
                                data-status="disetujui">Disetujui</a>
                            <a href="{{ route('admin.bookings', ['status' => 'dibayar']) }}" class="dropdown-item"
                                data-status="dibayar">Dibayar</a>
                            <a href="{{ route('admin.bookings', ['status' => 'selesai']) }}" class="dropdown-item"
                                data-status="selesai">Selesai</a>
                        </div>
                    </div>
                </x-slot:actions>
            </x-page-header>

            {{-- ── Stat Cards ───────────────────────────────────────────── --}}
            <div class="row mb-6">
                <div class="col-md-4">
                    <div class="stat-card shadow-hover shadow-sm">
                        <div class="stat-icon-wrapper me-3">
                            <i class="bx bx-hourglass"></i>
                        </div>
                        <div class="stat-content">
                            <p class="fs-sm text-muted-light mb-1">Antrean Sewa</p>
                            <h2 class="fw-extrabold mb-0" style="color: var(--navy); font-size: 2.2rem;" id="pendingCount">
                                {{ $bookings->where('status', 'pending')->count() }}
                            </h2>
                            <span class="fs-xs text-muted-light">unit menunggu konfirmasi</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card shadow-hover shadow-sm">
                        <div class="stat-icon-wrapper me-3">
                            <i class="bx bx-like"></i>
                        </div>
                        <div class="stat-content">
                            <p class="fs-sm text-muted-light mb-1">Total Disetujui</p>
                            <h2 class="fw-extrabold mb-0" style="color: var(--green); font-size: 2.2rem;"
                                id="approvedCount">
                                {{ $bookings->where('status', 'disetujui')->count() }}
                            </h2>
                            <span class="fs-xs text-muted-light">pesanan terkonfirmasi</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card shadow-hover shadow-sm">
                        <div class="stat-icon-wrapper me-3">
                            <i class='bx bx-car fs-2'></i>
                        </div>
                        <div class="stat-content">
                            <p class="fs-sm text-muted-light mb-1">Total Transaksi</p>
                            <h2 class="fw-extrabold mb-0" style="color: var(--navy); font-size: 2.2rem;"
                                id="totalBookingsCount">
                                {{ $bookings->count() }}
                            </h2>
                            <span class="fs-xs text-muted-light">keseluruhan pemesanan</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Booking List / Empty State ───────────────────────────── --}}
            @if ($bookings->isEmpty())
                <div class="card-saas text-center p-5 shadow-sm">
                    <div class="empty-state">
                        <div class="empty-illustration mb-3">
                            <img src="{{ asset('images/no_data.svg') }}" style="width: 250px;" alt="Belum ada data tersedia">
                        </div>
                        <h4 class="fw-bold" style="color: var(--navy);">Belum ada aktivitas</h4>
                        <p class="text-muted-light mt-2">
                            Status "{{ request('status', 'semua') }}" bersih untuk saat ini.
                        </p>
                    </div>
                </div>
            @else
                <div class="row g-4">
                    @foreach ($bookings as $booking)
                        <div class="col-xl-6">
                            <div class="card-saas shadow-hover shadow-md h-100" style="display: flex; flex-direction: column;">

                                <div class="card-body" style="flex: 1;">

                                    {{-- Header: Mobil + Status Badge --}}
                                    <div class="d-flex justify-content-between align-items-start mb-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="bg-light-soft rounded-2xl" style="padding: 0.75rem;">
                                                <i class='bx bxs-car fs-2' style="color: var(--navy);"></i>
                                            </div>
                                            <div>
                                                <h5 class="fw-bold mb-1" style="color: var(--navy-deep);">
                                                    {{ $booking->car->nama_mobil }}
                                                </h5>
                                                <span class="fs-xs text-muted-light">{{ $booking->car->plat_nomor }}</span>
                                            </div>
                                        </div>
                                        <span
                                            class="status-badge
                                                                                                                                                        @if($booking->status == 'pending')   bg-pending
                                                                                                                                                        @elseif($booking->status == 'disetujui') bg-disetujui
                                                                                                                                                        @elseif($booking->status == 'dibayar')   bg-dibayar
                                                                                                                                                        @elseif($booking->status == 'selesai')   bg-selesai
                                                                                                                                                        @else bg-default @endif">
                                            {{ strtoupper($booking->status) }}
                                        </span>
                                    </div>

                                    {{-- Info: Penyewa & Tanggal --}}
                                    <div class="info-row mb-3">
                                        <div class="info-col">
                                            <label class="text-muted-light fs-xs d-block mb-1">Penyewa</label>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="avatar-initials">
                                                    {{ strtoupper(substr($booking->customer->name, 0, 2)) }}
                                                </div>
                                                <span class="fw-semibold fs-sm">{{ $booking->customer->name }}</span>
                                            </div>
                                        </div>
                                        <div class="info-col">
                                            <label class="text-muted-light fs-xs d-block mb-1">Tanggal Sewa</label>
                                            <div class="d-flex align-items-center gap-1">
                                                <i class='bx bx-calendar text-muted-light'></i>
                                                <span class="fw-semibold fs-sm">
                                                    {{ \Carbon\Carbon::parse($booking->tanggal_sewa)->format('d M Y') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="divider-dash"></div>

                                    {{-- Footer: Tagihan & Tombol --}}
                                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mt-2">
                                        <div>
                                            <p class="fs-xs text-muted-light mb-1">Total Tagihan</p>
                                            <h4 class="fw-extrabold mb-0" style="color: var(--green);">
                                                Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
                                            </h4>
                                        </div>
                                        <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn-navy">
                                            Kelola Pesanan <i class='bx bx-chevron-right'></i>
                                        </a>
                                    </div>

                                </div>

                                <div class="card-footer">
                                    <span class="fs-xs text-muted-light">
                                        <i class='bx bx-bolt-circle me-1'></i>
                                        ID Transaksi: #TXN-{{ $booking->id }}{{ date('Ymd') }}
                                    </span>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>

    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const dropdownEl = document.getElementById('statusDropdown');
                const btn = document.getElementById('dropdownBtn');
                if (!dropdownEl || !btn) return;

                btn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    dropdownEl.classList.toggle('open');
                });

                document.addEventListener('click', (e) => {
                    if (!dropdownEl.contains(e.target)) {
                        dropdownEl.classList.remove('open');
                    }
                });
            });
        </script>
    @endpush

@endsection