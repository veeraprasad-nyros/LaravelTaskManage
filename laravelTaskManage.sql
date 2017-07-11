-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 11, 2017 at 09:25 AM
-- Server version: 5.5.55-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `laravelTaskManage`
--

-- --------------------------------------------------------

--
-- Table structure for table `companyteams`
--

CREATE TABLE IF NOT EXISTS `companyteams` (
  `cuser_id` int(10) unsigned NOT NULL,
  `team_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cuser_id`,`team_id`),
  KEY `companyteams_team_id_foreign` (`team_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `companyteams`
--

INSERT INTO `companyteams` (`cuser_id`, `team_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2016-07-26 11:58:22', '2016-07-26 11:58:22'),
(1, 2, '2016-07-26 12:00:26', '2016-07-26 12:00:26'),
(1, 3, '2016-07-27 03:49:02', '2016-07-27 03:49:02'),
(1, 4, '2016-07-27 04:18:10', '2016-07-27 04:18:10'),
(1, 5, '2016-07-27 06:10:41', '2016-07-27 06:10:41'),
(1, 9, '2016-08-17 06:51:14', '2016-08-17 06:51:14'),
(1, 10, '2016-11-17 00:22:40', '2016-11-17 00:22:40'),
(9, 6, '2016-07-27 08:32:09', '2016-07-27 08:32:09'),
(10, 7, '2016-07-28 09:33:08', '2016-07-28 09:33:08'),
(18, 1, '2016-08-05 10:44:57', '2016-08-05 10:44:57'),
(18, 8, '2016-08-05 10:44:20', '2016-08-05 10:44:20');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `cuser_id` int(10) unsigned NOT NULL,
  `team_id` int(10) unsigned NOT NULL,
  `muser_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cuser_id`,`team_id`,`muser_id`),
  KEY `members_team_id_foreign` (`team_id`),
  KEY `members_muser_id_foreign` (`muser_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`cuser_id`, `team_id`, `muser_id`, `created_at`, `updated_at`) VALUES
(1, 1, 16, NULL, NULL),
(1, 1, 17, NULL, NULL),
(1, 3, 12, NULL, NULL),
(9, 6, 14, NULL, NULL),
(10, 7, 15, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_08_09_153634_add_attach_to_tasks', 2),
('2016_08_11_115647_add_estatus_to_tasks', 3),
('2016_08_11_120543_add_taskdates__to_tasks', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('aplearns@gmail.com', '53fdad7be9ae7f0e7dec638251908a88647a23e92fb5add5de4467f396df4818', '2016-07-27 09:02:54'),
('applearns@gmail.com', '0aa4ef42d0546cfce8bc92ee0e0b607064355a7a0516b3a0d8375c76fd5a8342', '2016-08-22 03:03:32');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'company', 'Company', 'User is allowed to manage and edit members', '2016-07-26 11:48:39', '2016-07-26 11:48:39'),
(2, 'member', 'Member', 'User is Member roled', '2016-07-26 11:48:39', '2016-07-26 11:48:39'),
(3, 'others', 'Other user', 'The default user', '2016-07-26 11:48:39', '2016-07-26 11:48:39');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `attach` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estatus` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `sdate` timestamp NULL DEFAULT NULL,
  `edate` timestamp NULL DEFAULT NULL,
  `tstatus` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cuser_id` int(10) unsigned NOT NULL,
  `muser_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tasks_cuser_id_foreign` (`cuser_id`),
  KEY `tasks_muser_id_foreign` (`muser_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `description`, `attach`, `estatus`, `sdate`, `edate`, `tstatus`, `cuser_id`, `muser_id`, `created_at`, `updated_at`) VALUES
(8, 'Fundamentals', 'Learn the fundamentals of Ruby.', NULL, '0', '2016-07-27 10:48:00', '2016-08-11 07:30:00', 'Completed', 1, 12, '2016-07-27 10:48:00', '2016-07-27 10:48:00'),
(9, 'Testing', 'Test the app..', NULL, '0', '2016-07-28 03:45:38', '2016-08-18 07:30:00', 'InProgress', 1, 12, '2016-07-28 03:45:38', '2016-07-28 03:45:38'),
(10, 'sample', 'sample', '1470819765.jpg', '0', '2016-07-28 05:32:18', '2016-08-18 07:30:00', 'Open', 1, 12, '2016-07-28 05:32:18', '2016-07-28 05:33:57'),
(11, 'Testing', 'status checking task', '1470814358.jpg', '0', '2016-07-28 05:48:10', '2016-08-18 07:30:00', 'Hold', 1, 12, '2016-07-28 05:48:10', '2016-07-28 05:48:10'),
(12, 'Emails', 'Alerting when task task content and status changed', '1470819694.zip', '0', '2016-07-28 06:11:02', '2016-08-11 07:30:00', 'Open', 1, 12, '2016-07-28 06:11:02', '2016-07-28 08:39:45'),
(13, 'ffdff', 'fdfdfdfd', NULL, '0', '2016-07-28 08:34:24', '2016-08-18 07:30:00', 'InProgress', 9, 14, '2016-07-28 08:34:24', '2016-08-11 08:58:45'),
(14, 'Testing Task', 'Testing', NULL, '0', '2016-07-28 09:35:51', '2016-08-10 07:30:00', 'InProgress', 10, 15, '2016-07-28 09:35:51', '2016-07-28 09:35:51'),
(15, 'Laravel framework', 'Learn The Laravel', '1470813465.jpg', '0', '2016-08-01 03:56:33', '2016-08-18 07:30:00', 'Hold', 1, 16, '2016-08-01 03:56:33', '2016-08-01 03:56:33'),
(17, 'Attachment', 'Attachment Testing', '1470813169.jpg', '0', '2016-08-09 10:21:37', '2016-08-18 07:30:00', 'Open', 1, 16, '2016-08-09 10:21:37', '2016-08-09 10:21:37'),
(18, 'Attachment', 'Attachment Testing', '1470820102.jpg', '0', '2016-08-09 10:21:41', '2016-08-18 07:30:00', 'InProgress', 1, 17, '2016-08-09 10:21:41', '2016-08-09 10:21:41'),
(19, 'Attachtest2', 'Attachtest....', '1470812284.jpg', '0', '2016-08-09 11:27:48', '2016-08-18 07:30:00', 'Open', 1, 16, '2016-08-09 11:27:48', '2016-08-09 11:27:48'),
(20, 'Attachtest', 'Attachtest....', '1470914797.png', '0', '2016-08-09 11:27:53', '2016-08-11 07:30:00', 'Open', 1, 17, '2016-08-09 11:27:53', '2016-08-09 11:27:53'),
(23, 'Shedule', 'Shedule', '1470900642.jpg', '0', '2016-08-11 08:30:00', '2016-08-12 07:29:00', 'Open', 1, 16, '2016-08-11 07:30:42', '2016-08-11 07:30:42'),
(24, 't1', 't1', '1470906433.png', '0', '2016-08-11 09:00:00', '2016-08-12 09:30:00', 'Completed', 1, 12, '2016-08-11 09:07:13', '2016-08-11 09:07:13'),
(25, 'Schedular1', 'Schedular check for task expiry', '1470915169.png', '0', '2016-08-11 11:31:00', '2016-08-12 04:30:00', 'Open', 1, 16, '2016-08-11 11:32:49', '2016-08-11 11:32:49'),
(26, 'Schedular1', 'Schedular check for task expiry', '1479699812.apk', '0', '2016-08-11 11:31:00', '2016-08-12 04:30:00', 'Open', 1, 17, '2016-08-11 11:32:54', '2016-08-11 11:32:54'),
(27, 'TDD&BDD', 'Start Learning ', '1471001893.jpg', '0', '2016-08-12 11:36:00', '2016-08-16 04:30:00', 'Hold', 1, 16, '2016-08-12 06:08:13', '2016-08-12 06:08:13');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'LARAVEL', '2016-07-26 11:58:22', '2016-07-26 11:58:22'),
(2, 'PHP', '2016-07-26 12:00:26', '2016-07-26 12:00:26'),
(3, 'RUBY', '2016-07-27 03:49:01', '2016-07-27 03:49:01'),
(4, 'PYTHON', '2016-07-27 04:18:10', '2016-07-27 04:18:10'),
(5, 'ANGULAR JS', '2016-07-27 06:10:41', '2016-07-27 06:10:41'),
(6, 'IOS', '2016-07-27 08:32:09', '2016-07-27 08:32:09'),
(7, 'TESTING', '2016-07-28 09:33:08', '2016-07-28 09:33:08'),
(8, 'LARAVEL_TEST', '2016-08-05 10:44:20', '2016-08-05 10:44:20'),
(9, 'SAMPLE', '2016-08-17 06:51:13', '2016-08-17 06:51:13'),
(10, 'TEST', '2016-11-17 00:22:40', '2016-11-17 00:22:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `role_id`, `password`, `address`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Laravel', 'Framework', 'applearns@gmail.com', 1, '$2y$10$/hVVFW98yE5i0ZDT4ch05u/Uu4g7itchK9wTSzdjHtXlc3LnuNfMK', 'Kakinada', 'W71WUFWm2nUNrUDOJTf92YGPMJl9oDB54K8NkAkooFuWxaWxCjA0ZTGPyGaQ', '2016-07-26 11:51:05', '2016-11-20 22:13:43'),
(9, 'B', 'Jagadeesh', 'jagadeesh.jgn50@gmail.com', 1, '$2y$10$cHCgdXpe5.C9rvOrBUZxc.qqt5QNAao2hTedC/auE6O03MY8HDIT6', 'Kakinada', 'Xta01z9kHm0WrnvVj8p72zR7aoK3IZh0wv7Aa7bxB4FzrwsbZ2sSR79vILcA', '2016-07-27 08:31:40', '2016-08-11 09:00:08'),
(10, 'B', 'Satya', 'satyajan999@gmail.com', 1, '$2y$10$U3zm5OZblplZY8ta2IL3Fe35e9UQKNrp4RUKBYTIUyVTB84Zd4PEy', 'Kakinada', 'gWDtRRTKbR2JTTT0ZuoBCfeE3w8gEFSkeQCnVFLwO0GJPJ9qLefWlUuLco5q', '2016-07-27 10:09:02', '2016-08-17 07:02:40'),
(11, 'Ch', 'Veera ', 'veeraprasadsmart1989@gmail.com', 1, '$2y$10$MEkAMJC0QOl9knEJ0d6DdO66/pjMFiJRH66bixjYrYrj27tM1l5nW', 'Kakinada', 'L3fVuttrgJmebKup4T1Ia8MZdw5W5b6zUwUk817jNwm4oO5eWOyKGJIiiHUK', '2016-07-27 10:14:27', '2016-07-27 10:18:46'),
(12, 'C', 'V Prasad', 'veeraprasadsmart@gmail.com', 2, '$2y$10$qnVoZo24HfdTieEgutu7O.35dGg3ev8VNJBu2NXIrWakqqnIkv4aa', 'Kakinada', 'i7J0KHDPVU5TpuYiLM7h5M7j9Vysf8E31CYA0ObSkx9wRV6Txp4g8GAaawa8', '2016-07-27 10:23:16', '2016-12-27 03:08:34'),
(14, 'jagadeesh', 'b', 'jagadeesh@gmail.com', 2, '$2y$10$3dP40QTEfEBfi9JXsHYwmuR1FYDm/WcunzRLbpJjBHPATfnqfwCMS', 'Kakinada', NULL, '2016-07-28 08:33:45', '2016-07-28 08:33:45'),
(15, 'v', 'rajesh', 'applearns@yahoo.com', 2, '$2y$10$qUoge9knA/8uZmMaPtw1Uu2XCgHZWCVfiz6zslAGHgJBveA35mUtC', 'kkd', 'Vq7J8LiJyC1JuUOphssI6f4ih7XoVQiuWTrvtcKcmI73LJJ37RS1SpWbw6wH', '2016-07-28 09:34:07', '2016-08-01 04:11:15'),
(16, 'B', 'Jayaram', 'applearns@outlook.com', 2, '$2y$10$4cum0dnG99rI.xb.S0CHmu9NSkO.LXJbP9NPZZh4gCQkBSpPWwREC', 'kakinada', 'lmqsQAtVHMBj169vsQVEUTQeDrMDfhrWSxIwjyraypvypBIZ9dXgRxRPbqht', '2016-08-01 03:55:38', '2016-08-01 04:28:29'),
(17, 'Ch', 'Jyo', 'veeraprasad65@gmail.com', 2, '$2y$10$ek1055X1atr8w8YmoEhmQeIxB1DI3ap8wwtwATz1yAAjci0HqB7Na', 'Rjy', 'tGPdUaIqnrNGOZYzDUwQmTbmJtKmgiMF1a46gdo4yPmUenPanCWDxr4vSqzi', '2016-08-05 07:08:42', '2016-12-27 03:09:27'),
(18, 'S', 'Venkatesh', 'venkatesh9918@gmail.com', 1, '$2y$10$iubbwmNh4.0AKcpdxyR6FefQMdHw/mga5wAL6wbse5RbLt5K.pjl2', 'kakinada', 'XMcyVEH0NzqpGrr1Tv8p5yIEsQTaG3KBbDImIyTpx92tnACokhG9r8cXDQqf', '2016-08-05 10:40:22', '2016-08-05 10:46:08'),
(19, 'S', 'Venky', 'venky9918@gmail.com', 1, '$2y$10$wUgzJQtuV6uGLExp9Q6RweOEUbHG/cG/k/WeqB2wdsNt8qbv.j0FS', 'Kakinada', 'TO4QHAh7pFcHiMjQDzmuZCFpIMd2MzdvIOq3qTQNrpN0LlZt6adJRY54lQoI', '2016-08-05 10:56:57', '2016-08-05 11:00:14');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `companyteams`
--
ALTER TABLE `companyteams`
  ADD CONSTRAINT `companyteams_cuser_id_foreign` FOREIGN KEY (`cuser_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `companyteams_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`);

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_cuser_id_foreign` FOREIGN KEY (`cuser_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `members_muser_id_foreign` FOREIGN KEY (`muser_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `members_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_cuser_id_foreign` FOREIGN KEY (`cuser_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tasks_muser_id_foreign` FOREIGN KEY (`muser_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
