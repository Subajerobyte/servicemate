-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2024 at 08:21 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jero_jrc`
--

-- --------------------------------------------------------

--
-- Table structure for table `jrcserialhistory`
--

CREATE TABLE `jrcserialhistory` (
  `id` int(11) NOT NULL,
  `createdon` varchar(30) DEFAULT NULL,
  `createdby` varchar(100) DEFAULT NULL,
  `branch` varchar(100) DEFAULT NULL,
  `sourceid` varchar(15) DEFAULT NULL,
  `consigneeid` varchar(15) DEFAULT NULL,
  `productid` varchar(15) DEFAULT NULL,
  `calltid` varchar(100) DEFAULT NULL,
  `serialnumber` varchar(100) DEFAULT NULL,
  `oldserialnumber` text DEFAULT NULL,
  `remarks` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jrcserialhistory`
--
ALTER TABLE `jrcserialhistory`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jrcserialhistory`
--
ALTER TABLE `jrcserialhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
