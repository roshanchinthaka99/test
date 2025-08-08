-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 20, 2025 at 12:04 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `care compass hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
CREATE TABLE IF NOT EXISTS `appointments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patientID` varchar(150) NOT NULL,
  `doctorID` varchar(150) NOT NULL,
  `qualification` text NOT NULL,
  `date` date NOT NULL,
  `contact` varchar(15) NOT NULL,
  `time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `patientID`, `doctorID`, `qualification`, `date`, `contact`, `time`) VALUES
(1, 'P001', 'D001', 'MBBS, MS (General Surgery)', '2025-03-29', '0112458460', '09:12:00');

-- --------------------------------------------------------

--
-- Table structure for table `doctordetails`
--

DROP TABLE IF EXISTS `doctordetails`;
CREATE TABLE IF NOT EXISTS `doctordetails` (
  `firstname` varchar(150) NOT NULL,
  `lastname` varchar(150) NOT NULL,
  `doctorID` varchar(150) NOT NULL,
  `qualification` varchar(150) NOT NULL,
  `password` int(150) NOT NULL,
  PRIMARY KEY (`doctorID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctordetails`
--

INSERT INTO `doctordetails` (`firstname`, `lastname`, `doctorID`, `qualification`, `password`) VALUES
('Shaminda', 'Fernando', 'D001', 'MBBS, MS (General Surgery)', 1000),
('test', 'test', 'D002', 'test', 1001);

-- --------------------------------------------------------

--
-- Table structure for table `doctorschedule`
--

DROP TABLE IF EXISTS `doctorschedule`;
CREATE TABLE IF NOT EXISTS `doctorschedule` (
  `doctorID` varchar(150) NOT NULL,
  `location` varchar(150) NOT NULL,
  `date` date NOT NULL,
  `time` time(6) NOT NULL DEFAULT current_timestamp(),
  `number` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctorschedule`
--

INSERT INTO `doctorschedule` (`doctorID`, `location`, `date`, `time`, `number`) VALUES
('D001', 'Kurunegala', '2025-03-29', '09:12:00.000000', '0447895879'),
('D002', 'Colombo', '2025-03-06', '09:23:00.000000', '0721548754'),
('D003', 'Kandy', '2025-03-29', '09:34:00.000000', '0728574931'),
('D004', 'Colombo', '2025-03-28', '12:30:00.000000', '0775418756');

-- --------------------------------------------------------

--
-- Table structure for table `patientdetails`
--

DROP TABLE IF EXISTS `patientdetails`;
CREATE TABLE IF NOT EXISTS `patientdetails` (
  `firstname` varchar(150) NOT NULL,
  `lastname` varchar(150) NOT NULL,
  `patientID` varchar(150) NOT NULL,
  `password` int(150) NOT NULL,
  PRIMARY KEY (`patientID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patientdetails`
--

INSERT INTO `patientdetails` (`firstname`, `lastname`, `patientID`, `password`) VALUES
('Nihal', 'Chandrasiri', 'P001', 100),
('Dulara', 'Sandamal', 'P002', 101);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patientID` int(11) NOT NULL,
  `appointmentID` int(11) NOT NULL,
  `totalamount` decimal(10,2) NOT NULL,
  `paymentstatus` enum('Pending','Paid') DEFAULT 'Pending',
  `paymentdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `paymentmethod` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patientID` (`patientID`),
  KEY `appointmentID` (`appointmentID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `patientID`, `appointmentID`, `totalamount`, `paymentstatus`, `paymentdate`, `paymentmethod`) VALUES
(1, 0, 1, '3450.00', 'Paid', '2025-03-16 15:08:17', 'Online');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `serviceID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`serviceID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`serviceID`, `name`, `description`, `price`) VALUES
(1, 'MRI Scan', 'Detailed imaging of body organs', '15000.00');

-- --------------------------------------------------------

--
-- Table structure for table `staffdetails`
--

DROP TABLE IF EXISTS `staffdetails`;
CREATE TABLE IF NOT EXISTS `staffdetails` (
  `firstname` varchar(150) NOT NULL,
  `lastname` varchar(150) NOT NULL,
  `staffID` varchar(150) NOT NULL,
  `phonenumber` varchar(10) NOT NULL,
  `password` int(10) NOT NULL,
  PRIMARY KEY (`staffID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staffdetails`
--

INSERT INTO `staffdetails` (`firstname`, `lastname`, `staffID`, `phonenumber`, `password`) VALUES
('Chandana', 'Rookantha ', 'S001', '0112415132', 500);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
