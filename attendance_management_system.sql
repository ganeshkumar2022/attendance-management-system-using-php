-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2024 at 06:12 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `aid` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `status` varchar(30) NOT NULL,
  `adate` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`aid`, `student_id`, `status`, `adate`, `created_at`) VALUES
(3, 1, 'present', '08-12-2024', '2024-12-08 01:28:28'),
(4, 3, 'absent', '08-12-2024', '2024-12-08 01:27:35'),
(5, 1, 'present', '09-12-2024', '2024-12-09 01:07:46'),
(6, 2, 'absent', '09-12-2024', '2024-12-09 01:23:07'),
(7, 3, 'present', '10-12-2024', '2024-12-09 01:45:54');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `fid` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `birth_date` varchar(14) NOT NULL,
  `qualification` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `mobile_no` char(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`fid`, `full_name`, `birth_date`, `qualification`, `username`, `user_id`, `password`, `mobile_no`, `created_at`) VALUES
(1, 'ganesh', '10/02/2001', 'BCA', 'ganesh100', '834534', '$2y$10$7.Nf.9CcErqq/E8wg/3n6e3nWmMzp6Dx1cdR/dUuJADqfESmMegtu', '9538758934', '2024-12-04 01:35:12'),
(2, 'jhdgj', '10/12/2024', 'bcf', 'gjht', '655675', '$2y$10$wviG1Awg5/j4nKwtmMZ42OM3Vb0./tCsR.Vg.EtQPa08X9khmfgqO', '8867483648', '2024-12-04 01:44:09'),
(3, 'jkhkf', '10/12/2024', 'bnbj', 'gdg', '453453', '$2y$10$jbxfnsNAT1tQ28RhJJy82OYPkp/9Z4xyf0kfBCk1ZASayizZ5RgzS', '8826364823', '2024-12-04 01:45:00'),
(4, 'nishitha', '02/12/2024', 'msc', 'nishitha22', '123456', '$2y$10$iabbf4UqcOcAFsIP0pzxM.w9/C08sQ9NkGGBw8f0QYlZfvCp21WsG', '9854345345', '2024-12-09 17:09:31');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `sid` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `rollno` int(6) NOT NULL,
  `course` varchar(50) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `semester` varchar(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`sid`, `name`, `rollno`, `course`, `branch`, `semester`, `created_at`) VALUES
(1, 'dfsdf', 334534, 'B.E', 'Electrical', 'II', '2024-12-07 01:35:02'),
(2, 'nishitha kutty', 223344, 'MCA', 'CSE', 'VIII', '2024-12-07 01:36:02'),
(3, 'kavitha', 222222, 'M.Tech', 'Civil', 'II', '2024-12-07 01:41:22'),
(4, 'sffsd', 123123, 'BCOM', 'Civil', 'V', '2024-12-09 17:10:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`sid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
