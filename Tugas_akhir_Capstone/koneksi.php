<?php
$host     = "localhost"; // Sesuaikan jika berbeda
$user     = "root";     // Ganti dengan username Anda
$password = "";         // Ganti dengan password Anda
$database = "db_wisata_balongan"; // Nama database

// Membuat koneksi
$koneksi = new mysqli($host, $user, $password, $database);

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi Gagal: " . $koneksi->connect_error);
}
?>