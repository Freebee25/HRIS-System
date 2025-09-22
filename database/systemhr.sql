-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2025 at 02:10 PM
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
-- Database: `systemhr`
--

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE `departemen` (
  `id` int(11) NOT NULL,
  `nama_departemen` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`id`, `nama_departemen`) VALUES
(1, 'Chief Executive Officer'),
(2, 'Director'),
(3, 'FAT'),
(4, 'HR Policy Procedure & Corporate Strategy'),
(5, 'Internal Audit'),
(6, 'Strategy & Performance'),
(7, 'General Affairs & Procurements'),
(8, 'Production'),
(9, 'Distribution'),
(10, 'TAD');

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id` int(11) NOT NULL,
  `departemen_id` int(11) NOT NULL,
  `nama_divisi` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id`, `departemen_id`, `nama_divisi`) VALUES
(1, 3, 'Finance'),
(2, 3, 'Accounting'),
(3, 3, 'Tax'),
(4, 4, 'Human Resource'),
(5, 4, 'Corporate Strategy'),
(6, 4, 'Policy & Procedure'),
(7, 4, 'Legal'),
(8, 4, 'Corporate Secretary'),
(9, 5, 'Risk Management'),
(10, 5, 'Monitor & Compliance'),
(11, 5, 'Internal Audit Division'),
(12, 6, 'Strategy'),
(13, 6, 'Performance'),
(14, 7, 'GA & Procurement'),
(15, 7, 'Asset Management'),
(16, 7, 'Environmental'),
(17, 8, 'Production'),
(18, 8, 'Office'),
(19, 8, 'Maintenance'),
(20, 8, 'Operator'),
(21, 8, 'Helper'),
(22, 8, 'Warehouse'),
(23, 8, 'Labor'),
(24, 9, 'Marketing'),
(25, 9, 'Sales'),
(26, 9, 'Purchasing'),
(27, 10, 'Driver'),
(28, 10, 'Security'),
(29, 10, 'Support Staff');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL,
  `no_spk` varchar(50) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `departemen_id` int(11) NOT NULL,
  `divisi_id` int(11) DEFAULT NULL,
  `jabatan` enum('Direksi','Team Leader','Senior Staff','Staff','Junior Staff') NOT NULL,
  `status_pegawai` enum('Tetap','Kontrak','Probation','Freelance','Resign') NOT NULL,
  `tanggal_awal` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `sisa_hari_spk` int(11) DEFAULT NULL,
  `nik` varchar(50) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `agama` enum('Islam','Kristen','Katolik','Budha','Hindu','Konghuchu','Aliran kepercayaan lainnya') NOT NULL,
  `status_kawin` enum('Menikah','Belum Menikah') NOT NULL,
  `kontak` varchar(50) DEFAULT NULL,
  `kontak_darurat` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `no_spk`, `nama`, `nip`, `departemen_id`, `divisi_id`, `jabatan`, `status_pegawai`, `tanggal_awal`, `tanggal_akhir`, `sisa_hari_spk`, `nik`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `agama`, `status_kawin`, `kontak`, `kontak_darurat`, `email`, `note`, `created_at`) VALUES
(3, '001', 'ian', '123', 7, 14, 'Team Leader', 'Kontrak', '2025-09-22', '2025-09-25', 2, '312312', 'Jakarta', '2000-02-05', 'Jakarta', 'Islam', 'Belum Menikah', '3123', '321123123', 'ian@gmail.com', 'dasdas', '2025-09-22 11:58:01');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan_files`
--

CREATE TABLE `karyawan_files` (
  `id` int(11) NOT NULL,
  `karyawan_id` int(11) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan_files`
--

INSERT INTO `karyawan_files` (`id`, `karyawan_id`, `file_path`, `uploaded_at`) VALUES
(1, 3, '1758542281_jawaban  no 3 Fribyan Yusuf.pdf', '2025-09-22 11:58:01');

-- --------------------------------------------------------

--
-- Table structure for table `pendidikan`
--

CREATE TABLE `pendidikan` (
  `id` int(11) NOT NULL,
  `karyawan_id` int(11) NOT NULL,
  `jenjang` enum('SMA/SMK','S1','S2','S3') NOT NULL,
  `jurusan` varchar(150) DEFAULT NULL,
  `institusi` varchar(150) DEFAULT NULL,
  `tahun_lulus` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'admin', '2025-09-22 11:04:42'),
(2, 'user1', '6ad14ba9986e3615423dfca256d04e3f', 'user', '2025-09-22 11:04:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departemen_id` (`departemen_id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nip` (`nip`),
  ADD KEY `departemen_id` (`departemen_id`),
  ADD KEY `divisi_id` (`divisi_id`);

--
-- Indexes for table `karyawan_files`
--
ALTER TABLE `karyawan_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `karyawan_id` (`karyawan_id`);

--
-- Indexes for table `pendidikan`
--
ALTER TABLE `pendidikan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `karyawan_id` (`karyawan_id`);

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
-- AUTO_INCREMENT for table `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `karyawan_files`
--
ALTER TABLE `karyawan_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pendidikan`
--
ALTER TABLE `pendidikan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `divisi`
--
ALTER TABLE `divisi`
  ADD CONSTRAINT `divisi_ibfk_1` FOREIGN KEY (`departemen_id`) REFERENCES `departemen` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_ibfk_1` FOREIGN KEY (`departemen_id`) REFERENCES `departemen` (`id`),
  ADD CONSTRAINT `karyawan_ibfk_2` FOREIGN KEY (`divisi_id`) REFERENCES `divisi` (`id`);

--
-- Constraints for table `karyawan_files`
--
ALTER TABLE `karyawan_files`
  ADD CONSTRAINT `karyawan_files_ibfk_1` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pendidikan`
--
ALTER TABLE `pendidikan`
  ADD CONSTRAINT `pendidikan_ibfk_1` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawan` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
