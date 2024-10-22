-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-07-2024 a las 14:46:22
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
-- Base de datos: `hospital`
--

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
(31, 'Area 5');

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
(22, 'Habitacion 5', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicos`
--

CREATE TABLE `medicos` (
  `medico_id` int(11) NOT NULL,
  `medico_nombre` text NOT NULL,
  `medico_apellido` text NOT NULL,
  `medico_dni` int(30) NOT NULL,
  `medico_especializacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medicos`
--

INSERT INTO `medicos` (`medico_id`, `medico_nombre`, `medico_apellido`, `medico_dni`, `medico_especializacion`) VALUES
(7, 'Medico', 'N1', 111, 1),
(9, 'Medico', 'N2', 222, 3),
(10, 'Medico', 'N3', 333, 1),
(17, 'Medico', 'N4', 444, 1),
(19, 'Medico', 'N5', 555, 1);

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
(44, 'Paciente', 'N1', 1, 'Home', 'Data', '2024-07-02 19:53:56', 7, 2),
(45, 'Paciente', 'N2', 2, 'Home', 'Data', '2024-07-02 19:53:56', 19, 2),
(46, 'Paciente', 'N3', 3, 'Home', 'Data', '2024-07-02 19:54:31', 7, 9),
(47, 'Paciente', 'N4', 4, 'Home', 'Data', '2024-07-02 19:54:31', 7, 4),
(48, 'Paciente', 'N5', 5, 'Home', '0', '2024-07-02 19:54:49', 9, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario_id` int(11) NOT NULL,
  `usuario_nombre` text NOT NULL,
  `usuario_apellido` text NOT NULL,
  `usuario_username` text NOT NULL,
  `usuario_clave` text NOT NULL,
  `autentificacion` int(10) NOT NULL,
  `id_cargo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `usuario_nombre`, `usuario_apellido`, `usuario_username`, `usuario_clave`, `autentificacion`, `id_cargo`) VALUES
(1, 'Fausto', 'Díaz Carmody', 'f4u!', '$2y$10$drdxUu0/fIWgDKRStZnQLuyqNPVli19EYPea/8/3hL/aRkXRNAztC', 4683, 1),
(2, 'prueba', 'prueba', 'prueba', '$2y$10$dL/hwz80zrA5KaQ6fjqbL.j.ULBBRgL3KuiPCvFwy6P218fvbElY2', 0, 3),
(3, 'Donza', 'Maximo', 'MaximoDonza', '$2y$10$/gY5B6yCT.u8xrxhV/H9huDaRn0.9Ha0ERDMVjOv1/z14DhcUvKAq', 0, 3),
(4, 'prueba3', 'prueba3', 'prueba3', '$2y$10$V0zQIXeFFcBBxQr3Hu.qBO5iNhSH9uTMw6w0KLw3W/zVj/rh/Xqje', 0, 3),
(5, 'Santi', 'Henze', 'ELSANTI', '$2y$10$sZ4G7uyS5GXGqC.HzLS5F.Kuy2Egtpul8RYq6JQ.QVgdkZDdhCjfy', 7305, 3),
(6, 'Maximiliano', 'Acuña', 'maxi123', '$2y$10$/TXmNS1EACbbUUKh81bTdepVKaU3D4j8U3NkLtRBdvBMCmcGtGjMa', 7305, 3),
(7, 'testeo', 'testeo', 'testeo', '$2y$10$p/tRttizkExI7LZpuPpCD.sHXerJLUakdXz.PdSJr0Om1WEdmMEn6', 1346, 2),
(8, 'Carlos', 'Di CIcco', 'CARLOSANASHEI123', '$2y$10$C8.y2QKsqFvLIWAku.QWf.LuyKKlDpDkZbZkcZ1hh0dJvPDdaB/Fe', 8101, 2),
(10, 'test', 'testeo', 'testusuario', '$2y$10$6fFUQo11Kb5FOVPCwd0sAOFt3PVRyDbkM.RUDvk1jLUL9dDuQTM2O', 3462, 2),
(11, 'Damián', 'Sala', 'ELDAMII', '$2y$10$iExiFxPoVt0EbnGOkAYoPupf3/7aWybRwiJEpe.ubQ9HW849glIHy', 3889, 3),
(12, 'test', 'teste', 'pruebass', '$2y$10$/BEy2GuYPbfJUkqIDGwUuullq7Z4441t.trk6F.Q/yYJhJqAQBOqC', 5311, 2),
(13, 'admin', 'admin', 'admin', '$2y$10$pT2Y4zDoewJSxleri03ua.xqRrhYi9FMkrAY5DePkVaR4CmaHGH6a', 3864, 1),
(14, 'test', 'test', 'test01', '$2y$10$h3pudApyEntNxHE3YN2m5u8UesV3P4TuKMgysaTz7dkvNEfuPnTRW', 0, 2),
(15, 'santiago', 'el zazo', 'zazo3', '$2y$10$7rn5AEP/2HPCgb9KXy.uoOVSPUcZEYHuyr6UIlpn.xlhGzsRAPMaG', 0, 1),
(16, 'Miguel', 'Laiun', 'Miguel Laiun', '$2y$10$anG9pSRYbvM.9PlM02ACEuIp/lB.mgPRTwxX5EG5a0e5IZ5uYiy3O', 8863, 1);

--
-- Índices para tablas volcadas
--

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
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario_id`),
  ADD KEY `id_cargo` (`id_cargo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `area_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
  MODIFY `habitacion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `medicos`
--
ALTER TABLE `medicos`
  MODIFY `medico_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `paciente_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

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
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_cargo`) REFERENCES `cargo` (`cargo_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
