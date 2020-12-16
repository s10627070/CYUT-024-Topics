-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2020-12-13 11:26:49
-- 伺服器版本： 10.4.14-MariaDB
-- PHP 版本： 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `nobody`
--

-- --------------------------------------------------------

--
-- 資料表結構 `ecpay`
--

CREATE TABLE `ecpay` (
  `MerchantTradeNo` varchar(100) NOT NULL COMMENT '訂單id',
  `TradeAmt` int(11) NOT NULL COMMENT '交易金額',
  `PaymentTypeChargeFee` int(11) NOT NULL COMMENT '手續費',
  `RtnMsg` varchar(10) NOT NULL COMMENT '交易訊息',
  `RtnCode` tinyint(1) NOT NULL COMMENT '交易狀態',
  `PaymentType` varchar(20) NOT NULL COMMENT '付款方式',
  `PaymentDate` datetime NOT NULL COMMENT '訂單成立時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `ecpay`
--

INSERT INTO `ecpay` (`MerchantTradeNo`, `TradeAmt`, `PaymentTypeChargeFee`, `RtnMsg`, `RtnCode`, `PaymentType`, `PaymentDate`) VALUES
('J2020120355100', 7400, 148, '交易成功', 1, 'Credit_CreditCard', '2020-12-03 23:06:18'),
('J2020121350564', 2100, 0, '付款成功', 1, 'Credit_CreditCard', '2020-12-13 18:17:13'),
('J2020121399495', 1300, 26, '交易成功', 1, 'Credit_CreditCard', '2020-12-13 18:20:14');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `ecpay`
--
ALTER TABLE `ecpay`
  ADD PRIMARY KEY (`MerchantTradeNo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
