-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.30-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5174
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for ta
DROP DATABASE IF EXISTS `ta`;
CREATE DATABASE IF NOT EXISTS `ta` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ta`;

-- Dumping structure for table ta.admins
DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(80) DEFAULT NULL,
  `password` text,
  `nama` varchar(100) DEFAULT NULL,
  `telp` varchar(25) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `level` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Dumping data for table ta.admins: ~8 rows (approximately)
DELETE FROM `admins`;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` (`id`, `username`, `password`, `nama`, `telp`, `email`, `level`) VALUES
	(10, 'devasatrio', '$2y$10$7d6KjJtH/GfK.45S1R9JAefDZgcCF3CW0DiW68a4FoTjiyGM/yUBS', 'deva satrio damara', '023934820948', 'satriosuklun@gmail.com', 'programer'),
	(11, 'diansetiawan', '$2y$10$CpKmLECL3v8nVnL37Tb20ugH8QMjugXapUyuTpEhuXxziVvqddiWm', 'dian ade setiawan', '085623497800', 'dianade@gmail.com', 'programer'),
	(12, 'adminsatu', '$2y$10$./4I24ToWf90yexH24nNr.C.hUtaTewshvVENi9d8bvHYxxNY/rsq', 'admin ke satu', '+6285816900612', 'admin1@gmail.com', 'admin'),
	(13, 'abiihsan', '$2y$10$HtZx6PUklxwaaFntiHqV5.4BZiXNEXdF1eA/J.ce701M5Thi7RLki', 'abi ihsan fadli', '2093482903480', 'abi@gmail.com', 'programer'),
	(14, 'taufiqperdana', '$2y$10$734GwOfWOeNB6gdtZqR7ZutUB8FzjPaupBypdRsFjypj3RFnQMKFa', 'M. taufiq perdana', '023984290380', 'taufiq@gmail.com', 'programer'),
	(15, 'admindua', '$2y$10$0/s.qgxDCDscTqNc42wdseaI.CaHYuv4z2gqYkG7xMLRxPTO.KVt6', 'admin ke dua', '20348239048902', 'admin@gmail.com', 'admin'),
	(16, 'ownerstteam', '$2y$10$vJTnhlwQ9r2KbPeS4zp0Y.BBBg0Ovqj6vdqxT5m7DCvNqarGSFWfq', 'owner tastore', '085856044060', 'owner@gmail.com', 'super_admin'),
	(17, 'admin2lagi', '$2y$10$YtYyE6TpxSHedx0d6v4Z8edQdptFEy/kyNXyK9JvNpqXorODx9xPK', 'admin 2', '085765427837', 'admin2lagi@gmail.com', 'admin');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;

-- Dumping structure for table ta.detail_cancel
DROP TABLE IF EXISTS `detail_cancel`;
CREATE TABLE IF NOT EXISTS `detail_cancel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idwarna` int(11) DEFAULT NULL,
  `iduser` int(11) DEFAULT NULL,
  `kode` text,
  `tgl` date DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `barang` varchar(100) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `diskon` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ta.detail_cancel: ~0 rows (approximately)
DELETE FROM `detail_cancel`;
/*!40000 ALTER TABLE `detail_cancel` DISABLE KEYS */;
/*!40000 ALTER TABLE `detail_cancel` ENABLE KEYS */;

-- Dumping structure for table ta.gambar
DROP TABLE IF EXISTS `gambar`;
CREATE TABLE IF NOT EXISTS `gambar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(30) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=240 DEFAULT CHARSET=latin1;

-- Dumping data for table ta.gambar: ~12 rows (approximately)
DELETE FROM `gambar`;
/*!40000 ALTER TABLE `gambar` DISABLE KEYS */;
INSERT INTO `gambar` (`id`, `kode_barang`, `nama`) VALUES
	(228, 'BRG00001', '1553991718-kaos5.jpg'),
	(229, 'BRG00001', '1553991718-kaos4.jpg'),
	(230, 'BRG00002', '1553992032-kaos1.jpeg'),
	(231, 'BRG00002', '1553992032-kaos2.jpg'),
	(232, 'BRG00005', '1554261382-kaos1.jpeg'),
	(233, 'BRG00005', '1554261383-kaos2.jpg'),
	(234, 'BRG00006', '1554263704-55927941_487524928449595_6118583772494430208_n.jpg'),
	(235, 'BRG00006', '1554263705-56242724_487524988449589_3064092396963758080_n.jpg'),
	(236, 'BRG00007', '1554264866-55832974_487525371782884_9198062232666112000_n.jpg'),
	(237, 'BRG00007', '1554264866-55927941_487524928449595_6118583772494430208_n.jpg'),
	(238, 'BRG00007', '1554264867-56242724_487524988449589_3064092396963758080_n.jpg'),
	(239, 'BRG00007', '1554264868-56248030_487524955116259_4391631316022460416_n.jpg');
/*!40000 ALTER TABLE `gambar` ENABLE KEYS */;

-- Dumping structure for table ta.keranjang_cancel
DROP TABLE IF EXISTS `keranjang_cancel`;
CREATE TABLE IF NOT EXISTS `keranjang_cancel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl` date DEFAULT NULL,
  `idbarang` int(11) NOT NULL DEFAULT '0',
  `jumlah` int(11) NOT NULL DEFAULT '0',
  `harga` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `admin` int(11) DEFAULT NULL,
  `status` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table ta.keranjang_cancel: ~2 rows (approximately)
DELETE FROM `keranjang_cancel`;
/*!40000 ALTER TABLE `keranjang_cancel` DISABLE KEYS */;
INSERT INTO `keranjang_cancel` (`id`, `tgl`, `idbarang`, `jumlah`, `harga`, `total`, `admin`, `status`) VALUES
	(1, '2019-02-04', 287, 1, 30000, 30000, NULL, 'Y'),
	(2, '2019-02-04', 287, 3, 30000, 90000, 10, 'Y');
/*!40000 ALTER TABLE `keranjang_cancel` ENABLE KEYS */;

-- Dumping structure for table ta.log_cancel
DROP TABLE IF EXISTS `log_cancel`;
CREATE TABLE IF NOT EXISTS `log_cancel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `faktur` varchar(300) DEFAULT NULL,
  `total_akhir` int(11) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `bulan` int(5) DEFAULT NULL,
  `status` enum('dicancel','ditolak') DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `keterangan` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ta.log_cancel: ~0 rows (approximately)
DELETE FROM `log_cancel`;
/*!40000 ALTER TABLE `log_cancel` DISABLE KEYS */;
/*!40000 ALTER TABLE `log_cancel` ENABLE KEYS */;

-- Dumping structure for table ta.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ta.migrations: ~0 rows (approximately)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table ta.omset
DROP TABLE IF EXISTS `omset`;
CREATE TABLE IF NOT EXISTS `omset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pemasukan_online` int(11) DEFAULT '0',
  `pemasukan_offline` int(11) DEFAULT '0',
  `pemasukan_lain` int(11) DEFAULT '0',
  `pengeluaran` int(11) DEFAULT '0',
  `omset` int(11) DEFAULT '0',
  `bulan` int(11) DEFAULT '0',
  `tahun` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table ta.omset: ~1 rows (approximately)
DELETE FROM `omset`;
/*!40000 ALTER TABLE `omset` DISABLE KEYS */;
INSERT INTO `omset` (`id`, `pemasukan_online`, `pemasukan_offline`, `pemasukan_lain`, `pengeluaran`, `omset`, `bulan`, `tahun`) VALUES
	(1, 0, NULL, NULL, 1100000, -1100000, 3, 2019);
/*!40000 ALTER TABLE `omset` ENABLE KEYS */;

-- Dumping structure for table ta.settings
DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `idsettings` int(11) NOT NULL AUTO_INCREMENT,
  `webName` varchar(100) DEFAULT NULL,
  `kontak1` varchar(45) DEFAULT NULL,
  `kontak2` varchar(45) DEFAULT NULL,
  `kontak3` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `ico` varchar(45) DEFAULT NULL,
  `meta` text,
  `logo` varchar(50) DEFAULT NULL,
  `keterangan` text,
  `alamat` text,
  `nama_toko` int(11) DEFAULT NULL,
  `max_tgl` int(5) DEFAULT NULL,
  `peraturan` text,
  `bulansistem` int(11) DEFAULT NULL,
  PRIMARY KEY (`idsettings`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table ta.settings: ~1 rows (approximately)
DELETE FROM `settings`;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`idsettings`, `webName`, `kontak1`, `kontak2`, `kontak3`, `email`, `ico`, `meta`, `logo`, `keterangan`, `alamat`, `nama_toko`, `max_tgl`, `peraturan`, `bulansistem`) VALUES
	(1, 'STORE TULUNGAGUNG', '+6285816900612', '+6281553860046', '+6285856044060', 'bayukhoirul1@gmail.com', '1547722245-dvinafavicon.png', 'Fashion murah meriah berkualitas', '1543717647-logo-dvina.png', 'store tulungagung adalah toko ecer / grosir yang telah terbukti memiliki harga dan kwalitas terbaik\r\nopen reseller , dropshiper, agen. store tulungagung selalu berusaha memberikan pelayanan terbaik kepada pembeli. dan banyak potongan harga untuk pembelian lebih dari 3pcs.', 'Dsn.Jatirejo RT01/RW02 Ds.Tenggur Kec.Rejotangan Kab.Tulungagung', NULL, 7, '<p>1. pastikan telah menjadi member StoreTulungagung</p><p>2. pastikan melakukan pemesanan / keep barang sampai masuk pada W.A admin</p><p>3. jangan lupa bayar setelah beli produk</p><p>4. setiap barang yang telah di masukan keranjang akan hilang secara otomatis apabila tidak di beli dalam jangka waktu 7hari</p><p>5. Happy Shopping gengs</p>', 4);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;

-- Dumping structure for table ta.sliders
DROP TABLE IF EXISTS `sliders`;
CREATE TABLE IF NOT EXISTS `sliders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table ta.sliders: ~3 rows (approximately)
DELETE FROM `sliders`;
/*!40000 ALTER TABLE `sliders` DISABLE KEYS */;
INSERT INTO `sliders` (`id`, `judul`, `foto`) VALUES
	(1, 'ini slide 1', '1548724725-tabanner2.jpg'),
	(2, 'ini slide 2', '1548724768-tabanner3.jpg'),
	(3, 'ini slide 3', '1548724999-tabanner1.gif');
/*!40000 ALTER TABLE `sliders` ENABLE KEYS */;

-- Dumping structure for table ta.tb_bank
DROP TABLE IF EXISTS `tb_bank`;
CREATE TABLE IF NOT EXISTS `tb_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_bank` varchar(40) DEFAULT NULL,
  `rekening` varchar(40) DEFAULT NULL,
  `atasnama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table ta.tb_bank: ~4 rows (approximately)
DELETE FROM `tb_bank`;
/*!40000 ALTER TABLE `tb_bank` DISABLE KEYS */;
INSERT INTO `tb_bank` (`id`, `nama_bank`, `rekening`, `atasnama`) VALUES
	(1, 'bayar ditoko\r\n', '-', '-'),
	(2, 'mandiri Syariah', '09737897890', 'storeta'),
	(3, 'BRI', '902890890', 'storeta'),
	(4, 'bank jatim', '09890890890', 'storeta');
/*!40000 ALTER TABLE `tb_bank` ENABLE KEYS */;

-- Dumping structure for table ta.tb_barangs
DROP TABLE IF EXISTS `tb_barangs`;
CREATE TABLE IF NOT EXISTS `tb_barangs` (
  `idbarang` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(100) DEFAULT NULL,
  `kode_v` varchar(100) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `warna` varchar(45) DEFAULT NULL,
  `barang_jenis` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`idbarang`)
) ENGINE=InnoDB AUTO_INCREMENT=301 DEFAULT CHARSET=latin1;

-- Dumping data for table ta.tb_barangs: ~16 rows (approximately)
DELETE FROM `tb_barangs`;
/*!40000 ALTER TABLE `tb_barangs` DISABLE KEYS */;
INSERT INTO `tb_barangs` (`idbarang`, `kode`, `kode_v`, `stok`, `warna`, `barang_jenis`) VALUES
	(285, 'BRG00001', '05', 5, 'xl', 'kaos polos sip xl'),
	(286, 'BRG00001', '07', 4, 'l', 'kaos polos sip l'),
	(287, 'BRG00002', '04', 14, 'm', 'kaos polos mantul m'),
	(288, 'BRG00002', '06', 10, 'xl', 'kaos polos mantul xl'),
	(289, 'BRG00003', '04', 10, 'L', 'kemeja mantul L'),
	(290, 'BRG00003', '07', 10, 'S', 'kemeja mantul S'),
	(291, 'BRG00004', '05', 15, 'M', 'kemeja mantab M'),
	(292, 'BRG00004', '06', 5, 'S', 'kemeja mantab S'),
	(293, 'BRG00005', '01', 10, 'L', 'kemeja monalisa L'),
	(294, 'BRG00005', '07', 7, 'XL', 'kemeja monalisa XL'),
	(295, 'BRG00006', '04', 10, 'XL', 'HOODIE KICKOUT XL'),
	(296, 'BRG00006', '01', 11, 'XL', 'HOODIE KICKOUT XL'),
	(297, 'BRG00007', '01', 12, 'XL', 'HOODIE POLOS XL'),
	(298, 'BRG00007', '03', 10, 'XL', 'HOODIE POLOS XL'),
	(299, 'BRG00007', '07', 12, 'XL', 'HOODIE POLOS XL'),
	(300, 'BRG00007', '04', 12, 'XL', 'HOODIE POLOS XL');
/*!40000 ALTER TABLE `tb_barangs` ENABLE KEYS */;

-- Dumping structure for table ta.tb_details
DROP TABLE IF EXISTS `tb_details`;
CREATE TABLE IF NOT EXISTS `tb_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idwarna` int(11) DEFAULT NULL,
  `iduser` int(11) DEFAULT NULL,
  `kode_v` varchar(50) DEFAULT NULL,
  `faktur` varchar(100) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `tgl_kadaluarsa` date DEFAULT NULL,
  `kode_barang` varchar(100) DEFAULT NULL,
  `barang` varchar(100) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `total_a` int(11) DEFAULT NULL,
  `diskon` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `sb` enum('1','0') NOT NULL DEFAULT '0',
  `admin` varchar(100) DEFAULT NULL,
  `metode` enum('langsung','pesan') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table ta.tb_details: ~10 rows (approximately)
DELETE FROM `tb_details`;
/*!40000 ALTER TABLE `tb_details` DISABLE KEYS */;
INSERT INTO `tb_details` (`id`, `idwarna`, `iduser`, `kode_v`, `faktur`, `tgl`, `tgl_kadaluarsa`, `kode_barang`, `barang`, `harga`, `jumlah`, `total_a`, `diskon`, `total`, `sb`, `admin`, `metode`) VALUES
	(1, 287, 5, '04', 'DVN03041900001', '2019-04-03', '2019-04-10', 'BRG00002', 'kaos polos mantul', 30000, 1, 30000, 0, 30000, '1', NULL, 'pesan'),
	(2, 294, 2, '07', 'STA03041900002', '2019-04-03', '2019-04-10', 'BRG00005', 'kemeja monalisa', 40000, 1, 40000, 10, 36000, '1', NULL, 'pesan'),
	(3, 286, 1, '07', 'STA03041900003', '2019-04-03', '2019-04-10', 'BRG00001', 'kaos polos sip', 40000, 1, 40000, 0, 40000, '1', NULL, 'pesan'),
	(4, 296, 3, '01', 'STA03041900004', '2019-04-03', '2019-04-10', 'BRG00006', 'HOODIE KICKOUT', 87000, 1, 87000, 0, 87000, '1', NULL, 'pesan'),
	(5, 298, 3, '03', 'STA03041900005', '2019-04-03', '2019-04-10', 'BRG00007', 'HOODIE POLOS', 82000, 1, 82000, 0, 82000, '1', NULL, 'pesan'),
	(6, 295, 3, '04', 'STA03041900006', '2019-04-03', '2019-04-10', 'BRG00006', 'HOODIE KICKOUT', 87000, 1, 87000, 0, 87000, '1', NULL, 'pesan'),
	(7, 298, 3, '03', 'STA03041900006', '2019-04-03', '2019-04-10', 'BRG00007', 'HOODIE POLOS', 82000, 1, 82000, 0, 82000, '1', NULL, 'pesan'),
	(8, 294, NULL, '07', 'STA030419-10-000001', '2019-04-03', '2019-04-10', 'BRG00005', 'kemeja monalisa XL', 40000, 1, 40000, 10, 36000, '0', '10', 'langsung'),
	(9, 294, 1, '07', 'STA03041900007', '2019-04-03', '2019-04-10', 'BRG00005', 'kemeja monalisa', 40000, 1, 40000, 10, 36000, '1', NULL, 'pesan'),
	(10, 295, 1, '04', 'STA03041900008', '2019-04-03', '2019-04-10', 'BRG00006', 'HOODIE KICKOUT', 87000, 1, 87000, 0, 87000, '1', NULL, 'pesan');
/*!40000 ALTER TABLE `tb_details` ENABLE KEYS */;

-- Dumping structure for table ta.tb_kategoris
DROP TABLE IF EXISTS `tb_kategoris`;
CREATE TABLE IF NOT EXISTS `tb_kategoris` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(100) DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

-- Dumping data for table ta.tb_kategoris: ~32 rows (approximately)
DELETE FROM `tb_kategoris`;
/*!40000 ALTER TABLE `tb_kategoris` DISABLE KEYS */;
INSERT INTO `tb_kategoris` (`id`, `kategori`, `gambar`) VALUES
	(1, 'KEMEJA PENDEK', '1551603645-52812889_472539769948111_6073432641032421376_n.jpg'),
	(6, 'JAKET JEANS', '1551631468-52415872_468287670373321_8894801356469043200_n.jpg'),
	(8, 'kaos polos', '1551688887-52653734_466866750515413_4224494368800636928_n.jpg'),
	(13, 'JAKET VANS BB', '1551694824-43030749_398803567321732_7654751608424628224_n.jpg'),
	(14, 'HOODIE STUSSY', '1551694891-49581006_448017939066961_3262064409052184576_n.jpg'),
	(15, 'HOODIE SUPREME', '1551694978-51193927_456489801553108_5629985664381485056_n.jpg'),
	(16, 'ZIPPER CONVERS', '1551695024-52008444_466905013844920_7455547786830807040_n.jpg'),
	(21, 'KEMEJA PANJANG', '1552219239-54381463_476286039573484_1085267892724826112_n.jpg'),
	(22, 'HOODIE JAKET FILA', '1552222186-img20181127170103-01.jpeg'),
	(23, 'HOODIE AHHA', '1552222911-quotephoto018709ac.jpg'),
	(24, 'HOODIE FRIDAY KILLER', '1552222939-img20181128152901-01.jpeg'),
	(25, 'HOODIE FLAVA', '1552222959-img20181124142552-01-02.jpeg'),
	(26, 'HOODIE THRASHER', '1552223017-img20181128152229-01.jpeg'),
	(27, 'HOODIE ZEROHEROES', '1552223055-img20181211144249-01.jpeg'),
	(28, 'HOODIE DICKIES', '1552292860-quotephotof757a9bb.jpg'),
	(29, 'HOODIE FEAR OF GOD (FOG)', '1552294477-1551867737517.jpg'),
	(30, 'JAKET BOLAK=BALIK', '1552300406-picsart_11-26-05.15.17-02.jpeg'),
	(31, 'HOODIE UH', '1552300533-img20181124144214-01.jpeg'),
	(32, 'ZIPPER MOTIF', '1552395049-53111052_473926866476068_1458057907122733056_n.jpg'),
	(33, 'PARKA COWO', '1552395077-51243131_458560451346043_7908982894612185088_n-(1).jpg'),
	(34, 'PARKA CEWE', '1552395104-52596453_469697930232295_1037197085444669440_n.jpg'),
	(35, 'HOODIE POLOS', '1552476706-52340183_466900573845364_6214426586179960832_n.jpg'),
	(36, 'ZIPPER POLOS', '1552481196-img20181219145045-01.jpeg'),
	(37, 'HOODIE PULLBEAR', '1552648928-54002520_478669122668509_3196493602905653248_n.jpg'),
	(39, 'HOODIE OFFWHITE', '1553068546-quotephotob1a9fe7a.jpg'),
	(40, 'KAOS BM ORI', '1553083814-54517263_480607059141382_5478045930655580160_n.jpg'),
	(41, 'CELANA CHINOS', '1553250443-52605915_466904657178289_3542505673034039296_n.jpg'),
	(42, 'CELANA SURFING', '1553250508-49761475_445441532657935_2083242525073604608_n.jpg'),
	(43, 'TAS CEWE/COWO', '1553250608-52478537_468776690324419_1681148657484693504_n.jpg'),
	(44, 'SHORTPANTS', '1553251920-54385203_480191225849632_4250396431799549952_n.jpg'),
	(45, 'HOODIE KICKOUT', '1554263160-55927941_487524928449595_6118583772494430208_n.jpg'),
	(46, 'HOODIE POLOS new', '1554264515-56242724_487524988449589_3064092396963758080_n.jpg');
/*!40000 ALTER TABLE `tb_kategoris` ENABLE KEYS */;

-- Dumping structure for table ta.tb_kodes
DROP TABLE IF EXISTS `tb_kodes`;
CREATE TABLE IF NOT EXISTS `tb_kodes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(11) DEFAULT NULL,
  `kode_barang` varchar(100) DEFAULT NULL,
  `barang` varchar(150) DEFAULT NULL,
  `harga_beli` int(11) DEFAULT NULL,
  `harga_barang` int(11) DEFAULT NULL,
  `harga_reseller` int(11) DEFAULT NULL,
  `deskripsi` mediumtext,
  `diskon` int(11) DEFAULT '0',
  `tampil` enum('Y','N') DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=179 DEFAULT CHARSET=latin1;

-- Dumping data for table ta.tb_kodes: ~7 rows (approximately)
DELETE FROM `tb_kodes`;
/*!40000 ALTER TABLE `tb_kodes` DISABLE KEYS */;
INSERT INTO `tb_kodes` (`id`, `id_kategori`, `kode_barang`, `barang`, `harga_beli`, `harga_barang`, `harga_reseller`, `deskripsi`, `diskon`, `tampil`) VALUES
	(172, 8, 'BRG00001', 'kaos polos sip', 20000, 40000, 30000, '<p>kaos mantab buat dipake, hehehehe</p>', 0, 'Y'),
	(173, 8, 'BRG00002', 'kaos polos mantul', 1000, 30000, 2000, '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>', 0, 'Y'),
	(174, 1, 'BRG00003', 'kemeja mantul', 20000, 40000, 35000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 0, 'Y'),
	(175, 21, 'BRG00004', 'kemeja mantab', 25000, 50000, 40000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 10, 'Y'),
	(176, 1, 'BRG00005', 'kemeja monalisa', 10000, 40000, 30000, '<p>deskripsi nya</p>', 10, 'Y'),
	(177, 45, 'BRG00006', 'HOODIE KICKOUT', 73, 87000, 82000, '<p>BAHANFLEECE</p>', 0, 'Y'),
	(178, 46, 'BRG00007', 'HOODIE POLOS', 68000, 82000, 77000, '<p>bahan fleece</p>', 0, 'Y');
/*!40000 ALTER TABLE `tb_kodes` ENABLE KEYS */;

-- Dumping structure for table ta.tb_stokawals
DROP TABLE IF EXISTS `tb_stokawals`;
CREATE TABLE IF NOT EXISTS `tb_stokawals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idbarang` int(11) DEFAULT NULL,
  `idwarna` int(11) DEFAULT NULL,
  `kode_barang` varchar(100) DEFAULT NULL,
  `barang` varchar(100) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `tgl` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ta.tb_stokawals: ~0 rows (approximately)
DELETE FROM `tb_stokawals`;
/*!40000 ALTER TABLE `tb_stokawals` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_stokawals` ENABLE KEYS */;

-- Dumping structure for table ta.tb_tambahstoks
DROP TABLE IF EXISTS `tb_tambahstoks`;
CREATE TABLE IF NOT EXISTS `tb_tambahstoks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idwarna` int(11) DEFAULT NULL,
  `idadmin` int(11) DEFAULT NULL,
  `kode_barang` varchar(150) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `aksi` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Dumping data for table ta.tb_tambahstoks: ~16 rows (approximately)
DELETE FROM `tb_tambahstoks`;
/*!40000 ALTER TABLE `tb_tambahstoks` DISABLE KEYS */;
INSERT INTO `tb_tambahstoks` (`id`, `idwarna`, `idadmin`, `kode_barang`, `jumlah`, `total`, `tgl`, `keterangan`, `aksi`) VALUES
	(1, 285, 10, 'BRG00001', 5, 100000, '2019-03-31', 'menambah pertama kali', 'tambah'),
	(2, 286, 10, 'BRG00001', 5, 100000, '2019-03-31', 'menambah pertama kali', 'tambah'),
	(3, 287, 12, 'BRG00002', 10, 10000, '2019-03-31', 'menambah pertama kali', 'tambah'),
	(4, 288, 12, 'BRG00002', 10, 10000, '2019-03-31', 'menambah pertama kali', 'tambah'),
	(5, 289, 12, 'BRG00003', 10, 200000, '2019-03-31', 'menambah pertama kali', 'tambah'),
	(6, 290, 12, 'BRG00003', 10, 200000, '2019-03-31', 'menambah pertama kali', 'tambah'),
	(7, 291, 12, 'BRG00004', 15, 125000, '2019-03-31', 'menambah pertama kali', 'tambah'),
	(8, 292, 12, 'BRG00004', 5, 125000, '2019-03-31', 'menambah pertama kali', 'tambah'),
	(9, 293, 10, 'BRG00005', 10, 100000, '2019-04-03', 'menambah pertama kali', 'tambah'),
	(10, 294, 10, 'BRG00005', 10, 100000, '2019-04-03', 'menambah pertama kali', 'tambah'),
	(11, 295, 16, 'BRG00006', 12, 876, '2019-04-03', 'menambah pertama kali', 'tambah'),
	(12, 296, 16, 'BRG00006', 12, 876, '2019-04-03', 'menambah pertama kali', 'tambah'),
	(13, 297, 17, 'BRG00007', 12, 816000, '2019-04-03', 'menambah pertama kali', 'tambah'),
	(14, 298, 17, 'BRG00007', 12, 816000, '2019-04-03', 'menambah pertama kali', 'tambah'),
	(15, 299, 17, 'BRG00007', 12, 816000, '2019-04-03', 'menambah pertama kali', 'tambah'),
	(16, 300, 17, 'BRG00007', 12, 816000, '2019-04-03', 'menambah pertama kali', 'tambah');
/*!40000 ALTER TABLE `tb_tambahstoks` ENABLE KEYS */;

-- Dumping structure for table ta.tb_transaksis
DROP TABLE IF EXISTS `tb_transaksis`;
CREATE TABLE IF NOT EXISTS `tb_transaksis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) DEFAULT NULL,
  `faktur` varchar(300) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `status` enum('terkirim','dibaca','diterima','ditolak','sukses','batal') DEFAULT NULL,
  `alamat_tujuan` text,
  `admin` varchar(100) DEFAULT NULL,
  `ongkir` int(11) DEFAULT '0',
  `potongan` int(11) DEFAULT '0',
  `total_akhir` int(11) DEFAULT NULL,
  `pembayaran` varchar(50) DEFAULT NULL,
  `keterangan` text,
  `metode` enum('pesan','langsung') DEFAULT 'pesan',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table ta.tb_transaksis: ~9 rows (approximately)
DELETE FROM `tb_transaksis`;
/*!40000 ALTER TABLE `tb_transaksis` DISABLE KEYS */;
INSERT INTO `tb_transaksis` (`id`, `iduser`, `faktur`, `tgl`, `total`, `status`, `alamat_tujuan`, `admin`, `ongkir`, `potongan`, `total_akhir`, `pembayaran`, `keterangan`, `metode`) VALUES
	(1, 5, 'DVN03041900001', '2019-04-03', 30000, 'terkirim', 'Nama : rino oktavian Alamat : babatan, JLN iwak enak no 1 biasa Kota : kediri Provinsi: jawa timur', NULL, 0, 0, 30000, '1', NULL, 'langsung'),
	(2, 2, 'STA03041900002', '2019-04-03', 36000, 'terkirim', 'Nama : rino oktavian Alamat : sjadklfjskladfjklsadfjl reseller Kota : kediri Provinsi: jawa tengah', NULL, 0, 0, 36000, '1', NULL, 'langsung'),
	(3, 1, 'STA03041900003', '2019-04-03', 40000, 'dibaca', 'Nama : jian fitri aprilia Alamat : gurah kediri reseller Kota : kediri Provinsi: jawa timur', NULL, 0, 0, NULL, '3', NULL, 'pesan'),
	(4, 3, 'STA03041900004', '2019-04-03', 87000, 'dibaca', 'Nama : bayucoba Alamat : abcdefghij biasa Kota : tulung agung Provinsi: jawa Timur', NULL, 0, 0, NULL, '3', NULL, 'pesan'),
	(5, 3, 'STA03041900005', '2019-04-03', 82000, 'terkirim', 'Nama : bayucoba Alamat : abcdefghij biasa Kota : tulung agung Provinsi: jawa Timur', NULL, 0, 0, 82000, '1', NULL, 'langsung'),
	(6, 3, 'STA03041900006', '2019-04-03', 169000, 'dibaca', 'Nama : bayucoba Alamat : abcdefghij biasa Kota : tulung agung Provinsi: jawa Timur', NULL, 0, 0, NULL, '3', NULL, 'pesan'),
	(7, NULL, 'STA030419-10-000001', '2019-04-03', 36000, NULL, NULL, '10', 0, 5000, 31000, NULL, NULL, 'langsung'),
	(8, 1, 'STA03041900007', '2019-04-03', 36000, 'dibaca', 'null  null  null  null   null', NULL, 0, 0, NULL, '2', NULL, 'pesan'),
	(9, 1, 'STA03041900008', '2019-04-03', 87000, 'sukses', 'Nia  jln sudarsono  3636  Boyolali   jawatimur', NULL, 2000, 3000, 86000, '2', NULL, 'pesan');
/*!40000 ALTER TABLE `tb_transaksis` ENABLE KEYS */;

-- Dumping structure for table ta.tb_users
DROP TABLE IF EXISTS `tb_users`;
CREATE TABLE IF NOT EXISTS `tb_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` text,
  `email` varchar(100) DEFAULT NULL,
  `telp` varchar(45) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` text,
  `kota` varchar(100) DEFAULT NULL,
  `provinsi` varchar(100) DEFAULT NULL,
  `kodepos` varchar(45) DEFAULT NULL,
  `level` enum('biasa','reseller') DEFAULT 'biasa',
  `ktp_gmb` varchar(100) DEFAULT NULL,
  `cancel` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table ta.tb_users: ~3 rows (approximately)
DELETE FROM `tb_users`;
/*!40000 ALTER TABLE `tb_users` DISABLE KEYS */;
INSERT INTO `tb_users` (`id`, `username`, `password`, `email`, `telp`, `nama`, `alamat`, `kota`, `provinsi`, `kodepos`, `level`, `ktp_gmb`, `cancel`) VALUES
	(1, 'jianfitri', '$2y$10$lzwpAHH/1XazX.datgWJDO9f51y2oBWbQlTviAjb3/.o2fTjTsFQi', 'jian@gmail.com', '0856045567140', 'jian fitri aprilia', 'gurah kediri', 'kediri', 'jawa timur', '0934', 'reseller', '1554002975-kaos1.jpeg', 0),
	(2, 'rinookta', '$2y$10$YfN61LOcjeLTrz.EOrNJCuj2LCOkFJa8wuUhGsmDqUE6gdXLaV32.', 'rino@gmail.com', '2093842903', 'rino oktavian', 'sjadklfjskladfjklsadfjl', 'kediri', 'jawa tengah', '2039489', 'reseller', '1554003122-kaos5.jpg', 0),
	(3, 'bayucoba', '$2y$10$bKLhgxUoZMRdMR/KYrDyk.L/C90hWCWKX0FC.JilqE82VVvNUr9lC', 'bayukhoirul1@gmail.com', '085123456789', 'bayucoba', 'abcdefghij', 'tulung agung', 'jawa Timur', '0852741', 'biasa', NULL, 0);
/*!40000 ALTER TABLE `tb_users` ENABLE KEYS */;

-- Dumping structure for table ta.tb_varian
DROP TABLE IF EXISTS `tb_varian`;
CREATE TABLE IF NOT EXISTS `tb_varian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_v` varchar(50) DEFAULT '0',
  `varian` varchar(50) DEFAULT '0',
  `hex` varchar(50) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table ta.tb_varian: 7 rows
DELETE FROM `tb_varian`;
/*!40000 ALTER TABLE `tb_varian` DISABLE KEYS */;
INSERT INTO `tb_varian` (`id`, `kode_v`, `varian`, `hex`) VALUES
	(3, '03', 'Biru', '#4b68b4'),
	(4, '04', 'Hijau', '#426a15'),
	(5, '05', 'biru muda', '#00ffff'),
	(6, '06', 'hijau daun', '#40bf56'),
	(7, '07', 'merah muda', '#c82bd5'),
	(8, '01', 'hitam', '#000040'),
	(9, 'kck', 'floral', '#8080c0');
/*!40000 ALTER TABLE `tb_varian` ENABLE KEYS */;

-- Dumping structure for trigger ta.add_stok
DROP TRIGGER IF EXISTS `add_stok`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `add_stok` AFTER INSERT ON `tb_tambahstoks` FOR EACH ROW update tb_barangs set stok=stok+new.jumlah where idbarang=new.idwarna//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger ta.in_stok
DROP TRIGGER IF EXISTS `in_stok`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `in_stok` AFTER INSERT ON `detail_cancel` FOR EACH ROW update tb_barangs set stok=stok+new.jumlah where idbarang=new.idwarna//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger ta.keranjang_dihapus
DROP TRIGGER IF EXISTS `keranjang_dihapus`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `keranjang_dihapus` AFTER INSERT ON `keranjang_cancel` FOR EACH ROW BEGIN
update tb_barangs set stok=stok+new.jumlah where idbarang=new.idbarang;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger ta.min_stok
DROP TRIGGER IF EXISTS `min_stok`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `min_stok` AFTER INSERT ON `tb_details` FOR EACH ROW update tb_barangs set stok=stok-new.jumlah where idbarang=new.idwarna//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
