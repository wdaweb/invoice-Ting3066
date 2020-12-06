-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2020-12-06 17:03:38
-- 伺服器版本： 10.4.14-MariaDB
-- PHP 版本： 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `invoice`
--

-- --------------------------------------------------------

--
-- 資料表結構 `award_numbers`
--

CREATE TABLE `award_numbers` (
  `id` int(11) UNSIGNED NOT NULL,
  `year` year(4) NOT NULL,
  `period` tinyint(1) NOT NULL,
  `number` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `award_numbers`
--

INSERT INTO `award_numbers` (`id`, `year`, `period`, `number`, `type`) VALUES
(155, 2020, 5, '26359468', 1),
(156, 2020, 5, '73625489', 2),
(157, 2020, 5, '15968524', 3),
(158, 2020, 5, '73562854', 3),
(159, 2020, 5, '99356201', 3),
(160, 2020, 5, '154', 4),
(161, 2020, 5, '789', 4),
(162, 2020, 5, '560', 4),
(163, 2020, 6, '74521863', 1),
(164, 2020, 6, '16953862', 2),
(165, 2020, 6, '48570125', 3),
(166, 2020, 6, '36369854', 3),
(167, 2020, 6, '48302569', 3),
(168, 2020, 6, '159', 4),
(169, 2020, 6, '765', 4),
(170, 2020, 6, '304', 4);

-- --------------------------------------------------------

--
-- 資料表結構 `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) UNSIGNED NOT NULL,
  `code` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `period` tinyint(1) UNSIGNED NOT NULL,
  `payment` int(11) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `invoices`
--

INSERT INTO `invoices` (`id`, `code`, `number`, `period`, `payment`, `date`, `create_time`) VALUES
(21, 'AS', '12345678', 6, 100, '2020-11-30', '2020-12-05 13:58:14'),
(25, 'AS', '48593260', 6, 100, '2020-12-01', '2020-12-06 08:33:49'),
(26, 'AS', '74521863', 6, 480, '2020-11-27', '2020-12-06 09:26:40'),
(27, 'AS', '16953862', 6, 700, '2020-11-17', '2020-12-06 09:38:58'),
(28, 'AS', '48570125', 6, 280, '2020-11-14', '2020-12-06 09:39:38'),
(29, 'AS', '96369854', 6, 60, '2020-11-21', '2020-12-06 09:40:24'),
(30, 'AS', '56302569', 6, 200, '2020-12-04', '2020-12-06 09:40:49'),
(31, 'AS', '66802569', 6, 400, '2020-11-24', '2020-12-06 09:41:26'),
(32, 'AS', '63252569', 6, 50, '2020-12-01', '2020-12-06 09:41:45'),
(33, 'AS', '64857569', 6, 200, '2020-11-29', '2020-12-06 09:42:20'),
(34, 'AS', '48659304', 6, 130, '2020-11-02', '2020-12-06 09:42:41'),
(35, 'AD', '65953270', 5, 150, '2020-10-05', '2020-12-06 14:54:49');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `award_numbers`
--
ALTER TABLE `award_numbers`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `award_numbers`
--
ALTER TABLE `award_numbers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
