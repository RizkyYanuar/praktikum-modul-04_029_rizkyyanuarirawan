-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2026 at 02:00 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) UNSIGNED NOT NULL,
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
(4, '2026_10_09_200202_create_products_table', 1),
(5, '2026_10_09_201455_create_orders_table', 1),
(6, '2026_10_09_201505_create_order_details_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_order` varchar(15) NOT NULL,
  `id_user` varchar(15) NOT NULL,
  `tanggal_order` datetime NOT NULL,
  `total_harga` decimal(12,2) NOT NULL,
  `alamat_pengiriman` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_order`, `id_user`, `tanggal_order`, `total_harga`, `alamat_pengiriman`, `created_at`, `updated_at`) VALUES
('ORD-5X7KZ74R', 'USR-EYAPFPRW', '2026-10-10 00:51:36', 13350000.00, 'Jalan karang tineung indah no 35', '2026-10-09 17:51:36', '2026-10-09 17:51:36'),
('ORD-7THBILY8', 'USR-EYAPFPRW', '2026-10-10 00:53:26', 36800000.00, 'Jalan karang tineung indah no 35', '2026-10-09 17:53:26', '2026-10-09 17:53:26'),
('ORD-KDXOB0BN', 'USR-EYAPFPRW', '2026-10-10 00:48:29', 1600000.00, 'Jalan karang tineung indah no 35', '2026-10-09 17:48:29', '2026-10-09 17:48:29'),
('ORD-LUY91PC3', 'USR-EYAPFPRW', '2026-10-10 01:50:35', 5200000.00, 'Jalan karang tineung indah no 35', '2026-10-09 18:50:35', '2026-10-09 18:50:35');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id_order` varchar(15) NOT NULL,
  `id_barang` varchar(10) NOT NULL,
  `harga_satuan` decimal(12,2) NOT NULL,
  `jumlah_beli` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id_order`, `id_barang`, `harga_satuan`, `jumlah_beli`, `created_at`, `updated_at`) VALUES
('ORD-5X7KZ74R', 'PRD001', 1600000.00, 1, '2026-10-09 17:51:36', '2026-10-09 17:51:36'),
('ORD-5X7KZ74R', 'PRD002', 1600000.00, 3, '2026-10-09 17:51:36', '2026-10-09 17:51:36'),
('ORD-5X7KZ74R', 'PRD003', 1600000.00, 2, '2026-10-09 17:51:36', '2026-10-09 17:51:36'),
('ORD-5X7KZ74R', 'PRD004', 2000000.00, 1, '2026-10-09 17:51:36', '2026-10-09 17:51:36'),
('ORD-5X7KZ74R', 'PRD005', 1750000.00, 1, '2026-10-09 17:51:36', '2026-10-09 17:51:36'),
('ORD-7THBILY8', 'PRD001', 1600000.00, 23, '2026-10-09 17:53:26', '2026-10-09 17:53:26'),
('ORD-KDXOB0BN', 'PRD001', 1600000.00, 1, '2026-10-09 17:48:29', '2026-10-09 17:48:29'),
('ORD-LUY91PC3', 'PRD003', 1600000.00, 2, '2026-10-09 18:50:35', '2026-10-09 18:50:35'),
('ORD-LUY91PC3', 'PRD004', 2000000.00, 1, '2026-10-09 18:50:35', '2026-10-09 18:50:35');

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` decimal(12,2) NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id_barang`, `nama_barang`, `deskripsi`, `harga`, `stok`, `gambar`, `created_at`, `updated_at`) VALUES
('PRD001', 'Yonex - Astrox 10 Navy Blue AX10EX Badminton Racket (4U-G5)', 'Raket badminton Yonex Astrox 10 dengan desain navy blue.', 1600000.00, 0, 'yonex.jpg', '2026-10-09 17:41:30', '2026-10-09 17:53:26'),
('PRD002', 'Yonex - Astrox 10 Olive Green AX10EX Badminton Racket (4U-G5)', 'Raket badminton Yonex Astrox 10 dengan desain olive green.', 1600000.00, 47, 'yonex2.jpg', '2026-10-09 17:41:30', '2026-10-09 17:51:36'),
('PRD003', 'Yonex - Astrox 10 White Pink AX10EX Badminton Racket (4U-G5)', 'Raket badminton Yonex Astrox 10 dengan desain white pink.', 1600000.00, 26, 'yonex3.jpg', '2026-10-09 17:41:30', '2026-10-09 18:50:35'),
('PRD004', 'Yonex - Astrox 3DG HF Blue White Durable Grade Badminton Racket AX3DGHF (4U-G5)', 'Raket badminton Yonex Astrox 3DG HF dengan desain blue white.', 2000000.00, 38, 'yonex4.jpg', '2026-10-09 17:41:30', '2026-10-09 18:50:35'),
('PRD005', 'Yonex - Astrox 3DG Red Black Durable Grade Badminton Racket AX3DG (4U-G5)', 'Raket badminton Yonex Astrox 3DG dengan desain red black.', 1750000.00, 14, 'yonex5.jpg', '2026-10-09 17:41:30', '2026-10-09 17:51:36'),
('PRD006', 'Yonex - Astrox 7DG Black Blue Durable Grade Badminton Racket AX7DGEX (4U-G5)', 'Raket badminton Yonex Astrox 7DG dengan desain black blue.', 2100000.00, 20, 'yonex6.jpg', '2026-10-09 17:41:30', '2026-10-09 17:41:30'),
('PRD007', 'Yonex - Voltric Lite 20i iSeries VTLT20IEX Blue Badminton Racket (5U-G5)', 'Raket badminton Yonex Voltric Lite 20i dengan desain blue.', 1100000.00, 60, 'yonex7.jpg', '2026-10-09 17:41:30', '2026-10-09 17:41:30'),
('PRD008', 'Yonex Arcsaber 1 CLEAR Blue Badminton Racket (5U-G5)', 'Raket badminton Yonex Arcsaber 1 dengan desain clear blue.', 1050000.00, 35, 'yonex8.jpg', '2026-10-09 17:41:30', '2026-10-09 17:41:30'),
('PRD009', 'Yonex Arcsaber 11 Play Grayish Pearl (Made In China) Badminton Racket (4U-G5)', 'Raket badminton Yonex Arcsaber 11 dengan desain grayish pearl.', 1500000.00, 25, 'yonex9.jpg', '2026-10-09 17:41:30', '2026-10-09 17:41:30'),
('PRD010', 'Yonex Arcsaber 2 ABILITY Black Pink Badminton Racket (4U-G5)', 'Raket badminton Yonex Arcsaber 2 dengan desain black pink.', 1800000.00, 20, 'yonex10.jpg', '2026-10-09 17:41:30', '2026-10-09 17:41:30');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` varchar(15) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('hJqd3XPP8PLzVVKPLvsVXkwDPud1BmfetmmL0Fii', 'USR-EYAPFPRW', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJlclNSMUlYYk1Dd28yNUJXSFhPc3N2aXE4MktCVmNXcEZnRmxaWG5NIiwiX2ZsYXNoIjp7Im5ldyI6W10sIm9sZCI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwMDBcL29yZGVycyIsInJvdXRlIjoib3JkZXJzLmluZGV4In0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoiVVNSLUVZQVBGUFJXIiwicGFzc3dvcmRfaGFzaF93ZWIiOiJlZGQxN2VjNzc5OWE4Mjc2MDFkZDEzMDBiOWM0YjEzMDVlNDQ0YTllOTczMmE3ZGMwMjlmOTFiOWU1MmM3NWZlIn0=', 1791597035),
('li1aK8T25Ujsj95bbDYckDC8QMGdnFyyBwWKYh0c', 'USR-EYAPFPRW', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJlZ0IwTFdUeEQ0SDFZREFlUjR3MVZQdlZGNnVqZzJhUlFNNmh0YmFFIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJ1cmwiOnsiaW50ZW5kZWQiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvbG9nb3V0In0sIl9wcmV2aW91cyI6eyJ1cmwiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvbG9naW4iLCJyb3V0ZSI6ImxvZ2luIn0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoiVVNSLUVZQVBGUFJXIiwicGFzc3dvcmRfaGFzaF93ZWIiOiJlZGQxN2VjNzc5OWE4Mjc2MDFkZDEzMDBiOWM0YjEzMDVlNDQ0YTllOTczMmE3ZGMwMjlmOTFiOWU1MmM3NWZlIn0=', 1791596636),
('sKJhlweng02aHckV3krXOyXvJiYwNgcf5CVYhIzZ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJIMlMzTU9UOGJOM21pdTVIb3BOdGdSVjAxU20xS0ZieHI3NkxBb0JxIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1791592952);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` varchar(15) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama_lengkap`, `email`, `username`, `password`, `no_hp`, `alamat`, `remember_token`, `created_at`, `updated_at`) VALUES
('USR-EYAPFPRW', 'Rizky Yanuar Irawan', 'rizkyyanuarirawan@gmail.com', 'rizky', '$2y$12$vce0Iq2pkHYwliZPS9zDd.EsIeutVAP3RS/5yF7VLEvsZVXz5TM72', '082126367502', 'Jalan karang tineung indah no 35', NULL, '2026-10-09 17:43:11', '2026-10-09 17:43:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `orders_id_user_foreign` (`id_user`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id_order`,`id_barang`),
  ADD KEY `order_details_id_barang_foreign` (`id_barang`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_barang`);

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
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `products` (`id_barang`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_id_order_foreign` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
