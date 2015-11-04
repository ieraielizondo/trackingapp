-- phpMyAdmin SQL Dump
-- version 4.4.7
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-11-2015 a las 00:22:47
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `trackingapp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posicion`
--

CREATE TABLE IF NOT EXISTS `posicion` (
  `id_posicion` int(11) NOT NULL,
  `latitud` double DEFAULT NULL,
  `longitud` double DEFAULT NULL,
  `id_usuario` varchar(50) DEFAULT NULL,
  `hora` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` varchar(50) NOT NULL,
  `nombre` varchar(35) NOT NULL,
  `apellido1` varchar(55) NOT NULL,
  `apellido2` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `validado` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `posicion`
--
ALTER TABLE `posicion`
  ADD PRIMARY KEY (`id_posicion`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `posicion`
--
ALTER TABLE `posicion`
  MODIFY `id_posicion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `posicion`
--
ALTER TABLE `posicion`
  ADD CONSTRAINT `FK_posicion_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
