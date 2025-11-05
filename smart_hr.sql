DROP DATABASE IF EXISTS smart_hr;

CREATE DATABASE smart_hr;

CREATE TABLE `companies` (
  `companyID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `companyName` varchar(50) NOT NULL
);

INSERT INTO `companies` (`companyID`, `companyName`) VALUES
(1, 'GreenVale Co.'),
(2, 'Horizon Group'),
(3, 'Silverline Consulting');

CREATE TABLE designations (
    designationID int AUTO_INCREMENT PRIMARY KEY,
    designationName varchar(50)
);

INSERT INTO designations (designationName) VALUES
('Sales Associate'),
('Administrative Manager'),
('Finance Consultant');

CREATE TABLE `departments` (
  `departmentID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `departmentName` varchar(50) NOT NULL,
  `companyID` int(11) NOT NULL,
    FOREIGN KEY (companyID) REFERENCES companies(companyID) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO `departments` (`departmentID`, `departmentName`, `companyID`) VALUES
(1, 'Construction', 1),
(2, 'Sales', 1),
(3, 'Marketing', 1),
(4, 'Sales', 2),
(5, 'Finance', 2),
(6, 'Maintinence', 2),
(7, 'Human Resources', 3),
(8, 'IT Support', 3);

CREATE TABLE `employees` (
  `employeeID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `departmentID` int(11),
  `designationID` int(11),
    companyID int(11) NOT NULL,
  `salary` decimal(10,2) NOT NULL,
    FOREIGN KEY (departmentID) REFERENCES departments(departmentID) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (designationID) REFERENCES designations(designationID) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (companyID) REFERENCES companies(companyID) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO `employees` (`employeeID`, `firstName`, `lastName`, `email`, `password`, `departmentID`, `designationID`,companyID, `salary`) VALUES
(1, 'Ashely', 'Arin', 'AshA@greenvale.com', '$2y$12$guJVteqcoDIpwJdn1JlRYe6ORRDgU0riCsWkR63QEC52ZoHo5br9C', 3, 1,1, 70000.00);

CREATE TABLE `attendance` (
  `attendanceID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `employeeID` int(11) NOT NULL,
  `scheduleDate` date DEFAULT NULL,
  `clockIN` timestamp NOT NULL DEFAULT current_timestamp(),
  `clockOut` timestamp NULL DEFAULT NULL,
  `totalHours` decimal(5,2) DEFAULT NULL,
   FOREIGN KEY (employeeID) REFERENCES employees(employeeID) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO attendance (employeeID, scheduleDate, clockIN, clockOut, totalHours) VALUES
(1, '2025-11-01', '2025-11-01 09:00:00', '2025-11-01 17:00:00', 8.00),
(2, '2025-11-01', '2025-11-01 08:45:00', '2025-11-01 17:15:00', 8.50),
(3, '2025-11-01', '2025-11-01 09:30:00', '2025-11-01 18:00:00', 8.50);

CREATE TABLE `admins` (
  `adminID` int(11) AUTO_INCREMENT PRIMARY KEY,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `departmentID` int(11),
  `designationID` int(11),
    companyID int(11) NOT NULL,
  `salary` decimal(10,2) NOT NULL,
    FOREIGN KEY (departmentID) REFERENCES departments(departmentID) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (designationID) REFERENCES designations(designationID) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (companyID) REFERENCES companies(companyID) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO `admins` (adminID,`firstName`, `lastName`, `email`, `password`, `departmentID`, `designationID`,companyID, `salary`) VALUES
(1,'James', 'Baxter', 'JB@greenvale.com', '$2y$12$uuelc/4POlVAlJ19dUKtpu/MxGAS9pYf41X5Pk.3zz4LXYH1SLAMy', 3, 2,1, 100000.00);

CREATE TABLE `leaverequests` (
  `requestID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `employeeID` int(11) NOT NULL,
    companyID int(11) NOT NULL,
  `reason` text DEFAULT NULL,
  `leaveStart` timestamp NOT NULL DEFAULT current_timestamp(),
  `leaveEnd` timestamp NULL DEFAULT NULL,
  `approvalStatus` enum('Pending','Approved','Denied') DEFAULT 'Pending',
  `submittionDate` date DEFAULT current_timestamp(),
    FOREIGN KEY (employeeID) REFERENCES employees(employeeID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (companyID) REFERENCES companies(companyID) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO leaverequests (employeeID, companyID, reason, leaveStart, leaveEnd, approvalStatus, submissionDate) VALUES
(1, 1, 'Medical appointment', '2025-11-05 09:00:00', '2025-11-05 13:00:00', 'Approved', '2025-11-01'),
(2, 2, 'Family emergency', '2025-11-10 08:00:00', '2025-11-12 17:00:00', 'Pending', '2025-11-02'),
(3, 3, 'Conference attendance', '2025-11-15 09:00:00', '2025-11-17 18:00:00', 'Denied', '2025-11-03');

CREATE TABLE `payroll` (
  `payrollID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `employeeID` int(11) NOT NULL,
    companyID int(11) NOT NULL,
  `month` varchar(20) NOT NULL,
  `basepay` decimal(10,2) NOT NULL,
  `overtimeHours` decimal(5,2) DEFAULT NULL,
  `otRate` decimal(10,2) DEFAULT NULL,
  `totalSalary` decimal(10,2) DEFAULT NULL,
  `status` enum('Processed','Unprocessed') DEFAULT 'Unprocessed',
    FOREIGN KEY (employeeID) REFERENCES employees(employeeID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (companyID) REFERENCES companies(companyID) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO payroll (employeeID, companyID, month, basepay, overtimeHours, otRate, totalSalary, status) VALUES
(1, 1, 'October', 70000.00, 10.00, 50.00, 70500.00, 'Processed'),
(2, 2, 'October', 85000.00, 5.00, 60.00, 85300.00, 'Processed'),
(3, 3, 'October', 92000.00, 0.00, 0.00, 92000.00, 'Unprocessed');

