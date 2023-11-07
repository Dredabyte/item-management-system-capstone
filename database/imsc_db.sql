-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2023 at 03:14 PM
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
(18, 17, 20, 250.5, 'pcs', 5010),
(18, 22, 40, 2500, 'boxes', 100000),
(18, 23, 25, 100, 'boxes', 2500),
(19, 15, 150, 2000, 'boxes', 300000),
(19, 18, 50, 300, 'pcs', 15000),
(19, 30, 300, 2450, 'boxes', 735000),
(20, 22, 100, 2500, 'boxes', 250000);

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
(18, 41, 30, 'BO-0001', 5, 107510, 0, 0, 0, 0, 'expected to deliver by next month. partial', 2, '2023-10-05 23:32:42', '2023-10-05 23:34:15'),
(19, 42, 29, 'BO-0002', 12, 1050000, 0, 0, 0, 0, 'expected to shipped by 3rd week. partial', 2, '2023-10-05 23:33:39', '2023-10-05 23:33:58'),
(20, 53, 40, 'BO-0003', 5, 250000, 0, 0, 0, 0, 'partially received', 0, '2023-10-11 14:31:44', '2023-10-11 14:31:44');

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
(4, 'Maxxis', 1),
(12, 'Campagnolo', 1),
(13, ' Fox Factory', 1),
(14, ' GARMIN', 1),
(15, 'Cannondale', 1),
(16, 'Mavic', 1),
(17, 'Trek Bicycle Corporation', 1),
(18, 'Topeak', 1),
(19, 'SRAM', 1),
(20, 'Specialized', 1),
(21, 'DT Swiss', 1),
(22, 'Lezyne', 1),
(23, 'Crankbrothers', 1),
(24, ' Cinelli', 1),
(25, 'CushCore', 1),
(26, 'Breezer', 1),
(27, 'Schwalbe', 1),
(28, 'Continental', 1),
(29, 'Bontrager', 1),
(30, 'RockShox', 1),
(31, 'Norco Bicycles', 1),
(32, 'Truvativ', 1),
(33, 'Alpinestars', 1),
(34, 'Ragusa', 1),
(35, 'Sagmit', 1);

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
(8, 'Chainrings', 1),
(9, 'Cassettes / Cogs', 1),
(11, 'Derailleurs', 1),
(12, 'Cranks', 1),
(13, 'Bottom Brackets', 1),
(14, 'Chains', 1),
(15, 'Shifters', 1),
(16, 'Disc Brakes', 1),
(17, 'Rim Brakes', 1),
(18, 'Tires', 1),
(19, 'Tubes', 1),
(20, 'Tire Sealant', 1),
(21, 'Patch Kit & Repair', 1),
(22, 'Spokes', 1),
(23, 'Rims', 1),
(24, 'Handlebars', 1),
(25, 'Handlebar Tape', 1),
(26, 'Aero Bars, Parts, Lever', 1),
(27, 'Grips', 1),
(28, 'Handlebar Sizers', 1),
(29, 'Bar Ends', 1),
(30, 'Stems', 1),
(31, 'Stems - Adaptors', 1),
(32, 'Seatposts', 1),
(33, 'Seatpost Clamps', 1),
(34, 'Dropper Posts', 1),
(35, 'Saddles', 1),
(36, 'Pedals', 1),
(37, 'Cleats pedal', 1),
(38, 'Frames', 1),
(39, 'Derailleur Hangers', 1),
(40, 'Group Sets', 1),
(41, 'Forks -Suspension', 1),
(42, 'Forks - Rigid', 1),
(43, 'Frame Shocks', 1),
(44, 'Headsets', 1),
(45, 'Cables and Housing', 1),
(46, 'Hubs', 1),
(47, 'Skewers', 1),
(48, 'Bearings', 1);

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
(40, 31, 1, 1337460, 0, 0, 0, 0, '82,83,84,85,86,87,88,89', 'shipped by first week', '2023-10-05 23:29:43', '2023-10-05 23:29:44'),
(41, 30, 1, 226515, 0, 0, 0, 0, '90,91,92,93,94', 'expected to deliver by next month. partial', '2023-10-05 23:32:41', '2023-10-05 23:32:42'),
(42, 29, 1, 2240120, 0, 0, 0, 0, '95,96,97,98,99,100,101', 'expected to shipped by 3rd week. partial', '2023-10-05 23:33:38', '2023-10-05 23:33:39'),
(43, 19, 2, 1050000, 0, 0, 0, 0, '102,103,104', 'expected to shipped by 3rd week. partial', '2023-10-05 23:33:58', '2023-10-05 23:33:58'),
(44, 18, 2, 107510, 0, 0, 0, 0, '105,106,107', 'expected to deliver by next month. partial', '2023-10-05 23:34:13', '2023-10-05 23:34:14'),
(45, 32, 1, 500000, 0, 0, 0, 0, '108', '', '2023-10-06 00:17:46', '2023-10-06 00:17:46'),
(46, 39, 1, 15000, 0, 0, 0, 0, '109', '', '2023-10-06 22:10:56', '2023-10-06 22:10:56'),
(47, 38, 1, 37500, 0, 0, 0, 0, '110', '', '2023-10-06 22:11:12', '2023-10-06 22:11:13'),
(48, 37, 1, 20000, 0, 0, 0, 0, '111', '', '2023-10-06 22:11:31', '2023-10-06 22:11:31'),
(49, 36, 1, 9000, 0, 0, 0, 0, '112', '', '2023-10-06 22:11:45', '2023-10-06 22:11:45'),
(50, 35, 1, 169050, 0, 0, 0, 0, '113', '', '2023-10-06 22:12:00', '2023-10-06 22:12:00'),
(51, 34, 1, 6262.5, 0, 0, 0, 0, '114', '', '2023-10-06 22:12:14', '2023-10-06 22:12:14'),
(52, 33, 1, 125000, 0, 0, 0, 0, '115', '', '2023-10-06 22:12:26', '2023-10-06 22:12:27'),
(53, 40, 1, 250000, 0, 0, 0, 0, '118', 'partially received', '2023-10-11 14:31:44', '2023-10-11 14:31:44');

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
(8, 'Inventory Request-0001', 14, 2280320, 'initial items to buy.', '110,111,112,113,114,115,116', '2023-10-05 23:12:53', '2023-10-05 23:14:50'),
(9, 'Inventory Request-0002', 1, 1395280, 'test', '117,118,119,120,121,122,123,124,125,126,127,128,129,130', '2023-10-28 20:30:52', '2023-10-28 20:30:53');

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
(110, 34, 500, 'pcs', 2000, 1000000, 1, '2023-10-05 23:14:49'),
(111, 33, 250, 'pcs', 1799, 449750, 1, '2023-10-05 23:14:49'),
(112, 27, 300, 'pcs', 1000.5, 300150, 1, '2023-10-05 23:14:49'),
(113, 15, 50, 'boxes', 2000, 100000, 1, '2023-10-05 23:14:49'),
(114, 17, 600, 'pcs', 250.5, 150300, 1, '2023-10-05 23:14:50'),
(115, 23, 300, 'pcs', 100, 30000, 1, '2023-10-05 23:14:50'),
(116, 19, 250, 'boxes', 1000.5, 250125, 1, '2023-10-05 23:14:50'),
(117, 27, 10, 'boxes', 1000.5, 10005, 1, '2023-10-28 20:30:52'),
(118, 15, 50, 'boxes', 2000, 100000, 1, '2023-10-28 20:30:52'),
(119, 17, 500, 'boxes', 250.5, 125250, 1, '2023-10-28 20:30:52'),
(120, 29, 500, 'pcs', 1500, 750000, 1, '2023-10-28 20:30:52'),
(121, 24, 10, 'boxes', 1500, 15000, 1, '2023-10-28 20:30:53'),
(122, 25, 50, 'boxes', 2500, 125000, 1, '2023-10-28 20:30:53'),
(123, 26, 10, 'pcs', 3000, 30000, 1, '2023-10-28 20:30:53'),
(124, 23, 5, 'pcs', 100, 500, 1, '2023-10-28 20:30:53'),
(125, 20, 40, 'boxes', 1500, 60000, 1, '2023-10-28 20:30:53'),
(126, 21, 50, 'boxes', 2500.5, 125025, 1, '2023-10-28 20:30:53'),
(127, 31, 10, 'pcs', 900, 9000, 1, '2023-10-28 20:30:53'),
(128, 33, 5, 'pcs', 1799, 8995, 1, '2023-10-28 20:30:53'),
(129, 32, 5, 'pcs', 1300, 6500, 1, '2023-10-28 20:30:53'),
(130, 34, 15, 'pcs', 2000, 30000, 1, '2023-10-28 20:30:53');

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
  `image` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = active, 2 = inactive',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_list`
--

INSERT INTO `item_list` (`id`, `name`, `description`, `brand_id`, `category_id`, `supplier_id`, `cost`, `image`, `status`, `date_created`, `date_updated`) VALUES
(15, 'Cassettes', '7-12 speed cassette or cluster is the set of multiple sprockets that attaches to the hub on the rear wheel ', 3, 9, 12, 2000, 'item_image/item_image-6541ce0a4ce71.png?v=1698811402', 0, '2023-10-04 20:42:20', '2023-11-01 12:03:22'),
(16, 'Cassettes', '13 speed - cassette or cluster is the set of multiple sprockets that attaches to the hub on the rear wheel.', 19, 9, 6, 2500, 'item_image/item_image-6541ce25b2fc3.png?v=1698811430', 1, '2023-10-04 20:44:03', '2023-11-01 12:03:50'),
(17, 'Chainrings', '32t - 52t a toothed wheel transmitting power by means of a chain fitted to its edges.', 3, 8, 5, 250.5, 'item_image/item_image-6541ce53e80e8.png?v=1698811476', 1, '2023-10-04 20:46:55', '2023-11-01 12:04:36'),
(18, 'Chainrings', '32t - 52t -a toothed wheel transmitting power by means of a chain fitted to its edges.', 19, 8, 12, 300, 'item_image/item_image-6541ce3cdccaa.png?v=1698811453', 1, '2023-10-04 20:47:41', '2023-11-01 12:04:13'),
(19, 'Derailleurs -front', '3s - a type of bicycle gear that works by moving the bicycle chain from one sprocket wheel (= a wheel with a row of tooth-like parts) to another', 3, 11, 6, 1000.5, 'item_image/item_image-6541cfd880120.png?v=1698811864', 1, '2023-10-04 20:49:48', '2023-11-01 12:11:04'),
(20, 'Derailleurs - front', '1s - a type of bicycle gear that works by moving the bicycle chain from one sprocket wheel (= a wheel with a row of tooth-like parts) to another', 19, 11, 12, 1500, 'item_image/item_image-6541cefe70884.png?v=1698811646', 1, '2023-10-04 20:50:48', '2023-11-01 12:07:26'),
(21, 'Derailleurs - rear', '7 - 12s -  a type of bicycle gear that works by moving the bicycle chain from one sprocket wheel (= a wheel with a row of tooth-like parts) to another', 3, 11, 6, 2500.5, 'item_image/item_image-6541cfb5d9978.png?v=1698811830', 1, '2023-10-04 20:51:55', '2023-11-01 12:10:30'),
(22, 'Derailleurs - rear', '7s - a type of bicycle gear that works by moving the bicycle chain from one sprocket wheel (= a wheel with a row of tooth-like parts) to another', 19, 11, 5, 2500, 'item_image/item_image-6541cf9b4b32a.png?v=1698811803', 1, '2023-10-04 20:52:40', '2023-11-01 12:10:03'),
(23, 'Derailleur Hanger', 'a sacrificial part designed to bend or break in an impact, protecting the rear derailleur or frame', 19, 39, 5, 100, 'item_image/item_image-6541cee6be903.png?v=1698811623', 1, '2023-10-04 20:54:04', '2023-11-01 12:07:03'),
(24, 'Crank', 'made up of one or more gears, called chainrings, and the cranks or crankarms -- the arm-like parts that the pedals attach to. ', 35, 12, 5, 1500, 'item_image/item_image-6541d4849db74.png?v=1698813061', 1, '2023-10-04 20:58:06', '2023-11-01 12:31:01'),
(25, 'Crank', 'made up of one or more gears, called chainrings, and the cranks or crankarms -- the arm-like parts that the pedals attach to. ', 3, 12, 12, 2500, 'item_image/item_image-6541d470aa706.png?v=1698813041', 1, '2023-10-04 20:59:17', '2023-11-01 12:30:41'),
(26, 'Crank', 'made up of one or more gears, called chainrings, and the cranks or crankarms -- the arm-like parts that the pedals attach to. ', 19, 12, 6, 3000, 'item_image/item_image-6541d496574e2.png?v=1698813078', 1, '2023-10-04 20:59:46', '2023-11-01 12:31:18'),
(27, 'Bottom Brackets', 'connects the crankset (chainset) to the bicycle and allows the crankset to rotate freely.', 35, 13, 12, 1000.5, 'item_image/item_image-6541cddf84e63.png?v=1698811360', 1, '2023-10-04 21:01:33', '2023-11-01 12:02:40'),
(28, 'Bottom Brackets', 'connects the crankset (chainset) to the bicycle and allows the crankset to rotate freely.', 3, 13, 6, 3000, 'item_image/item_image-6541cdf74e46f.png?v=1698811383', 1, '2023-10-04 21:02:04', '2023-11-01 12:03:03'),
(29, 'Chains', '7 - 12 s - a roller chain that transfers power from the pedals to the drive-wheel of a bicycle, thus propelling it.', 3, 14, 6, 1500, 'item_image/item_image-6541ce8403b66.png?v=1698811524', 1, '2023-10-04 21:03:42', '2023-11-01 12:05:24'),
(30, 'Chains', '12s - a roller chain that transfers power from the pedals to the drive-wheel of a bicycle, thus propelling it.', 3, 14, 12, 2450, 'item_image/item_image-6541ce6e615e7.png?v=1698811502', 1, '2023-10-04 21:05:51', '2023-11-01 12:05:02'),
(31, 'Shifters - L', '2 - 3s -  a component used to control the gearing mechanisms and select the desired gear ratio.', 3, 15, 12, 900, 'item_image/item_image-653f69bcc98ae.png?v=1698654652', 1, '2023-10-04 21:08:10', '2023-10-30 16:30:52'),
(32, 'Shifters - R', 'a component used to control the gearing mechanisms and select the desired gear ratio.', 3, 15, 5, 1300, 'item_image/item_image-6541d0acd7ca1.png?v=1698812077', 1, '2023-10-04 21:08:48', '2023-11-01 12:14:37'),
(33, 'Shifters - L', 'a component used to control the gearing mechanisms and select the desired gear ratio.', 19, 15, 6, 1799, 'item_image/item_image-6541d04b5b37e.png?v=1698811979', 1, '2023-10-04 21:09:44', '2023-11-01 12:12:59'),
(34, 'Shifters - R', '7 - 12 speed - a component used to control the gearing mechanisms and select the desired gear ratio.', 19, 15, 6, 2000, 'item_image/item_image-6541d0d313a74.png?v=1698812115', 1, '2023-10-04 21:10:27', '2023-11-01 12:15:15'),
(46, 'Tire - Maxxis', 'durable tire that can last longer number 1 brand Maxxis', 4, 18, 12, 1499, 'item_image/item_image-653f42092586a.png', 1, '2023-10-30 13:41:29', '2023-10-30 13:42:43');

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
(18, 'SALE-0001', 6, 50025, '', '116', '2023-10-06 22:18:24', '2023-10-06 22:18:24'),
(19, 'SALE-0002', 8, 5002.5, '', '117', '2023-10-11 14:00:38', '2023-10-11 14:00:38'),
(20, 'SALE-0003', 4, 620000, '', '120,121', '2023-11-01 21:19:55', '2023-11-01 21:19:55'),
(21, 'SALE-0004', 7, 103500, '', '122', '2023-11-01 21:50:23', '2023-11-01 21:50:24'),
(22, 'SALE-0005', 6, 169050, '', '123', '2023-11-01 22:04:36', '2023-11-01 22:04:36'),
(23, 'SALE-0006', 4, 250000, '', '124', '2023-11-01 22:07:39', '2023-11-01 22:07:40');

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
(29, 15, 250, 2000, 'boxes', 500000),
(29, 18, 300, 300, 'pcs', 90000),
(29, 20, 100, 1500, 'boxes', 150000),
(29, 25, 100, 2500, 'boxes', 250000),
(29, 27, 250, 1000.5, 'boxes', 250125),
(29, 30, 800, 2450, 'boxes', 1960000),
(29, 31, 100, 900, 'boxes', 90000),
(30, 17, 50, 250.5, 'pcs', 12525),
(30, 22, 80, 2500, 'boxes', 200000),
(30, 23, 75, 100, 'boxes', 7500),
(30, 24, 50, 1500, 'boxes', 75000),
(30, 32, 30, 1300, 'boxes', 39000),
(31, 16, 25, 2500, 'boxes', 62500),
(31, 19, 30, 1000.5, 'boxes', 30015),
(31, 21, 30, 2500.5, 'boxes', 75015),
(31, 26, 20, 3000, 'boxes', 60000),
(31, 28, 25, 3000, 'boxes', 75000),
(31, 29, 500, 1500, 'pcs', 750000),
(31, 33, 75, 1799, 'pcs', 134925),
(31, 34, 75, 2000, 'pcs', 150000),
(32, 16, 200, 2500, 'boxes', 500000),
(33, 25, 50, 2500, 'boxes', 125000),
(34, 17, 25, 250.5, 'pcs', 6262.5),
(35, 30, 69, 2450, 'pcs', 169050),
(36, 31, 10, 900, 'pcs', 9000),
(37, 34, 10, 2000, 'pcs', 20000),
(38, 22, 15, 2500, 'boxes', 37500),
(39, 20, 10, 1500, 'boxes', 15000),
(40, 22, 200, 2500, 'boxes', 500000);

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
(29, 'PO-0001', 12, 3290120, 0, 0, 0, 0, 'expected to shipped by 3rd week', 2, '', '2023-10-05 23:21:45', '2023-10-05 23:33:58'),
(30, 'PO-0002', 5, 334025, 0, 0, 0, 0, 'expected to deliver by next month', 2, '', '2023-10-05 23:24:42', '2023-10-05 23:34:14'),
(31, 'PO-0003', 6, 1337460, 0, 0, 0, 0, 'shipped by first week', 2, '', '2023-10-05 23:26:52', '2023-10-05 23:29:44'),
(32, 'PO-0004', 6, 500000, 0, 0, 0, 0, '', 2, '', '2023-10-06 00:17:25', '2023-10-06 00:17:47'),
(33, 'PO-0005', 12, 125000, 0, 0, 0, 0, '', 2, '', '2023-10-06 22:07:55', '2023-10-06 22:12:27'),
(34, 'PO-0006', 5, 6262.5, 0, 0, 0, 0, '', 2, '', '2023-10-06 22:08:24', '2023-10-06 22:12:14'),
(35, 'PO-0007', 12, 169050, 0, 0, 0, 0, '', 2, '', '2023-10-06 22:08:57', '2023-10-06 22:12:00'),
(36, 'PO-0008', 12, 9000, 0, 0, 0, 0, '', 2, '', '2023-10-06 22:09:20', '2023-10-06 22:11:45'),
(37, 'PO-0009', 6, 20000, 0, 0, 0, 0, '', 2, '', '2023-10-06 22:09:43', '2023-10-06 22:11:31'),
(38, 'PO-0010', 5, 37500, 0, 0, 0, 0, '', 2, '', '2023-10-06 22:10:09', '2023-10-06 22:11:13'),
(39, 'PO-0011', 12, 15000, 0, 0, 0, 0, '', 2, '', '2023-10-06 22:10:34', '2023-10-06 22:10:56'),
(40, 'PO-0012', 5, 500000, 0, 0, 0, 0, '', 1, '', '2023-10-11 14:30:22', '2023-10-11 14:31:44');

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
(4, 'Fred Tañahura', 'Purok 4 Sta. Elena Iligan City', 'fb.com/Pido', 1, '2023-07-15 20:04:49', '2023-10-04 20:33:28'),
(6, 'Robert Uy', 'Bayanihan Village, Sta. Elena, Iligan City', 'fb.me/bert', 1, '2023-07-15 20:13:10', '2023-10-04 20:34:11'),
(7, 'Justine Caumeran ', 'Steeltown, Sta. Elena, Iligan City', 'fb.me/justine', 1, '2023-07-15 20:13:41', '2023-10-04 20:33:07'),
(8, 'Aeldred John Y. Tañahura', 'Purok 4, Sta. Elena, Iligan City, 9200, Lanao del Norte', '09159056977', 1, '2023-07-15 20:14:28', '2023-07-15 20:14:28');

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
(8, 'R-0001', 5, 1000, 'naay mga guba pero minor ra', '119', '2023-10-27 21:02:28', '2023-10-27 21:02:28');

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
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=IN , 2=OUT',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_list`
--

INSERT INTO `stock_list` (`id`, `item_id`, `quantity`, `unit`, `price`, `total`, `type`, `date_created`) VALUES
(82, 16, 25, 'boxes', 2500, 62500, 1, '2023-10-05 23:29:43'),
(83, 19, 30, 'boxes', 1000.5, 30015, 1, '2023-10-05 23:29:43'),
(84, 21, 30, 'boxes', 2500.5, 75015, 1, '2023-10-05 23:29:43'),
(85, 26, 20, 'boxes', 3000, 60000, 1, '2023-10-05 23:29:43'),
(86, 28, 25, 'boxes', 3000, 75000, 1, '2023-10-05 23:29:43'),
(87, 29, 500, 'pcs', 1500, 750000, 1, '2023-10-05 23:29:43'),
(88, 33, 75, 'pcs', 1799, 134925, 1, '2023-10-05 23:29:43'),
(89, 34, 75, 'pcs', 2000, 150000, 1, '2023-10-05 23:29:44'),
(90, 17, 30, 'pcs', 250.5, 7515, 1, '2023-10-05 23:32:41'),
(91, 22, 40, 'boxes', 2500, 100000, 1, '2023-10-05 23:32:42'),
(92, 23, 50, 'boxes', 100, 5000, 1, '2023-10-05 23:32:42'),
(93, 24, 50, 'boxes', 1500, 75000, 1, '2023-10-05 23:32:42'),
(94, 32, 30, 'boxes', 1300, 39000, 1, '2023-10-05 23:32:42'),
(95, 15, 100, 'boxes', 2000, 200000, 1, '2023-10-05 23:33:39'),
(96, 18, 250, 'pcs', 300, 75000, 1, '2023-10-05 23:33:39'),
(97, 20, 100, 'boxes', 1500, 150000, 1, '2023-10-05 23:33:39'),
(98, 25, 100, 'boxes', 2500, 250000, 1, '2023-10-05 23:33:39'),
(99, 27, 250, 'boxes', 1000.5, 250125, 1, '2023-10-05 23:33:39'),
(100, 30, 500, 'boxes', 2450, 1225000, 1, '2023-10-05 23:33:39'),
(101, 31, 100, 'boxes', 900, 90000, 1, '2023-10-05 23:33:39'),
(102, 15, 150, 'boxes', 2000, 300000, 1, '2023-10-05 23:33:58'),
(103, 18, 50, 'pcs', 300, 15000, 1, '2023-10-05 23:33:58'),
(104, 30, 300, 'boxes', 2450, 735000, 1, '2023-10-05 23:33:58'),
(105, 17, 20, 'pcs', 250.5, 5010, 1, '2023-10-05 23:34:14'),
(106, 22, 40, 'boxes', 2500, 100000, 1, '2023-10-05 23:34:14'),
(107, 23, 25, 'boxes', 100, 2500, 1, '2023-10-05 23:34:14'),
(108, 16, 200, 'boxes', 2500, 500000, 1, '2023-10-06 00:17:46'),
(109, 20, 10, 'boxes', 1500, 15000, 1, '2023-10-06 22:10:56'),
(110, 22, 15, 'boxes', 2500, 37500, 1, '2023-10-06 22:11:12'),
(111, 34, 10, 'pcs', 2000, 20000, 1, '2023-10-06 22:11:31'),
(112, 31, 10, 'pcs', 900, 9000, 1, '2023-10-06 22:11:45'),
(113, 30, 69, 'pcs', 2450, 169050, 1, '2023-10-06 22:12:00'),
(114, 17, 25, 'pcs', 250.5, 6262.5, 1, '2023-10-06 22:12:14'),
(115, 25, 50, 'boxes', 2500, 125000, 1, '2023-10-06 22:12:27'),
(116, 27, 50, 'boxes', 1000.5, 50025, 2, '2023-10-06 22:18:24'),
(117, 27, 5, 'pcs', 1000.5, 5002.5, 2, '2023-10-11 14:00:38'),
(118, 22, 100, 'boxes', 2500, 250000, 1, '2023-10-11 14:31:44'),
(119, 23, 10, 'boxes', 100, 1000, 2, '2023-10-27 21:02:28'),
(120, 29, 250, 'pcs', 1500, 375000, 2, '2023-11-01 21:19:55'),
(121, 30, 100, 'pcs', 2450, 245000, 2, '2023-11-01 21:19:55'),
(122, 29, 69, 'pcs', 1500, 103500, 2, '2023-11-01 21:50:24'),
(123, 30, 69, 'pcs', 2450, 169050, 2, '2023-11-01 22:04:36'),
(124, 16, 100, 'boxes', 2500, 250000, 2, '2023-11-01 22:07:40');

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
(5, 'Mico Gacutan', 'Bayanihan Village, Iligan City', '221-2121', 1, '2023-07-15 17:50:21', '2023-10-04 20:32:10'),
(6, 'Von Justine Caumeran ', 'Steeltown, Sta. Elena, Iligan City', 'justine@gmail.com', 1, '2023-07-15 17:51:09', '2023-08-15 13:55:48'),
(12, 'Jan Tan', 'Purok 4, Santa Elena, Iligan City', 'aeldredjohn.tanahura@gmail.com', 1, '2023-07-17 00:47:37', '2023-10-04 20:31:49');

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
(16, 'name', 'Item Management System | Iligan Branch'),
(17, 'short_name', 'IMS - Capstone Project'),
(18, 'logo', 'uploads/logo-1693842035.png'),
(19, 'cover', 'uploads/cover-1698646658.gif');

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
  `type` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 = admin, 2 = staff, 3 = manager',
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `role`, `email`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'Admin', 'admin', 'Administrator', 'admin', 'Admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'uploads/avatar-1.png?v=1689320020', NULL, 1, '2023-07-03 23:23:33', '2023-07-14 15:33:40'),
(14, 'Aeldred Johny', 'Yosores', 'Tañahura', 'Dredabyte', 'Admin 1', 'aeldredjohn.tanahura@gmail.com', '59771479da5a928009179e37f3482e45', 'uploads/avatar-14.png?v=1689319553', NULL, 1, '2023-07-14 15:25:50', '2023-10-30 15:37:32'),
(15, 'Mico', 'Sumile', 'Gacutan', 'mhico101', 'Staff', 'mico.gacutan@gmail.com', '48fe5d050feeb64c37901fb704886638', 'uploads/avatar-15.png?v=1689319717', NULL, 2, '2023-07-14 15:28:36', '2023-10-02 15:36:41'),
(19, 'Von Justine', 'Ruiz', 'Caumeran', 'youngjus', 'Employee', 'vonjustine@gmail.com', '3b344e6292d52b7d817a854643cc35d2', 'uploads/avatar-19.png?v=1689322908', NULL, 2, '2023-07-14 16:21:48', '2023-07-14 16:21:48'),
(20, 'example', 'example', 'example', 'example', 'example', 'example@gmail.com', '1a79a4d60de6718e8e5b326e338ae533', 'uploads/avatar-20.png?v=1694509053', NULL, 1, '2023-09-12 16:57:33', '2023-09-12 16:57:33'),
(21, 'Satoshi', 'C.', 'Nakamoto', 'satosh', 'Staff', 'satoshi@gmail.com', '689341a981a42dc60c461b119d934d59', 'uploads/avatar-21.png?v=1697284813', NULL, 3, '2023-10-14 20:00:13', '2023-10-30 15:38:06'),
(22, 'Eliza Rose', 'Estole', 'Silvoza', 'eliza', 'Manager', 'elizarose@gmail.com', '7ecf7a135cb264f952ded2626103a114', 'uploads/avatar-22.png?v=1698648234', NULL, 3, '2023-10-30 14:43:54', '2023-10-30 14:43:54');

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
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `brand_list`
--
ALTER TABLE `brand_list`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `category_list`
--
ALTER TABLE `category_list`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `incoming_list`
--
ALTER TABLE `incoming_list`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `inventory_request_list`
--
ALTER TABLE `inventory_request_list`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ir_stock_list`
--
ALTER TABLE `ir_stock_list`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `item_list`
--
ALTER TABLE `item_list`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `outgoing_list`
--
ALTER TABLE `outgoing_list`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `purchase_order_list`
--
ALTER TABLE `purchase_order_list`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

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
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stock_list`
--
ALTER TABLE `stock_list`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

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
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
