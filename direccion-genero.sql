-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 09-03-2026 a las 00:14:52
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
  `nivel_estudio_id` bigint UNSIGNED DEFAULT NULL,
  `trabaja` tinyint(1) DEFAULT '0',
  `organizacion_social` tinyint(1) DEFAULT '0',
  `organizacion_social_detalle` varchar(255) DEFAULT NULL,
  `observaciones` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `estado_id` int UNSIGNED DEFAULT '1',
  `nivel_riesgo_id` int UNSIGNED DEFAULT NULL,
  `situacion_sanitaria` text,
  `situacion_habitacional` text,
  `servicios_luz` tinyint(1) DEFAULT '0',
  `servicios_cable` tinyint(1) DEFAULT '0',
  `servicios_gas_natural` tinyint(1) DEFAULT '0',
  `servicios_agua_potable` tinyint(1) DEFAULT '0',
  `servicios_internet` tinyint(1) DEFAULT '0',
  `tipo_violencia` varchar(100) DEFAULT NULL,
  `denuncio_antes` tinyint(1) DEFAULT '0',
  `denuncio_antes_detalle` text,
  `amenaza_con_arma` tinyint(1) DEFAULT '0',
  `amenaza_tipo_arma` varchar(100) DEFAULT NULL,
  `fecha_ultima_denuncia` date DEFAULT NULL,
  `medida_proteccion` varchar(150) DEFAULT NULL,
  `boton_panico_numero` varchar(50) DEFAULT NULL,
  `encargado_id` bigint UNSIGNED DEFAULT NULL,
  `agresor_id` bigint UNSIGNED DEFAULT NULL,
  `debe_asistir_masculinidades` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `direccion_genero_casos`
--

INSERT INTO `direccion_genero_casos` (`id`, `persona_id`, `estado_civil_id`, `genero`, `provincia_id`, `localidad_id`, `barrio_id`, `nivel_estudio_id`, `trabaja`, `organizacion_social`, `organizacion_social_detalle`, `observaciones`, `created_at`, `updated_at`, `estado_id`, `nivel_riesgo_id`, `situacion_sanitaria`, `situacion_habitacional`, `servicios_luz`, `servicios_cable`, `servicios_gas_natural`, `servicios_agua_potable`, `servicios_internet`, `tipo_violencia`, `denuncio_antes`, `denuncio_antes_detalle`, `amenaza_con_arma`, `amenaza_tipo_arma`, `fecha_ultima_denuncia`, `medida_proteccion`, `boton_panico_numero`, `encargado_id`, `agresor_id`, `debe_asistir_masculinidades`) VALUES
(2, 97, 2, 'MUJER', 1, 36, 99, 1, 1, 1, 'no se', 'a', '2026-03-07 17:08:22', '2026-03-07 17:08:22', 1, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 1, NULL, 0),
(3, 103, 2, 'MUJER', NULL, 5, 63, 1, 0, 0, NULL, NULL, '2026-03-09 00:10:54', '2026-03-09 01:21:25', 1, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, 102, 1);

--
-- Índices para tablas volcadas
--

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
  ADD KEY `fk_agresor` (`agresor_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `direccion_genero_casos`
--
ALTER TABLE `direccion_genero_casos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

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
  ADD CONSTRAINT `fk_agresor` FOREIGN KEY (`agresor_id`) REFERENCES `personas` (`id`),
  ADD CONSTRAINT `fk_genero_encargado` FOREIGN KEY (`encargado_id`) REFERENCES `encargados` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
