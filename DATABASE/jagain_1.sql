-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2023 at 06:11 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jagain`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `nilai` tinyint(1) NOT NULL,
  `pegawai` varchar(100) NOT NULL,
  `layanan` tinyint(1) NOT NULL DEFAULT 0,
  `imbalan` tinyint(1) NOT NULL DEFAULT 0,
  `waktu_rekam` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_pegawai`
--

CREATE TABLE `data_pegawai` (
  `id` int(11) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_pegawai`
--

INSERT INTO `data_pegawai` (`id`, `nip`, `nama`) VALUES
(1, '197803112000011002', 'Mohammad Ardiansyah'),
(2, '197808022000011001', 'Sonny Agustinus'),
(3, '197805121999031001', 'Mustamiruddin'),
(4, '197510052005011001', 'Abdul Talib'),
(5, '197703271998031001', 'Ricki Ronald Michel\nRumbewas'),
(6, '199004072014021001', 'Ardal'),
(7, '199104132010121002', 'Agung Wijaya S'),
(8, '198606202007011001', 'Muhammad Fiqri Ridwan'),
(9, '199712102021011001', 'Luthfi Faqih Pratama'),
(10, '199812112021011001', 'Hatta Khoiruka'),
(11, '199905152021011001', 'Baginda Mulia Siregar'),
(12, '199906012021011001', 'Ahmad Avisena'),
(13, '199906092021011001', 'Rizky Tanri Bali Ginting'),
(14, '199906112021011001', 'Pande Putu Ary Mahendra'),
(15, '200005152022011001', 'Pangeran Abdi Negara'),
(16, '199507162015021003', 'Al Fauzan Prima Rizkynanda'),
(17, '199505142015121001', 'Fiqhi Sapdil Muhammad'),
(18, '200001162019121001', 'Erikson Kusuma Wijaya'),
(19, '200005022019121002', 'Hafizh Maulana Fahri'),
(20, '200008142019121002', 'Arya Liberta Arrafi'),
(21, '200105232019121001', 'Hifnie Zaidan Wafi A'),
(22, '200006132021012001', 'Maulinda Dewi Anggraeni'),
(23, '200012082021012001', 'Friska Miranti Aulia Budhi'),
(24, '200110062021012001', 'Shavira Devi Kusuma'),
(25, '198605032006021003', 'I Putu Permana Putra');

-- --------------------------------------------------------

--
-- Table structure for table `data_perusahaan`
--

CREATE TABLE `data_perusahaan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_perusahaan`
--

INSERT INTO `data_perusahaan` (`id`, `nama`, `lokasi`) VALUES
(1, 'PT. Panca Amara Utama', 'PT. Panca Amara Utama'),
(2, 'PT. SASL & SONS INDONESIA', 'PT. SASL & SONS INDONESIA'),
(3, 'PT. Donggi Senoro', 'PT. Donggi Senoro');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `catatan` text NOT NULL,
  `layanan` tinyint(1) NOT NULL DEFAULT 0,
  `imbalan` tinyint(1) NOT NULL DEFAULT 0,
  `waktu_rekam` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','atasan','pegawai','customer') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'admin_user', '$2y$10$K1jAFVUo9EX9EUbZh0jpjOSFZMD092LLjXmIFMPrzXQq7Qqtsd7ri', 'admin', '2023-11-07 11:02:28'),
(2, 'atasan_user', '$2y$10$K1jAFVUo9EX9EUbZh0jpjOSFZMD092LLjXmIFMPrzXQq7Qqtsd7ri', 'atasan', '2023-11-07 11:02:28'),
(3, 'pegawai_user', '$2y$10$K1jAFVUo9EX9EUbZh0jpjOSFZMD092LLjXmIFMPrzXQq7Qqtsd7ri', 'pegawai', '2023-11-07 11:02:28'),
(4, 'customer_user', '$2y$10$K1jAFVUo9EX9EUbZh0jpjOSFZMD092LLjXmIFMPrzXQq7Qqtsd7ri', 'customer', '2023-11-07 11:02:28'),
(5, 'pengusaha', '$2y$10$K1jAFVUo9EX9EUbZh0jpjOSFZMD092LLjXmIFMPrzXQq7Qqtsd7ri', 'customer', '2023-11-07 11:02:28'),
(6, 'pegawai', '$2y$10$K1jAFVUo9EX9EUbZh0jpjOSFZMD092LLjXmIFMPrzXQq7Qqtsd7ri', 'pegawai', '2023-11-07 11:02:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `data_pegawai`
--
ALTER TABLE `data_pegawai`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `data_perusahaan`
--
ALTER TABLE `data_perusahaan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `data_pegawai`
--
ALTER TABLE `data_pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `data_perusahaan`
--
ALTER TABLE `data_perusahaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
