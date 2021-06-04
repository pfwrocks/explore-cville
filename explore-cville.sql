-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 04, 2021 at 06:10 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.26

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
  `ACTIVITY_NAME` varchar(50) NOT NULL,
  `ACTIVITY_OPENTIME` date NOT NULL,
  `ACTIVITY_CLOSETIME` date NOT NULL,
  `ACTIVITY_TYPE` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `HOTEL_ID` int(11) NOT NULL,
  `EMPLOYEE_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `ENROLL`
--

CREATE TABLE `ENROLL` (
  `LIST_ID` int(11) NOT NULL,
  `ACTIVITY_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `HOTEL_CITY` varchar(50) NOT NULL,
  `HOTEL_STATE` varchar(50) NOT NULL,
  `HOTEL_ZIP` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `LIST`
--

CREATE TABLE `LIST` (
  `LIST_ID` int(11) NOT NULL,
  `CUST_ID` int(11) NOT NULL,
  `LIST_NAME` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `RENT`
--

CREATE TABLE `RENT` (
  `CUSTOMER_ID` int(11) NOT NULL,
  `RC_VIN` int(11) NOT NULL,
  `RENT_STARTDATE` date NOT NULL,
  `RENT_ENDDATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `RC_COLOR` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  MODIFY `ACTIVITY_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `CUSTOMER`
--
ALTER TABLE `CUSTOMER`
  MODIFY `CUST_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EMPLOYEE`
--
ALTER TABLE `EMPLOYEE`
  MODIFY `EMPLOYEE_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `HOTEL`
--
ALTER TABLE `HOTEL`
  MODIFY `HOTEL_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `LIST`
--
ALTER TABLE `LIST`
  MODIFY `LIST_ID` int(11) NOT NULL AUTO_INCREMENT;

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
