-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-06-2015 a las 19:54:03
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `doobah`
--
CREATE DATABASE IF NOT EXISTS `doobah` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `doobah`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE IF NOT EXISTS `actividades` (
`id_a` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `fecha_actividad` datetime NOT NULL,
  `lugar` varchar(50) NOT NULL,
  `taxonomia` varchar(50) NOT NULL,
  `subtaxonomia` varchar(50) NOT NULL,
  `foto_principal` varchar(200) NOT NULL,
  `descripcion` varchar(1000) NOT NULL,
  `id_g` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anunciante`
--

CREATE TABLE IF NOT EXISTS `anunciante` (
  `nick` varchar(12) NOT NULL,
  `fecha_alta` date NOT NULL,
  `cif` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncios`
--

CREATE TABLE IF NOT EXISTS `anuncios` (
`id_an` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `fecha_evento` datetime NOT NULL,
  `lugar` varchar(50) NOT NULL,
  `descripcion` varchar(1000) NOT NULL,
  `taxonomia` varchar(50) NOT NULL,
  `subtaxonomia` varchar(50) NOT NULL,
  `foto_principal` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentar_actividad`
--

CREATE TABLE IF NOT EXISTS `comentar_actividad` (
`id_ca` int(11) NOT NULL,
  `nick` varchar(12) NOT NULL,
  `id_a` int(50) NOT NULL,
  `comentario` varchar(500) NOT NULL,
  `fecha_comenta` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentar_anuncio`
--

CREATE TABLE IF NOT EXISTS `comentar_anuncio` (
`id_can` int(11) NOT NULL,
  `nick` varchar(12) NOT NULL,
  `id_an` int(11) NOT NULL,
  `comentario` varchar(500) NOT NULL,
  `fecha_comenta` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE IF NOT EXISTS `grupos` (
`id_g` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `privado` enum('publico','privado') NOT NULL,
  `taxonomia` varchar(50) NOT NULL,
  `subtaxonomia` varchar(50) NOT NULL,
  `foto_principal` varchar(200) NOT NULL,
  `descripcion` varchar(1000) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participar_actividad`
--

CREATE TABLE IF NOT EXISTS `participar_actividad` (
  `nick` varchar(12) NOT NULL,
  `id_a` int(11) NOT NULL,
  `es_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pertenecer_grupo`
--

CREATE TABLE IF NOT EXISTS `pertenecer_grupo` (
  `nick` varchar(12) NOT NULL,
  `id_g` int(11) NOT NULL,
  `es_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publica_anuncio`
--

CREATE TABLE IF NOT EXISTS `publica_anuncio` (
  `nick` varchar(12) NOT NULL,
  `id_an` int(11) NOT NULL,
  `fecha_publica` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relacion_taxonomia`
--

CREATE TABLE IF NOT EXISTS `relacion_taxonomia` (
  `id_t` int(11) NOT NULL,
  `id_s` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subtaxonomia`
--

CREATE TABLE IF NOT EXISTS `subtaxonomia` (
`id_s` int(11) NOT NULL,
  `subtaxonomia` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `taxonomia`
--

CREATE TABLE IF NOT EXISTS `taxonomia` (
`id_t` int(11) NOT NULL,
  `taxo` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `nick` varchar(12) NOT NULL,
  `password` varchar(80) NOT NULL,
  `fecha_nac` date DEFAULT NULL,
  `nombreCompleto` varchar(50) DEFAULT NULL,
  `tipo` enum('admin','registrado','anunciante') NOT NULL,
  `descripcion` varchar(1000) DEFAULT NULL,
  `avatar` varchar(200) DEFAULT NULL,
  `ciudad` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `salt` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
 ADD PRIMARY KEY (`id_a`), ADD KEY `actividades_ibfk_1` (`id_g`);

--
-- Indices de la tabla `anunciante`
--
ALTER TABLE `anunciante`
 ADD PRIMARY KEY (`nick`);

--
-- Indices de la tabla `anuncios`
--
ALTER TABLE `anuncios`
 ADD PRIMARY KEY (`id_an`);

--
-- Indices de la tabla `comentar_actividad`
--
ALTER TABLE `comentar_actividad`
 ADD PRIMARY KEY (`id_ca`), ADD KEY `comentar_actividad_ibfk_1` (`nick`), ADD KEY `comentar_actividad_ibfk_2` (`id_a`);

--
-- Indices de la tabla `comentar_anuncio`
--
ALTER TABLE `comentar_anuncio`
 ADD PRIMARY KEY (`id_can`), ADD KEY `comentar_anuncio_ibfk_1` (`nick`), ADD KEY `comentar_anuncio_ibfk_2` (`id_an`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
 ADD PRIMARY KEY (`id_g`);

--
-- Indices de la tabla `participar_actividad`
--
ALTER TABLE `participar_actividad`
 ADD PRIMARY KEY (`nick`,`id_a`), ADD KEY `id_a` (`id_a`);

--
-- Indices de la tabla `pertenecer_grupo`
--
ALTER TABLE `pertenecer_grupo`
 ADD PRIMARY KEY (`nick`,`id_g`), ADD KEY `id_g` (`id_g`);

--
-- Indices de la tabla `publica_anuncio`
--
ALTER TABLE `publica_anuncio`
 ADD PRIMARY KEY (`nick`,`id_an`), ADD KEY `id_an` (`id_an`);

--
-- Indices de la tabla `relacion_taxonomia`
--
ALTER TABLE `relacion_taxonomia`
 ADD PRIMARY KEY (`id_t`,`id_s`), ADD KEY `id_s` (`id_s`);

--
-- Indices de la tabla `subtaxonomia`
--
ALTER TABLE `subtaxonomia`
 ADD PRIMARY KEY (`id_s`);

--
-- Indices de la tabla `taxonomia`
--
ALTER TABLE `taxonomia`
 ADD PRIMARY KEY (`id_t`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`nick`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
MODIFY `id_a` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `anuncios`
--
ALTER TABLE `anuncios`
MODIFY `id_an` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `comentar_actividad`
--
ALTER TABLE `comentar_actividad`
MODIFY `id_ca` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `comentar_anuncio`
--
ALTER TABLE `comentar_anuncio`
MODIFY `id_can` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
MODIFY `id_g` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `subtaxonomia`
--
ALTER TABLE `subtaxonomia`
MODIFY `id_s` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT de la tabla `taxonomia`
--
ALTER TABLE `taxonomia`
MODIFY `id_t` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anunciante`
--
ALTER TABLE `anunciante`
ADD CONSTRAINT `anunciante_ibfk_1` FOREIGN KEY (`nick`) REFERENCES `usuarios` (`nick`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentar_actividad`
--
ALTER TABLE `comentar_actividad`
ADD CONSTRAINT `comentar_actividad_ibfk_1` FOREIGN KEY (`nick`) REFERENCES `usuarios` (`nick`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `comentar_actividad_ibfk_2` FOREIGN KEY (`id_a`) REFERENCES `actividades` (`id_a`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentar_anuncio`
--
ALTER TABLE `comentar_anuncio`
ADD CONSTRAINT `comentar_anuncio_ibfk_1` FOREIGN KEY (`nick`) REFERENCES `usuarios` (`nick`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `comentar_anuncio_ibfk_2` FOREIGN KEY (`id_an`) REFERENCES `anuncios` (`id_an`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `participar_actividad`
--
ALTER TABLE `participar_actividad`
ADD CONSTRAINT `participar_actividad_ibfk_1` FOREIGN KEY (`nick`) REFERENCES `usuarios` (`nick`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `participar_actividad_ibfk_2` FOREIGN KEY (`id_a`) REFERENCES `actividades` (`id_a`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pertenecer_grupo`
--
ALTER TABLE `pertenecer_grupo`
ADD CONSTRAINT `pertenecer_grupo_ibfk_1` FOREIGN KEY (`nick`) REFERENCES `usuarios` (`nick`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `pertenecer_grupo_ibfk_2` FOREIGN KEY (`id_g`) REFERENCES `grupos` (`id_g`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `publica_anuncio`
--
ALTER TABLE `publica_anuncio`
ADD CONSTRAINT `publica_anuncio_ibfk_1` FOREIGN KEY (`nick`) REFERENCES `anunciante` (`nick`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `publica_anuncio_ibfk_2` FOREIGN KEY (`id_an`) REFERENCES `anuncios` (`id_an`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `relacion_taxonomia`
--
ALTER TABLE `relacion_taxonomia`
ADD CONSTRAINT `relacion_taxonomia_ibfk_1` FOREIGN KEY (`id_t`) REFERENCES `taxonomia` (`id_t`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `relacion_taxonomia_ibfk_2` FOREIGN KEY (`id_s`) REFERENCES `subtaxonomia` (`id_s`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
