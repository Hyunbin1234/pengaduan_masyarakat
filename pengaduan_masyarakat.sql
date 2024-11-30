-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 14, 2024 at 07:42 AM
-- Server version: 8.0.35
-- PHP Version: 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengaduan_masyarakat2`
--

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id_pengaduan` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `judul_pengaduan` varchar(255) DEFAULT NULL,
  `deskripsi` text,
  `status_pengaduan` varchar(50) DEFAULT NULL,
  `tanggal_pengaduan` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengaduan`
--

INSERT INTO `pengaduan` (`id_pengaduan`, `id_user`, `judul_pengaduan`, `deskripsi`, `status_pengaduan`, `tanggal_pengaduan`) VALUES
(1, 2, 'Rafa FM', 'Lorem Ipsum', 'In Progress', '2024-11-13 06:35:09'),
(2, 2, 'Eyza', 'Lorem', 'Resolved', '2024-11-13 06:36:22'),
(3, 2, 'Najib', 'Lorem lorem lorem', 'In Progress', '2024-11-13 06:38:52'),
(4, 2, 'Danish', 'Kamar mandi gak bisa dikunci', 'In Progress', '2024-11-13 06:57:19'),
(5, 2, 'Hyun bin', 'Makanannya gak ada logo halalnya', 'Pending', '2024-11-13 07:32:57'),
(6, 2, 'Rafa bau', 'bau banget', 'Pending', '2024-11-14 00:42:52'),
(7, 2, 'Keran mati', 'keran air mati', 'Pending', '2024-11-14 07:17:34'),
(8, 2, 'Listrik mati', 'Listrik di kampung mati', 'In Progress', '2024-11-14 07:36:13'),
(9, 2, 'Test', 'Lorem ipsum', NULL, '2024-11-14 07:38:27');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `id_user` int NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role` enum('public','admin') DEFAULT 'public'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`id_user`, `nama`, `username`, `password`, `email`, `role`) VALUES
(1, 'Admin', 'admin', '$2y$10$aLx5X5200gtP980cIkKFDuXoX55kYqNZ/.yxeOf1YZhBi3LhiLv/u', 'admin@example.com', 'admin'),
(2, 'User Public', 'public', '$2y$10$jbE1fAqoAngYkqb5N9cXruWTEUhMoVxlTMu7AuaRBhpidXOrlVAUi', 'public@example.com', 'public');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id_pengaduan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id_pengaduan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD CONSTRAINT `pengaduan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `User` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
