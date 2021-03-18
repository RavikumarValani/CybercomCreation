-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2021 at 05:37 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(4) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(10) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `createddate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `status`, `createddate`) VALUES
(1, 'admin', 'admin', 0, '2021-03-05'),
(2, 'admin2', '123', 1, '2021-02-25'),
(3, 'admin3', '123', 0, '2021-02-25'),
(5, 'admin12', '123', 1, '2021-03-05'),
(6, 'admin3a', '123', 1, '2021-03-05');

-- --------------------------------------------------------

--
-- Table structure for table `attribute`
--

CREATE TABLE `attribute` (
  `attributeId` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `entityTypeId` enum('product','category') NOT NULL,
  `code` varchar(20) NOT NULL,
  `inputType` varchar(20) NOT NULL,
  `backEndType` varchar(40) NOT NULL,
  `sortOrder` int(4) NOT NULL,
  `backEndModel` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attribute`
--

INSERT INTO `attribute` (`attributeId`, `name`, `entityTypeId`, `code`, `inputType`, `backEndType`, `sortOrder`, `backEndModel`) VALUES
(3, 'color', 'product', 'color', '0', '1', 1, 0),
(4, 'brand', 'product', 'brand', '2', '2', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `attribute_option`
--

CREATE TABLE `attribute_option` (
  `optionId` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `attributeId` int(11) NOT NULL,
  `sortOrder` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attribute_option`
--

INSERT INTO `attribute_option` (`optionId`, `name`, `attributeId`, `sortOrder`) VALUES
(1, 'gree', 3, '1'),
(2, 'blue', 3, '2'),
(3, 'green', 3, '1');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(4) NOT NULL,
  `name` varchar(30) NOT NULL,
  `status` varchar(8) NOT NULL,
  `description` varchar(100) NOT NULL,
  `parentId` int(11) NOT NULL,
  `pathId` varchar(100) DEFAULT NULL,
  `createddate` date DEFAULT NULL,
  `updateddate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `status`, `description`, `parentId`, `pathId`, `createddate`, `updateddate`) VALUES
(1, 'camera', '0', 'abc', 0, NULL, '2021-02-26', '2021-02-26'),
(2, 'mobile', '1', 'Best for Today', 0, NULL, NULL, NULL),
(3, 'camera', '1', 'abc', 0, NULL, NULL, NULL),
(4, 'Mobile', 'Enable', 'best mobile for this summer', 0, NULL, NULL, NULL),
(5, 'pen', '1', 'good for writting', 0, NULL, NULL, NULL),
(25, 'camera1', '0', 'zx', 0, NULL, '2021-03-12', NULL),
(26, 'camera1', '0', 'bh', 0, NULL, '2021-03-13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerId` int(11) NOT NULL,
  `addressId` int(11) DEFAULT NULL,
  `groupId` int(11) DEFAULT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `mobile` int(10) NOT NULL,
  `status` text NOT NULL,
  `createddate` date DEFAULT NULL,
  `updateddate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerId`, `addressId`, `groupId`, `firstname`, `lastname`, `email`, `password`, `mobile`, `status`, `createddate`, `updateddate`) VALUES
(1, 1, 3, 'Ajay', 'vala', 'va@va', '123', 1234567899, '1', '2021-03-13', '0000-00-00'),
(2, 2, 3, 'ravi', 'valani', 'va@va', '123', 1234567899, '1', '2021-03-13', '0000-00-00'),
(7, 3, 3, 'sahil', 'soni', 'va@va', '123', 12, '0', '2021-03-13', NULL),
(8, 2, 3, 'manan', 'vasoya', 'va@va', 'kkkk', 789, '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `entityId` int(11) NOT NULL,
  `addressId` int(4) DEFAULT NULL,
  `address` varchar(30) DEFAULT NULL,
  `city` text DEFAULT NULL,
  `state` text DEFAULT NULL,
  `zip` int(10) DEFAULT NULL,
  `type` enum('billing','shipping') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`entityId`, `addressId`, `address`, `city`, `state`, `zip`, `type`) VALUES
(5, 1, 'block1', 'a', 'a', 1, 'billing'),
(6, 1, 'block2', 'a', 'a', 1, 'shipping'),
(7, 2, 'block3', 'a', 'a', 1, 'shipping');

-- --------------------------------------------------------

--
-- Table structure for table `customer_group`
--

CREATE TABLE `customer_group` (
  `entityId` int(11) NOT NULL,
  `groupId` int(11) DEFAULT NULL,
  `name` varchar(20) NOT NULL,
  `status` tinyint(2) DEFAULT NULL,
  `createddate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_group`
--

INSERT INTO `customer_group` (`entityId`, `groupId`, `name`, `status`, `createddate`) VALUES
(1, 3, 'g1', 1, '2021-03-09'),
(2, 2, 'g2', 1, '2021-03-09'),
(3, 1, 'g3', 1, '2021-03-09'),
(4, 4, 'g4', 1, '2021-03-09'),
(5, 5, 'g5', 0, '2021-03-09');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(4) NOT NULL,
  `name` varchar(20) NOT NULL,
  `code` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` text NOT NULL,
  `createddate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `name`, `code`, `description`, `status`, `createddate`) VALUES
(1, 'ravi', '1230', 'good dile', '0', '0000-00-00'),
(2, 'ravi', '1230', 'good dile', '1', '0000-00-00'),
(5, 'xyyz', '123', 'abc', 'Enable', '2021-02-26'),
(6, 'qwe', '123', '1', '1', '2021-03-01');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(4) NOT NULL,
  `sku` int(6) DEFAULT NULL,
  `image` longtext NOT NULL DEFAULT 'NOT NULL',
  `name` varchar(20) NOT NULL,
  `price` bigint(10) NOT NULL,
  `discount` bigint(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  `createddate` date NOT NULL,
  `updateddate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `sku`, `image`, `name`, `price`, `discount`, `quantity`, `description`, `status`, `createddate`, `updateddate`) VALUES
(4, 102, 'NOT NULL', 'watch', 5000, 20, 10, 'best for you', '0', '0000-00-00', '2021-03-13'),
(5, 103, 'NOT NULL', 'headphone', 300, 1, 20, '', '1', '2021-02-16', '0000-00-00'),
(6, 104, 'NOT NULL', 'Mobile', 2000, 10, 20, 'best for today', '1', '2021-02-16', '0000-00-00'),
(13, 111, 'NOT NULL', 'Mobile1', 2000, 10, 20, 'Enable', '1', '2021-02-18', '2021-02-18'),
(14, 112, 'NOT NULL', 'Mobile1', 2000, 10, 20, 'Enable', '1', '2021-02-18', '0000-00-00'),
(95, 167, 'NOT NULL', 'lenovo laptop', 10, 0, 2, '0', '0', '2021-03-04', '0000-00-00'),
(96, 167, 'NOT NULL', 'lenovo laptop', 20000, 0, 2, '10', '0', '2021-03-04', '0000-00-00'),
(97, 167, 'NOT NULL', 'lenovo laptop', 12, 1, 12, '10', '0', '2021-03-04', '0000-00-00'),
(98, 167, 'NOT NULL', 'samsung1', 12000, 10, 10, '0100', '0', '2021-03-04', '0000-00-00'),
(99, 138, 'NOT NULL', 'abc', 12000, 10, 10, '10', '0', '2021-03-04', '0000-00-00'),
(100, 138, 'NOT NULL', 'abc', 12000, 10, 10, '10', '0', '2021-03-04', '0000-00-00'),
(101, 198, 'NOT NULL', 'xc', 12, 11, 12, '1', '0', '2021-03-04', '0000-00-00'),
(102, 1, 'NOT NULL', 'qw', 1, 1, 1, '1', '0', '2021-03-04', '0000-00-00'),
(103, 167, 'NOT NULL', 'lenovo laptop', 10000, 1, 1, '1', '0', '2021-03-04', '0000-00-00'),
(104, 1670, 'NOT NULL', 'lenovo laptop', 12, 1, 1, '1', '0', '2021-03-04', '0000-00-00'),
(105, 1671, 'NOT NULL', 'j', 1, 1, 1, '1', '0', '2021-03-04', '0000-00-00'),
(106, 2, 'NOT NULL', 'a', 100, 10, 10, '10', '0', '2021-03-04', '0000-00-00'),
(107, 2, 'NOT NULL', 'a', 100, 10, 10, '10', '0', '2021-03-04', '0000-00-00'),
(108, 2, 'NOT NULL', 'a', 100, 10, 10, '10', '0', '2021-03-04', '0000-00-00'),
(109, 2, 'NOT NULL', 'a', 100, 10, 10, '10', '0', '2021-03-04', '0000-00-00'),
(110, 2, 'NOT NULL', 'a', 100, 10, 10, '10', '0', '2021-03-04', '0000-00-00'),
(111, 2, 'NOT NULL', 'a', 100, 10, 10, '10', '0', '2021-03-04', '0000-00-00'),
(112, 167, 'NOT NULL', 'lenovo laptop', 1, 2, 2, '2', '0', '2021-03-04', '0000-00-00'),
(113, 167, 'NOT NULL', 'lenovo laptop', 1, 2, 2, '2', '0', '2021-03-04', '0000-00-00'),
(114, 167, 'NOT NULL', '122', 1, 1, 1, '1', '0', '2021-03-04', '0000-00-00'),
(122, 167, 'NOT NULL', 'lenovo laptop', 121000, 1, 1, '1', '0', '2021-03-10', '0000-00-00'),
(123, 167, 'NOT NULL', 'lenovo laptop', 121000, 1, 1, '1', '0', '2021-03-10', '0000-00-00'),
(125, 167, 'NOT NULL', 'lenovo laptop', 13231, 13, 13, '31', '0', '2021-03-10', '0000-00-00'),
(126, 167, 'NOT NULL', 'lenovo laptop', 12333, 1, 12, '12', '0', '2021-03-11', '0000-00-00'),
(127, 167, 'NOT NULL', 'lenovo laptop', 122333, 1, 1, '1', '0', '2021-03-13', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `product_group_price`
--

CREATE TABLE `product_group_price` (
  `entityId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `CustomerGroupId` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_group_price`
--

INSERT INTO `product_group_price` (`entityId`, `productId`, `CustomerGroupId`, `price`) VALUES
(2, 4, 2, '200.00'),
(3, 4, 3, '300.00'),
(4, 4, 4, '400.00'),
(17, 4, 5, '500.00'),
(18, 4, 1, '100.00'),
(19, 5, 3, '200.00'),
(20, 5, 2, '500.00'),
(21, 5, 1, '600.00'),
(22, 5, 4, '0.00'),
(23, 5, 5, '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `id` int(4) NOT NULL,
  `name` varchar(20) NOT NULL,
  `code` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` varchar(6) NOT NULL,
  `createddate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`id`, `name`, `code`, `amount`, `description`, `status`, `createddate`) VALUES
(1, 'abc', '123', '0.00', '123', '1', '0000-00-00'),
(2, 'abc', '123', '0.00', '123', '0', '0000-00-00'),
(5, 'abcd', '12', '0.00', '12', '0', '2021-02-22'),
(6, 'abc', '12', '0.00', '12', 'Choose', '2021-02-23'),
(7, 'xyz', '123', '0.00', '12', '1', '2021-02-23'),
(9, 'abc', '123', '12.00', '123', 'Enable', '2021-02-23'),
(11, 'xyz', '789', '12.50', 'hi', 'Enable', '2021-02-23'),
(12, 'abc', '123', '12.00', '123', '1', '2021-02-23'),
(14, 'qwe', '123', '12.00', '1', '0', '2021-03-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`attributeId`);

--
-- Indexes for table `attribute_option`
--
ALTER TABLE `attribute_option`
  ADD PRIMARY KEY (`optionId`),
  ADD KEY `attributeId` (`attributeId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerId`),
  ADD KEY `address_id` (`addressId`),
  ADD KEY `groupId` (`groupId`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`entityId`),
  ADD KEY `addressId` (`addressId`);

--
-- Indexes for table `customer_group`
--
ALTER TABLE `customer_group`
  ADD PRIMARY KEY (`entityId`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_group_price`
--
ALTER TABLE `product_group_price`
  ADD PRIMARY KEY (`entityId`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `attribute`
--
ALTER TABLE `attribute`
  MODIFY `attributeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `attribute_option`
--
ALTER TABLE `attribute_option`
  MODIFY `optionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `entityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer_group`
--
ALTER TABLE `customer_group`
  MODIFY `entityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `product_group_price`
--
ALTER TABLE `product_group_price`
  MODIFY `entityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attribute_option`
--
ALTER TABLE `attribute_option`
  ADD CONSTRAINT `attribute_option_ibfk_1` FOREIGN KEY (`attributeId`) REFERENCES `attribute` (`attributeId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD CONSTRAINT `customer_address_ibfk_1` FOREIGN KEY (`addressId`) REFERENCES `customer` (`addressId`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `customer_group`
--
ALTER TABLE `customer_group`
  ADD CONSTRAINT `customer_group_ibfk_1` FOREIGN KEY (`groupId`) REFERENCES `customer` (`groupId`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
