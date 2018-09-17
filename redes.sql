-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 17-09-2018 a las 11:46:48
-- Versión del servidor: 5.7.21
-- Versión de PHP: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
CREATE DATABASE IF NOT EXISTS `redes` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

ALTER DATABASE `redes` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `redes`;
--
-- Base de datos: `redes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config`
--

DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
  `name` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

DROP TABLE IF EXISTS `documentos`;
CREATE TABLE IF NOT EXISTS `documentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `informe_evaluativo` set('Si','No') NOT NULL,
  `carta_buena_conducta` set('Si','No') NOT NULL,
  `cedula` set('Si','No') NOT NULL,
  `partida_nacimiento` set('Si','No') NOT NULL,
  `foto_alumno` set('Si','No') NOT NULL,
  `foto_representante` set('Si','No') NOT NULL,
  `niño_sano` set('Si','No') NOT NULL,
  `foto_madre` set('Si','No') NOT NULL,
  `foto_padre` set('Si','No') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

DROP TABLE IF EXISTS `estudiantes`;
CREATE TABLE IF NOT EXISTS `estudiantes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ci_escolar` varchar(30) DEFAULT NULL,
  `ci` varchar(10) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `edad` int(3) NOT NULL,
  `nacimiento` varchar(15) NOT NULL,
  `lugar_nacimiento` varchar(250) NOT NULL,
  `genero` set('F','M') NOT NULL,
  `direccion` varchar(250) NOT NULL,
  `id_salud` int(11) NOT NULL,
  `id_representante` int(100) NOT NULL,
  `id_madre` int(11) NOT NULL,
  `id_padre` int(11) NOT NULL,
  `id_familia` int(11) NOT NULL,
  `id_documentos` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familiares`
--

DROP TABLE IF EXISTS `familiares`;
CREATE TABLE IF NOT EXISTS `familiares` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `edad` int(3) NOT NULL,
  `sexo` varchar(2) NOT NULL,
  `ci` varchar(20) NOT NULL,
  `nacimiento` varchar(200) NOT NULL,
  `introduccion` varchar(50) NOT NULL,
  `ocupacion` varchar(50) NOT NULL,
  `trabajo` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `vive_estudiante` set('Si','No') NOT NULL,
  `parentesco` set('PADRE','MADRE') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matriculas`
--

DROP TABLE IF EXISTS `matriculas`;
CREATE TABLE IF NOT EXISTS `matriculas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` int(4) NOT NULL,
  `nota` varchar(1) NOT NULL,
  `turno` set('mañana','tarde') NOT NULL,
  `grado` int(1) NOT NULL,
  `seccion` varchar(2) DEFAULT NULL,
  `id_estudiante` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `representante`
--

DROP TABLE IF EXISTS `representante`;
CREATE TABLE IF NOT EXISTS `representante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `edad` int(11) NOT NULL,
  `sexo` set('M','F') NOT NULL,
  `ci` varchar(10) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `lugar_nacimiento` varchar(150) NOT NULL,
  `parentesco` varchar(30) NOT NULL,
  `ocupacion` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salud`
--

DROP TABLE IF EXISTS `salud`;
CREATE TABLE IF NOT EXISTS `salud` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tarjeta_vacuna` set('Si','No') NOT NULL,
  `enfermades_padece` varchar(200) NOT NULL,
  `operaciones` varchar(200) NOT NULL,
  `limitaciones_fisicas` varchar(200) NOT NULL,
  `deficiencia_visual` varchar(200) NOT NULL,
  `deficiencia_auditiva` varchar(200) NOT NULL,
  `alergias` varchar(200) NOT NULL,
  `enfermedades_padecidas` varchar(200) NOT NULL,
  `parto_fue` varchar(100) NOT NULL,
  `vacunas_recibidas` varchar(200) NOT NULL,
  `usa_lentes` set('Si','No') NOT NULL,
  `usa_protesis` set('Si','No') NOT NULL,
  `medicamentos_fiebre` varchar(200) NOT NULL,
  `estado_salud` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `situacion_familiar`
--

DROP TABLE IF EXISTS `situacion_familiar`;
CREATE TABLE IF NOT EXISTS `situacion_familiar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `n_habitantes` int(11) NOT NULL,
  `n_hermanos` int(11) NOT NULL,
  `lugar_hermanos` varchar(100) NOT NULL,
  `hermanos_plantel` tinyint(1) NOT NULL,
  `tipo_vivienda` varchar(200) NOT NULL,
  `distribucion_vivienda` varchar(200) NOT NULL,
  `condiciones` varchar(200) NOT NULL,
  `vive_con` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `apellido` varchar(200) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `rango` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `usuario`, `contrasena`, `rango`) VALUES
(1, 'Francisco', 'Ruiz', 'FRUIZ', '123', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
