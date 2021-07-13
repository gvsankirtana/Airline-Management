-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2021 at 06:26 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flight_management`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ageup` (IN `adhaar` INT(12))  UPDATE passenger_info SET P_age = year(CURRENT_DATE())-year(P_DOB) where Aadhar_No=adhaar$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `airline_info` (IN `frm` VARCHAR(30), IN `t` VARCHAR(30), IN `dte` DATE, IN `seat` INT(3), IN `cl` VARCHAR(10))  BEGIN
case cl
when 1 then Select * from airline_info_view where departure_Destination=frm and arrival_Destination=t and dept_date= dte and vacant_seats>= seat order by economy_Fare;
when 2 then Select * from airline_info_view where departure_Destination=frm and arrival_Destination=t and dept_date=dte and vacant_seats>= seat order by buisness_fare;
end case;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `all_flights` ()  SELECT * from airline$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cancelticket` (IN `adhaar` INT)  BEGIN
DELETE FROM passenger_info WHERE Aadhar_No=adhaar;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `enquiry_answer` ()  BEGIN
SELECT * FROM enquiry WHERE enquiry_answer IS NOT NULL;
End$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `enquiry_user` (IN `user` VARCHAR(20))  SELECT * FROM enquiry_user_view WHERE login_username=user$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `inserenq` (IN `title` VARCHAR(10), IN `type` VARCHAR(40), IN `descrip` VARCHAR(200), IN `username` VARCHAR(20))  INSERT INTO enquiry ( Enquiry_title, Enquiry_type,Enquiry_Description,login_username) VALUES (title,type,descrip,username)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `inserpass` (IN `adhaar` INT(12), IN `dob` INT(40), IN `email` INT(40), IN `name` INT(30), IN `gender` INT(7), IN `phone ` INT(13), IN `state` INT(10), IN `city` INT(10), IN `postal` INT(10))  INSERT INTO passenger_info ( Aadhar_No, P_DOB,P_email,P_Name,P_gender,p_phone_no,state,city,pincode) VALUES (adhaar,dob,email,name,gender,phone,state,city,postal)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `logincommon` (IN `username` VARCHAR(20), IN `pass` VARCHAR(20))  SELECT login_username,Password FROM login where login_username=username and password=pass$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `passenger_user` (IN `user` VARCHAR(20))  Select * from passenger_info where P_email =(Select email from customer where login_username=user)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pend_queries` ()  SELECT * FROM enquiry WHERE enquiry_answer IS  NULL$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `empl_answered` (`user` VARCHAR(45)) RETURNS INT(11) BEGIN
return(Select count(*) from answers where login_username=user);
End$$

CREATE DEFINER=`root`@`localhost` FUNCTION `find_employee_type` (`user` VARCHAR(20)) RETURNS INT(11) BEGIN
return(Select count(*) from airline_coordinator where login_username=(Select login_username from  login where login_username=user));
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `manage_flight` (`user` VARCHAR(20)) RETURNS INT(11) BEGIN
return(Select count(*) from manages where login_username= user);
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `passadhar` (`adhaar` INT(12)) RETURNS INT(13) BEGIN
RETURN (SELECT COUNT(Aadhar_No) FROM passenger_info WHERE Aadhar_No = adhaar);
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `passenger_count` (`email` VARCHAR(45)) RETURNS INT(11) BEGIN
return(Select count(*) from passenger_info where P_email= email);
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `passenger_enq` (`user` VARCHAR(20)) RETURNS INT(11) BEGIN
return(Select count(*) from enquiry where login_username=user);
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `passenger_enq_answered` (`user` VARCHAR(20)) RETURNS INT(11) BEGIN
return(Select count(*) from enquiry where login_username=user && enquiry_answer is null);
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `pending_answer_all` () RETURNS INT(11) begin
return(Select count(*) from enquiry where enquiry_answer is null);
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `ticket_count` (`email` VARCHAR(45)) RETURNS INT(11) BEGIN
return(Select count(*) from ticket where aadhar_no in (Select Aadhar_no from passenger_info where P_email= email));
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `airline`
--

CREATE TABLE `airline` (
  `Flight_ID` int(4) NOT NULL,
  `Reference_no` varchar(6) DEFAULT NULL,
  `economy_Fare` double(7,2) DEFAULT NULL,
  `buisness_fare` double(8,2) DEFAULT NULL,
  `vacant_seats` int(3) DEFAULT 100,
  `dept_Time` time DEFAULT NULL,
  `dept_date` date DEFAULT NULL,
  `departure_Destination` varchar(30) DEFAULT NULL,
  `arrival_time` time DEFAULT NULL,
  `arrival_date` date DEFAULT NULL,
  `arrival_destination` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `airline`
--

INSERT INTO `airline` (`Flight_ID`, `Reference_no`, `economy_Fare`, `buisness_fare`, `vacant_seats`, `dept_Time`, `dept_date`, `departure_Destination`, `arrival_time`, `arrival_date`, `arrival_destination`) VALUES
(1114, 'WY233', 3400.00, 12999.00, 220, '22:00:00', '2021-05-02', 'Chennai', '00:00:23', '2021-05-02', 'Mumbai'),
(1220, 'WY133', 4200.00, 7999.00, 318, '23:30:00', '2021-05-03', 'Lucknow', '01:00:00', '2021-05-04', 'Chennai'),
(1234, 'WY233', 3200.00, 9999.00, 220, '22:00:00', '2021-05-01', 'Mumbai', '23:45:00', '2021-05-01', 'Chennai'),
(1235, 'WY222', 3900.00, 8900.00, 300, '14:00:00', '2021-04-28', 'Bengaluru', '16:15:00', '2021-04-28', 'Chennai'),
(1444, 'AI234', 1400.00, 7899.00, 200, '12:00:00', '2021-05-02', 'Mumbai', '00:00:23', '2021-05-02', 'Chennai'),
(3114, 'MS234', 1400.00, 7899.00, 200, '12:00:00', '2021-05-01', 'Chennai', '00:00:23', '2021-05-01', 'Mumbai'),
(3234, 'WY203', 2200.00, 7999.00, 210, '14:00:00', '2021-05-01', 'Mumbai', '00:00:16', '2021-05-01', 'Chennai'),
(3333, 'WY449', 2120.00, 12120.00, 100, '04:29:00', '2021-04-29', 'Surat', '06:29:00', '2021-04-30', ' Delhi'),
(4114, 'MS234', 1400.00, 7899.00, 200, '12:00:00', '2021-05-01', 'Lucknow', '00:00:23', '2021-05-01', 'Mumbai'),
(4414, 'AI234', 1400.00, 7899.00, 200, '12:00:00', '2021-05-01', 'Lucknow', '00:00:23', '2021-05-01', 'Chennai'),
(4444, 'AI234', 1400.00, 7899.00, 198, '12:00:00', '2021-05-01', 'Mumbai', '00:00:23', '2021-05-01', 'Chennai'),
(8898, 'WY990', 2120.00, 12120.00, 200, '00:07:00', '2021-04-15', 'Thiruvananthapuram', '02:07:00', '2021-04-24', ' Kolkata'),
(9999, 'AI234', 2120.00, 12120.00, 100, '03:13:00', '2021-05-08', 'Jaipur', '07:13:00', '2021-05-08', ' Mumbai');

-- --------------------------------------------------------

--
-- Table structure for table `airline_coordinator`
--

CREATE TABLE `airline_coordinator` (
  `Emp_name` varchar(20) DEFAULT NULL,
  `salary` double(7,2) DEFAULT NULL,
  `gender` varchar(7) DEFAULT NULL,
  `phone_no` varchar(13) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `Date_of_join` date DEFAULT NULL,
  `Role` varchar(20) DEFAULT NULL,
  `Login_username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `airline_coordinator`
--

INSERT INTO `airline_coordinator` (`Emp_name`, `salary`, `gender`, `phone_no`, `email`, `Date_of_join`, `Role`, `Login_username`) VALUES
('Krithikha', 99999.99, 'Female', '8656765432', 'krithikha23@gmail.com', '2021-04-23', 'Admin', 'admin1'),
('Ritz', 4499.99, 'Female', '8656765432', 'rithikha23@gmail.com', '2021-04-23', 'Admin', 'admin2');

-- --------------------------------------------------------

--
-- Stand-in structure for view `airline_info_view`
-- (See below for the actual view)
--
CREATE TABLE `airline_info_view` (
`Flight_ID` int(4)
,`Reference_no` varchar(6)
,`economy_Fare` double(7,2)
,`buisness_fare` double(8,2)
,`vacant_seats` int(3)
,`dept_Time` time
,`dept_date` date
,`departure_Destination` varchar(30)
,`arrival_time` time
,`arrival_date` date
,`arrival_destination` varchar(30)
,`Airline_name` varchar(30)
);

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `Login_username` varchar(20) NOT NULL,
  `enquiry_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`Login_username`, `enquiry_id`) VALUES
('care1', 7),
('care1', 22),
('care2', 12),
('care2', 28),
('care2', 29);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `login_username` varchar(20) NOT NULL,
  `Flight_ID` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`login_username`, `Flight_ID`) VALUES
('aish17', 3234),
('aish17', 4444),
('deepa k', 1220);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Cust_name` varchar(25) DEFAULT NULL,
  `gender` varchar(7) DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `phone_number` varchar(12) DEFAULT NULL,
  `login_username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Cust_name`, `gender`, `email`, `phone_number`, `login_username`) VALUES
('Aishwarya', 'female', 'aishwarya@gmail', '123456', 'aish17'),
('Ashwin', 'male', 'ashwin@gmail.com', '23232323', 'Ashwin'),
('Deepa', 'female', 'deepak@gmail.com', '1212344442', 'deepa k'),
('mahi', 'female', 'snitr2002@yahoo.com', '8610284988', 'mah'),
('mahitha', 'female', 'mahi@gmail.com', '12323232', 'mahi'),
('Ram Kumar', 'male', 'ramkumar@gmail.com', '1232432231', 'Ram'),
('hh', 'male', 'qwefge@gmil.com', '123', 'sanki');

--
-- Triggers `customer`
--
DELIMITER $$
CREATE TRIGGER `delete_cust` AFTER DELETE ON `customer` FOR EACH ROW BEGIN
Delete from enquiry where login_username=OLD.login_username;
Delete from login where Login_username=OLD.login_username;
Delete from booking where login_username=OLD.login_username;
Delete from passenger_info where P_email in (Select email from customer where login_username=OLD.login_username);
Delete from ticket where aadhar_no in (Select Aadhar_No  from passenger_info where P_email =(Select email from customer where login_username=OLD.login_username));
End
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `customer_care_agent`
--

CREATE TABLE `customer_care_agent` (
  `Emp_name` varchar(20) DEFAULT NULL,
  `salary` double(7,2) DEFAULT NULL,
  `gender` varchar(7) DEFAULT NULL,
  `phone_no` varchar(13) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `Date_of_join` date DEFAULT NULL,
  `login_username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_care_agent`
--

INSERT INTO `customer_care_agent` (`Emp_name`, `salary`, `gender`, `phone_no`, `email`, `Date_of_join`, `login_username`) VALUES
('Sankirtana', 2000.00, 'Female', '999123234', 'sanki@gmail.com', '2021-04-24', 'care2');

-- --------------------------------------------------------

--
-- Table structure for table `enquiry`
--

CREATE TABLE `enquiry` (
  `Enquiry_ID` int(8) NOT NULL,
  `Enquiry_type` varchar(10) DEFAULT NULL,
  `Enquiry_title` varchar(40) NOT NULL,
  `Enquiry_Description` varchar(200) NOT NULL,
  `enquiry_answer` varchar(200) DEFAULT NULL,
  `login_username` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enquiry`
--

INSERT INTO `enquiry` (`Enquiry_ID`, `Enquiry_type`, `Enquiry_title`, `Enquiry_Description`, `enquiry_answer`, `login_username`) VALUES
(7, 'Complaint ', 'Feedback', 'dieeeeeee', 'Ok sir!', 'aish17'),
(8, 'Complaint ', 'Feedback', 'dieeeeeee', 'die', 'aish17'),
(9, 'Complaint ', 'Feedback', 'dieeeeeee', 'hi', 'aish17'),
(10, 'Complaint ', 'Feedback', 'dieeeeeee', 'ok bye', 'aish17'),
(11, 'Complaint ', 'Feedback', 'dieeeeeee', NULL, 'aish17'),
(12, 'Complaint ', 'Feedback', 'dieeeeeee', 'ok', 'aish17'),
(13, 'krith', 'Feedback', 'qqqqqqqqqqqqq', NULL, 'aish17'),
(14, 'krith', 'Feedback', 'qqqqqqqqqqqqq', NULL, 'aish17'),
(21, 'Complaint ', 'complaint', 'what to asl', NULL, 'deepa k'),
(22, 'qw', 'Question', 'what to ask', 'Anything sir!!!', 'deepa k'),
(23, 'qw', 'Question', 'what to ask', NULL, 'deepa k'),
(24, 'qw', 'Question', 'what to ask', NULL, 'deepa k'),
(28, 'Question', 'hello', 'when will flight come', 'Tommorow', 'deepa k'),
(29, 'Question', 'hello', 'when will flight come', 'Tommorowwwww', 'deepa k'),
(32, 'complaint', 'nice quest', 'nice', NULL, 'aish17'),
(37, 'Feedback', 'nice quest', 'hello', NULL, 'aish17');

-- --------------------------------------------------------

--
-- Stand-in structure for view `enquiry_user_view`
-- (See below for the actual view)
--
CREATE TABLE `enquiry_user_view` (
`enquiry_title` varchar(40)
,`Enquiry_type` varchar(10)
,`Enquiry_Description` varchar(200)
,`enquiry_answer` varchar(200)
,`login_username` varchar(20)
);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `Login_username` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Contains all login data of customers and employees';

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`Login_username`, `Password`) VALUES
('admin1', 'Admin1'),
('admin2', 'Admin2'),
('aish17', 'aish'),
('Ashwin', 'Ashwin24'),
('care1', 'Care1'),
('care2', 'Care2'),
('deepa k', 'deepa'),
('mah', 'mah'),
('mahi', 'mahi1'),
('Ram', 'cust'),
('sanki', '68');

-- --------------------------------------------------------

--
-- Table structure for table `manages`
--

CREATE TABLE `manages` (
  `Login_username` varchar(20) NOT NULL,
  `Flight_ID` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manages`
--

INSERT INTO `manages` (`Login_username`, `Flight_ID`) VALUES
('admin1', 0),
('admin1', 1234),
('admin1', 3232),
('admin1', 3333),
('admin1', 8898),
('admin1', 9898),
('admin1', 9999);

-- --------------------------------------------------------

--
-- Table structure for table `passenger_info`
--

CREATE TABLE `passenger_info` (
  `Aadhar_No` int(12) NOT NULL,
  `P_DOB` date DEFAULT NULL,
  `P_email` varchar(40) NOT NULL,
  `P_Name` varchar(30) NOT NULL,
  `P_gender` varchar(7) DEFAULT NULL,
  `P_age` int(3) DEFAULT NULL,
  `p_phone_no` varchar(13) DEFAULT NULL,
  `state` varchar(10) DEFAULT NULL,
  `city` varchar(10) DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL
) ;

--
-- Dumping data for table `passenger_info`
--

INSERT INTO `passenger_info` (`Aadhar_No`, `P_DOB`, `P_email`, `P_Name`, `P_gender`, `P_age`, `p_phone_no`, `state`, `city`, `pincode`) VALUES
(2345, '2021-04-06', 'aishwarya@gmail', 'byg', 'Female', 0, '123456', 'Tamil Nadu', 'Chennai', '600102'),
(121212, '2021-04-06', 'aishwarya@gmail', 'Ram', 'Female', 20, '123456', 'Tamil Nadu', 'Chennai', '600102'),
(555555, '2021-05-28', 'aishwarya@gmail', 'Mahitha', 'Female', 0, '123456', 'Tamil Nadu', 'Chennai', '600102'),
(1234567, '2016-11-18', 'aishwarya@gmail', 'xyz', 'Female', 5, '123456', 'Tamil Nadu', 'Chennai', '600102'),
(4444444, '2021-04-14', 'aishwarya@gmail', 'saas', 'Female', 0, '123456', 'Tamil Nadu', 'Chennai', '600102'),
(12131329, '2021-04-15', 'aishwarya@gmail', 'NITHISH KUMAR S', 'Male', 0, '123456', 'Haryana', 'Thanjavur', '613005'),
(999999999, '2021-04-06', 'deepak@gmail.com', 'deepan ', 'Male', 20, '1212344442', 'Tamil Nadu', 'Chennai', '600102'),
(2147483647, '2021-04-16', 'aishwarya@gmail', 'Krithikha Bala', 'Female', 0, '123456', 'Tamil Nadu', 'Chennai', '600102');

--
-- Triggers `passenger_info`
--
DELIMITER $$
CREATE TRIGGER `delete_passenger` AFTER DELETE ON `passenger_info` FOR EACH ROW BEGIN
Delete from ticket where Aadhar_No=old.Aadhar_no;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `reference_flight_no`
--

CREATE TABLE `reference_flight_no` (
  `Reference_no` varchar(6) NOT NULL,
  `Flight_Type` varchar(20) DEFAULT NULL,
  `Airline_name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reference_flight_no`
--

INSERT INTO `reference_flight_no` (`Reference_no`, `Flight_Type`, `Airline_name`) VALUES
('AI234', 'Boeing 747-8', 'Indian Airlines'),
('MS234', 'Boeing 747-8', 'Mirchi Airlines'),
('WY133', 'Boeing 737', 'Indigo'),
('WY203', 'Airbus A350', 'Mirchi Airlines'),
('WY222', 'Airbus A380', 'Indian Airways'),
('WY223', 'International', 'Indian Airways'),
('WY233', 'Airbus A350', 'Indian Airways'),
('WY443', 'Domestic', 'Indian Airways'),
('WY449', 'Domestic', 'Indian Airways'),
('WY990', 'Airbus A320', 'Bharat Airlines');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `Class` varchar(20) DEFAULT NULL,
  `Booking_Ref` varchar(8) DEFAULT NULL,
  `Seat_No` int(3) DEFAULT NULL,
  `payment_Type` varchar(15) DEFAULT NULL,
  `booking_time` time DEFAULT NULL,
  `booking_date` date DEFAULT NULL,
  `account_No` varchar(10) DEFAULT NULL,
  `Bank_name` varchar(30) DEFAULT NULL,
  `flight_ID` int(4) NOT NULL,
  `aadhar_no` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`Class`, `Booking_Ref`, `Seat_No`, `payment_Type`, `booking_time`, `booking_date`, `account_No`, `Bank_name`, `flight_ID`, `aadhar_no`) VALUES
('Economy', '1220#999', NULL, 'UPI', '11:57:46', '2021-04-25', '1232323', 'hdfc', 1220, 999999999),
('Economy', '3234#234', NULL, 'UPI', '13:32:53', '2021-04-26', '23344455', 'axis', 3234, 2345),
('Economy', '3234#123', NULL, 'UPI', '13:32:53', '2021-04-26', '23344455', 'axis', 3234, 1234567),
('Economy', '3234#121', NULL, 'UPI', '08:03:55', '2021-04-27', NULL, NULL, 3234, 12131329),
('Economy', '3234#111', NULL, 'UPI', '08:03:55', '2021-04-27', NULL, NULL, 3234, 2147483647),
('Economy', '4444#234', NULL, 'UPI', '23:53:18', '2021-04-26', NULL, NULL, 4444, 2345),
('Economy', '4444#121', NULL, 'UPI', '23:53:18', '2021-04-26', NULL, NULL, 4444, 121212),
('Economy', '4444#232', NULL, 'UPI', '13:27:18', '2021-04-26', '1232323', 'hdfc', 4444, 232323),
('Economy', '4444#555', NULL, 'UPI', '13:27:17', '2021-04-26', '1232323', 'hdfc', 4444, 555555);

-- --------------------------------------------------------

--
-- Structure for view `airline_info_view`
--
DROP TABLE IF EXISTS `airline_info_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `airline_info_view`  AS SELECT `airline`.`Flight_ID` AS `Flight_ID`, `airline`.`Reference_no` AS `Reference_no`, `airline`.`economy_Fare` AS `economy_Fare`, `airline`.`buisness_fare` AS `buisness_fare`, `airline`.`vacant_seats` AS `vacant_seats`, `airline`.`dept_Time` AS `dept_Time`, `airline`.`dept_date` AS `dept_date`, `airline`.`departure_Destination` AS `departure_Destination`, `airline`.`arrival_time` AS `arrival_time`, `airline`.`arrival_date` AS `arrival_date`, `airline`.`arrival_destination` AS `arrival_destination`, `reference_flight_no`.`Airline_name` AS `Airline_name` FROM (`airline` join `reference_flight_no` on(`airline`.`Reference_no` = `reference_flight_no`.`Reference_no`)) ;

-- --------------------------------------------------------

--
-- Structure for view `enquiry_user_view`
--
DROP TABLE IF EXISTS `enquiry_user_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `enquiry_user_view`  AS SELECT `enquiry`.`Enquiry_title` AS `enquiry_title`, `enquiry`.`Enquiry_type` AS `Enquiry_type`, `enquiry`.`Enquiry_Description` AS `Enquiry_Description`, `enquiry`.`enquiry_answer` AS `enquiry_answer`, `enquiry`.`login_username` AS `login_username` FROM `enquiry` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airline`
--
ALTER TABLE `airline`
  ADD PRIMARY KEY (`Flight_ID`),
  ADD KEY `Reference_no` (`Reference_no`);

--
-- Indexes for table `airline_coordinator`
--
ALTER TABLE `airline_coordinator`
  ADD PRIMARY KEY (`Login_username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`Login_username`,`enquiry_id`),
  ADD KEY `enquiry_id` (`enquiry_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`login_username`,`Flight_ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`login_username`),
  ADD UNIQUE KEY `email` (`email`) USING BTREE;

--
-- Indexes for table `customer_care_agent`
--
ALTER TABLE `customer_care_agent`
  ADD PRIMARY KEY (`login_username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `enquiry`
--
ALTER TABLE `enquiry`
  ADD PRIMARY KEY (`Enquiry_ID`),
  ADD KEY `login_username` (`login_username`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`Login_username`);

--
-- Indexes for table `manages`
--
ALTER TABLE `manages`
  ADD PRIMARY KEY (`Flight_ID`,`Login_username`);

--
-- Indexes for table `passenger_info`
--
ALTER TABLE `passenger_info`
  ADD PRIMARY KEY (`Aadhar_No`);

--
-- Indexes for table `reference_flight_no`
--
ALTER TABLE `reference_flight_no`
  ADD PRIMARY KEY (`Reference_no`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`flight_ID`,`aadhar_no`),
  ADD KEY `aadhar_no` (`aadhar_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `enquiry`
--
ALTER TABLE `enquiry`
  MODIFY `Enquiry_ID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `airline`
--
ALTER TABLE `airline`
  ADD CONSTRAINT `airline_ibfk_1` FOREIGN KEY (`Reference_no`) REFERENCES `reference_flight_no` (`Reference_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `airline_coordinator`
--
ALTER TABLE `airline_coordinator`
  ADD CONSTRAINT `airline_coordinator_ibfk_1` FOREIGN KEY (`Login_username`) REFERENCES `login` (`Login_username`);

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`enquiry_id`) REFERENCES `enquiry` (`Enquiry_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`Login_username`) REFERENCES `login` (`Login_username`);

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`login_username`) REFERENCES `login` (`Login_username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`login_username`) REFERENCES `login` (`Login_username`);

--
-- Constraints for table `customer_care_agent`
--
ALTER TABLE `customer_care_agent`
  ADD CONSTRAINT `customer_care_agent_ibfk_1` FOREIGN KEY (`login_username`) REFERENCES `login` (`Login_username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `enquiry`
--
ALTER TABLE `enquiry`
  ADD CONSTRAINT `enquiry_ibfk_1` FOREIGN KEY (`login_username`) REFERENCES `login` (`Login_username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`flight_ID`) REFERENCES `airline` (`Flight_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
