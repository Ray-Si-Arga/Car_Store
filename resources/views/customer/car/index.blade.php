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

        /* Blocking Profile */
        .locked-blur {
            filter: blur(15px);
            pointer-events: none;
            user-select: none;
        }

        .profile-blocking-container {
            position: relative;
            min-height: 400px;
        }

        .profile-blocking-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(2px);
            border-radius: 28px;
        }

        .blocking-card {
            background: white;
            padding: 3rem 2rem;
            border-radius: 24px;
            box-shadow: 0 20px 35px -12px rgba(47, 75, 124, 0.2);
            max-width: 500px;
            border: 1px solid var(--saas-gray-200);
        }

        .blocking-icon {
            font-size: 4rem;
            color: var(--saas-primary);
            margin-bottom: 1.5rem;
            display: inline-block;
            background: var(--saas-gray-100);
            width: 100px;
            height: 100px;
            line-height: 100px;
            border-radius: 50%;
        }

        .blocking-card h3 {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--saas-primary);
            margin-bottom: 1rem;
        }

        .blocking-card p {
            color: var(--saas-gray-600);
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .btn-complete-profile {
            background: var(--saas-accent);
            color: white;
            padding: 1rem 2rem;
            border-radius: 16px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
        }

        .btn-complete-profile:hover {
            background: #27ae60;
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(46, 204, 113, 0.3);
            color: white;
        }

        /* Modal Overlay for Profile */
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

        .modal-content {
            background-color: #fff;
            padding: 25px;
            border-radius: 12px;
            width: 100%;
            max-width: 500px;
            animation: fadeIn 0.3s ease;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .close-modal {
            font-size: 28px;
            cursor: pointer;
            color: #64748b;
        }

        .modal-footer {
            margin-top: 25px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn-save {
            background: var(--saas-primary);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-cancel-modal {
            background: #f1f5f9;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #475569;
            margin-bottom: 5px;
        }

        .form-control {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 14px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <div class="profile-blocking-container">
        @if(auth()->check() && !auth()->user()->isProfileComplete())
            <div class="profile-blocking-overlay" style="z-index: 9999;">
                <div class="blocking-card">
                    <div class="blocking-icon">
                        <i class='bx bx-lock-alt'></i>
                    </div>
                    <h3>Akses Terkunci</h3>
                    <p>Demi keamanan, mohon lengkapi data pertanggungjawaban (KTP & Foto Rumah) sebelum membooking armada
                        kami.
                    </p>
                    <button class="btn-complete-profile" onclick="openProfileModal()">
                        Lengkapi Profil Sekarang <i class='bx bx-edit-alt'></i>
                    </button>
                </div>
            </div>
        @endif

        <div class="cars-grid {{ (auth()->check() && !auth()->user()->isProfileComplete()) ? 'locked-blur' : '' }}">
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
                                    <i class="bx bx-car"></i> <strong
                                        style="text-transform: uppercase;">{{ $car->plat_nomor }}</strong>
                                </span>
                            </div>
                        </div>

                        <!-- Specs Info (opsional jika ada data tambahan) -->
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
                <div class="empty-state-saas" style="grid-column: 1/-1;">
                    <i class='bx bx-car bx-lg mb-3' style="font-size: 3rem; color: #cbd5e1;"></i>
                    <h4 class="fw-bold mb-2" style="font-weight: 700; font-size: 20px; color: #2f4b7c;">Belum ada mobil tersedia</h4>
                    <p class="text-muted mb-0" style="font-weight: 200; font-size: 18px;">Silakan cek kembali nanti untuk katalog terbaru.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Modal Lengkapi Profil --}}
    @if(!auth()->user()->isProfileComplete())
        <div id="profileCompletionModal" class="modal-overlay">
            <div class="modal-content" style="max-height: 90vh; overflow-y: auto; padding: 2rem;">
                <div class="modal-header">
                    <h3 style="font-weight: 800; color: var(--saas-primary);">Form Pertanggungjawaban</h3>
                    <span class="close-modal" onclick="closeProfileModal()">&times;</span>
                </div>

                @if ($errors->has('nama_orang_terdekat') || $errors->has('alamat_orang_terdekat') || $errors->has('no_telepon_terdekat') || $errors->has('foto_rumah') || $errors->has('ktp'))
                    <div
                        style="background: #fee2e2; color: #b91c1c; padding: 1rem; border-radius: 8px; margin-bottom: 1rem; font-size: 0.85rem;">
                        <ul style="margin: 0; padding-left: 1.25rem;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('customer.profile.complete') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group" style="margin-bottom: 1.5rem;">
                        <label style="font-weight: 600; color: var(--saas-gray-800);">Nama Orang Terdekat / Penjamin</label>
                        <input type="text" name="nama_orang_terdekat" class="form-control"
                            placeholder="Contoh: Orang Tua / Saudara Kandung" required>
                    </div>

                    <div class="form-group" style="margin-bottom: 1.5rem;">
                        <label style="font-weight: 600; color: var(--saas-gray-800);">Alamat Lengkap Penjamin</label>
                        <textarea name="alamat_orang_terdekat" class="form-control" rows="3"
                            placeholder="Alamat lengkap sesuai KTP" required></textarea>
                    </div>

                    <div class="form-group" style="margin-bottom: 1.5rem;">
                        <label style="font-weight: 600; color: var(--saas-gray-800);">Nomor Telepon Penjamin</label>
                        <input type="number" name="no_telepon_terdekat" class="form-control" placeholder="08xxxxxxxx" required>
                    </div>

                    <div class="form-group" style="margin-bottom: 1.5rem;">
                        <label style="font-weight: 600; color: var(--saas-gray-800);">Foto Rumah Tinggal</label>
                        <input type="file" name="foto_rumah" class="form-control" accept="image/*" required>
                        <small style="color: #64748b; font-size: 0.75rem;">Harap lampirkan foto tampak depan rumah
                            Anda.</small>
                    </div>

                    <div class="form-group" style="margin-bottom: 2rem;">
                        <label style="font-weight: 600; color: var(--saas-gray-800);">Foto KTP Asli</label>
                        <input type="file" name="ktp" class="form-control" accept="image/*" required>
                        <small style="color: #64748b; font-size: 0.75rem;">Foto KTP harus jelas dan terbaca.</small>
                    </div>

                    <div class="modal-footer" style="padding-top: 1rem; border-top: 1px solid var(--saas-gray-200);">
                        <button type="button" class="btn-cancel-modal" onclick="closeProfileModal()"
                            style="margin-right: 1rem;">Batal</button>
                        <button type="submit" class="btn-save" style="background: var(--saas-primary);">Simpan & Buka
                            Akses</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <script>
        // Auto open modal if validation errors exist 
        @if ($errors->has('nama_orang_terdekat') || $errors->has('alamat_orang_terdekat') || $errors->has('no_telepon_terdekat') || $errors->has('foto_rumah') || $errors->has('ktp'))
            window.addEventListener('DOMContentLoaded', (event) => {
                openProfileModal();
            });
        @endif

            function openProfileModal() {
                document.getElementById('profileCompletionModal').style.display = 'flex';
            }

        function closeProfileModal() {
            document.getElementById('profileCompletionModal').style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function (event) {
            const modal = document.getElementById('profileCompletionModal');
            if (event.target == modal) {
                closeProfileModal();
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