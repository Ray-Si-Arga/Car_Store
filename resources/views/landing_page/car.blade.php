@extends('layouts.landing_page')
@section('title', 'Mobil')
@section('content.landing')
@include('components.alert')

    @php
        $hariIni = \Carbon\Carbon::now();
    @endphp

    <style>
        /* ===== Grid Layout (Elastis saat Zoom) ===== */
        .car-grid {
            display: grid;
            /* repeat(auto-fill) memastikan grid beradaptasi saat browser di-zoom */
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
            padding: 2vw;
            /* Menggunakan VW agar padding ikut mengecil saat zoom out */
        }

        /* ===== Card ===== */
        .car-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            display: flex;
            flex-direction: column;
        }

        .car-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }

        /* ===== Container Gambar (KUNCI GAMBAR MUNCUL) ===== */
        .card-image-container {
            width: 100%;
            aspect-ratio: 16 / 9;
            /* Memaksa kotak gambar punya ukuran tetap */
            overflow: hidden;
            position: relative;
            background: #f1f5f9;
        }

        .car-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Agar gambar tidak gepeng */
            display: block;
        }

        /* ===== Badge Melayang di Atas Gambar ===== */
        .floating-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(239, 68, 68, 0.9);
            /* Merah transparan */
            color: white;
            padding: 4px 12px;
            border-radius: 8px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            z-index: 2;
            backdrop-filter: blur(4px);
        }

        /* ===== Body & Typography ===== */
        .card-body {
            padding: 1.2rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .card-body h3 {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 4px;
        }

        .kasta {
            font-size: 0.8rem;
            color: #64748b;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* ===== Harga ===== */
        .price-section {
            margin-top: auto;
            /* Mendorong harga ke bawah jika judul pendek */
            display: flex;
            align-items: baseline;
            gap: 4px;
            margin-bottom: 12px;
        }

        .currency {
            font-size: 0.9rem;
            font-weight: 600;
            color: #0066ff;
        }

        .amount {
            font-size: 1.4rem;
            font-weight: 800;
            color: #0066ff;
        }

        .per-day {
            font-size: 0.8rem;
            color: #94a3b8;
        }

        /* ===== Badges (Di bawah Harga) ===== */
        .promo-badge,
        .weekend-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 8px;
            margin-bottom: 12px;
            width: fit-content;
        }

        .promo-badge {
            background: #fee2e2;
            color: #ef4444;
        }

        .weekend-badge {
            background: #fef9c3;
            color: #ca8a04;
        }

        .btn-book {
            display: block;
            width: 100%;
            padding: 10px;
            background: #0066ff;
            color: white;
            text-align: center;
            border-radius: 10px;
            font-weight: 500;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn-book:hover {
            background: #003f9e;
        }
    </style>

    <div class="car-grid">
        @foreach ($cars as $car)
            <div class="car-card">
                @php
                    // Pastikan relasi images sudah di-eager load di controller
                    $firstImage = $car->images->where('is_primary', true)->first() ?: $car->images->first();

                    if ($firstImage && !empty($firstImage->file_path)) {
                        // Pastikan path diawali dengan storage/
                        $imagePath = asset('storage/' . ltrim($firstImage->file_path, '/'));
                    } else {
                        $imagePath = asset('images/nofoto.jpg');
                    }
                @endphp

                <div class="card-image-container">
                    @if($car->event_aktif)
                        <div class="floating-badge">
                            <i class='bx bxs-zap'></i> {{ $car->event_aktif->nama_event }}
                        </div>
                    @endif

                    <img src="{{ $imagePath }}" alt="{{ $car->nama_mobil }}" class="car-img">
                </div>

                <div class="card-body">
                    <h3>{{ $car->nama_mobil }}</h3>
                    <p class="kasta">{{ $car->kasta }}</p>

                    <div class="price-section">
                        <span class="currency">Rp</span>
                        <span class="amount">{{ number_format($car->harga_aktif, 0, ',', '.') }}</span>
                        <span class="per-day">/ Hari</span>
                    </div>

                    @if($car->event_aktif)
                        <div class="promo-badge">
                            <i class='bx bxs-hot'></i> Event: {{ $car->event_aktif->nama_event }}
                        </div>
                    @elseif($hariIni->isWeekend())
                        <div class="weekend-badge">
                            <i class='bx bxs-calendar-check'></i> Harga Weekend
                        </div>
                    @endif

                    <small style="text-align: center; color: red; padding: 0 0 5px 0;">Login Diperlukan</small>
                    <a href="{{ route('customer.booking.create', $car->id) }}" class="btn-book">Sewa Sekarang</a>
                </div>
            </div>
        @endforeach
    </div>

@endsection