-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-12-2025 a las 00:21:34
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
-- Base de datos: `fundacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adopciones`
--

CREATE TABLE `adopciones` (
  `id_adopcion` bigint(20) UNSIGNED NOT NULL,
  `id_mascota` bigint(20) UNSIGNED NOT NULL,
  `id_adoptante` bigint(20) UNSIGNED NOT NULL,
  `fecha_adopcion` date DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adoptantes`
--

CREATE TABLE `adoptantes` (
  `id_adoptante` bigint(20) UNSIGNED NOT NULL,
  `nombres` varchar(255) NOT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `nro_docum` varchar(255) NOT NULL,
  `id_tipo` bigint(20) UNSIGNED NOT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `sexo` enum('M','F','O') DEFAULT NULL,
  `id_localidad` bigint(20) UNSIGNED NOT NULL,
  `id_barrio` bigint(20) UNSIGNED NOT NULL,
  `rol` varchar(255) NOT NULL DEFAULT 'usuario',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `adoptantes`
--

INSERT INTO `adoptantes` (`id_adoptante`, `nombres`, `telefono`, `direccion`, `edad`, `nro_docum`, `id_tipo`, `correo`, `sexo`, `id_localidad`, `id_barrio`, `rol`, `created_at`, `updated_at`) VALUES
(3, 'Santiago', '3162813166', 'Tv 69c #68b sur 55 barrio: el ensueño, casa grande. Manzana 8, casa 98', 55, '7777', 1, 'ginnatique@gmail.com', 'M', 18, 3, 'adoptante', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE `auditoria` (
  `id_auditoria` bigint(20) UNSIGNED NOT NULL,
  `modulo` varchar(100) NOT NULL,
  `tabla` varchar(100) NOT NULL,
  `registro_id` bigint(20) UNSIGNED DEFAULT NULL,
  `accion` varchar(20) NOT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `valores_anteriores` text DEFAULT NULL,
  `valores_nuevos` text DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `auditoria`
--

INSERT INTO `auditoria` (`id_auditoria`, `modulo`, `tabla`, `registro_id`, `accion`, `usuario`, `valores_anteriores`, `valores_nuevos`, `ip`, `user_agent`, `created_at`, `updated_at`) VALUES
(1, 'Historias Clínicas', 'historia_clinica', 1, 'deleted', 'admin@rescataamor.com', '{\n    \"id_historia\": 1,\n    \"id_mascota\": 3,\n    \"fecha_chequeo\": \"2025-09-28\",\n    \"peso\": 22,\n    \"tratamiento\": \"ss\",\n    \"observaciones\": \"ss\",\n    \"cuidados\": \"ss\",\n    \"created_at\": \"2025-09-28T02:10:17.000000Z\",\n    \"updated_at\": \"2025-12-07T19:56:42.000000Z\"\n}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-08 04:58:57', '2025-12-08 04:58:57'),
(2, 'Mascotas', 'mascota', 3, 'updated', 'admin@rescataamor.com', '{\n    \"id_mascota\": 3,\n    \"nombre_mascota\": \"sss\",\n    \"edad\": 2,\n    \"vacunado\": 0,\n    \"peligroso\": 1,\n    \"esterilizado\": 1,\n    \"destetado\": 1,\n    \"genero\": \"Hembra\",\n    \"imagen\": \"imagenes\\/KXiwmETysLhieUYkrNXKli0L3l5hEV6avXY0l1j1.jpg\",\n    \"crianza\": 1,\n    \"fecha_ingreso\": \"2025-12-07\",\n    \"condiciones_especiales\": 0,\n    \"raza_id\": 7,\n    \"condicion_id\": null,\n    \"estado_id\": 1\n}', '{\n    \"edad\": \"5\",\n    \"vacunado\": false,\n    \"peligroso\": true,\n    \"esterilizado\": true,\n    \"destetado\": true,\n    \"crianza\": true\n}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-08 04:59:57', '2025-12-08 04:59:57'),
(3, 'Mascotas', 'mascota', 4, 'created', 'admin@rescataamor.com', NULL, '{\n    \"nombre_mascota\": \"Sol\",\n    \"edad\": \"2\",\n    \"vacunado\": true,\n    \"peligroso\": true,\n    \"esterilizado\": true,\n    \"destetado\": true,\n    \"genero\": \"Hembra\",\n    \"imagen\": \"imagenes\\/gILtor2yTlqx8oVJa9269QEt95r5b8V67owlEA7s.jpg\",\n    \"crianza\": true,\n    \"fecha_ingreso\": \"2025-12-08\",\n    \"estado_id\": \"1\",\n    \"raza_id\": 7,\n    \"condicion_id\": null,\n    \"condiciones_especiales\": 0,\n    \"id_mascota\": 4\n}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-08 05:04:22', '2025-12-08 05:04:22'),
(4, 'Mascotas', 'mascota', 5, 'created', 'admin@rescataamor.com', NULL, '{\n    \"nombre_mascota\": \"rocky\",\n    \"edad\": \"12\",\n    \"vacunado\": true,\n    \"peligroso\": true,\n    \"esterilizado\": true,\n    \"destetado\": true,\n    \"genero\": \"Macho\",\n    \"imagen\": \"imagenes\\/KdHiC14hS7qzSh6KWfvo2UILhNNTm2n2Ucs3V8GJ.jpg\",\n    \"crianza\": true,\n    \"fecha_ingreso\": \"2025-12-08\",\n    \"estado_id\": \"1\",\n    \"raza_id\": 7,\n    \"condicion_id\": null,\n    \"condiciones_especiales\": 0,\n    \"id_mascota\": 5\n}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-08 05:28:18', '2025-12-08 05:28:18'),
(5, 'Galería', 'imagenes', 3, 'created', 'admin@rescataamor.com', NULL, '{\n    \"id_mascota\": \"4\",\n    \"nombre\": \"tobi\",\n    \"ruta\": \"imagenes\\/1765153805_images.jpg\",\n    \"updated_at\": \"2025-12-08 00:30:05\",\n    \"created_at\": \"2025-12-08 00:30:05\",\n    \"id_imagen\": 3\n}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-08 05:30:05', '2025-12-08 05:30:05'),
(6, 'Mascotas', 'mascota', 4, 'deleted', 'admin@rescataamor.com', '{\n    \"id_mascota\": 4,\n    \"nombre_mascota\": \"Sol\",\n    \"edad\": 2,\n    \"vacunado\": 1,\n    \"peligroso\": 1,\n    \"esterilizado\": 1,\n    \"destetado\": 1,\n    \"genero\": \"Hembra\",\n    \"imagen\": \"imagenes\\/gILtor2yTlqx8oVJa9269QEt95r5b8V67owlEA7s.jpg\",\n    \"crianza\": 1,\n    \"fecha_ingreso\": \"2025-12-08\",\n    \"condiciones_especiales\": 0,\n    \"raza_id\": 7,\n    \"condicion_id\": null,\n    \"estado_id\": 1\n}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-09 04:11:46', '2025-12-09 04:11:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `barrio`
--

CREATE TABLE `barrio` (
  `id_barrio` bigint(20) UNSIGNED NOT NULL,
  `nombre_barrio` varchar(100) NOT NULL,
  `id_localidad` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `barrio`
--

INSERT INTO `barrio` (`id_barrio`, `nombre_barrio`, `id_localidad`, `created_at`, `updated_at`) VALUES
(1, 'Bilbao', 15, NULL, NULL),
(2, 'gdg', 16, NULL, NULL),
(3, 'el ensueño', 18, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `asunto` varchar(255) NOT NULL,
  `mensaje` text NOT NULL,
  `leido` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`id`, `nombre`, `email`, `asunto`, `mensaje`, `leido`, `created_at`, `updated_at`) VALUES
(1, 'Santy', 'castillogodoysantiago@gmail.com', 'hola', 'dadassds', 0, '2025-09-28 07:12:09', '2025-09-28 07:12:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_condicion`
--

CREATE TABLE `detalle_condicion` (
  `id_condicion` bigint(20) UNSIGNED NOT NULL,
  `descripcion` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_condicion`
--

INSERT INTO `detalle_condicion` (`id_condicion`, `descripcion`) VALUES
(16, 'Mordelon'),
(19, 'Lindo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_donacion`
--

CREATE TABLE `detalle_donacion` (
  `id_detalle` bigint(20) UNSIGNED NOT NULL,
  `id_donacion` bigint(20) UNSIGNED NOT NULL,
  `descripcion_producto` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `donaciones`
--

CREATE TABLE `donaciones` (
  `id_donacion` bigint(20) UNSIGNED NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `cantidad` decimal(10,2) DEFAULT NULL,
  `fecha` date NOT NULL,
  `id_adoptante` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id_estado` bigint(20) UNSIGNED NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id_estado`, `descripcion`) VALUES
(1, 'Disponible'),
(2, 'En tratamiento'),
(3, 'Adoptado'),
(4, 'En proceso de adopción'),
(5, 'En recuperación'),
(6, 'No disponible'),
(7, 'Fallecido');

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
-- Estructura de tabla para la tabla `historia_clinica`
--

CREATE TABLE `historia_clinica` (
  `id_historia` bigint(20) UNSIGNED NOT NULL,
  `id_mascota` bigint(20) UNSIGNED NOT NULL,
  `fecha_chequeo` date NOT NULL,
  `peso` double(8,2) NOT NULL,
  `tratamiento` text NOT NULL,
  `observaciones` text DEFAULT NULL,
  `cuidados` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id_imagen` bigint(20) UNSIGNED NOT NULL,
  `id_mascota` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `ruta` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidad_usu`
--

CREATE TABLE `localidad_usu` (
  `id_localidad` bigint(20) UNSIGNED NOT NULL,
  `nombre_localidad` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `localidad_usu`
--

INSERT INTO `localidad_usu` (`id_localidad`, `nombre_localidad`, `created_at`, `updated_at`) VALUES
(1, 'Antonio Nariño', NULL, NULL),
(2, 'Barrios Unidos', NULL, NULL),
(3, 'Bosa', NULL, NULL),
(4, 'Chapinero', NULL, NULL),
(5, 'Ciudad Bolívar', NULL, NULL),
(6, 'Engativá', NULL, NULL),
(7, 'Fontibón', NULL, NULL),
(8, 'Kennedy', NULL, NULL),
(9, 'La Candelaria', NULL, NULL),
(10, 'Los Mártires', NULL, NULL),
(11, 'Puente Aranda', NULL, NULL),
(12, 'Rafael Uribe Uribe', NULL, NULL),
(13, 'San Cristóbal', NULL, NULL),
(14, 'Santa Fe', NULL, NULL),
(15, 'Suba', NULL, NULL),
(16, 'Sumapaz', NULL, NULL),
(17, 'Teusaquillo', NULL, NULL),
(18, 'Tunjuelito', NULL, NULL),
(19, 'Usaquén', NULL, NULL),
(20, 'Usme', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascota`
--

CREATE TABLE `mascota` (
  `id_mascota` bigint(20) UNSIGNED NOT NULL,
  `nombre_mascota` varchar(50) NOT NULL,
  `edad` int(11) DEFAULT NULL,
  `vacunado` tinyint(1) NOT NULL DEFAULT 0,
  `peligroso` tinyint(1) NOT NULL DEFAULT 0,
  `esterilizado` tinyint(1) NOT NULL DEFAULT 0,
  `destetado` tinyint(1) NOT NULL DEFAULT 0,
  `genero` varchar(10) DEFAULT NULL,
  `imagen` text DEFAULT NULL,
  `crianza` tinyint(1) NOT NULL DEFAULT 0,
  `fecha_ingreso` date DEFAULT NULL,
  `condiciones_especiales` tinyint(1) NOT NULL DEFAULT 0,
  `raza_id` bigint(20) UNSIGNED DEFAULT NULL,
  `condicion_id` bigint(20) UNSIGNED DEFAULT NULL,
  `estado_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `mascota`
--

INSERT INTO `mascota` (`id_mascota`, `nombre_mascota`, `edad`, `vacunado`, `peligroso`, `esterilizado`, `destetado`, `genero`, `imagen`, `crianza`, `fecha_ingreso`, `condiciones_especiales`, `raza_id`, `condicion_id`, `estado_id`) VALUES
(3, 'sss', 5, 0, 1, 1, 1, 'Hembra', 'imagenes/KXiwmETysLhieUYkrNXKli0L3l5hEV6avXY0l1j1.jpg', 1, '2025-12-07', 0, 7, NULL, 1),
(5, 'rocky', 12, 1, 1, 1, 1, 'Macho', 'imagenes/KdHiC14hS7qzSh6KWfvo2UILhNNTm2n2Ucs3V8GJ.jpg', 1, '2025-12-08', 0, 7, NULL, 1);

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_06_06_000001_create_localidad_usu_table', 1),
(6, '2025_06_07_000000_create_tipo_docum_table', 1),
(7, '2025_06_07_000001_create_barrio_table', 1),
(8, '2025_06_07_000003_create_raza_table', 1),
(9, '2025_06_07_000004_create_estado_table', 1),
(10, '2025_06_07_000005_create_presentacion_table', 1),
(11, '2025_06_07_000006_create_detalle_condicion_table', 1),
(12, '2025_06_07_000007_create_adoptantes_table', 1),
(13, '2025_06_07_000008_create_mascotas_table', 1),
(14, '2025_06_07_000009_create_historia_clinica_table', 1),
(15, '2025_06_07_000010_create_adopciones_table', 1),
(16, '2025_06_07_000011_create_imagenes_table', 1),
(17, '2025_06_07_000012_create_donaciones_table', 1),
(18, '2025_06_07_000013_create_detalle_donacion_table', 1),
(19, '2025_06_22_215148_remove_presentacion_id_from_detalle_donacion_table', 1),
(20, '2025_06_22_215527_drop_presentacion_table', 1),
(21, '2025_09_14_172456_create_contactos_table', 1),
(22, '2025_09_28_000001_create_auditoria_table', 2),
(23, '2025_12_08_002327_create_panel_config_table', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `panel_config`
--

CREATE TABLE `panel_config` (
  `id_config` bigint(20) UNSIGNED NOT NULL,
  `clave` varchar(50) NOT NULL,
  `valor` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `panel_config`
--

INSERT INTO `panel_config` (`id_config`, `clave`, `valor`, `created_at`, `updated_at`) VALUES
(1, 'panel_activo', 1, '2025-12-08 05:24:26', '2025-12-09 04:08:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `razas`
--

CREATE TABLE `razas` (
  `id_raza` bigint(20) UNSIGNED NOT NULL,
  `nombre_raza` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `razas`
--

INSERT INTO `razas` (`id_raza`, `nombre_raza`) VALUES
(5, 'cocker'),
(7, 'Coker'),
(6, 'criollo'),
(3, 'Fold'),
(4, 'Golden'),
(1, 'Koker');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_docum`
--

CREATE TABLE `tipo_docum` (
  `id_tipo` bigint(20) UNSIGNED NOT NULL,
  `nombre_tipo` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_docum`
--

INSERT INTO `tipo_docum` (`id_tipo`, `nombre_tipo`, `created_at`, `updated_at`) VALUES
(1, 'Cédula de Ciudadanía', NULL, NULL),
(2, 'Cédula de Extranjería', NULL, NULL),
(3, 'Pasaporte', NULL, NULL),
(4, 'NIT', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 'admin@rescataamor.com', NULL, '$2y$10$nSGKkJPJPEZYdp91keGHQ.BNbBW8Ws07kfFdLQmTsJt/K.QSo06pa', NULL, '2025-09-28 08:57:47', '2025-09-28 08:58:20');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `adopciones`
--
ALTER TABLE `adopciones`
  ADD PRIMARY KEY (`id_adopcion`),
  ADD KEY `adopciones_id_mascota_foreign` (`id_mascota`),
  ADD KEY `adopciones_id_adoptante_foreign` (`id_adoptante`);

--
-- Indices de la tabla `adoptantes`
--
ALTER TABLE `adoptantes`
  ADD PRIMARY KEY (`id_adoptante`),
  ADD UNIQUE KEY `adoptantes_nro_docum_unique` (`nro_docum`),
  ADD KEY `adoptantes_id_tipo_foreign` (`id_tipo`),
  ADD KEY `adoptantes_id_localidad_foreign` (`id_localidad`),
  ADD KEY `adoptantes_id_barrio_foreign` (`id_barrio`);

--
-- Indices de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`id_auditoria`),
  ADD KEY `auditoria_modulo_tabla_index` (`modulo`,`tabla`),
  ADD KEY `auditoria_registro_id_index` (`registro_id`),
  ADD KEY `auditoria_accion_index` (`accion`),
  ADD KEY `auditoria_created_at_index` (`created_at`);

--
-- Indices de la tabla `barrio`
--
ALTER TABLE `barrio`
  ADD PRIMARY KEY (`id_barrio`),
  ADD KEY `barrio_id_localidad_foreign` (`id_localidad`);

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_condicion`
--
ALTER TABLE `detalle_condicion`
  ADD PRIMARY KEY (`id_condicion`);

--
-- Indices de la tabla `detalle_donacion`
--
ALTER TABLE `detalle_donacion`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `detalle_donacion_id_donacion_foreign` (`id_donacion`);

--
-- Indices de la tabla `donaciones`
--
ALTER TABLE `donaciones`
  ADD PRIMARY KEY (`id_donacion`),
  ADD KEY `donaciones_id_adoptante_foreign` (`id_adoptante`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `historia_clinica`
--
ALTER TABLE `historia_clinica`
  ADD PRIMARY KEY (`id_historia`),
  ADD KEY `historia_clinica_id_mascota_foreign` (`id_mascota`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`id_imagen`),
  ADD KEY `imagenes_id_mascota_foreign` (`id_mascota`);

--
-- Indices de la tabla `localidad_usu`
--
ALTER TABLE `localidad_usu`
  ADD PRIMARY KEY (`id_localidad`);

--
-- Indices de la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD PRIMARY KEY (`id_mascota`),
  ADD KEY `mascota_raza_id_foreign` (`raza_id`),
  ADD KEY `mascota_condicion_id_foreign` (`condicion_id`),
  ADD KEY `mascota_estado_id_foreign` (`estado_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `panel_config`
--
ALTER TABLE `panel_config`
  ADD PRIMARY KEY (`id_config`),
  ADD UNIQUE KEY `panel_config_clave_unique` (`clave`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `razas`
--
ALTER TABLE `razas`
  ADD PRIMARY KEY (`id_raza`),
  ADD UNIQUE KEY `razas_nombre_raza_unique` (`nombre_raza`);

--
-- Indices de la tabla `tipo_docum`
--
ALTER TABLE `tipo_docum`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `adopciones`
--
ALTER TABLE `adopciones`
  MODIFY `id_adopcion` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `adoptantes`
--
ALTER TABLE `adoptantes`
  MODIFY `id_adoptante` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `id_auditoria` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `barrio`
--
ALTER TABLE `barrio`
  MODIFY `id_barrio` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_condicion`
--
ALTER TABLE `detalle_condicion`
  MODIFY `id_condicion` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `detalle_donacion`
--
ALTER TABLE `detalle_donacion`
  MODIFY `id_detalle` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `donaciones`
--
ALTER TABLE `donaciones`
  MODIFY `id_donacion` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id_estado` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historia_clinica`
--
ALTER TABLE `historia_clinica`
  MODIFY `id_historia` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id_imagen` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `localidad_usu`
--
ALTER TABLE `localidad_usu`
  MODIFY `id_localidad` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `mascota`
--
ALTER TABLE `mascota`
  MODIFY `id_mascota` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `panel_config`
--
ALTER TABLE `panel_config`
  MODIFY `id_config` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `razas`
--
ALTER TABLE `razas`
  MODIFY `id_raza` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tipo_docum`
--
ALTER TABLE `tipo_docum`
  MODIFY `id_tipo` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `adopciones`
--
ALTER TABLE `adopciones`
  ADD CONSTRAINT `adopciones_id_adoptante_foreign` FOREIGN KEY (`id_adoptante`) REFERENCES `adoptantes` (`id_adoptante`) ON DELETE CASCADE,
  ADD CONSTRAINT `adopciones_id_mascota_foreign` FOREIGN KEY (`id_mascota`) REFERENCES `mascota` (`id_mascota`) ON DELETE CASCADE;

--
-- Filtros para la tabla `adoptantes`
--
ALTER TABLE `adoptantes`
  ADD CONSTRAINT `adoptantes_id_barrio_foreign` FOREIGN KEY (`id_barrio`) REFERENCES `barrio` (`id_barrio`) ON DELETE CASCADE,
  ADD CONSTRAINT `adoptantes_id_localidad_foreign` FOREIGN KEY (`id_localidad`) REFERENCES `localidad_usu` (`id_localidad`) ON DELETE CASCADE,
  ADD CONSTRAINT `adoptantes_id_tipo_foreign` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_docum` (`id_tipo`);

--
-- Filtros para la tabla `barrio`
--
ALTER TABLE `barrio`
  ADD CONSTRAINT `barrio_id_localidad_foreign` FOREIGN KEY (`id_localidad`) REFERENCES `localidad_usu` (`id_localidad`) ON DELETE CASCADE;

--
-- Filtros para la tabla `detalle_donacion`
--
ALTER TABLE `detalle_donacion`
  ADD CONSTRAINT `detalle_donacion_id_donacion_foreign` FOREIGN KEY (`id_donacion`) REFERENCES `donaciones` (`id_donacion`) ON DELETE CASCADE;

--
-- Filtros para la tabla `donaciones`
--
ALTER TABLE `donaciones`
  ADD CONSTRAINT `donaciones_id_adoptante_foreign` FOREIGN KEY (`id_adoptante`) REFERENCES `adoptantes` (`id_adoptante`) ON DELETE CASCADE;

--
-- Filtros para la tabla `historia_clinica`
--
ALTER TABLE `historia_clinica`
  ADD CONSTRAINT `historia_clinica_id_mascota_foreign` FOREIGN KEY (`id_mascota`) REFERENCES `mascota` (`id_mascota`) ON DELETE CASCADE;

--
-- Filtros para la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD CONSTRAINT `imagenes_id_mascota_foreign` FOREIGN KEY (`id_mascota`) REFERENCES `mascota` (`id_mascota`) ON DELETE CASCADE;

--
-- Filtros para la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD CONSTRAINT `mascota_condicion_id_foreign` FOREIGN KEY (`condicion_id`) REFERENCES `detalle_condicion` (`id_condicion`) ON DELETE SET NULL,
  ADD CONSTRAINT `mascota_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id_estado`) ON DELETE SET NULL,
  ADD CONSTRAINT `mascota_raza_id_foreign` FOREIGN KEY (`raza_id`) REFERENCES `razas` (`id_raza`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
