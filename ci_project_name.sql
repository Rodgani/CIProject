-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.5.10-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for appwfpppmp
DROP DATABASE IF EXISTS `appwfpppmp`;
CREATE DATABASE IF NOT EXISTS `appwfpppmp` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `appwfpppmp`;

-- Dumping structure for table appwfpppmp.form_function
DROP TABLE IF EXISTS `form_function`;
CREATE TABLE IF NOT EXISTS `form_function` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_function` varchar(50) NOT NULL DEFAULT '0',
  `code` varchar(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table appwfpppmp.form_function: ~3 rows (approximately)
/*!40000 ALTER TABLE `form_function` DISABLE KEYS */;
INSERT INTO `form_function` (`id`, `form_function`, `code`) VALUES
	(1, 'User', '1U'),
	(2, 'Profile', '1UP'),
	(3, 'Responsibility', '1UR');
/*!40000 ALTER TABLE `form_function` ENABLE KEYS */;

-- Dumping structure for table appwfpppmp.responsibility
DROP TABLE IF EXISTS `responsibility`;
CREATE TABLE IF NOT EXISTS `responsibility` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `responsibility_name` varchar(15) DEFAULT NULL,
  `responsibility_ff` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table appwfpppmp.responsibility: ~1 rows (approximately)
/*!40000 ALTER TABLE `responsibility` DISABLE KEYS */;
INSERT INTO `responsibility` (`id`, `responsibility_name`, `responsibility_ff`) VALUES
	(1, 'Super Admin', '1U,1UP,1UR,');
/*!40000 ALTER TABLE `responsibility` ENABLE KEYS */;

-- Dumping structure for table appwfpppmp.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iis_employee_number` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `responsibility` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`iis_employee_number`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table appwfpppmp.user: ~1 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `iis_employee_number`, `email`, `password`, `responsibility`) VALUES
	(6, '3399', 'rod.ganancial@gmail.com', '$2y$10$gylPe1niWbi8iMgDXq5iO.YJcd.ao4SxSv51OymLWAmJTCHh45Ptm', 1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
