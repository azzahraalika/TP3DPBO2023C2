-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2023 at 06:44 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_lagu`
--

-- --------------------------------------------------------

--
-- Table structure for table `agensi`
--

CREATE TABLE `agensi` (
  `id_agensi` int(11) NOT NULL,
  `nama_agensi` varchar(100) NOT NULL,
  `foto_agensi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agensi`
--

INSERT INTO `agensi` (`id_agensi`, `nama_agensi`, `foto_agensi`) VALUES
(1, 'Hybe Entertainment', 'hybe.jpg'),
(3, 'YG Entertainment', 'yg.jpg'),
(4, 'SM Entertainment', 'sm.jpg'),
(5, 'JYP Entertainment', 'jyp.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `idol`
--

CREATE TABLE `idol` (
  `id_idol` int(11) NOT NULL,
  `nama_idol` varchar(100) NOT NULL,
  `foto_idol` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `idol`
--

INSERT INTO `idol` (`id_idol`, `nama_idol`, `foto_idol`) VALUES
(1, 'Seventeen', 'svt.png'),
(6, 'NCT', 'nct.jpeg'),
(10, 'Bigbang', 'bigbang.jpg'),
(11, 'BTS', 'bts.jpg'),
(12, 'Aespa', 'aespa.jpg'),
(13, 'StrayKidz', 'skz.jpg'),
(14, 'Itzy', 'itzy.jpg'),
(15, 'Treasure', 'trejo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `lagu`
--

CREATE TABLE `lagu` (
  `id_lagu` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `nama_album` varchar(100) NOT NULL,
  `tahun_keluar` int(11) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `id_agensi` int(11) NOT NULL,
  `id_idol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lagu`
--

INSERT INTO `lagu` (`id_lagu`, `judul`, `nama_album`, `tahun_keluar`, `deskripsi`, `foto`, `id_agensi`, `id_idol`) VALUES
(1, 'Super', 'SEVENTEEN 10th Mini Album \'FML\'', 2023, 'Sebuah lagu yang energik dan optimis yang dirilis oleh grup musik populer Seventeen. Lagu ini menggambarkan semangat hidup di usia remaja, menceritakan kisah tentang masa muda yang penuh dengan kegembiraan, impian, dan pertumbuhan.\n\nDengan melodi yang ria', 'FML.png', 1, 1),
(4, 'Beautiful', 'Universe', 2021, 'Judul lagu \"Beautiful\" oleh NCT 2021 adalah sebuah lagu yang mencerminkan keindahan dan kekuatan dalam persatuan serta semangat yang menginspirasi. Lagu ini menyoroti pesan positif tentang mencintai diri sendiri, mengatasi kesulitan, dan bergerak maju seb', 'universe.jpg', 4, 6),
(5, 'campfire', '11th mini album', 2021, 'tidak tahu y', 'FML.png', 3, 11);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agensi`
--
ALTER TABLE `agensi`
  ADD PRIMARY KEY (`id_agensi`);

--
-- Indexes for table `idol`
--
ALTER TABLE `idol`
  ADD PRIMARY KEY (`id_idol`);

--
-- Indexes for table `lagu`
--
ALTER TABLE `lagu`
  ADD PRIMARY KEY (`id_lagu`),
  ADD KEY `id_agensi` (`id_agensi`),
  ADD KEY `id_idol` (`id_idol`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agensi`
--
ALTER TABLE `agensi`
  MODIFY `id_agensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `idol`
--
ALTER TABLE `idol`
  MODIFY `id_idol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `lagu`
--
ALTER TABLE `lagu`
  MODIFY `id_lagu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lagu`
--
ALTER TABLE `lagu`
  ADD CONSTRAINT `lagu_ibfk_1` FOREIGN KEY (`id_agensi`) REFERENCES `agensi` (`id_agensi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lagu_ibfk_2` FOREIGN KEY (`id_idol`) REFERENCES `idol` (`id_idol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
