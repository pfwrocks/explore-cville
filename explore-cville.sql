-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 05, 2021 at 05:45 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `explore-cville`
--

-- --------------------------------------------------------

--
-- Table structure for table `ACTIVITY`
--

CREATE TABLE `ACTIVITY` (
  `ACTIVITY_ID` int(11) NOT NULL,
  `ACTIVITY_NAME` text NOT NULL,
  `ACTIVITY_OPENTIME` date NOT NULL DEFAULT current_timestamp(),
  `ACTIVITY_CLOSETIME` date NOT NULL DEFAULT current_timestamp(),
  `ACTIVITY_TYPE` varchar(12) NOT NULL,
  `ACTIVITY_URL` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ACTIVITY`
--

INSERT INTO `ACTIVITY` (`ACTIVITY_ID`, `ACTIVITY_NAME`, `ACTIVITY_OPENTIME`, `ACTIVITY_CLOSETIME`, `ACTIVITY_TYPE`, `ACTIVITY_URL`) VALUES
(1, 'Old Rag Mountain Loop', '2021-01-01', '2022-01-31', 'HIKE', 'https://www.alltrails.com/trail/us/virginia/old-rag-mountain-loop-trail'),
(2, 'Humpback Rocks Hike', '2021-01-02', '2022-02-01', 'HIKE', 'https://www.hikingupward.com/maps/detail.asp?RID=218'),
(3, 'Riprap Trail', '2021-01-03', '2022-02-02', 'HIKE', 'https://www.alltrails.com/trail/us/virginia/riprap-trail'),
(4, 'Public Fish & Oyster', '2021-01-04', '2022-02-03', 'RESTAURANT', 'http://publicfo.com/'),
(5, 'Red Hub', '2021-01-05', '2022-02-04', 'RESTAURANT', 'https://www.redhubfoodco.com/'),
(6, 'Kardinal Hall', '2021-01-06', '2022-02-05', 'RESTAURANT', 'https://kardinalhall.com/'),
(7, 'Legally Blond', '2021-01-07', '2022-02-06', 'MOVIE', 'https://www.imdb.com/title/tt0250494/'),
(8, 'Spirit Untamed', '2021-01-08', '2022-02-07', 'MOVIE', 'https://www.imdb.com/title/tt11084896/'),
(9, 'The Sparks Brothers', '2021-01-09', '2022-02-08', 'MOVIE', 'https://www.imdb.com/title/tt8610436/');

-- --------------------------------------------------------

--
-- Table structure for table `CUSTOMER`
--

CREATE TABLE `CUSTOMER` (
  `CUST_ID` int(11) NOT NULL,
  `CUST_FNAME` varchar(25) NOT NULL,
  `CUST_LNAME` varchar(25) NOT NULL,
  `CUST_AREACODE` int(3) NOT NULL,
  `CUST_PHONE` int(7) NOT NULL,
  `CUSTOMER_ADDRESS` varchar(100) NOT NULL,
  `CUSTOMER_ZIP_CODE` int(11) NOT NULL,
  `HOTEL_ID` int(11) NOT NULL,
  `EMPLOYEE_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `CUSTOMER`
--

INSERT INTO `CUSTOMER` (`CUST_ID`, `CUST_FNAME`, `CUST_LNAME`, `CUST_AREACODE`, `CUST_PHONE`, `CUSTOMER_ADDRESS`, `CUSTOMER_ZIP_CODE`, `HOTEL_ID`, `EMPLOYEE_ID`) VALUES
(1, 'Harry', 'Potter', 123, 4567890, '4 Privet Drive', 22105, 2, 1),
(2, 'Hermione', 'Granger', 980, 8765432, '1111 Hogwarts Rd', 12345, 3, 2),
(3, 'Ron', 'Weasley', 111, 2223333, '1112 Hogwarts Rd', 12345, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `EMPLOYEE`
--

CREATE TABLE `EMPLOYEE` (
  `EMPLOYEE_ID` int(11) NOT NULL,
  `EMPLOYEE_FNAME` varchar(50) NOT NULL,
  `EMPLOYEE_LNAME` varchar(50) NOT NULL,
  `EMPLOYEE_AREACODE` int(3) NOT NULL,
  `EMPLOYEE_PHONE` int(7) NOT NULL,
  `EMPLOYEE_TITLE` varchar(50) NOT NULL,
  `EMPLOYEE_EMAIL` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `EMPLOYEE`
--

INSERT INTO `EMPLOYEE` (`EMPLOYEE_ID`, `EMPLOYEE_FNAME`, `EMPLOYEE_LNAME`, `EMPLOYEE_AREACODE`, `EMPLOYEE_PHONE`, `EMPLOYEE_TITLE`, `EMPLOYEE_EMAIL`) VALUES
(1, 'Tom', 'Hiddleston', 333, 4445555, 'Agent', 'thiddle@gmail.com'),
(2, 'Tom', 'Holland', 222, 3334444, 'Agent', 'tomholland123@gmail.com'),
(3, 'Jennifer', 'Lawrence', 111, 444555, 'Manager', 'therealjenniferlawrence@outlook.com');

-- --------------------------------------------------------

--
-- Table structure for table `ENROLL`
--

CREATE TABLE `ENROLL` (
  `LIST_ID` int(11) NOT NULL,
  `ACTIVITY_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ENROLL`
--

INSERT INTO `ENROLL` (`LIST_ID`, `ACTIVITY_ID`) VALUES
(1, 6),
(2, 9),
(3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `HOTEL`
--

CREATE TABLE `HOTEL` (
  `HOTEL_ID` int(11) NOT NULL,
  `HOTEL_NAME` varchar(100) NOT NULL,
  `HOTEL_NIGHTLYCOST` int(11) NOT NULL,
  `HOTEL_MAXCAPACITY` int(11) NOT NULL,
  `HOTEL_CURRCAPACITY` int(11) NOT NULL,
  `HOTEL_ADDR` varchar(50) NOT NULL,
  `HOTEL_ZIP` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `HOTEL`
--

INSERT INTO `HOTEL` (`HOTEL_ID`, `HOTEL_NAME`, `HOTEL_NIGHTLYCOST`, `HOTEL_MAXCAPACITY`, `HOTEL_CURRCAPACITY`, `HOTEL_ADDR`, `HOTEL_ZIP`) VALUES
(1, 'Red Roof Inn', 101, 50, 17, '2011 Holiday Drive', '22901'),
(2, 'Graduate', 439, 30, 15, '1309 W Main St', '22903'),
(3, 'Oakhurst Inn', 339, 12, 11, '100 Oakhurst Circle', '22903');

-- --------------------------------------------------------

--
-- Table structure for table `LIST`
--

CREATE TABLE `LIST` (
  `LIST_ID` int(11) NOT NULL,
  `CUST_ID` int(11) NOT NULL,
  `LIST_NAME` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `LIST`
--

INSERT INTO `LIST` (`LIST_ID`, `CUST_ID`, `LIST_NAME`) VALUES
(1, 1, 'Harry\'s magical adventure'),
(2, 2, 'Vacation, June 2021'),
(3, 3, 'Fall 2021 family trip');

-- --------------------------------------------------------

--
-- Table structure for table `RENT`
--

CREATE TABLE `RENT` (
  `CUSTOMER_ID` int(11) NOT NULL,
  `RC_VIN` int(11) NOT NULL,
  `RENT_STARTDATE` date DEFAULT NULL,
  `RENT_ENDDATE` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `RENT`
--

INSERT INTO `RENT` (`CUSTOMER_ID`, `RC_VIN`, `RENT_STARTDATE`, `RENT_ENDDATE`) VALUES
(1, 3, NULL, NULL),
(2, 2, NULL, NULL),
(3, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `RENTALCAR`
--

CREATE TABLE `RENTALCAR` (
  `RC_VIN` int(11) NOT NULL,
  `RC_MAKE` varchar(50) NOT NULL,
  `RC_MODEL` varchar(50) NOT NULL,
  `RC_COSTPERDAY` int(11) NOT NULL,
  `RC_AVAILABLE` tinyint(1) NOT NULL,
  `RC_COLOR` varchar(50) NOT NULL,
  `RENTALCAR_SEATS` int(10) NOT NULL,
  `RENTALCAR_RENTAL_COMPANY` varchar(10) NOT NULL,
  `RENTALCAR_TRANSMISSION` varchar(50) NOT NULL,
  `RENTALCAR_PICKUP_ADDR` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `RENTALCAR`
--

INSERT INTO `RENTALCAR` (`RC_VIN`, `RC_MAKE`, `RC_MODEL`, `RC_COSTPERDAY`, `RC_AVAILABLE`, `RC_COLOR`, `RENTALCAR_SEATS`, `RENTALCAR_RENTAL_COMPANY`, `RENTALCAR_TRANSMISSION`, `RENTALCAR_PICKUP_ADDR`) VALUES
(1, 'GMC', 'Yukon', 261, 0, 'Black', 7, 'Hertz', 'Automatic', '1900 Rio Hill Center, Charlottesville, USA'),
(2, 'Mitsubishi', 'Mirage', 64, 1, 'Grey', 4, 'Enterprise', 'Automatic', '1650 Seminole Trl, Charlottesville, USA'),
(3, 'Chrysler ', '300', 124, 1, 'White', 5, 'Enterprise', 'Automatic', 'CHO Airport, Charlottesville, Virginia');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ACTIVITY`
--
ALTER TABLE `ACTIVITY`
  ADD PRIMARY KEY (`ACTIVITY_ID`);

--
-- Indexes for table `CUSTOMER`
--
ALTER TABLE `CUSTOMER`
  ADD PRIMARY KEY (`CUST_ID`),
  ADD KEY `CUST_FK1` (`HOTEL_ID`),
  ADD KEY `CUST_FK2` (`EMPLOYEE_ID`);

--
-- Indexes for table `EMPLOYEE`
--
ALTER TABLE `EMPLOYEE`
  ADD PRIMARY KEY (`EMPLOYEE_ID`);

--
-- Indexes for table `ENROLL`
--
ALTER TABLE `ENROLL`
  ADD PRIMARY KEY (`LIST_ID`,`ACTIVITY_ID`),
  ADD KEY `ENROLL_FK2` (`ACTIVITY_ID`);

--
-- Indexes for table `HOTEL`
--
ALTER TABLE `HOTEL`
  ADD PRIMARY KEY (`HOTEL_ID`);

--
-- Indexes for table `LIST`
--
ALTER TABLE `LIST`
  ADD PRIMARY KEY (`LIST_ID`),
  ADD KEY `ACTIVITY_FK1` (`CUST_ID`);

--
-- Indexes for table `RENT`
--
ALTER TABLE `RENT`
  ADD PRIMARY KEY (`CUSTOMER_ID`,`RC_VIN`),
  ADD KEY `RENT_FK2` (`RC_VIN`);

--
-- Indexes for table `RENTALCAR`
--
ALTER TABLE `RENTALCAR`
  ADD PRIMARY KEY (`RC_VIN`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ACTIVITY`
--
ALTER TABLE `ACTIVITY`
  MODIFY `ACTIVITY_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `CUSTOMER`
--
ALTER TABLE `CUSTOMER`
  MODIFY `CUST_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `EMPLOYEE`
--
ALTER TABLE `EMPLOYEE`
  MODIFY `EMPLOYEE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `HOTEL`
--
ALTER TABLE `HOTEL`
  MODIFY `HOTEL_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `LIST`
--
ALTER TABLE `LIST`
  MODIFY `LIST_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `CUSTOMER`
--
ALTER TABLE `CUSTOMER`
  ADD CONSTRAINT `CUST_FK1` FOREIGN KEY (`HOTEL_ID`) REFERENCES `HOTEL` (`HOTEL_ID`),
  ADD CONSTRAINT `CUST_FK2` FOREIGN KEY (`EMPLOYEE_ID`) REFERENCES `EMPLOYEE` (`EMPLOYEE_ID`);

--
-- Constraints for table `ENROLL`
--
ALTER TABLE `ENROLL`
  ADD CONSTRAINT `ENROLL_FK1` FOREIGN KEY (`LIST_ID`) REFERENCES `LIST` (`LIST_ID`),
  ADD CONSTRAINT `ENROLL_FK2` FOREIGN KEY (`ACTIVITY_ID`) REFERENCES `ACTIVITY` (`ACTIVITY_ID`);

--
-- Constraints for table `LIST`
--
ALTER TABLE `LIST`
  ADD CONSTRAINT `ACTIVITY_FK1` FOREIGN KEY (`CUST_ID`) REFERENCES `CUSTOMER` (`CUST_ID`);

--
-- Constraints for table `RENT`
--
ALTER TABLE `RENT`
  ADD CONSTRAINT `RENT_FK1` FOREIGN KEY (`CUSTOMER_ID`) REFERENCES `CUSTOMER` (`CUST_ID`),
  ADD CONSTRAINT `RENT_FK2` FOREIGN KEY (`RC_VIN`) REFERENCES `RENTALCAR` (`RC_VIN`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
