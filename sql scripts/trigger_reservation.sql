DROP TRIGGER ck_BackDateBeforeInsert;
DROP TRIGGER ck_BackDateBeforeUpdate;

CREATE TRIGGER `ck_BackDateBeforeInsert` BEFORE INSERT ON `reservation`
 FOR EACH ROW BEGIN
	DECLARE RoomSize INTEGER;
	SELECT size INTO RoomSize FROM room WHERE room_id = NEW.room_id;
	IF NEW.num_people > RoomSize THEN
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Overload! Choose different Room';

    END IF;
	IF NEW.start_date < NOW() OR NEW.end_date < NOW() THEN
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Date cannot be in the past!';
	END IF;
    
END

CREATE TRIGGER `ck_BackDateBeforeUpdate` BEFORE UPDATE ON `reservation`
 FOR EACH ROW BEGIN
	DECLARE RoomSize INTEGER;
	SELECT size INTO RoomSize FROM room WHERE room_id = NEW.room_id;
	IF NEW.num_people > RoomSize THEN
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Overload! Choose different Room';

    END IF;
	IF NEW.start_date < NOW() OR NEW.end_date < NOW() THEN
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Date cannot be in the past!';
	END IF;
END