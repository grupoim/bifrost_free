-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-01-2015 a las 01:09:41
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
-- Estructura para la vista `vista_asesor_promotor`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_asesor_promotor` AS select `pe`.`id` AS `id_persona_asesor`,`p`.`asesor_id` AS `id_asesor`,concat(rtrim(ltrim(`pe`.`nombres`)),' ',rtrim(ltrim(`pe`.`apellido_paterno`)),' ',rtrim(ltrim(`pe`.`apellido_materno`))) AS `Asesor`,`pe`.`sexo` AS `sexo`,`pe`.`fecha_nacimiento` AS `fecha_nacimiento`,`s`.`fecha_ingreso` AS `fecha_ingreso`,`s`.`activo` AS `activo`,`pe1`.`id` AS `id_persona_promotor`,`p`.`promotor_id` AS `id_promotor`,concat(rtrim(ltrim(`pe1`.`nombres`)),' ',rtrim(ltrim(`pe1`.`apellido_paterno`)),' ',rtrim(ltrim(`pe1`.`apellido_materno`))) AS `Promotor` from ((((`promotor` `p` left join `asesor` `s` on((`p`.`asesor_id` = `s`.`id`))) left join `asesor` `s1` on((`p`.`promotor_id` = `s1`.`id`))) left join `persona` `pe` on((`s`.`persona_id` = `pe`.`id`))) left join `persona` `pe1` on((`s1`.`persona_id` = `pe1`.`id`)));

--
-- VIEW  `vista_asesor_promotor`
-- Datos: Ninguna
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
