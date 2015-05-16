# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.23)
# Database: dbsoal
# Generation Time: 2015-05-16 02:58:55 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table hasil
# ------------------------------------------------------------

DROP TABLE IF EXISTS `hasil`;

CREATE TABLE `hasil` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_soal` int(11) DEFAULT NULL,
  `jawaban` varchar(11) DEFAULT NULL,
  `tgl_jawab` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `hasil` WRITE;
/*!40000 ALTER TABLE `hasil` DISABLE KEYS */;

INSERT INTO `hasil` (`id`, `id_user`, `id_soal`, `jawaban`, `tgl_jawab`)
VALUES
	(7,30,1,'jawaban_a','2015-04-24 07:14:52'),
	(8,30,3,'jawaban_d','2015-04-24 07:14:52'),
	(9,30,6,'jawaban_b','2015-04-24 07:28:20'),
	(10,30,7,'jawaban_c','2015-04-24 07:28:20');

/*!40000 ALTER TABLE `hasil` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table kelas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `kelas`;

CREATE TABLE `kelas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `kelas` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `kelas` WRITE;
/*!40000 ALTER TABLE `kelas` DISABLE KEYS */;

INSERT INTO `kelas` (`id`, `kelas`)
VALUES
	(2,'Satu'),
	(3,'Dua');

/*!40000 ALTER TABLE `kelas` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table mapel
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mapel`;

CREATE TABLE `mapel` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mapel` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `mapel` WRITE;
/*!40000 ALTER TABLE `mapel` DISABLE KEYS */;

INSERT INTO `mapel` (`id`, `mapel`)
VALUES
	(2,'Sejarah'),
	(3,'Matematika'),
	(4,'Anu'),
	(5,'Biologi'),
	(6,'dasdasdasd'),
	(7,'dasdasfasfasfasf'),
	(8,'fasfasgagag');

/*!40000 ALTER TABLE `mapel` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table soal
# ------------------------------------------------------------

DROP TABLE IF EXISTS `soal`;

CREATE TABLE `soal` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `soal` varchar(50) DEFAULT NULL,
  `mapel_id` int(11) DEFAULT NULL,
  `kelas_id` int(11) DEFAULT NULL,
  `jawaban_a` varchar(50) DEFAULT NULL,
  `jawaban_b` varchar(50) DEFAULT NULL,
  `jawaban_c` varchar(50) DEFAULT NULL,
  `jawaban_d` varchar(50) DEFAULT NULL,
  `jawaban_benar` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `soal` WRITE;
/*!40000 ALTER TABLE `soal` DISABLE KEYS */;

INSERT INTO `soal` (`id`, `soal`, `mapel_id`, `kelas_id`, `jawaban_a`, `jawaban_b`, `jawaban_c`, `jawaban_d`, `jawaban_benar`)
VALUES
	(4,'Apakah 3',NULL,NULL,'anu','iya','ga','ah','b'),
	(5,'Apakah 4',NULL,NULL,'anu','iya','ga','ah','b'),
	(6,'Apakah 5',NULL,NULL,'anu','iya','ga','ah','b'),
	(7,'Apakah 6',NULL,NULL,'anu','iya','ga','ah','b'),
	(9,'matik',3,3,'dsdxxx','dsds','dsd','dsd','a'),
	(11,'soal sejarah',2,NULL,'fsdfsdf','fsdf','fsdf','fsdf',''),
	(12,'vcxvxcv',4,NULL,'vxcvxcv','vxcv','xcvxcv','vxcvxcv',''),
	(13,'dasdasd',5,2,'dasd','dasd','adsd','dasdasd','b');

/*!40000 ALTER TABLE `soal` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL DEFAULT '',
  `nama` varchar(25) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `kelamin` varchar(10) DEFAULT NULL,
  `level` int(1) NOT NULL,
  `kelas_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `username`, `nama`, `password`, `kelamin`, `level`, `kelas_id`)
VALUES
	(30,'qutek','lafif Astsah','491442df5f88c6aa018e86dac21d3606',NULL,1,NULL),
	(31,'anu','dasdasd','de022cab63f8457388abf2aa2fd3e96f',NULL,2,NULL),
	(33,'qutek1','qutek 1','491442df5f88c6aa018e86dac21d3606',NULL,1,NULL),
	(35,'siswa','siswa kelas 1','bcd724d15cde8c47650fda962968f102','Perempuan',3,3),
	(37,'sdadsad','dasdasd','0df01ae7dd51cec48fed56952f40842b',NULL,1,NULL);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
