-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2025 at 11:17 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petshopdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_image` varchar(255) NOT NULL,
  `admin_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`admin_id`, `admin_name`, `admin_email`, `admin_image`, `admin_password`) VALUES
(1, 'Duncan', ' duncan@petpawa.info', 'img1.jpg', '$2y$10$9jvYQ97O0V5JajkbtYMLSeWTcP65Gku0OEheu.g/p8gIfdaoDAsqm'),
(2, 'Mwas', ' duncan@petpawa.info', '', '$2y$10$nGlBzElIxROX5KfjsEkMHeOtO/w8sR09UfEw.w8Vfz1GUB84duuw2');

-- --------------------------------------------------------

--
-- Table structure for table `pet_category`
--

CREATE TABLE `pet_category` (
  `category_id` int(11) NOT NULL,
  `category_title` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pet_category`
--

INSERT INTO `pet_category` (`category_id`, `category_title`, `created_at`) VALUES
(1, 'Dog', '2025-04-04 20:40:15'),
(5, 'Cat', '2025-04-04 21:09:32');

-- --------------------------------------------------------

--
-- Table structure for table `puppy_breed`
--

CREATE TABLE `puppy_breed` (
  `breed_id` int(11) NOT NULL,
  `breed_name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `puppy_listing`
--

CREATE TABLE `puppy_listing` (
  `puppy_id` int(11) NOT NULL,
  `puppy_name` varchar(100) NOT NULL,
  `puppy_breed` varchar(100) NOT NULL,
  `puppy_age` int(11) NOT NULL,
  `puppy_location` varchar(100) NOT NULL,
  `puppy_desc` varchar(255) NOT NULL,
  `puppy_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `pet_category`
--
ALTER TABLE `pet_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `puppy_listing`
--
ALTER TABLE `puppy_listing`
  ADD PRIMARY KEY (`puppy_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pet_category`
--
ALTER TABLE `pet_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `puppy_listing`
--
ALTER TABLE `puppy_listing`
  MODIFY `puppy_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
