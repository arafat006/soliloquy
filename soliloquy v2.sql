-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2022 at 04:13 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `soliloquy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admininfo`
--

CREATE TABLE `admininfo` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admininfo`
--

INSERT INTO `admininfo` (`id`, `email`, `password`) VALUES
(1, 'sadiakhan1996@gmail.com', '2b43e931e87ca0d9cefe07fc9941fef95e208510');

-- --------------------------------------------------------

--
-- Table structure for table `home`
--

CREATE TABLE `home` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `home`
--

INSERT INTO `home` (`id`, `description`) VALUES
(1, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `itemdetails`
--

CREATE TABLE `itemdetails` (
  `id` int(11) NOT NULL,
  `serial` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'sub',
  `main_item` varchar(50) NOT NULL,
  `sub_item` varchar(255) NOT NULL,
  `img_path` varchar(255) NOT NULL DEFAULT 'Nan',
  `description` text NOT NULL,
  `color` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itemdetails`
--

INSERT INTO `itemdetails` (`id`, `serial`, `type`, `main_item`, `sub_item`, `img_path`, `description`, `color`) VALUES
(2, '1', 'main', 'Seeking Self', 'Seeking Self', 'none', 'This is about seeking self', '#7E2303+#D68254+#873103+#C04F02+#C04F02'),
(8, '2', 'main', 'Sail to Soul', 'Sail to Soul', 'none', 'Sailing Soul(s) (stylized in all lowercase) is the debut mixtape by American singer-songwriter Jhené Aiko; it was released on March 16, 2011 & re-released for streaming platforms on March 12, 2021. Aiko began working on the mixtape after she gave birth to her daughter. Aiko wrote all the mixtape\'s songs except \"July,\" which was written by Micah Powell. Most songs on the mixtape were produced by Fisticuffs, except “July” and “You vs Them” which were produced by Bei Maejor, “Real Now” which was produced by Roosevelt, “Do Better” which was produced by J. Lbs and “Growing Apart” which was produced by Tae Beast. The mixtape featured several guest vocalists, including Miguel, Drake, Gucci Mane, and Kanye West, Kendrick Lamar as well as other.', '#2E3521+#ACC1B4+#414C2F+#9AA582+#9AA582'),
(13, '3', 'main', 'Slip on Slaying', 'Slip on Slaying', 'none', 'Slip Stitch Slaying by Sharyn Bradford Lunn is the second book in the Cody Costin Cozy Mystery series. Cody\'s first mystery was quite the ordeal so no one could blame her for deciding to take a vacation by visiting her Gran\'s inn. She can think of no better way to relax and settle her nerves than spending quality time with her grandmother. Too bad her visit is cut short when she lands in another mystery, one that could cost Gran everything. Gran\'s best friend is found dead at her inn and, worse still, the police seem to think she\'s the one responsible. To clear Gran\'s name, Cody must dig deeper to find out who had the motive to commit murder so she can find the real killer and uncover the truth. But the closer she gets to answers, the closer she gets to being caught in the killer\'s sights.', '#270F35+#B78DAD+#3B1F41+#836090+#836090'),
(17, '4', 'main', 'Savour Savannah', 'Savour Savannah', 'none', 'Savour Savannah have always wanted to visit the Olde Pink House, but never planned ahead to get a reservation when we\'ve been in town. We decided to try and walk up to sit in the Tavern and lucked into a 20 min wait. The staff was wonderful- from the hostesses finding the right table to accommodate us with our 6month old in a stroller to Dave who brought us much needed beers while waiting and Hannah who was knowledgable, attentive and helpful as we dined. We enjoyed the atmosphere of the tavern - which included fireplaces, candlelight and a piano player, and the food was beyond excellent. We started with the blacked oysters with a trio of southern relishes and chutneys, all paired perfectly with the juicy oysters.\r\n\r\nhttps://www.tripadvisor.co.nz/ShowUserReviews-g60814-d509715-r326067884-Olde_Pink_House_Restaurant-Savannah_Georgia.html#', '#30150D+#856647+#442514+#7E4F2D+#7E4F2D'),
(95, '1.00001', 'sub', 'Seeking Self', 'life is balance', 'Nan', '', ''),
(96, '1.00002', 'sub', 'Seeking Self', 'dillema || à¦¦à§à¦¬à¦¿à¦§à¦¾', 'Nan', '', ''),
(97, '1.00003', 'sub', 'Seeking Self', 'a perfect disorder', 'Nan', '', ''),
(98, '1.00004', 'sub', 'Seeking Self', 'à¦¶à¦– à¦¬à¦¾à¦•à§à¦¸ || wish jar', 'Nan', '', ''),
(99, '1.00005', 'sub', 'Seeking Self', 'à¦¬à¦¿à¦¨à§‡ à¦ªà¦¯à¦¼à¦¸à¦¾à¦° à¦¬à¦¾à¦¯à¦¼à§‡à¦¾à¦¸à§à¦•à§‡à¦¾à¦ª', 'Nan', '', ''),
(100, '2.00001', 'sub', 'Sail to Soul', 'à¦œà§‡à¦¾à¦¨à¦¾à¦•à§€ || wear the words', 'Nan', '', ''),
(101, '2.00002', 'sub', 'Sail to Soul', 'à¦¤à¦¾à¦°à¦¾ || echo', 'Nan', '', ''),
(102, '2.00003', 'sub', 'Sail to Soul', 'sinked in inked || à¦œà§à¦¯à§‡à¦¾à¦¤à§à¦¸à§à¦¨à¦¾ à¦¸à§à¦¨à¦¾à¦¤', 'Nan', '', ''),
(103, '2.00004', 'sub', 'Sail to Soul', 'à¦¬à¦¿à¦•à§‡à¦² à¦¬à¦¾à¦°à¦¾à¦¨à§à¦¦à¦¾à¦° à¦¬à¦¾à¦¤à¦¿, à¦¬à§ƒà¦·à§à¦Ÿà¦¿ à¦†à¦° à¦¬à¦‡-à¦¸à§à¦®à§ƒà¦¤à¦¿', 'Nan', '', ''),
(104, '3.00001', 'sub', 'Slip on Slaying', 'perfectly perfecting', 'Nan', '', ''),
(105, '3.00002', 'sub', 'Slip on Slaying', 'nothing more || à¦†à¦° à¦•à¦¿à¦›à§ à¦¨à¦¾', 'Nan', '', ''),
(106, '3.00003', 'sub', 'Slip on Slaying', 'à¦®à¦–à¦®à¦²à§‡à¦° à¦¬à¦¾à¦•à§à¦¸', 'Nan', '', ''),
(107, '4.00001', 'sub', 'Savour Savannah', 'calming coffee', 'Nan', '', ''),
(108, '4.00002', 'sub', 'Savour Savannah', 'à¦•à¦¾à¦à¦šà§‡à¦° à¦•à§‡à§—à¦Ÿà¦¾', 'Nan', '', ''),
(109, '4.00003', 'sub', 'Savour Savannah', 'cooking comfort', 'Nan', '', ''),
(110, '4.00004', 'sub', 'Savour Savannah', 'cups and cocos', 'Nan', '', ''),
(111, '4.00005', 'sub', 'Savour Savannah', 'cakes and cookies', 'Nan', 'Hello test', '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL DEFAULT 'Nan',
  `path_s1` varchar(255) NOT NULL DEFAULT 'Nan',
  `path_s2` varchar(255) NOT NULL DEFAULT 'Nan',
  `path_s3` varchar(255) NOT NULL DEFAULT 'Nan',
  `caption_s1` varchar(255) NOT NULL,
  `caption_s2` varchar(255) NOT NULL,
  `caption_s3` varchar(255) NOT NULL,
  `catagory` varchar(255) NOT NULL,
  `sub_catagory` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `upload_date` datetime NOT NULL,
  `available` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `path`, `path_s1`, `path_s2`, `path_s3`, `caption_s1`, `caption_s2`, `caption_s3`, `catagory`, `sub_catagory`, `description`, `upload_date`, `available`) VALUES
(67, 'Flower', 'Nan', 'Nan', 'Nan', 'Nan', '', '', '', 'Seeking Self', 'à¦¶à¦– à¦¬à¦¾à¦•à§à¦¸ || wish jar', 'This is a flower test', '2021-09-10 05:35:29', 1),
(68, 'Snake', 'products/68_jan-kopriva-81KRiuf4cRQ-unsplash.jpg', 'Nan', 'Nan', 'Nan', '', '', '', 'Sail to Soul', 'à¦¬à¦¿à¦•à§‡à¦² à¦¬à¦¾à¦°à¦¾à¦¨à§à¦¦à¦¾à¦° à¦¬à¦¾à¦¤à¦¿, à¦¬à§ƒà¦·à§à¦Ÿà¦¿ à¦†à¦° à¦¬à¦‡-à¦¸à§à¦®à§ƒà¦¤à¦¿', 'Black mamba test', '2021-09-10 05:35:48', 1);

-- --------------------------------------------------------

--
-- Table structure for table `productslider`
--

CREATE TABLE `productslider` (
  `id_auto` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `iov_path` varchar(255) NOT NULL DEFAULT 'Nan',
  `captions` text NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'img',
  `save_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productslider`
--

INSERT INTO `productslider` (`id_auto`, `item_id`, `iov_path`, `captions`, `type`, `save_time`) VALUES
(16, 68, 'product_slide/68_1.jpg', 'Very rare', 'img', '2021-09-10 05:36:36'),
(17, 68, 'product_slide/68_2.jpg', 'snake bites', 'img', '2021-09-10 05:37:03');

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `upload_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `name`, `path`, `upload_date`) VALUES
(24, 'kie test', 'slides/2_austin-lowman-Y1pub0rxhvQ-unsplash.jpg', '2021-09-10 05:19:00'),
(25, 'Python', 'slides/2_david-clode-MlaQmWvzRTw-unsplash.jpg', '2021-09-10 05:20:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admininfo`
--
ALTER TABLE `admininfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home`
--
ALTER TABLE `home`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itemdetails`
--
ALTER TABLE `itemdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productslider`
--
ALTER TABLE `productslider`
  ADD PRIMARY KEY (`id_auto`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admininfo`
--
ALTER TABLE `admininfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `home`
--
ALTER TABLE `home`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `itemdetails`
--
ALTER TABLE `itemdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `productslider`
--
ALTER TABLE `productslider`
  MODIFY `id_auto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `productslider`
--
ALTER TABLE `productslider`
  ADD CONSTRAINT `productslider_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
