-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 29-09-2016 a las 11:44:24
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `labotario_de_fabricacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cursos`
--

CREATE TABLE `Cursos` (
  `DNI` int(10) NOT NULL,
  `maquina` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Grupos_de_trabajo`
--

CREATE TABLE `Grupos_de_trabajo` (
  `nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Grupo_socio`
--

CREATE TABLE `Grupo_socio` (
  `grupo_trabajo` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `socio` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Socios`
--

CREATE TABLE `Socios` (
  `numero` int(4) NOT NULL,
  `nombre` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `tlf` int(14) NOT NULL,
  `DNI` int(10) DEFAULT NULL,
  `categoria` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_alta` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_inicio` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_fin` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `comentario` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Taller`
--

CREATE TABLE `Taller` (
  `nombre` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Taller_socio`
--

CREATE TABLE `Taller_socio` (
  `taller` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `socio` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Grupos_de_trabajo`
--
ALTER TABLE `Grupos_de_trabajo`
  ADD PRIMARY KEY (`nombre`);

--
-- Indices de la tabla `Socios`
--
ALTER TABLE `Socios`
  ADD PRIMARY KEY (`numero`),
  ADD UNIQUE KEY `DNI` (`DNI`);

--
-- Indices de la tabla `Taller`
--
ALTER TABLE `Taller`
  ADD PRIMARY KEY (`nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Socios`
--
ALTER TABLE `Socios`
  MODIFY `numero` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
