-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for esshop
DROP DATABASE IF EXISTS `esshop`;
CREATE DATABASE IF NOT EXISTS `esshop` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `esshop`;

-- Dumping structure for table esshop.category
DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `parentid` mediumint(9) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `sef_url` varchar(255) NOT NULL,
  `ordering` mediumint(9) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '1',
  `modified_by` int(11) NOT NULL DEFAULT '1',
  `cts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `mts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Dumping data for table esshop.category: ~7 rows (approximately)
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`id`, `name`, `description`, `parentid`, `status`, `meta_keyword`, `meta_description`, `sef_url`, `ordering`, `deleted`, `created_by`, `modified_by`, `cts`, `mts`) VALUES
	(1, 'Clothing', NULL, 0, 1, NULL, NULL, 'clothing-category.html', 1, 0, 1, 1, '2018-06-07 11:01:52', '2018-06-07 11:01:52'),
	(2, 'Shoes', NULL, 0, 1, NULL, NULL, 'shoes-category.html', 1, 0, 1, 1, '2018-06-07 11:01:40', '2018-06-07 11:01:40'),
	(3, 'brands', NULL, 0, 1, NULL, NULL, 'brands-category.html', 1, 0, 1, 1, '2018-06-07 11:02:06', '2018-06-07 11:02:06'),
	(4, 'Jackets', NULL, 1, 1, NULL, NULL, 'jackets-category.html', 1, 0, 1, 1, '2018-06-07 11:02:20', '2018-06-07 11:02:20'),
	(5, 'Pants', NULL, 1, 1, NULL, NULL, 'pants-category.html', 2, 0, 1, 1, '2018-06-07 14:39:46', '2018-06-07 14:39:46'),
	(6, 'Herobrands', NULL, 3, 1, NULL, NULL, 'herobrands-category.html', 1, 0, 1, 1, '2018-06-07 14:39:59', '2018-06-07 14:39:59'),
	(7, 'Sneaker', NULL, 2, 1, NULL, NULL, 'sneaker-category.html', 1, 0, 1, 1, '2018-06-07 14:40:11', '2018-06-07 14:40:11');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Dumping structure for table esshop.currency
DROP TABLE IF EXISTS `currency`;
CREATE TABLE IF NOT EXISTS `currency` (
  `id` smallint(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `symbol` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `cts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `createdby` int(11) NOT NULL DEFAULT '1',
  `modifiedby` int(11) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table esshop.currency: ~0 rows (approximately)
/*!40000 ALTER TABLE `currency` DISABLE KEYS */;
INSERT INTO `currency` (`id`, `name`, `code`, `symbol`, `status`, `cts`, `mts`, `createdby`, `modifiedby`, `deleted`) VALUES
	(1, 'Indian Rupee', 'INR', '€', 1, '2018-06-07 23:01:21', '2018-06-08 15:34:07', 1, 1, 0);
/*!40000 ALTER TABLE `currency` ENABLE KEYS */;

-- Dumping structure for table esshop.product
DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_number` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `catid` mediumint(9) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `currencyid` tinyint(4) NOT NULL DEFAULT '1',
  `color` varchar(20) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `sef_url` varchar(500) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `cts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `mts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_number` (`product_number`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table esshop.product: ~6 rows (approximately)
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` (`id`, `product_number`, `name`, `catid`, `price`, `currencyid`, `color`, `thumb`, `description`, `meta_keywords`, `meta_description`, `sef_url`, `status`, `ordering`, `deleted`, `created_by`, `modified_by`, `cts`, `mts`) VALUES
	(1, 'DFCN089WHT', 'DEF Women Jumper Reve in white', 4, 31.99, 1, 'White', 'http://eshop.dev.com/images/products/def-jumper-white-486584.jpg', '<ul>\r\n  <li>stylish oversize sweatshirt for women by DEF</li>\r\n  <li>Crew neck with ribbed trim</li>\r\n  <li>modern color block design</li>\r\n  <li>Ribbed cuffs at the sleeves and waist ensure a good fit</li>\r\n  <li>slotted outsides for a casual look</li>\r\n  <li>slightly longer back</li>\r\n  <li>soft roughened inside ensures a comfortable fit</li>\r\n  <li>loose fit&nbsp;</li>\r\n</ul>', '', 'DEF Jumper Reve in white order at DEFSHOP | Available now in size XS - XL | Free return ✓  06.06.2018 486584', 'def-reve-crewneck-white.html', 1, 5, 0, 0, 0, '2018-06-07 00:06:40', '2018-06-07 00:06:40'),
	(2, 'DFCN067WHT', 'DEF Women Jumper Ember Sweat in white', 4, 28.99, 1, 'White', 'http://eshop.dev.com/images/products/def-jumper-white-394877.jpg', '<ul>\r\n  <li>modern sweatshirt for women by DEF</li>\r\n  <li>cool tricolor design</li>\r\n  <li>finely ribbed crew neck</li>\r\n  <li>Rib cuffs on the arm and hips provide a good fit and prevent slipping</li>\r\n  <li>Soft roughened inside ensures best wearing comfort</li>\r\n  <li>comfortable fit&nbsp;</li>\r\n</ul>', '', 'DEF Jumper Ember Sweat in white order at DEFSHOP | Available now in size XS - XL | Free return ✓  06.06.2018 394877 ', 'def-ember-sweat-shirt-white.html', 1, 4, 0, 0, 0, '2018-06-07 00:05:19', '2018-06-07 00:05:19'),
	(3, 'DGCA265BLKRED', 'Snapback Cap Health in red', 6, 8.99, 1, 'Red', 'http://eshop.dev.com/images/products/dangerous-dngrs-snapback-cap-red-391079.jpg', '<ul>\r\n  <li>Snapback Cap by Dangerous DNGRS</li>\r\n  <li>Logo patch on the front</li>\r\n  <li>Six embroidered air holes ensure better air circulation</li>\r\n  <li>Moisture absorbing sweatband</li>\r\n  <li>adjustable in size at the back of the head for a perfect fit</li>\r\n  <li>small logo patch on the back of the head</li>\r\n  <li>Visor provided on both sides with a casual ganja print</li>\r\n  <li>6-panel cap&nbsp;</li>\r\n</ul>', '', 'Dangerous DNGRS Snapback Cap Health  in rot | Verfügbar in Größe Verstellbar | Gratis Rückversand ✓ Tiefpreisgarantie ✓  06.06.2018 391079', 'dangerous-dngrs-health-snapback-cap-black-red.html', 1, 3, 0, 0, 0, '2018-06-07 00:05:31', '2018-06-07 00:05:31'),
	(4, 'CQ2168', 'Sneakers Pw Tennis Hu in white', 7, 100.99, 1, 'White', 'http://eshop.dev.com/images/products/adidas-originals-sneakers-white-437299.jpg', '<ul>\r\n  <li>Trendy tennis-style sneaker in collaboration with Pharrel Williams</li>\r\n  <li>soft, breathable knit upper</li>\r\n  <li>sock-like construction for a secure fit</li>\r\n  <li>new interpretation of the classic adidas running style</li>\r\n  <li>special lacing system provides a tight fit</li>\r\n  <li>Logo patch on the tongue</li>\r\n  <li>EVA midsole with grid structure for long-term cushioning with low weight</li>\r\n  <li>colored detail in the heel area</li>\r\n  <li>robust rubber outsole</li>\r\n  <li>Weight per shoe: approx. 172g (size 38)&nbsp;<br />\r\n      <br />\r\n    Brand: adidas&nbsp;<br />\r\n    Cat .: Sneakers&nbsp;<br />\r\n    Colour: white / dark blue&nbsp;<br />\r\n    Contains non-textile parts of animal origin</li>\r\n</ul>', '', 'adidas originals Sneakers Pw Tennis Hu in white order at DEFSHOP | Available now in size 36 2/3 - 46 2/3 | Free return ✓  06.06.2018 437299', 'adidas-pw-tennis-hu-sneakers-ftw-white-ftw-white-cream-white-437299.html', 1, 2, 0, 0, 0, '2018-06-07 00:05:36', '2018-06-07 00:05:36'),
	(5, 'CSJA002BLK', 'Men Lightweight Jacket Mono in black', 4, 181.99, 1, 'Black', 'http://eshop.dev.com/images/products/cavallo-de-ferro-lightweight-jacket-black-338067.jpg', '<ul>\r\n  <li>light parka by Cavallo de Ferro for men</li>\r\n  <li>wide hood with push button closure</li>\r\n  <li>Brandlogo application made of metal on the chest</li>\r\n  <li>subtle print on the back</li>\r\n  <li>Closure: high-closing push-button bar</li>\r\n  <li>lockable side pockets</li>\r\n  <li>Button closure at sleeve end</li>\r\n  <li>Inner pocket with zipper</li>\r\n  <li>Drawstring waist and hem for an individual fit</li>\r\n  <li>comfortable fit&nbsp;</li>\r\n</ul>', '', 'Cavallo de Ferro Lightweight Jacket Mono in black order at DEFSHOP | Available now in size S - 2XL | Free return ✓  06.06.2018 338067', 'cavallo-de-ferro-mono-parker-jacket-black.html', 1, 1, 0, 0, 0, '2018-06-08 13:47:25', '2018-06-08 13:47:25'),
	(6, 'DFLP014BLK', 'Women Legging/Tregging Macy in black', 5, 10.99, 1, 'Black', 'http://eshop.dev.com/images/products/def-legging-tregging-black-458321.jpg', '<ul style="list-style:circle">\r\n  <li>modern leggings for women by DEF</li>\r\n  <li>wide stretch waistband for a supple fit that will not slip</li>\r\n  <li>elastic material ensures a perfect fit</li>\r\n  <li>Contrast stripes on the outsides</li>\r\n  <li>comfortable to wear thanks to soft cotton blend fabric</li>\r\n  <li>figure-cut cut&nbsp;</li>\r\n</ul>', '', 'DEF Legging/Tregging Macy in black order at DEFSHOP | Available now in size XS - \'M\' | Free return ✓  08.06.2018 458321', 'def-macy-leggings-black.html', 1, 1, 0, 0, 0, '2018-06-08 13:53:20', '2018-06-08 13:53:20');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;

-- Dumping structure for table esshop.product_brand
DROP TABLE IF EXISTS `product_brand`;
CREATE TABLE IF NOT EXISTS `product_brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL DEFAULT '1',
  `modified_by` int(11) NOT NULL DEFAULT '1',
  `cts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table esshop.product_brand: ~2 rows (approximately)
/*!40000 ALTER TABLE `product_brand` DISABLE KEYS */;
INSERT INTO `product_brand` (`id`, `name`, `description`, `status`, `deleted`, `created_by`, `modified_by`, `cts`, `mts`) VALUES
	(1, 'adidas ', NULL, 1, 0, 1, 1, '2018-06-06 23:49:15', '2018-06-07 00:02:10'),
	(2, 'DEF', NULL, 1, 0, 1, 1, '2018-06-07 00:01:52', '2018-06-07 00:02:12'),
	(3, 'Dangerous DNGRS', NULL, 1, 0, 1, 1, '2018-06-07 00:02:06', '2018-06-07 00:02:18');
/*!40000 ALTER TABLE `product_brand` ENABLE KEYS */;

-- Dumping structure for table esshop.product_detail
DROP TABLE IF EXISTS `product_detail`;
CREATE TABLE IF NOT EXISTS `product_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `brandid` int(11) NOT NULL,
  `material` varchar(255) NOT NULL,
  `money_return_guarantee` tinyint(1) NOT NULL,
  `is_tumble_dry` tinyint(1) NOT NULL,
  `is_bleach` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '1',
  `modified_by` int(11) NOT NULL DEFAULT '1',
  `cts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `mts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table esshop.product_detail: ~5 rows (approximately)
/*!40000 ALTER TABLE `product_detail` DISABLE KEYS */;
INSERT INTO `product_detail` (`id`, `product_id`, `brandid`, `material`, `money_return_guarantee`, `is_tumble_dry`, `is_bleach`, `created_by`, `modified_by`, `cts`, `mts`) VALUES
	(1, 4, 0, '', 0, 0, 0, 1, 1, '2018-06-06 23:45:38', '2018-06-06 23:45:38'),
	(2, 1, 0, '', 0, 0, 0, 1, 1, '2018-06-08 13:50:22', '2018-06-08 13:50:22'),
	(3, 2, 0, '', 0, 0, 0, 1, 1, '2018-06-08 13:50:27', '2018-06-08 13:50:27'),
	(4, 3, 0, '', 0, 0, 0, 1, 1, '2018-06-08 13:50:31', '2018-06-08 13:50:31'),
	(5, 5, 0, '', 0, 0, 0, 1, 1, '2018-06-08 13:50:37', '2018-06-08 13:50:37'),
	(6, 6, 2, '95% cotton 5% spandex', 0, 0, 0, 1, 1, '2018-06-08 13:52:55', '2018-06-08 13:52:55');
/*!40000 ALTER TABLE `product_detail` ENABLE KEYS */;

-- Dumping structure for table esshop.transaction_order
DROP TABLE IF EXISTS `transaction_order`;
CREATE TABLE IF NOT EXISTS `transaction_order` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `order_number` varchar(100) NOT NULL,
  `userid` int(11) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `total_gross_amount` decimal(10,2) NOT NULL,
  `tax_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discount_amount` decimal(10,2) NOT NULL,
  `total_net_amount` decimal(10,2) NOT NULL,
  `payment_gateway` enum('COD','PAYPAL') NOT NULL,
  `payment_status` enum('success','pending','cancelled','refund') NOT NULL DEFAULT 'pending',
  `transaction_status` enum('initiated','inprocess','cancelled','success') NOT NULL DEFAULT 'initiated',
  `currencyid` tinyint(4) NOT NULL DEFAULT '1',
  `ipaddress` varchar(100) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '1',
  `modified_by` int(11) NOT NULL DEFAULT '1',
  `cts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `mts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_number` (`order_number`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table esshop.transaction_order: ~0 rows (approximately)
/*!40000 ALTER TABLE `transaction_order` DISABLE KEYS */;
INSERT INTO `transaction_order` (`id`, `order_number`, `userid`, `transaction_date`, `total_gross_amount`, `tax_amount`, `discount_amount`, `total_net_amount`, `payment_gateway`, `payment_status`, `transaction_status`, `currencyid`, `ipaddress`, `user_agent`, `deleted`, `created_by`, `modified_by`, `cts`, `mts`) VALUES
	(1, '1708062018130655', 17, '2018-06-08 13:06:55', 10.99, 0.00, 0.00, 10.99, 'COD', 'success', 'success', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 0, 17, 17, '2018-06-08 19:25:59', '2018-06-08 19:25:59');
/*!40000 ALTER TABLE `transaction_order` ENABLE KEYS */;

-- Dumping structure for table esshop.transaction_order_item
DROP TABLE IF EXISTS `transaction_order_item`;
CREATE TABLE IF NOT EXISTS `transaction_order_item` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `orderid` bigint(20) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` smallint(6) NOT NULL,
  `gross_amount` decimal(10,2) NOT NULL,
  `discount_amount` decimal(10,2) NOT NULL,
  `net_amount` decimal(10,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `cts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `mts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table esshop.transaction_order_item: ~0 rows (approximately)
/*!40000 ALTER TABLE `transaction_order_item` DISABLE KEYS */;
INSERT INTO `transaction_order_item` (`id`, `orderid`, `product_id`, `quantity`, `gross_amount`, `discount_amount`, `net_amount`, `created_by`, `modified_by`, `cts`, `mts`) VALUES
	(1, 1, 6, 1, 10.99, 0.00, 10.99, 0, 0, '2018-06-08 19:25:59', '2018-06-08 19:25:59');
/*!40000 ALTER TABLE `transaction_order_item` ENABLE KEYS */;

-- Dumping structure for table esshop.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(500) NOT NULL,
  `signupdate` datetime NOT NULL,
  `address` varchar(1000) NOT NULL,
  `countryid` smallint(3) NOT NULL DEFAULT '1',
  `mobile` varchar(50) NOT NULL,
  `zipcode` varchar(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-notverified,1-active,2-inactive',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `ipaddress` varchar(100) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `cts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `usertype` enum('admin','superadmin','user') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- Dumping data for table esshop.user: ~4 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `password`, `email`, `name`, `signupdate`, `address`, `countryid`, `mobile`, `zipcode`, `status`, `deleted`, `ipaddress`, `user_agent`, `cts`, `mts`, `created_by`, `modified_by`, `usertype`) VALUES
	(1, '30dfe79fe97d38aeb8d53a8c482d3ec6', 'srideviadmin@gmail.com', 'Admin', '2018-06-07 00:34:40', '', 1, '', NULL, 1, 0, '', '', '2018-06-07 00:34:49', '2018-06-08 19:27:43', NULL, NULL, 'superadmin'),
	(10, '30dfe79fe97d38aeb8d53a8c482d3ec6', 'sridevi@gmail.com', 'Sridevi Vanam', '0000-00-00 00:00:00', '', 1, '', NULL, 1, 0, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', '2018-06-08 01:46:34', '2018-06-08 19:27:46', NULL, NULL, 'user'),
	(11, '30dfe79fe97d38aeb8d53a8c482d3ec6', 'varaprasad@gmail.com', 'vara prasad', '0000-00-00 00:00:00', '', 1, '', NULL, 1, 0, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', '2018-06-08 12:39:55', '2018-06-08 19:27:53', NULL, NULL, 'user'),
	(17, '30dfe79fe97d38aeb8d53a8c482d3ec6', 'hasini@gmail.com', 'hasini', '2018-06-08 13:06:48', '', 1, '', NULL, 1, 0, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', '2018-06-08 19:18:11', '2018-06-08 19:18:55', NULL, NULL, 'user');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
