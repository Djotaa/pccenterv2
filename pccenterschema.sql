-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2021 at 02:59 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pccenter`
--
CREATE DATABASE IF NOT EXISTS `pccenter` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `pccenter`;

-- --------------------------------------------------------

--
-- Table structure for table `kategorija`
--

CREATE TABLE `kategorija` (
  `id_kategorija` int(255) NOT NULL,
  `naziv_kat` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id_korisnik` int(255) NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `datum_reg` date NOT NULL,
  `id_uloga` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `korpa`
--

CREATE TABLE `korpa` (
  `id_korisnik` int(255) NOT NULL,
  `id_proizvod` int(255) NOT NULL,
  `kolicina` int(11) NOT NULL,
  `cena` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `proizvod`
--

CREATE TABLE `proizvod` (
  `id_proizvod` int(255) NOT NULL,
  `naziv_proizvod` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cena` int(11) NOT NULL,
  `id_kategorija` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slike_proizvod`
--

CREATE TABLE `slike_proizvod` (
  `id_sp` int(255) NOT NULL,
  `slika` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `slika_thumb` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_proizvod` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `uloga`
--

CREATE TABLE `uloga` (
  `id_uloga` int(255) NOT NULL,
  `naziv` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategorija`
--
ALTER TABLE `kategorija`
  ADD PRIMARY KEY (`id_kategorija`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id_korisnik`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_uloga` (`id_uloga`);

--
-- Indexes for table `korpa`
--
ALTER TABLE `korpa`
  ADD KEY `id_korisnik` (`id_korisnik`,`id_proizvod`),
  ADD KEY `id_proizvod` (`id_proizvod`);

--
-- Indexes for table `proizvod`
--
ALTER TABLE `proizvod`
  ADD PRIMARY KEY (`id_proizvod`),
  ADD KEY `id_kat` (`id_kategorija`);

--
-- Indexes for table `slike_proizvod`
--
ALTER TABLE `slike_proizvod`
  ADD PRIMARY KEY (`id_sp`),
  ADD KEY `id_proizvod` (`id_proizvod`);

--
-- Indexes for table `uloga`
--
ALTER TABLE `uloga`
  ADD PRIMARY KEY (`id_uloga`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategorija`
--
ALTER TABLE `kategorija`
  MODIFY `id_kategorija` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id_korisnik` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proizvod`
--
ALTER TABLE `proizvod`
  MODIFY `id_proizvod` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `slike_proizvod`
--
ALTER TABLE `slike_proizvod`
  MODIFY `id_sp` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uloga`
--
ALTER TABLE `uloga`
  MODIFY `id_uloga` int(255) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `korisnik_ibfk_1` FOREIGN KEY (`id_uloga`) REFERENCES `uloga` (`id_uloga`) ON UPDATE CASCADE;

--
-- Constraints for table `korpa`
--
ALTER TABLE `korpa`
  ADD CONSTRAINT `korpa_ibfk_1` FOREIGN KEY (`id_korisnik`) REFERENCES `korisnik` (`id_korisnik`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `korpa_ibfk_2` FOREIGN KEY (`id_proizvod`) REFERENCES `proizvod` (`id_proizvod`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `proizvod`
--
ALTER TABLE `proizvod`
  ADD CONSTRAINT `proizvod_ibfk_1` FOREIGN KEY (`id_kategorija`) REFERENCES `kategorija` (`id_kategorija`) ON UPDATE CASCADE;

--
-- Constraints for table `slike_proizvod`
--
ALTER TABLE `slike_proizvod`
  ADD CONSTRAINT `slike_proizvod_ibfk_1` FOREIGN KEY (`id_proizvod`) REFERENCES `proizvod` (`id_proizvod`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
