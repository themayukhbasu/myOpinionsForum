-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 28, 2017 at 10:15 PM
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
  `moderation` int(11) NOT NULL DEFAULT '-1',
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
(9, 1, NULL, '2017-11-28 06:06:50', 4, 0, 0, 'mb', 'mb', 0, 0, 0),
(10, 1, 9, '2017-11-27 10:55:42', 1, 0, 1, NULL, 'replied', 0, 0, 0),
(11, 1, 10, '2017-11-27 11:35:11', 1, 0, 1, NULL, 'double reply', 0, 0, 0),
(12, 1, 11, '2017-11-27 11:36:07', 2, 0, 1, NULL, 'triple reply', 0, 0, 0),
(13, 1, 12, '2017-11-27 13:51:41', 2, 0, 1, NULL, 'quadruple reply', 0, 0, 0),
(14, 1, 12, '2017-11-27 11:36:07', 0, 0, 1, NULL, 'triple reply no 2', 0, 0, 0),
(15, 1, 13, '2017-11-27 12:18:40', 1, 0, 1, NULL, 'penta reply', 0, 0, 0),
(16, 1, 15, '2017-11-27 12:18:40', 0, 0, 1, NULL, 'my foo bar is cool', 1, 0, 0),
(17, 1, 13, '2017-11-27 13:51:41', 0, 0, 1, NULL, 'fuck you', 1, 0, 0),
(18, 1, 2, '2017-11-27 15:04:30', 1, 0, 1, NULL, 'reply', 0, 0, 0),
(19, 1, 18, '2017-11-27 15:04:30', 0, 0, 1, NULL, 'cool', 0, 0, 0),
(28, 1, NULL, '2017-11-28 14:47:44', 1, 0, 0, 'dfghn', 'rdtfhj', 0, 0, 0),
(29, 1, 28, '2017-11-28 14:47:44', 0, 0, 1, NULL, 'test', 0, 0, 0),
(30, 1, NULL, '2017-11-28 16:01:40', 3, 0, 0, 'What is Lorem Ipsum?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 0, 0, 0),
(31, 1, NULL, '2017-11-28 16:09:37', 2, 0, 0, 'Why do we use Lorem Ipsum?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 0, 0, 0),
(32, 1, 31, '2017-11-28 16:40:09', 1, 0, 1, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 0, 0, 0),
(33, 1, 30, '2017-11-28 15:58:08', 0, 0, 1, NULL, 'stupid idiot', 1, 0, 0),
(34, 1, 30, '2017-11-28 16:00:08', 0, 0, 1, NULL, 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?', 0, 0, 0),
(35, 1, 30, '2017-11-28 16:01:40', 0, 0, 1, NULL, 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?', 0, 0, 0),
(36, 1, 31, '2017-11-28 16:30:16', 1, 0, 1, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillu', 0, 0, 0),
(37, 1, 36, '2017-11-28 16:30:16', 0, 0, 1, NULL, 'hey asshole', 1, 0, 0),
(38, 2, 32, '2017-11-28 16:40:09', 0, 0, 1, NULL, 'Hey whats up?', 0, 0, 0);

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
(1, 'mb', 'mb@gmail.com', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', 1234, '2017-11-07 07:16:00'),
(2, 'root', 'root@gmail.com', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', 1234, '2017-11-28 16:39:44');

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
  MODIFY `data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
