-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 09, 2013 at 05:31 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `zhuddle`
--

-- --------------------------------------------------------

--
-- Table structure for table `blabs`
--

CREATE TABLE IF NOT EXISTS `blabs` (
  `blab_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `blab_content` varchar(255) NOT NULL,
  `blab_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`blab_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comm_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_blab` int(11) NOT NULL,
  `comm_content` text NOT NULL,
  `comm_date` datetime NOT NULL,
  `sender_id` int(11) NOT NULL,
  PRIMARY KEY (`comm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customize`
--

CREATE TABLE IF NOT EXISTS `customize` (
  `id` int(11) NOT NULL,
  `bg_color` varchar(10) NOT NULL,
  `header_color` varchar(10) NOT NULL,
  `bg_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='User Customization Tools';

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `login` int(11) DEFAULT NULL,
  `logout` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Log table';

-- --------------------------------------------------------

--
-- Table structure for table `private_messages`
--

CREATE TABLE IF NOT EXISTS `private_messages` (
  `id` int(11) NOT NULL,
  `id_to` int(11) NOT NULL,
  `id_from` int(11) NOT NULL,
  `time_sent` datetime NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `open` enum('0','1') NOT NULL,
  `recipientDelete` enum('0','1') NOT NULL,
  `senderDelete` enum('0','1') NOT NULL,
  `Sstatus` varchar(50) NOT NULL,
  `Rstatus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='User Messages';

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE IF NOT EXISTS `requests` (
  `id_from` int(11) NOT NULL,
  `id_to` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Requests From Contacts';

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE IF NOT EXISTS `responses` (
  `type` varchar(50) NOT NULL,
  `response` varchar(200) NOT NULL,
  `id_from` int(11) NOT NULL,
  `id_to` int(11) NOT NULL,
  `time` datetime NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Responses From Contacts';

-- --------------------------------------------------------

--
-- Table structure for table `temp`
--

CREATE TABLE IF NOT EXISTS `temp` (
  `id` int(11) NOT NULL,
  `prev_page` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Temporary Values Table';

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `join_date` date NOT NULL,
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `state` int(11) NOT NULL,
  `profile_pic` varchar(100) NOT NULL,
  `temp_profile_pic` varchar(100) NOT NULL,
  `contact_list` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Users' AUTO_INCREMENT=1 ;

--
-- Triggers `users`
--
DROP TRIGGER IF EXISTS `test`;
DELIMITER //
CREATE TRIGGER `test` AFTER DELETE ON `users`
 FOR EACH ROW BEGIN 
DELETE FROM user_general_info where id = OLD.id;
DELETE FROM user_contact_info where email = OLD.email;
DELETE FROM user_privacy_info_contacts where id = OLD.id;
DELETE FROM user_privacy_info_everyone where id = OLD.id;
DELETE FROM user_views_info where id = OLD.id;
DELETE FROM blabs where user_id = OLD.id;
DELETE FROM comments where sender_id = OLD.id;
DELETE FROM customize where id = OLD.id;
DELETE FROM private_messages where id_to = OLD.id OR id_from = OLD.id;
DELETE FROM requests where id_to = OLD.id OR id_from = OLD.id;
DELETE FROM responses where id_to = OLD.id OR id_from = OLD.id;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_contact_info`
--

CREATE TABLE IF NOT EXISTS `user_contact_info` (
  `email` varchar(50) NOT NULL,
  `phone_no` varchar(15) DEFAULT NULL,
  `mobile_no` varchar(15) DEFAULT NULL,
  `website` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='User Contact Information';

-- --------------------------------------------------------

--
-- Table structure for table `user_general_info`
--

CREATE TABLE IF NOT EXISTS `user_general_info` (
  `id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` varchar(10) NOT NULL,
  `location_country` varchar(50) NOT NULL,
  `location_city` varchar(50) NOT NULL,
  `profession` varchar(50) NOT NULL,
  `relation` varchar(50) DEFAULT NULL,
  `about_self` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='User General Information';

-- --------------------------------------------------------

--
-- Table structure for table `user_privacy_info_contacts`
--

CREATE TABLE IF NOT EXISTS `user_privacy_info_contacts` (
  `id` int(11) NOT NULL,
  `dob_visibility` varchar(10) NOT NULL,
  `loc_visibility` varchar(10) NOT NULL,
  `prof_visibility` varchar(10) NOT NULL,
  `rel_visibility` varchar(10) NOT NULL,
  `about_self_visibility` varchar(10) NOT NULL,
  `email_visibility` varchar(10) NOT NULL COMMENT 'this is contacts.not email',
  `phone_no_visibility` varchar(10) NOT NULL,
  `mobile_no_visibility` varchar(10) NOT NULL,
  `website` varchar(10) NOT NULL,
  `full` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='User Privacy Information For Contacts';

-- --------------------------------------------------------

--
-- Table structure for table `user_privacy_info_everyone`
--

CREATE TABLE IF NOT EXISTS `user_privacy_info_everyone` (
  `id` int(11) NOT NULL,
  `dob_visibility` varchar(10) NOT NULL,
  `loc_visibility` varchar(10) NOT NULL,
  `prof_visibility` varchar(10) NOT NULL,
  `rel_visibility` varchar(10) NOT NULL,
  `about_self_visibility` varchar(10) NOT NULL,
  `email_visibility` varchar(10) NOT NULL COMMENT 'this is contacts.not email',
  `phone_no_visibility` varchar(10) NOT NULL,
  `mobile_no_visibility` varchar(10) NOT NULL,
  `website` varchar(10) NOT NULL,
  `full` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='User Privacy Information For Everyone';

-- --------------------------------------------------------

--
-- Table structure for table `user_views_info`
--

CREATE TABLE IF NOT EXISTS `user_views_info` (
  `id` int(11) NOT NULL,
  `personal_view` varchar(200) NOT NULL,
  `social_view` varchar(200) NOT NULL,
  `cultural_view` varchar(200) NOT NULL,
  `political_view` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='User Views Information';

-- --------------------------------------------------------

--
-- Table structure for table `verify`
--

CREATE TABLE IF NOT EXISTS `verify` (
  `email` varchar(100) NOT NULL,
  `verification_code` varchar(100) NOT NULL,
  `state` int(11) NOT NULL,
  `temp_password` varchar(10) NOT NULL,
  `num_times` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
