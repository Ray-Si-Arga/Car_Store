@extends('layouts.sidebar')
@section('title', 'Daftar Mobil')
@section('content')
    <x-page-header>
        <x-slot:title>Daftar Mobil</x-slot:title>
        <x-slot:subtitle>Pilih armada terbaik untuk perjalanan Anda</x-slot:subtitle>
    </x-page-header>

    <style>
        /* CSS Modern SaaS Style - Tanpa merusak logika */
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
        }

        .car-card-saas:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 35px -12px rgba(47, 75, 124, 0.2);
            border-color: rgba(47, 75, 124, 0.2);
        }

        /* Image Container */
        .card-img-saas {
            position: relative;
            width: 100%;
            aspect-ratio: 16/10;
            overflow: hidden;
            background: linear-gradient(135deg, var(--saas-gray-100) 0%, var(--saas-gray-200) 100%);
        }

        .car-img-saas {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .car-card-saas:hover .car-img-saas {
            transform: scale(1.05);
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

        /* Badge colors based on kasta */
        .kasta-badge-saas[data-kasta="Economy"] {
            background: #166534;
            color: white;
        }

        .kasta-badge-saas[data-kasta="Family"] {
            background: #92400e;
            color: white;
        }

        .kasta-badge-saas[data-kasta="Luxury"] {
            background: #4338ca;
            color: white;
        }

        /* Card Body */
        .card-body-saas {
            padding: 1.25rem 1.25rem 1.25rem 1.25rem;
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
            font-size: 0.8rem;
            color: var(--saas-gray-800);
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
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 28px;
            border: 1px solid var(--saas-gray-200);
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .cars-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 1.5rem;
            }
        }

        @media (max-width: 768px) {
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
            .cars-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
        }
    </style>

    <div class="cars-grid">
        @forelse($cars as $car)
            <div class="car-card-saas shadow-sm">
                <div class="card-img-saas">
                    @if($car->images->count() > 0)
                        <img src="{{ asset('storage/' . $car->images->first()->file_path) }}" class="car-img-saas"
                            alt="{{ $car->nama_mobil }}">
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
                                <i class="bx bx-car"></i> <strong style="text-transform: uppercase;">{{ $car->plat_nomor }}</strong>
                            </span>
                        </div>
                    </div>

                    <!-- Specs Info (opsional jika ada data tambahan) -->
                    <div class="specs-row-saas">
                        <div class="spec-item-saas">
                            <i class='bx bx-group'></i>
                            <span>{{ $car->kapasitas_penumpang ?? '4' }} Kursi</span>
                        </div>
                        <div class="spec-item-saas">
                            <i class='bx bx-briefcase-alt-2'></i>
                            <span>{{ $car->kapasitas_bagasi ?? '2' }} Bagasi</span>
                        </div>
                        <div class="spec-item-saas">
                            <i class='bx bx-fuel-pump'></i>
                            <span>{{ $car->jenis_bahan_bakar ?? 'Bensin' }}</span>
                        </div>
                    </div>

                    <div class="price-section-saas">
                        <div class="price-label-saas">Mulai dari</div>
                        <div>
                            <span class="price-value-saas">Rp {{ number_format($car->harga_aktif, 0, ',', '.') }}</span>
                            <span class="price-period-saas"> / hari</span>
                        </div>
                    </div>

                    <a href="{{ route('customer.booking.create', $car->id) }}" class="btn-rent-saas">
                        Sewa Sekarang <i class='bx bx-chevron-right'></i>
                    </a>
                </div>
            </div>
        @empty
            <div class="empty-state-saas" style="grid-column: 1/-1;">
                <i class='bx bx-car bx-lg mb-3' style="font-size: 3rem; color: #cbd5e1;"></i>
                <h4 class="fw-bold mb-2" style="color: #2f4b7c;">Belum ada mobil tersedia</h4>
                <p class="text-muted mb-0">Silakan cek kembali nanti untuk katalog terbaru.</p>
            </div>
        @endforelse
    </div>
@endsection