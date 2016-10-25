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
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`nick`, `password`, `fecha_nac`, `nombreCompleto`, `tipo`, `descripcion`, `avatar`, `ciudad`, `email`, `salt`) VALUES
('David', '$2y$10$vt57Wx9rT57em1sdYrerMOMO3YqQ9Exfas2IHyfJNX8.3cRyDQwSC', '0000-00-00', 'David.corp', 'anunciante', 'Vendemos para hacer dinero', './img/users/David.png', 'Barcelona', 'David@asdf.com', '$2y$10$vt57Wx9rT57em1sdYrerMU'),
('Federico', '$2y$10$9VDitKJRzc8LZwSGCv4NsuO0GzIGRdxJ4YfhCf8v7nlHt3a.opbje', '1989-05-04', 'Federico Ibáñez Moruno', 'admin', 'Wanna rumble in mah jungle?', './img/users/Federico.png', 'Madrid', 'Federico@asdf.asdf', '$2y$10$9VDitKJRzc8LZwSGCv4Nsy'),
('Gerardo', '$2y$10$zog6kN86Q6Vgfxyzh5Rig.AqEXV7opK52z1H0E4rG.a/QCuixcrqS', '1989-06-02', 'Gerardo David Reyes Diego', 'registrado', 'Así', './img/users/Gerardo.png', 'Madrid', 'Gerardo@asdf.asdf', '$2y$10$zog6kN86Q6Vgfxyzh5RigI'),
('Lidia', '$2y$10$aQ6SdYS56dTPdjwXruiV2uXe2eStz01zDJhwXDLhE2jlk5AZlYuRG', '1991-03-15', 'Lidia', 'registrado', 'Todos a trabajar!!', './img/users/Lidia.png', 'Paris', 'Lidia@asdf.com', '$2y$10$aQ6SdYS56dTPdjwXruiV22'),
('Miguel', '$2y$10$rMuBpjjhb3y6KphHjnIQEelrJPda2wIgLsdAH4gHJW6iFq38xj9A2', '1989-09-20', 'Miguel Mejía', 'registrado', 'Soy yo', './img/users/Miguel.png', 'Madrid', 'Miguel@asdf.com', '$2y$10$rMuBpjjhb3y6KphHjnIQEr'),
('Pablo', '$2y$10$Yu4hGdhnDVfi9U1amki6fO3M4onGfWm.GnU2z0xKOE8okglzVneSK', '1990-10-25', 'Pablo de la Oliva', 'registrado', 'Pablito', './img/users/Pablo.png', 'Madrid', 'Pablo@asdf.com', '$2y$10$Yu4hGdhnDVfi9U1amki6fV');


--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id_a`, `nombre`, `fecha_actividad`, `lugar`, `taxonomia`, `subtaxonomia`, `foto_principal`, `descripcion`, `id_g`) VALUES
(6, 'Caballero oscuro', '2015-06-30 00:00:00', 'Madrid', '', '', './img/activities/JeusMEmOePkakDm7NoVM.jpg', 'Vamos a ver El caballero oscuro a finales de este mes para celebrar las notas y tras aprobar AW!!', 4),
(7, 'Se abre.. Se cierra', '2015-06-30 10:00:00', 'Madrid', '', '', './img/activities/48ilWd2l80cYed8Hl4Gt.gif', 'Jejejeje', 6);

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `anunciante`
--

INSERT INTO `anunciante` (`nick`, `fecha_alta`, `cif`) VALUES
('David', '2015-06-12', '12345678');

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `anuncios`
--

INSERT INTO `anuncios` (`id_an`, `nombre`, `fecha_evento`, `lugar`, `descripcion`, `taxonomia`, `subtaxonomia`, `foto_principal`) VALUES
(4, 'Cerveza fresquita', '2015-06-30 00:00:00', 'España', 'Cervecita fresquita para toda España!', 'Ocio', 'Batman', './img/announcement/ZVgFJNgR2T.png'),
(5, 'Luigi el mejor', '2015-06-30 00:00:00', 'Madrid', 'Sin duda, mejor que su hermano...', 'Deportes', 'Baloncesto', './img/announcement/FXcdQagBBs.jpg'),
(6, 'Modelado 3D', '2015-06-30 09:00:00', 'Madrid', 'Te enseñamos a modelar en 3D', 'Ocio', 'Batman', './img/announcement/j7eIuC9eo7.jpg');

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `comentar_actividad`
--

INSERT INTO `comentar_actividad` (`id_ca`, `nick`, `id_a`, `comentario`, `fecha_comenta`) VALUES
(11, 'Miguel', 6, 'Vamos!! Apuntaros todos!!', '2015-06-12 13:21:19'),
(12, 'Lidia', 6, 'Jajaja cuenta conmigo!!!', '2015-06-12 13:21:42'),
(13, 'Pablo', 6, 'Venga, yo también iré!!', '2015-06-12 13:22:12'),
(14, 'Miguel', 7, 'Me encanta ese gif...', '2015-06-12 13:47:48');

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `publica_anuncio`
--

INSERT INTO `publica_anuncio` (`nick`, `id_an`, `fecha_publica`) VALUES
('David', 4, '0000-00-00'),
('David', 5, '0000-00-00'),
('David', 6, '0000-00-00');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `comentar_anuncio`
--

INSERT INTO `comentar_anuncio` (`id_can`, `nick`, `id_an`, `comentario`, `fecha_comenta`) VALUES
(6, 'David', 4, 'Mahou, Cruzcampo.. ¿Cuál preferís?', '2015-06-12 13:50:19'),
(7, 'David', 6, '¿Quien no quiere aprender a modelar en 3D?', '2015-06-21 13:35:59'),
(8, 'Gerardo', 6, 'Muy interesante.. Me apunto!', '2015-06-21 13:39:41'),
(9, 'David', 5, 'Luigi es el mejor, y siempre lo será¡', '2015-06-21 13:49:35'),
(10, 'Gerardo', 5, 'Pues yo no estoy de acuerdo, Mario es mejor!!', '2015-06-21 13:50:08');

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id_g`, `nombre`, `ciudad`, `privado`, `taxonomia`, `subtaxonomia`, `foto_principal`, `descripcion`) VALUES
(4, 'Fans de Batman!', 'Madrid', 'publico', 'Ocio', 'Batman', './img/groups/LblV6NHukpyt2Lfni4C8.png', 'Vamos a ver todas las pelis, no solo las de Nolan ;D'),
(5, 'Los McFlies', 'Madrid', 'publico', 'Deportes', 'Fútbol', './img/groups/J30fpUfFWoISqGePrw9Z.jpg', 'El grupo de los campeones!'),
(6, 'Spidetrónicos!', 'Madrid', 'privado', 'Ocio', 'Spiderman', './img/groups/PXZI9F01ZmYj4olGAB4H.jpg', '¿Nos gusta Spiderman?  SÃ­!'),
(7, 'Grupo cerrado', 'Madrid', 'privado', 'Ocio', 'Star', './img/groups/hkEtmq2ByeIb4BDMDRgw.jpg', 'Yo solo!');

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `participar_actividad`
--

INSERT INTO `participar_actividad` (`nick`, `id_a`, `es_admin`) VALUES
('Lidia', 6, 0),
('Miguel', 6, 1),
('Miguel', 7, 1),
('Pablo', 6, 0);

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `pertenecer_grupo`
--

INSERT INTO `pertenecer_grupo` (`nick`, `id_g`, `es_admin`) VALUES
('Gerardo', 5, 0),
('Lidia', 4, 1),
('Miguel', 4, 0),
('Miguel', 6, 1),
('Pablo', 4, 0),
('Pablo', 5, 1),
('Pablo', 7, 1);

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `subtaxonomia`
--

INSERT INTO `subtaxonomia` (`id_s`, `subtaxonomia`) VALUES
(1, 'Spiderman'),
(2, 'Star Wars'),
(3, 'Batman'),
(4, 'Fútbol'),
(5, 'Baloncesto'),
(6, 'Otros');

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `taxonomia`
--

INSERT INTO `taxonomia` (`id_t`, `taxo`) VALUES
(1, 'Ocio'),
(2, 'Deportes');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `relacion_taxonomia`
--

INSERT INTO `relacion_taxonomia` (`id_t`, `id_s`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 4),
(2, 5),
(1, 6);

-- --------------------------------------------------------





/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
