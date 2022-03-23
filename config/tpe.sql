-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-03-2022 a las 08:28:00
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tpe`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre`) VALUES
(1, 'Placa de video'),
(2, 'Monitores'),
(3, 'Teclados'),
(4, 'Mouse'),
(5, 'Almacenamiento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `comentario` varchar(400) NOT NULL,
  `puntaje` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_prod` int(11) NOT NULL,
  `fecha` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id`, `comentario`, `puntaje`, `id_user`, `id_prod`, `fecha`) VALUES
(4, 'La verdad que este producto esta muy pero que muy bueno eh, muy recomendable', 5, 29, 1, '2022-03-22 02:07:32'),
(10, 'awdwaawcxzczxczxzcxzcxweawawddascx waaeeaweawawewaedwa', 3, 27, 1, '2022-03-22 03:46:31'),
(33, 'comentario de prueba asdkladwka waeaieaweawekwaea dma,sdawda', 5, 27, 63, '2022-03-22 04:00:42'),
(34, 'comentario de prueba asdkladweaweadawwka waeaieaweawekwaea dma,sdawda', 2, 27, 63, '2022-03-22 04:00:44'),
(35, 'comentarizfsfsfesfo de prueba asdkladwka waeaieaweawekwaea dma,sdawda', 4, 27, 63, '2022-03-22 04:00:46'),
(36, 'comentario de prueba awawawawaawsdkladwka waeaieaweawekwaea dma,sdawda', 5, 27, 63, '2022-03-22 04:00:47'),
(38, 'waaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaf             wwwwwwwwwwwwwwwwww', 2, 27, 63, '2022-03-22 04:03:37'),
(39, 'ewadsdzzzzzzzzzzzzzdzdz vvvvvvvvveeeeeeeeeeeeeeeeeee', 4, 27, 63, '2022-03-22 04:03:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultas`
--

CREATE TABLE `consultas` (
  `id` int(11) NOT NULL,
  `consulta` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `precio` decimal(10,0) NOT NULL,
  `categoria` int(100) NOT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `descripcion`, `precio`, `categoria`, `img`) VALUES
(1, 'GTX 1080', 'PLACARDA', '54654', 1, NULL),
(2, 'RTX 3060', 'Placa de vido picada', '45456', 1, NULL),
(63, 'Montitor LG 22" FULL HD 1080', 'Monitor full HD de 22 pulgadas marca LG', '1522', 2, NULL),
(64, 'Teclado redragon kumara', 'Teclado mecanico marca redragon cherry blue', '1000', 3, NULL),
(65, 'RTX 2070', 'Placa marca Nvidia', '2101', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `rol_id` int(11) NOT NULL,
  `rol` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`rol_id`, `rol`) VALUES
(1, 'admin'),
(2, 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `user_id` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `passw` varchar(255) NOT NULL,
  `rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`user_id`, `usuario`, `email`, `passw`, `rol`) VALUES
(27, 'admin', 'admin@admin.com', '$2y$10$9aVENnz1cDEYr8nkAj.eXO5VblkYxK56bSQVoaLSStRE4Vu9.QK0K', 1),
(28, 'mauricio', 'maurigiaconia@hotmail.com', '$2y$10$ImujtY5em2L62JO1l0Dp4.IM1fmiSeWjvV2YR.TmpMFE.0qY2eYGG', 1),
(29, 'matias', 'matias@matias.com', '$2y$10$Poc/U0tm7JS6sUnxNg6gyeMWc1Lfc2ws1Xn9nUonDUmhaRkUl02NS', 2),
(31, 'pepe', 'pepe@pepe.com', '$2y$10$2O57ZrHCptwEi0e9J7b7NO7Qbsn8T1Mwl6zKD.989NflfXmlIsTGO', 2),
(32, 'raul', 'raul@raul.com', '$2y$10$fqMIjP.f.fZg.jkDfUquyOS6.mCQn0ZppEfk3cfMuD5URJFSksRQ.', 2),
(33, 'jorge', 'jorge@jorge.com', '$2y$10$cpVBmJaEXaTP1ggQFEJkkeFShyDABl8mNPgKnqSnQtwrF8m1qiJ7K', 1),
(34, 'pedro', 'pedro@pedro.com', '$2y$10$hNCI9MiH6NKQOqxeHvkaBeZu6xBgCttVr3bN3XCIIvjrEMARwEpIe', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comentarios_ibfk_1` (`id_user`),
  ADD KEY `comentarios_ibfk_2` (`id_prod`) USING BTREE;

--
-- Indices de la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`categoria`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `rol` (`rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `consultas`
--
ALTER TABLE `consultas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios` FOREIGN KEY (`id_prod`) REFERENCES `productos` (`id_producto`),
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`user_id`);

--
-- Filtros para la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD CONSTRAINT `consultas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`user_id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`id_categoria`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `roles` (`rol_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
