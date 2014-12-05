-- phpMyAdmin SQL Dump
-- version 4.2.8.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 05, 2014 at 10:19 AM
-- Server version: 5.6.21
-- PHP Version: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rms`
--

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE IF NOT EXISTS `room` (
`room_id` int(5) NOT NULL,
  `room_name` varchar(50) DEFAULT NULL,
  `floor` int(2) DEFAULT NULL,
  `size` int(5) DEFAULT NULL,
  `building_id` int(3) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_name`, `floor`, `size`, `building_id`) VALUES
(5, 'AK116', 1, 206, 3),
(6, 'AK219', 2, 86, 3),
(7, 'AK232', 2, 34, 3),
(8, 'AK233', 2, 70, 3),
(9, 'AK227', 2, 25, 3),
(10, 'Upper Perreault Hall', 1, 196, 4),
(11, 'Lower Perreault Hall', 0, 100, 4),
(12, 'FL311', 3, 38, 4),
(13, 'FL320', 3, 65, 4),
(14, 'FL222', 2, 27, 4),
(15, 'Gateway Park 1002', 1, 89, 5),
(16, 'GH012', 0, 30, 6),
(17, 'GH227', 2, 80, 6),
(18, 'HL114', 1, 35, 7),
(19, 'HL116', 1, 90, 7),
(20, 'HL154', 1, 35, 7),
(21, 'HL202', 2, 35, 7),
(22, 'HL218', 2, 90, 7),
(23, 'HL230', 2, 40, 7),
(24, 'KH115', 1, 26, 8),
(25, 'KH116', 1, 70, 8),
(26, 'KH202', 2, 25, 8),
(27, 'KH204', 2, 25, 8),
(28, 'KH207', 2, 30, 8),
(29, 'OL107', 1, 205, 9),
(30, 'OL109', 1, 37, 9),
(31, 'OL126', 1, 35, 9),
(32, 'OL218', 2, 35, 9),
(33, 'OL223', 2, 42, 9),
(34, 'SL011', 0, 45, 10),
(35, 'SL104', 1, 76, 10),
(36, 'SL105', 1, 54, 10),
(37, 'SL115', 1, 220, 10),
(38, 'SL123', 1, 28, 10),
(39, 'SL305', 3, 60, 10),
(40, 'SL402', 4, 60, 10),
(41, 'SL406', 4, 48, 10),
(42, 'SL407', 4, 36, 10),
(43, 'SL411', 4, 60, 10),
(44, 'SH003', 0, 45, 11),
(45, 'SH106', 1, 35, 11),
(46, 'SH202', 2, 45, 11),
(47, 'SH203', 2, 30, 11),
(48, 'SH304', 3, 35, 11),
(49, 'SH306', 3, 52, 11),
(50, 'SH308', 3, 54, 11),
(51, 'SH309', 3, 48, 11),
(52, 'WS228', 2, 36, 12),
(53, 'WS229', 2, 85, 12),
(54, 'WS323', 3, 36, 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `room`
--
ALTER TABLE `room`
 ADD PRIMARY KEY (`room_id`), ADD KEY `fk_room_building` (`building_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
MODIFY `room_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=55;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `room`
--
ALTER TABLE `room`
ADD CONSTRAINT `fk_room_building` FOREIGN KEY (`building_id`) REFERENCES `building` (`building_id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
