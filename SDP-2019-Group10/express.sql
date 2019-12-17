-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2019 at 07:24 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `express`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `user_ID` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fist_name` varchar(20) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `telephon` varchar(11) NOT NULL,
  `address` text NOT NULL,
  `status` varchar(10) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`user_ID`, `email`, `password`, `fist_name`, `last_name`, `telephon`, `address`, `status`) VALUES
(40, 'pako1101', '08e9d39ecf2cc9aa4ca90237ff6c96cf', 'pako1102', '', '', '', 'user'),
(41, 'pako1102', '7a7d4d2213d0d6e825a8472a0a6441e6', '', '', '', '', 'EMPLOYEE'),
(713013, 'sorawis', 'd41d8cd98f00b204e9800998ecf8427e', 'Phattarawut', 'Wongprakronkun', '0967613323', '', 'EMPLOYEE'),
(713014, 'sora@kmitl.ac.th', 'd41d8cd98f00b204e9800998ecf8427e', '1', '1', '1', '1', 'user'),
(713015, 'pako2535', 'd41d8cd98f00b204e9800998ecf8427e', 'pako', 'pako', '111111111', 'นิตโย', 'ADMIN'),
(713016, 's@kmitl.ac.th', '25d55ad283aa400af464c76d713c07ad', 'so', 'at', '12345678', '123', 'user'),
(713017, 'sora@kmitl.ac.th', '25d55ad283aa400af464c76d713c07ad', 'sora', 'att', '12345678', '123', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `status` varchar(20) NOT NULL,
  `Salary` int(9) NOT NULL,
  `bonus` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_ID`, `user_ID`, `name`, `tel`, `status`, `Salary`, `bonus`) VALUES
(713013, 713013, 'Phattarawut', '0967613323', 'employee', 14000, 0),
(954678, 41, 'test', 'test', 'test', 14500, 3500);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `์Location_ID` int(11) NOT NULL,
  `name` varchar(35) CHARACTER SET utf8 NOT NULL,
  `zone` varchar(1) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`์Location_ID`, `name`, `zone`) VALUES
(1, 'คณะเทคโนโลยีการเกษตร', 'C'),
(2, 'คณะเทคโนโลยีสารสนเทศ', 'B'),
(3, 'คณะครุศาสตร์อุสาหกรรม', 'B'),
(4, 'คณะวิทยาศาสตร์', 'B'),
(5, 'คณะสถาปัตยกรรมศาสตร์', 'D'),
(6, 'ตึกCCA', 'D'),
(7, 'ตึกECC', 'A'),
(8, 'ตึกHM', 'D'),
(9, 'ลานพระบรมราชานุสาวรีย์ราชการที่', 'B'),
(10, 'วิยาลัยนาโน', 'A'),
(11, 'สถานีรถไฟพระจอมเกล้า', 'S'),
(12, 'สถานีรถไฟหัวตะเข้', 'S'),
(13, 'สนามกีฬาสถาบัน', 'A'),
(14, 'สำนักงานวิจัยและบริการคอมพิวเตอร์', 'B'),
(15, 'สำนักงานหอสมุดกลาง', 'C'),
(16, 'สำนักงานอธิการบดี', 'A'),
(17, 'หอประชุม ศ.ประสม รังสิโรจน', 'D'),
(18, 'หอพักนักศึกษา', 'A'),
(19, 'อาคารเจ้าคุณทหาร', 'C'),
(20, 'อาคารเรียนรวมสมเด็จพระเทพฯ', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_ID` int(10) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `location` varchar(50) NOT NULL,
  `subjext` text NOT NULL,
  `status_reccive` set('True','False') NOT NULL DEFAULT 'False',
  `status_send` set('True','False') NOT NULL DEFAULT 'False',
  `status_pay` set('True','False') NOT NULL DEFAULT 'False',
  `date` datetime NOT NULL,
  `emp_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_ID`, `user_ID`, `phone`, `location`, `subjext`, `status_reccive`, `status_send`, `status_pay`, `date`, `emp_ID`) VALUES
(426204, 713014, '0909238425', 'ตึก ECC', 'ห้อง 808', 'True', 'False', 'True', '2019-11-25 13:09:49', 713013),
(896171, 713017, '0909238425', 'à¸•à¸¶à¸ ECC', 'à¸«à¹‰à¸­à¸‡ 808', 'True', 'True', 'True', '2019-11-25 16:30:02', 713013);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `item_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `order_ID` int(10) NOT NULL,
  `size` int(10) NOT NULL,
  `weight` int(10) NOT NULL,
  `qly` int(10) NOT NULL,
  `price` int(10) NOT NULL,
  `name` varchar(60) NOT NULL,
  `recipient` text CHARACTER SET utf8 NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`item_ID`, `user_ID`, `order_ID`, `size`, `weight`, `qly`, `price`, `name`, `recipient`, `date`) VALUES
(26, 713014, 426204, 10, 10, 10, 2630, 'นายภัทรวุฒิ วงศ์ปกรณ์กุล', ' ชื่อผู้รับ : นายภัทรวุฒิ  วงศ์ปกรณ์กุล<br> <dd>เบอร์ติดต่อ : 0854935266 </dd><dd> ที่อยู่ :ตึกHM (ห้อง 1305)</dd>', '2019-11-25 13:12:37'),
(27, 713017, 896171, 10, 10, 1, 320, 'mr.putra wong', ' à¸Šà¸·à¹ˆà¸­à¸œà¸¹à¹‰à¸£à¸±à¸š : mr.putra wong<br> <dd>à¹€à¸šà¸­à¸£à¹Œà¸•à¸´à¸”à¸•à¹ˆà¸­ : 0854935266 </dd><dd> à¸—à¸µà¹ˆà¸­à¸¢à¸¹à¹ˆ :à¸•à¸¶à¸HM (à¸«à¹‰à¸­à¸‡ 302)</dd>', '2019-11-25 16:35:23');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_ID` int(20) NOT NULL,
  `order_ID` int(10) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `bank` varchar(30) NOT NULL,
  `payslip` varchar(30) NOT NULL,
  `amount` varchar(10) NOT NULL,
  `date_transfer` varchar(20) NOT NULL,
  `confirm` set('No','Yes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_ID`, `order_ID`, `user_ID`, `bank`, `payslip`, `amount`, `date_transfer`, `confirm`) VALUES
(7, 426204, 713014, 'KMITL Wallet', '123456789012345', '2630.00 บา', '2019-11-16  16:55 ', 'No'),
(8, 896171, 713017, 'KMITL Wallet', '123456789012345', '300.00 à¸š', '2019-11-27  16:03 ', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `vote_ID` int(6) NOT NULL,
  `order_ID` int(10) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `vote` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vote`
--

INSERT INTO `vote` (`vote_ID`, `order_ID`, `user_ID`, `vote`) VALUES
(10, 426204, 713013, 5),
(11, 896171, 713013, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`user_ID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`์Location_ID`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_ID`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `emp_ID` (`emp_ID`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`item_ID`),
  ADD KEY `order_ID` (`order_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_ID`),
  ADD KEY `order_ID` (`order_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indexes for table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`vote_ID`),
  ADD KEY `order_ID` (`order_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=713018;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `์Location_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `item_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `vote_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `customer` (`user_ID`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `customer` (`user_ID`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_ID`) REFERENCES `order` (`order_ID`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `customer` (`user_ID`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`order_ID`) REFERENCES `order` (`order_ID`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `order` (`user_ID`);

--
-- Constraints for table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `vote_ibfk_1` FOREIGN KEY (`order_ID`) REFERENCES `order` (`order_ID`),
  ADD CONSTRAINT `vote_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `customer` (`user_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
