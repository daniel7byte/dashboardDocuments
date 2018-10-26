-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         5.7.19 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para dashboarddocuments
CREATE DATABASE IF NOT EXISTS `dashboarddocuments` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `dashboarddocuments`;

-- Volcando estructura para tabla dashboarddocuments.news
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` enum('Private','Public') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla dashboarddocuments.news: ~0 rows (aproximadamente)
DELETE FROM `news`;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
/*!40000 ALTER TABLE `news` ENABLE KEYS */;

-- Volcando estructura para tabla dashboarddocuments.storage
CREATE TABLE IF NOT EXISTS `storage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `description` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `file` text COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `priority` enum('Critical','High','Medium','Low') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Medium',
  `check` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('Private','Public') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla dashboarddocuments.storage: ~0 rows (aproximadamente)
DELETE FROM `storage`;
/*!40000 ALTER TABLE `storage` DISABLE KEYS */;
/*!40000 ALTER TABLE `storage` ENABLE KEYS */;

-- Volcando estructura para tabla dashboarddocuments.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nick` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `role` enum('ADMIN','USER','EDITOR') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'USER',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla dashboarddocuments.users: ~1 rows (aproximadamente)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `nick`, `password`, `full_name`, `role`) VALUES
	(1, 'daniel7byte', '$2y$12$K5/h4DbD4v7iYnjHRYpKCuXFX9hHRDz5texkgzfTeTNydKl3YnBYS', 'Jose Posso', 'ADMIN'),
	(2, 'enriqueposso', '$2y$12$K5/h4DbD4v7iYnjHRYpKCuXFX9hHRDz5texkgzfTeTNydKl3YnBYS', 'Jose Posso', 'ADMIN');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
