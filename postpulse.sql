-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2023 at 03:30 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `postpulse`
--

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `idkomentar` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `komentar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`idkomentar`, `id_post`, `username`, `komentar`) VALUES
(6, 17, 'nat', 'keren'),
(7, 33, 'nat', 'wowww'),
(8, 32, 'nat', 'bagus'),
(9, 20, 'nat', 'cantikk'),
(10, 19, 'nat', 'brawl star'),
(11, 25, 'nat', 'woww bibimbap'),
(12, 24, 'nat', 'enakk'),
(13, 21, 'nat', 'keren'),
(14, 34, 'nat', 'bagus hime cut'),
(15, 30, 'nat', 'wahh douyin  makeup'),
(16, 31, 'nat', 'wow');

-- --------------------------------------------------------

--
-- Table structure for table `komentarbalasan`
--

CREATE TABLE `komentarbalasan` (
  `idkomentarbalasan` int(11) NOT NULL,
  `idkomentar` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `komentar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komentarbalasan`
--

INSERT INTO `komentarbalasan` (`idkomentarbalasan`, `idkomentar`, `username`, `komentar`) VALUES
(6, 6, 'tan', 'iya'),
(7, 7, 'tan', 'keren'),
(8, 7, 'tan', 'wow'),
(9, 8, 'nat', 'pink');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `num_reports` int(11) DEFAULT 0,
  `like_count` int(11) DEFAULT 0,
  `dislike_count` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `image_url`, `description`, `username`, `num_reports`, `like_count`, `dislike_count`) VALUES
(1, 'image1.jpg', 'Description for post 1', 'user1', 5, 0, 0),
(2, 'image2.jpg', 'Description for post 2', 'user2', 8, 0, 0),
(3, 'image3.jpg', 'Description for post 3', 'user3', 3, 0, 0),
(4, 'image4.jpg', 'Description for post 4', 'user4', 12, 0, 0),
(5, 'image5.jpg', 'Description for post 5', 'user5', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `post_reports`
--

CREATE TABLE `post_reports` (
  `report_id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `report_text` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_reports`
--

INSERT INTO `post_reports` (`report_id`, `post_id`, `user_id`, `report_text`) VALUES
(1, 1, 1, 'Report text for post 1'),
(2, 2, 2, 'Report text for post 2'),
(3, 3, 3, 'Report text for post 3'),
(4, 4, 4, 'Report text for post 4'),
(5, 5, 5, 'Report text for post 5');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `request_id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `request_text` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`request_id`, `username`, `request_text`) VALUES
(1, 'user1', 'Request from user1'),
(2, 'user2', 'Request from user2'),
(3, 'user3', 'Request from user3'),
(4, 'user4', 'Request from user4'),
(5, 'user5', 'Request from user5');

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE `topic` (
  `id_topic` int(11) NOT NULL,
  `nama_topic` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`id_topic`, `nama_topic`) VALUES
(1, 'Baking'),
(2, 'Car'),
(3, 'Cooking'),
(4, 'Drawing'),
(5, 'Games'),
(6, 'Hairstyle'),
(7, 'K-Pop'),
(8, 'Make Up'),
(9, 'Sport');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(52) DEFAULT NULL,
  `email` varchar(52) DEFAULT NULL,
  `password` varchar(26) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `src` varchar(50) NOT NULL DEFAULT 'assets\\profileicon.png',
  `favoritsport` tinyint(1) NOT NULL DEFAULT 0,
  `favoritmakeup` tinyint(1) NOT NULL DEFAULT 0,
  `favoritkpop` tinyint(1) NOT NULL DEFAULT 0,
  `favorithairstyle` tinyint(1) NOT NULL DEFAULT 0,
  `favoritdrawing` tinyint(1) NOT NULL DEFAULT 0,
  `favoritbaking` tinyint(1) NOT NULL DEFAULT 0,
  `favoritcooking` tinyint(1) NOT NULL DEFAULT 0,
  `favoritcar` tinyint(1) NOT NULL DEFAULT 0,
  `favoritgame` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `description`, `src`, `favoritsport`, `favoritmakeup`, `favoritkpop`, `favorithairstyle`, `favoritdrawing`, `favoritbaking`, `favoritcooking`, `favoritcar`, `favoritgame`) VALUES
(1, 'eric', 'eric@gmail.com', '$2y$10$wJCC0aksD2dufD8I6lf', NULL, 'assets\\profileicon.png', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 'eric1', 'ericcw100@gmail.com', '$2y$10$38ywl9hsPNNjb40gt52', 'halo', 'assets\\profileicon.png', 1, 0, 1, 1, 1, 1, 1, 0, 1),
(3, 'eric', 'eric123@gmail.com', '$2y$10$7ZwAksIbQH0eZD9V3wF', NULL, 'assets\\profileicon.png', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 'abc', 'abc@gmail.com', '$2y$10$c7T3PqFIoHNGRAPcowN', 'hai                      ', 'assets\\profileicon.png', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 'kevin', 'kevin@gmail.com', '$2y$10$e6DdAFU37a/Z/jPjYRi', NULL, 'assets\\profileicon.png', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(13, 'nat', 'nataliamerry80@gmail.com', '$2y$10$4dYraJM8MvF6jTBV2PW', NULL, 'assets\\profileicon.png', 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ban_points` int(11) DEFAULT 0,
  `normal_points` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `ban_points`, `normal_points`) VALUES
(1, 'user1', 'user1@example.com', 1, 7),
(2, 'user2', 'user2@example.com', 1, 2),
(3, 'user3', 'user3@example.com', 0, 6),
(4, 'user4', 'user4@example.com', 0, 7),
(5, 'user5', 'user5@example.com', 0, 8),
(6, 'user1', 'user1@example.com', 2, 8),
(7, 'user2', 'user2@example.com', 1, 3),
(8, 'user3', 'user3@example.com', 0, 7),
(9, 'user4', 'user4@example.com', 5, 15),
(10, 'user5', 'user5@example.com', 3, 12);

-- --------------------------------------------------------

--
-- Table structure for table `user_post`
--

CREATE TABLE `user_post` (
  `id_post` int(11) NOT NULL,
  `id_topic` int(11) NOT NULL,
  `data_images` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_post`
--

INSERT INTO `user_post` (`id_post`, `id_topic`, `data_images`) VALUES
(17, 2, 'car.jpg'),
(18, 1, 'cheesecake.jpg'),
(19, 5, 'brawl star.jpg'),
(20, 7, 'jennie.jpg'),
(21, 4, 'doodle.jpg'),
(22, 2, 'pink car.jpg'),
(23, 9, 'abs workout.jpg'),
(24, 1, 'heart rollcake.jpg'),
(25, 3, 'bibimbap.jpg'),
(26, 5, 'spike.jpg'),
(27, 6, 'hs2.jpg'),
(28, 5, 'collete.jpg'),
(29, 7, 'lesserafim.jpg'),
(30, 8, 'douyin.jpg'),
(31, 9, 'jogging.jpg'),
(32, 2, 'porsche.jpg'),
(33, 7, 'BABYMONSTER -  BATTER UP  M_V TEASER.mp4'),
(34, 6, 'hime.jpg');

--

CREATE TABLE `categories` (
  `categoriesID` int (20) NOT NULL,
  `name` varchar (50) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `categories` (`categoryID`, `name`) VALUES
(1, 'kpop'),
(2, 'car'),
(3, 'sports'),
(4,	'makeup'),	
(5,	'hairstyle'),	
(6,	'game'),	
(7,	'drawing'),	
(8,	'cooking'),	
(9,	'baking');

-- Indexes for dumped tables
--

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`idkomentar`);

--
-- Indexes for table `komentarbalasan`
--
ALTER TABLE `komentarbalasan`
  ADD PRIMARY KEY (`idkomentarbalasan`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `post_reports`
--
ALTER TABLE `post_reports`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`id_topic`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_post`
--
ALTER TABLE `user_post`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `id_topic` (`id_topic`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `idkomentar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `komentarbalasan`
--
ALTER TABLE `komentarbalasan`
  MODIFY `idkomentarbalasan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `post_reports`
--
ALTER TABLE `post_reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `topic`
--
ALTER TABLE `topic`
  MODIFY `id_topic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_post`
--
ALTER TABLE `user_post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `post_reports`
--
ALTER TABLE `post_reports`
  ADD CONSTRAINT `post_reports_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`),
  ADD CONSTRAINT `post_reports_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `user_post`
--
ALTER TABLE `user_post`
  ADD CONSTRAINT `user_post_ibfk_1` FOREIGN KEY (`id_topic`) REFERENCES `topic` (`id_topic`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
