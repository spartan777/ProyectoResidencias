-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-12-2016 a las 00:06:23
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `scah`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `academia`
--

CREATE TABLE `academia` (
  `id_academia` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `paterno` varchar(30) NOT NULL,
  `materno` varchar(30) NOT NULL,
  `tipo` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `academia`
--

INSERT INTO `academia` (`id_academia`, `nombre`, `paterno`, `materno`, `tipo`) VALUES
(1, 'Prueba', 'Alfonsin', 'Ferat', 'Subdirectora Académica'),
(2, 'Rosa Carolina', 'Armas', 'Guzmán', 'Directora Académica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `id_bitacora` int(11) NOT NULL,
  `id_usuario` varchar(20) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modulo` varchar(100) NOT NULL,
  `accion` varchar(15) NOT NULL,
  `registro` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `bitacora`
--

INSERT INTO `bitacora` (`id_bitacora`, `id_usuario`, `fecha`, `modulo`, `accion`, `registro`) VALUES
(1, '895', '0000-00-00 00:00:00', 'Catedratico', 'Insertar', '7852'),
(2, '895', '2016-11-24 17:42:13', 'Prueba', 'Prueba', 'Prueba'),
(3, '895', '2016-11-28 16:36:55', 'Catedrático', 'Alta', '123');

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
('5632', 'Sistemas', ''),
('698', 'Informatica', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catedratico`
--

CREATE TABLE `catedratico` (
  `id_catedratico` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `ape_materno` varchar(50) NOT NULL,
  `ape_paterno` varchar(40) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `id_carrera` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `catedratico`
--

INSERT INTO `catedratico` (`id_catedratico`, `nombre`, `ape_materno`, `ape_paterno`, `correo`, `id_carrera`) VALUES
('123', 'jdsa', 'das', 'asd', 'prueba@da.com', '123'),
('789', 'Prueba', 'Prueba2', 'Prueba1', 'dsa@ds.xocm', '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_dia_semana`
--

CREATE TABLE `cat_dia_semana` (
  `id_dia_semana` int(11) NOT NULL,
  `desc_dia_semana` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `cat_horario` (
  `id_horario` int(11) NOT NULL,
  `desc_horario` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Estructura de tabla para la tabla `clasificacion`
--

CREATE TABLE `clasificacion` (
  `id_clasificacion` varchar(2) NOT NULL,
  `clasificacion` varchar(40) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `actividad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clasificacion`
--

INSERT INTO `clasificacion` (`id_clasificacion`, `clasificacion`, `descripcion`, `actividad`) VALUES
('2', 'docencia', 'Prueba 2', 'Prueba 3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_actividad`
--

CREATE TABLE `detalle_actividad` (
  `id_detalle_act` int(11) NOT NULL,
  `id_catedratico` varchar(20) NOT NULL,
  `id_dia_semana` int(11) NOT NULL,
  `id_horario` int(11) NOT NULL,
  `id_clasificacion` varchar(2) NOT NULL,
  `id_periodo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_actividad`
--

INSERT INTO `detalle_actividad` (`id_detalle_act`, `id_catedratico`, `id_dia_semana`, `id_horario`, `id_clasificacion`, `id_periodo`) VALUES
(1, '789', 2, 4, '2', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_horario`
--

CREATE TABLE `detalle_horario` (
  `id_detalle` int(11) NOT NULL,
  `id_catedratico` varchar(20) NOT NULL,
  `id_dia_semana` int(11) NOT NULL,
  `id_horario` int(11) NOT NULL,
  `id_materia` varchar(20) NOT NULL,
  `id_salon` varchar(10) NOT NULL,
  `id_grupo` varchar(5) NOT NULL,
  `id_periodo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_horario`
--

INSERT INTO `detalle_horario` (`id_detalle`, `id_catedratico`, `id_dia_semana`, `id_horario`, `id_materia`, `id_salon`, `id_grupo`, `id_periodo`) VALUES
(5, '789', 3, 2, '8963', '21', '4787', 'Agosto - D'),
(6, '789', 3, 1, '8963', '21', '4787', 'Agosto - D'),
(7, '789', 1, 12, '8963', '21', '8544', 'Agosto - D'),
(8, '789', 4, 1, '8963', '21', '4787', 'Agosto - D');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id_grupo` varchar(5) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `id_carrera` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id_grupo`, `nombre`, `id_carrera`) VALUES
('4787', 'CC3', '698'),
('8544', 'CC5', '698');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jefe_carrera`
--

CREATE TABLE `jefe_carrera` (
  `id_usuario` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `ape_materno` varchar(50) NOT NULL,
  `ape_paterno` varchar(40) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `id_carrera` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `jefe_carrera`
--

INSERT INTO `jefe_carrera` (`id_usuario`, `nombre`, `ape_materno`, `ape_paterno`, `correo`, `id_carrera`) VALUES
('3698', 'ad', 'fsa', 'asd', 'dsa@dsa.com', '5632'),
('895', 'sfk', 'sdf', 'jksaj', 'fds@asd.com', '123'),
('89657', 'adsk', 'dal', 'ask', 'prueba@dksnmfd.com', '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `id_materia` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `id_carrera` varchar(13) NOT NULL,
  `creditos` int(11) NOT NULL,
  `horas_teoricas` int(11) NOT NULL,
  `horas_practicas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`id_materia`, `nombre`, `id_carrera`, `creditos`, `horas_teoricas`, `horas_practicas`) VALUES
('8963', 'Prueba Edit', '698', 9, 6, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodos`
--

CREATE TABLE `periodos` (
  `id_periodo` varchar(10) NOT NULL,
  `descripcion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salones`
--

CREATE TABLE `salones` (
  `id_salon` varchar(10) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `salones`
--

INSERT INTO `salones` (`id_salon`, `nombre`) VALUES
('21', 'Edit prueba'),
('23', 'Prueba'),
('65', 'Sala de computo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(100) NOT NULL,
  `pass_usuario` varchar(50) NOT NULL,
  `tipo_usuario` varchar(15) NOT NULL,
  `clave_usuario` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre_usuario`, `pass_usuario`, `tipo_usuario`, `clave_usuario`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', ''),
(2, '0', '0', '', ''),
(4, '', '', '', ''),
(5, '', '', '', ''),
(6, '', '', '', ''),
(7, 'fds@asd.com', '21232f297a57a5a743894a0e4a801fc3', 'Jefe', '895'),
(8, '3698', '21232f297a57a5a743894a0e4a801fc3', 'Jefe', ''),
(9, '89657', '21232f297a57a5a743894a0e4a801fc3', 'Jefe', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `academia`
--
ALTER TABLE `academia`
  ADD PRIMARY KEY (`id_academia`);

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`id_bitacora`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`id_carrera`);

--
-- Indices de la tabla `catedratico`
--
ALTER TABLE `catedratico`
  ADD PRIMARY KEY (`id_catedratico`),
  ADD KEY `id_catedratico` (`id_catedratico`),
  ADD KEY `catedratico_ibfk_1` (`id_carrera`);

--
-- Indices de la tabla `cat_dia_semana`
--
ALTER TABLE `cat_dia_semana`
  ADD PRIMARY KEY (`id_dia_semana`);

--
-- Indices de la tabla `cat_horario`
--
ALTER TABLE `cat_horario`
  ADD PRIMARY KEY (`id_horario`);

--
-- Indices de la tabla `clasificacion`
--
ALTER TABLE `clasificacion`
  ADD PRIMARY KEY (`id_clasificacion`);

--
-- Indices de la tabla `detalle_actividad`
--
ALTER TABLE `detalle_actividad`
  ADD PRIMARY KEY (`id_detalle_act`),
  ADD KEY `id_catedratico` (`id_catedratico`),
  ADD KEY `id_horario` (`id_horario`),
  ADD KEY `id_dia_semana` (`id_dia_semana`),
  ADD KEY `id_clasificacion` (`id_clasificacion`);

--
-- Indices de la tabla `detalle_horario`
--
ALTER TABLE `detalle_horario`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_catedratico` (`id_catedratico`),
  ADD KEY `id_dia_semana` (`id_dia_semana`),
  ADD KEY `id_horario` (`id_horario`),
  ADD KEY `id_materia` (`id_materia`),
  ADD KEY `id_salon` (`id_salon`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id_grupo`),
  ADD KEY `id_carrera` (`id_carrera`);

--
-- Indices de la tabla `jefe_carrera`
--
ALTER TABLE `jefe_carrera`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_carrera` (`id_carrera`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id_materia`),
  ADD KEY `id_carrera` (`id_carrera`);

--
-- Indices de la tabla `periodos`
--
ALTER TABLE `periodos`
  ADD PRIMARY KEY (`id_periodo`);

--
-- Indices de la tabla `salones`
--
ALTER TABLE `salones`
  ADD PRIMARY KEY (`id_salon`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `academia`
--
ALTER TABLE `academia`
  MODIFY `id_academia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `id_bitacora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `cat_dia_semana`
--
ALTER TABLE `cat_dia_semana`
  MODIFY `id_dia_semana` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `cat_horario`
--
ALTER TABLE `cat_horario`
  MODIFY `id_horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `detalle_actividad`
--
ALTER TABLE `detalle_actividad`
  MODIFY `id_detalle_act` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `detalle_horario`
--
ALTER TABLE `detalle_horario`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD CONSTRAINT `bitacora_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `jefe_carrera` (`id_usuario`);

--
-- Filtros para la tabla `catedratico`
--
ALTER TABLE `catedratico`
  ADD CONSTRAINT `catedratico_ibfk_1` FOREIGN KEY (`id_carrera`) REFERENCES `carreras` (`id_carrera`);

--
-- Filtros para la tabla `detalle_actividad`
--
ALTER TABLE `detalle_actividad`
  ADD CONSTRAINT `detalle_actividad_ibfk_1` FOREIGN KEY (`id_catedratico`) REFERENCES `catedratico` (`id_catedratico`),
  ADD CONSTRAINT `detalle_actividad_ibfk_2` FOREIGN KEY (`id_horario`) REFERENCES `cat_horario` (`id_horario`),
  ADD CONSTRAINT `detalle_actividad_ibfk_3` FOREIGN KEY (`id_dia_semana`) REFERENCES `cat_dia_semana` (`id_dia_semana`),
  ADD CONSTRAINT `detalle_actividad_ibfk_4` FOREIGN KEY (`id_clasificacion`) REFERENCES `clasificacion` (`id_clasificacion`);

--
-- Filtros para la tabla `detalle_horario`
--
ALTER TABLE `detalle_horario`
  ADD CONSTRAINT `detalle_horario_ibfk_1` FOREIGN KEY (`id_catedratico`) REFERENCES `catedratico` (`id_catedratico`),
  ADD CONSTRAINT `detalle_horario_ibfk_2` FOREIGN KEY (`id_dia_semana`) REFERENCES `cat_dia_semana` (`id_dia_semana`),
  ADD CONSTRAINT `detalle_horario_ibfk_3` FOREIGN KEY (`id_horario`) REFERENCES `cat_horario` (`id_horario`),
  ADD CONSTRAINT `detalle_horario_ibfk_4` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id_materia`),
  ADD CONSTRAINT `detalle_horario_ibfk_5` FOREIGN KEY (`id_salon`) REFERENCES `salones` (`id_salon`),
  ADD CONSTRAINT `detalle_horario_ibfk_6` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id_grupo`);

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
