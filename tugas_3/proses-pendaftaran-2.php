<?php
include("koneksi.php");

// cek apakah tombol daftar sudah diklik atau belum?
if(isset($_POST['daftar'])){

    // ambil data dari formulir
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jk = $_POST['jenis_kelamin'];
    $agama = $_POST['agama'];
    $sekolah = $_POST['sekolah_asal']; // PERBAIKAN: Menambahkan tanda $

    // PERBAIKAN: Menggunakan Prepared Statement (Best Practice)
    // buat query dengan placeholder (?)
    $sql = "INSERT INTO calon_siswa (nama, alamat, jenis_kelamin, agama, sekolah_asal) VALUES (?, ?, ?, ?, ?)";
    
    // inisialisasi statement
    $stmt = mysqli_prepare($db, $sql);

    if ($stmt) {
        // bind parameter ke query (sssss artinya 5 parameter bertipe String)
        mysqli_stmt_bind_param($stmt, "sssss", $nama, $alamat, $jk, $agama, $sekolah);

        // eksekusi statement
        $saved = mysqli_stmt_execute($stmt);

        // apakah query simpan berhasil?
        if( $saved ) {
            // kalau berhasil alihkan ke halaman index.php dengan status=sukses
            header('Location: index.php?status=sukses');
        } else {
            // kalau gagal alihkan ke halaman index.php dengan status=gagal
            header('Location: index.php?status=gagal'); // PERBAIKAN: Typo indek.ph jadi index.php
        }

        // tutup statement
        mysqli_stmt_close($stmt);

    } else {
        // Jika statement gagal disiapkan
        die("Query Error: " . mysqli_error($db));
    }

} else {
    die("Akses dilarang...");
}
?>