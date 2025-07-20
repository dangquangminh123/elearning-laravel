-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 20, 2025 at 11:12 PM
-- Server version: 8.0.42
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Lập trình backend', 'lap-trinh-backend', 0, '2025-06-30 22:10:41', '2025-06-30 22:10:41'),
(2, 'Lập trình php', 'lap-trinh-php', 1, '2025-06-30 22:10:49', '2025-06-30 22:10:49'),
(3, 'Lập trình laravel', 'lap-trinh-laravel', 1, '2025-06-30 22:10:56', '2025-06-30 22:10:56'),
(4, 'Lập trình server', 'lap-trinh-server', 1, '2025-06-30 22:11:12', '2025-06-30 22:11:12');

-- --------------------------------------------------------

--
-- Table structure for table `categories_courses`
--

CREATE TABLE `categories_courses` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` int UNSIGNED NOT NULL,
  `course_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int UNSIGNED NOT NULL,
  `code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_type` enum('percent','value') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'percent',
  `discount_value` int NOT NULL DEFAULT '0',
  `total_condition` int DEFAULT NULL,
  `count` int DEFAULT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `discount_type`, `discount_value`, `total_condition`, `count`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 'QDH8UFBMA2', 'percent', 40, NULL, 3, '2025-07-17 14:00:01', '2025-07-24 14:00:06', '2025-07-11 21:04:44', '2025-07-11 21:04:44'),
(2, 'L1PFP422IK', 'value', 124392, NULL, 2, '2025-07-15 14:06:43', '2025-07-18 14:06:50', '2025-07-11 21:04:44', '2025-07-11 21:04:44'),
(3, 'K2SRSMDP2P', 'value', 280199, NULL, 4, '2025-07-14 14:06:53', '2025-07-18 14:06:57', '2025-07-11 21:04:44', '2025-07-11 21:04:44'),
(4, 'E9U3YAVYWX', 'percent', 31, NULL, 1, '2025-07-23 14:07:00', '2025-07-26 14:07:03', '2025-07-11 21:04:44', '2025-07-11 21:04:44'),
(5, '3U47YZY6NT', 'percent', 14, NULL, 5, '2025-07-20 14:07:08', '2025-07-23 14:07:11', '2025-07-11 21:04:44', '2025-07-11 21:04:44'),
(6, 'F79FJ0ETHB', 'value', 111555, NULL, 4, '2025-07-23 14:07:37', '2025-07-25 14:07:49', '2025-07-11 21:04:44', '2025-07-11 21:04:44'),
(7, '9P9QZECICG', 'percent', 25, NULL, 3, '2025-07-21 14:07:52', '2025-07-24 14:07:55', '2025-07-11 21:04:44', '2025-07-11 21:04:44'),
(8, '0FSACNUEBU', 'value', 107790, NULL, 2, '2025-07-21 14:07:59', '2025-07-24 14:08:02', '2025-07-11 21:04:44', '2025-07-11 21:04:44'),
(9, '7FRIU4WTPC', 'value', 190329, NULL, 3, '2025-07-27 14:08:06', '2025-07-30 14:08:10', '2025-07-11 21:04:44', '2025-07-11 21:04:44'),
(10, '2W65BKZD4P', 'percent', 14, NULL, 1, '2025-07-20 14:08:12', '2025-07-23 14:08:16', '2025-07-11 21:04:44', '2025-07-11 21:04:44'),
(11, 'GF0FGYWOP5', 'percent', 3, 180000, 3, '2025-07-19 17:00:00', '2025-07-22 17:00:00', '2025-07-19 11:33:06', '2025-07-19 11:33:06');

-- --------------------------------------------------------

--
-- Table structure for table `coupons_courses`
--

CREATE TABLE `coupons_courses` (
  `id` int UNSIGNED NOT NULL,
  `coupon_id` int UNSIGNED NOT NULL,
  `course_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupons_students`
--

CREATE TABLE `coupons_students` (
  `id` int UNSIGNED NOT NULL,
  `coupon_id` int UNSIGNED NOT NULL,
  `student_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupons_usage`
--

CREATE TABLE `coupons_usage` (
  `id` int UNSIGNED NOT NULL,
  `coupon_id` int UNSIGNED DEFAULT NULL,
  `order_id` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci,
  `teacher_id` int UNSIGNED NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(11,2) NOT NULL DEFAULT '0.00',
  `sale_price` double(11,2) NOT NULL DEFAULT '0.00',
  `code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `durations` double(8,2) NOT NULL DEFAULT '0.00',
  `is_document` tinyint(1) NOT NULL DEFAULT '0',
  `supports` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `view` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` double(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `name`, `url`, `size`, `created_at`, `updated_at`) VALUES
(1, 'Dang-Quang-Minh-TopCV.vn-021224.173451.pdf', '/storage/documents/1/Dang-Quang-Minh-TopCV.vn-021224.173451.pdf', 185046.00, '2025-06-30 22:15:10', '2025-06-30 22:15:10'),
(2, 'CV minh DANG QUANG - php_ENGLISH-TopCV.vn.pdf.pdf', '/storage/documents/1/CV minh DANG QUANG - php_ENGLISH-TopCV.vn.pdf.pdf', 174963.00, '2025-06-30 22:15:48', '2025-06-30 22:15:48'),
(3, 'Dang-Quang-Minh-TopCV.vn-021224.173424.pdf', '/storage/documents/1/Dang-Quang-Minh-TopCV.vn-021224.173424.pdf', 377856.00, '2025-07-01 01:09:26', '2025-07-01 01:09:26');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_id` int UNSIGNED DEFAULT NULL,
  `course_id` int UNSIGNED DEFAULT NULL,
  `document_id` int UNSIGNED DEFAULT NULL,
  `parent_id` int UNSIGNED DEFAULT NULL,
  `is_trial` tinyint(1) NOT NULL DEFAULT '0',
  `view` int NOT NULL DEFAULT '0',
  `position` int NOT NULL DEFAULT '0',
  `durations` double(8,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(15, '2014_10_12_000000_create_users_table', 1),
(16, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(17, '2014_10_12_100000_create_password_resets_table', 1),
(18, '2019_08_19_000000_create_failed_jobs_table', 1),
(19, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(20, '2025_06_08_123650_create_products_table', 1),
(21, '2025_06_13_203916_categories', 1),
(22, '2025_06_21_122632_create_courses_table', 1),
(23, '2025_06_23_055749_create_categories_courses_table', 1),
(24, '2025_06_24_140507_create_teacher_table', 1),
(25, '2025_06_24_172441_add_foreign_courses', 1),
(26, '2025_06_27_170204_create_video_table', 1),
(27, '2025_06_27_224932_create_documents_table', 1),
(29, '2025_07_01_081603_create_students_table', 2),
(30, '2025_07_02_082000_add_view_column_courses_table', 3),
(31, '2025_06_27_225858_create_lessons_table', 4),
(32, '2025_07_04_222201_add_status_column_lessions_table', 4),
(33, '2025_07_05_002316_add_remember_token_column_students_table', 5),
(34, '2025_07_06_025000_add_email_verified_at_column_users_table', 6),
(35, '2025_07_06_052217_create_jobs_table', 7),
(36, '2025_07_06_063326_create_password_resets_table', 8),
(37, '2025_07_08_112033_create_students_courses_table', 9),
(41, '2025_07_09_111803_create_orders_status_table', 10),
(42, '2025_07_09_111804_create_orders_table', 10),
(43, '2025_07_09_162903_create_orders_detail_table', 10),
(44, '2025_07_10_114720_add_payment_date_column_orders_table', 11),
(45, '2025_07_12_020000_create_coupons_table', 12),
(46, '2025_07_12_033010_create_coupons_usage_table', 12),
(47, '2025_07_12_034117_create_coupons_courses_table', 12),
(48, '2025_07_12_034719_create_coupons_students_table', 12),
(49, '2025_07_12_123237_add_discount_column_orders_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int UNSIGNED NOT NULL,
  `student_id` int UNSIGNED DEFAULT NULL,
  `total` double(10,2) NOT NULL DEFAULT '0.00',
  `discount` int NOT NULL DEFAULT '0',
  `coupon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_id` int UNSIGNED DEFAULT NULL,
  `payment_date` timestamp NULL DEFAULT NULL,
  `payment_complete_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

CREATE TABLE `orders_detail` (
  `id` int UNSIGNED NOT NULL,
  `order_id` int UNSIGNED NOT NULL,
  `course_id` int UNSIGNED DEFAULT NULL,
  `price` double(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders_status`
--

CREATE TABLE `orders_status` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_success` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders_status`
--

INSERT INTO `orders_status` (`id`, `name`, `color`, `is_success`, `created_at`, `updated_at`) VALUES
(1, 'Chờ thanh toán', 'danger', 0, NULL, NULL),
(2, 'Đã thanh toán', 'success', 1, NULL, NULL),
(3, 'Thanh toán bất bại', 'danger', 0, NULL, NULL),
(4, 'Hủy thanh toán', 'danger', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `content` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `phone`, `password`, `address`, `status`, `remember_token`, `email_verified_at`, `created_at`, `updated_at`) VALUES
(9, 'Đặng Quang minh', 'dangquangminhdn76@gmail.com', '0989850682', '$2y$12$U2VTNDxCarWMsz/70KpQ5OsMm3dSA6UOyYIuCTurkkOZP.8mkSsU.', '338 trịnh đình trọng phường hoà thạnh tân phú', 1, 'KcZbUVASuydcDF7nXB1EPxo5aLSS0Sy3IUALMnfme70AHEbHrCzJNPnoM1a5', '2025-07-07 19:31:48', '2025-07-07 19:31:42', '2025-07-09 21:11:19');

-- --------------------------------------------------------

--
-- Table structure for table `students_courses`
--

CREATE TABLE `students_courses` (
  `id` int UNSIGNED NOT NULL,
  `student_id` int UNSIGNED NOT NULL,
  `course_id` int UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_password_resets`
--

CREATE TABLE `student_password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_zalo` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `exp` int DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `name`, `slug`, `phone_zalo`, `description`, `exp`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Hoàng An', 'hoang-an', '9824105032', '<p>Thầy ho&agrave;ng an dạy chuy&ecirc;n php laravel</p>', 3, '/storage/photos/1/image1.jpeg', '2025-06-30 22:11:53', '2025-06-30 22:11:53'),
(2, 'Tú nhi', 'tu-nhi', '0982849156', '<p>C&ocirc; nhi dạy tiếng anh</p>', 1, '/storage/photos/1/hinh1.png', '2025-06-30 22:12:25', '2025-06-30 22:12:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_id` int NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `group_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Hoàng An', 'hoangan@gmail.com', 1, NULL, '$2y$10$wPVls4vZKuW8/HVLQAC9feyBTjdZIM3qpSVr.mXEA7hXU/sKrDnb6', NULL, '2025-07-01 00:40:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` double(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `name`, `url`, `size`, `created_at`, `updated_at`) VALUES
(1, 'ami1.mp4', '/storage/videos/1/ami1.mp4', 21.21, '2025-06-30 22:15:10', '2025-06-30 22:15:10'),
(2, 'video1.mp4', '/storage/videos/1/video1.mp4', 60.48, '2025-07-01 01:07:55', '2025-07-01 01:07:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories_courses`
--
ALTER TABLE `categories_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_courses_category_id_foreign` (`category_id`),
  ADD KEY `categories_courses_course_id_foreign` (`course_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

--
-- Indexes for table `coupons_courses`
--
ALTER TABLE `coupons_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupons_courses_coupon_id_foreign` (`coupon_id`),
  ADD KEY `coupons_courses_course_id_foreign` (`course_id`);

--
-- Indexes for table `coupons_students`
--
ALTER TABLE `coupons_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupons_students_coupon_id_foreign` (`coupon_id`),
  ADD KEY `coupons_students_student_id_foreign` (`student_id`);

--
-- Indexes for table `coupons_usage`
--
ALTER TABLE `coupons_usage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupons_usage_coupon_id_foreign` (`coupon_id`),
  ADD KEY `coupons_usage_order_id_foreign` (`order_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_teacher_id_foreign` (`teacher_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lessons_video_id_foreign` (`video_id`),
  ADD KEY `lessons_document_id_foreign` (`document_id`),
  ADD KEY `lessons_parent_id_foreign` (`parent_id`),
  ADD KEY `lessons_course_id_foreign` (`course_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_status_id_foreign` (`status_id`),
  ADD KEY `orders_student_id_foreign` (`student_id`);

--
-- Indexes for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_detail_course_id_foreign` (`course_id`),
  ADD KEY `orders_detail_order_id_foreign` (`order_id`);

--
-- Indexes for table `orders_status`
--
ALTER TABLE `orders_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_email_unique` (`email`);

--
-- Indexes for table `students_courses`
--
ALTER TABLE `students_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `students_courses_student_id_foreign` (`student_id`),
  ADD KEY `students_courses_course_id_foreign` (`course_id`);

--
-- Indexes for table `student_password_resets`
--
ALTER TABLE `student_password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories_courses`
--
ALTER TABLE `categories_courses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `coupons_courses`
--
ALTER TABLE `coupons_courses`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupons_students`
--
ALTER TABLE `coupons_students`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupons_usage`
--
ALTER TABLE `coupons_usage`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders_detail`
--
ALTER TABLE `orders_detail`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders_status`
--
ALTER TABLE `orders_status`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `students_courses`
--
ALTER TABLE `students_courses`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories_courses`
--
ALTER TABLE `categories_courses`
  ADD CONSTRAINT `categories_courses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `categories_courses_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `coupons_courses`
--
ALTER TABLE `coupons_courses`
  ADD CONSTRAINT `coupons_courses_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coupons_courses_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `coupons_students`
--
ALTER TABLE `coupons_students`
  ADD CONSTRAINT `coupons_students_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coupons_students_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `coupons_usage`
--
ALTER TABLE `coupons_usage`
  ADD CONSTRAINT `coupons_usage_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coupons_usage_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `lessons_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `lessons_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lessons_video_id_foreign` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `orders_status` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD CONSTRAINT `orders_detail_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_detail_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students_courses`
--
ALTER TABLE `students_courses`
  ADD CONSTRAINT `students_courses_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `students_courses_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
