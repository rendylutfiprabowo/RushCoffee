document.getElementById('toggleSidebar').addEventListener('click', function () {
    const sidebar = document.querySelector('.sidebar');
    sidebar.classList.toggle('collapsed');
});


// Pilih menu otomatis di order 
function selectMenu(nama, harga) {
    document.getElementById('menu').value = nama;
    const jumlah = document.getElementById('jumlah').value;
    document.getElementById('subtotal').value = `Rp. ${new Intl.NumberFormat('id-ID').format(harga * jumlah)}`;
}

document.getElementById('jumlah').addEventListener('input', function () {
    const menuName = document.getElementById('menu').value;
    if (menuName) {
        const harga = menus.find(menu => menu.nama === menuName).harga;
        document.getElementById('subtotal').value = `Rp. ${new Intl.NumberFormat('id-ID').format(harga * this.value)}`;
    }

    var successModal = new bootstrap.Modal(document.getElementById('successModal'), {});
    successModal.show()
    
});