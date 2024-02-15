-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2023 at 01:03 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ruang_kelas`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_b_ruang`
--

CREATE TABLE `tbl_b_ruang` (
  `id_b_ruang` int(5) NOT NULL,
  `id_ruang` int(5) NOT NULL,
  `id_kelas` int(5) NOT NULL,
  `id_mata_kuliah` int(5) NOT NULL,
  `id_dosen` int(5) NOT NULL,
  `tgl_pakai` date NOT NULL,
  `hari` varchar(15) DEFAULT NULL,
  `dari_pukul` time DEFAULT NULL,
  `sampai_pukul` time DEFAULT NULL,
  `sesi` varchar(10) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `s_verifikasi` varchar(20) NOT NULL DEFAULT 'belum verifikasi',
  `id_tahun_akademik` int(5) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `user` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dosen`
--

CREATE TABLE `tbl_dosen` (
  `id_dosen` int(5) NOT NULL,
  `nama_dosen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_dosen`
--

INSERT INTO `tbl_dosen` (`id_dosen`, `nama_dosen`) VALUES
(1, 'Muhamad Aripin, A.Md'),
(2, 'Asep Manarul Hidayah, S.Kom'),
(3, 'Diki Nur Rahman'),
(4, 'Aa Willy Nugraha, SE., M.M'),
(5, 'Ade Fuad Hasan, M.Kom'),
(6, 'Adzka Rosa Sanjayyana, S.E., Ak., M.Ak'),
(7, 'Agus Salim, S.Kom., M.Kom'),
(8, 'Andi Usmar, SE., M.M.'),
(9, 'Andri Nurmansyah, S.E., M.M'),
(10, 'Annisa Desty P., S.E., M.M'),
(11, 'Arip Budiman, ST., M.Pd'),
(13, 'Asep Alamsyah, S.Kom'),
(14, 'Asep Dadan S., M.M'),
(16, 'Asep Rukmantara'),
(17, 'Bayu Indria Prasetya, S.E.,M.M'),
(18, 'Bella Pratiwi Rachman, S.E.,M.M'),
(19, 'Budi Harto,SE.,MM'),
(20, 'Cecep Riki, S.T., M.Kom'),
(21, 'Bella Pratiwi Rachman, S.E.,M.M'),
(22, 'Dede Rahayu, S.Sos., M.Pd'),
(23, 'Ernawati, SE., M.Pd., M.M'),
(24, 'Febriana Hidayati, S.Pd'),
(25, 'H. Agus Nugraha, BSC., SE., MBA'),
(26, 'H. Ating Suryana, S.Sos'),
(27, 'H. Riza Faizal, S.IP., M.M'),
(28, 'H. Rudi Kurniawan, ST., M.M'),
(29, 'Haisyam Maulana, ST, M.Kom'),
(30, 'Harnavela Sofyan., SE., M.Ak., PIA'),
(31, 'Heri Sugara, SE., BKP'),
(32, 'Indah Permatasari, M.Pd'),
(33, 'Indri Fitrianasari, S.Kom'),
(34, 'Ir. Mia Sumiarsih, M.M'),
(35, 'Ivan Mudalivana, S.E., M.M'),
(36, 'Jono Taryono'),
(37, 'Kiki Supendi, M.T'),
(38, 'Komarudin Tasdik, M.Kom'),
(39, 'Lerian Febriana, A.Md'),
(40, 'Lita Lestari Utami, S.T., M.Kom'),
(41, 'Lutfi Kausar Rahman, S.IP., MBA'),
(42, 'M. Kamaludin A. Rigai, S.Kom'),
(43, 'Monika Sutarsa, S.Ak., M.M'),
(44, 'Muhamad Farihin, ST'),
(45, 'Muis Wirasujatma, SE., M.M'),
(47, 'Nijar Kurnia Romdoni, SE., M.Ak.,Ak.'),
(48, 'Rama Nugraha Irawan S., M.M'),
(49, 'Rangga Munggaran, SE., M.M'),
(50, 'Rani Ligar Fitriani, M.Pd'),
(51, 'Rudi Permadi, M.Pd'),
(52, 'Suminar, M.Kom'),
(53, 'Untung Eko Setyasari, S.Sos., MA'),
(54, 'Usep Abdul Rosid, ST., M.Kom'),
(55, 'Uyu Wachyu Ruchiyat, M.Kom'),
(56, 'Verra Rosyalia Widia Sofyan, M.M'),
(57, 'Yanti Fadila Wahab, M.Pd'),
(58, 'Yopi Hermawan, M.Pd'),
(59, 'Yovi Fernando, ST'),
(60, 'Yudi Hendarman, M.Pd'),
(62, 'Yusuf Effendi, S.Si., M.M'),
(63, 'Yuyun Kurniawati, S.Ak., M.Ak'),
(64, 'Yuyun Taufik, S.Pd., M.Si'),
(65, 'Asep Deni Sutaryono, S.IP'),
(66, 'Citra Fitria Wachyunita, S.E., M.M'),
(67, 'Yudi Kurniadi, M.Pd'),
(68, 'Nia Senia Tresnasari, S.S');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jadwal`
--

CREATE TABLE `tbl_jadwal` (
  `id_jadwal` int(5) NOT NULL,
  `hari` varchar(30) NOT NULL,
  `id_matkul` int(5) NOT NULL,
  `id_dosen` int(5) NOT NULL,
  `id_kelas` int(5) NOT NULL,
  `id_ruang` int(5) NOT NULL,
  `dari` time NOT NULL,
  `sampai` time NOT NULL,
  `status` varchar(10) DEFAULT 'normal',
  `id_tahun_akademik` int(5) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `id_sesi` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_jadwal`
--

INSERT INTO `tbl_jadwal` (`id_jadwal`, `hari`, `id_matkul`, `id_dosen`, `id_kelas`, `id_ruang`, `dari`, `sampai`, `status`, `id_tahun_akademik`, `semester`, `id_sesi`) VALUES
(250, 'Monday', 33, 35, 8, 4, '09:50:00', '11:30:00', 'normal', 1, 'Genap', 0),
(251, 'Monday', 38, 60, 8, 4, '14:20:00', '16:00:00', 'normal', 1, 'Genap', 0),
(252, 'Tuesday', 75, 9, 8, 4, '14:20:00', '16:00:00', 'normal', 1, 'Genap', 0),
(253, 'Tuesday', 26, 53, 8, 13, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(254, 'Wednesday', 49, 23, 8, 5, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(255, 'Wednesday', 69, 34, 8, 6, '16:10:00', '17:50:00', 'normal', 1, 'Genap', 0),
(256, 'Thursday', 32, 65, 8, 11, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(257, 'Friday', 14, 17, 8, 4, '08:00:00', '09:40:00', 'normal', 1, 'Genap', 0),
(258, 'Monday', 38, 60, 9, 5, '16:10:00', '17:50:00', 'normal', 1, 'Genap', 0),
(259, 'Monday', 26, 11, 9, 5, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(260, 'Tuesday', 75, 9, 9, 4, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(261, 'Tuesday', 33, 35, 9, 4, '09:50:00', '11:30:00', 'normal', 1, 'Genap', 0),
(262, 'Wednesday', 32, 41, 9, 14, '08:00:00', '09:40:00', 'normal', 1, 'Genap', 0),
(263, 'Wednesday', 49, 14, 9, 14, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(264, 'Thursday', 69, 10, 9, 15, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(265, 'Friday', 14, 22, 9, 5, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(266, 'Monday', 52, 56, 10, 13, '08:00:00', '09:40:00', 'normal', 1, 'Genap', 0),
(267, 'Monday', 40, 57, 10, 6, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(268, 'Tuesday', 31, 6, 10, 6, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(269, 'Tuesday', 13, 38, 10, 3, '08:00:00', '09:40:00', 'normal', 1, 'Genap', 0),
(270, 'Wednesday', 6, 8, 10, 11, '16:10:00', '17:50:00', 'normal', 1, 'Genap', 0),
(271, 'Wednesday', 64, 56, 10, 6, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(272, 'Thursday', 42, 4, 10, 4, '14:20:00', '16:00:00', 'normal', 1, 'Genap', 0),
(273, 'Thursday', 70, 34, 10, 11, '16:10:00', '17:50:00', 'normal', 1, 'Genap', 0),
(274, 'Monday', 42, 25, 11, 6, '09:50:00', '11:30:00', 'normal', 1, 'Genap', 0),
(275, 'Monday', 52, 18, 11, 12, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(276, 'Tuesday', 31, 6, 11, 6, '14:20:00', '16:00:00', 'normal', 1, 'Genap', 0),
(277, 'Tuesday', 6, 47, 11, 13, '16:10:00', '17:50:00', 'normal', 1, 'Genap', 0),
(278, 'Wednesday', 40, 32, 11, 5, '08:00:00', '09:40:00', 'normal', 1, 'Genap', 0),
(279, 'Wednesday', 13, 33, 11, 2, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(280, 'Thursday', 70, 64, 11, 6, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(281, 'Friday', 64, 66, 11, 11, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(282, 'Monday', 71, 5, 12, 1, '18:30:00', '20:10:00', 'normal', 1, 'Genap', 0),
(283, 'Monday', 57, 44, 12, 3, '16:10:00', '17:50:00', 'normal', 1, 'Genap', 0),
(284, 'Tuesday', 12, 40, 12, 2, '08:00:00', '09:40:00', 'normal', 1, 'Genap', 0),
(285, 'Saturday', 62, 37, 12, 3, '08:00:00', '09:40:00', 'normal', 1, 'Genap', 0),
(286, 'Wednesday', 73, 29, 12, 3, '16:10:00', '17:50:00', 'normal', 1, 'Genap', 0),
(287, 'Tuesday', 39, 51, 12, 15, '09:50:00', '11:30:00', 'normal', 1, 'Genap', 0),
(288, 'Thursday', 28, 20, 12, 2, '18:30:00', '21:10:00', 'normal', 1, 'Genap', 0),
(289, 'Thursday', 46, 39, 12, 3, '16:10:00', '17:50:00', 'normal', 1, 'Genap', 0),
(290, 'Monday', 71, 5, 13, 1, '16:10:00', '17:50:00', 'normal', 1, 'Genap', 0),
(291, 'Monday', 57, 44, 13, 3, '18:30:00', '21:10:00', 'normal', 1, 'Genap', 0),
(292, 'Tuesday', 73, 29, 13, 3, '16:10:00', '17:50:00', 'normal', 1, 'Genap', 0),
(293, 'Tuesday', 12, 40, 13, 2, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(294, 'Saturday', 62, 37, 13, 3, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(295, 'Thursday', 39, 32, 13, 13, '09:50:00', '11:30:00', 'normal', 1, 'Genap', 0),
(296, 'Thursday', 28, 20, 13, 2, '16:10:00', '17:50:00', 'normal', 1, 'Genap', 0),
(297, 'Thursday', 46, 39, 13, 3, '18:30:00', '20:10:00', 'normal', 1, 'Genap', 0),
(298, 'Monday', 10, 13, 14, 2, '16:10:00', '17:50:00', 'normal', 1, 'Genap', 0),
(299, 'Tuesday', 74, 38, 14, 3, '14:20:00', '16:00:00', 'normal', 1, 'Genap', 0),
(300, 'Tuesday', 13, 1, 14, 2, '16:10:00', '17:50:00', 'normal', 1, 'Genap', 0),
(301, 'Saturday', 31, 7, 14, 4, '09:50:00', '11:30:00', 'normal', 1, 'Genap', 0),
(302, 'Saturday', 63, 54, 14, 1, '08:00:00', '09:40:00', 'normal', 1, 'Genap', 0),
(303, 'Wednesday', 40, 50, 14, 13, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(304, 'Thursday', 48, 42, 14, 1, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(305, 'Thursday', 53, 55, 14, 1, '14:20:00', '16:00:00', 'normal', 1, 'Genap', 0),
(306, 'Tuesday', 10, 13, 15, 1, '16:10:00', '17:50:00', 'normal', 1, 'Genap', 0),
(307, 'Tuesday', 48, 42, 15, 1, '14:20:00', '16:00:00', 'normal', 1, 'Genap', 0),
(308, 'Saturday', 31, 7, 15, 4, '08:00:00', '09:40:00', 'normal', 1, 'Genap', 0),
(309, 'Saturday', 63, 54, 15, 1, '09:50:00', '11:30:00', 'normal', 1, 'Genap', 0),
(310, 'Wednesday', 13, 1, 15, 1, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(311, 'Thursday', 53, 55, 15, 1, '16:10:00', '17:50:00', 'normal', 1, 'Genap', 0),
(312, 'Thursday', 40, 67, 15, 11, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(313, 'Friday', 74, 44, 15, 1, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(314, 'Tuesday', 44, 43, 16, 10, '14:20:00', '16:00:00', 'normal', 1, 'Genap', 0),
(315, 'Tuesday', 66, 30, 16, 15, '09:50:00', '11:30:00', 'normal', 1, 'Genap', 0),
(316, 'Wednesday', 68, 8, 16, 11, '08:00:00', '09:40:00', 'normal', 1, 'Genap', 0),
(317, 'Wednesday', 51, 19, 16, 15, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(318, 'Thursday', 55, 6, 16, 14, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(319, 'Thursday', 38, 51, 16, 4, '09:50:00', '11:30:00', 'normal', 1, 'Genap', 0),
(320, 'Friday', 72, 31, 16, 13, '08:00:00', '09:40:00', 'normal', 1, 'Genap', 0),
(321, 'Friday', 45, 49, 16, 14, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(322, 'Tuesday', 21, 18, 17, 12, '08:00:00', '09:40:00', 'normal', 1, 'Genap', 0),
(323, 'Tuesday', 18, 62, 17, 13, '14:10:00', '16:00:00', 'normal', 1, 'Genap', 0),
(324, 'Saturday', 66, 63, 17, 19, '00:00:08', '00:00:11', 'normal', 1, 'Genap', 0),
(325, 'Wednesday', 16, 8, 17, 11, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(326, 'Thursday', 17, 62, 17, 12, '09:50:00', '11:30:00', 'normal', 1, 'Genap', 0),
(327, 'Thursday', 38, 50, 17, 12, '14:20:00', '16:00:00', 'normal', 1, 'Genap', 0),
(328, 'Friday', 20, 43, 17, 13, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(329, 'Friday', 19, 27, 17, 12, '08:00:00', '09:40:00', 'normal', 1, 'Genap', 0),
(330, 'Monday', 31, 6, 18, 4, '14:20:00', '16:00:00', 'normal', 1, 'Genap', 0),
(331, 'Monday', 15, 30, 18, 14, '09:50:00', '11:30:00', 'normal', 1, 'Genap', 0),
(332, 'Tuesday', 54, 43, 18, 10, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(333, 'Tuesday', 37, 51, 18, 14, '14:20:00', '16:00:00', 'normal', 1, 'Genap', 0),
(334, 'Saturday', 13, 52, 18, 2, '08:00:00', '09:40:00', 'normal', 1, 'Genap', 0),
(335, 'Wednesday', 22, 19, 18, 15, '14:20:00', '16:00:00', 'normal', 1, 'Genap', 0),
(336, 'Wednesday', 43, 48, 18, 14, '16:10:00', '17:50:00', 'normal', 1, 'Genap', 0),
(337, 'Thursday', 50, 47, 18, 10, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(338, 'Monday', 8, 10, 19, 15, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(339, 'Tuesday', 24, 11, 19, 12, '14:20:00', '16:00:00', 'normal', 1, 'Genap', 0),
(340, 'Tuesday', 23, 56, 19, 14, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(341, 'Wednesday', 32, 41, 19, 4, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(342, 'Wednesday', 60, 45, 19, 5, '16:10:00', '17:50:00', 'normal', 1, 'Genap', 0),
(343, 'Friday', 30, 44, 19, 1, '08:00:00', '09:40:00', 'normal', 1, 'Genap', 0),
(344, 'Friday', 38, 67, 19, 4, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(345, 'Monday', 13, 2, 20, 1, '08:00:00', '09:40:00', 'normal', 1, 'Genap', 0),
(346, 'Monday', 7, 47, 20, 11, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(347, 'Tuesday', 31, 11, 20, 12, '16:10:00', '17:40:00', 'normal', 1, 'Genap', 0),
(348, 'Tuesday', 59, 28, 20, 5, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(349, 'Wednesday', 37, 50, 20, 13, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(350, 'Wednesday', 29, 53, 20, 13, '16:10:00', '17:40:00', 'normal', 1, 'Genap', 0),
(351, 'Thursday', 58, 14, 20, 6, '14:20:00', '16:00:00', 'normal', 1, 'Genap', 0),
(352, 'Thursday', 61, 23, 20, 5, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(353, 'Thursday', 42, 25, 21, 13, '09:50:00', '11:30:00', 'normal', 1, 'Genap', 0),
(354, 'Thursday', 56, 24, 21, 5, '14:20:00', '16:00:00', 'normal', 1, 'Genap', 0),
(355, 'Wednesday', 25, 68, 21, 12, '08:00:00', '09:40:00', 'normal', 1, 'Genap', 0),
(356, 'Wednesday', 35, 59, 21, 18, '09:50:00', '11:30:00', 'normal', 1, 'Genap', 0),
(357, 'Saturday', 9, 58, 21, 18, '08:00:00', '09:40:00', 'normal', 1, 'Genap', 0),
(358, 'Tuesday', 67, 26, 21, 11, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(359, 'Tuesday', 65, 26, 21, 11, '14:20:00', '16:00:00', 'normal', 1, 'Genap', 0),
(360, 'Thursday', 41, 25, 22, 13, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(361, 'Thursday', 27, 16, 22, 18, '14:20:00', '16:00:00', 'normal', 1, 'Genap', 0),
(362, 'Wednesday', 47, 68, 22, 12, '08:00:00', '09:40:00', 'normal', 1, 'Genap', 0),
(363, 'Tuesday', 34, 36, 22, 18, '14:20:00', '16:00:00', 'normal', 1, 'Genap', 0),
(364, 'Monday', 11, 2, 22, 1, '08:00:00', '09:40:00', 'normal', 1, 'Genap', 0),
(365, 'Monday', 36, 59, 22, 18, '09:50:00', '11:30:00', 'normal', 1, 'Genap', 0),
(366, 'Wednesday', 49, 23, 8, 5, '14:20:00', '16:00:00', 'normal', 1, 'Genap', 0),
(367, 'Tuesday', 66, 30, 16, 15, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(368, 'Wednesday', 68, 8, 16, 11, '09:50:00', '11:30:00', 'normal', 1, 'Genap', NULL),
(369, 'Tuesday', 21, 18, 17, 12, '09:50:00', '11:30:00', 'normal', 1, 'Genap', NULL),
(370, 'Wednesday', 69, 34, 8, 6, '18:30:00', '20:10:00', 'normal', 1, 'Genap', NULL),
(371, 'Thursday', 32, 65, 8, 11, '14:20:00', '16:00:00', 'normal', 1, 'Genap', NULL),
(372, 'Friday', 14, 17, 8, 4, '09:50:00', '11:30:00', 'normal', 1, 'Genap', NULL),
(373, 'Wednesday', 32, 41, 9, 14, '09:50:00', '11:30:00', 'normal', 1, 'Genap', NULL),
(374, 'Wednesday', 49, 14, 9, 14, '14:20:00', '16:00:00', 'normal', 1, 'Genap', NULL),
(375, 'Thursday', 69, 10, 9, 15, '14:20:00', '16:00:00', 'normal', 1, 'Genap', NULL),
(376, 'Friday', 14, 22, 9, 5, '14:20:00', '16:00:00', 'normal', 1, 'Genap', NULL),
(377, 'Monday', 52, 56, 10, 13, '09:50:00', '11:30:00', 'normal', 1, 'Genap', NULL),
(378, 'Monday', 40, 57, 10, 6, '14:20:00', '16:00:00', 'normal', 1, 'Genap', 0),
(379, 'Tuesday', 13, 38, 10, 3, '09:50:00', '11:30:00', 'normal', 1, 'Genap', 0),
(380, 'Wednesday', 64, 56, 10, 6, '14:20:00', '16:00:00', 'normal', 1, 'Genap', 0),
(381, 'Monday', 52, 18, 11, 12, '14:20:00', '16:00:00', 'normal', 1, 'Genap', 0),
(382, 'Wednesday', 40, 32, 11, 5, '09:50:00', '11:30:00', 'normal', 1, 'Genap', 0),
(383, 'Wednesday', 13, 33, 11, 2, '14:20:00', '16:00:00', 'normal', 1, 'Genap', 0),
(384, 'Friday', 64, 66, 11, 11, '14:20:00', '16:00:00', 'normal', 1, 'Genap', 0),
(385, 'Tuesday', 12, 40, 12, 2, '09:50:00', '11:30:00', 'normal', 1, 'Genap', 0),
(386, 'Saturday', 62, 37, 12, 3, '09:50:00', '11:30:00', 'normal', 1, 'Genap', 0),
(387, 'Wednesday', 73, 29, 12, 3, '18:30:00', '21:10:00', 'normal', 1, 'Genap', 0),
(388, 'Tuesday', 73, 29, 13, 3, '18:30:00', '21:10:00', 'normal', 1, 'Genap', 0),
(389, 'Tuesday', 12, 40, 13, 2, '14:20:00', '16:00:00', 'normal', 1, 'Genap', 0),
(390, 'Saturday', 62, 37, 13, 3, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(391, 'Monday', 10, 13, 14, 2, '18:30:00', '21:10:00', 'normal', 1, 'Genap', 0),
(392, 'Tuesday', 74, 38, 14, 3, '00:00:14', '00:00:16', 'normal', 1, 'Genap', 0),
(393, 'Tuesday', 13, 1, 14, 2, '18:30:00', '21:10:00', 'normal', 1, 'Genap', 0),
(394, 'Wednesday', 40, 50, 14, 13, '14:20:00', '16:00:00', 'normal', 1, 'Genap', 0),
(395, 'Tuesday', 10, 13, 15, 1, '18:30:00', '21:10:00', 'normal', 1, 'Genap', 0),
(396, 'Wednesday', 13, 1, 15, 1, '14:20:00', '16:00:00', 'normal', 1, 'Genap', 0),
(397, 'Thursday', 40, 67, 15, 11, '14:20:00', '16:00:00', 'normal', 1, 'Genap', 0),
(398, 'Friday', 74, 44, 15, 1, '14:20:00', '16:00:00', 'normal', 1, 'Genap', 0),
(399, 'Tuesday', 44, 43, 16, 10, '16:10:00', '17:50:00', 'normal', 1, 'Genap', 0),
(400, 'Thursday', 55, 6, 16, 14, '14:20:00', '16:00:00', 'normal', 1, 'Genap', 0),
(401, 'Friday', 45, 49, 16, 14, '14:20:00', '16:00:00', 'normal', 1, 'Genap', 0),
(402, 'Wednesday', 16, 8, 17, 11, '14:20:00', '16:00:00', 'normal', 1, 'Genap', 0),
(403, 'Thursday', 17, 62, 17, 12, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(404, 'Friday', 19, 27, 17, 12, '09:50:00', '11:30:00', 'normal', 1, 'Genap', 0),
(405, 'Monday', 15, 30, 18, 14, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(406, 'Tuesday', 37, 51, 18, 14, '16:10:00', '17:50:00', 'normal', 1, 'Genap', 0),
(407, 'Saturday', 13, 52, 18, 2, '09:50:00', '11:30:00', 'normal', 1, 'Genap', 0),
(408, 'Thursday', 50, 47, 18, 10, '14:20:00', '16:00:00', 'normal', 1, 'Genap', 0),
(409, 'Monday', 8, 10, 19, 15, '14:20:00', '16:00:00', 'normal', 1, 'Genap', 0),
(410, 'Wednesday', 32, 41, 19, 4, '14:20:00', '16:00:00', 'normal', 1, 'Genap', 0),
(411, 'Wednesday', 60, 45, 19, 5, '18:30:00', '21:10:00', 'normal', 1, 'Genap', 0),
(412, 'Friday', 30, 44, 19, 1, '09:50:00', '11:30:00', 'normal', 1, 'Genap', 0),
(413, 'Monday', 13, 2, 20, 1, '09:50:00', '11:30:00', 'normal', 1, 'Genap', 0),
(414, 'Monday', 7, 47, 20, 11, '14:20:00', '16:00:00', 'normal', 1, 'Genap', 0),
(415, 'Tuesday', 59, 28, 20, 5, '14:20:00', '16:00:00', 'normal', 1, 'Genap', 0),
(416, 'Wednesday', 37, 50, 20, 13, '14:20:00', '16:00:00', 'normal', 1, 'Genap', 0),
(417, 'Wednesday', 35, 59, 21, 18, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0),
(418, 'Saturday', 9, 58, 21, 18, '09:50:00', '11:30:00', 'normal', 1, 'Genap', 0),
(419, 'Thursday', 27, 16, 22, 18, '16:10:00', '17:50:00', 'normal', 1, 'Genap', 0),
(420, 'Wednesday', 47, 68, 22, 12, '09:50:00', '11:30:00', 'normal', 1, 'Genap', 0),
(421, 'Tuesday', 34, 36, 22, 18, '16:10:00', '17:50:00', 'normal', 1, 'Genap', 0),
(422, 'Monday', 11, 2, 22, 1, '09:50:00', '11:30:00', 'normal', 1, 'Genap', 0),
(423, 'Monday', 36, 59, 22, 18, '12:30:00', '14:10:00', 'normal', 1, 'Genap', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kelas`
--

CREATE TABLE `tbl_kelas` (
  `id_kelas` int(5) NOT NULL,
  `kelas` varchar(30) NOT NULL,
  `prodi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_kelas`
--

INSERT INTO `tbl_kelas` (`id_kelas`, `kelas`, `prodi`) VALUES
(7, 'Admin', 'Admin'),
(8, 'AB15A', 'ADMINISTRASI BISNIS'),
(9, 'AB15B', 'ADMINISTRASI BISNIS'),
(10, 'AB16A', 'ADMINISTRASI BISNIS'),
(11, 'AB16B', 'ADMINISTRASI BISNIS'),
(12, 'MI21A', 'MANAJEMEN INFORMATIKA'),
(13, 'MI21B', 'MANAJEMEN INFORMATIKA'),
(14, 'MI22A', 'MANAJEMEN INFORMATIKA'),
(15, 'MI22B', 'MANAJEMEN INFORMATIKA'),
(16, 'MK02K', 'MANAJEMEN KEUANGAN PERBANKAN'),
(17, 'MK02P', 'MANAJEMEN KEUANGANPERBANKAN'),
(18, 'MK03', 'MANAJEMEN KEUANGAN PERBANKAN'),
(19, 'MP02', 'MANAJEMEN PEMASARAN'),
(20, 'MP03', 'MANAJEMEN PEMASARAN'),
(21, 'TO21', 'TEKNIK OTOMOTIF'),
(22, 'TO22', 'TEKNIK OTOMOTIF'),
(23, 'IT', 'IT'),
(24, 'COOPERATION AND PLACEMENT', 'COOPERATION AND PLACEMENT'),
(25, 'MARKETING', 'MARKETING'),
(26, 'KAPRODI MP', 'KAPRODI MP'),
(27, 'KAPRODI MKP', 'KAPRODI MKP'),
(28, 'KEUANGAN', 'KEUANGAN');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_konfigurasi`
--

CREATE TABLE `tbl_konfigurasi` (
  `id_konfigurasi` int(5) NOT NULL,
  `id_tahun_akademik` int(5) NOT NULL,
  `semester` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_konfigurasi`
--

INSERT INTO `tbl_konfigurasi` (`id_konfigurasi`, `id_tahun_akademik`, `semester`) VALUES
(1, 1, 'Genap');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mata_kuliah`
--

CREATE TABLE `tbl_mata_kuliah` (
  `id_mata_kuliah` int(5) NOT NULL,
  `mata_kuliah` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_mata_kuliah`
--

INSERT INTO `tbl_mata_kuliah` (`id_mata_kuliah`, `mata_kuliah`) VALUES
(6, 'Accounting For Business'),
(7, 'Accounting Principle 2'),
(8, 'Advertising Fundamental'),
(9, 'Air Conditioner'),
(10, 'Algorithm & Data Structure'),
(11, 'Aplikasi Komputer 2'),
(12, 'Application Development Project'),
(13, 'Applied Computer 2'),
(14, 'Archive Management'),
(15, 'Auditing'),
(16, 'Bank Accountancy'),
(17, 'Bank Administration Technology'),
(18, 'Bank Marketing Management'),
(19, 'Bank Practice'),
(20, 'Bank Service Ethics'),
(21, 'Banking Management Information System'),
(22, 'Banks and Non-Bank Financial Instituions'),
(23, 'Branding Fundamental'),
(24, 'Business Communication'),
(25, 'Business English 1'),
(26, 'Business Ettique'),
(27, 'Chasis System 1'),
(28, 'Computer Security'),
(29, 'Consumer Behavior'),
(30, 'Design Graphis'),
(31, 'Design Thinking'),
(32, 'E-Commerce'),
(33, 'E-Filling'),
(34, 'Electric System 1'),
(35, 'Engine Diagnostic 1'),
(36, 'Engine System 1'),
(37, 'English 2'),
(38, 'English For Special Purpose 2'),
(39, 'English For Special Purposes 2'),
(40, 'English II'),
(41, 'Entrepreneurship 1'),
(42, 'Entrepreneurship 2'),
(43, 'Financial Management'),
(44, 'Financial Statement Analysis'),
(45, 'Foreign Exchange Market'),
(46, 'Front End Programming'),
(47, 'General English 2'),
(48, 'Graphic Design'),
(49, 'Human Resource Management'),
(50, 'Intermediate Accounting'),
(51, 'International Finance'),
(52, 'Introduction To Business'),
(53, 'Introduction to Database'),
(54, 'Introduction to Economics'),
(55, 'Investment Management and Capital Market'),
(56, 'Japanese 2'),
(57, 'Java Programming'),
(58, 'Macro Economics'),
(59, 'Marketing Management'),
(60, 'Marketing Plan'),
(61, 'Marketing Principles'),
(62, 'Mobile Programming Framework'),
(63, 'Object Oriented Programming'),
(64, 'Office Management'),
(65, 'Presentation Negotiation'),
(66, 'Professional Ethics'),
(67, 'Psychology Profession Ethic'),
(68, 'Risk Management'),
(69, 'Secretarial Project'),
(70, 'Service Excellence'),
(71, 'Software Testing'),
(72, 'Taxation 2'),
(73, 'Web Framework Development'),
(74, 'Web Fundamental'),
(75, 'Work Report Writing Technic');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ruang`
--

CREATE TABLE `tbl_ruang` (
  `id_ruang` int(5) NOT NULL,
  `ruang` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_ruang`
--

INSERT INTO `tbl_ruang` (`id_ruang`, `ruang`) VALUES
(1, 'Lab 1'),
(2, 'Lab 2'),
(3, 'Lab 3'),
(4, '201'),
(5, '202'),
(6, '203'),
(7, 'Aula'),
(8, 'Perpustakaan'),
(10, '401'),
(11, '402'),
(12, '403'),
(13, '404'),
(14, '405'),
(15, '406'),
(16, '101'),
(17, '102'),
(18, 'Workshop'),
(19, 'Online');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sesi`
--

CREATE TABLE `tbl_sesi` (
  `id_sesi` int(5) NOT NULL,
  `nama_sesi` varchar(10) NOT NULL,
  `waktu_sesi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sesi`
--

INSERT INTO `tbl_sesi` (`id_sesi`, `nama_sesi`, `waktu_sesi`) VALUES
(1, 'Sesi 1', '08:00 - 09:40'),
(2, 'Sesi 2', '09:50 - 11.30'),
(3, 'Sesi 3', '12:30 - 14.10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tahun_akademik`
--

CREATE TABLE `tbl_tahun_akademik` (
  `id_tahun_akademik` int(5) NOT NULL,
  `tahun_akademik` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_tahun_akademik`
--

INSERT INTO `tbl_tahun_akademik` (`id_tahun_akademik`, `tahun_akademik`) VALUES
(1, '2022/2023'),
(2, '2021/2022'),
(3, '2020/2021');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `kelas` varchar(5) NOT NULL,
  `akses` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `nama`, `kelas`, `akses`) VALUES
(7, 'AB15A', 'AB15A', 'AB15A', '8', 'user'),
(8, 'AB15B', 'AB15B', 'AB15B', '9', 'user'),
(9, 'AB16A', 'AB16A', 'AB16A', '10', 'user'),
(10, 'AB16B', 'AB16B', 'AB16B', '11', 'user'),
(1, 'Admin', 'admin', 'Administrator', '7', 'admin'),
(22, 'COOPERATION AND PLACEMENT', 'CNP', 'COOPERATION AND PLACEMENT', '24', 'user'),
(6, 'IT', 'ITlp31', 'IT', '23', 'user'),
(25, 'KAPRODI MKP', 'KAPMKP', 'KAPRODI MKP', '27', 'user'),
(24, 'KAPRODI MP', 'KAPMP', 'KAPRODI MP', '26', 'user'),
(26, 'KEUANGAN', 'KEUANGAN', 'KEUANGAN', '28', 'user'),
(23, 'MARKETING', 'MARKETING', 'MARKETING', '25', 'user'),
(5, 'MI20B', 'MI20B', 'MI20B', '2', 'user'),
(11, 'MI21A', 'MI21A', 'MI21A', '12', 'user'),
(12, 'MI21B', 'MI21B', 'MI21B', '13', 'user'),
(13, 'MI22A', 'MI22A', 'MI22A', '14', 'user'),
(14, 'MI22B', 'MI22B', 'MI22B', '15', 'user'),
(15, 'MK02K', 'MK02K', 'MK02K', '16', 'user'),
(16, 'MK02P', 'MK02P', 'MK02P', '17', 'user'),
(17, 'MK03', 'MK03', 'MK03', '18', 'user'),
(18, 'MP02', 'MP02', 'MP02', '19', 'user'),
(19, 'MP03', 'MP03', 'MP03', '20', 'user'),
(20, 'TO21', 'TO21', 'TO21', '21', 'user'),
(21, 'TO22', 'TO22', 'TO22', '22', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_b_ruang`
--
ALTER TABLE `tbl_b_ruang`
  ADD PRIMARY KEY (`id_b_ruang`);

--
-- Indexes for table `tbl_dosen`
--
ALTER TABLE `tbl_dosen`
  ADD PRIMARY KEY (`id_dosen`);

--
-- Indexes for table `tbl_jadwal`
--
ALTER TABLE `tbl_jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `tbl_konfigurasi`
--
ALTER TABLE `tbl_konfigurasi`
  ADD PRIMARY KEY (`id_konfigurasi`);

--
-- Indexes for table `tbl_mata_kuliah`
--
ALTER TABLE `tbl_mata_kuliah`
  ADD PRIMARY KEY (`id_mata_kuliah`);

--
-- Indexes for table `tbl_ruang`
--
ALTER TABLE `tbl_ruang`
  ADD PRIMARY KEY (`id_ruang`);

--
-- Indexes for table `tbl_sesi`
--
ALTER TABLE `tbl_sesi`
  ADD PRIMARY KEY (`id_sesi`);

--
-- Indexes for table `tbl_tahun_akademik`
--
ALTER TABLE `tbl_tahun_akademik`
  ADD PRIMARY KEY (`id_tahun_akademik`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_b_ruang`
--
ALTER TABLE `tbl_b_ruang`
  MODIFY `id_b_ruang` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tbl_dosen`
--
ALTER TABLE `tbl_dosen`
  MODIFY `id_dosen` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `tbl_jadwal`
--
ALTER TABLE `tbl_jadwal`
  MODIFY `id_jadwal` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=424;

--
-- AUTO_INCREMENT for table `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  MODIFY `id_kelas` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_konfigurasi`
--
ALTER TABLE `tbl_konfigurasi`
  MODIFY `id_konfigurasi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_mata_kuliah`
--
ALTER TABLE `tbl_mata_kuliah`
  MODIFY `id_mata_kuliah` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `tbl_ruang`
--
ALTER TABLE `tbl_ruang`
  MODIFY `id_ruang` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_sesi`
--
ALTER TABLE `tbl_sesi`
  MODIFY `id_sesi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_tahun_akademik`
--
ALTER TABLE `tbl_tahun_akademik`
  MODIFY `id_tahun_akademik` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
