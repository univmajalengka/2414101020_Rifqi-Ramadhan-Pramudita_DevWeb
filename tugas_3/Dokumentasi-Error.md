# Dokumentasi Deteksi Error Tugas 3

Berikut adalah hasil analisis error yang ditemukan pada kode asli `proses-pendaftaran-2.php`:

## 1. Syntax Error (Variabel Kurang Tanda $)
* **Lokasi:** `proses-pendaftaran-2.php`, Baris ke-10 (perkiraan).
* **Kode Asli:** `sekolah = $_POST['sekolah_asal'];`
* **Pesan Error (Jika dijalankan):** `Parse error: syntax error, unexpected '=' in...`
* **Penyebab:** Di PHP, deklarasi variabel wajib menggunakan simbol `$` di depannya.
* **Perbaikan:** Ubah menjadi `$sekolah = $_POST['sekolah_asal'];`.

## 2. Logic/Runtime Error (Typo pada Redirect URL)
* **Lokasi:** `proses-pendaftaran-2.php`, Blok `else` setelah query, Baris ke-20 (perkiraan).
* **Kode Asli:** `header('Location: indek.ph?status=gagal');`
* **Penyebab:** Kesalahan penulisan (typo) nama file tujuan. File yang benar seharusnya `index.php`, bukan `indek.ph`.
* **Perbaikan:** Ubah menjadi `header('Location: index.php?status=gagal');`.

## 3. Security Vulnerability (SQL Injection)
* **Lokasi:** `proses-pendaftaran-2.php`, Query INSERT.
* **Kode Asli:** Menggunakan interpolasi variabel langsung ke dalam string SQL (`VALUES ('$nama', ...)`).
* **Penyebab:** Menggabungkan input user langsung ke query SQL tanpa sanitasi memungkinkan penyerang memanipulasi database.
* **Perbaikan:** Menggunakan **Prepared Statements** (`mysqli_prepare` dan `mysqli_stmt_bind_param`) sesuai instruksi *Best Practices*.