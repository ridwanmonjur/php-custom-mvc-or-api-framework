-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 13, 2023 at 05:30 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trial`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `sku` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `type` varchar(25) NOT NULL,
  `attribute` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`sku`, `name`, `price`, `type`, `attribute`) VALUES
('BOOK01', 'GOT', 50, 'book', '2 KG'),
('DVD001', 'FRIENDS', 10, 'disc', '120 MB'),
('DVD002', 'WITCHER', 10, 'disc', '120 MB'),
('DVD003', 'DAT', 10, 'disc', '120 MB'),
('FURNITURE000', 'Chair', 20, 'furniture', '30x10x10'),
('FURNITURE001', 'Table', 20, 'furniture', '30x10x10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`sku`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

/*
SELECT 
product.sku, product.name, product.price, 
product_attribute.value, 
attribute.name, attribute.unit
FROM `product` 
INNER JOIN `product_attribute` 
ON product_attribute.product_sku = product.sku 
INNER JOIN `attribute`
ON product_attribute.attribute_id = attribute.id 
ORDER BY product.sku
LIMIT 0, 25;

SELECT 
sku, GROUP_CONCAT(value SEPARATOR 'x') AS attribute,
name, price, unit
FROM 
(SELECT 
product.sku, product.name, product.price, 
product_attribute.value,
attribute.name AS `attributeName`, 
attribute.unit
FROM `product` 
INNER JOIN `product_attribute` 
ON product_attribute.product_sku = product.sku 
INNER JOIN `attribute`
ON product_attribute.attribute_id = attribute.id 
ORDER BY product.sku 
LIMIT 0, 25
) 
table2 
GROUP BY sku;

*/