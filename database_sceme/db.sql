-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 15, 2019 at 02:04 PM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE IF NOT EXISTS `file` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `file` varchar(200) NOT NULL,
  `size` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `file` (`file`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=260 ;

-- --------------------------------------------------------

--
-- Table structure for table `keyword`
--

CREATE TABLE IF NOT EXISTS `keyword` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `word` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `word` (`word`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=128754 ;

-- --------------------------------------------------------

--
-- Table structure for table `link`
--

CREATE TABLE IF NOT EXISTS `link` (
  `keywordid` bigint(20) NOT NULL,
  `fileid` bigint(20) NOT NULL,
  UNIQUE KEY `abc` (`keywordid`,`fileid`),
  KEY `fileid` (`fileid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `link`
--
ALTER TABLE `link`
  ADD CONSTRAINT `link_ibfk_1` FOREIGN KEY (`keywordid`) REFERENCES `keyword` (`id`),
  ADD CONSTRAINT `link_ibfk_2` FOREIGN KEY (`fileid`) REFERENCES `file` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
