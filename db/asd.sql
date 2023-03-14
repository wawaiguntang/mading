-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table pesawaran.article
CREATE TABLE IF NOT EXISTS `article` (
  `articleCode` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  `content` longtext NOT NULL,
  `categoryCode` int(11) NOT NULL DEFAULT '0',
  `userCode` int(11) NOT NULL DEFAULT '0',
  `createAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL,
  PRIMARY KEY (`articleCode`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table pesawaran.article: ~1 rows (approximately)
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` (`articleCode`, `slug`, `title`, `image`, `content`, `categoryCode`, `userCode`, `createAt`, `updateAt`, `deleteAt`) VALUES
	(3, 'filter-the-elements-to-be-removed-24', 'Filter the Elements to be Removed', '54c2b520e183e83ef94d6dbd33b2c70f-6409e5726f09b.png', '<p>ad</p><h2 style="box-sizing: inherit; font-size: 32px; font-family: &quot;Segoe UI&quot;, Arial, sans-serif; font-weight: 400; margin: 10px 0px; color: rgb(0, 0, 0); letter-spacing: normal;">Filter the Elements to be Removed</h2><p style="box-sizing: inherit; margin-top: 1.2em; margin-bottom: 1.2em; font-size: 15px; color: rgb(0, 0, 0); font-family: Verdana, sans-serif;">The jQuery&nbsp;<code class="w3-codespan" style="box-sizing: inherit; font-family: Consolas, Menlo, &quot;courier new&quot;, monospace; font-size: 15.75px; color: crimson; background-color: rgba(222, 222, 222, 0.3); padding-left: 4px; padding-right: 4px;">remove()</code>&nbsp;method also accepts one parameter, which allows you to filter the elements to be removed.</p><p style="box-sizing: inherit; margin-top: 1.2em; margin-bottom: 1.2em; font-size: 15px; color: rgb(0, 0, 0); font-family: Verdana, sans-serif;">The parameter can be any of the jQuery selector syntaxes.</p><p style="box-sizing: inherit; margin-top: 1.2em; margin-bottom: 1.2em; font-size: 15px; color: rgb(0, 0, 0); font-family: Verdana, sans-serif;">The following example removes all&nbsp;<code class="w3-codespan" style="box-sizing: inherit; font-family: Consolas, Menlo, &quot;courier new&quot;, monospace; font-size: 15.75px; color: crimson; background-color: rgba(222, 222, 222, 0.3); padding-left: 4px; padding-right: 4px;">&lt;p&gt;</code>&nbsp;elements with&nbsp;<code class="w3-codespan" style="box-sizing: inherit; font-family: Consolas, Menlo, &quot;courier new&quot;, monospace; font-size: 15.75px; color: crimson; background-color: rgba(222, 222, 222, 0.3); padding-left: 4px; padding-right: 4px;">class="test"</code>:&nbsp;&nbsp;</p><p style="box-sizing: inherit; margin-top: 1.2em; margin-bottom: 1.2em; font-size: 15px; color: rgb(0, 0, 0); font-family: Verdana, sans-serif;"><br></p><h2 style="box-sizing: inherit; font-size: 32px; font-family: &quot;Segoe UI&quot;, Arial, sans-serif; font-weight: 400; margin: 10px 0px; color: rgb(0, 0, 0); letter-spacing: normal;">Filter the Elements to be Removed</h2><p style="box-sizing: inherit; margin-top: 1.2em; margin-bottom: 1.2em; font-size: 15px; color: rgb(0, 0, 0); font-family: Verdana, sans-serif;">The jQuery&nbsp;<code class="w3-codespan" style="box-sizing: inherit; font-family: Consolas, Menlo, &quot;courier new&quot;, monospace; font-size: 15.75px; color: crimson; background-color: rgba(222, 222, 222, 0.3); padding-left: 4px; padding-right: 4px;">remove()</code>&nbsp;method also accepts one parameter, which allows you to filter the elements to be removed.</p><p style="box-sizing: inherit; margin-top: 1.2em; margin-bottom: 1.2em; font-size: 15px; color: rgb(0, 0, 0); font-family: Verdana, sans-serif;">The parameter can be any of the jQuery selector syntaxes.</p><p style="box-sizing: inherit; margin-top: 1.2em; margin-bottom: 1.2em; font-size: 15px; color: rgb(0, 0, 0); font-family: Verdana, sans-serif;">The following example removes all&nbsp;<code class="w3-codespan" style="box-sizing: inherit; font-family: Consolas, Menlo, &quot;courier new&quot;, monospace; font-size: 15.75px; color: crimson; background-color: rgba(222, 222, 222, 0.3); padding-left: 4px; padding-right: 4px;">&lt;p&gt;</code>&nbsp;elements with&nbsp;<code class="w3-codespan" style="box-sizing: inherit; font-family: Consolas, Menlo, &quot;courier new&quot;, monospace; font-size: 15.75px; color: crimson; background-color: rgba(222, 222, 222, 0.3); padding-left: 4px; padding-right: 4px;">class="test"</code>:&nbsp;&nbsp;</p><p style="box-sizing: inherit; margin-top: 1.2em; margin-bottom: 1.2em; font-size: 15px; color: rgb(0, 0, 0); font-family: Verdana, sans-serif;"><br></p><h2 style="box-sizing: inherit; font-size: 32px; font-family: &quot;Segoe UI&quot;, Arial, sans-serif; font-weight: 400; margin: 10px 0px; color: rgb(0, 0, 0); letter-spacing: normal;">Filter the Elements to be Removed</h2><p style="box-sizing: inherit; margin-top: 1.2em; margin-bottom: 1.2em; font-size: 15px; color: rgb(0, 0, 0); font-family: Verdana, sans-serif;">The jQuery&nbsp;<code class="w3-codespan" style="box-sizing: inherit; font-family: Consolas, Menlo, &quot;courier new&quot;, monospace; font-size: 15.75px; color: crimson; background-color: rgba(222, 222, 222, 0.3); padding-left: 4px; padding-right: 4px;">remove()</code>&nbsp;method also accepts one parameter, which allows you to filter the elements to be removed.</p><p style="box-sizing: inherit; margin-top: 1.2em; margin-bottom: 1.2em; font-size: 15px; color: rgb(0, 0, 0); font-family: Verdana, sans-serif;">The parameter can be any of the jQuery selector syntaxes.</p><p style="box-sizing: inherit; margin-top: 1.2em; margin-bottom: 1.2em; font-size: 15px; color: rgb(0, 0, 0); font-family: Verdana, sans-serif;">The following example removes all&nbsp;<code class="w3-codespan" style="box-sizing: inherit; font-family: Consolas, Menlo, &quot;courier new&quot;, monospace; font-size: 15.75px; color: crimson; background-color: rgba(222, 222, 222, 0.3); padding-left: 4px; padding-right: 4px;">&lt;p&gt;</code>&nbsp;elements with&nbsp;<code class="w3-codespan" style="box-sizing: inherit; font-family: Consolas, Menlo, &quot;courier new&quot;, monospace; font-size: 15.75px; color: crimson; background-color: rgba(222, 222, 222, 0.3); padding-left: 4px; padding-right: 4px;">class="test"</code>:&nbsp;&nbsp;</p><p style="box-sizing: inherit; margin-top: 1.2em; margin-bottom: 1.2em; font-size: 15px; color: rgb(0, 0, 0); font-family: Verdana, sans-serif;"><br></p><h2 style="box-sizing: inherit; font-size: 32px; font-family: &quot;Segoe UI&quot;, Arial, sans-serif; font-weight: 400; margin: 10px 0px; color: rgb(0, 0, 0); letter-spacing: normal;">Filter the Elements to be Removed</h2><p style="box-sizing: inherit; margin-top: 1.2em; margin-bottom: 1.2em; font-size: 15px; color: rgb(0, 0, 0); font-family: Verdana, sans-serif;">The jQuery&nbsp;<code class="w3-codespan" style="box-sizing: inherit; font-family: Consolas, Menlo, &quot;courier new&quot;, monospace; font-size: 15.75px; color: crimson; background-color: rgba(222, 222, 222, 0.3); padding-left: 4px; padding-right: 4px;">remove()</code>&nbsp;method also accepts one parameter, which allows you to filter the elements to be removed.</p><p style="box-sizing: inherit; margin-top: 1.2em; margin-bottom: 1.2em; font-size: 15px; color: rgb(0, 0, 0); font-family: Verdana, sans-serif;">The parameter can be any of the jQuery selector syntaxes.</p><p style="box-sizing: inherit; margin-top: 1.2em; margin-bottom: 1.2em; font-size: 15px; color: rgb(0, 0, 0); font-family: Verdana, sans-serif;">The following example removes all&nbsp;<code class="w3-codespan" style="box-sizing: inherit; font-family: Consolas, Menlo, &quot;courier new&quot;, monospace; font-size: 15.75px; color: crimson; background-color: rgba(222, 222, 222, 0.3); padding-left: 4px; padding-right: 4px;">&lt;p&gt;</code>&nbsp;elements with&nbsp;<code class="w3-codespan" style="box-sizing: inherit; font-family: Consolas, Menlo, &quot;courier new&quot;, monospace; font-size: 15.75px; color: crimson; background-color: rgba(222, 222, 222, 0.3); padding-left: 4px; padding-right: 4px;">class="test"</code>:&nbsp;&nbsp;</p><p style="box-sizing: inherit; margin-top: 1.2em; margin-bottom: 1.2em; font-size: 15px; color: rgb(0, 0, 0); font-family: Verdana, sans-serif;"><br></p><h2 style="box-sizing: inherit; font-size: 32px; font-family: &quot;Segoe UI&quot;, Arial, sans-serif; font-weight: 400; margin: 10px 0px; color: rgb(0, 0, 0); letter-spacing: normal;">Filter the Elements to be Removed</h2><p style="box-sizing: inherit; margin-top: 1.2em; margin-bottom: 1.2em; font-size: 15px; color: rgb(0, 0, 0); font-family: Verdana, sans-serif;">The jQuery&nbsp;<code class="w3-codespan" style="box-sizing: inherit; font-family: Consolas, Menlo, &quot;courier new&quot;, monospace; font-size: 15.75px; color: crimson; background-color: rgba(222, 222, 222, 0.3); padding-left: 4px; padding-right: 4px;">remove()</code>&nbsp;method also accepts one parameter, which allows you to filter the elements to be removed.</p><p style="box-sizing: inherit; margin-top: 1.2em; margin-bottom: 1.2em; font-size: 15px; color: rgb(0, 0, 0); font-family: Verdana, sans-serif;">The parameter can be any of the jQuery selector syntaxes.</p><p style="box-sizing: inherit; margin-top: 1.2em; margin-bottom: 1.2em; font-size: 15px; color: rgb(0, 0, 0); font-family: Verdana, sans-serif;">The following example removes all&nbsp;<code class="w3-codespan" style="box-sizing: inherit; font-family: Consolas, Menlo, &quot;courier new&quot;, monospace; font-size: 15.75px; color: crimson; background-color: rgba(222, 222, 222, 0.3); padding-left: 4px; padding-right: 4px;">&lt;p&gt;</code>&nbsp;elements with&nbsp;<code class="w3-codespan" style="box-sizing: inherit; font-family: Consolas, Menlo, &quot;courier new&quot;, monospace; font-size: 15.75px; color: crimson; background-color: rgba(222, 222, 222, 0.3); padding-left: 4px; padding-right: 4px;">class="test"</code>:&nbsp;&nbsp;</p><p style="box-sizing: inherit; margin-top: 1.2em; margin-bottom: 1.2em; font-size: 15px; color: rgb(0, 0, 0); font-family: Verdana, sans-serif;"><img style="width: 505.818px;" src="http://localhost/pesawaran/assets/front/img/article/7b852575260155f78ac0d4a02023d1d7-6409e5577276d.png"></p><p style="box-sizing: inherit; margin-top: 1.2em; margin-bottom: 1.2em; font-size: 15px; color: rgb(0, 0, 0); font-family: Verdana, sans-serif;"><br></p><h2 style="box-sizing: inherit; font-size: 32px; font-family: &quot;Segoe UI&quot;, Arial, sans-serif; font-weight: 400; margin: 10px 0px; color: rgb(0, 0, 0); letter-spacing: normal;">Filter the Elements to be Removed</h2><p style="box-sizing: inherit; margin-top: 1.2em; margin-bottom: 1.2em; font-size: 15px; color: rgb(0, 0, 0); font-family: Verdana, sans-serif;">The jQuery&nbsp;<code class="w3-codespan" style="box-sizing: inherit; font-family: Consolas, Menlo, &quot;courier new&quot;, monospace; font-size: 15.75px; color: crimson; background-color: rgba(222, 222, 222, 0.3); padding-left: 4px; padding-right: 4px;">remove()</code>&nbsp;method also accepts one parameter, which allows you to filter the elements to be removed.</p><p style="box-sizing: inherit; margin-top: 1.2em; margin-bottom: 1.2em; font-size: 15px; color: rgb(0, 0, 0); font-family: Verdana, sans-serif;">The parameter can be any of the jQuery selector syntaxes.</p><p style="box-sizing: inherit; margin-top: 1.2em; margin-bottom: 1.2em; font-size: 15px; color: rgb(0, 0, 0); font-family: Verdana, sans-serif;">The following example removes all&nbsp;<code class="w3-codespan" style="box-sizing: inherit; font-family: Consolas, Menlo, &quot;courier new&quot;, monospace; font-size: 15.75px; color: crimson; background-color: rgba(222, 222, 222, 0.3); padding-left: 4px; padding-right: 4px;">&lt;p&gt;</code>&nbsp;elements with&nbsp;<code class="w3-codespan" style="box-sizing: inherit; font-family: Consolas, Menlo, &quot;courier new&quot;, monospace; font-size: 15.75px; color: crimson; background-color: rgba(222, 222, 222, 0.3); padding-left: 4px; padding-right: 4px;">class="test"</code>:&nbsp;&nbsp;</p><h2 style="box-sizing: inherit; font-size: 32px; font-family: &quot;Segoe UI&quot;, Arial, sans-serif; font-weight: 400; margin: 10px 0px; color: rgb(0, 0, 0); letter-spacing: normal;">Filter the Elements to be Removed</h2><p style="box-sizing: inherit; margin-top: 1.2em; margin-bottom: 1.2em; font-size: 15px; color: rgb(0, 0, 0); font-family: Verdana, sans-serif;">The jQuery&nbsp;<code class="w3-codespan" style="box-sizing: inherit; font-family: Consolas, Menlo, &quot;courier new&quot;, monospace; font-size: 15.75px; color: crimson; background-color: rgba(222, 222, 222, 0.3); padding-left: 4px; padding-right: 4px;">remove()</code>&nbsp;method also accepts one parameter, which allows you to filter the elements to be removed.</p><p style="box-sizing: inherit; margin-top: 1.2em; margin-bottom: 1.2em; font-size: 15px; color: rgb(0, 0, 0); font-family: Verdana, sans-serif;">The parameter can be any of the jQuery selector syntaxes.</p><p style="box-sizing: inherit; margin-top: 1.2em; margin-bottom: 1.2em; font-size: 15px; color: rgb(0, 0, 0); font-family: Verdana, sans-serif;">The following example removes all&nbsp;<code class="w3-codespan" style="box-sizing: inherit; font-family: Consolas, Menlo, &quot;courier new&quot;, monospace; font-size: 15.75px; color: crimson; background-color: rgba(222, 222, 222, 0.3); padding-left: 4px; padding-right: 4px;">&lt;p&gt;</code>&nbsp;elements with&nbsp;<code class="w3-codespan" style="box-sizing: inherit; font-family: Consolas, Menlo, &quot;courier new&quot;, monospace; font-size: 15.75px; color: crimson; background-color: rgba(222, 222, 222, 0.3); padding-left: 4px; padding-right: 4px;">class="test"</code>:&nbsp;&nbsp;</p><h2 style="box-sizing: inherit; font-size: 32px; font-family: &quot;Segoe UI&quot;, Arial, sans-serif; font-weight: 400; margin: 10px 0px; color: rgb(0, 0, 0); letter-spacing: normal;">Filter the Elements to be Removed</h2><p style="box-sizing: inherit; margin-top: 1.2em; margin-bottom: 1.2em; font-size: 15px; color: rgb(0, 0, 0); font-family: Verdana, sans-serif;">The jQuery&nbsp;<code class="w3-codespan" style="box-sizing: inherit; font-family: Consolas, Menlo, &quot;courier new&quot;, monospace; font-size: 15.75px; color: crimson; background-color: rgba(222, 222, 222, 0.3); padding-left: 4px; padding-right: 4px;">remove()</code>&nbsp;method also accepts one parameter, which allows you to filter the elements to be removed.</p><p style="box-sizing: inherit; margin-top: 1.2em; margin-bottom: 1.2em; font-size: 15px; color: rgb(0, 0, 0); font-family: Verdana, sans-serif;">The parameter can be any of the jQuery selector syntaxes.</p><p style="box-sizing: inherit; margin-top: 1.2em; margin-bottom: 1.2em; font-size: 15px; color: rgb(0, 0, 0); font-family: Verdana, sans-serif;">The following example removes all&nbsp;<code class="w3-codespan" style="box-sizing: inherit; font-family: Consolas, Menlo, &quot;courier new&quot;, monospace; font-size: 15.75px; color: crimson; background-color: rgba(222, 222, 222, 0.3); padding-left: 4px; padding-right: 4px;">&lt;p&gt;</code>&nbsp;elements with&nbsp;<code class="w3-codespan" style="box-sizing: inherit; font-family: Consolas, Menlo, &quot;courier new&quot;, monospace; font-size: 15.75px; color: crimson; background-color: rgba(222, 222, 222, 0.3); padding-left: 4px; padding-right: 4px;">class="test"</code>:&nbsp;&nbsp;</p><hr><h2 style="box-sizing: inherit; font-size: 32px; font-family: &quot;Segoe UI&quot;, Arial, sans-serif; font-weight: 400; margin: 10px 0px; color: rgb(0, 0, 0); letter-spacing: normal;">Filter the Elements to be Removed</h2><p style="box-sizing: inherit; margin-top: 1.2em; margin-bottom: 1.2em; font-size: 15px; color: rgb(0, 0, 0); font-family: Verdana, sans-serif;">The jQuery&nbsp;<code class="w3-codespan" style="box-sizing: inherit; font-family: Consolas, Menlo, &quot;courier new&quot;, monospace; font-size: 15.75px; color: crimson; background-color: rgba(222, 222, 222, 0.3); padding-left: 4px; padding-right: 4px;">remove()</code>&nbsp;method also accepts one parameter, which allows you to filter the elements to be removed.</p><p style="box-sizing: inherit; margin-top: 1.2em; margin-bottom: 1.2em; font-size: 15px; color: rgb(0, 0, 0); font-family: Verdana, sans-serif;">The parameter can be any of the jQuery selector syntaxes.</p><p style="box-sizing: inherit; margin-top: 1.2em; margin-bottom: 1.2em; font-size: 15px; color: rgb(0, 0, 0); font-family: Verdana, sans-serif;">The following example removes all&nbsp;<code class="w3-codespan" style="box-sizing: inherit; font-family: Consolas, Menlo, &quot;courier new&quot;, monospace; font-size: 15.75px; color: crimson; background-color: rgba(222, 222, 222, 0.3); padding-left: 4px; padding-right: 4px;">&lt;p&gt;</code>&nbsp;elements with&nbsp;<code class="w3-codespan" style="box-sizing: inherit; font-family: Consolas, Menlo, &quot;courier new&quot;, monospace; font-size: 15.75px; color: crimson; background-color: rgba(222, 222, 222, 0.3); padding-left: 4px; padding-right: 4px;">class="test"</code>:&nbsp;&nbsp;</p><hr><h2 style="box-sizing: inherit; font-size: 32px; font-family: &quot;Segoe UI&quot;, Arial, sans-serif; font-weight: 400; margin: 10px 0px; color: rgb(0, 0, 0); letter-spacing: normal;">Filter the Elements to be Removed</h2><p style="box-sizing: inherit; margin-top: 1.2em; margin-bottom: 1.2em; font-size: 15px; color: rgb(0, 0, 0); font-family: Verdana, sans-serif;">The jQuery&nbsp;<code class="w3-codespan" style="box-sizing: inherit; font-family: Consolas, Menlo, &quot;courier new&quot;, monospace; font-size: 15.75px; color: crimson; background-color: rgba(222, 222, 222, 0.3); padding-left: 4px; padding-right: 4px;">remove()</code>&nbsp;method also accepts one parameter, which allows you to filter the elements to be removed.</p><p style="box-sizing: inherit; margin-top: 1.2em; margin-bottom: 1.2em; font-size: 15px; color: rgb(0, 0, 0); font-family: Verdana, sans-serif;">The parameter can be any of the jQuery selector syntaxes.</p><p style="box-sizing: inherit; margin-top: 1.2em; margin-bottom: 1.2em; font-size: 15px; color: rgb(0, 0, 0); font-family: Verdana, sans-serif;">The following example removes all&nbsp;<code class="w3-codespan" style="box-sizing: inherit; font-family: Consolas, Menlo, &quot;courier new&quot;, monospace; font-size: 15.75px; color: crimson; background-color: rgba(222, 222, 222, 0.3); padding-left: 4px; padding-right: 4px;">&lt;p&gt;</code>&nbsp;elements with&nbsp;<code class="w3-codespan" style="box-sizing: inherit; font-family: Consolas, Menlo, &quot;courier new&quot;, monospace; font-size: 15.75px; color: crimson; background-color: rgba(222, 222, 222, 0.3); padding-left: 4px; padding-right: 4px;">class="test"</code>:&nbsp;&nbsp;</p>', 2, 1, '2023-03-09 20:56:02', NULL, NULL);
/*!40000 ALTER TABLE `article` ENABLE KEYS */;

-- Dumping structure for table pesawaran.article_tag
CREATE TABLE IF NOT EXISTS `article_tag` (
  `atCode` int(11) NOT NULL AUTO_INCREMENT,
  `articleCode` int(11) NOT NULL,
  `tagCode` int(11) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL,
  PRIMARY KEY (`atCode`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table pesawaran.article_tag: ~5 rows (approximately)
/*!40000 ALTER TABLE `article_tag` DISABLE KEYS */;
INSERT INTO `article_tag` (`atCode`, `articleCode`, `tagCode`, `createAt`, `updateAt`, `deleteAt`) VALUES
	(1, 1, 1, '2023-03-08 10:59:12', NULL, NULL),
	(2, 2, 2, '2023-03-09 19:43:46', NULL, NULL),
	(3, 2, 3, '2023-03-09 19:43:46', NULL, NULL),
	(4, 3, 2, '2023-03-09 20:56:02', NULL, NULL),
	(5, 3, 2, '2023-03-09 20:56:02', NULL, NULL);
/*!40000 ALTER TABLE `article_tag` ENABLE KEYS */;

-- Dumping structure for table pesawaran.category
CREATE TABLE IF NOT EXISTS `category` (
  `categoryCode` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL DEFAULT '',
  `createAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL,
  PRIMARY KEY (`categoryCode`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table pesawaran.category: ~1 rows (approximately)
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`categoryCode`, `category`, `createAt`, `updateAt`, `deleteAt`) VALUES
	(1, 'Berita', '2023-03-08 10:57:47', NULL, NULL),
	(2, 'Kegiatan', '2023-03-09 10:34:59', NULL, NULL);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Dumping structure for table pesawaran.document
CREATE TABLE IF NOT EXISTS `document` (
  `documentCode` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `slug` longtext NOT NULL,
  `documentParent` int(11) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL,
  PRIMARY KEY (`documentCode`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pesawaran.document: ~9 rows (approximately)
/*!40000 ALTER TABLE `document` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `document` ENABLE KEYS */;

-- Dumping structure for table pesawaran.module
CREATE TABLE IF NOT EXISTS `module` (
  `moduleCode` bigint(20) NOT NULL AUTO_INCREMENT,
  `module` varchar(100) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL,
  PRIMARY KEY (`moduleCode`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pesawaran.module: ~8 rows (approximately)
/*!40000 ALTER TABLE `module` DISABLE KEYS */;
INSERT INTO `module` (`moduleCode`, `module`, `createAt`, `updateAt`, `deleteAt`) VALUES
	(1, 'Dashboard', '2022-12-03 15:21:35', NULL, NULL),
	(2, 'Management User', '2022-12-03 15:21:35', NULL, NULL),
	(3, 'Service', '2023-03-02 17:07:15', NULL, NULL),
	(4, 'Document', '2023-03-08 20:06:38', NULL, NULL),
	(5, 'Contact', '2023-03-09 03:35:26', NULL, NULL),
	(6, 'Article', '2023-03-09 16:31:28', NULL, NULL),
	(7, 'Structure', '2023-03-09 22:29:45', NULL, NULL),
	(8, 'Profile Office', '2023-03-10 02:21:28', NULL, NULL),
	(9, 'Vision', '2023-03-10 03:22:10', NULL, NULL),
	(10, 'Home', '2023-03-10 04:53:36', NULL, NULL);
/*!40000 ALTER TABLE `module` ENABLE KEYS */;

-- Dumping structure for table pesawaran.permission
CREATE TABLE IF NOT EXISTS `permission` (
  `permissionCode` bigint(20) NOT NULL AUTO_INCREMENT,
  `permission` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL,
  `moduleCode` bigint(20) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL,
  PRIMARY KEY (`permissionCode`),
  KEY `moduleCode` (`moduleCode`),
  CONSTRAINT `permission_ibfk_1` FOREIGN KEY (`moduleCode`) REFERENCES `module` (`moduleCode`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pesawaran.permission: ~40 rows (approximately)
/*!40000 ALTER TABLE `permission` DISABLE KEYS */;
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
	(28, 'UCONTACT', 'Update contact', 5, '2023-03-09 03:35:26', NULL, NULL),
	(29, 'RARTICLE', 'See article', 6, '2023-03-09 16:31:28', NULL, NULL),
	(30, 'CARTICLE', 'Create article', 6, '2023-03-09 16:31:28', NULL, NULL),
	(31, 'UARTICLE', 'Update article', 6, '2023-03-09 16:31:28', NULL, NULL),
	(32, 'DARTICLE', 'Delete article', 6, '2023-03-09 16:31:28', NULL, NULL),
	(33, 'RSTRUCTURE', 'See structure', 7, '2023-03-09 22:29:45', NULL, NULL),
	(34, 'CSTRUCTURE', 'Create structure', 7, '2023-03-09 22:29:45', NULL, NULL),
	(35, 'USTRUCTURE', 'Update structure', 7, '2023-03-09 22:29:45', NULL, NULL),
	(36, 'DSTRUCTURE', 'Delete structure', 7, '2023-03-09 22:29:45', NULL, NULL),
	(37, 'RPO', 'See profile office', 8, '2023-03-10 02:21:28', NULL, NULL),
	(38, 'CPO', 'Create profile office', 8, '2023-03-10 02:21:28', NULL, NULL),
	(39, 'UPO', 'Update profile office', 8, '2023-03-10 02:21:28', NULL, NULL),
	(40, 'DPO', 'Delete profile office', 8, '2023-03-10 02:21:28', NULL, NULL),
	(41, 'RVISION', 'See vision', 9, '2023-03-10 03:22:10', NULL, NULL),
	(42, 'UVISION', 'Update vision', 9, '2023-03-10 03:22:10', NULL, NULL),
	(43, 'RHOME', 'See home', 10, '2023-03-10 04:53:36', NULL, NULL),
	(44, 'UHOME', 'Update home', 10, '2023-03-10 04:53:36', NULL, NULL);
/*!40000 ALTER TABLE `permission` ENABLE KEYS */;

-- Dumping structure for table pesawaran.profile_office
CREATE TABLE IF NOT EXISTS `profile_office` (
  `poCode` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `fb` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `ig` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `tw` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `yt` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `createAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL,
  PRIMARY KEY (`poCode`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table pesawaran.profile_office: ~0 rows (approximately)
/*!40000 ALTER TABLE `profile_office` DISABLE KEYS */;
INSERT INTO `profile_office` (`poCode`, `name`, `title`, `image`, `fb`, `ig`, `tw`, `yt`, `createAt`, `updateAt`, `deleteAt`) VALUES
	(1, 'Diki Rahmad Sandi', 'General Manager', 'default.png', 'd', 'd', 'd', 'd', '2023-03-09 19:31:29', '2023-03-10 02:38:29', NULL),
	(2, 'wawaiguntang', NULL, 'default.png', '-', '-', '-', '-', '2023-03-10 02:36:44', NULL, NULL),
	(3, 'kasir', 'sadsadsad', 'default.png', 'adasd', 'asdad', 'asdads', 'asdasd', '2023-03-10 02:37:46', NULL, NULL);
/*!40000 ALTER TABLE `profile_office` ENABLE KEYS */;

-- Dumping structure for table pesawaran.role
CREATE TABLE IF NOT EXISTS `role` (
  `roleCode` bigint(20) NOT NULL AUTO_INCREMENT,
  `role` varchar(100) NOT NULL,
  `status` enum('Static','Dynamic') NOT NULL,
  `createAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL,
  PRIMARY KEY (`roleCode`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pesawaran.role: ~1 rows (approximately)
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` (`roleCode`, `role`, `status`, `createAt`, `updateAt`, `deleteAt`) VALUES
	(1, 'Super Admin', 'Static', '2022-12-03 15:20:17', NULL, NULL),
	(2, 'Pejabat', 'Static', '2023-03-09 19:15:40', NULL, NULL);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;

-- Dumping structure for table pesawaran.role_permission
CREATE TABLE IF NOT EXISTS `role_permission` (
  `rpCode` bigint(20) NOT NULL AUTO_INCREMENT,
  `permissionCode` bigint(20) NOT NULL,
  `roleCode` bigint(20) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL,
  PRIMARY KEY (`rpCode`),
  KEY `permissionCode` (`permissionCode`),
  KEY `roleCode` (`roleCode`),
  CONSTRAINT `role_permission_ibfk_1` FOREIGN KEY (`permissionCode`) REFERENCES `permission` (`permissionCode`),
  CONSTRAINT `role_permission_ibfk_2` FOREIGN KEY (`roleCode`) REFERENCES `role` (`roleCode`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pesawaran.role_permission: ~40 rows (approximately)
/*!40000 ALTER TABLE `role_permission` DISABLE KEYS */;
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
	(30, 28, 1, '2023-03-09 03:35:26', NULL, NULL),
	(31, 29, 1, '2023-03-09 16:31:28', NULL, NULL),
	(32, 30, 1, '2023-03-09 16:31:28', NULL, NULL),
	(33, 31, 1, '2023-03-09 16:31:28', NULL, NULL),
	(34, 32, 1, '2023-03-09 16:31:28', NULL, NULL),
	(35, 33, 1, '2023-03-09 22:29:45', NULL, NULL),
	(36, 34, 1, '2023-03-09 22:29:45', NULL, NULL),
	(37, 35, 1, '2023-03-09 22:29:45', NULL, NULL),
	(38, 36, 1, '2023-03-09 22:29:45', NULL, NULL),
	(39, 37, 1, '2023-03-10 02:21:28', NULL, NULL),
	(40, 38, 1, '2023-03-10 02:21:28', NULL, NULL),
	(41, 39, 1, '2023-03-10 02:21:28', NULL, NULL),
	(42, 40, 1, '2023-03-10 02:21:28', NULL, NULL),
	(43, 41, 1, '2023-03-10 03:22:10', NULL, NULL),
	(44, 42, 1, '2023-03-10 03:22:10', NULL, NULL),
	(45, 43, 1, '2023-03-10 04:53:36', NULL, NULL),
	(46, 44, 1, '2023-03-10 04:53:36', NULL, NULL);
/*!40000 ALTER TABLE `role_permission` ENABLE KEYS */;

-- Dumping structure for table pesawaran.role_user
CREATE TABLE IF NOT EXISTS `role_user` (
  `ruCode` bigint(20) NOT NULL AUTO_INCREMENT,
  `userCode` bigint(20) NOT NULL,
  `roleCode` bigint(20) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL,
  PRIMARY KEY (`ruCode`),
  KEY `userCode` (`userCode`),
  KEY `roleCode` (`roleCode`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pesawaran.role_user: ~0 rows (approximately)
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` (`ruCode`, `userCode`, `roleCode`, `createAt`, `updateAt`, `deleteAt`) VALUES
	(1, 1, 1, '2022-12-03 15:27:19', NULL, NULL);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;

-- Dumping structure for table pesawaran.service
CREATE TABLE IF NOT EXISTS `service` (
  `serviceCode` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `createAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL,
  PRIMARY KEY (`serviceCode`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table pesawaran.service: ~3 rows (approximately)
/*!40000 ALTER TABLE `service` DISABLE KEYS */;
INSERT INTO `service` (`serviceCode`, `name`, `url`, `image`, `description`, `createAt`, `updateAt`, `deleteAt`) VALUES
	(1, 'JARINGAN DOKUMENTASI DAN INFORMASI HUKUM PESAWARAN', 'https://jdih.pesawarankab.go.id', 'jdih.png', 'JDIHN Ide membentuk Jaringan Dokumentasi dan Informasi Hukum Nasional (JDIHN), secara historis melekat erat dengan pembangunan hukum nasional dalam upaya mewujudkan supremasihukum.', '2023-03-02 17:20:06', NULL, NULL);
/*!40000 ALTER TABLE `service` ENABLE KEYS */;

-- Dumping structure for table pesawaran.structure
CREATE TABLE IF NOT EXISTS `structure` (
  `structureCode` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `structureParent` int(11) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL,
  PRIMARY KEY (`structureCode`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table pesawaran.structure: ~3 rows (approximately)
/*!40000 ALTER TABLE `structure` DISABLE KEYS */;
INSERT INTO `structure` (`structureCode`, `name`, `title`, `structureParent`, `createAt`, `updateAt`, `deleteAt`) VALUES
	(1, 'Diki Rahmad Sandi', 'Manager', 0, '2023-03-09 23:11:59', NULL, NULL),
	(2, 'wawai guntang', 'gg', 1, '2023-03-09 23:35:17', '2023-03-10 01:57:21', NULL),
	(3, 'Diki Rahmad Sandi', 'aaa', 1, '2023-03-10 01:19:14', NULL, NULL);
/*!40000 ALTER TABLE `structure` ENABLE KEYS */;

-- Dumping structure for table pesawaran.suggestion
CREATE TABLE IF NOT EXISTS `suggestion` (
  `suggestionCode` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `type` enum('Kritik','Saran','Masukan','Diskusi Hukum') NOT NULL,
  `content` longtext NOT NULL,
  `createAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL,
  PRIMARY KEY (`suggestionCode`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table pesawaran.suggestion: ~5 rows (approximately)
/*!40000 ALTER TABLE `suggestion` DISABLE KEYS */;
INSERT INTO `suggestion` (`suggestionCode`, `name`, `email`, `type`, `content`, `createAt`, `updateAt`, `deleteAt`) VALUES
	(1, 'wawaiguntang@gmail.com', 'su@mail.com', 'Kritik', 'hh', '2023-03-09 15:52:38', NULL, NULL),
	(2, 'Diki Rahmad Sandi', 'asdasddssa@asdasd.sfd', 'Kritik', 'asdsadasd', '2023-03-09 15:53:54', NULL, NULL),
	(3, 'Diki Rahmad Sandi', 'dikirahmadsandi@outlook.com', 'Kritik', 'asdasdsada', '2023-03-09 15:54:34', NULL, NULL),
	(4, 'Diki Rahmad Sandi', 'dikirahmadsandi@outlook.com', 'Diskusi Hukum', 'asdasdasdasd', '2023-03-09 16:01:52', NULL, NULL),
	(5, 'Diki Rahmad Sandi', 'dikirahmadsandi@outlook.com', 'Diskusi Hukum', 'asdasdasdasd', '2023-03-09 16:02:42', NULL, NULL);
/*!40000 ALTER TABLE `suggestion` ENABLE KEYS */;

-- Dumping structure for table pesawaran.tag
CREATE TABLE IF NOT EXISTS `tag` (
  `tagCode` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(255) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL,
  PRIMARY KEY (`tagCode`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table pesawaran.tag: ~3 rows (approximately)
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
INSERT INTO `tag` (`tagCode`, `tag`, `createAt`, `updateAt`, `deleteAt`) VALUES
	(1, 'Tes', '2023-03-08 10:59:06', NULL, NULL),
	(2, 'asdasd', '2023-03-09 19:43:46', NULL, NULL),
	(3, 'asdasdasd', '2023-03-09 19:43:46', NULL, NULL);
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;

-- Dumping structure for table pesawaran.user
CREATE TABLE IF NOT EXISTS `user` (
  `userCode` bigint(20) NOT NULL AUTO_INCREMENT,
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
  `createAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL,
  PRIMARY KEY (`userCode`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pesawaran.user: ~0 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`userCode`, `name`, `foto`, `email`, `password`, `isActive`, `status`, `fb`, `ig`, `tw`, `yt`, `createAt`, `updateAt`, `deleteAt`) VALUES
	(1, 'Admin', 'default.png', 'su@mail.com', '$2y$10$DFb6nCJuFaJnY1PNv2SxquyH475AcKrUv7aCpHirlmm71nw9Xw/fu', '1', 'Private', NULL, NULL, NULL, NULL, '2022-12-03 15:20:58', NULL, NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Dumping structure for table pesawaran.user_permission
CREATE TABLE IF NOT EXISTS `user_permission` (
  `upCode` bigint(20) NOT NULL AUTO_INCREMENT,
  `userCode` bigint(20) NOT NULL,
  `permissionCode` bigint(20) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL,
  PRIMARY KEY (`upCode`),
  KEY `userCode` (`userCode`),
  KEY `permissionCode` (`permissionCode`),
  CONSTRAINT `user_permission_ibfk_1` FOREIGN KEY (`userCode`) REFERENCES `user` (`userCode`),
  CONSTRAINT `user_permission_ibfk_2` FOREIGN KEY (`permissionCode`) REFERENCES `permission` (`permissionCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pesawaran.user_permission: ~0 rows (approximately)
/*!40000 ALTER TABLE `user_permission` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_permission` ENABLE KEYS */;

-- Dumping structure for table pesawaran.visitor
CREATE TABLE IF NOT EXISTS `visitor` (
  `ip` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `hits` int(11) NOT NULL,
  `online` varchar(255) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pesawaran.visitor: ~2 rows (approximately)
/*!40000 ALTER TABLE `visitor` DISABLE KEYS */;
INSERT INTO `visitor` (`ip`, `date`, `hits`, `online`, `time`) VALUES
	('::1', '2023-03-09', 29, '1678375787', '2023-03-09 21:28:56'),
	('::1', '2023-03-10', 275, '1678401021', '2023-03-10 01:29:40');
/*!40000 ALTER TABLE `visitor` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
