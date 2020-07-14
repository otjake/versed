-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2020 at 02:40 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `allphptricks`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) NOT NULL,
  `name` varchar(250) NOT NULL,
  `code` varchar(100) NOT NULL,
  `price` double(9,2) NOT NULL,
  `image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `code`, `price`, `image`) VALUES
(1, 'Laptop Core i5', 'Laptop01', 600.00, 'images\\laptop.jpg'),
(2, 'Laptop Bag', 'Bag01', 50.00, 'images\\headset.jpg'),
(3, 'iPhone X', 'iphone01', 700.00, 'images\\mobile.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(255) NOT NULL,
  `tranx_ref` varchar(255) NOT NULL,
  `amount_paid` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `tranx_ref`, `amount_paid`, `customer_email`, `date_created`) VALUES
(1, 'T279923871459519', '7800', 'jaket@gmail.com', '2020-07-13 19:37:36'),
(2, 'T279923871459519', '7800', 'jaket@gmail.com', '2020-07-13 19:37:36'),
(3, 'T719885638368602', '7800', 'jaket@gmail.com', '2020-07-13 19:43:48'),
(4, 'T729374552100893', '7800', 'jaket@gmail.com', '2020-07-13 20:07:33'),
(5, 'T089263124278999', '7800', 'jaket@gmail.com', '2020-07-13 21:10:59'),
(6, 'T566410313532961', '7800', 'jaket@gmail.com', '2020-07-13 21:29:34'),
(7, 'T947679707704188', '7800', 'jaket@gmail.com', '2020-07-13 21:36:19'),
(8, 'T697815854167225', '7800', 'jaket@gmail.com', '2020-07-13 21:37:30'),
(9, 'T822744407723870', '7800', 'jaket@gmail.com', '2020-07-13 21:39:22'),
(10, 'T243215366582652', '7800', 'shinigamijake35@gmail.com', '2020-07-13 21:43:52'),
(11, 'T480019793924048', '21600', 'ologun.aa@gmail.com', '2020-07-13 21:46:19'),
(12, 'T200386351418946', '7200', '', '2020-07-13 21:56:35'),
(13, 'T197120834518691', '7200', 'jaket@gmail.com', '2020-07-13 22:01:03'),
(14, '', '600', 'jaket@gmail.com', '2020-07-13 22:03:13'),
(15, 'T227968933596797', '600', 'test@email.com', '2020-07-13 22:26:01'),
(16, 'T648982749484816', '7200', 'test@email.com', '2020-07-13 22:30:28'),
(17, 'T537644619146542', '7800', 'justpeace91@ymail.com', '2020-07-13 22:31:37'),
(18, 'T877363511138685', '600', 'jaket@gmail.com', '2020-07-13 22:32:28'),
(19, 'T264536985118599', '600', 'ologun.aa@gmail.com', '2020-07-13 22:33:09'),
(20, 'T069036999216131', '600', 'test@email.com', '2020-07-13 22:34:04'),
(21, 'T521803726266847', '600', 'justpeace91@ymail.com', '2020-07-13 22:44:54'),
(22, 'T656662309465287', '7200', 'test@email.com', '2020-07-13 22:57:46'),
(23, 'T813996751699555', '7200', 'shinigamijake35@gmail.com', '2020-07-13 23:03:03'),
(24, 'T940971237672479', '7200', 'jaketuriacada@gmail.com', '2020-07-13 23:04:40'),
(25, 'T852952183595019', '7200', 'justpeace91@ymail.com', '2020-07-13 23:08:15'),
(26, 'T409426476117563', '600', 'justpeace91@ymail.com', '2020-07-13 23:12:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
