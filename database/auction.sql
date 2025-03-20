-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2025 at 11:18 AM
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
-- Database: `auction`
--

-- --------------------------------------------------------

--
-- Table structure for table `bid`
--

CREATE TABLE `bid` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bid_amount` decimal(10,2) NOT NULL,
  `bid_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bid`
--

INSERT INTO `bid` (`id`, `product_id`, `user_id`, `bid_amount`, `bid_time`) VALUES
(90, 65, 4, 240.00, '2025-03-18 05:52:47'),
(91, 65, 4, 250.00, '2025-03-18 05:52:51'),
(92, 65, 4, 260.00, '2025-03-18 05:52:55'),
(93, 68, 7, 240.00, '2025-03-19 07:39:16'),
(94, 68, 7, 250.00, '2025-03-19 07:39:21'),
(95, 71, 4, 130.00, '2025-03-19 15:06:23'),
(96, 71, 4, 140.00, '2025-03-19 15:06:28'),
(97, 65, 4, 270.00, '2025-03-19 17:24:40'),
(98, 72, 4, 710.00, '2025-03-19 17:26:02'),
(99, 72, 4, 720.00, '2025-03-19 17:26:06'),
(100, 72, 4, 730.00, '2025-03-19 17:26:09'),
(101, 74, 4, 110.00, '2025-03-20 04:44:52'),
(102, 73, 4, 110.00, '2025-03-20 04:45:03'),
(103, 74, 4, 120.00, '2025-03-20 07:21:06'),
(104, 74, 4, 160.00, '2025-03-20 07:21:15'),
(105, 74, 4, 660.00, '2025-03-20 07:21:29');

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zip_code` varchar(20) NOT NULL,
  `card_name` varchar(100) NOT NULL,
  `card_number` varchar(20) NOT NULL,
  `exp_month` varchar(20) NOT NULL,
  `exp_year` int(11) NOT NULL,
  `cvv` varchar(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `amount_due` decimal(10,2) DEFAULT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `full_name`, `email`, `address`, `city`, `state`, `zip_code`, `card_name`, `card_number`, `exp_month`, `exp_year`, `cvv`, `created_at`, `amount_due`, `product_id`) VALUES
(18, 'Ram Patel', 'Ram@gmail.com', '11 ,ayodhya puram,surat', 'surat', 'India', '395006', 'arshit kyada', '1212121212121212', '12', 1212, '121', '2025-03-20 07:27:45', 660.00, 74);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `starting_bid` decimal(10,2) NOT NULL,
  `description` longtext NOT NULL,
  `product_condition` enum('new','used','refurbished') NOT NULL,
  `seller_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `category`, `start_time`, `end_time`, `starting_bid`, `description`, `product_condition`, `seller_id`) VALUES
(64, 'rolls roys ', 'electronics', '2025-03-17 17:45:00', '2025-03-17 17:47:00', 700.00, '  For auction is a stunning 2018 Ford Mustang GT, a perfect blend of performance, style, and comfort. This powerful sports coupe features a 5.0L V8 engine paired with a smooth 6-speed manual transmission, offering an exhilarating driving experience. With just 25,000 miles on the clock, this Mustang is in excellent condition both inside and out.  Key Features:  5.0L V8 engine producing 450 horsepower 6-speed manual transmission 25,000 miles Premium [color] exterior with black racing stripes [Color] leather interior with heated and cooled seats 20-inch alloy wheels with new tires Sync 3 infotainment system with Apple CarPlay and Android Auto Rearview camera, parking sensors, and keyless entry Recently serviced with new brake pads and battery', 'new', 5),
(65, 'rolls roys ', 'fashion', '2025-03-18 11:22:00', '2025-03-20 11:24:00', 230.00, 'Product Name: Luxury Stainless Steel Watch  Description: Experience timeless elegance with this Luxury Stainless Steel Watch, crafted for those who appreciate sophistication and precision. With a sleek design and a polished stainless steel band, this watch offers both durability and comfort, making it the perfect accessory for any occasion. The watch features a classic round dial with a date display, powered by a reliable quartz movement that ensures accurate timekeeping. Whether you\'re attending a formal event or looking to add a stylish touch to your daily attire, this watch effortlessly combines practicality with luxury.  Key Features:  Material: High-quality stainless steel casing and band for strength and style Movement: Quartz movement for precision and reliability Water Resistance: Rated up to 50 meters, suitable for everyday wear and light water exposure Dial: Classic round design with a minimalist face, featuring hour, minute, and second hands along with a date function Versatile Design: Perfect for ', 'new', 5),
(66, 'lambo', 'electronics', '2025-03-18 18:21:00', '2025-03-18 18:33:00', 230.00, 'Product Name: Luxury Stainless Steel Watch  Description: Experience timeless elegance with this Luxury Stainless Steel Watch, crafted for those who appreciate sophistication and precision. With a sleek design and a polished stainless steel band, this watch offers both durability and comfort, making it the perfect accessory for any occasion. The watch features a classic round dial with a date display, powered by a reliable quartz movement that ensures accurate timekeeping. Whether you\'re attending a formal event or looking to add a stylish touch to your daily attire, this watch effortlessly combines practicality with luxury.  Key Features:  Material: High-quality stainless steel casing and band for strength and style Movement: Quartz movement for precision and reliability Water Resistance: Rated up to 50 meters, suitable for everyday wear and light water exposure Dial: Classic round design with a minimalist face, featuring hour, minute, and second hands along with a date function Versatile Design: Perfect for ', 'new', 5),
(67, 'lambo', 'home', '2025-03-18 18:34:00', '2025-03-18 18:36:00', 700.00, 'Product Name: Luxury Stainless Steel Watch  Description: Experience timeless elegance with this Luxury Stainless Steel Watch, crafted for those who appreciate sophistication and precision. With a sleek design and a polished stainless steel band, this watch offers both durability and comfort, making it the perfect accessory for any occasion. The watch features a classic round dial with a date display, powered by a reliable quartz movement that ensures accurate timekeeping. Whether you\'re attending a formal event or looking to add a stylish touch to your daily attire, this watch effortlessly combines practicality with luxury.  Key Features:  Material: High-quality stainless steel casing and band for strength and style Movement: Quartz movement for precision and reliability Water Resistance: Rated up to 50 meters, suitable for everyday wear and light water exposure Dial: Classic round design with a minimalist face, featuring hour, minute, and second hands along with a date function Versatile Design: Perfect for ', 'new', 5),
(68, 'rolls roys ', 'fashion', '2025-03-19 13:08:00', '2025-03-19 13:10:00', 230.00, 'Product Name: Luxury Stainless Steel Watch  Description: Experience timeless elegance with this Luxury Stainless Steel Watch, crafted for those who appreciate sophistication and precision. With a sleek design and a polished stainless steel band, this watch offers both durability and comfort, making it the perfect accessory for any occasion. The watch features a classic round dial with a date display, powered by a reliable quartz movement that ensures accurate timekeeping. Whether you\'re attending a formal event or looking to add a stylish touch to your daily attire, this watch effortlessly combines practicality with luxury.  Key Features:  Material: High-quality stainless steel casing and band for strength and style Movement: Quartz movement for precision and reliability Water Resistance: Rated up to 50 meters, suitable for everyday wear and light water exposure Dial: Classic round design with a minimalist face, featuring hour, minute, and second hands along with a date function Versatile Design: Perfect for ', 'new', 5),
(69, 'rolls roys ', 'fashion', '2025-03-19 17:25:00', '2025-03-19 17:29:00', 700.00, '\r\n\r\nFor auction is a stunning 2018 Ford Mustang GT, a perfect blend of performance, style, and comfort. This powerful sports coupe features a 5.0L V8 engine paired with a smooth 6-speed manual transmission, offering an exhilarating driving experience. With just 25,000 miles on the clock, this Mustang is in excellent condition both inside and out.\r\n\r\nKey Features:\r\n\r\n5.0L V8 engine producing 450 horsepower\r\n6-speed manual transmission\r\n25,000 miles\r\nPremium [color] exterior with black racing stripes\r\n[Color] leather interior with heated and cooled seats\r\n20-inch alloy wheels with new tires\r\nSync 3 infotainment system with Apple CarPlay and Android Auto\r\nRearview camera, parking sensors, and keyless entry\r\nRecently serviced with new brake pads and battery', 'used', 5),
(70, 'Ford Rangler', 'automotive', '2025-03-19 17:59:00', '2025-03-19 18:03:00', 700.00, 'For Auction: 2018 Ford Ranger XLT – A Perfect Blend of Power, Style, and Utility\r\n\r\nUp for auction is a stunning 2018 Ford Ranger XLT, the ultimate truck that combines rugged performance with refined comfort. Powered by a 2.3L EcoBoost engine paired with a smooth 10-speed automatic transmission, this pickup offers both power and efficiency, making it an excellent choice for work or play. With just 25,000 miles, this Ranger is in exceptional condition inside and out.\r\n\r\nKey Features:\r\n\r\n2.3L EcoBoost engine delivering 270 horsepower\r\n10-speed automatic transmission\r\n25,000 miles\r\nPremium Blue exterior with bold styling\r\nBlack cloth interior with power-adjustable seats\r\n17-inch alloy wheels with new all-terrain tires\r\nSync 3 infotainment system with Apple CarPlay and Android Auto\r\nRearview camera, parking sensors, and keyless entry\r\nRecently serviced with new brake pads and battery\r\n\r\nWhether you\'re looking for a daily driver or a dependable workhorse, the 2018 Ford Ranger XLT delivers on every front. Don’t miss out on this fantastic opportunity!\r\n\r\n', 'new', 5),
(71, 'rolls roys ', 'fashion', '2025-03-19 20:35:00', '2025-03-19 20:37:00', 120.00, '\r\n\r\nFor auction is a stunning 2018 Ford Mustang GT, a perfect blend of performance, style, and comfort. This powerful sports coupe features a 5.0L V8 engine paired with a smooth 6-speed manual transmission, offering an exhilarating driving experience. With just 25,000 miles on the clock, this Mustang is in excellent condition both inside and out.\r\n\r\nKey Features:\r\n\r\n5.0L V8 engine producing 450 horsepower\r\n6-speed manual transmission\r\n25,000 miles\r\nPremium [color] exterior with black racing stripes\r\n[Color] leather interior with heated and cooled seats\r\n20-inch alloy wheels with new tires\r\nSync 3 infotainment system with Apple CarPlay and Android Auto\r\nRearview camera, parking sensors, and keyless entry\r\nRecently serviced with new brake pads and battery', 'refurbished', 8),
(72, 'Ford Rangler', 'fashion', '2025-03-19 22:55:00', '2025-03-19 22:57:00', 700.00, '\r\n\r\nFor auction is a stunning 2018 Ford Mustang GT, a perfect blend of performance, style, and comfort. This powerful sports coupe features a 5.0L V8 engine paired with a smooth 6-speed manual transmission, offering an exhilarating driving experience. With just 25,000 miles on the clock, this Mustang is in excellent condition both inside and out.\r\n\r\nKey Features:\r\n\r\n5.0L V8 engine producing 450 horsepower\r\n6-speed manual transmission\r\n25,000 miles\r\nPremium [color] exterior with black racing stripes\r\n[Color] leather interior with heated and cooled seats\r\n20-inch alloy wheels with new tires\r\nSync 3 infotainment system with Apple CarPlay and Android Auto\r\nRearview camera, parking sensors, and keyless entry\r\nRecently serviced with new brake pads and battery', 'used', 8),
(73, 'Ford Rangler', 'fashion', '2025-03-20 10:12:00', '2025-03-20 10:18:00', 100.00, '\r\n\r\nFor auction is a stunning 2018 Ford Mustang GT, a perfect blend of performance, style, and comfort. This powerful sports coupe features a 5.0L V8 engine paired with a smooth 6-speed manual transmission, offering an exhilarating driving experience. With just 25,000 miles on the clock, this Mustang is in excellent condition both inside and out.\r\n\r\nKey Features:\r\n\r\n5.0L V8 engine producing 450 horsepower\r\n6-speed manual transmission\r\n25,000 miles\r\nPremium [color] exterior with black racing stripes\r\n[Color] leather interior with heated and cooled seats\r\n20-inch alloy wheels with new tires\r\nSync 3 infotainment system with Apple CarPlay and Android Auto\r\nRearview camera, parking sensors, and keyless entry\r\nRecently serviced with new brake pads and battery', 'used', 8),
(74, 'Lamborgini', 'home', '2025-03-20 10:13:00', '2025-03-20 12:56:00', 100.00, '\r\n\r\nFor auction is a stunning 2018 Ford Mustang GT, a perfect blend of performance, style, and comfort. This powerful sports coupe features a 5.0L V8 engine paired with a smooth 6-speed manual transmission, offering an exhilarating driving experience. With just 25,000 miles on the clock, this Mustang is in excellent condition both inside and out.\r\n\r\nKey Features:\r\n\r\n5.0L V8 engine producing 450 horsepower\r\n6-speed manual transmission\r\n25,000 miles\r\nPremium [color] exterior with black racing stripes\r\n[Color] leather interior with heated and cooled seats\r\n20-inch alloy wheels with new tires\r\nSync 3 infotainment system with Apple CarPlay and Android Auto\r\nRearview camera, parking sensors, and keyless entry\r\nRecently serviced with new brake pads and battery', 'new', 8);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_url`) VALUES
(242, 64, 'uploads/car (3).jpg'),
(243, 64, 'uploads/car (15).jpg'),
(244, 64, 'uploads/car (12).jpg'),
(245, 64, 'uploads/car (13).jpg'),
(246, 64, 'uploads/car (17).jpg'),
(247, 65, 'uploads/car (2).jpg'),
(248, 65, 'uploads/car (3).jpg'),
(249, 65, 'uploads/car (4).jpg'),
(250, 65, 'uploads/car (1).jpg'),
(251, 65, 'uploads/car (7).jpg'),
(252, 66, 'uploads/car (1).jpg'),
(253, 66, 'uploads/car (8).jpg'),
(254, 66, 'uploads/car (12).jpg'),
(255, 66, 'uploads/car (15).jpg'),
(256, 66, 'uploads/car (10).jpg'),
(257, 67, 'uploads/car (2).jpg'),
(258, 67, 'uploads/car (13).jpg'),
(259, 67, 'uploads/car (11).jpg'),
(260, 67, 'uploads/car (15).jpg'),
(261, 67, 'uploads/car (9).jpg'),
(262, 68, 'uploads/car (6).jpg'),
(263, 68, 'uploads/car (13).jpg'),
(264, 68, 'uploads/car (11).jpg'),
(265, 68, 'uploads/car (10).jpg'),
(266, 68, 'uploads/car (15).jpg'),
(267, 64, 'uploads/car (7).jpg'),
(268, 64, 'uploads/car (8).jpg'),
(269, 64, 'uploads/car (14).jpg'),
(270, 64, 'uploads/car (15).jpg'),
(271, 64, 'uploads/car (7).jpg'),
(272, 64, 'uploads/car (8).jpg'),
(273, 64, 'uploads/car (14).jpg'),
(274, 64, 'uploads/car (15).jpg'),
(275, 69, 'uploads/car (13).jpg'),
(276, 69, 'uploads/car (14).jpg'),
(277, 69, 'uploads/car (10).jpg'),
(278, 69, 'uploads/car (5).jpg'),
(279, 69, 'uploads/car (3).jpg'),
(280, 70, 'uploads/car (5).jpg'),
(281, 70, 'uploads/car (7).jpg'),
(282, 70, 'uploads/car (8).jpg'),
(283, 70, 'uploads/car (9).jpg'),
(284, 70, 'uploads/car (10).jpg'),
(285, 71, 'uploads/car (9).jpg'),
(286, 71, 'uploads/car (14).jpg'),
(287, 71, 'uploads/car (14).jpg'),
(288, 71, 'uploads/car (14).jpg'),
(289, 71, 'uploads/car (14).jpg'),
(290, 72, 'uploads/car (8).jpg'),
(291, 72, 'uploads/car (6).jpg'),
(292, 72, 'uploads/car (13).jpg'),
(293, 72, 'uploads/car (15).jpg'),
(294, 72, 'uploads/car (10).jpg'),
(295, 73, 'uploads/car (5).jpg'),
(296, 73, 'uploads/car (9).jpg'),
(297, 73, 'uploads/car (10).jpg'),
(298, 73, 'uploads/car (7).jpg'),
(299, 73, 'uploads/car (8).jpg'),
(300, 74, 'uploads/car (19).jpg'),
(301, 74, 'uploads/car (23).jpg'),
(302, 74, 'uploads/car (22).jpg'),
(303, 74, 'uploads/car (25).jpg'),
(304, 74, 'uploads/car (16).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `user_id`, `rating`, `comment`, `created_at`) VALUES
(7, 74, 4, 4, 'very good', '2025-03-20 07:22:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `account_type` enum('seller','buyer') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `account_type`) VALUES
(4, 'buyer', 'arshitkyada75@gmail.com', '111', 'buyer'),
(5, 'seller', 'Hirenlakhani0007@gmail.com', '111', 'seller'),
(7, 'Rocky', 'rocky07@gmail.com', '0707', 'seller'),
(8, 'seller1', 'luxkheni@gmail.com', '111', 'seller'),
(9, 'john_doe', 'johndoe@example.com', 'JohnPass123', 'buyer'),
(10, 'sarah_james', 'sarahjames@example.com', 'SarahPass456', 'seller'),
(11, 'mike_wilson', 'mikewilson@example.com', 'MikeSecure789', 'buyer'),
(12, 'lisa_brown', 'lisabrown@example.com', 'LisaPass2024', 'seller'),
(13, 'david_clark', 'davidclark@example.com', 'DavidPass321', 'buyer'),
(14, 'emma_harris', 'emma@example.com', 'EmmaSecurePass', 'seller'),
(15, 'robert_smith', 'robertsmith@example.com', 'RobertPass654', 'buyer'),
(16, 'olivia_martin', 'olivia@example.com', 'OliviaPassword', 'seller'),
(17, 'william_thomas', 'william@example.com', 'WilliamPass852', 'buyer'),
(18, 'ava_davis', 'ava@example.com', 'AvaDavis123', 'seller'),
(19, 'james_moore', 'jamesmoore@example.com', 'JamesSecure999', 'buyer'),
(20, 'charlotte_lee', 'charlotte@example.com', 'CharlottePass!', 'seller'),
(21, 'benjamin_hall', 'benjamin@example.com', 'BenPass007', 'buyer'),
(22, 'mia_adams', 'mia@example.com', 'MiaAdamsPass', 'seller'),
(23, 'ethan_scott', 'ethan@example.com', 'EthanPass456', 'buyer'),
(24, 'amelia_evans', 'amelia@example.com', 'AmeliaPass789', 'seller'),
(25, 'matthew_baker', 'matthew@example.com', 'MattPass101', 'buyer'),
(26, 'sophia_carter', 'sophia@example.com', 'SophiaCarterPass', 'seller'),
(27, 'daniel_wright', 'daniel@example.com', 'DanielWright123', 'buyer'),
(28, 'isabella_gonzalez', 'isabella@example.com', 'IsabellaGPass', 'seller'),
(29, 'joseph_lopez', 'joseph@example.com', 'JosephPass567', 'buyer'),
(30, 'grace_hill', 'grace@example.com', 'GraceHill2024', 'seller'),
(31, 'samuel_green', 'samuel@example.com', 'SamuelGreen789', 'buyer'),
(32, 'lily_nelson', 'lily@example.com', 'LilyNelsonPass', 'seller'),
(33, 'henry_campbell', 'henry@example.com', 'HenryPass432', 'buyer'),
(34, 'ella_mitchell', 'ella@example.com', 'EllaSecurePass', 'seller'),
(35, 'jackson_perez', 'jackson@example.com', 'JacksonP2025', 'buyer'),
(36, 'scarlett_roberts', 'scarlett@example.com', 'ScarlettRPass', 'seller'),
(37, 'sebastian_turner', 'sebastian@example.com', 'SebastianT999', 'buyer'),
(38, 'hannah_phillips', 'hannah@example.com', 'HannahPhillips!', 'seller'),
(39, 'lucas_campbell', 'lucas@example.com', 'LucasPass852', 'buyer'),
(40, 'zoe_parker', 'zoe@example.com', 'ZoeParker123', 'seller'),
(41, 'levi_morris', 'levi@example.com', 'LeviMorris789', 'buyer'),
(42, 'natalie_cooper', 'natalie@example.com', 'NatalieC2024', 'seller'),
(43, 'dylan_reed', 'dylan@example.com', 'DylanRPass', 'buyer'),
(44, 'violet_bailey', 'violet@example.com', 'VioletBaileyPass', 'seller'),
(45, 'caleb_bennett', 'caleb@example.com', 'CalebPass555', 'buyer'),
(46, 'aria_ward', 'aria@example.com', 'AriaWardPass', 'seller'),
(47, 'gabriel_gray', 'gabriel@example.com', 'GabrielG999', 'buyer'),
(48, 'madeline_patterson', 'madeline@example.com', 'MadelineP2025', 'seller'),
(49, 'julian_foster', 'julian@example.com', 'JulianPass876', 'buyer'),
(50, 'claire_simmons', 'claire@example.com', 'ClaireSimmonsPass', 'seller'),
(51, 'nathan_watson', 'nathan@example.com', 'NathanWPass', 'buyer'),
(52, 'stella_russell', 'stella@example.com', 'StellaRussell123', 'seller'),
(53, 'andrew_bryant', 'andrew@example.com', 'AndrewB789', 'buyer'),
(54, 'leah_wood', 'leah@example.com', 'LeahWoodPass', 'seller'),
(55, 'theodore_butler', 'theodore@example.com', 'TheoPass999', 'buyer'),
(56, 'autumn_jenkins', 'autumn@example.com', 'AutumnJ2024', 'seller'),
(57, 'christopher_perry', 'chris@example.com', 'ChrisPerryPass', 'buyer'),
(58, 'lucy_price', 'lucy@example.com', 'LucyPrice123', 'seller');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `withdrawal_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `withdrawals`
--

INSERT INTO `withdrawals` (`id`, `seller_id`, `amount`, `withdrawal_date`) VALUES
(3, 8, 600.00, '2025-03-20 07:30:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bid`
--
ALTER TABLE `bid`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bid`
--
ALTER TABLE `bid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=305;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bid`
--
ALTER TABLE `bid`
  ADD CONSTRAINT `bid_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bid_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contactus`
--
ALTER TABLE `contactus`
  ADD CONSTRAINT `contactus_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD CONSTRAINT `withdrawals_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
