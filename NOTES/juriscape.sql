/*
SQLyog Community v13.1.5  (64 bit)
MySQL - 10.3.16-MariaDB : Database - juriscape
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `students` */

DROP TABLE IF EXISTS `students`;

CREATE TABLE `students` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `standard` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `students` */

insert  into `students`(`id`,`name`,`standard`) values 
(1,'Ayan Sen',10),
(2,'Anirban Basak',11),
(3,'Rajatabha Dutta',12),
(4,'Prasenjit Chatterjee',9),
(5,'Amitava Bachhan',12),
(6,'Anup Sinha',11),
(7,'Virat Kohli',10),
(8,'Sachin Tendulkar',7),
(9,'Narendra Damodar Modi',1),
(10,'Kishore Kumar',11),
(11,'Animesh Ghosh',8),
(12,'Abhirup Sardar',5),
(13,'Riju Paul',7),
(14,'Rahul Bose',3),
(15,'Bivu Dutta',9),
(16,'Chandan Chachoi',6),
(17,'David Dhawan',12),
(18,'Papai Mondol',10),
(19,'Md. Nasiruddin Shah',8),
(20,'Samuel Gomes',1);

/*Table structure for table `students_subjects` */

DROP TABLE IF EXISTS `students_subjects`;

CREATE TABLE `students_subjects` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `studentid` bigint(25) NOT NULL,
  `subjectid` bigint(25) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_studentid` (`studentid`),
  KEY `fk_subjectid` (`subjectid`),
  CONSTRAINT `fk_studentid` FOREIGN KEY (`studentid`) REFERENCES `students` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_subjectid` FOREIGN KEY (`subjectid`) REFERENCES `subjects` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

/*Data for the table `students_subjects` */

insert  into `students_subjects`(`id`,`studentid`,`subjectid`) values 
(1,1,4),
(2,1,3),
(3,2,1),
(4,2,2),
(5,3,2),
(6,3,3),
(7,4,4),
(8,5,4),
(9,5,3),
(10,6,4),
(11,6,1),
(12,7,3),
(13,8,3),
(14,8,4),
(15,9,2),
(16,10,4),
(17,10,1),
(18,11,4),
(19,11,2),
(20,12,4),
(21,12,3),
(22,13,1),
(23,14,4),
(24,14,1),
(25,15,2),
(26,15,3),
(27,16,4),
(28,16,2),
(32,18,4),
(33,19,1),
(34,19,2),
(35,20,4),
(36,17,4),
(37,17,1),
(38,17,3);

/*Table structure for table `subjects` */

DROP TABLE IF EXISTS `subjects`;

CREATE TABLE `subjects` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `subjects` */

insert  into `subjects`(`id`,`name`) values 
(1,'Mathematics'),
(2,'Science'),
(3,'Social Science'),
(4,'Hindi');

/* Function  structure for function  `URLENCODE` */

/*!50003 DROP FUNCTION IF EXISTS `URLENCODE` */;
DELIMITER $$

/*!50003 CREATE FUNCTION `URLENCODE`(str VARCHAR(4096) CHARSET utf8) RETURNS varchar(4096) CHARSET utf8
    DETERMINISTIC
BEGIN
   -- the individual character we are converting in our loop
   -- NOTE: must be VARCHAR even though it won't vary in length
   -- CHAR(1), when used with SUBSTRING, made spaces '' instead of ' '
   DECLARE sub VARCHAR(1) CHARSET utf8;
   -- the ordinal value of the character (i.e. ñ becomes 50097)
   DECLARE val BIGINT DEFAULT 0;
   -- the substring index we use in our loop (one-based)
   DECLARE ind INT DEFAULT 1;
   -- the integer value of the individual octet of a character being encoded
   -- (which is potentially multi-byte and must be encoded one byte at a time)
   DECLARE oct INT DEFAULT 0;
   -- the encoded return string that we build up during execution
   DECLARE ret VARCHAR(4096) DEFAULT '';
   -- our loop index for looping through each octet while encoding
   DECLARE octind INT DEFAULT 0;

   IF ISNULL(str) THEN
      RETURN NULL;
   ELSE
      SET ret = '';
      -- loop through the input string one character at a time - regardless
      -- of how many bytes a character consists of
      WHILE ind <= CHAR_LENGTH(str) DO
         SET sub = MID(str, ind, 1);
         SET val = ORD(sub);
         -- these values are ones that should not be converted
         -- see http://tools.ietf.org/html/rfc3986
         IF NOT (val BETWEEN 48 AND 57 OR     -- 48-57  = 0-9
                 val BETWEEN 65 AND 90 OR     -- 65-90  = A-Z
                 val BETWEEN 97 AND 122 OR    -- 97-122 = a-z
                 -- 45 = hyphen, 46 = period, 95 = underscore, 126 = tilde
                 val IN (45, 46, 95, 126)) THEN
            -- This is not an &quot;unreserved&quot; char and must be encoded:
            -- loop through each octet of the potentially multi-octet character
            -- and convert each into its hexadecimal value
            -- we start with the high octect because that is the order that ORD
            -- returns them in - they need to be encoded with the most significant
            -- byte first
            SET octind = OCTET_LENGTH(sub);
            WHILE octind > 0 DO
               -- get the actual value of this octet by shifting it to the right
               -- so that it is at the lowest byte position - in other words, make
               -- the octet/byte we are working on the entire number (or in even
               -- other words, oct will no be between zero and 255 inclusive)
               SET oct = (val >> (8 * (octind - 1)));
               -- we append this to our return string with a percent sign, and then
               -- a left-zero-padded (to two characters) string of the hexadecimal
               -- value of this octet)
               SET ret = CONCAT(ret, '%', LPAD(HEX(oct), 2, 0));
               -- now we need to reset val to essentially zero out the octet that we
               -- just encoded so that our number decreases and we are only left with
               -- the lower octets as part of our integer
               SET val = (val & (POWER(256, (octind - 1)) - 1));
               SET octind = (octind - 1);
            END WHILE;
         ELSE
            -- this character was not one that needed to be encoded and can simply be
            -- added to our return string as-is
            SET ret = CONCAT(ret, sub);
         END IF;
         SET ind = (ind + 1);
      END WHILE;
   END IF;
   RETURN ret;
END */$$
DELIMITER ;

/*Table structure for table `view_students` */

DROP TABLE IF EXISTS `view_students`;

/*!50001 DROP VIEW IF EXISTS `view_students` */;
/*!50001 DROP TABLE IF EXISTS `view_students` */;

/*!50001 CREATE TABLE  `view_students`(
 `studentid` bigint(25) ,
 `studentname` varchar(255) ,
 `standard` tinyint(2) ,
 `subjectid` mediumtext ,
 `subjectname` mediumtext 
)*/;

/*View structure for view view_students */

/*!50001 DROP TABLE IF EXISTS `view_students` */;
/*!50001 DROP VIEW IF EXISTS `view_students` */;

/*!50001 CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_students` AS select `ss`.`studentid` AS `studentid`,`st`.`name` AS `studentname`,`st`.`standard` AS `standard`,group_concat(`ss`.`subjectid` order by `ss`.`subjectid` ASC separator ',') AS `subjectid`,group_concat(`sb`.`name` order by `ss`.`subjectid` ASC separator ',') AS `subjectname` from ((`students_subjects` `ss` left join `students` `st` on(`st`.`id` = `ss`.`studentid`)) left join `subjects` `sb` on(`sb`.`id` = `ss`.`subjectid`)) group by `ss`.`studentid` */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
