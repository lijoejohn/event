-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 18, 2017 at 08:22 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_token`
--

DROP TABLE IF EXISTS `auth_token`;
CREATE TABLE IF NOT EXISTS `auth_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` varchar(225) NOT NULL,
  `created` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1-Active,2-InActive',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '1-Login, 2- Reser PWD',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_token`
--

INSERT INTO `auth_token` (`id`, `user_id`, `token`, `created`, `status`, `type`) VALUES
(1, 1, '$2y$10$X6NIszwLsgkqssiafxI2s.edZqQn954kKrd9AenkQQ/J19ib1JFfy', '2017-12-08 07:50:58', 1, 1),
(12, 89, '$2y$10$rgCr8WT4qHnbNVUOj1Cu7uZV9JwoxQE0RhR3Z4kAW9RcU6ZazDkFu', '2017-12-08 11:55:34', 1, 1),
(13, 90, '$2y$10$5CCAWfeIfysr/LSANd69ouh2Oi5spEkphOAaZmlaqZXf3RD.nEtRS', '2017-12-08 11:56:56', 1, 1),
(17, 1, '$2y$10$7jeTfycJH4a00QBIZzi9t.4anBB2iQbA7XrNm0lSFjCi6rZP8qznm', '2017-12-08 13:26:39', 1, 1),
(18, 1, '$2y$10$6bFhJoPBu277xDfPNImPPOz8vr9ofB4hiTTaFMqZthV8/9S0j6dBG', '2017-12-12 11:50:14', 1, 1),
(21, 1, '$2y$10$TKeCtBKyIKnJMPxFl55PN./JZ7WlujpGloRstpy9ULtSiWupapt9O', '2017-12-12 11:58:00', 1, 1),
(22, 1, '$2y$10$93c8XTNqdzrf8DSfZDx2eu0iGQ92tQLlfRI8hMVJeT8yTemx8i3l6', '2017-12-12 11:58:00', 1, 1),
(26, 93, '$2y$10$twLVXLRMVvFhTcqoY1BIxO6Xu21Znu6kCNGhAxAUKtg.N4x5h0FKK', '2017-12-13 13:34:41', 1, 1),
(27, 1, '$2y$10$AxzFdQGEMPinefcRrLSPlu5yDeAYg14/8tDHxQzrfm99ONnpO52Bu', '2017-12-14 12:49:49', 1, 1),
(37, 1, '$2y$10$LWthJSMErVSHnox1FJUG3uGi600x/8uslqh/RIxWuMIK4nvxbfSuK', '2017-12-15 07:24:50', 1, 1),
(38, 94, '$2y$10$bMkAi8gNIWjVDozPvTVqpuT1wdAa7g5SSYGrFOC0gtKtuwXA2CJ4y', '2017-12-15 07:31:28', 1, 1),
(39, 95, '$2y$10$Zz2B3Tlz3ynj9M9QLplFCuHM4b.E6RYraCAHkldBVvSfqDHsVbUN6', '2017-12-18 07:16:06', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_name` text NOT NULL,
  `event_time` datetime NOT NULL,
  `event_lat` varchar(100) NOT NULL,
  `event_long` varchar(100) NOT NULL,
  `event_address` varchar(300) NOT NULL,
  `event_city` varchar(300) NOT NULL,
  `event_country` varchar(300) NOT NULL,
  `event_state` varchar(300) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1-public,2-private',
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_name`, `event_time`, `event_lat`, `event_long`, `event_address`, `event_city`, `event_country`, `event_state`, `type`, `created_by`) VALUES
(1, 'Private First Event', '2017-12-14 20:45:31', '3.0195785', '101.7112306', '11, Jalan 7/3, Serdang Jaya, 43300 Seri Kembangan, Selangor, Malaysia', '', '', '', 2, 1),
(2, 'Private second event', '2017-12-15 20:45:31', '3.0205152', '101.6987347', 'Kantan Court, Taman Bukit Serdang, 43300 Seri Kembangan, Selangor, Malaysia', '', '', '', 2, 1),
(3, 'Public first eveent', '2017-12-16 20:45:31', '3.0194909', '101.6974111', '6, Jalan BS 6/4, Taman Bunga Raya, 43300 Seri Kembangan, Selangor, Malaysia', '', '', '', 1, 1),
(4, 'Private event from user test', '2017-12-15 20:45:23', '3.019886', '101.710693', '8, Jalan 7/3, Kawasan Perindustrian Seri Kembangan, 43000 Seri Kembangan, Selangor, Malaysia', '', '', '', 2, 93),
(5, 'Public event from test user', '2017-12-16 20:45:23', '3.020584', '101.7142313', '360, Jalan Raya 2, Serdang Jaya, 43300 Seri Kembangan, Selangor, Malaysia', '', '', '', 1, 93),
(6, 'Public event from admin', '2017-12-16 20:45:31', '3.0194364', '101.7113357', '11, Jalan 7/3, Serdang Jaya, 43300 Seri Kembangan, Selangor, Malaysia', '', '', '', 1, 1),
(7, 'Private event 10', '2017-12-16 20:45:31', '3.0166924', '101.7111761', 'Jalan Raya 3, Taman Sri Serdang, 43300 Seri Kembangan, Selangor, Malaysia', '', '', '', 2, 1),
(8, 'for xxs', '2017-12-15 12:58:49', '3.0190292', '101.7098561', 'Jalan 7/4, Serdang Jaya, 43300 Seri Kembangan, Selangor, Malaysia', '', '', '', 1, 1),
(9, '<script type=\"text/javascript\"> alert(\"hii\"); </sc', '2017-12-15 13:09:05', '3.0166861', '101.7133627', '3467, Jalan 6/4, Kawasan Perindustrian Seri Kembangan, 43300 Seri Kembangan, Selangor, Malaysia', '', '', '', 1, 1),
(10, '<iframe src=\"https://www.w3schools.com\"></iframe>', '2017-12-15 13:17:10', '3.0199674', '101.7122564', '2, Jalan 7/1, Serdang Jaya, 43300 Seri Kembangan, Selangor, Malaysia', '', '', '', 1, 1),
(11, 'alert(\"yes\");', '2017-12-18 12:46:11', '3.020584', '101.7142313', '360, Jalan Raya 2, Serdang Jaya, 43300 Seri Kembangan, Selangor, Malaysia', '', '', '', 1, 95);

-- --------------------------------------------------------

--
-- Table structure for table `events_invites`
--

DROP TABLE IF EXISTS `events_invites`;
CREATE TABLE IF NOT EXISTS `events_invites` (
  `events_invites_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`events_invites_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events_invites`
--

INSERT INTO `events_invites` (`events_invites_id`, `event_id`, `user_id`) VALUES
(1, 1, 93),
(2, 2, 92),
(3, 2, 91),
(4, 3, 91),
(5, 3, 90),
(6, 4, 1),
(7, 5, 89),
(8, 5, 90),
(9, 6, 90),
(10, 6, 91),
(11, 7, 89),
(12, 7, 90),
(13, 7, 91),
(14, 8, 94),
(15, 8, 92),
(16, 9, 90),
(17, 9, 93),
(18, 9, 89),
(19, 9, 92),
(20, 10, 91),
(21, 10, 93),
(22, 11, 92),
(23, 11, 91);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `created_on` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1-Active 2- Inactive 3-Deleted',
  PRIMARY KEY (`user_id`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `password`, `first_name`, `last_name`, `email`, `created_on`, `status`) VALUES
(1, 'admin@ctv.tv', '$2y$10$2QZd2mylSX805yYChpO4iuUi49pR.lL9cw/0dSwg9F/XbT2D/CgB2', 'Admin', 'User', 'admin@ctv.tv', '2016-01-07 00:00:00', 1),
(89, 'aaa@yopmail.com', '$2y$10$aE376uS4WxVWr3dJjNxLrOD.dORdjxIZ7Z4Nc9.LAzutiujfLTzgS', 'Lijo', 'Thomas', 'aaa@yopmail.com', '2017-12-08 11:55:34', 1),
(90, 'aaaa@yopmail.com', '$2y$10$Nmm/D5DTmvZNUHFAi9f6UOEtxnMmWAw7tdoedIvwDel/EAdH6bBhC', 'Sanjay', 'Kumar', 'aaaa@yopmail.com', '2017-12-08 11:56:56', 1),
(91, 'bbbbc@yopmail.com', '$2y$10$o16NPWYI05Z2EYG.nMx/8uSW2uOYJDLO1bm2E6XcPM9tKnTe03RdO', 'Arun', 'Thomas', 'bbbbc@yopmail.com', '2017-12-08 12:00:39', 1),
(92, 'userone@yopmail.com', '$2y$10$zmwQDQ9ku6Eifq5H3JobwOjaMLNo7RXpBUHuAiKCXGfby9UUajL6O', 'Lijo', 'John', 'userone@yopmail.com', '2017-12-08 12:02:23', 1),
(93, 'user2@yopmail.com', '$2y$10$aTv.lBYTVjp9nZTB4jN8Nu7HTkvf.Jbm5tyaPMFcVYUYMN33H4wT6', 'Second User', 'Test', 'user2@yopmail.com', '2017-12-13 13:27:24', 1),
(94, 'lastuser@yopmail.com', '$2y$10$QiLImL0K/vD6L6cgJdwzd.ziINR8D62CIxC3Zbc1Fziwip1FLFP5q', '<script type=\"text/javascript\"> alert(\"hii\");  </script>', 'Last', 'lastuser@yopmail.com', '2017-12-15 07:31:28', 1),
(95, 'yopuser@yopmail.com', '$2y$10$ElMeXwLgFvjSXvS35Wd6..HcoFZ1tYxmZBBebbYIl9wT8spEeTQ5C', '', 'alert(\"yes\");', 'yopuser@yopmail.com', '2017-12-18 07:16:06', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
