-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2019 at 11:23 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `futurephone`
--

-- --------------------------------------------------------

--
-- Table structure for table `gastos`
--

CREATE TABLE `gastos` (
  `idGas` int(11) NOT NULL,
  `DNIUsu` varchar(9) COLLATE utf8_spanish2_ci NOT NULL,
  `IdTar` int(11) NOT NULL,
  `TfnGas` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `MinGas` int(11) DEFAULT NULL,
  `MegGas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `gastos`
--

INSERT INTO `gastos` (`idGas`, `DNIUsu`, `IdTar`, `TfnGas`, `MinGas`, `MegGas`) VALUES
(23, '111111111', 10, '000000000', 0, 0),
(24, '12345678C', 11, '444444444', 0, 0),
(25, '12345678C', 11, '333777777', 0, 0),
(26, '12345678C', 11, '123123321', 0, 0),
(27, '12345678C', 10, '619555555', 0, 0),
(28, '12345678C', 10, '223333222', 0, 0),
(29, '12345678C', 10, '333111222', 0, 0),
(34, '111111111', 11, '678111111', 1, 1),
(35, '111111111', 11, '100000000', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `original_name` varchar(64) NOT NULL,
  `mime_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `name`, `original_name`, `mime_type`) VALUES
(11, '1143515767.tmp', 'text2.png', 'image/png'),
(12, '1827463622.tmp', 'image-not-available.png', 'image/png'),
(13, '1640105635.tmp', 'text2.png', 'image/png'),
(14, '75120579.tmp', 'text2.png', 'image/png'),
(15, '1112575591.tmp', 'png-test-image-7.png', 'image/png'),
(16, '254327340.tmp', '8565186-13490409.jpg', 'image/jpeg'),
(17, '913266939.tmp', '8565186-13490409.jpg', 'image/jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `marca`
--

CREATE TABLE `marca` (
  `idMarca` int(11) NOT NULL,
  `nombreMarca` varchar(30) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `marca`
--

INSERT INTO `marca` (`idMarca`, `nombreMarca`) VALUES
(0, 'xioami'),
(1, 'samsung');

-- --------------------------------------------------------

--
-- Table structure for table `modelo`
--

CREATE TABLE `modelo` (
  `idModelo` int(11) NOT NULL,
  `nombreModelo` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `idMarca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `modelo`
--

INSERT INTO `modelo` (`idModelo`, `nombreModelo`, `idMarca`) VALUES
(1, 'galaxy s8', 1),
(2, 'mi9t', 0);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `idRol` int(11) NOT NULL,
  `NomRol` varchar(45) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`idRol`, `NomRol`) VALUES
(0, 'admin'),
(1, 'comercial'),
(2, 'cliente');

-- --------------------------------------------------------

--
-- Table structure for table `tarifa`
--

CREATE TABLE `tarifa` (
  `idTar` int(11) NOT NULL,
  `NomTar` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `PrecTar` double NOT NULL,
  `MinTar` int(11) NOT NULL,
  `MegTar` int(11) NOT NULL,
  `Descr` mediumtext COLLATE utf8_spanish2_ci NOT NULL,
  `idImg` int(11) DEFAULT 12
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `tarifa`
--

INSERT INTO `tarifa` (`idTar`, `NomTar`, `PrecTar`, `MinTar`, `MegTar`, `Descr`, `idImg`) VALUES
(10, 'tarifa3', 3, 3, 3, 'tarifa3desc', 17),
(11, 'tarifa4', 4, 4, 4, 'tarifa4desc', 12),
(12, 'tarifa5', 5, 5, 5, 'esta es la tarifa5', 16);

-- --------------------------------------------------------

--
-- Table structure for table `telefono`
--

CREATE TABLE `telefono` (
  `idTelf` int(11) NOT NULL,
  `idMarca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `telefono`
--

INSERT INTO `telefono` (`idTelf`, `idMarca`) VALUES
(1, 0),
(0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `telefono_usuario`
--

CREATE TABLE `telefono_usuario` (
  `idTelf` int(11) NOT NULL,
  `DNIUsu` varchar(9) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `telefono_usuario`
--

INSERT INTO `telefono_usuario` (`idTelf`, `DNIUsu`) VALUES
(0, '12345678A');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `DNIUsu` varchar(9) COLLATE utf8_spanish2_ci NOT NULL COMMENT '	',
  `PwdUsu` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `NomUsu` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `ApeUsu` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `EmaUsu` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `ConUsu` varchar(9) COLLATE utf8_spanish2_ci NOT NULL,
  `IdRol` int(11) NOT NULL,
  `apiKey` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`DNIUsu`, `PwdUsu`, `NomUsu`, `ApeUsu`, `EmaUsu`, `ConUsu`, `IdRol`, `apiKey`) VALUES
('111111111', '827ccb0eea8a706c4c34a16891f84e7b', 'usuario5', 'usuario5', 'usuario5@usuario.com', '123999000', 2, NULL),
('12344678B', '827ccb0eea8a706c4c34a16891f84e7b', 'usuario3', 'usuario3', 'usuario@usuario3.com', '123123123', 0, NULL),
('12345678A', '827ccb0eea8a706c4c34a16891f84e7b', 'NomAdmin', 'ApeAdmin', 'admin@admin.com', '111222333', 0, '3ca471d99fd82572e10b02f7588ff8ee'),
('12345678B', '827ccb0eea8a706c4c34a16891f84e7b', 'NomUsuario', 'ApeUsuario', 'usuario@usuario.com', '111222333', 2, NULL),
('12345678C', '827ccb0eea8a706c4c34a16891f84e7b', 'NomComercial', 'ApeComercial', 'comercial@comercial.com', '111222333', 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`idGas`),
  ADD KEY `DNIUsu_idx` (`DNIUsu`),
  ADD KEY `IdTar_idx` (`IdTar`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`idMarca`);

--
-- Indexes for table `modelo`
--
ALTER TABLE `modelo`
  ADD PRIMARY KEY (`idModelo`),
  ADD KEY `fk_marca_modelo` (`idMarca`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idRol`);

--
-- Indexes for table `tarifa`
--
ALTER TABLE `tarifa`
  ADD PRIMARY KEY (`idTar`);

--
-- Indexes for table `telefono`
--
ALTER TABLE `telefono`
  ADD PRIMARY KEY (`idTelf`),
  ADD KEY `fk_marca_telefono` (`idMarca`);

--
-- Indexes for table `telefono_usuario`
--
ALTER TABLE `telefono_usuario`
  ADD PRIMARY KEY (`idTelf`,`DNIUsu`),
  ADD KEY `fk_usuario_telefono_usuario` (`DNIUsu`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`DNIUsu`),
  ADD KEY `IdRol_idx` (`IdRol`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gastos`
--
ALTER TABLE `gastos`
  MODIFY `idGas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `modelo`
--
ALTER TABLE `modelo`
  MODIFY `idModelo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tarifa`
--
ALTER TABLE `tarifa`
  MODIFY `idTar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gastos`
--
ALTER TABLE `gastos`
  ADD CONSTRAINT `DNIUsu` FOREIGN KEY (`DNIUsu`) REFERENCES `usuario` (`DNIUsu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `IdTar` FOREIGN KEY (`IdTar`) REFERENCES `tarifa` (`idTar`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `modelo`
--
ALTER TABLE `modelo`
  ADD CONSTRAINT `fk_marca_modelo` FOREIGN KEY (`idMarca`) REFERENCES `marca` (`idMarca`);

--
-- Constraints for table `telefono`
--
ALTER TABLE `telefono`
  ADD CONSTRAINT `fk_marca_telefono` FOREIGN KEY (`idMarca`) REFERENCES `marca` (`idMarca`);

--
-- Constraints for table `telefono_usuario`
--
ALTER TABLE `telefono_usuario`
  ADD CONSTRAINT `fk_telefono_telefono_usuario` FOREIGN KEY (`idTelf`) REFERENCES `telefono` (`idTelf`),
  ADD CONSTRAINT `fk_usuario_telefono_usuario` FOREIGN KEY (`DNIUsu`) REFERENCES `usuario` (`DNIUsu`);

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `IdRol` FOREIGN KEY (`IdRol`) REFERENCES `roles` (`idRol`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
