-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2018 at 02:41 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smartroom`
--

-- --------------------------------------------------------

--
-- Table structure for table `daily`
--

CREATE TABLE `daily` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `kw` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `daily`
--

INSERT INTO `daily` (`id`, `date`, `kw`) VALUES
(1, '2018-07-01', 20),
(2, '2018-07-02', 23),
(3, '2018-07-03', 21),
(4, '2018-07-04', 21),
(5, '2018-07-05', 25),
(6, '2018-07-06', 22),
(7, '2018-07-07', 21),
(25, '2018-07-08', 14),
(26, '2018-07-09', 24);

-- --------------------------------------------------------

--
-- Table structure for table `lastupdate`
--

CREATE TABLE `lastupdate` (
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lastupdate`
--

INSERT INTO `lastupdate` (`date`) VALUES
('2018-07-21');

-- --------------------------------------------------------

--
-- Table structure for table `light`
--

CREATE TABLE `light` (
  `lid` int(11) NOT NULL,
  `status` varchar(11) NOT NULL,
  `ampher` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `light`
--

INSERT INTO `light` (`lid`, `status`, `ampher`) VALUES
(1, 'OFF', 2.3),
(2, 'OFF', 3.4),
(3, 'OFF', 3.2);

-- --------------------------------------------------------

--
-- Table structure for table `lightusage`
--

CREATE TABLE `lightusage` (
  `usageid` int(20) NOT NULL,
  `datetime` datetime NOT NULL,
  `status` varchar(10) NOT NULL,
  `lid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lightusage`
--

INSERT INTO `lightusage` (`usageid`, `datetime`, `status`, `lid`) VALUES
(30, '2018-07-08 00:00:00', 'ON', 1),
(31, '2018-07-08 04:00:00', 'OFF', 1),
(34, '2018-07-08 00:00:00', 'ON', 2),
(35, '2018-07-08 03:00:00', 'OFF', 2),
(38, '2018-07-08 00:00:00', 'ON', 3),
(39, '2018-07-08 04:00:00', 'OFF', 3),
(42, '2018-07-09 00:00:00', 'ON', 1),
(43, '2018-07-09 03:00:00', 'OFF', 1),
(46, '2018-07-09 00:00:00', 'ON', 2),
(47, '2018-07-09 07:00:00', 'OFF', 2),
(48, '2018-07-09 00:00:00', 'ON', 3),
(49, '2018-07-09 05:00:00', 'OFF', 3);

-- --------------------------------------------------------

--
-- Table structure for table `teperature`
--

CREATE TABLE `teperature` (
  `id` int(11) NOT NULL,
  `temp` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teperature`
--

INSERT INTO `teperature` (`id`, `temp`) VALUES
(0, 23);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`) VALUES
('admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daily`
--
ALTER TABLE `daily`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lightusage`
--
ALTER TABLE `lightusage`
  ADD PRIMARY KEY (`usageid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daily`
--
ALTER TABLE `daily`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `lightusage`
--
ALTER TABLE `lightusage`
  MODIFY `usageid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
