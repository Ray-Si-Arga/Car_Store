@php
    \Carbon\Carbon::setLocale('id');
    $hariIni = \Carbon\Carbon::now();
@endphp


@extends('layouts.sidebar')
@section('title', 'Admin | Armada Mobil')
@section('content')


    <style>
        /* Menggunakan CSS yang sama persis dengan UI Manajemen User kamu */
        .table-container {
            background: #fff;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border: 1px solid #eef0f5;
            margin-top: 20px;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .custom-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .custom-table th {
            background-color: #f8fafc;
            padding: 12px 15px;
            color: #64748b;
            text-transform: uppercase;
            font-size: 11px;
            font-weight: 600;
            border-bottom: 2px solid #edf2f7;
        }

        .custom-table td {
            padding: 15px;
            border-bottom: 1px solid #edf2f7;
            color: #334155;
            font-size: 14px;
        }

        .custom-table tbody tr:hover {
            background-color: #f1f5f9;
            transition: 0.2s;
        }

        .badge {
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 600;
        }

        /* Warna Badge Kasta & Status */
        .badge-luxury {
            background: #e0e7ff;
            color: #4338ca;
        }

        .badge-family {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-economy {
            background: #dcfce7;
            color: #166534;
        }

        .badge-status {
            background: #f1f5f9;
            color: #475569;
        }


        .btn-action {
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 18px;
            cursor: pointer;
            transition: 0.2s;
            border: none;
            display: inline-flex;
            align-items: center;
            text-decoration: none;
        }

        .btn-add {
            background: #635bff;
            color: white;
            padding: 10px 16px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            text-align: center;
            font-size: 14px;
            justify-content: center;
            align-items: center;
            display: inline-flex;
        }

        .btn-delete {
            color: #e11d48;
            background-color: #fff;
        }

        .btn-delete:hover {
            background-color: #e11d48;
            color: #fff;
        }

        .btn-edit {
            color: #635bff;
            background-color: #fff;
        }

        .btn-edit:hover {
            background-color: #635bff;
            color: #fff;
        }

        /* Modal CSS dari UI User kamu */
        .modal-overlay {
            display: none;
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: #fff;
            padding: 25px;
            border-radius: 12px;
            width: 100%;
            max-width: 600px;
            animation: fadeIn 0.3s ease;
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

        /* Global price */
        /* Menyamakan gaya tombol simpan dan batal di modal Harga Global */
        .btn-save-global {
            background: #635bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-cancel-global {
            background: #f1f5f9;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            color: #475569;
        }

        .close-modal {
            font-size: 28px;
            cursor: pointer;
            color: #64748b;
        }
    </style>

    <div class="header">
        <h2>Manajemen Armada</h2>
        <p style="color: #64748b; font-size: 14px;">Kelola unit kendaraan, kategori, dan harga sewa</p>
    </div>

    <div class="table-container">
        <div class="table-header">
            {{-- Grup Kiri: Judul dan Badge Informasi --}}
            <div style="display: flex; align-items: center; gap: 12px;">
                <h3 style="font-size: 18px; margin: 0;">Daftar Mobil</h3>

                @php
                    // Mengambil data mobil pertama untuk cek event global
                    $sampleCar = $cars->first();
                @endphp

                @if ($sampleCar && $sampleCar->event_aktif)
                    <div class="badge badge-luxury" style=" line-height: 1.2; padding: 6px 12px; border-radius: 8px;">
                        <span style="font-size: 12px;">Harga Naik Selama
                            <strong>'{{ $sampleCar->event_aktif->nama_event }}'</strong></span>
                        <span style="font-size: 12px; opacity: 0.8;">
                            Aktif Sampai
                            {{ \Carbon\Carbon::parse($sampleCar->event_aktif->end_date)->translatedFormat('d F Y') }}
                        </span>
                    </div>
                @elseif ($hariIni->isWeekend())
                    <div class="badge badge-family" style="padding: 6px 12px; border-radius: 8px;">
                        <i class="bx bx-calendar-star"></i> Harga Weekend Aktif
                    </div>
                @endif
            </div>

            {{-- Grup Kanan: Tombol-tombol Aksi --}}
            <div style="display: flex; gap: 12px;">

                <!-- Riwayat / Batal (Merah Soft) -->
                <a href="javascript:void(0)" onclick="openCancelModal()" class="btn-add" style="
                                            display:inline-flex;
                                            align-items:center;
                                            padding:8px 14px;
                                            border-radius:6px;
                                            font-weight:500;
                                            text-decoration:none;
                                            background:#fef2f2;
                                            color:#b91c1c;
                                            border:1px solid #fecaca;
                                            transition:0.2s;">
                    <i class="bx bx-history" style="font-size:15px;margin-right:6px;"></i>
                    Riwayat Event
                </a>

                <!-- Harga Event (Kuning Soft) -->
                <a href="javascript:void(0)" onclick="openGlobalPriceModal()" class="btn-add" style="
                                            display:inline-flex;
                                            align-items:center;
                                            padding:8px 14px;
                                            border-radius:6px;
                                            font-weight:500;
                                            text-decoration:none;
                                            background:#fef9c3;
                                            color:#92400e;
                                            border:1px solid #fde047;
                                            transition:0.2s;">
                    <i class="bx bx-dollar-circle" style="font-size:15px;margin-right:6px;"></i>
                    Harga Event
                </a>

                <!-- Tambah Mobil (Primary Biru) -->
                <a href="javascript:void(0)" onclick="openAddModal()" class="btn-add" style="
                                            display:inline-flex;
                                            align-items:center;
                                            padding:8px 14px;
                                            border-radius:6px;
                                            font-weight:500;
                                            text-decoration:none;
                                            background:#2563eb;
                                            color:#ffffff;
                                            border:1px solid #1e40af;
                                            transition:0.2s;">
                    <i class='bx bx-plus-circle' style="font-size:15px;margin-right:6px;"></i>
                    Tambah Armada
                </a>

            </div>
        </div>

        <table class="custom-table">
            <thead style="text-align: center;">
                <tr>
                    <th>Unit</th>
                    <th>Nama Mobil</th>
                    <th>Plat Mobil</th>
                    <th>Kelas</th>
                    <th>Harga (Hari Biasa & Weekend)</th>
                    <th>Harga (Yang Harus Dibayar)</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody style="text-align: center;">
                @foreach($cars as $car)
                    <tr>

                        {{-- Gambar --}}
                        <td>
                            @if($car->images->count() > 0)
                                <img src="{{ asset('storage/' . $car->images->where('is_primary', true)->first()->file_path) }}"
                                    style="width: 120px; height: 100px; object-fit: cover; border-radius: 8px;">
                            @endif
                        </td>

                        {{-- Nama mobil --}}
                        <td style="font-weight: 500;">{{ $car->nama_mobil }}</td>

                        {{-- Plat mobil --}}
                        <td style="font-weight: 500; text-transform: uppercase;">{{ $car->plat_nomor }}</td>

                        {{-- Kelas / Kasta Mobil --}}
                        <td>
                            <span class="badge badge-{{ strtolower($car->kasta) }}">
                                {{ strtoupper($car->kasta) }}
                            </span>
                        </td>

                        {{-- Harga Hari Biasa Dan Weekend --}}
                        <td>
                            <div style="font-size: 12px; color: #000003;">Biasa: Rp {{ number_format($car->harga_biasa) }}</div>
                            <div style="font-size: 12px; color: #000003;">Weekend: Rp {{ number_format($car->harga_weekend) }}
                            </div>
                        </td>

                        {{-- Tagihan / harga yang harus dibayar --}}
                        <td>
                            <div style="font-size: 12px; color: #635bff; font-weight: 600;">Tagihan Hari Ini:</div>
                            <div style="font-size: 14px; color: #635bff; font-weight: 800;">
                                Rp {{ number_format($car->harga_aktif, 0, ',', '.') }}
                            </div>
                            {{-- Indikator hari --}}
                            <span class="badge {{ $hariIni->isWeekend() ? 'badge-family' : 'badge-status' }}"
                                style="font-size: 9px;">
                                {{ $hariIni->translatedFormat('l') }}
                            </span>
                        </td>

                        {{-- Status --}}
                        <td>
                            <span class="badge badge-status">{{ strtoupper($car->status) }}</span>
                        </td>

                        {{-- Fungsi delete --}}
                        <td>
                            <div class="action-container" style="display: flex; gap: 5px; justify-content: center;">

                                <a href="javascript:void(0)" onclick="openEditModal()" class="btn-action btn-edit">
                                    <i class="bx bx-edit"></i>
                                </a>

                                <form action="{{ route('admin.car.delete', $car->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus mobil dan semua foto?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    {{-- ////////////////////////////// Batas \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ --}}


    {{-- Modal Tambah Mobil --}}
    <div id="addModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header"
                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                <h3 style="margin: 0;">Tambah Armada Baru</h3>
                <span style="font-size: 28px; cursor: pointer; color: #64748b;" onclick="closeAddModal()">&times;</span>
            </div>
            <form action="{{ route('admin.car.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div class="form-group">
                        <label>Nama Mobil</label>
                        <input type="text" name="nama_mobil" class="form-control" placeholder="Contoh: Honda HR-V" required>
                    </div>

                    <div class="form-group">
                        <label>Plat Mobil</label>
                        <input type="text" name="plat_nomor" style="text-transform: uppercase;" class="form-control"
                            placeholder="* **** **" required>
                    </div>

                    <div class="form-group">
                        <label>Kasta Mobil</label>
                        <select name="kasta" class="form-control">
                            <option value="Economy">ECONOMY</option>
                            <option value="Family">FAMILY</option>
                            <option value="Luxury">LUXURY</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="Tersedia">TERSEDIA</option>
                            <option value="Perbaikan">PERBAIKAN / MAINTENANCE </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Harga Biasa (Rp)</label>
                        <input type="text" id="h_biasa" class="form-control" placeholder="Contoh: 300.000" required>
                        <input type="hidden" name="harga_biasa" id="harga_biasa_asli">
                    </div>

                    <div class="form-group">
                        <label>Harga Weekend (Rp)</label>
                        <input type="text" id="h_weekend" class="form-control" placeholder="Contoh: 500.000">
                        <input type="hidden" name="harga_weekend" id="harga_weekend_asli">
                    </div>

                    <div class="form-group" style="grid-column: span 2;">
                        <label>Upload Foto (Maks. 4)</label>
                        <input type="file" name="fotos[]" class="form-control" multiple accept="image/*" required>
                    </div>
                </div>

                <div style="margin-top: 25px; display: flex; justify-content: flex-end; gap: 10px;">
                    <button type="submit"
                        style="background: #635bff; color: white; border: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; cursor: pointer;">Simpan
                        Armada</button>
                    <button type="button"
                        style="background: #f1f5f9; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer;"
                        onclick="closeAddModal()">Batal</button>
                </div>
            </form>
        </div>
    </div>


    {{-- Modal Edit Mobil --}}
    <div id="editModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header"
                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                <h3 style="margin: 0;">Edit Armada</h3>
                <span style="font-size: 28px; cursor: pointer; color: #64748b;" onclick="closeEditModal()">&times;</span>
            </div>
            <form action="{{ route('admin.car.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div class="form-group">
                        <label>Nama Mobil</label>
                        <input type="text" name="nama_mobil" class="form-control" placeholder="Contoh: Honda HR-V" required
                            value="{{ $car->nama_mobil }}">
                    </div>

                    <div class="form-group">
                        <label>Plat Mobil</label>
                        <input type="text" name="plat_nomor" style="text-transform: uppercase;" class="form-control"
                            placeholder="* **** **" required value="{{ $car->plat_nomor }}">
                    </div>

                    <div class="form-group">
                        <label>Kasta Mobil</label>
                        <select name="kasta" class="form-control" value="{{ $car->kasta }}">
                            <option value="Economy">ECONOMY</option>
                            <option value="Family">FAMILY</option>
                            <option value="Luxury">LUXURY</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" value="{{ $car->status }}">
                            <option value="Tersedia">TERSEDIA</option>
                            <option value="Perbaikan">PERBAIKAN / MAINTENANCE </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Harga Biasa (Rp)</label>
                        <input type="text" name="harga_biasa" id="h_biasa" class="form-control"
                            placeholder="Contoh: 300.000" required
                            value="{{ number_format($car->harga_biasa, 0, ',', '.') }}">
                    </div>

                    <div class="form-group">
                        <label>Harga Weekend (Rp)</label>
                        <input type="text" name="harga_weekend" id="h_weekend" class="form-control"
                            placeholder="Contoh: 500.000" value="{{ number_format($car->harga_weekend, 0, ',', '.') }}">
                    </div>

                    <div class="form-group" style="grid-column: span 2;">
                        <label>Foto Mobil</label>
                        <div style="border: 1px solid #ddd; border-radius: 8px; padding: 12px; background: #fafafa;">
                            @if ($car->images && $car->images->count() > 0)
                                <div style="display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 12px;">
                                    @foreach ($car->images as $img)
                                        <div style="position: relative;">
                                            <img src="{{ asset('storage/' . $img->file_path) }}"
                                                style="width: 90px; height: 70px; object-fit: cover; border-radius: 6px; border: 1px solid #e0e0e0;">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <input type="file" name="fotos[]" class="form-control" multiple accept="image/*">
                            <small style="color: #888; margin-top: 6px; display: block;">Kosongkan jika tidak ingin merubah
                                foto</small>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 25px; display: flex; justify-content: flex-end; gap: 10px;">
                    <button type="submit"
                        style="background: #635bff; color: white; border: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; cursor: pointer;">Simpan
                        Armada</button>
                    <button type="button"
                        style="background: #f1f5f9; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer;"
                        onclick="closeAddModal()">Batal</button>
                </div>
            </form>
        </div>
    </div>



    {{-- ////////////////////////////// Batas \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ --}}



    {{-- Modal Harga Global --}}
    <div id="globalPriceModal" class="modal-overlay">
        <div class="modal-content" style="max-width: 550px;">
            <div class="modal-header"
                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                <h3 style="margin: 0;">Pengaturan Harga Global</h3>
                <span class="close-modal" onclick="closeGlobalPriceModal()">&times;</span>
            </div>

            <form action="{{ route('admin.global-pricing.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Event / Musim Libur</label>
                    <input type="text" name="nama_event" class="form-control" placeholder="Contoh: Libur Natal & Tahun Baru"
                        required>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div class="form-group">
                        <label>Tanggal Mulai</label>
                        <input type="date" name="start_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Berakhir</label>
                        <input type="date" name="end_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Tipe Kenaikan</label>
                        <select name="type" id="tipe_kenaikan" class="form-control" onchange="toggleGlobalPriceFormat()">
                            <option value="percentage">PERSENTASE (%)</option>
                            <option value="nominal">NOMINAL (RP)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label id="label_nilai">Nilai (%)</label>
                        <input type="text" id="global_val_mask" class="form-control" placeholder="Contoh: 10" required>
                        <input type="hidden" name="value" id="global_val_asli">
                    </div>
                </div>

                <div style="margin-top: 25px; display: flex; justify-content: flex-end; gap: 10px;">
                    <button type="submit" class="btn-save-global">Aktifkan Harga Musim</button>
                    <button type="button" class="btn-cancel-global" onclick="closeGlobalPriceModal()">Batal</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Batalkan Harga Global --}}
    <div id="cancelGlobalModal" class="modal-overlay">
        <div class="modal-content" style="max-width: 700px;">
            <div class="modal-header"
                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                <h3 style="margin: 0;">Event Harga Global Aktif</h3>
                <span class="close-modal" onclick="closeCancelModal()">&times;</span>
            </div>

            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Event</th>
                            <th>Tanggal</th>
                            <th>Kenaikan</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($globalPricings as $gp)
                            <tr>
                                <td style="font-weight: 500;">{{ $gp->nama_event }}</td>
                                <td style="font-size: 12px;">{{ $gp->start_date }} - {{ $gp->end_date }}</td>
                                <td>
                                    <span class="badge badge-luxury">
                                        {{ $gp->type == 'percentage' ? $gp->value . '%' : 'Rp ' . number_format($gp->value) }}
                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    <form action="{{ route('admin.global-pricing.delete', $gp->id) }}" method="POST"
                                        onsubmit="return confirm('Batalkan event ini? Harga akan kembali normal.')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete"
                                            style="padding: 4px 8px; font-size: 14px;">
                                            <i class="bx bx-trash"></i> Batal
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align: center; padding: 20px; color: #94a3b8;">Tidak ada event
                                    aktif.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div style="margin-top: 25px; display: flex; justify-content: flex-end;">
                <button type="button" class="btn-cancel-global" onclick="closeCancelModal()">Tutup</button>
            </div>
        </div>
    </div>


    <script>
        // Fungsi Buka/Tutup Modal Tambah Mobil
        function openAddModal() {
            document.getElementById('addModal').style.display = 'flex';
        }

        function closeAddModal() {
            document.getElementById('addModal').style.display = 'none';
        }

        // Fungsi Edit Modal
        function openEditModal() {
            document.getElementById('editModal').style.display = 'flex';
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        // Logika auto-placeholder harga weekend
        const hb = document.getElementById('h_biasa');
        const hw = document.getElementById('h_weekend');
        hb.addEventListener('input', function () {
            hw.placeholder = "Auto: " + this.value;
        });

        window.onclick = function (event) {
            const modal = document.getElementById('addModal');
            if (event.target == modal) { closeAddModal(); }
        }

        // Fungsi pemformat angka ke format ribuan (titik)
        const formatRupiah = (angka) => {
            let number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            return split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        }

        const hb_mask = document.getElementById('h_biasa');
        const hb_asli = document.getElementById('harga_biasa_asli');
        const hw_mask = document.getElementById('h_weekend');
        const hw_asli = document.getElementById('harga_weekend_asli');

        // Input Harga Biasa
        hb_mask.addEventListener('keyup', function (e) {
            // 1. Format tampilan dengan titik
            this.value = formatRupiah(this.value);

            // 2. Simpan angka murni ke hidden input (untuk database)
            let angkaMurni = this.value.replace(/\./g, '');
            hb_asli.value = angkaMurni;

            // 3. LOGIKA PERBAIKAN: Update placeholder weekend secara sinkron
            if (this.value) {
                hw_mask.placeholder = "Auto: " + formatRupiah(angkaMurni);
            } else {
                hw_mask.placeholder = "Sama dengan harga biasa";
            }
        });

        // Input Harga Weekend (Manual)
        hw_mask.addEventListener('keyup', function (e) {
            this.value = formatRupiah(this.value);
            hw_asli.value = this.value.replace(/\./g, '');
        });


        // Harga global open modal
        function openGlobalPriceModal() {
            document.getElementById('globalPriceModal').style.display = 'flex';
        }

        function closeGlobalPriceModal() {
            document.getElementById('globalPriceModal').style.display = 'none';
        }

        function toggleGlobalPriceFormat() {
            const tipe = document.getElementById('tipe_kenaikan').value;
            const label = document.getElementById('label_nilai');
            const input = document.getElementById('global_val_mask');

            input.value = '';
            document.getElementById('global_val_asli').value = '';

            if (tipe === 'percentage') {
                label.innerText = 'Nilai (%)';
                input.placeholder = 'Contoh: 10';
            } else {
                label.innerText = 'Nilai (Rp)';
                input.placeholder = 'Contoh: 50.000';
            }
        }

        // Handler format ribuan khusus modal harga global
        document.getElementById('global_val_mask').addEventListener('keyup', function () {
            const tipe = document.getElementById('tipe_kenaikan').value;
            if (tipe === 'nominal') {
                this.value = formatRupiah(this.value); // Pastikan fungsi formatRupiah sudah ada
                document.getElementById('global_val_asli').value = this.value.replace(/\./g, '');
            } else {
                document.getElementById('global_val_asli').value = this.value;
            }

            window.onclick = function (event) {
                const addModal = document.getElementById('addModal');
                const globalModal = document.getElementById('globalPriceModal');

                if (event.target == addModal) {
                    closeAddModal();
                }
                if (event.target == globalModal) {
                    closeGlobalPriceModal();
                }
            }
        });

        // Fungsi Buka/Tutup Modal Pembatalan
        function openCancelModal() {
            document.getElementById('cancelGlobalModal').style.display = 'flex';
        }

        function closeCancelModal() {
            document.getElementById('cancelGlobalModal').style.display = 'none';
        }

        // Update Window Click Handler (Ganti yang lama dengan ini)
        window.onclick = function (event) {
            const addModal = document.getElementById('addModal');
            const globalModal = document.getElementById('globalPriceModal');
            const cancelModal = document.getElementById('cancelGlobalModal');

            if (event.target == addModal) { closeAddModal(); }
            if (event.target == globalModal) { closeGlobalPriceModal(); }
            if (event.target == cancelModal) { closeCancelModal(); }
        }
    </script>
@endsection