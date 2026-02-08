-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2026 at 03:16 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `customer2024`
--

CREATE TABLE `customer2024` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `lokasi_id` int(11) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `pegawai_id` int(11) NOT NULL,
  `nilai` tinyint(2) NOT NULL,
  `respon` text DEFAULT NULL,
  `layanan` tinyint(1) NOT NULL DEFAULT 0,
  `imbalan` tinyint(1) NOT NULL DEFAULT 0,
  `waktu_rekam` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `customer2024`
--

INSERT INTO `customer2024` (`id`, `nama`, `lokasi_id`, `telepon`, `pegawai_id`, `nilai`, `respon`, `layanan`, `imbalan`, `waktu_rekam`) VALUES
(1, 'Louis Rombe Pasang', 1, '8111111111', 1, 5, 'Terima kasih', 1, 1, '2024-01-03 07:50:07'),
(2, 'Ashari Sugiman', 3, '8222222222', 2, 5, 'Cepat', 1, 1, '2024-01-04 05:18:57'),
(3, 'Ashari Sugiman', 3, '8333333333', 3, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-01-10 04:07:43'),
(4, 'Ashari Sugiman', 3, '8444444444', 4, 5, 'Sangat Baik', 1, 1, '2024-01-12 04:48:32'),
(5, 'Ashari Sugiman', 3, '8555555555', 5, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-01-13 02:42:55'),
(6, 'Louis Rombe Pasang', 1, '8666666666', 6, 5, 'Cepat', 1, 1, '2024-01-20 02:46:25'),
(7, 'Ashari Sugiman', 3, '8777777777', 7, 5, 'Cepat', 1, 1, '2024-01-20 09:13:28'),
(8, 'Dslng Terminal', 3, '8888888888', 8, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-01-23 04:52:53'),
(9, 'Dslng Terminal', 3, '8999999999', 9, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-01-22 02:09:23'),
(10, 'Kumoro Ardwiwinata', 3, '9111111110', 10, 5, 'Cepat', 1, 1, '2024-01-30 05:38:15'),
(11, 'Ashari Sugiman', 3, '9222222221', 11, 5, 'Cepat', 1, 1, '2024-01-31 09:13:55'),
(12, 'Kumoro Ardwiwinata', 5, '9333333332', 12, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-02-01 08:55:06'),
(13, 'Kumoro Ardwiwinata', 14, '9444444443', 13, 5, 'Cepat', 1, 1, '2024-01-31 07:01:00'),
(14, 'Ashari Sugiman', 3, '9555555554', 14, 5, 'Sangat Baik', 1, 1, '2024-02-02 04:52:43'),
(15, 'Kumoro Ardwiwinata', 14, '9666666665', 15, 5, 'Terima kasih', 1, 1, '2024-02-07 08:52:39'),
(16, 'Ashari Sugiman', 3, '9777777776', 16, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-02-08 03:26:14'),
(17, 'Ashari Sugiman', 3, '9888888887', 17, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-02-08 09:14:38'),
(18, 'Ashari Sugiman', 3, '9999999998', 18, 5, 'Sangat Baik', 1, 1, '2024-02-18 07:45:35'),
(19, 'Louis Rombe Pasang', 1, '10111111109', 19, 5, 'Cepat', 1, 1, '2024-02-19 02:59:17'),
(20, 'Louis Rombe Pasang', 1, '10222222220', 20, 5, 'Cepat', 1, 1, '2024-02-24 07:32:47'),
(21, 'Kumoro Ardwiwinata', 3, '10333333331', 21, 5, 'Cepat', 1, 1, '2024-02-26 05:46:53'),
(22, 'Dayad Madjid', 2, '10444444442', 22, 5, 'Cepat', 1, 1, '2024-02-25 09:04:05'),
(23, 'Kumoro Ardwiwinata', 3, '10555555553', 23, 5, 'Sangat Baik', 1, 1, '2024-02-26 03:00:20'),
(24, 'Kumoro Ardwiwinata', 3, '10666666664', 24, 5, 'Terima kasih', 1, 1, '2024-02-26 02:15:05'),
(25, 'Kumoro Ardwiwinata', 13, '10777777775', 25, 5, 'Sangat Baik', 1, 1, '2024-03-05 09:40:02'),
(26, 'Ashari Sugiman', 3, '10888888886', 26, 5, 'Cepat', 1, 1, '2024-03-05 07:33:40'),
(27, 'Louis Rombe Pasang', 1, '10999999997', 27, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-03-07 09:35:23'),
(28, 'Ashari Sugiman', 3, '11111111108', 28, 5, 'Terima kasih', 1, 1, '2024-03-13 02:48:03'),
(29, 'Louis Rombe Pasang', 1, '11222222219', 29, 5, 'Sangat Baik', 1, 1, '2024-03-14 05:48:22'),
(30, 'Dayad Madjid', 2, '11333333330', 30, 5, 'Sangat Baik', 1, 1, '2024-03-15 03:14:53'),
(31, 'Ashari Sugiman', 3, '11444444441', 31, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-03-23 05:34:54'),
(32, 'Kumoro Ardwiwinata', 3, '11555555552', 32, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-03-29 08:54:53'),
(33, 'Ashari Sugiman', 3, '11666666663', 33, 5, 'Cepat', 1, 1, '2024-04-01 07:56:12'),
(34, 'Ashari Sugiman', 3, '11777777774', 34, 5, 'Cepat', 1, 1, '2024-04-02 05:41:56'),
(35, 'Ashari Sugiman', 3, '11888888885', 35, 5, 'Terima kasih', 1, 1, '2024-04-03 06:23:49'),
(36, 'Ashari Sugiman', 3, '11999999996', 36, 5, 'Terima kasih', 1, 1, '2024-04-03 04:32:22'),
(37, 'Louis Rombe Pasang', 1, '12111111107', 37, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-04-07 04:32:41'),
(38, 'Louis Rombe Pasang', 1, '12222222218', 38, 5, 'Sangat Baik', 1, 1, '2024-04-11 08:20:47'),
(39, 'Ashari Sugiman', 3, '12333333329', 39, 5, 'Cepat', 1, 1, '2024-04-09 08:06:26'),
(40, 'Ashari Sugiman', 3, '12444444440', 40, 5, 'Terima kasih', 1, 1, '2024-04-19 05:37:02'),
(41, 'Ashari Sugiman', 3, '12555555551', 41, 5, 'Terima kasih', 1, 1, '2024-04-20 02:06:07'),
(42, 'Louis Rombe Pasang', 10, '12666666662', 42, 5, 'Terima kasih', 1, 1, '2024-04-28 08:45:56'),
(43, 'Ashari Sugiman', 3, '12777777773', 43, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-04-27 03:45:14'),
(44, 'Louis Rombe Pasang', 1, '12888888884', 44, 5, 'Terima kasih', 1, 1, '2024-04-26 07:28:51'),
(45, 'Ashari Sugiman', 3, '12999999995', 45, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-04-27 07:49:36'),
(46, 'Louis Rombe Pasang', 1, '13111111106', 46, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-04-29 06:55:01'),
(47, 'Kumoro Ardwiwinata', 3, '13222222217', 47, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-04-30 03:11:53'),
(48, 'Louis Rombe Pasang', 1, '13333333328', 48, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-05-02 08:13:23'),
(49, 'Louis Rombe Pasang', 1, '13444444439', 49, 5, 'Terima kasih', 1, 1, '2024-05-01 07:32:20'),
(50, 'Kumoro Ardwiwinata', 5, '13555555550', 50, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-05-02 05:23:58'),
(51, 'Louis Rombe Pasang', 1, '13666666661', 51, 5, 'Cepat', 1, 1, '2024-05-06 06:46:15'),
(52, 'Ashari Sugiman', 3, '13777777772', 52, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-05-08 07:25:18'),
(53, 'Ashari Sugiman', 3, '13888888883', 53, 5, 'Terima kasih', 1, 1, '2024-05-12 03:44:00'),
(54, 'Louis Rombe Pasang', 1, '13999999994', 54, 5, 'Terima kasih', 1, 1, '2024-05-13 04:43:58'),
(55, 'Louis Rombe Pasang', 1, '14111111105', 55, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-05-15 06:30:53'),
(56, 'Louis Rombe Pasang', 1, '14222222216', 56, 5, 'Cepat', 1, 1, '2024-05-16 02:52:56'),
(57, 'Ashari Sugiman', 3, '14333333327', 57, 5, 'Sangat Baik', 1, 1, '2024-05-24 06:45:37'),
(58, 'Ashari Sugiman', 3, '14444444438', 58, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-05-30 08:47:32'),
(59, 'Ashari Sugiman', 3, '14555555549', 59, 5, 'Sangat Baik', 1, 1, '2024-05-27 07:29:57'),
(60, 'Louis Rombe Pasang', 1, '14666666660', 60, 5, 'Cepat', 1, 1, '2024-05-28 08:13:00'),
(61, 'Ashari Sugiman', 3, '14777777771', 61, 5, 'Sangat Baik', 1, 1, '2024-04-29 06:56:35'),
(62, 'Kumoro Ardwiwinata', 5, '14888888882', 62, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-05-28 05:23:48'),
(63, 'Louis Rombe Pasang', 1, '14999999993', 63, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-06-02 06:13:00'),
(64, 'Ashari Sugiman', 3, '15111111104', 64, 5, 'Sangat Baik', 1, 1, '2024-06-04 08:04:29'),
(65, 'Ashari Sugiman', 3, '15222222215', 65, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-06-04 03:49:30'),
(66, 'Ashari Sugiman', 3, '15333333326', 66, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-06-10 04:58:36'),
(67, 'Ashari Sugiman', 3, '15444444437', 67, 5, 'Sangat Baik', 1, 1, '2024-06-10 02:28:55'),
(68, 'Ashari Sugiman', 3, '15555555548', 68, 5, 'Sangat Baik', 1, 1, '2024-06-19 09:48:56'),
(69, 'Louis Rombe Pasang', 1, '15666666659', 69, 5, 'Sangat Baik', 1, 1, '2024-06-23 06:35:25'),
(70, 'Louis Rombe Pasang', 1, '15777777770', 70, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-06-23 03:49:28'),
(71, 'Ashari Sugiman', 3, '15888888881', 71, 5, 'Sangat Baik', 1, 1, '2024-06-24 04:18:03'),
(72, 'Kumoro Ardwiwinata', 3, '15999999992', 72, 5, 'Cepat', 1, 1, '2024-06-27 08:50:36'),
(73, 'Kumoro Ardwiwinata', 13, '16111111103', 73, 5, 'Terima kasih', 1, 1, '2024-06-29 06:25:56'),
(74, 'Kumoro Ardwiwinata', 5, '16222222214', 74, 5, 'Terima kasih', 1, 1, '2024-06-30 07:17:36'),
(75, 'Louis Rombe Pasang', 4, '16333333325', 75, 5, 'Sangat Baik', 1, 1, '2024-07-01 06:33:22'),
(76, 'Louis Rombe Pasang', 3, '16444444436', 76, 5, 'Sangat Baik', 1, 1, '2024-07-03 06:08:54'),
(77, 'Louis Rombe Pasang', 1, '16555555547', 77, 5, 'Terima kasih', 1, 1, '2024-07-07 05:44:27'),
(78, 'Ashari Sugiman', 3, '16666666658', 78, 5, 'Sangat Baik', 1, 1, '2024-07-09 02:58:00'),
(79, 'Louis Rombe Pasang', 1, '16777777769', 79, 5, 'Sangat Baik', 1, 1, '2024-07-11 03:31:14'),
(80, 'Ashari Sugiman', 3, '16888888880', 80, 5, 'Cepat', 1, 1, '2024-07-14 04:52:48'),
(81, 'PT Mujur Putra Perkasa Di Luwuk', 14, '16999999991', 81, 5, 'Cepat', 1, 1, '2024-07-15 08:34:55'),
(82, 'PT Maleo Luwuk Hotel Di Luwuk', 14, '17111111102', 82, 5, 'Cepat', 1, 1, '2024-07-15 09:06:06'),
(83, 'Pt. Parindo Jaya Oil Well Solutions', 13, '17222222213', 83, 5, 'Sangat Baik', 1, 1, '2024-07-19 04:17:38'),
(84, 'Ashari Sugiman', 3, '17333333324', 84, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-07-24 07:07:29'),
(85, 'Ashari Sugiman', 3, '17444444435', 85, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-07-27 03:47:39'),
(86, 'Diluar Kawasan Pabean', 13, '17555555546', 86, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-08-02 03:14:33'),
(87, 'Ashari Sugiman', 3, '17666666657', 87, 5, 'Sangat Baik', 1, 1, '2024-08-31 08:46:02'),
(88, 'Kumoro Ardwiwinata', 5, '17777777768', 88, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-07-31 07:39:01'),
(89, 'Kumoro Ardwiwinata', 5, '17888888879', 89, 5, 'Cepat', 1, 1, '2024-08-04 09:22:15'),
(90, 'Louis Rombe Pasang', 1, '17999999990', 90, 5, 'Cepat', 1, 1, '2024-08-04 09:57:54'),
(91, 'Louis Rombe Pasang', 1, '18111111101', 91, 5, 'Terima kasih', 1, 1, '2024-08-06 06:11:27'),
(92, 'Kecamatan Ampana Kota, Kabupaten Tojo Una-Una', 13, '18222222212', 92, 5, 'Terima kasih', 1, 1, '2024-08-10 06:44:46'),
(93, 'Ashari Sugiman', 3, '18333333323', 93, 5, 'Sangat Baik', 1, 1, '2024-08-10 05:37:30'),
(94, 'Kecamatan Ratolindo, Kabupaten Tojo Una-Una', 13, '18444444434', 94, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-08-12 08:18:16'),
(95, 'Louis Rombe Pasang', 1, '18555555545', 95, 5, 'Terima kasih', 1, 1, '2024-08-13 02:54:28'),
(96, 'Ashari Sugiman', 3, '18666666656', 96, 5, 'Sangat Baik', 1, 1, '2024-08-17 09:22:57'),
(97, 'Ashari Sugiman', 3, '18777777767', 97, 5, 'Terima kasih', 1, 1, '2024-08-18 08:31:50'),
(98, 'Louis Rombe Pasang', 1, '18888888878', 98, 5, 'Terima kasih', 1, 1, '2024-08-20 03:56:02'),
(99, 'Ashari Sugiman', 3, '18999999989', 99, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-08-27 02:43:03'),
(100, 'Ashari Sugiman', 3, '19111111100', 100, 5, 'Sangat Baik', 1, 1, '2024-08-27 08:51:43'),
(101, 'Louis Rombe Pasang', 1, '19222222211', 101, 5, 'Terima kasih', 1, 1, '2024-08-29 05:39:21'),
(102, 'Louis Rombe Pasang', 1, '19333333322', 102, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-08-29 06:44:03'),
(103, 'Ashari Sugiman', 3, '19444444433', 103, 5, 'Sangat Baik', 1, 1, '2024-09-01 04:22:41'),
(104, 'Ashari Sugiman', 3, '19555555544', 104, 5, 'Terima kasih', 1, 1, '2024-09-03 06:43:00'),
(105, 'Louis Rombe Pasang', 1, '19666666655', 105, 5, 'Cepat', 1, 1, '2024-09-12 04:24:24'),
(106, 'Ashari Sugiman', 3, '19777777766', 106, 5, 'Sangat Baik', 1, 1, '2024-09-16 06:08:29'),
(107, 'Ashari Sugiman', 3, '19888888877', 107, 5, 'Cepat', 1, 1, '2024-09-22 05:39:21'),
(108, 'Kumoro Ardwiwinata', 3, '19999999988', 108, 5, 'Terima kasih', 1, 1, '2024-09-27 03:51:22'),
(109, 'Louis Rombe Pasang', 1, '20111111099', 109, 5, 'Sangat Baik', 1, 1, '2024-10-06 05:10:00'),
(110, 'Kumoro Ardwiwinata', 3, '20222222210', 110, 5, 'Cepat', 1, 1, '2024-10-18 04:15:57'),
(111, 'Louis Rombe Pasang', 1, '20333333321', 111, 5, 'Terima kasih', 1, 1, '2024-10-23 05:36:44'),
(112, 'Louis Rombe Pasang', 1, '20444444432', 112, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-10-22 02:27:16'),
(113, 'Kabupaten Tojo Una-Una', 13, '20555555543', 113, 5, 'Cepat', 1, 1, '2024-10-23 06:48:31'),
(114, 'Louis Rombe Pasang', 1, '20666666654', 114, 5, 'Sangat Baik', 1, 1, '2024-10-23 06:40:54'),
(115, 'Kumoro Ardwiwinata', 3, '20777777765', 115, 5, 'Sangat Baik', 1, 1, '2024-10-29 05:24:59'),
(116, 'Kumoro Ardwiwinata', 1, '20888888876', 116, 5, 'Sangat Baik', 1, 1, '2024-10-31 03:32:14'),
(117, 'Kumoro Ardwiwinata', 3, '20999999987', 117, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-11-08 03:13:15'),
(118, 'Kumoro Ardwiwinata', 3, '21111111098', 118, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-11-10 08:05:20'),
(119, 'Louis Rombe Pasang', 1, '21222222209', 119, 5, 'Cepat', 1, 1, '2024-11-11 07:13:39'),
(120, 'Louis Rombe Pasang', 1, '21333333320', 120, 5, 'Sangat Baik', 1, 1, '2024-11-12 04:34:09'),
(121, 'Louis Rombe Pasang', 1, '21444444431', 121, 5, 'Terima kasih', 1, 1, '2024-11-15 07:56:55'),
(122, 'Kumoro Ardwiwinata', 3, '21555555542', 122, 5, 'Cepat', 1, 1, '2024-11-16 09:38:27'),
(123, 'Kumoro Ardwiwinata', 3, '21666666653', 123, 5, 'Cepat', 1, 1, '2024-11-15 02:36:31'),
(124, 'Kumoro Ardwiwinata', 5, '21777777764', 124, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-11-17 09:10:01'),
(125, 'Ashari Sugiman', 3, '21888888875', 125, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-11-17 09:18:16'),
(126, 'Ashari Sugiman', 3, '21999999986', 126, 5, 'Cepat', 1, 1, '2024-11-25 08:14:23'),
(127, 'Kumoro Ardwiwinata', 3, '22111111097', 127, 5, 'Sangat Baik', 1, 1, '2024-11-27 05:38:00'),
(128, 'Louis Rombe Pasang', 1, '22222222208', 128, 5, 'Terima kasih', 1, 1, '2024-12-01 04:31:30'),
(129, 'Kumoro Ardwiwinata', 3, '22333333319', 129, 5, 'Sangat Baik', 1, 1, '2024-12-04 03:47:13'),
(130, 'Louis Rombe Pasang', 1, '22444444430', 130, 5, 'Sangat Baik', 1, 1, '2024-12-10 05:49:30'),
(131, 'Ashari Sugiman', 3, '22555555541', 131, 5, 'Sangat Baik', 1, 1, '2024-12-12 07:05:34'),
(132, 'Dayad Madjid', 2, '22666666652', 132, 5, 'Sangat Baik', 1, 1, '2024-12-20 08:19:23'),
(133, 'Louis Rombe Pasang', 1, '22777777763', 133, 5, 'Terima kasih', 1, 1, '2024-12-20 03:05:08'),
(134, 'Louis Rombe Pasang', 1, '22888888874', 134, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-12-21 03:11:59'),
(135, 'Ashari Sugiman', 3, '22999999985', 135, 5, 'Terima kasih', 1, 1, '2024-12-21 04:41:43'),
(136, 'Louis Rombe Pasang', 1, '23111111096', 136, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-12-28 03:58:28'),
(137, 'Kumoro Ardwiwinata', 3, '23222222207', 137, 5, 'Cepat', 1, 1, '2024-12-29 06:20:38'),
(138, 'Ashari Sugiman', 3, '23333333318', 138, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2024-12-29 09:11:14'),
(139, 'Ashari Sugiman', 3, '23444444429', 139, 5, 'Sangat Baik', 1, 1, '2025-01-08 07:20:44'),
(140, 'Ashari Sugiman', 3, '23555555540', 140, 5, 'Sangat Baik', 1, 1, '2025-01-09 04:41:16'),
(141, 'Dayad Madjid', 2, '23666666651', 141, 5, 'Terima kasih', 1, 1, '2025-01-10 02:57:56'),
(142, 'Ashari Sugiman', 3, '23777777762', 142, 5, 'Terima kasih', 1, 1, '2025-01-17 06:35:29'),
(143, 'Kumoro Ardwiwinata', 5, '23888888873', 143, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2025-01-17 09:44:56'),
(144, 'Louis Rombe Pasang', 1, '23999999984', 144, 5, 'Sangat Baik', 1, 1, '2025-01-24 08:58:56'),
(145, 'Louis Rombe Pasang', 10, '24111111095', 145, 5, 'Cepat', 1, 1, '2025-01-24 08:59:17'),
(146, 'Louis Rombe Pasang', 10, '24222222206', 146, 5, 'Terima kasih', 1, 1, '2025-01-31 06:58:29'),
(147, 'Louis Rombe Pasang', 13, '24333333317', 147, 5, 'Sangat Baik', 1, 1, '2025-02-04 02:04:34'),
(148, 'Louis Rombe Pasang', 10, '24444444428', 148, 5, 'Sangat Baik', 1, 1, '2025-02-06 07:38:38'),
(149, 'Ashari Sugiman', 3, '24555555539', 149, 5, 'Sangat Baik', 1, 1, '2025-02-07 05:54:27'),
(150, 'Dayad Madjid', 2, '24666666650', 150, 5, 'Cepat', 1, 1, '2025-02-08 07:21:23'),
(151, 'Ashari Sugiman', 3, '24777777761', 151, 5, 'Sangat Baik', 1, 1, '2025-02-16 03:41:25'),
(152, 'Louis Rombe Pasang', 1, '24888888872', 152, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2025-02-17 05:52:48'),
(153, 'Dayad Madjid', 2, '24999999983', 153, 5, 'Cepat', 1, 1, '2025-02-17 06:43:38'),
(154, 'Louis Rombe Pasang', 1, '25111111094', 154, 5, 'Terima kasih', 1, 1, '2025-03-08 06:09:17'),
(155, 'Ashari Sugiman', 3, '25222222205', 155, 5, 'Cepat', 1, 1, '2025-03-08 07:26:11'),
(156, 'Kumoro Ardwiwinata', 3, '25333333316', 156, 5, 'Terima kasih', 1, 1, '2025-03-10 09:00:03'),
(157, 'Louis Rombe Pasang', 1, '25444444427', 157, 5, 'Terima kasih', 1, 1, '2025-03-15 09:57:37'),
(158, 'Ashari Sugiman', 3, '25555555538', 158, 5, 'Terima kasih', 1, 1, '2025-03-18 04:02:02'),
(159, 'Ashari Sugiman', 3, '25666666649', 159, 5, 'Terima kasih', 1, 1, '2025-04-16 09:40:43'),
(160, 'Kumoro Ardwiwinata', 13, '25777777760', 160, 5, 'Terima kasih atas layanan yang diberikan', 1, 1, '2025-04-24 07:35:50'),
(161, 'Ashari Sugiman', 3, '25888888871', 161, 5, 'Sangat Baik', 1, 1, '2025-04-24 04:39:17');

-- --------------------------------------------------------

--
-- Table structure for table `data_pegawai`
--

CREATE TABLE `data_pegawai` (
  `id` int(11) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `telepon` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_pegawai`
--

INSERT INTO `data_pegawai` (`id`, `nip`, `nama`, `telepon`) VALUES
(1, '197803112000011002', 'Mohammad Ardiansyah', '081291904209'),
(2, '197805121999031001', 'Mustamiruddin', '081340019916'),
(3, '198606202007011001', 'Muhammad Fiqri Ridwan', '085341016667'),
(4, '199905152021011001', 'Baginda Mulia Siregar', '082213601823'),
(5, '199906012021011001', 'Ahmad Avisena', '081233658605'),
(7, '199505142015121001', 'Fiqhi Sapdil Muhammad', '08114199515'),
(8, '200001162019121001', 'Erikson Kusuma Wijaya', '082231177786'),
(9, '200005022019121002', 'Hafizh Maulana Fahri', '081385524100'),
(11, '200105232019121001', 'Hifnie Zaidan Wafi A', '085156703690'),
(12, '200006132021012001', 'Maulinda Dewi Anggraeni', '085256728518'),
(13, '200012082021012001', 'Friska Miranti Aulia Budhi', '085651126091'),
(14, '200110062021012001', 'Shavira Devi Kusuma', '081229349049'),
(15, '198605032006021003', 'I Putu Permana Putra', '087877619986'),
(16, '197510052005011001', 'Abdul Talib', '081340621425'),
(17, '198306232002121004', 'Thomas Edi Purwanto', '081344999803'),
(18, '199509102015021001', 'Muh Arifiansyah', '085255171273'),
(19, '198703182015021003', 'Tommy Putra Wijaya', '085324104321'),
(20, '197703271998031001', 'Ricki Ronald Michel Rumbewas', '081284951443'),
(21, '197310231994021001', 'Mu\'amar Khadafi', '08159389381'),
(22, '197808022000011001', 'Sonny Agustinus', '081213561223'),
(23, '197601132005011001', 'Iwan Hartawan', '081393334437'),
(25, '199104132010121002', 'Agung Wijaya', '081244446226'),
(26, '199712102021011001', 'Luthfi Faqih Pratama', '081390118066'),
(27, '199812112021011001', 'Hatta Khoiruka', '085799420004'),
(28, '199906092021011001', 'Rizky Tanri Bali Ginting', '081210740197'),
(29, '199906112021011001', 'Pande Putu Ary Mahendra', '081310160545'),
(30, '200005152022011001', 'Pangeran Abdi Negara', '081357594032'),
(31, '199907292018122001', 'Dinda Alfiati Kuncoro', '081333986897'),
(32, '199507162015021003', 'Al Fauzan Prima Rizkynanda', '081211004346'),
(33, '200008142019121002', 'Arya Liberta Arrafi', '082312768454'),
(34, '199004072014021001', 'Ardal', '085395890766');

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
-- Table structure for table `pegawai2024`
--

CREATE TABLE `pegawai2024` (
  `id` int(11) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `catatan` text NOT NULL,
  `layanan` tinyint(1) NOT NULL DEFAULT 0,
  `imbalan` tinyint(1) NOT NULL DEFAULT 0,
  `waktu_rekam` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `pegawai2024`
--

INSERT INTO `pegawai2024` (`id`, `nip`, `nama`, `telepon`, `lokasi`, `catatan`, `layanan`, `imbalan`, `waktu_rekam`) VALUES
(1, '20000611 202101 1 00', 'Pangeran Abdi Negara', '081357594032', 'PT. Panca Amara Utama', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-01-03 00:06:20'),
(2, '19990611 202101 1 00', 'Baginda Mulia Siregar', '082213601823', 'PT. Donggi Senoro LNG', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-01-04 02:16:17'),
(3, '2000061 3202101 2 00', 'Maulinda Dewi Anggraeni', '085256728518', 'PT. Donggi Senoro LNG', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-01-10 01:11:10'),
(4, '19950716 201512 1 00', 'Al Fauzan Prima Rizkynanda', '081211004346', 'PT. Donggi Senoro LNG', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-01-12 00:59:57'),
(5, '19990601 202101 1 00', 'Ahmad Avisena', '081233658605', 'PT. Donggi Senoro LNG', 'Melakukan pengawasan muatan barang ekspor di luar kawasan pabean', 1, 1, '2024-01-13 00:24:17'),
(6, '2000061 3202101 2 00', 'Maulinda Dewi Anggraeni', '085256728518', 'PT. Panca Amara Utama', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-01-20 02:57:49'),
(7, '19950716 201512 1 00', 'Al Fauzan Prima Rizkynanda', '081211004346', 'PT. Donggi Senoro LNG', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-01-20 02:38:33'),
(8, '19860620 200701 1 00', 'Muhammad Fiqri Ridwan', '085341016667', 'DSLNG Terminal', 'Pengawasan pemuatan barang ekspor di Luar Kawasan Pabean', 1, 1, '2024-01-23 02:53:46'),
(9, '19990601 202101 1 00', 'Ahmad Avisena', '081233658605', 'DSLNG Terminal', 'Pengawasan pemuatan barang ekspor di Luar Kawasan Pabean', 1, 1, '2024-01-22 02:43:50'),
(10, '19990611 202101 1 00', 'Baginda Mulia Siregar', '082213601823', 'Marine Senoro JOB', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-01-30 03:57:27'),
(11, '19990611 202101 1 00', 'Baginda Mulia Siregar', '082213601823', 'PT. Donggi Senoro LNG', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-01-31 02:39:20'),
(12, '19860620 200701 1 00', 'Muhammad Fiqri Ridwan', '085341016667', 'PT. MEDCO E&P TOMORI SULAWESI', 'Melaksanakan pengawasan pemuatan barang ekspor di luar Kawasan Pabean', 1, 1, '2024-02-01 00:17:05'),
(13, '20000611 202101 1 00', 'Pangeran Abdi Negara', '081357594032', 'Terminal Pelabuhan Luwuk', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-01-31 03:12:56'),
(14, '19860620 200701 1 00', 'Muhammad Fiqri Ridwan', '085341016667', 'PT. Donggi Senoro LNG', 'Melaksanakan pengawasan pemuatan barang ekspor di luar Kawasan Pabean', 1, 1, '2024-02-02 03:10:26'),
(15, '19910413 201012 1 00', 'Agung Wijaya', '081244446226', 'Terminal Pelabuhan Luwuk', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-02-07 00:57:50'),
(16, '19751005 200501 1 00', 'Abdul Thalib', '081340621425', 'PT. Donggi Senoro LNG', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-02-08 00:38:55'),
(17, '19950716 201512 1 00', 'Al Fauzan Prima Rizkynanda', '081211004346', 'PT. Donggi Senoro LNG', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-02-08 02:16:11'),
(18, '19990601 202101 1 00', 'Ahmad Avisena', '081233658605', 'PT. Donggi Senoro LNG', 'Melaksanakan Pengawasan Muat Barang Ekspor di Luar Kawasan Pabean', 1, 1, '2024-02-18 01:23:02'),
(19, '19860620 200701 1 00', 'Muhammad Fiqri Ridwan', '085341016667', 'PT. Panca Amara Utama', 'Pengawasan Pemuatan Barang Ekspor Di Luar Kawasan Pabean', 1, 1, '2024-02-19 03:34:21'),
(20, '19950716 201512 1 00', 'Al Fauzan Prima Rizkynanda', '081211004346', 'PT. Panca Amara Utama', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-02-24 00:53:44'),
(21, '19910413 201012 1 00', 'Agung Wijaya', '081244446226', 'DSLNG Terminal', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-02-26 00:46:16'),
(22, '19990601 202101 1 00', 'Ahmad Avisena', '081233658605', 'PT. SASL SONS Indonesia', 'Melaksanakan Pengawasan Kegiatan Bongkar di Luar Kawasan Pabean', 1, 1, '2024-02-25 02:56:45'),
(23, '2000061 3202101 2 00', 'Maulinda Dewi Anggraeni', '085256728518', 'DSLNG Terminal', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking),', 1, 1, '2024-02-26 03:08:32'),
(24, '19990611 202101 1 00', 'Baginda Mulia Siregar', '082213601823', 'Marine Senoro JOB', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking),', 1, 1, '2024-02-26 03:24:00'),
(25, '19950716 201512 1 00', 'Al Fauzan Prima Rizkynanda', '081211004346', 'Pelabuhan Tangkian', 'Melakukan pembukaan segel peti kemas atas barang impor yang dibongkar di tempat lain selain Kawasan Pabean', 1, 1, '2024-03-05 00:49:47'),
(26, '19990601 202101 1 00', 'Ahmad Avisena', '081233658605', 'PT. Donggi Senoro LNG', 'Melaksanakan Pengawasan Kegiatan Bongkar di Luar Kawasan Pabean', 1, 1, '2024-03-05 03:22:16'),
(27, '19751005 200501 1 00', 'Abdul Thalib', '081340621425', 'PT. Panca Amara Utama', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-03-07 00:45:43'),
(28, '2000061 3202101 2 00', 'Maulinda Dewi Anggraeni', '085256728518', 'PT. Donggi Senoro LNG', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-03-13 02:06:29'),
(29, '19860620 200701 1 00', 'Muhammad Fiqri Ridwan', '085341016667', 'PT. Panca Amara Utama', 'Melaksanakan Pengawasan pemuatan barang ekspor di Luar Kawasan Pabean', 1, 1, '2024-03-14 00:38:39'),
(30, '19860620 200701 1 00', 'Muhammad Fiqri Ridwan', '085341016667', 'PT. SASL & SONS INDONESIA', 'Melaksanakan Pengawasan pemuatan barang ekspor di Luar Kawasan Pabean', 1, 1, '2024-03-15 02:00:54'),
(31, '19910413 201012 1 00', 'Agung Wijaya', '081244446226', 'PT. Donggi Senoro LNG', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-03-23 03:52:51'),
(32, '19990611 202101 1 00', 'Baginda Mulia Siregar', '082213601823', 'Terminal Marine Senoro JOB', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-03-29 01:04:24'),
(33, '19950716 201512 1 00', 'Al Fauzan Prima Rizkynanda', '081211004346', 'PT. Donggi Senoro LNG', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-04-01 00:55:15'),
(34, '19990611 202101 1 00', 'Baginda Mulia Siregar', '082213601823', 'PT. Donggi Senoro LNG', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-04-02 00:42:46'),
(35, '19860620 200701 1 00', 'Muhammad Fiqri Ridwan', '085341016667', 'PT. Donggi Senoro LNG', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-04-03 02:04:07'),
(36, '19990601 202101 1 00', 'Ahmad Avisena', '081233658605', 'PT. Donggi Senoro LNG', 'Melaksanakan Pengawasan Muat Barang Ekspor di Luar Kawasan Pabean', 1, 1, '2024-04-03 03:37:41'),
(37, '19990611 202101 1 00', 'Pande Putu Ary Mahendra', '081310160545', 'PT. Panca Amara Utama', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-04-07 00:04:47'),
(38, '19860620 200701 1 00', 'Muhammad Fiqri Ridwan', '085341016667', 'PT. Panca Amara Utama', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-04-11 03:56:30'),
(39, '19860621 200701 1 00', 'Muhammad Fiqri Ridwan', '085341016667', 'PT. Donggi Senoro LNG', 'Melaksanakan pengawasan pemuatan barang ekspor di luar Kawasan Pabean', 1, 1, '2024-04-09 00:34:04'),
(40, '19990515 202101 1 00', 'Baginda Mulia Siregar', '082213601823', 'PT. Donggi Senoro LNG', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-04-19 02:51:01'),
(41, '19990515 202101 1 00', 'Baginda Mulia Siregar', '082213601823', 'PT. Donggi Senoro LNG', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-04-20 03:34:27'),
(42, '19990602 202101 1 00', 'Ahmad Avisena', '081233658605', 'PT. Bumi Sarana Utama', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-04-28 02:20:41'),
(43, '19860621 200701 1 00', 'Muhammad Fiqri Ridwan', '085341016667', 'PT. Donggi Senoro LNG', 'Melaksanakan pengawasan pemuatan barang ekspor di luar Kawasan Pabean', 1, 1, '2024-04-27 02:46:53'),
(44, '19860621 200701 1 00', 'Muhammad Fiqri Ridwan', '085341016667', 'PT. Panca Amara Utama', 'Melaksanakan pengawasan pemuatan barang ekspor di luar Kawasan Pabean', 1, 1, '2024-04-26 00:47:25'),
(45, '19990515 202101 1 00', 'Baginda Mulia Siregar', '082213601823', 'PT. Donggi Senoro LNG', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-04-27 03:37:06'),
(46, '19910413 201012 1 00', 'Agung Wijaya', '081244446226', 'PT. Panca Amara Utama', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-04-29 01:53:04'),
(47, '19990515 202101 1 00', 'Baginda Mulia Siregar', '082213601823', 'Terminal JOB MEDCO SENORO', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-04-30 02:42:18'),
(48, '19950716 201502 1 00', 'Al Fauzan Prima Rizkynanda', '081211004346', 'PT. PAnca Amara Utama', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-05-02 03:50:44'),
(49, '19990601 202101 1 00', 'Ahmad Avisena', '081233658605', 'PT. PAnca Amara Utama', 'Melaksanakan pengawasan pemuatan barang ekspor di luar Kawasan Pabean', 1, 1, '2024-05-01 02:55:44'),
(50, '19990601 202101 1 00', 'Ahmad Avisena', '081233658605', 'MEDCO E&P TOMORI SULAWESI', 'Melaksanakan pengawasan pemuatan barang ekspor di luar Kawasan Pabean', 1, 1, '2024-05-02 00:49:47'),
(51, '20000116 201912 1 00', 'Erikson Kusuma Wijaya', '082231177786', 'PT. Panca Amara Utama', 'Melaksanakan pengawasan pemuatan barang ekspor di luar Kawasan Pabean', 1, 1, '2024-05-06 03:47:53'),
(52, '20000611 202101 1 00', 'Pangeran Abdi Negara', '081357594032', 'PT. Donggi Senoro LNG', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-05-08 01:40:23'),
(53, '19990601 202101 1 00', 'Ahmad Avisena', '081233658605', 'PT. Donggi Senoro LNG', 'Melaksanakan pengawasan pemuatan barang ekspor di luar Kawasan Pabean', 1, 1, '2024-05-12 01:03:09'),
(54, '19950716 201502 1 00', 'Al Fauzan Prima Rizkynanda', '081211004346', 'PT. Panca Amara Utama', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-05-13 01:53:16'),
(55, '19990601 202101 1 00', 'Ahmad Avisena', '081233658605', 'PT. Panca Amara Utama', 'Melaksanakan pengawasan pemuatan barang ekspor di luar Kawasan Pabean', 1, 1, '2024-05-15 03:25:07'),
(56, '19991211 202101 1001', 'Hatta Khoiruka', '085799420004', 'PT. Panca Amara Utama', 'Melaksanakan pengawasan pemuatan barang ekspor di luar Kawasan Pabean', 1, 1, '2024-05-16 02:44:59'),
(57, '19950716 201502 1 00', 'Al Fauzan Prima Rizkynanda', '081211004346', 'PT. Donggi Senoro LNG', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-05-24 01:23:52'),
(58, '19860620 200701 1 00', 'Muhammad Fiqri Ridwan', '085341016667', 'PT. Donggi Senoro LNG', 'Melaksanakan pengawasan pemuatan barang ekspor di luar Kawasan Pabean ', 1, 1, '2024-05-30 02:42:09'),
(59, '19990515 202101 1 00', 'Baginda Mulia Siregar', '082213601823', 'PT. Donggi Senoro LNG', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-05-27 02:51:19'),
(60, '19990601 202101 1 00', 'Ahmad Avisena', '081233658605', 'PT. Panca Amara Utama', 'Melaksanakan pengawasan pemuatan barang ekspor di luar Kawasan Pabean', 1, 1, '2024-05-28 03:18:24'),
(61, '19990602 202101 1 00', 'Ahmad Avisena', '081233658605', 'PT. Donggi Senoro LNG', 'Melaksanakan pengawasan pemuatan barang ekspor di luar Kawasan Pabean', 1, 1, '2024-04-29 00:16:11'),
(62, '19990515 202101 1 00', 'Baginda Mulia Siregar', '082213601823', 'PT. Pertamina-Medco E&P Tomori Sulawesi ', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-05-28 01:31:04'),
(63, '20000611 202101 1 00', 'Pangeran Abdi Negara', '081357594032', 'PT. Panca Amara Utama', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-06-02 03:12:24'),
(64, '19751005 200501 1 00', 'Abdul Thalib', '081340621425', 'PT. Donggi Senoro LNG', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-06-04 03:40:30'),
(65, '19860620 200701 1 00', 'Muhammad Fiqri Ridwan', '085341016667', 'PT. Donggi Senoro LNG', 'Melaksanakan pengawasan pemuatan barang ekspor di luar Kawasan Pabean', 1, 1, '2024-06-04 02:36:12'),
(66, '20000611 202101 1 00', 'Pangeran Abdi Negara', '081357594032', 'PT. Donggi Senoro LNG', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-06-10 01:31:43'),
(67, '19990515 202101 1 00', 'Baginda Mulia Siregar', '082213601823', 'PT. Donggi Senoro LNG', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-06-10 00:06:20'),
(68, '19860620 200701 1 00', 'Muhammad Fiqri Ridwan', '085341016667', 'PT. Donggi Senoro LNG', 'Melaksanakan pengawasan pemuatan barang ekspor di luar Kawasan Pabean', 1, 1, '2024-06-19 02:31:38'),
(69, '19990515 202101 1 00', 'Baginda Mulia Siregar', '082213601823', 'PT. Panca Amara Utama', 'Melaksanakan pengawasan pemuatan barang ekspor di luar Kawasan Pabean', 1, 1, '2024-06-23 00:30:14'),
(70, '19860620 200701 1 00', 'Muhammad Fiqri Ridwan', '085341016667', 'PT. Panca Amara Utama', 'Melaksanakan pengawasan pemuatan barang ekspor di luar Kawasan Pabean', 1, 1, '2024-06-23 00:36:54'),
(71, '20000613 202101 2 00', 'Maulinda Dewi Anggraeni', '085256728518', 'PT. Donggi Senoro LNG', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-06-24 00:05:14'),
(72, '19751005 200501 1 00', 'Abdul Thalib', '081340621425', 'PT. JOB Marine Senoro', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-06-27 01:39:20'),
(73, '19990609 202101 1 00', 'Rizky Tanri Bali Ginting', '081210740197', 'Pelabuhan Umum Mantangisi ', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-06-29 01:13:22'),
(74, '19990601 202101 1 00', 'Ahmad Avisena', '081233658605', 'PT. Medco E&P Tomori ', 'Melaksanakan pengawasan Pemuatan Barang Ekspor Di Luar Kawasan Pabean', 1, 1, '2024-06-30 02:59:44'),
(75, '19990602 202101 1 00', 'Ahmad Avisena', '081233658605', 'PT. Seger Agro Nusantara', 'Melaksanakan pengawasan Pemuatan Barang Ekspor Di Luar Kawasan Pabean ', 1, 1, '2024-07-01 02:00:24'),
(76, '19950716 201502 1 00', 'Al Fauzan Prima Rizkynanda', '081211004346', 'PT. Donggi Senoro LNG', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-07-03 00:27:39'),
(77, '19990601 202101 1 00', 'Ahmad Avisena', '081233658605', ' PT. Panca Amara Utama', 'Melaksanakan pengawasan Pemuatan Barang Ekspor Di Luar Kawasan Pabean', 1, 1, '2024-07-07 00:00:37'),
(78, '19860620 200701 1 00', 'Muhammad Fiqri Ridwan', '085341016667', 'PT. Donggi Senoro LNG', 'Melaksanakan pengawasan Pemuatan Barang Ekspor Di Luar Kawasan Pabean', 1, 1, '2024-07-09 03:59:31'),
(79, '19990515 202101 1 00', 'Baginda Mulia Siregar', '082213601823', 'PT. Panca Amara Utama', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-07-11 02:04:07'),
(80, '19950716 201502 1 00', 'Al Fauzan Prima Rizkynanda', '081211004346', 'PT. Donggi Senoro LNG', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-07-14 03:29:27'),
(81, '19860620 200701 1 00', 'Muhammad Fiqri Ridwan', '085341016667', 'PT Mujur Putra Perkasa di Luwuk', 'Melaksanakan Monitoring NPPBKC pada PT Bintang Mujur Sejati ', 1, 1, '2024-07-15 02:11:15'),
(82, '19860621 200701 1 00', 'Muhammad Fiqri Ridwan', '085341016667', 'PT Maleo Luwuk Hotel di Luwuk', 'Melaksanakan Monitoring NPPBKC pada PT Bhakasank Jaya Sentosa ', 1, 1, '2024-07-15 03:29:51'),
(83, '19950716 201502 1 00', 'Al Fauzan Prima Rizkynanda', '081211004346', 'PT. Parindo Jaya Oil Well Solutions', 'Melakukan bantuan pemeriksaan fisik barang impor sementara a.n. PT. Parindo Jaya Oil Well Solutions yang berlokasi di Pertamina EP Field Sulawesi, EWO-001', 1, 1, '2024-07-19 00:38:30'),
(84, '19950716 201502 1 00', 'Al Fauzan Prima Rizkynanda', '081211004346', 'PT. Donggi Senoro LNG', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-07-24 01:11:27'),
(85, '19990515 202101 1 00', 'Baginda Mulia Siregar', '082213601823', 'PT. Donggi Senoro LNG', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-07-27 01:43:08'),
(86, '19860621 200701 1 00', 'Muhammad Fiqri Ridwan', '085341016667', 'Diluar Kawasan Pabean', 'melaksanakan pengawasan pemuatan barang ekspor', 1, 1, '2024-08-02 01:43:27'),
(87, '20000613 202101 2 00', 'Maulinda Dewi Anggraeni', '085256728518', 'PT. Donggi Senoro LNG', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-08-31 03:44:42'),
(88, '19950716 201502 1 00', 'Al Fauzan Prima Rizkynanda', '081211004346', 'JOB E&P Tomori ', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-07-31 01:23:27'),
(89, '19860621 200701 1 00', 'Muhammad Fiqri Ridwan', '085341016667', 'PT. Pertamina Hulu Energi Tomori Sulawesi', 'Pemuatan Barang Ekspor Di Luar Kawasan Pabean', 1, 1, '2024-08-04 03:20:16'),
(90, '19990515 202101 1 00', 'Baginda Mulia Siregar', '082213601823', 'PT. Panca Amara Utama', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-08-04 03:56:07'),
(91, '19990602 202101 1 00', 'Ahmad Avisena', '081233658605', 'PT. Panca Amara Utama', 'Pemuatan Barang Ekspor Di Luar Kawasan Pabean', 1, 1, '2024-08-06 02:40:49'),
(92, '19770327 199803 1001', 'Ricky Ronald Michel Rumbewas', '081284951443', 'Kecamatan Ampana Kota, Kabupaten Tojo Una-Una', 'Melakukan pengawasan terhadap peredaran Barang Kena Cukai yang terindikasi ilegal ', 1, 1, '2024-08-10 02:21:31'),
(93, '19860621 200701 1 00', 'Muhammad Fiqri Ridwan', '085341016667', 'PT. Donggi Senoro LNG', 'Pemuatan Barang Ekspor Di Luar Kawasan Pabean', 1, 1, '2024-08-10 00:05:25'),
(94, '19770327 199803 1001', 'Ricky Ronald Michel Rumbewas', '081284951443', 'Kecamatan Ratolindo, Kabupaten Tojo Una-Una', 'Melakukan pengawasan terhadap peredaran Barang Kena Cukai (BKC)', 1, 1, '2024-08-12 03:59:13'),
(95, '19990515 202101 1 00', 'Baginda Mulia Siregar', '082213601823', 'PT. Panca Amara Utama', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-08-13 03:52:20'),
(96, '20000613 202101 2 00', 'Maulinda Dewi Anggraeni', '085256728518', 'PT. Donggi Senoro LNG', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-08-17 01:53:19'),
(97, '19860621 200701 1 00', 'Muhammad Fiqri Ridwan', '085341016667', 'PT. Donggi Senoro LNG', 'Pemuatan Barang Ekspor Di Luar Kawasan Pabean', 1, 1, '2024-08-18 02:24:55'),
(98, '19990515 202101 1 00', 'Baginda Mulia Siregar', '082213601823', 'PT. Panca Amara Utama', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-08-20 01:50:51'),
(99, '19950716 201502 1 00', 'Al Fauzan Prima Rizkynanda', '081211004346', 'PT. Donggi Senoro LNG', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-08-27 03:39:37'),
(100, '19860620 200701 1 00', 'Muhammad Fiqri Ridwan', '085341016667', 'PT. Donggi Senoro LNG', 'Pemuatan Barang Ekspor Di Luar Kawasan Pabean', 1, 1, '2024-08-27 03:16:07'),
(101, '19860620 200701 1 00', 'Muhammad Fiqri Ridwan', '085341016667', 'PT. Panca Amara Utama', 'Pengawasan Pemuatan Barang Ekspor Di Luar Kawasan Pabean', 1, 1, '2024-08-29 03:18:55'),
(102, '19990515 202101 1 00', 'Baginda Mulia Siregar', '082213601823', 'PT. Panca Amara Utama', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-08-29 03:41:19'),
(103, '19990609 202101 1 00', 'Baginda Mulia Siregar', '082213601823', 'PT. Donggi Senoro LNG', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-09-01 00:03:36'),
(104, '19990515 202101 1 00', 'Rizky Tanri Bali Ginting', '081210740197', 'PT. Donggi Senoro LNG', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-09-03 02:31:55'),
(105, '20000613 202101 2 00', 'Baginda Mulia Siregar', '082213601823', 'PT. Panca Amara Utama', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-09-12 00:00:58'),
(106, '19990515 202101 1 00', 'maulinda Dewi Anggraeni', '085256728518', 'PT. Donggi Senoro LNG', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-09-16 02:24:04'),
(107, '199950716 201502 1 0', 'Baginda Mulia Siregar', '082213601823', 'PT. Donggi Senoro LNG', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-09-22 02:58:20'),
(108, '19990515 202101 1 00', 'Baginda Mulia Siregar', '082213601823', 'Terminal Marine Senoro JOB', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-09-27 02:31:07'),
(109, '19870318 201502 1 00', 'Tommy Putra Wijaya', '085324104321', 'PT. Panca Amara Utama', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-10-06 00:42:11'),
(110, '19990515 202101 1 00', 'Baginda Mulia Siregar', '082213601823', 'PT. DS LNG', 'Melakukan pemeriksaan sarana pengangkut laut (boatzoeking)', 1, 1, '2024-10-18 01:41:27'),
(111, '19990611 202101 1 00', 'Pande Putu Ary Mahendra', '081310160545', 'PT. PAU', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-10-23 01:24:06'),
(112, '19860620 200701 1 00', 'Muhammad Fiqri Ridwan', '085341016667', 'PT. PAU', 'untuk melaksanakan pengawasan pemuatan barang ekspor di luar Kawasan Pabean', 1, 1, '2024-10-22 02:48:12'),
(113, '19751005 200501 1 00', 'Abdul Thalib', '081340621425', 'Kabupaten Tojo Una-Una', 'melakukan pengawasan terhadap peredaran Barang Kena Cukai (GEMPURII) serta melakukan penindakan jika ditemukan pelanggaran', 1, 1, '2024-10-23 02:06:57'),
(114, '19860503 200602 1 00', 'I Putu Permana Putra', '087877619986', 'PT. PANCA AMARA UTAMA', 'untuk melaksanakan pengawasan pemuatan barang ekspor diluar Kawasan Pabean', 1, 1, '2024-10-23 03:28:20'),
(115, '19870318 201502 1 00', 'Tommy Putra Wijaya', '085324104321', 'PT.Donggi Senoro LNG', 'untuk melakukan pemeriksaan sarana pengangkut laut (boatzoeking)', 1, 1, '2024-10-29 01:58:48'),
(116, '19860620 200701 1 00', 'Muhammad Fiqri Ridwan', '085341016667', 'PT. PANCA AMARA UTAMA', 'untuk melaksanakan pengawasan pemuatan barang ekspor di luar Kawasan Pabean', 1, 1, '2024-10-31 03:35:05'),
(117, '20000613 202101 2 00', 'Maulinda Dewi Anggraeni', '085256728518', 'PT.Donggi Senoro LNG', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-11-08 01:48:54'),
(118, '19860620 200701 1 00', 'Muhammad Fiqri Ridwan', '085341016667', ' PT. LNG', 'untuk melaksanakan pengawasan pemuatan barang ekspor di luar Kawasan Pabean', 1, 1, '2024-11-10 01:29:50'),
(119, '19990515 202101 1 00', 'Baginda Mulia Siregar', '082213601823', 'PT. PANCA AMARA UTAMA', 'melakukan pemeriksaan sarana pengangkut laut (boatzoeking)', 1, 1, '2024-11-11 02:31:21'),
(120, '19860620 200701 1 00', 'Muhammad Fiqri Ridwan', '085341016667', 'PT. PAU', 'untuk melaksanakan pengawasan pemuatan barang ekspor di luar Kawasan Pabean', 1, 1, '2024-11-12 01:58:53'),
(121, '19990609 202101 1 00', 'Rizky Tanri Bali Ginting', '081210740197', 'PT. PANCA AMARA UTAMA', 'melakukan pemeriksaan sarana pengangkut laut (boatzoeking)', 1, 1, '2024-11-15 00:35:20'),
(122, '19990515 202101 1 00', 'Baginda Mulia Siregar', '082213601823', 'Terminal Marine Senoro JOB', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2024-11-16 01:58:14'),
(123, '19870318 201502 1 00', 'Tommy Putra Wijaya', '085324104321', 'PT.Donggi Senoro LNG', 'melakukan pemeriksaan sarana pengangkut laut (boatzoeking)', 1, 1, '2024-11-15 03:21:35'),
(124, '19950514 201512 1 00', 'Fiqhi Sapdil Muhammad', '08114199515', 'PT. MEDCO E&P TOMORI SULAWESI', 'untuk melaksanakan pengawasan pemuatan barang ekspor di luar Kawasan Pabean', 1, 1, '2024-11-17 00:31:21'),
(125, '19860503 200602 1 00', 'I Putu Permana Putra', '087877619986', 'PT.Donggi Senoro LNG', 'untuk melaksanakan pengawasan pemuatan barang ekspor di luar Kawasan Pabean', 1, 1, '2024-11-17 03:21:27'),
(126, '19770327 199803 1 00', ' Ricky Ronald Michel Rumbewas', '081284951443', 'PT.Donggi Senoro LNG', 'melakukan pemeriksaan sarana pengangkut laut (boatzoeking)', 1, 1, '2024-11-25 00:05:37'),
(127, '19860620 200701 1 00', 'Muhammad Fiqri Ridwan', '085341016667', 'PT.Donggi Senoro LNG', 'untuk melaksanakan pengawasan pemuatan barang ekspor di luar Kawasan Pabean', 1, 1, '2024-11-27 00:40:03'),
(128, '199950716 201502 1 0', 'Al Fauzan Prima Rizkynanda', '081211004346', 'PT. PANCA AMARA UTAMA', 'melakukan pemeriksaan sarana pengangkut laut (boatzoeking)', 1, 1, '2024-12-01 01:24:30'),
(129, '19770327 199803 1 00', 'Ricky Ronald Michel Rumbewas', '081284951443', 'PT.Donggi Senoro LNG', 'melakukan pemeriksaan sarana pengangkut laut (boatzoeking)', 1, 1, '2024-12-04 01:04:01'),
(130, '19990515 202101 1 00', 'Baginda Mulia Siregar', '082213601823', 'PT. PANCA AMARA UTAMA', 'melakukan pemeriksaan sarana pengangkut laut (boatzoeking)', 1, 1, '2024-12-10 00:51:47'),
(131, '199950716 201502 1 0', 'Al Fauzan Prima Rizkynanda', '081211004346', 'PT.Donggi Senoro LNG', 'melakukan pemeriksaan sarana pengangkut laut (boatzoeking)', 1, 1, '2024-12-12 03:32:40'),
(132, '19860620 200701 1 00', 'Muhammad Fiqri Ridwan', '085341016667', 'PT. SASL & SONS INDONESIA', 'untuk melakukan pengawasan penimbunan barang impor di tempat lain yang diperlakukan sama dengan TPS / gudang importir', 1, 1, '2024-12-20 02:14:59'),
(133, '19990515 202101 1 00', 'Baginda Mulia Siregar', '082213601823', 'PT. PANCA AMARA UTAMA', 'melakukan pemeriksaan sarana pengangkut laut (boatzoeking)', 1, 1, '2024-12-20 00:43:54'),
(134, '19860620 200701 1 00', 'Muhammad Fiqri Ridwan', '085341016667', 'PT. PANCA AMARA UTAMA', 'untuk melaksanakan pengawasan pemuatan barang ekspor di luar Kawasan Pabean', 1, 1, '2024-12-21 02:39:37'),
(135, '199550910 201502 1 0', 'Muh Arifiansyah', '085255171273', 'PT.Donggi Senoro LNG', 'melakukan pemeriksaan sarana pengangkut laut (boatzoeking)', 1, 1, '2024-12-21 03:12:18'),
(136, '19990729 201812 2 00', 'Dinda Alfiati Kuncoro', '081333986897', 'PT. PANCA AMARA UTAMA', 'melakukan pemeriksaan sarana pengangkut laut (boatzoeking)', 1, 1, '2024-12-28 01:18:10'),
(137, '199550910 201502 1 0', 'Muh Arifiansyah', '085255171273', 'Terminal Marine Senoro JOB', 'melakukan pemeriksaan sarana pengangkut laut (boatzoeking)', 1, 1, '2024-12-29 03:23:05'),
(138, '19990515 202101 1 00', 'Baginda Mulia Siregar', '082213601823', 'terminal DSLNG SENORO', 'melakukan pemeriksaan sarana pengangkut laut (boatzoeking)', 1, 1, '2024-12-29 01:23:05'),
(139, '19870318 201502 1 00', 'Tommy Putra Wijaya', '085324104321', 'PT.Donggi Senoro LNG', 'melakukan pemeriksaan sarana pengangkut laut (boatzoeking)', 1, 1, '2025-01-08 02:24:15'),
(140, '19860620 200701 1 00', 'Muhammad Fiqri Ridwan', '085341016667', 'PT. Donggi Senoro LNG', 'melaksanakan pengawasan pemuatan barang ekspor di luar Kawasan Pabean', 1, 1, '2025-01-09 03:42:51'),
(141, '199550910 201502 1 0', 'Muh Arifiansyah', '085255171273', 'PT.SASLANDSONSINDONESIA,Kayutanyo, KabupatenBanggai ', 'melaksanakan tugas Pembukaan Segel atas Barang Impor ', 1, 1, '2025-01-10 02:01:12'),
(142, '19751005 200501 1 00', 'Abdul Thalib', '081340621425', 'PT. Donggi Senoro LNG', 'Melakukanpemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2025-01-17 01:23:51'),
(143, '19860620 200701 1 00', 'Muhammad Fiqri Ridwan', '085341016667', 'JOB–Pertamina Medco E&P Tomori Sulawesi (JOBTomori)', 'melakukan pemeriksaan fisik barang impor sementara ', 1, 1, '2025-01-17 03:18:52'),
(144, '19870318 201502 1 00', 'Tommy Putra Wijaya', '085324104321', 'PT.Panca Amara Utama', 'melakukan pemeriksaan sarana pengangkut laut (boatzoeking)', 1, 1, '2025-01-24 00:36:20'),
(145, '19770327 199803 1 00', 'Ricky Ronald Michel Rumbewas', '081284951443', 'MT Leo Asphalt', 'melakukan pemeriksaan sarana pengangkut laut (boatzoeking)', 1, 1, '2025-01-24 01:15:26'),
(146, '19860620 200701 1 00', 'Muhammad Fiqri Ridwan', '085341016667', 'Tangki Aspal PT Bumi Saran Utama, Pagimana, Banggai', 'melakukan pengawasan timbun barang impor di tempat lain di luar Kawasan Pabean', 1, 1, '2025-01-31 03:58:18'),
(147, '19770327 199803 1 00', 'Ricky Ronald Michel Rumbewas', '081284951443', 'MT.YECHI', 'melakukan pemeriksaan sarana pengangkut laut (boatzoeking)', 1, 1, '2025-02-04 00:50:02'),
(148, '19770327 199803 1 00', 'Ricky Ronald Michel Rumbewas', '081284951443', 'PT.Bumi Sarana Utama, Pelabuhan Pagimana, Basabungan, Kecamatan Pagimana', 'melakukan pembukaan segel keran pengeluaran Tangki Penimbunan Aspal', 1, 1, '2025-02-06 01:59:53'),
(149, '199950716 201502 1 0', 'Al Fauzan Prima Rizkynanda', '081211004346', 'PT. Donggi Senoro LNG', 'melakukan pemeriksaan sarana pengangkut laut (boatzoeking)', 1, 1, '2025-02-07 02:15:29'),
(150, '19770327 199803 1 00', 'Ricky Ronald Michel Rumbewas', '081284951443', 'PT.SASL and SONS Indonesia, DusunBolo, Desa Kayutanyo, Kec. Luwuk Timur, Kab. Banggai', 'melakukan pembukaan segel atas pengembalian peti kemas asal impor', 1, 1, '2025-02-08 01:05:48'),
(151, '19770327 199803 1 00', 'Ricky Ronald Michel Rumbewas', '081284951443', 'PT.Donggi Senoro LNG', 'melakukan pemeriksaan sarana pengangkut laut (boatzoeking)', 1, 1, '2025-02-16 02:46:55'),
(152, '199550910 201502 1 0', 'Muh Arifiansyah', '085255171273', 'PT. Panca Amara Utama', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2025-02-17 01:51:20'),
(153, '19770327 199803 1 00', 'Ricky Ronald Michel Rumbewas', '081284951443', 'PT.SASL and SONS Indonesia, Dusun Bolo, Desa Kayutanyo, Kec. Luwuk Timur, Kab. Banggai', 'melakukan pembukaan segel atas barang impor yang di timbun di tempat lain yang dipersamakan dengan Tempat Penimbunan Sementara (TPS ) yang telah terbit Surat Persetujuan Pengeluaran Barang (SPPB)', 1, 1, '2025-02-17 01:51:30'),
(154, '19870318 201502 1 00', 'Tommy Putra Wijaya', '085324104321', 'PT. Panca Amara Utama', 'melakukan pemeriksaan sarana pengangkut laut (boatzoeking)', 1, 1, '2025-03-08 03:43:32'),
(155, '199550910 201502 1 0', 'Muh Arifiansyah', '085255171273', 'Terminal Donggi Senoro LNG', 'Melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2025-03-08 03:12:19'),
(156, '19870318 201502 1 00', 'Tommy Putra Wijaya', '085324104321', 'terminal khusus Marine Senoro JOB', 'melakukan pemeriksaan sarana pengangkut laut (boatzoeking)', 1, 1, '2025-03-10 02:39:35'),
(157, '19751005 200501 1 00', 'Abdul Thalib', '081340621425', 'PT. Panca Amara Utama', 'melakukan pemeriksaan sarana pengangkut kapal (boatzoeking)', 1, 1, '2025-03-15 03:44:29'),
(158, '19870318 201502 1 00', 'Tommy Putra Wijaya', '085324104321', 'PT. Donggi Senoro LNG', 'melakukan pemeriksaan sarana pengangkut laut (boatzoeking)', 1, 1, '2025-03-18 00:08:17'),
(159, '19860620 200701 1 00', 'Muhammad Fiqri Ridwan', '085341016667', 'PT. Donggi Senoro LNG', 'melaksanakan pengawasan pemuatan barang ekspor di luar Kawasan Pabean', 1, 1, '2025-04-16 00:09:26'),
(160, '19860620 200701 1 00', 'Muhammad Fiqri Ridwan', '085341016667', 'JOB-Pertamina Medco E&P Tomori Sulawesi (JOB Tomori) Well site Senoro-18, Toili, Sulawesi Tengah', 'untuk melaksanakan pemeriksaan fisik barang impor sementara a.n. PT. Baker Hughes Indonesia', 1, 1, '2025-04-24 02:51:12'),
(161, '19860620 200701 1 00', 'Muhammad Fiqri Ridwan', '085341016667', 'PT. Donggi Senoro LNG', 'untuk melaksanakan pengawasan pemuatan barang ekspor di luar Kawasan Pabean', 1, 1, '2025-04-24 00:11:58');

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
-- Indexes for table `customer2024`
--
ALTER TABLE `customer2024`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idx_waktu_rekam` (`waktu_rekam`) USING BTREE,
  ADD KEY `fk_customer_lokasi` (`lokasi_id`) USING BTREE,
  ADD KEY `fk_customer_pegawai` (`pegawai_id`) USING BTREE;

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
-- Indexes for table `pegawai2024`
--
ALTER TABLE `pegawai2024`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `customer2024`
--
ALTER TABLE `customer2024`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `data_pegawai`
--
ALTER TABLE `data_pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `data_perusahaan`
--
ALTER TABLE `data_perusahaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `pegawai2024`
--
ALTER TABLE `pegawai2024`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

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

--
-- Constraints for table `customer2024`
--
ALTER TABLE `customer2024`
  ADD CONSTRAINT `customer2024_ibfk_2` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai2024` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
