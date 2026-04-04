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
            /* max-width: 1280px; */
            margin: 0 auto;
            /* padding: 2rem; */
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
            padding: 0.7rem 1.5rem;
            border-radius: 14px;
            font-weight: 700;
            font-size: 0.85rem;
            text-decoration: none;
            transition: all 0.2s ease;
            box-shadow: var(--shadow-sm);
        }

        .btn-rent-again:hover {
            background: var(--saas-primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
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
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--saas-gray-800);
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
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .empty-btn:hover {
            background: var(--saas-primary-dark);
            transform: translateY(-2px);
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
            grid-template-columns: 200px 1fr 280px;
        }

        /* Image Section */
        .order-image {
            position: relative;
            height: 100%;
            min-height: 200px;
            background: linear-gradient(135deg, var(--saas-gray-100) 0%, var(--saas-gray-200) 100%);
            overflow: hidden;
        }

        .order-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .image-placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            min-height: 200px;
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
            font-size: 0.7rem;
            color: var(--saas-gray-700);
            margin-top: 0.25rem;
        }

        /* Responsive */
        @media (max-width: 968px) {
            .order-grid {
                grid-template-columns: 1fr;
            }

            .order-image {
                min-height: 200px;
            }

            .order-info {
                border-right: none;
                border-bottom: 1px solid var(--saas-gray-200);
            }

            .riwayat-container {
                padding: 1rem;
            }

            .header-section {
                flex-direction: column;
                align-items: flex-start;
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
            }

            .total-amount {
                font-size: 1.1rem;
            }
        }
    </style>

    <div class="riwayat-container">
        <!-- Header Section -->
        <x-page-header>
            <x-slot name="title">
                <h1>Riwayat Pesanan</h1>
                <p>Pantau status penyewaan mobil Anda di sini</p>
            </x-slot>
            <x-slot name="actions">
                <a href="{{ route('customer.car') }}" class="btn-rent-again">
                    <i class='bx bx-plus'></i> Sewa Mobil Lagi
                </a>
            </x-slot>
        </x-page-header>

        @if($bookings->isEmpty())
            <!-- Empty State -->
            <div class="empty-state">
                <div class="empty-icon">
                    <i class='bx bx-calendar-x'></i>
                </div>
                <h3 class="empty-title">Belum Ada Pesanan</h3>
                <p class="empty-text">Anda belum pernah melakukan pemesanan mobil.</p>
                <a href="{{ route('cars') }}" class="empty-btn">
                    <i class='bx bx-search'></i> Cari Mobil Sekarang
                </a>
            </div>
        @else
            <!-- Order Cards -->
            @foreach($bookings as $booking)
                <div class="order-card">
                    <div class="order-grid">
                        <!-- Image Section -->
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
                            </div>

                            <div class="location-info">
                                <div class="location-label">Lokasi Penjemputan</div>
                                <div class="location-value">
                                    <i class='bx bxs-map'></i> {{ $booking->lokasi_customer }}
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
                                            $statusIcon = 'bx-loader';
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
                                    <i class='bx bx-error-circle'></i> <strong>Alasan:</strong>
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