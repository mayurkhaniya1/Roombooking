-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2024 at 11:40 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `roombooking`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_cred`
--

CREATE TABLE `admin_cred` (
  `sr_no` int(11) NOT NULL,
  `admin_name` varchar(150) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_cred`
--

INSERT INTO `admin_cred` (`sr_no`, `admin_name`, `admin_password`) VALUES
(1, 'Mohit00', 'Admin101');

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

CREATE TABLE `booking_details` (
  `sr_no` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `total_pay` int(11) NOT NULL,
  `room_no` int(11) DEFAULT NULL,
  `user_name` varchar(100) NOT NULL,
  `phoneno` bigint(13) NOT NULL,
  `address` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_details`
--

INSERT INTO `booking_details` (`sr_no`, `booking_id`, `room_name`, `price`, `total_pay`, `room_no`, `user_name`, `phoneno`, `address`) VALUES
(1, 1, 'Supreme Deluxe Room', 1800, 3600, NULL, 'Mohit Chudasama', 9664647582, 'asbcvguf,jdbd,23,er');

-- --------------------------------------------------------

--
-- Table structure for table `booking_order`
--

CREATE TABLE `booking_order` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `arrival` int(11) NOT NULL DEFAULT 0,
  `booking_status` varchar(100) NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_order`
--

INSERT INTO `booking_order` (`booking_id`, `user_id`, `room_id`, `check_in`, `check_out`, `arrival`, `booking_status`, `order_id`, `datentime`) VALUES
(1, 10, 17, '2024-09-28', '2024-09-30', 0, '', 'ORD_10520386', '2024-09-28 21:50:38');

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE `carousel` (
  `sr_no` int(11) NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`sr_no`, `image`) VALUES
(16, 'IMG_58333.png'),
(17, 'IMG_26710.png'),
(18, 'IMG_90246.png'),
(19, 'IMG_55683.png'),
(20, 'IMG_23412.png'),
(23, 'IMG_18814.png');

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `sr_no` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `gmap` varchar(100) NOT NULL,
  `pn1` bigint(13) NOT NULL,
  `pn2` bigint(13) NOT NULL,
  `pn3` bigint(13) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fb` varchar(100) NOT NULL,
  `insta` varchar(100) NOT NULL,
  `tw` varchar(100) NOT NULL,
  `iframe` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`sr_no`, `address`, `gmap`, `pn1`, `pn2`, `pn3`, `email`, `fb`, `insta`, `tw`, `iframe`) VALUES
(1, 'Railway Station Rd, Mullawada, Junagadh, Gujarat 362001', 'https://maps.app.goo.gl/cnLrLRC7ftFzaSc9A', 918320077618, 917096188315, 919664647582, 'cm45986703@gmail.com', 'https://www.facebook.com/', 'https://www.instagram.com/', 'https://x.com/?lang=en', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7204.775456467415!2d70.46425700449521!3d21.532873194627843!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395803d80518f01b:0x909ccb6e308524d7!2sBellevue Sarovar Premiere, Junagadh!5e1!3m2!1sen!2sin!4v1723487449771!5m2!1sen!2sin');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `icon`, `name`, `description`) VALUES
(9, 'wifi.svg', 'wifi', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Id libero incidunt laudantium quo sunt dolorem officia.'),
(10, 'IMG_55017.svg', 'Air conditioner', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Id libero incidunt laudantium quo sunt dolorem officia.'),
(11, 'IMG_96925.svg', 'Television', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Id libero incidunt laudantium quo sunt dolorem officia.'),
(12, 'IMG_48957.svg', 'Geyser', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Id libero incidunt laudantium quo sunt dolorem officia.'),
(14, 'IMG_46525.svg', 'Room Heater', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Id libero incidunt laudantium quo sunt dolorem officia.'),
(15, 'IMG_51836.svg', 'Spa', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Id libero incidunt laudantium quo sunt dolorem officia.');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `name`) VALUES
(16, 'Bedroom'),
(17, 'Balcony'),
(18, 'Kitchen'),
(19, 'Double room');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `area` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `adult` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `description` varchar(350) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `removed` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `area`, `price`, `quantity`, `adult`, `children`, `description`, `status`, `removed`) VALUES
(14, 'Simple Room', 250, 750, 10, 2, 3, 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ea eaque nulla neque quasi tempora ad. Sed commodi perferendis nobis provident a accusamus illo consequatur fugit consequuntur id, itaque recusandae dolore doloribus consectetur culpa sint. Temporibus velit molestias eos, explicabo minus est facilis odio blanditiis assumenda voluptatum elige', 1, 0),
(15, 'Deluxe Room', 310, 950, 10, 2, 4, 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ea eaque nulla neque quasi tempora ad. Sed commodi perferendis nobis provident a accusamus illo consequatur fugit consequuntur id, itaque recusandae dolore doloribus consectetur culpa sint. Temporibus velit molestias eos, explicabo minus est facilis odio blanditiis assumenda voluptatum elige', 1, 0),
(16, 'Luxury Room', 600, 1550, 4, 4, 6, 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ea eaque nulla neque quasi tempora ad. Sed commodi perferendis nobis provident a accusamus illo consequatur fugit consequuntur id, itaque recusandae dolore doloribus consectetur culpa sint. Temporibus velit molestias eos, explicabo minus est facilis odio blanditiis assumenda voluptatum elige', 1, 0),
(17, 'Supreme Deluxe Room', 750, 1800, 2, 4, 6, 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ea eaque nulla neque quasi tempora ad. Sed commodi perferendis nobis provident a accusamus illo consequatur fugit consequuntur id, itaque recusandae dolore doloribus consectetur culpa sint. Temporibus velit molestias eos, explicabo minus est facilis odio blanditiis assumenda voluptatum elige', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `room_facilities`
--

CREATE TABLE `room_facilities` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `facilities_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_facilities`
--

INSERT INTO `room_facilities` (`sr_no`, `room_id`, `facilities_id`) VALUES
(271, 14, 9),
(272, 14, 10),
(273, 14, 12),
(279, 16, 9),
(280, 16, 10),
(281, 16, 11),
(282, 16, 12),
(283, 16, 14),
(284, 16, 15),
(311, 15, 9),
(312, 15, 10),
(313, 15, 11),
(314, 15, 12),
(315, 15, 14),
(316, 17, 9),
(317, 17, 10),
(318, 17, 11),
(319, 17, 12),
(320, 17, 14),
(321, 17, 15);

-- --------------------------------------------------------

--
-- Table structure for table `room_feature`
--

CREATE TABLE `room_feature` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `features_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_feature`
--

INSERT INTO `room_feature` (`sr_no`, `room_id`, `features_id`) VALUES
(131, 14, 16),
(132, 14, 17),
(136, 16, 16),
(137, 16, 17),
(138, 16, 18),
(139, 16, 19),
(153, 15, 16),
(154, 15, 17),
(155, 17, 16),
(156, 17, 17),
(157, 17, 18),
(158, 17, 19);

-- --------------------------------------------------------

--
-- Table structure for table `room_images`
--

CREATE TABLE `room_images` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `thumb` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_images`
--

INSERT INTO `room_images` (`sr_no`, `room_id`, `image`, `thumb`) VALUES
(16, 14, 'IMG_53275.png', 0),
(21, 15, 'IMG_89147.png', 0),
(22, 16, 'IMG_39017.jpg', 0),
(26, 16, 'IMG_27612.png', 0),
(27, 16, 'IMG_83143.jpg', 0),
(37, 14, 'IMG_45766.png', 1),
(38, 15, 'IMG_37962.jpg', 1),
(39, 16, 'IMG_17227.png', 1),
(41, 17, 'IMG_25369.jpg', 1),
(43, 17, 'IMG_94607.png', 0),
(44, 17, 'IMG_89525.jpg', 0),
(46, 17, 'IMG_86790.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `sr_no` int(11) NOT NULL,
  `site_title` varchar(50) NOT NULL,
  `site_about` varchar(255) NOT NULL,
  `shutdown` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`sr_no`, `site_title`, `site_about`, `shutdown`) VALUES
(1, 'Royal Hotel', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis id voluptatum nostrum aliquid debitis,\n sequi, sapiente culpa unde minus tempora totam veritatis, sed modi fugiat exercitationem obcaecati impedit? Cum.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `team_details`
--

CREATE TABLE `team_details` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `picture` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_details`
--

INSERT INTO `team_details` (`sr_no`, `name`, `picture`) VALUES
(35, 'Mohit', 'IMG_33491.jpg'),
(36, 'Meet', 'IMG_31163.jpg'),
(37, 'Deep', 'IMG_45071.jpg'),
(38, 'Mohit.C.', 'IMG_22062.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_cred`
--

CREATE TABLE `user_cred` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(150) NOT NULL,
  `phoneno` bigint(14) NOT NULL,
  `pincode` int(6) NOT NULL,
  `dob` date NOT NULL,
  `profile` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `token` varchar(255) DEFAULT NULL,
  `t_expire` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_cred`
--

INSERT INTO `user_cred` (`id`, `name`, `surname`, `email`, `address`, `phoneno`, `pincode`, `dob`, `profile`, `password`, `is_verified`, `token`, `t_expire`, `status`, `datentime`) VALUES
(10, 'Mohit', 'Chudasama', 'mohitc0000666@gmail.com', 'asbcvguf,jdbd,23,er', 9664647582, 362240, '2005-02-25', 'IMG_22062.jpeg', '$2y$10$iQfeYtOMs.CvXw4byR.noeFvttAhZwwbTF5r3NFLKg.R6kSEnaxRi', 1, NULL, NULL, 1, '2024-09-02 08:50:41');

-- --------------------------------------------------------

--
-- Table structure for table `user_queries`
--

CREATE TABLE `user_queries` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` varchar(500) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_queries`
--

INSERT INTO `user_queries` (`sr_no`, `name`, `email`, `subject`, `message`, `date`, `seen`) VALUES
(33, 'Mohit', 'cm45986703@gmail.com', 'Profile photo', 'My profile photo is very blurry. I can&#039;t recognize myself.', '2024-09-13 20:12:14', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_cred`
--
ALTER TABLE `admin_cred`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `facilities_id` (`facilities_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `room_feature`
--
ALTER TABLE `room_feature`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `room id` (`room_id`),
  ADD KEY `features id` (`features_id`);

--
-- Indexes for table `room_images`
--
ALTER TABLE `room_images`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `team_details`
--
ALTER TABLE `team_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `user_cred`
--
ALTER TABLE `user_cred`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_queries`
--
ALTER TABLE `user_queries`
  ADD PRIMARY KEY (`sr_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_cred`
--
ALTER TABLE `admin_cred`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking_order`
--
ALTER TABLE `booking_order`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `room_facilities`
--
ALTER TABLE `room_facilities`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=322;

--
-- AUTO_INCREMENT for table `room_feature`
--
ALTER TABLE `room_feature`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `room_images`
--
ALTER TABLE `room_images`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `team_details`
--
ALTER TABLE `team_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `user_cred`
--
ALTER TABLE `user_cred`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_queries`
--
ALTER TABLE `user_queries`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD CONSTRAINT `booking_details_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking_order` (`booking_id`);

--
-- Constraints for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD CONSTRAINT `booking_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_cred` (`id`),
  ADD CONSTRAINT `booking_order_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Constraints for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD CONSTRAINT `facilities_id` FOREIGN KEY (`facilities_id`) REFERENCES `facilities` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `room_id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `room_feature`
--
ALTER TABLE `room_feature`
  ADD CONSTRAINT `features id` FOREIGN KEY (`features_id`) REFERENCES `features` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `room id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `room_images`
--
ALTER TABLE `room_images`
  ADD CONSTRAINT `room_images_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
