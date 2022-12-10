-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 07, 2022 at 09:07 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`) VALUES
(1, 'India'),
(2, 'United States'),
(3, 'Canada'),
(4, 'Nepal');

-- --------------------------------------------------------

--
-- Table structure for table `municiples`
--
CREATE TABLE `districts` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `municipality_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `districts` (`id`, `name`, `municipality_id`) VALUES
(1, 'San Diego', 1),
(2, 'Los Angeles', 2),
(3, 'San Jose', 3),
(4, 'San Francisco', 4),
(5, 'Fresno', 5),
(6, 'Phoenix', 6),
(7, 'Tucson', 7),
(8, 'Mesa', 8),
(9, 'Chandler', 9),
(10, 'Houston', 10),
(11, 'San Antonio', 11),
(12, 'Dallas', 12),
(13, '	Austin', 13),
(14, 'Garland', 14),
(15, 'Calgary', 15),
(16, 'Strathcona County', 16),
(17, 'Canmore', 17),
(18, 'Medicine Hat', 18),
(19, 'Toronto', 19),
(20, 'Ottawa', 20),
(21, 'Mississauga', 21),
(22, 'Amaravati', 22),
(23, 'Anantapur', 23),
(24, 'Bhimavaram', 24),
(25, 'Chirala', 25),
(26, 'Lucknow', 26),
(27, 'Kanpur', 27),
(28, 'Varanasi', 28),
(29, 'Mumbai', 29),
(30, 'Pune', 30),
(31, 'Nagpur', 31),
(32, 'Jhapa', 32),
(33, 'Morang', 33),
(34, 'Jhapa', 34),
(35, 'Jhapa', 35),
(36, 'Udayapur', 36),
(37, 'Morang', 31),
(38, 'Sunsari	', 38),
(39, 'Morang', 39),
(40, 'Jhapa', 40),
(41, 'Morang', 41),
(42, 'Ilam', 42),
(43, 'Ilam', 43),
(44, 'Ilam', 44),
(45, 'Bara', 45),
(46, 'Chitwan', 46),
(47, 'Bhojpur', 47),
(48, 'Dhankuta', 48),
(49, 'Taplejung', 49),
(50, 'Dhankuta', 50),
(51, 'Sunsari', 51),
(53, 'Sankhuwasaba', 53),
(54, 'Saptari', 54),
(55, 'Parsa', 54),
(56, 'Mahotari', 56),
(57, 'Siraha', 57),
(58, 'Siraha', 58),
(59, 'Sindupalchowk', 59),
(60, 'Kavre', 60),
(61, 'Nuwakot', 61),
(62, 'Lalitpur', 62),
(63, 'Sarlahi', 63),
(64, 'Baglung', 64),
(65, 'Tanahun', 65),
(66, 'Gorkha', 66),
(67, 'Myagdi District', 67),
(68, 'Lamjung', 68),
(69, 'Tanahun', 69),
(70, 'Tanahun', 70),
(71, 'Syangjha', 71),
(72, 'Gorkha', 72),
(73, 'Tanahun', 73),
(74, 'Bardiya', 74),
(75, 'Bardiya', 75),
(76, 'Rupandehi', 76),
(77, 'Kapilvastu', 77),
(78, 'Rupandehi', 78),
(79, 'Dailekh', 79),
(80, 'Dailekh', 80),
(81, 'Dailekh', 81),
(82, 'Dailekh', 82),
(83, 'Lalitpur', 83),
(84, 'Kailali', 84),
(85, 'Kailali', 85),
(86, 'Kailali', 86),
(87, 'Kanchanpur', 87);




CREATE TABLE `municiples` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `province_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Dumping data for table `municiples`
--

INSERT INTO `municiples` (`id`, `name`, `province_id`) VALUES
(1, 'San Diego', 3),
(2, 'Los Angeles', 3),
(3, 'San Jose', 3),
(4, 'San Francisco', 3),
(5, 'Fresno', 3),
(6, 'Phoenix', 4),
(7, 'Tucson', 4),
(8, 'Mesa', 4),
(9, 'Chandler', 4),
(10, 'Houston', 5),
(11, 'San Antonio', 5),
(12, 'Dallas', 5),
(13, '	Austin', 5),
(14, 'Garland', 5),
(15, 'Calgary', 1),
(16, 'Strathcona County', 1),
(17, 'Canmore', 1),
(18, 'Medicine Hat', 1),
(19, 'Toronto', 2),
(20, 'Ottawa', 2),
(21, 'Mississauga', 2),
(22, 'Amaravati', 6),
(23, 'Anantapur', 6),
(24, 'Bhimavaram', 6),
(25, 'Chirala', 6),
(26, 'Lucknow', 7),
(27, 'Kanpur', 7),
(28, 'Varanasi', 7),
(29, 'Mumbai', 8),
(30, 'Pune', 8),
(31, 'Nagpur', 8),
(32, 'Mechinagar', 9),
(33, 'Sundar Haraicha', 9),
(34, 'Birtamod', 9),
(35, 'Damak', 9),
(36, 'Triyuga', 9),
(37, 'Belbari', 9),
(38, '	Inaruwa', 9),
(39, 'Belbari', 9),
(40, 'Shivasatakshi Municipality', 9),
(41, '	Pathari Shanischare	', 9),
(42, '	Suryodaya', 9),
(43, 'Ilam', 9),
(44, 'Deumai', 9),
(45, 'Rangeli', 9),
(46, 'Madi', 9),
(47, '	Bhojpur', 9),
(48, 'Dhankuta', 9),
(49, 'Phungling', 9),
(50, 'Pakhribas', 9),
(51, 'Duhabi', 9),
(53, 'Chainpur', 9),
(54, 'Balan Bihul Rural Municipality', 10),
(55, 'Bahudaramai Municipality', 10),
(56, 'Aurahi Municipality', 10),
(57, 'Aaurahi Rural Municipality', 10),
(58, 'Arnama Rural Municipality', 10),
(59, 'Barhabise Municipality', 11),
(60, 'Banepa Municipality', 11),
(61, 'Belkotgadhi Municipality', 11),
(62, 'Bagmati Rural Municipality', 11),
(63, 'Bagmati Municipality', 11),
(64, 'Baglung Municipality', 12),
(65, 'Bandipur Rural Municipality', 12),
(66, 'Barpak Sulikot Rural Municipal', 12),
(67, 'Beni Municipality	', 12),
(68, 'Besishahar Municipality', 12),
(69, 'Bhanu Municipality', 12),
(70, 'Bhimad Municipality', 12),
(71, 'Chapakot Municipality', 12),
(72, 'Chum Nubri Rural Municipality', 12),
(73, 'Byas Municipality', 12),
(74, 'Bansgadhi', 13),
(75, 'Barbardiya', 13),
(76, 'Devdaha', 13),
(77, 'Kapilvastu Municipality', 13),
(78, 'Lumbini Sanskritik', 13),
(79, 'Dullu Municipality', 14),
(80, 'Dungeshwor Rural Municipality', 14),
(81, 'Gurans Rural Municipality', 14),
(82, 'Narayan Municipality', 14),
(83, 'Godawari Municipality', 14),
(84, 'Ghodaghodi Municipality', 15),
(85, 'Gauriganga Municipality', 15),
(86, 'Tikapur Municipality	', 15),
(87, 'Bedkot Municipality', 15);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `name` varchar(60) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(60) DEFAULT NULL,
  `language` varchar(60) DEFAULT NULL,
  `country` varchar(60) DEFAULT NULL,
  `province` varchar(60) DEFAULT NULL,
  `municipality` varchar(60) DEFAULT NULL,
  `address` varchar(60) DEFAULT NULL,
  `mobile` int(11) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `date` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `name`, `age`, `gender`, `language`, `country`, `province`, `municipality`, `address`, `mobile`, `patient_id`, `date`) VALUES
(1, 'ss', NULL, 'm', 'nepali', 'United States', 'Arizona', 'Tucson', '33', 22, 1, 'Wed Dec 07 2022 13:10:41 GMT+0545 (Nepal Time)'),
(2, 'ss', 22, 'm', 'nepali, hindi, english', 'Nepal', 'Bagmati Kshetra', 'Belkotgadhi Municipality', '33', 45, 1, 'Wed Dec 07 2022 13:12:23 GMT+0545 (Nepal Time)'),
(5, 'dd', 22, 'm', 'nepali', 'Canada', 'Ontario', 'Ottawa', 'dd', 22, 1, 'Wed Dec 07 2022 13:21:13 GMT+0545 (Nepal Time)'),
(6, 'sakshyam', 12, 'f', 'nepali, hindi', 'Canada', 'Ontario', 'Ottawa', 'sakshyaf', 22, 45941206, 'Wed Dec 07 2022 13:47:04 GMT+0545 (Nepal Time)'),
(7, 'aryal', 12, 'm', 'nepali, english', 'India', 'Uttar Pradesh', 'Varanasi', '333', 1111111111, 40922352, 'Wed Dec 07 2022 13:51:53 GMT+0545 (Nepal Time)');

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`id`, `name`, `country_id`) VALUES
(1, 'Alberta', 3),
(2, 'Ontario', 3),
(3, 'California', 2),
(4, 'Arizona', 2),
(5, 'Texas', 2),
(6, 'Andhra Pradesh', 1),
(7, 'Uttar Pradesh', 1),
(8, 'Maharastra', 1),
(9, 'Province No. 1', 4),
(10, 'Madesh Kshetra', 4),
(11, 'Bagmati Kshetra', 4),
(12, 'Gandaki Kshetra', 4),
(13, 'Lumbini Kshetra', 4),
(14, 'Karnali Kshetra', 4),
(15, 'Mahakali Kshetra', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `municiples`
--
ALTER TABLE `municiples`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `municiples`
--
ALTER TABLE `municiples`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
