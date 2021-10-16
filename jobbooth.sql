-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2021 at 07:39 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobbooth`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertisement`
--

CREATE TABLE `advertisement` (
  `ref_no` int(10) NOT NULL,
  `ad_title` varchar(50) NOT NULL,
  `job_title` varchar(50) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `frequency` enum('Hourly','Daily','Monthly','Per Job') DEFAULT NULL,
  `rate` decimal(10,2) DEFAULT NULL,
  `org_username` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `cand_username` varchar(50) NOT NULL,
  `nic` varchar(12) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `address_line1` varchar(100) NOT NULL,
  `address_line2` varchar(100) DEFAULT NULL,
  `street_name` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_no` char(10) NOT NULL,
  `level_of_education` enum('School','Diploma','Undergraduate','Bachelor’s Degree','Master’s Degree or Higher') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hire_rec`
--

CREATE TABLE `hire_rec` (
  `org_username` varchar(50) NOT NULL,
  `rec_username` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `job_type` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `interested_job_position`
--

CREATE TABLE `interested_job_position` (
  `cand_username` varchar(50) NOT NULL,
  `job_position` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `interview`
--

CREATE TABLE `interview` (
  `ref_no` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `interviewer`
--

CREATE TABLE `interviewer` (
  `inter_username` varchar(50) NOT NULL,
  `nic` varchar(12) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_no` char(10) NOT NULL,
  `description` varchar(255) NOT NULL,
  `org_username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `inter_feedback`
--

CREATE TABLE `inter_feedback` (
  `cand_username` varchar(50) NOT NULL,
  `inter_username` varchar(50) NOT NULL,
  `rating` decimal(4,2) NOT NULL,
  `feedback` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `inter_specialized_in`
--

CREATE TABLE `inter_specialized_in` (
  `inter_username` varchar(50) NOT NULL,
  `specialized_in` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `org_username` varchar(50) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `company_reg_no` varchar(15) NOT NULL,
  `address_line1` varchar(100) NOT NULL,
  `address_line2` varchar(100) DEFAULT NULL,
  `street_name` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telephone_no` char(10) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `recruiter`
--

CREATE TABLE `recruiter` (
  `rec_username` varchar(50) NOT NULL,
  `agency_reg_no` varchar(15) DEFAULT NULL,
  `agency_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_no` char(10) NOT NULL,
  `description` varchar(255) NOT NULL,
  `average_rating` decimal(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rec_feedback`
--

CREATE TABLE `rec_feedback` (
  `cand_username` varchar(50) NOT NULL,
  `rec_username` varchar(50) NOT NULL,
  `rating` decimal(4,2) NOT NULL,
  `feedback` varchar(255) NOT NULL,
  `selected` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rec_specialized_in`
--

CREATE TABLE `rec_specialized_in` (
  `rec_username` varchar(50) NOT NULL,
  `specialized_in` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `response`
--

CREATE TABLE `response` (
  `cand_username` varchar(50) NOT NULL,
  `ref_no` varchar(10) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `ref_no` varchar(10) NOT NULL,
  `org_username` varchar(50) DEFAULT NULL,
  `inter_username` varchar(50) DEFAULT NULL,
  `rec_username` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_photo` mediumblob DEFAULT NULL,
  `user_role` enum('Organization','Candidate','Recruiter','Interviewer') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertisement`
--
ALTER TABLE `advertisement`
  ADD PRIMARY KEY (`ref_no`),
  ADD KEY `org_username` (`org_username`);

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`cand_username`);

--
-- Indexes for table `hire_rec`
--
ALTER TABLE `hire_rec`
  ADD PRIMARY KEY (`org_username`,`rec_username`),
  ADD KEY `rec_username` (`rec_username`);

--
-- Indexes for table `interested_job_position`
--
ALTER TABLE `interested_job_position`
  ADD PRIMARY KEY (`cand_username`,`job_position`);

--
-- Indexes for table `interview`
--
ALTER TABLE `interview`
  ADD PRIMARY KEY (`ref_no`);

--
-- Indexes for table `interviewer`
--
ALTER TABLE `interviewer`
  ADD PRIMARY KEY (`inter_username`),
  ADD KEY `org_username` (`org_username`);

--
-- Indexes for table `inter_feedback`
--
ALTER TABLE `inter_feedback`
  ADD PRIMARY KEY (`cand_username`,`inter_username`),
  ADD KEY `inter_username` (`inter_username`);

--
-- Indexes for table `inter_specialized_in`
--
ALTER TABLE `inter_specialized_in`
  ADD PRIMARY KEY (`inter_username`,`specialized_in`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`org_username`),
  ADD UNIQUE KEY `company_reg_no` (`company_reg_no`);

--
-- Indexes for table `recruiter`
--
ALTER TABLE `recruiter`
  ADD PRIMARY KEY (`rec_username`),
  ADD UNIQUE KEY `agency_reg_no` (`agency_reg_no`);

--
-- Indexes for table `rec_feedback`
--
ALTER TABLE `rec_feedback`
  ADD PRIMARY KEY (`cand_username`,`rec_username`),
  ADD KEY `rec_username` (`rec_username`);

--
-- Indexes for table `rec_specialized_in`
--
ALTER TABLE `rec_specialized_in`
  ADD PRIMARY KEY (`rec_username`,`specialized_in`);

--
-- Indexes for table `response`
--
ALTER TABLE `response`
  ADD PRIMARY KEY (`cand_username`,`ref_no`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`ref_no`),
  ADD KEY `org_username` (`org_username`),
  ADD KEY `rec_username` (`rec_username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertisement`
--
ALTER TABLE `advertisement`
  MODIFY `ref_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advertisement`
--
ALTER TABLE `advertisement`
  ADD CONSTRAINT `advertisement_ibfk_1` FOREIGN KEY (`org_username`) REFERENCES `organization` (`org_username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `candidate`
--
ALTER TABLE `candidate`
  ADD CONSTRAINT `candidate_ibfk_1` FOREIGN KEY (`cand_username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hire_rec`
--
ALTER TABLE `hire_rec`
  ADD CONSTRAINT `hire_rec_ibfk_1` FOREIGN KEY (`org_username`) REFERENCES `organization` (`org_username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hire_rec_ibfk_2` FOREIGN KEY (`rec_username`) REFERENCES `recruiter` (`rec_username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `interested_job_position`
--
ALTER TABLE `interested_job_position`
  ADD CONSTRAINT `interested_job_position_ibfk_1` FOREIGN KEY (`cand_username`) REFERENCES `candidate` (`cand_username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `interviewer`
--
ALTER TABLE `interviewer`
  ADD CONSTRAINT `interviewer_ibfk_1` FOREIGN KEY (`inter_username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `interviewer_ibfk_2` FOREIGN KEY (`org_username`) REFERENCES `organization` (`org_username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inter_feedback`
--
ALTER TABLE `inter_feedback`
  ADD CONSTRAINT `inter_feedback_ibfk_1` FOREIGN KEY (`cand_username`) REFERENCES `candidate` (`cand_username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inter_feedback_ibfk_2` FOREIGN KEY (`inter_username`) REFERENCES `interviewer` (`inter_username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inter_specialized_in`
--
ALTER TABLE `inter_specialized_in`
  ADD CONSTRAINT `inter_specialized_in_ibfk_1` FOREIGN KEY (`inter_username`) REFERENCES `interviewer` (`inter_username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `organization`
--
ALTER TABLE `organization`
  ADD CONSTRAINT `organization_ibfk_1` FOREIGN KEY (`org_username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recruiter`
--
ALTER TABLE `recruiter`
  ADD CONSTRAINT `recruiter_ibfk_1` FOREIGN KEY (`rec_username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rec_feedback`
--
ALTER TABLE `rec_feedback`
  ADD CONSTRAINT `rec_feedback_ibfk_1` FOREIGN KEY (`cand_username`) REFERENCES `candidate` (`cand_username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rec_feedback_ibfk_2` FOREIGN KEY (`rec_username`) REFERENCES `recruiter` (`rec_username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rec_specialized_in`
--
ALTER TABLE `rec_specialized_in`
  ADD CONSTRAINT `rec_specialized_in_ibfk_1` FOREIGN KEY (`rec_username`) REFERENCES `recruiter` (`rec_username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `response`
--
ALTER TABLE `response`
  ADD CONSTRAINT `response_ibfk_1` FOREIGN KEY (`cand_username`) REFERENCES `candidate` (`cand_username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`org_username`) REFERENCES `organization` (`org_username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`rec_username`) REFERENCES `recruiter` (`rec_username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
