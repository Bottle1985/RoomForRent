-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2019 at 12:36 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo_cse311`
--

-- --------------------------------------------------------

--
-- Table structure for table `available_flats`
--

CREATE TABLE `available_flats` (
  `flat_id` int(100) NOT NULL,
  `owner_id` int(100) NOT NULL,
  `owner_username` varchar(100) NOT NULL,
  `flat_city` varchar(100) NOT NULL,
  `flat_location` varchar(100) NOT NULL,
  `flat_rent` int(100) NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `available_flats`
--

INSERT INTO `available_flats` (`flat_id`, `owner_id`, `owner_username`, `flat_city`, `flat_location`, `flat_rent`, `available`) VALUES
(1, 1, 'niloy', 'dhaka', 'np', 25000, 1),
(2, 2, 'maruf', 'dhaka', 'as', 1200, 1),
(3, 3, 'ahad', 'dhaka', 'a', 12222, 1),
(4, 3, 'ahad', 'dhaka', 'a', 12222, 1),
(5, 4, 'rafid', 'dhaka', 'hatirpul', 200000, 1),
(6, 5, 'jun', 'dhaka', 'banasree', 25000, 1),
(7, 6, 'm9', 'dhaka', 'shantinagar', 120000, 1),
(8, 6, 'm9', 'rajshahi', 'ss', 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `flat_details`
--

CREATE TABLE `flat_details` (
  `flat_id` int(100) NOT NULL,
  `flat_city` varchar(100) NOT NULL,
  `flat_location` varchar(100) NOT NULL,
  `flat_size` int(100) NOT NULL,
  `num_of_rooms` int(100) NOT NULL,
  `additional_info` text NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `flat_details`
--

INSERT INTO `flat_details` (`flat_id`, `flat_city`, `flat_location`, `flat_size`, `num_of_rooms`, `additional_info`, `image`) VALUES
(1, 'dhaka', 'np', 1800, 4, 'lorem ipsum', '1570383129855772-mosaic-wallpaper.jpg'),
(2, 'dhaka', 'as', 1999, 3, 'sds', '157038491071745416_761110907643358_2422431292327985152_n.jpg'),
(3, 'dhaka', 'a', 1222, 3, 'ss', '157039697271745416_761110907643358_2422431292327985152_n.jpg'),
(4, 'dhaka', 'a', 1222, 3, 'ss', '157039724271745416_761110907643358_2422431292327985152_n.jpg'),
(5, 'dhaka', 'hatirpul', 15000, 10, 'big space', '157039743271745416_761110907643358_2422431292327985152_n.jpg'),
(6, 'dhaka', 'banasree', 2000, 4, 'nice', '157053639072591779_2795656767163441_274846751251234816_o.jpg'),
(7, 'dhaka', '', 0, 0, '', '157065314020190815_HDB_qanvast.jpg'),
(8, 'rajshahi', 'ss', 11212, 3, '3', '157065364220190815_HDB_qanvast.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `member_id` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `contact_no` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `join_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `username`, `first_name`, `last_name`, `password`, `contact_no`, `city`, `location`, `gender`, `join_date`) VALUES
(1, 'niloy', 'Fazal', 'Niloy', '12345', '01733966577', 'dhaka', 'noyapolton', 'Male', '2019-10-06'),
(2, 'maruf', 'maruf', 'khan', 'khan', '0123', 'dhaka', 'shantinagar', 'Male', '2019-10-06'),
(3, 'ahad', 'ahad', 'khan', 'khan', '12313', 'dhaka', 'seqwe``', 'Male', '2019-10-06'),
(4, 'rafid', 'rafid', 'khan', 'khan', '0123', 'dhaka', 'hatirpul', 'Male', '2019-10-06'),
(5, 'jun', 'junaid', 'jafor', 'jaf', '0123', 'dhaka', 'shanti', 'Male', '2019-10-08'),
(6, 'm9', 'maruf', 'khan', 'mk', '111', 'dhaka', 'an', 'Male', '2019-10-09'),
(7, 'rakin', 'rakin', 'ahmen', 'ahmed', '01722088068', 'dhaka', 'malibag', 'Male', '2019-10-10');

-- --------------------------------------------------------

--
-- Table structure for table `reserved_flats`
--

CREATE TABLE `reserved_flats` (
  `flat_id` int(100) NOT NULL,
  `bidder_username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reserved_flats`
--

INSERT INTO `reserved_flats` (`flat_id`, `bidder_username`) VALUES
(0, 'rafid'),
(0, 'rafid'),
(0, 'jun'),
(0, 'm9');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `available_flats`
--
ALTER TABLE `available_flats`
  ADD PRIMARY KEY (`flat_id`);

--
-- Indexes for table `flat_details`
--
ALTER TABLE `flat_details`
  ADD PRIMARY KEY (`flat_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `available_flats`
--
ALTER TABLE `available_flats`
  MODIFY `flat_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `flat_details`
--
ALTER TABLE `flat_details`
  MODIFY `flat_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;