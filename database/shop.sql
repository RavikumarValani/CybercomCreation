-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2021 at 04:01 PM
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
  `adminId` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createddate` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `username`, `password`, `status`, `createddate`) VALUES
(1, 'ravi', '54646bnvbcg', 1, '2021-04-06 10:08:56.000000'),
(2, 'sahil', 'bgfbgf2215', 1, '2021-04-06 10:09:23.000000'),
(4, 'Sanjai', '264hhfg', 1, '2021-04-07 21:45:10.000000'),
(5, 'Mahesh', 'ahedh12345', 1, '2021-04-07 21:46:23.000000');

-- --------------------------------------------------------

--
-- Table structure for table `attribute`
--

CREATE TABLE `attribute` (
  `attributeId` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `entityTypeId` enum('product','category') NOT NULL,
  `code` varchar(16) NOT NULL,
  `inputType` varchar(16) NOT NULL,
  `backEndType` varchar(16) NOT NULL,
  `sortOrder` int(4) NOT NULL,
  `backEndModel` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attribute`
--

INSERT INTO `attribute` (`attributeId`, `name`, `entityTypeId`, `code`, `inputType`, `backEndType`, `sortOrder`, `backEndModel`) VALUES
(1, 'color', 'product', 'color', 'select', 'Varchar', 1, 'attribute_option'),
(2, 'type', 'product', 'type', 'select', 'Varchar', 2, 'attribute_option'),
(3, 'brand', 'product', 'brand', 'radio', 'Varchar', 2, 'attribute_option'),
(7, 'Material', 'product', 'Material', 'select', 'Text', 1, 'attribute_option');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_option`
--

CREATE TABLE `attribute_option` (
  `optionId` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `attributeId` int(11) NOT NULL,
  `sortOrder` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attribute_option`
--

INSERT INTO `attribute_option` (`optionId`, `name`, `attributeId`, `sortOrder`) VALUES
(1, 'black', 1, '1'),
(2, 'white', 1, '2'),
(3, 'green', 1, '3'),
(4, 'red', 1, '2'),
(5, 'yellow', 1, '2'),
(6, 'Hp', 3, '2'),
(7, 'Lenovo', 3, '1'),
(8, 'a', 2, '1'),
(9, 'b', 2, '2'),
(10, 'c', 2, '3'),
(17, 'd', 2, '1');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `paymentmethodId` int(11) NOT NULL,
  `shippingmethodId` int(11) NOT NULL,
  `shippingAmount` decimal(6,2) NOT NULL,
  `total` decimal(16,2) NOT NULL,
  `discount` decimal(16,2) NOT NULL,
  `createddate` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cart_address`
--

CREATE TABLE `cart_address` (
  `cartAddressId` int(11) NOT NULL,
  `addressId` int(11) DEFAULT NULL,
  `customerId` int(11) NOT NULL,
  `cartId` int(11) DEFAULT NULL,
  `address` varchar(64) NOT NULL,
  `city` varchar(16) NOT NULL,
  `state` varchar(16) NOT NULL,
  `country` varchar(16) NOT NULL,
  `zip` int(6) DEFAULT NULL,
  `type` enum('shipping','billing') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_address`
--

INSERT INTO `cart_address` (`cartAddressId`, `addressId`, `customerId`, `cartId`, `address`, `city`, `state`, `country`, `zip`, `type`) VALUES
(1, NULL, 0, NULL, '', '', '', '', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `itemId` int(11) NOT NULL,
  `cartId` int(11) DEFAULT NULL,
  `productId` int(11) DEFAULT NULL,
  `quantity` int(16) NOT NULL,
  `price` decimal(16,2) NOT NULL,
  `discount` decimal(16,2) NOT NULL,
  `createddate` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `parentId` int(11) DEFAULT NULL,
  `pathId` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `description` varchar(200) DEFAULT NULL,
  `createddate` datetime(6) NOT NULL,
  `updateddate` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `name`, `parentId`, `pathId`, `status`, `description`, `createddate`, `updateddate`) VALUES
(1, 'bedroom', 0, '1', 0, 'abc', '2021-04-04 04:18:07.000000', NULL),
(2, 'beds', 1, '1=2', 0, 'abc', '2021-04-10 08:45:08.000000', NULL),
(3, 'panel beds', 2, '1=2=3', 1, 'a', '2021-04-06 08:09:01.000000', NULL),
(7, 'footboard', 3, '1=2=3=7', 1, 'a', '2021-04-06 08:05:26.000000', NULL),
(8, 'headboard', 3, '1=2=3=8', 1, 'a', '2021-04-06 08:05:42.000000', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms_page`
--

CREATE TABLE `cms_page` (
  `pageId` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `identifier` int(11) NOT NULL,
  `content` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createddate` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_page`
--

INSERT INTO `cms_page` (`pageId`, `title`, `identifier`, `content`, `status`, `createddate`) VALUES
(1, 'abc', 0, 'abc', 0, '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `configId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `code` varchar(16) NOT NULL,
  `value` varchar(16) NOT NULL,
  `createddate` datetime(6) NOT NULL,
  `updateddate` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`configId`, `groupId`, `title`, `code`, `value`, `createddate`, `updateddate`) VALUES
(1, 4, 'website', 'web_site', 'web', '2021-04-08 10:08:18.000000', '0000-00-00 00:00:00.000000'),
(4, 2, 'web', 'web', '12', '2021-04-09 11:29:17.000000', '0000-00-00 00:00:00.000000'),
(5, 5, 'web', 'web', '12', '2021-04-09 11:29:45.000000', '0000-00-00 00:00:00.000000'),
(6, 5, 'web', 'web', '12', '2021-04-09 11:30:20.000000', '0000-00-00 00:00:00.000000'),
(7, 2, 'web', 'b', '12', '2021-04-11 15:13:01.000000', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `config_group`
--

CREATE TABLE `config_group` (
  `groupId` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `createddate` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config_group`
--

INSERT INTO `config_group` (`groupId`, `name`, `createddate`) VALUES
(2, 'g2', '2021-04-10 13:51:24.000000'),
(4, 'g1', '2021-04-09 08:20:13.000000'),
(5, 'g3', '2021-04-09 09:02:05.000000'),
(7, 'g4', '2021-04-11 15:15:29.000000');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerId` int(11) NOT NULL,
  `groupId` int(11) DEFAULT NULL,
  `firstname` varchar(16) NOT NULL,
  `lastname` varchar(16) NOT NULL,
  `email` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `mobile` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createddate` datetime(6) NOT NULL,
  `updateddate` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerId`, `groupId`, `firstname`, `lastname`, `email`, `password`, `mobile`, `status`, `createddate`, `updateddate`) VALUES
(1, 1, 'ravi', 'valani', 'valani@gmail.com', '123456', 2147483647, 1, '2021-04-10 13:50:19.000000', '2021-04-10 13:50:19.000000'),
(2, 2, 'ajay', 'jadav', 'jadav@gmail.com', 'okjk56', 2147483647, 1, '2021-04-10 06:59:08.000000', '2021-04-10 06:59:08.000000'),
(3, 3, 'sahil', 'vasoya', 'vasoya@gmail.com', 'mnmnkmd66', 2147483647, 1, '2021-04-09 12:40:27.000000', '2021-04-09 12:40:27.000000'),
(4, 1, 'jecky', 'samani', 'jecky@gmail.com', '123jjgh56', 2147483647, 1, '2021-04-09 12:37:17.000000', '2021-04-09 12:37:17.000000');

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `addressId` int(11) NOT NULL,
  `customerId` int(11) DEFAULT NULL,
  `address` varchar(64) NOT NULL,
  `city` varchar(16) NOT NULL,
  `state` varchar(16) NOT NULL,
  `country` varchar(16) NOT NULL,
  `zip` int(6) NOT NULL,
  `type` enum('billing','shipping') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`addressId`, `customerId`, `address`, `city`, `state`, `country`, `zip`, `type`) VALUES
(1, 1, 'Moti lakhavad,Rajkot,Vinchhiya', 'Vinchhiya', 'Gujrat', 'India', 1234, 'billing'),
(3, 1, 'Moti lakhavad,Rajkot,Vinchhiya', 'Vinchhiya', 'Gujrat', 'India', 123, 'shipping'),
(7, 3, 'gokul nagar,ram mandir ,street 9, mujka,rajkot', 'rajkot', 'gujrat', 'India', 360001, 'billing'),
(8, 3, 'xyz,street 9,mujka,rajkot', 'rajkot', 'gujrat', 'India', 360001, 'shipping'),
(9, 2, 'abc,street 8,mujka,rajkot', 'rajkot', 'gujrat', 'India', 360001, 'billing'),
(10, 2, 'abc,street 8,mujka,rajkot', 'rajkot', 'gujrat', 'India', 360001, 'shipping'),
(11, 4, 'abc,street 3,mujka,rajkot', 'rajkot', 'gujrat', 'India', 360001, 'billing'),
(12, 4, 'abc,street 3,mujka,rajkot', 'rajkot', 'gujrat', 'India', 360001, 'shipping');

-- --------------------------------------------------------

--
-- Table structure for table `customer_group`
--

CREATE TABLE `customer_group` (
  `groupId` int(11) NOT NULL,
  `name` varchar(16) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createddate` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_group`
--

INSERT INTO `customer_group` (`groupId`, `name`, `status`, `createddate`) VALUES
(1, 'Retail', 1, '2021-04-06 08:52:05.000000'),
(2, 'wholesale', 1, '2021-04-06 08:53:49.000000'),
(3, 'platinum', 1, '2021-04-06 08:54:04.000000'),
(4, 'gold', 1, '2021-04-06 08:54:26.000000'),
(5, 'silver', 1, '2021-04-06 08:54:35.000000');

-- --------------------------------------------------------

--
-- Table structure for table `orderaddress`
--

CREATE TABLE `orderaddress` (
  `orderAddressId` int(11) NOT NULL,
  `addressId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `address` varchar(64) NOT NULL,
  `city` varchar(16) NOT NULL,
  `state` varchar(16) NOT NULL,
  `country` varchar(16) NOT NULL,
  `zip` int(6) NOT NULL,
  `type` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderaddress`
--

INSERT INTO `orderaddress` (`orderAddressId`, `addressId`, `customerId`, `address`, `city`, `state`, `country`, `zip`, `type`) VALUES
(1, 1, 1, 'Moti lakhavad,Rajkot,Vinchhiya', 'Vinchhiya', 'Gujrat', 'India', 123, 'shipping'),
(2, 1, 1, 'Moti lakhavad,Rajkot,Vinchhiya', 'Vinchhiya', 'Gujrat', 'India', 123, 'billing'),
(3, 1, 1, 'Moti lakhavad,Rajkot,Vinchhiya', 'Vinchhiya', 'Gujrat', 'India', 1234, 'billing'),
(4, 3, 1, 'Moti lakhavad,Rajkot,Vinchhiya', 'Vinchhiya', 'Gujrat', 'India', 1234, 'shipping'),
(5, 1, 1, 'Moti lakhavad,Rajkot,Vinchhiya', 'Vinchhiya', 'Gujrat', 'India', 1234, 'billing'),
(6, 3, 1, 'Moti lakhavad,Rajkot,Vinchhiya', 'Vinchhiya', 'Gujrat', 'India', 123, 'shipping'),
(7, 1, 1, 'Moti lakhavad,Rajkot,Vinchhiya', 'Vinchhiya', 'Gujrat', 'India', 1234, 'billing'),
(8, 3, 1, 'Moti lakhavad,Rajkot,Vinchhiya', 'Vinchhiya', 'Gujrat', 'India', 123, 'shipping'),
(9, 1, 1, 'Moti lakhavad,Rajkot,Vinchhiya', 'Vinchhiya', 'Gujrat', 'India', 1234, 'billing'),
(10, 3, 1, 'Moti lakhavad,Rajkot,Vinchhiya', 'Vinchhiya', 'Gujrat', 'India', 123, 'shipping');

-- --------------------------------------------------------

--
-- Table structure for table `orderitem`
--

CREATE TABLE `orderitem` (
  `itemId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(16) NOT NULL,
  `price` decimal(32,2) NOT NULL,
  `discount` decimal(32,2) NOT NULL,
  `createddate` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderitem`
--

INSERT INTO `orderitem` (`itemId`, `productId`, `quantity`, `price`, `discount`, `createddate`) VALUES
(1, 2, 1, '5849.00', '1.00', '2021-04-06 00:00:00.000000'),
(2, 1, 1, '9459.00', '1.00', '2021-04-06 00:00:00.000000'),
(3, 4, 1, '4899.00', '3.00', '2021-04-06 00:00:00.000000'),
(4, 6, 1, '48989.00', '1.00', '2021-04-06 00:00:00.000000'),
(5, 2, 10, '5849.00', '1.00', '2021-04-11 00:00:00.000000'),
(6, 4, 9, '4899.00', '3.00', '2021-04-11 00:00:00.000000'),
(7, 8, 1, '32699.00', '3.00', '2021-04-11 00:00:00.000000'),
(8, 5, 1, '41324.00', '2.00', '2021-04-11 00:00:00.000000'),
(9, 3, 1, '10969.00', '2.00', '2021-04-11 00:00:00.000000'),
(10, 2, 1, '5849.00', '1.00', '2021-04-11 00:00:00.000000'),
(11, 2, 1, '5849.00', '1.00', '2021-04-11 00:00:00.000000'),
(12, 3, 1, '10969.00', '2.00', '2021-04-11 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `ordertable`
--

CREATE TABLE `ordertable` (
  `orderId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `paymentmethodId` int(11) NOT NULL,
  `shippingmethodId` int(11) NOT NULL,
  `shippingAmount` int(11) NOT NULL,
  `total` decimal(32,2) NOT NULL,
  `discount` decimal(32,2) NOT NULL,
  `createddate` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ordertable`
--

INSERT INTO `ordertable` (`orderId`, `customerId`, `paymentmethodId`, `shippingmethodId`, `shippingAmount`, `total`, `discount`, `createddate`) VALUES
(1, 1, 4, 3, 60, '19906.95', '300.05', '2021-04-06 00:00:00.000000'),
(2, 1, 2, 2, 70, '167792.60', '19780.40', '2021-04-11 00:00:00.000000'),
(3, 1, 2, 1, 100, '5790.51', '58.49', '2021-04-11 00:00:00.000000'),
(4, 1, 2, 2, 70, '5790.51', '58.49', '2021-04-11 00:00:00.000000'),
(5, 1, 3, 3, 60, '10749.62', '219.38', '2021-04-11 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentId` int(11) NOT NULL,
  `name` varchar(16) NOT NULL,
  `code` varchar(32) NOT NULL,
  `description` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createddate` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentId`, `name`, `code`, `description`, `status`, `createddate`) VALUES
(1, 'creadit card', '1256', 'card', 1, '2021-04-04 12:45:59.000000'),
(2, 'debit card', '1545', 'card', 1, '2021-04-04 12:46:03.000000'),
(3, 'bank', '995664', 'bank', 1, '2021-04-04 12:46:07.000000');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int(11) NOT NULL,
  `sku` varchar(16) NOT NULL,
  `name` varchar(32) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `quantity` int(10) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `createddate` datetime(6) NOT NULL,
  `updateddate` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `sku`, `name`, `price`, `discount`, `quantity`, `description`, `status`, `createddate`, `updateddate`) VALUES
(2, 's2', 'coffee table', '5849.00', '1.00', 40, 'abc', 1, '2021-04-09 18:36:10.000000', '2021-04-10 15:23:09.000000'),
(3, 's3', 'computer desk', '10969.00', '2.00', 20, 'a', 1, '2021-04-09 16:39:40.000000', '2021-04-11 12:33:35.000000'),
(4, 's4', 'hutch desks', '4899.00', '3.05', 30, 'abc', 1, '2021-04-09 19:02:37.000000', '2021-04-10 12:09:00.000000'),
(5, 's5', '3 seater sofas', '41324.00', '2.00', 30, 'ads', 1, '2021-04-08 14:02:41.000000', '2021-04-10 09:00:16.000000'),
(6, 's6', 'sofa bed', '48989.00', '1.00', 40, 'abc', 1, '2021-04-08 20:46:27.000000', '2021-04-10 06:48:16.000000'),
(7, 's7', '3 door wardrobe', '11156.00', '1.05', 20, 'abc', 1, '2021-04-09 12:47:37.000000', '2021-04-10 11:43:05.000000'),
(8, 's8', '6 seater dining table', '32699.00', '3.00', 20, 'abc', 1, '2021-04-07 16:24:14.000000', '2021-04-07 16:24:14.000000'),
(9, 's9', 'writing table', '7499.00', '1.00', 40, 'abc', 1, '2021-04-09 19:04:18.000000', '2021-04-09 19:04:18.000000'),
(11, 's1', 'sofa', '8999.00', '2.05', 50, 'abc', 1, '2021-04-08 15:39:48.000000', '2021-04-08 15:39:48.000000'),
(15, 's14', '4 beds', '20000.00', '2.01', 50, 'abc', 1, '2021-04-09 18:35:48.000000', '2021-04-09 18:35:48.000000'),
(17, 's15', 'almari', '4599.00', '1.55', 80, 'abc', 1, '2021-04-09 18:40:37.000000', '2021-04-09 18:40:37.000000');

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute`
--

CREATE TABLE `product_attribute` (
  `entityId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `attributeOptionId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_attribute`
--

INSERT INTO `product_attribute` (`entityId`, `productId`, `attributeOptionId`) VALUES
(1, 2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `product_group_price`
--

CREATE TABLE `product_group_price` (
  `entityId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `CustomerGroupId` int(11) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_group_price`
--

INSERT INTO `product_group_price` (`entityId`, `productId`, `CustomerGroupId`, `price`) VALUES
(4, 2, 1, '6000.00'),
(5, 2, 2, '5000.00'),
(6, 2, 3, '4500.00'),
(7, 2, 4, '6000.00'),
(8, 2, 5, '5400.00');

-- --------------------------------------------------------

--
-- Table structure for table `product_media`
--

CREATE TABLE `product_media` (
  `imageId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `label` varchar(10) NOT NULL,
  `small` tinyint(1) NOT NULL DEFAULT 0,
  `thumb` tinyint(1) NOT NULL DEFAULT 0,
  `base` tinyint(1) NOT NULL DEFAULT 0,
  `gallary` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_media`
--

INSERT INTO `product_media` (`imageId`, `productId`, `image`, `label`, `small`, `thumb`, `base`, `gallary`) VALUES
(4, 3, '7.jpg', '', 1, 0, 0, 0),
(18, 3, '5.jpg', '', 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `shippingId` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `code` varchar(16) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createddate` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`shippingId`, `name`, `code`, `amount`, `description`, `status`, `createddate`) VALUES
(1, 'AIR', '123', '100.00', 'a', 1, '0000-00-00 00:00:00.000000'),
(2, 'FEDEX', '789', '70.00', 'a', 1, '0000-00-00 00:00:00.000000'),
(3, 'RAIL', '456', '60.00', 'abc', 1, '0000-00-00 00:00:00.000000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminId`);

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
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartId`);

--
-- Indexes for table `cart_address`
--
ALTER TABLE `cart_address`
  ADD PRIMARY KEY (`cartAddressId`),
  ADD KEY `addressId` (`addressId`),
  ADD KEY `cart_address_ibfk_2` (`cartId`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`itemId`),
  ADD KEY `cart_item_ibfk_1` (`cartId`),
  ADD KEY `cart_item_ibfk_2` (`productId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`),
  ADD KEY `parentId` (`parentId`);

--
-- Indexes for table `cms_page`
--
ALTER TABLE `cms_page`
  ADD PRIMARY KEY (`pageId`),
  ADD UNIQUE KEY `key` (`identifier`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`configId`),
  ADD KEY `groupId` (`groupId`);

--
-- Indexes for table `config_group`
--
ALTER TABLE `config_group`
  ADD PRIMARY KEY (`groupId`),
  ADD KEY `groupId` (`groupId`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerId`),
  ADD KEY `groupId` (`groupId`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `customer_address_ibfk_1` (`customerId`);

--
-- Indexes for table `customer_group`
--
ALTER TABLE `customer_group`
  ADD PRIMARY KEY (`groupId`);

--
-- Indexes for table `orderaddress`
--
ALTER TABLE `orderaddress`
  ADD PRIMARY KEY (`orderAddressId`);

--
-- Indexes for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD PRIMARY KEY (`itemId`);

--
-- Indexes for table `ordertable`
--
ALTER TABLE `ordertable`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `product_attribute`
--
ALTER TABLE `product_attribute`
  ADD PRIMARY KEY (`entityId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `product_group_price`
--
ALTER TABLE `product_group_price`
  ADD PRIMARY KEY (`entityId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `product_media`
--
ALTER TABLE `product_media`
  ADD PRIMARY KEY (`imageId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`shippingId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `attribute`
--
ALTER TABLE `attribute`
  MODIFY `attributeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `attribute_option`
--
ALTER TABLE `attribute_option`
  MODIFY `optionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cart_address`
--
ALTER TABLE `cart_address`
  MODIFY `cartAddressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cms_page`
--
ALTER TABLE `cms_page`
  MODIFY `pageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `configId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `config_group`
--
ALTER TABLE `config_group`
  MODIFY `groupId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `customer_group`
--
ALTER TABLE `customer_group`
  MODIFY `groupId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orderaddress`
--
ALTER TABLE `orderaddress`
  MODIFY `orderAddressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orderitem`
--
ALTER TABLE `orderitem`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ordertable`
--
ALTER TABLE `ordertable`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `product_attribute`
--
ALTER TABLE `product_attribute`
  MODIFY `entityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_group_price`
--
ALTER TABLE `product_group_price`
  MODIFY `entityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_media`
--
ALTER TABLE `product_media`
  MODIFY `imageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `shippingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attribute_option`
--
ALTER TABLE `attribute_option`
  ADD CONSTRAINT `attribute_option_ibfk_1` FOREIGN KEY (`attributeId`) REFERENCES `attribute` (`attributeId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart_address`
--
ALTER TABLE `cart_address`
  ADD CONSTRAINT `cart_address_ibfk_2` FOREIGN KEY (`cartId`) REFERENCES `cart` (`cartId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_address_ibfk_3` FOREIGN KEY (`addressId`) REFERENCES `customer_address` (`addressId`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `cart_item_ibfk_1` FOREIGN KEY (`cartId`) REFERENCES `cart` (`cartId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_item_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD CONSTRAINT `customer_address_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_attribute`
--
ALTER TABLE `product_attribute`
  ADD CONSTRAINT `product_attribute_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_group_price`
--
ALTER TABLE `product_group_price`
  ADD CONSTRAINT `product_group_price_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_media`
--
ALTER TABLE `product_media`
  ADD CONSTRAINT `product_media_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
