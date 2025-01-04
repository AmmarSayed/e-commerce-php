-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 04, 2025 at 12:36 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `MyStore`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `br_id` int(11) NOT NULL,
  `br_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`br_id`, `br_title`) VALUES
(1, 'Swiggy'),
(3, 'Amazon'),
(4, 'Gucchi'),
(5, 'Nike');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `pr_id` int(11) NOT NULL,
  `qty` int(100) NOT NULL,
  `ip_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`pr_id`, `qty`, `ip_address`) VALUES
(1, 1, '0'),
(1, 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(3, 'Vegetables'),
(5, 'Milk products'),
(6, 'Books'),
(7, 'Chips'),
(9, 'Fruits');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `usr_id` int(11) NOT NULL,
  `amount_due` int(11) NOT NULL,
  `inv_number` varchar(100) NOT NULL,
  `total_products` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_status` varchar(100) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`usr_id`, `amount_due`, `inv_number`, `total_products`, `order_date`, `order_status`, `order_id`) VALUES
(1, 460, '1742654007', 3, '2025-01-04 10:15:13', 'confirmed', 2),
(1, 780, '1609939233', 6, '2025-01-04 11:14:35', 'pending', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pending_orders`
--

CREATE TABLE `pending_orders` (
  `usr_id` int(11) NOT NULL,
  `inv_number` varchar(100) NOT NULL,
  `pr_id` int(11) NOT NULL,
  `pr_qty` int(11) NOT NULL,
  `order_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pending_orders`
--

INSERT INTO `pending_orders` (`usr_id`, `inv_number`, `pr_id`, `pr_qty`, `order_status`) VALUES
(1, '28094706', 3, 3, 'pending'),
(1, '28094706', 1, 1, 'pending'),
(1, '1742654007', 3, 1, 'confirmed'),
(1, '1742654007', 1, 1, 'confirmed'),
(1, '1742654007', 2, 1, 'confirmed'),
(1, '1609939233', 3, 3, 'pending'),
(1, '1609939233', 2, 2, 'pending'),
(1, '1609939233', 1, 1, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pr_id` int(11) NOT NULL,
  `pr_title` varchar(100) NOT NULL,
  `pr_description` varchar(255) NOT NULL,
  `pr_keywords` varchar(255) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `br_id` int(11) NOT NULL,
  `pr_img1` varchar(255) NOT NULL,
  `pr_img2` varchar(255) NOT NULL,
  `pr_img3` varchar(255) NOT NULL,
  `pr_price` double NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pr_id`, `pr_title`, `pr_description`, `pr_keywords`, `cat_id`, `br_id`, `pr_img1`, `pr_img2`, `pr_img3`, `pr_price`, `date`, `status`) VALUES
(1, 'Fresh Mangooo', 'Mango is always good, eat once and you will ask for more', 'Fresh Mango,Fresh,Good,Mango,Good Mango', 9, 4, 'mango1.png', 'mango2.png', 'mango3.png', 200, '2025-01-04 09:12:45', 'true'),
(2, 'Shoes', 'Great running shoes for men,women and kids', 'shoes,sport,women,men,kids', 7, 2, '6772bc0add23a.png', '6772bc0add42c.png', '6772bc0add42e.png', 200, '2024-12-30 15:28:10', 'true'),
(3, 'Apple', 'One Apple a day, keep the doctor away', 'apple,fresh apple,fruit,', 9, 4, '6778f137d5391.png', '6778f137d53a6.png', '6778f137d53a7.png', 60, '2025-01-04 08:28:39', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `usr_id` int(11) NOT NULL,
  `usr_name` varchar(100) NOT NULL,
  `usr_password` varchar(255) NOT NULL,
  `usr_email` varchar(100) NOT NULL,
  `usr_img` varchar(255) NOT NULL,
  `usr_address` varchar(200) NOT NULL,
  `usr_contact` varchar(100) NOT NULL,
  `usr_ip` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usr_id`, `usr_name`, `usr_password`, `usr_email`, `usr_img`, `usr_address`, `usr_contact`, `usr_ip`) VALUES
(1, 'ammar', '$2y$10$mswRQHDiUpfyg6OJG5J9peH/uTn4.f4Bjo3elRFDh70xOc3mleVy2', 'non@non.com', 'boy.png', 'address test', '015555555', '::1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`br_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pr_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usr_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `br_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
