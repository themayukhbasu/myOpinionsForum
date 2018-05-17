-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 27, 2017 at 08:50 PM
-- Server version: 5.7.13-0ubuntu0.16.04.2
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--
CREATE DATABASE IF NOT EXISTS `forum` DEFAULT CHARACTER SET ascii COLLATE ascii_bin;
USE `forum`;

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `data_id` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL COMMENT 'fk - Foreign Key',
  `fk_parent_id` int(11) DEFAULT NULL COMMENT 'fk - Foreign Key',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `num_child` int(11) NOT NULL DEFAULT '0',
  `chain_level` int(11) DEFAULT '0',
  `type` int(11) NOT NULL COMMENT 'main post or reply',
  `title` varchar(100) COLLATE ascii_bin DEFAULT NULL,
  `data` varchar(20000) COLLATE ascii_bin NOT NULL,
  `moderation` int(11) NOT NULL DEFAULT '0',
  `del_user` int(11) NOT NULL DEFAULT '0',
  `del_admin` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`data_id`, `fk_user_id`, `fk_parent_id`, `timestamp`, `num_child`, `chain_level`, `type`, `title`, `data`, `moderation`, `del_user`, `del_admin`) VALUES
(1, 1, NULL, '2017-11-08 15:44:12', 2, 0, 0, 'Test Post', 'Testing 123', 0, 0, 0),
(2, 1, NULL, '2017-11-27 15:04:23', 1, 0, 0, 'Second Post', 'Hey this is the second post !!', 0, 0, 0),
(3, 1, NULL, '2017-11-07 16:01:13', 0, 0, 0, '//\\                       third test       \\\\\\\\', '//\\                       third test       \r\n\r\n\r\n\r\n\r\n                                                               \\\\\\\\', 0, 0, 0),
(4, 1, NULL, '2017-11-07 16:03:17', 0, 0, 0, 'vool', 'nice', 0, 0, 0),
(5, 1, NULL, '2017-11-07 16:06:34', 0, 0, 0, '                                       yoyo', '                                              hello                                                                                                                           ', 0, 0, 0),
(6, 1, 1, '2017-11-08 15:42:13', 1, 0, 1, NULL, 'testing reply', 0, 0, 0),
(7, 1, 6, '2017-11-08 15:42:13', 0, 0, 1, NULL, 'testing reply lvl 2', 0, 0, 0),
(8, 1, 1, '2017-11-08 15:44:12', 0, 0, 1, NULL, 'testing level 1 again', 0, 0, 0),
(9, 1, NULL, '2017-11-27 10:55:29', 1, 0, 0, 'mb', 'mb', 0, 0, 0),
(10, 1, 9, '2017-11-27 10:55:42', 1, 0, 1, NULL, 'replied', 0, 0, 0),
(11, 1, 10, '2017-11-27 11:35:11', 1, 0, 1, NULL, 'double reply', 0, 0, 0),
(12, 1, 11, '2017-11-27 11:36:07', 2, 0, 1, NULL, 'triple reply', 0, 0, 0),
(13, 1, 12, '2017-11-27 13:51:41', 2, 0, 1, NULL, 'quadruple reply', 0, 0, 0),
(14, 1, 12, '2017-11-27 11:36:07', 0, 0, 1, NULL, 'triple reply no 2', 0, 0, 0),
(15, 1, 13, '2017-11-27 12:18:40', 1, 0, 1, NULL, 'penta reply', 0, 0, 0),
(16, 1, 15, '2017-11-27 12:18:40', 0, 0, 1, NULL, 'my foo bar is cool', 1, 0, 0),
(17, 1, 13, '2017-11-27 13:51:41', 0, 0, 1, NULL, 'fuck you', 1, 0, 0),
(18, 1, 2, '2017-11-27 15:04:30', 1, 0, 1, NULL, 'reply', 0, 0, 0),
(19, 1, 18, '2017-11-27 15:04:30', 0, 0, 1, NULL, 'cool', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(20) COLLATE ascii_bin NOT NULL,
  `email` varchar(100) COLLATE ascii_bin NOT NULL,
  `password` varchar(200) COLLATE ascii_bin NOT NULL,
  `mob_number` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `email`, `password`, `mob_number`, `timestamp`) VALUES
(1, 'mb', 'mb@gmail.com', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', 1234, '2017-11-07 07:16:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`data_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
