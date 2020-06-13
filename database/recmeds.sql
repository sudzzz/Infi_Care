-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2020 at 05:37 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recmeds`
--

-- --------------------------------------------------------

--
-- Table structure for table `coustomer`
--

CREATE TABLE `coustomer` (
  `id` int(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `address` varchar(150) NOT NULL,
  `lat` float(10,6) DEFAULT NULL,
  `lng` float(10,6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coustomer`
--

INSERT INTO `coustomer` (`id`, `username`, `address`, `lat`, `lng`) VALUES
(2, 'Sudhir18', 'Buddha Park\r\nB 14, Block B, Kalyani, West Bengal 741235\r\n', 22.964602, 88.428726),
(3, 'Sanjay', 'Central Park,\r\nB5, Block B, Kalyani, West Bengal 741235', 22.974878, 88.434555),
(5, 'raj', 'Bangur Park Rishra', 22.721649, 88.350647);

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `id` int(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `address` varchar(150) NOT NULL,
  `lat` float(10,6) DEFAULT NULL,
  `lng` float(10,6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`id`, `username`, `address`, `lat`, `lng`) VALUES
(1, 'JNM', 'Kolkata JNM Hospital quarter E/88, Kalyani, West Bengal 741235', 22.974371, 88.455711);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(255) NOT NULL,
  `hospital` varchar(60) NOT NULL,
  `hospital_address` varchar(150) NOT NULL,
  `store` varchar(60) NOT NULL,
  `medicine_name` varchar(50) NOT NULL,
  `number_tablets` int(100) NOT NULL,
  `dod` date NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `hospital`, `hospital_address`, `store`, `medicine_name`, `number_tablets`, `dod`, `status`) VALUES
(11, 'JNM Hospital', 'Kolkata JNM Hospital quarter E/88, Kalyani, West Bengal 741235', 'Mishra Medical Stores', 'Calpol-Paracetamol', 20, '2020-06-14', 1),
(12, 'JNM Hospital', 'Kolkata JNM Hospital quarter E/88, Kalyani, West Bengal 741235', 'Daga Medical Store', 'Calpol-Paracetamol', 10, '2020-06-23', 1),
(13, 'JNM Hospital', 'Kolkata JNM Hospital quarter E/88, Kalyani, West Bengal 741235', 'Mishra Medical Stores', 'Pan 40-Dabur', 20, '2020-06-14', 1),
(14, 'JNM Hospital', 'Kolkata JNM Hospital quarter E/88, Kalyani, West Bengal 741235', 'United Medicine Store', 'Calpol-Paracetamol', 15, '2020-06-14', 0),
(15, 'JNM Hospital', 'Kolkata JNM Hospital quarter E/88, Kalyani, West Bengal 741235', 'Mishra Medical Stores', 'Calpol-Paracetamol', 15, '2020-06-14', 0),
(16, 'JNM Hospital', 'Kolkata JNM Hospital quarter E/88, Kalyani, West Bengal 741235', 'Yamaha Medicals', 'Pan 40-Dabur', 20, '2020-06-15', 1),
(17, 'JNM Hospital', 'Kolkata JNM Hospital quarter E/88, Kalyani, West Bengal 741235', 'Divya Daga', 'paracetamol 650-Cipla', 10, '2020-06-14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy`
--

CREATE TABLE `pharmacy` (
  `id` int(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `name` varchar(60) NOT NULL,
  `medicine_name` varchar(50) NOT NULL,
  `number_tablets` int(100) NOT NULL,
  `company_name` varchar(60) NOT NULL,
  `expiry_date` date NOT NULL,
  `lat` float(10,6) DEFAULT NULL,
  `lng` float(10,6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pharmacy`
--

INSERT INTO `pharmacy` (`id`, `username`, `name`, `medicine_name`, `number_tablets`, `company_name`, `expiry_date`, `lat`, `lng`) VALUES
(25, 'Gita', 'Gita Medicine Corner', 'Calpol', 55, 'Paracetamol', '2020-06-14', 22.962732, 88.428391),
(27, 'United', 'United Medicine Store', 'Calpol', 15, 'Paracetamol', '2020-08-13', 22.966860, 88.467033),
(32, 'Daga', 'Daga Medical Store', 'Calpol', 35, 'Paracetamol', '2020-06-22', 22.970528, 88.444626),
(33, 'uddeshya18', 'Mishra Medical Stores', 'Calpol', 25, 'Paracetamol', '2020-06-25', 22.971842, 88.428001),
(34, 'Yamaha', 'Yamaha Medicals', 'Pan 40', 25, 'Dabur', '2020-08-29', 22.980160, 88.437988),
(35, 'Daga', 'Daga Medical Store', 'Pan 40', 25, 'Dabur', '2020-06-11', 22.970528, 88.444626),
(36, 'uddeshya18', 'Mishra Medical Stores', 'Pan 40', 50, 'Dabur', '2020-06-09', 22.971842, 88.428001);

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(255) NOT NULL,
  `name` varchar(60) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `usertype` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `name`, `address`, `phone`, `username`, `email`, `password`, `usertype`) VALUES
(2, 'Mishra Medical Stores', 'B-14/5  Kalyani, West Bengal - 741235 ', '7552145338', 'uddeshya18', 'uddeshya1812@gmail.com', '123456', 'pharmacy'),
(3, 'Sevak Sang', 'B-9/11(CA), Kalyani, B 9, Block B, Kalyani, West Bengal 741235', '8240078072', 'Satya', 'singhsatyaprakash19@gmail.com', 'satya123', 'hospital'),
(24, 'Daga Medical Store', 'Lake Park\r\nBlock B, Kalyani, West Bengal 741235\r\n', '8335940590', 'Daga', 'sudhirdaga1998@gmail.com', '12345', 'pharmacy'),
(29, 'Singh Medical Store', 'B-14/12, Kalyani, West Bengal - 741235 ', '8240078072', 'Satya18', 'satya@gmail.com', '12345', 'pharmacy'),
(31, 'Sudhir Daga', 'Buddha Park\r\nB 14, Block B, Kalyani, West Bengal 741235\r\n', '8335940590', 'Sudhir18', 'sudhirdaga18@gmail.com', '12345', 'customer'),
(32, 'Sanjay Tiwari', 'B5, Block B, Kalyani, West Bengal 741235', '8209570373', 'Sanjay', 'sanjay981127@gmail.com', '12345', 'customer'),
(34, 'United Medicine Store', 'Bidhanpally, Kalyani, West Bengal 741235', '1234567890', 'United', 'unitedmedicine@gmail.com', '12345', 'pharmacy'),
(35, 'Gita Medicine Corner', 'B-17/176, near I.T.I More, Kalyani, West Bengal 741235', '0123456789', 'Gita', 'gitamedicine@gmail.com', '12345', 'pharmacy'),
(36, 'Baishakhi Medical Stores', 'main station road, A 9X, Block A9, Q4(S, Kalyani, West Bengal 741235', '0123456789', 'Baishakhi', 'baishakhimedicine@gmail.com', '12345', 'pharmacy'),
(37, 'Zenith Medical Stores', 'B-9/274, Kalyani, Kolkata, West Bengal', '0123456789', 'Zenith', 'zenithmedicine@gmail.com', '12345', 'pharmacy'),
(38, 'Medical Pharmacy', 'Kalyani, Block A11, Block A, Kalyani, West Bengal 741235', '0123456789', 'Medical', 'medicalmedicine@gmail.com', '12345', 'pharmacy'),
(39, 'Frankross Pharmacy Kalyani Central Park', 'HOLDING NO.B-12/17(S),PLOT NO.17(S SUBLOCK-B, Kalyani, West Bengal 741235', '0123456789', 'Frankross', 'frankrossmedicine@gmail.com', '12345', 'pharmacy'),
(40, 'Swadesh Medical Hall', 'B-9/20 (C.A), Kalyani, West Bengal', '0123456789', 'Swadesh', 'swadeshmedicine@gmail.com', '12345', 'pharmacy'),
(41, 'Dev medical', 'B-18, 199, Block B, kalyanii, Kalyani, West Bengal 741235', '0123456789', 'Dev', 'devmedicine@gmail.com', '12345', 'pharmacy'),
(42, 'Samriddha Pharmacy', 'Kalyani Sangam cinema Hall building, Kalyani, West Bengal 741235', '0123456789', 'Samriddha', 'samriddhamedicine@gmail.com ', '12345', 'pharmacy'),
(43, 'Prarthana Medical', 'D.C. Building, A-9/156, Kalyani, Beside SNR Carnival, Opp, A1, Block A1, Block A, Kolkata, West Bengal 741235', '0123456789', 'Prarthana', 'prarthanamedicine@gmail.com', '12345', 'pharmacy'),
(45, 'Frank Ross Pharmacy - Kalyani', 'A-2/52, JNM Hospital Rd, opposite Bidhan Park, Block A2, Block A, Kalyani, West Bengal 741235', '0123456789', 'Frank', 'frankross@gmail.com', '12345', 'pharmacy'),
(46, 'Chakrabarty Medical', 'B-11/7, Near Kalyani Poursabha, Kalyani, West Bengal 741235', '0123456789', 'Chakrabarty', 'chakrabartymedicine@gmail.com', '12345', 'pharmacy'),
(47, 'Care Pharmacy', ' B 7/28 South, Central Park, 2 No Bazar Road, Kalyani, West Bengal 741235', '0123456789', 'Care', 'caremedicine@gmail.com', '12345', 'pharmacy'),
(48, 'SastaSundar-Kalyani', ' B 7/8 s, Central Park, behind HDFC & Canara Bank Healthbuddy Kalyani Pharmacy, Kalyani, West Bengal 741235', '0123456789', 'SastaSundar', 'sastasundar@gmail.com', '12345', 'pharmacy'),
(49, 'Saha Medical', 'A9/15 (s) kalyani Nadia, 741235', '0123456789', 'Saha', 'sahamedicine@gmail.com', '12345', 'pharmacy'),
(50, 'Nehan Medical Shop', 'B7, Block B, Kanchrapara, West Bengal 741235', '0123456789', 'Nehan', 'nehanmedicine@gmail.com', '12345', 'pharmacy'),
(51, 'Dey Medico', '2 No Bazar, B-7/29S), Central Park, Namita Rd, Block B, Kalyani, West Bengal 741235', '0123456789', 'Dey', 'deymedicine@gmail.com', '12345', 'pharmacy'),
(52, 'Yamaha Medicals', 'Block B-9/4(CA), Kalyani (ITI More, West Bengal 741235', '0123456789', 'Yamaha', 'yamahamedicine@gmail.com', '12345', 'pharmacy'),
(53, 'JNM Hospital', 'Kolkata JNM Hospital quarter E/88, Kalyani, West Bengal 741235', '0123456789', 'JNM', 'jnmhospital@gmail.com', '12345', 'hospital'),
(55, 'Divya Daga', '179, Bangur Park,Rishra,Hooghly', '9681287066', 'divya028', 'daga.divya028@gmail.com', '123456', 'pharmacy'),
(56, 'Raj', 'Bangur Park Rishra', '6666222245', 'raj', 'raj@gmail.com', '12345', 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` int(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL,
  `lat` float(10,6) DEFAULT NULL,
  `lng` float(10,6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `username`, `name`, `address`, `lat`, `lng`) VALUES
(1, 'United', 'United Medicine Store', 'Bidhanpally, Kalyani, West Bengal 741235', 22.966860, 88.467033),
(2, 'Gita', 'Gita Medicine Corner', 'B-17/176, near I.T.I More, Kalyani, West Bengal 741235', 22.962732, 88.428391),
(3, 'Baishakhi', 'Baishakhi Medical Stores', 'main station road, A 9X, Block A9, Q4(S, Kalyani, West Bengal 741235', 22.969345, 88.466644),
(4, 'Zenith', 'Zenith Medical Stores', 'B-9/274, Kalyani, Kolkata, West Bengal', 22.975954, 88.437210),
(5, 'Medical', 'Medical Pharmacy', 'Kalyani, Block A11, Block A, Kalyani, West Bengal 741235', 22.965101, 88.454460),
(6, 'Frankross', 'Frankross Pharmacy Kalyani Central Park', 'HOLDING NO.B-12/17(S),PLOT NO.17(S SUBLOCK-B, Kalyani, West Bengal 741235', 22.966608, 88.436752),
(7, 'Swadesh', 'Swadesh Medical Hall', 'B-9/20 (C.A), Kalyani, West Bengal', 22.977104, 88.436142),
(8, 'Dev', 'Dev medical', 'B-18, 199, Block B, kalyanii, Kalyani, West Bengal 741235', 22.986689, 88.429398),
(9, 'Samriddha', 'Samriddha Pharmacy', 'Kalyani Sangam cinema Hall building, Kalyani, West Bengal 741235', 22.966608, 88.436752),
(10, 'Prarthana', 'Prarthana Medical', 'D.C. Building, A-9/156, Kalyani, Beside SNR Carnival, Opp, A1, Block A1, Block A, Kolkata, West Bengal 741235', 22.969088, 88.465195),
(11, 'Frank', 'Frank Ross Pharmacy - Kalyani', 'A-2/52, JNM Hospital Rd, opposite Bidhan Park, Block A2, Block A, Kalyani, West Bengal 741235', 22.971575, 88.462654),
(12, 'Chakrabarty', 'Chakrabarty Medical', 'B-11/7, Near Kalyani Poursabha, Kalyani, West Bengal 741235', 22.977390, 88.445717),
(13, 'Care', 'Care Pharmacy', ' B 7/28 South, Central Park, 2 No Bazar Road, Kalyani, West Bengal 741235', 22.976109, 88.434143),
(14, 'SastaSundar', 'SastaSundar-Kalyani', ' B 7/8 s, Central Park, behind HDFC & Canara Bank Healthbuddy Kalyani Pharmacy, Kalyani, West Bengal 741235', 22.976080, 88.433319),
(15, 'Saha', 'Saha Medical', 'A9/15 (s) kalyani Nadia, 741235', 22.970520, 88.464500),
(16, 'Nehan', 'Nehan Medical Shop', 'B7, Block B, Kanchrapara, West Bengal 741235', 22.975611, 88.433853),
(17, 'Dey', 'Dey Medico', '2 No Bazar, B-7/29S), Central Park, Namita Rd, Block B, Kalyani, West Bengal 741235', 22.976120, 88.434135),
(18, 'Satya18', 'Singh Medical Store', 'B-14/12, Kalyani, West Bengal - 741235 ', 22.965216, 88.434334),
(19, 'uddeshya18', 'Mishra Medical Stores', 'B-4/5(S)  Kalyani, West Bengal - 741235 ', 22.971842, 88.428001),
(21, 'Daga', 'Daga Medical Store', 'Lake Park\r\nBlock B, Kalyani, West Bengal 741235\r\n', 22.970528, 88.444626),
(22, 'Yamaha', 'Yamaha Medicals', 'Block B-9/4(CA), Kalyani (ITI More, West Bengal 741235', 22.980160, 88.437988),
(23, 'divya028', 'Divya Daga', '179, Bangur Park,Rishra,Hooghly', 22.720577, 88.346375);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coustomer`
--
ALTER TABLE `coustomer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coustomer_fk` (`username`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacy`
--
ALTER TABLE `pharmacy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk` (`username`),
  ADD KEY `key` (`name`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `address` (`address`),
  ADD KEY `user` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coustomer`
--
ALTER TABLE `coustomer`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hospital`
--
ALTER TABLE `hospital`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pharmacy`
--
ALTER TABLE `pharmacy`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `coustomer`
--
ALTER TABLE `coustomer`
  ADD CONSTRAINT `coustomer_fk` FOREIGN KEY (`username`) REFERENCES `register` (`username`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `pharmacy`
--
ALTER TABLE `pharmacy`
  ADD CONSTRAINT `fk` FOREIGN KEY (`username`) REFERENCES `register` (`username`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `key` FOREIGN KEY (`name`) REFERENCES `stores` (`name`);

--
-- Constraints for table `stores`
--
ALTER TABLE `stores`
  ADD CONSTRAINT `user` FOREIGN KEY (`username`) REFERENCES `register` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
