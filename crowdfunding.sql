-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2016 at 10:47 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crowdfunding`
--

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

DROP TABLE IF EXISTS `campaigns`;
CREATE TABLE `campaigns` (
  `CampaignId` int(11) NOT NULL,
  `ProjectId` int(11) NOT NULL,
  `StartDate` datetime NOT NULL,
  `EndDate` datetime NOT NULL,
  `Description` varchar(10000) NOT NULL,
  `StatusId` int(11) NOT NULL,
  `Amount` decimal(2,1) NOT NULL,
  `Current` decimal(2,1) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateModified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `campaign_statuses`
--

DROP TABLE IF EXISTS `campaign_statuses`;
CREATE TABLE `campaign_statuses` (
  `CampaignStatusId` int(11) NOT NULL,
  `Title` varchar(125) NOT NULL,
  `DateModified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `campaign_statuses`
--

TRUNCATE TABLE `campaign_statuses`;
--
-- Dumping data for table `campaign_statuses`
--

INSERT INTO `campaign_statuses` (`CampaignStatusId`, `Title`, `DateModified`, `DateCreated`) VALUES
(1, 'Active', '2016-10-26 00:31:40', '2016-10-26 00:31:40'),
(2, 'Clsoed', '2016-10-26 00:31:40', '2016-10-26 00:31:40'),
(3, 'Extended', '2016-10-26 00:32:17', '2016-10-26 00:32:17'),
(4, 'Cancelled', '2016-10-26 00:32:17', '2016-10-26 00:32:17');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `CategoryId` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateModified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `categories`
--

TRUNCATE TABLE `categories`;
--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`CategoryId`, `Title`, `DateCreated`, `DateModified`) VALUES
(1, 'Entreprenurial', '2016-10-08 20:49:30', '2016-10-08 20:49:30'),
(2, 'Social', '2016-10-08 20:49:30', '2016-10-08 20:49:30'),
(3, 'Educational', '2016-10-08 20:49:52', '2016-10-08 20:49:52');

-- --------------------------------------------------------

--
-- Table structure for table `funders`
--

DROP TABLE IF EXISTS `funders`;
CREATE TABLE `funders` (
  `Id` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Id_Number` varchar(50) NOT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Description` varchar(10000) DEFAULT NULL,
  `Profile_Pic` varchar(10000) DEFAULT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateAdded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `groups`
--

TRUNCATE TABLE `groups`;
--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User'),
(3, 'Project', 'Project owners'),
(4, 'Funders', 'Project Funders');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `login_attempts`
--

TRUNCATE TABLE `login_attempts`;
-- --------------------------------------------------------

--
-- Table structure for table `pledges`
--

DROP TABLE IF EXISTS `pledges`;
CREATE TABLE `pledges` (
  `Id` int(11) NOT NULL,
  `CampaignId` int(11) NOT NULL,
  `FunderId` int(11) NOT NULL,
  `Amount` decimal(8,2) NOT NULL,
  `Paid` tinyint(1) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateModified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects` (
  `ProjectId` int(11) UNSIGNED NOT NULL,
  `UserId` int(11) UNSIGNED NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Description` varchar(10000) NOT NULL,
  `ProfilePic` varchar(200) NOT NULL,
  `CategoryId` int(11) NOT NULL,
  `Video` varchar(200) NOT NULL,
  `Business_Plan` varchar(100) DEFAULT NULL,
  `Address` varchar(100) NOT NULL,
  `Telephone` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Facebook` varchar(100) DEFAULT NULL,
  `Active` tinyint(1) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateModified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `users`
--

TRUNCATE TABLE `users`;
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$08$nNnZA0IawBbJtLlKPHYuuOAqIdnxGkquZ//1hljSwCjtuz3.tk5dm', '', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1476207231, 1, 'Anton', 'Lungameni', 'RLabs Namibia', '0818935632'),
(2, '::1', 'kevin@gmail.com', '$2y$08$736GrWVlDq9O8Ei0DURjcOm8FAGujFREzyxw.4ORMpzq61oX8FW/y', NULL, 'kevin@gmail.com', NULL, NULL, NULL, NULL, 1476208115, 1478771039, 1, 'Kevin', 'Manager', 'NUST', '081258368'),
(3, '::1', 'ndelitunga.l@gmail.com', '$2y$08$b7fi6b5q1zx.zyfU0ueLmu4Sy31mhk/3eYbZHdF3l6DQ1lw2nUOHG', NULL, 'ndelitunga.l@gmail.com', NULL, NULL, NULL, NULL, 1477557878, 1478770392, 1, 'Anton ', 'Lungameni', 'NUST', '0818935632');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

DROP TABLE IF EXISTS `users_groups`;
CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `users_groups`
--

TRUNCATE TABLE `users_groups`;
--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(18, 1, 1),
(19, 1, 2),
(20, 2, 2),
(24, 2, 3),
(27, 2, 4),
(25, 3, 2),
(26, 3, 3),
(28, 3, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`CampaignId`),
  ADD KEY `ProjectId` (`ProjectId`),
  ADD KEY `StatusId` (`StatusId`);

--
-- Indexes for table `campaign_statuses`
--
ALTER TABLE `campaign_statuses`
  ADD PRIMARY KEY (`CampaignStatusId`),
  ADD UNIQUE KEY `Title` (`Title`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CategoryId`),
  ADD UNIQUE KEY `Title` (`Title`);

--
-- Indexes for table `funders`
--
ALTER TABLE `funders`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Id_Number` (`Id_Number`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pledges`
--
ALTER TABLE `pledges`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `CampaignId` (`CampaignId`),
  ADD KEY `FunderId` (`FunderId`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`ProjectId`),
  ADD UNIQUE KEY `Title` (`Title`),
  ADD UNIQUE KEY `ProfilePic` (`ProfilePic`),
  ADD UNIQUE KEY `Video` (`Video`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `UserId` (`UserId`),
  ADD KEY `CategoryId` (`CategoryId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `CampaignId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `campaign_statuses`
--
ALTER TABLE `campaign_statuses`
  MODIFY `CampaignStatusId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `CategoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `funders`
--
ALTER TABLE `funders`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pledges`
--
ALTER TABLE `pledges`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `ProjectId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `projects_ibfk_2` FOREIGN KEY (`CategoryId`) REFERENCES `categories` (`CategoryId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
