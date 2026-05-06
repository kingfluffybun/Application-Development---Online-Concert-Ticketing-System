-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2026 at 11:29 AM
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
-- Database: `ticketsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `gen_ad`
--

CREATE TABLE `gen_ad` (
  `gen_id` int(11) NOT NULL,
  `seat_number` int(11) NOT NULL,
  `occupied` varchar(10) NOT NULL DEFAULT 'Yes, No',
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lower_box`
--

CREATE TABLE `lower_box` (
  `lower_id` int(11) NOT NULL,
  `seat_number` int(11) NOT NULL,
  `occupied` varchar(10) NOT NULL DEFAULT 'Yes, No',
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `upper_box`
--

CREATE TABLE `upper_box` (
  `upper_id` int(11) NOT NULL,
  `seat_number` int(11) NOT NULL,
  `occupied` varchar(10) NOT NULL DEFAULT 'Yes, No',
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vip_box`
--

CREATE TABLE `vip_box` (
  `vip_id` int(11) NOT NULL,
  `seat_number` int(11) NOT NULL,
  `occupied` varchar(255) NOT NULL DEFAULT 'Yes, No',
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gen_ad`
--
ALTER TABLE `gen_ad`
  ADD PRIMARY KEY (`gen_id`);

--
-- Indexes for table `lower_box`
--
ALTER TABLE `lower_box`
  ADD PRIMARY KEY (`lower_id`);

--
-- Indexes for table `upper_box`
--
ALTER TABLE `upper_box`
  ADD PRIMARY KEY (`upper_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vip_box`
--
ALTER TABLE `vip_box`
  ADD PRIMARY KEY (`vip_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gen_ad`
--
ALTER TABLE `gen_ad`
  MODIFY `gen_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lower_box`
--
ALTER TABLE `lower_box`
  MODIFY `lower_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `upper_box`
--
ALTER TABLE `upper_box`
  MODIFY `upper_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vip_box`
--
ALTER TABLE `vip_box`
  MODIFY `vip_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
