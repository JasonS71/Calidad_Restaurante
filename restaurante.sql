-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-10-2024 a las 02:29:44
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
-- Base de datos: `restaurante`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `telefono` varchar(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `direccion` text NOT NULL,
  `mensaje` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `config`
--

INSERT INTO `config` (`id`, `nombre`, `telefono`, `email`, `direccion`, `mensaje`) VALUES
(1, 'Restaurante RestoBar', '957847894', 'restobar@gmail.com', 'Lima - Perú', 'Gracias por la compra');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedidos`
--

CREATE TABLE `detalle_pedidos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_pedidos`
--

INSERT INTO `detalle_pedidos` (`id`, `nombre`, `precio`, `cantidad`, `id_pedido`) VALUES
(1, 'AJI DE GALLINA', 10.00, 1, 1),
(2, 'CEBICHE', 25.00, 1, 1),
(3, 'ARROZ CON POLLO', 8.00, 3, 1),
(4, 'CEBICHE', 25.00, 1, 2),
(5, 'ARROZ CON POLLO', 8.00, 1, 2),
(6, 'AJI DE GALLINA', 10.00, 1, 3),
(7, 'CEBICHE', 25.00, 1, 4),
(8, 'Mondongo', 15.00, 1, 5),
(9, 'CEBICHE', 25.00, 1, 6),
(10, 'ARROZ CON POLLO122', 8.00, 4, 6),
(11, 'Mondongo', 15.00, 1, 6),
(12, 'Mondongo', 15.00, 1, 7),
(13, 'Mondongo', 15.00, 4, 8),
(14, 'AJI DE GALLINA', 10.00, 3, 8),
(15, 'CEBICHE', 25.00, 2, 8),
(16, 'ARROZ CON POLLO122', 8.00, 1, 8),
(17, 'AJI DE GALLINA', 10.00, 5, 9),
(18, 'CEBICHE', 25.00, 6, 9),
(19, 'test', 123.00, 4, 10),
(20, 'Whatever', 11.00, 4, 10),
(21, 'Mondongo', 15.00, 4, 10),
(22, 'Mondongo', 15.00, 6, 11),
(23, 'CEBICHE', 25.00, 7, 11),
(24, 'AJI DE GALLINA', 10.00, 8, 11),
(25, 'Et nostrum proident', 123.00, 1, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `id_sala` int(11) NOT NULL,
  `num_mesa` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total` decimal(10,2) NOT NULL,
  `observacion` text DEFAULT NULL,
  `estado` enum('PENDIENTE','FINALIZADO') NOT NULL DEFAULT 'PENDIENTE',
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_sala`, `num_mesa`, `fecha`, `total`, `observacion`, `estado`, `id_usuario`) VALUES
(1, 1, 1, '2023-05-25 20:03:27', 59.00, '', 'FINALIZADO', 1),
(2, 3, 3, '2023-05-25 20:03:43', 33.00, '', 'FINALIZADO', 1),
(3, 3, 5, '2023-05-25 20:04:17', 10.00, '', 'FINALIZADO', 1),
(4, 2, 10, '2024-09-25 12:12:28', 25.00, '', 'FINALIZADO', 1),
(5, 1, 1, '2024-09-25 12:11:53', 15.00, '', 'FINALIZADO', 5),
(6, 2, 3, '2024-10-09 02:53:31', 72.00, '', 'FINALIZADO', 1),
(7, 1, 2, '2024-10-09 02:53:20', 15.00, '', 'FINALIZADO', 5),
(8, 3, 1, '2024-10-09 02:53:59', 148.00, '', 'PENDIENTE', 1),
(9, 3, 2, '2024-10-09 02:54:28', 200.00, '', 'PENDIENTE', 1),
(10, 2, 2, '2024-10-09 02:58:36', 596.00, '', 'PENDIENTE', 1),
(11, 1, 3, '2024-10-09 11:25:07', 468.00, '', 'FINALIZADO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platos`
--

CREATE TABLE `platos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `descripcion` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `platos`
--

INSERT INTO `platos` (`id`, `nombre`, `precio`, `imagen`, `fecha`, `estado`, `descripcion`) VALUES
(1, 'AJI DE GALLINA', 10.00, '', NULL, 1, 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32'),
(2, 'CEBICHE', 25.00, '', NULL, 1, 'There are many variations of passages of Lorem Ipsum available'),
(3, 'ARROZ CON POLLO', 8.00, '', NULL, 1, 'Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia'),
(4, 'Mondongo', 15.00, '', NULL, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s'),
(5, 'Whatever', 11.00, '', NULL, 1, 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.'),
(6, 'test', 123.00, '', NULL, 1, 'testing'),
(7, 'Et nostrum proident', 123.00, '', NULL, 1, 'Consectetur exercita');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salas`
--

CREATE TABLE `salas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `mesas` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `salas`
--

INSERT INTO `salas` (`id`, `nombre`, `mesas`, `estado`) VALUES
(1, 'ENTRADA PRINCIPAL', 5, 1),
(2, 'SEGUNDO PISO', 10, 1),
(3, 'FRENTE COCINA', 8, 1),
(4, 'iohuibui', 9, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temp_pedidos`
--

CREATE TABLE `temp_pedidos` (
  `id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `temp_pedidos`
--

INSERT INTO `temp_pedidos` (`id`, `cantidad`, `precio`, `id_producto`, `id_usuario`) VALUES
(62, 5, 10.00, 1, 1),
(63, 6, 25.00, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `correo` varchar(200) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `rol` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `pass`, `rol`, `estado`) VALUES
(1, 'SISTEMAS FREE', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 1, 1),
(4, 'asdf', 'asdf@gmail.com', '912ec803b2ce49e4a541068d495ab570', 2, 1),
(5, 'qwer', 'qwer@gmail.com', '202cb962ac59075b964b07152d234b70', 3, 1),
(6, 'ytfvyt', 'bkhjb', '202cb962ac59075b964b07152d234b70', 3, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pedido` (`id_pedido`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sala` (`id_sala`);

--
-- Indices de la tabla `platos`
--
ALTER TABLE `platos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `salas`
--
ALTER TABLE `salas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `temp_pedidos`
--
ALTER TABLE `temp_pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `platos`
--
ALTER TABLE `platos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `salas`
--
ALTER TABLE `salas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `temp_pedidos`
--
ALTER TABLE `temp_pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  ADD CONSTRAINT `detalle_pedidos_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_sala`) REFERENCES `salas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
