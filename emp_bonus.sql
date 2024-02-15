-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2024 at 11:48 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dcs_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `emp_bonus`
--

CREATE TABLE `emp_bonus` (
  `bonus_id` int(10) NOT NULL,
  `bonus_name` varchar(200) NOT NULL,
  `bonus_desc` varchar(200) NOT NULL,
  `is_active_bonus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data for table `emp_bonus`
--

INSERT INTO `emp_bonus` (`bonus_id`, `bonus_name`, `bonus_desc`, `is_active_bonus`) VALUES
(1, 'Annual Bonus', 'Annual Bonus', 1),
(2, 'Medical Bonus', 'Medical Bonus', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emp_bonus`
--
ALTER TABLE `emp_bonus`
  ADD PRIMARY KEY (`bonus_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emp_bonus`
--
ALTER TABLE `emp_bonus`
  MODIFY `bonus_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
