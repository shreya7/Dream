-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2014 at 07:42 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `brand_master`
--

INSERT INTO `brand_master` (`BrandId`, `BrandName`, `CityName`) VALUES
(1, 'TATA', 'Jamshedpur'),
(2, 'BMW', 'Bangalore'),
(3, 'MARUTI', 'Mumbai'),
(4, 'TATA', 'Mumbai'),
(5, 'BMW', 'Mumbai'),
(6, 'TATA', 'Bangalore'),
(7, 'MARUTI', 'Bangalore'),
(8, 'MARUTI', 'Jamshedpur'),
(9, 'BMW', 'Jamshedpur');

-- --------------------------------------------------------

--
-- Table structure for table `category_master`
--

CREATE TABLE IF NOT EXISTS `category_master` (
`CategoryId` int(11) NOT NULL,
  `CategoryName` varchar(20) NOT NULL,
  `CategoryDesc` varchar(60) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `category_master`
--

INSERT INTO `category_master` (`CategoryId`, `CategoryName`, `CategoryDesc`) VALUES
(1, 'Car', 'All About cars');

-- --------------------------------------------------------

--
-- Table structure for table `city_master`
--

CREATE TABLE IF NOT EXISTS `city_master` (
`CityId` int(11) NOT NULL,
  `CityName` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `city_master`
--

INSERT INTO `city_master` (`CityId`, `CityName`) VALUES
(1, 'Jamshedpur'),
(2, 'Mumbai'),
(3, 'Bangalore');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
`Id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Email` varchar(70) NOT NULL,
  `Fax` bigint(20) NOT NULL,
  `Subject` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`Id`, `Name`, `Email`, `Fax`, `Subject`) VALUES
(1, 'fgsf', 'fgd', 785, 'fgdmgh ');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `login_master`
--

CREATE TABLE IF NOT EXISTS `login_master` (
`UserId` int(11) NOT NULL,
  `UserName` varchar(40) NOT NULL,
  `Password` varchar(15) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `login_master`
--

INSERT INTO `login_master` (`UserId`, `UserName`, `Password`) VALUES
(1, 'admin@you.me', 'admin5'),
(2, 'ari@ymail.com', '1234'),
(3, '12@gmail.com', 'abc'),
(4, 'Sai@gmail.com', '1234'),
(5, 'dia@gmail.com', '12345'),
(6, 'adf@gmail.com', '234'),
(7, 'xyz3@ymail.com', '2345');

-- --------------------------------------------------------

--
-- Table structure for table `model_master`
--

CREATE TABLE IF NOT EXISTS `model_master` (
`ModelId` int(11) NOT NULL,
  `ModelName` varchar(60) NOT NULL,
  `BrandName` varchar(60) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `model_master`
--

INSERT INTO `model_master` (`ModelId`, `ModelName`, `BrandName`) VALUES
(1, 'TATA Nano', 'TATA'),
(2, 'BMW E89', 'BMW'),
(3, 'MARUTI Swift', 'MARUTI'),
(4, 'BMW X1', 'BMW'),
(5, 'BMW 3 Series', 'BMW'),
(6, 'BMW Z4', 'BMW'),
(7, 'TATA Indica v2', 'TATA'),
(8, 'TATA Zest', 'TATA'),
(9, 'TATA Aria', 'TATA'),
(10, 'TATA Safari', 'TATA'),
(11, 'Maruti Suzuki Grand Vitara', 'MARUTI'),
(12, 'Maruti Suzuki Ritz', 'MARUTI'),
(13, 'Maruti Suzuki alto', 'MARUTI');

-- --------------------------------------------------------

--
-- Table structure for table `property_image`
--

CREATE TABLE IF NOT EXISTS `property_image` (
`ImageId` int(11) NOT NULL,
  `PropertyId` int(11) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `ImagePath` varchar(200) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `property_image`
--

INSERT INTO `property_image` (`ImageId`, `PropertyId`, `Title`, `ImagePath`) VALUES
(1, 1, 'Tata Nano', 'tatanano.jpg');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `property_master`
--

INSERT INTO `property_master` (`PropertyId`, `CategoryId`, `CityName`, `BrandName`, `ModelName`, `PropertyName`, `PropertyImage`, `PropertyDesc`, `PropertyAge`, `PropertyCost`, `Status`, `CustomerId`) VALUES
(1, 1, 'Jamshedpur', 'TATA', 'TATA Nano', 'Tata Car', 'tatanano.jpg', 'car for luxury', '2', 90000, 'very good', 1),
(2, 1, 'Bangalore', 'BMW', 'BMW E89', 'BMW Cars', 'bmw.jpg', 'luxuriest car', '3', 4500000, 'good', 2),
(3, 1, 'Jamshedpur', 'TATA', 'TATA Indica v2', 'Tata Car', 'indica.jpg', 'Happy people car', '4', 3400000, 'Good', 3),
(4, 1, 'Jamshedpur', 'TATA', 'Tata Nano', 'Nano Car', 'tatanano1.jpg', 'Nano feels happy', '1', 130000, 'fine', 4),
(5, 1, 'Jamshedpur', 'BMW', 'BMW X1', 'bmw cars', 'bmwx.jpg', 'Feels Good Cars', '5', 3100000, 'Very Good', 5),
(6, 1, 'Jamshedpur', 'TATA', 'Tata Zest', 'Tata Cars', 'Tatazest.jpg', 'Zest your Life', '4', 450000, 'Good', 6),
(7, 1, 'Jamshedpur', 'TATA', 'Tata Aria', 'tata car', 'tataaria.jpg', 'Aria cars', '4', 890000, 'Fine', 7),
(8, 1, 'Jamshedpur', 'TATA', 'Tata Safari', 'tata car', 'safari.jpg', 'Safari cars', '3', 790000, 'Fine', 8),
(9, 1, 'Jamshedpur', 'TATA', 'Tata Safari', 'tata car', 'safari1.jpg', 'Safari cars', '7', 810000, 'Good', 9),
(10, 1, 'Mumbai', 'TATA', 'Tata Aria', 'tata car', 'tataaria1.jpg', 'Aria cars', '6', 900000, 'Fine', 10),
(11, 1, 'Mumbai', 'TATA', 'Tata Indica V2', 'tata car', 'tataindica1.jpg', 'Indica cars', '4', 360000, 'Very Good', 11),
(12, 1, 'Mumbai', 'TATA', 'Tata Nano', 'tata car', 'nano.jpg', 'nano cars', '1', 100000, 'Excellent', 12),
(13, 1, 'Jamshedpur', 'MARUTI', 'Maruti Swift', 'Swift car', 'swift.jpg', 'swifty', '4', 380000, 'Good', 13),
(14, 1, 'Jamshedpur', 'MARUTI', 'Maruti Alto', 'Alto car', 'alto1.jpg', 'Altos', '2', 200000, 'Very Good', 14),
(15, 1, 'Jamshedpur', 'BMW', 'BMW 3 Series', 'BMW car', 'bmw3.jpg', 'BMW Life', '5', 3800000, 'Excellent', 15),
(16, 1, 'Mumbai', 'MARUTI', 'Maruti Swift', 'Swift car', 'swift2.jpg', 'swifty', '3', 390000, 'Good', 16),
(17, 1, 'Mumbai', 'MARUTI', 'Maruti Swift', 'Swift car', 'swift1.jpg', 'swifty', '1', 400000, 'Excellent', 17),
(18, 1, 'Mumbai', 'MARUTI', 'Maruti Suzuki Grand Vitara', 'Grand car', 'grand.jpg', 'Grand', '2', 700000, 'Excellent', 18),
(19, 1, 'Mumbai', 'MARUTI', 'Maruti Suzuki Grand Vitara', 'Grand car', 'grand1.jpg', 'Grand', '3', 720000, 'Good', 19),
(20, 1, 'Mumbai', 'MARUTI', 'Maruti Suzuki alto', 'Grand car', 'alto1.jpg', 'Alto car', '4', 300000, 'Very Good', 20);

-- --------------------------------------------------------

--
-- Table structure for table `sell_master`
--

CREATE TABLE IF NOT EXISTS `sell_master` (
`id` int(11) NOT NULL,
  `brand` varchar(60) NOT NULL,
  `model` varchar(60) NOT NULL,
  `month` varchar(15) NOT NULL,
  `dat` int(5) NOT NULL,
  `year` int(5) NOT NULL,
  `city` varchar(45) NOT NULL,
  `img` varchar(70) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(80) NOT NULL,
  `email` varchar(60) NOT NULL,
  `comm_no` bigint(20) NOT NULL,
  `altnum` bigint(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `sell_master`
--

INSERT INTO `sell_master` (`id`, `brand`, `model`, `month`, `dat`, `year`, `city`, `img`, `price`, `name`, `address`, `email`, `comm_no`, `altnum`) VALUES
(1, 'Tata', 'Tata Indica V2', '08', 12, 2012, 'Bangalore', 'alto.jpg', '200000.00', 'Riya', 'bang', 'd4@gmail.com', 8909890970, 0),
(3, 'Tata', 'Tata Indica V2', '08', 12, 2012, 'Bangalore', 'alto.jpg', '200000.00', 'Riya', 'bang', 'd6@gmail.com', 8909890970, 0),
(4, 'Tata', 'Tata Indica V2', '08', 12, 2012, 'Bangalore', 'alto.jpg', '200000.00', 'Riya', 'bang', 'd9@gmail.com', 8909870970, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wash_date`
--

CREATE TABLE IF NOT EXISTS `wash_date` (
`id` int(11) NOT NULL,
  `WashDate` varchar(30) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(80) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `email` varchar(60) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `wash_date`
--

INSERT INTO `wash_date` (`id`, `WashDate`, `name`, `address`, `phone`, `email`) VALUES
(1, '11/27/2014', 'Riya', 'bangalore', 8909890970, 's@yamil.com'),
(2, '11/26/2014', 'Shreya', 'Bangalore', 9004669242, 'shreya7@gmail.com'),
(3, '11/26/2014', 'Shreya', 'Bangalore', 9004669242, 'shreya7@gmail.com'),
(4, '', '', '', 0, ''),
(5, '11/27/2014', 'Shreya', 'Bangalore', 9004669242, 'shreya7@gmail.com'),
(6, '11/27/2014', 'Shreya', 'Bangalore', 9004669242, 'shreya7@gmail.com'),
(7, '11/27/2014', 'Shreya', 'Bangalore', 0, 'shreya7@gmail.com'),
(8, '11/27/2014', 'Diya', 'Bangalore', 9007987650, 'shreya7@gmail.com'),
(9, '11/28/2014', 'Shreya', 'Bangl', 8909890970, 'shreya7@gmail.com'),
(10, '11/28/2014', 'Shreya', 'Bangl', 8909890970, 'shreya7@gmail.com'),
(11, '11/28/2014', 'Shreya', 'Bangl', 8909890970, 'shreya7@gmail.com'),
(12, '11/28/2014', 'Shreya', 'Bangl', 8909890970, 'shreya7@gmail.com');

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
-- Indexes for table `contact`
--
ALTER TABLE `contact`
 ADD PRIMARY KEY (`Id`);

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
-- Indexes for table `sell_master`
--
ALTER TABLE `sell_master`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email` (`email`);

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
MODIFY `BrandId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `category_master`
--
ALTER TABLE `category_master`
MODIFY `CategoryId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `city_master`
--
ALTER TABLE `city_master`
MODIFY `CityId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `customer_reg`
--
ALTER TABLE `customer_reg`
MODIFY `CustomerId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `login_master`
--
ALTER TABLE `login_master`
MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `model_master`
--
ALTER TABLE `model_master`
MODIFY `ModelId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `property_image`
--
ALTER TABLE `property_image`
MODIFY `ImageId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `property_master`
--
ALTER TABLE `property_master`
MODIFY `PropertyId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `sell_master`
--
ALTER TABLE `sell_master`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `wash_date`
--
ALTER TABLE `wash_date`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
