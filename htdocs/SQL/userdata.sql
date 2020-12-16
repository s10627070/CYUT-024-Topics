-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `userdata`;
CREATE TABLE `userdata` (
  `UserId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `UserName` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserAcc` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserPass` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `passport` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `City` char(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `getpasstime` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`UserId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `userdata` (`UserId`, `UserName`, `UserAcc`, `UserPass`, `passport`, `email`, `City`, `getpasstime`) VALUES
(1,	'root',	'root',	'16d9e5088f6b25c5f505d697751714b7f635d415',	'A123456789',	'jack125969860@gmail.com',	'基隆市',	NULL);

-- 2020-10-04 15:02:37
