-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 26, 2015 at 09:25 PM
-- Server version: 5.5.38
-- PHP Version: 5.3.10-1ubuntu3.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbsoal`
--

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE IF NOT EXISTS `hasil` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `tryout` int(1) DEFAULT NULL,
  `id_soal` int(11) DEFAULT NULL,
  `jawaban` varchar(11) DEFAULT NULL,
  `tgl_jawab` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=268 ;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE IF NOT EXISTS `kelas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `kelas` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `kelas`) VALUES
(2, 'Satu'),
(3, 'Dua');

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE IF NOT EXISTS `mapel` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mapel` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`id`, `mapel`) VALUES
(13, 'matematika');

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE IF NOT EXISTS `soal` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=78 ;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id`, `soal`, `mapel_id`, `kelas_id`, `jawaban_a`, `jawaban_b`, `jawaban_c`, `jawaban_d`, `jawaban_benar`) VALUES
(16, '1+1=', 13, 2, '1', '2', '3', '4', 'b'),
(17, '1+2=', 13, 2, '1', '2', '3', '4', 'c'),
(18, '2x3', 13, 2, '2', '3', '4', '6', 'd'),
(19, 'satu=', 13, 2, '2', '1', '3', '4', 'b'),
(20, 'dua=', 13, 2, '9', '8', '7', '2', 'd'),
(21, 'tiga=', 13, 2, '3', '4', '5', '6', 'a'),
(22, '3+1', 13, 2, '7', '6', '4', '5', 'c'),
(23, 'lima', 13, 2, '4', '5', '6', '7', 'b'),
(24, 'enam', 13, 2, '5', '6', '7', '8', 'b'),
(25, '4+4', 13, 2, '9', '7', '8', '6', 'c'),
(26, '3-2', 13, 2, '1', '2', '3', '4', 'a'),
(27, '50-1', 13, 2, '47', '48', '49', '50', 'c'),
(28, '5-3', 13, 2, '1', '2', '3', '4', 'b'),
(29, '3x3', 13, 2, '8', '7', '6', '9', 'd'),
(30, '4+3', 13, 2, '6', '7', '8', '9', 'b'),
(31, '2+4', 13, 2, '6', '7', '8', '9', 'a'),
(32, '7-5', 13, 2, '3', '4', '5', '2', 'd'),
(33, '3+2', 13, 2, '5', '6', '7', '8', 'a'),
(34, '4-2', 13, 2, '1', '2', '3', '4', 'b'),
(35, 'tujuh', 13, 2, '4', '5', '6', '7', 'd'),
(36, '9-8', 13, 2, '1', '2', '3', '4', 'a'),
(37, '5x2', 13, 2, '10', '11', '12', '13', 'a'),
(38, '5+3', 13, 2, '8', '7', '6', '5', 'a'),
(39, '2+5', 13, 2, '5', '6', '7', '8', 'c'),
(40, '7+2', 13, 2, '6', '7', '8', '9', 'd'),
(41, '1+5', 13, 2, '4', '5', '6', '7', 'c'),
(42, '30-29', 13, 2, '1', '2', '3', '4', 'a'),
(43, '56-54', 13, 2, '1', '2', '3', '4', 'b'),
(44, '34-33', 13, 2, '1', '2', '3', '4', 'a'),
(45, '5-1', 13, 2, '3', '4', '7', '6', 'b'),
(46, '6-3', 13, 2, '2', '3', '4', '5', 'b'),
(47, '5x3', 13, 2, '11', '12', '14', '15', 'd'),
(48, '32-30', 13, 2, '1', '2', '3', '4', 'b'),
(49, '8-6', 13, 2, '2', '3', '4', '5', 'a'),
(50, '9-6', 13, 2, '4', '5', '3', '2', 'c'),
(51, '21-20', 13, 2, '1', '2', '3', '4', 'a'),
(52, '7-4', 13, 2, '4', '3', '2', '1', 'b'),
(53, '4-1', 13, 2, '2', '3', '4', '5', 'b'),
(54, '3x2', 13, 2, '8', '7', '6', '5', 'c'),
(55, '2-0', 13, 2, '1', '2', '3', '4', 'b'),
(56, '32-31', 13, 2, '1', '2', '3', '4', 'a'),
(57, '8-5', 13, 2, '1', '2', '3', '4', 'c'),
(58, '10-7', 13, 2, '1', '2', '3', '4', 'c'),
(59, '9-5', 13, 2, '1', '2', '3', '4', 'd'),
(60, '55-51', 13, 2, '1', '2', '3', '4', 'd'),
(61, '7-3', 13, 2, '1', '2', '3', '4', 'd'),
(62, '45-44', 13, 2, '1', '2', '3', '4', 'a'),
(63, '77-75', 13, 2, '1', '2', '3', '4', 'b'),
(64, '9-7', 13, 2, '1', '2', '3', '4', 'b'),
(65, '46-43', 13, 2, '1', '2', '3', '4', 'c'),
(66, '67-65', 13, 2, '1', '2', '3', '4', 'b'),
(67, '3+4', 13, 2, '6', '7', '8', '9', 'b'),
(68, '66-65', 13, 2, '1', '2', '3', '4', 'a'),
(69, '43-41', 13, 2, '1', '2', '3', '4', 'b'),
(70, '89-88', 13, 2, '1', '2', '3', '4', 'a'),
(71, '90-88', 13, 2, '1', '2', '3', '4', 'b'),
(72, '56-55', 13, 2, '1', '2', '3', '4', 'a'),
(73, '98-96', 13, 2, '1', '2', '3', '4', 'b'),
(74, '43-42', 13, 2, '1', '2', '3', '4', 'a'),
(75, '5-4', 13, 2, '1', '2', '3', '4', 'a'),
(76, '6-2', 13, 2, '1', '2', '3', '4', 'd'),
(77, '3-0', 13, 2, '1', '2', '3', '4', 'c');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL DEFAULT '',
  `nama` varchar(25) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `kelamin` varchar(10) DEFAULT NULL,
  `level` int(1) NOT NULL,
  `kelas_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `nama`, `password`, `kelamin`, `level`, `kelas_id`) VALUES
(30, 'qutek', 'lafif Astsah', '491442df5f88c6aa018e86dac21d3606', NULL, 1, 0),
(45, '1234', 'Siswa1', '81dc9bdb52d04dc20036dbd8313ed055', NULL, 3, 2),
(46, '1111', 'damz', 'b6d767d2f8ed5d21a44b0e5886680cb9', NULL, 3, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
