-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2024 at 04:31 PM
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

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `firstname`, `lastname`, `email`, `mobile`, `contact_subject`, `contact_description`) VALUES
(1, 'Norman', 'Palisoc', 'norman.palisoc@gmail.com', '238402394234', 'Test', 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` varchar(255) NOT NULL,
  `order_time` varchar(255) NOT NULL,
  `order_quantity` int(11) NOT NULL,
  `is_pickup` int(11) NOT NULL,
  `user_address` varchar(999) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `order_total` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `transaction_id`, `product_id`, `variant_id`, `user_id`, `order_date`, `order_time`, `order_quantity`, `is_pickup`, `user_address`, `user_phone`, `user_email`, `order_status`, `order_total`) VALUES
(56, '668beeb22215c', 30, 6, 36, '2024/07/08', '03:50:42pm', 3, 1, 'dfsdfsdf', '489573845934535345345', 'norman.palisoc@gmail1.com', 'PROCESSING', '1393'),
(57, '668beeb22215c', 29, 3, 36, '2024/07/08', '03:50:42pm', 4, 1, 'dfsdfsdf', '489573845934535345345', 'norman.palisoc@gmail1.com', 'PROCESSING', '1393'),
(58, '668bf7c7be3db', 30, 6, 36, '2024/07/08', '04:29:27pm', 6, 1, 'dfsdfsdf', '489573845934535345345', 'norman.palisoc@gmail1.com', 'PROCESSING', '1194');

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
  `customer_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders_billing`
--

INSERT INTO `orders_billing` (`id`, `order_id`, `credit_card_no`, `credit_card_exp`, `credit_card_code`, `billing_first_name`, `billing_last_name`, `billing_phone`, `billing_address`, `shipping_first_name`, `shipping_last_name`, `shipping_phone`, `shipping_address`, `payment_type`, `customer_email`) VALUES
(36, 56, 'asdasd', '36456', '2345345', 'fgdfg', 'dfgdfg', '83904589345345', 'yuiyui', 'fgdfg', 'dfgdfg', '83904589345345', 'yuiyui', 'cc', 'norman.palisoc@gmail1.com'),
(37, 57, 'asdasd', '36456', '2345345', 'fgdfg', 'dfgdfg', '83904589345345', 'yuiyui', 'fgdfg', 'dfgdfg', '83904589345345', 'yuiyui', 'cc', 'norman.palisoc@gmail1.com'),
(38, 58, 'asdasd', 'asdasd', '234234', 'sdfgdfg', 'dfgdfg', '809890890', 'hjkashdjkahsd', 'sdfgdfg', 'dfgdfg', '809890890', 'hjkashdjkahsd', 'cc', 'norman.palisoc@gmail1.com');

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
(29, 15, 29),
(30, 15, 30);

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
(10, 30, '../uploads/7a5fbe85a4c1746b5d99b762e9b33070-176.jpg'),
(11, 30, '../uploads/dc473895e63ab8a779b2903a06711464-461.png');

-- --------------------------------------------------------

--
-- Table structure for table `products_info`
--

CREATE TABLE `products_info` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_description` varchar(999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products_info`
--

INSERT INTO `products_info` (`id`, `product_name`, `product_description`) VALUES
(29, 'SPECIAL MANGO GRAHAM B1T1', 'Cheers to the real superheroes in our lives!\\r\\nMOTHER\\\'S DAY SPECIAL\\r\\n\\r\\nCelebrate Mother\\\'s Day with us with our Super Sulit Promo only here at Icylicious!\\r\\nSPECIAL MANGO GRAHAM B1T1\\r\\n@199\\r\\n\\r\\nPromo runs: May 12-13, 2024 only\\r\\nAvailable at all Icylicious Stores.'),
(30, 'SPECIAL MANGO GRAHAM B1T1', 'Cheers to the real superheroes in our lives!\\r\\nMOTHER\\\'S DAY SPECIAL\\r\\n\\r\\nCelebrate Mother\\\'s Day with us with our Super Sulit Promo only here at Icylicious!\\r\\nSPECIAL MANGO GRAHAM B1T1\\r\\n@199\\r\\n\\r\\nPromo runs: May 12-13, 2024 only\\r\\nAvailable at all Icylicious Stores.');

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
(29, 29, 3, 199),
(30, 30, 6, 199);

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
(16, 29, 0, 1, 1, 1),
(17, 30, 0, 1, 1, 1);

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
(7, 20, 'jisoo.kim@yopmail.com', 'b3056b83855a3940398d0d3bf6decaf0', 'customer'),
(8, 21, 'lalisa.manoban@yopmail.com', 'b3056b83855a3940398d0d3bf6decaf0', 'customer'),
(9, 22, 'chaeyoung.park@yopmail.com', 'b3056b83855a3940398d0d3bf6decaf0', 'customer'),
(10, 23, 'nicollete.vegara@chimpmail.com', 'b3056b83855a3940398d0d3bf6decaf0', 'customer'),
(11, 24, 'jennie.kim@yopmail.com', 'b3056b83855a3940398d0d3bf6decaf0', 'customer'),
(12, 25, 'hanni.pham@newjeans.com', 'b3056b83855a3940398d0d3bf6decaf0', 'customer'),
(13, 26, 'haerin.kang@njeans.com', 'b3056b83855a3940398d0d3bf6decaf0', 'customer'),
(14, 28, 'gehlee.dangca@gmail.com', 'b3056b83855a3940398d0d3bf6decaf0', 'customer'),
(15, 29, 'maloi.robles@bini.com.ph', 'b3056b83855a3940398d0d3bf6decaf0', 'customer'),
(20, 34, 'norman.palisoc@novare.com.hk', 'bf4eebd67ee25c316692f4b8fab77f4a', 'customer'),
(21, 35, 'test@norman.com', 'cc03e747a6afbbcbf8be7668acfebee5', 'customer'),
(22, 36, 'norman.palisoc@gmail1.com', 'cc03e747a6afbbcbf8be7668acfebee5', 'customer');

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
(1, ' Norman', 'Palisoc', 'npalisoc@yondu.com', '+639273894063', 'Mayombo Dagupan City, Pangasinan, Philippines, 2319', 'Female', '2024-04-30'),
(20, 'Jisoo', 'Kim', 'jisoo.kim@yopmail.com', '+6391234567809', 'Seoul South Korea', 'Male', '2024-02-20'),
(21, 'Lalisa', 'Manoban', 'lalisa.manoban@yopmail.com', '+630987654321', 'Thailand, Earth, Milky Way, Universe', 'Female', '2024-06-13'),
(22, 'Chaeyoung', 'Park', 'chaeyoung.park@yopmail.com', '+639273894040', 'Seoul South Korea and Australia', 'Male', '2023-06-14'),
(23, 'Nicolette', 'Vergara', 'nicollete.vegara@chimpmail.com', '+6392790874823', 'Taguig, Metro Manila, Philippines 2419', 'Female', '2024-01-18'),
(24, 'Jennie', 'Kim', 'jennie.kim@yopmail.com', '+639273894063', 'Santa Barbara, Pangasinan, Philippines', 'Female', '2024-04-26'),
(25, 'Hanni', 'Pham', 'hanni.pham@newjeans.com', '+6392783478932', 'Vietnam and Australia', 'Female', '2024-04-10'),
(26, 'Haerin', 'Kang', 'haerin.kang@njeans.com', '+6392719273123', 'Metro Manila, Quezon City, Philippines', 'Others', '2024-04-02'),
(28, 'Gehlee', 'Dangca', 'gehlee.dangca@gmail.com', '+639293819273', 'Pasig City, Metro Manila, Philippines', 'Female', '2024-02-14'),
(29, 'Maloi', 'Robles', 'maloi.robles@bini.com.ph', '+6392783827133', 'Brgy BINI, Pantropiko Island Philippines', 'Others', '2024-04-03'),
(34, 'Norman', 'Palisoc', 'norman.palisoc@novare.com.hk', '639273894063', 'Ayala Makati, Metro Manila, Philippines', 'Male', '2024-05-01'),
(35, 'Norman', 'Palisoc', 'test@norman.com', '283492034234', 'Ayala Makati Metro Manila Philippines', 'Female', '2024-06-18'),
(36, 'Norman', 'Palisoc', 'norman.palisoc@gmail1.com', '489573845934535345345', 'dfsdfsdf', 'Female', '2024-07-18');

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
(6, 'Size', 'Regular', 'Default variant for any possible products', 1);

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `orders_billing`
--
ALTER TABLE `orders_billing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `products_categories`
--
ALTER TABLE `products_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `products_images`
--
ALTER TABLE `products_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products_info`
--
ALTER TABLE `products_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `products_prices`
--
ALTER TABLE `products_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `products_ratings`
--
ALTER TABLE `products_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_credentials`
--
ALTER TABLE `user_credentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `variants`
--
ALTER TABLE `variants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
