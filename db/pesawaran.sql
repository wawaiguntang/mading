-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2023 at 08:48 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pesawaran`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `articleCode` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  `content` longtext NOT NULL,
  `categoryCode` int(11) NOT NULL DEFAULT 0,
  `userCode` int(11) NOT NULL DEFAULT 0,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`articleCode`, `slug`, `title`, `image`, `content`, `categoryCode`, `userCode`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 'asd', 'asd', 'default.png', 'asdasdasd', 1, 1, '2023-03-08 10:58:51', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `article_tag`
--

CREATE TABLE `article_tag` (
  `atCode` int(11) NOT NULL,
  `articleCode` int(11) NOT NULL,
  `tagCode` int(11) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `article_tag`
--

INSERT INTO `article_tag` (`atCode`, `articleCode`, `tagCode`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 1, 1, '2023-03-08 10:59:12', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryCode` int(11) NOT NULL,
  `category` varchar(255) NOT NULL DEFAULT '',
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryCode`, `category`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 'Berita', '2023-03-08 10:57:47', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `documentCode` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `slug` longtext NOT NULL,
  `documentParent` int(11) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`documentCode`, `name`, `file`, `slug`, `documentParent`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 'PERDA', '-', 'perda', 0, '2023-03-08 03:32:19', NULL, NULL),
(2, 'Tahun 2023', '-', 'perda-tahun-2023', 1, '2023-03-08 03:32:49', NULL, NULL),
(3, 'Tahun 2022', 'perda-tahun-2022.pdf', 'perda-tahun-2022', 1, '2023-03-08 03:33:10', NULL, NULL),
(4, 'PERBUB', '-', 'perbub', 0, '2023-03-08 03:33:26', NULL, NULL),
(5, 'Tahun 2023', '-', 'perbub-tahun-2023', 4, '2023-03-08 03:32:49', NULL, NULL),
(6, 'Tahun 2022', '-', 'perbub-tahun-2023', 4, '2023-03-08 03:33:10', NULL, NULL),
(7, 'Diki Rahmad Sandi asd', 'fc09a946b88debbf41f14bbc75b8fd37-64089a778ac34.pdf', 'saasaaas vvvvvv', 4, '2023-03-08 20:58:16', '2023-03-08 21:23:51', '2023-03-08 21:26:47'),
(8, 'Diki Rahmad Sandi', '5d36d5c22c66200ba283ae575836b86a-6408986ddcddf.pdf', 'saasaa', 0, '2023-03-08 21:15:09', NULL, '2023-03-08 21:26:44'),
(9, 'Ini kegiatan tertutup', '7c1532d5e7ca10ddf052572832461307-640899a4d27f6.pdf', 'saasaa', 0, '2023-03-08 21:20:20', NULL, '2023-03-08 21:26:50');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `moduleCode` bigint(20) NOT NULL,
  `module` varchar(100) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`moduleCode`, `module`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 'Dashboard', '2022-12-03 15:21:35', NULL, NULL),
(2, 'Management User', '2022-12-03 15:21:35', NULL, NULL),
(3, 'Service', '2023-03-02 17:07:15', NULL, NULL),
(4, 'Document', '2023-03-08 20:06:38', NULL, NULL),
(5, 'Contact', '2023-03-09 03:35:26', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `permissionCode` bigint(20) NOT NULL,
  `permission` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL,
  `moduleCode` bigint(20) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`permissionCode`, `permission`, `description`, `moduleCode`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 'RDASH', 'See dashboard', 1, '2022-12-03 15:21:35', NULL, NULL),
(2, 'RU', 'See user ', 2, '2022-12-03 15:21:35', NULL, NULL),
(3, 'CU', 'Create user ', 2, '2022-12-03 15:21:35', NULL, NULL),
(4, 'UU', 'Update user ', 2, '2022-12-03 15:21:35', NULL, NULL),
(5, 'DU', 'Delete user ', 2, '2022-12-03 15:21:35', NULL, NULL),
(6, 'RR', 'See role ', 2, '2022-12-03 15:21:35', NULL, NULL),
(7, 'CR', 'Create role ', 2, '2022-12-03 15:21:35', NULL, NULL),
(8, 'UR', 'Update role ', 2, '2022-12-03 15:21:35', NULL, NULL),
(9, 'DR', 'Delete role ', 2, '2022-12-03 15:21:35', NULL, NULL),
(10, 'RRU', 'See role of user ', 2, '2022-12-03 15:21:35', NULL, NULL),
(11, 'CRU', 'Add role to user ', 2, '2022-12-03 15:21:35', NULL, NULL),
(12, 'DRU', 'Delete role from user ', 2, '2022-12-03 15:21:35', NULL, NULL),
(13, 'RUP', 'See special permission of user ', 2, '2022-12-03 15:21:35', NULL, NULL),
(14, 'CUP', 'Add special permission to user ', 2, '2022-12-03 15:21:35', NULL, NULL),
(15, 'DUP', 'Delete special permission from user ', 2, '2022-12-03 15:21:35', NULL, NULL),
(16, 'RRP', 'See permission of role ', 2, '2022-12-03 15:21:35', NULL, NULL),
(17, 'CRP', 'Add permission to role ', 2, '2022-12-03 15:21:35', NULL, NULL),
(18, 'DRP', 'Delete permission from role ', 2, '2022-12-03 15:21:35', NULL, NULL),
(19, 'RSERVICE', 'See service', 3, '2023-03-02 17:07:15', NULL, NULL),
(20, 'CSERVICE', 'Create service', 3, '2023-03-02 17:07:15', NULL, NULL),
(21, 'USERVICE', 'Update service', 3, '2023-03-02 17:07:15', NULL, NULL),
(22, 'DSERVICE', 'Delete service', 3, '2023-03-02 17:07:15', NULL, NULL),
(23, 'RDOCUMENT', 'See document', 4, '2023-03-08 20:06:38', NULL, NULL),
(24, 'CDOCUMENT', 'Create document', 4, '2023-03-08 20:06:38', NULL, NULL),
(25, 'UDOCUMENT', 'Update document', 4, '2023-03-08 20:06:38', NULL, NULL),
(26, 'DDOCUMENT', 'Delete document', 4, '2023-03-08 20:06:38', NULL, NULL),
(27, 'RCONTACT', 'See contact', 5, '2023-03-09 03:35:26', NULL, NULL),
(28, 'UCONTACT', 'Update contact', 5, '2023-03-09 03:35:26', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `roleCode` bigint(20) NOT NULL,
  `role` varchar(100) NOT NULL,
  `status` enum('Static','Dynamic') NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`roleCode`, `role`, `status`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 'Super Admin', 'Static', '2022-12-03 15:20:17', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--

CREATE TABLE `role_permission` (
  `rpCode` bigint(20) NOT NULL,
  `permissionCode` bigint(20) NOT NULL,
  `roleCode` bigint(20) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_permission`
--

INSERT INTO `role_permission` (`rpCode`, `permissionCode`, `roleCode`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 1, 1, '2022-12-03 15:21:35', NULL, NULL),
(2, 2, 1, '2022-12-03 15:21:35', NULL, NULL),
(3, 3, 1, '2022-12-03 15:21:35', NULL, NULL),
(4, 4, 1, '2022-12-03 15:21:35', NULL, NULL),
(5, 5, 1, '2022-12-03 15:21:35', NULL, NULL),
(6, 6, 1, '2022-12-03 15:21:35', NULL, NULL),
(7, 7, 1, '2022-12-03 15:21:35', NULL, NULL),
(8, 8, 1, '2022-12-03 15:21:35', NULL, NULL),
(9, 9, 1, '2022-12-03 15:21:35', NULL, NULL),
(10, 10, 1, '2022-12-03 15:21:35', NULL, NULL),
(11, 11, 1, '2022-12-03 15:21:35', NULL, NULL),
(12, 12, 1, '2022-12-03 15:21:35', NULL, NULL),
(13, 13, 1, '2022-12-03 15:21:35', NULL, NULL),
(14, 14, 1, '2022-12-03 15:21:35', NULL, NULL),
(15, 15, 1, '2022-12-03 15:21:35', NULL, NULL),
(16, 16, 1, '2022-12-03 15:21:35', NULL, NULL),
(17, 17, 1, '2022-12-03 15:21:35', NULL, NULL),
(18, 18, 1, '2022-12-03 15:21:35', NULL, NULL),
(21, 19, 1, '2023-03-02 17:07:15', NULL, NULL),
(22, 20, 1, '2023-03-02 17:07:15', NULL, NULL),
(23, 21, 1, '2023-03-02 17:07:15', NULL, NULL),
(24, 22, 1, '2023-03-02 17:07:15', NULL, NULL),
(25, 23, 1, '2023-03-08 20:06:38', NULL, NULL),
(26, 24, 1, '2023-03-08 20:06:38', NULL, NULL),
(27, 25, 1, '2023-03-08 20:06:38', NULL, NULL),
(28, 26, 1, '2023-03-08 20:06:38', NULL, NULL),
(29, 27, 1, '2023-03-09 03:35:26', NULL, NULL),
(30, 28, 1, '2023-03-09 03:35:26', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `ruCode` bigint(20) NOT NULL,
  `userCode` bigint(20) NOT NULL,
  `roleCode` bigint(20) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`ruCode`, `userCode`, `roleCode`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 1, 1, '2022-12-03 15:27:19', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `serviceCode` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`serviceCode`, `name`, `url`, `image`, `description`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 'JARINGAN DOKUMENTASI DAN INFORMASI HUKUM PESAWARAN', 'https://jdih.pesawarankab.go.id', 'jdih.png', 'JDIHN Ide membentuk Jaringan Dokumentasi dan Informasi Hukum Nasional (JDIHN), secara historis melekat erat dengan pembangunan hukum nasional dalam upaya mewujudkan supremasihukum.', '2023-03-02 17:20:06', NULL, NULL),
(2, 'Ini kegiatan tertutup111', 'https://www.banklampung.co.id/111', '2c9eea5ed65dda354352c20f2e209a4d-6408816f3cf5e.png', '111', '2023-03-08 19:37:03', '2023-03-08 19:41:55', '2023-03-08 19:43:34'),
(3, 'wawaiguntang@gmail.com', 'https://www.banklampung.co.id/', '6927bef2e82bc7f946af9b4481fda182-6408830a46db0.jpg', 'asdasdsadasdasd as as as sa   adasdasdasdads', '2023-03-08 19:43:54', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `suggestion`
--

CREATE TABLE `suggestion` (
  `suggestionCode` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `type` enum('Kritik','Saran','Masukan') NOT NULL,
  `content` longtext NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `tagCode` int(11) NOT NULL,
  `tag` varchar(255) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`tagCode`, `tag`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 'Tes', '2023-03-08 10:59:06', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userCode` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isActive` varchar(1) NOT NULL,
  `status` enum('Public','Private') NOT NULL,
  `fb` varchar(255) DEFAULT NULL,
  `ig` varchar(255) DEFAULT NULL,
  `tw` varchar(255) DEFAULT NULL,
  `yt` varchar(255) DEFAULT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userCode`, `name`, `foto`, `email`, `password`, `isActive`, `status`, `fb`, `ig`, `tw`, `yt`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 'Admin', 'default.png', 'su@mail.com', '$2y$10$DFb6nCJuFaJnY1PNv2SxquyH475AcKrUv7aCpHirlmm71nw9Xw/fu', '1', 'Private', NULL, NULL, NULL, NULL, '2022-12-03 15:20:58', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_permission`
--

CREATE TABLE `user_permission` (
  `upCode` bigint(20) NOT NULL,
  `userCode` bigint(20) NOT NULL,
  `permissionCode` bigint(20) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`articleCode`);

--
-- Indexes for table `article_tag`
--
ALTER TABLE `article_tag`
  ADD PRIMARY KEY (`atCode`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryCode`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`documentCode`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`moduleCode`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`permissionCode`),
  ADD KEY `moduleCode` (`moduleCode`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`roleCode`);

--
-- Indexes for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD PRIMARY KEY (`rpCode`),
  ADD KEY `permissionCode` (`permissionCode`),
  ADD KEY `roleCode` (`roleCode`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`ruCode`),
  ADD KEY `userCode` (`userCode`),
  ADD KEY `roleCode` (`roleCode`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`serviceCode`) USING BTREE;

--
-- Indexes for table `suggestion`
--
ALTER TABLE `suggestion`
  ADD PRIMARY KEY (`suggestionCode`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`tagCode`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userCode`);

--
-- Indexes for table `user_permission`
--
ALTER TABLE `user_permission`
  ADD PRIMARY KEY (`upCode`),
  ADD KEY `userCode` (`userCode`),
  ADD KEY `permissionCode` (`permissionCode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `articleCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `article_tag`
--
ALTER TABLE `article_tag`
  MODIFY `atCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `documentCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `moduleCode` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `permissionCode` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `roleCode` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role_permission`
--
ALTER TABLE `role_permission`
  MODIFY `rpCode` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `ruCode` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `serviceCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `suggestion`
--
ALTER TABLE `suggestion`
  MODIFY `suggestionCode` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `tagCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userCode` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_permission`
--
ALTER TABLE `user_permission`
  MODIFY `upCode` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission`
--
ALTER TABLE `permission`
  ADD CONSTRAINT `permission_ibfk_1` FOREIGN KEY (`moduleCode`) REFERENCES `module` (`moduleCode`);

--
-- Constraints for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD CONSTRAINT `role_permission_ibfk_1` FOREIGN KEY (`permissionCode`) REFERENCES `permission` (`permissionCode`),
  ADD CONSTRAINT `role_permission_ibfk_2` FOREIGN KEY (`roleCode`) REFERENCES `role` (`roleCode`);

--
-- Constraints for table `user_permission`
--
ALTER TABLE `user_permission`
  ADD CONSTRAINT `user_permission_ibfk_1` FOREIGN KEY (`userCode`) REFERENCES `user` (`userCode`),
  ADD CONSTRAINT `user_permission_ibfk_2` FOREIGN KEY (`permissionCode`) REFERENCES `permission` (`permissionCode`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
