-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2024 at 08:32 PM
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
-- Database: `case_study`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `css_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `css_id`, `name`, `description`) VALUES
(1, 'just-java', 'Just Java', 'Regular house blend, decaffeinated coffee, or flavor of the day.'),
(2, 'cafe-au-lait', 'Cafe au Lait', 'House blended coffee infused into a smooth, steamed milk.'),
(3, 'cappucino', 'Iced Cappucino', 'Sweetened espresso blended with icy-cold milk and served in a chilled glass.');

-- --------------------------------------------------------

--
-- Table structure for table `product_options`
--

CREATE TABLE `product_options` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `css_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_options`
--

INSERT INTO `product_options` (`id`, `product_id`, `css_id`, `name`, `price`) VALUES
(1, 1, 'java-endless', 'Endless Cup', 3),
(3, 2, 'lait-single', 'Single', 4.99),
(4, 2, 'lait-double', 'Double', 3),
(7, 3, 'cappucino-single', 'Single', 4.75),
(8, 3, 'cappucino-double', 'Double', 10);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `product_option_id` int(11) NOT NULL,
  `quantity_sold` int(11) NOT NULL,
  `total_sales` float NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `product_option_id`, `quantity_sold`, `total_sales`, `created_at`) VALUES
(7, 1, 1, 2, '2024-09-06 02:11:35'),
(8, 3, 3, 40.36, '2024-09-06 02:11:35'),
(9, 1, 1, 2, '2024-09-06 02:16:36'),
(10, 3, 3, 40.36, '2024-09-06 02:16:36'),
(11, 8, 4, 23, '2024-09-16 17:29:23'),
(12, 8, 4, 23, '2024-09-16 17:36:58'),
(13, 8, 1, 5.75, '2024-09-16 17:39:02'),
(14, 8, 1, 5.75, '2024-09-16 17:39:18'),
(15, 8, 1, 5.75, '2024-09-16 17:40:03'),
(16, 8, 1, 5.75, '2024-09-16 17:40:37'),
(17, 8, 1, 5.75, '2024-09-16 17:41:19'),
(18, 3, 1, 13.44, '2024-09-16 17:41:37'),
(19, 1, 5, 10, '2024-09-17 21:58:20'),
(20, 4, 23, 69, '2024-09-17 21:58:20'),
(21, 8, 2, 11.5, '2024-09-17 21:58:20'),
(22, 1, 5, 10, '2024-09-17 21:58:32'),
(23, 3, 5, 67.2, '2024-09-17 21:58:32'),
(24, 7, 8, 38, '2024-09-17 21:58:32'),
(25, 4, 3, 9, '2024-09-17 21:58:36'),
(26, 1, 100, 200, '2024-09-17 22:43:16'),
(27, 4, 2, 6, '2024-09-17 22:50:06'),
(28, 1, 2, 6, '2024-09-22 18:32:03'),
(29, 4, 2, 6, '2024-09-22 18:32:03'),
(30, 3, 3, 40.47, '2024-09-22 18:32:08'),
(31, 8, 2, 11.5, '2024-09-22 18:32:13'),
(33, 4, 2, 6, '2024-09-23 12:52:42'),
(34, 7, 3, 14.25, '2024-09-23 12:57:14'),
(35, 1, 5, 15, '2024-09-23 14:06:47'),
(36, 3, 10, 134.9, '2024-09-23 14:06:47'),
(37, 8, 5, 28.75, '2024-09-23 14:06:47'),
(38, 3, 1, 1349, '2024-09-23 14:07:25'),
(39, 1, 1000, 3000, '2024-09-23 14:08:23'),
(40, 1, 1, 3, '2024-10-14 14:33:19'),
(41, 3, 5, 9.95, '2024-10-14 14:33:19'),
(42, 8, 20, 200, '2024-10-14 14:33:19'),
(43, 3, 100, 199, '2024-10-14 14:33:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_options`
--
ALTER TABLE `product_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_options_ibfk_1` (`product_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_ibfk_1` (`product_option_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_options`
--
ALTER TABLE `product_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_options`
--
ALTER TABLE `product_options`
  ADD CONSTRAINT `product_options_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`product_option_id`) REFERENCES `product_options` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
