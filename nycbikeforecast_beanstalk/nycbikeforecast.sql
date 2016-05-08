-- phpMyAdmin SQL Dump
-- version 4.0.0-beta1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 25, 2013 at 07:18 PM
-- Server version: 5.1.37
-- PHP Version: 5.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nycbikeforecast`
--

-- --------------------------------------------------------

--
-- Table structure for table `stationBeanList`
--

CREATE TABLE IF NOT EXISTS `stationBeanList` (
  `parseTime` bigint(20) NOT NULL,
  `executionTime` bigint(20) NOT NULL,
  `id` int(11) NOT NULL,
  `stationName` varchar(255) NOT NULL,
  `availableDocks` smallint(6) NOT NULL,
  `totalDocks` smallint(6) NOT NULL,
  `latitude` decimal(11,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `statusValue` varchar(255) NOT NULL,
  `statusKey` smallint(6) DEFAULT NULL,
  `availableBikes` smallint(6) NOT NULL,
  `stAddress1` varchar(255) DEFAULT NULL,
  `stAddress2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `postalCode` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `altitude` decimal(11,8) DEFAULT NULL,
  `testStation` varchar(255) DEFAULT NULL,
  `lastCommunicationTime` varchar(255) DEFAULT NULL,
  `landMark` varchar(255) DEFAULT NULL,
  KEY `id_idx` (`id`),
  KEY `parseTime` (`parseTime`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `stationbeanlistview`
--
CREATE TABLE IF NOT EXISTS `stationbeanlistview` (
`parseTime` bigint(20)
,`id` int(11)
,`availableDocks` smallint(6)
,`totalDocks` smallint(6)
,`latitude` decimal(11,8)
,`longitude` decimal(11,8)
,`statusValue` varchar(255)
,`availableBikes` smallint(6)
);
-- --------------------------------------------------------

--
-- Structure for view `stationbeanlistview`
--
DROP TABLE IF EXISTS `stationbeanlistview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `stationbeanlistview` AS select `stationbeanlist`.`parseTime` AS `parseTime`,`stationbeanlist`.`id` AS `id`,`stationbeanlist`.`availableDocks` AS `availableDocks`,`stationbeanlist`.`totalDocks` AS `totalDocks`,`stationbeanlist`.`latitude` AS `latitude`,`stationbeanlist`.`longitude` AS `longitude`,`stationbeanlist`.`statusValue` AS `statusValue`,`stationbeanlist`.`availableBikes` AS `availableBikes` from `stationbeanlist` where (`stationbeanlist`.`statusValue` = 'In Service');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
