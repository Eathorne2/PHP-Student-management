-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2021 at 11:45 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `answered_tests`
--

CREATE TABLE `answered_tests` (
  `id` bigint(20) NOT NULL,
  `user_id` varchar(60) NOT NULL,
  `test_id` varchar(60) NOT NULL,
  `submitted` tinyint(1) NOT NULL DEFAULT 0,
  `submitted_date` datetime DEFAULT NULL,
  `marked` tinyint(1) NOT NULL DEFAULT 0,
  `marked_by` varchar(60) DEFAULT NULL,
  `marked_date` datetime DEFAULT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `answered_tests`
--

INSERT INTO `answered_tests` (`id`, `user_id`, `test_id`, `submitted`, `submitted_date`, `marked`, `marked_by`, `marked_date`, `date`) VALUES
(1, 'guy.dude', 'V7CYsLnUdFHihrKfu7l3BFp0Un0KqJ5tWGeBtqyVZoFotTAWallpUABQXSow', 1, '0000-00-00 00:00:00', 1, 'vibe.peters', '2021-10-20 20:26:01', '2021-10-09 11:02:49');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` bigint(20) NOT NULL,
  `user_id` varchar(60) NOT NULL,
  `test_id` varchar(60) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` text DEFAULT NULL,
  `date` datetime NOT NULL,
  `answer_mark` tinyint(1) NOT NULL DEFAULT 0,
  `answer_comment` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `user_id`, `test_id`, `question_id`, `answer`, `date`, `answer_mark`, `answer_comment`) VALUES
(1, 'guy.dude', 'V7CYsLnUdFHihrKfu7l3BFp0Un0KqJ5tWGeBtqyVZoFotTAWallpUABQXSow', 1, 'photothynthesis', '2021-10-03 18:15:53', 1, ''),
(2, 'guy.dude', 'V7CYsLnUdFHihrKfu7l3BFp0Un0KqJ5tWGeBtqyVZoFotTAWallpUABQXSow', 2, '1964', '2021-10-03 18:15:53', 2, ''),
(3, 'guy.dude', 'V7CYsLnUdFHihrKfu7l3BFp0Un0KqJ5tWGeBtqyVZoFotTAWallpUABQXSow', 4, 'here is another answer', '2021-10-03 18:15:53', 1, ''),
(4, 'guy.dude', 'V7CYsLnUdFHihrKfu7l3BFp0Un0KqJ5tWGeBtqyVZoFotTAWallpUABQXSow', 5, '2 point answer', '2021-10-03 18:15:54', 1, ''),
(5, 'guy.dude', 'V7CYsLnUdFHihrKfu7l3BFp0Un0KqJ5tWGeBtqyVZoFotTAWallpUABQXSow', 6, 'an answer', '2021-10-03 18:15:54', 2, ''),
(6, 'guy.dude', 'V7CYsLnUdFHihrKfu7l3BFp0Un0KqJ5tWGeBtqyVZoFotTAWallpUABQXSow', 7, 'another answer', '2021-10-03 18:15:54', 2, ''),
(7, 'guy.dude', 'V7CYsLnUdFHihrKfu7l3BFp0Un0KqJ5tWGeBtqyVZoFotTAWallpUABQXSow', 8, 'another answer', '2021-10-03 18:15:54', 2, ''),
(8, 'guy.dude', 'V7CYsLnUdFHihrKfu7l3BFp0Un0KqJ5tWGeBtqyVZoFotTAWallpUABQXSow', 9, 'B', '2021-10-05 20:12:12', 1, '');

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
(1, 'first class', 'eathorne.banda', '0PbzcOAALCLUytlGxNog9R3ZaG5rpvjeleQ3UHSWE81m00vLyqNGBEgK4waH', 'rbepYJscJY4upWdiQXFLmzHUKSFXJNZW9JVnNCbKmILz0k78KNDf2keiMU4C', '2021-08-18 17:14:19'),
(3, 'second class', 'eathorne.banda', '0PbzcOAALCLUytlGxNog9R3ZaG5rpvjeleQ3UHSWE81m00vLyqNGBEgK4waH', 'xrP2mcCVRukT3OsZaSQBddZB0D3xstpAoN0EznlTbJgTcLGBoLRRxjM7usEo', '2021-08-21 17:48:40');

-- --------------------------------------------------------

--
-- Table structure for table `class_lecturers`
--

CREATE TABLE `class_lecturers` (
  `id` int(11) NOT NULL,
  `user_id` varchar(60) NOT NULL,
  `class_id` varchar(60) NOT NULL,
  `disabled` tinyint(1) NOT NULL,
  `date` datetime NOT NULL,
  `school_id` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_lecturers`
--

INSERT INTO `class_lecturers` (`id`, `user_id`, `class_id`, `disabled`, `date`, `school_id`) VALUES
(1, 'vibe.peters', 'xrP2mcCVRukT3OsZaSQBddZB0D3xstpAoN0EznlTbJgTcLGBoLRRxjM7usEo', 0, '2021-09-04 12:57:35', '0PbzcOAALCLUytlGxNog9R3ZaG5rpvjeleQ3UHSWE81m00vLyqNGBEgK4waH');

-- --------------------------------------------------------

--
-- Table structure for table `class_students`
--

CREATE TABLE `class_students` (
  `id` int(11) NOT NULL,
  `user_id` varchar(60) NOT NULL,
  `class_id` varchar(60) NOT NULL,
  `disabled` tinyint(1) NOT NULL,
  `date` datetime NOT NULL,
  `school_id` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_students`
--

INSERT INTO `class_students` (`id`, `user_id`, `class_id`, `disabled`, `date`, `school_id`) VALUES
(1, 'maria.jonnes', 'xrP2mcCVRukT3OsZaSQBddZB0D3xstpAoN0EznlTbJgTcLGBoLRRxjM7usEo', 0, '2021-08-27 11:20:52', '0PbzcOAALCLUytlGxNog9R3ZaG5rpvjeleQ3UHSWE81m00vLyqNGBEgK4waH'),
(3, 'guy.dude', 'xrP2mcCVRukT3OsZaSQBddZB0D3xstpAoN0EznlTbJgTcLGBoLRRxjM7usEo', 0, '2021-08-27 11:22:05', '0PbzcOAALCLUytlGxNog9R3ZaG5rpvjeleQ3UHSWE81m00vLyqNGBEgK4waH'),
(4, 'bob.marley', 'xrP2mcCVRukT3OsZaSQBddZB0D3xstpAoN0EznlTbJgTcLGBoLRRxjM7usEo', 0, '2021-08-27 11:26:47', '0PbzcOAALCLUytlGxNog9R3ZaG5rpvjeleQ3UHSWE81m00vLyqNGBEgK4waH');

-- --------------------------------------------------------

--
-- Table structure for table `class_tests`
--

CREATE TABLE `class_tests` (
  `id` int(11) NOT NULL,
  `user_id` varchar(60) NOT NULL,
  `class_id` varchar(60) NOT NULL,
  `disabled` tinyint(1) NOT NULL,
  `test` varchar(100) NOT NULL,
  `test_id` varchar(60) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 'Gonda', '0PbzcOAALCLUytlGxNog9R3ZaG5rpvjeleQ3UHSWE81m00vLyqNGBEgK4waH', '2021-08-15 17:07:43', 'eathorne.banda'),
(3, 'Anoya', 'B89uW4lhacD4g1vA7UN5R9juDkBirvpcKXJ01U7zkvWoJHgyslizf98lf0s8', '2021-08-15 18:00:52', 'eathorne.banda');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` int(11) NOT NULL,
  `test_id` varchar(60) NOT NULL,
  `class_id` varchar(60) NOT NULL,
  `school_id` varchar(60) NOT NULL,
  `user_id` varchar(60) NOT NULL,
  `test` varchar(100) NOT NULL,
  `description` varchar(2048) NOT NULL,
  `date` datetime NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 1,
  `editable` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `test_id`, `class_id`, `school_id`, `user_id`, `test`, `description`, `date`, `disabled`, `editable`) VALUES
(1, 'V7CYsLnUdFHihrKfu7l3BFp0Un0KqJ5tWGeBtqyVZoFotTAWallpUABQXSow', 'xrP2mcCVRukT3OsZaSQBddZB0D3xstpAoN0EznlTbJgTcLGBoLRRxjM7usEo', '0PbzcOAALCLUytlGxNog9R3ZaG5rpvjeleQ3UHSWE81m00vLyqNGBEgK4waH', 'eathorne.banda', 'my first test', 'a description for my first test', '2021-09-11 20:59:35', 0, 0),
(4, 'PUGkgycdsNujSXwZZ7vUuIxCsSCAzgvR8D0R8UfzfMcG1yTFoFlSVOaBZWKv', 'xrP2mcCVRukT3OsZaSQBddZB0D3xstpAoN0EznlTbJgTcLGBoLRRxjM7usEo', '0PbzcOAALCLUytlGxNog9R3ZaG5rpvjeleQ3UHSWE81m00vLyqNGBEgK4waH', 'eathorne.banda', 'a second test', 'description for a second test just to see what happens', '2021-09-25 19:49:10', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `test_questions`
--

CREATE TABLE `test_questions` (
  `id` int(11) NOT NULL,
  `test_id` varchar(60) NOT NULL,
  `question` text NOT NULL,
  `comment` varchar(1024) NOT NULL,
  `image` varchar(500) DEFAULT NULL,
  `question_type` varchar(10) NOT NULL,
  `correct_answer` text DEFAULT NULL,
  `choices` text DEFAULT NULL,
  `date` datetime NOT NULL,
  `user_id` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `test_questions`
--

INSERT INTO `test_questions` (`id`, `test_id`, `question`, `comment`, `image`, `question_type`, `correct_answer`, `choices`, `date`, `user_id`) VALUES
(1, 'V7CYsLnUdFHihrKfu7l3BFp0Un0KqJ5tWGeBtqyVZoFotTAWallpUABQXSow', 'what is the process by which plants make energy from sunlight', '', NULL, 'subjective', NULL, NULL, '2021-09-16 19:12:39', 'eathorne.banda'),
(2, 'V7CYsLnUdFHihrKfu7l3BFp0Un0KqJ5tWGeBtqyVZoFotTAWallpUABQXSow', 'which year did Zambia get independence?', '', NULL, 'subjective', NULL, NULL, '2021-09-16 19:13:16', 'eathorne.banda'),
(4, 'V7CYsLnUdFHihrKfu7l3BFp0Un0KqJ5tWGeBtqyVZoFotTAWallpUABQXSow', 'here is another question with a comment', 'this question is worth 1 point', NULL, 'subjective', NULL, NULL, '2021-09-17 20:09:59', 'eathorne.banda'),
(5, 'V7CYsLnUdFHihrKfu7l3BFp0Un0KqJ5tWGeBtqyVZoFotTAWallpUABQXSow', 'a new question with an image', '2 points', NULL, 'subjective', NULL, NULL, '2021-09-17 20:17:42', 'eathorne.banda'),
(6, 'V7CYsLnUdFHihrKfu7l3BFp0Un0KqJ5tWGeBtqyVZoFotTAWallpUABQXSow', 'a test question with an image', 'a comment', 'uploads/1632059903_puzzles-quiz-7.png', 'subjective', NULL, NULL, '2021-09-17 20:26:50', 'eathorne.banda'),
(7, 'V7CYsLnUdFHihrKfu7l3BFp0Un0KqJ5tWGeBtqyVZoFotTAWallpUABQXSow', 'this is an objective question, which means it has a specific answer', '2 points', NULL, 'objective', 'an answer', NULL, '2021-09-19 14:48:50', 'eathorne.banda'),
(8, 'V7CYsLnUdFHihrKfu7l3BFp0Un0KqJ5tWGeBtqyVZoFotTAWallpUABQXSow', 'another objective question', '', NULL, 'objective', 'home', NULL, '2021-09-19 14:53:15', 'eathorne.banda'),
(9, 'V7CYsLnUdFHihrKfu7l3BFp0Un0KqJ5tWGeBtqyVZoFotTAWallpUABQXSow', 'what are young goats called?', 'this question is worth 1 point', NULL, 'multiple', 'B', '{\"A\":\"chidren\",\"B\":\"kids\",\"C\":\"monsters\"}', '2021-09-19 18:16:14', 'eathorne.banda');

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
(1, 'Eathorne', 'Banda', 'eathorne@yahoo.com', '2021-08-10 19:08:58', 'eathorne.banda', 'male', '0PbzcOAALCLUytlGxNog9R3ZaG5rpvjeleQ3UHSWE81m00vLyqNGBEgK4waH', 'super_admin', '$2y$10$DfpqgNj.g4qKLJCVs9CC5esat5K0jMF49cx6wt4h0B8ZBzw6Ocrci', 'uploads/cardinal_1585485603.jpg'),
(2, 'Mary', 'Phiri', 'mary@yahoo.com', '2021-08-10 19:49:36', 'mary.phiri', 'female', '', 'super_admin', '$2y$10$QpP3dlDXgmxxv.WdhB1BseUk77iwCHZhu3CcH/RfdcCiHWr3uQmAy', ''),
(3, 'John', 'Tembo', 'john@yahoo.com', '2021-08-18 14:43:04', 'john.tembo', 'male', '0PbzcOAALCLUytlGxNog9R3ZaG5rpvjeleQ3UHSWE81m00vLyqNGBEgK4waH', 'admin', '$2y$10$tk8F2m/X8g.Ilh432vXggeYBKF7EuyRiKpuXg1atYrup6JxyuezBm', 'uploads/header100people.jpg'),
(4, 'Anna', 'Jones', 'anna@yahoo.com', '2021-08-18 15:02:29', 'anna.jonnes', 'female', '0PbzcOAALCLUytlGxNog9R3ZaG5rpvjeleQ3UHSWE81m00vLyqNGBEgK4waH', 'reception', '$2y$10$Co6UEpouAV1gFIuTMsB7IuJwZXsQ081kws.61r7GczrjRfDRzrBkW', ''),
(5, 'Vibe', 'Peters', 'vibe@yahoo.com', '2021-08-18 15:03:07', 'vibe.peters', 'male', '0PbzcOAALCLUytlGxNog9R3ZaG5rpvjeleQ3UHSWE81m00vLyqNGBEgK4waH', 'lecturer', '$2y$10$VzZvMzHH/fIC.MtC0OZxcuYUkTqvA2/PPy42OGSgZt/aDNFmp/rUK', ''),
(6, 'Bob', 'Marley', 'bob@yahoo.com', '2021-08-18 16:03:55', 'bob.marley', 'male', '0PbzcOAALCLUytlGxNog9R3ZaG5rpvjeleQ3UHSWE81m00vLyqNGBEgK4waH', 'student', '$2y$10$TC9IVVC7ChftDQpUiAJ1NuwKYtLJvuIdsP6BTb4enalnW7h/q4DAi', ''),
(7, 'Maria', 'Jonnes', 'maria@yahoo.com', '2021-08-18 16:06:27', 'maria.jonnes', 'female', '0PbzcOAALCLUytlGxNog9R3ZaG5rpvjeleQ3UHSWE81m00vLyqNGBEgK4waH', 'student', '$2y$10$4nmgjlK9WIxEswOibyl49elGbdeuKoaP/2hsPuKQdcxt3t3NPlVVe', ''),
(8, 'Jane', 'Mandawa', 'jane@yahoo.com', '2021-08-18 16:07:00', 'jane.mandawa', 'female', '0PbzcOAALCLUytlGxNog9R3ZaG5rpvjeleQ3UHSWE81m00vLyqNGBEgK4waH', 'student', '$2y$10$deWPI47s4OfH5c/b/cVqeOP3cGT2SQf6G7Vj1VBD6dRId6Lf44fjy', ''),
(9, 'Guy', 'Dude', 'guy@yahoo.com', '2021-08-21 18:26:48', 'guy.dude', 'male', '0PbzcOAALCLUytlGxNog9R3ZaG5rpvjeleQ3UHSWE81m00vLyqNGBEgK4waH', 'student', '$2y$10$DfpqgNj.g4qKLJCVs9CC5esat5K0jMF49cx6wt4h0B8ZBzw6Ocrci', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answered_tests`
--
ALTER TABLE `answered_tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `test_id` (`test_id`),
  ADD KEY `submitted` (`submitted`),
  ADD KEY `marked` (`marked`),
  ADD KEY `marked_by` (`marked_by`),
  ADD KEY `date` (`date`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `test_id` (`test_id`),
  ADD KEY `date` (`date`),
  ADD KEY `answer_mark` (`answer_mark`);

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
-- Indexes for table `class_lecturers`
--
ALTER TABLE `class_lecturers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `disabled` (`disabled`),
  ADD KEY `date` (`date`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `class_students`
--
ALTER TABLE `class_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `disabled` (`disabled`),
  ADD KEY `date` (`date`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `class_tests`
--
ALTER TABLE `class_tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `test_id` (`test_id`),
  ADD KEY `date` (`date`),
  ADD KEY `disabled` (`disabled`),
  ADD KEY `test` (`test`),
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
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test_id` (`test_id`),
  ADD KEY `school_id` (`school_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `test` (`test`),
  ADD KEY `date` (`date`),
  ADD KEY `disabled` (`disabled`),
  ADD KEY `editable` (`editable`);

--
-- Indexes for table `test_questions`
--
ALTER TABLE `test_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test_id` (`test_id`),
  ADD KEY `test_type` (`question_type`),
  ADD KEY `date` (`date`),
  ADD KEY `user_id` (`user_id`);

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
-- AUTO_INCREMENT for table `answered_tests`
--
ALTER TABLE `answered_tests`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `class_lecturers`
--
ALTER TABLE `class_lecturers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `class_students`
--
ALTER TABLE `class_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `class_tests`
--
ALTER TABLE `class_tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `test_questions`
--
ALTER TABLE `test_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
