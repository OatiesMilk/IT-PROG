-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2024 at 07:13 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mp`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(10) NOT NULL,
  `isadmin` tinyint(1) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `mobile_num` decimal(12,0) NOT NULL,
  `tickets` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `isadmin`, `username`, `password`, `firstname`, `lastname`, `email`, `mobile_num`, `tickets`) VALUES
(1, 1, 'OatiesMilk', '$2y$10$vR0/qw4eL0nA.EobRsGGqext/WlTmcNRrNDFUqOE.3h2b8Ico.1lm', 'Dylan', 'Akia', 'dylanakia2002@gmail.com', 9999946734, 0),
(2, 0, 'TeaMatchi', '$2y$10$o//bAZyBXaZyjJJdBVGSCuzERFVv7hcqvWyWrq2JzINyZcLap9ufC', 'John', 'Doe', 'johndoe@gmail.com', 9999946733, 0),
(3, 0, 'DylanLee', '$2y$10$485yBkyJnAPpSDob3UupeusVJwaaCZHaX89n/2PDZH/M48F36T2ti', 'First', 'Last', 'email@test.com', 9999912345, 0),
(4, 1, 'test', '1234', 'asdf', 'asdf', 'asdf@gmail.com', 1234, 0);

-- --------------------------------------------------------

--
-- Table structure for table `addons`
--

CREATE TABLE `addons` (
  `addon_id` int(10) NOT NULL,
  `addon_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addons`
--

INSERT INTO `addons` (`addon_id`, `addon_name`) VALUES
(1, 'Hotel Overnight Booking'),
(2, 'Meet-and-Greet'),
(3, 'Merchandise Pack'),
(4, 'Food and Drink Pack'),
(5, 'Chair Beddings');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `account_id` int(10) NOT NULL,
  `event_id` int(10) NOT NULL,
  `booking_id` int(10) NOT NULL,
  `addon_id` int(10) NOT NULL,
  `username` varchar(64) NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `mobile_num` decimal(12,0) NOT NULL,
  `amount` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`account_id`, `event_id`, `booking_id`, `addon_id`, `username`, `firstname`, `lastname`, `email`, `mobile_num`, `amount`) VALUES
(2, 2, 826, 0, 'TeaMatchi', 'John', 'Doe', 'johndoe@gmail.com', 9999946733, 7500),
(2, 3, 894, 0, 'TeaMatchi', 'John', 'Doe', 'johndoe@gmail.com', 9999946733, 7500);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_name` varchar(64) NOT NULL,
  `event_id` int(10) NOT NULL,
  `description` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `venue` varchar(64) NOT NULL,
  `capacity` int(10) NOT NULL,
  `price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_name`, `event_id`, `description`, `date`, `time`, `venue`, `capacity`, `price`) VALUES
('Jester\'s Comedy Night', 3, 'Description: Jester\'s Comedy Night', '2024-09-26', '06:00:00', 'Theater', 1000, 2500),
('Knights Jousting Tournament', 1, 'Description: Knights Jousting Tournament', '2024-10-30', '18:00:00', 'Arena', 10000, 2500),
('Noble\'s Masquerade Ball', 2, 'Description: Noble\'s Masquerade Ball', '2024-11-14', '12:00:00', 'Ballroom', 2000, 2500);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(10) NOT NULL,
  `reviewer` varchar(64) NOT NULL,
  `event_name` varchar(64) NOT NULL,
  `comment` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `addons`
--
ALTER TABLE `addons`
  ADD PRIMARY KEY (`addon_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_name`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
