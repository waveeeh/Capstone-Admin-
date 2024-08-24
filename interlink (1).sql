-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 10, 2024 at 03:46 AM
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
-- Database: `interlink`
--

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `ApplicationId` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `JobID` int(11) NOT NULL,
  `CompanyID` int(11) NOT NULL,
  `InternshipId` int(11) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `ApplicationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `CompanyId` int(11) NOT NULL,
  `CompanyName` varchar(255) NOT NULL,
  `Website` varchar(255) DEFAULT NULL,
  `CompanyLogo` varchar(255) DEFAULT NULL,
  `UserId` int(11) NOT NULL,
  `MoA` text NOT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`CompanyId`, `CompanyName`, `Website`, `CompanyLogo`, `UserId`, `MoA`, `photo`) VALUES
(35, 'interlink', '', '../uploads/images/4060492.jpg', 67, 'uploads/MoA/Doc1.docx', '../uploads/images/upwork dp.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `coordinator`
--

CREATE TABLE `coordinator` (
  `CoordinatorID` int(11) DEFAULT NULL,
  `CoordinatorName` varchar(255) NOT NULL,
  `UserId` int(11) NOT NULL,
  `CompanyId` int(11) NOT NULL,
  `ApplicationId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `DocId` int(11) NOT NULL,
  `UserId` int(10) NOT NULL,
  `fileName` varchar(100) NOT NULL,
  `fileType` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`DocId`, `UserId`, `fileName`, `fileType`, `created_at`) VALUES
(70, 72, 'resume.docx', 'resume', '2024-08-05 05:35:33');

-- --------------------------------------------------------

--
-- Table structure for table `internship`
--

CREATE TABLE `internship` (
  `InternshipId` int(11) NOT NULL,
  `JobId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `JobId` int(11) NOT NULL,
  `Position` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `NoOfOpenings` int(5) NOT NULL,
  `CompanyId` int(11) NOT NULL,
  `monthlyAllowance` double DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `LocationId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`JobId`, `Position`, `Description`, `NoOfOpenings`, `CompanyId`, `monthlyAllowance`, `startDate`, `endDate`, `LocationId`) VALUES
(19, 'Web Developer', '', 3, 35, 5, '2024-08-01', '2024-08-01', 0),
(28, '', '', 0, 35, 0, '0000-00-00', '0000-00-00', 0),
(29, 'Network Engineer', '', 5, 35, 5, '2024-08-06', '2024-08-06', 0),
(30, '', '', 0, 35, 0, '0000-00-00', '0000-00-00', 0),
(31, '', '', 0, 35, 0, '0000-00-00', '0000-00-00', 0),
(32, '', '', 0, 35, 0, '0000-00-00', '0000-00-00', 0),
(33, 'nigga', '', 2, 35, 0, '2024-08-06', '2024-08-06', 0),
(34, 'asdasd', '', 2, 35, 0, '0000-00-00', '0000-00-00', 0),
(35, 'asdasd', '', 2, 35, 0, '0000-00-00', '0000-00-00', 0),
(36, 'asdasd', '', 2, 35, 0, '0000-00-00', '0000-00-00', 41),
(37, 'Web Developer', '', 2, 35, 0, '2024-08-06', '2024-08-06', 42),
(38, 'Web Developer', '', 2, 35, 0, '2024-08-06', '2024-08-06', 43),
(39, '', '', 0, 35, 0, '0000-00-00', '0000-00-00', 44),
(40, 'Web Developer', '', 2, 35, 1, '2024-08-10', '2024-08-10', 45),
(41, '', '', 0, 35, 0, '0000-00-00', '0000-00-00', 46),
(42, 'nigga', '', 0, 35, 0, '0000-00-00', '0000-00-00', 47),
(43, 'nigga', '', 0, 35, 0, '0000-00-00', '0000-00-00', 48);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `LocationId` int(11) NOT NULL,
  `Street` varchar(255) NOT NULL,
  `Barangay` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `Province` varchar(255) NOT NULL,
  `UserId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`LocationId`, `Street`, `Barangay`, `City`, `Province`, `UserId`) VALUES
(9, 'asdasd', 'asdasd', 'adasd', 'asdasd', 0),
(10, 'asdasdas', 'asdasdas', 'asdasda', 'asdasdasd', 0),
(11, 'asdasdas', 'asdasdas', 'asdasda', 'asdasdasd', 0),
(12, 'asdasdas', 'asdasdas', 'asdasda', 'asdasdasd', 0),
(13, 'adasd', 'adasd', 'adad', 'asdasdas', 0),
(14, '#775 rizal street', 'Santor', 'Bongabon', 'Nueva Ecija', 0),
(15, 'asdasd', 'asdad', 'asdasd', 'asdasdasd', 0),
(16, 'adsad', 'asdasd', 'asdasd', 'asdasd', 0),
(17, 'adsad', 'asdasd', 'asdasd', 'asdasd', 0),
(18, 'adsad', 'asdasd', 'asdasd', 'asdasd', 0),
(19, 'adsad', 'asdasd', 'asdasd', 'asdasd', 0),
(24, '#775 rizal street', 'Santor', 'Bongabon', 'Nueva Ecija', 67),
(25, 'asdasd', 'asad', 'asdasdadad', 'asdad', 67),
(26, 'asdasd', 'asad', 'asdasdadad', 'asdad', 67),
(27, 'asdasd', 'asad', 'asdasdadad', 'asdad', 67),
(32, '#775 rizal street', 'Santor', 'Bongabon', 'Nueva Ecija', 72),
(33, '', '', '', '', 67),
(34, '', '', '', '', 72),
(35, '#775 rizal street', 'Santor', 'Bongabon', 'Nueva Ecija', 72),
(36, '', '', '', '', 72),
(37, '', '', '', '', 72),
(38, 'asdsad', 'adada', 'asdasdas', 'adadasd', 72),
(39, 'asdasd', 'dasdad', 'asdasd', 'adadas', 72),
(40, 'asdasd', 'dasdad', 'asdasd', 'adadas', 72),
(41, 'asdasd', 'dasdad', 'asdasd', 'adadas', 72),
(42, 'asdasd', 'asdadasd', 'cabanatuan', 'adad', 72),
(43, 'asdasd', 'asdadasd', 'cabanatuan', 'adad', 72),
(44, '', '', '', '', 67),
(45, '13822 NE AirPorT wAy', 'sadasd', 'portland', 'OR', 67),
(46, '', '', '', '', 67),
(47, 'Rizal Street', 'Santor', 'Bongabon', 'Nueva Ecija', 67),
(48, 'Rizal Street', 'Santor', 'Bongabon', 'Nueva Ecija', 67);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `SkillId` int(11) NOT NULL,
  `SkillName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`SkillId`, `SkillName`) VALUES
(78, 'php'),
(79, 'aegis'),
(80, 'html'),
(81, 'asd'),
(82, 'jquery'),
(83, 'json'),
(84, 'front-end'),
(85, 'MERN');

-- --------------------------------------------------------

--
-- Table structure for table `skillset`
--

CREATE TABLE `skillset` (
  `SkillSetId` int(11) NOT NULL,
  `SkillId` int(10) NOT NULL,
  `UserId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skillset`
--

INSERT INTO `skillset` (`SkillSetId`, `SkillId`, `UserId`) VALUES
(53, 78, 46),
(54, 79, 46),
(55, 80, 46),
(56, 81, 46),
(57, 82, 72),
(58, 83, 72),
(59, 84, 72),
(60, 85, 72),
(61, 82, 72),
(62, 83, 72),
(63, 84, 72),
(64, 85, 72),
(65, 82, 72),
(66, 83, 72),
(67, 84, 72),
(68, 85, 72),
(69, 82, 72),
(70, 83, 72),
(71, 84, 72),
(72, 85, 72);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `StudentId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `StudentNo` varchar(10) NOT NULL,
  `DoB` date NOT NULL,
  `AboutMe` text DEFAULT NULL,
  `Experience` text DEFAULT NULL,
  `section` char(2) NOT NULL,
  `course` varchar(255) NOT NULL,
  `phoneNo` varchar(15) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`StudentId`, `UserId`, `StudentNo`, `DoB`, `AboutMe`, `Experience`, `section`, `course`, `phoneNo`, `photo`) VALUES
(21, 72, 'SUM2021-01', '2024-08-05', 'ASDASDASDASDASDAS', 'ADSADASDASDASDASD', 'A', 'Bachelor Of Science in Information Technology', '09511018949', 'Picture1.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserId` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `MiddleName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) NOT NULL,
  `userRole` varchar(15) NOT NULL,
  `EmailAddress` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserId`, `firstName`, `MiddleName`, `LastName`, `userRole`, `EmailAddress`, `Password`) VALUES
(67, 'ralph', 'omana', 'canlas', 'employer', 'rcanlas012003@gmail.com', '$2y$10$n5V5eRcvORKwc0o5DVbU7.qeMNG/SMUlXZeD6RX.c5F8BRoo2Waqu'),
(72, 'Ralph Ashley', 'Omana', 'O. Canlas', 'student', 'clarence@gmail.com', '$2y$10$VB4wDJXfuq5Nf5KP63GCgO3DGmwjaeIwoLvplZ1kcJM2J3V30mBWW');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`ApplicationId`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`CompanyId`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`DocId`);

--
-- Indexes for table `internship`
--
ALTER TABLE `internship`
  ADD PRIMARY KEY (`InternshipId`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`JobId`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`LocationId`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`SkillId`);

--
-- Indexes for table `skillset`
--
ALTER TABLE `skillset`
  ADD PRIMARY KEY (`SkillSetId`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`StudentId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserId`),
  ADD UNIQUE KEY `EmailAddress` (`EmailAddress`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `ApplicationId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `CompanyId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `DocId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `internship`
--
ALTER TABLE `internship`
  MODIFY `InternshipId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `JobId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `LocationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `SkillId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `skillset`
--
ALTER TABLE `skillset`
  MODIFY `SkillSetId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `StudentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
