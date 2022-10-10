-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2022 at 06:49 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `college`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_drop_subject`
--

CREATE TABLE `add_drop_subject` (
  `add_drop_id` int(11) NOT NULL,
  `enrolled_subject_id` varchar(50) NOT NULL,
  `enrollment_id` varchar(50) NOT NULL,
  `section_id` varchar(50) NOT NULL,
  `advisers_id` varchar(50) NOT NULL,
  `teacher_id` varchar(50) NOT NULL,
  `student_number` varchar(50) NOT NULL,
  `subject_id` varchar(50) NOT NULL,
  `schoolyear` varchar(50) NOT NULL,
  `first_grading` int(50) NOT NULL,
  `second_grading` int(50) NOT NULL,
  `third_grading` int(50) NOT NULL,
  `fourth_grading` int(50) NOT NULL,
  `section_subjectId` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `userlevel` varchar(50) NOT NULL,
  `schoolyear` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `email`, `password`, `firstname`, `middlename`, `lastname`, `userlevel`, `schoolyear`) VALUES
(1, 'admin@school.com', 'admin123', 'Lester', 'Carbungco', 'Tuazon', 'admin', '2022-2023');

-- --------------------------------------------------------

--
-- Table structure for table `advisers`
--

CREATE TABLE `advisers` (
  `assign_adviser_id` int(11) NOT NULL,
  `section_id` varchar(50) NOT NULL,
  `adviser_id` varchar(50) NOT NULL,
  `yearsection_assign` varchar(50) NOT NULL,
  `schoolyear_assign` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(200) NOT NULL,
  `course_description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `course_description`) VALUES
(1, 'ABM', 'This is ABM, Course of malalakas'),
(2, 'ICT', 'This is ICT, course of mga bobo');

-- --------------------------------------------------------

--
-- Table structure for table `enrolled_subject`
--

CREATE TABLE `enrolled_subject` (
  `enrolled_subject_id` int(11) NOT NULL,
  `enrollment_id` varchar(50) NOT NULL,
  `section_id` varchar(50) NOT NULL,
  `advisers_id` varchar(50) NOT NULL,
  `teacher_id` varchar(50) NOT NULL,
  `student_number` varchar(50) NOT NULL,
  `subject_id` varchar(50) NOT NULL,
  `schoolyear` varchar(50) NOT NULL,
  `first_grading` int(50) NOT NULL,
  `second_grading` int(50) NOT NULL,
  `third_grading` int(50) NOT NULL,
  `fourth_grading` int(50) NOT NULL,
  `section_subjectId` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `enrollment_id` int(11) NOT NULL,
  `student_id` varchar(50) NOT NULL,
  `student_number` varchar(50) NOT NULL,
  `section_id` varchar(50) NOT NULL,
  `adviser` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `student_email` varchar(50) NOT NULL,
  `yearsection` varchar(50) NOT NULL,
  `enrollment_status` varchar(50) NOT NULL,
  `schoolyear` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`enrollment_id`, `student_id`, `student_number`, `section_id`, `adviser`, `fullname`, `student_email`, `yearsection`, `enrollment_status`, `schoolyear`) VALUES
(1, '1', '2223-1', '1', '', 'Edreen Mae  Paynado', 'e.paynado231@school.com', '11A', 'PENDING', '2022-2023'),
(2, '2', '2223-2', '5', '', 'Lester Carbungco Tuazon', 'l.tuazon232@school.com', '11A', 'PENDING', '2022-2023');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `headline` varchar(50) NOT NULL,
  `image_header` varchar(200) NOT NULL,
  `news_content` text NOT NULL,
  `gallery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `news_content`
--

CREATE TABLE `news_content` (
  `newscontent_id` int(11) NOT NULL,
  `news_id` varchar(50) NOT NULL,
  `news_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `section_id` int(11) NOT NULL,
  `schoolyear` varchar(50) NOT NULL,
  `grade_year` varchar(50) NOT NULL,
  `section` varchar(50) NOT NULL,
  `section_course` varchar(50) NOT NULL,
  `yearsection` varchar(50) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `student_qty` int(50) NOT NULL,
  `max_qty` int(50) NOT NULL,
  `adviser` varchar(50) NOT NULL,
  `section_status` varchar(50) NOT NULL,
  `assign_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`section_id`, `schoolyear`, `grade_year`, `section`, `section_course`, `yearsection`, `start_date`, `end_date`, `student_qty`, `max_qty`, `adviser`, `section_status`, `assign_status`) VALUES
(1, '2022-2023', '11', 'A', 'ABM', '11A', '2022-10-07 15:34:00', '2022-10-08 15:34:00', 1, 2, '', 'ONGOING', ''),
(2, '2022-2023', '11', 'B', 'ABM', '11B', '2022-10-07 15:34:00', '2022-10-08 15:34:00', 0, 2, '', 'ONGOING', ''),
(3, '2022-2023', '12', 'A', 'ABM', '12A', '2022-10-07 15:34:00', '2022-10-08 15:34:00', 0, 2, '', 'ONGOING', ''),
(4, '2022-2023', '12', 'B', 'ABM', '12B', '2022-10-07 15:34:00', '2022-10-08 15:34:00', 0, 2, '', 'ONGOING', ''),
(5, '2022-2023', '11', 'A', 'ICT', '11A', '2022-10-07 15:34:00', '2022-10-08 15:34:00', 1, 2, '', 'ONGOING', ''),
(6, '2022-2023', '11', 'B', 'ICT', '11B', '2022-10-07 15:34:00', '2022-10-08 15:34:00', 0, 2, '', 'ONGOING', ''),
(7, '2022-2023', '12', 'B', 'ICT', '12B', '2022-10-07 15:34:00', '2022-10-08 15:34:00', 0, 2, '', 'ONGOING', ''),
(8, '2022-2023', '12', 'A', 'ICT', '12A', '2022-10-07 15:34:00', '2022-10-08 15:34:00', 0, 2, '', 'ONGOING', '');

-- --------------------------------------------------------

--
-- Table structure for table `section_subject`
--

CREATE TABLE `section_subject` (
  `section_subjectId` int(11) NOT NULL,
  `section_id` varchar(50) NOT NULL,
  `section_course` varchar(50) NOT NULL,
  `subject_id` varchar(50) NOT NULL,
  `teacher_id` varchar(50) NOT NULL,
  `adviser_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `section_subject`
--

INSERT INTO `section_subject` (`section_subjectId`, `section_id`, `section_course`, `subject_id`, `teacher_id`, `adviser_id`) VALUES
(1, '1', 'ABM', '1', '', ''),
(2, '1', 'ABM', '2', '', ''),
(3, '1', 'ABM', '3', '', ''),
(4, '1', 'ABM', '4', '', ''),
(5, '2', 'ABM', '1', '', ''),
(6, '2', 'ABM', '2', '', ''),
(7, '2', 'ABM', '3', '', ''),
(8, '2', 'ABM', '4', '', ''),
(9, '3', 'ABM', '1', '', ''),
(10, '3', 'ABM', '2', '', ''),
(11, '3', 'ABM', '3', '', ''),
(12, '3', 'ABM', '4', '', ''),
(13, '4', 'ABM', '1', '', ''),
(14, '4', 'ABM', '2', '', ''),
(15, '4', 'ABM', '3', '', ''),
(16, '4', 'ABM', '4', '', ''),
(17, '5', 'ICT', '1', '', ''),
(18, '5', 'ICT', '2', '', ''),
(19, '5', 'ICT', '3', '', ''),
(20, '5', 'ICT', '4', '', ''),
(21, '6', 'ICT', '1', '', ''),
(22, '6', 'ICT', '2', '', ''),
(23, '6', 'ICT', '3', '', ''),
(24, '6', 'ICT', '4', '', ''),
(25, '7', 'ICT', '1', '', ''),
(26, '7', 'ICT', '2', '', ''),
(27, '7', 'ICT', '3', '', ''),
(28, '7', 'ICT', '4', '', ''),
(29, '8', 'ICT', '1', '', ''),
(30, '8', 'ICT', '2', '', ''),
(31, '8', 'ICT', '3', '', ''),
(32, '8', 'ICT', '4', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_id` int(11) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `subject_code` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `subject`, `subject_code`, `description`) VALUES
(1, 'English', 'ENG1', 'THE ENG1'),
(2, 'MATH', 'MT1', 'THE MT1'),
(3, 'SCIENCE', 'SC1', 'THE SC1'),
(4, 'FILIPINO', 'FIL1', 'THE FIL1');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacher_id` int(11) NOT NULL,
  `teacher_email` varchar(50) NOT NULL,
  `teacher_firstname` varchar(50) NOT NULL,
  `teacher_middlename` varchar(50) NOT NULL,
  `teacher_lastname` varchar(50) NOT NULL,
  `teacher_contactnumber` varchar(50) NOT NULL,
  `teacher_userlevel` varchar(50) NOT NULL,
  `teacher_department` varchar(50) NOT NULL,
  `teacher_status` varchar(50) NOT NULL,
  `teacher_password` varchar(100) NOT NULL,
  `teacher_rank` varchar(50) NOT NULL,
  `schoolyear` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `teacher_email`, `teacher_firstname`, `teacher_middlename`, `teacher_lastname`, `teacher_contactnumber`, `teacher_userlevel`, `teacher_department`, `teacher_status`, `teacher_password`, `teacher_rank`, `schoolyear`) VALUES
(1, 'ericaventura@school.com', 'Erica', 'Tuazon', 'Ventura', '09212483577', 'TEACHER', 'math', 'ACTIVATED', '$2y$10$z18fybahEzXNnnxZwpn2tO91Eck3o0WAWx2ahcpw6f87oAiRVXvmy', 'teacher1', '2022-2023');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `student_number` varchar(50) NOT NULL,
  `course` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `userlevel` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `year` varchar(50) NOT NULL,
  `schoolyear` varchar(50) NOT NULL,
  `schoolyear_accepted` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `student_number`, `course`, `password`, `firstname`, `middlename`, `lastname`, `contact_number`, `userlevel`, `status`, `year`, `schoolyear`, `schoolyear_accepted`) VALUES
(1, 'e.paynado231@school.com', '2223-1', 'ABM', '$2y$10$p7FfmOVHP2TmfDXu9tNMR.xMqF98XG5BTLoE658mIzAOFb4E8q5aW', 'Edreen Mae', '', 'Paynado', '09212483577', 'Student', 'ACTIVATED', '11', '2022-2023', '2022-2023'),
(2, 'l.tuazon232@school.com', '2223-2', 'ICT', '$2y$10$TlI0C9DHIHTorpxMkbdp/uG7nhf0Mx9NfF5fqpmPjBfMOy0wwkKMC', 'Lester', 'Carbungco', 'Tuazon', '09212483577', 'Student', 'ACTIVATED', '11', '2022-2023', '2022-2023');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_drop_subject`
--
ALTER TABLE `add_drop_subject`
  ADD PRIMARY KEY (`add_drop_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `advisers`
--
ALTER TABLE `advisers`
  ADD PRIMARY KEY (`assign_adviser_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `enrolled_subject`
--
ALTER TABLE `enrolled_subject`
  ADD PRIMARY KEY (`enrolled_subject_id`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`enrollment_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `news_content`
--
ALTER TABLE `news_content`
  ADD PRIMARY KEY (`newscontent_id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `section_subject`
--
ALTER TABLE `section_subject`
  ADD PRIMARY KEY (`section_subjectId`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_drop_subject`
--
ALTER TABLE `add_drop_subject`
  MODIFY `add_drop_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `advisers`
--
ALTER TABLE `advisers`
  MODIFY `assign_adviser_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `enrolled_subject`
--
ALTER TABLE `enrolled_subject`
  MODIFY `enrolled_subject_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `enrollment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news_content`
--
ALTER TABLE `news_content`
  MODIFY `newscontent_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `section_subject`
--
ALTER TABLE `section_subject`
  MODIFY `section_subjectId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
