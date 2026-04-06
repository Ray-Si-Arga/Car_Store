@extends('layouts.landing_page')
@section('title', 'Mobil')
@section('content.landing')
    @include('components.alert')

    @php
        $hariIni = \Carbon\Carbon::now();
    @endphp

    <style>
        /* ===== CSS SAAS MODERN - BERSIH & EFISIEN ===== */
        :root {
            --saas-primary: #2f4b7c;
            --saas-primary-dark: #1f3a60;
            --saas-accent: #2ecc71;
            --saas-cream: #f6f1d1;
            --saas-white: #ffffff;
            --saas-gray-100: #f8f9fc;
            --saas-gray-200: #eef2f6;
            --saas-gray-300: #e2e8f0;
            --saas-gray-600: #5b6e8c;
            --saas-gray-800: #1e293b;
            --shadow-sm: 0 4px 12px rgba(0, 0, 0, 0.03), 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 10px 25px -5px rgba(47, 75, 124, 0.08), 0 8px 10px -6px rgba(0, 0, 0, 0.02);
            --shadow-lg: 0 20px 35px -12px rgba(47, 75, 124, 0.2);
        }

        /* Container Utama dengan padding agar tidak mepet */
        .landing-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem 2rem;
        }

        /* Grid System */
        .cars-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.75rem;
        }

        /* Car Card Modern */
        .car-card-saas {
            background: var(--saas-white);
            border-radius: 24px;
            overflow: hidden;
            transition: all 0.35s cubic-bezier(0.25, 0.8, 0.25, 1);
            border: 1px solid rgba(47, 75, 124, 0.08);
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
            box-shadow: var(--shadow-sm);
        }

        .car-card-saas:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
            border-color: rgba(47, 75, 124, 0.2);
        }

        /* Image Container - dengan border radius di atas */
        .card-img-saas {
            position: relative;
            width: 100%;
            aspect-ratio: 16/10;
            overflow: hidden;
            background: linear-gradient(135deg, var(--saas-gray-100) 0%, var(--saas-gray-200) 100%);
            border-radius: 24px 24px 0 0;
        }

        .car-img-saas {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
            cursor: pointer;
        }

        /* Kasta Badge */
        .kasta-badge-saas {
            position: absolute;
            top: 16px;
            right: 16px;
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
            color: var(--saas-primary);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            z-index: 2;
        }

        .kasta-badge-saas[data-kasta="Economy"] {
            color: #166534;
        }

        .kasta-badge-saas[data-kasta="Family"] {
            color: #92400e;
        }

        .kasta-badge-saas[data-kasta="Luxury"] {
            color: #4338ca;
        }

        /* Card Body */
        .card-body-saas {
            padding: 1.25rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        /* Car Title */
        .car-title-saas {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--saas-gray-800);
            margin-bottom: 0.25rem;
            line-height: 1.3;
        }

        .car-plat-saas {
            font-size: 0.7rem;
            color: var(--saas-gray-600);
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            background: var(--saas-gray-100);
            padding: 0.2rem 0.6rem;
            border-radius: 20px;
            width: fit-content;
        }

        .car-plat-saas strong {
            text-transform: uppercase;
        }

        /* Specs Row */
        .specs-row-saas {
            display: flex;
            gap: 1rem;
            margin: 1rem 0;
            padding: 0.75rem 0;
            border-top: 1px solid var(--saas-gray-200);
            border-bottom: 1px solid var(--saas-gray-200);
        }

        .spec-item-saas {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.75rem;
            color: var(--saas-gray-600);
        }

        .spec-item-saas i {
            font-size: 1rem;
            color: var(--saas-primary);
        }

        /* Price Section */
        .price-section-saas {
            margin-bottom: 1rem;
        }

        .price-label-saas {
            font-size: 0.7rem;
            color: var(--saas-gray-600);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.25rem;
        }

        .price-value-saas {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--saas-accent);
            line-height: 1;
        }

        .price-period-saas {
            font-size: 0.7rem;
            color: var(--saas-gray-600);
            font-weight: 400;
        }

        /* Button Rent */
        .btn-rent-saas {
            background: var(--saas-primary);
            color: white;
            border: none;
            padding: 0.85rem 1rem;
            border-radius: 14px;
            font-weight: 600;
            font-size: 0.85rem;
            width: 100%;
            transition: all 0.25s ease;
            text-align: center;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            cursor: pointer;
            margin-top: auto;
        }

        .btn-rent-saas:hover {
            background: var(--saas-primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(47, 75, 124, 0.25);
            color: white;
        }

        /* Empty State */
        .empty-state-saas {
            grid-column: 1 / -1;
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 28px;
            border: 1px solid var(--saas-gray-200);
        }

        .empty-state-saas i {
            font-size: 3rem;
            color: var(--saas-gray-300);
            margin-bottom: 1rem;
        }

        .empty-state-saas h4 {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--saas-primary);
            margin-bottom: 0.5rem;
        }

        .empty-state-saas p {
            color: var(--saas-gray-600);
        }

        /* Catatan */
        .note-catatan {
            display: block;
            background: #fff3e0;
            color: #e67e22;
            padding: 0.75rem 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            font-size: 0.8rem;
            text-align: center;
            border-left: 4px solid #e67e22;
        }

        /* Image Preview Modal */
        .modal-overlay {
            display: none;
            position: fixed;
            z-index: 10001;
            left: 0;
            top: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.85);
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(8px);
        }

        body.modal-open {
            overflow: hidden;
        }

        #imagePreviewModal .modal-content {
            background: transparent;
            padding: 0;
            border-radius: 0;
            box-shadow: none;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        #imagePreviewModal img {
            max-width: 95vw;
            max-height: 85vh;
            object-fit: contain;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
        }

        .close-preview {
            position: absolute;
            top: -40px;
            right: 0;
            font-size: 32px;
            color: white;
            cursor: pointer;
            transition: 0.2s;
        }

        .close-preview:hover {
            color: #ef4444;
        }

        /* Utility */
        .d-flex {
            display: flex;
        }

        .justify-content-between {
            justify-content: space-between;
        }

        .align-items-center {
            align-items: center;
        }

        .h-100 {
            height: 100%;
        }

        .text-center {
            text-align: center;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .landing-container {
                padding: 1.5rem;
            }

            .cars-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .landing-container {
                padding: 1rem;
            }

            .cars-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }

            .card-body-saas {
                padding: 1rem;
            }

            .car-title-saas {
                font-size: 0.95rem;
            }

            .price-value-saas {
                font-size: 1.2rem;
            }

            .btn-rent-saas {
                padding: 0.7rem;
                font-size: 0.75rem;
            }

            .specs-row-saas {
                gap: 0.75rem;
                margin: 0.75rem 0;
                padding: 0.5rem 0;
            }

            .spec-item-saas {
                font-size: 0.65rem;
            }
        }

        @media (max-width: 480px) {
            .landing-container {
                padding: 0.75rem;
            }

            .cars-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
        }
    </style>

    <div class="landing-container">
        <small class="note-catatan">
            <i class='bx bx-info-circle'></i> Catatan: Login Diperlukan Untuk Menyewa Mobil, Dan Harga Dapat Berubah Sesuai Hari Biasa / Weekend <i class='bx bx-info-circle'></i>
        </small>

        <div class="cars-grid">
            @forelse($cars as $car)
                <div class="car-card-saas">
                    <div class="card-img-saas">
                        @if($car->images->count() > 0)
                            <img src="{{ asset('storage/' . $car->images->first()->file_path) }}" class="car-img-saas"
                                alt="{{ $car->nama_mobil }}" onclick="openImagePreview(this.src)">
                        @else
                            <div class="d-flex align-items-center justify-content-center h-100">
                                <i class="bx bx-car fs-1 text-muted" style="opacity: 0.5;"></i>
                            </div>
                        @endif
                        <span class="kasta-badge-saas" data-kasta="{{ $car->kasta }}">
                            {{ $car->kasta }}
                        </span>
                    </div>

                    <div class="card-body-saas">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <h5 class="car-title-saas">{{ $car->nama_mobil }}</h5>
                                <span class="car-plat-saas">
                                    <i class="bx bx-car"></i> <strong>{{ $car->plat_nomor }}</strong>
                                </span>
                            </div>
                        </div>

                        <div class="specs-row-saas">
                            <div class="spec-item-saas">
                                <i class='bx bx-group'></i>
                                <span>{{ $car->penumpang }} Kursi</span>
                            </div>
                            <div class="spec-item-saas">
                                <i class="bx bx-petrol-pump"></i>
                                <span>{{ $car->bahan_bakar }}</span>
                            </div>
                            <div class="spec-item-saas">
                                <i class="bx bx-steering-wheel"></i>
                                <span>{{ $car->transmisi }}</span>
                            </div>
                        </div>

                        <div class="price-section-saas">
                            <div class="price-label-saas">Mulai dari</div>
                            <div>
                                <span class="price-value-saas">Rp {{ number_format($car->harga_aktif, 0, ',', '.') }}</span>
                                <span class="price-period-saas"> / hari</span>
                            </div>
                        </div>

                        <a href="{{ route('customer.booking.create', $car->id) }}" id="btn-rent-{{ $car->id }}"
                            class="btn-rent-saas" onclick="disableButton(this)">
                            Sewa Sekarang <i class='bx bx-chevron-right'></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="empty-state-saas">
                    <i class='bx bx-car'></i>
                    <h4>Belum ada mobil tersedia</h4>
                    <p>Silakan cek kembali nanti untuk katalog terbaru.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Modal Preview Gambar --}}
    <div id="imagePreviewModal" class="modal-overlay" onclick="closeImagePreview()">
        <div class="modal-content" onclick="event.stopPropagation()">
            <span class="close-preview" onclick="closeImagePreview()">&times;</span>
            <img id="previewImg" src="" alt="Preview">
        </div>
    </div>

    <script>
        function openImagePreview(src) {
            document.getElementById('previewImg').src = src;
            document.getElementById('imagePreviewModal').style.display = 'flex';
            document.body.classList.add('modal-open');
        }

        function closeImagePreview() {
            document.getElementById('imagePreviewModal').style.display = 'none';
            document.body.classList.remove('modal-open');
        }

        window.onclick = function (event) {
            const modal = document.getElementById('imagePreviewModal');
            if (event.target == modal) {
                closeImagePreview();
            }
        }


        function disableButton(element) {
            // Menambahkan class 'disabled' (untuk CSS)
            element.classList.add('disabled');
            // Mengubah kursor dan mencegah klik ulang secara logis
            element.style.pointerEvents = 'none';
            element.innerHTML = 'Memproses...';
        }

    </script>
@endsection