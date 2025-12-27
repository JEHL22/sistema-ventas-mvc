-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-12-2025 a las 01:42:49
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_empresa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `IDCategoria` int(11) NOT NULL,
  `NombreCategoria` varchar(100) DEFAULT NULL,
  `Descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`IDCategoria`, `NombreCategoria`, `Descripcion`) VALUES
(1, 'Bebidas', 'Refrescos, cafés, tés, cervezas y cervezas.\r\n'),
(2, 'Condimentos', 'Salsas, condimentos, productos para untar y condimentos dulces y salados\r\n'),
(3, 'Dulces', 'Postres, dulces y panes dulces.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `IDCliente` int(11) NOT NULL,
  `NombreCliente` varchar(100) DEFAULT NULL,
  `NombreContacto` varchar(100) DEFAULT NULL,
  `Direccion` varchar(200) DEFAULT NULL,
  `Ciudad` varchar(100) DEFAULT NULL,
  `CodigoPostal` varchar(20) DEFAULT NULL,
  `Pais` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`IDCliente`, `NombreCliente`, `NombreContacto`, `Direccion`, `Ciudad`, `CodigoPostal`, `Pais`) VALUES
(1, 'Alfreds Futterkiste', 'Maria Anders', 'Obere Str. 57', 'Berlin', '12209', 'Germany'),
(2, 'Ana Trujillo Emparedados y helados', 'Ana Trujillo ', 'Avda. de la Constitución 2222', 'México D.F.', '05021', 'Mexico'),
(3, 'Antonio Moreno Taquería', 'Antonio Moreno', 'Mataderos 2312', 'México D.F. ', '05023', 'Mexico'),
(4, 'helbert', 'helbert', 'helbert', 'lima', '512364', 'peru');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallespedidos`
--

CREATE TABLE `detallespedidos` (
  `IDDetalle` int(11) NOT NULL,
  `IDPedido` int(11) DEFAULT NULL,
  `IDProducto` int(11) DEFAULT NULL,
  `Cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detallespedidos`
--

INSERT INTO `detallespedidos` (`IDDetalle`, `IDPedido`, `IDProducto`, `Cantidad`) VALUES
(1, 1, 1, 50),
(2, 3, 2, 40),
(3, 3, 1, 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `IDEmpleado` int(11) NOT NULL,
  `ApellidoEmpleado` varchar(100) DEFAULT NULL,
  `NombreEmpleado` varchar(100) DEFAULT NULL,
  `FechaNacimiento` date DEFAULT NULL,
  `Foto` blob DEFAULT NULL,
  `Notas` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`IDEmpleado`, `ApellidoEmpleado`, `NombreEmpleado`, `FechaNacimiento`, `Foto`, `Notas`) VALUES
(1, 'Davolio ', 'Nancy ', '1968-08-12', 0x666f746f20312e6a7067, 'La educación incluye una licenciatura en psicología de la Universidad Estatal de Colorado.'),
(2, 'Fuller', 'Andrew', '1952-12-02', 0x666f746f20322e6a7067, 'Andrew recibió su comercial de BTS y un doctorado. en marketing internacional de la Universidad de Dallas.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expedidores`
--

CREATE TABLE `expedidores` (
  `IDExpedidor` int(11) NOT NULL,
  `NombreExpedidor` varchar(100) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `expedidores`
--

INSERT INTO `expedidores` (`IDExpedidor`, `NombreExpedidor`, `Telefono`) VALUES
(1, 'Speedy Express', '(503) 555-9831 '),
(2, 'United Package', '(503) 555-3199 '),
(3, 'Federal Shipping ', '(503) 555-9931');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `IDPedido` int(11) NOT NULL,
  `IDCliente` int(11) DEFAULT NULL,
  `IDEmpleado` int(11) DEFAULT NULL,
  `FechaPedido` date DEFAULT NULL,
  `IDExpedidor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`IDPedido`, `IDCliente`, `IDEmpleado`, `FechaPedido`, `IDExpedidor`) VALUES
(1, 1, 1, '2024-07-17', 1),
(2, 1, 2, '2024-07-17', 2),
(3, 4, 2, '2024-07-17', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `IDProducto` int(11) NOT NULL,
  `NombreProducto` varchar(100) DEFAULT NULL,
  `IDProveedor` int(11) DEFAULT NULL,
  `IDCategoria` int(11) DEFAULT NULL,
  `Unidad` varchar(50) DEFAULT NULL,
  `Precio` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`IDProducto`, `NombreProducto`, `IDProveedor`, `IDCategoria`, `Unidad`, `Precio`) VALUES
(1, 'sillas', 1, 1, '10 cajas x 20 bolsas', 18.00),
(2, 'Jarabe de anís', 2, 2, '12 - 550 ml bottles', 10.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `IDProveedor` int(11) NOT NULL,
  `NombreProveedor` varchar(100) DEFAULT NULL,
  `NombreContacto` varchar(100) DEFAULT NULL,
  `Direccion` varchar(200) DEFAULT NULL,
  `Ciudad` varchar(100) DEFAULT NULL,
  `CodigoPostal` varchar(20) DEFAULT NULL,
  `Pais` varchar(50) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`IDProveedor`, `NombreProveedor`, `NombreContacto`, `Direccion`, `Ciudad`, `CodigoPostal`, `Pais`, `Telefono`) VALUES
(1, 'Exotic Liquid 	', 'Charlotte Cooper 	', '49 Gilbert St. 	', 'Londona ', 'EC1 4SD 	', 'UK ', '(171) 555-2222 '),
(2, 'New Orleans Cajun Delights', 'Shelley Burke', 'P.O. Box 78934', 'New Orleans', '70117', 'USA ', '(100) 555-4822 ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `IDUsuario` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`IDUsuario`, `usuario`, `contrasena`, `nombre`, `correo`) VALUES
(1, 'admin', '$2y$10$oiwJMgaYhlY4SSlp0g2Q9OIsMBkHMwvyb1IXT9xfmw1bGAdxDQe6O', 'Julio', 'julio@unac.edu.pe');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`IDCategoria`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`IDCliente`);

--
-- Indices de la tabla `detallespedidos`
--
ALTER TABLE `detallespedidos`
  ADD PRIMARY KEY (`IDDetalle`),
  ADD KEY `IDPedido` (`IDPedido`),
  ADD KEY `IDProducto` (`IDProducto`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`IDEmpleado`);

--
-- Indices de la tabla `expedidores`
--
ALTER TABLE `expedidores`
  ADD PRIMARY KEY (`IDExpedidor`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`IDPedido`),
  ADD KEY `IDCliente` (`IDCliente`),
  ADD KEY `IDEmpleado` (`IDEmpleado`),
  ADD KEY `IDExpedidor` (`IDExpedidor`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`IDProducto`),
  ADD KEY `IDProveedor` (`IDProveedor`),
  ADD KEY `IDCategoria` (`IDCategoria`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`IDProveedor`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`IDUsuario`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `IDCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `IDCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `detallespedidos`
--
ALTER TABLE `detallespedidos`
  MODIFY `IDDetalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `IDEmpleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `expedidores`
--
ALTER TABLE `expedidores`
  MODIFY `IDExpedidor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `IDPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `IDProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `IDProveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `IDUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detallespedidos`
--
ALTER TABLE `detallespedidos`
  ADD CONSTRAINT `detallespedidos_ibfk_1` FOREIGN KEY (`IDPedido`) REFERENCES `pedidos` (`IDPedido`),
  ADD CONSTRAINT `detallespedidos_ibfk_2` FOREIGN KEY (`IDProducto`) REFERENCES `productos` (`IDProducto`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`IDCliente`) REFERENCES `clientes` (`IDCliente`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`IDEmpleado`) REFERENCES `empleados` (`IDEmpleado`),
  ADD CONSTRAINT `pedidos_ibfk_3` FOREIGN KEY (`IDExpedidor`) REFERENCES `expedidores` (`IDExpedidor`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`IDProveedor`) REFERENCES `proveedores` (`IDProveedor`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`IDCategoria`) REFERENCES `categorias` (`IDCategoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
