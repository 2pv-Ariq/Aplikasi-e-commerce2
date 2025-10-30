-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2025 at 07:34 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce.db`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id_cart` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id_cart`, `id_user`, `id_product`, `quantity`) VALUES
(10, 3, 1, 1),
(48, 4, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `total_price` decimal(12,2) NOT NULL,
  `order_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_order`, `id_user`, `total_price`, `order_date`) VALUES
(7, 1, 2000000.00, '2025-09-30 20:53:33'),
(8, 4, 12954000.00, '2025-10-01 13:52:22'),
(9, 4, 6477000.00, '2025-10-01 13:52:31'),
(10, 4, 28977000.00, '2025-10-01 13:54:41'),
(11, 4, 8977000.00, '2025-10-01 13:55:09'),
(12, 4, 8277000.00, '2025-10-01 14:00:01'),
(13, 4, 20000000.00, '2025-10-01 14:01:31'),
(14, 4, 40000000.00, '2025-10-01 14:35:24'),
(15, 4, 6477000.00, '2025-10-01 14:35:34'),
(16, 4, 20000000.00, '2025-10-01 14:35:47'),
(17, 4, 20000000.00, '2025-10-01 14:40:52'),
(18, 4, 20000000.00, '2025-10-01 15:17:16'),
(19, 4, 20000000.00, '2025-10-01 15:17:21'),
(20, 4, 20000000.00, '2025-10-01 16:06:15'),
(21, 4, 6477000.00, '2025-10-01 16:07:03'),
(22, 4, 20000000.00, '2025-10-01 16:08:28'),
(23, 4, 20000000.00, '2025-10-01 16:08:44'),
(24, 4, 6477000.00, '2025-10-01 16:23:05'),
(25, 4, 20000000.00, '2025-10-02 07:04:01'),
(26, 4, 6477000.00, '2025-10-02 07:48:06'),
(27, 4, 6477000.00, '2025-10-02 07:49:27'),
(28, 4, 6477000.00, '2025-10-02 07:50:12'),
(29, 4, 20500000.00, '2025-10-02 08:15:05'),
(30, 4, 1000000.00, '2025-10-02 08:23:05'),
(31, 4, 20000000.00, '2025-10-02 08:23:46'),
(32, 4, 500000.00, '2025-10-02 08:24:04'),
(33, 4, 81000000.00, '2025-10-02 08:26:55'),
(34, 4, 66908000.00, '2025-10-02 08:29:47'),
(35, 5, 48777000.00, '2025-10-02 11:02:54'),
(36, 5, 20000000.00, '2025-10-02 11:46:05'),
(37, 5, 20000000.00, '2025-10-02 14:45:06');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id_order_item` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id_order_item`, `id_order`, `id_product`, `quantity`, `price`) VALUES
(28, 22, 10, 1, 20000000.00),
(29, 23, 10, 1, 20000000.00),
(30, 24, 7, 1, 6477000.00),
(31, 25, 10, 1, 20000000.00),
(32, 26, 7, 1, 6477000.00),
(33, 27, 7, 1, 6477000.00),
(34, 28, 7, 1, 6477000.00),
(35, 29, 9, 1, 500000.00),
(36, 29, 10, 1, 20000000.00),
(37, 30, 9, 2, 500000.00),
(38, 31, 10, 1, 20000000.00),
(39, 32, 9, 1, 500000.00),
(40, 33, 10, 4, 20000000.00),
(41, 33, 9, 2, 500000.00),
(42, 34, 10, 2, 20000000.00),
(43, 34, 9, 2, 500000.00),
(44, 34, 7, 4, 6477000.00),
(3356, 35, 10, 2, 20000000.00),
(3357, 35, 9, 1, 500000.00),
(3358, 35, 8, 1, 1800000.00),
(3359, 35, 7, 1, 6477000.00),
(3360, 36, 10, 1, 20000000.00),
(3361, 37, 10, 1, 20000000.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id_product` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id_product`, `name`, `price`, `description`, `image_url`) VALUES
(1, 'ga tau', 2000000.00, 'mboh cuy', 'images/Gamen.jpg'),
(2, 'legion Pro 7i', 17000000.00, 'RTX 4050', 'images/rexus.webp'),
(3, 'keyboard', 200000.00, 'rexus', 'images/rexus.webp'),
(4, 'mouse', 260000.00, 'logitech', 'images/Gamen.jpg'),
(5, 'LOQ gaming', 17000000.00, 'RTX 4050', 'images/Gamen.jpg'),
(6, 'Mi 10t pro', 2500000.00, 'Naga 865', 'images/xiaomi10TPRO.webp'),
(7, 'XIAOMI 15T', 6477000.00, 'Dimensity 8400', 'images/xiaomi15T.webp'),
(8, 'monitor', 1800000.00, 'xiaomi gaming', 'images/Xiaomi.png'),
(9, 'casing pc', 500000.00, 'gamen titan', 'images/Gamen.jpg'),
(10, 'vga nvdia RTX 5090', 20000000.00, 'vga gacor kang', 'images/rexus.webp');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(150) NOT NULL,
  `is_admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `email`, `is_admin`) VALUES
(1, 'Shafaariq', '$2y$10$cUebTuzgAl9FBVXqrGFj5.XJof85BtRBt1zaiTVlQhdxPnOP6p4cO', 'shafa@gmail.com', 0),
(3, 'admin', '$2y$10$8i0JwOHlkamm/6eUSjHNrOHZflPmzVjbuu1X2jloPR9kJWjMPqeOO', 'admin@example.com', 1),
(4, 'shafa', '$2y$10$mcNMM/DKc0kwKdI8qfvPD.KWtspr/MZBlA8aUzmEyxLFrp/0e.Lr.', 'ariq@gmail.com', 0),
(5, 'yasa', '$2y$10$wX73L.TMEXxrYdrVQqz1Ce2UM3/7EvP6ZtbQe2S/U95ATQBOZuEj.', 'yasa@gmail.com', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id_order_item`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id_order_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3362;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
