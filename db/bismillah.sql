-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 29, 2014 at 10:09 
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bismillah`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_android`
--

CREATE TABLE IF NOT EXISTS `admin_android` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(45) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `encrypted_password` varchar(45) DEFAULT NULL,
  `salt` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin_android`
--

INSERT INTO `admin_android` (`uid`, `unique_id`, `name`, `email`, `encrypted_password`, `salt`, `created_at`, `updated_at`) VALUES
(1, '53e31c4015f9c4.50716438', 'admin', 'admin', 'mmXa9jeLYv/eTz1feJP5f4UIFbAxYTQwYjYyZGFl', '1a40b62dae', '2014-08-07 14:26:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_web`
--

CREATE TABLE IF NOT EXISTS `admin_web` (
  `id_member` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `tgl_update` datetime DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_member`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `admin_web`
--

INSERT INTO `admin_web` (`id_member`, `id_user`, `name`, `tgl_update`, `email`, `username`, `password`) VALUES
(1, 1, 'Herwindra', '2014-08-28 02:08:32', 'admin@ptsi.com', 'admin', 'admin'),
(2, 1, 'Farah Devi', '2014-08-28 15:08:39', 'farah@ptsi.com', 'farah', 'farah'),
(3, 1, 'Suryo Aji', '2014-08-28 15:08:56', 'suryo@gmail.com', 'suryo', 'suryo');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE IF NOT EXISTS `driver` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(45) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `lat` float(10,6) DEFAULT NULL,
  `lng` float(10,6) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `encrypted_password` varchar(45) DEFAULT NULL,
  `salt` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`uid`, `unique_id`, `name`, `lat`, `lng`, `email`, `encrypted_password`, `salt`, `created_at`, `updated_at`) VALUES
(3, '53e31c4015f9c4.50716438', 'joko', NULL, NULL, 'joko', 'mmXa9jeLYv/eTz1feJP5f4UIFbAxYTQwYjYyZGFl', '1a40b62dae', '2014-08-07 14:26:48', NULL),
(4, '', 'as', 0.000000, 0.000000, 'as', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sidebar`
--

CREATE TABLE IF NOT EXISTS `sidebar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(45) DEFAULT NULL,
  `link` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `sidebar`
--

INSERT INTO `sidebar` (`id`, `nama`, `link`) VALUES
(1, 'sidebar', 'admin.php?page=admin/view/sidebar'),
(2, 'backup', 'admin.php?page=admin/view/backup'),
(3, 'admin', 'admin.php?page=admin/view/admin'),
(4, 'status', 'admin.php?page=admin/view/status'),
(5, 'location', 'admin.php?page=admin/view/location'),
(6, 'toko', 'admin.php?page=admin/view/toko'),
(7, 'driver', 'admin.php?page=admin/view/driver');

-- --------------------------------------------------------

--
-- Table structure for table `spj`
--

CREATE TABLE IF NOT EXISTS `spj` (
  `id_spj` int(11) NOT NULL AUTO_INCREMENT,
  `no_spj` int(11) DEFAULT NULL,
  `toko_uid` int(11) NOT NULL,
  `driver_uid` int(11) NOT NULL,
  `img` longtext,
  `status_id_status` int(11) NOT NULL,
  `waktu` datetime DEFAULT NULL,
  PRIMARY KEY (`id_spj`),
  KEY `fk_spj_driver` (`driver_uid`),
  KEY `fk_spj_toko1` (`toko_uid`),
  KEY `fk_spj_status1` (`status_id_status`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `spj`
--

INSERT INTO `spj` (`id_spj`, `no_spj`, `toko_uid`, `driver_uid`, `img`, `status_id_status`, `waktu`) VALUES
(5, 1234567890, 1, 3, 'img/img_product/qrcode.png', 2, '2014-08-28 02:43:36'),
(26, 2147483647, 1, 3, 'img/img_product/qrcode.png', 2, '2014-08-28 11:36:31');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id_status` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id_status`, `status_name`) VALUES
(1, 'belum'),
(2, 'sudah');

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE IF NOT EXISTS `toko` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `lat` float(10,6) DEFAULT NULL,
  `lng` float(10,6) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `encrypted_password` varchar(45) DEFAULT NULL,
  `salt` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`uid`, `unique_id`, `name`, `address`, `lat`, `lng`, `email`, `encrypted_password`, `salt`, `created_at`, `updated_at`) VALUES
(1, '', 'Kampusss', 'Sukolilo, East Java, Indonesia', -7.176334, 112.655067, 'asas', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, '', 'geek', 'Jalan Raya Mantup, Lamongan, East Java 62282, Indonesia', -7.231699, 112.400436, 'hua', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, '', 'errr', 'Sukolilo, East Java, Indonesia', -7.176203, 112.650734, 'hemm', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, '', 'saq', 'asaAaa', 0.000000, 0.000000, 'asa', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, '', 'UD harapan', 'Sidoarjo, East Java, Indonesia', -7.458016, 112.750969, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `spj`
--
ALTER TABLE `spj`
  ADD CONSTRAINT `fk_spj_driver` FOREIGN KEY (`driver_uid`) REFERENCES `driver` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_spj_status1` FOREIGN KEY (`status_id_status`) REFERENCES `status` (`id_status`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_spj_toko1` FOREIGN KEY (`toko_uid`) REFERENCES `toko` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
