-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.13-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table bayu.barang
CREATE TABLE IF NOT EXISTS `barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `jenis` varchar(15) NOT NULL,
  `price` int(11) NOT NULL,
  `user_create` int(11) NOT NULL,
  `date_create` datetime NOT NULL,
  `user_update` int(11) NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table bayu.barang: ~0 rows (approximately)
/*!40000 ALTER TABLE `barang` DISABLE KEYS */;
INSERT INTO `barang` (`id`, `code`, `name`, `jenis`, `price`, `user_create`, `date_create`, `user_update`, `date_update`) VALUES
	(1, '001', 'BARANG 1', '001', 10000, 16, '2016-07-26 20:03:52', 16, '2016-07-26 20:05:51'),
	(2, '002', 'BARANG 2', '002', 15000, 16, '2016-07-26 20:05:43', 0, '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `barang` ENABLE KEYS */;


-- Dumping structure for table bayu.barang_jenis
CREATE TABLE IF NOT EXISTS `barang_jenis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user_create` int(11) NOT NULL,
  `date_create` datetime NOT NULL,
  `user_update` int(11) NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table bayu.barang_jenis: ~2 rows (approximately)
/*!40000 ALTER TABLE `barang_jenis` DISABLE KEYS */;
INSERT INTO `barang_jenis` (`id`, `code`, `name`, `user_create`, `date_create`, `user_update`, `date_update`) VALUES
	(8, '001', 'JENIS 1', 16, '2016-07-26 20:00:18', 16, '2016-07-26 20:01:39'),
	(9, '002', 'JENIS 2', 16, '2016-07-26 20:01:24', 16, '2016-07-26 20:01:33');
/*!40000 ALTER TABLE `barang_jenis` ENABLE KEYS */;


-- Dumping structure for table bayu.permintaan_barang
CREATE TABLE IF NOT EXISTS `permintaan_barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `toko` varchar(15) NOT NULL,
  `status` varchar(15) NOT NULL,
  `user_create` int(11) NOT NULL,
  `date_create` datetime NOT NULL,
  `user_update` int(11) NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `code` (`nomor`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table bayu.permintaan_barang: ~3 rows (approximately)
/*!40000 ALTER TABLE `permintaan_barang` DISABLE KEYS */;
INSERT INTO `permintaan_barang` (`id`, `nomor`, `tanggal`, `toko`, `status`, `user_create`, `date_create`, `user_update`, `date_update`) VALUES
	(7, '001', '2016-07-26', '001', '2', 16, '2016-07-26 22:03:30', 16, '2016-07-26 23:35:05'),
	(8, '002', '2016-07-26', '002', '2', 17, '2016-07-26 22:56:03', 16, '2016-07-26 23:34:12'),
	(9, '003', '2016-07-26', '003', '1', 16, '2016-07-26 23:38:35', 0, '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `permintaan_barang` ENABLE KEYS */;


-- Dumping structure for table bayu.permintaan_barang_detail
CREATE TABLE IF NOT EXISTS `permintaan_barang_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) NOT NULL,
  `kode_barang` varchar(15) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` bigint(20) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `user_create` int(11) NOT NULL,
  `date_create` datetime NOT NULL,
  `user_update` int(11) NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table bayu.permintaan_barang_detail: ~4 rows (approximately)
/*!40000 ALTER TABLE `permintaan_barang_detail` DISABLE KEYS */;
INSERT INTO `permintaan_barang_detail` (`id`, `id_parent`, `kode_barang`, `jumlah`, `harga`, `keterangan`, `user_create`, `date_create`, `user_update`, `date_update`) VALUES
	(47, 7, '001', 45, 10000, 'Ket', 16, '2016-07-26 22:45:01', 0, '0000-00-00 00:00:00'),
	(48, 7, '002', 5, 15000, 'Dikit Aja', 16, '2016-07-26 22:45:01', 0, '0000-00-00 00:00:00'),
	(50, 8, '002', 2, 15000, '-', 17, '2016-07-26 23:33:18', 0, '0000-00-00 00:00:00'),
	(51, 9, '001', 7, 10000, 'asd', 16, '2016-07-26 23:38:35', 0, '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `permintaan_barang_detail` ENABLE KEYS */;


-- Dumping structure for table bayu.permintaan_barang_status
CREATE TABLE IF NOT EXISTS `permintaan_barang_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user_create` int(11) NOT NULL,
  `date_create` datetime NOT NULL,
  `user_update` int(11) NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table bayu.permintaan_barang_status: ~3 rows (approximately)
/*!40000 ALTER TABLE `permintaan_barang_status` DISABLE KEYS */;
INSERT INTO `permintaan_barang_status` (`id`, `code`, `name`, `user_create`, `date_create`, `user_update`, `date_update`) VALUES
	(10, '1', 'ON PROCESS', 16, '2016-07-26 22:40:48', 16, '2016-07-26 22:41:28'),
	(11, '2', 'APPROVE', 16, '2016-07-26 22:40:54', 16, '2016-07-26 22:41:55'),
	(12, '3', 'REJECT', 16, '2016-07-26 22:42:07', 0, '0000-00-00 00:00:00'),
	(13, '4', 'PENDING', 16, '2016-07-26 22:42:13', 0, '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `permintaan_barang_status` ENABLE KEYS */;


-- Dumping structure for table bayu.toko
CREATE TABLE IF NOT EXISTS `toko` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user_create` int(11) NOT NULL,
  `date_create` datetime NOT NULL,
  `user_update` int(11) NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table bayu.toko: ~2 rows (approximately)
/*!40000 ALTER TABLE `toko` DISABLE KEYS */;
INSERT INTO `toko` (`id`, `code`, `name`, `user_create`, `date_create`, `user_update`, `date_update`) VALUES
	(10, '001', 'CABANG BANDUNG', 16, '2016-07-26 22:11:14', 0, '0000-00-00 00:00:00'),
	(11, '002', 'CABANG SOLO', 16, '2016-07-26 22:11:21', 0, '0000-00-00 00:00:00'),
	(12, '003', 'CABANG SURABAYA', 16, '2016-07-26 22:11:29', 0, '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `toko` ENABLE KEYS */;


-- Dumping structure for table bayu.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(10) NOT NULL,
  `ip_login` varchar(50) NOT NULL,
  `date_login` datetime NOT NULL,
  `user_agent` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `user_create` int(11) NOT NULL,
  `date_create` datetime NOT NULL,
  `user_update` int(11) NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table bayu.user: ~2 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `code`, `name`, `username`, `password`, `level`, `ip_login`, `date_login`, `user_agent`, `status`, `user_create`, `date_create`, `user_update`, `date_update`) VALUES
	(16, '001', 'Adam Prasetia', 'damz', '202cb962ac59075b964b07152d234b70', '1', '::1', '2016-07-26 23:33:25', 'Windows 7(Google Chrome 51.0.2704.103)', '1', 12, '2016-07-26 19:06:33', 16, '2016-07-26 22:20:23'),
	(17, '002', 'Bayu', 'bayu', '202cb962ac59075b964b07152d234b70', '2', '::1', '2016-07-26 23:33:05', 'Windows 7(Google Chrome 51.0.2704.103)', '1', 16, '2016-07-26 22:55:19', 0, '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;


-- Dumping structure for table bayu.user_level
CREATE TABLE IF NOT EXISTS `user_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user_create` int(11) NOT NULL,
  `date_create` datetime NOT NULL,
  `user_update` int(11) NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table bayu.user_level: ~4 rows (approximately)
/*!40000 ALTER TABLE `user_level` DISABLE KEYS */;
INSERT INTO `user_level` (`id`, `code`, `name`, `user_create`, `date_create`, `user_update`, `date_update`) VALUES
	(3, '1', 'ADMIN', 12, '2016-07-26 19:05:02', 0, '0000-00-00 00:00:00'),
	(4, '2', 'ADMIN TOKO', 12, '2016-07-26 19:05:20', 0, '0000-00-00 00:00:00'),
	(5, '3', 'ADMIN PUSAT', 12, '2016-07-26 19:05:27', 0, '0000-00-00 00:00:00'),
	(6, '4', 'ADMIN PRODUKSI', 12, '2016-07-26 19:05:36', 0, '0000-00-00 00:00:00'),
	(7, '5', 'ADMIN GUDANG', 12, '2016-07-26 19:05:43', 0, '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `user_level` ENABLE KEYS */;


-- Dumping structure for table bayu.user_status
CREATE TABLE IF NOT EXISTS `user_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user_create` int(11) NOT NULL,
  `date_create` datetime NOT NULL,
  `user_update` int(11) NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table bayu.user_status: ~2 rows (approximately)
/*!40000 ALTER TABLE `user_status` DISABLE KEYS */;
INSERT INTO `user_status` (`id`, `code`, `name`, `user_create`, `date_create`, `user_update`, `date_update`) VALUES
	(3, '1', 'AKTIF', 12, '2016-07-26 19:06:08', 0, '0000-00-00 00:00:00'),
	(4, '2', 'TIDAK AKTIF', 12, '2016-07-26 19:06:15', 0, '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `user_status` ENABLE KEYS */;


-- Dumping structure for trigger bayu.permintaan_barang_after_delete
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `permintaan_barang_after_delete` AFTER DELETE ON `permintaan_barang` FOR EACH ROW BEGIN
	DELETE from permintaan_barang_detail where id_parent = OLD.id;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
