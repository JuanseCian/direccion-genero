-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 01-04-2026 a las 13:29:42
-- Versión del servidor: 11.8.6-MariaDB-log
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u510203833_genero`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adjuntos`
--

CREATE TABLE `adjuntos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `entidad_tipo` varchar(50) NOT NULL,
  `entidad_id` bigint(20) UNSIGNED NOT NULL,
  `nombre_original` varchar(255) NOT NULL,
  `nombre_guardado` varchar(255) NOT NULL,
  `ruta` varchar(500) NOT NULL,
  `tipo_mime` varchar(100) DEFAULT NULL,
  `tamaño` bigint(20) DEFAULT NULL,
  `confidencial` tinyint(1) NOT NULL DEFAULT 0,
  `hash_sha256` varchar(64) DEFAULT NULL,
  `subido_por` bigint(20) UNSIGNED NOT NULL,
  `eliminado_logico` tinyint(1) NOT NULL DEFAULT 0,
  `fecha_eliminacion` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `adjuntos`
--

INSERT INTO `adjuntos` (`id`, `entidad_tipo`, `entidad_id`, `nombre_original`, `nombre_guardado`, `ruta`, `tipo_mime`, `tamaño`, `confidencial`, `hash_sha256`, `subido_por`, `eliminado_logico`, `fecha_eliminacion`, `created_at`) VALUES
(1, 'genero', 1, 'caso_genero_000001_28276004.docx', 'caso_genero_000001_28276004.docx', 'genero_certificados/caso_genero_000001_28276004.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 8416, 0, 'eecafa34bb8c556f3cbee811b68426918892e05152637bd29418502f8a201629', 7, 0, NULL, '2026-03-30 12:57:37'),
(2, 'intervencion_genero', 1, 'CamScanner 30-03-2026 10.00.pdf', '69ca7486ed94b_CamScanner 30-03-2026 10.00.pdf', 'adjuntos/intervenciones_genero/69ca7486ed94b_CamScanner 30-03-2026 10.00.pdf', 'application/pdf', 629721, 0, NULL, 7, 0, NULL, '2026-03-30 13:03:02'),
(3, 'intervencion_genero', 2, 'ACTA RECORRIDA BANEGAS VANESA.pdf', '69ca76320b58c_ACTA RECORRIDA BANEGAS VANESA.pdf', 'adjuntos/intervenciones_genero/69ca76320b58c_ACTA RECORRIDA BANEGAS VANESA.pdf', 'application/pdf', 30358, 0, NULL, 7, 0, NULL, '2026-03-30 13:10:10'),
(4, 'intervencion_genero', 3, 'BANEGAS VANESA ELIZABETH 29 MAR 26.pdf', '69ca79cd3d264_BANEGAS VANESA ELIZABETH 29 MAR 26.pdf', 'adjuntos/intervenciones_genero/69ca79cd3d264_BANEGAS VANESA ELIZABETH 29 MAR 26.pdf', 'application/pdf', 574325, 0, NULL, 6, 0, NULL, '2026-03-30 13:25:33'),
(5, 'genero', 2, 'caso_genero_000002_28315193.docx', 'caso_genero_000002_28315193.docx', 'genero_certificados/caso_genero_000002_28315193.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 8407, 0, '09596b51b68cc7c5885144d6d572ae9ae9edd5dc87856e023ff7e4abe2912aee', 8, 0, NULL, '2026-03-30 14:02:09'),
(6, 'intervencion_genero', 4, 'suarezcristina.pdf', '69ca82ac42d3b_suarezcristina.pdf', 'adjuntos/intervenciones_genero/69ca82ac42d3b_suarezcristina.pdf', 'application/pdf', 529386, 0, NULL, 8, 0, NULL, '2026-03-30 14:03:24'),
(7, 'genero', 3, 'caso_genero_000003_36053945.docx', 'caso_genero_000003_36053945.docx', 'genero_certificados/caso_genero_000003_36053945.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 8534, 0, '5c60cf63d288b446642f7bbac6d8b52e8d948a9ac08a93ca456e5a06f7d35c8d', 6, 0, NULL, '2026-03-30 14:09:23'),
(8, 'intervencion_genero', 5, 'Alegre Noelia.pdf', '69ca856fb3651_Alegre Noelia.pdf', 'adjuntos/intervenciones_genero/69ca856fb3651_Alegre Noelia.pdf', 'application/pdf', 584043, 0, NULL, 6, 0, NULL, '2026-03-30 14:15:11'),
(9, 'masculinidades', 1, 'caso_masc_000001_30026939.docx', 'caso_masc_000001_30026939.docx', 'masculinidades_certificados/caso_masc_000001_30026939.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 8402, 0, '4bf8b8ddf7b67189029c11146e435b337ea79d6c7f1189906c72817eebe7c069', 8, 0, NULL, '2026-03-30 14:40:16'),
(10, 'masculinidades', 2, 'caso_masc_000002_33552168.docx', 'caso_masc_000002_33552168.docx', 'masculinidades_certificados/caso_masc_000002_33552168.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 8404, 0, '8ac736f17640317a2f0d1a8fe3b9b8841ad8a511d2e424169ee5532aea23d2d4', 6, 0, NULL, '2026-03-30 14:46:33'),
(11, 'masculinidades', 3, 'caso_masc_000003_28276764.docx', 'caso_masc_000003_28276764.docx', 'masculinidades_certificados/caso_masc_000003_28276764.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 8424, 0, '7ed47644af8e68bf24929b3ed5e63ef5ac90d1ed271d1fc15110cd0f0f6673ed', 6, 0, NULL, '2026-03-30 14:54:33'),
(12, 'ive', 1, 'caso_ive_000001_43313566.docx', 'caso_ive_000001_43313566.docx', 'ive_certificados/caso_ive_000001_43313566.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 7901, 0, '6915fb31390e4ced1e004c21d77252224381a3258d4d71da4da85ac5ea3be3da', 6, 0, NULL, '2026-03-31 13:07:56'),
(13, 'ive', 2, 'caso_ive_000002_44519359.docx', 'caso_ive_000002_44519359.docx', 'ive_certificados/caso_ive_000002_44519359.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 7897, 0, 'cb44ebdaaa82f3cff73c1d64a0b91618de14513c380113b59a8884bee49d1ac3', 6, 0, NULL, '2026-03-31 13:16:31'),
(14, 'ive', 3, 'caso_ive_000003_44416459.docx', 'caso_ive_000003_44416459.docx', 'ive_certificados/caso_ive_000003_44416459.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 7895, 0, '1a118ae85dbe2260a84693dfaca545afff7c285bab3083934d926affaa72ab25', 6, 0, NULL, '2026-03-31 13:54:35'),
(15, 'ive', 4, 'caso_ive_000004_39710780.docx', 'caso_ive_000004_39710780.docx', 'ive_certificados/caso_ive_000004_39710780.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 7891, 0, '73bd3d1b4aae49484e8096951cf5ef8d652275eda46c22a0ea3697e2ceca3aec', 6, 0, NULL, '2026-03-31 14:10:54'),
(16, 'genero', 4, 'caso_genero_000004_33803692.docx', 'caso_genero_000004_33803692.docx', 'genero_certificados/caso_genero_000004_33803692.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 8446, 0, '9786be7109e62adc86c55aa855edb17d5a71340237ad66f60f49cb668c04b5fe', 3, 0, NULL, '2026-04-01 12:33:44'),
(17, 'masculinidades', 4, 'caso_masc_000004_22594676.docx', 'caso_masc_000004_22594676.docx', 'masculinidades_certificados/caso_masc_000004_22594676.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 8421, 0, '80bc6eaec587c969dbe3dcd001cade3294d9d10359444c1c6146bf838a6d33d9', 3, 0, NULL, '2026-04-01 12:39:21'),
(18, 'masculinidades', 5, 'caso_masc_000005_39153640.docx', 'caso_masc_000005_39153640.docx', 'masculinidades_certificados/caso_masc_000005_39153640.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 8386, 0, '98eb4b59631002e59f2a3945766b473cde4d2ef024c92346d7e56a9029255075', 9, 0, NULL, '2026-04-01 13:11:11'),
(19, 'genero', 5, 'caso_genero_000005_40780521.docx', 'caso_genero_000005_40780521.docx', 'genero_certificados/caso_genero_000005_40780521.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 8379, 0, '41c9d652f8d12a5094dae7cbbff7c66831f959e37bf911284b40e36fbdc0cebb', 9, 0, NULL, '2026-04-01 13:12:34'),
(20, 'masculinidades', 6, 'caso_masc_000006_37894964.docx', 'caso_masc_000006_37894964.docx', 'masculinidades_certificados/caso_masc_000006_37894964.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 8394, 0, 'c26ae2c528f1cece205334d35035aa2ec2af8237d84ed27ffd4d539140a858c1', 9, 0, NULL, '2026-04-01 13:24:01'),
(21, 'genero', 6, 'caso_genero_000006_36003281.docx', 'caso_genero_000006_36003281.docx', 'genero_certificados/caso_genero_000006_36003281.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 8375, 0, 'f4adf6ff093324b670585da1324af922876051d6ed7025385c67bbf02c520f93', 9, 0, NULL, '2026-04-01 13:27:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adjuntos_descargas`
--

CREATE TABLE `adjuntos_descargas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `adjunto_id` bigint(20) UNSIGNED NOT NULL,
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `fecha_descarga` timestamp NULL DEFAULT current_timestamp(),
  `ip` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `adjuntos_descargas`
--

INSERT INTO `adjuntos_descargas` (`id`, `adjunto_id`, `usuario_id`, `fecha_descarga`, `ip`) VALUES
(1, 2, 7, '2026-03-30 13:03:16', '181.199.144.183');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `area_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `area_user`
--

INSERT INTO `area_user` (`id`, `user_id`, `area_id`) VALUES
(21, 2, 1),
(22, 2, 2),
(23, 2, 3),
(24, 2, 4),
(25, 3, 1),
(26, 3, 2),
(27, 3, 3),
(28, 3, 4),
(29, 4, 1),
(30, 4, 2),
(31, 5, 1),
(32, 6, 1),
(33, 6, 3),
(34, 7, 1),
(35, 8, 1),
(36, 9, 1),
(37, 10, 2),
(38, 11, 2),
(47, 7, 2),
(48, 8, 2),
(49, 6, 2),
(50, 9, 2),
(51, 10, 1),
(52, 11, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `barrio`
--

CREATE TABLE `barrio` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `localidad_id` bigint(20) UNSIGNED NOT NULL,
  `zona_barrio_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
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
  `id` bigint(20) UNSIGNED NOT NULL,
  `persona_id` bigint(20) UNSIGNED NOT NULL,
  `tiene_cud` tinyint(1) NOT NULL DEFAULT 0,
  `numero_cud` varchar(100) DEFAULT NULL,
  `fecha_emision` date DEFAULT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `archivo_adjunto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion_genero_casos`
--

CREATE TABLE `direccion_genero_casos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `persona_id` bigint(20) UNSIGNED NOT NULL,
  `nivel_gravedad` tinyint(4) DEFAULT 2,
  `estado_civil_id` bigint(20) UNSIGNED DEFAULT NULL,
  `genero` varchar(100) DEFAULT NULL,
  `provincia_id` bigint(20) UNSIGNED DEFAULT NULL,
  `localidad_id` bigint(20) UNSIGNED DEFAULT NULL,
  `barrio_id` bigint(20) UNSIGNED DEFAULT NULL,
  `situacion_habitacional_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nivel_estudio_id` bigint(20) UNSIGNED DEFAULT NULL,
  `trabaja` tinyint(1) NOT NULL DEFAULT 0,
  `organizacion_social` tinyint(1) NOT NULL DEFAULT 0,
  `organizacion_social_detalle` varchar(255) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estado_id` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `nivel_riesgo_id` int(10) UNSIGNED DEFAULT NULL,
  `situacion_sanitaria` text DEFAULT NULL,
  `servicios_luz` tinyint(1) DEFAULT 0,
  `servicios_cable` tinyint(1) DEFAULT 0,
  `servicios_gas_natural` tinyint(1) DEFAULT 0,
  `servicios_agua_potable` tinyint(1) DEFAULT 0,
  `servicios_internet` tinyint(1) DEFAULT 0,
  `tipo_violencia_id` bigint(20) DEFAULT NULL,
  `denuncio_antes` tinyint(1) DEFAULT 0,
  `denuncio_antes_detalle` text DEFAULT NULL,
  `amenaza_con_arma` tinyint(1) DEFAULT 0,
  `amenaza_tipo_arma` varchar(100) DEFAULT NULL,
  `fecha_ultima_denuncia` date DEFAULT NULL,
  `boton_panico_numero` varchar(50) DEFAULT NULL,
  `encargado_id` bigint(20) UNSIGNED DEFAULT NULL,
  `agresor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `agresor_trabajo` text DEFAULT NULL,
  `debe_asistir_masculinidades` tinyint(1) DEFAULT 0,
  `medida_cautelar_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `motivo_eliminacion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `direccion_genero_casos`
--

INSERT INTO `direccion_genero_casos` (`id`, `persona_id`, `nivel_gravedad`, `estado_civil_id`, `genero`, `provincia_id`, `localidad_id`, `barrio_id`, `situacion_habitacional_id`, `nivel_estudio_id`, `trabaja`, `organizacion_social`, `organizacion_social_detalle`, `observaciones`, `created_at`, `updated_at`, `estado_id`, `nivel_riesgo_id`, `situacion_sanitaria`, `servicios_luz`, `servicios_cable`, `servicios_gas_natural`, `servicios_agua_potable`, `servicios_internet`, `tipo_violencia_id`, `denuncio_antes`, `denuncio_antes_detalle`, `amenaza_con_arma`, `amenaza_tipo_arma`, `fecha_ultima_denuncia`, `boton_panico_numero`, `encargado_id`, `agresor_id`, `agresor_trabajo`, `debe_asistir_masculinidades`, `medida_cautelar_id`, `deleted_at`, `deleted_by`, `motivo_eliminacion`) VALUES
(1, 1, 3, 5, 'Mujer', 1, 5, 21, NULL, 2, 1, 1, NULL, 'Perimetro vigente hasta el 23/05/26.', '2026-03-30 12:57:36', '2026-03-30 13:27:47', 1, NULL, NULL, 0, 0, 0, 0, 0, 6, 0, NULL, 0, NULL, '2026-03-29', NULL, 4, NULL, NULL, 0, 1, NULL, NULL, NULL),
(2, 2, 3, 1, 'MUJER', 1, 5, 27, 1, 3, 1, 1, NULL, NULL, '2026-03-30 14:02:09', '2026-03-30 14:13:28', 1, NULL, NULL, 1, 1, 1, 1, 1, NULL, 1, 'HOSTIGAMIENTO', 0, NULL, '2026-03-27', NULL, 5, NULL, NULL, 0, 1, NULL, NULL, NULL),
(3, 3, 3, 3, 'Mujer', 1, 5, 55, 1, 2, 1, 1, NULL, 'Solicito perimetro y exclusion del hogar.\r\nTiene 2 hijos en comun (Basualdo Angelina, 16 años de edad y Basualdo Cairo de 3 años de edad. ) con quienes tambien ejerce violencia.\r\nIniciaran Tratamiento psicologico los 3', '2026-03-30 14:09:23', '2026-03-30 14:58:39', 1, NULL, NULL, 0, 0, 0, 0, 0, 3, 0, '25/02/2025', 0, NULL, '2026-03-28', NULL, 4, NULL, NULL, 0, 4, NULL, NULL, NULL),
(4, 9, 1, 4, 'Mujer', 1, 5, 49, 1, 1, 1, 1, NULL, 'atencion telefonica, llamado por parte de Margarita y Brenda', '2026-04-01 12:33:44', '2026-04-01 12:40:47', 1, NULL, NULL, 1, 0, 0, 1, 1, 5, 0, NULL, 0, NULL, '2026-03-31', NULL, 1, NULL, NULL, 0, 1, NULL, NULL, NULL),
(5, 23, 3, 1, NULL, 1, 5, 32, NULL, NULL, 1, 1, NULL, 'Carga de denuncias', '2026-04-01 13:12:34', '2026-04-01 13:12:34', 1, NULL, NULL, 0, 0, 0, 0, 0, NULL, 0, NULL, 0, NULL, NULL, NULL, 6, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(6, 25, 3, 2, 'MUJER', 1, 5, 66, NULL, NULL, 1, 1, NULL, 'Carga de denuncia', '2026-04-01 13:27:45', '2026-04-01 13:27:45', 1, NULL, NULL, 0, 0, 0, 0, 0, NULL, 0, NULL, 0, NULL, NULL, NULL, 6, NULL, NULL, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion_genero_caso_programa`
--

CREATE TABLE `direccion_genero_caso_programa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `caso_id` bigint(20) UNSIGNED NOT NULL,
  `programa_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion_genero_estados`
--

CREATE TABLE `direccion_genero_estados` (
  `id` int(10) UNSIGNED NOT NULL,
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
  `id` bigint(20) UNSIGNED NOT NULL,
  `caso_id` bigint(20) UNSIGNED NOT NULL,
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
  `id` bigint(20) UNSIGNED NOT NULL,
  `caso_id` bigint(20) UNSIGNED NOT NULL,
  `tipo_intervencion_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fecha_intervencion` date NOT NULL,
  `detalle` text DEFAULT NULL COMMENT 'Desarrollo o evolución de la intervención',
  `encargado_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Profesional que interviene',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `direccion_genero_intervenciones`
--

INSERT INTO `direccion_genero_intervenciones` (`id`, `caso_id`, `tipo_intervencion_id`, `fecha_intervencion`, `detalle`, `encargado_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2026-03-30', '.', 4, '2026-03-30 13:03:02', '2026-03-30 13:03:02'),
(2, 1, 2, '2026-03-30', '.', 4, '2026-03-30 13:10:10', '2026-03-30 13:10:10'),
(3, 1, 6, '2026-03-30', NULL, 4, '2026-03-30 13:25:33', '2026-03-30 13:25:33'),
(4, 2, 2, '2026-03-30', NULL, 5, '2026-03-30 14:03:24', '2026-03-30 14:03:24'),
(5, 3, 2, '2026-03-30', NULL, 4, '2026-03-30 14:15:11', '2026-03-30 14:15:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion_genero_niveles_riesgo`
--

CREATE TABLE `direccion_genero_niveles_riesgo` (
  `id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion_genero_red_contencion`
--

CREATE TABLE `direccion_genero_red_contencion` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `caso_id` bigint(20) UNSIGNED NOT NULL,
  `tipo` varchar(100) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encargados`
--

CREATE TABLE `encargados` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `id` bigint(20) UNSIGNED NOT NULL,
  `encargado_id` bigint(20) UNSIGNED NOT NULL,
  `area_id` bigint(20) UNSIGNED NOT NULL
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
(41, 10, 2),
(42, 5, 2),
(43, 4, 2),
(44, 6, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `espacios_grupales`
--

CREATE TABLE `espacios_grupales` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `estados_civiles`
--

INSERT INTO `estados_civiles` (`id`, `nombre`) VALUES
(2, 'Casado'),
(5, 'Divorciado/a'),
(4, 'Separado de hecho'),
(1, 'Soltero'),
(3, 'Unido de hecho');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `intervenciones_totales`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `intervenciones_totales` (
`tipo_intervencion_id` bigint(20) unsigned
,`fecha_intervencion` date
,`encargado_id` bigint(20) unsigned
,`area` varchar(16)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ive_casos`
--

CREATE TABLE `ive_casos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `persona_id` bigint(20) UNSIGNED NOT NULL,
  `fum` date DEFAULT NULL,
  `eco_semanas` int(11) DEFAULT NULL,
  `semanas_gestacion` int(11) DEFAULT NULL,
  `estado_civil_id` bigint(20) UNSIGNED DEFAULT NULL,
  `metodo_interrupcion` varchar(100) DEFAULT NULL,
  `obra_social` tinyint(1) NOT NULL DEFAULT 0,
  `cantidad_hijos` int(11) DEFAULT 0,
  `interrupcion_previa` tinyint(1) NOT NULL DEFAULT 0,
  `violencia_previa` tinyint(1) NOT NULL DEFAULT 0,
  `alta` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `encargado_id` bigint(20) UNSIGNED DEFAULT NULL,
  `metodo_interrupcion_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `motivo_eliminacion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ive_casos`
--

INSERT INTO `ive_casos` (`id`, `persona_id`, `fum`, `eco_semanas`, `semanas_gestacion`, `estado_civil_id`, `metodo_interrupcion`, `obra_social`, `cantidad_hijos`, `interrupcion_previa`, `violencia_previa`, `alta`, `created_at`, `updated_at`, `encargado_id`, `metodo_interrupcion_id`, `deleted_at`, `deleted_by`, `motivo_eliminacion`) VALUES
(1, 7, '2025-12-18', NULL, 11, 1, NULL, 1, 0, 0, 0, NULL, '2026-03-31 13:07:56', '2026-03-31 13:07:56', 4, 1, NULL, NULL, NULL),
(2, 8, '2025-12-20', NULL, 11, 1, NULL, 0, 1, 0, 0, NULL, '2026-03-31 13:16:31', '2026-03-31 13:16:31', 4, 1, NULL, NULL, NULL),
(3, 16, '2026-01-06', NULL, 9, 1, NULL, 0, 0, 0, 0, NULL, '2026-03-31 13:54:35', '2026-03-31 13:54:35', 4, 1, NULL, NULL, NULL),
(4, 18, '2026-01-03', 7, 7, 2, NULL, 0, 3, 0, 0, NULL, '2026-03-31 14:10:54', '2026-03-31 14:10:54', 4, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ive_caso_red`
--

CREATE TABLE `ive_caso_red` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ive_caso_id` bigint(20) UNSIGNED NOT NULL,
  `red_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ive_caso_red`
--

INSERT INTO `ive_caso_red` (`id`, `ive_caso_id`, `red_id`) VALUES
(30, 1, 1),
(31, 2, 3),
(32, 3, 1),
(33, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ive_caso_user`
--

CREATE TABLE `ive_caso_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ive_caso_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ive_caso_violencia`
--

CREATE TABLE `ive_caso_violencia` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ive_caso_id` bigint(20) UNSIGNED NOT NULL,
  `tipo_violencia_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ive_intervenciones`
--

CREATE TABLE `ive_intervenciones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ive_caso_id` bigint(20) UNSIGNED NOT NULL,
  `tipo_intervencion_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fecha_intervencion` date NOT NULL,
  `detalle` text DEFAULT NULL COMMENT 'Desarrollo o evolución de la intervención',
  `encargado_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Profesional que interviene',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ive_intervenciones`
--

INSERT INTO `ive_intervenciones` (`id`, `ive_caso_id`, `tipo_intervencion_id`, `fecha_intervencion`, `detalle`, `encargado_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2026-03-31', 'La misma se encuentra cursando un embarazo de 11 semanas.\r\ncuenta con cobertura medica Municipal.', 4, '2026-03-31 13:09:48', '2026-03-31 13:09:48'),
(2, 2, 1, '2026-03-31', 'Realizo interrupción el 17/03/2026 con eco de control el 25/03/26.\r\nEl día de hoy 31/03, se dio dosis del incompleto, con eco de control 06/04.        \r\ncuenta con cobertura medica municipal.', 4, '2026-03-31 13:19:03', '2026-03-31 13:19:03'),
(3, 3, 1, '2026-03-31', 'Realiza interrupción y eco de control 08/04/26.', 4, '2026-03-31 13:55:41', '2026-03-31 13:55:41'),
(4, 4, 1, '2026-03-31', 'realiza interrupción, eco control 08/04/2026.\r\ncuenta con cobertura medica municipal.', 4, '2026-03-31 14:12:20', '2026-03-31 14:12:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ive_medicaciones`
--

CREATE TABLE `ive_medicaciones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ive_caso_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `numero_lote` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ive_medicaciones`
--

INSERT INTO `ive_medicaciones` (`id`, `ive_caso_id`, `nombre`, `numero_lote`) VALUES
(1, 1, 'Misoprostol Lif', '11925'),
(3, 3, 'Misoprostol Lif', '11925'),
(4, 2, 'Misoprostol Lif', '11925'),
(5, 4, 'Misoprostol Lif', '11925');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidad`
--

CREATE TABLE `localidad` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `codigo_postal` int(11) NOT NULL,
  `provincia_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
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
  `id` bigint(20) UNSIGNED NOT NULL,
  `persona_id` bigint(20) UNSIGNED NOT NULL,
  `nivel_gravedad` tinyint(4) DEFAULT 2,
  `victima_id` bigint(20) UNSIGNED DEFAULT NULL,
  `derivacion_id` bigint(20) UNSIGNED NOT NULL,
  `situacion_habitacional_id` bigint(20) UNSIGNED DEFAULT NULL,
  `trabaja` tinyint(1) NOT NULL DEFAULT 0,
  `detalle_trabajo` varchar(255) DEFAULT NULL,
  `red_contencion` tinyint(1) NOT NULL DEFAULT 0,
  `situacion_sanitaria_id` bigint(20) UNSIGNED DEFAULT NULL,
  `consumo` tinyint(1) NOT NULL DEFAULT 0,
  `terapia` tinyint(1) NOT NULL DEFAULT 0,
  `espacio_grupal_id` bigint(20) UNSIGNED DEFAULT NULL,
  `situacion_judicial` text DEFAULT NULL,
  `desobediencia` tinyint(1) DEFAULT 0,
  `reincidencia` int(11) DEFAULT 0,
  `asistencia_dispositivo` int(11) DEFAULT 0,
  `observaciones` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `encargado_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fecha_finalizacion` date DEFAULT NULL,
  `debe_dispositivo` tinyint(1) DEFAULT 0,
  `nivel_estudio_id` bigint(20) UNSIGNED DEFAULT NULL,
  `estado_civil_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `motivo_eliminacion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `masculinidades_casos`
--

INSERT INTO `masculinidades_casos` (`id`, `persona_id`, `nivel_gravedad`, `victima_id`, `derivacion_id`, `situacion_habitacional_id`, `trabaja`, `detalle_trabajo`, `red_contencion`, `situacion_sanitaria_id`, `consumo`, `terapia`, `espacio_grupal_id`, `situacion_judicial`, `desobediencia`, `reincidencia`, `asistencia_dispositivo`, `observaciones`, `created_at`, `updated_at`, `encargado_id`, `fecha_finalizacion`, `debe_dispositivo`, `nivel_estudio_id`, `estado_civil_id`, `deleted_at`, `deleted_by`, `motivo_eliminacion`) VALUES
(1, 4, 2, NULL, 3, 1, 0, NULL, 0, NULL, 0, 0, NULL, NULL, 0, 0, NULL, NULL, '2026-03-30 14:40:16', '2026-03-30 14:40:16', 5, NULL, 0, NULL, 1, NULL, NULL, NULL),
(2, 5, 2, NULL, 3, 1, 1, NULL, 0, NULL, 0, 0, NULL, NULL, 1, 0, NULL, NULL, '2026-03-30 14:46:33', '2026-03-30 14:46:33', 4, NULL, 0, NULL, 1, NULL, NULL, NULL),
(3, 6, 2, NULL, 3, 1, 1, NULL, 0, NULL, 1, 0, NULL, NULL, 0, 0, NULL, NULL, '2026-03-30 14:54:33', '2026-03-30 14:54:33', 4, NULL, 0, 2, 3, NULL, NULL, NULL),
(4, 22, 2, NULL, 3, 1, 1, 'Independiente', 0, NULL, 0, 0, NULL, NULL, 0, 0, NULL, NULL, '2026-04-01 12:39:21', '2026-04-01 12:39:21', 3, NULL, 0, 6, 4, NULL, NULL, NULL),
(5, 24, 2, NULL, 3, 4, 0, NULL, 0, NULL, 0, 0, NULL, NULL, 0, 0, NULL, NULL, '2026-04-01 13:11:11', '2026-04-01 13:11:11', 5, NULL, 0, NULL, NULL, NULL, NULL, NULL),
(6, 26, 2, NULL, 2, NULL, 0, NULL, 0, NULL, 0, 0, NULL, NULL, 0, 0, NULL, NULL, '2026-04-01 13:24:01', '2026-04-01 13:24:01', 5, NULL, 0, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `masculinidades_caso_medida`
--

CREATE TABLE `masculinidades_caso_medida` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `caso_id` bigint(20) UNSIGNED NOT NULL,
  `medida_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `masculinidades_caso_medida`
--

INSERT INTO `masculinidades_caso_medida` (`id`, `caso_id`, `medida_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 4),
(4, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `masculinidades_caso_violencia`
--

CREATE TABLE `masculinidades_caso_violencia` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `caso_id` bigint(20) UNSIGNED NOT NULL,
  `tipo_violencia_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `masculinidades_caso_violencia`
--

INSERT INTO `masculinidades_caso_violencia` (`id`, `caso_id`, `tipo_violencia_id`) VALUES
(1, 1, 5),
(2, 2, 6),
(3, 3, 3),
(4, 4, 5),
(5, 4, 8),
(6, 5, 5),
(7, 6, 2),
(8, 6, 3),
(9, 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `masculinidades_derivaciones`
--

CREATE TABLE `masculinidades_derivaciones` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `id` bigint(20) UNSIGNED NOT NULL,
  `caso_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `apellido` varchar(150) NOT NULL,
  `dni` varchar(20) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `vinculo_actual` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `masculinidades_intervenciones`
--

CREATE TABLE `masculinidades_intervenciones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `caso_id` bigint(20) UNSIGNED NOT NULL,
  `tipo_intervencion_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fecha_intervencion` date NOT NULL,
  `detalle` text DEFAULT NULL COMMENT 'Desarrollo o evolución de la intervención',
  `encargado_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Profesional que interviene',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `masculinidades_tipos_violencia`
--

CREATE TABLE `masculinidades_tipos_violencia` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `medidas_cautelares`
--

INSERT INTO `medidas_cautelares` (`id`, `nombre`) VALUES
(2, 'Boton de panico'),
(4, 'Perímetro y Exclusión'),
(1, 'Perimetros'),
(3, 'Recorridas dinamicas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodos_interrupcion`
--

CREATE TABLE `metodos_interrupcion` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
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
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
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
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(150) DEFAULT NULL,
  `apellido` varchar(150) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `dni` varchar(20) DEFAULT NULL,
  `sexo` enum('Masculino','Femenino','Otro') DEFAULT NULL,
  `agresor` tinyint(1) DEFAULT 0,
  `victima` tinyint(1) DEFAULT 0,
  `domicilio` varchar(255) DEFAULT NULL,
  `provincia_id` bigint(20) UNSIGNED DEFAULT NULL,
  `localidad_id` bigint(20) UNSIGNED DEFAULT NULL,
  `barrio_id` bigint(20) UNSIGNED DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `nivel_estudio_id` bigint(20) UNSIGNED DEFAULT NULL,
  `trabaja` tinyint(1) DEFAULT 0,
  `grupo_sanguineo` varchar(5) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `debe_asistir_masculinidades` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `nombre`, `apellido`, `fecha_nacimiento`, `dni`, `sexo`, `agresor`, `victima`, `domicilio`, `provincia_id`, `localidad_id`, `barrio_id`, `telefono`, `nivel_estudio_id`, `trabaja`, `grupo_sanguineo`, `created_at`, `updated_at`, `debe_asistir_masculinidades`) VALUES
(1, 'Vanesa Elizabeth', 'Banegas', '1980-06-13', '28276004', 'Femenino', 0, 1, 'Soler 501', 1, 5, 21, '3364647190', NULL, 0, NULL, '2026-03-30 12:52:18', '2026-03-30 12:52:18', 0),
(2, 'CRISTINA LUJAN', 'SUAREZ', '1981-08-01', '28315193', 'Femenino', 0, 1, 'DON BOSCO 386', 1, 5, 27, '336205017', 3, 1, NULL, '2026-03-30 13:57:55', '2026-03-30 13:57:55', 0),
(3, 'Noelia Elizabet', 'Alegre', '1998-07-06', '36053945', 'Femenino', 0, 1, 'Goitia 1153', 1, 5, 55, '3364379132', 2, 1, NULL, '2026-03-30 14:03:32', '2026-03-30 14:03:32', 0),
(4, 'MARTIN SEBASTIAN', 'GODOY', '1982-09-27', '30026939', 'Masculino', 1, 0, 'DON BOSCO 430', 1, 5, 27, '3364398286', NULL, 1, NULL, '2026-03-30 14:09:08', '2026-03-30 14:09:08', 0),
(5, 'LEONEL SEBASTIAN', 'ACEVEDO', '1988-06-10', '33.552.168', 'Masculino', 1, 0, 'Alberdi Nro. 824', 1, 5, NULL, NULL, NULL, 1, NULL, '2026-03-30 14:43:40', '2026-03-30 14:43:40', 0),
(6, 'MARCELO GABRIEL', 'BASUALDO', '1980-09-12', '28.276.764', 'Masculino', 1, 0, 'Pedro Goitia 1153', 1, 5, 55, '3364655284', 2, 1, NULL, '2026-03-30 14:51:43', '2026-03-30 14:51:43', 0),
(7, 'Camila Aldana', 'Godoy', '2001-05-05', '43313566', 'Femenino', 0, 1, 'Benítez 1783', 1, 5, 78, '3364202811', 2, 1, NULL, '2026-03-31 13:06:21', '2026-03-31 13:06:21', 0),
(8, 'Daiana Soledad', 'Silveyra', '2003-02-05', '44519359', 'Femenino', 0, 1, 'Acevedo 2036', 1, 5, 78, '3407475036', 2, 0, NULL, '2026-03-31 13:14:45', '2026-03-31 13:14:45', 0),
(9, 'MELISA SOLEDAD', 'CONTRERAS', '1988-08-03', '33803692', 'Femenino', 0, 1, NULL, NULL, 5, 49, NULL, NULL, 0, NULL, '2026-03-31 13:22:16', '2026-03-31 13:22:16', 0),
(10, 'DOMINGO DANIEL', 'MENDOZA', '1972-03-12', '22594676', 'Masculino', 1, 0, 'LEON GURCIAGA 1122', 1, 5, 49, NULL, NULL, 1, NULL, '2026-03-31 13:25:22', '2026-03-31 13:25:22', 0),
(11, 'MILAGRO DANIELA', 'BARRIOS', '2005-07-08', '46359438', 'Femenino', 0, 1, 'CHACABUCO 1369', 1, 5, 5, '3364366785', NULL, 0, NULL, '2026-03-31 13:30:18', '2026-03-31 13:30:18', 0),
(12, 'silvia alicia', 'musante', '1950-10-17', '6406596', 'Femenino', 0, 1, 'alvear 498', 1, 5, NULL, '3364318139', NULL, 0, NULL, '2026-03-31 13:44:11', '2026-03-31 13:44:11', 0),
(13, 'hector manuel', 'velazquez', '1945-10-27', '4693180', 'Masculino', 1, 0, 'FRANCISCO ABACA 307', 1, 5, 89, NULL, NULL, 0, NULL, '2026-03-31 13:47:06', '2026-03-31 13:47:06', 0),
(14, 'CINTIA MARIANA', 'OLTENDORFS', '1979-11-12', '27742912', 'Femenino', 0, 1, 'ROCCA 732', 1, 5, 66, '3364242130', NULL, 1, NULL, '2026-03-31 13:49:43', '2026-03-31 13:49:43', 0),
(15, 'CLAUDIO DAVID', 'MORA', NULL, '0000000', 'Masculino', 1, 0, 'CHACABUCO 1369', 1, 5, 5, '3364366785', NULL, 0, NULL, '2026-03-31 13:51:28', '2026-03-31 13:51:28', 0),
(16, 'Micaela Mariel', 'Brets', '2002-11-03', '44416459', 'Femenino', 0, 0, 'Brasil 429 bis', 1, 5, 14, '3364352689', 3, 0, NULL, '2026-03-31 13:53:43', '2026-03-31 13:53:43', 0),
(17, 'ALEJANDRO LEONEL', 'CRESPO', '1972-10-16', '22954398', 'Masculino', 1, 0, 'VICTORIA 605', 1, 5, NULL, '3364294938', NULL, 1, NULL, '2026-03-31 13:55:21', '2026-03-31 13:55:21', 0),
(18, 'Roció Belen', 'Alarcon', '1996-08-28', '39710780', 'Femenino', 0, 0, 'San Luis 251', 1, 5, 42, '3364669694', 6, 0, NULL, '2026-03-31 14:08:47', '2026-03-31 14:08:47', 0),
(19, 'LEONELA GRISELDA', 'AVALOS', '1978-08-10', '26761467', 'Femenino', 0, 1, 'ECHEVERRIA 604', 1, 5, 19, '3364676568', NULL, 0, NULL, '2026-03-31 14:10:30', '2026-03-31 14:10:30', 0),
(20, 'FRANCISCO NAHUEL', 'PAREDES', '1999-10-05', 'OO', 'Masculino', 1, 0, NULL, 1, 5, NULL, '3364179429', NULL, 1, NULL, '2026-03-31 14:13:11', '2026-03-31 14:13:11', 0),
(21, 'sebastian', 'valdez', '1981-04-10', '28770399', 'Masculino', 1, 0, 'chacabuco 554', 1, 5, 18, '3364663351', 6, 1, NULL, '2026-03-31 18:55:59', '2026-03-31 18:55:59', 1),
(22, 'Domimgo', 'Mendoza', '1972-01-12', '22.594.676', 'Masculino', 1, 1, 'León Guruciaga N° 1622', 1, 5, 49, 'No posee', 6, 1, NULL, '2026-04-01 12:37:33', '2026-04-01 12:37:33', 0),
(23, 'MICAELA VICTORIA', 'CELESTINO', '1997-11-25', '40780521', 'Femenino', 0, 1, 'Montevideo 9', 1, 5, 32, '3364187775', NULL, 1, NULL, '2026-04-01 13:03:35', '2026-04-01 13:03:35', 0),
(24, 'BRAIAN LUIS', 'SUAREZ', NULL, '39153640', 'Masculino', 1, 0, 'Ascasubi N° 364', 1, 5, 39, '3364581620', NULL, 0, NULL, '2026-04-01 13:07:20', '2026-04-01 13:07:20', 0),
(25, 'EVELIN YANIL', 'CABRAL', '1991-01-21', '36003281', 'Femenino', 0, 1, 'Pringles 463', 1, 5, 66, '3364024874', NULL, 1, NULL, '2026-04-01 13:15:53', '2026-04-01 13:15:53', 0),
(26, 'CARLOS FERNANDO', 'CAÑETE', '1993-12-11', '37894964', 'Masculino', 1, 0, 'Pringles 463', 1, 5, 66, '3364701582', NULL, 1, NULL, '2026-04-01 13:18:58', '2026-04-01 13:18:58', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programas_asistencia`
--

CREATE TABLE `programas_asistencia` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
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
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
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
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tipos_intervencion`
--

INSERT INTO `tipos_intervencion` (`id`, `nombre`) VALUES
(4, 'Asesoramiento legal'),
(6, 'Denuncia Policial'),
(5, 'Derivación institucional'),
(1, 'Entrevista presencial'),
(2, 'Llamado telefónico'),
(3, 'Visita domiciliaria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_violencia`
--

CREATE TABLE `tipos_violencia` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
(8, 'Verbal'),
(7, 'Vicaria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `rol_id` bigint(20) UNSIGNED NOT NULL DEFAULT 3,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nombre`, `apellido`, `email`, `email_verified_at`, `rol_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'direcciongenero', '$2y$12$SXWuVNF6e1cmkk6n0X0wY.iaIjKKSw/5u290ENjDzUilFTy0d0ouG', 'Dirección', 'Género', 'denunciasviolenciasn@gmail.com', NULL, 2, NULL, '2026-03-19 13:35:52', '2026-03-19 13:35:52'),
(2, 'betereteflorencia', '$2y$12$UTdBiJ6jZ6e79Z4PLKzvZ.V2168M28Ok5Oz.HNb1kfLlj164UjKPK', 'Florencia', 'Beterete', 'florencia_beterete@hotmail.com', NULL, 2, NULL, '2026-03-18 15:50:15', '2026-03-18 16:17:57'),
(3, 'robertocoronel', '$2y$12$FPT2ALwtuj5FWKBfy0X9du/ma3BhVfKsS38P5QqpH1Ssq26dTA6Ue', 'Roberto', 'Coronel', 'robertodcoronel@hotmail.com', NULL, 2, NULL, '2026-03-18 15:53:24', '2026-03-18 16:18:20'),
(4, 'margaritaromero', '$2y$12$373BtzvtvbUzacMBFTg4Ze23kflfxW/wwNfJ7Ol73E/PT2jxhmSFy', 'Margarita', 'Romero', 'margaromero87@hotmail.com', NULL, 1, NULL, '2026-03-18 15:54:56', '2026-03-18 16:18:37'),
(5, 'julianabrett', '$2y$12$e6HfmGpS8zuSRX5TMJBMyO5wH21pnXhoLNgINsRlHV15lty0Dx3aq', 'Juliana', 'Brett', 'julianabrett_9@hotmail.com', NULL, 1, NULL, '2026-03-18 15:56:35', '2026-03-18 16:18:53'),
(6, 'jenniferbaez', '$2y$12$HjSHDTvQyU/gYnuJt5YJ6.3BtGVXWZ1KYvweA2R2KkQ6MITbRWA/O', 'Jennifer', 'Baez', 'baezjennifer303@gmail.com', NULL, 1, NULL, '2026-03-18 16:02:11', '2026-03-18 16:19:10'),
(7, 'brunomassocco', '$2y$12$93OVGrO19AcnY8SO4ACe/uBsiLZtTKt6tCpT7KFxQJkUZBl79PvXO', 'Bruno', 'Massocco', 'brunoo6.massocco@gmail.com', NULL, 1, NULL, '2026-03-18 16:09:56', '2026-03-18 16:19:22'),
(8, 'yaelbuchert', '$2y$12$T0ex6/018GrSnkRr.007gOoydgMmQ8Uc6nESwwEIVcqSB.bIAe6Ci', 'Yael', 'Buchert', 'yaelbuchert@hotmail.com', NULL, 1, NULL, '2026-03-18 16:11:32', '2026-03-18 16:19:44'),
(9, 'brendabuchert', '$2y$12$Ylii0u4MNwEiQbPwu5t2jODBzy8YUi2BycxGnyf1Hp21GGeVRx..W', 'brenda', 'buchert', 'brenda_buchert@hotmail.com', NULL, 1, NULL, '2026-03-18 16:12:58', '2026-03-18 16:19:54'),
(10, 'florenciaramos', '$2y$12$r5CqKD.z6tiYvh9al6.qJ.B9a5ZB.Pu.CN8u23OTG6o9UGIh8CR12', 'Florencia', 'Ramos', 'florramos86@gmail.com', NULL, 1, NULL, '2026-03-18 16:13:54', '2026-03-18 16:20:09'),
(11, 'julietamaccarrone', '$2y$12$9InOXwkkg9iUTtAA7EWDlO1f2Z9JP2JK5tW0KAmMkjJi8ZFg0nUTW', 'Julieta', 'Maccarrone', 'julietamaccarrone09@gmail.com', NULL, 1, NULL, '2026-03-18 16:15:38', '2026-03-18 16:20:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vinculos_casos`
--

CREATE TABLE `vinculos_casos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `genero_caso_id` bigint(20) UNSIGNED NOT NULL COMMENT 'ID del caso en Direccion Genero (Victima)',
  `masculinidad_caso_id` bigint(20) UNSIGNED NOT NULL COMMENT 'ID del caso en Masculinidades (Agresor)',
  `hijos_en_comun` int(11) DEFAULT 0,
  `relacion_actual` tinyint(1) DEFAULT 0,
  `descripcion_relacion` text DEFAULT NULL,
  `tipo_vinculo` varchar(100) DEFAULT NULL COMMENT 'Ej: Pareja, Ex-pareja, Conviviente, Progenitor',
  `observaciones` text DEFAULT NULL,
  `fecha_vinculacion` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `vinculos_casos`
--

INSERT INTO `vinculos_casos` (`id`, `genero_caso_id`, `masculinidad_caso_id`, `hijos_en_comun`, `relacion_actual`, `descripcion_relacion`, `tipo_vinculo`, `observaciones`, `fecha_vinculacion`) VALUES
(1, 2, 1, 0, 0, NULL, NULL, NULL, '2026-03-30 14:40:58'),
(2, 4, 4, 5, 0, NULL, NULL, NULL, '2026-04-01 12:40:15'),
(3, 5, 5, 0, 0, NULL, NULL, NULL, '2026-04-01 13:12:34'),
(4, 6, 6, 3, 0, NULL, NULL, NULL, '2026-04-01 13:27:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zona_barrio`
--

CREATE TABLE `zona_barrio` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
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
  ADD KEY `fk_direccion_genero_medidas` (`medida_cautelar_id`),
  ADD KEY `fk_genero_deleted_by` (`deleted_by`);

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
  ADD KEY `fk_metodo_interrupcion` (`metodo_interrupcion_id`),
  ADD KEY `fk_ive_deleted_by` (`deleted_by`);

--
-- Indices de la tabla `ive_caso_red`
--
ALTER TABLE `ive_caso_red`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ive_caso_id` (`ive_caso_id`),
  ADD KEY `red_id` (`red_id`);

--
-- Indices de la tabla `ive_caso_user`
--
ALTER TABLE `ive_caso_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ive_caso_id` (`ive_caso_id`);

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
  ADD KEY `fk_masc_estado` (`estado_civil_id`),
  ADD KEY `fk_masculinidades_deleted_by` (`deleted_by`);

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
  ADD UNIQUE KEY `dni` (`dni`),
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `adjuntos_descargas`
--
ALTER TABLE `adjuntos_descargas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `area_user`
--
ALTER TABLE `area_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `barrio`
--
ALTER TABLE `barrio`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT de la tabla `cud`
--
ALTER TABLE `cud`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `direccion_genero_casos`
--
ALTER TABLE `direccion_genero_casos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `direccion_genero_caso_programa`
--
ALTER TABLE `direccion_genero_caso_programa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `direccion_genero_estados`
--
ALTER TABLE `direccion_genero_estados`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `direccion_genero_grupo_conviviente`
--
ALTER TABLE `direccion_genero_grupo_conviviente`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `direccion_genero_intervenciones`
--
ALTER TABLE `direccion_genero_intervenciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `direccion_genero_niveles_riesgo`
--
ALTER TABLE `direccion_genero_niveles_riesgo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `direccion_genero_red_contencion`
--
ALTER TABLE `direccion_genero_red_contencion`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `encargados`
--
ALTER TABLE `encargados`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `encargado_area`
--
ALTER TABLE `encargado_area`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `espacios_grupales`
--
ALTER TABLE `espacios_grupales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `estados_civiles`
--
ALTER TABLE `estados_civiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ive_casos`
--
ALTER TABLE `ive_casos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ive_caso_red`
--
ALTER TABLE `ive_caso_red`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `ive_caso_user`
--
ALTER TABLE `ive_caso_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `ive_caso_violencia`
--
ALTER TABLE `ive_caso_violencia`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ive_intervenciones`
--
ALTER TABLE `ive_intervenciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ive_medicaciones`
--
ALTER TABLE `ive_medicaciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `localidad`
--
ALTER TABLE `localidad`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT de la tabla `masculinidades_casos`
--
ALTER TABLE `masculinidades_casos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `masculinidades_caso_medida`
--
ALTER TABLE `masculinidades_caso_medida`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `masculinidades_caso_violencia`
--
ALTER TABLE `masculinidades_caso_violencia`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `masculinidades_derivaciones`
--
ALTER TABLE `masculinidades_derivaciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `masculinidades_grupo_familiar`
--
ALTER TABLE `masculinidades_grupo_familiar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `masculinidades_intervenciones`
--
ALTER TABLE `masculinidades_intervenciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `masculinidades_tipos_violencia`
--
ALTER TABLE `masculinidades_tipos_violencia`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `medidas_cautelares`
--
ALTER TABLE `medidas_cautelares`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `metodos_interrupcion`
--
ALTER TABLE `metodos_interrupcion`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `niveles_estudio`
--
ALTER TABLE `niveles_estudio`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `programas_asistencia`
--
ALTER TABLE `programas_asistencia`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `provincia`
--
ALTER TABLE `provincia`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `red_contencion`
--
ALTER TABLE `red_contencion`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `situaciones_habitacionales`
--
ALTER TABLE `situaciones_habitacionales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `situaciones_sanitarias`
--
ALTER TABLE `situaciones_sanitarias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tipos_intervencion`
--
ALTER TABLE `tipos_intervencion`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tipos_violencia`
--
ALTER TABLE `tipos_violencia`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `vinculos_casos`
--
ALTER TABLE `vinculos_casos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `zona_barrio`
--
ALTER TABLE `zona_barrio`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

-- --------------------------------------------------------

--
-- Estructura para la vista `intervenciones_totales`
--
DROP TABLE IF EXISTS `intervenciones_totales`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u510203833_genero2026`@`127.0.0.1` SQL SECURITY DEFINER VIEW `intervenciones_totales`  AS SELECT `direccion_genero_intervenciones`.`tipo_intervencion_id` AS `tipo_intervencion_id`, `direccion_genero_intervenciones`.`fecha_intervencion` AS `fecha_intervencion`, `direccion_genero_intervenciones`.`encargado_id` AS `encargado_id`, 'direccion_genero' AS `area` FROM `direccion_genero_intervenciones`union all select `ive_intervenciones`.`tipo_intervencion_id` AS `tipo_intervencion_id`,`ive_intervenciones`.`fecha_intervencion` AS `fecha_intervencion`,`ive_intervenciones`.`encargado_id` AS `encargado_id`,'ive' AS `area` from `ive_intervenciones` union all select `masculinidades_intervenciones`.`tipo_intervencion_id` AS `tipo_intervencion_id`,`masculinidades_intervenciones`.`fecha_intervencion` AS `fecha_intervencion`,`masculinidades_intervenciones`.`encargado_id` AS `encargado_id`,'masculinidades' AS `area` from `masculinidades_intervenciones`  ;

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
  ADD CONSTRAINT `fk_genero_deleted_by` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_genero_encargado` FOREIGN KEY (`encargado_id`) REFERENCES `encargados` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `direccion_genero_caso_programa`
--
ALTER TABLE `direccion_genero_caso_programa`
  ADD CONSTRAINT `direccion_genero_caso_programa_ibfk_1` FOREIGN KEY (`caso_id`) REFERENCES `direccion_genero_casos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `direccion_genero_caso_programa_ibfk_2` FOREIGN KEY (`programa_id`) REFERENCES `programas_asistencia` (`id`) ON UPDATE CASCADE;

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
  ADD CONSTRAINT `dg_interv_encargado_fk` FOREIGN KEY (`encargado_id`) REFERENCES `encargados` (`id`) ON UPDATE CASCADE,
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
  ADD CONSTRAINT `fk_ive_deleted_by` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
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
-- Filtros para la tabla `ive_caso_user`
--
ALTER TABLE `ive_caso_user`
  ADD CONSTRAINT `ive_caso_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ive_caso_user_ibfk_2` FOREIGN KEY (`ive_caso_id`) REFERENCES `ive_casos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `ive_caso_violencia`
--
ALTER TABLE `ive_caso_violencia`
  ADD CONSTRAINT `ive_caso_violencia_ibfk_1` FOREIGN KEY (`ive_caso_id`) REFERENCES `ive_casos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ive_caso_violencia_ibfk_2` FOREIGN KEY (`tipo_violencia_id`) REFERENCES `tipos_violencia` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `ive_intervenciones`
--
ALTER TABLE `ive_intervenciones`
  ADD CONSTRAINT `ive_interv_caso_fk` FOREIGN KEY (`ive_caso_id`) REFERENCES `ive_casos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ive_interv_encargado_fk` FOREIGN KEY (`encargado_id`) REFERENCES `encargados` (`id`) ON UPDATE CASCADE,
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
  ADD CONSTRAINT `fk_masculinidades_deleted_by` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `masculinidades_casos_ibfk_1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `masculinidades_casos_ibfk_2` FOREIGN KEY (`victima_id`) REFERENCES `personas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `masculinidades_casos_ibfk_3` FOREIGN KEY (`derivacion_id`) REFERENCES `masculinidades_derivaciones` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `masculinidades_casos_ibfk_4` FOREIGN KEY (`situacion_habitacional_id`) REFERENCES `situaciones_habitacionales` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `masculinidades_casos_ibfk_6` FOREIGN KEY (`situacion_sanitaria_id`) REFERENCES `situaciones_sanitarias` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `masculinidades_casos_ibfk_7` FOREIGN KEY (`espacio_grupal_id`) REFERENCES `espacios_grupales` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `masculinidades_caso_medida`
--
ALTER TABLE `masculinidades_caso_medida`
  ADD CONSTRAINT `masculinidades_caso_medida_ibfk_1` FOREIGN KEY (`caso_id`) REFERENCES `masculinidades_casos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `masculinidades_caso_medida_ibfk_2` FOREIGN KEY (`medida_id`) REFERENCES `medidas_cautelares` (`id`) ON UPDATE CASCADE;

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
  ADD CONSTRAINT `masc_interv_encargado_fk` FOREIGN KEY (`encargado_id`) REFERENCES `encargados` (`id`) ON UPDATE CASCADE,
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
  ADD CONSTRAINT `users_rol_id_foreign` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE;

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
