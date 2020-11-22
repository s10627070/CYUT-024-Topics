-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `room`;
CREATE TABLE `room` (
  `num` int(10) unsigned NOT NULL,
  `type` varchar(10) NOT NULL,
  `UserName` varchar(8) CHARACTER SET utf32 COLLATE utf32_unicode_ci DEFAULT NULL,
  `phone` int(10) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `date2` date DEFAULT NULL,
  `sum` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `room` (`num`, `type`, `UserName`, `phone`, `date`, `date2`, `sum`) VALUES
(1,	'豪華房(36000)',	' ',	0,	'0000-00-00',	'0000-00-00',	'未訂房'),
(2,	'一般房(26000)',	' ',	0,	'0000-00-00',	'0000-00-00',	'未訂房'),
(3,	'普通房(10000)',	' ',	0,	'0000-00-00',	'0000-00-00',	'未訂房');

INSERT INTO `userdata` (`UserId`, `UserAcc`, `UserPass`, `UserName`, `eMail`, `City`) VALUES
(1,	'user',	'd8dd7378df387f09911da6b60e5c879b45e54468',	'CCL',	'jack125969860@gmail.com',	'澎湖縣');

-- 2020-09-02 05:35:56
