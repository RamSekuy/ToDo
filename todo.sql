-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2025 at 08:42 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todo`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` char(36) NOT NULL DEFAULT uuid(),
  `title` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `priority` int(11) NOT NULL,
  `status` enum('ToDo','In Progress','Done') NOT NULL DEFAULT 'ToDo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `priority`, `status`) VALUES
('5df4dec3-d9ae-11f0-9454-089e01c6e6a5', 'CharDev', 'Survei', 2, 'In Progress'),
('6bcc5573-d9ae-11f0-9454-089e01c6e6a5', 'WebDev', 'Bikin ini', 2, 'Done'),
('73f0a8e7-d9ae-11f0-9454-089e01c6e6a5', 'Leadership', 'blm tau', 2, 'ToDo'),
('811a4be2-d9ae-11f0-9454-089e01c6e6a5', 'MTK Diskrit', 'ngitung', 0, 'ToDo'),
('8a146ab3-d9ae-11f0-9454-089e01c6e6a5', 'Information System', 'Jurnal', 4, 'In Progress'),
('95ec7ec9-d9ae-11f0-9454-089e01c6e6a5', 'Algorithm', 'mending tidur', 10, 'ToDo'),
('b95a7ed0-d9ae-11f0-9454-089e01c6e6a5', 'Korupsi', 'Cari cara korupsi', 4, 'Done'),
('e23c44cf-d9ae-11f0-9454-089e01c6e6a5', 'English', 'blm tau', 8, 'ToDo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_status_priority` (`status`,`priority`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
