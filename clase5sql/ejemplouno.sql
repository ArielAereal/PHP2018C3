-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-04-2018 a las 01:16:51
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ejemplouno`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puestotrabajo`
--

CREATE TABLE `puestotrabajo` (
  `Idpuesto` int(11) NOT NULL,
  `Descripción` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `Piso` int(11) NOT NULL,
  `Sector` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `puestotrabajo`
--

INSERT INTO `puestotrabajo` (`Idpuesto`, `Descripción`, `Piso`, `Sector`) VALUES
(1, 'Windows 7', 2, 'Soporte'),
(2, 'Windows 95', 3, 'Testing'),
(3, 'Debian', 4, 'Desarrollo'),
(4, 'Ubuntu', 4, 'Desarrollo'),
(5, 'Parrot', 6, 'Seguridad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Idusuario` int(11) NOT NULL,
  `Nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Idusuario`, `Nombre`) VALUES
(7, 'María'),
(8, 'José'),
(9, 'Jesús');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario-trabajo`
--

CREATE TABLE `usuario-trabajo` (
  `Idusuariotrabajo` int(11) NOT NULL,
  `Idusuario` int(11) NOT NULL,
  `Idpuesto` int(11) NOT NULL,
  `Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario-trabajo`
--

INSERT INTO `usuario-trabajo` (`Idusuariotrabajo`, `Idusuario`, `Idpuesto`, `Fecha`) VALUES
(1, 7, 1, '2018-03-01'),
(2, 7, 1, '2018-04-01'),
(3, 7, 5, '2018-02-01'),
(4, 8, 3, '2018-01-01'),
(5, 8, 3, '2018-03-10'),
(6, 9, 4, '2018-05-01');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `puestotrabajo`
--
ALTER TABLE `puestotrabajo`
  ADD PRIMARY KEY (`Idpuesto`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Idusuario`);

--
-- Indices de la tabla `usuario-trabajo`
--
ALTER TABLE `usuario-trabajo`
  ADD PRIMARY KEY (`Idusuariotrabajo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `puestotrabajo`
--
ALTER TABLE `puestotrabajo`
  MODIFY `Idpuesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `usuario-trabajo`
--
ALTER TABLE `usuario-trabajo`
  MODIFY `Idusuariotrabajo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
