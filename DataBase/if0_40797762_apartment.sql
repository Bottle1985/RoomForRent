-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql211.infinityfree.com
-- Generation Time: Aug 16, 2026 at 02:26 PM
-- Server version: 11.4.12-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_40797762_apartment`
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `available_flats`
--

INSERT INTO `available_flats` (`flat_id`, `owner_id`, `owner_username`, `flat_city`, `flat_location`, `flat_rent`, `available`) VALUES
(1, 1, 'bottle', 'Nha Trang', 'ÄÆ°á»ng 2/4 Nha Trang - KhÃ¡nh HÃ²a', 1100000, 0),
(9, 1, 'bottle', 'Nha Trang', 'ÄÆ°á»ng 2/4 Nha Trang - KhÃ¡nh HÃ²a', 1000000, 0),
(10, 1, 'bottle', 'Nha Trang', 'ÄÆ°á»ng 2/4 Nha Trang - KhÃ¡nh HÃ²a', 1700000, 0),
(11, 1, 'bottle', 'Nha Trang', 'ÄÆ°á»ng 2/4 Nha Trang - KhÃ¡nh HÃ²a', 1100000, 0),
(12, 1, 'bottle', 'Nha Trang', 'ÄÆ°á»ng 2/4 Nha Trang - KhÃ¡nh HÃ²a', 1300000, 0),
(13, 1, 'bottle', 'Nha Trang', 'ÄÆ°á»ng 2/4 Nha Trang - KhÃ¡nh HÃ²a', 1300000, 0),
(14, 1, 'bottle', 'Nha Trang', 'ÄÆ°á»ng 2/4 Nha Trang - KhÃ¡nh HÃ²a', 1400000, 0),
(15, 1, 'bottle', 'Nha Trang', 'ÄÆ°á»ng 2/4 Nha Trang - KhÃ¡nh HÃ²a', 1200000, 0),
(16, 1, 'bottle', 'Nha Trang', 'ÄÆ°á»ng 2/4 Nha Trang - KhÃ¡nh HÃ²a', 1200000, 0),
(17, 1, 'bottle', 'NhaTrang', 'ÄÆ°á»ng 2/4 Nha Trang - KhÃ¡nh HÃ²a', 1000000, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `flat_details`
--

INSERT INTO `flat_details` (`flat_id`, `flat_city`, `flat_location`, `flat_size`, `num_of_rooms`, `additional_info`, `image`) VALUES
(1, 'Nha Trang', 'ÄÆ°á»ng 2/4 Nha Trang - KhÃ¡nh HÃ²a', 40, 1, '204 - CÄƒn trung', '1782927744_0_20200617_153451.jpg,1782927744_1_20200617_153500.jpg,1782927744_2_20200617_153512.jpg,1782927744_3_20200617_153529.jpg'),
(9, 'Nha Trang', 'ÄÆ°á»ng 2/4 Nha Trang - KhÃ¡nh HÃ²a', 30, 1, '202 - PhÃ²ng nhá»', '1781868284133954000094113792.jpg'),
(10, 'Nha Trang', 'ÄÆ°á»ng 2/4 Nha Trang - KhÃ¡nh HÃ²a', 40, 1, '201 - PhÃ²ng lá»›n', '1782927027_0_20200617_153343.jpg,1782927027_1_20200617_153352.jpg,1782927027_2_20200617_153406.jpg,1782927027_3_20200617_153419.jpg'),
(11, 'Nha Trang', 'ÄÆ°á»ng 2/4 Nha Trang - KhÃ¡nh HÃ²a', 40, 1, '404 - CÄƒn trung', ''),
(12, 'Nha Trang', 'ÄÆ°á»ng 2/4 Nha Trang - KhÃ¡nh HÃ²a', 40, 1, '304 - PhÃ²ng trung', ''),
(13, 'Nha Trang', 'ÄÆ°á»ng 2/4 Nha Trang - KhÃ¡nh HÃ²a', 50, 1, '401 - PhÃ²ng lá»›n', ''),
(14, 'Nha Trang', 'ÄÆ°á»ng 2/4 Nha Trang - KhÃ¡nh HÃ²a', 40, 1, '301 - CÄƒn lá»›n', ''),
(15, 'Nha Trang', 'ÄÆ°á»ng 2/4 Nha Trang - KhÃ¡nh HÃ²a', 30, 1, '203 - PhÃ²ng nhá»', ''),
(16, 'Nha Trang', 'ÄÆ°á»ng 2/4 Nha Trang - KhÃ¡nh HÃ²a', 30, 1, '403 - PhÃ²ng nhá»', ''),
(17, 'NhaTrang', 'ÄÆ°á»ng 2/4 Nha Trang - KhÃ¡nh HÃ²a', 30, 1, '402 - PhÃ²ng nhá»', '');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `username`, `first_name`, `last_name`, `password`, `contact_no`, `city`, `location`, `gender`, `join_date`) VALUES
(1, 'bottle', 'Binh', 'Pham', '12345', '0914451299', 'nhatrang', '28 ÄoÃ n Tráº§n Nghiá»‡p', 'Male', '2019-10-06');

-- --------------------------------------------------------

--
-- Table structure for table `meter_readings`
--

CREATE TABLE `meter_readings` (
  `id` int(100) NOT NULL,
  `flat_id` int(100) NOT NULL,
  `month_label` varchar(20) NOT NULL,
  `electric_reading` decimal(10,2) NOT NULL DEFAULT 0.00,
  `water_reading` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `rent_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `electric_rate` decimal(10,2) NOT NULL DEFAULT 5000.00,
  `water_rate` decimal(10,2) NOT NULL DEFAULT 15000.00,
  `is_paid` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `meter_readings`
--

INSERT INTO `meter_readings` (`id`, `flat_id`, `month_label`, `electric_reading`, `water_reading`, `created_at`, `rent_amount`, `electric_rate`, `water_rate`, `is_paid`) VALUES
(1, 1, '2026-07', '2906.00', '349.00', '2026-07-02 11:46:52', '1820000.00', '5000.00', '15000.00', 1),
(2, 10, '2026-06', '4194.00', '273.00', '2026-07-02 12:03:52', '26455000.00', '5000.00', '15000.00', 1),
(3, 10, '2026-07', '4290.00', '281.00', '2026-07-02 18:14:41', '2300000.00', '5000.00', '15000.00', 1),
(4, 9, '2026-06', '2865.00', '345.00', '2026-07-02 18:40:59', '20700000.00', '5000.00', '15000.00', 1),
(5, 9, '2026-07', '3205.00', '188.00', '2026-07-02 18:41:40', '2800000.00', '5000.00', '15000.00', 1),
(10, 10, '2026-05', '50.00', '4.00', '2026-07-02 19:20:31', '2010000.00', '5000.00', '15000.00', 1),
(13, 11, '2026-06', '3347.00', '1988.00', '2026-07-10 02:01:37', '1255000.00', '5000.00', '15000.00', 1),
(14, 11, '2026-07', '3367.00', '1991.00', '2026-07-10 02:07:31', '1245000.00', '5000.00', '15000.00', 1),
(15, 11, '2026-05', '3325.00', '1985.00', '2026-07-10 06:47:00', '47500000.00', '5000.00', '15000.00', 1),
(17, 12, '2026-06', '2935.00', '344.00', '2026-07-10 08:55:02', '21135000.00', '5000.00', '15000.00', 1),
(18, 12, '2026-07', '2966.00', '350.00', '2026-07-10 08:55:49', '1545000.00', '5000.00', '15000.00', 1),
(20, 13, '2026-06', '1628.00', '205.00', '2026-07-12 13:59:39', '12515000.00', '5000.00', '15000.00', 1),
(21, 13, '2026-07', '1640.00', '208.00', '2026-07-12 14:00:51', '1405000.00', '5000.00', '15000.00', 1),
(22, 14, '2026-06', '6345.00', '344.00', '2026-07-15 04:07:02', '38285000.00', '5000.00', '15000.00', 1),
(23, 14, '2026-07', '6384.00', '346.00', '2026-07-15 04:07:41', '1625000.00', '5000.00', '15000.00', 1),
(24, 15, '2026-06', '1630.00', '344.00', '2026-07-15 14:21:42', '14510000.00', '5000.00', '15000.00', 1),
(25, 15, '2026-07', '1658.00', '351.00', '2026-07-15 14:23:49', '1445000.00', '5000.00', '15000.00', 1),
(26, 16, '2026-06', '4066.00', '320.00', '2026-07-20 05:09:38', '26330000.00', '5000.00', '15000.00', 1),
(27, 16, '2026-07', '4098.00', '323.00', '2026-07-20 05:10:15', '1405000.00', '5000.00', '15000.00', 1),
(28, 1, '2026-06', '3213.00', '301.00', '2026-07-31 15:11:01', '21880000.00', '5000.00', '15000.00', 0),
(31, 17, '2026-06', '3213.00', '301.00', '2026-07-31 15:24:00', '21580000.00', '5000.00', '15000.00', 0),
(32, 17, '2026-07', '3233.00', '305.00', '2026-07-31 15:24:28', '1160000.00', '5000.00', '15000.00', 0),
(33, 9, '2026-08', '3385.00', '192.00', '2026-08-06 03:39:43', '1960000.00', '5000.00', '15000.00', 0),
(34, 1, '2026-08', '2967.00', '356.00', '2026-08-06 12:02:54', '1510000.00', '5000.00', '15000.00', 0),
(35, 12, '2026-08', '2998.00', '356.00', '2026-08-10 16:46:24', '1550000.00', '5000.00', '15000.00', 0),
(38, 13, '2026-08', '1652.00', '210.00', '2026-08-12 10:20:28', '1390000.00', '5000.00', '15000.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reserved_flats`
--

CREATE TABLE `reserved_flats` (
  `flat_id` int(100) NOT NULL,
  `bidder_username` varchar(100) NOT NULL,
  `bidder_name` varchar(255) NOT NULL,
  `bidder_contact` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
-- Indexes for table `meter_readings`
--
ALTER TABLE `meter_readings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `flat_month_unique` (`flat_id`,`month_label`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `available_flats`
--
ALTER TABLE `available_flats`
  MODIFY `flat_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `flat_details`
--
ALTER TABLE `flat_details`
  MODIFY `flat_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `meter_readings`
--
ALTER TABLE `meter_readings`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
