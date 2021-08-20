-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2021 at 04:51 PM
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
-- Database: `school_db`
--
CREATE DATABASE IF NOT EXISTS `school_db`;
use school_db;
-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `class` varchar(30) NOT NULL,
  `user_id` varchar(60) NOT NULL,
  `school_id` varchar(60) NOT NULL,
  `class_id` varchar(60) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `class`, `user_id`, `school_id`, `class_id`, `date`) VALUES
(1, 'first class', 'Gk3nnyBiB5dPaHQHGxn35hu0zVto8FiMSIMcB5lCTslvZe0CcHqInEcpmzdv', '0PbzcOAALCLUytlGxNog9R3ZaG5rpvjeleQ3UHSWE81m00vLyqNGBEgK4waH', 'rbepYJscJY4upWdiQXFLmzHUKSFXJNZW9JVnNCbKmILz0k78KNDf2keiMU4C', '2021-08-18 17:14:19');

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` int(11) NOT NULL,
  `school` varchar(30) NOT NULL,
  `school_id` varchar(60) NOT NULL,
  `date` datetime NOT NULL,
  `user_id` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `school`, `school_id`, `date`, `user_id`) VALUES
(1, 'Gonda', '0PbzcOAALCLUytlGxNog9R3ZaG5rpvjeleQ3UHSWE81m00vLyqNGBEgK4waH', '2021-08-15 17:07:43', 'Gk3nnyBiB5dPaHQHGxn35hu0zVto8FiMSIMcB5lCTslvZe0CcHqInEcpmzdv'),
(3, 'Anoya', 'B89uW4lhacD4g1vA7UN5R9juDkBirvpcKXJ01U7zkvWoJHgyslizf98lf0s8', '2021-08-15 18:00:52', 'Gk3nnyBiB5dPaHQHGxn35hu0zVto8FiMSIMcB5lCTslvZe0CcHqInEcpmzdv');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  `user_id` varchar(60) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `school_id` varchar(60) NOT NULL,
  `rank` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `date`, `user_id`, `gender`, `school_id`, `rank`, `password`, `image`) VALUES
(1, 'Eathorne', 'Banda', 'eathorne@yahoo.com', '2021-08-10 19:08:58', 'Gk3nnyBiB5dPaHQHGxn35hu0zVto8FiMSIMcB5lCTslvZe0CcHqInEcpmzdv', 'male', '0PbzcOAALCLUytlGxNog9R3ZaG5rpvjeleQ3UHSWE81m00vLyqNGBEgK4waH', 'super_admin', '$2y$10$DfpqgNj.g4qKLJCVs9CC5esat5K0jMF49cx6wt4h0B8ZBzw6Ocrci', ''),
(2, 'Mary', 'Phiri', 'mary@yahoo.com', '2021-08-10 19:49:36', 'pMZnfFjn7KRRDF6lvjGrSVcogFKk8YWQxgfEzhvvOsR5y0xP9uVF7Dz3YJCM', 'female', '', 'super_admin', '$2y$10$QpP3dlDXgmxxv.WdhB1BseUk77iwCHZhu3CcH/RfdcCiHWr3uQmAy', ''),
(3, 'John', 'Tembo', 'john@yahoo.com', '2021-08-18 14:43:04', 'CtWHBhx1JsxJhzyWthMkGzwNNFFbhFEayWtksMdQtHd863rKA63xJ4lVoTaP', 'male', '0PbzcOAALCLUytlGxNog9R3ZaG5rpvjeleQ3UHSWE81m00vLyqNGBEgK4waH', 'admin', '$2y$10$tk8F2m/X8g.Ilh432vXggeYBKF7EuyRiKpuXg1atYrup6JxyuezBm', ''),
(4, 'Anna', 'Jones', 'anna@yahoo.com', '2021-08-18 15:02:29', 'A8eqKMIc4y18npQ4Pr8ikvNyFLJVhwltcrvYTWb4rFFdjPIymgLK6F26LPJR', 'female', '0PbzcOAALCLUytlGxNog9R3ZaG5rpvjeleQ3UHSWE81m00vLyqNGBEgK4waH', 'reception', '$2y$10$Co6UEpouAV1gFIuTMsB7IuJwZXsQ081kws.61r7GczrjRfDRzrBkW', ''),
(5, 'Vibe', 'Peters', 'vibe@yahoo.com', '2021-08-18 15:03:07', 'keHyNY9P0VQh8wWloJb2aUUADtKK5e0ef3gv77BnuecKNiFAaHarh4WLuPjV', 'male', '0PbzcOAALCLUytlGxNog9R3ZaG5rpvjeleQ3UHSWE81m00vLyqNGBEgK4waH', 'lecturer', '$2y$10$VzZvMzHH/fIC.MtC0OZxcuYUkTqvA2/PPy42OGSgZt/aDNFmp/rUK', ''),
(6, 'Bob', 'Marley', 'bob@yahoo.com', '2021-08-18 16:03:55', 'FQidRkuYfTGHqkBPtJ28aXKjwIPe6sZComZRivm6BDj7LMtfTEr80ScYBQVC', 'male', '0PbzcOAALCLUytlGxNog9R3ZaG5rpvjeleQ3UHSWE81m00vLyqNGBEgK4waH', 'student', '$2y$10$TC9IVVC7ChftDQpUiAJ1NuwKYtLJvuIdsP6BTb4enalnW7h/q4DAi', ''),
(7, 'Maria', 'Jonnes', 'maria@yahoo.com', '2021-08-18 16:06:27', 'A5xGfwL9u3PHk8dQQFzpIkcJ6qTSlBblD2UHAkyiA2kAEeTmodyt40DrtMXo', 'female', '0PbzcOAALCLUytlGxNog9R3ZaG5rpvjeleQ3UHSWE81m00vLyqNGBEgK4waH', 'student', '$2y$10$4nmgjlK9WIxEswOibyl49elGbdeuKoaP/2hsPuKQdcxt3t3NPlVVe', ''),
(8, 'Jane', 'Mandawa', 'jane@yahoo.com', '2021-08-18 16:07:00', 'vClwfLZduzlKcZQfWtQ1C3VGqJO2PFKjRZVd8oAoXSK4LajUCDCAXxvoqjpO', 'female', '0PbzcOAALCLUytlGxNog9R3ZaG5rpvjeleQ3UHSWE81m00vLyqNGBEgK4waH', 'student', '$2y$10$deWPI47s4OfH5c/b/cVqeOP3cGT2SQf6G7Vj1VBD6dRId6Lf44fjy', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class` (`class`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `school_id` (`school_id`),
  ADD KEY `date` (`date`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school` (`school`),
  ADD KEY `school_id` (`school_id`),
  ADD KEY `date` (`date`),
  ADD KEY `user_url` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `firstname` (`firstname`),
  ADD KEY `lastname` (`lastname`),
  ADD KEY `date` (`date`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `school_id` (`school_id`),
  ADD KEY `gender` (`gender`),
  ADD KEY `rank` (`rank`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
