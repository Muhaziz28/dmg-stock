-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2022 at 09:58 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dmg-stock`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahans`
--

CREATE TABLE `bahans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_bahan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bahans`
--

INSERT INTO `bahans` (`id`, `nama_bahan`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'PAKU', NULL, '2022-06-01 23:54:45', '2022-06-01 23:54:45'),
(2, 'PAKU BETON', NULL, '2022-06-01 23:54:54', '2022-06-01 23:54:54'),
(3, 'NUKLIR', 'dasd', '2022-06-01 23:55:00', '2022-06-01 23:55:41'),
(5, 'MATAHARI', 'GALAXY CITAURI', '2022-06-01 23:58:14', '2022-06-01 23:58:14');

-- --------------------------------------------------------

--
-- Table structure for table `barangs`
--

CREATE TABLE `barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_barang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_bahan` bigint(20) UNSIGNED NOT NULL,
  `id_variasi` bigint(20) UNSIGNED NOT NULL,
  `stok` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`id`, `nama_barang`, `kode_barang`, `ukuran`, `id_bahan`, `id_variasi`, `stok`, `created_at`, `updated_at`) VALUES
(3, 'SELIMUT', '123', '312', 1, 1, 472, NULL, '2022-06-03 21:44:16'),
(5, 'NUKLIR', '123', '100m2', 3, 1, 34, NULL, '2022-06-03 21:44:32');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `keluars`
--

CREATE TABLE `keluars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `stok_keluar` int(11) NOT NULL,
  `id_barang` bigint(20) UNSIGNED NOT NULL,
  `stok_awal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `keluars`
--

INSERT INTO `keluars` (`id`, `tanggal`, `stok_keluar`, `id_barang`, `stok_awal`, `created_at`, `updated_at`) VALUES
(3, '2022-06-02', 51, 3, 200, '2022-06-02 01:26:57', '2022-06-02 01:26:57'),
(4, '2022-06-02', 20, 5, 3, '2022-06-02 02:05:14', '2022-06-02 02:05:14');

-- --------------------------------------------------------

--
-- Table structure for table `masuks`
--

CREATE TABLE `masuks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `stok_masuk` int(11) NOT NULL,
  `id_barang` bigint(20) UNSIGNED NOT NULL,
  `stok_awal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `masuks`
--

INSERT INTO `masuks` (`id`, `tanggal`, `stok_masuk`, `id_barang`, `stok_awal`, `created_at`, `updated_at`) VALUES
(6, '2022-06-02', 3, 5, 5, '2022-06-02 01:38:58', '2022-06-02 01:38:58'),
(7, '2022-06-02', 3, 5, 8, '2022-06-02 01:39:41', '2022-06-02 01:39:41'),
(8, '2022-06-01', 1, 3, 201, '2022-06-02 01:48:15', '2022-06-02 01:48:15'),
(9, '2022-06-02', 12, 3, 213, '2022-06-02 01:53:51', '2022-06-02 01:53:51'),
(10, '2022-06-02', 1, 5, 9, '2022-06-02 01:54:29', '2022-06-02 01:54:29'),
(11, '2022-06-02', 1, 5, 10, '2022-06-02 01:55:38', '2022-06-02 01:55:38'),
(12, '2022-06-02', 12, 5, 22, '2022-06-02 01:56:25', '2022-06-02 01:56:25'),
(13, '2022-06-02', 12, 3, 225, '2022-06-02 01:56:57', '2022-06-02 01:56:57'),
(14, '2022-06-02', 1, 5, 23, '2022-06-02 01:59:57', '2022-06-02 01:59:57'),
(15, '2022-06-02', 100, 3, 325, '2022-06-02 02:00:23', '2022-06-02 02:00:23'),
(16, '2022-06-02', 100, 3, 425, '2022-06-02 02:00:48', '2022-06-02 02:00:48'),
(17, '2022-06-02', 2, 5, 5, '2022-06-02 02:10:23', '2022-06-02 02:10:23'),
(18, '2022-06-04', 5, 3, 430, '2022-06-03 21:22:43', '2022-06-03 21:22:43'),
(19, '2022-06-04', 5, 5, 10, '2022-06-03 21:23:37', '2022-06-03 21:23:37'),
(21, '2022-06-04', 6, 3, 436, NULL, NULL),
(22, '2022-06-04', 4, 5, 20, NULL, NULL),
(23, '2022-06-04', 4, 5, 24, NULL, NULL),
(24, '2022-06-04', 4, 3, 440, '2022-06-03 21:39:28', '2022-06-03 21:39:28'),
(25, '2022-06-04', 10, 3, 460, '2022-06-03 21:42:15', '2022-06-03 21:42:15'),
(26, '2022-06-04', 12, 3, 472, '2022-06-03 21:44:16', '2022-06-03 21:44:16'),
(27, '2022-06-04', 10, 5, 34, '2022-06-03 21:44:32', '2022-06-03 21:44:32');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_06_02_022558_create_barangs_table', 1),
(6, '2022_06_02_045406_create_variasis_table', 2),
(7, '2022_06_02_063751_create_bahans_table', 3),
(8, '2022_06_02_071939_create_masuks_table', 4),
(9, '2022_06_02_075932_create_keluars_table', 5);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `variasis`
--

CREATE TABLE `variasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_variasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `variasis`
--

INSERT INTO `variasis` (`id`, `nama_variasi`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Rmpeld', 'dasdd', '2022-06-01 22:14:14', '2022-06-01 22:22:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahans`
--
ALTER TABLE `bahans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_variasi` (`id_variasi`),
  ADD KEY `id_bahan` (`id_bahan`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `keluars`
--
ALTER TABLE `keluars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `keluars_id_barang_foreign` (`id_barang`);

--
-- Indexes for table `masuks`
--
ALTER TABLE `masuks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `masuks_id_barang_foreign` (`id_barang`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `variasis`
--
ALTER TABLE `variasis`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahans`
--
ALTER TABLE `bahans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keluars`
--
ALTER TABLE `keluars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `masuks`
--
ALTER TABLE `masuks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `variasis`
--
ALTER TABLE `variasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barangs`
--
ALTER TABLE `barangs`
  ADD CONSTRAINT `barangs_ibfk_1` FOREIGN KEY (`id_variasi`) REFERENCES `variasis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barangs_ibfk_2` FOREIGN KEY (`id_bahan`) REFERENCES `bahans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `keluars`
--
ALTER TABLE `keluars`
  ADD CONSTRAINT `keluars_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `barangs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `masuks`
--
ALTER TABLE `masuks`
  ADD CONSTRAINT `masuks_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `barangs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
