@extends('layouts.sidebar')

@section('title', 'Upload Bukti Pembayaran')

@section('content')
    <div class="container-fluid py-4" style="background: #f8fafc; min-height: 100vh;">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="d-flex align-items-center mb-4">
                    <a href="{{ route('customer.bookings') }}" class="btn btn-light shadow-sm border-0 me-3"
                        style="border-radius: 10px;">
                        <i class="bx bx-left-arrow-alt fs-4"></i>
                    </a>
                    <h4 class="mb-0 fw-bold text-dark">Upload Bukti Bayar</h4>
                </div>

                <div class="row g-4">
                    {{-- Kiri: Instruksi Pembayaran --}}
                    <div class="col-md-5">
                        <div class="card border-0 shadow-sm mb-4"
                            style="border-radius: 15px; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);">
                            <div class="card-body p-4 text-white">
                                <h6 class="fw-bold mb-3">Instruksi Pembayaran</h6>
                                <p class="small opacity-75 mb-4">Silakan transfer sesuai nominal ke salah satu rekening di
                                    bawah ini:</p>

                                <div
                                    class="mb-3 p-3 bg-white bg-opacity-10 rounded-3 border border-white border-opacity-10">
                                    <p class="small mb-1 opacity-75">Bank Central Asia (BCA)</p>
                                    <h5 class="fw-bold mb-1">1234 5678 90</h5>
                                    <p class="small mb-0">A/N Sewa Mobil Arga</p>
                                </div>

                                <div
                                    class="mb-0 p-3 bg-white bg-opacity-10 rounded-3 border border-white border-opacity-10">
                                    <p class="small mb-1 opacity-75">Mandiri</p>
                                    <h5 class="fw-bold mb-1">9876 5432 10</h5>
                                    <p class="small mb-0">A/N Sewa Mobil Arga</p>
                                </div>
                            </div>
                        </div>

                        <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                            <div class="card-body p-4">
                                <h6 class="fw-bold text-dark mb-3">Ringkasan Pesanan</h6>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted small">Mobil</span>
                                    <span class="small fw-semibold">{{ $booking->car->nama_mobil }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted small">Durasi</span>
                                    <span class="small fw-semibold">{{ $booking->durasi_hari }} Hari</span>
                                </div>
                                <hr class="my-3 opacity-10">
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted small">Total yang harus dibayar</span>
                                    <span class="fw-bold text-primary">Rp
                                        {{ number_format($booking->total_harga, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Kanan: Form Upload --}}
                    <div class="col-md-7">
                        <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                            <div class="card-body p-4 p-lg-5">
                                <div class="text-center mb-4">
                                    <div class="bg-primary bg-opacity-10 text-primary mx-auto d-flex align-items-center justify-content-center mb-3"
                                        style="width: 60px; height: 60px; border-radius: 50%;">
                                        <i class="bx bx-cloud-upload fs-2"></i>
                                    </div>
                                    <h5 class="fw-bold">Konfirmasi Pembayaran</h5>
                                    <p class="text-muted small">Pastikan foto bukti transfer terlihat jelas dan nominal
                                        sesuai.</p>
                                </div>

                                <form action="{{ route('customer.booking.upload', $booking->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-4 text-center">
                                        <div id="image-preview" class="mb-3 d-none">
                                            <img src="" id="preview" class="img-fluid rounded-3 shadow-sm"
                                                style="max-height: 250px;">
                                        </div>

                                        <label for="bukti_bayar"
                                            class="upload-area w-100 p-4 border border-2 border-dashed rounded-3 text-center cursor-pointer"
                                            style="border-color: #e2e8f0 !important; cursor: pointer;">
                                            <input type="file" name="bukti_bayar" id="bukti_bayar"
                                                class="d-none @error('bukti_bayar') is-invalid @enderror" accept="image/*"
                                                required>
                                            <div class="upload-placeholder">
                                                <i class="bx bx-image-add fs-1 text-muted mb-2"></i>
                                                <p class="mb-0 text-muted small">Klik untuk pilih foto bukti bayar</p>
                                                <p class="text-muted" style="font-size: 0.7rem;">Format: JPG, PNG, JPEG
                                                    (Maks. 2MB)</p>
                                            </div>
                                        </label>
                                        @error('bukti_bayar') <div class="invalid-feedback d-block mt-2">{{ $message }}
                                        </div> @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold py-3 shadow-sm mt-2"
                                        style="border-radius: 12px;">
                                        Kirim Sekarang
                                    </button>
                                </form>
                            </div>
                        </div>
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
                const placeholder = document.querySelector('.upload-placeholder');

                preview.src = URL.createObjectURL(file);
                previewContainer.classList.remove('d-none');
                placeholder.classList.add('d-none');
                document.querySelector('.upload-area').classList.add('p-2');
            }
        }
    </script>

    <style>
        .upload-area:hover {
            background-color: #f8fafc;
            border-color: #2563eb !important;
        }
    </style>
@endsection