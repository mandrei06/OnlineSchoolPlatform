-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.38-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for scoalaonline
CREATE DATABASE IF NOT EXISTS `scoalaonline` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `scoalaonline`;

-- Dumping structure for table scoalaonline.chat
CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `from` varchar(50) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int(11) DEFAULT NULL,
  `id_clasa` int(11) DEFAULT NULL,
  `id_curs` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;

-- Dumping data for table scoalaonline.chat: ~21 rows (approximately)
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
INSERT INTO `chat` (`id`, `message`, `from`, `created`, `id_user`, `id_clasa`, `id_curs`) VALUES
	(6, 'Da', 'Marincas Andreea', '2020-06-03 20:39:51', 2, 1, 1),
	(11, 'Hi', 'Marincas Andreea', '2020-06-03 21:08:47', 2, 1, 1),
	(12, 'Hi', 'Marincas Andreea', '2020-06-03 21:20:20', 2, 1, 1),
	(17, 'Hi', 'Marincas Andreea', '2020-06-03 21:23:29', 2, 1, 1),
	(18, 'Hi', 'Marincas Andreea', '2020-06-03 21:28:19', 2, 1, 1),
	(19, 'Hi', 'Marincas Andreea', '2020-06-03 22:09:32', 2, 1, 1),
	(61, 'Hello', 'Marincas Andreea', '2020-06-04 01:57:11', 2, 1, 1),
	(62, 'da', 'Marincas Andreea', '2020-06-04 01:58:23', 2, 1, 1),
	(63, 'Cand trebuie predata tema?', 'Marincas Andrei', '2020-06-04 02:27:03', 1, 0, 0),
	(64, 'Putem sa predam....', 'Marincas Andrei', '2020-06-04 02:27:41', 1, 0, 0),
	(65, 'dar', 'Marincas Andrei', '2020-06-04 02:40:02', 1, 0, 0),
	(66, 'trey', 'Marincas Andrei', '2020-06-04 03:11:57', 1, 0, 0),
	(67, '41231', 'Marincas Andrei', '2020-06-04 03:13:40', 1, 0, 0),
	(68, 'dsadas', 'Marincas Andrei', '2020-06-04 03:15:37', 1, 0, 0),
	(69, 'fsaf', 'Marincas Andrei', '2020-06-04 03:20:13', 1, 0, 0),
	(70, 'sada', 'Marincas Andrei', '2020-06-04 03:28:04', 1, 0, 0),
	(71, 'hi', 'Marincas Andrei', '2020-06-06 23:51:22', 1, 0, 0),
	(72, 'Merge?', 'Marincas Andrei', '2020-06-06 23:55:50', 1, 0, 0),
	(73, 'Ati reusit sa faceti tema 1?', 'Marincas Liviu', '2020-06-09 12:37:36', 33, 11, 15),
	(74, 'Buna ziua', 'Marincas Aurora', '2020-06-09 12:41:05', 31, 11, 15),
	(75, 'Da, am reusit', 'Marincas Aurora', '2020-06-09 12:54:21', 31, 11, 15),
	(76, 'Buna ziua! De ce am luat doar nota 5?', 'Pop Adrian', '2020-06-09 13:46:44', 34, 12, 16),
	(77, 'Buna ziua!', 'Macelaru Mara', '2020-06-09 13:49:29', 35, 12, 16);
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;

-- Dumping structure for table scoalaonline.clase
CREATE TABLE IF NOT EXISTS `clase` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nume` varchar(50) NOT NULL DEFAULT '0',
  `Id_Profesor` varchar(50) DEFAULT NULL,
  `Id_Materie` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table scoalaonline.clase: ~5 rows (approximately)
/*!40000 ALTER TABLE `clase` DISABLE KEYS */;
INSERT INTO `clase` (`Id`, `Nume`, `Id_Profesor`, `Id_Materie`) VALUES
	(1, '11A', '2', '1'),
	(9, 'X-E', '2', '14'),
	(10, '11A', '2', '14'),
	(11, 'Clasa XI', '33', '15'),
	(12, 'Clasa X', '35', '16'),
	(13, 'VIII', '37', '17');
/*!40000 ALTER TABLE `clase` ENABLE KEYS */;

-- Dumping structure for table scoalaonline.courses
CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nume` text NOT NULL,
  `Id_Profesor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Dumping data for table scoalaonline.courses: ~9 rows (approximately)
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` (`id`, `Nume`, `Id_Profesor`) VALUES
	(1, 'Romana', 2),
	(2, 'Engleza', NULL),
	(3, 'Matematica', NULL),
	(4, 'Franceza', NULL),
	(5, 'Geografie', NULL),
	(6, 'Chimie', NULL),
	(14, 'Astronomie', 2),
	(15, 'Informatica', 33),
	(16, 'SGBD', 35),
	(17, 'Calcul numeric', 37);
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;

-- Dumping structure for table scoalaonline.note
CREATE TABLE IF NOT EXISTS `note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_curs` int(11) DEFAULT NULL,
  `id_tema` int(11) NOT NULL,
  `nota` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table scoalaonline.note: ~9 rows (approximately)
/*!40000 ALTER TABLE `note` DISABLE KEYS */;
INSERT INTO `note` (`id`, `data`, `id_user`, `id_curs`, `id_tema`, `nota`) VALUES
	(1, '2020-12-23', 1, 1, 0, 10),
	(2, '2019-11-14', 2, 1, 0, 7),
	(3, '2020-05-17', 1, 2, 0, 4),
	(5, '2020-06-06', 1, 1, 1, 10),
	(6, '2020-06-06', 1, 1, 7, 10),
	(7, '2020-06-06', 1, 1, 1, 10),
	(8, '2020-06-06', 1, 1, 1, 12),
	(9, '2020-06-06', 1, 1, 1, 10),
	(10, '0000-00-00', 1, 14, 1, 9),
	(11, '2020-06-09', 31, 15, 10, 4),
	(12, '2020-06-09', 34, 16, 11, 5),
	(13, '2020-06-10', 36, 17, 12, 10);
/*!40000 ALTER TABLE `note` ENABLE KEYS */;

-- Dumping structure for table scoalaonline.pages
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nume_meniu` varchar(50) NOT NULL,
  `pagina` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table scoalaonline.pages: ~2 rows (approximately)
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` (`id`, `nume_meniu`, `pagina`) VALUES
	(1, 'Pagina principala studenti', '"student_main.php"'),
	(2, 'Pagina principala profesori', '"teacher_main.php"');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;

-- Dumping structure for table scoalaonline.repartizare
CREATE TABLE IF NOT EXISTS `repartizare` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_clasa` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Dumping data for table scoalaonline.repartizare: ~8 rows (approximately)
/*!40000 ALTER TABLE `repartizare` DISABLE KEYS */;
INSERT INTO `repartizare` (`id`, `id_user`, `id_clasa`) VALUES
	(1, 1, 1),
	(2, 2, 1),
	(7, 2, 9),
	(8, 1, 9),
	(9, 33, 11),
	(10, 31, 11),
	(11, 35, 12),
	(12, 34, 12),
	(13, 37, 13),
	(14, 36, 13);
/*!40000 ALTER TABLE `repartizare` ENABLE KEYS */;

-- Dumping structure for table scoalaonline.teme
CREATE TABLE IF NOT EXISTS `teme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_clasa` int(11) DEFAULT NULL,
  `id_curs` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `data_limita` date DEFAULT NULL,
  `nota` int(11) DEFAULT NULL,
  `status` text NOT NULL,
  `titlu` text NOT NULL,
  `descriere` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table scoalaonline.teme: ~5 rows (approximately)
/*!40000 ALTER TABLE `teme` DISABLE KEYS */;
INSERT INTO `teme` (`id`, `id_clasa`, `id_curs`, `data`, `data_limita`, `nota`, `status`, `titlu`, `descriere`) VALUES
	(1, 1, 1, '2020-05-17', '2020-06-17', NULL, 'done', 'TEMA1', 'Realizati un portofoliu despre ...'),
	(7, 1, 14, '2020-05-17', '2020-06-17', NULL, 'done', 'Tema 2', 'Realizati un poster pentru o conferinta stiintifica...'),
	(9, 1, 0, '2020-05-31', '2020-07-09', NULL, 'undone', 'Harap Alb', 'Rezumati â€žPovestea lui Harap-Albâ€ de Ion CreangÄƒ.'),
	(10, 11, 15, '2020-06-09', '2020-06-19', NULL, 'done', 'Problema543', 'Rezolvati problema 543 de pe pb-info si uploadati poza cu scorul.'),
	(11, 12, 16, '2020-06-09', '2020-06-26', NULL, 'done', 'Problema51PBinfo', 'Va rog sa uploadati o poza cu rezultatul dupa compilare'),
	(12, 13, 17, '2020-06-10', '2020-06-19', NULL, 'done', 'Problema5 PB INFO', 'Upload rezultat');
/*!40000 ALTER TABLE `teme` ENABLE KEYS */;

-- Dumping structure for table scoalaonline.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilizator` char(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `parola` char(50) NOT NULL,
  `tip_utilizator` char(50) NOT NULL,
  `redirect` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

-- Dumping data for table scoalaonline.users: ~11 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `utilizator`, `email`, `parola`, `tip_utilizator`, `redirect`) VALUES
	(1, 'andrei', 'andrei1@yahoo.com', 'mac', 'e', 'student_main.html'),
	(2, 'andreea', 'anam@yahoo.com', 'mar', 'p', 'teacher_main.html'),
	(3, 'andreea2406', 'marincasandreeamariana@yahoo.com', 'parola', 'e', 'student_main.html'),
	(27, 'marincas1', 'ultima@yahoo.com', 'marincas1', 'e', 'student_main.html'),
	(28, 'marincas1', 'ultima@yahoo.com', 'marincas1', 'e', 'student_main.html'),
	(29, 'Pop Ioan', 'popioan@yahoo.com', 'popioan', 'e', NULL),
	(30, 'alin', 'alin@yahoo.com', 'alin', 'e', NULL),
	(31, 'aurora', 'aurora@yahoo.com', 'aurora', 'e', 'student_main.html'),
	(33, 'liviu', 'liviu@yahoo.com', 'liviu', 'p', 'teacher_main.html'),
	(34, 'adrian', 'adrian@yahoo.com', 'adrian', 'e', 'student_main.html'),
	(35, 'mara', 'mara@yahoo.com', 'mara', 'p', 'teacher_main.html'),
	(36, 'marius', 'marius@yahoo.com', 'marius', 'e', 'student_main.html'),
	(37, 'ioana', 'ioana@yahoo.com', 'ioana', 'p', 'teacher_main.html');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table scoalaonline.users_courses
CREATE TABLE IF NOT EXISTS `users_courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_cours` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Dumping data for table scoalaonline.users_courses: ~9 rows (approximately)
/*!40000 ALTER TABLE `users_courses` DISABLE KEYS */;
INSERT INTO `users_courses` (`id`, `id_user`, `id_cours`) VALUES
	(1, 1, 1),
	(2, 1, 2),
	(3, 1, 3),
	(4, 27, 1),
	(5, 2, 1),
	(9, 2, 14),
	(10, 1, 14),
	(11, 33, 15),
	(12, 31, 15),
	(13, 35, 16),
	(14, 34, 16),
	(15, 37, 17),
	(16, 36, 17);
/*!40000 ALTER TABLE `users_courses` ENABLE KEYS */;

-- Dumping structure for table scoalaonline.user_data
CREATE TABLE IF NOT EXISTS `user_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `nume` char(50) NOT NULL,
  `prenume` char(50) NOT NULL,
  `judet` char(50) NOT NULL,
  `localitate` char(50) NOT NULL,
  `scoala` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- Dumping data for table scoalaonline.user_data: ~12 rows (approximately)
/*!40000 ALTER TABLE `user_data` DISABLE KEYS */;
INSERT INTO `user_data` (`id`, `id_user`, `nume`, `prenume`, `judet`, `localitate`, `scoala`) VALUES
	(1, 19, 'Nume', 'Prenume', '1', 'err', 'era'),
	(2, 19, 'Nume', 'Prenume', '1', 'err', 'era'),
	(3, 23, 'Marincas', 'Alin', '1', 'Murmur', 'Gimnaziala Miresu Mare'),
	(3, 23, 'Marincas', 'Alin', '1', 'Murmur', 'Gimnaziala Miresu Mare'),
	(7, 27, 'Marincas', 'Andrei', '28', 'Miresu Mare', 'K-12'),
	(9, 1, 'Marincas', 'Andrei', '4', 'Miresu-Mare1', 'cu clasele 1-8'),
	(10, 2, 'Marincas', 'Andreea', '3', 'Lalala', 'CNVL'),
	(11, 29, 'Pop', 'Ioan', '28', 'Baia Mare', 'Colegiul National Mihai Eminescu'),
	(12, 30, 'Pop', 'Alin', '28', 'Baia Mare', 'Colegiul National Mihai Eminescu'),
	(13, 31, 'Marincas', 'Aurora', '28', 'Baia Mare', 'Colegiul National Gheorghe Sincai'),
	(15, 33, 'Marincas', 'Liviu', '28', 'Baia Mare', 'Colegiul National Gheorghe Sincai'),
	(16, 34, 'Pop', 'Adrian', '28', 'Baia Mare', 'Colegiul National Vasile Lucaciu'),
	(17, 35, 'Macelaru', 'Mara', '28', 'Baia Mare', 'Colegiul National Vasile Lucaciu'),
	(18, 36, 'Pop', 'Marius', 'Maramures', 'Baia Mare', 'Colegiul National Gheorghe Sincai'),
	(19, 37, 'Pop', 'Ioana', 'Maramures', 'Baia Mare', 'Colegiul National Gheorghe Sincai');
/*!40000 ALTER TABLE `user_data` ENABLE KEYS */;

-- Dumping structure for table scoalaonline.user_homework
CREATE TABLE IF NOT EXISTS `user_homework` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tema` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `file` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table scoalaonline.user_homework: ~4 rows (approximately)
/*!40000 ALTER TABLE `user_homework` DISABLE KEYS */;
INSERT INTO `user_homework` (`id`, `id_tema`, `id_user`, `file`) VALUES
	(1, 1, 1, 'Pokeland_Screenshot_2020.04.24_17.59.49.jpg'),
	(2, 1, 1, 'Pokeland_Screenshot_2020.04.25_11.31.52.jpg'),
	(3, 10, 31, '1-go on neo4j.com and download.jpg'),
	(4, 11, 34, 'LiTV7p.png'),
	(5, 12, 36, 'LiTV7p.png');
/*!40000 ALTER TABLE `user_homework` ENABLE KEYS */;

-- Dumping structure for table scoalaonline.user_permissions
CREATE TABLE IF NOT EXISTS `user_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_page` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table scoalaonline.user_permissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `user_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_permissions` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
