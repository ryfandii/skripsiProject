-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 03, 2026 at 02:21 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smasa`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id` bigint UNSIGNED NOT NULL,
  `guru_id` bigint UNSIGNED DEFAULT NULL,
  `kelas_id` bigint UNSIGNED DEFAULT NULL,
  `mapel_id` bigint UNSIGNED DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id`, `guru_id`, `kelas_id`, `mapel_id`, `tanggal`, `created_at`, `updated_at`) VALUES
(1, 39, 6, 7, '2026-04-24', '2026-04-23 19:31:25', '2026-04-23 19:31:25'),
(2, 39, 8, 7, '2026-04-24', '2026-04-23 19:31:54', '2026-04-23 19:31:54');

-- --------------------------------------------------------

--
-- Table structure for table `absensi_detail`
--

CREATE TABLE `absensi_detail` (
  `id` bigint UNSIGNED NOT NULL,
  `absensi_id` bigint UNSIGNED DEFAULT NULL,
  `siswa_id` bigint UNSIGNED DEFAULT NULL,
  `status` enum('hadir','izin','sakit','alpha') DEFAULT 'hadir',
  `keterangan` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `absensi_detail`
--

INSERT INTO `absensi_detail` (`id`, `absensi_id`, `siswa_id`, `status`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 15, 'hadir', NULL, '2026-04-23 19:31:25', '2026-04-23 19:31:25'),
(2, 1, 16, 'hadir', NULL, '2026-04-23 19:31:25', '2026-04-23 19:31:25'),
(3, 1, 19, 'hadir', NULL, '2026-04-23 19:31:25', '2026-04-23 19:31:25'),
(4, 1, 22, 'hadir', NULL, '2026-04-23 19:31:25', '2026-04-23 19:31:25'),
(5, 1, 23, 'hadir', NULL, '2026-04-23 19:31:25', '2026-04-23 19:31:25'),
(6, 2, 17, 'izin', NULL, '2026-04-23 19:31:54', '2026-04-23 19:31:54'),
(7, 2, 20, 'hadir', NULL, '2026-04-23 19:31:54', '2026-04-23 19:31:54'),
(8, 2, 21, 'hadir', NULL, '2026-04-23 19:31:54', '2026-04-23 19:31:54');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `gurus`
--

CREATE TABLE `gurus` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `mapel_id` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gurus`
--

INSERT INTO `gurus` (`id`, `nama`, `nip`, `alamat`, `telepon`, `created_at`, `updated_at`, `status`, `mapel_id`) VALUES
(36, 'zakaria', '242424213', 'jember', '089785463773', '2026-04-19 21:18:08', '2026-04-19 21:18:08', 'aktif', 2),
(37, 'Umam', '213213123', 'kembang', '0879635231', '2026-04-21 11:52:56', '2026-04-21 11:52:56', 'aktif', 3),
(39, 'Arengga', '2423123', 'Bondowoso', '6289504732922', '2026-04-22 02:17:14', '2026-04-22 02:47:48', 'aktif', 7);

-- --------------------------------------------------------

--
-- Table structure for table `hasils`
--

CREATE TABLE `hasils` (
  `id` bigint UNSIGNED NOT NULL,
  `siswa_id` bigint UNSIGNED DEFAULT NULL,
  `ujian_id` bigint UNSIGNED DEFAULT NULL,
  `nilai` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwals`
--

CREATE TABLE `jadwals` (
  `id` bigint UNSIGNED NOT NULL,
  `kelas_id` bigint UNSIGNED NOT NULL,
  `mata_pelajaran_id` bigint UNSIGNED NOT NULL,
  `hari` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `guru_id` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwals`
--

INSERT INTO `jadwals` (`id`, `kelas_id`, `mata_pelajaran_id`, `hari`, `jam_mulai`, `jam_selesai`, `created_at`, `updated_at`, `guru_id`) VALUES
(13, 6, 5, 'Senin', '07:00:00', '08:00:00', '2026-03-31 21:24:11', '2026-03-31 21:24:11', 14),
(14, 6, 2, 'Senin', '12:00:00', '13:00:00', '2026-03-31 21:26:45', '2026-03-31 21:26:45', 15),
(15, 6, 5, 'Selasa', '07:00:00', '08:00:00', '2026-03-31 21:27:12', '2026-03-31 21:27:12', 14),
(16, 6, 4, 'Selasa', '09:00:00', '10:00:00', '2026-03-31 21:27:30', '2026-03-31 21:27:30', 15),
(19, 6, 6, 'Rabu', '20:00:00', '22:00:00', '2026-04-17 02:26:01', '2026-04-17 02:26:01', 25),
(20, 6, 2, 'Rabu', '09:00:00', '10:00:00', '2026-04-17 02:28:19', '2026-04-17 02:28:19', 25);

-- --------------------------------------------------------

--
-- Table structure for table `jawabans`
--

CREATE TABLE `jawabans` (
  `id` bigint UNSIGNED NOT NULL,
  `siswa_id` bigint UNSIGNED NOT NULL,
  `soal_id` bigint UNSIGNED NOT NULL,
  `jawaban` char(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jawaban_siswas`
--

CREATE TABLE `jawaban_siswas` (
  `id` bigint UNSIGNED NOT NULL,
  `siswa_id` bigint UNSIGNED DEFAULT NULL,
  `soal_id` bigint UNSIGNED DEFAULT NULL,
  `jawaban` enum('a','b','c','d') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `jurusan`, `created_at`, `updated_at`) VALUES
(6, 'X IPA 1', 'IPA', '2026-03-30 23:19:53', '2026-03-30 23:19:53'),
(7, 'X IPA 2', 'IPA', '2026-03-30 23:20:08', '2026-03-30 23:20:08'),
(8, 'X IPA 3', 'IPA', '2026-03-30 23:20:16', '2026-03-30 23:20:16'),
(9, 'X IPS 1', 'IPS', '2026-03-30 23:20:33', '2026-03-30 23:20:33'),
(10, 'X IPS 2', 'IPS', '2026-03-30 23:20:44', '2026-03-30 23:20:44'),
(11, 'X IPS 3', 'IPS', '2026-03-30 23:20:57', '2026-03-30 23:20:57');

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajarans`
--

CREATE TABLE `mata_pelajarans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_mapel` varchar(255) NOT NULL,
  `kode_mapel` varchar(100) DEFAULT NULL,
  `jam_pelajaran` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mata_pelajarans`
--

INSERT INTO `mata_pelajarans` (`id`, `nama_mapel`, `kode_mapel`, `jam_pelajaran`, `created_at`, `updated_at`) VALUES
(1, 'Matematika', 'MTK', 2, '2026-04-30 10:25:15', '2026-04-30 10:25:15'),
(2, 'Bahasa Indonesia', 'IND', 2, '2026-04-30 10:25:15', '2026-04-30 10:25:15'),
(3, 'Bahasa Inggris', 'ENG', 2, '2026-04-30 10:25:15', '2026-04-30 10:25:15'),
(4, 'Desain Grafis', 'DG', 3, '2026-04-30 10:25:15', '2026-04-30 10:25:15');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_08_19_084855_create_gurus_table', 1),
(5, '2025_08_20_012827_create_siswa_table', 1),
(6, '2026_03_29_121631_create_mata_pelajarans_table', 1),
(7, '2026_03_29_131627_create_kelas_table', 1),
(8, '2026_03_29_132044_create_jadwals_table', 1),
(9, '2026_03_30_010154_add_role_to_users_table', 2),
(10, '2026_03_31_022301_create_nilai_table', 3),
(11, '2026_04_01_022443_add_photo_to_users_table', 4),
(12, '2026_04_13_142509_add_status_to_gurus_table', 5),
(13, '2026_04_13_145014_add_status_to_siswas_table', 6),
(14, '2026_04_13_154302_add_field_to_siswa_table', 7),
(15, '2026_04_13_155232_add_jenis_kelamin_to_siswa_table', 8),
(16, '2026_04_14_130307_add_is_default_password_to_users', 9),
(17, '2026_04_14_153904_add_otp_to_users_table', 10),
(19, '2026_04_17_084158_create_tugas_table', 1),
(21, '2026_04_16_041005_add_telepon_to_users_table', 10),
(22, '2026_04_17_084159_create_pengumpulan_tugas_table', 10),
(23, '2026_04_17_105854_add_mapel_to_gurus_table', 11),
(24, '2026_04_20_024223_add_file_to_tugas_table', 11),
(25, '2026_04_20_044829_update_deadline_to_datetime_in_tugas', 12),
(26, '2026_04_20_115943_add_komentar_to_pengumpulan_tugas', 13),
(27, '2026_04_20_123724_create_absensis_table', 14),
(28, '2026_04_20_123747_create_absensi_details_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` bigint UNSIGNED NOT NULL,
  `siswa_id` bigint UNSIGNED NOT NULL,
  `mapel_id` bigint UNSIGNED NOT NULL,
  `nilai` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id`, `siswa_id`, `mapel_id`, `nilai`, `created_at`, `updated_at`) VALUES
(14, 15, 4, 80, '2026-03-31 23:45:22', '2026-03-31 23:45:22'),
(15, 15, 5, 40, '2026-03-31 23:46:27', '2026-04-21 11:49:48'),
(16, 15, 2, 90, '2026-04-15 21:02:32', '2026-04-15 21:02:32'),
(17, 16, 2, 80, '2026-04-15 21:02:32', '2026-04-15 21:02:32'),
(18, 19, 2, 70, '2026-04-15 21:02:32', '2026-04-15 21:02:32'),
(19, 22, 2, 50, '2026-04-15 21:02:32', '2026-04-15 21:02:32'),
(20, 16, 5, 70, '2026-04-21 11:49:48', '2026-04-21 11:49:48'),
(21, 19, 5, 90, '2026-04-21 11:49:48', '2026-04-21 11:49:48'),
(22, 22, 5, 80, '2026-04-21 11:49:48', '2026-04-21 11:49:48'),
(23, 23, 5, 30, '2026-04-21 11:49:48', '2026-04-21 11:49:48');

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
-- Table structure for table `pengumpulan_tugas`
--

CREATE TABLE `pengumpulan_tugas` (
  `id` bigint UNSIGNED NOT NULL,
  `tugas_id` bigint UNSIGNED NOT NULL,
  `siswa_id` bigint UNSIGNED NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `komentar` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('8UFetMqwkKV2CYFII4GrKKnlo9ZrMrg01oUx17Zd', 44, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiajdTc1BwbkdvRkxEQ3VWRG1UaW82eERMaXN4dFVYN2d2cU51YkRzaiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ndXJ1L3VqaWFuL2NyZWF0ZSI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ0O30=', 1777544964),
('qR6okGJIUFM6wIISXVaUCFxImbjsZ1LYQixVgnCO', 40, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicmFKclU0TVo4d1dLY3BrOFA4bXNQQlRSN1hGRG16QWlSRXJFWnpGZCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zaXN3YS91amlhbi8xL2tlcmpha2FuIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDA7fQ==', 1777545038);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_ortu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kelas_id` bigint UNSIGNED DEFAULT NULL,
  `alasan_nonaktif` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nama`, `jenis_kelamin`, `nama_ortu`, `nis`, `alamat`, `telepon`, `status`, `created_at`, `updated_at`, `kelas_id`, `alasan_nonaktif`) VALUES
(14, 'sipol', 'L', 'sipoladon', '212321321', 'Jember barat timur', '09897865464', 'nonaktif', '2026-03-31 21:13:11', '2026-04-15 21:00:43', 9, NULL),
(15, 'Fuad', 'L', '', '1213213', 'Jember barat timur', '09897865464', 'nonaktif', '2026-03-31 21:23:26', '2026-04-15 21:00:43', 6, NULL),
(16, 'ilham', 'L', '', '3243234', 'dsfdfs32', '234234124124124', 'nonaktif', '2026-04-13 07:20:20', '2026-04-15 21:00:43', 6, NULL),
(17, 'bayu akbar', 'L', '', '35423412', 'Bondowoso', '08976544534', 'nonaktif', '2026-04-13 08:32:46', '2026-04-15 21:00:43', 8, NULL),
(18, 'Gavin', 'L', 'Gavinaldo', '41412312', 'Bondowoso', '08931231252', 'nonaktif', '2026-04-13 08:53:17', '2026-04-15 21:00:43', 9, NULL),
(19, 'Irul', 'L', 'khoirul', '412421', 'Bondowoso', '08978675453', 'nonaktif', '2026-04-14 06:31:15', '2026-04-15 21:00:43', 6, NULL),
(20, 'Fauzi', 'L', 'Sukri', '758567', 'Bondowoso', '08975643221', 'nonaktif', '2026-04-14 06:51:57', '2026-04-15 21:00:43', 8, NULL),
(21, 'hardi', 'P', 'memo', '121312', 'Bondowoso', '0893723132', 'nonaktif', '2026-04-14 06:57:42', '2026-04-15 21:00:43', 8, NULL),
(22, 'Maulana', 'L', 'Gavinaldo', '21313', 'Surabaya', '08954224122', 'aktif', '2026-04-14 07:14:06', '2026-04-28 08:01:10', 6, NULL),
(23, 'Siswa Rengga', 'L', 'Andik', '345333242', 'Bondowoso', '08977654321233', 'aktif', '2026-04-19 21:55:36', '2026-04-19 21:55:36', 6, NULL),
(24, 'Bayu anggara', 'P', 'sipoladon', '3242341', 'Bondowoso', '08978546377332', 'aktif', '2026-04-20 04:33:22', '2026-04-20 04:33:22', 7, NULL),
(35, 'rayenn', 'L', 'Sudik', '35465686', 'surabaya', '6281252519535', 'nonaktif', '2026-04-23 22:22:03', '2026-04-28 08:30:41', 6, 'karena sudah di do');

-- --------------------------------------------------------

--
-- Table structure for table `soals`
--

CREATE TABLE `soals` (
  `id` bigint UNSIGNED NOT NULL,
  `ujian_id` bigint UNSIGNED DEFAULT NULL,
  `pertanyaan` text,
  `a` text,
  `b` text,
  `c` text,
  `d` text,
  `jawaban_benar` enum('a','b','c','d') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `soals`
--

INSERT INTO `soals` (`id`, `ujian_id`, `pertanyaan`, `a`, `b`, `c`, `d`, `jawaban_benar`, `created_at`, `updated_at`) VALUES
(1, 1, 'rumah rengga dimana', 'kembang', 'sukowiryo', 'duko', 'nangkaan', 'a', '2026-04-30 09:06:48', '2026-04-30 09:06:48');

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id` bigint UNSIGNED NOT NULL,
  `guru_id` bigint UNSIGNED NOT NULL,
  `kelas_id` bigint UNSIGNED NOT NULL,
  `mapel_id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deadline` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id`, `guru_id`, `kelas_id`, `mapel_id`, `judul`, `deskripsi`, `deadline`, `created_at`, `updated_at`, `file`) VALUES
(18, 39, 6, 7, 'minggu 10', 'adasdasdas', '2026-04-22 10:05:00', '2026-04-22 03:05:05', '2026-04-22 03:05:05', 'tugas_file/SKQvPt7XGSUxDILwzB1uPfhMYmHlTWFiVkC2tKpR.pdf'),
(19, 39, 7, 7, 'minggu 9', 'dwqdasd', '2026-04-22 10:06:00', '2026-04-22 03:06:13', '2026-04-22 03:06:13', 'tugas_file/KpYeWe5f60Awf51go9lw8DvFh3mC45Dlx8v0CkMm.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `ujians`
--

CREATE TABLE `ujians` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `durasi` int DEFAULT NULL,
  `mulai` datetime DEFAULT NULL,
  `selesai` datetime DEFAULT NULL,
  `guru_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ujians`
--

INSERT INTO `ujians` (`id`, `judul`, `durasi`, `mulai`, `selesai`, `guru_id`, `created_at`, `updated_at`) VALUES
(1, 'UTS Desain Grafis', 45, '2026-04-30 16:00:00', '2026-04-30 16:45:00', 39, '2026-04-30 09:06:48', '2026-04-30 09:06:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','guru','siswa') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'siswa',
  `guru_id` bigint UNSIGNED DEFAULT NULL,
  `siswa_id` bigint UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mapel_id` bigint DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default_password` tinyint(1) NOT NULL DEFAULT '1',
  `otp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_expired_at` timestamp NULL DEFAULT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `guru_id`, `siswa_id`, `remember_token`, `created_at`, `updated_at`, `mapel_id`, `photo`, `is_default_password`, `otp`, `otp_expired_at`, `telepon`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$12$nYOJKfRSziDIvXdFLMSej.RrniIDukDG6Z6tNt6zmZ3pSGOmFPsn.', 'admin', 2, NULL, NULL, '2026-03-29 20:52:52', '2026-04-15 20:03:42', NULL, '1775011418.jpg', 0, NULL, NULL, NULL),
(4, 'Siswa 1', 'siswa@gmail.com', '$2y$12$sDRQgwkz34hk3ru6AitfBegN9mS30Z9BHZMw85f8QRxrQZcMgGeQ.', 'siswa', NULL, NULL, NULL, '2026-03-29 20:53:52', '2026-03-29 20:53:52', NULL, NULL, 1, NULL, NULL, NULL),
(5, 'Ryan MAulana', 'guru1@gmail.com', '$2y$12$mLnhDhHvTnVCEMhFtPxCkeBFEfggfkCifZ6yrRt19QV06uF.nH2P6', 'guru', NULL, NULL, NULL, '2026-03-30 20:55:29', '2026-03-30 20:55:29', NULL, NULL, 1, NULL, NULL, NULL),
(6, 'zakaria', 'zaka@gmail.com', '$2y$12$GCbsvTxo5x1s3J8Xm4Lnxe0AiLQCPpYgcgR5ZP4/xsjdROf/Z1pFe', 'guru', 3, NULL, NULL, '2026-03-30 21:17:29', '2026-03-30 21:17:29', NULL, NULL, 1, NULL, NULL, NULL),
(7, 'adis bauk', 'adis12@gmail.com', '$2y$12$f2ezxB.v.z25y/Cz0JyfEun7Mh0JU9z/LXwF5pYy9ry.q.jfqviY.', 'guru', NULL, NULL, NULL, '2026-03-30 21:30:30', '2026-03-30 21:30:30', NULL, NULL, 1, NULL, NULL, NULL),
(8, 'asca2421', 'erinefarah@gmail.com', '$2y$12$3kgiNhZ9cEOsomVLjo95guzCzo78aXWRoB.TYdwIzzNXQOZH39kCC', 'guru', NULL, NULL, NULL, '2026-03-30 21:33:42', '2026-03-30 21:33:42', NULL, NULL, 1, NULL, NULL, NULL),
(9, 'Reyfandi', 'kelompok1@gmail.com', '$2y$12$4WkNPHZ7wThq9KVdY7FZLuCvDR.p1cqUsZdIyzxPQ2GlTxg/u5OFS', 'guru', 10, NULL, NULL, '2026-03-30 21:40:12', '2026-03-30 21:40:12', 2, NULL, 1, NULL, NULL, NULL),
(16, 'sipol', 'sipol@gmail.com', '$2y$12$P19iPvgcI3nmTQjUItQOvu7krp9tt.8PIsbPzrv6A8u9Z9w0todQC', 'siswa', NULL, 14, NULL, '2026-03-31 21:13:11', '2026-03-31 21:13:11', NULL, NULL, 1, NULL, NULL, NULL),
(17, 'Fuad', 'fuad@gmail.com', '$2y$12$vaMwtmvqbSK/rZ5XdA6K7.VW5WiCudpHfro0.OjZYFuBiMJ2DgDJi', 'siswa', NULL, 15, NULL, '2026-03-31 21:23:26', '2026-03-31 21:23:26', NULL, NULL, 1, NULL, NULL, NULL),
(18, 'ilham', 'ilham@gmail.com', '$2y$12$MUBrQ7UGm1pP5Rb8mUVtMOjHaqKeeEh3etLcmwD.Krf4WPJQwwNz2', 'siswa', NULL, 16, NULL, '2026-04-13 07:20:21', '2026-04-13 07:20:21', NULL, NULL, 1, NULL, NULL, NULL),
(19, 'bayu akbar', 'bayuakbar@gmail.com', '$2y$12$gq9mN9dlZdDLKwq1CgrpUO03hQYcV.UrwttALNo0sDb7nrvPP7P1K', 'siswa', NULL, 17, NULL, '2026-04-13 08:32:47', '2026-04-13 08:32:47', NULL, NULL, 1, NULL, NULL, NULL),
(20, 'Gavin', 'gavin@gmail.com', '$2y$12$sNUy3C7bXC121Z8b4CP3HO91LiCNmQydgA.Bm4rt7ChUNw86UHdgG', 'siswa', NULL, 18, NULL, '2026-04-13 08:53:17', '2026-04-13 08:53:17', NULL, NULL, 1, NULL, NULL, NULL),
(21, 'Irul', 'irul@gmail.com', '$2y$12$tWo5A.QaV4ROnck1WJ0qSucrAEIxKc1JYuxyGlYf9XZ7VjNvPh8fa', 'siswa', NULL, 19, NULL, '2026-04-14 06:31:15', '2026-04-14 06:41:38', NULL, NULL, 1, NULL, NULL, NULL),
(22, 'Fauzi', 'fauzi@gmail.com', '$2y$12$LEnvbaAeEoMaK19M7GZCHeoaxgdLYkay58dtVI3Q8dm8rAHfNvSSK', 'siswa', NULL, 20, NULL, '2026-04-14 06:51:57', '2026-04-14 06:51:57', NULL, NULL, 1, NULL, NULL, NULL),
(23, 'hardi', 'hardi@gmail.com', '$2y$12$RVSNOsL7WFRojnhfU6MMFOMD4tkAiv4YWG1pzZS0gFu5PFaHzC7v.', 'siswa', NULL, 21, NULL, '2026-04-14 06:57:42', '2026-04-14 07:03:41', NULL, NULL, 1, NULL, NULL, NULL),
(24, 'Maulana', 'maulana@gmail.com', '$2y$12$GsuWYF.uc0vdCITV8YuLDegOI58BEvJZ8XbIHN0ELi7GBQMjAqr5a', 'siswa', NULL, 22, NULL, '2026-04-14 07:14:06', '2026-04-14 07:14:37', NULL, NULL, 0, NULL, NULL, NULL),
(39, 'zakaria', 'mlnryan05@gmail.com', '$2y$12$yZ5p1XhIGhjdUxXNvyML5uVHNDfzMd4d95oI0T3iEvXZZ2f7RYaWq', 'guru', 36, NULL, NULL, '2026-04-19 21:18:08', '2026-04-19 21:18:08', 2, NULL, 1, NULL, NULL, '089785463773'),
(40, 'Siswa Rengga', 'renggalaviosa@gmail.com', '$2y$12$XI.nsw906.wBE8hvepLLr.oVzgpH/teA5Qlqp7eDQ1YiKNyQRKbLG', 'siswa', NULL, 23, NULL, '2026-04-19 21:55:37', '2026-04-30 09:15:59', NULL, NULL, 0, NULL, NULL, NULL),
(41, 'Bayu anggara', 'bayu@gmail.com', '$2y$12$TuNb6v/RBJF6TaIpFm0dFu9PTkrQrMvMcWq2QFoIck..uwvDsnLZC', 'siswa', NULL, 24, NULL, '2026-04-20 04:33:22', '2026-04-20 04:33:51', NULL, NULL, 0, NULL, NULL, NULL),
(42, 'Umam', 'umam@gmail.com', '$2y$12$psH1qXXs6kgk1jNJJ7Wpt.w7fPxm9wuSFUxWAT5m5GlO8UeIRHOta', 'guru', 37, NULL, NULL, '2026-04-21 11:52:56', '2026-04-21 11:53:39', 3, NULL, 0, NULL, NULL, '0879635231'),
(44, 'Arengga', 'renggalaviosa78@gmail.com', '$2y$12$0XiSSR2G/pmqIxMY7vNJPei0.w.3n/JgD0hnJ45Rikwl.0vwsTfpW', 'guru', 39, NULL, NULL, '2026-04-22 02:17:15', '2026-04-30 10:29:18', 7, NULL, 0, NULL, NULL, '6289504732922'),
(55, 'rayenn', 'nunieiffel@gmail.com', '$2y$12$gDoPf94nRLUr9gXKefPW4ereEctEZwJb3JzhUx6yJB5nEmnzGwh4O', 'siswa', NULL, 35, NULL, '2026-04-23 22:22:03', '2026-04-23 22:22:03', NULL, NULL, 1, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guru_id` (`guru_id`),
  ADD KEY `kelas_id` (`kelas_id`),
  ADD KEY `mapel_id` (`mapel_id`);

--
-- Indexes for table `absensi_detail`
--
ALTER TABLE `absensi_detail`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_absensi` (`absensi_id`,`siswa_id`),
  ADD KEY `siswa_id` (`siswa_id`);

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
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gurus`
--
ALTER TABLE `gurus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gurus_nip_unique` (`nip`);

--
-- Indexes for table `hasils`
--
ALTER TABLE `hasils`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ujian_id` (`ujian_id`);

--
-- Indexes for table `jadwals`
--
ALTER TABLE `jadwals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwals_kelas_id_foreign` (`kelas_id`),
  ADD KEY `jadwals_mata_pelajaran_id_foreign` (`mata_pelajaran_id`);

--
-- Indexes for table `jawabans`
--
ALTER TABLE `jawabans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `siswa_id` (`siswa_id`),
  ADD KEY `soal_id` (`soal_id`);

--
-- Indexes for table `jawaban_siswas`
--
ALTER TABLE `jawaban_siswas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `soal_id` (`soal_id`);

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
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mata_pelajarans`
--
ALTER TABLE `mata_pelajarans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_mapel` (`kode_mapel`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nilai_siswa_id_foreign` (`siswa_id`),
  ADD KEY `nilai_mapel_id_foreign` (`mapel_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pengumpulan_tugas`
--
ALTER TABLE `pengumpulan_tugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengumpulan_tugas_tugas_id_foreign` (`tugas_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `siswa_nis_unique` (`nis`),
  ADD KEY `fk_kelas` (`kelas_id`);

--
-- Indexes for table `soals`
--
ALTER TABLE `soals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ujian_id` (`ujian_id`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tugas_guru_id_foreign` (`guru_id`),
  ADD KEY `tugas_kelas_id_foreign` (`kelas_id`);

--
-- Indexes for table `ujians`
--
ALTER TABLE `ujians`
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
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `absensi_detail`
--
ALTER TABLE `absensi_detail`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gurus`
--
ALTER TABLE `gurus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `hasils`
--
ALTER TABLE `hasils`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwals`
--
ALTER TABLE `jadwals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `jawabans`
--
ALTER TABLE `jawabans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jawaban_siswas`
--
ALTER TABLE `jawaban_siswas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `mata_pelajarans`
--
ALTER TABLE `mata_pelajarans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `pengumpulan_tugas`
--
ALTER TABLE `pengumpulan_tugas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `soals`
--
ALTER TABLE `soals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `ujians`
--
ALTER TABLE `ujians`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`guru_id`) REFERENCES `gurus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `absensi_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `absensi_ibfk_3` FOREIGN KEY (`mapel_id`) REFERENCES `mata_pelajarans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `absensi_detail`
--
ALTER TABLE `absensi_detail`
  ADD CONSTRAINT `absensi_detail_ibfk_1` FOREIGN KEY (`absensi_id`) REFERENCES `absensi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `absensi_detail_ibfk_2` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hasils`
--
ALTER TABLE `hasils`
  ADD CONSTRAINT `hasils_ibfk_1` FOREIGN KEY (`ujian_id`) REFERENCES `ujians` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jadwals`
--
ALTER TABLE `jadwals`
  ADD CONSTRAINT `jadwals_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jadwals_mata_pelajaran_id_foreign` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `mata_pelajarans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jawabans`
--
ALTER TABLE `jawabans`
  ADD CONSTRAINT `jawabans_ibfk_1` FOREIGN KEY (`siswa_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jawabans_ibfk_2` FOREIGN KEY (`soal_id`) REFERENCES `soals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jawaban_siswas`
--
ALTER TABLE `jawaban_siswas`
  ADD CONSTRAINT `jawaban_siswas_ibfk_1` FOREIGN KEY (`soal_id`) REFERENCES `soals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_mapel_id_foreign` FOREIGN KEY (`mapel_id`) REFERENCES `mata_pelajarans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengumpulan_tugas`
--
ALTER TABLE `pengumpulan_tugas`
  ADD CONSTRAINT `pengumpulan_tugas_tugas_id_foreign` FOREIGN KEY (`tugas_id`) REFERENCES `tugas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `fk_kelas` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `soals`
--
ALTER TABLE `soals`
  ADD CONSTRAINT `soals_ibfk_1` FOREIGN KEY (`ujian_id`) REFERENCES `ujians` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tugas`
--
ALTER TABLE `tugas`
  ADD CONSTRAINT `tugas_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `gurus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tugas_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
