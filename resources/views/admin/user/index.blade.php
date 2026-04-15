@extends('layouts.sidebar')
@section('title', 'Admin | User')
@section('content')
    <style>
        .table-container {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border: 1px solid #eef0f5;
            margin-top: 20px;
            overflow: hidden;
        }

        .table-content {
            padding: 24px;
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
            font-size: 12px;
            font-weight: 600;
            border-bottom: 2px solid #edf2f7;
        }

        .custom-table td {
            padding: 15px;
            border-bottom: 1px solid #edf2f7;
            color: #334155;
            font-size: 14px;
        }

        .badge {
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-admin {
            background: #e0e7ff;
            color: #4338ca;
        }

        .badge-customer {
            background: #fef3c7;
            color: #92400e;
        }

        .custom-table tbody tr:hover {
            background-color: #f1f5f9;
            transition: 0.2s;
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

        .btn-edit {
            background-color: #f1f5f9;
            color: #635bff;
            margin-right: 5px;
        }

        .btn-edit:hover {
            background-color: #635bff;
            color: #fff;
        }

        .btn-delete {
            background-color: #fff1f2;
            color: #e11d48;
        }

        .btn-delete:hover {
            background-color: #e11d48;
            color: #fff;
        }

        .action-container {
            display: flex;
            gap: 5px;
            justify-content: center;
        }

        /* Modal */
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
            transition: border-color 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: #635bff;
            box-shadow: 0 0 0 3px rgba(99, 91, 255, 0.1);
        }

        .btn-save {
            background: #635bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-save:hover {
            background: #4f46e5;
        }

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

        .btn-cancel-modal {
            background: #f1f5f9;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
        }

        /* ========== VERSI MOBILE - RESPONSIVE ========== */
        @media (max-width: 768px) {
            .table-content {
                padding: 16px;
            }

            .table-header h3 {
                font-size: 16px;
            }

            /* Membuat tabel menjadi scroll horizontal */
            .table-container {
                overflow-x: auto;
            }

            .custom-table {
                min-width: 600px;
            }

            .custom-table th,
            .custom-table td {
                padding: 10px 12px;
                font-size: 12px;
            }

            .custom-table td img {
                width: 35px;
                height: 35px;
            }

            .badge {
                font-size: 10px;
                padding: 3px 6px;
            }

            .btn-action {
                padding: 4px 8px;
                font-size: 14px;
            }

            /* Modal Mobile */
            .modal-content {
                max-width: 90%;
                margin: 16px;
                padding: 20px;
                max-height: 85vh;
                overflow-y: auto;
            }

            .modal-header h3 {
                font-size: 16px;
            }

            .form-group label {
                font-size: 13px;
            }

            .form-control {
                padding: 8px 10px;
                font-size: 13px;
            }

            .btn-save,
            .btn-cancel-modal {
                padding: 8px 16px;
                font-size: 13px;
            }
        }

        @media (max-width: 480px) {
            .table-content {
                padding: 12px;
            }

            .custom-table {
                min-width: 550px;
            }

            .custom-table th,
            .custom-table td {
                padding: 8px 10px;
                font-size: 11px;
            }

            .custom-table td img {
                width: 30px;
                height: 30px;
            }

            .btn-action {
                padding: 3px 6px;
                font-size: 12px;
            }

            /* Modal Mobile Kecil */
            .modal-content {
                padding: 16px;
            }

            .modal-header {
                margin-bottom: 16px;
            }

            .form-group {
                margin-bottom: 12px;
            }

            .form-group label {
                font-size: 12px;
            }

            .form-control {
                padding: 6px 8px;
                font-size: 12px;
            }

            .modal-footer {
                margin-top: 20px;
                flex-wrap: wrap;
            }

            .btn-save,
            .btn-cancel-modal {
                flex: 1;
                text-align: center;
                padding: 8px 12px;
                font-size: 12px;
            }
        }

        /* Landscape mode untuk mobile */
        @media (max-width: 768px) and (orientation: landscape) {
            .modal-content {
                max-height: 80vh;
            }

            .custom-table {
                min-width: 650px;
            }
        }
    </style>

    <x-page-header>
        <x-slot:title>Manage User</x-slot:title>
        <x-slot:subtitle>Kelola User Secara Lengkap</x-slot:subtitle>
    </x-page-header>

    <div class="table-container">
        <div class="table-content">
            <div class="table-header">
                <h3 style="font-size: 18px;">Daftar Pengguna</h3>
            </div>

            <table class="custom-table">
                <thead style="text-align: center;">
                    <tr>
                        <th>No</th>
                        <th>Avatar</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Dibuat Pada</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody style="text-align: center;">
                    @foreach($users as $index => $user)
                        <tr>
                            <td>{{ $users->firstItem() + $loop->index }}</td>
                            <td>
                                <img src="{{ $user->avatar ?? asset('images/profile.webp') }}" alt="Avatar"
                                    style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                            </td>
                            <td style="font-weight: 500;">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge {{ $user->role == 'admin' ? 'badge-admin' : 'badge-customer' }}">
                                    {{ strtoupper($user->role) }}
                                </span>
                            </td>
                            <td>{{ $user->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="action-container">
                                    <a onclick="openDetailModal({{ json_encode($user) }})" class="btn-action btn-edit"
                                        title="Detail User">
                                        <i class="bx bx-info-circle"></i>
                                    </a>

                                    <form action="{{ route('admin.delete', $user->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin dihapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete" title="Hapus User">
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

        {{-- Pagination --}}
        {{ $users->links('components.paginate') }}
    </div>

    {{-- Modal Detail --}}
    <div id="userDetailModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Detail Pengguna</h3>
                <span class="close-modal" onclick="closeDetailModal()">&times;</span>
            </div>
            <form id="detailForm" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" id="detail_name" class="form-control" disabled>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" id="detail_email" class="form-control" disabled>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" id="detail_password" class="form-control" disabled>
                </div>

                <div class="form-group">
                    <label>Nama Orang Terdekat</label>
                    <input type="text" name="nama_orang_terdekat" id="detail_nama_orang_terdekat" class="form-control"
                        disabled>
                </div>

                <div class="form-group">
                    <label>Alamat Orang Terdekat</label>
                    <input type="text" name="alamat_orang_terdekat" id="detail_alamat_orang_terdekat" class="form-control"
                        disabled>
                </div>

                <div class="form-group">
                    <label>Role</label>
                    <select name="role" id="detail_role" class="form-control" required>
                        <option value="admin">ADMIN</option>
                        <option value="customer">CUSTOMER</option>
                    </select>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn-save">Simpan Perubahan</button>
                    <button type="button" class="btn-cancel-modal" onclick="closeDetailModal()">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openDetailModal(user) {
            const modal = document.getElementById('userDetailModal');
            const form = document.getElementById('detailForm');

            document.getElementById('detail_name').value = user.name;
            document.getElementById('detail_email').value = user.email;
            document.getElementById('detail_role').value = user.role;
            document.getElementById('detail_nama_orang_terdekat').value = user.nama_orang_terdekat || '-';
            document.getElementById('detail_alamat_orang_terdekat').value = user.alamat_orang_terdekat || '-';

            form.action = `/admin/put/${user.id}`;

            modal.style.display = 'flex';
        }

        function closeDetailModal() {
            document.getElementById('userDetailModal').style.display = 'none';
        }

        window.onclick = function (event) {
            const modal = document.getElementById('userDetailModal');
            if (event.target == modal) {
                closeDetailModal();
            }
        }
    </script>
@endsection