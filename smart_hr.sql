-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2025 at 05:57 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendanceID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `scheduleDate` date DEFAULT NULL,
  `clockIN` timestamp NOT NULL DEFAULT current_timestamp(),
  `clockOut` timestamp NULL DEFAULT NULL,
  `totalHours` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendanceID`, `userID`, `scheduleDate`, `clockIN`, `clockOut`, `totalHours`) VALUES
(1, 1, '2025-10-28', '2025-10-28 12:00:00', '2025-10-28 20:00:00', 8.00),
(2, 2, '2025-10-28', '2025-10-28 13:00:00', '2025-10-28 21:30:00', 8.50),
(3, 3, '2025-10-28', '2025-10-28 12:30:00', '2025-10-28 19:30:00', 7.00),
(4, 4, '2025-10-30', '2025-10-30 12:15:00', '2025-10-30 20:15:00', 8.00),
(5, 5, '2025-10-30', '2025-10-30 13:00:00', '2025-10-30 21:00:00', 8.00),
(6, 6, '2025-10-30', '2025-10-30 11:45:00', '2025-10-30 19:45:00', 8.00),
(7, 1, '2025-10-30', '2025-10-30 12:00:00', '2025-10-30 20:00:00', 8.00);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `companyID` int(11) NOT NULL,
  `companyName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`companyID`, `companyName`) VALUES
(1, 'GreenVale Co.'),
(2, 'Horizon Group'),
(3, 'Silverline Consulting'),
(4, 'Lumos Digital');

-- --------------------------------------------------------

--
-- Table structure for table `company_users`
--

CREATE TABLE `company_users` (
  `userID` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `departmentID` int(11) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `salary` decimal(10,2) NOT NULL,
  `userRole` enum('employee','admin') DEFAULT 'employee'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company_users`
--

INSERT INTO `company_users` (`userID`, `firstName`, `lastName`, `email`, `password`, `departmentID`, `designation`, `salary`, `userRole`) VALUES
(1, 'Alice', 'Johnson', 'AliceJ@greenvale.com', '333', 3, 'Marketing Manager', 120000.00, 'employee'),
(2, 'John', 'James', 'JohnJ@greenvale.com', '111', 3, 'Executive Assistant', 80000.00, 'employee'),
(3, 'Ashely', 'Arin', 'AshA@greenvale.com', '$2y$12$guJVteqcoDIpwJdn1JlRYe6ORRDgU0riCsWkR63QEC52ZoHo5br9C', 3, 'Marketing Associate', 70000.00, 'employee'),
(4, 'Liam', 'Chen', 'LiamC@horizon.com', 'pass123', 4, 'Sales Manager', 95000.00, 'employee'),
(5, 'Nina', 'Patel', 'NinaP@horizon.com', 'pass456', 5, 'Financial Analyst', 88000.00, 'employee'),
(6, 'Marco', 'Diaz', 'MarcoD@lumos.com', 'pass789', 6, 'Maintenance Supervisor', 72000.00, 'employee'),
(7, 'James', 'Baxter', 'JB@greenvale.com', '$2y$12$uuelc/4POlVAlJ19dUKtpu/MxGAS9pYf41X5Pk.3zz4LXYH1SLAMy', 3, 'Manager', 100000.00, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `departmentID` int(11) NOT NULL,
  `departmentName` varchar(50) NOT NULL,
  `companyID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(8, 'IT Support', 3),
(9, 'Creative Design', 4),
(10, 'Client Relations', 4);

-- --------------------------------------------------------

--
-- Table structure for table `leaverequests`
--

CREATE TABLE `leaverequests` (
  `requestID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `reason` text DEFAULT NULL,
  `leaveStart` timestamp NOT NULL DEFAULT current_timestamp(),
  `leaveEnd` timestamp NULL DEFAULT NULL,
  `approvalStatus` enum('Pending','Approved','Denied') DEFAULT 'Pending',
  `requestDate` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leaverequests`
--

INSERT INTO `leaverequests` (`requestID`, `userID`, `reason`, `leaveStart`, `leaveEnd`, `approvalStatus`, `requestDate`) VALUES
(1, 1, 'Medical appointment', '2025-10-30 13:00:00', '2025-10-30 17:00:00', 'Pending', '2025-10-29'),
(2, 2, 'Family emergency', '2025-10-27 12:00:00', '2025-10-28 21:00:00', 'Pending', '2025-10-26'),
(3, 3, 'Conference attendance', '2025-11-02 13:00:00', '2025-11-04 22:00:00', 'Pending', '2025-10-25'),
(4, 6, 'Medical Leave', '2025-10-31 14:56:05', '2025-11-29 15:55:45', 'Pending', '2025-10-31'),
(5, 2, 'Surgery', '2025-11-03 23:44:30', '2025-11-11 23:43:54', 'Approved', '2025-11-03'),
(6, 7, 'family get together', '2025-11-10 23:46:05', '2025-11-11 23:46:05', 'Denied', '2025-11-03');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `payrollID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `month` varchar(20) NOT NULL,
  `basepay` decimal(10,2) NOT NULL,
  `overtimeHours` decimal(5,2) DEFAULT NULL,
  `otRate` decimal(10,2) DEFAULT NULL,
  `totalSalary` decimal(10,2) DEFAULT NULL,
  `status` enum('Processed','Unprocessed') DEFAULT 'Unprocessed',
  `pdfLink` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`payrollID`, `userID`, `month`, `basepay`, `overtimeHours`, `otRate`, `totalSalary`, `status`, `pdfLink`) VALUES
(1, 1, 'October 2025', 120000.00, 5.00, 50.00, 120250.00, 'Processed', 'payrolls/oct_2025_alice.pdf'),
(2, 2, 'October 2025', 80000.00, 2.50, 40.00, 80100.00, 'Processed', 'payrolls/oct_2025_john.pdf'),
(3, 3, 'October 2025', 70000.00, 0.00, 0.00, 70000.00, 'Unprocessed', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('pc8cuKIwAWpj5rRjcmUfBYHgKSwJceIzcR2fEAWd', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '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', 1762265098);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendanceID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`companyID`);

--
-- Indexes for table `company_users`
--
ALTER TABLE `company_users`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `departmentID` (`departmentID`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`departmentID`),
  ADD KEY `companyID` (`companyID`);

--
-- Indexes for table `leaverequests`
--
ALTER TABLE `leaverequests`
  ADD PRIMARY KEY (`requestID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`payrollID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendanceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `companyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `company_users`
--
ALTER TABLE `company_users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `departmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `leaverequests`
--
ALTER TABLE `leaverequests`
  MODIFY `requestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `payrollID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `company_users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `company_users`
--
ALTER TABLE `company_users`
  ADD CONSTRAINT `company_users_ibfk_1` FOREIGN KEY (`departmentID`) REFERENCES `departments` (`departmentID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_ibfk_1` FOREIGN KEY (`companyID`) REFERENCES `companies` (`companyID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `leaverequests`
--
ALTER TABLE `leaverequests`
  ADD CONSTRAINT `leaverequests_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `company_users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payroll`
--
ALTER TABLE `payroll`
  ADD CONSTRAINT `payroll_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `company_users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
