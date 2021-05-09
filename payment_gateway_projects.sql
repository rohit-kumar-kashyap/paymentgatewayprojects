-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2021 at 09:22 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payment_gateway_projects`
--

-- --------------------------------------------------------

--
-- Table structure for table `instamojo_payment_form`
--

CREATE TABLE `instamojo_payment_form` (
  `id` int(11) NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `payment_request_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instamojo_payment_form`
--

INSERT INTO `instamojo_payment_form` (`id`, `order_id`, `name`, `phone`, `email`, `amount`, `transaction_id`, `payment_id`, `payment_status`, `payment_request_id`) VALUES
(14, 'ORDER12318', 'mcc1', '8756251752', 'rohitkumar.28aug@gmail.com', '11', '512ebc044f194e2dab438627782f8d17', 'MOJO0c27O05A96090767', 'Credit', '512ebc044f194e2dab438627782f8d17'),
(15, 'ORDER78218', 'rpm1', '8756251752', 'rohitkumar.28aug@gmail.com', '11', '6ce7f5d65f4847b793a017ff196b8b8c', 'MOJO0c27705A96090768', 'Failed', '6ce7f5d65f4847b793a017ff196b8b8c'),
(16, 'ORDER69989', 'rpm1', '8756251752', 'rohitkumar.28aug@gmail.com', '11', '62e74e21c73a4d228f7d8731499f9623', 'MOJO0c27005A96090769', 'Credit', '62e74e21c73a4d228f7d8731499f9623');

-- --------------------------------------------------------

--
-- Table structure for table `paypal_payment_form`
--

CREATE TABLE `paypal_payment_form` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `payment_request_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paytm_payment_form`
--

CREATE TABLE `paytm_payment_form` (
  `id` int(11) NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_transaction_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paytm_payment_form`
--

INSERT INTO `paytm_payment_form` (`id`, `order_id`, `name`, `phone`, `email`, `amount`, `transaction_id`, `payment_mode`, `payment_status`, `bank_name`, `bank_transaction_id`) VALUES
(18, 'ORDER20898', 'Rohit Kumar Kashyap', '8756251752', 'rohitkumar.28aug@gmail.com', '9', '20210104111212800110168899602256407', 'NB', 'TXN_SUCCESS', 'PNB', '15488624852'),
(22, 'ORDER58400', 'CubersIndia', '8756251752', 'rohitkumar.28aug@gmail.com', '2', '20210104111212800110168496102235212', 'NB', 'TXN_FAILURE', 'AXIS', '10719458704');

-- --------------------------------------------------------

--
-- Table structure for table `payumoney_payment_form`
--

CREATE TABLE `payumoney_payment_form` (
  `id` int(11) NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `mihpayid` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `payment_message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `razorpay_payment_form`
--

CREATE TABLE `razorpay_payment_form` (
  `id` int(11) NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `payment_id` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `razorpay_payment_form`
--

INSERT INTO `razorpay_payment_form` (`id`, `order_id`, `name`, `phone`, `email`, `amount`, `transaction_id`, `payment_id`, `payment_status`) VALUES
(5, 'ORDER37943', 'rpm1', '8756251752', 'rohitkumar.28aug@gmail.com', '21', 'order_GLeHHxpaupV4VF', 'pay_GLeHr962i0jjqw', '1'),
(8, 'ORDER10762', 'CubersIndia', '8756251752', 'rohitkumar.28aug@gmail.com', '21', 'order_GLeP10cDEstb29', '', '0'),
(9, 'ORDER16589', 'Rohit Kumar Kashyap', '8756251752', 'rohitkumar.28aug@gmail.com', '55', 'order_GNYu50LzhPxziQ', 'pay_GNYuDCjW3UayvP', '1'),
(10, 'ORDER18294', 'CubersIndia', '8756251752', 'rohitkumar.28aug@gmail.com', '10', 'order_GNYunyHx9o1WrD', '', '0'),
(11, 'ORDER52977', 'rpm1', '8756251752', 'rohitkumar.28aug@gmail.com', '11', 'order_GNYzE4zzX5xwna', NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `stripe_payment_form`
--

CREATE TABLE `stripe_payment_form` (
  `id` int(11) NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `payment_request_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `instamojo_payment_form`
--
ALTER TABLE `instamojo_payment_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paypal_payment_form`
--
ALTER TABLE `paypal_payment_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paytm_payment_form`
--
ALTER TABLE `paytm_payment_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payumoney_payment_form`
--
ALTER TABLE `payumoney_payment_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `razorpay_payment_form`
--
ALTER TABLE `razorpay_payment_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stripe_payment_form`
--
ALTER TABLE `stripe_payment_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `instamojo_payment_form`
--
ALTER TABLE `instamojo_payment_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `paypal_payment_form`
--
ALTER TABLE `paypal_payment_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paytm_payment_form`
--
ALTER TABLE `paytm_payment_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `payumoney_payment_form`
--
ALTER TABLE `payumoney_payment_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `razorpay_payment_form`
--
ALTER TABLE `razorpay_payment_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `stripe_payment_form`
--
ALTER TABLE `stripe_payment_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
