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


-- Dumping database structure for ta_store
DROP DATABASE IF EXISTS `ta_store`;
CREATE DATABASE IF NOT EXISTS `ta_store` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ta_store`;

-- Dumping structure for table ta_store.admins
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

-- Dumping data for table ta_store.admins: ~8 rows (approximately)
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

-- Dumping structure for table ta_store.detail_cancel
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table ta_store.detail_cancel: ~2 rows (approximately)
DELETE FROM `detail_cancel`;
/*!40000 ALTER TABLE `detail_cancel` DISABLE KEYS */;
INSERT INTO `detail_cancel` (`id`, `idwarna`, `iduser`, `kode`, `tgl`, `jumlah`, `harga`, `barang`, `total`, `diskon`) VALUES
	(1, 6, 7, 'Cancel00001', '2019-03-03', 1, 98000, 'BOMBER', 98000, 0),
	(2, 6, 7, 'Cancel00001', '2019-03-03', 1, 98000, 'BOMBER', 98000, 0),
	(3, 15, 5, 'Cancel00003', '2019-03-17', 1, 20000, 'syemfak bhuhulak xl', 20000, 0);
/*!40000 ALTER TABLE `detail_cancel` ENABLE KEYS */;

-- Dumping structure for table ta_store.gambar
DROP TABLE IF EXISTS `gambar`;
CREATE TABLE IF NOT EXISTS `gambar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(30) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table ta_store.gambar: ~6 rows (approximately)
DELETE FROM `gambar`;
/*!40000 ALTER TABLE `gambar` DISABLE KEYS */;
INSERT INTO `gambar` (`id`, `kode_barang`, `nama`) VALUES
	(1, 'BRG00006', '1552654972-grafika3.jpg'),
	(2, 'BRG00007', '1552655825-grafika3.jpg'),
	(3, 'BRG00010', '1553169418-1.jpg'),
	(4, 'BRG00010', '1553169418-2.jpg'),
	(5, 'BRG00010', '1553169419-3.jpg'),
	(6, 'BRG00010', '1553169419-4.jpg');
/*!40000 ALTER TABLE `gambar` ENABLE KEYS */;

-- Dumping structure for table ta_store.keranjang_cancel
DROP TABLE IF EXISTS `keranjang_cancel`;
CREATE TABLE IF NOT EXISTS `keranjang_cancel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl` date DEFAULT NULL,
  `idbarang` int(11) NOT NULL DEFAULT '0',
  `jumlah` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table ta_store.keranjang_cancel: ~4 rows (approximately)
DELETE FROM `keranjang_cancel`;
/*!40000 ALTER TABLE `keranjang_cancel` DISABLE KEYS */;
INSERT INTO `keranjang_cancel` (`id`, `tgl`, `idbarang`, `jumlah`) VALUES
	(5, '2019-03-07', 27, 1),
	(6, '2019-03-07', 4, 1),
	(7, '2019-03-16', 15, 1),
	(8, '2019-03-16', 8, 1),
	(9, '2019-03-16', 8, 1),
	(10, '2019-03-16', 14, 1);
/*!40000 ALTER TABLE `keranjang_cancel` ENABLE KEYS */;

-- Dumping structure for table ta_store.log_cancel
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table ta_store.log_cancel: ~3 rows (approximately)
DELETE FROM `log_cancel`;
/*!40000 ALTER TABLE `log_cancel` DISABLE KEYS */;
INSERT INTO `log_cancel` (`id`, `faktur`, `total_akhir`, `tgl`, `bulan`, `status`, `id_user`, `id_admin`, `keterangan`) VALUES
	(1, 'Cancel00001', 251000, '2019-03-03', 3, 'ditolak', 7, 16, 'BELUM MELAKUKAN TRANSFER'),
	(2, 'Cancel00002', 82000, '2019-03-17', 3, 'dicancel', 5, NULL, 'asdf'),
	(3, 'Cancel00003', 20000, '2019-03-17', 3, 'dicancel', 5, NULL, 'dfg');
/*!40000 ALTER TABLE `log_cancel` ENABLE KEYS */;

-- Dumping structure for table ta_store.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ta_store.migrations: ~0 rows (approximately)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table ta_store.omset
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ta_store.omset: ~0 rows (approximately)
DELETE FROM `omset`;
/*!40000 ALTER TABLE `omset` DISABLE KEYS */;
/*!40000 ALTER TABLE `omset` ENABLE KEYS */;

-- Dumping structure for table ta_store.settings
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

-- Dumping data for table ta_store.settings: ~0 rows (approximately)
DELETE FROM `settings`;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`idsettings`, `webName`, `kontak1`, `kontak2`, `kontak3`, `email`, `ico`, `meta`, `logo`, `keterangan`, `alamat`, `nama_toko`, `max_tgl`, `peraturan`, `bulansistem`) VALUES
	(1, 'STORE TULUNGAGUNG', '085816900612', '081553860046', '085856044060', 'bayukhoirul1@gmail.com', '1547722245-dvinafavicon.png', 'Fashion murah meriah berkualitas', '1543717647-logo-dvina.png', 'store tulungagung adalah toko ecer / grosir yang telah terbukti memiliki harga dan kwalitas terbaik\r\nopen reseller , dropshiper, agen. store tulungagung selalu berusaha memberikan pelayanan terbaik kepada pembeli. dan banyak potongan harga untuk pembelian lebih dari 3pcs.', 'Dsn.Jatirejo RT01/RW02 Ds.Tenggur Kec.Rejotangan Kab.Tulungagung', NULL, 7, '<p>1. pastikan telah menjadi member StoreTulungagung</p><p>2. pastikan melakukan pemesanan / keep barang sampai masuk pada W.A admin</p><p>3. jangan lupa bayar setelah beli produk</p><p>4. setiap barang yang telah di masukan keranjang akan hilang secara otomatis apabila tidak di beli dalam jangka waktu 7hari</p><p>5. Happy Shopping gengs</p>', 3);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;

-- Dumping structure for table ta_store.sliders
DROP TABLE IF EXISTS `sliders`;
CREATE TABLE IF NOT EXISTS `sliders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table ta_store.sliders: ~3 rows (approximately)
DELETE FROM `sliders`;
/*!40000 ALTER TABLE `sliders` DISABLE KEYS */;
INSERT INTO `sliders` (`id`, `judul`, `foto`) VALUES
	(1, 'ini slide 1', '1548724725-tabanner2.jpg'),
	(2, 'ini slide 2', '1548724768-tabanner3.jpg'),
	(3, 'ini slide 3', '1548724999-tabanner1.gif');
/*!40000 ALTER TABLE `sliders` ENABLE KEYS */;

-- Dumping structure for table ta_store.tb_bank
DROP TABLE IF EXISTS `tb_bank`;
CREATE TABLE IF NOT EXISTS `tb_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_bank` varchar(40) DEFAULT NULL,
  `rekening` varchar(40) DEFAULT NULL,
  `atasnama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table ta_store.tb_bank: ~4 rows (approximately)
DELETE FROM `tb_bank`;
/*!40000 ALTER TABLE `tb_bank` DISABLE KEYS */;
INSERT INTO `tb_bank` (`id`, `nama_bank`, `rekening`, `atasnama`) VALUES
	(1, 'bayar ditoko\r\n', '-', '-'),
	(2, 'mandiri Syariah', '09737897890', 'storeta'),
	(3, 'BRI', '902890890', 'storeta'),
	(4, 'bank jatim', '09890890890', 'storeta');
/*!40000 ALTER TABLE `tb_bank` ENABLE KEYS */;

-- Dumping structure for table ta_store.tb_barangs
DROP TABLE IF EXISTS `tb_barangs`;
CREATE TABLE IF NOT EXISTS `tb_barangs` (
  `idbarang` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(100) DEFAULT NULL,
  `kode_v` varchar(50) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `warna` varchar(45) DEFAULT NULL,
  `barang_jenis` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`idbarang`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- Dumping data for table ta_store.tb_barangs: ~23 rows (approximately)
DELETE FROM `tb_barangs`;
/*!40000 ALTER TABLE `tb_barangs` DISABLE KEYS */;
INSERT INTO `tb_barangs` (`idbarang`, `kode`, `kode_v`, `stok`, `warna`, `barang_jenis`) VALUES
	(6, 'BRG00003', '07', 5, 'xl', 'bomber man xl'),
	(7, 'BRG00003', '06', 2, 's', 'bomber man s'),
	(8, 'BRG00004', '03', 10, 'M', 'kemeja hitam M'),
	(9, 'BRG00004', '04', 10, 'L', 'kemeja hitam L'),
	(10, 'BRG00005', '07', 4, 'xl', 'bomber man xl'),
	(11, 'BRG00005', '06', 2, 's', 'bomber man s'),
	(12, 'BRG00005', '06', 2, 'xxl', 'bomber man xxl'),
	(13, 'BRG00006', '06', 0, 'm', 'celana dalam m'),
	(14, 'BRG00006', '05', 0, 'xl', 'celana dalam xl'),
	(15, 'BRG00007', '05', 11, 'xl', 'syemfak bhuhulak xl'),
	(16, 'BRG00007', '07', 3, 'm', 'syemfak bhuhulak m'),
	(17, 'BRG00003', '03', 4, 'l', 'bomber man l'),
	(18, 'BRG00007', '04', 4, 's', 'syemfak bhuhulak s'),
	(19, 'BRG00008', '03', 3, 'M', 'kemeja hitam M'),
	(20, 'BRG00008', '04', 10, 'L', 'kemeja hitam L'),
	(21, 'BRG00009', '07', 3, 'xl', 'bomber man xl'),
	(22, 'BRG00009', '06', 6, 's', 'bomber man s'),
	(23, 'BRG00008', '03', 10, 'xl', 'kemeja hitam xl'),
	(24, 'BRG00009', '05', 1, 'm', 'bomber man m'),
	(25, 'BRG00010', '03', 10, 's', 'cok cok cok s'),
	(26, 'BRG00010', '05', 10, 'xl', 'cok cok cok xl'),
	(27, 'BRG00011', '03', 10, 'M', 'kemeja hitam M'),
	(28, 'BRG00011', '04', 10, 'L', 'kemeja hitam L');
/*!40000 ALTER TABLE `tb_barangs` ENABLE KEYS */;

-- Dumping structure for table ta_store.tb_details
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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- Dumping data for table ta_store.tb_details: ~13 rows (approximately)
DELETE FROM `tb_details`;
/*!40000 ALTER TABLE `tb_details` DISABLE KEYS */;
INSERT INTO `tb_details` (`id`, `idwarna`, `iduser`, `kode_v`, `faktur`, `tgl`, `tgl_kadaluarsa`, `kode_barang`, `barang`, `harga`, `jumlah`, `total_a`, `diskon`, `total`, `sb`, `admin`, `metode`) VALUES
	(17, 19, NULL, '03', 'STA170319-10-000001', '2019-03-17', '2019-03-24', 'BRG00008', 'kemeja hitam M', 20000, 1, 20000, 10, 18000, '0', '10', 'langsung'),
	(18, 14, 5, '05', 'ST17031900001', '2019-03-17', '2019-03-24', 'BRG00006', 'celana dalam xl', 10000, 1, 10000, 0, 10000, '0', NULL, 'pesan'),
	(19, 19, NULL, '03', 'STA190319-10-000001', '2019-03-19', '2019-03-26', 'BRG00008', 'kemeja hitam M', 20000, 1, 20000, 10, 18000, '0', '10', 'langsung'),
	(20, 14, NULL, '05', 'STA190319-10-000001', '2019-03-19', '2019-03-26', 'BRG00006', 'celana dalam xl', 10000, 1, 10000, 0, 10000, '0', '10', 'langsung'),
	(21, 15, NULL, '05', 'STA190319-10-000001', '2019-03-19', '2019-03-26', 'BRG00007', 'syemfak bhuhulak xl', 20000, 1, 20000, 0, 20000, '0', '10', 'langsung'),
	(22, 19, NULL, '03', 'STA190319-10-000002', '2019-03-19', '2019-03-26', 'BRG00008', 'kemeja hitam M', 20000, 1, 20000, 10, 18000, '0', '10', 'langsung'),
	(23, 14, NULL, '05', 'STA190319-10-000002', '2019-03-19', '2019-03-26', 'BRG00006', 'celana dalam xl', 10000, 1, 10000, 0, 10000, '0', '10', 'langsung'),
	(24, 11, NULL, '06', 'STA190319-10-000003', '2019-03-19', '2019-03-26', 'BRG00005', 'bomber man s', 35000, 1, 35000, 20, 28000, '0', '10', 'langsung'),
	(25, 10, NULL, '07', 'STA190319-10-000003', '2019-03-19', '2019-03-26', 'BRG00005', 'bomber man xl', 35000, 1, 35000, 20, 28000, '0', '10', 'langsung'),
	(26, 17, NULL, '03', 'STA190319-10-000004', '2019-03-19', '2019-03-26', 'BRG00003', 'bomber man l', 35000, 1, 35000, 20, 28000, '0', '10', 'langsung'),
	(27, 11, NULL, '06', 'STA190319-10-000004', '2019-03-19', '2019-03-26', 'BRG00005', 'bomber man s', 35000, 1, 35000, 20, 28000, '0', '10', 'langsung'),
	(28, 7, NULL, '06', 'STA190319-10-000005', '2019-03-19', '2019-03-26', 'BRG00003', 'bomber man s', 35000, 1, 35000, 20, 28000, '0', '10', 'langsung'),
	(29, 15, 5, '05', 'ST20031900001', '2019-03-20', '2019-03-27', 'BRG00007', 'syemfak bhuhulak xl', 20000, 1, 20000, 0, 20000, '0', NULL, 'pesan'),
	(30, 11, NULL, '06', 'STA210319-10-000001', '2019-03-21', '2019-03-28', 'BRG00005', 'bomber man s', 35000, 1, 35000, 20, 28000, '0', '10', 'langsung'),
	(31, 24, NULL, '05', 'STA210319-10-000001', '2019-03-21', '2019-03-28', 'BRG00009', 'bomber man m', 30000, 1, 30000, 20, 24000, '0', '10', 'langsung');
/*!40000 ALTER TABLE `tb_details` ENABLE KEYS */;

-- Dumping structure for table ta_store.tb_kategoris
DROP TABLE IF EXISTS `tb_kategoris`;
CREATE TABLE IF NOT EXISTS `tb_kategoris` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(100) DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Dumping data for table ta_store.tb_kategoris: ~15 rows (approximately)
DELETE FROM `tb_kategoris`;
/*!40000 ALTER TABLE `tb_kategoris` DISABLE KEYS */;
INSERT INTO `tb_kategoris` (`id`, `kategori`, `gambar`) VALUES
	(1, 'kemeja cowok', '1551603645-52812889_472539769948111_6073432641032421376_n.jpg'),
	(2, 'HOODIE', '1551607640-46519177_422425381626217_7827161869247840256_n.jpg'),
	(3, 'HOODIE POLOS', '1551608912-49938219_448017202400368_8699818650208567296_n.jpg'),
	(4, 'ZIPPER POLOS', '1551609085-51516217_458559181346170_2165983614037131264_n.jpg'),
	(5, 'BOMBER', '1551631432-49815847_458559701346118_2138148472157634560_n.jpg'),
	(6, 'JAKET JEANS', '1551631468-52415872_468287670373321_8894801356469043200_n.jpg'),
	(7, 'kaos', '1551688848-52762282_470189906849764_3112529023788384256_n.jpg'),
	(8, 'kaos polos', '1551688887-52653734_466866750515413_4224494368800636928_n.jpg'),
	(9, 'celana pendek', '1551692220-50314702_450113065524115_199127744838107136_n.jpg'),
	(10, 'zipper salur', '1551694282-51754562_462792834256138_2766894206407409664_n.jpg'),
	(12, 'KOKO ANAK', '1551694659-45723548_415149149020507_8672313121299234816_n.jpg'),
	(13, 'JAKET VANS BB', '1551694824-43030749_398803567321732_7654751608424628224_n.jpg'),
	(14, 'HOODIE STUSSY', '1551694891-49581006_448017939066961_3262064409052184576_n.jpg'),
	(15, 'HOODIE SUPREME', '1551694978-51193927_456489801553108_5629985664381485056_n.jpg'),
	(16, 'ZIPPER CONVERS', '1551695024-52008444_466905013844920_7455547786830807040_n.jpg');
/*!40000 ALTER TABLE `tb_kategoris` ENABLE KEYS */;

-- Dumping structure for table ta_store.tb_kodes
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table ta_store.tb_kodes: ~9 rows (approximately)
DELETE FROM `tb_kodes`;
/*!40000 ALTER TABLE `tb_kodes` DISABLE KEYS */;
INSERT INTO `tb_kodes` (`id`, `id_kategori`, `kode_barang`, `barang`, `harga_beli`, `harga_barang`, `harga_reseller`, `deskripsi`, `diskon`, `tampil`) VALUES
	(3, 5, 'BRG00003', 'bomber man', 20000, 35000, 0, 'bomber mantab sampek tulang', 20, 'Y'),
	(4, 1, 'BRG00004', 'kemeja hitam', 15000, 20000, NULL, 'kemeja hitam mantab', 10, 'N'),
	(5, 5, 'BRG00005', 'bomber man', 20000, 35000, NULL, 'bomber mantab sampek tulang', 20, 'N'),
	(6, 12, 'BRG00006', 'celana dalam', 8000, 10000, 9000, '<p>mantabs enak bingits</p>', 0, 'N'),
	(7, 10, 'BRG00007', 'syemfak bhuhulak', 15000, 20000, NULL, '<p>halo halohadsfkjl</p>', 0, 'Y'),
	(8, 1, 'BRG00008', 'kemeja hitam', 15000, 20000, NULL, 'kemeja hitam mantab', 10, 'Y'),
	(9, 5, 'BRG00009', 'bomber man', 20000, 35000, 30000, '<p>bomber mantab sampek tulang</p>', 20, 'Y'),
	(10, 1, 'BRG00010', 'cok cok cok', 15000, 25000, 20000, '<p>asdklfjklasdfklasdfjiasdfjkl;asdfie</p>', 0, 'Y'),
	(11, 1, 'BRG00011', 'kemeja hitam', 15000, 20000, 18000, 'bahan mulus, murmer', 10, 'N');
/*!40000 ALTER TABLE `tb_kodes` ENABLE KEYS */;

-- Dumping structure for table ta_store.tb_stokawals
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

-- Dumping data for table ta_store.tb_stokawals: ~0 rows (approximately)
DELETE FROM `tb_stokawals`;
/*!40000 ALTER TABLE `tb_stokawals` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_stokawals` ENABLE KEYS */;

-- Dumping structure for table ta_store.tb_tambahstoks
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table ta_store.tb_tambahstoks: ~7 rows (approximately)
DELETE FROM `tb_tambahstoks`;
/*!40000 ALTER TABLE `tb_tambahstoks` DISABLE KEYS */;
INSERT INTO `tb_tambahstoks` (`id`, `idwarna`, `idadmin`, `kode_barang`, `jumlah`, `total`, `tgl`, `keterangan`, `aksi`) VALUES
	(1, 22, 10, 'BRG00009', 1, 20000, '2019-03-17', 'restock', 'tambah'),
	(2, 21, 10, 'BRG00009', 2, 70000, '2019-03-17', 'di beli tetangga', 'kurangi'),
	(3, 24, 10, 'BRG00009', 2, 10000, '2019-03-19', 'menambah pertama kali', 'tambah'),
	(4, 25, 10, 'BRG00010', 10, 150000, '2019-03-21', 'menambah pertama kali', 'tambah'),
	(5, 26, 10, 'BRG00010', 10, 150000, '2019-03-21', 'menambah pertama kali', 'tambah'),
	(6, 27, 10, 'BRG00011', 10, 150000, '2019-03-21', 'menambah pertama kali', 'tambah'),
	(7, 28, 10, 'BRG00011', 10, 150000, '2019-03-21', 'menambah pertama kali', 'tambah');
/*!40000 ALTER TABLE `tb_tambahstoks` ENABLE KEYS */;

-- Dumping structure for table ta_store.tb_transaksis
DROP TABLE IF EXISTS `tb_transaksis`;
CREATE TABLE IF NOT EXISTS `tb_transaksis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) DEFAULT NULL,
  `faktur` varchar(300) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `status` enum('terkirim','dibaca','diterima','ditolak','sukses','batal') DEFAULT NULL,
  `alamat_tujuan` text,
  `admin` varchar(100) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `ongkir` int(11) DEFAULT '0',
  `potongan` int(11) DEFAULT '0',
  `total_akhir` int(11) DEFAULT NULL,
  `pembayaran` varchar(50) DEFAULT NULL,
  `keterangan` text,
  `metode` enum('pesan','langsung') DEFAULT 'pesan',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- Dumping data for table ta_store.tb_transaksis: ~8 rows (approximately)
DELETE FROM `tb_transaksis`;
/*!40000 ALTER TABLE `tb_transaksis` DISABLE KEYS */;
INSERT INTO `tb_transaksis` (`id`, `iduser`, `faktur`, `tgl`, `status`, `alamat_tujuan`, `admin`, `total`, `ongkir`, `potongan`, `total_akhir`, `pembayaran`, `keterangan`, `metode`) VALUES
	(17, NULL, 'STA170319-10-000001', '2019-03-17', NULL, NULL, '10', NULL, 0, 0, 18000, NULL, NULL, 'langsung'),
	(18, 5, 'ST17031900001', '2019-03-17', 'sukses', 'babatan, JLN iwak enak no 1', NULL, 10000, 2000, 0, 12000, '2', 'dfd', 'pesan'),
	(19, NULL, 'STA190319-10-000001', '2019-03-19', NULL, NULL, '10', NULL, 0, 3000, 45000, NULL, NULL, 'langsung'),
	(20, NULL, 'STA190319-10-000002', '2019-03-19', NULL, NULL, '10', 28000, 0, 2000, 26000, NULL, NULL, 'langsung'),
	(21, NULL, 'STA190319-10-000003', '2019-03-19', NULL, NULL, '10', 56000, 0, 2000, 54000, NULL, NULL, 'langsung'),
	(22, NULL, 'STA190319-10-000004', '2019-03-19', NULL, NULL, '10', 56000, 0, 2000, 54000, NULL, NULL, 'langsung'),
	(23, NULL, 'STA190319-10-000005', '2019-03-19', NULL, NULL, '10', 28000, 0, 10000, 18000, NULL, NULL, 'langsung'),
	(24, 5, 'ST20031900001', '2019-03-20', 'sukses', 'babatan, JLN iwak enak no 1', NULL, 20000, 2000, 5000, 17000, '1', 'sdf', 'pesan'),
	(25, NULL, 'STA210319-10-000001', '2019-03-21', NULL, NULL, '10', 52000, 0, 2000, 50000, NULL, NULL, 'langsung');
/*!40000 ALTER TABLE `tb_transaksis` ENABLE KEYS */;

-- Dumping structure for table ta_store.tb_users
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table ta_store.tb_users: ~6 rows (approximately)
DELETE FROM `tb_users`;
/*!40000 ALTER TABLE `tb_users` DISABLE KEYS */;
INSERT INTO `tb_users` (`id`, `username`, `password`, `email`, `telp`, `nama`, `alamat`, `kota`, `provinsi`, `kodepos`, `level`, `ktp_gmb`, `cancel`) VALUES
	(1, 'jianfitri', '$2y$10$7OFfX7UYIFIg5eZqfHEm/.kGniFHkqVE6/Avzcze7GuOfVjxB3n9e', 'jian@gmail.com', '023498290348', 'jian fitri aprilia', 'gurah kediri', 'kediri lagi', 'aceh', '09348', 'biasa', '1547635500-2.jpg', 0),
	(3, 'fauziahmad', '$2y$10$w/H3R1TZdbwYWAGas981seTeBK02UqvEf53lyddI92yeDxy4N7C0K', 'ahmad@gmail.com', '023899009', 'ahmad fauzi tamvan', 'loceret ngnyuk', 'loceret', 'jakarta', '00002', 'biasa', '1547641123-13.jpg', 0),
	(4, 'adisasmito', '$2y$10$gNTRQ2/NHO2AA.lhJ/lbu.H6Arh/RxFJyT3Tyw2Bg2QhUp8VnxNJe', 'heru@gmail.com', '0238490238', 'heru adi sasmito', 'kediri gurah', 'kediri', 'aceh', '023948', 'biasa', '1547646632-10.jpg', 0),
	(5, 'rinookta', '$2y$10$1fnkv00urRNJCtod6izMYuB2kj9LTScqNxWS27RmhXdiAqD6w4t7q', 'rino@gmail.com', '0859874929890', 'rino oktavian', 'babatan, JLN iwak enak no 1', 'kediri', 'jawa timur', '03498', 'reseller', '1547814815-contohktp.png', 2),
	(7, 'lina mr', '$2y$10$0Q5mdnI7gJ3FY4fW.ap0oO6aLGjgFA5q4ZZaA.Fqeh74xNlgJ89IG', 'linamr123@gmail.com', '081249745314', NULL, NULL, NULL, NULL, NULL, 'biasa', NULL, 0),
	(8, 'usercokk', '$2y$10$EXvToRzpRt8CatI2ZMRjweg0QZC9fryDP26zkqxREIyu1aqemjs/u', 'cok@gmail.com', '08592834904820', 'coba user cookkkkk', 'gurah cok', 'kediri cok', 'yogyakarta', '293048', 'reseller', '1553168033-6.jpg', 0);
/*!40000 ALTER TABLE `tb_users` ENABLE KEYS */;

-- Dumping structure for table ta_store.tb_varian
DROP TABLE IF EXISTS `tb_varian`;
CREATE TABLE IF NOT EXISTS `tb_varian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_v` varchar(50) DEFAULT '0',
  `varian` varchar(50) DEFAULT '0',
  `hex` varchar(50) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table ta_store.tb_varian: 5 rows
DELETE FROM `tb_varian`;
/*!40000 ALTER TABLE `tb_varian` DISABLE KEYS */;
INSERT INTO `tb_varian` (`id`, `kode_v`, `varian`, `hex`) VALUES
	(3, '03', 'Biru', '0'),
	(4, '04', 'Hijau', '0'),
	(5, '05', 'biru muda', '#00ffff'),
	(6, '06', 'hijau daun', '#40bf56'),
	(7, '07', 'merah muda', '#c82bd5');
/*!40000 ALTER TABLE `tb_varian` ENABLE KEYS */;

-- Dumping structure for trigger ta_store.add_stok
DROP TRIGGER IF EXISTS `add_stok`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `add_stok` AFTER INSERT ON `tb_tambahstoks` FOR EACH ROW update tb_barangs set stok=stok+new.jumlah where idbarang=new.idwarna//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger ta_store.in_stok
DROP TRIGGER IF EXISTS `in_stok`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `in_stok` AFTER INSERT ON `detail_cancel` FOR EACH ROW update tb_barangs set stok=stok+new.jumlah where idbarang=new.idwarna//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger ta_store.keranjang_dihapus
DROP TRIGGER IF EXISTS `keranjang_dihapus`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `keranjang_dihapus` AFTER INSERT ON `keranjang_cancel` FOR EACH ROW BEGIN
update tb_barangs set stok=stok+new.jumlah where idbarang=new.idbarang;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger ta_store.min_stok
DROP TRIGGER IF EXISTS `min_stok`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `min_stok` AFTER INSERT ON `tb_details` FOR EACH ROW update tb_barangs set stok=stok-new.jumlah where idbarang=new.idwarna//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
