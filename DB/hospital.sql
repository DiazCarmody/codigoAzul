-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-12-2024 a las 21:55:34
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
(5, 'Esp 5'),
(6, 'Especialista en especiales'),
(7, 'Urología');

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
(56, 'Miguel', 'Laiun', 'miguel.laiun@gmail.com', '2364676940', 6),
(61, 'Carlos Andrés', 'Di Cicco', 'carlosdicicco@gmail.com', '2364647078', 6);

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `respuesta_id` int(11) NOT NULL,
  `numero` varchar(100) NOT NULL,
  `mensaje` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadores `respuestas`
--
DELIMITER $$
CREATE TRIGGER `nueva_respuesta_trigger` AFTER INSERT ON `respuestas` FOR EACH ROW BEGIN
    -- Inserta en respuestas_sinleer usando el respuesta_id recién creado en respuestas
    INSERT INTO respuestas_sinleer (respuesta_id, Leido)
    VALUES (NEW.respuesta_id, 0); -- Leido se inicializa como 0 (no leído)
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas_sinleer`
--

CREATE TABLE `respuestas_sinleer` (
  `respuestaSinLeer_id` int(11) NOT NULL,
  `respuesta_id` int(11) NOT NULL,
  `Leido` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(13, 'admin', 'admin', 'admin@gmail.com', '$2y$10$pT2Y4zDoewJSxleri03ua.xqRrhYi9FMkrAY5DePkVaR4CmaHGH6a', 3864, 1);

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
  ADD PRIMARY KEY (`medico_id`),
  ADD KEY `medico_especializacion` (`medico_especializacion`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`paciente_id`),
  ADD KEY `id_enfermero` (`id_medico`),
  ADD KEY `id_habitacion` (`id_habitacion`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`respuesta_id`);

--
-- Indices de la tabla `respuestas_sinleer`
--
ALTER TABLE `respuestas_sinleer`
  ADD PRIMARY KEY (`respuestaSinLeer_id`),
  ADD KEY `respuesta_id` (`respuesta_id`);

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
  MODIFY `alerta_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `alertas_pendientes`
--
ALTER TABLE `alertas_pendientes`
  MODIFY `alertaPendiente_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `especializacion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  MODIFY `habitacion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `medicos`
--
ALTER TABLE `medicos`
  MODIFY `medico_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `paciente_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `respuesta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `respuestas_sinleer`
--
ALTER TABLE `respuestas_sinleer`
  MODIFY `respuestaSinLeer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tokens`
--
ALTER TABLE `tokens`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT;

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
-- Filtros para la tabla `respuestas_sinleer`
--
ALTER TABLE `respuestas_sinleer`
  ADD CONSTRAINT `respuesta` FOREIGN KEY (`respuesta_id`) REFERENCES `respuestas` (`respuesta_id`);

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
