-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 13, 2026 at 06:37 AM
-- Server version: 8.4.7
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newtodinventory_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(2, 'Chase Stafford', 'Ut doloribus iste at', '2026-08-11 15:12:29', '2026-08-11 15:12:29'),
(3, 'dsd', 'dsd', '2026-08-12 00:44:43', '2026-08-12 00:44:43'),
(4, 'somes', 'test', '2026-08-12 09:48:38', '2026-08-12 09:48:38'),
(5, 'show', 'make', '2026-08-12 09:48:46', '2026-08-12 09:48:46'),
(6, 'Electronics', 'Dell Inspiron 15 laptop with Intel Core i5 processor, 8GB', '2026-08-12 09:59:33', '2026-08-12 09:59:33'),
(7, 'Timon Garza', 'sas', '2026-08-12 10:15:58', '2026-08-12 10:15:58'),
(9, 'dsdsd', 'dsdsdf', '2026-08-13 00:29:56', '2026-08-13 00:29:56');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_customer_code_unique` (`customer_code`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_code`, `name`, `email`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Trevor Cotton', 'lycufidy@mailinator.com', '+1 (425) 453-8765', 'Sit consequatur vol', '2026-08-12 00:43:25', '2026-08-12 00:43:25'),
(4, 'CUST-ODYTQZ', 'Odysseus Lambert', 'focoq@mailinator.com', '+1 (383) 985-6696', 'Reprehenderit sed d', '2026-08-12 06:51:45', '2026-08-12 06:51:45'),
(5, 'CUST-JCAIVW', 'Timon Garza', 'jegojon@mailinator.com', '977686576721', 'ds', '2026-08-12 09:51:49', '2026-08-13 00:37:47'),
(6, 'Iure quo cillum enim', 'Gregory Kinney', 'bugeny@mailinator.com', '+1 (929) 163-6332', 'Consequatur ut amet', '2026-08-13 00:38:00', '2026-08-13 00:38:00'),
(7, 'CUST-O1S2BH', 'rohansss', 'dd@mailinator.com', '3434545423', 'ffdsdf', '2026-08-13 00:47:34', '2026-08-13 00:47:34');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_08_11_194736_add_role_to_users_table', 1),
(5, '2026_08_11_195910_create_categories_table', 1),
(6, '2026_08_11_200028_create_products_table', 1),
(7, '2026_08_11_200126_create_brands_table', 1),
(8, '2026_08_11_200458_create_suppliers_table', 1),
(9, '2026_08_11_200514_create_customers_table', 1),
(10, '2026_08_11_200524_create_purchases_table', 1),
(11, '2026_08_11_200525_create_purchase_items_table', 1),
(12, '2026_08_11_200550_create_sales_table', 1),
(13, '2026_08_11_200551_create_sale_items_table', 1),
(14, '2026_08_11_200603_create_stock_movements_table', 1),
(15, '2026_08_12_064123_create_settings_table', 2),
(16, '2026_08_12_065018_add_product_code_to_products_table', 3),
(17, '2026_08_12_065239_make_brand_id_nullable_in_products_table', 4),
(18, '2026_08_12_065747_make_sku_nullable_in_products_table', 5),
(19, '2026_08_12_120303_add_supplier_code_to_suppliers_table', 6),
(20, '2026_08_12_122057_add_customer_code_to_customers_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(10,2) NOT NULL,
  `cost_price` decimal(10,2) NOT NULL,
  `stock_quantity` int NOT NULL DEFAULT '0',
  `minimum_stock` int NOT NULL DEFAULT '10',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `brand_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_sku_unique` (`sku`),
  UNIQUE KEY `products_product_code_unique` (`product_code`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_brand_id_foreign` (`brand_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_code`, `name`, `sku`, `barcode`, `description`, `price`, `cost_price`, `stock_quantity`, `minimum_stock`, `image`, `category_id`, `brand_id`, `created_at`, `updated_at`) VALUES
(1, 'Veniam deserunt cup', 'Elton Harrington', 'Eligendi mollitia an', 'Quae quae porro omni', 'Quis consectetur no', 526.00, 913.00, 32, 320, NULL, 3, NULL, '2026-08-12 02:17:39', '2026-08-12 11:16:03'),
(2, 'Sint velit reiciend', 'Cedric Atkinson', 'Quo cupidatat conseq', 'Dolore odit voluptat', 'Mollit architecto cu', 284.00, 494.00, 20, 71, NULL, 3, NULL, '2026-08-12 02:18:49', '2026-08-12 11:28:58'),
(4, 'Voluptas nihil conse', 'Vincent Key', 'MC122323', 'Officia dignissimos', 'Fugit aspernatur om', 4967.00, 4000.00, 308, 23, 'products/97pyX1r3Sc7XCUSMwkipnBdLzaaFKb5Qb72AU8zi.png', 5, NULL, '2026-08-12 09:49:37', '2026-08-13 00:50:11'),
(5, 'Iure voluptatibus ul', 'USB Hub', 'Iure est consectetu', 'Ut eos debitis deser', 'Enim ipsum natus ad', 244.00, 6534.00, 675, 61, 'products/lBubUsUm5xqVlyCh5CxQFSmtP8TMaKTmnP4NVSLN.png', 5, NULL, '2026-08-12 09:50:17', '2026-08-13 00:50:43'),
(6, 'Consequat Asperiore', 'Abbot Russo', 'Aute qui non laudant', 'Libero commodo ut si', 'Deleniti omnis non v', 658.00, 490.00, 32, 3, NULL, 3, NULL, '2026-08-12 09:55:30', '2026-08-12 11:16:56'),
(7, 'PROD-001', 'Dell 15', 'DELL-INS-15', '8901234567001', 'Dell Inspiron 15 laptop with Intel Core i5 processor, 8GB RAM', 500.00, 45000.00, 160, 118, NULL, 6, NULL, '2026-08-12 10:00:31', '2026-08-12 13:01:27'),
(8, 'ESA32312121', 'Cedric Atkinson', '23232', 'Tempor est possimus', 'Et deleniti quia nos', 595.00, 673.00, 32, 3223, NULL, 7, NULL, '2026-08-12 11:06:54', '2026-08-12 11:17:14'),
(9, 'Dolor pariatur Obca', 'Megan Collier', 'Proident quia minus', 'Voluptas aut aperiam', 'Dolor dolore volupta', 59.00, 18.00, 0, 1, NULL, 3, NULL, '2026-08-12 11:21:17', '2026-08-12 11:21:17'),
(10, 'Illum nostrud commo', 'Patience Serrano', 'Illum illum deleni', 'Aut corporis dolores', 'Dolore consequatur', 764.00, 239.00, 713, 59, NULL, 3, NULL, '2026-08-12 11:42:46', '2026-08-12 11:42:46'),
(11, 'Voluptates et dolore', 'Yvonne Weeks', 'Deleniti nisi iusto', 'Esse maiores consequ', 'In beatae vitae eaqu', 130.00, 256.00, 550, 63, NULL, 7, NULL, '2026-08-12 11:42:57', '2026-08-12 11:42:57'),
(12, 'Veniam enim accusam', 'Dalton Armstrong', 'Explicabo Officiis', 'Quia fugit ut quibu', 'Rerum vel sunt veli', 543.00, 201.00, 820, 95, NULL, 3, NULL, '2026-08-13 00:30:51', '2026-08-13 00:48:05'),
(13, 'Ut magni aut est dol', 'Tana Gray', 'Doloribus omnis cumq', 'A voluptate quo hic', 'Quia aut vel alias n', 25.00, 399.00, 964, 91, 'products/Gi6yPGKV41flWKXjgtXlbYXBc6wuhGQNXvxEqKZf.png', 9, NULL, '2026-08-13 00:34:14', '2026-08-13 00:49:40'),
(14, 'Ex quia architecto d', 'Yardley Stewart', 'Dolore Nam est ipsam', 'Consectetur nulla do', 'Magnam aperiam volup', 860.00, 307.00, 828, 96, 'products/TpKyT56rPV75s9CwwtxNL1Ys2RxpiGWzrRQTEoeL.png', 4, NULL, '2026-08-13 00:46:53', '2026-08-13 00:48:55'),
(15, 'Eos maxime est sint', 'Maia Scott', 'Nihil ut maiores off', 'Et quibusdam exercit', 'Consectetur omnis ip', 545.00, 785.00, 326, 68, 'products/4bWiAdWbBq9GGga1sBAE3fSMm7EhWFFSRMT9IVXO.png', 4, NULL, '2026-08-13 00:49:18', '2026-08-13 00:49:18');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

DROP TABLE IF EXISTS `purchases`;
CREATE TABLE IF NOT EXISTS `purchases` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `purchase_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` bigint UNSIGNED NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `purchase_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `purchases_purchase_number_unique` (`purchase_number`),
  KEY `purchases_supplier_id_foreign` (`supplier_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `purchase_number`, `supplier_id`, `total_amount`, `purchase_date`, `created_at`, `updated_at`) VALUES
(6, 'PUR-6A7C6CDE4FA68', 1, 10302.00, '2026-08-12', '2026-08-12 07:24:01', '2026-08-12 07:24:11'),
(2, 'PUR-1786520896', 1, 32.00, '2026-08-12', '2026-08-12 02:18:25', '2026-08-12 07:24:38'),
(3, 'PUR-1786520952', 2, 10336.00, '2026-08-12', '2026-08-12 02:19:22', '2026-08-12 02:19:22'),
(7, 'PUR-6A7C6CF8E8930', 1, 129.00, '2026-08-12', '2026-08-12 07:24:27', '2026-08-12 07:24:27'),
(8, 'PUR-6A7C94011E58E', 7, 60000.00, '2026-08-12', '2026-08-12 10:11:08', '2026-08-12 10:11:08'),
(9, 'PUR-6A7C9492F2035', 7, 96.00, '2026-08-12', '2026-08-12 10:13:29', '2026-08-12 10:13:29'),
(10, 'PUR-6A7C95519F99A', 2, 75072.00, '2026-08-12', '2026-08-12 10:16:42', '2026-08-12 10:16:42'),
(11, 'PUR-6A7C957A4467F', 6, 10336.00, '2026-08-12', '2026-08-12 10:17:17', '2026-08-12 10:17:17'),
(12, 'PUR-6A7CA85A11F74', 1, 229600.00, '2026-08-12', '2026-08-12 11:37:59', '2026-08-12 13:01:27'),
(13, 'PUR-6A7CB35F90FFA', 1, 10982.00, '2026-08-12', '2026-08-12 12:24:58', '2026-08-12 12:51:12'),
(14, 'PUR-6A7CB71742F01', 1, 5589.00, '2026-08-12', '2026-08-12 12:40:44', '2026-08-12 12:50:46'),
(15, 'PUR-6A7D61EA2E915', 2, 9669.00, '2026-08-13', '2026-08-13 00:49:40', '2026-08-13 00:49:40');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_items`
--

DROP TABLE IF EXISTS `purchase_items`;
CREATE TABLE IF NOT EXISTS `purchase_items` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `purchase_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchase_items_purchase_id_foreign` (`purchase_id`),
  KEY `purchase_items_product_id_foreign` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_items`
--

INSERT INTO `purchase_items` (`id`, `purchase_id`, `product_id`, `quantity`, `unit_price`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 0.00, 0.00, '2026-08-12 02:18:09', '2026-08-12 02:18:09'),
(12, 2, 1, 1, 32.00, 32.00, '2026-08-12 07:24:38', '2026-08-12 07:24:38'),
(3, 3, 2, 32, 323.00, 10336.00, '2026-08-12 02:19:22', '2026-08-12 02:19:22'),
(8, 4, 1, 2, 40.00, 80.00, '2026-08-12 07:23:00', '2026-08-12 07:23:00'),
(6, 5, 2, 13, 2.00, 26.00, '2026-08-12 07:22:18', '2026-08-12 07:22:18'),
(10, 6, 2, 3, 3434.00, 10302.00, '2026-08-12 07:24:11', '2026-08-12 07:24:11'),
(11, 7, 1, 3, 43.00, 129.00, '2026-08-12 07:24:27', '2026-08-12 07:24:27'),
(13, 8, 7, 20, 3000.00, 60000.00, '2026-08-12 10:11:08', '2026-08-12 10:11:08'),
(14, 9, 4, 3, 32.00, 96.00, '2026-08-12 10:13:29', '2026-08-12 10:13:29'),
(15, 10, 5, 32, 2323.00, 74336.00, '2026-08-12 10:16:42', '2026-08-12 10:16:42'),
(16, 10, 2, 32, 23.00, 736.00, '2026-08-12 10:16:42', '2026-08-12 10:16:42'),
(17, 11, 6, 32, 323.00, 10336.00, '2026-08-12 10:17:17', '2026-08-12 10:17:17'),
(26, 12, 7, 28, 8200.00, 229600.00, '2026-08-12 13:01:27', '2026-08-12 13:01:27'),
(23, 13, 5, 34, 323.00, 10982.00, '2026-08-12 12:51:12', '2026-08-12 12:51:12'),
(22, 14, 4, 23, 243.00, 5589.00, '2026-08-12 12:50:46', '2026-08-12 12:50:46'),
(27, 15, 13, 3, 3223.00, 9669.00, '2026-08-13 00:49:40', '2026-08-13 00:49:40');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
CREATE TABLE IF NOT EXISTS `sales` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `sale_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sales_invoice_number_unique` (`invoice_number`),
  KEY `sales_customer_id_foreign` (`customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `invoice_number`, `customer_id`, `total_amount`, `sale_date`, `created_at`, `updated_at`) VALUES
(1, 'INV-1786546138', 4, 6.00, '2026-08-12', '2026-08-12 09:19:07', '2026-08-12 09:19:07'),
(6, 'INV-1786557466', 5, 766656.00, '2026-08-12', '2026-08-12 12:28:25', '2026-08-12 12:28:25'),
(3, 'INV-1786549413', 5, 3.00, '2026-08-12', '2026-08-12 10:13:52', '2026-08-12 10:13:52'),
(4, 'INV-1786549474', 5, 10336.00, '2026-08-12', '2026-08-12 10:14:43', '2026-08-12 10:14:43'),
(5, 'INV-1786554566', 4, 200.00, '2026-08-12', '2026-08-12 11:39:38', '2026-08-12 11:39:38'),
(7, 'INV-1786559504', 4, 11356.00, '2026-08-12', '2026-08-12 13:02:28', '2026-08-12 13:02:28');

-- --------------------------------------------------------

--
-- Table structure for table `sale_items`
--

DROP TABLE IF EXISTS `sale_items`;
CREATE TABLE IF NOT EXISTS `sale_items` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `sale_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sale_items_sale_id_foreign` (`sale_id`),
  KEY `sale_items_product_id_foreign` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_items`
--

INSERT INTO `sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 2, 3.00, 6.00, '2026-08-12 09:19:07', '2026-08-12 09:19:07'),
(2, 2, 7, 40, 500000.00, 20000000.00, '2026-08-12 10:11:49', '2026-08-12 10:11:49'),
(3, 3, 2, 1, 3.00, 3.00, '2026-08-12 10:13:52', '2026-08-12 10:13:52'),
(4, 4, 5, 32, 323.00, 10336.00, '2026-08-12 10:14:43', '2026-08-12 10:14:43'),
(5, 5, 7, 1, 200.00, 200.00, '2026-08-12 11:39:38', '2026-08-12 11:39:38'),
(6, 6, 5, 33, 23232.00, 766656.00, '2026-08-12 12:28:25', '2026-08-12 12:28:25'),
(7, 7, 4, 34, 334.00, 11356.00, '2026-08-12 13:02:28', '2026-08-12 13:02:28'),
(8, 8, 4, 1, 4343.00, 4343.00, '2026-08-13 00:50:11', '2026-08-13 00:50:11'),
(9, 9, 5, 1, 4343.00, 4343.00, '2026-08-13 00:50:43', '2026-08-13 00:50:43');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('u1Z0Gt7evhXz0wBanu7Oh8ygb0EnlnqWBkv4e9jB', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJWSU5XbllpYmVKMXZ2MTdQSkNTMGV0TE5yakw1bHQyZHNIaHk2aVR1IiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwMDBcL2xvZ2luIiwicm91dGUiOiJsb2dpbiJ9LCJ1cmwiOnsiaW50ZW5kZWQiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvcHJvZHVjdHMifX0=', 1786602608);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'My Inventory',
  `currency` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'USD',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_movements`
--

DROP TABLE IF EXISTS `stock_movements`;
CREATE TABLE IF NOT EXISTS `stock_movements` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `type` enum('IN','OUT') COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stock_movements_product_id_foreign` (`product_id`),
  KEY `stock_movements_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_movements`
--

INSERT INTO `stock_movements` (`id`, `product_id`, `quantity`, `type`, `reference`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'IN', 'Purchase #PUR-1786520880', 2, '2026-08-12 02:18:09', '2026-08-12 02:18:09'),
(2, 1, 1, 'IN', 'Purchase #PUR-1786520896', 2, '2026-08-12 02:18:25', '2026-08-12 02:18:25'),
(3, 2, 32, 'IN', 'Purchase #PUR-1786520952', 2, '2026-08-12 02:19:22', '2026-08-12 02:19:22'),
(4, 1, 1, 'IN', 'Purchase #PUR-1786535526', 2, '2026-08-12 06:22:15', '2026-08-12 06:22:15'),
(5, 2, 32, 'IN', '434', 2, '2026-08-12 07:01:52', '2026-08-12 07:01:52'),
(6, 2, 32, 'IN', '434', 2, '2026-08-12 07:01:52', '2026-08-12 07:01:52'),
(7, 2, 3, 'OUT', 'sd', 2, '2026-08-12 07:02:04', '2026-08-12 07:02:04'),
(8, 2, 3, 'OUT', 'sd', 2, '2026-08-12 07:02:05', '2026-08-12 07:02:05'),
(9, 2, 1, 'IN', 'Purchase #PUR-6A7C6B0156E00', 2, '2026-08-12 07:16:04', '2026-08-12 07:16:04'),
(10, 2, 13, 'IN', 'Purchase Updated #PUR-6A7C6B0156E00', 2, '2026-08-12 07:22:18', '2026-08-12 07:22:18'),
(11, 1, 2, 'IN', 'Purchase Updated #PUR-1786535526', 2, '2026-08-12 07:22:45', '2026-08-12 07:22:45'),
(12, 1, 2, 'IN', 'Purchase Updated #PUR-1786535526', 2, '2026-08-12 07:23:00', '2026-08-12 07:23:00'),
(13, 2, 3, 'IN', 'Purchase #PUR-6A7C6CDE4FA68', 2, '2026-08-12 07:24:01', '2026-08-12 07:24:01'),
(14, 2, 3, 'IN', 'Purchase Updated #PUR-6A7C6CDE4FA68', 2, '2026-08-12 07:24:11', '2026-08-12 07:24:11'),
(15, 1, 3, 'IN', 'Purchase #PUR-6A7C6CF8E8930', 2, '2026-08-12 07:24:27', '2026-08-12 07:24:27'),
(16, 1, 1, 'IN', 'Purchase Updated #PUR-1786520896', 2, '2026-08-12 07:24:38', '2026-08-12 07:24:38'),
(17, 2, 2, 'OUT', 'Sale Invoice #INV-1786546138', 2, '2026-08-12 09:19:07', '2026-08-12 09:19:07'),
(18, 2, 2, 'OUT', 'purchase', 2, '2026-08-12 09:52:26', '2026-08-12 09:52:26'),
(19, 1, 30, 'IN', 'sales', 2, '2026-08-12 09:52:58', '2026-08-12 09:52:58'),
(20, 2, 674, 'IN', 'te', 2, '2026-08-12 09:55:05', '2026-08-12 09:55:05'),
(34, 7, 1, 'IN', '21', 2, '2026-08-12 11:23:30', '2026-08-12 11:23:30'),
(35, 7, 10, 'IN', 'vc', 2, '2026-08-12 11:25:13', '2026-08-12 11:25:13'),
(36, 7, 1, 'IN', 'fd', 2, '2026-08-12 11:28:25', '2026-08-12 11:28:25'),
(37, 7, 12, 'IN', 'sale', 2, '2026-08-12 11:36:35', '2026-08-12 11:36:35'),
(38, 7, 12, 'OUT', 'purchase', 2, '2026-08-12 11:37:10', '2026-08-12 11:37:10'),
(26, 2, 1, 'OUT', 'Sale Invoice #INV-1786549413', 2, '2026-08-12 10:13:52', '2026-08-12 10:13:52'),
(27, 5, 32, 'OUT', 'Sale Invoice #INV-1786549474', 2, '2026-08-12 10:14:43', '2026-08-12 10:14:43'),
(28, 5, 32, 'IN', 'Purchase #PUR-6A7C95519F99A', 2, '2026-08-12 10:16:42', '2026-08-12 10:16:42'),
(29, 2, 32, 'IN', 'Purchase #PUR-6A7C95519F99A', 2, '2026-08-12 10:16:42', '2026-08-12 10:16:42'),
(30, 6, 32, 'IN', 'Purchase #PUR-6A7C957A4467F', 2, '2026-08-12 10:17:17', '2026-08-12 10:17:17'),
(31, 6, 32, 'IN', 'sale', 2, '2026-08-12 10:26:44', '2026-08-12 10:26:44'),
(32, 5, 9, 'IN', 'fd', 2, '2026-08-12 11:14:29', '2026-08-12 11:14:29'),
(33, 7, 110, 'OUT', 'sales', 2, '2026-08-12 11:18:34', '2026-08-12 11:18:34'),
(39, 7, 2, 'IN', 'Purchase #PUR-6A7CA85A11F74', 2, '2026-08-12 11:37:59', '2026-08-12 11:37:59'),
(40, 7, 4, 'IN', 'Purchase Updated #PUR-6A7CA85A11F74', 2, '2026-08-12 11:38:38', '2026-08-12 11:38:38'),
(41, 7, 1, 'OUT', 'Sale Invoice #INV-1786554566', 2, '2026-08-12 11:39:38', '2026-08-12 11:39:38'),
(42, 5, 32, 'IN', 'Purchase #PUR-6A7CB35F90FFA', 2, '2026-08-12 12:24:59', '2026-08-12 12:24:59'),
(43, 5, 33, 'OUT', 'Sale Invoice #INV-1786557466', 2, '2026-08-12 12:28:25', '2026-08-12 12:28:25'),
(44, 4, 23, 'IN', 'Purchase #PUR-6A7CB71742F01', 2, '2026-08-12 12:40:44', '2026-08-12 12:40:44'),
(45, 4, 23, 'IN', 'Purchase Updated #PUR-6A7CB71742F01', 2, '2026-08-12 12:50:46', '2026-08-12 12:50:46'),
(46, 5, 34, 'IN', 'Purchase Updated #PUR-6A7CB35F90FFA', 2, '2026-08-12 12:51:12', '2026-08-12 12:51:12'),
(47, 7, 36, 'IN', 'Purchase Updated #PUR-6A7CA85A11F74', 2, '2026-08-12 12:51:40', '2026-08-12 12:51:40'),
(48, 7, 28, 'IN', 'Purchase Updated #PUR-6A7CA85A11F74', 2, '2026-08-12 13:00:50', '2026-08-12 13:00:50'),
(49, 7, 28, 'IN', 'Purchase Updated #PUR-6A7CA85A11F74', 2, '2026-08-12 13:01:27', '2026-08-12 13:01:27'),
(50, 4, 34, 'OUT', 'Sale Invoice #INV-1786559504', 2, '2026-08-12 13:02:28', '2026-08-12 13:02:28'),
(51, 12, 3, 'IN', 'purchase', 2, '2026-08-13 00:48:05', '2026-08-13 00:48:05'),
(52, 14, 53, 'OUT', 'sds', 2, '2026-08-13 00:48:55', '2026-08-13 00:48:55'),
(53, 13, 3, 'IN', 'Purchase #PUR-6A7D61EA2E915', 2, '2026-08-13 00:49:40', '2026-08-13 00:49:40'),
(54, 4, 1, 'OUT', 'Sale Invoice #INV-1786601984', 2, '2026-08-13 00:50:11', '2026-08-13 00:50:11'),
(55, 5, 1, 'OUT', 'Sale Invoice #INV-1786602029', 2, '2026-08-13 00:50:43', '2026-08-13 00:50:43');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `supplier_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `suppliers_supplier_code_unique` (`supplier_code`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier_code`, `name`, `email`, `phone`, `address`, `company_name`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Caryn Fisher', 'xykeqox@mailinator.com', '+1 (593) 966-2599', 'Neque est et ipsa', NULL, '2026-08-12 00:43:15', '2026-08-12 00:43:15'),
(2, NULL, 'Bethany Powell', 'pylixoqej@mailinator.com', '+1 (935) 831-4697', 'Praesentium quia ape', NULL, '2026-08-12 00:45:30', '2026-08-12 00:45:30'),
(3, 'Ratione dolorem quia', 'Noelle Cantu', 'moxevi@mailinator.com', '+1 (509) 655-4355', 'Cupidatat iste facer', NULL, '2026-08-12 06:34:02', '2026-08-12 06:34:02'),
(4, 'Ratione autem molest', 'Yvette Bonner', 'gyxylyv@mailinator.com', '+1 (864) 113-9301', 'Explicabo Corrupti', NULL, '2026-08-12 06:34:17', '2026-08-12 06:34:17'),
(5, 'SUP-LUKPIQ', 'Mira Keith', 'zunisawe@mailinator.com', '+1 (399) 496-4587', 'Enim nulla et volupt', NULL, '2026-08-12 06:34:31', '2026-08-12 06:34:49'),
(6, 'Magni saepe dolor fu', 'Jaime Powell', 'posetoze@mailinator.com', '+1 (256) 635-7364', 'Esse tempora id occ', NULL, '2026-08-12 06:34:59', '2026-08-12 06:34:59'),
(7, 'SUP-0PPMFC', 'Ivy Luna', 'qobyhutydo@mailinator.com', '+1 (973) 527-6761', 'Consectetur modi co', NULL, '2026-08-12 06:35:08', '2026-08-12 06:35:08'),
(8, 'SUP-ZG4KIW', 'rohansss', 'rohan12@gmail.com', '34345454', 'te', NULL, '2026-08-12 09:50:40', '2026-08-12 09:50:40'),
(9, 'SUP-LXJC4K', 'rohansss', 'jufuresu@mailinator.com', '9867468045', 'sds', NULL, '2026-08-13 00:47:13', '2026-08-13 00:47:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'staff',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Karly Rodriguez', 'nukisak@mailinator.com', NULL, '$2y$12$CR4SHi9UEr4f/DwAN1yEIebrzPFC2yR6V7VFZOrWoPyrW6iloBexi', NULL, '2026-08-11 15:04:32', '2026-08-11 15:04:32', 'staff'),
(2, 'rohansss', 'rohit13@gmail.com', NULL, '$2y$12$UDdvllaEGRGBE1ptLv1GTeVS7bu.I7ekZ/RciGSPlifhjNYtrIqX2', NULL, '2026-08-12 00:09:22', '2026-08-12 00:09:22', 'staff'),
(3, 'Chase Payne', 'dube@mailinator.com', NULL, '$2y$12$0SbdbTknjv2GaJGIOSOXfuTLq/wf0XxwgdNzrKKTuHr40T9hc7Pd.', NULL, '2026-08-12 23:44:03', '2026-08-12 23:44:03', 'staff');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
