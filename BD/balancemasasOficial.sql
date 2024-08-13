-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-10-2023 a las 19:19:01
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
-- Estructura de tabla para la tabla `balancemasas_materiales`
--

CREATE TABLE `balancemasas_materiales` (
  `id_material` int(11) NOT NULL,
  `materialid` varchar(50) NOT NULL,
  `denominacion` varchar(200) NOT NULL,
  `FechaEdicion` date NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `balancemasas_materialescomponentes`
--

CREATE TABLE `balancemasas_materialescomponentes` (
  `MaterialID` int(11) NOT NULL,
  `ComponenteID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'administrador.smartcenter@hacebwhirlpool.com', 'Samuel Cano Ocampo', '1001250449', 'HWI2023*', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `balancemasas_usuariosmateriales`
--

CREATE TABLE `balancemasas_usuariosmateriales` (
  `UsuarioID` int(20) NOT NULL,
  `MaterialID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `id_componente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `balancemasas_estados`
--
ALTER TABLE `balancemasas_estados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `balancemasas_materiales`
--
ALTER TABLE `balancemasas_materiales`
  MODIFY `id_material` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `balancemasas_roles`
--
ALTER TABLE `balancemasas_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `balancemasas_usuarios`
--
ALTER TABLE `balancemasas_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  ADD CONSTRAINT `balancemasas_materiales_ibfk_1` FOREIGN KEY (`estado`) REFERENCES `balancemasas_estados` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

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
