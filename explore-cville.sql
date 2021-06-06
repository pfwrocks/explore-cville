-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2021 at 03:42 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.19

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
-- Table structure for table `activity`
--

CREATE TABLE `ACTIVITY` (
  `ACTIVITY_ID` int(11) NOT NULL,
  `ACTIVITY_NAME` text NOT NULL,
  `ACTIVITY_OPENTIME` time DEFAULT current_timestamp(),
  `ACTIVITY_CLOSETIME` time DEFAULT current_timestamp(),
  `ACTIVITY_TYPE` varchar(12) NOT NULL,
  `ACTIVITY_URL` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity`
--

INSERT INTO `ACTIVITY` (`ACTIVITY_ID`, `ACTIVITY_NAME`, `ACTIVITY_OPENTIME`, `ACTIVITY_CLOSETIME`, `ACTIVITY_TYPE`, `ACTIVITY_URL`) VALUES
(1, 'Old Rag Mountain Loop', '06:00:00', '20:00:00', 'HIKE', 'https://www.alltrails.com/trail/us/virginia/old-rag-mountain-loop-trail'),
(2, 'Humpback Rocks Hike', '06:00:00', '20:00:00', 'HIKE', 'https://www.hikingupward.com/maps/detail.asp?RID=218'),
(3, 'Riprap Trail', '06:00:00', '20:00:00', 'HIKE', 'https://www.alltrails.com/trail/us/virginia/riprap-trail'),
(4, 'Public Fish & Oyster', '11:00:00', '23:00:00', 'RESTAURANT', 'http://publicfo.com/'),
(5, 'Red Hub', '10:00:00', '21:00:00', 'RESTAURANT', 'https://www.redhubfoodco.com/'),
(6, 'Kardinal Hall', '09:00:00', '23:00:00', 'RESTAURANT', 'https://kardinalhall.com/'),
(7, 'Legally Blond', '00:00:00', '02:00:00', 'MOVIE', 'https://www.imdb.com/title/tt0250494/'),
(8, 'Spirit Untamed', '00:00:00', '01:30:00', 'MOVIE', 'https://www.imdb.com/title/tt11084896/'),
(9, 'The Sparks Brothers', '00:00:00', '02:15:00', 'MOVIE', 'https://www.imdb.com/title/tt8610436/');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `CUSTOMER` (
  `CUST_ID` int(11) NOT NULL,
  `CUST_FNAME` varchar(25) NOT NULL,
  `CUST_LNAME` varchar(25) NOT NULL,
  `CUST_AREACODE` int(3) NOT NULL,
  `CUST_PHONE` int(7) NOT NULL,
  `CUST_ADDRESS` varchar(100) NOT NULL,
  `CUST_ZIP` int(11) NOT NULL,
  `HOTEL_ID` int(11) DEFAULT NULL,
  `EMPLOYEE_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `CUSTOMER` (`CUST_ID`, `CUST_FNAME`, `CUST_LNAME`, `CUST_AREACODE`, `CUST_PHONE`, `CUST_ADDRESS`, `CUST_ZIP`, `HOTEL_ID`, `EMPLOYEE_ID`) VALUES
(1, 'Harry', 'Potter', 123, 4567890, '4 Privet Drive', 22105, 2, 1),
(2, 'Hermione', 'Granger', 980, 8765432, '1111 Hogwarts Rd', 12345, 3, 2),
(3, 'Ron', 'Weasley', 111, 2223333, '1112 Hogwarts Rd', 12345, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
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
-- Dumping data for table `employee`
--

INSERT INTO `EMPLOYEE` (`EMPLOYEE_ID`, `EMPLOYEE_FNAME`, `EMPLOYEE_LNAME`, `EMPLOYEE_AREACODE`, `EMPLOYEE_PHONE`, `EMPLOYEE_TITLE`, `EMPLOYEE_EMAIL`) VALUES
(1, 'Tom', 'Hiddleston', 333, 4445555, 'Agent', 'thiddle@gmail.com'),
(2, 'Tom', 'Holland', 222, 3334444, 'Agent', 'tomholland123@gmail.com'),
(3, 'Jennifer', 'Lawrence', 111, 444555, 'Manager', 'therealjenniferlawrence@outlook.com');

-- --------------------------------------------------------

--
-- Table structure for table `enroll`
--

CREATE TABLE `ENROLL` (
  `LIST_ID` int(11) NOT NULL,
  `ACTIVITY_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enroll`
--

INSERT INTO `ENROLL` (`LIST_ID`, `ACTIVITY_ID`) VALUES
(1, 6),
(2, 9),
(3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `hike`
--

CREATE TABLE `HIKE` (
  `ACTIVITY_ID` int(11) NOT NULL,
  `HIKE_TNAME` varchar(50) NOT NULL,
  `HIKE_DIFFICULTY` varchar(15) NOT NULL,
  `HIKE_LENGTH` decimal(10,0) NOT NULL,
  `HIKE_TOPO_GAIN` int(11) NOT NULL,
  `HIKE_STREET` varchar(50) NOT NULL,
  `HIKE_ZIPCODE` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `HOTEL` (
  `HOTEL_ID` int(11) NOT NULL,
  `HOTEL_NAME` varchar(100) NOT NULL,
  `HOTEL_NIGHTLYCOST` int(11) NOT NULL,
  `HOTEL_MAXCAPACITY` int(11) NOT NULL,
  `HOTEL_CURRCAPACITY` int(11) NOT NULL,
  `HOTEL_ADDR` varchar(50) NOT NULL,
  `HOTEL_ZIP` varchar(10) NOT NULL,
  `HOTEL_CONTINENTAL` tinyint(1) NOT NULL,
  `HOTEL_AREACODE` int(3) NOT NULL,
  `HOTEL_PHONE` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hotel`
--

INSERT INTO `HOTEL` (`HOTEL_ID`, `HOTEL_NAME`, `HOTEL_NIGHTLYCOST`, `HOTEL_MAXCAPACITY`, `HOTEL_CURRCAPACITY`, `HOTEL_ADDR`, `HOTEL_ZIP`, `HOTEL_CONTINENTAL`, `HOTEL_AREACODE`, `HOTEL_PHONE`) VALUES
(1, 'Red Roof Inn', 101, 50, 17, '2011 Holiday Drive', '22901', 0, 0, 0),
(2, 'Graduate', 439, 30, 15, '1309 W Main St', '22903', 0, 0, 0),
(3, 'Oakhurst Inn', 339, 12, 11, '100 Oakhurst Circle', '22903', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `list`
--

CREATE TABLE `LIST` (
  `LIST_ID` int(11) NOT NULL,
  `CUST_ID` int(11) DEFAULT NULL,
  `LIST_NAME` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `list`
--

INSERT INTO `LIST` (`LIST_ID`, `CUST_ID`, `LIST_NAME`) VALUES
(1, 1, 'Harry\'s magical adventure'),
(2, 2, 'Vacation, June 2021'),
(3, 3, 'Fall 2021 family trip');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `MOVIE` (
  `ACTIVITY_ID` int(11) NOT NULL,
  `MOVIE_NAME` varchar(50) NOT NULL,
  `MOVIE_PARENT_RATING` varchar(7) NOT NULL,
  `MOVIE_GENRE` varchar(15) NOT NULL,
  `MOVIE_RATING` decimal(3,0) NOT NULL,
  `MOVIE_DIRECTOR` varchar(25) NOT NULL,
  `MOVIE_RELEASE_DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rent`
--

CREATE TABLE `RENT` (
  `CUST_ID` int(11) NOT NULL,
  `RC_VIN` int(11) NOT NULL,
  `RENT_STARTDATE` date DEFAULT NULL,
  `RENT_ENDDATE` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rent`
--

INSERT INTO `RENT` (`CUST_ID`, `RC_VIN`, `RENT_STARTDATE`, `RENT_ENDDATE`) VALUES
(1, 3, '2021-06-27', '2021-06-30'),
(2, 2, '2021-06-09', '2021-06-24'),
(3, 1, '2021-06-30', '2021-07-10');

-- --------------------------------------------------------

--
-- Table structure for table `rentalcar`
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
  `RENTALCAR_PICKUP_ADDR` varchar(50) NOT NULL,
  `RENTAL_PICKUP_ZIPCODE` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rentalcar`
--

INSERT INTO `RENTALCAR` (`RC_VIN`, `RC_MAKE`, `RC_MODEL`, `RC_COSTPERDAY`, `RC_AVAILABLE`, `RC_COLOR`, `RENTALCAR_SEATS`, `RENTALCAR_RENTAL_COMPANY`, `RENTALCAR_TRANSMISSION`, `RENTALCAR_PICKUP_ADDR`, `RENTAL_PICKUP_ZIPCODE`) VALUES
(1, 'GMC', 'Yukon', 261, 0, 'Black', 7, 'Hertz', 'Automatic', '1900 Rio Hill Center, Charlottesville, USA', ''),
(2, 'Mitsubishi', 'Mirage', 64, 1, 'Grey', 4, 'Enterprise', 'Automatic', '1650 Seminole Trl, Charlottesville, USA', ''),
(3, 'Chrysler ', '300', 124, 1, 'White', 5, 'Enterprise', 'Automatic', 'CHO Airport, Charlottesville, Virginia', '');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `RESTAURANT` (
  `ACTIVITY_ID` int(11) NOT NULL,
  `RESTAURANT_NAME` varchar(50) NOT NULL,
  `RESTAURANT_RATING` decimal(10,0) NOT NULL,
  `RESTAURANT_PRICE_RANGE` varchar(15) NOT NULL,
  `RESTAURANT_CUISINE` varchar(15) NOT NULL,
  `RESTAURANT_STREET` varchar(50) NOT NULL,
  `RESTAURANT_ZIPCODE` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `showing`
--

CREATE TABLE `SHOWING` (
  `ACTIVITY_ID` int(11) NOT NULL,
  `THEATER_ID` int(11) NOT NULL,
  `SHOW_TIME` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `theater`
--

CREATE TABLE `THEATER` (
  `THEATER_ID` int(11) NOT NULL,
  `THEATER_NAME` varchar(50) NOT NULL,
  `THEATER_TICK_COST` decimal(10,0) NOT NULL,
  `THEATER_STREET` varchar(50) NOT NULL,
  `THEATER_ZIPCODE` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `ACTIVITY`
  ADD PRIMARY KEY (`ACTIVITY_ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `CUSTOMER`
  ADD PRIMARY KEY (`CUST_ID`),
  ADD KEY `CUST_FK1` (`HOTEL_ID`),
  ADD KEY `CUST_FK2` (`EMPLOYEE_ID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `EMPLOYEE`
  ADD PRIMARY KEY (`EMPLOYEE_ID`);

--
-- Indexes for table `enroll`
--
ALTER TABLE `ENROLL`
  ADD PRIMARY KEY (`LIST_ID`,`ACTIVITY_ID`),
  ADD KEY `ENROLL_FK2` (`ACTIVITY_ID`);

--
-- Indexes for table `hike`
--
ALTER TABLE `HIKE`
  ADD PRIMARY KEY (`ACTIVITY_ID`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `HOTEL`
  ADD PRIMARY KEY (`HOTEL_ID`);

--
-- Indexes for table `list`
--
ALTER TABLE `LIST`
  ADD PRIMARY KEY (`LIST_ID`),
  ADD KEY `ACTIVITY_FK1` (`CUST_ID`);

--
-- Indexes for table `movie`
--
ALTER TABLE `MOVIE`
  ADD PRIMARY KEY (`ACTIVITY_ID`);

--
-- Indexes for table `rent`
--
ALTER TABLE `RENT`
  ADD PRIMARY KEY (`CUST_ID`,`RC_VIN`),
  ADD KEY `RENT_FK2` (`RC_VIN`);

--
-- Indexes for table `rentalcar`
--
ALTER TABLE `RENTALCAR`
  ADD PRIMARY KEY (`RC_VIN`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `RESTAURANT`
  ADD PRIMARY KEY (`ACTIVITY_ID`);

--
-- Indexes for table `showing`
--
ALTER TABLE `SHOWING`
  ADD PRIMARY KEY (`ACTIVITY_ID`,`THEATER_ID`),
  ADD KEY `THEATER_ID` (`THEATER_ID`);

--
-- Indexes for table `theater`
--
ALTER TABLE `THEATER`
  ADD PRIMARY KEY (`THEATER_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `ACTIVITY`
  MODIFY `ACTIVITY_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CUST_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `EMPLOYEE`
  MODIFY `EMPLOYEE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hotel`
--
ALTER TABLE `HOTEL`
  MODIFY `HOTEL_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `list`
--
ALTER TABLE `LIST`
  MODIFY `LIST_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `theater`
--
ALTER TABLE `THEATER`
  MODIFY `THEATER_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `CUSTOMER`
  ADD CONSTRAINT `CUST_FK1` FOREIGN KEY (`HOTEL_ID`) REFERENCES `hotel` (`HOTEL_ID`),
  ADD CONSTRAINT `CUST_FK2` FOREIGN KEY (`EMPLOYEE_ID`) REFERENCES `employee` (`EMPLOYEE_ID`);

--
-- Constraints for table `enroll`
--
ALTER TABLE `ENROLL`
  ADD CONSTRAINT `ENROLL_FK1` FOREIGN KEY (`LIST_ID`) REFERENCES `list` (`LIST_ID`),
  ADD CONSTRAINT `ENROLL_FK2` FOREIGN KEY (`ACTIVITY_ID`) REFERENCES `activity` (`ACTIVITY_ID`);

--
-- Constraints for table `hike`
--
ALTER TABLE `HIKE`
  ADD CONSTRAINT `hike_ibfk_1` FOREIGN KEY (`ACTIVITY_ID`) REFERENCES `activity` (`ACTIVITY_ID`);

--
-- Constraints for table `list`
--
ALTER TABLE `LIST`
  ADD CONSTRAINT `ACTIVITY_FK1` FOREIGN KEY (`CUST_ID`) REFERENCES `customer` (`CUST_ID`);

--
-- Constraints for table `movie`
--
ALTER TABLE `MOVIE`
  ADD CONSTRAINT `movie_ibfk_1` FOREIGN KEY (`ACTIVITY_ID`) REFERENCES `activity` (`ACTIVITY_ID`);

--
-- Constraints for table `rent`
--
ALTER TABLE `RENT`
  ADD CONSTRAINT `RENT_FK1` FOREIGN KEY (`CUST_ID`) REFERENCES `customer` (`CUST_ID`),
  ADD CONSTRAINT `RENT_FK2` FOREIGN KEY (`RC_VIN`) REFERENCES `rentalcar` (`RC_VIN`);

--
-- Constraints for table `restaurant`
--
ALTER TABLE `RESTAURANT`
  ADD CONSTRAINT `restaurant_ibfk_1` FOREIGN KEY (`ACTIVITY_ID`) REFERENCES `activity` (`ACTIVITY_ID`);

--
-- Constraints for table `SHOWING`
--
ALTER TABLE `SHOWING`
  ADD CONSTRAINT `SHOWING_ibfk_1` FOREIGN KEY (`ACTIVITY_ID`) REFERENCES `activity` (`ACTIVITY_ID`),
  ADD CONSTRAINT `SHOWING_ibfk_2` FOREIGN KEY (`THEATER_ID`) REFERENCES `theater` (`THEATER_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
