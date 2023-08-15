-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-05-2023 a las 02:13:55
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dweb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(10) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre`, `apellido`, `correo`) VALUES
(1, 'Francisco', 'Mazza', 'fmazza@gmail.com'),
(3, 'Cecilia', 'Tandazo', 'ctandazo@gmail.com'),
(11, 'Cecilia', 'Tandazo', 'ctandazo@gmail.com'),
(12, 'Cecilia', 'Tandazo', 'ctandazo@gmail.com'),
(13, 'Cecilia', 'Tandazo', 'ctandazo@gmail.com'),
(14, 'Cecilia', 'Tandazo', 'ctandazo@gmail.com'),
(15, 'Cecilia', 'Tandazo', 'ctandazo@gmail.com'),
(16, 'Cecilia', 'Tandazo', 'ctandazo@gmail.com'),
(17, 'Cecilia', 'Tandazo', 'ctandazo@gmail.com'),
(18, 'Cecilia', 'Tandazo', 'ctandazo@gmail.com'),
(19, 'Cecilia', 'Tandazo', 'ctandazo@gmail.com'),
(20, 'Cecilia', 'Tandazo', 'ctandazo@gmail.com'),
(21, 'Cecilia', 'Tandazo', 'ctandazo@gmail.com'),
(22, 'Cecilia', 'Tandazo', 'ctandazo@gmail.com'),
(23, 'Cecilia', 'Tandazo', 'ctandazo@gmail.com'),
(24, 'Cecilia', 'Tandazo', 'ctandazo@gmail.com'),
(25, 'Cecilia', 'Tandazo', 'ctandazo@gmail.com'),
(26, 'Cecilia', 'Tandazo', 'ctandazo@gmail.com'),
(27, 'Cecilia', 'Tandazo', 'ctandazo@gmail.com'),
(28, 'Cecilia', 'Tandazo', 'ctandazo@gmail.com'),
(29, 'Cecilia', 'Tandazo', 'ctandazo@gmail.com'),
(30, 'Cecilia', 'Tandazo', 'ctandazo@gmail.com'),
(31, 'Cecilia', 'Tandazo', 'ctandazo@gmail.com'),
(32, 'Cecilia', 'Tandazo', 'ctandazo@gmail.com'),
(33, 'Cecilia', 'Tandazo', 'ctandazo@gmail.com'),
(34, 'Cecilia', 'Tandazo', 'ctandazo@gmail.com'),
(35, 'Cecilia', 'Tandazo', 'ctandazo@gmail.com'),
(36, 'Cecilia', 'Tandazo', 'ctandazo@gmail.com'),
(37, 'Francisco', 'Mazza', 'ctandazo@gmail.com'),
(38, 'Francisco', 'Mazza', 'ctandazo@gmail.com'),
(39, 'Francisco', 'Mazza', 'ctandazo@gmail.com'),
(40, 'Francisco', 'Mazza', 'ctandazo@gmail.com'),
(41, 'Francisco', 'Mazza', 'ctandazo@gmail.com'),
(42, 'Francisco', 'Mazza', 'ctandazo@gmail.com'),
(43, 'Francisco', 'Mazza', 'ctandazo@gmail.com'),
(44, 'Francisco', 'Mazza', 'ctandazo@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `franciscomaza`
--

CREATE TABLE `franciscomaza` (
  `id_francisco` int(10) NOT NULL,
  `ciudad` varchar(200) NOT NULL,
  `provincia` varchar(250) NOT NULL,
  `estado civil` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `franciscomaza`
--
ALTER TABLE `franciscomaza`
  ADD PRIMARY KEY (`id_francisco`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `franciscomaza`
--
ALTER TABLE `franciscomaza`
  MODIFY `id_francisco` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
