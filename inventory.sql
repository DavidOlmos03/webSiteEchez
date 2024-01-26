-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-01-2024 a las 19:26:15
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
-- Base de datos: `inventory`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alquilado`
--

CREATE TABLE `alquilado` (
  `Id` int(11) NOT NULL,
  `User_Name` varchar(255) DEFAULT NULL,
  `Serial` varchar(255) NOT NULL,
  `PC_Name` varchar(255) DEFAULT NULL,
  `Installation_Date` date DEFAULT NULL,
  `Plate_PC` float DEFAULT NULL,
  `Specifications` varchar(255) DEFAULT NULL,
  `Ram` varchar(255) DEFAULT NULL,
  `Desktop_Laptop` varchar(255) DEFAULT NULL,
  `Domain` varchar(255) DEFAULT NULL,
  `Status_PC` tinyint(1) NOT NULL,
  `dateUpdate_Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alquilado`
--

INSERT INTO `alquilado` (`Id`, `User_Name`, `Serial`, `PC_Name`, `Installation_Date`, `Plate_PC`, `Specifications`, `Ram`, `Desktop_Laptop`, `Domain`, `Status_PC`, `dateUpdate_Date`) VALUES
(2, 'Alexandra Reinosa', '5CD209B7RT', 'ECHEZCOLB7RTA', '2023-11-15', 66374, '11th Gen Intel(R) Core(TM) i5-1135G7 @ 2.40GHz (8 virtual) (X64)', '16GB', 'Laptop', 'Echez', 0, '2023-11-28'),
(3, 'Camilo Andrés Pinzón Mora', 'BLN4G63', 'ECHEZCOLBLN4A', '0000-00-00', 45441, 'Intel(R) Core(TM) i5-10210U CPU @ 1.60GHz (8 virtual) (X64)', '16GB', 'Laptop', 'Echez', 1, NULL),
(4, 'Adriana Lucia Prieto', 'CT0WGB3', 'ECHEZCOLWGB3A', '0000-00-00', 44155, '11th Gen Intel(R) Core(TM) i5-1135G7 @ 2.40GHz (8 virtual) (X64)', '16GB', 'Laptop', 'Echez', 1, NULL),
(5, 'Alfonso Eduardo Palau Agudelo', '6CJYGJ3', 'ECHEZCOL6CJYA', '0000-00-00', 59448, '11th Gen Intel(R) Core(TM) i5-1135G7 @ 2.40GHz (8 virtual) (X64)', '16GB', 'Laptop', 'Echez', 1, NULL),
(9, 'Angie Dayanna Maldonado ', '5CD211HGST', 'ECHEZCOLHGSTA', '2010-12-22', 0, '11th Gen Intel(R) Core(TM) i5-1135G7 @ 2.40GHz (8 virtual) (X64)', '16GB', 'Laptop', 'Echez', 1, NULL),
(10, 'Carmen Veronica Restrepo', '5CD211HH8G', 'ECHEZCOLHH8GA', '0000-00-00', 63573, '11th Gen Intel(R) Core(TM) i5-1135G7 @ 2.40GHz (8 virtual) (X64)', '16GB', 'Laptop', 'Echez', 1, NULL),
(11, 'Christian Camilo Segura Medina', 'J8N4G63', 'ECHEZCOLJ8N4A', '0000-00-00', 45501, 'Intel(R) Core(TM) i5-10210U CPU @ 1.60GHz (8 virtual) (X64)', '16GB', 'Laptop', 'Echez', 1, NULL),
(12, 'Claudia Landazury Mosquera', 'PF11LPV8', 'ECHEZCOLLPV8A', '0000-00-00', 19305, 'Intel(R) Core(TM) i5-8250U CPU @ 1.60GHz (8 virtual) (X64)', '16GB', 'Laptop', 'Echez', 1, NULL),
(13, 'Claudia Patricia Lopez Gaviria', '5CD208G001', 'ECHEZCOLG001A', '0000-00-00', 66121, '11th Gen Intel(R) Core(TM) i7-1165G7 @ 2.80GHz (8 virtual) (X64)', '16GB', 'Laptop', 'Echez', 1, NULL),
(14, 'Daniela Muñeton', '5CD209B7PR', 'ECHEZCOLB7PRA', '0000-00-00', 66384, '11th Gen Intel(R) Core(TM) i5-1135G7 @ 2.40GHz (8 virtual) (X64)', '16GB', 'Laptop', 'Echez', 1, NULL),
(15, 'Danilo García Valencia ', 'BBXB943', 'ECHEZCOLB943A', '0000-00-00', 39139, 'Intel(R) Core(TM) i5-10210U CPU @ 1.60GHz (8 virtual) (X64)', '16GB', 'Laptop', 'Echez', 1, NULL),
(16, 'Estefanía Posso Vasquez', '6XTKDL3', 'ECHEZCOLKDL3A', '0000-00-00', 67487, '11th Gen Intel(R) Core(TM) i5-1135G7 @ 2.40GHz (8 virtual) (X64)', '16GB', 'Laptop', 'Echez', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formulario_licenciamiento`
--

CREATE TABLE `formulario_licenciamiento` (
  `Id` int(11) NOT NULL,
  `Applicant` varchar(255) DEFAULT NULL,
  `Area` varchar(255) DEFAULT NULL,
  `LicenseType` varchar(255) DEFAULT NULL,
  `Budget` decimal(10,2) DEFAULT NULL,
  `Cost` decimal(10,2) DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `CostCenter` varchar(255) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `formulario_licenciamiento`
--

INSERT INTO `formulario_licenciamiento` (`Id`, `Applicant`, `Area`, `LicenseType`, `Budget`, `Cost`, `StartDate`, `EndDate`, `CostCenter`, `Quantity`) VALUES
(1, 'Juan David Ruiz Olmos', 'TI', 'NN', 500000.00, NULL, '2023-12-13', '2023-12-14', 'Echez', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`Id`, `Name`, `Description`) VALUES
(1, 'Admin-Global', 'Permisos para realizar cualquier operación, incluyendo el control sobre los usuarios y roles'),
(2, 'Admin', 'Permisos para el control absoluto de la página, excepto el control sobre los usuarios y roles'),
(13, 'IT Project', 'Acceso a los proyectos de TI'),
(14, 'Analytics Project', 'Acceso a los proyectos de analítica'),
(15, 'Inventory', 'Acceso al inventario de computadoras'),
(16, 'Approvals', 'Acceso a aprovaciones de licencias');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_usuario`
--

CREATE TABLE `rol_usuario` (
  `FkIdUsuario` int(11) DEFAULT NULL,
  `FkIdRol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol_usuario`
--

INSERT INTO `rol_usuario` (`FkIdUsuario`, `FkIdRol`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Id`, `Name`, `Email`, `Password`) VALUES
(1, 'Juan David Ruiz Olmos', 'juan.ruiz@e-chez.com', '$2a$12$4DL1ij6vVza3//u9w/InSeOrTQwweDS9We1N2o0QQio96cLdFOcYm'),
(2, 'Luis Fernando Gómez Urrego', 'luis.gomez@e-chez.com', '$2y$10$0N9HJ0uyMneFiGLjeG3EE.k3n/3tZxMKJcNoOaZAppUZJEisrr5eO'),
(3, 'Sebastián Posada Marín', 'sebastian.posada@e-chez.com', '$2y$10$IiTbwAd1kSwxPgRZB9.lye2tZexyYbplvyXNnIFW4kOu3VREOMrFy');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alquilado`
--
ALTER TABLE `alquilado`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `formulario_licenciamiento`
--
ALTER TABLE `formulario_licenciamiento`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `rol_usuario`
--
ALTER TABLE `rol_usuario`
  ADD KEY `FkIdUsuario` (`FkIdUsuario`),
  ADD KEY `FkIdRol` (`FkIdRol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alquilado`
--
ALTER TABLE `alquilado`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `formulario_licenciamiento`
--
ALTER TABLE `formulario_licenciamiento`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `rol_usuario`
--
ALTER TABLE `rol_usuario`
  ADD CONSTRAINT `rol_usuario_ibfk_1` FOREIGN KEY (`FkIdUsuario`) REFERENCES `usuario` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rol_usuario_ibfk_2` FOREIGN KEY (`FkIdRol`) REFERENCES `rol` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
