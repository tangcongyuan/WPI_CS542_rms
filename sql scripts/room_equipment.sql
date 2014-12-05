# MySQL-Front 5.1  (Build 3.18)

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE */;
/*!40101 SET SQL_MODE='STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES */;
/*!40103 SET SQL_NOTES='ON' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;


# Host: localhost    Database: rms
# ------------------------------------------------------
# Server version 5.6.22-log

USE `rms`;

#
# Source for table room_equipment
#

DROP TABLE IF EXISTS `room_equipment`;
CREATE TABLE `room_equipment` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `equipment_id` int(3) DEFAULT NULL,
  `room_id` int(5) DEFAULT NULL,
  `no_item` int(3) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_room_equip` (`room_id`),
  KEY `FK_equip_room` (`equipment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Dumping data for table room_equipment
#
LOCK TABLES `room_equipment` WRITE;
/*!40000 ALTER TABLE `room_equipment` DISABLE KEYS */;

INSERT INTO `room_equipment` VALUES (1,1,1,1);
INSERT INTO `room_equipment` VALUES (2,2,1,1);
/*!40000 ALTER TABLE `room_equipment` ENABLE KEYS */;
UNLOCK TABLES;

#
#  Foreign keys for table room_equipment
#

ALTER TABLE `room_equipment`
ADD CONSTRAINT `FK_equip_room` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`equipment_id`) ON DELETE NO ACTION,
ADD CONSTRAINT `FK_room_equip` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE NO ACTION;


/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
