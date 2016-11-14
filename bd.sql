-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-11-2016 a las 04:22:08
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `scah`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE IF NOT EXISTS `carreras` (
  `id_carrera` varchar(13) NOT NULL,
  `nombre_carrera` varchar(50) NOT NULL,
  `img_carrera` varchar(50) NOT NULL,
  PRIMARY KEY (`id_carrera`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`id_carrera`, `nombre_carrera`, `img_carrera`) VALUES
('123', 'Gestión', ''),
('126', 'Sistemas', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catedratico`
--

CREATE TABLE IF NOT EXISTS `catedratico` (
  `id_catedratico` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `ape_materno` varchar(50) NOT NULL,
  `ape_paterno` varchar(40) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `id_carrera` varchar(13) NOT NULL,
  PRIMARY KEY (`id_catedratico`),
  KEY `id_catedratico` (`id_catedratico`),
  KEY `catedratico_ibfk_1` (`id_carrera`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jefe_carrera`
--

CREATE TABLE IF NOT EXISTS `jefe_carrera` (
  `id_usuario` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `ape_materno` varchar(50) NOT NULL,
  `ape_paterno` varchar(40) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `id_carrera` varchar(13) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `id_carrera` (`id_carrera`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `jefe_carrera`
--

INSERT INTO `jefe_carrera` (`id_usuario`, `nombre`, `ape_materno`, `ape_paterno`, `correo`, `id_carrera`) VALUES
('585', 'fsd', 'fds', 'dfs', 'dsa', '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salones`
--

CREATE TABLE IF NOT EXISTS `salones` (
  `id_salon` varchar(10) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`id_salon`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `salones`
--

INSERT INTO `salones` (`id_salon`, `nombre`) VALUES
('21', 'Edit prueba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(20) NOT NULL,
  `pass_usuario` varchar(50) NOT NULL,
  `tipo_usuario` varchar(15) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre_usuario`, `pass_usuario`, `tipo_usuario`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin'),
(2, '0', '0', ''),
(3, '585', '', ''),
(4, '', '', ''),
(5, '', '', ''),
(6, '', '', '');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `catedratico`
--
ALTER TABLE `catedratico`
  ADD CONSTRAINT `catedratico_ibfk_1` FOREIGN KEY (`id_carrera`) REFERENCES `carreras` (`id_carrera`);

--
-- Filtros para la tabla `jefe_carrera`
--
ALTER TABLE `jefe_carrera`
  ADD CONSTRAINT `jefe_carrera_ibfk_1` FOREIGN KEY (`id_carrera`) REFERENCES `carreras` (`id_carrera`);
