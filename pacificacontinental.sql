-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-06-2022 a las 02:36:58
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pacificacontinental`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `IdPermisos` int(11) NOT NULL,
  `IdRoles` int(11) NOT NULL,
  `NombrePermiso` varchar(255) NOT NULL,
  `FechaHoraCreacion` datetime NOT NULL DEFAULT current_timestamp(),
  `FechaHoraModificacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`IdPermisos`, `IdRoles`, `NombrePermiso`, `FechaHoraCreacion`, `FechaHoraModificacion`) VALUES
(1, 1, 'Usuarios.index', '2022-06-02 17:38:31', '2022-06-02 22:38:31'),
(2, 1, 'Usuarios.crear', '2022-06-02 17:38:31', '2022-06-02 22:38:31'),
(3, 1, 'Usuarios.editar', '2022-06-02 17:38:31', '2022-06-02 22:38:31'),
(4, 1, 'Usuarios.eliminar', '2022-06-02 17:38:31', '2022-06-02 22:38:31'),
(5, 1, 'Usuarios.ver', '2022-06-02 17:38:31', '2022-06-02 22:38:31'),
(6, 1, 'Usuarios.cambiarContrasena', '2022-06-02 17:38:31', '2022-06-02 22:38:31'),
(7, 2, 'Usuarios.index', '2022-06-02 17:38:46', '2022-06-02 22:38:46'),
(8, 2, 'Usuarios.ver', '2022-06-02 17:38:46', '2022-06-02 22:38:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `IdRoles` int(11) NOT NULL,
  `NombreRol` varchar(45) NOT NULL,
  `FechaHoraCreacion` datetime NOT NULL DEFAULT current_timestamp(),
  `FechaHoraModificacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`IdRoles`, `NombreRol`, `FechaHoraCreacion`, `FechaHoraModificacion`) VALUES
(1, 'ADMINISTRADOR', '2022-05-31 20:27:49', '2022-06-01 01:27:49'),
(2, 'USUARIO', '2022-05-31 22:34:29', '2022-06-01 03:34:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `IdUsuarios` int(11) NOT NULL,
  `NumeroDocumentoIdentidad` varchar(15) NOT NULL,
  `Nombres` varchar(45) NOT NULL,
  `Apellidos` varchar(45) NOT NULL,
  `CorreoElectronico` varchar(45) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `IdRoles` int(11) NOT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1. Activo 0. Inactivo',
  `FechaHoraCreacion` datetime NOT NULL DEFAULT current_timestamp(),
  `FechaHoraModificacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`IdUsuarios`, `NumeroDocumentoIdentidad`, `Nombres`, `Apellidos`, `CorreoElectronico`, `Password`, `IdRoles`, `Estado`, `FechaHoraCreacion`, `FechaHoraModificacion`) VALUES
(1, '1144162860', 'MIGUEL', 'LOPEZ', 'MIGUEL_20@HOTMAIL.ES', '$2y$10$1IGg/W2u2lgErBN7VpujxeRHw/hs/YRlSVTqcbtwgID2/MvJLHepG', 1, 1, '2022-05-31 20:31:00', '2022-06-02 21:53:04'),
(2, '66958301', 'DIANA', 'CABRERA', 'DIANA.CABRERA1001@GMAIL.COM', '$2y$10$Q8Jshb50bhM4NYDTxh5FpuH5EYUUjqUG2EftPCX8gwc5hqL0YopUq', 2, 1, '2022-05-31 20:32:19', '2022-06-02 23:07:47');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`IdPermisos`),
  ADD KEY `FK_permisos_roles_idx` (`IdRoles`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`IdRoles`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`IdUsuarios`),
  ADD UNIQUE KEY `Email_UNIQUE` (`CorreoElectronico`),
  ADD UNIQUE KEY `NumeroDocumentoIdentidad_UNIQUE` (`NumeroDocumentoIdentidad`),
  ADD KEY `FK_usuarios_roles_idx` (`IdRoles`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `IdPermisos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `IdRoles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `IdUsuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `FK_permisos_roles` FOREIGN KEY (`IdRoles`) REFERENCES `roles` (`IdRoles`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_usuarios_roles` FOREIGN KEY (`IdRoles`) REFERENCES `roles` (`IdRoles`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
