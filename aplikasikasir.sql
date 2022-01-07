-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2022 at 05:04 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aplikasikasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_barang_keluar` int(11) NOT NULL,
  `id_warung` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `tanggal_update` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_barang_keluar`, `id_warung`, `id_produk`, `nama_produk`, `harga`, `jumlah`, `keterangan`, `foto`, `tanggal_update`) VALUES
(12, 10, 10, 'Coco Cola', 20000, 300, 'Lengkap', 'http://localhost/aplikasikasir/assets/upload/foto/1641142397.jpg', '2022-01-02'),
(13, 10, 10, 'Coco Cola', 20000, 100, 'Lengkap', 'http://localhost/aplikasikasir/assets/upload/foto/1641142397.jpg', '2022-01-02'),
(14, 8, 7, 'Kopi Kapal Api', 5000, 250, 'Full barang', 'http://localhost/aplikasikasir/assets/upload/foto/1641140302.jpg', '2022-01-07'),
(15, 8, 7, 'Kopi Kapal Api', 5000, 50, 'Full barang', 'http://localhost/aplikasikasir/assets/upload/foto/1641140302.jpg', '2022-01-07'),
(16, 10, 10, 'Coco Cola', 20000, 50, 'Lengkap', 'http://localhost/aplikasikasir/assets/upload/foto/1641142397.jpg', '2022-01-05'),
(17, 8, 7, 'Kopi Kapal Api', 5000, 50, 'Full barang', 'http://localhost/aplikasikasir/assets/upload/foto/1641140302.jpg', '2022-01-05'),
(18, 10, 10, 'Coco Cola', 20000, 50, 'Lengkap', 'http://localhost/aplikasikasir/assets/upload/foto/1641142397.jpg', '2022-01-05'),
(19, 10, 10, 'Coco Cola', 20000, 100, 'Lengkap', 'http://localhost/aplikasikasir/assets/upload/foto/1641142397.jpg', '2022-01-05'),
(20, 8, 7, 'Kopi Kapal Api', 5000, 50, 'Full barang', 'http://localhost/aplikasikasir/assets/upload/foto/1641140302.jpg', '2022-01-05'),
(21, 10, 10, 'Coco Cola', 20000, 50, 'Lengkap', 'http://localhost/aplikasikasir/assets/upload/foto/1641142397.jpg', '2022-01-05'),
(22, 10, 10, 'Coco Cola', 20000, 50, 'Lengkap', 'http://localhost/aplikasikasir/assets/upload/foto/1641142397.jpg', '2022-01-05'),
(23, 8, 7, 'Kopi Kapal Api', 5000, 20, 'Full barang', 'http://localhost/aplikasikasir/assets/upload/foto/1641140302.jpg', '2022-01-07');

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_barang_masuk` int(11) NOT NULL,
  `id_warung` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `tanggal_update` date NOT NULL,
  `status_produk` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_barang_masuk`, `id_warung`, `nama_produk`, `harga`, `stok`, `keterangan`, `foto`, `tanggal_update`, `status_produk`) VALUES
(7, 8, 'Kopi Kapal Api', 5000, 500, 'Full barang', 'http://localhost/aplikasikasir/assets/upload/foto/1641140302.jpg', '2022-01-02', 2),
(8, 10, 'Silver Queen', 40000, 300, 'lengkap', 'http://localhost/aplikasikasir/assets/upload/foto/1641140636.jpg', '2022-01-02', 1),
(9, 9, 'Coklat', 50000, 300, 'Lengkap', 'http://localhost/aplikasikasir/assets/upload/foto/1641140741.jpg', '2022-01-02', 1),
(10, 10, 'Coco Cola', 20000, 500, 'Lengkap', 'http://localhost/aplikasikasir/assets/upload/foto/1641142397.jpg', '2022-01-02', 2);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_warung` int(11) NOT NULL,
  `kode_produk` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `tanggal_update` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_warung`, `kode_produk`, `nama_produk`, `harga`, `stok`, `keterangan`, `foto`, `tanggal_update`) VALUES
(7, 10, '10', 'Coco Cola', 20000, 350, 'Lengkap', 'http://localhost/aplikasikasir/assets/upload/foto/1641142397.jpg', '2022-01-02'),
(8, 8, '7', 'Kopi Kapal Api', 5000, 180, 'Full barang', 'http://localhost/aplikasikasir/assets/upload/foto/1641140302.jpg', '2022-01-02');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_warung` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `tanggal_update` date NOT NULL,
  `session_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_warung`, `id_produk`, `nama_produk`, `harga`, `jumlah`, `keterangan`, `foto`, `tanggal_update`, `session_id`) VALUES
(10, 8, 7, 'Kopi Kapal Api', 5000, 20, 'Full barang', 'http://localhost/aplikasikasir/assets/upload/foto/1641140302.jpg', '2022-01-07', '7gpfj9ipoctbsounh6hc1ovp9hi8icl8');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `id_warung` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('admin','user') NOT NULL DEFAULT 'user',
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `id_warung`, `username`, `email`, `password`, `status`, `token`) VALUES
(1, 0, 'Rizsky Darmawan', 'admin@localhost.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', ''),
(5, 8, 'warung rifqi', 'warungrifqi@localhost', '827ccb0eea8a706c4c34a16891f84e7b', 'user', ''),
(6, 9, 'warung rizki', 'warungrizki@localhost', '827ccb0eea8a706c4c34a16891f84e7b', 'user', ''),
(7, 10, 'warung khalid', 'warungkhalid@localhost', '827ccb0eea8a706c4c34a16891f84e7b', 'user', 'sgv9aigo4q29cv44pgtr3scm8jo6l8jj');

-- --------------------------------------------------------

--
-- Table structure for table `warung`
--

CREATE TABLE `warung` (
  `id` int(11) NOT NULL,
  `nama_warung` varchar(100) NOT NULL,
  `pajak_perhari` int(11) NOT NULL,
  `total_terjual` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `foto` varchar(225) NOT NULL,
  `alamat` text NOT NULL,
  `kontak` varchar(100) NOT NULL,
  `modify` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `warung`
--

INSERT INTO `warung` (`id`, `nama_warung`, `pajak_perhari`, `total_terjual`, `tanggal`, `keterangan`, `foto`, `alamat`, `kontak`, `modify`) VALUES
(8, 'warung rifqi', 0, 0, '2022-02-01', 'warung serba 1000', 'http://localhost/aplikasikasir/assets/upload/warung/image1.jpg', 'mampang jakarta selatan', '0987654321', '2022-01-02'),
(9, 'warung rizki', 0, 0, '2022-06-01', 'warung serba 2000', 'http://localhost/aplikasikasir/assets/upload/warung/image2.jpg', 'kebayoran baru jakarta selatan', '0987654321', '2022-01-02'),
(10, 'warung khalid', 0, 0, '2026-02-03', 'warung serba 3000', 'http://localhost/aplikasikasir/assets/upload/warung/image3.jpg', 'pulo gadung jakarta timur', '0987654321', '2022-01-02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_barang_keluar`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_barang_masuk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `warung`
--
ALTER TABLE `warung`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id_barang_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id_barang_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `warung`
--
ALTER TABLE `warung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
