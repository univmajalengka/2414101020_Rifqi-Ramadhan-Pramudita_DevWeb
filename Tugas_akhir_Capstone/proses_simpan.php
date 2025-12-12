<?php
include 'koneksi.php';

// Ambil data dari form
$nama       = $_POST['nama'];
$hp         = $_POST['hp'];
$tanggal    = $_POST['tanggal_pesan'];
$waktu      = $_POST['waktu'];
$peserta    = $_POST['jumlah_peserta'];

// Ambil harga paket dan tagihan (dihitung di front-end, tapi validasi backend tetap penting)
$harga_paket = str_replace('.', '', $_POST['harga_paket']); // Hapus format titik (Rp)
$tagihan     = str_replace('.', '', $_POST['jumlah_tagihan']);

// Cek layanan yang dipilih
$layanan_penginapan   = 'N';
$layanan_transportasi = 'N';
$layanan_makan        = 'N';

if(isset($_POST['layanan'])) {
    foreach($_POST['layanan'] as $layanan_value) {
        if ($layanan_value == '1000000') $layanan_penginapan = 'Y';
        if ($layanan_value == '1200000') $layanan_transportasi = 'Y';
        if ($layanan_value == '500000') $layanan_makan = 'Y';
    }
}

// Cek apakah ini mode Edit (jika id_pesanan ada) atau mode Insert
if (isset($_POST['id_pesanan']) && !empty($_POST['id_pesanan'])) {
    // MODE EDIT/UPDATE
    $id_pesanan = $_POST['id_pesanan'];
    $sql = "UPDATE pesanan SET 
                nama_pemesan='$nama', nomor_hp='$hp', tanggal_pesan='$tanggal', 
                waktu_perjalanan='$waktu', jumlah_peserta='$peserta', 
                penginapan='$layanan_penginapan', transportasi='$layanan_transportasi', 
                service_makan='$layanan_makan', harga_paket='$harga_paket', 
                jumlah_tagihan='$tagihan' 
            WHERE id_pesanan='$id_pesanan'";

} else {
    // MODE INSERT/SIMPAN BARU [cite: 25]
    $sql = "INSERT INTO pesanan (nama_pemesan, nomor_hp, tanggal_pesan, waktu_perjalanan, jumlah_peserta, penginapan, transportasi, service_makan, harga_paket, jumlah_tagihan)
            VALUES ('$nama', '$hp', '$tanggal', '$waktu', '$peserta', '$layanan_penginapan', '$layanan_transportasi', '$layanan_makan', '$harga_paket', '$tagihan')";
}

if ($koneksi->query($sql) === TRUE) {
    header("Location: modifikasi_pesanan.php?status=sukses"); // Redirect ke halaman daftar pesanan
} else {
    echo "Error: " . $sql . "<br>" . $koneksi->error;
}

$koneksi->close();
?>