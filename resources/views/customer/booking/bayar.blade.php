@extends('layouts.sidebar')

@section('title', 'Upload Bukti Pembayaran')

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
        .upload-container {
            margin: 0 auto;
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

        .page-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--saas-gray-800);
            margin: 0;
        }

        /* Grid Layout */
        .upload-grid {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
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

        /* Gradient Card for Instructions */
        .gradient-card {
            background: linear-gradient(135deg, var(--saas-primary) 0%, var(--saas-primary-dark) 100%);
            color: white;
            margin-bottom: 1.5rem;
        }

        .gradient-card .card-body-custom {
            padding: 1.5rem;
        }

        .instruction-title {
            font-size: 0.9rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
        }

        .instruction-text {
            font-size: 0.75rem;
            opacity: 0.8;
            margin-bottom: 1.25rem;
        }

        /* Bank Account Box */
        .bank-box {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 1rem;
            margin-bottom: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.15);
            transition: all 0.2s ease;
        }

        .bank-box:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(4px);
        }

        .bank-name {
            font-size: 0.7rem;
            opacity: 0.7;
            margin-bottom: 0.25rem;
        }

        .bank-account {
            font-size: 1.1rem;
            font-weight: 800;
            margin-bottom: 0.25rem;
            letter-spacing: 0.5px;
        }

        .bank-owner {
            font-size: 0.7rem;
            opacity: 0.8;
            margin: 0;
        }

        /* Summary Card */
        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.75rem;
        }

        .summary-label {
            font-size: 0.75rem;
            color: var(--saas-gray-600);
        }

        .summary-value {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--saas-gray-800);
        }

        .divider-light {
            height: 1px;
            background: linear-gradient(90deg, var(--saas-gray-200) 0%, transparent 100%);
            margin: 1rem 0;
        }

        .total-amount {
            display: flex;
            justify-content: space-between;
            margin-top: 0.5rem;
        }

        .total-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--saas-gray-700);
        }

        .total-value {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--saas-accent);
        }

        /* Upload Form */
        .upload-icon-circle {
            width: 64px;
            height: 64px;
            background: rgba(47, 75, 124, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem auto;
        }

        .upload-icon-circle i {
            font-size: 2rem;
            color: var(--saas-primary);
        }

        .form-title {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--saas-gray-800);
            margin-bottom: 0.5rem;
            text-align: center;
        }

        .form-subtitle {
            font-size: 0.75rem;
            color: var(--saas-gray-600);
            text-align: center;
            margin-bottom: 1.5rem;
        }

        /* Upload Area */
        /* Upload Area - Perbaikan */
        .upload-area {
            width: 100%;
            padding: 2rem;
            border: 2px dashed var(--saas-gray-300);
            border-radius: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s ease;
            background: var(--saas-gray-50);
            display: block;
            position: relative;
        }

        .upload-area:hover {
            border-color: var(--saas-primary);
            background: var(--saas-gray-100);
        }

        /* Sembunyikan input file asli */
        .upload-area input[type="file"] {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            opacity: 0;
            cursor: pointer;
        }

        /* Placeholder konten */
        .upload-placeholder {
            pointer-events: none;
        }

        .upload-placeholder i {
            font-size: 3rem;
            color: var(--saas-gray-400);
            margin-bottom: 0.75rem;
        }

        .upload-placeholder p {
            font-size: 0.85rem;
            color: var(--saas-gray-600);
            margin-bottom: 0.25rem;
        }

        .upload-hint {
            font-size: 0.65rem;
            color: var(--saas-gray-400);
            margin-top: 0.5rem;
        }

        /* Image Preview */
        .image-preview {
            margin-bottom: 1rem;
            text-align: center;
        }

        .preview-img {
            max-width: 100%;
            max-height: 200px;
            border-radius: 16px;
            box-shadow: var(--shadow-md);
            border: 2px solid var(--saas-primary);
        }

        .d-none {
            display: none;
        }

        /* Submit Button */
        .btn-submit {
            width: 100%;
            background: var(--saas-primary);
            color: white;
            border: none;
            padding: 0.9rem;
            border-radius: 14px;
            font-weight: 700;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-submit:hover {
            background: var(--saas-primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        /* Error Feedback */
        .error-feedback {
            font-size: 0.7rem;
            color: var(--saas-danger);
            margin-top: 0.5rem;
            text-align: center;
        }

        /* Responsive */
        @media (max-width: 968px) {
            .upload-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .upload-container {
                padding: 1rem;
            }

            .page-title {
                font-size: 1.25rem;
            }
        }

        @media (max-width: 640px) {
            .card-body-custom {
                padding: 1.25rem;
            }

            .bank-account {
                font-size: 0.9rem;
            }

            .total-value {
                font-size: 1rem;
            }

            .upload-area {
                padding: 1.5rem;
            }
        }
    </style>

    <x-page-header>
        <x-slot:title>Upload Bukti Pembayaran</x-slot:title>
        <x-slot:subtitle>Pastikan foto bukti transfer terlihat jelas dan nominal sesuai.</x-slot:subtitle>
        <x-slot:back_url>{{ route('customer.riwayat') }}</x-slot:back_url>
    </x-page-header>


    <div class="upload-container">
        <!-- Main Grid -->
        <div class="upload-grid">
            <!-- Left Column: Instructions & Summary -->
            <div>
                <!-- Instruksi Pembayaran - Gradient Card -->
                <div class="card-wrapper mb-4">
                    <div class="card-saas gradient-card">
                        <div class="card-body-custom">
                            <h6 class="instruction-title">Instruksi Pembayaran</h6>
                            <p class="instruction-text">Silakan transfer sesuai nominal ke salah satu rekening di bawah ini:
                            </p>

                            <!-- Bank BCA -->
                            <div class="bank-box">
                                <p class="bank-name">Bank Central Asia (BCA)</p>
                                <h5 class="bank-account">1234 5678 90</h5>
                                <p class="bank-owner">A/N Sewa Mobil Arga</p>
                            </div>

                            <!-- Bank Mandiri -->
                            <div class="bank-box">
                                <p class="bank-name">Mandiri</p>
                                <h5 class="bank-account">9876 5432 10</h5>
                                <p class="bank-owner">A/N Sewa Mobil Arga</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ringkasan Pesanan -->
                <div class="card-wrapper">
                    <div class="card-saas">
                        <div class="card-body-custom">
                            <h6 class="instruction-title" style="color: var(--saas-gray-800); margin-bottom: 1rem;">
                                Ringkasan Pesanan</h6>

                            <div class="summary-item">
                                <span class="summary-label">Mobil</span>
                                <span class="summary-value">{{ $booking->car->nama_mobil }}</span>
                            </div>
                            <div class="summary-item">
                                <span class="summary-label">Durasi</span>
                                <span class="summary-value">{{ $booking->durasi_hari }} Hari</span>
                            </div>

                            <div class="divider-light"></div>

                            <div class="total-amount">
                                <span class="total-label">Total yang harus dibayar</span>
                                <span class="total-value">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Upload Form -->
            <div class="card-wrapper">
                <div class="card-saas">
                    <div class="card-body-custom">
                        <!-- Icon & Title -->
                        <div class="upload-icon-circle">
                            <i class="bxf bx-seal-check"></i>
                        </div>
                        <h5 class="form-title">Konfirmasi Pembayaran</h5>
                        <p class="form-subtitle">Pastikan foto bukti transfer terlihat jelas dan nominal sesuai.</p>

                        <form action="{{ route('customer.riwayat.upload', $booking->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <!-- Image Preview -->
                            <div id="image-preview" class="image-preview d-none">
                                <img src="" id="preview" class="preview-img" alt="Preview Bukti Bayar">
                            </div>

                            <!-- Upload Area -->
                            <label for="bukti_bayar" class="upload-area">
                                <input type="file" name="bukti_bayar" id="bukti_bayar" accept="image/*" required>
                                <div class="upload-placeholder" id="upload-placeholder">
                                    <i class="bxf bx-image-plus"></i>
                                    <p>Klik untuk pilih foto bukti bayar</p>
                                    <div class="upload-hint">Format: JPG, PNG, JPEG (Maks. 2MB)</div>
                                </div>
                            </label>
                            @error('bukti_bayar')
                                <div class="error-feedback">{{ $message }}</div>
                            @enderror

                            <!-- Submit Button -->
                            <button type="submit" class="btn-submit">
                                <i class='bx bx-send'></i> Kirim Sekarang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('bukti_bayar').onchange = function (evt) {
            const [file] = this.files;
            if (file) {
                const preview = document.getElementById('preview');
                const previewContainer = document.getElementById('image-preview');
                const placeholder = document.getElementById('upload-placeholder');
                const uploadArea = document.querySelector('.upload-area');

                preview.src = URL.createObjectURL(file);
                previewContainer.classList.remove('d-none');
                placeholder.classList.add('d-none');
                uploadArea.style.padding = '1rem';
            }
        }
    </script>

@endsection