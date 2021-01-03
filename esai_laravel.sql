-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2021 at 07:14 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `esai_laravel`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_status` ()  NO SQL
BEGIN
  DECLARE cursor_id_ujian INT;
  DECLARE cursor_jadwal DATETIME;
  DECLARE cursor_status VARCHAR(1);
  DECLARE done INT DEFAULT FALSE;
  DECLARE cursor_i CURSOR FOR SELECT id_ujian,jadwal,status FROM exams;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
  OPEN cursor_i;
  read_loop: LOOP
    FETCH cursor_i INTO cursor_id_ujian, cursor_jadwal,cursor_status;
    IF done THEN
      LEAVE read_loop;
    END IF;
    IF cursor_jadwal <= now() AND cursor_status = 0 THEN
    	UPDATE exams SET status = 1 WHERE id_ujian = cursor_id_ujian;
    END IF;
    #INSERT INTO table_B(ID, VAL) VALUES(cursor_ID, cursor_VAL);
  END LOOP;
  CLOSE cursor_i;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_status2` ()  NO SQL
BEGIN
  DECLARE cursor_id_ujian INT;
  DECLARE cursor_jadwal_selesai DATETIME;
  DECLARE cursor_status VARCHAR(1);
  DECLARE done INT DEFAULT FALSE;
  DECLARE cursor_i CURSOR FOR SELECT id_ujian,jadwal_selesai,status FROM exams;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
  OPEN cursor_i;
  read_loop: LOOP
    FETCH cursor_i INTO cursor_id_ujian, cursor_jadwal_selesai,cursor_status;
    IF done THEN
      LEAVE read_loop;
    END IF;
    IF cursor_jadwal_selesai <= now() AND cursor_status = 1 THEN
    	UPDATE exams SET status = 2 WHERE id_ujian = cursor_id_ujian;
    END IF;
    #INSERT INTO table_B(ID, VAL) VALUES(cursor_ID, cursor_VAL);
  END LOOP;
  CLOSE cursor_i;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id_jawaban` int(10) UNSIGNED NOT NULL,
  `id_soal` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `jawaban` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id_ujian` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_soal` int(11) NOT NULL,
  `id_pengajar` int(11) NOT NULL,
  `kode_ujian` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jadwal` datetime NOT NULL,
  `jadwal_selesai` datetime NOT NULL,
  `durasi` int(11) NOT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id_ujian`, `nama`, `jumlah_soal`, `id_pengajar`, `kode_ujian`, `jadwal`, `jadwal_selesai`, `durasi`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ujian abc', 2, 16, 'Kiw1A', '2021-01-02 18:00:00', '2021-01-02 18:10:00', 90, '2', NULL, NULL),
(2, 'asd', 1, 1, 'CHWO4', '2021-01-03 00:33:00', '2021-01-03 00:34:00', 1, '2', '2021-01-02 10:36:26', '2021-01-02 10:36:26'),
(3, 'tet', 1, 1, 'UqOGE', '2021-01-03 00:40:00', '2021-01-03 00:50:00', 10, '2', '2021-01-02 10:37:12', '2021-01-02 10:37:12'),
(4, 'test2', 1, 1, 'lHMml', '2021-01-03 00:54:00', '2021-01-03 01:04:00', 10, '2', '2021-01-02 10:54:31', '2021-01-02 10:54:31'),
(5, 'test3', 1, 1, 'dMpEV', '2021-01-03 00:55:00', '2021-01-03 01:05:00', 10, '2', '2021-01-02 10:55:11', '2021-01-02 10:55:11'),
(6, 'asd', 1, 1, 'Di4iG', '2021-01-03 01:00:00', '2021-01-03 01:10:00', 10, '2', '2021-01-02 10:55:44', '2021-01-02 10:55:44'),
(7, 'asd', 1, 1, 'Rij2m', '2021-01-03 01:13:00', '2021-01-03 01:23:00', 10, '2', '2021-01-02 11:14:01', '2021-01-02 11:14:01'),
(8, 'asddd', 3, 1, 'a99nX', '2021-01-03 01:49:00', '2021-01-04 01:59:00', 10, '1', '2021-01-02 11:50:16', '2021-01-02 11:50:16'),
(9, 'asd', 1, 1, 'kkCsy', '2021-01-03 18:06:00', '2021-01-03 18:16:00', 10, '2', '2021-01-03 02:15:15', '2021-01-03 04:15:01'),
(10, 'asd', 1, 1, 'kkCsy', '2021-01-03 18:06:00', '2021-01-03 18:16:00', 10, '2', '2021-01-03 04:09:24', '2021-01-03 04:09:24'),
(11, 'test edit edit 2', 3, 1, 'sjLbV', '2021-01-03 18:22:00', '2021-01-03 18:32:00', 10, '2', '2021-01-03 04:22:26', '2021-01-03 04:23:03'),
(12, 'asd 123 test edit', 3, 1, 'QXWLo', '2021-01-03 18:39:00', '2021-01-03 18:59:00', 20, '2', '2021-01-03 04:23:49', '2021-01-03 04:40:04');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(57, '2014_10_12_000000_create_users_table', 1),
(58, '2014_10_12_100000_create_password_resets_table', 1),
(59, '2020_12_31_015428_create_table_teachers', 1),
(60, '2020_12_31_020556_create_table_students', 1),
(61, '2020_12_31_020742_create_table_ujian', 1),
(62, '2020_12_31_020804_create_table_soal', 1),
(63, '2020_12_31_020819_create_table_jawaban', 1),
(64, '2020_12_31_020841_create_table_similaritas', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id_soal` int(10) UNSIGNED NOT NULL,
  `id_ujian` int(11) NOT NULL,
  `pertanyaan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kunci_jawaban` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id_soal`, `id_ujian`, `pertanyaan`, `kunci_jawaban`, `created_at`, `updated_at`) VALUES
(1, 2, 'asd', 'asd', '2021-01-02 10:36:26', '2021-01-02 10:36:26'),
(2, 3, 'asd', 'asd', '2021-01-02 10:37:12', '2021-01-02 10:37:12'),
(3, 4, 'asd', 'asd', '2021-01-02 10:54:32', '2021-01-02 10:54:32'),
(4, 5, 'asd', 'asd', '2021-01-02 10:55:11', '2021-01-02 10:55:11'),
(5, 6, 'asd', 'asd', '2021-01-02 10:55:44', '2021-01-02 10:55:44'),
(6, 7, 'asd', 'asd', '2021-01-02 11:14:01', '2021-01-02 11:14:01'),
(7, 8, 'aasd', 'sad', '2021-01-02 11:50:16', '2021-01-02 11:50:16'),
(8, 8, 'asd', 'asd', '2021-01-02 11:50:16', '2021-01-02 11:50:16'),
(9, 8, 'asd123', 'asd123', '2021-01-02 11:50:16', '2021-01-02 11:50:16'),
(12, 9, 'asd', 'asd', '2021-01-03 04:15:03', '2021-01-03 04:15:03'),
(15, 11, 'soal 1 edit', 'jawaban 1 edit', '2021-01-03 04:23:03', '2021-01-03 04:23:03'),
(16, 11, 'soal 2 edit', 'jawaban 2edit', '2021-01-03 04:23:03', '2021-01-03 04:23:03'),
(17, 11, 'asd', '123', '2021-01-03 04:23:04', '2021-01-03 04:23:04'),
(20, 12, 'asd edit', 'asd edit', '2021-01-03 04:40:04', '2021-01-03 04:40:04'),
(21, 12, 'asd213 edit', 'asd123 edit', '2021-01-03 04:40:04', '2021-01-03 04:40:04'),
(22, 12, 'asd tambahan', 'asd tambahan', '2021-01-03 04:40:04', '2021-01-03 04:40:04'),
(31, 14, 'asd', 'asd123', '2021-01-03 06:44:51', '2021-01-03 06:44:51'),
(32, 13, 'asd edit', 'asd edit', '2021-01-03 10:53:30', '2021-01-03 10:53:30'),
(33, 13, 'abcd', 'abcdefgg', '2021-01-03 10:53:30', '2021-01-03 10:53:30');

-- --------------------------------------------------------

--
-- Table structure for table `similarities`
--

CREATE TABLE `similarities` (
  `id_similaritas` int(10) UNSIGNED NOT NULL,
  `id_jawaban` int(11) NOT NULL,
  `id_soal` int(11) NOT NULL,
  `nilai_similaritas` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id_siswa` int(10) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id_pengajar` int(10) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id_pengajar`, `username`, `password`, `email`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'budi_budi', '$2y$10$0oxpu5CUIVMLG5KyhsUuOeiVKOh5izNR5WtO0bHhfP6bEN.ECrSya', 'budi@mail.com', 'budi', NULL, NULL),
(2, 'max', '$2y$10$/tkmoKRkQtvc1CbnVNoUU.Y0Nnr9skQVKwUZ7LMuvSDpM8x45ELwK', 'max@gmail.com', 'max', '2021-01-03 07:24:23', '2021-01-03 07:24:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id_jawaban`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id_ujian`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id_soal`);

--
-- Indexes for table `similarities`
--
ALTER TABLE `similarities`
  ADD PRIMARY KEY (`id_similaritas`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id_siswa`),
  ADD UNIQUE KEY `students_username_unique` (`username`),
  ADD UNIQUE KEY `students_email_unique` (`email`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id_pengajar`),
  ADD UNIQUE KEY `teachers_username_unique` (`username`),
  ADD UNIQUE KEY `teachers_email_unique` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id_jawaban` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id_ujian` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id_soal` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `similarities`
--
ALTER TABLE `similarities`
  MODIFY `id_similaritas` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id_siswa` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id_pengajar` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `update_status` ON SCHEDULE EVERY 5 SECOND STARTS '2021-01-01 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO CALL update_status()$$

CREATE DEFINER=`root`@`localhost` EVENT `update_status2` ON SCHEDULE EVERY 1 SECOND STARTS '2021-01-01 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO CALL update_status2()$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
