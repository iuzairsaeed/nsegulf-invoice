-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2016 at 09:54 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nseinvoice`
--

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `ID` int(10) NOT NULL,
  `cardnumber` varchar(50) NOT NULL DEFAULT 'None',
  `clientjobnumber` varchar(30) NOT NULL DEFAULT 'None',
  `contactperson` varchar(50) NOT NULL,
  `carddate` date NOT NULL,
  `companyid` int(10) NOT NULL,
  `carnum` varchar(10) NOT NULL,
  `partnumber` varchar(50) NOT NULL,
  `modelnumber` varchar(50) NOT NULL,
  `serialnumber` varchar(50) NOT NULL,
  `customertype` varchar(50) NOT NULL,
  `receivedby` varchar(40) NOT NULL DEFAULT 'mehfooz',
  `customercomplaint` text NOT NULL,
  `includedaccess` text NOT NULL,
  `otherremarks` text NOT NULL,
  `cardstatus` varchar(10) NOT NULL DEFAULT 'del',
  `totamount` float(10,2) NOT NULL,
  `paymentref` varchar(50) NOT NULL DEFAULT 'None',
  `paid` varchar(3) NOT NULL DEFAULT 'NO',
  `paymentmode` varchar(10) NOT NULL DEFAULT 'None'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`ID`, `cardnumber`, `clientjobnumber`, `contactperson`, `carddate`, `companyid`, `carnum`, `partnumber`, `modelnumber`, `serialnumber`, `customertype`, `receivedby`, `customercomplaint`, `includedaccess`, `otherremarks`, `cardstatus`, `totamount`, `paymentref`, `paid`, `paymentmode`) VALUES
(25, 'ADAR/', '23409234', '', '2011-11-19', 1, '2340923', '23429304', '30932', '23490', 'Cash', 'Faizan', 'None', '', '', '', 0.00, '', 'NO', 'None'),
(26, 'ADAR/25', '23409234', '', '2011-11-19', 1, '2340923', '23429304', '30932', '23490', 'Cash', 'Faizan', 'None', '', '', 'inv', 0.00, '', 'NO', 'None'),
(27, 'ADAR/26', '23409234', '', '2011-11-19', 1, '2340923', '23429304', '30932', '23490', 'Cash', 'Faizan', 'None', '', '', 'inv', 0.00, '', 'NO', 'None'),
(28, 'ADAR/27', '3423', '', '2011-11-02', 1, '23423', '', '', '', '', '', '3423', '234232', '34', 'paid', 100.00, '450934', 'NO', 'Cash'),
(29, 'AJN/28', '2390423', '', '2011-12-07', 4, 'B23092', '12312', '23423', '34534', '23423', '2342', 'nONE', 'nONENONE', 'NONEONE', 'inv', 0.00, '', 'NO', 'None'),
(30, 'ADAR/29', '2309423', 'Mr. New Person', '2011-12-02', 1, 'A230942', '2340923', '023942', '02394', 'Cash', 'Faizan', 'None whatsover', 'Any complain i do not no know no no', '', 'paid', 400.00, '349023', 'NO', 'None'),
(31, 'AJN/30', '49023', 'Not new person', '2011-12-03', 4, 'b234092', '2304923', '023203', '230492', 'Warranty', 'Mehfooz', 'Noe report', 'reports non paymento', '', 'paid', 400.00, '2304230', 'NO', 'Cheque'),
(32, 'ADAR/31', 'fjalk', 'dskjf', '2016-06-30', 1, 'jfdlka', 'fjla', 'lsdkf', 'jdslk', 'jflkds', 'ldks', 'ladsj', 'lkdsj', 'adskjf', 'fin', 100.00, 'None', 'NO', 'None'),
(33, 'ADAR/32', 'fjalk', 'dskjf', '2016-06-30', 1, 'jfdlka', 'fjla', 'lsdkf', 'jdslk', 'jflkds', 'ldks', 'ladsj', 'lkdsj', 'adskjf', 'inv', 0.00, 'None', 'NO', 'None');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `companyid` int(10) NOT NULL,
  `companyname` varchar(200) NOT NULL,
  `companycode` varchar(100) NOT NULL,
  `companybranch` varchar(100) NOT NULL,
  `contactperson` varchar(100) NOT NULL,
  `mobile` varchar(30) NOT NULL,
  `telephone` varchar(30) NOT NULL,
  `fax` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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

CREATE TABLE `delivery` (
  `delid` int(10) NOT NULL,
  `delnum` varchar(20) NOT NULL,
  `cardid` int(10) NOT NULL,
  `deldate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`delid`, `delnum`, `cardid`, `deldate`) VALUES
(1, 'ADAR/29/D', 30, '2011-12-03'),
(2, 'AJN/30/D', 31, '2011-12-03'),
(3, 'ADAR/27/D', 28, '2011-12-03');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoiceid` int(10) NOT NULL,
  `invoicenumber` varchar(40) NOT NULL,
  `invoice_date` date NOT NULL,
  `card_id` int(10) NOT NULL,
  `totalamount` float(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoiceid`, `invoicenumber`, `invoice_date`, `card_id`, `totalamount`) VALUES
(1, 'ADAR/27/I', '2011-11-09', 28, 100.00),
(2, 'ADAR/29/I', '2011-12-03', 30, 400.00),
(3, 'AJN/30/I', '2011-12-02', 31, 400.00);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(5) NOT NULL,
  `mail` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `mail`, `username`, `password`, `level`) VALUES
(1, 'mehfooz@gmail.com', 'admin', 'admin', 1),
(2, 'faizan@gmail.com', 'faizan', 'faizan050', 0);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `serviceid` int(10) NOT NULL,
  `cardid` int(10) NOT NULL,
  `qty` int(10) NOT NULL,
  `description` varchar(200) NOT NULL,
  `unitprice` float(10,2) NOT NULL,
  `linetotal` float(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`serviceid`, `cardid`, `qty`, `description`, `unitprice`, `linetotal`) VALUES
(1, 28, 1, 'asdlfk', 100.00, 100.00),
(2, 30, 2, 'New part', 200.00, 400.00),
(3, 31, 2, 'Nonnoiei', 200.00, 400.00),
(4, 32, 0, 'dfsjkl', 100.00, 100.00);

-- --------------------------------------------------------

--
-- Table structure for table `servicestotal`
--

CREATE TABLE `servicestotal` (
  `ID` int(10) NOT NULL,
  `cardid` int(10) NOT NULL,
  `total` float(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`companyid`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`delid`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoiceid`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`serviceid`);

--
-- Indexes for table `servicestotal`
--
ALTER TABLE `servicestotal`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `companyid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `delid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoiceid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `serviceid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `servicestotal`
--
ALTER TABLE `servicestotal`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
