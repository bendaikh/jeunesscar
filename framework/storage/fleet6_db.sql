-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 04, 2025 at 10:13 PM
-- Server version: 10.11.10-MariaDB
-- PHP Version: 7.2.34

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u158680994_touhfa`
--


-- --------------------------------------------------------

--
-- Table structure for table `additional_drivers`
--

DROP TABLE IF EXISTS `additional_drivers`;
CREATE TABLE IF NOT EXISTS `additional_drivers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `contract_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `id_number` varchar(100) DEFAULT NULL,
  `id_expiry_date` date DEFAULT NULL,
  `license_number` varchar(100) DEFAULT NULL,
  `license_issue_date` date DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `addresses_customer_id_index` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `customer_id`, `address`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 39, 'asd', NULL, '2025-05-08 21:56:27', '2025-05-08 21:56:27'),
(2, 39, 'wer', NULL, '2025-05-08 21:56:27', '2025-05-08 21:56:27');

-- --------------------------------------------------------

--
-- Table structure for table `api_settings`
--

DROP TABLE IF EXISTS `api_settings`;
CREATE TABLE IF NOT EXISTS `api_settings` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_name` varchar(255) DEFAULT NULL,
  `key_value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `api_settings_key_name_index` (`key_name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `api_settings`
--

INSERT INTO `api_settings` (`id`, `key_name`, `key_value`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'api', '1', '2021-11-20 07:03:58', '2021-11-20 07:03:58', NULL),
(2, 'anyone_register', '0', '2021-11-20 07:03:58', '2021-11-20 07:03:58', NULL),
(3, 'region_availability', 'region one, region two, region three', '2021-11-20 07:03:58', '2021-11-20 07:03:58', NULL),
(4, 'driver_review', '0', '2021-11-20 07:03:58', '2021-11-20 07:03:58', NULL),
(5, 'booking', '3', '2021-11-20 07:03:58', '2021-11-20 07:03:58', NULL),
(6, 'cancel', '2', '2021-11-20 07:03:58', '2021-11-20 07:03:58', NULL),
(7, 'max_trip', '1', '2021-11-20 07:03:58', '2021-11-20 07:03:58', NULL),
(8, 'api_key', '', '2021-11-20 07:03:58', '2021-11-20 07:03:58', NULL),
(9, 'db_url', '', '2021-11-20 07:03:58', '2021-11-20 07:03:58', NULL),
(10, 'db_secret', '', '2021-11-20 07:03:58', '2021-11-20 07:03:58', NULL),
(11, 'server_key', '', '2021-11-20 07:03:58', '2021-11-20 07:03:58', NULL),
(12, 'google_api', '0', '2021-11-20 07:03:58', '2021-11-20 07:03:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `branch_id` int(10) UNSIGNED DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `pickup` timestamp NULL DEFAULT NULL,
  `dropoff` timestamp NULL DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `pickup_addr` varchar(255) DEFAULT NULL,
  `dest_addr` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `avance` decimal(10,2) DEFAULT NULL,
  `travellers` int(11) NOT NULL DEFAULT 1,
  `cancellation` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `payment` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `pickup_branch_id` int(10) UNSIGNED DEFAULT NULL,
  `dropoff_branch_id` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bookings_customer_id_driver_id_vehicle_id_user_id_index` (`customer_id`,`driver_id`,`vehicle_id`,`user_id`),
  KEY `bookings_payment_status_index` (`payment`,`status`),
  KEY `bookings_branch_id_foreign` (`branch_id`),
  KEY `bookings_pickup_branch_id_foreign` (`pickup_branch_id`),
  KEY `bookings_dropoff_branch_id_foreign` (`dropoff_branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `customer_id`, `user_id`, `branch_id`, `vehicle_id`, `driver_id`, `pickup`, `dropoff`, `duration`, `pickup_addr`, `dest_addr`, `note`, `avance`, `travellers`, `cancellation`, `status`, `payment`, `created_at`, `updated_at`, `deleted_at`, `pickup_branch_id`, `dropoff_branch_id`) VALUES
(1, 4, 1, NULL, 1, 6, '2021-11-09 23:29:07', '2021-11-10 10:26:56', 2880, '368 Matilda Landing Apt. 901\nProhaskatown, SD 24803', '887 Sabina Parkway\nNorth Robbie, GA 83557-9858', 'sample note', NULL, 2, 0, 1, 1, '2021-11-20 07:03:41', '2025-05-10 16:26:30', '2025-05-10 16:26:30', NULL, NULL),
(2, 5, 1, NULL, 1, 7, '2021-10-26 07:53:04', '2021-10-27 10:42:16', 2880, '28114 Bernhard Springs\nMcDermottberg, GA 86108', '66878 Dora Mountains\nKenyastad, NY 63820', 'sample note', NULL, 3, 0, 0, 0, '2021-11-20 07:03:41', '2025-05-10 16:26:30', '2025-05-10 16:26:30', NULL, NULL),
(3, 39, 1, NULL, 5, NULL, '2025-05-08 21:56:04', '2025-05-29 21:56:04', 30240, 'asd', 'wer', NULL, 0.00, 1, 0, 0, 0, '2025-05-08 21:56:27', '2025-05-10 16:26:30', '2025-05-10 16:26:30', NULL, NULL),
(4, 39, 1, NULL, 8, NULL, '2025-05-08 21:56:04', '2025-05-30 21:56:04', 31680, 'asd', 'wer', NULL, 0.00, 1, 0, 0, 0, '2025-05-08 21:59:36', '2025-05-08 21:59:52', '2025-05-08 21:59:52', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bookings_meta`
--

DROP TABLE IF EXISTS `bookings_meta`;
CREATE TABLE IF NOT EXISTS `bookings_meta` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `booking_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'null',
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bookings_meta_booking_id_index` (`booking_id`),
  KEY `bookings_meta_key_index` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `bookings_meta`
--

INSERT INTO `bookings_meta` (`id`, `booking_id`, `type`, `key`, `value`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'integer', 'tax_total', '500', NULL, '2021-11-20 07:03:51', '2021-11-20 07:03:51'),
(2, 1, 'integer', 'total_tax_percent', '0', NULL, '2021-11-20 07:03:51', '2021-11-20 07:03:51'),
(3, 1, 'integer', 'total_tax_charge_rs', '0', NULL, '2021-11-20 07:03:51', '2021-11-20 07:03:51'),
(4, 1, 'string', 'ride_status', 'Completed', NULL, '2021-11-20 07:03:52', '2021-11-20 07:03:52'),
(5, 1, 'string', 'journey_date', '10-11-2021', NULL, '2021-11-20 07:03:52', '2021-11-20 07:03:52'),
(6, 1, 'string', 'journey_time', '04:59:07', NULL, '2021-11-20 07:03:52', '2021-11-20 07:03:52'),
(7, 1, 'integer', 'customerid', '4', NULL, '2021-11-20 07:03:52', '2021-11-20 07:03:52'),
(8, 1, 'integer', 'vehicleid', '1', NULL, '2021-11-20 07:03:52', '2021-11-20 07:03:52'),
(9, 1, 'integer', 'day', '1', NULL, '2021-11-20 07:03:52', '2021-11-20 07:03:52'),
(10, 1, 'integer', 'mileage', '10', NULL, '2021-11-20 07:03:52', '2021-11-20 07:03:52'),
(11, 1, 'integer', 'waiting_time', '0', NULL, '2021-11-20 07:03:52', '2021-11-20 07:03:52'),
(12, 1, 'string', 'date', '2021-11-20', NULL, '2021-11-20 07:03:52', '2021-11-20 07:03:52'),
(13, 1, 'integer', 'total', '500', NULL, '2021-11-20 07:03:52', '2021-11-20 07:03:52'),
(14, 1, 'integer', 'receipt', '1', NULL, '2021-11-20 07:03:52', '2021-11-20 07:03:52'),
(15, 2, 'string', 'ride_status', 'Upcoming', NULL, '2021-11-20 07:03:52', '2021-11-20 07:03:52'),
(16, 2, 'string', 'journey_date', '26-10-2021', NULL, '2021-11-20 07:03:52', '2021-11-20 07:03:52'),
(17, 2, 'string', 'journey_time', '13:23:04', NULL, '2021-11-20 07:03:52', '2021-11-20 07:03:52'),
(18, 3, 'string', 'udf', 'N', NULL, '2025-05-08 21:56:27', '2025-05-08 21:56:27'),
(19, 3, 'integer', 'accept_status', '1', NULL, '2025-05-08 21:56:27', '2025-05-08 21:56:27'),
(20, 3, 'string', 'ride_status', 'Upcoming', NULL, '2025-05-08 21:56:27', '2025-05-08 21:56:27'),
(21, 3, 'integer', 'booking_type', '1', NULL, '2025-05-08 21:56:27', '2025-05-08 21:56:27'),
(22, 3, 'string', 'journey_date', '08-05-2025', NULL, '2025-05-08 21:56:27', '2025-05-08 21:56:27'),
(23, 3, 'string', 'journey_time', '21:56:04', NULL, '2025-05-08 21:56:27', '2025-05-08 21:56:27'),
(24, 4, 'string', 'udf', 'N', NULL, '2025-05-08 21:59:36', '2025-05-08 21:59:36'),
(25, 4, 'integer', 'accept_status', '1', NULL, '2025-05-08 21:59:36', '2025-05-08 21:59:36'),
(26, 4, 'string', 'ride_status', 'Upcoming', NULL, '2025-05-08 21:59:36', '2025-05-08 21:59:36'),
(27, 4, 'integer', 'booking_type', '1', NULL, '2025-05-08 21:59:36', '2025-05-08 21:59:36'),
(28, 4, 'string', 'journey_date', '08-05-2025', NULL, '2025-05-08 21:59:36', '2025-05-08 21:59:36'),
(29, 4, 'string', 'journey_time', '21:56:04', NULL, '2025-05-08 21:59:36', '2025-05-08 21:59:36');

-- --------------------------------------------------------

--
-- Table structure for table `booking_income`
--

DROP TABLE IF EXISTS `booking_income`;
CREATE TABLE IF NOT EXISTS `booking_income` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `booking_id` int(11) DEFAULT NULL,
  `income_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `booking_income_booking_id_income_id_index` (`booking_id`,`income_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `booking_income`
--

INSERT INTO `booking_income` (`id`, `booking_id`, `income_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 3, '2021-11-20 07:03:51', '2021-11-20 07:03:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `booking_payments`
--

DROP TABLE IF EXISTS `booking_payments`;
CREATE TABLE IF NOT EXISTS `booking_payments` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `booking_id` int(11) DEFAULT NULL,
  `method` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `amount` double NOT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `payment_details` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking_quotation`
--

DROP TABLE IF EXISTS `booking_quotation`;
CREATE TABLE IF NOT EXISTS `booking_quotation` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `pickup` timestamp NULL DEFAULT NULL,
  `dropoff` timestamp NULL DEFAULT NULL,
  `pickup_addr` varchar(255) DEFAULT NULL,
  `dest_addr` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `travellers` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 0,
  `payment` int(11) NOT NULL DEFAULT 0,
  `day` int(11) DEFAULT NULL,
  `mileage` double DEFAULT NULL,
  `waiting_time` int(11) DEFAULT NULL,
  `total` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `tax_total` double(10,2) DEFAULT NULL,
  `total_tax_percent` double(10,2) DEFAULT NULL,
  `total_tax_charge_rs` double(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `booking_quotation_customer_id_user_id_vehicle_id_driver_id_index` (`customer_id`,`user_id`,`vehicle_id`,`driver_id`),
  KEY `booking_quotation_status_payment_index` (`status`,`payment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
CREATE TABLE IF NOT EXISTS `branches` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `address`, `city`, `state`, `country`, `zipcode`, `phone`, `email`, `contact_person`, `details`, `latitude`, `longitude`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'main', 'شارع الملك فهد', 'الرياض', NULL, NULL, NULL, '0123456789', 'main@example.com', 'mohammed', NULL, NULL, NULL, 1, '2025-05-24 11:35:14', '2025-05-25 15:44:50', NULL),
(2, 'فرع جدة', 'شارع الأمير محمد', 'جدة', NULL, NULL, NULL, '0123456788', 'jeddah@example.com', 'أحمد', NULL, NULL, NULL, 1, '2025-05-24 11:35:14', '2025-05-24 11:35:14', NULL),
(3, '12', 'merrakech discription', 'maraekch cidudad', 'marrakech state', 'morroco', '123456', '123456789', 'admin@school.com', '45664684489', 'merrakech details', '0.00001', '0.0002', 1, '2025-05-25 11:22:37', '2025-05-25 14:12:58', '2025-05-25 14:12:58');

-- --------------------------------------------------------

--
-- Table structure for table `branch_distances`
--

DROP TABLE IF EXISTS `branch_distances`;
CREATE TABLE IF NOT EXISTS `branch_distances` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `from_branch_id` int(10) UNSIGNED NOT NULL,
  `to_branch_id` int(10) UNSIGNED NOT NULL,
  `distance` decimal(10,2) NOT NULL,
  `fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `branch_distances_from_branch_id_foreign` (`from_branch_id`),
  KEY `branch_distances_to_branch_id_foreign` (`to_branch_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branch_settings`
--

DROP TABLE IF EXISTS `branch_settings`;
CREATE TABLE IF NOT EXISTS `branch_settings` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `branch_id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `branch_settings_branch_id_key_unique` (`branch_id`,`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_settings`
--

DROP TABLE IF EXISTS `chat_settings`;
CREATE TABLE IF NOT EXISTS `chat_settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `chat_settings`
--

INSERT INTO `chat_settings` (`id`, `name`, `value`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'pusher_app_id', '', '2022-01-23 23:35:30', '2022-01-24 00:02:32', NULL),
(2, 'pusher_app_key', '', '2022-01-23 23:35:30', '2022-01-24 00:02:32', NULL),
(3, 'pusher_app_secret', '', '2022-01-23 23:35:30', '2022-01-24 00:02:32', NULL),
(4, 'pusher_app_cluster', '', '2022-01-23 23:35:30', '2022-01-24 00:02:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company_services`
--

DROP TABLE IF EXISTS `company_services`;
CREATE TABLE IF NOT EXISTS `company_services` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `company_services`
--

INSERT INTO `company_services` (`id`, `title`, `image`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Best price guranteed', 'fleet-bestprice.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.Neque at, nobis repudiandae dolores.', NULL, '2021-11-20 07:03:45', '2021-11-20 07:03:45'),
(2, '24/7 Customer care', 'fleet-care.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.Neque at, nobis repudiandae dolores.', NULL, '2021-11-20 07:03:45', '2021-11-20 07:03:45'),
(3, 'Home pickups', 'fleet-homepickup.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.Neque at, nobis repudiandae dolores.', NULL, '2021-11-20 07:03:45', '2021-11-20 07:03:45'),
(4, 'Easy Bookings', 'fleet-easybooking.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.Neque at, nobis repudiandae dolores.', NULL, '2021-11-20 07:03:45', '2021-11-20 07:03:45');

-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

DROP TABLE IF EXISTS `contracts`;
CREATE TABLE IF NOT EXISTS `contracts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_id` bigint(20) UNSIGNED NOT NULL,
  `contract_number` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `duration` int(11) DEFAULT NULL,
  `daily_rate` decimal(10,2) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `advance_payment` decimal(10,2) DEFAULT NULL,
  `remaining_amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `start_location` varchar(255) DEFAULT NULL,
  `end_location` varchar(255) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `franchise` decimal(10,2) DEFAULT NULL,
  `client_signature` text DEFAULT NULL,
  `witness_signature` text DEFAULT NULL,
  `signed_at` datetime DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `branch_id` int(10) UNSIGNED DEFAULT NULL,
  `pickup_branch_id` int(10) UNSIGNED DEFAULT NULL,
  `dropoff_branch_id` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `contract_number` (`contract_number`),
  KEY `contracts_branch_id_foreign` (`branch_id`),
  KEY `contracts_pickup_branch_id_foreign` (`pickup_branch_id`),
  KEY `contracts_dropoff_branch_id_foreign` (`dropoff_branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contracts`
--


-- --------------------------------------------------------

--
-- Table structure for table `driver_logs`
--

DROP TABLE IF EXISTS `driver_logs`;
CREATE TABLE IF NOT EXISTS `driver_logs` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `driver_logs_driver_id_vehicle_id_index` (`driver_id`,`vehicle_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `driver_logs`
--

INSERT INTO `driver_logs` (`id`, `vehicle_id`, `driver_id`, `date`, `created_at`, `updated_at`) VALUES
(1, 1, 6, '2021-11-20 07:03:53', '2021-11-20 07:03:53', '2021-11-20 07:03:53'),
(2, 2, 8, '2021-11-22 23:02:01', '2021-11-22 23:02:01', '2021-11-22 23:02:01');

-- --------------------------------------------------------

--
-- Table structure for table `driver_payments`
--

DROP TABLE IF EXISTS `driver_payments`;
CREATE TABLE IF NOT EXISTS `driver_payments` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `driver_id` int(11) NOT NULL,
  `amount` double(10,2) NOT NULL DEFAULT 0.00,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `driver_payments_driver_id_user_id_index` (`driver_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `driver_vehicle`
--

DROP TABLE IF EXISTS `driver_vehicle`;
CREATE TABLE IF NOT EXISTS `driver_vehicle` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) DEFAULT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `driver_vehicle_driver_id_vehicle_id_index` (`driver_id`,`vehicle_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_content`
--

DROP TABLE IF EXISTS `email_content`;
CREATE TABLE IF NOT EXISTS `email_content` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(255) DEFAULT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `email_content_key_index` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `email_content`
--

INSERT INTO `email_content` (`id`, `key`, `value`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'insurance', 'vehicle insurance email content', '2021-11-20 07:04:07', '2021-11-20 07:04:07', NULL),
(2, 'vehicle_licence', 'vehicle licence email content', '2021-11-20 07:04:07', '2021-11-20 07:04:07', NULL),
(3, 'driving_licence', 'driving licence email content', '2021-11-20 07:04:07', '2021-11-20 07:04:07', NULL),
(4, 'registration', 'vehicle registration email content', '2021-11-20 07:04:07', '2021-11-20 07:04:07', NULL),
(5, 'service_reminder', 'service reminder email content', '2021-11-20 07:04:07', '2021-11-20 07:04:07', NULL),
(6, 'users', '', '2021-11-20 07:04:07', '2021-11-20 07:04:07', NULL),
(7, 'options', '', '2021-11-20 07:04:07', '2021-11-20 07:04:07', NULL),
(8, 'email', '0', '2021-11-20 07:04:07', '2021-11-20 07:04:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

DROP TABLE IF EXISTS `expense`;
CREATE TABLE IF NOT EXISTS `expense` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) DEFAULT NULL,
  `exp_id` int(11) DEFAULT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'e',
  `amount` double(10,2) NOT NULL DEFAULT 0.00,
  `driver_amount` double(10,2) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `expense_type` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `branch_id` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expense_vehicle_id_exp_id_user_id_expense_type_index` (`vehicle_id`,`exp_id`,`user_id`,`expense_type`),
  KEY `expense_type_index` (`type`),
  KEY `expense_date_index` (`date`),
  KEY `expense_branch_id_foreign` (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`id`, `vehicle_id`, `exp_id`, `type`, `amount`, `driver_amount`, `user_id`, `expense_type`, `comment`, `date`, `created_at`, `updated_at`, `deleted_at`, `vendor_id`, `branch_id`) VALUES
(1, 1, NULL, 'e', 1763.00, 0.00, 2, 1, 'Sample Comment', '2021-11-19', '2021-11-20 07:03:50', '2025-05-05 13:36:31', '2025-05-05 13:36:31', NULL, NULL),
(2, 2, NULL, 'e', 1312.00, 0.00, 3, 4, 'Sample Comment', '2021-11-15', '2021-11-20 07:03:51', '2025-05-05 13:36:31', '2025-05-05 13:36:31', NULL, NULL),
(3, 1, 1, 'e', 500.00, 0.00, 2, 8, 'Sample Comment', '2021-11-18', '2021-11-20 07:03:53', '2025-05-05 13:36:31', '2025-05-05 13:36:31', NULL, NULL),
(4, 1, 2, 'e', 500.00, 0.00, 2, 8, 'Sample Comment', '2021-11-30', '2021-11-20 07:03:53', '2025-05-05 13:36:31', '2025-05-05 13:36:31', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `expense_cat`
--

DROP TABLE IF EXISTS `expense_cat`;
CREATE TABLE IF NOT EXISTS `expense_cat` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` varchar(5) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expense_cat_name_type_index` (`name`,`type`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `expense_cat`
--

INSERT INTO `expense_cat` (`id`, `name`, `user_id`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Insurance', 1, 'd', '2021-11-20 07:03:54', '2021-11-20 07:03:54', NULL),
(2, 'Patente', 1, 'd', '2021-11-20 07:03:54', '2021-11-20 07:03:54', NULL),
(3, 'Mechanics', 1, 'd', '2021-11-20 07:03:55', '2021-11-20 07:03:55', NULL),
(4, 'Car wash', 1, 'd', '2021-11-20 07:03:55', '2021-11-20 07:03:55', NULL),
(5, 'Vignette', 1, 'd', '2021-11-20 07:03:55', '2021-11-20 07:03:55', NULL),
(6, 'Maintenance', 1, 'd', '2021-11-20 07:03:55', '2021-11-20 07:03:55', NULL),
(7, 'Parking', 1, 'd', '2021-11-20 07:03:55', '2021-11-20 07:03:55', NULL),
(8, 'Fuel', 1, 'd', '2021-11-20 07:03:55', '2021-11-20 07:03:55', NULL),
(9, 'Car Services', 1, 'd', '2021-11-20 07:03:55', '2021-11-20 07:03:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fare_settings`
--

DROP TABLE IF EXISTS `fare_settings`;
CREATE TABLE IF NOT EXISTS `fare_settings` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_name` varchar(255) DEFAULT NULL,
  `key_value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fare_settings_key_name_index` (`key_name`),
  KEY `fare_settings_type_id_index` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `fare_settings`
--

INSERT INTO `fare_settings` (`id`, `key_name`, `key_value`, `created_at`, `updated_at`, `deleted_at`, `type_id`) VALUES
(1, 'hatchback_base_fare', '500', '2021-11-20 07:03:59', '2021-11-20 07:03:59', NULL, 1),
(2, 'hatchback_base_km', '10', '2021-11-20 07:03:59', '2021-11-20 07:03:59', NULL, 1),
(3, 'hatchback_base_time', '2', '2021-11-20 07:03:59', '2021-11-20 07:03:59', NULL, 1),
(4, 'hatchback_std_fare', '20', '2021-11-20 07:03:59', '2021-11-20 07:03:59', NULL, 1),
(5, 'hatchback_weekend_base_fare', '500', '2021-11-20 07:03:59', '2021-11-20 07:03:59', NULL, 1),
(6, 'hatchback_weekend_base_km', '10', '2021-11-20 07:03:59', '2021-11-20 07:03:59', NULL, 1),
(7, 'hatchback_weekend_wait_time', '2', '2021-11-20 07:03:59', '2021-11-20 07:03:59', NULL, 1),
(8, 'hatchback_weekend_std_fare', '20', '2021-11-20 07:04:00', '2021-11-20 07:04:00', NULL, 1),
(9, 'hatchback_night_base_fare', '500', '2021-11-20 07:04:00', '2021-11-20 07:04:00', NULL, 1),
(10, 'hatchback_night_base_km', '10', '2021-11-20 07:04:00', '2021-11-20 07:04:00', NULL, 1),
(11, 'hatchback_night_wait_time', '2', '2021-11-20 07:04:00', '2021-11-20 07:04:00', NULL, 1),
(12, 'hatchback_night_std_fare', '20', '2021-11-20 07:04:00', '2021-11-20 07:04:00', NULL, 1),
(13, 'sedan_base_fare', '500', '2021-11-20 07:04:00', '2021-11-20 07:04:00', NULL, 2),
(14, 'sedan_base_km', '10', '2021-11-20 07:04:00', '2021-11-20 07:04:00', NULL, 2),
(15, 'sedan_base_time', '2', '2021-11-20 07:04:00', '2021-11-20 07:04:00', NULL, 2),
(16, 'sedan_std_fare', '20', '2021-11-20 07:04:01', '2021-11-20 07:04:01', NULL, 2),
(17, 'sedan_weekend_base_fare', '500', '2021-11-20 07:04:01', '2021-11-20 07:04:01', NULL, 2),
(18, 'sedan_weekend_base_km', '10', '2021-11-20 07:04:01', '2021-11-20 07:04:01', NULL, 2),
(19, 'sedan_weekend_wait_time', '2', '2021-11-20 07:04:01', '2021-11-20 07:04:01', NULL, 2),
(20, 'sedan_weekend_std_fare', '20', '2021-11-20 07:04:01', '2021-11-20 07:04:01', NULL, 2),
(21, 'sedan_night_base_fare', '500', '2021-11-20 07:04:01', '2021-11-20 07:04:01', NULL, 2),
(22, 'sedan_night_base_km', '10', '2021-11-20 07:04:01', '2021-11-20 07:04:01', NULL, 2),
(23, 'sedan_night_wait_time', '2', '2021-11-20 07:04:01', '2021-11-20 07:04:01', NULL, 2),
(24, 'sedan_night_std_fare', '20', '2021-11-20 07:04:02', '2021-11-20 07:04:02', NULL, 2),
(25, 'minivan_base_fare', '500', '2021-11-20 07:04:02', '2021-11-20 07:04:02', NULL, 3),
(26, 'minivan_base_km', '10', '2021-11-20 07:04:02', '2021-11-20 07:04:02', NULL, 3),
(27, 'minivan_base_time', '2', '2021-11-20 07:04:02', '2021-11-20 07:04:02', NULL, 3),
(28, 'minivan_std_fare', '20', '2021-11-20 07:04:02', '2021-11-20 07:04:02', NULL, 3),
(29, 'minivan_weekend_base_fare', '500', '2021-11-20 07:04:03', '2021-11-20 07:04:03', NULL, 3),
(30, 'minivan_weekend_base_km', '10', '2021-11-20 07:04:03', '2021-11-20 07:04:03', NULL, 3),
(31, 'minivan_weekend_wait_time', '2', '2021-11-20 07:04:03', '2021-11-20 07:04:03', NULL, 3),
(32, 'minivan_weekend_std_fare', '20', '2021-11-20 07:04:03', '2021-11-20 07:04:03', NULL, 3),
(33, 'minivan_night_base_fare', '500', '2021-11-20 07:04:03', '2021-11-20 07:04:03', NULL, 3),
(34, 'minivan_night_base_km', '10', '2021-11-20 07:04:03', '2021-11-20 07:04:03', NULL, 3),
(35, 'minivan_night_wait_time', '2', '2021-11-20 07:04:03', '2021-11-20 07:04:03', NULL, 3),
(36, 'minivan_night_std_fare', '20', '2021-11-20 07:04:03', '2021-11-20 07:04:03', NULL, 3),
(37, 'saloon_base_fare', '500', '2021-11-20 07:04:03', '2021-11-20 07:04:03', NULL, 4),
(38, 'saloon_base_km', '10', '2021-11-20 07:04:03', '2021-11-20 07:04:03', NULL, 4),
(39, 'saloon_base_time', '2', '2021-11-20 07:04:04', '2021-11-20 07:04:04', NULL, 4),
(40, 'saloon_std_fare', '20', '2021-11-20 07:04:04', '2021-11-20 07:04:04', NULL, 4),
(41, 'saloon_weekend_base_fare', '500', '2021-11-20 07:04:04', '2021-11-20 07:04:04', NULL, 4),
(42, 'saloon_weekend_base_km', '10', '2021-11-20 07:04:04', '2021-11-20 07:04:04', NULL, 4),
(43, 'saloon_weekend_wait_time', '2', '2021-11-20 07:04:04', '2021-11-20 07:04:04', NULL, 4),
(44, 'saloon_weekend_std_fare', '20', '2021-11-20 07:04:04', '2021-11-20 07:04:04', NULL, 4),
(45, 'saloon_night_base_fare', '500', '2021-11-20 07:04:04', '2021-11-20 07:04:04', NULL, 4),
(46, 'saloon_night_base_km', '10', '2021-11-20 07:04:04', '2021-11-20 07:04:04', NULL, 4),
(47, 'saloon_night_wait_time', '2', '2021-11-20 07:04:04', '2021-11-20 07:04:04', NULL, 4),
(48, 'saloon_night_std_fare', '20', '2021-11-20 07:04:04', '2021-11-20 07:04:04', NULL, 4),
(49, 'suv_base_fare', '500', '2021-11-20 07:04:04', '2021-11-20 07:04:04', NULL, 5),
(50, 'suv_base_km', '10', '2021-11-20 07:04:04', '2021-11-20 07:04:04', NULL, 5),
(51, 'suv_base_time', '2', '2021-11-20 07:04:04', '2021-11-20 07:04:04', NULL, 5),
(52, 'suv_std_fare', '20', '2021-11-20 07:04:04', '2021-11-20 07:04:04', NULL, 5),
(53, 'suv_weekend_base_fare', '500', '2021-11-20 07:04:04', '2021-11-20 07:04:04', NULL, 5),
(54, 'suv_weekend_base_km', '10', '2021-11-20 07:04:05', '2021-11-20 07:04:05', NULL, 5),
(55, 'suv_weekend_wait_time', '2', '2021-11-20 07:04:05', '2021-11-20 07:04:05', NULL, 5),
(56, 'suv_weekend_std_fare', '20', '2021-11-20 07:04:05', '2021-11-20 07:04:05', NULL, 5),
(57, 'suv_night_base_fare', '500', '2021-11-20 07:04:05', '2021-11-20 07:04:05', NULL, 5),
(58, 'suv_night_base_km', '10', '2021-11-20 07:04:05', '2021-11-20 07:04:05', NULL, 5),
(59, 'suv_night_wait_time', '2', '2021-11-20 07:04:05', '2021-11-20 07:04:05', NULL, 5),
(60, 'suv_night_std_fare', '20', '2021-11-20 07:04:05', '2021-11-20 07:04:05', NULL, 5),
(61, 'bus_base_fare', '500', '2021-11-20 07:04:05', '2021-11-20 07:04:05', NULL, 6),
(62, 'bus_base_km', '10', '2021-11-20 07:04:05', '2021-11-20 07:04:05', NULL, 6),
(63, 'bus_base_time', '2', '2021-11-20 07:04:05', '2021-11-20 07:04:05', NULL, 6),
(64, 'bus_std_fare', '20', '2021-11-20 07:04:05', '2021-11-20 07:04:05', NULL, 6),
(65, 'bus_weekend_base_fare', '500', '2021-11-20 07:04:05', '2021-11-20 07:04:05', NULL, 6),
(66, 'bus_weekend_base_km', '10', '2021-11-20 07:04:05', '2021-11-20 07:04:05', NULL, 6),
(67, 'bus_weekend_wait_time', '2', '2021-11-20 07:04:05', '2021-11-20 07:04:05', NULL, 6),
(68, 'bus_weekend_std_fare', '20', '2021-11-20 07:04:05', '2021-11-20 07:04:05', NULL, 6),
(69, 'bus_night_base_fare', '500', '2021-11-20 07:04:05', '2021-11-20 07:04:05', NULL, 6),
(70, 'bus_night_base_km', '10', '2021-11-20 07:04:05', '2021-11-20 07:04:05', NULL, 6),
(71, 'bus_night_wait_time', '2', '2021-11-20 07:04:05', '2021-11-20 07:04:05', NULL, 6),
(72, 'bus_night_std_fare', '20', '2021-11-20 07:04:05', '2021-11-20 07:04:05', NULL, 6),
(73, 'truck_base_fare', '500', '2021-11-20 07:04:06', '2021-11-20 07:04:06', NULL, 7),
(74, 'truck_base_km', '10', '2021-11-20 07:04:06', '2021-11-20 07:04:06', NULL, 7),
(75, 'truck_base_time', '2', '2021-11-20 07:04:06', '2021-11-20 07:04:06', NULL, 7),
(76, 'truck_std_fare', '20', '2021-11-20 07:04:06', '2021-11-20 07:04:06', NULL, 7),
(77, 'truck_weekend_base_fare', '500', '2021-11-20 07:04:06', '2021-11-20 07:04:06', NULL, 7),
(78, 'truck_weekend_base_km', '10', '2021-11-20 07:04:06', '2021-11-20 07:04:06', NULL, 7),
(79, 'truck_weekend_wait_time', '2', '2021-11-20 07:04:06', '2021-11-20 07:04:06', NULL, 7),
(80, 'truck_weekend_std_fare', '20', '2021-11-20 07:04:06', '2021-11-20 07:04:06', NULL, 7),
(81, 'truck_night_base_fare', '500', '2021-11-20 07:04:06', '2021-11-20 07:04:06', NULL, 7),
(82, 'truck_night_base_km', '10', '2021-11-20 07:04:06', '2021-11-20 07:04:06', NULL, 7),
(83, 'truck_night_wait_time', '2', '2021-11-20 07:04:06', '2021-11-20 07:04:06', NULL, 7),
(84, 'truck_night_std_fare', '20', '2021-11-20 07:04:06', '2021-11-20 07:04:06', NULL, 7);

-- --------------------------------------------------------

--
-- Table structure for table `frontend`
--

DROP TABLE IF EXISTS `frontend`;
CREATE TABLE IF NOT EXISTS `frontend` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_name` varchar(255) DEFAULT NULL,
  `key_value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `frontend_key_name_index` (`key_name`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `frontend`
--

INSERT INTO `frontend` (`id`, `key_name`, `key_value`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'about_us', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2021-11-20 07:04:08', '2025-05-04 15:47:11', NULL),
(2, 'contact_email', 'master@admin.com', '2021-11-20 07:04:08', '2025-05-04 15:47:11', NULL),
(3, 'contact_phone', '0123456789', '2021-11-20 07:04:08', '2025-05-04 15:47:11', NULL),
(4, 'customer_support', '0999988888', '2021-11-20 07:04:08', '2025-05-04 15:47:11', NULL),
(5, 'about_description', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2021-11-20 07:04:08', '2025-05-04 15:47:11', NULL),
(6, 'about_title', 'Proudly serving you', '2021-11-20 07:04:08', '2025-05-04 15:47:11', NULL),
(7, 'facebook', NULL, '2021-11-20 07:04:08', '2025-05-04 15:47:11', NULL),
(8, 'twitter', NULL, '2021-11-20 07:04:08', '2025-05-04 15:47:11', NULL),
(9, 'instagram', NULL, '2021-11-20 07:04:08', '2025-05-04 15:47:11', NULL),
(10, 'linkedin', NULL, '2021-11-20 07:04:08', '2025-05-04 15:47:11', NULL),
(11, 'faq_link', NULL, '2021-11-20 07:04:08', '2025-05-04 15:47:11', NULL),
(12, 'cities', '5', '2021-11-20 07:04:08', '2025-05-04 15:47:11', NULL),
(13, 'vehicles', '10', '2021-11-20 07:04:08', '2025-05-04 15:47:11', NULL),
(14, 'cancellation', NULL, '2021-11-20 07:04:08', '2025-05-04 15:47:11', NULL),
(15, 'terms', NULL, '2021-11-20 07:04:09', '2025-05-04 15:47:11', NULL),
(16, 'privacy_policy', NULL, '2021-11-20 07:04:09', '2025-05-04 15:47:11', NULL),
(17, 'enable', NULL, '2021-11-20 07:04:09', '2025-05-04 15:47:11', NULL),
(18, 'language', 'English-en', '2021-11-20 07:04:09', '2025-05-04 15:47:11', NULL),
(19, 'admin_approval', '1', '2021-11-20 07:04:09', '2025-05-04 15:47:11', NULL),
(20, 'booking_time', '1', '2022-01-05 16:00:09', '2025-05-04 15:47:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fuel`
--

DROP TABLE IF EXISTS `fuel`;
CREATE TABLE IF NOT EXISTS `fuel` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `start_meter` varchar(255) DEFAULT NULL,
  `end_meter` varchar(255) DEFAULT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `vendor_name` varchar(255) DEFAULT NULL,
  `qty` double(10,2) DEFAULT NULL,
  `fuel_from` varchar(255) DEFAULT NULL,
  `cost_per_unit` varchar(255) DEFAULT NULL,
  `consumption` int(11) DEFAULT NULL,
  `complete` int(11) DEFAULT 0,
  `date` date DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fuel_vehicle_id_user_id_index` (`vehicle_id`,`user_id`),
  KEY `fuel_date_index` (`date`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `fuel`
--

INSERT INTO `fuel` (`id`, `vehicle_id`, `user_id`, `start_meter`, `end_meter`, `reference`, `province`, `note`, `vendor_name`, `qty`, `fuel_from`, `cost_per_unit`, `consumption`, `complete`, `date`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, '1000', '2000', NULL, 'Gujarat', 'sample note', NULL, 10.00, 'Fuel Tank', '50', 100, 0, '2021-11-18', NULL, '2021-11-20 07:03:53', '2025-05-05 13:36:31', '2025-05-05 13:36:31'),
(2, 1, 2, '2000', '0', NULL, 'Gujarat', 'sample note', NULL, 10.00, 'Fuel Tank', '50', 0, 0, '2021-11-30', NULL, '2021-11-20 07:03:53', '2025-05-05 13:36:31', '2025-05-05 13:36:31');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

DROP TABLE IF EXISTS `income`;
CREATE TABLE IF NOT EXISTS `income` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) DEFAULT NULL,
  `income_id` int(11) DEFAULT NULL,
  `amount` double(10,2) NOT NULL DEFAULT 0.00,
  `driver_amount` double(10,2) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `income_cat` int(11) DEFAULT 2,
  `mileage` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `tax_percent` double(10,2) DEFAULT NULL,
  `tax_charge_rs` double(10,2) DEFAULT NULL,
  `branch_id` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `income_vehicle_id_income_id_user_id_income_cat_index` (`vehicle_id`,`income_id`,`user_id`,`income_cat`),
  KEY `income_date_index` (`date`),
  KEY `income_branch_id_foreign` (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`id`, `vehicle_id`, `income_id`, `amount`, `driver_amount`, `user_id`, `income_cat`, `mileage`, `date`, `created_at`, `updated_at`, `deleted_at`, `tax_percent`, `tax_charge_rs`, `branch_id`) VALUES
(9, 5, NULL, 1500.00, NULL, 2, 2, 101789, '2025-05-15', '2025-05-15 14:51:38', '2025-05-15 14:51:38', NULL, 0.00, 0.00, 1),
(17, 23, NULL, 700.00, NULL, 2, 2, 19880, '2025-05-15', '2025-05-15 16:03:03', '2025-05-15 16:03:03', NULL, 0.00, 0.00, 1),
(18, 9, NULL, 3000.00, NULL, 1, 2, 80304, '2025-05-15', '2025-05-15 19:31:21', '2025-05-15 19:31:21', NULL, 0.00, 0.00, 1),
(19, 19, NULL, 900.00, NULL, 1, 2, 65764, '2025-05-15', '2025-05-15 20:34:54', '2025-05-15 20:34:54', NULL, 0.00, 0.00, 1),
(20, 8, NULL, 60.00, NULL, 1, 2, 58900, '2025-05-15', '2025-05-15 23:45:06', '2025-05-15 23:45:06', NULL, 0.00, 0.00, 1),
(22, 15, NULL, 800.00, NULL, 3, 2, 19880, '2025-05-16', '2025-05-16 00:49:37', '2025-05-16 00:49:37', NULL, 0.00, 0.00, 1),
(23, 15, NULL, 900.00, NULL, 3, 2, 19880, '2025-05-16', '2025-05-16 00:50:50', '2025-05-16 00:50:50', NULL, 0.00, 0.00, 1),
(24, 15, NULL, 900.00, NULL, 3, 2, 19880, '2025-05-16', '2025-05-16 00:51:39', '2025-05-16 00:51:39', NULL, 0.00, 0.00, 1),
(25, 15, NULL, 600.00, NULL, 3, 2, 19880, '2025-05-16', '2025-05-16 00:56:43', '2025-05-16 00:56:43', NULL, 0.00, 0.00, 1),
(26, 18, NULL, 900.00, NULL, 3, 2, 15600, '2025-05-18', '2025-05-18 16:35:44', '2025-05-18 16:35:44', NULL, 0.00, 0.00, 1),
(27, 8, NULL, 12000.00, NULL, 3, 2, 58900, '2025-05-18', '2025-05-18 17:48:29', '2025-05-18 17:48:29', NULL, 0.00, 0.00, 1),
(28, 12, NULL, 1300.00, NULL, 2, 2, 31600, '2025-05-19', '2025-05-19 16:32:19', '2025-05-19 16:32:19', NULL, 0.00, 0.00, 1),
(29, 19, NULL, 1200.00, NULL, 2, 2, 65764, '2025-05-20', '2025-05-20 11:26:41', '2025-05-20 11:26:41', NULL, 0.00, 0.00, 1),
(30, 15, NULL, 600.00, NULL, 3, 2, 19880, '2025-05-20', '2025-05-20 23:44:14', '2025-05-20 23:44:14', NULL, 0.00, 0.00, 1),
(31, 5, NULL, 2750.00, NULL, 2, 2, 101789, '2025-05-21', '2025-05-21 12:05:55', '2025-05-21 12:05:55', NULL, 0.00, 0.00, 1),
(32, 17, NULL, 100.00, NULL, 2, 2, 136170, '2025-05-21', '2025-05-21 18:27:12', '2025-05-21 18:27:12', NULL, 0.00, 0.00, 1),
(33, 17, NULL, 2500.00, NULL, 2, 2, 136170, '2025-05-21', '2025-05-21 18:27:56', '2025-05-21 18:27:56', NULL, 0.00, 0.00, 1),
(34, 5, NULL, 600.00, NULL, 2, 2, 104682, '2025-05-21', '2025-05-21 18:44:44', '2025-05-21 18:44:44', NULL, 0.00, 0.00, 1),
(35, 5, NULL, 600.00, NULL, 2, 2, 104682, '2025-05-21', '2025-05-21 18:45:27', '2025-05-21 18:45:27', NULL, 0.00, 0.00, 1),
(36, 23, NULL, 2400.00, NULL, 2, 2, 33086, '2025-05-22', '2025-05-22 16:04:15', '2025-05-22 16:04:15', NULL, 0.00, 0.00, 1),
(37, 5, NULL, 100.00, NULL, 2, 2, 104682, '2025-05-23', '2025-05-23 00:55:44', '2025-05-23 00:55:44', NULL, 0.00, 0.00, 1),
(38, 5, NULL, 0.00, NULL, 2, 2, 104682, '2025-05-23', '2025-05-23 00:56:35', '2025-05-23 00:56:35', NULL, 0.00, 0.00, 1),
(39, 25, NULL, 900.00, NULL, 2, 2, 500, '2025-05-23', '2025-05-23 09:39:10', '2025-05-23 09:39:10', NULL, 0.00, 0.00, 1),
(40, 8, NULL, 900.00, NULL, 3, 2, 58900, '2025-05-23', '2025-05-23 11:09:13', '2025-05-23 11:09:13', NULL, 0.00, 0.00, 1),
(41, 5, NULL, 12000.00, NULL, 2, 2, 104682, '2025-05-23', '2025-05-23 16:07:26', '2025-05-23 16:07:26', NULL, 0.00, 0.00, 1),
(42, 15, NULL, 600.00, NULL, 3, 2, 19880, '2025-05-23', '2025-05-23 21:06:55', '2025-05-23 21:06:55', NULL, 0.00, 0.00, 1),
(43, 15, NULL, 900.00, NULL, 3, 2, 19880, '2025-05-23', '2025-05-23 21:09:02', '2025-05-23 21:09:02', NULL, 0.00, 0.00, 1),
(44, 15, NULL, 900.00, NULL, 3, 2, 19880, '2025-05-23', '2025-05-23 21:09:55', '2025-05-23 21:09:55', NULL, 0.00, 0.00, 1),
(45, 15, NULL, 900.00, NULL, 3, 2, 19880, '2025-05-23', '2025-05-23 21:10:24', '2025-05-23 21:10:24', NULL, 0.00, 0.00, 1),
(46, 15, NULL, 900.00, NULL, 1, 2, 19880, '2025-05-26', '2025-05-26 15:33:54', '2025-05-26 15:33:54', NULL, 0.00, 0.00, 1),
(47, 15, NULL, 2400.00, NULL, 1, 2, 19880, '2025-05-27', '2025-05-27 01:06:29', '2025-05-27 01:06:29', NULL, 0.00, 0.00, 1),
(48, 15, NULL, 1800.00, NULL, 1, 2, 77778, '2025-05-27', '2025-05-27 13:41:13', '2025-05-27 13:41:13', NULL, 0.00, 0.00, 1),
(49, 15, NULL, 900.00, NULL, 1, 2, 77778, '2025-05-27', '2025-05-27 13:41:52', '2025-05-27 13:41:52', NULL, 0.00, 0.00, 1),
(50, 15, NULL, 900.00, NULL, 3, 2, 88888, '2025-05-27', '2025-05-27 18:30:39', '2025-05-27 18:30:39', NULL, 0.00, 0.00, 1),
(51, 15, NULL, 900.00, NULL, 3, 2, 88888, '2025-05-27', '2025-05-27 18:31:24', '2025-05-27 18:31:24', NULL, 0.00, 0.00, 1),
(52, 15, NULL, 900.00, NULL, 3, 2, 88888, '2025-05-27', '2025-05-27 18:32:20', '2025-05-27 18:32:20', NULL, 0.00, 0.00, 1),
(53, 15, NULL, 900.00, NULL, 3, 2, 88888, '2025-05-27', '2025-05-27 18:33:02', '2025-05-27 18:33:02', NULL, 0.00, 0.00, 1),
(54, 15, NULL, 1200.00, NULL, 3, 2, 88888, '2025-05-27', '2025-05-27 18:37:17', '2025-05-27 18:37:17', NULL, 0.00, 0.00, 1),
(55, 15, NULL, 900.00, NULL, 1, 2, 88888, '2025-05-27', '2025-05-27 18:40:30', '2025-05-27 18:40:30', NULL, 0.00, 0.00, 1),
(56, 15, NULL, 900.00, NULL, 1, 2, 88888, '2025-05-27', '2025-05-27 18:40:58', '2025-05-27 18:40:58', NULL, 0.00, 0.00, 1),
(57, 15, NULL, 900.00, NULL, 1, 2, 88888, '2025-05-27', '2025-05-27 18:41:33', '2025-05-27 18:41:33', NULL, 0.00, 0.00, 1),
(58, 15, NULL, 900.00, NULL, 1, 2, 88888, '2025-05-27', '2025-05-27 18:42:55', '2025-05-27 18:42:55', NULL, 0.00, 0.00, 1),
(59, 15, NULL, 900.00, NULL, 1, 2, 88888, '2025-05-27', '2025-05-27 18:44:21', '2025-05-27 18:44:21', NULL, 0.00, 0.00, 1),
(60, 15, NULL, 900.00, NULL, 1, 2, 88888, '2025-05-27', '2025-05-27 18:45:26', '2025-05-27 18:45:26', NULL, 0.00, 0.00, 1),
(61, 23, NULL, 2400.00, NULL, 1, 2, 33086, '2025-05-27', '2025-05-27 18:45:59', '2025-05-27 18:45:59', NULL, 0.00, 0.00, 1),
(62, 5, NULL, 3.00, NULL, 1, 2, 104682, '2025-05-27', '2025-05-27 18:50:36', '2025-05-27 18:50:36', NULL, 0.00, 0.00, 1),
(63, 5, NULL, 3.00, NULL, 1, 2, 104682, '2025-05-27', '2025-05-27 18:51:05', '2025-05-27 18:51:05', NULL, 0.00, 0.00, 1),
(64, 5, NULL, 2.00, NULL, 1, 2, 104682, '2025-05-27', '2025-05-27 18:52:47', '2025-05-27 18:52:47', NULL, 0.00, 0.00, 1),
(65, 5, NULL, 6.00, NULL, 1, 2, 104682, '2025-05-27', '2025-05-27 18:53:21', '2025-05-27 18:53:21', NULL, 0.00, 0.00, 1),
(66, 5, NULL, 6.00, NULL, 1, 2, 104682, '2025-05-27', '2025-05-27 18:53:37', '2025-05-27 18:53:37', NULL, 0.00, 0.00, 1),
(67, 15, NULL, 1200.00, NULL, 3, 2, 88888, '2025-05-27', '2025-05-27 20:00:32', '2025-05-27 20:00:32', NULL, 0.00, 0.00, 1),
(68, 15, NULL, 1200.00, NULL, 1, 2, 88888, '2025-05-27', '2025-05-27 20:08:58', '2025-05-27 20:08:58', NULL, 0.00, 0.00, 1),
(69, 15, NULL, 3000.00, NULL, 1, 2, 88888, '2025-05-30', '2025-05-30 10:37:20', '2025-05-30 10:37:20', NULL, 0.00, 0.00, 1),
(70, 15, NULL, 900.00, NULL, 1, 2, 88888, '2025-05-30', '2025-05-30 10:38:54', '2025-05-30 10:38:54', NULL, 0.00, 0.00, 1),
(71, 15, NULL, 3300.00, NULL, 1, 2, 88888, '2025-05-31', '2025-05-31 19:15:06', '2025-05-31 19:15:06', NULL, 0.00, 0.00, 1),
(72, 15, NULL, 1200.00, NULL, 1, 2, 88888, '2025-05-31', '2025-05-31 19:16:28', '2025-05-31 19:16:28', NULL, 0.00, 0.00, 1),
(73, 15, NULL, 1800.00, NULL, 1, 2, 88888, '2025-05-31', '2025-05-31 19:17:16', '2025-05-31 19:17:16', NULL, 0.00, 0.00, 1),
(74, 15, NULL, 600.00, NULL, 1, 2, 88888, '2025-05-31', '2025-05-31 19:18:23', '2025-05-31 19:18:23', NULL, 0.00, 0.00, 1),
(75, 19, NULL, 1200.00, NULL, 1, 2, 75864, '2025-05-31', '2025-05-31 19:18:41', '2025-05-31 19:18:41', NULL, 0.00, 0.00, 1),
(76, 19, NULL, 2400.00, NULL, 1, 2, 75864, '2025-05-31', '2025-05-31 19:19:30', '2025-05-31 19:19:30', NULL, 0.00, 0.00, 1),
(77, 19, NULL, 1800.00, NULL, 1, 2, 75864, '2025-05-31', '2025-05-31 19:26:39', '2025-05-31 19:26:39', NULL, 0.00, 0.00, 1),
(78, 16, NULL, 5200.00, NULL, 1, 0, 59302, '2025-06-01', '2025-06-01 15:44:27', '2025-06-01 15:44:27', NULL, 0.00, 0.00, NULL),
(79, 16, NULL, 5200.00, NULL, 1, 0, 59302, '2025-06-01', '2025-06-01 16:17:42', '2025-06-01 16:17:42', NULL, 0.00, 0.00, NULL),
(80, 16, NULL, 8400.00, NULL, 1, 0, 59302, '2025-06-01', '2025-06-01 18:46:52', '2025-06-01 18:46:52', NULL, 0.00, 0.00, NULL),
(81, 8, NULL, 5100.00, NULL, 1, 0, 58900, '2025-06-01', '2025-06-01 19:05:10', '2025-06-01 19:05:10', NULL, 0.00, 0.00, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `income_cat`
--

DROP TABLE IF EXISTS `income_cat`;
CREATE TABLE IF NOT EXISTS `income_cat` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` varchar(5) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `income_cat_name_type_index` (`name`,`type`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `income_cat`
--

INSERT INTO `income_cat` (`id`, `name`, `user_id`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Booking', 1, 'd', '2021-11-20 07:03:54', '2021-11-20 07:03:54', NULL),
(2, 'Contrats', 1, 'u', '2025-05-23 09:31:14', '2025-05-23 09:31:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mechanics`
--

DROP TABLE IF EXISTS `mechanics`;
CREATE TABLE IF NOT EXISTS `mechanics` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `mechanics`
--

INSERT INTO `mechanics` (`id`, `user_id`, `name`, `email`, `contact_number`, `category`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Tracy Lakin', 'connelly.mckenna@example.com', '1-350-561-3982 x177', 'Electrical Engineering', NULL, '2021-11-20 07:04:11', '2021-11-20 07:04:11'),
(2, 1, 'Theresa Toy', 'chris.haley@example.net', '734-670-6060', 'Electrical Engineering', NULL, '2021-11-20 07:04:12', '2021-11-20 07:04:12');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fcm_id` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `from_user` int(10) UNSIGNED DEFAULT NULL,
  `to_user` int(10) UNSIGNED DEFAULT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `from_user` (`from_user`),
  KEY `to_user` (`to_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(2, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(3, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(4, '2016_06_01_000004_create_oauth_clients_table', 1),
(5, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(6, '2017_06_03_134331_create_expense_table', 1),
(7, '2017_06_03_134332_create_expense_cat_table', 1),
(8, '2017_06_03_134332_create_income_table', 1),
(9, '2017_06_03_134333_create_income_cat_table', 1),
(10, '2017_06_03_134336_create_password_resets_table', 1),
(11, '2017_06_03_134337_create_users_table', 1),
(12, '2017_06_03_134338_create_vehicles_table', 1),
(13, '2017_07_24_080537_create_booking_table', 1),
(14, '2017_07_24_080643_create_settings_table', 1),
(15, '2017_08_01_073926_create_booking_income_table', 1),
(16, '2017_10_30_064357_create_notifications_table', 1),
(17, '2017_10_30_094858_create_fuel_table', 1),
(18, '2017_11_09_105729_create_vendors_table', 1),
(19, '2017_11_10_062609_create_work_orders_table', 1),
(20, '2017_11_10_095438_create_notes_table', 1),
(21, '2017_11_22_093559_create_vehicle_group_table', 1),
(22, '2017_12_28_091600_create_service_items_table', 1),
(23, '2017_12_28_122952_create_service_reminder_table', 1),
(24, '2017_12_28_174333_create_api_settings_table', 1),
(25, '2018_01_08_062105_create_driver_vehicle_table', 1),
(26, '2018_01_10_130517_users_meta', 1),
(27, '2018_01_13_050018_bookings_meta', 1),
(28, '2018_01_16_095657_fare_settings', 1),
(29, '2018_01_25_050939_create_vehicles_meta_table', 1),
(30, '2018_02_06_052302_create_message_table', 1),
(31, '2018_02_06_125252_create_reviews_table', 1),
(32, '2018_03_13_124424_create_addresses_table', 1),
(33, '2018_03_28_085735_create_reasons_table', 1),
(34, '2018_04_28_073004_create_email_content_table', 1),
(35, '2018_08_14_061757_create_vehicle_review_table', 1),
(36, '2019_01_18_063916_add_vendor_id_to_expense', 1),
(37, '2019_01_19_080738_add_udf_to_vendors', 1),
(38, '2019_01_19_103826_create_parts_table', 1),
(39, '2019_01_19_110823_create_vehicle_types_table', 1),
(40, '2019_01_22_101948_create_driver_logs_table', 1),
(41, '2019_01_23_113852_add_type_id_to_vehicles_table', 1),
(42, '2019_01_24_095115_add_type_id_to_fare_settings_table', 1),
(43, '2019_04_12_092111_create_parts_category_table', 1),
(44, '2019_04_19_053314_create_work_order_logs_table', 1),
(45, '2019_05_13_062039_create_push_notification_table', 1),
(46, '2019_07_18_110031_add_column_to_vendors', 1),
(47, '2019_07_31_082514_create_testimonials_table', 1),
(48, '2019_07_31_102801_create_frontend_table', 1),
(49, '2019_08_01_045837_add_columns_to_message_table', 1),
(50, '2019_08_19_101509_create_booking_quotation_table', 1),
(51, '2019_08_22_052138_create_parts_used_table', 1),
(52, '2019_08_22_113138_add_parts_price_to_work_order_logs_table', 1),
(53, '2019_08_29_104613_create_company_services_table', 1),
(54, '2019_09_16_085700_create_teams_table', 1),
(55, '2019_12_10_083547_add_columns_to_booking_quotation_table', 1),
(56, '2019_12_16_064152_add_indexes_to_users_table', 1),
(57, '2019_12_16_064951_add_indexes_to_addresses_table', 1),
(58, '2019_12_16_065511_add_indexes_to_bookings_table', 1),
(59, '2019_12_16_083315_add_indexes_to_booking_income_table', 1),
(60, '2019_12_16_084539_add_indexes_to_booking_quotation_table', 1),
(61, '2019_12_16_085312_add_indexes_to_driver_logs_table', 1),
(62, '2019_12_16_085505_add_indexes_to_driver_vehicle_table', 1),
(63, '2019_12_16_091010_add_indexes_to_email_content_table', 1),
(64, '2019_12_16_091713_add_indexes_to_expense_table', 1),
(65, '2019_12_16_094305_add_indexes_to_expense_cat_table', 1),
(66, '2019_12_16_094651_add_indexes_to_fare_settings_table', 1),
(67, '2019_12_16_095024_add_indexes_to_frontend_table', 1),
(68, '2019_12_16_095339_add_indexes_to_fuel_table', 1),
(69, '2019_12_16_095634_add_indexes_to_income_table', 1),
(70, '2019_12_16_095953_add_indexes_to_income_cat_table', 1),
(71, '2019_12_16_100221_add_indexes_to_notes_table', 1),
(72, '2019_12_16_100437_add_indexes_to_notifications_table', 1),
(73, '2019_12_16_100545_add_indexes_to_parts_table', 1),
(74, '2019_12_16_101113_add_indexes_to_parts_used_table', 1),
(75, '2019_12_16_101540_add_indexes_to_push_notification_table', 1),
(76, '2019_12_16_101851_add_indexes_to_reviews_table', 1),
(77, '2019_12_16_102259_add_indexes_to_service_reminder_table', 1),
(78, '2019_12_16_102555_add_indexes_to_vehicles_table', 1),
(79, '2019_12_16_104209_add_indexes_to_vehicle_review_table', 1),
(80, '2019_12_16_104440_add_indexes_to_vendors_table', 1),
(81, '2019_12_16_104704_add_indexes_to_work_orders_table', 1),
(82, '2019_12_16_105013_add_indexes_to_work_order_logs_table', 1),
(83, '2019_12_16_115309_add_indexes_to_api_settings_table', 1),
(84, '2019_12_17_080649_add_taxes_to_income_table', 1),
(85, '2019_12_19_052248_create_payment_settings_table', 1),
(86, '2019_12_19_063520_create_booking_payments_table', 1),
(87, '2021_01_04_113449_create_twilio_settings_table', 1),
(88, '2021_06_29_052236_add_udf_field_to_vehicle_review_table', 1),
(89, '2021_06_29_115538_create_mechanics_table', 1),
(90, '2021_07_02_051340_create_permission_tables', 1),
(91, '2021_07_02_052117_add_mechanic_work_order_table', 1),
(92, '2021_07_02_055514_add_mechanic_work_order_log_table', 1),
(93, '2021_07_22_071412_create_push_subscriptions_table', 1),
(94, '2021_07_22_113433_add_provider_to_oauth_clients_table', 1),
(95, '2021_08_27_121756_add_user_id_to_mechanics_table', 1),
(96, '2021_08_27_121856_add_user_id_to_parts_category_table', 1),
(97, '2021_08_27_121941_add_user_id_to_service_items_table', 1),
(98, '2021_08_27_122008_add_user_id_to_service_reminder_table', 1),
(99, '2021_08_27_122045_add_user_id_to_vehicle_group_table', 1),
(100, '2021_08_27_122127_add_user_id_to_vendors_table', 1),
(101, '2021_08_27_122155_add_user_id_to_work_orders_table', 1),
(102, '2021_08_27_122217_add_user_id_to_work_order_logs_table', 1),
(103, '2021_08_27_122259_add_user_id_to_notes_table', 1),
(104, '2021_09_07_070458_add_user_id_to_users_table', 1),
(105, '2021_08_07_063711_create_messages_table', 1),
(106, '2022_01_17_065748_create_chat_settings_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(9, 'App\\Model\\User', 6),
(9, 'App\\Model\\User', 7),
(9, 'App\\Model\\User', 8),
(41, 'App\\Model\\User', 6),
(41, 'App\\Model\\User', 7),
(41, 'App\\Model\\User', 8),
(66, 'App\\Model\\User', 6),
(66, 'App\\Model\\User', 7),
(66, 'App\\Model\\User', 8),
(67, 'App\\Model\\User', 6),
(67, 'App\\Model\\User', 7),
(67, 'App\\Model\\User', 8),
(68, 'App\\Model\\User', 6),
(68, 'App\\Model\\User', 7),
(68, 'App\\Model\\User', 8),
(69, 'App\\Model\\User', 6),
(69, 'App\\Model\\User', 7),
(69, 'App\\Model\\User', 8),
(71, 'App\\Model\\User', 4),
(71, 'App\\Model\\User', 5),
(71, 'App\\Model\\User', 9),
(71, 'App\\Model\\User', 10),
(71, 'App\\Model\\User', 11),
(71, 'App\\Model\\User', 12),
(71, 'App\\Model\\User', 13),
(71, 'App\\Model\\User', 14),
(71, 'App\\Model\\User', 25),
(71, 'App\\Model\\User', 26),
(71, 'App\\Model\\User', 27),
(71, 'App\\Model\\User', 28),
(71, 'App\\Model\\User', 29),
(71, 'App\\Model\\User', 31),
(71, 'App\\Model\\User', 32),
(71, 'App\\Model\\User', 33),
(71, 'App\\Model\\User', 34),
(71, 'App\\Model\\User', 35),
(71, 'App\\Model\\User', 36),
(71, 'App\\Model\\User', 37),
(71, 'App\\Model\\User', 38),
(71, 'App\\Model\\User', 39),
(71, 'App\\Model\\User', 40),
(71, 'App\\Model\\User', 41),
(71, 'App\\Model\\User', 42),
(71, 'App\\Model\\User', 43),
(71, 'App\\Model\\User', 44),
(71, 'App\\Model\\User', 45),
(71, 'App\\Model\\User', 46),
(71, 'App\\Model\\User', 47),
(71, 'App\\Model\\User', 48),
(71, 'App\\Model\\User', 49),
(71, 'App\\Model\\User', 50),
(71, 'App\\Model\\User', 51),
(71, 'App\\Model\\User', 52),
(71, 'App\\Model\\User', 53),
(71, 'App\\Model\\User', 54),
(71, 'App\\Model\\User', 55),
(71, 'App\\Model\\User', 56),
(71, 'App\\Model\\User', 57),
(71, 'App\\Model\\User', 58),
(71, 'App\\Model\\User', 59),
(71, 'App\\Model\\User', 60),
(71, 'App\\Model\\User', 61),
(71, 'App\\Model\\User', 62),
(71, 'App\\Model\\User', 63),
(71, 'App\\Model\\User', 64),
(71, 'App\\Model\\User', 65),
(71, 'App\\Model\\User', 66),
(71, 'App\\Model\\User', 67),
(71, 'App\\Model\\User', 68),
(71, 'App\\Model\\User', 69),
(71, 'App\\Model\\User', 70),
(71, 'App\\Model\\User', 71),
(71, 'App\\Model\\User', 72),
(71, 'App\\Model\\User', 73),
(71, 'App\\Model\\User', 74),
(71, 'App\\Model\\User', 75),
(71, 'App\\Model\\User', 76),
(71, 'App\\Model\\User', 77),
(71, 'App\\Model\\User', 78),
(71, 'App\\Model\\User', 79),
(71, 'App\\Model\\User', 80),
(71, 'App\\Model\\User', 81),
(71, 'App\\Model\\User', 82),
(71, 'App\\Model\\User', 83),
(71, 'App\\Model\\User', 84),
(71, 'App\\Model\\User', 85),
(71, 'App\\Model\\User', 86),
(71, 'App\\Model\\User', 87),
(71, 'App\\Model\\User', 88),
(71, 'App\\Model\\User', 89),
(71, 'App\\Model\\User', 90),
(71, 'App\\Model\\User', 91),
(71, 'App\\Model\\User', 92),
(72, 'App\\Model\\User', 4),
(72, 'App\\Model\\User', 5),
(72, 'App\\Model\\User', 9),
(72, 'App\\Model\\User', 10),
(72, 'App\\Model\\User', 11),
(72, 'App\\Model\\User', 12),
(72, 'App\\Model\\User', 13),
(72, 'App\\Model\\User', 14),
(72, 'App\\Model\\User', 25),
(72, 'App\\Model\\User', 26),
(72, 'App\\Model\\User', 27),
(72, 'App\\Model\\User', 28),
(72, 'App\\Model\\User', 29),
(72, 'App\\Model\\User', 31),
(72, 'App\\Model\\User', 32),
(72, 'App\\Model\\User', 33),
(72, 'App\\Model\\User', 34),
(72, 'App\\Model\\User', 35),
(72, 'App\\Model\\User', 36),
(72, 'App\\Model\\User', 37),
(72, 'App\\Model\\User', 38),
(72, 'App\\Model\\User', 39),
(72, 'App\\Model\\User', 40),
(72, 'App\\Model\\User', 41),
(72, 'App\\Model\\User', 42),
(72, 'App\\Model\\User', 43),
(72, 'App\\Model\\User', 44),
(72, 'App\\Model\\User', 45),
(72, 'App\\Model\\User', 46),
(72, 'App\\Model\\User', 47),
(72, 'App\\Model\\User', 48),
(72, 'App\\Model\\User', 49),
(72, 'App\\Model\\User', 50),
(72, 'App\\Model\\User', 51),
(72, 'App\\Model\\User', 52),
(72, 'App\\Model\\User', 53),
(72, 'App\\Model\\User', 54),
(72, 'App\\Model\\User', 55),
(72, 'App\\Model\\User', 56),
(72, 'App\\Model\\User', 57),
(72, 'App\\Model\\User', 58),
(72, 'App\\Model\\User', 59),
(72, 'App\\Model\\User', 60),
(72, 'App\\Model\\User', 61),
(72, 'App\\Model\\User', 62),
(72, 'App\\Model\\User', 63),
(72, 'App\\Model\\User', 64),
(72, 'App\\Model\\User', 65),
(72, 'App\\Model\\User', 66),
(72, 'App\\Model\\User', 67),
(72, 'App\\Model\\User', 68),
(72, 'App\\Model\\User', 69),
(72, 'App\\Model\\User', 70),
(72, 'App\\Model\\User', 71),
(72, 'App\\Model\\User', 72),
(72, 'App\\Model\\User', 73),
(72, 'App\\Model\\User', 74),
(72, 'App\\Model\\User', 75),
(72, 'App\\Model\\User', 76),
(72, 'App\\Model\\User', 77),
(72, 'App\\Model\\User', 78),
(72, 'App\\Model\\User', 79),
(72, 'App\\Model\\User', 80),
(72, 'App\\Model\\User', 81),
(72, 'App\\Model\\User', 82),
(72, 'App\\Model\\User', 83),
(72, 'App\\Model\\User', 84),
(72, 'App\\Model\\User', 85),
(72, 'App\\Model\\User', 86),
(72, 'App\\Model\\User', 87),
(72, 'App\\Model\\User', 88),
(72, 'App\\Model\\User', 89),
(72, 'App\\Model\\User', 90),
(72, 'App\\Model\\User', 91),
(72, 'App\\Model\\User', 92),
(73, 'App\\Model\\User', 4),
(73, 'App\\Model\\User', 5),
(73, 'App\\Model\\User', 9),
(73, 'App\\Model\\User', 10),
(73, 'App\\Model\\User', 11),
(73, 'App\\Model\\User', 12),
(73, 'App\\Model\\User', 13),
(73, 'App\\Model\\User', 14),
(73, 'App\\Model\\User', 25),
(73, 'App\\Model\\User', 26),
(73, 'App\\Model\\User', 27),
(73, 'App\\Model\\User', 28),
(73, 'App\\Model\\User', 29),
(73, 'App\\Model\\User', 31),
(73, 'App\\Model\\User', 32),
(73, 'App\\Model\\User', 33),
(73, 'App\\Model\\User', 34),
(73, 'App\\Model\\User', 35),
(73, 'App\\Model\\User', 36),
(73, 'App\\Model\\User', 37),
(73, 'App\\Model\\User', 38),
(73, 'App\\Model\\User', 39),
(73, 'App\\Model\\User', 40),
(73, 'App\\Model\\User', 41),
(73, 'App\\Model\\User', 42),
(73, 'App\\Model\\User', 43),
(73, 'App\\Model\\User', 44),
(73, 'App\\Model\\User', 45),
(73, 'App\\Model\\User', 46),
(73, 'App\\Model\\User', 47),
(73, 'App\\Model\\User', 48),
(73, 'App\\Model\\User', 49),
(73, 'App\\Model\\User', 50),
(73, 'App\\Model\\User', 51),
(73, 'App\\Model\\User', 52),
(73, 'App\\Model\\User', 53),
(73, 'App\\Model\\User', 54),
(73, 'App\\Model\\User', 55),
(73, 'App\\Model\\User', 56),
(73, 'App\\Model\\User', 57),
(73, 'App\\Model\\User', 58),
(73, 'App\\Model\\User', 59),
(73, 'App\\Model\\User', 60),
(73, 'App\\Model\\User', 61),
(73, 'App\\Model\\User', 62),
(73, 'App\\Model\\User', 63),
(73, 'App\\Model\\User', 64),
(73, 'App\\Model\\User', 65),
(73, 'App\\Model\\User', 66),
(73, 'App\\Model\\User', 67),
(73, 'App\\Model\\User', 68),
(73, 'App\\Model\\User', 69),
(73, 'App\\Model\\User', 70),
(73, 'App\\Model\\User', 71),
(73, 'App\\Model\\User', 72),
(73, 'App\\Model\\User', 73),
(73, 'App\\Model\\User', 74),
(73, 'App\\Model\\User', 75),
(73, 'App\\Model\\User', 76),
(73, 'App\\Model\\User', 77),
(73, 'App\\Model\\User', 78),
(73, 'App\\Model\\User', 79),
(73, 'App\\Model\\User', 80),
(73, 'App\\Model\\User', 81),
(73, 'App\\Model\\User', 82),
(73, 'App\\Model\\User', 83),
(73, 'App\\Model\\User', 84),
(73, 'App\\Model\\User', 85),
(73, 'App\\Model\\User', 86),
(73, 'App\\Model\\User', 87),
(73, 'App\\Model\\User', 88),
(73, 'App\\Model\\User', 89),
(73, 'App\\Model\\User', 90),
(73, 'App\\Model\\User', 91),
(73, 'App\\Model\\User', 92),
(74, 'App\\Model\\User', 4),
(74, 'App\\Model\\User', 5),
(74, 'App\\Model\\User', 9),
(74, 'App\\Model\\User', 10),
(74, 'App\\Model\\User', 11),
(74, 'App\\Model\\User', 12),
(74, 'App\\Model\\User', 13),
(74, 'App\\Model\\User', 14),
(74, 'App\\Model\\User', 25),
(74, 'App\\Model\\User', 26),
(74, 'App\\Model\\User', 27),
(74, 'App\\Model\\User', 28),
(74, 'App\\Model\\User', 29),
(74, 'App\\Model\\User', 31),
(74, 'App\\Model\\User', 32),
(74, 'App\\Model\\User', 33),
(74, 'App\\Model\\User', 34),
(74, 'App\\Model\\User', 35),
(74, 'App\\Model\\User', 36),
(74, 'App\\Model\\User', 37),
(74, 'App\\Model\\User', 38),
(74, 'App\\Model\\User', 39),
(74, 'App\\Model\\User', 40),
(74, 'App\\Model\\User', 41),
(74, 'App\\Model\\User', 42),
(74, 'App\\Model\\User', 43),
(74, 'App\\Model\\User', 44),
(74, 'App\\Model\\User', 45),
(74, 'App\\Model\\User', 46),
(74, 'App\\Model\\User', 47),
(74, 'App\\Model\\User', 48),
(74, 'App\\Model\\User', 49),
(74, 'App\\Model\\User', 50),
(74, 'App\\Model\\User', 51),
(74, 'App\\Model\\User', 52),
(74, 'App\\Model\\User', 53),
(74, 'App\\Model\\User', 54),
(74, 'App\\Model\\User', 55),
(74, 'App\\Model\\User', 56),
(74, 'App\\Model\\User', 57),
(74, 'App\\Model\\User', 58),
(74, 'App\\Model\\User', 59),
(74, 'App\\Model\\User', 60),
(74, 'App\\Model\\User', 61),
(74, 'App\\Model\\User', 62),
(74, 'App\\Model\\User', 63),
(74, 'App\\Model\\User', 64),
(74, 'App\\Model\\User', 65),
(74, 'App\\Model\\User', 66),
(74, 'App\\Model\\User', 67),
(74, 'App\\Model\\User', 68),
(74, 'App\\Model\\User', 69),
(74, 'App\\Model\\User', 70),
(74, 'App\\Model\\User', 71),
(74, 'App\\Model\\User', 72),
(74, 'App\\Model\\User', 73),
(74, 'App\\Model\\User', 74),
(74, 'App\\Model\\User', 75),
(74, 'App\\Model\\User', 76),
(74, 'App\\Model\\User', 77),
(74, 'App\\Model\\User', 78),
(74, 'App\\Model\\User', 79),
(74, 'App\\Model\\User', 80),
(74, 'App\\Model\\User', 81),
(74, 'App\\Model\\User', 82),
(74, 'App\\Model\\User', 83),
(74, 'App\\Model\\User', 84),
(74, 'App\\Model\\User', 85),
(74, 'App\\Model\\User', 86),
(74, 'App\\Model\\User', 87),
(74, 'App\\Model\\User', 88),
(74, 'App\\Model\\User', 89),
(74, 'App\\Model\\User', 90),
(74, 'App\\Model\\User', 91),
(74, 'App\\Model\\User', 92),
(81, 'App\\Model\\User', 6),
(81, 'App\\Model\\User', 7),
(81, 'App\\Model\\User', 8),
(82, 'App\\Model\\User', 6),
(82, 'App\\Model\\User', 7),
(82, 'App\\Model\\User', 8),
(83, 'App\\Model\\User', 6),
(83, 'App\\Model\\User', 7),
(83, 'App\\Model\\User', 8),
(84, 'App\\Model\\User', 6),
(84, 'App\\Model\\User', 7),
(84, 'App\\Model\\User', 8),
(101, 'App\\Model\\User', 6),
(101, 'App\\Model\\User', 7),
(101, 'App\\Model\\User', 8),
(102, 'App\\Model\\User', 6),
(102, 'App\\Model\\User', 7),
(102, 'App\\Model\\User', 8),
(103, 'App\\Model\\User', 6),
(103, 'App\\Model\\User', 7),
(103, 'App\\Model\\User', 8),
(104, 'App\\Model\\User', 6),
(104, 'App\\Model\\User', 7),
(104, 'App\\Model\\User', 8);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Model\\User', 1),
(2, 'App\\Model\\User', 2),
(2, 'App\\Model\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
CREATE TABLE IF NOT EXISTS `notes` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `submitted_on` date DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notes_vehicle_id_customer_id_index` (`vehicle_id`,`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`),
  KEY `notifications_type_index` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE IF NOT EXISTS `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE IF NOT EXISTS `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) NOT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Fleet Manager Personal Access Client', 'RSgOa49VlbquB3GxT1WAO2jReLCnHoWndPfyrJ4p', NULL, 'http://localhost', 1, 0, 0, '2021-11-20 07:03:53', '2021-11-20 07:03:53'),
(2, NULL, 'Fleet Manager Password Grant Client', 'sX7qzt55VQ5pGjl4gkxyycwKz9yE6ngT4EoPEtRH', 'users', 'http://localhost', 0, 1, 0, '2021-11-20 07:03:53', '2021-11-20 07:03:53');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE IF NOT EXISTS `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2021-11-20 07:03:53', '2021-11-20 07:03:53');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

DROP TABLE IF EXISTS `parts`;
CREATE TABLE IF NOT EXISTS `parts` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `availability` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `unit_cost` int(11) DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `manufacturer` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `udf` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parts_category_id_user_id_availability_index` (`category_id`,`user_id`,`availability`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parts_category`
--

DROP TABLE IF EXISTS `parts_category`;
CREATE TABLE IF NOT EXISTS `parts_category` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `parts_category`
--

INSERT INTO `parts_category` (`id`, `user_id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Engine Parts', '2021-11-20 07:03:50', '2021-11-20 07:03:50', NULL),
(2, 1, 'Electricals', '2021-11-20 07:03:50', '2021-11-20 07:03:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `parts_used`
--

DROP TABLE IF EXISTS `parts_used`;
CREATE TABLE IF NOT EXISTS `parts_used` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `part_id` int(11) DEFAULT NULL,
  `work_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parts_used_part_id_work_id_index` (`part_id`,`work_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('marrakech@jeunesscar.com', '$2y$12$yRstRR5NI/pTWhER2AEm1.vxvFxiff1oTnx4NNlnvkFus.on75.2O', '2025-05-13 17:05:03');

-- --------------------------------------------------------

--
-- Table structure for table `payment_settings`
--

DROP TABLE IF EXISTS `payment_settings`;
CREATE TABLE IF NOT EXISTS `payment_settings` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `payment_settings_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `payment_settings`
--

INSERT INTO `payment_settings` (`id`, `name`, `value`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'method', '[\"cash\"]', '2021-11-20 07:04:09', '2021-11-20 07:04:09', NULL),
(2, 'currency_code', 'INR', '2021-11-20 07:04:10', '2021-11-20 07:04:10', NULL),
(3, 'stripe_publishable_key', '', '2021-11-20 07:04:10', '2021-11-20 07:04:10', NULL),
(4, 'stripe_secret_key', '', '2021-11-20 07:04:10', '2021-11-20 07:04:10', NULL),
(5, 'razorpay_key', '', '2021-11-20 07:04:10', '2021-11-20 07:04:10', NULL),
(6, 'razorpay_secret', '', '2021-11-20 07:04:10', '2021-11-20 07:04:10', NULL),
(7, 'paystack_secret', '', '2021-11-20 07:04:10', '2021-11-20 07:04:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Users add', 'web', '2021-11-20 07:04:15', '2021-11-20 07:04:15'),
(2, 'Users edit', 'web', '2021-11-20 07:04:15', '2021-11-20 07:04:15'),
(3, 'Users delete', 'web', '2021-11-20 07:04:15', '2021-11-20 07:04:15'),
(4, 'Users list', 'web', '2021-11-20 07:04:15', '2021-11-20 07:04:15'),
(5, 'Users import', 'web', '2021-11-20 07:04:15', '2021-11-20 07:04:15'),
(6, 'Drivers add', 'web', '2021-11-20 07:04:15', '2021-11-20 07:04:15'),
(7, 'Drivers edit', 'web', '2021-11-20 07:04:15', '2021-11-20 07:04:15'),
(8, 'Drivers delete', 'web', '2021-11-20 07:04:15', '2021-11-20 07:04:15'),
(9, 'Drivers list', 'web', '2021-11-20 07:04:15', '2021-11-20 07:04:15'),
(10, 'Drivers import', 'web', '2021-11-20 07:04:15', '2021-11-20 07:04:15'),
(11, 'Customer add', 'web', '2021-11-20 07:04:15', '2021-11-20 07:04:15'),
(12, 'Customer edit', 'web', '2021-11-20 07:04:16', '2021-11-20 07:04:16'),
(13, 'Customer delete', 'web', '2021-11-20 07:04:16', '2021-11-20 07:04:16'),
(14, 'Customer list', 'web', '2021-11-20 07:04:16', '2021-11-20 07:04:16'),
(15, 'Customer import', 'web', '2021-11-20 07:04:16', '2021-11-20 07:04:16'),
(16, 'VehicleType add', 'web', '2021-11-20 07:04:16', '2021-11-20 07:04:16'),
(17, 'VehicleType edit', 'web', '2021-11-20 07:04:16', '2021-11-20 07:04:16'),
(18, 'VehicleType delete', 'web', '2021-11-20 07:04:16', '2021-11-20 07:04:16'),
(19, 'VehicleType list', 'web', '2021-11-20 07:04:16', '2021-11-20 07:04:16'),
(20, 'VehicleType import', 'web', '2021-11-20 07:04:16', '2021-11-20 07:04:16'),
(21, 'VehicleMaker add', 'web', '2021-11-20 07:04:16', '2021-11-20 07:04:16'),
(22, 'VehicleMaker edit', 'web', '2021-11-20 07:04:16', '2021-11-20 07:04:16'),
(23, 'VehicleMaker delete', 'web', '2021-11-20 07:04:16', '2021-11-20 07:04:16'),
(24, 'VehicleMaker list', 'web', '2021-11-20 07:04:17', '2021-11-20 07:04:17'),
(25, 'VehicleMaker import', 'web', '2021-11-20 07:04:17', '2021-11-20 07:04:17'),
(26, 'VehicleModels add', 'web', '2021-11-20 07:04:17', '2021-11-20 07:04:17'),
(27, 'VehicleModels edit', 'web', '2021-11-20 07:04:17', '2021-11-20 07:04:17'),
(28, 'VehicleModels delete', 'web', '2021-11-20 07:04:17', '2021-11-20 07:04:17'),
(29, 'VehicleModels list', 'web', '2021-11-20 07:04:17', '2021-11-20 07:04:17'),
(30, 'VehicleModels import', 'web', '2021-11-20 07:04:17', '2021-11-20 07:04:17'),
(31, 'VehicleColors add', 'web', '2021-11-20 07:04:17', '2021-11-20 07:04:17'),
(32, 'VehicleColors edit', 'web', '2021-11-20 07:04:17', '2021-11-20 07:04:17'),
(33, 'VehicleColors delete', 'web', '2021-11-20 07:04:17', '2021-11-20 07:04:17'),
(34, 'VehicleColors list', 'web', '2021-11-20 07:04:17', '2021-11-20 07:04:17'),
(35, 'VehicleColors import', 'web', '2021-11-20 07:04:17', '2021-11-20 07:04:17'),
(36, 'VehicleGroup add', 'web', '2021-11-20 07:04:18', '2021-11-20 07:04:18'),
(37, 'VehicleGroup edit', 'web', '2021-11-20 07:04:18', '2021-11-20 07:04:18'),
(38, 'VehicleGroup delete', 'web', '2021-11-20 07:04:18', '2021-11-20 07:04:18'),
(39, 'VehicleGroup list', 'web', '2021-11-20 07:04:18', '2021-11-20 07:04:18'),
(40, 'VehicleGroup import', 'web', '2021-11-20 07:04:18', '2021-11-20 07:04:18'),
(41, 'VehicleInspection add', 'web', '2021-11-20 07:04:18', '2021-11-20 07:04:18'),
(42, 'VehicleInspection edit', 'web', '2021-11-20 07:04:18', '2021-11-20 07:04:18'),
(43, 'VehicleInspection delete', 'web', '2021-11-20 07:04:18', '2021-11-20 07:04:18'),
(44, 'VehicleInspection list', 'web', '2021-11-20 07:04:18', '2021-11-20 07:04:18'),
(45, 'VehicleInspection import', 'web', '2021-11-20 07:04:18', '2021-11-20 07:04:18'),
(46, 'BookingQuotations add', 'web', '2021-11-20 07:04:18', '2021-11-20 07:04:18'),
(47, 'BookingQuotations edit', 'web', '2021-11-20 07:04:18', '2021-11-20 07:04:18'),
(48, 'BookingQuotations delete', 'web', '2021-11-20 07:04:19', '2021-11-20 07:04:19'),
(49, 'BookingQuotations list', 'web', '2021-11-20 07:04:19', '2021-11-20 07:04:19'),
(50, 'BookingQuotations import', 'web', '2021-11-20 07:04:19', '2021-11-20 07:04:19'),
(51, 'PartsCategory add', 'web', '2021-11-20 07:04:19', '2021-11-20 07:04:19'),
(52, 'PartsCategory edit', 'web', '2021-11-20 07:04:19', '2021-11-20 07:04:19'),
(53, 'PartsCategory delete', 'web', '2021-11-20 07:04:19', '2021-11-20 07:04:19'),
(54, 'PartsCategory list', 'web', '2021-11-20 07:04:19', '2021-11-20 07:04:19'),
(55, 'PartsCategory import', 'web', '2021-11-20 07:04:19', '2021-11-20 07:04:19'),
(56, 'Mechanics add', 'web', '2021-11-20 07:04:19', '2021-11-20 07:04:19'),
(57, 'Mechanics edit', 'web', '2021-11-20 07:04:20', '2021-11-20 07:04:20'),
(58, 'Mechanics delete', 'web', '2021-11-20 07:04:20', '2021-11-20 07:04:20'),
(59, 'Mechanics list', 'web', '2021-11-20 07:04:20', '2021-11-20 07:04:20'),
(60, 'Mechanics import', 'web', '2021-11-20 07:04:20', '2021-11-20 07:04:20'),
(61, 'Vehicles add', 'web', '2021-11-20 07:04:20', '2021-11-20 07:04:20'),
(62, 'Vehicles edit', 'web', '2021-11-20 07:04:20', '2021-11-20 07:04:20'),
(63, 'Vehicles delete', 'web', '2021-11-20 07:04:20', '2021-11-20 07:04:20'),
(64, 'Vehicles list', 'web', '2021-11-20 07:04:20', '2021-11-20 07:04:20'),
(65, 'Vehicles import', 'web', '2021-11-20 07:04:20', '2021-11-20 07:04:20'),
(66, 'Transactions add', 'web', '2021-11-20 07:04:20', '2021-11-20 07:04:20'),
(67, 'Transactions edit', 'web', '2021-11-20 07:04:21', '2021-11-20 07:04:21'),
(68, 'Transactions delete', 'web', '2021-11-20 07:04:21', '2021-11-20 07:04:21'),
(69, 'Transactions list', 'web', '2021-11-20 07:04:21', '2021-11-20 07:04:21'),
(70, 'Transactions import', 'web', '2021-11-20 07:04:21', '2021-11-20 07:04:21'),
(71, 'Bookings add', 'web', '2021-11-20 07:04:21', '2021-11-20 07:04:21'),
(72, 'Bookings edit', 'web', '2021-11-20 07:04:21', '2021-11-20 07:04:21'),
(73, 'Bookings delete', 'web', '2021-11-20 07:04:21', '2021-11-20 07:04:21'),
(74, 'Bookings list', 'web', '2021-11-20 07:04:21', '2021-11-20 07:04:21'),
(75, 'Bookings import', 'web', '2021-11-20 07:04:21', '2021-11-20 07:04:21'),
(76, 'Reports add', 'web', '2021-11-20 07:04:21', '2021-11-20 07:04:21'),
(77, 'Reports edit', 'web', '2021-11-20 07:04:22', '2021-11-20 07:04:22'),
(78, 'Reports delete', 'web', '2021-11-20 07:04:22', '2021-11-20 07:04:22'),
(79, 'Reports list', 'web', '2021-11-20 07:04:22', '2021-11-20 07:04:22'),
(80, 'Reports import', 'web', '2021-11-20 07:04:22', '2021-11-20 07:04:22'),
(81, 'Fuel add', 'web', '2021-11-20 07:04:22', '2021-11-20 07:04:22'),
(82, 'Fuel edit', 'web', '2021-11-20 07:04:22', '2021-11-20 07:04:22'),
(83, 'Fuel delete', 'web', '2021-11-20 07:04:22', '2021-11-20 07:04:22'),
(84, 'Fuel list', 'web', '2021-11-20 07:04:22', '2021-11-20 07:04:22'),
(85, 'Fuel import', 'web', '2021-11-20 07:04:22', '2021-11-20 07:04:22'),
(86, 'Vendors add', 'web', '2021-11-20 07:04:22', '2021-11-20 07:04:22'),
(87, 'Vendors edit', 'web', '2021-11-20 07:04:23', '2021-11-20 07:04:23'),
(88, 'Vendors delete', 'web', '2021-11-20 07:04:23', '2021-11-20 07:04:23'),
(89, 'Vendors list', 'web', '2021-11-20 07:04:23', '2021-11-20 07:04:23'),
(90, 'Vendors import', 'web', '2021-11-20 07:04:23', '2021-11-20 07:04:23'),
(91, 'Parts add', 'web', '2021-11-20 07:04:23', '2021-11-20 07:04:23'),
(92, 'Parts edit', 'web', '2021-11-20 07:04:23', '2021-11-20 07:04:23'),
(93, 'Parts delete', 'web', '2021-11-20 07:04:23', '2021-11-20 07:04:23'),
(94, 'Parts list', 'web', '2021-11-20 07:04:23', '2021-11-20 07:04:23'),
(95, 'Parts import', 'web', '2021-11-20 07:04:23', '2021-11-20 07:04:23'),
(96, 'WorkOrders add', 'web', '2021-11-20 07:04:23', '2021-11-20 07:04:23'),
(97, 'WorkOrders edit', 'web', '2021-11-20 07:04:23', '2021-11-20 07:04:23'),
(98, 'WorkOrders delete', 'web', '2021-11-20 07:04:24', '2021-11-20 07:04:24'),
(99, 'WorkOrders list', 'web', '2021-11-20 07:04:24', '2021-11-20 07:04:24'),
(100, 'WorkOrders import', 'web', '2021-11-20 07:04:24', '2021-11-20 07:04:24'),
(101, 'Notes add', 'web', '2021-11-20 07:04:24', '2021-11-20 07:04:24'),
(102, 'Notes edit', 'web', '2021-11-20 07:04:24', '2021-11-20 07:04:24'),
(103, 'Notes delete', 'web', '2021-11-20 07:04:24', '2021-11-20 07:04:24'),
(104, 'Notes list', 'web', '2021-11-20 07:04:25', '2021-11-20 07:04:25'),
(105, 'Notes import', 'web', '2021-11-20 07:04:25', '2021-11-20 07:04:25'),
(106, 'ServiceReminders add', 'web', '2021-11-20 07:04:25', '2021-11-20 07:04:25'),
(107, 'ServiceReminders edit', 'web', '2021-11-20 07:04:25', '2021-11-20 07:04:25'),
(108, 'ServiceReminders delete', 'web', '2021-11-20 07:04:25', '2021-11-20 07:04:25'),
(109, 'ServiceReminders list', 'web', '2021-11-20 07:04:25', '2021-11-20 07:04:25'),
(110, 'ServiceReminders import', 'web', '2021-11-20 07:04:25', '2021-11-20 07:04:25'),
(111, 'ServiceItems add', 'web', '2021-11-20 07:04:25', '2021-11-20 07:04:25'),
(112, 'ServiceItems edit', 'web', '2021-11-20 07:04:25', '2021-11-20 07:04:25'),
(113, 'ServiceItems delete', 'web', '2021-11-20 07:04:25', '2021-11-20 07:04:25'),
(114, 'ServiceItems list', 'web', '2021-11-20 07:04:25', '2021-11-20 07:04:25'),
(115, 'ServiceItems import', 'web', '2021-11-20 07:04:25', '2021-11-20 07:04:25'),
(116, 'Testimonials add', 'web', '2021-11-20 07:04:26', '2021-11-20 07:04:26'),
(117, 'Testimonials edit', 'web', '2021-11-20 07:04:26', '2021-11-20 07:04:26'),
(118, 'Testimonials delete', 'web', '2021-11-20 07:04:26', '2021-11-20 07:04:26'),
(119, 'Testimonials list', 'web', '2021-11-20 07:04:26', '2021-11-20 07:04:26'),
(120, 'Testimonials import', 'web', '2021-11-20 07:04:26', '2021-11-20 07:04:26'),
(121, 'Team add', 'web', '2021-11-20 07:04:26', '2021-11-20 07:04:26'),
(122, 'Team edit', 'web', '2021-11-20 07:04:26', '2021-11-20 07:04:26'),
(123, 'Team delete', 'web', '2021-11-20 07:04:27', '2021-11-20 07:04:27'),
(124, 'Team list', 'web', '2021-11-20 07:04:27', '2021-11-20 07:04:27'),
(125, 'Team import', 'web', '2021-11-20 07:04:27', '2021-11-20 07:04:27'),
(126, 'Settings add', 'web', '2021-11-20 07:04:27', '2021-11-20 07:04:27'),
(127, 'Settings edit', 'web', '2021-11-20 07:04:27', '2021-11-20 07:04:27'),
(128, 'Settings delete', 'web', '2021-11-20 07:04:27', '2021-11-20 07:04:27'),
(129, 'Settings list', 'web', '2021-11-20 07:04:27', '2021-11-20 07:04:27'),
(130, 'Settings import', 'web', '2021-11-20 07:04:27', '2021-11-20 07:04:27'),
(131, 'Inquiries add', 'web', '2021-11-20 07:04:27', '2021-11-20 07:04:27'),
(132, 'Inquiries edit', 'web', '2021-11-20 07:04:27', '2021-11-20 07:04:27'),
(133, 'Inquiries delete', 'web', '2021-11-20 07:04:27', '2021-11-20 07:04:27'),
(134, 'Inquiries list', 'web', '2021-11-20 07:04:27', '2021-11-20 07:04:27'),
(135, 'Inquiries import', 'web', '2021-11-20 07:04:28', '2021-11-20 07:04:28'),
(136, 'Contracts add', 'web', NULL, NULL),
(137, 'Contracts edit', 'web', NULL, NULL),
(138, 'Contracts delete', 'web', NULL, NULL),
(139, 'Contracts list', 'web', NULL, NULL),
(140, 'Tracker list', 'web', NULL, NULL),
(141, 'Tracker edit', 'web', NULL, NULL),
(142, 'Tracker add', 'web', NULL, NULL),
(143, 'Tracker delete', 'web', NULL, NULL),
(144, 'Reception add', 'web', NULL, NULL),
(145, 'Reception edit', 'web', NULL, NULL),
(146, 'Reception delete', 'web', NULL, NULL),
(147, 'Reception list', 'web', NULL, NULL),
(148, 'Branches list', 'web', '2025-05-29 23:07:35', '2025-05-29 23:07:35'),
(149, 'Branches add', 'web', '2025-05-29 23:07:35', '2025-05-29 23:07:35'),
(150, 'Branches edit', 'web', '2025-05-29 23:07:35', '2025-05-29 23:07:35'),
(151, 'Branches delete', 'web', '2025-05-29 23:07:35', '2025-05-29 23:07:35');

-- --------------------------------------------------------

--
-- Table structure for table `push_notification`
--

DROP TABLE IF EXISTS `push_notification`;
CREATE TABLE IF NOT EXISTS `push_notification` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `authtoken` varchar(255) DEFAULT NULL,
  `contentencoding` varchar(255) DEFAULT NULL,
  `endpoint` varchar(255) DEFAULT NULL,
  `publickey` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `push_notification_user_id_index` (`user_id`),
  KEY `push_notification_user_type_index` (`user_type`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `push_notification`
--


-- --------------------------------------------------------

--
-- Table structure for table `push_subscriptions`
--

DROP TABLE IF EXISTS `push_subscriptions`;
CREATE TABLE IF NOT EXISTS `push_subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `subscribable_type` varchar(255) NOT NULL,
  `subscribable_id` bigint(20) UNSIGNED NOT NULL,
  `endpoint` varchar(255) NOT NULL,
  `public_key` varchar(255) DEFAULT NULL,
  `auth_token` varchar(255) DEFAULT NULL,
  `content_encoding` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `push_subscriptions_endpoint_unique` (`endpoint`),
  KEY `push_subscriptions_subscribable_type_subscribable_id_index` (`subscribable_type`,`subscribable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reasons`
--

DROP TABLE IF EXISTS `reasons`;
CREATE TABLE IF NOT EXISTS `reasons` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `reason` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `reasons`
--

INSERT INTO `reasons` (`id`, `reason`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'No fuel', NULL, '2021-11-20 07:03:46', '2021-11-20 07:03:46'),
(2, 'Tire punctured', NULL, '2021-11-20 07:03:46', '2021-11-20 07:03:46');

-- --------------------------------------------------------

--
-- Table structure for table `reception_media`
--

DROP TABLE IF EXISTS `reception_media`;
CREATE TABLE IF NOT EXISTS `reception_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reception_id` int(10) UNSIGNED NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `reception_id` (`reception_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `ratings` double(8,2) DEFAULT NULL,
  `review_text` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_user_id_booking_id_driver_id_index` (`user_id`,`booking_id`,`driver_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', '2021-11-20 07:04:28', '2021-11-20 07:04:28'),
(2, 'Admin', 'web', '2021-11-20 07:04:36', '2025-05-10 16:29:44');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(6, 1),
(6, 2),
(7, 1),
(7, 2),
(8, 1),
(8, 2),
(9, 1),
(9, 2),
(10, 1),
(10, 2),
(11, 1),
(11, 2),
(12, 1),
(12, 2),
(13, 1),
(13, 2),
(14, 1),
(14, 2),
(15, 1),
(15, 2),
(16, 1),
(16, 2),
(17, 1),
(17, 2),
(18, 1),
(18, 2),
(19, 1),
(19, 2),
(36, 1),
(36, 2),
(37, 1),
(37, 2),
(38, 1),
(38, 2),
(39, 1),
(39, 2),
(41, 1),
(41, 2),
(42, 1),
(42, 2),
(43, 1),
(43, 2),
(44, 1),
(44, 2),
(46, 1),
(46, 2),
(47, 1),
(47, 2),
(48, 1),
(48, 2),
(49, 1),
(49, 2),
(51, 1),
(51, 2),
(52, 1),
(52, 2),
(53, 1),
(53, 2),
(54, 1),
(54, 2),
(56, 1),
(56, 2),
(57, 1),
(57, 2),
(58, 1),
(58, 2),
(59, 1),
(59, 2),
(61, 1),
(61, 2),
(62, 1),
(62, 2),
(63, 1),
(63, 2),
(64, 1),
(64, 2),
(66, 1),
(66, 2),
(68, 1),
(68, 2),
(69, 1),
(69, 2),
(71, 1),
(71, 2),
(72, 1),
(72, 2),
(73, 1),
(73, 2),
(74, 1),
(74, 2),
(79, 1),
(79, 2),
(81, 1),
(81, 2),
(82, 1),
(82, 2),
(83, 1),
(83, 2),
(84, 1),
(84, 2),
(86, 1),
(86, 2),
(87, 1),
(87, 2),
(88, 1),
(88, 2),
(89, 1),
(89, 2),
(90, 1),
(90, 2),
(91, 1),
(91, 2),
(92, 1),
(92, 2),
(93, 1),
(93, 2),
(94, 1),
(94, 2),
(96, 1),
(96, 2),
(97, 1),
(97, 2),
(98, 1),
(98, 2),
(99, 1),
(99, 2),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(106, 1),
(106, 2),
(108, 1),
(108, 2),
(109, 1),
(109, 2),
(111, 1),
(111, 2),
(112, 1),
(112, 2),
(113, 1),
(113, 2),
(114, 1),
(114, 2),
(116, 1),
(117, 1),
(118, 1),
(119, 1),
(121, 1),
(122, 1),
(123, 1),
(124, 1),
(129, 1),
(134, 1),
(136, 1),
(136, 2),
(136, 3),
(137, 1),
(137, 2),
(137, 3),
(138, 1),
(138, 2),
(138, 3),
(139, 1),
(139, 2),
(139, 3),
(140, 1),
(140, 2),
(140, 3),
(141, 1),
(141, 2),
(141, 3),
(142, 1),
(142, 2),
(142, 3),
(143, 1),
(143, 2),
(143, 3),
(144, 1),
(144, 2),
(145, 1),
(145, 2),
(146, 1),
(146, 2),
(147, 1),
(147, 2),
(148, 1),
(148, 2),
(149, 1),
(149, 2),
(150, 1),
(150, 2),
(151, 1),
(151, 2);

-- --------------------------------------------------------

--
-- Table structure for table `service_items`
--

DROP TABLE IF EXISTS `service_items`;
CREATE TABLE IF NOT EXISTS `service_items` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `time_interval` varchar(255) DEFAULT 'off',
  `overdue_time` varchar(255) DEFAULT NULL,
  `overdue_unit` varchar(255) DEFAULT NULL,
  `meter_interval` varchar(255) DEFAULT 'off',
  `overdue_meter` varchar(255) DEFAULT NULL,
  `show_time` varchar(255) DEFAULT 'off',
  `duesoon_time` varchar(255) DEFAULT NULL,
  `duesoon_unit` varchar(255) DEFAULT NULL,
  `show_meter` varchar(255) DEFAULT 'off',
  `duesoon_meter` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `service_items`
--

INSERT INTO `service_items` (`id`, `user_id`, `description`, `time_interval`, `overdue_time`, `overdue_unit`, `meter_interval`, `overdue_meter`, `show_time`, `duesoon_time`, `duesoon_unit`, `show_meter`, `duesoon_meter`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Change oil', 'on', '60', 'day(s)', 'off', NULL, 'on', '2', 'day(s)', 'off', NULL, '2025-05-09 16:09:49', '2021-11-20 07:03:53', '2025-05-09 16:09:49'),
(2, 1, 'vidange', 'on', '2', 'day(s)', NULL, NULL, NULL, NULL, 'day(s)', NULL, NULL, '2025-05-09 16:09:49', '2025-05-05 15:46:21', '2025-05-09 16:09:49'),
(3, 1, 'visite technique', 'on', '1', 'year(s)', NULL, NULL, 'on', '30', 'day(s)', NULL, NULL, '2025-05-09 16:09:49', '2025-05-09 16:09:33', '2025-05-09 16:09:49'),
(4, 1, 'Visite technique', 'on', '1', 'year(s)', NULL, NULL, 'on', '30', 'day(s)', NULL, NULL, NULL, '2025-05-09 16:09:33', '2025-05-09 16:09:33');

-- --------------------------------------------------------

--
-- Table structure for table `service_reminder`
--

DROP TABLE IF EXISTS `service_reminder`;
CREATE TABLE IF NOT EXISTS `service_reminder` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `last_date` varchar(255) DEFAULT NULL,
  `last_meter` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_reminder_vehicle_id_service_id_index` (`vehicle_id`,`service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `service_reminder`
--

INSERT INTO `service_reminder` (`id`, `user_id`, `vehicle_id`, `service_id`, `last_date`, `last_meter`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 1, '2025-05-05', 0, '2025-05-09 15:33:25', '2025-05-05 15:37:37', '2025-05-09 15:33:25'),
(2, 1, 9, 2, '2025-05-05', 0, '2025-05-09 15:33:30', '2025-05-05 15:46:48', '2025-05-09 15:33:30');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `label` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `settings`
--


-- --------------------------------------------------------

--
-- Table structure for table `team`
--

DROP TABLE IF EXISTS `team`;
CREATE TABLE IF NOT EXISTS `team` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `name`, `details`, `designation`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Elliot Hirthe', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Temporibus neque est nemo et ipsum fugiat, ab facere adipisci. Aliquam quibusdam molestias quisquam distinctio? Culpa, voluptatem voluptates exercitationem sequi velit quaerat.', 'Owner', NULL, '2021-11-20 07:03:45', '2021-11-20 07:03:45', NULL),
(2, 'Kathlyn Wisoky IV', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Temporibus neque est nemo et ipsum fugiat, ab facere adipisci. Aliquam quibusdam molestias quisquam distinctio? Culpa, voluptatem voluptates exercitationem sequi velit quaerat.', 'Owner', NULL, '2021-11-20 07:03:45', '2021-11-20 07:03:45', NULL),
(3, 'Prof. Juliana Mante', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Temporibus neque est nemo et ipsum fugiat, ab facere adipisci. Aliquam quibusdam molestias quisquam distinctio? Culpa, voluptatem voluptates exercitationem sequi velit quaerat.', 'Owner', NULL, '2021-11-20 07:03:45', '2021-11-20 07:03:45', NULL),
(4, 'Deron Ortiz', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Temporibus neque est nemo et ipsum fugiat, ab facere adipisci. Aliquam quibusdam molestias quisquam distinctio? Culpa, voluptatem voluptates exercitationem sequi velit quaerat.', 'Owner', NULL, '2021-11-20 07:03:45', '2021-11-20 07:03:45', NULL),
(5, 'Dr. Jailyn Feil', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Temporibus neque est nemo et ipsum fugiat, ab facere adipisci. Aliquam quibusdam molestias quisquam distinctio? Culpa, voluptatem voluptates exercitationem sequi velit quaerat.', 'Owner', NULL, '2021-11-20 07:03:45', '2021-11-20 07:03:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `details`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Dahlia Goldner', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet animi doloribus, repudiandae iusto magnam soluta voluptates, expedita aspernatur consectetur! Ex fugit ducimus itaque, quibusdam nemo in animi quae libero repellendus!', NULL, '2021-11-20 07:03:45', '2021-11-20 07:03:45', NULL),
(2, 'Franz Stokes', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet animi doloribus, repudiandae iusto magnam soluta voluptates, expedita aspernatur consectetur! Ex fugit ducimus itaque, quibusdam nemo in animi quae libero repellendus!', NULL, '2021-11-20 07:03:45', '2021-11-20 07:03:45', NULL),
(3, 'Albert Gleason', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet animi doloribus, repudiandae iusto magnam soluta voluptates, expedita aspernatur consectetur! Ex fugit ducimus itaque, quibusdam nemo in animi quae libero repellendus!', NULL, '2021-11-20 07:03:45', '2021-11-20 07:03:45', NULL),
(4, 'Vanessa Bechtelar PhD', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet animi doloribus, repudiandae iusto magnam soluta voluptates, expedita aspernatur consectetur! Ex fugit ducimus itaque, quibusdam nemo in animi quae libero repellendus!', NULL, '2021-11-20 07:03:45', '2021-11-20 07:03:45', NULL),
(5, 'Adah Rau', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet animi doloribus, repudiandae iusto magnam soluta voluptates, expedita aspernatur consectetur! Ex fugit ducimus itaque, quibusdam nemo in animi quae libero repellendus!', NULL, '2021-11-20 07:03:45', '2021-11-20 07:03:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `twilio_settings`
--

DROP TABLE IF EXISTS `twilio_settings`;
CREATE TABLE IF NOT EXISTS `twilio_settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `twilio_settings_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `twilio_settings`
--

INSERT INTO `twilio_settings` (`id`, `name`, `value`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'sid', '', '2021-11-20 07:04:11', '2021-11-20 07:04:11', NULL),
(2, 'token', '', '2021-11-20 07:04:11', '2021-11-20 07:04:11', NULL),
(3, 'from', '', '2021-11-20 07:04:11', '2021-11-20 07:04:11', NULL),
(4, 'customer_message', '', '2021-11-20 07:04:11', '2021-11-20 07:04:11', NULL),
(5, 'driver_message', '', '2021-11-20 07:04:11', '2021-11-20 07:04:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(95) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `branch_id` int(10) UNSIGNED DEFAULT NULL,
  `api_token` varchar(60) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_api_token_unique` (`api_token`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_user_type_index` (`user_type`),
  KEY `users_branch_id_foreign` (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `name`, `email`, `password`, `user_type`, `group_id`, `branch_id`, `api_token`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Super Administrator', 'master@admin.com', '$2y$10$oRVwGqjS7RT.ae9rLPlbwevOJz88d7mUuDE1vPtWEsHBevanPCq6q', 'S', NULL, NULL, 'vNjY40dy2vWTYJqPfsOGRW331lIU8OY2qfUrqL5Oo4RTxnIvsxT9ZVIHlXFv', '3Ixvz7xShjPArhYTdMPYZrp4DDfhzj1FuxMZsjkWQPWNJP5PuuYI5PBjGLX6', '2021-11-20 07:03:48', '2021-11-20 07:03:48', NULL),
(2, 1, 'fes admin', 'fes@touhfacar.com', '$2y$12$CAVXvbJ6v6zcLVHgUrg9fOSnGig9f1lLq6Ni2c2E7E69qMn1Vpj3y', 'O', 1, NULL, '1TxP6fg9WPYmPse2PaRggJUAyt0De9xOYUivQeiSC0N92GYEFVOviNfQq6Qk', 'sOzAwQ998O1YE7YXoDCfLCKEoAZPl4oBDfM1LJ2Mv05YzrAkIrM6Ysh3OMV2', '2021-11-20 07:03:48', '2025-06-01 01:08:02', NULL),
(3, 1, 'casablanca admin', 'casablanca@touhfacar.com', '$2y$12$ZJFOumKeOgWXEgJ7UAMF7u0WTTXzMwj8yEwrB6DaDdp.7NOQmoOA.', 'O', 1, NULL, 'dLlOOjzxTrYzA2N9IEJeduRXnpLwrARmnaXvwbtLtPCFgpcZgeYIfErCQ6ja', '59FkoXaGwQhG7OrLjfI7aAdLkcJFYICNkBpszOFi7TJX3NnjMbQQfu6l8Fz4', '2021-11-20 07:03:48', '2025-06-01 01:07:36', NULL),
(6, 1, 'Mariah Bahringer', '1746741340_deletednbode@example.net', '$2y$10$mRsCYSZSMw0lAle/kxMjGODZ6nt/G3FzB75AUWsTKb7jdq9KXL9ny', 'D', NULL, NULL, '4vyb77kPNaiMyuPG63WUFctB2G3NPjPx1kgafzjBOWWnhEsVS8rScIg7s98O', '5aN4c0pRUd', '2021-11-20 07:04:12', '2025-05-08 21:55:40', '2025-05-08 21:55:40'),
(7, 1, 'Leland Schuppe', '1746741340_deletedoabshire@example.org', '$2y$10$8xlqNIYjbsuuTrMho/4AieRd4AO8XFKL0UpO9L1c/4REs40OlSCXS', 'D', NULL, NULL, 'rDQOs9u7J4HX9gRG9ba6SHpDfpcpNqxmKVuZmhgGAc9EK1Zbfs60cBepetsr', 'yX9YRQfvBJ', '2021-11-20 07:04:13', '2025-05-08 21:55:40', '2025-05-08 21:55:40'),
(8, 1, 'Noelle Stafford', '1746741340_deletedkedim@mailinator.com', '$2y$10$3x2u23rUc0eqJNqqPO7yNutR/wUZb9CAk97oI2OWVTrlDWexPfyfm', 'D', NULL, NULL, 'pN1iP2z5R3KnjTtk2QiJHES7saG5MvxswgHjCaCu9Ob2CR32is6dD98c0txL', NULL, '2021-11-22 23:01:58', '2025-05-08 21:55:40', '2025-05-08 21:55:40'),
(24, NULL, 'zaki ali', '1746380832_deletedzakiali892@gmail.com', '$2y$12$yGC5G1.TSQ1.gfuMGVWobexT0d3FAL5miEkZLY0LffrPU.7mZhngu', 'C', NULL, NULL, 'uCSLBMlK0ZW2vKw56JqNBNFoTVDuB1tBMu3Lk2D1KumUl3SmkZbX103Cd5lp', NULL, '2025-04-30 08:05:51', '2025-05-04 17:47:12', '2025-05-04 17:47:12'),
(25, 1, 'zaki ali', '1746380832_deletedzakiali266@gmail.com', '$2y$12$A52tzDnmrPNvObzxvpDT8O8gTXLqGhIAIL8bnBdqz96LIOwuQu6Pa', 'C', NULL, NULL, 'EULPeB1nv3bP2RXTvpkx1lwGUq5GfkP8JWDEiHCSfPhjxF6xvyPZiDadVQOE', NULL, '2025-04-30 08:09:22', '2025-05-04 17:47:12', '2025-05-04 17:47:12'),
(26, 1, 'zaki ali', '1746380824_deletedzakiali497@gmail.com', '$2y$12$PLg7HmX7VHz2vqQ4YFLsx.4NgiOilVXj6LXIY9ZS8cqYMkXvgZFI.', 'C', NULL, NULL, '63QzKB3hkVpwsSvKMJAA8gh2NxztkZV0NiB1kc1gMdbgkpIAd1nKD46ucSau', NULL, '2025-04-30 08:09:31', '2025-05-04 17:47:04', '2025-05-04 17:47:04'),
(27, 1, 'zaki ali', '1746380824_deletedzakiali642@gmail.com', '$2y$12$AZfe4jveA08cwRNCO6pEL.9YXGs5RTv0tr346Q5A3vYjV2wCW2Ss.', 'C', NULL, NULL, 'bKERS6hOln3WCU12MbsxkMK74yb6Jpvtrq70k3RmSUPpNNi2HtVzu3N1cSBP', NULL, '2025-04-30 08:09:36', '2025-05-04 17:47:04', '2025-05-04 17:47:04'),
(28, 1, 'zaki najat', '1746380824_deletedzakinajat653@gmail.com', '$2y$12$cfEPNNrRqI7SCd5LibriXer8bqTZ247.xkCi3fM8C6Fu7y1Uk0MWW', 'C', NULL, NULL, 'c8rCLIrAC4IkngekTpH2TfGK8CxOmyXpePQqtckWTxoPpszHmPGK6uD3BkdP', NULL, '2025-04-30 09:17:31', '2025-05-04 17:47:04', '2025-05-04 17:47:04'),
(29, 1, 'zaki najat', '1746380824_deletedzakinajat465@gmail.com', '$2y$12$bc/hgFoHd6BIZyNnUYEDRe6UV5XEQFdEcA932UWfd9bz874WYZQaa', 'C', NULL, NULL, 'D3Dc9K1y9MgTFezIcHgMeI48cB4y04Le5uCsmXQgGMQyj9WfCHUJj9BHrAL8', NULL, '2025-04-30 09:34:03', '2025-05-04 17:47:04', '2025-05-04 17:47:04'),
(30, NULL, 'zaki najat', '1746380824_deletedzakinajat411@gmail.com', '$2y$12$zPzPGn9Av6MA2OCYhIO8Ie3qbdQQSvjShD/y5r0dAD6/gPyzQhAzi', 'C', NULL, NULL, 'Mt8SrsENoTa28lmIsalW4fWsoKUZD2zZ6evWEdiPX1bJgkzKT87KOq0uvvz6', NULL, '2025-04-30 09:35:55', '2025-05-04 17:47:04', '2025-05-04 17:47:04'),
(31, 1, 'zaki najat', '1746380824_deletedzakinajat990@gmail.com', '$2y$12$5/IIR4P7piZEciBp5pSM0exOzYk8CqLTlCX.bFYQqCCNMVFbcJP3C', 'C', NULL, NULL, 'MehoPC5c4cLP2wp0vtOTuZ7sAFj69kRa9Wtclw7pmqQ1PPMdaNx3xsVu4P5S', NULL, '2025-04-30 09:36:47', '2025-05-04 17:47:04', '2025-05-04 17:47:04'),
(32, 1, 'oumaima abou', '1746380824_deletedrabie@superadmin.com', '$2y$12$4fSeaNBVjqmbRZAAOnnb/usPyChuV9YB2uTUpSJaDlmpompGSMyTy', 'C', NULL, NULL, 'vwNWKTow4ur3e9V0zsl2BJsoH3WQ0AfUUpmfY2X0r2woGZXv17Bz5UHwQHXV', NULL, '2025-04-30 10:04:58', '2025-05-04 17:47:04', '2025-05-04 17:47:04'),
(33, 1, 'asdf asdf', '1746380824_deletedasdfasdf693@gmail.com', '$2y$12$l2HtGMZHFcqLQQHSGi0V6OLRmbrQLk.1NTFr//9TTWB07knaiv9Z.', 'C', NULL, NULL, 'XAYrw7Pv6eeXGL7agGKTncmkAl9tmgILCJf9orignopA67DVVMgiSJK2fvhS', NULL, '2025-05-04 15:45:38', '2025-05-04 17:47:04', '2025-05-04 17:47:04'),
(34, 1, 'asdf asdf', '1746380824_deletedasdfasdf236@gmail.com', '$2y$12$SpiWvru4m4xfolGhdY8lEOgCudQ1C8ZydeMWCwLuYSAZQe.w5bbNa', 'C', NULL, NULL, 'c7thHq3Qowg1kFId2Xj8gvh1OBjKhzNYE0HFaG5wFjATsBZRPbeu1R56Ncvd', NULL, '2025-05-04 15:50:12', '2025-05-04 17:47:04', '2025-05-04 17:47:04'),
(35, 1, 'brahim brahim', '1746374416_deletedbrahim@gmail.com', '$2y$12$w4h6wbfpS2Zb8fxxwU3DJOVDabjf33B0nTf3hI1sP0/viCXpM57ku', 'C', NULL, NULL, 'kieHNPxb0N4omRUv0tVrQqcPlatl19HyD6r2HbLEzbaWFTm4eVkv7lfl3T1q', NULL, '2025-05-04 15:58:37', '2025-05-04 16:00:16', '2025-05-04 16:00:16'),
(36, 1, 'brahim brahim', '1746380824_deletedbrahim@gmail.com', '$2y$12$cvMbaSClKSwxuCq.a4syZum2ZrdtJEAdLgdsAx8qLGXEgY47hJ/9u', 'C', NULL, NULL, 'U9bmK2UMd5luc91P09Ir37GtV0wNm0mEuMrbEyndsrCCC0VoHqebu8yZvqY4', NULL, '2025-05-04 16:00:47', '2025-05-04 17:47:04', '2025-05-04 17:47:04'),
(37, 1, 'rachid rtl', '1746458549_deletedadmin@admin.com', '$2y$12$EOYthugYbUlfXI4e4XSjmu5pARoUkL7QRxSyI17.qwdxNhNlqlw9.', 'C', NULL, NULL, 'rP1oepOaNWyLwJTRn1uYaJlRqQN7qOLhoN2pd0a4MoBxRXS9wVfopNRXImE2', NULL, '2025-05-04 17:47:34', '2025-05-05 15:22:29', '2025-05-05 15:22:29'),
(38, 1, 'brahim brahim', '1746458549_deletedbrahim@gmail.com', '$2y$12$hEp9AfBxkoD3v1KmQoeNNOIY6IxfjAb4sTkVFM.LU5GaKTJHe5ala', 'C', NULL, NULL, 'HPezRBTlTDaNSYGARKAzIrhmo4nhPEdcUPXECTHUdthHLwUVI6Dc4ArRjPvd', NULL, '2025-05-05 14:17:44', '2025-05-05 15:22:29', '2025-05-05 15:22:29'),
(39, 1, 'HOUCIN LEFHAIL', '1747244467_deletedomar7abbad77@gmail.coyh', '$2y$12$SzUSN98CT4Lm1j.3DRGBd.cmVuwnekHFqbzgqWcDRPH2GRFUvLrZS', 'C', NULL, NULL, 'CGpQtHzZIl1lcVnMmiJLxugJR9Ps04BEhPn5maL72ErbD5ZXKMqu2MJfFg6I', NULL, '2025-05-05 15:27:53', '2025-05-14 17:41:07', '2025-05-14 17:41:07'),
(40, 1, 'Modrik Fati', '1747244467_deletedModrikFati763@gmail.com', '$2y$12$ruRxB99NEcZr6Ln75/O91u4gZ0RDbAeYiWvUEqUX8azITHSwRrAiO', 'C', NULL, NULL, 'BLNXDSInJQqHsSxHUC5ppfxWh29w5DNjmdjSrQDqfkVME22kN6PC6wket8P0', NULL, '2025-05-05 21:03:26', '2025-05-14 17:41:07', '2025-05-14 17:41:07'),
(41, 1, 'Modrik Fati', '1747244457_deletedModrikFati184@gmail.com', '$2y$12$vu34PHXYF1VkBbvZ5VAQ8e.lE37iENWtOoQsiruwIN5DrYF91RclC', 'C', NULL, NULL, 'wjEHLV4LO6pH649p4Os0ArOtx2kL1NrFu1f8AUAN8MXLE5ZK04ZDt5t0q0vr', NULL, '2025-05-05 21:05:50', '2025-05-14 17:40:58', '2025-05-14 17:40:58'),
(42, 1, 'hassan kharbouch', '1747244458_deletedhassankharbouch867@gmail.com', '$2y$12$5hTW212XiYMc3Fw0EkLp/.9MbwJBq/nZib9u91z0MqGO5IZh3MxDu', 'C', NULL, NULL, 'mbEUhbwqYWhanNEw49UHZlNO62ZYPSZV8ojII2z4PGGJO7OKEiFo8NMhKwOa', NULL, '2025-05-07 17:33:24', '2025-05-14 17:40:58', '2025-05-14 17:40:58'),
(43, 1, 'hassan kharbouch', '1747244458_deletedhassankharbouch348@gmail.com', '$2y$12$OcFJfL3zpS1CRpycUEi4lOGbSpCPGTjUJmKF4breXXUy2UtmjmN5e', 'C', NULL, NULL, 'sAkh5swlAYPpUqiLIG1jsK1JPMxfa0NJP82mJkaaaGmzGgD0hL7spp7hMUpd', NULL, '2025-05-07 17:34:29', '2025-05-14 17:40:58', '2025-05-14 17:40:58'),
(44, 1, 'Mohammed amine Bourouan', '1747244458_deletedMohammed amineBourouan737@gmail.com', '$2y$12$W1GSypTOq8P7cFZ2gnxU2OVlu6ko9BSHy1jU.a/pCZFtAUnmGkmYC', 'C', NULL, NULL, 'pWvLohqUqtyMmjSfn9a2Y40dfgzXizO5UPf8hN906WvLY2GBwOFx8zZIWszf', NULL, '2025-05-08 12:30:04', '2025-05-14 17:40:58', '2025-05-14 17:40:58'),
(45, 3, 'Idder Mohamed', '1747244458_deletedIdderMohamed989@gmail.com', '$2y$12$0gGTyLD9jMmrhMlFnP0ZneegK.Qv7FXQIoBAdauVUkXEdW4AYGBbq', 'C', NULL, NULL, 'V6sQIUC6LmuCHphpxnVknkGKhJesROKLVdsiiuaUxRKprowOGn8nTQzm6aIH', NULL, '2025-05-12 16:52:44', '2025-05-14 17:40:58', '2025-05-14 17:40:58'),
(46, 3, 'Idder Mohamed', '1747244458_deletedIdderMohamed262@gmail.com', '$2y$12$ASrfFv64uWQRri1DlqhXj.vz.1ZDPT5BXlpVyb.HTCHEaeVhLlo8y', 'C', NULL, NULL, 'uhDsOsmI9woAT6B1QoubgF65daglOCo9wPlFfinRALMBcHZk3qmoLBh5yWVx', NULL, '2025-05-12 16:53:33', '2025-05-14 17:40:58', '2025-05-14 17:40:58'),
(47, 3, 'Idder Mohamed', '1747244458_deletedIdderMohamed750@gmail.com', '$2y$12$1QE/ua1aKFIbT/xui.qu1uu/9LuFDGGUjtBUYG5HxOcu/sYSjyjrS', 'C', NULL, NULL, '5yxX1kqhemnLOKQYv6MrS0MNNhtUOGK14mZdT2XplhR6hpLT7j9FOG2mmoa4', NULL, '2025-05-12 16:54:14', '2025-05-14 17:40:58', '2025-05-14 17:40:58'),
(48, 3, 'Idder Mohamed', '1747244458_deletedIdderMohamed333@gmail.com', '$2y$12$Fr5oRCudn28.lKQlsO3djOxhnB05Tgwa2LAKXdKZhuLIuCcf7j422', 'C', NULL, NULL, 'k4xEBmXUtTOQRKRsKF8TAYg71coMgY9AmrmQqYdVIknQF2VVqEFReklDLiUU', NULL, '2025-05-12 16:54:29', '2025-05-14 17:40:58', '2025-05-14 17:40:58'),
(49, 1, 'Iddar Mohamaed', '1747244458_deletedIddarMohamaed380@gmail.com', '$2y$12$0WjolwXeyKI.bu1GPy.zS.zP8LURBgNlTb5Nd8XGFhcREmWjFToL6', 'C', NULL, NULL, 'HAQy4O6zmqpA4rAZAZO1Gpcm6buXv77gI1Y6TIfcwNvkG1SV1IHlKKsBKD6l', NULL, '2025-05-12 17:09:08', '2025-05-14 17:40:58', '2025-05-14 17:40:58'),
(50, 1, 'test brahim', '1747070836_deletedtestbrahim377@gmail.com', '$2y$12$Kyr7ltkYZ0z3CMXpZIyuWe4PfNo1PxCaaAoPP5y7q01Mp2hjh.BUC', 'C', NULL, NULL, 'Vw9uubTLwriIKqVfKisVsle6iKGAl4Wt7xZTyaIfuVLhES7V1NAfq4LCATks', NULL, '2025-05-12 17:26:35', '2025-05-12 17:27:16', '2025-05-12 17:27:16'),
(51, 1, 'test brahim', '1747070945_deletedtestbrahim339@gmail.com', '$2y$12$9Z/Wm0EwijsU97wZLxfKhuTfbyz6/SeleV94XS6C5aKHDpqeVztkK', 'C', NULL, NULL, 'RP5XDGtjKUqvw7014SyUsj2cWiOVdeOZjMlxZ4KmQRfbKLzyhOuuanh74wN5', NULL, '2025-05-12 17:28:09', '2025-05-12 17:29:05', '2025-05-12 17:29:05'),
(52, 1, 'test brahim', '1747073626_deletedtestbrahim638@gmail.com', '$2y$12$hGJXQKWcqD8LnvzT9mtJMufngmoFVAdg2OrhduqrnIgrPQvXxhyG2', 'C', NULL, NULL, 'SJ1aCKbOBYa421FV7uWIGn9E9Ix6Km0AWndh5vGk8RoDM1cbHXdJJn1UA8RB', NULL, '2025-05-12 17:30:34', '2025-05-12 18:13:46', '2025-05-12 18:13:46'),
(53, 1, 'test brahim', '1747073786_deletedtestbrahim299@gmail.com', '$2y$12$bXsKKPCVx7iqfAzb.qyfDOFSe1RTKyLZxTnxnQP5lQFAPfxA4K7US', 'C', NULL, NULL, '6bRLtL2UubLidn6B7Sjoo3E8QP95TvTWaBYb8mxhhgY2mXcJfPeqSintBwXj', NULL, '2025-05-12 18:14:35', '2025-05-12 18:16:26', '2025-05-12 18:16:26'),
(54, 1, 'Iddar Mohamaed', '1747244458_deletedIddarMohamaed327@gmail.com', '$2y$12$TzaD2YyjBcZHYeGLi8nVlu/.B/w6ED5jk6Wtx6cFsyGlGZE7Vl1A2', 'C', NULL, NULL, 'hDBpcttMLnZbzM7MD5ttSSqrkbRB03L4WJ1vYiLpRGX1bRPxtEQuBUrtlahD', NULL, '2025-05-12 18:43:34', '2025-05-14 17:40:58', '2025-05-14 17:40:58'),
(55, 1, 'test test', '1747254869_deletedtesttest354@gmail.com', '$2y$12$Kpqd0LrSa.D4fQ//KtmOl.0kQ3rSTCBK8TyJ131hq8ZuYYHGrsOfy', 'C', NULL, NULL, '5uh91bfzQsIYcmZuzoeRqtXAEnJ1hZdu2TqlGJaZ0DmgNK4N2h5GLtbVURXS', NULL, '2025-05-14 20:31:20', '2025-05-14 20:34:29', '2025-05-14 20:34:29'),
(56, 2, 'BILAL LEZAR', 'BILALLEZAR803@gmail.com', '$2y$12$8Huxrfxgjr0i5P4B4FA3Pudrp4MUpcQTJYZuWXj8jebB7DlYhd3ji', 'C', NULL, NULL, 'lKX3YRFO2Y0lTPW9hWb5teOtR0XIHjCklf8eyUpWC81xrniP0h3xQi6Od2Fk', NULL, '2025-05-15 14:49:44', '2025-05-15 14:49:44', NULL),
(57, 1, 'test test', '1747353823_deletedtesttest735@gmail.com', '$2y$12$gOS3iVrW2BWHJRLTCV5RtOMKn.q17seXi7d0VkNRnGDiKo0ICkJf6', 'C', NULL, NULL, 'LYffns9jc7YbzK1LFij51EtbKMDUUfVqt6rEmwqAPpaTzZQ6hPTO7actEn2z', NULL, '2025-05-15 15:22:25', '2025-05-16 00:03:43', '2025-05-16 00:03:43'),
(58, 2, 'Mohammed amine Bourouan', 'Mohammed amineBourouan271@gmail.com', '$2y$12$gVlQ/nXPUWO27cZNeUZ6ceKFttICSVpHVJLXU/0jFlI430bKp1TV2', 'C', NULL, NULL, 'YfeGAU6245GDG62ZYE40ndbd1KYxHXrafwl0Tr6CDaz3nAcU9tacKJfYwib6', NULL, '2025-05-15 16:02:31', '2025-05-15 16:02:31', NULL),
(59, 1, 'Bouaziz Samir', 'BouazizSamir315@gmail.com', '$2y$12$Gh1XEp8R15cZEg5Q2N2y5ebuUrDemZIB5nv2FSnR5IH3h5D.HW2Z2', 'C', NULL, NULL, 'tV8VtWCnQn4VqLCFrmq82WTaqgpUqopvgwLTkPOKBISALypYsfEBsRWPI9K5', NULL, '2025-05-15 19:30:27', '2025-05-15 19:30:27', NULL),
(60, 1, 'Akhribich Slimane', 'AkhribichSlimane726@gmail.com', '$2y$12$bRnxc.MHwycwiSo171i4m.AHiDPwQ2eEYb5qpE8ibhoH0l8Zb.v82', 'C', NULL, NULL, 'lIdUwpsjLlRdvMdnGC006DkdBC8adjhJPoASGjwz7zDJAjTmVpye90EUIoFQ', NULL, '2025-05-15 20:34:06', '2025-05-15 20:34:06', NULL),
(61, 3, 'SEMLALI ABDRZAKE', 'SEMLALIABDRZAKE674@gmail.com', '$2y$12$PaIrSQstSEwEQ55dTaDgZOuxFp8us78icp67vgOq8vGR6/ZXAU4ci', 'C', NULL, NULL, 'VzWttNINv1NkHEmdzWXufcE8ZGbcJ3Kjnib28NHlxOw5YgNV0TkpTH18cXiv', NULL, '2025-05-16 00:49:25', '2025-05-16 00:49:25', NULL),
(62, 3, 'SEMLALI ABDRZAKE', 'SEMLALIABDRZAKE467@gmail.com', '$2y$12$OT6hU6OtK61DJAsRwQf28ObqHYY677D.nlDrOS.SE/bM.wWZEHA9W', 'C', NULL, NULL, 'ISztFJNcQ7766rclnZnswXDSk3feqqCOzyTMakuRpTC3B3WUX8LTjrqp1Dit', NULL, '2025-05-16 00:49:26', '2025-05-16 00:49:26', NULL),
(63, 3, 'SEMLALI ABDRZAKE', 'SEMLALIABDRZAKE775@gmail.com', '$2y$12$oZjb9GN6Vany.aHr0AO6PutW4e.fwAZPp9Zc7rt6HyPWC6WTZ/Dg6', 'C', NULL, NULL, 'MHrBYQ4nkDO8YNUhnnOSfoOJGM2kw3BIil5bVYnjMUe2gYzeCNaZsTi3JZGH', NULL, '2025-05-16 00:49:27', '2025-05-16 00:49:27', NULL),
(64, 3, 'SEMLALI ABDRZAKE', 'SEMLALIABDRZAKE242@gmail.com', '$2y$12$VXvYFFbeNYl739q9gOxDL.OUCBR1VaiSCJ8bt7/XPH5lsjyb.ZRG6', 'C', NULL, NULL, 'jyQHKGMYo4IilebjL1TkPRVrTlGr9zym2v44b7bwO3sshlCEu1YSZnuiVQvc', NULL, '2025-05-16 00:50:38', '2025-05-16 00:50:38', NULL),
(65, 3, 'SEMLALI ABDRZAKE', 'SEMLALIABDRZAKE646@gmail.com', '$2y$12$3o.TMJ9HcA75jHvpkMJBaunpsh6GZR8CZdUOJOwHvphRyPBjc8vvy', 'C', NULL, NULL, '99VRPnWTEwyrUI1vZoQSIlo3KdgEe9JySkOOCA1I0Zr57EQuKs1309dwK638', NULL, '2025-05-16 00:51:31', '2025-05-16 00:51:31', NULL),
(66, 3, 'SEMLALI ABDRZAKE', 'SEMLALIABDRZAKE962@gmail.com', '$2y$12$m3umNFn7LvORF5mqu3owZ.xHlDRblmEecPvCHxdjDk6dzk.5y1IB.', 'C', NULL, NULL, 'LDsgBZQtA2Axeb3pWA3bza00cfeKFPHGqfamWrtEkGysrOFCwktELzwvyxXC', NULL, '2025-05-16 00:56:11', '2025-05-16 00:56:11', NULL),
(67, 3, 'SEMLALI ABDRZAKE', 'SEMLALIABDRZAKE155@gmail.com', '$2y$12$33YkDoG/fSdmMmSSikCx9.P.Vglhf8oH1t9Im4LXKG28mES5h3On.', 'C', NULL, NULL, 'LRkosyO1hIOWer3Q6YWvraGuD4DVaZB3QHobnXI8SHXe3j1FdQG3K6ehBvFR', NULL, '2025-05-16 00:56:32', '2025-05-16 00:56:32', NULL),
(68, 3, 'AIT BAALI RACHID', 'AIT BAALIRACHID346@gmail.com', '$2y$12$gtlp1PngO8WmunZWPEuz/eY6ITomLHOvo474RKZ7O933S64vkh5K6', 'C', NULL, NULL, 'ZZS07FCzu5Ax6M3iBVyBUtaAbXoQ1hmjG4B6f7QfNuxn06rD86zXzqAVbOhq', NULL, '2025-05-18 16:34:47', '2025-05-18 16:34:47', NULL),
(69, 3, 'RAKRAKI SOMAYA', 'RAKRAKISOMAYA900@gmail.com', '$2y$12$1fGf06rJsVc2hmPNY1xMuekjbYVkNq8l2tSsLdyfypHPY34Hp2Lii', 'C', NULL, NULL, 'c6YLUbU4w97ZkY23GayVj5yhwOkudHJxO8GbtxCaw0G2FDlVNeqx0mNH63zW', NULL, '2025-05-18 17:47:58', '2025-05-18 17:47:58', NULL),
(70, 3, 'RAKRAKI SOMAYA', 'RAKRAKISOMAYA972@gmail.com', '$2y$12$7Xt0mE/2XGIjFIkM9RWq6.sU1kcD36VIDlAgaZQh/kNUZMEWUMRs6', 'C', NULL, NULL, '1FRmGvLUrMmVFfefonU2Meb0nbWA4GM7c8h50fJx9mDmtSof5UGAiJzo63bJ', NULL, '2025-05-18 17:47:59', '2025-05-18 17:47:59', NULL),
(71, 3, 'RAKRAKI SOMAYA', 'RAKRAKISOMAYA453@gmail.com', '$2y$12$kGOcWITQ0U0ZFsEd2UWsEed8LfxlU9MYBd.7fxid.XAF7IVCrHP8u', 'C', NULL, NULL, 'wvpegoIwwq7lGJDdxZ6ACtvDVAPLk3f1w7pEC6CnyF5vhUg9l04DVCxIAgKO', NULL, '2025-05-18 17:48:00', '2025-05-18 17:48:00', NULL),
(72, 2, 'KAOUTAR ALLAY', 'KAOUTARALLAY738@gmail.com', '$2y$12$6ZM.TTR6eyhpWqvqDt2rgOvirOag1AgW5KHjeO7Nm5s12iUrLAxXS', 'C', NULL, NULL, 'kMQLV8tu6NUOIVM98s6lH4x2Gf9yz3fDhcY7zT0uAeVN44K5SWRrhZlYMUuA', NULL, '2025-05-19 16:32:01', '2025-05-19 16:32:01', NULL),
(73, 2, 'KARIM EL KHALILI', 'KARIMEL KHALILI987@gmail.com', '$2y$12$jNmuNxyoygfIpJSWJ16zae1Y9lRdYgYYPXg5N6FC6nytEUaVkK4OS', 'C', NULL, NULL, 'ABQPMHzPJvHfctqxgIGPzgZRw0mn7SUuMitLfW21n9UoCHwkL6ww0f5rGR1E', NULL, '2025-05-20 11:25:48', '2025-05-20 11:25:48', NULL),
(74, 2, 'KARIM EL KHALILI', 'KARIMEL KHALILI712@gmail.com', '$2y$12$.BtaFZpOm0MolaAh35TbmesAkLMdchO2iONNHwwgf7NIOUCywW/su', 'C', NULL, NULL, 'RtlyfWJojSD34fEUg32pCBGkbH7UCFxLlmN3O9pq5w1a284ao5asKH8k8OVc', NULL, '2025-05-20 11:32:15', '2025-05-20 11:32:15', NULL),
(75, 3, 'SEMLALI ABDRZAKE', 'SEMLALIABDRZAKE523@gmail.com', '$2y$12$pWyj6soRR/40C6bgWtyB9OIzaVxn2NZ8ATEL/NdP9s4L/llugWiLG', 'C', NULL, NULL, 'OfkpsOyQBRqqz2q8BIo6Eq6s4mlyp6gornNJdPWWSW6FqlE8NpKT4rTtPNwH', NULL, '2025-05-20 23:43:56', '2025-05-20 23:43:56', NULL),
(76, 2, 'EL KHALDI TAOUFIK', 'EL KHALDITAOUFIK274@gmail.com', '$2y$12$78kGagmjuKZWTdWhg1aH.eJhjT9emEVLOcqGlFDlayMjpr44D2d36', 'C', NULL, NULL, 'ZYhuDU9SVOJdXX8ShkaTstVaOZHkPaI93DHFVsdhtaMe3jWM15z5DJw0CLAO', NULL, '2025-05-21 18:26:37', '2025-05-21 18:26:37', NULL),
(77, 2, 'REDOUANE EL IMAMI', NULL, '$2y$12$in9bkQabqxysb81rOK4N9usFhiv2cTFd6WNg9Belko8Wr2qOHZOgK', 'C', NULL, NULL, 'QGNz4rPvzHYUtzUTExzLJvjW1cZ5TIrlpovrbTiAwTTCcNtkzdbdFzDnVAWY', NULL, '2025-05-21 18:42:31', '2025-05-21 18:42:31', NULL),
(78, 2, 'Ertal Rachid', 'ErtalRachid447@gmail.com', '$2y$12$2uv/kF5ZekSqEi4WtcoyJ.fkoGW0wjZ9KSFEOycRLiodWDoq.KfnS', 'C', NULL, NULL, 'q8x8wSwIqzYNbjvpHUPgMH714UOt2S3U9Rz7144aN5o796xYeglGMZIfx54e', NULL, '2025-05-23 00:55:14', '2025-05-23 00:55:14', NULL),
(79, 2, 'meryem boumad', 'meryemboumad821@gmail.com', '$2y$12$NXp2BFm0EjsLc5s5JQSZ6OnnXvEj.hVtnbv2gZe8uXMjZD6YMmGrO', 'C', NULL, NULL, 'dRHHO9v6km06WDGeFKbMi0sfCpk2XmM4wGcz3ULpvdIsGxCouZjnDGJk1iQu', NULL, '2025-05-23 09:38:52', '2025-05-23 09:38:52', NULL),
(80, 3, 'MAACHOU ABDERRAHIM', 'MAACHOUABDERRAHIM670@gmail.com', '$2y$12$dzdinIOpPuZY5c/YXSqK.u.M7xwMb/7TcGP42XJVKANj3V2wnOmpG', 'C', NULL, NULL, 'dI9j0PnGzOFJyCJb49mnIZcVoxoCTZiBgqtb5Yzm6RkIZtocMtlKhaC08HPn', NULL, '2025-05-23 11:08:19', '2025-05-23 11:08:19', NULL),
(81, 3, 'SAID SOILIHI ZAYAD', 'SAID SOILIHIZAYAD239@gmail.com', '$2y$12$VuqZT.oO75hJIaJSb8mCkeuuyh28UA5cJn6jySC95rqYGX8ZruDm6', 'C', NULL, NULL, '0nThMno73ZfQCz6lZ0ky1CUpYQZhZ2r82dZeZLF60ZNEn5C0kiNFEbciEz69', NULL, '2025-05-23 21:03:57', '2025-05-23 21:03:57', NULL),
(82, 3, 'ahmad ZAYAD', 'OILIHIZAYAD580@gmail.com', '$2y$12$li6VnsHnehfTls.M9obmrO46rMGjlu/DqLBWAn3j0.sQL6UFKVyke', 'C', NULL, NULL, 'yrGlhI1Zo0TYQmXv2c6YpFsU8VEirRuCyRSYbuE2k5uu0ouJtIjZKa93mR62', NULL, '2025-05-23 21:08:50', '2025-06-01 01:06:31', NULL),
(83, 3, 'MAHJOUR ahmad', 'MAHJOURSAMIA267@gmail.com', '$2y$12$UPIuTt0qqtceSjd95caS/.QXcvTILt4GZ8mb4Ot1/iptQtC9dm6Ci', 'C', NULL, NULL, 'mcrkb0GStWBrreFQ1rVt9L7KrSTFdSJEdRqGsZCKUltHqpZbIbTuYLsdsxnN', NULL, '2025-05-27 18:28:39', '2025-06-01 01:06:05', NULL),
(84, 3, 'MAHJOUR SAMIA', '1748739937_deletedMAHJOURSAMIA207@gmail.com', '$2y$12$XJZnN6WSffrAcM319NHQB.Df2xcbTEAfsJV7mFIhxQEJ9/JGtDqkC', 'C', NULL, NULL, 'WEcgvbFE1pVvpp8UyKib8PvmBOs9C8rVOj730fq8B6WSaxt1BHRND4Ndzy6Q', NULL, '2025-05-27 18:28:56', '2025-06-01 01:05:37', '2025-06-01 01:05:37'),
(85, 3, 'MAHJOUR SAMIA', '1748739937_deletedMAHJOURSAMIA913@gmail.com', '$2y$12$lArvJd2VNvofihmI5YiiuuQeYJ83eOEB7QkQ5U.9V7/qZ45d4yn0W', 'C', NULL, NULL, '90ajH9vFUGINclLSfnEbcOCSaCLbtbWiENYT2xktDg1UNoakcOBrS4v42iFm', NULL, '2025-05-27 18:29:18', '2025-06-01 01:05:37', '2025-06-01 01:05:37'),
(86, 3, 'MAHJOUR SAMIA', '1748739937_deletedMAHJOURSAMIA117@gmail.com', '$2y$12$z46xI6yvJOjMzPNe/8wq7.TjayeThUh39AFZk6JlE63ZuY6N6oLJO', 'C', NULL, NULL, 'ONll2X1D9MU0eweYYiaeBoH4nWxbptFzDqCf3Q3orBcceaKLuHXQpy6B7wdY', NULL, '2025-05-27 18:29:44', '2025-06-01 01:05:37', '2025-06-01 01:05:37'),
(87, 3, 'MAHJOUR SAMIA', '1748739937_deletedMAHJOURSAMIA893@gmail.com', '$2y$12$7cD0HUajuWdiBYsxTkZxC.e2FJ08o8d2nirOTTNUliR6xQzAKA6me', 'C', NULL, NULL, 'dxOCbps31JHiJaDXhSNUoNON8TsUpD3SJfW03b4Y2pkmswz1yuPLF1lDK8Lw', NULL, '2025-05-27 18:30:06', '2025-06-01 01:05:37', '2025-06-01 01:05:37'),
(88, 3, 'MAHJOUR SAMIA', '1748739937_deletedMAHJOURSAMIA644@gmail.com', '$2y$12$XZyuyuh5QjbsGi2AOHg3z./9rxX09rG7oizn06Oucw2/D5T5YMZqG', 'C', NULL, NULL, '5ljyOuUtFL27ZgiOImwVw40MgsC5yApB8e5yRmk89zrC3LJAUm2bVSb1l7Yv', NULL, '2025-05-27 18:30:21', '2025-06-01 01:05:37', '2025-06-01 01:05:37'),
(89, 3, 'MAHJOUR SAMIA', '1748739937_deletedMAHJOURSAMIA878@gmail.com', '$2y$12$LcZRd7pNW05cGHsczxHkjOpkUEkKEcBX2ufWfROmSVt4fqr4kzDvq', 'C', NULL, NULL, 'AS1qjOpS54AvK2Yq4FYWZo2lBp4s01LX3ETn5UCcd4GcD4sVYu5qsVTUzCd7', NULL, '2025-05-27 18:31:02', '2025-06-01 01:05:37', '2025-06-01 01:05:37'),
(90, 3, 'MAHJOUR SAMIA', '1748739937_deletedMAHJOURSAMIA875@gmail.com', '$2y$12$2/R4AVozTs1DN/GRH/uxyeqMejdp6B2rrLTC4GkYR3cWZPG75Bux2', 'C', NULL, NULL, 'GbDMXKYgTDIjaNPCOjAxtVp9ametD5x5pWRmyXwKCZaBN9JbsEndRBAElQDG', NULL, '2025-05-27 18:32:49', '2025-06-01 01:05:37', '2025-06-01 01:05:37'),
(91, 3, 'MAHJOUR SAMIA', '1748739937_deletedMAHJOURSAMIA577@gmail.com', '$2y$12$AR1jT4HW5dJfXUZRYvcb9uPvasKIcxuEwgiCWIDNwlkAsN069yCSe', 'C', NULL, NULL, 'Gq8nS3PgtXm1hULBmDTUSJVyLrxjgUVofPqFoQsDefZX4bBRsBykaSa5z3sd', NULL, '2025-05-27 18:37:05', '2025-06-01 01:05:37', '2025-06-01 01:05:37'),
(92, 3, 'MAHJOUR SAMIA', '1748739924_deletedMAHJOURSAMIA279@gmail.com', '$2y$12$VxYBaLknFbdVu3qa2ykSOultGkWDY5EZo8WwSdT.3MycHXYHNDCxK', 'C', NULL, NULL, 'yyiVOzauvO7eCDKZ4OmnWPBhMFTKaAU60Ax8pvMPTeCON5ttg7VThniVEELJ', NULL, '2025-05-27 18:39:52', '2025-06-01 01:05:24', '2025-06-01 01:05:24');

-- --------------------------------------------------------

--
-- Table structure for table `users_meta`
--

DROP TABLE IF EXISTS `users_meta`;
CREATE TABLE IF NOT EXISTS `users_meta` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'null',
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_meta_user_id_index` (`user_id`),
  KEY `users_meta_key_index` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=429 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `users_meta`
--

--
-- Table structure for table `user_clients`
--

DROP TABLE IF EXISTS `user_clients`;
CREATE TABLE IF NOT EXISTS `user_clients` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_clients_id` int(10) UNSIGNED NOT NULL,
  `id_number` varchar(255) DEFAULT NULL,
  `id_expiry_date` date DEFAULT NULL,
  `license_number` varchar(255) DEFAULT NULL,
  `license_issue_date` date DEFAULT NULL,
  `passport_number` varchar(255) DEFAULT NULL,
  `passport_issue_date` date DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_clients_id` (`user_clients_id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_clients`
--

INSERT INTO `user_clients` (`id`, `user_clients_id`, `id_number`, `id_expiry_date`, `license_number`, `license_issue_date`, `passport_number`, `passport_issue_date`, `mobile`, `created_at`, `updated_at`) VALUES
(8, 24, '1', '2025-04-30', '12', '2025-04-30', '12131415', '2025-04-30', '0650421408', '2025-04-30 08:05:51', '2025-04-30 08:05:51'),
(9, 25, '1', '2025-04-30', '12', '2025-04-30', '12131415', '2025-04-30', '0650421408', '2025-04-30 08:09:23', '2025-04-30 08:09:23'),
(10, 26, '1', '2025-04-30', '12', '2025-04-30', '12131415', '2025-04-30', '0650421408', '2025-04-30 08:09:31', '2025-04-30 08:09:31'),
(11, 27, '1', '2025-04-30', '12', '2025-04-30', '12131415', '2025-04-30', '0650421408', '2025-04-30 08:09:36', '2025-04-30 08:09:36'),
(12, 28, '1', '2025-04-30', '12', '2025-04-30', '12131415', '2025-04-30', '0650421408', '2025-04-30 09:17:31', '2025-04-30 09:17:31'),
(13, 29, '1', '2025-04-30', '12', '2025-04-30', '12131415', '2025-04-30', '0650421408', '2025-04-30 09:34:03', '2025-04-30 09:34:03'),
(14, 31, '1', '2025-04-30', '12', '2025-04-30', '12131415', '2025-04-30', '0650421408', '2025-04-30 09:36:47', '2025-04-30 09:36:47'),
(16, 32, '123456', '2025-04-30', '1230456789', '2025-05-07', '1234567890', '2025-04-30', '0650421409', '2025-04-30 10:29:58', '2025-04-30 10:29:58'),
(17, 33, '345', NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-04 15:45:38', '2025-05-04 15:45:38'),
(18, 34, '333', NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-04 15:50:12', '2025-05-04 15:50:12'),
(19, 36, '23452345444', '2025-05-04', '88888', '2025-05-11', '8888', '2025-05-11', '8888888888888888', '2025-05-04 16:05:58', '2025-05-04 16:05:58'),
(20, 37, '646', '2025-05-02', '775757', '2025-05-22', '664646', '2025-05-23', '0771853888', '2025-05-04 17:47:34', '2025-05-04 17:47:34'),
(21, 38, '23333', '2025-05-09', '88888', '2025-05-24', '8888', '2025-05-24', '0494949494949', '2025-05-05 14:17:44', '2025-05-05 14:17:44'),
(22, 39, 'GN184590', '2027-10-10', '36/040453', '2011-08-11', '11', '2000-01-11', '0655486974', '2025-05-05 15:27:53', '2025-05-05 15:27:53'),
(23, 40, 'G12345', '2025-05-21', 'Fs24556', '2025-05-22', NULL, NULL, NULL, '2025-05-05 21:03:26', '2025-05-05 21:03:26'),
(24, 41, 'G12345', '2025-05-21', 'Fs24556', '2025-05-22', NULL, NULL, NULL, '2025-05-05 21:05:50', '2025-05-05 21:05:50'),
(25, 42, 'A485130', '2032-03-24', '01/130209', '2024-05-13', NULL, NULL, NULL, '2025-05-07 17:33:24', '2025-05-07 17:33:24'),
(26, 43, 'A485130', '2032-03-24', '01/130209', '2024-05-13', NULL, NULL, NULL, '2025-05-07 17:34:29', '2025-05-07 17:34:29'),
(27, 44, 'OD52199', '2027-11-29', '07/194174', '2020-01-02', NULL, NULL, NULL, '2025-05-08 12:30:04', '2025-05-08 12:30:04'),
(28, 53, '897345', NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-12 18:14:35', '2025-05-12 18:14:35'),
(29, 54, '2213456', '2025-05-12', '3366789', NULL, NULL, NULL, '087665544322', '2025-05-12 18:43:34', '2025-05-12 18:43:34'),
(30, 55, '75757', NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-14 20:31:20', '2025-05-14 20:31:20'),
(31, 56, 'GM216463', '2027-06-28', '26/046881', '2019-09-23', NULL, NULL, '07-08-76-81-12', '2025-05-15 14:49:44', '2025-05-15 14:49:44'),
(32, 57, '7474747', NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-15 15:22:25', '2025-05-15 15:22:25'),
(33, 58, 'OD52199', '2027-11-29', '07/194174', '2020-01-02', NULL, NULL, '06-24-17-76-99', '2025-05-15 16:02:31', '2025-05-15 16:02:31'),
(34, 59, 'Xa 55689', NULL, '47/030583', NULL, NULL, NULL, '06 61 10 22 06', '2025-05-15 19:30:27', '2025-05-15 19:30:27'),
(35, 60, 'X253757', NULL, '47/048509', NULL, NULL, NULL, '06 67 34 60 82', '2025-05-15 20:34:06', '2025-05-15 20:34:06'),
(36, 61, 'I280631', '2032-07-04', 'BG5798408X', '2019-10-20', NULL, NULL, NULL, '2025-05-16 00:49:25', '2025-05-16 00:49:25'),
(37, 62, 'I280631', '2032-07-04', 'BG5798408X', '2019-10-20', NULL, NULL, NULL, '2025-05-16 00:49:26', '2025-05-16 00:49:26'),
(38, 63, 'I280631', '2032-07-04', 'BG5798408X', '2019-10-20', NULL, NULL, NULL, '2025-05-16 00:49:27', '2025-05-16 00:49:27'),
(39, 64, 'I280631', '2032-07-04', 'BG5798408X', '2019-10-20', NULL, NULL, NULL, '2025-05-16 00:50:38', '2025-05-16 00:50:38'),
(40, 65, 'I280631', '2032-07-04', 'BG5798408X', '2019-10-20', NULL, NULL, NULL, '2025-05-16 00:51:31', '2025-05-16 00:51:31'),
(41, 66, 'I280631', '2032-07-04', 'BG5798408X', '2019-10-20', NULL, NULL, NULL, '2025-05-16 00:56:11', '2025-05-16 00:56:11'),
(42, 67, 'I280631', '2032-07-04', 'BG5798408X', '2019-10-20', NULL, NULL, NULL, '2025-05-16 00:56:32', '2025-05-16 00:56:32'),
(43, 68, 'IC35625', '2025-05-24', '38/124486', '2017-09-26', NULL, NULL, NULL, '2025-05-18 16:34:47', '2025-05-18 16:34:47'),
(44, 69, 'ER826823', '2026-07-17', '70288570_H', '2019-10-14', NULL, NULL, NULL, '2025-05-18 17:47:58', '2025-05-18 17:47:58'),
(45, 70, 'ER826823', '2026-07-17', '70288570_H', '2019-10-14', NULL, NULL, NULL, '2025-05-18 17:47:59', '2025-05-18 17:47:59'),
(46, 71, 'ER826823', '2026-07-17', '70288570_H', '2019-10-14', NULL, NULL, NULL, '2025-05-18 17:48:00', '2025-05-18 17:48:00'),
(47, 72, 'G625046', NULL, '07/166987', '2016-12-28', NULL, NULL, '06-80-08-29-58', '2025-05-19 16:32:01', '2025-05-19 16:32:01'),
(48, 73, 'G492937', '2033-11-16', '07/198266', '2020-09-18', NULL, NULL, '06-80-08-29-58', '2025-05-20 11:25:48', '2025-05-20 11:25:48'),
(49, 74, 'G492937', '2033-11-16', '07/198266', '2020-09-18', NULL, NULL, NULL, '2025-05-20 11:32:15', '2025-05-20 11:32:15'),
(50, 75, 'I280631', '2032-07-04', 'BG5798408X', '2019-10-20', NULL, NULL, NULL, '2025-05-20 23:43:56', '2025-05-20 23:43:56'),
(51, 76, 'AD309195', NULL, '49/168419', '2022-02-07', NULL, NULL, '06 84 56 06 19', '2025-05-21 18:26:37', '2025-05-21 18:26:37'),
(52, 77, 'G710891', '2032-01-19', '07/223955', '2022-07-21', NULL, NULL, NULL, '2025-05-21 18:42:31', '2025-05-21 18:42:31'),
(53, 78, 'G316200', '2033-09-25', '07/178122', '2018-03-21', NULL, NULL, NULL, '2025-05-23 00:55:14', '2025-05-23 00:55:14'),
(54, 79, 'AD332839', '2032-02-21', '07/190355', '2020-01-05', NULL, NULL, '06-10-39-17-11', '2025-05-23 09:38:52', '2025-05-23 09:38:52'),
(55, 80, 'EB202694', '2033-07-09', '60/034028', '2021-06-07', NULL, NULL, NULL, '2025-05-23 11:08:19', '2025-05-23 11:08:19'),
(56, 81, 'U000971G', '2025-11-25', '17/121306', '2022-02-23', NULL, NULL, NULL, '2025-05-23 21:03:57', '2025-05-23 21:03:57'),
(57, 82, 'U000971G', '2025-11-25', '17/121306', '2022-02-23', NULL, NULL, NULL, '2025-05-23 21:08:50', '2025-05-23 21:08:50'),
(58, 83, 'L331655', '2028-10-08', '12/081061', '2002-08-07', NULL, NULL, NULL, '2025-05-27 18:28:39', '2025-05-27 18:28:39'),
(59, 84, 'L331655', '2028-10-08', '12/081061', '2002-08-07', NULL, NULL, NULL, '2025-05-27 18:28:56', '2025-05-27 18:28:56'),
(60, 85, 'L331655', '2028-10-08', '12/081061', '2002-08-07', NULL, NULL, NULL, '2025-05-27 18:29:18', '2025-05-27 18:29:18'),
(61, 86, 'L331655', '2028-10-08', '12/081061', '2002-08-07', NULL, NULL, NULL, '2025-05-27 18:29:44', '2025-05-27 18:29:44'),
(62, 87, 'L331655', '2028-10-08', '12/081061', '2002-08-07', NULL, NULL, NULL, '2025-05-27 18:30:06', '2025-05-27 18:30:06'),
(63, 88, 'L331655', '2028-10-08', '12/081061', '2002-08-07', NULL, NULL, NULL, '2025-05-27 18:30:21', '2025-05-27 18:30:21'),
(64, 89, 'L331655', '2028-10-08', '12/081061', '2002-08-07', NULL, NULL, NULL, '2025-05-27 18:31:02', '2025-05-27 18:31:02'),
(65, 90, 'L331655', '2028-10-08', '12/081061', '2002-08-07', NULL, NULL, NULL, '2025-05-27 18:32:49', '2025-05-27 18:32:49'),
(66, 91, 'L331655', '2028-10-08', '12/081061', '2002-08-07', NULL, NULL, NULL, '2025-05-27 18:37:05', '2025-05-27 18:37:05'),
(67, 92, 'L331655', '2028-10-08', '12/081061', '2002-08-07', NULL, NULL, NULL, '2025-05-27 18:39:52', '2025-05-27 18:39:52');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
CREATE TABLE IF NOT EXISTS `vehicles` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `make_name` varchar(100) DEFAULT NULL,
  `model_name` varchar(100) DEFAULT NULL,
  `color_name` varchar(100) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `branch_id` int(10) UNSIGNED DEFAULT NULL,
  `lic_exp_date` date DEFAULT NULL,
  `reg_exp_date` date DEFAULT NULL,
  `vehicle_image` varchar(255) DEFAULT NULL,
  `engine_type` varchar(255) DEFAULT NULL,
  `horse_power` varchar(255) DEFAULT NULL,
  `vin` varchar(255) DEFAULT NULL,
  `license_plate` varchar(255) NOT NULL,
  `mileage` int(11) DEFAULT NULL,
  `in_service` tinyint(4) DEFAULT 0,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `int_mileage` int(11) DEFAULT NULL,
  `start_km` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `fuel_type` enum('Essence','Diesel') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicles_group_id_type_id_user_id_in_service_index` (`group_id`,`type_id`,`user_id`,`in_service`),
  KEY `vehicles_lic_exp_date_reg_exp_date_index` (`lic_exp_date`,`reg_exp_date`),
  KEY `vehicles_license_plate_index` (`license_plate`),
  KEY `vehicles_branch_id_foreign` (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `make_name`, `model_name`, `color_name`, `year`, `group_id`, `branch_id`, `lic_exp_date`, `reg_exp_date`, `vehicle_image`, `engine_type`, `horse_power`, `vin`, `license_plate`, `mileage`, `in_service`, `user_id`, `created_at`, `updated_at`, `deleted_at`, `int_mileage`, `start_km`, `type_id`, `fuel_type`) VALUES
(1, 'Tata', 'Punch', 'Red', '2015', 1, NULL, '2022-07-28', '2022-04-19', 'car1.png', 'Petrol', '190', '2342342', '9191bh', 45464, 1, 1, '2021-11-20 07:03:50', '2025-05-05 13:36:31', '2025-05-05 13:36:31', 50, NULL, 3, 'Essence'),
(2, 'Maruti', 'Suzuki', 'Blue', '2012', 1, NULL, '2022-11-20', '2022-02-18', 'car1.png', 'Petrol', '150', '124533', '1245ab', 45464, 1, 1, '2021-11-20 07:03:50', '2025-05-05 13:36:31', '2025-05-05 13:36:31', 40, NULL, 3, 'Diesel'),
(3, 'Tata', 'Punch', 'Red', '1999', 1, NULL, '2025-05-07', '2025-04-30', NULL, 'Petrol', '968888898', '67954', '96879', NULL, 0, 1, '2025-04-30 13:20:41', '2025-05-05 13:36:31', '2025-05-05 13:36:31', 4568, NULL, 2, 'Diesel'),
(4, 'asd', 'asd', 'Unknown', '2025', 1, NULL, '2026-05-04', '2026-05-04', NULL, 'Unknown', '0', 'TBD', '4345345', NULL, 1, NULL, '2025-05-04 15:45:38', '2025-05-05 13:36:31', '2025-05-05 13:36:31', 345, NULL, 1, 'Diesel'),
(5, 'peugeot', '208', 'gris', '2023', 1, NULL, '2033-06-20', '2028-06-20', NULL, 'Diesel', '6', 'WW15644', '23446/B/44', NULL, 1, 1, '2025-05-05 13:59:10', '2025-06-01 01:52:04', NULL, 104682, NULL, 2, 'Diesel'),
(6, 'peugeot', '208', 'gris', '1999', 1, NULL, '2025-05-15', '2025-05-13', NULL, 'Diesel', '55', '444', '23345ww', NULL, 1, 1, '2025-05-05 14:19:19', '2025-05-06 08:58:13', '2025-05-06 08:58:13', 444, NULL, 1, 'Diesel'),
(7, 'asdf', 'asdf', 'Unknown', '2025', 1, NULL, '2026-05-05', '2026-05-05', NULL, 'Unknown', '0', 'TBD', 'fasdf', NULL, 1, NULL, '2025-05-05 14:20:41', '2025-05-05 14:39:32', '2025-05-05 14:39:32', 2345, NULL, 1, 'Diesel'),
(8, 'renault', 'clio', 'noir', '2024', 1, NULL, '2034-06-28', '2029-05-02', NULL, 'Diesel', '6', 'ww345963', '25555/B/44', NULL, 1, 1, '2025-05-05 14:55:33', '2025-05-05 14:55:33', NULL, 58900, NULL, 2, 'Diesel'),
(9, 'renault', 'clio', 'noir', '2024', 1, NULL, '2034-06-28', '2029-05-02', NULL, 'Diesel', '6', '345962 ww', '25557/B/44', NULL, 1, 1, '2025-05-05 15:18:27', '2025-05-09 09:31:15', NULL, 80304, NULL, 2, 'Diesel'),
(10, 'renault', 'clio', 'noir', '2024', 1, NULL, '2034-06-28', '2029-05-02', NULL, 'Diesel', '6', '345966WW', '25554/B/44', NULL, 1, 1, '2025-05-05 16:01:51', '2025-05-22 11:16:39', NULL, 77217, NULL, 2, 'Diesel'),
(11, 'HYUNDAI', 'I20', 'gris', '2024', 1, NULL, '2034-07-04', '2029-05-15', NULL, 'Petrol', '6', '325574WW', '25672/B/44', NULL, 1, 1, '2025-05-05 16:16:49', '2025-05-09 09:29:49', NULL, 51272, NULL, 2, 'Essence'),
(12, 'HYUNDAI', 'I20', 'gris', '2024', 1, NULL, '2034-04-07', '2029-05-15', NULL, 'Petrol', '6', '325573', '25670/B/44', NULL, 1, 1, '2025-05-05 16:28:47', '2025-05-09 09:29:12', NULL, 31600, NULL, 2, 'Essence'),
(13, 'peugeot', '208', 'noir', '2024', 1, NULL, '2034-08-14', '2029-06-28', NULL, 'Petrol', '6', '395533', '26481/B/44', NULL, 1, 1, '2025-05-05 16:39:31', '2025-05-09 09:28:34', NULL, 47483, NULL, 2, 'Essence'),
(14, 'peugeot', '208', 'noir', '2024', 1, NULL, '2034-08-14', '2029-06-28', NULL, 'Diesel', '6', 'ww395534', '26470/B/44', NULL, 1, 1, '2025-05-06 09:43:46', '2025-05-09 09:27:59', NULL, 358000, NULL, 2, 'Diesel'),
(15, 'peugeot', '208', 'ROUGE', '2024', 1, NULL, '2034-08-14', '2029-06-28', NULL, 'Diesel', '6', 'WW395536', '26478/B/44', NULL, 1, 1, '2025-05-06 09:59:06', '2025-05-27 13:43:23', NULL, 88888, NULL, 2, 'Diesel'),
(16, 'peugeot', '208', 'noir', '2024', 1, NULL, '2034-08-28', '2028-06-20', NULL, 'Diesel', '6', 'WW169949', '21258/B/44', NULL, 1, 1, '2025-05-06 10:18:57', '2025-05-09 09:24:14', NULL, 59302, NULL, 2, 'Diesel'),
(17, 'peugeot', '208', 'gris', '2024', 1, NULL, '2034-08-28', '2028-06-20', NULL, 'Diesel', '6', 'WW169940', '21260/B/44', NULL, 1, 2, '2025-05-06 10:30:23', '2025-05-23 14:39:57', NULL, 140615, NULL, 2, 'Diesel'),
(18, 'HYUNDAI', 'ACCENT', 'gris', '2024', 1, NULL, '2034-08-28', '2028-06-20', NULL, 'Diesel', '6', 'WW179159', '21264/B/44', NULL, 1, 1, '2025-05-06 11:13:29', '2025-05-09 09:21:11', NULL, 15600, NULL, 2, 'Diesel'),
(19, 'HYUNDAI', 'ACCENT', 'gris', '2024', 1, NULL, '2034-08-28', '2028-06-20', NULL, 'Diesel', '6', 'WW179150', '21265/B/44', NULL, 1, 1, '2025-05-06 11:35:24', '2025-05-22 16:39:41', NULL, 75864, NULL, 2, 'Diesel'),
(20, 'HYUNDAI', 'ELANTRA HYBRID', 'gris', '2024', 1, NULL, '2034-02-27', '2029-01-08', NULL, 'Petrol', '9', 'WW267831', '23876/B/44', NULL, 1, 1, '2025-05-06 11:49:12', '2025-05-09 09:17:58', NULL, 73000, NULL, 2, 'Essence'),
(21, 'renault', 'clio', 'noir', '2024', 1, NULL, '2034-06-28', '2029-05-02', NULL, 'Diesel', '6', 'ww345962', '25551/B/44', NULL, 1, 1, '2025-05-06 14:23:28', '2025-05-09 09:05:34', NULL, 41000, NULL, 2, 'Diesel'),
(22, 'HYUNDAI', 'TUCSON', 'BLEU', '2024', 1, NULL, '2034-03-26', '2029-02-07', NULL, 'Diesel', '6', 'WW286586', '24339/B/44', NULL, 1, 1, '2025-05-06 15:25:28', '2025-05-09 09:03:02', NULL, 52000, NULL, 2, 'Diesel'),
(23, 'peugeot', '208', 'gris', '2024', 1, NULL, '2034-08-14', '2029-06-28', NULL, 'Diesel', '6', 'WW395531', '26478/B/44', NULL, 1, 1, '2025-05-06 15:38:05', '2025-05-19 12:49:38', NULL, 33086, NULL, 2, 'Diesel'),
(24, 'HYUNDAI', 'TUCSON', 'noir', '2024', 1, NULL, '2034-08-28', '2029-01-10', NULL, 'Diesel', '6', 'WW267832', '23885/B/44', NULL, 1, 1, '2025-05-06 15:44:48', '2025-05-08 09:10:20', NULL, 46993, NULL, 2, 'Diesel'),
(25, 'VOLKSWAGEN', 'TOUAREG', 'noir', '2024', 1, NULL, '2034-10-25', '2029-09-26', NULL, 'Diesel', '12', 'WW440885', '27571/B/44', NULL, 1, 1, '2025-05-06 15:51:37', '2025-05-06 15:52:28', NULL, 500, NULL, 2, 'Diesel');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles_meta`
--

DROP TABLE IF EXISTS `vehicles_meta`;
CREATE TABLE IF NOT EXISTS `vehicles_meta` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'null',
  `key` varchar(255) NOT NULL,
  `value` longtext DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicles_meta_vehicle_id_index` (`vehicle_id`),
  KEY `vehicles_meta_key_index` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=157 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `vehicles_meta`
--


-- --------------------------------------------------------

--
-- Table structure for table `vehicle_group`
--

DROP TABLE IF EXISTS `vehicle_group`;
CREATE TABLE IF NOT EXISTS `vehicle_group` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `note` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `vehicle_group`
--

INSERT INTO `vehicle_group` (`id`, `user_id`, `name`, `description`, `note`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Default', 'Default vehicle group', 'Default vehicle group', NULL, '2021-11-20 07:03:49', '2021-11-20 07:03:49');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_receptions`
--

DROP TABLE IF EXISTS `vehicle_receptions`;
CREATE TABLE IF NOT EXISTS `vehicle_receptions` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(10) UNSIGNED NOT NULL,
  `reception_date` datetime NOT NULL,
  `km_in` int(11) NOT NULL,
  `previous_km` int(11) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `branch_id` int(10) UNSIGNED DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `vehicle_id` (`vehicle_id`),
  KEY `user_id` (`user_id`),
  KEY `created_by` (`created_by`),
  KEY `vehicle_receptions_branch_id_foreign` (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_receptions`
--

INSERT INTO `vehicle_receptions` (`id`, `vehicle_id`, `reception_date`, `km_in`, `previous_km`, `notes`, `user_id`, `branch_id`, `created_by`, `created_at`, `updated_at`) VALUES
(4, 23, '2025-05-19 13:00:00', 33086, 19880, NULL, 2, NULL, 2, '2025-05-19 12:49:38', '2025-05-19 12:49:38'),
(5, 5, '2025-05-21 12:13:00', 104682, 101789, NULL, 56, NULL, 2, '2025-05-21 12:16:10', '2025-05-21 12:16:10'),
(6, 10, '2025-05-22 11:16:00', 77217, 76217, NULL, 53, NULL, 2, '2025-05-22 11:16:39', '2025-05-22 11:36:35'),
(7, 19, '2025-05-22 16:38:00', 75864, 65764, NULL, 73, NULL, 2, '2025-05-22 16:39:41', '2025-05-22 16:39:41'),
(8, 17, '2025-05-23 14:39:00', 140615, 136170, NULL, 76, NULL, 2, '2025-05-23 14:39:57', '2025-05-23 14:39:57');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_review`
--

DROP TABLE IF EXISTS `vehicle_review`;
CREATE TABLE IF NOT EXISTS `vehicle_review` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `reg_no` varchar(255) DEFAULT NULL,
  `kms_outgoing` int(11) DEFAULT NULL,
  `kms_incoming` int(11) DEFAULT NULL,
  `fuel_level_out` int(11) DEFAULT NULL,
  `fuel_level_in` int(11) DEFAULT NULL,
  `datetime_outgoing` datetime DEFAULT NULL,
  `datetime_incoming` datetime DEFAULT NULL,
  `petrol_card` text DEFAULT NULL,
  `lights` text DEFAULT NULL,
  `invertor` text DEFAULT NULL,
  `car_mats` text DEFAULT NULL,
  `int_damage` text DEFAULT NULL,
  `int_lights` text DEFAULT NULL,
  `ext_car` text DEFAULT NULL,
  `tyre` text DEFAULT NULL,
  `ladder` text DEFAULT NULL,
  `leed` text DEFAULT NULL,
  `power_tool` text DEFAULT NULL,
  `ac` text DEFAULT NULL,
  `head_light` text DEFAULT NULL,
  `lock` text DEFAULT NULL,
  `windows` text DEFAULT NULL,
  `condition` text DEFAULT NULL,
  `oil_chk` text DEFAULT NULL,
  `suspension` text DEFAULT NULL,
  `tool_box` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `udf` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicle_review_vehicle_id_user_id_index` (`vehicle_id`,`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `vehicle_review`
--


-- --------------------------------------------------------

--
-- Table structure for table `vehicle_transfers`
--

DROP TABLE IF EXISTS `vehicle_transfers`;
CREATE TABLE IF NOT EXISTS `vehicle_transfers` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(10) UNSIGNED NOT NULL,
  `from_branch_id` int(10) UNSIGNED NOT NULL,
  `to_branch_id` int(10) UNSIGNED NOT NULL,
  `transfer_date` date NOT NULL,
  `notes` text DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicle_transfers_vehicle_id_foreign` (`vehicle_id`),
  KEY `vehicle_transfers_from_branch_id_foreign` (`from_branch_id`),
  KEY `vehicle_transfers_to_branch_id_foreign` (`to_branch_id`),
  KEY `vehicle_transfers_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_types`
--

DROP TABLE IF EXISTS `vehicle_types`;
CREATE TABLE IF NOT EXISTS `vehicle_types` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vehicletype` varchar(255) DEFAULT NULL,
  `displayname` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `isenable` int(11) DEFAULT NULL,
  `seats` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `vehicle_types`
--

INSERT INTO `vehicle_types` (`id`, `vehicletype`, `displayname`, `icon`, `isenable`, `seats`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Hatchback', 'Hatchback', NULL, 1, 4, '2021-11-20 07:03:46', '2021-11-20 07:03:46', NULL),
(2, 'Sedan', 'Sedan', NULL, 1, 4, '2021-11-20 07:03:47', '2021-11-20 07:03:47', NULL),
(3, 'Mini van', 'Mini van', NULL, 1, 7, '2021-11-20 07:03:47', '2021-11-20 07:03:47', NULL),
(4, 'Saloon', 'Saloon', NULL, 1, 4, '2021-11-20 07:03:47', '2021-11-20 07:03:47', NULL),
(5, 'SUV', 'SUV', NULL, 1, 4, '2021-11-20 07:03:48', '2021-11-20 07:03:48', NULL),
(6, 'Bus', 'Bus', NULL, 1, 40, '2021-11-20 07:03:48', '2021-11-20 07:03:48', NULL),
(7, 'Truck', 'Truck', NULL, 1, 3, '2021-11-20 07:03:48', '2021-11-20 07:03:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

DROP TABLE IF EXISTS `vendors`;
CREATE TABLE IF NOT EXISTS `vendors` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `custom_type` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `udf` text DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vendors_type_index` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `vendors`
--


-- --------------------------------------------------------

--
-- Table structure for table `work_orders`
--

DROP TABLE IF EXISTS `work_orders`;
CREATE TABLE IF NOT EXISTS `work_orders` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `required_by` date DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `price` double(8,2) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `meter` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mechanic_id` int(11) DEFAULT NULL,
  `branch_id` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `work_orders_vehicle_id_vendor_id_index` (`vehicle_id`,`vendor_id`),
  KEY `work_orders_status_index` (`status`),
  KEY `work_orders_branch_id_foreign` (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `work_orders`
--


-- --------------------------------------------------------

--
-- Table structure for table `work_order_logs`
--

DROP TABLE IF EXISTS `work_order_logs`;
CREATE TABLE IF NOT EXISTS `work_order_logs` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `required_by` date DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `price` double(8,2) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `meter` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parts_price` double DEFAULT 0,
  `mechanic_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `work_order_logs_vehicle_id_vendor_id_index` (`vehicle_id`,`vendor_id`),
  KEY `work_order_logs_status_index` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `bookings_dropoff_branch_id_foreign` FOREIGN KEY (`dropoff_branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `bookings_pickup_branch_id_foreign` FOREIGN KEY (`pickup_branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `branch_distances`
--
ALTER TABLE `branch_distances`
  ADD CONSTRAINT `branch_distances_from_branch_id_foreign` FOREIGN KEY (`from_branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `branch_distances_to_branch_id_foreign` FOREIGN KEY (`to_branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `branch_settings`
--
ALTER TABLE `branch_settings`
  ADD CONSTRAINT `branch_settings_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contracts`
--
ALTER TABLE `contracts`
  ADD CONSTRAINT `contracts_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `contracts_dropoff_branch_id_foreign` FOREIGN KEY (`dropoff_branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `contracts_pickup_branch_id_foreign` FOREIGN KEY (`pickup_branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `expense`
--
ALTER TABLE `expense`
  ADD CONSTRAINT `expense_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `income`
--
ALTER TABLE `income`
  ADD CONSTRAINT `income_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reception_media`
--
ALTER TABLE `reception_media`
  ADD CONSTRAINT `reception_media_ibfk_1` FOREIGN KEY (`reception_id`) REFERENCES `vehicle_receptions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `user_clients`
--
ALTER TABLE `user_clients`
  ADD CONSTRAINT `fk_user_clients_user_id` FOREIGN KEY (`user_clients_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `vehicle_receptions`
--
ALTER TABLE `vehicle_receptions`
  ADD CONSTRAINT `vehicle_receptions_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `vehicle_receptions_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vehicle_receptions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vehicle_receptions_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `vehicle_transfers`
--
ALTER TABLE `vehicle_transfers`
  ADD CONSTRAINT `vehicle_transfers_from_branch_id_foreign` FOREIGN KEY (`from_branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vehicle_transfers_to_branch_id_foreign` FOREIGN KEY (`to_branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vehicle_transfers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vehicle_transfers_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `work_orders`
--
ALTER TABLE `work_orders`
  ADD CONSTRAINT `work_orders_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
