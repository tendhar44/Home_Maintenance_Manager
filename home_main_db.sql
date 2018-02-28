-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2018 at 10:53 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `home_main_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `appliances`
--

CREATE TABLE `appliances` (
  `applianceId` int(11) NOT NULL,
  `applianceName` varchar(255) DEFAULT NULL,
  `model` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appliances`
--

INSERT INTO `appliances` (`applianceId`, `applianceName`, `model`) VALUES
(1, 'my car', 'ry43'),
(2, 'Washing Machine', 'tt32'),
(3, 'Stove', 'edd32'),
(4, 'tv set', ''),
(5, 'test3', 'rtt5');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `propertyId` int(11) NOT NULL,
  `ownerid` int(11) NOT NULL,
  `propertyName` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`propertyId`, `ownerid`, `propertyName`, `description`, `address`) VALUES
(4, 1, 'my house', '3223st ave ne', '3223st ave sw'),
(5, 1, 'tenzins house', 'black house', '232st ave se'),
(6, 1, 'Vacation House', 'big house', '2342st ave se');

-- --------------------------------------------------------

--
-- Table structure for table `propertyappliancebridge`
--

CREATE TABLE `propertyappliancebridge` (
  `propertyId` int(11) NOT NULL,
  `applianceId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `propertyappliancebridge`
--

INSERT INTO `propertyappliancebridge` (`propertyId`, `applianceId`) VALUES
(4, 1),
(5, 2),
(6, 3),
(5, 4),
(4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `taskId` int(11) NOT NULL,
  `applianceId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `taskName` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `repeatTask` tinyint(1) DEFAULT NULL,
  `dueDate` date DEFAULT NULL,
  `Complete` tinyint(1) DEFAULT NULL,
  `intervalDays` int(11) DEFAULT NULL,
  `firstReminderDate` date DEFAULT NULL,
  `reminderInterval` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`taskId`, `applianceId`, `userId`, `taskName`, `description`, `repeatTask`, `dueDate`, `Complete`, `intervalDays`, `firstReminderDate`, `reminderInterval`) VALUES
(5, 1, 1, 'fix the car radio', 'black radio', 0, '2018-02-28', 0, 2, '2018-02-27', 1),
(8, 3, 1, 'fix the stove', 'dwfew', 0, '2018-02-28', 0, 1, '2018-02-27', 1),
(9, 3, 1, 'fix left stove', 'wdewfw', 0, '2018-02-28', 0, 1, '2018-02-27', 1),
(10, 3, 1, 'fix the right stove', 'fsafs', 0, '2018-02-28', 0, 1, '2018-02-27', 1),
(11, 1, 1, 'fix the red car', 'fsadfasf', 0, '2018-02-28', 0, 1, '2018-02-28', 1),
(12, 1, 1, 'fix blue car', 'dgsdgsd', 0, '2018-02-28', 0, 1, '2018-02-28', 1),
(15, 2, 1, 'fix the washer', 'sdsfsd', 0, '2018-02-28', 0, 1, '2018-02-28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userTypeId` int(11) NOT NULL,
  `userName` varchar(255) DEFAULT NULL,
  `passWord` varchar(255) DEFAULT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userTypeId`, `userName`, `passWord`, `firstName`, `lastName`, `email`) VALUES
(1, 0, 'tenzin44', '11111', 'Tenzin', 'Dhargye', 'tendhar44@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE `usertype` (
  `userTypeId` int(11) NOT NULL,
  `userTypeDescription` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appliances`
--
ALTER TABLE `appliances`
  ADD PRIMARY KEY (`applianceId`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`propertyId`),
  ADD KEY `ownerid` (`ownerid`);

--
-- Indexes for table `propertyappliancebridge`
--
ALTER TABLE `propertyappliancebridge`
  ADD KEY `propertyId` (`propertyId`),
  ADD KEY `applianceId` (`applianceId`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`taskId`),
  ADD KEY `applianceId` (`applianceId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD KEY `userTypeId` (`userTypeId`);

--
-- Indexes for table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`userTypeId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appliances`
--
ALTER TABLE `appliances`
  MODIFY `applianceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `propertyId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `taskId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `usertype`
--
ALTER TABLE `usertype`
  MODIFY `userTypeId` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_ibfk_1` FOREIGN KEY (`ownerid`) REFERENCES `users` (`userId`);

--
-- Constraints for table `propertyappliancebridge`
--
ALTER TABLE `propertyappliancebridge`
  ADD CONSTRAINT `propertyappliancebridge_ibfk_1` FOREIGN KEY (`propertyId`) REFERENCES `properties` (`propertyId`),
  ADD CONSTRAINT `propertyappliancebridge_ibfk_2` FOREIGN KEY (`applianceId`) REFERENCES `appliances` (`applianceId`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`applianceId`) REFERENCES `appliances` (`applianceId`),
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
