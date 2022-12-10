-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2022 at 10:29 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `freshhub`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--
CREATE DATABASE `freshhub`;

USE `freshhub`;

CREATE TABLE `cart_items` (
  `cart_item_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` decimal(20,2) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `cart_item_quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

CREATE TABLE `inquiries` (
  `inquiry_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inquiries`
--

INSERT INTO `inquiries` (`inquiry_id`, `name`, `email`, `subject`, `message`) VALUES
(23, 'Dalton Gan', 'mingliang@gan.com', 'Delivery Options', 'Do you guys support delivery to East Malaysia? I live in SABAH and would like to use your services'),
(24, 'Bryan Wong', 'wwk@apu.my', 'Expiry Dates', 'May I know if your products comes with an expiry dates?'),
(25, 'Ian Lai', 'mynameisnotLanLai@bruh.com', 'Pomegranate Query', 'how big are your pomegranates?'),
(26, 'Amadea Lim', 'zhuzhu@me.com', 'Peanut', 'Do you sell peanuts? c:'),
(27, 'Alex Chiew', 'cyz@techsupport.apu', 'Delivery Cost', 'How do you guys calculate the shipping fee for your products?');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `total_products` varchar(255) NOT NULL,
  `total_price` decimal(20,2) NOT NULL,
  `payment_mode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `full_name`, `contact_number`, `email`, `address`, `total_products`, `total_price`, `payment_mode`) VALUES
(3, 'Admin 1', '012-345-6789', 'admin1@freshhub.com', '23, Jalan Rambutan 3', 'Orange(1)', '7.99', 'COD'),
(4, 'John Doe', '011-1111-1111', 'johndoe@gmail.com', '11, Jalan Sebelas 11/11', 'Orange(3)', '7.99', 'CreditCard'),
(5, 'John Doe', '011-1111-1111', 'johndoe@gmail.com', '11, Jalan Sebelas 11/11', 'Salmon(3), Chicken(2)', '54.99', 'COD'),
(6, 'John Doe', '011-1111-1111', 'johndoe@gmail.com', '11, Jalan Sebelas 11/11', 'Orange(1), Apple(2)', '15.98', 'COD'),
(7, 'Admin 1', '012-345-6789', 'admin1@freshhub.com', '23, Jalan Rambutan 3', 'Orange(1), Grapes(1)', '15.99', 'COD'),
(9, 'Admin 1', '012-345-6789', 'admin1@freshhub.com', '23, Jalan Rambutan 3', 'Pomegranate(1)', '5.99', 'COD'),
(10, 'John Doe', '011-1111-1111', 'johndoe@gmail.com', '11, Jalan Sebelas 11/11', 'Banana(3)', '7.50', 'CreditCard');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` decimal(20,2) NOT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `product_category` varchar(255) NOT NULL,
  `product_stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_price`, `product_image`, `product_category`, `product_stock`) VALUES
(50, 'Apple', '2.50', 'Apple.jpg', 'Fruits', 10),
(51, 'Orange', '2.00', 'Orange.jpg', 'Fruits', 40),
(52, 'Grapes', '4.00', 'Grapes.jfif', 'Fruits', 15),
(53, 'Beef', '20.00', 'Beef.jpg', 'Meat', 5),
(54, 'Lamb', '15.00', 'Lamb.png', 'Meat', 5),
(55, 'Chicken', '9.00', 'Chicken.jpg', 'Meat', 10),
(56, 'Banana', '1.00', 'Banana.jfif', 'Fruits', 16),
(57, 'Lettuce', '3.00', 'Lettuce.png', 'Vegetables', 10),
(58, 'Okra', '3.00', 'Okra.jpg', 'Vegetables', 12),
(59, 'Bok Choy', '2.00', 'Bok Choy.jfif', 'Vegetables', 20),
(61, 'Pomegranate', '5.99', 'Pomegranate.jpg', 'Fruits', 25),
(62, 'Salmon', '10.00', 'Salmon.jfif', 'Meat', 15),
(64, 'Cabbage', '2.00', 'Cabbage.png', 'Vegetables', 15),
(67, 'Spinach', '2.99', 'Spinach.jpg', 'Vegetables', 12),
(68, 'Kale', '3.50', 'Kale.jpg', 'Vegetables', 20);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `role`, `contact_number`, `address`) VALUES
(2, 'Admin', '1', 'admin1@freshhub.com', '$2y$10$1f30DSk7B.it6vx4UHKSOuEyqkkht8ozk56rTNY5lEw8syFTqnCHi', 'admin', '012-345-6789', '23, Jalan Rambutan 3'),
(3, 'John', 'Doe', 'johndoe@gmail.com', '$2y$10$5BVd1hD19FU.wc3rWWb9L..g5hVsZd2FOHpcYMqEM7KPkKJtzzvSK', 'customer', '011-1111-1111', '11, Jalan Sebelas 11/11'),
(4, 'Bryan', 'Wong', 'TP063248@mail.apu.edu.my', '$2y$10$gyNK9l4Cp6gJFj/P.NWNt.QRhzNDKdkeg4bWaHIqzvf8NIyu9L9b2', 'customer', '018-888-8888', '8, Jalan Lapan 8/8'),
(5, 'Ian', 'Lai', 'TP063403@mail.apu.edu.my', '$2y$10$OOjyRBjfUfjRouZiH8kiZ.U32Jgtkkch9EcpRd.e/DvkHjPr14apO', 'customer', '015-555-5555', '5, Jalan Lmao 5/5'),
(6, 'Dalton', 'Gan', 'TP063338@mail.apu.edu.my', '$2y$10$revlbVGOAtPHSvMi1lL07.0m4n8c9giSoGIFoCPbDi3oAJRlQPvXK', 'customer', '014-444-4444', '7, Jalan Tujuh 7/7');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`cart_item_id`);

--
-- Indexes for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD PRIMARY KEY (`inquiry_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `cart_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `inquiries`
--
ALTER TABLE `inquiries`
  MODIFY `inquiry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
