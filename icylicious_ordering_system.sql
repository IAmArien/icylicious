-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2024 at 06:05 AM
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
-- Database: `icylicious_ordering_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(11) NOT NULL,
  `activity` varchar(255) NOT NULL,
  `activity_date` varchar(255) NOT NULL,
  `activity_time` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_fullname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `activity`, `activity_date`, `activity_time`, `user_email`, `user_fullname`) VALUES
(1, 'Add Category', '2024/07/16', '07:03:10am', 'npalisoc@yondu.com', ' Norman Palisoc'),
(2, 'Delete Category', '2024/07/16', '07:03:13am', 'npalisoc@yondu.com', ' Norman Palisoc'),
(3, 'Update Category', '2024/07/17', '04:36:43pm', 'npalisoc@yondu.com', ' Norman Palisoc'),
(4, 'Update User', '2024/07/17', '04:36:48pm', 'npalisoc@yondu.com', ' Norman Palisoc'),
(5, 'Update Order', '2024/07/17', '04:36:56pm', 'npalisoc@yondu.com', ' Norman Palisoc'),
(6, 'Update Order', '2024/07/17', '04:37:00pm', 'npalisoc@yondu.com', ' Norman Palisoc'),
(7, 'Login', '2024/07/17', '04:42:07pm', 'npalisoc@yondu.com', ' Norman Palisoc'),
(8, 'Add Order', '2024/07/17', '04:59:34pm', 'npalisoc@yondu.com', ' Norman Palisoc'),
(9, 'Login', '2024/07/17', '05:17:03pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(10, 'Add Order', '2024/07/17', '05:18:08pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(11, 'Login', '2024/07/18', '11:30:24pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(12, 'Add Order', '2024/07/18', '11:30:59pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(13, 'Delete Orders', '2024/07/18', '11:31:16pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(14, 'Login', '2024/07/18', '11:50:12pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(15, 'Archived Product: 38', '2024/07/18', '11:54:57pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(16, 'Archived Product: 36', '2024/07/18', '11:55:00pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(17, 'Login', '2024/07/18', '11:56:36pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(18, 'Archived Product: 35', '2024/07/19', '12:07:37am', 'npalisoc@yondu.com', 'BINI AIAH'),
(19, 'Archived Product: 38', '2024/07/19', '12:13:43am', 'npalisoc@yondu.com', 'BINI AIAH'),
(20, 'Archived Product: 36', '2024/07/19', '12:13:50am', 'npalisoc@yondu.com', 'BINI AIAH'),
(21, 'Archived Product: 35', '2024/07/19', '12:13:52am', 'npalisoc@yondu.com', 'BINI AIAH'),
(22, 'Archived Product: 38', '2024/07/19', '12:14:38am', 'npalisoc@yondu.com', 'BINI AIAH'),
(23, 'Archived Product: 36', '2024/07/19', '12:14:42am', 'npalisoc@yondu.com', 'BINI AIAH'),
(24, 'Archived Product: 34', '2024/07/19', '12:15:24am', 'npalisoc@yondu.com', 'BINI AIAH'),
(25, 'Archived Product: 37', '2024/07/19', '12:16:16am', 'npalisoc@yondu.com', 'BINI AIAH'),
(26, 'Archived Product: 33', '2024/07/19', '12:16:22am', 'npalisoc@yondu.com', 'BINI AIAH'),
(27, 'Archived Product: 38', '2024/07/19', '12:24:09am', 'npalisoc@yondu.com', 'BINI AIAH'),
(28, 'Archived Product: 36', '2024/07/19', '12:24:11am', 'npalisoc@yondu.com', 'BINI AIAH'),
(29, 'Archived Product: 34', '2024/07/19', '12:24:13am', 'npalisoc@yondu.com', 'BINI AIAH'),
(30, 'Archived Product: 37', '2024/07/19', '12:24:15am', 'npalisoc@yondu.com', 'BINI AIAH'),
(31, 'Archived Product: 33', '2024/07/19', '12:24:16am', 'npalisoc@yondu.com', 'BINI AIAH'),
(32, 'Login', '2024/07/21', '01:36:11pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(33, 'Add Order', '2024/07/21', '01:36:23pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(34, 'Delete Orders', '2024/07/21', '01:36:35pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(35, 'Add Order', '2024/07/21', '03:20:01pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(36, 'Add Order', '2024/07/21', '03:25:31pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(37, 'Add Order', '2024/07/21', '03:25:34pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(38, 'Add Order', '2024/07/21', '03:25:37pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(39, 'Checkout', '2024/07/21', '03:25:49pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(40, 'Add Order', '2024/07/21', '03:28:22pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(41, 'Add Order', '2024/07/21', '03:28:24pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(42, 'Checkout', '2024/07/21', '03:28:31pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(43, 'Add Order', '2024/07/21', '03:34:11pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(44, 'Add Order', '2024/07/21', '03:34:12pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(45, 'Add Order', '2024/07/21', '03:34:14pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(46, 'Checkout', '2024/07/21', '03:34:22pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(47, 'Login', '2024/07/21', '03:35:17pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(48, 'Add Order', '2024/07/21', '04:10:28pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(49, 'Checkout', '2024/07/21', '04:10:37pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(50, 'Add Order', '2024/07/21', '04:12:22pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(51, 'Checkout', '2024/07/21', '04:12:29pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(52, 'Add Order', '2024/07/21', '04:12:54pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(53, 'Add Order', '2024/07/21', '04:12:56pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(54, 'Add Order', '2024/07/21', '04:12:57pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(55, 'Add Order', '2024/07/21', '04:12:59pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(56, 'Checkout', '2024/07/21', '04:13:07pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(57, 'Update Order', '2024/07/21', '04:16:55pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(58, 'Add Order', '2024/07/21', '04:36:14pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(59, 'Add Order', '2024/07/21', '04:36:16pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(60, 'Add Order', '2024/07/21', '04:36:19pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(61, 'Checkout', '2024/07/21', '04:36:30pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(62, 'Add Order', '2024/07/21', '04:42:56pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(63, 'Add Order', '2024/07/21', '04:42:58pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(64, 'Checkout', '2024/07/21', '04:43:06pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(65, 'Login', '2024/07/21', '05:55:33pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(66, 'Login', '2024/07/22', '05:01:39am', 'npalisoc@yondu.com', 'BINI AIAH'),
(67, 'Add Order', '2024/07/22', '05:14:11am', 'npalisoc@yondu.com', 'BINI AIAH'),
(68, 'Checkout', '2024/07/22', '05:14:17am', 'npalisoc@yondu.com', 'BINI AIAH'),
(69, 'Exported Orders', '2024/07/22', '05:36:35am', 'npalisoc@yondu.com', 'BINI AIAH'),
(70, 'Exported Orders', '2024/07/22', '05:37:31am', 'npalisoc@yondu.com', 'BINI AIAH'),
(71, 'Exported Orders', '2024/07/22', '05:38:15am', 'npalisoc@yondu.com', 'BINI AIAH'),
(72, 'Exported Orders', '2024/07/22', '05:38:58am', 'npalisoc@yondu.com', 'BINI AIAH'),
(73, 'Exported Orders', '2024/07/22', '05:39:40am', 'npalisoc@yondu.com', 'BINI AIAH'),
(74, 'Exported Orders', '2024/07/22', '05:42:12am', 'npalisoc@yondu.com', 'BINI AIAH'),
(75, 'Exported Orders', '2024/07/22', '05:44:24am', 'npalisoc@yondu.com', 'BINI AIAH'),
(76, 'Exported Orders', '2024/07/22', '05:45:30am', 'npalisoc@yondu.com', 'BINI AIAH'),
(77, 'Exported Orders', '2024/07/22', '05:46:49am', 'npalisoc@yondu.com', 'BINI AIAH');

-- --------------------------------------------------------

--
-- Table structure for table `best_sellers`
--

CREATE TABLE `best_sellers` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `best_sellers`
--

INSERT INTO `best_sellers` (`id`, `product_id`) VALUES
(1, 35),
(2, 36),
(3, 37),
(4, 38);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` varchar(255) NOT NULL,
  `order_time` varchar(255) NOT NULL,
  `order_quantity` int(11) NOT NULL,
  `is_pickup` int(11) NOT NULL,
  `user_address` varchar(999) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_description`) VALUES
(7, 'Drinks (Cold)', 'Drink-related category (eg. Softdrinks, Soda, Juice, Iced Tea, excluding Milk Tea)'),
(8, 'Coffee', 'Coffee-related category either hot / cold'),
(10, 'Milk Tea', 'Milk Tea-related drinks only (no cold drinks such as softdrinks)'),
(14, 'Desserts', 'Dessert-related such as Ice Cream, Halo-halo, etc.'),
(15, 'Smoothie', 'Smoothie-related drinks');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `contact_subject` varchar(255) NOT NULL,
  `contact_description` varchar(999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `variant_type` varchar(255) NOT NULL,
  `variant_name` varchar(255) NOT NULL,
  `variant_price` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `order_time` varchar(255) NOT NULL,
  `order_quantity` int(11) NOT NULL,
  `is_pickup` int(11) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_address` varchar(999) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `order_total` varchar(255) NOT NULL,
  `order_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `transaction_id`, `product_id`, `product_name`, `variant_id`, `variant_type`, `variant_name`, `variant_price`, `user_id`, `order_date`, `order_time`, `order_quantity`, `is_pickup`, `user_firstname`, `user_lastname`, `user_address`, `user_phone`, `user_email`, `order_status`, `order_total`, `order_type`) VALUES
(96, '66950e95bd4c9', 33, 'TIGER BOBA (NO TEA DRINK)', 3, 'Size', 'Large', '249', 1, '2024-07-15', '01:57:09pm', 4, 1, ' Norman', 'Palisoc', 'Mayombo Dagupan City, Pangasinan, Philippines, 2319', '+639273894063', 'npalisoc@yondu.com', 'FULFILLED', '2192', 'POS'),
(97, '66950e95bd4c9', 32, 'ORIGINAL CORN AND CREAM SMOOTHIE', 6, 'Size', 'Regular', '149', 1, '2024-07-15', '01:57:09pm', 2, 1, ' Norman', 'Palisoc', 'Mayombo Dagupan City, Pangasinan, Philippines, 2319', '+639273894063', 'npalisoc@yondu.com', 'FULFILLED', '2192', 'POS'),
(98, '66950e95bd4c9', 38, '3 ORIGINAL CORN AND CREAM SMOOTHIE WITH PEARLS', 3, 'Size', 'Large', '266', 1, '2024-07-15', '01:57:10pm', 5, 1, ' Norman', 'Palisoc', 'Mayombo Dagupan City, Pangasinan, Philippines, 2319', '+639273894063', 'npalisoc@yondu.com', 'FULFILLED', '2192', 'POS'),
(99, '669d0c5d1b0c1', 34, 'MANGO GRAHAM SMOOTHIE', 1, 'Size', 'Extra Large', '249', 1, '2024-07-21', '03:25:49pm', 1, 1, 'BINI', 'AIAH', 'Mayombo Dagupan City, Pangasinan, Philippines, 2319', '+639273894063', 'npalisoc@yondu.com', 'PROCESSING', '1483', 'POS'),
(100, '669d0c5d1b0c1', 38, '3 ORIGINAL CORN AND CREAM SMOOTHIE WITH PEARLS', 3, 'Size', 'Large', '266', 1, '2024-07-21', '03:25:49pm', 3, 1, 'BINI', 'AIAH', 'Mayombo Dagupan City, Pangasinan, Philippines, 2319', '+639273894063', 'npalisoc@yondu.com', 'PROCESSING', '1483', 'POS'),
(101, '669d0c5d1b0c1', 33, 'TIGER BOBA (NO TEA DRINK)', 3, 'Size', 'Large', '249', 1, '2024-07-21', '03:25:49pm', 2, 1, 'BINI', 'AIAH', 'Mayombo Dagupan City, Pangasinan, Philippines, 2319', '+639273894063', 'npalisoc@yondu.com', 'PROCESSING', '1483', 'POS'),
(102, '669d0c5d1b0c1', 32, 'ORIGINAL CORN AND CREAM SMOOTHIE', 6, 'Size', 'Regular', '149', 1, '2024-07-21', '03:25:49pm', 2, 1, 'BINI', 'AIAH', 'Mayombo Dagupan City, Pangasinan, Philippines, 2319', '+639273894063', 'npalisoc@yondu.com', 'PROCESSING', '1483', 'POS'),
(103, '669d0cff57183', 32, 'ORIGINAL CORN AND CREAM SMOOTHIE', 6, 'Size', 'Regular', '149', 1, '2024-07-21', '03:28:31pm', 2, 1, 'BINI', 'AIAH', 'Mayombo Dagupan City, Pangasinan, Philippines, 2319', '+639273894063', 'npalisoc@yondu.com', 'PROCESSING', '420', 'POS'),
(104, '669d0cff57183', 38, '3 ORIGINAL CORN AND CREAM SMOOTHIE WITH PEARLS', 3, 'Size', 'Large', '266', 1, '2024-07-21', '03:28:31pm', 1, 1, 'BINI', 'AIAH', 'Mayombo Dagupan City, Pangasinan, Philippines, 2319', '+639273894063', 'npalisoc@yondu.com', 'PROCESSING', '420', 'POS'),
(105, '669d0e5de9f10', 34, 'MANGO GRAHAM SMOOTHIE', 1, 'Size', 'Extra Large', '249', 1, '2024-07-21', '03:34:21pm', 1, 1, 'BINI', 'AIAH', 'Mayombo Dagupan City, Pangasinan, Philippines, 2319', '+639273894063', 'npalisoc@yondu.com', 'PROCESSING', '520', 'POS'),
(106, '669d0e5de9f10', 32, 'ORIGINAL CORN AND CREAM SMOOTHIE', 6, 'Size', 'Regular', '149', 1, '2024-07-21', '03:34:22pm', 1, 1, 'BINI', 'AIAH', 'Mayombo Dagupan City, Pangasinan, Philippines, 2319', '+639273894063', 'npalisoc@yondu.com', 'PROCESSING', '520', 'POS'),
(107, '669d0e5de9f10', 38, '3 ORIGINAL CORN AND CREAM SMOOTHIE WITH PEARLS', 3, 'Size', 'Large', '266', 1, '2024-07-21', '03:34:22pm', 1, 1, 'BINI', 'AIAH', 'Mayombo Dagupan City, Pangasinan, Philippines, 2319', '+639273894063', 'npalisoc@yondu.com', 'PROCESSING', '520', 'POS'),
(108, '669d16dd85e8e', 34, 'MANGO GRAHAM SMOOTHIE', 1, 'Size', 'Extra Large', '249', 1, '2024-07-21', '04:10:37pm', 1, 1, 'BINI', 'AIAH', 'Mayombo Dagupan City, Pangasinan, Philippines, 2319', '+639273894063', 'npalisoc@yondu.com', 'PROCESSING', '177', 'POS'),
(109, '669d174d61015', 34, 'MANGO GRAHAM SMOOTHIE', 1, 'Size', 'Extra Large', '177', 1, '2024-07-21', '04:12:29pm', 1, 1, 'BINI', 'AIAH', 'Mayombo Dagupan City, Pangasinan, Philippines, 2319', '+639273894063', 'npalisoc@yondu.com', 'PROCESSING', '177', 'POS'),
(110, '669d1772d7b5a', 32, 'ORIGINAL CORN AND CREAM SMOOTHIE', 6, 'Size', 'Regular', '77', 1, '2024-07-21', '04:13:06pm', 1, 1, 'BINI', 'AIAH', 'Mayombo Dagupan City, Pangasinan, Philippines, 2319', '+639273894063', 'npalisoc@yondu.com', 'PROCESSING', '686', 'POS'),
(111, '669d1772d7b5a', 38, '3 ORIGINAL CORN AND CREAM SMOOTHIE WITH PEARLS', 3, 'Size', 'Large', '266', 1, '2024-07-21', '04:13:07pm', 1, 1, 'BINI', 'AIAH', 'Mayombo Dagupan City, Pangasinan, Philippines, 2319', '+639273894063', 'npalisoc@yondu.com', 'PROCESSING', '686', 'POS'),
(112, '669d1772d7b5a', 37, 'STRAWBERRY NUTELLA SMOOTHIE', 3, 'Size', 'Large', '166', 1, '2024-07-21', '04:13:07pm', 1, 1, 'BINI', 'AIAH', 'Mayombo Dagupan City, Pangasinan, Philippines, 2319', '+639273894063', 'npalisoc@yondu.com', 'PROCESSING', '686', 'POS'),
(113, '669d1772d7b5a', 34, 'MANGO GRAHAM SMOOTHIE', 1, 'Size', 'Extra Large', '177', 1, '2024-07-21', '04:13:07pm', 1, 1, 'BINI', 'AIAH', 'Mayombo Dagupan City, Pangasinan, Philippines, 2319', '+639273894063', 'npalisoc@yondu.com', 'PROCESSING', '686', 'POS'),
(114, '669d1cee93824', 38, '3 ORIGINAL CORN AND CREAM SMOOTHIE WITH PEARLS', 3, 'Size', 'Large', '266', 1, '2024-07-21', '04:36:30pm', 2, 1, 'BINI', 'AIAH', 'Mayombo Dagupan City, Pangasinan, Philippines, 2319', '+639273894063', 'npalisoc@yondu.com', 'PROCESSING', '1141', 'POS'),
(115, '669d1cee93824', 32, 'ORIGINAL CORN AND CREAM SMOOTHIE', 6, 'Size', 'Regular', '77', 1, '2024-07-21', '04:36:30pm', 1, 1, 'BINI', 'AIAH', 'Mayombo Dagupan City, Pangasinan, Philippines, 2319', '+639273894063', 'npalisoc@yondu.com', 'PROCESSING', '1141', 'POS'),
(116, '669d1cee93824', 36, '3 TIGER BOBA (NO TEA DRINK)', 3, 'Size', 'Large', '266', 1, '2024-07-21', '04:36:30pm', 2, 1, 'BINI', 'AIAH', 'Mayombo Dagupan City, Pangasinan, Philippines, 2319', '+639273894063', 'npalisoc@yondu.com', 'PROCESSING', '1141', 'POS'),
(117, '669d1e7a99817', 32, 'ORIGINAL CORN AND CREAM SMOOTHIE', 6, 'Size', 'Regular', '77', 1, '2024-07-21', '04:43:06pm', 5, 1, 'BINI', 'AIAH', 'Mayombo Dagupan City, Pangasinan, Philippines, 2319', '+639273894063', 'npalisoc@yondu.com', 'PROCESSING', '651', 'POS'),
(118, '669d1e7a99817', 38, '3 ORIGINAL CORN AND CREAM SMOOTHIE WITH PEARLS', 3, 'Size', 'Large', '266', 1, '2024-07-21', '04:43:06pm', 1, 1, 'BINI', 'AIAH', 'Mayombo Dagupan City, Pangasinan, Philippines, 2319', '+639273894063', 'npalisoc@yondu.com', 'PROCESSING', '651', 'POS'),
(119, '669dce89bf0d5', 38, '3 ORIGINAL CORN AND CREAM SMOOTHIE WITH PEARLS', 3, 'Size', 'Large', '266', 1, '2024-07-22', '05:14:17am', 2, 1, 'BINI', 'AIAH', 'Mayombo Dagupan City, Pangasinan, Philippines, 2319', '+639273894063', 'npalisoc@yondu.com', 'PROCESSING', '532', 'POS');

-- --------------------------------------------------------

--
-- Table structure for table `orders_billing`
--

CREATE TABLE `orders_billing` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `credit_card_no` varchar(255) NOT NULL,
  `credit_card_exp` varchar(255) NOT NULL,
  `credit_card_code` varchar(255) NOT NULL,
  `billing_first_name` varchar(255) NOT NULL,
  `billing_last_name` varchar(255) NOT NULL,
  `billing_phone` varchar(255) NOT NULL,
  `billing_address` varchar(999) NOT NULL,
  `shipping_first_name` varchar(255) NOT NULL,
  `shipping_last_name` varchar(255) NOT NULL,
  `shipping_phone` varchar(255) NOT NULL,
  `shipping_address` varchar(999) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `amount_paid` varchar(255) NOT NULL,
  `payment` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders_billing`
--

INSERT INTO `orders_billing` (`id`, `order_id`, `credit_card_no`, `credit_card_exp`, `credit_card_code`, `billing_first_name`, `billing_last_name`, `billing_phone`, `billing_address`, `shipping_first_name`, `shipping_last_name`, `shipping_phone`, `shipping_address`, `payment_type`, `amount_paid`, `payment`, `customer_email`) VALUES
(76, 96, '', '-', '0', 'Norman', 'Palisoc', '+639273894063', 'Cablong', '-', '-', '-', '-', 'CASH', '2192', '2200', 'npalisoc@yondu.com'),
(77, 97, '', '-', '0', 'Norman', 'Palisoc', '+639273894063', 'Cablong', '-', '-', '-', '-', 'CASH', '2192', '2200', 'npalisoc@yondu.com'),
(78, 98, '', '-', '0', 'Norman', 'Palisoc', '+639273894063', 'Cablong', '-', '-', '-', '-', 'CASH', '2192', '2200', 'npalisoc@yondu.com'),
(79, 99, '', '-', '0', 'Norman', 'Palisoc', '+639273894063', 'Cablong', '-', '-', '-', '-', 'CASH', '1483', '1500', 'npalisoc@yondu.com'),
(80, 100, '', '-', '0', 'Norman', 'Palisoc', '+639273894063', 'Cablong', '-', '-', '-', '-', 'CASH', '1483', '1500', 'npalisoc@yondu.com'),
(81, 101, '', '-', '0', 'Norman', 'Palisoc', '+639273894063', 'Cablong', '-', '-', '-', '-', 'CASH', '1483', '1500', 'npalisoc@yondu.com'),
(82, 102, '', '-', '0', 'Norman', 'Palisoc', '+639273894063', 'Cablong', '-', '-', '-', '-', 'CASH', '1483', '1500', 'npalisoc@yondu.com'),
(83, 103, '', '-', '0', 'Norman', 'Palisoc', '+639273894063', 'Cablong', '-', '-', '-', '-', 'CASH', '420', '500', 'npalisoc@yondu.com'),
(84, 104, '', '-', '0', 'Norman', 'Palisoc', '+639273894063', 'Cablong', '-', '-', '-', '-', 'CASH', '420', '500', 'npalisoc@yondu.com'),
(85, 105, '', '-', '0', 'Norman', 'Palisoc', '+639273894063', 'Cablong', '-', '-', '-', '-', 'CASH', '520', '550', 'npalisoc@yondu.com'),
(86, 106, '', '-', '0', 'Norman', 'Palisoc', '+639273894063', 'Cablong', '-', '-', '-', '-', 'CASH', '520', '550', 'npalisoc@yondu.com'),
(87, 107, '', '-', '0', 'Norman', 'Palisoc', '+639273894063', 'Cablong', '-', '-', '-', '-', 'CASH', '520', '550', 'npalisoc@yondu.com'),
(88, 108, '', '-', '0', 'Norman', 'Palisoc', '+639273894063', 'Cablong', '-', '-', '-', '-', 'CASH', '177', '180', 'npalisoc@yondu.com'),
(89, 109, '', '-', '0', 'Norman', 'Palisoc', '+639273894063', 'Cablong', '-', '-', '-', '-', 'CASH', '177', '180', 'npalisoc@yondu.com'),
(90, 110, '', '-', '0', 'Norman', 'Palisoc', '+639273894063', 'Cablong', '-', '-', '-', '-', 'CASH', '686', '700', 'npalisoc@yondu.com'),
(91, 111, '', '-', '0', 'Norman', 'Palisoc', '+639273894063', 'Cablong', '-', '-', '-', '-', 'CASH', '686', '700', 'npalisoc@yondu.com'),
(92, 112, '', '-', '0', 'Norman', 'Palisoc', '+639273894063', 'Cablong', '-', '-', '-', '-', 'CASH', '686', '700', 'npalisoc@yondu.com'),
(93, 113, '', '-', '0', 'Norman', 'Palisoc', '+639273894063', 'Cablong', '-', '-', '-', '-', 'CASH', '686', '700', 'npalisoc@yondu.com'),
(94, 114, '', '-', '0', 'Norman', 'Palisoc', '+639273894063', 'Cablong', '-', '-', '-', '-', 'CASH', '1141', '1200', 'npalisoc@yondu.com'),
(95, 115, '', '-', '0', 'Norman', 'Palisoc', '+639273894063', 'Cablong', '-', '-', '-', '-', 'CASH', '1141', '1200', 'npalisoc@yondu.com'),
(96, 116, '', '-', '0', 'Norman', 'Palisoc', '+639273894063', 'Cablong', '-', '-', '-', '-', 'CASH', '1141', '1200', 'npalisoc@yondu.com'),
(97, 117, '', '-', '0', 'Norman', 'Palisoc', '+639273894063', 'Cablong', '-', '-', '-', '-', 'CASH', '651', '700', 'npalisoc@yondu.com'),
(98, 118, '', '-', '0', 'Norman', 'Palisoc', '+639273894063', 'Cablong', '-', '-', '-', '-', 'CASH', '651', '700', 'npalisoc@yondu.com'),
(99, 119, '', '-', '0', 'Norman', 'Palisoc', '+639273894063', 'Cablong', '-', '-', '-', '-', 'CASH', '532', '550', 'npalisoc@yondu.com');

-- --------------------------------------------------------

--
-- Table structure for table `products_categories`
--

CREATE TABLE `products_categories` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products_categories`
--

INSERT INTO `products_categories` (`id`, `category_id`, `product_id`) VALUES
(31, 10, 31),
(32, 15, 32),
(33, 7, 33),
(34, 15, 34),
(35, 10, 35),
(36, 7, 36),
(37, 15, 37),
(38, 15, 38);

-- --------------------------------------------------------

--
-- Table structure for table `products_images`
--

CREATE TABLE `products_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_image` varchar(999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products_images`
--

INSERT INTO `products_images` (`id`, `product_id`, `product_image`) VALUES
(12, 31, '../uploads/449833622_890889206388208_5186544043050434752_n.jpg'),
(13, 32, '../uploads/449963047_890893469721115_8037731534914943621_n.jpg'),
(14, 33, '../uploads/448512011_890893443054451_1472447363313712759_n.jpg'),
(15, 34, '../uploads/449930361_890893483054447_5029787391027050045_n.jpg'),
(16, 35, '../uploads/447685776_871620354981760_7214760882104809249_n.jpg'),
(18, 36, '../uploads/448021526_871620374981758_8464208450218718430_n.jpg'),
(19, 37, '../uploads/447833255_871620384981757_6695675582191510910_n.jpg'),
(20, 38, '../uploads/447728295_871620361648426_4025483537535039279_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products_info`
--

CREATE TABLE `products_info` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_description` varchar(999) NOT NULL,
  `product_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products_info`
--

INSERT INTO `products_info` (`id`, `product_name`, `product_description`, `product_status`) VALUES
(31, 'MILK TEA AND 3 BUDDIES', 'Calling all Icylicious lovers!\\r\\nGet ready for our 7.7 Big Deals!\\r\\nPromo runs: July 7-30, 2024 only\\r\\n• (R) | Milk Tea and 3 Buddies P77\\r\\n• (R) | Original Corn and Cream Smoothie P77\\r\\n• 2 (L) | Tiger Boba (No Tea Drink) P177\\r\\n• (XL) | Special Mango Graham Smoothie P177\\r\\n• UPGRADE FROM (R) TO (L) | Add P7 (Milk Tea only) \\r\\nEnjoy amazing discounts on your fave drink!\\r\\nDon’t miss out!\\r\\nAvailable at all Icylicious Stores.\\r\\nT A R A , I C Y ? ', 'ACTIVE'),
(32, 'ORIGINAL CORN AND CREAM SMOOTHIE', 'Calling all Icylicious lovers!\\r\\nGet ready for our 7.7 Big Deals!\\r\\nPromo runs: July 7-30, 2024 only\\r\\n• (R) | Milk Tea and 3 Buddies P77\\r\\n• (R) | Original Corn and Cream Smoothie P77\\r\\n• 2 (L) | Tiger Boba (No Tea Drink) P177\\r\\n• (XL) | Special Mango Graham Smoothie P177\\r\\n• UPGRADE FROM (R) TO (L) | Add P7 (Milk Tea only) \\r\\nEnjoy amazing discounts on your fave drink!\\r\\nDon’t miss out!\\r\\nAvailable at all Icylicious Stores.\\r\\nT A R A , I C Y ? ', 'ACTIVE'),
(33, 'TIGER BOBA (NO TEA DRINK)', 'Calling all Icylicious lovers!\\r\\nGet ready for our 7.7 Big Deals!\\r\\nPromo runs: July 7-30, 2024 only\\r\\n• (R) | Milk Tea and 3 Buddies P77\\r\\n• (R) | Original Corn and Cream Smoothie P77\\r\\n• 2 (L) | Tiger Boba (No Tea Drink) P177\\r\\n• (XL) | Special Mango Graham Smoothie P177\\r\\n• UPGRADE FROM (R) TO (L) | Add P7 (Milk Tea only) \\r\\nEnjoy amazing discounts on your fave drink!\\r\\nDon’t miss out!\\r\\nAvailable at all Icylicious Stores.\\r\\nT A R A , I C Y ? ', 'ACTIVE'),
(34, 'MANGO GRAHAM SMOOTHIE', 'Calling all Icylicious lovers!\\r\\nGet ready for our 7.7 Big Deals!\\r\\nPromo runs: July 7-30, 2024 only\\r\\n• (R) | Milk Tea and 3 Buddies P77\\r\\n• (R) | Original Corn and Cream Smoothie P77\\r\\n• 2 (L) | Tiger Boba (No Tea Drink) P177\\r\\n• (XL) | Special Mango Graham Smoothie P177\\r\\n• UPGRADE FROM (R) TO (L) | Add P7 (Milk Tea only) \\r\\nEnjoy amazing discounts on your fave drink!\\r\\nDon’t miss out!\\r\\nAvailable at all Icylicious Stores.\\r\\nT A R A , I C Y ? ', 'ACTIVE'),
(35, 'BUBBLE MILK TEA', 'Don’t miss out! Today’s the final day to seize and enjoy our 6.6 Mid-Year Promo! \\r\\n\\r\\nAvailable at all Icylicious Stores.\\r\\nT A R A , I C Y ? ', 'ACTIVE'),
(36, '3 TIGER BOBA (NO TEA DRINK)', 'Don’t miss out! Today’s the final day to seize and enjoy our 6.6 Mid-Year Promo! \\r\\n\\r\\nAvailable at all Icylicious Stores.\\r\\nT A R A , I C Y ? ', 'ACTIVE'),
(37, 'STRAWBERRY NUTELLA SMOOTHIE', 'Don’t miss out! Today’s the final day to seize and enjoy our 6.6 Mid-Year Promo! \\r\\n\\r\\nAvailable at all Icylicious Stores.\\r\\nT A R A , I C Y ? ', 'ACTIVE'),
(38, '3 ORIGINAL CORN AND CREAM SMOOTHIE WITH PEARLS', 'Don’t miss out! Today’s the final day to seize and enjoy our 6.6 Mid-Year Promo! \\r\\n\\r\\nAvailable at all Icylicious Stores.\\r\\nT A R A , I C Y ? ', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `products_prices`
--

CREATE TABLE `products_prices` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) NOT NULL,
  `variant_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products_prices`
--

INSERT INTO `products_prices` (`id`, `product_id`, `variant_id`, `variant_price`) VALUES
(31, 31, 6, 149),
(32, 32, 6, 149),
(33, 33, 3, 249),
(34, 34, 1, 249),
(35, 35, 3, 69),
(36, 36, 3, 266),
(37, 37, 3, 166),
(38, 38, 3, 266);

-- --------------------------------------------------------

--
-- Table structure for table `products_ratings`
--

CREATE TABLE `products_ratings` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rating_user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `promotional_price` int(11) NOT NULL,
  `is_buy_x_take_x` int(11) NOT NULL,
  `buy_x_of` int(11) NOT NULL,
  `take_x_of` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`id`, `product_id`, `promotional_price`, `is_buy_x_take_x`, `buy_x_of`, `take_x_of`) VALUES
(18, 31, 77, 0, 0, 0),
(19, 32, 77, 0, 0, 0),
(20, 33, 177, 0, 0, 0),
(21, 34, 177, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_credentials`
--

CREATE TABLE `user_credentials` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_credentials`
--

INSERT INTO `user_credentials` (`id`, `user_id`, `username`, `password`, `type`) VALUES
(1, 1, 'npalisoc@yondu.com', 'bf4eebd67ee25c316692f4b8fab77f4a', 'admin'),
(23, 37, 'norman.consultant@platform-11.com', 'cc03e747a6afbbcbf8be7668acfebee5', 'customer'),
(24, 38, 'jennie.kim@yopmail.com', 'cc03e747a6afbbcbf8be7668acfebee5', 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `birth_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `first_name`, `last_name`, `email`, `phone`, `address`, `gender`, `birth_date`) VALUES
(1, 'BINI', 'AIAH', 'npalisoc@yondu.com', '+639273894063', 'Mayombo Dagupan City, Pangasinan, Philippines, 2319', 'Female', '2024-04-30'),
(37, 'Norman', 'Palisoc', 'norman.consultant@platform-11.com', '639273894063', 'Ayala Makati, Metro Manila, Philippines', 'Male', '2024-07-31'),
(38, 'Jenni', 'Kim', 'jennie.kim@yopmail.com', '639273894063', 'Dagupan City, Pangasinan, Philippines', 'Female', '2024-07-31');

-- --------------------------------------------------------

--
-- Table structure for table `variants`
--

CREATE TABLE `variants` (
  `id` int(11) NOT NULL,
  `variant_type` varchar(255) NOT NULL,
  `variant_name` varchar(255) NOT NULL,
  `variant_description` varchar(255) NOT NULL,
  `is_enabled` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `variants`
--

INSERT INTO `variants` (`id`, `variant_type`, `variant_name`, `variant_description`, `is_enabled`) VALUES
(1, 'Size', 'Extra Large', 'Size Variant of XL for Drinks', 1),
(3, 'Size', 'Large', 'Size Variant of L for Drinks', 1),
(4, 'Size', 'Medium', 'Size Variant of M for Drinks', 1),
(6, 'Size', 'Regular', 'Default variant for any products related', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `best_sellers`
--
ALTER TABLE `best_sellers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_billing`
--
ALTER TABLE `orders_billing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_categories`
--
ALTER TABLE `products_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_images`
--
ALTER TABLE `products_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_info`
--
ALTER TABLE `products_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_prices`
--
ALTER TABLE `products_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_ratings`
--
ALTER TABLE `products_ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_credentials`
--
ALTER TABLE `user_credentials`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `variants`
--
ALTER TABLE `variants`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `best_sellers`
--
ALTER TABLE `best_sellers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `orders_billing`
--
ALTER TABLE `orders_billing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `products_categories`
--
ALTER TABLE `products_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `products_images`
--
ALTER TABLE `products_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `products_info`
--
ALTER TABLE `products_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `products_prices`
--
ALTER TABLE `products_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `products_ratings`
--
ALTER TABLE `products_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_credentials`
--
ALTER TABLE `user_credentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `variants`
--
ALTER TABLE `variants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
