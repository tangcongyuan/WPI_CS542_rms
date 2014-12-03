# MySQL-Front 5.1  (Build 3.18)

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE */;
/*!40101 SET SQL_MODE='' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES */;
/*!40103 SET SQL_NOTES='ON' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;


# Host: localhost    Database: rms
# ------------------------------------------------------
# Server version 5.1.60-community

USE `rms`;

#
# Source for table user
#

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(5) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(50) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `usertype` int(1) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `FK_user_role` (`usertype`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

#
# Dumping data for table user
#
LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` VALUES (1,'admin','81dc9bdb52d04dc20036dbd8313ed055','Administrator','RMS',3);
INSERT INTO `user` VALUES (2,'approver','81dc9bdb52d04dc20036dbd8313ed055','hey','hey',2);
INSERT INTO `user` VALUES (3,'reserver','81dc9bdb52d04dc20036dbd8313ed055','111','111',1);
INSERT INTO `user` VALUES (4,'yuhu','b7f68bb19bde0d7787e67053b4acd3b9','Yuhu','huyu',2);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

#
#  Foreign keys for table user
#

ALTER TABLE `user`
ADD CONSTRAINT `FK_user_role` FOREIGN KEY (`usertype`) REFERENCES `role` (`Id`) ON DELETE NO ACTION;


/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
