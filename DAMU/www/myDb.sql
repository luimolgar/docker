-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 21-05-2020 a las 20:08:29
-- Versión del servidor: 5.7.13
-- Versión de PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `myDb`
--
CREATE DATABASE IF NOT EXISTS `myDb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin;
USE `myDb`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--

CREATE TABLE IF NOT EXISTS `documentos` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `img` varchar(40) NOT NULL,
  `nombreuser` varchar(40) NOT NULL,
  `nombredocu` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nombreuser` (`nombreuser`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `fotos`
--

INSERT INTO `documentos` (`id`, `fecha`, `img`, `nombreuser`, `nombredocu`) VALUES
(74, '2020-03-05 10:28:02', '../recursos/ana/Tulips.jpg', 'ana', 'Tulips.jpg'),
(77, '2020-03-05 13:52:20', '../recursos/Antonio/Jellyfish.jpg', 'Antonio', 'Jellyfish.jpg'),
(78, '2020-03-05 13:52:24', '../recursos/Antonio/Desert.jpg', 'Antonio', 'Desert.jpg'),
(81, '2020-03-05 13:55:14', '../recursos/luisa/Tulips.jpg', 'luisa', 'Tulips.jpg'),
(82, '2020-03-05 13:55:19', '../recursos/luisa/Hydrangeas.jpg', 'luisa', 'Hydrangeas.jpg'),
(89, '2020-05-21 19:25:39', '../recursos/prueba/a.png', 'prueba', 'a.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `contraseña` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombre`, `email`, `contraseña`) VALUES
(1, 'Administrador', 'admin@admin.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(2, 'ana', 'ana@ana.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(24, 'Antonio', 'antonio@antonio.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(25, 'luisa', 'luisa@luisa.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(26, 'user', 'user@user.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(28, 'prueba', 'prueba@prueba.es', 'b59c67bf196a4758191e42f76670ceba');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
