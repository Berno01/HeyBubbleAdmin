-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-05-2024 a las 20:24:05
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tiendabuba`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `buba`
--

CREATE TABLE `buba` (
  `id_buba` int(11) NOT NULL,
  `nombre_buba` varchar(50) NOT NULL,
  `estado_buba` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `buba`
--

INSERT INTO `buba` (`id_buba`, `nombre_buba`, `estado_buba`) VALUES
(1, 'EXPLOSIVA MORA', 1),
(2, 'TAPIOCA', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id_venta` int(11) NOT NULL,
  `id_detalle_venta` int(11) NOT NULL,
  `cant_venta` int(11) NOT NULL,
  `id_sabor` int(11) NOT NULL,
  `precio_venta` double NOT NULL,
  `id_buba` int(11) NOT NULL,
  `id_tamanio` int(11) NOT NULL,
  `id_tipo_pago` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`id_venta`, `id_detalle_venta`, `cant_venta`, `id_sabor`, `precio_venta`, `id_buba`, `id_tamanio`, `id_tipo_pago`) VALUES
(1, 2, 2, 1, 32, 1, 1, 0),
(1, 3, 2, 1, 32, 2, 2, 2),
(2, 4, 1, 2, 14, 1, 2, 0),
(5, 5, 1, 2, 14, 1, 1, 0),
(6, 6, 3, 2, 16, 1, 2, 0),
(6, 7, 1, 2, 14, 2, 1, 0),
(8, 8, 1, 2, 14, 1, 1, 1),
(9, 9, 2, 2, 14, 1, 1, 0),
(10, 10, 1, 2, 14, 1, 1, 0),
(10, 11, 3, 1, 14, 1, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `id_tipo_pago` tinyint(4) NOT NULL,
  `nombre_tipo_pago` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pago`
--

INSERT INTO `pago` (`id_tipo_pago`, `nombre_tipo_pago`) VALUES
(0, 'EFECTIVO'),
(1, 'TARJETA'),
(2, 'QR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sabor`
--

CREATE TABLE `sabor` (
  `id_sabor` int(11) NOT NULL,
  `nombre_sabor` varchar(70) NOT NULL,
  `estado_sabor` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sabor`
--

INSERT INTO `sabor` (`id_sabor`, `nombre_sabor`, `estado_sabor`) VALUES
(1, 'MILSHAKE MORA', 1),
(2, 'MILSHAKE FRUTILLA', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tamanio`
--

CREATE TABLE `tamanio` (
  `id_tamanio` int(11) NOT NULL,
  `precio_tamanio` double NOT NULL,
  `estado_tamanio` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tamanio`
--

INSERT INTO `tamanio` (`id_tamanio`, `precio_tamanio`, `estado_tamanio`) VALUES
(1, 14, 1),
(2, 16, 1),
(3, 18, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_venta` int(11) NOT NULL,
  `cliente_venta` varchar(100) NOT NULL,
  `total_venta` double NOT NULL,
  `fecha_venta` datetime NOT NULL,
  `estado_venta` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id_venta`, `cliente_venta`, `total_venta`, `fecha_venta`, `estado_venta`) VALUES
(1, 'Berno', 16, '2024-04-03 11:09:37', 0),
(2, 'Juanito', 0, '2024-04-06 10:07:18', 1),
(4, 'pruebasql', 14, '2024-04-29 12:33:45', 1),
(5, 'pruebiña1', 14, '2024-04-30 10:22:47', 1),
(6, 'PruebaFinalpana', 62, '2024-04-30 10:25:36', 2),
(7, 'PruebaFinalpana', 16, '2024-05-05 13:48:57', 1),
(8, 'PruebaFinalpana', 14, '2024-05-05 13:56:46', 2),
(9, 'pruebiña', 28, '2024-05-05 13:58:49', 2),
(10, 'pruebiña', 56, '2024-05-05 13:59:09', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `buba`
--
ALTER TABLE `buba`
  ADD PRIMARY KEY (`id_buba`),
  ADD KEY `id_buba` (`id_buba`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id_detalle_venta`),
  ADD KEY `id_producto` (`id_sabor`),
  ADD KEY `id_buba` (`id_buba`),
  ADD KEY `id_tamaño` (`id_tamanio`),
  ADD KEY `id_venta` (`id_venta`),
  ADD KEY `id_tipo_pago` (`id_tipo_pago`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`id_tipo_pago`);

--
-- Indices de la tabla `sabor`
--
ALTER TABLE `sabor`
  ADD PRIMARY KEY (`id_sabor`);

--
-- Indices de la tabla `tamanio`
--
ALTER TABLE `tamanio`
  ADD PRIMARY KEY (`id_tamanio`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_venta` (`id_venta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `buba`
--
ALTER TABLE `buba`
  MODIFY `id_buba` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id_detalle_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `sabor`
--
ALTER TABLE `sabor`
  MODIFY `id_sabor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tamanio`
--
ALTER TABLE `tamanio`
  MODIFY `id_tamanio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `detalle_venta_ibfk_2` FOREIGN KEY (`id_buba`) REFERENCES `buba` (`id_buba`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_venta_ibfk_3` FOREIGN KEY (`id_sabor`) REFERENCES `sabor` (`id_sabor`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_venta_ibfk_4` FOREIGN KEY (`id_tamanio`) REFERENCES `tamanio` (`id_tamanio`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_venta_ibfk_5` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id_venta`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_venta_ibfk_6` FOREIGN KEY (`id_tipo_pago`) REFERENCES `pago` (`id_tipo_pago`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
