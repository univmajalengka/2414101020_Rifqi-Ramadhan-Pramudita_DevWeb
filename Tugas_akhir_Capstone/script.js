// Fungsi untuk mengupdate checkbox berdasarkan dropdown (Jika menggunakan dropdown dummy)
function updateCheckboxes() {
    // 1. Reset semua checkbox
    document.getElementById('penginapan').checked = false;
    document.getElementById('transportasi').checked = false;
    document.getElementById('servismakan').checked = false;

    const selectedValue = parseInt(document.getElementById('layanan_select').value) || 0;

    // 2. Logika untuk menentukan checkbox mana yang harus dicentang
    if (selectedValue === 1000000) {
        document.getElementById('penginapan').checked = true;
    } else if (selectedValue === 2200000) { // Penginapan (1.000.000) + Transportasi (1.200.000)
        document.getElementById('penginapan').checked = true;
        document.getElementById('transportasi').checked = true;
    } else if (selectedValue === 2700000) { // Lengkap (Penginapan + Transportasi + Makan)
        document.getElementById('penginapan').checked = true;
        document.getElementById('transportasi').checked = true;
        document.getElementById('servismakan').checked = true;
    }
    // Tambahkan logika untuk kombinasi layanan lain jika ada

    // 3. Panggil fungsi perhitungan setelah checkbox di-update
    hitungTagihan();
}

// Fungsi perhitungan otomatis menggunakan JavaScript
function hitungTagihan() {
    const layanan = document.querySelectorAll('input[name="layanan[]"]:checked');
    let hargaPaket = 0;
    
    // Hitung Harga Paket Perjalanan (Total dari layanan yang dipilih)
    layanan.forEach(item => {
        hargaPaket += parseInt(item.value);
    });

    // Update nilai input tersembunyi (untuk dikirim ke PHP)
    document.getElementById('harga_paket').value = hargaPaket;
    // Update tampilan
    document.getElementById('harga_paket_display').innerText = 'Rp ' + hargaPaket.toLocaleString('id-ID');

    // Periksa apakah input menghasilkan NaN atau 0
    const waktu = parseInt(document.getElementById('waktu').value) || 0;
    const peserta = parseInt(document.getElementById('jumlah_peserta').value) || 0;
    
    // Tambahkan log untuk debugging di browser (bisa dihapus setelah testing):
    // console.log("Waktu:", waktu, "Peserta:", peserta, "Harga Paket:", hargaPaket);
    
    // Pastikan nilai waktu, peserta, atau harga paket adalah bilangan positif sebelum dikalikan
    if (waktu <= 0 || peserta <= 0 || hargaPaket <= 0) {
        // Jika durasi, peserta, atau harga paket belum valid/dipilih, set tagihan ke 0
        const tagihanDefault = 0;
        document.getElementById('jumlah_tagihan').value = tagihanDefault;
        document.getElementById('jumlah_tagihan_display').innerText = 'Rp 0';
        
        // Hentikan fungsi jika input belum valid, tetapi biarkan harga paket tampil 0
        return; 
    }
    
    [cite_start]// Perhitungan Jumlah Tagihan = Waktu Perjalanan (Hari) x Jumlah Peserta x Harga Paket Perjalanan [cite: 24]
    const jumlahTagihan = waktu * peserta * hargaPaket;
    
    // Update nilai input tersembunyi
    document.getElementById('jumlah_tagihan').value = jumlahTagihan;
    // Update tampilan
    document.getElementById('jumlah_tagihan_display').innerText = 'Rp ' + jumlahTagihan.toLocaleString('id-ID');
}


// Jalankan perhitungan saat halaman dimuat (terutama penting untuk mode edit)
document.addEventListener('DOMContentLoaded', () => {
    // Lakukan perhitungan awal. Ini akan membaca status checkbox yang telah di-set PHP 
    // (saat mode edit) atau 0 (saat mode baru).
    hitungTagihan(); 
});