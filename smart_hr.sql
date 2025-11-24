-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2025 at 06:25 PM
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
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `adminID` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `departmentID` int(11) DEFAULT NULL,
  `designationID` int(11) DEFAULT NULL,
  `companyID` int(11) NOT NULL,
  `salary` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`adminID`, `firstName`, `lastName`, `email`, `password`, `departmentID`, `designationID`, `companyID`, `salary`) VALUES
(1, 'James', 'Baxter', 'JB@greenvale.com', '$2y$12$uuelc/4POlVAlJ19dUKtpu/MxGAS9pYf41X5Pk.3zz4LXYH1SLAMy', 3, 2, 1, 100000.00);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendanceID` int(11) NOT NULL,
  `employeeID` int(11) NOT NULL,
  `scheduleDate` date DEFAULT NULL,
  `clockIN` timestamp NOT NULL DEFAULT current_timestamp(),
  `clockOut` timestamp NULL DEFAULT NULL,
  `totalHours` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendanceID`, `employeeID`, `scheduleDate`, `clockIN`, `clockOut`, `totalHours`) VALUES
(1, 1, '2025-11-01', '2025-11-01 13:00:00', '2025-11-01 21:00:00', 8.00),
(2, 1, '2025-11-01', '2025-11-01 12:45:00', '2025-11-01 21:15:00', 8.50),
(3, 1, '2025-11-01', '2025-11-01 13:30:00', '2025-11-01 22:00:00', 8.50);

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
(3, 'Silverline Consulting');

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
(8, 'IT Support', 3);

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `designationID` int(11) NOT NULL,
  `designationName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`designationID`, `designationName`) VALUES
(1, 'Sales Associate'),
(2, 'Administrative Manager'),
(3, 'Finance Consultant');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employeeID` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `departmentID` int(11) DEFAULT NULL,
  `designationID` int(11) DEFAULT NULL,
  `companyID` int(11) NOT NULL,
  `salary` decimal(10,2) NOT NULL,
  `employee_type` enum('contract','part-time','full-time') DEFAULT NULL,
  `salary_type` enum('hourly','monthly','salary') DEFAULT NULL,
  `rate` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employeeID`, `firstName`, `lastName`, `email`, `password`, `departmentID`, `designationID`, `companyID`, `salary`, `employee_type`, `salary_type`, `rate`) VALUES
(1, 'Ashely', 'Arin', 'AshA@greenvale.com', '$2y$12$guJVteqcoDIpwJdn1JlRYe6ORRDgU0riCsWkR63QEC52ZoHo5br9C', 3, 1, 1, 0.00, 'part-time', 'hourly', 8.00),
(2, 'Kylee', 'Grasela', 'Kyleeg@greenvale.com', '$2y$12$Ald1T2hs4TcezG//zGlFFOP9kSAE3Iuo1c3i3PwyID07Qmll17JWe', 2, 3, 1, 0.00, 'full-time', 'monthly', 3000.00),
(3, 'Jon', 'Doe', 'jd@greenvale.com', '$2y$12$XoQKqhwIc60SGWJJ9apETOXdrtr5ypqZLvMLacsKejYt1Or7NPZu2', 2, 1, 1, 0.00, 'part-time', 'hourly', 15.00);

-- --------------------------------------------------------

--
-- Table structure for table `leaverequests`
--

CREATE TABLE `leaverequests` (
  `requestID` int(11) NOT NULL,
  `employeeID` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  `reason` text DEFAULT NULL,
  `leaveStart` timestamp NOT NULL DEFAULT current_timestamp(),
  `leaveEnd` timestamp NULL DEFAULT NULL,
  `approvalStatus` enum('Pending','Approved','Denied') DEFAULT 'Pending',
  `submissionDate` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leaverequests`
--

INSERT INTO `leaverequests` (`requestID`, `employeeID`, `companyID`, `reason`, `leaveStart`, `leaveEnd`, `approvalStatus`, `submissionDate`) VALUES
(1, 1, 1, 'Medical appointment', '2025-11-05 14:00:00', '2025-11-05 18:00:00', 'Pending', '2025-11-01'),
(2, 1, 1, 'Family emergency', '2025-11-10 13:00:00', '2025-11-12 22:00:00', 'Denied', '2025-11-02'),
(3, 1, 1, 'Conference attendance', '2025-11-15 14:00:00', '2025-11-17 23:00:00', 'Denied', '2025-11-03'),
(4, 2, 1, 'Family Get-together', '2025-11-05 15:25:43', '2025-11-06 15:25:14', 'Approved', '2025-11-05'),
(5, 2, 1, 'Sick', '2025-11-06 23:50:19', '2025-11-07 23:50:02', 'Denied', '2025-11-06'),
(6, 2, 1, 'Unspecified', '2025-11-27 23:50:22', '2025-11-29 23:50:22', 'Approved', '2025-11-06'),
(7, 1, 1, 'Family Event', '2025-11-29 23:50:46', '2025-11-29 23:50:46', 'Denied', '2025-11-06'),
(8, 2, 1, 'Christmas Vacation', '2025-12-10 23:51:13', '2025-12-31 23:51:13', 'Pending', '2025-11-06'),
(9, 2, 1, 'Family Vacation', '2025-11-06 23:51:49', '2025-11-10 23:51:49', 'Approved', '2025-11-06'),
(10, 1, 1, 'Baby Sitting', '2025-11-06 23:52:24', '2025-11-07 23:52:12', 'Pending', '2025-11-06'),
(11, 1, 1, 'Sad Time ;(', '2025-11-06 23:52:41', '2025-11-08 23:52:28', 'Pending', '2025-11-06');

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
  `employeeID` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  `payment` decimal(10,2) DEFAULT NULL,
  `status` enum('Processed','Unprocessed') DEFAULT 'Unprocessed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`payrollID`, `employeeID`, `companyID`, `payment`, `status`) VALUES
(1, 1, 1, 70500.00, 'Processed');

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
('2lhfDwepOVwSKT8Yv6H6XZ3Gcvv9U6IXz6srh0wQ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTE0yZlBoV2FlT2x4ZEdyRTFVUVkxNzJZRDVKakt2eFFldVU1SUxZZiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXRlIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1763063194),
('A6T8vAEocZFw1k2oP0VAH0WBVBtpwIQcvJpt7ye6', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoib215SHZkSmZBRU14eXdWVGZ6ckRRRkJXQWF2SnhzWGNma21UUTg0OSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hdHRlbmRhbmNlIjtzOjU6InJvdXRlIjtzOjEwOiJhdHRlbmRhbmNlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1NToibG9naW5fZW1wbG95ZWVfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO3M6NDoicm9sZSI7czo4OiJlbXBsb3llZSI7fQ==', 1763063546),
('yjlSlkM9vEkFwY9ZwsxGWVBJTW8dtbWCDj5coghI', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMHNiRkJQSGY0SmFEdTdjY0VZdlRWaDRIQjkwMHhlY3MwRGhta3ltQSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9sZWF2ZXJlcXVlc3RzIjtzOjU6InJvdXRlIjtzOjU6ImxlYXZlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NDoicm9sZSI7czo1OiJhZG1pbiI7fQ==', 1762968406);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`adminID`),
  ADD KEY `departmentID` (`departmentID`),
  ADD KEY `designationID` (`designationID`),
  ADD KEY `companyID` (`companyID`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendanceID`),
  ADD KEY `employeeID` (`employeeID`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`companyID`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`departmentID`),
  ADD KEY `companyID` (`companyID`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`designationID`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employeeID`),
  ADD KEY `departmentID` (`departmentID`),
  ADD KEY `designationID` (`designationID`),
  ADD KEY `companyID` (`companyID`);

--
-- Indexes for table `leaverequests`
--
ALTER TABLE `leaverequests`
  ADD PRIMARY KEY (`requestID`),
  ADD KEY `employeeID` (`employeeID`),
  ADD KEY `companyID` (`companyID`);

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
  ADD KEY `employeeID` (`employeeID`),
  ADD KEY `companyID` (`companyID`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendanceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `companyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `departmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `designationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `leaverequests`
--
ALTER TABLE `leaverequests`
  MODIFY `requestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `payrollID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`departmentID`) REFERENCES `departments` (`departmentID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `admins_ibfk_2` FOREIGN KEY (`designationID`) REFERENCES `designations` (`designationID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `admins_ibfk_3` FOREIGN KEY (`companyID`) REFERENCES `companies` (`companyID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`employeeID`) REFERENCES `employees` (`employeeID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_ibfk_1` FOREIGN KEY (`companyID`) REFERENCES `companies` (`companyID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`departmentID`) REFERENCES `departments` (`departmentID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `employees_ibfk_2` FOREIGN KEY (`designationID`) REFERENCES `designations` (`designationID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `employees_ibfk_3` FOREIGN KEY (`companyID`) REFERENCES `companies` (`companyID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `leaverequests`
--
ALTER TABLE `leaverequests`
  ADD CONSTRAINT `leaverequests_ibfk_1` FOREIGN KEY (`employeeID`) REFERENCES `employees` (`employeeID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `leaverequests_ibfk_2` FOREIGN KEY (`companyID`) REFERENCES `companies` (`companyID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payroll`
--
ALTER TABLE `payroll`
  ADD CONSTRAINT `payroll_ibfk_1` FOREIGN KEY (`employeeID`) REFERENCES `employees` (`employeeID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payroll_ibfk_2` FOREIGN KEY (`companyID`) REFERENCES `companies` (`companyID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
