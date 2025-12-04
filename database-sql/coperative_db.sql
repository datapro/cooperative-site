-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2025 at 06:31 PM
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
-- Database: `coperative_db`
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

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('cooperative-society-company-cache-data2014@gmail.com|127.0.0.1', 'i:1;', 1762333206),
('cooperative-society-company-cache-data2014@gmail.com|127.0.0.1:timer', 'i:1762333206;', 1762333206),
('cooperative-society-company-cache-icefoxtravel@gmail.com|127.0.0.1', 'i:1;', 1762353169),
('cooperative-society-company-cache-icefoxtravel@gmail.com|127.0.0.1:timer', 'i:1762353169;', 1762353169),
('cooperative-society-company-cache-j@gmail.com|127.0.0.1', 'i:1;', 1762323524),
('cooperative-society-company-cache-j@gmail.com|127.0.0.1:timer', 'i:1762323524;', 1762323524),
('cooperative-society-company-cache-s@gmail.com|127.0.0.1', 'i:1;', 1762350851),
('cooperative-society-company-cache-s@gmail.com|127.0.0.1:timer', 'i:1762350851;', 1762350851);

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
-- Table structure for table `commodities`
--

CREATE TABLE `commodities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `unit` varchar(255) NOT NULL DEFAULT 'piece',
  `cost_price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `retail_price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `reorder_level` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `commodity_categories`
--

CREATE TABLE `commodity_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `commodity_orders`
--

CREATE TABLE `commodity_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `commodity_request_id` bigint(20) UNSIGNED DEFAULT NULL,
  `member_id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `total_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `balance` decimal(15,2) NOT NULL DEFAULT 0.00,
  `status` enum('pending','approved','fulfilled','cancelled','completed') NOT NULL DEFAULT 'pending',
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `commodity_requests`
--

CREATE TABLE `commodity_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','approved','rejected','completed') NOT NULL DEFAULT 'pending',
  `payment_option` varchar(100) NOT NULL,
  `price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `com_interest` decimal(10,2) DEFAULT NULL,
  `payment_amount` decimal(15,2) DEFAULT NULL,
  `payment_plan` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `commodity_requests`
--

INSERT INTO `commodity_requests` (`id`, `user_id`, `status`, `payment_option`, `price`, `com_interest`, `payment_amount`, `payment_plan`, `note`, `created_at`, `updated_at`) VALUES
(12, 16, 'approved', 'Cash', 5500.00, NULL, 5500.00, 'at ones', 'shoe', '2025-11-17 15:42:54', '2025-11-17 17:10:18'),
(13, 13, 'completed', 'Cash', 6000.00, NULL, 18500.00, 'at ones', 'wereerree', '2025-11-17 17:24:41', '2025-11-17 20:53:51'),
(14, 13, 'completed', 'Cash', 5500.00, NULL, NULL, 'at ones', 'ok', '2025-11-17 17:25:10', '2025-11-17 20:53:52'),
(15, 13, 'completed', 'Cash', 1000.00, NULL, NULL, 'at ones', 'ok', '2025-11-17 17:25:49', '2025-11-17 20:53:52'),
(16, 13, 'completed', 'Cash', 6000.00, NULL, NULL, 'at ones', 'laptop', '2025-11-17 18:28:42', '2025-11-17 20:53:52'),
(17, 13, 'completed', 'Cash', 6000.00, NULL, 6000.00, 'at ones', 'thank you', '2025-11-17 20:55:08', '2025-11-17 20:56:00'),
(18, 13, 'completed', 'Cash', 6000.00, NULL, 6000.00, 'at ones', 'new', '2025-11-17 21:00:46', '2025-11-17 21:01:18'),
(19, 13, 'completed', 'Cash', 6000.00, NULL, 6360.00, 'at ones', 'ok', '2025-11-17 21:05:49', '2025-11-17 21:07:42'),
(20, 13, 'completed', 'Cash', 6000.00, NULL, 6360.00, 'at ones', 'ok', '2025-11-17 21:15:01', '2025-11-17 21:16:04'),
(21, 13, 'completed', 'Cash', 8000.00, NULL, 8480.00, 'at ones', 'new', '2025-11-17 21:25:36', '2025-11-17 21:27:20'),
(22, 13, 'completed', 'Cash', 6000.00, NULL, 6360.00, 'at ones', 'ok', '2025-11-17 21:30:48', '2025-11-17 21:33:24'),
(23, 13, 'completed', 'Cash', 5500.00, NULL, 5830.00, 'at ones', 'yyy', '2025-11-17 21:33:43', '2025-11-17 21:47:16'),
(24, 16, 'approved', 'Cash', 200.00, NULL, NULL, 'at ones', 'new', '2025-11-18 16:48:09', '2025-11-20 08:30:50'),
(25, 16, 'approved', 'Cash', 1000.00, NULL, NULL, 'at ones', 'new', '2025-11-18 16:48:37', '2025-11-20 08:30:50'),
(26, 17, 'pending', 'Cash', 4000.00, NULL, NULL, 'at ones', 'bag', '2025-11-26 20:50:29', '2025-11-26 20:50:29'),
(27, 22, 'approved', 'Cash', 30000.00, NULL, 2000.00, '2 months', 'new', '2025-11-29 14:31:33', '2025-11-29 14:33:42'),
(28, 24, 'approved', 'cash', 0.00, NULL, NULL, NULL, NULL, '2025-11-29 15:56:50', '2025-11-29 15:56:50');

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
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `requested_amount` decimal(12,2) NOT NULL,
  `loan_type` varchar(255) DEFAULT NULL,
  `outstanding_balance` decimal(15,2) NOT NULL DEFAULT 0.00,
  `amount_repaid` decimal(15,2) NOT NULL DEFAULT 0.00,
  `excess_payment` decimal(12,2) NOT NULL DEFAULT 0.00,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `g_form` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `interest_rate` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `user_id`, `requested_amount`, `loan_type`, `outstanding_balance`, `amount_repaid`, `excess_payment`, `status`, `g_form`, `created_at`, `updated_at`, `interest_rate`) VALUES
(75, 22, 6000.00, 'Normal Loan', 0.00, 6360.00, 0.00, 'complete', '1764358760.pdf', '2025-11-28 18:39:20', '2025-11-28 18:41:13', 6.00),
(76, 22, 5000.00, 'Normal Loan', 0.00, 5250.00, 0.00, 'complete', '1764359209.pdf', '2025-11-28 18:46:49', '2025-11-28 18:49:07', 5.00),
(77, 22, 4000.00, 'Normal Loan', 0.00, 4200.00, 0.00, 'complete', '1764359450.pdf', '2025-11-28 18:50:50', '2025-11-28 18:52:31', 5.00),
(78, 22, 5000.00, 'Normal Loan', 0.00, 5250.00, 0.00, 'complete', '1764359662.pdf', '2025-11-28 18:54:22', '2025-11-28 19:23:57', 5.00),
(79, 22, 600.00, 'Normal Loan', 0.00, 630.00, 0.00, 'complete', '1764360790.pdf', '2025-11-28 19:13:10', '2025-11-29 15:14:47', 5.00),
(80, 22, 7000.00, 'Normal Loan', 0.00, 1320.00, 0.00, 'approved', '1764366336.pdf', '2025-11-28 20:45:36', '2025-11-29 15:17:51', 5.00),
(81, 24, 4000.00, NULL, 0.00, 0.00, 0.00, 'approved', 'system-auto-approved', '2025-11-29 16:05:19', '2025-11-29 16:05:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `loan_repayments`
--

CREATE TABLE `loan_repayments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loan_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount_repaid` decimal(15,2) NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `process_charge` decimal(10,2) NOT NULL DEFAULT 0.00
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
(25, '0001_01_01_000000_create_users_table', 1),
(26, '0001_01_01_000001_create_cache_table', 1),
(27, '0001_01_01_000002_create_jobs_table', 1),
(28, '2025_10_22_152709_create_savings_table', 1),
(29, '2025_10_23_113444_add_user_id_to_savings_table', 1),
(30, '2025_10_24_074855_add_type_to_savings_table', 1),
(31, '2025_10_24_132347_create_loans_table', 1),
(32, '2025_10_25_094202_add_total_savings_to_savings_table', 1),
(37, '2025_10_27_120013_make_amount_borrowed_nullable_in_loans_table', 2),
(38, '2025_10_28_164934_make_occupation_and_passport_nullable_in_users_table', 2),
(39, '2025_10_30_074606_add_status_to_savings_table', 3),
(42, '2025_11_01_072457_create_loan_repayments_table', 4),
(45, '2025_11_01_073128_create_loan_repayments_table', 5),
(46, '2025_11_02_100755_create_savings_table', 5),
(47, '2025_11_02_125351_add_total_savings_to_users_table', 6),
(48, '2025_11_02_130153_add_is_applied_to_savings_table', 7),
(50, '2025_11_02_145554_add_interest_rate_and_duration_to_loans_table', 8),
(51, '2025_11_02_175438_add_total_savings_to_savings_table', 9),
(52, '2025_11_05_052014_add_is_admin_to_users_table', 10),
(53, '2025_11_07_121947_add_outstanding_balance_to_loans_table', 11),
(54, '2025_11_07_123501_create_transactions_table', 12),
(62, '2025_11_13_193048_add_process_charge_to_repayments_table', 13),
(63, '2025_11_14_062437_create_transactions_table', 13),
(64, '2025_11_14_103113_add_loan_type_to_transactions_table', 13),
(65, '2025_11_15_221056_create_commodity_categories_table', 14),
(68, '2025_11_15_215206_create_commodities_table', 15),
(69, '2025_11_15_215344_create_inventory_movements_table', 15),
(70, '2025_11_15_220037_create_commodity_order_items_table', 16),
(71, '2025_11_15_220146_create_repayments_table', 16),
(72, '2025_11_15_223850_create_transactions_table', 17),
(75, '2025_11_16_002847_add_price_to_commodity_requests_table', 18),
(76, '2025_11_16_095237_add_payment_plan_to_commodity_requests_table', 19),
(77, '2025_11_16_111506_change_payment_option_column_type_in_commodity_requests_table', 20),
(78, '2025_11_16_112222_change_created_by_type_in_commodity_requests_table', 21),
(80, '2025_11_16_150503_add_approved_price_to_commodity_requests_table', 22),
(81, '2025_11_17_153111_add_payment_amount_to_commodity_requests_table', 23),
(83, '2025_11_17_211441_add_com_interest_to_commodity_requests_table', 24),
(84, '2025_11_27_060910_add_ledger_and_balances_to_users_table', 24),
(85, '2025_11_27_083238_add_savings_b_f_to_savings_table', 25),
(86, '2025_11_28_174133_remove_default_interest_rate_from_loans_table', 26),
(87, '2025_11_28_174438_remove_duration_months_from_loans_table', 26),
(88, '2025_11_28_180420_add_loan_type_to_loans_table', 27),
(89, '2025_11_28_183614_add_excess_payment_to_loans_table', 28),
(91, '2025_11_28_185740_add_excess_payment_to_transactions_table', 29),
(92, '2025_11_28_191040_add_excess_payment_to_loans_table', 30);

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
-- Table structure for table `savings`
--

CREATE TABLE `savings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `remark` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `total_savings` decimal(15,2) NOT NULL DEFAULT 0.00,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_applied` tinyint(1) NOT NULL DEFAULT 0,
  `savingsBF` decimal(15,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `savings`
--

INSERT INTO `savings` (`id`, `remark`, `user_id`, `amount`, `total_savings`, `status`, `approved_by`, `approved_at`, `created_at`, `updated_at`, `is_applied`, `savingsBF`) VALUES
(26, 'Approved', 22, 2000.00, 2000.00, 'approved', NULL, NULL, '2025-11-27 07:41:27', '2025-11-28 15:07:15', 1, 0.00),
(27, 'Approved', 22, 2000.00, 2000.00, 'approved', NULL, NULL, '2025-11-27 07:44:11', '2025-11-28 15:07:15', 1, 0.00),
(28, 'Approved', 22, 4000.00, 4000.00, 'approved', NULL, NULL, '2025-11-27 07:57:15', '2025-11-28 15:07:15', 1, 0.00),
(29, 'Approved', 22, 2000.00, 2000.00, 'approved', NULL, NULL, '2025-11-27 08:12:53', '2025-11-28 15:07:15', 1, 0.00),
(30, 'Approved', 24, 38000.00, 3000.00, 'approved', NULL, NULL, '2025-11-27 08:17:57', '2025-11-29 16:05:19', 1, 0.00),
(31, 'Approved', 24, 3000.00, 3000.00, 'approved', NULL, NULL, '2025-11-27 09:17:24', '2025-11-27 09:19:05', 1, 0.00),
(32, 'Approved', 24, 2000.00, 2000.00, 'approved', NULL, NULL, '2025-11-28 16:27:11', '2025-11-28 16:28:41', 1, 0.00),
(33, 'Approved', 22, 5000.00, 5000.00, 'approved', NULL, NULL, '2025-11-28 20:01:18', '2025-11-28 20:01:38', 1, 0.00),
(34, 'Approved', 22, 4000.00, 4000.00, 'approved', NULL, NULL, '2025-11-28 20:41:23', '2025-11-28 20:43:40', 1, 0.00);

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
('qLveXuFS653bAx9NIIB6tUGSg2HFKapuq5axzK0R', 22, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRXZUY0VaUUxQbEdiTDAxdkx3eWl5MGRObFFnT2sxcXU0STQ0QjdHMyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjI7fQ==', 1764436905);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `loan_type` varchar(225) NOT NULL,
  `processing_charge` varchar(225) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `excess_payment` decimal(12,2) NOT NULL DEFAULT 0.00,
  `note` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `type`, `loan_type`, `processing_charge`, `amount`, `excess_payment`, `note`, `created_at`, `updated_at`) VALUES
(28, 22, 'Loan Repayment', 'Normal Loan', '0', '4000', 0.00, 'Repayment applied to loan #75', '2025-11-28 18:40:33', '2025-11-28 18:40:33'),
(29, 22, 'Loan Repayment', 'Normal Loan', '0', '2000', 0.00, 'Repayment applied to loan #75', '2025-11-28 18:40:50', '2025-11-28 18:40:50'),
(30, 22, 'Loan Repayment', 'Normal Loan', '0', '360', 0.00, 'Repayment applied to loan #75', '2025-11-28 18:41:13', '2025-11-28 18:41:13'),
(31, 22, 'Loan Repayment', 'Normal Loan', '0', '5250', 0.00, 'Repayment applied to loan #76', '2025-11-28 18:49:08', '2025-11-28 18:49:08'),
(32, 22, 'Loan Repayment', 'Normal Loan', '0', '4200', 0.00, 'Repayment applied to loan #77', '2025-11-28 18:52:32', '2025-11-28 18:52:32'),
(33, 22, 'Loan Repayment', 'Normal Loan', '0', '700', 0.00, 'Repayment applied to loan #78', '2025-11-28 19:14:18', '2025-11-28 19:14:18'),
(34, 22, 'Loan Repayment', 'Normal Loan', '0', '4550', 0.00, 'Repayment applied to loan #78', '2025-11-28 19:23:57', '2025-11-28 19:23:57'),
(35, 22, 'Loan Repayment', 'Normal Loan', '0', '450', 0.00, 'Repayment applied to loan #79', '2025-11-28 19:23:58', '2025-11-28 19:23:58'),
(36, 22, 'Loan Repayment', 'Normal Loan', '1000', '180', 0.00, 'Repayment applied to loan #79', '2025-11-29 15:14:47', '2025-11-29 15:14:47'),
(37, 22, 'Loan Repayment', 'Normal Loan', '1000', '320', 0.00, 'Repayment applied to loan #80', '2025-11-29 15:14:47', '2025-11-29 15:14:47'),
(38, 22, 'Loan Repayment', 'Normal Loan', '500', '1000', 0.00, 'Repayment applied to loan #80', '2025-11-29 15:17:51', '2025-11-29 15:17:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ledger_no` varchar(255) DEFAULT NULL,
  `savingsBF` varchar(100) NOT NULL DEFAULT '0.00',
  `loanBF` varchar(100) NOT NULL DEFAULT '0.00',
  `commBF` varchar(100) NOT NULL DEFAULT '0.00',
  `name` varchar(255) NOT NULL,
  `department` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `membership_no` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `total_savings` decimal(15,2) NOT NULL DEFAULT 0.00,
  `address` varchar(255) DEFAULT NULL,
  `passport` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ledger_no`, `savingsBF`, `loanBF`, `commBF`, `name`, `department`, `occupation`, `membership_no`, `status`, `total_savings`, `address`, `passport`, `phone`, `email`, `is_admin`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(22, '304344NU', '19000', '4000', '2000', 'Samson', NULL, NULL, '3333ADC', 'active', 11000.00, NULL, '1764230046.png', '070324405', 'data@gmail.com', 1, NULL, '$2y$12$BxIIahyKVPh35k6YsdinsOnsCttFnx8XTRHc4aDVCIVw6z5mqIlLG', NULL, '2025-11-27 06:47:49', '2025-11-28 20:43:40'),
(24, '304344NU', '38000', '4000', '2000', 'Daniel', NULL, NULL, '3333ADC', 'active', 8000.00, NULL, '1764435919.webp', NULL, 'd@gmail.com', 0, NULL, '$2y$12$Y.ZtDDxE5K8lnmr3TpD74uDyEI.KtNAdio892y6RW3VIhb0Sb062i', NULL, '2025-11-27 08:16:39', '2025-11-29 16:05:19');

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
-- Indexes for table `commodities`
--
ALTER TABLE `commodities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `commodities_sku_unique` (`sku`),
  ADD KEY `commodities_category_id_foreign` (`category_id`);

--
-- Indexes for table `commodity_categories`
--
ALTER TABLE `commodity_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commodity_orders`
--
ALTER TABLE `commodity_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commodity_orders_commodity_request_id_foreign` (`commodity_request_id`);

--
-- Indexes for table `commodity_requests`
--
ALTER TABLE `commodity_requests`
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
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loans_user_id_foreign` (`user_id`);

--
-- Indexes for table `loan_repayments`
--
ALTER TABLE `loan_repayments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loan_repayments_loan_id_foreign` (`loan_id`),
  ADD KEY `loan_repayments_user_id_foreign` (`user_id`);

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
-- Indexes for table `savings`
--
ALTER TABLE `savings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `savings_user_id_foreign` (`user_id`),
  ADD KEY `savings_approved_by_foreign` (`approved_by`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for table `commodities`
--
ALTER TABLE `commodities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `commodity_categories`
--
ALTER TABLE `commodity_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `commodity_orders`
--
ALTER TABLE `commodity_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `commodity_requests`
--
ALTER TABLE `commodity_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `loan_repayments`
--
ALTER TABLE `loan_repayments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `savings`
--
ALTER TABLE `savings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commodities`
--
ALTER TABLE `commodities`
  ADD CONSTRAINT `commodities_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `commodity_categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `commodity_orders`
--
ALTER TABLE `commodity_orders`
  ADD CONSTRAINT `commodity_orders_commodity_request_id_foreign` FOREIGN KEY (`commodity_request_id`) REFERENCES `commodity_requests` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `loan_repayments`
--
ALTER TABLE `loan_repayments`
  ADD CONSTRAINT `loan_repayments_loan_id_foreign` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `loan_repayments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `savings`
--
ALTER TABLE `savings`
  ADD CONSTRAINT `savings_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `savings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
