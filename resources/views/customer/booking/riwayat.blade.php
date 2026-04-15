@extends('layouts.sidebar')

@section('title', 'Riwayat Pesanan Saya')

@section('content')

<style>
    :root {
        --saas-primary: #2f4b7c;
        --saas-primary-dark: #1f3a60;
        --saas-primary-light: #eef2ff;
        --saas-accent: #2ecc71;
        --saas-accent-dark: #27ae60;
        --saas-warning: #f59e0b;
        --saas-info: #3b82f6;
        --saas-danger: #ef4444;
        --saas-cream: #f6f1d1;
        --saas-white: #ffffff;
        --saas-gray-50: #f8fafc;
        --saas-gray-100: #f1f5f9;
        --saas-gray-200: #e2e8f0;
        --saas-gray-300: #cbd5e1;
        --saas-gray-400: #94a3b8;
        --saas-gray-600: #5b6e8c;
        --saas-gray-700: #334155;
        --saas-gray-800: #1e293b;
        --saas-gray-900: #0f172a;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: linear-gradient(135deg, var(--saas-cream) 0%, #f0ecd5 100%);
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
    }

    /* Container */
    .riwayat-container {
        margin: 0 auto;
    }

    /* Header Section */
    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .header-title h1 {
        font-size: 1.75rem;
        font-weight: 800;
        color: var(--saas-primary);
        letter-spacing: -0.02em;
        margin-bottom: 0.25rem;
    }

    .header-title p {
        color: var(--saas-gray-600);
        font-size: 0.85rem;
    }

    .btn-rent-again {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--saas-primary);
        color: white;
        margin-top: 1rem;
        padding: 0.7rem 1.5rem;
        border-radius: 14px;
        font-weight: 700;
        font-size: 0.85rem;
        text-decoration: none;
        transition: all 0.2s ease;
        box-shadow: var(--shadow-sm);
    }

    .btn-rent-again:hover {
        background: #1f3a60;
        box-shadow: 0 4px 12px rgba(31, 58, 96, 0.2);
    }

    /* Empty State */
    .empty-state {
        background: var(--saas-white);
        border-radius: 28px;
        border: 1px solid rgba(47, 75, 124, 0.08);
        text-align: center;
        padding: 3rem 2rem;
        box-shadow: var(--shadow-md);
    }

    .empty-icon {
        font-size: 4rem;
        color: var(--saas-gray-300);
        margin-bottom: 1rem;
    }

    .empty-title {
        font-size: 16px;
        font-weight: 800;
        color: var(--saas-primary);
        margin-bottom: 0.5rem;
    }

    .empty-text {
        color: var(--saas-gray-600);
        font-size: 0.85rem;
        margin-bottom: 1.5rem;
    }

    .empty-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--saas-primary);
        color: white;
        padding: 0.7rem 1.8rem;
        border-radius: 14px;
        font-weight: 700;
        font-size: 18px;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .empty-btn:hover {
        background: #1f3a60;
        box-shadow: 0 4px 12px rgba(31, 58, 96, 0.2);
    }

    /* Order Card */
    .order-card {
        background: var(--saas-white);
        border-radius: 24px;
        border: 1px solid rgba(47, 75, 124, 0.08);
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: var(--shadow-md);
        margin-bottom: 1.5rem;
    }

    .order-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-xl);
    }

    .order-grid {
        display: grid;
        grid-template-columns: 260px 1fr 300px;
    }

    /* ========== PERBAIKAN GAMBAR ========== */
    .order-image {
        position: relative;
        width: 100%;
        background: linear-gradient(135deg, var(--saas-gray-100) 0%, var(--saas-gray-200) 100%);
        overflow: hidden;
        min-height: 220px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .order-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
        display: block;
        flex-shrink: 0;
        min-width: 100%;
        min-height: 100%;
    }

    .image-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        min-height: 220px;
        width: 100%;
    }

    .image-placeholder i {
        font-size: 3rem;
        color: var(--saas-gray-400);
    }

    /* Info Section */
    .order-info {
        padding: 1.25rem;
        border-right: 1px solid var(--saas-gray-200);
    }

    .order-badge {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex-wrap: wrap;
        margin-bottom: 0.75rem;
    }

    .order-id {
        background: var(--saas-gray-100);
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 700;
        color: var(--saas-primary);
    }

    .order-date {
        font-size: 0.7rem;
        color: var(--saas-gray-600);
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .car-name {
        font-size: 1.1rem;
        font-weight: 800;
        color: var(--saas-gray-800);
        margin-bottom: 1rem;
    }

    .date-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .date-item {
        margin-bottom: 0;
    }

    .date-label {
        font-size: 0.65rem;
        color: var(--saas-gray-600);
        margin-bottom: 0.2rem;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .date-value {
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--saas-gray-800);
    }

    .location-info {
        margin-top: 0.5rem;
    }

    .location-label {
        font-size: 0.65rem;
        color: var(--saas-gray-600);
        margin-bottom: 0.2rem;
    }

    .location-value {
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--saas-gray-700);
        display: flex;
        align-items: center;
        gap: 0.25rem;
        word-break: break-word;
    }

    .location-value i {
        color: var(--saas-danger);
    }

    /* Status Section */
    .order-status {
        padding: 1.25rem;
        background: var(--saas-gray-50);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .total-label {
        font-size: 0.65rem;
        color: var(--saas-gray-600);
        margin-bottom: 0.25rem;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .total-amount {
        font-size: 1.35rem;
        font-weight: 800;
        color: var(--saas-accent);
        margin-bottom: 1rem;
    }

    .status-label {
        font-size: 0.65rem;
        color: var(--saas-gray-600);
        margin-bottom: 0.5rem;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.4rem 1rem;
        border-radius: 30px;
        font-size: 0.7rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .status-pending {
        background: rgba(245, 158, 11, 0.1);
        color: var(--saas-warning);
    }

    .status-disetujui {
        background: rgba(59, 130, 246, 0.1);
        color: var(--saas-info);
    }

    .status-dibayar {
        background: rgba(46, 204, 113, 0.1);
        color: var(--saas-accent);
    }

    .status-selesai {
        background: rgba(47, 75, 124, 0.1);
        color: var(--saas-primary);
    }

    .status-ditolak {
        background: rgba(239, 68, 68, 0.1);
        color: var(--saas-danger);
    }

    .btn-upload {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        background: var(--saas-primary);
        color: white;
        padding: 0.7rem 1rem;
        border-radius: 14px;
        font-weight: 700;
        font-size: 0.75rem;
        text-decoration: none;
        transition: all 0.2s ease;
        width: 100%;
        border: none;
        cursor: pointer;
    }

    .btn-upload:hover {
        background: var(--saas-primary-dark);
        transform: translateY(-2px);
    }

    .reject-reason {
        background: rgba(239, 68, 68, 0.08);
        border-radius: 12px;
        padding: 0.75rem;
        margin-top: 0.5rem;
    }

    .reject-reason i {
        color: var(--saas-danger);
        margin-right: 0.25rem;
    }

    .reject-reason .reason-text {
        font-size: 0.85rem;
        color: var(--saas-gray-700);
        margin-top: 0.25rem;
        word-break: break-word;
    }

    /* ========== RESPONSIVE MOBILE ========== */
    @media (max-width: 968px) {
        .order-grid {
            grid-template-columns: 1fr;
        }

        .order-image {
            min-height: 200px;
            max-height: 240px;
        }

        .order-image img {
            height: 200px;
            object-fit: cover;
        }

        .order-info {
            border-right: none;
            border-bottom: 1px solid var(--saas-gray-200);
        }

        .header-section {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .btn-rent-again {
            margin-top: 0;
        }
        
        /* Pastikan status section tidak memiliki height terbatas */
        .order-status {
            min-height: auto;
            height: auto;
        }
    }

    @media (max-width: 768px) {
        .riwayat-container {
            padding: 0;
        }
        
        .order-card {
            margin-bottom: 1rem;
            border-radius: 20px;
        }
        
        .order-info {
            padding: 1rem;
        }
        
        .car-name {
            font-size: 1rem;
            margin-bottom: 0.75rem;
        }
        
        .date-grid {
            gap: 0.75rem;
        }
        
        .date-value {
            font-size: 0.8rem;
        }
        
        .location-value {
            font-size: 0.7rem;
        }
        
        .order-status {
            padding: 1rem;
            min-height: auto;
            height: auto;
            overflow: visible;
        }
        
        .total-amount {
            font-size: 1.2rem;
            margin-bottom: 0.75rem;
        }
        
        .status-badge {
            padding: 0.3rem 0.8rem;
            font-size: 0.65rem;
            margin-bottom: 0.75rem;
        }
        
        .btn-upload {
            padding: 0.6rem 0.875rem;
            font-size: 0.7rem;
            margin-top: 0.5rem;
        }
        
        .reject-reason {
            padding: 0.6rem;
            margin-top: 0.5rem;
        }
        
        .reject-reason .reason-text {
            font-size: 0.75rem;
        }
        
        /* Empty State Mobile */
        .empty-state {
            padding: 2rem 1rem;
        }
        
        .empty-icon {
            font-size: 3rem;
        }
        
        .empty-title {
            font-size: 1rem;
        }
        
        .empty-text {
            font-size: 0.8rem;
        }
        
        .empty-btn {
            padding: 0.6rem 1.2rem;
            font-size: 0.85rem;
        }
    }

    @media (max-width: 640px) {
        .date-grid {
            grid-template-columns: 1fr;
            gap: 0.5rem;
        }

        .order-badge {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .total-amount {
            font-size: 1.1rem;
        }

        .order-image {
            min-height: 180px;
        }

        .order-image img {
            height: 180px;
        }
        
        .location-info {
            margin-top: 0.35rem;
        }
        
        .order-status {
            padding: 0.875rem;
        }
        
        .btn-upload {
            margin-top: 0.75rem;
        }
    }

    @media (max-width: 480px) {
        .order-image {
            min-height: 160px;
        }
        
        .order-image img {
            height: 160px;
        }
        
        .order-info {
            padding: 0.875rem;
        }
        
        .car-name {
            font-size: 0.95rem;
        }
        
        .order-id {
            font-size: 0.65rem;
        }
        
        .order-date {
            font-size: 0.65rem;
        }
        
        .date-label {
            font-size: 0.6rem;
        }
        
        .date-value {
            font-size: 0.75rem;
        }
        
        .total-amount {
            font-size: 1rem;
        }
        
        .status-badge {
            font-size: 0.6rem;
            padding: 0.25rem 0.7rem;
        }
        
        .btn-upload {
            font-size: 0.65rem;
            padding: 0.5rem 0.75rem;
        }
        
        .reject-reason .reason-text {
            font-size: 0.7rem;
        }
        
        .empty-state {
            padding: 1.5rem;
        }
        
        .empty-icon {
            font-size: 2.5rem;
        }
        
        .empty-title {
            font-size: 0.9rem;
        }
        
        .empty-text {
            font-size: 0.75rem;
        }
    }

    /* Landscape mode untuk mobile */
    @media (max-width: 768px) and (orientation: landscape) {
        .order-grid {
            display: block;
        }
        
        .order-image {
            min-height: 160px;
            max-height: 180px;
        }
        
        .order-image img {
            height: 160px;
        }
        
        .order-info {
            padding: 0.875rem;
        }
        
        .order-status {
            padding: 0.875rem;
            min-height: auto;
        }
        
        .date-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .date-item {
            flex: 1;
            min-width: 120px;
        }
        
        .location-info {
            display: inline-block;
            margin-right: 1rem;
        }
        
        .btn-upload {
            width: auto;
            min-width: 180px;
            margin-top: 0;
        }
        
        .order-status > div {
            margin-bottom: 0.75rem;
        }
    }

    /* Untuk layar lebih besar dari 1200px - gambar lebih lebar */
    @media (min-width: 1200px) {
        .order-grid {
            grid-template-columns: 280px 1fr 320px;
        }

        .order-image {
            min-height: 260px;
        }

        .order-image img {
            height: 260px;
        }
    }
</style>

<!-- Header Section -->
<x-page-header>
    <x-slot:title>
        Riwayat Pesanan
    </x-slot:title>
    <x-slot:actions>
        <a href="{{ route('customer.car') }}" class="btn-rent-again">
            <i class='bx bx-plus'></i> Sewa Mobil Lagi
        </a>
    </x-slot:actions>
</x-page-header>

<div class="riwayat-container">
    @if($bookings->isEmpty())
        <!-- Empty State -->
        <div class="empty-state">
            <div class="empty-icon">
                <i class='bx bx-calendar-x'></i>
            </div>
            <h3 class="empty-title">Belum Ada Pesanan</h3>
            <p class="empty-text">Anda belum pernah melakukan pemesanan mobil.</p>
            <a href="{{ route('customer.car') }}" class="empty-btn">
                Cari Mobil Sekarang
            </a>
        </div>
    @else
        <!-- Order Cards -->
        @foreach($bookings as $booking)
            <div class="order-card">
                <div class="order-grid">
                    <!-- Image Section - Gambar Melebar Penuh -->
                    <div class="order-image">
                        @if($booking->car->images->count() > 0)
                            <img src="{{ asset('storage/' . $booking->car->images->first()->file_path) }}"
                                alt="{{ $booking->car->nama_mobil }}">
                        @else
                            <div class="image-placeholder">
                                <i class='bx bx-car'></i>
                            </div>
                        @endif
                    </div>

                    <!-- Info Section -->
                    <div class="order-info">
                        <div class="order-badge">
                            <span class="order-id">#BK-{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</span>
                            <span class="order-date">
                                <i class='bx bx-time-five'></i> {{ $booking->created_at->format('d M Y, H:i') }}
                            </span>
                        </div>
                        <h5 class="car-name">{{ $booking->car->nama_mobil }}</h5>

                        <div class="date-grid">
                            <div class="date-item">
                                <div class="date-label">Mulai Sewa</div>
                                <div class="date-value">{{ \Carbon\Carbon::parse($booking->tanggal_mulai)->format('d M Y') }}
                                </div>
                            </div>

                            <div class="date-item">
                                <div class="date-label">Kembali</div>
                                <div class="date-value">{{ \Carbon\Carbon::parse($booking->tanggal_kembali)->format('d M Y') }}
                                </div>
                            </div>

                            <div class="location-info">
                                <div class="location-label">Lokasi</div>
                                <div class="location-value">
                                    <i class='bx bxs-map'></i> {{ $booking->lokasi_customer }}
                                </div>
                            </div>

                            <div class="location-info">
                                <div class="location-label">Diskon</div>
                                <div class="location-value">
                                    @if ($booking->diskon == 0)
                                        Tidak Ada Diskon
                                    @else
                                        {{ $booking->diskon }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Status Section -->
                    <div class="order-status">
                        <div>
                            <div class="total-label">Total Bayar</div>
                            <div class="total-amount">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</div>

                            <div class="status-label">Status</div>
                            @php
                                $statusClass = '';
                                $statusIcon = '';
                                $statusText = '';
                                switch ($booking->status) {
                                    case 'pending':
                                        $statusClass = 'status-pending';
                                        $statusIcon = 'bx-time-five';
                                        $statusText = 'Menunggu Approval';
                                        break;
                                    case 'disetujui':
                                        $statusClass = 'status-disetujui';
                                        $statusIcon = 'bx-check-circle';
                                        $statusText = 'Disetujui';
                                        break;
                                    case 'dibayar':
                                        $statusClass = 'status-dibayar';
                                        $statusIcon = 'bx-credit-card';
                                        $statusText = 'Sudah Dibayar';
                                        break;
                                    case 'selesai':
                                        $statusClass = 'status-selesai';
                                        $statusIcon = 'bx-flag';
                                        $statusText = 'Selesai';
                                        break;
                                    default:
                                        $statusClass = 'status-ditolak';
                                        $statusIcon = 'bx-x-circle';
                                        $statusText = 'Ditolak';
                                }
                            @endphp
                            <span class="status-badge {{ $statusClass }}">
                                <i class='bx {{ $statusIcon }}'></i> {{ $statusText }}
                            </span>
                        </div>

                        @if($booking->status == 'disetujui')
                            <a href="{{ route('customer.riwayat.bayar', $booking->id) }}" class="btn-upload">
                                <i class='bx bx-cloud-upload'></i> Upload Bukti Bayar
                            </a>
                        @elseif($booking->status == 'ditolak')
                            <div class="reject-reason">
                                <div style="font-size: 13px; font-weight: 700">
                                    <i class='bx bx-error-circle'></i> Alasan Penolakan:
                                </div>
                                <div class="reason-text">{{ $booking->alasan_tolak ?? 'Tidak disebutkan' }}</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>

@endsection