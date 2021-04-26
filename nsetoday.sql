-- phpMyAdmin SQL Dump
-- version 3.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 20, 2011 at 08:27 AM
-- Server version: 5.0.51
-- PHP Version: 5.2.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nseinvoice`
--

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE IF NOT EXISTS `cards` (
  `ID` int(10) NOT NULL auto_increment,
  `cardnumber` varchar(50) NOT NULL default 'None',
  `clientjobnumber` varchar(30) NOT NULL default 'None',
  `carddate` date NOT NULL,
  `companyid` int(10) NOT NULL,
  `carnum` varchar(10) NOT NULL,
  `partnumber` varchar(50) NOT NULL,
  `modelnumber` varchar(50) NOT NULL,
  `serialnumber` varchar(50) NOT NULL,
  `customertype` varchar(50) NOT NULL,
  `receivedby` varchar(40) NOT NULL default 'mehfooz',
  `customercomplaint` text NOT NULL,
  `includedaccess` text NOT NULL,
  `otherremarks` text NOT NULL,
  `cardstatus` varchar(10) NOT NULL default 'del',
  `totamount` float(10,2) NOT NULL,
  `paid` varchar(3) NOT NULL default 'NO',
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`ID`, `cardnumber`, `clientjobnumber`, `carddate`, `companyid`, `carnum`, `partnumber`, `modelnumber`, `serialnumber`, `customertype`, `receivedby`, `customercomplaint`, `includedaccess`, `otherremarks`, `cardstatus`, `totamount`, `paid`) VALUES
(25, 'ADAR/', '23409234', '2011-11-19', 1, '2340923', '23429304', '30932', '23490', 'Cash', 'Faizan', 'None', '', '', '', 0.00, 'NO'),
(26, 'ADAR/25', '23409234', '2011-11-19', 1, '2340923', '23429304', '30932', '23490', 'Cash', 'Faizan', 'None', '', '', 'inv', 0.00, 'NO'),
(27, 'ADAR/26', '23409234', '2011-11-19', 1, '2340923', '23429304', '30932', '23490', 'Cash', 'Faizan', 'None', '', '', 'inv', 0.00, 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `companyid` int(10) NOT NULL auto_increment,
  `companyname` varchar(200) NOT NULL,
  `companycode` varchar(100) NOT NULL,
  `companybranch` varchar(100) NOT NULL,
  `contactperson` varchar(100) NOT NULL,
  `mobile` varchar(30) NOT NULL,
  `telephone` varchar(30) NOT NULL,
  `fax` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  PRIMARY KEY  (`companyid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`companyid`, `companyname`, `companycode`, `companybranch`, `contactperson`, `mobile`, `telephone`, `fax`, `email`) VALUES
(1, 'Al Futtaim Motors', 'ADAR', 'ABU DHABI AIRPORT ROAD', 'MARCELO/VASANT ', '', '+971 2 419 9800', '+971 2 419 9801', ''),
(2, 'Al Futtaim Motors', 'MSF', 'MUSAFFAH ABU DHABI', 'ALTAF / NAWEEN', '', '+971 2 555 4464', '+971 2 554 1979', ''),
(3, 'Al Futtaim Motors', 'MSF2', 'MUSAFFAH 2 ABU DHABI', 'MUTTAHIR PASHA', '', '+971 2 659 3777', '+971 2 659 3665', ''),
(4, 'Al Futtaim Motors', 'AJN', 'AJMAN', 'INTEKHAB ALAM', '', '+971 6 711 3111', '', ''),
(5, 'Al Futtaim Motors', 'ALN', 'AL AIN', 'MASOOD AHMED', '', '+971 3 721 2838', '971 3 721 2582', ''),
(6, 'Al Futtaim Motors', 'LXSZ', 'LEXUS (SZEIKH ZAYED ROAD)', 'JAYSON QUILALA', '', '+971 4 407 0400', '+971 4 338 6667', ''),
(7, 'Al Futtaim Motors', 'FUJ', 'FUJAIRAH', 'TARIQ KHAN', '', '+971 9 222 7157', '+971 9 222 9157', ''),
(8, 'Al Futtaim Motors', 'KHOR', 'KHORFAKKAN', 'SHABAR KAPADIA', '', '+971 9 238 6023', '+971 9 238 6024', ''),
(9, 'Al Futtaim Motors', 'RAK', 'RAS AL KHAIMAH', 'PRAMOD', '', '+971 7 235 1812', '+971 7 235 1549', ''),
(10, 'Al Futtaim Motors', 'RAML', 'RAMOUL (DUBAI)', 'SAYED QAZIM', '', '+971 4 286 2000', '+971 4 285 7590', ''),
(11, 'Al Futtaim Motors', 'SHJ', 'SHARJAH', 'DEMOLO/JAMIL TAYER', '', '+971 6 539 7222', '+971 6 532 1411', ''),
(12, 'Al Futtaim Motors', 'UAQ', 'UMM AL-QUWAIN', 'VINOD JENTLY', '', '+971 6 766 0195', '+971 6 766 0194', '');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE IF NOT EXISTS `delivery` (
  `delid` int(10) NOT NULL auto_increment,
  `delnum` varchar(20) NOT NULL,
  `cardid` int(10) NOT NULL,
  `deldate` date NOT NULL,
  PRIMARY KEY  (`delid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `delivery`
--


-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `invoiceid` int(10) NOT NULL auto_increment,
  `invoicenumber` varchar(40) NOT NULL,
  `invoice_date` date NOT NULL,
  `card_id` int(10) NOT NULL,
  `totalamount` float(10,2) NOT NULL,
  PRIMARY KEY  (`invoiceid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `invoice`
--


-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` int(5) NOT NULL auto_increment,
  `mail` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `mail`, `username`, `password`) VALUES
(1, 'mehfooz@gmail.com', 'mehfooz', 'mehfooz050'),
(2, 'faizan@gmail.com', 'faizan', 'faizan050');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `serviceid` int(10) NOT NULL auto_increment,
  `cardid` int(10) NOT NULL,
  `qty` int(10) NOT NULL,
  `description` varchar(200) NOT NULL,
  `unitprice` float(10,2) NOT NULL,
  `linetotal` float(10,2) NOT NULL,
  PRIMARY KEY  (`serviceid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `services`
--


-- --------------------------------------------------------

--
-- Table structure for table `servicestotal`
--

CREATE TABLE IF NOT EXISTS `servicestotal` (
  `ID` int(10) NOT NULL auto_increment,
  `cardid` int(10) NOT NULL,
  `total` float(10,2) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `servicestotal`
--

