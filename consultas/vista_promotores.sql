-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-01-2015 a las 01:10:05
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `pfg`
--

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_promotores`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_promotores` AS select `a`.`id` AS `id`,concat(ltrim(rtrim(`pe`.`nombres`)),' ',ltrim(rtrim(`pe`.`apellido_paterno`)),' ',ltrim(rtrim(`pe`.`apellido_materno`))) AS `Promotor` from ((`promotor` `p` left join `asesor` `a` on((`p`.`promotor_id` = `a`.`id`))) left join `persona` `pe` on((`a`.`persona_id` = `pe`.`id`))) where (`p`.`promotor_id` = `p`.`asesor_id`);

--
-- VIEW  `vista_promotores`
-- Datos: Ninguna
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
