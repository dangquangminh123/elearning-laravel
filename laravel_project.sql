-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 20, 2025 at 04:05 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `parent_id`, `created_at`, `updated_at`) VALUES
(2, 'tiếng anh mới bắt đầu', 'tieng-anh-moi-bat-dau', 0, '2025-06-13 22:36:43', '2025-06-13 22:36:43'),
(4, 'Tiếng anh cơ bản', 'tieng-anh-co-ban', 0, '2025-06-14 04:36:03', '2025-06-14 04:36:03'),
(5, 'Tiếng anh nâng cao', 'tieng-anh-nang-cao', 0, '2025-06-14 04:36:15', '2025-06-14 04:36:15'),
(6, 'Tiếng anh giao tiếp', 'tieng-anh-giao-tiep', 4, '2025-06-14 04:36:22', '2025-06-14 04:36:45');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_06_08_123650_create_products_table', 1),
(6, '2025_06_13_203916_categories', 2);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
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
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `content` mediumtext NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `group_id` int(11) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `group_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Hoàng An', 'hoangan.web@gmail.com', 1, NULL, '$2y$12$gMeAvwGyCf7QU6plKoxE/u83BpWYgNBq4upQ4Phs/7utnfkLu0vNW', NULL, '2025-06-11 10:09:46', '2025-06-11 10:09:46'),
(2, 'người dùng php', 'php@gmail.com', 1, NULL, '$2y$12$/5HgqLAnvZKtzt/OmafPReqrX1IVrE65LkCL1EI4jZZbHRnz2iIWG', NULL, '2025-06-12 05:05:56', '2025-06-12 05:05:56'),
(3, 'người dùng laravel', 'laravel@gmail.com', 1, NULL, '$2y$12$Kxf0PC0m6XSvb8zw51BmxOHCda.x.KzAfwwQ7AmRcDaR4jfmRCyAG', NULL, '2025-06-12 05:09:39', '2025-06-12 05:09:39'),
(4, 'người dùng nodejs', 'nodejs@gmail.com', 1, NULL, '$2y$12$bON0s6Ml5I/h7BjUjDie..Yssgn6RMMUtuEvFr/TgxWCbBJkhLjOO', NULL, '2025-06-12 05:22:39', '2025-06-12 05:22:39'),
(5, 'Prof. Margret Runolfsson', 'ibrown@hotmail.com', 1, NULL, '$2y$12$UNuqz6GetJcDokY6GDXVOeul0VTwcF1aKzOMqaazXBSMzwZG7DJAW', NULL, '2025-06-12 06:25:58', '2025-06-12 06:25:58'),
(6, 'Dr. Rhea Rau II', 'twunsch@ankunding.com', 1, NULL, '$2y$12$qlu0lTW3ffUadAn0gf2nc.XsKECEKv3REXzYjIsce/gL2RLa3Ybuq', NULL, '2025-06-12 06:25:58', '2025-06-12 06:25:58'),
(7, 'Norbert Beahan', 'alexanne.spinka@yahoo.com', 1, NULL, '$2y$12$H9OjlSxalawrXZ6gArCPse.YPOIrklTEyPFFrFocuE8WEFTIsmmSO', NULL, '2025-06-12 06:25:58', '2025-06-12 06:25:58'),
(8, 'Yadira Beer', 'cmraz@balistreri.com', 1, NULL, '$2y$12$aNkgf2k7y2oWjmxt7U/dpeGRc5u5NZJ6qq8mescvNAX/wOZUZV7H6', NULL, '2025-06-12 06:25:58', '2025-06-12 06:25:58'),
(9, 'Karl Rath', 'ellie34@yahoo.com', 1, NULL, '$2y$12$jcyHgoFXIfcbuQAo3Hs3Wu8viEdam8RFKHYb97vf1BZRZsoqsNilq', NULL, '2025-06-12 06:25:59', '2025-06-12 06:25:59'),
(10, 'Lelah Tillman II', 'mruecker@gmail.com', 1, NULL, '$2y$12$R9Kim7cIvTAwmwFNGpzi.OBK8LztMF.ttAKwEHitusuUu5DtDzAA.', NULL, '2025-06-12 06:25:59', '2025-06-12 06:25:59'),
(11, 'Dr. Geo Keebler', 'jensen95@dickinson.biz', 1, NULL, '$2y$12$U/./q4WI.kdoWdx.Idw9.ezmU8VlcowsEdMOIRXulT.OvJigKWy/m', NULL, '2025-06-12 06:25:59', '2025-06-12 06:25:59'),
(12, 'Mrs. Kira Donnelly', 'zwuckert@gmail.com', 1, NULL, '$2y$12$HjGA8DCBxKc7wz0Pxl9tMOIn5Bq7HdLkQrX.llQXSwDp6h6e4CtVa', NULL, '2025-06-12 06:25:59', '2025-06-12 06:25:59'),
(13, 'Trey Schmidt II', 'kiehn.briana@shields.com', 1, NULL, '$2y$12$wQuECRvsxd6T9e21GO9preGe561H14gEi1a6E746HHTFYYwu6bFGS', NULL, '2025-06-12 06:26:00', '2025-06-12 06:26:00'),
(15, 'Colt Hahn', 'johanna.wehner@stanton.com', 1, NULL, '$2y$12$i79X/9DQUe0ttmdODzrmMe2fnh7m1DvpEmhJSR.GeiG7zxTx/kOH2', NULL, '2025-06-12 06:26:00', '2025-06-12 06:26:00'),
(16, 'Derrick Hermann IV', 'klocko.fernando@kilback.com', 1, NULL, '$2y$12$LxCIjIzURRd8Qlf8JLbFfOuL3GZBuBahRaRSYA6/4XEb2uIeu9cTS', NULL, '2025-06-12 06:26:00', '2025-06-12 06:26:00'),
(17, 'Kathlyn Brown I', 'vallie.armstrong@gmail.com', 1, NULL, '$2y$12$rwfrIkWV1iaJccVQ9jAIjOoqS1BsADIyElW0zPw5gUe0Lc.xZELkK', NULL, '2025-06-12 06:26:00', '2025-06-12 06:26:00'),
(18, 'Mr. Akeem Ebert DVM', 'emerson.tillman@larson.com', 1, NULL, '$2y$12$tOLETeQ4gjiGsnWEgv.k8Om2RUfjUrKS/96/TMyiIXV5U0siq703.', NULL, '2025-06-12 06:26:01', '2025-06-12 06:26:01'),
(19, 'Raphael Zulauf', 'norval.hamill@gmail.com', 1, NULL, '$2y$12$F2WmzfT3Q9W5FeFVMZ6YOOf1vxC1znpDoS9cgzBk/outG1ra29SlW', NULL, '2025-06-12 06:26:01', '2025-06-12 06:26:01'),
(20, 'Joey Schuppe', 'mozelle38@volkman.biz', 1, NULL, '$2y$12$nencxJl5Et1KJXaaCgqEKeyiAyw.VZIOxLc2hxKIafQVCPQqj7uAK', NULL, '2025-06-12 06:26:01', '2025-06-12 06:26:01'),
(21, 'Miss Clotilde Weber DDS', 'tressa.okeefe@kuhn.org', 1, NULL, '$2y$12$QgST79x5ZPt2K7Qskfn5ued5QeAxNerZhFA6UiihW8LDKGT5phoaK', NULL, '2025-06-12 06:26:01', '2025-06-12 06:26:01'),
(22, 'Mrs. Kaycee Swift', 'davis.magdalena@hotmail.com', 1, NULL, '$2y$12$USzF1P9KUGFvtwjQjyXTL.VPCV4akYkNa8JJ/Y3tKxW/rJf/ED0MG', NULL, '2025-06-12 06:26:01', '2025-06-12 06:26:01'),
(23, 'Aurore Lind', 'hroob@hotmail.com', 1, NULL, '$2y$12$vZN6l6cv3ajH3SIag8LgB.2hRzCmHgBxXOvMyU/Ic4YL9HC/uJOgO', NULL, '2025-06-12 06:26:02', '2025-06-12 06:26:02'),
(24, 'Dr. Tanner Lebsack MD', 'kelley.reichert@yahoo.com', 1, NULL, '$2y$12$TRhURMJQqgqUtflLz1LhQ.NGQIxGOfxhEO24.crJrzmD2C6aZTDEK', NULL, '2025-06-12 06:26:02', '2025-06-12 06:26:02'),
(25, 'Mrs. Celestine Bauch MD', 'zparker@jast.net', 1, NULL, '$2y$12$tmB1/Ejytx.N.qw08/mPf.F9wbzYxOxsC6lg2POOLCVDk9gASB0Ma', NULL, '2025-06-12 06:26:02', '2025-06-12 06:26:02'),
(26, 'Norris Cole', 'mertz.lolita@hotmail.com', 1, NULL, '$2y$12$ou9Sj7FbgmWsTJQLFIyexOOzNyaaVyIG7BqOwDd8MMFEOpkQbltEa', NULL, '2025-06-12 06:26:02', '2025-06-12 06:26:02'),
(27, 'Josefa Fadel', 'clarabelle72@hotmail.com', 1, NULL, '$2y$12$SmDejrnBrnhUyffnbkebfeDkXxS7pzijbivREhRhEgaurL.r5M29C', NULL, '2025-06-12 06:26:02', '2025-06-12 06:26:02'),
(28, 'Eula Mueller DVM', 'mollie.zulauf@hotmail.com', 1, NULL, '$2y$12$KnnV8bbtAIFwEbdPsSDyquPZ/zxu.j7a3CNpg9n7BOtrO1OP2g7uS', NULL, '2025-06-12 06:26:03', '2025-06-12 06:26:03'),
(29, 'Eulalia Grady III', 'legros.juanita@gmail.com', 1, NULL, '$2y$12$AGNDg1E.5CgXuYOwDX870ecVsqKxEdMSHHKytzy8T1Vg2nRV9Ac02', NULL, '2025-06-12 06:26:03', '2025-06-12 06:26:03'),
(30, 'Corine Hammes', 'hilda.lakin@hotmail.com', 1, NULL, '$2y$12$loLbZYQfqWpnZFS2eYUjMum0p8pXuPYChvLoXjDx1kI6hTQUinYM6', NULL, '2025-06-12 06:26:03', '2025-06-12 06:26:03'),
(31, 'Mrs. Antonetta Nicolas', 'chelsey81@yahoo.com', 1, NULL, '$2y$12$e7ftnQhiKC3hltU7U.maKOrqDcOJ4UDOWyNHmC4vgRIfqbgcWhGCK', NULL, '2025-06-12 06:26:03', '2025-06-12 06:26:03'),
(32, 'Vernie Crist', 'gilbert.corwin@gmail.com', 1, NULL, '$2y$12$8BRBio.5E62uLSWJDBgIEOkPKx38eAt6rd5MgRiAn6KQGXgUpRtz6', NULL, '2025-06-12 06:26:03', '2025-06-12 06:26:03'),
(33, 'Dr. Jaleel King', 'crona.baylee@predovic.com', 1, NULL, '$2y$12$KbhO01.2xZ4yJK4k.e9UHuSCPvWvmhUT4hlAus4kdl.nX/ZafmauC', NULL, '2025-06-12 06:26:03', '2025-06-12 06:26:03'),
(34, 'Dr. Astrid Nader', 'jast.ava@wehner.biz', 1, NULL, '$2y$12$5TDVwqx.pGnvckhH/JpV1.sIg35JinuMiSam/jGRK64BGbasDPWCO', NULL, '2025-06-12 06:26:04', '2025-06-12 06:26:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
