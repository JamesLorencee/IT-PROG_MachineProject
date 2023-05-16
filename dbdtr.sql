-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2022 at 07:43 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbdtr`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dtr`
--

CREATE TABLE `tbl_dtr` (
  `id` int(8) NOT NULL,
  `shiftDate` date NOT NULL,
  `typeOfDay` enum('Rest','No Work','Work') NOT NULL,
  `schedIn` time NOT NULL,
  `schedOut` time NOT NULL,
  `timeIn` time NOT NULL,
  `timeOut` time NOT NULL,
  `position` enum('Manager','Programmer','Encoder','Secretary','Network Admin') NOT NULL,
  `REGratePerHr` float NOT NULL,
  `OTratePerHr` float NOT NULL,
  `basicSalary` float NOT NULL,
  `workHrsPerDay` float NOT NULL,
  `REGHrsPerDay` float NOT NULL,
  `REGAmtPerDay` float NOT NULL,
  `OTHrsPerDay` float NOT NULL,
  `OTAmtPerDay` float NOT NULL,
  `totalAmtPerDay` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_dtr`
--

INSERT INTO `tbl_dtr` (`id`, `shiftDate`, `typeOfDay`, `schedIn`, `schedOut`, `timeIn`, `timeOut`, `position`, `REGratePerHr`, `OTratePerHr`, `basicSalary`, `workHrsPerDay`, `REGHrsPerDay`, `REGAmtPerDay`, `OTHrsPerDay`, `OTAmtPerDay`, `totalAmtPerDay`) VALUES
(12341234, '2022-05-30', 'Work', '08:00:00', '17:00:00', '08:00:00', '17:03:00', 'Network Admin', 850, 330, 5100, 8, 8, 6800, 0, 0, 6800),
(12341234, '2022-05-31', 'Rest', '08:00:00', '17:00:00', '08:00:00', '15:00:00', 'Network Admin', 850, 330, 5100, 6, 6, 5100, 0, 0, 5100),
(12341234, '2022-06-01', 'Work', '08:00:00', '17:00:00', '08:00:00', '18:15:00', 'Network Admin', 850, 330, 5100, 9, 8, 6800, 1, 330, 7130),
(12341234, '2022-06-02', 'Work', '08:00:00', '17:00:00', '08:00:00', '19:30:00', 'Network Admin', 850, 330, 5100, 10, 8, 6800, 2, 660, 7460),
(12341234, '2022-06-03', 'Work', '08:00:00', '17:00:00', '09:00:00', '21:00:00', 'Network Admin', 850, 330, 5100, 11, 8, 6800, 3, 990, 7790),
(12341234, '2022-06-04', 'Work', '08:00:00', '17:00:00', '07:00:00', '15:00:00', 'Network Admin', 850, 330, 5100, 7, 7, 5950, 0, 0, 5950),
(12341234, '2022-06-05', 'No Work', '08:00:00', '17:00:00', '00:00:00', '00:00:00', 'Network Admin', 850, 330, 0, 0, 0, 0, 0, 0, 0),
(12341234, '2022-06-06', 'Work', '07:00:00', '16:00:00', '09:00:00', '19:00:00', 'Network Admin', 850, 330, 5100, 9, 8, 6800, 1, 330, 7130),
(12341234, '2022-06-07', 'Work', '07:00:00', '16:00:00', '09:00:00', '16:00:00', 'Network Admin', 850, 330, 5100, 6, 6, 5100, 0, 0, 5100),
(12341234, '2022-06-08', 'Work', '07:00:00', '16:00:00', '07:00:00', '18:50:00', 'Network Admin', 850, 330, 5100, 10, 8, 6800, 2, 660, 7460),
(12341234, '2022-06-09', 'Work', '07:00:00', '16:00:00', '09:00:00', '17:00:00', 'Network Admin', 850, 330, 5100, 7, 7, 5950, 0, 0, 5950),
(12341234, '2022-06-10', 'Work', '07:00:00', '16:00:00', '08:00:00', '16:10:00', 'Network Admin', 850, 330, 5100, 7, 7, 5950, 0, 0, 5950),
(12341234, '2022-06-11', 'Rest', '07:00:00', '16:00:00', '07:00:00', '14:00:00', 'Network Admin', 850, 330, 5100, 6, 6, 5100, 0, 0, 5100),
(12341234, '2022-06-12', 'No Work', '07:00:00', '16:00:00', '00:00:00', '00:00:00', 'Network Admin', 850, 330, 0, 0, 0, 0, 0, 0, 0),
(12341234, '2022-06-13', 'Work', '08:00:00', '17:00:00', '08:00:00', '15:55:00', 'Network Admin', 850, 330, 5100, 6, 6, 5100, 0, 0, 5100),
(12341234, '2022-06-14', 'Work', '08:00:00', '17:00:00', '07:00:00', '17:45:00', 'Network Admin', 850, 330, 5100, 9, 8, 6800, 1, 330, 7130),
(12341234, '2022-06-15', 'Work', '08:00:00', '17:00:00', '08:00:00', '19:35:00', 'Network Admin', 850, 330, 5100, 10, 8, 6800, 2, 660, 7460),
(12341234, '2022-06-16', 'Rest', '08:00:00', '17:00:00', '08:00:00', '15:00:00', 'Network Admin', 850, 330, 5100, 6, 6, 5100, 0, 0, 5100),
(12341234, '2022-06-17', 'Work', '08:00:00', '17:00:00', '09:00:00', '21:00:00', 'Network Admin', 850, 330, 5100, 11, 8, 6800, 3, 990, 7790),
(12341234, '2022-06-18', 'Work', '08:00:00', '17:00:00', '09:00:00', '20:40:00', 'Network Admin', 850, 330, 5100, 10, 8, 6800, 2, 660, 7460),
(12341234, '2022-06-19', 'No Work', '08:00:00', '17:00:00', '00:00:00', '00:00:00', 'Network Admin', 850, 330, 0, 0, 0, 0, 0, 0, 0),
(12341234, '2022-06-20', 'Rest', '08:00:00', '17:00:00', '08:00:00', '15:00:00', 'Network Admin', 850, 330, 5100, 6, 6, 5100, 0, 0, 5100),
(12341234, '2022-06-21', 'Work', '08:00:00', '17:00:00', '07:00:00', '15:10:00', 'Network Admin', 850, 330, 5100, 7, 7, 5950, 0, 0, 5950),
(12341234, '2022-06-22', 'Work', '08:00:00', '17:00:00', '09:00:00', '17:45:00', 'Network Admin', 850, 330, 5100, 7, 7, 5950, 0, 0, 5950),
(12341234, '2022-06-23', 'Work', '08:00:00', '17:00:00', '07:00:00', '15:15:00', 'Network Admin', 850, 330, 5100, 7, 7, 5950, 0, 0, 5950),
(12341234, '2022-06-24', 'Work', '08:00:00', '17:00:00', '08:00:00', '16:05:00', 'Network Admin', 850, 330, 5100, 7, 7, 5950, 0, 0, 5950),
(12341234, '2022-06-25', 'Work', '08:00:00', '17:00:00', '08:00:00', '16:45:00', 'Network Admin', 850, 330, 5100, 7, 7, 5950, 0, 0, 5950),
(12341234, '2022-06-26', 'No Work', '08:00:00', '17:00:00', '00:00:00', '00:00:00', 'Network Admin', 850, 330, 0, 0, 0, 0, 0, 0, 0),
(12341234, '2022-06-27', 'Work', '08:00:00', '17:00:00', '08:00:00', '16:05:00', 'Network Admin', 850, 330, 5100, 7, 7, 5950, 0, 0, 5950),
(12341234, '2022-06-28', 'Rest', '08:00:00', '17:00:00', '08:00:00', '15:00:00', 'Network Admin', 850, 330, 5100, 6, 6, 5100, 0, 0, 5100),
(12341234, '2022-06-29', 'Work', '08:00:00', '17:00:00', '08:00:00', '19:20:00', 'Network Admin', 850, 330, 5100, 10, 8, 6800, 2, 660, 7460),
(12341234, '2022-06-30', 'Work', '08:00:00', '17:00:00', '09:00:00', '18:05:00', 'Network Admin', 850, 330, 5100, 8, 8, 6800, 0, 0, 6800),
(12341234, '2022-07-01', 'Work', '08:00:00', '17:00:00', '07:00:00', '16:30:00', 'Network Admin', 850, 330, 5100, 8, 8, 6800, 0, 0, 6800),
(12341234, '2022-07-02', 'Work', '08:00:00', '17:00:00', '09:00:00', '21:02:00', 'Network Admin', 850, 330, 5100, 11, 8, 6800, 3, 990, 7790),
(12341234, '2022-07-03', 'No Work', '08:00:00', '17:00:00', '00:00:00', '00:00:00', 'Network Admin', 850, 330, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employees`
--

CREATE TABLE `tbl_employees` (
  `id` int(8) NOT NULL,
  `completename` varchar(25) NOT NULL,
  `emp_img` longblob DEFAULT NULL,
  `status` enum('Regular','Probation') NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `hiredate` date NOT NULL,
  `position` enum('Manager','Programmer','Encoder','Secretary','Network Admin') DEFAULT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_employees`
--

INSERT INTO `tbl_employees` (`id`, `completename`, `emp_img`, `status`, `gender`, `hiredate`, `position`, `username`, `password`) VALUES
(12341234, 'Angelina Jolie', 0x616e67656c696e612d6a6f6c69652d393335363738322d312d3430322e6a7067, 'Regular', 'Female', '2021-12-01', 'Network Admin', 'angelina123', 'a4b93614e56e7f3fc8f01f77d479dbae'),
(56785678, 'Timothee Chalamet', 0x37656a4d307333684d5a536e6669624958374f575865516d526f2e6a7067, 'Regular', 'Male', '2022-04-01', 'Programmer', 'timothee_ch', '8e9b5b20c26acec1e4f6152220036f2d');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_emp_position`
--

CREATE TABLE `tbl_emp_position` (
  `id` int(8) NOT NULL,
  `position` enum('Manager','Programmer','Encoder','Secretary','Network Admin') NOT NULL,
  `effectiveDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_emp_position`
--

INSERT INTO `tbl_emp_position` (`id`, `position`, `effectiveDate`) VALUES
(12341234, 'Network Admin', '2021-12-01'),
(56785678, 'Programmer', '2022-04-01'),
(56785678, 'Programmer', '2022-04-15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_emp_status`
--

CREATE TABLE `tbl_emp_status` (
  `id` int(8) NOT NULL,
  `status` enum('Regular','Probation') NOT NULL,
  `effectiveDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_emp_status`
--

INSERT INTO `tbl_emp_status` (`id`, `status`, `effectiveDate`) VALUES
(12341234, 'Regular', '2021-12-01'),
(56785678, 'Regular', '2022-04-15'),
(56785678, 'Probation', '2022-04-01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_position`
--

CREATE TABLE `tbl_position` (
  `position` enum('Manager','Programmer','Encoder','Secretary','Network Admin') NOT NULL,
  `REGratePerHr` float NOT NULL,
  `OTratePerHr` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_position`
--

INSERT INTO `tbl_position` (`position`, `REGratePerHr`, `OTratePerHr`) VALUES
('Manager', 880, 340),
('Programmer', 620, 300),
('Encoder', 410, 280),
('Secretary', 450, 280),
('Network Admin', 850, 330);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_dtr`
--
ALTER TABLE `tbl_dtr`
  ADD PRIMARY KEY (`id`,`shiftDate`);

--
-- Indexes for table `tbl_employees`
--
ALTER TABLE `tbl_employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tbl_emp_position`
--
ALTER TABLE `tbl_emp_position`
  ADD PRIMARY KEY (`id`,`position`,`effectiveDate`);

--
-- Indexes for table `tbl_emp_status`
--
ALTER TABLE `tbl_emp_status`
  ADD PRIMARY KEY (`id`,`status`,`effectiveDate`);

--
-- Indexes for table `tbl_position`
--
ALTER TABLE `tbl_position`
  ADD PRIMARY KEY (`position`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
