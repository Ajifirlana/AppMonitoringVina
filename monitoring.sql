-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 5.7.33 - MySQL Community Server (GPL)
-- OS Server:                    Win64
-- HeidiSQL Versi:               11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Membuang struktur basisdata untuk monitoring tugas
CREATE DATABASE IF NOT EXISTS `monitoring tugas` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `monitoring tugas`;

-- membuang struktur untuk table monitoring tugas.databidang
CREATE TABLE IF NOT EXISTS `databidang` (
  `id_komentar` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `isi_komentar` text,
  `id_berita` tinytext,
  `tgl` date DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `tampil` varchar(10) DEFAULT 'N',
  PRIMARY KEY (`id_komentar`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel monitoring tugas.databidang: ~5 rows (lebih kurang)
/*!40000 ALTER TABLE `databidang` DISABLE KEYS */;
INSERT INTO `databidang` (`id_komentar`, `nama_lengkap`, `isi_komentar`, `id_berita`, `tgl`, `jam`, `tampil`) VALUES
	(6, 'Promosi  kesehatan  (promkes)', '<p>semangat pejuang wabah&nbsp;!!</p>\r\n', '35', '2017-03-29', '08:17:20', 'Public'),
	(7, 'Surveylains', '<p>artikelnya bagus, sangat membantu dalam pelayanan informasi.. terima kasih</p>\r\n\r\n<p>dan jangan lupa update informasi terbaru ya</p>\r\n', '31', '2017-03-30', '11:26:01', 'Private'),
	(8, 'Kesehatan ibu dan anak', NULL, NULL, NULL, NULL, 'N'),
	(22, 'Perkesmas', NULL, NULL, NULL, NULL, 'N'),
	(23, 'Kesehatan Lingkungan', NULL, NULL, NULL, NULL, 'N');
/*!40000 ALTER TABLE `databidang` ENABLE KEYS */;

-- membuang struktur untuk table monitoring tugas.kegiatan
CREATE TABLE IF NOT EXISTS `kegiatan` (
  `id_berita` int(11) NOT NULL AUTO_INCREMENT,
  `capaian` varchar(10000) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `keterangan` varchar(1000) NOT NULL,
  `anggota` varchar(50) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `created_at` date NOT NULL,
  `username` varchar(100) NOT NULL,
  `create_by` varchar(10) NOT NULL,
  PRIMARY KEY (`id_berita`)
) ENGINE=MyISAM AUTO_INCREMENT=240 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel monitoring tugas.kegiatan: 2 rows
/*!40000 ALTER TABLE `kegiatan` DISABLE KEYS */;
INSERT INTO `kegiatan` (`id_berita`, `capaian`, `kategori`, `keterangan`, `anggota`, `image`, `created_at`, `username`, `create_by`) VALUES
	(238, 'tes', 'Promosi  kesehatan  (promkes)', 'tess', '', 'login.png', '2023-06-14', 'Admin', '1'),
	(239, 'nama penugas', 'Promosi  kesehatan  (promkes)', '72657/AJI', '', 'login1.png', '2023-06-14', 'Admin', '1');
/*!40000 ALTER TABLE `kegiatan` ENABLE KEYS */;

-- membuang struktur untuk table monitoring tugas.kegiatan_user
CREATE TABLE IF NOT EXISTS `kegiatan_user` (
  `id_berita` int(11) NOT NULL AUTO_INCREMENT,
  `capaian` varchar(10000) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `Validasi` varchar(50) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `created_at` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `create_by` varchar(10) NOT NULL,
  PRIMARY KEY (`id_berita`)
) ENGINE=MyISAM AUTO_INCREMENT=209 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel monitoring tugas.kegiatan_user: 1 rows
/*!40000 ALTER TABLE `kegiatan_user` DISABLE KEYS */;
INSERT INTO `kegiatan_user` (`id_berita`, `capaian`, `kategori`, `keterangan`, `Validasi`, `image`, `created_at`, `username`, `create_by`) VALUES
	(208, '', 'Promosi  kesehatan  (promkes)', 'ni kegiatan ku', NULL, 'kegiatan.png', '2023-06-14', 'Pegawai', '30');
/*!40000 ALTER TABLE `kegiatan_user` ENABLE KEYS */;

-- membuang struktur untuk table monitoring tugas.user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `level` varchar(10) DEFAULT NULL,
  `kategori` varchar(30) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel monitoring tugas.user: ~3 rows (lebih kurang)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id_user`, `username`, `password`, `level`, `kategori`) VALUES
	(1, 'Admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', ''),
	(29, 'Korwas', '21232f297a57a5a743894a0e4a801fc3', 'Korwas', 'Kesehatan Lingkungan'),
	(30, 'Pegawai', '21232f297a57a5a743894a0e4a801fc3', 'Pegawai', 'Promosi  kesehatan  (promkes)');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
