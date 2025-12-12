<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_pesanan = $_GET['id'];

    $sql = "DELETE FROM pesanan WHERE id_pesanan='$id_pesanan'";

    if ($koneksi->query($sql) === TRUE) {
        header("Location: modifikasi_pesanan.php?status=hapus_sukses");
    } else {
        echo "Error menghapus data: " . $koneksi->error;
    }
}

$koneksi->close();
?>