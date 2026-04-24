-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 產生日期: 2014 年 05 月 21 日 05:48
-- 伺服器版本: 5.6.12-log
-- PHP 版本: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫: `ch09`
--
CREATE DATABASE IF NOT EXISTS `ch09` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `ch09`;

-- --------------------------------------------------------

--
-- 表的結構 `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `書籍編號` int(11) NOT NULL AUTO_INCREMENT,
  `書籍名稱` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `價格` decimal(6,2) NOT NULL,
  `負責員工編號` int(11) NOT NULL,
  PRIMARY KEY (`書籍編號`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=36 ;

--
-- 轉存資料表中的資料 `books`
--

INSERT INTO `books` (`書籍編號`, `書籍名稱`, `價格`, `負責員工編號`) VALUES
(1, '打開 Mac 新世界', '420.00', 2),
(2, '眼球運動視力鍛鍊', '350.00', 4),
(3, 'HTML5 程式設計範例字典', '520.00', 3),
(4, 'Word 使用手冊', '300.00', 8),
(5, '抓住你的 Photoshop', '450.00', 1),
(6, 'Windows 非常 EASY', '500.00', 2),
(7, 'EXECL 快速入門', '350.00', 6),
(8, 'PHP 程式語言', '460.00', 2),
(9, '卡娃依彩繪世界', '280.00', 7),
(10, 'Android 程式設計', '480.00', 5),
(11, '超平板工作玩樂技', '199.00', 2),
(12, '麵包、西點手感烘培教室', '360.00', 7),
(13, '設計師產品繪圖知識', '480.00', 1),
(14, '法式迷你砂鍋創意食譜', '880.00', 3),
(15, 'Photoshop 識別設計', '450.00', 1),
(16, 'Microsoft Excel 商用範例', '490.00', 6),
(17, '上班族一定要會的 Excel 函數', '320.00', 6),
(18, '數位攝影的黃金法則', '380.00', 1),
(19, '核心訓練圖解聖經', '580.00', 4),
(20, '為室內設計畫上完美的驚嘆號', '450.00', 1),
(21, 'iPad 使用手冊', '380.00', 8),
(22, '設計師材質運用知識', '450.00', 1),
(23, '手機 App 活用術', '320.00', 2),
(24, '智慧手機 App UI/UX 設計鐵則', '380.00', 5),
(25, 'iPhone 使用手冊', '320.00', 8),
(26, 'AutoCAD 電腦繪圖設計', '620.00', 1),
(27, '愛犬品種聖經', '680.00', 7),
(28, '產品設計的原型與模型', '520.00', 1),
(29, '高爾夫技巧聖經', '680.00', 4),
(30, '幸福雜貨生活提案', '320.00', 3),
(31, '復古時尚素材集', '350.00', 1),
(32, 'SketchUp 建築繪圖細部教學', '450.00', 1),
(33, '9-99歲電腦我也會', '350.00', 2),
(34, 'Excel VBA 超入門教室', '320.00', 6),
(35, '偉大創意這樣來', '399.00', 7);

-- --------------------------------------------------------

--
-- 表的結構 `company1`
--

CREATE TABLE IF NOT EXISTS `company1` (
  `書籍編號` int(11) NOT NULL AUTO_INCREMENT,
  `書籍名稱` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `價格` decimal(6,2) NOT NULL,
  PRIMARY KEY (`書籍編號`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- 轉存資料表中的資料 `company1`
--

INSERT INTO `company1` (`書籍編號`, `書籍名稱`, `價格`) VALUES
(1, '打開 Mac 新世界', '420.00'),
(2, 'Windows 非常 EASY', '500.00'),
(3, 'PHP 程式語言', '460.00');

-- --------------------------------------------------------

--
-- 表的結構 `company2`
--

CREATE TABLE IF NOT EXISTS `company2` (
  `書籍編號` int(11) NOT NULL AUTO_INCREMENT,
  `書籍名稱` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `價格` decimal(6,2) NOT NULL,
  PRIMARY KEY (`書籍編號`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- 轉存資料表中的資料 `company2`
--

INSERT INTO `company2` (`書籍編號`, `書籍名稱`, `價格`) VALUES
(1, '打開 Mac 新世界', '420.00'),
(2, 'Windows 非常 EASY', '500.00'),
(3, 'HTML5 程式設計範例字典', '520.00');

-- --------------------------------------------------------

--
-- 表的結構 `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `員工編號` int(11) NOT NULL AUTO_INCREMENT,
  `性別` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `姓名` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `電話` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `主管編號` int(11) DEFAULT NULL,
  PRIMARY KEY (`員工編號`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- 轉存資料表中的資料 `employee`
--

INSERT INTO `employee` (`員工編號`, `性別`, `姓名`, `電話`, `主管編號`) VALUES
(1, '女', '陳圓圓', '0223219845', 2),
(2, '女', '劉敏敏', '0246546777', NULL),
(3, '男', '劉國城', '0246465465', 2),
(4, '女', '蘇菲菲', '0287658764', 3),
(5, '男', '郭逸洋', '0354686546', 1),
(6, '男', '邱大熊', '0266873546', 1),
(7, '男', '王國維', '0688643546', 3),
(8, '女', '簡成琳', '0358547646', 1);

-- --------------------------------------------------------

--
-- 表的結構 `guestbook`
--

CREATE TABLE IF NOT EXISTS `guestbook` (
  `留言編號` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `姓名` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '無名氏',
  `留言` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `日期時間` datetime NOT NULL,
  PRIMARY KEY (`留言編號`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- 轉存資料表中的資料 `guestbook`
--

INSERT INTO `guestbook` (`留言編號`, `姓名`, `留言`, `日期時間`) VALUES
(1, '低頭族', '請問你們有出 Android 的相關書籍嗎?', '2014-04-02 15:17:41'),
(2, '旗標出版社', '親愛的低頭族讀者您好:\r\n\r\n我們已經出版相當多 Android 相關書籍, 您可以到我們的網站 http://www.flag.com.tw, 在右上角的搜尋欄輸入 "Vista", 就可以找到 Vista 書籍了。', '2014-04-02 16:17:05'),
(3, '王大頭', '我最近買了你們 Linux 的書來學, 覺得你們寫得很不錯, 觀念詳細步驟又清楚, 多多加油喔!', '2014-04-03 12:13:45');

-- --------------------------------------------------------

--
-- 表的結構 `inventory`
--

CREATE TABLE IF NOT EXISTS `inventory` (
  `編號` int(11) NOT NULL AUTO_INCREMENT,
  `書籍名稱` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `數量` int(11) NOT NULL,
  PRIMARY KEY (`編號`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- 轉存資料表中的資料 `inventory`
--

INSERT INTO `inventory` (`編號`, `書籍名稱`, `數量`) VALUES
(1, 'PHP 程式語言', 100),
(2, 'Linux 架站實務', 300),
(3, 'Windows 使用手冊', 500),
(4, 'HTML5參考手冊', 135);

-- --------------------------------------------------------

--
-- 表的結構 `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `訂單編號` int(11) NOT NULL AUTO_INCREMENT,
  `訂購書籍編號` int(11) NOT NULL,
  `訂購者姓名` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`訂單編號`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- 轉存資料表中的資料 `order`
--

INSERT INTO `order` (`訂單編號`, `訂購書籍編號`, `訂購者姓名`) VALUES
(1, 3, '張泰三'),
(2, 5, '王維'),
(3, 2, '秋大頭');

-- --------------------------------------------------------

--
-- 表的結構 `surl`
--

CREATE TABLE IF NOT EXISTS `surl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- 轉存資料表中的資料 `surl`
--

INSERT INTO `surl` (`id`, `url`) VALUES
(1, 'http://tw.news.yahoo.com/article/url/d/a/070815/8/itgg.html'),
(2, 'http://tw.php.net/manual/en/function.mysql-affected-rows.php'),
(3, 'http://tw.news.yahoo.com/article/url/d/a/070816/2/ivc1.html'),
(4, 'http://dev.mysql.com/doc/apis-php/en/apis-php-mysqli.html');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
