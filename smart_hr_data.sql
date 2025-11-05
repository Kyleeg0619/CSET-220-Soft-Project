-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2025 at 03:27 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smart_hr`
--

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`adminID`, `firstName`, `lastName`, `email`, `password`, `departmentID`, `designationID`, `companyID`, `salary`) VALUES
(1, 'James', 'Baxter', 'JB@greenvale.com', '$2y$12$uuelc/4POlVAlJ19dUKtpu/MxGAS9pYf41X5Pk.3zz4LXYH1SLAMy', 3, 2, 1, 100000.00);

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendanceID`, `employeeID`, `scheduleDate`, `clockIN`, `clockOut`, `totalHours`) VALUES
(1, 1, '2025-11-01', '2025-11-01 13:00:00', '2025-11-01 21:00:00', 8.00),
(2, 1, '2025-11-01', '2025-11-01 12:45:00', '2025-11-01 21:15:00', 8.50),
(3, 1, '2025-11-01', '2025-11-01 13:30:00', '2025-11-01 22:00:00', 8.50);

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`companyID`, `companyName`) VALUES
(1, 'GreenVale Co.'),
(2, 'Horizon Group'),
(3, 'Silverline Consulting');

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`departmentID`, `departmentName`, `companyID`) VALUES
(1, 'Construction', 1),
(2, 'Sales', 1),
(3, 'Marketing', 1),
(4, 'Sales', 2),
(5, 'Finance', 2),
(6, 'Maintinence', 2),
(7, 'Human Resources', 3),
(8, 'IT Support', 3);

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`designationID`, `designationName`) VALUES
(1, 'Sales Associate'),
(2, 'Administrative Manager'),
(3, 'Finance Consultant');

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employeeID`, `firstName`, `lastName`, `email`, `password`, `departmentID`, `designationID`, `companyID`, `salary`) VALUES
(1, 'Ashely', 'Arin', 'AshA@greenvale.com', '$2y$12$guJVteqcoDIpwJdn1JlRYe6ORRDgU0riCsWkR63QEC52ZoHo5br9C', 3, 1, 1, 70000.00),
(2, 'Kylee', 'Grasela', 'Kyleeg@greenvale.com', '$2y$12$Ald1T2hs4TcezG//zGlFFOP9kSAE3Iuo1c3i3PwyID07Qmll17JWe', 2, 3, 1, 60000.00);

--
-- Dumping data for table `leaverequests`
--

INSERT INTO `leaverequests` (`requestID`, `employeeID`, `companyID`, `reason`, `leaveStart`, `leaveEnd`, `approvalStatus`, `submissionDate`) VALUES
(1, 1, 1, 'Medical appointment', '2025-11-05 14:00:00', '2025-11-05 18:00:00', 'Approved', '2025-11-01'),
(2, 1, 2, 'Family emergency', '2025-11-10 13:00:00', '2025-11-12 22:00:00', 'Pending', '2025-11-02'),
(3, 1, 3, 'Conference attendance', '2025-11-15 14:00:00', '2025-11-17 23:00:00', 'Denied', '2025-11-03');

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`payrollID`, `employeeID`, `companyID`, `month`, `basepay`, `overtimeHours`, `otRate`, `totalSalary`, `status`) VALUES
(1, 1, 1, 'October', 70000.00, 10.00, 50.00, 70500.00, 'Processed');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
