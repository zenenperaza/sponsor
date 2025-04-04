-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-04-2025 a las 18:11:44
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
  `id_usuario` text NOT NULL,
  `id_patrocinador` text NOT NULL,
  `padre_id` int(11) DEFAULT NULL,
  `perfil` text NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_encriptado` text NOT NULL,
  `password` text NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` text NOT NULL,
  `telefono` text NOT NULL,
  `foto` text DEFAULT NULL,
  `pais` text NOT NULL,
  `ciudad` text NOT NULL,
  `descripcion` text DEFAULT NULL,
  `verificacion` text NOT NULL,
  `last_login` date DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_update` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `id_usuario`, `id_patrocinador`, `padre_id`, `perfil`, `email`, `email_encriptado`, `password`, `nombre`, `apellido`, `telefono`, `foto`, `pais`, `ciudad`, `descripcion`, `verificacion`, `last_login`, `fecha_registro`, `fecha_update`) VALUES
(1, '', '', NULL, '', 'peraza1@outlook.com', '', '123456', 'Abuelo', '', '', NULL, '', '', NULL, '', NULL, '2025-04-03 15:11:18', ''),
(2, '', '', 1, '', 'peraza@hotmail2.com', '', '', 'Padre', '', '', NULL, '', '', NULL, '', NULL, '2025-04-01 13:36:58', ''),
(3, '', '', 1, '', 'peraza3@hotmail.com', '', '', 'Tío', '', '', NULL, '', '', NULL, '', NULL, '2025-04-01 13:36:58', ''),
(4, '', '', 2, '', 'peraza4@hotmail.com', '', '', 'Yo', '', '', NULL, '', '', NULL, '', NULL, '2025-04-01 13:36:58', ''),
(5, '', '', 2, '', 'peraza5@hotmail.com', '', '', 'Hermano', '', '', NULL, '', '', NULL, '', NULL, '2025-04-01 13:36:58', ''),
(6, '', '', 3, '', 'peraza6@hotmail.com', '', '', 'Primo', '', '', NULL, '', '', NULL, '', NULL, '2025-04-01 13:36:58', ''),
(7, '', '', 6, '', 'primo@uni.edu', '', '', 'Primo Carlos', '', '', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d', '', '', 'Estudiante de medicina', '', NULL, '2025-04-01 13:36:58', ''),
(8, '', '', 2, '', NULL, '', '', 'Abuela Rosa', '', '', 'https://images.unsplash.com/photo-1554080353-a576cf803bda', '', '', 'Matriarca de la familia', '', NULL, '2025-04-01 13:36:58', ''),
(9, '', '', 6, '', NULL, '', '', 'Sobrina Luisa', '', '', 'https://images.unsplash.com/photo-1544005313-94ddf0286df2', '', '', 'Estudiante de secundaria', '', NULL, '2025-04-01 13:36:58', ''),
(10, '', '', 1, '', NULL, '', '', 'Bisabuelo Manuel', '', '', 'https://images.unsplash.com/photo-1560250097-0b93528c311a', '', '', 'Fundador del árbol familiar', '', NULL, '2025-04-01 13:36:58', ''),
(11, '', '', 3, '', 'tia@familia.com', '', '', 'Tía Marta', '', '', 'https://images.unsplash.com/photo-1542103749-8ef59b94f47e', '', '', 'Farmacéutica', '', NULL, '2025-04-01 13:36:58', ''),
(12, '', '', 2, '', 'david@mail.com', '', '', 'Hijo Adoptivo David', '', '', 'https://images.unsplash.com/photo-1566492031773-4f4e44671857', '', '', 'Adoptado en 2015', '', NULL, '2025-04-01 13:36:58', ''),
(13, '', '', 4, '', 'jnieto@gmail.com', '', '', 'Nieto Javier', '', '', 'https://images.unsplash.com/photo-1504593811423-6dd665756598', '', '', 'Primer nieto', '', NULL, '2025-04-01 13:36:58', ''),
(14, '', '', 6, '', 'sobrino2@work.com', '', '', 'Sobrino Segundo', '', '', 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7', '', '', 'Gerente regional', '', NULL, '2025-04-01 13:36:58', ''),
(15, '', '', 13, '', NULL, '', '', 'Bisnieta Sofía', '', '', 'https://images.unsplash.com/photo-1485178575877-1a13bf489dfe', '', '', 'La más pequeña', '', NULL, '2025-04-01 13:36:58', ''),
(16, '', '', 8, '', 'roberto@empresa.com', '', '', 'Cuñado Roberto', '', '', 'https://images.unsplash.com/photo-1568602471122-7832951cc4c5', '', '', 'Constructor', '', NULL, '2025-04-01 13:36:58', ''),
(17, '', '', 1, '', 'ana@example.com', '', '', 'Media Hermana Ana', '', '', 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2', '', '', 'Diseñadora gráfica', '', NULL, '2025-04-01 13:36:58', ''),
(18, '', '', 10, '', NULL, '', '', 'Tío Abuelo Ernesto', '', '', 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde', '', '', 'Veterano de guerra', '', NULL, '2025-04-01 13:36:58', ''),
(19, '', '', 18, '', 'claudia@lejana.com', '', '', 'Prima Claudia', '', '', 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e', '', '', 'Vive en el extranjero', '', NULL, '2025-04-01 13:36:58', ''),
(20, '', '', 2, '', 'miguel@escuela.edu', '', '', 'Ahijado Miguel', '', '', 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d', '', '', 'Ganador de olimpiadas matemáticas', '', NULL, '2025-04-01 13:36:58', ''),
(22, '32KKAZ', '', NULL, '', 'peraza@outlook.com', 'cc39bc186c6dbff3d414bad151700230', '$2y$10$YDLlbHTyGja36dvqFb24aOm0Akl3A7tn2yHCjSqT8l4G58wEeonGe', 'Zenen', 'Peraza', '04245034999', NULL, 'Argentina', 'BARQUISIMETO', NULL, '0', NULL, '2025-04-03 15:17:18', '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
