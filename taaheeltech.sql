-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 08, 2022 at 07:20 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taaheeltech`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `ID` int(10) NOT NULL,
  `article_name` varchar(255) NOT NULL,
  `article_img` varchar(255) DEFAULT NULL,
  `pvalid` int(3) NOT NULL DEFAULT 1,
  `article_order` int(10) DEFAULT 1,
  `cat_ID` int(1) NOT NULL DEFAULT 1,
  `article_txt` longtext DEFAULT NULL,
  `vcount` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`ID`, `article_name`, `article_img`, `pvalid`, `article_order`, `cat_ID`, `article_txt`, `vcount`) VALUES
(1, 'الخبر الأول', '', 1, 1, 3, NULL, 0),
(2, 'الخبر الثاني', 'uploads/cat__1661280760_41.png', 1, 1, 1, '', 0),
(4, 'فوز شركة الاتصالات السعودية بجائزة المشغل البلاتيني للألعاب للنصف الأول من عام 2022', '', 1, 1, 3, 'أعلنت هيئة الاتصالات وتقنية المعلومات تحقيق شركة الاتصالات السعودية \"STC\" لجائزة المشغل البلاتيني لأفضل مقدمي الخدمات أداءً فيما يخص الألعاب الإلكترونية في المملكة للنصف الأول من عام 2022.\r\n\r\nوأوضحت الهيئة أن فوز شركة الاتصالات السعودية بالجائزة جاء عقب تمكنها من تحقيق أعلى معدل نقطي بعد حصولها على إجمالي 67.5 نقطة من أصل 100 في قياس مجموعة من المعايير، أبرزها استضافة الألعاب الإلكترونية محلياً، وتقليل زمن الوصول لأبرز الألعاب، إضافةً لدعم باقات مقدمي الخدمات للألعاب الإلكترونية، وتقديم الدعم الفني والتوعوي لممارسي هذه الألعاب، ودعم وإقامة أنشطة الرياضات الإلكترونية، وتوفير منصات الألعاب السحابية.\r\n\r\nيشار إلى أن جائزة المشغل البلاتيني للألعاب أُطلِقت ضمن مبادرة Game Mode التي تأتي في إطار اهتمام \"هيئة الاتصالات\" بتمكين قطاع وسوق الألعاب الإلكترونية في المملكة من خلال توفير بنية تحتية رقمية متينة، وعملها على تعزيز التنافسية بين مقدمي خدمات الاتصالات بهدف دعم مجتمع اللاعبين وضمان تقديم أفضل تجربة لهم، حيث أسهمت المبادرة منذ إطلاقها في استحداث باقات بميزات للاعبين استفاد منها أكثر من 5 ملايين مشترك بنسبة زيادة 336% عن النصف الأول من العام 2021م، وتوفير منصات الألعاب السحابية لأكثر من 322 ألف لاعب بنسبة زيادة تقدر بـ139% عن النصف الأول من العام 2021م، كما أسهمت المبادرة في تقديم الدعم الفني المتخصص لأكثر من 615 ألف مشترك من اللاعبين، بالإضافة إلى رعاية 7 من كبرى بطولات الألعاب الإلكترونية في المملكة.\r\n', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `ID` int(10) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_img` varchar(255) DEFAULT NULL,
  `pvalid` int(3) NOT NULL DEFAULT 1,
  `cat_order` int(10) DEFAULT 1,
  `cat_type` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`ID`, `cat_name`, `cat_img`, `pvalid`, `cat_order`, `cat_type`) VALUES
(1, 'التعريف بالموقع', '', 1, 1, 1),
(2, 'الحفلات', '', 1, 1, 2),
(3, 'الأخبار', '', 1, 1, 1),
(4, 'الفعاليات', '', 1, 1, 3),
(5, 'إفطار عمل', '', 0, 1, 2),
(6, 'حفلة التخرج', 'uploads/cat__1661280760_41.png', 1, 1, 2),
(13, 'test', 'uploads/cat__1662651331_5.png', 1, 1, 1),
(14, 'cat test 1', 'uploads/cat__1662651461_60.png', 1, 1, 1),
(15, '3', 'uploads/cat__1662651616_95.png', 1, 1, 1),
(16, '4', 'uploads/cat__1662651701_45.png', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `ID` int(10) NOT NULL,
  `photo_name` varchar(255) NOT NULL,
  `photo_img` varchar(255) DEFAULT NULL,
  `pvalid` int(3) NOT NULL DEFAULT 1,
  `photo_order` int(10) DEFAULT 1,
  `cat_ID` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`ID`, `photo_name`, `photo_img`, `pvalid`, `photo_order`, `cat_ID`) VALUES
(2, 'photo 2', '', 1, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pvalid` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `password`, `name`, `email`, `pvalid`) VALUES
(1, 'admin', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'أبوبكر محمد', 'info@taaheeltech.com', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
