CREATE DATABASE IF NOT EXISTS `direccion-genero`
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE `direccion-genero`;

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS masculinidades_caso_violencia;
DROP TABLE IF EXISTS masculinidades_caso_medida;
DROP TABLE IF EXISTS masculinidades_grupo_familiar;
DROP TABLE IF EXISTS masculinidades_casos;
DROP TABLE IF EXISTS masculinidades_tipos_violencia;
DROP TABLE IF EXISTS medidas_cautelares;
DROP TABLE IF EXISTS espacios_grupales;
DROP TABLE IF EXISTS situaciones_sanitarias;
DROP TABLE IF EXISTS situaciones_habitacionales;
DROP TABLE IF EXISTS masculinidades_derivaciones;

DROP TABLE IF EXISTS ive_medicaciones;
DROP TABLE IF EXISTS ive_caso_red;
DROP TABLE IF EXISTS ive_caso_violencia;
DROP TABLE IF EXISTS ive_casos;

DROP TABLE IF EXISTS usuarios;
DROP TABLE IF EXISTS roles;
DROP TABLE IF EXISTS areas;

DROP TABLE IF EXISTS personas;
DROP TABLE IF EXISTS redes_contencion;
DROP TABLE IF EXISTS tipos_violencia;
DROP TABLE IF EXISTS niveles_estudio;

SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE areas (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE roles (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;
INSERT INTO areas (nombre) VALUES
('direccion_genero'),
('masculinidades'),
('ive'),
('admin');

INSERT INTO roles (nombre) VALUES
('admin'),
('coordinador'),
('usuario');


-- provincias--
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
(1, 'Buenos Aires', '2024-10-23 05:25:50', NULL, NULL, NULL, NULL),
(2, 'Catamarca', '2024-10-23 05:25:50', NULL, NULL, NULL, NULL),
(3, 'Chaco', '2024-10-23 05:25:50', NULL, NULL, NULL, NULL),
(4, 'Chubut', '2024-10-23 05:25:50', NULL, NULL, NULL, NULL),
(5, 'Córdoba', '2024-10-23 05:25:50', NULL, NULL, NULL, NULL),
(6, 'Corrientes', '2024-10-23 05:25:50', NULL, NULL, NULL, NULL),
(7, 'Entre Ríos', '2024-10-23 05:25:50', NULL, NULL, NULL, NULL),
(8, 'Formosa', '2024-10-23 05:25:50', NULL, NULL, NULL, NULL),
(9, 'Jujuy', '2024-10-23 05:25:50', NULL, NULL, NULL, NULL),
(10, 'La Pampa', '2024-10-23 05:25:50', NULL, NULL, NULL, NULL),
(11, 'La Rioja', '2024-10-23 05:25:50', NULL, NULL, NULL, NULL),
(12, 'Mendoza', '2024-10-23 05:25:50', NULL, NULL, NULL, NULL),
(13, 'Misiones', '2024-10-23 05:25:50', NULL, NULL, NULL, NULL),
(14, 'Neuquén', '2024-10-23 05:25:50', NULL, NULL, NULL, NULL),
(15, 'Río Negro', '2024-10-23 05:25:50', NULL, NULL, NULL, NULL),
(16, 'Salta', '2024-10-23 05:25:50', NULL, NULL, NULL, NULL),
(17, 'San Juan', '2024-10-23 05:25:50', NULL, NULL, NULL, NULL),
(18, 'San Luis', '2024-10-23 05:25:50', NULL, NULL, NULL, NULL),
(19, 'Santa Cruz', '2024-10-23 05:25:50', NULL, NULL, NULL, NULL),
(20, 'Santa Fe', '2024-10-23 05:25:50', NULL, NULL, NULL, NULL),
(21, 'Santiago del Estero', '2024-10-23 05:25:50', NULL, NULL, NULL, NULL),
(22, 'Tierra del Fuego', '2024-10-23 05:25:50', NULL, NULL, NULL, NULL),
(23, 'Tucumán', '2024-10-23 05:25:50', NULL, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `provincia`
--
ALTER TABLE `provincia`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;


--
-- Estructura de tabla para la tabla `localidad`
--

CREATE TABLE `localidad` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `codigo_postal` int NOT NULL,
  `id_provincia` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `deleted_by` bigint UNSIGNED DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `localidad`
--

INSERT INTO `localidad` (`id`, `nombre`, `codigo_postal`, `id_provincia`, `created_at`, `updated_by`, `deleted_by`, `updated_at`, `deleted_at`) VALUES
(2, 'La Plata', 1900, 1, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(3, 'Mar del Plata', 7601, 1, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(4, 'Bahía Blanca', 8000, 1, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(5, 'San Nicolás de los Arroyos', 2900, 1, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(6, 'Tandil', 7000, 1, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(7, 'Olavarría', 7400, 1, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(8, 'Junín', 6000, 1, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(9, 'Pergamino', 2700, 1, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(10, 'San Isidro', 1642, 1, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(11, 'Luján', 6700, 1, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(12, 'Zárate', 2800, 1, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(13, 'Campana', 2804, 1, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(14, 'General Pueyrredón', 7600, 1, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(15, 'La Matanza', 1702, 1, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(16, 'San Fernando', 1646, 1, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(17, 'Tres de Febrero', 1651, 1, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(18, 'San Miguel', 1663, 1, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(19, 'Lomas de Zamora', 1832, 1, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(20, 'Quilmes', 1879, 1, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(21, 'Avellaneda', 1870, 1, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(22, 'Berazategui', 1884, 1, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(23, 'Ituzaingó', 1714, 1, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(24, 'Morón', 1708, 1, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(25, 'Florencio Varela', 1888, 1, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(26, 'San Martín', 1650, 1, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(27, 'Vicente López', 1638, 1, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(28, 'San Fernando del Valle de Catamarca', 4700, 2, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(29, 'Ramallo', 2915, 1, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(30, 'Andalgalá', 4740, 2, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(31, 'Belén', 4750, 2, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(32, 'Tinogasta', 5340, 2, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(33, 'Santa María', 4742, 2, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(34, 'Fiambalá', 4733, 2, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(35, 'La Merced', 4753, 2, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(36, 'Aconquija', 4741, 2, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(37, 'San José', 4701, 2, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(38, 'Saujil', 5335, 2, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(39, 'Pomán', 4724, 2, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(40, 'Capayán', 4722, 2, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(41, 'Valle Viejo', 4718, 2, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(42, 'Ancasti', 4747, 2, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(43, 'El Rodeo', 4730, 2, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(44, 'Los Altos', 4709, 2, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(45, 'Puerta de Corral Quemado', 4745, 2, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(46, 'La Puerta', 4703, 2, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(47, 'Resistencia', 3500, 3, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(48, 'Barranqueras', 3503, 3, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(49, 'Fontana', 3506, 3, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(50, 'Presidencia Roque Sáenz Peña', 3700, 3, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(51, 'Villa Ángela', 3541, 3, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(52, 'Charata', 3730, 3, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(53, 'Machagai', 3708, 3, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(54, 'Las Breñas', 3722, 3, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(55, 'Quitilipi', 3540, 3, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(56, 'Tres Isletas', 3535, 3, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(57, 'General Pinedo', 3703, 3, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(58, 'La Leonesa', 3511, 3, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(59, 'Puerto Tirol', 3519, 3, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(60, 'Colonia Benítez', 3513, 3, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(61, 'Puerto Vilelas', 3507, 3, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(62, 'Margarita Belén', 3505, 3, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(63, 'General San Martín', 3542, 3, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(64, 'San Bernardo', 3706, 3, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(65, 'Juan José Castelli', 3705, 3, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(66, 'Coronel Du Graty', 3724, 3, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(67, 'Comodoro Rivadavia', 9000, 4, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(68, 'Puerto Madryn', 9120, 4, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(69, 'Trelew', 9100, 4, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(70, 'Rawson', 9103, 4, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(71, 'Esquel', 9200, 4, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(72, 'Gaiman', 9105, 4, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(73, 'Trevelin', 9203, 4, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(74, 'Dolavon', 9101, 4, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(75, 'Rada Tilly', 9001, 4, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(76, 'Sarmiento', 9005, 4, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(77, 'Lago Puelo', 9211, 4, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(78, 'Río Mayo', 9011, 4, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(79, 'Río Senguer', 9017, 4, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(80, 'Gobernador Costa', 9221, 4, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(81, 'Paso de Indios', 9023, 4, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(82, 'Córdoba', 5000, 5, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(83, 'Villa María', 5900, 5, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(84, 'Río Cuarto', 5800, 5, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(85, 'San Francisco', 2400, 5, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(86, 'Jesús María', 5220, 5, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(87, 'Villa Carlos Paz', 5152, 5, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(88, 'La Falda', 5172, 5, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(89, 'Cosquín', 5166, 5, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(90, 'Alta Gracia', 5186, 5, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(91, 'Bell Ville', 2550, 5, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(92, 'Villa Allende', 5105, 5, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(93, 'Rio Tercero', 5850, 5, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(94, 'Villa Dolores', 5870, 5, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(95, 'Río Ceballos', 5111, 5, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(96, 'Arroyito', 2440, 5, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(97, 'Mina Clavero', 5889, 5, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(98, 'Villa General Belgrano', 5194, 5, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(99, 'Marcos Juárez', 2580, 5, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(100, 'Corrientes', 3400, 6, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(101, 'Goya', 3450, 6, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(102, 'Mercedes', 3471, 6, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(103, 'Ituzaingó', 3302, 6, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(104, 'Santo Tomé', 3340, 6, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(105, 'Curuzú Cuatiá', 3470, 6, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(106, 'Bella Vista', 3452, 6, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(107, 'Esquina', 3229, 6, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(108, 'Empedrado', 3416, 6, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(109, 'Monte Caseros', 3220, 6, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(110, 'Saladas', 3451, 6, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(111, 'Virasoro', 3342, 6, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(112, 'San Lorenzo', 3425, 6, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(113, 'La Cruz', 3226, 6, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(114, 'Paso de los Libres', 3230, 6, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(115, 'Alvear', 3424, 6, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(116, 'San Luis del Palmar', 3407, 6, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(117, 'Berón de Astrada', 3414, 6, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(118, 'Paraná', 3100, 7, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(119, 'Concordia', 3200, 7, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(120, 'Gualeguaychú', 2821, 7, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(121, 'Gualeguay', 2820, 7, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(122, 'Victoria', 3153, 7, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(123, 'Villaguay', 3240, 7, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(124, 'La Paz', 3190, 7, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(125, 'Colón', 3280, 7, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(126, 'Federal', 3181, 7, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(127, 'Chajarí', 3228, 7, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(128, 'Diamante', 3105, 7, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(129, 'San José', 3283, 7, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(130, 'Crespo', 3116, 7, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(131, 'Ramírez', 3113, 7, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(132, 'Rosario del Tala', 3170, 7, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(133, 'San Justo', 3195, 7, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(134, 'Pueblo Belgrano', 3180, 7, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(135, 'Pueblo General Alvear', 3175, 7, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(136, 'Salto', 3224, 7, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(137, 'Mendoza', 5500, 8, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(138, 'San Rafael', 5600, 8, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(139, 'Godoy Cruz', 5501, 8, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(140, 'Luján de Cuyo', 5505, 8, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(141, 'Guaymallén', 5519, 8, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(142, 'Las Heras', 5502, 8, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(143, 'Maipú', 5515, 8, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(144, 'Junín', 5512, 8, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(145, 'San Martín', 5560, 8, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(146, 'Tupungato', 5565, 8, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(147, 'Malargüe', 5613, 8, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(148, 'Rivadavia', 5562, 8, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(149, 'General Alvear', 5623, 8, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(150, 'Villa Nueva', 5516, 8, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(151, 'Las Compuertas', 5547, 8, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(152, 'San Carlos', 5567, 8, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(153, 'San José del Carril', 5537, 8, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(154, 'Rincón del Indio', 5555, 8, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(155, 'La Consulta', 5568, 8, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(156, 'Parque General San Martín', 5518, 8, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(157, 'El Carrizal', 5520, 8, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(158, 'Tunuyán', 5561, 8, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(159, 'Santa Rosa', 6370, 9, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(160, 'General Alvear', 6070, 9, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(161, 'Toay', 6300, 9, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(162, 'Catriló', 6109, 9, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(163, 'General Pico', 6360, 9, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(164, 'Intendente Alvear', 6343, 9, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(165, 'Macachín', 6316, 9, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(166, 'Realicó', 6150, 9, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(167, 'Santo Tomás', 6332, 9, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(168, 'Victorica', 6338, 9, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(169, 'Rancul', 6307, 9, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(170, 'Pico de Orizaba', 6113, 9, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(171, 'Puelches', 6120, 9, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(172, 'Ceballos', 6351, 9, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(173, 'Chamaico', 6340, 9, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(174, 'Lonquimay', 6176, 9, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(175, 'Rucanelo', 6116, 9, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(176, 'Bernasconi', 6100, 9, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(177, 'Chamanal', 6152, 9, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(178, 'Huantraico', 6095, 9, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(179, 'Rivadavia', 6350, 9, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(180, 'La Maruja', 6118, 9, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(181, 'Puelches', 6349, 9, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(182, 'Carhué', 6465, 10, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(183, 'Guaminí', 6461, 10, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(184, 'Daireaux', 6460, 10, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(185, 'Adolfo Alsina', 6462, 10, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(186, 'Salliqueló', 6463, 10, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(187, 'Pihué', 6466, 10, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(188, 'Pehuajó', 6468, 10, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(189, 'Trenque Lauquen', 6469, 10, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(190, 'General Villegas', 6470, 10, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(191, 'Intendente Alvear', 6471, 10, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(192, 'Trevino', 6482, 10, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(193, 'Banderaló', 6483, 10, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(194, 'Guaminí', 6484, 10, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(195, 'Dorrego', 6485, 10, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(196, 'San Miguel del Monte', 6486, 10, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(197, 'General La Madrid', 6487, 10, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(198, 'Tornquist', 6488, 10, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(199, 'Laprida', 6489, 10, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(200, 'Las Flores', 6490, 10, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(201, 'Azul', 6491, 10, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(202, 'Tandil', 6492, 10, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(203, 'Berazategui', 6493, 10, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(204, 'Zárate', 6494, 10, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(205, 'General Alvear', 6495, 10, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(206, 'General La Madrid', 6496, 10, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(207, 'Castelli', 6497, 10, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL),
(208, 'General Alvear', 6498, 10, '2026-01-31 01:22:19', NULL, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `localidad`
--
ALTER TABLE `localidad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `localidad_id_provincia_foreign` (`id_provincia`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `localidad`
--
ALTER TABLE `localidad`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `localidad`
--
ALTER TABLE `localidad`
  ADD CONSTRAINT `localidad_id_provincia_foreign` FOREIGN KEY (`id_provincia`) REFERENCES `provincia` (`id`);
COMMIT;
--
-- Estructura de tabla para la tabla `zona_barrio`
--

CREATE TABLE `zona_barrio` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `zona_barrio`
--

INSERT INTO `zona_barrio` (`id`, `nombre`) VALUES
(4, 'CENTRO'),
(5, 'DELEGACIONES'),
(1, 'NORTE'),
(3, 'OESTE'),
(2, 'SUR');

--
-- Índices para tablas volcadas
--

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
-- AUTO_INCREMENT de la tabla `zona_barrio`
--
ALTER TABLE `zona_barrio`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;
--
-- Estructura de tabla para la tabla `barrio`
--

CREATE TABLE `barrio` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_localidad` bigint UNSIGNED NOT NULL,
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

INSERT INTO `barrio` (`id`, `nombre`, `id_localidad`, `zona_barrio_id`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Santa Teresita', 5, 1, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(2, 'Las Mellizas', 5, 1, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(3, 'Azopardo', 5, 1, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(4, 'Yaguaron', 5, 1, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(5, 'San Jorge', 5, 1, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(6, 'Castelli', 5, 1, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(7, 'San Martin', 5, 1, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(8, 'Suizo', 5, 1, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(9, 'Parque Norte', 5, 1, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(10, 'Parque Sarmiento', 5, 1, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(11, '25 de Mayo', 5, 1, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(12, 'Santa Clara', 5, 1, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(13, 'Moreno', 5, 1, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(14, 'Bola de Oro', 5, 1, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(15, 'San Cayetano', 5, 1, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(16, 'Prado Español', 5, 1, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(17, 'Alto Verde', 5, 1, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(18, 'San Pablo', 5, 1, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(19, 'La Loma', 5, 1, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(20, 'Guena', 5, 1, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(21, 'Asonia', 5, 1, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(22, 'Fraga', 5, 1, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(23, 'Martinez', 5, 1, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(24, 'Lares', 5, 1, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(25, 'Jose Ingenieros', 5, 1, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(26, '14 de Abril', 5, 1, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(27, 'Urquiza', 5, 2, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(28, 'Don Bosco', 5, 2, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(29, 'Obrero', 5, 2, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(30, 'Cavalli', 5, 2, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(31, 'Padre D´Amico', 5, 2, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(32, 'Química', 5, 2, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(33, 'Belgrano', 5, 2, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(34, 'San Isidro', 5, 2, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(35, 'Ponce de León', 5, 2, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(36, 'Saavedra', 5, 2, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(37, 'Los Fresnos', 5, 2, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(38, 'Alcoholera', 5, 2, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(39, 'Astul Urquiaga', 5, 2, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(40, 'Super Usina', 5, 2, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(41, 'Golf Club', 5, 2, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(42, 'Oeste', 5, 3, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(43, 'Lanza', 5, 3, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(44, 'Garetto', 5, 3, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(45, 'Evita', 5, 3, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(46, 'Santa Cecilia', 5, 3, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(47, 'Ginés García', 5, 3, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(48, 'ITEC', 5, 3, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(49, 'San Francisco', 5, 3, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(50, 'La Florida', 5, 3, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(51, 'General Mosconi', 5, 3, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(52, 'Mitre', 5, 3, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(53, 'Irigoyen', 5, 3, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(54, 'Villa María', 5, 3, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(55, 'Los Viñedos', 5, 3, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(56, '12 de Marzo', 5, 3, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(57, 'Don Americo', 5, 3, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(58, 'Parque Córdoba', 5, 3, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(59, 'Colombo', 5, 3, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(60, 'Malvinas', 5, 3, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(61, 'Virgen del Rosario', 5, 3, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(62, 'Colombini', 5, 3, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(63, '21 de Septiembre', 5, 3, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(64, 'Las Viñas', 5, 3, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(65, 'Pezzi', 5, 3, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(66, 'Las Flores', 5, 2, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(67, 'Juan XXIII', 5, 2, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(68, 'Del Carmen', 5, 2, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(69, 'Primavera', 5, 2, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(70, 'Ponte', 5, 2, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(71, '17 de Octubre', 5, 2, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(72, 'Los Pinos', 5, 2, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(73, 'Savio', 5, 2, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(74, 'Santa Rosa', 5, 2, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(75, '9 de Julio', 5, 2, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(76, 'Virgen de Luján', 5, 2, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(77, 'Trípoli', 5, 2, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(78, 'California', 5, 2, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(79, 'Parque Avamba´e', 5, 2, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(80, 'Avamba´e', 5, 2, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(81, '7 de Septiembre', 5, 2, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(82, 'San Eduardo', 5, 2, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(83, 'Guemes', 5, 2, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(84, 'Plastiversal', 5, 2, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(85, 'Somisa', 5, 2, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(86, 'Sironi', 5, 2, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(87, 'Ayres del Sur', 5, 2, NULL, NULL, '2024-10-23 05:25:50', NULL, NULL),
(88, 'CENTRO', 5, 4, NULL, NULL, '2026-01-19 17:28:01', NULL, NULL),
(89, 'La Emilia', 5, 5, NULL, NULL, '2026-01-19 17:28:01', NULL, NULL),
(90, 'Villa Riccio', 5, 5, NULL, NULL, '2026-01-19 17:28:01', NULL, NULL),
(91, 'Villa Canto', 5, 5, NULL, NULL, '2026-01-19 17:28:01', NULL, NULL),
(92, 'Villa Campi', 5, 5, NULL, NULL, '2026-01-19 17:28:01', NULL, NULL),
(93, 'Campos Salles', 5, 5, NULL, NULL, '2026-01-19 17:28:01', NULL, NULL),
(94, 'General Rojo', 5, 5, NULL, NULL, '2026-01-19 17:28:01', NULL, NULL),
(95, 'Conesa', 5, 5, NULL, NULL, '2026-01-19 17:28:01', NULL, NULL),
(96, 'Erezcano', 5, 5, NULL, NULL, '2026-01-19 17:28:01', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `barrio`
--
ALTER TABLE `barrio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barrio_id_localidad_foreign` (`id_localidad`),
  ADD KEY `barrio_zona_barrio_id_foreign` (`zona_barrio_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `barrio`
--
ALTER TABLE `barrio`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `barrio`
--
ALTER TABLE `barrio`
  ADD CONSTRAINT `barrio_id_localidad_foreign` FOREIGN KEY (`id_localidad`) REFERENCES `localidad` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `barrio_zona_barrio_id_foreign` FOREIGN KEY (`zona_barrio_id`) REFERENCES `zona_barrio` (`id`) ON DELETE SET NULL;
COMMIT;

CREATE TABLE usuarios (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol_id BIGINT UNSIGNED NOT NULL,
    area_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (rol_id)
        REFERENCES roles(id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE,
    FOREIGN KEY (area_id)
        REFERENCES areas(id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE
) ENGINE=InnoDB;
CREATE TABLE adjuntos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    entidad_tipo VARCHAR(50) NOT NULL,
    entidad_id BIGINT UNSIGNED NOT NULL,

    nombre_original VARCHAR(255) NOT NULL,
    nombre_guardado VARCHAR(255) NOT NULL,
    ruta VARCHAR(500) NOT NULL,
    tipo_mime VARCHAR(100),
    tamaño BIGINT,

    confidencial BOOLEAN NOT NULL DEFAULT 0,

    hash_sha256 VARCHAR(64),

    subido_por BIGINT UNSIGNED NOT NULL,

    eliminado_logico BOOLEAN NOT NULL DEFAULT 0,
    fecha_eliminacion TIMESTAMP NULL,

    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,

    INDEX idx_entidad (entidad_tipo, entidad_id),
    INDEX idx_confidencial (confidencial),
    INDEX idx_eliminado (eliminado_logico),

    FOREIGN KEY (subido_por)
        REFERENCES usuarios(id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE
) ENGINE=InnoDB;
CREATE TABLE adjuntos_descargas (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    adjunto_id BIGINT UNSIGNED NOT NULL,
    usuario_id BIGINT UNSIGNED NOT NULL,

    fecha_descarga TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ip VARCHAR(45),

    FOREIGN KEY (adjunto_id)
        REFERENCES adjuntos(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    FOREIGN KEY (usuario_id)
        REFERENCES usuarios(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;
CREATE TABLE niveles_estudio (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB;

INSERT INTO niveles_estudio (nombre) VALUES
('Primaria'),
('Secundaria'),
('Terciario'),
('Universidad');

CREATE TABLE tipos_violencia (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB;

INSERT INTO tipos_violencia (nombre) VALUES
('Psicologica'),
('Economica'),
('Fisica');

CREATE TABLE redes_contencion (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB;

INSERT INTO redes_contencion (nombre) VALUES
('Pareja'),
('Familiares'),
('Amigos'),
('Organizaciones');

CREATE TABLE personas (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    apellido VARCHAR(150) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    dni VARCHAR(20) NOT NULL,
    domicilio VARCHAR(255),
    barrio VARCHAR(150),
    telefono VARCHAR(50),
    nivel_estudio_id BIGINT UNSIGNED,
    trabaja BOOLEAN NOT NULL DEFAULT 0,
    grupo_sanguineo VARCHAR(5),
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (nivel_estudio_id)
        REFERENCES niveles_estudio(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE
) ENGINE=InnoDB;

ALTER TABLE personas
ADD CONSTRAINT unique_personas_dni UNIQUE (dni);


CREATE TABLE estados_civiles (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB;

INSERT INTO estados_civiles (nombre) VALUES
('Soltero'),
('Casado'),
('Unido de hecho'),
('Separado de hecho');


CREATE TABLE programas_asistencia (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL UNIQUE
) ENGINE=InnoDB;

INSERT INTO programas_asistencia (nombre) VALUES
('AUH'),
('Alimentar'),
('Fondo de desempleo'),
('Cuota de alimentos');


CREATE TABLE direccion_genero_casos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    persona_id BIGINT UNSIGNED NOT NULL,

    estado_civil_id BIGINT UNSIGNED,
    genero VARCHAR(100),

    provincia_id BIGINT UNSIGNED,
    localidad_id BIGINT UNSIGNED,
    barrio_id BIGINT UNSIGNED,

    nivel_estudio_id BIGINT UNSIGNED,
    trabaja BOOLEAN NOT NULL DEFAULT 0,

    organizacion_social BOOLEAN NOT NULL DEFAULT 0,
    organizacion_social_detalle VARCHAR(255),

    observaciones TEXT,

    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (persona_id)
        REFERENCES personas(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    FOREIGN KEY (estado_civil_id)
        REFERENCES estados_civiles(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE,

    FOREIGN KEY (provincia_id)
        REFERENCES provincia(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE,

    FOREIGN KEY (localidad_id)
        REFERENCES localidad(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE,

    FOREIGN KEY (barrio_id)
        REFERENCES barrio(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE,

    FOREIGN KEY (nivel_estudio_id)
        REFERENCES niveles_estudio(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE
) ENGINE=InnoDB;


CREATE TABLE direccion_genero_caso_programa (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    caso_id BIGINT UNSIGNED NOT NULL,
    programa_id BIGINT UNSIGNED NOT NULL,

    FOREIGN KEY (caso_id)
        REFERENCES direccion_genero_casos(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    FOREIGN KEY (programa_id)
        REFERENCES programas_asistencia(id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE
) ENGINE=InnoDB;


CREATE TABLE direccion_genero_grupo_conviviente (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    caso_id BIGINT UNSIGNED NOT NULL,
    nombre VARCHAR(150) NOT NULL,
    apellido VARCHAR(150) NOT NULL,
    dni VARCHAR(20),
    telefono VARCHAR(50),
    vinculo VARCHAR(100),

    FOREIGN KEY (caso_id)
        REFERENCES direccion_genero_casos(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE ive_casos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    persona_id BIGINT UNSIGNED NOT NULL,
    fum DATE,
    eco_semanas INT,
    obra_social BOOLEAN NOT NULL DEFAULT 0,
    cantidad_hijos INT DEFAULT 0,
    interrupcion_previa BOOLEAN NOT NULL DEFAULT 0,
    alta DATE,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (persona_id)
        REFERENCES personas(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE ive_caso_violencia (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ive_caso_id BIGINT UNSIGNED NOT NULL,
    tipo_violencia_id BIGINT UNSIGNED NOT NULL,
    FOREIGN KEY (ive_caso_id)
        REFERENCES ive_casos(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (tipo_violencia_id)
        REFERENCES tipos_violencia(id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE ive_caso_red (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ive_caso_id BIGINT UNSIGNED NOT NULL,
    red_id BIGINT UNSIGNED NOT NULL,
    FOREIGN KEY (ive_caso_id)
        REFERENCES ive_casos(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (red_id)
        REFERENCES redes_contencion(id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE ive_medicaciones (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ive_caso_id BIGINT UNSIGNED NOT NULL,
    nombre VARCHAR(150) NOT NULL,
    numero_lote VARCHAR(100) NOT NULL,
    FOREIGN KEY (ive_caso_id)
        REFERENCES ive_casos(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE masculinidades_derivaciones (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL UNIQUE
) ENGINE=InnoDB;

INSERT INTO masculinidades_derivaciones (nombre) VALUES
('Patronatos deliberados'),
('Juzgado de familia'),
('Direccion de genero'),
('Juzgado penal'),
('Voluntad propia');

CREATE TABLE situaciones_habitacionales (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB;

INSERT INTO situaciones_habitacionales (nombre) VALUES
('Casa'),
('Departamento'),
('Casilla'),
('Rancho');

CREATE TABLE situaciones_sanitarias (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB;

INSERT INTO situaciones_sanitarias (nombre) VALUES
('Muy buena'),
('Buena'),
('Regular'),
('Mala');

CREATE TABLE espacios_grupales (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB;

INSERT INTO espacios_grupales (nombre) VALUES
('Club'),
('Agrupacion'),
('Religion');

CREATE TABLE medidas_cautelares (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL UNIQUE
) ENGINE=InnoDB;

INSERT INTO medidas_cautelares (nombre) VALUES
('Perimetros'),
('Boton de panico'),
('Recorridas dinamicas');

CREATE TABLE masculinidades_tipos_violencia (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB;

INSERT INTO masculinidades_tipos_violencia (nombre) VALUES
('Fisica'),
('Psicologica'),
('Economica');

CREATE TABLE masculinidades_casos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    persona_id BIGINT UNSIGNED NOT NULL,
    victima_id BIGINT UNSIGNED,
    derivacion_id BIGINT UNSIGNED NOT NULL,
    situacion_habitacional_id BIGINT UNSIGNED,
    nivel_estudio_id BIGINT UNSIGNED,
    trabaja BOOLEAN NOT NULL DEFAULT 0,
    red_contencion BOOLEAN NOT NULL DEFAULT 0,
    situacion_sanitaria_id BIGINT UNSIGNED,
    realiza_tratamiento BOOLEAN,
    consumo BOOLEAN NOT NULL DEFAULT 0,
    terapia BOOLEAN NOT NULL DEFAULT 0,
    espacio_grupal_id BIGINT UNSIGNED,
    hijos_en_comun INT DEFAULT 0,
    relacion_actual BOOLEAN DEFAULT 0,
    descripcion_relacion TEXT,
    situacion_judicial TEXT,
    desobediencia BOOLEAN DEFAULT 0,
    reincidencia INT DEFAULT 0,
    asistencia_dispositivo INT DEFAULT 0,
    observaciones TEXT,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (persona_id)
        REFERENCES personas(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (victima_id)
        REFERENCES personas(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE,
    FOREIGN KEY (derivacion_id)
        REFERENCES masculinidades_derivaciones(id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE,
    FOREIGN KEY (situacion_habitacional_id)
        REFERENCES situaciones_habitacionales(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE,
    FOREIGN KEY (nivel_estudio_id)
        REFERENCES niveles_estudio(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE,
    FOREIGN KEY (situacion_sanitaria_id)
        REFERENCES situaciones_sanitarias(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE,
    FOREIGN KEY (espacio_grupal_id)
        REFERENCES espacios_grupales(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE masculinidades_grupo_familiar (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    caso_id BIGINT UNSIGNED NOT NULL,
    nombre VARCHAR(150) NOT NULL,
    apellido VARCHAR(150) NOT NULL,
    dni VARCHAR(20),
    telefono VARCHAR(50),
    vinculo_actual VARCHAR(100),
    FOREIGN KEY (caso_id)
        REFERENCES masculinidades_casos(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE masculinidades_caso_medida (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    caso_id BIGINT UNSIGNED NOT NULL,
    medida_id BIGINT UNSIGNED NOT NULL,
    FOREIGN KEY (caso_id)
        REFERENCES masculinidades_casos(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (medida_id)
        REFERENCES medidas_cautelares(id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE masculinidades_caso_violencia (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    caso_id BIGINT UNSIGNED NOT NULL,
    tipo_violencia_id BIGINT UNSIGNED NOT NULL,
    FOREIGN KEY (caso_id)
        REFERENCES masculinidades_casos(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (tipo_violencia_id)
        REFERENCES masculinidades_tipos_violencia(id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE
) ENGINE=InnoDB;





ALTER TABLE personas
DROP COLUMN barrio,
ADD COLUMN provincia_id BIGINT UNSIGNED NULL AFTER domicilio,
ADD COLUMN localidad_id BIGINT UNSIGNED NULL AFTER provincia_id,
ADD COLUMN barrio_id BIGINT UNSIGNED NULL AFTER localidad_id;

ALTER TABLE personas
ADD CONSTRAINT fk_personas_provincia
    FOREIGN KEY (provincia_id)
    REFERENCES provincia(id)
    ON DELETE SET NULL
    ON UPDATE CASCADE;

ALTER TABLE personas
ADD CONSTRAINT fk_personas_localidad
    FOREIGN KEY (localidad_id)
    REFERENCES localidad(id)
    ON DELETE SET NULL
    ON UPDATE CASCADE;

ALTER TABLE personas
ADD CONSTRAINT fk_personas_barrio
    FOREIGN KEY (barrio_id)
    REFERENCES barrio(id)
    ON DELETE SET NULL
    ON UPDATE CASCADE;