-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2025 at 04:03 PM
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
-- Database: `uliaa.infiniteitsolutionsnepal.com`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign_tickets`
--

CREATE TABLE `assign_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `assign_user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text NOT NULL,
  `slug` text NOT NULL,
  `blog_category_id` bigint(20) UNSIGNED NOT NULL,
  `short_description` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `thumbnail_image` bigint(20) UNSIGNED DEFAULT NULL,
  `banner` bigint(20) UNSIGNED DEFAULT NULL,
  `video_provider` varchar(191) NOT NULL DEFAULT 'youtube' COMMENT 'youtube / vimeo / ...',
  `video_link` text DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_popular` tinyint(4) NOT NULL DEFAULT 0,
  `meta_title` mediumtext DEFAULT NULL,
  `meta_img` bigint(20) UNSIGNED DEFAULT NULL,
  `meta_description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_localizations`
--

CREATE TABLE `blog_localizations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` bigint(20) UNSIGNED NOT NULL,
  `title` text NOT NULL,
  `short_description` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `lang_key` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_tags`
--

CREATE TABLE `blog_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_themes`
--

CREATE TABLE `blog_themes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` bigint(20) UNSIGNED NOT NULL,
  `theme_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `brand_image` bigint(20) UNSIGNED DEFAULT NULL,
  `total_sales_amount` double NOT NULL DEFAULT 0,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `meta_title` varchar(191) DEFAULT NULL,
  `meta_image` bigint(20) UNSIGNED DEFAULT NULL,
  `meta_description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brand_localizations`
--

CREATE TABLE `brand_localizations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `lang_key` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `brand_image` text DEFAULT NULL,
  `meta_title` varchar(191) DEFAULT NULL,
  `meta_image` bigint(20) UNSIGNED DEFAULT NULL,
  `meta_description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE `campaigns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `banner` bigint(20) UNSIGNED DEFAULT NULL,
  `start_date` varchar(191) DEFAULT NULL,
  `end_date` varchar(191) DEFAULT NULL,
  `is_published` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `campaign_products`
--

CREATE TABLE `campaign_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `campaign_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `campaign_themes`
--

CREATE TABLE `campaign_themes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `campaign_id` bigint(20) UNSIGNED NOT NULL,
  `theme_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `guest_user_id` bigint(20) DEFAULT NULL,
  `location_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_variation_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `level` int(11) NOT NULL COMMENT 'level of the category',
  `sorting_order_level` int(11) NOT NULL DEFAULT 0,
  `thumbnail_image` bigint(20) UNSIGNED DEFAULT NULL,
  `icon` bigint(20) UNSIGNED DEFAULT NULL,
  `is_featured` tinyint(4) NOT NULL DEFAULT 0,
  `is_top` tinyint(4) NOT NULL DEFAULT 0,
  `total_sale_count` int(11) NOT NULL DEFAULT 0,
  `meta_title` mediumtext DEFAULT NULL,
  `meta_image` bigint(20) UNSIGNED DEFAULT NULL,
  `meta_description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_brands`
--

CREATE TABLE `category_brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_localizations`
--

CREATE TABLE `category_localizations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `lang_key` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `thumbnail_image` bigint(20) UNSIGNED DEFAULT NULL,
  `meta_title` varchar(191) DEFAULT NULL,
  `meta_image` bigint(20) UNSIGNED DEFAULT NULL,
  `meta_description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `description` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_themes`
--

CREATE TABLE `category_themes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `theme_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `state_id`, `name`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Bombuflat', 0, '2021-04-06 07:28:42', '2021-09-28 02:31:26', NULL),
(2, 1, 'Garacharma', 0, '2021-04-06 07:28:42', '2021-09-28 02:31:26', NULL),
(3, 1, 'Port Blair', 0, '2021-04-06 07:28:42', '2021-09-28 02:31:26', NULL),
(4, 1, 'Rangat', 0, '2021-04-06 07:28:42', '2021-09-28 02:31:26', NULL),
(5, 2, 'Addanki', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(6, 2, 'Adivivaram', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(7, 2, 'Adoni', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(8, 2, 'Aganampudi', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(9, 2, 'Ajjaram', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(10, 2, 'Akividu', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(11, 2, 'Akkarampalle', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(12, 2, 'Akkayapalle', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(13, 2, 'Akkireddipalem', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(14, 2, 'Alampur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(15, 2, 'Amalapuram', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(16, 2, 'Amudalavalasa', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(17, 2, 'Amur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(18, 2, 'Anakapalle', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(19, 2, 'Anantapur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(20, 2, 'Andole', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(21, 2, 'Atmakur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(22, 2, 'Attili', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(23, 2, 'Avanigadda', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(24, 2, 'Badepalli', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(25, 2, 'Badvel', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(26, 2, 'Balapur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(27, 2, 'Bandarulanka', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(28, 2, 'Banganapalle', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(29, 2, 'Bapatla', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(30, 2, 'Bapulapadu', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(31, 2, 'Belampalli', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(32, 2, 'Bestavaripeta', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(33, 2, 'Betamcherla', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(34, 2, 'Bhattiprolu', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(35, 2, 'Bhimavaram', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(36, 2, 'Bhimunipatnam', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(37, 2, 'Bobbili', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(38, 2, 'Bombuflat', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(39, 2, 'Bommuru', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(40, 2, 'Bugganipalle', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(41, 2, 'Challapalle', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(42, 2, 'Chandur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(43, 2, 'Chatakonda', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(44, 2, 'Chemmumiahpet', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(45, 2, 'Chidiga', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(46, 2, 'Chilakaluripet', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(47, 2, 'Chimakurthy', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(48, 2, 'Chinagadila', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(49, 2, 'Chinagantyada', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(50, 2, 'Chinnachawk', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(51, 2, 'Chintalavalasa', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(52, 2, 'Chipurupalle', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(53, 2, 'Chirala', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(54, 2, 'Chittoor', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(55, 2, 'Chodavaram', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(56, 2, 'Choutuppal', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(57, 2, 'Chunchupalle', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(58, 2, 'Cuddapah', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(59, 2, 'Cumbum', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(60, 2, 'Darnakal', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(61, 2, 'Dasnapur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(62, 2, 'Dauleshwaram', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(63, 2, 'Dharmavaram', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(64, 2, 'Dhone', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(65, 2, 'Dommara Nandyal', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(66, 2, 'Dowlaiswaram', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(67, 2, 'East Godavari Dist.', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(68, 2, 'Eddumailaram', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(69, 2, 'Edulapuram', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(70, 2, 'Ekambara kuppam', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(71, 2, 'Eluru', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(72, 2, 'Enikapadu', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(73, 2, 'Fakirtakya', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(74, 2, 'Farrukhnagar', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(75, 2, 'Gaddiannaram', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(76, 2, 'Gajapathinagaram', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(77, 2, 'Gajularega', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(78, 2, 'Gajuvaka', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(79, 2, 'Gannavaram', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(80, 2, 'Garacharma', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(81, 2, 'Garimellapadu', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(82, 2, 'Giddalur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(83, 2, 'Godavarikhani', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(84, 2, 'Gopalapatnam', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(85, 2, 'Gopalur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(86, 2, 'Gorrekunta', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(87, 2, 'Gudivada', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(88, 2, 'Gudur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(89, 2, 'Guntakal', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(90, 2, 'Guntur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(91, 2, 'Guti', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(92, 2, 'Hindupur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(93, 2, 'Hukumpeta', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(94, 2, 'Ichchapuram', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(95, 2, 'Isnapur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(96, 2, 'Jaggayyapeta', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(97, 2, 'Jallaram Kamanpur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(98, 2, 'Jammalamadugu', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(99, 2, 'Jangampalli', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(100, 2, 'Jarjapupeta', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(101, 2, 'Kadiri', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(102, 2, 'Kaikalur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(103, 2, 'Kakinada', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(104, 2, 'Kallur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(105, 2, 'Kalyandurg', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(106, 2, 'Kamalapuram', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(107, 2, 'Kamareddi', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(108, 2, 'Kanapaka', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(109, 2, 'Kanigiri', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(110, 2, 'Kanithi', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(111, 2, 'Kankipadu', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(112, 2, 'Kantabamsuguda', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(113, 2, 'Kanuru', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(114, 2, 'Karnul', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(115, 2, 'Katheru', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(116, 2, 'Kavali', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(117, 2, 'Kazipet', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(118, 2, 'Khanapuram Haveli', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(119, 2, 'Kodar', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(120, 2, 'Kollapur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(121, 2, 'Kondapalem', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(122, 2, 'Kondapalle', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(123, 2, 'Kondukur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(124, 2, 'Kosgi', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(125, 2, 'Kothavalasa', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(126, 2, 'Kottapalli', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(127, 2, 'Kovur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(128, 2, 'Kovurpalle', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(129, 2, 'Kovvur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(130, 2, 'Krishna', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(131, 2, 'Kuppam', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(132, 2, 'Kurmannapalem', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(133, 2, 'Kurnool', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(134, 2, 'Lakshettipet', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(135, 2, 'Lalbahadur Nagar', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(136, 2, 'Machavaram', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(137, 2, 'Macherla', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(138, 2, 'Machilipatnam', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(139, 2, 'Madanapalle', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(140, 2, 'Madaram', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(141, 2, 'Madhuravada', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(142, 2, 'Madikonda', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(143, 2, 'Madugule', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(144, 2, 'Mahabubnagar', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(145, 2, 'Mahbubabad', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(146, 2, 'Malkajgiri', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(147, 2, 'Mamilapalle', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(148, 2, 'Mancheral', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(149, 2, 'Mandapeta', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(150, 2, 'Mandasa', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(151, 2, 'Mangalagiri', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(152, 2, 'Manthani', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(153, 2, 'Markapur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(154, 2, 'Marturu', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(155, 2, 'Metpalli', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(156, 2, 'Mindi', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(157, 2, 'Mirpet', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(158, 2, 'Moragudi', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(159, 2, 'Mothugudam', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(160, 2, 'Nagari', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(161, 2, 'Nagireddipalle', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(162, 2, 'Nandigama', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(163, 2, 'Nandikotkur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(164, 2, 'Nandyal', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(165, 2, 'Narasannapeta', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(166, 2, 'Narasapur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(167, 2, 'Narasaraopet', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(168, 2, 'Narayanavanam', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(169, 2, 'Narsapur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(170, 2, 'Narsingi', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(171, 2, 'Narsipatnam', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(172, 2, 'Naspur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(173, 2, 'Nathayyapalem', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(174, 2, 'Nayudupeta', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(175, 2, 'Nelimaria', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(176, 2, 'Nellore', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(177, 2, 'Nidadavole', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(178, 2, 'Nuzvid', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(179, 2, 'Omerkhan daira', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(180, 2, 'Ongole', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(181, 2, 'Osmania University', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(182, 2, 'Pakala', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(183, 2, 'Palakole', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(184, 2, 'Palakurthi', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(185, 2, 'Palasa', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(186, 2, 'Palempalle', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(187, 2, 'Palkonda', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(188, 2, 'Palmaner', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(189, 2, 'Pamur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(190, 2, 'Panjim', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(191, 2, 'Papampeta', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(192, 2, 'Parasamba', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(193, 2, 'Parvatipuram', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(194, 2, 'Patancheru', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(195, 2, 'Payakaraopet', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(196, 2, 'Pedagantyada', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(197, 2, 'Pedana', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(198, 2, 'Peddapuram', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(199, 2, 'Pendurthi', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(200, 2, 'Penugonda', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(201, 2, 'Penukonda', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(202, 2, 'Phirangipuram', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(203, 2, 'Pithapuram', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(204, 2, 'Ponnur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(205, 2, 'Port Blair', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(206, 2, 'Pothinamallayyapalem', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(207, 2, 'Prakasam', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(208, 2, 'Prasadampadu', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(209, 2, 'Prasantinilayam', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(210, 2, 'Proddatur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(211, 2, 'Pulivendla', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(212, 2, 'Punganuru', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(213, 2, 'Puttur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(214, 2, 'Qutubullapur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(215, 2, 'Rajahmundry', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(216, 2, 'Rajamahendri', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(217, 2, 'Rajampet', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(218, 2, 'Rajendranagar', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(219, 2, 'Rajoli', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(220, 2, 'Ramachandrapuram', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(221, 2, 'Ramanayyapeta', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(222, 2, 'Ramapuram', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(223, 2, 'Ramarajupalli', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(224, 2, 'Ramavarappadu', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(225, 2, 'Rameswaram', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(226, 2, 'Rampachodavaram', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(227, 2, 'Ravulapalam', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(228, 2, 'Rayachoti', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(229, 2, 'Rayadrug', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(230, 2, 'Razam', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(231, 2, 'Razole', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(232, 2, 'Renigunta', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(233, 2, 'Repalle', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(234, 2, 'Rishikonda', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(235, 2, 'Salur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(236, 2, 'Samalkot', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(237, 2, 'Sattenapalle', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(238, 2, 'Seetharampuram', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(239, 2, 'Serilungampalle', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(240, 2, 'Shankarampet', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(241, 2, 'Shar', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(242, 2, 'Singarayakonda', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(243, 2, 'Sirpur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(244, 2, 'Sirsilla', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(245, 2, 'Sompeta', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(246, 2, 'Sriharikota', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(247, 2, 'Srikakulam', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(248, 2, 'Srikalahasti', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(249, 2, 'Sriramnagar', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(250, 2, 'Sriramsagar', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(251, 2, 'Srisailam', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(252, 2, 'Srisailamgudem Devasthanam', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(253, 2, 'Sulurpeta', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(254, 2, 'Suriapet', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(255, 2, 'Suryaraopet', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(256, 2, 'Tadepalle', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(257, 2, 'Tadepalligudem', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(258, 2, 'Tadpatri', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(259, 2, 'Tallapalle', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(260, 2, 'Tanuku', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(261, 2, 'Tekkali', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(262, 2, 'Tenali', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(263, 2, 'Tigalapahad', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(264, 2, 'Tiruchanur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(265, 2, 'Tirumala', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(266, 2, 'Tirupati', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(267, 2, 'Tirvuru', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(268, 2, 'Trimulgherry', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(269, 2, 'Tuni', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(270, 2, 'Turangi', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(271, 2, 'Ukkayapalli', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(272, 2, 'Ukkunagaram', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(273, 2, 'Uppal Kalan', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(274, 2, 'Upper Sileru', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(275, 2, 'Uravakonda', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(276, 2, 'Vadlapudi', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(277, 2, 'Vaparala', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(278, 2, 'Vemalwada', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(279, 2, 'Venkatagiri', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(280, 2, 'Venkatapuram', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(281, 2, 'Vepagunta', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(282, 2, 'Vetapalem', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(283, 2, 'Vijayapuri', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(284, 2, 'Vijayapuri South', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(285, 2, 'Vijayawada', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(286, 2, 'Vinukonda', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(287, 2, 'Visakhapatnam', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(288, 2, 'Vizianagaram', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(289, 2, 'Vuyyuru', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(290, 2, 'Wanparti', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(291, 2, 'West Godavari Dist.', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(292, 2, 'Yadagirigutta', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(293, 2, 'Yarada', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(294, 2, 'Yellamanchili', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(295, 2, 'Yemmiganur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(296, 2, 'Yenamalakudru', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(297, 2, 'Yendada', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(298, 2, 'Yerraguntla', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(299, 3, 'Along', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(300, 3, 'Basar', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(301, 3, 'Bondila', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(302, 3, 'Changlang', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(303, 3, 'Daporijo', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(304, 3, 'Deomali', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(305, 3, 'Itanagar', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(306, 3, 'Jairampur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(307, 3, 'Khonsa', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(308, 3, 'Naharlagun', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(309, 3, 'Namsai', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(310, 3, 'Pasighat', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(311, 3, 'Roing', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(312, 3, 'Seppa', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(313, 3, 'Tawang', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(314, 3, 'Tezu', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(315, 3, 'Ziro', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(316, 4, 'Abhayapuri', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(317, 4, 'Ambikapur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(318, 4, 'Amguri', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(319, 4, 'Anand Nagar', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(320, 4, 'Badarpur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(321, 4, 'Badarpur Railway Town', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(322, 4, 'Bahbari Gaon', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(323, 4, 'Bamun Sualkuchi', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(324, 4, 'Barbari', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(325, 4, 'Barpathar', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(326, 4, 'Barpeta', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(327, 4, 'Barpeta Road', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(328, 4, 'Basugaon', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(329, 4, 'Bihpuria', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(330, 4, 'Bijni', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(331, 4, 'Bilasipara', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(332, 4, 'Biswanath Chariali', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(333, 4, 'Bohori', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(334, 4, 'Bokajan', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(335, 4, 'Bokokhat', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(336, 4, 'Bongaigaon', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(337, 4, 'Bongaigaon Petro-chemical Town', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(338, 4, 'Borgolai', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(339, 4, 'Chabua', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(340, 4, 'Chandrapur Bagicha', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(341, 4, 'Chapar', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(342, 4, 'Chekonidhara', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(343, 4, 'Choto Haibor', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(344, 4, 'Dergaon', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(345, 4, 'Dharapur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(346, 4, 'Dhekiajuli', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(347, 4, 'Dhemaji', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(348, 4, 'Dhing', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(349, 4, 'Dhubri', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(350, 4, 'Dhuburi', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(351, 4, 'Dibrugarh', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(352, 4, 'Digboi', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(353, 4, 'Digboi Oil Town', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(354, 4, 'Dimaruguri', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(355, 4, 'Diphu', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(356, 4, 'Dispur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(357, 4, 'Doboka', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(358, 4, 'Dokmoka', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(359, 4, 'Donkamokan', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(360, 4, 'Duliagaon', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(361, 4, 'Duliajan', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(362, 4, 'Duliajan No.1', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(363, 4, 'Dum Duma', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(364, 4, 'Durga Nagar', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(365, 4, 'Gauripur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(366, 4, 'Goalpara', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(367, 4, 'Gohpur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(368, 4, 'Golaghat', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(369, 4, 'Golakganj', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(370, 4, 'Gossaigaon', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(371, 4, 'Guwahati', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(372, 4, 'Haflong', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(373, 4, 'Hailakandi', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(374, 4, 'Hamren', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(375, 4, 'Hauli', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(376, 4, 'Hauraghat', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(377, 4, 'Hojai', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(378, 4, 'Jagiroad', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(379, 4, 'Jagiroad Paper Mill', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(380, 4, 'Jogighopa', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(381, 4, 'Jonai Bazar', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(382, 4, 'Jorhat', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(383, 4, 'Kampur Town', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(384, 4, 'Kamrup', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(385, 4, 'Kanakpur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(386, 4, 'Karimganj', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(387, 4, 'Kharijapikon', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(388, 4, 'Kharupetia', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(389, 4, 'Kochpara', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(390, 4, 'Kokrajhar', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(391, 4, 'Kumar Kaibarta Gaon', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(392, 4, 'Lakhimpur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(393, 4, 'Lakhipur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(394, 4, 'Lala', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(395, 4, 'Lanka', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(396, 4, 'Lido Tikok', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(397, 4, 'Lido Town', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(398, 4, 'Lumding', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(399, 4, 'Lumding Railway Colony', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(400, 4, 'Mahur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(401, 4, 'Maibong', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(402, 4, 'Majgaon', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(403, 4, 'Makum', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(404, 4, 'Mangaldai', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(405, 4, 'Mankachar', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(406, 4, 'Margherita', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(407, 4, 'Mariani', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(408, 4, 'Marigaon', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(409, 4, 'Moran', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(410, 4, 'Moranhat', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(411, 4, 'Nagaon', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(412, 4, 'Naharkatia', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(413, 4, 'Nalbari', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(414, 4, 'Namrup', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(415, 4, 'Naubaisa Gaon', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(416, 4, 'Nazira', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(417, 4, 'New Bongaigaon Railway Colony', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(418, 4, 'Niz-Hajo', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(419, 4, 'North Guwahati', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(420, 4, 'Numaligarh', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(421, 4, 'Palasbari', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(422, 4, 'Panchgram', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(423, 4, 'Pathsala', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(424, 4, 'Raha', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(425, 4, 'Rangapara', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(426, 4, 'Rangia', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(427, 4, 'Salakati', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(428, 4, 'Sapatgram', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(429, 4, 'Sarthebari', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(430, 4, 'Sarupathar', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(431, 4, 'Sarupathar Bengali', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(432, 4, 'Senchoagaon', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(433, 4, 'Sibsagar', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(434, 4, 'Silapathar', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(435, 4, 'Silchar', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(436, 4, 'Silchar Part-X', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(437, 4, 'Sonari', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(438, 4, 'Sorbhog', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(439, 4, 'Sualkuchi', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(440, 4, 'Tangla', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(441, 4, 'Tezpur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(442, 4, 'Tihu', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(443, 4, 'Tinsukia', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(444, 4, 'Titabor', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(445, 4, 'Udalguri', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(446, 4, 'Umrangso', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(447, 4, 'Uttar Krishnapur Part-I', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(448, 5, 'Amarpur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(449, 5, 'Ara', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(450, 5, 'Araria', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(451, 5, 'Areraj', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(452, 5, 'Asarganj', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(453, 5, 'Aurangabad', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(454, 5, 'Bagaha', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(455, 5, 'Bahadurganj', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(456, 5, 'Bairgania', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(457, 5, 'Bakhtiyarpur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(458, 5, 'Banka', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(459, 5, 'Banmankhi', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(460, 5, 'Bar Bigha', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(461, 5, 'Barauli', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(462, 5, 'Barauni Oil Township', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(463, 5, 'Barh', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(464, 5, 'Barhiya', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(465, 5, 'Bariapur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(466, 5, 'Baruni', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(467, 5, 'Begusarai', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(468, 5, 'Behea', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(469, 5, 'Belsand', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(470, 5, 'Bettiah', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(471, 5, 'Bhabua', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(472, 5, 'Bhagalpur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(473, 5, 'Bhimnagar', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(474, 5, 'Bhojpur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(475, 5, 'Bihar', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(476, 5, 'Bihar Sharif', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(477, 5, 'Bihariganj', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(478, 5, 'Bikramganj', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(479, 5, 'Birpur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(480, 5, 'Bodh Gaya', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(481, 5, 'Buxar', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(482, 5, 'Chakia', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(483, 5, 'Chanpatia', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(484, 5, 'Chhapra', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(485, 5, 'Chhatapur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(486, 5, 'Colgong', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(487, 5, 'Dalsingh Sarai', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(488, 5, 'Darbhanga', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(489, 5, 'Daudnagar', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(490, 5, 'Dehri', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(491, 5, 'Dhaka', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(492, 5, 'Dighwara', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(493, 5, 'Dinapur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(494, 5, 'Dinapur Cantonment', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(495, 5, 'Dumra', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(496, 5, 'Dumraon', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(497, 5, 'Fatwa', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(498, 5, 'Forbesganj', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(499, 5, 'Gaya', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL),
(500, 5, 'Gazipur', 0, '2021-04-06 07:28:42', '2021-04-06 07:28:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us_messages`
--

CREATE TABLE `contact_us_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `support_for` varchar(191) NOT NULL COMMENT 'delivery_problem | customer_service | other_service',
  `message` longtext NOT NULL,
  `is_seen` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `code`, `name`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'AF', 'Afghanistan', 0, '2021-04-06 07:21:30', NULL, NULL),
(2, 'AL', 'Albania', 0, '2021-04-06 07:21:30', NULL, NULL),
(3, 'DZ', 'Algeria', 0, '2021-04-06 07:21:30', NULL, NULL),
(4, 'AS', 'American Samoa', 0, '2021-04-06 07:21:30', NULL, NULL),
(5, 'AD', 'Andorra', 0, '2021-04-06 07:21:30', NULL, NULL),
(6, 'AO', 'Angola', 0, '2021-04-06 07:21:30', NULL, NULL),
(7, 'AI', 'Anguilla', 0, '2021-04-06 07:21:30', NULL, NULL),
(8, 'AQ', 'Antarctica', 0, '2021-04-06 07:21:30', NULL, NULL),
(9, 'AG', 'Antigua And Barbuda', 0, '2021-04-06 07:21:30', NULL, NULL),
(10, 'AR', 'Argentina', 0, '2021-04-06 07:21:30', NULL, NULL),
(11, 'AM', 'Armenia', 0, '2021-04-06 07:21:30', NULL, NULL),
(12, 'AW', 'Aruba', 0, '2021-04-06 07:21:30', NULL, NULL),
(13, 'AU', 'Australia', 0, '2021-04-06 07:21:30', NULL, NULL),
(14, 'AT', 'Austria', 0, '2021-04-06 07:21:30', NULL, NULL),
(15, 'AZ', 'Azerbaijan', 0, '2021-04-06 07:21:30', NULL, NULL),
(16, 'BS', 'Bahamas The', 0, '2021-04-06 07:21:30', NULL, NULL),
(17, 'BH', 'Bahrain', 0, '2021-04-06 07:21:30', NULL, NULL),
(18, 'BD', 'Bangladesh', 0, '2021-04-06 07:21:30', '2021-09-28 02:31:11', NULL),
(19, 'BB', 'Barbados', 0, '2021-04-06 07:21:30', NULL, NULL),
(20, 'BY', 'Belarus', 0, '2021-04-06 07:21:30', NULL, NULL),
(21, 'BE', 'Belgium', 0, '2021-04-06 07:21:30', NULL, NULL),
(22, 'BZ', 'Belize', 0, '2021-04-06 07:21:30', NULL, NULL),
(23, 'BJ', 'Benin', 0, '2021-04-06 07:21:30', NULL, NULL),
(24, 'BM', 'Bermuda', 0, '2021-04-06 07:21:30', NULL, NULL),
(25, 'BT', 'Bhutan', 0, '2021-04-06 07:21:30', NULL, NULL),
(26, 'BO', 'Bolivia', 0, '2021-04-06 07:21:30', NULL, NULL),
(27, 'BA', 'Bosnia and Herzegovina', 0, '2021-04-06 07:21:30', NULL, NULL),
(28, 'BW', 'Botswana', 0, '2021-04-06 07:21:30', NULL, NULL),
(29, 'BV', 'Bouvet Island', 0, '2021-04-06 07:21:30', NULL, NULL),
(30, 'BR', 'Brazil', 0, '2021-04-06 07:21:30', NULL, NULL),
(31, 'IO', 'British Indian Ocean Territory', 0, '2021-04-06 07:21:30', NULL, NULL),
(32, 'BN', 'Brunei', 0, '2021-04-06 07:21:30', NULL, NULL),
(33, 'BG', 'Bulgaria', 0, '2021-04-06 07:21:30', NULL, NULL),
(34, 'BF', 'Burkina Faso', 0, '2021-04-06 07:21:30', NULL, NULL),
(35, 'BI', 'Burundi', 0, '2021-04-06 07:21:30', NULL, NULL),
(36, 'KH', 'Cambodia', 0, '2021-04-06 07:21:30', NULL, NULL),
(37, 'CM', 'Cameroon', 0, '2021-04-06 07:21:30', NULL, NULL),
(38, 'CA', 'Canada', 0, '2021-04-06 07:21:30', NULL, NULL),
(39, 'CV', 'Cape Verde', 0, '2021-04-06 07:21:30', NULL, NULL),
(40, 'KY', 'Cayman Islands', 0, '2021-04-06 07:21:30', NULL, NULL),
(41, 'CF', 'Central African Republic', 0, '2021-04-06 07:21:30', NULL, NULL),
(42, 'TD', 'Chad', 0, '2021-04-06 07:21:30', NULL, NULL),
(43, 'CL', 'Chile', 0, '2021-04-06 07:21:30', NULL, NULL),
(44, 'CN', 'China', 0, '2021-04-06 07:21:30', NULL, NULL),
(45, 'CX', 'Christmas Island', 0, '2021-04-06 07:21:30', NULL, NULL),
(46, 'CC', 'Cocos (Keeling) Islands', 0, '2021-04-06 07:21:30', NULL, NULL),
(47, 'CO', 'Colombia', 0, '2021-04-06 07:21:30', NULL, NULL),
(48, 'KM', 'Comoros', 0, '2021-04-06 07:21:30', NULL, NULL),
(49, 'CG', 'Republic Of The Congo', 0, '2021-04-06 07:21:30', NULL, NULL),
(50, 'CD', 'Democratic Republic Of The Congo', 0, '2021-04-06 07:21:30', NULL, NULL),
(51, 'CK', 'Cook Islands', 0, '2021-04-06 07:21:30', NULL, NULL),
(52, 'CR', 'Costa Rica', 0, '2021-04-06 07:21:30', NULL, NULL),
(53, 'CI', 'Cote D\'Ivoire (Ivory Coast)', 0, '2021-04-06 07:21:30', NULL, NULL),
(54, 'HR', 'Croatia (Hrvatska)', 0, '2021-04-06 07:21:30', NULL, NULL),
(55, 'CU', 'Cuba', 0, '2021-04-06 07:21:30', NULL, NULL),
(56, 'CY', 'Cyprus', 0, '2021-04-06 07:21:30', NULL, NULL),
(57, 'CZ', 'Czech Republic', 0, '2021-04-06 07:21:30', NULL, NULL),
(58, 'DK', 'Denmark', 0, '2021-04-06 07:21:30', NULL, NULL),
(59, 'DJ', 'Djibouti', 0, '2021-04-06 07:21:30', NULL, NULL),
(60, 'DM', 'Dominica', 0, '2021-04-06 07:21:30', NULL, NULL),
(61, 'DO', 'Dominican Republic', 0, '2021-04-06 07:21:30', NULL, NULL),
(62, 'TP', 'East Timor', 0, '2021-04-06 07:21:30', NULL, NULL),
(63, 'EC', 'Ecuador', 0, '2021-04-06 07:21:30', NULL, NULL),
(64, 'EG', 'Egypt', 0, '2021-04-06 07:21:30', NULL, NULL),
(65, 'SV', 'El Salvador', 0, '2021-04-06 07:21:30', NULL, NULL),
(66, 'GQ', 'Equatorial Guinea', 0, '2021-04-06 07:21:30', NULL, NULL),
(67, 'ER', 'Eritrea', 0, '2021-04-06 07:21:30', NULL, NULL),
(68, 'EE', 'Estonia', 0, '2021-04-06 07:21:30', NULL, NULL),
(69, 'ET', 'Ethiopia', 0, '2021-04-06 07:21:30', NULL, NULL),
(70, 'XA', 'External Territories of Australia', 0, '2021-04-06 07:21:30', NULL, NULL),
(71, 'FK', 'Falkland Islands', 0, '2021-04-06 07:21:30', NULL, NULL),
(72, 'FO', 'Faroe Islands', 0, '2021-04-06 07:21:30', NULL, NULL),
(73, 'FJ', 'Fiji Islands', 0, '2021-04-06 07:21:30', NULL, NULL),
(74, 'FI', 'Finland', 0, '2021-04-06 07:21:30', NULL, NULL),
(75, 'FR', 'France', 0, '2021-04-06 07:21:30', NULL, NULL),
(76, 'GF', 'French Guiana', 0, '2021-04-06 07:21:30', NULL, NULL),
(77, 'PF', 'French Polynesia', 0, '2021-04-06 07:21:30', NULL, NULL),
(78, 'TF', 'French Southern Territories', 0, '2021-04-06 07:21:30', NULL, NULL),
(79, 'GA', 'Gabon', 0, '2021-04-06 07:21:30', NULL, NULL),
(80, 'GM', 'Gambia The', 0, '2021-04-06 07:21:30', NULL, NULL),
(81, 'GE', 'Georgia', 0, '2021-04-06 07:21:30', NULL, NULL),
(82, 'DE', 'Germany', 0, '2021-04-06 07:21:30', NULL, NULL),
(83, 'GH', 'Ghana', 0, '2021-04-06 07:21:30', NULL, NULL),
(84, 'GI', 'Gibraltar', 0, '2021-04-06 07:21:30', NULL, NULL),
(85, 'GR', 'Greece', 0, '2021-04-06 07:21:30', NULL, NULL),
(86, 'GL', 'Greenland', 0, '2021-04-06 07:21:30', NULL, NULL),
(87, 'GD', 'Grenada', 0, '2021-04-06 07:21:30', NULL, NULL),
(88, 'GP', 'Guadeloupe', 0, '2021-04-06 07:21:30', NULL, NULL),
(89, 'GU', 'Guam', 0, '2021-04-06 07:21:30', NULL, NULL),
(90, 'GT', 'Guatemala', 0, '2021-04-06 07:21:30', NULL, NULL),
(91, 'XU', 'Guernsey and Alderney', 0, '2021-04-06 07:21:30', NULL, NULL),
(92, 'GN', 'Guinea', 0, '2021-04-06 07:21:30', NULL, NULL),
(93, 'GW', 'Guinea-Bissau', 0, '2021-04-06 07:21:30', NULL, NULL),
(94, 'GY', 'Guyana', 0, '2021-04-06 07:21:30', NULL, NULL),
(95, 'HT', 'Haiti', 0, '2021-04-06 07:21:30', NULL, NULL),
(96, 'HM', 'Heard and McDonald Islands', 0, '2021-04-06 07:21:30', NULL, NULL),
(97, 'HN', 'Honduras', 0, '2021-04-06 07:21:30', NULL, NULL),
(98, 'HK', 'Hong Kong S.A.R.', 0, '2021-04-06 07:21:30', NULL, NULL),
(99, 'HU', 'Hungary', 0, '2021-04-06 07:21:30', NULL, NULL),
(100, 'IS', 'Iceland', 0, '2021-04-06 07:21:30', NULL, NULL),
(101, 'IN', 'India', 0, '2021-04-06 07:21:30', NULL, NULL),
(102, 'ID', 'Indonesia', 0, '2021-04-06 07:21:30', NULL, NULL),
(103, 'IR', 'Iran', 0, '2021-04-06 07:21:30', NULL, NULL),
(104, 'IQ', 'Iraq', 0, '2021-04-06 07:21:30', NULL, NULL),
(105, 'IE', 'Ireland', 0, '2021-04-06 07:21:30', NULL, NULL),
(106, 'IL', 'Israel', 0, '2021-04-06 07:21:30', NULL, NULL),
(107, 'IT', 'Italy', 0, '2021-04-06 07:21:30', NULL, NULL),
(108, 'JM', 'Jamaica', 0, '2021-04-06 07:21:30', NULL, NULL),
(109, 'JP', 'Japan', 0, '2021-04-06 07:21:30', NULL, NULL),
(110, 'XJ', 'Jersey', 0, '2021-04-06 07:21:30', NULL, NULL),
(111, 'JO', 'Jordan', 0, '2021-04-06 07:21:30', NULL, NULL),
(112, 'KZ', 'Kazakhstan', 0, '2021-04-06 07:21:30', NULL, NULL),
(113, 'KE', 'Kenya', 0, '2021-04-06 07:21:30', NULL, NULL),
(114, 'KI', 'Kiribati', 0, '2021-04-06 07:21:30', NULL, NULL),
(115, 'KP', 'Korea North', 0, '2021-04-06 07:21:30', NULL, NULL),
(116, 'KR', 'Korea South', 0, '2021-04-06 07:21:30', NULL, NULL),
(117, 'KW', 'Kuwait', 0, '2021-04-06 07:21:30', NULL, NULL),
(118, 'KG', 'Kyrgyzstan', 0, '2021-04-06 07:21:30', NULL, NULL),
(119, 'LA', 'Laos', 0, '2021-04-06 07:21:30', NULL, NULL),
(120, 'LV', 'Latvia', 0, '2021-04-06 07:21:30', NULL, NULL),
(121, 'LB', 'Lebanon', 0, '2021-04-06 07:21:30', NULL, NULL),
(122, 'LS', 'Lesotho', 0, '2021-04-06 07:21:30', NULL, NULL),
(123, 'LR', 'Liberia', 0, '2021-04-06 07:21:30', NULL, NULL),
(124, 'LY', 'Libya', 0, '2021-04-06 07:21:30', NULL, NULL),
(125, 'LI', 'Liechtenstein', 0, '2021-04-06 07:21:30', NULL, NULL),
(126, 'LT', 'Lithuania', 0, '2021-04-06 07:21:30', NULL, NULL),
(127, 'LU', 'Luxembourg', 0, '2021-04-06 07:21:30', NULL, NULL),
(128, 'MO', 'Macau S.A.R.', 0, '2021-04-06 07:21:30', NULL, NULL),
(129, 'MK', 'Macedonia', 0, '2021-04-06 07:21:30', NULL, NULL),
(130, 'MG', 'Madagascar', 0, '2021-04-06 07:21:30', NULL, NULL),
(131, 'MW', 'Malawi', 0, '2021-04-06 07:21:30', NULL, NULL),
(132, 'MY', 'Malaysia', 0, '2021-04-06 07:21:30', NULL, NULL),
(133, 'MV', 'Maldives', 0, '2021-04-06 07:21:30', NULL, NULL),
(134, 'ML', 'Mali', 0, '2021-04-06 07:21:30', NULL, NULL),
(135, 'MT', 'Malta', 0, '2021-04-06 07:21:30', NULL, NULL),
(136, 'XM', 'Man (Isle of)', 0, '2021-04-06 07:21:30', NULL, NULL),
(137, 'MH', 'Marshall Islands', 0, '2021-04-06 07:21:30', NULL, NULL),
(138, 'MQ', 'Martinique', 0, '2021-04-06 07:21:30', NULL, NULL),
(139, 'MR', 'Mauritania', 0, '2021-04-06 07:21:30', NULL, NULL),
(140, 'MU', 'Mauritius', 0, '2021-04-06 07:21:30', NULL, NULL),
(141, 'YT', 'Mayotte', 0, '2021-04-06 07:21:30', NULL, NULL),
(142, 'MX', 'Mexico', 0, '2021-04-06 07:21:30', NULL, NULL),
(143, 'FM', 'Micronesia', 0, '2021-04-06 07:21:30', NULL, NULL),
(144, 'MD', 'Moldova', 0, '2021-04-06 07:21:30', NULL, NULL),
(145, 'MC', 'Monaco', 0, '2021-04-06 07:21:30', NULL, NULL),
(146, 'MN', 'Mongolia', 0, '2021-04-06 07:21:30', NULL, NULL),
(147, 'MS', 'Montserrat', 0, '2021-04-06 07:21:30', NULL, NULL),
(148, 'MA', 'Morocco', 0, '2021-04-06 07:21:30', NULL, NULL),
(149, 'MZ', 'Mozambique', 0, '2021-04-06 07:21:30', NULL, NULL),
(150, 'MM', 'Myanmar', 0, '2021-04-06 07:21:30', NULL, NULL),
(151, 'NA', 'Namibia', 0, '2021-04-06 07:21:30', NULL, NULL),
(152, 'NR', 'Nauru', 0, '2021-04-06 07:21:30', NULL, NULL),
(153, 'NP', 'Nepal', 0, '2021-04-06 07:21:30', NULL, NULL),
(154, 'AN', 'Netherlands Antilles', 0, '2021-04-06 07:21:30', NULL, NULL),
(155, 'NL', 'Netherlands The', 0, '2021-04-06 07:21:30', NULL, NULL),
(156, 'NC', 'New Caledonia', 0, '2021-04-06 07:21:30', NULL, NULL),
(157, 'NZ', 'New Zealand', 0, '2021-04-06 07:21:30', NULL, NULL),
(158, 'NI', 'Nicaragua', 0, '2021-04-06 07:21:30', NULL, NULL),
(159, 'NE', 'Niger', 0, '2021-04-06 07:21:30', NULL, NULL),
(160, 'NG', 'Nigeria', 0, '2021-04-06 07:21:30', NULL, NULL),
(161, 'NU', 'Niue', 0, '2021-04-06 07:21:30', NULL, NULL),
(162, 'NF', 'Norfolk Island', 0, '2021-04-06 07:21:30', NULL, NULL),
(163, 'MP', 'Northern Mariana Islands', 0, '2021-04-06 07:21:30', NULL, NULL),
(164, 'NO', 'Norway', 0, '2021-04-06 07:21:30', NULL, NULL),
(165, 'OM', 'Oman', 0, '2021-04-06 07:21:30', NULL, NULL),
(166, 'PK', 'Pakistan', 0, '2021-04-06 07:21:30', NULL, NULL),
(167, 'PW', 'Palau', 0, '2021-04-06 07:21:30', NULL, NULL),
(168, 'PS', 'Palestinian Territory Occupied', 0, '2021-04-06 07:21:30', NULL, NULL),
(169, 'PA', 'Panama', 0, '2021-04-06 07:21:30', NULL, NULL),
(170, 'PG', 'Papua new Guinea', 0, '2021-04-06 07:21:30', NULL, NULL),
(171, 'PY', 'Paraguay', 0, '2021-04-06 07:21:30', NULL, NULL),
(172, 'PE', 'Peru', 0, '2021-04-06 07:21:30', NULL, NULL),
(173, 'PH', 'Philippines', 0, '2021-04-06 07:21:30', NULL, NULL),
(174, 'PN', 'Pitcairn Island', 0, '2021-04-06 07:21:30', NULL, NULL),
(175, 'PL', 'Poland', 0, '2021-04-06 07:21:30', NULL, NULL),
(176, 'PT', 'Portugal', 0, '2021-04-06 07:21:30', NULL, NULL),
(177, 'PR', 'Puerto Rico', 0, '2021-04-06 07:21:30', NULL, NULL),
(178, 'QA', 'Qatar', 0, '2021-04-06 07:21:30', NULL, NULL),
(179, 'RE', 'Reunion', 0, '2021-04-06 07:21:30', NULL, NULL),
(180, 'RO', 'Romania', 0, '2021-04-06 07:21:30', NULL, NULL),
(181, 'RU', 'Russia', 0, '2021-04-06 07:21:30', NULL, NULL),
(182, 'RW', 'Rwanda', 0, '2021-04-06 07:21:30', NULL, NULL),
(183, 'SH', 'Saint Helena', 0, '2021-04-06 07:21:30', NULL, NULL),
(184, 'KN', 'Saint Kitts And Nevis', 0, '2021-04-06 07:21:30', NULL, NULL),
(185, 'LC', 'Saint Lucia', 0, '2021-04-06 07:21:30', NULL, NULL),
(186, 'PM', 'Saint Pierre and Miquelon', 0, '2021-04-06 07:21:30', NULL, NULL),
(187, 'VC', 'Saint Vincent And The Grenadines', 0, '2021-04-06 07:21:30', NULL, NULL),
(188, 'WS', 'Samoa', 0, '2021-04-06 07:21:30', NULL, NULL),
(189, 'SM', 'San Marino', 0, '2021-04-06 07:21:30', NULL, NULL),
(190, 'ST', 'Sao Tome and Principe', 0, '2021-04-06 07:21:30', NULL, NULL),
(191, 'SA', 'Saudi Arabia', 0, '2021-04-06 07:21:30', NULL, NULL),
(192, 'SN', 'Senegal', 0, '2021-04-06 07:21:30', NULL, NULL),
(193, 'RS', 'Serbia', 0, '2021-04-06 07:21:30', NULL, NULL),
(194, 'SC', 'Seychelles', 0, '2021-04-06 07:21:30', NULL, NULL),
(195, 'SL', 'Sierra Leone', 0, '2021-04-06 07:21:30', NULL, NULL),
(196, 'SG', 'Singapore', 0, '2021-04-06 07:21:30', NULL, NULL),
(197, 'SK', 'Slovakia', 0, '2021-04-06 07:21:30', NULL, NULL),
(198, 'SI', 'Slovenia', 0, '2021-04-06 07:21:30', NULL, NULL),
(199, 'XG', 'Smaller Territories of the UK', 0, '2021-04-06 07:21:30', NULL, NULL),
(200, 'SB', 'Solomon Islands', 0, '2021-04-06 07:21:30', NULL, NULL),
(201, 'SO', 'Somalia', 0, '2021-04-06 07:21:30', NULL, NULL),
(202, 'ZA', 'South Africa', 0, '2021-04-06 07:21:30', NULL, NULL),
(203, 'GS', 'South Georgia', 0, '2021-04-06 07:21:30', NULL, NULL),
(204, 'SS', 'South Sudan', 0, '2021-04-06 07:21:30', NULL, NULL),
(205, 'ES', 'Spain', 0, '2021-04-06 07:21:30', NULL, NULL),
(206, 'LK', 'Sri Lanka', 0, '2021-04-06 07:21:30', NULL, NULL),
(207, 'SD', 'Sudan', 0, '2021-04-06 07:21:30', NULL, NULL),
(208, 'SR', 'Suriname', 0, '2021-04-06 07:21:30', NULL, NULL),
(209, 'SJ', 'Svalbard And Jan Mayen Islands', 0, '2021-04-06 07:21:30', NULL, NULL),
(210, 'SZ', 'Swaziland', 0, '2021-04-06 07:21:30', NULL, NULL),
(211, 'SE', 'Sweden', 0, '2021-04-06 07:21:30', NULL, NULL),
(212, 'CH', 'Switzerland', 0, '2021-04-06 07:21:30', NULL, NULL),
(213, 'SY', 'Syria', 0, '2021-04-06 07:21:30', NULL, NULL),
(214, 'TW', 'Taiwan', 0, '2021-04-06 07:21:30', NULL, NULL),
(215, 'TJ', 'Tajikistan', 0, '2021-04-06 07:21:30', NULL, NULL),
(216, 'TZ', 'Tanzania', 0, '2021-04-06 07:21:30', NULL, NULL),
(217, 'TH', 'Thailand', 0, '2021-04-06 07:21:30', NULL, NULL),
(218, 'TG', 'Togo', 0, '2021-04-06 07:21:30', NULL, NULL),
(219, 'TK', 'Tokelau', 0, '2021-04-06 07:21:30', NULL, NULL),
(220, 'TO', 'Tonga', 0, '2021-04-06 07:21:30', NULL, NULL),
(221, 'TT', 'Trinidad And Tobago', 0, '2021-04-06 07:21:30', NULL, NULL),
(222, 'TN', 'Tunisia', 0, '2021-04-06 07:21:30', NULL, NULL),
(223, 'TR', 'Turkey', 0, '2021-04-06 07:21:30', NULL, NULL),
(224, 'TM', 'Turkmenistan', 0, '2021-04-06 07:21:30', NULL, NULL),
(225, 'TC', 'Turks And Caicos Islands', 0, '2021-04-06 07:21:30', NULL, NULL),
(226, 'TV', 'Tuvalu', 0, '2021-04-06 07:21:30', NULL, NULL),
(227, 'UG', 'Uganda', 0, '2021-04-06 07:21:30', NULL, NULL),
(228, 'UA', 'Ukraine', 0, '2021-04-06 07:21:30', NULL, NULL),
(229, 'AE', 'United Arab Emirates', 0, '2021-04-06 07:21:30', NULL, NULL),
(230, 'GB', 'United Kingdom', 0, '2021-04-06 07:21:30', NULL, NULL),
(231, 'US', 'United States', 0, '2021-04-06 07:21:30', '2021-11-02 08:39:38', NULL),
(232, 'UM', 'United States Minor Outlying Islands', 0, '2021-04-06 07:21:30', NULL, NULL),
(233, 'UY', 'Uruguay', 0, '2021-04-06 07:21:30', NULL, NULL),
(234, 'UZ', 'Uzbekistan', 0, '2021-04-06 07:21:30', NULL, NULL),
(235, 'VU', 'Vanuatu', 0, '2021-04-06 07:21:30', NULL, NULL),
(236, 'VA', 'Vatican City State (Holy See)', 0, '2021-04-06 07:21:30', NULL, NULL),
(237, 'VE', 'Venezuela', 0, '2021-04-06 07:21:30', NULL, NULL),
(238, 'VN', 'Vietnam', 0, '2021-04-06 07:21:30', NULL, NULL),
(239, 'VG', 'Virgin Islands (British)', 0, '2021-04-06 07:21:30', NULL, NULL),
(240, 'VI', 'Virgin Islands (US)', 0, '2021-04-06 07:21:30', NULL, NULL),
(241, 'WF', 'Wallis And Futuna Islands', 0, '2021-04-06 07:21:30', NULL, NULL),
(242, 'EH', 'Western Sahara', 0, '2021-04-06 07:21:30', NULL, NULL),
(243, 'YE', 'Yemen', 0, '2021-04-06 07:21:30', NULL, NULL),
(244, 'YU', 'Yugoslavia', 0, '2021-04-06 07:21:30', NULL, NULL),
(245, 'ZM', 'Zambia', 0, '2021-04-06 07:21:30', NULL, NULL),
(246, 'ZW', 'Zimbabwe', 0, '2021-04-06 07:21:30', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `banner` bigint(20) UNSIGNED DEFAULT NULL,
  `code` varchar(191) NOT NULL,
  `discount_type` varchar(191) NOT NULL COMMENT 'flat/percentage',
  `discount_value` double NOT NULL DEFAULT 0,
  `is_free_shipping` tinyint(4) NOT NULL DEFAULT 0,
  `start_date` text DEFAULT NULL,
  `end_date` text DEFAULT NULL,
  `min_spend` double NOT NULL DEFAULT 0,
  `max_discount_amount` double NOT NULL DEFAULT 0,
  `total_usage_limit` int(11) NOT NULL DEFAULT 1,
  `total_usage_count` int(11) NOT NULL DEFAULT 0,
  `customer_usage_limit` int(11) NOT NULL DEFAULT 1,
  `product_ids` longtext DEFAULT NULL COMMENT 'Coupon will be applicable only for the products selected',
  `category_ids` longtext DEFAULT NULL COMMENT 'Coupon will be applicable only for   categories selected',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupon_themes`
--

CREATE TABLE `coupon_themes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_id` bigint(20) UNSIGNED NOT NULL,
  `theme_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupon_usages`
--

CREATE TABLE `coupon_usages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_code` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `usage_count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `symbol` varchar(191) NOT NULL,
  `alignment` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 for left, 1 for right',
  `rate` double NOT NULL DEFAULT 1,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `code`, `name`, `symbol`, `alignment`, `rate`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'usd', 'US Dollar', '$', 0, 1, 1, '2022-11-27 06:36:37', '2022-11-27 06:36:37', NULL),
(2, 'NPR', 'Nepali Rupee', 'Rs', 0, 1, 1, '2025-05-01 03:56:57', '2025-05-01 03:57:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `enmart_modules`
--

CREATE TABLE `enmart_modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `is_default` tinyint(1) DEFAULT 0,
  `is_paid` tinyint(1) DEFAULT 0,
  `is_verified` tinyint(1) DEFAULT 0,
  `description` text DEFAULT NULL,
  `purchase_code` varchar(191) DEFAULT NULL,
  `domain` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enmart_modules`
--

INSERT INTO `enmart_modules` (`id`, `name`, `is_default`, `is_paid`, `is_verified`, `description`, `purchase_code`, `domain`, `created_at`, `updated_at`) VALUES
(1, 'Support', 1, 0, 0, NULL, NULL, NULL, '2025-05-01 02:27:19', '2025-05-01 02:27:19'),
(2, 'PaymentGateway', 1, 0, 0, NULL, NULL, NULL, '2025-05-01 02:27:19', '2025-05-01 02:27:19');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grass_period_payments`
--

CREATE TABLE `grass_period_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` varchar(191) DEFAULT NULL,
  `transaction_status` varchar(191) DEFAULT NULL,
  `status_code` varchar(191) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `response` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `flag` varchar(191) DEFAULT NULL,
  `code` varchar(191) NOT NULL,
  `is_rtl` tinyint(4) NOT NULL DEFAULT 0,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `font` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `flag`, `code`, `is_rtl`, `is_active`, `created_at`, `updated_at`, `deleted_at`, `font`) VALUES
(1, 'English', 'en', 'en', 0, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `licenses`
--

CREATE TABLE `licenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_code` varchar(191) DEFAULT NULL,
  `client_token` varchar(191) DEFAULT NULL,
  `app_env` varchar(191) DEFAULT NULL,
  `is_active` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `localizations`
--

CREATE TABLE `localizations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lang_key` varchar(191) NOT NULL,
  `t_key` longtext NOT NULL,
  `t_value` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `localizations`
--

INSERT INTO `localizations` (`id`, `lang_key`, `t_key`, `t_value`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'en', 'home', 'Home', '2025-05-01 02:28:22', '2025-05-01 02:28:22', NULL),
(2, 'en', 'explore_now', 'Explore Now', '2025-05-01 02:28:22', '2025-05-01 02:28:22', NULL),
(3, 'en', 'about_us', 'About Us', '2025-05-01 02:28:23', '2025-05-01 02:28:23', NULL),
(4, 'en', 'follow_on', 'Follow on', '2025-05-01 02:28:23', '2025-05-01 02:28:23', NULL),
(5, 'en', 'our_top_categories', 'Our Top Categories', '2025-05-01 02:28:23', '2025-05-01 02:28:23', NULL),
(6, 'en', 'our_featured_products', 'Our Featured Products', '2025-05-01 02:28:23', '2025-05-01 02:28:23', NULL),
(7, 'en', 'top_trending_products', 'Top Trending Products', '2025-05-01 02:28:24', '2025-05-01 02:28:24', NULL),
(8, 'en', 'all_products', 'All Products', '2025-05-01 02:28:24', '2025-05-01 02:28:24', NULL),
(9, 'en', 'weekly_best_deals', 'Weekly Best Deals', '2025-05-01 02:28:24', '2025-05-01 02:28:24', NULL),
(10, 'en', 'days', 'Days', '2025-05-01 02:28:24', '2025-05-01 02:28:24', NULL),
(11, 'en', 'hours', 'Hours', '2025-05-01 02:28:24', '2025-05-01 02:28:24', NULL),
(12, 'en', 'min', 'Min', '2025-05-01 02:28:24', '2025-05-01 02:28:24', NULL),
(13, 'en', 'sec', 'Sec', '2025-05-01 02:28:24', '2025-05-01 02:28:24', NULL),
(14, 'en', 'login', 'Login', '2025-05-01 02:28:24', '2025-05-01 02:28:24', NULL),
(15, 'en', 'hey_there', 'Hey there!', '2025-05-01 02:28:24', '2025-05-01 02:28:24', NULL),
(16, 'en', 'welcome_back_to_grostore', 'Welcome back to Grostore.', '2025-05-01 02:28:24', '2025-05-01 02:28:24', NULL),
(17, 'en', 'email', 'Email', '2025-05-01 02:28:24', '2025-05-01 02:28:24', NULL),
(18, 'en', 'enter_your_email', 'Enter your email', '2025-05-01 02:28:24', '2025-05-01 02:28:24', NULL),
(19, 'en', 'login_with_phone', 'Login with phone?', '2025-05-01 02:28:24', '2025-05-01 02:28:24', NULL),
(20, 'en', 'phone', 'Phone', '2025-05-01 02:28:24', '2025-05-01 02:28:24', NULL),
(21, 'en', 'login_with_email', 'Login with email?', '2025-05-01 02:28:24', '2025-05-01 02:28:24', NULL),
(22, 'en', 'password', 'Password', '2025-05-01 02:28:24', '2025-05-01 02:28:24', NULL),
(23, 'en', 'remember_me', 'Remember me', '2025-05-01 02:28:24', '2025-05-01 02:28:24', NULL),
(24, 'en', 'forgot_password', 'Forgot Password', '2025-05-01 02:28:24', '2025-05-01 02:28:24', NULL),
(25, 'en', 'sign_in', 'Sign In', '2025-05-01 02:28:24', '2025-05-01 02:28:24', NULL),
(26, 'en', 'what_our_clients_say', 'What Our Clients Say', '2025-05-01 02:28:25', '2025-05-01 02:28:25', NULL),
(27, 'en', 'dont_have_an_account', 'Don\'t have an Account?', '2025-05-01 02:28:25', '2025-05-01 02:28:25', NULL),
(28, 'en', 'sign_up', 'Sign Up', '2025-05-01 02:28:25', '2025-05-01 02:28:25', NULL),
(29, 'en', 'new_products', 'New Products', '2025-05-01 02:28:25', '2025-05-01 02:28:25', NULL),
(30, 'en', 'view_more', 'View More', '2025-05-01 02:28:25', '2025-05-01 02:28:25', NULL),
(31, 'en', 'best_selling', 'Best Selling', '2025-05-01 02:28:25', '2025-05-01 02:28:25', NULL),
(32, 'en', 'browse_recent_post', 'Browse Recent Post', '2025-05-01 02:28:25', '2025-05-01 02:28:25', NULL),
(33, 'en', 'learn_more_about_our_recent_exclusive_news_updates__articles', 'Learn More About Our Recent Exclusive News, Updates & Articles', '2025-05-01 02:28:25', '2025-05-01 02:28:25', NULL),
(34, 'en', 'please_select_shipping_address', 'Please select shipping address', '2025-05-01 02:28:25', '2025-05-01 02:28:25', NULL),
(35, 'en', 'buy_now', 'Buy Now', '2025-05-01 02:28:25', '2025-05-01 02:28:25', NULL),
(36, 'en', 'please_select_logistic', 'Please select logistic', '2025-05-01 02:28:25', '2025-05-01 02:28:25', NULL),
(37, 'en', 'please_select_billing_address', 'Please select billing address', '2025-05-01 02:28:26', '2025-05-01 02:28:26', NULL),
(38, 'en', 'add_to_cart', 'Add to Cart', '2025-05-01 02:28:26', '2025-05-01 02:28:26', NULL),
(39, 'en', 'out_of_stock', 'Out of Stock', '2025-05-01 02:28:26', '2025-05-01 02:28:26', NULL),
(40, 'en', 'please_login_first', 'Please login first', '2025-05-01 02:28:26', '2025-05-01 02:28:26', NULL),
(41, 'en', 'adding', 'Adding..', '2025-05-01 02:28:26', '2025-05-01 02:28:26', NULL),
(42, 'en', 'please_choose_all_the_available_options', 'Please choose all the available options', '2025-05-01 02:28:26', '2025-05-01 02:28:26', NULL),
(43, 'en', 'apply_coupon', 'Apply Coupon', '2025-05-01 02:28:26', '2025-05-01 02:28:26', NULL),
(44, 'en', 'please_wait', 'Please Wait', '2025-05-01 02:28:26', '2025-05-01 02:28:26', NULL),
(45, 'en', 'dark', 'Dark', '2025-05-01 02:28:27', '2025-05-01 02:28:27', NULL),
(46, 'en', 'dark', 'Dark', '2025-05-01 02:28:27', '2025-05-01 02:28:27', NULL),
(47, 'en', 'light', 'Light', '2025-05-01 02:28:27', '2025-05-01 02:28:27', NULL),
(48, 'en', 'light', 'Light', '2025-05-01 02:28:27', '2025-05-01 02:28:27', NULL),
(49, 'en', 'categories', 'Categories', '2025-05-01 02:28:27', '2025-05-01 02:28:27', NULL),
(50, 'en', 'products', 'Products', '2025-05-01 02:28:28', '2025-05-01 02:28:28', NULL),
(51, 'en', 'campaigns', 'Campaigns', '2025-05-01 02:28:28', '2025-05-01 02:28:28', NULL),
(52, 'en', 'campaigns', 'Campaigns', '2025-05-01 02:28:28', '2025-05-01 02:28:28', NULL),
(53, 'en', 'coupons', 'Coupons', '2025-05-01 02:28:28', '2025-05-01 02:28:28', NULL),
(54, 'en', 'coupons', 'Coupons', '2025-05-01 02:28:28', '2025-05-01 02:28:28', NULL),
(55, 'en', 'pages', 'Pages', '2025-05-01 02:28:28', '2025-05-01 02:28:28', NULL),
(56, 'en', 'pages', 'Pages', '2025-05-01 02:28:28', '2025-05-01 02:28:28', NULL),
(57, 'en', 'blogs', 'Blogs', '2025-05-01 02:28:28', '2025-05-01 02:28:28', NULL),
(58, 'en', 'blogs', 'Blogs', '2025-05-01 02:28:28', '2025-05-01 02:28:28', NULL),
(59, 'en', 'contact_us', 'Contact Us', '2025-05-01 02:28:28', '2025-05-01 02:28:28', NULL),
(60, 'en', 'contact_us', 'Contact Us', '2025-05-01 02:28:28', '2025-05-01 02:28:28', NULL),
(61, 'en', 'search_products', 'Search products', '2025-05-01 02:28:28', '2025-05-01 02:28:28', NULL),
(62, 'en', 'search_products', 'Search products', '2025-05-01 02:28:28', '2025-05-01 02:28:28', NULL),
(63, 'en', 'log_in', 'Log In', '2025-05-01 02:28:28', '2025-05-01 02:28:28', NULL),
(64, 'en', 'log_in', 'Log In', '2025-05-01 02:28:28', '2025-05-01 02:28:28', NULL),
(65, 'en', 'registration', 'Registration', '2025-05-01 02:28:28', '2025-05-01 02:28:28', NULL),
(66, 'en', 'registration', 'Registration', '2025-05-01 02:28:28', '2025-05-01 02:28:28', NULL),
(67, 'en', 'subtotal', 'Subtotal', '2025-05-01 02:28:28', '2025-05-01 02:28:28', NULL),
(68, 'en', 'subtotal', 'Subtotal', '2025-05-01 02:28:28', '2025-05-01 02:28:28', NULL),
(69, 'en', 'view_cart', 'View Cart', '2025-05-01 02:28:28', '2025-05-01 02:28:28', NULL),
(70, 'en', 'view_cart', 'View Cart', '2025-05-01 02:28:28', '2025-05-01 02:28:28', NULL),
(71, 'en', 'checkout', 'Checkout', '2025-05-01 02:28:29', '2025-05-01 02:28:29', NULL),
(72, 'en', 'checkout', 'Checkout', '2025-05-01 02:28:29', '2025-05-01 02:28:29', NULL),
(73, 'en', 'phone__telephone', 'Phone & Telephone', '2025-05-01 02:28:29', '2025-05-01 02:28:29', NULL),
(74, 'en', 'phone__telephone', 'Phone & Telephone', '2025-05-01 02:28:29', '2025-05-01 02:28:29', NULL),
(75, 'en', 'subscribe_to_the_us', 'Subscribe to the us', '2025-05-01 02:28:31', '2025-05-01 02:28:31', NULL),
(76, 'en', 'subscribe_to_the_us', 'Subscribe to the us', '2025-05-01 02:28:31', '2025-05-01 02:28:31', NULL),
(77, 'en', 'new_arrivals', 'New Arrivals', '2025-05-01 02:28:31', '2025-05-01 02:28:31', NULL),
(78, 'en', 'new_arrivals', 'New Arrivals', '2025-05-01 02:28:31', '2025-05-01 02:28:31', NULL),
(79, 'en', '_other_information', '& Other Information.', '2025-05-01 02:28:31', '2025-05-01 02:28:31', NULL),
(80, 'en', '_other_information', '& Other Information.', '2025-05-01 02:28:31', '2025-05-01 02:28:31', NULL),
(81, 'en', 'enter_email_address', 'Enter Email Address', '2025-05-01 02:28:31', '2025-05-01 02:28:31', NULL),
(82, 'en', 'enter_email_address', 'Enter Email Address', '2025-05-01 02:28:31', '2025-05-01 02:28:31', NULL),
(83, 'en', 'subscribe_now', 'Subscribe Now', '2025-05-01 02:28:31', '2025-05-01 02:28:31', NULL),
(84, 'en', 'subscribe_now', 'Subscribe Now', '2025-05-01 02:28:31', '2025-05-01 02:28:31', NULL),
(85, 'en', 'category', 'Category', '2025-05-01 02:28:31', '2025-05-01 02:28:31', NULL),
(86, 'en', 'category', 'Category', '2025-05-01 02:28:31', '2025-05-01 02:28:31', NULL),
(87, 'en', 'quick_links', 'Quick Links', '2025-05-01 02:28:31', '2025-05-01 02:28:31', NULL),
(88, 'en', 'quick_links', 'Quick Links', '2025-05-01 02:28:31', '2025-05-01 02:28:31', NULL),
(89, 'en', 'customer_pages', 'Customer Pages', '2025-05-01 02:28:31', '2025-05-01 02:28:31', NULL),
(90, 'en', 'customer_pages', 'Customer Pages', '2025-05-01 02:28:31', '2025-05-01 02:28:31', NULL),
(91, 'en', 'your_account', 'Your Account', '2025-05-01 02:28:31', '2025-05-01 02:28:31', NULL),
(92, 'en', 'your_account', 'Your Account', '2025-05-01 02:28:31', '2025-05-01 02:28:31', NULL),
(93, 'en', 'your_orders', 'Your Orders', '2025-05-01 02:28:31', '2025-05-01 02:28:31', NULL),
(94, 'en', 'your_wishlist', 'Your Wishlist', '2025-05-01 02:28:31', '2025-05-01 02:28:31', NULL),
(95, 'en', 'your_wishlist', 'Your Wishlist', '2025-05-01 02:28:31', '2025-05-01 02:28:31', NULL),
(96, 'en', 'address_book', 'Address Book', '2025-05-01 02:28:31', '2025-05-01 02:28:31', NULL),
(97, 'en', 'address_book', 'Address Book', '2025-05-01 02:28:31', '2025-05-01 02:28:31', NULL),
(98, 'en', 'update_profile', 'Update Profile', '2025-05-01 02:28:31', '2025-05-01 02:28:31', NULL),
(99, 'en', 'update_profile', 'Update Profile', '2025-05-01 02:28:31', '2025-05-01 02:28:31', NULL),
(100, 'en', 'contact_info', 'Contact Info', '2025-05-01 02:28:31', '2025-05-01 02:28:31', NULL),
(101, 'en', 'search', 'Search', '2025-05-01 02:28:32', '2025-05-01 02:28:32', NULL),
(102, 'en', 'search', 'Search', '2025-05-01 02:28:32', '2025-05-01 02:28:32', NULL),
(103, 'en', 'account', 'Account', '2025-05-01 02:28:32', '2025-05-01 02:28:32', NULL),
(104, 'en', 'account', 'Account', '2025-05-01 02:28:32', '2025-05-01 02:28:32', NULL),
(105, 'en', 'search_now', 'Search Now', '2025-05-01 02:28:39', '2025-05-01 02:28:39', NULL),
(106, 'en', 'filter_by_price', 'Filter by Price', '2025-05-01 02:28:39', '2025-05-01 02:28:39', NULL),
(107, 'en', 'filter', 'Filter', '2025-05-01 02:28:39', '2025-05-01 02:28:39', NULL),
(108, 'en', 'tags', 'Tags', '2025-05-01 02:28:39', '2025-05-01 02:28:39', NULL),
(109, 'en', 'showing', 'Showing', '2025-05-01 02:28:39', '2025-05-01 02:28:39', NULL),
(110, 'en', 'of', 'of', '2025-05-01 02:28:39', '2025-05-01 02:28:39', NULL),
(111, 'en', 'results', 'results', '2025-05-01 02:28:39', '2025-05-01 02:28:39', NULL),
(112, 'en', 'show', 'Show', '2025-05-01 02:28:39', '2025-05-01 02:28:39', NULL),
(113, 'en', 'sort_by', 'Sort by', '2025-05-01 02:28:39', '2025-05-01 02:28:39', NULL),
(114, 'en', 'newest_first', 'Newest First', '2025-05-01 02:28:39', '2025-05-01 02:28:39', NULL),
(115, 'en', 'google_recaptcha_validation_error_seems_like_you_are_not_a_human', 'Google recaptcha validation error, seems like you are not a human.', '2025-05-01 02:36:07', '2025-05-01 02:36:07', NULL),
(116, 'en', 'last_7_days', 'Last 7 days', '2025-05-01 02:36:09', '2025-05-01 02:36:09', NULL),
(117, 'en', 'dashboard', 'Dashboard', '2025-05-01 02:36:11', '2025-05-01 02:36:11', NULL),
(118, 'en', 'admin_dashboard', 'Admin Dashboard', '2025-05-01 02:36:11', '2025-05-01 02:36:11', NULL),
(119, 'en', 'manage_sales', 'Manage Sales', '2025-05-01 02:36:11', '2025-05-01 02:36:11', NULL),
(120, 'en', 'add_product', 'Add Product', '2025-05-01 02:36:11', '2025-05-01 02:36:11', NULL),
(121, 'en', 'total_earning', 'Total Earning', '2025-05-01 02:36:11', '2025-05-01 02:36:11', NULL),
(122, 'en', 'last_30_days', 'Last 30 days', '2025-05-01 02:36:11', '2025-05-01 02:36:11', NULL),
(123, 'en', 'last_3_months', 'Last 3 months', '2025-05-01 02:36:11', '2025-05-01 02:36:11', NULL),
(124, 'en', 'top_5_category_sales', 'Top 5 Category Sales', '2025-05-01 02:36:11', '2025-05-01 02:36:11', NULL),
(125, 'en', 'last_30_days_orders', 'Last 30 Days Orders', '2025-05-01 02:36:11', '2025-05-01 02:36:11', NULL),
(126, 'en', 'sales_this_months', 'Sales This Months', '2025-05-01 02:36:11', '2025-05-01 02:36:11', NULL),
(127, 'en', 'top_selling_products', 'Top Selling Products', '2025-05-01 02:36:11', '2025-05-01 02:36:11', NULL),
(128, 'en', 'we_have_listed_0_total_products', 'We have listed 0 total products.', '2025-05-01 02:36:11', '2025-05-01 02:36:11', NULL),
(129, 'en', 'total_orders', 'Total Orders', '2025-05-01 02:36:11', '2025-05-01 02:36:11', NULL),
(130, 'en', 'order_pending', 'Order Pending', '2025-05-01 02:36:12', '2025-05-01 02:36:12', NULL),
(131, 'en', 'order_processing', 'Order Processing', '2025-05-01 02:36:12', '2025-05-01 02:36:12', NULL),
(132, 'en', 'total_delivered', 'Total Delivered', '2025-05-01 02:36:12', '2025-05-01 02:36:12', NULL),
(133, 'en', 'recent_orders', 'Recent Orders', '2025-05-01 02:36:12', '2025-05-01 02:36:12', NULL),
(134, 'en', 'your_10_most_recent_orders', 'Your 10 Most Recent Orders', '2025-05-01 02:36:12', '2025-05-01 02:36:12', NULL),
(135, 'en', 'view_all', 'View All', '2025-05-01 02:36:12', '2025-05-01 02:36:12', NULL),
(136, 'en', 'order_code', 'Order Code', '2025-05-01 02:36:12', '2025-05-01 02:36:12', NULL),
(137, 'en', 'customer', 'Customer', '2025-05-01 02:36:12', '2025-05-01 02:36:12', NULL),
(138, 'en', 'placed_on', 'Placed On', '2025-05-01 02:36:12', '2025-05-01 02:36:12', NULL),
(139, 'en', 'items', 'Items', '2025-05-01 02:36:12', '2025-05-01 02:36:12', NULL),
(140, 'en', 'payment_status', 'Payment Status', '2025-05-01 02:36:12', '2025-05-01 02:36:12', NULL),
(141, 'en', 'delivery_status', 'Delivery Status', '2025-05-01 02:36:12', '2025-05-01 02:36:12', NULL),
(142, 'en', 'delivery_type', 'Delivery Type', '2025-05-01 02:36:12', '2025-05-01 02:36:12', NULL),
(143, 'en', 'action', 'Action', '2025-05-01 02:36:12', '2025-05-01 02:36:12', NULL),
(144, 'en', 'picked_up_orders', 'Picked Up Orders', '2025-05-01 02:36:12', '2025-05-01 02:36:12', NULL),
(145, 'en', 'cancelled_orders', 'Cancelled Orders', '2025-05-01 02:36:12', '2025-05-01 02:36:12', NULL),
(146, 'en', 'out_for_delivery', 'Out For Delivery', '2025-05-01 02:36:12', '2025-05-01 02:36:12', NULL),
(147, 'en', 'paid_orders', 'Paid Orders', '2025-05-01 02:36:12', '2025-05-01 02:36:12', NULL),
(148, 'en', 'unpaid_orders', 'Unpaid Orders', '2025-05-01 02:36:12', '2025-05-01 02:36:12', NULL),
(149, 'en', 'todays_earning', 'Today\'s Earning', '2025-05-01 02:36:12', '2025-05-01 02:36:12', NULL),
(150, 'en', 'todays_pending_earning', 'Today\'s Pending Earning', '2025-05-01 02:36:12', '2025-05-01 02:36:12', NULL),
(151, 'en', 'this_year_earning', 'This Year Earning', '2025-05-01 02:36:12', '2025-05-01 02:36:12', NULL),
(152, 'en', 'total_product_sale', 'Total Product Sale', '2025-05-01 02:36:12', '2025-05-01 02:36:12', NULL),
(153, 'en', 'todays_product_sale', 'Today\'s Product Sale', '2025-05-01 02:36:12', '2025-05-01 02:36:12', NULL),
(154, 'en', 'this_months_product_sale', 'This Month\'s Product Sale', '2025-05-01 02:36:12', '2025-05-01 02:36:12', NULL),
(155, 'en', 'this_years_product_sale', 'This Year\'s Product Sale', '2025-05-01 02:36:12', '2025-05-01 02:36:12', NULL),
(156, 'en', 'total_customers', 'Total Customers', '2025-05-01 02:36:12', '2025-05-01 02:36:12', NULL),
(157, 'en', 'total_subscribers', 'Total Subscribers', '2025-05-01 02:36:12', '2025-05-01 02:36:12', NULL),
(158, 'en', 'total_categories', 'Total Categories', '2025-05-01 02:36:12', '2025-05-01 02:36:12', NULL),
(159, 'en', 'total_brands', 'Total Brands', '2025-05-01 02:36:12', '2025-05-01 02:36:12', NULL),
(160, 'en', 'earning', 'Earning', '2025-05-01 02:36:12', '2025-05-01 02:36:12', NULL),
(161, 'en', 'super_admin', 'Super Admin', '2025-05-01 02:36:13', '2025-05-01 02:36:13', NULL),
(162, 'en', 'all_categories', 'All Categories', '2025-05-01 02:36:19', '2025-05-01 02:36:19', NULL),
(163, 'en', 'all_variations', 'All Variations', '2025-05-01 02:36:19', '2025-05-01 02:36:19', NULL),
(164, 'en', 'all_brands', 'All Brands', '2025-05-01 02:36:19', '2025-05-01 02:36:19', NULL),
(165, 'en', 'all_units', 'All Units', '2025-05-01 02:36:19', '2025-05-01 02:36:19', NULL),
(166, 'en', 'all_taxes', 'All Taxes', '2025-05-01 02:36:20', '2025-05-01 02:36:20', NULL),
(167, 'en', 'pos_system', 'Pos System', '2025-05-01 02:36:20', '2025-05-01 02:36:20', NULL),
(168, 'en', 'orders', 'Orders', '2025-05-01 02:36:20', '2025-05-01 02:36:20', NULL),
(169, 'en', 'stocks', 'Stocks', '2025-05-01 02:36:20', '2025-05-01 02:36:20', NULL),
(170, 'en', 'add_stock', 'Add Stock', '2025-05-01 02:36:20', '2025-05-01 02:36:20', NULL),
(171, 'en', 'all_locations', 'All Locations', '2025-05-01 02:36:20', '2025-05-01 02:36:20', NULL),
(172, 'en', 'refunds', 'Refunds', '2025-05-01 02:36:20', '2025-05-01 02:36:20', NULL),
(173, 'en', 'refund_configurations', 'Refund Configurations', '2025-05-01 02:36:20', '2025-05-01 02:36:20', NULL),
(174, 'en', 'refund_requests', 'Refund Requests', '2025-05-01 02:36:20', '2025-05-01 02:36:20', NULL),
(175, 'en', 'approved_refunds', 'Approved Refunds', '2025-05-01 02:36:20', '2025-05-01 02:36:20', NULL),
(176, 'en', 'rejected_refunds', 'Rejected Refunds', '2025-05-01 02:36:20', '2025-05-01 02:36:20', NULL),
(177, 'en', 'rewards__wallet', 'Rewards & Wallet', '2025-05-01 02:36:20', '2025-05-01 02:36:20', NULL),
(178, 'en', 'reward_configurations', 'Reward Configurations', '2025-05-01 02:36:20', '2025-05-01 02:36:20', NULL),
(179, 'en', 'set_reward_points', 'Set Reward Points', '2025-05-01 02:36:20', '2025-05-01 02:36:20', NULL),
(180, 'en', 'wallet_configurations', 'Wallet Configurations', '2025-05-01 02:36:20', '2025-05-01 02:36:20', NULL),
(181, 'en', 'users', 'Users', '2025-05-01 02:36:20', '2025-05-01 02:36:20', NULL),
(182, 'en', 'customers', 'Customers', '2025-05-01 02:36:20', '2025-05-01 02:36:20', NULL),
(183, 'en', 'employee_staffs', 'Employee Staffs', '2025-05-01 02:36:20', '2025-05-01 02:36:20', NULL),
(184, 'en', 'delivery_men', 'Delivery Men', '2025-05-01 02:36:20', '2025-05-01 02:36:20', NULL),
(185, 'en', 'all_deliverymen', 'All Deliverymen', '2025-05-01 02:36:20', '2025-05-01 02:36:20', NULL),
(186, 'en', 'add_deliveryman', 'Add Deliveryman', '2025-05-01 02:36:20', '2025-05-01 02:36:20', NULL),
(187, 'en', 'cancel_requests', 'Cancel Requests', '2025-05-01 02:36:20', '2025-05-01 02:36:20', NULL),
(188, 'en', 'payout_histories', 'Payout Histories', '2025-05-01 02:36:20', '2025-05-01 02:36:20', NULL),
(189, 'en', 'configurations', 'Configurations', '2025-05-01 02:36:20', '2025-05-01 02:36:20', NULL),
(190, 'en', 'deliveryman_payroll', 'Deliveryman Payroll', '2025-05-01 02:36:20', '2025-05-01 02:36:20', NULL),
(191, 'en', 'deliveryman_payroll_list', 'Deliveryman Payroll List', '2025-05-01 02:36:20', '2025-05-01 02:36:20', NULL),
(192, 'en', 'contents', 'Contents', '2025-05-01 02:36:20', '2025-05-01 02:36:20', NULL),
(193, 'en', 'all_blogs', 'All Blogs', '2025-05-01 02:36:20', '2025-05-01 02:36:20', NULL),
(194, 'en', 'media_manager', 'Media Manager', '2025-05-01 02:36:20', '2025-05-01 02:36:20', NULL),
(195, 'en', 'promotions', 'Promotions', '2025-05-01 02:36:21', '2025-05-01 02:36:21', NULL),
(196, 'en', 'newsletters', 'Newsletters', '2025-05-01 02:36:21', '2025-05-01 02:36:21', NULL),
(197, 'en', 'bulk_emails', 'Bulk Emails', '2025-05-01 02:36:21', '2025-05-01 02:36:21', NULL),
(198, 'en', 'subscribers', 'Subscribers', '2025-05-01 02:36:21', '2025-05-01 02:36:21', NULL),
(199, 'en', 'fulfillment', 'Fulfillment', '2025-05-01 02:36:21', '2025-05-01 02:36:21', NULL),
(200, 'en', 'logistics', 'Logistics', '2025-05-01 02:36:21', '2025-05-01 02:36:21', NULL),
(201, 'en', 'shipping_zones', 'Shipping Zones', '2025-05-01 02:36:21', '2025-05-01 02:36:21', NULL),
(202, 'en', 'reports', 'Reports', '2025-05-01 02:36:21', '2025-05-01 02:36:21', NULL),
(203, 'en', 'orders_report', 'Orders Report', '2025-05-01 02:36:21', '2025-05-01 02:36:21', NULL),
(204, 'en', 'product_sales', 'Product Sales', '2025-05-01 02:36:21', '2025-05-01 02:36:21', NULL),
(205, 'en', 'category_wise_sales', 'Category Wise Sales', '2025-05-01 02:36:21', '2025-05-01 02:36:21', NULL),
(206, 'en', 'sales_amount_report', 'Sales Amount Report', '2025-05-01 02:36:21', '2025-05-01 02:36:21', NULL),
(207, 'en', 'delivery_status_report', 'Delivery Status Report', '2025-05-01 02:36:21', '2025-05-01 02:36:21', NULL),
(208, 'en', 'support', 'Support', '2025-05-01 02:36:21', '2025-05-01 02:36:21', NULL),
(209, 'en', 'queries', 'Queries', '2025-05-01 02:36:21', '2025-05-01 02:36:21', NULL),
(210, 'en', 'support_ticket', 'Support Ticket', '2025-05-01 02:36:21', '2025-05-01 02:36:21', NULL),
(211, 'en', 'priority', 'Priority', '2025-05-01 02:36:21', '2025-05-01 02:36:21', NULL),
(212, 'en', 'tickets', 'Tickets', '2025-05-01 02:36:21', '2025-05-01 02:36:21', NULL),
(213, 'en', 'appearance', 'Appearance', '2025-05-01 02:36:21', '2025-05-01 02:36:21', NULL),
(214, 'en', 'grocery', 'Grocery', '2025-05-01 02:36:21', '2025-05-01 02:36:21', NULL),
(215, 'en', 'homepage', 'Homepage', '2025-05-01 02:36:21', '2025-05-01 02:36:21', NULL),
(216, 'en', 'halal_foods', 'Halal Foods', '2025-05-01 02:36:21', '2025-05-01 02:36:21', NULL),
(217, 'en', 'furniture', 'Furniture', '2025-05-01 02:36:22', '2025-05-01 02:36:22', NULL),
(218, 'en', 'common_outlook', 'Common Outlook', '2025-05-01 02:36:22', '2025-05-01 02:36:22', NULL),
(219, 'en', 'products_page', 'Products Page', '2025-05-01 02:36:22', '2025-05-01 02:36:22', NULL),
(220, 'en', 'product_details', 'Product Details', '2025-05-01 02:36:22', '2025-05-01 02:36:22', NULL),
(221, 'en', 'header', 'Header', '2025-05-01 02:36:22', '2025-05-01 02:36:22', NULL),
(222, 'en', 'footer', 'Footer', '2025-05-01 02:36:22', '2025-05-01 02:36:22', NULL),
(223, 'en', 'themes', 'Themes', '2025-05-01 02:36:22', '2025-05-01 02:36:22', NULL),
(224, 'en', 'settings', 'Settings', '2025-05-01 02:36:22', '2025-05-01 02:36:22', NULL),
(225, 'en', 'roles__permissions', 'Roles & Permissions', '2025-05-01 02:36:22', '2025-05-01 02:36:22', NULL),
(226, 'en', 'system_settings', 'System Settings', '2025-05-01 02:36:22', '2025-05-01 02:36:22', NULL),
(227, 'en', 'general_settings', 'General Settings', '2025-05-01 02:36:22', '2025-05-01 02:36:22', NULL),
(228, 'en', 'auth_settings', 'Auth Settings', '2025-05-01 02:36:22', '2025-05-01 02:36:22', NULL),
(229, 'en', 'invoice_settings', 'Invoice Settings', '2025-05-01 02:36:22', '2025-05-01 02:36:22', NULL),
(230, 'en', 'otp_settings', 'OTP Settings', '2025-05-01 02:36:22', '2025-05-01 02:36:22', NULL),
(231, 'en', 'order_settings', 'Order Settings', '2025-05-01 02:36:22', '2025-05-01 02:36:22', NULL),
(232, 'en', 'admin_store', 'Admin Store', '2025-05-01 02:36:22', '2025-05-01 02:36:22', NULL),
(233, 'en', 'smtp_settings', 'SMTP Settings', '2025-05-01 02:36:22', '2025-05-01 02:36:22', NULL),
(234, 'en', 'payment_methods', 'Payment Methods', '2025-05-01 02:36:22', '2025-05-01 02:36:22', NULL),
(235, 'en', 'social_media_login', 'Social Media Login', '2025-05-01 02:36:22', '2025-05-01 02:36:22', NULL),
(236, 'en', 'multilingual_settings', 'Multilingual Settings', '2025-05-01 02:36:22', '2025-05-01 02:36:22', NULL),
(237, 'en', 'multi_currency_settings', 'Multi Currency Settings', '2025-05-01 02:36:22', '2025-05-01 02:36:22', NULL),
(238, 'en', 'system_update', 'System Update', '2025-05-01 02:36:22', '2025-05-01 02:36:22', NULL),
(239, 'en', 'utilities', 'Utilities', '2025-05-01 02:36:22', '2025-05-01 02:36:22', NULL),
(240, 'en', 'visit_store', 'Visit Store', '2025-05-01 02:36:23', '2025-05-01 02:36:23', NULL),
(241, 'en', 'no_new_notification', 'No New Notification', '2025-05-01 02:36:24', '2025-05-01 02:36:24', NULL),
(242, 'en', 'my_account', 'My Account', '2025-05-01 02:36:24', '2025-05-01 02:36:24', NULL),
(243, 'en', 'sign_out', 'Sign out', '2025-05-01 02:36:24', '2025-05-01 02:36:24', NULL),
(244, 'en', 'media_files', 'Media Files', '2025-05-01 02:36:24', '2025-05-01 02:36:24', NULL),
(245, 'en', 'recently_uploaded_files', 'Recently uploaded files', '2025-05-01 02:36:24', '2025-05-01 02:36:24', NULL),
(246, 'en', 'add_files_here', 'Add files here', '2025-05-01 02:36:24', '2025-05-01 02:36:24', NULL),
(247, 'en', 'previously_uploaded_files', 'Previously uploaded files', '2025-05-01 02:36:24', '2025-05-01 02:36:24', NULL),
(248, 'en', 'search_by_name', 'Search by name', '2025-05-01 02:36:24', '2025-05-01 02:36:24', NULL),
(249, 'en', 'load_more', 'Load More', '2025-05-01 02:36:24', '2025-05-01 02:36:24', NULL),
(250, 'en', 'select', 'Select', '2025-05-01 02:36:24', '2025-05-01 02:36:24', NULL),
(251, 'en', 'delete_confirmation', 'Delete Confirmation', '2025-05-01 02:36:25', '2025-05-01 02:36:25', NULL),
(252, 'en', 'are_you_sure_to_delete_this', 'Are you sure to delete this?', '2025-05-01 02:36:25', '2025-05-01 02:36:25', NULL),
(253, 'en', 'all_data_related_to_this_may_get_deleted', 'All data related to this may get deleted.', '2025-05-01 02:36:25', '2025-05-01 02:36:25', NULL),
(254, 'en', 'proceed', 'Proceed', '2025-05-01 02:36:25', '2025-05-01 02:36:25', NULL),
(255, 'en', 'cancel', 'Cancel', '2025-05-01 02:36:25', '2025-05-01 02:36:25', NULL),
(256, 'en', 'are_you_sure_to_delete_all_data', 'Are you sure to delete all data?', '2025-05-01 02:36:25', '2025-05-01 02:36:25', NULL),
(257, 'en', 'no_data_found', 'No data found', '2025-05-01 02:36:25', '2025-05-01 02:36:25', NULL),
(258, 'en', 'selected_file', 'Selected File', '2025-05-01 02:36:25', '2025-05-01 02:36:25', NULL),
(259, 'en', 'selected_files', 'Selected Files', '2025-05-01 02:36:25', '2025-05-01 02:36:25', NULL),
(260, 'en', 'file_added', 'File added', '2025-05-01 02:36:25', '2025-05-01 02:36:25', NULL),
(261, 'en', 'files_added', 'Files added', '2025-05-01 02:36:25', '2025-05-01 02:36:25', NULL),
(262, 'en', 'no_file_chosen', 'No file chosen', '2025-05-01 02:36:25', '2025-05-01 02:36:25', NULL),
(263, 'en', 'delivery_status_has_been_updated', 'Delivery status has been updated', '2025-05-01 02:36:25', '2025-05-01 02:36:25', NULL),
(264, 'en', 'if_you_change_the_location_your_cart_will_be_cleared_do_you_want_to_proceed', 'If you change the location your cart will be cleared. Do you want to proceed?', '2025-05-01 02:36:25', '2025-05-01 02:36:25', NULL),
(265, 'en', 'website_homepage_configuration', 'Website Homepage Configuration', '2025-05-01 02:37:12', '2025-05-01 02:37:12', NULL),
(266, 'en', 'hero_section_configuration', 'Hero Section Configuration', '2025-05-01 02:37:13', '2025-05-01 02:37:13', NULL),
(267, 'en', 'sl', 'S/L', '2025-05-01 02:37:13', '2025-05-01 02:37:13', NULL),
(268, 'en', 'image', 'Image', '2025-05-01 02:37:13', '2025-05-01 02:37:13', NULL),
(269, 'en', 'sub_title', 'Sub Title', '2025-05-01 02:37:13', '2025-05-01 02:37:13', NULL),
(270, 'en', 'title', 'Title', '2025-05-01 02:37:13', '2025-05-01 02:37:13', NULL),
(271, 'en', 'text', 'Text', '2025-05-01 02:37:13', '2025-05-01 02:37:13', NULL),
(272, 'en', 'edit', 'Edit', '2025-05-01 02:37:13', '2025-05-01 02:37:13', NULL),
(273, 'en', 'delete', 'Delete', '2025-05-01 02:37:13', '2025-05-01 02:37:13', NULL),
(274, 'en', 'add_new_slider', 'Add New Slider', '2025-05-01 02:37:13', '2025-05-01 02:37:13', NULL),
(275, 'en', 'type_sub_title', 'Type sub title', '2025-05-01 02:37:13', '2025-05-01 02:37:13', NULL),
(276, 'en', 'type_title', 'Type title', '2025-05-01 02:37:13', '2025-05-01 02:37:13', NULL),
(277, 'en', 'type_text', 'Type text', '2025-05-01 02:37:13', '2025-05-01 02:37:13', NULL),
(278, 'en', 'link', 'Link', '2025-05-01 02:37:13', '2025-05-01 02:37:13', NULL),
(279, 'en', 'slider_image', 'Slider Image', '2025-05-01 02:37:13', '2025-05-01 02:37:13', NULL),
(280, 'en', 'choose_slider_image', 'Choose Slider Image', '2025-05-01 02:37:13', '2025-05-01 02:37:13', NULL),
(281, 'en', 'save_slider', 'Save Slider', '2025-05-01 02:37:13', '2025-05-01 02:37:13', NULL),
(282, 'en', 'homepage_configuration', 'Homepage Configuration', '2025-05-01 02:37:13', '2025-05-01 02:37:13', NULL),
(283, 'en', 'hero_section', 'Hero Section', '2025-05-01 02:37:13', '2025-05-01 02:37:13', NULL),
(284, 'en', 'top_categories', 'Top Categories', '2025-05-01 02:37:13', '2025-05-01 02:37:13', NULL),
(285, 'en', 'featured_products', 'Featured Products', '2025-05-01 02:37:13', '2025-05-01 02:37:13', NULL),
(286, 'en', 'banner_section_one', 'Banner Section One', '2025-05-01 02:37:13', '2025-05-01 02:37:13', NULL),
(287, 'en', 'banner_section_two', 'Banner Section Two', '2025-05-01 02:37:14', '2025-05-01 02:37:14', NULL),
(288, 'en', 'client_feedback', 'Client Feedback', '2025-05-01 02:37:14', '2025-05-01 02:37:14', NULL),
(289, 'en', 'custom_product_section', 'Custom Product Section', '2025-05-01 02:37:14', '2025-05-01 02:37:14', NULL),
(290, 'en', 'login__registration', 'Login & Registration', '2025-05-01 02:39:09', '2025-05-01 02:39:09', NULL),
(291, 'en', 'customer_registration', 'Customer Registration', '2025-05-01 02:39:09', '2025-05-01 02:39:09', NULL),
(292, 'en', 'email_required', 'Email Required', '2025-05-01 02:39:09', '2025-05-01 02:39:09', NULL),
(293, 'en', 'email__phone_both_required', 'Email & Phone Both Required', '2025-05-01 02:39:09', '2025-05-01 02:39:09', NULL),
(294, 'en', 'general_informations', 'General Informations', '2025-05-01 02:39:09', '2025-05-01 02:39:09', NULL),
(295, 'en', 'registration_verification', 'Registration Verification', '2025-05-01 02:39:09', '2025-05-01 02:39:09', NULL),
(296, 'en', 'system_title', 'System Title', '2025-05-01 02:39:09', '2025-05-01 02:39:09', NULL),
(297, 'en', 'languages', 'Languages', '2025-05-01 02:39:09', '2025-05-01 02:39:09', NULL),
(298, 'en', 'disable', 'Disable', '2025-05-01 02:39:09', '2025-05-01 02:39:09', NULL),
(299, 'en', 'email_verification', 'Email Verification', '2025-05-01 02:39:09', '2025-05-01 02:39:09', NULL),
(300, 'en', 'invoice_fonts', 'Invoice Fonts', '2025-05-01 02:39:09', '2025-05-01 02:39:09', NULL),
(301, 'en', 'otp_verification', 'OTP Verification', '2025-05-01 02:39:09', '2025-05-01 02:39:09', NULL),
(302, 'en', 'update_invoice_fonts', 'Update Invoice Fonts', '2025-05-01 02:39:09', '2025-05-01 02:39:09', NULL),
(303, 'en', 'update_invoice_font', 'Update Invoice Font', '2025-05-01 02:39:10', '2025-05-01 02:39:10', NULL),
(304, 'en', 'google_recaptcha_v3', 'Google Recaptcha V3', '2025-05-01 02:39:10', '2025-05-01 02:39:10', NULL),
(305, 'en', 'recaptcha_site_key', 'Recaptcha Site Key', '2025-05-01 02:39:10', '2025-05-01 02:39:10', NULL),
(306, 'en', 'recaptcha_secret_key', 'Recaptcha Secret Key', '2025-05-01 02:39:10', '2025-05-01 02:39:10', NULL),
(307, 'en', 'enable_recaptcha', 'Enable Recaptcha', '2025-05-01 02:39:10', '2025-05-01 02:39:10', NULL),
(308, 'en', 'enable', 'Enable', '2025-05-01 02:39:10', '2025-05-01 02:39:10', NULL),
(309, 'en', 'save_configuration', 'Save Configuration', '2025-05-01 02:39:10', '2025-05-01 02:39:10', NULL),
(310, 'en', 'configure_general_settings', 'Configure General Settings', '2025-05-01 02:39:10', '2025-05-01 02:39:10', NULL),
(311, 'en', 'google_recaptcha', 'Google Recaptcha', '2025-05-01 02:39:10', '2025-05-01 02:39:10', NULL),
(312, 'en', 'log_out', 'Log Out', '2025-05-01 02:39:10', '2025-05-01 02:39:10', NULL),
(313, 'en', 'twilio_credentials', 'Twilio Credentials', '2025-05-01 02:39:10', '2025-05-01 02:39:10', NULL),
(314, 'en', 'twilio_sid', 'Twilio SID', '2025-05-01 02:39:10', '2025-05-01 02:39:10', NULL),
(315, 'en', 'twilio_auth_token', 'Twilio Auth Token', '2025-05-01 02:39:11', '2025-05-01 02:39:11', NULL),
(316, 'en', 'valid_twilo_number', 'Valid Twilo Number', '2025-05-01 02:39:11', '2025-05-01 02:39:11', NULL),
(317, 'en', 'active_sms_gateway', 'Active SMS Gateway', '2025-05-01 02:39:11', '2025-05-01 02:39:11', NULL),
(318, 'en', 'select_sms_gateway', 'Select SMS gateway', '2025-05-01 02:39:11', '2025-05-01 02:39:11', NULL),
(319, 'en', 'twilio', 'Twilio', '2025-05-01 02:39:11', '2025-05-01 02:39:11', NULL),
(320, 'en', 'only_customer_can_add_products_to_wishlist', 'Only customer can add products to wishlist', '2025-05-01 02:39:11', '2025-05-01 02:39:11', NULL),
(321, 'en', 'order_information', 'Order Information', '2025-05-01 02:39:12', '2025-05-01 02:39:12', NULL),
(322, 'en', 'enable_scheduled_order', 'Enable Scheduled Order', '2025-05-01 02:39:13', '2025-05-01 02:39:13', NULL),
(323, 'en', 'scheduled_order_days', 'Scheduled Order Days', '2025-05-01 02:39:13', '2025-05-01 02:39:13', NULL),
(324, 'en', 'order_code_prefix', 'Order Code Prefix', '2025-05-01 02:39:13', '2025-05-01 02:39:13', NULL),
(325, 'en', 'grostore', '#Grostore-', '2025-05-01 02:39:13', '2025-05-01 02:39:13', NULL),
(326, 'en', 'order_code_starts_from', 'Order Code Starts From', '2025-05-01 02:39:13', '2025-05-01 02:39:13', NULL),
(327, 'en', '1001', '1001', '2025-05-01 02:39:13', '2025-05-01 02:39:13', NULL),
(328, 'en', 'invoice_thank_you_message', 'Invoice Thank You Message', '2025-05-01 02:39:13', '2025-05-01 02:39:13', NULL),
(329, 'en', 'type_your_thank_you_message_for_invoice', 'Type your thank you message for invoice', '2025-05-01 02:39:13', '2025-05-01 02:39:13', NULL),
(330, 'en', 'scheduled_time_slot_list', 'Scheduled Time Slot List', '2025-05-01 02:39:13', '2025-05-01 02:39:13', NULL),
(331, 'en', 'time_slot', 'Time Slot', '2025-05-01 02:39:13', '2025-05-01 02:39:13', NULL),
(332, 'en', 'sorting_order', 'Sorting Order', '2025-05-01 02:39:13', '2025-05-01 02:39:13', NULL),
(333, 'en', 'add_new_time_slot', 'Add New Time Slot', '2025-05-01 02:39:13', '2025-05-01 02:39:13', NULL),
(334, 'en', '8am__9am', '8am - 9am', '2025-05-01 02:39:13', '2025-05-01 02:39:13', NULL),
(335, 'en', 'timeslots_with_lower_sorting_order_will_be_shown_first', 'Timeslots with lower sorting order will be shown first', '2025-05-01 02:39:14', '2025-05-01 02:39:14', NULL),
(336, 'en', 'save', 'Save', '2025-05-01 02:39:14', '2025-05-01 02:39:14', NULL),
(337, 'en', 'configure_order_settings', 'Configure Order Settings', '2025-05-01 02:39:14', '2025-05-01 02:39:14', NULL),
(338, 'en', 'time_slot_list', 'Time Slot List', '2025-05-01 02:39:14', '2025-05-01 02:39:14', NULL),
(339, 'en', 'support_categories', 'Support Categories', '2025-05-01 02:39:14', '2025-05-01 02:39:14', NULL),
(340, 'en', 'payment_methods_settings', 'Payment Methods Settings', '2025-05-01 02:39:14', '2025-05-01 02:39:14', NULL),
(341, 'en', 'social_login_configurations', 'Social Login Configurations', '2025-05-01 02:39:14', '2025-05-01 02:39:14', NULL),
(342, 'en', 'google_login', 'Google Login', '2025-05-01 02:39:15', '2025-05-01 02:39:15', NULL),
(343, 'en', 'google_client_id', 'Google Client ID', '2025-05-01 02:39:15', '2025-05-01 02:39:15', NULL),
(344, 'en', 'paypal_configuration', 'Paypal Configuration', '2025-05-01 02:39:15', '2025-05-01 02:39:15', NULL),
(345, 'en', 'google_client_secret', 'Google Client Secret', '2025-05-01 02:39:15', '2025-05-01 02:39:15', NULL),
(346, 'en', 'paypal_client_id', 'Paypal Client ID', '2025-05-01 02:39:15', '2025-05-01 02:39:15', NULL),
(347, 'en', 'is_active', 'Is Active?', '2025-05-01 02:39:15', '2025-05-01 02:39:15', NULL),
(348, 'en', 'paypal_client_secret', 'Paypal Client Secret', '2025-05-01 02:39:15', '2025-05-01 02:39:15', NULL),
(349, 'en', 'facebook_login', 'Facebook Login', '2025-05-01 02:39:15', '2025-05-01 02:39:15', NULL),
(350, 'en', 'facebook_app_id', 'Facebook App ID', '2025-05-01 02:39:15', '2025-05-01 02:39:15', NULL),
(351, 'en', 'enable_paypal', 'Enable Paypal', '2025-05-01 02:39:15', '2025-05-01 02:39:15', NULL),
(352, 'en', 'gateway', 'Gateway', '2025-05-01 02:39:15', '2025-05-01 02:39:15', NULL),
(353, 'en', 'sandbox', 'Sandbox', '2025-05-01 02:39:15', '2025-05-01 02:39:15', NULL),
(354, 'en', 'live', 'Live', '2025-05-01 02:39:15', '2025-05-01 02:39:15', NULL),
(355, 'en', 'mercadopago_configuration', 'Mercadopago Configuration', '2025-05-01 02:39:16', '2025-05-01 02:39:16', NULL),
(356, 'en', 'mercadopago_secret_key', 'Mercadopago Secret Key', '2025-05-01 02:39:16', '2025-05-01 02:39:16', NULL),
(357, 'en', 'enable_mercadopago', 'Enable Mercadopago', '2025-05-01 02:39:16', '2025-05-01 02:39:16', NULL),
(358, 'en', 'enable_test_sandbox_mode', 'Enable Test Sandbox Mode', '2025-05-01 02:39:16', '2025-05-01 02:39:16', NULL),
(359, 'en', 'stripe_configuration', 'Stripe Configuration', '2025-05-01 02:39:16', '2025-05-01 02:39:16', NULL),
(360, 'en', 'publishable_key', 'Publishable Key', '2025-05-01 02:39:16', '2025-05-01 02:39:16', NULL),
(361, 'en', 'stripe_secret', 'Stripe Secret', '2025-05-01 02:39:16', '2025-05-01 02:39:16', NULL),
(362, 'en', 'enable_stripe', 'Enable Stripe', '2025-05-01 02:39:16', '2025-05-01 02:39:16', NULL),
(363, 'en', 'paytm_configuration', 'PayTm Configuration', '2025-05-01 02:39:17', '2025-05-01 02:39:17', NULL),
(364, 'en', 'currencies', 'Currencies', '2025-05-01 02:39:17', '2025-05-01 02:39:17', NULL),
(365, 'en', 'paytm_environment', 'PayTm Environment', '2025-05-01 02:39:17', '2025-05-01 02:39:17', NULL),
(366, 'en', 'paytm_merchant_id', 'PayTm Merchant ID', '2025-05-01 02:39:17', '2025-05-01 02:39:17', NULL),
(367, 'en', 'paytm_merchant_key', 'PayTm Merchant Key', '2025-05-01 02:39:17', '2025-05-01 02:39:17', NULL),
(368, 'en', 'name', 'Name', '2025-05-01 02:39:17', '2025-05-01 02:39:17', NULL),
(369, 'en', 'symbol', 'Symbol', '2025-05-01 02:39:17', '2025-05-01 02:39:17', NULL),
(370, 'en', 'paytm_merchant_website', 'PayTm Merchant Website', '2025-05-01 02:39:17', '2025-05-01 02:39:17', NULL),
(371, 'en', 'code', 'Code', '2025-05-01 02:39:17', '2025-05-01 02:39:17', NULL),
(372, 'en', 'alignment', 'Alignment', '2025-05-01 02:39:17', '2025-05-01 02:39:17', NULL),
(373, 'en', '1_usd__', '1 USD = ?', '2025-05-01 02:39:17', '2025-05-01 02:39:17', NULL),
(374, 'en', 'active', 'Active', '2025-05-01 02:39:18', '2025-05-01 02:39:18', NULL),
(375, 'en', 'symbolamount', '[symbol][amount]', '2025-05-01 02:39:18', '2025-05-01 02:39:18', NULL),
(376, 'en', 'iso_6391_code', 'ISO 639-1 Code', '2025-05-01 02:39:18', '2025-05-01 02:39:18', NULL),
(377, 'en', 'add_new_currency', 'Add New Currency', '2025-05-01 02:39:18', '2025-05-01 02:39:18', NULL),
(378, 'en', 'currency_name', 'Currency Name', '2025-05-01 02:39:18', '2025-05-01 02:39:18', NULL),
(379, 'en', 'localizations', 'Localizations', '2025-05-01 02:39:18', '2025-05-01 02:39:18', NULL),
(380, 'en', 'add_new_language', 'Add New Language', '2025-05-01 02:39:18', '2025-05-01 02:39:18', NULL),
(381, 'en', 'language_name', 'Language Name', '2025-05-01 02:39:18', '2025-05-01 02:39:18', NULL),
(382, 'en', 'type_language_name', 'Type language name', '2025-05-01 02:39:18', '2025-05-01 02:39:18', NULL),
(383, 'en', 'update_system', 'Update System', '2025-05-01 02:39:18', '2025-05-01 02:39:18', NULL),
(384, 'en', 'enbn', 'en/bn', '2025-05-01 02:39:18', '2025-05-01 02:39:18', NULL),
(385, 'en', 'update_your_application', 'Update Your Application', '2025-05-01 02:39:18', '2025-05-01 02:39:18', NULL),
(386, 'en', 'upload_font_required_to_show_invoice_pdf_in_selected_language', 'Upload Font (Required to show invoice pdf in selected language)', '2025-05-01 02:39:18', '2025-05-01 02:39:18', NULL),
(387, 'en', 'flag', 'Flag', '2025-05-01 02:39:18', '2025-05-01 02:39:18', NULL),
(388, 'en', 'rtl', 'RTL', '2025-05-01 02:39:19', '2025-05-01 02:39:19', NULL),
(389, 'en', 'save_language', 'Save Language', '2025-05-01 02:39:19', '2025-05-01 02:39:19', NULL),
(390, 'en', 'set_default_language', 'Set Default Language', '2025-05-01 02:39:19', '2025-05-01 02:39:19', NULL),
(391, 'en', 'default_language', 'Default Language', '2025-05-01 02:39:19', '2025-05-01 02:39:19', NULL),
(392, 'en', 'language_information', 'Language Information', '2025-05-01 02:39:19', '2025-05-01 02:39:19', NULL),
(393, 'en', 'all_languages', 'All Languages', '2025-05-01 02:39:19', '2025-05-01 02:39:19', NULL),
(394, 'en', 'basic_information', 'Basic Information', '2025-05-01 02:42:04', '2025-05-01 02:42:04', NULL),
(395, 'en', 'type_your_name', 'Type your name', '2025-05-01 02:42:04', '2025-05-01 02:42:04', NULL),
(396, 'en', 'type_your_email', 'Type your email', '2025-05-01 02:42:04', '2025-05-01 02:42:04', NULL),
(397, 'en', 'type_your_phone', 'Type your phone', '2025-05-01 02:42:04', '2025-05-01 02:42:04', NULL),
(398, 'en', 'avatar', 'Avatar', '2025-05-01 02:42:04', '2025-05-01 02:42:04', NULL),
(399, 'en', 'choose_avatar', 'Choose Avatar', '2025-05-01 02:42:04', '2025-05-01 02:42:04', NULL),
(400, 'en', 'type_password', 'Type password', '2025-05-01 02:42:04', '2025-05-01 02:42:04', NULL),
(401, 'en', 'confirm_password', 'Confirm Password', '2025-05-01 02:42:05', '2025-05-01 02:42:05', NULL),
(402, 'en', 'retype_password', 'Re-type password', '2025-05-01 02:42:05', '2025-05-01 02:42:05', NULL),
(403, 'en', 'save_changes', 'Save Changes', '2025-05-01 02:42:05', '2025-05-01 02:42:05', NULL),
(404, 'en', 'user_information', 'User Information', '2025-05-01 02:42:05', '2025-05-01 02:42:05', NULL),
(405, 'en', 'profile_has_been_updated', 'Profile has been updated', '2025-05-01 02:42:47', '2025-05-01 02:42:47', NULL),
(406, 'en', 'link_text', 'Link Text', '2025-05-01 02:43:07', '2025-05-01 02:43:07', NULL),
(407, 'en', 'banner_image', 'Banner Image', '2025-05-01 02:43:07', '2025-05-01 02:43:07', NULL),
(408, 'en', 'choose_banner_image', 'Choose Banner Image', '2025-05-01 02:43:07', '2025-05-01 02:43:07', NULL),
(409, 'en', 'counter_one', 'Counter One', '2025-05-01 02:43:07', '2025-05-01 02:43:07', NULL),
(410, 'en', 'counter_one_text', 'Counter One Text', '2025-05-01 02:43:07', '2025-05-01 02:43:07', NULL),
(411, 'en', 'tons_of_meat_every_month', 'Tons of Meat Every Month', '2025-05-01 02:43:07', '2025-05-01 02:43:07', NULL),
(412, 'en', 'counter_two', 'Counter Two', '2025-05-01 02:43:07', '2025-05-01 02:43:07', NULL),
(413, 'en', 'counter_two_text', 'Counter Two Text', '2025-05-01 02:43:07', '2025-05-01 02:43:07', NULL),
(414, 'en', 'features', 'Features', '2025-05-01 02:43:08', '2025-05-01 02:43:08', NULL),
(415, 'en', 'popular_products', 'Popular Products', '2025-05-01 02:43:08', '2025-05-01 02:43:08', NULL),
(416, 'en', 'why_choose_us', 'Why Choose Us', '2025-05-01 02:43:08', '2025-05-01 02:43:08', NULL),
(417, 'en', 'on_sale_products', 'On Sale Products', '2025-05-01 02:43:08', '2025-05-01 02:43:08', NULL),
(418, 'en', 'news_and_blogs', 'News And Blogs', '2025-05-01 02:43:08', '2025-05-01 02:43:08', NULL),
(419, 'en', 'theme_settings', 'Theme Settings', '2025-05-01 02:43:41', '2025-05-01 02:43:41', NULL),
(420, 'en', 'theme_name_1', 'Theme Name 1', '2025-05-01 02:43:41', '2025-05-01 02:43:41', NULL),
(421, 'en', 'theme_name_2', 'Theme Name 2', '2025-05-01 02:43:41', '2025-05-01 02:43:41', NULL),
(422, 'en', 'theme_name_3', 'Theme Name 3', '2025-05-01 02:43:41', '2025-05-01 02:43:41', NULL),
(423, 'en', 'select_active_theme', 'Select Active Theme', '2025-05-01 02:43:41', '2025-05-01 02:43:41', NULL),
(424, 'en', 'general_information', 'General Information', '2025-05-01 02:43:41', '2025-05-01 02:43:41', NULL),
(425, 'en', 'website_footer_configuration', 'Website Footer Configuration', '2025-05-01 02:43:42', '2025-05-01 02:43:42', NULL),
(426, 'en', 'select_categories', 'Select categories', '2025-05-01 02:43:42', '2025-05-01 02:43:42', NULL),
(427, 'en', 'select_quick_link_pages', 'Select quick link pages', '2025-05-01 02:43:42', '2025-05-01 02:43:42', NULL),
(428, 'en', 'copyright_text', 'Copyright Text', '2025-05-01 02:43:42', '2025-05-01 02:43:42', NULL),
(429, 'en', 'images', 'Images', '2025-05-01 02:43:42', '2025-05-01 02:43:42', NULL),
(430, 'en', 'footer_logo', 'Footer Logo', '2025-05-01 02:43:42', '2025-05-01 02:43:42', NULL),
(431, 'en', 'choose_footer_logo', 'Choose Footer Logo', '2025-05-01 02:43:42', '2025-05-01 02:43:42', NULL),
(432, 'en', 'accepted_payment', 'Accepted Payment', '2025-05-01 02:43:42', '2025-05-01 02:43:42', NULL),
(433, 'en', 'choose_accepted_payment_banner', 'Choose Accepted Payment Banner', '2025-05-01 02:43:42', '2025-05-01 02:43:42', NULL),
(434, 'en', 'footer_configuration', 'Footer Configuration', '2025-05-01 02:43:42', '2025-05-01 02:43:42', NULL),
(435, 'en', 'intro_section', 'Intro Section', '2025-05-01 02:43:43', '2025-05-01 02:43:43', NULL),
(436, 'en', 'mission', 'Mission', '2025-05-01 02:43:43', '2025-05-01 02:43:43', NULL),
(437, 'en', 'vision', 'Vision', '2025-05-01 02:43:44', '2025-05-01 02:43:44', NULL),
(438, 'en', 'quote', 'Quote', '2025-05-01 02:43:44', '2025-05-01 02:43:44', NULL),
(439, 'en', 'quote_by', 'Quote By', '2025-05-01 02:43:44', '2025-05-01 02:43:44', NULL),
(440, 'en', 'type_name_of_the_user', 'Type name of the user', '2025-05-01 02:43:44', '2025-05-01 02:43:44', NULL),
(441, 'en', 'about_us_configuration', 'About Us Configuration', '2025-05-01 02:43:44', '2025-05-01 02:43:44', NULL),
(442, 'en', 'popular_brands', 'Popular Brands', '2025-05-01 02:43:44', '2025-05-01 02:43:44', NULL),
(443, 'en', 'features_section', 'Features Section', '2025-05-01 02:43:44', '2025-05-01 02:43:44', NULL),
(444, 'en', 'product_page_configuration', 'Product Page Configuration', '2025-05-01 02:43:44', '2025-05-01 02:43:44', NULL),
(445, 'en', 'product_details_widget', 'Product Details Widget', '2025-05-01 02:43:44', '2025-05-01 02:43:44', NULL),
(446, 'en', 'add_new_widget', 'Add New Widget', '2025-05-01 02:43:44', '2025-05-01 02:43:44', NULL),
(447, 'en', 'icon', 'Icon', '2025-05-01 02:43:44', '2025-05-01 02:43:44', NULL),
(448, 'en', 'choose_icon_image', 'Choose Icon Image', '2025-05-01 02:43:44', '2025-05-01 02:43:44', NULL),
(449, 'en', 'save_widget', 'Save Widget', '2025-05-01 02:43:44', '2025-05-01 02:43:44', NULL),
(450, 'en', 'website_header_configuration', 'Website Header Configuration', '2025-05-01 02:43:44', '2025-05-01 02:43:44', NULL),
(451, 'en', 'add_promotional_banner', 'Add Promotional Banner', '2025-05-01 02:43:44', '2025-05-01 02:43:44', NULL),
(452, 'en', 'topbar_information', 'Topbar Information', '2025-05-01 02:43:44', '2025-05-01 02:43:44', NULL),
(453, 'en', 'welcome_text', 'Welcome Text', '2025-05-01 02:43:44', '2025-05-01 02:43:44', NULL),
(454, 'en', 'type_link', 'Type link', '2025-05-01 02:43:44', '2025-05-01 02:43:44', NULL),
(455, 'en', 'promotional_banner', 'Promotional Banner', '2025-05-01 02:43:44', '2025-05-01 02:43:44', NULL),
(456, 'en', 'welcome_to_our_organic_store', 'Welcome to our organic store', '2025-05-01 02:43:44', '2025-05-01 02:43:44', NULL),
(457, 'en', 'choose_promotional_banner', 'Choose Promotional Banner', '2025-05-01 02:43:44', '2025-05-01 02:43:44', NULL),
(458, 'en', 'topbar_email', 'Topbar Email', '2025-05-01 02:43:44', '2025-05-01 02:43:44', NULL),
(459, 'en', 'save_banner', 'Save Banner', '2025-05-01 02:43:45', '2025-05-01 02:43:45', NULL),
(460, 'en', 'grostoresupportcom', 'grostore@support.com', '2025-05-01 02:43:45', '2025-05-01 02:43:45', NULL),
(461, 'en', 'product_details_page', 'Product Details Page', '2025-05-01 02:43:45', '2025-05-01 02:43:45', NULL),
(462, 'en', 'topbar_location', 'Topbar Location', '2025-05-01 02:43:45', '2025-05-01 02:43:45', NULL),
(463, 'en', 'widgets', 'Widgets', '2025-05-01 02:43:45', '2025-05-01 02:43:45', NULL),
(464, 'en', 'washington_new_york_usa__254230', 'Washington, New York, USA - 254230', '2025-05-01 02:43:45', '2025-05-01 02:43:45', NULL),
(465, 'en', 'products_listing', 'Products Listing', '2025-05-01 02:43:45', '2025-05-01 02:43:45', NULL),
(466, 'en', 'settings_updated_successfully', 'Settings updated successfully', '2025-05-01 02:45:17', '2025-05-01 02:45:17', NULL),
(467, 'en', 'facebook_link', 'Facebook Link', '2025-05-01 02:45:34', '2025-05-01 02:45:34', NULL),
(468, 'en', 'twitter_link', 'Twitter Link', '2025-05-01 02:45:34', '2025-05-01 02:45:34', NULL),
(469, 'en', 'linkedin_link', 'LinkedIn Link', '2025-05-01 02:45:34', '2025-05-01 02:45:34', NULL),
(470, 'en', 'youtube_link', 'Youtube Link', '2025-05-01 02:45:34', '2025-05-01 02:45:34', NULL),
(471, 'en', 'navbar_information', 'Navbar Information', '2025-05-01 02:45:34', '2025-05-01 02:45:34', NULL),
(472, 'en', 'navbar_logo', 'Navbar Logo', '2025-05-01 02:45:34', '2025-05-01 02:45:34', NULL),
(473, 'en', 'choose_navbar_logo', 'Choose Navbar Logo', '2025-05-01 02:45:34', '2025-05-01 02:45:34', NULL),
(474, 'en', 'show_categories', 'Show Categories?', '2025-05-01 02:45:34', '2025-05-01 02:45:34', NULL),
(475, 'en', 'active_themes', 'Active Themes', '2025-05-01 02:45:34', '2025-05-01 02:45:34', NULL),
(476, 'en', 'show_theme_changes', 'Show Theme Changes?', '2025-05-01 02:45:34', '2025-05-01 02:45:34', NULL),
(477, 'en', 'select_themes', 'Select themes', '2025-05-01 02:45:34', '2025-05-01 02:45:34', NULL),
(478, 'en', 'halal_food', 'Halal Food', '2025-05-01 02:45:34', '2025-05-01 02:45:34', NULL),
(479, 'en', 'header_nav_menu', 'Header Nav Menu', '2025-05-01 02:45:34', '2025-05-01 02:45:34', NULL),
(480, 'en', 'menu_label', 'Menu label', '2025-05-01 02:45:34', '2025-05-01 02:45:34', NULL),
(481, 'en', 'add_new', 'Add New', '2025-05-01 02:45:34', '2025-05-01 02:45:34', NULL),
(482, 'en', 'show_pages', 'Show Pages?', '2025-05-01 02:45:34', '2025-05-01 02:45:34', NULL),
(483, 'en', 'select_pages', 'Select pages', '2025-05-01 02:45:34', '2025-05-01 02:45:34', NULL),
(484, 'en', 'contact_number', 'Contact Number', '2025-05-01 02:45:34', '2025-05-01 02:45:34', NULL),
(485, 'en', 'header_configuration', 'Header Configuration', '2025-05-01 02:45:34', '2025-05-01 02:45:34', NULL),
(486, 'en', 'browser_tab_title_separator', 'Browser Tab Title Separator', '2025-05-01 02:47:59', '2025-05-01 02:47:59', NULL),
(487, 'en', 'address', 'Address', '2025-05-01 02:47:59', '2025-05-01 02:47:59', NULL),
(488, 'en', 'dashboard_logo__favicon', 'Dashboard Logo & Favicon', '2025-05-01 02:47:59', '2025-05-01 02:47:59', NULL),
(489, 'en', 'dashboard_logo', 'Dashboard Logo', '2025-05-01 02:47:59', '2025-05-01 02:47:59', NULL),
(490, 'en', 'choose_dashboard_logo', 'Choose Dashboard Logo', '2025-05-01 02:47:59', '2025-05-01 02:47:59', NULL),
(491, 'en', 'favicon', 'Favicon', '2025-05-01 02:47:59', '2025-05-01 02:47:59', NULL),
(492, 'en', 'choose_favicon', 'Choose Favicon', '2025-05-01 02:47:59', '2025-05-01 02:47:59', NULL),
(493, 'en', 'maintenance_mode', 'Maintenance Mode', '2025-05-01 02:47:59', '2025-05-01 02:47:59', NULL),
(494, 'en', 'enable_maintenance_mode', 'Enable Maintenance Mode', '2025-05-01 02:47:59', '2025-05-01 02:47:59', NULL),
(495, 'en', 'set_maintenance_mode', 'Set maintenance mode', '2025-05-01 02:47:59', '2025-05-01 02:47:59', NULL),
(496, 'en', 'seo_meta_configuration', 'SEO Meta Configuration', '2025-05-01 02:47:59', '2025-05-01 02:47:59', NULL),
(497, 'en', 'meta_title', 'Meta Title', '2025-05-01 02:47:59', '2025-05-01 02:47:59', NULL),
(498, 'en', 'type_meta_title', 'Type meta title', '2025-05-01 02:47:59', '2025-05-01 02:47:59', NULL),
(499, 'en', 'set_a_meta_tag_title_recommended_to_be_simple_and_unique', 'Set a meta tag title. Recommended to be simple and unique.', '2025-05-01 02:47:59', '2025-05-01 02:47:59', NULL);
INSERT INTO `localizations` (`id`, `lang_key`, `t_key`, `t_value`, `created_at`, `updated_at`, `deleted_at`) VALUES
(500, 'en', 'meta_description', 'Meta Description', '2025-05-01 02:47:59', '2025-05-01 02:47:59', NULL),
(501, 'en', 'type_your_meta_description', 'Type your meta description', '2025-05-01 02:47:59', '2025-05-01 02:47:59', NULL),
(502, 'en', 'meta_keywords', 'Meta Keywords', '2025-05-01 02:47:59', '2025-05-01 02:47:59', NULL),
(503, 'en', 'meta_image', 'Meta Image', '2025-05-01 02:47:59', '2025-05-01 02:47:59', NULL),
(504, 'en', 'choose_meta_image', 'Choose Meta Image', '2025-05-01 02:47:59', '2025-05-01 02:47:59', NULL),
(505, 'en', 'preloader_configuration', 'Preloader Configuration', '2025-05-01 02:48:00', '2025-05-01 02:48:00', NULL),
(506, 'en', 'enable_preloader', 'Enable Preloader', '2025-05-01 02:48:00', '2025-05-01 02:48:00', NULL),
(507, 'en', 'set_preloader_status', 'Set preloader status', '2025-05-01 02:48:00', '2025-05-01 02:48:00', NULL),
(508, 'en', 'admin_panel_preloader', 'Admin Panel Preloader', '2025-05-01 02:48:00', '2025-05-01 02:48:00', NULL),
(509, 'en', 'choose_admin_preloader', 'Choose Admin Preloader', '2025-05-01 02:48:00', '2025-05-01 02:48:00', NULL),
(510, 'en', 'frontend_preloader', 'Frontend Preloader', '2025-05-01 02:48:00', '2025-05-01 02:48:00', NULL),
(511, 'en', 'choose_frontend_preloader', 'Choose Frontend Preloader', '2025-05-01 02:48:00', '2025-05-01 02:48:00', NULL),
(512, 'en', 'pagination', 'Pagination', '2025-05-01 02:48:00', '2025-05-01 02:48:00', NULL),
(513, 'en', 'paginate_per_page', 'Paginate Per Page', '2025-05-01 02:48:00', '2025-05-01 02:48:00', NULL),
(514, 'en', 'tips_for_deliveryman', 'Tips For Deliveryman', '2025-05-01 02:48:00', '2025-05-01 02:48:00', NULL),
(515, 'en', 'enable_tips_for_deliveryman', 'Enable Tips For Deliveryman', '2025-05-01 02:48:00', '2025-05-01 02:48:00', NULL),
(516, 'en', 'set_delivery_tips_status', 'Set Delivery Tips Status', '2025-05-01 02:48:00', '2025-05-01 02:48:00', NULL),
(517, 'en', 'custom_css', 'Custom Css', '2025-05-01 02:48:00', '2025-05-01 02:48:00', NULL),
(518, 'en', 'admin_dashboard_custom_css__before_head', 'Admin Dashboard Custom css - before </head>', '2025-05-01 02:48:00', '2025-05-01 02:48:00', NULL),
(519, 'en', 'copy_or_write_your_custom_css_here', 'Copy or write your custom css here', '2025-05-01 02:48:00', '2025-05-01 02:48:00', NULL),
(520, 'en', 'frontend_custom_css__before_head', 'Frontend Custom css - before </head>', '2025-05-01 02:48:00', '2025-05-01 02:48:00', NULL),
(521, 'en', 'dashborad_logo__favicon', 'Dashborad Logo & Favicon', '2025-05-01 02:48:00', '2025-05-01 02:48:00', NULL),
(522, 'en', 'seo_configuration', 'SEO Configuration', '2025-05-01 02:48:00', '2025-05-01 02:48:00', NULL),
(523, 'en', 'pagination_configuration', 'Pagination Configuration', '2025-05-01 02:48:00', '2025-05-01 02:48:00', NULL),
(524, 'en', 'add_campaign', 'Add Campaign', '2025-05-01 03:04:35', '2025-05-01 03:04:35', NULL),
(525, 'en', 'start_date', 'Start Date', '2025-05-01 03:04:35', '2025-05-01 03:04:35', NULL),
(526, 'en', 'end_date', 'End Date', '2025-05-01 03:04:35', '2025-05-01 03:04:35', NULL),
(527, 'en', 'published', 'Published', '2025-05-01 03:04:35', '2025-05-01 03:04:35', NULL),
(528, 'en', 'status_updated_successfully', 'Status updated successfully', '2025-05-01 03:04:36', '2025-05-01 03:04:36', NULL),
(529, 'en', 'something_went_wrong', 'Something went wrong', '2025-05-01 03:04:36', '2025-05-01 03:04:36', NULL),
(530, 'en', 'your_system_optimization_successfully_complete', 'Your System Optimization Successfully Complete', '2025-05-01 03:45:45', '2025-05-01 03:45:45', NULL),
(531, 'en', 'your_system_log_file_is_cleared', 'Your System Log File Is Cleared', '2025-05-01 03:45:55', '2025-05-01 03:45:55', NULL),
(532, 'en', 'debug_mode_enable_successfully', 'Debug Mode Enable Successfully', '2025-05-01 03:46:01', '2025-05-01 03:46:01', NULL),
(533, 'en', 'type_currency_name', 'Type currency name', '2025-05-01 03:55:56', '2025-05-01 03:55:56', NULL),
(534, 'en', 'currency_symbol', 'Currency Symbol', '2025-05-01 03:55:56', '2025-05-01 03:55:56', NULL),
(535, 'en', 'type_symbol', 'Type symbol', '2025-05-01 03:55:56', '2025-05-01 03:55:56', NULL),
(536, 'en', 'currency_code', 'Currency Code', '2025-05-01 03:55:57', '2025-05-01 03:55:57', NULL),
(537, 'en', 'type_code', 'Type code', '2025-05-01 03:55:57', '2025-05-01 03:55:57', NULL),
(538, 'en', 'rate', 'Rate', '2025-05-01 03:55:57', '2025-05-01 03:55:57', NULL),
(539, 'en', 'amountsymbol', '[amount][symbol]', '2025-05-01 03:55:57', '2025-05-01 03:55:57', NULL),
(540, 'en', 'symbol_amount', '[symbol] [amount]', '2025-05-01 03:55:57', '2025-05-01 03:55:57', NULL),
(541, 'en', 'amount_symbol', '[amount] [symbol]', '2025-05-01 03:55:57', '2025-05-01 03:55:57', NULL),
(542, 'en', 'save_currency', 'Save Currency', '2025-05-01 03:55:57', '2025-05-01 03:55:57', NULL),
(543, 'en', 'set_default_currency', 'Set Default Currency', '2025-05-01 03:55:57', '2025-05-01 03:55:57', NULL),
(544, 'en', 'default_currency', 'Default Currency', '2025-05-01 03:55:57', '2025-05-01 03:55:57', NULL),
(545, 'en', 'no_of_decimals', 'No of Decimals', '2025-05-01 03:55:57', '2025-05-01 03:55:57', NULL),
(546, 'en', 'price_format', 'Price Format', '2025-05-01 03:55:57', '2025-05-01 03:55:57', NULL),
(547, 'en', 'show_full_price_1000000', 'Show Full Price (1000000)', '2025-05-01 03:55:57', '2025-05-01 03:55:57', NULL),
(548, 'en', 'truncate_price_1m1b', 'Truncate Price (1M/1B)', '2025-05-01 03:55:57', '2025-05-01 03:55:57', NULL),
(549, 'en', 'save_configurations', 'Save Configurations', '2025-05-01 03:55:57', '2025-05-01 03:55:57', NULL),
(550, 'en', 'currency_information', 'Currency Information', '2025-05-01 03:55:57', '2025-05-01 03:55:57', NULL),
(551, 'en', 'all_currencies', 'All Currencies', '2025-05-01 03:55:57', '2025-05-01 03:55:57', NULL),
(552, 'en', 'currency_configurations', 'Currency Configurations', '2025-05-01 03:55:57', '2025-05-01 03:55:57', NULL),
(553, 'en', 'default_currency_can_not_be_disabled', 'Default currency can not be disabled', '2025-05-01 03:55:58', '2025-05-01 03:55:58', NULL),
(554, 'en', 'currency_has_been_inserted_successfully', 'Currency has been inserted successfully', '2025-05-01 03:56:57', '2025-05-01 03:56:57', NULL),
(555, 'en', 'update_currency', 'Update Currency', '2025-05-01 03:57:34', '2025-05-01 03:57:34', NULL),
(556, 'en', 'currency_has_been_updated_successfully', 'Currency has been updated successfully', '2025-05-01 03:57:46', '2025-05-01 03:57:46', NULL),
(557, 'en', 'export', 'Export', '2025-05-01 04:00:08', '2025-05-01 04:00:08', NULL),
(558, 'en', 'import', 'Import', '2025-05-01 04:00:08', '2025-05-01 04:00:08', NULL),
(559, 'en', 'select_brand', 'Select Brand', '2025-05-01 04:00:08', '2025-05-01 04:00:08', NULL),
(560, 'en', 'select_status', 'Select Status', '2025-05-01 04:00:08', '2025-05-01 04:00:08', NULL),
(561, 'en', 'hidden', 'Hidden', '2025-05-01 04:00:08', '2025-05-01 04:00:08', NULL),
(562, 'en', 'product_name', 'Product Name', '2025-05-01 04:00:08', '2025-05-01 04:00:08', NULL),
(563, 'en', 'brand', 'Brand', '2025-05-01 04:00:08', '2025-05-01 04:00:08', NULL),
(564, 'en', 'price', 'Price', '2025-05-01 04:00:08', '2025-05-01 04:00:08', NULL),
(565, 'en', 'import_products', 'Import Products', '2025-05-01 04:00:08', '2025-05-01 04:00:08', NULL),
(566, 'en', 'import_file', 'Import File', '2025-05-01 04:00:08', '2025-05-01 04:00:08', NULL),
(567, 'en', 'sample_file', 'Sample File', '2025-05-01 04:00:08', '2025-05-01 04:00:08', NULL),
(568, 'en', 'close', 'Close', '2025-05-01 04:00:08', '2025-05-01 04:00:08', NULL),
(569, 'en', 'add_category', 'Add Category', '2025-05-01 04:00:16', '2025-05-01 04:00:16', NULL),
(570, 'en', 'category_name', 'Category Name', '2025-05-01 04:00:16', '2025-05-01 04:00:16', NULL),
(571, 'en', 'base_category', 'Base Category', '2025-05-01 04:00:16', '2025-05-01 04:00:16', NULL),
(572, 'en', 'brands', 'Brands', '2025-05-01 04:00:16', '2025-05-01 04:00:16', NULL),
(573, 'en', 'theme', 'Theme', '2025-05-01 04:00:16', '2025-05-01 04:00:16', NULL),
(574, 'en', 'add_new_category', 'Add New Category', '2025-05-01 04:00:23', '2025-05-01 04:00:23', NULL),
(575, 'en', 'type_your_category_name', 'Type your category name', '2025-05-01 04:00:23', '2025-05-01 04:00:23', NULL),
(576, 'en', 'category_description', 'Category Description', '2025-05-01 04:00:23', '2025-05-01 04:00:23', NULL),
(577, 'en', 'type_your_category_description', 'Type your category description', '2025-05-01 04:00:23', '2025-05-01 04:00:23', NULL),
(578, 'en', 'select_brands', 'Select brands', '2025-05-01 04:00:23', '2025-05-01 04:00:23', NULL),
(579, 'en', 'sorting_priority_number', 'Sorting Priority Number', '2025-05-01 04:00:23', '2025-05-01 04:00:23', NULL),
(580, 'en', 'type_sorting_priority_number', 'Type sorting priority number', '2025-05-01 04:00:23', '2025-05-01 04:00:23', NULL),
(581, 'en', 'thumbnail', 'Thumbnail', '2025-05-01 04:00:23', '2025-05-01 04:00:23', NULL),
(582, 'en', 'choose_category_thumbnail', 'Choose Category Thumbnail', '2025-05-01 04:00:23', '2025-05-01 04:00:23', NULL),
(583, 'en', 'save_category', 'Save Category', '2025-05-01 04:00:23', '2025-05-01 04:00:23', NULL),
(584, 'en', 'category_information', 'Category Information', '2025-05-01 04:00:23', '2025-05-01 04:00:23', NULL),
(585, 'en', 'category_image', 'Category Image', '2025-05-01 04:00:23', '2025-05-01 04:00:23', NULL),
(586, 'en', 'seo_meta_options', 'SEO Meta Options', '2025-05-01 04:00:24', '2025-05-01 04:00:24', NULL),
(587, 'en', 'type_your_product_name', 'Type your product name', '2025-05-01 05:41:36', '2025-05-01 05:41:36', NULL),
(588, 'en', 'product_name_is_required_and_recommended_to_be_unique', 'Product name is required and recommended to be unique.', '2025-05-01 05:41:37', '2025-05-01 05:41:37', NULL),
(589, 'en', 'short_description', 'Short Description', '2025-05-01 05:41:37', '2025-05-01 05:41:37', NULL),
(590, 'en', 'type_your_product_short_description', 'Type your product short description', '2025-05-01 05:41:37', '2025-05-01 05:41:37', NULL),
(591, 'en', 'description', 'Description', '2025-05-01 05:41:37', '2025-05-01 05:41:37', NULL),
(592, 'en', 'choose_product_thumbnail', 'Choose Product Thumbnail', '2025-05-01 05:41:37', '2025-05-01 05:41:37', NULL),
(593, 'en', 'gallery', 'Gallery', '2025-05-01 05:41:37', '2025-05-01 05:41:37', NULL),
(594, 'en', 'choose_gallery_images', 'Choose Gallery Images', '2025-05-01 05:41:37', '2025-05-01 05:41:37', NULL),
(595, 'en', 'product_youtube_vedio_embeded_code', 'Product Youtube Vedio Embeded Code', '2025-05-01 05:41:37', '2025-05-01 05:41:37', NULL),
(596, 'en', 'product_categories', 'Product Categories', '2025-05-01 05:41:37', '2025-05-01 05:41:37', NULL),
(597, 'en', 'product_tags', 'Product Tags', '2025-05-01 05:41:37', '2025-05-01 05:41:37', NULL),
(598, 'en', 'select_tags', 'Select tags..', '2025-05-01 05:41:37', '2025-05-01 05:41:37', NULL),
(599, 'en', 'product_brand', 'Product Brand', '2025-05-01 05:41:37', '2025-05-01 05:41:37', NULL),
(600, 'en', 'product_unit', 'Product Unit', '2025-05-01 05:41:37', '2025-05-01 05:41:37', NULL),
(601, 'en', 'select_unit', 'Select Unit', '2025-05-01 05:41:37', '2025-05-01 05:41:37', NULL),
(602, 'en', 'price_sku__stock', 'Price, Sku & Stock', '2025-05-01 05:41:37', '2025-05-01 05:41:37', NULL),
(603, 'en', 'has_variations', 'Has Variations?', '2025-05-01 05:41:37', '2025-05-01 05:41:37', NULL),
(604, 'en', 'product_price', 'Product price', '2025-05-01 05:41:37', '2025-05-01 05:41:37', NULL),
(605, 'en', 'stock', 'Stock', '2025-05-01 05:41:37', '2025-05-01 05:41:37', NULL),
(606, 'en', 'default_location', 'Default Location', '2025-05-01 05:41:37', '2025-05-01 05:41:37', NULL),
(607, 'en', 'stock_qty', 'Stock qty', '2025-05-01 05:41:37', '2025-05-01 05:41:37', NULL),
(608, 'en', 'sku', 'SKU', '2025-05-01 05:41:37', '2025-05-01 05:41:37', NULL),
(609, 'en', 'product_sku', 'Product sku', '2025-05-01 05:41:37', '2025-05-01 05:41:37', NULL),
(610, 'en', 'product_code', 'Product code', '2025-05-01 05:41:37', '2025-05-01 05:41:37', NULL),
(611, 'en', 'product_size_guide', 'Product Size Guide', '2025-05-01 05:41:38', '2025-05-01 05:41:38', NULL),
(612, 'en', 'choose_size_guide_image', 'Choose Size Guide Image', '2025-05-01 05:41:38', '2025-05-01 05:41:38', NULL),
(613, 'en', 'product_discount', 'Product Discount', '2025-05-01 05:41:38', '2025-05-01 05:41:38', NULL),
(614, 'en', 'date_range', 'Date Range', '2025-05-01 05:41:38', '2025-05-01 05:41:38', NULL),
(615, 'en', 'start_date__end_date', 'Start date - End date', '2025-05-01 05:41:38', '2025-05-01 05:41:38', NULL),
(616, 'en', 'discount_amount', 'Discount Amount', '2025-05-01 05:41:38', '2025-05-01 05:41:38', NULL),
(617, 'en', 'type_discount_amount', 'Type discount amount', '2025-05-01 05:41:38', '2025-05-01 05:41:38', NULL),
(618, 'en', 'percent_or_fixed', 'Percent or Fixed', '2025-05-01 05:41:38', '2025-05-01 05:41:38', NULL),
(619, 'en', 'percent_', 'Percent %', '2025-05-01 05:41:38', '2025-05-01 05:41:38', NULL),
(620, 'en', 'fixed', 'Fixed', '2025-05-01 05:41:38', '2025-05-01 05:41:38', NULL),
(621, 'en', 'shipping_configuration', 'Shipping Configuration', '2025-05-01 05:41:38', '2025-05-01 05:41:38', NULL),
(622, 'en', 'minimum_purchase_qty', 'Minimum Purchase Qty', '2025-05-01 05:41:38', '2025-05-01 05:41:38', NULL),
(623, 'en', 'maximum_purchase_qty', 'Maximum Purchase Qty', '2025-05-01 05:41:38', '2025-05-01 05:41:38', NULL),
(624, 'en', 'standard_delivery_time', 'Standard Delivery Time', '2025-05-01 05:41:38', '2025-05-01 05:41:38', NULL),
(625, 'en', 'express_delivery_time', 'Express Delivery Time', '2025-05-01 05:41:38', '2025-05-01 05:41:38', NULL),
(626, 'en', 'product_taxes', 'Product Taxes', '2025-05-01 05:41:38', '2025-05-01 05:41:38', NULL),
(627, 'en', 'default_0', 'Default 0%', '2025-05-01 05:41:38', '2025-05-01 05:41:38', NULL),
(628, 'en', 'sell_target', 'Sell Target', '2025-05-01 05:41:38', '2025-05-01 05:41:38', NULL),
(629, 'en', 'type_your_sell_target', 'Type your sell target', '2025-05-01 05:41:38', '2025-05-01 05:41:38', NULL),
(630, 'en', 'product_status', 'Product Status', '2025-05-01 05:41:38', '2025-05-01 05:41:38', NULL),
(631, 'en', 'unpublished', 'Unpublished', '2025-05-01 05:41:38', '2025-05-01 05:41:38', NULL),
(632, 'en', 'save_product', 'Save Product', '2025-05-01 05:41:38', '2025-05-01 05:41:38', NULL),
(633, 'en', 'product_information', 'Product Information', '2025-05-01 05:41:38', '2025-05-01 05:41:38', NULL),
(634, 'en', 'product_images', 'Product Images', '2025-05-01 05:41:38', '2025-05-01 05:41:38', NULL),
(635, 'en', 'product_brand__unit', 'Product Brand & Unit', '2025-05-01 05:41:38', '2025-05-01 05:41:38', NULL),
(636, 'en', 'price_sku_stock__variations', 'Price, SKU, Stock & Variations', '2025-05-01 05:41:38', '2025-05-01 05:41:38', NULL),
(637, 'en', 'minimum_purchase', 'Minimum Purchase', '2025-05-01 05:41:39', '2025-05-01 05:41:39', NULL),
(638, 'en', 'sell_target_and_status', 'Sell Target and Status', '2025-05-01 05:41:39', '2025-05-01 05:41:39', NULL),
(639, 'en', 'add_new_brand', 'Add New Brand', '2025-05-01 05:42:46', '2025-05-01 05:42:46', NULL),
(640, 'en', 'brand_name', 'Brand Name', '2025-05-01 05:42:46', '2025-05-01 05:42:46', NULL),
(641, 'en', 'type_brand_name', 'Type brand name', '2025-05-01 05:42:47', '2025-05-01 05:42:47', NULL),
(642, 'en', 'brand_image', 'Brand Image', '2025-05-01 05:42:47', '2025-05-01 05:42:47', NULL),
(643, 'en', 'choose_brand_thumbnail', 'Choose Brand Thumbnail', '2025-05-01 05:42:47', '2025-05-01 05:42:47', NULL),
(644, 'en', 'save_brand', 'Save Brand', '2025-05-01 05:42:47', '2025-05-01 05:42:47', NULL),
(645, 'en', 'brand_information', 'Brand Information', '2025-05-01 05:42:47', '2025-05-01 05:42:47', NULL),
(646, 'en', 'add_brand_seo', 'Add Brand SEO', '2025-05-01 05:42:47', '2025-05-01 05:42:47', NULL),
(647, 'en', 'units', 'Units', '2025-05-01 05:42:54', '2025-05-01 05:42:54', NULL),
(648, 'en', 'add_new_unit', 'Add New Unit', '2025-05-01 05:42:54', '2025-05-01 05:42:54', NULL),
(649, 'en', 'unit_name', 'Unit Name', '2025-05-01 05:42:54', '2025-05-01 05:42:54', NULL),
(650, 'en', 'type_unit_name', 'Type unit name', '2025-05-01 05:42:54', '2025-05-01 05:42:54', NULL),
(651, 'en', 'save_unit', 'Save Unit', '2025-05-01 05:42:54', '2025-05-01 05:42:54', NULL),
(652, 'en', 'unit_information', 'Unit Information', '2025-05-01 05:42:54', '2025-05-01 05:42:54', NULL),
(653, 'en', 'taxes', 'Taxes', '2025-05-01 05:43:23', '2025-05-01 05:43:23', NULL),
(654, 'en', 'add_new_taxes', 'Add New Taxes', '2025-05-01 05:43:23', '2025-05-01 05:43:23', NULL),
(655, 'en', 'tax_name', 'Tax Name', '2025-05-01 05:43:23', '2025-05-01 05:43:23', NULL),
(656, 'en', 'type_tax_name', 'Type tax name', '2025-05-01 05:43:23', '2025-05-01 05:43:23', NULL),
(657, 'en', 'tax_information', 'Tax Information', '2025-05-01 05:43:23', '2025-05-01 05:43:23', NULL),
(658, 'en', 'add_new_tax', 'Add New Tax', '2025-05-01 05:43:23', '2025-05-01 05:43:23', NULL),
(659, 'en', 'pos', 'Pos', '2025-05-01 05:43:33', '2025-05-01 05:43:33', NULL),
(660, 'en', 'all_listed_products', 'All Listed Products', '2025-05-01 05:43:34', '2025-05-01 05:43:34', NULL),
(661, 'en', 'add_item_by_code', 'Add Item by Code', '2025-05-01 05:43:34', '2025-05-01 05:43:34', NULL),
(662, 'en', 'billing_section', 'Billing Section', '2025-05-01 05:43:34', '2025-05-01 05:43:34', NULL),
(663, 'en', 'delivered', 'Delivered', '2025-05-01 05:43:34', '2025-05-01 05:43:34', NULL),
(664, 'en', 'order_placed', 'Order Placed', '2025-05-01 05:43:34', '2025-05-01 05:43:34', NULL),
(665, 'en', 'new_order', 'New Order', '2025-05-01 05:43:34', '2025-05-01 05:43:34', NULL),
(666, 'en', 'item', 'Item', '2025-05-01 05:43:34', '2025-05-01 05:43:34', NULL),
(667, 'en', 'qty', 'Qty', '2025-05-01 05:43:34', '2025-05-01 05:43:34', NULL),
(668, 'en', 'enter_product_code', 'Enter product code', '2025-05-01 05:43:34', '2025-05-01 05:43:34', NULL),
(669, 'en', 'add_this_item', 'Add This Item', '2025-05-01 05:43:34', '2025-05-01 05:43:34', NULL),
(670, 'en', 'please_select_all_the_options', 'Please select all the options', '2025-05-01 05:43:34', '2025-05-01 05:43:34', NULL),
(671, 'en', 'smtp_configuration', 'SMTP Configuration', '2025-05-01 05:50:12', '2025-05-01 05:50:12', NULL),
(672, 'en', 'type', 'Type', '2025-05-01 05:50:12', '2025-05-01 05:50:12', NULL),
(673, 'en', 'sendmail', 'Sendmail', '2025-05-01 05:50:12', '2025-05-01 05:50:12', NULL),
(674, 'en', 'smtp', 'SMTP', '2025-05-01 05:50:12', '2025-05-01 05:50:12', NULL),
(675, 'en', 'mail_host', 'Mail Host', '2025-05-01 05:50:12', '2025-05-01 05:50:12', NULL),
(676, 'en', 'type_mail_host', 'Type mail Host', '2025-05-01 05:50:12', '2025-05-01 05:50:12', NULL),
(677, 'en', 'mail_port', 'Mail Port', '2025-05-01 05:50:12', '2025-05-01 05:50:12', NULL),
(678, 'en', 'type_mail_port', 'Type mail port', '2025-05-01 05:50:12', '2025-05-01 05:50:12', NULL),
(679, 'en', 'mail_username', 'Mail Username', '2025-05-01 05:50:12', '2025-05-01 05:50:12', NULL),
(680, 'en', 'type_mail_username', 'Type mail username', '2025-05-01 05:50:12', '2025-05-01 05:50:12', NULL),
(681, 'en', 'mail_password', 'Mail Password', '2025-05-01 05:50:12', '2025-05-01 05:50:12', NULL),
(682, 'en', 'type_mail_password', 'Type mail password', '2025-05-01 05:50:12', '2025-05-01 05:50:12', NULL),
(683, 'en', 'mail_encryption', 'Mail Encryption', '2025-05-01 05:50:12', '2025-05-01 05:50:12', NULL),
(684, 'en', 'type_mail_encryption', 'Type mail encryption', '2025-05-01 05:50:12', '2025-05-01 05:50:12', NULL),
(685, 'en', 'mail_from_address', 'Mail From Address', '2025-05-01 05:50:12', '2025-05-01 05:50:12', NULL),
(686, 'en', 'type_mail_from_address', 'Type mail from address', '2025-05-01 05:50:12', '2025-05-01 05:50:12', NULL),
(687, 'en', 'mail_from_name', 'Mail From Name', '2025-05-01 05:50:12', '2025-05-01 05:50:12', NULL),
(688, 'en', 'type_mail_from_name', 'Type mail from name', '2025-05-01 05:50:12', '2025-05-01 05:50:12', NULL),
(689, 'en', 'configure_smtp', 'Configure SMTP', '2025-05-01 05:50:13', '2025-05-01 05:50:13', NULL),
(690, 'en', 'smtp_information', 'SMTP Information', '2025-05-01 05:50:13', '2025-05-01 05:50:13', NULL),
(691, 'en', 'paytm_channel', 'PayTm Channel', '2025-05-01 05:51:32', '2025-05-01 05:51:32', NULL),
(692, 'en', 'paytm_industry_type', 'PayTm Industry Type', '2025-05-01 05:51:32', '2025-05-01 05:51:32', NULL),
(693, 'en', 'enable_paytm', 'Enable PayTm', '2025-05-01 05:51:32', '2025-05-01 05:51:32', NULL),
(694, 'en', 'razorpay_configuration', 'Razorpay Configuration', '2025-05-01 05:51:32', '2025-05-01 05:51:32', NULL),
(695, 'en', 'razorpay_key', 'Razorpay Key', '2025-05-01 05:51:33', '2025-05-01 05:51:33', NULL),
(696, 'en', 'razorpay_secret', 'Razorpay Secret', '2025-05-01 05:51:33', '2025-05-01 05:51:33', NULL),
(697, 'en', 'enable_razorpay', 'Enable Razorpay', '2025-05-01 05:51:33', '2025-05-01 05:51:33', NULL),
(698, 'en', 'iyzico_configuration', 'Iyzico Configuration', '2025-05-01 05:51:33', '2025-05-01 05:51:33', NULL),
(699, 'en', 'iyzico_api_key', 'IyZico API Key', '2025-05-01 05:51:33', '2025-05-01 05:51:33', NULL),
(700, 'en', 'iyzico_secret_key', 'IyZico Secret Key', '2025-05-01 05:51:33', '2025-05-01 05:51:33', NULL),
(701, 'en', 'enable_iyzico', 'Enable IyZico', '2025-05-01 05:51:33', '2025-05-01 05:51:33', NULL),
(702, 'en', 'paystack_configuration', 'Paystack Configuration', '2025-05-01 05:51:33', '2025-05-01 05:51:33', NULL),
(703, 'en', 'paystack_public_key', 'Paystack Public Key', '2025-05-01 05:51:33', '2025-05-01 05:51:33', NULL),
(704, 'en', 'secret_key', 'Secret Key', '2025-05-01 05:51:33', '2025-05-01 05:51:33', NULL),
(705, 'en', 'merchant_email', 'Merchant Email', '2025-05-01 05:51:33', '2025-05-01 05:51:33', NULL),
(706, 'en', 'paystack_callback', 'Paystack Callback', '2025-05-01 05:51:33', '2025-05-01 05:51:33', NULL),
(707, 'en', 'paystack_currency_code', 'Paystack Currency Code', '2025-05-01 05:51:33', '2025-05-01 05:51:33', NULL),
(708, 'en', 'enable_paystack', 'Enable Paystack', '2025-05-01 05:51:33', '2025-05-01 05:51:33', NULL),
(709, 'en', 'flutterwave_configuration', 'Flutterwave Configuration', '2025-05-01 05:51:34', '2025-05-01 05:51:34', NULL),
(710, 'en', 'flutterwave_public_key', 'Flutterwave Public Key', '2025-05-01 05:51:34', '2025-05-01 05:51:34', NULL),
(711, 'en', 'flutterwave_secret_key', 'Flutterwave Secret Key', '2025-05-01 05:51:34', '2025-05-01 05:51:34', NULL),
(712, 'en', 'flutterwave_secret_hash', 'Flutterwave Secret Hash', '2025-05-01 05:51:34', '2025-05-01 05:51:34', NULL),
(713, 'en', 'enable_flutterwave', 'Enable Flutterwave', '2025-05-01 05:51:34', '2025-05-01 05:51:34', NULL),
(714, 'en', 'duitku_configuration', 'Duitku Configuration', '2025-05-01 05:51:34', '2025-05-01 05:51:34', NULL),
(715, 'en', 'duitku_api_key', 'Duitku Api Key', '2025-05-01 05:51:34', '2025-05-01 05:51:34', NULL),
(716, 'en', 'duitku_merchant_code', 'Duitku Merchant Code', '2025-05-01 05:51:34', '2025-05-01 05:51:34', NULL),
(717, 'en', 'duitku_callback_url', 'Duitku Callback Url', '2025-05-01 05:51:34', '2025-05-01 05:51:34', NULL),
(718, 'en', 'duitku_return_url', 'Duitku Return Url', '2025-05-01 05:51:34', '2025-05-01 05:51:34', NULL),
(719, 'en', 'duitku_env', 'Duitku Env', '2025-05-01 05:51:34', '2025-05-01 05:51:34', NULL),
(720, 'en', 'enable_duitku', 'Enable Duitku', '2025-05-01 05:51:34', '2025-05-01 05:51:34', NULL),
(721, 'en', 'yookassa_configuration', 'Yookassa Configuration', '2025-05-01 05:51:35', '2025-05-01 05:51:35', NULL),
(722, 'en', 'yookassa_shop_id', 'Yookassa Shop ID', '2025-05-01 05:51:35', '2025-05-01 05:51:35', NULL),
(723, 'en', 'yookassa_secret_key', 'Yookassa Secret Key', '2025-05-01 05:51:35', '2025-05-01 05:51:35', NULL),
(724, 'en', 'yookassa_currency_code', 'YOOKASSA Currency Code', '2025-05-01 05:51:35', '2025-05-01 05:51:35', NULL),
(725, 'en', 'enable_yookassa', 'Enable Yookassa', '2025-05-01 05:51:35', '2025-05-01 05:51:35', NULL),
(726, 'en', 'reciept_', 'Reciept ?', '2025-05-01 05:51:35', '2025-05-01 05:51:35', NULL),
(727, 'en', 'vat_rates_yookassa', 'VAT rates Yookassa', '2025-05-01 05:51:35', '2025-05-01 05:51:35', NULL),
(728, 'en', 'vat_not_included', 'VAT not included', '2025-05-01 05:51:35', '2025-05-01 05:51:35', NULL),
(729, 'en', '0_vat_rate', '0% VAT rate', '2025-05-01 05:51:35', '2025-05-01 05:51:35', NULL),
(730, 'en', '10_vat_rate', '10% VAT rate', '2025-05-01 05:51:35', '2025-05-01 05:51:35', NULL),
(731, 'en', '20_receipts_vat_rate', '20% receipt’s VAT rate', '2025-05-01 05:51:35', '2025-05-01 05:51:35', NULL),
(732, 'en', '10110_receipts_estimate_vat_rate', '10/110 receipt’s estimate VAT rate', '2025-05-01 05:51:35', '2025-05-01 05:51:35', NULL),
(733, 'en', '20120_receipts_estimate_vat_rate', '20/120 receipt’s estimate VAT rate', '2025-05-01 05:51:35', '2025-05-01 05:51:35', NULL),
(734, 'en', 'molile_configuration', 'Molile Configuration', '2025-05-01 05:51:35', '2025-05-01 05:51:35', NULL),
(735, 'en', 'molile_api_key', 'Molile API Key', '2025-05-01 05:51:35', '2025-05-01 05:51:35', NULL),
(736, 'en', 'enable_molile', 'Enable Molile', '2025-05-01 05:51:35', '2025-05-01 05:51:35', NULL),
(737, 'en', 'midtrans_configuration', 'Midtrans Configuration', '2025-05-01 05:51:36', '2025-05-01 05:51:36', NULL),
(738, 'en', 'midtrans_server_key', 'Midtrans Server Key', '2025-05-01 05:51:36', '2025-05-01 05:51:36', NULL),
(739, 'en', 'midtrans_client_key', 'Midtrans Client Key', '2025-05-01 05:51:36', '2025-05-01 05:51:36', NULL),
(740, 'en', 'finish_url', 'Finish URL', '2025-05-01 05:51:36', '2025-05-01 05:51:36', NULL),
(741, 'en', 'payment_notification_url', 'Payment Notification URL', '2025-05-01 05:51:36', '2025-05-01 05:51:36', NULL),
(742, 'en', 'payment_failed_url', 'Payment Failed URL', '2025-05-01 05:51:36', '2025-05-01 05:51:36', NULL),
(743, 'en', 'enable_midtrans', 'Enable Midtrans', '2025-05-01 05:51:36', '2025-05-01 05:51:36', NULL),
(744, 'en', 'offline_payment_configuration', 'Offline Payment Configuration', '2025-05-01 05:51:36', '2025-05-01 05:51:36', NULL),
(745, 'en', 'enable_offline', 'Enable Offline', '2025-05-01 05:51:36', '2025-05-01 05:51:36', NULL),
(746, 'en', 'choose_image', 'Choose Image', '2025-05-01 05:51:36', '2025-05-01 05:51:36', NULL),
(747, 'en', 'cash_on_delivery_configuration', 'Cash On Delivery Configuration', '2025-05-01 05:51:36', '2025-05-01 05:51:36', NULL),
(748, 'en', 'enable_cash_on_delivery', 'Enable Cash On Delivery', '2025-05-01 05:51:36', '2025-05-01 05:51:36', NULL),
(749, 'en', 'facebook_app_secret', 'Facebook App Secret', '2025-05-01 05:51:58', '2025-05-01 05:51:58', NULL),
(750, 'en', 'faccebook_login', 'Faccebook Login', '2025-05-01 05:51:58', '2025-05-01 05:51:58', NULL),
(751, 'en', 'roles', 'Roles', '2025-05-01 05:53:00', '2025-05-01 05:53:00', NULL),
(752, 'en', 'add_role', 'Add Role', '2025-05-01 05:53:00', '2025-05-01 05:53:00', NULL),
(753, 'en', 'created_by', 'Created By', '2025-05-01 05:53:00', '2025-05-01 05:53:00', NULL),
(754, 'en', 'na', 'n/a', '2025-05-01 05:53:00', '2025-05-01 05:53:00', NULL),
(755, 'en', 'uliaa', 'Uliaa', '2025-05-01 08:14:40', '2025-05-01 08:14:40', NULL),
(756, 'en', 'add_employee', 'Add Employee', '2025-05-01 08:22:22', '2025-05-01 08:22:22', NULL),
(757, 'en', 'role', 'Role', '2025-05-01 08:22:22', '2025-05-01 08:22:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `banner` bigint(20) UNSIGNED DEFAULT NULL,
  `address` text DEFAULT NULL,
  `latitude` varchar(191) DEFAULT NULL,
  `longitude` varchar(191) DEFAULT NULL,
  `is_default` tinyint(4) NOT NULL DEFAULT 0,
  `is_published` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `banner`, `address`, `latitude`, `longitude`, `is_default`, `is_published`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Default Location', NULL, 'Default Address', NULL, NULL, 1, 1, '2023-03-27 01:09:01', '2023-03-28 02:46:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `logistics`
--

CREATE TABLE `logistics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `thumbnail_image` bigint(20) UNSIGNED DEFAULT NULL,
  `is_published` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logistic_zones`
--

CREATE TABLE `logistic_zones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `logistic_id` bigint(20) UNSIGNED NOT NULL,
  `standard_delivery_charge` double NOT NULL DEFAULT 0,
  `express_delivery_charge` double NOT NULL DEFAULT 0,
  `standard_delivery_time` varchar(191) DEFAULT NULL COMMENT '1 - 3 days',
  `express_delivery_time` varchar(191) DEFAULT NULL COMMENT '1 day',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logistic_zone_cities`
--

CREATE TABLE `logistic_zone_cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logistic_id` bigint(20) UNSIGNED NOT NULL,
  `logistic_zone_id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media_managers`
--

CREATE TABLE `media_managers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `media_file` longtext DEFAULT NULL,
  `media_size` int(11) DEFAULT NULL,
  `media_type` varchar(191) DEFAULT NULL COMMENT 'video / image / pdf / ...',
  `media_name` text DEFAULT NULL,
  `media_extension` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media_managers`
--

INSERT INTO `media_managers` (`id`, `user_id`, `media_file`, `media_size`, `media_type`, `media_name`, `media_extension`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'uploads/media/6AkCyw6sfJrIG2NR2MuAzGRtkA48Rmgj8ND2Hc1k.png', 1916, 'image', 'logo.png', 'png', '2023-03-11 23:19:37', '2023-03-11 23:19:37', NULL),
(2, 1, 'uploads/media/ZithHqXrynYP6nkIfU0ei7VtWRMvuObOGd0P2tdR.png', 1055, 'image', 'logo-white.png', 'png', '2023-03-11 23:20:28', '2023-03-11 23:20:28', NULL),
(3, 1, 'uploads/media/3WOll3QyXt5f9NNi22BRANFNCTNQRey75DYAOXd4.png', 4430, 'image', 'payments.png', 'png', '2023-03-11 23:20:48', '2023-03-11 23:20:48', NULL),
(4, 1, 'uploads/media/LOa3BqX3ydhVC0V1fwYEyvEpM5N9NaoA0E7u3EQs.png', 1742, 'image', 'logo.png', 'png', '2023-03-11 23:22:45', '2023-03-11 23:22:45', NULL),
(5, 1, 'uploads/media/yqqPV512Gk5DMpvCj2UllKrCl52bam3yD6QvfiPP.png', 753, 'image', 'favicon.png', 'png', '2023-03-11 23:23:14', '2023-03-11 23:23:14', NULL),
(6, 1, 'uploads/media/dtkoInw3SD3IF3Q2I1jFtEDiE96mDD46RHB9RdxN.jpg', 6502, 'image', '1.jpg', 'jpg', '2023-03-11 23:23:43', '2023-03-11 23:23:43', NULL),
(7, 1, 'uploads/media/H062BYSILl6ZdWtfIAOnUFEtgaPCVEFytbe5H1KA.jpg', 73392, 'image', 'uliaa-mart-logo.jpeg', 'jpeg', '2025-05-01 02:42:26', '2025-05-01 02:42:26', NULL),
(8, 1, 'uploads/media/UTay6b2Opk6emKjBvbmYQZuhxbnxZaovWAHATcT4.jpg', 22378, 'image', 'uliaa-mart-logo (1).jpeg', 'jpeg', '2025-05-01 03:05:26', '2025-05-01 03:05:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
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
(5, '2022_10_31_050025_create_languages_table', 1),
(6, '2022_10_31_050126_create_localizations_table', 1),
(7, '2022_11_01_103504_create_brands_table', 1),
(8, '2022_11_02_053600_create_brand_localizations_table', 1),
(9, '2022_11_02_123335_create_units_table', 1),
(10, '2022_11_02_123459_create_unit_localizations_table', 1),
(11, '2022_11_05_052843_create_variations_table', 1),
(12, '2022_11_05_054556_create_variation_values_table', 1),
(13, '2022_11_05_054802_create_variation_localizations_table', 1),
(14, '2022_11_05_060326_create_variation_value_localizations_table', 1),
(15, '2022_11_05_094646_create_taxes_table', 1),
(16, '2022_11_05_121337_create_shops_table', 1),
(17, '2022_11_06_050339_create_coupons_table', 1),
(18, '2022_11_06_050628_create_coupon_usages_table', 1),
(19, '2022_11_06_073951_create_categories_table', 1),
(20, '2022_11_06_074215_create_category_localizations_table', 1),
(21, '2022_11_07_044613_create_category_brands_table', 1),
(22, '2022_11_07_061318_create_tags_table', 1),
(23, '2022_11_07_064323_create_blog_categories_table', 1),
(24, '2022_11_07_085058_create_blogs_table', 1),
(25, '2022_11_07_085227_create_blog_localizations_table', 1),
(26, '2022_11_07_105203_create_blog_tags_table', 1),
(27, '2022_11_09_050229_create_currencies_table', 1),
(28, '2022_11_12_044845_create_system_settings_table', 1),
(29, '2022_11_12_054927_create_products_table', 1),
(30, '2022_11_12_055104_create_product_localizations_table', 1),
(31, '2022_11_12_055551_create_product_categories_table', 1),
(32, '2022_11_12_055602_create_product_taxes_table', 1),
(33, '2022_11_12_055843_create_product_variations_table', 1),
(34, '2022_11_12_055914_create_product_variation_stocks_table', 1),
(35, '2022_11_12_055926_create_product_variation_combinations_table', 1),
(36, '2022_11_12_055958_create_product_colors_table', 1),
(37, '2022_11_16_063630_create_logistics_table', 1),
(38, '2022_11_16_064842_create_logistic_zones_table', 1),
(39, '2022_11_16_094759_create_subscribed_users_table', 1),
(40, '2022_11_20_045224_create_campaigns_table', 1),
(41, '2022_11_20_045328_create_campaign_products_table', 1),
(42, '2022_11_20_085351_create_pages_table', 1),
(43, '2022_11_20_085638_create_page_localizations_table', 1),
(44, '2022_11_23_095815_create_countries_table', 1),
(45, '2022_11_23_095827_create_states_table', 1),
(46, '2022_11_23_095839_create_cities_table', 1),
(47, '2022_11_27_080124_create_permission_tables', 1),
(48, '2022_11_28_122043_create_logistic_zone_cities_table', 1),
(49, '2022_12_13_051944_create_media_managers_table', 1),
(50, '2023_01_24_084123_create_carts_table', 1),
(51, '2023_01_31_051011_create_user_addresses_table', 1),
(52, '2023_02_01_105413_create_order_groups_table', 1),
(53, '2023_02_01_105521_create_orders_table', 1),
(54, '2023_02_01_105530_create_order_items_table', 1),
(55, '2023_02_07_111010_create_wishlists_table', 1),
(56, '2023_02_08_054446_create_contact_us_messages_table', 1),
(57, '2023_02_19_093630_create_order_updates_table', 1),
(58, '2023_02_27_105939_create_product_tags_table', 1),
(59, '2023_03_18_100524_create_scheduled_delivery_time_lists_table', 1),
(60, '2023_03_27_054134_create_locations_table', 1),
(61, '2023_04_09_035532_create_reward_points_table', 1),
(62, '2023_04_09_041125_create_wallet_histories_table', 1),
(63, '2023_04_09_091251_create_refunds_table', 1),
(64, '2023_08_12_085802_add_column_to_roles_table', 1),
(65, '2023_09_16_052543_create_themes_table', 1),
(66, '2023_09_17_061713_create_blog_themes_table', 1),
(67, '2023_09_17_063729_add_existing_blogs_to_default_theme', 1),
(68, '2023_09_17_093614_create_coupon_themes_table', 1),
(69, '2023_09_17_094013_assign_existing_coupons_to_default_theme', 1),
(70, '2023_09_17_095843_create_campaign_themes_table', 1),
(71, '2023_09_17_095909_assign_existing_campaigns_to_default_theme', 1),
(72, '2023_09_18_051600_create_category_themes_table', 1),
(73, '2023_09_18_051721_assign_existing_categories_to_default_theme', 1),
(74, '2023_09_18_063203_create_product_themes_table', 1),
(75, '2023_09_18_063223_assign_existing_products_to_default_theme', 1),
(76, '2023_09_18_105405_add_description_to_category_table', 1),
(77, '2023_09_18_112324_add_description_to_category_localizations_table', 1),
(78, '2023_09_23_053751_add_columns_for_deliveryman_to_orders_table', 1),
(79, '2023_09_23_061659_add_permissions_for_deliverymen_to_permissions_table', 1),
(80, '2023_09_23_063324_add_columns_for_deliveryman_to_users_table', 1),
(81, '2023_10_18_084602_create_priorities_table', 1),
(82, '2023_10_18_112819_create_tickets_table', 1),
(83, '2023_10_18_115858_create_ticket_files_table', 1),
(84, '2023_10_18_121029_create_reply_tickets_table', 1),
(85, '2023_10_18_121455_create_assign_tickets_table', 1),
(86, '2023_11_06_063835_add_salary_columns_for_deliveryman_to_users_table', 1),
(87, '2023_11_06_091415_create_notifications_table', 1),
(88, '2023_11_07_064519_add_column_note_for_order_table', 1),
(89, '2023_11_07_125804_create_payouts_table', 1),
(90, '2023_11_08_105229_create_payrolls_table', 1),
(91, '2023_11_13_092605_create_enmart_modules_table', 1),
(92, '2023_11_13_093523_create_ticket_categories_table', 1),
(93, '2023_11_13_115618_add_column_is_active_to_logistics_table', 1),
(94, '2024_01_17_124325_create_licenses_table', 1),
(95, '2024_01_22_083502_add_foreign_id_column', 1),
(96, '2024_02_28_081706_create_payment_gateways_table', 1),
(97, '2024_02_28_092301_create_payment_gateway_details_table', 1),
(98, '2024_03_03_072012_create_grass_period_payments_table', 1),
(99, '2024_03_05_064225_add_column_vedio_link_to_products_table', 1),
(100, '2024_03_05_095501_create_temporary_product_import_data_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(191) NOT NULL,
  `notifiable_type` varchar(191) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_group_id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deliveryman_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `guest_user_id` int(11) DEFAULT NULL,
  `location_id` bigint(20) UNSIGNED DEFAULT NULL,
  `delivery_status` varchar(191) NOT NULL DEFAULT 'order_placed',
  `payment_status` varchar(191) NOT NULL DEFAULT 'unpaid',
  `applied_coupon_code` varchar(191) DEFAULT NULL,
  `coupon_discount_amount` double NOT NULL DEFAULT 0,
  `admin_earning_percentage` double NOT NULL DEFAULT 0 COMMENT 'how much in percentage seller will pay to admin for each sell',
  `total_admin_earnings` double NOT NULL DEFAULT 0,
  `total_vendor_earnings` double NOT NULL DEFAULT 0,
  `logistic_id` bigint(20) UNSIGNED DEFAULT NULL,
  `logistic_name` varchar(191) DEFAULT NULL,
  `pickup_or_delivery` varchar(191) NOT NULL DEFAULT 'delivery',
  `shipping_delivery_type` varchar(191) NOT NULL DEFAULT 'regular' COMMENT 'regular/scheduled',
  `scheduled_delivery_info` longtext DEFAULT NULL COMMENT 'keep date & time',
  `pickup_hub_id` int(11) DEFAULT NULL,
  `shipping_cost` double NOT NULL DEFAULT 0,
  `tips_amount` double NOT NULL DEFAULT 0,
  `reward_points` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_groups`
--

CREATE TABLE `order_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `guest_user_id` int(11) DEFAULT NULL,
  `order_code` bigint(20) NOT NULL,
  `shipping_address_id` int(11) DEFAULT NULL,
  `billing_address_id` int(11) DEFAULT NULL,
  `location_id` bigint(20) UNSIGNED DEFAULT NULL,
  `phone_no` varchar(191) DEFAULT NULL,
  `alternative_phone_no` varchar(191) DEFAULT NULL,
  `sub_total_amount` double NOT NULL DEFAULT 0,
  `total_tax_amount` double NOT NULL DEFAULT 0,
  `total_coupon_discount_amount` double NOT NULL DEFAULT 0,
  `total_shipping_cost` double NOT NULL DEFAULT 0,
  `grand_total_amount` double NOT NULL DEFAULT 0,
  `payment_method` varchar(191) NOT NULL DEFAULT 'cash_on_delivery',
  `payment_status` varchar(191) NOT NULL DEFAULT 'unpaid',
  `payment_details` longtext DEFAULT NULL,
  `is_manual_payment` tinyint(1) NOT NULL DEFAULT 0,
  `manual_payment_details` longtext DEFAULT NULL,
  `is_pos_order` tinyint(4) NOT NULL DEFAULT 0,
  `pos_order_address` text DEFAULT NULL,
  `additional_discount_value` double NOT NULL DEFAULT 0,
  `additional_discount_type` varchar(191) NOT NULL DEFAULT 'flat',
  `total_discount_amount` double NOT NULL DEFAULT 0,
  `total_tips_amount` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_variation_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 1,
  `location_id` bigint(20) UNSIGNED DEFAULT NULL,
  `unit_price` double NOT NULL DEFAULT 0,
  `total_tax` double NOT NULL DEFAULT 0,
  `total_price` double NOT NULL DEFAULT 0,
  `reward_points` bigint(20) NOT NULL DEFAULT 0,
  `is_refunded` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_updates`
--

CREATE TABLE `order_updates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `note` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `content` longtext DEFAULT NULL,
  `meta_title` mediumtext DEFAULT NULL,
  `meta_image` bigint(20) UNSIGNED DEFAULT NULL,
  `meta_description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `meta_title`, `meta_image`, `meta_description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Terms & Conditions', 'terms-conditions', '<div class=\"mb-5\" style=\"color: rgb(71, 85, 105); font-family: Jost, sans-serif; font-size: 15.008px;\"><h2 class=\"h5\" style=\"font-family: Rubik, sans-serif; font-weight: 500; color: rgb(51, 65, 85); font-size: 1.1725rem;\"><span style=\"color: rgb(71, 85, 105); font-family: Jost, sans-serif; font-size: 15.008px; background-color: var(--bs-body-bg); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Welcome to ThemeTags!</span><br></h2><p style=\"\">These terms and conditions outline the rules and regulations for the use of Themetags\'s Website, located at https://themetags.com/.</p><p style=\"\">By accessing this website we assume you accept these terms and conditions. Do not continue to use ThemeTags if you do not agree to take all of the terms and conditions stated on this page.</p><p class=\"mb-0\" style=\"\">The following terminology applies to these Terms and Conditions, Privacy Statement and Disclaimer Notice and all Agreements: \"Client\", \"You\" and \"Your\" refers to you, the person log on this website and compliant to the Company\'s terms and conditions. \"The Company\", \"Ourselves\", \"We\", \"Our\" and \"Us\", refers to our Company. \"Party\", \"Parties\", or \"Us\", refers to both the Client and ourselves. All terms refer to the offer, acceptance and consideration of payment necessary to undertake the process of our assistance to the Client in the most appropriate manner for the express purpose of meeting the Client’s needs in respect of provision of the Company’s stated services, in accordance with and subject to, prevailing law of Netherlands. Any use of the above terminology or other words in the singular, plural, capitalization and/or he/she or they, are taken as interchangeable and therefore as referring to same.</p></div><div class=\"mb-5\" style=\"color: rgb(71, 85, 105); font-family: Jost, sans-serif; font-size: 15.008px;\"><h2 class=\"h5\" style=\"font-family: Rubik, sans-serif; font-weight: 500; color: rgb(51, 65, 85); font-size: 1.1725rem;\">Cookies</h2><p>We employ the use of cookies. By accessing ThemeTags, you agreed to use cookies in agreement with the Themetags\'s Privacy Policy.</p><p class=\"mb-0\">Most interactive websites use cookies to let us retrieve the user\'s details for each visit. Cookies are used by our website to enable the functionality of certain areas to make it easier for people visiting our website. Some of our affiliate/advertising partners may also use cookies.</p></div><div class=\"mb-5\" style=\"color: rgb(71, 85, 105); font-family: Jost, sans-serif; font-size: 15.008px;\"><h2 class=\"h5\" style=\"font-family: Rubik, sans-serif; font-weight: 500; color: rgb(51, 65, 85); font-size: 1.1725rem;\">License</h2><p>Unless otherwise stated, Themetags and/or its licensors own the intellectual property rights for all material on ThemeTags. All intellectual property rights are reserved. You may access this from ThemeTags for your own personal use subjected to restrictions set in these terms and conditions.</p><p>You must not:</p><ul class=\"mb-3\"><li>Republish material from ThemeTags</li><li>Sell, rent or sub-license material from ThemeTags</li><li>Reproduce, duplicate or copy material from ThemeTags</li><li>Redistribute content from ThemeTags</li></ul><p>Parts of this website offer an opportunity for users to post and exchange opinions and information in certain areas of the website. Themetags does not filter, edit, publish or review Comments prior to their presence on the website. Comments do not reflect the views and opinions of Themetags,its agents and/or affiliates. Comments reflect the views and opinions of the person who post their views and opinions. To the extent permitted by applicable laws, Themetags shall not be liable for the Comments or for any liability, damages or expenses caused and/or suffered as a result of any use of and/or posting of and/or appearance of the Comments on this website.</p><p>Themetags reserves the right to monitor all Comments and to remove any Comments which can be considered inappropriate, offensive or causes breach of these Terms and Conditions.</p><p>You warrant and represent that:</p><ul class=\"mb-3\"><li>You are entitled to post the Comments on our website and have all necessary licenses and consents to do so;</li><li>The Comments do not invade any intellectual property right, including without limitation copyright, patent or trademark of any third party;</li><li>The Comments do not contain any defamatory, libelous, offensive, indecent or otherwise unlawful material which is an invasion of privacy</li><li>The Comments will not be used to solicit or promote business or custom or present commercial activities or unlawful activity.</li></ul><p class=\"mb-0\">You hereby grant Themetags a non-exclusive license to use, reproduce, edit and authorize others to use, reproduce and edit any of your Comments in any and all forms, formats or media.</p></div><div class=\"mb-5\" style=\"color: rgb(71, 85, 105); font-family: Jost, sans-serif; font-size: 15.008px;\"><h2 class=\"h5\" style=\"font-family: Rubik, sans-serif; font-weight: 500; color: rgb(51, 65, 85); font-size: 1.1725rem;\">Hyperlinking to our Content</h2><p>The following organizations may link to our Website without prior written approval:</p><ul class=\"mb-3\"><li>Government agencies;</li><li>Search engines;</li><li>News organizations;</li><li>Online directory distributors may link to our Website in the same manner as they hyperlink to the Websites of other listed businesses; and</li><li>System wide Accredited Businesses except soliciting non-profit organizations, charity shopping malls, and charity fundraising groups which may not hyperlink to our Web site.</li></ul><p>These organizations may link to our home page, to publications or to other Website information so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products and/or services; and (c) fits within the context of the linking party\'s site.</p><p>We may consider and approve other link requests from the following types of organizations:</p><ul class=\"mb-3\"><li>commonly-known consumer and/or business information sources;</li><li>dot.com community sites;</li><li>associations or other groups representing charities;</li><li>online directory distributors;</li><li>internet portals;</li><li>accounting, law and consulting firms; and</li><li>educational institutions and trade associations.</li></ul><p>We will approve link requests from these organizations if we decide that: (a) the link would not make us look unfavorably to ourselves or to our accredited businesses; (b) the organization does not have any negative records with us; (c) the benefit to us from the visibility of the hyperlink compensates the absence of Themetags; and (d) the link is in the context of general resource information.</p><p>These organizations may link to our home page so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products or services; and (c) fits within the context of the linking party\'s site.</p><p>If you are one of the organizations listed in paragraph 2 above and are interested in linking to our website, you must inform us by sending an e-mail to Themetags. Please include your name, your organization name, contact information as well as the URL of your site, a list of any URLs from which you intend to link to our Website, and a list of the URLs on our site to which you would like to link. Wait 2-3 weeks for a response.</p><p>Approved organizations may hyperlink to our Website as follows:</p><ul class=\"mb-3\"><li>By use of our corporate name; or</li><li>By use of the uniform resource locator being linked to; or</li><li>By use of any other description of our Website being linked to that makes sense within the context and format of content on the linking party’s site.</li></ul><p>No use of Themetags\'s logo or other artwork will be allowed for linking absent a trademark license agreement.</p></div><div class=\"mb-5\" style=\"color: rgb(71, 85, 105); font-family: Jost, sans-serif; font-size: 15.008px;\"><h2 class=\"h5\" style=\"font-family: Rubik, sans-serif; font-weight: 500; color: rgb(51, 65, 85); font-size: 1.1725rem;\">iFrames</h2><p class=\"mb-0\">Without prior approval and written permission, you may not create frames around our Webpages that alter in any way the visual presentation or appearance of our Website.</p></div><div class=\"mb-5\" style=\"color: rgb(71, 85, 105); font-family: Jost, sans-serif; font-size: 15.008px;\"><h2 class=\"h5\" style=\"font-family: Rubik, sans-serif; font-weight: 500; color: rgb(51, 65, 85); font-size: 1.1725rem;\">Content Liability</h2><p class=\"mb-0\">We shall not be hold responsible for any content that appears on your Website. You agree to protect and defend us against all claims that is rising on your Website. No link(s) should appear on any Website that may be interpreted as libelous, obscene or criminal, or which infringes, otherwise violates, or advocates the infringement or other violation of, any third party rights.</p></div><div class=\"mb-5\" style=\"color: rgb(71, 85, 105); font-family: Jost, sans-serif; font-size: 15.008px;\"><h2 class=\"h5\" style=\"font-family: Rubik, sans-serif; font-weight: 500; color: rgb(51, 65, 85); font-size: 1.1725rem;\">Your Privacy</h2><p class=\"mb-0\">Please read Privacy Policy</p></div><div class=\"mb-5\" style=\"color: rgb(71, 85, 105); font-family: Jost, sans-serif; font-size: 15.008px;\"><h2 class=\"h5\" style=\"font-family: Rubik, sans-serif; font-weight: 500; color: rgb(51, 65, 85); font-size: 1.1725rem;\">Reservation of Rights</h2><p class=\"mb-0\">We reserve the right to request that you remove all links or any particular link to our Website. You approve to immediately remove all links to our Website upon request. We also reserve the right to amen these terms and conditions and it\'s linking policy at any time. By continuously linking to our Website, you agree to be bound to and follow these linking terms and conditions.</p></div><div class=\"mb-5\" style=\"color: rgb(71, 85, 105); font-family: Jost, sans-serif; font-size: 15.008px;\"><h2 class=\"h5\" style=\"font-family: Rubik, sans-serif; font-weight: 500; color: rgb(51, 65, 85); font-size: 1.1725rem;\">Removal of links from our website</h2><p>If you find any link on our Website that is offensive for any reason, you are free to contact and inform us any moment. We will consider requests to remove links but we are not obligated to or so or to respond to you directly.</p><p class=\"mb-0\">We do not ensure that the information on this website is correct, we do not warrant its completeness or accuracy; nor do we promise to ensure that the website remains available or that the material on the website is kept up to date.</p></div><div class=\"content-group\" style=\"color: rgb(71, 85, 105); font-family: Jost, sans-serif; font-size: 15.008px;\"><h2 class=\"h5\" style=\"font-family: Rubik, sans-serif; font-weight: 500; color: rgb(51, 65, 85); font-size: 1.1725rem;\">Disclaimer</h2><p style=\"\">To the maximum extent permitted by applicable law, we exclude all representations, warranties and conditions relating to our website and the use of this website. Nothing in this disclaimer will:</p><ul style=\"\"><li>limit or exclude our or your liability for death or personal injury;</li><li>limit or exclude our or your liability for fraud or fraudulent misrepresentation;</li><li>limit any of our or your liabilities in any way that is not permitted under applicable law; or</li><li>exclude any of our or your liabilities that may not be excluded under applicable law.</li></ul><p style=\"\">The limitations and prohibitions of liability set in this Section and elsewhere in this disclaimer: (a) are subject to the preceding paragraph; and (b) govern all liabilities arising under the disclaimer, including liabilities arising in contract, in tort and for breach of statutory duty.</p><p class=\"mb-0\" style=\"\">As long as the website and the information and services on the website are provided free of charge, we will not be liable for any loss or damage of any nature.</p></div>', 'Quis ab ut officia b', NULL, 'Explicabo Consectet', '2023-02-16 00:43:22', '2023-02-28 23:33:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `page_localizations`
--

CREATE TABLE `page_localizations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `content` longtext DEFAULT NULL,
  `lang_key` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `page_localizations`
--

INSERT INTO `page_localizations` (`id`, `page_id`, `title`, `content`, `lang_key`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Terms & Conditions', '<div class=\"mb-5\" style=\"color: rgb(71, 85, 105); font-family: Jost, sans-serif; font-size: 15.008px;\"><h2 class=\"h5\" style=\"font-family: Rubik, sans-serif; font-weight: 500; color: rgb(51, 65, 85); font-size: 1.1725rem;\"><span style=\"color: rgb(71, 85, 105); font-family: Jost, sans-serif; font-size: 15.008px; background-color: var(--bs-body-bg); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Welcome to ThemeTags!</span><br></h2><p style=\"\">These terms and conditions outline the rules and regulations for the use of Themetags\'s Website, located at https://themetags.com/.</p><p style=\"\">By accessing this website we assume you accept these terms and conditions. Do not continue to use ThemeTags if you do not agree to take all of the terms and conditions stated on this page.</p><p class=\"mb-0\" style=\"\">The following terminology applies to these Terms and Conditions, Privacy Statement and Disclaimer Notice and all Agreements: \"Client\", \"You\" and \"Your\" refers to you, the person log on this website and compliant to the Company\'s terms and conditions. \"The Company\", \"Ourselves\", \"We\", \"Our\" and \"Us\", refers to our Company. \"Party\", \"Parties\", or \"Us\", refers to both the Client and ourselves. All terms refer to the offer, acceptance and consideration of payment necessary to undertake the process of our assistance to the Client in the most appropriate manner for the express purpose of meeting the Client’s needs in respect of provision of the Company’s stated services, in accordance with and subject to, prevailing law of Netherlands. Any use of the above terminology or other words in the singular, plural, capitalization and/or he/she or they, are taken as interchangeable and therefore as referring to same.</p></div><div class=\"mb-5\" style=\"color: rgb(71, 85, 105); font-family: Jost, sans-serif; font-size: 15.008px;\"><h2 class=\"h5\" style=\"font-family: Rubik, sans-serif; font-weight: 500; color: rgb(51, 65, 85); font-size: 1.1725rem;\">Cookies</h2><p>We employ the use of cookies. By accessing ThemeTags, you agreed to use cookies in agreement with the Themetags\'s Privacy Policy.</p><p class=\"mb-0\">Most interactive websites use cookies to let us retrieve the user\'s details for each visit. Cookies are used by our website to enable the functionality of certain areas to make it easier for people visiting our website. Some of our affiliate/advertising partners may also use cookies.</p></div><div class=\"mb-5\" style=\"color: rgb(71, 85, 105); font-family: Jost, sans-serif; font-size: 15.008px;\"><h2 class=\"h5\" style=\"font-family: Rubik, sans-serif; font-weight: 500; color: rgb(51, 65, 85); font-size: 1.1725rem;\">License</h2><p>Unless otherwise stated, Themetags and/or its licensors own the intellectual property rights for all material on ThemeTags. All intellectual property rights are reserved. You may access this from ThemeTags for your own personal use subjected to restrictions set in these terms and conditions.</p><p>You must not:</p><ul class=\"mb-3\"><li>Republish material from ThemeTags</li><li>Sell, rent or sub-license material from ThemeTags</li><li>Reproduce, duplicate or copy material from ThemeTags</li><li>Redistribute content from ThemeTags</li></ul><p>Parts of this website offer an opportunity for users to post and exchange opinions and information in certain areas of the website. Themetags does not filter, edit, publish or review Comments prior to their presence on the website. Comments do not reflect the views and opinions of Themetags,its agents and/or affiliates. Comments reflect the views and opinions of the person who post their views and opinions. To the extent permitted by applicable laws, Themetags shall not be liable for the Comments or for any liability, damages or expenses caused and/or suffered as a result of any use of and/or posting of and/or appearance of the Comments on this website.</p><p>Themetags reserves the right to monitor all Comments and to remove any Comments which can be considered inappropriate, offensive or causes breach of these Terms and Conditions.</p><p>You warrant and represent that:</p><ul class=\"mb-3\"><li>You are entitled to post the Comments on our website and have all necessary licenses and consents to do so;</li><li>The Comments do not invade any intellectual property right, including without limitation copyright, patent or trademark of any third party;</li><li>The Comments do not contain any defamatory, libelous, offensive, indecent or otherwise unlawful material which is an invasion of privacy</li><li>The Comments will not be used to solicit or promote business or custom or present commercial activities or unlawful activity.</li></ul><p class=\"mb-0\">You hereby grant Themetags a non-exclusive license to use, reproduce, edit and authorize others to use, reproduce and edit any of your Comments in any and all forms, formats or media.</p></div><div class=\"mb-5\" style=\"color: rgb(71, 85, 105); font-family: Jost, sans-serif; font-size: 15.008px;\"><h2 class=\"h5\" style=\"font-family: Rubik, sans-serif; font-weight: 500; color: rgb(51, 65, 85); font-size: 1.1725rem;\">Hyperlinking to our Content</h2><p>The following organizations may link to our Website without prior written approval:</p><ul class=\"mb-3\"><li>Government agencies;</li><li>Search engines;</li><li>News organizations;</li><li>Online directory distributors may link to our Website in the same manner as they hyperlink to the Websites of other listed businesses; and</li><li>System wide Accredited Businesses except soliciting non-profit organizations, charity shopping malls, and charity fundraising groups which may not hyperlink to our Web site.</li></ul><p>These organizations may link to our home page, to publications or to other Website information so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products and/or services; and (c) fits within the context of the linking party\'s site.</p><p>We may consider and approve other link requests from the following types of organizations:</p><ul class=\"mb-3\"><li>commonly-known consumer and/or business information sources;</li><li>dot.com community sites;</li><li>associations or other groups representing charities;</li><li>online directory distributors;</li><li>internet portals;</li><li>accounting, law and consulting firms; and</li><li>educational institutions and trade associations.</li></ul><p>We will approve link requests from these organizations if we decide that: (a) the link would not make us look unfavorably to ourselves or to our accredited businesses; (b) the organization does not have any negative records with us; (c) the benefit to us from the visibility of the hyperlink compensates the absence of Themetags; and (d) the link is in the context of general resource information.</p><p>These organizations may link to our home page so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products or services; and (c) fits within the context of the linking party\'s site.</p><p>If you are one of the organizations listed in paragraph 2 above and are interested in linking to our website, you must inform us by sending an e-mail to Themetags. Please include your name, your organization name, contact information as well as the URL of your site, a list of any URLs from which you intend to link to our Website, and a list of the URLs on our site to which you would like to link. Wait 2-3 weeks for a response.</p><p>Approved organizations may hyperlink to our Website as follows:</p><ul class=\"mb-3\"><li>By use of our corporate name; or</li><li>By use of the uniform resource locator being linked to; or</li><li>By use of any other description of our Website being linked to that makes sense within the context and format of content on the linking party’s site.</li></ul><p>No use of Themetags\'s logo or other artwork will be allowed for linking absent a trademark license agreement.</p></div><div class=\"mb-5\" style=\"color: rgb(71, 85, 105); font-family: Jost, sans-serif; font-size: 15.008px;\"><h2 class=\"h5\" style=\"font-family: Rubik, sans-serif; font-weight: 500; color: rgb(51, 65, 85); font-size: 1.1725rem;\">iFrames</h2><p class=\"mb-0\">Without prior approval and written permission, you may not create frames around our Webpages that alter in any way the visual presentation or appearance of our Website.</p></div><div class=\"mb-5\" style=\"color: rgb(71, 85, 105); font-family: Jost, sans-serif; font-size: 15.008px;\"><h2 class=\"h5\" style=\"font-family: Rubik, sans-serif; font-weight: 500; color: rgb(51, 65, 85); font-size: 1.1725rem;\">Content Liability</h2><p class=\"mb-0\">We shall not be hold responsible for any content that appears on your Website. You agree to protect and defend us against all claims that is rising on your Website. No link(s) should appear on any Website that may be interpreted as libelous, obscene or criminal, or which infringes, otherwise violates, or advocates the infringement or other violation of, any third party rights.</p></div><div class=\"mb-5\" style=\"color: rgb(71, 85, 105); font-family: Jost, sans-serif; font-size: 15.008px;\"><h2 class=\"h5\" style=\"font-family: Rubik, sans-serif; font-weight: 500; color: rgb(51, 65, 85); font-size: 1.1725rem;\">Your Privacy</h2><p class=\"mb-0\">Please read Privacy Policy</p></div><div class=\"mb-5\" style=\"color: rgb(71, 85, 105); font-family: Jost, sans-serif; font-size: 15.008px;\"><h2 class=\"h5\" style=\"font-family: Rubik, sans-serif; font-weight: 500; color: rgb(51, 65, 85); font-size: 1.1725rem;\">Reservation of Rights</h2><p class=\"mb-0\">We reserve the right to request that you remove all links or any particular link to our Website. You approve to immediately remove all links to our Website upon request. We also reserve the right to amen these terms and conditions and it\'s linking policy at any time. By continuously linking to our Website, you agree to be bound to and follow these linking terms and conditions.</p></div><div class=\"mb-5\" style=\"color: rgb(71, 85, 105); font-family: Jost, sans-serif; font-size: 15.008px;\"><h2 class=\"h5\" style=\"font-family: Rubik, sans-serif; font-weight: 500; color: rgb(51, 65, 85); font-size: 1.1725rem;\">Removal of links from our website</h2><p>If you find any link on our Website that is offensive for any reason, you are free to contact and inform us any moment. We will consider requests to remove links but we are not obligated to or so or to respond to you directly.</p><p class=\"mb-0\">We do not ensure that the information on this website is correct, we do not warrant its completeness or accuracy; nor do we promise to ensure that the website remains available or that the material on the website is kept up to date.</p></div><div class=\"content-group\" style=\"color: rgb(71, 85, 105); font-family: Jost, sans-serif; font-size: 15.008px;\"><h2 class=\"h5\" style=\"font-family: Rubik, sans-serif; font-weight: 500; color: rgb(51, 65, 85); font-size: 1.1725rem;\">Disclaimer</h2><p style=\"\">To the maximum extent permitted by applicable law, we exclude all representations, warranties and conditions relating to our website and the use of this website. Nothing in this disclaimer will:</p><ul style=\"\"><li>limit or exclude our or your liability for death or personal injury;</li><li>limit or exclude our or your liability for fraud or fraudulent misrepresentation;</li><li>limit any of our or your liabilities in any way that is not permitted under applicable law; or</li><li>exclude any of our or your liabilities that may not be excluded under applicable law.</li></ul><p style=\"\">The limitations and prohibitions of liability set in this Section and elsewhere in this disclaimer: (a) are subject to the preceding paragraph; and (b) govern all liabilities arising under the disclaimer, including liabilities arising in contract, in tort and for breach of statutory duty.</p><p class=\"mb-0\" style=\"\">As long as the website and the information and services on the website are provided free of charge, we will not be liable for any loss or damage of any nature.</p></div>', 'en', '2023-02-16 00:43:22', '2023-02-28 23:33:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateways`
--

CREATE TABLE `payment_gateways` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gateway` varchar(191) NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `is_recurring` tinyint(1) DEFAULT 0,
  `webhook_id` varchar(191) DEFAULT NULL,
  `sandbox` tinyint(1) DEFAULT 0,
  `type` varchar(191) DEFAULT NULL COMMENT 'sandbox, live',
  `is_active` tinyint(4) DEFAULT 0,
  `is_show` tinyint(4) DEFAULT 1,
  `is_virtual` tinyint(4) DEFAULT 1,
  `service_charge` varchar(191) DEFAULT '0',
  `charge_type` varchar(191) DEFAULT NULL COMMENT '1= flat, 2=percentage',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_gateways`
--

INSERT INTO `payment_gateways` (`id`, `gateway`, `image`, `is_recurring`, `webhook_id`, `sandbox`, `type`, `is_active`, `is_show`, `is_virtual`, `service_charge`, `charge_type`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'paypal', 'Modules/PaymentGateway/Resources/assets/images/payments/paypal.svg', 0, NULL, 1, 'sandbox', 0, 1, 1, '0', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(2, 'stripe', 'Modules/PaymentGateway/Resources/assets/images/payments/stripe.svg', 0, NULL, 1, 'sandbox', 0, 1, 1, '0', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(3, 'paytm', 'Modules/PaymentGateway/Resources/assets/images/payments/paytm.svg', 0, NULL, 1, 'sandbox', 0, 1, 1, '0', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(4, 'razorpay', 'Modules/PaymentGateway/Resources/assets/images/payments/razorpay.svg', 0, NULL, 1, 'sandbox', 0, 1, 1, '0', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(5, 'iyzico', 'Modules/PaymentGateway/Resources/assets/images/payments/iyzico.svg', 0, NULL, 1, 'sandbox', 0, 1, 1, '0', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(6, 'paystack', 'Modules/PaymentGateway/Resources/assets/images/payments/paystack.svg', 0, NULL, 1, 'sandbox', 0, 1, 1, '0', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(7, 'flutterwave', 'Modules/PaymentGateway/Resources/assets/images/payments/flutterwave.svg', 0, NULL, 1, 'sandbox', 0, 1, 1, '0', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(8, 'duitku', 'Modules/PaymentGateway/Resources/assets/images/payments/duitku.svg', 0, NULL, 1, 'sandbox', 0, 1, 1, '0', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(9, 'yookassa', 'Modules/PaymentGateway/Resources/assets/images/payments/yookassa.svg', 0, NULL, 1, 'sandbox', 0, 1, 1, '0', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(10, 'molile', 'Modules/PaymentGateway/Resources/assets/images/payments/molile.svg', 0, NULL, 1, 'sandbox', 0, 1, 1, '0', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(11, 'mercadopago', 'Modules/PaymentGateway/Resources/assets/images/payments/mercadopago.svg', 0, NULL, 1, 'sandbox', 0, 1, 1, '0', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(12, 'midtrans', 'Modules/PaymentGateway/Resources/assets/images/payments/midtrans.svg', 0, NULL, 1, 'sandbox', 0, 1, 1, '0', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(13, 'Offline_payment', 'Modules/PaymentGateway/Resources/assets/images/payments/manual_payment.png', 0, NULL, 1, 'sandbox', 0, 0, 0, '0', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(14, 'Cash_on_Delivery', 'Modules/PaymentGateway/Resources/assets/images/payments/cash_on_delivery.png', 0, NULL, 1, 'sandbox', 1, 1, 0, '0', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32');

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateway_details`
--

CREATE TABLE `payment_gateway_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_gateway_id` bigint(20) NOT NULL,
  `key` varchar(191) DEFAULT NULL,
  `value` varchar(191) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_gateway_details`
--

INSERT INTO `payment_gateway_details` (`id`, `payment_gateway_id`, `key`, `value`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'PAYPAL_CLIENT_ID', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(2, 1, 'PAYPAL_CLIENT_SECRET', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(3, 2, 'STRIPE_KEY', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(4, 2, 'STRIPE_SECRET', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(5, 3, 'PAYTM_ENVIRONMENT', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(6, 3, 'PAYTM_MERCHANT_ID', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(7, 3, 'PAYTM_MERCHANT_KEY', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(8, 3, 'PAYTM_MERCHANT_WEBSITE', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(9, 3, 'PAYTM_CHANNEL', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(10, 3, 'PAYTM_INDUSTRY_TYPE', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(11, 4, 'RAZORPAY_KEY', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(12, 4, 'RAZORPAY_SECRET', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(13, 5, 'IYZICO_API_KEY', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(14, 5, 'IYZICO_SECRET_KEY', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(15, 6, 'PAYSTACK_PUBLIC_KEY', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(16, 6, 'PAYSTACK_SECRET_KEY', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(17, 6, 'MERCHANT_EMAIL', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(18, 6, 'PAYSTACK_CURRENCY_CODE', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(19, 7, 'FLW_PUBLIC_KEY', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(20, 7, 'FLW_SECRET_KEY', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(21, 7, 'FLW_SECRET_HASH', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(22, 8, 'DUITKU_API_KEY', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(23, 8, 'DUITKU_MERCHANT_CODE', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(24, 8, 'DUITKU_CALLBACK_URL', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(25, 8, 'DUITKU_RETURN_URL', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(26, 8, 'DUITKU_ENV', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(27, 9, 'YOOKASSA_SHOP_ID', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(28, 9, 'YOOKASSA_SECRET_KEY', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(29, 9, 'YOOKASSA_CURRENCY_CODE', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(30, 9, 'YOOKASSA_RECIEPT', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(31, 9, 'YOOKASSA_VAT', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(32, 10, 'MOLILE_API_KEY', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(33, 11, 'MERCADOPAGO_SECRET_KEY', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(34, 12, 'MIDTRANS_SERVER_KEY', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32'),
(35, 12, 'MIDTRANS_CLIENT_KEY', NULL, NULL, '2025-05-01 02:27:32', '2025-05-01 02:27:32');

-- --------------------------------------------------------

--
-- Table structure for table `payouts`
--

CREATE TABLE `payouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `instruction` text NOT NULL,
  `status` enum('pending','accepted','rejected') NOT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payrolls`
--

CREATE TABLE `payrolls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `basic_salary` decimal(12,2) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `month` varchar(191) NOT NULL,
  `bonus` text DEFAULT NULL,
  `deduct` text DEFAULT NULL,
  `total_allownce` decimal(12,2) NOT NULL,
  `total_deduction` decimal(12,2) NOT NULL,
  `total_salary` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `group_name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `group_name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'dashboard', 'dashboard', 'web', NULL, NULL),
(2, 'products', 'products', 'web', NULL, NULL),
(3, 'add_products', 'products', 'web', NULL, NULL),
(4, 'edit_products', 'products', 'web', NULL, NULL),
(5, 'publish_products', 'products', 'web', NULL, NULL),
(6, 'categories', 'categories', 'web', NULL, NULL),
(7, 'add_categories', 'categories', 'web', NULL, NULL),
(8, 'edit_categories', 'categories', 'web', NULL, NULL),
(9, 'top_categories', 'categories', 'web', NULL, NULL),
(10, 'delete_categories', 'categories', 'web', NULL, NULL),
(11, 'variations', 'variations', 'web', NULL, NULL),
(12, 'add_variations', 'variations', 'web', NULL, NULL),
(13, 'edit_variations', 'variations', 'web', NULL, NULL),
(14, 'publish_variations', 'variations', 'web', NULL, NULL),
(15, 'variation_values', 'variations', 'web', NULL, NULL),
(16, 'add_variation_values', 'variations', 'web', NULL, NULL),
(17, 'edit_variation_values', 'variations', 'web', NULL, NULL),
(18, 'publish_variation_values', 'variations', 'web', NULL, NULL),
(19, 'brands', 'brands', 'web', NULL, NULL),
(20, 'add_brands', 'brands', 'web', NULL, NULL),
(21, 'edit_brands', 'brands', 'web', NULL, NULL),
(22, 'publish_brands', 'brands', 'web', NULL, NULL),
(23, 'delete_brands', 'brands', 'web', NULL, NULL),
(24, 'units', 'units', 'web', NULL, NULL),
(25, 'add_units', 'units', 'web', NULL, NULL),
(26, 'edit_units', 'units', 'web', NULL, NULL),
(27, 'publish_units', 'units', 'web', NULL, NULL),
(28, 'delete_units', 'units', 'web', NULL, NULL),
(29, 'taxes', 'taxes', 'web', NULL, NULL),
(30, 'add_taxes', 'taxes', 'web', NULL, NULL),
(31, 'edit_taxes', 'taxes', 'web', NULL, NULL),
(32, 'publish_taxes', 'taxes', 'web', NULL, NULL),
(33, 'delete_taxes', 'taxes', 'web', NULL, NULL),
(34, 'orders', 'orders', 'web', NULL, NULL),
(35, 'manage_orders', 'orders', 'web', NULL, NULL),
(36, 'customers', 'customers', 'web', NULL, NULL),
(37, 'ban_customers', 'customers', 'web', NULL, NULL),
(38, 'staffs', 'staffs', 'web', NULL, NULL),
(39, 'add_staffs', 'staffs', 'web', NULL, NULL),
(40, 'edit_staffs', 'staffs', 'web', NULL, NULL),
(41, 'delete_staffs', 'staffs', 'web', NULL, NULL),
(42, 'tags', 'tags', 'web', NULL, NULL),
(43, 'add_tags', 'tags', 'web', NULL, NULL),
(44, 'edit_tags', 'tags', 'web', NULL, NULL),
(45, 'delete_tags', 'tags', 'web', NULL, NULL),
(46, 'pages', 'pages', 'web', NULL, NULL),
(47, 'add_pages', 'pages', 'web', NULL, NULL),
(48, 'edit_pages', 'pages', 'web', NULL, NULL),
(49, 'delete_pages', 'pages', 'web', NULL, NULL),
(50, 'blogs', 'blogs', 'web', NULL, NULL),
(51, 'add_blogs', 'blogs', 'web', NULL, NULL),
(52, 'edit_blogs', 'blogs', 'web', NULL, NULL),
(53, 'publish_blogs', 'blogs', 'web', NULL, NULL),
(54, 'delete_blogs', 'blogs', 'web', NULL, NULL),
(55, 'blog_categories', 'blogs', 'web', NULL, NULL),
(56, 'add_blog_categories', 'blogs', 'web', NULL, NULL),
(57, 'edit_blog_categories', 'blogs', 'web', NULL, NULL),
(58, 'delete_blog_categories', 'blogs', 'web', NULL, NULL),
(59, 'media_manager', 'media_manager', 'web', NULL, NULL),
(60, 'add_media', 'media_manager', 'web', NULL, NULL),
(61, 'delete_media', 'media_manager', 'web', NULL, NULL),
(62, 'newsletters', 'newsletters', 'web', NULL, NULL),
(63, 'subscribers', 'newsletters', 'web', NULL, NULL),
(64, 'delete_subscribers', 'newsletters', 'web', NULL, NULL),
(65, 'coupons', 'coupons', 'web', NULL, NULL),
(66, 'add_coupons', 'coupons', 'web', NULL, NULL),
(67, 'edit_coupons', 'coupons', 'web', NULL, NULL),
(68, 'delete_coupons', 'coupons', 'web', NULL, NULL),
(69, 'campaigns', 'campaigns', 'web', NULL, NULL),
(70, 'add_campaigns', 'campaigns', 'web', NULL, NULL),
(71, 'edit_campaigns', 'campaigns', 'web', NULL, NULL),
(72, 'publish_campaigns', 'campaigns', 'web', NULL, NULL),
(73, 'delete_campaigns', 'campaigns', 'web', NULL, NULL),
(74, 'logistics', 'fulfillment', 'web', NULL, NULL),
(75, 'add_logistics', 'fulfillment', 'web', NULL, NULL),
(76, 'edit_logistics', 'fulfillment', 'web', NULL, NULL),
(77, 'publish_logistics', 'fulfillment', 'web', NULL, NULL),
(78, 'delete_logistics', 'fulfillment', 'web', NULL, NULL),
(79, 'shipping_zones', 'fulfillment', 'web', NULL, NULL),
(80, 'add_shipping_zones', 'fulfillment', 'web', NULL, NULL),
(81, 'edit_shipping_zones', 'fulfillment', 'web', NULL, NULL),
(82, 'delete_shipping_zones', 'fulfillment', 'web', NULL, NULL),
(83, 'shipping_cities', 'fulfillment', 'web', NULL, NULL),
(84, 'add_shipping_cities', 'fulfillment', 'web', NULL, NULL),
(85, 'edit_shipping_cities', 'fulfillment', 'web', NULL, NULL),
(86, 'publish_shipping_cities', 'fulfillment', 'web', NULL, NULL),
(87, 'shipping_states', 'fulfillment', 'web', NULL, NULL),
(88, 'add_shipping_states', 'fulfillment', 'web', NULL, NULL),
(89, 'edit_shipping_states', 'fulfillment', 'web', NULL, NULL),
(90, 'publish_shipping_states', 'fulfillment', 'web', NULL, NULL),
(91, 'shipping_countries', 'fulfillment', 'web', NULL, NULL),
(92, 'publish_shipping_countries', 'fulfillment', 'web', NULL, NULL),
(93, 'contact_us_messages', 'contact_us_messages', 'web', NULL, NULL),
(94, 'homepage', 'appearance', 'web', NULL, NULL),
(95, 'product_page', 'appearance', 'web', NULL, NULL),
(96, 'product_details_page', 'appearance', 'web', NULL, NULL),
(97, 'about_us_page', 'appearance', 'web', NULL, NULL),
(98, 'header', 'appearance', 'web', NULL, NULL),
(99, 'footer', 'appearance', 'web', NULL, NULL),
(100, 'roles_and_permissions', 'roles_and_permissions', 'web', NULL, NULL),
(101, 'add_roles_and_permissions', 'roles_and_permissions', 'web', NULL, NULL),
(102, 'edit_roles_and_permissions', 'roles_and_permissions', 'web', NULL, NULL),
(103, 'delete_roles_and_permissions', 'roles_and_permissions', 'web', NULL, NULL),
(104, 'smtp_settings', 'system_settings', 'web', NULL, NULL),
(105, 'general_settings', 'system_settings', 'web', NULL, NULL),
(106, 'currency_settings', 'system_settings', 'web', NULL, NULL),
(107, 'add_currency', 'system_settings', 'web', NULL, NULL),
(108, 'edit_currency', 'system_settings', 'web', NULL, NULL),
(109, 'publish_currency', 'system_settings', 'web', NULL, NULL),
(110, 'language_settings', 'system_settings', 'web', NULL, NULL),
(111, 'add_languages', 'system_settings', 'web', NULL, NULL),
(112, 'edit_languages', 'system_settings', 'web', NULL, NULL),
(113, 'publish_languages', 'system_settings', 'web', NULL, NULL),
(114, 'translate_languages', 'system_settings', 'web', NULL, NULL),
(115, 'order_settings', 'system_settings', 'web', NULL, NULL),
(116, 'payment_settings', 'system_settings', 'web', NULL, NULL),
(117, 'order_reports', 'reports', 'web', NULL, NULL),
(118, 'product_sale_reports', 'reports', 'web', NULL, NULL),
(119, 'category_sale_reports', 'reports', 'web', NULL, NULL),
(120, 'sales_amount_reports', 'reports', 'web', NULL, NULL),
(121, 'delivery_status_reports', 'reports', 'web', NULL, NULL),
(122, 'default_language', 'system_settings', 'web', NULL, NULL),
(123, 'default_currency', 'system_settings', 'web', NULL, NULL),
(124, 'add_stock', 'manage_stock', 'web', NULL, NULL),
(125, 'show_locations', 'manage_stock', 'web', NULL, NULL),
(126, 'add_location', 'manage_stock', 'web', NULL, NULL),
(127, 'edit_location', 'manage_stock', 'web', NULL, NULL),
(128, 'publish_locations', 'manage_stock', 'web', NULL, NULL),
(129, 'pos', 'pos', 'web', NULL, NULL),
(130, 'social_login_settings', 'system_settings', 'web', NULL, NULL),
(131, 'auth_settings', 'system_settings', 'web', NULL, NULL),
(132, 'otp_settings', 'system_settings', 'web', NULL, NULL),
(133, 'reward_configurations', 'rewards_and_wallet', 'web', NULL, NULL),
(134, 'set_reward_points', 'rewards_and_wallet', 'web', NULL, NULL),
(135, 'wallet_configurations', 'rewards_and_wallet', 'web', NULL, NULL),
(136, 'refund_configurations', 'refunds', 'web', NULL, NULL),
(137, 'refund_requests', 'refunds', 'web', NULL, NULL),
(138, 'approved_refunds', 'refunds', 'web', NULL, NULL),
(139, 'rejected_refunds', 'refunds', 'web', NULL, NULL),
(140, 'own_staff', 'staffs', 'web', NULL, NULL),
(141, 'delete_variations', 'variations', 'web', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `priorities`
--

CREATE TABLE `priorities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `user_id` int(11) DEFAULT NULL,
  `color` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `priorities`
--

INSERT INTO `priorities` (`id`, `name`, `is_active`, `user_id`, `color`, `created_at`, `updated_at`) VALUES
(1, 'High', 1, 1, '#e11414', '2025-05-01 02:27:19', '2025-05-01 02:27:19'),
(2, 'Low', 1, 1, '#528118', '2025-05-01 02:27:19', '2025-05-01 02:27:19');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED DEFAULT NULL,
  `added_by` varchar(191) NOT NULL DEFAULT 'admin',
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `unit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `thumbnail_image` bigint(20) UNSIGNED DEFAULT NULL,
  `gallery_images` longtext DEFAULT NULL,
  `product_tags` longtext DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `price` double NOT NULL DEFAULT 0,
  `min_price` double NOT NULL DEFAULT 0,
  `max_price` double NOT NULL DEFAULT 0,
  `discount_value` double NOT NULL DEFAULT 0,
  `discount_type` varchar(191) DEFAULT NULL,
  `discount_start_date` int(11) DEFAULT NULL,
  `discount_end_date` int(11) DEFAULT NULL,
  `sell_target` int(11) DEFAULT NULL,
  `stock_qty` int(11) NOT NULL DEFAULT 0,
  `is_published` tinyint(4) NOT NULL DEFAULT 0,
  `is_featured` tinyint(4) NOT NULL DEFAULT 0,
  `min_purchase_qty` int(11) NOT NULL DEFAULT 1,
  `max_purchase_qty` int(11) NOT NULL DEFAULT 1,
  `has_variation` tinyint(4) NOT NULL DEFAULT 1,
  `has_warranty` tinyint(4) NOT NULL DEFAULT 1,
  `total_sale_count` double NOT NULL DEFAULT 0,
  `standard_delivery_hours` int(11) NOT NULL DEFAULT 24,
  `express_delivery_hours` int(11) NOT NULL DEFAULT 24,
  `size_guide` text DEFAULT NULL,
  `meta_title` mediumtext DEFAULT NULL,
  `meta_description` longtext DEFAULT NULL,
  `meta_img` bigint(20) UNSIGNED DEFAULT NULL,
  `reward_points` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `vedio_link` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `is_import` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_colors`
--

CREATE TABLE `product_colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `variation_value_id` bigint(20) UNSIGNED NOT NULL,
  `image` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_localizations`
--

CREATE TABLE `product_localizations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `lang_key` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_tags`
--

CREATE TABLE `product_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_taxes`
--

CREATE TABLE `product_taxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `tax_id` bigint(20) UNSIGNED NOT NULL,
  `tax_value` double NOT NULL DEFAULT 0,
  `tax_type` varchar(191) NOT NULL DEFAULT 'amount' COMMENT 'flat / percent',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_themes`
--

CREATE TABLE `product_themes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `theme_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_variations`
--

CREATE TABLE `product_variations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `variation_key` varchar(191) DEFAULT NULL,
  `sku` varchar(191) DEFAULT NULL,
  `code` varchar(191) DEFAULT NULL,
  `price` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_variation_combinations`
--

CREATE TABLE `product_variation_combinations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_variation_id` bigint(20) UNSIGNED NOT NULL,
  `variation_id` bigint(20) UNSIGNED NOT NULL,
  `variation_value_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_variation_stocks`
--

CREATE TABLE `product_variation_stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_variation_id` bigint(20) UNSIGNED NOT NULL,
  `location_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'warehouse/location',
  `stock_qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `refunds`
--

CREATE TABLE `refunds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_group_id` bigint(20) UNSIGNED NOT NULL,
  `order_item_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `order_payment_status` varchar(191) DEFAULT NULL,
  `refund_reason` longtext DEFAULT NULL,
  `refund_reject_reason` longtext DEFAULT NULL,
  `refund_status` varchar(191) NOT NULL DEFAULT 'pending' COMMENT 'refunded/rejected',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reply_tickets`
--

CREATE TABLE `reply_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `replied` text DEFAULT NULL,
  `replied_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `file_path` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reward_points`
--

CREATE TABLE `reward_points` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_group_id` bigint(20) UNSIGNED NOT NULL,
  `total_points` bigint(20) NOT NULL DEFAULT 0,
  `is_converted` tinyint(4) NOT NULL DEFAULT 0,
  `status` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_system` tinyint(1) DEFAULT 0,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `is_delete` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `is_system`, `is_active`, `created_by`, `updated_by`, `is_delete`) VALUES
(1, 'Super Admin', 'web', NULL, NULL, 0, 1, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scheduled_delivery_time_lists`
--

CREATE TABLE `scheduled_delivery_time_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `timeline` text NOT NULL,
  `sorting_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_approved` tinyint(4) NOT NULL DEFAULT 0,
  `is_verified_by_admin` tinyint(4) NOT NULL DEFAULT 0,
  `is_published` tinyint(4) NOT NULL DEFAULT 0,
  `shop_logo` bigint(20) UNSIGNED DEFAULT NULL,
  `shop_name` varchar(191) NOT NULL,
  `slug` text NOT NULL,
  `shop_rating` double NOT NULL DEFAULT 0,
  `shop_address` longtext DEFAULT NULL,
  `min_order_amount` double NOT NULL DEFAULT 0,
  `admin_commission_percentage` double NOT NULL DEFAULT 0,
  `current_balance` double NOT NULL DEFAULT 0,
  `is_cash_payout` tinyint(4) NOT NULL DEFAULT 0,
  `is_bank_payout` tinyint(4) NOT NULL DEFAULT 0,
  `bank_name` varchar(191) DEFAULT NULL,
  `bank_acc_name` varchar(191) DEFAULT NULL,
  `bank_acc_no` varchar(191) DEFAULT NULL,
  `bank_routing_no` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `user_id`, `is_approved`, `is_verified_by_admin`, `is_published`, `shop_logo`, `shop_name`, `slug`, `shop_rating`, `shop_address`, `min_order_amount`, `admin_commission_percentage`, `current_balance`, `is_cash_payout`, `is_bank_payout`, `bank_name`, `bank_acc_name`, `bank_acc_no`, `bank_routing_no`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, 1, NULL, 'Admin Shop', 'admin-shop', 5, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `country_id`, `name`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 101, 'Andaman and Nicobar Islands', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:20', NULL),
(2, 101, 'Andhra Pradesh', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3, 101, 'Arunachal Pradesh', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4, 101, 'Assam', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(5, 101, 'Bihar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(6, 101, 'Chandigarh', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(7, 101, 'Chhattisgarh', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(8, 101, 'Dadra and Nagar Haveli', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(9, 101, 'Daman and Diu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(10, 101, 'Delhi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(11, 101, 'Goa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(12, 101, 'Gujarat', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(13, 101, 'Haryana', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(14, 101, 'Himachal Pradesh', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(15, 101, 'Jammu and Kashmir', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(16, 101, 'Jharkhand', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(17, 101, 'Karnataka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(18, 101, 'Kenmore', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(19, 101, 'Kerala', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(20, 101, 'Lakshadweep', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(21, 101, 'Madhya Pradesh', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(22, 101, 'Maharashtra', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(23, 101, 'Manipur', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(24, 101, 'Meghalaya', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(25, 101, 'Mizoram', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(26, 101, 'Nagaland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(27, 101, 'Narora', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(28, 101, 'Natwar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(29, 101, 'Odisha', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(30, 101, 'Paschim Medinipur', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(31, 101, 'Pondicherry', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(32, 101, 'Punjab', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(33, 101, 'Rajasthan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(34, 101, 'Sikkim', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(35, 101, 'Tamil Nadu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(36, 101, 'Telangana', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(37, 101, 'Tripura', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(38, 101, 'Uttar Pradesh', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(39, 101, 'Uttarakhand', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(40, 101, 'Vaishali', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(41, 101, 'West Bengal', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(42, 1, 'Badakhshan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(43, 1, 'Badgis', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(44, 1, 'Baglan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(45, 1, 'Balkh', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(46, 1, 'Bamiyan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(47, 1, 'Farah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(48, 1, 'Faryab', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(49, 1, 'Gawr', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(50, 1, 'Gazni', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(51, 1, 'Herat', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(52, 1, 'Hilmand', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(53, 1, 'Jawzjan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(54, 1, 'Kabul', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(55, 1, 'Kapisa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(56, 1, 'Khawst', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(57, 1, 'Kunar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(58, 1, 'Lagman', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(59, 1, 'Lawghar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(60, 1, 'Nangarhar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(61, 1, 'Nimruz', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(62, 1, 'Nuristan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(63, 1, 'Paktika', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(64, 1, 'Paktiya', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(65, 1, 'Parwan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(66, 1, 'Qandahar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(67, 1, 'Qunduz', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(68, 1, 'Samangan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(69, 1, 'Sar-e Pul', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(70, 1, 'Takhar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(71, 1, 'Uruzgan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(72, 1, 'Wardag', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(73, 1, 'Zabul', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(74, 2, 'Berat', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(75, 2, 'Bulqize', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(76, 2, 'Delvine', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(77, 2, 'Devoll', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(78, 2, 'Dibre', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(79, 2, 'Durres', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(80, 2, 'Elbasan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(81, 2, 'Fier', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(82, 2, 'Gjirokaster', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(83, 2, 'Gramsh', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(84, 2, 'Has', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(85, 2, 'Kavaje', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(86, 2, 'Kolonje', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(87, 2, 'Korce', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(88, 2, 'Kruje', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(89, 2, 'Kucove', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(90, 2, 'Kukes', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(91, 2, 'Kurbin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(92, 2, 'Lezhe', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(93, 2, 'Librazhd', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(94, 2, 'Lushnje', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(95, 2, 'Mallakaster', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(96, 2, 'Malsi e Madhe', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(97, 2, 'Mat', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(98, 2, 'Mirdite', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(99, 2, 'Peqin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(100, 2, 'Permet', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(101, 2, 'Pogradec', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(102, 2, 'Puke', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(103, 2, 'Sarande', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(104, 2, 'Shkoder', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(105, 2, 'Skrapar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(106, 2, 'Tepelene', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(107, 2, 'Tirane', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(108, 2, 'Tropoje', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(109, 2, 'Vlore', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(110, 3, '\'Ayn Daflah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(111, 3, '\'Ayn Tamushanat', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(112, 3, 'Adrar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(113, 3, 'Algiers', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(114, 3, 'Annabah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(115, 3, 'Bashshar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(116, 3, 'Batnah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(117, 3, 'Bijayah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(118, 3, 'Biskrah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(119, 3, 'Blidah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(120, 3, 'Buirah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(121, 3, 'Bumardas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(122, 3, 'Burj Bu Arririj', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(123, 3, 'Ghalizan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(124, 3, 'Ghardayah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(125, 3, 'Ilizi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(126, 3, 'Jijili', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(127, 3, 'Jilfah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(128, 3, 'Khanshalah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(129, 3, 'Masilah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(130, 3, 'Midyah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(131, 3, 'Milah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(132, 3, 'Muaskar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(133, 3, 'Mustaghanam', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(134, 3, 'Naama', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(135, 3, 'Oran', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(136, 3, 'Ouargla', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(137, 3, 'Qalmah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(138, 3, 'Qustantinah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(139, 3, 'Sakikdah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(140, 3, 'Satif', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(141, 3, 'Sayda\'', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(142, 3, 'Sidi ban-al-\'Abbas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(143, 3, 'Suq Ahras', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(144, 3, 'Tamanghasat', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(145, 3, 'Tibazah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(146, 3, 'Tibissah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(147, 3, 'Tilimsan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(148, 3, 'Tinduf', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(149, 3, 'Tisamsilt', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(150, 3, 'Tiyarat', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(151, 3, 'Tizi Wazu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(152, 3, 'Umm-al-Bawaghi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(153, 3, 'Wahran', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(154, 3, 'Warqla', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(155, 3, 'Wilaya d Alger', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(156, 3, 'Wilaya de Bejaia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(157, 3, 'Wilaya de Constantine', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(158, 3, 'al-Aghwat', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(159, 3, 'al-Bayadh', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(160, 3, 'al-Jaza\'ir', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(161, 3, 'al-Wad', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(162, 3, 'ash-Shalif', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(163, 3, 'at-Tarif', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(164, 4, 'Eastern', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(165, 4, 'Manu\'a', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(166, 4, 'Swains Island', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(167, 4, 'Western', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(168, 5, 'Andorra la Vella', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(169, 5, 'Canillo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(170, 5, 'Encamp', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(171, 5, 'La Massana', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(172, 5, 'Les Escaldes', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(173, 5, 'Ordino', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(174, 5, 'Sant Julia de Loria', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(175, 6, 'Bengo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(176, 6, 'Benguela', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(177, 6, 'Bie', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(178, 6, 'Cabinda', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(179, 6, 'Cunene', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(180, 6, 'Huambo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(181, 6, 'Huila', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(182, 6, 'Kuando-Kubango', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(183, 6, 'Kwanza Norte', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(184, 6, 'Kwanza Sul', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(185, 6, 'Luanda', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(186, 6, 'Lunda Norte', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(187, 6, 'Lunda Sul', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(188, 6, 'Malanje', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(189, 6, 'Moxico', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(190, 6, 'Namibe', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(191, 6, 'Uige', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(192, 6, 'Zaire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(193, 7, 'Other Provinces', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(194, 8, 'Sector claimed by Argentina/Ch', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(195, 8, 'Sector claimed by Argentina/UK', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(196, 8, 'Sector claimed by Australia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(197, 8, 'Sector claimed by France', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(198, 8, 'Sector claimed by New Zealand', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(199, 8, 'Sector claimed by Norway', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(200, 8, 'Unclaimed Sector', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(201, 9, 'Barbuda', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(202, 9, 'Saint George', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(203, 9, 'Saint John', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(204, 9, 'Saint Mary', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(205, 9, 'Saint Paul', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(206, 9, 'Saint Peter', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(207, 9, 'Saint Philip', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(208, 10, 'Buenos Aires', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(209, 10, 'Catamarca', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(210, 10, 'Chaco', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(211, 10, 'Chubut', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(212, 10, 'Cordoba', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(213, 10, 'Corrientes', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(214, 10, 'Distrito Federal', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(215, 10, 'Entre Rios', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(216, 10, 'Formosa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(217, 10, 'Jujuy', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(218, 10, 'La Pampa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(219, 10, 'La Rioja', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(220, 10, 'Mendoza', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(221, 10, 'Misiones', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(222, 10, 'Neuquen', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(223, 10, 'Rio Negro', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(224, 10, 'Salta', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(225, 10, 'San Juan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(226, 10, 'San Luis', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(227, 10, 'Santa Cruz', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(228, 10, 'Santa Fe', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(229, 10, 'Santiago del Estero', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(230, 10, 'Tierra del Fuego', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(231, 10, 'Tucuman', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(232, 11, 'Aragatsotn', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(233, 11, 'Ararat', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(234, 11, 'Armavir', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(235, 11, 'Gegharkunik', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(236, 11, 'Kotaik', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(237, 11, 'Lori', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(238, 11, 'Shirak', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(239, 11, 'Stepanakert', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(240, 11, 'Syunik', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(241, 11, 'Tavush', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(242, 11, 'Vayots Dzor', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(243, 11, 'Yerevan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(244, 12, 'Aruba', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(245, 13, 'Auckland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(246, 13, 'Australian Capital Territory', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(247, 13, 'Balgowlah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(248, 13, 'Balmain', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(249, 13, 'Bankstown', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(250, 13, 'Baulkham Hills', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(251, 13, 'Bonnet Bay', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(252, 13, 'Camberwell', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(253, 13, 'Carole Park', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(254, 13, 'Castle Hill', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(255, 13, 'Caulfield', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(256, 13, 'Chatswood', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(257, 13, 'Cheltenham', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(258, 13, 'Cherrybrook', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(259, 13, 'Clayton', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(260, 13, 'Collingwood', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(261, 13, 'Frenchs Forest', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(262, 13, 'Hawthorn', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(263, 13, 'Jannnali', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(264, 13, 'Knoxfield', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(265, 13, 'Melbourne', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(266, 13, 'New South Wales', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(267, 13, 'Northern Territory', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(268, 13, 'Perth', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(269, 13, 'Queensland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(270, 13, 'South Australia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(271, 13, 'Tasmania', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(272, 13, 'Templestowe', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(273, 13, 'Victoria', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(274, 13, 'Werribee south', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(275, 13, 'Western Australia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(276, 13, 'Wheeler', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(277, 14, 'Bundesland Salzburg', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(278, 14, 'Bundesland Steiermark', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(279, 14, 'Bundesland Tirol', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(280, 14, 'Burgenland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(281, 14, 'Carinthia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(282, 14, 'Karnten', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(283, 14, 'Liezen', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(284, 14, 'Lower Austria', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(285, 14, 'Niederosterreich', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(286, 14, 'Oberosterreich', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(287, 14, 'Salzburg', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(288, 14, 'Schleswig-Holstein', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(289, 14, 'Steiermark', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(290, 14, 'Styria', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(291, 14, 'Tirol', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(292, 14, 'Upper Austria', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(293, 14, 'Vorarlberg', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(294, 14, 'Wien', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(295, 15, 'Abseron', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(296, 15, 'Baki Sahari', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(297, 15, 'Ganca', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(298, 15, 'Ganja', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(299, 15, 'Kalbacar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(300, 15, 'Lankaran', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(301, 15, 'Mil-Qarabax', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(302, 15, 'Mugan-Salyan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(303, 15, 'Nagorni-Qarabax', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(304, 15, 'Naxcivan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(305, 15, 'Priaraks', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(306, 15, 'Qazax', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(307, 15, 'Saki', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(308, 15, 'Sirvan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(309, 15, 'Xacmaz', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(310, 16, 'Abaco', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(311, 16, 'Acklins Island', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(312, 16, 'Andros', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(313, 16, 'Berry Islands', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(314, 16, 'Biminis', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(315, 16, 'Cat Island', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(316, 16, 'Crooked Island', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(317, 16, 'Eleuthera', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(318, 16, 'Exuma and Cays', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(319, 16, 'Grand Bahama', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(320, 16, 'Inagua Islands', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(321, 16, 'Long Island', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(322, 16, 'Mayaguana', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(323, 16, 'New Providence', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(324, 16, 'Ragged Island', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(325, 16, 'Rum Cay', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(326, 16, 'San Salvador', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(327, 17, '\'Isa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(328, 17, 'Badiyah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(329, 17, 'Hidd', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(330, 17, 'Jidd Hafs', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(331, 17, 'Mahama', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(332, 17, 'Manama', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(333, 17, 'Sitrah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(334, 17, 'al-Manamah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(335, 17, 'al-Muharraq', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(336, 17, 'ar-Rifa\'a', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(337, 18, 'Bagar Hat', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:11', NULL),
(338, 18, 'Bandarban', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:11', NULL),
(339, 18, 'Barguna', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:11', NULL),
(340, 18, 'Barisal', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:11', NULL),
(341, 18, 'Bhola', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:11', NULL),
(342, 18, 'Bogora', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:11', NULL),
(343, 18, 'Brahman Bariya', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:11', NULL),
(344, 18, 'Chandpur', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:11', NULL),
(345, 18, 'Chattagam', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:11', NULL),
(346, 18, 'Chittagong Division', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(347, 18, 'Chuadanga', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(348, 18, 'Dhaka', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(349, 18, 'Dinajpur', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(350, 18, 'Faridpur', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(351, 18, 'Feni', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(352, 18, 'Gaybanda', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(353, 18, 'Gazipur', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(354, 18, 'Gopalganj', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(355, 18, 'Habiganj', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(356, 18, 'Jaipur Hat', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(357, 18, 'Jamalpur', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(358, 18, 'Jessor', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(359, 18, 'Jhalakati', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(360, 18, 'Jhanaydah', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(361, 18, 'Khagrachhari', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(362, 18, 'Khulna', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(363, 18, 'Kishorganj', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(364, 18, 'Koks Bazar', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(365, 18, 'Komilla', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(366, 18, 'Kurigram', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(367, 18, 'Kushtiya', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(368, 18, 'Lakshmipur', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(369, 18, 'Lalmanir Hat', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(370, 18, 'Madaripur', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(371, 18, 'Magura', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(372, 18, 'Maimansingh', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(373, 18, 'Manikganj', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(374, 18, 'Maulvi Bazar', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(375, 18, 'Meherpur', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(376, 18, 'Munshiganj', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(377, 18, 'Naral', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(378, 18, 'Narayanganj', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(379, 18, 'Narsingdi', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(380, 18, 'Nator', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(381, 18, 'Naugaon', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(382, 18, 'Nawabganj', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(383, 18, 'Netrakona', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(384, 18, 'Nilphamari', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(385, 18, 'Noakhali', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(386, 18, 'Pabna', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(387, 18, 'Panchagarh', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(388, 18, 'Patuakhali', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(389, 18, 'Pirojpur', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(390, 18, 'Rajbari', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(391, 18, 'Rajshahi', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(392, 18, 'Rangamati', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(393, 18, 'Rangpur', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(394, 18, 'Satkhira', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(395, 18, 'Shariatpur', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(396, 18, 'Sherpur', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(397, 18, 'Silhat', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(398, 18, 'Sirajganj', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(399, 18, 'Sunamganj', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(400, 18, 'Tangayal', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(401, 18, 'Thakurgaon', 0, '2021-04-06 07:26:20', '2021-09-28 02:31:12', NULL),
(402, 19, 'Christ Church', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(403, 19, 'Saint Andrew', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(404, 19, 'Saint George', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(405, 19, 'Saint James', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(406, 19, 'Saint John', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(407, 19, 'Saint Joseph', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(408, 19, 'Saint Lucy', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(409, 19, 'Saint Michael', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(410, 19, 'Saint Peter', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(411, 19, 'Saint Philip', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(412, 19, 'Saint Thomas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(413, 20, 'Brest', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(414, 20, 'Homjel\'', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(415, 20, 'Hrodna', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(416, 20, 'Mahiljow', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(417, 20, 'Mahilyowskaya Voblasts', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(418, 20, 'Minsk', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(419, 20, 'Minskaja Voblasts\'', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(420, 20, 'Petrik', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(421, 20, 'Vicebsk', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(422, 21, 'Antwerpen', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(423, 21, 'Berchem', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(424, 21, 'Brabant', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(425, 21, 'Brabant Wallon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(426, 21, 'Brussel', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(427, 21, 'East Flanders', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(428, 21, 'Hainaut', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(429, 21, 'Liege', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(430, 21, 'Limburg', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(431, 21, 'Luxembourg', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(432, 21, 'Namur', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(433, 21, 'Ontario', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(434, 21, 'Oost-Vlaanderen', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(435, 21, 'Provincie Brabant', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(436, 21, 'Vlaams-Brabant', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(437, 21, 'Wallonne', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(438, 21, 'West-Vlaanderen', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(439, 22, 'Belize', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(440, 22, 'Cayo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(441, 22, 'Corozal', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(442, 22, 'Orange Walk', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(443, 22, 'Stann Creek', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(444, 22, 'Toledo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(445, 23, 'Alibori', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(446, 23, 'Atacora', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(447, 23, 'Atlantique', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(448, 23, 'Borgou', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(449, 23, 'Collines', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(450, 23, 'Couffo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(451, 23, 'Donga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(452, 23, 'Littoral', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(453, 23, 'Mono', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(454, 23, 'Oueme', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(455, 23, 'Plateau', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(456, 23, 'Zou', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(457, 24, 'Hamilton', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(458, 24, 'Saint George', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(459, 25, 'Bumthang', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(460, 25, 'Chhukha', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(461, 25, 'Chirang', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(462, 25, 'Daga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(463, 25, 'Geylegphug', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(464, 25, 'Ha', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(465, 25, 'Lhuntshi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(466, 25, 'Mongar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(467, 25, 'Pemagatsel', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(468, 25, 'Punakha', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(469, 25, 'Rinpung', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(470, 25, 'Samchi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(471, 25, 'Samdrup Jongkhar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(472, 25, 'Shemgang', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(473, 25, 'Tashigang', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(474, 25, 'Timphu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(475, 25, 'Tongsa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(476, 25, 'Wangdiphodrang', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(477, 26, 'Beni', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(478, 26, 'Chuquisaca', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(479, 26, 'Cochabamba', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(480, 26, 'La Paz', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(481, 26, 'Oruro', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(482, 26, 'Pando', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(483, 26, 'Potosi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(484, 26, 'Santa Cruz', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(485, 26, 'Tarija', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(486, 27, 'Federacija Bosna i Hercegovina', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(487, 27, 'Republika Srpska', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(488, 28, 'Central Bobonong', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(489, 28, 'Central Boteti', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(490, 28, 'Central Mahalapye', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(491, 28, 'Central Serowe-Palapye', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(492, 28, 'Central Tutume', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(493, 28, 'Chobe', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(494, 28, 'Francistown', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(495, 28, 'Gaborone', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(496, 28, 'Ghanzi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(497, 28, 'Jwaneng', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(498, 28, 'Kgalagadi North', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(499, 28, 'Kgalagadi South', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(500, 28, 'Kgatleng', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(501, 28, 'Kweneng', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(502, 28, 'Lobatse', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(503, 28, 'Ngamiland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(504, 28, 'Ngwaketse', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(505, 28, 'North East', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(506, 28, 'Okavango', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(507, 28, 'Orapa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(508, 28, 'Selibe Phikwe', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(509, 28, 'South East', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(510, 28, 'Sowa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(511, 29, 'Bouvet Island', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(512, 30, 'Acre', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(513, 30, 'Alagoas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(514, 30, 'Amapa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(515, 30, 'Amazonas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(516, 30, 'Bahia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(517, 30, 'Ceara', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(518, 30, 'Distrito Federal', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(519, 30, 'Espirito Santo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(520, 30, 'Estado de Sao Paulo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(521, 30, 'Goias', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(522, 30, 'Maranhao', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(523, 30, 'Mato Grosso', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(524, 30, 'Mato Grosso do Sul', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(525, 30, 'Minas Gerais', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(526, 30, 'Para', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(527, 30, 'Paraiba', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(528, 30, 'Parana', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(529, 30, 'Pernambuco', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(530, 30, 'Piaui', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(531, 30, 'Rio Grande do Norte', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(532, 30, 'Rio Grande do Sul', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(533, 30, 'Rio de Janeiro', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(534, 30, 'Rondonia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(535, 30, 'Roraima', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(536, 30, 'Santa Catarina', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(537, 30, 'Sao Paulo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(538, 30, 'Sergipe', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(539, 30, 'Tocantins', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(540, 31, 'British Indian Ocean Territory', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(541, 32, 'Belait', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(542, 32, 'Brunei-Muara', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(543, 32, 'Temburong', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(544, 32, 'Tutong', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(545, 33, 'Blagoevgrad', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(546, 33, 'Burgas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(547, 33, 'Dobrich', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(548, 33, 'Gabrovo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(549, 33, 'Haskovo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(550, 33, 'Jambol', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(551, 33, 'Kardzhali', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(552, 33, 'Kjustendil', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(553, 33, 'Lovech', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(554, 33, 'Montana', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(555, 33, 'Oblast Sofiya-Grad', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(556, 33, 'Pazardzhik', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(557, 33, 'Pernik', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(558, 33, 'Pleven', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(559, 33, 'Plovdiv', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(560, 33, 'Razgrad', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(561, 33, 'Ruse', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(562, 33, 'Shumen', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(563, 33, 'Silistra', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(564, 33, 'Sliven', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(565, 33, 'Smoljan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(566, 33, 'Sofija grad', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(567, 33, 'Sofijska oblast', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(568, 33, 'Stara Zagora', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(569, 33, 'Targovishte', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(570, 33, 'Varna', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(571, 33, 'Veliko Tarnovo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(572, 33, 'Vidin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(573, 33, 'Vraca', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(574, 33, 'Yablaniza', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(575, 34, 'Bale', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(576, 34, 'Bam', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(577, 34, 'Bazega', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(578, 34, 'Bougouriba', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(579, 34, 'Boulgou', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(580, 34, 'Boulkiemde', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(581, 34, 'Comoe', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(582, 34, 'Ganzourgou', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(583, 34, 'Gnagna', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(584, 34, 'Gourma', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(585, 34, 'Houet', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(586, 34, 'Ioba', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(587, 34, 'Kadiogo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(588, 34, 'Kenedougou', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(589, 34, 'Komandjari', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(590, 34, 'Kompienga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(591, 34, 'Kossi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(592, 34, 'Kouritenga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(593, 34, 'Kourweogo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(594, 34, 'Leraba', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(595, 34, 'Mouhoun', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(596, 34, 'Nahouri', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(597, 34, 'Namentenga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(598, 34, 'Noumbiel', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(599, 34, 'Oubritenga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(600, 34, 'Oudalan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(601, 34, 'Passore', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(602, 34, 'Poni', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(603, 34, 'Sanguie', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(604, 34, 'Sanmatenga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(605, 34, 'Seno', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(606, 34, 'Sissili', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(607, 34, 'Soum', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(608, 34, 'Sourou', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(609, 34, 'Tapoa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(610, 34, 'Tuy', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(611, 34, 'Yatenga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(612, 34, 'Zondoma', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(613, 34, 'Zoundweogo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(614, 35, 'Bubanza', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(615, 35, 'Bujumbura', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(616, 35, 'Bururi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(617, 35, 'Cankuzo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(618, 35, 'Cibitoke', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(619, 35, 'Gitega', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(620, 35, 'Karuzi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(621, 35, 'Kayanza', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(622, 35, 'Kirundo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(623, 35, 'Makamba', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(624, 35, 'Muramvya', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(625, 35, 'Muyinga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(626, 35, 'Ngozi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(627, 35, 'Rutana', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(628, 35, 'Ruyigi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(629, 36, 'Banteay Mean Chey', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(630, 36, 'Bat Dambang', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(631, 36, 'Kampong Cham', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(632, 36, 'Kampong Chhnang', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(633, 36, 'Kampong Spoeu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(634, 36, 'Kampong Thum', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(635, 36, 'Kampot', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(636, 36, 'Kandal', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(637, 36, 'Kaoh Kong', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(638, 36, 'Kracheh', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(639, 36, 'Krong Kaeb', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(640, 36, 'Krong Pailin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(641, 36, 'Krong Preah Sihanouk', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(642, 36, 'Mondol Kiri', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(643, 36, 'Otdar Mean Chey', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(644, 36, 'Phnum Penh', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(645, 36, 'Pousat', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(646, 36, 'Preah Vihear', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(647, 36, 'Prey Veaeng', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(648, 36, 'Rotanak Kiri', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(649, 36, 'Siem Reab', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(650, 36, 'Stueng Traeng', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL);
INSERT INTO `states` (`id`, `country_id`, `name`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(651, 36, 'Svay Rieng', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(652, 36, 'Takaev', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(653, 37, 'Adamaoua', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(654, 37, 'Centre', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(655, 37, 'Est', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(656, 37, 'Littoral', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(657, 37, 'Nord', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(658, 37, 'Nord Extreme', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(659, 37, 'Nordouest', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(660, 37, 'Ouest', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(661, 37, 'Sud', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(662, 37, 'Sudouest', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(663, 38, 'Alberta', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(664, 38, 'British Columbia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(665, 38, 'Manitoba', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(666, 38, 'New Brunswick', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(667, 38, 'Newfoundland and Labrador', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(668, 38, 'Northwest Territories', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(669, 38, 'Nova Scotia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(670, 38, 'Nunavut', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(671, 38, 'Ontario', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(672, 38, 'Prince Edward Island', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(673, 38, 'Quebec', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(674, 38, 'Saskatchewan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(675, 38, 'Yukon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(676, 39, 'Boavista', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(677, 39, 'Brava', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(678, 39, 'Fogo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(679, 39, 'Maio', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(680, 39, 'Sal', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(681, 39, 'Santo Antao', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(682, 39, 'Sao Nicolau', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(683, 39, 'Sao Tiago', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(684, 39, 'Sao Vicente', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(685, 40, 'Grand Cayman', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(686, 41, 'Bamingui-Bangoran', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(687, 41, 'Bangui', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(688, 41, 'Basse-Kotto', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(689, 41, 'Haut-Mbomou', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(690, 41, 'Haute-Kotto', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(691, 41, 'Kemo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(692, 41, 'Lobaye', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(693, 41, 'Mambere-Kadei', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(694, 41, 'Mbomou', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(695, 41, 'Nana-Gribizi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(696, 41, 'Nana-Mambere', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(697, 41, 'Ombella Mpoko', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(698, 41, 'Ouaka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(699, 41, 'Ouham', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(700, 41, 'Ouham-Pende', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(701, 41, 'Sangha-Mbaere', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(702, 41, 'Vakaga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(703, 42, 'Batha', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(704, 42, 'Biltine', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(705, 42, 'Bourkou-Ennedi-Tibesti', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(706, 42, 'Chari-Baguirmi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(707, 42, 'Guera', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(708, 42, 'Kanem', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(709, 42, 'Lac', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(710, 42, 'Logone Occidental', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(711, 42, 'Logone Oriental', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(712, 42, 'Mayo-Kebbi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(713, 42, 'Moyen-Chari', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(714, 42, 'Ouaddai', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(715, 42, 'Salamat', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(716, 42, 'Tandjile', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(717, 43, 'Aisen', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(718, 43, 'Antofagasta', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(719, 43, 'Araucania', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(720, 43, 'Atacama', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(721, 43, 'Bio Bio', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(722, 43, 'Coquimbo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(723, 43, 'Libertador General Bernardo O\'', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(724, 43, 'Los Lagos', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(725, 43, 'Magellanes', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(726, 43, 'Maule', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(727, 43, 'Metropolitana', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(728, 43, 'Metropolitana de Santiago', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(729, 43, 'Tarapaca', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(730, 43, 'Valparaiso', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(731, 44, 'Anhui', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(734, 44, 'Aomen', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(735, 44, 'Beijing', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(736, 44, 'Beijing Shi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(737, 44, 'Chongqing', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(738, 44, 'Fujian', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(740, 44, 'Gansu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(741, 44, 'Guangdong', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(743, 44, 'Guangxi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(744, 44, 'Guizhou', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(745, 44, 'Hainan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(746, 44, 'Hebei', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(747, 44, 'Heilongjiang', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(748, 44, 'Henan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(749, 44, 'Hubei', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(750, 44, 'Hunan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(751, 44, 'Jiangsu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(753, 44, 'Jiangxi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(754, 44, 'Jilin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(755, 44, 'Liaoning', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(757, 44, 'Nei Monggol', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(758, 44, 'Ningxia Hui', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(759, 44, 'Qinghai', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(760, 44, 'Shaanxi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(761, 44, 'Shandong', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(763, 44, 'Shanghai', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(764, 44, 'Shanxi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(765, 44, 'Sichuan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(766, 44, 'Tianjin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(767, 44, 'Xianggang', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(768, 44, 'Xinjiang', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(769, 44, 'Xizang', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(770, 44, 'Yunnan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(771, 44, 'Zhejiang', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(773, 45, 'Christmas Island', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(774, 46, 'Cocos (Keeling) Islands', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(775, 47, 'Amazonas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(776, 47, 'Antioquia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(777, 47, 'Arauca', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(778, 47, 'Atlantico', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(779, 47, 'Bogota', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(780, 47, 'Bolivar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(781, 47, 'Boyaca', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(782, 47, 'Caldas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(783, 47, 'Caqueta', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(784, 47, 'Casanare', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(785, 47, 'Cauca', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(786, 47, 'Cesar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(787, 47, 'Choco', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(788, 47, 'Cordoba', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(789, 47, 'Cundinamarca', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(790, 47, 'Guainia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(791, 47, 'Guaviare', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(792, 47, 'Huila', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(793, 47, 'La Guajira', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(794, 47, 'Magdalena', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(795, 47, 'Meta', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(796, 47, 'Narino', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(797, 47, 'Norte de Santander', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(798, 47, 'Putumayo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(799, 47, 'Quindio', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(800, 47, 'Risaralda', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(801, 47, 'San Andres y Providencia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(802, 47, 'Santander', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(803, 47, 'Sucre', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(804, 47, 'Tolima', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(805, 47, 'Valle del Cauca', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(806, 47, 'Vaupes', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(807, 47, 'Vichada', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(808, 48, 'Mwali', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(809, 48, 'Njazidja', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(810, 48, 'Nzwani', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(811, 49, 'Bouenza', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(812, 49, 'Brazzaville', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(813, 49, 'Cuvette', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(814, 49, 'Kouilou', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(815, 49, 'Lekoumou', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(816, 49, 'Likouala', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(817, 49, 'Niari', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(818, 49, 'Plateaux', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(819, 49, 'Pool', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(820, 49, 'Sangha', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(821, 50, 'Bandundu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(822, 50, 'Bas-Congo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(823, 50, 'Equateur', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(824, 50, 'Haut-Congo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(825, 50, 'Kasai-Occidental', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(826, 50, 'Kasai-Oriental', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(827, 50, 'Katanga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(828, 50, 'Kinshasa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(829, 50, 'Maniema', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(830, 50, 'Nord-Kivu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(831, 50, 'Sud-Kivu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(832, 51, 'Aitutaki', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(833, 51, 'Atiu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(834, 51, 'Mangaia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(835, 51, 'Manihiki', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(836, 51, 'Mauke', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(837, 51, 'Mitiaro', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(838, 51, 'Nassau', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(839, 51, 'Pukapuka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(840, 51, 'Rakahanga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(841, 51, 'Rarotonga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(842, 51, 'Tongareva', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(843, 52, 'Alajuela', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(844, 52, 'Cartago', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(845, 52, 'Guanacaste', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(846, 52, 'Heredia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(847, 52, 'Limon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(848, 52, 'Puntarenas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(849, 52, 'San Jose', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(850, 53, 'Abidjan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(851, 53, 'Agneby', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(852, 53, 'Bafing', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(853, 53, 'Denguele', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(854, 53, 'Dix-huit Montagnes', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(855, 53, 'Fromager', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(856, 53, 'Haut-Sassandra', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(857, 53, 'Lacs', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(858, 53, 'Lagunes', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(859, 53, 'Marahoue', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(860, 53, 'Moyen-Cavally', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(861, 53, 'Moyen-Comoe', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(862, 53, 'N\'zi-Comoe', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(863, 53, 'Sassandra', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(864, 53, 'Savanes', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(865, 53, 'Sud-Bandama', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(866, 53, 'Sud-Comoe', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(867, 53, 'Vallee du Bandama', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(868, 53, 'Worodougou', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(869, 53, 'Zanzan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(870, 54, 'Bjelovar-Bilogora', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(871, 54, 'Dubrovnik-Neretva', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(872, 54, 'Grad Zagreb', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(873, 54, 'Istra', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(874, 54, 'Karlovac', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(875, 54, 'Koprivnica-Krizhevci', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(876, 54, 'Krapina-Zagorje', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(877, 54, 'Lika-Senj', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(878, 54, 'Medhimurje', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(879, 54, 'Medimurska Zupanija', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(880, 54, 'Osijek-Baranja', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(881, 54, 'Osjecko-Baranjska Zupanija', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(882, 54, 'Pozhega-Slavonija', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(883, 54, 'Primorje-Gorski Kotar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(884, 54, 'Shibenik-Knin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(885, 54, 'Sisak-Moslavina', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(886, 54, 'Slavonski Brod-Posavina', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(887, 54, 'Split-Dalmacija', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(888, 54, 'Varazhdin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(889, 54, 'Virovitica-Podravina', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(890, 54, 'Vukovar-Srijem', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(891, 54, 'Zadar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(892, 54, 'Zagreb', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(893, 55, 'Camaguey', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(894, 55, 'Ciego de Avila', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(895, 55, 'Cienfuegos', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(896, 55, 'Ciudad de la Habana', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(897, 55, 'Granma', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(898, 55, 'Guantanamo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(899, 55, 'Habana', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(900, 55, 'Holguin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(901, 55, 'Isla de la Juventud', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(902, 55, 'La Habana', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(903, 55, 'Las Tunas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(904, 55, 'Matanzas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(905, 55, 'Pinar del Rio', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(906, 55, 'Sancti Spiritus', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(907, 55, 'Santiago de Cuba', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(908, 55, 'Villa Clara', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(909, 56, 'Government controlled area', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(910, 56, 'Limassol', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(911, 56, 'Nicosia District', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(912, 56, 'Paphos', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(913, 56, 'Turkish controlled area', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(914, 57, 'Central Bohemian', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(915, 57, 'Frycovice', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(916, 57, 'Jihocesky Kraj', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(917, 57, 'Jihochesky', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(918, 57, 'Jihomoravsky', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(919, 57, 'Karlovarsky', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(920, 57, 'Klecany', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(921, 57, 'Kralovehradecky', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(922, 57, 'Liberecky', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(923, 57, 'Lipov', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(924, 57, 'Moravskoslezsky', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(925, 57, 'Olomoucky', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(926, 57, 'Olomoucky Kraj', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(927, 57, 'Pardubicky', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(928, 57, 'Plzensky', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(929, 57, 'Praha', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(930, 57, 'Rajhrad', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(931, 57, 'Smirice', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(932, 57, 'South Moravian', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(933, 57, 'Straz nad Nisou', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(934, 57, 'Stredochesky', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(935, 57, 'Unicov', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(936, 57, 'Ustecky', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(937, 57, 'Valletta', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(938, 57, 'Velesin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(939, 57, 'Vysochina', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(940, 57, 'Zlinsky', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(941, 58, 'Arhus', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(942, 58, 'Bornholm', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(943, 58, 'Frederiksborg', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(944, 58, 'Fyn', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(945, 58, 'Hovedstaden', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(946, 58, 'Kobenhavn', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(947, 58, 'Kobenhavns Amt', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(948, 58, 'Kobenhavns Kommune', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(949, 58, 'Nordjylland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(950, 58, 'Ribe', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(951, 58, 'Ringkobing', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(952, 58, 'Roervig', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(953, 58, 'Roskilde', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(954, 58, 'Roslev', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(955, 58, 'Sjaelland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(956, 58, 'Soeborg', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(957, 58, 'Sonderjylland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(958, 58, 'Storstrom', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(959, 58, 'Syddanmark', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(960, 58, 'Toelloese', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(961, 58, 'Vejle', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(962, 58, 'Vestsjalland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(963, 58, 'Viborg', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(964, 59, '\'Ali Sabih', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(965, 59, 'Dikhil', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(966, 59, 'Jibuti', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(967, 59, 'Tajurah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(968, 59, 'Ubuk', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(969, 60, 'Saint Andrew', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(970, 60, 'Saint David', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(971, 60, 'Saint George', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(972, 60, 'Saint John', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(973, 60, 'Saint Joseph', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(974, 60, 'Saint Luke', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(975, 60, 'Saint Mark', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(976, 60, 'Saint Patrick', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(977, 60, 'Saint Paul', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(978, 60, 'Saint Peter', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(979, 61, 'Azua', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(980, 61, 'Bahoruco', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(981, 61, 'Barahona', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(982, 61, 'Dajabon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(983, 61, 'Distrito Nacional', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(984, 61, 'Duarte', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(985, 61, 'El Seybo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(986, 61, 'Elias Pina', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(987, 61, 'Espaillat', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(988, 61, 'Hato Mayor', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(989, 61, 'Independencia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(990, 61, 'La Altagracia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(991, 61, 'La Romana', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(992, 61, 'La Vega', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(993, 61, 'Maria Trinidad Sanchez', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(994, 61, 'Monsenor Nouel', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(995, 61, 'Monte Cristi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(996, 61, 'Monte Plata', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(997, 61, 'Pedernales', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(998, 61, 'Peravia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(999, 61, 'Puerto Plata', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1000, 61, 'Salcedo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1001, 61, 'Samana', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1002, 61, 'San Cristobal', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1003, 61, 'San Juan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1004, 61, 'San Pedro de Macoris', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1005, 61, 'Sanchez Ramirez', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1006, 61, 'Santiago', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1007, 61, 'Santiago Rodriguez', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1008, 61, 'Valverde', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1009, 62, 'Aileu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1010, 62, 'Ainaro', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1011, 62, 'Ambeno', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1012, 62, 'Baucau', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1013, 62, 'Bobonaro', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1014, 62, 'Cova Lima', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1015, 62, 'Dili', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1016, 62, 'Ermera', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1017, 62, 'Lautem', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1018, 62, 'Liquica', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1019, 62, 'Manatuto', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1020, 62, 'Manufahi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1021, 62, 'Viqueque', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1022, 63, 'Azuay', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1023, 63, 'Bolivar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1024, 63, 'Canar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1025, 63, 'Carchi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1026, 63, 'Chimborazo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1027, 63, 'Cotopaxi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1028, 63, 'El Oro', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1029, 63, 'Esmeraldas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1030, 63, 'Galapagos', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1031, 63, 'Guayas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1032, 63, 'Imbabura', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1033, 63, 'Loja', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1034, 63, 'Los Rios', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1035, 63, 'Manabi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1036, 63, 'Morona Santiago', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1037, 63, 'Napo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1038, 63, 'Orellana', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1039, 63, 'Pastaza', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1040, 63, 'Pichincha', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1041, 63, 'Sucumbios', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1042, 63, 'Tungurahua', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1043, 63, 'Zamora Chinchipe', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1044, 64, 'Aswan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1045, 64, 'Asyut', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1046, 64, 'Bani Suwayf', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1047, 64, 'Bur Sa\'id', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1048, 64, 'Cairo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1049, 64, 'Dumyat', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1050, 64, 'Kafr-ash-Shaykh', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1051, 64, 'Matruh', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1052, 64, 'Muhafazat ad Daqahliyah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1053, 64, 'Muhafazat al Fayyum', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1054, 64, 'Muhafazat al Gharbiyah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1055, 64, 'Muhafazat al Iskandariyah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1056, 64, 'Muhafazat al Qahirah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1057, 64, 'Qina', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1058, 64, 'Sawhaj', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1059, 64, 'Sina al-Janubiyah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1060, 64, 'Sina ash-Shamaliyah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1061, 64, 'ad-Daqahliyah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1062, 64, 'al-Bahr-al-Ahmar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1063, 64, 'al-Buhayrah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1064, 64, 'al-Fayyum', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1065, 64, 'al-Gharbiyah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1066, 64, 'al-Iskandariyah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1067, 64, 'al-Ismailiyah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1068, 64, 'al-Jizah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1069, 64, 'al-Minufiyah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1070, 64, 'al-Minya', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1071, 64, 'al-Qahira', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1072, 64, 'al-Qalyubiyah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1073, 64, 'al-Uqsur', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1074, 64, 'al-Wadi al-Jadid', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1075, 64, 'as-Suways', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1076, 64, 'ash-Sharqiyah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1077, 65, 'Ahuachapan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1078, 65, 'Cabanas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1079, 65, 'Chalatenango', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1080, 65, 'Cuscatlan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1081, 65, 'La Libertad', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1082, 65, 'La Paz', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1083, 65, 'La Union', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1084, 65, 'Morazan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1085, 65, 'San Miguel', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1086, 65, 'San Salvador', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1087, 65, 'San Vicente', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1088, 65, 'Santa Ana', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1089, 65, 'Sonsonate', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1090, 65, 'Usulutan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1091, 66, 'Annobon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1092, 66, 'Bioko Norte', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1093, 66, 'Bioko Sur', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1094, 66, 'Centro Sur', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1095, 66, 'Kie-Ntem', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1096, 66, 'Litoral', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1097, 66, 'Wele-Nzas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1098, 67, 'Anseba', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1099, 67, 'Debub', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1100, 67, 'Debub-Keih-Bahri', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1101, 67, 'Gash-Barka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1102, 67, 'Maekel', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1103, 67, 'Semien-Keih-Bahri', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1104, 68, 'Harju', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1105, 68, 'Hiiu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1106, 68, 'Ida-Viru', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1107, 68, 'Jarva', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1108, 68, 'Jogeva', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1109, 68, 'Laane', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1110, 68, 'Laane-Viru', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1111, 68, 'Parnu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1112, 68, 'Polva', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1113, 68, 'Rapla', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1114, 68, 'Saare', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1115, 68, 'Tartu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1116, 68, 'Valga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1117, 68, 'Viljandi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1118, 68, 'Voru', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1119, 69, 'Addis Abeba', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1120, 69, 'Afar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1121, 69, 'Amhara', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1122, 69, 'Benishangul', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1123, 69, 'Diredawa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1124, 69, 'Gambella', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1125, 69, 'Harar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1126, 69, 'Jigjiga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1127, 69, 'Mekele', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1128, 69, 'Oromia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1129, 69, 'Somali', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1130, 69, 'Southern', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1131, 69, 'Tigray', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1132, 70, 'Christmas Island', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1133, 70, 'Cocos Islands', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1134, 70, 'Coral Sea Islands', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1135, 71, 'Falkland Islands', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1136, 71, 'South Georgia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1137, 72, 'Klaksvik', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1138, 72, 'Nor ara Eysturoy', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1139, 72, 'Nor oy', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1140, 72, 'Sandoy', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1141, 72, 'Streymoy', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1142, 72, 'Su uroy', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1143, 72, 'Sy ra Eysturoy', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1144, 72, 'Torshavn', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1145, 72, 'Vaga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1146, 73, 'Central', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1147, 73, 'Eastern', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1148, 73, 'Northern', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1149, 73, 'South Pacific', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1150, 73, 'Western', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1151, 74, 'Ahvenanmaa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1152, 74, 'Etela-Karjala', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1153, 74, 'Etela-Pohjanmaa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1154, 74, 'Etela-Savo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1155, 74, 'Etela-Suomen Laani', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1156, 74, 'Ita-Suomen Laani', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1157, 74, 'Ita-Uusimaa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1158, 74, 'Kainuu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1159, 74, 'Kanta-Hame', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1160, 74, 'Keski-Pohjanmaa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1161, 74, 'Keski-Suomi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1162, 74, 'Kymenlaakso', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1163, 74, 'Lansi-Suomen Laani', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1164, 74, 'Lappi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1165, 74, 'Northern Savonia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1166, 74, 'Ostrobothnia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1167, 74, 'Oulun Laani', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1168, 74, 'Paijat-Hame', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1169, 74, 'Pirkanmaa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1170, 74, 'Pohjanmaa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1171, 74, 'Pohjois-Karjala', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1172, 74, 'Pohjois-Pohjanmaa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1173, 74, 'Pohjois-Savo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1174, 74, 'Saarijarvi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1175, 74, 'Satakunta', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1176, 74, 'Southern Savonia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1177, 74, 'Tavastia Proper', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1178, 74, 'Uleaborgs Lan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1179, 74, 'Uusimaa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1180, 74, 'Varsinais-Suomi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1181, 75, 'Ain', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1182, 75, 'Aisne', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1183, 75, 'Albi Le Sequestre', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1184, 75, 'Allier', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1185, 75, 'Alpes-Cote dAzur', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1186, 75, 'Alpes-Maritimes', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1187, 75, 'Alpes-de-Haute-Provence', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1188, 75, 'Alsace', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1189, 75, 'Aquitaine', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1190, 75, 'Ardeche', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1191, 75, 'Ardennes', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1192, 75, 'Ariege', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1193, 75, 'Aube', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1194, 75, 'Aude', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1195, 75, 'Auvergne', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1196, 75, 'Aveyron', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1197, 75, 'Bas-Rhin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1198, 75, 'Basse-Normandie', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1199, 75, 'Bouches-du-Rhone', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1200, 75, 'Bourgogne', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1201, 75, 'Bretagne', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1202, 75, 'Brittany', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1203, 75, 'Burgundy', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1204, 75, 'Calvados', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1205, 75, 'Cantal', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1206, 75, 'Cedex', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1207, 75, 'Centre', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1208, 75, 'Charente', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1209, 75, 'Charente-Maritime', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1210, 75, 'Cher', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1211, 75, 'Correze', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1212, 75, 'Corse-du-Sud', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1213, 75, 'Cote-d\'Or', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1214, 75, 'Cotes-d\'Armor', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1215, 75, 'Creuse', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1216, 75, 'Crolles', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1217, 75, 'Deux-Sevres', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1218, 75, 'Dordogne', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1219, 75, 'Doubs', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1220, 75, 'Drome', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1221, 75, 'Essonne', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1222, 75, 'Eure', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1223, 75, 'Eure-et-Loir', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1224, 75, 'Feucherolles', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1225, 75, 'Finistere', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1226, 75, 'Franche-Comte', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1227, 75, 'Gard', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1228, 75, 'Gers', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1229, 75, 'Gironde', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1230, 75, 'Haut-Rhin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1231, 75, 'Haute-Corse', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1232, 75, 'Haute-Garonne', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1233, 75, 'Haute-Loire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1234, 75, 'Haute-Marne', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1235, 75, 'Haute-Saone', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1236, 75, 'Haute-Savoie', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1237, 75, 'Haute-Vienne', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1238, 75, 'Hautes-Alpes', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1239, 75, 'Hautes-Pyrenees', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1240, 75, 'Hauts-de-Seine', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1241, 75, 'Herault', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1242, 75, 'Ile-de-France', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1243, 75, 'Ille-et-Vilaine', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1244, 75, 'Indre', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1245, 75, 'Indre-et-Loire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1246, 75, 'Isere', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1247, 75, 'Jura', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1248, 75, 'Klagenfurt', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1249, 75, 'Landes', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1250, 75, 'Languedoc-Roussillon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1251, 75, 'Larcay', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1252, 75, 'Le Castellet', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1253, 75, 'Le Creusot', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1254, 75, 'Limousin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1255, 75, 'Loir-et-Cher', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1256, 75, 'Loire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1257, 75, 'Loire-Atlantique', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1258, 75, 'Loiret', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1259, 75, 'Lorraine', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1260, 75, 'Lot', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1261, 75, 'Lot-et-Garonne', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1262, 75, 'Lower Normandy', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1263, 75, 'Lozere', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1264, 75, 'Maine-et-Loire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1265, 75, 'Manche', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1266, 75, 'Marne', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1267, 75, 'Mayenne', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1268, 75, 'Meurthe-et-Moselle', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1269, 75, 'Meuse', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1270, 75, 'Midi-Pyrenees', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1271, 75, 'Morbihan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1272, 75, 'Moselle', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1273, 75, 'Nievre', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1274, 75, 'Nord', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1275, 75, 'Nord-Pas-de-Calais', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1276, 75, 'Oise', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1277, 75, 'Orne', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1278, 75, 'Paris', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1279, 75, 'Pas-de-Calais', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1280, 75, 'Pays de la Loire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1281, 75, 'Pays-de-la-Loire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1282, 75, 'Picardy', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1283, 75, 'Puy-de-Dome', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1284, 75, 'Pyrenees-Atlantiques', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1285, 75, 'Pyrenees-Orientales', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1286, 75, 'Quelmes', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1287, 75, 'Rhone', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1288, 75, 'Rhone-Alpes', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1289, 75, 'Saint Ouen', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1290, 75, 'Saint Viatre', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1291, 75, 'Saone-et-Loire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1292, 75, 'Sarthe', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1293, 75, 'Savoie', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1294, 75, 'Seine-Maritime', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1295, 75, 'Seine-Saint-Denis', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1296, 75, 'Seine-et-Marne', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL);
INSERT INTO `states` (`id`, `country_id`, `name`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1297, 75, 'Somme', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1298, 75, 'Sophia Antipolis', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1299, 75, 'Souvans', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1300, 75, 'Tarn', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1301, 75, 'Tarn-et-Garonne', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1302, 75, 'Territoire de Belfort', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1303, 75, 'Treignac', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1304, 75, 'Upper Normandy', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1305, 75, 'Val-d\'Oise', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1306, 75, 'Val-de-Marne', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1307, 75, 'Var', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1308, 75, 'Vaucluse', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1309, 75, 'Vellise', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1310, 75, 'Vendee', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1311, 75, 'Vienne', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1312, 75, 'Vosges', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1313, 75, 'Yonne', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1314, 75, 'Yvelines', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1315, 76, 'Cayenne', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1316, 76, 'Saint-Laurent-du-Maroni', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1317, 77, 'Iles du Vent', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1318, 77, 'Iles sous le Vent', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1319, 77, 'Marquesas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1320, 77, 'Tuamotu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1321, 77, 'Tubuai', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1322, 78, 'Amsterdam', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1323, 78, 'Crozet Islands', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1324, 78, 'Kerguelen', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1325, 79, 'Estuaire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1326, 79, 'Haut-Ogooue', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1327, 79, 'Moyen-Ogooue', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1328, 79, 'Ngounie', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1329, 79, 'Nyanga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1330, 79, 'Ogooue-Ivindo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1331, 79, 'Ogooue-Lolo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1332, 79, 'Ogooue-Maritime', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1333, 79, 'Woleu-Ntem', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1334, 80, 'Banjul', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1335, 80, 'Basse', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1336, 80, 'Brikama', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1337, 80, 'Janjanbureh', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1338, 80, 'Kanifing', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1339, 80, 'Kerewan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1340, 80, 'Kuntaur', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1341, 80, 'Mansakonko', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1342, 81, 'Abhasia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1343, 81, 'Ajaria', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1344, 81, 'Guria', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1345, 81, 'Imereti', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1346, 81, 'Kaheti', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1347, 81, 'Kvemo Kartli', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1348, 81, 'Mcheta-Mtianeti', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1349, 81, 'Racha', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1350, 81, 'Samagrelo-Zemo Svaneti', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1351, 81, 'Samche-Zhavaheti', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1352, 81, 'Shida Kartli', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1353, 81, 'Tbilisi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1354, 82, 'Auvergne', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1355, 82, 'Baden-Wurttemberg', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1356, 82, 'Bavaria', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1357, 82, 'Bayern', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1358, 82, 'Beilstein Wurtt', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1359, 82, 'Berlin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1360, 82, 'Brandenburg', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1361, 82, 'Bremen', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1362, 82, 'Dreisbach', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1363, 82, 'Freistaat Bayern', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1364, 82, 'Hamburg', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1365, 82, 'Hannover', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1366, 82, 'Heroldstatt', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1367, 82, 'Hessen', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1368, 82, 'Kortenberg', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1369, 82, 'Laasdorf', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1370, 82, 'Land Baden-Wurttemberg', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1371, 82, 'Land Bayern', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1372, 82, 'Land Brandenburg', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1373, 82, 'Land Hessen', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1374, 82, 'Land Mecklenburg-Vorpommern', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1375, 82, 'Land Nordrhein-Westfalen', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1376, 82, 'Land Rheinland-Pfalz', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1377, 82, 'Land Sachsen', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1378, 82, 'Land Sachsen-Anhalt', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1379, 82, 'Land Thuringen', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1380, 82, 'Lower Saxony', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1381, 82, 'Mecklenburg-Vorpommern', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1382, 82, 'Mulfingen', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1383, 82, 'Munich', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1384, 82, 'Neubeuern', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1385, 82, 'Niedersachsen', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1386, 82, 'Noord-Holland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1387, 82, 'Nordrhein-Westfalen', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1388, 82, 'North Rhine-Westphalia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1389, 82, 'Osterode', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1390, 82, 'Rheinland-Pfalz', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1391, 82, 'Rhineland-Palatinate', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1392, 82, 'Saarland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1393, 82, 'Sachsen', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1394, 82, 'Sachsen-Anhalt', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1395, 82, 'Saxony', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1396, 82, 'Schleswig-Holstein', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1397, 82, 'Thuringia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1398, 82, 'Webling', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1399, 82, 'Weinstrabe', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1400, 82, 'schlobborn', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1401, 83, 'Ashanti', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1402, 83, 'Brong-Ahafo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1403, 83, 'Central', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1404, 83, 'Eastern', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1405, 83, 'Greater Accra', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1406, 83, 'Northern', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1407, 83, 'Upper East', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1408, 83, 'Upper West', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1409, 83, 'Volta', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1410, 83, 'Western', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1411, 84, 'Gibraltar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1412, 85, 'Acharnes', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1413, 85, 'Ahaia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1414, 85, 'Aitolia kai Akarnania', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1415, 85, 'Argolis', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1416, 85, 'Arkadia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1417, 85, 'Arta', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1418, 85, 'Attica', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1419, 85, 'Attiki', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1420, 85, 'Ayion Oros', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1421, 85, 'Crete', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1422, 85, 'Dodekanisos', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1423, 85, 'Drama', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1424, 85, 'Evia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1425, 85, 'Evritania', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1426, 85, 'Evros', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1427, 85, 'Evvoia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1428, 85, 'Florina', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1429, 85, 'Fokis', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1430, 85, 'Fthiotis', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1431, 85, 'Grevena', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1432, 85, 'Halandri', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1433, 85, 'Halkidiki', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1434, 85, 'Hania', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1435, 85, 'Heraklion', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1436, 85, 'Hios', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1437, 85, 'Ilia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1438, 85, 'Imathia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1439, 85, 'Ioannina', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1440, 85, 'Iraklion', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1441, 85, 'Karditsa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1442, 85, 'Kastoria', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1443, 85, 'Kavala', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1444, 85, 'Kefallinia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1445, 85, 'Kerkira', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1446, 85, 'Kiklades', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1447, 85, 'Kilkis', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1448, 85, 'Korinthia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1449, 85, 'Kozani', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1450, 85, 'Lakonia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1451, 85, 'Larisa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1452, 85, 'Lasithi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1453, 85, 'Lesvos', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1454, 85, 'Levkas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1455, 85, 'Magnisia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1456, 85, 'Messinia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1457, 85, 'Nomos Attikis', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1458, 85, 'Nomos Zakynthou', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1459, 85, 'Pella', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1460, 85, 'Pieria', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1461, 85, 'Piraios', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1462, 85, 'Preveza', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1463, 85, 'Rethimni', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1464, 85, 'Rodopi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1465, 85, 'Samos', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1466, 85, 'Serrai', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1467, 85, 'Thesprotia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1468, 85, 'Thessaloniki', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1469, 85, 'Trikala', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1470, 85, 'Voiotia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1471, 85, 'West Greece', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1472, 85, 'Xanthi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1473, 85, 'Zakinthos', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1474, 86, 'Aasiaat', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1475, 86, 'Ammassalik', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1476, 86, 'Illoqqortoormiut', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1477, 86, 'Ilulissat', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1478, 86, 'Ivittuut', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1479, 86, 'Kangaatsiaq', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1480, 86, 'Maniitsoq', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1481, 86, 'Nanortalik', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1482, 86, 'Narsaq', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1483, 86, 'Nuuk', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1484, 86, 'Paamiut', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1485, 86, 'Qaanaaq', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1486, 86, 'Qaqortoq', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1487, 86, 'Qasigiannguit', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1488, 86, 'Qeqertarsuaq', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1489, 86, 'Sisimiut', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1490, 86, 'Udenfor kommunal inddeling', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1491, 86, 'Upernavik', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1492, 86, 'Uummannaq', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1493, 87, 'Carriacou-Petite Martinique', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1494, 87, 'Saint Andrew', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1495, 87, 'Saint Davids', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1496, 87, 'Saint George\'s', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1497, 87, 'Saint John', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1498, 87, 'Saint Mark', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1499, 87, 'Saint Patrick', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1500, 88, 'Basse-Terre', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1501, 88, 'Grande-Terre', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1502, 88, 'Iles des Saintes', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1503, 88, 'La Desirade', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1504, 88, 'Marie-Galante', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1505, 88, 'Saint Barthelemy', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1506, 88, 'Saint Martin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1507, 89, 'Agana Heights', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1508, 89, 'Agat', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1509, 89, 'Barrigada', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1510, 89, 'Chalan-Pago-Ordot', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1511, 89, 'Dededo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1512, 89, 'Hagatna', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1513, 89, 'Inarajan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1514, 89, 'Mangilao', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1515, 89, 'Merizo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1516, 89, 'Mongmong-Toto-Maite', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1517, 89, 'Santa Rita', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1518, 89, 'Sinajana', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1519, 89, 'Talofofo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1520, 89, 'Tamuning', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1521, 89, 'Yigo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1522, 89, 'Yona', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1523, 90, 'Alta Verapaz', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1524, 90, 'Baja Verapaz', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1525, 90, 'Chimaltenango', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1526, 90, 'Chiquimula', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1527, 90, 'El Progreso', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1528, 90, 'Escuintla', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1529, 90, 'Guatemala', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1530, 90, 'Huehuetenango', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1531, 90, 'Izabal', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1532, 90, 'Jalapa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1533, 90, 'Jutiapa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1534, 90, 'Peten', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1535, 90, 'Quezaltenango', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1536, 90, 'Quiche', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1537, 90, 'Retalhuleu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1538, 90, 'Sacatepequez', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1539, 90, 'San Marcos', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1540, 90, 'Santa Rosa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1541, 90, 'Solola', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1542, 90, 'Suchitepequez', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1543, 90, 'Totonicapan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1544, 90, 'Zacapa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1545, 91, 'Alderney', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1546, 91, 'Castel', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1547, 91, 'Forest', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1548, 91, 'Saint Andrew', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1549, 91, 'Saint Martin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1550, 91, 'Saint Peter Port', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1551, 91, 'Saint Pierre du Bois', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1552, 91, 'Saint Sampson', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1553, 91, 'Saint Saviour', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1554, 91, 'Sark', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1555, 91, 'Torteval', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1556, 91, 'Vale', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1557, 92, 'Beyla', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1558, 92, 'Boffa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1559, 92, 'Boke', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1560, 92, 'Conakry', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1561, 92, 'Coyah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1562, 92, 'Dabola', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1563, 92, 'Dalaba', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1564, 92, 'Dinguiraye', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1565, 92, 'Faranah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1566, 92, 'Forecariah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1567, 92, 'Fria', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1568, 92, 'Gaoual', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1569, 92, 'Gueckedou', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1570, 92, 'Kankan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1571, 92, 'Kerouane', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1572, 92, 'Kindia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1573, 92, 'Kissidougou', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1574, 92, 'Koubia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1575, 92, 'Koundara', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1576, 92, 'Kouroussa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1577, 92, 'Labe', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1578, 92, 'Lola', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1579, 92, 'Macenta', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1580, 92, 'Mali', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1581, 92, 'Mamou', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1582, 92, 'Mandiana', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1583, 92, 'Nzerekore', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1584, 92, 'Pita', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1585, 92, 'Siguiri', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1586, 92, 'Telimele', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1587, 92, 'Tougue', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1588, 92, 'Yomou', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1589, 93, 'Bafata', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1590, 93, 'Bissau', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1591, 93, 'Bolama', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1592, 93, 'Cacheu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1593, 93, 'Gabu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1594, 93, 'Oio', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1595, 93, 'Quinara', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1596, 93, 'Tombali', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1597, 94, 'Barima-Waini', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1598, 94, 'Cuyuni-Mazaruni', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1599, 94, 'Demerara-Mahaica', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1600, 94, 'East Berbice-Corentyne', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1601, 94, 'Essequibo Islands-West Demerar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1602, 94, 'Mahaica-Berbice', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1603, 94, 'Pomeroon-Supenaam', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1604, 94, 'Potaro-Siparuni', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1605, 94, 'Upper Demerara-Berbice', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1606, 94, 'Upper Takutu-Upper Essequibo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1607, 95, 'Artibonite', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1608, 95, 'Centre', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1609, 95, 'Grand\'Anse', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1610, 95, 'Nord', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1611, 95, 'Nord-Est', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1612, 95, 'Nord-Ouest', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1613, 95, 'Ouest', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1614, 95, 'Sud', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1615, 95, 'Sud-Est', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1616, 96, 'Heard and McDonald Islands', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1617, 97, 'Atlantida', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1618, 97, 'Choluteca', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1619, 97, 'Colon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1620, 97, 'Comayagua', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1621, 97, 'Copan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1622, 97, 'Cortes', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1623, 97, 'Distrito Central', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1624, 97, 'El Paraiso', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1625, 97, 'Francisco Morazan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1626, 97, 'Gracias a Dios', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1627, 97, 'Intibuca', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1628, 97, 'Islas de la Bahia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1629, 97, 'La Paz', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1630, 97, 'Lempira', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1631, 97, 'Ocotepeque', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1632, 97, 'Olancho', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1633, 97, 'Santa Barbara', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1634, 97, 'Valle', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1635, 97, 'Yoro', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1636, 98, 'Hong Kong', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1637, 99, 'Bacs-Kiskun', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1638, 99, 'Baranya', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1639, 99, 'Bekes', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1640, 99, 'Borsod-Abauj-Zemplen', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1641, 99, 'Budapest', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1642, 99, 'Csongrad', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1643, 99, 'Fejer', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1644, 99, 'Gyor-Moson-Sopron', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1645, 99, 'Hajdu-Bihar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1646, 99, 'Heves', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1647, 99, 'Jasz-Nagykun-Szolnok', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1648, 99, 'Komarom-Esztergom', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1649, 99, 'Nograd', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1650, 99, 'Pest', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1651, 99, 'Somogy', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1652, 99, 'Szabolcs-Szatmar-Bereg', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1653, 99, 'Tolna', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1654, 99, 'Vas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1655, 99, 'Veszprem', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1656, 99, 'Zala', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1657, 100, 'Austurland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1658, 100, 'Gullbringusysla', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1659, 100, 'Hofu borgarsva i', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1660, 100, 'Nor urland eystra', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1661, 100, 'Nor urland vestra', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1662, 100, 'Su urland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1663, 100, 'Su urnes', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1664, 100, 'Vestfir ir', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1665, 100, 'Vesturland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1666, 102, 'Aceh', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1667, 102, 'Bali', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1668, 102, 'Bangka-Belitung', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1669, 102, 'Banten', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1670, 102, 'Bengkulu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1671, 102, 'Gandaria', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1672, 102, 'Gorontalo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1673, 102, 'Jakarta', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1674, 102, 'Jambi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1675, 102, 'Jawa Barat', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1676, 102, 'Jawa Tengah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1677, 102, 'Jawa Timur', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1678, 102, 'Kalimantan Barat', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1679, 102, 'Kalimantan Selatan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1680, 102, 'Kalimantan Tengah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1681, 102, 'Kalimantan Timur', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1682, 102, 'Kendal', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1683, 102, 'Lampung', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1684, 102, 'Maluku', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1685, 102, 'Maluku Utara', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1686, 102, 'Nusa Tenggara Barat', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1687, 102, 'Nusa Tenggara Timur', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1688, 102, 'Papua', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1689, 102, 'Riau', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1690, 102, 'Riau Kepulauan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1691, 102, 'Solo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1692, 102, 'Sulawesi Selatan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1693, 102, 'Sulawesi Tengah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1694, 102, 'Sulawesi Tenggara', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1695, 102, 'Sulawesi Utara', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1696, 102, 'Sumatera Barat', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1697, 102, 'Sumatera Selatan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1698, 102, 'Sumatera Utara', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1699, 102, 'Yogyakarta', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1700, 103, 'Ardabil', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1701, 103, 'Azarbayjan-e Bakhtari', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1702, 103, 'Azarbayjan-e Khavari', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1703, 103, 'Bushehr', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1704, 103, 'Chahar Mahal-e Bakhtiari', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1705, 103, 'Esfahan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1706, 103, 'Fars', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1707, 103, 'Gilan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1708, 103, 'Golestan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1709, 103, 'Hamadan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1710, 103, 'Hormozgan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1711, 103, 'Ilam', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1712, 103, 'Kerman', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1713, 103, 'Kermanshah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1714, 103, 'Khorasan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1715, 103, 'Khuzestan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1716, 103, 'Kohgiluyeh-e Boyerahmad', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1717, 103, 'Kordestan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1718, 103, 'Lorestan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1719, 103, 'Markazi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1720, 103, 'Mazandaran', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1721, 103, 'Ostan-e Esfahan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1722, 103, 'Qazvin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1723, 103, 'Qom', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1724, 103, 'Semnan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1725, 103, 'Sistan-e Baluchestan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1726, 103, 'Tehran', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1727, 103, 'Yazd', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1728, 103, 'Zanjan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1729, 104, 'Babil', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1730, 104, 'Baghdad', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1731, 104, 'Dahuk', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1732, 104, 'Dhi Qar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1733, 104, 'Diyala', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1734, 104, 'Erbil', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1735, 104, 'Irbil', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1736, 104, 'Karbala', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1737, 104, 'Kurdistan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1738, 104, 'Maysan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1739, 104, 'Ninawa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1740, 104, 'Salah-ad-Din', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1741, 104, 'Wasit', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1742, 104, 'al-Anbar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1743, 104, 'al-Basrah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1744, 104, 'al-Muthanna', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1745, 104, 'al-Qadisiyah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1746, 104, 'an-Najaf', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1747, 104, 'as-Sulaymaniyah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1748, 104, 'at-Ta\'mim', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1749, 105, 'Armagh', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1750, 105, 'Carlow', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1751, 105, 'Cavan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1752, 105, 'Clare', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1753, 105, 'Cork', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1754, 105, 'Donegal', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1755, 105, 'Dublin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1756, 105, 'Galway', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1757, 105, 'Kerry', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1758, 105, 'Kildare', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1759, 105, 'Kilkenny', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1760, 105, 'Laois', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1761, 105, 'Leinster', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1762, 105, 'Leitrim', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1763, 105, 'Limerick', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1764, 105, 'Loch Garman', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1765, 105, 'Longford', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1766, 105, 'Louth', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1767, 105, 'Mayo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1768, 105, 'Meath', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1769, 105, 'Monaghan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1770, 105, 'Offaly', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1771, 105, 'Roscommon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1772, 105, 'Sligo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1773, 105, 'Tipperary North Riding', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1774, 105, 'Tipperary South Riding', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1775, 105, 'Ulster', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1776, 105, 'Waterford', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1777, 105, 'Westmeath', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1778, 105, 'Wexford', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1779, 105, 'Wicklow', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1780, 106, 'Beit Hanania', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1781, 106, 'Ben Gurion Airport', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1782, 106, 'Bethlehem', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1783, 106, 'Caesarea', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1784, 106, 'Centre', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1785, 106, 'Gaza', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1786, 106, 'Hadaron', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1787, 106, 'Haifa District', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1788, 106, 'Hamerkaz', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1789, 106, 'Hazafon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1790, 106, 'Hebron', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1791, 106, 'Jaffa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1792, 106, 'Jerusalem', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1793, 106, 'Khefa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1794, 106, 'Kiryat Yam', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1795, 106, 'Lower Galilee', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1796, 106, 'Qalqilya', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1797, 106, 'Talme Elazar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1798, 106, 'Tel Aviv', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1799, 106, 'Tsafon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1800, 106, 'Umm El Fahem', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1801, 106, 'Yerushalayim', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1802, 107, 'Abruzzi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1803, 107, 'Abruzzo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1804, 107, 'Agrigento', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1805, 107, 'Alessandria', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1806, 107, 'Ancona', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1807, 107, 'Arezzo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1808, 107, 'Ascoli Piceno', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1809, 107, 'Asti', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1810, 107, 'Avellino', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1811, 107, 'Bari', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1812, 107, 'Basilicata', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1813, 107, 'Belluno', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1814, 107, 'Benevento', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1815, 107, 'Bergamo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1816, 107, 'Biella', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1817, 107, 'Bologna', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1818, 107, 'Bolzano', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1819, 107, 'Brescia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1820, 107, 'Brindisi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1821, 107, 'Calabria', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1822, 107, 'Campania', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1823, 107, 'Cartoceto', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1824, 107, 'Caserta', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1825, 107, 'Catania', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1826, 107, 'Chieti', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1827, 107, 'Como', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1828, 107, 'Cosenza', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1829, 107, 'Cremona', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1830, 107, 'Cuneo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1831, 107, 'Emilia-Romagna', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1832, 107, 'Ferrara', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1833, 107, 'Firenze', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1834, 107, 'Florence', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1835, 107, 'Forli-Cesena ', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1836, 107, 'Friuli-Venezia Giulia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1837, 107, 'Frosinone', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1838, 107, 'Genoa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1839, 107, 'Gorizia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1840, 107, 'L\'Aquila', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1841, 107, 'Lazio', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1842, 107, 'Lecce', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1843, 107, 'Lecco', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1845, 107, 'Liguria', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1846, 107, 'Lodi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1847, 107, 'Lombardia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1848, 107, 'Lombardy', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1849, 107, 'Macerata', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1850, 107, 'Mantova', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1851, 107, 'Marche', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1852, 107, 'Messina', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1853, 107, 'Milan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1854, 107, 'Modena', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1855, 107, 'Molise', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1856, 107, 'Molteno', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1857, 107, 'Montenegro', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1858, 107, 'Monza and Brianza', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1859, 107, 'Naples', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1860, 107, 'Novara', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1861, 107, 'Padova', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1862, 107, 'Parma', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1863, 107, 'Pavia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1864, 107, 'Perugia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1865, 107, 'Pesaro-Urbino', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1866, 107, 'Piacenza', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1867, 107, 'Piedmont', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1868, 107, 'Piemonte', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1869, 107, 'Pisa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1870, 107, 'Pordenone', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1871, 107, 'Potenza', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1872, 107, 'Puglia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1873, 107, 'Reggio Emilia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1874, 107, 'Rimini', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1875, 107, 'Roma', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1876, 107, 'Salerno', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1877, 107, 'Sardegna', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1878, 107, 'Sassari', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1879, 107, 'Savona', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1880, 107, 'Sicilia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1881, 107, 'Siena', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1882, 107, 'Sondrio', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1883, 107, 'South Tyrol', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1884, 107, 'Taranto', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1885, 107, 'Teramo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1886, 107, 'Torino', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1887, 107, 'Toscana', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1888, 107, 'Trapani', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1889, 107, 'Trentino-Alto Adige', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1890, 107, 'Trento', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1891, 107, 'Treviso', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1892, 107, 'Udine', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1893, 107, 'Umbria', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1894, 107, 'Valle d\'Aosta', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1895, 107, 'Varese', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1896, 107, 'Veneto', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1897, 107, 'Venezia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1898, 107, 'Verbano-Cusio-Ossola', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1899, 107, 'Vercelli', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1900, 107, 'Verona', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1901, 107, 'Vicenza', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1902, 107, 'Viterbo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1903, 108, 'Buxoro Viloyati', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1904, 108, 'Clarendon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1905, 108, 'Hanover', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1906, 108, 'Kingston', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1907, 108, 'Manchester', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1908, 108, 'Portland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1909, 108, 'Saint Andrews', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1910, 108, 'Saint Ann', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1911, 108, 'Saint Catherine', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1912, 108, 'Saint Elizabeth', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1913, 108, 'Saint James', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1914, 108, 'Saint Mary', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1915, 108, 'Saint Thomas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1916, 108, 'Trelawney', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1917, 108, 'Westmoreland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1918, 109, 'Aichi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1919, 109, 'Akita', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1920, 109, 'Aomori', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1921, 109, 'Chiba', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1922, 109, 'Ehime', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1923, 109, 'Fukui', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1924, 109, 'Fukuoka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1925, 109, 'Fukushima', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1926, 109, 'Gifu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1927, 109, 'Gumma', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1928, 109, 'Hiroshima', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1929, 109, 'Hokkaido', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1930, 109, 'Hyogo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1931, 109, 'Ibaraki', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL);
INSERT INTO `states` (`id`, `country_id`, `name`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1932, 109, 'Ishikawa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1933, 109, 'Iwate', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1934, 109, 'Kagawa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1935, 109, 'Kagoshima', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1936, 109, 'Kanagawa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1937, 109, 'Kanto', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1938, 109, 'Kochi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1939, 109, 'Kumamoto', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1940, 109, 'Kyoto', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1941, 109, 'Mie', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1942, 109, 'Miyagi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1943, 109, 'Miyazaki', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1944, 109, 'Nagano', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1945, 109, 'Nagasaki', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1946, 109, 'Nara', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1947, 109, 'Niigata', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1948, 109, 'Oita', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1949, 109, 'Okayama', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1950, 109, 'Okinawa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1951, 109, 'Osaka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1952, 109, 'Saga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1953, 109, 'Saitama', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1954, 109, 'Shiga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1955, 109, 'Shimane', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1956, 109, 'Shizuoka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1957, 109, 'Tochigi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1958, 109, 'Tokushima', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1959, 109, 'Tokyo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1960, 109, 'Tottori', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1961, 109, 'Toyama', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1962, 109, 'Wakayama', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1963, 109, 'Yamagata', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1964, 109, 'Yamaguchi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1965, 109, 'Yamanashi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1966, 110, 'Grouville', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1967, 110, 'Saint Brelade', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1968, 110, 'Saint Clement', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1969, 110, 'Saint Helier', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1970, 110, 'Saint John', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1971, 110, 'Saint Lawrence', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1972, 110, 'Saint Martin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1973, 110, 'Saint Mary', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1974, 110, 'Saint Peter', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1975, 110, 'Saint Saviour', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1976, 110, 'Trinity', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1977, 111, '\'Ajlun', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1978, 111, 'Amman', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1979, 111, 'Irbid', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1980, 111, 'Jarash', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1981, 111, 'Ma\'an', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1982, 111, 'Madaba', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1983, 111, 'al-\'Aqabah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1984, 111, 'al-Balqa\'', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1985, 111, 'al-Karak', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1986, 111, 'al-Mafraq', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1987, 111, 'at-Tafilah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1988, 111, 'az-Zarqa\'', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1989, 112, 'Akmecet', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1990, 112, 'Akmola', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1991, 112, 'Aktobe', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1992, 112, 'Almati', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1993, 112, 'Atirau', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1994, 112, 'Batis Kazakstan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1995, 112, 'Burlinsky Region', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1996, 112, 'Karagandi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1997, 112, 'Kostanay', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1998, 112, 'Mankistau', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(1999, 112, 'Ontustik Kazakstan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2000, 112, 'Pavlodar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2001, 112, 'Sigis Kazakstan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2002, 112, 'Soltustik Kazakstan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2003, 112, 'Taraz', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2004, 113, 'Central', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2005, 113, 'Coast', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2006, 113, 'Eastern', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2007, 113, 'Nairobi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2008, 113, 'North Eastern', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2009, 113, 'Nyanza', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2010, 113, 'Rift Valley', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2011, 113, 'Western', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2012, 114, 'Abaiang', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2013, 114, 'Abemana', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2014, 114, 'Aranuka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2015, 114, 'Arorae', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2016, 114, 'Banaba', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2017, 114, 'Beru', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2018, 114, 'Butaritari', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2019, 114, 'Kiritimati', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2020, 114, 'Kuria', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2021, 114, 'Maiana', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2022, 114, 'Makin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2023, 114, 'Marakei', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2024, 114, 'Nikunau', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2025, 114, 'Nonouti', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2026, 114, 'Onotoa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2027, 114, 'Phoenix Islands', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2028, 114, 'Tabiteuea North', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2029, 114, 'Tabiteuea South', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2030, 114, 'Tabuaeran', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2031, 114, 'Tamana', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2032, 114, 'Tarawa North', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2033, 114, 'Tarawa South', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2034, 114, 'Teraina', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2035, 115, 'Chagangdo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2036, 115, 'Hamgyeongbukto', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2037, 115, 'Hamgyeongnamdo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2038, 115, 'Hwanghaebukto', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2039, 115, 'Hwanghaenamdo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2040, 115, 'Kaeseong', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2041, 115, 'Kangweon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2042, 115, 'Nampo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2043, 115, 'Pyeonganbukto', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2044, 115, 'Pyeongannamdo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2045, 115, 'Pyeongyang', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2046, 115, 'Yanggang', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2047, 116, 'Busan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2048, 116, 'Cheju', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2049, 116, 'Chollabuk', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2050, 116, 'Chollanam', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2051, 116, 'Chungbuk', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2052, 116, 'Chungcheongbuk', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2053, 116, 'Chungcheongnam', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2054, 116, 'Chungnam', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2055, 116, 'Daegu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2056, 116, 'Gangwon-do', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2057, 116, 'Goyang-si', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2058, 116, 'Gyeonggi-do', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2059, 116, 'Gyeongsang ', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2060, 116, 'Gyeongsangnam-do', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2061, 116, 'Incheon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2062, 116, 'Jeju-Si', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2063, 116, 'Jeonbuk', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2064, 116, 'Kangweon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2065, 116, 'Kwangju', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2066, 116, 'Kyeonggi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2067, 116, 'Kyeongsangbuk', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2068, 116, 'Kyeongsangnam', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2069, 116, 'Kyonggi-do', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2070, 116, 'Kyungbuk-Do', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2071, 116, 'Kyunggi-Do', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2072, 116, 'Kyunggi-do', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2073, 116, 'Pusan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2074, 116, 'Seoul', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2075, 116, 'Sudogwon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2076, 116, 'Taegu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2077, 116, 'Taejeon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2078, 116, 'Taejon-gwangyoksi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2079, 116, 'Ulsan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2080, 116, 'Wonju', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2081, 116, 'gwangyoksi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2082, 117, 'Al Asimah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2083, 117, 'Hawalli', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2084, 117, 'Mishref', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2085, 117, 'Qadesiya', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2086, 117, 'Safat', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2087, 117, 'Salmiya', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2088, 117, 'al-Ahmadi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2089, 117, 'al-Farwaniyah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2090, 117, 'al-Jahra', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2091, 117, 'al-Kuwayt', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2092, 118, 'Batken', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2093, 118, 'Bishkek', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2094, 118, 'Chui', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2095, 118, 'Issyk-Kul', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2096, 118, 'Jalal-Abad', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2097, 118, 'Naryn', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2098, 118, 'Osh', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2099, 118, 'Talas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2100, 119, 'Attopu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2101, 119, 'Bokeo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2102, 119, 'Bolikhamsay', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2103, 119, 'Champasak', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2104, 119, 'Houaphanh', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2105, 119, 'Khammouane', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2106, 119, 'Luang Nam Tha', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2107, 119, 'Luang Prabang', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2108, 119, 'Oudomxay', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2109, 119, 'Phongsaly', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2110, 119, 'Saravan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2111, 119, 'Savannakhet', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2112, 119, 'Sekong', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2113, 119, 'Viangchan Prefecture', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2114, 119, 'Viangchan Province', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2115, 119, 'Xaignabury', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2116, 119, 'Xiang Khuang', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2117, 120, 'Aizkraukles', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2118, 120, 'Aluksnes', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2119, 120, 'Balvu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2120, 120, 'Bauskas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2121, 120, 'Cesu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2122, 120, 'Daugavpils', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2123, 120, 'Daugavpils City', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2124, 120, 'Dobeles', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2125, 120, 'Gulbenes', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2126, 120, 'Jekabspils', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2127, 120, 'Jelgava', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2128, 120, 'Jelgavas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2129, 120, 'Jurmala City', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2130, 120, 'Kraslavas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2131, 120, 'Kuldigas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2132, 120, 'Liepaja', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2133, 120, 'Liepajas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2134, 120, 'Limbazhu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2135, 120, 'Ludzas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2136, 120, 'Madonas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2137, 120, 'Ogres', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2138, 120, 'Preilu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2139, 120, 'Rezekne', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2140, 120, 'Rezeknes', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2141, 120, 'Riga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2142, 120, 'Rigas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2143, 120, 'Saldus', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2144, 120, 'Talsu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2145, 120, 'Tukuma', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2146, 120, 'Valkas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2147, 120, 'Valmieras', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2148, 120, 'Ventspils', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2149, 120, 'Ventspils City', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2150, 121, 'Beirut', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2151, 121, 'Jabal Lubnan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2152, 121, 'Mohafazat Liban-Nord', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2153, 121, 'Mohafazat Mont-Liban', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2154, 121, 'Sidon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2155, 121, 'al-Biqa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2156, 121, 'al-Janub', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2157, 121, 'an-Nabatiyah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2158, 121, 'ash-Shamal', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2159, 122, 'Berea', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2160, 122, 'Butha-Buthe', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2161, 122, 'Leribe', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2162, 122, 'Mafeteng', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2163, 122, 'Maseru', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2164, 122, 'Mohale\'s Hoek', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2165, 122, 'Mokhotlong', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2166, 122, 'Qacha\'s Nek', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2167, 122, 'Quthing', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2168, 122, 'Thaba-Tseka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2169, 123, 'Bomi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2170, 123, 'Bong', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2171, 123, 'Grand Bassa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2172, 123, 'Grand Cape Mount', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2173, 123, 'Grand Gedeh', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2174, 123, 'Loffa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2175, 123, 'Margibi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2176, 123, 'Maryland and Grand Kru', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2177, 123, 'Montserrado', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2178, 123, 'Nimba', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2179, 123, 'Rivercess', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2180, 123, 'Sinoe', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2181, 124, 'Ajdabiya', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2182, 124, 'Fezzan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2183, 124, 'Banghazi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2184, 124, 'Darnah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2185, 124, 'Ghadamis', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2186, 124, 'Gharyan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2187, 124, 'Misratah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2188, 124, 'Murzuq', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2189, 124, 'Sabha', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2190, 124, 'Sawfajjin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2191, 124, 'Surt', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2192, 124, 'Tarabulus', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2193, 124, 'Tarhunah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2194, 124, 'Tripolitania', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2195, 124, 'Tubruq', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2196, 124, 'Yafran', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2197, 124, 'Zlitan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2198, 124, 'al-\'Aziziyah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2199, 124, 'al-Fatih', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2200, 124, 'al-Jabal al Akhdar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2201, 124, 'al-Jufrah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2202, 124, 'al-Khums', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2203, 124, 'al-Kufrah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2204, 124, 'an-Nuqat al-Khams', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2205, 124, 'ash-Shati\'', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2206, 124, 'az-Zawiyah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2207, 125, 'Balzers', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2208, 125, 'Eschen', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2209, 125, 'Gamprin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2210, 125, 'Mauren', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2211, 125, 'Planken', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2212, 125, 'Ruggell', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2213, 125, 'Schaan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2214, 125, 'Schellenberg', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2215, 125, 'Triesen', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2216, 125, 'Triesenberg', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2217, 125, 'Vaduz', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2218, 126, 'Alytaus', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2219, 126, 'Anyksciai', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2220, 126, 'Kauno', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2221, 126, 'Klaipedos', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2222, 126, 'Marijampoles', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2223, 126, 'Panevezhio', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2224, 126, 'Panevezys', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2225, 126, 'Shiauliu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2226, 126, 'Taurages', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2227, 126, 'Telshiu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2228, 126, 'Telsiai', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2229, 126, 'Utenos', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2230, 126, 'Vilniaus', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2231, 127, 'Capellen', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2232, 127, 'Clervaux', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2233, 127, 'Diekirch', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2234, 127, 'Echternach', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2235, 127, 'Esch-sur-Alzette', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2236, 127, 'Grevenmacher', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2237, 127, 'Luxembourg', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2238, 127, 'Mersch', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2239, 127, 'Redange', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2240, 127, 'Remich', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2241, 127, 'Vianden', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2242, 127, 'Wiltz', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2243, 128, 'Macau', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2244, 129, 'Berovo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2245, 129, 'Bitola', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2246, 129, 'Brod', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2247, 129, 'Debar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2248, 129, 'Delchevo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2249, 129, 'Demir Hisar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2250, 129, 'Gevgelija', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2251, 129, 'Gostivar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2252, 129, 'Kavadarci', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2253, 129, 'Kichevo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2254, 129, 'Kochani', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2255, 129, 'Kratovo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2256, 129, 'Kriva Palanka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2257, 129, 'Krushevo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2258, 129, 'Kumanovo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2259, 129, 'Negotino', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2260, 129, 'Ohrid', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2261, 129, 'Prilep', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2262, 129, 'Probishtip', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2263, 129, 'Radovish', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2264, 129, 'Resen', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2265, 129, 'Shtip', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2266, 129, 'Skopje', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2267, 129, 'Struga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2268, 129, 'Strumica', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2269, 129, 'Sveti Nikole', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2270, 129, 'Tetovo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2271, 129, 'Valandovo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2272, 129, 'Veles', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2273, 129, 'Vinica', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2274, 130, 'Antananarivo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2275, 130, 'Antsiranana', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2276, 130, 'Fianarantsoa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2277, 130, 'Mahajanga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2278, 130, 'Toamasina', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2279, 130, 'Toliary', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2280, 131, 'Balaka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2281, 131, 'Blantyre City', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2282, 131, 'Chikwawa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2283, 131, 'Chiradzulu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2284, 131, 'Chitipa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2285, 131, 'Dedza', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2286, 131, 'Dowa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2287, 131, 'Karonga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2288, 131, 'Kasungu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2289, 131, 'Lilongwe City', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2290, 131, 'Machinga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2291, 131, 'Mangochi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2292, 131, 'Mchinji', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2293, 131, 'Mulanje', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2294, 131, 'Mwanza', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2295, 131, 'Mzimba', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2296, 131, 'Mzuzu City', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2297, 131, 'Nkhata Bay', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2298, 131, 'Nkhotakota', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2299, 131, 'Nsanje', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2300, 131, 'Ntcheu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2301, 131, 'Ntchisi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2302, 131, 'Phalombe', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2303, 131, 'Rumphi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2304, 131, 'Salima', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2305, 131, 'Thyolo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2306, 131, 'Zomba Municipality', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2307, 132, 'Johor', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2308, 132, 'Kedah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2309, 132, 'Kelantan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2310, 132, 'Kuala Lumpur', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2311, 132, 'Labuan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2312, 132, 'Melaka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2313, 132, 'Negeri Johor', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2314, 132, 'Negeri Sembilan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2315, 132, 'Pahang', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2316, 132, 'Penang', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2317, 132, 'Perak', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2318, 132, 'Perlis', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2319, 132, 'Pulau Pinang', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2320, 132, 'Sabah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2321, 132, 'Sarawak', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2322, 132, 'Selangor', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2323, 132, 'Sembilan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2324, 132, 'Terengganu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2325, 133, 'Alif Alif', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2326, 133, 'Alif Dhaal', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2327, 133, 'Baa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2328, 133, 'Dhaal', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2329, 133, 'Faaf', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2330, 133, 'Gaaf Alif', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2331, 133, 'Gaaf Dhaal', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2332, 133, 'Ghaviyani', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2333, 133, 'Haa Alif', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2334, 133, 'Haa Dhaal', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2335, 133, 'Kaaf', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2336, 133, 'Laam', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2337, 133, 'Lhaviyani', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2338, 133, 'Male', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2339, 133, 'Miim', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2340, 133, 'Nuun', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2341, 133, 'Raa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2342, 133, 'Shaviyani', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2343, 133, 'Siin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2344, 133, 'Thaa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2345, 133, 'Vaav', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2346, 134, 'Bamako', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2347, 134, 'Gao', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2348, 134, 'Kayes', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2349, 134, 'Kidal', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2350, 134, 'Koulikoro', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2351, 134, 'Mopti', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2352, 134, 'Segou', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2353, 134, 'Sikasso', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2354, 134, 'Tombouctou', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2355, 135, 'Gozo and Comino', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2356, 135, 'Inner Harbour', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2357, 135, 'Northern', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2358, 135, 'Outer Harbour', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2359, 135, 'South Eastern', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2360, 135, 'Valletta', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2361, 135, 'Western', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2362, 136, 'Castletown', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2363, 136, 'Douglas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2364, 136, 'Laxey', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2365, 136, 'Onchan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2366, 136, 'Peel', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2367, 136, 'Port Erin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2368, 136, 'Port Saint Mary', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2369, 136, 'Ramsey', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2370, 137, 'Ailinlaplap', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2371, 137, 'Ailuk', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2372, 137, 'Arno', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2373, 137, 'Aur', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2374, 137, 'Bikini', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2375, 137, 'Ebon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2376, 137, 'Enewetak', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2377, 137, 'Jabat', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2378, 137, 'Jaluit', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2379, 137, 'Kili', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2380, 137, 'Kwajalein', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2381, 137, 'Lae', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2382, 137, 'Lib', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2383, 137, 'Likiep', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2384, 137, 'Majuro', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2385, 137, 'Maloelap', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2386, 137, 'Mejit', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2387, 137, 'Mili', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2388, 137, 'Namorik', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2389, 137, 'Namu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2390, 137, 'Rongelap', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2391, 137, 'Ujae', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2392, 137, 'Utrik', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2393, 137, 'Wotho', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2394, 137, 'Wotje', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2395, 138, 'Fort-de-France', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2396, 138, 'La Trinite', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2397, 138, 'Le Marin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2398, 138, 'Saint-Pierre', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2399, 139, 'Adrar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2400, 139, 'Assaba', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2401, 139, 'Brakna', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2402, 139, 'Dhakhlat Nawadibu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2403, 139, 'Hudh-al-Gharbi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2404, 139, 'Hudh-ash-Sharqi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2405, 139, 'Inshiri', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2406, 139, 'Nawakshut', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2407, 139, 'Qidimagha', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2408, 139, 'Qurqul', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2409, 139, 'Taqant', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2410, 139, 'Tiris Zammur', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2411, 139, 'Trarza', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2412, 140, 'Black River', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2413, 140, 'Eau Coulee', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2414, 140, 'Flacq', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2415, 140, 'Floreal', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2416, 140, 'Grand Port', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2417, 140, 'Moka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2418, 140, 'Pamplempousses', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2419, 140, 'Plaines Wilhelm', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2420, 140, 'Port Louis', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2421, 140, 'Riviere du Rempart', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2422, 140, 'Rodrigues', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2423, 140, 'Rose Hill', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2424, 140, 'Savanne', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2425, 141, 'Mayotte', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2426, 141, 'Pamanzi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2427, 142, 'Aguascalientes', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2428, 142, 'Baja California', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2429, 142, 'Baja California Sur', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2430, 142, 'Campeche', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2431, 142, 'Chiapas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2432, 142, 'Chihuahua', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2433, 142, 'Coahuila', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2434, 142, 'Colima', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2435, 142, 'Distrito Federal', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2436, 142, 'Durango', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2437, 142, 'Estado de Mexico', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2438, 142, 'Guanajuato', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2439, 142, 'Guerrero', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2440, 142, 'Hidalgo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2441, 142, 'Jalisco', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2442, 142, 'Mexico', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2443, 142, 'Michoacan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2444, 142, 'Morelos', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2445, 142, 'Nayarit', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2446, 142, 'Nuevo Leon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2447, 142, 'Oaxaca', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2448, 142, 'Puebla', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2449, 142, 'Queretaro', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2450, 142, 'Quintana Roo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2451, 142, 'San Luis Potosi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2452, 142, 'Sinaloa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2453, 142, 'Sonora', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2454, 142, 'Tabasco', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2455, 142, 'Tamaulipas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2456, 142, 'Tlaxcala', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2457, 142, 'Veracruz', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2458, 142, 'Yucatan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2459, 142, 'Zacatecas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2460, 143, 'Chuuk', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2461, 143, 'Kusaie', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2462, 143, 'Pohnpei', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2463, 143, 'Yap', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2464, 144, 'Balti', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2465, 144, 'Cahul', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2466, 144, 'Chisinau', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2467, 144, 'Chisinau Oras', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2468, 144, 'Edinet', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2469, 144, 'Gagauzia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2470, 144, 'Lapusna', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2471, 144, 'Orhei', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2472, 144, 'Soroca', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2473, 144, 'Taraclia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2474, 144, 'Tighina', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2475, 144, 'Transnistria', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2476, 144, 'Ungheni', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2477, 145, 'Fontvieille', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2478, 145, 'La Condamine', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2479, 145, 'Monaco-Ville', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2480, 145, 'Monte Carlo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2481, 146, 'Arhangaj', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2482, 146, 'Bajan-Olgij', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2483, 146, 'Bajanhongor', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2484, 146, 'Bulgan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2485, 146, 'Darhan-Uul', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2486, 146, 'Dornod', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2487, 146, 'Dornogovi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2488, 146, 'Dundgovi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2489, 146, 'Govi-Altaj', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2490, 146, 'Govisumber', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2491, 146, 'Hentij', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2492, 146, 'Hovd', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2493, 146, 'Hovsgol', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2494, 146, 'Omnogovi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2495, 146, 'Orhon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2496, 146, 'Ovorhangaj', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2497, 146, 'Selenge', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2498, 146, 'Suhbaatar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2499, 146, 'Tov', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2500, 146, 'Ulaanbaatar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2501, 146, 'Uvs', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2502, 146, 'Zavhan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2503, 147, 'Montserrat', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2504, 148, 'Agadir', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2505, 148, 'Casablanca', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2506, 148, 'Chaouia-Ouardigha', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2507, 148, 'Doukkala-Abda', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2508, 148, 'Fes-Boulemane', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2509, 148, 'Gharb-Chrarda-Beni Hssen', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2510, 148, 'Guelmim', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2511, 148, 'Kenitra', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2512, 148, 'Marrakech-Tensift-Al Haouz', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2513, 148, 'Meknes-Tafilalet', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2514, 148, 'Oriental', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2515, 148, 'Oujda', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2516, 148, 'Province de Tanger', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2517, 148, 'Rabat-Sale-Zammour-Zaer', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2518, 148, 'Sala Al Jadida', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2519, 148, 'Settat', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2520, 148, 'Souss Massa-Draa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2521, 148, 'Tadla-Azilal', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2522, 148, 'Tangier-Tetouan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2523, 148, 'Taza-Al Hoceima-Taounate', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2524, 148, 'Wilaya de Casablanca', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2525, 148, 'Wilaya de Rabat-Sale', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2526, 149, 'Cabo Delgado', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2527, 149, 'Gaza', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2528, 149, 'Inhambane', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2529, 149, 'Manica', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2530, 149, 'Maputo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2531, 149, 'Maputo Provincia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2532, 149, 'Nampula', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2533, 149, 'Niassa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2534, 149, 'Sofala', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2535, 149, 'Tete', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2536, 149, 'Zambezia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2537, 150, 'Ayeyarwady', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2538, 150, 'Bago', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2539, 150, 'Chin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2540, 150, 'Kachin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2541, 150, 'Kayah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2542, 150, 'Kayin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2543, 150, 'Magway', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2544, 150, 'Mandalay', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2545, 150, 'Mon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2546, 150, 'Nay Pyi Taw', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2547, 150, 'Rakhine', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2548, 150, 'Sagaing', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2549, 150, 'Shan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2550, 150, 'Tanintharyi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2551, 150, 'Yangon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2552, 151, 'Caprivi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2553, 151, 'Erongo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2554, 151, 'Hardap', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2555, 151, 'Karas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2556, 151, 'Kavango', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2557, 151, 'Khomas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2558, 151, 'Kunene', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2559, 151, 'Ohangwena', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2560, 151, 'Omaheke', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2561, 151, 'Omusati', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2562, 151, 'Oshana', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2563, 151, 'Oshikoto', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2564, 151, 'Otjozondjupa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2565, 152, 'Yaren', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2566, 153, 'Bagmati', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2567, 153, 'Bheri', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL);
INSERT INTO `states` (`id`, `country_id`, `name`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2568, 153, 'Dhawalagiri', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2569, 153, 'Gandaki', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2570, 153, 'Janakpur', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2571, 153, 'Karnali', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2572, 153, 'Koshi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2573, 153, 'Lumbini', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2574, 153, 'Mahakali', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2575, 153, 'Mechi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2576, 153, 'Narayani', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2577, 153, 'Rapti', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2578, 153, 'Sagarmatha', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2579, 153, 'Seti', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2580, 154, 'Bonaire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2581, 154, 'Curacao', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2582, 154, 'Saba', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2583, 154, 'Sint Eustatius', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2584, 154, 'Sint Maarten', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2585, 155, 'Amsterdam', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2586, 155, 'Benelux', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2587, 155, 'Drenthe', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2588, 155, 'Flevoland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2589, 155, 'Friesland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2590, 155, 'Gelderland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2591, 155, 'Groningen', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2592, 155, 'Limburg', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2593, 155, 'Noord-Brabant', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2594, 155, 'Noord-Holland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2595, 155, 'Overijssel', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2596, 155, 'South Holland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2597, 155, 'Utrecht', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2598, 155, 'Zeeland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2599, 155, 'Zuid-Holland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2600, 156, 'Iles', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2601, 156, 'Nord', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2602, 156, 'Sud', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2603, 157, 'Area Outside Region', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2604, 157, 'Auckland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2605, 157, 'Bay of Plenty', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2606, 157, 'Canterbury', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2607, 157, 'Christchurch', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2608, 157, 'Gisborne', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2609, 157, 'Hawke\'s Bay', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2610, 157, 'Manawatu-Wanganui', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2611, 157, 'Marlborough', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2612, 157, 'Nelson', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2613, 157, 'Northland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2614, 157, 'Otago', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2615, 157, 'Rodney', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2616, 157, 'Southland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2617, 157, 'Taranaki', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2618, 157, 'Tasman', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2619, 157, 'Waikato', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2620, 157, 'Wellington', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2621, 157, 'West Coast', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2622, 158, 'Atlantico Norte', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2623, 158, 'Atlantico Sur', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2624, 158, 'Boaco', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2625, 158, 'Carazo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2626, 158, 'Chinandega', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2627, 158, 'Chontales', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2628, 158, 'Esteli', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2629, 158, 'Granada', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2630, 158, 'Jinotega', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2631, 158, 'Leon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2632, 158, 'Madriz', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2633, 158, 'Managua', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2634, 158, 'Masaya', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2635, 158, 'Matagalpa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2636, 158, 'Nueva Segovia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2637, 158, 'Rio San Juan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2638, 158, 'Rivas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2639, 159, 'Agadez', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2640, 159, 'Diffa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2641, 159, 'Dosso', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2642, 159, 'Maradi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2643, 159, 'Niamey', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2644, 159, 'Tahoua', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2645, 159, 'Tillabery', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2646, 159, 'Zinder', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2647, 160, 'Abia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2648, 160, 'Abuja Federal Capital Territory', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2649, 160, 'Adamawa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2650, 160, 'Akwa Ibom', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2651, 160, 'Anambra', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2652, 160, 'Bauchi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2653, 160, 'Bayelsa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2654, 160, 'Benue', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2655, 160, 'Borno', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2656, 160, 'Cross River', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2657, 160, 'Delta', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2658, 160, 'Ebonyi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2659, 160, 'Edo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2660, 160, 'Ekiti', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2661, 160, 'Enugu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2662, 160, 'Gombe', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2663, 160, 'Imo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2664, 160, 'Jigawa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2665, 160, 'Kaduna', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2666, 160, 'Kano', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2667, 160, 'Katsina', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2668, 160, 'Kebbi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2669, 160, 'Kogi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2670, 160, 'Kwara', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2671, 160, 'Lagos', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2672, 160, 'Nassarawa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2673, 160, 'Niger', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2674, 160, 'Ogun', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2675, 160, 'Ondo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2676, 160, 'Osun', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2677, 160, 'Oyo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2678, 160, 'Plateau', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2679, 160, 'Rivers', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2680, 160, 'Sokoto', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2681, 160, 'Taraba', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2682, 160, 'Yobe', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2683, 160, 'Zamfara', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2684, 161, 'Niue', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2685, 162, 'Norfolk Island', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2686, 163, 'Northern Islands', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2687, 163, 'Rota', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2688, 163, 'Saipan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2689, 163, 'Tinian', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2690, 164, 'Akershus', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2691, 164, 'Aust Agder', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2692, 164, 'Bergen', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2693, 164, 'Buskerud', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2694, 164, 'Finnmark', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2695, 164, 'Hedmark', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2696, 164, 'Hordaland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2697, 164, 'Moere og Romsdal', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2698, 164, 'Nord Trondelag', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2699, 164, 'Nordland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2700, 164, 'Oestfold', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2701, 164, 'Oppland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2702, 164, 'Oslo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2703, 164, 'Rogaland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2704, 164, 'Soer Troendelag', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2705, 164, 'Sogn og Fjordane', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2706, 164, 'Stavern', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2707, 164, 'Sykkylven', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2708, 164, 'Telemark', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2709, 164, 'Troms', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2710, 164, 'Vest Agder', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2711, 164, 'Vestfold', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2712, 164, 'ÃƒÂ˜stfold', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2713, 165, 'Al Buraimi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2714, 165, 'Dhufar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2715, 165, 'Masqat', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2716, 165, 'Musandam', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2717, 165, 'Rusayl', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2718, 165, 'Wadi Kabir', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2719, 165, 'ad-Dakhiliyah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2720, 165, 'adh-Dhahirah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2721, 165, 'al-Batinah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2722, 165, 'ash-Sharqiyah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2723, 166, 'Baluchistan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2724, 166, 'Federal Capital Area', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2725, 166, 'Federally administered Tribal ', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2726, 166, 'North-West Frontier', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2727, 166, 'Northern Areas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2728, 166, 'Punjab', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2729, 166, 'Sind', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2730, 167, 'Aimeliik', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2731, 167, 'Airai', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2732, 167, 'Angaur', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2733, 167, 'Hatobohei', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2734, 167, 'Kayangel', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2735, 167, 'Koror', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2736, 167, 'Melekeok', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2737, 167, 'Ngaraard', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2738, 167, 'Ngardmau', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2739, 167, 'Ngaremlengui', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2740, 167, 'Ngatpang', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2741, 167, 'Ngchesar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2742, 167, 'Ngerchelong', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2743, 167, 'Ngiwal', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2744, 167, 'Peleliu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2745, 167, 'Sonsorol', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2746, 168, 'Ariha', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2747, 168, 'Bayt Lahm', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2748, 168, 'Bethlehem', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2749, 168, 'Dayr-al-Balah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2750, 168, 'Ghazzah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2751, 168, 'Ghazzah ash-Shamaliyah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2752, 168, 'Janin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2753, 168, 'Khan Yunis', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2754, 168, 'Nabulus', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2755, 168, 'Qalqilyah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2756, 168, 'Rafah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2757, 168, 'Ram Allah wal-Birah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2758, 168, 'Salfit', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2759, 168, 'Tubas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2760, 168, 'Tulkarm', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2761, 168, 'al-Khalil', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2762, 168, 'al-Quds', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2763, 169, 'Bocas del Toro', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2764, 169, 'Chiriqui', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2765, 169, 'Cocle', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2766, 169, 'Colon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2767, 169, 'Darien', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2768, 169, 'Embera', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2769, 169, 'Herrera', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2770, 169, 'Kuna Yala', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2771, 169, 'Los Santos', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2772, 169, 'Ngobe Bugle', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2773, 169, 'Panama', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2774, 169, 'Veraguas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2775, 170, 'East New Britain', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2776, 170, 'East Sepik', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2777, 170, 'Eastern Highlands', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2778, 170, 'Enga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2779, 170, 'Fly River', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2780, 170, 'Gulf', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2781, 170, 'Madang', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2782, 170, 'Manus', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2783, 170, 'Milne Bay', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2784, 170, 'Morobe', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2785, 170, 'National Capital District', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2786, 170, 'New Ireland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2787, 170, 'North Solomons', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2788, 170, 'Oro', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2789, 170, 'Sandaun', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2790, 170, 'Simbu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2791, 170, 'Southern Highlands', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2792, 170, 'West New Britain', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2793, 170, 'Western Highlands', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2794, 171, 'Alto Paraguay', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2795, 171, 'Alto Parana', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2796, 171, 'Amambay', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2797, 171, 'Asuncion', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2798, 171, 'Boqueron', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2799, 171, 'Caaguazu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2800, 171, 'Caazapa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2801, 171, 'Canendiyu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2802, 171, 'Central', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2803, 171, 'Concepcion', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2804, 171, 'Cordillera', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2805, 171, 'Guaira', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2806, 171, 'Itapua', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2807, 171, 'Misiones', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2808, 171, 'Neembucu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2809, 171, 'Paraguari', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2810, 171, 'Presidente Hayes', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2811, 171, 'San Pedro', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2812, 172, 'Amazonas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2813, 172, 'Ancash', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2814, 172, 'Apurimac', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2815, 172, 'Arequipa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2816, 172, 'Ayacucho', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2817, 172, 'Cajamarca', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2818, 172, 'Cusco', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2819, 172, 'Huancavelica', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2820, 172, 'Huanuco', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2821, 172, 'Ica', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2822, 172, 'Junin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2823, 172, 'La Libertad', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2824, 172, 'Lambayeque', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2825, 172, 'Lima y Callao', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2826, 172, 'Loreto', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2827, 172, 'Madre de Dios', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2828, 172, 'Moquegua', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2829, 172, 'Pasco', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2830, 172, 'Piura', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2831, 172, 'Puno', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2832, 172, 'San Martin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2833, 172, 'Tacna', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2834, 172, 'Tumbes', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2835, 172, 'Ucayali', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2836, 173, 'Batangas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2837, 173, 'Bicol', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2838, 173, 'Bulacan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2839, 173, 'Cagayan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2840, 173, 'Caraga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2841, 173, 'Central Luzon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2842, 173, 'Central Mindanao', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2843, 173, 'Central Visayas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2844, 173, 'Cordillera', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2845, 173, 'Davao', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2846, 173, 'Eastern Visayas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2847, 173, 'Greater Metropolitan Area', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2848, 173, 'Ilocos', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2849, 173, 'Laguna', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2850, 173, 'Luzon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2851, 173, 'Mactan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2852, 173, 'Metropolitan Manila Area', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2853, 173, 'Muslim Mindanao', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2854, 173, 'Northern Mindanao', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2855, 173, 'Southern Mindanao', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2856, 173, 'Southern Tagalog', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2857, 173, 'Western Mindanao', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2858, 173, 'Western Visayas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2859, 174, 'Pitcairn Island', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2860, 175, 'Biale Blota', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2861, 175, 'Dobroszyce', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2862, 175, 'Dolnoslaskie', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2863, 175, 'Dziekanow Lesny', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2864, 175, 'Hopowo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2865, 175, 'Kartuzy', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2866, 175, 'Koscian', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2867, 175, 'Krakow', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2868, 175, 'Kujawsko-Pomorskie', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2869, 175, 'Lodzkie', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2870, 175, 'Lubelskie', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2871, 175, 'Lubuskie', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2872, 175, 'Malomice', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2873, 175, 'Malopolskie', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2874, 175, 'Mazowieckie', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2875, 175, 'Mirkow', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2876, 175, 'Opolskie', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2877, 175, 'Ostrowiec', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2878, 175, 'Podkarpackie', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2879, 175, 'Podlaskie', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2880, 175, 'Polska', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2881, 175, 'Pomorskie', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2882, 175, 'Poznan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2883, 175, 'Pruszkow', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2884, 175, 'Rymanowska', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2885, 175, 'Rzeszow', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2886, 175, 'Slaskie', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2887, 175, 'Stare Pole', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2888, 175, 'Swietokrzyskie', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2889, 175, 'Warminsko-Mazurskie', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2890, 175, 'Warsaw', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2891, 175, 'Wejherowo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2892, 175, 'Wielkopolskie', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2893, 175, 'Wroclaw', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2894, 175, 'Zachodnio-Pomorskie', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2895, 175, 'Zukowo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2896, 176, 'Abrantes', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2897, 176, 'Acores', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2898, 176, 'Alentejo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2899, 176, 'Algarve', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2900, 176, 'Braga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2901, 176, 'Centro', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2902, 176, 'Distrito de Leiria', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2903, 176, 'Distrito de Viana do Castelo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2904, 176, 'Distrito de Vila Real', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2905, 176, 'Distrito do Porto', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2906, 176, 'Lisboa e Vale do Tejo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2907, 176, 'Madeira', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2908, 176, 'Norte', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2909, 176, 'Paivas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2910, 177, 'Arecibo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2911, 177, 'Bayamon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2912, 177, 'Carolina', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2913, 177, 'Florida', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2914, 177, 'Guayama', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2915, 177, 'Humacao', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2916, 177, 'Mayaguez-Aguadilla', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2917, 177, 'Ponce', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2918, 177, 'Salinas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2919, 177, 'San Juan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2920, 178, 'Doha', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2921, 178, 'Jarian-al-Batnah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2922, 178, 'Umm Salal', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2923, 178, 'ad-Dawhah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2924, 178, 'al-Ghuwayriyah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2925, 178, 'al-Jumayliyah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2926, 178, 'al-Khawr', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2927, 178, 'al-Wakrah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2928, 178, 'ar-Rayyan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2929, 178, 'ash-Shamal', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2930, 179, 'Saint-Benoit', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2931, 179, 'Saint-Denis', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2932, 179, 'Saint-Paul', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2933, 179, 'Saint-Pierre', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2934, 180, 'Alba', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2935, 180, 'Arad', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2936, 180, 'Arges', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2937, 180, 'Bacau', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2938, 180, 'Bihor', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2939, 180, 'Bistrita-Nasaud', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2940, 180, 'Botosani', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2941, 180, 'Braila', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2942, 180, 'Brasov', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2943, 180, 'Bucuresti', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2944, 180, 'Buzau', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2945, 180, 'Calarasi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2946, 180, 'Caras-Severin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2947, 180, 'Cluj', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2948, 180, 'Constanta', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2949, 180, 'Covasna', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2950, 180, 'Dambovita', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2951, 180, 'Dolj', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2952, 180, 'Galati', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2953, 180, 'Giurgiu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2954, 180, 'Gorj', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2955, 180, 'Harghita', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2956, 180, 'Hunedoara', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2957, 180, 'Ialomita', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2958, 180, 'Iasi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2959, 180, 'Ilfov', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2960, 180, 'Maramures', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2961, 180, 'Mehedinti', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2962, 180, 'Mures', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2963, 180, 'Neamt', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2964, 180, 'Olt', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2965, 180, 'Prahova', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2966, 180, 'Salaj', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2967, 180, 'Satu Mare', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2968, 180, 'Sibiu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2969, 180, 'Sondelor', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2970, 180, 'Suceava', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2971, 180, 'Teleorman', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2972, 180, 'Timis', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2973, 180, 'Tulcea', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2974, 180, 'Valcea', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2975, 180, 'Vaslui', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2976, 180, 'Vrancea', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2977, 181, 'Adygeja', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2978, 181, 'Aga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2979, 181, 'Alanija', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2980, 181, 'Altaj', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2981, 181, 'Amur', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2982, 181, 'Arhangelsk', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2983, 181, 'Astrahan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2984, 181, 'Bashkortostan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2985, 181, 'Belgorod', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2986, 181, 'Brjansk', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2987, 181, 'Burjatija', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2988, 181, 'Chechenija', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2989, 181, 'Cheljabinsk', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2990, 181, 'Chita', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2991, 181, 'Chukotka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2992, 181, 'Chuvashija', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2993, 181, 'Dagestan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2994, 181, 'Evenkija', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2995, 181, 'Gorno-Altaj', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2996, 181, 'Habarovsk', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2997, 181, 'Hakasija', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2998, 181, 'Hanty-Mansija', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(2999, 181, 'Ingusetija', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3000, 181, 'Irkutsk', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3001, 181, 'Ivanovo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3002, 181, 'Jamalo-Nenets', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3003, 181, 'Jaroslavl', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3004, 181, 'Jevrej', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3005, 181, 'Kabardino-Balkarija', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3006, 181, 'Kaliningrad', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3007, 181, 'Kalmykija', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3008, 181, 'Kaluga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3009, 181, 'Kamchatka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3010, 181, 'Karachaj-Cherkessija', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3011, 181, 'Karelija', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3012, 181, 'Kemerovo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3013, 181, 'Khabarovskiy Kray', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3014, 181, 'Kirov', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3015, 181, 'Komi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3016, 181, 'Komi-Permjakija', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3017, 181, 'Korjakija', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3018, 181, 'Kostroma', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3019, 181, 'Krasnodar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3020, 181, 'Krasnojarsk', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3021, 181, 'Krasnoyarskiy Kray', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3022, 181, 'Kurgan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3023, 181, 'Kursk', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3024, 181, 'Leningrad', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3025, 181, 'Lipeck', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3026, 181, 'Magadan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3027, 181, 'Marij El', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3028, 181, 'Mordovija', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3029, 181, 'Moscow', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3030, 181, 'Moskovskaja Oblast', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3031, 181, 'Moskovskaya Oblast', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3032, 181, 'Moskva', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3033, 181, 'Murmansk', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3034, 181, 'Nenets', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3035, 181, 'Nizhnij Novgorod', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3036, 181, 'Novgorod', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3037, 181, 'Novokusnezk', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3038, 181, 'Novosibirsk', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3039, 181, 'Omsk', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3040, 181, 'Orenburg', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3041, 181, 'Orjol', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3042, 181, 'Penza', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3043, 181, 'Perm', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3044, 181, 'Primorje', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3045, 181, 'Pskov', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3046, 181, 'Pskovskaya Oblast', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3047, 181, 'Rjazan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3048, 181, 'Rostov', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3049, 181, 'Saha', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3050, 181, 'Sahalin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3051, 181, 'Samara', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3052, 181, 'Samarskaya', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3053, 181, 'Sankt-Peterburg', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3054, 181, 'Saratov', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3055, 181, 'Smolensk', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3056, 181, 'Stavropol', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3057, 181, 'Sverdlovsk', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3058, 181, 'Tajmyrija', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3059, 181, 'Tambov', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3060, 181, 'Tatarstan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3061, 181, 'Tjumen', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3062, 181, 'Tomsk', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3063, 181, 'Tula', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3064, 181, 'Tver', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3065, 181, 'Tyva', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3066, 181, 'Udmurtija', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3067, 181, 'Uljanovsk', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3068, 181, 'Ulyanovskaya Oblast', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3069, 181, 'Ust-Orda', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3070, 181, 'Vladimir', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3071, 181, 'Volgograd', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3072, 181, 'Vologda', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3073, 181, 'Voronezh', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3074, 182, 'Butare', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3075, 182, 'Byumba', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3076, 182, 'Cyangugu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3077, 182, 'Gikongoro', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3078, 182, 'Gisenyi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3079, 182, 'Gitarama', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3080, 182, 'Kibungo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3081, 182, 'Kibuye', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3082, 182, 'Kigali-ngali', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3083, 182, 'Ruhengeri', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3084, 183, 'Ascension', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3085, 183, 'Gough Island', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3086, 183, 'Saint Helena', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3087, 183, 'Tristan da Cunha', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3088, 184, 'Christ Church Nichola Town', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3089, 184, 'Saint Anne Sandy Point', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3090, 184, 'Saint George Basseterre', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3091, 184, 'Saint George Gingerland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3092, 184, 'Saint James Windward', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3093, 184, 'Saint John Capesterre', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3094, 184, 'Saint John Figtree', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3095, 184, 'Saint Mary Cayon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3096, 184, 'Saint Paul Capesterre', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3097, 184, 'Saint Paul Charlestown', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3098, 184, 'Saint Peter Basseterre', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3099, 184, 'Saint Thomas Lowland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3100, 184, 'Saint Thomas Middle Island', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3101, 184, 'Trinity Palmetto Point', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3102, 185, 'Anse-la-Raye', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3103, 185, 'Canaries', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3104, 185, 'Castries', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3105, 185, 'Choiseul', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3106, 185, 'Dennery', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3107, 185, 'Gros Inlet', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3108, 185, 'Laborie', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3109, 185, 'Micoud', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3110, 185, 'Soufriere', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3111, 185, 'Vieux Fort', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3112, 186, 'Miquelon-Langlade', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3113, 186, 'Saint-Pierre', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3114, 187, 'Charlotte', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3115, 187, 'Grenadines', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3116, 187, 'Saint Andrew', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3117, 187, 'Saint David', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3118, 187, 'Saint George', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3119, 187, 'Saint Patrick', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3120, 188, 'A\'ana', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3121, 188, 'Aiga-i-le-Tai', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3122, 188, 'Atua', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3123, 188, 'Fa\'asaleleaga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3124, 188, 'Gaga\'emauga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3125, 188, 'Gagaifomauga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3126, 188, 'Palauli', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3127, 188, 'Satupa\'itea', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3128, 188, 'Tuamasaga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3129, 188, 'Va\'a-o-Fonoti', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3130, 188, 'Vaisigano', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3131, 189, 'Acquaviva', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3132, 189, 'Borgo Maggiore', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3133, 189, 'Chiesanuova', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3134, 189, 'Domagnano', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3135, 189, 'Faetano', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3136, 189, 'Fiorentino', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3137, 189, 'Montegiardino', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3138, 189, 'San Marino', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3139, 189, 'Serravalle', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3140, 190, 'Agua Grande', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3141, 190, 'Cantagalo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3142, 190, 'Lemba', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3143, 190, 'Lobata', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3144, 190, 'Me-Zochi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3145, 190, 'Pague', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3146, 191, 'Al Khobar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3147, 191, 'Aseer', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3148, 191, 'Ash Sharqiyah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3149, 191, 'Asir', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3150, 191, 'Central Province', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3151, 191, 'Eastern Province', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3152, 191, 'Ha\'il', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3153, 191, 'Jawf', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3154, 191, 'Jizan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3155, 191, 'Makkah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3156, 191, 'Najran', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3157, 191, 'Qasim', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3158, 191, 'Tabuk', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3159, 191, 'Western Province', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3160, 191, 'al-Bahah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3161, 191, 'al-Hudud-ash-Shamaliyah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3162, 191, 'al-Madinah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3163, 191, 'ar-Riyad', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3164, 192, 'Dakar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3165, 192, 'Diourbel', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3166, 192, 'Fatick', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3167, 192, 'Kaolack', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3168, 192, 'Kolda', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3169, 192, 'Louga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3170, 192, 'Saint-Louis', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3171, 192, 'Tambacounda', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3172, 192, 'Thies', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3173, 192, 'Ziguinchor', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3174, 193, 'Central Serbia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3175, 193, 'Kosovo and Metohija', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3176, 193, 'Vojvodina', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3177, 194, 'Anse Boileau', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3178, 194, 'Anse Royale', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3179, 194, 'Cascade', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3180, 194, 'Takamaka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3181, 194, 'Victoria', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3182, 195, 'Eastern', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3183, 195, 'Northern', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3184, 195, 'Southern', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3185, 195, 'Western', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3186, 196, 'Singapore', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3187, 197, 'Banskobystricky', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3188, 197, 'Bratislavsky', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3189, 197, 'Kosicky', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3190, 197, 'Nitriansky', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3191, 197, 'Presovsky', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3192, 197, 'Trenciansky', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3193, 197, 'Trnavsky', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3194, 197, 'Zilinsky', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3195, 198, 'Benedikt', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3196, 198, 'Gorenjska', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3197, 198, 'Gorishka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL);
INSERT INTO `states` (`id`, `country_id`, `name`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3198, 198, 'Jugovzhodna Slovenija', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3199, 198, 'Koroshka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3200, 198, 'Notranjsko-krashka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3201, 198, 'Obalno-krashka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3202, 198, 'Obcina Domzale', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3203, 198, 'Obcina Vitanje', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3204, 198, 'Osrednjeslovenska', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3205, 198, 'Podravska', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3206, 198, 'Pomurska', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3207, 198, 'Savinjska', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3208, 198, 'Slovenian Littoral', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3209, 198, 'Spodnjeposavska', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3210, 198, 'Zasavska', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3211, 199, 'Pitcairn', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3212, 200, 'Central', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3213, 200, 'Choiseul', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3214, 200, 'Guadalcanal', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3215, 200, 'Isabel', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3216, 200, 'Makira and Ulawa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3217, 200, 'Malaita', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3218, 200, 'Rennell and Bellona', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3219, 200, 'Temotu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3220, 200, 'Western', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3221, 201, 'Awdal', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3222, 201, 'Bakol', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3223, 201, 'Banadir', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3224, 201, 'Bari', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3225, 201, 'Bay', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3226, 201, 'Galgudug', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3227, 201, 'Gedo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3228, 201, 'Hiran', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3229, 201, 'Jubbada Hose', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3230, 201, 'Jubbadha Dexe', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3231, 201, 'Mudug', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3232, 201, 'Nugal', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3233, 201, 'Sanag', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3234, 201, 'Shabellaha Dhexe', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3235, 201, 'Shabellaha Hose', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3236, 201, 'Togdher', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3237, 201, 'Woqoyi Galbed', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3238, 202, 'Eastern Cape', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3239, 202, 'Free State', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3240, 202, 'Gauteng', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3241, 202, 'Kempton Park', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3242, 202, 'Kramerville', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3243, 202, 'KwaZulu Natal', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3244, 202, 'Limpopo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3245, 202, 'Mpumalanga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3246, 202, 'North West', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3247, 202, 'Northern Cape', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3248, 202, 'Parow', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3249, 202, 'Table View', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3250, 202, 'Umtentweni', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3251, 202, 'Western Cape', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3252, 203, 'South Georgia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3253, 204, 'Central Equatoria', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3254, 205, 'A Coruna', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3255, 205, 'Alacant', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3256, 205, 'Alava', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3257, 205, 'Albacete', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3258, 205, 'Almeria', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3260, 205, 'Asturias', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3261, 205, 'Avila', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3262, 205, 'Badajoz', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3263, 205, 'Balears', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3264, 205, 'Barcelona', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3267, 205, 'Burgos', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3268, 205, 'Caceres', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3269, 205, 'Cadiz', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3270, 205, 'Cantabria', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3271, 205, 'Castello', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3273, 205, 'Ceuta', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3274, 205, 'Ciudad Real', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3281, 205, 'Cordoba', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3282, 205, 'Cuenca', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3284, 205, 'Girona', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3285, 205, 'Granada', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3286, 205, 'Guadalajara', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3287, 205, 'Guipuzcoa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3288, 205, 'Huelva', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3289, 205, 'Huesca', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3290, 205, 'Jaen', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3291, 205, 'La Rioja', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3292, 205, 'Las Palmas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3293, 205, 'Leon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3295, 205, 'Lleida', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3296, 205, 'Lugo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3297, 205, 'Madrid', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3298, 205, 'Malaga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3299, 205, 'Melilla', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3300, 205, 'Murcia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3301, 205, 'Navarra', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3302, 205, 'Ourense', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3303, 205, 'Pais Vasco', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3304, 205, 'Palencia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3305, 205, 'Pontevedra', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3306, 205, 'Salamanca', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3308, 205, 'Segovia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3309, 205, 'Sevilla', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3310, 205, 'Soria', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3311, 205, 'Tarragona', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3312, 205, 'Santa Cruz de Tenerife', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3313, 205, 'Teruel', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3314, 205, 'Toledo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3315, 205, 'Valencia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3316, 205, 'Valladolid', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3317, 205, 'Vizcaya', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3318, 205, 'Zamora', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3319, 205, 'Zaragoza', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3320, 206, 'Amparai', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3321, 206, 'Anuradhapuraya', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3322, 206, 'Badulla', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3323, 206, 'Boralesgamuwa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3324, 206, 'Colombo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3325, 206, 'Galla', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3326, 206, 'Gampaha', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3327, 206, 'Hambantota', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3328, 206, 'Kalatura', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3329, 206, 'Kegalla', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3330, 206, 'Kilinochchi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3331, 206, 'Kurunegala', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3332, 206, 'Madakalpuwa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3333, 206, 'Maha Nuwara', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3334, 206, 'Malwana', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3335, 206, 'Mannarama', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3336, 206, 'Matale', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3337, 206, 'Matara', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3338, 206, 'Monaragala', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3339, 206, 'Mullaitivu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3340, 206, 'North Eastern Province', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3341, 206, 'North Western Province', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3342, 206, 'Nuwara Eliya', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3343, 206, 'Polonnaruwa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3344, 206, 'Puttalama', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3345, 206, 'Ratnapuraya', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3346, 206, 'Southern Province', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3347, 206, 'Tirikunamalaya', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3348, 206, 'Tuscany', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3349, 206, 'Vavuniyawa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3350, 206, 'Western Province', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3351, 206, 'Yapanaya', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3352, 206, 'kadawatha', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3353, 207, 'A\'ali-an-Nil', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3354, 207, 'Bahr-al-Jabal', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3355, 207, 'Central Equatoria', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3356, 207, 'Gharb Bahr-al-Ghazal', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3357, 207, 'Gharb Darfur', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3358, 207, 'Gharb Kurdufan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3359, 207, 'Gharb-al-Istiwa\'iyah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3360, 207, 'Janub Darfur', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3361, 207, 'Janub Kurdufan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3362, 207, 'Junqali', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3363, 207, 'Kassala', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3364, 207, 'Nahr-an-Nil', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3365, 207, 'Shamal Bahr-al-Ghazal', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3366, 207, 'Shamal Darfur', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3367, 207, 'Shamal Kurdufan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3368, 207, 'Sharq-al-Istiwa\'iyah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3369, 207, 'Sinnar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3370, 207, 'Warab', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3371, 207, 'Wilayat al Khartum', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3372, 207, 'al-Bahr-al-Ahmar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3373, 207, 'al-Buhayrat', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3374, 207, 'al-Jazirah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3375, 207, 'al-Khartum', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3376, 207, 'al-Qadarif', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3377, 207, 'al-Wahdah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3378, 207, 'an-Nil-al-Abyad', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3379, 207, 'an-Nil-al-Azraq', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3380, 207, 'ash-Shamaliyah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3381, 208, 'Brokopondo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3382, 208, 'Commewijne', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3383, 208, 'Coronie', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3384, 208, 'Marowijne', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3385, 208, 'Nickerie', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3386, 208, 'Para', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3387, 208, 'Paramaribo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3388, 208, 'Saramacca', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3389, 208, 'Wanica', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3390, 209, 'Svalbard', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3391, 210, 'Hhohho', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3392, 210, 'Lubombo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3393, 210, 'Manzini', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3394, 210, 'Shiselweni', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3395, 211, 'Alvsborgs Lan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3396, 211, 'Angermanland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3397, 211, 'Blekinge', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3398, 211, 'Bohuslan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3399, 211, 'Dalarna', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3400, 211, 'Gavleborg', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3401, 211, 'Gaza', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3402, 211, 'Gotland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3403, 211, 'Halland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3404, 211, 'Jamtland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3405, 211, 'Jonkoping', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3406, 211, 'Kalmar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3407, 211, 'Kristianstads', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3408, 211, 'Kronoberg', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3409, 211, 'Norrbotten', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3410, 211, 'Orebro', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3411, 211, 'Ostergotland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3412, 211, 'Saltsjo-Boo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3413, 211, 'Skane', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3414, 211, 'Smaland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3415, 211, 'Sodermanland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3416, 211, 'Stockholm', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3417, 211, 'Uppsala', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3418, 211, 'Varmland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3419, 211, 'Vasterbotten', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3420, 211, 'Vastergotland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3421, 211, 'Vasternorrland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3422, 211, 'Vastmanland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3423, 211, 'Vastra Gotaland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3424, 212, 'Aargau', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3425, 212, 'Appenzell Inner-Rhoden', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3426, 212, 'Appenzell-Ausser Rhoden', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3427, 212, 'Basel-Landschaft', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3428, 212, 'Basel-Stadt', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3429, 212, 'Bern', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3430, 212, 'Canton Ticino', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3431, 212, 'Fribourg', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3432, 212, 'Geneve', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3433, 212, 'Glarus', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3434, 212, 'Graubunden', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3435, 212, 'Heerbrugg', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3436, 212, 'Jura', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3437, 212, 'Kanton Aargau', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3438, 212, 'Luzern', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3439, 212, 'Morbio Inferiore', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3440, 212, 'Muhen', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3441, 212, 'Neuchatel', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3442, 212, 'Nidwalden', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3443, 212, 'Obwalden', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3444, 212, 'Sankt Gallen', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3445, 212, 'Schaffhausen', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3446, 212, 'Schwyz', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3447, 212, 'Solothurn', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3448, 212, 'Thurgau', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3449, 212, 'Ticino', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3450, 212, 'Uri', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3451, 212, 'Valais', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3452, 212, 'Vaud', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3453, 212, 'Vauffelin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3454, 212, 'Zug', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3455, 212, 'Zurich', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3456, 213, 'Aleppo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3457, 213, 'Dar\'a', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3458, 213, 'Dayr-az-Zawr', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3459, 213, 'Dimashq', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3460, 213, 'Halab', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3461, 213, 'Hamah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3462, 213, 'Hims', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3463, 213, 'Idlib', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3464, 213, 'Madinat Dimashq', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3465, 213, 'Tartus', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3466, 213, 'al-Hasakah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3467, 213, 'al-Ladhiqiyah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3468, 213, 'al-Qunaytirah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3469, 213, 'ar-Raqqah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3470, 213, 'as-Suwayda', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3471, 214, 'Changhua County', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3472, 214, 'Chiayi County', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3473, 214, 'Chiayi City', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3474, 214, 'Taipei City', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3475, 214, 'Hsinchu County', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3476, 214, 'Hsinchu City', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3477, 214, 'Hualien County', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3480, 214, 'Kaohsiung City', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3481, 214, 'Keelung City', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3482, 214, 'Kinmen County', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3483, 214, 'Miaoli County', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3484, 214, 'Nantou County', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3486, 214, 'Penghu County', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3487, 214, 'Pingtung County', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3488, 214, 'Taichung City', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3492, 214, 'Tainan City', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3493, 214, 'New Taipei City', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3495, 214, 'Taitung County', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3496, 214, 'Taoyuan City', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3497, 214, 'Yilan County', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3498, 214, 'YunLin County', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3500, 215, 'Dushanbe', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3501, 215, 'Gorno-Badakhshan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3502, 215, 'Karotegin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3503, 215, 'Khatlon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3504, 215, 'Sughd', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3505, 216, 'Arusha', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3506, 216, 'Dar es Salaam', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3507, 216, 'Dodoma', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3508, 216, 'Iringa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3509, 216, 'Kagera', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3510, 216, 'Kigoma', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3511, 216, 'Kilimanjaro', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3512, 216, 'Lindi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3513, 216, 'Mara', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3514, 216, 'Mbeya', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3515, 216, 'Morogoro', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3516, 216, 'Mtwara', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3517, 216, 'Mwanza', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3518, 216, 'Pwani', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3519, 216, 'Rukwa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3520, 216, 'Ruvuma', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3521, 216, 'Shinyanga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3522, 216, 'Singida', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3523, 216, 'Tabora', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3524, 216, 'Tanga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3525, 216, 'Zanzibar and Pemba', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3526, 217, 'Amnat Charoen', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3527, 217, 'Ang Thong', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3528, 217, 'Bangkok', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3529, 217, 'Buri Ram', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3530, 217, 'Chachoengsao', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3531, 217, 'Chai Nat', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3532, 217, 'Chaiyaphum', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3533, 217, 'Changwat Chaiyaphum', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3534, 217, 'Chanthaburi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3535, 217, 'Chiang Mai', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3536, 217, 'Chiang Rai', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3537, 217, 'Chon Buri', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3538, 217, 'Chumphon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3539, 217, 'Kalasin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3540, 217, 'Kamphaeng Phet', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3541, 217, 'Kanchanaburi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3542, 217, 'Khon Kaen', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3543, 217, 'Krabi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3544, 217, 'Krung Thep', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3545, 217, 'Lampang', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3546, 217, 'Lamphun', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3547, 217, 'Loei', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3548, 217, 'Lop Buri', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3549, 217, 'Mae Hong Son', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3550, 217, 'Maha Sarakham', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3551, 217, 'Mukdahan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3552, 217, 'Nakhon Nayok', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3553, 217, 'Nakhon Pathom', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3554, 217, 'Nakhon Phanom', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3555, 217, 'Nakhon Ratchasima', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3556, 217, 'Nakhon Sawan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3557, 217, 'Nakhon Si Thammarat', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3558, 217, 'Nan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3559, 217, 'Narathiwat', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3560, 217, 'Nong Bua Lam Phu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3561, 217, 'Nong Khai', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3562, 217, 'Nonthaburi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3563, 217, 'Pathum Thani', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3564, 217, 'Pattani', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3565, 217, 'Phangnga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3566, 217, 'Phatthalung', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3567, 217, 'Phayao', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3568, 217, 'Phetchabun', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3569, 217, 'Phetchaburi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3570, 217, 'Phichit', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3571, 217, 'Phitsanulok', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3572, 217, 'Phra Nakhon Si Ayutthaya', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3573, 217, 'Phrae', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3574, 217, 'Phuket', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3575, 217, 'Prachin Buri', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3576, 217, 'Prachuap Khiri Khan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3577, 217, 'Ranong', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3578, 217, 'Ratchaburi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3579, 217, 'Rayong', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3580, 217, 'Roi Et', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3581, 217, 'Sa Kaeo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3582, 217, 'Sakon Nakhon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3583, 217, 'Samut Prakan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3584, 217, 'Samut Sakhon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3585, 217, 'Samut Songkhran', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3586, 217, 'Saraburi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3587, 217, 'Satun', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3588, 217, 'Si Sa Ket', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3589, 217, 'Sing Buri', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3590, 217, 'Songkhla', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3591, 217, 'Sukhothai', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3592, 217, 'Suphan Buri', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3593, 217, 'Surat Thani', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3594, 217, 'Surin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3595, 217, 'Tak', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3596, 217, 'Trang', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3597, 217, 'Trat', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3598, 217, 'Ubon Ratchathani', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3599, 217, 'Udon Thani', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3600, 217, 'Uthai Thani', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3601, 217, 'Uttaradit', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3602, 217, 'Yala', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3603, 217, 'Yasothon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3604, 218, 'Centre', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3605, 218, 'Kara', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3606, 218, 'Maritime', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3607, 218, 'Plateaux', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3608, 218, 'Savanes', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3609, 219, 'Atafu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3610, 219, 'Fakaofo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3611, 219, 'Nukunonu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3612, 220, 'Eua', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3613, 220, 'Ha\'apai', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3614, 220, 'Niuas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3615, 220, 'Tongatapu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3616, 220, 'Vava\'u', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3617, 221, 'Arima-Tunapuna-Piarco', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3618, 221, 'Caroni', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3619, 221, 'Chaguanas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3620, 221, 'Couva-Tabaquite-Talparo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3621, 221, 'Diego Martin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3622, 221, 'Glencoe', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3623, 221, 'Penal Debe', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3624, 221, 'Point Fortin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3625, 221, 'Port of Spain', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3626, 221, 'Princes Town', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3627, 221, 'Saint George', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3628, 221, 'San Fernando', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3629, 221, 'San Juan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3630, 221, 'Sangre Grande', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3631, 221, 'Siparia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3632, 221, 'Tobago', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3633, 222, 'Aryanah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3634, 222, 'Bajah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3635, 222, 'Bin \'Arus', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3636, 222, 'Binzart', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3637, 222, 'Gouvernorat de Ariana', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3638, 222, 'Gouvernorat de Nabeul', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3639, 222, 'Gouvernorat de Sousse', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3640, 222, 'Hammamet Yasmine', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3641, 222, 'Jundubah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3642, 222, 'Madaniyin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3643, 222, 'Manubah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3644, 222, 'Monastir', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3645, 222, 'Nabul', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3646, 222, 'Qabis', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3647, 222, 'Qafsah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3648, 222, 'Qibili', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3649, 222, 'Safaqis', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3650, 222, 'Sfax', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3651, 222, 'Sidi Bu Zayd', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3652, 222, 'Silyanah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3653, 222, 'Susah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3654, 222, 'Tatawin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3655, 222, 'Tawzar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3656, 222, 'Tunis', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3657, 222, 'Zaghwan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3658, 222, 'al-Kaf', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3659, 222, 'al-Mahdiyah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3660, 222, 'al-Munastir', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3661, 222, 'al-Qasrayn', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3662, 222, 'al-Qayrawan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3663, 223, 'Adana', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3664, 223, 'Adiyaman', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3665, 223, 'Afyon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3666, 223, 'Agri', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3667, 223, 'Aksaray', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3668, 223, 'Amasya', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3669, 223, 'Ankara', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3670, 223, 'Antalya', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3671, 223, 'Ardahan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3672, 223, 'Artvin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3673, 223, 'Aydin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3674, 223, 'Balikesir', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3675, 223, 'Bartin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3676, 223, 'Batman', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3677, 223, 'Bayburt', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3678, 223, 'Bilecik', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3679, 223, 'Bingol', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3680, 223, 'Bitlis', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3681, 223, 'Bolu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3682, 223, 'Burdur', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3683, 223, 'Bursa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3684, 223, 'Canakkale', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3685, 223, 'Cankiri', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3686, 223, 'Corum', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3687, 223, 'Denizli', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3688, 223, 'Diyarbakir', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3689, 223, 'Duzce', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3690, 223, 'Edirne', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3691, 223, 'Elazig', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3692, 223, 'Erzincan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3693, 223, 'Erzurum', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3694, 223, 'Eskisehir', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3695, 223, 'Gaziantep', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3696, 223, 'Giresun', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3697, 223, 'Gumushane', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3698, 223, 'Hakkari', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3699, 223, 'Hatay', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3700, 223, 'Icel', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3701, 223, 'Igdir', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3702, 223, 'Isparta', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3703, 223, 'Istanbul', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3704, 223, 'Izmir', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3705, 223, 'Kahramanmaras', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3706, 223, 'Karabuk', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3707, 223, 'Karaman', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3708, 223, 'Kars', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3709, 223, 'Karsiyaka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3710, 223, 'Kastamonu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3711, 223, 'Kayseri', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3712, 223, 'Kilis', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3713, 223, 'Kirikkale', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3714, 223, 'Kirklareli', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3715, 223, 'Kirsehir', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3716, 223, 'Kocaeli', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3717, 223, 'Konya', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3718, 223, 'Kutahya', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3719, 223, 'Lefkosa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3720, 223, 'Malatya', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3721, 223, 'Manisa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3722, 223, 'Mardin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3723, 223, 'Mugla', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3724, 223, 'Mus', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3725, 223, 'Nevsehir', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3726, 223, 'Nigde', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3727, 223, 'Ordu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3728, 223, 'Osmaniye', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3729, 223, 'Rize', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3730, 223, 'Sakarya', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3731, 223, 'Samsun', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3732, 223, 'Sanliurfa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3733, 223, 'Siirt', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3734, 223, 'Sinop', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3735, 223, 'Sirnak', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3736, 223, 'Sivas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3737, 223, 'Tekirdag', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3738, 223, 'Tokat', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3739, 223, 'Trabzon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3740, 223, 'Tunceli', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3741, 223, 'Usak', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3742, 223, 'Van', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3743, 223, 'Yalova', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3744, 223, 'Yozgat', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3745, 223, 'Zonguldak', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3746, 224, 'Ahal', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3747, 224, 'Asgabat', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3748, 224, 'Balkan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3749, 224, 'Dasoguz', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3750, 224, 'Lebap', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3751, 224, 'Mari', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3752, 225, 'Grand Turk', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3753, 225, 'South Caicos and East Caicos', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3754, 226, 'Funafuti', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3755, 226, 'Nanumanga', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3756, 226, 'Nanumea', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3757, 226, 'Niutao', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3758, 226, 'Nui', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3759, 226, 'Nukufetau', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3760, 226, 'Nukulaelae', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3761, 226, 'Vaitupu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3762, 227, 'Central', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3763, 227, 'Eastern', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3764, 227, 'Northern', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3765, 227, 'Western', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3766, 228, 'Cherkas\'ka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3767, 228, 'Chernihivs\'ka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3768, 228, 'Chernivets\'ka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3769, 228, 'Crimea', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3770, 228, 'Dnipropetrovska', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3771, 228, 'Donets\'ka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3772, 228, 'Ivano-Frankivs\'ka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3773, 228, 'Kharkiv', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3774, 228, 'Kharkov', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3775, 228, 'Khersonska', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3776, 228, 'Khmel\'nyts\'ka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3777, 228, 'Kirovohrad', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3778, 228, 'Krym', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3779, 228, 'Kyyiv', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3780, 228, 'Kyyivs\'ka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3781, 228, 'L\'vivs\'ka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3782, 228, 'Luhans\'ka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3783, 228, 'Mykolayivs\'ka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3784, 228, 'Odes\'ka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3785, 228, 'Odessa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3786, 228, 'Poltavs\'ka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3787, 228, 'Rivnens\'ka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3788, 228, 'Sevastopol\'', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3789, 228, 'Sums\'ka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3790, 228, 'Ternopil\'s\'ka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3791, 228, 'Volyns\'ka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3792, 228, 'Vynnyts\'ka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3793, 228, 'Zakarpats\'ka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3794, 228, 'Zaporizhia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3795, 228, 'Zhytomyrs\'ka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3796, 229, 'Abu Zabi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3797, 229, 'Ajman', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3798, 229, 'Dubai', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3799, 229, 'Ras al-Khaymah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3800, 229, 'Sharjah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3801, 229, 'Sharjha', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3802, 229, 'Umm al Qaywayn', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3803, 229, 'al-Fujayrah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3804, 229, 'ash-Shariqah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3805, 230, 'Aberdeen', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3806, 230, 'Aberdeenshire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3807, 230, 'Argyll', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3808, 230, 'Armagh', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3809, 230, 'Bedfordshire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3810, 230, 'Belfast', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3811, 230, 'Berkshire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3812, 230, 'Birmingham', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3813, 230, 'Brechin', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3814, 230, 'Bridgnorth', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3815, 230, 'Bristol', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3816, 230, 'Buckinghamshire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3817, 230, 'Cambridge', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3818, 230, 'Cambridgeshire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3819, 230, 'Channel Islands', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3820, 230, 'Cheshire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3821, 230, 'Cleveland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3822, 230, 'Co Fermanagh', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3823, 230, 'Conwy', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3824, 230, 'Cornwall', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3825, 230, 'Coventry', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3826, 230, 'Craven Arms', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3827, 230, 'Cumbria', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3828, 230, 'Denbighshire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3829, 230, 'Derby', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3830, 230, 'Derbyshire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3831, 230, 'Devon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3832, 230, 'Dial Code Dungannon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3833, 230, 'Didcot', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3834, 230, 'Dorset', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3835, 230, 'Dunbartonshire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3836, 230, 'Durham', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3837, 230, 'East Dunbartonshire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3838, 230, 'East Lothian', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3839, 230, 'East Midlands', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3840, 230, 'East Sussex', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3841, 230, 'East Yorkshire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3842, 230, 'England', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3843, 230, 'Essex', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3844, 230, 'Fermanagh', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3845, 230, 'Fife', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3846, 230, 'Flintshire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3847, 230, 'Fulham', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3848, 230, 'Gainsborough', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL);
INSERT INTO `states` (`id`, `country_id`, `name`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3849, 230, 'Glocestershire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3850, 230, 'Gwent', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3851, 230, 'Hampshire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3852, 230, 'Hants', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3853, 230, 'Herefordshire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3854, 230, 'Hertfordshire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3855, 230, 'Ireland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3856, 230, 'Isle Of Man', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3857, 230, 'Isle of Wight', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3858, 230, 'Kenford', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3859, 230, 'Kent', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3860, 230, 'Kilmarnock', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3861, 230, 'Lanarkshire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3862, 230, 'Lancashire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3863, 230, 'Leicestershire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3864, 230, 'Lincolnshire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3865, 230, 'Llanymynech', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3866, 230, 'London', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3867, 230, 'Ludlow', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3868, 230, 'Manchester', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3869, 230, 'Mayfair', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3870, 230, 'Merseyside', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3871, 230, 'Mid Glamorgan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3872, 230, 'Middlesex', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3873, 230, 'Mildenhall', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3874, 230, 'Monmouthshire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3875, 230, 'Newton Stewart', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3876, 230, 'Norfolk', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3877, 230, 'North Humberside', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3878, 230, 'North Yorkshire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3879, 230, 'Northamptonshire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3880, 230, 'Northants', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3881, 230, 'Northern Ireland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3882, 230, 'Northumberland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3883, 230, 'Nottinghamshire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3884, 230, 'Oxford', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3885, 230, 'Powys', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3886, 230, 'Roos-shire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3887, 230, 'SUSSEX', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3888, 230, 'Sark', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3889, 230, 'Scotland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3890, 230, 'Scottish Borders', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3891, 230, 'Shropshire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3892, 230, 'Somerset', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3893, 230, 'South Glamorgan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3894, 230, 'South Wales', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3895, 230, 'South Yorkshire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3896, 230, 'Southwell', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3897, 230, 'Staffordshire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3898, 230, 'Strabane', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3899, 230, 'Suffolk', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3900, 230, 'Surrey', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3901, 230, 'Sussex', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3902, 230, 'Twickenham', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3903, 230, 'Tyne and Wear', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3904, 230, 'Tyrone', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3905, 230, 'Utah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3906, 230, 'Wales', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3907, 230, 'Warwickshire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3908, 230, 'West Lothian', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3909, 230, 'West Midlands', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3910, 230, 'West Sussex', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3911, 230, 'West Yorkshire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3912, 230, 'Whissendine', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3913, 230, 'Wiltshire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3914, 230, 'Wokingham', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3915, 230, 'Worcestershire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3916, 230, 'Wrexham', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3917, 230, 'Wurttemberg', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3918, 230, 'Yorkshire', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3919, 231, 'Alabama', 0, '2021-04-06 07:26:20', '2021-11-02 08:39:38', NULL),
(3920, 231, 'Alaska', 0, '2021-04-06 07:26:20', '2021-11-02 08:39:38', NULL),
(3921, 231, 'Arizona', 0, '2021-04-06 07:26:20', '2021-11-02 08:39:39', NULL),
(3922, 231, 'Arkansas', 0, '2021-04-06 07:26:20', '2021-11-02 08:39:39', NULL),
(3923, 231, 'Byram', 0, '2021-04-06 07:26:20', '2021-11-02 08:39:39', NULL),
(3924, 231, 'California', 0, '2021-04-06 07:26:20', '2021-11-02 08:39:39', NULL),
(3925, 231, 'Cokato', 0, '2021-04-06 07:26:20', '2021-11-02 08:39:43', NULL),
(3926, 231, 'Colorado', 0, '2021-04-06 07:26:20', '2021-11-02 08:39:43', NULL),
(3927, 231, 'Connecticut', 0, '2021-04-06 07:26:20', '2021-11-02 08:39:44', NULL),
(3928, 231, 'Delaware', 0, '2021-04-06 07:26:20', '2021-11-02 08:39:44', NULL),
(3929, 231, 'District of Columbia', 0, '2021-04-06 07:26:20', '2021-11-02 08:39:45', NULL),
(3930, 231, 'Florida', 0, '2021-04-06 07:26:20', '2021-11-02 08:39:45', NULL),
(3931, 231, 'Georgia', 0, '2021-04-06 07:26:20', '2021-11-02 08:39:47', NULL),
(3932, 231, 'Hawaii', 0, '2021-04-06 07:26:20', '2021-11-02 08:39:48', NULL),
(3933, 231, 'Idaho', 0, '2021-04-06 07:26:20', '2021-11-02 08:39:49', NULL),
(3934, 231, 'Illinois', 0, '2021-04-06 07:26:20', '2021-11-02 08:39:49', NULL),
(3935, 231, 'Indiana', 0, '2021-04-06 07:26:20', '2021-11-02 08:39:52', NULL),
(3936, 231, 'Iowa', 0, '2021-04-06 07:26:20', '2021-11-02 08:39:53', NULL),
(3937, 231, 'Kansas', 0, '2021-04-06 07:26:20', '2021-11-02 08:39:53', NULL),
(3938, 231, 'Kentucky', 0, '2021-04-06 07:26:20', '2021-11-02 08:39:54', NULL),
(3939, 231, 'Louisiana', 0, '2021-04-06 07:26:20', '2021-11-02 08:39:54', NULL),
(3940, 231, 'Lowa', 0, '2021-04-06 07:26:20', '2021-11-02 08:39:55', NULL),
(3941, 231, 'Maine', 0, '2021-04-06 07:26:20', '2021-11-02 08:39:55', NULL),
(3942, 231, 'Maryland', 0, '2021-04-06 07:26:20', '2021-11-02 08:39:55', NULL),
(3943, 231, 'Massachusetts', 0, '2021-04-06 07:26:20', '2021-11-02 08:39:57', NULL),
(3944, 231, 'Medfield', 0, '2021-04-06 07:26:20', '2021-11-02 08:39:58', NULL),
(3945, 231, 'Michigan', 0, '2021-04-06 07:26:20', '2021-11-02 08:39:58', NULL),
(3946, 231, 'Minnesota', 0, '2021-04-06 07:26:20', '2021-11-02 08:40:00', NULL),
(3947, 231, 'Mississippi', 0, '2021-04-06 07:26:20', '2021-11-02 08:40:01', NULL),
(3948, 231, 'Missouri', 0, '2021-04-06 07:26:20', '2021-11-02 08:40:01', NULL),
(3949, 231, 'Montana', 0, '2021-04-06 07:26:20', '2021-11-02 08:40:03', NULL),
(3950, 231, 'Nebraska', 0, '2021-04-06 07:26:20', '2021-11-02 08:40:03', NULL),
(3951, 231, 'Nevada', 0, '2021-04-06 07:26:20', '2021-11-02 08:40:03', NULL),
(3952, 231, 'New Hampshire', 0, '2021-04-06 07:26:20', '2021-11-02 08:40:04', NULL),
(3953, 231, 'New Jersey', 0, '2021-04-06 07:26:20', '2021-11-02 08:40:04', NULL),
(3954, 231, 'New Jersy', 0, '2021-04-06 07:26:20', '2021-11-02 08:40:06', NULL),
(3955, 231, 'New Mexico', 0, '2021-04-06 07:26:20', '2021-11-02 08:40:06', NULL),
(3956, 231, 'New York', 0, '2021-04-06 07:26:20', '2021-11-02 08:40:07', NULL),
(3957, 231, 'North Carolina', 0, '2021-04-06 07:26:20', '2021-11-02 08:40:10', NULL),
(3958, 231, 'North Dakota', 0, '2021-04-06 07:26:20', '2021-11-02 08:40:10', NULL),
(3959, 231, 'Ohio', 0, '2021-04-06 07:26:20', '2021-11-02 08:40:11', NULL),
(3960, 231, 'Oklahoma', 0, '2021-04-06 07:26:20', '2021-11-02 08:40:13', NULL),
(3961, 231, 'Ontario', 0, '2021-04-06 07:26:20', '2021-11-02 08:40:13', NULL),
(3962, 231, 'Oregon', 0, '2021-04-06 07:26:20', '2021-11-02 08:40:13', NULL),
(3963, 231, 'Pennsylvania', 0, '2021-04-06 07:26:20', '2021-11-02 08:40:15', NULL),
(3964, 231, 'Ramey', 0, '2021-04-06 07:26:20', '2021-11-02 08:40:16', NULL),
(3965, 231, 'Rhode Island', 0, '2021-04-06 07:26:20', '2021-11-02 08:40:16', NULL),
(3966, 231, 'South Carolina', 0, '2021-04-06 07:26:20', '2021-11-02 08:40:17', NULL),
(3967, 231, 'South Dakota', 0, '2021-04-06 07:26:20', '2021-11-02 08:40:17', NULL),
(3968, 231, 'Sublimity', 0, '2021-04-06 07:26:20', '2021-11-02 08:40:17', NULL),
(3969, 231, 'Tennessee', 0, '2021-04-06 07:26:20', '2021-11-02 08:40:17', NULL),
(3970, 231, 'Texas', 0, '2021-04-06 07:26:20', '2021-11-02 08:40:18', NULL),
(3971, 231, 'Trimble', 0, '2021-04-06 07:26:20', '2021-11-02 08:40:20', NULL),
(3972, 231, 'Utah', 0, '2021-04-06 07:26:20', '2021-11-02 08:40:20', NULL),
(3973, 231, 'Vermont', 0, '2021-04-06 07:26:20', '2021-11-02 08:40:20', NULL),
(3974, 231, 'Virginia', 0, '2021-04-06 07:26:20', '2021-11-02 08:40:21', NULL),
(3975, 231, 'Washington', 0, '2021-04-06 07:26:20', '2021-11-02 08:40:22', NULL),
(3976, 231, 'West Virginia', 0, '2021-04-06 07:26:20', '2021-11-02 08:40:23', NULL),
(3977, 231, 'Wisconsin', 0, '2021-04-06 07:26:20', '2021-11-02 08:40:23', NULL),
(3978, 231, 'Wyoming', 0, '2021-04-06 07:26:20', '2021-11-02 08:40:24', NULL),
(3979, 232, 'United States Minor Outlying I', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3980, 233, 'Artigas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3981, 233, 'Canelones', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3982, 233, 'Cerro Largo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3983, 233, 'Colonia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3984, 233, 'Durazno', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3985, 233, 'FLorida', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3986, 233, 'Flores', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3987, 233, 'Lavalleja', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3988, 233, 'Maldonado', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3989, 233, 'Montevideo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3990, 233, 'Paysandu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3991, 233, 'Rio Negro', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3992, 233, 'Rivera', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3993, 233, 'Rocha', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3994, 233, 'Salto', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3995, 233, 'San Jose', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3996, 233, 'Soriano', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3997, 233, 'Tacuarembo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3998, 233, 'Treinta y Tres', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(3999, 234, 'Andijon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4000, 234, 'Buhoro', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4001, 234, 'Buxoro Viloyati', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4002, 234, 'Cizah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4003, 234, 'Fargona', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4004, 234, 'Horazm', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4005, 234, 'Kaskadar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4006, 234, 'Korakalpogiston', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4007, 234, 'Namangan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4008, 234, 'Navoi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4009, 234, 'Samarkand', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4010, 234, 'Sirdare', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4011, 234, 'Surhondar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4012, 234, 'Toskent', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4013, 235, 'Malampa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4014, 235, 'Penama', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4015, 235, 'Sanma', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4016, 235, 'Shefa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4017, 235, 'Tafea', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4018, 235, 'Torba', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4019, 236, 'Vatican City State (Holy See)', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4020, 237, 'Amazonas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4021, 237, 'Anzoategui', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4022, 237, 'Apure', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4023, 237, 'Aragua', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4024, 237, 'Barinas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4025, 237, 'Bolivar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4026, 237, 'Carabobo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4027, 237, 'Cojedes', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4028, 237, 'Delta Amacuro', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4029, 237, 'Distrito Federal', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4030, 237, 'Falcon', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4031, 237, 'Guarico', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4032, 237, 'Lara', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4033, 237, 'Merida', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4034, 237, 'Miranda', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4035, 237, 'Monagas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4036, 237, 'Nueva Esparta', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4037, 237, 'Portuguesa', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4038, 237, 'Sucre', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4039, 237, 'Tachira', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4040, 237, 'Trujillo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4041, 237, 'Vargas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4042, 237, 'Yaracuy', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4043, 237, 'Zulia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4044, 238, 'Bac Giang', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4045, 238, 'Binh Dinh', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4046, 238, 'Binh Duong', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4047, 238, 'Da Nang', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4048, 238, 'Dong Bang Song Cuu Long', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4049, 238, 'Dong Bang Song Hong', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4050, 238, 'Dong Nai', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4051, 238, 'Dong Nam Bo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4052, 238, 'Duyen Hai Mien Trung', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4053, 238, 'Hanoi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4054, 238, 'Hung Yen', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4055, 238, 'Khu Bon Cu', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4056, 238, 'Long An', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4057, 238, 'Mien Nui Va Trung Du', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4058, 238, 'Thai Nguyen', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4059, 238, 'Thanh Pho Ho Chi Minh', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4060, 238, 'Thu Do Ha Noi', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4061, 238, 'Tinh Can Tho', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4062, 238, 'Tinh Da Nang', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4063, 238, 'Tinh Gia Lai', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4064, 239, 'Anegada', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4065, 239, 'Jost van Dyke', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4066, 239, 'Tortola', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4067, 240, 'Saint Croix', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4068, 240, 'Saint John', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4069, 240, 'Saint Thomas', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4070, 241, 'Alo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4071, 241, 'Singave', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4072, 241, 'Wallis', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4073, 242, 'Bu Jaydur', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4074, 242, 'Wad-adh-Dhahab', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4075, 242, 'al-\'Ayun', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4076, 242, 'as-Samarah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4077, 243, '\'Adan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4078, 243, 'Abyan', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4079, 243, 'Dhamar', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4080, 243, 'Hadramaut', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4081, 243, 'Hajjah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4082, 243, 'Hudaydah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4083, 243, 'Ibb', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4084, 243, 'Lahij', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4085, 243, 'Ma\'rib', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4086, 243, 'Madinat San\'a', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4087, 243, 'Sa\'dah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4088, 243, 'Sana', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4089, 243, 'Shabwah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4090, 243, 'Ta\'izz', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4091, 243, 'al-Bayda', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4092, 243, 'al-Hudaydah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4093, 243, 'al-Jawf', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4094, 243, 'al-Mahrah', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4095, 243, 'al-Mahwit', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4096, 244, 'Central Serbia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4097, 244, 'Kosovo and Metohija', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4098, 244, 'Montenegro', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4099, 244, 'Republic of Serbia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4100, 244, 'Serbia', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4101, 244, 'Vojvodina', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4102, 245, 'Central', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4103, 245, 'Copperbelt', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4104, 245, 'Eastern', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4105, 245, 'Luapala', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4106, 245, 'Lusaka', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4107, 245, 'North-Western', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4108, 245, 'Northern', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4109, 245, 'Southern', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4110, 245, 'Western', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4111, 246, 'Bulawayo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4112, 246, 'Harare', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4113, 246, 'Manicaland', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4114, 246, 'Mashonaland Central', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4115, 246, 'Mashonaland East', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4116, 246, 'Mashonaland West', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4117, 246, 'Masvingo', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4118, 246, 'Matabeleland North', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4119, 246, 'Matabeleland South', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4120, 246, 'Midlands', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL),
(4121, 214, 'Lienchiang County', 0, '2021-04-06 07:26:20', '2021-04-06 07:26:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscribed_users`
--

CREATE TABLE `subscribed_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `entity` varchar(191) NOT NULL,
  `value` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `entity`, `value`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'google_login', '0', '2022-12-07 00:48:40', '2022-12-07 00:48:41', NULL),
(2, 'default_currency', 'usd', '2022-12-07 01:10:08', '2022-12-07 01:10:08', NULL),
(3, 'no_of_decimals', '2', '2022-12-07 01:10:08', '2022-12-07 01:10:08', NULL),
(4, 'truncate_price', '0', '2022-12-07 01:10:08', '2022-12-07 01:10:08', NULL),
(5, 'enable_multi_vendor', '0', '2022-12-25 00:15:08', '2023-02-18 03:11:54', NULL),
(6, 'default_admin_commission', '5', '2022-12-25 00:15:08', '2022-12-25 00:15:08', NULL),
(7, 'vendor_minimum_payout', '500', '2022-12-28 00:49:48', '2022-12-28 00:49:48', NULL),
(8, 'order_code_prefix', '#G-Store:', '2023-02-04 01:03:17', '2023-02-19 02:57:24', NULL),
(9, 'order_code_start', '1', '2023-02-04 01:03:17', '2023-02-04 01:06:38', NULL),
(10, 'system_title', 'Uliaa Online Store', '2023-02-05 01:03:44', '2025-05-01 02:48:56', NULL),
(11, 'title_separator', ':', '2023-02-05 01:03:44', '2023-02-05 01:03:44', NULL),
(12, 'site_address', 'Kathmandu, Nepal', '2023-02-05 01:04:15', '2025-05-01 02:48:56', NULL),
(13, 'registration_with', 'email', '2023-02-18 03:25:22', '2023-02-18 03:25:22', NULL),
(14, 'registration_verification_with', 'disable', '2023-02-18 03:25:22', '2023-02-18 03:25:22', NULL),
(15, 'topbar_welcome_text', 'Welcome to our eCommerce Store', '2023-02-20 00:56:46', '2025-05-01 02:47:04', NULL),
(16, 'topbar_email', 'info@uliaa.com.np', '2023-02-20 00:56:46', '2025-05-01 02:47:04', NULL),
(17, 'topbar_location', 'Kathmandu, Nepal', '2023-02-20 00:56:46', '2025-05-01 02:47:04', NULL),
(18, 'navbar_logo', '8', '2023-02-20 00:56:46', '2025-05-01 03:05:37', NULL),
(19, 'navbar_categories', NULL, '2023-02-20 00:56:46', '2023-03-11 23:19:45', NULL),
(20, 'navbar_pages', '[\"1\"]', '2023-02-20 00:56:47', '2023-03-01 03:47:34', NULL),
(21, 'navbar_contact_number', '+977-984143628', '2023-02-20 00:56:47', '2025-05-01 02:47:04', NULL),
(22, 'hero_sliders', '[{\"id\":106549,\"sub_title\":\"Genuine 100% Organic Products\",\"title\":\"Online Fresh Grocery Products\",\"text\":\"Assertively target market-driven intellectual capital with worldwide human capital holistic.\",\"image\":\"39\",\"link\":\"https:\\/\\/www.youtube.com\\/watch?v=mZ77D66ZYtw\"}]', '2023-02-20 05:51:00', '2023-03-01 02:48:57', NULL),
(24, 'top_category_ids', '[\"6\",\"5\",\"4\",\"3\",\"2\"]', '2023-02-25 03:44:10', '2023-02-25 03:44:10', NULL),
(25, 'featured_sub_title', 'Platform mindshare through effective infomediaries Dynamically implement.', '2023-02-25 04:33:46', '2023-02-25 04:33:46', NULL),
(26, 'featured_products_left', '[\"1\",\"2\",\"5\"]', '2023-02-25 04:33:46', '2023-02-25 22:53:23', NULL),
(27, 'featured_products_right', '[\"2\",\"3\",\"4\"]', '2023-02-25 04:33:46', '2023-02-25 07:08:03', NULL),
(28, 'featured_center_banner', '', '2023-02-25 04:33:46', '2023-02-25 05:16:42', NULL),
(29, 'featured_banner_link', 'http://enmart.work/products', '2023-02-25 04:38:47', '2023-02-25 04:38:47', NULL),
(30, 'trending_product_categories', '[\"5\",\"4\",\"3\"]', '2023-02-25 23:50:01', '2023-02-25 23:50:01', NULL),
(31, 'top_trending_products', '[\"1\",\"2\",\"3\",\"4\",\"5\"]', '2023-02-25 23:50:01', '2023-03-08 06:25:00', NULL),
(32, 'banner_section_one_banners', '[]', '2023-02-26 00:59:06', '2023-03-11 23:09:15', NULL),
(33, 'best_deal_end_date', '03/31/2023', '2023-02-26 03:53:19', '2023-02-26 03:59:19', NULL),
(34, 'weekly_best_deals', '[\"1\",\"2\",\"4\",\"5\"]', '2023-02-26 03:53:19', '2023-02-26 04:08:35', NULL),
(35, 'best_deal_banner', '', '2023-02-26 03:53:19', '2023-02-26 03:53:19', NULL),
(36, 'best_deal_banner_link', NULL, '2023-02-26 03:53:19', '2023-02-26 03:53:19', NULL),
(37, 'banner_section_two_banner_one_link', NULL, '2023-02-26 04:26:59', '2023-02-26 04:26:59', NULL),
(38, 'banner_section_two_banner_one', '49', '2023-02-26 04:26:59', '2023-02-26 04:26:59', NULL),
(39, 'banner_section_two_banner_two_link', NULL, '2023-02-26 04:26:59', '2023-02-26 04:26:59', NULL),
(40, 'banner_section_two_banner_two', '50', '2023-02-26 04:26:59', '2023-02-26 04:26:59', NULL),
(41, 'client_feedback', '[]', '2023-02-26 07:31:47', '2023-03-11 23:09:40', NULL),
(42, 'best_selling_products', '[\"1\",\"2\",\"3\"]', '2023-02-27 00:16:19', '2023-02-27 00:16:19', NULL),
(43, 'best_selling_banner', '', '2023-02-27 00:16:19', '2023-02-27 00:26:30', NULL),
(44, 'best_selling_banner_link', NULL, '2023-02-27 00:16:19', '2023-02-27 00:16:19', NULL),
(45, 'product_listing_categories', '[\"6\",\"5\",\"4\",\"3\",\"2\"]', '2023-02-27 01:02:35', '2023-02-27 01:02:35', NULL),
(46, 'footer_categories', NULL, '2023-02-28 22:48:33', '2023-03-11 23:14:31', NULL),
(47, 'quick_links', NULL, '2023-02-28 22:48:33', '2025-05-01 02:45:16', NULL),
(48, 'footer_logo', '8', '2023-02-28 22:48:33', '2025-05-01 03:05:58', NULL),
(49, 'accepted_payment_banner', '3', '2023-02-28 22:48:33', '2023-03-11 23:20:55', NULL),
(50, 'copyright_text', '© All Designed, Developed by <a href=\"http://infiniteitsolutionsnepal.com\" target=\"_blank\">Infinite IT Solutions Nepal</a>.', '2023-02-28 23:04:42', '2025-05-01 02:45:16', NULL),
(51, 'product_page_widgets', '[]', '2023-03-01 02:50:08', '2023-03-11 23:11:25', NULL),
(52, 'product_page_banner_link', NULL, '2023-03-01 03:35:50', '2023-03-01 03:35:50', NULL),
(53, 'product_page_banner', '59', '2023-03-01 03:35:50', '2023-03-01 03:35:50', NULL),
(54, 'facebook_link', 'https://www.facebook.com/', '2023-03-01 04:00:01', '2023-03-01 04:00:01', NULL),
(55, 'twitter_link', 'https://twitter.com/', '2023-03-01 04:00:01', '2023-03-01 04:00:01', NULL),
(56, 'linkedin_link', 'https://www.linkedin.com/', '2023-03-01 04:00:01', '2023-03-01 04:00:01', NULL),
(57, 'youtube_link', 'https://www.youtube.com/', '2023-03-01 04:00:01', '2023-03-01 04:00:01', NULL),
(58, 'about_us', 'Explain to you how all this mistaken denouncing pleasure and praising pain was born and we will give you a complete account of the system, and expound the actual teachings.\r\n          \r\n          Mistaken denouncing pleasure and praising pain was born and we will give you complete account of the system expound.', '2023-03-01 04:01:33', '2025-05-01 02:47:04', NULL),
(59, 'about_intro_sub_title', '100% Organic Food Provide', '2023-03-03 23:09:12', '2023-03-03 23:09:12', NULL),
(60, 'about_intro_title', 'Be healthy & <br> eat fresh organic food', '2023-03-03 23:09:12', '2023-03-11 00:04:49', NULL),
(61, 'about_intro_text', 'Assertively target market lorem ipsum is simply free text available dolor sit amet, consectetur notted adipisicing elit sed do eiusmod tempor incididunt simply freeutation labore et dolore.', '2023-03-03 23:09:12', '2023-03-03 23:09:12', NULL),
(62, 'about_intro_mission', 'Continually transform virtual meta- methodologies. leverage existing alignments.', '2023-03-03 23:09:12', '2023-03-03 23:09:12', NULL),
(63, 'about_intro_vision', 'Continually transform virtual meta- methodologies. leverage existing alignments.', '2023-03-03 23:09:12', '2023-03-03 23:09:12', NULL),
(64, 'about_intro_quote', 'Assertively target market Lorem ipsum is simply free consectetur notted elit sed do eiusmod', '2023-03-03 23:09:12', '2023-03-03 23:09:12', NULL),
(65, 'about_intro_quote_by', 'George Scholll', '2023-03-03 23:09:12', '2023-03-03 23:09:12', NULL),
(66, 'about_intro_image', '60', '2023-03-03 23:09:12', '2023-03-03 23:09:12', NULL),
(67, 'about_popular_brand_ids', '[\"1\",\"2\"]', '2023-03-03 23:31:59', '2023-03-03 23:31:59', NULL),
(68, 'about_features_title', 'Our Working Ability', '2023-03-04 00:04:27', '2023-03-04 00:04:27', NULL),
(69, 'about_features_sub_title', 'Assertively target market lorem ipsum is simply free text available dolor incididunt simply free ut labore et dolore.', '2023-03-04 00:04:27', '2023-03-04 00:04:27', NULL),
(70, 'about_us_features', '[]', '2023-03-04 00:14:50', '2023-03-11 23:12:12', NULL),
(71, 'about_why_choose_sub_title', 'Why Choose Us', '2023-03-04 01:14:45', '2023-03-04 01:14:45', NULL),
(72, 'about_why_choose_title', 'We do not Buy from the <br> Open Market', '2023-03-04 01:14:45', '2023-03-04 01:14:45', NULL),
(73, 'about_why_choose_text', 'Compellingly fashion intermandated opportunities and multimedia based fnsparent e-business.', '2023-03-04 01:14:45', '2023-03-04 01:14:45', NULL),
(74, 'about_why_choose_banner', '62', '2023-03-04 01:14:45', '2023-03-04 01:14:45', NULL),
(75, 'about_us_why_choose_us', '[]', '2023-03-04 01:20:13', '2023-03-11 23:12:43', NULL),
(76, 'admin_panel_logo', NULL, '2023-03-04 03:52:03', '2025-05-01 03:48:43', NULL),
(77, 'favicon', '7', '2023-03-04 03:52:03', '2025-05-01 02:48:56', NULL),
(78, 'software_version', '4.2.0', '2025-05-01 02:27:32', '2025-05-01 02:27:32', NULL),
(79, 'last_update', '2025-05-01 08:12:32', '2025-05-01 02:27:32', '2025-05-01 02:27:32', NULL),
(80, 'enable_cod', '1', '2025-05-01 02:27:32', '2025-05-01 02:27:32', NULL),
(81, 'invoice_thanksgiving', 'Thank you for shopping from our store and for your order. it is really awesome to have you as one of our paid users. We hope that you will be happy with Qlearly, if you ever have any questions, suggestions or concerns please do not hesitate to contact us.', '2023-03-07 01:19:15', '2023-03-07 01:24:20', NULL),
(82, 'show_navbar_categories', '0', '2025-05-01 02:47:04', '2025-05-01 02:47:04', NULL),
(83, 'show_theme_changes', '0', '2025-05-01 02:47:04', '2025-05-01 02:47:04', NULL),
(84, 'active_themes', '[\"1\"]', '2025-05-01 02:47:04', '2025-05-01 02:47:04', NULL),
(85, 'header_menu_labels', NULL, '2025-05-01 02:47:04', '2025-05-01 02:47:04', NULL),
(86, 'header_menu_links', NULL, '2025-05-01 02:47:04', '2025-05-01 02:47:04', NULL),
(87, 'show_navbar_pages', '0', '2025-05-01 02:47:04', '2025-05-01 02:47:04', NULL),
(88, 'enable_maintenance_mode', NULL, '2025-05-01 02:48:56', '2025-05-01 02:48:56', NULL),
(89, 'global_meta_title', NULL, '2025-05-01 02:48:56', '2025-05-01 02:48:56', NULL),
(90, 'global_meta_description', NULL, '2025-05-01 02:48:56', '2025-05-01 02:48:56', NULL),
(91, 'global_meta_keywords', NULL, '2025-05-01 02:48:56', '2025-05-01 02:48:56', NULL),
(92, 'global_meta_image', NULL, '2025-05-01 02:48:56', '2025-05-01 02:48:56', NULL),
(93, 'enable_preloader', NULL, '2025-05-01 02:48:56', '2025-05-01 02:48:56', NULL),
(94, 'admin_panel_preloader', NULL, '2025-05-01 02:48:56', '2025-05-01 02:48:56', NULL),
(95, 'frontend_preloader', NULL, '2025-05-01 02:48:56', '2025-05-01 02:48:56', NULL),
(96, 'pagination', '10', '2025-05-01 02:48:56', '2025-05-01 02:48:56', NULL),
(97, 'enable_delivery_tips', NULL, '2025-05-01 02:48:56', '2025-05-01 02:48:56', NULL),
(98, 'backend_header_custom_css', NULL, '2025-05-01 02:48:56', '2025-05-01 02:48:56', NULL),
(99, 'frontend_header_custom_css', NULL, '2025-05-01 02:48:56', '2025-05-01 02:48:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temporary_product_import_data`
--

CREATE TABLE `temporary_product_import_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` int(11) NOT NULL,
  `added_by` varchar(191) NOT NULL DEFAULT 'admin',
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `thumbnail_image` text DEFAULT NULL,
  `gallery_images` longtext DEFAULT NULL,
  `product_tags` longtext DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `price` double NOT NULL DEFAULT 0,
  `min_price` double NOT NULL DEFAULT 0,
  `max_price` double NOT NULL DEFAULT 0,
  `discount_value` double NOT NULL DEFAULT 0,
  `discount_type` varchar(191) DEFAULT NULL,
  `discount_start_date` int(11) DEFAULT NULL,
  `discount_end_date` int(11) DEFAULT NULL,
  `sell_target` int(11) DEFAULT NULL,
  `stock_qty` int(11) NOT NULL DEFAULT 0,
  `sku` text DEFAULT NULL,
  `code` text DEFAULT NULL,
  `is_published` tinyint(4) NOT NULL DEFAULT 0,
  `is_featured` tinyint(4) NOT NULL DEFAULT 0,
  `min_purchase_qty` int(11) NOT NULL DEFAULT 1,
  `max_purchase_qty` int(11) NOT NULL DEFAULT 1,
  `has_variation` tinyint(4) NOT NULL DEFAULT 1,
  `has_warranty` tinyint(4) NOT NULL DEFAULT 1,
  `total_sale_count` double NOT NULL DEFAULT 0,
  `standard_delivery_hours` int(11) NOT NULL DEFAULT 24,
  `express_delivery_hours` int(11) NOT NULL DEFAULT 24,
  `size_guide` text DEFAULT NULL,
  `meta_title` mediumtext DEFAULT NULL,
  `meta_description` longtext DEFAULT NULL,
  `meta_img` varchar(191) DEFAULT NULL,
  `reward_points` bigint(20) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `code` varchar(191) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_default` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`id`, `name`, `code`, `is_active`, `is_default`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Grocery', 'default', 1, 1, '2023-09-16 06:36:37', '2023-09-16 06:36:37', NULL),
(2, 'Halal Food', 'halal', 1, 0, '2023-09-16 06:36:37', '2023-09-16 06:36:37', NULL),
(3, 'Furniture', 'furniture', 0, 0, '2023-09-16 06:36:37', '2023-09-16 06:36:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `priority_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `assign_by` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_categories`
--

CREATE TABLE `ticket_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `user_id` int(11) DEFAULT NULL,
  `assign_staff` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_files`
--

CREATE TABLE `ticket_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `replied_id` int(11) DEFAULT NULL,
  `file_path` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unit_localizations`
--

CREATE TABLE `unit_localizations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `lang_key` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_type` varchar(191) NOT NULL DEFAULT 'customer',
  `name` varchar(191) NOT NULL,
  `email` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `email_or_otp_verified` tinyint(4) NOT NULL DEFAULT 0,
  `verification_code` varchar(191) DEFAULT NULL,
  `new_email_verification_code` varchar(191) DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `remember_token` varchar(191) DEFAULT NULL,
  `provider_id` varchar(191) DEFAULT NULL,
  `avatar` bigint(20) UNSIGNED DEFAULT NULL,
  `postal_code` varchar(191) DEFAULT NULL,
  `location_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'added for deliveryman',
  `address` longtext DEFAULT NULL COMMENT 'added for deliveryman',
  `user_balance` double NOT NULL DEFAULT 0,
  `is_banned` tinyint(4) NOT NULL DEFAULT 0,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT 'added for deliveryman',
  `shop_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `salary` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `user_type`, `name`, `email`, `phone`, `email_or_otp_verified`, `verification_code`, `new_email_verification_code`, `password`, `remember_token`, `provider_id`, `avatar`, `postal_code`, `location_id`, `address`, `user_balance`, `is_banned`, `is_active`, `shop_id`, `email_verified_at`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `salary`) VALUES
(1, NULL, 'admin', 'uliaa_admin', 'nabinmehetar@gmail.com', '', 0, NULL, NULL, '$2y$10$nZ0tGfkRaUrQIlbnRMWjMuvlSltNdJT4qWmzBGe7GPRz83yvou1si', NULL, NULL, 7, NULL, NULL, NULL, 0, 0, 1, 1, '2025-05-01 02:20:18', NULL, '2025-05-01 02:42:47', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `state_id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `address` longtext NOT NULL,
  `is_default` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'only one can be default',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `variations`
--

CREATE TABLE `variations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `variations`
--

INSERT INTO `variations` (`id`, `name`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Size', 1, '2022-12-05 07:21:30', '2022-12-05 07:21:30', NULL),
(2, 'Color', 1, '2022-12-05 07:21:30', '2022-12-05 07:21:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `variation_localizations`
--

CREATE TABLE `variation_localizations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `variation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `lang_key` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `variation_values`
--

CREATE TABLE `variation_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `variation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `image` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'only for colors',
  `color_code` varchar(191) DEFAULT NULL COMMENT 'only for colors',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `variation_value_localizations`
--

CREATE TABLE `variation_value_localizations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `variation_value_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `image` bigint(20) UNSIGNED DEFAULT NULL,
  `lang_key` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wallet_histories`
--

CREATE TABLE `wallet_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` double NOT NULL DEFAULT 0,
  `payment_method` varchar(191) DEFAULT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'added' COMMENT 'added/pending/cancelled',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assign_tickets`
--
ALTER TABLE `assign_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blogs_blog_category_id_foreign` (`blog_category_id`),
  ADD KEY `blogs_thumbnail_image_foreign` (`thumbnail_image`),
  ADD KEY `blogs_banner_foreign` (`banner`),
  ADD KEY `blogs_meta_img_foreign` (`meta_img`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_localizations`
--
ALTER TABLE `blog_localizations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_localizations_blog_id_foreign` (`blog_id`);

--
-- Indexes for table `blog_tags`
--
ALTER TABLE `blog_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_tags_blog_id_foreign` (`blog_id`),
  ADD KEY `blog_tags_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `blog_themes`
--
ALTER TABLE `blog_themes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_themes_blog_id_foreign` (`blog_id`),
  ADD KEY `blog_themes_theme_id_foreign` (`theme_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brands_brand_image_foreign` (`brand_image`),
  ADD KEY `brands_meta_image_foreign` (`meta_image`);

--
-- Indexes for table `brand_localizations`
--
ALTER TABLE `brand_localizations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_localizations_brand_id_foreign` (`brand_id`),
  ADD KEY `brand_localizations_meta_image_foreign` (`meta_image`);

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campaigns_banner_foreign` (`banner`);

--
-- Indexes for table `campaign_products`
--
ALTER TABLE `campaign_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campaign_products_campaign_id_foreign` (`campaign_id`),
  ADD KEY `campaign_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `campaign_themes`
--
ALTER TABLE `campaign_themes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campaign_themes_campaign_id_foreign` (`campaign_id`),
  ADD KEY `campaign_themes_theme_id_foreign` (`theme_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_product_id_foreign` (`product_id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_location_id_foreign` (`location_id`),
  ADD KEY `carts_product_variation_id_foreign` (`product_variation_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`),
  ADD KEY `categories_thumbnail_image_foreign` (`thumbnail_image`),
  ADD KEY `categories_icon_foreign` (`icon`),
  ADD KEY `categories_meta_image_foreign` (`meta_image`);

--
-- Indexes for table `category_brands`
--
ALTER TABLE `category_brands`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_brands_brand_id_foreign` (`brand_id`),
  ADD KEY `category_brands_category_id_foreign` (`category_id`);

--
-- Indexes for table `category_localizations`
--
ALTER TABLE `category_localizations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_localizations_thumbnail_image_foreign` (`thumbnail_image`),
  ADD KEY `category_localizations_meta_image_foreign` (`meta_image`),
  ADD KEY `category_localizations_category_id_foreign` (`category_id`);

--
-- Indexes for table `category_themes`
--
ALTER TABLE `category_themes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_themes_category_id_foreign` (`category_id`),
  ADD KEY `category_themes_theme_id_foreign` (`theme_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_state_id_foreign` (`state_id`);

--
-- Indexes for table `contact_us_messages`
--
ALTER TABLE `contact_us_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupons_shop_id_foreign` (`shop_id`),
  ADD KEY `coupons_banner_foreign` (`banner`);

--
-- Indexes for table `coupon_themes`
--
ALTER TABLE `coupon_themes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupon_themes_coupon_id_foreign` (`coupon_id`),
  ADD KEY `coupon_themes_theme_id_foreign` (`theme_id`);

--
-- Indexes for table `coupon_usages`
--
ALTER TABLE `coupon_usages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupon_usages_user_id_foreign` (`user_id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enmart_modules`
--
ALTER TABLE `enmart_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `grass_period_payments`
--
ALTER TABLE `grass_period_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `licenses`
--
ALTER TABLE `licenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `localizations`
--
ALTER TABLE `localizations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `locations_banner_foreign` (`banner`);

--
-- Indexes for table `logistics`
--
ALTER TABLE `logistics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `logistics_thumbnail_image_foreign` (`thumbnail_image`);

--
-- Indexes for table `logistic_zones`
--
ALTER TABLE `logistic_zones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `logistic_zones_logistic_id_foreign` (`logistic_id`);

--
-- Indexes for table `logistic_zone_cities`
--
ALTER TABLE `logistic_zone_cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `logistic_zone_cities_logistic_id_foreign` (`logistic_id`),
  ADD KEY `logistic_zone_cities_logistic_zone_id_foreign` (`logistic_zone_id`),
  ADD KEY `logistic_zone_cities_city_id_foreign` (`city_id`);

--
-- Indexes for table `media_managers`
--
ALTER TABLE `media_managers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_managers_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_order_group_id_foreign` (`order_group_id`),
  ADD KEY `orders_shop_id_foreign` (`shop_id`),
  ADD KEY `orders_logistic_id_foreign` (`logistic_id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_location_id_foreign` (`location_id`),
  ADD KEY `orders_deliveryman_id_foreign` (`deliveryman_id`);

--
-- Indexes for table `order_groups`
--
ALTER TABLE `order_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_groups_user_id_foreign` (`user_id`),
  ADD KEY `order_groups_location_id_foreign` (`location_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_variation_id_foreign` (`product_variation_id`),
  ADD KEY `order_items_location_id_foreign` (`location_id`);

--
-- Indexes for table `order_updates`
--
ALTER TABLE `order_updates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_updates_order_id_foreign` (`order_id`),
  ADD KEY `order_updates_user_id_foreign` (`user_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pages_meta_image_foreign` (`meta_image`);

--
-- Indexes for table `page_localizations`
--
ALTER TABLE `page_localizations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `page_localizations_page_id_foreign` (`page_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_gateway_details`
--
ALTER TABLE `payment_gateway_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payouts`
--
ALTER TABLE `payouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payouts_user_id_foreign` (`user_id`);

--
-- Indexes for table `payrolls`
--
ALTER TABLE `payrolls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payrolls_user_id_foreign` (`user_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `priorities`
--
ALTER TABLE `priorities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_shop_id_foreign` (`shop_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `products_unit_id_foreign` (`unit_id`),
  ADD KEY `products_thumbnail_image_foreign` (`thumbnail_image`),
  ADD KEY `products_meta_img_foreign` (`meta_img`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_categories_product_id_foreign` (`product_id`),
  ADD KEY `product_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_colors`
--
ALTER TABLE `product_colors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_colors_product_id_foreign` (`product_id`),
  ADD KEY `product_colors_variation_value_id_foreign` (`variation_value_id`),
  ADD KEY `product_colors_image_foreign` (`image`);

--
-- Indexes for table `product_localizations`
--
ALTER TABLE `product_localizations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_localizations_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_tags`
--
ALTER TABLE `product_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_tags_product_id_foreign` (`product_id`),
  ADD KEY `product_tags_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `product_taxes`
--
ALTER TABLE `product_taxes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_taxes_product_id_foreign` (`product_id`),
  ADD KEY `product_taxes_tax_id_foreign` (`tax_id`);

--
-- Indexes for table `product_themes`
--
ALTER TABLE `product_themes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_themes_product_id_foreign` (`product_id`),
  ADD KEY `product_themes_theme_id_foreign` (`theme_id`);

--
-- Indexes for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variations_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_variation_combinations`
--
ALTER TABLE `product_variation_combinations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variation_combinations_product_id_foreign` (`product_id`),
  ADD KEY `product_variation_combinations_product_variation_id_foreign` (`product_variation_id`),
  ADD KEY `product_variation_combinations_variation_id_foreign` (`variation_id`),
  ADD KEY `product_variation_combinations_variation_value_id_foreign` (`variation_value_id`);

--
-- Indexes for table `product_variation_stocks`
--
ALTER TABLE `product_variation_stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variation_stocks_product_variation_id_foreign` (`product_variation_id`),
  ADD KEY `product_variation_stocks_location_id_foreign` (`location_id`);

--
-- Indexes for table `refunds`
--
ALTER TABLE `refunds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refunds_user_id_foreign` (`user_id`),
  ADD KEY `refunds_order_group_id_foreign` (`order_group_id`),
  ADD KEY `refunds_order_item_id_foreign` (`order_item_id`),
  ADD KEY `refunds_product_id_foreign` (`product_id`);

--
-- Indexes for table `reply_tickets`
--
ALTER TABLE `reply_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reward_points`
--
ALTER TABLE `reward_points`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reward_points_user_id_foreign` (`user_id`),
  ADD KEY `reward_points_order_group_id_foreign` (`order_group_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `scheduled_delivery_time_lists`
--
ALTER TABLE `scheduled_delivery_time_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shops_user_id_foreign` (`user_id`),
  ADD KEY `shops_shop_logo_foreign` (`shop_logo`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`),
  ADD KEY `states_country_id_foreign` (`country_id`);

--
-- Indexes for table `subscribed_users`
--
ALTER TABLE `subscribed_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temporary_product_import_data`
--
ALTER TABLE `temporary_product_import_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_categories`
--
ALTER TABLE `ticket_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_files`
--
ALTER TABLE `ticket_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_localizations`
--
ALTER TABLE `unit_localizations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unit_localizations_unit_id_foreign` (`unit_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_shop_id_foreign` (`shop_id`),
  ADD KEY `users_role_id_foreign` (`role_id`),
  ADD KEY `users_avatar_foreign` (`avatar`),
  ADD KEY `users_location_id_foreign` (`location_id`);

--
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_addresses_user_id_foreign` (`user_id`),
  ADD KEY `user_addresses_country_id_foreign` (`country_id`),
  ADD KEY `user_addresses_state_id_foreign` (`state_id`),
  ADD KEY `user_addresses_city_id_foreign` (`city_id`);

--
-- Indexes for table `variations`
--
ALTER TABLE `variations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `variation_localizations`
--
ALTER TABLE `variation_localizations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `variation_localizations_variation_id_foreign` (`variation_id`);

--
-- Indexes for table `variation_values`
--
ALTER TABLE `variation_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `variation_values_variation_id_foreign` (`variation_id`),
  ADD KEY `variation_values_image_foreign` (`image`);

--
-- Indexes for table `variation_value_localizations`
--
ALTER TABLE `variation_value_localizations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `variation_value_localizations_variation_value_id_foreign` (`variation_value_id`),
  ADD KEY `variation_value_localizations_image_foreign` (`image`);

--
-- Indexes for table `wallet_histories`
--
ALTER TABLE `wallet_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wallet_histories_user_id_foreign` (`user_id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assign_tickets`
--
ALTER TABLE `assign_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_localizations`
--
ALTER TABLE `blog_localizations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_tags`
--
ALTER TABLE `blog_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_themes`
--
ALTER TABLE `blog_themes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brand_localizations`
--
ALTER TABLE `brand_localizations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `campaign_products`
--
ALTER TABLE `campaign_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `campaign_themes`
--
ALTER TABLE `campaign_themes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category_brands`
--
ALTER TABLE `category_brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category_localizations`
--
ALTER TABLE `category_localizations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category_themes`
--
ALTER TABLE `category_themes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=501;

--
-- AUTO_INCREMENT for table `contact_us_messages`
--
ALTER TABLE `contact_us_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupon_themes`
--
ALTER TABLE `coupon_themes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupon_usages`
--
ALTER TABLE `coupon_usages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `enmart_modules`
--
ALTER TABLE `enmart_modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grass_period_payments`
--
ALTER TABLE `grass_period_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `licenses`
--
ALTER TABLE `licenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `localizations`
--
ALTER TABLE `localizations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=758;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `logistics`
--
ALTER TABLE `logistics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logistic_zones`
--
ALTER TABLE `logistic_zones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logistic_zone_cities`
--
ALTER TABLE `logistic_zone_cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media_managers`
--
ALTER TABLE `media_managers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_groups`
--
ALTER TABLE `order_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_updates`
--
ALTER TABLE `order_updates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `page_localizations`
--
ALTER TABLE `page_localizations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `payment_gateway_details`
--
ALTER TABLE `payment_gateway_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `payouts`
--
ALTER TABLE `payouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payrolls`
--
ALTER TABLE `payrolls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `priorities`
--
ALTER TABLE `priorities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_colors`
--
ALTER TABLE `product_colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_localizations`
--
ALTER TABLE `product_localizations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_tags`
--
ALTER TABLE `product_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_taxes`
--
ALTER TABLE `product_taxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_themes`
--
ALTER TABLE `product_themes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_variations`
--
ALTER TABLE `product_variations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_variation_combinations`
--
ALTER TABLE `product_variation_combinations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_variation_stocks`
--
ALTER TABLE `product_variation_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `refunds`
--
ALTER TABLE `refunds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reply_tickets`
--
ALTER TABLE `reply_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reward_points`
--
ALTER TABLE `reward_points`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `scheduled_delivery_time_lists`
--
ALTER TABLE `scheduled_delivery_time_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4122;

--
-- AUTO_INCREMENT for table `subscribed_users`
--
ALTER TABLE `subscribed_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temporary_product_import_data`
--
ALTER TABLE `temporary_product_import_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket_categories`
--
ALTER TABLE `ticket_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket_files`
--
ALTER TABLE `ticket_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `unit_localizations`
--
ALTER TABLE `unit_localizations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `variations`
--
ALTER TABLE `variations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `variation_localizations`
--
ALTER TABLE `variation_localizations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `variation_values`
--
ALTER TABLE `variation_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `variation_value_localizations`
--
ALTER TABLE `variation_value_localizations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wallet_histories`
--
ALTER TABLE `wallet_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_banner_foreign` FOREIGN KEY (`banner`) REFERENCES `media_managers` (`id`),
  ADD CONSTRAINT `blogs_blog_category_id_foreign` FOREIGN KEY (`blog_category_id`) REFERENCES `blog_categories` (`id`),
  ADD CONSTRAINT `blogs_meta_img_foreign` FOREIGN KEY (`meta_img`) REFERENCES `media_managers` (`id`),
  ADD CONSTRAINT `blogs_thumbnail_image_foreign` FOREIGN KEY (`thumbnail_image`) REFERENCES `media_managers` (`id`);

--
-- Constraints for table `blog_localizations`
--
ALTER TABLE `blog_localizations`
  ADD CONSTRAINT `blog_localizations_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`);

--
-- Constraints for table `blog_tags`
--
ALTER TABLE `blog_tags`
  ADD CONSTRAINT `blog_tags_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`),
  ADD CONSTRAINT `blog_tags_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`);

--
-- Constraints for table `blog_themes`
--
ALTER TABLE `blog_themes`
  ADD CONSTRAINT `blog_themes_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`),
  ADD CONSTRAINT `blog_themes_theme_id_foreign` FOREIGN KEY (`theme_id`) REFERENCES `themes` (`id`);

--
-- Constraints for table `brands`
--
ALTER TABLE `brands`
  ADD CONSTRAINT `brands_brand_image_foreign` FOREIGN KEY (`brand_image`) REFERENCES `media_managers` (`id`),
  ADD CONSTRAINT `brands_meta_image_foreign` FOREIGN KEY (`meta_image`) REFERENCES `media_managers` (`id`);

--
-- Constraints for table `brand_localizations`
--
ALTER TABLE `brand_localizations`
  ADD CONSTRAINT `brand_localizations_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `brand_localizations_meta_image_foreign` FOREIGN KEY (`meta_image`) REFERENCES `media_managers` (`id`);

--
-- Constraints for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD CONSTRAINT `campaigns_banner_foreign` FOREIGN KEY (`banner`) REFERENCES `media_managers` (`id`);

--
-- Constraints for table `campaign_products`
--
ALTER TABLE `campaign_products`
  ADD CONSTRAINT `campaign_products_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`),
  ADD CONSTRAINT `campaign_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `campaign_themes`
--
ALTER TABLE `campaign_themes`
  ADD CONSTRAINT `campaign_themes_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`),
  ADD CONSTRAINT `campaign_themes_theme_id_foreign` FOREIGN KEY (`theme_id`) REFERENCES `themes` (`id`);

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`),
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `carts_product_variation_id_foreign` FOREIGN KEY (`product_variation_id`) REFERENCES `product_variations` (`id`),
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_icon_foreign` FOREIGN KEY (`icon`) REFERENCES `media_managers` (`id`),
  ADD CONSTRAINT `categories_meta_image_foreign` FOREIGN KEY (`meta_image`) REFERENCES `media_managers` (`id`),
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `categories_thumbnail_image_foreign` FOREIGN KEY (`thumbnail_image`) REFERENCES `media_managers` (`id`);

--
-- Constraints for table `category_brands`
--
ALTER TABLE `category_brands`
  ADD CONSTRAINT `category_brands_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `media_managers` (`id`),
  ADD CONSTRAINT `category_brands_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `category_localizations`
--
ALTER TABLE `category_localizations`
  ADD CONSTRAINT `category_localizations_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `category_localizations_meta_image_foreign` FOREIGN KEY (`meta_image`) REFERENCES `media_managers` (`id`),
  ADD CONSTRAINT `category_localizations_thumbnail_image_foreign` FOREIGN KEY (`thumbnail_image`) REFERENCES `media_managers` (`id`);

--
-- Constraints for table `category_themes`
--
ALTER TABLE `category_themes`
  ADD CONSTRAINT `category_themes_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `category_themes_theme_id_foreign` FOREIGN KEY (`theme_id`) REFERENCES `themes` (`id`);

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`);

--
-- Constraints for table `coupons`
--
ALTER TABLE `coupons`
  ADD CONSTRAINT `coupons_banner_foreign` FOREIGN KEY (`banner`) REFERENCES `media_managers` (`id`),
  ADD CONSTRAINT `coupons_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`);

--
-- Constraints for table `coupon_themes`
--
ALTER TABLE `coupon_themes`
  ADD CONSTRAINT `coupon_themes_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`),
  ADD CONSTRAINT `coupon_themes_theme_id_foreign` FOREIGN KEY (`theme_id`) REFERENCES `themes` (`id`);

--
-- Constraints for table `coupon_usages`
--
ALTER TABLE `coupon_usages`
  ADD CONSTRAINT `coupon_usages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `locations_banner_foreign` FOREIGN KEY (`banner`) REFERENCES `media_managers` (`id`);

--
-- Constraints for table `logistics`
--
ALTER TABLE `logistics`
  ADD CONSTRAINT `logistics_thumbnail_image_foreign` FOREIGN KEY (`thumbnail_image`) REFERENCES `media_managers` (`id`);

--
-- Constraints for table `logistic_zones`
--
ALTER TABLE `logistic_zones`
  ADD CONSTRAINT `logistic_zones_logistic_id_foreign` FOREIGN KEY (`logistic_id`) REFERENCES `logistics` (`id`);

--
-- Constraints for table `logistic_zone_cities`
--
ALTER TABLE `logistic_zone_cities`
  ADD CONSTRAINT `logistic_zone_cities_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`),
  ADD CONSTRAINT `logistic_zone_cities_logistic_id_foreign` FOREIGN KEY (`logistic_id`) REFERENCES `logistics` (`id`),
  ADD CONSTRAINT `logistic_zone_cities_logistic_zone_id_foreign` FOREIGN KEY (`logistic_zone_id`) REFERENCES `logistic_zones` (`id`);

--
-- Constraints for table `media_managers`
--
ALTER TABLE `media_managers`
  ADD CONSTRAINT `media_managers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_deliveryman_id_foreign` FOREIGN KEY (`deliveryman_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`),
  ADD CONSTRAINT `orders_logistic_id_foreign` FOREIGN KEY (`logistic_id`) REFERENCES `logistics` (`id`),
  ADD CONSTRAINT `orders_order_group_id_foreign` FOREIGN KEY (`order_group_id`) REFERENCES `order_groups` (`id`),
  ADD CONSTRAINT `orders_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`),
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_groups`
--
ALTER TABLE `order_groups`
  ADD CONSTRAINT `order_groups_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`),
  ADD CONSTRAINT `order_groups_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`),
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_product_variation_id_foreign` FOREIGN KEY (`product_variation_id`) REFERENCES `product_variations` (`id`);

--
-- Constraints for table `order_updates`
--
ALTER TABLE `order_updates`
  ADD CONSTRAINT `order_updates_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_updates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_meta_image_foreign` FOREIGN KEY (`meta_image`) REFERENCES `media_managers` (`id`);

--
-- Constraints for table `page_localizations`
--
ALTER TABLE `page_localizations`
  ADD CONSTRAINT `page_localizations_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`);

--
-- Constraints for table `payouts`
--
ALTER TABLE `payouts`
  ADD CONSTRAINT `payouts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `payrolls`
--
ALTER TABLE `payrolls`
  ADD CONSTRAINT `payrolls_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `products_meta_img_foreign` FOREIGN KEY (`meta_img`) REFERENCES `media_managers` (`id`),
  ADD CONSTRAINT `products_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`),
  ADD CONSTRAINT `products_thumbnail_image_foreign` FOREIGN KEY (`thumbnail_image`) REFERENCES `media_managers` (`id`),
  ADD CONSTRAINT `products_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`);

--
-- Constraints for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD CONSTRAINT `product_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `product_categories_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_colors`
--
ALTER TABLE `product_colors`
  ADD CONSTRAINT `product_colors_image_foreign` FOREIGN KEY (`image`) REFERENCES `media_managers` (`id`),
  ADD CONSTRAINT `product_colors_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_colors_variation_value_id_foreign` FOREIGN KEY (`variation_value_id`) REFERENCES `variation_values` (`id`);

--
-- Constraints for table `product_localizations`
--
ALTER TABLE `product_localizations`
  ADD CONSTRAINT `product_localizations_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_tags`
--
ALTER TABLE `product_tags`
  ADD CONSTRAINT `product_tags_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_tags_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`);

--
-- Constraints for table `product_taxes`
--
ALTER TABLE `product_taxes`
  ADD CONSTRAINT `product_taxes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_taxes_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `taxes` (`id`);

--
-- Constraints for table `product_themes`
--
ALTER TABLE `product_themes`
  ADD CONSTRAINT `product_themes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_themes_theme_id_foreign` FOREIGN KEY (`theme_id`) REFERENCES `themes` (`id`);

--
-- Constraints for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD CONSTRAINT `product_variations_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_variation_combinations`
--
ALTER TABLE `product_variation_combinations`
  ADD CONSTRAINT `product_variation_combinations_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_variation_combinations_product_variation_id_foreign` FOREIGN KEY (`product_variation_id`) REFERENCES `product_variations` (`id`),
  ADD CONSTRAINT `product_variation_combinations_variation_id_foreign` FOREIGN KEY (`variation_id`) REFERENCES `variations` (`id`),
  ADD CONSTRAINT `product_variation_combinations_variation_value_id_foreign` FOREIGN KEY (`variation_value_id`) REFERENCES `variation_values` (`id`);

--
-- Constraints for table `product_variation_stocks`
--
ALTER TABLE `product_variation_stocks`
  ADD CONSTRAINT `product_variation_stocks_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`),
  ADD CONSTRAINT `product_variation_stocks_product_variation_id_foreign` FOREIGN KEY (`product_variation_id`) REFERENCES `product_variations` (`id`);

--
-- Constraints for table `refunds`
--
ALTER TABLE `refunds`
  ADD CONSTRAINT `refunds_order_group_id_foreign` FOREIGN KEY (`order_group_id`) REFERENCES `order_groups` (`id`),
  ADD CONSTRAINT `refunds_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`id`),
  ADD CONSTRAINT `refunds_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `refunds_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `reward_points`
--
ALTER TABLE `reward_points`
  ADD CONSTRAINT `reward_points_order_group_id_foreign` FOREIGN KEY (`order_group_id`) REFERENCES `order_groups` (`id`),
  ADD CONSTRAINT `reward_points_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shops`
--
ALTER TABLE `shops`
  ADD CONSTRAINT `shops_shop_logo_foreign` FOREIGN KEY (`shop_logo`) REFERENCES `media_managers` (`id`),
  ADD CONSTRAINT `shops_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `states`
--
ALTER TABLE `states`
  ADD CONSTRAINT `states_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`);

--
-- Constraints for table `unit_localizations`
--
ALTER TABLE `unit_localizations`
  ADD CONSTRAINT `unit_localizations_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_avatar_foreign` FOREIGN KEY (`avatar`) REFERENCES `media_managers` (`id`),
  ADD CONSTRAINT `users_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`),
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `users_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`);

--
-- Constraints for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD CONSTRAINT `user_addresses_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`),
  ADD CONSTRAINT `user_addresses_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`),
  ADD CONSTRAINT `user_addresses_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`),
  ADD CONSTRAINT `user_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `variation_localizations`
--
ALTER TABLE `variation_localizations`
  ADD CONSTRAINT `variation_localizations_variation_id_foreign` FOREIGN KEY (`variation_id`) REFERENCES `variations` (`id`);

--
-- Constraints for table `variation_values`
--
ALTER TABLE `variation_values`
  ADD CONSTRAINT `variation_values_image_foreign` FOREIGN KEY (`image`) REFERENCES `media_managers` (`id`),
  ADD CONSTRAINT `variation_values_variation_id_foreign` FOREIGN KEY (`variation_id`) REFERENCES `variations` (`id`);

--
-- Constraints for table `variation_value_localizations`
--
ALTER TABLE `variation_value_localizations`
  ADD CONSTRAINT `variation_value_localizations_image_foreign` FOREIGN KEY (`image`) REFERENCES `media_managers` (`id`),
  ADD CONSTRAINT `variation_value_localizations_variation_value_id_foreign` FOREIGN KEY (`variation_value_id`) REFERENCES `variation_values` (`id`);

--
-- Constraints for table `wallet_histories`
--
ALTER TABLE `wallet_histories`
  ADD CONSTRAINT `wallet_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
