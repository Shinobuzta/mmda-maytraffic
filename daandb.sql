-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2013 at 04:37 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `daandb`
--
CREATE DATABASE IF NOT EXISTS `daandb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `daandb`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_location`
--

CREATE TABLE IF NOT EXISTS `tbl_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `tbl_location`
--

INSERT INTO `tbl_location` (`id`, `code`, `name`) VALUES
(1, '1_1', 'Balintawak'),
(2, '1_2', 'Kaingin Road'),
(3, '1_3', 'Muñoz'),
(4, '1_4', 'Bansalangin'),
(5, '1_5', 'North Ave.'),
(6, '1_6', 'Trinoma'),
(7, '1_7', 'Quezon Ave.'),
(8, '1_8', 'NIA Road'),
(9, '1_9', 'Timog'),
(10, '1_10', 'Kamuning'),
(11, '1_11', 'New York - Nepa Q-Mart'),
(12, '1_12', 'Monte De Piedad'),
(13, '1_13', 'Aurora Blvd.'),
(14, '1_14', 'Mc Arthur - Farmers'),
(15, '1_15', 'P. Tuazon'),
(16, '1_16', 'Main Ave.'),
(17, '1_17', 'Santolan'),
(18, '1_18', 'White Plains - Connecticut	'),
(19, '1_19', 'Ortigas Ave.'),
(20, '1_20', 'SM Megamall'),
(21, '1_21', 'Shaw Blvd.'),
(22, '1_22', 'Reliance'),
(23, '1_23', 'Pioneer - Boni'),
(24, '1_24', 'Guadalupe'),
(25, '1_25', 'Orense'),
(26, '1_26', 'Kalayaan - Estrella'),
(27, '1_27', 'Buendia'),
(28, '1_28', 'Ayala Ave.'),
(29, '1_29', 'Arnaiz - Pasay Road'),
(30, '1_30', 'Magallanes'),
(31, '1_31', 'Malibay'),
(32, '1_32', 'Tramo'),
(33, '1_33', 'Taft Ave.'),
(34, '1_34', 'F.B. Harrison'),
(35, '1_35', 'Roxas Boulevard'),
(36, '1_36', 'Macapagal Ave.'),
(37, '1_37', 'Mall of Asia');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
