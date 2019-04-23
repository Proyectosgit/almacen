-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-04-2019 a las 14:54:32
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `almacen`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familia`
--

CREATE TABLE `familia` (
  `cod_familia` varchar(20) COLLATE utf8_bin NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_bin NOT NULL,
  `area` varchar(15) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `familia`
--

INSERT INTO `familia` (`cod_familia`, `descripcion`, `area`) VALUES
('ABARR', 'Abarrote', 'cocina'),
('BEBID', 'Bebida', 'barra'),
('BRAND', 'Brandy', 'barra'),
('CAFEE', 'Cafe', 'cocina'),
('CARNE', 'Carne', 'cocina'),
('CERVE', 'Cerveza', 'barra'),
('CHAMP', 'champagne', 'barra'),
('CIGAR', 'Cigarro', 'barra'),
('COGNA', 'Cogna', 'barra'),
('COMIS', 'COMIS', 'cocina'),
('CONGE', 'Congelado', 'cocina'),
('EMBUT', 'Embutido', 'cocina'),
('ESPEC', 'ESPEC', 'cocina'),
('FRUTA', 'Fruta', 'cocina'),
('GINEB', 'Gineb', 'barra'),
('HIELO', 'Hielo', 'barra'),
('JEREZ', 'Jerez', 'barra'),
('JUGOS', 'Jugos', 'barra'),
('LACTE', 'Lacteo', 'cocina'),
('LICOR', 'Licor', 'barra'),
('MEZCA', 'Mezcal', 'barra'),
('PAN Y', 'Pan', 'cocina'),
('PESCA', 'Pescado', 'cocina'),
('REFRE', 'Refresco', 'barra'),
('RONNN', 'Ron', 'barra'),
('SUBRE', 'SUBRE', 'cocina'),
('TEQUI', 'Tequila', 'barra'),
('VINOS', 'Vino', 'barra'),
('VODKA', 'vodka', 'barra'),
('WHISK', 'Whisky', 'barra');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `familia`
--
ALTER TABLE `familia`
  ADD PRIMARY KEY (`cod_familia`),
  ADD UNIQUE KEY `cod_familia` (`cod_familia`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
