@extends('layouts.sidebar')
@section('title', 'Admin | User')
@section('content')
    <style>
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

        /* Baris selang-seling (Zebra) */
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
        /* Styling Tambahan untuk Form di Dalam Modal */
        .form-group {
            margin-bottom: 15px;
            text-align: left;
            /* Agar label tetap di kiri meskipun tabel center */
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
            /* Sembunyi secara default */
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

        /* Tombol batal khusus modal */
        .btn-cancel-modal {
            background: #f1f5f9;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
        }
    </style>

    <div class="header">
        <h2>Manajemen User</h2>
        <p style="color: #64748b; font-size: 14px;">Kelola data pengguna dan hak akses</p>
    </div>

    <div class="table-container">
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
                        <td>{{ $index + 1 }}</td>
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
                                <a onclick="openEditModal({{ json_encode($user) }})" class="btn-action btn-edit"
                                    title="Edit User">
                                    <i class="bx bx-edit-alt"></i>
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

    {{-- Modal Edit --}}
    <div id="editModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Edit Pengguna</h3>
                <span class="close-modal" onclick="closeEditModal()">&times;</span>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" id="edit_name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" id="edit_email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Role</label>
                    <select name="role" id="edit_role" class="form-control" required>
                        <option value="admin">ADMIN</option>
                        <option value="customer">CUSTOMER</option>
                    </select>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn-save">Simpan Perubahan</button>
                    <button type="button" class="btn-cancel-modal" onclick="closeEditModal()">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(user) {
            const modal = document.getElementById('editModal');
            const form = document.getElementById('editForm');

            document.getElementById('edit_name').value = user.name;
            document.getElementById('edit_email').value = user.email;
            document.getElementById('edit_role').value = user.role;

            form.action = `/admin/put/${user.id}`;

            // Menampilkan modal
            modal.style.display = 'flex';
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        window.onclick = function (event) {
            const modal = document.getElementById('editModal');
            if (event.target == modal) {
                closeEditModal();
            }
        }
    </script>
@endsection