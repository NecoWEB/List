-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 08, 2023 at 05:47 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `email`, `password`) VALUES
(1, 'nemanjakosanovic@gmail.com', 'testList');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id_customer` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `email_expire_token` datetime DEFAULT NULL,
  `email_conf_token` varchar(255) NOT NULL,
  `pass_expire_token` datetime DEFAULT NULL,
  `pass_conf_token` varchar(255) DEFAULT NULL,
  `banned` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_customer`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `email`, `password`, `firstname`, `active`, `email_expire_token`, `email_conf_token`, `pass_expire_token`, `pass_conf_token`, `banned`) VALUES
(2, 'tester@tee.com', '$2y$10$Hc1Gbst5Wb/kT3DcoHIf6OMQhkBsCDsMZgG/B2L1fJpETjHkoViQi', 'test', 0, '2023-09-08 00:06:31', 'fd21be76103eac243992dc8e2810ee8c109f3ae4', NULL, NULL, 1),
(3, 'asdasdadasd@tee.com', '$2y$10$ColYTu7PPXhEgqId7aCiWO1aigmsqitj1BhAr8yjefRe7KdyZIy/S', 'test', 0, '2023-09-08 00:06:59', '755ff81800d867b4f14efe6bd8606713830454e6', NULL, NULL, 0),
(4, 'asdasdadasd@teeee.com', '$2y$10$qS1l/Q4SVYKa3ItVjnUQAePWSxifzqvPacDakhI9if2mEEUqq3uNu', 'test', 0, '2023-09-08 00:14:50', '46d49ac430407eaa71af370f21676e1395bea0a9', NULL, NULL, 0),
(5, 'adasd@teeee.com', '$2y$10$jjD21s9gOR3JpiNVl2l51e53bjZa1Tq1KwGMS3aujozXpcTrjoh2u', 'test', 0, '2023-09-08 00:15:30', '25a7b499b1740b9dcdadb483d9f2e57810db3626', NULL, NULL, 1),
(6, 'brm@teeee.com', '$2y$10$BrwPxTQIaU1AXSOazzXKzu/2YdDjs.GvAS.IlYG/1SctPWr9.B44e', 'test', 1, '0000-00-00 00:00:00', '', NULL, NULL, 0),
(7, 'nemanjakosanovic@test.com', '$2y$10$UiKCMeS7A1vZL2zSp2gI7uiCWs9Fz/cLNOd.4YAGrYTnMxFxuVcxy', 'Nemanja', 0, '2023-09-09 00:55:27', '75d9994b5a406e2c42a2df86418e7a1624edc9df', NULL, NULL, 0),
(8, 'pero@pero.com', '$2y$10$/GRMsRLhyKilZxDM.JRz/.QJlMohLUUr2OZBQjmYe037xwGoSVata', 'Perica', 0, '2023-09-09 00:57:03', '87f63f6e7a188be1688d453520ceb9f1052e9a7d', NULL, NULL, 0),
(9, 'Testinga@tester.com', '$2y$10$MXb4k45y9wZymaLI9qPRmeWZ4A8/XuBixDJRhiZFxLetDT9Z04JVO', 'Test', 0, '2023-09-09 00:57:34', '46b04a02f0db08d15b392d91504a032d4ef9d462', NULL, NULL, 0),
(10, 'teeee@test.com', '$2y$10$N4ph0RcRZ20U78MnEssXP.pucIw.DW6k7B5QpSMIbS7U/roZI9Bpi', 'tteee', 0, '2023-09-09 01:02:28', '6b0a3149bac321385676765cc7c3d487db1affd2', NULL, NULL, 1),
(11, 'tester@nemanjakosanovic.com', '$2y$10$28Zul2OPYtD6/U1EI9GprORVV/w38/ok5ZnJhf4uHqt8dwjs/ZkLW', 'tester', 1, '0000-00-00 00:00:00', '', NULL, NULL, 1),
(12, 'nemanjakosanovic@gmail.com', '$2y$10$unjtKWjE.iGmqIoTSnJ2XeVPMxj65rQCvsGKs1qLKLydNI0SWPszi', 'Nemanja', 1, '0000-00-00 00:00:00', '', NULL, '', 0),
(13, 'testiranje@test.com', '$2y$10$ClJgpy7O4.d6Y2B.2/coNeaZgxYMjQ9uGoGR8xnrKW7IfZM/NMOI6', 'Testiranje', 0, '2023-09-09 05:23:41', 'd923006cf819a2f40edf25f376322b762f46b39d', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id_item` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id_item`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id_item`, `name`) VALUES
(52, 'Pavlaka'),
(53, 'Majonez'),
(54, 'Paprika'),
(55, 'Brašno'),
(62, 'Pringles'),
(66, 'Paradajz'),
(67, 'Borovnica');

-- --------------------------------------------------------

--
-- Table structure for table `list`
--

DROP TABLE IF EXISTS `list`;
CREATE TABLE IF NOT EXISTS `list` (
  `id_list` int(11) NOT NULL AUTO_INCREMENT,
  `id_customer` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `purchase_day` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL,
  `status` enum('created','finished') NOT NULL DEFAULT 'created',
  PRIMARY KEY (`id_list`),
  KEY `id_customer` (`id_customer`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list`
--

INSERT INTO `list` (`id_list`, `id_customer`, `name`, `purchase_day`, `description`, `date_created`, `status`) VALUES
(41, 12, 'testt', '2023-09-12', 'testiranje', '2023-09-08 04:15:44', 'finished'),
(42, 12, 'Testiranje', '2023-09-19', 'Najjaca korpa', '2023-09-08 04:32:21', 'finished'),
(43, 12, 'Testiranje 2', '2023-09-27', 'Testiranje', '2023-09-08 05:07:02', 'finished');

-- --------------------------------------------------------

--
-- Table structure for table `list_items`
--

DROP TABLE IF EXISTS `list_items`;
CREATE TABLE IF NOT EXISTS `list_items` (
  `id_list_item` int(11) NOT NULL AUTO_INCREMENT,
  `id_item` int(11) NOT NULL,
  `id_list` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_list_item`),
  KEY `id_item` (`id_item`),
  KEY `id_list` (`id_list`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_items`
--

INSERT INTO `list_items` (`id_list_item`, `id_item`, `id_list`, `status`) VALUES
(5, 54, 41, '0'),
(6, 54, 42, '0'),
(7, 53, 42, '0'),
(8, 52, 42, '0'),
(9, 55, 43, '0'),
(10, 53, 43, '0');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `list`
--
ALTER TABLE `list`
  ADD CONSTRAINT `list_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`);

--
-- Constraints for table `list_items`
--
ALTER TABLE `list_items`
  ADD CONSTRAINT `list_items_ibfk_1` FOREIGN KEY (`id_list`) REFERENCES `list` (`id_list`),
  ADD CONSTRAINT `list_items_ibfk_2` FOREIGN KEY (`id_item`) REFERENCES `items` (`id_item`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
