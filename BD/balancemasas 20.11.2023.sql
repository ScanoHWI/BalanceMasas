-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2023 a las 17:34:01
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `balancemasas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `balancemasas_componentes`
--

CREATE TABLE `balancemasas_componentes` (
  `id_componente` int(11) NOT NULL,
  `numeroComponente` varchar(200) NOT NULL,
  `descripcionComponente` varchar(200) NOT NULL,
  `unidad` varchar(100) NOT NULL,
  `PesoResinaRealGR` double NOT NULL,
  `RamalPorcentaje` double NOT NULL,
  `ScrapRealPorcentaje` double NOT NULL,
  `PesoRecinaKilogramos` double NOT NULL,
  `PesoScrapKilogramos` double NOT NULL,
  `FechaEdicion` date NOT NULL,
  `estadoComponente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `balancemasas_componentes`
--

INSERT INTO `balancemasas_componentes` (`id_componente`, `numeroComponente`, `descripcionComponente`, `unidad`, `PesoResinaRealGR`, `RamalPorcentaje`, `ScrapRealPorcentaje`, `PesoRecinaKilogramos`, `PesoScrapKilogramos`, `FechaEdicion`, `estadoComponente`) VALUES
(1, '100211', 'prueba componente', 'GR', 1.09, 1.19, 1.21, 1.55, 2.65, '2023-11-20', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `balancemasas_estados`
--

CREATE TABLE `balancemasas_estados` (
  `id` int(11) NOT NULL,
  `descripcionEstado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `balancemasas_estados`
--

INSERT INTO `balancemasas_estados` (`id`, `descripcionEstado`) VALUES
(1, 'Activo'),
(2, 'Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `balancemasas_inyecciones`
--

CREATE TABLE `balancemasas_inyecciones` (
  `idInyeccion` int(11) NOT NULL,
  `idMaterial` int(11) NOT NULL,
  `IdProveedor` int(11) NOT NULL,
  `FechaInyeccion` datetime NOT NULL,
  `PesoResinaKG` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `balancemasas_inyecciones`
--

INSERT INTO `balancemasas_inyecciones` (`idInyeccion`, `idMaterial`, `IdProveedor`, `FechaInyeccion`, `PesoResinaKG`) VALUES
(1, 1, 123456, '1970-01-01 01:00:00', 2.13),
(2, 1, 123456, '1970-01-01 01:00:00', 2.12),
(3, 1, 123456, '0000-00-00 00:00:00', 3.11),
(4, 1, 123456, '1970-01-01 01:00:00', 4.11),
(5, 1, 123456, '2023-08-15 10:44:00', 11.1),
(6, 1, 123456, '1970-01-01 01:00:00', 99.1),
(7, 1, 123456, '1970-01-01 01:00:00', 0),
(8, 1, 123456, '2023-11-20 11:02:53', 22.11),
(9, 1, 123456, '0000-00-00 00:00:00', 0),
(10, 1, 123456, '2023-09-20 11:04:51', 0),
(11, 1, 123456, '2023-10-20 11:06:48', 2.11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `balancemasas_materiales`
--

CREATE TABLE `balancemasas_materiales` (
  `id_material` int(11) NOT NULL,
  `materialid` varchar(50) NOT NULL,
  `denominacion` varchar(200) NOT NULL,
  `FechaEdicion` date NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `balancemasas_materiales`
--

INSERT INTO `balancemasas_materiales` (`id_material`, `materialid`, `denominacion`, `FechaEdicion`, `estado`) VALUES
(1, 'w1', 'Tuercas de seguridad', '2023-11-20', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `balancemasas_materialescomponentes`
--

CREATE TABLE `balancemasas_materialescomponentes` (
  `MaterialID` int(11) NOT NULL,
  `ComponenteID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `balancemasas_materialescomponentes`
--

INSERT INTO `balancemasas_materialescomponentes` (`MaterialID`, `ComponenteID`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `balancemasas_roles`
--

CREATE TABLE `balancemasas_roles` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `balancemasas_roles`
--

INSERT INTO `balancemasas_roles` (`id`, `descripcion`) VALUES
(1, 'Administrador'),
(2, 'Proveedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `balancemasas_usuarios`
--

CREATE TABLE `balancemasas_usuarios` (
  `id` int(11) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `nit` varchar(20) NOT NULL,
  `contrasena` varchar(500) NOT NULL,
  `rol_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `balancemasas_usuarios`
--

INSERT INTO `balancemasas_usuarios` (`id`, `correo`, `nombre`, `nit`, `contrasena`, `rol_id`) VALUES
(1, 'administrador.smartcenter@hacebwhirlpool.com', 'Samuel Cano Ocampo', '1001250449', 'HWI2023*', 1),
(123456, 'haceb@gmail.com', 'Haceb', '1020', '123', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `balancemasas_usuariosmateriales`
--

CREATE TABLE `balancemasas_usuariosmateriales` (
  `UsuarioID` int(20) NOT NULL,
  `MaterialID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `balancemasas_usuariosmateriales`
--

INSERT INTO `balancemasas_usuariosmateriales` (`UsuarioID`, `MaterialID`) VALUES
(123456, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `balancemasas_componentes`
--
ALTER TABLE `balancemasas_componentes`
  ADD PRIMARY KEY (`id_componente`),
  ADD KEY `estado` (`estadoComponente`);

--
-- Indices de la tabla `balancemasas_estados`
--
ALTER TABLE `balancemasas_estados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `balancemasas_inyecciones`
--
ALTER TABLE `balancemasas_inyecciones`
  ADD PRIMARY KEY (`idInyeccion`),
  ADD KEY `idMaterial` (`idMaterial`);

--
-- Indices de la tabla `balancemasas_materiales`
--
ALTER TABLE `balancemasas_materiales`
  ADD PRIMARY KEY (`id_material`),
  ADD KEY `estado` (`estado`);

--
-- Indices de la tabla `balancemasas_materialescomponentes`
--
ALTER TABLE `balancemasas_materialescomponentes`
  ADD KEY `MaterialID` (`MaterialID`,`ComponenteID`),
  ADD KEY `ComponenteID` (`ComponenteID`);

--
-- Indices de la tabla `balancemasas_roles`
--
ALTER TABLE `balancemasas_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `balancemasas_usuarios`
--
ALTER TABLE `balancemasas_usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rol_id` (`rol_id`);

--
-- Indices de la tabla `balancemasas_usuariosmateriales`
--
ALTER TABLE `balancemasas_usuariosmateriales`
  ADD KEY `UsuarioID` (`UsuarioID`,`MaterialID`),
  ADD KEY `MaterialID` (`MaterialID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `balancemasas_componentes`
--
ALTER TABLE `balancemasas_componentes`
  MODIFY `id_componente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `balancemasas_estados`
--
ALTER TABLE `balancemasas_estados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `balancemasas_inyecciones`
--
ALTER TABLE `balancemasas_inyecciones`
  MODIFY `idInyeccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `balancemasas_materiales`
--
ALTER TABLE `balancemasas_materiales`
  MODIFY `id_material` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `balancemasas_roles`
--
ALTER TABLE `balancemasas_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `balancemasas_usuarios`
--
ALTER TABLE `balancemasas_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123457;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `balancemasas_componentes`
--
ALTER TABLE `balancemasas_componentes`
  ADD CONSTRAINT `balancemasas_componentes_ibfk_1` FOREIGN KEY (`estadoComponente`) REFERENCES `balancemasas_estados` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `balancemasas_materiales`
--
ALTER TABLE `balancemasas_materiales`
  ADD CONSTRAINT `balancemasas_materiales_ibfk_1` FOREIGN KEY (`estado`) REFERENCES `balancemasas_estados` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `balancemasas_materiales_ibfk_2` FOREIGN KEY (`id_material`) REFERENCES `balancemasas_inyecciones` (`idMaterial`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `balancemasas_materialescomponentes`
--
ALTER TABLE `balancemasas_materialescomponentes`
  ADD CONSTRAINT `balancemasas_materialescomponentes_ibfk_1` FOREIGN KEY (`MaterialID`) REFERENCES `balancemasas_materiales` (`id_material`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `balancemasas_materialescomponentes_ibfk_2` FOREIGN KEY (`ComponenteID`) REFERENCES `balancemasas_componentes` (`id_componente`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `balancemasas_usuarios`
--
ALTER TABLE `balancemasas_usuarios`
  ADD CONSTRAINT `balancemasas_usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `balancemasas_roles` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `balancemasas_usuariosmateriales`
--
ALTER TABLE `balancemasas_usuariosmateriales`
  ADD CONSTRAINT `balancemasas_usuariosmateriales_ibfk_1` FOREIGN KEY (`UsuarioID`) REFERENCES `balancemasas_usuarios` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `balancemasas_usuariosmateriales_ibfk_2` FOREIGN KEY (`MaterialID`) REFERENCES `balancemasas_materiales` (`id_material`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
