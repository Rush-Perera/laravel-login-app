-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.25 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for laravel_login_app_db
CREATE DATABASE IF NOT EXISTS `laravel_login_app_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `laravel_login_app_db`;

-- Dumping structure for table laravel_login_app_db.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel_login_app_db.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table laravel_login_app_db.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel_login_app_db.migrations: ~0 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2024_02_05_124147_add_user_type_to_users_table', 2),
	(6, '2024_02_05_165549_add_columns_to_users_table', 3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table laravel_login_app_db.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel_login_app_db.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
	('mail@sudeeraperera.com', '$2y$10$hicbV6h2FOJQW9i498Ezq.Wb/ebbaXADhuij2gaCaiAXK1Iak/9Ze', '2024-02-05 13:29:56');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table laravel_login_app_db.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel_login_app_db.personal_access_tokens: ~0 rows (approximately)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Dumping structure for table laravel_login_app_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel_login_app_db.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `user_type`, `is_active`, `username`) VALUES
	(1, 'Sudeera', 'sudeera@email.com', NULL, '$2y$10$84ftrYnZyVAl5oCnMmm9hOP7YCUyyUaCHW/0WJ5Pp7RnZhA2Id2PO', NULL, '2024-02-05 10:35:05', '2024-02-05 10:35:05', 'user', 1, 'dsgds'),
	(2, 'csdvsdbsd', 'cdsvbsd@dwfw.com', NULL, '$2y$10$RSiqwa44aGRb42TfBu88LunIY7Q/ECxNFPfC4pardBZL7hwYOYQkK', NULL, '2024-02-05 12:52:58', '2024-02-05 12:52:58', 'user', 0, 'gsgsd'),
	(3, 'Sudeera Perera', 'mail@sudeeraperera.com', NULL, '$2y$10$0AlWL0VmUzw8KGd7zgGor.OzgCvCtU847RqFXPrkQlWsgbZgePAn.', '9ePAOrPoFmm9k16qLQ8mrVI42LEvp3rjiXsykpuELkdKUZn0qnCC9AC90MO9', '2024-02-05 13:28:09', '2024-02-05 17:54:43', 'superadmin', 1, 'sudeera'),
	(4, 'hbvyiesb', 'sfsdgvsads@dwdw.com', NULL, '$2y$10$clfPI560nLE7KsaQHdtit.PfeoiZkPK6oD8xLHKvQt1HAEym47NAC', NULL, '2024-02-05 13:34:59', '2024-02-05 17:31:59', 'admin', 1, 'dsafsd'),
	(5, 'svdsbdsb', 'dsgdsg@w.com', NULL, '$2y$10$jebdzzB4uL8YKCvF6DnB7OD2feOYxXmazFoY14GArDHKXuaOTdMlC', NULL, '2024-02-05 13:39:22', '2024-02-05 17:31:56', 'admin', 0, 'fsdf'),
	(6, 'Romasha Motha', 'romotha@gmail.com', NULL, '$2y$10$Khcr7e4ROKklPE8JCALYmedOB5h.TrVNxktJGwGBkYyOD38tpY80W', NULL, '2024-02-05 17:04:03', '2024-02-05 17:55:40', 'superadmin', 1, 'romotha');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
