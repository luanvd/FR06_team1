-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2014 at 04:23 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `group4`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE IF NOT EXISTS `brands` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` text NOT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`) VALUES
(1, 'Roche Bobois'),
(2, 'Pasaya'),
(7, 'Baker'),
(3, 'Misura Emme'),
(5, 'Christopher Guy'),
(9, 'Restoration Hardware'),
(8, 'Poliform'),
(6, 'Kartell'),
(10, 'Edra'),
(4, 'Maison & Objet'),
(11, 'Boca do Lobo'),
(12, 'Fendi Casa'),
(13, 'Brabbu');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `cate_id` int(11) NOT NULL AUTO_INCREMENT,
  `cate_name` text NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `cate_orderby` int(11) NOT NULL,
  PRIMARY KEY (`cate_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cate_id`, `cate_name`, `parent_id`, `cate_orderby`) VALUES
(1, 'Living Room', 0, 1),
(4, 'Umbrellas', 0, 6),
(5, 'Chairs & Ottomans', 1, 2),
(2, 'Lighting & Lanterns', 1, 3),
(6, 'Patio sofas & Beds', 1, 4),
(7, 'Tables', 6, 5),
(3, 'Rugs', 0, 7);

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `number_page` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`number_page`) VALUES
(6);

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE IF NOT EXISTS `features` (
  `pro_id` int(11) NOT NULL,
  `pro_orderby` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `feed_id` int(10) NOT NULL AUTO_INCREMENT,
  `feed_name` varchar(50) NOT NULL,
  `feed_email` varchar(50) NOT NULL,
  `feed_title` text NOT NULL,
  `feed_content` text NOT NULL,
  `feed_rate` float NOT NULL,
  `feed_time` datetime NOT NULL,
  `pro_id` int(10) NOT NULL,
  PRIMARY KEY (`feed_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feed_id`, `feed_name`, `feed_email`, `feed_title`, `feed_content`, `feed_rate`, `feed_time`, `pro_id`) VALUES
(1, 'guess', 'guess@gmail.com', 'Có vấn đề???', 'Mình thấy sản phẩm này rất tốt, tuy nhiên còn 1 số chức năng không tốt.\nMình thấy sản phẩm này rất tốt, tuy nhiên còn 1 số chức năng không tốt.\nMình thấy sản phẩm này rất tốt, tuy nhiên còn 1 số chức năng không tốt.', 4.5, '2014-07-29 10:00:00', 1),
(2, 'Toàn', 'toan@smartosc.com', 'bình thường', 'sản phẩm bình thường, không có gì nổi bật', 45, '0000-00-00 00:00:00', 1),
(3, 'adad', 'asd@gmail.com', 'ádadsda', 'như nồi', 66, '2014-07-29 16:00:00', 1),
(4, 'asdasda', 'asdasdadsad@gmail.com', 'ASDSADASD', 'Mình thấy sản phẩm này rất tốt, tuy nhiên còn 1 số chức năng không tốt.\nMình thấy sản phẩm này rất tốt, tuy nhiên còn 1 số chức năng không tốt.\nMình thấy sản phẩm này rất tốt, tuy nhiên còn 1 số chức năng không tốt.', 69, '2014-07-31 04:53:03', 22),
(5, 'asdasda', 'asdasdadsad@gmail.com', 'ASDSADASD', 'rất tôt', 69, '2014-07-31 04:53:51', 22),
(6, 'toannn2', 'toannn@smartosc.com', 'qa', 'sản phẩm bình thường, không có gì nổi bật', 91, '2014-07-31 04:58:26', 22),
(7, 'toanlv', 'toanlv@smartosc.com', 'qa', 'như nồi', 99, '2014-07-31 04:59:12', 22),
(8, 'Quý', 'quynh@gmail.com', 'Tạm ổn', 'sản phẩm có nhiều chi tiết hay', 49, '2014-08-01 02:53:34', 8),
(9, 'doof', 'doof@doof.doff', 'còm men', 'như nồi', 76, '2014-08-01 01:21:27', 18),
(10, 'ABCDEF', 'administrator@smartosc.com', 'ADASD', 'sản phẩm bình thường, không có gì nổi bật', 93, '2014-08-01 02:01:07', 9),
(11, 'ĐÂSDAS', 'administrator@smartosc.com', 'ÁDADASD', 'Mình thấy sản phẩm này rất tốt, tuy nhiên còn 1 số chức năng không tốt.\nMình thấy sản phẩm này rất tốt, tuy nhiên còn 1 số chức năng không tốt.\nMình thấy sản phẩm này rất tốt, tuy nhiên còn 1 số chức năng không tốt.', 63, '2014-08-01 02:01:32', 9),
(12, 'czxczxc', 'administrator@smartosc.com', 'qa', 'như nồi', 76, '2014-08-01 02:01:42', 9),
(13, '123123123123131', 'administrator@smartosc.com', 'ADASD', 'rất tôt', 46, '2014-08-01 02:01:56', 9),
(14, 'czxczxc', 'administrator@smartosc.com', 'ADASD', 'sản phẩm bình thường, không có gì nổi bật', 64, '2014-08-01 02:02:47', 18),
(15, 'asdasd', 'administrator@smartosc.com', 'ADASD', 'rất tôt', 74, '2014-08-01 03:02:34', 11),
(16, 'dsa', 'asad@gmal.com', 'sd', 'Mình thấy sản phẩm này rất tốt, tuy nhiên còn 1 số chức năng không tốt.\nMình thấy sản phẩm này rất tốt, tuy nhiên còn 1 số chức năng không tốt.\nMình thấy sản phẩm này rất tốt, tuy nhiên còn 1 số chức năng không tốt.', 99, '2014-08-01 03:40:42', 18),
(17, 'sd', 'asdas@a.com', 'asda', 'sản phẩm bình thường, không có gì nổi bật', 0, '2014-08-01 05:03:12', 1),
(18, 'asdfgh', 'ssdfgh@dfg.com', 'sd', 'rất tôt', 95, '2014-08-01 05:03:35', 1),
(19, 'Cờ hó', 'toilatoi@gmail.com', 'Tạm ổn', 'Nhìn chung các bạn làm cũng tạm ổn', 67, '2014-08-04 10:29:34', 6),
(20, 'sadsadsa', 'asdsad@gmail.com', 'dsads', 'dasdsadasd', 69, '2014-08-05 04:51:11', 51),
(21, 'toan', 'toanlv@smartosc.com', 'good', 'good', 0, '2014-08-06 04:41:57', 18),
(22, 'Toan Nguyen', 'toannn@smartosc.com', 'good', 'very good', 98, '2014-08-06 04:42:39', 18),
(23, 'adasd', 'administrator@smartosc.com', 'ADASD', 'asdasdsadsadas', 70, '2014-08-06 04:54:43', 61),
(24, 'adasdasd', 'toanlv@smartosc.com', 'asdasdasdas', 'good', 72, '2014-08-13 01:52:26', 5),
(25, 'nguyen huu quy', 'quynh@gmail.com', 'OK', 'san pham nay rat dep', 70, '2014-08-18 09:03:10', 62),
(26, 'ABCDEF', 'quynh@gmail.com', 'ADASD', 'aasasaassa', 85, '2014-08-18 09:12:48', 62);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `img_id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_id` int(11) NOT NULL,
  `img_link` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`img_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=334 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`img_id`, `pro_id`, `img_link`, `status`) VALUES
(333, 1, '11_wood_market_umbrella_1.png', 1),
(332, 1, '10_market_umbrella_in_autumn_red_1.png', 1),
(327, 62, 'trans_globe_lighting_1-light_outdoor_black_onion_wall_lantern_1.png', 1),
(326, 62, 'product35_resized.png', 1),
(293, 13, 'product09_resized.png', 1),
(294, 13, 'product11_resized.png', 1),
(295, 13, 'product14_resized.png', 1),
(296, 14, '9_market_umbrella_with_steel_pole_1.png', 1),
(297, 14, '9_outdoor_market_umbrella_1.png', 1),
(298, 14, '9_outdoor_market_umbrella_in_lime_green_2.png', 1),
(299, 14, '10_market_umbrella_in_autumn_red_1.png', 1),
(300, 14, '11_wood_market_umbrella_1.png', 1),
(301, 18, 'product05_resized.png', 1),
(302, 18, 'product09_resized.png', 1),
(303, 18, 'product11_resized.png', 1),
(304, 56, '9_market_umbrella_with_steel_pole_1.png', 1),
(305, 56, '9_outdoor_market_umbrella_1.png', 1),
(306, 56, '10_market_umbrella_in_autumn_red_1.png', 1),
(307, 19, 'product01_resized.png', 1),
(308, 19, 'product02_resized.png', 1),
(309, 19, 'product03_resized.png', 1),
(310, 21, 'koko_-_branches_runner_floormat_2.png', 1),
(311, 21, 'Koko-Trees-Plastic-Floormat-1.png', 1),
(312, 43, 'anjuna_bed_in_chocolate_-_zuo_modern_1.png', 1),
(313, 43, 'ODonnell-Garden-Seat-2.png', 1),
(314, 43, 'Outdoor-Chaise-Lounge-Biarritz-Lounge-Chair-1.png', 1),
(315, 48, 'Adirondack-Chair-in-Hunter-Green-1.png', 1),
(316, 48, 'cat11_resized.png', 1),
(317, 48, 'cat12_resized.png', 1),
(318, 60, '9_outdoor_market_umbrella_1.png', 1),
(319, 60, '9_outdoor_market_umbrella_in_lime_green_2.png', 1),
(320, 60, '11_wood_market_umbrella_1.png', 1),
(325, 62, 'product20_resized.png', 1),
(324, 62, 'garden_trading_co_belfast_wall_lamp_clay_1.png', 1),
(323, 61, 'cat11_resized.png', 1),
(276, 5, 'john_lewis_cleve_outdoor_wall_lantern_1.png', 1),
(291, 11, 'product09_resized.png', 1),
(292, 11, 'product11_resized.png', 1),
(290, 11, 'Adirondack-Chair-in-Hunter-Green-1.png', 1),
(289, 10, 'product15_resized.png', 1),
(288, 10, 'Delmar-Outdoor-Table-1.png', 1),
(287, 10, 'cafe_dinette_table_silver_swirl_1.png', 1),
(285, 12, 'anjuna_bed_in_chocolate_-_zuo_modern_1.png', 1),
(286, 12, 'cat12_resized.png', 1),
(284, 12, 'algarva_outdoor_sofa_in_chocolate_1.png', 1),
(283, 8, 'Outdoor-Chaise-Lounge-Biarritz-Lounge-Chair-1.png', 1),
(282, 8, 'john-Lewis-FSC-Double-Planter-Bench-1.png', 1),
(280, 7, 'product05_resized.png', 1),
(281, 8, 'Delmar-Outdoor-Table-1.png', 1),
(279, 7, 'gloster_horizon_deep_seating_outdoor_armchair_from_john_lewis_1.png', 1),
(278, 7, 'algarva_outdoor_sofa_in_chocolate_1.png', 1),
(277, 5, 'trans_globe_lighting_1-light_outdoor_black_onion_wall_lantern_1.png', 1),
(275, 5, 'garden_trading_co_belfast_wall_lamp_clay_1.png', 1),
(273, 4, '10_market_umbrella_in_autumn_red_1.png', 1),
(272, 4, '9_outdoor_market_umbrella_1.png', 1),
(270, 3, 'product06_resized2.png', 1),
(271, 4, '9_market_umbrella_with_steel_pole_1.png', 1),
(269, 3, 'product06_resized.png', 1),
(268, 3, 'attractive_round_chair_on_low_revolving_base_1_copy.png', 1),
(330, 1, '9_outdoor_market_umbrella_1.png', 1),
(331, 1, '9_outdoor_market_umbrella_in_lime_green_2.png', 1),
(329, 1, '9_market_umbrella_with_steel_pole_1.png', 1),
(321, 61, 'Biscayne-High-Top-Bistro-Table-1.png', 1),
(322, 61, 'cafe_dinette_table_silver_swirl_1.png', 1),
(274, 4, '11_wood_market_umbrella_1.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone` int(11) NOT NULL,
  `order_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `order_status` int(1) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `name`, `email`, `address`, `phone`, `order_time`, `order_status`) VALUES
(49, 'czxczxc', 'asdasd@123.com', 'Hà Nội', 987654321, '2014-08-13 06:53:14', 1),
(48, 'asdasd', 'administrator@smartosc.com', 'Hà Nội', 987654321, '2014-08-06 09:41:09', 1),
(47, 'asdasd', 'administrator@smartosc.com', 'Hà Nội', 987654321, '2014-08-06 07:32:03', 1),
(44, 'Nguyễn Hữu Quý', 'nguyenquy101192@gmail.com', 'Hà Nội', 987654321, '2014-08-05 18:22:45', 1),
(45, 'q', 'quynh@smartosc.com', 'qeqweq', 1234567890, '2014-08-06 04:13:16', 1),
(46, 'asdasd', 'administrator@smartosc.com', 'Hà Nội', 987654321, '2014-08-06 04:59:25', 1),
(51, 'czxczxc', 'administrator@smartosc.com', 'Hà Nội', 987654321, '2014-08-14 02:01:34', 0),
(52, 'nguyen huu quy', 'nguyenquy101192@gmail.com', 'Ha Noi', 123456789, '2014-08-18 02:03:43', 0),
(53, 'nguyen huu quy', 'nguyenquy101192@gmail.com', 'Ha Noi', 123456789, '2014-08-18 02:17:53', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE IF NOT EXISTS `order_details` (
  `orderdetail_id` int(10) NOT NULL AUTO_INCREMENT,
  `pro_name` varchar(200) NOT NULL,
  `order_price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `order_id` int(10) NOT NULL,
  `pro_id` int(11) NOT NULL,
  PRIMARY KEY (`orderdetail_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=81 ;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`orderdetail_id`, `pro_name`, `order_price`, `quantity`, `order_id`, `pro_id`) VALUES
(74, 'Attractive round chair new', 10000000, 100, 49, 61),
(75, 'Good chair', 1450000, 123, 49, 13),
(76, 'Green Umbrella', 390000, 12, 49, 14),
(72, 'B', 123, 1, 47, 60),
(73, 'Airm-chair', 1500000, 7, 48, 18),
(71, 'Airm-chair', 1500000, 1, 46, 18),
(70, 'q', 123, 1, 45, 58),
(69, 'Grey Sofar', 1800000, 13, 44, 43),
(68, 'Attractive round chair', 500000, 55, 44, 1),
(78, 'New product', 1000000, 1, 51, 62),
(79, 'New product', 1000000, 123, 52, 62),
(80, 'New product', 1000000, 1, 53, 62);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `pro_id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_name` text NOT NULL,
  `pro_list_price` double NOT NULL,
  `pro_sale_price` double NOT NULL,
  `pro_images` varchar(200) NOT NULL,
  `pro_desc` text NOT NULL,
  `pro_country` text NOT NULL,
  `brand_id` int(11) NOT NULL,
  `feature` int(11) NOT NULL,
  PRIMARY KEY (`pro_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pro_id`, `pro_name`, `pro_list_price`, `pro_sale_price`, `pro_images`, `pro_desc`, `pro_country`, `brand_id`, `feature`) VALUES
(1, 'Attractive round chair', 500000, 500000, 'attractive_round_chair_on_low_revolving_base_1_copy.png', 'We are offering you our tremendous choice of different kinds of furniture. It is totally safe for your health. It has passed many various tests without a single failure. This product has unique design and many special options which could indeed help you. You know, nowadays good design is a really important thing. Fashion in this case is really interesting phenomenon - we often like things that are good-looking. And it is normal - after all we get maximum information through the eyes. And our product is a perfect combination of cute shapes and real good content.', 'Korea', 2, 1),
(3, 'Orange Cube table', 1300000, 1300000, 'product06_resized.png', 'You know, nowadays we have also faced the problem of choice. All these new technologies that surround us, they became so much more available and many stores use them to represent us numerous goods. And often we are not even sure if it’s necessary to purchase it. But this problem is not about this case because even if you haven’t decided that you need this product we will gladly help you and together we will find out your needs. After that we will offer you exactly what you need.', 'Japan', 4, 1),
(4, 'Wood umbrella', 130000, 130000, '11_wood_market_umbrella_1.png', 'We are offering you our tremendous choice of different kinds of furniture. It is totally safe for your health. It has passed many various tests without a single failure. This product has unique design and many special options which could indeed help you. You know, nowadays good design is a really important thing. Fashion in this case is really interesting phenomenon - we often like things that are good-looking. And it is normal - after all we get maximum information through the eyes. And our product is a perfect combination of cute shapes and real good content.', 'Vietnam', 4, 1),
(5, 'Outside Lamp', 250000, 250000, 'john_lewis_cleve_outdoor_wall_lantern_1.png', 'You know, nowadays we have also faced the problem of choice. All these new technologies that surround us, they became so much more available and many stores use them to represent us numerous goods. And often we are not even sure if it’s necessary to purchase it. But this problem is not about this case because even if you haven’t decided that you need this product we will gladly help you and together we will find out your needs. After that we will offer you exactly what you need.', 'Vietnam', 3, 1),
(7, 'Sofar', 34000000, 34000000, 'gloster_horizon_deep_seating_outdoor_armchair_from_john_lewis_1.png', 'You know, nowadays we have also faced the problem of choice. All these new technologies that surround us, they became so much more available and many stores use them to represent us numerous goods. And often we are not even sure if it’s necessary to purchase it. But this problem is not about this case because even if you haven’t decided that you need this product we will gladly help you and together we will find out your needs. After that we will offer you exactly what you need.', 'Việt Nam', 4, 1),
(8, 'Comfee Casual airm chair', 640000, 640000, 'comfee_casual_arm_chair_from_anna_hrecka_1_copy.png', 'We are offering you our tremendous choice of different kinds of furniture. It is totally safe for your health. It has passed many various tests without a single failure. This product has unique design and many special options which could indeed help you. You know, nowadays good design is a really important thing. Fashion in this case is really interesting phenomenon - we often like things that are good-looking. And it is normal - after all we get maximum information through the eyes. And our product is a perfect combination of cute shapes and real good content.', 'Việt Nam', 13, 1),
(12, 'Hug sofar', 1150000, 1150000, 'product07_resized.png', 'You know, nowadays we have also faced the problem of choice. All these new technologies that surround us, they became so much more available and many stores use them to represent us numerous goods. And often we are not even sure if it’s necessary to purchase it. But this problem is not about this case because even if you haven’t decided that you need this product we will gladly help you and together we will find out your needs. After that we will offer you exactly what you need.', 'asdsadsad', 6, 1),
(10, 'Inox table', 1200000, 1200000, 'Biscayne-High-Top-Bistro-Table-1.png', 'We are offering you our tremendous choice of different kinds of furniture. It is totally safe for your health. It has passed many various tests without a single failure. This product has unique design and many special options which could indeed help you. You know, nowadays good design is a really important thing. Fashion in this case is really interesting phenomenon - we often like things that are good-looking. And it is normal - after all we get maximum information through the eyes. And our product is a perfect combination of cute shapes and real good content.', 'Vietnam', 13, 1),
(11, 'Deep seating', 47000000, 47000000, 'product12_resized.png', 'You know, nowadays we have also faced the problem of choice. All these new technologies that surround us, they became so much more available and many stores use them to represent us numerous goods. And often we are not even sure if it’s necessary to purchase it. But this problem is not about this case because even if you haven’t decided that you need this product we will gladly help you and together we will find out your needs. After that we will offer you exactly what you need.You know, nowadays we have also faced the problem of choice. All these new technologies that surround us, they became so much more available and many stores use them to represent us numerous goods. And often we are not even sure if it’s necessary to purchase it. But this problem is not about this case because even if you haven’t decided that you need this product we will gladly help you and together we will find out your needs. After that we will offer you exactly what you need.', 'Vietnam', 13, 1),
(13, 'Good chair', 1450000, 1450000, 'Outdoor-Chaise-Lounge-Biarritz-Lounge-Chair-1.png', 'You know, nowadays we have also faced the problem of choice. All these new technologies that surround us, they became so much more available and many stores use them to represent us numerous goods. And often we are not even sure if it’s necessary to purchase it. But this problem is not about this case because even if you haven’t decided that you need this product we will gladly help you and together we will find out your needs. After that we will offer you exactly what you need.', 'Vietnam', 4, 1),
(14, 'Green Umbrella', 390000, 390000, '9_outdoor_market_umbrella_in_lime_green_2.png', 'We are offering you our tremendous choice of different kinds of furniture. It is totally safe for your health. It has passed many various tests without a single failure. This product has unique design and many special options which could indeed help you. You know, nowadays good design is a really important thing. Fashion in this case is really interesting phenomenon - we often like things that are good-looking. And it is normal - after all we get maximum information through the eyes. And our product is a perfect combination of cute shapes and real good content.', 'Vietnam', 8, 1),
(18, 'Airm-chair', 1500000, 1500000, 'product11_resized.png', 'You know, nowadays we have also faced the problem of choice. All these new technologies that surround us, they became so much more available and many stores use them to represent us numerous goods. And often we are not even sure if it’s necessary to purchase it. But this problem is not about this case because even if you haven’t decided that you need this product we will gladly help you and together we will find out your needs. After that we will offer you exactly what you need.', 'Việt Nam', 4, 1),
(19, 'Red sofar', 1500000, 1500000, 'product02_resized.png', 'We are offering you our tremendous choice of different kinds of furniture. It is totally safe for your health. It has passed many various tests without a single failure. This product has unique design and many special options which could indeed help you. You know, nowadays good design is a really important thing. Fashion in this case is really interesting phenomenon - we often like things that are good-looking. And it is normal - after all we get maximum information through the eyes. And our product is a perfect combination of cute shapes and real good content.', 'Japan', 4, 1),
(21, 'Rug', 1000000, 1000000, 'Koko-Trees-Plastic-Floormat-1.png', 'You know, nowadays we have also faced the problem of choice. All these new technologies that surround us, they became so much more available and many stores use them to represent us numerous goods. And often we are not even sure if it’s necessary to purchase it. But this problem is not about this case because even if you haven’t decided that you need this product we will gladly help you and together we will find out your needs. After that we will offer you exactly what you need.', 'Vietnam', 4, 1),
(43, 'Grey Sofar', 1800000, 1800000, 'product05_resized.png', 'You know, nowadays we have also faced the problem of choice. All these new technologies that surround us, they became so much more available and many stores use them to represent us numerous goods. And often we are not even sure if it’s necessary to purchase it. But this problem is not about this case because even if you haven’t decided that you need this product we will gladly help you and together we will find out your needs. After that we will offer you exactly what you need.', 'Vietnam', 1, 1),
(48, 'New chair', 11000000, 11000000, 'product32_resized.png', 'You know, nowadays we have also faced the problem of choice. All these new technologies that surround us, they became so much more available and many stores use them to represent us numerous goods. And often we are not even sure if it’s necessary to purchase it. But this problem is not about this case because even if you haven’t decided that you need this product we will gladly help you and together we will find out your needs. After that we will offer you exactly what you need.', 'Vietnam', 4, 1),
(60, 'New product', 12300000, 12300000, '10_market_umbrella_in_autumn_red_1.png', '12342134123', 'Vietnam', 1, 1),
(61, 'Attractive round chair new', 10000000, 10000000, 'product15_resized.png', '12342134123', 'Japan', 12, 1),
(62, 'New product', 1000000, 1000000, 'garden_trading_co_belfast_wall_lamp_clay_1.png', 'kjalksdj alksd adkasjd lasdkasdsad', 'Việt Nam', 12, 1),
(56, 'New umbrella', 12000000, 12000000, '11_wood_market_umbrella_1.png', '12342134123', 'Japan', 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pro_cate`
--

CREATE TABLE IF NOT EXISTS `pro_cate` (
  `pro_id` int(11) NOT NULL,
  `cate_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pro_cate`
--

INSERT INTO `pro_cate` (`pro_id`, `cate_id`) VALUES
(3, 7),
(4, 4),
(5, 1),
(5, 2),
(7, 1),
(7, 6),
(8, 1),
(8, 5),
(12, 1),
(12, 6),
(10, 7),
(11, 1),
(11, 5),
(13, 1),
(13, 5),
(14, 4),
(18, 1),
(18, 6),
(56, 4),
(19, 1),
(19, 5),
(21, 1),
(21, 3),
(43, 1),
(43, 6),
(48, 1),
(62, 1),
(62, 2),
(60, 4),
(1, 1),
(1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE IF NOT EXISTS `sliders` (
  `pro_id` int(11) NOT NULL,
  `img_link` text NOT NULL,
  `img_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`pro_id`, `img_link`, `img_order`) VALUES
(1, 'attractive_round_chair_on_low_revolving_base_1_copy.png', 1),
(5, 'john_lewis_cleve_outdoor_wall_lantern_1.png', 2),
(12, 'product07_resized.png', 3),
(10, 'Biscayne-High-Top-Bistro-Table-1.png', 4),
(19, 'product02_resized.png', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `address` text NOT NULL,
  `phone` text NOT NULL,
  `gender` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `address`, `phone`, `gender`, `level`) VALUES
(1, 'nguyenphong', '69f861c327125a21830e476c2f97e1e6', 'phongnd1@smartosc.com', 'Hà Nội', '1678073560', 1, 2),
(2, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'admin@smartosc.com', 'Hà Nội', '1233456567', 1, 1),
(3, 'admin2', 'e10adc3949ba59abbe56e057f20f883e', 'admin2@gmail.com', 'Hà Nội', '12345678909', 1, 1),
(6, 'admin5', 'e10adc3949ba59abbe56e057f20f883e', 'admin5@smartosc.com', 'Hà Nội', '12345678909', 1, 1),
(19, 'nhattv', 'e10adc3949ba59abbe56e057f20f883e', 'nhattv@smartosc.com', 'Hà Nội', '0123456789', 2, 2),
(18, 'minhpv', 'e10adc3949ba59abbe56e057f20f883e', 'minhpv@smartosc.com', 'Hà Nội', '0987654321', 1, 2),
(16, 'toanlv', 'e10adc3949ba59abbe56e057f20f883e', 'toanlv@smartosc.com', 'Hà Nội', '0123456789', 1, 2),
(15, 'luanvd', 'e10adc3949ba59abbe56e057f20f883e', 'luanvd@smartosc.vom', 'Ha Noi', '0987654321', 1, 2),
(21, 'guess2', 'e10adc3949ba59abbe56e057f20f883e', 'guess2@smartosc.com', 'Hà Nội', '0123456789', 2, 2),
(20, 'guess1', 'e10adc3949ba59abbe56e057f20f883e', 'guess1@smartosc.com', 'Hà Nội', '0123456789', 2, 2),
(22, 'guess', 'e10adc3949ba59abbe56e057f20f883e', 'guess@smartosc.com', 'Hà Nội', '0123456789', 2, 2),
(30, 'test1', '123456', 'test@gmail.com', 'Hà Nội', '0987654321', 1, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
