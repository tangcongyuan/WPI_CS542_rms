# MySQL-Front 5.1  (Build 3.18)

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE */;
/*!40101 SET SQL_MODE='STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES */;
/*!40103 SET SQL_NOTES='ON' */;


# Host: localhost    Database: rms
# ------------------------------------------------------
# Server version 5.6.22-log

USE `rms`;

#
# Source for trigger ck_BackDateBeforeUpdate
#

DROP TRIGGER IF EXISTS `rms`.`ck_BackDateBeforeUpdate`;
CREATE DEFINER='root'@'localhost' TRIGGER `rms`.`ck_BackDateBeforeUpdate` BEFORE UPDATE ON `rms`.`reservation`
  FOR EACH ROW BEGIN
	DECLARE RoomSize INTEGER;
	SELECT size INTO RoomSize FROM room WHERE room_id = NEW.room_id;
	IF NEW.num_people > RoomSize THEN
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Overload! Choose different Room';

    END IF;
	IF NEW.start_date < NOW() OR NEW.end_date < NOW() THEN
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Date cannot be in the past!';
	END IF;
END;


#
# Source for trigger ck_BackDateBeforeInsert
#

DROP TRIGGER IF EXISTS `rms`.`ck_BackDateBeforeInsert`;
CREATE DEFINER='root'@'localhost' TRIGGER `rms`.`ck_BackDateBeforeInsert` BEFORE INSERT ON `rms`.`reservation`
  FOR EACH ROW BEGIN
	DECLARE RoomSize INTEGER;
	SELECT size INTO RoomSize FROM room WHERE room_id = NEW.room_id;
	IF NEW.num_people > RoomSize THEN
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Overload! Choose different Room';

    END IF;
	IF NEW.start_date < NOW() OR NEW.end_date < NOW() THEN
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Date cannot be in the past!';
	END IF;
    
END;


/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
