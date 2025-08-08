-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2025 at 11:09 AM
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
-- Database: `duniabusana`
--

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
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `customer_name`, `phone`, `address`, `gender`, `created_at`, `updated_at`) VALUES
(1, 'Alya Ramadhani', '081234567890', 'Jl. Merdeka No. 10, Jakarta', 'female', NULL, NULL),
(2, 'Rizky Pratama', '081298765432', 'Jl. Sudirman No. 21, Bandung', 'male', NULL, NULL),
(3, 'Dewi Lestari', '081345678901', 'Jl. Gajah Mada No. 5, Surabaya', 'female', NULL, NULL),
(4, 'Fajar Nugroho', '081356789012', 'Jl. Diponegoro No. 8, Yogyakarta', 'male', NULL, NULL),
(5, 'Siti Nurhaliza', '081367890123', 'Jl. Ahmad Yani No. 3, Medan', 'female', NULL, NULL),
(6, 'Taufik Hidayat', '081398765432', 'Jl. Pemuda No. 17, Semarang', 'male', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaction`
--

CREATE TABLE `detail_transaction` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` bigint(20) NOT NULL,
  `note` varchar(255) NOT NULL,
  `status_order_item_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_transaction`
--

INSERT INTO `detail_transaction` (`id`, `transaction_id`, `item_id`, `qty`, `price`, `note`, `status_order_item_id`, `created_at`, `updated_at`) VALUES
(9, 19, 1, 1, 250000, 'Sebelum berlatih, Anda perlu mengetahui berbagai efek angkat beban berat terhadap kondisi tubuh. Apa saja risiko yang perlu diperhatikan?', 1, '2025-07-28 09:30:33', '2025-07-28 09:30:33'),
(10, 19, 6, 1, 250000, '', 1, '2025-07-28 09:30:33', '2025-07-28 09:30:33'),
(11, 19, 10, 2, 250000, 'test', 1, '2025-07-28 09:30:33', '2025-07-28 09:30:33'),
(74, 20, 1, 1, 250000, 'Kemeja kalong', 1, '2025-07-30 07:36:42', '2025-07-30 07:36:42'),
(75, 20, 8, 2, 225000, 'Celana plui 1', 1, '2025-07-30 07:36:42', '2025-07-30 07:36:42'),
(125, 18, 2, 1, 750000, '', 1, '2025-07-31 10:25:23', '2025-07-31 10:25:23'),
(126, 18, 4, 2, 50000, 'test', 1, '2025-07-31 10:25:23', '2025-07-31 10:25:23'),
(127, 18, 3, 1, 150000, 'test', 1, '2025-07-31 10:25:23', '2025-07-31 10:25:23'),
(128, 23, 1, 1, 250000, 'test', 1, '2025-07-31 10:53:15', '2025-07-31 10:53:15'),
(129, 23, 14, 1, 250000, 'test', 1, '2025-07-31 10:53:15', '2025-07-31 10:53:15'),
(132, 24, 15, 3, 250000, 'Tstubg', 1, '2025-07-31 11:04:16', '2025-07-31 11:04:16'),
(133, 25, 4, 1, 50000, 'test', 1, '2025-08-01 02:20:07', '2025-08-01 02:20:07'),
(134, 25, 11, 1, 250000, 'tessss', 1, '2025-08-01 02:20:07', '2025-08-01 02:20:07'),
(135, 25, 15, 2, 250000, 'test', 1, '2025-08-01 02:20:07', '2025-08-01 02:20:07'),
(136, 26, 2, 1, 750000, 'test', 1, '2025-08-01 02:45:14', '2025-08-01 02:45:14'),
(137, 27, 2, 1, 750000, 'test', 1, '2025-08-01 04:55:22', '2025-08-01 04:55:22'),
(138, 27, 8, 1, 225000, 'test', 1, '2025-08-01 04:55:22', '2025-08-01 04:55:22'),
(139, 28, 2, 1, 750000, 'test', 1, '2025-08-01 16:40:44', '2025-08-01 16:40:44'),
(140, 28, 7, 1, 250000, 'test', 1, '2025-08-01 16:40:44', '2025-08-01 16:40:44'),
(141, 29, 1, 1, 250000, 'test', 1, '2025-08-01 16:48:06', '2025-08-01 16:48:06'),
(142, 29, 7, 2, 250000, 'test', 1, '2025-08-01 16:48:06', '2025-08-01 16:48:06'),
(145, 31, 6, 1, 250000, 'test', 1, '2025-08-02 17:09:19', '2025-08-02 17:09:19'),
(146, 31, 12, 4, 250000, 'test', 1, '2025-08-02 17:09:19', '2025-08-02 17:09:19'),
(147, 30, 4, 1, 50000, 'test', 1, '2025-08-02 17:09:31', '2025-08-02 17:09:31'),
(148, 30, 8, 4, 225000, 'test', 1, '2025-08-02 17:09:31', '2025-08-02 17:09:31'),
(149, 32, 18, 1, 250000, 'test', 1, '2025-08-02 18:20:39', '2025-08-02 18:20:39'),
(150, 32, 17, 1, 250000, 'test', 1, '2025-08-02 18:20:39', '2025-08-02 18:20:39');

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
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `category`, `name`, `description`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Atasan', 'Kemeja', 'Formal maupun kasual, bisa pendek atau panjang lengan', 250000, NULL, NULL),
(2, 'Atasan', 'Jas / Blazer', 'Pakaian luar formal, biasa dipadukan dengan celana bahan', 750000, NULL, NULL),
(3, 'Atasan', 'Vest', 'Rompi yang dipakai di dalam jas', 150000, NULL, NULL),
(4, 'Atasan', 'Kaos', 'T-shirt berbahan katun, biasa untuk kasual', 50000, NULL, NULL),
(5, 'Atasan', 'Blouse', 'Kemejaita, sering berbahan ringan dan bergaya feminim', 250000, NULL, NULL),
(6, 'Atasan', 'Dress', ' satu potong panjang atau pendek', 250000, NULL, NULL),
(7, 'Atasan', 'Tu', 'Atasan panjang yang menutupi pinggul, longgar', 250000, NULL, NULL),
(8, 'Bawahan', 'Celana Panjang', 'Celana formal atau casual untuk pria', 225000, NULL, NULL),
(9, 'Bawahan', 'Celana Pendek', 'Untuk gaya santai atau musim panas', 175000, NULL, NULL),
(10, 'Bawahan', 'Rok', 'Bisa berupa rok pendek, midi, atau panjang', 250000, NULL, NULL),
(11, 'Bawahan', 'Celana Palazzo', 'Celana lebar, panjang, dan bergaya elegan', 250000, NULL, NULL),
(12, 'Busana', 'Gamis', 'Gaun panjang, biasa dipakai oleh wanita muslim', 250000, NULL, NULL),
(13, 'Busana', 'Koko', 'Kemeja pria muslim, biasa untuk ibadah atau acara formal', 250000, NULL, NULL),
(14, 'Busana', 'Hijab', 'Penutup kepala wanita muslim', 250000, NULL, NULL),
(15, 'Seragam', 'Seragam Sekolah', 'Umum untuk siswa SD hingga SMA', 250000, NULL, NULL),
(16, 'Seragam', 'Seragam Kantor', 'Seragam resmi untuk lingkungan kerja', 250000, NULL, NULL),
(17, 'Khusus', 'Pakaian Pernikahan', 'Jas pengantin, kebaya, atau gaun pernikahan', 250000, NULL, NULL),
(18, 'Khusus', 'Pakaian Adat', 'Baju daerah sesuai dengan budaya lokal', 250000, NULL, NULL),
(19, 'Anak-anak', 'Setelan Anak', 'Pakaian khusus anak, biasanya berupa kemeja & celana', 250000, NULL, NULL),
(20, 'category - testing', 'name - testing', 'description - testing', 1000, NULL, NULL),
(21, 'category - testing1', 'name - testing1', 'description - testing1', 1000, NULL, NULL),
(24, '', 'name - testing1', 'description - testing1', 1000, NULL, NULL),
(25, '', 'name - testing1', 'description - testing1', 1000, NULL, NULL),
(26, '', 'name - testing1', 'description - testing1', 1000, NULL, NULL),
(27, '', 'name - testing1', 'description - testing1', 1000, NULL, NULL),
(28, '', 'name - testing1', 'description - testing1', 1000, NULL, NULL),
(29, '', '', '', -1, NULL, NULL),
(30, '', '', '', -1, NULL, NULL),
(31, '', '', '', -1, NULL, NULL),
(32, '', '', '', -1, NULL, NULL),
(33, '', '', '', 0, NULL, NULL);

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
(4, '0001_01_01_000000_create_users_table', 1),
(5, '0001_01_01_000001_create_cache_table', 1),
(6, '0001_01_01_000002_create_jobs_table', 1),
(8, '2025_07_20_063557_role', 2),
(9, '2025_05_29_130551_create_personal_access_tokens_table', 3),
(10, '2025_07_23_125053_create_customer_table', 3),
(11, '2025_07_23_130410_create_transaction_table', 4),
(12, '2025_07_23_132243_create_transaction_type_table', 5),
(13, '2025_07_23_132257_create_status_transaction_table', 5),
(14, '2025_07_27_011427_create_payment_status_table', 6),
(15, '2025_07_27_023423_create_detail_transaction_table', 7),
(16, '2025_07_27_030449_create_item_table', 8),
(17, '2025_08_03_002028_create_status_order_item_table', 9);

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
  `transaction_id` bigint(20) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_status_id` bigint(20) NOT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_status`
--

CREATE TABLE `payment_status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_status`
--

INSERT INTO `payment_status` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Belum Dibayar', 'Pelanggan belum melakukan pembayaran', NULL, NULL),
(2, 'Belum Lunas', 'Pelanggan sudah membayar sebagian tagihan', NULL, NULL),
(3, 'Lunas', 'Pembayaran selesai', NULL, NULL);

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
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `RoleName` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `RoleName`, `Description`, `IsActive`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'Role admin', 1, NULL, NULL),
(2, 'Operator', 'Bagian yang melakukan penginputan data dan monitoring', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `role_id` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `role_id`, `payload`, `last_activity`) VALUES
('6yR3XYUpKjF2ljcgr0NmMcMa4WR0LD3czO2GWwNW', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', NULL, 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZkNxNGNaYVhpdE5wcWprZHBZemRBN1JldGFkMTh6cjRSb1ZWNjZjYiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozOToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL21vbml0b3Jpbmc/cGFnZT0xIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1754233654),
('bVIvvCIwTZ6MFItfxdizg1TFmbDCSKRBFtMkNn6P', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', NULL, 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiY2M5RlkzdUNSTE0xemRyWTZ1M2ZXMXp6Sm4wVDhnbEhYcmZwRU1qVSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9tb25pdG9yaW5nP3BhZ2U9MSI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjc7fQ==', 1754159546),
('SncJ8SQVcQ3KrMUSljL8NQAB2fz6RiC2VTIkPJeC', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', NULL, 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSlpGbnhZZXdpUGpJZ0F3NGxnSWxsM01hYmk5Q0JLdWdLSGRHS1d5TyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo3O30=', 1754315937);

-- --------------------------------------------------------

--
-- Table structure for table `status_order_item`
--

CREATE TABLE `status_order_item` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status_order_item`
--

INSERT INTO `status_order_item` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Diterima', 'Pesanan telah diterima dan menunggu konfirmasi dari penjahit', NULL, NULL),
(2, 'Pemotongan Kain', 'Bahan sedang dipotong sesuai pola', NULL, NULL),
(3, 'Penjahitan', 'Pakaian sedang dijahit oleh tim tailor', NULL, NULL),
(4, 'Finishing & Quality Control', 'Pemeriksaan akhir dan penyempurnaan detail', NULL, NULL),
(5, 'Masuk Dobi', 'Tahapan setrika pakaian', NULL, NULL),
(6, 'Siap Diambil', 'Pesanan selesai dan siap diserahkan kepada pelanggan', NULL, NULL),
(7, 'Sudah Diambil', 'Item telah diterima oleh pelanggan', NULL, NULL),
(8, 'Perbaikan', 'Item telah diterima oleh pelanggan', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `status_transaction`
--

CREATE TABLE `status_transaction` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status_transaction`
--

INSERT INTO `status_transaction` (`id`, `name`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Orderan Baru', 'Order baru masuk dan masuk antrian proses', 1, NULL, NULL),
(2, 'Dalam Proses', 'Order dalam antrian dan akan segera diproses', 1, NULL, NULL),
(3, 'Siap Diambil', 'Jahitan sedang dikerjakan', 1, NULL, NULL),
(4, 'Sudah Diambil', 'Proses tertunda karena bahan belum tersedia', 1, NULL, NULL),
(5, 'Perubahan', 'Jahitan telah selesai, menunggu finishing', 1, NULL, NULL),
(6, 'Perbaikan', 'Pesanan siap diambil oleh pelanggan', 1, NULL, NULL),
(7, 'Menunggu Konfirmasi', 'Pesanan telah diambil oleh pelanggan', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `transaction_type_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `paid_amount` int(11) NOT NULL,
  `balance_due` int(11) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `transaction_date` date NOT NULL,
  `completion_date` date NOT NULL,
  `payment_status_id` int(11) NOT NULL,
  `status_transaction` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `order_id`, `customer_id`, `transaction_type_id`, `amount`, `paid_amount`, `balance_due`, `notes`, `transaction_date`, `completion_date`, `payment_status_id`, `status_transaction`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(18, 'TRX-20250728-161206-023250', 2, 1, 1000000, 1000000, 0, 'Tolong disegerakan!', '2025-07-25', '2025-07-31', 3, 1, 7, 7, '2025-07-28 09:12:29', '2025-07-31 10:25:23'),
(19, 'TRX-20250728-162854-078148', 4, 1, 1000000, 500000, 0, 'Segerakan untuk acara lahiran', '2025-07-28', '2025-07-29', 2, 1, 7, 7, '2025-07-28 09:30:33', '2025-07-28 09:30:33'),
(20, 'TRX-20250730-142916-314468', 3, 2, 700000, 700000, 0, 'Tolong disegerakan untuk acara', '2025-07-25', '2025-07-27', 3, 4, 7, 7, '2025-07-30 07:36:24', '2025-07-30 07:36:42'),
(23, 'TRX-20250731-175238-203409', 1, 1, 500000, 100000, 400000, 'test', '2025-07-31', '2025-08-30', 2, 1, 7, 7, '2025-07-31 10:53:15', '2025-07-31 10:53:15'),
(24, 'TRX-20250731-180303-847731', 5, 1, 750000, 250000, 500000, 'Testing', '2025-07-31', '2025-08-28', 2, 2, 7, 7, '2025-07-31 11:03:45', '2025-07-31 11:04:16'),
(25, 'TRX-20250801-091932-354325', 1, 1, 800000, 500000, 300000, 'test', '2025-08-01', '2025-08-29', 2, 1, 7, 7, '2025-08-01 02:20:07', '2025-08-01 02:20:07'),
(26, 'TRX-20250801-094453-701878', 3, 1, 750000, 500000, 250000, 'test', '2025-08-01', '2025-08-02', 2, 1, 7, 7, '2025-08-01 02:45:14', '2025-08-01 02:45:14'),
(27, 'TRX-20250801-115447-156593', 6, 1, 975000, 975000, 0, 'test', '2025-08-01', '2025-08-08', 3, 1, 7, 7, '2025-08-01 04:55:22', '2025-08-01 04:55:22'),
(28, 'TRX-20250801-234036-768576', 6, 1, 1000000, 0, 1000000, 'test', '2025-08-01', '2025-08-30', 1, 1, 7, 7, '2025-08-01 16:40:44', '2025-08-01 16:40:44'),
(29, 'TRX-20250801-234739-669707', 6, 1, 750000, 0, 750000, 'teasdasdasdsa adsadas klasjdksa sdklajsdklas lkasjdksajdklasdasdasdasdsadsadasdas', '2025-08-01', '2025-08-29', 1, 1, 7, 7, '2025-08-01 16:48:06', '2025-08-01 16:48:06'),
(30, 'TRX-20250803-000604-820920', 5, 1, 950000, 0, 950000, 'test', '2025-08-03', '2025-08-03', 1, 1, 7, 7, '2025-08-02 17:06:35', '2025-08-02 17:09:31'),
(31, 'TRX-20250803-000837-060841', 2, 1, 1250000, 0, 1250000, 'Mau dipakai Sabtu depan!', '2025-08-03', '2025-08-04', 1, 1, 7, 7, '2025-08-02 17:09:19', '2025-08-02 17:09:19'),
(32, 'TRX-20250803-012006-390251', 1, 1, 500000, 0, 500000, 'test', '2025-08-03', '2025-08-04', 1, 1, 7, 7, '2025-08-02 18:20:39', '2025-08-02 18:20:39');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_type`
--

CREATE TABLE `transaction_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_type`
--

INSERT INTO `transaction_type` (`id`, `name`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Orderan Harian', 'Orderan harian pelanggan', 1, NULL, NULL),
(2, 'Orderan Dinas', 'Orderan untuk seragam dinas', 1, NULL, NULL);

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
  `roleId` int(11) NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `roleId`, `isActive`, `remember_token`, `created_at`, `updated_at`) VALUES
(7, 'Rifaldi Adrian', 'rifaldiadrian26@gmail.com', NULL, '$2y$12$iXTRfHVYMyJptLzCUl8yueYh3izkhZA3B8tPZ.qcRCM1/cHgaLKEe', 1, 1, NULL, '2025-07-20 00:54:01', '2025-07-23 05:42:34'),
(8, 'Yoas Setiawan', 'soya@gmail.com', NULL, '$2y$12$YlvDKOJn2G.8KwMLBGq3demIpOGkJxCdrk2ZnchnOBVYEKLNCmWy.', 1, 1, NULL, '2025-07-22 07:53:31', '2025-07-22 07:53:31'),
(9, 'Muhammad Fakri Gaffar', 'mfgaffar@gmail.com', NULL, '$2y$12$axP00tXtnye1MwR40Gy44.XKtdAF.fwTwtVsVRZEzJWIupW.BVJkK', 1, 1, NULL, '2025-07-23 05:01:22', '2025-07-23 05:01:22');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_transaction`
--
ALTER TABLE `detail_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_status`
--
ALTER TABLE `payment_status`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payment_status_name_unique` (`name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `status_order_item`
--
ALTER TABLE `status_order_item`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `status_order_item_name_unique` (`name`);

--
-- Indexes for table `status_transaction`
--
ALTER TABLE `status_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_type`
--
ALTER TABLE `transaction_type`
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
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `detail_transaction`
--
ALTER TABLE `detail_transaction`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_status`
--
ALTER TABLE `payment_status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status_order_item`
--
ALTER TABLE `status_order_item`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `status_transaction`
--
ALTER TABLE `status_transaction`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `transaction_type`
--
ALTER TABLE `transaction_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
