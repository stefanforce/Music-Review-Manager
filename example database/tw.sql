-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2020 at 03:45 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tw`
--
CREATE DATABASE tw;
USE tw;
-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `username` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `id` int(11) NOT NULL,
  `track_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `track_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `favourites`
--

INSERT INTO `favourites` (`username`, `id`, `track_id`, `track_name`) VALUES
('Cubiclemon', 1, '7vG87TIUXj58hr2vFDiBPa', 'Metin 2 - Unkwon Composer'),
('Cubiclemon', 2, '4qDHt2ClApBBzDAvhNGWFd', 'Crab Rave'),
('ziccoaieneironic', 3, '2QbGvQssb0VLLS4x5NOmyJ', 'RICKY'),
('TestUser', 4, '7vG87TIUXj58hr2vFDiBPa', 'Metin 2 - Unkwon Composer'),
('Admin', 5, '7vG87TIUXj58hr2vFDiBPa', 'Metin 2 - Unkwon Composer'),
('Cubiclemon', 6, '7LioRemkSsZh1QEiKi7t1k', 'PIZZA TIME'),
('username', 7, '7vG87TIUXj58hr2vFDiBPa', 'Metin 2 - Unkwon Composer'),
('stefantiperciuc', 8, '2XU0oxnq2qxCpomAAuJY8K', 'Dance Monkey'),
('pepegwa', 9, '6PHYdpPzzpDGWbMhfR2OPk', 'Soviet Loli Anthem'),
('Cubiclemon', 11, '28cnXtME493VX9NOw9cIUh', 'Hurt'),
('Cubiclemon', 12, '18AXbzPzBS8Y3AkgSxzJPb', 'In The Air Tonight - 2015 Remastered');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `type` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `entity_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `entity_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `text` varchar(5000) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `written_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `user_name`, `type`, `entity_id`, `entity_name`, `text`, `written_at`) VALUES
(57, 13, 'ziccoaieneironic', 'track', '7vG87TIUXj58hr2vFDiBPa', 'Metin 2 - Unkwon Composer', '─────────────────────────────────────────────────────────────────────────────────────────────────────────\r\n─██████──██████─██████████─██████████████────██████████████─██████████████─██████████████─██████████████─\r\n─██░░██──██░░██─██░░░░░░██─██░░░░░░░░░░██────██░░░░░░░░░░██─██░░░░░░░░░░██─██░░░░░░░░░░██─██░░░░░░░░░░██─\r\n─██░░██──██░░██─████░░████─██████░░██████────██████████░░██─██░░██████░░██─██████████░░██─██░░██████░░██─\r\n─██░░██──██░░██───██░░██───────██░░██────────────────██░░██─██░░██──██░░██─────────██░░██─██░░██──██░░██─\r\n─██░░██████░░██───██░░██───────██░░██────────██████████░░██─██░░██──██░░██─██████████░░██─██░░██──██░░██─\r\n─██░░░░░░░░░░██───██░░██───────██░░██────────██░░░░░░░░░░██─██░░██──██░░██─██░░░░░░░░░░██─██░░██──██░░██─\r\n─██░░██████░░██───██░░██───────██░░██────────██░░██████████─██░░██──██░░██─██░░██████████─██░░██──██░░██─\r\n─██░░██──██░░██───██░░██───────██░░██────────██░░██─────────██░░██──██░░██─██░░██─────────██░░██──██░░██─\r\n─██░░██──██░░██─████░░████─────██░░██────────██░░██████████─██░░██████░░██─██░░██████████─██░░██████░░██─\r\n─██░░██──██░░██─██░░░░░░██─────██░░██────────██░░░░░░░░░░██─██░░░░░░░░░░██─██░░░░░░░░░░██─██░░░░░░░░░░██─\r\n─██████──██████─██████████─────██████────────██████████████─██████████████─██████████████─██████████████─\r\n─────────────────────────────────────────────────────────────────────────────────────────────────────────', '2020-05-31 19:52:06'),
(97, 2, 'Admin', 'track', '7vG87TIUXj58hr2vFDiBPa', 'Metin 2 - Unkwon Composer', '░░░░░▒░░▄██▄░▒░░░░░░ \r\n░░░▄██████████▄▒▒░░░ \r\n░▒▄████████████▓▓▒░░ \r\n▓███▓▓█████▀▀████▒░░ \r\n▄███████▀▀▒░░░░▀█▒░░ \r\n████████▄░░░░░░░▀▄░░ \r\n▀██████▀░░▄▀▀▄░░▄█▒░ \r\n░█████▀░░░░▄▄░░▒▄▀░░ \r\n░█▒▒██░░░░▀▄█░░▒▄█░░ \r\n░█░▓▒█▄░░░░░░░░░▒▓░░ \r\n░▀▄░░▀▀░▒░░░░░▄▄░▒░░ \r\n░░█▒▒▒▒▒▒▒▒▒░░░░▒░░░ \r\n░░░▓▒▒▒▒▒░▒▒▄██▀░░░░ \r\n░░░░▓▒▒▒░▒▒░▓▀▀▒░░░░ \r\n░░░░░▓▓▒▒░▒░░▓▓░░░░░ \r\n░░░░░░░▒▒▒▒▒▒▒░░░░░░', '2020-06-07 19:19:11'),
(98, 1, 'Cubiclemon', 'track', '7vG87TIUXj58hr2vFDiBPa', 'Metin 2 - Unkwon Composer', '⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⠟⠩⠶⣾⣿⡿⢯⣍⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⠏⠀⠀⠈⠉⠀⣠⢤⠈⠋⠀⢠⣄⠉⢻⣿⣿⣿⣿⠃⠈⢿⣿⣿⣿⣿⣿\r\n⣿⡟⠁⠀⠀⠀⣹⣦⣀⣙⣈⣀⢶⣤⣈⣁⣠⣾⣿⣿⣿⡿⠀⠀⠼⢿⣿⣿⣿⣿\r\n⡏⠀⠀⠠⣤⠦⣭⣙⣛⠛⠋⠁⠀⠙⠛⢉⣻⣿⣿⣿⠋⠁⠀⠀⠀⠀⠀⠀⠈⣿\r\n⡇⠀⠀⠀⠛⠮⣽⣒⣻⣭⢽⣿⣿⣿⣿⣿⣿⣿⣿⡇⠀⠀⠀⠀⠀⠀⠀⠀⠀⣿\r\n⡇⠀⠀⠀⠀⠀⠀⠀⠈⠉⠉⠉⠉⠉⠉⣼⣿⣿⣿⣧⠀⠀⠀⠀⠀⠀⠀⠀⢰⣿\r\n⡟⠳⢤⣤⣀⣀⣀⠀⠀⠀⣀⣀⣤⣴⣾⣿⣿⣿⣿⣿⣷⣦⣤⣤⣤⣤⣤⣴⣾⣿\r\n⣇⠀⠀⠀⠀⠉⠉⠈⠁⠈⠉⠉⡙⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⢠⣶⠿⠿⣷⡄⠈⣠⣶⠿⢿⣶⡄⠉⣡⣶⠿⠿⣶⡄⠄⣿⡇⢀⣾⡿⠃\r\n⣿⣏⠄⠄⠄⠄⢰⣿⡇⢀⠄⣿⣿⠄⣿⡏⠄⠄⠄⠄⠄⣿⣿⣿⣿⡀\r\n⠹⣿⣄⣠⣶⡆⠄⢿⣷⣀⣠⣿⡟⠄⢻⣷⣄⣠⣶⠆⠄⣿⡏⠈⢿', '2020-06-07 19:24:04'),
(109, 5, 'pepegwa', 'track', '6PHYdpPzzpDGWbMhfR2OPk', 'Soviet Loli Anthem', 'AYAYA BEST SONG', '2020-06-07 22:16:45'),
(111, 1, 'Cubiclemon', 'track', '6PHYdpPzzpDGWbMhfR2OPk', 'Soviet Loli Anthem', '⣿⣿⣿⣿⣿⣿⠿⠛⣉⣍⠁⠄⠈⠉⠉⠉⠉⠉⠉⡩⣍⡻⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⡿⢃⣴⡿⠛⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠘⢷⣝⣞⢿⣿⣿⣿⣿\r\n⣿⣿⣿⠟⣰⣿⠟⠁⠄⠄⠄⠄⠄⠄⢀⣀⣤⠄⠄⠄⠄⠙⢯⣻⣿⣿⣿⣿\r\n⣿⣿⣿⣸⣿⠏⠄⠄⠄⠄⠄⢀⣤⣴⣿⣿⣿⣷⡄⠄⠄⠄⠄⣧⠛⣿⣿⣿\r\n⣿⣿⡇⣿⣯⠄⠄⠄⠄⠄⠄⢸⣿⣿⣿⣿⣿⣿⣷⠦⠄⠄⠄⠉⠂⢹⣿⣿\r\n⣿⣿⡇⡿⠃⠄⠄⠄⠄⠄⠄⣉⣛⣿⣿⣿⣿⣿⣶⣶⣤⣴⠄⠄⠄⠘⢿⣿\r\n⣿⣿⠄⠄⠄⠄⠄⠄⠄⠄⠋⡉⠻⣿⣿⣿⣿⢫⡉⠄⢹⣿⡀⠐⠂⢁⣾⣿\r\n⣿⣿⡀⠄⠄⠄⠄⠄⠈⠄⣀⣥⣦⡾⠄⣿⣿⣶⣿⣿⣿⣿⡇⠄⠄⠸⣿⣿\r\n⣿⣿⣇⠄⠄⠄⠄⠄⠄⢼⣿⣿⣿⠏⠄⣽⣿⣿⣿⣿⣿⣿⡇⠄⡀⠄⣿⣿\r\n⣿⣿⣿⣷⡀⠄⠄⠄⢀⠘⢿⣿⣿⠄⠂⠛⣛⣿⣿⣿⣿⣿⣇⣾⣿⠄⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣦⠸⣿⣼⡏⠁⠄⠘⢻⡛⢓⡛⣿⣿⡿⣼⣿⣿⢀⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣇⠘⠏⠃⠄⣤⣴⣶⣶⣿⣿⣿⢻⣾⣿⣿⣧⣾⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣷⣦⡀⠈⠻⣿⣿⣽⣿⠋⣰⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣶⣤⣈⠙⢉⣰⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿', '2020-06-08 09:54:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `passcode` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `role` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT 'user',
  `email` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `register_date` date NOT NULL DEFAULT current_timestamp(),
  `last_login` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `passcode`, `role`, `email`, `register_date`, `last_login`) VALUES
(1, 'Cubiclemon', 'eb935a69d47a2a80c54c7c13af454e21', 'admin', 'lemonsarecubic@gmail.com', '2020-05-09', '2020-06-08'),
(2, 'Admin', '196f8c0173d51f146bddb001eb219fa0', 'admin', 'musicreviewmanager@gmail.com', '2020-05-10', '2020-06-07'),
(4, 'CuteAnimeGirl', '6f5fa69230a8b7b08af3e750d9a22c3c', 'user', 'comandoraerian@yahoo.com', '2020-05-10', '2020-06-06'),
(5, 'pepegwa', 'df990067354912735d3bd8de4510ed8c', 'user', 'frost99jack@gmail.com', '2020-05-10', '2020-06-07'),
(9, 'Varain', '8bcc0ca859c1501f6b9751febfa30e88', 'user', '19tudor99@gmail.com', '2020-05-21', '2020-05-21'),
(10, 'goteki45', 'e1e84dde07e5b787e26e6fb841f02222', 'user', 'gtasanandreas555555@gmail.com', '2020-05-22', '2020-05-22'),
(13, 'ziccoaieneironic', '66f29b7efcfba740e6a733319a7585fd', 'user', 'coaie@coaie.coaie', '2020-05-28', '2020-05-29'),
(15, 'stefantiperciuc', 'f364738f38f10e23a7e84a501f4d70e5', 'admin', 'stefantiperciuc@yahoo.com', '2020-06-06', '2020-06-08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
