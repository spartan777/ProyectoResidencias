-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-11-2016 a las 01:27:23
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `scah`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `id_carrera` varchar(13) NOT NULL,
  `nombre_carrera` varchar(50) NOT NULL,
  `img_carrera` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`id_carrera`, `nombre_carrera`, `img_carrera`) VALUES
('123', 'Gestión', ''),
('126', 'Sistemas', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jefe_carrera`
--

CREATE TABLE `jefe_carrera` (
  `id_usuario` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `ape_materno` varchar(50) NOT NULL,
  `id_carrera` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `jefe_carrera`
--

INSERT INTO `jefe_carrera` (`id_usuario`, `nombre`, `ape_materno`, `id_carrera`) VALUES
('584', 'Jefe', 'Carrera', '126');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(20) NOT NULL,
  `pass_usuario` varchar(50) NOT NULL,
  `tipo_usuario` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre_usuario`, `pass_usuario`, `tipo_usuario`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`id_carrera`);

--
-- Indices de la tabla `jefe_carrera`
--
ALTER TABLE `jefe_carrera`
  ADD KEY `id_carrera` (`id_carrera`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `jefe_carrera`
--
ALTER TABLE `jefe_carrera`
  ADD CONSTRAINT `jefe_carrera_ibfk_1` FOREIGN KEY (`id_carrera`) REFERENCES `carreras` (`id_carrera`);
