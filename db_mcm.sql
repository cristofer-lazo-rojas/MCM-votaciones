-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 18-04-2014 a las 18:36:01
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `db_mcm`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `candidato`
--

CREATE TABLE IF NOT EXISTS `candidato` (
  `i_candidato_id` int(11) NOT NULL AUTO_INCREMENT,
  `i_evento_id` int(11) NOT NULL,
  `v_candidato_nombre` varchar(60) NOT NULL,
  `v_candidato_ruta_imagen` varchar(250) NOT NULL,
  `i_candidato_estado` int(11) NOT NULL,
  PRIMARY KEY (`i_candidato_id`),
  KEY `i_evento_id` (`i_evento_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `candidato`
--

INSERT INTO `candidato` (`i_candidato_id`, `i_evento_id`, `v_candidato_nombre`, `v_candidato_ruta_imagen`, `i_candidato_estado`) VALUES
(1, 1, 'Nadine Heredia', 'nadine.jpg', 1),
(2, 1, 'Alejandro Toledo', 'toledo.jpg', 1),
(3, 1, 'Alan Garcia', 'alan.jpg', 1),
(4, 1, 'Keiko Fujimori', 'keiko.jpg', 1),
(5, 2, 'Barcelona', 'barcelona.jpg', 1),
(6, 2, 'Real Madrid', 'real-madrid.jpg', 1),
(7, 3, 'SCRUM', 'scrum.jpg', 1),
(8, 3, 'RUP', 'rup.jpg', 1),
(9, 3, 'XP', 'xp.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `i_categoria_id` int(11) NOT NULL AUTO_INCREMENT,
  `v_categoria_descripcion` varchar(20) NOT NULL,
  `d_categoria_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `i_categoria_estado` int(11) NOT NULL,
  PRIMARY KEY (`i_categoria_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`i_categoria_id`, `v_categoria_descripcion`, `d_categoria_creacion`, `i_categoria_estado`) VALUES
(1, 'elecciones', '2014-03-03 05:00:00', 1),
(2, 'celebridades', '2014-03-03 08:28:04', 1),
(3, 'empresas', '2014-03-03 05:00:00', 1),
(4, 'deportes', '2014-03-03 05:00:00', 1),
(5, 'tecnología', '2014-03-03 05:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credenciales`
--

CREATE TABLE IF NOT EXISTS `credenciales` (
  `i_credenciales_id` int(11) NOT NULL AUTO_INCREMENT,
  `i_usuario_id` int(11) NOT NULL,
  `v_credenciales_email` varchar(50) NOT NULL,
  `v_credenciales_password` varchar(64) NOT NULL,
  `i_credenciales_estado` int(11) NOT NULL,
  `d_credenciales_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`i_credenciales_id`),
  KEY `i_usuario_id` (`i_usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `credenciales`
--

INSERT INTO `credenciales` (`i_credenciales_id`, `i_usuario_id`, `v_credenciales_email`, `v_credenciales_password`, `i_credenciales_estado`, `d_credenciales_creacion`) VALUES
(1, 1, 'cristofer@gmail.com', '$2y$10$wMXimzf0adX7AWA/HCHjgeWYJ8A2i/VJ1ISthDXMnmxTuk4BFDU4S', 1, '2014-03-09 15:31:03'),
(2, 2, 'richard@gmail.com', '$2y$10$wMXimzf0adX7AWA/HCHjgeWYJ8A2i/VJ1ISthDXMnmxTuk4BFDU4S', 1, '2014-03-09 15:31:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE IF NOT EXISTS `evento` (
  `i_evento_id` int(11) NOT NULL AUTO_INCREMENT,
  `i_usuario_id` int(11) NOT NULL,
  `i_categoria_id` int(11) NOT NULL,
  `v_evento_titulo` varchar(100) NOT NULL,
  `v_evento_descripcion` varchar(250) NOT NULL,
  `d_evento_inicio` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `d_evento_fin` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `d_evento_creacion` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `i_evento_estado` int(11) NOT NULL,
  `i_evento_privacidad` int(11) NOT NULL,
  `v_evento_identificador` varchar(30) NOT NULL,
  `i_evento_check` int(11) NOT NULL,
  PRIMARY KEY (`i_evento_id`),
  KEY `i_usuario_id` (`i_usuario_id`),
  KEY `i_categoria_id` (`i_categoria_id`),
  KEY `i_usuario_id_2` (`i_usuario_id`),
  KEY `i_categoria_id_2` (`i_categoria_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `evento`
--

INSERT INTO `evento` (`i_evento_id`, `i_usuario_id`, `i_categoria_id`, `v_evento_titulo`, `v_evento_descripcion`, `d_evento_inicio`, `d_evento_fin`, `d_evento_creacion`, `i_evento_estado`, `i_evento_privacidad`, `v_evento_identificador`, `i_evento_check`) VALUES
(1, 1, 1, 'Elecciones Presidenciales del Perú 2016', 'Esta es un simulacro del las preferencias del pueblo peruano con respecto a los candidatos a la presidencia del Perú', '2014-03-03 05:00:00', '2014-12-31 05:00:00', '2014-03-03 05:00:00', 1, 0, 'EVENT0001', 0),
(2, 2, 4, 'El mejor Equipo de la Liga Española en el 2014', 'Test de preferencia de los club mas famosos de la Liga Española en el año 2014.', '2014-03-03 09:03:56', '2015-01-01 04:59:59', '2014-03-03 05:00:00', 1, 0, 'EVENT0002', 0),
(3, 1, 5, 'Que tecnología te pareció mas interesante en Ingeniería de Software', 'De las tecnologías que se enseñaron en el curso de Ingeniería de Software, a tu parecer es el más interesante.', '2014-03-03 09:17:08', '2015-01-01 04:59:59', '2014-03-03 05:00:00', 1, 1, 'EVENT0003', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotousuario`
--

CREATE TABLE IF NOT EXISTS `fotousuario` (
  `i_fotousuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `i_usuario_id` int(11) NOT NULL,
  `v_fotousuario_archivo` varchar(50) NOT NULL,
  `i_fotousuario_estado` int(11) NOT NULL,
  `d_fotousuario_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`i_fotousuario_id`),
  KEY `i_usuario_id` (`i_usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invitacion`
--

CREATE TABLE IF NOT EXISTS `invitacion` (
  `i_invitacion_id` int(11) NOT NULL AUTO_INCREMENT,
  `i_evento_id` int(11) NOT NULL,
  `v_invitacion_email` varchar(50) NOT NULL,
  `d_invitacion_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`i_invitacion_id`),
  KEY `i_evento_id` (`i_evento_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `invitacion`
--

INSERT INTO `invitacion` (`i_invitacion_id`, `i_evento_id`, `v_invitacion_email`, `d_invitacion_creacion`) VALUES
(1, 3, 'richard@gmail.com', '2014-03-03 05:00:00'),
(2, 3, 'dennis@gmail.com', '2014-03-03 05:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE IF NOT EXISTS `mensaje` (
  `i_mensaje_id` int(11) NOT NULL AUTO_INCREMENT,
  `i_evento_id` int(11) NOT NULL,
  `i_usuario_id` int(11) NOT NULL,
  `t_mensaje_texto` text NOT NULL,
  `d_mensaje_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `i_mensaje_estado` int(11) NOT NULL,
  PRIMARY KEY (`i_mensaje_id`),
  KEY `i_evento_id` (`i_evento_id`),
  KEY `i_usuario_id` (`i_usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `mensaje`
--

INSERT INTO `mensaje` (`i_mensaje_id`, `i_evento_id`, `i_usuario_id`, `t_mensaje_texto`, `d_mensaje_creacion`, `i_mensaje_estado`) VALUES
(1, 1, 1, 'hellow', '2014-02-03 20:01:08', 1),
(2, 1, 1, 'hello world', '2014-02-02 04:23:36', 1),
(3, 1, 1, 'please', '2014-02-02 04:23:44', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `i_usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `v_usuario_nombre` varchar(50) NOT NULL,
  `v_usuario_apellidos` varchar(50) NOT NULL,
  `v_usuario_imagen` varchar(100) DEFAULT NULL,
  `i_usuario_estado` int(11) NOT NULL,
  `d_usuario_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `i_usuario_admin` int(11) NOT NULL,
  PRIMARY KEY (`i_usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`i_usuario_id`, `v_usuario_nombre`, `v_usuario_apellidos`, `v_usuario_imagen`, `i_usuario_estado`, `d_usuario_creacion`, `i_usuario_admin`) VALUES
(1, 'CRISTOFER', 'LAZO ROJAS', '', 1, '2014-03-03 05:00:00', 1),
(2, 'RICHARD', 'LAZO ROJAS', '', 1, '2014-03-03 05:00:00', 0);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_evento`
--
CREATE TABLE IF NOT EXISTS `view_evento` (
`i_evento_id` int(11)
,`v_evento_titulo` varchar(100)
,`v_evento_descripcion` varchar(250)
,`d_evento_inicio` timestamp
,`d_evento_fin` timestamp
,`i_evento_privacidad` int(11)
,`v_evento_identificador` varchar(30)
,`i_categoria_id` int(11)
,`v_categoria_descripcion` varchar(20)
,`i_usuario_id` int(11)
,`v_usuario_nombre` varchar(50)
,`v_usuario_apellidos` varchar(50)
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_mensajes`
--
CREATE TABLE IF NOT EXISTS `view_mensajes` (
`msgid` int(11)
,`eventId` int(11)
,`userId` int(11)
,`avatar` varchar(100)
,`editor` varchar(101)
,`msg` text
,`fecha` timestamp
);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `voto`
--

CREATE TABLE IF NOT EXISTS `voto` (
  `i_voto_id` int(11) NOT NULL AUTO_INCREMENT,
  `i_usuario_id` int(11) NOT NULL,
  `i_candidato_id` int(11) NOT NULL,
  `d_voto_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`i_voto_id`,`i_usuario_id`,`i_candidato_id`),
  KEY `i_usuario_id` (`i_usuario_id`),
  KEY `i_candidato_id` (`i_candidato_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_evento`
--
DROP TABLE IF EXISTS `view_evento`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_evento` AS select `ev`.`i_evento_id` AS `i_evento_id`,`ev`.`v_evento_titulo` AS `v_evento_titulo`,`ev`.`v_evento_descripcion` AS `v_evento_descripcion`,`ev`.`d_evento_inicio` AS `d_evento_inicio`,`ev`.`d_evento_fin` AS `d_evento_fin`,`ev`.`i_evento_privacidad` AS `i_evento_privacidad`,`ev`.`v_evento_identificador` AS `v_evento_identificador`,`cat`.`i_categoria_id` AS `i_categoria_id`,`cat`.`v_categoria_descripcion` AS `v_categoria_descripcion`,`usu`.`i_usuario_id` AS `i_usuario_id`,`usu`.`v_usuario_nombre` AS `v_usuario_nombre`,`usu`.`v_usuario_apellidos` AS `v_usuario_apellidos` from ((`evento` `ev` join `categoria` `cat`) join `usuario` `usu`) where ((`ev`.`i_categoria_id` = `cat`.`i_categoria_id`) and (`ev`.`i_usuario_id` = `usu`.`i_usuario_id`) and (`ev`.`i_evento_estado` = '1'));

-- --------------------------------------------------------

--
-- Estructura para la vista `view_mensajes`
--
DROP TABLE IF EXISTS `view_mensajes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_mensajes` AS select `m`.`i_mensaje_id` AS `msgid`,`e`.`i_evento_id` AS `eventId`,`u`.`i_usuario_id` AS `userId`,`u`.`v_usuario_imagen` AS `avatar`,concat(`u`.`v_usuario_nombre`,' ',`u`.`v_usuario_apellidos`) AS `editor`,`m`.`t_mensaje_texto` AS `msg`,`m`.`d_mensaje_creacion` AS `fecha` from ((`mensaje` `m` join `usuario` `u`) join `evento` `e`) where ((`m`.`i_mensaje_estado` = '1') and (`m`.`i_evento_id` = `e`.`i_evento_id`) and (`m`.`i_usuario_id` = `u`.`i_usuario_id`)) order by `m`.`i_mensaje_id` desc;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `candidato`
--
ALTER TABLE `candidato`
  ADD CONSTRAINT `candidato_ibfk_1` FOREIGN KEY (`i_evento_id`) REFERENCES `evento` (`i_evento_id`);

--
-- Filtros para la tabla `credenciales`
--
ALTER TABLE `credenciales`
  ADD CONSTRAINT `credenciales_ibfk_1` FOREIGN KEY (`i_usuario_id`) REFERENCES `usuario` (`i_usuario_id`);

--
-- Filtros para la tabla `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `evento_ibfk_1` FOREIGN KEY (`i_usuario_id`) REFERENCES `usuario` (`i_usuario_id`),
  ADD CONSTRAINT `evento_ibfk_2` FOREIGN KEY (`i_categoria_id`) REFERENCES `categoria` (`i_categoria_id`);

--
-- Filtros para la tabla `fotousuario`
--
ALTER TABLE `fotousuario`
  ADD CONSTRAINT `fotousuario_ibfk_1` FOREIGN KEY (`i_usuario_id`) REFERENCES `usuario` (`i_usuario_id`);

--
-- Filtros para la tabla `invitacion`
--
ALTER TABLE `invitacion`
  ADD CONSTRAINT `invitacion_ibfk_1` FOREIGN KEY (`i_evento_id`) REFERENCES `evento` (`i_evento_id`);

--
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `mensaje_ibfk_1` FOREIGN KEY (`i_evento_id`) REFERENCES `evento` (`i_evento_id`),
  ADD CONSTRAINT `mensaje_ibfk_2` FOREIGN KEY (`i_usuario_id`) REFERENCES `usuario` (`i_usuario_id`);

--
-- Filtros para la tabla `voto`
--
ALTER TABLE `voto`
  ADD CONSTRAINT `voto_ibfk_1` FOREIGN KEY (`i_usuario_id`) REFERENCES `usuario` (`i_usuario_id`),
  ADD CONSTRAINT `voto_ibfk_2` FOREIGN KEY (`i_candidato_id`) REFERENCES `candidato` (`i_candidato_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
