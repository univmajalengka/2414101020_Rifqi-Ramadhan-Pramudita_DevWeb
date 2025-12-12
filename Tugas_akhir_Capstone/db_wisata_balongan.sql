-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2025 at 08:16 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_wisata_balongan`
--

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `nama_pemesan` varchar(100) NOT NULL,
  `nomor_hp` varchar(15) NOT NULL,
  `tanggal_pesan` date NOT NULL,
  `waktu_perjalanan` int(11) NOT NULL,
  `jumlah_peserta` int(11) NOT NULL,
  `penginapan` enum('Y','N') NOT NULL,
  `transportasi` enum('Y','N') NOT NULL,
  `service_makan` enum('Y','N') NOT NULL,
  `harga_paket` decimal(10,0) NOT NULL,
  `jumlah_tagihan` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `nama_pemesan`, `nomor_hp`, `tanggal_pesan`, `waktu_perjalanan`, `jumlah_peserta`, `penginapan`, `transportasi`, `service_makan`, `harga_paket`, `jumlah_tagihan`) VALUES
(13, 'Ramadhan', '34567890', '2025-12-15', 5, 2, 'Y', 'N', 'N', 1000000, 10000000),
(14, 'Rifqi Ramadhan Pramudita', '09796875679t9', '2025-12-13', 2, 2, 'Y', 'Y', 'Y', 2700000, 10800000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
