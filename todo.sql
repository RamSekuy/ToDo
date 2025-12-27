-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2025 at 06:49 PM
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
  `description` varchar(255) DEFAULT NULL,
  `priority` int(11) NOT NULL,
  `status` enum('ToDo','In Progress','Done') NOT NULL,
  `task_group` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `priority`, `status`, `task_group`) VALUES
('072c191a-e34c-11f0-b969-089e01c6e6a5', 'Kumpulin', 'nunggu link gform', 6, 'In Progress', 'UAS Web'),
('3e68987b-e34c-11f0-b969-089e01c6e6a5', 'rapiin kode', 'fokus tugas lain dlu', 4, 'ToDo', 'UAS Web'),
('48129828-e34b-11f0-b969-089e01c6e6a5', 'Review Jurnal No6', 'The impact of intersectional racial and gender biases on minority female leadership over two centuries', 2, 'In Progress', 'UAS Kepemimpinan'),
('5eee2b55-e34c-11f0-b969-089e01c6e6a5', 'Tambahin Fitur Gak Penting', '', 8, 'ToDo', 'UAS Web'),
('80e02c8b-e34b-11f0-b969-089e01c6e6a5', 'Pembuatan Form', 'Pengalaman menggunakan AI', 10, 'Done', 'UAS Pengembangan Karakter'),
('8f63aa95-e34b-11f0-b969-089e01c6e6a5', 'Penyebaran Form', 'cari 120 responden', 4, 'In Progress', 'UAS Pengembangan Karakter'),
('9e3ef13a-e34b-11f0-b969-089e01c6e6a5', 'Pembuatan Jurnal', 'Jurnal hasil penelitian', 2, 'ToDo', 'UAS Pengembangan Karakter'),
('af939d19-e34a-11f0-b969-089e01c6e6a5', 'Review Jurnal No3', 'Gender_Equality_in_the_Workplace_Strategy', 8, 'Done', 'UAS Kepemimpinan'),
('da83df43-e349-11f0-b969-089e01c6e6a5', 'Page Group', '', 4, 'Done', 'UAS Web'),
('e23b3abc-e34b-11f0-b969-089e01c6e6a5', 'Pembuatan Database', '', 2, 'Done', 'UAS Web'),
('f236a82d-e34b-11f0-b969-089e01c6e6a5', 'Bug Fix', 'Mending tidur', 6, 'ToDo', 'UAS Web'),
('f45f6b24-e348-11f0-b969-089e01c6e6a5', 'Page ToDo', '', 6, 'Done', 'UAS Web');

-- --------------------------------------------------------

--
-- Table structure for table `task_groups`
--

CREATE TABLE `task_groups` (
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task_groups`
--

INSERT INTO `task_groups` (`name`) VALUES
('UAS Kepemimpinan'),
('UAS Pengembangan Karakter'),
('UAS Web');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_group_status_priority` (`task_group`,`status`,`priority`);

--
-- Indexes for table `task_groups`
--
ALTER TABLE `task_groups`
  ADD PRIMARY KEY (`name`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `fk_task_group` FOREIGN KEY (`task_group`) REFERENCES `task_groups` (`name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
