-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 01-11-2024 a las 22:10:01
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `timesheet`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

DROP TABLE IF EXISTS `empleados`;
CREATE TABLE IF NOT EXISTS `empleados` (
  `ID_Empleado` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) DEFAULT NULL,
  `Apellido` varchar(100) DEFAULT NULL,
  `Correo` varchar(100) DEFAULT NULL,
  `Departamento` varchar(100) DEFAULT NULL,
  `Cargo` int NOT NULL,
  `password` varchar(100) NOT NULL,
  `proyecto` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_Empleado`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`ID_Empleado`, `Nombre`, `Apellido`, `Correo`, `Departamento`, `Cargo`, `password`, `proyecto`) VALUES
(5, 'Alex', 'morales', 'Alex.morales', '1', 1, 'alex1', '5'),
(6, 'Daniel', 'Daniel', 'Migueles', '1', 2, 'daniel1', '0'),
(1, 'Matias', 'Ibarra', 'Matias.ibarra', '1', 1, 'matias1', '0'),
(2, 'Jorge', 'Miranda', 'Jorge.miranda', '1', 2, 'jorge1', 'elefante'),
(3, 'Gonzalo', 'Benavente', 'gonzalo.benavente', '1', 1, 'gonzalo1', 'ronet'),
(4, 'Nicolas', 'Latino', 'nicolas.latino', '1', 1, 'nicolas1', '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horas`
--

DROP TABLE IF EXISTS `horas`;
CREATE TABLE IF NOT EXISTS `horas` (
  `id_hora` int NOT NULL AUTO_INCREMENT,
  `horastrabajadas` int NOT NULL,
  `Dia` date NOT NULL,
  `ID_Empleado` int NOT NULL,
  PRIMARY KEY (`id_hora`),
  KEY `Fk_idempleado` (`ID_Empleado`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `horas`
--

INSERT INTO `horas` (`id_hora`, `horastrabajadas`, `Dia`, `ID_Empleado`) VALUES
(1, 4, '2024-10-18', 0),
(2, 6, '2024-11-01', 5),
(3, 3, '2024-11-01', 5),
(4, 3, '2024-11-01', 5),
(5, 6, '2024-11-01', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

DROP TABLE IF EXISTS `proyectos`;
CREATE TABLE IF NOT EXISTS `proyectos` (
  `ID_Proyecto` int NOT NULL AUTO_INCREMENT,
  `Nombre_Proyecto` varchar(100) DEFAULT NULL,
  `Descripcion` text,
  `Fecha_Inicio` date DEFAULT NULL,
  `Fecha_Fin` date DEFAULT NULL,
  PRIMARY KEY (`ID_Proyecto`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`ID_Proyecto`, `Nombre_Proyecto`, `Descripcion`, `Fecha_Inicio`, `Fecha_Fin`) VALUES
(1, '5', '21321', '2024-11-01', NULL),
(2, 'ronet', 'pep', '2024-11-01', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
