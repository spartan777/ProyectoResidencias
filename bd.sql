-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-11-2016 a las 03:29:05
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

--
-- Volcado de datos para la tabla `catedratico`
--

INSERT INTO `catedratico` (`id_catedratico`, `nombre`, `ape_materno`, `ape_paterno`, `correo`, `id_carrera`) VALUES
('789', 'Prueba', 'Prueba2', 'Prueba1', 'dsa@ds.xocm', '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_dia_semana`
--

CREATE TABLE IF NOT EXISTS `cat_dia_semana` (
  `id_dia_semana` int(11) NOT NULL AUTO_INCREMENT,
  `desc_dia_semana` varchar(15) NOT NULL,
  PRIMARY KEY (`id_dia_semana`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `cat_dia_semana`
--

INSERT INTO `cat_dia_semana` (`id_dia_semana`, `desc_dia_semana`) VALUES
(1, 'Lunes'),
(2, 'Martes'),
(3, 'Miercoles'),
(4, 'Jueves'),
(5, 'Viernes'),
(6, 'Sabado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_horario`
--

CREATE TABLE IF NOT EXISTS `cat_horario` (
  `id_horario` int(11) NOT NULL AUTO_INCREMENT,
  `desc_horario` varchar(15) NOT NULL,
  PRIMARY KEY (`id_horario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `cat_horario`
--

INSERT INTO `cat_horario` (`id_horario`, `desc_horario`) VALUES
(1, '07:00 - 08:00'),
(2, '08:00 - 09:00'),
(3, '09:00 - 10:00'),
(4, '10:00 - 11:00'),
(5, '11:00 - 12:00'),
(6, '12:00 - 13:00'),
(7, '13:00 - 14:00'),
(8, '15:00 - 16:00'),
(9, '16:00 - 17:00'),
(10, '17:00 - 18:00'),
(11, '18:00 - 19:00'),
(12, '19:00 - 20:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_horario`
--

CREATE TABLE IF NOT EXISTS `detalle_horario` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `id_catedratico` varchar(20) NOT NULL,
  `id_dia_semana` int(11) NOT NULL,
  `id_horario` int(11) NOT NULL,
  `id_materia` varchar(20) NOT NULL,
  `id_salon` varchar(10) NOT NULL,
  `id_grupo` varchar(5) NOT NULL,
  PRIMARY KEY (`id_detalle`),
  KEY `id_catedratico` (`id_catedratico`),
  KEY `id_dia_semana` (`id_dia_semana`),
  KEY `id_horario` (`id_horario`),
  KEY `id_materia` (`id_materia`),
  KEY `id_salon` (`id_salon`),
  KEY `id_grupo` (`id_grupo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `detalle_horario`
--

INSERT INTO `detalle_horario` (`id_detalle`, `id_catedratico`, `id_dia_semana`, `id_horario`, `id_materia`, `id_salon`, `id_grupo`) VALUES
(5, '789', 3, 2, '8963', '21', '4787'),
(6, '789', 3, 1, '8963', '21', '4787'),
(7, '789', 1, 12, '8963', '21', '8544'),
(8, '789', 4, 1, '8963', '21', '4787');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE IF NOT EXISTS `grupos` (
  `id_grupo` varchar(5) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `id_carrera` varchar(13) NOT NULL,
  PRIMARY KEY (`id_grupo`),
  KEY `id_carrera` (`id_carrera`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id_grupo`, `nombre`, `id_carrera`) VALUES
('4787', 'CC3', '123'),
('8544', 'CC5', '123');

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
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE IF NOT EXISTS `materias` (
  `id_materia` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `id_carrera` varchar(13) NOT NULL,
  `creditos` int(11) NOT NULL,
  `horas_teoricas` int(11) NOT NULL,
  `horas_practicas` int(11) NOT NULL,
  PRIMARY KEY (`id_materia`),
  KEY `id_carrera` (`id_carrera`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`id_materia`, `nombre`, `id_carrera`, `creditos`, `horas_teoricas`, `horas_practicas`) VALUES
('8963', 'Calculo', '123', 10, 5, 5);

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
(3, '585', '21232f297a57a5a743894a0e4a801fc3', 'Jefe'),
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
-- Filtros para la tabla `detalle_horario`
--
ALTER TABLE `detalle_horario`
  ADD CONSTRAINT `detalle_horario_ibfk_6` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id_grupo`),
  ADD CONSTRAINT `detalle_horario_ibfk_1` FOREIGN KEY (`id_catedratico`) REFERENCES `catedratico` (`id_catedratico`),
  ADD CONSTRAINT `detalle_horario_ibfk_2` FOREIGN KEY (`id_dia_semana`) REFERENCES `cat_dia_semana` (`id_dia_semana`),
  ADD CONSTRAINT `detalle_horario_ibfk_3` FOREIGN KEY (`id_horario`) REFERENCES `cat_horario` (`id_horario`),
  ADD CONSTRAINT `detalle_horario_ibfk_4` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id_materia`),
  ADD CONSTRAINT `detalle_horario_ibfk_5` FOREIGN KEY (`id_salon`) REFERENCES `salones` (`id_salon`);

--
-- Filtros para la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD CONSTRAINT `grupos_ibfk_1` FOREIGN KEY (`id_carrera`) REFERENCES `carreras` (`id_carrera`);

--
-- Filtros para la tabla `jefe_carrera`
--
ALTER TABLE `jefe_carrera`
  ADD CONSTRAINT `jefe_carrera_ibfk_1` FOREIGN KEY (`id_carrera`) REFERENCES `carreras` (`id_carrera`);

--
-- Filtros para la tabla `materias`
--
ALTER TABLE `materias`
  ADD CONSTRAINT `materias_ibfk_1` FOREIGN KEY (`id_carrera`) REFERENCES `carreras` (`id_carrera`);
