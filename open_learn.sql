-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2017 at 09:23 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `open_learn`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `price` double(10,2) NOT NULL,
  `short_description` varchar(512) NOT NULL,
  `description` longtext NOT NULL,
  `requirements` longtext,
  `expiry_date` datetime DEFAULT NULL,
  `is_certification` tinyint(1) NOT NULL DEFAULT '1',
  `is_full_access` tinyint(1) NOT NULL DEFAULT '1',
  `what_will_learn` longtext,
  `category_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `price`, `short_description`, `description`, `requirements`, `expiry_date`, `is_certification`, `is_full_access`, `what_will_learn`, `category_id`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Course One', 11.00, 'This is short description', 'This is description', 'This is requirements', '2017-11-30 03:07:10', 1, 1, 'This is what will learn', 1, 1, 0, '2017-11-09 00:00:00', '2017-11-09 00:00:00'),
(2, 'Course Two', 31.00, 'This is short description', 'This is description', 'This is requirements', '2017-11-30 03:07:10', 1, 1, 'This is what will learn', 1, 1, 0, '2017-11-09 00:00:00', '2017-11-09 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `course_attachments`
--

CREATE TABLE `course_attachments` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `attachment_name` varchar(512) NOT NULL,
  `attachment_path` mediumtext NOT NULL,
  `attachment_type` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `course_categories`
--

CREATE TABLE `course_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_category_name` varchar(512) NOT NULL,
  `course_category_slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_categories`
--

INSERT INTO `course_categories` (`id`, `course_category_name`, `course_category_slug`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Course Cat One', 'cc1', 1, 0, '2017-11-09 00:00:00', '2017-11-09 00:00:00'),
(2, 'Course Cat 2', 'cc2', 1, 0, '2017-11-08 00:00:00', '2017-11-08 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `course_modules`
--

CREATE TABLE `course_modules` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `module_name` varchar(255) NOT NULL,
  `module_description` longtext NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_by` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `model_attachments`
--

CREATE TABLE `model_attachments` (
  `id` int(10) UNSIGNED NOT NULL,
  `module_id` int(11) NOT NULL,
  `attachment_name` varchar(512) NOT NULL,
  `attachment_path` mediumtext NOT NULL,
  `attachment_type` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_attachments`
--
ALTER TABLE `course_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_categories`
--
ALTER TABLE `course_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_modules`
--
ALTER TABLE `course_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_attachments`
--
ALTER TABLE `model_attachments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `course_attachments`
--
ALTER TABLE `course_attachments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `course_categories`
--
ALTER TABLE `course_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `course_modules`
--
ALTER TABLE `course_modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `model_attachments`
--
ALTER TABLE `model_attachments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
