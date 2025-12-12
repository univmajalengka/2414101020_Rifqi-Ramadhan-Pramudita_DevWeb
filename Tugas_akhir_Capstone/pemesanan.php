<?php
// Pastikan file koneksi.php ada dan terhubung ke database
include 'koneksi.php';

// Inisialisasi variabel untuk mode Edit/Baru
$data_edit = null;
$judul_form = 'Pemesanan Paket Wisata Baru';

// 1. Logika untuk Mode Edit
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    // Query untuk mengambil data pesanan lama
    $sql_edit = "SELECT * FROM pesanan WHERE id_pesanan = '$edit_id'";
    $result_edit = $koneksi->query($sql_edit);

    if ($result_edit && $result_edit->num_rows > 0) {
        $data_edit = $result_edit->fetch_assoc();
        $judul_form = 'Edit Data Pesanan (ID: ' . $edit_id . ')';
    }
}

// Ambil nama paket jika ada (hanya relevan untuk form baru)
$paket_terpilih = isset($_GET['paket']) ? htmlspecialchars($_GET['paket']) : 'Paket Umum';

// Menentukan judul berdasarkan mode
$judul_halaman = $data_edit ? $judul_form : "Form Pemesanan Paket Wisata - " . $paket_terpilih;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pemesanan Paket Wisata</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <nav>
            <a href="index.php">Beranda</a> |
            <a href="modifikasi_pesanan.php">Modifikasi Pesanan</a>
        </nav>
    </header>

    <main>
        <div class="form-card"> <h2><?php echo $judul_halaman; ?></h2>

            <form action="proses_simpan.php" method="POST" onsubmit="return validateForm()">
                <?php if ($data_edit): ?>
                    <input type="hidden" name="id_pesanan" value="<?php echo $data_edit['id_pesanan']; ?>">
                <?php endif; ?>

                <label for="nama">Nama Pemesan</label>
                <input type="text" id="nama" name="nama" required class="highlight-input" value="<?php echo $data_edit ? htmlspecialchars($data_edit['nama_pemesan']) : ''; ?>">

                <label for="hp">Nomor HP / WhatsApp</label>
                <input type="tel" id="hp" name="hp" required class="highlight-input" value="<?php echo $data_edit ? htmlspecialchars($data_edit['nomor_hp']) : ''; ?>">

                <div class="field-group">
                    <div class="field-item">
                        <label for="tanggal_pesan">Tanggal Wisata</label>
                        <input type="date" id="tanggal_pesan" name="tanggal_pesan" required value="<?php echo $data_edit ? $data_edit['tanggal_pesan'] : ''; ?>">
                    </div>
                    <div class="field-item">
                        <label for="waktu">Durasi (Hari)</label>
                        <input type="number" id="waktu" name="waktu" min="1" onchange="hitungTagihan()" required value="<?php echo $data_edit ? $data_edit['waktu_perjalanan'] : ''; ?>">
                    </div>
                </div>

                <label for="layanan_select">Pilih Layanan Tambahan</label>
                <select id="layanan_select" class="highlight-input" onchange="updateCheckboxes()">
                    <option value="">-- Pilih Layanan --</option>
                    
                    <?php 
                    // Logika PHP untuk mencocokkan status 'selected' pada dropdown di mode Edit
                    $val_1m = $data_edit && $data_edit['penginapan'] == 'Y' && $data_edit['transportasi'] == 'N' && $data_edit['service_makan'] == 'N' ? 'selected' : ''; 
                    $val_2_2m = $data_edit && $data_edit['penginapan'] == 'Y' && $data_edit['transportasi'] == 'Y' && $data_edit['service_makan'] == 'N' ? 'selected' : '';
                    $val_2_7m = $data_edit && $data_edit['penginapan'] == 'Y' && $data_edit['transportasi'] == 'Y' && $data_edit['service_makan'] == 'Y' ? 'selected' : ''; 
                    ?>
                    
                    <option value="1000000" <?php echo $val_1m; ?>>Penginapan (Rp 1.000.000)</option>
                    <option value="2200000" <?php echo $val_2_2m; ?>>Penginapan + Transportasi (Rp 2.200.000)</option>
                    <option value="2700000" <?php echo $val_2_7m; ?>>Lengkap (Rp 2.700.000)</option>
                </select>
                
                <div style="display: none;">
                    <input type="checkbox" id="penginapan" name="layanan[]" value="1000000" onclick="hitungTagihan()" <?php echo $data_edit && $data_edit['penginapan'] == 'Y' ? 'checked' : ''; ?>>
                    <input type="checkbox" id="transportasi" name="layanan[]" value="1200000" onclick="hitungTagihan()" <?php echo $data_edit && $data_edit['transportasi'] == 'Y' ? 'checked' : ''; ?>>
                    <input type="checkbox" id="servismakan" name="layanan[]" value="500000" onclick="hitungTagihan()" <?php echo $data_edit && $data_edit['service_makan'] == 'Y' ? 'checked' : ''; ?>>
                </div>
                
                <label for="jumlah_peserta">Jumlah Peserta</label>
                 <input type="number" id="jumlah_peserta" name="jumlah_peserta" min="1" onchange="hitungTagihan()" required value="<?php echo $data_edit ? $data_edit['jumlah_peserta'] : ''; ?>">

                <div class="summary-section">
                    <div class="summary-item">
                        <label for="harga_paket_display">Harga Paket:</label>
                        <span id="harga_paket_display">Rp 0</span>
                        <input type="hidden" id="harga_paket" name="harga_paket" value="<?php echo $data_edit ? $data_edit['harga_paket'] : '0'; ?>">
                    </div>
                    <div class="summary-item total-tagihan">
                        <label for="jumlah_tagihan_display">Total Tagihan:</label>
                         <span id="jumlah_tagihan_display">Rp 0</span>
                        <input type="hidden" id="jumlah_tagihan" name="jumlah_tagihan" value="<?php echo $data_edit ? $data_edit['jumlah_tagihan'] : '0'; ?>">
                    </div>
                </div>

                <input type="hidden" name="paket_nama" value="<?php echo $paket_terpilih; ?>">
                
                <button type="submit" class="btn-konfirmasi">
                    <?php echo $data_edit ? 'Simpan Perubahan' : 'Konfirmasi Pesanan'; ?>
                </button>
                <?php if ($data_edit): ?>
                    <a href="modifikasi_pesanan.php" class="btn-batal">Batal</a>
                <?php endif; ?>

            </form>
        </div>
    </main>

    <script>
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
        
        // Pastikan nilai waktu, peserta, atau harga paket adalah bilangan positif sebelum dikalikan
        if (waktu <= 0 || peserta <= 0 || hargaPaket <= 0) {
            // Jika durasi, peserta, atau harga paket belum valid/dipilih, set tagihan ke 0
            const tagihanDefault = 0;
            document.getElementById('jumlah_tagihan').value = tagihanDefault;
            document.getElementById('jumlah_tagihan_display').innerText = 'Rp 0';
            
            // Hentikan fungsi jika input belum valid
            return; 
        }
        
        // Perhitungan Jumlah Tagihan = Waktu Perjalanan (Hari) x Jumlah Peserta x Harga Paket Perjalanan
        const jumlahTagihan = waktu * peserta * hargaPaket;
        
        // Update nilai input tersembunyi
        document.getElementById('jumlah_tagihan').value = jumlahTagihan;
        // Update tampilan
        document.getElementById('jumlah_tagihan_display').innerText = 'Rp ' + jumlahTagihan.toLocaleString('id-ID');
    }

    // Fungsi Validasi Dasar Formulir
    function validateForm() {
        const requiredFields = ['nama', 'hp', 'tanggal_pesan', 'waktu', 'jumlah_peserta'];
        let isValid = true;
        
        requiredFields.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            if (!field.value) {
                isValid = false;
            }
        });

        if (!isValid) {
            alert("Data harus terisi semua.");
            return false;
        }
        
        // Cek jika Harga Paket masih 0 (artinya belum memilih layanan)
        if (parseInt(document.getElementById('harga_paket').value) === 0) {
            alert("Mohon pilih minimal satu layanan.");
            return false;
        }
        
        return true;
    }

    // Jalankan perhitungan saat halaman dimuat (penting untuk mode edit)
    document.addEventListener('DOMContentLoaded', () => {
        // Panggil hitungTagihan() untuk memastikan harga dan tagihan awal terhitung
        // berdasarkan data lama (mode edit) atau nol (mode baru).
        hitungTagihan(); 
    });
    </script>

</body>
</html>