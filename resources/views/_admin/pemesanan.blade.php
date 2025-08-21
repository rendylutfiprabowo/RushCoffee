@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="my-2 fW-bold">Silahkan Pilih Menu</h5>
        </div>
        <div class="card-body">

            <div class="container p-4">
                <div class="row">
                    <!-- Menampilkan Produk -->
                    <div class="col-md-8">
                        <div class="row">
                            @foreach ($menus as $menu)
                                <div class="col-lg-3 col-md-4 col-6 mb-4">
                                    <div class="card h-100">
                                        <img src="{{ asset($menu->gambar) }}" class="card-img-top" alt="{{ $menu->nama }}"
                                            style="height: 150px; object-fit: cover;">
                                        <div class="card-body text-center">
                                            <h5 class="font-weight-bold small">{{ $menu->nama }}</h5>
                                            <p class="small">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                                            <div class="d-flex justify-content-center">
                                                <button class="btn btn-sm btn-secondary"
                                                    onclick="updateQuantity('{{ $menu->id }}', '{{ $menu->nama }}', '{{ $menu->harga }}', -1)">-</button>
                                                <input type="number" id="menu-{{ $menu->id }}" value="0"
                                                    class="mx-2 text-center" style="width: 50px;" readonly>
                                                <button class="btn btn-sm btn-secondary"
                                                    onclick="updateQuantity('{{ $menu->id }}', '{{ $menu->nama }}', '{{ $menu->harga }}', 1)">+</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="my-2 fW-bold">Detail Pesanan</h5>
        </div>
        <div class="card-body">
            <div class="container p-4">
                <div class="row">
                    <!-- Detail Pesanan -->
                    <div class="col-md-6">
                        <div id="order-summary" class="mb-3"></div>
                    </div>

                    <div class="col-md-6">
                        <div class="card p-4">
                            <form id="pemesananForm" action="{{ route('pemesanan.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="nama_pemesan" class="form-label">Nama Pelanggan</label>
                                    <input type="text" class="form-control" name="nama_pemesan" required>
                                </div>

                                <div class="mb-3">
                                    <h6 class="font-weight-bold">Total Harga: Rp <span id="total-harga-display">0</span>
                                    </h6>
                                </div>
                                <div class="mb-3">
                                    <label for="uang_dibayar" class="form-label">Nominal Uang</label>
                                    <input type="number" class="form-control" name="uang_dibayar" id="uang_dibayar"
                                        required min="0">
                                </div>
                                <div class="mb-3">
                                    <label for="kembalian" class="form-label">Kembalian</label>
                                    <input type="text" class="form-control" id="kembalian" readonly>
                                </div>
                                <input type="hidden" name="total_harga" id="total_harga">
                                <div class="d-flex">
                                    <button type="button" class="btn btn-success mt-3 me-2" style="width: 100%;"
                                        onclick="validateAndShowOrderDetails()"><i class="bi bi-arrow-repeat"></i> Proses Pesanan</button>
                                    <button type="button" class="btn btn-danger mt-3"
                                        onclick="showResetConfirm()">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    </div>
    <!-- Modal Detail Pesanan -->
    <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">Detail Pesanan</h5>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="d-flex justify-content-between">
                            <strong>Nama Pemesan</strong>
                            <span id="modal-nama-pemesan"></span>
                        </div>
                        <p><strong></strong> <span id="modal-menu"></span></p>
                        <div class="d-flex justify-content-between">
                            <strong>Total Harga</strong>
                            <span>Rp <span id="modal-total-harga"></span></span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <strong>Nominal Uang</strong>
                            <span>Rp <span id="modal-uang-dibayar"></span></span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <strong>Kembalian</strong>
                            <span>Rp <span id="modal-kembalian"></span></span>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="submitOrder()">Pesan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Success Message -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Pesanan Berhasil</h5>
                </div>
                <div class="modal-body">
                    <p>Pesanan Anda telah berhasil diproses.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Oke</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Reset -->
    <div class="modal fade" id="resetConfirmModal" tabindex="-1" aria-labelledby="resetConfirmModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resetConfirmModalLabel">Konfirmasi Reset</h5>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus semua data transaksi?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                    <button type="button" class="btn btn-danger" onclick="confirmReset()">Ya, Hapus</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        let order = [];

        function updateQuantity(menuId, nama, harga, increment) {
            const quantityInput = document.getElementById(`menu-${menuId}`);
            let quantity = parseInt(quantityInput.value) + increment;
            if (quantity < 0) quantity = 0;
            quantityInput.value = quantity;

            const existingMenu = order.find(item => item.id === menuId);

            if (existingMenu) {
                existingMenu.jumlah = quantity;
            } else {
                order.push({
                    id: menuId,
                    nama,
                    harga: parseFloat(harga),
                    jumlah: quantity
                });
            }

            order = order.filter(item => item.jumlah > 0);
            updateOrderSummary();
        }

        function updateOrderSummary() {
            let totalHarga = 0;
            let summaryHTML = `
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>Menu</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
    `;

            order.forEach(menu => {
                const subtotal = menu.harga * menu.jumlah;
                totalHarga += subtotal;
                summaryHTML += `
            <tr>
                <td>${menu.nama}</td>
                <td>${menu.jumlah}</td>
                <td>Rp ${subtotal.toLocaleString()}</td>
            </tr>
        `;
            });

            summaryHTML += `
            </tbody>
        </table>
    `;

            document.getElementById('order-summary').innerHTML = summaryHTML;
            document.getElementById('total-harga-display').textContent = totalHarga.toLocaleString();
            document.getElementById('total_harga').value = totalHarga;

            updateChange();
        }


        function updateChange() {
            const totalHarga = parseFloat(document.getElementById('total_harga').value) || 0;
            const uangDibayar = parseFloat(document.getElementById('uang_dibayar').value) || 0;
            const kembalian = uangDibayar - totalHarga;
            document.getElementById('kembalian').value = kembalian >= 0 ? kembalian.toLocaleString() : 'Uang tidak cukup';
        }

        // Event listener untuk memperbarui kembalian saat nilai uang dibayar diinput
        document.getElementById('uang_dibayar').addEventListener('input', updateChange);


        document.getElementById('uang_dibayar').addEventListener('input', function() {
            const totalHarga = parseFloat(document.getElementById('total_harga').value) || 0;
            const uangDibayar = parseFloat(this.value) || 0;
            const kembalian = uangDibayar - totalHarga;
            document.getElementById('kembalian').value = kembalian >= 0 ? kembalian.toLocaleString() :
                'Uang tidak cukup';
        });

        function validateAndShowOrderDetails() {
            const form = document.getElementById('pemesananForm');
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            if (order.length === 0) {
                alert('Harap tambahkan minimal satu menu ke pesanan.');
                return;
            }

            showOrderDetails();
        }

        function showOrderDetails() {
            const namaPemesan = document.querySelector('[name="nama_pemesan"]').value;
            const uangDibayar = document.getElementById('uang_dibayar').value;
            const kembalian = document.getElementById('kembalian').value;

            document.getElementById('modal-nama-pemesan').textContent = namaPemesan;
            document.getElementById('modal-menu').innerHTML = document.getElementById('order-summary').innerHTML;
            document.getElementById('modal-total-harga').textContent = document.getElementById('total-harga-display')
                .textContent;
            document.getElementById('modal-uang-dibayar').textContent = uangDibayar;
            document.getElementById('modal-kembalian').textContent = kembalian;

            const modal = new bootstrap.Modal(document.getElementById('orderModal'));
            modal.show();
        }

        function submitOrder() {
            const formData = new FormData(document.getElementById('pemesananForm'));
            formData.append('menus', JSON.stringify(order));

            fetch('{{ route('pemesanan.store') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show the success modal
                        const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                        successModal.show();
                        resetForm();
                    } else {
                        alert('Terjadi kesalahan saat memproses pesanan.');
                    }
                });

            const orderModal = bootstrap.Modal.getInstance(document.getElementById('orderModal'));
            orderModal.hide();
        }


        // Menampilkan modal konfirmasi reset
        function showResetConfirm() {
            const resetModal = new bootstrap.Modal(document.getElementById('resetConfirmModal'));
            resetModal.show();
        }

        // Fungsi untuk mengonfirmasi reset
        function confirmReset() {
            resetForm();
            const resetModal = bootstrap.Modal.getInstance(document.getElementById('resetConfirmModal'));
            resetModal.hide();
        }

        // Memastikan reset semua inputan form dan jumlah item pada card menu
        function resetForm() {
            document.getElementById('pemesananForm').reset();
            document.getElementById('order-summary').innerHTML = '';
            document.getElementById('total-harga-display').textContent = '0';
            document.getElementById('kembalian').value = '';
            document.getElementById('total_harga').value = '';

            // Atur ulang jumlah item yang ada pada setiap card menu menjadi 0
            order = [];
            document.querySelectorAll('[id^="menu-"]').forEach(input => input.value = 0);
        }
    </script>
@endsection
