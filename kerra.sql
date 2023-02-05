-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2022 at 07:52 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rent_fix`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `full_name`, `username`, `password`) VALUES
(1, 'admin', 'admin', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(14, 'Measuring Tools', 'Tood_Category_900.jpg', 'Yes', 'Yes'),
(15, 'Painting Tools', 'Tood_Category_731.jpg', 'Yes', 'Yes'),
(16, 'Home Repair Equipment', 'Tood_Category_129.jpg', 'Yes', 'Yes'),
(17, 'Bicycle Repair Equipment', 'Tood_Category_982.png', 'Yes', 'Yes'),
(18, 'Car Repair Equipment', 'Tool_Category_389.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `rent_order`
--

CREATE TABLE `rent_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `tool` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rent_order`
--

INSERT INTO `rent_order` (`id`, `tool`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`, `user_id`) VALUES
(22, 'drill', '200.00', 1, '200.00', '2022-05-03 05:38:58', 'Delivered', 'user1', '56789488', 'user1@hotmail.sa', 'Riyadh', 1),
(23, 'drill', '200.00', 1, '200.00', '2022-05-03 06:32:02', 'Ordered', 'user1', '56789488', 'user1@hotmail.sa', 'Riyadh', 1),
(24, 'drill', '200.00', 3, '600.00', '2022-05-03 06:32:19', 'Cancelled', 'user1', '56789488', 'user1@hotmail.sa', 'Riyadh', 1),
(25, 'bike stand', '50.00', 1, '50.00', '2022-05-03 07:28:26', 'Cancelled', 'user1', '56789488', 'user1@hotmail.sa', 'Riyadh', 1),
(26, 'brushes ', '500.00', 1, '500.00', '2022-05-03 07:49:58', 'Ordered', 'user1', '56789488', 'user1@hotmail.sa', 'Riyadh', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tools`
--

CREATE TABLE `tools` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tools`
--

INSERT INTO `tools` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(16, 'drill', 'drill', '200.00', 'Tool-Name-9944.jpg', 16, 'Yes', 'Yes'),
(18, 'car set', 'car set ', '60.00', 'carset.jpg', 18, 'Yes', 'Yes'),
(19, 'brushes ', '8 brushes', '500.00', 'Different Types Of Paint Brushes.jpg', 15, 'Yes', 'Yes'),
(20, 'bike stand', 'bike stand for bicycle', '50.00', 'bike.jpg', 17, 'Yes', 'Yes'),
(21, 'car tool', 'des. car', '20.00', 'car.jpg', 18, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_pass` varchar(100) NOT NULL,
  `user_phone` int(10) NOT NULL,
  `user_address` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_pass`, `user_phone`, `user_address`) VALUES
(1, 'user1', 'user1@hotmail.sa', '$2y$10$AcJKPl5epqxwi/eXtxHBrej.aVgQA5PWBHa3bKR4qDE1o/nElaRkS', 56789488, 'Riyadh'),
(5, 'user2', 'user2@gmail.com', '$2y$10$rpgKmRU8V.1..EYRgIs4euYS3OJ4X89/Eu47qLznNilKh1Of6fvUK', 566666666, 'Riyadh'),
(6, 'user3', 'user3@hotmail.com', '$2y$10$haP1scrpE1EbPtA0vB0ZSeSF4Y6vyHBD/hA1zmHW1w5wB7grEssMG', 566666666, 'Riyadh');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rent_order`
--
ALTER TABLE `rent_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tools`
--
ALTER TABLE `tools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `rent_order`
--
ALTER TABLE `rent_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tools`
--
ALTER TABLE `tools`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
