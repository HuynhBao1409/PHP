-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2024 at 02:51 PM
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
-- Database: `hbwebsite`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_cred`
--

CREATE TABLE `admin_cred` (
  `sr_no` int(11) NOT NULL,
  `admin_name` varchar(150) NOT NULL,
  `admin_pass` varchar(150) NOT NULL,
  `c_vu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_cred`
--

INSERT INTO `admin_cred` (`sr_no`, `admin_name`, `admin_pass`, `c_vu`) VALUES
(1, 'admin', '123', 'giám đốc'),
(2, 'bao', '123', 'nhân viên');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `icon`, `name`, `description`) VALUES
(6, 'IMG_63358.svg', 'TV', ''),
(7, 'IMG_41869.svg', 'Air-conditioner', ''),
(8, 'IMG_94095.svg', 'Radio', ''),
(9, 'IMG_36249.svg', 'Spa', '');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `name`) VALUES
(5, 'Bể bơi vô cực'),
(7, 'Hai giường đôi'),
(8, 'Hai giường đơn'),
(9, 'Một giường đôi'),
(10, 'Một giường đơn');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `area` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `adult` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `description` varchar(350) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `area`, `price`, `quantity`, `adult`, `children`, `description`, `status`) VALUES
(9, 'Phòng Vip', 1, 12500000, 1, 4, 2, 'okla', 0),
(10, 'Phòng tổng thống', 2, 25000000, 2, 6, 2, 'ngon', 0),
(12, 'Phòng phổng thông', 2, 10000000, 1, 2, 1, 'là dị đó', 0);

-- --------------------------------------------------------

--
-- Table structure for table `room_facilities`
--

CREATE TABLE `room_facilities` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `facilities_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_facilities`
--

INSERT INTO `room_facilities` (`sr_no`, `room_id`, `facilities_id`) VALUES
(43, 10, 6),
(44, 10, 7),
(45, 10, 8),
(46, 10, 9),
(47, 9, 6),
(48, 9, 7),
(49, 9, 8),
(50, 9, 9),
(51, 12, 6),
(52, 12, 7),
(53, 12, 8),
(54, 12, 9);

-- --------------------------------------------------------

--
-- Table structure for table `room_features`
--

CREATE TABLE `room_features` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `features_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_features`
--

INSERT INTO `room_features` (`sr_no`, `room_id`, `features_id`) VALUES
(36, 10, 5),
(37, 10, 7),
(38, 10, 8),
(39, 9, 5),
(40, 9, 9),
(41, 12, 9);

-- --------------------------------------------------------

--
-- Table structure for table `room_images`
--

CREATE TABLE `room_images` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `thumb` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_images`
--

INSERT INTO `room_images` (`sr_no`, `room_id`, `image`, `thumb`) VALUES
(10, 9, 'IMG_83107.png', 1),
(12, 9, 'IMG_27592.png', 0),
(13, 10, 'IMG_70643.png', 1),
(15, 12, 'IMG_72069.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(6, 'Bảo Huỳnh', 'giabao1409203@gmail.com', '$2y$10$zRiI.UiholL4Ho/QZS8BMOg4hyOCL0Ey8t6jb38PhxQiCCjyb60Gm', 'admin', '2024-11-14 13:47:43'),
(7, 'HaoBuynh', 'haogiabuynh@gmail.com', '$2y$10$tiGiJMr59Skpjldb2RFSL.b7o8YCov93FYh/K3nOKkK6a6hBZ1IqS', 'user', '2024-11-14 13:48:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_cred`
--
ALTER TABLE `admin_cred`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `rm id` (`room_id`),
  ADD KEY `facilities id` (`facilities_id`);

--
-- Indexes for table `room_features`
--
ALTER TABLE `room_features`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `room id` (`room_id`),
  ADD KEY `features id` (`features_id`);

--
-- Indexes for table `room_images`
--
ALTER TABLE `room_images`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `room_id` (`room_id`);

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
-- AUTO_INCREMENT for table `admin_cred`
--
ALTER TABLE `admin_cred`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `room_facilities`
--
ALTER TABLE `room_facilities`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `room_features`
--
ALTER TABLE `room_features`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `room_images`
--
ALTER TABLE `room_images`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD CONSTRAINT `facilities id` FOREIGN KEY (`facilities_id`) REFERENCES `facilities` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `rm id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `room_features`
--
ALTER TABLE `room_features`
  ADD CONSTRAINT `features id` FOREIGN KEY (`features_id`) REFERENCES `features` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `room id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `room_images`
--
ALTER TABLE `room_images`
  ADD CONSTRAINT `room_images_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
