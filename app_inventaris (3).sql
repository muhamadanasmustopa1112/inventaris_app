-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2021 at 07:01 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app_inventaris`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_umum`
--

CREATE TABLE `data_umum` (
  `id` int(11) NOT NULL,
  `nama_intenal` varchar(255) NOT NULL,
  `nama_ekstenal` varchar(255) NOT NULL,
  `keteangan` varchar(255) NOT NULL,
  `sasaran_layanan` varchar(255) NOT NULL,
  `kategori_sistem` varchar(255) NOT NULL,
  `kategori_akses` varchar(255) NOT NULL,
  `alamar_url` varchar(255) NOT NULL,
  `publikasi` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `id_verifikasi` int(11) NOT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_umum`
--

INSERT INTO `data_umum` (`id`, `nama_intenal`, `nama_ekstenal`, `keteangan`, `sasaran_layanan`, `kategori_sistem`, `kategori_akses`, `alamar_url`, `publikasi`, `image`, `id_verifikasi`, `id_users`) VALUES
(1, 'Website BKPSDM', 'BKPSDM Kabupaten Majalengka', 'Website resmi bpksdm majalengka untuk meakukan pengumuman, pelayanan online dan membagikan dokumentasi kegiatan', 'Regional', 'Tinggi', 'Online', 'https://bkpsdm.majalengkakab.go.id', 'Ya', 'ss_bkpsdm1.png', 3, 7),
(2, 'System absensi PNS Majalengka', 'System absensi PNS Majalengka', 'System absensi adalah software berbasis android yang dibuat guna mengelola data absensi PNS/CPNS yang terintegrasi dengan pusat', 'Regional', 'Strategis', 'Online', 'https://play.google.com/store/apps/details?id=id.co.easystem.absensipnsmjl', 'Ya', '10929.jpg', 1, 12),
(3, 'JDIH DPRD Majalengka', 'JDIH DPRD Majalengka', 'Website JDIH DPRD Kabupaten SUMEDANG dikelola oleh Sekretariat DPRD yang diharapkan dapat berperan sebagai media sosialisasi dan penyebaran informasi produk Hukum Daerah secara lengkap, mudah, cepat dan akurat bagi seluruh masyarakat yang membutuhkannya', 'Regional', 'Tinggi', 'Online', 'https://jdih.dprd.majalengkakab.go.id', 'Ya', 'messageImage_1626585803431.jpg', 2, 12),
(4, 'Website BKPSDM', 'BKPSDM', 'Website resmi bpksdm majalengka untuk meakukan pengumuman, pelayanan online dan membagikan dokumentasi kegiatan', 'Regional', 'Strategis', 'Online', 'https://bkpsdm.majalengkakab.go.id', 'Ya', 'messageImage_16265858034311.jpg', 2, 12);

--
-- Triggers `data_umum`
--
DELIMITER $$
CREATE TRIGGER `afterEdit` AFTER UPDATE ON `data_umum` FOR EACH ROW INSERT INTO log_edit VALUES(null, OLD.id, OLD.nama_intenal, OLD.nama_ekstenal, OLD.keteangan, OLD.sasaran_layanan, OLD.kategori_sistem, OLD.kategori_akses, OLD.alamar_url, OLD.publikasi, OLD.image, OLD.id_verifikasi, OLD.id_users, NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `fitur`
--

CREATE TABLE `fitur` (
  `id` int(11) NOT NULL,
  `nama_fitur` varchar(255) NOT NULL,
  `keterangan_fitur` varchar(255) NOT NULL,
  `id_aplikasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fitur`
--

INSERT INTO `fitur` (`id`, `nama_fitur`, `keterangan_fitur`, `id_aplikasi`) VALUES
(1, 'Menampilkan informasi terkait BKPSDM', 'Menampilkan persyaratan layanan untuk BKPSDM, dokumentasi, berita dan lainnya', 1),
(2, 'Absensi harian', 'Melakukan absensi harian yang teringrasi dengan pusat untuk mengurangi kecurangan', 2),
(3, 'Sistem informasi produk hukum daerah', 'Sistem informasi untuk menyebar luaskan produk hukum daerah yang telah ada di DPRD kabupaten Majalengka', 3),
(4, 'Publikasi Informasi', 'Mempublikasikan informasi', 4);

--
-- Triggers `fitur`
--
DELIMITER $$
CREATE TRIGGER `log_after_update_fitur` AFTER UPDATE ON `fitur` FOR EACH ROW INSERT INTO log_fitur VALUES (NULL, OLD.id, OLD.nama_fitur, OLD.keterangan_fitur,OLD.id_aplikasi,NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `hardwere`
--

CREATE TABLE `hardwere` (
  `id` int(11) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `pemilik` varchar(255) NOT NULL,
  `penyedia` varchar(255) NOT NULL,
  `bandwidth` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `id_aplikasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hardwere`
--

INSERT INTO `hardwere` (`id`, `jenis`, `pemilik`, `penyedia`, `bandwidth`, `jumlah`, `tipe`, `keterangan`, `id_aplikasi`) VALUES
(1, 'Web Server', 'DISKOMINFO Kabupaten Majalengka', ': BKN Nasional', 1500, 1, 'TVS Server', 'Server untuk hosting web ini menggunakan server pemeirntah Majalengka yang dikelola diskominfo', 1),
(2, 'Server', 'DISKOMINFO Kabupaten Majalengka', 'BKPSDM dan sever pusat Majalengka', 1500, 1, 'TVS Server', 'Server ini menggunakan server pemeirntah Majalengka yang dikelola diskominfo', 2),
(3, 'Web Server', 'DISKOMINFO Majalengka', 'DPRD Kabupaten Majalengka', 1500, 1, 'TVS Server', 'Server untuk hosting web ini menggunakan server pemeirntah Majalengka yang dikelola diskominfo', 3),
(4, 'Web Server', 'DISKOMINFO MAJALENGKA', 'BKPSDM dan sever pusat Majalengka', 120, 1, 'TVS Server', 'Server untuk hosting web ini menggunakan server pemeirntah Majalengka yang dikelola diskominfo', 4);

--
-- Triggers `hardwere`
--
DELIMITER $$
CREATE TRIGGER `log_after_update_hardwere` AFTER UPDATE ON `hardwere` FOR EACH ROW INSERT INTO log_hardwere VALUES (NULL, OLD.id, OLD.jenis, OLD.pemilik, OLD.penyedia, OLD.bandwidth, OLD.jumlah, OLD.tipe, OLD.keterangan, OLD.id_aplikasi, NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `instansi`
--

CREATE TABLE `instansi` (
  `id` int(11) NOT NULL,
  `nama_instansi` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instansi`
--

INSERT INTO `instansi` (`id`, `nama_instansi`, `alamat`) VALUES
(1, 'Badan Kepegawaian dan Pengembangan Sumber Daya Manusia', ' Jalan KH Abdul Halim No.107 - Majalengka (45418) 45418 281366\r\n(BKPSDM)'),
(2, 'Dinas Kependudukan dan Catatan SIpil\r\n', ' Jl. K.H. Abdul Halim No. 483 Majalengka 45418 0233281757\r\n'),
(3, 'Dinas Kesehatan\r\n', ' Jalan Gerakan Koprasi No.44 45411 62082311124994'),
(4, 'Dinas Perhubungan\r\n', ' Jalan Pangeran Muhamad KM.5 Simpeureum 45476 02332871741\r\n'),
(5, 'Dinas Pendidikan\r\n', ' Jalan K.H Abdul Halim No. 233 45418 0233281097'),
(6, 'Dinas Pertanian dan Perikanan\r\n', ' Jl. K.H. Abdul Halim No. 31 Majalengka 45417 0233281636\r\n'),
(7, 'DInas Komunikasi dan Informatika\r\n', ' Jalan Pangeran Muhammad KM. 5 45452 0895373268308\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `id` int(11) NOT NULL,
  `jenis_layanan` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `id_aplikasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`id`, `jenis_layanan`, `keterangan`, `id_aplikasi`) VALUES
(1, 'Publikasi Informasi', 'Memberi informasi kepada Masyarakat tentang kegiatan dan berita terkait BKPSDM', 1),
(2, 'Pendaftaran', 'Melakukan pelayanan absensi secara online', 2),
(3, 'Publikasi Informasi', 'Membupblikasi produk hukum daerah Majalengka', 3),
(4, 'Publikasi Informasi', 'Publikasi Informasi', 4);

--
-- Triggers `layanan`
--
DELIMITER $$
CREATE TRIGGER `log_after_update_layanan` AFTER UPDATE ON `layanan` FOR EACH ROW INSERT INTO log_layanan VALUES (NULL, OLD.id, OLD.jenis_layanan, OLD.keterangan, OLD.id_aplikasi, NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `aksi` varchar(255) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log_edit`
--

CREATE TABLE `log_edit` (
  `id` int(11) NOT NULL,
  `id_aplikasi` int(11) NOT NULL,
  `nama_intenal` varchar(255) NOT NULL,
  `nama_ekstenal` varchar(255) NOT NULL,
  `keteangan` varchar(255) NOT NULL,
  `sasaran_layanan` varchar(255) NOT NULL,
  `kategori_sistem` varchar(255) NOT NULL,
  `kategori_akses` varchar(255) NOT NULL,
  `alamar_url` varchar(255) NOT NULL,
  `publikasi` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `id_verifikasi` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `change_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_edit`
--

INSERT INTO `log_edit` (`id`, `id_aplikasi`, `nama_intenal`, `nama_ekstenal`, `keteangan`, `sasaran_layanan`, `kategori_sistem`, `kategori_akses`, `alamar_url`, `publikasi`, `image`, `id_verifikasi`, `id_users`, `change_date`) VALUES
(1, 3, 'JDIH DPRD Majalengka', 'JDIH DPRD Majalengka', 'Website JDIH DPRD Kabupaten Majalengka dikelola oleh Sekretariat DPRD yang diharapkan dapat berperan sebagai media sosialisasi dan penyebaran informasi produk Hukum Daerah secara lengkap, mudah, cepat dan akurat bagi seluruh masyarakat yang membutuhkannya', 'Regional', 'Tinggi', 'Online', 'https://jdih.dprd.majalengkakab.go.id', 'Ya', 'messageImage_1626585803431.jpg', 2, 12, '2021-07-19 05:38:45'),
(2, 4, 'Website BKPSDM', 'BKPSDM', 'Website resmi bpksdm majalengka untuk meakukan pengumuman, pelayanan online dan membagikan dokumentasi kegiatan', 'Regional', 'Strategis', 'Online', 'https://bkpsdm.majalengkakab.go.id', 'Ya', 'messageImage_16265858034311.jpg', 1, 12, '2021-07-19 05:49:28'),
(3, 3, 'JDIH DPRD SUMEDANG', 'JDIH DPRD SUMEDANG', 'Website JDIH DPRD Kabupaten SUMEDANG dikelola oleh Sekretariat DPRD yang diharapkan dapat berperan sebagai media sosialisasi dan penyebaran informasi produk Hukum Daerah secara lengkap, mudah, cepat dan akurat bagi seluruh masyarakat yang membutuhkannya', 'Regional', 'Tinggi', 'Online', 'https://jdih.dprd.majalengkakab.go.id', 'Ya', 'messageImage_1626585803431.jpg', 2, 12, '2021-07-19 05:50:14');

-- --------------------------------------------------------

--
-- Table structure for table `log_fitur`
--

CREATE TABLE `log_fitur` (
  `id` int(11) NOT NULL,
  `id_fitur` int(11) NOT NULL,
  `nama_fitur` varchar(255) NOT NULL,
  `keterangan_fitur` varchar(255) NOT NULL,
  `id_aplikasi` int(11) NOT NULL,
  `change_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_fitur`
--

INSERT INTO `log_fitur` (`id`, `id_fitur`, `nama_fitur`, `keterangan_fitur`, `id_aplikasi`, `change_date`) VALUES
(1, 4, 'maps', 'mapsaaaa', 3, '2021-07-14 03:14:51'),
(2, 22, 'jeje', 'jeje', 3, '2021-07-16 03:47:10'),
(3, 12, 'Jual', 'Menjual Barang yang sudah di post', 7, '2021-07-17 09:31:17'),
(4, 26, 'Manusia', 'Manusai', 5, '2021-07-17 12:08:33'),
(5, 21, 'menampilkan informasi terkait bkpsdm', 'menampilkan persyaratan layanan untuk bkpsdm, dokumentasi, berita dan lainnya', 14, '2021-07-18 02:55:40'),
(6, 21, 'menampilkan informasi terkait bkpsdm', 'menampilkan persyaratan layanan untuk bkpsdm, dokumentasi, berita dan lainnya', 14, '2021-07-18 02:56:41'),
(7, 21, 'menampilkan informasi terkait bkpsdm', 'menampilkan persyaratan layanan untuk bkpsdm, dokumentasi, berita dan lainnya', 14, '2021-07-18 02:57:28'),
(8, 21, 'menampilkan informasi terkait bkpsdm', 'menampilkan persyaratan layanan untuk bkpsdm, dokumentasi, berita dan lainnya', 14, '2021-07-18 03:00:04'),
(9, 21, 'menampilkan informasi terkait bkpsdm', 'menampilkan persyaratan layanan untuk bkpsdm, dokumentasi, berita dan lainnya', 14, '2021-07-18 04:18:49'),
(10, 20, 'zzz', 'zzzz', 13, '2021-07-18 04:19:40'),
(11, 19, 'asas', 'asasas', 12, '2021-07-18 04:24:13'),
(12, 19, 'asas', 'asasas', 12, '2021-07-18 04:24:58'),
(13, 19, 'asas', 'asasas', 12, '2021-07-18 04:27:53'),
(14, 3, 'Sistem informasi produk hukum daerah', 'Sistem informasi untuk menyebar luaskan produk hukum daerah yang telah ada di DPRD kabupaten Majalengka', 3, '2021-07-19 05:38:45'),
(15, 3, 'Sistem informasi produk hukum daerah', 'Sistem informasi untuk menyebar luaskan produk hukum daerah yang telah ada di DPRD kabupaten Majalengka', 3, '2021-07-19 05:50:15');

-- --------------------------------------------------------

--
-- Table structure for table `log_hardwere`
--

CREATE TABLE `log_hardwere` (
  `id` int(11) NOT NULL,
  `id_hardwere` varchar(255) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `pemilik` varchar(255) NOT NULL,
  `penyedia` varchar(255) NOT NULL,
  `bandwidth` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `id_aplikasi` int(11) NOT NULL,
  `change_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_hardwere`
--

INSERT INTO `log_hardwere` (`id`, `id_hardwere`, `jenis`, `pemilik`, `penyedia`, `bandwidth`, `jumlah`, `tipe`, `keterangan`, `id_aplikasi`, `change_date`) VALUES
(1, '15', 'disdukcapil', 'disdukcapil', 'disdukcapil', 2321, 1, 'a', 'disdukcapil', 5, '2021-07-14 03:25:05'),
(2, '26', 'mamam', 'mamam', 'mamam', 12, 12, 'mamam', 'mamam', 15, '2021-07-17 07:02:30'),
(3, '15', 'disdukcapil', 'disdukcapil', 'disdukcapil', 1500, 1, 'a', 'disdukcapil', 5, '2021-07-17 09:31:44'),
(4, '28', 'ANDERA', 'ANDERA', 'ANDERA', 122, 1, 'ANDEA', 'ANDERA', 16, '2021-07-17 12:08:58'),
(5, '30', 'NANANAS', 'NANAS', 'ANA', 12, 12, 'ass', 'sss', 4, '2021-07-17 12:40:16'),
(6, '25', 'web server', 'diskominfo', 'BKN Nasional', 1500, 1, 'TVS server', 'hardware server untuk hosting web ini menggunakan server pemeirntah majalengka yang dikelola diskominfo', 14, '2021-07-18 02:55:40'),
(7, '25', 'web server', 'diskominfo', 'BKN Nasional', 1500, 1, 'TVS server', 'hardware server untuk hosting web ini menggunakan server pemeirntah majalengka yang dikelola diskominfo', 14, '2021-07-18 02:56:42'),
(8, '25', 'web server', 'diskominfo', 'BKN Nasional', 1500, 1, 'TVS server', 'hardware server untuk hosting web ini menggunakan server pemeirntah majalengka yang dikelola diskominfo', 14, '2021-07-18 02:57:29'),
(9, '25', 'web server', 'diskominfo', 'BKN Nasional', 1500, 1, 'TVS server', 'hardware server untuk hosting web ini menggunakan server pemeirntah majalengka yang dikelola diskominfo', 14, '2021-07-18 03:00:04'),
(10, '25', 'web server', 'diskominfo', 'BKN Nasional', 1500, 1, 'TVS server', 'hardware server untuk hosting web ini menggunakan server pemeirntah majalengka yang dikelola diskominfo', 14, '2021-07-18 04:18:49'),
(11, '24', 'zzz', 'zzz', 'zzz', 0, 1, 'zzz', 'zzz', 13, '2021-07-18 04:19:40'),
(12, '23', 'asas', 'asas', 'asas', 0, 1, 'asas', 'asas', 12, '2021-07-18 04:24:13'),
(13, '23', 'asas', 'asas', 'asas', 203, 1, 'asas', 'asas', 12, '2021-07-18 04:24:59'),
(14, '23', 'asas', 'asas', 'asas', 203, 1, 'asas', 'asas', 12, '2021-07-18 04:27:53'),
(15, '3', 'Web Server', 'DISKOMINFO Majalengka', 'DPRD Kabupaten Majalengka', 1500, 1, 'TVS Server', 'Server untuk hosting web ini menggunakan server pemeirntah Majalengka yang dikelola diskominfo', 3, '2021-07-19 05:38:45'),
(16, '3', 'Web Server', 'DISKOMINFO Majalengka', 'DPRD Kabupaten Majalengka', 1500, 1, 'TVS Server', 'Server untuk hosting web ini menggunakan server pemeirntah Majalengka yang dikelola diskominfo', 3, '2021-07-19 05:50:16');

-- --------------------------------------------------------

--
-- Table structure for table `log_layanan`
--

CREATE TABLE `log_layanan` (
  `id` int(11) NOT NULL,
  `id_layanan` int(11) NOT NULL,
  `jenis_layanan` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `id_aplikasi` int(11) NOT NULL,
  `change_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_layanan`
--

INSERT INTO `log_layanan` (`id`, `id_layanan`, `jenis_layanan`, `keterangan`, `id_aplikasi`, `change_date`) VALUES
(1, 9, 'Lainnya', 'asas', 4, '2021-07-14 04:36:43'),
(2, 34, 'Pelaporan Masyarakat', 'mamam', 15, '2021-07-17 07:03:34'),
(3, 2, 'aaa', 'aaa', 2, '2021-07-17 07:34:25'),
(4, 37, 'Pendaftaran', 'KONTOL', 14, '2021-07-17 08:22:16'),
(5, 9, 'Publikasi Informasi', 'Andera Famuzia', 4, '2021-07-17 09:32:02'),
(6, 39, 'Pendaftaran', 'ANANNANA', 14, '2021-07-17 12:41:02'),
(7, 28, 'Publikasi Informasi', 'memberi informasi kepada masyarakat tentang kegiatan dan berita terkait bkpsdm', 14, '2021-07-18 02:55:40'),
(8, 28, 'Pendaftaran', 'memberi informasi kepada masyarakat tentang kegiatan dan berita terkait bkpsdm', 14, '2021-07-18 02:56:42'),
(9, 28, 'Pendaftaran', 'memberi informasi kepada masyarakat tentang kegiatan dan berita terkait bkpsdm', 14, '2021-07-18 02:57:30'),
(10, 28, 'Lainnya', 'memberi informasi kepada masyarakat tentang kegiatan dan berita terkait bkpsdm', 14, '2021-07-18 03:00:04'),
(11, 28, 'Jenis Layanan', 'memberi informasi kepada masyarakat tentang kegiatan dan berita terkait bkpsdm', 14, '2021-07-18 04:18:49'),
(12, 27, 'Pendaftaran', 'zzzz', 13, '2021-07-18 04:19:40'),
(13, 26, 'Pendaftaran', 'asasa', 12, '2021-07-18 04:24:13'),
(14, 26, 'Pendaftaran', 'asasa', 12, '2021-07-18 04:24:59'),
(15, 26, 'Publikasi Informasi', 'asasa', 12, '2021-07-18 04:27:53'),
(16, 1, 'Publikasi Informasi', 'Memberi informasi kepada Masyarakat tentang kegiatan dan berita terkait BKPSDM', 1, '2021-07-18 18:17:31'),
(17, 1, 'Lainnya', 'Memberi informasi kepada Masyarakat tentang kegiatan dan berita terkait BKPSDM', 1, '2021-07-18 18:19:38'),
(18, 1, 'Pendaftaran', 'Memberi informasi kepada Masyarakat tentang kegiatan dan berita terkait BKPSDM', 1, '2021-07-18 18:21:11'),
(19, 3, 'Publikasi Informasi', 'Membupblikasi produk hukum daerah Majalengka', 3, '2021-07-19 05:38:45'),
(20, 3, 'Pelaporan Masyarakat', 'Membupblikasi produk hukum daerah Majalengka', 3, '2021-07-19 05:50:17');

-- --------------------------------------------------------

--
-- Table structure for table `log_profil_aplikasi`
--

CREATE TABLE `log_profil_aplikasi` (
  `id` int(11) NOT NULL,
  `id_profil_aplikasi` int(11) NOT NULL,
  `nama_instansi` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `provinsi` varchar(255) NOT NULL,
  `kabupaten` varchar(255) NOT NULL,
  `kode_pos` int(11) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `id_aplikasi` int(11) NOT NULL,
  `change_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_profil_aplikasi`
--

INSERT INTO `log_profil_aplikasi` (`id`, `id_profil_aplikasi`, `nama_instansi`, `alamat`, `provinsi`, `kabupaten`, `kode_pos`, `no_telp`, `website`, `id_aplikasi`, `change_date`) VALUES
(1, 3, 'asasaaaasssssssssss', 'asasaaaaaaaaaaaaaaaaas', 'asas', 'asas', 0, 'assas', 'asas', 4, '2021-07-14 04:53:05'),
(2, 13, 'mamam', 'mamam', 'mamam', 'mamam', 434242, '0891892', 'mamam', 15, '2021-07-17 07:04:34'),
(3, 7, 'Nanas', 'Nanas', 'Nanas', 'Nanas', 45382, '12', 'qqsqs', 9, '2021-07-17 09:32:19'),
(4, 3, 'Lauk Hayam', 'asasaaaaaaaaaaaaaaaaas', 'asas', 'asas', 45002, 'assas', 'asas', 4, '2021-07-17 12:41:25'),
(5, 12, 'BKPSDM', 'jalan raya majalengka', 'jawa barat', 'majalengka', 45418, '0233-281366', 'bkpsdm.majalengkakab.go.id', 14, '2021-07-18 02:55:40'),
(6, 12, 'BKPSDM', 'jalan raya majalengka', 'jawa barat', 'majalengka', 45418, '0233-281366', 'bkpsdm.majalengkakab.go.id', 14, '2021-07-18 02:56:44'),
(7, 12, 'BKPSDM', 'jalan raya majalengka', 'jawa barat', 'majalengka', 45418, '0233-281366', 'bkpsdm.majalengkakab.go.id', 14, '2021-07-18 02:57:30'),
(8, 12, 'BKPSDM', 'jalan raya majalengka', 'jawa barat', 'majalengka', 45418, '0233-281366', 'bkpsdm.majalengkakab.go.id', 14, '2021-07-18 03:00:04'),
(9, 12, 'BKPSDM', 'jalan raya majalengka', 'jawa barat', 'majalengka', 45418, '0233-281366', 'bkpsdm.majalengkakab.go.id', 14, '2021-07-18 04:18:49'),
(10, 11, 'zzz', 'zzzzz', 'zzz', 'zzz', 0, 'zzz', 'zzzzz', 13, '2021-07-18 04:19:41'),
(11, 10, 'asas', 'asasas', 'asas', 'asas', 0, 'asasas', 'asas', 12, '2021-07-18 04:24:13'),
(12, 10, 'asas', 'asasas', 'asas', 'asas', 0, 'asasas', 'asas', 12, '2021-07-18 04:24:59'),
(13, 10, 'asas', 'asasas', 'asas', 'asas', 0, 'asasas', 'asas', 12, '2021-07-18 04:27:53'),
(14, 3, 'DPRD Kabupaten Majalengka', 'Jl. KH. Abdul Halim 247 Majalengka', 'Jawa Barat', 'Majalengka', 45418, '0233-281094', 'http://dprd-majalengkakab.go.id', 3, '2021-07-19 05:38:45'),
(15, 3, 'DPRD Kabupaten Majalengka', 'Jl. KH. Abdul Halim 247 Majalengka', 'Jawa Barat', 'Majalengka', 45418, '0233-281094', 'http://dprd-majalengkakab.go.id', 3, '2021-07-19 05:50:17');

-- --------------------------------------------------------

--
-- Table structure for table `log_ruang_lingkup`
--

CREATE TABLE `log_ruang_lingkup` (
  `id` int(11) NOT NULL,
  `id_ruang_lingkup` int(11) NOT NULL,
  `ruang_lingkup` varchar(255) NOT NULL,
  `id_aplikasi` int(11) NOT NULL,
  `change_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_ruang_lingkup`
--

INSERT INTO `log_ruang_lingkup` (`id`, `id_ruang_lingkup`, `ruang_lingkup`, `id_aplikasi`, `change_date`) VALUES
(1, 1, 'Hahaha', 5, '2021-07-17 08:02:28'),
(2, 1, 'Aku', 5, '2021-07-17 08:06:19'),
(3, 2, 'ANas Aja', 3, '2021-07-17 08:19:46'),
(4, 3, 'nananananaannanaan', 3, '2021-07-17 08:19:51'),
(5, 4, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 3, '2021-07-17 08:19:55'),
(6, 1, 'Akusssssssss', 5, '2021-07-17 09:32:35'),
(7, 4, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 14, '2021-07-17 12:41:46'),
(8, 2, 'ANas Aja', 14, '2021-07-18 02:55:40'),
(9, 2, 'ANas Aja', 14, '2021-07-18 02:56:44'),
(10, 2, 'ANas Aja', 14, '2021-07-18 02:57:32'),
(11, 2, 'ANas Aja', 14, '2021-07-18 03:00:04'),
(12, 2, 'ANas Aja', 14, '2021-07-18 04:18:49'),
(13, 8, 'ANAS', 12, '2021-07-18 04:27:53'),
(14, 3, 'Produk Layanan', 3, '2021-07-19 05:38:45'),
(15, 3, 'Produk Layanan', 3, '2021-07-19 05:50:18');

-- --------------------------------------------------------

--
-- Table structure for table `log_sistem_keamanan`
--

CREATE TABLE `log_sistem_keamanan` (
  `id` int(11) NOT NULL,
  `id_sistem_keamanan` int(11) NOT NULL,
  `sistem_pengamanan` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `id_aplikasi` int(11) NOT NULL,
  `change_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_sistem_keamanan`
--

INSERT INTO `log_sistem_keamanan` (`id`, `id_sistem_keamanan`, `sistem_pengamanan`, `keterangan`, `id_aplikasi`, `change_date`) VALUES
(1, 5, 'asas', 'asas', 4, '2021-07-14 16:40:45'),
(2, 17, 'mamam', 'mamam', 15, '2021-07-17 07:05:50'),
(3, 6, 'disdukcapil', 'disdukcapil', 5, '2021-07-17 09:33:05'),
(4, 21, 'Manasia', 'masia', 14, '2021-07-17 12:42:58'),
(5, 15, 'md5 dan html special chart', 'untuk enkripsi password dan mencegah sql injection', 14, '2021-07-18 02:55:40'),
(6, 15, 'md5 dan html special chart', 'untuk enkripsi password dan mencegah sql injection', 14, '2021-07-18 02:56:44'),
(7, 15, 'md5 dan html special chart', 'untuk enkripsi password dan mencegah sql injection', 14, '2021-07-18 02:57:32'),
(8, 15, 'md5 dan html special chart', 'untuk enkripsi password dan mencegah sql injection', 14, '2021-07-18 03:00:04'),
(9, 15, 'md5 dan html special chart', 'untuk enkripsi password dan mencegah sql injection', 14, '2021-07-18 04:18:49'),
(10, 14, 'zzzzz', 'zzzzz', 13, '2021-07-18 04:19:42'),
(11, 13, 'asasa', 'asasas', 12, '2021-07-18 04:24:13'),
(12, 13, 'asasa', 'asasas', 12, '2021-07-18 04:24:59'),
(13, 13, 'asasa', 'asasas', 12, '2021-07-18 04:27:53'),
(14, 3, 'md5 dan html special chart', 'untuk enkripsi password dan mencegah sql injection', 3, '2021-07-19 05:38:45'),
(15, 3, 'md5 dan html special chart', 'untuk enkripsi password dan mencegah sql injection', 3, '2021-07-19 05:50:19');

-- --------------------------------------------------------

--
-- Table structure for table `log_sistem_terkait`
--

CREATE TABLE `log_sistem_terkait` (
  `id` int(11) NOT NULL,
  `id_sistem_terkait` int(11) NOT NULL,
  `sistem_tekait` varchar(255) NOT NULL,
  `keteangan` varchar(255) NOT NULL,
  `id_aplikasi` int(11) NOT NULL,
  `change_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_sistem_terkait`
--

INSERT INTO `log_sistem_terkait` (`id`, `id_sistem_terkait`, `sistem_tekait`, `keteangan`, `id_aplikasi`, `change_date`) VALUES
(1, 2, 'aaa', 'aaa', 2, '2021-07-17 13:10:32'),
(2, 5, 'asas', 'Manusia', 4, '2021-07-17 13:13:18'),
(3, 15, 'webstie resmi kabupaten majalengka dan BKN nasional', 'untuk menerima berita dan regulasi terbaru mengenai bkpsdm', 14, '2021-07-18 02:56:45'),
(4, 15, 'webstie resmi kabupaten majalengka dan BKN nasional', 'untuk menerima berita dan regulasi terbaru mengenai bkpsdm', 14, '2021-07-18 02:57:33'),
(5, 15, 'webstie resmi kabupaten majalengka dan BKN nasional', 'untuk menerima berita dan regulasi terbaru mengenai bkpsdm', 14, '2021-07-18 03:00:04'),
(6, 15, 'webstie resmi kabupaten majalengka dan BKN nasional', 'untuk menerima berita dan regulasi terbaru mengenai bkpsdm', 14, '2021-07-18 04:18:49'),
(7, 14, 'zzz', 'zzzz', 13, '2021-07-18 04:19:42'),
(8, 13, 'asas', 'asasas', 12, '2021-07-18 04:24:13'),
(9, 13, 'asas', 'asasas', 12, '2021-07-18 04:24:59'),
(10, 13, 'asas', 'asasas', 12, '2021-07-18 04:27:53'),
(11, 3, 'DISKOMINFO Majalengka', 'sebagai penyedia server untuk sistem informasi DPRD Majalengka', 3, '2021-07-19 05:38:45'),
(12, 3, 'DISKOMINFO Majalengka', 'sebagai penyedia server untuk sistem informasi DPRD Majalengka', 3, '2021-07-19 05:50:19');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id` int(11) NOT NULL,
  `id_aplikasi` int(11) NOT NULL,
  `pesan` varchar(255) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id`, `id_aplikasi`, `pesan`, `waktu`) VALUES
(1, 5, 'Aplikasi Kurang Jelas Fitur nya', '2021-07-03 06:17:35'),
(2, 8, 'Need Approve', '2021-06-14 02:41:54'),
(3, 9, 'Accept', '2021-07-03 04:21:33'),
(4, 10, 'Accept', '2021-07-06 00:42:52'),
(5, 11, 'Accept', '2021-07-06 00:42:57'),
(6, 12, 'Accept', '2021-07-06 00:43:00'),
(7, 13, 'Accept', '2021-07-06 00:50:14'),
(8, 14, 'Accept', '2021-07-07 01:42:29'),
(9, 15, 'Need Approve', '2021-07-17 07:01:40'),
(10, 16, 'Accept', '2021-07-17 09:04:17'),
(11, 1, 'Penjelasan mengenai fitur tidak sesuai\r\n', '2021-07-18 05:33:42'),
(12, 2, 'Accept', '2021-07-18 05:33:53'),
(13, 3, 'Need Approve', '2021-07-18 05:32:29');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna_layanan`
--

CREATE TABLE `pengguna_layanan` (
  `id` int(11) NOT NULL,
  `jenis_pengguna` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `id_aplikasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna_layanan`
--

INSERT INTO `pengguna_layanan` (`id`, `jenis_pengguna`, `keterangan`, `id_aplikasi`) VALUES
(2, 'aaa', 'aaa', 2),
(3, 'sadasd', 'dasdad', 3),
(4, 'asas', 'asas', 4),
(5, 'disdukcapil', 'disdukcapil', 5);

-- --------------------------------------------------------

--
-- Table structure for table `perangkat_keras`
--

CREATE TABLE `perangkat_keras` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `nama_perangkat` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perangkat_keras`
--

INSERT INTO `perangkat_keras` (`id`, `id_users`, `nama_perangkat`, `jumlah`) VALUES
(1, 12, 'Monitor PC', 7),
(2, 12, 'Laptop', 20),
(3, 12, 'PC', 10);

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE `profil` (
  `id` int(11) NOT NULL,
  `nama_instansi` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `provinsi` varchar(255) NOT NULL,
  `kabupaten` varchar(255) NOT NULL,
  `kode_pos` int(11) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `id_aplikasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profil`
--

INSERT INTO `profil` (`id`, `nama_instansi`, `alamat`, `provinsi`, `kabupaten`, `kode_pos`, `no_telp`, `website`, `id_aplikasi`) VALUES
(1, 'BKPSDM Kabupaten Majalengka', 'Jalan Jendral Ahmad Yani No.1 - Majalengka', 'Jawa Barat', 'Majalengka', 45418, '0233-281366', 'https://bkpsdm.majalengkakab.go.id', 1),
(2, 'Pemerintah Majalengka', 'Jl. Ahmad Yani No.1, Majalengka Kulon, Kec. Majalengka, Kabupaten Majalengka', 'Jawa Barat', 'Majalengka', 45418, '0233- 281560', 'https://majalengkakab.go.id', 2),
(3, 'DPRD Kabupaten Majalengka', 'Jl. KH. Abdul Halim 247 Majalengka', 'Jawa Barat', 'Majalengka', 45418, '0233-281094', 'http://dprd-majalengkakab.go.id', 3),
(4, 'BKPSDM Kabupaten Majalengka', 'JL. Pangeran Muhammad', 'Jawa Barat', 'Majalengka', 45418, '0262366', 'https://bkpsdm.majalengkakab.go.id', 4);

--
-- Triggers `profil`
--
DELIMITER $$
CREATE TRIGGER `log_after_update_profil` AFTER UPDATE ON `profil` FOR EACH ROW INSERT INTO log_profil_aplikasi VALUES (NULL, OLD.id, OLD.nama_instansi, OLD.alamat, OLD.provinsi, OLD.kabupaten, OLD.kode_pos, OLD.no_telp, OLD.website, OLD.id_aplikasi, NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ruang_lingkup`
--

CREATE TABLE `ruang_lingkup` (
  `id` int(11) NOT NULL,
  `ruang_lingkup` varchar(255) NOT NULL,
  `id_aplikasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ruang_lingkup`
--

INSERT INTO `ruang_lingkup` (`id`, `ruang_lingkup`, `id_aplikasi`) VALUES
(1, 'Sarana, prasarana, dan fasilitas', 1),
(2, 'Pengawasan internal', 2),
(3, 'Produk Layanan', 3);

--
-- Triggers `ruang_lingkup`
--
DELIMITER $$
CREATE TRIGGER `after_update_ruang_lingkup` AFTER UPDATE ON `ruang_lingkup` FOR EACH ROW INSERT INTO log_ruang_lingkup VALUES(NULL, OLD.id, OLD.ruang_lingkup, OLD.id_aplikasi, NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sertifikasi`
--

CREATE TABLE `sertifikasi` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `id_aplikasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sistem_keamanan`
--

CREATE TABLE `sistem_keamanan` (
  `id` int(11) NOT NULL,
  `sistem_pengamanan` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `id_aplikasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sistem_keamanan`
--

INSERT INTO `sistem_keamanan` (`id`, `sistem_pengamanan`, `keterangan`, `id_aplikasi`) VALUES
(1, 'Md5 dan html special chart', 'untuk enkripsi password dan mencegah sql injection', 1),
(2, 'Password', 'agar aplikasi tidak dibuka oleh sembarang orang', 2),
(3, 'md5 dan html special chart', 'untuk enkripsi password dan mencegah sql injection', 3);

--
-- Triggers `sistem_keamanan`
--
DELIMITER $$
CREATE TRIGGER `log_after_update_sistem_keamanan` AFTER UPDATE ON `sistem_keamanan` FOR EACH ROW INSERT INTO log_sistem_keamanan VALUES (NULL, OLD.id, OLD.sistem_pengamanan, OLD.keterangan, OLD.id_aplikasi, NOW() )
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sistem_tekait`
--

CREATE TABLE `sistem_tekait` (
  `id` int(11) NOT NULL,
  `sistem_tekait` varchar(255) NOT NULL,
  `keteangan` varchar(255) NOT NULL,
  `id_aplikasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sistem_tekait`
--

INSERT INTO `sistem_tekait` (`id`, `sistem_tekait`, `keteangan`, `id_aplikasi`) VALUES
(1, 'Webstie resmi kabupaten majalengka dan BKN nasional', 'Untuk menerima berita dan regulasi terbaru mengenai BKPSDM', 1),
(2, 'Server absensi pusat kabupaten majalengka', 'server absensi pusat untuk mengabsen pns Majalengka', 2),
(3, 'DISKOMINFO Majalengka', 'sebagai penyedia server untuk sistem informasi DPRD Majalengka', 3);

--
-- Triggers `sistem_tekait`
--
DELIMITER $$
CREATE TRIGGER `after_update_sistem_terkait` AFTER UPDATE ON `sistem_tekait` FOR EACH ROW INSERT INTO log_sistem_terkait VALUES(NULL, OLD.id, OLD.sistem_tekait, OLD.keteangan, OLD.id_aplikasi, NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ticketing`
--

CREATE TABLE `ticketing` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `pesan` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `waktu_pengajuan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `waktu_selesai` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticketing`
--

INSERT INTO `ticketing` (`id`, `id_users`, `jenis`, `pesan`, `status`, `waktu_pengajuan`, `waktu_selesai`) VALUES
(1, 12, 'Pengajuan', 'Meminta untuk membuatkan hosting untuk web', 'Selesai', '2021-07-19 05:41:03', '2021-07-19 05:41:03'),
(2, 12, 'Pengajuan', 'Pengajuan Pembangunan LAN', 'Menunggu di Acc', '2021-07-19 05:37:20', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `id_instansi` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `nip` int(11) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `id_instansi`, `nama_lengkap`, `nip`, `email`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(3, 1, 'Toto', 768979879, 'dologiyas@gmail.com', '$2y$10$b2yghyqjr0iDknFbJVVBPuLtVl6rGhNpUnD48lpLrIQ0E2yU5jJTu', 2, 1, 1613898982),
(7, 7, 'Fatur', 76897979, 'anasfebrian0@gmail.com', '$2y$10$PmYlqcmPD2m.w2NMIRtbS.MHNO8LWGfSlIMUE7Sgd93mQCFGe3WDC', 1, 1, 1616170234),
(11, 1, 'Qori', 23287392, 'qori@gmail.com', '$2y$10$bFSVK50nQ75CphHUWmAjzeYZUkWqkzsj5uz7ZxLAGEdzxl.ZLrtra', 2, 1, 1623133850),
(12, 1, 'Emar', 7689262, 'muhamadanas@student.telkomuniversity.ac.id', '$2y$10$KQAu6itZN32Rl9WTw9p4Nuhzp0NDhToyvTKkJ/t7fhpKOUFN88fRO', 2, 1, 1625286307),
(13, 1, 'Anas Mustopa', 796682, 'polresmajalengka@gmail.com', '$2y$10$mq3OK4LyGaYhSgxMunAsWuy2dtPpR5CmNca9HL9FhU3IQXcfAKAVm', 2, 0, 1625622024),
(14, 6, 'Ahmad', 1234567, 'ahmad@gmail.com', '$2y$10$k1AGI5wFFq9XPoa8XbEszeElVfcVrgM/yRsw9KnyipcQCPWlQ83XC', 2, 1, 1626095613),
(15, 1, 'Muhamad Andera', 898982, 'famuziaa@gmail.com', '$2y$10$WnISlR7UCIllUuC/CMZmiuCWtjBomMYiq03/7/SzGKjOC7HMunl3a', 2, 1, 1626673576),
(16, 2, 'Uja', 67201, 'ujaa@gmail.com', '$2y$10$9rr9OhVSRHFLaAViRzZjj.KXQqyrKGub5PpZpNBd1KgAllcUCKFzG', 2, 1, 1626673708);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(3, 'famuziaa@gmail.com', '/mQUeyfXdxAwUgdQ9PShcnSsQJXunBzcn7bF7/KVhQo=', 1615455885),
(4, 'anasfenrian0@gmail.com', 'XaFZVBFe1rxHjzm0GUYgBLr6rLwLMGMHN00hvbPHvoU=', 1615456042);

-- --------------------------------------------------------

--
-- Table structure for table `verifikasi`
--

CREATE TABLE `verifikasi` (
  `id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `verifikasi`
--

INSERT INTO `verifikasi` (`id`, `status`) VALUES
(1, 'On Process'),
(2, 'Accept'),
(3, 'Decline');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_umum`
--
ALTER TABLE `data_umum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fitur`
--
ALTER TABLE `fitur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hardwere`
--
ALTER TABLE `hardwere`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instansi`
--
ALTER TABLE `instansi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_edit`
--
ALTER TABLE `log_edit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_fitur`
--
ALTER TABLE `log_fitur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_hardwere`
--
ALTER TABLE `log_hardwere`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_layanan`
--
ALTER TABLE `log_layanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_profil_aplikasi`
--
ALTER TABLE `log_profil_aplikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_ruang_lingkup`
--
ALTER TABLE `log_ruang_lingkup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_sistem_keamanan`
--
ALTER TABLE `log_sistem_keamanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_sistem_terkait`
--
ALTER TABLE `log_sistem_terkait`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengguna_layanan`
--
ALTER TABLE `pengguna_layanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perangkat_keras`
--
ALTER TABLE `perangkat_keras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ruang_lingkup`
--
ALTER TABLE `ruang_lingkup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sertifikasi`
--
ALTER TABLE `sertifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sistem_keamanan`
--
ALTER TABLE `sistem_keamanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sistem_tekait`
--
ALTER TABLE `sistem_tekait`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticketing`
--
ALTER TABLE `ticketing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verifikasi`
--
ALTER TABLE `verifikasi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_umum`
--
ALTER TABLE `data_umum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fitur`
--
ALTER TABLE `fitur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hardwere`
--
ALTER TABLE `hardwere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `instansi`
--
ALTER TABLE `instansi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_edit`
--
ALTER TABLE `log_edit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `log_fitur`
--
ALTER TABLE `log_fitur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `log_hardwere`
--
ALTER TABLE `log_hardwere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `log_layanan`
--
ALTER TABLE `log_layanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `log_profil_aplikasi`
--
ALTER TABLE `log_profil_aplikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `log_ruang_lingkup`
--
ALTER TABLE `log_ruang_lingkup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `log_sistem_keamanan`
--
ALTER TABLE `log_sistem_keamanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `log_sistem_terkait`
--
ALTER TABLE `log_sistem_terkait`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pengguna_layanan`
--
ALTER TABLE `pengguna_layanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `perangkat_keras`
--
ALTER TABLE `perangkat_keras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `profil`
--
ALTER TABLE `profil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ruang_lingkup`
--
ALTER TABLE `ruang_lingkup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sertifikasi`
--
ALTER TABLE `sertifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sistem_keamanan`
--
ALTER TABLE `sistem_keamanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sistem_tekait`
--
ALTER TABLE `sistem_tekait`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ticketing`
--
ALTER TABLE `ticketing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `verifikasi`
--
ALTER TABLE `verifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
