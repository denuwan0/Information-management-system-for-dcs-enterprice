-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2024 at 05:24 AM
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
-- Table structure for table `emp_special_task_assign_emp`
--

CREATE TABLE `emp_special_task_assign_emp` (
  `assign_emp_line_id` int(10) NOT NULL,
  `special_task_id` int(10) NOT NULL,
  `branch_id` int(10) NOT NULL,
  `emp_id` int(10) NOT NULL,
  `invoice_id` int(10) NOT NULL,
  `task_start_date` varchar(20) NOT NULL,
  `task_end_date` varchar(20) NOT NULL,
  `is_complete` tinyint(1) NOT NULL,
  `is_active_sp_task_assign` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emp_special_task_assign_emp`
--
ALTER TABLE `emp_special_task_assign_emp`
  ADD PRIMARY KEY (`assign_emp_line_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emp_special_task_assign_emp`
--
ALTER TABLE `emp_special_task_assign_emp`
  MODIFY `assign_emp_line_id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
