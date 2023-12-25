-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2023 at 05:12 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hotel_name` varchar(300) NOT NULL,
  `state_id` varchar(300) NOT NULL,
  `date_chin` date NOT NULL,
  `date_chout` date NOT NULL,
  `date_book` date NOT NULL,
  `price` float NOT NULL,
  `pax` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`book_id`, `user_id`, `hotel_name`, `state_id`, `date_chin`, `date_chout`, `date_book`, `price`, `pax`) VALUES
(1, 1, '10228937', '-2403010', '0000-00-00', '0000-00-00', '0000-00-00', 100, 5),
(2, 1, '10228937', '-2403010', '0000-00-00', '0000-00-00', '0000-00-00', 100, 5),
(3, 1, '10228937', '-2403010', '0000-00-00', '0000-00-00', '0000-00-00', 100, 5),
(4, 1, '10228937', '-2403010', '0000-00-00', '0000-00-00', '0000-00-00', 100, 5),
(5, 1, '10228937', '-2403010', '0000-00-00', '0000-00-00', '0000-00-00', 100, 5),
(6, 1, '1850024', '-2403412', '2023-10-05', '2023-10-10', '2023-10-05', 100, 5),
(7, 1, '6039757', '-2403538', '2023-10-05', '2023-10-10', '2023-10-05', 100, 5),
(39, 2, '10402749', '-2401818', '2023-07-14', '2023-07-15', '2023-07-14', 120.96, 2),
(40, 2, '8821012', '-2401818', '2023-07-15', '2023-07-24', '2023-07-14', 202.4, 2),
(41, 2, 'Homestay Uni, Kuala Kedah', '-2401818', '2023-08-01', '2023-08-16', '2023-07-14', 202.4, 2),
(42, 2, 'Platinum Suites KLCC', '-2403010', '2023-11-03', '2023-11-05', '2023-07-14', 226.2, 2),
(43, 2, 'Inap Pantai Umar 1 Terengganu', '-2403467', '2023-08-09', '2023-09-12', '2023-07-14', 114.02, 2),
(44, 2, 'Sayang Di Kaki Bukit Homestay Near Icon City Bukit Mertajam', '-2403092', '2023-11-03', '2023-11-05', '2023-07-14', 121.88, 2),
(45, 3, 'Kuala Kedah Pool Cottage', '-2401818', '2023-07-28', '2023-07-30', '2023-07-14', 303.6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `booking_detail`
--

CREATE TABLE `booking_detail` (
  `detail_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `room_name` varchar(300) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking_detail`
--

INSERT INTO `booking_detail` (`detail_id`, `book_id`, `room_id`, `room_name`, `quantity`) VALUES
(2, 39, 1040274901, 'Sofa bed(s)', 2),
(3, 40, 882101201, 'Full bed(s)', 2),
(4, 41, 882101201, 'Full bed(s)', 3),
(5, 42, 1006299107, 'Queen bed(s)', 3),
(6, 43, 838609201, 'Futon bed(s)', 3),
(7, 44, 883974903, 'Twin bed(s)', 2),
(8, 45, 1012028001, 'Twin bed(s)', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `full_name`, `email`, `password`, `address`) VALUES
(1, 'mantul', 'mantul bin mantul', 'mantul@gmail.com', 'mantul', 'mantul malaysia'),
(2, 'akmal', 'akmal', 'akmal@gmail.com', 'a', 'a'),
(3, 'adha', 'adha', 'a@gmail.com', 'a', 'a');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `booking_detail`
--
ALTER TABLE `booking_detail`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `booking_detail`
--
ALTER TABLE `booking_detail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `booking_detail`
--
ALTER TABLE `booking_detail`
  ADD CONSTRAINT `book_id` FOREIGN KEY (`book_id`) REFERENCES `booking` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
