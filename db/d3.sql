-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-04-2025 a las 15:06:45
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

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
  `nombre` varchar(100) DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `padre_id` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `foto`, `padre_id`, `email`, `descripcion`) VALUES
(1, 'Abuelo', NULL, NULL, 'peraza@hotmail.com', NULL),
(2, 'Padre', NULL, 1, 'peraza@hotmail2.com', NULL),
(3, 'Tío', NULL, 1, 'peraza3@hotmail.com', NULL),
(4, 'Yo', NULL, 2, 'peraza4@hotmail.com', NULL),
(5, 'Hermano', NULL, 2, 'peraza5@hotmail.com', NULL),
(6, 'Primo', NULL, 3, 'peraza6@hotmail.com', NULL),
(7, 'Primo Carlos', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d', 6, 'primo@uni.edu', 'Estudiante de medicina'),
(8, 'Abuela Rosa', 'https://images.unsplash.com/photo-1554080353-a576cf803bda', 2, NULL, 'Matriarca de la familia'),
(9, 'Sobrina Luisa', 'https://images.unsplash.com/photo-1544005313-94ddf0286df2', 6, NULL, 'Estudiante de secundaria'),
(10, 'Bisabuelo Manuel', 'https://images.unsplash.com/photo-1560250097-0b93528c311a', 1, NULL, 'Fundador del árbol familiar'),
(11, 'Tía Marta', 'https://images.unsplash.com/photo-1542103749-8ef59b94f47e', 3, 'tia@familia.com', 'Farmacéutica'),
(12, 'Hijo Adoptivo David', 'https://images.unsplash.com/photo-1566492031773-4f4e44671857', 2, 'david@mail.com', 'Adoptado en 2015'),
(13, 'Nieto Javier', 'https://images.unsplash.com/photo-1504593811423-6dd665756598', 4, 'jnieto@gmail.com', 'Primer nieto'),
(14, 'Sobrino Segundo', 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7', 6, 'sobrino2@work.com', 'Gerente regional'),
(15, 'Bisnieta Sofía', 'https://images.unsplash.com/photo-1485178575877-1a13bf489dfe', 13, NULL, 'La más pequeña'),
(16, 'Cuñado Roberto', 'https://images.unsplash.com/photo-1568602471122-7832951cc4c5', 8, 'roberto@empresa.com', 'Constructor'),
(17, 'Media Hermana Ana', 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2', 1, 'ana@example.com', 'Diseñadora gráfica'),
(18, 'Tío Abuelo Ernesto', 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde', 10, NULL, 'Veterano de guerra'),
(19, 'Prima Claudia', 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e', 18, 'claudia@lejana.com', 'Vive en el extranjero'),
(20, 'Ahijado Miguel', 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d', 2, 'miguel@escuela.edu', 'Ganador de olimpiadas matemáticas');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `personas`
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
