-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2021 at 08:18 AM
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
-- Database: `dailyfood`
--

-- --------------------------------------------------------

--
-- Table structure for table `addtocard`
--

CREATE TABLE `addtocard` (
  `id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customerorder`
--

CREATE TABLE `customerorder` (
  `id` int(20) NOT NULL,
  `date` date NOT NULL,
  `customerName` text NOT NULL,
  `phone` varchar(23) NOT NULL,
  `address` text NOT NULL,
  `price` int(23) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customerorder`
--

INSERT INTO `customerorder` (`id`, `date`, `customerName`, `phone`, `address`, `price`) VALUES
(24, '2022-04-21', 'Mahbub Hasan', '01623218618', 'Dhaka, Bangladesh', 780),
(25, '2022-04-21', 'Dash Shovro', '01567654567', 'Collage Rood, Mymensingh', 685);

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `amount` int(11) NOT NULL,
  `title` text NOT NULL,
  `code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`amount`, `title`, `code`) VALUES
(20, 'Eid', '2002');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(20) NOT NULL,
  `category` text NOT NULL,
  `price` int(30) NOT NULL,
  `img` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category`, `price`, `img`) VALUES
(8, 'pizza', 300, 'f2.jpg'),
(9, 'pizza', 280, 'f1.jpg'),
(10, 'pizza', 285, 'adminImg.jpg'),
(11, 'drink', 180, 'd6.jpg'),
(12, 'drink', 185, 'd2.jpg'),
(13, 'drink', 170, 'd3.jpg'),
(14, 'pizza', 350, 'f2.jpg'),
(15, 'pizza', 380, 'adminImg.jpg'),
(16, 'pizza', 265, 'f1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `savedorder`
--

CREATE TABLE `savedorder` (
  `username` text NOT NULL,
  `date` date NOT NULL,
  `phone` int(11) NOT NULL,
  `address` text NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `savedorder`
--

INSERT INTO `savedorder` (`username`, `date`, `phone`, `address`, `price`) VALUES
('mahbubswe', '2022-04-21', 1623218618, '13/55,Signboard,Sherpur', 1265),
('mahbubswe', '2022-04-21', 1623218618, 'Dhaka, Bangladesh', 700),
('mahbubswe', '2022-04-21', 1623218618, 'Dhaka, Bangladesh', 780),
('shovroswe', '2022-04-21', 1567654567, 'Collage Rood, Mymensingh', 685);

-- --------------------------------------------------------

--
-- Table structure for table `soldproduct`
--

CREATE TABLE `soldproduct` (
  `id` int(20) NOT NULL,
  `date` date NOT NULL,
  `amount` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soldproduct`
--

INSERT INTO `soldproduct` (`id`, `date`, `amount`) VALUES
(2, '2022-04-21', 1265);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` text NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`) VALUES
('admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addtocard`
--
ALTER TABLE `addtocard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customerorder`
--
ALTER TABLE `customerorder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soldproduct`
--
ALTER TABLE `soldproduct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD UNIQUE KEY `username` (`username`) USING HASH;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customerorder`
--
ALTER TABLE `customerorder`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `soldproduct`
--
ALTER TABLE `soldproduct`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
