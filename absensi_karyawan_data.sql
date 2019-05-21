-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2019 at 10:27 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi_karyawan`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id` int(11) NOT NULL,
  `tanggal_masuk` datetime NOT NULL,
  `tanggal_keluar` datetime DEFAULT NULL,
  `alasan` text NOT NULL,
  `foto` text NOT NULL,
  `karyawan_id` int(11) NOT NULL,
  `lokasi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id`, `tanggal_masuk`, `tanggal_keluar`, `alasan`, `foto`, `karyawan_id`, `lokasi_id`) VALUES
(3, '2019-04-28 08:00:00', '2019-04-28 14:32:00', 'Telat', '753Chrysanthemum.jpg', 7, 6),
(4, '2019-04-28 13:59:00', NULL, '', '720Tulips.jpg', 9, 8),
(5, '2019-04-28 14:00:00', NULL, '', '270Jellyfish.jpg', 10, 9),
(6, '2019-04-28 14:00:00', NULL, 'telat', '784Desert.jpg', 8, 7),
(7, '2019-05-01 08:00:00', '2019-05-01 17:00:00', '', '753Chrysanthemum.jpg', 9, 6),
(8, '2019-05-01 08:04:00', '2019-05-01 17:00:00', 'Macet', '720Tulips.jpg', 7, 8),
(9, '2019-05-01 08:05:00', '2019-05-01 17:00:00', '', '270Jellyfish.jpg', 10, 9),
(10, '2019-05-01 07:50:00', '2019-05-01 17:00:00', 'None', '784Desert.jpg', 8, 7),
(11, '2019-04-01 08:52:00', '2019-04-01 17:00:00', 'Ban bocor', '784Desert.jpg', 10, 8),
(12, '2019-04-01 07:04:00', '2019-04-01 17:00:00', 'Telat', '720Tulips.jpg', 9, 6),
(13, '2019-04-01 08:22:00', '2019-04-01 17:00:00', 'Telat', '753Chrysanthemum.jpg', 8, 7),
(14, '2019-04-01 07:42:00', '2019-04-01 17:00:00', '-', '270Jellyfish.jpg', 7, 9);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `nama`) VALUES
(5, 'IT'),
(6, 'HRD'),
(7, 'Finance'),
(8, 'Office');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `jenis_kelamin` char(1) NOT NULL,
  `nohp` varchar(255) NOT NULL,
  `department_id` int(11) NOT NULL,
  `shift_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `nama`, `alamat`, `jenis_kelamin`, `nohp`, `department_id`, `shift_id`) VALUES
(1, 'admin', 'Bengkong Permai', 'L', '085668014897', 1, 2),
(7, 'Ireh', 'Bengkong Sadai', 'P', '085668014897', 5, 3),
(8, 'Her', 'Bengkong Laut', 'L', '085668013333', 6, 3),
(9, 'Rehi', 'Taman kota', 'P', '089673780510', 7, 3),
(10, 'Rihe', 'Bengkong Abadi', 'L', '085668012112', 8, 3);

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`id`, `nama`) VALUES
(6, 'Kantin'),
(7, 'Kantor'),
(8, 'Gudang'),
(9, 'Luar Kantor');

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

CREATE TABLE `shift` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`id`, `nama`, `jam_mulai`, `jam_selesai`) VALUES
(3, 'Pagi', '08:00:00', '17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `karyawan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `status`, `karyawan_id`) VALUES
(1, 'admin', '2d388ebe87d02a517e2d136870deaf5783a903903be9f29dc3fa04663ba11826', 'j\0b8†c\re`±u—\"CâK‹ÄLÀ¥±êgz’Í', 'admin', 1),
(7, 'ireh', '222c499e3425504faf769d42502cd6c0d82aa5d6c609ca548f5d0426ce6e97e0', '\n¬‘“¦o·´ƒ\0ùü,ößØÂûêàô‰†Yš“äÎf', 'employee', 7),
(8, 'her', 'f8d72c7f66fadae1d2fad88e5f548906c50988753ca8de71d19e72a24a57e6bf', 'ŽS*øN2 ¿^¶HcŽA°dDÙæt„Šs', 'employee', 8),
(9, 'rehi', 'bdeb0a5140528465d03f73daafb041bb5fef97af4497857e19b1a9dc2ec2237d', 'êH•Ux¡/‰DËDm=ørï½èŽ<åg­}vÑEÑo', 'employee', 9),
(11, 'rihe', '2fb5e49dcb1d76b22ac679b1940c2f7886e16f64a10f291ad576255c4e5cc3ff', 'áTî/ÊÕˆ°ÏýpÍÊ£žT7iSµg~sW\rIŸ', 'employee', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `shift`
--
ALTER TABLE `shift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
