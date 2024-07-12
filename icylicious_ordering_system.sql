-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 12, 2024 at 07:30 AM
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
-- Table structure for table `best_sellers`
--

CREATE TABLE `best_sellers` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(59, '668ff965b8389', 36, 3, 37, '2024/07/11', '05:25:25pm', 4, 1, 'Ayala Makati, Metro Manila, Philippines', '639273894063', 'norman.consultant@platform-11.com', 'PROCESSING', '1064'),
(60, '6690071c2171d', 36, 3, 37, '2024/07/11', '06:23:56pm', 4, 1, 'Ayala Makati, Metro Manila, Philippines', '639273894063', 'norman.consultant@platform-11.com', 'SERVING', '1295'),
(61, '6690071c2171d', 32, 6, 37, '2024/07/11', '06:23:56pm', 3, 1, 'Ayala Makati, Metro Manila, Philippines', '639273894063', 'norman.consultant@platform-11.com', 'SERVING', '1295'),
(62, '669017366b037', 31, 6, 38, '2024/07/11', '07:32:38pm', 2, 1, 'Dagupan City, Pangasinan, Philippines', '639273894063', 'jennie.kim@yopmail.com', 'FULFILLED', '154'),
(63, '669022154162f', 32, 6, 37, '2024/07/11', '08:19:01pm', 3, 1, 'Ayala Makati, Metro Manila, Philippines', '639273894063', 'norman.consultant@platform-11.com', 'PROCESSING', '563'),
(64, '669022154162f', 37, 3, 37, '2024/07/11', '08:19:01pm', 2, 1, 'Ayala Makati, Metro Manila, Philippines', '639273894063', 'norman.consultant@platform-11.com', 'PROCESSING', '563'),
(67, '66907384be09a', 31, 6, 37, '2024/07/12', '02:06:28am', 3, 1, 'Ayala Makati, Metro Manila, Philippines', '639273894063', 'norman.consultant@platform-11.com', 'PROCESSING', '231');

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
(39, 59, '4183-8657-9088-0099', '12/29', '808', 'Norman', 'Palisoc', '639273894063', 'Ayala Makati Metro Manila City Philippines', '', '', '', '', 'cc', 'norman.consultant@platform-11.com'),
(40, 60, '4183-8657-9088-0099', '12/28', '880', 'Norman', 'Palisoc', '639273894063', 'Ayala Makati Metro Manila Philippines', 'Norman', 'Palisoc', '639273894063', 'Ayala Makati Metro Manila Philippines', 'cc', 'norman.consultant@platform-11.com'),
(41, 61, '4183-8657-9088-0099', '12/28', '880', 'Norman', 'Palisoc', '639273894063', 'Ayala Makati Metro Manila Philippines', 'Norman', 'Palisoc', '639273894063', 'Ayala Makati Metro Manila Philippines', 'cc', 'norman.consultant@platform-11.com'),
(42, 62, '4183-8657-9088-0099', '08/30', '088', 'Jennie', 'Kim', '639273894063', 'Ayala Makati Metro Manila NCR Philippines 2419', 'Jennie', 'Kim', '639273894063', 'Ayala Makati Metro Manila NCR Philippines 2419', 'cc', 'jennie.kim@yopmail.com'),
(43, 63, '4183-8657-9088-0099', '09/29', '789', 'Norman', 'Palisoc', '639273894063', 'Cablong Santa Barbara Pangasinan Philippines', 'Jennie', 'Kim', '639273894063', 'Cablong Santa Barbara Pangasinan Philippines 2419', 'cc', 'norman.consultant@platform-11.com'),
(44, 64, '4183-8657-9088-0099', '09/29', '789', 'Norman', 'Palisoc', '639273894063', 'Cablong Santa Barbara Pangasinan Philippines', 'Jennie', 'Kim', '639273894063', 'Cablong Santa Barbara Pangasinan Philippines 2419', 'cc', 'norman.consultant@platform-11.com'),
(47, 67, '710938190238912', '-', '0', 'Norman', 'Palisoc', '639273894063', '-', 'Aiah', 'Arceta', '639273894063', 'Ayala Makati Metro Manila Philippines', 'GCASH', 'norman.consultant@platform-11.com');

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
  `product_description` varchar(999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products_info`
--

INSERT INTO `products_info` (`id`, `product_name`, `product_description`) VALUES
(31, 'MILK TEA AND 3 BUDDIES', 'Calling all Icylicious lovers!\\r\\nGet ready for our 7.7 Big Deals!\\r\\nPromo runs: July 7-30, 2024 only\\r\\n• (R) | Milk Tea and 3 Buddies P77\\r\\n• (R) | Original Corn and Cream Smoothie P77\\r\\n• 2 (L) | Tiger Boba (No Tea Drink) P177\\r\\n• (XL) | Special Mango Graham Smoothie P177\\r\\n• UPGRADE FROM (R) TO (L) | Add P7 (Milk Tea only) \\r\\nEnjoy amazing discounts on your fave drink!\\r\\nDon’t miss out!\\r\\nAvailable at all Icylicious Stores.\\r\\nT A R A , I C Y ? '),
(32, 'ORIGINAL CORN AND CREAM SMOOTHIE', 'Calling all Icylicious lovers!\\r\\nGet ready for our 7.7 Big Deals!\\r\\nPromo runs: July 7-30, 2024 only\\r\\n• (R) | Milk Tea and 3 Buddies P77\\r\\n• (R) | Original Corn and Cream Smoothie P77\\r\\n• 2 (L) | Tiger Boba (No Tea Drink) P177\\r\\n• (XL) | Special Mango Graham Smoothie P177\\r\\n• UPGRADE FROM (R) TO (L) | Add P7 (Milk Tea only) \\r\\nEnjoy amazing discounts on your fave drink!\\r\\nDon’t miss out!\\r\\nAvailable at all Icylicious Stores.\\r\\nT A R A , I C Y ? '),
(33, 'TIGER BOBA (NO TEA DRINK)', 'Calling all Icylicious lovers!\\r\\nGet ready for our 7.7 Big Deals!\\r\\nPromo runs: July 7-30, 2024 only\\r\\n• (R) | Milk Tea and 3 Buddies P77\\r\\n• (R) | Original Corn and Cream Smoothie P77\\r\\n• 2 (L) | Tiger Boba (No Tea Drink) P177\\r\\n• (XL) | Special Mango Graham Smoothie P177\\r\\n• UPGRADE FROM (R) TO (L) | Add P7 (Milk Tea only) \\r\\nEnjoy amazing discounts on your fave drink!\\r\\nDon’t miss out!\\r\\nAvailable at all Icylicious Stores.\\r\\nT A R A , I C Y ? '),
(34, 'MANGO GRAHAM SMOOTHIE', 'Calling all Icylicious lovers!\\r\\nGet ready for our 7.7 Big Deals!\\r\\nPromo runs: July 7-30, 2024 only\\r\\n• (R) | Milk Tea and 3 Buddies P77\\r\\n• (R) | Original Corn and Cream Smoothie P77\\r\\n• 2 (L) | Tiger Boba (No Tea Drink) P177\\r\\n• (XL) | Special Mango Graham Smoothie P177\\r\\n• UPGRADE FROM (R) TO (L) | Add P7 (Milk Tea only) \\r\\nEnjoy amazing discounts on your fave drink!\\r\\nDon’t miss out!\\r\\nAvailable at all Icylicious Stores.\\r\\nT A R A , I C Y ? '),
(35, 'BUBBLE MILK TEA', 'Don’t miss out! Today’s the final day to seize and enjoy our 6.6 Mid-Year Promo! \\r\\n\\r\\nAvailable at all Icylicious Stores.\\r\\nT A R A , I C Y ? '),
(36, '3 TIGER BOBA (NO TEA DRINK)', 'Don’t miss out! Today’s the final day to seize and enjoy our 6.6 Mid-Year Promo! \\r\\n\\r\\nAvailable at all Icylicious Stores.\\r\\nT A R A , I C Y ? '),
(37, 'STRAWBERRY NUTELLA SMOOTHIE', 'Don’t miss out! Today’s the final day to seize and enjoy our 6.6 Mid-Year Promo! \\r\\n\\r\\nAvailable at all Icylicious Stores.\\r\\nT A R A , I C Y ? '),
(38, '3 ORIGINAL CORN AND CREAM SMOOTHIE WITH PEARLS', 'Don’t miss out! Today’s the final day to seize and enjoy our 6.6 Mid-Year Promo! \\r\\n\\r\\nAvailable at all Icylicious Stores.\\r\\nT A R A , I C Y ? ');

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
(1, ' Norman', 'Palisoc', 'npalisoc@yondu.com', '+639273894063', 'Mayombo Dagupan City, Pangasinan, Philippines, 2319', 'Female', '2024-04-30'),
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
-- AUTO_INCREMENT for table `best_sellers`
--
ALTER TABLE `best_sellers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `orders_billing`
--
ALTER TABLE `orders_billing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `products_categories`
--
ALTER TABLE `products_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `products_images`
--
ALTER TABLE `products_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `products_info`
--
ALTER TABLE `products_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `products_prices`
--
ALTER TABLE `products_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

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
