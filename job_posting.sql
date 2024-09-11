-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2024 at 03:38 PM
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
-- Database: `job_posting`
--

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `job_description` text NOT NULL,
  `work_email` varchar(255) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `job_title`, `image`, `company_name`, `job_description`, `work_email`, `phone_number`, `created_at`, `user_id`) VALUES
(10, 'Job vacancy: Software Engineer', 'uploads/job1.png', 'Q-quatics', 'We are seeking a skilled and motivated Software Engineer to join our dynamic development team. The ideal candidate will have a strong background in software development, excellent problem-solving skills, and a passion for creating high-quality software solutions. As a Software Engineer at Q-quatics, you will be responsible for designing, developing, and maintaining software applications that meet our clients\' needs.', 'abc@gmail.com', '+639 495 36 270', '2024-09-04 09:45:54', 0),
(12, 'Job vacancy: Cloud Engineer', 'uploads/job2.jpg', 'Smart-IS', 'As a Cloud Engineer at Smart-IS, you will be responsible for designing, implementing, and managing cloud-based solutions to meet our clients\' needs. You will work closely with our development and operations teams to ensure the seamless deployment and operation of cloud services.', '123@gmail.com', '+639 495 36 456', '2024-09-04 10:20:47', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(1, 'abc@gmail.com', '$2y$10$gCWGIHMPgHMz2M9T.w5w7OKK43DibFpXQec9Q8nSui.8I/Qbnu6Ke'),
(2, '123@gmail.com', '$2y$10$k59H6InCmDUFTAuHVkDW1.TWnbl6.xQOrMvPJcqpOL3UXbLbpewxq'),
(3, 'marc@gmail.com', '$2y$10$cLaGZK2.rRGRXk.zxBU2Pu2AMDsFyDuJotRli0gjdDSeMPH1NMxZi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
