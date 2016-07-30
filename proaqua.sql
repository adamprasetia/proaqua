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

-- Dumping structure for table proaqua.produksi_barang
CREATE TABLE IF NOT EXISTS `produksi_barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `user_create` int(11) NOT NULL,
  `date_create` datetime NOT NULL,
  `user_update` int(11) NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `code` (`nomor`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table proaqua.produksi_barang: ~0 rows (approximately)
/*!40000 ALTER TABLE `produksi_barang` DISABLE KEYS */;
INSERT INTO `produksi_barang` (`id`, `nomor`, `tanggal`, `user_create`, `date_create`, `user_update`, `date_update`) VALUES
	(10, '001', '2016-07-30', 16, '2016-07-30 09:11:02', 0, '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `produksi_barang` ENABLE KEYS */;


-- Dumping structure for table proaqua.produksi_barang_detail
CREATE TABLE IF NOT EXISTS `produksi_barang_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) NOT NULL,
  `kode_barang` varchar(15) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `user_create` int(11) NOT NULL,
  `date_create` datetime NOT NULL,
  `user_update` int(11) NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table proaqua.produksi_barang_detail: ~0 rows (approximately)
/*!40000 ALTER TABLE `produksi_barang_detail` DISABLE KEYS */;
INSERT INTO `produksi_barang_detail` (`id`, `id_parent`, `kode_barang`, `jumlah`, `keterangan`, `user_create`, `date_create`, `user_update`, `date_update`) VALUES
	(54, 10, '001', 1000, 'asd', 16, '2016-07-30 09:11:02', 0, '0000-00-00 00:00:00'),
	(55, 10, '002', 2000, 'asdasd', 16, '2016-07-30 09:11:02', 0, '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `produksi_barang_detail` ENABLE KEYS */;


-- Dumping structure for trigger proaqua.produksi_barang_after_delete
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `produksi_barang_after_delete` AFTER DELETE ON `produksi_barang` FOR EACH ROW BEGIN
	DELETE from produksi_barang_detail where id_parent = OLD.id;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
