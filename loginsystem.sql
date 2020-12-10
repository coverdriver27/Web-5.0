-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2020 at 07:40 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loginsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `fishing`
--

CREATE TABLE `fishing` (
  `id` int(11) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `description` varchar(200) NOT NULL,
  `location_status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fishing`
--

INSERT INTO `fishing` (`id`, `lat`, `lng`, `description`, `location_status`) VALUES
(1, 34.348415, -119.658936, 'Comment', 1),
(2, 33.921017, -118.593262, 'Best spot', 1),
(3, 33.838928, -118.461426, '', 1),
(4, 33.701939, -118.340576, '', 1),
(5, 33.637936, -118.186768, 'edge of beach', 1),
(6, 33.482304, -117.769287, '', 1),
(7, 32.921547, -117.318848, '', 1),
(8, 34.194073, -116.989258, 'Shore', 0),
(9, 33.674515, -113.253906, '', 0),
(10, 33.879536, -115.905762, '', 0),
(11, 34.257660, -120.658691, 'sdds', 0);

-- --------------------------------------------------------

--
-- Table structure for table `fishing33_rating_info`
--

CREATE TABLE `fishing33_rating_info` (
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `rating_action` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `map`
--

CREATE TABLE `map` (
  `mapID` int(8) NOT NULL,
  `mapName` tinytext NOT NULL,
  `mapAdmin` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `map`
--

INSERT INTO `map` (`mapID`, `mapName`, `mapAdmin`) VALUES
(33, 'Fishing', 6),
(34, 'Sports', 4),
(35, 'SpelunkingCave', 6);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `text`) VALUES
(1, 'This is the first post'),
(2, 'This is the second piece of text'),
(3, 'This is the third post'),
(4, 'This is the fourth piece of text');

-- --------------------------------------------------------

--
-- Table structure for table `rating_info`
--

CREATE TABLE `rating_info` (
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `rating_action` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating_info`
--

INSERT INTO `rating_info` (`user_id`, `post_id`, `rating_action`) VALUES
(2, 2, 'like'),
(2, 4, 'like');

-- --------------------------------------------------------

--
-- Table structure for table `spelunkingcave`
--

CREATE TABLE `spelunkingcave` (
  `id` int(11) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `description` varchar(200) NOT NULL,
  `location_status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `spelunkingcave`
--

INSERT INTO `spelunkingcave` (`id`, `lat`, `lng`, `description`, `location_status`) VALUES
(1, 33.436474, -116.494873, '', 0),
(2, 35.528194, -118.362549, 'Deep cave', 1),
(3, 35.268486, -116.022461, '', 1),
(4, 35.787064, -116.626709, '', 0),
(5, 34.647209, -119.757812, '', 0),
(6, 34.213367, -117.972534, '', 0),
(7, 34.217911, -117.722595, '', 1),
(8, 34.315514, -118.307617, '', 1),
(9, 34.177017, -117.200745, '', 1),
(10, 34.097450, -116.939819, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sports`
--

CREATE TABLE `sports` (
  `id` int(11) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `description` varchar(200) NOT NULL,
  `location_status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sports`
--

INSERT INTO `sports` (`id`, `lat`, `lng`, `description`, `location_status`) VALUES
(1, 34.058632, -118.279495, 'Basketball', 0),
(2, 34.024368, -118.276375, 'Soccer', 0),
(3, 34.044571, -118.411987, '', 1),
(4, 34.009899, -118.247375, '', 0),
(5, 33.990685, -118.318611, '', 1),
(6, 33.998230, -118.267799, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idUsers` int(11) NOT NULL,
  `emailUsers` tinytext NOT NULL,
  `fnameUsers` tinytext NOT NULL,
  `lnameUsers` tinytext NOT NULL,
  `bdayUsers` date NOT NULL,
  `pwdUsers` longtext NOT NULL,
  `nlogUsers` int(11) DEFAULT 1,
  `logdate` date DEFAULT NULL,
  `sq1Users` tinytext NOT NULL,
  `sq2Users` tinytext NOT NULL,
  `sqa1Users` longtext NOT NULL,
  `sqa2Users` longtext NOT NULL,
  `forgot_pass_identity` longtext DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT 0,
  `hashUsers` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idUsers`, `emailUsers`, `fnameUsers`, `lnameUsers`, `bdayUsers`, `pwdUsers`, `nlogUsers`, `logdate`, `sq1Users`, `sq2Users`, `sqa1Users`, `sqa2Users`, `forgot_pass_identity`, `active`, `hashUsers`) VALUES
(1, 'john@mail.com', 'John', 'Doe', '1989-07-17', '$2y$10$/Q8Exy.fLXa2saKi4couCeJ3zoNlsvTDK8N/O.D14iiJzjyEhDyc.', 1, NULL, '1', '2', '$2y$10$LbivwW8fRJKjT1c77K58puLLZjdbUR6jkq2mEUOVmb693CHtlMBiS', '$2y$10$nADFoBj/syYND4wmCfVbWu.MqZc0/XtFcd17xeyJMTe4/7voL31Ru', NULL, 1, 'da0d1111d2dc5d489242e60ebcbaf988'),
(2, 'Helen@test.com', 'Helen', 'Lindsey', '1988-07-13', '$2y$10$AsoPwPGeLyVHncBOHdUiIO1E7ohUEoFDCc7Lqg3eHN0JjmeaWTGsS', 1, NULL, '1', '1', '$2y$10$B0DXNBO2Sl9UzdclxB50leM7dBeHmMz3O0YvBP0DI0RvxVNgAptZG', '$2y$10$EPcwjFxBtJzRzeCUOFLIlOSQsfx5vw7zTpCRLxPFS12ejXkagt4ue', NULL, 0, 'e2230b853516e7b05d79744fbd4c9c13'),
(3, 'Marion@mail.com', 'Marion', 'Huff', '1993-10-20', '$2y$10$1KbyQVDBoLF/rDSQzofGi.E.9KW0K7gV7pgFS9aAr/ymF5XpYNThi', 1, NULL, '4', '4', '$2y$10$jMZG3kfkDxI1aBwSHPA/SeQfb4Y5KYtLDXmh4mYQB9OnszFKWX3wG', '$2y$10$BP0rEew2xKQyJB89.cyos.SbD8L5H5kkvlmozD2Mj3QZkmN6SlZSe', NULL, 1, '7c590f01490190db0ed02a5070e20f01'),
(4, 'Geneee@themail.com', 'Gene', 'Luna', '1994-02-14', '$2y$10$aaiNHN0c6FPH4T3rosl0KeF1ESIRagc01mL2oklah0beiMNW3IqMy', 2, '2020-05-03', '1', '1', '$2y$10$B/IYvlcO/tYDHSck1dkSuOy9qHQv1wMzHrFbllOfSATSobwLHzWMW', '$2y$10$lMB7enBjlM7cTXEreBc1Oe2lYUYaThkUgi9Z6s7ohgrSXdU2w1zfG', '', 1, 'fe9fc289c3ff0af142b6d3bead98a923'),
(6, 'kevolution818@gmail.com', 'Kevin', 'Gonzalez', '1989-07-17', '$2y$10$lHG4OKpY/N4StHkqfKWcuegguQKD9V3CbPkX9BZYd1apd7b85Q5yy', 10, '2020-05-03', '1', '1', '$2y$10$6SubTmUVMV05pvYYxR.jquDG4X/9zUuB9KyG804JYmTPQadBi99Pu', '$2y$10$WJ6WzuQY.TQHQAb.kmjHDO0nnZjuwa7a1e4yB19wWPvOEKWs9KSK.', '8a1fe2c4eb70adc2bf592e734069b719', 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fishing`
--
ALTER TABLE `fishing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fishing33_rating_info`
--
ALTER TABLE `fishing33_rating_info`
  ADD UNIQUE KEY `UC_rating_info` (`user_id`,`post_id`);

--
-- Indexes for table `map`
--
ALTER TABLE `map`
  ADD PRIMARY KEY (`mapID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating_info`
--
ALTER TABLE `rating_info`
  ADD UNIQUE KEY `UC_rating_info` (`user_id`,`post_id`);

--
-- Indexes for table `spelunkingcave`
--
ALTER TABLE `spelunkingcave`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sports`
--
ALTER TABLE `sports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUsers`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fishing`
--
ALTER TABLE `fishing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `map`
--
ALTER TABLE `map`
  MODIFY `mapID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `spelunkingcave`
--
ALTER TABLE `spelunkingcave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sports`
--
ALTER TABLE `sports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idUsers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
