-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2024 at 10:24 AM
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
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `bank_id` int(10) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `is_active_bank` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`bank_id`, `bank_name`, `is_active_bank`) VALUES
(1, 'HNB', 1),
(2, 'NDB', 1),
(3, 'BOC', 1),
(4, 'DFCC', 1),
(5, 'HDFC', 1),
(6, 'People\'s', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bank_account_details`
--

CREATE TABLE `bank_account_details` (
  `account_id` int(10) NOT NULL,
  `account_no` int(10) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `b_branch_id` int(10) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `is_active_bank_acc` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bank_account_details`
--

INSERT INTO `bank_account_details` (`account_id`, `account_no`, `account_name`, `b_branch_id`, `contact_no`, `is_active_bank_acc`) VALUES
(1, 12121212, 'DCS Pvt Ltd', 1, '211212', 1),
(2, 1111111111, 'saas', 4, '324343', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bank_branch`
--

CREATE TABLE `bank_branch` (
  `b_branch_id` int(10) NOT NULL,
  `bank_id` int(10) NOT NULL,
  `location_id` int(10) NOT NULL,
  `b_branch_code` varchar(100) NOT NULL,
  `b_branch_address` varchar(200) NOT NULL,
  `b_branch_contact` varchar(20) NOT NULL,
  `b_bank_swift_code` varchar(255) NOT NULL,
  `is_active_bank_b_branch` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bank_branch`
--

INSERT INTO `bank_branch` (`b_branch_id`, `bank_id`, `location_id`, `b_branch_code`, `b_branch_address`, `b_branch_contact`, `b_bank_swift_code`, `is_active_bank_b_branch`) VALUES
(1, 1, 1, 'HNBKD', 'Kadawata', '121212121', 'sds121', 1),
(2, 3, 4, 'BOCNIT', 'Nittambuwa', '21212121', '212121', 1),
(3, 2, 1, 'NDBKD', 'Kadawata', '342322', 'vf32132', 1),
(4, 4, 1, 'DFCCKD', 'Kadawata', '121654562', 'sdx213', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bank_deposit`
--

CREATE TABLE `bank_deposit` (
  `bank_deposit_id` int(10) NOT NULL,
  `account_id` int(10) NOT NULL,
  `created_emp_id` int(10) NOT NULL,
  `deposit_total_amount` decimal(10,2) NOT NULL,
  `create_date` varchar(10) NOT NULL,
  `created_time` varchar(10) NOT NULL,
  `deposit_narration_no` varchar(200) NOT NULL,
  `deposit_transaction_no` varchar(200) NOT NULL,
  `branch_id` int(10) NOT NULL,
  `bank_deposit_type` varchar(100) NOT NULL COMMENT 'online, bank slip',
  `verified_emp_id` int(10) NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `is_active_bank_deposit` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bank_deposit`
--

INSERT INTO `bank_deposit` (`bank_deposit_id`, `account_id`, `created_emp_id`, `deposit_total_amount`, `create_date`, `created_time`, `deposit_narration_no`, `deposit_transaction_no`, `branch_id`, `bank_deposit_type`, `verified_emp_id`, `is_verified`, `is_active_bank_deposit`) VALUES
(1, 1, 1, '1.00', '1', '1', '1', '1', 1, '1', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_id` int(10) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_address` varchar(255) NOT NULL,
  `company_contact` varchar(255) NOT NULL,
  `company_about_us` varchar(255) NOT NULL,
  `company_logo` varchar(255) NOT NULL,
  `company_country` int(10) NOT NULL,
  `is_active_company` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `company_name`, `company_address`, `company_contact`, `company_about_us`, `company_logo`, `company_country`, `is_active_company`) VALUES
(1, 'DCS', 'Dalupitiya, Wattala', '2121212121', 'test', 'http://localhost/API/assets/img/dcs.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `company_branch`
--

CREATE TABLE `company_branch` (
  `company_branch_id` int(10) NOT NULL,
  `company_id` int(10) NOT NULL,
  `company_branch_name` varchar(255) NOT NULL,
  `location_id` int(10) NOT NULL,
  `branch_contact` int(10) NOT NULL,
  `branch_manager` int(10) NOT NULL,
  `branch_address` varchar(255) NOT NULL,
  `is_active_branch` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company_branch`
--

INSERT INTO `company_branch` (`company_branch_id`, `company_id`, `company_branch_name`, `location_id`, `branch_contact`, `branch_manager`, `branch_address`, `is_active_branch`) VALUES
(1, 1, 'Wattala', 2, 2147483611, 8, 'Wattala', 1),
(2, 1, 'Kadawatha', 1, 712917184, 7, 'Kadawatha', 1),
(3, 1, 'Nittambuwa', 4, 712917184, 7, 'Kandy Rd, Nittambuwa', 1),
(4, 1, 'Kadana', 4, 21212121, 5, 'Negambo Rd, Kadana', 1);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` int(10) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `country_desc` varchar(255) NOT NULL,
  `is_active_country` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country_name`, `country_desc`, `is_active_country`) VALUES
(1, 'Sri Lanka', 'Sri Lanka	', 1),
(2, 'Japan', 'Japan', 1),
(3, 'India', 'India', 0),
(4, 'China', 'China', 1),
(5, 'Russia', 'Russia', 1),
(6, 'Dubai', 'Dubai', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(10) NOT NULL,
  `customer_name` varchar(200) NOT NULL,
  `customer_working_address` varchar(200) NOT NULL,
  `customer_shipping_address` varchar(255) NOT NULL,
  `customer_nic_address` varchar(200) NOT NULL,
  `customer_old_nic_no` varchar(20) NOT NULL,
  `customer_new_nic_no` varchar(20) NOT NULL,
  `customer_contact_no` varchar(20) NOT NULL,
  `customer_email` varchar(25) NOT NULL,
  `created_date` varchar(10) NOT NULL,
  `is_web` tinyint(1) NOT NULL,
  `is_active_customer` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_working_address`, `customer_shipping_address`, `customer_nic_address`, `customer_old_nic_no`, `customer_new_nic_no`, `customer_contact_no`, `customer_email`, `created_date`, `is_web`, `is_active_customer`) VALUES
(1, 'Shanaka', 'Hunupitiya, Wattala', 'Hunupitiya, Wattala', 'Hunupitiya, Wattala', '961330456V', '', '94757848081', 'nadeetharu1225@gmail.com', '', 1, 1),
(2, 'Sanjaya Hettiarachchi', 'No.56, Dekatana, Dompe', 'No.56, Dekatana, Dompe', '', '901330456V', '', '9428689591', 'cykatm@gmail.com', '', 1, 1),
(3, 'Pavithra Jayasundara', 'No.4, Makola', 'No.4, Makola', '', '902345654V', '', '9471895456', 'may12contact@gmail.com', '', 1, 1),
(10, 'Charith Porage', '21, Polhena, Madapatha', '21, Polhena, Madapatha', '', '911330768V', '', '0712917184', 'denuwan0@gmail.com', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `emp_advance`
--

CREATE TABLE `emp_advance` (
  `advance_id` int(10) NOT NULL,
  `advance_name` varchar(100) NOT NULL,
  `advance_desc` varchar(100) NOT NULL,
  `is_active_advance` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp_advance`
--

INSERT INTO `emp_advance` (`advance_id`, `advance_name`, `advance_desc`, `is_active_advance`) VALUES
(1, 'Monthly Advance', 'Monthly Advance ', 1),
(2, 'Festival Advance', 'Festival Advance', 1);

-- --------------------------------------------------------

--
-- Table structure for table `emp_allowance`
--

CREATE TABLE `emp_allowance` (
  `allowance_id` int(10) NOT NULL,
  `allowance_name` varchar(20) NOT NULL,
  `allowance_desc` varchar(200) NOT NULL,
  `is_active_emp_allow` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp_allowance`
--

INSERT INTO `emp_allowance` (`allowance_id`, `allowance_name`, `allowance_desc`, `is_active_emp_allow`) VALUES
(1, 'Book Allowance', 'Book allowance', 1),
(2, 'Meal allowance', 'Meal allowance', 1),
(3, 'Holiday Allowance', 'Holiday Allowance', 1);

-- --------------------------------------------------------

--
-- Table structure for table `emp_attendance`
--

CREATE TABLE `emp_attendance` (
  `attendance_id` int(10) NOT NULL,
  `branch_id` int(10) NOT NULL,
  `emp_epf` int(10) NOT NULL,
  `date` varchar(10) NOT NULL,
  `time_in` varchar(10) NOT NULL,
  `time_out` varchar(10) NOT NULL,
  `uploaded_by` int(10) NOT NULL,
  `approved_by` int(10) NOT NULL,
  `is_approved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp_attendance`
--

INSERT INTO `emp_attendance` (`attendance_id`, `branch_id`, `emp_epf`, `date`, `time_in`, `time_out`, `uploaded_by`, `approved_by`, `is_approved`) VALUES
(1, 1, 17534, '02-02-2024', '6:50:00', '19:00:00', 1, 1, 1),
(2, 1, 17533, '02-02-2024', '6:40:00', '19:01:00', 1, 1, 1),
(3, 1, 21212, '02-01-2024', '7:30:00', '20:02:00', 1, 1, 1),
(4, 1, 21213, '02-01-2024', '6:32:00', '19:05:00', 1, 1, 1),
(5, 1, 2542, '02-01-2024', '6:43:00', '19:03:00', 1, 1, 1),
(6, 1, 2543, '02-01-2024', '7:00:00', '19:00:00', 1, 1, 1),
(7, 1, 2121, '02-01-2024', '7:02:00', '19:00:00', 1, 1, 1),
(8, 1, 3212, '02-01-2024', '6:58:00', '19:00:00', 1, 1, 1),
(9, 1, 17534, '01-01-2024', '6:50:00', '19:00:00', 1, 1, 1),
(10, 1, 17533, '01-01-2024', '6:40:00', '19:01:00', 1, 1, 1),
(11, 2, 21212, '01-01-2024', '6:30:00', '19:02:00', 1, 1, 1),
(12, 2, 21213, '01-01-2024', '6:32:00', '19:05:00', 1, 1, 1),
(13, 2, 2542, '01-01-2024', '6:43:00', '19:03:00', 1, 1, 1),
(14, 2, 2543, '01-01-2024', '7:00:00', '19:00:00', 1, 1, 1),
(15, 2, 2121, '01-01-2024', '7:02:00', '19:00:00', 1, 1, 1),
(16, 2, 3212, '01-01-2024', '6:58:00', '19:00:00', 1, 1, 1);

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

-- --------------------------------------------------------

--
-- Table structure for table `emp_designation`
--

CREATE TABLE `emp_designation` (
  `emp_desig_id` int(10) NOT NULL,
  `emp_desig_name` varchar(20) NOT NULL,
  `emp_desig_desc` varchar(200) NOT NULL,
  `is_active_emp_desig` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp_designation`
--

INSERT INTO `emp_designation` (`emp_desig_id`, `emp_desig_name`, `emp_desig_desc`, `is_active_emp_desig`) VALUES
(1, 'Yard Manager', 'Overall manage yard', 1),
(2, 'Driver', 'Lorry driver', 1),
(3, 'Staff', 'General Staff', 1);

-- --------------------------------------------------------

--
-- Table structure for table `emp_details`
--

CREATE TABLE `emp_details` (
  `emp_id` int(10) NOT NULL,
  `emp_epf` int(10) NOT NULL,
  `emp_branch_id` int(10) NOT NULL,
  `emp_company_id` int(10) NOT NULL,
  `emp_first_name` varchar(200) NOT NULL,
  `emp_middle_name` varchar(200) NOT NULL,
  `emp_last_name` varchar(200) NOT NULL,
  `emp_nic` varchar(20) NOT NULL,
  `emp_dob` varchar(10) NOT NULL,
  `emp_perm_address` varchar(300) NOT NULL,
  `emp_temp_address` varchar(300) NOT NULL,
  `emp_contact_no` varchar(20) NOT NULL,
  `emp_email` varchar(100) NOT NULL,
  `emp_emg_contact_no` varchar(20) NOT NULL,
  `is_active_emp` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp_details`
--

INSERT INTO `emp_details` (`emp_id`, `emp_epf`, `emp_branch_id`, `emp_company_id`, `emp_first_name`, `emp_middle_name`, `emp_last_name`, `emp_nic`, `emp_dob`, `emp_perm_address`, `emp_temp_address`, `emp_contact_no`, `emp_email`, `emp_emg_contact_no`, `is_active_emp`) VALUES
(1, 17534, 1, 1, 'Charith', 'Denuwan', 'Porage', '', '12.05.1991', '21, Polhena, Madapatha', 'Welisara, Wattala', '94712917184', 'denuwan0@gmail.com', '94712917184', 1),
(2, 17533, 1, 1, 'Sachith', 'Sasindu', 'Sasindu', '', '26.01.1996', '120/36A, Nahena, Hunupitiya, Wattala', '120/36A, Nahena, Hunupitiya, Wattala', '94712917184', 'denuwan9@gmail.com\n', '94712917184', 1),
(4, 21212, 4, 1, 'Umesh', 'Minsara', 'Minsara', '94131313V', '2023-12-01', '21, Polhena, Madapatha', '21dsdsds', '94712917184', 'umesh@gmail.com', '94712917184', 0),
(5, 21212, 2, 1, 'Tharaka', 'Nadeesha', 'R', '94131313V', '2023-12-01', '21, Polhena, Madapatha', 'sasas', '94712917184', 'denuwan0@gmail.com', '94712917184', 0),
(6, 2542, 4, 1, 'Ravindu', 'Niduk', 'Porage', '424424', '2023-12-02', '21, Polhena, Madapatha', '43dffd', '94712917184', 'denuwan0@yahoo.com', '94712917184', 0),
(7, 2542, 2, 1, 'Hashani', 'Dilrangi', 'Ruberu', '424424', '2023-12-22', '21, Polhena, Madapatha', 'sas2332', '94712917184', 'may12contact@gmail.com\n', '94712917184', 1),
(8, 2121, 1, 1, 'Nadeesha', 'Tharaka', 'Tharaka', '946333263V', '2023-12-02', 'Bandaragama1', 'Bandaragama', '94712917184', 'nadeetharu1225@gmail.com', '94712917184', 1),
(9, 3212, 2, 1, 'Madushanka', 'M', 'D', '991330762V', '1991-01-04', 'No.12, Illukumbura, Matale', 'Enderamulla', '94712917184', 'cykatm@gmail.com\n', '94712917184', 1);

-- --------------------------------------------------------

--
-- Table structure for table `emp_driving_license`
--

CREATE TABLE `emp_driving_license` (
  `driving_license_id` int(10) NOT NULL,
  `emp_id` int(10) NOT NULL,
  `license_number` varchar(100) NOT NULL,
  `valid_from_date` varchar(10) NOT NULL,
  `valid_to_date` varchar(10) NOT NULL,
  `license_type` varchar(10) NOT NULL,
  `is_active_driving_lice` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp_driving_license`
--

INSERT INTO `emp_driving_license` (`driving_license_id`, `emp_id`, `license_number`, `valid_from_date`, `valid_to_date`, `license_type`, `is_active_driving_lice`) VALUES
(1, 2, 'B1447703', '01-01-2020', '01.01.2027', 'Light', 1),
(2, 9, 'B2383231', '2023-12-27', '2023-12-28', 'Heavy', 1),
(3, 4, 'C43434', '2023-11-01', '2024-05-01', 'Heavy', 1);

-- --------------------------------------------------------

--
-- Table structure for table `emp_final_salary`
--

CREATE TABLE `emp_final_salary` (
  `final_sal_id` int(10) NOT NULL,
  `sal_scale_id` int(10) NOT NULL,
  `emp_id` int(10) NOT NULL,
  `month` int(10) NOT NULL,
  `year` int(10) NOT NULL,
  `allowance_amount` decimal(10,2) NOT NULL,
  `advance_amount` decimal(10,2) NOT NULL,
  `created_by_emp_id` int(10) NOT NULL,
  `approved_by_emp_id` int(10) NOT NULL,
  `is_active_final_sal` tinyint(1) NOT NULL,
  `is_paid` tinyint(1) NOT NULL,
  `is_hold` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emp_finger_print_details`
--

CREATE TABLE `emp_finger_print_details` (
  `fp_line_id` int(10) NOT NULL,
  `emp_id` int(10) NOT NULL,
  `date` varchar(10) NOT NULL,
  `in_time` varchar(5) NOT NULL,
  `out_time` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emp_grade`
--

CREATE TABLE `emp_grade` (
  `emp_grade_id` int(10) NOT NULL,
  `emp_grade_name` varchar(100) NOT NULL,
  `emp_grade_desc` varchar(100) NOT NULL,
  `is_active_emp_grade` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp_grade`
--

INSERT INTO `emp_grade` (`emp_grade_id`, `emp_grade_name`, `emp_grade_desc`, `is_active_emp_grade`) VALUES
(1, 'Grade A', 'Highest Salary Grade', 1),
(2, 'Grade B', 'Second Highest Salary Grade', 1),
(3, 'Grade C', 'Third Highest Salary Grade', 1);

-- --------------------------------------------------------

--
-- Table structure for table `emp_group`
--

CREATE TABLE `emp_group` (
  `emp_group_id` int(10) NOT NULL,
  `emp_group_name` varchar(20) NOT NULL,
  `emp_group_desc` varchar(100) NOT NULL,
  `emp_grade_id` int(10) NOT NULL,
  `emp_designation_id` int(10) NOT NULL,
  `is_active_emp_group` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp_group`
--

INSERT INTO `emp_group` (`emp_group_id`, `emp_group_name`, `emp_group_desc`, `emp_grade_id`, `emp_designation_id`, `is_active_emp_group`) VALUES
(1, 'Manager Group', 'Group for Managers', 2, 1, 1),
(2, 'Driver Group', 'Group for Drivers', 3, 2, 1),
(3, 'Staff Group', 'General Staff Group', 2, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `emp_holiday_calender`
--

CREATE TABLE `emp_holiday_calender` (
  `calendar_id` int(10) NOT NULL,
  `holiday_date` varchar(10) NOT NULL,
  `holoday_name` varchar(100) NOT NULL,
  `calendar_year` int(10) NOT NULL,
  `created_date` varchar(10) NOT NULL,
  `created_by_emp_id` int(10) NOT NULL,
  `is_active_calendar` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emp_leave_details`
--

CREATE TABLE `emp_leave_details` (
  `leave_detail_id` int(10) NOT NULL,
  `leave_from_date` varchar(10) NOT NULL,
  `leave_to_date` varchar(10) NOT NULL,
  `emp_id` int(10) NOT NULL,
  `branch_id` int(10) NOT NULL,
  `emp_wise_leave_quota_id` int(10) NOT NULL,
  `leave_amount` varchar(5) NOT NULL,
  `leave_start_time` varchar(10) NOT NULL,
  `leave_end_time` varchar(10) NOT NULL,
  `created_by` int(10) NOT NULL,
  `approved_by` int(10) NOT NULL,
  `rejected_by` int(10) NOT NULL,
  `is_rejected_leave` tinyint(1) NOT NULL,
  `is_approved_leave` tinyint(1) NOT NULL,
  `is_active_leave_details` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp_leave_details`
--

INSERT INTO `emp_leave_details` (`leave_detail_id`, `leave_from_date`, `leave_to_date`, `emp_id`, `branch_id`, `emp_wise_leave_quota_id`, `leave_amount`, `leave_start_time`, `leave_end_time`, `created_by`, `approved_by`, `rejected_by`, `is_rejected_leave`, `is_approved_leave`, `is_active_leave_details`) VALUES
(1, '2024-02-01', '2024-02-01', 8, 1, 6, '1', '', '', 53, 0, 0, 0, 0, 1),
(2, '2024-02-26', '2024-02-26', 8, 1, 7, '2', '', '', 53, 0, 0, 0, 0, 1),
(3, '2024-02-25', '2024-02-25', 9, 2, 7, '2', '', '', 55, 0, 0, 0, 0, 0),
(4, '2024-02-25', '2024-02-25', 9, 2, 7, '1', '', '', 55, 3, 0, 0, 1, 1),
(5, '2024-03-01', '2024-03-01', 2, 1, 2, '1', '', '', 54, 53, 53, 1, 0, 1),
(6, '2024-03-02', '2024-03-02', 2, 1, 2, '1', '', '', 54, 53, 0, 0, 1, 1),
(7, '2024-03-06', '2024-03-07', 2, 1, 2, '2', '', '', 54, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `emp_leave_quota`
--

CREATE TABLE `emp_leave_quota` (
  `leave_quota_id` int(10) NOT NULL,
  `year` int(10) NOT NULL,
  `leave_type_id` int(10) NOT NULL,
  `valid_from_date` varchar(20) NOT NULL,
  `valid_to_date` varchar(20) NOT NULL,
  `amount` int(10) NOT NULL,
  `is_active_leave_quota` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp_leave_quota`
--

INSERT INTO `emp_leave_quota` (`leave_quota_id`, `year`, `leave_type_id`, `valid_from_date`, `valid_to_date`, `amount`, `is_active_leave_quota`) VALUES
(1, 2024, 1, '2024-01-01', '2024-12-31', 7, 1),
(2, 2024, 2, '2024-01-01', '2025-03-31', 14, 1),
(3, 2024, 3, '2024-01-01', '2024-12-31', 21, 1),
(4, 2024, 4, '2024-01-01', '2024-12-31', 99, 1);

-- --------------------------------------------------------

--
-- Table structure for table `emp_leave_type`
--

CREATE TABLE `emp_leave_type` (
  `leave_type_id` int(10) NOT NULL,
  `leave_type_name` varchar(100) NOT NULL,
  `is_active_leave_type` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp_leave_type`
--

INSERT INTO `emp_leave_type` (`leave_type_id`, `leave_type_name`, `is_active_leave_type`) VALUES
(1, 'Casual Leave', 1),
(2, 'Annual Leave', 1),
(3, 'Medical Leave', 1),
(4, 'No Pay Leave', 1);

-- --------------------------------------------------------

--
-- Table structure for table `emp_medical_checkup_location`
--

CREATE TABLE `emp_medical_checkup_location` (
  `emp_med_loc_id` int(10) NOT NULL,
  `emp_med_loc_name` varchar(100) NOT NULL,
  `emp_med_loc_contact` varchar(20) NOT NULL,
  `is_active_medical_checkup` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp_medical_checkup_location`
--

INSERT INTO `emp_medical_checkup_location` (`emp_med_loc_id`, `emp_med_loc_name`, `emp_med_loc_contact`, `is_active_medical_checkup`) VALUES
(1, 'Asiri Laboratory Wattala', '0114568258', 1),
(2, 'Nawaloka Laboratory Wattala', '011365248', 1),
(3, 'Durdans Laboratory Wattala', '0112484756', 1);

-- --------------------------------------------------------

--
-- Table structure for table `emp_medical_records`
--

CREATE TABLE `emp_medical_records` (
  `med_record_id` int(10) NOT NULL,
  `this_med_checkup_date` varchar(10) NOT NULL,
  `next_med_checkup_date` varchar(20) NOT NULL,
  `special_note` varchar(200) NOT NULL,
  `emp_id` int(10) NOT NULL,
  `med_loc_id` int(10) NOT NULL,
  `emp_med_status` varchar(10) NOT NULL COMMENT 'normal, moderate, critical',
  `is_active_medical_records` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp_medical_records`
--

INSERT INTO `emp_medical_records` (`med_record_id`, `this_med_checkup_date`, `next_med_checkup_date`, `special_note`, `emp_id`, `med_loc_id`, `emp_med_status`, `is_active_medical_records`) VALUES
(1, '2024-02-01', '2025-02-01', 'Check MRI report', 1, 1, 'good', 1),
(2, '2024-02-05', '2024-08-05', 'Use treadmill', 5, 1, 'good', 1),
(3, '2024-02-25', '2024-05-25', 'nothing special all normal', 2, 2, 'good', 1);

-- --------------------------------------------------------

--
-- Table structure for table `emp_over_time`
--

CREATE TABLE `emp_over_time` (
  `over_time_id` int(10) NOT NULL,
  `over_time_date` varchar(10) NOT NULL,
  `created_emp_id` int(10) NOT NULL,
  `approved_emp_id` int(10) NOT NULL,
  `special_task_id` int(10) NOT NULL,
  `is_active_emp_ot` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emp_over_time_allocation`
--

CREATE TABLE `emp_over_time_allocation` (
  `ot_alloc_id` int(10) NOT NULL,
  `over_time_id` int(10) NOT NULL,
  `over_time_start_time` varchar(10) NOT NULL,
  `over_time_end_time` varchar(10) NOT NULL,
  `emp_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emp_over_time_hour_rate`
--

CREATE TABLE `emp_over_time_hour_rate` (
  `ot_rate_id` int(10) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` varchar(200) NOT NULL,
  `is_active_ot_rate` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emp_salary_advance`
--

CREATE TABLE `emp_salary_advance` (
  `emp_salary_advance_id` int(10) NOT NULL,
  `emp_id` int(10) NOT NULL,
  `branch_id` int(10) NOT NULL,
  `advance_id` int(10) NOT NULL,
  `month` int(10) NOT NULL,
  `year` int(10) NOT NULL,
  `created_by` int(10) NOT NULL,
  `approved_by` int(10) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `percentage` decimal(10,2) NOT NULL,
  `is_approved_sal_advance` tinyint(1) NOT NULL,
  `is_active_sal_advance` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp_salary_advance`
--

INSERT INTO `emp_salary_advance` (`emp_salary_advance_id`, `emp_id`, `branch_id`, `advance_id`, `month`, `year`, `created_by`, `approved_by`, `amount`, `percentage`, `is_approved_sal_advance`, `is_active_sal_advance`) VALUES
(1, 5, 2, 2, 3, 2025, 15000, 3, '10000.00', '0.00', 1, 0),
(2, 5, 2, 2, 7, 2024, 3, 3, '11111.00', '0.00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `emp_salary_allowance`
--

CREATE TABLE `emp_salary_allowance` (
  `emp_salary_allowance_id` int(10) NOT NULL,
  `allowance_id` int(10) NOT NULL,
  `branch_id` int(10) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `percentage` decimal(10,2) NOT NULL COMMENT 'percentage from basic salary\r\n',
  `emp_id` int(10) NOT NULL,
  `valid_from_date` varchar(20) NOT NULL,
  `valid_to_date` varchar(20) NOT NULL,
  `created_by` int(10) NOT NULL,
  `approved_by` int(10) NOT NULL,
  `is_approve_sal_allow` tinyint(1) NOT NULL,
  `is_active_sal_allow` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp_salary_allowance`
--

INSERT INTO `emp_salary_allowance` (`emp_salary_allowance_id`, `allowance_id`, `branch_id`, `amount`, `percentage`, `emp_id`, `valid_from_date`, `valid_to_date`, `created_by`, `approved_by`, `is_approve_sal_allow`, `is_active_sal_allow`) VALUES
(1, 3, 2, '20000.00', '0.00', 9, '2024-02-16', '2024-02-17', 0, 3, 1, 1),
(2, 3, 2, '5000.00', '0.00', 9, '2024-02-15', '2024-02-24', 0, 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `emp_salary_bonus`
--

CREATE TABLE `emp_salary_bonus` (
  `emp_bonus_id` int(10) NOT NULL,
  `bonus_id` int(10) NOT NULL,
  `branch_id` int(10) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `percentage` decimal(10,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `approved_by` int(11) NOT NULL,
  `emp_id` int(10) NOT NULL,
  `month` int(10) NOT NULL,
  `year` int(10) NOT NULL,
  `is_approve_sal_bonus` tinyint(1) NOT NULL,
  `is_active_sal_bonus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp_salary_bonus`
--

INSERT INTO `emp_salary_bonus` (`emp_bonus_id`, `bonus_id`, `branch_id`, `amount`, `percentage`, `created_by`, `approved_by`, `emp_id`, `month`, `year`, `is_approve_sal_bonus`, `is_active_sal_bonus`) VALUES
(1, 2, 2, '20000.00', '0.00', 0, 3, 7, 4, 2026, 1, 1),
(2, 2, 2, '25000.00', '0.00', 0, 0, 9, 1, 2024, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `emp_salary_increment`
--

CREATE TABLE `emp_salary_increment` (
  `increment_id` int(10) NOT NULL,
  `emp_id` int(10) NOT NULL,
  `month` int(10) NOT NULL,
  `year` int(10) NOT NULL,
  `create_date` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `created_by_emp_id` int(10) NOT NULL,
  `approved_by_emp_id` int(10) NOT NULL,
  `is_active_sal_increment` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emp_salary_scale`
--

CREATE TABLE `emp_salary_scale` (
  `sal_scale_id` int(10) NOT NULL,
  `sal_scale_name` varchar(100) NOT NULL,
  `emp_group_id` int(10) NOT NULL,
  `basic_salary` decimal(10,2) NOT NULL,
  `is_active_sal_scale` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `emp_wise_leave_quota`
--

CREATE TABLE `emp_wise_leave_quota` (
  `emp_wise_leave_quota_id` int(10) NOT NULL,
  `leave_quota_id` int(10) NOT NULL,
  `emp_id` int(10) NOT NULL,
  `balance_leave_quota` int(10) NOT NULL,
  `is_hold_emp_wise_leave_quota` tinyint(1) NOT NULL,
  `is_active_emp_wise_leave_quota` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp_wise_leave_quota`
--

INSERT INTO `emp_wise_leave_quota` (`emp_wise_leave_quota_id`, `leave_quota_id`, `emp_id`, `balance_leave_quota`, `is_hold_emp_wise_leave_quota`, `is_active_emp_wise_leave_quota`) VALUES
(1, 1, 1, 7, 0, 1),
(2, 1, 2, 6, 0, 1),
(3, 1, 5, 7, 0, 1),
(4, 1, 6, 7, 0, 1),
(5, 1, 7, 7, 0, 1),
(6, 1, 8, 7, 0, 1),
(7, 1, 9, 7, 0, 1),
(8, 2, 1, 14, 0, 1),
(9, 2, 2, 14, 0, 1),
(10, 2, 5, 14, 0, 1),
(11, 2, 6, 14, 0, 1),
(12, 2, 7, 14, 0, 1),
(13, 2, 8, 14, 0, 1),
(14, 2, 9, 14, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `emp_work_contract`
--

CREATE TABLE `emp_work_contract` (
  `work_contract_id` int(10) NOT NULL,
  `emp_id` int(10) NOT NULL,
  `emp_grade_id` int(10) NOT NULL,
  `emp_branch_id` int(10) NOT NULL,
  `emp_company_id` int(10) NOT NULL,
  `emp_desig_id` int(10) NOT NULL,
  `emp_ws_id` int(10) NOT NULL,
  `valid_from_date` varchar(10) NOT NULL,
  `valid_to_date` varchar(10) NOT NULL,
  `is_active_emp_work_cont` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp_work_contract`
--

INSERT INTO `emp_work_contract` (`work_contract_id`, `emp_id`, `emp_grade_id`, `emp_branch_id`, `emp_company_id`, `emp_desig_id`, `emp_ws_id`, `valid_from_date`, `valid_to_date`, `is_active_emp_work_cont`) VALUES
(1, 2, 1, 1, 1, 3, 2, '2024-01-02', '2025-01-02', 1),
(2, 5, 1, 2, 1, 1, 1, '2024-01-01', '2025-01-01', 1),
(3, 9, 3, 2, 1, 3, 1, '2024-01-27', '2025-01-27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `emp_work_schedule`
--

CREATE TABLE `emp_work_schedule` (
  `ws_id` int(10) NOT NULL,
  `ws_name` varchar(255) NOT NULL,
  `working_hours_per_day` int(10) NOT NULL,
  `in_time` varchar(10) NOT NULL,
  `out_time` varchar(10) NOT NULL,
  `is_flexible` tinyint(1) NOT NULL,
  `is_active_work_schedule` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp_work_schedule`
--

INSERT INTO `emp_work_schedule` (`ws_id`, `ws_name`, `working_hours_per_day`, `in_time`, `out_time`, `is_flexible`, `is_active_work_schedule`) VALUES
(1, 'Day 7a.m to 7p.m', 12, '07:00', '19:00', 0, 1),
(2, 'Day 10a.m to 10p.m', 24, '12:00', '00:00', 0, 1),
(3, 'Day Flexible 12hrs ', 12, '07:00', '19:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `holiday`
--

CREATE TABLE `holiday` (
  `holiday_id` int(10) NOT NULL,
  `holiday_type_id` int(10) NOT NULL,
  `holiday_name` varchar(255) NOT NULL,
  `holiday_desc` varchar(255) NOT NULL,
  `is_active_holiday` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `holiday`
--

INSERT INTO `holiday` (`holiday_id`, `holiday_type_id`, `holiday_name`, `holiday_desc`, `is_active_holiday`) VALUES
(1, 1, 'Monthly Full Moon Poya Day', 'General Full Moon Poya Day', 1),
(2, 1, 'May Day', 'May Day ', 1),
(3, 2, 'Good Friday', 'Good Friday', 1),
(4, 3, 'Tamil Thai Pongal Day', 'Tamil Thai Pongal Day', 1),
(5, 2, 'Christmas Day', 'Christmas Day', 1),
(6, 1, 'Independance Day', ' Independance Day', 1);

-- --------------------------------------------------------

--
-- Table structure for table `holiday_calendar`
--

CREATE TABLE `holiday_calendar` (
  `h_calendar_id` int(10) NOT NULL,
  `holiday_id` int(10) NOT NULL,
  `h_holiday_date_from` varchar(10) NOT NULL,
  `h_holiday_date_to` varchar(10) NOT NULL,
  `h_holiday_bg_color` varchar(30) NOT NULL,
  `is_active_h_calendar` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `holiday_calendar`
--

INSERT INTO `holiday_calendar` (`h_calendar_id`, `holiday_id`, `h_holiday_date_from`, `h_holiday_date_to`, `h_holiday_bg_color`, `is_active_h_calendar`) VALUES
(1, 2, '2023-05-01', '2023-05-01', '', 1),
(2, 3, '2023-04-28', '2023-04-28', '', 1),
(3, 6, '2024-02-04', '2024-02-04', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `holiday_type`
--

CREATE TABLE `holiday_type` (
  `holiday_type_id` int(10) NOT NULL,
  `holiday_type_name` varchar(255) NOT NULL,
  `holiday_type_desc` varchar(255) NOT NULL,
  `is_active_holiday_type` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `holiday_type`
--

INSERT INTO `holiday_type` (`holiday_type_id`, `holiday_type_name`, `holiday_type_desc`, `is_active_holiday_type`) VALUES
(1, 'Mercantile', 'Mercantile holiday type', 1),
(2, 'Public', 'Public', 1),
(3, 'Bank', 'Bank Holiday', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_item`
--

CREATE TABLE `inventory_item` (
  `item_id` int(10) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `item_image_url` varchar(100) NOT NULL,
  `item_type` int(10) NOT NULL,
  `item_desc` varchar(500) NOT NULL,
  `item_category` int(10) NOT NULL,
  `is_active_inv_item` tinyint(1) NOT NULL,
  `is_feature` tinyint(1) NOT NULL,
  `is_web_pattern` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_item`
--

INSERT INTO `inventory_item` (`item_id`, `item_name`, `item_image_url`, `item_type`, `item_desc`, `item_category`, `is_active_inv_item`, `is_feature`, `is_web_pattern`) VALUES
(1, 'Acro Jack / Pipe Support ', 'http://localhost/API/assets/img/items/acro_jack.png', 0, '', 4, 1, 0, 0),
(2, 'Column box 4ft', 'http://localhost/API/assets/img/items/column_box_4.jpg', 0, '', 3, 1, 0, 0),
(3, 'Column box 8ft', 'http://localhost/API/assets/img/items/column_box_8.jpg', 0, '', 3, 1, 0, 0),
(4, 'Scaffold frame 3ft', 'http://localhost/API/assets/img/items/oe6rhd.jpg', 0, '', 4, 1, 1, 0),
(5, 'Scaffold Plate', 'http://localhost/API/assets/img/items/scaffold_plate.jpg', 0, '', 4, 1, 1, 0),
(6, 'Scaffold frame 2ft', 'http://localhost/API/assets/img/items/oe6rhd.jpg', 0, '', 4, 1, 0, 0),
(7, 'Scaffold Erecting', 'http://localhost/API/assets/img/items/scaffold_erecting.jpg', 0, '', 6, 1, 0, 0),
(8, 'Cross brace', 'http://localhost/API/assets/img/items/Biljax-diagonal-brace-and-bolts.jpg', 0, '', 4, 1, 1, 0),
(9, 'Mobile toilet', 'http://localhost/API/assets/img/items/mobile_toilet.jpg', 0, '', 3, 1, 0, 0),
(10, 'Fork Lift 3tonn', 'http://localhost/API/assets/img/items/forklift_3.jpg', 0, '', 2, 1, 0, 0),
(11, 'Fork Lift 5tonn', 'http://localhost/API/assets/img/items/forklift_5.jpg', 0, '', 2, 1, 0, 0),
(12, 'Fork Lift 10tonn', 'http://localhost/API/assets/img/items/forklift_10.jpg', 0, '', 2, 1, 0, 0),
(13, 'Tokyo Cement', 'http://localhost/API/assets/img/items/cement_tokyo.png', 0, '', 1, 1, 0, 0),
(14, 'Insee Cement', 'http://localhost/API/assets/img/items/cement_insee.png', 0, '', 1, 1, 0, 0),
(15, 'Sand', 'http://localhost/API/assets/img/items/sand.png', 0, '', 1, 1, 0, 0),
(16, 'Metal 3/4', 'http://localhost/API/assets/img/items/metal_rock34.jpg', 0, '', 1, 1, 0, 0),
(17, 'Metal chips', 'http://localhost/API/assets/img/items/metal_rock_chips.jpg', 0, '', 1, 1, 0, 0),
(18, 'Chainblock 5tonn', 'http://localhost/API/assets/img/items/chainblock_5.jpg', 0, '', 3, 1, 0, 0),
(19, 'Caster Wheel 6inch', 'http://localhost/API/assets/img/items/caster_wheel_6.jpg', 0, '', 4, 1, 1, 0),
(20, 'Caster Wheel 8inch', 'http://localhost/API/assets/img/items/caster_wheel_8.jpg', 0, '', 4, 1, 0, 0),
(21, 'Bone Joint', 'http://localhost/API/assets/img/items/bone_joint.jpg', 0, '', 4, 1, 0, 0),
(22, 'T jack', 'http://localhost/API/assets/img/items/t_jack.jpg', 0, '', 4, 1, 0, 0),
(23, 'U jack', 'http://localhost/API/assets/img/items/u_jack.jpg', 0, '', 4, 1, 0, 0),
(24, 'Clamp', 'http://localhost/API/assets/img/items/clamp.jpg', 0, '', 4, 1, 0, 0),
(25, 'C clamp', 'http://localhost/API/assets/img/items/c_clamp.jpg', 0, '', 4, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_item_category`
--

CREATE TABLE `inventory_item_category` (
  `item_category_id` int(10) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `cat_img_url` varchar(200) NOT NULL,
  `is_active_inv_item_cat` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_item_category`
--

INSERT INTO `inventory_item_category` (`item_category_id`, `category_name`, `description`, `cat_img_url`, `is_active_inv_item_cat`) VALUES
(1, 'Material', 'Materials', 'http://localhost/API/assets/img/category/cement_insee.png', 1),
(2, 'Vehicles', 'Vehicles', 'http://localhost/API/assets/img/category/escavator.jpg', 1),
(3, 'Power Tools', 'Power Tools', 'http://localhost/API/assets/img/category/chainblock_5.jpg', 1),
(4, 'Scaffolding', 'Scaffolding desc', 'http://localhost/API/assets/img/category/frame-14.jpg', 1),
(6, 'Services', 'Services', 'http://localhost/API/assets/img/category/services.JPG', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_item_sub_category`
--

CREATE TABLE `inventory_item_sub_category` (
  `item_sub_cat_id` int(10) NOT NULL,
  `item_category_id` int(10) NOT NULL,
  `sub_cat_name` varchar(100) NOT NULL,
  `sub_cat_description` varchar(200) NOT NULL,
  `is_active_inv_item_sub_cat` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_item_sub_category`
--

INSERT INTO `inventory_item_sub_category` (`item_sub_cat_id`, `item_category_id`, `sub_cat_name`, `sub_cat_description`, `is_active_inv_item_sub_cat`) VALUES
(1, 4, 'Scaffolding', 'Scaffolding', 1),
(2, 1, 'Material', 'Material', 1),
(3, 3, 'Power Tools', 'Power Tools', 1),
(4, 2, 'Vehicles', 'Vehicles', 1),
(5, 6, 'Services', 'Services', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_item_with_sub_items`
--

CREATE TABLE `inventory_item_with_sub_items` (
  `line_id` int(10) NOT NULL,
  `main_item_id` int(10) NOT NULL,
  `sub_item_id` int(10) NOT NULL,
  `no_of_sub_items` int(10) NOT NULL,
  `is_active_item_sub_item` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_item_with_sub_items`
--

INSERT INTO `inventory_item_with_sub_items` (`line_id`, `main_item_id`, `sub_item_id`, `no_of_sub_items`, `is_active_item_sub_item`) VALUES
(1, 2, 1, 1, 1),
(2, 2, 2, 2, 1),
(3, 2, 3, 3, 1),
(4, 2, 4, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_rental_invoice_detail`
--

CREATE TABLE `inventory_rental_invoice_detail` (
  `rental_detail_id` int(10) NOT NULL,
  `invoice_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `no_of_items` int(10) NOT NULL,
  `item_price` decimal(10,2) NOT NULL,
  `item_discount` decimal(10,2) NOT NULL,
  `is_active_inv_rent_invoice_detail` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_rental_invoice_detail`
--

INSERT INTO `inventory_rental_invoice_detail` (`rental_detail_id`, `invoice_id`, `item_id`, `no_of_items`, `item_price`, `item_discount`, `is_active_inv_rent_invoice_detail`) VALUES
(1, 1, 1, 2, '7500.00', '0.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_rental_invoice_header`
--

CREATE TABLE `inventory_rental_invoice_header` (
  `invoice_id` int(10) NOT NULL,
  `branch_id` int(10) NOT NULL,
  `emp_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `deposite_amount` decimal(10,2) NOT NULL,
  `created_date` varchar(10) NOT NULL,
  `create_time` varchar(10) NOT NULL,
  `total_discount` decimal(10,2) NOT NULL,
  `is_active_inv_rent_invoice_hdr` tinyint(1) NOT NULL,
  `is_complete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_rental_invoice_header`
--

INSERT INTO `inventory_rental_invoice_header` (`invoice_id`, `branch_id`, `emp_id`, `customer_id`, `total_amount`, `deposite_amount`, `created_date`, `create_time`, `total_discount`, `is_active_inv_rent_invoice_hdr`, `is_complete`) VALUES
(1, 2, 7, 1, '15000.00', '0.00', '02-02-2024', '10:00:00', '0.00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_rental_total_stock`
--

CREATE TABLE `inventory_rental_total_stock` (
  `rental_stock_id` int(10) NOT NULL,
  `branch_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `is_sub_item` tinyint(1) NOT NULL,
  `full_stock_count` int(10) NOT NULL,
  `out_stock_count` int(10) NOT NULL,
  `max_rent_price` decimal(10,2) NOT NULL,
  `min_rent_price` decimal(10,2) NOT NULL,
  `damage_stock_count` int(10) NOT NULL,
  `repair_stock_count` int(10) NOT NULL,
  `stock_re_order_level` int(10) NOT NULL,
  `is_active_rental_stock` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_rental_total_stock`
--

INSERT INTO `inventory_rental_total_stock` (`rental_stock_id`, `branch_id`, `item_id`, `is_sub_item`, `full_stock_count`, `out_stock_count`, `max_rent_price`, `min_rent_price`, `damage_stock_count`, `repair_stock_count`, `stock_re_order_level`, `is_active_rental_stock`) VALUES
(1, 1, 1, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(2, 1, 2, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(3, 1, 3, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(4, 1, 4, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(5, 1, 5, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(6, 1, 6, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(7, 1, 7, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(8, 1, 8, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(9, 1, 9, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(10, 1, 10, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(11, 1, 11, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(12, 1, 12, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(13, 1, 13, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(14, 1, 14, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(15, 1, 15, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(16, 1, 16, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(17, 1, 17, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(18, 1, 18, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(19, 1, 19, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(20, 1, 20, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(21, 1, 21, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(22, 1, 22, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(23, 1, 23, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(24, 1, 24, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(25, 1, 25, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(26, 2, 1, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(27, 2, 2, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(28, 2, 3, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(29, 2, 4, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(30, 2, 5, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(31, 2, 6, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(32, 2, 7, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(33, 2, 8, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(34, 2, 9, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(35, 2, 10, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(36, 2, 11, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(37, 2, 12, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(38, 2, 13, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(39, 2, 14, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(40, 2, 15, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(41, 2, 16, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(42, 2, 17, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(43, 2, 18, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(44, 2, 19, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(45, 2, 20, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(46, 2, 21, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(47, 2, 22, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(48, 2, 23, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(49, 2, 24, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1),
(50, 2, 25, 0, 100, 0, '0.00', '0.00', 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_rent_charge_period`
--

CREATE TABLE `inventory_rent_charge_period` (
  `period_id` int(10) NOT NULL,
  `period_name` varchar(20) NOT NULL,
  `description` varchar(200) NOT NULL,
  `is_active_inv_rent_charge` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_retail_invoice_detail`
--

CREATE TABLE `inventory_retail_invoice_detail` (
  `rental_detail_id` int(10) NOT NULL,
  `invoice_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `no_of_items` int(10) NOT NULL,
  `item_price` decimal(10,2) NOT NULL,
  `item_discount` decimal(10,2) NOT NULL,
  `is_active_inv_retail_invoice_detail` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_retail_invoice_detail`
--

INSERT INTO `inventory_retail_invoice_detail` (`rental_detail_id`, `invoice_id`, `item_id`, `no_of_items`, `item_price`, `item_discount`, `is_active_inv_retail_invoice_detail`) VALUES
(1, 1, 6, 1, '5000.00', '0.00', 1),
(2, 2, 20, 1, '5000.00', '0.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_retail_invoice_header`
--

CREATE TABLE `inventory_retail_invoice_header` (
  `invoice_id` int(10) NOT NULL,
  `branch_id` int(10) NOT NULL,
  `emp_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `created_date` varchar(10) NOT NULL,
  `create_time` varchar(10) NOT NULL,
  `total_discount` decimal(10,2) NOT NULL,
  `is_pos` tinyint(1) NOT NULL,
  `is_active_inv_retail_invoice_hdr` tinyint(1) NOT NULL,
  `is_complete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_retail_invoice_header`
--

INSERT INTO `inventory_retail_invoice_header` (`invoice_id`, `branch_id`, `emp_id`, `customer_id`, `total_amount`, `created_date`, `create_time`, `total_discount`, `is_pos`, `is_active_inv_retail_invoice_hdr`, `is_complete`) VALUES
(1, 1, 53, 10, '5000.00', '2024-02-28', '11:18:10', '0.00', 1, 1, 0),
(2, 1, 53, 10, '5000.00', '2024-02-28', '14:49:32', '0.00', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_retail_total_stock`
--

CREATE TABLE `inventory_retail_total_stock` (
  `retail_stock_id` int(10) NOT NULL,
  `branch_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `is_sub_item` tinyint(1) NOT NULL,
  `max_sale_price` decimal(10,2) NOT NULL,
  `min_sale_price` decimal(10,2) NOT NULL,
  `full_stock_count` int(10) NOT NULL,
  `stock_re_order_level` int(10) NOT NULL,
  `is_active_retail_stock` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_retail_total_stock`
--

INSERT INTO `inventory_retail_total_stock` (`retail_stock_id`, `branch_id`, `item_id`, `is_sub_item`, `max_sale_price`, `min_sale_price`, `full_stock_count`, `stock_re_order_level`, `is_active_retail_stock`) VALUES
(1, 1, 1, 0, '9000.00', '7000.00', 200, 10, 1),
(2, 1, 2, 0, '6000.00', '5000.00', 200, 10, 1),
(3, 1, 3, 0, '7500.00', '6000.00', 200, 10, 1),
(4, 1, 4, 0, '5000.00', '4500.00', 200, 10, 1),
(5, 1, 5, 0, '7000.00', '6500.00', 200, 10, 1),
(6, 1, 6, 0, '5000.00', '4000.00', 200, 10, 1),
(7, 1, 7, 0, '12000.00', '12000.00', 200, 1, 1),
(8, 1, 8, 0, '3000.00', '3500.00', 200, 10, 1),
(9, 1, 9, 0, '120000.00', '130000.00', 200, 5, 1),
(10, 1, 10, 0, '800000.00', '800000.00', 200, 2, 1),
(11, 1, 11, 0, '1000000.00', '1000000.00', 200, 2, 1),
(12, 1, 12, 0, '1200000.00', '1200000.00', 200, 2, 1),
(13, 1, 13, 0, '2300.00', '2300.00', 200, 20, 1),
(14, 1, 14, 0, '2300.00', '2300.00', 200, 20, 1),
(15, 1, 15, 0, '15000.00', '12000.00', 200, 20, 1),
(16, 1, 16, 0, '18000.00', '15000.00', 200, 20, 1),
(17, 1, 17, 0, '13000.00', '15000.00', 200, 20, 1),
(18, 1, 18, 0, '7000.00', '9000.00', 200, 10, 1),
(19, 1, 19, 0, '4500.00', '5000.00', 200, 20, 1),
(20, 1, 20, 0, '5000.00', '7000.00', 200, 20, 1),
(21, 1, 21, 0, '3500.00', '3000.00', 200, 10, 1),
(22, 1, 22, 0, '4500.00', '3500.00', 200, 10, 1),
(23, 1, 23, 0, '5000.00', '4000.00', 200, 10, 1),
(24, 1, 24, 0, '2500.00', '1500.00', 200, 10, 1),
(25, 1, 25, 0, '5000.00', '4000.00', 200, 10, 1),
(26, 2, 1, 0, '9000.00', '7000.00', 100, 10, 1),
(27, 2, 2, 0, '6000.00', '5000.00', 100, 10, 1),
(28, 2, 3, 0, '7500.00', '6000.00', 100, 10, 1),
(29, 2, 4, 0, '5000.00', '4500.00', 100, 10, 1),
(30, 2, 5, 0, '7000.00', '6500.00', 100, 10, 1),
(31, 2, 6, 0, '5000.00', '4000.00', 100, 10, 1),
(32, 2, 7, 0, '12000.00', '12000.00', 100, 1, 1),
(33, 2, 8, 0, '3000.00', '3500.00', 100, 10, 1),
(34, 2, 9, 0, '120000.00', '130000.00', 100, 5, 1),
(35, 2, 10, 0, '800000.00', '800000.00', 100, 2, 1),
(36, 2, 11, 0, '1000000.00', '1000000.00', 100, 2, 1),
(37, 2, 12, 0, '1200000.00', '1200000.00', 100, 2, 1),
(38, 2, 13, 0, '2300.00', '2300.00', 100, 20, 1),
(39, 2, 14, 0, '2300.00', '2300.00', 100, 20, 1),
(40, 2, 15, 0, '15000.00', '12000.00', 100, 20, 1),
(41, 2, 16, 0, '18000.00', '15000.00', 100, 20, 1),
(42, 2, 17, 0, '13000.00', '15000.00', 100, 20, 1),
(43, 2, 18, 0, '7000.00', '9000.00', 100, 10, 1),
(44, 2, 19, 0, '4500.00', '5000.00', 100, 20, 1),
(45, 2, 20, 0, '5000.00', '7000.00', 100, 20, 1),
(46, 2, 21, 0, '3500.00', '3000.00', 100, 10, 1),
(47, 2, 22, 0, '4500.00', '3500.00', 100, 10, 1),
(48, 2, 23, 0, '5000.00', '4000.00', 100, 10, 1),
(49, 2, 24, 0, '2500.00', '1500.00', 100, 10, 1),
(50, 2, 25, 0, '5000.00', '4000.00', 100, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_stock_purchase_detail`
--

CREATE TABLE `inventory_stock_purchase_detail` (
  `purchase_detail_line_id` int(10) NOT NULL,
  `stock_batch_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `item_cost` decimal(10,2) NOT NULL,
  `no_of_items` int(10) NOT NULL,
  `allocated_no_of_items` int(10) NOT NULL,
  `available_no_of_items` int(10) NOT NULL,
  `is_sub_item` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_stock_purchase_detail`
--

INSERT INTO `inventory_stock_purchase_detail` (`purchase_detail_line_id`, `stock_batch_id`, `item_id`, `item_cost`, `no_of_items`, `allocated_no_of_items`, `available_no_of_items`, `is_sub_item`) VALUES
(26, 1, 1, '16000.00', 1000, 500, 500, 0),
(27, 1, 2, '13000.00', 1000, 500, 500, 0),
(28, 1, 3, '15000.00', 1000, 500, 500, 0),
(29, 1, 4, '6000.00', 1000, 500, 500, 0),
(30, 1, 5, '7000.00', 1000, 500, 500, 0),
(31, 1, 6, '5000.00', 1000, 500, 500, 0),
(32, 1, 7, '20000.00', 1000, 500, 500, 0),
(33, 1, 8, '3500.00', 1000, 500, 500, 0),
(34, 1, 9, '120000.00', 1000, 500, 500, 0),
(35, 1, 10, '10000.00', 1000, 500, 500, 0),
(36, 1, 11, '10000.00', 1000, 500, 500, 0),
(37, 1, 12, '10000.00', 1000, 500, 500, 0),
(38, 1, 13, '2000.00', 1000, 500, 500, 0),
(39, 1, 14, '2000.00', 1000, 500, 500, 0),
(40, 1, 15, '16000.00', 1000, 500, 500, 0),
(41, 1, 16, '15000.00', 1000, 500, 500, 0),
(42, 1, 17, '13000.00', 1000, 500, 500, 0),
(43, 1, 18, '7000.00', 1000, 500, 500, 0),
(44, 1, 19, '3500.00', 1000, 500, 500, 0),
(45, 1, 20, '4500.00', 1000, 500, 500, 0),
(46, 1, 21, '3500.00', 1000, 500, 500, 0),
(47, 1, 22, '5000.00', 1000, 500, 500, 0),
(48, 1, 23, '6000.00', 1000, 500, 500, 0),
(49, 1, 24, '4000.00', 1000, 500, 500, 0),
(50, 1, 25, '5000.00', 1000, 500, 500, 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_stock_purchase_header`
--

CREATE TABLE `inventory_stock_purchase_header` (
  `stock_batch_id` int(10) NOT NULL,
  `stock_purchase_date` varchar(20) NOT NULL,
  `stock_purchase_time` varchar(20) NOT NULL,
  `created_by` int(10) NOT NULL,
  `branch_id` int(10) NOT NULL,
  `approved_by` int(10) NOT NULL,
  `is_allocated_stock` tinyint(1) NOT NULL,
  `is_approved_stock` tinyint(1) NOT NULL,
  `is_active_stock_purchase` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_stock_purchase_header`
--

INSERT INTO `inventory_stock_purchase_header` (`stock_batch_id`, `stock_purchase_date`, `stock_purchase_time`, `created_by`, `branch_id`, `approved_by`, `is_allocated_stock`, `is_approved_stock`, `is_active_stock_purchase`) VALUES
(1, '2024-02-18', '', 1, 1, 1, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_stock_rental_detail`
--

CREATE TABLE `inventory_stock_rental_detail` (
  `rental_stock_id` int(10) NOT NULL,
  `rental_stock_header_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `is_sub_item` tinyint(1) NOT NULL,
  `full_stock_count` int(10) NOT NULL,
  `is_active_rental_stock_detail` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_stock_rental_detail`
--

INSERT INTO `inventory_stock_rental_detail` (`rental_stock_id`, `rental_stock_header_id`, `item_id`, `is_sub_item`, `full_stock_count`, `is_active_rental_stock_detail`) VALUES
(1, 1, 1, 0, 100, 1),
(2, 1, 2, 0, 100, 1),
(3, 1, 3, 0, 100, 1),
(4, 1, 4, 0, 100, 1),
(5, 1, 5, 0, 100, 1),
(6, 1, 6, 0, 100, 1),
(7, 1, 7, 0, 100, 1),
(8, 1, 8, 0, 100, 1),
(9, 1, 9, 0, 100, 1),
(10, 1, 10, 0, 100, 1),
(11, 1, 11, 0, 100, 1),
(12, 1, 12, 0, 100, 1),
(13, 1, 13, 0, 100, 1),
(14, 1, 14, 0, 100, 1),
(15, 1, 15, 0, 100, 1),
(16, 1, 16, 0, 100, 1),
(17, 1, 17, 0, 100, 1),
(18, 1, 18, 0, 100, 1),
(19, 1, 19, 0, 100, 1),
(20, 1, 20, 0, 100, 1),
(21, 1, 21, 0, 100, 1),
(22, 1, 22, 0, 100, 1),
(23, 1, 23, 0, 100, 1),
(24, 1, 24, 0, 100, 1),
(25, 1, 25, 0, 100, 1),
(26, 2, 1, 0, 100, 1),
(27, 2, 2, 0, 100, 1),
(28, 2, 3, 0, 100, 1),
(29, 2, 4, 0, 100, 1),
(30, 2, 5, 0, 100, 1),
(31, 2, 6, 0, 100, 1),
(32, 2, 7, 0, 100, 1),
(33, 2, 8, 0, 100, 1),
(34, 2, 9, 0, 100, 1),
(35, 2, 10, 0, 100, 1),
(36, 2, 11, 0, 100, 1),
(37, 2, 12, 0, 100, 1),
(38, 2, 13, 0, 100, 1),
(39, 2, 14, 0, 100, 1),
(40, 2, 15, 0, 100, 1),
(41, 2, 16, 0, 100, 1),
(42, 2, 17, 0, 100, 1),
(43, 2, 18, 0, 100, 1),
(44, 2, 19, 0, 100, 1),
(45, 2, 20, 0, 100, 1),
(46, 2, 21, 0, 100, 1),
(47, 2, 22, 0, 100, 1),
(48, 2, 23, 0, 100, 1),
(49, 2, 24, 0, 100, 1),
(50, 2, 25, 0, 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_stock_rental_header`
--

CREATE TABLE `inventory_stock_rental_header` (
  `rental_stock_header_id` int(10) NOT NULL,
  `branch_id` int(10) NOT NULL,
  `rental_stock_assigned_date` varchar(20) NOT NULL,
  `stock_batch_id` int(10) NOT NULL,
  `created_by` int(10) NOT NULL,
  `approved_by` int(10) NOT NULL,
  `is_approved_inv_stock_rental` tinyint(1) NOT NULL,
  `is_active_inv_stock_rental` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_stock_rental_header`
--

INSERT INTO `inventory_stock_rental_header` (`rental_stock_header_id`, `branch_id`, `rental_stock_assigned_date`, `stock_batch_id`, `created_by`, `approved_by`, `is_approved_inv_stock_rental`, `is_active_inv_stock_rental`) VALUES
(1, 1, '2024-02-19', 1, 1, 1, 1, 1),
(2, 2, '2024-02-19', 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_stock_retail_detail`
--

CREATE TABLE `inventory_stock_retail_detail` (
  `retail_stock_detail_id` int(10) NOT NULL,
  `retail_stock_header_id` int(11) NOT NULL,
  `item_id` int(10) NOT NULL,
  `full_stock_count` int(10) NOT NULL,
  `is_sub_item` tinyint(1) NOT NULL,
  `is_active_retail_stock_detail` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_stock_retail_detail`
--

INSERT INTO `inventory_stock_retail_detail` (`retail_stock_detail_id`, `retail_stock_header_id`, `item_id`, `full_stock_count`, `is_sub_item`, `is_active_retail_stock_detail`) VALUES
(1, 1, 1, 100, 0, 1),
(2, 1, 2, 100, 0, 1),
(3, 1, 3, 100, 0, 1),
(4, 1, 4, 100, 0, 1),
(5, 1, 5, 100, 0, 1),
(6, 1, 6, 100, 0, 1),
(7, 1, 7, 100, 0, 1),
(8, 1, 8, 100, 0, 1),
(9, 1, 9, 100, 0, 1),
(10, 1, 10, 100, 0, 1),
(11, 1, 11, 100, 0, 1),
(12, 1, 12, 100, 0, 1),
(13, 1, 13, 100, 0, 1),
(14, 1, 14, 100, 0, 1),
(15, 1, 15, 100, 0, 1),
(16, 1, 16, 100, 0, 1),
(17, 1, 17, 100, 0, 1),
(18, 1, 18, 100, 0, 1),
(19, 1, 19, 100, 0, 1),
(20, 1, 20, 100, 0, 1),
(21, 1, 21, 100, 0, 1),
(22, 1, 22, 100, 0, 1),
(23, 1, 23, 100, 0, 1),
(24, 1, 24, 100, 0, 1),
(25, 1, 25, 100, 0, 1),
(26, 2, 1, 100, 0, 1),
(27, 2, 2, 100, 0, 1),
(28, 2, 3, 100, 0, 1),
(29, 2, 4, 100, 0, 1),
(30, 2, 5, 100, 0, 1),
(31, 2, 6, 100, 0, 1),
(32, 2, 7, 100, 0, 1),
(33, 2, 8, 100, 0, 1),
(34, 2, 9, 100, 0, 1),
(35, 2, 10, 100, 0, 1),
(36, 2, 11, 100, 0, 1),
(37, 2, 12, 100, 0, 1),
(38, 2, 13, 100, 0, 1),
(39, 2, 14, 100, 0, 1),
(40, 2, 15, 100, 0, 1),
(41, 2, 16, 100, 0, 1),
(42, 2, 17, 100, 0, 1),
(43, 2, 18, 100, 0, 1),
(44, 2, 19, 100, 0, 1),
(45, 2, 20, 100, 0, 1),
(46, 2, 21, 100, 0, 1),
(47, 2, 22, 100, 0, 1),
(48, 2, 23, 100, 0, 1),
(49, 2, 24, 100, 0, 1),
(50, 2, 25, 100, 0, 1),
(51, 3, 1, 100, 0, 1),
(52, 3, 2, 100, 0, 1),
(53, 3, 3, 100, 0, 1),
(54, 3, 4, 100, 0, 1),
(55, 3, 5, 100, 0, 1),
(56, 3, 6, 100, 0, 1),
(57, 3, 7, 100, 0, 1),
(58, 3, 8, 100, 0, 1),
(59, 3, 9, 100, 0, 1),
(60, 3, 10, 100, 0, 1),
(61, 3, 11, 100, 0, 1),
(62, 3, 12, 100, 0, 1),
(63, 3, 13, 100, 0, 1),
(64, 3, 14, 100, 0, 1),
(65, 3, 15, 100, 0, 1),
(66, 3, 16, 100, 0, 1),
(67, 3, 17, 100, 0, 1),
(68, 3, 18, 100, 0, 1),
(69, 3, 19, 100, 0, 1),
(70, 3, 20, 100, 0, 1),
(71, 3, 21, 100, 0, 1),
(72, 3, 22, 100, 0, 1),
(73, 3, 23, 100, 0, 1),
(74, 3, 24, 100, 0, 1),
(75, 3, 25, 100, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_stock_retail_header`
--

CREATE TABLE `inventory_stock_retail_header` (
  `retail_stock_header_id` int(10) NOT NULL,
  `branch_id` int(10) NOT NULL,
  `retail_stock_assigned_date` varchar(20) NOT NULL,
  `stock_batch_id` int(10) NOT NULL,
  `created_by` int(11) NOT NULL,
  `approved_by` int(11) NOT NULL,
  `is_approved_inv_stock_retail` tinyint(1) NOT NULL,
  `is_active_inv_stock_retail` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_stock_retail_header`
--

INSERT INTO `inventory_stock_retail_header` (`retail_stock_header_id`, `branch_id`, `retail_stock_assigned_date`, `stock_batch_id`, `created_by`, `approved_by`, `is_approved_inv_stock_retail`, `is_active_inv_stock_retail`) VALUES
(1, 1, '2024-02-19', 1, 1, 1, 1, 1),
(2, 1, '2024-02-19', 1, 1, 1, 1, 1),
(3, 2, '2024-02-19', 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_stock_transfer_detail`
--

CREATE TABLE `inventory_stock_transfer_detail` (
  `inventory_stock_transfer_detail_id` int(10) NOT NULL,
  `inventory_stock_transfer_header_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `is_sub_item` tinyint(1) NOT NULL,
  `no_of_items` int(10) NOT NULL,
  `is_active_stock_transfer_detail` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_stock_transfer_detail`
--

INSERT INTO `inventory_stock_transfer_detail` (`inventory_stock_transfer_detail_id`, `inventory_stock_transfer_header_id`, `item_id`, `is_sub_item`, `no_of_items`, `is_active_stock_transfer_detail`) VALUES
(1, 1, 1, 0, 10, 0),
(2, 1, 5, 0, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_stock_transfer_header`
--

CREATE TABLE `inventory_stock_transfer_header` (
  `inventory_stock_transfer_header_id` int(10) NOT NULL,
  `branch_id_from` int(10) NOT NULL,
  `branch_id_to` int(10) NOT NULL,
  `create_date` varchar(10) NOT NULL,
  `create_time` varchar(10) NOT NULL,
  `created_by` int(10) NOT NULL,
  `transfer_type` varchar(50) NOT NULL COMMENT 'IN, OUT',
  `stock_type` varchar(10) NOT NULL COMMENT 'Retail, Rental',
  `inform_user_id` int(10) NOT NULL,
  `note` varchar(500) NOT NULL,
  `approved_by` int(10) NOT NULL,
  `is_approved` tinyint(1) NOT NULL,
  `rejected_by` int(10) NOT NULL,
  `is_rejected` tinyint(1) NOT NULL,
  `is_accepted` tinyint(1) NOT NULL,
  `accepted_by` int(10) NOT NULL,
  `is_active_inv_stock_trans` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_stock_transfer_header`
--

INSERT INTO `inventory_stock_transfer_header` (`inventory_stock_transfer_header_id`, `branch_id_from`, `branch_id_to`, `create_date`, `create_time`, `created_by`, `transfer_type`, `stock_type`, `inform_user_id`, `note`, `approved_by`, `is_approved`, `rejected_by`, `is_rejected`, `is_accepted`, `accepted_by`, `is_active_inv_stock_trans`) VALUES
(1, 2, 1, '2024-02-25', '', 3, 'IN', 'Retail', 53, '', 0, 0, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_sub_item`
--

CREATE TABLE `inventory_sub_item` (
  `sub_item_id` int(10) NOT NULL,
  `sub_item_name` varchar(100) NOT NULL,
  `sub_item_image_url` varchar(100) NOT NULL,
  `sub_item_category` int(10) NOT NULL,
  `is_feature_sub` tinyint(1) NOT NULL,
  `is_active_inv_sub_item` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_sub_item`
--

INSERT INTO `inventory_sub_item` (`sub_item_id`, `sub_item_name`, `sub_item_image_url`, `sub_item_category`, `is_feature_sub`, `is_active_inv_sub_item`) VALUES
(1, 'Caster Wheel 6inch', 'http://localhost/API/assets/img/sub_items/caster_wheel_6.jpg', 4, 0, 1),
(2, 'Caster Wheel 8inch', 'http://localhost/API/assets/img/sub_items/caster_wheel_8.jpg', 4, 0, 1),
(3, 'Bone Joint', 'http://localhost/API/assets/img/sub_items/bone_joint.jpg', 4, 0, 1),
(4, 'T jack', 'http://localhost/API/assets/img/sub_items/t_jack.jpg', 4, 0, 1),
(5, 'U jack', 'http://localhost/API/assets/img/sub_items/u_jack.jpg', 4, 0, 1),
(6, 'Clamp', 'http://localhost/API/assets/img/sub_items/clamp.jpg', 4, 0, 1),
(7, 'C clamp', 'http://localhost/API/assets/img/sub_items/c_clamp.jpg', 4, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(10) NOT NULL,
  `country_id` int(10) NOT NULL,
  `location_name` varchar(255) NOT NULL,
  `location_desc` varchar(255) NOT NULL,
  `is_active_location` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `country_id`, `location_name`, `location_desc`, `is_active_location`) VALUES
(1, 1, 'Kadawata', 'Kadawata', 1),
(2, 1, 'Wattala', 'Wattala', 1),
(3, 2, 'Ibaraki Prefetcher', 'Ibaraki Prefetcher Japan', 1),
(4, 1, 'Nittambuwa', 'Nittambuwa', 1),
(5, 1, 'Kadana', 'Kadana', 1);

-- --------------------------------------------------------

--
-- Table structure for table `online_buying_pattern_detail`
--

CREATE TABLE `online_buying_pattern_detail` (
  `pattern_detail_id` int(10) NOT NULL,
  `pattern_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `online_buying_pattern_header`
--

CREATE TABLE `online_buying_pattern_header` (
  `pattern_id` int(10) NOT NULL,
  `pattern_name` varchar(200) NOT NULL,
  `is_active_buy_pttrn_hdr` tinyint(1) NOT NULL,
  `create_date` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `online_feedback`
--

CREATE TABLE `online_feedback` (
  `feedback_id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `description` varchar(500) NOT NULL,
  `no_of_stars` int(10) NOT NULL,
  `create_date` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `online_order`
--

CREATE TABLE `online_order` (
  `order_id` int(10) NOT NULL,
  `kart_id` int(10) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `promo_code_id` int(10) NOT NULL,
  `is_paid` tinyint(1) NOT NULL,
  `is_complete` tinyint(1) NOT NULL,
  `is_active_online_order` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `online_promo_code`
--

CREATE TABLE `online_promo_code` (
  `promo_code_id` int(10) NOT NULL,
  `promo_code_name` varchar(10) NOT NULL,
  `description` varchar(200) NOT NULL,
  `valid_from_date` varchar(10) NOT NULL,
  `valid_to_date` varchar(10) NOT NULL,
  `is_active_online_promo_code` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `online_shopping_kart_detail`
--

CREATE TABLE `online_shopping_kart_detail` (
  `kart_detail_id` int(10) NOT NULL,
  `kart_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `no_of_items` int(10) NOT NULL,
  `is_active_shpng_kart_detail` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `online_shopping_kart_header`
--

CREATE TABLE `online_shopping_kart_header` (
  `kart_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `create_date` varchar(10) NOT NULL,
  `create_time` varchar(10) NOT NULL,
  `is_active_shpng_kart_hdr` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `online_special_offers`
--

CREATE TABLE `online_special_offers` (
  `offer_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `discount_amount` decimal(10,2) NOT NULL,
  `discount_percentage` decimal(10,2) NOT NULL,
  `valid_from_date` varchar(10) NOT NULL,
  `valid_to_date` varchar(10) NOT NULL,
  `is_active_online_special_offers` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_payments`
--

CREATE TABLE `order_payments` (
  `payment_id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `cust_id` int(10) NOT NULL,
  `reference` varchar(200) NOT NULL,
  `payment_date` varchar(20) NOT NULL,
  `payment_time` varchar(20) NOT NULL,
  `payment_method` varchar(200) NOT NULL,
  `is_retail_order` tinyint(1) NOT NULL,
  `is_rental_order` tinyint(1) NOT NULL,
  `is_web_order` tinyint(1) NOT NULL,
  `is_complete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_payments`
--

INSERT INTO `order_payments` (`payment_id`, `order_id`, `cust_id`, `reference`, `payment_date`, `payment_time`, `payment_method`, `is_retail_order`, `is_rental_order`, `is_web_order`, `is_complete`) VALUES
(1, 0, 0, 'QR', '2024-02-28', '11:53:56', 'Bank Card Payment', 1, 0, 0, 1),
(2, 0, 0, 'QR', '2024-02-28', '11:54:36', 'Bank Card Payment', 1, 0, 0, 1),
(3, 10, 0, '911330768V', '2024-02-28', '14:49:43', 'Lanka QR Payment', 1, 0, 0, 1),
(4, 2, 10, '911330768V', '2024-02-28', '14:53:01', 'Lanka QR Payment', 1, 0, 0, 1),
(5, 2, 10, '911330768V', '2024-02-28', '14:53:16', 'Lanka QR Payment', 1, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sys_notification`
--

CREATE TABLE `sys_notification` (
  `sys_notify_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `create_date` varchar(10) NOT NULL,
  `is_sent_notify` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sys_notification`
--

INSERT INTO `sys_notification` (`sys_notify_id`, `user_id`, `create_date`, `is_sent_notify`) VALUES
(1, 1, '2024-02-24', 1),
(3, 53, '2024-02-24', 1),
(4, 55, '2024-02-24', 1),
(5, 3, '2024-02-24', 1),
(6, 54, '2024-02-24', 1),
(7, 53, '2024-02-25', 1),
(8, 1, '2024-02-25', 1),
(9, 3, '2024-02-25', 1),
(10, 1, '2024-02-26', 1),
(11, 53, '2024-02-28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sys_notify_type`
--

CREATE TABLE `sys_notify_type` (
  `sys_notify_type_id` int(10) NOT NULL,
  `notify_name` varchar(100) NOT NULL,
  `is_active_sys_notify_type` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sys_notify_type`
--

INSERT INTO `sys_notify_type` (`sys_notify_type_id`, `notify_name`, `is_active_sys_notify_type`) VALUES
(1, 'Driving License', 1),
(2, 'Medical Checkup', 1),
(3, 'Vehicle Insurance Renew', 1),
(4, 'Vehicle Revenue License Renew', 1),
(5, 'Rental return due Date', 1),
(6, 'Stock Transfer ', 1),
(7, 'To do task list activity', 1),
(8, 'New Online order Inform', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sys_user`
--

CREATE TABLE `sys_user` (
  `user_id` int(10) NOT NULL,
  `emp_cust_id` int(10) NOT NULL,
  `sys_user_group_id` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `token` varchar(255) NOT NULL,
  `otp_code` varchar(6) NOT NULL,
  `otp_code_gen_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_customer` tinyint(1) NOT NULL,
  `is_active_sys_user` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sys_user`
--

INSERT INTO `sys_user` (`user_id`, `emp_cust_id`, `sys_user_group_id`, `username`, `password`, `token`, `otp_code`, `otp_code_gen_time`, `is_customer`, `is_active_sys_user`) VALUES
(1, 1, 1, 'admin', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', '75a114c6db27c4c0c4b9', '287187', '2024-02-26 03:26:32', 0, 1),
(2, 1, 5, 'customer', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', '', '', '2024-02-15 16:20:08', 1, 1),
(3, 7, 2, 'manager1', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', '', '', '2024-02-25 15:15:00', 0, 1),
(43, 2, 5, 'sanj123', '615ed7fb1504b0c724a296d7a69e6c7b2f9ea2c57c1d8206c5afdf392ebdfd25', '', '', '2024-01-28 09:47:19', 1, 1),
(44, 3, 5, 'pavi1990', '615ed7fb1504b0c724a296d7a69e6c7b2f9ea2c57c1d8206c5afdf392ebdfd25', '', '', '2024-01-28 09:49:31', 1, 1),
(53, 8, 2, 'manager2', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', '684356fc68592fc5eb85', '939570', '2024-02-28 09:18:27', 0, 1),
(54, 2, 4, 'sachith', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', '', '', '2024-02-24 15:49:01', 0, 1),
(55, 9, 4, 'madushanka', '615ed7fb1504b0c724a296d7a69e6c7b2f9ea2c57c1d8206c5afdf392ebdfd25', '', '', '2024-02-24 11:07:40', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sys_user_group`
--

CREATE TABLE `sys_user_group` (
  `sys_user_group_id` int(10) NOT NULL,
  `sys_user_group_name` varchar(20) NOT NULL,
  `sys_user_group_desc` varchar(50) NOT NULL,
  `is_active_sys_user_group` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sys_user_group`
--

INSERT INTO `sys_user_group` (`sys_user_group_id`, `sys_user_group_name`, `sys_user_group_desc`, `is_active_sys_user_group`) VALUES
(1, 'Admin', 'All privilages included', 1),
(2, 'Manager', 'yard manager', 1),
(3, 'Driver', 'Yard Driver', 1),
(4, 'Staff', 'General staff', 1),
(5, 'Customer', 'Customer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sys_user_page`
--

CREATE TABLE `sys_user_page` (
  `page_id` int(10) NOT NULL,
  `page_category_id` int(10) NOT NULL,
  `page_name` varchar(100) NOT NULL,
  `page_url` int(100) NOT NULL,
  `page_description` varchar(200) NOT NULL,
  `is_active_user_pages` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_user_permission`
--

CREATE TABLE `sys_user_permission` (
  `sys_user_role_id` int(10) NOT NULL,
  `sys_user_groupd_id` int(10) NOT NULL,
  `sys_page_id` int(10) NOT NULL,
  `sys_user_role_is_view` tinyint(1) NOT NULL,
  `sys_user_role_is_create` tinyint(1) NOT NULL,
  `sys_user_role_is_edit` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sys_user_permission`
--

INSERT INTO `sys_user_permission` (`sys_user_role_id`, `sys_user_groupd_id`, `sys_page_id`, `sys_user_role_is_view`, `sys_user_role_is_create`, `sys_user_role_is_edit`) VALUES
(1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_page_category`
--

CREATE TABLE `user_page_category` (
  `page_category_id` int(10) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_desc` varchar(200) NOT NULL,
  `is_active_user_page_cat` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_permission`
--

CREATE TABLE `user_permission` (
  `user_permission_id` int(10) NOT NULL,
  `user_group_id` int(10) NOT NULL,
  `page_category_id` int(10) NOT NULL,
  `user_page_id` int(10) NOT NULL,
  `is_active_user_perm` tinyint(1) NOT NULL,
  `is_view` tinyint(1) NOT NULL,
  `is_edit` tinyint(1) NOT NULL,
  `is_create` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_category`
--

CREATE TABLE `vehicle_category` (
  `vehicle_category_id` int(10) NOT NULL,
  `vehicle_category_name` varchar(255) NOT NULL,
  `vehicle_category_desc` varchar(255) NOT NULL,
  `is_active_vhcl_cat` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle_category`
--

INSERT INTO `vehicle_category` (`vehicle_category_id`, `vehicle_category_name`, `vehicle_category_desc`, `is_active_vhcl_cat`) VALUES
(1, 'Heavy Weight 10', 'Weight more than 10 tonns', 1),
(2, 'Light Weight', 'weight less than 10tonn', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_details`
--

CREATE TABLE `vehicle_details` (
  `vehicle_id` int(10) NOT NULL,
  `license_plate_no` varchar(20) NOT NULL,
  `vehicle_yom` int(10) NOT NULL,
  `vehicle_type_id` int(10) NOT NULL,
  `vehicle_category_id` int(10) NOT NULL,
  `chasis_no` varchar(20) NOT NULL,
  `engine_no` varchar(20) NOT NULL,
  `number_of_passengers` int(10) NOT NULL,
  `max_load` decimal(10,2) NOT NULL,
  `branch_id` int(10) NOT NULL,
  `is_active_vhcl_details` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle_details`
--

INSERT INTO `vehicle_details` (`vehicle_id`, `license_plate_no`, `vehicle_yom`, `vehicle_type_id`, `vehicle_category_id`, `chasis_no`, `engine_no`, `number_of_passengers`, `max_load`, `branch_id`, `is_active_vhcl_details`) VALUES
(1, 'CAI 2079', 2015, 1, 1, 'DSE35445BKL', 'DSE35445454', 4, '1000.00', 2, 1),
(2, 'BBB 7077', 2019, 6, 1, '3333333333', '1111111111111', 2, '300.00', 2, 1),
(3, 'CBB 34561', 2019, 6, 1, '1111111111111', '222222222222222', 2, '300.00', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_eco_test`
--

CREATE TABLE `vehicle_eco_test` (
  `eco_test_id` int(10) NOT NULL,
  `eco_test_number` varchar(200) NOT NULL,
  `vehicle_id` int(10) NOT NULL,
  `valid_from_date` varchar(10) NOT NULL,
  `valid_to_date` varchar(10) NOT NULL,
  `is_active_vhcl_eco_test` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle_eco_test`
--

INSERT INTO `vehicle_eco_test` (`eco_test_id`, `eco_test_number`, `vehicle_id`, `valid_from_date`, `valid_to_date`, `is_active_vhcl_eco_test`) VALUES
(1, 'CL19-194206', 2, '2022-10-10', '2023-10-10', 1),
(2, 'CL20-1942501', 2, '2023-10-22', '2023-10-22', 1),
(3, 'CL20-194206', 1, '2023-10-22', '2024-10-22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_insuarance_claim_details`
--

CREATE TABLE `vehicle_insuarance_claim_details` (
  `claim_id` int(10) NOT NULL,
  `claim_number` varchar(100) NOT NULL,
  `repair_id` int(10) NOT NULL,
  `claim_amount` decimal(10,2) NOT NULL,
  `claimed_date` varchar(20) NOT NULL,
  `is_active_claim` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle_insuarance_claim_details`
--

INSERT INTO `vehicle_insuarance_claim_details` (`claim_id`, `claim_number`, `repair_id`, `claim_amount`, `claimed_date`, `is_active_claim`) VALUES
(1, 'SLIC124', 1, '15000.00', '2024-01-30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_insuarance_company`
--

CREATE TABLE `vehicle_insuarance_company` (
  `insuar_comp_id` int(10) NOT NULL,
  `insuar_comp_name` varchar(100) NOT NULL,
  `is_active_ins_comp` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle_insuarance_company`
--

INSERT INTO `vehicle_insuarance_company` (`insuar_comp_id`, `insuar_comp_name`, `is_active_ins_comp`) VALUES
(1, 'Srilanka Insurance', 1),
(2, 'Ceylinco', 1),
(3, 'Co-op', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_insuarance_details`
--

CREATE TABLE `vehicle_insuarance_details` (
  `insuar_detail_id` int(10) NOT NULL,
  `insuar_comp_id` int(10) NOT NULL,
  `insuarance_number` varchar(200) NOT NULL,
  `insuar_type` varchar(20) NOT NULL COMMENT 'full,3rdparty',
  `valid_from_date` varchar(10) NOT NULL,
  `valid_to_date` varchar(10) NOT NULL,
  `premimum_amount` decimal(10,2) NOT NULL,
  `vehicle_id` int(10) NOT NULL,
  `is_active_vhcl_ins_details` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle_insuarance_details`
--

INSERT INTO `vehicle_insuarance_details` (`insuar_detail_id`, `insuar_comp_id`, `insuarance_number`, `insuar_type`, `valid_from_date`, `valid_to_date`, `premimum_amount`, `vehicle_id`, `is_active_vhcl_ins_details`) VALUES
(1, 1, 'ZZ1212', 'third party', '2024-01-04', '2025-01-04', '65500.00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_repair`
--

CREATE TABLE `vehicle_repair` (
  `repair_id` int(10) NOT NULL,
  `repair_invoice_number` varchar(200) NOT NULL,
  `repair_description` varchar(500) NOT NULL,
  `vehicle_id` int(10) NOT NULL,
  `start_date` varchar(10) NOT NULL,
  `end_date` varchar(10) NOT NULL,
  `repair_type` varchar(10) NOT NULL COMMENT 'accident, maintenance',
  `repair_location` int(10) NOT NULL,
  `repair_cost` decimal(10,2) NOT NULL,
  `is_active_vhcl_repair` tinyint(1) NOT NULL,
  `is_complete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle_repair`
--

INSERT INTO `vehicle_repair` (`repair_id`, `repair_invoice_number`, `repair_description`, `vehicle_id`, `start_date`, `end_date`, `repair_type`, `repair_location`, `repair_cost`, `is_active_vhcl_repair`, `is_complete`) VALUES
(1, 'INV2121', 'Front bumber and Right headlight replaced', 1, '2023-05-01', '2023-07-01', 'accident', 1, '100000.00', 1, 1),
(2, 'INV3121', 'accudent sasa', 2, '2023-11-26', '2023-11-30', 'accident', 1, '343432.00', 1, 1),
(3, 'TYTINV5343', 'toyota accident repair', 1, '2023-11-28', '2023-11-30', 'accident', 1, '4343434.00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_repair_location`
--

CREATE TABLE `vehicle_repair_location` (
  `repair_loc_id` int(10) NOT NULL,
  `repair_loc_name` varchar(100) NOT NULL,
  `repair_loc_address` varchar(200) NOT NULL,
  `repair_loc_contact` varchar(20) NOT NULL,
  `is_active_vhcl_repair_loc` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle_repair_location`
--

INSERT INTO `vehicle_repair_location` (`repair_loc_id`, `repair_loc_name`, `repair_loc_address`, `repair_loc_contact`, `is_active_vhcl_repair_loc`) VALUES
(1, 'MAG City1', 'Wattala 2', '07132323222222', 1),
(2, 'Toyota Lanka', 'Wattala', '111111111', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_revenue_license`
--

CREATE TABLE `vehicle_revenue_license` (
  `rev_license_id` int(10) NOT NULL,
  `rev_license_no` varchar(20) NOT NULL,
  `vehicle_id` int(10) NOT NULL,
  `valid_from_date` varchar(10) NOT NULL,
  `valid_to_date` varchar(10) NOT NULL,
  `is_active_vhcl_rev_lice` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle_revenue_license`
--

INSERT INTO `vehicle_revenue_license` (`rev_license_id`, `rev_license_no`, `vehicle_id`, `valid_from_date`, `valid_to_date`, `is_active_vhcl_rev_lice`) VALUES
(1, '7834651', 1, '2022-10-08', '2023-10-08', 1),
(2, '99999999999', 2, '2023-10-02', '2023-10-02', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_service_center`
--

CREATE TABLE `vehicle_service_center` (
  `service_center_id` int(10) NOT NULL,
  `service_center_name` varchar(100) NOT NULL,
  `service_center_contact` varchar(20) NOT NULL,
  `service_center_address` varchar(200) NOT NULL,
  `is_active_vhcl_srv_cntr` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle_service_center`
--

INSERT INTO `vehicle_service_center` (`service_center_id`, `service_center_name`, `service_center_contact`, `service_center_address`, `is_active_vhcl_srv_cntr`) VALUES
(1, 'Auto Miraj Wattala', '0112565454', 'Wattala', 1),
(2, 'Car Care Wattala', '0112141636', 'Wattala', 1),
(3, 'Care Point Peliyagoda', '0112365456', 'Peliyagoda', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_service_details`
--

CREATE TABLE `vehicle_service_details` (
  `service_detail_id` int(10) NOT NULL,
  `service_center_id` int(10) NOT NULL,
  `vehicle_id` int(10) NOT NULL,
  `next_service_in_kms` int(10) NOT NULL,
  `next_service_in_months` int(10) NOT NULL,
  `service_date` varchar(10) NOT NULL,
  `next_service_date` varchar(20) NOT NULL,
  `service_invoice_number` varchar(100) NOT NULL,
  `service_cost` decimal(10,2) NOT NULL,
  `description` varchar(500) NOT NULL,
  `is_complete` tinyint(1) NOT NULL,
  `is_active_vhcl_srv_detail` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle_service_details`
--

INSERT INTO `vehicle_service_details` (`service_detail_id`, `service_center_id`, `vehicle_id`, `next_service_in_kms`, `next_service_in_months`, `service_date`, `next_service_date`, `service_invoice_number`, `service_cost`, `description`, `is_complete`, `is_active_vhcl_srv_detail`) VALUES
(1, 1, 1, 65000, 4, '2024-02-07', '', 'INV4562', '18000.00', 'Full Service', 1, 1),
(2, 3, 2, 1000, 3, '2024-02-08', '', '12123', '5000.00', 'bike service', 1, 0),
(3, 1, 1, 500001, 31, '2024-02-10', '', '215151111', '200001.00', 'full service111', 1, 1),
(4, 3, 3, 212, 4, '2024-02-08', '', '2121', '50000.00', 'Full', 1, 1),
(5, 2, 2, 121, 6, '2024-02-10', '2024-08-10', '232', '12121.00', 'dff', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_type`
--

CREATE TABLE `vehicle_type` (
  `vehicle_type_id` int(10) NOT NULL,
  `vehicle_type_name` varchar(255) NOT NULL,
  `vehicle_type_decs` varchar(255) NOT NULL,
  `is_active_vhcl_type` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle_type`
--

INSERT INTO `vehicle_type` (`vehicle_type_id`, `vehicle_type_name`, `vehicle_type_decs`, `is_active_vhcl_type`) VALUES
(1, 'Car', 'Sedan, Hatchback Car 1', 1),
(6, 'Bike', 'Motor Bike', 1),
(7, 'Tata Demo Batta', 'Tata Demo Batta', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `bank_account_details`
--
ALTER TABLE `bank_account_details`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `bank_branch`
--
ALTER TABLE `bank_branch`
  ADD PRIMARY KEY (`b_branch_id`);

--
-- Indexes for table `bank_deposit`
--
ALTER TABLE `bank_deposit`
  ADD PRIMARY KEY (`bank_deposit_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `company_branch`
--
ALTER TABLE `company_branch`
  ADD PRIMARY KEY (`company_branch_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `emp_advance`
--
ALTER TABLE `emp_advance`
  ADD PRIMARY KEY (`advance_id`);

--
-- Indexes for table `emp_allowance`
--
ALTER TABLE `emp_allowance`
  ADD PRIMARY KEY (`allowance_id`);

--
-- Indexes for table `emp_attendance`
--
ALTER TABLE `emp_attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `emp_bonus`
--
ALTER TABLE `emp_bonus`
  ADD PRIMARY KEY (`bonus_id`);

--
-- Indexes for table `emp_designation`
--
ALTER TABLE `emp_designation`
  ADD PRIMARY KEY (`emp_desig_id`);

--
-- Indexes for table `emp_details`
--
ALTER TABLE `emp_details`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `emp_driving_license`
--
ALTER TABLE `emp_driving_license`
  ADD PRIMARY KEY (`driving_license_id`);

--
-- Indexes for table `emp_final_salary`
--
ALTER TABLE `emp_final_salary`
  ADD PRIMARY KEY (`final_sal_id`);

--
-- Indexes for table `emp_finger_print_details`
--
ALTER TABLE `emp_finger_print_details`
  ADD PRIMARY KEY (`fp_line_id`);

--
-- Indexes for table `emp_grade`
--
ALTER TABLE `emp_grade`
  ADD PRIMARY KEY (`emp_grade_id`);

--
-- Indexes for table `emp_group`
--
ALTER TABLE `emp_group`
  ADD PRIMARY KEY (`emp_group_id`);

--
-- Indexes for table `emp_holiday_calender`
--
ALTER TABLE `emp_holiday_calender`
  ADD PRIMARY KEY (`calendar_id`);

--
-- Indexes for table `emp_leave_details`
--
ALTER TABLE `emp_leave_details`
  ADD PRIMARY KEY (`leave_detail_id`);

--
-- Indexes for table `emp_leave_quota`
--
ALTER TABLE `emp_leave_quota`
  ADD PRIMARY KEY (`leave_quota_id`);

--
-- Indexes for table `emp_leave_type`
--
ALTER TABLE `emp_leave_type`
  ADD PRIMARY KEY (`leave_type_id`);

--
-- Indexes for table `emp_medical_checkup_location`
--
ALTER TABLE `emp_medical_checkup_location`
  ADD PRIMARY KEY (`emp_med_loc_id`);

--
-- Indexes for table `emp_medical_records`
--
ALTER TABLE `emp_medical_records`
  ADD PRIMARY KEY (`med_record_id`);

--
-- Indexes for table `emp_over_time`
--
ALTER TABLE `emp_over_time`
  ADD PRIMARY KEY (`over_time_id`);

--
-- Indexes for table `emp_over_time_allocation`
--
ALTER TABLE `emp_over_time_allocation`
  ADD PRIMARY KEY (`ot_alloc_id`);

--
-- Indexes for table `emp_over_time_hour_rate`
--
ALTER TABLE `emp_over_time_hour_rate`
  ADD PRIMARY KEY (`ot_rate_id`);

--
-- Indexes for table `emp_salary_advance`
--
ALTER TABLE `emp_salary_advance`
  ADD PRIMARY KEY (`emp_salary_advance_id`);

--
-- Indexes for table `emp_salary_allowance`
--
ALTER TABLE `emp_salary_allowance`
  ADD PRIMARY KEY (`emp_salary_allowance_id`);

--
-- Indexes for table `emp_salary_bonus`
--
ALTER TABLE `emp_salary_bonus`
  ADD PRIMARY KEY (`emp_bonus_id`);

--
-- Indexes for table `emp_salary_increment`
--
ALTER TABLE `emp_salary_increment`
  ADD PRIMARY KEY (`increment_id`);

--
-- Indexes for table `emp_salary_scale`
--
ALTER TABLE `emp_salary_scale`
  ADD PRIMARY KEY (`sal_scale_id`);

--
-- Indexes for table `emp_special_task_assign_emp`
--
ALTER TABLE `emp_special_task_assign_emp`
  ADD PRIMARY KEY (`assign_emp_line_id`);

--
-- Indexes for table `emp_special_task_header`
--
ALTER TABLE `emp_special_task_header`
  ADD PRIMARY KEY (`special_task_id`);

--
-- Indexes for table `emp_wise_leave_quota`
--
ALTER TABLE `emp_wise_leave_quota`
  ADD PRIMARY KEY (`emp_wise_leave_quota_id`);

--
-- Indexes for table `emp_work_contract`
--
ALTER TABLE `emp_work_contract`
  ADD PRIMARY KEY (`work_contract_id`);

--
-- Indexes for table `emp_work_schedule`
--
ALTER TABLE `emp_work_schedule`
  ADD PRIMARY KEY (`ws_id`);

--
-- Indexes for table `holiday`
--
ALTER TABLE `holiday`
  ADD PRIMARY KEY (`holiday_id`);

--
-- Indexes for table `holiday_calendar`
--
ALTER TABLE `holiday_calendar`
  ADD PRIMARY KEY (`h_calendar_id`);

--
-- Indexes for table `holiday_type`
--
ALTER TABLE `holiday_type`
  ADD PRIMARY KEY (`holiday_type_id`);

--
-- Indexes for table `inventory_item`
--
ALTER TABLE `inventory_item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `inventory_item_category`
--
ALTER TABLE `inventory_item_category`
  ADD PRIMARY KEY (`item_category_id`);

--
-- Indexes for table `inventory_item_sub_category`
--
ALTER TABLE `inventory_item_sub_category`
  ADD PRIMARY KEY (`item_sub_cat_id`);

--
-- Indexes for table `inventory_item_with_sub_items`
--
ALTER TABLE `inventory_item_with_sub_items`
  ADD PRIMARY KEY (`line_id`);

--
-- Indexes for table `inventory_rental_invoice_detail`
--
ALTER TABLE `inventory_rental_invoice_detail`
  ADD PRIMARY KEY (`rental_detail_id`);

--
-- Indexes for table `inventory_rental_invoice_header`
--
ALTER TABLE `inventory_rental_invoice_header`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `inventory_rental_total_stock`
--
ALTER TABLE `inventory_rental_total_stock`
  ADD PRIMARY KEY (`rental_stock_id`);

--
-- Indexes for table `inventory_rent_charge_period`
--
ALTER TABLE `inventory_rent_charge_period`
  ADD PRIMARY KEY (`period_id`);

--
-- Indexes for table `inventory_retail_invoice_detail`
--
ALTER TABLE `inventory_retail_invoice_detail`
  ADD PRIMARY KEY (`rental_detail_id`);

--
-- Indexes for table `inventory_retail_invoice_header`
--
ALTER TABLE `inventory_retail_invoice_header`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `inventory_retail_total_stock`
--
ALTER TABLE `inventory_retail_total_stock`
  ADD PRIMARY KEY (`retail_stock_id`);

--
-- Indexes for table `inventory_stock_purchase_detail`
--
ALTER TABLE `inventory_stock_purchase_detail`
  ADD PRIMARY KEY (`purchase_detail_line_id`);

--
-- Indexes for table `inventory_stock_purchase_header`
--
ALTER TABLE `inventory_stock_purchase_header`
  ADD PRIMARY KEY (`stock_batch_id`);

--
-- Indexes for table `inventory_stock_rental_detail`
--
ALTER TABLE `inventory_stock_rental_detail`
  ADD PRIMARY KEY (`rental_stock_id`);

--
-- Indexes for table `inventory_stock_rental_header`
--
ALTER TABLE `inventory_stock_rental_header`
  ADD PRIMARY KEY (`rental_stock_header_id`);

--
-- Indexes for table `inventory_stock_retail_detail`
--
ALTER TABLE `inventory_stock_retail_detail`
  ADD PRIMARY KEY (`retail_stock_detail_id`);

--
-- Indexes for table `inventory_stock_retail_header`
--
ALTER TABLE `inventory_stock_retail_header`
  ADD PRIMARY KEY (`retail_stock_header_id`);

--
-- Indexes for table `inventory_stock_transfer_detail`
--
ALTER TABLE `inventory_stock_transfer_detail`
  ADD PRIMARY KEY (`inventory_stock_transfer_detail_id`);

--
-- Indexes for table `inventory_stock_transfer_header`
--
ALTER TABLE `inventory_stock_transfer_header`
  ADD PRIMARY KEY (`inventory_stock_transfer_header_id`);

--
-- Indexes for table `inventory_sub_item`
--
ALTER TABLE `inventory_sub_item`
  ADD PRIMARY KEY (`sub_item_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `online_buying_pattern_detail`
--
ALTER TABLE `online_buying_pattern_detail`
  ADD PRIMARY KEY (`pattern_detail_id`);

--
-- Indexes for table `online_buying_pattern_header`
--
ALTER TABLE `online_buying_pattern_header`
  ADD PRIMARY KEY (`pattern_id`);

--
-- Indexes for table `online_feedback`
--
ALTER TABLE `online_feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `online_order`
--
ALTER TABLE `online_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `online_shopping_kart_detail`
--
ALTER TABLE `online_shopping_kart_detail`
  ADD PRIMARY KEY (`kart_detail_id`);

--
-- Indexes for table `online_shopping_kart_header`
--
ALTER TABLE `online_shopping_kart_header`
  ADD PRIMARY KEY (`kart_id`);

--
-- Indexes for table `online_special_offers`
--
ALTER TABLE `online_special_offers`
  ADD PRIMARY KEY (`offer_id`);

--
-- Indexes for table `order_payments`
--
ALTER TABLE `order_payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `sys_notification`
--
ALTER TABLE `sys_notification`
  ADD PRIMARY KEY (`sys_notify_id`);

--
-- Indexes for table `sys_notify_type`
--
ALTER TABLE `sys_notify_type`
  ADD PRIMARY KEY (`sys_notify_type_id`);

--
-- Indexes for table `sys_user`
--
ALTER TABLE `sys_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `sys_user_group`
--
ALTER TABLE `sys_user_group`
  ADD PRIMARY KEY (`sys_user_group_id`);

--
-- Indexes for table `sys_user_page`
--
ALTER TABLE `sys_user_page`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `sys_user_permission`
--
ALTER TABLE `sys_user_permission`
  ADD PRIMARY KEY (`sys_user_role_id`);

--
-- Indexes for table `user_page_category`
--
ALTER TABLE `user_page_category`
  ADD PRIMARY KEY (`page_category_id`);

--
-- Indexes for table `user_permission`
--
ALTER TABLE `user_permission`
  ADD PRIMARY KEY (`user_permission_id`);

--
-- Indexes for table `vehicle_category`
--
ALTER TABLE `vehicle_category`
  ADD PRIMARY KEY (`vehicle_category_id`);

--
-- Indexes for table `vehicle_details`
--
ALTER TABLE `vehicle_details`
  ADD PRIMARY KEY (`vehicle_id`);

--
-- Indexes for table `vehicle_eco_test`
--
ALTER TABLE `vehicle_eco_test`
  ADD PRIMARY KEY (`eco_test_id`);

--
-- Indexes for table `vehicle_insuarance_claim_details`
--
ALTER TABLE `vehicle_insuarance_claim_details`
  ADD PRIMARY KEY (`claim_id`);

--
-- Indexes for table `vehicle_insuarance_company`
--
ALTER TABLE `vehicle_insuarance_company`
  ADD PRIMARY KEY (`insuar_comp_id`);

--
-- Indexes for table `vehicle_insuarance_details`
--
ALTER TABLE `vehicle_insuarance_details`
  ADD PRIMARY KEY (`insuar_detail_id`);

--
-- Indexes for table `vehicle_repair`
--
ALTER TABLE `vehicle_repair`
  ADD PRIMARY KEY (`repair_id`);

--
-- Indexes for table `vehicle_repair_location`
--
ALTER TABLE `vehicle_repair_location`
  ADD PRIMARY KEY (`repair_loc_id`);

--
-- Indexes for table `vehicle_revenue_license`
--
ALTER TABLE `vehicle_revenue_license`
  ADD PRIMARY KEY (`rev_license_id`);

--
-- Indexes for table `vehicle_service_center`
--
ALTER TABLE `vehicle_service_center`
  ADD PRIMARY KEY (`service_center_id`);

--
-- Indexes for table `vehicle_service_details`
--
ALTER TABLE `vehicle_service_details`
  ADD PRIMARY KEY (`service_detail_id`);

--
-- Indexes for table `vehicle_type`
--
ALTER TABLE `vehicle_type`
  ADD PRIMARY KEY (`vehicle_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `bank_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bank_account_details`
--
ALTER TABLE `bank_account_details`
  MODIFY `account_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bank_branch`
--
ALTER TABLE `bank_branch`
  MODIFY `b_branch_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bank_deposit`
--
ALTER TABLE `bank_deposit`
  MODIFY `bank_deposit_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `company_branch`
--
ALTER TABLE `company_branch`
  MODIFY `company_branch_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `emp_advance`
--
ALTER TABLE `emp_advance`
  MODIFY `advance_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `emp_allowance`
--
ALTER TABLE `emp_allowance`
  MODIFY `allowance_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `emp_attendance`
--
ALTER TABLE `emp_attendance`
  MODIFY `attendance_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `emp_bonus`
--
ALTER TABLE `emp_bonus`
  MODIFY `bonus_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `emp_designation`
--
ALTER TABLE `emp_designation`
  MODIFY `emp_desig_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `emp_details`
--
ALTER TABLE `emp_details`
  MODIFY `emp_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `emp_driving_license`
--
ALTER TABLE `emp_driving_license`
  MODIFY `driving_license_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `emp_final_salary`
--
ALTER TABLE `emp_final_salary`
  MODIFY `final_sal_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emp_finger_print_details`
--
ALTER TABLE `emp_finger_print_details`
  MODIFY `fp_line_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emp_grade`
--
ALTER TABLE `emp_grade`
  MODIFY `emp_grade_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `emp_group`
--
ALTER TABLE `emp_group`
  MODIFY `emp_group_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `emp_holiday_calender`
--
ALTER TABLE `emp_holiday_calender`
  MODIFY `calendar_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emp_leave_details`
--
ALTER TABLE `emp_leave_details`
  MODIFY `leave_detail_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `emp_leave_quota`
--
ALTER TABLE `emp_leave_quota`
  MODIFY `leave_quota_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `emp_leave_type`
--
ALTER TABLE `emp_leave_type`
  MODIFY `leave_type_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `emp_medical_checkup_location`
--
ALTER TABLE `emp_medical_checkup_location`
  MODIFY `emp_med_loc_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `emp_medical_records`
--
ALTER TABLE `emp_medical_records`
  MODIFY `med_record_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `emp_over_time`
--
ALTER TABLE `emp_over_time`
  MODIFY `over_time_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emp_over_time_allocation`
--
ALTER TABLE `emp_over_time_allocation`
  MODIFY `ot_alloc_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emp_over_time_hour_rate`
--
ALTER TABLE `emp_over_time_hour_rate`
  MODIFY `ot_rate_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emp_salary_advance`
--
ALTER TABLE `emp_salary_advance`
  MODIFY `emp_salary_advance_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `emp_salary_allowance`
--
ALTER TABLE `emp_salary_allowance`
  MODIFY `emp_salary_allowance_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `emp_salary_bonus`
--
ALTER TABLE `emp_salary_bonus`
  MODIFY `emp_bonus_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `emp_salary_increment`
--
ALTER TABLE `emp_salary_increment`
  MODIFY `increment_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emp_salary_scale`
--
ALTER TABLE `emp_salary_scale`
  MODIFY `sal_scale_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emp_special_task_assign_emp`
--
ALTER TABLE `emp_special_task_assign_emp`
  MODIFY `assign_emp_line_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emp_special_task_header`
--
ALTER TABLE `emp_special_task_header`
  MODIFY `special_task_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `emp_wise_leave_quota`
--
ALTER TABLE `emp_wise_leave_quota`
  MODIFY `emp_wise_leave_quota_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `emp_work_contract`
--
ALTER TABLE `emp_work_contract`
  MODIFY `work_contract_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `emp_work_schedule`
--
ALTER TABLE `emp_work_schedule`
  MODIFY `ws_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `holiday`
--
ALTER TABLE `holiday`
  MODIFY `holiday_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `holiday_calendar`
--
ALTER TABLE `holiday_calendar`
  MODIFY `h_calendar_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `holiday_type`
--
ALTER TABLE `holiday_type`
  MODIFY `holiday_type_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `inventory_item`
--
ALTER TABLE `inventory_item`
  MODIFY `item_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `inventory_item_category`
--
ALTER TABLE `inventory_item_category`
  MODIFY `item_category_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `inventory_item_sub_category`
--
ALTER TABLE `inventory_item_sub_category`
  MODIFY `item_sub_cat_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `inventory_item_with_sub_items`
--
ALTER TABLE `inventory_item_with_sub_items`
  MODIFY `line_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inventory_rental_invoice_detail`
--
ALTER TABLE `inventory_rental_invoice_detail`
  MODIFY `rental_detail_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventory_rental_invoice_header`
--
ALTER TABLE `inventory_rental_invoice_header`
  MODIFY `invoice_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventory_rental_total_stock`
--
ALTER TABLE `inventory_rental_total_stock`
  MODIFY `rental_stock_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `inventory_rent_charge_period`
--
ALTER TABLE `inventory_rent_charge_period`
  MODIFY `period_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_retail_invoice_detail`
--
ALTER TABLE `inventory_retail_invoice_detail`
  MODIFY `rental_detail_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inventory_retail_invoice_header`
--
ALTER TABLE `inventory_retail_invoice_header`
  MODIFY `invoice_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inventory_retail_total_stock`
--
ALTER TABLE `inventory_retail_total_stock`
  MODIFY `retail_stock_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `inventory_stock_purchase_detail`
--
ALTER TABLE `inventory_stock_purchase_detail`
  MODIFY `purchase_detail_line_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `inventory_stock_purchase_header`
--
ALTER TABLE `inventory_stock_purchase_header`
  MODIFY `stock_batch_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventory_stock_rental_detail`
--
ALTER TABLE `inventory_stock_rental_detail`
  MODIFY `rental_stock_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `inventory_stock_rental_header`
--
ALTER TABLE `inventory_stock_rental_header`
  MODIFY `rental_stock_header_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inventory_stock_retail_detail`
--
ALTER TABLE `inventory_stock_retail_detail`
  MODIFY `retail_stock_detail_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `inventory_stock_retail_header`
--
ALTER TABLE `inventory_stock_retail_header`
  MODIFY `retail_stock_header_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inventory_stock_transfer_detail`
--
ALTER TABLE `inventory_stock_transfer_detail`
  MODIFY `inventory_stock_transfer_detail_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inventory_stock_transfer_header`
--
ALTER TABLE `inventory_stock_transfer_header`
  MODIFY `inventory_stock_transfer_header_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventory_sub_item`
--
ALTER TABLE `inventory_sub_item`
  MODIFY `sub_item_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `online_buying_pattern_detail`
--
ALTER TABLE `online_buying_pattern_detail`
  MODIFY `pattern_detail_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `online_buying_pattern_header`
--
ALTER TABLE `online_buying_pattern_header`
  MODIFY `pattern_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `online_feedback`
--
ALTER TABLE `online_feedback`
  MODIFY `feedback_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_payments`
--
ALTER TABLE `order_payments`
  MODIFY `payment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sys_notification`
--
ALTER TABLE `sys_notification`
  MODIFY `sys_notify_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sys_notify_type`
--
ALTER TABLE `sys_notify_type`
  MODIFY `sys_notify_type_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sys_user`
--
ALTER TABLE `sys_user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `sys_user_group`
--
ALTER TABLE `sys_user_group`
  MODIFY `sys_user_group_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sys_user_page`
--
ALTER TABLE `sys_user_page`
  MODIFY `page_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sys_user_permission`
--
ALTER TABLE `sys_user_permission`
  MODIFY `sys_user_role_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_page_category`
--
ALTER TABLE `user_page_category`
  MODIFY `page_category_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicle_category`
--
ALTER TABLE `vehicle_category`
  MODIFY `vehicle_category_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vehicle_details`
--
ALTER TABLE `vehicle_details`
  MODIFY `vehicle_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vehicle_eco_test`
--
ALTER TABLE `vehicle_eco_test`
  MODIFY `eco_test_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vehicle_insuarance_claim_details`
--
ALTER TABLE `vehicle_insuarance_claim_details`
  MODIFY `claim_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vehicle_insuarance_company`
--
ALTER TABLE `vehicle_insuarance_company`
  MODIFY `insuar_comp_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vehicle_insuarance_details`
--
ALTER TABLE `vehicle_insuarance_details`
  MODIFY `insuar_detail_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vehicle_repair`
--
ALTER TABLE `vehicle_repair`
  MODIFY `repair_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vehicle_repair_location`
--
ALTER TABLE `vehicle_repair_location`
  MODIFY `repair_loc_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vehicle_revenue_license`
--
ALTER TABLE `vehicle_revenue_license`
  MODIFY `rev_license_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vehicle_service_center`
--
ALTER TABLE `vehicle_service_center`
  MODIFY `service_center_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vehicle_service_details`
--
ALTER TABLE `vehicle_service_details`
  MODIFY `service_detail_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vehicle_type`
--
ALTER TABLE `vehicle_type`
  MODIFY `vehicle_type_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
