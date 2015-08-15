-- phpMyAdmin SQL Dump
-- version 4.1.13
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 08, 2015 at 06:52 PM
-- Server version: 5.5.38
-- PHP Version: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE IF NOT EXISTS `blogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `datetime_submitted` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `content`, `datetime_submitted`) VALUES
(1, 'blog 1', 'blog 1 content', '0000-00-00 00:00:00'),
(2, 'blog 2', 'more content', '0000-00-00 00:00:00'),
(3, 'blog 3', 'lots of content', '0000-00-00 00:00:00'),
(4, '4', 'content', '0000-00-00 00:00:00'),
(5, 'big title', 'big content', '0000-00-00 00:00:00'),
(6, 'yey', 'woop!', '0000-00-00 00:00:00'),
(7, 'all works', 'oh yeah', '0000-00-00 00:00:00'),
(8, 'new title', 'testing...', '0000-00-00 00:00:00'),
(9, 'working', 'woop woop', '0000-00-00 00:00:00'),
(11, 'new one ', 'finally', '0000-00-00 00:00:00'),
(12, 'TESTING', 'working!!!', '0000-00-00 00:00:00'),
(13, 'working', 'working here', '0000-00-00 00:00:00'),
(14, 'testing time', 'testing timeee', '2014-12-29 19:09:37'),
(15, 'hey', 'all working...', '2014-12-29 21:55:56'),
(16, 'does it all still work?', 'hope so!', '2015-01-01 22:49:21'),
(17, 'ouoin', 'ouhoij', '2015-01-05 14:02:15'),
(18, 'Bob Smith', 'heres my content', '2015-06-04 23:38:48'),
(19, 'Bob Smith', 'heres my content', '2015-06-04 23:40:03'),
(20, 'Here is my title', 'Barpedoboop!', '2015-06-04 23:43:38'),
(21, 'Here is my title', 'Barpedoboop!', '2015-06-05 00:31:10'),
(23, 'here is the title', 'changed dat content', '2015-06-06 00:00:00'),
(24, 'here is the title', 'changed dat content', '2015-06-06 17:27:28');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
