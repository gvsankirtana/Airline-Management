-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2021 at 02:21 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `airline`
--

CREATE TABLE `airline` (
  `Flight_ID` int(4) NOT NULL,
  `Flight_Type` varchar(20) DEFAULT NULL,
  `Airline_name` varchar(30) DEFAULT NULL,
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

INSERT INTO `airline` (`Flight_ID`, `Flight_Type`, `Airline_name`, `Reference_no`, `economy_Fare`, `buisness_fare`, `vacant_seats`, `dept_Time`, `dept_date`, `departure_Destination`, `arrival_time`, `arrival_date`, `arrival_destination`) VALUES
(1220, 'Boeing 737', 'Indigo', 'WY133', 4200.00, 7999.00, 320, '23:30:00', '2021-05-03', 'Lucknow', '01:00:00', '2021-05-04', 'Chennai'),
(1234, 'Airbus A350', 'Indian Airways', 'WY233', 3200.00, 9999.00, 220, '22:00:00', '2021-05-01', 'Mumbai', '23:45:00', '2021-05-01', 'Chennai'),
(1235, 'Airbus A380', 'Indian Airways', 'WY222', 3900.00, 8900.00, 300, '14:00:00', '2021-04-28', 'Bengaluru', '16:15:00', '2021-04-28', 'Chennai'),
(3234, 'Airbus A350', 'Mirchi Airlines', 'WY203', 2200.00, 7999.00, 220, '14:00:00', '2021-05-01', 'Mumbai', '00:00:16', '2021-05-01', 'Chennai');

-- --------------------------------------------------------

--
-- Table structure for table `airline_coordinator`
--

CREATE TABLE `airline_coordinator` (
  `Emp_ID` int(4) NOT NULL,
  `Emp_name` varchar(20) DEFAULT NULL,
  `salary` double(7,2) DEFAULT NULL,
  `gender` varchar(7) DEFAULT NULL,
  `phone_no` varchar(13) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `Date_of_join` date DEFAULT NULL,
  `Role` varchar(20) DEFAULT NULL,
  `login_username` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Stand-in structure for view `airline_view`
-- (See below for the actual view)
--
CREATE TABLE `airline_view` (
`Flight_ID` int(4)
,`Airline_name` varchar(30)
,`economy_Fare` double(7,2)
,`buisness_fare` double(8,2)
,`dept_Time` time
,`dept_date` date
,`departure_Destination` varchar(30)
,`arrival_destination` varchar(30)
,`arrival_time` time
,`arrival_date` date
,`vacant_seats` int(3)
);

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `emp_id` int(4) NOT NULL,
  `enquiry_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Cust_ID` int(4) NOT NULL,
  `Cust_name` varchar(25) DEFAULT NULL,
  `gender` varchar(7) DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `phone_number` varchar(12) DEFAULT NULL,
  `login_username` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Cust_ID`, `Cust_name`, `gender`, `email`, `phone_number`, `login_username`) VALUES
(10, 'hh', 'male', 'qwefge@gmil.com', '123', 'sanki'),
(15, 'NITHISH KUMAR S', 'female', 'snithishkumar2002@yahoo.com', '9443549460', 'Krithikha-Balamuruga'),
(17, 'mahi', 'female', 'snitr2002@yahoo.com', '8610284988', 'mah'),
(22, 'Aishwarya', 'female', 'aishwarya@gmail', '123456', 'aish17');

-- --------------------------------------------------------

--
-- Table structure for table `customer_care_agent`
--

CREATE TABLE `customer_care_agent` (
  `Emp_ID` int(4) NOT NULL,
  `Emp_name` varchar(20) DEFAULT NULL,
  `salary` double(7,2) DEFAULT NULL,
  `gender` varchar(7) DEFAULT NULL,
  `phone_no` varchar(13) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `Date_of_join` date DEFAULT NULL,
  `login_username` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `enquiry`
--

CREATE TABLE `enquiry` (
  `Enquiry_ID` int(8) NOT NULL,
  `Enquiry_type` varchar(10) DEFAULT NULL,
  `Enquiry_title` varchar(40) NOT NULL,
  `Enquiry_Description` varchar(200) DEFAULT NULL,
  `enquiry_answer` varchar(200) DEFAULT NULL,
  `Cust_id` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enquiry`
--

INSERT INTO `enquiry` (`Enquiry_ID`, `Enquiry_type`, `Enquiry_title`, `Enquiry_Description`, `enquiry_answer`, `Cust_id`) VALUES
(1, '22222222', '23222', 'Enter1111111111111111Description', NULL, NULL),
(2, 'ask', 'mm', 'mmmmmmmmmmmmmmmmmmmmm', NULL, NULL),
(3, 'Complaint ', '22222222', 'qqqqqqqqqq', NULL, NULL);

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
('aish17', 'aishstupid'),
('Krithikha-Balamuruga', 'qqqq'),
('mah', 'mah'),
('sanki', '68');

-- --------------------------------------------------------

--
-- Table structure for table `manages`
--

CREATE TABLE `manages` (
  `emp_id` int(4) NOT NULL,
  `flight_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `Ticket_no` int(6) NOT NULL,
  `Class` varchar(20) DEFAULT NULL,
  `Booking_Ref` varchar(8) DEFAULT NULL,
  `Seat_No` int(3) DEFAULT NULL,
  `payment_Type` varchar(15) DEFAULT NULL,
  `booking_time` time DEFAULT NULL,
  `booking_date` date DEFAULT NULL,
  `account_No` varchar(10) DEFAULT NULL,
  `Bank_name` varchar(30) DEFAULT NULL,
  `flight_ID` int(4) DEFAULT NULL,
  `aadhar_no` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure for view `airline_view`
--
DROP TABLE IF EXISTS `airline_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `airline_view`  AS SELECT `airline`.`Flight_ID` AS `Flight_ID`, `airline`.`Airline_name` AS `Airline_name`, `airline`.`economy_Fare` AS `economy_Fare`, `airline`.`buisness_fare` AS `buisness_fare`, `airline`.`dept_Time` AS `dept_Time`, `airline`.`dept_date` AS `dept_date`, `airline`.`departure_Destination` AS `departure_Destination`, `airline`.`arrival_destination` AS `arrival_destination`, `airline`.`arrival_time` AS `arrival_time`, `airline`.`arrival_date` AS `arrival_date`, `airline`.`vacant_seats` AS `vacant_seats` FROM `airline` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airline`
--
ALTER TABLE `airline`
  ADD PRIMARY KEY (`Flight_ID`);

--
-- Indexes for table `airline_coordinator`
--
ALTER TABLE `airline_coordinator`
  ADD PRIMARY KEY (`Emp_ID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `login_username` (`login_username`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`emp_id`,`enquiry_id`),
  ADD KEY `enquiry_id` (`enquiry_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Cust_ID`),
  ADD UNIQUE KEY `email` (`email`) USING BTREE,
  ADD KEY `login_username` (`login_username`);

--
-- Indexes for table `customer_care_agent`
--
ALTER TABLE `customer_care_agent`
  ADD PRIMARY KEY (`Emp_ID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `login_username` (`login_username`);

--
-- Indexes for table `enquiry`
--
ALTER TABLE `enquiry`
  ADD PRIMARY KEY (`Enquiry_ID`),
  ADD KEY `Cust_id` (`Cust_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`Login_username`);

--
-- Indexes for table `manages`
--
ALTER TABLE `manages`
  ADD PRIMARY KEY (`emp_id`,`flight_id`),
  ADD KEY `flight_id` (`flight_id`);

--
-- Indexes for table `passenger_info`
--
ALTER TABLE `passenger_info`
  ADD PRIMARY KEY (`Aadhar_No`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`Ticket_no`),
  ADD KEY `aadhar_no` (`aadhar_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `airline_coordinator`
--
ALTER TABLE `airline_coordinator`
  MODIFY `Emp_ID` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Cust_ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `customer_care_agent`
--
ALTER TABLE `customer_care_agent`
  MODIFY `Emp_ID` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enquiry`
--
ALTER TABLE `enquiry`
  MODIFY `Enquiry_ID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `Ticket_no` int(6) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `airline_coordinator`
--
ALTER TABLE `airline_coordinator`
  ADD CONSTRAINT `airline_coordinator_ibfk_1` FOREIGN KEY (`login_username`) REFERENCES `login` (`Login_username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`enquiry_id`) REFERENCES `enquiry` (`Enquiry_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`emp_id`) REFERENCES `customer_care_agent` (`Emp_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `enquiry_ibfk_1` FOREIGN KEY (`Cust_id`) REFERENCES `customer` (`Cust_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `manages`
--
ALTER TABLE `manages`
  ADD CONSTRAINT `manages_ibfk_1` FOREIGN KEY (`flight_id`) REFERENCES `airline` (`FLight_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `manages_ibfk_2` FOREIGN KEY (`emp_id`) REFERENCES `airline_coordinator` (`Emp_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`aadhar_no`) REFERENCES `passenger_info` (`Aadhar_No`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
