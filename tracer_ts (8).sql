-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2025 at 03:28 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tracer_ts`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `email`, `password`, `picture`, `bio`, `created_at`, `update_at`) VALUES
(1, 'Naylla Fitri', 'admin', 'nayllafitri@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '2025-03-03 02:38:25', '2025-04-22 01:28:32');

-- --------------------------------------------------------

--
-- Table structure for table `admin_jurusan_messages`
--

CREATE TABLE `admin_jurusan_messages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `greeting` varchar(255) NOT NULL,
  `message_content` text NOT NULL,
  `closing` varchar(255) NOT NULL,
  `signature` varchar(255) NOT NULL,
  `footer` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_jurusan_messages`
--

INSERT INTO `admin_jurusan_messages` (`id`, `title`, `greeting`, `message_content`, `closing`, `signature`, `footer`, `created_at`, `updated_at`) VALUES
(1, 'Informasi Kuesioner', 'Halo Admin Jurusan,', 'Saat ini belum tersedia kuesioner untuk tahun kelulusan alumni yang Anda pilih. Jika Anda merasa perlu membuka kuesioner untuk angkatan tertentu, silakan hubungi tim pusat tracer study atau bagian kealumnian untuk aktivasi.', 'Terima kasih atas perhatian Anda.', 'Hormat Kami, Tim Tracer Study.', 'This website by ITB Career Center & Aswan Technology. Customized by Tracer Study POLBAN Team. Licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License.', '2025-05-08 08:18:34', '2025-05-08 08:18:34');

-- --------------------------------------------------------

--
-- Table structure for table `alumni`
--

CREATE TABLE `alumni` (
  `id` int(11) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `program_studi` varchar(100) NOT NULL,
  `angkatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alumni`
--

INSERT INTO `alumni` (`id`, `nim`, `username`, `email`, `nama`, `jurusan`, `program_studi`, `angkatan`) VALUES
(1, '191121034', 'aldopaladin', 'aldopaladin@gmail.com', 'A M ALDO HAFIZ ARMANDHY F', 'TS', 'DIII - Teknik Konstruksi Sipil', 2019),
(2, '191111033', 'rikiarif91', 'rikiarif91@gmail.com', 'A. RAFI RIZQI RAMADHAN', 'TS', 'DIII - Teknik Konstruksi Gedung', 2019),
(3, '202121034', 'abdulbais103', 'abdulbais103@gmail.com', 'A. TULUS BANJAI', 'TM', 'DIII - Teknik Mesin', 2020),
(4, '191121034', 'khoriuljalil', 'khoriuljalil5@gmail.com', 'A.M. KHORIUL FADILAH', 'TS', 'DIII - Teknik Konstruksi Sipil', 2018),
(5, '171131003', 'arsundah', 'arsundah@yahoo.com', 'A. MUHAMMAD DAHLAN', 'TE', 'DIII - Teknik Elektronika', 2017),
(6, '135121003', 'arsundah', 'arsundah@yahoo.com', 'Ari Rusdani', 'AK', 'DIII - Keuangan dan Perbankan', 2013),
(7, '135121003', '131@gmail.com', '131@gmail.com', 'Ai Muhyadin', 'TM', 'DIII - Teknik Mesin', 2013),
(8, '135121003', 'zazri.su@gmail.com', 'zazri.su@gmail.com', 'A.A. REZA SUHENDAR', 'TKE', 'DIII - Teknik Konversi Energi', 2012),
(9, '125121003', 'aayfakhru10', 'aayfakhru10@yahoo.com', 'AAY FAKHRUDDIN', 'TA', 'DIII - Administrasi Bisnis', 2012),
(10, '125121003', 'cojuy5489', 'cojuy5489@gmail.com', 'Aah Yuliani', 'AK', 'DIII - Keuangan dan Perbankan', 2012),
(11, '1234567759', 'Sri', 'srimeilani2405@gmail.com', 'Sri Meilani', 'TI', 'S1-IF', 0),
(12, '12234455852', 'vwwewgyew', 'salwafitaliaaureli78@gmail.com', 'salwasa', 'TI', 'S1-IF', 2019),
(14, '12345555575', 'awey', 'salwafitaliaaureli@gmail.com', 'slaacwewc', '- Pilih Jurusan -', '- Pilih Program Studi -', 0),
(19, '', 'salwa', 'salwafitaliaaureli@gmail.com', 'awa', '', '', 0),
(21, '', 'naylla fitri ', 'nayllafitriayu@gmail.com', 'naylla fitri', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `data_isian_kuesioner`
--

CREATE TABLE `data_isian_kuesioner` (
  `id` int(11) NOT NULL,
  `kuesioner_id` int(11) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `program_studi` varchar(100) NOT NULL,
  `angkatan` int(11) NOT NULL,
  `jawaban` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `halaman_kuesioner`
--

CREATE TABLE `halaman_kuesioner` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `id_kuesioner` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `halaman_kuesioner`
--

INSERT INTO `halaman_kuesioner` (`id`, `judul`, `deskripsi`, `id_kuesioner`) VALUES
(1, 'Identitas Responden', 'Berisi informasi dasar responden', 0),
(2, 'Pengalaman Kerja', 'Berisi pertanyaan terkait pengalaman kerja setelah lulus', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `organization_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kuesioner_answer`
--

CREATE TABLE `kuesioner_answer` (
  `id` int(11) NOT NULL,
  `kuesioner_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `answers` longtext NOT NULL,
  `status` enum('draft','submitted') DEFAULT 'draft',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kuesioner_answer`
--

INSERT INTO `kuesioner_answer` (`id`, `kuesioner_id`, `user_id`, `answers`, `status`, `created_at`, `updated_at`) VALUES
(16, 1, 135, '{\"q_1p_85\":{\"s_107\":{\"id_1122\":\"naylla fitri\",\"id_1123\":\"fgfgf@gmail\",\"id_1124\":\"\"},\"s_108\":{\"id_1125\":\"Teknik Mesin\",\"id_1125_other\":\"\",\"id_1126\":\"2024\"}},\"q_1p_86\":{\"s_109\":{\"id_1127\":{\"\":\"Wirausaha\"},\"id_1127_other\":\"\",\"id_1128\":\"Sangat Relevan\"},\"s_110\":{\"id_1129\":\"566666666\",\"id_1130\":\"thytfuyuyt\"}},\"q_1p_87\":{\"s_111\":{\"id_1131\":\" Tidak Berpengaruh\"},\"s_112\":{\"id_1132\":[\"2\",\"3\",\"4\",\"4\",\"4\"]}}}', 'draft', '2025-06-26 07:14:28', '2025-06-26 07:34:51'),
(18, 1, 102, '{\"q_1\":{\"p_85\":{\"s_107\":{\"id_1122\":\"Sri\",\"id_1123\":\"hjhgrjg@gmail.com\",\"id_1124\":\"09809837443\"},\"s_108\":{\"id_1125\":\"Bahasa Inggris\",\"id_1125_other\":\"\",\"id_1126\":\"2022\"}},\"p_86\":{\"s_109\":{\"id_1127\":[\"Wirausaha\"],\"id_1127_other\":\"\",\"id_1128\":\"Sangat Relevan\"},\"s_110\":{\"id_1129\":\"800000000\",\"id_1130\":\"ghrtttt\"}},\"p_87\":{\"s_111\":{\"id_1131\":\" Berpengaruh\"},\"s_112\":{\"id_1132\":[\"4\",\"4\",\"4\",\"4\",\"4\"]}}}}', 'submitted', '2025-06-26 21:17:54', '2025-06-26 22:05:31');

-- --------------------------------------------------------

--
-- Table structure for table `kuesioner_fields`
--

CREATE TABLE `kuesioner_fields` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_html` int(11) NOT NULL,
  `kuesioner_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `type` varchar(32) NOT NULL,
  `options` text DEFAULT NULL,
  `note` text DEFAULT NULL,
  `required` int(11) DEFAULT NULL,
  `conditional_logic` text DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `ordering_count` int(11) UNSIGNED DEFAULT NULL,
  `label` text DEFAULT NULL,
  `scale_min` tinyint(4) NOT NULL DEFAULT 1,
  `scale_max` tinyint(4) NOT NULL DEFAULT 5,
  `start_label` varchar(100) DEFAULT '',
  `middle_label` varchar(100) DEFAULT '',
  `end_label` varchar(100) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kuesioner_fields`
--

INSERT INTO `kuesioner_fields` (`id`, `id_html`, `kuesioner_id`, `page_id`, `section_id`, `type`, `options`, `note`, `required`, `conditional_logic`, `created_on`, `created_by`, `updated_on`, `updated_by`, `ordering_count`, `label`, `scale_min`, `scale_max`, `start_label`, `middle_label`, `end_label`) VALUES
(874, 0, 0, 0, 69, 'text', '[]', NULL, 1, NULL, '2025-06-23 07:27:28', NULL, NULL, NULL, 1, 'Nama Lengkap', 1, 5, '', '', ''),
(875, 0, 0, 0, 69, 'email', '[]', NULL, 1, NULL, '2025-06-23 07:27:28', NULL, NULL, NULL, 2, 'Alamat Email', 1, 5, '', '', ''),
(876, 0, 0, 0, 69, 'dropdown', '[\"2024\",\"2023\",\"2022\",\"2021\",\"2020\"]', NULL, 1, NULL, '2025-06-23 07:27:28', NULL, NULL, NULL, 3, 'Tahun Lulus', 1, 5, '', '', ''),
(877, 0, 0, 0, 69, 'checkbox', '[\"Instagram\",\"Facebook\",\"LinkedIn\",\"Twitter\",\"TikTok\"]', NULL, 1, NULL, '2025-06-23 07:27:28', NULL, NULL, NULL, 4, 'Media Sosial yang Sering Digunakan', 1, 5, '', '', ''),
(878, 0, 0, 0, 69, 'dropdown', '[\"Bekerja\",\"Melanjutkan Studi\",\"Wirausaha\",\"Belum Bekerja\"]', NULL, 1, NULL, '2025-06-23 07:27:28', NULL, NULL, NULL, 5, 'Status Saat Ini', 1, 5, '', '', ''),
(879, 0, 0, 0, 69, 'scale', '[]', NULL, 1, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 6, 'Seberapa puas Anda dengan pendidikan yang diterima?', 1, 5, '', '', ''),
(880, 0, 0, 0, 69, 'textarea', NULL, NULL, 0, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 7, 'Saran untuk Pengembangan Kampus', 1, 5, '', '', ''),
(881, 0, 0, 0, 69, 'dropdown', '[\"Teknik Informatika\",\"Sistem Informasi\",\"Teknik Elektro\",\"Manajemen\",\"Akuntansi\"]', NULL, 1, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 8, 'Program Studi', 1, 5, '', '', ''),
(882, 0, 0, 0, 69, 'checkbox', '[\"Programming\",\"Desain Grafis\",\"Analisis Data\",\"Public Speaking\",\"Manajemen Proyek\"]', NULL, 0, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 9, 'Keterampilan yang Dikuasai', 1, 5, '', '', ''),
(883, 0, 0, 0, 69, 'scale', '[]', NULL, 1, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 10, 'Seberapa relevan pendidikan dengan pekerjaan Anda?', 1, 5, '', '', ''),
(884, 0, 0, 0, 70, 'text', '[]', NULL, 1, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 1, 'Nama Perusahaan', 1, 5, '', '', ''),
(885, 0, 0, 0, 70, 'text', '[]', NULL, 1, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 2, 'Jabatan/Posisi', 1, 5, '', '', ''),
(886, 0, 0, 0, 70, 'dropdown', '[\"Teknologi Informasi\",\"Keuangan\",\"Pendidikan\",\"Kesehatan\",\"Manufaktur\",\"Perdagangan\",\"Jasa\",\"Lainnya\"]', NULL, 1, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 3, 'Bidang Industri Perusahaan', 1, 5, '', '', ''),
(887, 0, 0, 0, 70, 'text', '[]', NULL, 1, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 4, 'Lama Bekerja di Perusahaan Saat Ini', 1, 5, '', '', ''),
(888, 0, 0, 0, 70, 'scale', '[]', NULL, 1, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 5, 'Seberapa puas Anda dengan gaji saat ini?', 1, 5, '', '', ''),
(889, 0, 0, 0, 70, 'scale', '[]', NULL, 1, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 6, 'Seberapa relevan pendidikan Anda dengan pekerjaan saat ini?', 1, 5, '', '', ''),
(890, 0, 0, 0, 70, 'checkbox', '[\"Kampus/Alumni\",\"Job Fair\",\"LinkedIn\",\"Situs Lowongan Kerja\",\"Rekomendasi Teman/Keluarga\",\"Lainnya\"]', NULL, 1, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 7, 'Sumber Informasi Lowongan Pekerjaan', 1, 5, '', '', ''),
(891, 0, 0, 0, 70, 'radio', '[\"Karyawan Tetap\",\"Karyawan Kontrak\",\"Freelance\",\"Magang\",\"Lainnya\"]', NULL, 1, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 8, 'Status Pekerjaan', 1, 5, '', '', ''),
(892, 0, 0, 0, 70, 'textarea', NULL, NULL, 0, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 9, 'Deskripsi Pekerjaan', 1, 5, '', '', ''),
(893, 0, 0, 0, 70, 'scale', '[]', NULL, 1, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 10, 'Seberapa sesuai pekerjaan Anda dengan minat dan bakat?', 1, 5, '', '', ''),
(894, 0, 0, 0, 71, 'text', '[]', NULL, 1, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 1, 'Nama Usaha/Bisnis', 1, 5, '', '', ''),
(895, 0, 0, 0, 71, 'dropdown', '[\"Makanan & Minuman\",\"Fashion\",\"Teknologi\",\"Jasa Pendidikan\",\"Kesehatan & Kecantikan\",\"Pertanian\",\"Kerajinan Tangan\",\"Lainnya\"]', NULL, 1, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 2, 'Bidang Usaha', 1, 5, '', '', ''),
(896, 0, 0, 0, 71, 'text', '[]', NULL, 1, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 3, 'Tahun Mulai Berwirausaha', 1, 5, '', '', ''),
(897, 0, 0, 0, 71, 'radio', '[\"Perorangan\",\"CV\",\"PT\",\"UD\",\"Koperasi\",\"Lainnya\"]', NULL, 1, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 4, 'Bentuk Legal Usaha', 1, 5, '', '', ''),
(898, 0, 0, 0, 71, 'scale', '[]', NULL, 1, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 5, 'Seberapa puas Anda dengan perkembangan usaha saat ini?', 1, 5, '', '', ''),
(899, 0, 0, 0, 71, 'checkbox', '[\"Tabungan Pribadi\",\"Pinjaman Bank\",\"Investor\",\"Bantuan Keluarga\",\"Program Kampus\",\"Lainnya\"]', NULL, 1, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 6, 'Sumber Modal Usaha', 1, 5, '', '', ''),
(900, 0, 0, 0, 71, 'text', '[]', NULL, 0, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 7, 'Jumlah Karyawan Tetap', 1, 5, '', '', ''),
(901, 0, 0, 0, 71, 'textarea', NULL, NULL, 1, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 8, 'Deskripsi Usaha dan Target Pasar', 1, 5, '', '', ''),
(902, 0, 0, 0, 71, 'scale', '[]', NULL, 1, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 9, 'Seberapa sesuai usaha Anda dengan latar belakang pendidikan?', 1, 5, '', '', ''),
(903, 0, 0, 0, 71, 'textarea', NULL, NULL, 0, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 10, 'Kendala dan Harapan Pengembangan Usaha', 1, 5, '', '', ''),
(904, 0, 0, 0, 72, 'checkbox', '[\"Masih mencari pekerjaan\",\"Melanjutkan studi\",\"Mengurus keluarga\",\"Sedang mengikuti pelatihan\",\"Belum ada kesempatan\",\"Lainnya\"]', NULL, 1, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 1, 'Alasan Belum Bekerja', 1, 5, '', '', ''),
(905, 0, 0, 0, 72, 'checkbox', '[\"Melamar pekerjaan\",\"Mengikuti job fair\",\"Mengikuti pelatihan/kursus\",\"Membuat CV/portofolio\",\"Networking\",\"Lainnya\"]', NULL, 1, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 2, 'Usaha Mencari Kerja', 1, 5, '', '', ''),
(906, 0, 0, 0, 72, 'text', '[]', NULL, 1, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 3, 'Jenis Pekerjaan yang Diinginkan', 1, 5, '', '', ''),
(907, 0, 0, 0, 72, 'text', '[]', NULL, 1, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 4, 'Lokasi Kerja yang Diharapkan', 1, 5, '', '', ''),
(908, 0, 0, 0, 72, 'scale', '[]', NULL, 1, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 5, 'Seberapa siap Anda memasuki dunia kerja?', 1, 5, '', '', ''),
(909, 0, 0, 0, 72, 'scale', '[]', NULL, 1, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 6, 'Apakah pencarian kerja Anda sesuai dengan bidang studi?', 1, 5, '', '', ''),
(910, 0, 0, 0, 72, 'text', '[]', NULL, 1, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 7, 'Tahun Lulus', 1, 5, '', '', ''),
(911, 0, 0, 0, 72, 'textarea', NULL, NULL, 1, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 8, 'Kendala dalam Mencari Kerja', 1, 5, '', '', ''),
(912, 0, 0, 0, 72, 'checkbox', '[\"Jobstreet\",\"LinkedIn\",\"Kalibrr\",\"Glints\",\"Website perusahaan langsung\",\"Media sosial\",\"Lainnya\"]', NULL, 1, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 9, 'Platform Pencarian Kerja', 1, 5, '', '', ''),
(913, 0, 0, 0, 72, 'textarea', NULL, NULL, 0, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 10, 'Harapan terhadap Kampus', 1, 5, '', '', ''),
(914, 0, 0, 0, 73, 'radio', '[\"S2/Magister\",\"S3/Doktor\",\"Profesi\",\"Lainnya\"]', NULL, 1, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 1, 'Jenjang Studi Lanjutan', 1, 5, '', '', ''),
(915, 0, 0, 0, 73, 'text', '[]', NULL, 1, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 2, 'Nama Institusi Pendidikan', 1, 5, '', '', ''),
(916, 0, 0, 0, 73, 'text', '[]', NULL, 1, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 3, 'Program Studi', 1, 5, '', '', ''),
(917, 0, 0, 0, 73, 'checkbox', '[\"Meningkatkan kualifikasi akademik\",\"Kebutuhan pekerjaan\",\"Minat pribadi\",\"Belum ingin bekerja\",\"Lainnya\"]', NULL, 1, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 4, 'Alasan Melanjutkan Studi', 1, 5, '', '', ''),
(918, 0, 0, 0, 73, 'scale', '[]', NULL, 1, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 5, 'Seberapa sesuai studi lanjutan Anda dengan pendidikan sebelumnya?', 1, 5, '', '', ''),
(919, 0, 0, 0, 73, 'checkbox', '[\"Biaya pribadi\",\"Beasiswa pemerintah\",\"Beasiswa kampus\",\"Orang tua/keluarga\",\"Sponsor perusahaan\",\"Lainnya\"]', NULL, 1, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 6, 'Sumber Pembiayaan Studi', 1, 5, '', '', ''),
(920, 0, 0, 0, 73, 'radio', '[\"Dalam negeri\",\"Luar negeri\"]', NULL, 1, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 7, 'Lokasi Institusi Studi', 1, 5, '', '', ''),
(921, 0, 0, 0, 73, 'checkbox', '[\"Bekerja di bidang akademik\",\"Bekerja di industri\",\"Melanjutkan studi lagi\",\"Membuka usaha\",\"Belum memiliki rencana\",\"Lainnya\"]', NULL, 1, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 8, 'Rencana Setelah Studi', 1, 5, '', '', ''),
(922, 0, 0, 0, 73, 'textarea', NULL, NULL, 0, NULL, '2025-06-23 07:27:30', NULL, NULL, NULL, 9, 'Tantangan dalam Studi Lanjutan', 1, 5, '', '', ''),
(923, 0, 0, 0, 73, 'textarea', NULL, NULL, 0, NULL, '2025-06-23 07:27:30', NULL, NULL, NULL, 10, 'Harapan terhadap Kampus Asal', 1, 5, '', '', ''),
(924, 0, 0, 0, 74, 'checkbox', '[{\"label\":\"wfcewd\",\"value\":\"ed\"},{\"label\":\"ewfed\",\"value\":\"f\"},{\"label\":\"ewfwe\",\"value\":\"ef\"},{\"label\":\"Lainnya\",\"value\":\"other\",\"isOther\":true}]', NULL, 0, NULL, '2025-06-23 07:27:30', NULL, NULL, NULL, 1, 'dcefc', 1, 5, '', '', ''),
(925, 0, 0, 0, 74, 'radio', '[{\"label\":\"trhr\",\"value\":\"ut\"},{\"label\":\"tujjyj\",\"value\":\"ytjt\"},{\"label\":\"uykyg\",\"value\":\"uj\"},{\"label\":\"Lainnya\",\"value\":\"other\",\"isOther\":true}]', NULL, 0, NULL, '2025-06-23 07:27:30', NULL, NULL, NULL, 2, 'yjyth', 1, 5, '', '', ''),
(926, 0, 0, 0, 74, 'dropdown', '[{\"label\":\"yb5\",\"value\":\"65b\",\"isOther\":false},{\"label\":\"y5b6\",\"value\":\"jyt\",\"isOther\":false},{\"label\":\"btrtyh\",\"value\":\"bjt\",\"isOther\":false},{\"label\":\"Lainnya\",\"value\":\"other\",\"isOther\":true},{\"label\":\"Lainnya\",\"value\":\"other\",\"isOther\":true}]', NULL, 0, NULL, '2025-06-23 07:27:30', NULL, NULL, NULL, 3, 'ytg45btgcgbnfgxb', 1, 5, '', '', ''),
(927, 0, 0, 0, 74, 'checkbox', '[{\"label\":\"fghbfb\",\"value\":\"fg\",\"isOther\":false},{\"label\":\"fghbvbcfgnghnjgh\",\"value\":\"h\",\"isOther\":false},{\"label\":\"fgbhfbh\",\"value\":\"fh\",\"isOther\":false},{\"label\":\"Lainnya\",\"value\":\"other\",\"isOther\":true},{\"label\":\"Lainnya\",\"value\":\"other\",\"isOther\":true}]', NULL, 0, NULL, '2025-06-23 07:27:30', NULL, NULL, NULL, 4, 'pertanyaan', 1, 5, '', '', ''),
(928, 0, 0, 0, 74, 'user_field', '[\"[\\\"[\\\\\\\"jenis_kelamin\\\\\\\"]\\\"]\"]', NULL, 0, NULL, '2025-06-23 07:27:30', NULL, NULL, NULL, 5, 'Data Pengguna', 1, 5, '', '', ''),
(929, 0, 0, 0, 75, 'text', '[]', NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 1, 'Nama Lengkap', 1, 5, '', '', ''),
(930, 0, 0, 0, 75, 'email', '[]', NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 2, 'Alamat Email', 1, 5, '', '', ''),
(931, 0, 0, 0, 75, 'dropdown', '[\"2024\",\"2023\",\"2022\",\"2021\",\"2020\"]', NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 3, 'Tahun Lulus', 1, 5, '', '', ''),
(932, 0, 0, 0, 75, 'checkbox', '[\"Instagram\",\"Facebook\",\"LinkedIn\",\"Twitter\",\"TikTok\"]', NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 4, 'Media Sosial yang Sering Digunakan', 1, 5, '', '', ''),
(933, 0, 0, 0, 75, 'dropdown', '[\"Bekerja\",\"Melanjutkan Studi\",\"Wirausaha\",\"Belum Bekerja\"]', NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 5, 'Status Saat Ini', 1, 5, '', '', ''),
(934, 0, 0, 0, 75, 'scale', '[]', NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 6, 'Seberapa puas Anda dengan pendidikan yang diterima?', 1, 5, '', '', ''),
(935, 0, 0, 0, 75, 'textarea', NULL, NULL, 0, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 7, 'Saran untuk Pengembangan Kampus', 1, 5, '', '', ''),
(936, 0, 0, 0, 75, 'dropdown', '[\"Teknik Informatika\",\"Sistem Informasi\",\"Teknik Elektro\",\"Manajemen\",\"Akuntansi\"]', NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 8, 'Program Studi', 1, 5, '', '', ''),
(937, 0, 0, 0, 75, 'checkbox', '[\"Programming\",\"Desain Grafis\",\"Analisis Data\",\"Public Speaking\",\"Manajemen Proyek\"]', NULL, 0, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 9, 'Keterampilan yang Dikuasai', 1, 5, '', '', ''),
(938, 0, 0, 0, 75, 'scale', '[]', NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 10, 'Seberapa relevan pendidikan dengan pekerjaan Anda?', 1, 5, '', '', ''),
(939, 0, 0, 0, 76, 'text', '[]', NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 1, 'Nama Perusahaan', 1, 5, '', '', ''),
(940, 0, 0, 0, 76, 'text', '[]', NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 2, 'Jabatan/Posisi', 1, 5, '', '', ''),
(941, 0, 0, 0, 76, 'dropdown', '[\"Teknologi Informasi\",\"Keuangan\",\"Pendidikan\",\"Kesehatan\",\"Manufaktur\",\"Perdagangan\",\"Jasa\",\"Lainnya\"]', NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 3, 'Bidang Industri Perusahaan', 1, 5, '', '', ''),
(942, 0, 0, 0, 76, 'text', '[]', NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 4, 'Lama Bekerja di Perusahaan Saat Ini', 1, 5, '', '', ''),
(943, 0, 0, 0, 76, 'scale', '[]', NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 5, 'Seberapa puas Anda dengan gaji saat ini?', 1, 5, '', '', ''),
(944, 0, 0, 0, 76, 'scale', '[]', NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 6, 'Seberapa relevan pendidikan Anda dengan pekerjaan saat ini?', 1, 5, '', '', ''),
(945, 0, 0, 0, 76, 'checkbox', '[\"Kampus/Alumni\",\"Job Fair\",\"LinkedIn\",\"Situs Lowongan Kerja\",\"Rekomendasi Teman/Keluarga\",\"Lainnya\"]', NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 7, 'Sumber Informasi Lowongan Pekerjaan', 1, 5, '', '', ''),
(946, 0, 0, 0, 76, 'radio', '[\"Karyawan Tetap\",\"Karyawan Kontrak\",\"Freelance\",\"Magang\",\"Lainnya\"]', NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 8, 'Status Pekerjaan', 1, 5, '', '', ''),
(947, 0, 0, 0, 76, 'textarea', NULL, NULL, 0, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 9, 'Deskripsi Pekerjaan', 1, 5, '', '', ''),
(948, 0, 0, 0, 76, 'scale', '[]', NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 10, 'Seberapa sesuai pekerjaan Anda dengan minat dan bakat?', 1, 5, '', '', ''),
(949, 0, 0, 0, 77, 'text', '[]', NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 1, 'Nama Usaha/Bisnis', 1, 5, '', '', ''),
(950, 0, 0, 0, 77, 'dropdown', '[\"Makanan & Minuman\",\"Fashion\",\"Teknologi\",\"Jasa Pendidikan\",\"Kesehatan & Kecantikan\",\"Pertanian\",\"Kerajinan Tangan\",\"Lainnya\"]', NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 2, 'Bidang Usaha', 1, 5, '', '', ''),
(951, 0, 0, 0, 77, 'text', '[]', NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 3, 'Tahun Mulai Berwirausaha', 1, 5, '', '', ''),
(952, 0, 0, 0, 77, 'radio', '[\"Perorangan\",\"CV\",\"PT\",\"UD\",\"Koperasi\",\"Lainnya\"]', NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 4, 'Bentuk Legal Usaha', 1, 5, '', '', ''),
(953, 0, 0, 0, 77, 'scale', '[]', NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 5, 'Seberapa puas Anda dengan perkembangan usaha saat ini?', 1, 5, '', '', ''),
(954, 0, 0, 0, 77, 'checkbox', '[\"Tabungan Pribadi\",\"Pinjaman Bank\",\"Investor\",\"Bantuan Keluarga\",\"Program Kampus\",\"Lainnya\"]', NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 6, 'Sumber Modal Usaha', 1, 5, '', '', ''),
(955, 0, 0, 0, 77, 'text', '[]', NULL, 0, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 7, 'Jumlah Karyawan Tetap', 1, 5, '', '', ''),
(956, 0, 0, 0, 77, 'textarea', NULL, NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 8, 'Deskripsi Usaha dan Target Pasar', 1, 5, '', '', ''),
(957, 0, 0, 0, 77, 'scale', '[]', NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 9, 'Seberapa sesuai usaha Anda dengan latar belakang pendidikan?', 1, 5, '', '', ''),
(958, 0, 0, 0, 77, 'textarea', NULL, NULL, 0, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 10, 'Kendala dan Harapan Pengembangan Usaha', 1, 5, '', '', ''),
(959, 0, 0, 0, 78, 'checkbox', '[\"Masih mencari pekerjaan\",\"Melanjutkan studi\",\"Mengurus keluarga\",\"Sedang mengikuti pelatihan\",\"Belum ada kesempatan\",\"Lainnya\"]', NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 1, 'Alasan Belum Bekerja', 1, 5, '', '', ''),
(960, 0, 0, 0, 78, 'checkbox', '[\"Melamar pekerjaan\",\"Mengikuti job fair\",\"Mengikuti pelatihan/kursus\",\"Membuat CV/portofolio\",\"Networking\",\"Lainnya\"]', NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 2, 'Usaha Mencari Kerja', 1, 5, '', '', ''),
(961, 0, 0, 0, 78, 'text', '[]', NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 3, 'Jenis Pekerjaan yang Diinginkan', 1, 5, '', '', ''),
(962, 0, 0, 0, 78, 'text', '[]', NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 4, 'Lokasi Kerja yang Diharapkan', 1, 5, '', '', ''),
(963, 0, 0, 0, 78, 'scale', '[]', NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 5, 'Seberapa siap Anda memasuki dunia kerja?', 1, 5, '', '', ''),
(964, 0, 0, 0, 78, 'scale', '[]', NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 6, 'Apakah pencarian kerja Anda sesuai dengan bidang studi?', 1, 5, '', '', ''),
(965, 0, 0, 0, 78, 'text', '[]', NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 7, 'Tahun Lulus', 1, 5, '', '', ''),
(966, 0, 0, 0, 78, 'textarea', NULL, NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 8, 'Kendala dalam Mencari Kerja', 1, 5, '', '', ''),
(967, 0, 0, 0, 78, 'checkbox', '[\"Jobstreet\",\"LinkedIn\",\"Kalibrr\",\"Glints\",\"Website perusahaan langsung\",\"Media sosial\",\"Lainnya\"]', NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 9, 'Platform Pencarian Kerja', 1, 5, '', '', ''),
(968, 0, 0, 0, 78, 'textarea', NULL, NULL, 0, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 10, 'Harapan terhadap Kampus', 1, 5, '', '', ''),
(969, 0, 0, 0, 79, 'radio', '[\"S2/Magister\",\"S3/Doktor\",\"Profesi\",\"Lainnya\"]', NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 1, 'Jenjang Studi Lanjutan', 1, 5, '', '', ''),
(970, 0, 0, 0, 79, 'text', '[]', NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 2, 'Nama Institusi Pendidikan', 1, 5, '', '', ''),
(971, 0, 0, 0, 79, 'text', '[]', NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 3, 'Program Studi', 1, 5, '', '', ''),
(972, 0, 0, 0, 79, 'checkbox', '[\"Meningkatkan kualifikasi akademik\",\"Kebutuhan pekerjaan\",\"Minat pribadi\",\"Belum ingin bekerja\",\"Lainnya\"]', NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 4, 'Alasan Melanjutkan Studi', 1, 5, '', '', ''),
(973, 0, 0, 0, 79, 'scale', '[]', NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 5, 'Seberapa sesuai studi lanjutan Anda dengan pendidikan sebelumnya?', 1, 5, '', '', ''),
(974, 0, 0, 0, 79, 'checkbox', '[\"Biaya pribadi\",\"Beasiswa pemerintah\",\"Beasiswa kampus\",\"Orang tua/keluarga\",\"Sponsor perusahaan\",\"Lainnya\"]', NULL, 1, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 6, 'Sumber Pembiayaan Studi', 1, 5, '', '', ''),
(975, 0, 0, 0, 79, 'radio', '[\"Dalam negeri\",\"Luar negeri\"]', NULL, 1, NULL, '2025-06-23 08:30:20', NULL, NULL, NULL, 7, 'Lokasi Institusi Studi', 1, 5, '', '', ''),
(976, 0, 0, 0, 79, 'checkbox', '[\"Bekerja di bidang akademik\",\"Bekerja di industri\",\"Melanjutkan studi lagi\",\"Membuka usaha\",\"Belum memiliki rencana\",\"Lainnya\"]', NULL, 1, NULL, '2025-06-23 08:30:20', NULL, NULL, NULL, 8, 'Rencana Setelah Studi', 1, 5, '', '', ''),
(977, 0, 0, 0, 79, 'textarea', NULL, NULL, 0, NULL, '2025-06-23 08:30:20', NULL, NULL, NULL, 9, 'Tantangan dalam Studi Lanjutan', 1, 5, '', '', ''),
(978, 0, 0, 0, 79, 'textarea', NULL, NULL, 0, NULL, '2025-06-23 08:30:20', NULL, NULL, NULL, 10, 'Harapan terhadap Kampus Asal', 1, 5, '', '', ''),
(979, 0, 0, 0, 80, 'checkbox', '[{\"label\":\"wfcewd\",\"value\":\"ed\"},{\"label\":\"ewfed\",\"value\":\"f\"},{\"label\":\"ewfwe\",\"value\":\"ef\"},{\"label\":\"Lainnya\",\"value\":\"other\",\"isOther\":true}]', NULL, 0, NULL, '2025-06-23 08:30:20', NULL, NULL, NULL, 1, 'dcefc', 1, 5, '', '', ''),
(980, 0, 0, 0, 80, 'radio', '[{\"label\":\"trhr\",\"value\":\"ut\"},{\"label\":\"tujjyj\",\"value\":\"ytjt\"},{\"label\":\"uykyg\",\"value\":\"uj\"},{\"label\":\"Lainnya\",\"value\":\"other\",\"isOther\":true}]', NULL, 0, NULL, '2025-06-23 08:30:20', NULL, NULL, NULL, 2, 'yjyth', 1, 5, '', '', ''),
(981, 0, 0, 0, 80, 'dropdown', '[{\"label\":\"yb5\",\"value\":\"65b\",\"isOther\":false},{\"label\":\"y5b6\",\"value\":\"jyt\",\"isOther\":false},{\"label\":\"btrtyh\",\"value\":\"bjt\",\"isOther\":false},{\"label\":\"Lainnya\",\"value\":\"other\",\"isOther\":true},{\"label\":\"Lainnya\",\"value\":\"other\",\"isOther\":true}]', NULL, 0, NULL, '2025-06-23 08:30:20', NULL, NULL, NULL, 3, 'ytg45btgcgbnfgxb', 1, 5, '', '', ''),
(982, 0, 0, 0, 80, 'checkbox', '[{\"label\":\"fghbfb\",\"value\":\"fg\",\"isOther\":false},{\"label\":\"fghbvbcfgnghnjgh\",\"value\":\"h\",\"isOther\":false},{\"label\":\"fgbhfbh\",\"value\":\"fh\",\"isOther\":false},{\"label\":\"Lainnya\",\"value\":\"other\",\"isOther\":true},{\"label\":\"Lainnya\",\"value\":\"other\",\"isOther\":true}]', NULL, 0, NULL, '2025-06-23 08:30:20', NULL, NULL, NULL, 4, 'pertanyaan', 1, 5, '', '', ''),
(983, 0, 0, 0, 80, 'user_field', '[\"[\\\"[\\\\\\\"jenis_kelamin\\\\\\\"]\\\"]\"]', NULL, 0, NULL, '2025-06-23 08:30:20', NULL, NULL, NULL, 5, 'Data Pengguna', 1, 5, '', '', ''),
(984, 0, 0, 0, 81, 'text', '[]', NULL, 1, NULL, '2025-06-23 08:33:01', NULL, NULL, NULL, 1, 'Nama Lengkap', 1, 5, '', '', ''),
(985, 0, 0, 0, 81, 'email', '[]', NULL, 1, NULL, '2025-06-23 08:33:01', NULL, NULL, NULL, 2, 'Alamat Email', 1, 5, '', '', ''),
(986, 0, 0, 0, 81, 'dropdown', '[\"2024\",\"2023\",\"2022\",\"2021\",\"2020\"]', NULL, 1, NULL, '2025-06-23 08:33:02', NULL, NULL, NULL, 3, 'Tahun Lulus', 1, 5, '', '', ''),
(987, 0, 0, 0, 81, 'checkbox', '[\"Instagram\",\"Facebook\",\"LinkedIn\",\"Twitter\",\"TikTok\"]', NULL, 1, NULL, '2025-06-23 08:33:02', NULL, NULL, NULL, 4, 'Media Sosial yang Sering Digunakan', 1, 5, '', '', ''),
(988, 0, 0, 0, 81, 'dropdown', '[\"Bekerja\",\"Melanjutkan Studi\",\"Wirausaha\",\"Belum Bekerja\"]', NULL, 1, NULL, '2025-06-23 08:33:02', NULL, NULL, NULL, 5, 'Status Saat Ini', 1, 5, '', '', ''),
(989, 0, 0, 0, 81, 'scale', '[]', NULL, 1, NULL, '2025-06-23 08:33:02', NULL, NULL, NULL, 6, 'Seberapa puas Anda dengan pendidikan yang diterima?', 1, 5, '', '', ''),
(990, 0, 0, 0, 81, 'textarea', NULL, NULL, 0, NULL, '2025-06-23 08:33:02', NULL, NULL, NULL, 7, 'Saran untuk Pengembangan Kampus', 1, 5, '', '', ''),
(991, 0, 0, 0, 81, 'dropdown', '[\"Teknik Informatika\",\"Sistem Informasi\",\"Teknik Elektro\",\"Manajemen\",\"Akuntansi\"]', NULL, 1, NULL, '2025-06-23 08:33:02', NULL, NULL, NULL, 8, 'Program Studi', 1, 5, '', '', ''),
(992, 0, 0, 0, 81, 'checkbox', '[\"Programming\",\"Desain Grafis\",\"Analisis Data\",\"Public Speaking\",\"Manajemen Proyek\"]', NULL, 0, NULL, '2025-06-23 08:33:02', NULL, NULL, NULL, 9, 'Keterampilan yang Dikuasai', 1, 5, '', '', ''),
(993, 0, 0, 0, 81, 'scale', '[]', NULL, 1, NULL, '2025-06-23 08:33:02', NULL, NULL, NULL, 10, 'Seberapa relevan pendidikan dengan pekerjaan Anda?', 1, 5, '', '', ''),
(994, 0, 0, 0, 82, 'text', '[]', NULL, 1, NULL, '2025-06-23 08:33:02', NULL, NULL, NULL, 1, 'Nama Perusahaan', 1, 5, '', '', ''),
(995, 0, 0, 0, 82, 'text', '[]', NULL, 1, NULL, '2025-06-23 08:33:02', NULL, NULL, NULL, 2, 'Jabatan/Posisi', 1, 5, '', '', ''),
(996, 0, 0, 0, 82, 'dropdown', '[\"Teknologi Informasi\",\"Keuangan\",\"Pendidikan\",\"Kesehatan\",\"Manufaktur\",\"Perdagangan\",\"Jasa\",\"Lainnya\"]', NULL, 1, NULL, '2025-06-23 08:33:02', NULL, NULL, NULL, 3, 'Bidang Industri Perusahaan', 1, 5, '', '', ''),
(997, 0, 0, 0, 82, 'text', '[]', NULL, 1, NULL, '2025-06-23 08:33:02', NULL, NULL, NULL, 4, 'Lama Bekerja di Perusahaan Saat Ini', 1, 5, '', '', ''),
(998, 0, 0, 0, 82, 'scale', '[]', NULL, 1, NULL, '2025-06-23 08:33:02', NULL, NULL, NULL, 5, 'Seberapa puas Anda dengan gaji saat ini?', 1, 5, '', '', ''),
(999, 0, 0, 0, 82, 'scale', '[]', NULL, 1, NULL, '2025-06-23 08:33:02', NULL, NULL, NULL, 6, 'Seberapa relevan pendidikan Anda dengan pekerjaan saat ini?', 1, 5, '', '', ''),
(1000, 0, 0, 0, 82, 'checkbox', '[\"Kampus/Alumni\",\"Job Fair\",\"LinkedIn\",\"Situs Lowongan Kerja\",\"Rekomendasi Teman/Keluarga\",\"Lainnya\"]', NULL, 1, NULL, '2025-06-23 08:33:02', NULL, NULL, NULL, 7, 'Sumber Informasi Lowongan Pekerjaan', 1, 5, '', '', ''),
(1001, 0, 0, 0, 82, 'radio', '[\"Karyawan Tetap\",\"Karyawan Kontrak\",\"Freelance\",\"Magang\",\"Lainnya\"]', NULL, 1, NULL, '2025-06-23 08:33:02', NULL, NULL, NULL, 8, 'Status Pekerjaan', 1, 5, '', '', ''),
(1002, 0, 0, 0, 82, 'textarea', NULL, NULL, 0, NULL, '2025-06-23 08:33:02', NULL, NULL, NULL, 9, 'Deskripsi Pekerjaan', 1, 5, '', '', ''),
(1003, 0, 0, 0, 82, 'scale', '[]', NULL, 1, NULL, '2025-06-23 08:33:02', NULL, NULL, NULL, 10, 'Seberapa sesuai pekerjaan Anda dengan minat dan bakat?', 1, 5, '', '', ''),
(1004, 0, 0, 0, 83, 'text', '[]', NULL, 1, NULL, '2025-06-23 08:33:02', NULL, NULL, NULL, 1, 'Nama Usaha/Bisnis', 1, 5, '', '', ''),
(1005, 0, 0, 0, 83, 'dropdown', '[\"Makanan & Minuman\",\"Fashion\",\"Teknologi\",\"Jasa Pendidikan\",\"Kesehatan & Kecantikan\",\"Pertanian\",\"Kerajinan Tangan\",\"Lainnya\"]', NULL, 1, NULL, '2025-06-23 08:33:02', NULL, NULL, NULL, 2, 'Bidang Usaha', 1, 5, '', '', ''),
(1006, 0, 0, 0, 83, 'text', '[]', NULL, 1, NULL, '2025-06-23 08:33:02', NULL, NULL, NULL, 3, 'Tahun Mulai Berwirausaha', 1, 5, '', '', ''),
(1007, 0, 0, 0, 83, 'radio', '[\"Perorangan\",\"CV\",\"PT\",\"UD\",\"Koperasi\",\"Lainnya\"]', NULL, 1, NULL, '2025-06-23 08:33:02', NULL, NULL, NULL, 4, 'Bentuk Legal Usaha', 1, 5, '', '', ''),
(1008, 0, 0, 0, 83, 'scale', '[]', NULL, 1, NULL, '2025-06-23 08:33:02', NULL, NULL, NULL, 5, 'Seberapa puas Anda dengan perkembangan usaha saat ini?', 1, 5, '', '', ''),
(1009, 0, 0, 0, 83, 'checkbox', '[\"Tabungan Pribadi\",\"Pinjaman Bank\",\"Investor\",\"Bantuan Keluarga\",\"Program Kampus\",\"Lainnya\"]', NULL, 1, NULL, '2025-06-23 08:33:02', NULL, NULL, NULL, 6, 'Sumber Modal Usaha', 1, 5, '', '', ''),
(1010, 0, 0, 0, 83, 'text', '[]', NULL, 0, NULL, '2025-06-23 08:33:02', NULL, NULL, NULL, 7, 'Jumlah Karyawan Tetap', 1, 5, '', '', ''),
(1011, 0, 0, 0, 83, 'textarea', NULL, NULL, 1, NULL, '2025-06-23 08:33:02', NULL, NULL, NULL, 8, 'Deskripsi Usaha dan Target Pasar', 1, 5, '', '', ''),
(1012, 0, 0, 0, 83, 'scale', '[]', NULL, 1, NULL, '2025-06-23 08:33:02', NULL, NULL, NULL, 9, 'Seberapa sesuai usaha Anda dengan latar belakang pendidikan?', 1, 5, '', '', ''),
(1013, 0, 0, 0, 83, 'textarea', NULL, NULL, 0, NULL, '2025-06-23 08:33:02', NULL, NULL, NULL, 10, 'Kendala dan Harapan Pengembangan Usaha', 1, 5, '', '', ''),
(1014, 0, 0, 0, 84, 'checkbox', '[\"Masih mencari pekerjaan\",\"Melanjutkan studi\",\"Mengurus keluarga\",\"Sedang mengikuti pelatihan\",\"Belum ada kesempatan\",\"Lainnya\"]', NULL, 1, NULL, '2025-06-23 08:33:02', NULL, NULL, NULL, 1, 'Alasan Belum Bekerja', 1, 5, '', '', ''),
(1015, 0, 0, 0, 84, 'checkbox', '[\"Melamar pekerjaan\",\"Mengikuti job fair\",\"Mengikuti pelatihan/kursus\",\"Membuat CV/portofolio\",\"Networking\",\"Lainnya\"]', NULL, 1, NULL, '2025-06-23 08:33:02', NULL, NULL, NULL, 2, 'Usaha Mencari Kerja', 1, 5, '', '', ''),
(1016, 0, 0, 0, 84, 'text', '[]', NULL, 1, NULL, '2025-06-23 08:33:02', NULL, NULL, NULL, 3, 'Jenis Pekerjaan yang Diinginkan', 1, 5, '', '', ''),
(1017, 0, 0, 0, 84, 'text', '[]', NULL, 1, NULL, '2025-06-23 08:33:02', NULL, NULL, NULL, 4, 'Lokasi Kerja yang Diharapkan', 1, 5, '', '', ''),
(1018, 0, 0, 0, 84, 'scale', '[]', NULL, 1, NULL, '2025-06-23 08:33:02', NULL, NULL, NULL, 5, 'Seberapa siap Anda memasuki dunia kerja?', 1, 5, '', '', ''),
(1019, 0, 0, 0, 84, 'scale', '[]', NULL, 1, NULL, '2025-06-23 08:33:03', NULL, NULL, NULL, 6, 'Apakah pencarian kerja Anda sesuai dengan bidang studi?', 1, 5, '', '', ''),
(1020, 0, 0, 0, 84, 'text', '[]', NULL, 1, NULL, '2025-06-23 08:33:03', NULL, NULL, NULL, 7, 'Tahun Lulus', 1, 5, '', '', ''),
(1021, 0, 0, 0, 84, 'textarea', NULL, NULL, 1, NULL, '2025-06-23 08:33:03', NULL, NULL, NULL, 8, 'Kendala dalam Mencari Kerja', 1, 5, '', '', ''),
(1022, 0, 0, 0, 84, 'checkbox', '[\"Jobstreet\",\"LinkedIn\",\"Kalibrr\",\"Glints\",\"Website perusahaan langsung\",\"Media sosial\",\"Lainnya\"]', NULL, 1, NULL, '2025-06-23 08:33:03', NULL, NULL, NULL, 9, 'Platform Pencarian Kerja', 1, 5, '', '', ''),
(1023, 0, 0, 0, 84, 'textarea', NULL, NULL, 0, NULL, '2025-06-23 08:33:03', NULL, NULL, NULL, 10, 'Harapan terhadap Kampus', 1, 5, '', '', ''),
(1024, 0, 0, 0, 85, 'radio', '[\"S2/Magister\",\"S3/Doktor\",\"Profesi\",\"Lainnya\"]', NULL, 1, NULL, '2025-06-23 08:33:03', NULL, NULL, NULL, 1, 'Jenjang Studi Lanjutan', 1, 5, '', '', ''),
(1025, 0, 0, 0, 85, 'text', '[]', NULL, 1, NULL, '2025-06-23 08:33:03', NULL, NULL, NULL, 2, 'Nama Institusi Pendidikan', 1, 5, '', '', ''),
(1026, 0, 0, 0, 85, 'text', '[]', NULL, 1, NULL, '2025-06-23 08:33:03', NULL, NULL, NULL, 3, 'Program Studi', 1, 5, '', '', ''),
(1027, 0, 0, 0, 85, 'checkbox', '[\"Meningkatkan kualifikasi akademik\",\"Kebutuhan pekerjaan\",\"Minat pribadi\",\"Belum ingin bekerja\",\"Lainnya\"]', NULL, 1, NULL, '2025-06-23 08:33:03', NULL, NULL, NULL, 4, 'Alasan Melanjutkan Studi', 1, 5, '', '', ''),
(1028, 0, 0, 0, 85, 'scale', '[]', NULL, 1, NULL, '2025-06-23 08:33:03', NULL, NULL, NULL, 5, 'Seberapa sesuai studi lanjutan Anda dengan pendidikan sebelumnya?', 1, 5, '', '', ''),
(1029, 0, 0, 0, 85, 'checkbox', '[\"Biaya pribadi\",\"Beasiswa pemerintah\",\"Beasiswa kampus\",\"Orang tua/keluarga\",\"Sponsor perusahaan\",\"Lainnya\"]', NULL, 1, NULL, '2025-06-23 08:33:03', NULL, NULL, NULL, 6, 'Sumber Pembiayaan Studi', 1, 5, '', '', ''),
(1030, 0, 0, 0, 85, 'radio', '[\"Dalam negeri\",\"Luar negeri\"]', NULL, 1, NULL, '2025-06-23 08:33:03', NULL, NULL, NULL, 7, 'Lokasi Institusi Studi', 1, 5, '', '', ''),
(1031, 0, 0, 0, 85, 'checkbox', '[\"Bekerja di bidang akademik\",\"Bekerja di industri\",\"Melanjutkan studi lagi\",\"Membuka usaha\",\"Belum memiliki rencana\",\"Lainnya\"]', NULL, 1, NULL, '2025-06-23 08:33:03', NULL, NULL, NULL, 8, 'Rencana Setelah Studi', 1, 5, '', '', ''),
(1032, 0, 0, 0, 85, 'textarea', NULL, NULL, 0, NULL, '2025-06-23 08:33:03', NULL, NULL, NULL, 9, 'Tantangan dalam Studi Lanjutan', 1, 5, '', '', ''),
(1033, 0, 0, 0, 85, 'textarea', NULL, NULL, 0, NULL, '2025-06-23 08:33:03', NULL, NULL, NULL, 10, 'Harapan terhadap Kampus Asal', 1, 5, '', '', ''),
(1034, 0, 0, 0, 86, 'checkbox', '[{\"label\":\"wfcewd\",\"value\":\"ed\"},{\"label\":\"ewfed\",\"value\":\"f\"},{\"label\":\"ewfwe\",\"value\":\"ef\"},{\"label\":\"Lainnya\",\"value\":\"other\",\"isOther\":true}]', NULL, 0, NULL, '2025-06-23 08:33:03', NULL, NULL, NULL, 1, 'dcefc', 1, 5, '', '', ''),
(1035, 0, 0, 0, 86, 'radio', '[{\"label\":\"trhr\",\"value\":\"ut\"},{\"label\":\"tujjyj\",\"value\":\"ytjt\"},{\"label\":\"uykyg\",\"value\":\"uj\"},{\"label\":\"Lainnya\",\"value\":\"other\",\"isOther\":true}]', NULL, 0, NULL, '2025-06-23 08:33:03', NULL, NULL, NULL, 2, 'yjyth', 1, 5, '', '', ''),
(1036, 0, 0, 0, 86, 'dropdown', '[{\"label\":\"yb5\",\"value\":\"65b\",\"isOther\":false},{\"label\":\"y5b6\",\"value\":\"jyt\",\"isOther\":false},{\"label\":\"btrtyh\",\"value\":\"bjt\",\"isOther\":false},{\"label\":\"Lainnya\",\"value\":\"other\",\"isOther\":true},{\"label\":\"Lainnya\",\"value\":\"other\",\"isOther\":true}]', NULL, 0, NULL, '2025-06-23 08:33:03', NULL, NULL, NULL, 3, 'ytg45btgcgbnfgxb', 1, 5, '', '', ''),
(1037, 0, 0, 0, 86, 'checkbox', '[{\"label\":\"fghbfb\",\"value\":\"fg\",\"isOther\":false},{\"label\":\"fghbvbcfgnghnjgh\",\"value\":\"h\",\"isOther\":false},{\"label\":\"fgbhfbh\",\"value\":\"fh\",\"isOther\":false},{\"label\":\"Lainnya\",\"value\":\"other\",\"isOther\":true},{\"label\":\"Lainnya\",\"value\":\"other\",\"isOther\":true}]', NULL, 0, NULL, '2025-06-23 08:33:03', NULL, NULL, NULL, 4, 'pertanyaan', 1, 5, '', '', ''),
(1038, 0, 0, 0, 86, 'user_field', '[\"[\\\"[\\\\\\\"jenis_kelamin\\\\\\\"]\\\"]\"]', NULL, 0, NULL, '2025-06-23 08:33:03', NULL, NULL, NULL, 5, 'Data Pengguna', 1, 5, '', '', ''),
(1110, 909909, 40, 80, 101, 'user_field', '[\"nama\"]', '', 0, NULL, '2025-06-26 01:08:21', 135, NULL, NULL, 1, 'Nama lengkap', 1, 5, '', '', ''),
(1111, 243224, 40, 80, 101, 'email', '[]', '', 1, NULL, '2025-06-26 01:08:36', 135, NULL, NULL, 2, 'Masukkan email aktif Anda', 1, 5, '', '', ''),
(1112, 467977, 40, 80, 101, 'phone', '[]', '', 1, NULL, '2025-06-26 01:08:51', 135, NULL, NULL, 3, 'Masukkan no telp aktif anda', 1, 5, '', '', ''),
(1113, 787771, 40, 80, 102, 'dropdown', '[{\"label\":\"Teknik Mesin\",\"value\":\"Teknik Mesin\"},{\"label\":\"Teknik Sipil\",\"value\":\"Teknik Sipil\"},{\"label\":\"Akuntansi\",\"value\":\"Akuntansi\"},{\"label\":\"Teknik Kimia\",\"value\":\"Teknik Kimia\"},{\"label\":\"Bahasa Inggris\",\"value\":\"Bahasa Inggris\"},{\"label\":\"Teknik Elektro\",\"value\":\"Teknik Elektro\"},{\"label\":\"Lainnya\",\"value\":\"Lainnya\"}]', '', 0, NULL, '2025-06-26 01:11:53', 135, NULL, NULL, 1, 'Program Studi saat di POLBAN', 1, 5, '', '', ''),
(1114, 721338, 40, 80, 102, 'user_field', '[\"tahun_kelulusan\"]', '', 0, NULL, '2025-06-26 01:12:17', 135, NULL, NULL, 2, 'Tahun Lulus', 1, 5, '', '', ''),
(1116, 109117, 40, 83, 103, 'checkbox', '[{\"label\":\"Bekerja\",\"value\":\"Bekerja\"},{\"label\":\"Wirausaha\",\"value\":\"Wirausaha\"},{\"label\":\"Melanjutkan Studi\",\"value\":\"Melanjutkan Studi\"},{\"label\":\"Belum Bekerja\",\"value\":\"Belum Bekerja\"},{\"label\":\"Lainnya\",\"value\":\"Lainnya\"}]', '', 1, NULL, '2025-06-26 01:15:38', 135, NULL, NULL, 1, 'Kegiatan utama Anda saat ini', 1, 5, '', '', ''),
(1117, 324324, 40, 83, 103, 'radio', '[{\"label\":\"Sesuai Jurusan\",\"value\":\"Sesuai Jurusan\"},{\"label\":\"Tidak Sesuai Jurusan\",\"value\":\"Tidak Sesuai Jurusan\"}]', '', 1, NULL, '2025-06-26 01:16:20', 135, NULL, NULL, 2, 'Apakah pekerjaan Anda sesuai dengan jurusan saat kuliah?', 1, 5, '', '', ''),
(1118, 809136, 40, 83, 104, 'number', '[]', '', 1, NULL, '2025-06-26 01:16:55', 135, NULL, NULL, 1, 'Pendapatan bulanan pertama Anda (Rp)', 1, 5, '', '', ''),
(1119, 831678, 40, 83, 104, 'text', '[]', '', 0, NULL, '2025-06-26 01:17:12', 135, NULL, NULL, 2, 'Nama Instansi/Tempat Kerja atau Nama Kampus (Studi Lanjut)', 1, 5, '', '', ''),
(1120, 100402, 40, 84, 105, 'scale', '{\"min\":1,\"max\":5,\"labels\":[\"Sangat Tidak Relevan\",\" Tidak Relevan\",\" Netral\",\" Relevan\",\" Sangat Relevan\"]}', '', 1, NULL, '2025-06-26 01:19:36', 135, NULL, NULL, 1, 'Seberapa relevan pendidikan di POLBAN dengan aktivitas Anda saat ini?', 1, 5, '', '', ''),
(1121, 734958, 40, 84, 106, 'grid', '{\"rows\":[\"Komunikasi\",\"Kerjasama Tim\",\"Disiplin\",\"Etika Kerja\",\"Problem Solving\"],\"columns\":[\"1\",\"2\",\"3\",\"4\",\"5\"]}', '', 0, NULL, '2025-06-26 01:21:31', 135, NULL, NULL, 1, 'Bagaimana Anda menilai kompetensi berikut saat Anda bekerja/studi?', 1, 5, '', '', ''),
(1122, 994539, 1, 85, 107, 'user_field', '[\"nama\"]', '', 0, NULL, '2025-06-26 01:27:00', 135, NULL, NULL, 1, 'Nama lengkap', 1, 5, '', '', ''),
(1123, 239210, 1, 85, 107, 'email', '[]', '', 0, NULL, '2025-06-26 01:27:39', 135, NULL, NULL, 2, 'Masukkan email aktif Anda', 1, 5, '', '', ''),
(1124, 121570, 1, 85, 107, 'phone', '[]', '', 1, NULL, '2025-06-26 01:27:58', 135, NULL, NULL, 3, 'Masukkan no telp aktif anda', 1, 5, '', '', ''),
(1125, 403276, 1, 85, 108, 'dropdown', '[{\"label\":\"Teknik Mesin\",\"value\":\"Teknik Mesin\"},{\"label\":\"Teknik Sipil\",\"value\":\"Teknik Sipil\"},{\"label\":\"Akuntansi\",\"value\":\"Akuntansi\"},{\"label\":\"Bahasa Inggris\",\"value\":\"Bahasa Inggris\"},{\"label\":\"Teknik Elektro\",\"value\":\"Teknik Elektro\"},{\"label\":\"Lainnya\",\"value\":\"Lainnya\"}]', '', 0, NULL, '2025-06-26 02:07:15', 135, NULL, NULL, 1, 'Program Studi saat kuliah di POLBAN', 1, 5, '', '', ''),
(1126, 227633, 1, 85, 108, 'user_field', '[\"tahun_kelulusan\"]', '', 0, NULL, '2025-06-26 02:07:53', 135, NULL, NULL, 2, 'Tahun Lulus', 1, 5, '', '', ''),
(1127, 180657, 1, 86, 109, 'checkbox', '[{\"label\":\"Bekerja\",\"value\":\"Bekerja\"},{\"label\":\"Wirausaha\",\"value\":\"Wirausaha\"},{\"label\":\"Melanjutkan Studi\",\"value\":\"Melanjutkan Studi\"},{\"label\":\"Belum Bekerja\",\"value\":\"Belum Bekerja\"},{\"label\":\"Lainnya\",\"value\":\"Lainnya\"}]', '', 0, NULL, '2025-06-26 02:11:31', 135, NULL, NULL, 1, 'Apa aktivitas utama Anda saat ini?', 1, 5, '', '', ''),
(1128, 225532, 1, 86, 109, 'radio', '[{\"label\":\"Sangat Relevan\",\"value\":\"Sangat Relevan\"},{\"label\":\"Cukup Relevan\",\"value\":\"Cukup Relevan\"},{\"label\":\"Tidak Relevan\",\"value\":\"Tidak Relevan\"}]', '', 0, NULL, '2025-06-26 02:12:05', 135, NULL, NULL, 2, 'Apakah pekerjaan Anda relevan dengan jurusan saat kuliah?', 1, 5, '', '', ''),
(1129, 815563, 1, 86, 110, 'number', '[]', '', 1, NULL, '2025-06-26 02:13:06', 135, NULL, NULL, 1, 'Pendapatan bulanan Anda saat ini (Rp)', 1, 5, '', '', ''),
(1130, 526585, 1, 86, 110, 'text', '[]', '', 1, NULL, '2025-06-26 02:13:16', 135, NULL, NULL, 2, 'Nama tempat kerja atau institusi studi lanjut', 1, 5, '', '', ''),
(1131, 914196, 1, 87, 111, 'scale', '{\"min\":1,\"max\":5,\"labels\":[\"sangat Tidak Berpengaruh\",\" Tidak Berpengaruh\",\" Netral\",\" Berpengaruh\",\" Sangat Berpengaruh\"]}', '', 1, NULL, '2025-06-26 02:15:09', 135, NULL, NULL, 1, 'Seberapa besar pengaruh pendidikan di POLBAN terhadap karier Anda?', 1, 5, '', '', ''),
(1132, 143235, 1, 87, 112, 'grid', '{\"rows\":[\"Etos Kerja\",\"Kedisiplinan\",\"Inisiatif\",\"Kemampuan Teknologi\",\"Kepemimpinan\"],\"columns\":[\"1\",\"2\",\"3\",\"4\",\"5\"]}', '', 0, NULL, '2025-06-26 02:16:44', 135, NULL, NULL, 1, 'Penilaian Kompetensi Lulusan', 1, 5, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `kuesioner_kuesioner`
--

CREATE TABLE `kuesioner_kuesioner` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `entries` int(11) DEFAULT 0,
  `active` enum('Ya','Tidak') DEFAULT 'Tidak',
  `deskripsi` text DEFAULT NULL,
  `pages` tinytext DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `ordering_count` int(11) UNSIGNED DEFAULT NULL,
  `conditional_logic` text DEFAULT NULL,
  `status` varchar(20) DEFAULT 'nonaktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kuesioner_kuesioner`
--

INSERT INTO `kuesioner_kuesioner` (`id`, `title`, `entries`, `active`, `deskripsi`, `pages`, `created_on`, `created_by`, `updated_on`, `updated_by`, `ordering_count`, `conditional_logic`, `status`) VALUES
(1, 'Tracer Study Alumni Politeknik Negeri Bandung – Lulusan 2022', 0, 'Ya', 'Kuesioner ini ditujukan untuk alumni POLBAN lulusan 2022, guna mengevaluasi dampak pendidikan terhadap aktivitas Anda saat ini.\nJawaban Anda bersifat rahasia dan akan digunakan untuk pengembangan institusi.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'nonaktif'),
(40, 'Tracer Study Alumni Politeknik Negeri Bandung – Lulusan 2024', 0, 'Ya', 'Kuesioner ini bertujuan untuk memetakan jejak karier alumni POLBAN lulusan tahun 2024.\nData Anda akan sangat membantu dalam meningkatkan mutu pendidikan dan layanan kampus.\nJawaban Anda bersifat rahasia dan hanya untuk kebutuhan evaluasi internal.', NULL, '2025-05-14 09:50:00', 1, '2025-05-14 09:50:00', 1, 1, '[{\"ShowIf\":\"angkatan\",\"condition\":\"is\",\"value\":\"2024\"}]', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `kuesioner_kuesioner_section`
--

CREATE TABLE `kuesioner_kuesioner_section` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(128) NOT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `kuesioner_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `section_options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fields` text DEFAULT NULL,
  `conditional_logic` text DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `ordering_count` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kuesioner_kuesioner_section`
--

INSERT INTO `kuesioner_kuesioner_section` (`id`, `title`, `deskripsi`, `kuesioner_id`, `page_id`, `section_options`, `fields`, `conditional_logic`, `created_on`, `created_by`, `updated_on`, `updated_by`, `ordering_count`) VALUES
(69, 'semua', '', 58, 68, '\r\n{\r\n  \"condition_type\": \"default\",\r\n  \"display_name\": \"semua\",\r\n  \"show_for_all\": true,\r\n  \"fields\": [\r\n    {\r\n      \"name\": \"nama_lengkap\",\r\n      \"type\": \"text\",\r\n      \"required\": true\r\n    },\r\n    {\r\n      \"name\": \"email\",\r\n      \"type\": \"email\",\r\n      \"required\": true\r\n    }\r\n  ]\r\n}\r\n', NULL, NULL, '2025-06-23 07:27:28', NULL, NULL, NULL, 1),
(70, 'Bekerja', '', 58, 68, '\r\n{\r\n  \"condition_type\": \"status_condition\",\r\n  \"status\": \"Bekerja\",\r\n  \"display_name\": \"Bekerja\",\r\n  \"fields\": [\r\n    {\r\n      \"name\": \"nama_perusahaan\",\r\n      \"type\": \"text\",\r\n      \"required\": true,\r\n      \"label\": \"Nama Perusahaan\"\r\n    },\r\n    {\r\n      \"name\": \"jabatan\",\r\n      \"type\": \"text\",\r\n      \"required\": true\r\n    },\r\n    {\r\n      \"name\": \"gaji\",\r\n      \"type\": \"number\",\r\n      \"required\": false\r\n    }\r\n  ],\r\n  \"next_section\": 16\r\n}\r\n', NULL, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 2),
(71, 'Wirausaha', '', 58, 68, '\r\n{\r\n  \"condition_type\": \"status_condition\",\r\n  \"status\": \"Wirausaha\",\r\n  \"display_name\": \"Wirausaha\",\r\n  \"fields\": [\r\n    {\r\n      \"name\": \"nama_usaha\",\r\n      \"type\": \"text\",\r\n      \"required\": true,\r\n      \"label\": \"Nama Usaha\"\r\n    },\r\n    {\r\n      \"name\": \"bidang_usaha\",\r\n      \"type\": \"select\",\r\n      \"options\": [\"Makanan\", \"Fashion\", \"Teknologi\", \"Jasa\"],\r\n      \"required\": true\r\n    }\r\n  ],\r\n  \"next_section\": 17\r\n}\r\n', NULL, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 3),
(72, 'Belum Bekerja', '', 58, 68, '\r\n{\r\n  \"condition_type\": \"status_condition\",\r\n  \"status\": \"Belum Bekerja\",\r\n  \"display_name\": \"Aktivitas Saat Ini\",\r\n  \"fields\": [\r\n    {\r\n      \"name\": \"kegiatan\",\r\n      \"type\": \"text\",\r\n      \"required\": true,\r\n      \"label\": \"Apa yang sedang Anda lakukan?\"\r\n    },\r\n    {\r\n      \"name\": \"mencari_kerja\",\r\n      \"type\": \"radio\",\r\n      \"options\": [\"Ya\", \"Tidak\"],\r\n      \"required\": true\r\n    }\r\n  ],\r\n  \"next_section\": 19\r\n}\r\n', NULL, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 4),
(73, 'Melanjutkan Studi', '', 58, 68, '\r\n{\r\n  \"condition_type\": \"status_condition\",\r\n  \"status\": \"Melanjutkan Studi\",\r\n  \"display_name\": \"Melanjutkan Studi\",\r\n  \"fields\": [\r\n    {\r\n      \"name\": \"nama_instansi\",\r\n      \"type\": \"text\",\r\n      \"required\": true,\r\n      \"label\": \"Nama Kampus/Institusi\"\r\n    },\r\n    {\r\n      \"name\": \"jenjang\",\r\n      \"type\": \"select\",\r\n      \"options\": [\"S2\", \"S3\", \"Profesi\", \"Lainnya\"],\r\n      \"required\": true\r\n    }\r\n  ],\r\n  \"next_section\": 14\r\n}\r\n', NULL, NULL, '2025-06-23 07:27:29', NULL, NULL, NULL, 5),
(74, 'section1', '', 58, 69, NULL, NULL, NULL, '2025-06-23 07:27:30', NULL, NULL, NULL, 1),
(75, 'semua', '', 59, 70, '\r\n{\r\n  \"condition_type\": \"default\",\r\n  \"display_name\": \"semua\",\r\n  \"show_for_all\": true,\r\n  \"fields\": [\r\n    {\r\n      \"name\": \"nama_lengkap\",\r\n      \"type\": \"text\",\r\n      \"required\": true\r\n    },\r\n    {\r\n      \"name\": \"email\",\r\n      \"type\": \"email\",\r\n      \"required\": true\r\n    }\r\n  ]\r\n}\r\n', NULL, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 1),
(76, 'Bekerja', '', 59, 70, '\r\n{\r\n  \"condition_type\": \"status_condition\",\r\n  \"status\": \"Bekerja\",\r\n  \"display_name\": \"Bekerja\",\r\n  \"fields\": [\r\n    {\r\n      \"name\": \"nama_perusahaan\",\r\n      \"type\": \"text\",\r\n      \"required\": true,\r\n      \"label\": \"Nama Perusahaan\"\r\n    },\r\n    {\r\n      \"name\": \"jabatan\",\r\n      \"type\": \"text\",\r\n      \"required\": true\r\n    },\r\n    {\r\n      \"name\": \"gaji\",\r\n      \"type\": \"number\",\r\n      \"required\": false\r\n    }\r\n  ],\r\n  \"next_section\": 16\r\n}\r\n', NULL, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 2),
(77, 'Wirausaha', '', 59, 70, '\r\n{\r\n  \"condition_type\": \"status_condition\",\r\n  \"status\": \"Wirausaha\",\r\n  \"display_name\": \"Wirausaha\",\r\n  \"fields\": [\r\n    {\r\n      \"name\": \"nama_usaha\",\r\n      \"type\": \"text\",\r\n      \"required\": true,\r\n      \"label\": \"Nama Usaha\"\r\n    },\r\n    {\r\n      \"name\": \"bidang_usaha\",\r\n      \"type\": \"select\",\r\n      \"options\": [\"Makanan\", \"Fashion\", \"Teknologi\", \"Jasa\"],\r\n      \"required\": true\r\n    }\r\n  ],\r\n  \"next_section\": 17\r\n}\r\n', NULL, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 3),
(78, 'Belum Bekerja', '', 59, 70, '\r\n{\r\n  \"condition_type\": \"status_condition\",\r\n  \"status\": \"Belum Bekerja\",\r\n  \"display_name\": \"Aktivitas Saat Ini\",\r\n  \"fields\": [\r\n    {\r\n      \"name\": \"kegiatan\",\r\n      \"type\": \"text\",\r\n      \"required\": true,\r\n      \"label\": \"Apa yang sedang Anda lakukan?\"\r\n    },\r\n    {\r\n      \"name\": \"mencari_kerja\",\r\n      \"type\": \"radio\",\r\n      \"options\": [\"Ya\", \"Tidak\"],\r\n      \"required\": true\r\n    }\r\n  ],\r\n  \"next_section\": 19\r\n}\r\n', NULL, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 4),
(79, 'Melanjutkan Studi', '', 59, 70, '\r\n{\r\n  \"condition_type\": \"status_condition\",\r\n  \"status\": \"Melanjutkan Studi\",\r\n  \"display_name\": \"Melanjutkan Studi\",\r\n  \"fields\": [\r\n    {\r\n      \"name\": \"nama_instansi\",\r\n      \"type\": \"text\",\r\n      \"required\": true,\r\n      \"label\": \"Nama Kampus/Institusi\"\r\n    },\r\n    {\r\n      \"name\": \"jenjang\",\r\n      \"type\": \"select\",\r\n      \"options\": [\"S2\", \"S3\", \"Profesi\", \"Lainnya\"],\r\n      \"required\": true\r\n    }\r\n  ],\r\n  \"next_section\": 14\r\n}\r\n', NULL, NULL, '2025-06-23 08:30:19', NULL, NULL, NULL, 5),
(80, 'section1', '', 59, 71, NULL, NULL, NULL, '2025-06-23 08:30:20', NULL, NULL, NULL, 1),
(81, 'semua', '', 60, 72, '\r\n{\r\n  \"condition_type\": \"default\",\r\n  \"display_name\": \"semua\",\r\n  \"show_for_all\": true,\r\n  \"fields\": [\r\n    {\r\n      \"name\": \"nama_lengkap\",\r\n      \"type\": \"text\",\r\n      \"required\": true\r\n    },\r\n    {\r\n      \"name\": \"email\",\r\n      \"type\": \"email\",\r\n      \"required\": true\r\n    }\r\n  ]\r\n}\r\n', NULL, NULL, '2025-06-23 08:33:01', NULL, NULL, NULL, 1),
(82, 'Bekerja', '', 60, 72, '\r\n{\r\n  \"condition_type\": \"status_condition\",\r\n  \"status\": \"Bekerja\",\r\n  \"display_name\": \"Bekerja\",\r\n  \"fields\": [\r\n    {\r\n      \"name\": \"nama_perusahaan\",\r\n      \"type\": \"text\",\r\n      \"required\": true,\r\n      \"label\": \"Nama Perusahaan\"\r\n    },\r\n    {\r\n      \"name\": \"jabatan\",\r\n      \"type\": \"text\",\r\n      \"required\": true\r\n    },\r\n    {\r\n      \"name\": \"gaji\",\r\n      \"type\": \"number\",\r\n      \"required\": false\r\n    }\r\n  ],\r\n  \"next_section\": 16\r\n}\r\n', NULL, NULL, '2025-06-23 08:33:02', NULL, NULL, NULL, 2),
(83, 'Wirausaha', '', 60, 72, '\r\n{\r\n  \"condition_type\": \"status_condition\",\r\n  \"status\": \"Wirausaha\",\r\n  \"display_name\": \"Wirausaha\",\r\n  \"fields\": [\r\n    {\r\n      \"name\": \"nama_usaha\",\r\n      \"type\": \"text\",\r\n      \"required\": true,\r\n      \"label\": \"Nama Usaha\"\r\n    },\r\n    {\r\n      \"name\": \"bidang_usaha\",\r\n      \"type\": \"select\",\r\n      \"options\": [\"Makanan\", \"Fashion\", \"Teknologi\", \"Jasa\"],\r\n      \"required\": true\r\n    }\r\n  ],\r\n  \"next_section\": 17\r\n}\r\n', NULL, NULL, '2025-06-23 08:33:02', NULL, NULL, NULL, 3),
(84, 'Belum Bekerja', '', 60, 72, '\r\n{\r\n  \"condition_type\": \"status_condition\",\r\n  \"status\": \"Belum Bekerja\",\r\n  \"display_name\": \"Aktivitas Saat Ini\",\r\n  \"fields\": [\r\n    {\r\n      \"name\": \"kegiatan\",\r\n      \"type\": \"text\",\r\n      \"required\": true,\r\n      \"label\": \"Apa yang sedang Anda lakukan?\"\r\n    },\r\n    {\r\n      \"name\": \"mencari_kerja\",\r\n      \"type\": \"radio\",\r\n      \"options\": [\"Ya\", \"Tidak\"],\r\n      \"required\": true\r\n    }\r\n  ],\r\n  \"next_section\": 19\r\n}\r\n', NULL, NULL, '2025-06-23 08:33:02', NULL, NULL, NULL, 4),
(85, 'Melanjutkan Studi', '', 60, 72, '\r\n{\r\n  \"condition_type\": \"status_condition\",\r\n  \"status\": \"Melanjutkan Studi\",\r\n  \"display_name\": \"Melanjutkan Studi\",\r\n  \"fields\": [\r\n    {\r\n      \"name\": \"nama_instansi\",\r\n      \"type\": \"text\",\r\n      \"required\": true,\r\n      \"label\": \"Nama Kampus/Institusi\"\r\n    },\r\n    {\r\n      \"name\": \"jenjang\",\r\n      \"type\": \"select\",\r\n      \"options\": [\"S2\", \"S3\", \"Profesi\", \"Lainnya\"],\r\n      \"required\": true\r\n    }\r\n  ],\r\n  \"next_section\": 14\r\n}\r\n', NULL, NULL, '2025-06-23 08:33:03', NULL, NULL, NULL, 5),
(86, 'section1', '', 60, 73, NULL, NULL, NULL, '2025-06-23 08:33:03', NULL, NULL, NULL, 1),
(101, 'Data Pribadi', '', 40, 80, NULL, NULL, NULL, '2025-06-26 01:07:51', NULL, '2025-06-26 01:09:07', NULL, 1),
(102, 'Riwayat Studi', '', 40, 80, NULL, NULL, NULL, '2025-06-26 01:09:33', NULL, '2025-06-26 01:12:21', NULL, 2),
(103, 'Status Saat Ini', '', 40, 83, NULL, NULL, NULL, '2025-06-26 01:13:21', NULL, '2025-06-26 01:16:26', NULL, 1),
(104, 'Informasi Pekerjaan', '', 40, 83, NULL, NULL, NULL, '2025-06-26 01:16:38', NULL, '2025-06-26 01:17:32', NULL, 2),
(105, 'Penilaian Pendidikan', '', 40, 84, NULL, NULL, NULL, '2025-06-26 01:18:20', NULL, '2025-06-26 01:19:44', NULL, 1),
(106, 'Penilaian Kompetensi', '', 40, 84, NULL, NULL, NULL, '2025-06-26 01:20:06', NULL, '2025-06-26 01:21:43', NULL, 2),
(107, 'Data Pribadi', '', 1, 85, NULL, NULL, NULL, '2025-06-26 01:26:38', NULL, '2025-06-26 02:06:20', NULL, 1),
(108, 'Riwayat Studi di POLBAN', '', 1, 85, NULL, NULL, NULL, '2025-06-26 02:06:25', NULL, '2025-06-26 02:08:03', NULL, 2),
(109, 'Aktivitas Saat Ini', '', 1, 86, NULL, NULL, NULL, '2025-06-26 02:09:18', NULL, '2025-06-26 02:12:48', NULL, 1),
(110, 'Perjalanan Karier', '', 1, 86, NULL, NULL, NULL, '2025-06-26 02:12:56', NULL, '2025-06-26 02:13:20', NULL, 2),
(111, 'Relevansi Pendidikan', '', 1, 87, NULL, NULL, NULL, '2025-06-26 02:13:57', NULL, '2025-06-26 02:15:20', NULL, 1),
(112, 'Penilaian Kompetensi Lulusan', '', 1, 87, NULL, NULL, NULL, '2025-06-26 02:15:26', NULL, '2025-06-26 02:16:48', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `kuesioner_page`
--

CREATE TABLE `kuesioner_page` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `kuesioner_id` int(11) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `sections` text DEFAULT NULL,
  `conditional_logic` text DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `ordering_count` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kuesioner_page`
--

INSERT INTO `kuesioner_page` (`id`, `title`, `kuesioner_id`, `deskripsi`, `sections`, `conditional_logic`, `created_on`, `created_by`, `updated_on`, `updated_by`, `ordering_count`) VALUES
(68, 'all', 58, '', NULL, '', '2025-06-23 07:27:28', NULL, NULL, NULL, 1),
(69, 'hal 2', 58, '', NULL, '', '2025-06-23 07:27:30', NULL, NULL, NULL, 2),
(70, 'all', 59, '', NULL, '', '2025-06-23 08:30:19', NULL, NULL, NULL, 1),
(71, 'hal 2', 59, '', NULL, '', '2025-06-23 08:30:20', NULL, NULL, NULL, 2),
(72, 'all', 60, '', NULL, '', '2025-06-23 08:33:01', NULL, NULL, NULL, 1),
(73, 'hal 2', 60, '', NULL, '', '2025-06-23 08:33:03', NULL, NULL, NULL, 2),
(80, 'Halaman 1 - Identitas Alumni', 40, '', NULL, '', '2025-06-26 00:52:52', NULL, '2025-06-26 01:12:26', NULL, 1),
(83, 'Halaman 2 - Aktivitas Alumni Setelah Lulus', 40, '', NULL, '', '2025-06-26 01:13:05', NULL, '2025-06-26 01:17:36', NULL, 2),
(84, ' Halaman 3 - Evaluasi dan Masukan', 40, '', NULL, '', '2025-06-26 01:17:43', NULL, '2025-06-26 01:21:45', NULL, 3),
(85, 'Halaman 1 - Informasi Pribadi', 1, '', NULL, '', '2025-06-26 01:25:26', NULL, '2025-06-26 02:08:06', NULL, 1),
(86, 'Halaman 2 - Aktivitas dan Pekerjaan', 1, '', NULL, '', '2025-06-26 02:08:17', NULL, '2025-06-26 02:13:33', NULL, 2),
(87, 'Halaman 3 - Evaluasi Terhadap POLBAN', 1, '', NULL, '', '2025-06-26 02:13:43', NULL, '2025-06-26 02:16:57', NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `navigation_links`
--

CREATE TABLE `navigation_links` (
  `id` int(11) NOT NULL,
  `label` varchar(100) NOT NULL,
  `url` text NOT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `navigation_links`
--

INSERT INTO `navigation_links` (`id`, `label`, `url`, `is_active`) VALUES
(1, 'Home', '/', 1),
(2, 'Kontak', 'https://penelusuranalumni.polban.ac.id/kontak', 1),
(3, 'Tentang', 'https://penelusuranalumni.polban.ac.id/tentang', 1),
(4, 'Respon TS', 'https://penelusuranalumni.polban.ac.id/kuesioner/kuesioner/hasil', 1),
(5, 'Laporan TS', 'https://penelusuranalumni.polban.ac.id/kuesioner/kuesioner/laporan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_name` varchar(100) DEFAULT NULL,
  `slug` varchar(150) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `tipe` enum('Jurusan','Program Studi') NOT NULL,
  `urutan` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `name`, `short_name`, `slug`, `description`, `tipe`, `urutan`, `parent_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(17, 'Administrasi Niaga', 'Adbis', 'administrasi-niaga', 'Jurusan Administrasi Niaga', 'Jurusan', NULL, NULL, '2025-03-18 04:36:54', '2025-05-21 06:14:37', NULL),
(18, 'Akuntansi', 'AK', 'Akuntansi', 'WFGDFDFH', 'Jurusan', 2, NULL, '2025-03-18 04:36:54', '2025-06-20 01:14:30', NULL),
(19, 'Bahasa Inggris', 'BI', 'bahasa-inggris', 'Jurusan Bahasa Inggris', 'Jurusan', NULL, NULL, '2025-03-18 04:36:54', '2025-05-21 06:14:37', NULL),
(20, 'Teknik Elektro', 'TE', 'teknik-elektro', 'Jurusan Teknik Elektro', 'Jurusan', NULL, NULL, '2025-03-18 04:36:54', '2025-05-21 06:14:37', NULL),
(21, 'Teknik Kimia', 'TK', 'teknik-kimia', 'Jurusan Teknik Kimia', 'Jurusan', NULL, NULL, '2025-03-18 04:36:54', '2025-05-21 06:14:37', NULL),
(22, 'Teknik Komputer dan Informatika', 'TKI', 'teknik-komputer-informatika', 'Jurusan Teknik Komputer dan Informatika', 'Jurusan', NULL, NULL, '2025-03-18 04:36:54', '2025-05-21 06:14:37', NULL),
(23, 'Teknik Konversi Energi', 'TKE', 'teknik-konversi-energi', 'Jurusan Teknik Konversi Energi', 'Jurusan', NULL, NULL, '2025-03-18 04:36:54', '2025-05-21 06:14:37', NULL),
(24, 'Teknik Mesin', 'TM', 'teknik-mesin', 'Jurusan Teknik Mesin', 'Jurusan', NULL, NULL, '2025-03-18 04:36:54', '2025-05-21 06:14:37', NULL),
(25, 'Teknik Refrigerasi dan Tata Udara', 'RTA', 'refrigerasi-tata-udara', 'Jurusan Teknik Refrigerasi dan Tata Udara', 'Jurusan', NULL, NULL, '2025-03-18 04:36:54', '2025-05-21 06:14:37', NULL),
(26, 'Teknik Sipil', 'TS', 'teknik-sipil', 'Jurusan Teknik Sipil', 'Jurusan', NULL, NULL, '2025-03-18 04:36:54', '2025-05-21 06:14:37', NULL),
(39, 'DIII - Administrasi Bisnis', 'D3-Adbis', 'd3-administrasi-bisnis', 'Program Studi DIII Administrasi Bisnis', 'Program Studi', NULL, 17, '2025-03-18 21:53:39', '2025-05-21 06:14:37', NULL),
(40, 'DIII - Akuntansi', 'D3-AK', 'd3-akuntansi', 'Program Studi DIII Akuntansi', 'Program Studi', NULL, 18, '2025-03-18 21:54:03', '2025-05-21 06:14:37', NULL),
(41, 'DIII - Analis Kimia	', 'D3-AKIM', 'd3-analis-kimia', 'Program Studi DIII Analis Kimia', 'Program Studi', NULL, 21, '2025-03-18 21:54:24', '2025-05-21 06:14:37', NULL),
(42, 'DIII - Bahasa Inggris', 'D3-BI', 'd3-bahasa-inggris', 'Program Studi DIII Bahasa Inggris', 'Program Studi', NULL, 19, '2025-03-18 21:54:48', '2025-05-21 06:14:37', NULL),
(43, ' DIII - Keuangan dan Perbankan', 'D3-KP', 'd3-keuangan-perbankan', 'Program Studi DIII Keuangan dan Perbankan', 'Program Studi', NULL, 18, '2025-03-18 21:55:21', '2025-05-21 06:14:37', NULL),
(44, 'DIII - Manajemen Pemasaran	', 'D3-MP', 'd3-manajemen-pemasaran', 'Program Studi DIII Manajemen Pemasaran', 'Program Studi', NULL, 17, '2025-03-18 21:55:44', '2025-05-21 06:14:37', NULL),
(45, 'DIII - Teknik Aeronautika', 'D3-TA', 'd3-teknik-aeronautika', 'Program Studi DIII Teknik Aeronautika', 'Program Studi', NULL, 24, '2025-03-18 21:56:15', '2025-05-21 06:14:37', NULL),
(46, 'DIII - Teknik Elektronika	', 'D3-TEL', 'd3-teknik-elektronika', 'Program Studi DIII Teknik Elektronika', 'Program Studi', NULL, 20, '2025-03-18 21:56:38', '2025-05-21 06:14:37', NULL),
(47, 'DIII - Teknik Informatika	', 'D3-TI', 'd3-teknik-informatika', 'Program Studi DIII Teknik Informatika', 'Program Studi', NULL, 22, '2025-03-18 21:56:56', '2025-05-21 06:14:37', NULL),
(48, 'DIII - Teknik Kimia	', 'D3-TK', 'd3-teknik-kimia', 'Program Studi DIII Teknik Kimia', 'Program Studi', NULL, 21, '2025-03-18 21:57:20', '2025-05-21 06:14:37', NULL),
(49, 'DIII - Teknik Konstruksi Gedung', 'D3-TKG', 'd3-teknik-konstruksi-gedung', 'Program Studi DIII Teknik Konstruksi Gedung', 'Program Studi', NULL, 26, '2025-03-18 21:57:38', '2025-05-21 06:14:37', NULL),
(50, ' DIII - Teknik Konstruksi Sipil	', 'D3-TKS', 'd3-teknik-konstruksi-sipil', 'Program Studi DIII Teknik Konstruksi Sipil', 'Program Studi', NULL, 26, '2025-03-18 21:58:01', '2025-05-21 06:14:37', NULL),
(51, 'DIII - Teknik Konversi Energi', 'D3-TKE', 'd3-teknik-konversi-energi', 'Program Studi DIII Teknik Konversi Energi', 'Program Studi', NULL, 23, '2025-03-18 21:58:31', '2025-05-21 06:14:37', NULL),
(52, 'DIII - Teknik Listrik', 'D3-TL', 'd3-teknik-listrik', 'Program Studi DIII Teknik Listrik', 'Program Studi', NULL, 20, '2025-03-18 21:59:04', '2025-05-21 06:14:37', NULL),
(53, 'DIII - Teknik Mesin	', 'D3-TM', 'd3-teknik-mesin', 'Program Studi DIII Teknik Mesin', 'Program Studi', NULL, 24, '2025-03-18 21:59:29', '2025-05-21 06:14:37', NULL),
(54, 'DIII - Teknik Pendingin dan Tata Udara', 'D3-RTA', 'd3-teknik-pendingin-tata-udara', 'Program Studi DIII Teknik Pendingin dan Tata Udara', 'Program Studi', NULL, 25, '2025-03-18 21:59:54', '2025-05-21 06:14:37', NULL),
(55, ' DIII - Teknik Telekomunikasi', 'D3-TTK', 'd3-teknik-telekomunikasi', 'Program Studi DIII Teknik Telekomunikasi', 'Program Studi', NULL, 20, '2025-03-18 22:00:17', '2025-05-21 06:14:37', NULL),
(56, ' DIII - Usaha Perjalanan Wisata', 'D3-UPW', 'd3-usaha-perjalanan-wisata', 'Program Studi DIII Usaha Perjalanan Wisata', 'Program Studi', NULL, 17, '2025-03-18 22:00:35', '2025-05-21 06:14:37', NULL),
(57, 'DIV - Administrasi Bisnis', 'D4-Adbis', 'd4-administrasi-bisnis', 'Program Studi DIV Administrasi Bisnis', 'Program Studi', NULL, 17, '2025-03-18 22:00:56', '2025-05-21 06:14:37', NULL),
(58, 'DIV - Akuntansi', 'D4-AK', 'd4-akuntansi', 'Program Studi DIV Akuntansi', 'Program Studi', NULL, 18, '2025-03-18 22:01:14', '2025-05-21 06:14:37', NULL),
(59, ' DIV - Akuntansi Manajemen Pemerintahan', 'D4-AMP', 'd4-akuntansi-manajemen-pemerintahan', 'Program Studi DIV Akuntansi Manajemen Pemerintahan', 'Program Studi', NULL, 18, '2025-03-18 22:01:36', '2025-05-21 06:14:37', NULL),
(60, ' DIV - Keuangan Syariah', 'D4-KS', 'd4-keuangan-syariah', 'Program Studi DIV Keuangan Syariah', 'Program Studi', NULL, 18, '2025-03-18 22:02:02', '2025-05-21 06:14:37', NULL),
(61, ' DIV - Manajemen Aset', 'D4-MA', 'd4-manajemen-aset', 'Program Studi DIV Manajemen Aset', 'Program Studi', NULL, 17, '2025-03-18 22:02:33', '2025-05-21 06:14:38', NULL),
(62, 'DIV - Manajemen Pemasaran', 'D4-MP', 'd4-manajemen-pemasaran', 'Program Studi DIV Manajemen Pemasaran', 'Program Studi', NULL, 17, '2025-03-18 22:02:53', '2025-05-21 06:14:38', NULL),
(63, 'DIV - Proses Manufaktur', 'D4-PM', 'd4-proses-manufaktur', 'Program Studi DIV Proses Manufaktur', 'Program Studi', NULL, 24, '2025-03-18 22:03:12', '2025-05-21 06:14:38', NULL),
(64, 'DIV - Teknik Elektronika', 'D4-TEL', 'd4-teknik-elektronika', 'Program Studi DIV Teknik Elektronika', 'Program Studi', NULL, 20, '2025-03-18 22:03:49', '2025-05-21 06:14:38', NULL),
(65, 'DIV - Teknik Informatika', 'D4-TI', 'd4-teknik-informatika', 'Program Studi DIV Teknik Informatika', 'Program Studi', NULL, 22, '2025-03-18 22:04:08', '2025-05-21 06:14:38', NULL),
(66, 'DIV - Teknik Kimia Produksi Bersih', 'D4-TKPB', 'd4-teknik-kimia-produksi-bersih', 'Program Studi DIV Teknik Kimia Produksi Bersih', 'Program Studi', NULL, 21, '2025-03-18 22:04:26', '2025-05-21 06:14:38', NULL),
(67, 'DIV - Teknik Otomasi Industri (TOI)', 'D4-TOI', 'd4-teknik-otomasi-industri', 'Program Studi DIV Teknik Otomasi Industri', 'Program Studi', NULL, 20, '2025-03-18 22:04:44', '2025-05-21 06:14:38', NULL),
(68, 'DIV - Teknik Pendingin dan Tata Udara', 'D4-RTA', 'd4-teknik-pendingin-tata-udara', 'Program Studi DIV Teknik Pendingin dan Tata Udara', 'Program Studi', NULL, 25, '2025-03-18 22:05:05', '2025-05-21 06:14:38', NULL),
(69, 'DIV - Teknik Perancangan dan Konstruksi Mesin (TPKM)', 'D4-TPKM', 'd4-teknik-perancangan-konstruksi-mesin', 'Program Studi DIV Teknik Perancangan dan Konstruksi Mesin', 'Program Studi', NULL, 24, '2025-03-18 22:05:26', '2025-05-21 06:14:38', NULL),
(71, 'DIV - Teknik Perancangan Jalan dan Jembatan (TPJJ)	', 'D4-TPJJ', 'd4-teknik-perancangan-jalan-jembatan', 'Program Studi DIV Teknik Perancangan Jalan dan Jembatan', 'Program Studi', NULL, 26, '2025-03-18 22:05:46', '2025-05-21 06:14:38', NULL),
(72, ' DIV - Teknik Perawatan dan Perbaikan Gedung (TPPG)', 'D4-TPPG', 'd4-teknik-perawatan-perbaikan-gedung', 'Program Studi DIV Teknik Perawatan dan Perbaikan Gedung', 'Program Studi', NULL, 26, '2025-03-18 22:06:20', '2025-05-21 06:14:38', NULL),
(73, 'DIV - Teknik Telekomunikasi', 'D4-TTK', 'd4-teknik-telekomunikasi', 'Program Studi DIV Teknik Telekomunikasi', 'Program Studi', NULL, 20, '2025-03-18 22:06:38', '2025-05-21 06:14:38', NULL),
(74, 'DIV - Teknologi Konservasi Energi	', 'D4-TKE', 'd4-teknologi-konservasi-energi', 'Program Studi DIV Teknologi Konservasi Energi', 'Program Studi', NULL, 23, '2025-03-18 22:07:07', '2025-05-21 06:14:38', NULL),
(75, 'DIV - Teknologi Pembangkit Tenaga Listrik', 'D4-TPTL', 'd4-teknologi-pembangkit-tenaga-listrik', 'Program Studi DIV Teknologi Pembangkit Tenaga Listrik', 'Program Studi', NULL, 23, '2025-03-18 22:08:05', '2025-05-21 06:14:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `organization_types`
--

CREATE TABLE `organization_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `level` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `available_group` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organization_types`
--

INSERT INTO `organization_types` (`id`, `name`, `level`, `description`, `available_group`) VALUES
(1, 'Jurusan', 0, '', ''),
(2, 'Program_Studi', 1, NULL, 'Alumni');

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan_kuesioner`
--

CREATE TABLE `pertanyaan_kuesioner` (
  `id` int(11) NOT NULL,
  `kuesioner_id` int(11) NOT NULL,
  `pertanyaan` text NOT NULL,
  `tipe` enum('text','pilihan_ganda','checkbox','dropdown') NOT NULL,
  `opsi` text DEFAULT NULL,
  `urutan` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pertanyaan_kuesioner`
--

INSERT INTO `pertanyaan_kuesioner` (`id`, `kuesioner_id`, `pertanyaan`, `tipe`, `opsi`, `urutan`, `created_at`, `updated_at`) VALUES
(1, 1, 'sddsdsf', 'pilihan_ganda', '\"dsawwd\"', 1, '2025-03-21 08:08:01', '2025-03-21 08:08:01'),
(2, 1, 'berapa gaji kamu ', 'text', '\"\"', 2, '2025-03-21 08:15:45', '2025-03-21 08:15:45');

-- --------------------------------------------------------

--
-- Table structure for table `program_studi`
--

CREATE TABLE `program_studi` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jurusan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `site_name` varchar(255) NOT NULL,
  `site_slogan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_name`, `site_slogan`) VALUES
(1, 'Tracer Study', '   Assuring Your Future  ');

-- --------------------------------------------------------

--
-- Table structure for table `site_admin`
--

CREATE TABLE `site_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `site_admin`
--

INSERT INTO `site_admin` (`id`, `username`, `nama`, `created_at`) VALUES
(1, 'admin', 'Administrator', '2025-03-19 06:37:44');

-- --------------------------------------------------------

--
-- Table structure for table `soal_kuesioner`
--

CREATE TABLE `soal_kuesioner` (
  `id` int(11) NOT NULL,
  `id_halaman` int(11) NOT NULL,
  `pertanyaan` text NOT NULL,
  `tipe` enum('text','radio','checkbox') NOT NULL,
  `pilihan` text DEFAULT NULL,
  `id_kuesioner` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `soal_kuesioner`
--

INSERT INTO `soal_kuesioner` (`id`, `id_halaman`, `pertanyaan`, `tipe`, `pilihan`, `id_kuesioner`) VALUES
(1, 1, 'Nama lengkap Anda?', 'text', NULL, 0),
(2, 1, 'Jenis Kelamin?', 'radio', 'Laki-laki,Perempuan', 0),
(3, 2, 'Apakah Anda sudah bekerja?', 'radio', 'Ya,Tidak', 0),
(4, 2, 'Bidang pekerjaan Anda?', 'text', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tracer_messages`
--

CREATE TABLE `tracer_messages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `greeting` text NOT NULL,
  `content` text NOT NULL,
  `signature` text NOT NULL,
  `eligibility_years` varchar(100) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tracer_messages`
--

INSERT INTO `tracer_messages` (`id`, `title`, `greeting`, `content`, `signature`, `eligibility_years`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Tidak tersedia kuesioner', 'Mohon Maaf,', 'Saat ini kuesioner yang tersedia hanya diperuntukkan untuk alumni yang lulus pada tahun 2019 dan 2020. Sedangkan untuk alumni yang lulus diluar sebelumnya, mohon ditunggu untuk dibuka kembali jika ada permintaan dari kaprodi, dan alumni yang lulus sesudah tahun 2019 dan 2020 akan diberikan pada tahun berikutnya.', 'Hormat Kami,\nTim Tracer Study.', '2019,2020', 1, '2025-05-08 02:29:05', '2025-05-08 04:28:16');

-- --------------------------------------------------------

--
-- Table structure for table `tracer_study_contacts`
--

CREATE TABLE `tracer_study_contacts` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `program_studi` varchar(100) DEFAULT NULL,
  `jurusan` varchar(100) DEFAULT NULL,
  `contact_type` enum('directorate','team','address','surveyor','coordinator') NOT NULL DEFAULT 'address',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `show_email` tinyint(1) DEFAULT 0,
  `show_phone` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tracer_study_contacts`
--

INSERT INTO `tracer_study_contacts` (`id`, `name`, `position`, `qualification`, `email`, `phone`, `tahun`, `program_studi`, `jurusan`, `contact_type`, `sort_order`, `created_at`, `updated_at`, `show_email`, `show_phone`) VALUES
(2, 'Rony Pasonang Sihombing, S.T., M.Eng.', 'Team Tracer Study POLBAN', NULL, NULL, NULL, NULL, NULL, NULL, 'team', 1, '2025-04-29 06:01:46', '2025-04-29 06:01:46', 0, 0),
(3, 'Hanny Madiawati, S.S.T, M.T.', 'Team Tracer Study POLBAN', NULL, NULL, NULL, NULL, NULL, NULL, 'team', 2, '2025-04-29 06:01:46', '2025-04-29 06:01:46', 0, 0),
(4, 'Yeti Nugraheni, S.T., M.T.', 'Team Tracer Study POLBAN', NULL, NULL, NULL, NULL, NULL, NULL, 'team', 3, '2025-04-29 06:01:46', '2025-04-29 06:01:46', 0, 0),
(5, 'Asri Maspupah, S.S.T., M.T.', 'Team Tracer Study POLBAN', NULL, NULL, NULL, NULL, NULL, NULL, 'team', 4, '2025-04-29 06:01:46', '2025-04-29 06:01:46', 0, 0),
(6, 'Susilawati, S.T., M.Eng.', 'Team Tracer Study POLBAN', NULL, NULL, NULL, NULL, NULL, NULL, 'team', 5, '2025-04-29 06:01:46', '2025-04-29 06:01:46', 0, 0),
(24, 'Dr. Tomy Andrianto, S.S.T., M.M.Par.', 'Wakil Direktur Bidang Kemahasiswaan', 'khkkhkkhk', 'admin@gmail.com', '12091219201', NULL, NULL, NULL, 'directorate', 1, '2025-04-29 07:17:44', '2025-04-29 07:17:44', 0, 0),
(30, 'Jl. Gegerkalong Hilir, Ciwaruga, Parongpong, Kabupaten Bandung Barat, Jawa Barat 40012', 'Gedung Direktorat Lantai Dasar', '022-2013889', 'tracer.study@polban.ac.id', '022-2013789', NULL, NULL, NULL, 'address', 0, '2025-04-29 07:58:11', '2025-04-29 07:58:11', 0, 0),
(92, 'nayellll', 'Surveyor Tahun 2024', NULL, 'naynayyy@gmail.com', '098765432345', '2024', 'DIV - Teknik Informatika', NULL, 'surveyor', 0, '2025-05-07 08:42:37', '2025-05-07 08:42:37', 0, 1),
(93, 'mesiisisiis', 'Surveyor Tahun 2024', NULL, 'memeiii@gmail.com', '089978677879', '2024', 'DIII - Bahasa Inggris', NULL, 'surveyor', 0, '2025-05-07 08:43:04', '2025-05-07 08:43:04', 1, 0),
(94, 'srimeilaniimut', 'Surveyor Tahun 2024', NULL, 'sriiiii@gmail.com', '24798098654', '2024', 'DIV - Teknologi Konservasi Energi	', NULL, 'surveyor', 0, '2025-05-07 08:44:30', '2025-05-07 08:44:30', 0, 1),
(95, 'salwafaaureli', 'Surveyor Tahun 2024', 'lajksdsl', 'aurelifitalia@gmail.com', '24798098654', '2024', 'DIV - Proses Manufaktur', NULL, 'surveyor', 2, '2025-05-07 17:54:47', '2025-05-07 17:54:47', 0, 1),
(96, 'akula', 'Koordinator Surveyor Tahun 2024', 'jkhasshaxa', 'iajsais@gmail.com', '0987656543543', '2024', '', 'Teknik Kimia', 'coordinator', 1, '2025-05-07 19:40:33', '2025-05-07 19:40:33', 1, 0),
(97, 'koiusasab', 'Koordinator Surveyor Tahun 2024', 'kajsdkasdj', 'kiuhuyss@gmail.com', '09876545632', '2024', '', 'Teknik Refrigerasi dan Tata Udara', 'coordinator', 2, '2025-05-07 19:59:35', '2025-05-07 19:59:35', 1, 0),
(98, 'Aisyah Karimah', 'Surveyor Tahun 2024', 'kozoaok', 'aisyah.k@example.com', '082345678901', '2024', 'Teknik Telekomunikasi', '', 'surveyor', 4, '2025-05-07 20:17:07', '2025-05-07 20:43:42', 1, 0),
(99, 'njdisdnin', 'Koordinator Surveyor Tahun 2024', 'jshjhjsdhj', 'sasiaj@gmail.com', '032434800293', '2024', '', 'Teknik Kimia', 'coordinator', 3, '2025-05-07 20:18:56', '2025-05-07 20:18:56', 0, 1),
(100, 'kaajakaak', 'Koordinator Surveyor Tahun 2024', 'iuaasjiajsi', 'iuayaya@gmail.com', '09876567654', '2024', '', 'Teknik Mesin', 'coordinator', 3, '2025-05-07 20:29:03', '2025-05-07 20:29:03', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tracer_study_pages`
--

CREATE TABLE `tracer_study_pages` (
  `id` int(11) NOT NULL,
  `section` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_active` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tracer_study_pages`
--

INSERT INTO `tracer_study_pages` (`id`, `section`, `title`, `content`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 'about', 'Tentang Tracer Study', '<p><em>Tracer Study</em> atau yang sering disebut sebagai survey alumni atau survey <em>follow up</em> adalah studi mengenai lulusan lembaga penyelenggara pendidikan tinggi. Studi ini mampu menyediakan berbagai informasi yang bermanfaat bagi kepentingan evaluasi hasil pendidikan tinggi dan selanjutnya dapat digunakan untuk penyempurnaan dan peningkatan kualitas lembaga pendidikan tinggi yang bersangkutan.</p>\r\n\r\n<p><em>Tracer Study</em> juga bermanfaat dalam menyediakan informasi penting mengenai hubungan antara pendidikan tinggi dan dunia kerja profesional, menilai relevansi pendidikan tinggi, informasi bagi pemangku kepentingan (<em>stakeholders</em>), dan kelengkapan persyaratan bagi akreditasi pendidikan tinggi.</p>\r\n\r\n<p>Perguruan tinggi perlu melaksanakan <em>Tracer Study</em> karena membutuhkan umpan balik dari alumni dalam usahanya untuk perbaikan sistem dan pengelolaan pendidikan. Perguruan tinggi di awal tahun ajaran menentukan kebijakan pendidikan tinggi dari masukan berupa kondisi, pengalaman, dan motivasi mahasiswa baru yang masuk ke perguruan tinggi tersebut. Masukan mengenai kondisi, pengalaman dan motivasi ini menentukan pada perguruan tinggi dalam menentukan sistem dan pengelolaan pendidikan dalam hal proses pengajaran dan pembelajaran, penelitian, praktikum, workshop, laboratorium, studio atau unit terkait. Penentuan sistem pengajaran dan pembelajaran inipun akan dipengaruhi pula oleh kebijakan pendidikan yang ditetapkan oleh perguruan tinggi.</p>\r\n\r\n<p>Hasil dari masukan berupa kondisi, pengalaman dan motivasi mahasiswa, sistem dan kebijakan pendidikan di perguruan tinggi, dan proses pengajaran dan pembelajaran di perguruan tinggi akan membantu dalam memberikan karakter/kompetensi dari lulusan perguruan tinggi itu sendiri. Lulusan/alumni dari perguruan tinggi umumnya akan memiliki pengetahuan, kemampuan, motivasi dan kompetensi yang dibutuhkan untuk memasuki dunia kerja.</p>\r\n\r\n<p>Hasil dari pendidikan tinggi adalah pengetahuan, kemampuan dan kompetensi alumni perguruan tinggi yang dibutuhkan untuk memasuki dunia kerja.</p>', '2025-04-23 02:23:00', '2025-05-05 09:03:21', 1),
(7, 'about', 'Tentang Tracer Study', 'jaieanncaljrwitrghla', '2025-04-29 09:29:53', '2025-06-20 08:19:55', 1),
(10, 'about', 'kasasasjk', 'jdsahioecanknfkl', '2025-05-01 14:29:37', '2025-06-20 08:19:40', 0),
(11, 'about', 'hsndsjdshdhd', 'bdsjdskd', '2025-05-02 08:12:00', '2025-06-20 08:19:40', 0),
(12, 'about', 'gbthtyj', 'thrthtyjh56 yjyuikujhgbgfbfg', '2025-06-20 06:46:30', '2025-06-20 08:19:41', 0),
(13, 'about', 'gyftytut', 'fgfytytuyut', '2025-06-20 08:20:02', '2025-06-20 08:20:05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nim` varchar(20) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jurusan` varchar(100) DEFAULT NULL,
  `program_studi` varchar(100) DEFAULT NULL,
  `angkatan` year(4) DEFAULT NULL,
  `role` enum('alumni','admin_jurusan','site_admin') NOT NULL,
  `ipk` int(50) NOT NULL,
  `alamat1` varchar(255) NOT NULL,
  `alamat2` varchar(90) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `tahun_kelulusan` year(4) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `no_hp` varchar(90) NOT NULL,
  `kota` varchar(110) NOT NULL,
  `provinsi` varchar(120) NOT NULL,
  `kodepos` varchar(220) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_surveyor` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nim`, `username`, `email`, `password`, `nama`, `jurusan`, `program_studi`, `angkatan`, `role`, `ipk`, `alamat1`, `alamat2`, `status`, `tahun_kelulusan`, `jenis_kelamin`, `no_hp`, `kota`, `provinsi`, `kodepos`, `created_at`, `is_surveyor`) VALUES
(102, '3345479098', 'Sri', 'kaneki@gmail.com', '$2y$10$pisMXG33mUTL2wixc7EYcecF6XerytlPmVPMnB8fkIal8LevgLpTe', 'Sri', 'Teknik Sipil', 'DIII - Teknik Konstruksi Gedung', '2020', 'alumni', 4, 'jkchuiwfjclw', 'cdrhyjikimh', '', '2022', 'L', '0897661303988405', 'jhixisixha', 'nxjkauehcerfu', '432444444545', '2025-04-17 00:15:20', 0),
(115, NULL, 'kakaya', 'oakisyat@gmail.com', '$2y$10$QQxxoRyWUBZKhLKWjNKLqeg6ydZYFrjv5DLrcXC/ZwmM48OkAh5Li', 'kaisaksksja', NULL, NULL, NULL, 'site_admin', 0, '', '', 'active', '0000', 'L', '', '', '', '', '2025-04-22 18:15:34', 0),
(118, NULL, 'cicakika', 'psensuy@gmail.com', '$2y$10$BBWW8TBsu0SRZLhNHAm1uuc3w6FBQEqJ01z6NagtmwZvFmAFCBAIK', 'phjhbi', 'Teknik Elektro', ' DIII - Teknik Telekomunikasi', NULL, 'admin_jurusan', 0, '', '', '', '0000', 'L', '', '', '', '', '2025-04-23 20:27:52', 0),
(119, '1233444555', 'salwaaa', 'aurelifitalia@gmail.com', '$2y$10$UJuTtiKpDrYXByTfHEy3ROGCAjku7l2e8YK6MSXRJxSdW0WTlrCrK', 'salwafaaureli', 'Teknik Refrigerasi dan Tata Udara', 'DIII - Teknik Pendingin dan Tata Udara', '2020', 'alumni', 4, 'jl.Sarijadi ', 'nangkod', '', '2024', 'L', '24798098654', 'jakarta', 'bhjyhbgvf', '126766', '2025-04-29 21:57:06', 0),
(128, '1203012483024', 'srimei', 'sriiiii@gmail.com', '$2y$10$tK9Ucy1dqy7AAKgviIk/wOpGIEhUjlAbKJ32fUjA6e2XvLeMsH/U6', 'srimeilani', 'Teknik Komputer dan Informatika', 'DIV - Teknik Informatika', '2020', 'alumni', 3, 'Jl. Mawar No.1', 'Bandung Kulon', '', '2024', 'L', '24798098654', 'fghjkujhb', 'Jawa Barat', '87654332345', '2025-05-02 01:15:06', 0),
(134, '67098645099', 'meissy', 'memeiii@gmail.com', '$2y$10$MaNVTwcDcNwKvzE4fQfmQ..J43BlVoWwXQ2wdjFpSG7vFJi/nzViC', 'meissy', 'Teknik Kimia', 'DIII - Analis Kimia	', '2020', 'alumni', 4, 'kadohuiefur', 'kjxnjkhdoiw', '', '2024', 'P', '089978677879', 'jsjdoeruhec', 'njksjheduhe', 'bscuec', '2025-05-04 21:22:10', 0),
(135, '0901876371208', 'naylla fitri ', 'naynayyy@gmail.com', '$2y$10$uSvTHzAOQZTJEncsES/9s.R0hEHC.SDjgCm2nynp6vTar5f.TLoD.', 'naylla fitri', 'Akuntansi', 'DIII - Akuntansi', '2020', 'alumni', 4, 'sxdcfgjukiuytgl,kmj', 'dwcf4rghyju', '', '2024', 'P', '098765432345678', 'thjkl;olikujyhgrf', 'defrtyhujnbv', '455466768', '2025-05-05 01:13:53', 0);

-- --------------------------------------------------------

--
-- Table structure for table `welcome_message`
--

CREATE TABLE `welcome_message` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `welcome_message`
--

INSERT INTO `welcome_message` (`id`, `message`) VALUES
(1, 'Studi Penelusuran Alumni (Tracer Study) dilakukan untuk mengetahui masa transisi dari dunia kampus menuju dunia kerja dan untuk mendapatkan masukan bagi perbaikan sistem pendidikan POLBAN. Hasil dari survey ini akan menjadi data yang sangat berharga bagi POLBAN yang akan diperlukan bagi berbagai kebutuhan pengembangan dan kemajuan kampus POLBAN. Oleh karena itu, kami mohon kesediaan para alumni POLBAN yang terhormat untuk bekerjasama dalam mengisi kuesioner Tracer Study ini.\r\n\r\nKuesioner Tracer Study yang digunakan di POLBAN terdiri dari 5 halaman utama dengan 1 halaman tambahan berupa kuesioner yang berasal dari program studi masing-masing (khusus program studi tertentu).\r\n\r\nData tiap halaman akan tersimpan jika telah menekan tombol \r\n\r\nBagi yang belum mempunyai account harap mengisi data di link berikut untuk mendapatkan account pengisian tracer study.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `admin_jurusan_messages`
--
ALTER TABLE `admin_jurusan_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alumni`
--
ALTER TABLE `alumni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_isian_kuesioner`
--
ALTER TABLE `data_isian_kuesioner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kuesioner_id` (`kuesioner_id`);

--
-- Indexes for table `halaman_kuesioner`
--
ALTER TABLE `halaman_kuesioner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organization_id` (`organization_id`);

--
-- Indexes for table `kuesioner_answer`
--
ALTER TABLE `kuesioner_answer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_kuesioner_unique` (`user_id`,`kuesioner_id`);

--
-- Indexes for table `kuesioner_fields`
--
ALTER TABLE `kuesioner_fields`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `kuesioner_kuesioner`
--
ALTER TABLE `kuesioner_kuesioner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kuesioner_kuesioner_section`
--
ALTER TABLE `kuesioner_kuesioner_section`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kuesioner_section_index` (`created_by`);

--
-- Indexes for table `kuesioner_page`
--
ALTER TABLE `kuesioner_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `navigation_links`
--
ALTER TABLE `navigation_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `organization_types`
--
ALTER TABLE `organization_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pertanyaan_kuesioner`
--
ALTER TABLE `pertanyaan_kuesioner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program_studi`
--
ALTER TABLE `program_studi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_program_studi_jurusan` (`jurusan_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_admin`
--
ALTER TABLE `site_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `soal_kuesioner`
--
ALTER TABLE `soal_kuesioner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_halaman` (`id_halaman`);

--
-- Indexes for table `tracer_messages`
--
ALTER TABLE `tracer_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tracer_study_contacts`
--
ALTER TABLE `tracer_study_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tracer_study_pages`
--
ALTER TABLE `tracer_study_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- Indexes for table `welcome_message`
--
ALTER TABLE `welcome_message`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_jurusan_messages`
--
ALTER TABLE `admin_jurusan_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `alumni`
--
ALTER TABLE `alumni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `data_isian_kuesioner`
--
ALTER TABLE `data_isian_kuesioner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `halaman_kuesioner`
--
ALTER TABLE `halaman_kuesioner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kuesioner_answer`
--
ALTER TABLE `kuesioner_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `kuesioner_fields`
--
ALTER TABLE `kuesioner_fields`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1136;

--
-- AUTO_INCREMENT for table `kuesioner_kuesioner`
--
ALTER TABLE `kuesioner_kuesioner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `kuesioner_kuesioner_section`
--
ALTER TABLE `kuesioner_kuesioner_section`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `kuesioner_page`
--
ALTER TABLE `kuesioner_page`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `navigation_links`
--
ALTER TABLE `navigation_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `organization_types`
--
ALTER TABLE `organization_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pertanyaan_kuesioner`
--
ALTER TABLE `pertanyaan_kuesioner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `program_studi`
--
ALTER TABLE `program_studi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `site_admin`
--
ALTER TABLE `site_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `soal_kuesioner`
--
ALTER TABLE `soal_kuesioner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tracer_messages`
--
ALTER TABLE `tracer_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tracer_study_contacts`
--
ALTER TABLE `tracer_study_contacts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `tracer_study_pages`
--
ALTER TABLE `tracer_study_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `welcome_message`
--
ALTER TABLE `welcome_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_isian_kuesioner`
--
ALTER TABLE `data_isian_kuesioner`
  ADD CONSTRAINT `data_isian_kuesioner_ibfk_1` FOREIGN KEY (`kuesioner_id`) REFERENCES `kuesioner_kuesioner` (`id`);

--
-- Constraints for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD CONSTRAINT `jurusan_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `organizations`
--
ALTER TABLE `organizations`
  ADD CONSTRAINT `organizations_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `organizations` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `soal_kuesioner`
--
ALTER TABLE `soal_kuesioner`
  ADD CONSTRAINT `soal_kuesioner_ibfk_1` FOREIGN KEY (`id_halaman`) REFERENCES `halaman_kuesioner` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
