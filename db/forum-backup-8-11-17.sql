-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 08, 2017 at 11:16 PM
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
  `data` varchar(20000) COLLATE ascii_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`data_id`, `fk_user_id`, `fk_parent_id`, `timestamp`, `num_child`, `chain_level`, `type`, `title`, `data`) VALUES
(1, 1, NULL, '2017-11-08 15:44:12', 2, 0, 0, 'Test Post', 'Testing 123'),
(2, 1, NULL, '2017-11-07 16:00:27', 0, 0, 0, 'Second Post', 'Hey this is the second post !!'),
(3, 1, NULL, '2017-11-07 16:01:13', 0, 0, 0, '//\\                       third test       \\\\\\\\', '//\\                       third test       \r\n\r\n\r\n\r\n\r\n                                                               \\\\\\\\'),
(4, 1, NULL, '2017-11-07 16:03:17', 0, 0, 0, 'vool', 'nice'),
(5, 1, NULL, '2017-11-07 16:06:34', 0, 0, 0, '                                       yoyo', '                                              hello                                                                                                                           '),
(6, 1, 1, '2017-11-08 15:42:13', 1, 0, 1, NULL, 'testing reply'),
(7, 1, 6, '2017-11-08 15:42:13', 0, 0, 1, NULL, 'testing reply lvl 2'),
(8, 1, 1, '2017-11-08 15:44:12', 0, 0, 1, NULL, 'testing level 1 again');

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
  MODIFY `data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
