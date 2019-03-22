-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 
-- サーバのバージョン： 10.1.38-MariaDB
-- PHP Version: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `dat_member`
--

CREATE TABLE `dat_member` (
  `code` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `password` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal1` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal2` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `danjo` int(11) NOT NULL,
  `born` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `dat_member`
--

INSERT INTO `dat_member` (`code`, `date`, `password`, `name`, `email`, `postal1`, `postal2`, `address`, `tel`, `danjo`, `born`) VALUES
(1, '2019-03-22 04:07:19', '421dff6a9b7711ca1ac302c7ef115dcd', '鈴木一郎', 'ichi@ro.jp', '111', '6666', 'ニューヨーク', '0120111666', 1, 1940),
(2, '2019-03-22 04:13:22', 'd3ac6fcc9df19dcfd43004de650ff390', 'ラーメン二郎', 'ramen@ziro.com', '666', '2626', '都内各種店舗', '09011262626', 2, 2010),
(3, '2019-03-22 04:15:24', '7a2d6798a49d5afa6320a8f6f5049947', '北島三郎', 'saburo@kitazima.jp', '333', '3636', 'NHKホール', '080333666', 1, 1910),
(4, '2019-03-22 04:16:58', '6dfdc384d6025b2ab9b71ec15971aa11', '伊東四朗', 'itoke@sirho.org', '110', '4646', '伊東家の食卓', '070461046', 1, 1990),
(5, '2019-03-22 05:35:31', '6dfdc384d6025b2ab9b71ec15971aa11', '伊東四朗', 'itoke@sirho.org', '110', '4646', '伊東家の食卓', '070461046', 1, 1990);

-- --------------------------------------------------------

--
-- テーブルの構造 `dat_sales`
--

CREATE TABLE `dat_sales` (
  `code` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `code_member` int(11) NOT NULL,
  `name` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal1` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal2` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `dat_sales`
--

INSERT INTO `dat_sales` (`code`, `data`, `code_member`, `name`, `email`, `postal1`, `postal2`, `address`, `tel`) VALUES
(1, '2019-03-22 04:07:19', 1, '鈴木一郎', 'ichi@ro.jp', '111', '6666', 'ニューヨーク', '0120111666'),
(2, '2019-03-22 04:09:25', 1, '鈴木一郎', 'ichi@ro.jp', '111', '6666', 'ニューヨーク', '0120111666'),
(3, '2019-03-22 04:13:22', 2, 'ラーメン二郎', 'ramen@ziro.com', '666', '2626', '都内各種店舗', '09011262626'),
(4, '2019-03-22 04:15:24', 3, '北島三郎', 'saburo@kitazima.jp', '333', '3636', 'NHKホール', '080333666'),
(5, '2019-03-22 04:16:58', 4, '伊東四朗', 'itoke@sirho.org', '110', '4646', '伊東家の食卓', '070461046'),
(6, '2019-03-22 05:35:31', 5, '伊東四朗', 'itoke@sirho.org', '110', '4646', '伊東家の食卓', '070461046');

-- --------------------------------------------------------

--
-- テーブルの構造 `dat_sales_product`
--

CREATE TABLE `dat_sales_product` (
  `code` int(11) NOT NULL,
  `code_sales` int(11) NOT NULL,
  `code_product` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `dat_sales_product`
--

INSERT INTO `dat_sales_product` (`code`, `code_sales`, `code_product`, `price`, `quantity`) VALUES
(1, 1, 1, 500, 2),
(2, 1, 2, 300, 1),
(3, 1, 3, 30, 10),
(4, 2, 1, 500, 2),
(5, 2, 2, 300, 1),
(6, 2, 3, 30, 10),
(7, 2, 8, 60000, 10),
(8, 3, 9, 210, 1),
(9, 3, 10, 200000, 1),
(10, 4, 4, 120, 10),
(11, 4, 3, 30, 10),
(12, 4, 5, 80, 10),
(13, 4, 6, 80, 10),
(14, 4, 7, 5000, 10),
(15, 5, 8, 60000, 10),
(16, 6, 8, 60000, 10);

-- --------------------------------------------------------

--
-- テーブルの構造 `mst_product`
--

CREATE TABLE `mst_product` (
  `code` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `gazou` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `mst_product`
--

INSERT INTO `mst_product` (`code`, `name`, `price`, `gazou`) VALUES
(1, '銅の剣', 500, 'mig.jpg'),
(2, '布の服', 300, '411NAMFBnxL._UX342_.jpg'),
(3, 'ポーション', 30, '7976dbe5.jpg'),
(4, 'ハイポーション', 120, 'show (3).png'),
(5, 'メガポーション', 80, 'show (2).png'),
(6, 'エーテル', 80, 'pc_icon.jpg'),
(7, 'エリクサー', 5000, '41ut04VAJgL.jpg'),
(8, '聖水', 60000, '1452347613_20150609_810119.jpg'),
(9, 'レッドブル', 210, '411i9O7osPL._SX425_.jpg'),
(10, 'ロトの剣', 200000, '313wz7GE+sL._AC_SY400_.jpg');

-- --------------------------------------------------------

--
-- テーブルの構造 `mst_staff`
--

CREATE TABLE `mst_staff` (
  `code` int(11) NOT NULL,
  `name` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `mst_staff`
--

INSERT INTO `mst_staff` (`code`, `name`, `password`) VALUES
(1, 'sample', '5e8ff9bf55ba3508199d22e984129be6'),
(2, 'にしやま はるか', 'b450788dc032917ae79b28cd5423ff68'),
(3, 'ゆあさ ゆかこ', '2f9d495131b97119185434755e185950'),
(4, 'ひろえ', 'b45dc3be9d130d552ae66a165dad0b22'),
(5, 'なおふみ', '524e64ff9f02109248eeec213117f7fb'),
(6, 'しょうご', '53655891bfb566217f57e3ae2e096864'),
(7, 'みお', '78c925a3a4b36984d1bcbbb01457eec6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dat_member`
--
ALTER TABLE `dat_member`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `dat_sales`
--
ALTER TABLE `dat_sales`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `dat_sales_product`
--
ALTER TABLE `dat_sales_product`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `mst_product`
--
ALTER TABLE `mst_product`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `mst_staff`
--
ALTER TABLE `mst_staff`
  ADD PRIMARY KEY (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dat_member`
--
ALTER TABLE `dat_member`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dat_sales`
--
ALTER TABLE `dat_sales`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `dat_sales_product`
--
ALTER TABLE `dat_sales_product`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `mst_product`
--
ALTER TABLE `mst_product`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mst_staff`
--
ALTER TABLE `mst_staff`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
