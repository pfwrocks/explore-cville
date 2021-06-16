-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 13, 2021 at 07:36 PM
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
DROP TABLE `SHOWING`, `THEATER`, `MOVIE`, `HIKE`, `RESTAURANT`, `ENROLL`, `ACTIVITY`, `LIST`, `CUSTOMER`, `RENTALCAR`, `HOTEL`, `EMPLOYEE`;
-- --------------------------------------------------------

--
-- Table structure for table `ACTIVITY`
--

CREATE TABLE `ACTIVITY` (
  `ACTIVITY_ID` int(11) NOT NULL,
  `ACTIVITY_NAME` text NOT NULL,
  `ACTIVITY_TYPE` varchar(12) NOT NULL,
  `ACTIVITY_URL` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ACTIVITY`
--

INSERT INTO `ACTIVITY` (`ACTIVITY_ID`, `ACTIVITY_NAME`, `ACTIVITY_TYPE`, `ACTIVITY_URL`) VALUES
(1, 'Old Rag Mountain Loop', 'HIKE', 'https://www.alltrails.com/trail/us/virginia/old-rag-mountain-loop-trail'),
(2, 'Humpback Rocks Hike', 'HIKE', 'https://www.hikingupward.com/maps/detail.asp?RID=218'),
(3, 'Riprap Trail', 'HIKE', 'https://www.alltrails.com/trail/us/virginia/riprap-trail'),
(4, 'Public Fish & Oyster', 'RESTAURANT', 'http://publicfo.com/'),
(5, 'Red Hub', 'RESTAURANT', 'https://www.redhubfoodco.com/'),
(6, 'Kardinal Hall', 'RESTAURANT', 'https://kardinalhall.com/'),
(7, 'Legally Blonde', 'MOVIE', 'https://www.imdb.com/title/tt0250494/'),
(8, 'Spirit Untamed', 'MOVIE', 'https://www.imdb.com/title/tt11084896/'),
(9, 'The Sparks Brothers', 'MOVIE', 'https://www.imdb.com/title/tt8610436/');

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
  `CUST_STREET` varchar(100) NOT NULL,
  `CUST_CITY` varchar(20) NOT NULL,
  `CUST_STATE` varchar(3) NOT NULL,
  `CUST_ZIP` int(11) NOT NULL,
  `HOTEL_ID` int(11) DEFAULT NULL,
  `EMPLOYEE_ID` int(11) DEFAULT NULL,
  `RC_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `CUSTOMER`
--

INSERT INTO `CUSTOMER` (`CUST_ID`, `CUST_FNAME`, `CUST_LNAME`, `CUST_AREACODE`, `CUST_PHONE`, `CUST_STREET`, `CUST_CITY`, `CUST_STATE`, `CUST_ZIP`, `HOTEL_ID`, `EMPLOYEE_ID`, `RC_ID`) VALUES
(1, 'Harry', 'Potter', 123, 4567890, '4 Privet Drive', 'Watford', 'VA', 22105, 2, 1, 2),
(2, 'Hermione', 'Granger', 980, 8765432, '1111 Hogwarts Rd', 'Burlington', 'VT', 12345, 3, 1, 1),
(3, 'Ron', 'Weasley', 111, 2223333, '1112 Hogwarts Rd', 'Burtlington', 'VT', 12345, 3, 2, 3);

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
(1, 8),
(2, 9),
(3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `HIKE`
--

CREATE TABLE `HIKE` (
  `ACTIVITY_ID` int(11) NOT NULL,
  `HIKE_DIFFICULTY` varchar(15) NOT NULL,
  `HIKE_LENGTH` varchar(5) NOT NULL,
  `HIKE_TOPO_GAIN` varchar(11) NOT NULL,
  `HIKE_STREET` varchar(50) NOT NULL,
  `HIKE_CITY` varchar(20) NOT NULL,
  `HIKE_STATE` varchar(3) NOT NULL,
  `HIKE_ZIP` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `HIKE`
--

INSERT INTO `HIKE` (`ACTIVITY_ID`, `HIKE_DIFFICULTY`, `HIKE_LENGTH`, `HIKE_TOPO_GAIN`, `HIKE_STREET`, `HIKE_CITY`, `HIKE_STATE`, `HIKE_ZIP`) VALUES
(1, 'Hard', '9.5', '2683', 'State Rte 600', 'Etlan', 'VA', '22719'),
(2, 'Moderate', '4.0', '1240', 'Humpback Gap Overlook', 'Afton', 'VA', '22920'),
(3, 'Hard', '9.3', '2116', 'Wildcat Ridge Parking Area', 'Crimora', 'VA', '24431');

-- --------------------------------------------------------

--
-- Table structure for table `HOTEL`
--

CREATE TABLE `HOTEL` (
  `HOTEL_ID` int(11) NOT NULL,
  `HOTEL_NAME` varchar(100) NOT NULL,
  `HOTEL_STREET` varchar(50) NOT NULL,
  `HOTEL_CITY` varchar(20) NOT NULL,
  `HOTEL_STATE` varchar(3) NOT NULL,
  `HOTEL_ZIP` varchar(10) NOT NULL,
  `HOTEL_AREACODE` int(3) NOT NULL,
  `HOTEL_PHONE` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `HOTEL`
--

INSERT INTO `HOTEL` (`HOTEL_ID`, `HOTEL_NAME`, `HOTEL_STREET`, `HOTEL_CITY`, `HOTEL_STATE`, `HOTEL_ZIP`, `HOTEL_AREACODE`, `HOTEL_PHONE`) VALUES
(1, 'Red Roof Inn', '2011 Holiday Drive', 'Charlottesville', 'VA', '22901', 703, 222222),
(2, 'Graduate', '1309 W Main St', 'Charlottesville', 'VA', '22903', 0, 333333),
(3, 'Oakhurst Inn', '100 Oakhurst Circle', 'Charlottesville', 'VA', '22903', 0, 444444);

-- --------------------------------------------------------

--
-- Table structure for table `LIST`
--

CREATE TABLE `LIST` (
  `LIST_ID` int(11) NOT NULL,
  `CUST_ID` int(11) DEFAULT NULL,
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
-- Table structure for table `MOVIE`
--

CREATE TABLE `MOVIE` (
  `ACTIVITY_ID` int(11) NOT NULL,
  `MOVIE_PARENT_RATING` varchar(7) NOT NULL,
  `MOVIE_GENRE` varchar(15) NOT NULL,
  `MOVIE_RATING` varchar(3) NOT NULL,
  `MOVIE_DIRECTOR` varchar(25) NOT NULL,
  `MOVIE_RELEASE_DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `MOVIE`
--

INSERT INTO `MOVIE` (`ACTIVITY_ID`, `MOVIE_PARENT_RATING`, `MOVIE_GENRE`, `MOVIE_RATING`, `MOVIE_DIRECTOR`, `MOVIE_RELEASE_DATE`) VALUES
(7, 'PG-13', 'Comedy', '5', 'Robert Luketic', '2020-07-13'),
(8, 'G', 'Family', '6.4', 'Elaine Bogan', '2021-06-04'),
(9, 'G', 'Family', '6.4', 'Elaine Bogan', '2021-06-04');

-- --------------------------------------------------------

--
-- Table structure for table `RENTALCAR`
--

CREATE TABLE `RENTALCAR` (
  `RC_ID` int(11) NOT NULL,
  `RC_MAKE` varchar(50) NOT NULL,
  `RC_MODEL` varchar(50) NOT NULL,
  `RC_COLOR` varchar(50) NOT NULL,
  `RC_SEATS` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `RENTALCAR`
--

INSERT INTO `RENTALCAR` (`RC_ID`, `RC_MAKE`, `RC_MODEL`, `RC_COLOR`, `RC_SEATS`) VALUES
(1, 'GMC', 'Yukon', 'Black', 7),
(2, 'Mitsubishi', 'Mirage', 'Grey', 4),
(3, 'Chrysler ', '300', 'White', 5);

-- --------------------------------------------------------

--
-- Table structure for table `RESTAURANT`
--

CREATE TABLE `RESTAURANT` (
  `ACTIVITY_ID` int(11) NOT NULL,
  `RESTAURANT_RATING` varchar(3) NOT NULL,
  `RESTAURANT_PRICE_RANGE` varchar(1) NOT NULL,
  `RESTAURANT_CUISINE` varchar(15) NOT NULL,
  `RESTAURANT_STREET` varchar(50) NOT NULL,
  `RESTAURANT_CITY` varchar(20) NOT NULL,
  `RESTAURANT_STATE` varchar(3) NOT NULL,
  `RESTAURANT_ZIP` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `RESTAURANT`
--

INSERT INTO `RESTAURANT` (`ACTIVITY_ID`, `RESTAURANT_RATING`, `RESTAURANT_PRICE_RANGE`, `RESTAURANT_CUISINE`, `RESTAURANT_STREET`, `RESTAURANT_CITY`, `RESTAURANT_STATE`, `RESTAURANT_ZIP`) VALUES
(4, '4.7', '3', 'Seafood', '513 West Main St', 'Charlottesville', 'VA', '22903'),
(5, '4.4', '1', 'Southern', '202 10TH ST NW', 'Charlottesville', 'VA', '22903'),
(6, '4.4', '2', 'German', '722 Preston Ave', 'Charlottesville', 'VA', '22903');

-- --------------------------------------------------------

--
-- Table structure for table `SHOWING`
--

CREATE TABLE `SHOWING` (
  `ACTIVITY_ID` int(11) NOT NULL,
  `THEATER_ID` int(11) NOT NULL,
  `SHOW_TIME` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `SHOWING`
--

INSERT INTO `SHOWING` (`ACTIVITY_ID`, `THEATER_ID`, `SHOW_TIME`) VALUES
(7, 2, '2021-06-16 19:30:00'),
(8, 1, '2021-06-27 11:00:00'),
(9, 3, '2021-06-20 15:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `THEATER`
--

CREATE TABLE `THEATER` (
  `THEATER_ID` int(11) NOT NULL,
  `THEATER_NAME` varchar(50) NOT NULL,
  `THEATER_TICK_COST` decimal(10,0) NOT NULL,
  `THEATER_STREET` varchar(50) NOT NULL,
  `THEATER_CITY` varchar(20) NOT NULL,
  `THEATER_STATE` varchar(3) NOT NULL,
  `THEATER_ZIP` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `THEATER`
--

INSERT INTO `THEATER` (`THEATER_ID`, `THEATER_NAME`, `THEATER_TICK_COST`, `THEATER_STREET`, `THEATER_CITY`, `THEATER_STATE`, `THEATER_ZIP`) VALUES
(1, 'Alamo Drafthouse Cinema Charlottesville', '12', '375 Merchant Walk Square', 'Charlottesville', 'VA', '22902'),
(2, 'Paramount Theater', '12', '215 E Main St', 'Charlottesville', 'VA', '22902'),
(3, 'Regal Stonefield & IMAX', '11', '1954 Swanson Dr', 'Charlottesville', 'VA', '22901');

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
  ADD KEY `CUST_FK2` (`EMPLOYEE_ID`),
  ADD KEY `CUST_FK3` (`RC_ID`);

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
-- Indexes for table `HIKE`
--
ALTER TABLE `HIKE`
  ADD PRIMARY KEY (`ACTIVITY_ID`);

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
-- Indexes for table `MOVIE`
--
ALTER TABLE `MOVIE`
  ADD PRIMARY KEY (`ACTIVITY_ID`);

--
-- Indexes for table `RENTALCAR`
--
ALTER TABLE `RENTALCAR`
  ADD PRIMARY KEY (`RC_ID`);

--
-- Indexes for table `RESTAURANT`
--
ALTER TABLE `RESTAURANT`
  ADD PRIMARY KEY (`ACTIVITY_ID`);

--
-- Indexes for table `SHOWING`
--
ALTER TABLE `SHOWING`
  ADD KEY `ACTIVITY_ID` (`ACTIVITY_ID`),
  ADD KEY `THEATER_ID` (`THEATER_ID`);

--
-- Indexes for table `THEATER`
--
ALTER TABLE `THEATER`
  ADD PRIMARY KEY (`THEATER_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ACTIVITY`
--
ALTER TABLE `ACTIVITY`
  MODIFY `ACTIVITY_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
-- AUTO_INCREMENT for table `RENTALCAR`
--
ALTER TABLE `RENTALCAR`
  MODIFY `RC_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `THEATER`
--
ALTER TABLE `THEATER`
  MODIFY `THEATER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `CUSTOMER`
--
ALTER TABLE `CUSTOMER`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`EMPLOYEE_ID`) REFERENCES `EMPLOYEE` (`EMPLOYEE_ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_ibfk_2` FOREIGN KEY (`HOTEL_ID`) REFERENCES `HOTEL` (`HOTEL_ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_ibfk_3` FOREIGN KEY (`RC_ID`) REFERENCES `RENTALCAR` (`RC_ID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `ENROLL`
--
ALTER TABLE `ENROLL`
  ADD CONSTRAINT `enroll_ibfk_1` FOREIGN KEY (`ACTIVITY_ID`) REFERENCES `ACTIVITY` (`ACTIVITY_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `enroll_ibfk_2` FOREIGN KEY (`LIST_ID`) REFERENCES `LIST` (`LIST_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `HIKE`
--
ALTER TABLE `HIKE`
  ADD CONSTRAINT `hike_ibfk_1` FOREIGN KEY (`ACTIVITY_ID`) REFERENCES `ACTIVITY` (`ACTIVITY_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `LIST`
--
ALTER TABLE `LIST`
  ADD CONSTRAINT `list_ibfk_1` FOREIGN KEY (`CUST_ID`) REFERENCES `CUSTOMER` (`CUST_ID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `MOVIE`
--
ALTER TABLE `MOVIE`
  ADD CONSTRAINT `movie_ibfk_1` FOREIGN KEY (`ACTIVITY_ID`) REFERENCES `ACTIVITY` (`ACTIVITY_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `RESTAURANT`
--
ALTER TABLE `RESTAURANT`
  ADD CONSTRAINT `restaurant_ibfk_1` FOREIGN KEY (`ACTIVITY_ID`) REFERENCES `ACTIVITY` (`ACTIVITY_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `SHOWING`
--
ALTER TABLE `SHOWING`
  ADD CONSTRAINT `showing_ibfk_1` FOREIGN KEY (`ACTIVITY_ID`) REFERENCES `ACTIVITY` (`ACTIVITY_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `showing_ibfk_2` FOREIGN KEY (`THEATER_ID`) REFERENCES `THEATER` (`THEATER_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
