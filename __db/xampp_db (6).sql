-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2024 at 08:31 PM
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
-- Database: `xampp_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(17, 22, '2024-11-03 23:30:51', '2024-11-03 23:30:51'),
(19, 26, '2024-11-04 00:43:55', '2024-11-04 00:43:55');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `listing_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `listings`
--

CREATE TABLE `listings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `category` enum('keyboards','mice','gpu','cpu','ram','prebuilt') NOT NULL,
  `img_url` varchar(255) NOT NULL,
  `brand` enum('apple','samsung','sony','dell','asus') NOT NULL,
  `rating` float NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `listings`
--

INSERT INTO `listings` (`id`, `name`, `description`, `price`, `category`, `img_url`, `brand`, `rating`, `created_at`, `updated_at`) VALUES
(1, 'Product 1', 'Description for product 1', 1531.77, 'keyboards', 'https://picsum.photos/id/1/280', 'apple', 3.8, '2022-08-31 10:50:43', '2022-12-04 03:52:48'),
(2, 'Product 2', 'Description for product 2', 1708.29, 'cpu', 'https://picsum.photos/id/2/280', 'apple', 3.4, '2021-10-19 16:04:49', '2021-08-12 23:17:22'),
(3, 'Product 3', 'Description for product 3', 1623.93, 'cpu', 'https://picsum.photos/id/3/280', 'samsung', 4, '2021-03-26 15:29:20', '2023-01-20 17:15:50'),
(4, 'Product 4', 'Description for product 4', 1417.34, 'mice', 'https://picsum.photos/id/4/280', 'apple', 4.7, '2021-06-21 09:32:54', '2022-07-10 04:47:21'),
(5, 'Product 5', 'Description for product 5', 1423.52, 'gpu', 'https://picsum.photos/id/5/280', 'apple', 1.7, '2023-09-20 17:21:37', '2021-02-23 07:58:21'),
(6, 'Product 6', 'Description for product 6', 1851.67, 'gpu', 'https://picsum.photos/id/6/280', 'asus', 1.1, '2021-07-25 10:31:53', '2021-02-05 12:37:01'),
(7, 'Product 7', 'Description for product 7', 358.35, 'keyboards', 'https://picsum.photos/id/7/280', 'samsung', 4.8, '2023-11-06 14:22:53', '2023-12-23 16:33:42'),
(8, 'Product 8', 'Description for product 8', 1888.48, 'keyboards', 'https://picsum.photos/id/8/280', 'dell', 1, '2023-12-19 23:26:07', '2022-09-23 19:08:36'),
(9, 'Product 9', 'Description for product 9', 1663.19, 'prebuilt', 'https://picsum.photos/id/9/280', 'samsung', 1.9, '2023-03-13 10:31:59', '2023-08-20 21:50:37'),
(10, 'Product 10', 'Description for product 10', 469.64, 'prebuilt', 'https://picsum.photos/id/10/280', 'samsung', 2.9, '2023-11-07 16:16:54', '2023-06-01 13:18:45'),
(11, 'Product 11', 'Description for product 11', 1606.47, 'ram', 'https://picsum.photos/id/11/280', 'sony', 2.6, '2021-04-11 10:42:06', '2021-12-27 20:49:04'),
(12, 'Product 12', 'Description for product 12', 1295.15, 'gpu', 'https://picsum.photos/id/12/280', 'apple', 3.2, '2023-02-10 07:34:47', '2021-04-18 09:06:28'),
(13, 'Product 13', 'Description for product 13', 744.44, 'keyboards', 'https://picsum.photos/id/13/280', 'asus', 3.9, '2021-02-10 11:27:36', '2023-08-23 16:25:07'),
(14, 'Product 14', 'Description for product 14', 1605.8, 'prebuilt', 'https://picsum.photos/id/14/280', 'asus', 2.7, '2022-02-28 21:53:38', '2022-09-15 15:30:07'),
(15, 'Product 15', 'Description for product 15', 1889.97, 'ram', 'https://picsum.photos/id/15/280', 'apple', 3.9, '2021-05-01 14:04:02', '2023-07-15 07:19:53'),
(16, 'Product 16', 'Description for product 16', 657.07, 'gpu', 'https://picsum.photos/id/16/280', 'apple', 2.8, '2021-06-15 07:16:43', '2021-04-23 18:33:01'),
(17, 'Product 17', 'Description for product 17', 1847.66, 'ram', 'https://picsum.photos/id/17/280', 'sony', 5, '2022-07-03 15:32:13', '2023-02-21 19:44:28'),
(18, 'Product 18', 'Description for product 18', 1594.67, 'mice', 'https://picsum.photos/id/18/280', 'apple', 1.2, '2022-03-21 18:43:50', '2023-06-15 02:45:33'),
(19, 'Product 19', 'Description for product 19', 163.46, 'ram', 'https://picsum.photos/id/19/280', 'sony', 3.2, '2023-12-30 21:44:20', '2022-05-30 15:14:01'),
(20, 'Product 20', 'Description for product 20', 1869.56, 'ram', 'https://picsum.photos/id/20/280', 'samsung', 1.9, '2022-01-12 08:12:00', '2021-06-16 23:57:43'),
(21, 'Product 21', 'Description for product 21', 1489.89, 'prebuilt', 'https://picsum.photos/id/21/280', 'asus', 3.2, '2021-05-23 03:22:01', '2023-03-24 14:54:57'),
(22, 'Product 22', 'Description for product 22', 1062.25, 'prebuilt', 'https://picsum.photos/id/22/280', 'asus', 1.6, '2022-12-03 16:03:43', '2022-09-27 12:07:32'),
(23, 'Product 23', 'Description for product 23', 725.29, 'cpu', 'https://picsum.photos/id/23/280', 'dell', 4.9, '2023-11-06 08:20:36', '2021-04-13 22:14:03'),
(24, 'Product 24', 'Description for product 24', 1882.47, 'mice', 'https://picsum.photos/id/24/280', 'apple', 2.6, '2021-04-11 06:41:35', '2021-05-10 15:34:29'),
(25, 'Product 25', 'Description for product 25', 1861.55, 'ram', 'https://picsum.photos/id/25/280', 'apple', 1.6, '2021-12-19 04:28:14', '2021-05-08 09:41:35'),
(26, 'Product 26', 'Description for product 26', 474.04, 'cpu', 'https://picsum.photos/id/26/280', 'sony', 1, '2022-09-09 14:05:31', '2021-12-31 21:30:32'),
(27, 'Product 27', 'Description for product 27', 16.96, 'mice', 'https://picsum.photos/id/27/280', 'apple', 2.6, '2021-11-08 16:03:12', '2023-01-12 20:06:55'),
(28, 'Product 28', 'Description for product 28', 1763.43, 'prebuilt', 'https://picsum.photos/id/28/280', 'samsung', 1.2, '2021-01-07 11:43:54', '2023-08-15 17:57:23'),
(29, 'Product 29', 'Description for product 29', 1171.3, 'mice', 'https://picsum.photos/id/29/280', 'sony', 2.4, '2023-08-06 20:43:59', '2022-03-24 01:29:43'),
(30, 'Product 30', 'Description for product 30', 302.34, 'gpu', 'https://picsum.photos/id/30/280', 'sony', 4.1, '2023-09-30 20:48:19', '2023-01-12 18:54:28'),
(31, 'Product 31', 'Description for product 31', 1220.94, 'mice', 'https://picsum.photos/id/31/280', 'apple', 4.4, '2022-09-23 21:18:06', '2022-03-14 06:12:34'),
(32, 'Product 32', 'Description for product 32', 261.46, 'prebuilt', 'https://picsum.photos/id/32/280', 'sony', 3.8, '2022-07-29 23:52:01', '2022-03-18 20:43:58'),
(33, 'Product 33', 'Description for product 33', 1938.77, 'gpu', 'https://picsum.photos/id/33/280', 'asus', 4, '2021-06-22 04:58:14', '2021-02-07 18:23:04'),
(34, 'Product 34', 'Description for product 34', 1372.64, 'prebuilt', 'https://picsum.photos/id/34/280', 'apple', 1.8, '2021-02-20 05:00:07', '2023-12-20 01:19:41'),
(35, 'Product 35', 'Description for product 35', 1109.6, 'prebuilt', 'https://picsum.photos/id/35/280', 'apple', 1.8, '2021-11-08 08:57:28', '2021-11-01 12:29:50'),
(36, 'Product 36', 'Description for product 36', 12.57, 'keyboards', 'https://picsum.photos/id/36/280', 'sony', 3.6, '2023-02-19 18:02:28', '2021-07-30 13:09:29'),
(37, 'Product 37', 'Description for product 37', 934.67, 'keyboards', 'https://picsum.photos/id/37/280', 'asus', 2, '2021-10-16 01:52:41', '2021-11-30 08:42:37'),
(38, 'Product 38', 'Description for product 38', 1727.18, 'ram', 'https://picsum.photos/id/38/280', 'dell', 4, '2022-03-05 17:26:13', '2022-10-14 07:49:11'),
(39, 'Product 39', 'Description for product 39', 1275.8, 'keyboards', 'https://picsum.photos/id/39/280', 'dell', 4, '2023-12-25 15:45:30', '2022-02-17 04:03:53'),
(40, 'Product 40', 'Description for product 40', 1455.32, 'mice', 'https://picsum.photos/id/40/280', 'apple', 3.7, '2021-04-26 01:42:08', '2021-07-01 17:08:04'),
(41, 'Product 41', 'Description for product 41', 555.71, 'mice', 'https://picsum.photos/id/41/280', 'sony', 2.8, '2022-07-29 13:38:20', '2021-02-19 00:10:19'),
(42, 'Product 42', 'Description for product 42', 406.52, 'cpu', 'https://picsum.photos/id/42/280', 'dell', 1.3, '2023-05-19 03:07:28', '2023-05-15 10:42:20'),
(43, 'Product 43', 'Description for product 43', 1938.44, 'cpu', 'https://picsum.photos/id/43/280', 'apple', 1.7, '2021-05-30 23:35:33', '2021-06-10 10:02:27'),
(44, 'Product 44', 'Description for product 44', 1432.63, 'gpu', 'https://picsum.photos/id/44/280', 'samsung', 3.7, '2022-01-04 21:26:58', '2022-07-26 12:32:15'),
(45, 'Product 45', 'Description for product 45', 1170.63, 'prebuilt', 'https://picsum.photos/id/45/280', 'asus', 2.6, '2022-10-12 08:46:13', '2023-12-16 09:21:35'),
(46, 'Product 46', 'Description for product 46', 174.1, 'ram', 'https://picsum.photos/id/46/280', 'samsung', 2.7, '2023-03-10 15:32:37', '2023-12-29 04:03:48'),
(47, 'Product 47', 'Description for product 47', 1192.48, 'ram', 'https://picsum.photos/id/47/280', 'sony', 1.2, '2021-01-10 19:48:08', '2022-05-04 18:03:48'),
(48, 'Product 48', 'Description for product 48', 1213.91, 'mice', 'https://picsum.photos/id/48/280', 'apple', 2.9, '2023-04-24 05:59:46', '2021-09-04 13:12:35'),
(49, 'Product 49', 'Description for product 49', 1871.1, 'cpu', 'https://picsum.photos/id/49/280', 'sony', 1.9, '2021-07-20 21:47:59', '2021-03-05 16:42:04'),
(50, 'Product 50', 'Description for product 50', 1120.4, 'keyboards', 'https://picsum.photos/id/50/280', 'asus', 2.5, '2023-09-02 13:33:06', '2022-08-16 07:28:04'),
(51, 'Product 51', 'Description for product 51', 401.53, 'ram', 'https://picsum.photos/id/51/280', 'sony', 2.5, '2023-01-19 03:11:01', '2021-06-08 11:57:40'),
(52, 'Product 52', 'Description for product 52', 1798.49, 'mice', 'https://picsum.photos/id/52/280', 'dell', 4.3, '2022-05-23 09:13:25', '2021-02-17 16:46:04'),
(53, 'Product 53', 'Description for product 53', 375, 'keyboards', 'https://picsum.photos/id/53/280', 'dell', 4.1, '2023-12-10 07:54:17', '2022-01-20 04:18:15'),
(54, 'Product 54', 'Description for product 54', 941.19, 'mice', 'https://picsum.photos/id/54/280', 'sony', 1.4, '2022-05-02 22:01:31', '2023-05-03 13:33:01'),
(55, 'Product 55', 'Description for product 55', 1215.97, 'gpu', 'https://picsum.photos/id/55/280', 'dell', 1.9, '2022-09-10 19:37:41', '2022-06-24 16:53:40'),
(56, 'Product 56', 'Description for product 56', 930.88, 'cpu', 'https://picsum.photos/id/56/280', 'asus', 3.5, '2021-03-11 02:33:13', '2022-02-27 08:45:44'),
(57, 'Product 57', 'Description for product 57', 57.56, 'ram', 'https://picsum.photos/id/57/280', 'sony', 4.2, '2023-10-07 02:19:13', '2022-02-04 05:49:39'),
(58, 'Product 58', 'Description for product 58', 1159.5, 'prebuilt', 'https://picsum.photos/id/58/280', 'sony', 4.9, '2021-03-30 01:48:41', '2022-12-31 08:05:22'),
(59, 'Product 59', 'Description for product 59', 1765.23, 'ram', 'https://picsum.photos/id/59/280', 'dell', 2.4, '2023-11-14 22:24:38', '2023-06-28 06:50:44'),
(60, 'Product 60', 'Description for product 60', 81.06, 'gpu', 'https://picsum.photos/id/60/280', 'dell', 2.3, '2022-01-24 02:40:53', '2022-12-18 22:55:11'),
(61, 'Product 61', 'Description for product 61', 672.65, 'cpu', 'https://picsum.photos/id/61/280', 'dell', 1.4, '2023-01-26 18:19:15', '2023-11-23 18:16:56'),
(62, 'Product 62', 'Description for product 62', 145.93, 'mice', 'https://picsum.photos/id/62/280', 'dell', 4.5, '2021-10-02 19:38:36', '2023-04-25 19:57:31'),
(63, 'Product 63', 'Description for product 63', 406.96, 'keyboards', 'https://picsum.photos/id/63/280', 'apple', 2.4, '2023-01-18 09:41:48', '2021-10-18 20:44:12'),
(64, 'Product 64', 'Description for product 64', 1805.22, 'keyboards', 'https://picsum.photos/id/64/280', 'samsung', 1.4, '2022-01-20 13:44:34', '2022-01-19 19:50:53'),
(65, 'Product 65', 'Description for product 65', 1214.12, 'ram', 'https://picsum.photos/id/65/280', 'apple', 2.6, '2021-06-13 20:28:55', '2021-10-09 09:27:29'),
(66, 'Product 66', 'Description for product 66', 647.65, 'gpu', 'https://picsum.photos/id/66/280', 'sony', 3.6, '2021-09-29 04:46:40', '2021-08-07 19:07:50'),
(67, 'Product 67', 'Description for product 67', 1700.78, 'keyboards', 'https://picsum.photos/id/67/280', 'sony', 2.4, '2021-11-07 06:30:37', '2023-05-23 01:21:36'),
(68, 'Product 68', 'Description for product 68', 712.45, 'keyboards', 'https://picsum.photos/id/68/280', 'sony', 4.4, '2022-07-31 11:40:24', '2023-10-14 13:10:13'),
(69, 'Product 69', 'Description for product 69', 325.94, 'ram', 'https://picsum.photos/id/69/280', 'apple', 1.1, '2023-08-13 02:29:52', '2023-12-01 16:39:24'),
(70, 'Product 70', 'Description for product 70', 1234.09, 'mice', 'https://picsum.photos/id/70/280', 'apple', 3.4, '2021-01-11 23:57:04', '2023-04-22 13:10:42'),
(71, 'Product 71', 'Description for product 71', 1159.14, 'keyboards', 'https://picsum.photos/id/71/280', 'samsung', 3, '2023-01-08 02:42:42', '2022-05-21 15:36:45'),
(72, 'Product 72', 'Description for product 72', 911.31, 'cpu', 'https://picsum.photos/id/72/280', 'asus', 4.7, '2022-06-03 13:17:28', '2022-01-30 05:22:28'),
(73, 'Product 73', 'Description for product 73', 1298.03, 'mice', 'https://picsum.photos/id/73/280', 'dell', 1.2, '2021-12-14 18:27:16', '2021-06-06 01:52:27'),
(74, 'Product 74', 'Description for product 74', 739.87, 'cpu', 'https://picsum.photos/id/74/280', 'dell', 1.9, '2021-07-07 08:23:43', '2022-08-02 04:28:00'),
(75, 'Product 75', 'Description for product 75', 276.86, 'gpu', 'https://picsum.photos/id/75/280', 'samsung', 3.8, '2022-12-26 20:30:11', '2021-08-05 15:19:26'),
(76, 'Product 76', 'Description for product 76', 1027.37, 'mice', 'https://picsum.photos/id/76/280', 'sony', 2.7, '2021-10-08 02:53:25', '2023-08-01 17:53:22'),
(77, 'Product 77', 'Description for product 77', 179.65, 'cpu', 'https://picsum.photos/id/77/280', 'sony', 1.6, '2022-07-25 00:49:14', '2022-11-04 09:10:08'),
(78, 'Product 78', 'Description for product 78', 200.97, 'ram', 'https://picsum.photos/id/78/280', 'apple', 2.3, '2023-07-30 07:13:34', '2021-12-22 05:03:32'),
(79, 'Product 79', 'Description for product 79', 1882.06, 'gpu', 'https://picsum.photos/id/79/280', 'dell', 3.3, '2021-02-18 06:49:04', '2021-08-10 02:15:46'),
(80, 'Product 80', 'Description for product 80', 226.52, 'gpu', 'https://picsum.photos/id/80/280', 'apple', 1.1, '2021-04-21 22:55:54', '2021-06-13 22:30:42'),
(81, 'Product 81', 'Description for product 81', 433.12, 'ram', 'https://picsum.photos/id/81/280', 'samsung', 3.5, '2022-09-26 18:47:36', '2022-10-01 04:08:49'),
(82, 'Product 82', 'Description for product 82', 416.53, 'mice', 'https://picsum.photos/id/82/280', 'sony', 2.5, '2022-06-27 15:20:34', '2021-03-11 20:59:15'),
(83, 'Product 83', 'Description for product 83', 1049.28, 'gpu', 'https://picsum.photos/id/83/280', 'asus', 2.5, '2021-07-16 05:06:00', '2023-08-31 12:01:16'),
(84, 'Product 84', 'Description for product 84', 561.83, 'gpu', 'https://picsum.photos/id/84/280', 'asus', 2.4, '2023-07-04 17:20:48', '2023-11-03 17:46:46'),
(85, 'Product 85', 'Description for product 85', 505.12, 'prebuilt', 'https://picsum.photos/id/85/280', 'asus', 1.1, '2021-11-24 00:33:52', '2022-02-15 07:25:07'),
(86, 'Product 86', 'Description for product 86', 1580.03, 'mice', 'https://picsum.photos/id/86/280', 'apple', 1, '2021-12-02 13:50:53', '2021-10-28 15:12:20'),
(87, 'Product 87', 'Description for product 87', 1420.3, 'ram', 'https://picsum.photos/id/87/280', 'samsung', 2, '2022-05-29 12:43:27', '2023-04-21 04:58:54'),
(88, 'Product 88', 'Description for product 88', 194.64, 'ram', 'https://picsum.photos/id/88/280', 'sony', 5, '2023-03-28 20:56:13', '2022-09-13 17:05:55'),
(89, 'Product 89', 'Description for product 89', 1298.55, 'ram', 'https://picsum.photos/id/89/280', 'asus', 3.7, '2023-11-01 04:42:12', '2021-08-27 06:03:01'),
(90, 'Product 90', 'Description for product 90', 794.82, 'mice', 'https://picsum.photos/id/90/280', 'asus', 5, '2021-09-09 08:37:48', '2021-09-11 14:22:26'),
(91, 'Product 91', 'Description for product 91', 1069.9, 'mice', 'https://picsum.photos/id/91/280', 'apple', 4.5, '2023-01-29 05:28:53', '2022-01-22 22:27:59'),
(92, 'Product 92', 'Description for product 92', 967.13, 'prebuilt', 'https://picsum.photos/id/92/280', 'samsung', 1.4, '2023-08-08 01:51:50', '2023-11-24 20:35:59'),
(93, 'Product 93', 'Description for product 93', 269.23, 'mice', 'https://picsum.photos/id/93/280', 'dell', 2.4, '2023-09-15 01:40:30', '2022-08-21 10:10:19'),
(94, 'Product 94', 'Description for product 94', 1491.77, 'prebuilt', 'https://picsum.photos/id/94/280', 'sony', 4.8, '2021-07-31 13:38:02', '2023-07-21 11:10:20'),
(95, 'Product 95', 'Description for product 95', 730.36, 'ram', 'https://picsum.photos/id/95/280', 'dell', 3, '2021-06-03 17:30:50', '2022-09-04 02:40:11'),
(96, 'Product 96', 'Description for product 96', 702.55, 'gpu', 'https://picsum.photos/id/96/280', 'apple', 1.3, '2021-09-20 06:46:00', '2023-09-03 22:55:09'),
(97, 'Product 97', 'Description for product 97', 1621.87, 'keyboards', 'https://picsum.photos/id/97/280', 'sony', 1.7, '2022-07-26 06:20:33', '2021-09-27 08:05:16'),
(98, 'Product 98', 'Description for product 98', 723.03, 'gpu', 'https://picsum.photos/id/98/280', 'sony', 2.4, '2022-06-23 12:50:04', '2021-12-18 05:19:31'),
(99, 'Product 99', 'Description for product 99', 1611.04, 'mice', 'https://picsum.photos/id/99/280', 'samsung', 2.1, '2022-07-06 12:29:54', '2023-12-13 03:13:33'),
(100, 'Product 100', 'Description for product 100', 20.23, 'mice', 'https://picsum.photos/id/100/280', 'samsung', 2.1, '2023-10-01 15:50:55', '2023-03-26 16:03:16'),
(101, 'Product 101', 'Description for product 101', 1203.65, 'mice', 'https://picsum.photos/id/101/280', 'sony', 1.2, '2021-01-21 02:11:49', '2023-04-13 15:19:57'),
(102, 'Product 102', 'Description for product 102', 713.25, 'cpu', 'https://picsum.photos/id/102/280', 'apple', 3.1, '2023-06-29 00:42:39', '2023-04-09 09:44:12'),
(103, 'Product 103', 'Description for product 103', 589.51, 'cpu', 'https://picsum.photos/id/103/280', 'apple', 3.9, '2023-01-03 12:50:14', '2021-01-22 17:25:37'),
(104, 'Product 104', 'Description for product 104', 153.68, 'gpu', 'https://picsum.photos/id/104/280', 'sony', 2.7, '2022-06-16 03:03:16', '2021-05-13 22:07:32'),
(105, 'Product 105', 'Description for product 105', 884.96, 'ram', 'https://picsum.photos/id/105/280', 'apple', 2.2, '2023-06-25 15:47:29', '2021-10-29 13:59:07'),
(106, 'Product 106', 'Description for product 106', 1939.93, 'gpu', 'https://picsum.photos/id/106/280', 'sony', 4.3, '2021-11-06 09:36:42', '2022-06-06 11:19:34'),
(107, 'Product 107', 'Description for product 107', 907.09, 'keyboards', 'https://picsum.photos/id/107/280', 'asus', 2.4, '2022-05-28 19:23:14', '2021-08-29 06:56:03'),
(108, 'Product 108', 'Description for product 108', 1916.86, 'prebuilt', 'https://picsum.photos/id/108/280', 'apple', 4.6, '2021-05-27 21:21:58', '2021-03-28 12:06:08'),
(109, 'Product 109', 'Description for product 109', 1560.5, 'ram', 'https://picsum.photos/id/109/280', 'sony', 2.9, '2022-08-28 17:47:08', '2021-11-04 17:43:30'),
(110, 'Product 110', 'Description for product 110', 1278, 'ram', 'https://picsum.photos/id/110/280', 'asus', 4.9, '2022-05-30 06:40:29', '2021-01-28 05:57:59'),
(111, 'Product 111', 'Description for product 111', 1596.02, 'ram', 'https://picsum.photos/id/111/280', 'samsung', 4, '2022-07-18 11:39:15', '2021-03-23 13:03:26'),
(112, 'Product 112', 'Description for product 112', 48.32, 'prebuilt', 'https://picsum.photos/id/112/280', 'asus', 2.6, '2023-06-10 18:37:44', '2023-02-12 08:18:51'),
(113, 'Product 113', 'Description for product 113', 166.37, 'mice', 'https://picsum.photos/id/113/280', 'samsung', 2, '2021-11-08 09:14:51', '2023-06-24 13:51:48'),
(114, 'Product 114', 'Description for product 114', 1264.72, 'gpu', 'https://picsum.photos/id/114/280', 'samsung', 3.6, '2021-01-28 18:36:19', '2022-05-23 04:12:48'),
(115, 'Product 115', 'Description for product 115', 490.22, 'ram', 'https://picsum.photos/id/115/280', 'apple', 2, '2021-03-24 08:10:55', '2021-12-05 21:47:59'),
(116, 'Product 116', 'Description for product 116', 340.78, 'keyboards', 'https://picsum.photos/id/116/280', 'sony', 2.5, '2021-11-01 07:00:35', '2023-04-21 08:11:32'),
(117, 'Product 117', 'Description for product 117', 1822.18, 'mice', 'https://picsum.photos/id/117/280', 'dell', 4.9, '2021-11-30 05:43:55', '2021-02-23 21:01:36'),
(118, 'Product 118', 'Description for product 118', 1147.86, 'cpu', 'https://picsum.photos/id/118/280', 'samsung', 3.3, '2021-08-10 04:22:59', '2021-03-22 19:50:07'),
(119, 'Product 119', 'Description for product 119', 1766.32, 'cpu', 'https://picsum.photos/id/119/280', 'dell', 2.1, '2021-09-28 17:31:19', '2022-07-16 13:19:10'),
(120, 'Product 120', 'Description for product 120', 174.05, 'gpu', 'https://picsum.photos/id/120/280', 'asus', 1.4, '2022-01-11 01:37:47', '2023-06-19 12:33:11'),
(121, 'Product 121', 'Description for product 121', 264.82, 'ram', 'https://picsum.photos/id/121/280', 'samsung', 4, '2021-08-21 01:18:10', '2023-04-30 02:58:18'),
(122, 'Product 122', 'Description for product 122', 1206.22, 'prebuilt', 'https://picsum.photos/id/122/280', 'samsung', 1.3, '2021-01-31 08:19:03', '2023-03-12 07:50:48'),
(123, 'Product 123', 'Description for product 123', 667.13, 'keyboards', 'https://picsum.photos/id/123/280', 'dell', 1.6, '2022-06-26 01:51:39', '2021-01-09 01:52:58'),
(124, 'Product 124', 'Description for product 124', 641.26, 'keyboards', 'https://picsum.photos/id/124/280', 'dell', 3.3, '2021-01-20 02:10:55', '2023-03-23 10:20:10'),
(125, 'Product 125', 'Description for product 125', 759.74, 'keyboards', 'https://picsum.photos/id/125/280', 'asus', 1.7, '2021-06-04 07:00:47', '2021-01-05 11:50:22'),
(126, 'Product 126', 'Description for product 126', 619.67, 'prebuilt', 'https://picsum.photos/id/126/280', 'asus', 1.2, '2021-11-08 12:17:19', '2022-08-28 11:51:31'),
(127, 'Product 127', 'Description for product 127', 1498.62, 'ram', 'https://picsum.photos/id/127/280', 'samsung', 4, '2023-04-09 21:41:35', '2023-05-04 19:57:33'),
(128, 'Product 128', 'Description for product 128', 170.78, 'prebuilt', 'https://picsum.photos/id/128/280', 'asus', 1.8, '2023-08-21 21:48:28', '2022-02-08 04:17:21'),
(129, 'Product 129', 'Description for product 129', 1316.58, 'ram', 'https://picsum.photos/id/129/280', 'samsung', 2.9, '2023-09-10 19:30:12', '2021-01-23 11:10:08'),
(130, 'Product 130', 'Description for product 130', 1645.07, 'ram', 'https://picsum.photos/id/130/280', 'asus', 4.3, '2021-02-24 15:41:27', '2021-07-07 14:37:41'),
(131, 'Product 131', 'Description for product 131', 761.16, 'mice', 'https://picsum.photos/id/131/280', 'apple', 4.4, '2023-12-26 13:10:53', '2023-11-06 17:58:23'),
(132, 'Product 132', 'Description for product 132', 225.12, 'ram', 'https://picsum.photos/id/132/280', 'dell', 1.8, '2021-01-12 01:28:02', '2023-10-04 12:43:27'),
(133, 'Product 133', 'Description for product 133', 338.61, 'keyboards', 'https://picsum.photos/id/133/280', 'sony', 1.2, '2023-03-20 09:01:45', '2022-11-12 15:38:34'),
(134, 'Product 134', 'Description for product 134', 213.29, 'cpu', 'https://picsum.photos/id/134/280', 'samsung', 2, '2023-10-02 03:47:27', '2023-11-20 17:41:19'),
(135, 'Product 135', 'Description for product 135', 592.78, 'mice', 'https://picsum.photos/id/135/280', 'apple', 4.3, '2022-07-19 20:39:54', '2022-06-21 20:19:47'),
(136, 'Product 136', 'Description for product 136', 202.09, 'prebuilt', 'https://picsum.photos/id/136/280', 'asus', 3.4, '2023-01-18 08:42:45', '2021-02-21 14:10:49'),
(137, 'Product 137', 'Description for product 137', 1092.54, 'cpu', 'https://picsum.photos/id/137/280', 'dell', 3, '2022-11-01 16:21:28', '2023-09-24 22:22:30'),
(138, 'Product 138', 'Description for product 138', 290.11, 'prebuilt', 'https://picsum.photos/id/138/280', 'asus', 3.9, '2021-04-10 15:26:39', '2022-04-02 22:52:24'),
(139, 'Product 139', 'Description for product 139', 1839.23, 'gpu', 'https://picsum.photos/id/139/280', 'samsung', 3.1, '2022-03-07 10:39:35', '2022-02-19 08:35:26'),
(140, 'Product 140', 'Description for product 140', 946.47, 'ram', 'https://picsum.photos/id/140/280', 'apple', 4.8, '2022-02-21 17:11:56', '2021-08-13 18:42:44'),
(141, 'Product 141', 'Description for product 141', 1706.87, 'gpu', 'https://picsum.photos/id/141/280', 'dell', 4.3, '2023-01-13 22:24:11', '2022-02-22 15:34:18'),
(142, 'Product 142', 'Description for product 142', 1190.08, 'prebuilt', 'https://picsum.photos/id/142/280', 'sony', 2.8, '2022-12-14 17:01:44', '2021-08-23 12:51:48'),
(143, 'Product 143', 'Description for product 143', 246.99, 'keyboards', 'https://picsum.photos/id/143/280', 'samsung', 1.4, '2023-08-22 04:56:09', '2022-04-13 14:42:46'),
(144, 'Product 144', 'Description for product 144', 1340.49, 'gpu', 'https://picsum.photos/id/144/280', 'dell', 3.7, '2022-05-15 19:49:08', '2022-01-23 06:08:28'),
(145, 'Product 145', 'Description for product 145', 569.48, 'gpu', 'https://picsum.photos/id/145/280', 'sony', 4.1, '2022-01-16 01:35:25', '2021-12-02 04:59:41'),
(146, 'Product 146', 'Description for product 146', 314.08, 'mice', 'https://picsum.photos/id/146/280', 'dell', 4.1, '2023-05-03 06:30:14', '2022-10-08 14:00:30'),
(147, 'Product 147', 'Description for product 147', 229.29, 'mice', 'https://picsum.photos/id/147/280', 'apple', 2.7, '2021-11-28 21:49:26', '2022-12-09 07:46:48'),
(148, 'Product 148', 'Description for product 148', 1517.18, 'ram', 'https://picsum.photos/id/148/280', 'asus', 4.2, '2022-08-12 16:01:52', '2021-08-23 05:18:41'),
(149, 'Product 149', 'Description for product 149', 1517.98, 'prebuilt', 'https://picsum.photos/id/149/280', 'sony', 4.1, '2023-04-13 06:30:55', '2021-03-04 21:47:09'),
(150, 'Product 150', 'Description for product 150', 1768.94, 'keyboards', 'https://picsum.photos/id/150/280', 'asus', 4.4, '2021-07-12 20:41:54', '2021-08-28 21:53:55'),
(151, 'Product 151', 'Description for product 151', 29.26, 'keyboards', 'https://picsum.photos/id/151/280', 'asus', 4.9, '2021-03-11 04:02:04', '2021-07-23 04:32:29'),
(152, 'Product 152', 'Description for product 152', 1406.84, 'gpu', 'https://picsum.photos/id/152/280', 'sony', 1.9, '2023-07-17 23:37:41', '2023-04-09 08:44:53'),
(153, 'Product 153', 'Description for product 153', 1809.24, 'keyboards', 'https://picsum.photos/id/153/280', 'apple', 1.6, '2021-02-25 10:13:49', '2023-02-21 07:42:48'),
(154, 'Product 154', 'Description for product 154', 632.42, 'keyboards', 'https://picsum.photos/id/154/280', 'apple', 4.1, '2023-02-03 07:57:26', '2023-05-26 17:57:12'),
(155, 'Product 155', 'Description for product 155', 23.22, 'keyboards', 'https://picsum.photos/id/155/280', 'dell', 2, '2021-02-13 21:46:22', '2023-12-05 14:14:50'),
(156, 'Product 156', 'Description for product 156', 1063.54, 'ram', 'https://picsum.photos/id/156/280', 'samsung', 3.8, '2023-01-02 20:01:52', '2021-01-03 12:27:10'),
(157, 'Product 157', 'Description for product 157', 161.11, 'cpu', 'https://picsum.photos/id/157/280', 'apple', 1.8, '2021-09-15 15:59:10', '2023-12-13 15:30:29'),
(158, 'Product 158', 'Description for product 158', 623.85, 'mice', 'https://picsum.photos/id/158/280', 'apple', 1.7, '2021-10-22 17:01:24', '2023-05-23 02:25:26'),
(159, 'Product 159', 'Description for product 159', 1459.75, 'cpu', 'https://picsum.photos/id/159/280', 'samsung', 2.9, '2021-12-11 07:08:43', '2021-12-18 09:45:33'),
(160, 'Product 160', 'Description for product 160', 530.92, 'prebuilt', 'https://picsum.photos/id/160/280', 'asus', 1.1, '2021-11-01 08:42:32', '2022-10-13 03:53:17'),
(161, 'Product 161', 'Description for product 161', 1014.89, 'keyboards', 'https://picsum.photos/id/161/280', 'sony', 3.3, '2022-06-01 17:59:24', '2021-02-27 05:42:14'),
(162, 'Product 162', 'Description for product 162', 1772.76, 'mice', 'https://picsum.photos/id/162/280', 'samsung', 3.5, '2022-12-22 03:28:05', '2023-04-20 02:37:38'),
(163, 'Product 163', 'Description for product 163', 156.23, 'gpu', 'https://picsum.photos/id/163/280', 'dell', 1, '2022-02-21 23:45:12', '2023-09-12 01:05:17'),
(164, 'Product 164', 'Description for product 164', 200.5, 'cpu', 'https://picsum.photos/id/164/280', 'samsung', 3, '2023-08-21 18:25:22', '2022-07-27 19:21:53'),
(165, 'Product 165', 'Description for product 165', 601.57, 'mice', 'https://picsum.photos/id/165/280', 'apple', 2.8, '2021-08-14 22:06:05', '2021-09-22 11:39:20'),
(166, 'Product 166', 'Description for product 166', 66.35, 'ram', 'https://picsum.photos/id/166/280', 'dell', 2.6, '2022-05-10 05:44:30', '2023-01-27 20:09:03'),
(167, 'Product 167', 'Description for product 167', 676.2, 'cpu', 'https://picsum.photos/id/167/280', 'dell', 2.8, '2022-06-23 21:15:18', '2022-10-08 03:32:50'),
(168, 'Product 168', 'Description for product 168', 917.85, 'mice', 'https://picsum.photos/id/168/280', 'dell', 1, '2021-12-01 16:35:16', '2023-08-22 04:34:42'),
(169, 'Product 169', 'Description for product 169', 1421.36, 'mice', 'https://picsum.photos/id/169/280', 'dell', 3, '2023-12-25 20:10:57', '2022-12-07 06:35:24'),
(170, 'Product 170', 'Description for product 170', 1379.37, 'mice', 'https://picsum.photos/id/170/280', 'asus', 3, '2021-10-23 12:03:08', '2023-02-10 15:25:40'),
(171, 'Product 171', 'Description for product 171', 331.74, 'keyboards', 'https://picsum.photos/id/171/280', 'apple', 2.1, '2023-03-26 07:23:24', '2023-03-20 06:01:49'),
(172, 'Product 172', 'Description for product 172', 509.67, 'cpu', 'https://picsum.photos/id/172/280', 'sony', 2.8, '2023-01-20 12:26:23', '2021-03-24 23:14:35'),
(173, 'Product 173', 'Description for product 173', 1235.62, 'keyboards', 'https://picsum.photos/id/173/280', 'samsung', 3.3, '2023-10-12 23:05:24', '2021-12-23 00:43:54'),
(174, 'Product 174', 'Description for product 174', 1711.85, 'ram', 'https://picsum.photos/id/174/280', 'dell', 4, '2022-07-16 11:04:05', '2021-03-06 07:41:16'),
(175, 'Product 175', 'Description for product 175', 688.47, 'keyboards', 'https://picsum.photos/id/175/280', 'apple', 2.3, '2023-06-24 22:47:49', '2023-12-16 20:45:56'),
(176, 'Product 176', 'Description for product 176', 1616.03, 'prebuilt', 'https://picsum.photos/id/176/280', 'apple', 2.8, '2021-07-06 06:17:55', '2023-03-05 09:46:03'),
(177, 'Product 177', 'Description for product 177', 1505.87, 'ram', 'https://picsum.photos/id/177/280', 'asus', 1.1, '2023-10-04 06:30:18', '2023-04-25 01:40:06'),
(178, 'Product 178', 'Description for product 178', 751.79, 'ram', 'https://picsum.photos/id/178/280', 'dell', 3, '2021-08-25 22:38:54', '2023-01-03 00:19:20'),
(179, 'Product 179', 'Description for product 179', 1371.88, 'keyboards', 'https://picsum.photos/id/179/280', 'dell', 4.4, '2021-05-11 01:26:51', '2023-10-14 11:03:19'),
(180, 'Product 180', 'Description for product 180', 1258.17, 'gpu', 'https://picsum.photos/id/180/280', 'dell', 1.3, '2022-10-11 09:46:00', '2021-03-20 06:05:30'),
(181, 'Product 181', 'Description for product 181', 351.38, 'keyboards', 'https://picsum.photos/id/181/280', 'apple', 3.8, '2023-02-06 23:37:00', '2021-12-26 07:03:39'),
(182, 'Product 182', 'Description for product 182', 650.59, 'ram', 'https://picsum.photos/id/182/280', 'sony', 3.3, '2022-10-13 11:07:13', '2021-05-01 17:43:27'),
(183, 'Product 183', 'Description for product 183', 1965.66, 'cpu', 'https://picsum.photos/id/183/280', 'apple', 1.8, '2021-09-24 05:09:09', '2021-01-16 01:17:20'),
(184, 'Product 184', 'Description for product 184', 809.82, 'gpu', 'https://picsum.photos/id/184/280', 'asus', 4.9, '2023-06-12 03:45:12', '2022-05-17 05:25:04'),
(185, 'Product 185', 'Description for product 185', 716.03, 'cpu', 'https://picsum.photos/id/185/280', 'dell', 2.1, '2023-09-11 00:31:12', '2021-01-04 04:30:52'),
(186, 'Product 186', 'Description for product 186', 1229.84, 'keyboards', 'https://picsum.photos/id/186/280', 'samsung', 1.1, '2021-04-19 23:36:36', '2021-08-14 16:48:07'),
(187, 'Product 187', 'Description for product 187', 841.22, 'ram', 'https://picsum.photos/id/187/280', 'asus', 3.8, '2021-08-31 05:42:29', '2022-12-28 21:39:22'),
(188, 'Product 188', 'Description for product 188', 581.01, 'cpu', 'https://picsum.photos/id/188/280', 'apple', 1.7, '2022-09-26 01:50:07', '2022-01-11 14:34:40'),
(189, 'Product 189', 'Description for product 189', 1634.15, 'ram', 'https://picsum.photos/id/189/280', 'sony', 4.7, '2022-06-27 12:26:52', '2021-11-23 07:27:19'),
(190, 'Product 190', 'Description for product 190', 1435.24, 'mice', 'https://picsum.photos/id/190/280', 'samsung', 2.1, '2021-11-02 08:58:23', '2023-09-30 19:40:55'),
(191, 'Product 191', 'Description for product 191', 322.95, 'ram', 'https://picsum.photos/id/191/280', 'asus', 3.3, '2021-02-27 22:40:41', '2021-05-27 13:03:44'),
(192, 'Product 192', 'Description for product 192', 1510.15, 'prebuilt', 'https://picsum.photos/id/192/280', 'asus', 3.3, '2023-07-24 03:58:17', '2023-05-04 20:17:59'),
(193, 'Product 193', 'Description for product 193', 218.42, 'mice', 'https://picsum.photos/id/193/280', 'dell', 2, '2023-11-04 08:04:13', '2022-07-26 03:15:14'),
(194, 'Product 194', 'Description for product 194', 1004.11, 'prebuilt', 'https://picsum.photos/id/194/280', 'dell', 3.1, '2022-03-15 17:46:23', '2022-11-14 22:19:25'),
(195, 'Product 195', 'Description for product 195', 1940.98, 'ram', 'https://picsum.photos/id/195/280', 'dell', 1.7, '2022-08-31 19:16:24', '2022-08-10 02:06:28'),
(196, 'Product 196', 'Description for product 196', 1554.31, 'mice', 'https://picsum.photos/id/196/280', 'apple', 2.7, '2021-08-11 16:21:15', '2022-08-30 00:34:02'),
(197, 'Product 197', 'Description for product 197', 1998.72, 'mice', 'https://picsum.photos/id/197/280', 'apple', 3.2, '2022-11-21 10:39:36', '2021-07-26 12:48:01'),
(198, 'Product 198', 'Description for product 198', 550.89, 'mice', 'https://picsum.photos/id/198/280', 'sony', 2.5, '2021-02-05 20:17:32', '2021-06-23 05:40:09'),
(199, 'Product 199', 'Description for product 199', 186.33, 'gpu', 'https://picsum.photos/id/199/280', 'sony', 4.1, '2023-08-17 08:33:20', '2021-09-07 11:01:46'),
(200, 'Product 200', 'Description for product 200', 1135.96, 'prebuilt', 'https://picsum.photos/id/200/280', 'sony', 1.8, '2023-09-01 17:25:03', '2021-03-24 15:43:11');

-- --------------------------------------------------------

--
-- Table structure for table `order_process_approvals`
--

CREATE TABLE `order_process_approvals` (
  `id` int(11) NOT NULL,
  `placed_order_id` int(11) NOT NULL,
  `supervisor_id` int(11) NOT NULL,
  `next_order_status` enum('order_placed','processing','shipped','out_for_delivery','delivered','cancelled','returned') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_process_approvals`
--

INSERT INTO `order_process_approvals` (`id`, `placed_order_id`, `supervisor_id`, `next_order_status`, `created_at`) VALUES
(12, 19, 1, 'processing', '2024-11-03 23:19:10'),
(13, 19, 1, 'returned', '2024-11-03 23:19:26'),
(14, 21, 1, 'shipped', '2024-11-04 00:44:25');

--
-- Triggers `order_process_approvals`
--
DELIMITER $$
CREATE TRIGGER `update_placed_orders` AFTER INSERT ON `order_process_approvals` FOR EACH ROW BEGIN
  UPDATE `placed_orders`
  SET `order_status` = NEW.`next_order_status`
  WHERE `id` = NEW.`placed_order_id`;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `placed_cart_items`
--

CREATE TABLE `placed_cart_items` (
  `id` int(11) NOT NULL,
  `listing_id` int(11) NOT NULL,
  `placed_order_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `placed_cart_items`
--

INSERT INTO `placed_cart_items` (`id`, `listing_id`, `placed_order_id`, `quantity`, `created_at`, `updated_at`) VALUES
(36, 19, 19, 11, '2024-11-03 23:10:47', '2024-11-03 23:10:47'),
(37, 74, 19, 1, '2024-11-03 23:10:47', '2024-11-03 23:10:47'),
(38, 131, 19, 3, '2024-11-03 23:10:47', '2024-11-03 23:10:47'),
(39, 134, 20, 22, '2024-11-03 23:30:51', '2024-11-03 23:30:51'),
(40, 19, 21, 13, '2024-11-04 00:43:55', '2024-11-04 00:43:55');

-- --------------------------------------------------------

--
-- Table structure for table `placed_orders`
--

CREATE TABLE `placed_orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_status` enum('order_placed','processing','shipped','out_for_delivery','delivered','cancelled','returned') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `placed_orders`
--

INSERT INTO `placed_orders` (`id`, `user_id`, `order_status`, `created_at`, `updated_at`) VALUES
(19, 22, 'returned', '2024-11-03 23:10:47', '2024-11-03 23:19:26'),
(20, 22, 'order_placed', '2024-11-03 23:30:51', '2024-11-03 23:30:51'),
(21, 26, 'shipped', '2024-11-04 00:43:55', '2024-11-04 00:44:25');

-- --------------------------------------------------------

--
-- Table structure for table `supervisors`
--

CREATE TABLE `supervisors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supervisors`
--

INSERT INTO `supervisors` (`id`, `name`, `username`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'test supervisor', 'test', 'test@gmail.com', 'Test1234', '2024-09-16 15:45:05', '2024-09-16 15:45:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `created_at`, `updated_at`) VALUES
(22, 'Test Name', 'test', 'test@gmail.com', 'Test1234', '2024-09-07 22:38:27', '2024-09-07 22:38:27'),
(26, 'senn', 'senn', 'senn@gmail.com', 'Test1234', '2024-11-04 00:34:12', '2024-11-04 00:34:12');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `carts_trigger_for_new_user` AFTER INSERT ON `users` FOR EACH ROW BEGIN
DECLARE new_id INT;
SET new_id = NEW.id;

INSERT INTO carts (user_id) VALUES (new_id);
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cart_id` (`cart_id`,`listing_id`),
  ADD KEY `listing_id` (`listing_id`);

--
-- Indexes for table `listings`
--
ALTER TABLE `listings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_process_approvals`
--
ALTER TABLE `order_process_approvals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_process_approval_ibfk_1` (`supervisor_id`),
  ADD KEY `order_process_approval_ibfk_2` (`placed_order_id`);

--
-- Indexes for table `placed_cart_items`
--
ALTER TABLE `placed_cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `placed_cart_items_ibfk_1` (`listing_id`),
  ADD KEY `placed_cart_items_ibfk_2` (`placed_order_id`);

--
-- Indexes for table `placed_orders`
--
ALTER TABLE `placed_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `placed_orders_ibfk_1` (`user_id`);

--
-- Indexes for table `supervisors`
--
ALTER TABLE `supervisors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `listings`
--
ALTER TABLE `listings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `order_process_approvals`
--
ALTER TABLE `order_process_approvals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `placed_cart_items`
--
ALTER TABLE `placed_cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `placed_orders`
--
ALTER TABLE `placed_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `supervisors`
--
ALTER TABLE `supervisors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`listing_id`) REFERENCES `listings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_process_approvals`
--
ALTER TABLE `order_process_approvals`
  ADD CONSTRAINT `order_process_approvals_ibfk_1` FOREIGN KEY (`supervisor_id`) REFERENCES `supervisors` (`id`),
  ADD CONSTRAINT `order_process_approvals_ibfk_2` FOREIGN KEY (`placed_order_id`) REFERENCES `placed_orders` (`id`);

--
-- Constraints for table `placed_cart_items`
--
ALTER TABLE `placed_cart_items`
  ADD CONSTRAINT `placed_cart_items_ibfk_1` FOREIGN KEY (`listing_id`) REFERENCES `listings` (`id`),
  ADD CONSTRAINT `placed_cart_items_ibfk_2` FOREIGN KEY (`placed_order_id`) REFERENCES `placed_orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `placed_orders`
--
ALTER TABLE `placed_orders`
  ADD CONSTRAINT `placed_orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
