-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2016 at 05:21 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pos_technovelty`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbactivity_logs`
--

CREATE TABLE IF NOT EXISTS `tbactivity_logs` (
  `acl_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `activity` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(20) NOT NULL,
  PRIMARY KEY (`acl_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tbactivity_logs`
--

INSERT INTO `tbactivity_logs` (`acl_id`, `user_id`, `activity`, `date`, `time`) VALUES
(1, 3, 'Log in', '2016-11-07', '11:13:23am'),
(2, 3, 'Log in', '2016-11-07', '11:22:06am'),
(3, 3, 'Log out', '2016-11-07', '11:22:43am'),
(4, 3, 'Log in', '2016-11-07', '11:23:06am'),
(5, 3, 'Log out', '2016-11-07', '11:23:19am'),
(6, 0, 'Log out', '2016-11-07', '11:23:35am'),
(7, 0, 'Log out', '2016-11-07', '11:23:47am'),
(8, 3, 'Log in', '2016-11-07', '11:24:07am'),
(9, 3, 'Log out', '2016-11-07', '11:24:09am'),
(10, 3, 'Log in', '2016-11-07', '11:26:02am'),
(11, 3, 'Password Changed', '2016-11-07', '11:27:59am'),
(12, 3, 'Log out', '2016-11-07', '11:28:06am');

-- --------------------------------------------------------

--
-- Table structure for table `tbcategory`
--

CREATE TABLE IF NOT EXISTS `tbcategory` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `cname` varchar(200) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tbcategory`
--

INSERT INTO `tbcategory` (`cid`, `cname`) VALUES
(1, 'Mobile'),
(2, 'FOOD'),
(14, 'Electronics');

-- --------------------------------------------------------

--
-- Table structure for table `tbinvoice`
--

CREATE TABLE IF NOT EXISTS `tbinvoice` (
  `inid` int(20) NOT NULL AUTO_INCREMENT,
  `invoice_Number` int(20) NOT NULL,
  `customerName` varchar(200) NOT NULL,
  `customerPhone` varchar(50) NOT NULL,
  `customerAddress` varchar(200) NOT NULL,
  `userId` int(20) NOT NULL,
  `invoiceDate` date NOT NULL,
  `invoiceTime` varchar(20) NOT NULL,
  `paymentMethodId` int(20) NOT NULL,
  `tenderedAmount` varchar(50) NOT NULL,
  PRIMARY KEY (`inid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `tbinvoice`
--

INSERT INTO `tbinvoice` (`inid`, `invoice_Number`, `customerName`, `customerPhone`, `customerAddress`, `userId`, `invoiceDate`, `invoiceTime`, `paymentMethodId`, `tenderedAmount`) VALUES
(35, 1, 'Nuruzzaman Sabbir', '01824168996', 'Uttara', 2, '2016-10-22', '12:17:31am', 1, '600'),
(36, 2, 'Fardin Ahamed', '01824168996', 'Uttara', 3, '2016-10-24', '09:32:26am', 1, '21000'),
(37, 3, 'Sadia Sultana  Ekra', '01824168996', '', 3, '2016-10-24', '10:27:20am', 1, '40'),
(38, 4, 'Mr. Mofiz 6', '', '', 3, '2016-10-25', '10:30:56am', 1, '220'),
(39, 5, 'Mr. Kuddus', '', '', 3, '2016-10-25', '10:53:37am', 1, '1500'),
(40, 6, 'dfffff', '', '', 3, '2016-10-25', '04:18:10pm', 1, '140');

-- --------------------------------------------------------

--
-- Table structure for table `tbproducts`
--

CREATE TABLE IF NOT EXISTS `tbproducts` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `pname` text NOT NULL,
  `code` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `unitid` int(11) NOT NULL,
  `originalPrice` varchar(50) NOT NULL,
  `sellingPrice` varchar(50) NOT NULL,
  `vat` varchar(20) NOT NULL DEFAULT '0',
  `discount` varchar(20) NOT NULL DEFAULT '0',
  `subCategoryId` int(11) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `image` text NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `tbproducts`
--

INSERT INTO `tbproducts` (`pid`, `pname`, `code`, `description`, `unitid`, `originalPrice`, `sellingPrice`, `vat`, `discount`, `subCategoryId`, `quantity`, `image`) VALUES
(2, 'Nokia Lumia 535 Green', '16809909600', '3GB Ram, 64GB ROM, 5000mgh ,25Megapixel Primary,20megapixel', 2, '15750', '21000', '0', '600', 9, '30', 'default.jpg'),
(4, 'Nokia Lumia 532 Black', '16809909601', '2GB Ram, 20GB ROM, 2000mgh ,8Megapexel ', 2, '5600', '6000', '0', '20', 9, '1', 'default.jpg'),
(7, 'Nokia Lumia 532 Blue', '16809909602', '1.5GB Ram, 16GB ROM, 5000mgh ,13Megapexel ', 2, '5500', '6050', '0', '45', 9, '80', 'default.jpg'),
(8, 'Pollaw', '15809909601', '100% white rice', 1, '52', '62', '0', '2', 10, '25', 'default.jpg'),
(9, '7UP 500ml ', 'p0009661', ' ', 2, '22', '24', '0', '0', 12, '14', 'default.jpg'),
(10, 'Cocacola 400ml', '122056869', ' ', 2, '18', '22', '0', '0', 12, '15', 'default.jpg'),
(11, 'Cocacola 600ml', '122056870', ' ', 2, '34', '36', '0', '0', 12, '24', 'default.jpg'),
(12, 'Chicken Burger Medium', '190221223445', ' ', 2, '56', '65', '0', '0', 15, '9', 'default.jpg'),
(13, 'Chicken Burger Small', '190221223444', ' ', 2, '38', '45', '0', '0', 15, '25', 'default.jpg'),
(14, 'Chicken Burger Large', '190221223446', ' ', 2, '64', '80', '0', '0', 15, '20', 'default.jpg'),
(15, 'Chicken Roll', '190221223447', ' ', 2, '14', '18', '0', '0', 15, '26', 'default.jpg'),
(16, 'Beef Burger Medium', '190221223448', ' ', 2, '103', '120', '0', '0', 15, '15', 'default.jpg'),
(17, 'Microsoft Lumia 430 black', '190221223450', '1GB RAM, 8GB ROM, 1800mgh ,8Megapexel Camera', 2, '4100', '4500', '0', '0', 9, '48', 'default.jpg'),
(18, 'Microsoft Lumia 430 Green', '190221223451', '1GB RAM, 8GB ROM, 1800mgh ,8Megapexel Camera', 2, '4100', '4500', '0', '0', 9, '30', 'default.jpg'),
(19, 'Apple (Red)  Medium', '1902212240', ' ', 1, '160', '190', '0', '0', 11, '58', 'default.jpg'),
(20, 'Apple (Green) Medium', '1902212241', ' ', 1, '156', '185', '0', '0', 11, '50', 'default.jpg'),
(21, 'Multa Big Size', '1902212242', ' ', 1, '170', '200', '0', '0', 11, '60', 'default.jpg'),
(22, 'Multa (Medium)', '1902212243', '\r\n ', 1, '160', '180', '0', '0', 11, '78', 'default.jpg'),
(23, 'Orange (Large)', '1902212244', ' ', 1, '170', '200', '0', '0', 11, '47', 'default.jpg'),
(24, 'Orange (Medium)', '1902212245', ' ', 1, '150', '175', '0', '0', 11, '60', 'default.jpg'),
(26, '7UP 2 Litter', '12345678766', ' ', 2, '87', '100', '0', '0', 12, '0', 'default.jpg'),
(27, 'Beef Burger Extra large', '5678hghh', 'bgb', 2, '67', '80', '4', '0', 15, '66', 'default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbproductsales`
--

CREATE TABLE IF NOT EXISTS `tbproductsales` (
  `productSalesId` int(11) NOT NULL AUTO_INCREMENT,
  `invoiceNumber` int(50) NOT NULL,
  `productId` int(20) NOT NULL,
  `productPriceRate` varchar(50) NOT NULL,
  `productQtys` varchar(50) NOT NULL,
  `profitAmount` varchar(50) NOT NULL,
  PRIMARY KEY (`productSalesId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;

--
-- Dumping data for table `tbproductsales`
--

INSERT INTO `tbproductsales` (`productSalesId`, `invoiceNumber`, `productId`, `productPriceRate`, `productQtys`, `profitAmount`) VALUES
(48, 1, 11, '26', '10', '80'),
(49, 1, 8, '60', '3', '30'),
(50, 1, 10, '22', '5', '20'),
(51, 1, 9, '24', '2', '4'),
(52, 2, 2, '20400', '1', '5250'),
(53, 3, 15, '18', '2', '8'),
(54, 4, 9, '24', '1', '2'),
(55, 4, 15, '18', '2', '8'),
(56, 4, 12, '65', '2', '18'),
(57, 4, 10, '22', '1', '4'),
(58, 5, 11, '36', '2', '4'),
(59, 5, 23, '200', '30', '90'),
(60, 5, 22, '180', '2', '40'),
(61, 5, 19, '190', '2', '60'),
(62, 6, 12, '65', '2', '18');

-- --------------------------------------------------------

--
-- Table structure for table `tbproductsales_tmp`
--

CREATE TABLE IF NOT EXISTS `tbproductsales_tmp` (
  `tmpid` int(11) NOT NULL AUTO_INCREMENT,
  `tmpSalesNumber` text NOT NULL,
  `productId` int(11) NOT NULL,
  `productPriceRate` varchar(10) NOT NULL,
  `profitAmount` varchar(20) NOT NULL,
  `productQtys` varchar(50) NOT NULL,
  PRIMARY KEY (`tmpid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbproductsales_tmp`
--

INSERT INTO `tbproductsales_tmp` (`tmpid`, `tmpSalesNumber`, `productId`, `productPriceRate`, `profitAmount`, `productQtys`) VALUES
(1, '65a328ba43810c6217460e3c5efa18c3', 26, '100', '13', '1'),
(2, '65a328ba43810c6217460e3c5efa18c3', 9, '24', '2', '1'),
(3, '1e33069e2c354e52558b8b703cbe15b8', 4, '5980', '19000', '50');

-- --------------------------------------------------------

--
-- Table structure for table `tbproductunit`
--

CREATE TABLE IF NOT EXISTS `tbproductunit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unitName` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbproductunit`
--

INSERT INTO `tbproductunit` (`id`, `unitName`) VALUES
(1, 'Kg'),
(2, 'Pc''s'),
(3, 'Littre');

-- --------------------------------------------------------

--
-- Table structure for table `tbsubcategory`
--

CREATE TABLE IF NOT EXISTS `tbsubcategory` (
  `scid` int(11) NOT NULL AUTO_INCREMENT,
  `sub_cat_name` varchar(200) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`scid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `tbsubcategory`
--

INSERT INTO `tbsubcategory` (`scid`, `sub_cat_name`, `category_id`) VALUES
(9, 'Nokia', 1),
(10, 'Rice', 2),
(11, 'Fruits', 2),
(12, 'Drinks', 2),
(13, 'Vegetables', 2),
(15, 'Fast Food', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbusers`
--

CREATE TABLE IF NOT EXISTS `tbusers` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `userFullName` varchar(200) NOT NULL,
  `userTypeId` int(1) NOT NULL,
  `userPhone` varchar(50) NOT NULL,
  `userEmail` varchar(200) NOT NULL,
  `userJoiningDate` varchar(50) NOT NULL,
  `userAddress` text NOT NULL,
  `userName` varchar(200) NOT NULL,
  `userPassword` text NOT NULL,
  `userImage` text NOT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `userEmail` (`userEmail`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbusers`
--

INSERT INTO `tbusers` (`userid`, `userFullName`, `userTypeId`, `userPhone`, `userEmail`, `userJoiningDate`, `userAddress`, `userName`, `userPassword`, `userImage`) VALUES
(1, 'Tech-Novelty Solution Ltd.', 1, '01824168996', 'samsujjamanbappy@gmail.com', '', '', 'admin', '21232f297a57a5a743894a0e4a801fc3', ''),
(2, 'Bappy', 2, '01824168996', 'bappy@gmail.com', '20-02-2016', 'IUBAT UTTARA', 'bappy1', '202cb962ac59075b964b07152d234b70', 'user_2_01824168996.jpg'),
(3, 'Samsujjaman Bappy', 2, '01824168996', 'bappy1428@gmail.com', '20-02-2016', 'IUBAT UTTARA', 'bappy', '81dc9bdb52d04dc20036dbd8313ed055', 'user_2_01824168996.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbusertype`
--

CREATE TABLE IF NOT EXISTS `tbusertype` (
  `userTypeId` int(11) NOT NULL AUTO_INCREMENT,
  `userType` varchar(200) NOT NULL,
  PRIMARY KEY (`userTypeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbusertype`
--

INSERT INTO `tbusertype` (`userTypeId`, `userType`) VALUES
(1, 'Admin'),
(2, 'Executive');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
