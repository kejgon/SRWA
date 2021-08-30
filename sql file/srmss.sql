-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 30, 2021 at 05:13 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `srmss`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'saxenapriyansh', '5e5693106f98422d9e1fa019202c1890'),
(3, 'john', '527bd5b5d689e2c32ae974c6229ff785');

-- --------------------------------------------------------

--
-- Table structure for table `tblclasses`
--

DROP TABLE IF EXISTS `tblclasses`;
CREATE TABLE IF NOT EXISTS `tblclasses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ClassName` varchar(255) DEFAULT NULL,
  `ClassNameNumeric` int(10) NOT NULL,
  `Section` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblclasses`
--

INSERT INTO `tblclasses` (`id`, `ClassName`, `ClassNameNumeric`, `Section`) VALUES
(1, 'Computer Science', 1, 'Semester1'),
(2, 'Computer Science', 1, 'Semeter2'),
(3, 'Law', 1, 'Semeter1'),
(4, 'Social science', 2, 'Semester3');

-- --------------------------------------------------------

--
-- Table structure for table `tblresult`
--

DROP TABLE IF EXISTS `tblresult`;
CREATE TABLE IF NOT EXISTS `tblresult` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `StudentId` int(11) DEFAULT NULL,
  `ClassId` int(11) DEFAULT NULL,
  `SubjectId` int(11) DEFAULT NULL,
  `cat1` int(11) DEFAULT NULL,
  `cat2` int(11) DEFAULT NULL,
  `exam` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=306 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblresult`
--

INSERT INTO `tblresult` (`id`, `StudentId`, `ClassId`, `SubjectId`, `cat1`, `cat2`, `exam`) VALUES
(301, 7, 3, 10, 7, 5, 55),
(302, 7, 3, 9, 4, 4, 66),
(303, 8, 2, 15, 7, 6, 44),
(304, 8, 2, 12, 8, 9, 33),
(305, 8, 2, 13, 5, 7, 65);

-- --------------------------------------------------------

--
-- Table structure for table `tblstudents`
--

DROP TABLE IF EXISTS `tblstudents`;
CREATE TABLE IF NOT EXISTS `tblstudents` (
  `StudentId` int(11) NOT NULL AUTO_INCREMENT,
  `StudentName` varchar(100) NOT NULL,
  `RollId` varchar(100) NOT NULL,
  `StudentEmail` varchar(100) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `DOB` varchar(100) NOT NULL,
  `ClassId` int(11) NOT NULL,
  `RegDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `Status` int(1) NOT NULL,
  PRIMARY KEY (`StudentId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblstudents`
--

INSERT INTO `tblstudents` (`StudentId`, `StudentName`, `RollId`, `StudentEmail`, `Gender`, `DOB`, `ClassId`, `RegDate`, `UpdationDate`, `Status`) VALUES
(7, 'Cholie', '101', 'chol@gmail.com', 'Female', '2021-08-22', 3, '2021-08-23 15:14:02', NULL, 1),
(8, 'Peter', '102', 'peter@gmail.com', 'Male', '2021-08-25', 2, '2021-08-24 22:23:19', NULL, 1),
(9, 'mery', '103', 'merry@gmail.com', 'Female', '2021-08-25', 1, '2021-08-24 22:43:24', NULL, 1),
(10, 'Jamal Daniel', '1001', 'jamal@gmail.com', 'Male', '2021-08-29', 4, '2021-08-29 15:16:14', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblsubjectcombination`
--

DROP TABLE IF EXISTS `tblsubjectcombination`;
CREATE TABLE IF NOT EXISTS `tblsubjectcombination` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ClassId` int(11) NOT NULL,
  `SubjectId` int(11) NOT NULL,
  `status` int(1) DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Updationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsubjectcombination`
--

INSERT INTO `tblsubjectcombination` (`id`, `ClassId`, `SubjectId`, `status`, `CreationDate`, `Updationdate`) VALUES
(31, 3, 7, 1, '2021-08-23 15:20:03', '2021-08-23 15:20:03'),
(32, 1, 10, 1, '2021-08-24 14:46:24', '2021-08-24 14:46:24'),
(33, 2, 4, 1, '2021-08-24 15:59:18', '2021-08-24 15:59:18'),
(34, 3, 8, 1, '2021-08-24 21:59:48', '2021-08-24 21:59:48'),
(35, 3, 4, 1, '2021-08-24 22:00:12', '2021-08-24 22:00:12'),
(36, 1, 10, 0, '2021-08-24 22:21:03', '2021-08-24 22:21:03'),
(37, 1, 10, 0, '2021-08-24 22:21:09', '2021-08-24 22:21:09'),
(38, 1, 14, 0, '2021-08-24 22:22:11', '2021-08-24 22:22:11'),
(39, 2, 12, 1, '2021-08-24 22:22:19', '2021-08-24 22:22:19'),
(40, 2, 13, 1, '2021-08-24 22:22:31', '2021-08-24 22:22:31'),
(41, 2, 15, 1, '2021-08-24 22:22:38', '2021-08-24 22:22:38'),
(42, 3, 9, 1, '2021-08-27 14:24:01', '2021-08-27 14:24:01'),
(43, 3, 10, 1, '2021-08-27 14:24:09', '2021-08-27 14:24:09'),
(44, 4, 12, 1, '2021-08-29 15:17:28', '2021-08-29 15:17:28'),
(45, 4, 13, 1, '2021-08-29 15:17:35', '2021-08-29 15:17:35');

-- --------------------------------------------------------

--
-- Table structure for table `tblsubjects`
--

DROP TABLE IF EXISTS `tblsubjects`;
CREATE TABLE IF NOT EXISTS `tblsubjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `SubjectName` varchar(100) NOT NULL,
  `SubjectCode` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsubjects`
--

INSERT INTO `tblsubjects` (`id`, `SubjectName`, `SubjectCode`) VALUES
(9, 'JAVA', 'CMT211'),
(10, 'C programming', 'CMT110'),
(11, 'Operating System', 'CMT206'),
(12, 'Calculus', 'MAT200'),
(13, 'Python', 'CMT201'),
(14, 'Web Devevlopment', 'CMT209'),
(15, 'Artificial Intelligence', 'CMT208');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
