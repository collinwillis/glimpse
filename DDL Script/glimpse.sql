-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 17, 2021 at 04:30 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `glimpse`
--

-- --------------------------------------------------------

--
-- Table structure for table `affinity_group`
--

CREATE TABLE `affinity_group` (
  `AffinityGroupID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `affinity_group`
--

INSERT INTO `affinity_group` (`AffinityGroupID`, `Name`, `Description`) VALUES
(9, 'Java', 'Group that likes Java'),
(10, 'PHP', 'Group that likes  PHP'),
(11, 'C#', 'Group that likes C#'),
(12, 'Python', 'Group that likes Python'),
(13, 'Swift', 'Group that likes Swift'),
(14, 'JavaScript', 'Group that likes JavaScript'),
(15, 'CSS', 'Group that likes CSS'),
(16, 'SQL', 'Group that likes SQL');

-- --------------------------------------------------------

--
-- Table structure for table `affinity_group_user`
--

CREATE TABLE `affinity_group_user` (
  `AffinityGroupUserID` int(11) NOT NULL,
  `AffinityGroupID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `EducationID` int(11) NOT NULL,
  `SchoolName` varchar(100) NOT NULL,
  `Degree` varchar(100) NOT NULL,
  `FieldOfStudy` varchar(100) NOT NULL,
  `StartDate` varchar(50) NOT NULL,
  `EndDate` varchar(50) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `JobID` int(11) NOT NULL,
  `Title` varchar(150) NOT NULL,
  `Company` varchar(150) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `Requirements` varchar(1000) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`JobID`, `Title`, `Company`, `Description`, `Requirements`, `UserID`) VALUES
(6, 'Software Developer', 'Google', 'Develop software at Google', 'Programming knowledge', 2),
(7, 'Cyber Security Specialist', 'E-Protect', 'IT specialist that implements security', 'IT expertise', 2),
(8, 'Stocker', 'Aliens R Us', 'Stock extraterrestrial merchandise in the Aliens R Us store', 'Str0ng', 2),
(10, 'Lifeguard', 'WaterSafe', 'Make sure no one drowns', 'Can swim. Extremely muscular (optional)', 2);

-- --------------------------------------------------------

--
-- Table structure for table `job_application`
--

CREATE TABLE `job_application` (
  `JobApplicationID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `JobID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `job_history`
--

CREATE TABLE `job_history` (
  `JobHistoryID` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Company` varchar(100) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `skill`
--

CREATE TABLE `skill` (
  `SkillID` int(11) NOT NULL,
  `Skill` varchar(500) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Gender` varchar(100) DEFAULT NULL,
  `Country` varchar(100) DEFAULT NULL,
  `State` varchar(100) DEFAULT NULL,
  `City` varchar(100) DEFAULT NULL,
  `ZipCode` varchar(100) DEFAULT NULL,
  `PhoneNumber` varchar(100) DEFAULT NULL,
  `Role` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `Username`, `Password`, `Email`, `Gender`, `Country`, `State`, `City`, `ZipCode`, `PhoneNumber`, `Role`) VALUES
(2, 'dereklundy', 'password', 'derek@gmail.com', 'M', 'US', 'AR', 'Camden', '85017', '823749827349', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `affinity_group`
--
ALTER TABLE `affinity_group`
  ADD PRIMARY KEY (`AffinityGroupID`);

--
-- Indexes for table `affinity_group_user`
--
ALTER TABLE `affinity_group_user`
  ADD PRIMARY KEY (`AffinityGroupUserID`),
  ADD KEY `AffinityGroupUserGroupID` (`AffinityGroupID`),
  ADD KEY `AffinityGroupUserUserID` (`UserID`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`EducationID`),
  ADD KEY `Education_UserID` (`UserID`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`JobID`),
  ADD KEY `Job_UserID` (`UserID`);

--
-- Indexes for table `job_application`
--
ALTER TABLE `job_application`
  ADD PRIMARY KEY (`JobApplicationID`),
  ADD KEY `job_application_userID` (`UserID`),
  ADD KEY `job_application_jobID` (`JobID`);

--
-- Indexes for table `job_history`
--
ALTER TABLE `job_history`
  ADD PRIMARY KEY (`JobHistoryID`),
  ADD KEY `Job_History_UserID` (`UserID`) USING BTREE;

--
-- Indexes for table `skill`
--
ALTER TABLE `skill`
  ADD PRIMARY KEY (`SkillID`),
  ADD KEY `Skill_UserID` (`UserID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `affinity_group`
--
ALTER TABLE `affinity_group`
  MODIFY `AffinityGroupID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `affinity_group_user`
--
ALTER TABLE `affinity_group_user`
  MODIFY `AffinityGroupUserID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `EducationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `JobID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `job_application`
--
ALTER TABLE `job_application`
  MODIFY `JobApplicationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `job_history`
--
ALTER TABLE `job_history`
  MODIFY `JobHistoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `skill`
--
ALTER TABLE `skill`
  MODIFY `SkillID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `affinity_group_user`
--
ALTER TABLE `affinity_group_user`
  ADD CONSTRAINT `AffinityGroupUserGroupID` FOREIGN KEY (`AffinityGroupID`) REFERENCES `affinity_group` (`AffinityGroupID`) ON DELETE CASCADE,
  ADD CONSTRAINT `AffinityGroupUserUserID` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `education`
--
ALTER TABLE `education`
  ADD CONSTRAINT `Education_UserID` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `job`
--
ALTER TABLE `job`
  ADD CONSTRAINT `Job_UserID` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `job_application`
--
ALTER TABLE `job_application`
  ADD CONSTRAINT `job_application_jobID` FOREIGN KEY (`JobID`) REFERENCES `job` (`JobID`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_application_userID` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `job_history`
--
ALTER TABLE `job_history`
  ADD CONSTRAINT `UserID` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `skill`
--
ALTER TABLE `skill`
  ADD CONSTRAINT `Skill_UserID` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
