-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 19, 2025 at 10:52 PM
-- Server version: 10.11.14-MariaDB-cll-lve
-- PHP Version: 8.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bear7685_jagain`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `lokasi_id` int(11) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `pegawai_id` int(11) NOT NULL,
  `nilai` tinyint(2) NOT NULL,
  `respon` text DEFAULT NULL,
  `layanan` tinyint(1) NOT NULL DEFAULT 0,
  `imbalan` tinyint(1) NOT NULL DEFAULT 0,
  `waktu_rekam` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `nama`, `lokasi_id`, `telepon`, `pegawai_id`, `nilai`, `respon`, `layanan`, `imbalan`, `waktu_rekam`) VALUES
(3, 'Faisal', 13, '082298553307', 5, 5, 'Terima kasih atas bantuannya dan kinerjanya', 1, 1, '2025-04-28 00:52:18'),
(4, 'Kumoro', 3, '085256385449', 7, 5, 'terima kasih atas layanan yang diberikan', 1, 1, '2025-05-15 06:58:08'),
(5, 'Louis Rombe Pasang ', 9, '085299792395', 8, 5, 'Pemeriksaan Kapal LPG HONG JIN ', 1, 1, '2025-05-20 02:42:07'),
(6, 'Louis Rombe Pasang ', 9, '085299792395', 8, 5, 'Pemeriksaan Kapal LPG HONG JIN ', 1, 1, '2025-05-20 02:43:18'),
(7, 'Ashari Sugiman', 7, '081242426272', 9, 5, '', 1, 1, '2025-05-22 05:41:36'),
(8, 'Ashari Sugiman', 7, '081242426272', 9, 5, '', 1, 1, '2025-05-22 05:42:17'),
(9, 'Ashari Sugiman ', 7, '081242426272', 10, 5, '', 1, 1, '2025-05-31 17:10:08'),
(10, 'Louis Rombe Pasang ', 9, '085299792395', 13, 5, 'Pemeriksaan Kapal LPG/C Pazifik ', 1, 1, '2025-06-02 06:31:56'),
(11, 'Louis Rombe Pasang ', 9, '085299792395', 12, 5, 'Pemeriksaan Kapal LPG/C Pazifik ', 1, 1, '2025-06-02 06:32:31'),
(12, 'Kumoro Ardwiwinata', 7, '085256385449', 15, 5, 'Pelayanan sangat baik ', 1, 1, '2025-06-10 19:10:36'),
(13, 'Louis Rombe Pasang ', 9, '085299792395', 15, 5, 'Pemeriksaan Sarana Pengangkut kapal LPG Gas Quantum ', 1, 1, '2025-06-11 06:25:10'),
(14, 'Lois', 9, '085299792395', 18, 5, '', 1, 1, '2025-06-23 08:30:54'),
(15, 'Riza ', 1, '081331543374', 19, 5, 'terima kasih atas pelayanan yang diberikan dengan baik', 1, 1, '2025-06-25 06:10:22'),
(16, 'Ashari Sugiman', 7, '081242426272', 20, 5, '', 1, 1, '2025-06-29 07:21:20'),
(17, 'William Limarjo', 13, '081219761988', 21, 5, 'Pelayanan yang diberikan sangat baik', 1, 1, '2025-07-03 08:37:09'),
(18, 'Yunan Dahlan', 9, '082292820640', 22, 5, 'Sangat teliti', 1, 1, '2025-07-10 03:56:08'),
(19, 'Yunan dahlan', 9, '082292820640', 22, 5, 'Sangat baik', 1, 1, '2025-07-10 03:58:27'),
(20, 'Louis Rombe Pasang ', 9, '085299792395', 22, 5, 'Pelayanan kapal LPG Gas Quantum ', 1, 1, '2025-07-10 04:00:39'),
(21, 'Ashari Sugiman ', 7, '081242426272', 24, 5, '', 1, 1, '2025-07-17 02:24:54'),
(22, 'Ashari Sugiman ', 7, '081242426272', 23, 5, '', 1, 1, '2025-07-17 02:25:15'),
(23, 'Louis Rombe Pasang ', 9, '085299792395', 26, 5, 'Pemeriksaan Kapal Gas. Innovator', 1, 1, '2025-07-29 09:14:48'),
(24, 'Louis Rombe Pasang ', 9, '085299792395', 27, 5, 'Pemeriksaan Kapal Gas Innovator ', 1, 1, '2025-07-29 09:15:45');

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
(93, '197803112000011002', 'Mohammad Ardiansyah'),
(95, '197805121999031001', 'Mustamiruddin'),
(100, '198606202007011001', 'Muhammad Fiqri Ridwan'),
(103, '199905152021011001', 'Baginda Mulia Siregar'),
(104, '199906012021011001', 'Ahmad Avisena'),
(108, '199507162015021003', 'Al Fauzan Prima Rizkynanda'),
(109, '199505142015121001', 'Fiqhi Sapdil Muhammad'),
(110, '200001162019121001', 'Erikson Kusuma Wijaya'),
(111, '200005022019121002', 'Hafizh Maulana Fahri'),
(112, '200008142019121002', 'Arya Liberta Arrafi'),
(113, '200105232019121001', 'Hifnie Zaidan Wafi A'),
(114, '200006132021012001', 'Maulinda Dewi Anggraeni'),
(115, '200012082021012001', 'Friska Miranti Aulia Budhi'),
(116, '200110062021012001', 'Shavira Devi Kusuma'),
(117, '198605032006021003', 'I Putu Permana Putra'),
(118, '197510052005011001', 'Abdul Talib'),
(120, '198306232002121004', 'Thomas Edi Purwanto'),
(121, '199509102015021001', 'Muh Arifiansyah'),
(122, '198703182015021003', 'Tommy Putra Wijaya'),
(123, '197703271998031001', 'Ricki Ronald Michel Rumbewas');

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
(3, 'PT. Donggi Senoro', 'PT. Donggi Senoro'),
(4, 'PT. SEGER AGRO NUSANTARA', 'PT. SEGER AGRO NUSANTARA'),
(5, 'PT. MEDCO E&P TOMORI ', 'PT. MEDCO E&P TOMORI '),
(7, 'PT. Pertamina Trans Kontinental', 'PT. Pertamina Trans Kontinental'),
(8, 'PT. Meratus Line', 'PT. Meratus Line'),
(9, 'PT. Pelayaran Nasional Indonesia', 'PT. Pelayaran Nasional Indonesia'),
(10, 'PT. Banggai Indo Gemilang\r\n', 'PT. Banggai Indo Gemilang\r\n'),
(11, 'PT. Bumi Sarana Utama', 'PT. Bumi Sarana Utama'),
(12, 'PT. Indotropic Fishery', 'PT. Indotropic Fishery'),
(13, 'Di Luar Perusahaan', 'Di Luar Perusahaan'),
(34, 'Bootzoeking Kapal', 'Luar Luwuk'),
(35, 'Patroli Darat', 'Luar Kantor');

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

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `nip`, `nama`, `telepon`, `lokasi`, `catatan`, `layanan`, `imbalan`, `waktu_rekam`) VALUES
(5, '199505142015121001', 'Fiqhi Sapdil Muhammad', '08114199515', 'Di Luar Perusahaan', 'Lokasi pendampingan pemeriksaan pada cluster 2 JOB Pertamina-Medco EP Tomori atas perusahaan PT Baker Hughes Indonesia ', 1, 1, '2025-04-28 00:50:40'),
(6, '199509102015021001', 'Muh Arifiansyah', '085255171273', 'PT. Donggi Senoro', 'Pemeriksaan Sarana Pengangkut Kapal MT LNG Maleo', 1, 1, '2025-05-14 08:17:06'),
(7, '198606202007011001', 'Muhammad Fiqri Ridwan', '085341016667', 'PT. Donggi Senoro', 'pengawasan pemuatan barang eskpor curah di luar kawasan pabean', 1, 1, '2025-05-15 06:57:28'),
(8, '198703182015021003', 'Tommy Putra Wijaya', '085324104321', 'PT. Panca Amara Utama', 'Boatzoeking MT Hong Jin China ', 1, 1, '2025-05-20 02:33:07'),
(9, '199509102015021001', 'Muh Arifiansyah', '085255171273', 'Bootzoeking Kapal', 'Pemeriksaan kapal (boatzoeking) LNG Grace Barleria 22 Mei 2025', 1, 1, '2025-05-22 02:02:45'),
(10, '200105232019121001', 'Hifnie Zaidan Wafi A', '085156703690', 'PT. Donggi Senoro', 'Melakukan Buka Tutup Segel di Pelabuhan LNG', 1, 1, '2025-05-31 13:26:52'),
(11, '200005022019121002', 'Hafizh Maulana Fahri', '081385524100', 'Bootzoeking Kapal', 'kegiatan pemeriksaan berjalan dengan lancar tanpa adanya kendala', 1, 1, '2025-06-01 05:39:43'),
(12, '200005022019121002', 'Hafizh Maulana Fahri', '081385524100', 'PT. Panca Amara Utama', 'kegiatan pemeriksaan sarana pengangkut berjalan dengan lancar tanpa ada kendala', 1, 1, '2025-06-02 04:45:48'),
(13, '200105232019121001', 'Hifnie Zaidan Wafi A', '085156703690', 'PT. Panca Amara Utama', 'Melakukan pemeriksaan sarana pengangkut Pazifik', 1, 1, '2025-06-02 06:29:38'),
(14, '200105232019121001', 'Hifnie Zaidan Wafi A', '085156703690', 'PT. Donggi Senoro', 'Telah dilakukan pemeriksaan terhadap sarana pengangkut K.Jasmine pada tanggal 9 Juni 2025', 1, 1, '2025-06-09 00:59:25'),
(15, '200105232019121001', 'Hifnie Zaidan Wafi A', '085156703690', 'PT. Donggi Senoro', 'Melakukan pemeriksaan terhadap sarana pengangkut K Jasmine', 1, 1, '2025-06-10 18:59:51'),
(16, '200105232019121001', 'Hifnie Zaidan Wafi A', '085156703690', 'PT. Donggi Senoro', 'Melakukan pemeriksaan terhadap sarana pengangkut K Jasmine', 1, 1, '2025-06-10 18:59:51'),
(17, '200105232019121001', 'Hifnie Zaidan Wafi A', '085156703690', 'PT. Panca Amara Utama', 'Melakukan pemeriksaan sarana pengangkut LPG/C Gas Quantum pada tanggal 10 juni 2025 ', 1, 1, '2025-06-11 04:47:43'),
(18, '199509102015021001', 'Muh Arifiansyah', '085255171273', 'PT. Panca Amara Utama', 'Pemeriksaan Sarana Pengangkut (Boatzoeking) MV Pazifik', 1, 1, '2025-06-23 08:29:47'),
(19, '198606202007011001', 'Muhammad Fiqri Ridwan', '085341016667', 'PT. Panca Amara Utama', 'Pengawasan muat barang ekspor di luar kawasan pabean berjalan lancar.', 1, 1, '2025-06-25 06:07:39'),
(20, '200005022019121002', 'Hafizh Maulana Fahri', '081385524100', 'Bootzoeking Kapal', 'kegiatan berjalan dengan lancar dan tidak ditemukan pelanggaran', 1, 1, '2025-06-29 06:43:16'),
(21, '198606202007011001', 'Muhammad Fiqri Ridwan', '085341016667', 'Di Luar Perusahaan', 'Pemeriksaan lokasi tempat usaha penyalur MMEA PT Mujur Putra Perkasa, dalam rangka permohonan perpanjangan NPPBKC', 1, 1, '2025-07-03 08:35:50'),
(22, '198703182015021003', 'Tommy Putra Wijaya', '085324104321', 'PT. Panca Amara Utama', 'Pemeriksaan kapal MT Gas Quantum', 1, 1, '2025-07-10 03:49:10'),
(23, '198703182015021003', 'Tommy Putra Wijaya', '085324104321', 'PT. Panca Amara Utama', 'Boatzoeking kapal MT LNG Maleo', 1, 1, '2025-07-17 02:18:27'),
(24, '200105232019121001', 'Hifnie Zaidan Wafi A', '085156703690', 'PT. Donggi Senoro', 'Telah melakukan pemeriksaan kepabeanan terhadap kapal LNG Maleo', 1, 1, '2025-07-17 02:19:53'),
(25, '199507162015021003', 'Al Fauzan Prima Rizkynanda', '081273542257', 'PT. Panca Amara Utama', 'Melakukan pemeriksaan sarana pengangkut laut (boatzoeking) MT LPG/C Pazifik', 1, 1, '2025-07-17 02:33:18'),
(26, '199509102015021001', 'Muh Arifiansyah', '085255171273', 'PT. Panca Amara Utama', 'Pemeriksaan Sarana Pengangkut LPG/C Gas Inovator 29 Juli 2025', 1, 1, '2025-07-29 08:58:47'),
(27, '197703271998031001', 'Ricki Ronald Michel Rumbewas', '081284951443', 'PT. Panca Amara Utama', 'Pemeriksaan Sarana Pengangkut LPG/C Gas Inovator 29 Juli 2025', 1, 1, '2025-07-29 09:09:46'),
(28, '197510052005011001', 'Abdul Talib', '081340621425', 'Bootzoeking Kapal', 'Pemeriksaan berjalan normal,dokumen lengkap,dan tidak di temukan adanya barang lartas', 1, 1, '2025-08-22 08:20:33'),
(29, '197510052005011001', 'Abdul Talib', '085242843019', 'Bootzoeking Kapal', 'Pemeriksaan terhadap kapal LNG Maleo serta dokumen kelengkapan dan tidak di temukan barsng Lartas di atas kapal', 1, 1, '2025-08-22 08:31:55'),
(30, '200005022019121002', 'Hafizh Maulana Fahri', '081385524100', 'PT. Donggi Senoro', 'Pemeriksaan kapal berjalan dengan lancar dan tidak ditemukan pelanggaran', 1, 1, '2025-09-10 03:03:50'),
(31, '197510052005011001', 'Abdul Talib', '081340621425', 'PT. Panca Amara Utama', 'pemeriksaan Sarkut boadsoeking di PAU dan tidak menemukan barang2 yg melanggar undang2 ke Pabeanan ', 1, 1, '2025-09-18 21:46:08');

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
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idx_waktu_rekam` (`waktu_rekam`),
  ADD KEY `fk_customer_lokasi` (`lokasi_id`),
  ADD KEY `fk_customer_pegawai` (`pegawai_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `data_pegawai`
--
ALTER TABLE `data_pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `data_perusahaan`
--
ALTER TABLE `data_perusahaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `fk_customer_lokasi` FOREIGN KEY (`lokasi_id`) REFERENCES `data_perusahaan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_customer_pegawai` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
