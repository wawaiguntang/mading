-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table starter.module
CREATE TABLE IF NOT EXISTS `module` (
  `moduleCode` bigint NOT NULL AUTO_INCREMENT,
  `module` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `createAt` datetime NOT NULL DEFAULT now(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL,
  PRIMARY KEY (`moduleCode`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table starter.module: ~0 rows (approximately)
INSERT INTO `module` (`moduleCode`, `module`, `createAt`, `updateAt`, `deleteAt`) VALUES
	(1, 'Dashboard', '2022-12-03 15:21:35', NULL, NULL),
	(2, 'Management User', '2022-12-03 15:21:35', NULL, NULL);

-- Dumping structure for table starter.permission
CREATE TABLE IF NOT EXISTS `permission` (
  `permissionCode` bigint NOT NULL AUTO_INCREMENT,
  `permission` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `moduleCode` bigint NOT NULL,
  `createAt` datetime NOT NULL DEFAULT now(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL,
  PRIMARY KEY (`permissionCode`),
  KEY `moduleCode` (`moduleCode`),
  CONSTRAINT `permission_ibfk_1` FOREIGN KEY (`moduleCode`) REFERENCES `module` (`moduleCode`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table starter.permission: ~18 rows (approximately)
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
	(18, 'DRP', 'Delete permission from role ', 2, '2022-12-03 15:21:35', NULL, NULL);

-- Dumping structure for table starter.role
CREATE TABLE IF NOT EXISTS `role` (
  `roleCode` bigint NOT NULL AUTO_INCREMENT,
  `role` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('Static','Dynamic') COLLATE utf8mb4_general_ci NOT NULL,
  `createAt` datetime NOT NULL DEFAULT now(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL,
  PRIMARY KEY (`roleCode`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table starter.role: ~1 rows (approximately)
INSERT INTO `role` (`roleCode`, `role`, `status`, `createAt`, `updateAt`, `deleteAt`) VALUES
	(1, 'Super Admin', 'Static', '2022-12-03 15:20:17', NULL, NULL);

-- Dumping structure for table starter.role_permission
CREATE TABLE IF NOT EXISTS `role_permission` (
  `rpCode` bigint NOT NULL AUTO_INCREMENT,
  `permissionCode` bigint NOT NULL,
  `roleCode` bigint NOT NULL,
  `createAt` datetime NOT NULL DEFAULT now(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL,
  PRIMARY KEY (`rpCode`),
  KEY `permissionCode` (`permissionCode`),
  KEY `roleCode` (`roleCode`),
  CONSTRAINT `role_permission_ibfk_1` FOREIGN KEY (`permissionCode`) REFERENCES `permission` (`permissionCode`),
  CONSTRAINT `role_permission_ibfk_2` FOREIGN KEY (`roleCode`) REFERENCES `role` (`roleCode`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table starter.role_permission: ~18 rows (approximately)
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
	(18, 18, 1, '2022-12-03 15:21:35', NULL, NULL);

-- Dumping structure for table starter.role_user
CREATE TABLE IF NOT EXISTS `role_user` (
  `ruCode` bigint NOT NULL AUTO_INCREMENT,
  `userCode` bigint NOT NULL,
  `roleCode` bigint NOT NULL,
  `createAt` datetime NOT NULL DEFAULT now(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL,
  PRIMARY KEY (`ruCode`),
  KEY `userCode` (`userCode`),
  KEY `roleCode` (`roleCode`),
  CONSTRAINT `role_user_ibfk_1` FOREIGN KEY (`userCode`) REFERENCES `user` (`userCode`),
  CONSTRAINT `role_user_ibfk_2` FOREIGN KEY (`roleCode`) REFERENCES `role` (`roleCode`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table starter.role_user: ~1 rows (approximately)
INSERT INTO `role_user` (`ruCode`, `userCode`, `roleCode`, `createAt`, `updateAt`, `deleteAt`) VALUES
	(1, 1, 1, '2022-12-03 15:27:19', NULL, NULL);

-- Dumping structure for table starter.user
CREATE TABLE IF NOT EXISTS `user` (
  `userCode` bigint NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `isActive` varchar(1) COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('Public','Private') COLLATE utf8mb4_general_ci NOT NULL,
  `createAt` datetime NOT NULL DEFAULT now(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL,
  PRIMARY KEY (`userCode`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table starter.user: ~1 rows (approximately)
INSERT INTO `user` (`userCode`, `email`, `password`, `isActive`, `status`, `createAt`, `updateAt`, `deleteAt`) VALUES
	(1, 'su@mail.com', '$2y$10$DFb6nCJuFaJnY1PNv2SxquyH475AcKrUv7aCpHirlmm71nw9Xw/fu', '1', 'Private', '2022-12-03 15:20:58', NULL, NULL);

-- Dumping structure for table starter.user_permission
CREATE TABLE IF NOT EXISTS `user_permission` (
  `upCode` bigint NOT NULL AUTO_INCREMENT,
  `userCode` bigint NOT NULL,
  `permissionCode` bigint NOT NULL,
  `createAt` datetime NOT NULL DEFAULT now(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL,
  PRIMARY KEY (`upCode`),
  KEY `userCode` (`userCode`),
  KEY `permissionCode` (`permissionCode`),
  CONSTRAINT `user_permission_ibfk_1` FOREIGN KEY (`userCode`) REFERENCES `user` (`userCode`),
  CONSTRAINT `user_permission_ibfk_2` FOREIGN KEY (`permissionCode`) REFERENCES `permission` (`permissionCode`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table starter.user_permission: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
