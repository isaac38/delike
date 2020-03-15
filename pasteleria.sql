-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.10-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             10.3.0.5771
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for pasteleria
CREATE DATABASE IF NOT EXISTS `pasteleria` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `pasteleria`;

-- Dumping structure for table pasteleria.categoria
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) COLLATE utf8_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table pasteleria.categoria: ~5 rows (approximately)
DELETE FROM `categoria`;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` (`id`, `tipo`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Pasteles de boda', NULL, NULL, NULL),
	(2, 'Pasteles de cumpleaños', NULL, NULL, NULL),
	(3, 'Cupcakes', NULL, NULL, NULL),
	(4, 'Dulces', NULL, NULL, NULL);
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;

-- Dumping structure for table pasteleria.postres
CREATE TABLE IF NOT EXISTS `postres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo` int(11) NOT NULL,
  `nombre` varchar(150) COLLATE utf8_bin NOT NULL,
  `venta` double NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_bin NOT NULL,
  `cantidad` int(11) NOT NULL,
  `es_activo` tinyint(1) NOT NULL DEFAULT 1,
  `imagen` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT 'sin-foto.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_postres_categoria` (`id_tipo`),
  CONSTRAINT `FK_postres_categoria` FOREIGN KEY (`id_tipo`) REFERENCES `categoria` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table pasteleria.postres: ~9 rows (approximately)
DELETE FROM `postres`;
/*!40000 ALTER TABLE `postres` DISABLE KEYS */;
/*!40000 ALTER TABLE `postres` ENABLE KEYS */;

-- Dumping structure for table pasteleria.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomusuario` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `user_psw` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `isadmin` tinyint(1) NOT NULL DEFAULT 0,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table pasteleria.usuarios: ~21 rows (approximately)
DELETE FROM `usuarios`;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
