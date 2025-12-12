<?php
include 'koneksi.php';
$sql = "SELECT * FROM pesanan ORDER BY tanggal_pesan DESC";
$result = $koneksi->query($sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pesanan - Modifikasi</title>
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
        <h2>Daftar Pesanan</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>HP/Telp</th>
                    <th>Tgl Pesan</th>
                    <th>Hari</th>
                    <th>Peserta</th>
                    <th>Penginapan</th>
                    <th>Transportasi</th>
                    <th>Service/Makan</th>
                    <th>Harga Paket</th>
                    <th>Total Tagihan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id_pesanan'] . "</td>";
                        echo "<td>" . $row['nama_pemesan'] . "</td>";
                        echo "<td>" . $row['nomor_hp'] . "</td>";
                        echo "<td>" . $row['tanggal_pesan'] . "</td>";
                        echo "<td>" . $row['waktu_perjalanan'] . "</td>";
                        echo "<td>" . $row['jumlah_peserta'] . "</td>";
                        echo "<td>" . $row['penginapan'] . "</td>";
                        echo "<td>" . $row['transportasi'] . "</td>";
                        echo "<td>" . $row['service_makan'] . "</td>";
                        echo "<td>" . number_format($row['harga_paket'], 0, ',', '.') . "</td>";
                        echo "<td>" . number_format($row['jumlah_tagihan'], 0, ',', '.') . "</td>";
                        echo "<td>";
                        // Tombol Edit - Mengarahkan ke form edit (pemesanan.php) dengan ID 
                        echo "<a href='pemesanan.php?edit_id=" . $row['id_pesanan'] . "' class='btn-edit'>Edit</a> "; 
                        // Tombol Hapus - Memanggil fungsi JavaScript konfirmasi [cite: 28]
                        echo "<button onclick='konfirmasiHapus(" . $row['id_pesanan'] . ")' class='btn-delete'>Delete</button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='12'>Belum ada data pesanan.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </main>
    
    <script>
        // Fungsi untuk konfirmasi hapus [cite: 28]
        function konfirmasiHapus(id) {
            // Pop-up konfirmasi [cite: 28]
            if (confirm("Anda yakin akan menghapus pesanan dengan ID " + id + "?")) {
                window.location.href = 'proses_hapus.php?id=' + id;
            }
        }
    </script>

    <?php
    $koneksi->close();
    ?>
</body>
</html>