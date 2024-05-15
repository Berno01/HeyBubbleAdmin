-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 15-05-2024 a las 16:20:44
-- Versión del servidor: 10.5.20-MariaDB
-- Versión de PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id22129974_ventaheybubble`
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
(25, 38, 1, 1, 18, 2, 3, 2),
(25, 39, 1, 2, 14, 2, 1, 0),
(26, 40, 1, 2, 14, 1, 1, 0),
(26, 41, 2, 2, 16, 2, 2, 2),
(27, 42, 1, 2, 18, 1, 3, 0),
(28, 43, 3, 2, 14, 2, 1, 0),
(28, 44, 1, 1, 16, 2, 2, 2),
(28, 45, 1, 2, 18, 1, 3, 1),
(29, 46, 3, 1, 14, 1, 1, 2),
(29, 47, 2, 1, 16, 1, 2, 1),
(29, 48, 6, 2, 18, 2, 3, 0);

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
  `total_venta_qr` double NOT NULL,
  `fecha_venta` datetime NOT NULL,
  `estado_venta` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id_venta`, `cliente_venta`, `total_venta`, `total_venta_qr`, `fecha_venta`, `estado_venta`) VALUES
(25, 'BernardoRuedaAvila', 14, 14, '2024-05-13 17:12:31', 2),
(26, 'Bernardo Rueda Florencio', 14, 32, '2024-05-15 11:19:38', 1),
(27, 'Bernardo Rueda Florencio', 0, 0, '2024-05-15 11:53:31', 1),
(28, 'Bernardo Ruedklk', -50, 34, '2024-05-15 12:05:16', 1),
(29, '', 108, 74, '2024-05-15 12:10:06', 1);

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
  MODIFY `id_detalle_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

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
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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
