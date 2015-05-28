-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2015 at 12:10 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `opinionfor`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
`id` int(11) NOT NULL,
  `category` varchar(250) CHARACTER SET cp1251 COLLATE cp1251_bulgarian_ci NOT NULL,
  `perant_id` int(11) DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=68 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `perant_id`) VALUES
(1, 'Места за хапване', 0),
(2, 'Места за пийване', 0),
(3, 'Нощен живот', 0),
(4, 'Кафенета и слдкарници', 0),
(5, 'Забавления', 0),
(6, 'Спорт и фитнес', 0),
(7, 'Шопинг', 0),
(8, 'Музеи и изкуства', 0),
(9, 'Деца', 0),
(10, 'Красота', 0),
(11, 'Кино и Театър', 0),
(12, 'Местни услуги', 0),
(13, 'Забележителности', 0),
(14, 'Здраве и медицина ', 0),
(15, 'Дом и градина', 0),
(16, 'На открито', 0),
(17, 'Технология', 0),
(18, 'Авто-мото', 0),
(19, 'Строителство', 0),
(20, 'Образование', 0),
(21, 'Храни и напитки', 0),
(22, 'Домашни любимци', 0),
(23, 'Пътуване', 0),
(24, 'Обществени услуги', 0),
(25, 'Професионални услуги', 0),
(66, 'Пари и финанси', 0),
(67, 'Други услуги', 0);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
`id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `permissions` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`) VALUES
(1, 'Standart user', ''),
(2, 'Administrator', '{"admin":1}');

-- --------------------------------------------------------

--
-- Table structure for table `opinions`
--

CREATE TABLE IF NOT EXISTS `opinions` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category` varchar(300) CHARACTER SET utf8 NOT NULL,
  `name` varchar(250) NOT NULL,
  `opinion` text CHARACTER SET utf8 NOT NULL,
  `q1` int(11) NOT NULL,
  `q2` int(11) NOT NULL,
  `q3` int(11) NOT NULL,
  `q4` int(11) NOT NULL,
  `q5` int(11) NOT NULL,
  `post_date` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `opinions`
--

INSERT INTO `opinions` (`id`, `user_id`, `category`, `name`, `opinion`, `q1`, `q2`, `q3`, `q4`, `q5`, `post_date`) VALUES
(14, 17, 'Спорт и фитнес', 'Topfit', 'Добре оборудвана сграда предоставяща приятна атмосфера на добра цена.', 4, 4, 5, 4, 3, '2015-03-02 19:36:57'),
(15, 17, 'Шопинг', 'The Mall', 'Един от най-големите молове в България, в които можеш да се прекараш един прекрасен ден.', 5, 5, 5, 5, 5, '2015-03-02 23:42:56'),
(16, 17, 'Технология', 'iPhone 6', 'Много качествен и стилен телефон.\r\nПредлага функционалност, с която всеки би бил доволен.', 5, 5, 5, 5, 5, '2015-03-03 01:11:13'),
(17, 17, 'Места за хапване', 'McDonalds', 'Прият обстановка, но качеството на храната е по всякаква критика. ', 5, 1, 1, 3, 4, '2015-03-03 01:14:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `name` varchar(50) NOT NULL,
  `bio` varchar(160) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `joined` datetime NOT NULL,
  `group` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `salt`, `name`, `bio`, `avatar`, `joined`, `group`) VALUES
(17, 'killer18ys', 'killer18ys@gmail.com', '15ba7201f95535b94b29ac93d5570fe6e3cf569dbebf0c588932fa7c0c4e885e', '1«,ùHeäZ1\n*‰˜Kñ-‘˜ý²xõ+"Ïz©*(', 'Lubo Ivanov', '', '1385714_652462671464960_709841049_n.jpg', '2015-02-17 00:44:07', 1),
(18, 'Alex', 'Alex@gmail.com', '5ef207c876be0cd5561baa743e7e198036ae518d489a3c16e473f9e9d73d5179', 'Eqfm%Õ‹•Ûñ’ªZjŸçÏ°ÀndG!ÆÒÑ# v', '', '', '', '2015-02-17 01:44:19', 1),
(19, 'pesho', 'Pesho@abv.bg', '1b08bfa8f320235c36d84dd9221198accb6cb1712ff49f47b62f28433cf7741c', 'C–EEP9ôßN³y±¬ûË¥2>,æ^4…»Dž³yŽ', '', '', '', '2015-02-17 01:55:13', 1),
(20, 'test_admin', 'test_admin@gmail.com', '30e6098d5f30913eedda47478c809f5713265017354def933f364402ad921484', 'zy_kd=*[uE[ISnßçM±b>:œWÅ|üÏ', '', '', '', '2015-03-03 01:41:01', 1),
(21, 'Minka', 'Minka@gmail.com', 'a7b6805fe5d7af16ec68aff84dd5dae228f3259d776b2651c246a9871211d692', 'A+~*œp²DÅ‘ÙÜÎ2º^\Zàøûa¬ërwÝ', '', '', '', '2015-03-03 01:43:41', 1),
(22, 'goshka', 'goshka@gmail.com', '098aed698eca7d38f05840faafc833cd31649febc71416e765390e20c2844b55', '/aCä^¶ð<|Æ´jñhÏV»E;ÓãÐèØ%]', '', '', '', '2015-03-03 01:45:24', 1),
(23, 'podobear', 'podobear@gmail.com', '5fd3b1740f0b4503e9a854ddd5778319173fe62c0c2c3d6ab8ca8e19a1b83c21', 'ad`{ÕúaáÕíV&]Ïº?4q67‹ôß»VÜ', 'Pedo sYm', '', '400_F_11720106_9JCVPYmW3H5E6dCKgjIaL1tG5yYcog4o.jpg', '2015-03-03 01:48:57', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_session`
--

CREATE TABLE IF NOT EXISTS `users_session` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hash` varchar(64) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users_session`
--

INSERT INTO `users_session` (`id`, `user_id`, `hash`) VALUES
(1, 16, 'b5f12878a0ed6246addbcf477947f354ea3b0327a8a228ff5ccb92e437d68ebc'),
(5, 17, '45cf8f872803c16808e28c9ce38bf4b31a5ce030b678666b693becf7a1d946d3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `category` (`category`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `opinions`
--
ALTER TABLE `opinions`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_session`
--
ALTER TABLE `users_session`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `opinions`
--
ALTER TABLE `opinions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `users_session`
--
ALTER TABLE `users_session`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
