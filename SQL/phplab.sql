-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2016 at 06:26 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phplab`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `address_id` int(10) NOT NULL,
  `address_line_1` varchar(45) DEFAULT NULL,
  `address_line_2` varchar(45) DEFAULT NULL,
  `address_zip` varchar(20) DEFAULT NULL,
  `address_city` varchar(45) DEFAULT NULL,
  `address_province` varchar(45) DEFAULT NULL,
  `address_country` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`address_id`, `address_line_1`, `address_line_2`, `address_zip`, `address_city`, `address_province`, `address_country`) VALUES
(36, 'Plovdiv', 'Plovdiv', '4000', 'Plovdiv', 'Plovdiv', 'Bulgaria'),
(37, 'Isaydasydkjahsdkjh', 'Kjsahdkjsahdkjah', '6499', 'Haskovo', 'Haskovo', 'Haskovo'),
(38, 'Kiteitre', 'Kiril', '6120', 'Haskovo', 'Haskovo', 'Haskovo'),
(39, 'Asdad', 'Dasdds', '1234', 'Sadasd', 'Dasdasd', 'Dasdasd');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `note_id` int(10) NOT NULL,
  `note_user_id` int(10) DEFAULT NULL,
  `note_text` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`note_id`, `note_user_id`, `note_text`) VALUES
(45, 29, 'asdasdasd'),
(46, 30, 'S poveche sos molq .. i bez domati '),
(47, 31, 'sxcaxcdslojsojxaoisjdowd jodjsad sajd osadj');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_fname` varchar(45) DEFAULT NULL,
  `user_mname` varchar(45) DEFAULT NULL,
  `user_lname` varchar(45) DEFAULT NULL,
  `user_login` varchar(30) DEFAULT NULL,
  `user_email` varchar(64) DEFAULT NULL,
  `user_phone` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_fname`, `user_mname`, `user_lname`, `user_login`, `user_email`, `user_phone`) VALUES
(29, 'Ivailo', 'Sakaliev', 'Venelinov', 'ivosakata', 'ivo.sakaliev1996@fds.bg', '0987654321'),
(30, 'Vankata', 'Ivanov', 'Alsud', 'vanchaaaaaWe', 'magareto4o4ka@abv.bg', '03290218309'),
(31, 'Ivailo', 'Sakaliev', 'Venelinov', 'ivosakata', 'ivo.sakaliev1996@fds.bg', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_addresses`
--

CREATE TABLE `users_addresses` (
  `ua_id` int(10) NOT NULL,
  `ua_user_id` int(10) DEFAULT NULL,
  `ua_address_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_addresses`
--

INSERT INTO `users_addresses` (`ua_id`, `ua_user_id`, `ua_address_id`) VALUES
(36, 29, 37),
(37, 30, 38),
(38, 30, 39),
(39, 31, 40);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`note_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_addresses`
--
ALTER TABLE `users_addresses`
  ADD PRIMARY KEY (`ua_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `address_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `note_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `users_addresses`
--
ALTER TABLE `users_addresses`
  MODIFY `ua_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
