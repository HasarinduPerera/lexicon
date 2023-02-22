-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 09, 2023 at 09:50 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lex`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adID` char(7) NOT NULL,
  `adPassword` varchar(75) NOT NULL,
  `usertype` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adID`, `adPassword`, `usertype`) VALUES
('ADM0001', '21232f297a57a5a743894a0e4a801fc3', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `cID` char(7) NOT NULL,
  `cName` varchar(75) NOT NULL,
  `category` varchar(15) NOT NULL,
  `cDesc` text NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `lecAssigned` char(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`cID`, `cName`, `category`, `cDesc`, `startDate`, `endDate`, `lecAssigned`) VALUES
('MIT0001', 'Introduction to Computing', 'Technology', 'This course introduces the fundamentals of computer science and computing. The topics covered include data representation and manipulation, algorithms, programming languages, operating systems, computer networks, and systems security.', '2023-04-21', '2023-05-21', 'LEC0002'),
('MIT0002', 'Discrete Structures', 'Mathematics', 'This course introduces the fundamentals of discrete mathematics. The topics covered include logic, set theory, functions, relations, graph theory, counting techniques, and probability.', '2023-04-30', '2023-05-28', 'LEC0004'),
('MIT0003', 'Data Structures and Algorithms', 'Technology', 'This course introduces the fundamentals of data structures and algorithms. The topics covered include linear and non-linear data structures, sorting and searching algorithms, algorithm design techniques, and complexity analysis.', '2023-05-07', '2023-06-17', 'LEC0005'),
('MIT0004', 'Computer Architecture and Organization', 'Technology', 'This course introduces the fundamentals of computer architecture and organization. The topics covered include the Von Neumann architecture, memory hierarchy, input/output devices, instruction set architecture, and processor design.', '2023-04-22', '2023-06-03', 'LEC0003'),
('MIT0005', 'Software Engineering', 'Technology', 'This course introduces the fundamentals of software engineering. The topics covered include software development models, system analysis and design, software testing and verification, and software project management.', '2023-04-15', '2023-04-30', 'LEC0002');

-- --------------------------------------------------------

--
-- Table structure for table `course-enrolled`
--

CREATE TABLE `course-enrolled` (
  `courseID` char(7) NOT NULL,
  `studID` char(7) NOT NULL,
  `lect1` tinyint(1) NOT NULL,
  `lect2` tinyint(1) NOT NULL,
  `lect3` tinyint(1) NOT NULL,
  `lect4` tinyint(1) NOT NULL,
  `lect5` tinyint(1) NOT NULL,
  `asn1` tinyint(1) NOT NULL,
  `asn2` double NOT NULL,
  `totalAttend` double NOT NULL,
  `courseMark` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course-enrolled`
--

INSERT INTO `course-enrolled` (`courseID`, `studID`, `lect1`, `lect2`, `lect3`, `lect4`, `lect5`, `asn1`, `asn2`, `totalAttend`, `courseMark`) VALUES
('MIT0002', 'STU0002', 0, 0, 0, 0, 0, 0, 0, 0, 0),
('MIT0002', 'STU0003', 0, 0, 0, 0, 0, 0, 0, 0, 0),
('MIT0003', 'STU0002', 0, 0, 0, 0, 0, 0, 0, 0, 0),
('MIT0004', 'STU0003', 0, 0, 0, 0, 0, 0, 0, 0, 0),
('MIT0006', 'STU0001', 1, 0, 1, 1, 0, 40, 30, 60, 68),
('MIT0006', 'STU0002', 1, 1, 1, 1, 1, 30, 38, 100, 74.4),
('MIT0006', 'STU0005', 1, 0, 0, 1, 0, 0, 10, 40, 16);

-- --------------------------------------------------------

--
-- Table structure for table `emaillist`
--

CREATE TABLE `emaillist` (
  `email_address` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

CREATE TABLE `lecturer` (
  `lecID` char(7) NOT NULL,
  `lecName` varchar(75) NOT NULL,
  `lecPassword` varchar(75) NOT NULL,
  `lecEmail` varchar(75) NOT NULL,
  `usertype` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`lecID`, `lecName`, `lecPassword`, `lecEmail`, `usertype`) VALUES
('LEC0001', 'Sabraz Nawaz', '202cb962ac59075b964b07152d234b70', 'sana@gmail.com', 'lecturer'),
('LEC0002', 'Kumari Jayawardena', '202cb962ac59075b964b07152d234b70', 'kumarij@gmail.com', 'lecturer'),
('LEC0003', 'Dr Sarath Weerasekara', '827ccb0eea8a706c4c34a16891f84e7b', 'sarathw@gmail.com', 'lecturer'),
('LEC0004', 'Lalitha Perera', '202cb962ac59075b964b07152d234b70', 'lalithap@gmail.com', 'lecturer'),
('LEC0005', 'Manohara de Silva', '202cb962ac59075b964b07152d234b70', 'manohara@gmail.com', 'lecturer');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `sID` char(7) NOT NULL,
  `sName` varchar(75) NOT NULL,
  `sPassword` varchar(75) NOT NULL,
  `sEmail` varchar(75) NOT NULL,
  `sDOB` date NOT NULL,
  `usertype` varchar(8) NOT NULL DEFAULT 'student',
  `status` varchar(10) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`sID`, `sName`, `sPassword`, `sEmail`, `sDOB`, `usertype`, `status`) VALUES
('STU0001', 'Ranjan Jayawardena', '202cb962ac59075b964b07152d234b70', 'ranjanj@gmail.com', '1997-07-03', 'student', 'active'),
('STU0002', 'Nirmala de Silva', '202cb962ac59075b964b07152d234b70', 'nirmalads@gmail.com', '1994-04-28', 'student', 'active'),
('STU0003', 'Nimal Fernando', '202cb962ac59075b964b07152d234b70', 'nimal@gmail.com', '1992-04-16', 'student', 'active'),
('STU0005', 'Rajitha Bandara', '202cb962ac59075b964b07152d234b70', 'rajitha@gmail.com', '1994-05-24', 'student', 'active'),
('STU0007', 'Kusal Perera', '202cb962ac59075b964b07152d234b70', 'kusalp@gmail.com', '2005-02-24', 'student', 'pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`cID`),
  ADD KEY `fk_lecturer` (`lecAssigned`);

--
-- Indexes for table `course-enrolled`
--
ALTER TABLE `course-enrolled`
  ADD PRIMARY KEY (`courseID`,`studID`),
  ADD KEY `fk_studentid` (`studID`);

--
-- Indexes for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD PRIMARY KEY (`lecID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`sID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `fk_lecturer` FOREIGN KEY (`lecAssigned`) REFERENCES `lecturer` (`lecID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
