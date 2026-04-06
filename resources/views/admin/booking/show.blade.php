@extends('layouts.sidebar')

@section('title', 'Detail Pesanan #' . $booking->id)

@section('content')

    <style>
        :root {
            --saas-primary: #2f4b7c;
            --saas-primary-dark: #1f3a60;
            --saas-primary-light: #eef2ff;
            --saas-accent: #2ecc71;
            --saas-accent-dark: #27ae60;
            --saas-danger: #ef4444;
            --saas-warning: #f59e0b;
            --saas-info: #3b82f6;
            --saas-cream: #f6f1d1;
            --saas-white: #ffffff;
            --saas-gray-50: #f8fafc;
            --saas-gray-100: #f1f5f9;
            --saas-gray-200: #e2e8f0;
            --saas-gray-300: #cbd5e1;
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
        .detail-container {
            margin: 0 auto;
        }

        /* Header Section */
        .header-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--saas-white);
            border: 1px solid var(--saas-gray-200);
            padding: 0.6rem 1.2rem;
            border-radius: 14px;
            color: var(--saas-gray-700);
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .back-btn:hover {
            background: var(--saas-gray-50);
            transform: translateX(-4px);
            box-shadow: var(--shadow-sm);
        }

        .order-title {
            font-size: 1.35rem;
            font-weight: 800;
            color: var(--saas-gray-800);
            margin: 0;
        }

        /* Status Badge */
        .status-badge {
            padding: 0.5rem 1.25rem;
            border-radius: 40px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.3px;
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

        /* Grid Layout */
        .detail-grid {
            display: grid;
            grid-template-columns: 1.2fr 0.9fr;
            gap: 1.75rem;
        }

        /* Card Wrapper */
        .card-wrapper {
            background: transparent;
            position: relative;
        }

        .card-wrapper::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(135deg, var(--saas-primary) 0%, var(--saas-accent) 100%);
            border-radius: 30px;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: -1;
        }

        .card-wrapper:hover::before {
            opacity: 0.15;
        }

        /* Card Styles */
        .card-saas {
            background: var(--saas-white);
            border-radius: 24px;
            border: 1px solid rgba(47, 75, 124, 0.08);
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-md);
        }

        .card-saas:hover {
            box-shadow: var(--shadow-xl);
        }

        .card-body-custom {
            padding: 1.5rem;
        }

        /* Section Title */
        .section-title {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--saas-gray-800);
            border-left: 3px solid var(--saas-primary);
            padding-left: 0.75rem;
            margin-bottom: 1.25rem;
        }

        /* Info Grid */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .info-item {
            margin-bottom: 0.5rem;
        }

        .info-label {
            font-size: 0.7rem;
            color: var(--saas-gray-600);
            margin-bottom: 0.25rem;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .info-value {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--saas-gray-800);
        }

        .info-value.text-primary {
            color: var(--saas-primary);
        }

        .info-value i {
            margin-right: 0.25rem;
        }

        /* Car Section */
        .car-info-row {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.25rem;
        }

        .car-image-thumb {
            width: 100px;
            height: 80px;
            border-radius: 14px;
            object-fit: cover;
            background: var(--saas-gray-100);
        }

        .car-details h5 {
            font-size: 1rem;
            font-weight: 800;
            color: var(--saas-gray-800);
            margin-bottom: 0.25rem;
        }

        .car-details p {
            font-size: 0.7rem;
            color: var(--saas-gray-600);
        }

        /* Divider */
        .divider-light {
            height: 1px;
            background: linear-gradient(90deg, var(--saas-gray-200) 0%, transparent 100%);
            margin: 1rem 0;
        }

        /* Stats Row for Sewa Info */
        .stats-row-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0.75rem;
            margin: 1rem 0;
        }

        .stat-mini {
            background: var(--saas-gray-50);
            border-radius: 16px;
            padding: 0.75rem;
            text-align: center;
            border: 1px solid var(--saas-gray-100);
        }

        .stat-mini-label {
            font-size: 0.6rem;
            color: var(--saas-gray-600);
            margin-bottom: 0.25rem;
        }

        .stat-mini-value {
            font-size: 0.9rem;
            font-weight: 800;
            color: var(--saas-primary);
        }

        /* Note Box */
        .note-box {
            background: var(--saas-gray-50);
            border-radius: 16px;
            padding: 1rem;
            margin-top: 1rem;
            border: 1px solid var(--saas-gray-100);
        }

        .note-label {
            font-size: 0.65rem;
            color: var(--saas-gray-600);
            margin-bottom: 0.5rem;
        }

        .note-text {
            font-size: 0.8rem;
            font-style: italic;
            color: var(--saas-gray-700);
            margin: 0;
        }

        /* Bukti Bayar Section */
        .payment-proof {
            text-align: center;
        }

        .proof-image {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            border-radius: 16px;
            border: 1px solid var(--saas-gray-200);
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .proof-image:hover {
            transform: scale(1.02);
        }

        .empty-proof {
            background: var(--saas-gray-50);
            border: 2px dashed var(--saas-gray-300);
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
        }

        .empty-proof i {
            font-size: 3rem;
            color: var(--saas-gray-300);
            margin-bottom: 0.5rem;
        }

        .empty-proof p {
            font-size: 0.75rem;
            color: var(--saas-gray-600);
            margin: 0;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .btn-approve {
            background: var(--saas-accent);
            color: white;
            border: none;
            padding: 0.9rem;
            border-radius: 14px;
            font-weight: 700;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            text-decoration: none;
        }

        .btn-approve:hover {
            background: var(--saas-accent-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(46, 204, 113, 0.3);
        }

        .btn-reject {
            background: transparent;
            border: 1.5px solid var(--saas-danger);
            color: var(--saas-danger);
            padding: 0.85rem;
            border-radius: 14px;
            font-weight: 700;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
        }

        .btn-reject:hover {
            background: var(--saas-danger);
            color: white;
            transform: translateY(-2px);
        }

        .btn-complete {
            background: var(--saas-primary);
            color: white;
            border: none;
            padding: 0.9rem;
            border-radius: 14px;
            font-weight: 700;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
        }

        .btn-complete:hover {
            background: var(--saas-primary-dark);
            transform: translateY(-2px);
        }

        .info-alert {
            background: rgba(59, 130, 246, 0.1);
            border-radius: 16px;
            padding: 1rem;
            text-align: center;
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        .info-alert i {
            font-size: 1.5rem;
            color: var(--saas-info);
            margin-bottom: 0.5rem;
        }

        .info-alert p {
            font-size: 0.75rem;
            color: var(--saas-gray-700);
            margin: 0;
        }

        .info-muted {
            background: var(--saas-gray-50);
            border-radius: 16px;
            padding: 1rem;
            text-align: center;
            border: 1px solid var(--saas-gray-200);
        }

        .info-muted i {
            color: var(--saas-gray-400);
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        /* Modal */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-container {
            background: var(--saas-white);
            border-radius: 28px;
            max-width: 450px;
            width: 90%;
            overflow: hidden;
            animation: modalSlideIn 0.2s ease;
        }

        @keyframes modalSlideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--saas-gray-200);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--saas-gray-800);
            margin: 0;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--saas-gray-600);
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-text {
            font-size: 0.8rem;
            color: var(--saas-gray-600);
            margin-bottom: 1rem;
        }

        .modal-textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--saas-gray-200);
            border-radius: 14px;
            font-family: inherit;
            font-size: 0.85rem;
            resize: vertical;
            background: var(--saas-gray-50);
        }

        .modal-textarea:focus {
            outline: none;
            border-color: var(--saas-primary);
            box-shadow: 0 0 0 3px rgba(47, 75, 124, 0.1);
        }

        .modal-footer {
            padding: 1rem 1.5rem 1.5rem;
            display: flex;
            gap: 0.75rem;
            justify-content: flex-end;
        }

        .btn-cancel {
            background: var(--saas-gray-100);
            border: none;
            padding: 0.6rem 1.25rem;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-confirm-reject {
            background: var(--saas-danger);
            color: white;
            border: none;
            padding: 0.6rem 1.5rem;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
        }

        /* Responsive */
        @media (max-width: 968px) {
            .detail-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .detail-container {
                padding: 1rem;
            }

            .stats-row-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .header-section {
                flex-direction: column;
                align-items: flex-start;
            }

            .info-grid {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .car-info-row {
                flex-direction: column;
            }

            .car-image-thumb {
                width: 100%;
                height: 150px;
            }
        }
    </style>

    <div class="detail-container">
        <!-- Header Section -->

        <x-page-header class="header-section">
            <x-slot name="title">
                Detail Pesanan #BK-{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}
            </x-slot>
            <x-slot name="back_url">
                {{ route('admin.bookings') }}
            </x-slot>


            @php
                $statusClass = '';
                $statusText = '';
                switch ($booking->status) {
                    case 'pending':
                        $statusClass = 'status-pending';
                        $statusText = 'Menunggu Persetujuan';
                        break;
                    case 'disetujui':
                        $statusClass = 'status-disetujui';
                        $statusText = 'Disetujui';
                        break;
                    case 'dibayar':
                        $statusClass = 'status-dibayar';
                        $statusText = 'Dibayar (Menunggu Penyelesaian)';
                        break;
                    case 'selesai':
                        $statusClass = 'status-selesai';
                        $statusText = 'Sewa Selesai';
                        break;
                    default:
                        $statusClass = 'status-ditolak';
                        $statusText = 'Ditolak';
                }
            @endphp
            <span class="status-badge {{ $statusClass }}">{{ $statusText }}</span>
        </x-page-header>

        <!-- Main Grid -->
        <div class="detail-grid">
            <!-- Left Column -->
            <div>
                <!-- Customer Information Card -->
                <div class="card-wrapper mb-4">
                    <div class="card-saas">
                        <div class="card-body-custom">
                            <h6 class="section-title">Informasi Customer</h6>
                            <div class="info-grid">
                                <div class="info-item">
                                    <div class="info-label">Nama Lengkap</div>
                                    <div class="info-value">{{ $booking->customer->name }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Nomor Telepon</div>
                                    <div class="info-value text-primary">
                                        <i class='bx bxl-whatsapp'></i> {{ $booking->no_telepon }}
                                    </div>
                                </div>
                                <div class="info-item" style="grid-column: span 2;">
                                    <div class="info-label">Lokasi Customer</div>
                                    <div class="info-value">
                                        {{ $booking->lokasi_customer }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Car & Rental Information Card -->
                <div class="card-wrapper">
                    <div class="card-saas">
                        <div class="card-body-custom">
                            <h6 class="section-title">Informasi Mobil & Sewa</h6>

                            <div class="car-info-row">
                                @if($booking->car->images->count() > 0)
                                    <img src="{{ asset('storage/' . $booking->car->images->first()->file_path) }}"
                                        class="car-image-thumb" alt="{{ $booking->car->nama_mobil }}">
                                @else
                                    <div class="car-image-thumb bg-light d-flex align-items-center justify-content-center">
                                        <i class='bx bx-car' style="font-size: 2rem; color: var(--saas-gray-400);"></i>
                                    </div>
                                @endif
                                <div class="car-details">
                                    <h5>{{ $booking->car->nama_mobil }}</h5>
                                    <p><span style="text-transform: uppercase;">
                                            {{ $booking->car->plat_nomor }}
                                        </span>
                                        - {{ $booking->car->kasta }}
                                    </p>
                                </div>
                            </div>

                            <div class="divider-light"></div>

                            <div class="stats-row-grid">
                                <div class="stat-mini">
                                    <div class="stat-mini-label">Tgl Sewa</div>
                                    <div class="stat-mini-value">
                                        {{ \Carbon\Carbon::parse($booking->tanggal_mulai)->format('d M Y') }}
                                    </div>
                                </div>
                                <div class="stat-mini">
                                    <div class="stat-mini-label">Tgl Kembali</div>
                                    <div class="stat-mini-value">
                                        {{ \Carbon\Carbon::parse($booking->tanggal_kembali)->format('d M Y') }}
                                    </div>
                                </div>
                                <div class="stat-mini">
                                    <div class="stat-mini-label">Durasi</div>
                                    <div class="stat-mini-value">{{ $booking->durasi_hari }} Hari</div>
                                </div>
                                <div class="stat-mini">
                                    <div class="stat-mini-label">Total Biaya</div>
                                    <div class="stat-mini-value" style="color: var(--saas-accent);">Rp
                                        {{ number_format($booking->total_harga, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>

                            @if($booking->catatan)
                                <div class="note-box">
                                    <div class="note-label">
                                        Catatan Customer:
                                    </div>
                                    <p class="note-text">"{{ $booking->catatan }}"</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div>
                <!-- Payment Proof Card -->
                <div class="card-wrapper mb-4">
                    <div class="card-saas">
                        <div class="card-body-custom">
                            <h6 class="section-title">Bukti Pembayaran</h6>

                            @if($booking->bukti_bayar)
                                <div class="payment-proof">
                                    <a href="{{ asset('storage/' . $booking->bukti_bayar) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $booking->bukti_bayar) }}" class="proof-image"
                                            alt="Bukti Bayar">
                                    </a>
                                    <p class="info-label" style="margin-top: 0.75rem; text-align: center;">
                                        <i class='bx bx-search-alt-2'></i> Klik gambar untuk memperbesar
                                    </p>
                                </div>
                            @else
                                <div class="empty-proof">
                                    <i class='bx bx-receipt'></i>
                                    <p>Belum ada bukti pembayaran.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Admin Actions Card -->
                <div class="card-wrapper">
                    <div class="card-saas">
                        <div class="card-body-custom">
                            <h6 class="section-title">Persetujuan?</h6>

                            @if($booking->status == 'pending')
                                <div class="action-buttons">
                                    <form action="{{ route('admin.bookings.approve', $booking->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn-approve">
                                        Setujui Pesanan
                                        </button>
                                    </form>
                                    <button type="button" class="btn-reject" id="openRejectModal">
                                        Tolak Pesanan
                                    </button>
                                </div>
                            @elseif($booking->status == 'dibayar')
                                <form action="{{ route('admin.bookings.selesai', $booking->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn-complete">
                                        Tandai Sewa Selesai
                                    </button>
                                </form>
                            @elseif($booking->status == 'disetujui')
                                <div class="info-alert">
                                    <i class='bx bx-info-circle'></i>
                                    <p>Pesanan telah disetujui. Menunggu customer melakukan pembayaran dan upload bukti.</p>
                                </div>
                            @else
                                <div class="info-muted">
                                    <p style="font-size: 14px;">Tidak ada tindakan yang diperlukan untuk status saat ini.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Reject -->
    @if($booking->status == 'pending')
        <div class="modal-overlay" id="rejectModal">
            <div class="modal-container">
                <div class="modal-header">
                    <h5 class="modal-title">Alasan Penolakan</h5>
                    <button type="button" class="modal-close" id="closeRejectModal">&times;</button>
                </div>
                <form action="{{ route('admin.bookings.reject', $booking->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <p class="modal-text">Berikan alasan yang jelas mengapa pesanan ini ditolak. Alasan ini akan terlihat
                            oleh customer.</p>
                        <textarea name="alasan_tolak" class="modal-textarea" rows="3"
                            placeholder="Contoh: Mobil sedang dalam perbaikan..." required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-cancel" id="cancelRejectModal">Batal</button>
                        <button type="submit" class="btn-confirm-reject">Tolak Sekarang</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            // Modal functionality
            const rejectModal = document.getElementById('rejectModal');
            const openModalBtn = document.getElementById('openRejectModal');
            const closeModalBtn = document.getElementById('closeRejectModal');
            const cancelModalBtn = document.getElementById('cancelRejectModal');

            if (openModalBtn) {
                openModalBtn.addEventListener('click', () => {
                    rejectModal.classList.add('active');
                });
            }

            const closeModal = () => {
                rejectModal.classList.remove('active');
            };

            if (closeModalBtn) closeModalBtn.addEventListener('click', closeModal);
            if (cancelModalBtn) cancelModalBtn.addEventListener('click', closeModal);

            // Close modal when clicking outside
            rejectModal.addEventListener('click', (e) => {
                if (e.target === rejectModal) {
                    closeModal();
                }
            });
        </script>
    @endif

@endsection