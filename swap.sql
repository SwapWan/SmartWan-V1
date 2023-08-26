-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2023 at 03:16 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `swap`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_avaliacao`
--

CREATE TABLE `tb_avaliacao` (
  `ava_id` int(11) NOT NULL,
  `ava_cliente_id` int(11) NOT NULL,
  `ava_cliente` varchar(120) NOT NULL,
  `ava_seguimento` varchar(120) DEFAULT NULL,
  `ava_nota` int(11) NOT NULL,
  `ava_data` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_cliente`
--

CREATE TABLE `tb_cliente` (
  `cli_id` int(11) NOT NULL,
  `cli_nome` varchar(120) NOT NULL,
  `cli_seguimento` varchar(120) DEFAULT NULL,
  `cli_nps` float NOT NULL DEFAULT 0,
  `cli_detratores` int(11) NOT NULL DEFAULT 0,
  `cli_promotores` int(11) NOT NULL DEFAULT 0,
  `cli_neutros` int(11) NOT NULL DEFAULT 0,
  `cli_quantidade` int(11) NOT NULL DEFAULT 0,
  `cli_data_cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `cli_verificacao` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_avaliacao`
--
ALTER TABLE `tb_avaliacao`
  ADD PRIMARY KEY (`ava_id`);

--
-- Indexes for table `tb_cliente`
--
ALTER TABLE `tb_cliente`
  ADD PRIMARY KEY (`cli_id`);
ALTER TABLE `tb_cliente` ADD FULLTEXT KEY `FullTextNome` (`cli_nome`,`cli_seguimento`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_avaliacao`
--
ALTER TABLE `tb_avaliacao`
  MODIFY `ava_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_cliente`
--
ALTER TABLE `tb_cliente`
  MODIFY `cli_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
