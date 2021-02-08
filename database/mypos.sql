-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2021 at 02:44 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mypos`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_customer`
--

CREATE TABLE `tb_customer` (
  `id_cust` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `phone` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_customer`
--

INSERT INTO `tb_customer` (`id_cust`, `nama`, `jk`, `phone`, `alamat`, `created`, `updated`) VALUES
(1, 'Vira', 'P', '08598778777', 'Kp. Pasir Sereh', '2021-02-01 19:56:06', '0000-00-00 00:00:00'),
(5, 'Yola Cantik', 'P', '085798777417', 'Kp. Pasir Sereh', '2021-02-01 20:37:23', '0000-00-00 00:00:00'),
(12, 'Viera', 'P', '081245635788', 'Kp. Puyeung', '2021-02-07 14:58:13', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_item`
--

CREATE TABLE `tb_item` (
  `id_item` int(11) NOT NULL,
  `barcode` varchar(100) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `id_kat` int(11) NOT NULL,
  `id_unit` int(11) NOT NULL,
  `hrg` int(11) DEFAULT NULL,
  `stok` int(10) NOT NULL DEFAULT 0,
  `img` varchar(100) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_item`
--

INSERT INTO `tb_item` (`id_item`, `barcode`, `nama`, `id_kat`, `id_unit`, `hrg`, `stok`, `img`, `created`, `updated`) VALUES
(1, '8993988703006', 'Kerupuk', 1, 3, 12000, 9, 'item-210207-e9234966de.png', '2021-02-02 17:50:18', '2021-02-07 04:49:12'),
(7, '5156416537', 'Yasmin', 3, 1, 1200, 30, 'item-210202-270934a1ed.png', '2021-02-02 21:34:14', '2021-02-03 01:42:58'),
(9, '8998667300781', 'Siladex', 2, 2, 15000, 5, 'item-210203-0fa1889c07.png', '2021-02-03 08:58:05', NULL),
(17, '8993113011051', 'OBH Combi', 1, 1, 15000, 5, 'item-210207-94164cdc9b.png', '2021-02-07 11:51:37', NULL),
(18, '8991002103238', 'Kopi Good Day Merah', 8, 11, 12000, 10, 'item-210207-96e189deb6.jpg', '2021-02-07 15:08:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kat` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kat`, `nama`, `created`, `updated`) VALUES
(1, 'Makanan Ringan', '2021-02-02 07:38:51', '2021-02-06 10:07:53'),
(2, 'Sayuran', '2021-02-02 07:39:05', '2021-02-06 10:42:09'),
(3, 'Rokok', '2021-02-02 20:15:05', '2021-02-06 12:00:38'),
(5, 'Air Aqua', '2021-02-07 10:55:50', NULL),
(6, 'Gorengan', '2021-02-07 14:58:37', NULL),
(7, 'Elektronik', '2021-02-07 14:59:35', NULL),
(8, 'Kopi', '2021-02-07 15:06:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_sale`
--

CREATE TABLE `tb_sale` (
  `id_sale` int(11) NOT NULL,
  `inv` varchar(50) NOT NULL,
  `id_cust` int(11) DEFAULT NULL,
  `hrg_total` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `hrg_all` int(11) NOT NULL,
  `cash` int(11) NOT NULL,
  `remaining` int(11) NOT NULL,
  `note` text NOT NULL,
  `tgl` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_stok`
--

CREATE TABLE `tb_stok` (
  `id_stok` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `tipe` enum('in','out') NOT NULL,
  `detail` varchar(200) NOT NULL,
  `id_supp` int(11) DEFAULT NULL,
  `qty` int(10) NOT NULL,
  `tgl` date NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_stok`
--

INSERT INTO `tb_stok` (`id_stok`, `id_item`, `tipe`, `detail`, `id_supp`, `qty`, `tgl`, `created`, `user_id`) VALUES
(9, 1, 'in', 'geas', 1, 30, '2021-02-07', '2021-02-07 11:21:05', 5),
(10, 17, 'in', 'Obat Batuk Berdahak', 1, 5, '2021-02-07', '2021-02-07 11:52:19', 5),
(11, 18, 'in', 'Asli Kopi Bujangan', 1, 15, '2021-02-07', '2021-02-07 15:10:04', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tb_stokout`
--

CREATE TABLE `tb_stokout` (
  `id_stokout` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `tipe` enum('in','out') NOT NULL,
  `info` varchar(100) NOT NULL,
  `qty` int(10) NOT NULL,
  `tgl` date NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_stokout`
--

INSERT INTO `tb_stokout` (`id_stokout`, `id_item`, `tipe`, `info`, `qty`, `tgl`, `created`, `user_id`) VALUES
(11, 1, 'out', 'Rusak', 1, '2021-02-07', '2021-02-07 13:39:53', 5),
(12, 18, 'out', 'Kadaluarsa', 5, '2021-02-07', '2021-02-07 15:11:00', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tb_supplier`
--

CREATE TABLE `tb_supplier` (
  `id_supp` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_supplier`
--

INSERT INTO `tb_supplier` (`id_supp`, `nama`, `phone`, `alamat`, `deskripsi`, `created`, `updated`) VALUES
(1, 'Toko Oliviann', '085798777417', 'Kp. Cimapag Girang', 'Toko Permen', '2021-02-01 14:21:34', '2021-02-06 10:51:47'),
(10, 'Agnes Monica', '08754125622', 'Kp. Keueuk', 'Anu Bahenol Tea', '2021-02-07 14:57:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_unit`
--

CREATE TABLE `tb_unit` (
  `id_unit` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_unit`
--

INSERT INTO `tb_unit` (`id_unit`, `nama`, `created`, `updated`) VALUES
(1, 'Lusin', '2021-02-02 08:32:29', '0000-00-00 00:00:00'),
(2, 'Gram', '2021-02-02 08:32:51', '0000-00-00 00:00:00'),
(3, 'Pack', '2021-02-02 08:33:02', '0000-00-00 00:00:00'),
(5, 'Kilogram', '2021-02-02 09:53:29', NULL),
(6, 'Pcs', '2021-02-02 09:53:59', NULL),
(7, 'Bungkus', '2021-02-02 20:15:46', NULL),
(10, 'Gulung', '2021-02-07 15:04:34', NULL),
(11, 'Renceng', '2021-02-07 15:06:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `level` int(1) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `username`, `pass`, `nama`, `alamat`, `level`, `foto`) VALUES
(1, 'holid', '7dd5a28bf6cb295049869e7b5b1546f5dac57760', 'holid', 'Kp. Pasir sereh', 2, 'holid.jpg'),
(5, 'yola', 'a9573217994b9a6b35bce220e5a670a86a2b8b4f', 'Yola Yosanta', 'Kp. Pasir sereh', 1, 'yola.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_customer`
--
ALTER TABLE `tb_customer`
  ADD PRIMARY KEY (`id_cust`);

--
-- Indexes for table `tb_item`
--
ALTER TABLE `tb_item`
  ADD PRIMARY KEY (`id_item`),
  ADD UNIQUE KEY `barcode` (`barcode`),
  ADD KEY `id_kat` (`id_kat`),
  ADD KEY `id_unit` (`id_unit`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kat`);

--
-- Indexes for table `tb_sale`
--
ALTER TABLE `tb_sale`
  ADD PRIMARY KEY (`id_sale`);

--
-- Indexes for table `tb_stok`
--
ALTER TABLE `tb_stok`
  ADD PRIMARY KEY (`id_stok`),
  ADD KEY `id_item` (`id_item`),
  ADD KEY `id_supp` (`id_supp`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tb_stokout`
--
ALTER TABLE `tb_stokout`
  ADD PRIMARY KEY (`id_stokout`),
  ADD KEY `id_item` (`id_item`),
  ADD KEY `id_supp` (`info`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  ADD PRIMARY KEY (`id_supp`);

--
-- Indexes for table `tb_unit`
--
ALTER TABLE `tb_unit`
  ADD PRIMARY KEY (`id_unit`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_customer`
--
ALTER TABLE `tb_customer`
  MODIFY `id_cust` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_item`
--
ALTER TABLE `tb_item`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_sale`
--
ALTER TABLE `tb_sale`
  MODIFY `id_sale` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_stok`
--
ALTER TABLE `tb_stok`
  MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_stokout`
--
ALTER TABLE `tb_stokout`
  MODIFY `id_stokout` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  MODIFY `id_supp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_unit`
--
ALTER TABLE `tb_unit`
  MODIFY `id_unit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_item`
--
ALTER TABLE `tb_item`
  ADD CONSTRAINT `tb_item_ibfk_1` FOREIGN KEY (`id_kat`) REFERENCES `tb_kategori` (`id_kat`),
  ADD CONSTRAINT `tb_item_ibfk_2` FOREIGN KEY (`id_unit`) REFERENCES `tb_unit` (`id_unit`);

--
-- Constraints for table `tb_stok`
--
ALTER TABLE `tb_stok`
  ADD CONSTRAINT `tb_stok_ibfk_2` FOREIGN KEY (`id_item`) REFERENCES `tb_item` (`id_item`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_stok_ibfk_3` FOREIGN KEY (`id_supp`) REFERENCES `tb_supplier` (`id_supp`),
  ADD CONSTRAINT `tb_stok_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `tb_user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
