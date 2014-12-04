-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2014 at 06:25 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pcar`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand_master`
--

CREATE TABLE IF NOT EXISTS `brand_master` (
`BrandId` int(11) NOT NULL,
  `BrandName` varchar(60) NOT NULL,
  `CityName` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `brand_master`
--

INSERT INTO `brand_master` (`BrandId`, `BrandName`, `CityName`) VALUES
(3, 'TATA', 'Mumbai'),
(4, 'BMW', 'Mumbai'),
(5, 'TATA', 'Jamshedpur');

-- --------------------------------------------------------

--
-- Table structure for table `category_master`
--

CREATE TABLE IF NOT EXISTS `category_master` (
`CategoryId` int(11) NOT NULL,
  `CategoryName` varchar(20) NOT NULL,
  `CategoryDesc` varchar(60) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `category_master`
--

INSERT INTO `category_master` (`CategoryId`, `CategoryName`, `CategoryDesc`) VALUES
(4, 'Car', 'Welcome to the world of your dream car'),
(5, 'car', 'Tata');

-- --------------------------------------------------------

--
-- Table structure for table `city_master`
--

CREATE TABLE IF NOT EXISTS `city_master` (
`CityId` int(11) NOT NULL,
  `CityName` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `city_master`
--

INSERT INTO `city_master` (`CityId`, `CityName`) VALUES
(5, 'Mumbai'),
(6, 'Jamshedpur');

-- --------------------------------------------------------

--
-- Table structure for table `customer_reg`
--

CREATE TABLE IF NOT EXISTS `customer_reg` (
`CustomerId` int(11) NOT NULL,
  `CustomerName` varchar(20) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `City` varchar(20) NOT NULL,
  `Mobile` bigint(20) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `Gender` varchar(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `customer_reg`
--

INSERT INTO `customer_reg` (`CustomerId`, `CustomerName`, `Address`, `City`, `Mobile`, `Email`, `Gender`) VALUES
(9, 'Sas', 'nhk', 'Jamshedpur', 8989898970, 'dai@gmail.com', 'male'),
(19, 'shreya', 'Andheri', 'Mumbai', 7411843090, 'shreya7@gmail.com', 'female'),
(20, 'Arijit', 'Andheri', 'Mumbai', 9004669242, 'it.sarkar@gmail.com', 'male'),
(21, 'adsc', 'fhgf', 'Mumbai', 9090909090, 'f@gmail.com', 'female'),
(22, 'chandrani', 'Kurla', 'Mumbai', 9545307891, 'chand@gmail.com', 'female'),
(23, 'Disha', 'fgh', 'Mumbai', 9833012778, 'dishas@ymail.com', 'female'),
(24, '', '', 'Mumbai', 0, '', ''),
(25, 'asdd', 'asdasd', 'Mumbai', 8989898989, 'asf', 'female');

-- --------------------------------------------------------

--
-- Table structure for table `login_master`
--

CREATE TABLE IF NOT EXISTS `login_master` (
`UserId` int(11) NOT NULL,
  `UserName` varchar(40) NOT NULL,
  `Password` varchar(15) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `login_master`
--

INSERT INTO `login_master` (`UserId`, `UserName`, `Password`) VALUES
(1, 'ari@ymail.com', '123'),
(2, 'Sai@gmail.com', '123'),
(4, '12@gmail', '45'),
(5, 'dia@gmail.com', '7'),
(7, 'a@gmail.com', '22');

-- --------------------------------------------------------

--
-- Table structure for table `model_master`
--

CREATE TABLE IF NOT EXISTS `model_master` (
`ModelId` int(11) NOT NULL,
  `ModelName` varchar(60) NOT NULL,
  `BrandName` varchar(60) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `model_master`
--

INSERT INTO `model_master` (`ModelId`, `ModelName`, `BrandName`) VALUES
(2, 'TATA Nano', 'TATA'),
(3, 'BMW E89', 'BMW');

-- --------------------------------------------------------

--
-- Table structure for table `property_image`
--

CREATE TABLE IF NOT EXISTS `property_image` (
`ImageId` int(11) NOT NULL,
  `Carid` int(11) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `ImagePath` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `property_master`
--

CREATE TABLE IF NOT EXISTS `property_master` (
`PropertyId` int(11) NOT NULL,
  `CategoryId` int(11) NOT NULL,
  `CityName` varchar(20) NOT NULL,
  `BrandName` varchar(20) NOT NULL,
  `ModelName` varchar(50) NOT NULL,
  `PropertyName` varchar(50) NOT NULL,
  `PropertyImage` varchar(200) NOT NULL,
  `PropertyDesc` varchar(200) NOT NULL,
  `PropertyAge` varchar(10) NOT NULL,
  `PropertyCost` float NOT NULL,
  `Status` varchar(20) NOT NULL,
  `CustomerId` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `property_master`
--

INSERT INTO `property_master` (`PropertyId`, `CategoryId`, `CityName`, `BrandName`, `ModelName`, `PropertyName`, `PropertyImage`, `PropertyDesc`, `PropertyAge`, `PropertyCost`, `Status`, `CustomerId`) VALUES
(7, 4, 'Mumbai', 'BMW', 'BMW E89', 'car', 'car.jpg', 'Good Condition Car', '3 Years', 450000, 'Fair', 1),
(8, 5, 'Mumbai', 'Tata', 'Tata Nano', 'car', 'nano.jpg', 'Feels like New Car', '3', 100000, 'Fine', 20);

-- --------------------------------------------------------

--
-- Table structure for table `sell`
--

CREATE TABLE IF NOT EXISTS `sell` (
  `id` int(11) NOT NULL,
  `brand` varchar(40) NOT NULL,
  `model` varchar(50) NOT NULL,
  `dat` int(11) NOT NULL,
  `month` varchar(15) NOT NULL,
  `year` varchar(7) NOT NULL,
  `city` varchar(40) NOT NULL,
  `img` varchar(60) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `name` varchar(50) NOT NULL,
  `contact` int(12) NOT NULL,
  `altnum` int(17) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wash_date`
--

CREATE TABLE IF NOT EXISTS `wash_date` (
`id` int(11) NOT NULL,
  `WashDate` varchar(30) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `wash_date`
--

INSERT INTO `wash_date` (`id`, `WashDate`) VALUES
(1, '0000-00-00'),
(2, '11/05/2014'),
(3, '11/27/2014'),
(4, '11/18/2014'),
(5, '11/18/2014'),
(6, '11/11/2014'),
(7, '11/11/2014'),
(8, '11/05/2014'),
(9, '11/12/2014'),
(10, '11/20/2014'),
(11, ''),
(12, '11/19/2014'),
(13, '11/11/2014'),
(14, '11/11/2014'),
(15, '11/11/2014'),
(16, ''),
(17, ''),
(18, ''),
(19, ''),
(20, ''),
(21, ''),
(22, ''),
(23, ''),
(24, ''),
(25, ''),
(26, '11/22/2014'),
(27, '11/22/2014'),
(28, ''),
(29, ''),
(30, '11/04/2014'),
(31, '11/11/2014'),
(32, '11/21/2014'),
(33, '11/19/2014'),
(34, '11/19/2014');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand_master`
--
ALTER TABLE `brand_master`
 ADD PRIMARY KEY (`BrandId`);

--
-- Indexes for table `category_master`
--
ALTER TABLE `category_master`
 ADD PRIMARY KEY (`CategoryId`);

--
-- Indexes for table `city_master`
--
ALTER TABLE `city_master`
 ADD PRIMARY KEY (`CityId`);

--
-- Indexes for table `customer_reg`
--
ALTER TABLE `customer_reg`
 ADD PRIMARY KEY (`CustomerId`), ADD UNIQUE KEY `Mobile` (`Mobile`), ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `login_master`
--
ALTER TABLE `login_master`
 ADD PRIMARY KEY (`UserId`), ADD UNIQUE KEY `UserName` (`UserName`);

--
-- Indexes for table `model_master`
--
ALTER TABLE `model_master`
 ADD PRIMARY KEY (`ModelId`);

--
-- Indexes for table `property_image`
--
ALTER TABLE `property_image`
 ADD PRIMARY KEY (`ImageId`);

--
-- Indexes for table `property_master`
--
ALTER TABLE `property_master`
 ADD PRIMARY KEY (`PropertyId`);

--
-- Indexes for table `wash_date`
--
ALTER TABLE `wash_date`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand_master`
--
ALTER TABLE `brand_master`
MODIFY `BrandId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `category_master`
--
ALTER TABLE `category_master`
MODIFY `CategoryId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `city_master`
--
ALTER TABLE `city_master`
MODIFY `CityId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `customer_reg`
--
ALTER TABLE `customer_reg`
MODIFY `CustomerId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `login_master`
--
ALTER TABLE `login_master`
MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `model_master`
--
ALTER TABLE `model_master`
MODIFY `ModelId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `property_image`
--
ALTER TABLE `property_image`
MODIFY `ImageId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `property_master`
--
ALTER TABLE `property_master`
MODIFY `PropertyId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `wash_date`
--
ALTER TABLE `wash_date`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
