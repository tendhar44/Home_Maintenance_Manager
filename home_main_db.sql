-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2018 at 09:33 PM
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
  `logDelete` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appliances`
--

INSERT INTO `appliances` (`applianceId`, `applianceName`, `logDelete`) VALUES
(1, 'Kitchen Sink', 0);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `groupId` int(11) NOT NULL,
  `groupOwnerId` int(11) NOT NULL,
  `groupName` varchar(100) DEFAULT NULL,
  `logDelete` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `imageobjectbridge`
--

CREATE TABLE `imageobjectbridge` (
  `imageId` int(11) NOT NULL,
  `objectId` int(11) NOT NULL,
  `objectType` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imageId` int(11) NOT NULL,
  `imageFile` mediumblob NOT NULL,
  `alternateText` varchar(255) DEFAULT NULL,
  `logDelete` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `propertyId` int(11) NOT NULL,
  `ownerid` int(11) NOT NULL,
  `propertyName` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `logDelete` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`propertyId`, `ownerid`, `propertyName`, `description`, `address`, `logDelete`) VALUES
(1, 11, 'Tenzins House', 'Orange house', '2323st ave ne', 0),
(2, 11, 'test344', 'idjsfjs', '343st ave', 1);

-- --------------------------------------------------------

--
-- Table structure for table `propertyappliancebridge`
--

CREATE TABLE `propertyappliancebridge` (
  `propertyApplianceId` int(11) NOT NULL,
  `propertyId` int(11) NOT NULL,
  `applianceId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `propertyappliancebridge`
--

INSERT INTO `propertyappliancebridge` (`propertyApplianceId`, `propertyId`, `applianceId`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `propertygroupbridge`
--

CREATE TABLE `propertygroupbridge` (
  `groupId` int(11) NOT NULL,
  `propertyId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `taskhistory`
--

CREATE TABLE `taskhistory` (
  `taskId` int(11) NOT NULL,
  `taskSequence` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `taskId` int(11) NOT NULL,
  `propertyApplianceId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `taskName` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `repeatTask` tinyint(1) DEFAULT NULL,
  `dueDate` date DEFAULT NULL,
  `Complete` tinyint(1) DEFAULT NULL,
  `intervalDays` int(11) DEFAULT NULL,
  `ReminderDate` date DEFAULT NULL,
  `reminderInterval` int(11) DEFAULT NULL,
  `logDelete` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`taskId`, `propertyApplianceId`, `userId`, `taskName`, `description`, `repeatTask`, `dueDate`, `Complete`, `intervalDays`, `ReminderDate`, `reminderInterval`, `logDelete`) VALUES
(1, 1, 11, 'clean the kitchen sink', 'fafwafafafafdsfeeeex edwdw', 0, '2018-03-28', 0, 1, '2018-03-26', 1, 0),
(2, 1, 11, 'test98', 'sdfdsfsdfsfsf', 0, '2018-03-24', 0, 1, '2018-03-25', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `usergroupbridge`
--

CREATE TABLE `usergroupbridge` (
  `userId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userTypeId` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `passWord` varchar(255) DEFAULT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `logDelete` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userTypeId`, `userName`, `passWord`, `firstName`, `lastName`, `email`, `logDelete`) VALUES
(11, 1, 'tenzin44', '11111', 'Tenzin', 'Dhargye', 'tendhar44@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE `usertype` (
  `userTypeId` int(11) NOT NULL,
  `userTypeDescription` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`userTypeId`, `userTypeDescription`) VALUES
(1, 'property owner');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appliances`
--
ALTER TABLE `appliances`
  ADD PRIMARY KEY (`applianceId`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`groupId`),
  ADD KEY `groupOwnerId` (`groupOwnerId`);

--
-- Indexes for table `imageobjectbridge`
--
ALTER TABLE `imageobjectbridge`
  ADD KEY `imageId` (`imageId`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imageId`);

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
  ADD PRIMARY KEY (`propertyApplianceId`),
  ADD KEY `propertyId` (`propertyId`),
  ADD KEY `applianceId` (`applianceId`);

--
-- Indexes for table `propertygroupbridge`
--
ALTER TABLE `propertygroupbridge`
  ADD KEY `groupId` (`groupId`),
  ADD KEY `propertyId` (`propertyId`);

--
-- Indexes for table `taskhistory`
--
ALTER TABLE `taskhistory`
  ADD PRIMARY KEY (`taskId`,`taskSequence`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`taskId`),
  ADD KEY `propertyApplianceId` (`propertyApplianceId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `usergroupbridge`
--
ALTER TABLE `usergroupbridge`
  ADD KEY `userId` (`userId`),
  ADD KEY `groupId` (`groupId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userName` (`userName`),
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
  MODIFY `applianceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `groupId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imageId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `propertyId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `propertyappliancebridge`
--
ALTER TABLE `propertyappliancebridge`
  MODIFY `propertyApplianceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `taskId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `usertype`
--
ALTER TABLE `usertype`
  MODIFY `userTypeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`groupOwnerId`) REFERENCES `users` (`userId`);

--
-- Constraints for table `imageobjectbridge`
--
ALTER TABLE `imageobjectbridge`
  ADD CONSTRAINT `imageobjectbridge_ibfk_1` FOREIGN KEY (`imageId`) REFERENCES `images` (`imageId`);

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
-- Constraints for table `propertygroupbridge`
--
ALTER TABLE `propertygroupbridge`
  ADD CONSTRAINT `propertygroupbridge_ibfk_1` FOREIGN KEY (`groupId`) REFERENCES `groups` (`groupId`),
  ADD CONSTRAINT `propertygroupbridge_ibfk_2` FOREIGN KEY (`propertyId`) REFERENCES `properties` (`propertyId`);

--
-- Constraints for table `taskhistory`
--
ALTER TABLE `taskhistory`
  ADD CONSTRAINT `taskhistory_ibfk_1` FOREIGN KEY (`taskId`) REFERENCES `tasks` (`taskId`),
  ADD CONSTRAINT `taskhistory_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userId`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`propertyApplianceId`) REFERENCES `propertyappliancebridge` (`propertyApplianceId`),
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

--
-- Constraints for table `usergroupbridge`
--
ALTER TABLE `usergroupbridge`
  ADD CONSTRAINT `usergroupbridge_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`),
  ADD CONSTRAINT `usergroupbridge_ibfk_2` FOREIGN KEY (`groupId`) REFERENCES `groups` (`groupId`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`userTypeId`) REFERENCES `usertype` (`userTypeId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
