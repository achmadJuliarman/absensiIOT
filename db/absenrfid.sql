-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2024 at 05:35 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absenrfid`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id` int(11) NOT NULL,
  `nokartu` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_istirahat` time NOT NULL,
  `jam_kembali` time NOT NULL,
  `jam_pulang` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id`, `nokartu`, `tanggal`, `jam_masuk`, `jam_istirahat`, `jam_kembali`, `jam_pulang`) VALUES
(1, '1234567890', '2023-12-22', '05:13:07', '08:13:07', '14:13:07', '18:13:07'),
(2, '1234567890', '2023-12-23', '22:47:16', '00:00:00', '00:00:00', '00:00:00'),
(3, '123', '2023-12-23', '22:59:23', '23:16:13', '00:00:00', '00:00:00'),
(4, 'tes1', '2023-12-23', '23:10:11', '00:00:00', '23:22:41', '23:23:44'),
(5, '1311899116', '2023-12-29', '14:44:32', '15:13:26', '15:33:48', '14:45:32'),
(7, '1234567890', '2023-12-29', '15:11:01', '00:00:00', '00:00:00', '00:00:00'),
(8, '123', '2023-12-29', '15:13:08', '00:00:00', '00:00:00', '00:00:00'),
(9, '222', '2023-12-29', '15:24:33', '00:00:00', '00:00:00', '00:00:00'),
(10, 'tes1', '2023-12-29', '15:26:58', '00:00:00', '00:00:00', '00:00:00'),
(11, '446303422493128', '2023-12-29', '15:42:15', '15:48:46', '15:48:55', '00:00:00'),
(12, '222', '2023-12-30', '00:06:56', '00:00:00', '00:00:00', '00:00:00'),
(13, '1311899116', '2024-01-08', '17:37:55', '18:02:16', '18:29:17', '18:08:53'),
(14, '1311899116', '2024-01-13', '15:55:38', '15:55:52', '15:56:02', '15:56:13'),
(15, '13111695159', '2024-01-13', '15:58:58', '15:59:50', '16:00:02', '16:00:11'),
(16, '1311899116', '2024-01-22', '10:32:43', '00:00:00', '00:00:00', '11:16:48'),
(17, '446303422493128', '2024-01-22', '10:33:11', '11:12:16', '11:12:26', '11:14:45'),
(18, '5113215254', '2024-01-22', '10:33:32', '00:00:00', '00:00:00', '11:13:55'),
(19, '227445254', '2024-01-22', '10:34:49', '10:42:15', '10:59:14', '00:00:00'),
(20, '4207074193128', '2024-01-22', '11:18:13', '11:18:42', '11:18:50', '11:18:58'),
(21, '1311899116', '2024-01-23', '12:22:49', '00:00:00', '00:00:00', '00:00:00'),
(22, '13111695159', '2024-01-23', '12:23:05', '00:00:00', '00:00:00', '00:00:00'),
(23, '5113215254', '2024-01-23', '12:23:26', '00:00:00', '00:00:00', '00:00:00'),
(24, '227445254', '2024-01-23', '12:23:39', '00:00:00', '00:00:00', '12:24:51');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL,
  `nokartu` varchar(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `nokartu`, `nama`, `alamat`) VALUES
(1, '1234567890', 'Ari Syafri', 'Jl Subang'),
(2, '123', 'Raden', 'Jl jalan'),
(3, '7655544', 'asep', 'Jl Sukajadi'),
(4, '765557', 'tes', 'tes'),
(5, 'arites', 'tes', 'tttt'),
(6, 'tdgsgg344', 'tes', 'tttt'),
(7, 'tdgsgg', 'tes', 'tttt'),
(12, 'tes1', 'Ujang', 'Jl Tes'),
(13, 'tes2', 'Ujang', 'Jl Tes'),
(14, 'tes3', 'tes', 'tes'),
(15, '41234', 'Rizki', 'Jlanan\r\n'),
(16, '222', 'raden', 'tes'),
(17, '1311899116', 'Ari Syafri', 'Subang'),
(18, '446303422493128', 'Ari KTP', 'Subang'),
(19, '5113215254', 'Asep Dayat', 'JL ljalan'),
(20, '13111695159', 'Jujun Junadi', 'Jl Jalan'),
(21, '227445254', 'Raman h', 'jl sukajadi'),
(22, '4207074193128', 'fireman hidayat', 'Jl jalan');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `mode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`mode`) VALUES
(4);

-- --------------------------------------------------------

--
-- Table structure for table `tmprfid`
--

CREATE TABLE `tmprfid` (
  `nokartu` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`mode`);

--
-- Indexes for table `tmprfid`
--
ALTER TABLE `tmprfid`
  ADD PRIMARY KEY (`nokartu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
