@extends('layouts.sidebar')

@section('title', 'Dashboard Customer | Sewa Mobil')

@section('content')
    <style>
        :root {
            --saas-primary: #2f4b7c;
            --saas-accent: #2ecc71;
            --saas-danger: #ef4444;
            --saas-warning: #f59e0b;
            --saas-bg: #f8fafc;
            --saas-white: #ffffff;
            --saas-border: rgba(47, 75, 124, 0.08);
            --saas-shadow: 0 10px 30px rgba(47, 75, 124, 0.05);
        }

        .dashboard-wrapper {
            padding: 0;
        }

        /* ── Summary Grid ── */
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        .stat-card {
            background: var(--saas-white);
            border-radius: 20px;
            padding: 1.25rem;
            border: 1px solid var(--saas-border);
            box-shadow: var(--saas-shadow);
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .icon-blue {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
        }

        .icon-orange {
            background: rgba(245, 158, 11, 0.1);
            color: var(--saas-warning);
        }

        .icon-green {
            background: rgba(46, 204, 113, 0.1);
            color: var(--saas-accent);
        }

        .stat-info h4 {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--saas-primary);
            margin: 0;
        }

        .stat-info p {
            font-size: 0.75rem;
            color: #64748b;
            margin: 0;
        }

        /* ── Rentals Section ── */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--saas-primary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .rentals-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.5rem;
        }

        .rental-card {
            background: var(--saas-white);
            border-radius: 24px;
            border: 1px solid var(--saas-border);
            overflow: hidden;
            transition: all 0.3s ease;
            position: relative;
        }

        .rental-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        }

        .card-img-wrapper {
            height: 180px;
            position: relative;
            background: #f1f5f9;
        }

        .card-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .status-overlay {
            position: absolute;
            top: 1rem;
            right: 1rem;
            padding: 0.4rem 1rem;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            backdrop-filter: blur(8px);
        }

        .status-ontime {
            background: rgba(46, 204, 113, 0.9);
            color: white;
        }

        .status-overdue {
            background: rgba(239, 68, 68, 0.9);
            color: white;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .card-body {
            padding: 1.5rem;
        }

        .car-name {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--saas-primary);
            margin-bottom: 0.25rem;
        }

        .car-plate {
            font-size: 0.75rem;
            color: #64748b;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .rental-timeline {
            background: #f8fafc;
            border-radius: 16px;
            padding: 1rem;
            margin-bottom: 1.25rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .timeline-item {
            text-align: center;
            flex: 1;
        }

        .time-label {
            font-size: 0.6rem;
            color: #94a3b8;
            text-transform: uppercase;
            margin-bottom: 0.25rem;
        }

        .time-value {
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--saas-primary);
        }

        .timeline-divider {
            color: #cbd5e1;
            font-size: 1.2rem;
        }

        .card-footer {
            padding: 1.25rem 1.5rem;
            background: #fcfcfc;
            border-top: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .est-label {
            font-size: 0.75rem;
            color: #64748b;
        }

        .est-value {
            font-size: 1rem;
            font-weight: 800;
        }

        .color-green {
            color: var(--saas-accent);
        }

        .color-red {
            color: var(--saas-danger);
        }

        .btn-detail {
            padding: 0.5rem 1rem;
            border-radius: 12px;
            background: var(--saas-primary);
            color: white;
            font-size: 0.8rem;
            font-weight: 600;
            text-decoration: none;
            transition: 0.2s;
        }

        .btn-detail:hover {
            background: #1f3a60;
            box-shadow: 0 4px 12px rgba(31, 58, 96, 0.2);
        }

        /* ── Empty State ── */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 24px;
            border: 2px dashed #e2e8f0;
        }

        .empty-icon {
            font-size: 4rem;
            color: #cbd5e1;
            margin-bottom: 1.5rem;
        }
    </style>

    <x-page-header>
        <x-slot:title>Halo {{ Auth::user()->name }}!</x-slot:title>
        <x-slot:subtitle>Pantau status penyewaan mobil Anda di sini.</x-slot:subtitle>
    </x-page-header>

    <div class="dashboard-wrapper">
        <!-- Summary Widgets -->
        <div class="summary-grid">
            <div class="stat-card">
                <div class="stat-icon icon-blue"><i class='bx bx-car'></i></div>
                <div class="stat-info">
                    <h4>{{ $activeBookings->count() }}</h4>
                    <p>Mobil Aktif</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon icon-orange"><i class='bx bx-timer'></i></div>
                <div class="stat-info">
                    <h4>{{ $activeBookings->where('is_overdue', true)->count() }}</h4>
                    <p>Status Terlambat</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon icon-green"><i class='bx bx-check-shield'></i></div>
                <div class="stat-info">
                    <h4>Aktif</h4>
                    <p>Status Akun</p>
                </div>
            </div>
        </div>

        <!-- Active Rentals -->
        <div class="section-header">
            <h5 class="section-title"><i class='bx bx-list-ul'></i> Aktivitas Penyewaan</h5>
        </div>

        @if($activeBookings->isEmpty())
            <div class="empty-state">
                <div class="empty-icon"><i class='bx bx-cloud-upload'></i></div>
                <h5 style="color: var(--saas-primary); font-weight: 800;">Belum Ada Mobil Aktif</h5>
                <p style="color: #64748b; font-size: 0.9rem;">Sepertinya Anda belum memiliki penyewaan yang sedang berjalan.</p>
                <a href="{{ route('cars') }}" class="btn-detail"
                    style="display: inline-block; margin-top: 1rem; padding: 0.8rem 1.5rem;">Cari Mobil Sekarang</a>
            </div>
        @else
            <div class="rentals-grid">
                @foreach($activeBookings as $booking)
                    <div class="rental-card">
                        <!-- Image & Status Overlay -->
                        <div class="card-img-wrapper">
                            @php
                                $carImage = $booking->car->images->first();
                            @endphp
                            @if($carImage)
                                <img src="{{ asset('storage/' . $carImage->file_path) }}" class="card-img" alt="Car Image">
                            @else
                                <div class="h-100 d-flex align-items-center justify-content-center bg-light">
                                    <i class='bx bx-image' style="font-size: 3rem; color: #cbd5e1;"></i>
                                </div>
                            @endif

                            @if($booking->is_overdue)
                                <div class="status-overlay status-overdue">Terlambat!</div>
                            @else
                                <div class="status-overlay status-ontime">Sedang Berjalan</div>
                            @endif
                        </div>

                        <!-- Details -->
                        <div class="card-body">
                            <h6 class="car-name">{{ $booking->car->nama_mobil }}</h6>
                            <div class="car-plate">{{ $booking->car->plat_nomor }}</div>

                            <div class="rental-timeline">
                                <div class="timeline-item">
                                    <div class="time-label">Mulai</div>
                                    <div class="time-value">{{ Carbon\Carbon::parse($booking->tanggal_mulai)->format('d M') }}</div>
                                </div>
                                <div class="timeline-divider"><i class='bx bx-chevron-right'></i></div>
                                <div class="timeline-item">
                                    <div class="time-label">Selesai</div>
                                    <div class="time-value">{{ Carbon\Carbon::parse($booking->tanggal_kembali)->format('d M') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Footer / Estimasi -->
                        <div class="card-footer">
                            <div>
                                @if($booking->is_overdue)
                                    <div class="est-label">Total Denda ({{ $booking->overdue_days }} Hari)</div>
                                    <div class="est-value color-red">
                                        Rp {{ number_format($booking->fine, 0, ',', '.') }}
                                    </div>
                                @else
                                    <div class="est-label">Estimasi Sisa Waktu</div>
                                    <div class="est-value color-green countdown-timer" id="timer-{{ $booking->id }}"
                                        data-deadline="{{ \Carbon\Carbon::parse($booking->tanggal_kembali)->format('Y-m-d H:i:s') }}">
                                        {{ \Carbon\Carbon::parse($booking->tanggal_kembali)->diffForHumans(null, true) }}
                                    </div>
                                @endif
                            </div>
                            <a href="{{ route('customer.riwayat') }}" class="btn-detail">Lihat Riwayat</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <script>
        function updateAllCountdowns() {
            const timers = document.querySelectorAll('.countdown-timer');

            timers.forEach(timer => {
                const deadlineAttr = timer.getAttribute('data-deadline');
                const deadline = new Date(deadlineAttr).getTime();
                const now = new Date().getTime();
                const distance = deadline - now;

                // Jika waktu sudah habis saat halaman dibuka
                if (distance < 0) {
                    timer.innerHTML = "Waktu Habis!";
                    timer.classList.replace('color-green', 'color-red');
                    return;
                }

                // Kalkulasi Matematika Waktu
                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Logika UX: Menyusun string secara hierarkis
                let parts = [];
                if (days > 0) parts.push(days + " Hari");
                if (hours > 0) parts.push(hours + " Jam");
                if (minutes > 0) parts.push(minutes + " Menit");
                if (seconds >= 0) parts.push(seconds + " Detik");

                // Menampilkan hasil (misal: "1 Hari 2 Jam 30 Menit 5 Detik Lagi")
                timer.innerHTML = parts.join(' ') + " Lagi";
            });
        }

        // Jalankan setiap 1 detik
        setInterval(updateAllCountdowns, 1000);

        // Panggil langsung saat pertama kali load
        updateAllCountdowns();
    </script>
@endsection