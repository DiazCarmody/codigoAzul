-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-10-2024 a las 04:56:06
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hospital`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alertas`
--

CREATE TABLE `alertas` (
  `alerta_id` int(11) NOT NULL,
  `habitacion_id` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alertas`
--

INSERT INTO `alertas` (`alerta_id`, `habitacion_id`, `fecha_hora`) VALUES
(1, 24, '2024-08-08 10:08:02'),
(2, 2, '2024-08-08 16:25:12'),
(8, 2, '2024-08-08 16:26:52'),
(9, 2, '2024-08-08 16:33:15'),
(10, 23, '2024-08-08 16:33:35'),
(11, 23, '2024-08-08 16:38:11'),
(12, 23, '2024-08-08 16:46:30'),
(13, 23, '2024-08-08 16:53:53'),
(14, 3, '2024-08-08 18:39:49'),
(15, 2, '2024-08-09 09:17:05'),
(16, 2, '2024-08-09 09:18:30'),
(17, 4, '2024-08-09 10:09:53'),
(18, 3, '2024-08-14 14:53:35'),
(19, 2, '2024-08-23 08:43:22'),
(20, 2, '2024-09-25 16:48:21'),
(21, 2, '2024-09-25 16:52:54'),
(22, 2, '2024-09-25 16:55:37'),
(23, 2, '2024-09-25 16:58:54'),
(24, 2, '2024-09-25 17:00:25'),
(25, 2, '2024-09-25 18:09:09'),
(26, 2, '2024-09-26 11:18:36'),
(27, 2, '2024-09-26 11:31:26'),
(28, 2, '2024-09-26 11:31:56'),
(29, 2, '2024-09-26 11:33:14'),
(30, 2, '2024-09-26 11:34:27'),
(31, 3, '2024-09-26 11:39:59'),
(32, 3, '2024-09-26 11:54:28'),
(33, 3, '2024-09-26 12:03:37'),
(34, 3, '2024-09-27 08:48:18'),
(35, 3, '2024-09-27 08:48:48'),
(36, 3, '2024-09-27 08:55:22'),
(37, 3, '2024-09-27 09:05:05'),
(38, 3, '2024-09-27 09:30:54'),
(39, 3, '2024-09-27 09:52:05'),
(40, 2, '2024-09-27 09:58:30'),
(41, 3, '2024-09-27 10:28:03'),
(42, 3, '2024-09-27 10:31:58'),
(43, 3, '2024-09-27 10:39:47'),
(44, 3, '2024-09-27 10:41:37'),
(45, 3, '2024-09-27 10:47:18'),
(46, 3, '2024-09-27 13:38:11'),
(47, 3, '2024-09-27 15:11:08'),
(48, 3, '2024-09-27 15:23:38'),
(49, 3, '2024-09-27 15:23:58'),
(50, 3, '2024-09-27 15:40:54'),
(51, 3, '2024-09-27 15:42:11'),
(52, 3, '2024-09-27 15:54:40'),
(53, 3, '2024-09-27 16:18:54'),
(54, 2, '2024-10-06 18:57:29'),
(55, 2, '2024-10-08 14:08:28'),
(56, 2, '2024-10-08 14:08:52'),
(57, 2, '2024-10-08 14:11:30'),
(58, 2, '2024-10-10 15:47:15'),
(59, 2, '2024-10-11 23:51:18'),
(60, 2, '2024-10-13 16:10:31'),
(61, 25, '2024-10-13 19:09:05'),
(62, 25, '2024-10-13 19:13:00'),
(63, 25, '2024-10-13 19:40:10'),
(64, 25, '2024-10-13 19:45:32');

--
-- Disparadores `alertas`
--
DELIMITER $$
CREATE TRIGGER `nueva_alerta_trigger` AFTER INSERT ON `alertas` FOR EACH ROW BEGIN
    INSERT INTO alertas_pendientes (alerta_id) 
    VALUES (NEW.alerta_id);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alertas_pendientes`
--

CREATE TABLE `alertas_pendientes` (
  `alertaPendiente_id` int(11) NOT NULL,
  `alerta_id` int(11) NOT NULL,
  `procesado` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alertas_pendientes`
--

INSERT INTO `alertas_pendientes` (`alertaPendiente_id`, `alerta_id`, `procesado`) VALUES
(1, 1, 1),
(2, 2, 1),
(4, 8, 1),
(5, 9, 1),
(6, 10, 1),
(7, 11, 1),
(8, 12, 1),
(9, 13, 1),
(10, 14, 1),
(11, 15, 1),
(12, 16, 1),
(13, 17, 1),
(14, 18, 1),
(15, 19, 1),
(16, 20, 1),
(17, 21, 1),
(18, 22, 1),
(19, 23, 1),
(20, 24, 1),
(21, 25, 1),
(22, 26, 1),
(23, 27, 1),
(24, 28, 1),
(25, 29, 1),
(26, 30, 1),
(27, 31, 1),
(28, 32, 1),
(29, 33, 1),
(30, 34, 1),
(31, 35, 1),
(32, 36, 1),
(33, 37, 1),
(34, 38, 1),
(35, 39, 1),
(36, 40, 1),
(37, 41, 1),
(38, 42, 1),
(39, 43, 1),
(40, 44, 1),
(41, 45, 1),
(42, 46, 1),
(43, 47, 1),
(44, 48, 1),
(45, 49, 1),
(46, 50, 1),
(47, 51, 1),
(48, 52, 1),
(49, 53, 1),
(50, 54, 1),
(51, 55, 1),
(52, 56, 1),
(53, 57, 1),
(54, 58, 1),
(55, 59, 1),
(56, 60, 1),
(57, 61, 1),
(58, 62, 1),
(59, 63, 1),
(60, 64, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `area_id` int(11) NOT NULL,
  `area_nombre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`area_id`, `area_nombre`) VALUES
(2, 'Area 1'),
(8, 'Area 2'),
(9, 'Area 3'),
(30, 'Area 4'),
(31, 'Area 5'),
(33, 'Area especial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `cargo_id` int(11) NOT NULL,
  `cargo_cargo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`cargo_id`, `cargo_cargo`) VALUES
(1, 'Administrador'),
(2, 'Médico'),
(3, 'Genérico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especializaciones`
--

CREATE TABLE `especializaciones` (
  `especializacion_id` int(11) NOT NULL,
  `especializacion_nombre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `especializaciones`
--

INSERT INTO `especializaciones` (`especializacion_id`, `especializacion_nombre`) VALUES
(1, 'Esp 1'),
(2, 'Esp 2'),
(3, 'Esp 3'),
(4, 'Esp 4'),
(5, 'Esp 5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones`
--

CREATE TABLE `habitaciones` (
  `habitacion_id` int(11) NOT NULL,
  `habitacion_nombre` text NOT NULL,
  `id_area` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `habitaciones`
--

INSERT INTO `habitaciones` (`habitacion_id`, `habitacion_nombre`, `id_area`) VALUES
(2, 'Habitacion 1', 2),
(3, 'Habitacion 2', 8),
(4, 'Habitacion 3', 9),
(9, 'Habitacion 4', 8),
(22, 'Habitacion 5', 2),
(23, 'a1', 2),
(24, 'b2', 8),
(25, 'habitacion especial', 33);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicos`
--

CREATE TABLE `medicos` (
  `medico_id` int(11) NOT NULL,
  `medico_nombre` text NOT NULL,
  `medico_apellido` text NOT NULL,
  `medico_email` varchar(250) DEFAULT NULL,
  `medico_telefono` varchar(250) DEFAULT NULL,
  `medico_especializacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medicos`
--

INSERT INTO `medicos` (`medico_id`, `medico_nombre`, `medico_apellido`, `medico_email`, `medico_telefono`, `medico_especializacion`) VALUES
(7, 'Medico', 'N1', NULL, NULL, 1),
(9, 'Medico', 'N2', NULL, NULL, 3),
(10, 'Medico', 'N3', NULL, NULL, 1),
(17, 'Medico', 'N4', NULL, NULL, 1),
(19, 'Medico', 'N5', NULL, NULL, 1),
(51, 'aa', 'aa', NULL, NULL, 2),
(52, 'hola', 'hola', NULL, NULL, 3),
(53, 'jorge', 'peñarol', NULL, NULL, 4),
(54, 'Fausto', 'Díaz Carmody', 'diazcarmodyfausto@gmail.com', '2364719151', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `paciente_id` int(11) NOT NULL,
  `paciente_nombre` text NOT NULL,
  `paciente_apellido` text NOT NULL,
  `paciente_edad` int(11) NOT NULL,
  `paciente_domicilio` text NOT NULL,
  `paciente_datosmedicos` text NOT NULL,
  `paciente_fechaIngreso` datetime NOT NULL DEFAULT current_timestamp(),
  `id_medico` int(11) NOT NULL,
  `id_habitacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`paciente_id`, `paciente_nombre`, `paciente_apellido`, `paciente_edad`, `paciente_domicilio`, `paciente_datosmedicos`, `paciente_fechaIngreso`, `id_medico`, `id_habitacion`) VALUES
(44, 'Paciente', 'Rodriguez', 1, 'Home3', 'Data', '2024-07-02 19:53:56', 51, 23),
(45, 'Paciente', 'N2', 2, 'Home', 'Data', '2024-07-02 19:53:56', 19, 2),
(46, 'Paciente', 'N3', 3, 'Home', 'Data', '2024-07-02 19:54:31', 7, 9),
(47, 'Paciente', 'N4', 4, 'Home', 'Data', '2024-07-02 19:54:31', 7, 4),
(48, 'Paciente', 'N5', 5, 'Home', '0', '2024-07-02 19:54:49', 9, 2),
(53, 'fausto', 'Díaz Carmody', 18, 'Chile 1134', 'Fiebre, fatiga', '2024-08-08 10:28:14', 9, 3),
(54, 'po', 'po', 19, 'Gral. Paz 432', 'Fiebre, fatiga', '2024-09-27 08:57:53', 10, 4),
(57, 'Claudo Damián', 'Sala', 19, 'Recontra lejos de la sociedad', 'Paciente especial :)', '2024-10-13 16:12:29', 54, 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tokens`
--

CREATE TABLE `tokens` (
  `token_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `token` varchar(64) NOT NULL,
  `expira` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tokens`
--

INSERT INTO `tokens` (`token_id`, `usuario_id`, `token`, `expira`) VALUES
(1, 17, 'b84878e3aa44c495ded01c8475e4b25865bce0f47302f1973f687e4030c00ba1', '2024-08-07 16:30:23'),
(2, 17, '08fa218d67742d518542d7b8598f0c6f4310481c54b88b9fa2e0524a39b09cd1', '2024-08-07 16:30:25'),
(3, 17, '13c3ba2327f05600a05a16f0635d5067bc144c083e6e0c1d931857f717f83ca0', '2024-08-07 16:30:56'),
(4, 17, 'f3daf5b88ad3378d9821283e046760182bd0d487f80ba71242991f594164fa3b', '2024-08-07 16:31:22'),
(5, 17, '63516af8e587e9ab98e05a935cc8229ca102f0c95ab7afcc712ba846f64bd147', '2024-08-07 16:32:27'),
(6, 17, 'c953ec85727aebe7c949a095087060eb0bd6896825b785546e1fed22f0e2bd18', '2024-08-09 15:33:46'),
(7, 17, 'cd27875d8884c7dc78476d7703276d9a6727ef4ca96630449637529b49e3db3d', '2024-08-09 16:34:56'),
(8, 17, 'd2ff2a41bc5a62ef2187fa4f847873754765eb55bf903a68975dea097d6a9c52', '2024-08-09 17:00:07'),
(9, 17, 'f75cabb5b1d0976c95de757afe230b2d8c209cc94a49f916a611761f9e193df6', '2024-08-09 17:00:15'),
(10, 17, 'd2c35cc4b83cb38590e99bf3b881ab75a9e7ef7823d7fc4da550e8b73f3e8833', '2024-08-09 17:01:04'),
(11, 17, '6476d3967a398d6d90759015c02a6d06fba3fb1c53ffb6be9273444fe8dadde9', '2024-08-09 17:23:49'),
(12, 17, 'b0153129a835a76f558ea19e8c67cfcaea743bbea4f149c67f8744e31e8b1d5c', '2024-08-09 17:31:59'),
(13, 17, '1138502206ba881bef66d5c24cb6eae02899be2fa18cb63995edc49b99ae9e38', '2024-08-09 17:35:11'),
(14, 17, '0dd7a4bd4868a690ff107c23783e76426c1add647556afdf644bebfa2b4fd806', '2024-08-11 04:37:40'),
(15, 17, '8d45076538acd7b7a855fcb86e1ddbc2de5b334eea2c058b09df087b86f2cdd7', '2024-08-11 05:35:50'),
(16, 17, 'e1eec245f9f7b1c59c6625a9a13a0ed3062e8e396669ceb3dfaf29e985cbd163', '2024-08-11 05:41:58'),
(17, 17, 'e3232e9b9697f4feb7897b900ae5f365ebb142e41cf137c22022544c00c7ba57', '2024-08-11 05:46:53'),
(20, 5, '39148525dc4071deee756d9c88e1a231869df8cec2bd9a1363803b3f8a19848c', '2024-08-12 01:29:29'),
(21, 5, '0d73dea46761af12d14745c85644de44e9a3045d7e4f9a484119ea1c9af7c3d0', '2024-08-12 01:30:03'),
(22, 5, '347ec2a810da70af91020f1de9dc18b5d317eb8eedef9fa3c2efffe28bbc2f5d', '2024-08-12 01:44:50'),
(24, 1, 'dbdb7ccb37e6db1b9ea8aea2295e21c9b67d8613d5a92355bb9d6f6a2309869c', '2024-08-12 17:34:58'),
(25, 15, '1e3bd8d47aa64334c0a81883812f3f5205532e468703cf2b2640572966502fe9', '2024-08-12 17:38:41'),
(26, 15, '54d749e779ca8344684a73ef3c26bb676d18b25f346cc901012752ffe917f0f2', '2024-08-12 17:38:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario_id` int(11) NOT NULL,
  `usuario_nombre` text NOT NULL,
  `usuario_apellido` text NOT NULL,
  `usuario_email` text NOT NULL,
  `usuario_clave` text NOT NULL,
  `autentificacion` int(10) NOT NULL,
  `id_cargo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `usuario_nombre`, `usuario_apellido`, `usuario_email`, `usuario_clave`, `autentificacion`, `id_cargo`) VALUES
(1, 'Fausto', 'Díaz Carmody', 'diazcarmodyfausto@gmail.com', '$2y$10$FEJY9z1eyB5dQ0Kpv2U8DOGqUPMGjwR8qDC9kHKUl9LyR7BMj5une', 4683, 1),
(5, 'Santi', 'Henze', 'santi.henze2@gmail.com', '1234', 7305, 2),
(13, 'admin', 'admin', 'admin@gmail.com', '$2y$10$pT2Y4zDoewJSxleri03ua.xqRrhYi9FMkrAY5DePkVaR4CmaHGH6a', 3864, 1),
(15, 'Santiago', 'Zazo', 'szazo39@gmail.com', '$2y$10$7rn5AEP/2HPCgb9KXy.uoOVSPUcZEYHuyr6UIlpn.xlhGzsRAPMaG', 0, 1),
(17, 'Fausto', 'Díaz Carmody', '0800fau@gmail.com', '$2y$10$OuGjOCtVKj1p1QcUzqYXguxayhR2xaixpDNY5043b.2UqQSdWOB7K', 5465, 1),
(18, 'Claudio Damián', 'Sala', 'damisala13@gmail.com', '$2y$10$LHoc9qNwrId0bs3HYE2OVef8RswZX96cMKhsgSU4to16AN81kKqZ2', 7355, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alertas`
--
ALTER TABLE `alertas`
  ADD PRIMARY KEY (`alerta_id`),
  ADD KEY `habitacion_id` (`habitacion_id`);

--
-- Indices de la tabla `alertas_pendientes`
--
ALTER TABLE `alertas_pendientes`
  ADD PRIMARY KEY (`alertaPendiente_id`);

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`area_id`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`cargo_id`);

--
-- Indices de la tabla `especializaciones`
--
ALTER TABLE `especializaciones`
  ADD PRIMARY KEY (`especializacion_id`);

--
-- Indices de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD PRIMARY KEY (`habitacion_id`),
  ADD KEY `id_area` (`id_area`);

--
-- Indices de la tabla `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`medico_id`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`paciente_id`),
  ADD KEY `id_enfermero` (`id_medico`),
  ADD KEY `id_habitacion` (`id_habitacion`);

--
-- Indices de la tabla `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`token_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario_id`),
  ADD KEY `id_cargo` (`id_cargo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alertas`
--
ALTER TABLE `alertas`
  MODIFY `alerta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `alertas_pendientes`
--
ALTER TABLE `alertas_pendientes`
  MODIFY `alertaPendiente_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `area_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `cargo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `especializaciones`
--
ALTER TABLE `especializaciones`
  MODIFY `especializacion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  MODIFY `habitacion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `medicos`
--
ALTER TABLE `medicos`
  MODIFY `medico_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `paciente_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `tokens`
--
ALTER TABLE `tokens`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alertas`
--
ALTER TABLE `alertas`
  ADD CONSTRAINT `habitacion` FOREIGN KEY (`habitacion_id`) REFERENCES `habitaciones` (`habitacion_id`);

--
-- Filtros para la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD CONSTRAINT `habitaciones_ibfk_1` FOREIGN KEY (`id_area`) REFERENCES `areas` (`area_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD CONSTRAINT `pacientes_ibfk_1` FOREIGN KEY (`id_medico`) REFERENCES `medicos` (`medico_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pacientes_ibfk_2` FOREIGN KEY (`id_habitacion`) REFERENCES `habitaciones` (`habitacion_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tokens`
--
ALTER TABLE `tokens`
  ADD CONSTRAINT `user` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_cargo`) REFERENCES `cargo` (`cargo_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
