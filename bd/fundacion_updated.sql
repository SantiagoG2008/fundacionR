-- Dump de base de datos para Fundación Rescata Amor
-- Generado el: 2025-09-28 03:22:05

SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `adopciones`;
CREATE TABLE `adopciones` (
  `id_adopcion` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_mascota` bigint(20) unsigned NOT NULL,
  `id_adoptante` bigint(20) unsigned NOT NULL,
  `fecha_adopcion` date DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_adopcion`),
  KEY `adopciones_id_mascota_foreign` (`id_mascota`),
  KEY `adopciones_id_adoptante_foreign` (`id_adoptante`),
  CONSTRAINT `adopciones_id_adoptante_foreign` FOREIGN KEY (`id_adoptante`) REFERENCES `adoptantes` (`id_adoptante`) ON DELETE CASCADE,
  CONSTRAINT `adopciones_id_mascota_foreign` FOREIGN KEY (`id_mascota`) REFERENCES `mascota` (`id_mascota`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `adoptantes`;
CREATE TABLE `adoptantes` (
  `id_adoptante` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombres` varchar(255) NOT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `nro_docum` varchar(255) NOT NULL,
  `id_tipo` bigint(20) unsigned NOT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `sexo` enum('M','F','O') DEFAULT NULL,
  `id_localidad` bigint(20) unsigned NOT NULL,
  `id_barrio` bigint(20) unsigned NOT NULL,
  `rol` varchar(255) NOT NULL DEFAULT 'usuario',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_adoptante`),
  UNIQUE KEY `adoptantes_nro_docum_unique` (`nro_docum`),
  KEY `adoptantes_id_tipo_foreign` (`id_tipo`),
  KEY `adoptantes_id_localidad_foreign` (`id_localidad`),
  KEY `adoptantes_id_barrio_foreign` (`id_barrio`),
  CONSTRAINT `adoptantes_id_barrio_foreign` FOREIGN KEY (`id_barrio`) REFERENCES `barrio` (`id_barrio`) ON DELETE CASCADE,
  CONSTRAINT `adoptantes_id_localidad_foreign` FOREIGN KEY (`id_localidad`) REFERENCES `localidad_usu` (`id_localidad`) ON DELETE CASCADE,
  CONSTRAINT `adoptantes_id_tipo_foreign` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_docum` (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `adoptantes` (`id_adoptante`, `nombres`, `telefono`, `direccion`, `edad`, `nro_docum`, `id_tipo`, `correo`, `sexo`, `id_localidad`, `id_barrio`, `rol`, `created_at`, `updated_at`) VALUES
('1', 'Santiago Godoy', '3053468635', 'cra130#143a13', '22', '1001119500', '1', 'castillogodoysantiago@gmail.com', 'M', '15', '1', 'ambos', NULL, NULL);

DROP TABLE IF EXISTS `barrio`;
CREATE TABLE `barrio` (
  `id_barrio` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_barrio` varchar(100) NOT NULL,
  `id_localidad` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_barrio`),
  KEY `barrio_id_localidad_foreign` (`id_localidad`),
  CONSTRAINT `barrio_id_localidad_foreign` FOREIGN KEY (`id_localidad`) REFERENCES `localidad_usu` (`id_localidad`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `barrio` (`id_barrio`, `nombre_barrio`, `id_localidad`, `created_at`, `updated_at`) VALUES
('1', 'Bilbao', '15', NULL, NULL);

DROP TABLE IF EXISTS `contactos`;
CREATE TABLE `contactos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `asunto` varchar(255) NOT NULL,
  `mensaje` text NOT NULL,
  `leido` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `contactos` (`id`, `nombre`, `email`, `asunto`, `mensaje`, `leido`, `created_at`, `updated_at`) VALUES
('1', 'Santy', 'castillogodoysantiago@gmail.com', 'hola', 'dadassds', '0', '2025-09-28 02:12:09', '2025-09-28 02:12:09');

DROP TABLE IF EXISTS `detalle_condicion`;
CREATE TABLE `detalle_condicion` (
  `id_condicion` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(150) NOT NULL,
  PRIMARY KEY (`id_condicion`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `detalle_condicion` (`id_condicion`, `descripcion`) VALUES
('16', 'Mordelon'),
('19', 'Lindo'),
('20', 'si lindo y bravo');

DROP TABLE IF EXISTS `detalle_donacion`;
CREATE TABLE `detalle_donacion` (
  `id_detalle` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_donacion` bigint(20) unsigned NOT NULL,
  `descripcion_producto` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_detalle`),
  KEY `detalle_donacion_id_donacion_foreign` (`id_donacion`),
  CONSTRAINT `detalle_donacion_id_donacion_foreign` FOREIGN KEY (`id_donacion`) REFERENCES `donaciones` (`id_donacion`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `detalle_donacion` (`id_detalle`, `id_donacion`, `descripcion_producto`, `created_at`, `updated_at`) VALUES
('1', '1', 'sss', '2025-09-28 02:37:21', '2025-09-28 02:37:21');

DROP TABLE IF EXISTS `donaciones`;
CREATE TABLE `donaciones` (
  `id_donacion` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) NOT NULL,
  `cantidad` decimal(10,2) DEFAULT NULL,
  `fecha` date NOT NULL,
  `id_adoptante` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_donacion`),
  KEY `donaciones_id_adoptante_foreign` (`id_adoptante`),
  CONSTRAINT `donaciones_id_adoptante_foreign` FOREIGN KEY (`id_adoptante`) REFERENCES `adoptantes` (`id_adoptante`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `donaciones` (`id_donacion`, `tipo`, `cantidad`, `fecha`, `id_adoptante`, `created_at`, `updated_at`) VALUES
('1', 'Comida', '2322.00', '2025-09-27', '1', '2025-09-28 02:37:21', '2025-09-28 02:37:21');

DROP TABLE IF EXISTS `estados`;
CREATE TABLE `estados` (
  `id_estado` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `estados` (`id_estado`, `descripcion`) VALUES
('1', 'Disponible'),
('2', 'En tratamiento'),
('3', 'Adoptado'),
('4', 'En proceso de adopción'),
('5', 'En recuperación'),
('6', 'No disponible'),
('7', 'Fallecido');

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `historia_clinica`;
CREATE TABLE `historia_clinica` (
  `id_historia` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_mascota` bigint(20) unsigned NOT NULL,
  `fecha_chequeo` date NOT NULL,
  `peso` double(8,2) NOT NULL,
  `tratamiento` text NOT NULL,
  `observaciones` text DEFAULT NULL,
  `cuidados` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_historia`),
  KEY `historia_clinica_id_mascota_foreign` (`id_mascota`),
  CONSTRAINT `historia_clinica_id_mascota_foreign` FOREIGN KEY (`id_mascota`) REFERENCES `mascota` (`id_mascota`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `historia_clinica` (`id_historia`, `id_mascota`, `fecha_chequeo`, `peso`, `tratamiento`, `observaciones`, `cuidados`, `created_at`, `updated_at`) VALUES
('1', '1', '2025-09-28', '22', 'ss', 'ss', 'ss', '2025-09-28 02:10:17', '2025-09-28 02:10:17');

DROP TABLE IF EXISTS `imagenes`;
CREATE TABLE `imagenes` (
  `id_imagen` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_mascota` bigint(20) unsigned NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `ruta` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_imagen`),
  KEY `imagenes_id_mascota_foreign` (`id_mascota`),
  CONSTRAINT `imagenes_id_mascota_foreign` FOREIGN KEY (`id_mascota`) REFERENCES `mascota` (`id_mascota`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `imagenes` (`id_imagen`, `id_mascota`, `nombre`, `ruta`, `created_at`, `updated_at`) VALUES
('1', '1', 'Paco', 'imagenes/1759025448_paco.png', '2025-09-28 02:10:48', '2025-09-28 02:10:48');

DROP TABLE IF EXISTS `localidad_usu`;
CREATE TABLE `localidad_usu` (
  `id_localidad` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_localidad` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_localidad`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `localidad_usu` (`id_localidad`, `nombre_localidad`, `created_at`, `updated_at`) VALUES
('1', 'Antonio Nariño', NULL, NULL),
('2', 'Barrios Unidos', NULL, NULL),
('3', 'Bosa', NULL, NULL),
('4', 'Chapinero', NULL, NULL),
('5', 'Ciudad Bolívar', NULL, NULL),
('6', 'Engativá', NULL, NULL),
('7', 'Fontibón', NULL, NULL),
('8', 'Kennedy', NULL, NULL),
('9', 'La Candelaria', NULL, NULL),
('10', 'Los Mártires', NULL, NULL),
('11', 'Puente Aranda', NULL, NULL),
('12', 'Rafael Uribe Uribe', NULL, NULL),
('13', 'San Cristóbal', NULL, NULL),
('14', 'Santa Fe', NULL, NULL),
('15', 'Suba', NULL, NULL),
('16', 'Sumapaz', NULL, NULL),
('17', 'Teusaquillo', NULL, NULL),
('18', 'Tunjuelito', NULL, NULL),
('19', 'Usaquén', NULL, NULL),
('20', 'Usme', NULL, NULL);

DROP TABLE IF EXISTS `mascota`;
CREATE TABLE `mascota` (
  `id_mascota` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
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
  `raza_id` bigint(20) unsigned DEFAULT NULL,
  `condicion_id` bigint(20) unsigned DEFAULT NULL,
  `estado_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_mascota`),
  KEY `mascota_raza_id_foreign` (`raza_id`),
  KEY `mascota_condicion_id_foreign` (`condicion_id`),
  KEY `mascota_estado_id_foreign` (`estado_id`),
  CONSTRAINT `mascota_condicion_id_foreign` FOREIGN KEY (`condicion_id`) REFERENCES `detalle_condicion` (`id_condicion`) ON DELETE SET NULL,
  CONSTRAINT `mascota_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id_estado`) ON DELETE SET NULL,
  CONSTRAINT `mascota_raza_id_foreign` FOREIGN KEY (`raza_id`) REFERENCES `razas` (`id_raza`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `mascota` (`id_mascota`, `nombre_mascota`, `edad`, `vacunado`, `peligroso`, `esterilizado`, `destetado`, `genero`, `imagen`, `crianza`, `fecha_ingreso`, `condiciones_especiales`, `raza_id`, `condicion_id`, `estado_id`) VALUES
('1', 'Paco', '9', '1', '1', '1', '0', 'Macho', 'imagenes/iwv8JeTZrYOiPkiLV8RtxulPkRc1VaMhCCj1qQvN.png', '0', '2025-09-28', '1', '5', '20', '1');

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
('1', '2014_10_12_000000_create_users_table', '1'),
('2', '2014_10_12_100000_create_password_resets_table', '1'),
('3', '2019_08_19_000000_create_failed_jobs_table', '1'),
('4', '2019_12_14_000001_create_personal_access_tokens_table', '1'),
('5', '2025_06_06_000001_create_localidad_usu_table', '1'),
('6', '2025_06_07_000000_create_tipo_docum_table', '1'),
('7', '2025_06_07_000001_create_barrio_table', '1'),
('8', '2025_06_07_000003_create_raza_table', '1'),
('9', '2025_06_07_000004_create_estado_table', '1'),
('10', '2025_06_07_000005_create_presentacion_table', '1'),
('11', '2025_06_07_000006_create_detalle_condicion_table', '1'),
('12', '2025_06_07_000007_create_adoptantes_table', '1'),
('13', '2025_06_07_000008_create_mascotas_table', '1'),
('14', '2025_06_07_000009_create_historia_clinica_table', '1'),
('15', '2025_06_07_000010_create_adopciones_table', '1'),
('16', '2025_06_07_000011_create_imagenes_table', '1'),
('17', '2025_06_07_000012_create_donaciones_table', '1'),
('18', '2025_06_07_000013_create_detalle_donacion_table', '1'),
('19', '2025_06_22_215148_remove_presentacion_id_from_detalle_donacion_table', '1'),
('20', '2025_06_22_215527_drop_presentacion_table', '1'),
('21', '2025_09_14_172456_create_contactos_table', '1');

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `razas`;
CREATE TABLE `razas` (
  `id_raza` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_raza` varchar(100) NOT NULL,
  PRIMARY KEY (`id_raza`),
  UNIQUE KEY `razas_nombre_raza_unique` (`nombre_raza`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `razas` (`id_raza`, `nombre_raza`) VALUES
('5', 'cocker'),
('3', 'Fold'),
('4', 'Golden'),
('1', 'Koker');

DROP TABLE IF EXISTS `tipo_docum`;
CREATE TABLE `tipo_docum` (
  `id_tipo` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_tipo` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `tipo_docum` (`id_tipo`, `nombre_tipo`, `created_at`, `updated_at`) VALUES
('1', 'Cédula de Ciudadanía', NULL, NULL),
('2', 'Cédula de Extranjería', NULL, NULL),
('3', 'Pasaporte', NULL, NULL),
('4', 'NIT', NULL, NULL);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS=1;
