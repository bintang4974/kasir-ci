-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 08, 2021 at 12:31 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos-ci`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `harga_barang` varchar(255) NOT NULL,
  `stok_barang` varchar(100) NOT NULL,
  `foto_barang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`id_barang`, `nama_barang`, `harga_barang`, `stok_barang`, `foto_barang`) VALUES
(7, 'Citato', '15000', '49', 'citato.png'),
(8, 'Pepsodent', '20000', '49', 'pepsodent.png'),
(10, 'Rexona', '25000', '47', 'rexona.jpg'),
(12, 'Indomie Goreng', '2500', '47', 'citato6.png'),
(13, 'Bolognaise', '25000', '50', 'citato7.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice`
--

CREATE TABLE `tbl_invoice` (
  `id` int(11) NOT NULL,
  `waktu_pesan` datetime NOT NULL,
  `total_harga` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_invoice`
--

INSERT INTO `tbl_invoice` (`id`, `waktu_pesan`, `total_harga`) VALUES
(12, '2021-07-03 19:49:12', '65000'),
(13, '2021-07-03 19:52:28', '65000'),
(14, '2021-07-03 21:05:32', '40000'),
(15, '2021-07-04 12:36:02', '45000'),
(16, '2021-07-04 21:00:47', '45000'),
(17, '2021-07-04 21:01:58', '45000'),
(18, '2021-07-04 21:05:24', '45000'),
(19, '2021-07-05 15:50:01', '45000'),
(20, '2021-07-05 15:52:03', '27500');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pesanan`
--

CREATE TABLE `tbl_pesanan` (
  `id` int(11) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_barang` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pesanan`
--

INSERT INTO `tbl_pesanan` (`id`, `id_invoice`, `id_barang`, `nama_barang`, `jumlah`, `harga_barang`, `total_bayar`, `kembalian`) VALUES
(11, 12, 11, 'kokocrunch', 1, 20000, 70000, 5000),
(12, 13, 11, 'kokocrunch', 1, 20000, 70000, 5000),
(13, 13, 10, 'Rexona', 1, 25000, 70000, 5000),
(14, 13, 8, 'Pepsodent', 1, 20000, 70000, 5000),
(15, 14, 11, 'kokocrunch', 1, 20000, 50000, 10000),
(16, 14, 8, 'Pepsodent', 1, 20000, 50000, 10000),
(17, 15, 10, 'Rexona', 1, 25000, 50000, 5000),
(18, 15, 8, 'Pepsodent', 1, 20000, 50000, 5000),
(21, 18, 10, 'Rexona', 1, 25000, 50000, 5000),
(22, 18, 8, 'Pepsodent', 1, 20000, 50000, 5000),
(23, 19, 12, 'Indomie Goreng', 2, 2500, 50000, 5000),
(24, 19, 10, 'Rexona', 1, 25000, 50000, 5000),
(25, 19, 7, 'Citato', 1, 15000, 50000, 5000),
(26, 20, 12, 'Indomie Goreng', 1, 2500, 30000, 2500),
(27, 20, 10, 'Rexona', 1, 25000, 30000, 2500);

--
-- Triggers `tbl_pesanan`
--
DELIMITER $$
CREATE TRIGGER `pesanan_penjualan` AFTER INSERT ON `tbl_pesanan` FOR EACH ROW BEGIN
	UPDATE tbl_barang SET stok_barang = stok_barang-NEW.jumlah
    WHERE id_barang = NEW.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nomor_telepon` varchar(25) NOT NULL,
  `foto_user` varchar(255) NOT NULL,
  `hak_akses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama_user`, `username`, `password`, `nomor_telepon`, `foto_user`, `hak_akses`) VALUES
(1, 'Bintang Ramadhan', 'bintang4974', '12345678', '081358965041', 'profile.png', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
