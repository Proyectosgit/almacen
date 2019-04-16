-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-04-2019 a las 08:57:41
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `unidad`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `id_almacen` int(3) NOT NULL,
  `nom_almacen` varchar(60) NOT NULL,
  `estado` varchar(25) NOT NULL,
  `gerente` varchar(30) NOT NULL,
  `direccion` varchar(300) NOT NULL,
  `tel` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`id_almacen`, `nom_almacen`, `estado`, `gerente`, `direccion`, `tel`) VALUES
(1, 'tercera_juarez', 'puebla', 'luis', '9 Poniente #2317 Col. Rivera de Santiago\r\n72410 Puebla', '2222222222');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_user` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(25) NOT NULL,
  `cargo` varchar(30) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `id_almacen` int(11) NOT NULL,
  `ruta` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_user`, `username`, `password`, `cargo`, `nombre`, `email`, `id_almacen`, `ruta`) VALUES
(1, 'pedro', '12345', 'administrador', 'administrador1', 'administrador3ajuarez@abmexico.com', 1, '3ajuarez'),
(2, 'jesus', '12345', 'cocina', 'cocina1', 'cocina@abmexico.com', 1, '3ajuarez'),
(3, 'paola', '12345', 'gerente', 'gerente1', 'gerente@abmexico.com', 1, '3ajuarez'),
(4, 'raul', '12345', 'barra', 'barra1', 'barra@abmexico.com', 1, '3ajuarez'),
(5, 'ivan colula', '12345', 'root', 'root', 'root@abmexico.com', 0, ''),
(6, 'erik', '12345', 'almacenCocina', 'erik lopez', 'erik@gmail.com', 1, '3ajuarez'),
(7, 'gustavo', '12345', 'almacenBarra', 'gustavo', 'gustavo@gmail.com', 1, '3ajuarez'),
(8, 'karla', '12345', 'almacenBC', 'karla', 'karla@gmail.com', 1, '3ajuarez');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD PRIMARY KEY (`id_almacen`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `user_id` (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacen`
--
ALTER TABLE `almacen`
  MODIFY `id_almacen` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
