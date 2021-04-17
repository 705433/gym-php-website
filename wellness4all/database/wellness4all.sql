-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2021 at 06:04 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wellness4all`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `ActivityId` mediumint(9) NOT NULL,
  `ActivityName` varchar(255) NOT NULL,
  `ActivityType` varchar(255) NOT NULL,
  `ActivityLocation` varchar(255) NOT NULL,
  `DateOfTheActivity` date NOT NULL,
  `TimeOfTheActivity` time NOT NULL,
  `ActivityPrice` varchar(255) NOT NULL,
  `ActivityDescription` varchar(255) NOT NULL,
  `ActivityImage` varchar(255) NOT NULL,
  `LastUpdated` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` mediumint(9) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `BookingId` mediumint(9) NOT NULL,
  `ActivityId` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `BookedOn` date NOT NULL,
  `Status` varchar(255) NOT NULL,
  `CancelledBy` varchar(255) DEFAULT NULL,
  `LastUdpate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `Serial` int(11) NOT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Message` varchar(255) NOT NULL,
  `SentOn` date NOT NULL DEFAULT current_timestamp(),
  `Reply` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- --------------------------------------------------------

--
-- Table structure for table `personal`
--

CREATE TABLE `personal` (
  `PersonalTrainingId` int(11) NOT NULL,
  `PersonalTrainingName` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `DaysOfTheWeek` varchar(255) NOT NULL,
  `Time` varchar(255) NOT NULL,
  `LengthOfSession` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `MonthlyFee` varchar(255) NOT NULL,
  `LastUdpate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `personal_bookings`
--

CREATE TABLE `personal_bookings` (
  `BookingId` int(11) NOT NULL,
  `PersonalTrainingId` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `BookedOn` date NOT NULL,
  `Status` varchar(255) NOT NULL,
  `MonthlyFee` varchar(255) NOT NULL,
  `Payment` varchar(255) NOT NULL,
  `CancelledBy` varchar(255) DEFAULT NULL,
  `LastUdpate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `usertable`
--

CREATE TABLE `usertable` (
  `customername` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`ActivityId`),
  ADD UNIQUE KEY `ActivityId` (`ActivityId`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_id` (`admin_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`BookingId`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD UNIQUE KEY `Serial` (`Serial`);

--
-- Indexes for table `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`PersonalTrainingId`),
  ADD UNIQUE KEY `PersonalTrainingId` (`PersonalTrainingId`);

--
-- Indexes for table `personal_bookings`
--
ALTER TABLE `personal_bookings`
  ADD PRIMARY KEY (`BookingId`),
  ADD UNIQUE KEY `BookingId` (`BookingId`);

--
-- Indexes for table `usertable`
--
ALTER TABLE `usertable`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `ActivityId` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `BookingId` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `Serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `personal`
--
ALTER TABLE `personal`
  MODIFY `PersonalTrainingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_bookings`
--
ALTER TABLE `personal_bookings`
  MODIFY `BookingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
