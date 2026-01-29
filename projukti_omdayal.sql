-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2026 at 02:49 PM
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
-- Database: `projukti_omdayal`
--

-- --------------------------------------------------------

--
-- Table structure for table `achievements`
--

CREATE TABLE `achievements` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `news_date` text DEFAULT NULL,
  `photo` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `achievements`
--

INSERT INTO `achievements` (`id`, `name`, `news_date`, `photo`, `deleted_at`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Achievement 1', '2026-01-13', '1769438374_1.png', NULL, 1, '2026-01-26 09:09:34', '2026-01-26 09:09:34');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` enum('ma','s') DEFAULT 's' COMMENT 'ma = master admin, b = branch, s = staff',
  `mobile` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `remember_token` varchar(250) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `type`, `mobile`, `email`, `password`, `image`, `remember_token`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Master Admin', 'ma', '9830006120', 'pratimt@gmail.com', '$2y$10$TVEJg4pHvC3qabShMnfSUOmlbakklezJQROWP13wmgAy14XDVp3vq', '1769233854360_F_1525361933_wrAhkKnIAuYmw9suastDjy6ZDuPLld64.jpg', NULL, 1, NULL, '2026-01-24 00:21:22');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `heading1` varchar(250) DEFAULT NULL,
  `heading2` varchar(250) DEFAULT NULL,
  `section` int(11) NOT NULL DEFAULT 0,
  `banner_text` varchar(250) DEFAULT NULL,
  `banner_text2` varchar(250) DEFAULT NULL,
  `banner_link` varchar(250) DEFAULT NULL,
  `banner_image` varchar(250) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `institute_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(250) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `institute_id`, `name`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Category 1', 1, NULL, '2026-01-27 08:29:04', '2026-01-27 08:29:04'),
(2, 1, 'Category 2', 1, NULL, '2026-01-27 08:29:11', '2026-01-27 08:29:11'),
(3, 1, 'Category 3', 1, NULL, '2026-01-27 08:29:18', '2026-01-28 13:33:17'),
(4, 2, 'Category 4', 1, NULL, '2026-01-27 08:29:37', '2026-01-27 08:29:37'),
(5, 2, 'Category 5', 1, NULL, '2026-01-27 08:29:37', '2026-01-27 08:29:37'),
(6, 2, 'Category 6', 1, NULL, '2026-01-27 08:29:37', '2026-01-27 08:29:37');

-- --------------------------------------------------------

--
-- Table structure for table `email_logs`
--

CREATE TABLE `email_logs` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `subject` varchar(250) DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `venue` text DEFAULT NULL,
  `event_date` text DEFAULT NULL,
  `photo` text DEFAULT NULL,
  `video` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `venue`, `event_date`, `photo`, `video`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Event 1', '<p>Event 1 Event 1</p>', 'Kolkata', '2026-01-31', '1769521815_164170133620_venue_image.jpg', '1769521815_draw-video.mp4', 1, NULL, '2026-01-27 08:20:15', '2026-01-27 08:20:15');

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` int(11) NOT NULL,
  `site_name` varchar(250) DEFAULT NULL,
  `site_phone` varchar(255) DEFAULT NULL,
  `site_mail` varchar(255) DEFAULT NULL,
  `system_email` varchar(250) DEFAULT NULL,
  `site_url` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `timing` longtext DEFAULT NULL,
  `site_logo` varchar(255) DEFAULT NULL,
  `site_footer_logo` varchar(250) DEFAULT NULL,
  `site_favicon` varchar(250) DEFAULT NULL,
  `theme_color` varchar(250) DEFAULT NULL,
  `font_color` varchar(250) DEFAULT NULL,
  `twitter_profile` varchar(250) DEFAULT NULL,
  `facebook_profile` varchar(250) DEFAULT NULL,
  `instagram_profile` varchar(250) DEFAULT NULL,
  `linkedin_profile` varchar(250) DEFAULT NULL,
  `youtube_profile` varchar(250) DEFAULT NULL,
  `sms_authentication_key` varchar(250) DEFAULT NULL,
  `sms_sender_id` varchar(250) DEFAULT NULL,
  `sms_base_url` varchar(250) DEFAULT NULL,
  `from_email` varchar(250) DEFAULT NULL,
  `from_name` varchar(250) DEFAULT NULL,
  `smtp_host` varchar(250) DEFAULT NULL,
  `smtp_username` varchar(250) DEFAULT NULL,
  `smtp_password` varchar(250) DEFAULT NULL,
  `smtp_port` varchar(250) DEFAULT NULL,
  `email_template_forgot_password` longtext DEFAULT NULL,
  `email_template_change_password` longtext DEFAULT NULL,
  `email_template_failed_login` longtext DEFAULT NULL,
  `meta_title` longtext DEFAULT NULL,
  `meta_description` longtext DEFAULT NULL,
  `meta_keywords` longtext DEFAULT NULL,
  `document_size` int(11) NOT NULL DEFAULT 0,
  `photo_size` int(11) NOT NULL DEFAULT 0,
  `video_size` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `published` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `site_name`, `site_phone`, `site_mail`, `system_email`, `site_url`, `description`, `timing`, `site_logo`, `site_footer_logo`, `site_favicon`, `theme_color`, `font_color`, `twitter_profile`, `facebook_profile`, `instagram_profile`, `linkedin_profile`, `youtube_profile`, `sms_authentication_key`, `sms_sender_id`, `sms_base_url`, `from_email`, `from_name`, `smtp_host`, `smtp_username`, `smtp_password`, `smtp_port`, `email_template_forgot_password`, `email_template_change_password`, `email_template_failed_login`, `meta_title`, `meta_description`, `meta_keywords`, `document_size`, `photo_size`, `video_size`, `created_at`, `updated_at`, `published`) VALUES
(1, 'Omdayal', '+919830006120', 'pratimt@gmail.com', 'pratimt@gmail.com', 'https://susomaias.com/omdayal/', 'Test address', NULL, '1769234530logo-om-dayal.png', '1769234530logo-om-dayal.png', '1769234530logo-om-dayal.png', '#f10e1d', '#ffffff', NULL, NULL, NULL, '#', NULL, 'aaaaaaaaaaa', 'bbbbbbbbbbbb', 'cccccccccccc', 'info@threecranesgallery.com', 'Three Cranes Gallery', 'smtp.office365.com', 'info@threecranesgallery.com', 'Brownieluna@0506', '587', '<p>Welcome to Three Cranes Gallery !</p><figure class=\"image\"><img style=\"aspect-ratio:144/134;\" src=\"https://threecranes-dev.itiffyconsultants.com/public/uploads/1726130627logo.jpg\" width=\"144\" height=\"134\"></figure><p>Hi, Welcome to Three Cranes Gallery !</p><p>Your OTP: {{otp1}} {{otp2}} {{otp3}} {{otp4}}</p><p>All right reserved. © 2024-2025 Three Cranes Gallery</p>', '<p>Welcome to Three Cranes Gallery !</p><figure class=\"image\"><img style=\"aspect-ratio:144/134;\" src=\"https://threecranes-dev.itiffyconsultants.com/public/uploads/1726130627logo.jpg\" width=\"144\" height=\"134\"></figure><p>Hi, Welcome to Three Cranes Gallery !</p><p>You have successfully change your password</p><p>Name</p><p>{{name}}</p><p>Email</p><p>{{email}}</p><p>All right reserved: © 2024-2025 Three Cranes Gallery</p>', '<p>Welcome to Three Cranes Gallery !</p><figure class=\"image\"><img style=\"aspect-ratio:144/134;\" src=\"https://threecranes-dev.itiffyconsultants.com/public/uploads/1726130627logo.jpg\" width=\"144\" height=\"134\"></figure><p>Sorry, your login was failed</p><p>Email</p><p>{{email}}</p><p>All right reserved: © 2024-2025 Three Cranes Gallery</p>', '<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>', '<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>', '<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>', 5000, 200, 10000, '0000-00-00 00:00:00', '2026-01-24 00:43:44', 1);

-- --------------------------------------------------------

--
-- Table structure for table `institutes`
--

CREATE TABLE `institutes` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `institutes`
--

INSERT INTO `institutes` (`id`, `name`, `logo`, `deleted_at`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Institute 1', '1769435673_simple-karate-logo-vector.jpg', NULL, 1, '2026-01-26 06:01:56', '2026-01-27 08:29:44'),
(2, 'Institute 2', '1769435438_360_F_1525361933_wrAhkKnIAuYmw9suastDjy6ZDuPLld64.jpg', NULL, 1, '2026-01-26 06:01:56', '2026-01-27 08:29:49');

-- --------------------------------------------------------

--
-- Table structure for table `magazines`
--

CREATE TABLE `magazines` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `news_date` text DEFAULT NULL,
  `photo` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `mag_file` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `magazines`
--

INSERT INTO `magazines` (`id`, `name`, `news_date`, `photo`, `description`, `mag_file`, `deleted_at`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Magazine 1', '2026-01-10', '1769438031_8129_500_320.png', 'test', '1769438031_sample.pdf', NULL, 1, '2026-01-26 09:03:51', '2026-01-26 09:03:51');

-- --------------------------------------------------------

--
-- Table structure for table `medias`
--

CREATE TABLE `medias` (
  `id` int(11) NOT NULL,
  `institute_id` int(11) NOT NULL DEFAULT 0,
  `category_id` int(11) NOT NULL DEFAULT 0,
  `media_file` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medias`
--

INSERT INTO `medias` (`id`, `institute_id`, `category_id`, `media_file`, `deleted_at`, `status`, `created_at`, `updated_at`) VALUES
(13, 2, 5, 'uploads/media/1769690286_697b54ae16d47.jpg', NULL, 1, '2026-01-29 12:38:06', '2026-01-29 13:33:45'),
(14, 2, 5, 'uploads/media/1769690286_697b54ae16f1b.png', NULL, 1, '2026-01-29 12:38:06', '2026-01-29 13:33:48'),
(15, 2, 5, 'uploads/media/1769690286_697b54ae17010.jpg', NULL, 1, '2026-01-29 12:38:06', '2026-01-29 13:33:50'),
(16, 2, 5, 'uploads/media/1769690286_697b54ae170eb.png', NULL, 1, '2026-01-29 12:38:06', '2026-01-29 13:33:52'),
(17, 2, 5, 'uploads/media/1769690286_697b54ae17221.jpg', '2026-01-29 13:43:10', 3, '2026-01-29 12:38:06', '2026-01-29 08:13:10'),
(18, 2, 5, 'uploads/media/1769690286_697b54ae1735d.png', '2026-01-29 13:41:46', 3, '2026-01-29 12:38:06', '2026-01-29 08:11:46'),
(19, 2, 5, 'uploads/media/1769690286_697b54ae1746a.jpg', NULL, 1, '2026-01-29 12:38:06', '2026-01-29 13:33:59'),
(20, 2, 5, 'uploads/media/1769694202_697b63fa0bfd0.png', NULL, 1, '2026-01-29 13:43:22', NULL),
(21, 2, 5, 'uploads/media/1769694202_697b63fa0c1ee.jpg', NULL, 1, '2026-01-29 13:43:22', NULL),
(22, 2, 5, 'uploads/media/1769694202_697b63fa0c2d2.jpg', NULL, 1, '2026-01-29 13:43:22', NULL),
(23, 1, 3, 'uploads/media/1769694270_697b643ec1b01.png', NULL, 1, '2026-01-29 13:44:30', NULL),
(24, 1, 3, 'uploads/media/1769694270_697b643ec1cf5.jpg', NULL, 1, '2026-01-29 13:44:30', NULL),
(25, 1, 3, 'uploads/media/1769694270_697b643ec1dce.png', NULL, 1, '2026-01-29 13:44:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `news_date` text DEFAULT NULL,
  `photo` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `name`, `news_date`, `photo`, `description`, `deleted_at`, `status`, `created_at`, `updated_at`) VALUES
(1, 'News 1', '2026-01-07', '1769437538_8132_500_320.jpg', 'test', NULL, 1, '2026-01-26 08:55:38', '2026-01-26 08:55:38');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `page_title` varchar(250) DEFAULT NULL,
  `slug` varchar(250) DEFAULT NULL,
  `short_description` longtext DEFAULT NULL,
  `long_description` longtext DEFAULT NULL,
  `page_banner_image` varchar(250) DEFAULT NULL,
  `meta_title` longtext DEFAULT NULL,
  `meta_description` longtext DEFAULT NULL,
  `meta_keywords` longtext DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `page_title`, `slug`, `short_description`, `long_description`, `page_banner_image`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Privacy Policy', 'privacy-policy', NULL, '<p>What is Lorem Ipsum?</p><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p>Why do we use it?</p><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p><p><br>&nbsp;</p><p>Where does it come from?</p><p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p><p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p><p>Where can I get some?</p><p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>', NULL, NULL, NULL, NULL, 1, '2026-01-26 09:44:02', '2026-01-26 09:44:02'),
(2, 'Terms and Conditions', 'terms-and-conditions', NULL, '<p>What is Lorem Ipsum?</p><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p>Why do we use it?</p><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p><p><br>&nbsp;</p><p>Where does it come from?</p><p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p><p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p><p>Where can I get some?</p><p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>', NULL, NULL, NULL, NULL, 1, '2026-01-26 09:44:41', '2026-01-26 09:44:41'),
(3, 'About Us', 'about-us', NULL, '<p>What is Lorem Ipsum?</p><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p>Why do we use it?</p><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p><p><br>&nbsp;</p><p>Where does it come from?</p><p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p><p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p><p>Where can I get some?</p><p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>', NULL, NULL, NULL, NULL, 1, '2026-01-26 09:44:55', '2026-01-26 09:44:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` int(11) NOT NULL DEFAULT 0 COMMENT '1=>society, 2=>admin & employee, 3=> teacher',
  `institute_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(250) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT current_timestamp(),
  `phone` varchar(250) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `photo` varchar(250) DEFAULT NULL,
  `designation` text DEFAULT NULL,
  `dob` text DEFAULT NULL,
  `short_profile` text DEFAULT NULL,
  `biodata` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>inactive,1=>active,3=>deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `type`, `institute_id`, `name`, `email`, `email_verified_at`, `phone`, `password`, `remember_token`, `photo`, `designation`, `dob`, `short_profile`, `biodata`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, 0, 'Society Member 1', 'somem1@yopmail.com', '2026-01-25 23:37:14', '9999999999', '$2y$10$i6Whl1G0hT9ALoDD8lSNUe3foNE/0fbdYtJ0BXN/DrHdvU.Py5n0K', NULL, '1769404034_8132_500_320.jpg', 'Designation updated', '2000-08-21', 'Short Profile updated', NULL, '2026-01-25 23:37:14', '2026-01-25 23:39:35', 1),
(2, 2, 0, 'Employee 1', 'emp1@yopmail.com', '2026-01-26 05:52:41', '7777777777', '$2y$10$goqyhXIz4iy18PUHzeiFXO17FSz9WfayFD7SY1YFk8v2HBWsvZaNK', NULL, '1769406761_1688301381netaji.jpg', 'Designation', '1989-01-23', NULL, '1769407135_sample.pdf', '2026-01-26 00:22:41', '2026-01-26 06:00:33', 1),
(3, 3, 1, 'Teacher 1', 'teacher1@yopmail.com', '2026-01-26 09:31:38', '5555555555', '$2y$10$rWgDTInIsqTRM7wYBt107.P5/Q4O09M3X3LO/s8sOhIfpbb1aqUcy', NULL, '1769419898_8129_500_320.png', 'Designation', '2001-01-01', NULL, '1769420050_sample.pdf', '2026-01-26 04:01:38', '2026-01-26 04:04:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_accesses`
--

CREATE TABLE `user_accesses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `module_id` varchar(250) DEFAULT '[]',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_accesses`
--

INSERT INTO `user_accesses` (`id`, `user_id`, `module_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"14\",\"15\",\"16\",\"17\",\"18\",\"19\",\"20\",\"21\",\"25\",\"26\",\"27\",\"28\",\"29\",\"30\",\"31\",\"32\",\"33\",\"34\",\"35\"]', 1, '2023-08-03 06:27:18', '2025-07-21 10:41:56');

-- --------------------------------------------------------

--
-- Table structure for table `user_activities`
--

CREATE TABLE `user_activities` (
  `activity_id` int(11) NOT NULL,
  `user_email` varchar(250) DEFAULT NULL,
  `user_name` varchar(250) DEFAULT NULL,
  `user_type` enum('ADMIN','USER') DEFAULT NULL,
  `ip_address` varchar(250) DEFAULT NULL,
  `activity_type` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=>failed login,1=>success login,2=>logout',
  `activity_details` longtext DEFAULT NULL,
  `platform_type` enum('WEB','MOBILE','ANDROID','IOS') NOT NULL DEFAULT 'WEB',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_activities`
--

INSERT INTO `user_activities` (`activity_id`, `user_email`, `user_name`, `user_type`, `ip_address`, `activity_type`, `activity_details`, `platform_type`, `created_at`, `updated_at`) VALUES
(3, 'pratimt@gmail.com', 'Master Admin', 'ADMIN', '::1', 1, 'Login Success !!!', 'WEB', '2026-01-24 05:51:58', '2026-01-24 05:51:58'),
(4, 'pratimt@gmail.com', 'Master Admin', 'ADMIN', '::1', 2, 'You Are Successfully Logged Out !!!', 'WEB', '2026-01-24 05:54:43', '2026-01-24 05:54:43'),
(5, 'pratimt@gmail.com', 'Master Admin', 'ADMIN', '::1', 1, 'Login Success !!!', 'WEB', '2026-01-24 05:55:38', '2026-01-24 05:55:38'),
(6, 'pratimt@gmail.com', 'Master Admin', 'ADMIN', '::1', 2, 'You Are Successfully Logged Out !!!', 'WEB', '2026-01-24 05:55:44', '2026-01-24 05:55:44'),
(7, 'pratimt@gmail.com', 'Master Admin', 'ADMIN', '::1', 1, 'Login Success !!!', 'WEB', '2026-01-24 05:55:47', '2026-01-24 05:55:47'),
(8, 'pratimt@gmail.com', 'Master Admin', 'ADMIN', '::1', 2, 'You Are Successfully Logged Out !!!', 'WEB', '2026-01-24 06:18:52', '2026-01-24 06:18:52'),
(9, 'pratimt@gmail.com', 'Master Admin', 'ADMIN', '::1', 1, 'Login Success !!!', 'WEB', '2026-01-26 03:25:50', '2026-01-26 03:25:50'),
(10, 'pratimt@gmail.com', 'Master Admin', 'ADMIN', '::1', 1, 'Login Success !!!', 'WEB', '2026-01-26 09:17:32', '2026-01-26 09:17:32'),
(11, 'pratimt@gmail.com', 'Master Admin', 'ADMIN', '::1', 1, 'Login Success !!!', 'WEB', '2026-01-26 13:40:34', '2026-01-26 13:40:34'),
(12, 'pratimt@gmail.com', 'Master Admin', 'ADMIN', '::1', 2, 'You Are Successfully Logged Out !!!', 'WEB', '2026-01-26 14:41:32', '2026-01-26 14:41:32'),
(13, 'pratimt@gmail.com', 'Master Admin', 'ADMIN', '::1', 1, 'Login Success !!!', 'WEB', '2026-01-27 13:44:31', '2026-01-27 13:44:31'),
(14, 'pratimt@gmail.com', 'Master Admin', 'ADMIN', '::1', 2, 'You Are Successfully Logged Out !!!', 'WEB', '2026-01-27 14:00:12', '2026-01-27 14:00:12'),
(15, 'pratimt@gmail.com', 'Master Admin', 'ADMIN', '::1', 1, 'Login Success !!!', 'WEB', '2026-01-28 13:07:18', '2026-01-28 13:07:18'),
(16, 'pratimt@gmail.com', 'Master Admin', 'ADMIN', '::1', 2, 'You Are Successfully Logged Out !!!', 'WEB', '2026-01-28 13:46:46', '2026-01-28 13:46:46'),
(17, 'pratimt@gmail.com', 'Master Admin', 'ADMIN', '::1', 1, 'Login Success !!!', 'WEB', '2026-01-29 12:23:24', '2026-01-29 12:23:24'),
(18, 'pratimt@gmail.com', 'Master Admin', 'ADMIN', '::1', 1, 'Login Success !!!', 'WEB', '2026-01-29 12:23:24', '2026-01-29 12:23:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achievements`
--
ALTER TABLE `achievements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_logs`
--
ALTER TABLE `email_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `institutes`
--
ALTER TABLE `institutes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `magazines`
--
ALTER TABLE `magazines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medias`
--
ALTER TABLE `medias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_accesses`
--
ALTER TABLE `user_accesses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_activities`
--
ALTER TABLE `user_activities`
  ADD PRIMARY KEY (`activity_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achievements`
--
ALTER TABLE `achievements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `email_logs`
--
ALTER TABLE `email_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `institutes`
--
ALTER TABLE `institutes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `magazines`
--
ALTER TABLE `magazines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `medias`
--
ALTER TABLE `medias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_accesses`
--
ALTER TABLE `user_accesses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_activities`
--
ALTER TABLE `user_activities`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
