<!-- resources/views/akunkasir.blade.php -->
@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="my-2 fW-bold">Daftar Akun Kasir</h5>
        </div>
        <div class="card-body">
            <div class="container p-4">
                <!-- Tambah Akun Kasir -->
                <button type="button" class="btn btn-success   mb-4" data-bs-toggle="modal" data-bs-target="#addKasirModal">
                    <i class="bi bi-plus-square-fill mr-1"></i> Tambah Akun Kasir
                </button>
                <!-- Tabel akun kasir -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>No. Telepon</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kasirs as $index => $kasir)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $kasir->name }}</td>
                                <td>{{ $kasir->username }}</td>
                                <td>{{ $kasir->phone }}</td>
                                <td>{{ $kasir->address }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editKasirModal-{{ $kasir->id }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>

                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteKasirModal-{{ $kasir->id }}">
                                        <i class="bi bi-trash"></i> 
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal ubah akun kasir -->
                            <div class="modal fade" id="editKasirModal-{{ $kasir->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('akunkasir.update', $kasir->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Ubah Akun Kasir</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Nama</label>
                                                    <input type="text" class="form-control" name="name"
                                                        value="{{ $kasir->name }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Username</label>
                                                    <input type="text" class="form-control" name="username"
                                                        value="{{ $kasir->username }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Password</label>
                                                    <div class="password-container">
                                                        <input type="password" class="form-control password-input"
                                                            name="password"
                                                            placeholder="Kosongkan jika tidak ingin mengganti password">
                                                        <i class="bi bi-eye-slash password-toggle"></i>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="phone" class="form-label">No. Telepon</label>
                                                    <input type="text" class="form-control" name="phone"
                                                        value="{{ $kasir->phone }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="address" class="form-label">Alamat</label>
                                                    <input type="text" class="form-control" name="address"
                                                        value="{{ $kasir->address }}" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal konfirmasi hapus -->
                            <div class="modal fade" id="deleteKasirModal-{{ $kasir->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Yakin ingin menghapus akun kasir <strong>{{ $kasir->name }}</strong>?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tidak</button>
                                            <form action="{{ route('akunkasir.destroy', $kasir->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Modal tambah akun kasir -->
    <div class="modal fade" id="addKasirModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('akunkasir.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Akun Kasir</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="password-container">
                                <input type="password" class="form-control" id="password" name="password" required>
                                <i class="bi bi-eye-slash password-toggle" id="togglePassword"></i>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">No. Telepon</label>
                            <input type="text" class="form-control" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <input type="text" class="form-control" name="address" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Berhasil (Tambah, Ubah, Hapus) -->
    @if (session('success'))
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="successModalLabel">Pemberitahuan</h5>
                    </div>
                    <div class="modal-body">
                        {{ session('success') }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Oke</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script>
        // Password toggle logic
        document.querySelectorAll(".password-toggle").forEach(toggle => {
            toggle.addEventListener("click", function() {
                const passwordInput = this.previousElementSibling;
                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                    this.classList.replace("bi-eye-slash", "bi-eye");
                } else {
                    passwordInput.type = "password";
                    this.classList.replace("bi-eye", "bi-eye-slash");
                }
            });
        });

        // Show success modal if session success exists
        @if (session('success'))
            document.addEventListener('DOMContentLoaded', function() {
                new bootstrap.Modal(document.getElementById('successModal')).show();
            });
        @endif
    </script>
@endsection
