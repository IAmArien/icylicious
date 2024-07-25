-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 25, 2024 at 05:49 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

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
(77, 'Exported Orders', '2024/07/22', '05:46:49am', 'npalisoc@yondu.com', 'BINI AIAH'),
(78, 'Login', '2024/07/22', '06:08:45am', 'npalisoc@yondu.com', 'BINI AIAH'),
(79, 'Exported Orders', '2024/07/22', '06:09:52am', 'npalisoc@yondu.com', 'BINI AIAH'),
(80, 'Exported Orders', '2024/07/22', '06:11:11am', 'npalisoc@yondu.com', 'BINI AIAH'),
(81, 'Add Order', '2024/07/22', '06:11:18am', 'npalisoc@yondu.com', 'BINI AIAH'),
(82, 'Add Order', '2024/07/22', '06:11:20am', 'npalisoc@yondu.com', 'BINI AIAH'),
(83, 'Checkout', '2024/07/22', '06:11:26am', 'npalisoc@yondu.com', 'BINI AIAH'),
(84, 'Login', '2024/07/24', '05:12:41am', 'npalisoc@yondu.com', 'BINI AIAH'),
(85, 'Login', '2024/07/24', '05:19:05am', 'npalisoc@yondu.com', 'BINI AIAH'),
(86, 'Login', '2024/07/24', '05:25:04am', 'npalisoc@yondu.com', 'BINI AIAH'),
(87, 'Login', '2024/07/24', '05:34:29am', 'npalisoc@yondu.com', 'BINI AIAH'),
(88, 'Add Product', '2024/07/24', '05:36:18am', 'npalisoc@yondu.com', 'BINI AIAH'),
(89, 'Add Product', '2024/07/24', '05:39:34am', 'npalisoc@yondu.com', 'BINI AIAH'),
(90, 'Delete Product', '2024/07/24', '05:39:40am', 'npalisoc@yondu.com', 'BINI AIAH'),
(91, 'Add Product', '2024/07/24', '05:46:41am', 'npalisoc@yondu.com', 'BINI AIAH'),
(92, 'Update Product', '2024/07/24', '05:47:03am', 'npalisoc@yondu.com', 'BINI AIAH'),
(93, 'Update Product', '2024/07/24', '05:47:03am', 'npalisoc@yondu.com', 'BINI AIAH'),
(94, 'Exported Orders', '2024/07/24', '06:04:05am', 'npalisoc@yondu.com', 'BINI AIAH'),
(95, 'Login', '2024/07/24', '06:20:38am', 'npalisoc@yondu.com', 'BINI AIAH'),
(96, 'Add Order', '2024/07/24', '06:20:43am', 'npalisoc@yondu.com', 'BINI AIAH'),
(97, 'Login', '2024/07/24', '04:14:10pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(98, 'Add Order', '2024/07/24', '04:15:06pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(99, 'Delete Orders', '2024/07/24', '04:15:09pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(100, 'Delete Product', '2024/07/24', '04:15:14pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(101, 'Add Order', '2024/07/24', '04:21:38pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(102, 'Add Order', '2024/07/24', '04:21:41pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(103, 'Checkout', '2024/07/24', '04:21:52pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(104, 'Add / Update Stocks', '2024/07/24', '04:49:22pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(105, 'Add / Update Stocks', '2024/07/24', '04:49:41pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(106, 'Add / Update Stocks', '2024/07/24', '04:49:58pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(107, 'Login', '2024/07/25', '02:12:37pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(108, 'Update Order', '2024/07/25', '02:18:04pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(109, 'Update Order', '2024/07/25', '02:18:10pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(110, 'Update Order', '2024/07/25', '02:18:16pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(111, 'Add Product', '2024/07/25', '02:48:46pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(112, 'Add / Update Stocks', '2024/07/25', '02:49:02pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(113, 'Login', '2024/07/25', '03:00:31pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(114, 'Add Order', '2024/07/25', '03:27:09pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(115, 'Add Order', '2024/07/25', '03:27:15pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(116, 'Add Order', '2024/07/25', '03:27:25pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(117, 'Delete Orders', '2024/07/25', '03:27:31pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(118, 'Add Order', '2024/07/25', '03:32:20pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(119, 'Add Order', '2024/07/25', '03:32:25pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(120, 'Add Order', '2024/07/25', '03:32:28pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(121, 'Add Order', '2024/07/25', '03:32:34pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(122, 'Add Order', '2024/07/25', '03:32:40pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(123, 'Add Order', '2024/07/25', '03:32:44pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(124, 'Add Order', '2024/07/25', '03:33:47pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(125, 'Add Order', '2024/07/25', '03:35:45pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(126, 'Delete Orders', '2024/07/25', '03:35:49pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(127, 'Add Order', '2024/07/25', '03:35:55pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(128, 'Add Order', '2024/07/25', '03:36:01pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(129, 'Add Order', '2024/07/25', '03:37:40pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(130, 'Add Order', '2024/07/25', '03:39:09pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(131, 'Add Order', '2024/07/25', '03:39:13pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(132, 'Add Order', '2024/07/25', '03:39:36pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(133, 'Add Order', '2024/07/25', '03:39:41pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(134, 'Delete Orders', '2024/07/25', '03:39:59pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(135, 'Add Order', '2024/07/25', '03:40:12pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(136, 'Add Order', '2024/07/25', '03:40:18pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(137, 'Delete Orders', '2024/07/25', '03:40:47pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(138, 'Add Order', '2024/07/25', '03:40:52pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(139, 'Add Order', '2024/07/25', '03:41:00pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(140, 'Delete Orders', '2024/07/25', '03:48:59pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(141, 'Add Order', '2024/07/25', '03:59:44pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(142, 'Add Order', '2024/07/25', '04:00:31pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(143, 'Add Order', '2024/07/25', '04:00:47pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(144, 'Add Order', '2024/07/25', '04:01:00pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(145, 'Add Order', '2024/07/25', '04:01:36pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(146, 'Add Order', '2024/07/25', '04:01:42pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(147, 'Add Order', '2024/07/25', '04:02:36pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(148, 'Add Order', '2024/07/25', '04:02:37pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(149, 'Add Order', '2024/07/25', '04:02:38pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(150, 'Add Order', '2024/07/25', '04:02:43pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(151, 'Add Order', '2024/07/25', '04:02:55pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(152, 'Add Order', '2024/07/25', '04:03:45pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(153, 'Add Order', '2024/07/25', '04:04:01pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(154, 'Delete Orders', '2024/07/25', '04:05:10pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(155, 'Add Order', '2024/07/25', '04:08:36pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(156, 'Add Order', '2024/07/25', '04:08:40pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(157, 'Add Order', '2024/07/25', '04:08:44pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(158, 'Add Order', '2024/07/25', '04:08:49pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(159, 'Add Order', '2024/07/25', '04:08:55pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(160, 'Add Order', '2024/07/25', '04:10:11pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(161, 'Add Order', '2024/07/25', '04:10:14pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(162, 'Add Order', '2024/07/25', '04:10:18pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(163, 'Delete Order', '2024/07/25', '04:10:32pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(164, 'Add Order', '2024/07/25', '04:10:45pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(165, 'Delete Order', '2024/07/25', '04:10:47pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(166, 'Delete Order', '2024/07/25', '04:11:07pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(167, 'Add Order', '2024/07/25', '04:12:05pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(168, 'Add Order', '2024/07/25', '04:12:07pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(169, 'Add Order', '2024/07/25', '04:12:10pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(170, 'Add Order', '2024/07/25', '04:12:13pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(171, 'Add Order', '2024/07/25', '04:12:16pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(172, 'Add Order', '2024/07/25', '04:12:19pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(173, 'Delete Order', '2024/07/25', '04:12:23pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(174, 'Delete Orders', '2024/07/25', '04:12:24pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(175, 'Login', '2024/07/25', '04:58:07pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(176, 'Login', '2024/07/25', '05:06:55pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(177, 'Add / Update Stocks', '2024/07/25', '05:07:11pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(178, 'Login', '2024/07/25', '05:25:43pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(179, 'Add Order', '2024/07/25', '05:36:35pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(180, 'Delete Orders', '2024/07/25', '05:36:38pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(181, 'Add Order', '2024/07/25', '05:37:31pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(182, 'Delete Orders', '2024/07/25', '05:37:33pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(183, 'Add Order', '2024/07/25', '05:39:36pm', 'npalisoc@yondu.com', 'BINI AIAH'),
(184, 'Delete Orders', '2024/07/25', '05:39:38pm', 'npalisoc@yondu.com', 'BINI AIAH');

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
(96, '66950e95bd4c9', 33, 'TIGER BOBA (NO TEA DRINK)', 3, 'Size', 'Large', '249', 1, '2024-07-15', '01:57:09pm', 4, 1, ' Norman', 'Palisoc', 'Mayombo Dagupan City, Pangasinan, Philippines, 2319', '+639273894063', 'npalisoc@yondu.com', 'COMPLETED', '2192', 'POS'),
(97, '66950e95bd4c9', 32, 'ORIGINAL CORN AND CREAM SMOOTHIE', 6, 'Size', 'Regular', '149', 1, '2024-07-15', '01:57:09pm', 2, 1, ' Norman', 'Palisoc', 'Mayombo Dagupan City, Pangasinan, Philippines, 2319', '+639273894063', 'npalisoc@yondu.com', 'COMPLETED', '2192', 'POS'),
(98, '66950e95bd4c9', 38, '3 ORIGINAL CORN AND CREAM SMOOTHIE WITH PEARLS', 3, 'Size', 'Large', '266', 1, '2024-07-15', '01:57:10pm', 5, 1, ' Norman', 'Palisoc', 'Mayombo Dagupan City, Pangasinan, Philippines, 2319', '+639273894063', 'npalisoc@yondu.com', 'COMPLETED', '2192', 'POS'),
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
(119, '669dce89bf0d5', 38, '3 ORIGINAL CORN AND CREAM SMOOTHIE WITH PEARLS', 3, 'Size', 'Large', '266', 1, '2024-07-22', '05:14:17am', 2, 1, 'BINI', 'AIAH', 'Mayombo Dagupan City, Pangasinan, Philippines, 2319', '+639273894063', 'npalisoc@yondu.com', 'PROCESSING', '532', 'POS'),
(120, '669ddbeecbad4', 38, '3 ORIGINAL CORN AND CREAM SMOOTHIE WITH PEARLS', 3, 'Size', 'Large', '266', 1, '2024-07-22', '06:11:26am', 1, 1, 'BINI', 'AIAH', 'Mayombo Dagupan City, Pangasinan, Philippines, 2319', '+639273894063', 'npalisoc@yondu.com', 'PROCESSING', '443', 'POS'),
(121, '669ddbeecbad4', 34, 'MANGO GRAHAM SMOOTHIE', 1, 'Size', 'Extra Large', '177', 1, '2024-07-22', '06:11:26am', 1, 1, 'BINI', 'AIAH', 'Mayombo Dagupan City, Pangasinan, Philippines, 2319', '+639273894063', 'npalisoc@yondu.com', 'PROCESSING', '443', 'POS'),
(122, '66a075e21d318', 32, 'ORIGINAL CORN AND CREAM SMOOTHIE', 6, 'Size', 'Regular', '149', 37, '2024-07-24', '05:32:50am', 2, 1, 'Norman', 'Palisoc', 'Ayala Makati, Metro Manila, Philippines', '639273894063', 'norman.consultant@platform-11.com', 'CANCELLED', '154', 'ONLINE'),
(123, '66a10e0067fd0', 38, '3 ORIGINAL CORN AND CREAM SMOOTHIE WITH PEARLS', 3, 'Size', 'Large', '266', 1, '2024-07-24', '04:21:52pm', 1, 1, 'BINI', 'AIAH', 'Mayombo Dagupan City, Pangasinan, Philippines, 2319', '+639273894063', 'npalisoc@yondu.com', 'PROCESSING', '343', 'POS'),
(124, '66a10e0067fd0', 32, 'ORIGINAL CORN AND CREAM SMOOTHIE', 6, 'Size', 'Regular', '77', 1, '2024-07-24', '04:21:52pm', 1, 1, 'BINI', 'AIAH', 'Mayombo Dagupan City, Pangasinan, Philippines, 2319', '+639273894063', 'npalisoc@yondu.com', 'PROCESSING', '343', 'POS'),
(125, '66a26e65e2540', 35, 'BUBBLE MILK TEA', 3, 'Size', 'Large', '69', 37, '2024-07-25', '05:25:25pm', 1, 1, 'Norman', 'Palisoc', 'Ayala Makati, Metro Manila, Philippines', '639273894063', 'norman.consultant@platform-11.com', 'PROCESSING', '69', 'ONLINE');

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
(99, 119, '', '-', '0', 'Norman', 'Palisoc', '+639273894063', 'Cablong', '-', '-', '-', '-', 'CASH', '532', '550', 'npalisoc@yondu.com'),
(100, 120, '', '-', '0', 'Norman', 'Palisoc', '+639273894063', 'Cablong', '-', '-', '-', '-', 'CASH', '443', '500', 'npalisoc@yondu.com'),
(101, 121, '', '-', '0', 'Norman', 'Palisoc', '+639273894063', 'Cablong', '-', '-', '-', '-', 'CASH', '443', '500', 'npalisoc@yondu.com'),
(102, 123, '', '-', '0', 'Norman', 'Palisoc', '+639273894063', 'Cablong', '-', '-', '-', '-', 'CASH', '343', '400', 'npalisoc@yondu.com'),
(103, 124, '', '-', '0', 'Norman', 'Palisoc', '+639273894063', 'Cablong', '-', '-', '-', '-', 'CASH', '343', '400', 'npalisoc@yondu.com'),
(104, 125, '12313123123', '-', '0', 'Norman', 'Palisoc', '639273894063', '-', 'Norman', 'Palisoc', '639273894063', 'Cablong', 'GCASH', '69', '69', 'norman.consultant@platform-11.com');

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
(38, 15, 38),
(40, 7, 38),
(43, 15, 42);

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
(20, 38, '../uploads/447728295_871620361648426_4025483537535039279_n.jpg'),
(21, 42, '../uploads/447728295_871620361648426_4025483537535039279_n.jpg');

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
(38, '3 ORIGINAL CORN AND CREAM SMOOTHIE WITH PEARLS', 'Don’t miss out! Today’s the final day to seize and enjoy our 6.6 Mid-Year Promo! \\r\\n\\r\\nAvailable at all Icylicious Stores.\\r\\nT A R A , I C Y ? ', 'ACTIVE'),
(42, '3 ORIGINAL CORN AND CREAM SMOOTHIE WITH PEARLS', 'Don’t miss out! Today’s the final day to seize and enjoy our 6.6 Mid-Year Promo! \\r\\n\\r\\nAvailable at all Icylicious Stores.\\r\\nT A R A , I C Y ? ', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `products_inventory`
--

CREATE TABLE `products_inventory` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `stocks` int(11) NOT NULL,
  `restock_level_point` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products_inventory`
--

INSERT INTO `products_inventory` (`id`, `product_id`, `stocks`, `restock_level_point`) VALUES
(1, 38, 95, 50),
(2, 36, 12, 11),
(3, 42, 90, 65),
(4, 35, 9, 5);

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
(38, 38, 3, 266),
(40, 39, 1, 8900),
(43, 42, 4, 266);

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
-- Indexes for table `products_inventory`
--
ALTER TABLE `products_inventory`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT for table `best_sellers`
--
ALTER TABLE `best_sellers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `orders_billing`
--
ALTER TABLE `orders_billing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `products_categories`
--
ALTER TABLE `products_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `products_images`
--
ALTER TABLE `products_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `products_info`
--
ALTER TABLE `products_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `products_inventory`
--
ALTER TABLE `products_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products_prices`
--
ALTER TABLE `products_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

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
