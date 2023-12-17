-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Dec 17, 2023 at 04:01 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `workout_planner`
--

-- --------------------------------------------------------

--
-- Table structure for table `exercise_schedule`
--

CREATE TABLE `exercise_schedule` (
  `id` int(11) NOT NULL,
  `jenis_latihan` varchar(255) NOT NULL,
  `durasi` int(11) NOT NULL,
  `intensitas` varchar(50) NOT NULL,
  `hari` varchar(50) NOT NULL,
  `waktu` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exercise_schedule`
--

INSERT INTO `exercise_schedule` (`id`, `jenis_latihan`, `durasi`, `intensitas`, `hari`, `waktu`, `created_at`, `updated_at`) VALUES
(1, 'Berlari', 100, 'Rendah', 'Senin', '08:00:00', '2023-12-13 14:16:05', '2023-12-17 14:59:18'),
(2, 'Angkat Beban', 45, 'Tinggi', 'Rabu', '16:30:00', '2023-12-13 14:16:05', '2023-12-15 04:08:20'),
(3, 'Yoga', 60, 'Rendah', 'Jumat', '10:00:00', '2023-12-13 14:16:05', '2023-12-13 14:16:05'),
(5, 'Renang', 45, 'Sedang', 'Selasa', '07:30:00', '2023-12-13 14:16:05', '2023-12-13 14:16:05'),
(11, 'Boxing', 120, 'Tinggi', 'Sabtu', '19:00:00', '2023-12-14 06:35:26', '2023-12-15 04:08:15'),
(12, 'Basket', 70, 'Sedang', 'Kamis', '19:00:00', '2023-12-14 09:39:37', '2023-12-14 09:39:37'),
(15, 'Voli', 60, 'Tinggi', 'Jumat', '08:00:00', '2023-12-14 14:21:04', '2023-12-15 04:08:25'),
(24, 'Zumba', 30, 'Rendah', 'Minggu', '08:00:00', '2023-12-17 14:59:43', '2023-12-17 14:59:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password_hash`, `created_at`) VALUES
(35, 'man', '$2y$10$fGWw3/DHx6tMWp32Fk6Luu2/DAh7kx1k3J6Dsjn.VgsFMOmWfxreq', '2023-12-17 15:01:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exercise_schedule`
--
ALTER TABLE `exercise_schedule`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `exercise_schedule`
--
ALTER TABLE `exercise_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
