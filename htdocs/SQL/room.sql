-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `room`;
CREATE TABLE `room` (
  `num` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(10) CHARACTER SET utf8mb4 NOT NULL,
  `UserName` varchar(8) CHARACTER SET utf32 COLLATE utf32_unicode_ci DEFAULT NULL,
  `phone` int(10) DEFAULT NULL,
  `date1` date DEFAULT NULL,
  `date2` date DEFAULT NULL,
  `plus` int(10) NOT NULL,
  `totalprices` int(10) DEFAULT NULL,
  `sum` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pay` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- 2020-10-04 15:02:31
