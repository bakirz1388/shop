-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2026 at 12:37 AM
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
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `img` varchar(1000) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `status` int(11) NOT NULL,
  `hot` int(11) NOT NULL,
  `new` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `stock`, `img`, `description`, `status`, `hot`, `new`) VALUES
(1, 'LOQ Gamig LapTop', 'Gaming', 1000000000, 15, 'product1777336519', 'test', 1, 0, 1),
(2, 'LOQ Gamig LapTop2', 'Gaming', 500000000, 5, 'product1777336549', 'test', 1, 1, 0),
(3, 'Lamborghini Huracán EVO‏', 'Digital', 10000000, 0, 'product1777371027', 'test2', 1, 1, 0),
(4, 'Lamborghini Huracán EVO‏', 'Digital', 10000000, 1, 'product1777371102', 'test2', 1, 0, 0),
(12, 'Need For Speed Heat', 'Clothing', 500000, 5, 'product1777372780', 'test5', 1, 0, 0),
(13, 'Need For Speed Heat', 'Gaming', 500000, 0, 'product1777372780', 'test5', 1, 0, 0),
(14, 'Need For Speed Heat', 'Accessory', 500000, 5, 'product1777372780', 'test5', 1, 0, 0),
(15, 'Need For Speed Heat', 'Gaming', 500000, 0, 'product1777372780', 'test5', 1, 0, 1),
(16, 'لباس شویی اسنوا', 'Appliances', 50000000, 5, 'product1778433961', 'لباس شویی 1111', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `r_name` varchar(100) NOT NULL,
  `u_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `r_name`, `u_name`, `email`, `pass`, `role`) VALUES
(1, 'YasinBakamal', 'baki', 'skeletongaming72@gmail.com', '1388', 0),
(2, 'hamid baki', 'baki_is_hamid', 'hamidbakamal16@gmail.com', '1234', 2),
(3, 'Bakamal', 'Yasin', 'skeletongaming72@gmail.com', '1234', 0),
(4, 'Bakamal', 'Yasin12', 'skeletongaming72@gmail.com', '12364', 1),
(6, 'gaming', 'skeleton', 'skeletongaming72@gmail.com', '1234', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `uq_users_username` (`u_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
