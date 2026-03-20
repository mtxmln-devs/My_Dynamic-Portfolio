-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2025 at 03:11 AM
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
-- Database: `portfolio_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE `experience` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `company_institution` varchar(150) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `type` enum('work','education') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `experience`
--

INSERT INTO `experience` (`id`, `title`, `company_institution`, `location`, `start_date`, `end_date`, `description`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Kindergarten', 'Tilod Elementary School', 'Catanduanes', '2009-01-01', '2010-12-31', 'Explored the fundamental groundwork for literacy and numeracy through songs, games, and imaginative things.', 'education', '2025-12-07 13:54:46', '2025-12-07 13:54:46'),
(2, 'Elementary Years', 'Bagumbayan Elementary School', 'Catanduanes', '2010-01-01', '2016-12-31', 'Studied well and got the best reward for myself and my family (valedictorian).', 'education', '2025-12-07 13:54:46', '2025-12-07 13:54:46'),
(8, 'Junion High School', 'Camarines Science Oriented High School', '(Pili, Camarines Sur)', '2016-06-08', '2018-04-08', 'Exploring subjects that expands my curiosity on various things.', 'education', '2025-12-08 02:00:36', '2025-12-08 02:00:36'),
(9, '1 Year Hiatus', 'Camarines Science Oriented High School', 'Pili, Camarines Sur', '2018-01-01', '2019-05-08', 'Take a break for faster recovery for the mental health and overall health.', 'education', '2025-12-08 02:03:17', '2025-12-08 02:03:17'),
(10, 'Continuation of Junior High School', 'Camarines Science Oriented High School', '(Pili, Camarines Sur)', '2019-06-03', '2020-04-03', 'Come back stronger than before with strong mental health and well-being.', 'education', '2025-12-08 02:04:53', '2025-12-08 02:04:53'),
(11, 'Senior High School Years', 'Camarines Science Oriented High School', '(Pili, Camarines Sur)', '2020-07-08', '2022-06-08', 'Pursue the strand that aligns to my profession. I got the best reward for myself and family (Valedictorian).', 'education', '2025-12-08 02:07:44', '2025-12-08 02:07:44'),
(12, 'College Years', 'Camarines Sur Polytechnic Colleges: CSPC', '(Nabua, Camarines Sur)', '2022-07-08', NULL, 'Still learning and growing. Progress matters.', 'education', '2025-12-08 02:09:59', '2025-12-08 02:09:59');

-- --------------------------------------------------------

--
-- Table structure for table `personal_info`
--

CREATE TABLE `personal_info` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `github_url` varchar(255) DEFAULT NULL,
  `linkedin_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personal_info`
--

INSERT INTO `personal_info` (`id`, `full_name`, `email`, `phone`, `address`, `bio`, `profile_image`, `github_url`, `linkedin_url`, `created_at`, `updated_at`) VALUES
(1, 'Mark Laurence Taway', 'matttaway11@gmail.com', '+63 927 035 4239', 'Pili, Camarines Sur, Philippines', 'A passionate full-stack developer specializing in modern web technologies, I craft innovative digital solutions by blending back-end logic with front-end aesthetics to solve complex problems with clean, efficient code.', 'pik.png', 'https://github.com/mtxmlndevs', 'https://linkedin.com/in/mattyy', '2025-12-07 13:54:46', '2025-12-08 01:51:39');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `project_name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `technologies` varchar(255) DEFAULT NULL,
  `project_url` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_name`, `description`, `technologies`, `project_url`, `image_url`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(2, 'Spelling Bee System', 'This system offers a user-friendly spelling challenge with helpful clues.', 'HTML, CSS, JavaScript', '', NULL, '2024-03-01', '2024-04-30', '2025-12-07 13:54:46', '2025-12-07 13:54:46'),
(3, 'Quiz System', 'This system is a comprehensive digital platform that allows users to take quizzes across various categories.', 'HTML, CSS, JavaScript', '', NULL, '2024-05-01', '2024-06-30', '2025-12-07 13:54:46', '2025-12-07 13:54:46'),
(4, 'Confidence Interval Calculator Proportion System', 'This calculator brings accuracy, speed, and confidence together in perfect harmony.', 'HTML, CSS, JavaScript', '', NULL, '2024-07-01', '2024-08-31', '2025-12-07 13:54:46', '2025-12-07 13:54:46'),
(5, 'Library Management System', 'This system is like a digital helper that keeps track of all the books in the library and who has borrowed them, making it easy to find books and know whats on the shelves.', 'PHP, SQL', '', NULL, '2025-01-08', '2025-03-12', '2025-12-08 01:48:47', '2025-12-08 01:50:12');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(11) NOT NULL,
  `skill_name` varchar(100) NOT NULL,
  `proficiency` int(11) NOT NULL CHECK (`proficiency` >= 1 and `proficiency` <= 100),
  `category` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `skill_name`, `proficiency`, `category`, `created_at`, `updated_at`) VALUES
(1, 'HTML', 92, 'Frontend', '2025-12-07 13:54:46', '2025-12-07 13:54:46'),
(2, 'CSS', 88, 'Frontend', '2025-12-07 13:54:46', '2025-12-07 13:54:46'),
(7, 'Node.js', 88, 'Backend', '2025-12-07 13:54:46', '2025-12-07 13:54:46'),
(8, 'PHP', 92, 'Backend', '2025-12-07 13:54:46', '2025-12-07 13:54:46'),
(9, 'Express.js', 87, 'Backend', '2025-12-07 13:54:46', '2025-12-07 13:54:46'),
(11, 'MySQL', 87, 'Database', '2025-12-07 13:54:46', '2025-12-07 13:54:46'),
(12, 'Firebase', 85, 'Database', '2025-12-07 13:54:46', '2025-12-07 13:54:46'),
(19, 'Laravel', 90, 'Backend', '2025-12-08 01:52:37', '2025-12-08 01:52:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '$2y$10$qi5l56kSFXwC33cVY00Wo.nRq8oV494dmeFDAJ1P8TyNcqsiGzH2.', '2025-12-07 13:54:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_info`
--
ALTER TABLE `personal_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `experience`
--
ALTER TABLE `experience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_info`
--
ALTER TABLE `personal_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
