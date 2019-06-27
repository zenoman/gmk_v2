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


-- Dumping database structure for gmk_new
DROP DATABASE IF EXISTS `gmk_new`;
CREATE DATABASE IF NOT EXISTS `gmk_new` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `gmk_new`;

-- Dumping structure for table gmk_new.admins
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

-- Dumping data for table gmk_new.admins: ~8 rows (approximately)
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

-- Dumping structure for table gmk_new.detail_cancel
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

-- Dumping data for table gmk_new.detail_cancel: ~0 rows (approximately)
DELETE FROM `detail_cancel`;
/*!40000 ALTER TABLE `detail_cancel` DISABLE KEYS */;
/*!40000 ALTER TABLE `detail_cancel` ENABLE KEYS */;

-- Dumping structure for table gmk_new.gambar
DROP TABLE IF EXISTS `gambar`;
CREATE TABLE IF NOT EXISTS `gambar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(30) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table gmk_new.gambar: ~10 rows (approximately)
DELETE FROM `gambar`;
/*!40000 ALTER TABLE `gambar` DISABLE KEYS */;
INSERT INTO `gambar` (`id`, `kode_barang`, `nama`) VALUES
	(1, 'BRG00001', '1561169422-ba11.png'),
	(2, 'BRG00001', '1561169425-ba12.png'),
	(3, 'BRG00001', '1561169427-ba21.png'),
	(4, 'BRG00001', '1561169428-ba22.png'),
	(5, 'BRG00003', '1561260024-fa4.jpg'),
	(6, 'BRG00003', '1561260025-fa5.jpg'),
	(7, 'BRG00003', '1561260026-fa6.jpg'),
	(8, 'BRG00002', '1561260083-gmk1561258794258.jpg'),
	(9, 'BRG00002', '1561260084-gmk1561258797892.jpg'),
	(10, 'BRG00002', '1561260085-gmk1561258884646.jpg');
/*!40000 ALTER TABLE `gambar` ENABLE KEYS */;

-- Dumping structure for table gmk_new.kategori_artikel
DROP TABLE IF EXISTS `kategori_artikel`;
CREATE TABLE IF NOT EXISTS `kategori_artikel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(80) DEFAULT '0',
  `edit` enum('Y','N') DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table gmk_new.kategori_artikel: ~4 rows (approximately)
DELETE FROM `kategori_artikel`;
/*!40000 ALTER TABLE `kategori_artikel` DISABLE KEYS */;
INSERT INTO `kategori_artikel` (`id`, `nama`, `edit`) VALUES
	(1, 'info reseller', 'Y'),
	(2, 'promo', 'Y'),
	(3, 'halo', 'Y'),
	(4, 'testimoni', 'N');
/*!40000 ALTER TABLE `kategori_artikel` ENABLE KEYS */;

-- Dumping structure for table gmk_new.keranjang_cancel
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table gmk_new.keranjang_cancel: ~0 rows (approximately)
DELETE FROM `keranjang_cancel`;
/*!40000 ALTER TABLE `keranjang_cancel` DISABLE KEYS */;
/*!40000 ALTER TABLE `keranjang_cancel` ENABLE KEYS */;

-- Dumping structure for table gmk_new.log_cancel
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

-- Dumping data for table gmk_new.log_cancel: ~0 rows (approximately)
DELETE FROM `log_cancel`;
/*!40000 ALTER TABLE `log_cancel` DISABLE KEYS */;
/*!40000 ALTER TABLE `log_cancel` ENABLE KEYS */;

-- Dumping structure for table gmk_new.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table gmk_new.migrations: ~0 rows (approximately)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table gmk_new.omset
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

-- Dumping data for table gmk_new.omset: ~0 rows (approximately)
DELETE FROM `omset`;
/*!40000 ALTER TABLE `omset` DISABLE KEYS */;
/*!40000 ALTER TABLE `omset` ENABLE KEYS */;

-- Dumping structure for table gmk_new.settings
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

-- Dumping data for table gmk_new.settings: ~1 rows (approximately)
DELETE FROM `settings`;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`idsettings`, `webName`, `kontak1`, `kontak2`, `kontak3`, `email`, `ico`, `meta`, `logo`, `keterangan`, `alamat`, `nama_toko`, `max_tgl`, `peraturan`, `bulansistem`) VALUES
	(1, 'Grosir Murah Kediri', '+6285816900612', '+6281553860046', '+6285856044060', 'bayukhoirul1@gmail.com', '1547722245-dvinafavicon.png', 'Fashion murah meriah berkualitas', '1543717647-logo-dvina.png', 'store tulungagung adalah toko ecer / grosir yang telah terbukti memiliki harga dan kwalitas terbaik\r\nopen reseller , dropshiper, agen. store tulungagung selalu berusaha memberikan pelayanan terbaik kepada pembeli. dan banyak potongan harga untuk pembelian lebih dari 3pcs.', 'Dsn.Jatirejo RT01/RW02 Ds.Tenggur Kec.Rejotangan Kab.Tulungagung', NULL, 7, '<ol><li>pastikan telah menjadi member StoreTulungagung</li><li>pastikan melakukan pemesanan / keep barang sampai masuk pada W.A admin</li><li>jangan lupa bayar setelah beli produk</li><li>setiap barang yang telah di masukan keranjang akan hilang secara otomatis apabila tidak di beli dalam jangka waktu 7hari</li><li>Happy Shopping gengs</li></ol>', 6);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;

-- Dumping structure for table gmk_new.sliders
DROP TABLE IF EXISTS `sliders`;
CREATE TABLE IF NOT EXISTS `sliders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) DEFAULT NULL,
  `deskripsi` text,
  `foto` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table gmk_new.sliders: ~4 rows (approximately)
DELETE FROM `sliders`;
/*!40000 ALTER TABLE `sliders` DISABLE KEYS */;
INSERT INTO `sliders` (`id`, `judul`, `deskripsi`, `foto`) VALUES
	(1, 'ini slide 1', 'Promo semua kemeja flanel dan salur, diskon 10% dan stok melimpah', '1561293277-gmk1561258797892.jpg'),
	(2, 'Info Jaket Hodie Polos', 'Tanggal 20 stok jaket hoodie polos bakal dateng lagi, buruan cus sembelum kehabisan', '1561293329-gmk1561258884646.jpg'),
	(3, 'ini slide 3', NULL, '1561293368-gmk1561258894334.jpg'),
	(4, 'Kemeja Murah', 'Promo semua kemeja flanel dan salur, diskon 10% dan stok melimpah', '1561414055-gmk1561258887607.jpg');
/*!40000 ALTER TABLE `sliders` ENABLE KEYS */;

-- Dumping structure for table gmk_new.tb_artikel
DROP TABLE IF EXISTS `tb_artikel`;
CREATE TABLE IF NOT EXISTS `tb_artikel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(150) DEFAULT NULL,
  `link` varchar(150) DEFAULT NULL,
  `isi` text,
  `tgl` date DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `id_penulis` int(11) DEFAULT NULL,
  `dilihat` int(11) DEFAULT '0',
  `gambar` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table gmk_new.tb_artikel: ~4 rows (approximately)
DELETE FROM `tb_artikel`;
/*!40000 ALTER TABLE `tb_artikel` DISABLE KEYS */;
INSERT INTO `tb_artikel` (`id`, `judul`, `link`, `isi`, `tgl`, `id_kategori`, `id_penulis`, `dilihat`, `gambar`) VALUES
	(1, 'Diskon 10% jaket polos', 'diskon-10%-jaket-polos', '<p>sign up now to our newsletter discount! to get the Welcome discount sign up now to our newsletter discount! to get the Welcome discount sign up now to our newsletter discount! to get the Welcome discount sign up now to our newsletter discount! to get the Welcome discount</p><p><strong>sign up now to our newsletter discount!</strong> to get the Welcome discount sign up now to our newsletter discount! to get the Welcome discount sign up now to our newsletter discount! to get the Welcome discount sign up now to our newsletter discount! to get the Welcome discount</p>', '2019-06-23', 1, 10, 0, '1561261185-1544675574-hijab-muslimah-murah-ramadhan.jpg'),
	(2, 'Preorder jadi pilihan', 'preorder-jadi-pilihan', '<p>sign up now to our newsletter discount! to get the Welcome discount sign up now to our newsletter discount! to get the Welcome discount sign up now to our newsletter discount! to get the Welcome discount sign up now to our newsletter discount! to get the Welcome discount</p><p><strong>sign up now to our newsletter discount! to get the Welcome</strong> discount sign up now to our newsletter discount! to get the Welcome discount sign up now to our newsletter discount! to get the Welcome discount sign up now to our newsletter discount! to get the Welcome discountsign up now to our newsletter discount! to get the Welcome discount sign up now to our newsletter discount! to get the Welcome discount sign up now to our newsletter discount! to get the Welcome discount sign up now to our newsletter discount! to get the Welcome discount</p>', '2019-06-23', 3, 10, 2, '1561261269-1548724725-tabanner2.jpg'),
	(3, 'coming soon kaos polos premium', 'coming-soon-kaos-polos-premium', '<p>sign up now to our newsletter discount! to get the Welcome discount sign up now to our newsletter discount! to get the Welcome discount sign up now to our newsletter discount! to get the Welcome discount sign up now to our newsletter discount! to get the Welcome discount</p><p>sign up now to our newsletter discount! to get the Welcome discount sign up now to our newsletter discount! to get the Welcome discount sign up now to our newsletter discount! to get the Welcome discount sign up now to our newsletter discount! to get the Welcome discountsign up now to our newsletter discount! to get the Welcome discount sign up now to our newsletter discount! to get the Welcome discount sign up now to our newsletter discount! to get the Welcome discount sign up now to our newsletter discount! to get the Welcome discount</p>', '2019-06-23', 2, 10, 0, '1561261337-1548724768-tabanner3.jpg'),
	(4, 'coba testi', 'coba-testi', '<p>sign up now to our newsletter discount! to get the Welcome discount sign up now to our newsletter discount! to get the Welcome discount sign up now to our newsletter discount! to get the Welcome disign up now to our newsletter discount! to get the Welcome discount sign up now to our newsletter discount! to get the Welcome discount sign up now to our newsletter discount! to get the Welcome disign up now to our newsletter discount! to get the Welcome discount sign up now to our newsletter discount! to get the Welcome discount sign up now to our newsletter discount! to get the Welcome disign up now to our newsletter discount! to get the Welcome discount sign up now to our newsletter discount! to get the Welcome discount sign up now to our newsletter discount! to get the Welcome di</p><p>sign up now to our newsletter discount! to get the Welcome discount sign up now to our newsletter discount! to get the Welcome discount sign up now to our newsletter discount! to get the Welcome disign up now to our newsletter discount! to get the Welcome discount sign up now to our newsletter discount! to get the Welcome discount sign up now to our newsletter discount! to get the Welcome di</p>', '2019-06-27', 4, 10, 0, '1561600916-1544675484-diskon.jpg');
/*!40000 ALTER TABLE `tb_artikel` ENABLE KEYS */;

-- Dumping structure for table gmk_new.tb_bank
DROP TABLE IF EXISTS `tb_bank`;
CREATE TABLE IF NOT EXISTS `tb_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_bank` varchar(40) DEFAULT NULL,
  `rekening` varchar(40) DEFAULT NULL,
  `atasnama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table gmk_new.tb_bank: ~4 rows (approximately)
DELETE FROM `tb_bank`;
/*!40000 ALTER TABLE `tb_bank` DISABLE KEYS */;
INSERT INTO `tb_bank` (`id`, `nama_bank`, `rekening`, `atasnama`) VALUES
	(1, 'bayar ditoko\r\n', '-', '-'),
	(2, 'mandiri Syariah', '09737897890', 'storeta'),
	(3, 'BRI', '902890890', 'storeta'),
	(4, 'bank jatim', '09890890890', 'storeta');
/*!40000 ALTER TABLE `tb_bank` ENABLE KEYS */;

-- Dumping structure for table gmk_new.tb_barangs
DROP TABLE IF EXISTS `tb_barangs`;
CREATE TABLE IF NOT EXISTS `tb_barangs` (
  `idbarang` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(100) DEFAULT NULL,
  `kode_v` varchar(100) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `warna` varchar(45) DEFAULT NULL,
  `barang_jenis` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`idbarang`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table gmk_new.tb_barangs: ~6 rows (approximately)
DELETE FROM `tb_barangs`;
/*!40000 ALTER TABLE `tb_barangs` DISABLE KEYS */;
INSERT INTO `tb_barangs` (`idbarang`, `kode`, `kode_v`, `stok`, `warna`, `barang_jenis`) VALUES
	(1, 'BRG00001', '02', 5, 'm', 'kaos polos m'),
	(2, 'BRG00001', '03', 15, 'xl', 'kaos polos xl'),
	(3, 'BRG00002', '02', 10, 'L', 'jaket polos L'),
	(4, 'BRG00002', '01', 5, 'M', 'jaket polos M'),
	(5, 'BRG00003', '04', 20, 'X', 'kaos salur X'),
	(6, 'BRG00003', '05', 10, 'XXL', 'kaos salur XXL');
/*!40000 ALTER TABLE `tb_barangs` ENABLE KEYS */;

-- Dumping structure for table gmk_new.tb_details
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table gmk_new.tb_details: ~0 rows (approximately)
DELETE FROM `tb_details`;
/*!40000 ALTER TABLE `tb_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_details` ENABLE KEYS */;

-- Dumping structure for table gmk_new.tb_kategoris
DROP TABLE IF EXISTS `tb_kategoris`;
CREATE TABLE IF NOT EXISTS `tb_kategoris` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(100) DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table gmk_new.tb_kategoris: ~5 rows (approximately)
DELETE FROM `tb_kategoris`;
/*!40000 ALTER TABLE `tb_kategoris` DISABLE KEYS */;
INSERT INTO `tb_kategoris` (`id`, `kategori`, `gambar`) VALUES
	(3, 'kemeja', '1561169319-pi11.jpg'),
	(4, 'kaos oblong', '1561169343-ba22.png'),
	(5, 'kemeja cewek', '1561259069-fa6.jpg'),
	(6, 'jaket hoodie', '1561259103-ba21.png'),
	(7, 'kaos cewek', '1561259134-fa7.jpg');
/*!40000 ALTER TABLE `tb_kategoris` ENABLE KEYS */;

-- Dumping structure for table gmk_new.tb_kodes
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table gmk_new.tb_kodes: ~3 rows (approximately)
DELETE FROM `tb_kodes`;
/*!40000 ALTER TABLE `tb_kodes` DISABLE KEYS */;
INSERT INTO `tb_kodes` (`id`, `id_kategori`, `kode_barang`, `barang`, `harga_beli`, `harga_barang`, `harga_reseller`, `deskripsi`, `diskon`, `tampil`) VALUES
	(1, 4, 'BRG00001', 'kaos polos', 20000, 30000, 25000, '<p>asdfasdfasfd</p>', 0, 'Y'),
	(2, 6, 'BRG00002', 'jaket polos ', 70000, 85000, 80000, 'kemja mantul mantab jiwa', 15, 'Y'),
	(3, 7, 'BRG00003', 'kaos salur', 40000, 60000, 55000, 'kaos premum harga medium', 0, 'Y');
/*!40000 ALTER TABLE `tb_kodes` ENABLE KEYS */;

-- Dumping structure for table gmk_new.tb_stokawals
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

-- Dumping data for table gmk_new.tb_stokawals: ~0 rows (approximately)
DELETE FROM `tb_stokawals`;
/*!40000 ALTER TABLE `tb_stokawals` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_stokawals` ENABLE KEYS */;

-- Dumping structure for table gmk_new.tb_tambahstoks
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table gmk_new.tb_tambahstoks: ~6 rows (approximately)
DELETE FROM `tb_tambahstoks`;
/*!40000 ALTER TABLE `tb_tambahstoks` DISABLE KEYS */;
INSERT INTO `tb_tambahstoks` (`id`, `idwarna`, `idadmin`, `kode_barang`, `jumlah`, `total`, `tgl`, `keterangan`, `aksi`) VALUES
	(1, 1, 10, 'BRG00001', 5, 100000, '2019-06-22', 'menambah pertama kali', 'tambah'),
	(2, 2, 10, 'BRG00001', 15, 300000, '2019-06-22', 'menambah pertama kali', 'tambah'),
	(3, 3, 10, 'BRG00002', 10, 350000, '2019-06-23', 'menambah pertama kali', 'tambah'),
	(4, 4, 10, 'BRG00002', 5, 350000, '2019-06-23', 'menambah pertama kali', 'tambah'),
	(5, 5, 10, 'BRG00003', 20, 400000, '2019-06-23', 'menambah pertama kali', 'tambah'),
	(6, 6, 10, 'BRG00003', 10, 400000, '2019-06-23', 'menambah pertama kali', 'tambah');
/*!40000 ALTER TABLE `tb_tambahstoks` ENABLE KEYS */;

-- Dumping structure for table gmk_new.tb_transaksis
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table gmk_new.tb_transaksis: ~0 rows (approximately)
DELETE FROM `tb_transaksis`;
/*!40000 ALTER TABLE `tb_transaksis` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_transaksis` ENABLE KEYS */;

-- Dumping structure for table gmk_new.tb_users
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

-- Dumping data for table gmk_new.tb_users: ~3 rows (approximately)
DELETE FROM `tb_users`;
/*!40000 ALTER TABLE `tb_users` DISABLE KEYS */;
INSERT INTO `tb_users` (`id`, `username`, `password`, `email`, `telp`, `nama`, `alamat`, `kota`, `provinsi`, `kodepos`, `level`, `ktp_gmb`, `cancel`) VALUES
	(1, 'jianfitri', '$2y$10$lzwpAHH/1XazX.datgWJDO9f51y2oBWbQlTviAjb3/.o2fTjTsFQi', 'jian@gmail.com', '0856045567140', 'jian fitri aprilia', 'gurah kediri', 'kediri', 'jawa timur', '0934', 'reseller', '1554002975-kaos1.jpeg', 0),
	(2, 'rinookta', '$2y$10$YfN61LOcjeLTrz.EOrNJCuj2LCOkFJa8wuUhGsmDqUE6gdXLaV32.', 'rino@gmail.com', '2093842903', 'rino oktavian', 'sjadklfjskladfjklsadfjl', 'kediri', 'jawa tengah', '2039489', 'reseller', '1554003122-kaos5.jpg', 0),
	(3, 'bayucoba', '$2y$10$bKLhgxUoZMRdMR/KYrDyk.L/C90hWCWKX0FC.JilqE82VVvNUr9lC', 'bayukhoirul1@gmail.com', '085123456789', 'bayucoba', 'abcdefghij', 'tulung agung', 'jawa Timur', '0852741', 'biasa', NULL, 0);
/*!40000 ALTER TABLE `tb_users` ENABLE KEYS */;

-- Dumping structure for table gmk_new.tb_varian
DROP TABLE IF EXISTS `tb_varian`;
CREATE TABLE IF NOT EXISTS `tb_varian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_v` varchar(50) DEFAULT '0',
  `varian` varchar(50) DEFAULT '0',
  `hex` varchar(50) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table gmk_new.tb_varian: 6 rows
DELETE FROM `tb_varian`;
/*!40000 ALTER TABLE `tb_varian` DISABLE KEYS */;
INSERT INTO `tb_varian` (`id`, `kode_v`, `varian`, `hex`) VALUES
	(2, '01', 'merah', '#fb0429'),
	(3, '02', 'biru', '#3914eb'),
	(4, '03', 'hitam', '#000000'),
	(6, '04', 'orange', '#ff8000'),
	(7, '05', 'biru laut', '#0080ff'),
	(8, '06', 'hijau muda', '#00ff00');
/*!40000 ALTER TABLE `tb_varian` ENABLE KEYS */;

-- Dumping structure for trigger gmk_new.add_stok
DROP TRIGGER IF EXISTS `add_stok`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `add_stok` AFTER INSERT ON `tb_tambahstoks` FOR EACH ROW update tb_barangs set stok=stok+new.jumlah where idbarang=new.idwarna//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger gmk_new.in_stok
DROP TRIGGER IF EXISTS `in_stok`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `in_stok` AFTER INSERT ON `detail_cancel` FOR EACH ROW update tb_barangs set stok=stok+new.jumlah where idbarang=new.idwarna//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger gmk_new.keranjang_dihapus
DROP TRIGGER IF EXISTS `keranjang_dihapus`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `keranjang_dihapus` AFTER INSERT ON `keranjang_cancel` FOR EACH ROW BEGIN
update tb_barangs set stok=stok+new.jumlah where idbarang=new.idbarang;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger gmk_new.min_stok
DROP TRIGGER IF EXISTS `min_stok`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `min_stok` AFTER INSERT ON `tb_details` FOR EACH ROW update tb_barangs set stok=stok-new.jumlah where idbarang=new.idwarna//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
