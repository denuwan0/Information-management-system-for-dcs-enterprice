-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2024 at 05:11 AM
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
-- Table structure for table `emp_special_task_header`
--

CREATE TABLE `emp_special_task_header` (
  `special_task_id` int(10) NOT NULL,
  `task_name` varchar(200) NOT NULL,
  `task_type` varchar(200) NOT NULL,
  `is_active_sp_task` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp_special_task_header`
--

INSERT INTO `emp_special_task_header` (`special_task_id`, `task_name`, `task_type`, `is_active_sp_task`) VALUES
(1, 'General Yard Work', 'General Work', 1),
(2, 'Scaffolding Project', 'Scaffolding', 1),
(3, 'Heavy Vehicle Operation', 'Heavy Vehicle Operation', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emp_special_task_header`
--
ALTER TABLE `emp_special_task_header`
  ADD PRIMARY KEY (`special_task_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emp_special_task_header`
--
ALTER TABLE `emp_special_task_header`
  MODIFY `special_task_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
