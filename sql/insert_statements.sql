INSERT INTO `ACTIVITY` VALUES ('1', 'Old Rag Mountain Loop', '2021-01-01', '2022-01-31', 'HIKE', 'https://www.alltrails.com/trail/us/virginia/old-rag-mountain-loop-trail')
INSERT INTO `ACTIVITY` VALUES ('2', 'Humpback Rocks Hike', '2021-01-02', '2022-02-01', 'HIKE', 'https://www.hikingupward.com/maps/detail.asp?RID=218')
INSERT INTO `ACTIVITY` VALUES ('3', 'Riprap Trail', '2021-01-03', '2022-02-02', 'HIKE', 'https://www.alltrails.com/trail/us/virginia/riprap-trail')
INSERT INTO `ACTIVITY` VALUES ('4', 'Public Fish & Oyster', '2021-01-04', '2022-02-03', 'RESTAURANT', 'http://publicfo.com/')
INSERT INTO `ACTIVITY` VALUES ('5', 'Red Hub', '2021-01-05', '2022-02-04', 'RESTAURANT', 'https://www.redhubfoodco.com/')
INSERT INTO `ACTIVITY` VALUES ('6', 'Kardinal Hall', '2021-01-06', '2022-02-05', 'RESTAURANT', 'https://kardinalhall.com/')
INSERT INTO `ACTIVITY` VALUES ('7', 'Legally Blond', '2021-01-07', '2022-02-06', 'MOVIE', 'https://www.imdb.com/title/tt0250494/')
INSERT INTO `ACTIVITY` VALUES ('8', 'Spirit Untamed', '2021-01-08', '2022-02-07', 'MOVIE', 'https://www.imdb.com/title/tt11084896/')
INSERT INTO `ACTIVITY` VALUES ('9', 'The Sparks Brothers', '2021-01-09', '2022-02-08', 'MOVIE', 'https://www.imdb.com/title/tt8610436/')

INSERT INTO `EMPLOYEE` VALUES ('1', 'Tom', 'Hiddleston', '333', '4445555', 'Agent', 'thiddle@gmail.com')
INSERT INTO `EMPLOYEE` VALUES ('2', 'Tom', 'Holland', '222', '3334444', 'Agent', 'tomholland123@gmail.com')
INSERT INTO `EMPLOYEE` VALUES ('3', 'Jennifer', 'Lawrence', '111', '444555', 'Manager', 'therealjenniferlawrence@outlook.com')

INSERT INTO `HOTEL` VALUES ('1', 'Red Roof Inn', '101', '50', '17', '2011 Holiday Drive', '22901')
INSERT INTO `HOTEL` VALUES ('2', 'Graduate', '439', '30', '15', '1309 W Main St', '22903')
INSERT INTO `HOTEL` VALUES ('3', 'Oakhurst Inn', '339', '12', '11', '100 Oakhurst Circle', '22903')

INSERT INTO `RENTALCAR` VALUES ('1', 'GMC', 'Yukon', '261', '0', 'Black', '7', 'Hertz', 'Automatic', '1900 Rio Hill Center, Charlottesville, USA')
INSERT INTO `RENTALCAR` VALUES ('2', 'Mitsubishi', 'Mirage', '64', '1', 'Grey', '4', 'Enterprise', 'Automatic', '1650 Seminole Trl, Charlottesville, USA')
INSERT INTO `RENTALCAR` VALUES ('3', 'Chrysler ', '300', '124', '1', 'White', '5', 'Enterprise', 'Automatic', 'CHO Airport, Charlottesville, Virginia')
INSERT INTO `CUSTOMER` VALUES ('1', 'Harry', 'Potter', '123', '4567890', '4 Privet Drive', '22105', '2', '1')
INSERT INTO `CUSTOMER` VALUES ('2', 'Hermione', 'Granger', '980', '8765432', '1111 Hogwarts Rd', '12345', '3', '2')
INSERT INTO `CUSTOMER` VALUES ('3', 'Ron', 'Weasley', '111', '2223333', '1112 Hogwarts Rd', '12345', '3', '2')

INSERT INTO `LIST` VALUES ('1', '1', 'Harry\'s magical adventure')
INSERT INTO `LIST` VALUES ('2', '2', 'Vacation, June 2021')
INSERT INTO `LIST` VALUES ('3', '3', 'Fall 2021 family trip')

INSERT INTO `RENT` (`CUSTOMER_ID`, `RC_VIN`, `RENT_STARTDATE`, `RENT_ENDDATE`) VALUES ('1', '3', NULL, NULL), ('2', '2', NULL, NULL), ('3', '1', NULL, NULL);

INSERT INTO `ENROLL` (`LIST_ID`, `ACTIVITY_ID`) VALUES ('3', '2'), ('1', '6'), ('2', '9')
