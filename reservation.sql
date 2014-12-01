-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 01, 2014 at 07:12 AM
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
-- Table structure for table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
`reservation_id` int(10) NOT NULL,
  `reserver_id` int(5) DEFAULT NULL,
  `room_id` int(5) DEFAULT NULL,
  `num_people` int(10) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `activity` text,
  `status` int(1) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `building_id` int(3) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reservation_id`, `reserver_id`, `room_id`, `num_people`, `start_date`, `end_date`, `activity`, `status`, `reason`, `building_id`) VALUES
(1, 1, 2, 10, '2014-11-26 11:00:00', NULL, 'Meeting with Prof', 1, '', 2),
(3, 2, 2, 20, '2014-11-13 09:00:00', NULL, 'Teaching', 1, '', 2),
(4, 2, 1, 1, '2014-11-27 14:00:00', '2014-11-27 14:30:00', 'Tutoring', 1, '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
 ADD PRIMARY KEY (`reservation_id`), ADD KEY `FK_reserver` (`reserver_id`), ADD KEY `FK_room_res` (`room_id`), ADD KEY `fk_reservation_status` (`status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
MODIFY `reservation_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
ADD CONSTRAINT `FK_reserver` FOREIGN KEY (`reserver_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION,
ADD CONSTRAINT `FK_room_res` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE NO ACTION,
ADD CONSTRAINT `fk_reservation_status` FOREIGN KEY (`status`) REFERENCES `reservation_status` (`status_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
