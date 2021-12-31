-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2021 at 11:23 AM
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
(5, 5, 2, 'Silver Queen', 30000, 100, 'Jangan rusak ya', 'http://localhost/aplikasikasir/assets/upload/foto/ib-440x125-Webbanner.jpg', '2021-12-31'),
(6, 5, 2, 'Silver Queen', 30000, 50, 'Jangan rusak ya', 'http://localhost/aplikasikasir/assets/upload/foto/ib-440x125-Webbanner.jpg', '2021-12-31');

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
(2, 5, 'Silver Queen', 30000, 100, 'Jangan rusak ya', 'http://localhost/aplikasikasir/assets/upload/foto/ib-440x125-Webbanner.jpg', '2021-12-31', 2);

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
(4, 5, '2', 'Silver Queen', 30000, 50, 'Jangan rusak ya', 'http://localhost/aplikasikasir/assets/upload/foto/ib-440x125-Webbanner.jpg', '2021-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`) VALUES
(1, 'Rizsky Darmawan', 'admin@localhost.com', '21232f297a57a5a743894a0e4a801fc3');

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
(1, 'Gajah Tunggal', 10000, 2, '2021-12-27', 'fknekfnkcnkscn', 'http://localhost/aplikasikasir/assets/upload/warung/profil-andre.jpg', 'nwfkwnfwkfnwkfnwk', '0909smnsknck', '2021-12-28'),
(3, 'Gajah Tunggal', 10000, 2, '2021-12-31', 'fknekfnkcnkscn', 'http://localhost/aplikasikasir/assets/upload/warung/profil-usman.jpeg', 'nwfkwnfwkfnwkfnwk', '0909smnsknck', '2021-12-29'),
(5, 'warung serba guna', 87000000, 1209090, '2021-01-01', 'keterangan', 'http://localhost/aplikasikasir/assets/upload/warung/profil-naufal.jpg', 'ciputat', 'kontak', '2021-12-29');

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
  MODIFY `id_barang_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id_barang_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `warung`
--
ALTER TABLE `warung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
