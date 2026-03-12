-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 12-03-2026 a las 14:02:24
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `direccion-genero`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adjuntos`
--

CREATE TABLE `adjuntos` (
  `id` bigint UNSIGNED NOT NULL,
  `entidad_tipo` varchar(50) NOT NULL,
  `entidad_id` bigint UNSIGNED NOT NULL,
  `nombre_original` varchar(255) NOT NULL,
  `nombre_guardado` varchar(255) NOT NULL,
  `ruta` varchar(500) NOT NULL,
  `tipo_mime` varchar(100) DEFAULT NULL,
  `tamaño` bigint DEFAULT NULL,
  `confidencial` tinyint(1) NOT NULL DEFAULT '0',
  `hash_sha256` varchar(64) DEFAULT NULL,
  `subido_por` bigint UNSIGNED NOT NULL,
  `eliminado_logico` tinyint(1) NOT NULL DEFAULT '0',
  `fecha_eliminacion` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `adjuntos`
--

INSERT INTO `adjuntos` (`id`, `entidad_tipo`, `entidad_id`, `nombre_original`, `nombre_guardado`, `ruta`, `tipo_mime`, `tamaño`, `confidencial`, `hash_sha256`, `subido_por`, `eliminado_logico`, `fecha_eliminacion`, `created_at`) VALUES
(21, 'intervencion_masculinidades', 17, 'doc.pdf', '69b0d488b7751_doc.pdf', 'adjuntos/intervenciones/69b0d488b7751_doc.pdf', 'application/pdf', 245594, 0, NULL, 1, 0, NULL, '2026-03-11 02:33:44'),
(22, 'intervencion_masculinidades', 18, 'Vilchez_Claudio_CV.pdf', '69b0d4974fa4a_Vilchez_Claudio_CV.pdf', 'adjuntos/intervenciones/69b0d4974fa4a_Vilchez_Claudio_CV.pdf', 'application/pdf', 107440, 0, NULL, 1, 0, NULL, '2026-03-11 02:33:59'),
(23, 'intervencion_masculinidades', 19, 'Vilchez_Claudio_CV.pdf', '69b0d61f477a7_Vilchez_Claudio_CV.pdf', 'adjuntos/intervenciones/69b0d61f477a7_Vilchez_Claudio_CV.pdf', 'application/pdf', 107440, 0, NULL, 1, 0, NULL, '2026-03-11 02:40:31'),
(24, 'intervencion_masculinidades', 16, 'comprobante_135280187433.pdf', '69b0d936ed85b_comprobante_135280187433.pdf', 'adjuntos/intervenciones/69b0d936ed85b_comprobante_135280187433.pdf', 'application/pdf', 8920, 0, NULL, 1, 0, NULL, '2026-03-11 02:53:42'),
(25, 'intervencion_masculinidades', 20, 'declaración.pdf', '69b0dc788a1b9_declaración.pdf', 'adjuntos/intervenciones/69b0dc788a1b9_declaración.pdf', 'application/pdf', 9784, 0, NULL, 1, 0, NULL, '2026-03-11 03:07:36'),
(26, 'masculinidades', 27, 'caso_masc_000027_8898.docx', 'caso_masc_000027_8898.docx', 'masculinidades_certificados/caso_masc_000027_8898.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 356, 0, '7afdfdac4ccd22b7869f5edce415c410df28975cccaf22b47b31b58bf5b49e82', 1, 0, NULL, '2026-03-11 21:44:18'),
(27, 'masculinidades', 28, 'caso_masc_000028_8898.docx', 'caso_masc_000028_8898.docx', 'masculinidades_certificados/caso_masc_000028_8898.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 356, 0, '5e46216a0b8f3aa5a3ceed61221449fbdbe1512e0f9d64e189d1006b9dca8314', 1, 0, NULL, '2026-03-11 21:45:13'),
(28, 'masculinidades', 29, 'caso_masc_000029_8898.docx', 'caso_masc_000029_8898.docx', 'masculinidades_certificados/caso_masc_000029_8898.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 356, 0, '670ea11d551e9661298ba1d2c1c0d8a4693c0f4243325aed80dd5c0e1d8345e2', 1, 0, NULL, '2026-03-11 22:03:50'),
(29, 'masculinidades', 30, 'caso_masc_000030_8898.docx', 'caso_masc_000030_8898.docx', 'masculinidades_certificados/caso_masc_000030_8898.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 356, 0, 'f1146d84fad4ad596d619e5f305c1fef951a0b5106f1e5113d5252cb244fb711', 1, 0, NULL, '2026-03-11 22:06:12'),
(30, 'masculinidades', 31, 'caso_masc_000031_41145735.docx', 'caso_masc_000031_41145735.docx', 'masculinidades_certificados/caso_masc_000031_41145735.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 12577, 0, '80c114f13330346b89ca166191a8018f3bf10577594760568bd4096c782c0fb2', 1, 0, NULL, '2026-03-12 01:12:30'),
(31, 'masculinidades', 32, 'caso_masc_000032_41145735.docx', 'caso_masc_000032_41145735.docx', 'masculinidades_certificados/caso_masc_000032_41145735.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 8439, 0, '1a05f002996f6cf9b4798a29b056ce0eb8ada8a7c1ecdc7ed5617e4f61bdda97', 1, 0, NULL, '2026-03-12 13:33:13'),
(32, 'masculinidades', 33, 'caso_masc_000033_41145735.docx', 'caso_masc_000033_41145735.docx', 'masculinidades_certificados/caso_masc_000033_41145735.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 8441, 0, '162428159286658d81db1222cbe3096536eb39dd1e58aad168afe3d38075efee', 1, 0, NULL, '2026-03-12 13:50:07'),
(33, 'masculinidades', 34, 'caso_masc_000034_41145735.docx', 'caso_masc_000034_41145735.docx', 'masculinidades_certificados/caso_masc_000034_41145735.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 8488, 0, 'aac63428405c1ff185516d08d37fb9e1fe5695325efdbe5b087335d55edf388f', 1, 0, NULL, '2026-03-12 13:52:50'),
(34, 'genero', 20, 'caso_genero_000020_666.docx', 'caso_genero_000020_666.docx', 'genero_certificados/caso_genero_000020_666.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 8377, 0, '515ae3e397cd0b9dfca0b3a91dd10cb885453a85c3ad5ab6d41bc34b606bdb7b', 1, 0, NULL, '2026-03-12 14:01:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adjuntos_descargas`
--

CREATE TABLE `adjuntos_descargas` (
  `id` bigint UNSIGNED NOT NULL,
  `adjunto_id` bigint UNSIGNED NOT NULL,
  `usuario_id` bigint UNSIGNED NOT NULL,
  `fecha_descarga` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `adjuntos_descargas`
--

INSERT INTO `adjuntos_descargas` (`id`, `adjunto_id`, `usuario_id`, `fecha_descarga`, `ip`) VALUES
(1, 22, 1, '2026-03-11 05:36:30', '127.0.0.1'),
(2, 22, 1, '2026-03-11 05:36:52', '127.0.0.1'),
(3, 21, 1, '2026-03-11 05:40:42', '127.0.0.1'),
(4, 25, 1, '2026-03-11 06:07:48', '127.0.0.1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'direccion_genero', '2026-02-26 21:20:54', '2026-02-26 21:20:54'),
(2, 'masculinidades', '2026-02-26 21:20:54', '2026-02-26 21:20:54'),
(3, 'ive', '2026-02-26 21:20:54', '2026-02-26 21:20:54'),
(4, 'admin', '2026-02-26 21:20:54', '2026-02-26 21:20:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area_user`
--

CREATE TABLE `area_user` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `area_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `area_user`
--

INSERT INTO `area_user` (`id`, `user_id`, `area_id`) VALUES
(6, 1, 1),
(7, 1, 2),
(9, 1, 4),
(10, 1, 3),
(15, 3, 1),
(17, 3, 3),
(18, 2, 1),
(19, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `barrio`
--

CREATE TABLE `barrio` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `localidad_id` bigint UNSIGNED NOT NULL,
  `zona_barrio_id` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `deleted_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `barrio`
--

INSERT INTO `barrio` (`id`, `nombre`, `localidad_id`, `zona_barrio_id`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Santa Teresita', 5, 1, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(2, 'Las Mellizas', 5, 1, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(3, 'Azopardo', 5, 1, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(4, 'Yaguaron', 5, 1, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(5, 'San Jorge', 5, 1, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(6, 'Castelli', 5, 1, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(7, 'San Martin', 5, 1, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(8, 'Suizo', 5, 1, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(9, 'Parque Norte', 5, 1, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(10, 'Parque Sarmiento', 5, 1, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(11, '25 de Mayo', 5, 1, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(12, 'Santa Clara', 5, 1, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(13, 'Moreno', 5, 1, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(14, 'Bola de Oro', 5, 1, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(15, 'San Cayetano', 5, 1, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(16, 'Prado Español', 5, 1, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(17, 'Alto Verde', 5, 1, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(18, 'San Pablo', 5, 1, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(19, 'La Loma', 5, 1, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(20, 'Guena', 5, 1, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(21, 'Asonia', 5, 1, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(22, 'Fraga', 5, 1, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(23, 'Martinez', 5, 1, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(24, 'Lares', 5, 1, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(25, 'Jose Ingenieros', 5, 1, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(27, 'Urquiza', 5, 2, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(28, 'Don Bosco', 5, 2, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(29, 'Obrero', 5, 2, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(30, 'Cavalli', 5, 2, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(31, 'Padre D´Amico', 5, 2, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(32, 'Química', 5, 2, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(33, 'Belgrano', 5, 2, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(34, 'San Isidro', 5, 2, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(35, 'Ponce de León', 5, 2, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(36, 'Saavedra', 5, 2, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(37, 'Los Fresnos', 5, 2, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(38, 'Alcoholera', 5, 2, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(39, 'Astul Urquiaga', 5, 2, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(40, 'Super Usina', 5, 2, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(41, 'Golf Club', 5, 2, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(42, 'Oeste', 5, 3, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(43, 'Lanza', 5, 3, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(44, 'Garetto', 5, 3, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(45, 'Evita', 5, 3, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(46, 'Santa Cecilia', 5, 3, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(47, 'Ginés García', 5, 3, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(48, 'ITEC', 5, 3, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(49, 'San Francisco', 5, 3, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(50, 'La Florida', 5, 3, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(51, 'General Mosconi', 5, 3, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(52, 'Mitre', 5, 3, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(53, 'Irigoyen', 5, 3, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(54, 'Villa María', 5, 3, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(55, 'Los Viñedos', 5, 3, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(57, 'Don Americo', 5, 3, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(58, 'Parque Córdoba', 5, 3, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(59, 'Colombo', 5, 3, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(60, 'Malvinas', 5, 3, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(61, 'Virgen del Rosario', 5, 3, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(62, 'Colombini', 5, 3, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(63, '21 de Septiembre', 5, 3, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(64, 'Las Viñas', 5, 3, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(65, 'Pezzi', 5, 3, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(66, 'Las Flores', 5, 2, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(67, 'Juan XXIII', 5, 2, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(68, 'Del Carmen', 5, 2, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(69, 'Primavera', 5, 2, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(70, 'Ponte', 5, 2, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(71, '17 de Octubre', 5, 2, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(72, 'Los Pinos', 5, 2, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(73, 'Savio', 5, 2, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(74, 'Santa Rosa', 5, 2, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(75, '9 de Julio', 5, 2, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(76, 'Virgen de Luján', 5, 2, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(77, 'Trípoli', 5, 2, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(78, 'California', 5, 2, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(79, 'Parque Avamba´e', 5, 2, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(80, 'Avamba´e', 5, 2, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(81, '7 de Septiembre', 5, 2, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(82, 'San Eduardo', 5, 2, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(83, 'Guemes', 5, 2, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(84, 'Plastiversal', 5, 2, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(85, 'Somisa', 5, 2, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(86, 'Sironi', 5, 2, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(87, 'Ayres del Sur', 5, 2, NULL, NULL, '2024-10-23 08:25:50', NULL, NULL),
(88, 'CENTRO', 5, 4, NULL, NULL, '2026-01-19 20:28:01', NULL, NULL),
(89, 'La Emilia', 5, 5, NULL, NULL, '2026-01-19 20:28:01', NULL, NULL),
(90, 'Villa Riccio', 5, 5, NULL, NULL, '2026-01-19 20:28:01', NULL, NULL),
(91, 'Villa Canto', 5, 5, NULL, NULL, '2026-01-19 20:28:01', NULL, NULL),
(92, 'Villa Campi', 5, 5, NULL, NULL, '2026-01-19 20:28:01', NULL, NULL),
(93, 'Campos Salles', 5, 5, NULL, NULL, '2026-01-19 20:28:01', NULL, NULL),
(94, 'General Rojo', 5, 5, NULL, NULL, '2026-01-19 20:28:01', NULL, NULL),
(95, 'Conesa', 5, 5, NULL, NULL, '2026-01-19 20:28:01', NULL, NULL),
(96, 'Erezcano', 5, 5, NULL, NULL, '2026-01-19 20:28:01', NULL, NULL),
(98, '14 de Abril', 5, 1, NULL, NULL, NULL, NULL, NULL),
(99, '12 de Marzo', 5, 3, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cud`
--

CREATE TABLE `cud` (
  `id` bigint UNSIGNED NOT NULL,
  `persona_id` bigint UNSIGNED NOT NULL,
  `tiene_cud` tinyint(1) NOT NULL DEFAULT '0',
  `numero_cud` varchar(100) DEFAULT NULL,
  `fecha_emision` date DEFAULT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `observaciones` text,
  `archivo_adjunto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cud`
--

INSERT INTO `cud` (`id`, `persona_id`, `tiene_cud`, `numero_cud`, `fecha_emision`, `fecha_vencimiento`, `observaciones`, `archivo_adjunto`, `created_at`, `updated_at`) VALUES
(1, 119, 1, '333', '2024-10-30', '2026-11-29', 'a', NULL, NULL, NULL),
(2, 120, 1, '66', '2023-10-30', '2026-10-30', 'a', 'cuds/EcnkkenEq7pdmFgYPHnefTBTNeHASxWPAt9EXxw6.pdf', NULL, NULL),
(3, 121, 1, '22`', '2024-10-29', '2025-10-29', 'a', NULL, NULL, NULL),
(4, 122, 1, '2111', '2026-03-05', '2026-03-20', 'DOWN', 'cuds/hCzRQweolWphPJBiHJe6gt4s0ETHOw2oexTCGM0n.pdf', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion_genero_casos`
--

CREATE TABLE `direccion_genero_casos` (
  `id` bigint UNSIGNED NOT NULL,
  `persona_id` bigint UNSIGNED NOT NULL,
  `estado_civil_id` bigint UNSIGNED DEFAULT NULL,
  `genero` varchar(100) DEFAULT NULL,
  `provincia_id` bigint UNSIGNED DEFAULT NULL,
  `localidad_id` bigint UNSIGNED DEFAULT NULL,
  `barrio_id` bigint UNSIGNED DEFAULT NULL,
  `situacion_habitacional_id` bigint UNSIGNED DEFAULT NULL,
  `nivel_estudio_id` bigint UNSIGNED DEFAULT NULL,
  `trabaja` tinyint(1) NOT NULL DEFAULT '0',
  `organizacion_social` tinyint(1) NOT NULL DEFAULT '0',
  `organizacion_social_detalle` varchar(255) DEFAULT NULL,
  `observaciones` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `estado_id` int UNSIGNED NOT NULL DEFAULT '1',
  `nivel_riesgo_id` int UNSIGNED DEFAULT NULL,
  `situacion_sanitaria` text,
  `servicios_luz` tinyint(1) DEFAULT '0',
  `servicios_cable` tinyint(1) DEFAULT '0',
  `servicios_gas_natural` tinyint(1) DEFAULT '0',
  `servicios_agua_potable` tinyint(1) DEFAULT '0',
  `servicios_internet` tinyint(1) DEFAULT '0',
  `tipo_violencia_id` bigint DEFAULT NULL,
  `denuncio_antes` tinyint(1) DEFAULT '0',
  `denuncio_antes_detalle` text,
  `amenaza_con_arma` tinyint(1) DEFAULT '0',
  `amenaza_tipo_arma` varchar(100) DEFAULT NULL,
  `fecha_ultima_denuncia` date DEFAULT NULL,
  `boton_panico_numero` varchar(50) DEFAULT NULL,
  `encargado_id` bigint UNSIGNED DEFAULT NULL,
  `agresor_id` bigint UNSIGNED DEFAULT NULL,
  `agresor_trabajo` text,
  `debe_asistir_masculinidades` tinyint(1) DEFAULT '0',
  `medida_cautelar_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `direccion_genero_casos`
--

INSERT INTO `direccion_genero_casos` (`id`, `persona_id`, `estado_civil_id`, `genero`, `provincia_id`, `localidad_id`, `barrio_id`, `situacion_habitacional_id`, `nivel_estudio_id`, `trabaja`, `organizacion_social`, `organizacion_social_detalle`, `observaciones`, `created_at`, `updated_at`, `estado_id`, `nivel_riesgo_id`, `situacion_sanitaria`, `servicios_luz`, `servicios_cable`, `servicios_gas_natural`, `servicios_agua_potable`, `servicios_internet`, `tipo_violencia_id`, `denuncio_antes`, `denuncio_antes_detalle`, `amenaza_con_arma`, `amenaza_tipo_arma`, `fecha_ultima_denuncia`, `boton_panico_numero`, `encargado_id`, `agresor_id`, `agresor_trabajo`, `debe_asistir_masculinidades`, `medida_cautelar_id`) VALUES
(14, 110, 4, 'MUJER', NULL, 5, 63, 1, 3, 1, 1, NULL, 'a', '2026-03-10 05:11:45', '2026-03-10 05:21:28', 1, NULL, NULL, 1, 1, 0, 1, 1, NULL, 0, NULL, 1, 'chumbo', '2026-03-03', '11111', 1, 109, 'a', 1, 3),
(16, 111, 2, 'MUJER', NULL, 5, 87, 1, 1, 1, 1, NULL, 'aa', '2026-03-10 15:21:14', '2026-03-10 15:23:40', 1, NULL, NULL, 1, 1, 0, 0, 0, 2, 0, NULL, 1, 'chumbo', '2026-03-10', '222222', 1, 109, 'a', 0, 1),
(17, 119, 2, 'MUJER', 1, 36, 99, 1, 5, 1, 1, 'aa', NULL, '2026-03-10 17:09:13', '2026-03-10 17:09:13', 1, NULL, NULL, 0, 1, 1, 1, 0, NULL, 1, NULL, 0, NULL, '2024-11-29', NULL, 1, NULL, NULL, 0, 3),
(18, 121, 1, 'kuka', 17, 176, 78, 1, 1, 1, 1, 'ssd', 'aa', '2026-03-11 23:19:51', '2026-03-12 04:15:54', 1, NULL, NULL, 1, 0, 0, 0, 0, NULL, 1, NULL, 1, 'chumbo', '2026-03-23', '333', 1, 120, NULL, 0, 2),
(20, 122, 4, 'kuka', 2, 90, 71, 3, 5, 1, 1, NULL, NULL, '2026-03-12 17:01:25', '2026-03-12 17:01:25', 1, NULL, NULL, 0, 0, 0, 0, 0, NULL, 0, NULL, 1, NULL, NULL, 'asd', 4, 120, NULL, 0, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion_genero_caso_programa`
--

CREATE TABLE `direccion_genero_caso_programa` (
  `id` bigint UNSIGNED NOT NULL,
  `caso_id` bigint UNSIGNED NOT NULL,
  `programa_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion_genero_estados`
--

CREATE TABLE `direccion_genero_estados` (
  `id` int UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `direccion_genero_estados`
--

INSERT INTO `direccion_genero_estados` (`id`, `nombre`) VALUES
(1, 'abierto'),
(6, 'archivado'),
(5, 'cerrado'),
(3, 'derivado'),
(2, 'en_seguimiento'),
(4, 'judicializado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion_genero_grupo_conviviente`
--

CREATE TABLE `direccion_genero_grupo_conviviente` (
  `id` bigint UNSIGNED NOT NULL,
  `caso_id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `apellido` varchar(150) NOT NULL,
  `dni` varchar(20) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `vinculo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion_genero_intervenciones`
--

CREATE TABLE `direccion_genero_intervenciones` (
  `id` bigint UNSIGNED NOT NULL,
  `caso_id` bigint UNSIGNED NOT NULL,
  `tipo_intervencion_id` bigint UNSIGNED DEFAULT NULL,
  `fecha_intervencion` date NOT NULL,
  `detalle` text NOT NULL COMMENT 'Desarrollo o evolución de la intervención',
  `encargado_id` bigint UNSIGNED NOT NULL COMMENT 'Profesional que interviene',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion_genero_niveles_riesgo`
--

CREATE TABLE `direccion_genero_niveles_riesgo` (
  `id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion_genero_red_contencion`
--

CREATE TABLE `direccion_genero_red_contencion` (
  `id` bigint UNSIGNED NOT NULL,
  `caso_id` bigint UNSIGNED NOT NULL,
  `tipo` varchar(100) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encargados`
--

CREATE TABLE `encargados` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `apellido` varchar(150) NOT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `cargo` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `encargados`
--

INSERT INTO `encargados` (`id`, `nombre`, `apellido`, `telefono`, `email`, `cargo`, `created_at`, `updated_at`) VALUES
(1, 'Roberto', 'Coronel', NULL, NULL, NULL, '2026-03-01 05:39:09', '2026-03-12 02:06:31'),
(2, 'Florencia', 'Beterette', NULL, NULL, NULL, '2026-03-01 05:39:24', '2026-03-12 02:06:57'),
(3, 'Margarita', 'Romero', NULL, NULL, NULL, '2026-03-01 05:39:35', '2026-03-12 02:07:27'),
(4, 'Jennifer', 'Baez', NULL, NULL, NULL, '2026-03-01 05:39:41', '2026-03-12 02:07:42'),
(5, 'Yael', 'Buchert', NULL, NULL, NULL, '2026-03-12 02:08:43', '2026-03-12 02:08:43'),
(6, 'Brenda', 'Buchert', NULL, NULL, NULL, '2026-03-12 02:08:59', '2026-03-12 02:08:59'),
(7, 'Bruno', 'Massocco', NULL, NULL, NULL, '2026-03-12 02:09:22', '2026-03-12 02:09:22'),
(8, 'Juliana', 'Brest', NULL, NULL, NULL, '2026-03-12 02:09:43', '2026-03-12 02:09:43'),
(9, 'Florencia', 'Ramos', NULL, NULL, NULL, '2026-03-12 02:09:56', '2026-03-12 02:09:56'),
(10, 'Julieta', 'Macarrone', NULL, NULL, NULL, '2026-03-12 02:10:15', '2026-03-12 02:10:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encargado_area`
--

CREATE TABLE `encargado_area` (
  `id` bigint UNSIGNED NOT NULL,
  `encargado_id` bigint UNSIGNED NOT NULL,
  `area_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `encargado_area`
--

INSERT INTO `encargado_area` (`id`, `encargado_id`, `area_id`) VALUES
(13, 1, 1),
(15, 2, 1),
(17, 2, 3),
(20, 3, 2),
(22, 4, 3),
(34, 4, 1),
(35, 5, 1),
(36, 6, 1),
(37, 7, 1),
(38, 8, 1),
(39, 8, 3),
(40, 9, 2),
(41, 10, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `espacios_grupales`
--

CREATE TABLE `espacios_grupales` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `espacios_grupales`
--

INSERT INTO `espacios_grupales` (`id`, `nombre`) VALUES
(2, 'Agrupacion'),
(1, 'Club'),
(3, 'Religion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_civiles`
--

CREATE TABLE `estados_civiles` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `estados_civiles`
--

INSERT INTO `estados_civiles` (`id`, `nombre`) VALUES
(2, 'Casado'),
(4, 'Separado de hecho'),
(1, 'Soltero'),
(3, 'Unido de hecho');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `intervenciones_totales`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `intervenciones_totales` (
`tipo_intervencion_id` bigint unsigned
,`fecha_intervencion` date
,`encargado_id` bigint unsigned
,`area` varchar(16)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ive_casos`
--

CREATE TABLE `ive_casos` (
  `id` bigint UNSIGNED NOT NULL,
  `persona_id` bigint UNSIGNED NOT NULL,
  `fum` date DEFAULT NULL,
  `eco_semanas` int DEFAULT NULL,
  `semanas_gestacion` int DEFAULT NULL,
  `estado_civil_id` bigint UNSIGNED DEFAULT NULL,
  `metodo_interrupcion` varchar(100) DEFAULT NULL,
  `obra_social` tinyint(1) NOT NULL DEFAULT '0',
  `cantidad_hijos` int DEFAULT '0',
  `interrupcion_previa` tinyint(1) NOT NULL DEFAULT '0',
  `violencia_previa` tinyint(1) NOT NULL DEFAULT '0',
  `alta` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `encargado_id` bigint UNSIGNED DEFAULT NULL,
  `metodo_interrupcion_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ive_casos`
--

INSERT INTO `ive_casos` (`id`, `persona_id`, `fum`, `eco_semanas`, `semanas_gestacion`, `estado_civil_id`, `metodo_interrupcion`, `obra_social`, `cantidad_hijos`, `interrupcion_previa`, `violencia_previa`, `alta`, `created_at`, `updated_at`, `encargado_id`, `metodo_interrupcion_id`) VALUES
(4, 110, '2026-03-11', 2, NULL, NULL, NULL, 0, 0, 1, 0, NULL, '2026-03-10 05:22:11', '2026-03-10 05:22:11', 2, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ive_caso_red`
--

CREATE TABLE `ive_caso_red` (
  `id` bigint UNSIGNED NOT NULL,
  `ive_caso_id` bigint UNSIGNED NOT NULL,
  `red_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ive_caso_red`
--

INSERT INTO `ive_caso_red` (`id`, `ive_caso_id`, `red_id`) VALUES
(9, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ive_caso_violencia`
--

CREATE TABLE `ive_caso_violencia` (
  `id` bigint UNSIGNED NOT NULL,
  `ive_caso_id` bigint UNSIGNED NOT NULL,
  `tipo_violencia_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ive_caso_violencia`
--

INSERT INTO `ive_caso_violencia` (`id`, `ive_caso_id`, `tipo_violencia_id`) VALUES
(12, 4, 6),
(13, 4, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ive_intervenciones`
--

CREATE TABLE `ive_intervenciones` (
  `id` bigint UNSIGNED NOT NULL,
  `ive_caso_id` bigint UNSIGNED NOT NULL,
  `tipo_intervencion_id` bigint UNSIGNED DEFAULT NULL,
  `fecha_intervencion` date NOT NULL,
  `detalle` text NOT NULL COMMENT 'Desarrollo o evolución de la intervención',
  `encargado_id` bigint UNSIGNED NOT NULL COMMENT 'Profesional que interviene',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ive_medicaciones`
--

CREATE TABLE `ive_medicaciones` (
  `id` bigint UNSIGNED NOT NULL,
  `ive_caso_id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `numero_lote` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ive_medicaciones`
--

INSERT INTO `ive_medicaciones` (`id`, `ive_caso_id`, `nombre`, `numero_lote`) VALUES
(5, 4, 'paracetamik', 'QQ11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidad`
--

CREATE TABLE `localidad` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `codigo_postal` int NOT NULL,
  `provincia_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `deleted_by` bigint UNSIGNED DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `localidad`
--

INSERT INTO `localidad` (`id`, `nombre`, `codigo_postal`, `provincia_id`, `created_at`, `updated_by`, `deleted_by`, `updated_at`, `deleted_at`) VALUES
(2, 'La Plata', 1900, 1, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(3, 'Mar del Plata', 7601, 1, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(4, 'Bahía Blanca', 8000, 1, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(5, 'San Nicolás de los Arroyos', 2900, 1, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(6, 'Tandil', 7000, 1, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(7, 'Olavarría', 7400, 1, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(8, 'Junín', 6000, 1, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(9, 'Pergamino', 2700, 1, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(10, 'San Isidro', 1642, 1, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(11, 'Luján', 6700, 1, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(12, 'Zárate', 2800, 1, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(13, 'Campana', 2804, 1, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(14, 'General Pueyrredón', 7600, 1, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(15, 'La Matanza', 1702, 1, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(16, 'San Fernando', 1646, 1, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(17, 'Tres de Febrero', 1651, 1, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(18, 'San Miguel', 1663, 1, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(19, 'Lomas de Zamora', 1832, 1, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(20, 'Quilmes', 1879, 1, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(21, 'Avellaneda', 1870, 1, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(22, 'Berazategui', 1884, 1, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(23, 'Ituzaingó', 1714, 1, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(24, 'Morón', 1708, 1, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(25, 'Florencio Varela', 1888, 1, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(26, 'San Martín', 1650, 1, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(27, 'Vicente López', 1638, 1, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(28, 'San Fernando del Valle de Catamarca', 4700, 2, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(29, 'Ramallo', 2915, 1, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(30, 'Andalgalá', 4740, 2, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(31, 'Belén', 4750, 2, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(32, 'Tinogasta', 5340, 2, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(33, 'Santa María', 4742, 2, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(34, 'Fiambalá', 4733, 2, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(35, 'La Merced', 4753, 2, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(36, 'Aconquija', 4741, 2, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(37, 'San José', 4701, 2, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(38, 'Saujil', 5335, 2, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(39, 'Pomán', 4724, 2, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(40, 'Capayán', 4722, 2, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(41, 'Valle Viejo', 4718, 2, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(42, 'Ancasti', 4747, 2, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(43, 'El Rodeo', 4730, 2, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(44, 'Los Altos', 4709, 2, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(45, 'Puerta de Corral Quemado', 4745, 2, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(46, 'La Puerta', 4703, 2, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(47, 'Resistencia', 3500, 3, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(48, 'Barranqueras', 3503, 3, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(49, 'Fontana', 3506, 3, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(50, 'Presidencia Roque Sáenz Peña', 3700, 3, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(51, 'Villa Ángela', 3541, 3, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(52, 'Charata', 3730, 3, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(53, 'Machagai', 3708, 3, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(54, 'Las Breñas', 3722, 3, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(55, 'Quitilipi', 3540, 3, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(56, 'Tres Isletas', 3535, 3, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(57, 'General Pinedo', 3703, 3, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(58, 'La Leonesa', 3511, 3, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(59, 'Puerto Tirol', 3519, 3, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(60, 'Colonia Benítez', 3513, 3, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(61, 'Puerto Vilelas', 3507, 3, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(62, 'Margarita Belén', 3505, 3, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(63, 'General San Martín', 3542, 3, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(64, 'San Bernardo', 3706, 3, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(65, 'Juan José Castelli', 3705, 3, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(66, 'Coronel Du Graty', 3724, 3, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(67, 'Comodoro Rivadavia', 9000, 4, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(68, 'Puerto Madryn', 9120, 4, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(69, 'Trelew', 9100, 4, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(70, 'Rawson', 9103, 4, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(71, 'Esquel', 9200, 4, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(72, 'Gaiman', 9105, 4, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(73, 'Trevelin', 9203, 4, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(74, 'Dolavon', 9101, 4, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(75, 'Rada Tilly', 9001, 4, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(76, 'Sarmiento', 9005, 4, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(77, 'Lago Puelo', 9211, 4, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(78, 'Río Mayo', 9011, 4, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(79, 'Río Senguer', 9017, 4, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(80, 'Gobernador Costa', 9221, 4, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(81, 'Paso de Indios', 9023, 4, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(82, 'Córdoba', 5000, 5, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(83, 'Villa María', 5900, 5, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(84, 'Río Cuarto', 5800, 5, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(85, 'San Francisco', 2400, 5, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(86, 'Jesús María', 5220, 5, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(87, 'Villa Carlos Paz', 5152, 5, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(88, 'La Falda', 5172, 5, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(89, 'Cosquín', 5166, 5, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(90, 'Alta Gracia', 5186, 5, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(91, 'Bell Ville', 2550, 5, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(92, 'Villa Allende', 5105, 5, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(93, 'Rio Tercero', 5850, 5, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(94, 'Villa Dolores', 5870, 5, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(95, 'Río Ceballos', 5111, 5, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(96, 'Arroyito', 2440, 5, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(97, 'Mina Clavero', 5889, 5, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(98, 'Villa General Belgrano', 5194, 5, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(99, 'Marcos Juárez', 2580, 5, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(100, 'Corrientes', 3400, 6, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(101, 'Goya', 3450, 6, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(102, 'Mercedes', 3471, 6, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(103, 'Ituzaingó', 3302, 6, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(104, 'Santo Tomé', 3340, 6, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(105, 'Curuzú Cuatiá', 3470, 6, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(106, 'Bella Vista', 3452, 6, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(107, 'Esquina', 3229, 6, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(108, 'Empedrado', 3416, 6, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(109, 'Monte Caseros', 3220, 6, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(110, 'Saladas', 3451, 6, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(111, 'Virasoro', 3342, 6, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(112, 'San Lorenzo', 3425, 6, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(113, 'La Cruz', 3226, 6, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(114, 'Paso de los Libres', 3230, 6, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(115, 'Alvear', 3424, 6, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(116, 'San Luis del Palmar', 3407, 6, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(117, 'Berón de Astrada', 3414, 6, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(118, 'Paraná', 3100, 7, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(119, 'Concordia', 3200, 7, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(120, 'Gualeguaychú', 2821, 7, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(121, 'Gualeguay', 2820, 7, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(122, 'Victoria', 3153, 7, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(123, 'Villaguay', 3240, 7, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(124, 'La Paz', 3190, 7, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(125, 'Colón', 3280, 7, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(126, 'Federal', 3181, 7, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(127, 'Chajarí', 3228, 7, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(128, 'Diamante', 3105, 7, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(129, 'San José', 3283, 7, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(130, 'Crespo', 3116, 7, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(131, 'Ramírez', 3113, 7, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(132, 'Rosario del Tala', 3170, 7, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(133, 'San Justo', 3195, 7, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(134, 'Pueblo Belgrano', 3180, 7, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(135, 'Pueblo General Alvear', 3175, 7, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(136, 'Salto', 3224, 7, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(137, 'Mendoza', 5500, 8, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(138, 'San Rafael', 5600, 8, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(139, 'Godoy Cruz', 5501, 8, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(140, 'Luján de Cuyo', 5505, 8, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(141, 'Guaymallén', 5519, 8, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(142, 'Las Heras', 5502, 8, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(143, 'Maipú', 5515, 8, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(144, 'Junín', 5512, 8, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(145, 'San Martín', 5560, 8, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(146, 'Tupungato', 5565, 8, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(147, 'Malargüe', 5613, 8, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(148, 'Rivadavia', 5562, 8, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(149, 'General Alvear', 5623, 8, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(150, 'Villa Nueva', 5516, 8, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(151, 'Las Compuertas', 5547, 8, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(152, 'San Carlos', 5567, 8, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(153, 'San José del Carril', 5537, 8, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(154, 'Rincón del Indio', 5555, 8, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(155, 'La Consulta', 5568, 8, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(156, 'Parque General San Martín', 5518, 8, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(157, 'El Carrizal', 5520, 8, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(158, 'Tunuyán', 5561, 8, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(159, 'Santa Rosa', 6370, 9, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(160, 'General Alvear', 6070, 9, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(161, 'Toay', 6300, 9, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(162, 'Catriló', 6109, 9, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(163, 'General Pico', 6360, 9, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(164, 'Intendente Alvear', 6343, 9, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(165, 'Macachín', 6316, 9, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(166, 'Realicó', 6150, 9, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(167, 'Santo Tomás', 6332, 9, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(168, 'Victorica', 6338, 9, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(169, 'Rancul', 6307, 9, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(170, 'Pico de Orizaba', 6113, 9, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(171, 'Puelches', 6120, 9, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(172, 'Ceballos', 6351, 9, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(173, 'Chamaico', 6340, 9, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(174, 'Lonquimay', 6176, 9, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(175, 'Rucanelo', 6116, 9, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(176, 'Bernasconi', 6100, 9, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(177, 'Chamanal', 6152, 9, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(178, 'Huantraico', 6095, 9, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(179, 'Rivadavia', 6350, 9, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(180, 'La Maruja', 6118, 9, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(181, 'Puelches', 6349, 9, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(182, 'Carhué', 6465, 10, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(183, 'Guaminí', 6461, 10, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(184, 'Daireaux', 6460, 10, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(185, 'Adolfo Alsina', 6462, 10, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(186, 'Salliqueló', 6463, 10, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(187, 'Pihué', 6466, 10, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(188, 'Pehuajó', 6468, 10, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(189, 'Trenque Lauquen', 6469, 10, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(190, 'General Villegas', 6470, 10, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(191, 'Intendente Alvear', 6471, 10, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(192, 'Trevino', 6482, 10, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(193, 'Banderaló', 6483, 10, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(194, 'Guaminí', 6484, 10, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(195, 'Dorrego', 6485, 10, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(196, 'San Miguel del Monte', 6486, 10, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(197, 'General La Madrid', 6487, 10, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(198, 'Tornquist', 6488, 10, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(199, 'Laprida', 6489, 10, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(200, 'Las Flores', 6490, 10, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(201, 'Azul', 6491, 10, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(202, 'Tandil', 6492, 10, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(203, 'Berazategui', 6493, 10, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(204, 'Zárate', 6494, 10, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(205, 'General Alvear', 6495, 10, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(206, 'General La Madrid', 6496, 10, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(207, 'Castelli', 6497, 10, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL),
(208, 'General Alvear', 6498, 10, '2026-01-31 04:22:19', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `masculinidades_casos`
--

CREATE TABLE `masculinidades_casos` (
  `id` bigint UNSIGNED NOT NULL,
  `persona_id` bigint UNSIGNED NOT NULL,
  `victima_id` bigint UNSIGNED DEFAULT NULL,
  `derivacion_id` bigint UNSIGNED NOT NULL,
  `situacion_habitacional_id` bigint UNSIGNED DEFAULT NULL,
  `trabaja` tinyint(1) NOT NULL DEFAULT '0',
  `detalle_trabajo` varchar(255) DEFAULT NULL,
  `red_contencion` tinyint(1) NOT NULL DEFAULT '0',
  `situacion_sanitaria_id` bigint UNSIGNED DEFAULT NULL,
  `consumo` tinyint(1) NOT NULL DEFAULT '0',
  `terapia` tinyint(1) NOT NULL DEFAULT '0',
  `espacio_grupal_id` bigint UNSIGNED DEFAULT NULL,
  `situacion_judicial` text,
  `desobediencia` tinyint(1) DEFAULT '0',
  `reincidencia` int DEFAULT '0',
  `asistencia_dispositivo` int DEFAULT '0',
  `observaciones` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `encargado_id` bigint UNSIGNED DEFAULT NULL,
  `fecha_finalizacion` date DEFAULT NULL,
  `debe_dispositivo` tinyint(1) DEFAULT '0',
  `nivel_estudio_id` bigint UNSIGNED DEFAULT NULL,
  `estado_civil_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `masculinidades_casos`
--

INSERT INTO `masculinidades_casos` (`id`, `persona_id`, `victima_id`, `derivacion_id`, `situacion_habitacional_id`, `trabaja`, `detalle_trabajo`, `red_contencion`, `situacion_sanitaria_id`, `consumo`, `terapia`, `espacio_grupal_id`, `situacion_judicial`, `desobediencia`, `reincidencia`, `asistencia_dispositivo`, `observaciones`, `created_at`, `updated_at`, `encargado_id`, `fecha_finalizacion`, `debe_dispositivo`, `nivel_estudio_id`, `estado_civil_id`) VALUES
(17, 109, NULL, 2, 3, 1, 'a', 0, NULL, 0, 1, 1, 'aa', 0, 1, 1, 'aa', '2026-03-10 05:08:50', '2026-03-10 05:08:50', 2, NULL, 0, NULL, NULL),
(19, 120, NULL, 2, 3, 1, 'a', 0, NULL, 1, 0, 1, 'aa', 0, 1, 2, 'aa', '2026-03-10 17:25:54', '2026-03-10 17:25:54', 2, NULL, 0, NULL, NULL),
(34, 125, NULL, 2, 3, 1, NULL, 0, NULL, 1, 1, 1, NULL, 1, 0, NULL, NULL, '2026-03-12 16:52:50', '2026-03-12 16:52:50', 9, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `masculinidades_caso_medida`
--

CREATE TABLE `masculinidades_caso_medida` (
  `id` bigint UNSIGNED NOT NULL,
  `caso_id` bigint UNSIGNED NOT NULL,
  `medida_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `masculinidades_caso_violencia`
--

CREATE TABLE `masculinidades_caso_violencia` (
  `id` bigint UNSIGNED NOT NULL,
  `caso_id` bigint UNSIGNED NOT NULL,
  `tipo_violencia_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `masculinidades_caso_violencia`
--

INSERT INTO `masculinidades_caso_violencia` (`id`, `caso_id`, `tipo_violencia_id`) VALUES
(60, 19, 2),
(61, 19, 3),
(68, 19, 1),
(71, 19, 4),
(72, 19, 5),
(73, 19, 6),
(74, 19, 7),
(140, 34, 2),
(141, 34, 3),
(142, 34, 5),
(143, 34, 6),
(144, 34, 1),
(145, 34, 4),
(146, 34, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `masculinidades_derivaciones`
--

CREATE TABLE `masculinidades_derivaciones` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `masculinidades_derivaciones`
--

INSERT INTO `masculinidades_derivaciones` (`id`, `nombre`) VALUES
(3, 'Direccion de genero'),
(2, 'Juzgado de familia'),
(4, 'Juzgado penal'),
(1, 'Patronatos deliberados'),
(5, 'Voluntad propia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `masculinidades_grupo_familiar`
--

CREATE TABLE `masculinidades_grupo_familiar` (
  `id` bigint UNSIGNED NOT NULL,
  `caso_id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `apellido` varchar(150) NOT NULL,
  `dni` varchar(20) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `vinculo_actual` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `masculinidades_grupo_familiar`
--

INSERT INTO `masculinidades_grupo_familiar` (`id`, `caso_id`, `nombre`, `apellido`, `dni`, `telefono`, `vinculo_actual`) VALUES
(17, 34, 'daniela', 'abal', '123123', '03364367123', 'padre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `masculinidades_intervenciones`
--

CREATE TABLE `masculinidades_intervenciones` (
  `id` bigint UNSIGNED NOT NULL,
  `caso_id` bigint UNSIGNED NOT NULL,
  `tipo_intervencion_id` bigint UNSIGNED DEFAULT NULL,
  `fecha_intervencion` date NOT NULL,
  `detalle` text NOT NULL COMMENT 'Desarrollo o evolución de la intervención',
  `encargado_id` bigint UNSIGNED NOT NULL COMMENT 'Profesional que interviene',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `masculinidades_intervenciones`
--

INSERT INTO `masculinidades_intervenciones` (`id`, `caso_id`, `tipo_intervencion_id`, `fecha_intervencion`, `detalle`, `encargado_id`, `created_at`, `updated_at`) VALUES
(14, 19, 1, '2026-03-11', 'asd', 2, '2026-03-11 05:27:06', '2026-03-11 05:27:06'),
(15, 19, 5, '2026-03-11', 'asd', 2, '2026-03-11 05:29:35', '2026-03-11 05:29:35'),
(16, 19, 5, '2026-03-11', 'asd', 2, '2026-03-11 05:32:30', '2026-03-11 05:32:30'),
(17, 19, 4, '2026-03-11', 'asd', 1, '2026-03-11 05:33:44', '2026-03-11 05:33:44'),
(18, 19, 2, '2026-03-11', 'asd', 2, '2026-03-11 05:33:59', '2026-03-11 05:33:59'),
(19, 19, 1, '2026-03-11', 'asd', 2, '2026-03-11 05:40:31', '2026-03-11 05:40:31'),
(20, 19, 4, '2026-03-12', 'a', 1, '2026-03-11 06:07:36', '2026-03-11 06:07:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `masculinidades_tipos_violencia`
--

CREATE TABLE `masculinidades_tipos_violencia` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `masculinidades_tipos_violencia`
--

INSERT INTO `masculinidades_tipos_violencia` (`id`, `nombre`) VALUES
(3, 'Economica'),
(1, 'Fisica'),
(2, 'Psicologica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medidas_cautelares`
--

CREATE TABLE `medidas_cautelares` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `medidas_cautelares`
--

INSERT INTO `medidas_cautelares` (`id`, `nombre`) VALUES
(2, 'Boton de panico'),
(1, 'Perimetros'),
(3, 'Recorridas dinamicas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodos_interrupcion`
--

CREATE TABLE `metodos_interrupcion` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `metodos_interrupcion`
--

INSERT INTO `metodos_interrupcion` (`id`, `nombre`) VALUES
(1, 'Medicamentoso'),
(2, 'AMEU'),
(3, 'Legrado'),
(4, 'Otro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2013_02_20_002634_create_roles_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2026_02_20_002954_add_rol_id_to_users_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles_estudio`
--

CREATE TABLE `niveles_estudio` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `niveles_estudio`
--

INSERT INTO `niveles_estudio` (`id`, `nombre`) VALUES
(1, 'Primaria'),
(5, 'Primario Incompleto'),
(2, 'Secundaria'),
(6, 'Secundario Incompleto'),
(3, 'Terciario'),
(4, 'Universidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `apellido` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `dni` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `sexo` enum('Masculino','Femenino','Otro') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `agresor` tinyint(1) DEFAULT '0',
  `victima` tinyint(1) DEFAULT '0',
  `domicilio` varchar(255) DEFAULT NULL,
  `provincia_id` bigint UNSIGNED DEFAULT NULL,
  `localidad_id` bigint UNSIGNED DEFAULT NULL,
  `barrio_id` bigint UNSIGNED DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `nivel_estudio_id` bigint UNSIGNED DEFAULT NULL,
  `trabaja` tinyint(1) DEFAULT '0',
  `grupo_sanguineo` varchar(5) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `debe_asistir_masculinidades` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `nombre`, `apellido`, `fecha_nacimiento`, `dni`, `sexo`, `agresor`, `victima`, `domicilio`, `provincia_id`, `localidad_id`, `barrio_id`, `telefono`, `nivel_estudio_id`, `trabaja`, `grupo_sanguineo`, `created_at`, `updated_at`, `debe_asistir_masculinidades`) VALUES
(109, 'Juan Segundo', 'Cian', '2003-11-05', '45032239', 'Masculino', 1, 0, NULL, NULL, NULL, 99, '03364318066', 1, 1, NULL, '2026-03-10 05:06:57', '2026-03-10 05:06:57', 1),
(110, 'Daniela', 'Abal', '1999-02-22', '41899221', 'Femenino', 0, 1, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2026-03-10 05:07:26', '2026-03-10 05:07:26', 0),
(111, 'aaa', 'aaa', '2020-09-27', '666666', 'Femenino', 0, 1, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2026-03-10 15:18:43', '2026-03-10 15:18:43', 0),
(119, 'aaa', 'aaa', '1998-09-28', '22121', 'Femenino', 0, 1, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2026-03-10 16:49:43', '2026-03-10 16:49:43', 0),
(120, 'aj', 'sj', '2025-10-30', '876', 'Masculino', 1, 0, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2026-03-10 17:25:22', '2026-03-11 05:54:38', 1),
(121, 'ascacd', 'e bciwsec', '2024-10-30', '5778278', 'Femenino', 0, 1, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2026-03-10 18:16:46', '2026-03-10 18:16:46', 0),
(122, 'Lezcano', 'Pablo', '2023-10-30', '666', 'Masculino', 0, 1, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2026-03-11 06:08:34', '2026-03-11 06:08:34', 0),
(125, 'hernan', 'vilchez', '2003-02-12', '41145735', NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2026-03-12 16:32:38', '2026-03-12 16:32:38', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programas_asistencia`
--

CREATE TABLE `programas_asistencia` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `programas_asistencia`
--

INSERT INTO `programas_asistencia` (`id`, `nombre`) VALUES
(2, 'Alimentar'),
(1, 'AUH'),
(4, 'Cuota de alimentos'),
(3, 'Fondo de desempleo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE `provincia` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int UNSIGNED DEFAULT NULL,
  `deleted_by` int UNSIGNED DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`id`, `nombre`, `created_at`, `updated_by`, `deleted_by`, `updated_at`, `deleted_at`) VALUES
(1, 'Buenos Aires', '2024-10-23 08:25:50', NULL, NULL, NULL, NULL),
(2, 'Catamarca', '2024-10-23 08:25:50', NULL, NULL, NULL, NULL),
(3, 'Chaco', '2024-10-23 08:25:50', NULL, NULL, NULL, NULL),
(4, 'Chubut', '2024-10-23 08:25:50', NULL, NULL, NULL, NULL),
(5, 'Córdoba', '2024-10-23 08:25:50', NULL, NULL, NULL, NULL),
(6, 'Corrientes', '2024-10-23 08:25:50', NULL, NULL, NULL, NULL),
(7, 'Entre Ríos', '2024-10-23 08:25:50', NULL, NULL, NULL, NULL),
(8, 'Formosa', '2024-10-23 08:25:50', NULL, NULL, NULL, NULL),
(9, 'Jujuy', '2024-10-23 08:25:50', NULL, NULL, NULL, NULL),
(10, 'La Pampa', '2024-10-23 08:25:50', NULL, NULL, NULL, NULL),
(11, 'La Rioja', '2024-10-23 08:25:50', NULL, NULL, NULL, NULL),
(12, 'Mendoza', '2024-10-23 08:25:50', NULL, NULL, NULL, NULL),
(13, 'Misiones', '2024-10-23 08:25:50', NULL, NULL, NULL, NULL),
(14, 'Neuquén', '2024-10-23 08:25:50', NULL, NULL, NULL, NULL),
(15, 'Río Negro', '2024-10-23 08:25:50', NULL, NULL, NULL, NULL),
(16, 'Salta', '2024-10-23 08:25:50', NULL, NULL, NULL, NULL),
(17, 'San Juan', '2024-10-23 08:25:50', NULL, NULL, NULL, NULL),
(18, 'San Luis', '2024-10-23 08:25:50', NULL, NULL, NULL, NULL),
(19, 'Santa Cruz', '2024-10-23 08:25:50', NULL, NULL, NULL, NULL),
(20, 'Santa Fe', '2024-10-23 08:25:50', NULL, NULL, NULL, NULL),
(21, 'Santiago del Estero', '2024-10-23 08:25:50', NULL, NULL, NULL, NULL),
(22, 'Tierra del Fuego', '2024-10-23 08:25:50', NULL, NULL, NULL, NULL),
(23, 'Tucumán', '2024-10-23 08:25:50', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `red_contencion`
--

CREATE TABLE `red_contencion` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `red_contencion`
--

INSERT INTO `red_contencion` (`id`, `nombre`) VALUES
(1, 'Pareja'),
(2, 'Familiares'),
(3, 'Amigos'),
(4, 'Organizaciones');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'usuario', 'Carga de datos', NULL, NULL),
(2, 'administrador', 'Gestiona usuarios', NULL, NULL),
(3, 'inactivo', 'Sin acceso', NULL, NULL),
(4, 'programador', 'Acceso total sistema', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `situaciones_habitacionales`
--

CREATE TABLE `situaciones_habitacionales` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `situaciones_habitacionales`
--

INSERT INTO `situaciones_habitacionales` (`id`, `nombre`) VALUES
(1, 'Casa'),
(3, 'Casilla'),
(2, 'Departamento'),
(4, 'Rancho');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `situaciones_sanitarias`
--

CREATE TABLE `situaciones_sanitarias` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `situaciones_sanitarias`
--

INSERT INTO `situaciones_sanitarias` (`id`, `nombre`) VALUES
(2, 'Buena'),
(4, 'Mala'),
(1, 'Muy buena'),
(3, 'Regular');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_intervencion`
--

CREATE TABLE `tipos_intervencion` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tipos_intervencion`
--

INSERT INTO `tipos_intervencion` (`id`, `nombre`) VALUES
(4, 'Asesoramiento legal'),
(5, 'Derivación institucional'),
(1, 'Entrevista presencial'),
(2, 'Llamado telefónico'),
(3, 'Visita domiciliaria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_violencia`
--

CREATE TABLE `tipos_violencia` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tipos_violencia`
--

INSERT INTO `tipos_violencia` (`id`, `nombre`) VALUES
(2, 'Economica'),
(3, 'Fisica'),
(5, 'Hostigamiento'),
(6, 'Hurto/Robo'),
(1, 'Psicologica'),
(4, 'Sexual'),
(7, 'Vicaria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `rol_id` bigint UNSIGNED NOT NULL DEFAULT '3',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nombre`, `apellido`, `email`, `email_verified_at`, `rol_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$12$SUDkLv7S68NuGcJSFlUTtuUyW8mib4MPSIM3zaXIUHdbFICp8NAEC', 'admin', 'admin', 'admin@gmail.com', NULL, 2, NULL, '2026-02-27 00:25:46', '2026-02-27 00:25:46'),
(2, 'juan', '$2y$12$i8Ujv7SHD48/16/AjDZjKuyFlZ9JN0tQJe.0xM9xDOA2GNBhnSKaO', 'Juan Segundo', 'Cian', 'juansegundocian@gmail.com', NULL, 1, NULL, '2026-02-27 22:44:02', '2026-03-02 17:41:57'),
(3, 'DaniAbal', '$2y$12$4TUvEvTJbpj8v1UBgW10SOcsWZlIKwBurbVhkHxnOWwnjKHcTWlSW', 'd', 'a', 'dani@gmail.com', NULL, 1, NULL, '2026-02-28 00:05:57', '2026-03-03 01:32:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vinculos_casos`
--

CREATE TABLE `vinculos_casos` (
  `id` bigint UNSIGNED NOT NULL,
  `genero_caso_id` bigint UNSIGNED NOT NULL COMMENT 'ID del caso en Direccion Genero (Victima)',
  `masculinidad_caso_id` bigint UNSIGNED NOT NULL COMMENT 'ID del caso en Masculinidades (Agresor)',
  `hijos_en_comun` int DEFAULT '0',
  `relacion_actual` tinyint(1) DEFAULT '0',
  `descripcion_relacion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `tipo_vinculo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Ej: Pareja, Ex-pareja, Conviviente, Progenitor',
  `observaciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `fecha_vinculacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zona_barrio`
--

CREATE TABLE `zona_barrio` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `zona_barrio`
--

INSERT INTO `zona_barrio` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'NORTE', NULL, NULL),
(2, 'SUR', NULL, NULL),
(3, 'OESTE', NULL, NULL),
(4, 'CENTRO', NULL, NULL),
(5, 'DELEGACIONES', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura para la vista `intervenciones_totales`
--
DROP TABLE IF EXISTS `intervenciones_totales`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `intervenciones_totales`  AS SELECT `direccion_genero_intervenciones`.`tipo_intervencion_id` AS `tipo_intervencion_id`, `direccion_genero_intervenciones`.`fecha_intervencion` AS `fecha_intervencion`, `direccion_genero_intervenciones`.`encargado_id` AS `encargado_id`, 'direccion_genero' AS `area` FROM `direccion_genero_intervenciones`union all select `ive_intervenciones`.`tipo_intervencion_id` AS `tipo_intervencion_id`,`ive_intervenciones`.`fecha_intervencion` AS `fecha_intervencion`,`ive_intervenciones`.`encargado_id` AS `encargado_id`,'ive' AS `area` from `ive_intervenciones` union all select `masculinidades_intervenciones`.`tipo_intervencion_id` AS `tipo_intervencion_id`,`masculinidades_intervenciones`.`fecha_intervencion` AS `fecha_intervencion`,`masculinidades_intervenciones`.`encargado_id` AS `encargado_id`,'masculinidades' AS `area` from `masculinidades_intervenciones`  ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `adjuntos`
--
ALTER TABLE `adjuntos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_entidad` (`entidad_tipo`,`entidad_id`),
  ADD KEY `idx_confidencial` (`confidencial`),
  ADD KEY `idx_eliminado` (`eliminado_logico`),
  ADD KEY `subido_por` (`subido_por`);

--
-- Indices de la tabla `adjuntos_descargas`
--
ALTER TABLE `adjuntos_descargas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `adjunto_id` (`adjunto_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `area_user`
--
ALTER TABLE `area_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `area_id` (`area_id`);

--
-- Indices de la tabla `barrio`
--
ALTER TABLE `barrio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barrio_id_localidad_foreign` (`localidad_id`),
  ADD KEY `barrio_zona_barrio_id_foreign` (`zona_barrio_id`);

--
-- Indices de la tabla `cud`
--
ALTER TABLE `cud`
  ADD PRIMARY KEY (`id`),
  ADD KEY `persona_id` (`persona_id`);

--
-- Indices de la tabla `direccion_genero_casos`
--
ALTER TABLE `direccion_genero_casos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estado_id` (`estado_id`),
  ADD KEY `nivel_riesgo_id` (`nivel_riesgo_id`),
  ADD KEY `persona_id` (`persona_id`),
  ADD KEY `estado_civil_id` (`estado_civil_id`),
  ADD KEY `provincia_id` (`provincia_id`),
  ADD KEY `localidad_id` (`localidad_id`),
  ADD KEY `barrio_id` (`barrio_id`),
  ADD KEY `nivel_estudio_id` (`nivel_estudio_id`),
  ADD KEY `fk_genero_encargado` (`encargado_id`),
  ADD KEY `fk_agresor` (`agresor_id`),
  ADD KEY `direccion_genero_casos_situacion_habitacional_fk` (`situacion_habitacional_id`),
  ADD KEY `fk_direccion_genero_medidas` (`medida_cautelar_id`);

--
-- Indices de la tabla `direccion_genero_caso_programa`
--
ALTER TABLE `direccion_genero_caso_programa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `caso_id` (`caso_id`),
  ADD KEY `programa_id` (`programa_id`);

--
-- Indices de la tabla `direccion_genero_estados`
--
ALTER TABLE `direccion_genero_estados`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `direccion_genero_grupo_conviviente`
--
ALTER TABLE `direccion_genero_grupo_conviviente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `caso_id` (`caso_id`);

--
-- Indices de la tabla `direccion_genero_intervenciones`
--
ALTER TABLE `direccion_genero_intervenciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dg_intervencion_caso` (`caso_id`),
  ADD KEY `fk_dg_intervencion_tipo` (`tipo_intervencion_id`),
  ADD KEY `fk_dg_intervencion_encargado` (`encargado_id`);

--
-- Indices de la tabla `direccion_genero_niveles_riesgo`
--
ALTER TABLE `direccion_genero_niveles_riesgo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `direccion_genero_red_contencion`
--
ALTER TABLE `direccion_genero_red_contencion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `caso_id` (`caso_id`);

--
-- Indices de la tabla `encargados`
--
ALTER TABLE `encargados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `encargado_area`
--
ALTER TABLE `encargado_area`
  ADD PRIMARY KEY (`id`),
  ADD KEY `encargado_id` (`encargado_id`),
  ADD KEY `area_id` (`area_id`);

--
-- Indices de la tabla `espacios_grupales`
--
ALTER TABLE `espacios_grupales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `estados_civiles`
--
ALTER TABLE `estados_civiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `ive_casos`
--
ALTER TABLE `ive_casos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `persona_id` (`persona_id`),
  ADD KEY `fk_ive_encargado` (`encargado_id`),
  ADD KEY `fk_ive_estado_civil` (`estado_civil_id`),
  ADD KEY `fk_metodo_interrupcion` (`metodo_interrupcion_id`);

--
-- Indices de la tabla `ive_caso_red`
--
ALTER TABLE `ive_caso_red`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ive_caso_id` (`ive_caso_id`),
  ADD KEY `red_id` (`red_id`);

--
-- Indices de la tabla `ive_caso_violencia`
--
ALTER TABLE `ive_caso_violencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ive_caso_id` (`ive_caso_id`),
  ADD KEY `tipo_violencia_id` (`tipo_violencia_id`);

--
-- Indices de la tabla `ive_intervenciones`
--
ALTER TABLE `ive_intervenciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ive_intervencion_caso` (`ive_caso_id`),
  ADD KEY `fk_ive_intervencion_tipo` (`tipo_intervencion_id`),
  ADD KEY `fk_ive_intervencion_encargado` (`encargado_id`);

--
-- Indices de la tabla `ive_medicaciones`
--
ALTER TABLE `ive_medicaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ive_caso_id` (`ive_caso_id`);

--
-- Indices de la tabla `localidad`
--
ALTER TABLE `localidad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `localidad_id_provincia_foreign` (`provincia_id`);

--
-- Indices de la tabla `masculinidades_casos`
--
ALTER TABLE `masculinidades_casos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `persona_id` (`persona_id`),
  ADD KEY `victima_id` (`victima_id`),
  ADD KEY `derivacion_id` (`derivacion_id`),
  ADD KEY `situacion_habitacional_id` (`situacion_habitacional_id`),
  ADD KEY `situacion_sanitaria_id` (`situacion_sanitaria_id`),
  ADD KEY `espacio_grupal_id` (`espacio_grupal_id`),
  ADD KEY `fk_masculinidad_encargado` (`encargado_id`),
  ADD KEY `fk_masc_nivel` (`nivel_estudio_id`),
  ADD KEY `fk_masc_estado` (`estado_civil_id`);

--
-- Indices de la tabla `masculinidades_caso_medida`
--
ALTER TABLE `masculinidades_caso_medida`
  ADD PRIMARY KEY (`id`),
  ADD KEY `caso_id` (`caso_id`),
  ADD KEY `medida_id` (`medida_id`);

--
-- Indices de la tabla `masculinidades_caso_violencia`
--
ALTER TABLE `masculinidades_caso_violencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `caso_id` (`caso_id`),
  ADD KEY `tipo_violencia_id` (`tipo_violencia_id`);

--
-- Indices de la tabla `masculinidades_derivaciones`
--
ALTER TABLE `masculinidades_derivaciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `masculinidades_grupo_familiar`
--
ALTER TABLE `masculinidades_grupo_familiar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `caso_id` (`caso_id`);

--
-- Indices de la tabla `masculinidades_intervenciones`
--
ALTER TABLE `masculinidades_intervenciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_masc_intervencion_caso` (`caso_id`),
  ADD KEY `fk_masc_intervencion_tipo` (`tipo_intervencion_id`),
  ADD KEY `fk_masc_intervencion_encargado` (`encargado_id`);

--
-- Indices de la tabla `masculinidades_tipos_violencia`
--
ALTER TABLE `masculinidades_tipos_violencia`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `medidas_cautelares`
--
ALTER TABLE `medidas_cautelares`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `metodos_interrupcion`
--
ALTER TABLE `metodos_interrupcion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `niveles_estudio`
--
ALTER TABLE `niveles_estudio`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_personas_dni` (`dni`),
  ADD UNIQUE KEY `unique_dni` (`dni`),
  ADD KEY `nivel_estudio_id` (`nivel_estudio_id`),
  ADD KEY `fk_personas_provincia` (`provincia_id`),
  ADD KEY `fk_personas_localidad` (`localidad_id`),
  ADD KEY `fk_personas_barrio` (`barrio_id`);

--
-- Indices de la tabla `programas_asistencia`
--
ALTER TABLE `programas_asistencia`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `red_contencion`
--
ALTER TABLE `red_contencion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `situaciones_habitacionales`
--
ALTER TABLE `situaciones_habitacionales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `situaciones_sanitarias`
--
ALTER TABLE `situaciones_sanitarias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `tipos_intervencion`
--
ALTER TABLE `tipos_intervencion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `tipos_violencia`
--
ALTER TABLE `tipos_violencia`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `users_rol_id_foreign` (`rol_id`);

--
-- Indices de la tabla `vinculos_casos`
--
ALTER TABLE `vinculos_casos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_vinculo_genero` (`genero_caso_id`),
  ADD KEY `fk_vinculo_masculinidad` (`masculinidad_caso_id`);

--
-- Indices de la tabla `zona_barrio`
--
ALTER TABLE `zona_barrio`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `zona_barrio_nombre_unique` (`nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `adjuntos`
--
ALTER TABLE `adjuntos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `adjuntos_descargas`
--
ALTER TABLE `adjuntos_descargas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `area_user`
--
ALTER TABLE `area_user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `barrio`
--
ALTER TABLE `barrio`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT de la tabla `cud`
--
ALTER TABLE `cud`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `direccion_genero_casos`
--
ALTER TABLE `direccion_genero_casos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `direccion_genero_caso_programa`
--
ALTER TABLE `direccion_genero_caso_programa`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `direccion_genero_estados`
--
ALTER TABLE `direccion_genero_estados`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `direccion_genero_grupo_conviviente`
--
ALTER TABLE `direccion_genero_grupo_conviviente`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `direccion_genero_intervenciones`
--
ALTER TABLE `direccion_genero_intervenciones`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `direccion_genero_niveles_riesgo`
--
ALTER TABLE `direccion_genero_niveles_riesgo`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `direccion_genero_red_contencion`
--
ALTER TABLE `direccion_genero_red_contencion`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `encargados`
--
ALTER TABLE `encargados`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `encargado_area`
--
ALTER TABLE `encargado_area`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `espacios_grupales`
--
ALTER TABLE `espacios_grupales`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `estados_civiles`
--
ALTER TABLE `estados_civiles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ive_casos`
--
ALTER TABLE `ive_casos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ive_caso_red`
--
ALTER TABLE `ive_caso_red`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `ive_caso_violencia`
--
ALTER TABLE `ive_caso_violencia`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `ive_intervenciones`
--
ALTER TABLE `ive_intervenciones`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ive_medicaciones`
--
ALTER TABLE `ive_medicaciones`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `localidad`
--
ALTER TABLE `localidad`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT de la tabla `masculinidades_casos`
--
ALTER TABLE `masculinidades_casos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `masculinidades_caso_medida`
--
ALTER TABLE `masculinidades_caso_medida`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `masculinidades_caso_violencia`
--
ALTER TABLE `masculinidades_caso_violencia`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT de la tabla `masculinidades_derivaciones`
--
ALTER TABLE `masculinidades_derivaciones`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `masculinidades_grupo_familiar`
--
ALTER TABLE `masculinidades_grupo_familiar`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `masculinidades_intervenciones`
--
ALTER TABLE `masculinidades_intervenciones`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `masculinidades_tipos_violencia`
--
ALTER TABLE `masculinidades_tipos_violencia`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `medidas_cautelares`
--
ALTER TABLE `medidas_cautelares`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `metodos_interrupcion`
--
ALTER TABLE `metodos_interrupcion`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `niveles_estudio`
--
ALTER TABLE `niveles_estudio`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT de la tabla `programas_asistencia`
--
ALTER TABLE `programas_asistencia`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `provincia`
--
ALTER TABLE `provincia`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `red_contencion`
--
ALTER TABLE `red_contencion`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `situaciones_habitacionales`
--
ALTER TABLE `situaciones_habitacionales`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `situaciones_sanitarias`
--
ALTER TABLE `situaciones_sanitarias`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tipos_intervencion`
--
ALTER TABLE `tipos_intervencion`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tipos_violencia`
--
ALTER TABLE `tipos_violencia`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `vinculos_casos`
--
ALTER TABLE `vinculos_casos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `zona_barrio`
--
ALTER TABLE `zona_barrio`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `area_user`
--
ALTER TABLE `area_user`
  ADD CONSTRAINT `area_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `area_user_ibfk_2` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `barrio`
--
ALTER TABLE `barrio`
  ADD CONSTRAINT `barrio_id_localidad_foreign` FOREIGN KEY (`localidad_id`) REFERENCES `localidad` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `barrio_zona_barrio_id_foreign` FOREIGN KEY (`zona_barrio_id`) REFERENCES `zona_barrio` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `cud`
--
ALTER TABLE `cud`
  ADD CONSTRAINT `cud_ibfk_1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `direccion_genero_casos`
--
ALTER TABLE `direccion_genero_casos`
  ADD CONSTRAINT `direccion_genero_casos_ibfk_1` FOREIGN KEY (`estado_id`) REFERENCES `direccion_genero_estados` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `direccion_genero_casos_ibfk_2` FOREIGN KEY (`nivel_riesgo_id`) REFERENCES `direccion_genero_niveles_riesgo` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `direccion_genero_casos_ibfks_1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `direccion_genero_casos_ibfks_2` FOREIGN KEY (`estado_civil_id`) REFERENCES `estados_civiles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `direccion_genero_casos_ibfks_3` FOREIGN KEY (`provincia_id`) REFERENCES `provincia` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `direccion_genero_casos_ibfks_4` FOREIGN KEY (`localidad_id`) REFERENCES `localidad` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `direccion_genero_casos_ibfks_5` FOREIGN KEY (`barrio_id`) REFERENCES `barrio` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `direccion_genero_casos_ibfks_6` FOREIGN KEY (`nivel_estudio_id`) REFERENCES `niveles_estudio` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `direccion_genero_casos_situacion_habitacional_fk` FOREIGN KEY (`situacion_habitacional_id`) REFERENCES `situaciones_habitacionales` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_agresor` FOREIGN KEY (`agresor_id`) REFERENCES `personas` (`id`),
  ADD CONSTRAINT `fk_direccion_genero_medida` FOREIGN KEY (`medida_cautelar_id`) REFERENCES `medidas_cautelares` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_direccion_genero_medidas` FOREIGN KEY (`medida_cautelar_id`) REFERENCES `medidas_cautelares` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_genero_encargado` FOREIGN KEY (`encargado_id`) REFERENCES `encargados` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `direccion_genero_caso_programa`
--
ALTER TABLE `direccion_genero_caso_programa`
  ADD CONSTRAINT `direccion_genero_caso_programa_ibfk_1` FOREIGN KEY (`caso_id`) REFERENCES `direccion_genero_casos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `direccion_genero_caso_programa_ibfk_2` FOREIGN KEY (`programa_id`) REFERENCES `programas_asistencia` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Filtros para la tabla `direccion_genero_grupo_conviviente`
--
ALTER TABLE `direccion_genero_grupo_conviviente`
  ADD CONSTRAINT `direccion_genero_grupo_conviviente_ibfk_1` FOREIGN KEY (`caso_id`) REFERENCES `direccion_genero_casos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `direccion_genero_intervenciones`
--
ALTER TABLE `direccion_genero_intervenciones`
  ADD CONSTRAINT `dg_interv_caso_fk` FOREIGN KEY (`caso_id`) REFERENCES `direccion_genero_casos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dg_interv_encargado_fk` FOREIGN KEY (`encargado_id`) REFERENCES `encargados` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `dg_interv_tipo_fk` FOREIGN KEY (`tipo_intervencion_id`) REFERENCES `tipos_intervencion` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `direccion_genero_red_contencion`
--
ALTER TABLE `direccion_genero_red_contencion`
  ADD CONSTRAINT `direccion_genero_red_contencion_ibfk_1` FOREIGN KEY (`caso_id`) REFERENCES `direccion_genero_casos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `encargado_area`
--
ALTER TABLE `encargado_area`
  ADD CONSTRAINT `encargado_area_ibfk_1` FOREIGN KEY (`encargado_id`) REFERENCES `encargados` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `encargado_area_ibfk_2` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `ive_casos`
--
ALTER TABLE `ive_casos`
  ADD CONSTRAINT `fk_ive_encargado` FOREIGN KEY (`encargado_id`) REFERENCES `encargados` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_ive_estado_civil` FOREIGN KEY (`estado_civil_id`) REFERENCES `estados_civiles` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_metodo_interrupcion` FOREIGN KEY (`metodo_interrupcion_id`) REFERENCES `metodos_interrupcion` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `ive_casos_ibfk_1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ive_caso_red`
--
ALTER TABLE `ive_caso_red`
  ADD CONSTRAINT `ive_caso_red_ibfk_1` FOREIGN KEY (`ive_caso_id`) REFERENCES `ive_casos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ive_caso_red_ive_fk` FOREIGN KEY (`ive_caso_id`) REFERENCES `ive_casos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ive_caso_red_red_fk` FOREIGN KEY (`red_id`) REFERENCES `red_contencion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ive_caso_red_red_id_fk` FOREIGN KEY (`red_id`) REFERENCES `red_contencion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ive_caso_violencia`
--
ALTER TABLE `ive_caso_violencia`
  ADD CONSTRAINT `ive_caso_violencia_ibfk_1` FOREIGN KEY (`ive_caso_id`) REFERENCES `ive_casos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ive_caso_violencia_ibfk_2` FOREIGN KEY (`tipo_violencia_id`) REFERENCES `tipos_violencia` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Filtros para la tabla `ive_intervenciones`
--
ALTER TABLE `ive_intervenciones`
  ADD CONSTRAINT `ive_interv_caso_fk` FOREIGN KEY (`ive_caso_id`) REFERENCES `ive_casos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ive_interv_encargado_fk` FOREIGN KEY (`encargado_id`) REFERENCES `encargados` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `ive_interv_tipo_fk` FOREIGN KEY (`tipo_intervencion_id`) REFERENCES `tipos_intervencion` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `ive_medicaciones`
--
ALTER TABLE `ive_medicaciones`
  ADD CONSTRAINT `ive_medicaciones_ibfk_1` FOREIGN KEY (`ive_caso_id`) REFERENCES `ive_casos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `localidad`
--
ALTER TABLE `localidad`
  ADD CONSTRAINT `localidad_id_provincia_foreign` FOREIGN KEY (`provincia_id`) REFERENCES `provincia` (`id`);

--
-- Filtros para la tabla `masculinidades_casos`
--
ALTER TABLE `masculinidades_casos`
  ADD CONSTRAINT `fk_masc_estado` FOREIGN KEY (`estado_civil_id`) REFERENCES `estados_civiles` (`id`),
  ADD CONSTRAINT `fk_masc_nivel` FOREIGN KEY (`nivel_estudio_id`) REFERENCES `niveles_estudio` (`id`),
  ADD CONSTRAINT `fk_masculinidad_encargado` FOREIGN KEY (`encargado_id`) REFERENCES `encargados` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `masculinidades_casos_ibfk_1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `masculinidades_casos_ibfk_2` FOREIGN KEY (`victima_id`) REFERENCES `personas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `masculinidades_casos_ibfk_3` FOREIGN KEY (`derivacion_id`) REFERENCES `masculinidades_derivaciones` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `masculinidades_casos_ibfk_4` FOREIGN KEY (`situacion_habitacional_id`) REFERENCES `situaciones_habitacionales` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `masculinidades_casos_ibfk_6` FOREIGN KEY (`situacion_sanitaria_id`) REFERENCES `situaciones_sanitarias` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `masculinidades_casos_ibfk_7` FOREIGN KEY (`espacio_grupal_id`) REFERENCES `espacios_grupales` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `masculinidades_caso_medida`
--
ALTER TABLE `masculinidades_caso_medida`
  ADD CONSTRAINT `masculinidades_caso_medida_ibfk_1` FOREIGN KEY (`caso_id`) REFERENCES `masculinidades_casos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `masculinidades_caso_medida_ibfk_2` FOREIGN KEY (`medida_id`) REFERENCES `medidas_cautelares` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Filtros para la tabla `masculinidades_caso_violencia`
--
ALTER TABLE `masculinidades_caso_violencia`
  ADD CONSTRAINT `fk_tipo_violencia` FOREIGN KEY (`tipo_violencia_id`) REFERENCES `tipos_violencia` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `masculinidades_caso_violencia_ibfk_1` FOREIGN KEY (`caso_id`) REFERENCES `masculinidades_casos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `masculinidades_grupo_familiar`
--
ALTER TABLE `masculinidades_grupo_familiar`
  ADD CONSTRAINT `masculinidades_grupo_familiar_ibfk_1` FOREIGN KEY (`caso_id`) REFERENCES `masculinidades_casos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `masculinidades_intervenciones`
--
ALTER TABLE `masculinidades_intervenciones`
  ADD CONSTRAINT `masc_interv_caso_fk` FOREIGN KEY (`caso_id`) REFERENCES `masculinidades_casos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `masc_interv_encargado_fk` FOREIGN KEY (`encargado_id`) REFERENCES `encargados` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `masc_interv_tipo_fk` FOREIGN KEY (`tipo_intervencion_id`) REFERENCES `tipos_intervencion` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `fk_personas_barrio` FOREIGN KEY (`barrio_id`) REFERENCES `barrio` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_personas_localidad` FOREIGN KEY (`localidad_id`) REFERENCES `localidad` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_personas_provincia` FOREIGN KEY (`provincia_id`) REFERENCES `provincia` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `personas_ibfk_1` FOREIGN KEY (`nivel_estudio_id`) REFERENCES `niveles_estudio` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_rol_id_foreign` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Filtros para la tabla `vinculos_casos`
--
ALTER TABLE `vinculos_casos`
  ADD CONSTRAINT `fk_vinculo_genero` FOREIGN KEY (`genero_caso_id`) REFERENCES `direccion_genero_casos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_vinculo_masculinidad` FOREIGN KEY (`masculinidad_caso_id`) REFERENCES `masculinidades_casos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
