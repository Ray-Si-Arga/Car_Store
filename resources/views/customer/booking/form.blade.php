@extends('layouts.sidebar')

@section('title', 'Sewa Sekarang - ' . $car->nama_mobil)

@section('content')

    <style>
        :root {
            --saas-primary: #2f4b7c;
            --saas-primary-dark: #1f3a60;
            --saas-primary-light: #eef2ff;
            --saas-accent: #2ecc71;
            --saas-accent-dark: #27ae60;
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
        .booking-container {
            margin: 0 auto;
            padding: 1rem;
            background: white;
            border-radius: 20px;
        }

        /* Back Button */
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
            margin-bottom: 1.5rem;
        }

        .back-btn:hover {
            background: var(--saas-gray-50);
            transform: translateX(-4px);
            box-shadow: var(--shadow-sm);
        }

        /* Grid Layout */
        .booking-grid {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 2rem;
        }

        /* Card Wrapper - Pembungkus untuk kedua sisi */
        .card-wrapper {
            background: transparent;
            position: relative;
        }

        /* Card Styles */
        .card-saas {
            background: var(--saas-white);
            border-radius: 28px;
            border: 1px solid rgba(47, 75, 124, 0.08);
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-md);
            position: relative;
        }

        /* Decorative border gradient untuk card wrapper */
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

        .card-saas:hover {
            box-shadow: var(--shadow-xl);
        }

        /* Car Detail Card */
        .car-image-container {
            position: relative;
            width: 100%;
            height: 260px;
            overflow: hidden;
            background: linear-gradient(135deg, var(--saas-gray-100) 0%, var(--saas-gray-200) 100%);
        }

        .car-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .kasta-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            padding: 0.4rem 1rem;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
            border-radius: 40px;
            font-size: 0.7rem;
            font-weight: 700;
            color: var(--saas-primary);
            box-shadow: var(--shadow-sm);
        }

        /* Badge colors based on kasta */
        .kasta-badge[data-kasta="Economy"] {
            color: #166534;
        }

        .kasta-badge[data-kasta="Family"] {
            color: #92400e;
        }

        .kasta-badge[data-kasta="Luxury"] {
            color: #4338ca;
        }

        .car-detail-body {
            padding: 1.5rem;
        }

        .car-name {
            font-size: 1.35rem;
            font-weight: 800;
            color: var(--saas-gray-800);
            margin-bottom: 0.25rem;
        }

        .car-plate {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.7rem;
            color: var(--saas-gray-600);
            background: var(--saas-gray-100);
            padding: 0.25rem 0.75rem;
            border-radius: 30px;
        }

        .divider {
            height: 1px;
            background: linear-gradient(90deg, var(--saas-gray-200) 0%, transparent 130%);
            margin: 1.25rem 0;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 0.5rem;
        }

        .price-label {
            color: var(--saas-gray-600);
            font-size: 0.8rem;
        }

        .price-value {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--saas-accent);
        }

        .price-period {
            font-size: 0.7rem;
            font-weight: 400;
            color: var(--saas-gray-600);
        }

        .info-box {
            background: var(--saas-gray-50);
            border-radius: 20px;
            padding: 1rem;
            margin-top: 1rem;
            border: 1px solid var(--saas-gray-100);
        }

        .info-title {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--saas-primary);
            margin-bottom: 0.5rem;
        }

        .info-text {
            font-size: 0.7rem;
            color: var(--saas-gray-600);
            line-height: 1.5;
        }

        /* Form Styles */
        .form-card-body {
            padding: 2.5rem;
        }

        .section-title {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--saas-gray-800);
            border-left: 3px solid var(--saas-primary);
            padding-left: 0.75rem;
            margin-bottom: 1.25rem;
            margin-top: 0.5rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group-full {
            grid-column: span 2;
        }

        .form-label {
            display: block;
            font-size: 0.7rem;
            font-weight: 600;
            color: var(--saas-gray-700);
            margin-bottom: 0.4rem;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .input-wrapper {
            display: flex;
            align-items: center;
            border: 1px solid var(--saas-gray-200);
            border-radius: 14px;
            background: var(--saas-white);
            transition: all 0.2s ease;
            padding-left: 18px;
        }

        .input-wrapper:focus-within {
            border-color: var(--saas-primary);
            box-shadow: 0 0 0 3px rgba(47, 75, 124, 0.1);
        }

        .input-field {
            flex: 1;
            border: none;
            padding: 0.7rem 0.75rem 0.7rem 0;
            font-size: 0.9rem;
            font-family: inherit;
            background: transparent;
            outline: none;
            color: var(--saas-gray-800);
        }

        .input-field::placeholder {
            color: var(--saas-gray-300);
            font-size: 0.8rem;
        }

        textarea.input-field {
            padding: 0.7rem;
            resize: vertical;
            min-height: 80px;
        }

        .input-wrapper.textarea {
            align-items: flex-start;
        }

        /* Date Input */
        input[type="date"].input-field {
            padding-right: 0.75rem;
        }

        /* Error Feedback */
        .error-feedback {
            font-size: 0.65rem;
            color: #ef4444;
            margin-top: 0.25rem;
        }

        /* Total Card */
        .total-card {
            background: linear-gradient(135deg, var(--saas-primary) 0%, var(--saas-primary-dark) 100%);
            border-radius: 20px;
            padding: 1.25rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
        }

        .total-info {
            color: white;
        }

        .total-label {
            font-size: 0.7rem;
            opacity: 0.8;
            margin-bottom: 0.25rem;
        }

        .total-amount {
            font-size: 1.8rem;
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        .btn-submit {
            background: white;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 14px;
            font-weight: 700;
            font-size: 0.85rem;
            color: var(--saas-primary);
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        /* Responsive */
        @media (max-width: 968px) {
            .booking-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .booking-container {
                padding: 1rem;
            }

            .form-card-body {
                padding: 1.5rem;
            }
        }

        @media (max-width: 640px) {
            .form-grid {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .form-group-full {
                grid-column: span 1;
            }

            .total-card {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .total-amount {
                font-size: 1.5rem;
            }

            .car-image-container {
                height: 200px;
            }
        }
    </style>


    <!-- Page Header -->
    <x-page-header>
        <x-slot:title>Sewa Mobil {{ $car->nama_mobil }}</x-slot:title>
        <x-slot:subtitle>Isi formulir di bawah untuk memulai pemesanan</x-slot:subtitle>
    </x-page-header>

    <div class="booking-container">
        <!-- Main Grid -->
        <div class="booking-grid">
            <!-- Left: Car Detail Card dengan Wrapper -->
            <div class="card-wrapper">
                <div class="card-saas">
                    <div class="car-image-container">
                        @if($car->images->count() > 0)
                            <img src="{{ asset('storage/' . $car->images->first()->file_path) }}" class="car-image"
                                alt="{{ $car->nama_mobil }}">
                        @else
                            <div style="display: flex; align-items: center; justify-content: center; height: 100%;">
                                <i class='bx bx-car' style="font-size: 4rem; color: var(--saas-gray-300);"></i>
                            </div>
                        @endif
                        <span class="kasta-badge" data-kasta="{{ $car->kasta }}">
                            {{ $car->kasta }}
                        </span>
                    </div>
                    <div class="car-detail-body">
                        <h3 class="car-name">{{ $car->nama_mobil }}</h3>
                        <span class="car-plate" style="text-transform: uppercase">
                            <i class='bx bx-car'></i> {{ $car->plat_nomor }}
                        </span>

                        <div class="divider"></div>

                        <div class="price-row">
                            <span class="price-label">Harga Sewa</span>
                            <span class="price-value">
                                Rp {{ number_format($car->harga_aktif, 0, ',', '.') }}
                                <span class="price-period">/hari</span>
                            </span>
                        </div>

                        <div class="info-box">
                            <div class="info-title">
                                <i class='bx bx-info-circle'></i>
                                <span>Informasi Pembayaran</span>
                            </div>
                            <p class="info-text">
                                Pembayaran dilakukan <strong>setelah</strong> pesanan disetujui oleh admin.
                                Anda akan dihubungi via WhatsApp untuk konfirmasi lebih lanjut.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Booking Form dengan Wrapper -->
            <div class="card-wrapper">
                <div class="card-saas">
                    <div class="form-card-body">
                        <form action="{{ route('customer.booking.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="car_id" value="{{ $car->id }}">

                            <!-- Informasi Kontak -->
                            <div class="section-title">Informasi Kontak</div>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">Nomor Telepon (WhatsApp)</label>
                                    <div class="input-wrapper">
                                        <input type="text" name="no_telepon"
                                            class="input-field @error('no_telepon') is-invalid @enderror"
                                            placeholder="081234567890" value="{{ old('no_telepon') }}" required>
                                    </div>
                                    @error('no_telepon') <div class="error-feedback">{{ $message }}</div> @enderror
                                </div>

                                {{-- Lokasi --}}
                                <div class="form-group">
                                    <label class="form-label">Lokasi</label>
                                    <div class="input-wrapper">
                                        <input type="text" name="lokasi_customer"
                                            class="input-field @error('lokasi_customer') is-invalid @enderror"
                                            placeholder="Jl. Merdeka No. 10" value="{{ old('lokasi_customer') }}">
                                    </div>
                                    @error('lokasi_customer') <div class="error-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <!-- Jadwal Sewa -->
                            <div class="section-title" style="margin-top: 1.5rem;">Jadwal Sewa</div>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">Tanggal Mulai</label>
                                    <div class="input-wrapper">
                                        <input type="date" name="tanggal_mulai" id="tanggal_mulai"
                                            class="input-field @error('tanggal_mulai') is-invalid @enderror"
                                            value="{{ old('tanggal_mulai', date('Y-m-d')) }}" required>
                                    </div>
                                    @error('tanggal_mulai') <div class="error-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Tanggal Kembali</label>
                                    <div class="input-wrapper">
                                        <input type="date" name="tanggal_kembali" id="tanggal_kembali"
                                            class="input-field @error('tanggal_kembali') is-invalid @enderror"
                                            value="{{ old('tanggal_kembali', date('Y-m-d', strtotime('+1 day'))) }}"
                                            required>
                                    </div>
                                    @error('tanggal_kembali') <div class="error-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <!-- Catatan -->
                            <div class="form-group-full">
                                <label class="form-label">Catatan Untuk Admin (Opsional)</label>
                                <div class="input-wrapper textarea">
                                    <textarea name="catatan" class="input-field @error('catatan') is-invalid @enderror"
                                        rows="3"
                                        placeholder="Sebutkan jika ada permintaan khusus...">{{ old('catatan') }}</textarea>
                                </div>
                                @error('catatan') <div class="error-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Total & Submit -->
                            <div class="total-card">
                                <div class="total-info">
                                    <div class="total-label">Estimasi Total</div>
                                    <div class="total-amount" id="label_total">Rp -</div>
                                </div>
                                <button type="submit" class="btn-submit">
                                    Sewa Sekarang <i class='bx bx-chevron-right'></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tglSewa = document.getElementById('tanggal_mulai');
            const tglKembali = document.getElementById('tanggal_kembali');
            const labelTotal = document.getElementById('label_total');
            const hargaPerHari = {{ $car->harga_aktif }};

            function hitungTotal() {
                if (tglSewa.value && tglKembali.value) {
                    const start = new Date(tglSewa.value);
                    const end = new Date(tglKembali.value);
                    start.setHours(0, 0, 0, 0);
                    end.setHours(0, 0, 0, 0);

                    const diffTime = end - start;
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                    if (diffDays > 0) {
                        const total = diffDays * hargaPerHari;
                        labelTotal.innerText = 'Rp ' + total.toLocaleString('id-ID');
                    } else if (diffDays === 0) {
                        labelTotal.innerText = 'Rp ' + hargaPerHari.toLocaleString('id-ID');
                    } else {
                        labelTotal.innerText = 'Rp 0';
                    }
                }
            }

            tglSewa.addEventListener('change', hitungTotal);
            tglKembali.addEventListener('change', hitungTotal);
            hitungTotal();
        });
    </script>

@endsection