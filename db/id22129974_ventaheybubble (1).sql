-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 26-05-2024 a las 14:01:18
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
-- Estructura de tabla para la tabla `articulo`
--

CREATE TABLE `articulo` (
  `id_articulo` int(11) NOT NULL,
  `nombre_articulo` varchar(50) NOT NULL,
  `cantidad_articulo` int(11) NOT NULL,
  `estado_articulo` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `articulo`
--

INSERT INTO `articulo` (`id_articulo`, `nombre_articulo`, `cantidad_articulo`, `estado_articulo`) VALUES
(1, 'LECHE', 29, 1),
(2, 'LECHE CONDENSADA', 5, 1),
(3, 'HARRY LIMONERO', 5, 1),
(4, 'VAINILLA LIQUIDA', 12, 1),
(5, 'MILSHAKE MORA', 3, 1),
(6, 'MILSHAKE FRUTILLA', 4, 1),
(7, 'MILSHAKE CHOCOLATE', 1, 1),
(8, 'MILSHAKE VAINILLA', 1, 1),
(9, 'MILSHAKE COCO', 3, 1),
(10, 'NECTAR MANGO', 4, 1),
(11, 'TARO MILK', 2, 1),
(12, 'CHICLE', 3, 1),
(13, 'DULCE DE LECHE', 7, 1),
(14, 'PAQUETES OREO', 7, 1),
(15, 'BOMBILLAS', 13, 1),
(16, 'VASOS 14', 3, 1),
(17, 'VASOS 20', 2, 1),
(18, 'MILSHAKE VAINILLA', 1, 0),
(19, 'AZUCAR', 0, 1);

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
(1, 'MORA', 0),
(2, 'TAPIOCA', 1),
(3, 'LITCHI', 1),
(4, 'MARACUYA', 1),
(5, 'UVA', 0),
(6, 'FRUTILLA', 1);

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
(80, 133, 1, 21, 14, 3, 1, 0),
(81, 134, 1, 1, 14, 5, 1, 0),
(81, 135, 1, 1, 16, 5, 2, 2),
(82, 136, 1, 5, 14, 5, 1, 0),
(83, 137, 1, 11, 16, 5, 2, 2),
(83, 138, 1, 5, 20, 5, 4, 0),
(84, 139, 1, 11, 16, 5, 2, 0),
(84, 140, 1, 8, 16, 5, 2, 0),
(85, 141, 1, 7, 20, 4, 4, 2),
(86, 142, 1, 5, 14, 4, 1, 0),
(87, 143, 1, 14, 14, 5, 1, 0),
(88, 144, 1, 11, 14, 5, 1, 0),
(89, 145, 1, 21, 26, 6, 3, 2),
(89, 146, 1, 21, 14, 6, 1, 0),
(90, 147, 1, 12, 14, 2, 1, 0),
(91, 148, 1, 10, 16, 6, 2, 0),
(92, 149, 1, 11, 16, 6, 2, 0),
(92, 150, 1, 14, 16, 6, 2, 0),
(93, 151, 1, 5, 14, 5, 1, 0),
(93, 152, 1, 5, 14, 5, 1, 0),
(94, 153, 2, 4, 14, 6, 1, 0),
(95, 154, 2, 12, 16, 2, 2, 0),
(96, 155, 2, 3, 14, 3, 1, 0),
(97, 156, 1, 1, 16, 2, 2, 0),
(98, 157, 1, 1, 14, 6, 1, 0),
(99, 158, 1, 1, 14, 6, 1, 0),
(100, 159, 1, 9, 20, 3, 4, 0),
(100, 160, 1, 4, 20, 3, 4, 0),
(101, 161, 1, 12, 14, 2, 1, 0),
(101, 162, 1, 13, 14, 5, 1, 0),
(102, 163, 1, 1, 20, 6, 4, 0),
(102, 164, 1, 12, 20, 2, 4, 0),
(103, 165, 1, 1, 16, 6, 2, 0),
(103, 166, 1, 5, 16, 6, 2, 0),
(104, 167, 2, 6, 16, 6, 2, 0),
(105, 168, 1, 11, 16, 5, 2, 0),
(105, 169, 1, 3, 16, 5, 2, 0),
(106, 170, 1, 5, 20, 3, 4, 0),
(107, 171, 1, 5, 20, 3, 4, 2),
(108, 172, 1, 14, 14, 6, 1, 0),
(108, 173, 1, 16, 14, 5, 1, 0),
(109, 174, 1, 16, 25, 5, 5, 0),
(110, 175, 1, 3, 20, 6, 4, 0),
(110, 176, 1, 7, 20, 3, 4, 0),
(111, 177, 1, 5, 14, 5, 1, 0),
(111, 178, 1, 1, 14, 5, 1, 0),
(112, 179, 1, 5, 16, 2, 2, 0),
(112, 180, 1, 12, 16, 2, 2, 0),
(113, 181, 1, 8, 20, 2, 4, 0),
(114, 182, 1, 26, 20, 3, 4, 0),
(115, 183, 1, 1, 14, 6, 1, 0),
(115, 184, 1, 3, 14, 5, 1, 0),
(116, 185, 2, 1, 14, 5, 1, 0),
(116, 186, 1, 1, 14, 6, 1, 0),
(117, 187, 1, 10, 20, 2, 4, 0),
(118, 188, 2, 5, 20, 6, 4, 2),
(119, 189, 1, 20, 16, 6, 2, 0),
(119, 190, 2, 27, 16, 6, 2, 0),
(120, 191, 1, 10, 16, 2, 2, 2),
(121, 192, 1, 9, 16, 5, 2, 2),
(122, 193, 1, 16, 14, 6, 1, 0),
(123, 194, 2, 1, 14, 3, 1, 0),
(123, 195, 1, 1, 14, 5, 1, 0),
(123, 196, 1, 1, 14, 6, 1, 0),
(123, 197, 1, 6, 14, 6, 1, 0),
(124, 198, 1, 1, 20, 6, 4, 2),
(125, 199, 1, 1, 14, 2, 1, 2),
(125, 200, 1, 1, 14, 5, 1, 2),
(126, 201, 1, 1, 16, 5, 2, 0),
(126, 202, 1, 9, 14, 3, 1, 0),
(127, 203, 1, 1, 16, 6, 2, 0),
(128, 204, 1, 18, 14, 6, 1, 0),
(128, 205, 1, 16, 14, 5, 1, 0),
(129, 206, 1, 1, 20, 6, 4, 0),
(130, 207, 1, 12, 14, 6, 1, 0),
(132, 208, 1, 1, 14, 6, 1, 0),
(133, 209, 1, 3, 16, 2, 2, 0),
(133, 210, 1, 1, 16, 5, 2, 0),
(133, 211, 1, 6, 14, 5, 1, 0),
(134, 212, 1, 1, 16, 5, 2, 0),
(135, 213, 1, 1, 20, 6, 4, 0),
(135, 214, 2, 10, 14, 6, 1, 0),
(136, 215, 2, 1, 16, 5, 2, 0),
(137, 216, 1, 13, 16, 5, 2, 0),
(137, 217, 1, 9, 16, 2, 2, 0),
(138, 218, 2, 11, 14, 2, 1, 0),
(139, 219, 2, 11, 20, 3, 4, 0),
(140, 220, 1, 1, 16, 6, 2, 2),
(141, 221, 2, 1, 14, 5, 1, 0),
(142, 222, 1, 21, 20, 3, 4, 0),
(143, 223, 1, 10, 16, 6, 2, 0),
(144, 224, 1, 23, 22, 2, 3, 2),
(144, 225, 1, 23, 20, 3, 4, 0),
(144, 226, 1, 5, 20, 6, 4, 0),
(144, 227, 1, 28, 16, 2, 2, 0),
(145, 228, 1, 28, 16, 5, 2, 0),
(145, 229, 1, 16, 16, 5, 2, 0),
(146, 230, 2, 23, 16, 6, 2, 2),
(147, 231, 1, 16, 14, 2, 1, 0),
(148, 232, 1, 1, 20, 6, 4, 0),
(148, 233, 1, 10, 20, 6, 4, 0),
(149, 234, 1, 28, 20, 6, 4, 0),
(150, 235, 1, 12, 16, 6, 2, 0),
(151, 236, 1, 17, 14, 3, 1, 0),
(152, 237, 1, 1, 16, 5, 2, 0),
(153, 238, 1, 28, 16, 6, 2, 0),
(154, 239, 2, 1, 14, 6, 1, 0),
(155, 240, 1, 28, 16, 6, 2, 0),
(156, 241, 2, 1, 14, 5, 1, 0),
(157, 242, 1, 1, 16, 5, 2, 0),
(158, 243, 1, 6, 16, 5, 2, 2),
(159, 244, 1, 8, 14, 5, 1, 0),
(160, 245, 1, 10, 20, 6, 4, 0),
(160, 246, 1, 10, 20, 5, 4, 0),
(161, 247, 1, 1, 20, 2, 4, 0),
(162, 248, 1, 26, 14, 6, 1, 0),
(163, 249, 2, 1, 14, 6, 1, 0),
(164, 250, 1, 1, 22, 6, 3, 0),
(165, 251, 1, 26, 20, 6, 4, 0),
(165, 252, 1, 1, 20, 5, 4, 0),
(166, 253, 1, 1, 14, 6, 1, 0),
(167, 254, 1, 10, 14, 2, 1, 0),
(167, 255, 1, 10, 16, 2, 2, 0),
(168, 256, 1, 10, 20, 6, 4, 0),
(169, 257, 1, 17, 16, 5, 2, 0),
(170, 258, 1, 11, 20, 5, 4, 0),
(171, 259, 1, 14, 16, 6, 2, 0),
(171, 260, 1, 17, 16, 5, 2, 0),
(172, 261, 1, 12, 20, 2, 4, 0),
(173, 262, 1, 6, 16, 5, 2, 0),
(174, 263, 1, 17, 14, 6, 1, 0),
(174, 264, 1, 14, 14, 5, 1, 0),
(175, 265, 1, 1, 14, 5, 1, 2),
(175, 266, 1, 6, 14, 3, 1, 2),
(176, 267, 1, 10, 14, 6, 1, 0),
(176, 268, 1, 20, 17, 6, 1, 0),
(177, 269, 1, 6, 16, 5, 2, 0),
(177, 270, 1, 1, 16, 6, 2, 0),
(178, 271, 1, 9, 16, 6, 2, 0),
(179, 272, 1, 1, 22, 6, 3, 0),
(180, 273, 1, 1, 22, 6, 3, 0),
(181, 274, 2, 10, 14, 6, 1, 0),
(182, 275, 1, 1, 14, 6, 1, 0),
(183, 276, 1, 1, 14, 5, 1, 0),
(184, 277, 1, 9, 16, 5, 2, 2),
(185, 278, 1, 1, 16, 6, 2, 0),
(185, 279, 1, 6, 16, 6, 2, 0),
(186, 280, 1, 6, 14, 6, 1, 2),
(186, 281, 1, 28, 14, 6, 1, 2),
(186, 282, 2, 5, 14, 6, 1, 0),
(187, 283, 1, 1, 20, 6, 4, 0),
(188, 284, 1, 1, 25, 5, 5, 0),
(188, 285, 1, 7, 14, 6, 1, 0),
(188, 286, 1, 1, 14, 6, 1, 0),
(189, 287, 1, 17, 16, 4, 2, 0),
(190, 288, 1, 28, 20, 6, 4, 2),
(190, 289, 1, 1, 20, 6, 4, 2),
(191, 290, 1, 21, 14, 6, 1, 2),
(191, 291, 1, 21, 14, 6, 1, 2),
(192, 292, 1, 21, 14, 6, 1, 2),
(192, 293, 1, 21, 14, 6, 1, 2),
(193, 294, 1, 23, 14, 3, 1, 0),
(194, 295, 1, 2, 16, 6, 2, 2),
(195, 296, 1, 2, 20, 6, 4, 2),
(196, 297, 1, 1, 16, 6, 2, 0),
(196, 298, 1, 5, 16, 6, 2, 0),
(197, 299, 1, 1, 20, 6, 4, 0),
(197, 300, 1, 1, 16, 3, 2, 0),
(198, 301, 1, 1, 25, 6, 5, 0),
(199, 302, 1, 1, 20, 3, 4, 0),
(200, 303, 2, 1, 14, 6, 1, 0),
(201, 304, 2, 1, 14, 6, 1, 2),
(202, 305, 2, 2, 16, 6, 2, 0),
(202, 306, 1, 1, 14, 4, 1, 0),
(203, 307, 1, 10, 14, 6, 1, 0),
(204, 308, 1, 28, 14, 6, 1, 0),
(205, 309, 1, 11, 16, 4, 2, 0),
(206, 310, 1, 3, 20, 6, 4, 0),
(207, 311, 1, 14, 16, 4, 2, 0),
(207, 312, 1, 5, 16, 6, 2, 0),
(208, 313, 1, 6, 20, 6, 4, 0),
(209, 314, 1, 9, 16, 2, 2, 0),
(209, 315, 1, 6, 16, 2, 2, 0),
(210, 316, 1, 6, 20, 6, 4, 0),
(210, 317, 1, 1, 20, 6, 4, 0),
(211, 318, 1, 1, 20, 6, 4, 2),
(211, 319, 1, 6, 20, 6, 4, 2),
(212, 320, 2, 1, 14, 2, 1, 0),
(212, 321, 1, 1, 16, 2, 2, 0),
(213, 322, 1, 17, 20, 6, 4, 0),
(214, 323, 2, 28, 14, 6, 1, 0);

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
(2, 'MILSHAKE FRUTILLA', 1),
(3, 'COTTON CANDY', 1),
(4, 'MILSHAKE COFRU', 1),
(5, 'MILSHAKE FRAMBUESA', 1),
(6, 'COOKIES&CREAM', 1),
(7, 'FLANCITO', 1),
(8, 'PIE LIMON', 1),
(9, 'VAINILLA', 1),
(10, 'CAPUCCINO', 1),
(11, 'CHOCOLATE', 1),
(12, 'COFFEE&CARAMEL', 1),
(13, 'DALGONA COFFE', 1),
(14, 'LIMONADA BUTTERFLY', 1),
(15, 'LIMONADA BUBBLEGUM', 1),
(16, 'LIMONADA BLUE SKY', 1),
(17, 'LIMONADA CHERRY', 1),
(18, 'LIMONADA PINK', 1),
(19, 'FRESH BERRIES', 1),
(20, 'MILSHAKE BERRIES', 1),
(21, 'BROWN SUGAR', 1),
(22, 'MATCHA', 0),
(23, 'TARO', 1),
(24, 'JAMAICA LATTE', 1),
(25, 'FRESH FRUTILLA', 1),
(26, 'FRESH MORA', 1),
(27, 'FRESH FRAMBUESA', 1),
(28, 'COFRÚ', 1);

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
(3, 22, 1),
(4, 20, 1),
(5, 25, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_venta` int(11) NOT NULL,
  `cliente_venta` varchar(100) NOT NULL,
  `total_venta` double DEFAULT 0,
  `total_venta_qr` double DEFAULT 0,
  `fecha_venta` datetime NOT NULL,
  `estado_venta` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id_venta`, `cliente_venta`, `total_venta`, `total_venta_qr`, `fecha_venta`, `estado_venta`) VALUES
(80, '', 14, 0, '2024-05-17 13:36:41', 0),
(81, '', 14, 16, '2024-05-17 15:14:33', 2),
(82, '', 14, 0, '2024-05-17 15:40:43', 2),
(83, '', 20, 16, '2024-05-17 15:43:28', 2),
(84, '', 32, 0, '2024-05-17 15:56:07', 2),
(85, '', 0, 20, '2024-05-17 16:05:49', 2),
(86, '', 14, 0, '2024-05-17 16:21:28', 2),
(87, '', 14, 0, '2024-05-17 16:22:16', 2),
(88, '', 14, 0, '2024-05-17 17:39:02', 2),
(89, '', 14, 26, '2024-05-17 17:52:36', 0),
(90, '', 14, 0, '2024-05-18 10:32:31', 0),
(91, '', 16, 0, '2024-05-18 15:12:40', 2),
(92, '', 32, 0, '2024-05-18 15:25:24', 2),
(93, '', 28, 0, '2024-05-18 15:27:28', 2),
(94, '', 28, 0, '2024-05-18 15:34:12', 2),
(95, '', 32, 0, '2024-05-18 15:43:00', 2),
(96, '', 28, 0, '2024-05-18 16:22:41', 2),
(97, '', 16, 0, '2024-05-18 16:33:10', 2),
(98, '', 14, 0, '2024-05-18 17:57:58', 2),
(99, '', 14, 0, '2024-05-18 18:18:40', 2),
(100, '', 40, 0, '2024-05-18 18:24:20', 2),
(101, '', 28, 0, '2024-05-18 18:54:12', 2),
(102, '', 40, 0, '2024-05-18 19:06:38', 2),
(103, '', 32, 0, '2024-05-18 19:20:22', 2),
(104, '', 32, 0, '2024-05-18 19:42:40', 2),
(105, '', 32, 0, '2024-05-18 20:12:32', 2),
(106, '', 20, 0, '2024-05-19 14:38:32', 0),
(107, '', 0, 20, '2024-05-19 14:39:23', 2),
(108, '', 28, 0, '2024-05-19 15:40:30', 2),
(109, '', 25, 0, '2024-05-19 16:05:50', 2),
(110, '', 40, 0, '2024-05-19 16:13:33', 2),
(111, '', 28, 0, '2024-05-19 16:29:37', 2),
(112, '', 32, 0, '2024-05-19 16:37:52', 2),
(113, '', 20, 0, '2024-05-19 16:52:37', 2),
(114, '', 20, 0, '2024-05-19 16:53:28', 2),
(115, '', 28, 0, '2024-05-19 17:05:04', 2),
(116, '', 42, 0, '2024-05-19 17:31:52', 2),
(117, '', 20, 0, '2024-05-19 17:34:07', 2),
(118, '', 0, 40, '2024-05-19 18:01:54', 2),
(119, '', 48, 0, '2024-05-19 18:02:54', 2),
(120, 'PedidosYa', 0, 16, '2024-05-19 18:19:18', 2),
(121, '', 0, 16, '2024-05-20 11:50:49', 2),
(122, '', 14, 0, '2024-05-20 15:58:16', 2),
(123, '', 70, 0, '2024-05-20 16:23:04', 2),
(124, '', 0, 20, '2024-05-20 16:34:39', 2),
(125, '', 0, 28, '2024-05-20 16:45:42', 2),
(126, '', 30, 0, '2024-05-20 17:03:28', 2),
(127, '', 16, 0, '2024-05-20 17:04:56', 0),
(128, '', 28, 0, '2024-05-20 17:15:13', 2),
(129, '', 20, 0, '2024-05-20 17:22:34', 2),
(130, '', 14, 0, '2024-05-20 17:57:46', 2),
(131, 'Alejt', 0, 0, '2024-05-20 18:01:00', 1),
(132, 'Ale', 14, 0, '2024-05-20 18:01:54', 2),
(133, '', 46, 0, '2024-05-20 18:15:34', 2),
(134, '', 16, 0, '2024-05-20 18:25:53', 2),
(135, '', 48, 0, '2024-05-20 18:57:11', 2),
(136, '', 32, 0, '2024-05-20 19:00:41', 2),
(137, '', 32, 0, '2024-05-20 19:47:43', 2),
(138, '', 28, 0, '2024-05-20 19:51:16', 2),
(139, '', 40, 0, '2024-05-21 11:26:27', 2),
(140, '', 0, 16, '2024-05-21 11:36:19', 2),
(141, '', 28, 0, '2024-05-21 12:26:23', 2),
(142, '', 20, 0, '2024-05-21 13:06:04', 2),
(143, '', 16, 0, '2024-05-21 15:21:04', 2),
(144, '', 56, 22, '2024-05-21 15:57:29', 2),
(145, '', 32, 0, '2024-05-21 15:58:44', 2),
(146, '', 0, 32, '2024-05-21 16:06:34', 2),
(147, '', 14, 0, '2024-05-21 16:19:48', 2),
(148, '', 40, 0, '2024-05-21 17:08:33', 2),
(149, '', 20, 0, '2024-05-21 18:15:16', 2),
(150, '', 16, 0, '2024-05-21 18:32:45', 2),
(151, '', 14, 0, '2024-05-21 18:33:51', 2),
(152, '', 16, 0, '2024-05-21 18:53:06', 2),
(153, '', 16, 0, '2024-05-21 18:54:31', 2),
(154, '', 28, 0, '2024-05-21 19:06:14', 2),
(155, '', 16, 0, '2024-05-21 19:06:34', 2),
(156, '', 28, 0, '2024-05-21 19:39:41', 2),
(157, '', 16, 0, '2024-05-22 10:08:45', 2),
(158, '', 0, 16, '2024-05-22 11:21:09', 2),
(159, '', 14, 0, '2024-05-22 11:27:24', 2),
(160, '', 40, 0, '2024-05-22 12:13:16', 2),
(161, '', 20, 0, '2024-05-22 16:38:50', 2),
(162, '', 14, 0, '2024-05-22 17:03:07', 2),
(163, '', 28, 0, '2024-05-22 17:20:15', 2),
(164, '', 22, 0, '2024-05-22 17:56:58', 2),
(165, '', 40, 0, '2024-05-22 18:02:20', 2),
(166, '', 14, 0, '2024-05-22 18:07:07', 2),
(167, '', 30, 0, '2024-05-22 18:30:37', 2),
(168, '', 20, 0, '2024-05-22 18:30:53', 2),
(169, '', 16, 0, '2024-05-22 18:42:31', 2),
(170, '', 20, 0, '2024-05-23 10:09:53', 2),
(171, '', 32, 0, '2024-05-23 12:14:07', 2),
(172, '', 20, 0, '2024-05-23 12:40:07', 2),
(173, '', 16, 0, '2024-05-23 16:14:23', 2),
(174, '', 28, 0, '2024-05-23 16:52:36', 2),
(175, '', 0, 28, '2024-05-23 17:00:09', 2),
(176, '', 31, 0, '2024-05-23 17:25:22', 2),
(177, '', 32, 0, '2024-05-23 17:50:11', 2),
(178, '', 0, 0, '2024-05-23 18:10:14', 2),
(179, '', 0, 0, '2024-05-23 18:14:15', 0),
(180, '', 22, 0, '2024-05-23 18:15:17', 2),
(181, '', 28, 0, '2024-05-23 18:19:18', 2),
(182, '', 14, 0, '2024-05-23 18:24:32', 2),
(183, '', 0, 0, '2024-05-23 18:30:21', 2),
(184, '', 0, 16, '2024-05-23 19:04:05', 2),
(185, '', 32, 0, '2024-05-23 20:54:59', 2),
(186, '', 28, 28, '2024-05-24 11:29:50', 2),
(187, '', 20, 0, '2024-05-24 15:40:37', 2),
(188, '', 53, 0, '2024-05-24 16:14:27', 2),
(189, '', 16, 0, '2024-05-24 16:37:56', 2),
(190, '', 0, 40, '2024-05-24 16:40:36', 2),
(191, '', 0, 28, '2024-05-24 16:55:54', 0),
(192, '', 0, 28, '2024-05-24 16:56:17', 0),
(193, '', 14, 0, '2024-05-24 17:18:24', 2),
(194, '', 0, 16, '2024-05-24 17:24:43', 0),
(195, '', 0, 20, '2024-05-24 17:25:03', 2),
(196, '', 32, 0, '2024-05-24 17:50:15', 2),
(197, '', 36, 0, '2024-05-24 18:20:46', 2),
(198, '', 25, 0, '2024-05-24 18:27:20', 2),
(199, '', 20, 0, '2024-05-24 18:30:33', 2),
(200, '', 28, 0, '2024-05-24 19:35:01', 0),
(201, '', 0, 28, '2024-05-24 20:26:04', 2),
(202, '', 46, 0, '2024-05-25 11:19:10', 2),
(203, '', 14, 0, '2024-05-25 11:19:27', 2),
(204, '', 14, 0, '2024-05-25 11:33:23', 2),
(205, '', 16, 0, '2024-05-25 11:47:51', 2),
(206, '', 20, 0, '2024-05-25 12:48:56', 2),
(207, '', 32, 0, '2024-05-25 12:49:25', 2),
(208, '', 20, 0, '2024-05-25 16:43:38', 2),
(209, '', 32, 0, '2024-05-25 16:50:47', 2),
(210, '', 40, 0, '2024-05-25 17:03:15', 0),
(211, '', 0, 40, '2024-05-25 17:03:40', 2),
(212, '', 44, 0, '2024-05-25 17:09:05', 2),
(213, '', 20, 0, '2024-05-25 17:23:07', 2),
(214, '', 28, 0, '2024-05-25 17:26:58', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD PRIMARY KEY (`id_articulo`);

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
-- AUTO_INCREMENT de la tabla `articulo`
--
ALTER TABLE `articulo`
  MODIFY `id_articulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `buba`
--
ALTER TABLE `buba`
  MODIFY `id_buba` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id_detalle_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=324;

--
-- AUTO_INCREMENT de la tabla `sabor`
--
ALTER TABLE `sabor`
  MODIFY `id_sabor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `tamanio`
--
ALTER TABLE `tamanio`
  MODIFY `id_tamanio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

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
