-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2025 at 12:52 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `theatre`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `show` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` mediumtext NOT NULL,
  `image_url` varchar(64) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `user`, `show`, `title`, `content`, `image_url`, `created`) VALUES
(1, 1, 1, 'Review of The Phantom of the Opera', 'Amazing show! The music and performance were incredible.', 'phantom.jpg', '2025-03-25 15:13:35'),
(2, 2, 2, 'Inception: A Mind-bending Film', 'A stunning thriller that challenges the mind with its complex narrative.', 'inception.jpg', '2025-03-25 15:13:35'),
(3, 3, 3, 'The Lion King: A Visual Feast', 'A spectacular performance that captures the essence of the movie beautifully.', 'lion_king.jpg', '2025-03-25 15:13:35'),
(4, 1, 4, 'Mary Poppins now showing', 'A musical marvel not to be missed.', 'mary_poppins.jpg', '2025-05-20 12:27:07'),
(5, 4, 4, 'Phantom of the Opera – An Actor’s Perspective', 'Phantom of the Opera – An Actor’s Perspective', 'theatre.jpg', '2025-06-03 13:58:08');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `blog` int(11) NOT NULL,
  `content` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `user`, `blog`, `content`, `created`) VALUES
(1, 2, 1, 'I absolutely agree, the performance was breathtaking!', '2025-03-25 15:13:47'),
(2, 1, 2, 'The concept of the movie was fascinating, a true masterpiece.', '2025-03-25 15:13:47'),
(3, 3, 3, 'I love the costumes and choreography in this show!', '2025-03-25 15:13:47'),
(7, 4, 4, 'Cats is such a unique show!', '2025-06-03 08:57:16');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `content` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `user`, `content`, `created`) VALUES
(1, 1, 'Great user interface, but could use more show options.', '2025-03-25 15:13:59'),
(2, 2, 'Fantastic experience, easy to navigate the website.', '2025-03-25 15:13:59'),
(3, 3, 'Not enough information on upcoming shows.', '2025-03-25 15:13:59'),
(4, 4, 'test feedback', '2025-06-03 09:37:30');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `show` int(11) NOT NULL,
  `content` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `user`, `show`, `content`, `created`) VALUES
(1, 1, 1, 'A truly mesmerizing performance that captivated me from start to finish.', '2025-03-25 15:14:15'),
(2, 2, 2, 'Inception is a must-watch for anyone who enjoys mind-bending thrillers.', '2025-03-25 15:14:15'),
(3, 3, 3, 'The Lion King show was spectacular, but I felt it lacked some of the emotional depth of the original.', '2025-03-25 15:14:15');

-- --------------------------------------------------------

--
-- Table structure for table `show`
--

CREATE TABLE `show` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `type` enum('film','theatre') NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `show`
--

INSERT INTO `show` (`id`, `name`, `type`, `created`) VALUES
(1, 'The Phantom of the Opera', 'theatre', '2025-03-25 15:13:15'),
(2, 'Inception', 'film', '2025-03-25 15:13:15'),
(3, 'The Lion King', 'theatre', '2025-03-25 15:13:15'),
(4, 'Mary Poppins', 'theatre', '2025-05-20 12:24:57');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `status` enum('user','admin','inactive') NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `status`, `created`) VALUES
(1, 'Anna', 'password123', 'anna@gmail.com', 'user', '2025-03-25 15:12:10'),
(2, 'Yarchyk', 'password456', 'jane@example.com', 'admin', '2025-03-25 15:12:10'),
(3, 'Rostyk', 'password789', 'alice@example.com', 'inactive', '2025-03-25 15:12:10'),
(4, 'Eduard', '$2y$10$F0Lp3l3Rl.jeElQhz.S5O.9YeYNzJHFEcecKCJh.nGS6.DAhc/rlq', 'test@example.com', 'admin', '2025-05-27 10:52:42'),
(5, 'testuser2', '$2y$10$Qe6wYK3u76ETpY4La0fo2u5jPBl1B82PbG7K5B3v01ElXYf08059O', 'test2@example.com', 'user', '2025-05-27 12:32:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`),
  ADD KEY `show` (`show`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`),
  ADD KEY `blog` (`blog`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`),
  ADD KEY `show` (`show`);

--
-- Indexes for table `show`
--
ALTER TABLE `show`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `show`
--
ALTER TABLE `show`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `blog_ibfk_2` FOREIGN KEY (`show`) REFERENCES `show` (`id`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`blog`) REFERENCES `blog` (`id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`show`) REFERENCES `show` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
