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
            --radius-card: 20px;
            --radius-btn: 12px;
            --radius-full: 9999px;
            --spacing-1: 0.25rem;
            --spacing-2: 0.5rem;
            --spacing-3: 1rem;
            --spacing-4: 1.25rem;
            --spacing-5: 1.5rem;
            --spacing-6: 2rem;
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
        .text-muted-light {
            color: var(--text-muted);
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

        .mt-2 {
            margin-top: var(--spacing-2);
        }

        .mt-3 {
            margin-top: var(--spacing-3);
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

        .p-3 {
            padding: var(--spacing-3);
        }

        .p-4 {
            padding: var(--spacing-4);
        }

        .p-5 {
            padding: var(--spacing-5);
        }

        /* ── 5. Display & Flexbox ─────────────────────────────────── */
        .d-flex {
            display: flex;
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

        /* ── 6. Grid System - Booking List 2 Kolom Rapi ─────────────────── */
        .booking-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        /* ── 7. Stat Card ────────────────────────────────────────── */
        .stat-card {
            background: white;
            border-radius: var(--radius-card);
            padding: var(--spacing-4);
            height: 100%;
            min-height: 120px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(47, 75, 124, 0.06);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
        }

        .stat-icon-wrapper {
            width: 52px;
            height: 52px;
            background: rgba(47, 75, 124, 0.08);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--navy);
            flex-shrink: 0;
        }

        .stat-icon-wrapper i {
            font-size: 1.5rem;
        }

        .stat-content {
            flex: 1;
        }

        .stat-label {
            font-size: 0.7rem;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 0.15rem;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .stat-value {
            font-size: 1.75rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 0.15rem;
        }

        .stat-unit {
            font-size: 0.65rem;
            color: var(--text-muted);
        }

        /* ── 8. Card Booking Component ───────────────────────────────────── */
        .booking-card {
            background: #ffffff;
            border-radius: var(--radius-card);
            border: 1px solid rgba(47, 75, 124, 0.06);
            transition: all 0.3s ease;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            height: 100%;
            box-shadow: var(--shadow-sm);
        }

        .booking-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }

        .booking-card-body {
            padding: 1.25rem;
            flex: 1;
        }

        .booking-card-footer {
            background: #fafcff;
            border-top: 1px solid var(--border-mid);
            padding: 0.75rem 1.25rem;
        }

        /* Header Card */
        .card-header-info {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .car-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .car-icon {
            background: var(--bg-soft);
            padding: 0.65rem;
            border-radius: 14px;
        }

        .car-icon i {
            font-size: 1.25rem;
            color: var(--navy);
        }

        .car-title {
            font-weight: 800;
            font-size: 1rem;
            color: var(--navy-deep);
            margin-bottom: 0.2rem;
        }

        .car-plate {
            font-size: 0.65rem;
            color: var(--text-muted);
            text-transform: uppercase;
        }

        /* Status Badge */
        .status-badge {
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            padding: 0.3rem 0.85rem;
            border-radius: 30px;
            display: inline-block;
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

        /* Info Row */
        .info-two-columns {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .info-column {
            flex: 1;
        }

        .info-label {
            font-size: 0.6rem;
            color: var(--text-muted);
            margin-bottom: 0.25rem;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .info-value {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-base);
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .avatar-initials {
            width: 28px;
            height: 28px;
            background: var(--navy);
            border-radius: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 0.7rem;
            flex-shrink: 0;
        }

        .divider-dash {
            border-top: 1px dashed var(--border);
            margin: 0.75rem 0;
        }

        /* Price & Button */
        .price-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-top: 0.5rem;
        }

        .price-label {
            font-size: 0.6rem;
            color: var(--text-muted);
            margin-bottom: 0.2rem;
        }

        .price-value {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--green);
        }

        .btn-navy {
            background-color: var(--navy);
            color: var(--cream);
            border: none;
            border-radius: var(--radius-btn);
            padding: 0.5rem 1.2rem;
            font-weight: 600;
            font-size: 0.75rem;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            white-space: nowrap;
        }

        .btn-navy:hover {
            background-color: var(--navy-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(47, 75, 124, 0.2);
        }

        /* Transaction ID */
        .transaction-id {
            font-size: 0.65rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        /* Stats Row */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            background: white;
            border-radius: var(--radius-card);
        }

        /* Dropdown */
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
            min-width: 180px;
            padding: 0.5rem;
            z-index: 100;
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s;
            border: 1px solid var(--border);
        }

        .dropdown.open .dropdown-menu-custom {
            opacity: 1;
            visibility: visible;
        }

        .dropdown-item {
            display: block;
            padding: 0.6rem 1rem;
            border-radius: 10px;
            color: var(--text-base);
            text-decoration: none;
            font-size: 0.8rem;
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

        .btn-outline-filter {
            background: white;
            border-radius: 14px;
            padding: 0.6rem 1.2rem;
            font-weight: 600;
            font-size: 0.85rem;
            border: 1px solid var(--border);
            color: var(--navy);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .booking-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }
        }

        @media (max-width: 768px) {
            .dashboard-wrapper {
                padding: 1rem;
            }

            .stats-row {
                display: flex;
                flex-direction: row;
                flex-wrap: nowrap;
                gap: 0.75rem;
                overflow-x: auto;
                margin-bottom: 1.5rem;
            }

            .stats-row .stat-card {
                min-width: 140px;
                padding: 0.75rem;
            }

            .booking-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .stat-value {
                font-size: 1.25rem;
            }

            .stat-label {
                font-size: 0.6rem;
            }

            .stat-unit {
                font-size: 0.55rem;
            }

            .stat-icon-wrapper {
                width: 40px;
                height: 40px;
            }

            .stat-icon-wrapper i {
                font-size: 1.2rem;
            }

            .btn-navy {
                padding: 0.4rem 1rem;
                font-size: 0.7rem;
            }

            .price-value {
                font-size: 1rem;
            }
        }
    </style>

    <div class="dashboard-wrapper">
        <div class="dashboard-container">

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
                            <a href="{{ route('admin.bookings') }}" class="dropdown-item">Semua Pesanan</a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('admin.bookings', ['status' => 'pending']) }}"
                                class="dropdown-item">Pending</a>
                            <a href="{{ route('admin.bookings', ['status' => 'disetujui']) }}"
                                class="dropdown-item">Disetujui</a>
                            <a href="{{ route('admin.bookings', ['status' => 'dibayar']) }}"
                                class="dropdown-item">Dibayar</a>
                            <a href="{{ route('admin.bookings', ['status' => 'selesai']) }}"
                                class="dropdown-item">Selesai</a>
                        </div>
                    </div>
                </x-slot:actions>
                {{-- Header & Filter --}}
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="fw-extrabold" style="color: var(--navy); font-size: 1.5rem;">Booking Operasional</h1>
                        <p class="text-muted-light" style="font-size: 0.8rem;">Kelola pesanan masuk dan pantau performa
                            bisnis
                            Anda.</p>
                    </div>
                    <div class="dropdown" id="statusDropdown">
                        <button class="btn-outline-filter" type="button" id="dropdownBtn">
                            <i class='bx bx-sort-alt-left me-1'></i>
                            Status: <span id="selectedStatusLabel">
                                {{ request('status', 'Semua') == 'all' ? 'Semua' : ucfirst(request('status', 'Semua')) }}
                            </span>
                            <i class='bx bx-chevron-down ms-1'></i>
                        </button>
                        <div class="dropdown-menu-custom">
                            <a href="{{ route('admin.bookings') }}" class="dropdown-item">Semua Pesanan</a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('admin.bookings', ['status' => 'pending']) }}"
                                class="dropdown-item">Pending</a>
                            <a href="{{ route('admin.bookings', ['status' => 'disetujui']) }}"
                                class="dropdown-item">Disetujui</a>
                            <a href="{{ route('admin.bookings', ['status' => 'dibayar']) }}"
                                class="dropdown-item">Dibayar</a>
                            <a href="{{ route('admin.bookings', ['status' => 'selesai']) }}"
                                class="dropdown-item">Selesai</a>
                        </div>
                    </div>
                </div>
            </x-page-header>

            {{-- Stat Cards --}}
            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-icon-wrapper me-3">
                        <i class="bx bx-hourglass"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-label">Antrean Sewa</div>
                        <div class="stat-value" style="color: var(--navy);">
                            {{ $bookings->where('status', 'pending')->count() }}
                        </div>
                        <div class="stat-unit">Unit Menunggu Konfirmasi</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon-wrapper me-3">
                        <i class="bx bx-like"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-label">Total Disetujui</div>
                        <div class="stat-value" style="color: var(--green);">
                            {{ $bookings->where('status', 'disetujui', 'dibayar')->count() }}
                        </div>
                        <div class="stat-unit">Pesanan Terkonfirmasi</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon-wrapper me-3">
                        <i class='bx bx-car'></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-label">Total Transaksi</div>
                        <div class="stat-value" style="color: var(--navy);">{{ $bookings->where('status', 'selesai')->count() }}</div>
                        <div class="stat-unit">Keseluruhan Pemesanan</div>
                    </div>
                </div>
            </div>

            {{-- Booking List Grid 2 Kolom --}}
            @if ($bookings->isEmpty())
                <div class="empty-state">
                    <i class='bx bx-calendar-x' style="font-size: 3rem; color: var(--text-muted); opacity: 0.5;"></i>
                    <h4 class="fw-bold mt-3" style="color: var(--navy);">Belum ada aktivitas</h4>
                    <p class="text-muted-light">Status "{{ request('status', 'semua') }}" bersih untuk saat ini.</p>
                </div>
            @else
                <div class="booking-grid">
                    @foreach ($bookings as $booking)
                        <div class="booking-card">
                            <div class="booking-card-body">
                                {{-- Header --}}
                                <div class="card-header-info">
                                    <div class="car-info">
                                        <div class="car-icon">
                                            <i class='bx bxs-car'></i>
                                        </div>
                                        <div>
                                            <h5 class="car-title">{{ $booking->car->nama_mobil }}</h5>
                                            <span class="car-plate">{{ $booking->car->plat_nomor }}</span>
                                        </div>
                                    </div>
                                    <span class="status-badge
                                                                @if($booking->status == 'pending') bg-pending
                                                                @elseif($booking->status == 'disetujui') bg-disetujui
                                                                @elseif($booking->status == 'dibayar') bg-dibayar
                                                                @elseif($booking->status == 'selesai') bg-selesai
                                                                @else bg-default @endif">
                                        {{ strtoupper($booking->status) }}
                                    </span>
                                </div>

                                {{-- Info Penyewa & Tanggal --}}
                                <div class="info-two-columns">
                                    <div class="info-column">
                                        <div class="info-label">Penyewa</div>
                                        <div class="info-value">
                                            <div class="avatar-initials">
                                                {{ strtoupper(substr($booking->customer->name, 0, 2)) }}
                                            </div>
                                            <span>{{ $booking->customer->name }}</span>
                                        </div>
                                    </div>
                                    <div class="info-column">
                                        <div class="info-label">Tanggal Sewa</div>
                                        <div class="info-value">
                                            <i class='bx bx-calendar'></i>
                                            <span>{{ \Carbon\Carbon::parse($booking->tanggal_sewa)->format('d M Y') }}</span>
                                        </div>
                                        <div class="info-label mt-2">Tanggal Selesai</div>
                                        <div class="info-value">
                                            <i class='bx bx-calendar-check'></i>
                                            <span>{{ \Carbon\Carbon::parse($booking->tanggal_kembali)->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="divider-dash"></div>

                                {{-- Price & Button --}}
                                <div class="price-section">
                                    <div>
                                        <div class="price-label">Total Tagihan</div>
                                        <div class="price-value">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</div>
                                    </div>
                                    <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn-navy">
                                        Kelola <i class='bx bx-chevron-right'></i>
                                    </a>
                                </div>
                            </div>
                            <div class="booking-card-footer">
                                <div class="transaction-id">
                                    <i class='bx bx-bolt-circle'></i>
                                    ID Transaksi: #BK-{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}
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