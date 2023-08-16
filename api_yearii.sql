-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2023 at 04:13 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `api_yearii`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
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
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

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
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `productlist`
-- (See below for the actual view)
--
CREATE TABLE `productlist` (
`proid` int(11)
,`barcode` varchar(200)
,`protitle` varchar(200)
,`qty` int(11)
,`price` float
,`amount` double
,`catid` int(11)
,`cattitle` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `product_list`
-- (See below for the actual view)
--
CREATE TABLE `product_list` (
`proid` int(11)
,`barcode` varchar(200)
,`protitle` varchar(200)
,`qty` int(11)
,`price` float
,`amount` double
,`catid` int(11)
,`cattitle` varchar(100)
,`created_at` timestamp
,`updated_at` timestamp
);

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `catid` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `titlekh` varchar(100) DEFAULT NULL,
  `desciption` longtext DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`catid`, `title`, `titlekh`, `desciption`, `updated_at`, `created_at`) VALUES
(1, 'CoCa', 'កូកា', 'ENERGY DRINK', '2023-08-13 19:47:40', '2023-08-11 17:22:50'),
(2, 'Wurkz', 'វើក', 'ENERGY DRINK', '2023-08-11 19:13:30', '2023-08-11 17:22:50'),
(3, 'Champion', 'ឆែមពាន់', 'ENERGY DRINK', '2023-08-11 19:14:14', '2023-08-11 17:22:50'),
(4, 'Ice', 'អាយ', 'ENERGY DRINK', '2023-08-11 19:14:19', '2023-08-11 17:22:50'),
(5, 'Bear', 'ស្រាបៀរ', 'BEER', '2023-08-11 19:15:42', '2023-08-11 17:22:50'),
(10, 'qwq', 'qw', NULL, '2023-08-11 18:53:32', '2023-08-11 18:53:32'),
(11, 'qwq', 'qw', 'wewe', '2023-08-11 18:56:00', '2023-08-11 18:56:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblpo`
--

CREATE TABLE `tblpo` (
  `poid` int(11) NOT NULL,
  `pocode` varchar(60) NOT NULL,
  `date` date NOT NULL,
  `dis` int(10) DEFAULT 0,
  `tax` int(10) DEFAULT 0,
  `total` float NOT NULL,
  `grand_total` float DEFAULT 0,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblpo`
--

INSERT INTO `tblpo` (`poid`, `pocode`, `date`, `dis`, `tax`, `total`, `grand_total`, `create_at`, `updated_at`) VALUES
(18, '123', '2023-08-14', 15, 100, 50, 142.5, '2023-08-14 02:39:51', '2023-08-13 21:04:22'),
(14, '123', '2023-08-13', 12, 12, 60, 64.8, '2023-08-13 11:15:33', '2023-08-13 06:23:53'),
(15, '1234', '2023-08-13', 1, 1, 550, 545.5, '2023-08-13 12:17:59', '2023-08-13 12:17:59'),
(16, '123', '2023-08-13', 15, 5, 422, 363.7, '2023-08-13 12:54:02', '2023-08-13 12:54:02'),
(17, '1234', '2023-08-12', 15, 12, 840, 726, '2023-08-13 13:35:38', '2023-08-13 13:35:38');

-- --------------------------------------------------------

--
-- Table structure for table `tblpodetail`
--

CREATE TABLE `tblpodetail` (
  `pdetail` int(11) NOT NULL,
  `poid` int(11) NOT NULL,
  `proid` int(11) NOT NULL,
  `qty` float NOT NULL,
  `cost` float NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblpodetail`
--

INSERT INTO `tblpodetail` (`pdetail`, `poid`, `proid`, `qty`, `cost`, `create_at`) VALUES
(1, 9, 1, 10, 10, '2023-08-13 09:34:52'),
(2, 10, 1, 12, 100, '2023-08-13 11:06:20'),
(3, 11, 1, 12, 10, '2023-08-13 11:08:21'),
(4, 12, 1, 12, 5, '2023-08-13 11:10:10'),
(5, 13, 1, 12, 12, '2023-08-13 11:12:11'),
(6, 14, 1, 12, 5, '2023-08-13 11:15:33'),
(7, 15, 1, 5, 100, '2023-08-13 12:17:59'),
(8, 15, 3, 5, 10, '2023-08-13 12:17:59'),
(9, 16, 1, 5, 5, '2023-08-13 12:54:02'),
(10, 16, 3, 5, 5, '2023-08-13 12:54:02'),
(11, 16, 1, 55, 5, '2023-08-13 12:54:02'),
(12, 16, 3, 15, 5, '2023-08-13 12:54:02'),
(13, 16, 1, 6, 12, '2023-08-13 12:54:02'),
(14, 17, 1, 10, 10, '2023-08-13 13:35:38'),
(15, 17, 3, 10, 5, '2023-08-13 13:35:38'),
(16, 17, 1, 50, 10, '2023-08-13 13:35:38'),
(17, 17, 3, 10, 10, '2023-08-13 13:35:38'),
(18, 17, 1, 10, 5, '2023-08-13 13:35:38'),
(19, 17, 3, 10, 4, '2023-08-13 13:35:38'),
(20, 18, 1, 5, 10, '2023-08-14 02:39:51');

-- --------------------------------------------------------

--
-- Table structure for table `tblproduct`
--

CREATE TABLE `tblproduct` (
  `proid` int(11) NOT NULL,
  `barcode` varchar(200) DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` float NOT NULL,
  `categoryid` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblproduct`
--

INSERT INTO `tblproduct` (`proid`, `barcode`, `title`, `qty`, `price`, `categoryid`, `created_at`, `updated_at`) VALUES
(1, '123', 'Drink', 5, 5, 2, '2023-08-12 23:28:45', '2023-08-12 18:16:04'),
(2, '1234567', 'dsfds7', 107, 27, 6, '2023-08-12 23:28:45', '2023-08-12 17:38:52'),
(3, '1234', 'DRINK', 4, 6, 3, '2023-08-12 23:28:45', '2023-08-12 18:16:20'),
(4, '11111', 'Prime', 2, 15, 2, '2023-08-12 23:28:45', '2023-08-12 23:28:45'),
(7, '2324', 'rrrrrrrrrrrrrr', 23, 23, 1, '2023-08-12 18:01:44', '2023-08-12 18:01:44'),
(8, '12345', 'ewew', 12, 142, 3, '2023-08-12 18:02:56', '2023-08-12 18:02:56'),
(9, '12345', 'we', 34, 142, 4, '2023-08-12 18:02:56', '2023-08-12 18:02:56'),
(10, '2324', 'rrrrrrrrrrrrrr', 12, 142, 1, '2023-08-12 18:02:56', '2023-08-12 18:02:56');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `userId` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`userId`, `username`, `email`, `password`, `role`) VALUES
(2, 'mnitcr', 'mnitcr@gmail.com', '123', 'admin');

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
-- Table structure for table `user_manage`
--

CREATE TABLE `user_manage` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_manage`
--

INSERT INTO `user_manage` (`id`, `name`, `password`, `status`, `updated_at`, `created_at`) VALUES
(2, 'Mean', '233', 'InActive', '2023-08-11 19:37:42', '2023-08-10 13:19:59'),
(3, 'we', '23', 'sd', '2023-08-10 06:20:18', '2023-08-10 06:20:18'),
(9, 'dfd', 'dfd', 'df', '2023-08-10 06:38:37', '2023-08-10 06:38:37'),
(10, 'we', 'we', 'we', '2023-08-10 06:38:37', '2023-08-10 06:38:37'),
(11, 'we', 'we', 'Active', '2023-08-10 06:58:19', '2023-08-10 06:58:19'),
(12, 'wewe', 'wewe', 'InActive', '2023-08-10 06:58:19', '2023-08-10 06:58:19'),
(13, 'we', 'we', 'InActive', '2023-08-10 07:08:10', '2023-08-10 07:08:10'),
(14, 'we', 'we', 'InActive', '2023-08-10 07:08:10', '2023-08-10 07:08:10'),
(15, 'dfsdf', 'dsf', 'InActive', '2023-08-11 00:14:05', '2023-08-11 00:14:05'),
(16, 'sdf', 'df', 'Active', '2023-08-11 00:14:05', '2023-08-11 00:14:05');

-- --------------------------------------------------------

--
-- Structure for view `productlist`
--
DROP TABLE IF EXISTS `productlist`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `productlist`  AS SELECT `tblproduct`.`proid` AS `proid`, `tblproduct`.`barcode` AS `barcode`, `tblproduct`.`title` AS `protitle`, `tblproduct`.`qty` AS `qty`, `tblproduct`.`price` AS `price`, `tblproduct`.`qty`* `tblproduct`.`price` AS `amount`, `tblcategory`.`catid` AS `catid`, `tblcategory`.`title` AS `cattitle` FROM (`tblproduct` join `tblcategory`) WHERE `tblproduct`.`categoryid` = `tblcategory`.`catid``catid`  ;

-- --------------------------------------------------------

--
-- Structure for view `product_list`
--
DROP TABLE IF EXISTS `product_list`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `product_list`  AS SELECT `p`.`proid` AS `proid`, `p`.`barcode` AS `barcode`, `p`.`title` AS `protitle`, `p`.`qty` AS `qty`, `p`.`price` AS `price`, `p`.`qty`* `p`.`price` AS `amount`, `c`.`catid` AS `catid`, `c`.`title` AS `cattitle`, `p`.`created_at` AS `created_at`, `p`.`updated_at` AS `updated_at` FROM (`tblproduct` `p` join `tblcategory` `c` on(`p`.`categoryid` = `c`.`catid`))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`catid`);

--
-- Indexes for table `tblpo`
--
ALTER TABLE `tblpo`
  ADD PRIMARY KEY (`poid`);

--
-- Indexes for table `tblpodetail`
--
ALTER TABLE `tblpodetail`
  ADD PRIMARY KEY (`pdetail`);

--
-- Indexes for table `tblproduct`
--
ALTER TABLE `tblproduct`
  ADD PRIMARY KEY (`proid`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_manage`
--
ALTER TABLE `user_manage`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `catid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tblpo`
--
ALTER TABLE `tblpo`
  MODIFY `poid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tblpodetail`
--
ALTER TABLE `tblpodetail`
  MODIFY `pdetail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tblproduct`
--
ALTER TABLE `tblproduct`
  MODIFY `proid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `userId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_manage`
--
ALTER TABLE `user_manage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
