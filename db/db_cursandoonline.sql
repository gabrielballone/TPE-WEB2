-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-10-2020 a las 23:32:17
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_cursandoonline`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Informática', 'Cursos de ciencias de la información'),
(2, 'Cocina', 'Cursos con las mejores recetas'),
(3, 'Idiomas', 'Aprende nuevos idiomas'),
(5, 'Arte', 'Pintura, dibujo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `id` int(11) NOT NULL,
  `contenido` varchar(256) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `puntuacion` tinyint(4) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`id`, `contenido`, `fecha`, `puntuacion`, `id_usuario`, `id_curso`) VALUES
(4, 'un cambio', '2020-10-27 10:29:28', 1, 15, 8),
(5, 'un comentario', '2020-10-27 10:59:05', 2, 15, 8),
(10, 'un comentario', '2020-10-27 12:29:21', 1, 8, 8),
(11, 'un comentario', '2020-10-27 15:57:10', 1, 15, 8),
(12, 'otro cambio', '2020-10-27 18:20:07', 1, 15, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `duracion` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`id`, `nombre`, `descripcion`, `duracion`, `precio`, `id_categoria`) VALUES
(3, 'Java desde cero', 'La plataforma Java es el nombre de un entorno o plataforma de computación originaria de Sun Microsystems', 8, 1500, 1),
(4, 'C++', 'Curso del lenguaje c++', 4, 2500, 1),
(5, 'Github', 'Domina la tecnologia git', 2, 2800, 1),
(6, 'Ingles', 'Aprende idioma ingles', 6, 1450, 3),
(7, 'Frances', 'Aprende idioma frances', 6, 2480, 3),
(8, 'Dulces', 'Recetas dulces', 3, 1200, 2),
(9, 'Salados', 'Recetas saladas', 4, 2200, 2),
(11, 'Pintura', 'Pintura clasica', 4, 2600, 5),
(12, 'Dibujo', 'Dibujo clasico', 6, 2900, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `administrador` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `email`, `password`, `nombre`, `telefono`, `administrador`) VALUES
(8, 'ezequielcinalli96@gmail.com', '$2y$10$.QMZqwYeFAfzHe9w45FvoOe6cJKtQB3gPXyqPz5QFjcmwcGgvM526', 'ezequiel', '15151515', 1),
(12, 'noadmin@gmail.com', '$2y$10$W7UV7/a5fawn8Tn9FoFlfuAw6IEnRAMo1WJw9CVZLJXJfYwlWkCR6', 'noadminnn', '123', 0),
(15, 'gaballone@hotmail.com', '$2y$10$ngQI5chQR3M10NjceW5ayOXLO/S1FJEKgdjTtN9N8m4n1tUovhhIi', 'gabriel', '123', 1),
(16, 'gabriel@genosolutions.com.ar', '$2y$10$CW0JQrKNW8beXuHlrk.80OjfTYkzI3wNmILW6.R/8GJfw8h8e.oea', 'Gabriel', '123456', 0),
(17, 'gabrielgeno@gmail.com', '$2y$10$vfpJrkIh56Ni4XG1l4t0b.VU0gVtpUvtGrua0cQNZzgki6ow1qToO', 'Yo', '3245', 0),
(18, 'otro@nada.com.ar', '$2y$10$ju1i.XhbN6eclVWGIoICcufd7iz8VBktfUReHtcL9PE/Yndp6fRmy', '56465', '564', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id`);

--
-- Filtros para la tabla `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `curso_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
