-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 11, 2019 at 01:26 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Tp2_laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `location_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `user_id`, `location_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'q8vlIOpXT78UbctvWVsFT97syefBxnvABzvzyfMl.jpeg', '2019-05-11 05:06:34', '2019-05-11 05:06:34'),
(2, 1, 2, 'zBkVpMABqSsnStt8HjL5YNPOy8mPHRdXCZGEsr6L.jpeg', '2019-05-11 05:06:47', '2019-05-11 05:06:47'),
(3, 1, 3, 'XLsoIkfFZf10bDEsoHqsmUGPRz2hSfp6tzjtjbMZ.jpeg', '2019-05-11 05:07:05', '2019-05-11 05:07:05'),
(4, 2, 1, 'YzdrDHcKQ7OC6B6t0FlEknGnvfD7NZMnnv6ubYCh.jpeg', '2019-05-11 05:07:40', '2019-05-11 05:07:40'),
(5, 2, 4, 'GOc9gy4AW05De2jO4dZjOaRqxSl0cgK1b8sLG1aQ.jpeg', '2019-05-11 05:07:49', '2019-05-11 05:07:49'),
(6, 2, 5, 'EFpWY7azqatHhx27Al2Onh9RcnGtrjlZWhwDCMa3.jpeg', '2019-05-11 05:07:58', '2019-05-11 05:07:58'),
(7, 3, 6, 'BosKv8C0wYVdDPE674ehPUkzuTFACIHMEXI1qOHx.jpeg', '2019-05-11 05:09:13', '2019-05-11 05:09:13'),
(8, 3, 7, 'MRfsJFLl2cOTc8x1Opd3oGv2HNoex1EBmdiPMbRH.jpeg', '2019-05-11 05:09:24', '2019-05-11 05:09:24'),
(9, 3, 7, 'GNiLxVl5VxaTNJkSc4xvNmpBGPX5XJtjjHe6dtKg.jpeg', '2019-05-11 05:09:34', '2019-05-11 05:09:34'),
(10, 3, 8, '6xVSEnMVB982TjfLDnAi0Rpls6L16tuY5qLLBL0d.jpeg', '2019-05-11 05:11:44', '2019-05-11 05:11:44');

-- --------------------------------------------------------

--
-- Table structure for table `image_user`
--

CREATE TABLE `image_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `alert` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `image_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Montréal', '2019-05-11 05:06:09', '2019-05-11 05:06:09'),
(2, 'Québec', '2019-05-11 05:06:16', '2019-05-11 05:06:16'),
(3, 'Ottawa', '2019-05-11 05:06:20', '2019-05-11 05:06:20'),
(4, 'Thaïlande', '2019-05-11 05:07:23', '2019-05-11 05:07:23'),
(5, 'Cannes', '2019-05-11 05:07:30', '2019-05-11 05:07:30'),
(6, 'Cancun', '2019-05-11 05:08:55', '2019-05-11 05:08:55'),
(7, 'Varadero', '2019-05-11 05:09:01', '2019-05-11 05:09:01'),
(8, 'Jamaïque', '2019-05-11 05:11:33', '2019-05-11 05:11:33');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_04_12_191144_create_locations_table', 1),
(4, '2019_04_15_123129_create_images_table', 1),
(5, '2019_04_15_123652_create_image_user', 1),
(6, '2019_05_07_101820_create_models_images_table', 1),
(7, '2019_05_07_123612_create_models_locations_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `models_images`
--

CREATE TABLE `models_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `models_locations`
--

CREATE TABLE `models_locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` enum('user','admin') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.ca', '2019-05-11 05:04:20', '$2y$10$QuQLgL6kYsUa8GanRRC53OiKPaAsUr8BIv2SF6o1sbDZIT6Sl8apy', 'admin', NULL, '2019-05-11 05:04:20', '2019-05-11 05:04:20'),
(2, 'User1', 'user1@user1.ca', '2019-05-11 05:04:20', '$2y$10$2vG.GGnkRSUm/oC5SnuewefR0Z8/E3CxDaJ1AePiBhHEnB0peYncy', 'user', NULL, '2019-05-11 05:04:20', '2019-05-11 05:04:20'),
(3, 'User2', 'user2@user2.ca', '2019-05-11 05:04:20', '$2y$10$yKCUvuX48IH7K0dZ5fe3E.6R7hXKpgcB9RjkqlWiaYCYjgO.ojZJO', 'user', NULL, '2019-05-11 05:04:20', '2019-05-11 05:04:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_user_id_index` (`user_id`),
  ADD KEY `images_location_id_index` (`location_id`);

--
-- Indexes for table `image_user`
--
ALTER TABLE `image_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image_user_user_id_index` (`user_id`),
  ADD KEY `image_user_image_id_index` (`image_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `models_images`
--
ALTER TABLE `models_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `models_locations`
--
ALTER TABLE `models_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_name_unique` (`name`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `image_user`
--
ALTER TABLE `image_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `models_images`
--
ALTER TABLE `models_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `models_locations`
--
ALTER TABLE `models_locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `images_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `image_user`
--
ALTER TABLE `image_user`
  ADD CONSTRAINT `image_user_image_id_foreign` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `image_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
