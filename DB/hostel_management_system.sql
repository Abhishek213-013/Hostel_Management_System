-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 11, 2025 at 06:58 PM
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
-- Database: `hostel_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admissions`
--

CREATE TABLE `admissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `bed_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `expected_leave_date` date DEFAULT NULL,
  `admission_floor_location` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `approved_by_user` bigint(20) UNSIGNED DEFAULT NULL,
  `created_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_logs`
--

CREATE TABLE `attendance_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `boarder_id` bigint(20) UNSIGNED NOT NULL,
  `attention` varchar(20) NOT NULL,
  `note` text DEFAULT NULL,
  `created_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `beds`
--

CREATE TABLE `beds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `bed_uid` varchar(50) DEFAULT NULL,
  `first_used_date` date DEFAULT NULL,
  `is_usable` tinyint(1) NOT NULL DEFAULT 1,
  `invoice_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `boarders`
--

CREATE TABLE `boarders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `common_maintype_info`
--

CREATE TABLE `common_maintype_info` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `position` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `description` text DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `last_modified_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `common_maintype_info`
--

INSERT INTO `common_maintype_info` (`id`, `name`, `slug`, `position`, `status`, `description`, `created_by`, `last_modified_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Gender', 'gender', 1, 1, 'Gender types for residents', 1, 1, '2025-12-10 03:08:48', '2025-12-10 04:55:17', NULL),
(2, 'Room Type', 'room-type', 2, 1, 'Different types of rooms available', 1, 1, '2025-12-10 03:08:48', '2025-12-10 03:08:48', NULL),
(3, 'Bed Type', 'bed-type', 3, 1, 'Types of beds in rooms', 1, 1, '2025-12-10 03:08:48', '2025-12-10 03:08:48', NULL),
(4, 'Payment Method', 'payment-method', 4, 1, 'Available payment methods', 1, 1, '2025-12-10 03:08:48', '2025-12-10 03:08:48', NULL),
(5, 'Complaint Type', 'complaint-type', 5, 1, 'Types of complaints', 1, 1, '2025-12-10 03:08:49', '2025-12-10 03:08:49', NULL),
(6, 'Attendance Status', 'attendance-status', 6, 1, 'Attendance status types', 1, 1, '2025-12-10 03:08:49', '2025-12-10 04:26:26', NULL),
(8, 'Meal Type', 'meal-type', 8, 1, 'Types of meals served', 1, 1, '2025-12-10 03:08:49', '2025-12-10 04:55:23', '2025-12-10 04:55:23'),
(9, 'Boarders', 'boarders', 3, 1, NULL, 1, 1, '2025-12-10 04:27:45', '2025-12-10 04:28:21', '2025-12-10 04:28:21');

-- --------------------------------------------------------

--
-- Table structure for table `common_type_info`
--

CREATE TABLE `common_type_info` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `position` decimal(10,4) NOT NULL DEFAULT 0.0000,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata`)),
  `update_count` int(11) NOT NULL DEFAULT 0,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `last_modified_by` bigint(20) UNSIGNED DEFAULT NULL,
  `last_modified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `common_type_info`
--

INSERT INTO `common_type_info` (`id`, `type_id`, `name`, `slug`, `position`, `status`, `metadata`, `update_count`, `created_by`, `last_modified_by`, `last_modified_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Male', 'male', 1.0000, 1, NULL, 0, 1, 1, NULL, '2025-12-10 03:08:49', '2025-12-10 03:08:49', NULL),
(2, 1, 'Female', 'female', 2.0000, 1, NULL, 0, 1, 1, NULL, '2025-12-10 03:08:49', '2025-12-10 03:08:49', NULL),
(4, 2, 'Single AC', 'single-ac', 1.0000, 1, NULL, 0, 1, 1, NULL, '2025-12-10 03:08:50', '2025-12-10 03:08:50', NULL),
(5, 2, 'Single Non-AC', 'single-non-ac', 2.0000, 1, NULL, 0, 1, 1, NULL, '2025-12-10 03:08:50', '2025-12-10 03:08:50', NULL),
(6, 2, 'Double AC', 'double-ac', 3.0000, 1, NULL, 0, 1, 1, NULL, '2025-12-10 03:08:50', '2025-12-10 03:08:50', NULL),
(7, 2, 'Double Non-AC', 'double-non-ac', 4.0000, 1, NULL, 0, 1, 1, NULL, '2025-12-10 03:08:50', '2025-12-10 03:08:50', NULL),
(8, 2, 'Deluxe AC', 'deluxe-ac', 5.0000, 1, NULL, 0, 1, 1, NULL, '2025-12-10 03:08:50', '2025-12-10 03:08:50', NULL),
(9, 2, 'Deluxe Non-AC', 'deluxe-non-ac', 6.0000, 1, NULL, 0, 1, 1, NULL, '2025-12-10 03:08:50', '2025-12-10 03:08:50', NULL),
(10, 3, 'Single Bed', 'single-bed', 1.0000, 1, NULL, 0, 1, 1, NULL, '2025-12-10 03:08:50', '2025-12-10 03:08:50', NULL),
(11, 3, 'Double Bed', 'double-bed', 2.0000, 1, NULL, 0, 1, 1, NULL, '2025-12-10 03:08:50', '2025-12-10 03:08:50', NULL),
(12, 3, 'Bunk Bed', 'bunk-bed', 3.0000, 1, NULL, 0, 1, 1, NULL, '2025-12-10 03:08:50', '2025-12-10 03:08:50', NULL),
(13, 3, 'Folding Bed', 'folding-bed', 4.0000, 1, NULL, 0, 1, 1, NULL, '2025-12-10 03:08:50', '2025-12-10 03:08:50', NULL),
(14, 4, 'Cash', 'cash', 1.0000, 1, NULL, 0, 1, 1, NULL, '2025-12-10 03:08:50', '2025-12-10 03:08:50', NULL),
(15, 4, 'bKash', 'bkash', 2.0000, 1, NULL, 0, 1, 1, NULL, '2025-12-10 03:08:50', '2025-12-10 03:08:50', NULL),
(16, 4, 'Nagad', 'nagad', 3.0000, 1, NULL, 0, 1, 1, NULL, '2025-12-10 03:08:50', '2025-12-10 03:08:50', NULL),
(17, 4, 'Bank Transfer', 'bank-transfer', 4.0000, 1, NULL, 0, 1, 1, NULL, '2025-12-10 03:08:50', '2025-12-10 03:08:50', NULL),
(18, 4, 'Credit Card', 'credit-card', 5.0000, 1, NULL, 0, 1, 1, NULL, '2025-12-10 03:08:50', '2025-12-10 03:08:50', NULL),
(19, 4, 'Debit Card', 'debit-card', 6.0000, 1, NULL, 0, 1, 1, NULL, '2025-12-10 03:08:51', '2025-12-10 03:08:51', NULL),
(20, 5, 'Maintenance', 'maintenance', 1.0000, 1, NULL, 0, 1, 1, NULL, '2025-12-10 03:08:51', '2025-12-10 03:08:51', NULL),
(21, 5, 'Cleanliness', 'cleanliness', 2.0000, 1, NULL, 0, 1, 1, NULL, '2025-12-10 03:08:51', '2025-12-10 03:08:51', NULL),
(22, 5, 'Food Quality', 'food-quality', 3.0000, 1, NULL, 0, 1, 1, NULL, '2025-12-10 03:08:51', '2025-12-10 03:08:51', NULL),
(23, 5, 'Noise Complaint', 'noise-complaint', 4.0000, 1, NULL, 0, 1, 1, NULL, '2025-12-10 03:08:51', '2025-12-10 03:08:51', NULL),
(24, 5, 'Security Issue', 'security-issue', 5.0000, 1, NULL, 0, 1, 1, NULL, '2025-12-10 03:08:51', '2025-12-10 03:08:51', NULL),
(25, 5, 'WiFi Issue', 'wifi-issue', 6.0000, 1, NULL, 0, 1, 1, NULL, '2025-12-10 03:08:51', '2025-12-10 03:08:51', NULL),
(26, 5, 'Water Issue', 'water-issue', 7.0000, 1, NULL, 0, 1, 1, NULL, '2025-12-10 03:08:51', '2025-12-10 03:08:51', NULL),
(27, 5, 'Electricity Issue', 'electricity-issue', 8.0000, 1, NULL, 0, 1, 1, NULL, '2025-12-10 03:08:51', '2025-12-10 03:08:51', NULL),
(28, 4, 'uPay', 'upay', 7.0000, 1, NULL, 0, 1, 1, NULL, '2025-12-10 04:08:47', '2025-12-10 04:16:02', '2025-12-10 04:16:02'),
(29, 2, 'Public Room', 'public-room', 7.0000, 0, NULL, 1, 1, 1, '2025-12-10 04:18:45', '2025-12-10 04:17:50', '2025-12-10 04:18:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `floors`
--

CREATE TABLE `floors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `floor_number` int(11) NOT NULL,
  `created_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_floors`
--

CREATE TABLE `inventory_floors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `inventory_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_items`
--

CREATE TABLE `inventory_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `inventory_id` bigint(20) UNSIGNED DEFAULT NULL,
  `used_by` bigint(20) UNSIGNED DEFAULT NULL,
  `used_at` datetime DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_uid` varchar(100) NOT NULL,
  `invoice_date` date NOT NULL,
  `invoice_effective_date` date DEFAULT NULL,
  `total` decimal(12,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `created_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `amount` decimal(12,2) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_12_10_054642_create_roles_table', 1),
(5, '2025_12_10_054658_modify_users_table_for_hostel_system', 1),
(6, '2025_12_10_054715_create_branches_table', 1),
(7, '2025_12_10_054731_create_floors_table', 1),
(8, '2025_12_10_054808_create_rooms_table', 1),
(9, '2025_12_10_054823_create_invoices_table', 1),
(10, '2025_12_10_054838_create_beds_table', 1),
(11, '2025_12_10_054854_create_admissions_table', 1),
(12, '2025_12_10_054909_create_boarders_table', 1),
(13, '2025_12_10_054924_create_invoice_items_table', 1),
(14, '2025_12_10_054938_create_payments_table', 1),
(15, '2025_12_10_054956_create_inventory_items_table', 1),
(16, '2025_12_10_055012_create_attendance_logs_table', 1),
(17, '2025_12_10_055029_create_inventory_floors_table', 1),
(18, '2025_12_10_085653_create_common_maintype_info_table', 1),
(19, '2025_12_10_085718_create_common_type_info_table', 1),
(20, '2025_12_10_170154_add_branch_id_to_users_table', 2),
(21, '2025_12_10_180548_add_profile_photo_path_to_users_table', 3),
(22, '2025_12_11_025551_add_dob_to_users_table', 4),
(23, '2025_12_11_025625_add_profile_picture_to_users_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `payment_uid` varchar(100) DEFAULT NULL,
  `amount` decimal(12,2) NOT NULL,
  `created_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'System Administrator', '2025-12-10 03:08:46', '2025-12-10 03:08:46'),
(2, 'Branch Manager', 'Branch Manager', '2025-12-10 03:08:46', '2025-12-10 03:08:46'),
(3, 'Accountant', 'Accountant', '2025-12-10 03:08:47', '2025-12-10 03:08:47'),
(4, 'Warden', 'Hostel Warden', '2025-12-10 03:08:47', '2025-12-10 03:08:47'),
(5, 'Resident', 'Hostel Resident', '2025-12-10 03:08:47', '2025-12-10 03:08:47');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `floor_id` bigint(20) UNSIGNED NOT NULL,
  `room_number` varchar(50) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `created_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('BQgrnAXAPiO03845nqR9f7hV58r4sjOhwiit8TRP', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:145.0) Gecko/20100101 Firefox/145.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoialIxbWs5V0hFRTljUXlvUzBGckl6bWFhSkEwUFFKMUNwS21zUnRzdyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hcGkvbWFpbi10eXBlcy9hY3RpdmUiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1765444939);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `address` text DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `profile_picture`, `dob`, `address`, `role_id`, `branch_id`, `created_id`) VALUES
(1, 'Administrator', 'admin@hostel.com', NULL, '$2y$12$ZV5z0sji3PHUbUKr5S5.turJA5BnwDHVSYH69kwNyDd3v6xeBp0Cq', NULL, '2025-12-10 03:08:47', '2025-12-11 02:09:37', '01842376477', 'profile_1765440576_administrator.jpeg', '2000-12-12', NULL, 1, NULL, NULL),
(2, 'Branch Manager', 'branchmanager@hostel.com', NULL, '$2y$12$m.Tn0lwuneYhAU37xSrY6.f3ur7Ky5Mge0CuTx9vCrJlcGEGwRHC2', NULL, '2025-12-10 11:13:47', '2025-12-10 23:42:18', '01234567890', 'profile_1765431736_branch_manager.jpeg', NULL, NULL, 2, NULL, 1),
(3, 'Accountant', 'acc@hostel.com', NULL, '$2y$12$lZMjeuLVtsuuKj0ATRD4kOCRYpoKcUneqESX1RdtHJ3EmHRWV00C.', NULL, '2025-12-10 11:24:56', '2025-12-11 00:01:35', '01312150423', 'profile_1765432895_accountant.jpeg', NULL, NULL, 3, NULL, 1),
(4, 'Second Admin', 'secAdmin@hostel.com', NULL, '$2y$12$g2bq0.RpbA5u9cqFQZroaepb13I0fiKdzbIUEzYuWZh5OAbS6FNAa', NULL, '2025-12-10 21:01:54', '2025-12-10 21:01:54', '01234567890', 'profile_1765422114_second_admin.jpeg', '2001-11-11', NULL, 1, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admissions`
--
ALTER TABLE `admissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admissions_invoice_id_foreign` (`invoice_id`),
  ADD KEY `admissions_bed_id_foreign` (`bed_id`),
  ADD KEY `admissions_approved_by_user_foreign` (`approved_by_user`),
  ADD KEY `admissions_created_id_foreign` (`created_id`);

--
-- Indexes for table `attendance_logs`
--
ALTER TABLE `attendance_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendance_logs_invoice_id_foreign` (`invoice_id`),
  ADD KEY `attendance_logs_boarder_id_foreign` (`boarder_id`),
  ADD KEY `attendance_logs_created_id_foreign` (`created_id`);

--
-- Indexes for table `beds`
--
ALTER TABLE `beds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beds_room_id_foreign` (`room_id`),
  ADD KEY `beds_invoice_id_foreign` (`invoice_id`),
  ADD KEY `beds_created_id_foreign` (`created_id`);

--
-- Indexes for table `boarders`
--
ALTER TABLE `boarders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `boarders_invoice_id_foreign` (`invoice_id`),
  ADD KEY `boarders_created_by_foreign` (`created_by`),
  ADD KEY `boarders_created_id_foreign` (`created_id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branches_created_id_foreign` (`created_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `common_maintype_info`
--
ALTER TABLE `common_maintype_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `common_maintype_info_slug_unique` (`slug`),
  ADD KEY `common_maintype_info_created_by_foreign` (`created_by`),
  ADD KEY `common_maintype_info_last_modified_by_foreign` (`last_modified_by`),
  ADD KEY `common_maintype_info_status_position_index` (`status`,`position`);

--
-- Indexes for table `common_type_info`
--
ALTER TABLE `common_type_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `common_type_info_type_id_slug_unique` (`type_id`,`slug`),
  ADD KEY `common_type_info_created_by_foreign` (`created_by`),
  ADD KEY `common_type_info_last_modified_by_foreign` (`last_modified_by`),
  ADD KEY `common_type_info_type_id_status_position_index` (`type_id`,`status`,`position`),
  ADD KEY `common_type_info_status_position_index` (`status`,`position`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `floors`
--
ALTER TABLE `floors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `floors_created_id_foreign` (`created_id`);

--
-- Indexes for table `inventory_floors`
--
ALTER TABLE `inventory_floors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventory_floors_inventory_id_foreign` (`inventory_id`),
  ADD KEY `inventory_floors_created_id_foreign` (`created_id`);

--
-- Indexes for table `inventory_items`
--
ALTER TABLE `inventory_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventory_items_invoice_item_id_foreign` (`invoice_item_id`),
  ADD KEY `inventory_items_inventory_id_foreign` (`inventory_id`),
  ADD KEY `inventory_items_used_by_foreign` (`used_by`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoices_invoice_uid_unique` (`invoice_uid`),
  ADD KEY `invoices_created_id_foreign` (`created_id`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_items_invoice_id_foreign` (`invoice_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_invoice_id_foreign` (`invoice_id`),
  ADD KEY `payments_created_id_foreign` (`created_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rooms_branch_id_foreign` (`branch_id`),
  ADD KEY `rooms_floor_id_foreign` (`floor_id`),
  ADD KEY `rooms_created_id_foreign` (`created_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`),
  ADD KEY `users_created_id_foreign` (`created_id`),
  ADD KEY `users_branch_id_foreign` (`branch_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admissions`
--
ALTER TABLE `admissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance_logs`
--
ALTER TABLE `attendance_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `beds`
--
ALTER TABLE `beds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `boarders`
--
ALTER TABLE `boarders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `common_maintype_info`
--
ALTER TABLE `common_maintype_info`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `common_type_info`
--
ALTER TABLE `common_type_info`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `floors`
--
ALTER TABLE `floors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_floors`
--
ALTER TABLE `inventory_floors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_items`
--
ALTER TABLE `inventory_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admissions`
--
ALTER TABLE `admissions`
  ADD CONSTRAINT `admissions_approved_by_user_foreign` FOREIGN KEY (`approved_by_user`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `admissions_bed_id_foreign` FOREIGN KEY (`bed_id`) REFERENCES `beds` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `admissions_created_id_foreign` FOREIGN KEY (`created_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `admissions_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attendance_logs`
--
ALTER TABLE `attendance_logs`
  ADD CONSTRAINT `attendance_logs_boarder_id_foreign` FOREIGN KEY (`boarder_id`) REFERENCES `boarders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attendance_logs_created_id_foreign` FOREIGN KEY (`created_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `attendance_logs_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `beds`
--
ALTER TABLE `beds`
  ADD CONSTRAINT `beds_created_id_foreign` FOREIGN KEY (`created_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `beds_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `beds_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `boarders`
--
ALTER TABLE `boarders`
  ADD CONSTRAINT `boarders_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `boarders_created_id_foreign` FOREIGN KEY (`created_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `boarders_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `branches`
--
ALTER TABLE `branches`
  ADD CONSTRAINT `branches_created_id_foreign` FOREIGN KEY (`created_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `common_maintype_info`
--
ALTER TABLE `common_maintype_info`
  ADD CONSTRAINT `common_maintype_info_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `common_maintype_info_last_modified_by_foreign` FOREIGN KEY (`last_modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `common_type_info`
--
ALTER TABLE `common_type_info`
  ADD CONSTRAINT `common_type_info_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `common_type_info_last_modified_by_foreign` FOREIGN KEY (`last_modified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `common_type_info_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `common_maintype_info` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `floors`
--
ALTER TABLE `floors`
  ADD CONSTRAINT `floors_created_id_foreign` FOREIGN KEY (`created_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `inventory_floors`
--
ALTER TABLE `inventory_floors`
  ADD CONSTRAINT `inventory_floors_created_id_foreign` FOREIGN KEY (`created_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `inventory_floors_inventory_id_foreign` FOREIGN KEY (`inventory_id`) REFERENCES `inventory_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `inventory_items`
--
ALTER TABLE `inventory_items`
  ADD CONSTRAINT `inventory_items_inventory_id_foreign` FOREIGN KEY (`inventory_id`) REFERENCES `inventory_items` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `inventory_items_invoice_item_id_foreign` FOREIGN KEY (`invoice_item_id`) REFERENCES `invoice_items` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `inventory_items_used_by_foreign` FOREIGN KEY (`used_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_created_id_foreign` FOREIGN KEY (`created_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD CONSTRAINT `invoice_items_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_created_id_foreign` FOREIGN KEY (`created_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `payments_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rooms_created_id_foreign` FOREIGN KEY (`created_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `rooms_floor_id_foreign` FOREIGN KEY (`floor_id`) REFERENCES `floors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_created_id_foreign` FOREIGN KEY (`created_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
