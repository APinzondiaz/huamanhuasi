-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-08-2023 a las 01:59:40
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `wamanhuasi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fichero`
--

CREATE TABLE `fichero` (
  `id_fichero` int(10) NOT NULL,
  `id_administrador` int(10) NOT NULL DEFAULT 0,
  `id_docente` int(10) NOT NULL DEFAULT 0,
  `id_estudiante` int(11) NOT NULL DEFAULT 0,
  `nombre` varchar(250) NOT NULL,
  `ruta` varchar(250) NOT NULL DEFAULT '/var/www/ficheros/',
  `descripcion` text NOT NULL,
  `tipo` text NOT NULL DEFAULT '-',
  `estado` varchar(20) NOT NULL DEFAULT 'ACTIVO',
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `fichero`
--

INSERT INTO `fichero` (`id_fichero`, `id_administrador`, `id_docente`, `id_estudiante`, `nombre`, `ruta`, `descripcion`, `tipo`, `estado`, `fecha`) VALUES
(1, 1103313811, 0, 0, '149261691538920.pdf', '/var/www/ficheros/', 'a', '-', 'ACTIVO', '2023-08-08 18:55:20'),
(2, 1103313811, 0, 0, '113541691539110.pdf', '/var/www/ficheros/', 'a', '-', 'ACTIVO', '2023-08-08 18:58:30');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `fichero`
--
ALTER TABLE `fichero`
  ADD PRIMARY KEY (`id_fichero`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `fichero`
--
ALTER TABLE `fichero`
  MODIFY `id_fichero` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
