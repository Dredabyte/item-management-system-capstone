-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2023 at 05:05 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imsc_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `backorder_items`
--

CREATE TABLE `backorder_items` (
  `bo_id` int(100) NOT NULL,
  `item_id` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `price` float NOT NULL DEFAULT 0,
  `unit` varchar(100) NOT NULL,
  `total` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `backorder_items`
--

INSERT INTO `backorder_items` (`bo_id`, `item_id`, `quantity`, `price`, `unit`, `total`) VALUES
(8, 10, 500, 500, 'boxes', 250000),
(9, 9, 500, 500, 'pcs', 250000),
(10, 10, 50, 500, 'boxes', 25000),
(11, 10, 5, 500, 'boxes', 2500),
(12, 9, 5, 500, 'pcs', 2500),
(13, 10, 5, 500, 'boxes', 2500),
(14, 10, 25, 500, 'boxes', 12500),
(15, 9, 5, 500, 'pcs', 2500),
(16, 10, 25, 500.5, 'boxes', 12512.5);

-- --------------------------------------------------------

--
-- Table structure for table `backorder_list`
--

CREATE TABLE `backorder_list` (
  `id` int(100) NOT NULL,
  `incoming_id` int(100) NOT NULL,
  `po_id` int(100) NOT NULL,
  `bo_code` varchar(100) NOT NULL,
  `supplier_id` int(100) NOT NULL,
  `amount` float NOT NULL,
  `discount_perc` float NOT NULL DEFAULT 0,
  `discount` float NOT NULL DEFAULT 0,
  `tax_perc` float NOT NULL DEFAULT 0,
  `tax` float NOT NULL DEFAULT 0,
  `remarks` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = pending, 1 = partially received, 2 =received',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `backorder_list`
--

INSERT INTO `backorder_list` (`id`, `incoming_id`, `po_id`, `bo_code`, `supplier_id`, `amount`, `discount_perc`, `discount`, `tax_perc`, `tax`, `remarks`, `status`, `date_created`, `date_updated`) VALUES
(8, 15, 10, 'BO-0001', 6, 250000, 0, 0, 0, 0, NULL, 2, '2023-08-16 11:34:39', '2023-08-16 11:35:30'),
(9, 17, 11, 'BO-0002', 5, 250000, 0, 0, 0, 0, NULL, 2, '2023-08-16 12:01:21', '2023-08-16 12:25:47'),
(10, 19, 12, 'BO-0003', 6, 25000, 0, 0, 0, 0, NULL, 2, '2023-08-16 12:29:52', '2023-08-16 12:32:47'),
(11, 21, 13, 'BO-0004', 6, 2500, 0, 0, 0, 0, NULL, 2, '2023-08-16 12:35:33', '2023-08-16 12:36:36'),
(12, 23, 16, 'BO-0005', 5, 2500, 0, 0, 0, 0, 'bo. partially receive', 2, '2023-08-16 12:49:52', '2023-08-16 12:50:51'),
(13, 25, 17, 'BO-0006', 6, 2500, 0, 0, 0, 0, 'sample ulit sa backorder. edited. bo', 2, '2023-08-16 23:08:54', '2023-08-16 23:10:37'),
(14, 27, 18, 'BO-0007', 6, 12500, 0, 0, 0, 0, 'po. partially receive. bo', 2, '2023-08-17 22:20:55', '2023-08-17 22:21:34'),
(15, 30, 21, 'BO-0008', 5, 2500, 0, 0, 0, 0, 'haha', 2, '2023-09-12 21:11:53', '2023-09-15 16:19:31'),
(16, 32, 22, 'BO-0009', 6, 12512.5, 0, 0, 0, 0, 'sample. partially receive', 2, '2023-09-15 16:21:01', '2023-09-15 16:21:39');

-- --------------------------------------------------------

--
-- Table structure for table `brand_list`
--

CREATE TABLE `brand_list` (
  `id` int(100) NOT NULL,
  `name` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = active, 0 = inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand_list`
--

INSERT INTO `brand_list` (`id`, `name`, `status`) VALUES
(3, 'Shimano', 1),
(4, 'Maxxis Tires', 1),
(6, 'aeldred', 1),
(7, 'jaja', 0),
(8, 'Mico Gacutan', 0),
(9, 'al', 0),
(10, 'Von Justine Caumeran ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category_list`
--

CREATE TABLE `category_list` (
  `id` int(100) NOT NULL,
  `name` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = active, 2 = inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_list`
--

INSERT INTO `category_list` (`id`, `name`, `status`) VALUES
(8, 'Tire', 1),
(9, 'Cogs', 1),
(10, 'Sample', 1);

-- --------------------------------------------------------

--
-- Table structure for table `incoming_list`
--

CREATE TABLE `incoming_list` (
  `id` int(100) NOT NULL,
  `form_id` int(100) NOT NULL,
  `from_order` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=PO ,2 = BO',
  `amount` float NOT NULL DEFAULT 0,
  `discount_perc` float NOT NULL DEFAULT 0,
  `discount` float NOT NULL DEFAULT 0,
  `tax_perc` float NOT NULL DEFAULT 0,
  `tax` float NOT NULL DEFAULT 0,
  `stock_ids` text DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `incoming_list`
--

INSERT INTO `incoming_list` (`id`, `form_id`, `from_order`, `amount`, `discount_perc`, `discount`, `tax_perc`, `tax`, `stock_ids`, `remarks`, `date_created`, `date_updated`) VALUES
(14, 9, 1, 500000, 0, 0, 0, 0, '36', 'sample success incoming p.o.', '2023-08-16 11:33:31', '2023-08-16 11:33:31'),
(15, 10, 1, 250000, 0, 0, 0, 0, '37', 'partially received. sample b.o.', '2023-08-16 11:34:38', '2023-08-16 11:34:39'),
(16, 8, 2, 250000, 0, 0, 0, 0, '38', 'revieved this date monthl/date/year', '2023-08-16 11:35:30', '2023-08-16 11:35:30'),
(17, 11, 1, 250000, 0, 0, 0, 0, '39', 'bo items sample', '2023-08-16 12:01:20', '2023-08-16 12:01:20'),
(18, 9, 2, 250000, 0, 0, 0, 0, '40', 'bo receive', '2023-08-16 12:25:46', '2023-08-16 12:25:46'),
(19, 12, 1, 25000, 0, 0, 0, 0, '41', 'partially received kay kulang', '2023-08-16 12:29:51', '2023-08-16 12:29:52'),
(20, 10, 2, 25000, 0, 0, 0, 0, '42', 'done bo', '2023-08-16 12:32:46', '2023-08-16 12:32:46'),
(21, 13, 1, 2500, 0, 0, 0, 0, '43', 'bo', '2023-08-16 12:35:33', '2023-08-16 12:35:33'),
(22, 11, 2, 2500, 0, 0, 0, 0, '44', 'bo', '2023-08-16 12:36:36', '2023-08-16 12:36:36'),
(23, 16, 1, 2500, 0, 0, 0, 0, '45', 'bo. partially receive', '2023-08-16 12:49:52', '2023-08-16 12:49:52'),
(24, 12, 2, 2500, 0, 0, 0, 0, '46', 'humana jud', '2023-08-16 12:50:50', '2023-08-16 12:50:50'),
(25, 17, 1, 2500, 0, 0, 0, 0, '47', 'sample ulit sa backorder. edited. bo', '2023-08-16 23:08:54', '2023-08-16 23:08:54'),
(26, 13, 2, 2500, 0, 0, 0, 0, '48', 'sample ulit sa backorder. edited. bo. received bo', '2023-08-16 23:10:37', '2023-08-16 23:10:37'),
(27, 18, 1, 12500, 0, 0, 0, 0, '49', 'po. partially receive. bo', '2023-08-17 22:20:55', '2023-08-17 22:20:55'),
(28, 14, 2, 12500, 0, 0, 0, 0, '50', 'po. partially receive. bo. receive bo. complete', '2023-08-17 22:21:33', '2023-08-17 22:21:33'),
(29, 20, 1, 50000, 0, 0, 0, 0, '51,52', 'try. shipped', '2023-09-12 21:09:43', '2023-09-12 21:09:43'),
(30, 21, 1, 2500, 0, 0, 0, 0, '53', 'haha', '2023-09-12 21:11:52', '2023-09-12 21:11:53'),
(31, 15, 2, 2500, 0, 0, 0, 0, '61', 'haha', '2023-09-15 16:19:30', '2023-09-15 16:19:31'),
(32, 22, 1, 12512.5, 0, 0, 0, 0, '62', 'sample. partially receive', '2023-09-15 16:21:00', '2023-09-15 16:21:01'),
(33, 16, 2, 12512.5, 0, 0, 0, 0, '63', 'sample. partially receive. receive bo', '2023-09-15 16:21:38', '2023-09-15 16:21:39');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_request_list`
--

CREATE TABLE `inventory_request_list` (
  `id` int(100) NOT NULL,
  `ir_code` varchar(100) NOT NULL,
  `users_id` int(100) NOT NULL,
  `amount` float NOT NULL DEFAULT 0,
  `remarks` text DEFAULT NULL,
  `ir_stock_ids` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory_request_list`
--

INSERT INTO `inventory_request_list` (`id`, `ir_code`, `users_id`, `amount`, `remarks`, `ir_stock_ids`, `date_created`, `date_updated`) VALUES
(3, 'Inventory Request-0001', 14, 250250, 'halooo', '28', '2023-09-15 22:33:47', '2023-09-15 22:33:47'),
(4, 'Inventory Request-0002', 14, 400250, 'sample napud', '29,30,31', '2023-09-15 22:41:17', '2023-09-15 22:41:18');

-- --------------------------------------------------------

--
-- Table structure for table `ir_stock_list`
--

CREATE TABLE `ir_stock_list` (
  `id` int(100) NOT NULL,
  `item_id` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `unit` varchar(250) DEFAULT NULL,
  `price` float NOT NULL DEFAULT 0,
  `total` float NOT NULL DEFAULT current_timestamp(),
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=listed',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ir_stock_list`
--

INSERT INTO `ir_stock_list` (`id`, `item_id`, `quantity`, `unit`, `price`, `total`, `type`, `date_created`) VALUES
(28, 10, 500, 'boxes', 500.5, 250250, 1, '2023-09-15 22:33:47'),
(29, 10, 500, 'boxes', 500.5, 250250, 1, '2023-09-15 22:41:18'),
(30, 11, 200, 'boxes', 500, 100000, 1, '2023-09-15 22:41:18'),
(31, 9, 100, 'pcs', 500, 50000, 1, '2023-09-15 22:41:18');

-- --------------------------------------------------------

--
-- Table structure for table `item_list`
--

CREATE TABLE `item_list` (
  `id` int(100) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `brand_id` int(100) NOT NULL,
  `category_id` int(100) NOT NULL,
  `supplier_id` int(100) NOT NULL,
  `cost` float NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = active, 2 = inactive',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_list`
--

INSERT INTO `item_list` (`id`, `name`, `description`, `brand_id`, `category_id`, `supplier_id`, `cost`, `status`, `date_created`, `date_updated`) VALUES
(9, 'Tire', 'Tire for mtb.', 3, 8, 5, 500, 1, '2023-08-16 11:28:48', '2023-08-16 11:28:48'),
(10, 'Cogs', 'Cogs for bike.', 3, 9, 6, 500.5, 1, '2023-08-16 11:29:20', '2023-09-12 22:20:53'),
(11, 'Frame', 'frame...', 3, 10, 6, 500, 1, '2023-09-07 12:47:59', '2023-09-07 12:47:59');

-- --------------------------------------------------------

--
-- Table structure for table `low_stock`
--

CREATE TABLE `low_stock` (
  `id` int(100) NOT NULL,
  `item_id` int(100) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `outgoing_list`
--

CREATE TABLE `outgoing_list` (
  `id` int(100) NOT NULL,
  `sales_code` varchar(100) NOT NULL,
  `requester_id` int(100) NOT NULL,
  `amount` float NOT NULL DEFAULT 0,
  `remarks` text DEFAULT NULL,
  `stock_ids` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `outgoing_list`
--

INSERT INTO `outgoing_list` (`id`, `sales_code`, `requester_id`, `amount`, `remarks`, `stock_ids`, `date_created`, `date_updated`) VALUES
(11, 'SALE-00011', 4, 500, 'test only', '20', '2023-07-19 21:05:26', '2023-07-19 21:05:26'),
(12, 'SALE-0001', 7, 30025, 'sample', '57,58', '2023-09-13 23:10:11', '2023-09-13 23:10:12'),
(13, 'SALE-0002', 8, 250000, 'sale na siya', '60', '2023-09-15 15:46:33', '2023-09-15 15:46:33'),
(14, 'SALE-0003', 8, 277625, 'sale na siya. updated', '66,67', '2023-09-15 16:23:01', '2023-09-15 19:17:56');

-- --------------------------------------------------------

--
-- Table structure for table `po_items`
--

CREATE TABLE `po_items` (
  `po_id` int(100) NOT NULL,
  `item_id` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `price` float NOT NULL DEFAULT 0,
  `unit` varchar(100) NOT NULL,
  `total` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `po_items`
--

INSERT INTO `po_items` (`po_id`, `item_id`, `quantity`, `price`, `unit`, `total`) VALUES
(9, 9, 1000, 500, 'pcs', 500000),
(10, 10, 1000, 500, 'boxes', 500000),
(11, 9, 1000, 500, 'pcs', 500000),
(12, 10, 100, 500, 'boxes', 50000),
(13, 10, 10, 500, 'boxes', 5000),
(16, 9, 10, 500, 'pcs', 5000),
(17, 10, 10, 500, 'boxes', 5000),
(18, 10, 50, 500, 'boxes', 25000),
(20, 10, 50, 500, 'boxes', 25000),
(20, 11, 50, 500, 'pcs', 25000),
(21, 9, 10, 500, 'pcs', 5000),
(22, 10, 50, 500.5, 'boxes', 25025);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_list`
--

CREATE TABLE `purchase_order_list` (
  `id` int(100) NOT NULL,
  `po_code` varchar(100) NOT NULL,
  `supplier_id` int(100) NOT NULL,
  `amount` float NOT NULL,
  `discount_perc` float NOT NULL DEFAULT 0,
  `discount` float NOT NULL DEFAULT 0,
  `tax_perc` float NOT NULL DEFAULT 0,
  `tax` float NOT NULL DEFAULT 0,
  `remarks` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = pending, 1 = partially received, 2 =received',
  `created_by` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_order_list`
--

INSERT INTO `purchase_order_list` (`id`, `po_code`, `supplier_id`, `amount`, `discount_perc`, `discount`, `tax_perc`, `tax`, `remarks`, `status`, `created_by`, `date_created`, `date_updated`) VALUES
(9, 'PO-0001', 5, 500000, 0, 0, 0, 0, 'sample success incoming p.o.', 2, '', '2023-08-16 11:32:45', '2023-08-16 11:33:31'),
(10, 'PO-0002', 6, 500000, 0, 0, 0, 0, 'partially received. sample b.o.', 2, '', '2023-08-16 11:34:20', '2023-08-16 11:35:30'),
(11, 'PO-0003', 5, 500000, 0, 0, 0, 0, 'bo items sample', 2, '', '2023-08-16 12:00:58', '2023-08-16 12:25:47'),
(12, 'PO-0004', 6, 50000, 0, 0, 0, 0, '', 2, '', '2023-08-16 12:29:19', '2023-08-16 12:32:46'),
(13, 'PO-0005', 6, 5000, 0, 0, 0, 0, 'bo', 2, '', '2023-08-16 12:35:11', '2023-08-16 12:36:36'),
(16, 'PO-0008', 5, 5000, 0, 0, 0, 0, 'bo', 2, '', '2023-08-16 12:38:59', '2023-08-16 12:50:51'),
(17, 'PO-0006', 6, 5000, 0, 0, 0, 0, 'sample ulit sa backorder. edited', 2, '', '2023-08-16 22:44:29', '2023-08-16 23:10:37'),
(18, 'PO-0007', 6, 25000, 0, 0, 0, 0, 'po.', 2, '', '2023-08-17 22:20:28', '2023-08-17 22:21:34'),
(20, 'PO-0009', 6, 50000, 0, 0, 0, 0, 'try', 2, '', '2023-09-12 21:08:00', '2023-09-12 21:09:44'),
(21, 'PO-0010', 5, 5000, 0, 0, 0, 0, 'haha', 2, '', '2023-09-12 21:11:30', '2023-09-15 16:19:31'),
(22, 'PO-0011', 6, 25025, 0, 0, 0, 0, 'sample', 2, '', '2023-09-15 16:20:21', '2023-09-15 16:21:39');

-- --------------------------------------------------------

--
-- Table structure for table `requester_list`
--

CREATE TABLE `requester_list` (
  `id` int(100) NOT NULL,
  `name` text NOT NULL,
  `address` text NOT NULL,
  `contact` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = active, 2 = inactive',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requester_list`
--

INSERT INTO `requester_list` (`id`, `name`, `address`, `contact`, `status`, `date_created`, `date_updated`) VALUES
(4, 'Pido Tañahura', 'Purok 4 Sta. Elena Iligan City', 'fb.com/Pido', 1, '2023-07-15 20:04:49', '2023-09-15 15:45:14'),
(6, 'Mico Gacutan', 'Bayanihan Village, Sta. Elena, Iligan City', 'fb.me/mhico', 1, '2023-07-15 20:13:10', '2023-07-15 20:13:10'),
(7, 'Von Justine Caumeran ', 'Steeltown, Sta. Elena, Iligan City', 'fb.me/justine', 1, '2023-07-15 20:13:41', '2023-07-15 20:13:41'),
(8, 'Aeldred John Y. Tañahura', 'Purok 4, Sta. Elena, Iligan City, 9200, Lanao del Norte', '09159056977', 1, '2023-07-15 20:14:28', '2023-07-15 20:14:28'),
(9, 'Tire', 'asdasd', 'asdasdasd', 1, '2023-07-17 20:14:41', '2023-07-17 20:14:41');

-- --------------------------------------------------------

--
-- Table structure for table `return_list_requester`
--

CREATE TABLE `return_list_requester` (
  `id` int(100) NOT NULL,
  `return_code` varchar(100) NOT NULL,
  `requester_id` int(100) NOT NULL,
  `amount` float NOT NULL DEFAULT 0,
  `remarks` text DEFAULT NULL,
  `stock_ids` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `return_list_supplier`
--

CREATE TABLE `return_list_supplier` (
  `id` int(100) NOT NULL,
  `return_code` varchar(100) NOT NULL,
  `supplier_id` int(100) NOT NULL,
  `amount` float NOT NULL DEFAULT 0,
  `remarks` text DEFAULT NULL,
  `stock_ids` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `return_list_supplier`
--

INSERT INTO `return_list_supplier` (`id`, `return_code`, `supplier_id`, `amount`, `remarks`, `stock_ids`, `date_created`, `date_updated`) VALUES
(4, 'R-0001', 6, 110110, 'return list sup', '56', '2023-09-13 19:57:02', '2023-09-13 19:57:03'),
(5, 'R-0002', 5, 7500, 'sample lang ni sya', '59', '2023-09-15 15:43:31', '2023-09-15 15:43:31'),
(6, 'R-0003', 6, 125125, 'balik kana', '65', '2023-09-15 16:23:52', '2023-09-15 16:23:53');

-- --------------------------------------------------------

--
-- Table structure for table `stock_list`
--

CREATE TABLE `stock_list` (
  `id` int(100) NOT NULL,
  `item_id` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `unit` varchar(250) DEFAULT NULL,
  `price` float NOT NULL DEFAULT 0,
  `total` float NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=IN , 2=OUT 3=ir',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_list`
--

INSERT INTO `stock_list` (`id`, `item_id`, `quantity`, `unit`, `price`, `total`, `type`, `date_created`) VALUES
(36, 9, 1000, 'pcs', 500, 500000, 1, '2023-08-16 11:33:31'),
(37, 10, 500, 'boxes', 500, 250000, 1, '2023-08-16 11:34:38'),
(38, 10, 500, 'boxes', 500, 250000, 1, '2023-08-16 11:35:30'),
(39, 9, 500, 'pcs', 500, 250000, 1, '2023-08-16 12:01:20'),
(40, 9, 500, 'pcs', 500, 250000, 1, '2023-08-16 12:25:46'),
(41, 10, 50, 'boxes', 500, 25000, 1, '2023-08-16 12:29:51'),
(42, 10, 50, 'boxes', 500, 25000, 1, '2023-08-16 12:32:46'),
(43, 10, 5, 'boxes', 500, 2500, 1, '2023-08-16 12:35:33'),
(44, 10, 5, 'boxes', 500, 2500, 1, '2023-08-16 12:36:36'),
(45, 9, 5, 'pcs', 500, 2500, 1, '2023-08-16 12:49:52'),
(46, 9, 5, 'pcs', 500, 2500, 1, '2023-08-16 12:50:50'),
(47, 10, 5, 'boxes', 500, 2500, 1, '2023-08-16 23:08:54'),
(48, 10, 5, 'boxes', 500, 2500, 1, '2023-08-16 23:10:37'),
(49, 10, 25, 'boxes', 500, 12500, 1, '2023-08-17 22:20:55'),
(50, 10, 25, 'boxes', 500, 12500, 1, '2023-08-17 22:21:33'),
(51, 10, 50, 'boxes', 500, 25000, 1, '2023-09-12 21:09:43'),
(52, 11, 50, 'pcs', 500, 25000, 1, '2023-09-12 21:09:43'),
(53, 9, 5, 'pcs', 500, 2500, 1, '2023-09-12 21:11:52'),
(56, 10, 220, 'pcs', 500.5, 110110, 2, '2023-09-13 19:57:03'),
(57, 11, 10, 'boxes', 500, 5000, 2, '2023-09-13 23:10:11'),
(58, 10, 50, 'pcs', 500.5, 25025, 2, '2023-09-13 23:10:12'),
(59, 9, 15, 'pcs', 500, 7500, 2, '2023-09-15 15:43:31'),
(60, 9, 500, 'pcs', 500, 250000, 2, '2023-09-15 15:46:33'),
(61, 9, 5, 'pcs', 500, 2500, 1, '2023-09-15 16:19:31'),
(62, 10, 25, 'boxes', 500.5, 12512.5, 1, '2023-09-15 16:21:00'),
(63, 10, 25, 'boxes', 500.5, 12512.5, 1, '2023-09-15 16:21:39'),
(65, 10, 250, 'boxes', 500.5, 125125, 2, '2023-09-15 16:23:52'),
(66, 10, 250, 'boxes', 500.5, 125125, 2, '2023-09-15 19:17:55'),
(67, 9, 305, 'pcs', 500, 152500, 2, '2023-09-15 19:17:56');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_list`
--

CREATE TABLE `supplier_list` (
  `id` int(100) NOT NULL,
  `name` text NOT NULL,
  `address` text NOT NULL,
  `contact` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = active, 2 = inactive',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier_list`
--

INSERT INTO `supplier_list` (`id`, `name`, `address`, `contact`, `status`, `date_created`, `date_updated`) VALUES
(5, 'Mico Gacutan', 'Bayanihan Village Iligan City', '221-2121', 1, '2023-07-15 17:50:21', '2023-07-20 22:07:04'),
(6, 'Von Justine Caumeran ', 'Steeltown, Sta. Elena, Iligan City', 'justine@gmail.com', 1, '2023-07-15 17:51:09', '2023-08-15 13:55:48'),
(9, 'Naruto', 'Konoha', 'fb.me/naruto', 0, '2023-07-15 20:10:59', '2023-07-15 20:18:06'),
(10, 'Saturo Gojo', 'Kimitsu no Yaiba', 'fb.me/gojo', 0, '2023-07-15 20:11:49', '2023-07-18 18:56:51'),
(11, 'Gusion', 'Land of Dawn', 'fb.me/gusion', 1, '2023-07-15 20:12:27', '2023-07-15 20:12:27'),
(12, 'janjan 2', 'purok 4 sta. elena iligan city', 'justine@gmail.com', 1, '2023-07-17 00:47:37', '2023-08-15 13:54:10');

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(100) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(16, 'name', 'Item Management System | Capstone Project'),
(17, 'short_name', 'IMS - Capstone Project'),
(18, 'logo', 'uploads/logo-1693842035.png'),
(19, 'cover', 'uploads/cover-1693838060.gif');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `role` varchar(250) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 = admin, 2 = staff',
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `role`, `email`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'Admin', 'admin', 'Administrator', 'admin', 'Admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'uploads/avatar-1.png?v=1689320020', NULL, 1, '2023-07-03 23:23:33', '2023-07-14 15:33:40'),
(14, 'Aeldred Johny', 'Yosores', 'Tañahura', 'Dredabyte', 'Manager', 'aeldredjohn.tanahura@gmail.com', '59771479da5a928009179e37f3482e45', 'uploads/avatar-14.png?v=1689319553', NULL, 1, '2023-07-14 15:25:50', '2023-09-12 17:38:04'),
(15, 'Mico', 'Sumile', 'Gacutan', 'mhico101', 'Admin 1', 'mico.gacutan@gmail.com', '9253f9a52f909339c449d1dee79cc6b9', 'uploads/avatar-15.png?v=1689319717', NULL, 1, '2023-07-14 15:28:36', '2023-09-11 18:14:19'),
(19, 'Von Justine', 'Ruiz', 'Caumeran', 'youngjus', 'Employee', 'vonjustine@gmail.com', '3b344e6292d52b7d817a854643cc35d2', 'uploads/avatar-19.png?v=1689322908', NULL, 2, '2023-07-14 16:21:48', '2023-07-14 16:21:48'),
(20, 'example', 'example', 'example', 'example', 'example', 'example@gmail.com', '1a79a4d60de6718e8e5b326e338ae533', 'uploads/avatar-20.png?v=1694509053', NULL, 1, '2023-09-12 16:57:33', '2023-09-12 16:57:33');

-- --------------------------------------------------------

--
-- Table structure for table `user_meta`
--

CREATE TABLE `user_meta` (
  `user_id` int(100) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `backorder_items`
--
ALTER TABLE `backorder_items`
  ADD KEY `item_id` (`item_id`),
  ADD KEY `bo_id` (`bo_id`);

--
-- Indexes for table `backorder_list`
--
ALTER TABLE `backorder_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `po_id` (`po_id`),
  ADD KEY `incoming_id` (`incoming_id`);

--
-- Indexes for table `brand_list`
--
ALTER TABLE `brand_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_list`
--
ALTER TABLE `category_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incoming_list`
--
ALTER TABLE `incoming_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_request_list`
--
ALTER TABLE `inventory_request_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `ir_stock_list`
--
ALTER TABLE `ir_stock_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `item_list`
--
ALTER TABLE `item_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `low_stock`
--
ALTER TABLE `low_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `outgoing_list`
--
ALTER TABLE `outgoing_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requester_id` (`requester_id`);

--
-- Indexes for table `po_items`
--
ALTER TABLE `po_items`
  ADD KEY `po_id` (`po_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `purchase_order_list`
--
ALTER TABLE `purchase_order_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `requester_list`
--
ALTER TABLE `requester_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `return_list_requester`
--
ALTER TABLE `return_list_requester`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requester_id` (`requester_id`);

--
-- Indexes for table `return_list_supplier`
--
ALTER TABLE `return_list_supplier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `stock_list`
--
ALTER TABLE `stock_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `supplier_list`
--
ALTER TABLE `supplier_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_meta`
--
ALTER TABLE `user_meta`
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `backorder_list`
--
ALTER TABLE `backorder_list`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `brand_list`
--
ALTER TABLE `brand_list`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `category_list`
--
ALTER TABLE `category_list`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `incoming_list`
--
ALTER TABLE `incoming_list`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `inventory_request_list`
--
ALTER TABLE `inventory_request_list`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ir_stock_list`
--
ALTER TABLE `ir_stock_list`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `item_list`
--
ALTER TABLE `item_list`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `outgoing_list`
--
ALTER TABLE `outgoing_list`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `purchase_order_list`
--
ALTER TABLE `purchase_order_list`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `requester_list`
--
ALTER TABLE `requester_list`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `return_list_requester`
--
ALTER TABLE `return_list_requester`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `return_list_supplier`
--
ALTER TABLE `return_list_supplier`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stock_list`
--
ALTER TABLE `stock_list`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `supplier_list`
--
ALTER TABLE `supplier_list`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `backorder_items`
--
ALTER TABLE `backorder_items`
  ADD CONSTRAINT `backorder_items_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `backorder_items_ibfk_2` FOREIGN KEY (`bo_id`) REFERENCES `backorder_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `backorder_list`
--
ALTER TABLE `backorder_list`
  ADD CONSTRAINT `backorder_list_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `backorder_list_ibfk_2` FOREIGN KEY (`po_id`) REFERENCES `purchase_order_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `backorder_list_ibfk_3` FOREIGN KEY (`incoming_id`) REFERENCES `incoming_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `inventory_request_list`
--
ALTER TABLE `inventory_request_list`
  ADD CONSTRAINT `inventory_request_list_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ir_stock_list`
--
ALTER TABLE `ir_stock_list`
  ADD CONSTRAINT `ir_stock_list_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `item_list`
--
ALTER TABLE `item_list`
  ADD CONSTRAINT `item_list_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `item_list_infk_2` FOREIGN KEY (`brand_id`) REFERENCES `brand_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `item_list_infk_3` FOREIGN KEY (`category_id`) REFERENCES `category_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `outgoing_list`
--
ALTER TABLE `outgoing_list`
  ADD CONSTRAINT `outgoing_list_ibfk_1` FOREIGN KEY (`requester_id`) REFERENCES `requester_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `po_items`
--
ALTER TABLE `po_items`
  ADD CONSTRAINT `po_items_ibfk_1` FOREIGN KEY (`po_id`) REFERENCES `purchase_order_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `po_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `item_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_order_list`
--
ALTER TABLE `purchase_order_list`
  ADD CONSTRAINT `purchase_order_list_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `return_list_requester`
--
ALTER TABLE `return_list_requester`
  ADD CONSTRAINT `return_list_requester_ibfk_1` FOREIGN KEY (`requester_id`) REFERENCES `requester_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `return_list_supplier`
--
ALTER TABLE `return_list_supplier`
  ADD CONSTRAINT `return_list_supplier_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_list`
--
ALTER TABLE `stock_list`
  ADD CONSTRAINT `stock_list_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item_list` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
