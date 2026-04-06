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
            flex-wrap: wrap;
            gap: 12px;
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
            text-align: center;
        }

        .custom-table td {
            padding: 15px;
            border-bottom: 1px solid #edf2f7;
            color: #334155;
            font-size: 14px;
            text-align: center;
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
            display: inline-block;
        }

        /* Warna Badge Kasta & Status */
        .badge-luxury {
            background: #5332c9;
            color: white;
        }

        .badge-family {
            background: #92400e;
            color: white;
        }

        .badge-economy {
            background: #166534;
            color: white;
        }

        .badge-status {
            background: #389cff;
            color: white;
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
            gap: 6px;
            transition: 0.2s;
        }

        .btn-add:hover {
            opacity: 0.9;
            transform: translateY(-1px);
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

        /* ========== MODAL STYLE BARU - LEBIH LEBAR & EFISIEN ========== */
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

        /* Modal Content - Lebih Lebar */
        .modal-content {
            background-color: #fff;
            border-radius: 20px;
            width: 100%;
            max-width: 900px;
            max-height: 85vh;
            overflow-y: auto;
            animation: fadeIn 0.3s ease;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        /* Custom scrollbar untuk modal */
        .modal-content::-webkit-scrollbar {
            width: 6px;
        }

        .modal-content::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .modal-content::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        /* Modal Header */
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 24px;
            border-bottom: 1px solid #eef2f6;
            background: #f8fafc;
            border-radius: 20px 20px 0 0;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .modal-header h3 {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
        }

        .close-modal {
            font-size: 28px;
            cursor: pointer;
            color: #94a3b8;
            transition: 0.2s;
            line-height: 1;
        }

        .close-modal:hover {
            color: #ef4444;
        }

        /* Modal Body */
        .modal-body {
            padding: 24px;
        }

        /* Form Grid - 2 Kolom yang rapi */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .form-group-full {
            grid-column: span 2;
        }

        .form-group {
            margin-bottom: 0;
        }

        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: #475569;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            font-size: 14px;
            transition: 0.2s;
            background: #fff;
        }

        .form-control:focus {
            outline: none;
            border-color: #635bff;
            box-shadow: 0 0 0 3px rgba(99, 91, 255, 0.1);
        }

        select.form-control {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3E%3Cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 20px;
        }

        /* Modal Footer */
        .modal-footer {
            padding: 16px 24px 24px;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            border-top: 1px solid #eef2f6;
            background: #fff;
            border-radius: 0 0 20px 20px;
        }

        /* Tombol */
        .btn-save {
            background: #635bff;
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-save:hover {
            background: #4f46e5;
            transform: translateY(-1px);
        }

        .btn-cancel {
            background: #f1f5f9;
            border: none;
            padding: 10px 24px;
            border-radius: 10px;
            cursor: pointer;
            color: #475569;
            font-weight: 500;
            transition: 0.2s;
        }

        .btn-cancel:hover {
            background: #e2e8f0;
        }

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

        /* Image Upload Area */
        .image-upload-area {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 16px;
            background: #fafcff;
        }

        .image-preview-list {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 16px;
        }

        .image-preview-item {
            position: relative;
        }

        .image-preview-item img {
            width: 80px;
            height: 70px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }

        /* Image Preview Modal */
        #imagePreviewModal .modal-content {
            background: transparent;
            padding: 0;
            border-radius: 0;
            box-shadow: none;
            display: flex;
            justify-content: center;
            align-items: center;
            max-width: none;
        }

        #imagePreviewModal img {
            max-width: 95vw;
            max-height: 85vh;
            object-fit: contain;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
        }

        /* Modal Kecil untuk Global Price */
        .modal-sm {
            max-width: 550px;
        }

        .modal-md {
            max-width: 700px;
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

        /* Responsive */
        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .form-group-full {
                grid-column: span 1;
            }

            .modal-content {
                max-width: 95%;
                margin: 16px;
            }

            .modal-header {
                padding: 16px 20px;
            }

            .modal-body {
                padding: 20px;
            }

            .table-container {
                overflow-x: auto;
            }

            .custom-table {
                min-width: 800px;
            }
        }

        .action-container {
            display: flex;
            gap: 5px;
            justify-content: center;
        }

        .info-badge {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .table-img {
            width: 120px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .table-img:hover {
            transform: scale(1.05);
        }
    </style>

    <x-page-header>
        <x-slot:title>Manajemen Armada</x-slot:title>
        <x-slot:subtitle>Kelola Unit Kendaraan</x-slot:subtitle>
    </x-page-header>

    <div class="table-container">
        <div class="table-header">
            <div class="info-badge">
                <h3 style="font-size: 18px; margin: 0;">Daftar Mobil</h3>
                @php $sampleCar = $cars->first(); @endphp
                @if ($sampleCar && $sampleCar->event_aktif)
                    <div class="badge badge-luxury" style="padding: 6px 12px; border-radius: 8px;">
                        <span style="font-size: 12px;">Diskon Harga
                            <strong>'{{ $sampleCar->event_aktif->nama_event }}'</strong></span>
                        <span style="font-size: 12px; opacity: 0.8;">Aktif Sampai
                            {{ \Carbon\Carbon::parse($sampleCar->event_aktif->end_date)->translatedFormat('d F Y') }}</span>
                    </div>
                @elseif ($hariIni->isWeekend())
                    <div class="badge badge-luxury" style="padding: 6px 12px; border-radius: 8px;">Harga Weekend Aktif</div>
                @endif
            </div>

            <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                <a href="javascript:void(0)" onclick="openCancelModal()" class="btn-add"
                    style="background:#fef2f2; color:#b91c1c; border:1px solid #fecaca;">
                    <i class="bx bx-history"></i> Riwayat Event
                </a>
                <a href="javascript:void(0)" onclick="openGlobalPriceModal()" class="btn-add"
                    style="background:#fef9c3; color:#92400e; border:1px solid #fde047;">
                    <i class="bx bx-dollar-circle"></i> Harga Event
                </a>
                <a href="javascript:void(0)" onclick="openAddModal()" class="btn-add">
                    <i class='bx bx-plus-circle'></i> Tambah Armada
                </a>
            </div>
        </div>

        <table class="custom-table">
            <thead>
                <tr>
                    <th>Unit</th>
                    <th>Nama Mobil</th>
                    <th>Plat Mobil</th>
                    <th>Penumpang</th>
                    <th>Transmisi</th>
                    <th>Bahan Bakar</th>
                    <th>Kelas</th>
                    <th>Harga (Hari Biasa & Weekend)</th>
                    <th>Harga (Yang Harus Dibayar)</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cars as $car)
                    <tr>
                        <td>
                            @if($car->images->count() > 0)
                                <img src="{{ asset('storage/' . $car->images->where('is_primary', true)->first()->file_path) }}"
                                    loading="Lazy" class="table-img" onclick="openImagePreview(this.src)"
                                    title="Klik untuk memperbesar">
                            @endif
                        </td>
                        <td style="font-weight: 600;">{{ $car->nama_mobil }}</td>
                        <td style="font-weight: 600; text-transform: uppercase;">{{ $car->plat_nomor }}</td>
                        <td>{{ $car->penumpang }}</td>
                        <td>{{ $car->transmisi }}</td>
                        <td>{{ $car->bahan_bakar }}</td>
                        <td><span class="badge badge-{{ strtolower($car->kasta) }}">{{ strtoupper($car->kasta) }}</span></td>
                        <td>
                            <div style="font-weight: 600; font-size: 12px;">Biasa: Rp
                                {{ number_format($car->harga_biasa, 0, ',', '.') }}
                            </div>
                            <div style="font-weight: 600; font-size: 12px;">Weekend: Rp
                                {{ number_format($car->harga_weekend, 0, ',', '.') }}
                            </div>
                        </td>
                        <td>
                            <div style="font-size: 12px; color: #635bff; font-weight: 600;">Tagihan Hari Ini:
                                <strong>{{ $hariIni->translatedFormat('l') }}</strong>
                            </div>
                            <div style="font-size: 14px; color: #635bff; font-weight: 800;">Rp
                                {{ number_format($car->harga_aktif, 0, ',', '.') }}
                            </div>
                        </td>
                        <td><span class="badge badge-status">{{ strtoupper($car->status) }}</span></td>
                        <td>
                            <div class="action-container">
                                <a href="javascript:void(0)" onclick="openEditModal({{ json_encode($car) }})"
                                    class="btn-action btn-edit"><i class="bx bx-edit"></i></a>
                                <form action="{{ route('admin.car.delete', $car->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus mobil dan semua foto?')" style="display: inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete"><i class="bx bx-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" style="text-align: center; padding: 50px;">
                            <div style="display: flex; flex-direction: column; align-items: center; gap: 10px; color: #94a3b8;">
                                <i class='bx bx-car' style="font-size: 3rem;"></i>
                                <div style="font-weight: 700; color: #334155;">Belum ada mobil yang tersedia</div>
                                <div style="font-size: 0.85rem;">Silakan tambahkan armada baru untuk mulai menyewakan.</div>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ========== MODAL TAMBAH MOBIL - LEBIH LEBAR ========== --}}
    <div id="addModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class='bx bx-plus-circle' style="margin-right: 8px;"></i> Tambah Armada Baru</h3>
                <span class="close-modal" onclick="closeAddModal()">&times;</span>
            </div>
            <form action="{{ route('admin.car.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-grid">
                        <div class="form-group"><label>Nama Mobil</label><input type="text" name="nama_mobil"
                                class="form-control" placeholder="Contoh: Honda HR-V" required></div>
                        <div class="form-group"><label>Plat Mobil</label><input type="text" name="plat_nomor"
                                style="text-transform: uppercase;" class="form-control" placeholder="B 1234 AB" required>
                        </div>
                        <div class="form-group"><label>Penumpang</label><input type="number" name="penumpang"
                                class="form-control" placeholder="5" required></div>
                        <div class="form-group"><label>Transmisi</label><select name="transmisi" class="form-control">
                                <option value="Matic">Matic</option>
                                <option value="Manual">Manual</option>
                            </select></div>
                        <div class="form-group"><label>Bahan Bakar</label><select name="bahan_bakar" class="form-control">
                                <option value="Gasoline">Gasoline</option>
                                <option value="Listrik">Listrik</option>
                                <option value="Diesel">Diesel</option>
                            </select>
                        </div>

                        <div class="form-group"><label>Kasta Mobil</label><select name="kasta" class="form-control">
                                <option value="Economy">ECONOMY</option>
                                <option value="Family">FAMILY</option>
                                <option value="Luxury">LUXURY</option>
                            </select></div>
                        <div class="form-group"><label>Status</label><select name="status" class="form-control">
                                <option value="Tersedia">TERSEDIA</option>
                                <option value="Perbaikan">PERBAIKAN / MAINTENANCE</option>
                            </select>
                        </div>
                        <div class="form-group"><label>Harga Biasa (Rp)</label><input type="text" id="h_biasa"
                                class="form-control" placeholder="Contoh: 300000" required><input type="hidden"
                                name="harga_biasa" id="harga_biasa_asli">
                        </div>
                        <div class="form-group"><label>Harga Weekend (Rp)</label><input type="text" id="h_weekend"
                                class="form-control" placeholder="Kosong = sama dengan biasa"><input type="hidden"
                                name="harga_weekend" id="harga_weekend_asli">
                        </div>
                        <div class="form-group-full"><label>Upload Foto</label><input type="file" name="fotos[]"
                                class="form-control" multiple accept="image/*" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeAddModal()">Batal</button>
                    <button type="submit" class="btn-save">Simpan Armada</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ========== MODAL EDIT MOBIL - LEBIH LEBAR ========== --}}
    <div id="editModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class='bx bx-edit' style="margin-right: 8px;"></i> Edit Armada</h3>
                <span class="close-modal" onclick="closeEditModal()">&times;</span>
            </div>
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="modal-body">
                    <div class="form-grid">
                        <div class="form-group"><label>Nama Mobil</label><input type="text" name="nama_mobil"
                                id="edit_nama_mobil" class="form-control" required></div>
                        <div class="form-group"><label>Plat Mobil</label><input type="text" name="plat_nomor"
                                id="edit_plat_nomor" style="text-transform: uppercase;" class="form-control" required></div>
                        <div class="form-group"><label>Penumpang</label><input type="number" name="penumpang"
                                id="edit_penumpang" class="form-control" required></div>
                        <div class="form-group"><label>Transmisi</label><select name="transmisi" id="edit_transmisi"
                                class="form-control">
                                <option value="Matic">Matic</option>
                                <option value="Manual">Manual</option>
                            </select>
                        </div>
                        <div class="form-group"><label>Bahan Bakar</label><select name="bahan_bakar" id="edit_bahan_bakar"
                                class="form-control">
                                <option value="Gasoline">Gasoline</option>
                                <option value="Listrik">Listrik</option>
                                <option value="Diesel">Diesel</option>
                            </select>
                        </div>

                        <div class="form-group"><label>Kasta Mobil</label><select name="kasta" id="edit_kasta"
                                class="form-control">
                                <option value="Economy">ECONOMY</option>
                                <option value="Family">FAMILY</option>
                                <option value="Luxury">LUXURY</option>
                            </select>
                        </div>
                        <div class="form-group"><label>Status</label><select name="status" id="edit_status"
                                class="form-control">
                                <option value="Tersedia">TERSEDIA</option>
                                <option value="Disewa">DISEWA</option>
                                <option value="Perbaikan">PERBAIKAN</option>
                            </select>
                        </div>
                        <div class="form-group"><label>Harga Biasa (Rp)</label><input type="text" id="edit_harga_biasa_mask"
                                class="form-control" required><input type="hidden" name="harga_biasa"
                                id="edit_harga_biasa_asli"></div>
                        <div class="form-group"><label>Harga Weekend (Rp)</label>
                            <input type="text" id="edit_harga_weekend_mask" class="form-control"
                                placeholder="Auto: Jika kosong"><input type="hidden" name="harga_weekend"
                                id="edit_harga_weekend_asli">
                        </div>
                        <div class="form-group-full">
                            <label style="display: block;
                    font-size: 12px;
                    font-weight: 600;
                    color: #475569;
                    margin-bottom: 6px;
                    text-transform: uppercase;
                    letter-spacing: 0.3px;">Foto Mobil</label>
                            <div class="image-upload-area">
                                <div id="edit_image_container" class="image-preview-list"></div>
                                <input type="file" name="fotos[]" class="form-control" multiple accept="image/*">
                                <small style="color: #888; margin-top: 8px; display: block;">Kosongkan jika tidak ingin
                                    merubah foto</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeEditModal()">Batal</button>
                    <button type="submit" class="btn-save">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ========== MODAL HARGA GLOBAL ========== --}}
    <div id="globalPriceModal" class="modal-overlay">
        <div class="modal-content modal-sm">
            <div class="modal-header">
                <h3><i class='bx bx-dollar-circle' style="margin-right: 8px;"></i> Pengaturan Harga Global</h3>
                <span class="close-modal" onclick="closeGlobalPriceModal()">&times;</span>
            </div>
            <form action="{{ route('admin.global-pricing.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group"><label>Nama Event / Musim Libur</label><input type="text" name="nama_event"
                            class="form-control" placeholder="Contoh: Libur Natal & Tahun Baru" required></div>
                    <div class="form-grid">
                        <div class="form-group"><label>Tanggal Mulai</label><input type="date" name="start_date"
                                class="form-control" required></div>
                        <div class="form-group"><label>Tanggal Berakhir</label><input type="date" name="end_date"
                                class="form-control" required></div>
                        <div class="form-group"><label>Tipe Potongan</label><select name="type" id="tipe_kenaikan"
                                class="form-control" onchange="toggleGlobalPriceFormat()">
                                <option value="nominal">NOMINAL (RP)</option>
                            </select></div>
                        <div class="form-group"><label id="label_nilai">Besar Potongan</label><input type="text"
                                id="global_val_mask" class="form-control" placeholder="Contoh: 120000" required><input
                                type="hidden" name="value" id="global_val_asli"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeGlobalPriceModal()">Batal</button>
                    <button type="submit" class="btn-save">Aktifkan Harga Musim</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ========== MODAL RIWAYAT EVENT ========== --}}
    <div id="cancelGlobalModal" class="modal-overlay">
        <div class="modal-content modal-md">
            <div class="modal-header">
                <h3><i class='bx bx-history' style="margin-right: 8px;"></i> Event Harga Global Aktif</h3>
                <span class="close-modal" onclick="closeCancelModal()">&times;</span>
            </div>
            <div class="modal-body">
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
                                    <td><span
                                            class="badge badge-luxury">{{ $gp->type == 'percentage' ? $gp->value . '%' : 'Rp ' . number_format($gp->value) }}</span>
                                    </td>
                                    <td style="text-align: center;">
                                        <form action="{{ route('admin.global-pricing.delete', $gp->id) }}" method="POST"
                                            onsubmit="return confirm('Batalkan event ini? Harga akan kembali normal.')"
                                            style="display: inline;">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete"
                                                style="padding: 4px 8px; font-size: 14px;">Batal</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="text-align: center; padding: 30px; color: #94a3b8;">Tidak ada event
                                        aktif.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeCancelModal()">Tutup</button>
            </div>
        </div>
    </div>

    {{-- ========== MODAL PREVIEW GAMBAR ========== --}}
    <div id="imagePreviewModal" class="modal-overlay" onclick="closeImagePreview()">
        <div class="modal-content" onclick="event.stopPropagation()">
            <img id="previewImg" src="" alt="Preview">
        </div>
    </div>

    <script>
        // Fungsi Buka/Tutup Modal Tambah Mobil
        function openAddModal() { document.getElementById('addModal').style.display = 'flex'; document.body.classList.add('modal-open'); }
        function closeAddModal() { document.getElementById('addModal').style.display = 'none'; document.body.classList.remove('modal-open'); }

        // Fungsi Edit Modal
        function openEditModal(car) {
            document.getElementById('edit_nama_mobil').value = car.nama_mobil;
            document.getElementById('edit_plat_nomor').value = car.plat_nomor;
            document.getElementById('edit_kasta').value = car.kasta;
            document.getElementById('edit_status').value = car.status;
            document.getElementById('edit_penumpang').value = car.penumpang;
            document.getElementById('edit_transmisi').value = car.transmisi;
            document.getElementById('edit_bahan_bakar').value = car.bahan_bakar;


            document.getElementById('edit_harga_biasa_mask').value = formatRupiah(car.harga_biasa.toString());
            document.getElementById('edit_harga_biasa_asli').value = car.harga_biasa;

            if (car.harga_weekend) {
                document.getElementById('edit_harga_weekend_mask').value = formatRupiah(car.harga_weekend.toString());
                document.getElementById('edit_harga_weekend_asli').value = car.harga_weekend;
            } else {
                document.getElementById('edit_harga_weekend_mask').value = '';
                document.getElementById('edit_harga_weekend_asli').value = '';
            }

            const container = document.getElementById('edit_image_container');
            container.innerHTML = '';
            if (car.images && car.images.length > 0) {
                car.images.forEach(img => {
                    const div = document.createElement('div');
                    div.className = 'image-preview-item';
                    div.innerHTML = `<img src="/storage/${img.file_path}">`;
                    container.appendChild(div);
                });
            }

            document.getElementById('editForm').action = `/admin/car/update/${car.id}`;
            document.getElementById('editModal').style.display = 'flex';
            document.body.classList.add('modal-open');
        }

        function closeEditModal() { document.getElementById('editModal').style.display = 'none'; document.body.classList.remove('modal-open'); }

        // Format Rupiah
        const formatRupiah = (angka) => {
            if (!angka) return '';
            let number_string = angka.toString().replace(/[^,\d]/g, ''),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);
            if (ribuan) { let separator = sisa ? '.' : ''; rupiah += separator + ribuan.join('.'); }
            return split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        }

        // Masking Modal Tambah
        const hb_mask = document.getElementById('h_biasa'), hb_asli = document.getElementById('harga_biasa_asli');
        const hw_mask = document.getElementById('h_weekend'), hw_asli = document.getElementById('harga_weekend_asli');
        if (hb_mask) {
            hb_mask.addEventListener('keyup', function () {
                this.value = formatRupiah(this.value);
                let angkaMurni = this.value.replace(/\./g, '');
                hb_asli.value = angkaMurni;
                hw_mask.placeholder = this.value ? "Auto: " + formatRupiah(angkaMurni) : "Sama dengan harga biasa";
            });
            hw_mask.addEventListener('keyup', function () {
                this.value = formatRupiah(this.value);
                hw_asli.value = this.value.replace(/\./g, '');
            });
        }

        // Masking Modal Edit
        const ehb_mask = document.getElementById('edit_harga_biasa_mask'), ehb_asli = document.getElementById('edit_harga_biasa_asli');
        const ehw_mask = document.getElementById('edit_harga_weekend_mask'), ehw_asli = document.getElementById('edit_harga_weekend_asli');
        if (ehb_mask) {
            ehb_mask.addEventListener('keyup', function () {
                this.value = formatRupiah(this.value);
                let angkaMurni = this.value.replace(/\./g, '');
                ehb_asli.value = angkaMurni;
                ehw_mask.placeholder = this.value ? "Auto: " + formatRupiah(angkaMurni) : "Sama dengan harga biasa";
            });
            ehw_mask.addEventListener('keyup', function () {
                this.value = formatRupiah(this.value);
                ehw_asli.value = this.value.replace(/\./g, '');
            });
        }

        // Harga Global
        function openGlobalPriceModal() { document.getElementById('globalPriceModal').style.display = 'flex'; document.body.classList.add('modal-open'); }
        function closeGlobalPriceModal() { document.getElementById('globalPriceModal').style.display = 'none'; document.body.classList.remove('modal-open'); }

        function toggleGlobalPriceFormat() {
            const tipe = document.getElementById('tipe_kenaikan').value;
            const label = document.getElementById('label_nilai');
            const input = document.getElementById('global_val_mask');
            input.value = '';
            document.getElementById('global_val_asli').value = '';
            if (tipe === 'percentage') { label.innerText = 'Besar Potongan (%)'; input.placeholder = 'Contoh: 10'; }
            else { label.innerText = 'Besar Potongan (Rp)'; input.placeholder = 'Contoh: 50000'; }
        }

        const globalMask = document.getElementById('global_val_mask');
        if (globalMask) {
            globalMask.addEventListener('keyup', function () {
                const tipe = document.getElementById('tipe_kenaikan').value;
                if (tipe === 'nominal') { this.value = formatRupiah(this.value); document.getElementById('global_val_asli').value = this.value.replace(/\./g, ''); }
                else { document.getElementById('global_val_asli').value = this.value; }
            });
        }

        // Modal Riwayat Event
        function openCancelModal() { document.getElementById('cancelGlobalModal').style.display = 'flex'; document.body.classList.add('modal-open'); }
        function closeCancelModal() { document.getElementById('cancelGlobalModal').style.display = 'none'; document.body.classList.remove('modal-open'); }

        // Preview Gambar
        function openImagePreview(src) { document.getElementById('previewImg').src = src; document.getElementById('imagePreviewModal').style.display = 'flex'; document.body.classList.add('modal-open'); }
        function closeImagePreview() { document.getElementById('imagePreviewModal').style.display = 'none'; document.body.classList.remove('modal-open'); }

        // Window Click Handler
        window.onclick = function (event) {
            if (event.target == document.getElementById('addModal')) closeAddModal();
            if (event.target == document.getElementById('editModal')) closeEditModal();
            if (event.target == document.getElementById('globalPriceModal')) closeGlobalPriceModal();
            if (event.target == document.getElementById('cancelGlobalModal')) closeCancelModal();
            if (event.target == document.getElementById('imagePreviewModal')) closeImagePreview();
        }
    </script>
@endsection