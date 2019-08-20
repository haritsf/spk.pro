-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2019 at 10:52 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `promethee`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatifs`
--

CREATE TABLE `alternatifs` (
  `id` smallint(5) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `kode` char(3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alternatifs`
--

INSERT INTO `alternatifs` (`id`, `nama`, `kode`, `created_at`, `updated_at`) VALUES
(1, 'Bodeh', 'A1', '2019-07-22 16:19:46', '2019-07-22 17:12:47'),
(2, 'Ulujami', 'A2', '2019-07-22 16:19:46', '2019-07-22 16:19:46'),
(3, 'Comal', 'A3', '2019-07-22 16:19:46', '2019-07-22 16:19:46'),
(4, 'Ampelgading', 'A4', '2019-07-22 16:19:46', '2019-07-22 16:19:46'),
(5, 'Petarukan', 'A5', '2019-07-22 16:19:46', '2019-07-22 16:19:46'),
(6, 'Taman', 'A6', '2019-07-22 16:19:46', '2019-07-22 16:19:46'),
(7, 'Pemalang', 'A7', '2019-07-22 16:19:46', '2019-07-22 16:19:46'),
(8, 'Bantarbolang', 'A8', '2019-07-22 16:19:46', '2019-07-22 16:19:46'),
(9, 'Randudongkal', 'A9', '2019-07-22 16:19:46', '2019-07-22 16:19:46'),
(10, 'Warungpring', 'A10', '2019-07-22 16:19:46', '2019-07-22 16:19:46'),
(11, 'Moga', 'A11', '2019-07-22 16:19:46', '2019-07-22 16:19:46'),
(12, 'Pulosari', 'A12', '2019-07-22 16:19:46', '2019-07-22 16:19:46'),
(13, 'Watukumpul', 'A13', '2019-07-22 16:19:46', '2019-07-22 16:19:46'),
(14, 'Belik', 'A14', '2019-07-22 16:19:46', '2019-07-22 16:19:46');

-- --------------------------------------------------------

--
-- Table structure for table `evals`
--

CREATE TABLE `evals` (
  `id` smallint(5) NOT NULL,
  `alternatif` smallint(5) NOT NULL,
  `kriteria` smallint(5) NOT NULL,
  `nilai` float NOT NULL,
  `submit_by` smallint(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evals`
--

INSERT INTO `evals` (`id`, `alternatif`, `kriteria`, `nilai`, `submit_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(2, 1, 2, 4, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(3, 1, 3, 2, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(4, 1, 4, 2, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(5, 1, 5, 1, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(6, 1, 6, 0, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(7, 2, 1, 0, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(8, 2, 2, 1, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(9, 2, 3, 0, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(10, 2, 4, 2, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(11, 2, 5, 3, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(12, 2, 6, 3, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(13, 3, 1, 0, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(14, 3, 2, 2, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(15, 3, 3, 0, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(16, 3, 4, 2, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(17, 3, 5, 2, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(18, 3, 6, 3, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(19, 4, 1, 0, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(20, 4, 2, 4, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(21, 4, 3, 0, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(22, 4, 4, 2, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(23, 4, 5, 2, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(24, 4, 6, 3, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(25, 5, 1, 0, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(26, 5, 2, 3, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(27, 5, 3, 0, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(28, 5, 4, 2, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(29, 5, 5, 2, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(30, 5, 6, 3, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(31, 6, 1, 0, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(32, 6, 2, 3, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(33, 6, 3, 0, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(34, 6, 4, 2, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(35, 6, 5, 0, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(36, 6, 6, 3, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(37, 7, 1, 0, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(38, 7, 2, 3, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(39, 7, 3, 0, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(40, 7, 4, 2, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(41, 7, 5, 2, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(42, 7, 6, 3, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(43, 8, 1, 1, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(44, 8, 2, 0, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(45, 8, 3, 1, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(46, 8, 4, 1, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(47, 8, 5, 1, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(48, 8, 6, 1, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(49, 9, 1, 2, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(50, 9, 2, 0, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(51, 9, 3, 2, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(52, 9, 4, 1, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(53, 9, 5, 1, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(54, 9, 6, 1, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(55, 10, 1, 1, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(56, 10, 2, 3, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(57, 10, 3, 0, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(58, 10, 4, 1, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(59, 10, 5, 1, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(60, 10, 6, 2, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(61, 11, 1, 1, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(62, 11, 2, 3, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(63, 11, 3, 2, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(64, 11, 4, 0, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(65, 11, 5, 1, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(66, 11, 6, 2, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(67, 12, 1, 3, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(68, 12, 2, 2, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(69, 12, 3, 2, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(70, 12, 4, 4, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(71, 12, 5, 1, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(72, 12, 6, 0, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(73, 13, 1, 4, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(74, 13, 2, 0, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(75, 13, 3, 2, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(76, 13, 4, 0, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(77, 13, 5, 1, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(78, 13, 6, 2, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(79, 14, 1, 1, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(80, 14, 2, 0, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(81, 14, 3, 2, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(82, 14, 4, 1, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(83, 14, 5, 1, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30'),
(84, 14, 6, 2, 1, '2019-07-22 16:47:30', '2019-07-22 16:47:30');

-- --------------------------------------------------------

--
-- Table structure for table `klasifikasis`
--

CREATE TABLE `klasifikasis` (
  `id` smallint(5) NOT NULL,
  `kriteria` smallint(5) NOT NULL,
  `nilai` float NOT NULL,
  `klasifikasi` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `klasifikasis`
--

INSERT INTO `klasifikasis` (`id`, `kriteria`, `nilai`, `klasifikasi`, `created_at`, `updated_at`) VALUES
(1, 1, 0, '0-8%', '2019-08-20 04:39:19', '0000-00-00 00:00:00'),
(2, 1, 1, '8-15%', '2019-08-20 04:39:19', '0000-00-00 00:00:00'),
(3, 1, 2, '15-25%', '2019-08-20 04:39:19', '0000-00-00 00:00:00'),
(4, 1, 3, '25-40%', '2019-08-20 04:39:19', '0000-00-00 00:00:00'),
(5, 1, 4, '>40%', '2019-08-20 04:39:19', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `kriterias`
--

CREATE TABLE `kriterias` (
  `id` smallint(5) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `minmaks` set('min','maks') NOT NULL,
  `pref` smallint(5) NOT NULL,
  `q` float NOT NULL,
  `p` float NOT NULL,
  `bobot` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriterias`
--

INSERT INTO `kriterias` (`id`, `nama`, `minmaks`, `pref`, `q`, `p`, `bobot`, `created_at`, `updated_at`) VALUES
(1, 'Kelerengan', 'min', 4, 0, 1, 0.15, '2019-07-22 16:28:42', '2019-07-22 16:28:42'),
(2, 'Penggunaan Lahan', 'maks', 3, 0, 3, 0.2, '2019-07-22 16:28:42', '2019-07-22 16:28:42'),
(3, 'Rawan Bencana Longsor', 'min', 3, 0, 2, 0.1, '2019-07-22 16:28:42', '2019-07-22 16:28:42'),
(4, 'Curah Hujan', 'maks', 2, 1, 0, 0.15, '2019-07-22 16:28:42', '2019-07-22 16:28:42'),
(5, 'Cadangan Air Tanah', 'maks', 5, 1, 2, 0.2, '2019-07-22 16:28:42', '2019-07-22 16:28:42'),
(6, 'Jenis Tanah', 'maks', 3, 0, 3, 0.2, '2019-07-22 16:28:42', '2019-07-22 16:28:42');

-- --------------------------------------------------------

--
-- Table structure for table `prefs`
--

CREATE TABLE `prefs` (
  `id` smallint(5) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prefs`
--

INSERT INTO `prefs` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Usual', '2019-07-22 16:22:41', '2019-07-22 16:22:41'),
(2, 'Linear', '2019-07-22 16:22:41', '2019-07-22 16:22:41'),
(3, 'Quasi', '2019-07-22 16:22:41', '2019-07-22 16:22:41'),
(4, 'Linear Quasi', '2019-07-22 16:22:41', '2019-07-22 16:22:41'),
(5, 'Level', '2019-07-22 16:22:41', '2019-07-22 16:22:41'),
(6, 'Gaussian', '2019-07-22 16:22:41', '2019-07-22 16:22:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` smallint(5) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `role` set('Adminstrator','Manager') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `alias`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$05$BplRrSrBrmHcsWzai4P3s.KhoGciPwUN2q1JrRiPOJeWhc8.Hp8K6', 'Admin', 'Adminstrator', '2019-07-22 16:35:11', '2019-08-19 18:35:49'),
(2, 'haritsf', '$2y$05$R/5HZdqZ1hDAD30yf0c3W.NZIKZ4MK9i8Pl5ZIdQJQuzAN.NCUTW2', 'haritsf', 'Manager', '2019-08-19 18:39:01', '2019-08-19 18:39:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatifs`
--
ALTER TABLE `alternatifs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evals`
--
ALTER TABLE `evals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alternatif` (`alternatif`),
  ADD KEY `kriteria` (`kriteria`),
  ADD KEY `submit_by` (`submit_by`);

--
-- Indexes for table `klasifikasis`
--
ALTER TABLE `klasifikasis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kriteria` (`kriteria`);

--
-- Indexes for table `kriterias`
--
ALTER TABLE `kriterias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pref` (`pref`);

--
-- Indexes for table `prefs`
--
ALTER TABLE `prefs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatifs`
--
ALTER TABLE `alternatifs`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `evals`
--
ALTER TABLE `evals`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `klasifikasis`
--
ALTER TABLE `klasifikasis`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kriterias`
--
ALTER TABLE `kriterias`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `prefs`
--
ALTER TABLE `prefs`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `evals`
--
ALTER TABLE `evals`
  ADD CONSTRAINT `evals_ibfk_1` FOREIGN KEY (`alternatif`) REFERENCES `alternatifs` (`id`),
  ADD CONSTRAINT `evals_ibfk_2` FOREIGN KEY (`kriteria`) REFERENCES `kriterias` (`id`),
  ADD CONSTRAINT `evals_ibfk_3` FOREIGN KEY (`submit_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `klasifikasis`
--
ALTER TABLE `klasifikasis`
  ADD CONSTRAINT `klasifikasis_ibfk_1` FOREIGN KEY (`kriteria`) REFERENCES `kriterias` (`id`);

--
-- Constraints for table `kriterias`
--
ALTER TABLE `kriterias`
  ADD CONSTRAINT `kriterias_ibfk_1` FOREIGN KEY (`pref`) REFERENCES `prefs` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
