-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-04-2025 a las 00:38:17
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `d3`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `id_sistema` text NOT NULL,
  `padre_id` int(11) DEFAULT NULL,
  `id_patrocinador` text NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` text NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` text NOT NULL,
  `telefono` text NOT NULL,
  `pais` text NOT NULL,
  `ciudad` text NOT NULL,
  `foto` text DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `codigo_verificacion` text NOT NULL,
  `fecha_registro` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `fecha_update` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `id_sistema`, `padre_id`, `id_patrocinador`, `nombre`, `apellido`, `email`, `password`, `telefono`, `pais`, `ciudad`, `foto`, `descripcion`, `codigo_verificacion`, `fecha_registro`, `fecha_update`) VALUES
(1, '', NULL, '', 'Abuelo', '', 'peraza@hotmail.com', '', '', '', '', NULL, NULL, '', '0000-00-00 00:00:00', NULL),
(2, '', 1, '', 'Padre', '', 'peraza@hotmail2.com', '', '', '', '', NULL, NULL, '', '0000-00-00 00:00:00', NULL),
(3, '', 1, '', 'Tío', '', 'peraza3@hotmail.com', '', '', '', '', NULL, NULL, '', '0000-00-00 00:00:00', NULL),
(4, '', 2, '', 'Yo', '', 'peraza4@hotmail.com', '', '', '', '', NULL, NULL, '', '0000-00-00 00:00:00', NULL),
(5, '', 2, '', 'Hermano', '', 'peraza5@hotmail.com', '', '', '', '', NULL, NULL, '', '0000-00-00 00:00:00', NULL),
(6, '', 3, '', 'Primo', '', 'peraza6@hotmail.com', '', '', '', '', NULL, NULL, '', '0000-00-00 00:00:00', NULL),
(7, '', 6, '', 'Primo Carlos', '', 'primo@uni.edu', '', '', '', '', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d', 'Estudiante de medicina', '', '0000-00-00 00:00:00', NULL),
(8, '', 2, '', 'Abuela Rosa', '', NULL, '', '', '', '', 'https://images.unsplash.com/photo-1554080353-a576cf803bda', 'Matriarca de la familia', '', '0000-00-00 00:00:00', NULL),
(9, '', 6, '', 'Sobrina Luisa', '', NULL, '', '', '', '', 'https://images.unsplash.com/photo-1544005313-94ddf0286df2', 'Estudiante de secundaria', '', '0000-00-00 00:00:00', NULL),
(10, '', 1, '', 'Bisabuelo Manuel', '', NULL, '', '', '', '', 'https://images.unsplash.com/photo-1560250097-0b93528c311a', 'Fundador del árbol familiar', '', '0000-00-00 00:00:00', NULL),
(11, '', 3, '', 'Tía Marta', '', 'tia@familia.com', '', '', '', '', 'https://images.unsplash.com/photo-1542103749-8ef59b94f47e', 'Farmacéutica', '', '0000-00-00 00:00:00', NULL),
(12, '', 2, '', 'Hijo Adoptivo David', '', 'david@mail.com', '', '', '', '', 'https://images.unsplash.com/photo-1566492031773-4f4e44671857', 'Adoptado en 2015', '', '0000-00-00 00:00:00', NULL),
(13, '', 4, '', 'Nieto Javier', '', 'jnieto@gmail.com', '', '', '', '', 'https://images.unsplash.com/photo-1504593811423-6dd665756598', 'Primer nieto', '', '0000-00-00 00:00:00', NULL),
(14, '', 6, '', 'Sobrino Segundo', '', 'sobrino2@work.com', '', '', '', '', 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7', 'Gerente regional', '', '0000-00-00 00:00:00', NULL),
(15, '', 13, '', 'Bisnieta Sofía', '', NULL, '', '', '', '', 'https://images.unsplash.com/photo-1485178575877-1a13bf489dfe', 'La más pequeña', '', '0000-00-00 00:00:00', NULL),
(16, '', 8, '', 'Cuñado Roberto', '', 'roberto@empresa.com', '', '', '', '', 'https://images.unsplash.com/photo-1568602471122-7832951cc4c5', 'Constructor', '', '0000-00-00 00:00:00', NULL),
(17, '', 1, '', 'Media Hermana Ana', '', 'ana@example.com', '', '', '', '', 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2', 'Diseñadora gráfica', '', '0000-00-00 00:00:00', NULL),
(18, '', 10, '', 'Tío Abuelo Ernesto', '', NULL, '', '', '', '', 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde', 'Veterano de guerra', '', '0000-00-00 00:00:00', NULL),
(19, '', 18, '', 'Prima Claudia', '', 'claudia@lejana.com', '', '', '', '', 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e', 'Vive en el extranjero', '', '0000-00-00 00:00:00', NULL),
(20, '', 2, '', 'Ahijado Miguel', '', 'miguel@escuela.edu', '', '', '', '', 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d', 'Ganador de olimpiadas matemáticas', '', '0000-00-00 00:00:00', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `padre_id` (`padre_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`padre_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
