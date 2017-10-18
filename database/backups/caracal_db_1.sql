-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2017 at 07:35 AM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `caracal_db`
--
CREATE DATABASE IF NOT EXISTS `caracal_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `caracal_db`;

-- --------------------------------------------------------

--
-- Table structure for table `assesment`
--

DROP TABLE IF EXISTS `assesment`;
CREATE TABLE IF NOT EXISTS `assesment` (
  `assesment_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'exam',
  `memo_id` int(11) DEFAULT NULL,
  `assesment_date` date NOT NULL,
  `assesment_start_date` date NOT NULL,
  `assesment_end_date` date NOT NULL,
  `attempts` int(11) NOT NULL,
  `no_papers_marked` int(11) NOT NULL DEFAULT '0',
  `no_papers_uploaded` int(11) NOT NULL DEFAULT '0',
  `scripts_path` text,
  `scripts_available` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`assesment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assesment`
--

INSERT INTO `assesment` (`assesment_id`, `name`, `type`, `memo_id`, `assesment_date`, `assesment_start_date`, `assesment_end_date`, `attempts`, `no_papers_marked`, `no_papers_uploaded`, `scripts_path`, `scripts_available`) VALUES
(1, 'Paper 1', 'exam', 24, '2017-08-23', '2017-08-08', '2017-08-31', 3, 0, 12, 'exam/exam_scripts_17_10_04_LCK.zip', 1),
(20, 'Assignment 2', 'assignment', 24, '2017-08-16', '2017-08-09', '2017-08-24', 2, 0, 0, '', 0),
(92, 'math 2017', 'exam', NULL, '2017-10-04', '2017-10-04', '2017-10-05', 3, 0, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mark_sheet`
--

DROP TABLE IF EXISTS `mark_sheet`;
CREATE TABLE IF NOT EXISTS `mark_sheet` (
  `mark_sheet_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `assesment_id` int(11) NOT NULL,
  `date_marked` date DEFAULT NULL,
  `mark` int(3) NOT NULL DEFAULT '0',
  `submissions` int(11) NOT NULL,
  PRIMARY KEY (`mark_sheet_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mark_sheet`
--

INSERT INTO `mark_sheet` (`mark_sheet_id`, `student_id`, `assesment_id`, `date_marked`, `mark`, `submissions`) VALUES
(1, 4, 18, NULL, 86, 0),
(2, 4, 20, NULL, 86, 0);

-- --------------------------------------------------------

--
-- Table structure for table `memo`
--

DROP TABLE IF EXISTS `memo`;
CREATE TABLE IF NOT EXISTS `memo` (
  `memo_id` int(11) NOT NULL AUTO_INCREMENT,
  `total_number_of_questions` int(11) DEFAULT NULL,
  `sub_question_count` text,
  `file_path` text,
  `assesment_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`memo_id`),
  UNIQUE KEY `assesment_id` (`assesment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `memo`
--

INSERT INTO `memo` (`memo_id`, `total_number_of_questions`, `sub_question_count`, `file_path`, `assesment_id`) VALUES
(24, 2, '1,2', 'Math_Paper_1_Nov_2017/Memo_Paper_1_Math.json', 20),
(25, 2, '3,1,2,1', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `from_` int(11) NOT NULL,
  `to_` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(10) NOT NULL,
  `message` text NOT NULL,
  `read_` int(11) NOT NULL,
  PRIMARY KEY (`notification_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `query`
--

DROP TABLE IF EXISTS `query`;
CREATE TABLE IF NOT EXISTS `query` (
  `query_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `assesment_id` int(11) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`query_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

DROP TABLE IF EXISTS `request`;
CREATE TABLE IF NOT EXISTS `request` (
  `request_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(50) NOT NULL,
  `admin_surname` varchar(50) NOT NULL,
  `admin_email` varchar(500) NOT NULL,
  `admin_school` varchar(500) NOT NULL,
  `password` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`request_id`, `admin_name`, `admin_surname`, `admin_email`, `admin_school`, `password`) VALUES
(1, 'Xolani', 'Mangwane', 'x.mangwane@pronerd.co.za', 'Tipfuxeni Secondary School', '12'),
(2, 'Xolani', 'Mangwane', 'p.mangwane@pronerd.co.za', 'Ntswane Secondary School', '12'),
(3, 'Xolani', 'Mangwane', 'p.mangwane@pronerd.co.za', 'Ntswane Secondary School', '12'),
(4, '', '', 'j.makoya@pronerd.co.za', '', '12'),
(5, '', '', 'j.makoya@pronerd.co.za', '', '12'),
(6, '', '', 'j.makoya@pronerd.co.za', '', '12');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `papers_marked` int(11) NOT NULL,
  `activities_remaining` int(11) NOT NULL,
  `last_assesment_mark` int(11) NOT NULL,
  `exam_number` int(30) NOT NULL,
  `class` varchar(30) NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=MyISAM AUTO_INCREMENT=85423 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `user_id`, `papers_marked`, `activities_remaining`, `last_assesment_mark`, `exam_number`, `class`) VALUES
(4, 123, 3, 2, 12, 68484455, 'Grade 12 A'),
(85422, 85422, 0, 325235, 0, 0, 'DEMO');

-- --------------------------------------------------------

--
-- Table structure for table `submission`
--

DROP TABLE IF EXISTS `submission`;
CREATE TABLE IF NOT EXISTS `submission` (
  `submission_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `assesment_id` int(11) NOT NULL,
  `script_path` varchar(2000) NOT NULL,
  PRIMARY KEY (`submission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tutorials`
--

DROP TABLE IF EXISTS `tutorials`;
CREATE TABLE IF NOT EXISTS `tutorials` (
  `Type` varchar(250) NOT NULL,
  `Titile` varchar(250) NOT NULL,
  `Date` date NOT NULL,
  `posted_By` varchar(250) NOT NULL,
  `memo_id` int(11) NOT NULL,
  `tutorial_id` int(11) NOT NULL AUTO_INCREMENT,
  `quizbook_path` varchar(250) NOT NULL,
  `script_path` varchar(250) NOT NULL,
  PRIMARY KEY (`tutorial_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tutorials`
--

INSERT INTO `tutorials` (`Type`, `Titile`, `Date`, `posted_By`, `memo_id`, `tutorial_id`, `quizbook_path`, `script_path`) VALUES
('past_paper', 'Functions', '2017-10-05', 'Mangwane', 0, 11, 'marker/past_papers/11.pdf', ' '),
('past_paper', 'Linear Algebra', '2017-10-06', 'Mangwane', 0, 12, 'marker/past_papers/12.pdf', ' '),
('past_paper', 'sequence and Series', '2017-10-05', 'Mangwane', 0, 8, 'marker/past_papers/8.pdf', ' ');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` int(11) DEFAULT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(2500) NOT NULL,
  `picture` varchar(2500) DEFAULT NULL,
  `active` bit(1) NOT NULL DEFAULT b'0',
  `school` varchar(500) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=85423 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `firstname`, `lastname`, `role`, `date_of_birth`, `email`, `password`, `picture`, `active`, `school`) VALUES
(1, 1283921, 'Kenneth', 'Mangwane', 'Admin', '2017-08-09', 'k.mangwane@pronerd.co.za', '12', 'Uploads/_profile_pictures/5-best-short-hairstyles-Minnie-Dlamini_GwF.jpg', b'1', ''),
(123, 1283922, 'John', 'Makoya', 'Student', '1997-02-01', 'j.makoya@pronerd.co.za', '12', NULL, b'1', 'Tipfuxeni'),
(85422, NULL, 'Demo', 'User', 'Demo', '2017-08-01', 'null', 'null', NULL, b'0', 'null');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `memo`
--
ALTER TABLE `memo`
  ADD CONSTRAINT `memo_ibfk_1` FOREIGN KEY (`assesment_id`) REFERENCES `assesment` (`assesment_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
