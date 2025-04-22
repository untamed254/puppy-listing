-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2025 at 05:15 PM
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
(2, 'Mwas', 'duncan@petpawa.info', '', '$2y$10$nGlBzElIxROX5KfjsEkMHeOtO/w8sR09UfEw.w8Vfz1GUB84duuw2');

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
(5, 'Cat', '2025-04-04 21:09:32'),
(6, 'Monkey', '2025-04-09 19:35:13');

-- --------------------------------------------------------

--
-- Table structure for table `pet_images`
--

CREATE TABLE `pet_images` (
  `image_id` int(11) NOT NULL,
  `puppy_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pet_images`
--

INSERT INTO `pet_images` (`image_id`, `puppy_id`, `image_url`) VALUES
(4, 7, '../uploads/pets/680788d10a2f9_IMG_2328.jpg'),
(5, 10, '../uploads/pets/6807a095d7054_IMG_2284.jpg'),
(6, 11, '../uploads/pets/6807a0e5e2707_IMG_2316.jpg'),
(7, 11, '../uploads/pets/6807a0e5f0cb2_IMG_2317.jpg'),
(8, 12, '../uploads/pets/6807b1149dec9_istockphoto-1077470274-612x612.jpg'),
(9, 12, '../uploads/pets/6807b114a2229_istockphoto-1133304849-612x612.jpg'),
(10, 12, '../uploads/pets/6807b114a81e4_istockphoto-1446418006-612x612.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `puppy_breed`
--

CREATE TABLE `puppy_breed` (
  `breed_id` int(11) NOT NULL,
  `breed_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `puppy_breed`
--

INSERT INTO `puppy_breed` (`breed_id`, `breed_name`) VALUES
(1, 'German Shepherd'),
(2, 'Bulldog'),
(3, 'Poodle'),
(4, 'Beagle'),
(5, 'Siamese'),
(6, 'Persian'),
(7, 'Maine Coon');

-- --------------------------------------------------------

--
-- Table structure for table `puppy_listing`
--

CREATE TABLE `puppy_listing` (
  `puppy_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `breed_id` int(11) NOT NULL,
  `puppy_name` varchar(100) NOT NULL,
  `puppy_age` int(11) NOT NULL,
  `puppy_location` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `puppy_desc` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `puppy_listing`
--

INSERT INTO `puppy_listing` (`puppy_id`, `category_id`, `breed_id`, `puppy_name`, `puppy_age`, `puppy_location`, `price`, `puppy_desc`, `created_at`) VALUES
(7, 1, 1, 'Pendo', 8, 'Nairobi', '30000.00', 'Purebred German Shepherd puppy with vaccinations', '2025-04-22 12:17:20'),
(10, 1, 1, 'Bruno', 11, 'Nairobi', '38000.00', 'Purebred German Shepherd puppy with vaccinations', '2025-04-22 13:58:45'),
(11, 1, 3, ' Bosco', 8, 'Nairobi', '22000.00', 'Purebred Poodle puppy with vaccinations', '2025-04-22 14:00:05'),
(12, 1, 4, 'Mutina', 3, 'Mombasa', '12000.00', 'Bailey loves snuggles, enjoys playtime with kids, and is already getting the hang of potty training. With those big floppy ears and curious eyes, he&rsquo;s impossible not to fall in love with!', '2025-04-22 15:09:08');

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
-- Indexes for table `pet_images`
--
ALTER TABLE `pet_images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `puppy_id` (`puppy_id`);

--
-- Indexes for table `puppy_breed`
--
ALTER TABLE `puppy_breed`
  ADD PRIMARY KEY (`breed_id`);

--
-- Indexes for table `puppy_listing`
--
ALTER TABLE `puppy_listing`
  ADD PRIMARY KEY (`puppy_id`),
  ADD KEY `idx_category` (`category_id`),
  ADD KEY `idx_breed` (`breed_id`),
  ADD KEY `idx_price` (`price`);

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
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pet_images`
--
ALTER TABLE `pet_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `puppy_breed`
--
ALTER TABLE `puppy_breed`
  MODIFY `breed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `puppy_listing`
--
ALTER TABLE `puppy_listing`
  MODIFY `puppy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pet_images`
--
ALTER TABLE `pet_images`
  ADD CONSTRAINT `pet_images_ibfk_1` FOREIGN KEY (`puppy_id`) REFERENCES `puppy_listing` (`puppy_id`);

--
-- Constraints for table `puppy_listing`
--
ALTER TABLE `puppy_listing`
  ADD CONSTRAINT `puppy_listing_ibfk_2` FOREIGN KEY (`breed_id`) REFERENCES `puppy_breed` (`breed_id`),
  ADD CONSTRAINT `puppy_listing_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `pet_category` (`category_id`),
  ADD CONSTRAINT `puppy_listing_ibfk_4` FOREIGN KEY (`breed_id`) REFERENCES `puppy_breed` (`breed_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
