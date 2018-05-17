-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 07, 2018 at 09:27 PM
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
(1, 1, NULL, '2018-04-26 00:09:13', 2, 0, 0, 'Test Post', 'Testing 123', 0, 0, 0),
(2, 1, NULL, '2018-04-25 23:14:59', 1, 0, 0, 'Second Post', 'Hey this is the second post !!', 0, 0, 0),
(3, 1, NULL, '2018-04-25 23:14:59', 0, 0, 0, '//\\                       third test       \\\\\\\\', '//\\                       third test       \r\n\r\n\r\n\r\n\r\n                                                               \\\\\\\\', 0, 0, 0),
(4, 1, NULL, '2018-04-25 23:15:00', 0, 0, 0, 'vool', 'nice', 0, 0, 0),
(5, 1, NULL, '2018-04-25 23:15:56', 0, 0, 0, '                                       yoyo', '                                              hello                                                                                                                           ', 0, 0, 0),
(6, 1, 1, '2018-04-25 23:15:57', 1, 0, 1, NULL, 'testing reply', 1, 0, 0),
(7, 1, 6, '2018-04-25 23:15:57', 0, 0, 1, NULL, 'testing reply lvl 2', 1, 0, 0),
(8, 1, 1, '2018-04-25 23:15:58', 0, 0, 1, NULL, 'testing level 1 again', 0, 0, 0),
(9, 1, NULL, '2018-04-25 23:15:58', 4, 0, 0, 'mb', 'mb', 0, 0, 0),
(10, 1, 9, '2018-04-25 23:15:58', 1, 0, 1, NULL, 'replied', 0, 0, 0),
(11, 1, 10, '2018-04-25 23:15:59', 1, 0, 1, NULL, 'double reply', 1, 0, 0),
(12, 1, 11, '2018-04-25 23:15:59', 2, 0, 1, NULL, 'triple reply', 1, 0, 0),
(13, 1, 12, '2018-04-25 23:16:00', 2, 0, 1, NULL, 'quadruple reply', 1, 0, 0),
(14, 1, 12, '2018-04-25 23:16:00', 0, 0, 1, NULL, 'triple reply no 2', 0, 0, 0),
(15, 1, 13, '2018-04-25 23:16:00', 1, 0, 1, NULL, 'penta reply', 1, 0, 0),
(16, 1, 15, '2018-04-25 23:16:01', 0, 0, 1, NULL, 'my foo bar is cool', 0, 0, 0),
(17, 1, 13, '2018-04-25 23:16:01', 0, 0, 1, NULL, 'fuck you', 0, 0, 0),
(18, 1, 2, '2018-04-25 23:16:03', 1, 0, 1, NULL, 'reply', 1, 0, 0),
(19, 1, 18, '2018-04-25 23:16:03', 0, 0, 1, NULL, 'cool', 0, 0, 0),
(28, 1, NULL, '2018-04-25 23:16:04', 1, 0, 0, 'dfghn', 'rdtfhj', 0, 0, 0),
(29, 1, 28, '2018-04-25 23:16:04', 0, 0, 1, NULL, 'test', 0, 0, 0),
(30, 1, NULL, '2018-04-25 23:16:04', 3, 0, 0, 'What is Lorem Ipsum?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 0, 0, 0),
(31, 1, NULL, '2018-04-25 23:16:05', 2, 0, 0, 'Why do we use Lorem Ipsum?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 0, 0, 0),
(32, 1, 31, '2018-04-25 23:16:05', 1, 0, 1, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 0, 0, 0),
(33, 1, 30, '2018-04-25 23:16:05', 0, 0, 1, NULL, 'stupid idiot', 0, 0, 0),
(34, 1, 30, '2018-04-25 23:16:06', 0, 0, 1, NULL, 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?', 0, 0, 0),
(35, 1, 30, '2018-04-25 23:16:06', 0, 0, 1, NULL, 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?', 0, 0, 0),
(36, 1, 31, '2018-04-25 23:16:07', 1, 0, 1, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillu', 0, 0, 0),
(37, 1, 36, '2018-04-25 23:16:07', 0, 0, 1, NULL, 'hey asshole', 0, 0, 0),
(38, 2, 32, '2018-04-25 23:16:07', 1, 0, 1, NULL, 'Hey whats up?', 0, 0, 0),
(39, 1, 38, '2018-04-25 23:16:08', 0, 0, 1, NULL, 'Everything is Fine', 0, 0, 0),
(40, 1, NULL, '2018-04-25 23:16:08', 0, 0, 0, 'sdfth', 'rthntny', 0, 0, 0),
(41, 1, NULL, '2018-04-25 23:16:08', 0, 0, 0, '$user_id,$post_type,$post_title,$post_input', '$user_id,$post_type,$post_title,$post_input', 0, 0, 0),
(42, 1, NULL, '2018-04-25 23:16:09', 0, 0, 0, 'URGENT! You have won a 1 week FREE membership in our 100,000 Prize Jackpot! Txt the word: CLAIM to', 'URGENT! You have won a 1 week FREE membership in our 100,000 Prize Jackpot! Txt the word: CLAIM to', 1, 0, 0),
(43, 1, NULL, '2018-04-25 23:16:09', 0, 0, 0, 'URGENT! You have won a 1 week FREE membership in our ??100,000 Prize Jackpot! Txt the word: CLAIM', 'URGENT! You have won a 1 week FREE membership in our ??100,000 Prize Jackpot! Txt the word: CLAIM to', 1, 0, 0),
(44, 1, NULL, '2018-04-25 23:16:10', 0, 0, 0, 'sfbvgdsbjbkbk hkarhfkbdasvh', 'jabsvfgkg hjbkjhb chasrfbvhyfvk sdhfbvhbz', 0, 0, 0),
(45, 1, NULL, '2018-04-25 23:16:10', 0, 0, 0, 'PHP, convert UTF-8 to ASCII 8-bit', 'I\'m trying to convert a string from UTF-8 to ASCII 8-bit by using the iconv function. The string is meant to be imported into an accounting software (some basic instructions parsed accordingly to SIE standards).', 0, 0, 0),
(46, 1, NULL, '2018-04-25 23:16:10', 0, 0, 0, 'Humpty Dumpty', 'Humpty Dumpty sat on a wall', 0, 0, 0),
(47, 1, NULL, '2018-04-25 23:16:11', 0, 0, 0, 'Mozart is the best', 'Mozart is truly the best', 0, 0, 0),
(48, 1, NULL, '2018-04-25 23:16:11', 0, 0, 0, 'Testing', 'lets test it out', 0, 0, 0),
(49, 1, NULL, '2018-04-25 23:16:11', 0, 0, 0, 'asdrgsrthryjn', 'tyjtumy,myi', 0, 0, 0),
(50, 1, NULL, '2018-04-25 23:16:12', 0, 0, 0, 'asdcf', 'asdcf', 0, 0, 0),
(51, 1, NULL, '2018-04-25 23:16:12', 0, 0, 0, 'adecf', 'asdvvdfbvgbv', 0, 0, 0),
(52, 1, NULL, '2018-04-25 23:16:12', 0, 0, 0, 'asrgrthjtyj', 'tymjyui,ou.oli', 0, 0, 0),
(53, 1, NULL, '2018-04-25 23:16:13', 0, 0, 0, 'sfbvgrtgntmyi', 'yi,ui,.o.p', 0, 0, 0),
(54, 1, NULL, '2018-04-25 23:16:13', 0, 0, 0, 'sfbghnyn', 'tumyu,myi,iu,', 0, 0, 0),
(55, 1, NULL, '2018-04-25 23:30:50', 0, 0, 0, 'asgrh', 'rtyumjumyi,m', 0, 0, 0),
(56, 1, NULL, '2018-04-25 23:36:23', 0, 0, 0, 'rthtyjtruj', 'tryjtujmi,ki,m', 0, 0, 0),
(57, 1, NULL, '2018-04-25 23:36:23', 0, 0, 0, 'sarvgesthtumkyi,', 'ftgumkyi,uo,yui,ui,lu,y', 0, 0, 0),
(58, 1, NULL, '2018-04-25 23:36:24', 0, 0, 0, 'asfhjvbhjbvjhfbvhjb', 'kjbfsvhjbdsvhfvhjsdklv', 0, 0, 0),
(59, 1, NULL, '2018-04-25 23:36:24', 0, 0, 0, 'sdtgbhymnm', 'fgmfyi,iyj,', 0, 0, 0),
(60, 1, NULL, '2018-04-25 23:46:10', 0, 0, 0, 'You are a winner U have been specially selected 2 receive ??1000 or a 4* holiday (flights inc) spe', 'You are a winner U have been specially selected 2 receive ??1000 or a 4* holiday (flights inc) speak to a live operator 2 claim 0871277810910p/min (18+)', 1, 0, 0),
(61, 1, NULL, '2018-04-25 23:51:20', 1, 0, 0, 'dSvfdsrbvgdsgb', 'sdbsdtgbngtnbry', 0, 0, 0),
(62, 1, 61, '2018-04-26 00:17:13', 1, 0, 1, NULL, 'hello how are you?', 0, 0, 0),
(63, 1, NULL, '2018-04-25 23:56:52', 1, 0, 0, 'fgchnjgfmj', 'gfmfgju,m,j', 0, 0, 0),
(64, 1, 63, '2018-04-26 00:01:59', 0, 0, 1, NULL, 'sfbvdgsntjumyki,', 0, 0, 0),
(65, 1, NULL, '2018-04-26 00:05:17', 0, 0, 0, 'asbcdlkbcklbkl', 'ksbfvhbdsfklvbdjsbv', 0, 0, 0),
(66, 1, 62, '2018-04-26 00:17:16', 0, 0, 1, NULL, 'hcdkhgcjgtc', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `user_id` int(11) NOT NULL,
  `follow_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`user_id`, `follow_user_id`) VALUES
(3, 1),
(3, 2);

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
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_token` varchar(32) COLLATE ascii_bin DEFAULT NULL,
  `user_dp` varchar(400) COLLATE ascii_bin NOT NULL DEFAULT 'assets/img/profile-img.png 	',
  `is_active` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `email`, `password`, `mob_number`, `timestamp`, `user_token`, `user_dp`, `is_active`) VALUES
(1, 'mb', 'mb@gmail.com', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', 1234, '2018-05-07 15:20:15', NULL, 'upload/tux.jpg', 1),
(2, 'root', 'root@gmail.com', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', 1234, '2017-11-28 16:39:44', NULL, 'assets/img/profile-img.png 	', 0),
(3, 'basu1', 'basugames1@gmail.com', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', 1234, '2018-05-07 15:24:24', NULL, 'assets/img/profile-img.png 	', 0),
(4, 'basu', 'basugames@gmail.com', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', 1234, '2018-05-07 15:47:51', '9e6e97ff3cf121f838fb9513eb7073f9', 'upload/Screenshot_2018-04-09_20-46-04.png', 1);

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
  MODIFY `data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
