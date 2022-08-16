-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2022 at 05:45 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arttales`
--

-- --------------------------------------------------------

--
-- Table structure for table `connections`
--

CREATE TABLE `connections` (
  `connection_id` int(10) UNSIGNED NOT NULL,
  `register_id` int(10) UNSIGNED DEFAULT NULL,
  `requested_id` int(11) NOT NULL,
  `vConnection` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_block` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `connections`
--

INSERT INTO `connections` (`connection_id`, `register_id`, `requested_id`, `vConnection`, `is_block`, `comment`, `tag`, `post_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, NULL, 'Nice pic', NULL, 1, NULL, NULL, NULL),
(2, 1, 2, NULL, NULL, 'good pic', NULL, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_uses`
--

CREATE TABLE `contact_uses` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_uses`
--

INSERT INTO `contact_uses` (`id`, `name`, `email`, `message`, `created_at`, `updated_at`) VALUES
(1, 'User', 'user@gmail.com', 'Howw to Like this', '2021-04-29 04:04:02', '2021-04-29 04:04:02');

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
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(10) UNSIGNED NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_deleted` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(4, '2021_04_15_115306_create_registers_table', 1),
(5, '2021_04_20_071321_create_tokens_table', 1),
(6, '2021_04_21_055429_create_preferences_table', 1),
(7, '2021_04_27_063329_create_faqs_table', 1),
(8, '2021_04_28_071740_create_poets_table', 1),
(9, '2021_04_28_095707_create_short_stories_table', 1),
(10, '2021_04_28_115800_create_preference_subcategories_table', 1),
(11, '2021_04_29_090632_create_contact_uses_table', 2),
(12, '2021_05_11_051757_create_notifications_table', 3),
(13, '2021_05_12_044935_create_preference_subcategories_table', 4),
(14, '2021_05_12_072645_create_posts_table', 5),
(15, '2021_05_12_072807_create_products_table', 5),
(16, '2021_05_12_080409_create_products_table', 6),
(17, '2021_05_20_045207_create_stores_table', 7),
(18, '2021_05_24_092004_create_connections_table', 8),
(19, '2021_05_24_111854_create_connections_table', 9),
(20, '2021_05_31_123859_create_send_notifications_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(10) UNSIGNED NOT NULL,
  `notification` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notification_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `register_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `notification`, `notification_image`, `register_id`, `created_at`, `updated_at`) VALUES
(1, 'Hello', 'person.png', 1, NULL, NULL),
(2, 'New Notification', 'person1.png', 2, NULL, NULL);

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
-- Table structure for table `poets`
--

CREATE TABLE `poets` (
  `id` int(10) UNSIGNED NOT NULL,
  `poet_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(10) UNSIGNED NOT NULL,
  `post_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descriptions` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `register_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_image`, `descriptions`, `tags`, `type`, `product_id`, `register_id`, `created_at`, `updated_at`) VALUES
(1, 'image39116.png', 'weqe', '#dasd', 'normal', 'null', 2, '2021-05-13 02:22:40', '2021-05-13 02:22:40'),
(2, 'image91426.png', 'weqe', '#dasd', 'normal', 'null', 2, '2021-05-13 02:26:25', '2021-05-13 02:26:25'),
(3, 'image55462.png', 'weqe', '#dasd', 'product', 'null', 2, '2021-05-13 05:28:19', '2021-05-13 05:28:19'),
(4, 'image14549.png', 'weqe', '#dasd', 'normal', 'null', 1, '2021-05-13 05:29:47', '2021-05-13 05:29:47'),
(5, 'image12375.png', 'weqe', '#dasd', 'product', 'null', 2, '2021-05-13 06:15:15', '2021-05-13 06:15:15'),
(6, 'image26251.png', 'weqe', '#dasd', 'product', 'null', 2, '2021-05-13 06:15:37', '2021-05-13 06:15:37'),
(7, 'image17795.png', 'weqe', '#dasd', 'product', 'null', 2, '2021-05-13 22:58:48', '2021-05-13 22:58:48'),
(8, 'image99420.png', 'weqe', '#dasd', 'product', 'null', 2, '2021-05-13 22:59:39', '2021-05-13 22:59:39'),
(9, 'image24287.png', 'weqe', '#dasd', 'product', 'null', 2, '2021-05-13 23:03:04', '2021-05-13 23:03:04'),
(10, 'image48391.png', 'weqe', '#dasd', 'product', 'null', 2, '2021-05-13 23:03:44', '2021-05-13 23:03:44'),
(11, 'image57415.png', 'weqe', '#dasd', 'product', 'null', 2, '2021-05-13 23:13:21', '2021-05-13 23:13:21'),
(12, 'image47408.png', 'weqe', '#dasd', 'product', 'null', 2, '2021-05-13 23:19:15', '2021-05-13 23:19:15'),
(13, 'image56743.png', 'weqe', '#dasd', 'product', 'null', 2, '2021-05-13 23:32:04', '2021-05-13 23:32:04'),
(14, 'image80699.png', 'weqe', '#dasd', 'product', 'null', 2, '2021-05-14 06:56:17', '2021-05-14 06:56:17'),
(15, 'image89403.png', 'weqe', '#dasd', 'product', 'null', 2, '2021-05-14 06:57:19', '2021-05-14 06:57:19'),
(16, 'image33973.png', 'weqe', '#dasd', 'product', 'null', 2, '2021-05-14 06:57:39', '2021-05-14 06:57:39'),
(17, 'image30216.png', 'weqe', '#dasd', 'product', 'null', 2, '2021-05-14 07:00:18', '2021-05-14 07:00:18'),
(18, 'image93549.png', 'weqe', '#dasd', 'product', 'null', 2, '2021-05-14 07:02:11', '2021-05-14 07:02:11'),
(19, 'image94264.png', 'weqe', '#dasd', 'product', 'null', 2, '2021-05-14 07:02:56', '2021-05-14 07:02:56'),
(20, 'image68208.png', 'weqe', '#dasd', 'product', 'null', 2, '2021-05-14 07:04:58', '2021-05-14 07:04:58'),
(21, 'image90730.png', 'weqe', '#dasd', 'product', 'null', 2, '2021-05-14 07:06:11', '2021-05-14 07:06:11'),
(22, 'image45032.png', 'weqe', '#dasd', 'product', 'null', 2, '2021-05-14 07:07:22', '2021-05-14 07:07:22'),
(23, 'image66382.png', 'weqe', '#dasd', 'product', 'null', 2, '2021-05-14 07:09:34', '2021-05-14 07:09:34'),
(24, 'image14834.png', 'weqe', '#dasd', 'product', 'null', 2, '2021-05-14 07:10:49', '2021-05-14 07:10:49'),
(25, 'image33306.png', 'weqe', '#dasd', 'product', 'null', 2, '2021-05-14 07:20:57', '2021-05-14 07:20:57'),
(26, 'image38672.png', 'weqe', '#dasd', 'product', 'null', 2, '2021-05-14 07:21:26', '2021-05-14 07:21:26'),
(27, 'image48778.png', 'weqe', '#dasd', 'product', NULL, 2, '2021-05-14 07:25:21', '2021-05-14 07:25:21'),
(28, 'image72665.png', 'normal post', '[[\"1\"]]', 'normal', NULL, 2, '2021-05-19 06:47:12', '2021-05-19 06:47:12'),
(29, 'image87959.png', 'normal post', '[\"1\"]', 'normal', NULL, 2, '2021-05-19 06:48:44', '2021-05-19 06:48:44'),
(30, 'image77432.png', 'normal post', '[\"1,2\"]', 'normal', NULL, 2, '2021-05-19 06:49:06', '2021-05-19 06:49:06'),
(31, 'image79194.png', 'weqe', '[\"#dasd\"]', 'product', NULL, 2, '2021-05-21 05:24:50', '2021-05-21 05:24:54'),
(32, 'image32145.png', 'weqe', '[\"#dasd\"]', 'product', NULL, 2, '2021-05-21 05:30:56', '2021-05-21 05:30:57'),
(33, 'image69886.png', 'weqe', '[\"#dasd\"]', 'product', NULL, 2, '2021-05-25 22:54:23', '2021-05-25 22:54:23'),
(34, 'image30083.png', 'weqe', '[\"#dasd\"]', 'product', NULL, 2, '2021-05-25 23:06:10', '2021-05-25 23:06:12'),
(35, 'image49120.png', 'weqe', '1,2', 'product', NULL, 2, '2021-05-25 23:17:06', '2021-05-25 23:17:06'),
(36, 'image64756.png', 'weqe', '1,2', 'product', '1', 2, '2021-06-04 01:54:13', '2021-05-26 01:54:14');

-- --------------------------------------------------------

--
-- Table structure for table `preferences`
--

CREATE TABLE `preferences` (
  `id` int(10) UNSIGNED NOT NULL,
  `preferences_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `preferences`
--

INSERT INTO `preferences` (`id`, `preferences_name`, `created_at`, `updated_at`) VALUES
(1, 'Drama', NULL, NULL),
(2, 'Poetry', NULL, NULL),
(3, 'Drawing', NULL, NULL),
(4, 'Painting', NULL, NULL),
(5, 'Photography', NULL, NULL),
(6, 'Printmaking', NULL, NULL),
(7, 'Dance', NULL, NULL),
(8, 'Music', NULL, NULL),
(9, 'Theater', NULL, NULL),
(10, 'Singing', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `preference_subcategories`
--

CREATE TABLE `preference_subcategories` (
  `preference_subcategories_id` int(10) UNSIGNED NOT NULL,
  `preference_subcategories_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `preference_subcategories`
--

INSERT INTO `preference_subcategories` (`preference_subcategories_id`, `preference_subcategories_name`, `id`, `created_at`, `updated_at`) VALUES
(1, 'Tragedy', 1, NULL, NULL),
(2, 'Comedy', 1, NULL, NULL),
(3, 'Tragic-comedy', 1, NULL, NULL),
(4, 'Melodrama', 1, NULL, NULL),
(5, 'Musical', 1, NULL, NULL),
(6, 'Playlet', 1, NULL, NULL),
(7, 'Farce', 1, NULL, NULL),
(8, 'Opera', 1, NULL, NULL),
(9, 'Mime', 1, NULL, NULL),
(10, 'Pantomime', 1, NULL, NULL),
(11, 'Ballet', 1, NULL, NULL),
(12, 'Creative drama', 1, NULL, NULL),
(13, 'Asian drama', 1, NULL, NULL),
(14, 'Japanese', 1, NULL, NULL),
(15, 'Chinese opera', 1, NULL, NULL),
(16, 'Western drama', 1, NULL, NULL),
(17, 'Narrative poetry', 2, NULL, NULL),
(18, 'Lyric poetry', 2, NULL, NULL),
(19, 'Epic poetry', 2, NULL, NULL),
(20, 'Satirical poetry', 2, NULL, NULL),
(21, 'Elegy', 2, NULL, NULL),
(22, 'Verse fable', 2, NULL, NULL),
(23, 'Dramatic poetry', 2, NULL, NULL),
(24, 'Speculative poetry', 2, NULL, NULL),
(25, 'Prose poetry', 2, NULL, NULL),
(26, 'Light poetry', 2, NULL, NULL),
(27, 'Slam poetry', 2, NULL, NULL),
(28, 'Line Drawing', 3, NULL, NULL),
(29, 'Stippling', 3, NULL, NULL),
(30, 'Shading', 3, NULL, NULL),
(31, 'Cartooning', 3, NULL, NULL),
(32, 'Figure Drawing', 3, NULL, NULL),
(33, ' Freehand', 3, NULL, NULL),
(34, 'Technical Drawings', 3, NULL, NULL),
(35, 'Illustration Drawing', 3, NULL, NULL),
(36, 'Still Lifes', 3, NULL, NULL),
(37, 'Emotive Drawing', 3, NULL, NULL),
(38, 'Allegory', 4, NULL, NULL),
(39, 'Bodegón', 4, NULL, NULL),
(40, 'Figure Painting', 4, NULL, NULL),
(41, 'Illustration Painting', 4, NULL, NULL),
(42, 'Landscape Painting', 4, NULL, NULL),
(43, 'Portrait Painting', 4, NULL, NULL),
(44, 'Still Life', 4, NULL, NULL),
(45, 'Veduta', 4, NULL, NULL),
(46, 'Architectural Photography', 5, NULL, NULL),
(47, 'Astronomical Objects', 5, NULL, NULL),
(48, 'Portrait Photography', 5, NULL, NULL),
(49, 'Candid Photography', 5, NULL, NULL),
(50, ' Fashion Photography', 5, NULL, NULL),
(51, 'Creative Photography', 5, NULL, NULL),
(52, 'Event Photography', 5, NULL, NULL),
(53, 'Film Photography', 5, NULL, NULL),
(54, 'Still-Life Photography', 5, NULL, NULL),
(55, 'Landscape Photography', 5, NULL, NULL),
(56, 'Lifestyle Photography', 5, NULL, NULL),
(57, 'Interior Photography', 5, NULL, NULL),
(58, 'Food Photography', 5, NULL, NULL),
(59, 'Wildlife Photography ', 5, NULL, NULL),
(60, 'Street Photography', 5, NULL, NULL),
(61, 'Travel Photography', 5, NULL, NULL),
(62, 'Underwater Photography', 5, NULL, NULL),
(63, 'Time-Lapse Photography', 5, NULL, NULL),
(64, 'Night Photography', 5, NULL, NULL),
(65, 'Woodcuts', 6, NULL, NULL),
(66, 'Collagraph', 6, NULL, NULL),
(67, 'Engraving', 6, NULL, NULL),
(68, 'Etching ', 6, NULL, NULL),
(69, 'Monotype', 6, NULL, NULL),
(70, 'Lithography', 6, NULL, NULL),
(71, 'Monoprint', 6, NULL, NULL),
(72, 'Screen Printing', 6, NULL, NULL),
(73, 'Mezzotin', 6, NULL, NULL),
(74, 'Aquatint', 6, NULL, NULL),
(75, 'Drypoint', 6, NULL, NULL),
(76, 'Lithography', 6, NULL, NULL),
(77, 'Screenprinting', 6, NULL, NULL),
(78, 'Monoprint', 6, NULL, NULL),
(79, 'Mixed-Media Prints', 6, NULL, NULL),
(80, 'Digital Prints', 6, NULL, NULL),
(81, 'Foil Imaging', 6, NULL, NULL),
(95, 'Indian Classical Dance', 7, NULL, NULL),
(96, 'African-American Dance', 7, NULL, NULL),
(97, 'Novelty Or Fad Dance', 7, NULL, NULL),
(98, 'Ceremonial Dance Or Ritual Dance Or Festival Dance', 7, NULL, NULL),
(99, 'Social Dance', 7, NULL, NULL),
(100, 'Latin/Rhythm Dance', 7, NULL, NULL),
(101, 'Street Dance', 7, NULL, NULL),
(102, 'Historical Dance', 7, NULL, NULL),
(103, 'Western Dance', 7, NULL, NULL),
(104, 'Pop', 8, NULL, NULL),
(105, 'Dance / EDM (Electronic Dance Music)', 8, NULL, NULL),
(106, 'Hip-hop and Rap', 8, NULL, NULL),
(107, 'R&B', 8, NULL, NULL),
(108, 'Latin', 8, NULL, NULL),
(109, 'Rock', 8, NULL, NULL),
(110, 'Metal', 8, NULL, NULL),
(111, 'Country', 8, NULL, NULL),
(112, 'Folk (also called Contemporary folk - wikipedia)', 8, NULL, NULL),
(113, 'Classical', 8, NULL, NULL),
(114, 'Jazz', 8, NULL, NULL),
(115, 'Blues', 8, NULL, NULL),
(116, 'Easy Listening', 8, NULL, NULL),
(117, 'New Age', 8, NULL, NULL),
(118, 'World / Traditional Folk (wikipedia)', 8, NULL, NULL),
(119, 'African Music', 8, NULL, NULL),
(120, 'Asian Music', 8, NULL, NULL),
(121, 'Caribbean Music', 8, NULL, NULL),
(122, 'European Music', 8, NULL, NULL),
(123, 'North American Music', 8, NULL, NULL),
(124, 'Latin And South American Music', 8, NULL, NULL),
(125, 'Drama', 9, NULL, NULL),
(126, 'Musical Theatre', 9, NULL, NULL),
(127, 'Comedy', 9, NULL, NULL),
(128, 'Tragedy', 9, NULL, NULL),
(129, 'Improvisation', 9, NULL, NULL),
(130, 'Opera And Classical', 10, NULL, NULL),
(131, 'Chinese Opera', 10, NULL, NULL),
(132, 'Indian Music', 10, NULL, NULL),
(133, 'Religious Music', 10, NULL, NULL),
(134, 'Gospel - Christian Music', 10, NULL, NULL),
(135, 'Traditional Music', 10, NULL, NULL),
(136, 'World Music', 10, NULL, NULL),
(137, 'Jazz', 10, NULL, NULL),
(138, 'Blues', 10, NULL, NULL),
(139, 'Ghazal', 10, NULL, NULL),
(140, 'Pop', 10, NULL, NULL),
(141, 'Rock', 10, NULL, NULL),
(142, 'Electronic Dance Music', 10, NULL, NULL),
(143, 'aaaa', 9, NULL, '2022-02-28 10:09:19');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `offer_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `limited_stock` int(11) NOT NULL DEFAULT 0,
  `sell_product` int(11) NOT NULL DEFAULT 0,
  `post_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `price`, `discount`, `offer_price`, `product_image`, `product_description`, `limited_stock`, `sell_product`, `post_id`, `created_at`, `updated_at`) VALUES
(1, 'werr', '2344', '456', '5443', 'image59125.jpg', '1', 0, 0, 36, '2021-05-26 01:54:14', '2021-05-26 01:54:14');

-- --------------------------------------------------------

--
-- Table structure for table `registers`
--

CREATE TABLE `registers` (
  `register_id` int(10) UNSIGNED NOT NULL,
  `register_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `register_mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `register_dob` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `register_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `register_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `register_repasswprd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `register_bio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `register_website` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `register_genres` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `register_work_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `register_performance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `send_notifications`
--

CREATE TABLE `send_notifications` (
  `send_notifications_id` int(10) UNSIGNED NOT NULL,
  `register_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requested_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `send_notification_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notification_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `short_stories`
--

CREATE TABLE `short_stories` (
  `id` int(10) UNSIGNED NOT NULL,
  `short_stories_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `store_id` int(10) UNSIGNED NOT NULL,
  `store_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `register_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` int(10) UNSIGNED NOT NULL,
  `register_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`id`, `register_id`, `token`, `created_at`, `updated_at`) VALUES
(1, '1', '94f45994e6168959bc8b144d51a544ba990ff2ac', '2021-04-28 11:26:01', '2021-04-28 11:26:55'),
(2, '2', 'b48db17726b4c157f06dc4dbe44326e9b7957d34', '2021-04-28 11:54:02', '2021-04-28 11:54:28'),
(3, '7', 'eedaf110c9ff240de9d7e07ca238ed04573f932a', '2022-01-18 23:05:21', '2022-01-19 00:29:15'),
(4, '7', '1941745af3c6cf0218c9172cc0db4e86aca51bd4', '2022-01-28 04:33:25', '2022-01-28 04:33:25'),
(5, '7', '3eda17d9e778fdb4d3120e4d442c86b991682853', '2022-01-28 08:17:31', '2022-01-28 08:17:31'),
(6, '8', '3d4a611233dda90d3b92d68edb719fc4d06baee9', '2022-01-28 08:17:40', '2022-01-28 08:17:40'),
(7, '7', 'ac3fded21b43b3321337d850e57e0fee279f319c', '2022-02-04 13:23:46', '2022-02-04 13:23:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `register_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `repasswprd` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `major_achivement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `genres` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `performance` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visiting_card` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_category_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_category_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Admin',
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`register_id`, `name`, `country_code`, `mobile`, `dob`, `email`, `email_verified_at`, `password`, `repasswprd`, `image`, `description`, `website`, `major_achivement`, `genres`, `work_at`, `performance`, `visiting_card`, `main_category_name`, `sub_category_name`, `role`, `type`, `user_type`, `device_token`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Muskan', '+91', '9876543211', '10-11-22', 'muskan@gmail.com', NULL, '$2y$10$5KKPAfuXb5I10epigYdMp.1VubZDex0bu3V6Mdi9qn4YzKXc1uAMy', '$2y$10$d9BVxjVLLRLeEdjdrMpve.5SkBi1LBlv99yWqzfVx9dHAqGRJnqF.', 'image37807.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'artist', 'Admin', NULL, NULL, NULL, NULL, NULL),
(2, 'vasu', '+91', '8511036287', '2022-02-22', 'muskan1@gmail.com', NULL, '$2y$10$i/EnZpR5gcmfutCmMACWRer8VQFAR2hr//bm68ngdOzKpSFTIl5.S', NULL, 'image23045.jpg', 'testing', 'www.testing.com', 'testing', 'testng', 'testng', 'testing', NULL, '9', '127', 'Admin', 'Admin', 'artist', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `connections`
--
ALTER TABLE `connections`
  ADD PRIMARY KEY (`connection_id`),
  ADD KEY `connections_register_id_foreign` (`register_id`);

--
-- Indexes for table `contact_uses`
--
ALTER TABLE `contact_uses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `notifications_register_id_foreign` (`register_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `poets`
--
ALTER TABLE `poets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `posts_register_id_foreign` (`register_id`);

--
-- Indexes for table `preferences`
--
ALTER TABLE `preferences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `preference_subcategories`
--
ALTER TABLE `preference_subcategories`
  ADD PRIMARY KEY (`preference_subcategories_id`),
  ADD KEY `preference_subcategories_id_foreign` (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `products_post_id_foreign` (`post_id`);

--
-- Indexes for table `registers`
--
ALTER TABLE `registers`
  ADD PRIMARY KEY (`register_id`);

--
-- Indexes for table `send_notifications`
--
ALTER TABLE `send_notifications`
  ADD PRIMARY KEY (`send_notifications_id`);

--
-- Indexes for table `short_stories`
--
ALTER TABLE `short_stories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`store_id`),
  ADD KEY `stores_register_id_foreign` (`register_id`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`register_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `connections`
--
ALTER TABLE `connections`
  MODIFY `connection_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_uses`
--
ALTER TABLE `contact_uses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `poets`
--
ALTER TABLE `poets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `preferences`
--
ALTER TABLE `preferences`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `preference_subcategories`
--
ALTER TABLE `preference_subcategories`
  MODIFY `preference_subcategories_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `registers`
--
ALTER TABLE `registers`
  MODIFY `register_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `send_notifications`
--
ALTER TABLE `send_notifications`
  MODIFY `send_notifications_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `short_stories`
--
ALTER TABLE `short_stories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `store_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `register_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `connections`
--
ALTER TABLE `connections`
  ADD CONSTRAINT `connections_register_id_foreign` FOREIGN KEY (`register_id`) REFERENCES `users` (`register_id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_register_id_foreign` FOREIGN KEY (`register_id`) REFERENCES `users` (`register_id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_register_id_foreign` FOREIGN KEY (`register_id`) REFERENCES `users` (`register_id`);

--
-- Constraints for table `preference_subcategories`
--
ALTER TABLE `preference_subcategories`
  ADD CONSTRAINT `preference_subcategories_id_foreign` FOREIGN KEY (`id`) REFERENCES `preferences` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`);

--
-- Constraints for table `stores`
--
ALTER TABLE `stores`
  ADD CONSTRAINT `stores_register_id_foreign` FOREIGN KEY (`register_id`) REFERENCES `users` (`register_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
