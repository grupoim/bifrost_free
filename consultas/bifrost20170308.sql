-- MySQL dump 10.13  Distrib 5.6.24, for Win64 (x86_64)
--
-- Host: 192.168.10.70    Database: pfg_bifrost
-- ------------------------------------------------------
-- Server version	5.6.24-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `abono_comision`
--

DROP TABLE IF EXISTS `abono_comision`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `abono_comision` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `periodo_comision_id` int(11) NOT NULL,
  `comision_id` int(11) NOT NULL,
  `monto` double NOT NULL,
  `fecha` date NOT NULL,
  `cancelado` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `pagado` tinyint(1) NOT NULL DEFAULT '0',
  `asesor_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pago_comision_comision1_idx` (`comision_id`),
  KEY `fk_abono_comision_periodo_comision1_idx` (`periodo_comision_id`),
  KEY `fk_abono_comision_asesor1_idx` (`asesor_id`),
  CONSTRAINT `fk_abono_comision_asesor1` FOREIGN KEY (`asesor_id`) REFERENCES `asesor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_abono_comision_periodo_comision1` FOREIGN KEY (`periodo_comision_id`) REFERENCES `periodo_comision` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pago_comision_comision1` FOREIGN KEY (`comision_id`) REFERENCES `comision` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9501 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `abono_prestamo`
--

DROP TABLE IF EXISTS `abono_prestamo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `abono_prestamo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `monto` double NOT NULL,
  `prestamo_id` int(11) DEFAULT NULL,
  `asistencia_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_abono_prestamo_prestamo1_idx` (`prestamo_id`),
  KEY `fk_abono_prestamo_asistencia1_idx` (`asistencia_id`),
  CONSTRAINT `fk_abono_prestamo_asistencia1` FOREIGN KEY (`asistencia_id`) REFERENCES `asistencia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_abono_prestamo_prestamo1` FOREIGN KEY (`prestamo_id`) REFERENCES `prestamo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `accion`
--

DROP TABLE IF EXISTS `accion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary view structure for view `advertencia_comision_activa`
--

DROP TABLE IF EXISTS `advertencia_comision_activa`;
/*!50001 DROP VIEW IF EXISTS `advertencia_comision_activa`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `advertencia_comision_activa` AS SELECT 
 1 AS `id`,
 1 AS `comision_id`,
 1 AS `created_at`,
 1 AS `motivos`,
 1 AS `activo`,
 1 AS `updated_at`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `almacen`
--

DROP TABLE IF EXISTS `almacen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `almacen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `departamento_id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_almacen_departamento1_idx` (`departamento_id`),
  CONSTRAINT `fk_almacen_departamento1` FOREIGN KEY (`departamento_id`) REFERENCES `departamento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `anticipo_comision`
--

DROP TABLE IF EXISTS `anticipo_comision`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anticipo_comision` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `monto` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fecha` date NOT NULL,
  `aplicado` tinyint(1) NOT NULL DEFAULT '0',
  `motivos` text,
  `comision_id` int(11) NOT NULL,
  `folio` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_anticipo_comision_comision1_idx` (`comision_id`),
  CONSTRAINT `fk_anticipo_comision_comision1` FOREIGN KEY (`comision_id`) REFERENCES `comision` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `asesor`
--

DROP TABLE IF EXISTS `asesor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asesor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `persona_id` int(11) NOT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `email` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`,`persona_id`),
  KEY `fk_asesor_persona1_idx` (`persona_id`),
  CONSTRAINT `fk_asesor_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=200 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `asistencia`
--

DROP TABLE IF EXISTS `asistencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asistencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sa` tinyint(1) NOT NULL DEFAULT '0',
  `do` tinyint(1) NOT NULL DEFAULT '0',
  `lu` tinyint(1) NOT NULL DEFAULT '0',
  `ma` tinyint(1) NOT NULL DEFAULT '0',
  `mi` tinyint(1) NOT NULL DEFAULT '0',
  `ju` tinyint(1) NOT NULL DEFAULT '0',
  `vi` tinyint(1) NOT NULL DEFAULT '0',
  `observaciones` longtext,
  `lista_id` int(11) NOT NULL,
  `empleado_id` int(11) NOT NULL,
  `revisado` tinyint(1) NOT NULL DEFAULT '0',
  `hora_extra` tinyint(1) NOT NULL DEFAULT '0',
  `prima_dominical` tinyint(1) NOT NULL DEFAULT '0',
  `vacaciones` int(11) NOT NULL DEFAULT '0',
  `festivo` tinyint(1) NOT NULL DEFAULT '0',
  `semana_completa` tinyint(1) NOT NULL DEFAULT '0',
  `dias_pago` double NOT NULL DEFAULT '0',
  `revision_contabilidad` tinyint(4) NOT NULL DEFAULT '0',
  `nomina` double NOT NULL DEFAULT '0',
  `nomina_ss` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_asistencia_lista1_idx` (`lista_id`),
  KEY `fk_asistencia_empleado1_idx` (`empleado_id`),
  CONSTRAINT `fk_asistencia_empleado1` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_asistencia_lista1` FOREIGN KEY (`lista_id`) REFERENCES `lista` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=358 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `beneficiario`
--

DROP TABLE IF EXISTS `beneficiario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `beneficiario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `venta_lote_id` int(11) NOT NULL,
  `persona_id` int(11) NOT NULL,
  `actual` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`,`persona_id`),
  KEY `fk_beneficiario_persona1_idx` (`persona_id`),
  KEY `fk_beneficiario_venta_lote1_idx` (`venta_lote_id`),
  CONSTRAINT `fk_beneficiario_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_beneficiario_venta_lote1` FOREIGN KEY (`venta_lote_id`) REFERENCES `venta_lote` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bono_mtto`
--

DROP TABLE IF EXISTS `bono_mtto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bono_mtto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `monto` double NOT NULL DEFAULT '0',
  `activo` tinyint(1) NOT NULL DEFAULT '0',
  `asistencia_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_bono_mtto_asistencia1_idx` (`asistencia_id`),
  CONSTRAINT `fk_bono_mtto_asistencia1` FOREIGN KEY (`asistencia_id`) REFERENCES `asistencia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `capacidad`
--

DROP TABLE IF EXISTS `capacidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `capacidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `construccion_id` int(11) NOT NULL,
  `concepto_capacidad_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_capacidad_construccion1_idx` (`construccion_id`),
  KEY `fk_capacidad_concepto_capacidad1_idx` (`concepto_capacidad_id`),
  CONSTRAINT `concepto_capacidad_id` FOREIGN KEY (`concepto_capacidad_id`) REFERENCES `concepto_capacidad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `construccion_id` FOREIGN KEY (`construccion_id`) REFERENCES `construccion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=343 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `caracteristica`
--

DROP TABLE IF EXISTS `caracteristica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caracteristica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cesped`
--

DROP TABLE IF EXISTS `cesped`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cesped` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `venta_mantenimiento_id` int(11) NOT NULL,
  `cantidad` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cesped_venta_mantenimiento1_idx` (`venta_mantenimiento_id`),
  CONSTRAINT `fk_cesped_venta_mantenimiento1` FOREIGN KEY (`venta_mantenimiento_id`) REFERENCES `venta_mantenimiento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `persona_id` int(11) NOT NULL,
  `colonia_id` int(11) NOT NULL,
  `estado_civil_id` int(11) NOT NULL,
  `fecha_nacimiento` date NOT NULL DEFAULT '0000-00-00',
  `referencias` text,
  `calle` varchar(150) NOT NULL,
  `numero_exterior` varchar(10) NOT NULL,
  `numero_interior` varchar(10) DEFAULT NULL,
  `latitud` float DEFAULT NULL,
  `longitud` float DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `sexo` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`,`persona_id`),
  KEY `fk_cliente_persona1_idx` (`persona_id`),
  KEY `fk_cliente_colonia1_idx` (`colonia_id`),
  KEY `fk_cliente_estado_civil1_idx` (`estado_civil_id`),
  CONSTRAINT `fk_cliente_colonia1` FOREIGN KEY (`colonia_id`) REFERENCES `colonia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cliente_estado_civil1` FOREIGN KEY (`estado_civil_id`) REFERENCES `estado_civil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cliente_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=578 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `colonia`
--

DROP TABLE IF EXISTS `colonia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `colonia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `municipio_id` int(11) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `codigo_postal` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_colonia_municipio1_idx` (`municipio_id`),
  CONSTRAINT `fk_colonia_municipio1` FOREIGN KEY (`municipio_id`) REFERENCES `municipio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5020 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `color`
--

DROP TABLE IF EXISTS `color`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `color` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `comision`
--

DROP TABLE IF EXISTS `comision`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comision` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asesor_id` int(11) NOT NULL,
  `venta_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `total` double NOT NULL,
  `cancelada` tinyint(1) NOT NULL DEFAULT '0',
  `pagada` tinyint(1) NOT NULL DEFAULT '0',
  `total_comisionable` double NOT NULL DEFAULT '0',
  `numero_pagos` int(11) NOT NULL DEFAULT '1',
  `porcentaje` int(11) NOT NULL DEFAULT '12',
  `observaciones` text,
  PRIMARY KEY (`id`),
  KEY `fk_venta_asesor_asesor1_idx` (`asesor_id`),
  KEY `fk_venta_asesor_venta1_idx` (`venta_id`),
  CONSTRAINT `fk_venta_asesor_asesor1` FOREIGN KEY (`asesor_id`) REFERENCES `asesor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_asesor_venta1` FOREIGN KEY (`venta_id`) REFERENCES `venta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4488 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `comision_advertencia`
--

DROP TABLE IF EXISTS `comision_advertencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comision_advertencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comision_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `motivos` varchar(200) DEFAULT NULL,
  `activo` tinyint(4) NOT NULL DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pago_comision_detenido_comision1_idx` (`comision_id`),
  CONSTRAINT `fk_pago_comision_detenido_comision1` FOREIGN KEY (`comision_id`) REFERENCES `comision` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `comision_esquema_vendedor`
--

DROP TABLE IF EXISTS `comision_esquema_vendedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comision_esquema_vendedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `esquema_comision_id` int(11) NOT NULL,
  `asesor_id` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `activo` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_comision_esquema_vendedor_esquema_comision1_idx` (`esquema_comision_id`),
  KEY `fk_comision_esquema_vendedor_asesor1_idx` (`asesor_id`),
  CONSTRAINT `fk_comision_esquema_vendedor_asesor1` FOREIGN KEY (`asesor_id`) REFERENCES `asesor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_comision_esquema_vendedor_esquema_comision1` FOREIGN KEY (`esquema_comision_id`) REFERENCES `esquema_comision` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2000 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `concepto_capacidad`
--

DROP TABLE IF EXISTS `concepto_capacidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `concepto_capacidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `configuracion_general`
--

DROP TABLE IF EXISTS `configuracion_general`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuracion_general` (
  `id` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `porcentaje_iva` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `folio_mtto` int(11) NOT NULL,
  `grafica_color_ventas` varchar(45) DEFAULT NULL,
  `grafica_color_reposiciones` varchar(45) DEFAULT NULL,
  `grafica_color_stock` varchar(45) DEFAULT NULL,
  `grafica_sobre_ventas` varchar(45) DEFAULT NULL,
  `grafica_sobre_reposiciones` varchar(45) DEFAULT NULL,
  `grafica_sobre_stock` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cofiguracion_general_empresa1_idx` (`empresa_id`),
  CONSTRAINT `fk_cofiguracion_general_empresa1` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `construccion`
--

DROP TABLE IF EXISTS `construccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `construccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `descripcion` varchar(80) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_construccion_producto1_idx` (`producto_id`),
  CONSTRAINT `fk_construccion_producto1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=265 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `contrato`
--

DROP TABLE IF EXISTS `contrato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contrato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `formato_id` int(11) NOT NULL,
  `folio` varchar(10) NOT NULL,
  `observaciones` text,
  PRIMARY KEY (`id`),
  KEY `fk_contrato_formato1_idx` (`formato_id`),
  CONSTRAINT `fk_contrato_formato1` FOREIGN KEY (`formato_id`) REFERENCES `formato` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `contrato_venta_producto`
--

DROP TABLE IF EXISTS `contrato_venta_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contrato_venta_producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contrato_id` int(11) NOT NULL,
  `venta_producto_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_auxiliar_contratos_contrato1_idx` (`contrato_id`),
  KEY `fk_auxiliar_contratos_venta_producto1_idx` (`venta_producto_id`),
  CONSTRAINT `fk_auxiliar_contratos_contrato1` FOREIGN KEY (`contrato_id`) REFERENCES `contrato` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_auxiliar_contratos_venta_producto1` FOREIGN KEY (`venta_producto_id`) REFERENCES `venta_producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cupon`
--

DROP TABLE IF EXISTS `cupon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cupon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) NOT NULL,
  `descuento` double NOT NULL,
  `descripcion` text NOT NULL,
  `porcentaje` double NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_cupon_cliente1_idx` (`cliente_id`),
  CONSTRAINT `fk_cupon_cliente1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cupon_venta`
--

DROP TABLE IF EXISTS `cupon_venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cupon_venta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cupon_id` int(11) NOT NULL,
  `venta_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cupon_venta_cupon1_idx` (`cupon_id`),
  KEY `fk_cupon_venta_venta1_idx` (`venta_id`),
  CONSTRAINT `fk_cupon_venta_cupon1` FOREIGN KEY (`cupon_id`) REFERENCES `cupon` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cupon_venta_venta1` FOREIGN KEY (`venta_id`) REFERENCES `venta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `departamento`
--

DROP TABLE IF EXISTS `departamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) NOT NULL,
  `nombre_corto` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `empleado`
--

DROP TABLE IF EXISTS `empleado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empleado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `persona_id` int(11) NOT NULL,
  `puesto_id` int(11) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`,`persona_id`),
  KEY `fk_jardinero_persona1_idx` (`persona_id`),
  KEY `fk_empleado_puesto1_idx` (`puesto_id`),
  CONSTRAINT `fk_empleado_puesto1` FOREIGN KEY (`puesto_id`) REFERENCES `puesto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_jardinero_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `empresa`
--

DROP TABLE IF EXISTS `empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `razon_social` varchar(150) NOT NULL,
  `rfc` varchar(15) NOT NULL,
  `telefono` varchar(40) NOT NULL,
  `domicilio` varchar(200) NOT NULL,
  `cp` int(11) NOT NULL,
  `municipio_id` int(11) NOT NULL,
  `activa` tinyint(1) NOT NULL DEFAULT '1',
  `logo` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_empresa_municipio1_idx` (`municipio_id`),
  CONSTRAINT `fk_empresa_municipio1` FOREIGN KEY (`municipio_id`) REFERENCES `municipio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `esquema_comision`
--

DROP TABLE IF EXISTS `esquema_comision`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `esquema_comision` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `venta_min` double NOT NULL,
  `venta_max` double NOT NULL,
  `porcentaje` int(11) NOT NULL,
  `activo` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `estado`
--

DROP TABLE IF EXISTS `estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pais_id` int(11) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  PRIMARY KEY (`id`,`pais_id`),
  KEY `fk_estado_pais1_idx` (`pais_id`),
  CONSTRAINT `fk_estado_pais1` FOREIGN KEY (`pais_id`) REFERENCES `pais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `estado_civil`
--

DROP TABLE IF EXISTS `estado_civil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado_civil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `estatus`
--

DROP TABLE IF EXISTS `estatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `etapa_id` int(11) NOT NULL,
  `venta_recubrimiento_id` int(11) NOT NULL,
  `fecha ingreso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `concluido` tinyint(1) NOT NULL,
  `comentarios` text,
  PRIMARY KEY (`id`),
  KEY `fk_estatus_etapa1_idx` (`etapa_id`),
  KEY `fk_estatus_venta_recubrimiento1_idx` (`venta_recubrimiento_id`),
  CONSTRAINT `fk_estatus_etapa1` FOREIGN KEY (`etapa_id`) REFERENCES `etapa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_estatus_venta_recubrimiento1` FOREIGN KEY (`venta_recubrimiento_id`) REFERENCES `venta_recubrimiento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `etapa`
--

DROP TABLE IF EXISTS `etapa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `etapa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `descripcion` text NOT NULL,
  `numero_orden` int(11) NOT NULL,
  `color` char(7) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `evento`
--

DROP TABLE IF EXISTS `evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recibo_id` int(11) NOT NULL,
  `evento` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_evento_recibo1_idx` (`recibo_id`),
  CONSTRAINT `fk_evento_recibo1` FOREIGN KEY (`recibo_id`) REFERENCES `recibo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `exhumacion`
--

DROP TABLE IF EXISTS `exhumacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exhumacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_exhumacion_producto1_idx` (`producto_id`),
  CONSTRAINT `fk_exhumacion_producto1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `extra`
--

DROP TABLE IF EXISTS `extra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `extra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `descripcion` text,
  PRIMARY KEY (`id`),
  KEY `fk_extra_producto1_idx` (`producto_id`),
  CONSTRAINT `fk_extra_producto1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `forma_pago`
--

DROP TABLE IF EXISTS `forma_pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forma_pago` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `formato`
--

DROP TABLE IF EXISTS `formato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `formato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` text NOT NULL,
  `version` double NOT NULL DEFAULT '1',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ruta_formato` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `funeraria`
--

DROP TABLE IF EXISTS `funeraria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `funeraria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `funeraria_venta_inhumacion`
--

DROP TABLE IF EXISTS `funeraria_venta_inhumacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `funeraria_venta_inhumacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `funeraria_id` int(11) NOT NULL,
  `venta_inhumacion_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_funeraria_venta_inhumacion_capilla1_idx` (`funeraria_id`),
  KEY `fk_funeraria_venta_inhumacion_venta_inhumacion1_idx` (`venta_inhumacion_id`),
  CONSTRAINT `fk_funeraria_venta_inhumacion_capilla1` FOREIGN KEY (`funeraria_id`) REFERENCES `funeraria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_funeraria_venta_inhumacion_venta_inhumacion1` FOREIGN KEY (`venta_inhumacion_id`) REFERENCES `venta_inhumacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `infonavit`
--

DROP TABLE IF EXISTS `infonavit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `infonavit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `monto` double NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `empleado_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_infonavit_empleado1_idx` (`empleado_id`),
  CONSTRAINT `fk_infonavit_empleado1` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `inhumacion`
--

DROP TABLE IF EXISTS `inhumacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inhumacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_inhumacion_producto1_idx` (`producto_id`),
  CONSTRAINT `fk_inhumacion_producto1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `inhumado`
--

DROP TABLE IF EXISTS `inhumado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inhumado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `persona_id` int(11) NOT NULL,
  `fecha_deceso` date NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  PRIMARY KEY (`id`,`persona_id`),
  KEY `fk_inhumado_persona1_idx` (`persona_id`),
  CONSTRAINT `fk_inhumado_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `inventario`
--

DROP TABLE IF EXISTS `inventario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `almacen_id` int(11) NOT NULL,
  `unidad_medida_id` int(11) NOT NULL,
  `existencia` int(11) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `descripcion` text,
  PRIMARY KEY (`id`),
  KEY `fk_inventario_almacen1_idx` (`almacen_id`),
  KEY `fk_material_unidad_medida1_idx` (`unidad_medida_id`),
  CONSTRAINT `fk_inventario_almacen1` FOREIGN KEY (`almacen_id`) REFERENCES `almacen` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_material_unidad_medida1` FOREIGN KEY (`unidad_medida_id`) REFERENCES `unidad_medida` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `inventario_recubrimientos`
--

DROP TABLE IF EXISTS `inventario_recubrimientos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventario_recubrimientos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area_stock` double NOT NULL,
  `precio_stock` double NOT NULL,
  `area_usada` double NOT NULL DEFAULT '0',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `lamina_alta_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_inventario_recub_lamina_alta1_idx` (`lamina_alta_id`),
  CONSTRAINT `fk_inventario_recub_lamina_alta1` FOREIGN KEY (`lamina_alta_id`) REFERENCES `lamina_alta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lamina_alta`
--

DROP TABLE IF EXISTS `lamina_alta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lamina_alta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `folio_factura` varchar(45) NOT NULL,
  `folio_lamina` varchar(45) NOT NULL,
  `area_total` double NOT NULL,
  `precio_total` double NOT NULL,
  `lamina_completa` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `proveedor_id` int(11) NOT NULL,
  `activa` tinyint(1) NOT NULL DEFAULT '1',
  `material_color_id` int(11) NOT NULL,
  `largo` double NOT NULL,
  `alto` double NOT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lamina_alta_proveedor1_idx` (`proveedor_id`),
  KEY `fk_lamina_alta_material_color1_idx` (`material_color_id`),
  CONSTRAINT `fk_lamina_alta_material_color1` FOREIGN KEY (`material_color_id`) REFERENCES `material_color` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lamina_alta_proveedor1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lista`
--

DROP TABLE IF EXISTS `lista`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lista` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `activa` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lote`
--

DROP TABLE IF EXISTS `lote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `disponible` tinyint(1) NOT NULL DEFAULT '1',
  `laltitud` float DEFAULT NULL,
  `longitud` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lote_producto1_idx` (`producto_id`),
  CONSTRAINT `fk_lote_producto1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=278 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mantenimiento`
--

DROP TABLE IF EXISTS `mantenimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mantenimiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `construccion_id` int(11) NOT NULL,
  `meses` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_mantenimiento_producto1_idx` (`producto_id`),
  KEY `fk_mantenimiento_construccion1_idx` (`construccion_id`),
  CONSTRAINT `fk_mantenimiento_construccion1` FOREIGN KEY (`construccion_id`) REFERENCES `construccion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_mantenimiento_producto1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mantenimiento_queja`
--

DROP TABLE IF EXISTS `mantenimiento_queja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mantenimiento_queja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `queja_id` int(11) NOT NULL,
  `venta_mantenimiento_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_mantenimiento_queja_queja1_idx` (`queja_id`),
  KEY `fk_mantenimiento_queja_venta_mantenimiento1_idx` (`venta_mantenimiento_id`),
  CONSTRAINT `fk_mantenimiento_queja_queja1` FOREIGN KEY (`queja_id`) REFERENCES `queja` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_mantenimiento_queja_venta_mantenimiento1` FOREIGN KEY (`venta_mantenimiento_id`) REFERENCES `venta_mantenimiento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `material`
--

DROP TABLE IF EXISTS `material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `material_baja`
--

DROP TABLE IF EXISTS `material_baja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `material_baja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `area_venta` double NOT NULL,
  `observaciones` text,
  `pieza_marmoleria_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `costo_material_usado` double NOT NULL,
  `venta` tinyint(1) NOT NULL DEFAULT '1',
  `reposicion` tinyint(1) NOT NULL DEFAULT '0',
  `stock` tinyint(1) NOT NULL DEFAULT '0',
  `inventario_recubrimientos_id` int(11) NOT NULL,
  `pieza_completa` tinyint(1) NOT NULL DEFAULT '1',
  `medida_estandar` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_material_baja_pieza_marmoleria1_idx` (`pieza_marmoleria_id`),
  KEY `fk_material_baja_inventario_recubrimientos1_idx` (`inventario_recubrimientos_id`),
  CONSTRAINT `fk_material_baja_inventario_recubrimientos1` FOREIGN KEY (`inventario_recubrimientos_id`) REFERENCES `inventario_recubrimientos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_material_baja_pieza_marmoleria1` FOREIGN KEY (`pieza_marmoleria_id`) REFERENCES `pieza_marmoleria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `material_color`
--

DROP TABLE IF EXISTS `material_color`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `material_color` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `color_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `activo` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_material_color_color1_idx` (`color_id`),
  KEY `fk_material_color_material1_idx` (`material_id`),
  CONSTRAINT `fk_material_color_color1` FOREIGN KEY (`color_id`) REFERENCES `color` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_material_color_material1` FOREIGN KEY (`material_id`) REFERENCES `material` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `material_valor`
--

DROP TABLE IF EXISTS `material_valor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `material_valor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inventario_id` int(11) NOT NULL,
  `valor_material_id` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_material_inventario1_idx` (`inventario_id`),
  KEY `fk_material_valor_material1_idx` (`valor_material_id`),
  CONSTRAINT `fk_material_inventario1` FOREIGN KEY (`inventario_id`) REFERENCES `inventario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_material_valor_material1` FOREIGN KEY (`valor_material_id`) REFERENCES `valor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `medio_comunicacion`
--

DROP TABLE IF EXISTS `medio_comunicacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medio_comunicacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `movimiento`
--

DROP TABLE IF EXISTS `movimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `movimiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `accion_id` int(11) NOT NULL,
  `inventario_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cantidad` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_mov_inventario_acciones_inventario1_idx` (`accion_id`),
  KEY `fk_mov_inventario_inventario1_idx` (`inventario_id`),
  KEY `fk_movimiento_usuario1_idx` (`usuario_id`),
  CONSTRAINT `fk_mov_inventario_acciones_inventario1` FOREIGN KEY (`accion_id`) REFERENCES `accion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_mov_inventario_inventario1` FOREIGN KEY (`inventario_id`) REFERENCES `inventario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_movimiento_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `municipio`
--

DROP TABLE IF EXISTS `municipio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `municipio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estado_id` int(11) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_municipio_estado1_idx` (`estado_id`),
  CONSTRAINT `fk_municipio_estado1` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `nicho`
--

DROP TABLE IF EXISTS `nicho`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nicho` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lote_id` int(11) NOT NULL,
  `recinto_id` int(11) NOT NULL,
  `fila` varchar(8) NOT NULL,
  `columna` varchar(8) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_nicho_lote1_idx` (`lote_id`),
  KEY `fk_nicho_recinto1_idx` (`recinto_id`),
  CONSTRAINT `fk_nicho_lote1` FOREIGN KEY (`lote_id`) REFERENCES `lote` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_nicho_recinto1` FOREIGN KEY (`recinto_id`) REFERENCES `recinto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `otras_percepciones`
--

DROP TABLE IF EXISTS `otras_percepciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `otras_percepciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `monto` double NOT NULL DEFAULT '0',
  `motivo` varchar(200) DEFAULT NULL,
  `asistencia_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_otras_percepciones_asistencia1_idx` (`asistencia_id`),
  CONSTRAINT `fk_otras_percepciones_asistencia1` FOREIGN KEY (`asistencia_id`) REFERENCES `asistencia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pago`
--

DROP TABLE IF EXISTS `pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pago` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recibo_id` int(11) NOT NULL,
  `forma_pago_id` int(11) NOT NULL,
  `monto` double NOT NULL,
  `cancelado` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pago_forma_pago1_idx` (`forma_pago_id`),
  KEY `fk_pago_recibo1_idx` (`recibo_id`),
  KEY `fk_pago_usuario1_idx` (`usuario_id`),
  CONSTRAINT `fk_pago_forma_pago` FOREIGN KEY (`forma_pago_id`) REFERENCES `forma_pago` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pago_recibo` FOREIGN KEY (`recibo_id`) REFERENCES `recibo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pago_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pais`
--

DROP TABLE IF EXISTS `pais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) NOT NULL,
  `clave` char(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `panteon`
--

DROP TABLE IF EXISTS `panteon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `panteon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `panteon_venta_exhumacion`
--

DROP TABLE IF EXISTS `panteon_venta_exhumacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `panteon_venta_exhumacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `venta_exhumacion_id` int(11) NOT NULL,
  `panteon_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_panteon_venta_exhumacion_venta_exhumacion1_idx` (`venta_exhumacion_id`),
  KEY `fk_panteon_venta_exhumacion_panteon1_idx` (`panteon_id`),
  CONSTRAINT `fk_panteon_venta_exhumacion_panteon1` FOREIGN KEY (`panteon_id`) REFERENCES `panteon` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_panteon_venta_exhumacion_venta_exhumacion1` FOREIGN KEY (`venta_exhumacion_id`) REFERENCES `venta_exhumacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `paquete`
--

DROP TABLE IF EXISTS `paquete`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paquete` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paquete_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `descuento` double NOT NULL,
  `descripcion` text NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_paquete_producto1_idx` (`producto_id`),
  KEY `fk_paquete_producto2_idx` (`paquete_id`),
  CONSTRAINT `fk_paquete_producto1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_paquete_producto2` FOREIGN KEY (`paquete_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `periodo_comision`
--

DROP TABLE IF EXISTS `periodo_comision`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `periodo_comision` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `folio` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=390 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `persona`
--

DROP TABLE IF EXISTS `persona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `persona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(45) NOT NULL,
  `apellido_paterno` varchar(45) NOT NULL,
  `apellido_materno` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=809 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personalizacion_venta_recubrimiento`
--

DROP TABLE IF EXISTS `personalizacion_venta_recubrimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personalizacion_venta_recubrimiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `venta_recubrimiento_id` int(11) NOT NULL,
  `recubrimiento_caracteristica_id` int(11) NOT NULL,
  `detalle` text,
  PRIMARY KEY (`id`),
  KEY `fk_personalizacion_venta_recubrimiento_venta_recubrimiento1_idx` (`venta_recubrimiento_id`),
  KEY `fk_personalizacion_venta_recubrimiento_recubrimiento_caract_idx` (`recubrimiento_caracteristica_id`),
  CONSTRAINT `fk_personalizacion_venta_recubrimiento_recubrimiento_caracter1` FOREIGN KEY (`recubrimiento_caracteristica_id`) REFERENCES `recubrimiento_material` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_personalizacion_venta_recubrimiento_venta_recubrimiento1` FOREIGN KEY (`venta_recubrimiento_id`) REFERENCES `venta_recubrimiento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pieza_marmoleria`
--

DROP TABLE IF EXISTS `pieza_marmoleria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pieza_marmoleria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `area_requerida` double NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `producto_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pieza_marmoleria_producto1_idx` (`producto_id`),
  CONSTRAINT `fk_pieza_marmoleria_producto1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `plan_pago`
--

DROP TABLE IF EXISTS `plan_pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plan_pago` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  `porcentaje_anticipo` double NOT NULL,
  `periodo` int(11) NOT NULL,
  `numero_pagos` int(11) NOT NULL,
  `interes_mensual` double NOT NULL,
  `numero_comisiones` int(11) NOT NULL DEFAULT '0',
  `activo` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `plan_pago_venta`
--

DROP TABLE IF EXISTS `plan_pago_venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plan_pago_venta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `venta_id` int(11) NOT NULL,
  `plan_pago_id` int(11) NOT NULL,
  `fecha_aplicado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `reestructura` tinyint(1) NOT NULL DEFAULT '0',
  `pago_regular` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`,`venta_id`),
  KEY `fk_plan_pago_venta_venta1_idx` (`venta_id`),
  KEY `fk_plan_pago_venta_plan_pago1_idx` (`plan_pago_id`),
  CONSTRAINT `fk_plan_pago_venta_plan_pago1` FOREIGN KEY (`plan_pago_id`) REFERENCES `plan_pago` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_plan_pago_venta_venta1` FOREIGN KEY (`venta_id`) REFERENCES `venta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=746 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `precio`
--

DROP TABLE IF EXISTS `precio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `precio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `monto` double NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_precio_producto1_idx` (`producto_id`),
  CONSTRAINT `fk_precio_producto1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=469 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `prestamo`
--

DROP TABLE IF EXISTS `prestamo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prestamo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `monto` double NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `empleado_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_prestamo_empleado1_idx` (`empleado_id`),
  CONSTRAINT `fk_prestamo_empleado1` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `departamento_id` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `servicio` tinyint(1) NOT NULL DEFAULT '0',
  `grabable` tinyint(1) NOT NULL DEFAULT '1',
  `nombre` varchar(100) NOT NULL,
  `porcentaje_comision` double NOT NULL,
  `porcentaje_minimo_comisionable` double NOT NULL,
  `combo` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_producto_departamento1_idx` (`departamento_id`),
  CONSTRAINT `fk_producto_departamento1` FOREIGN KEY (`departamento_id`) REFERENCES `departamento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=486 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `producto_contruccion`
--

DROP TABLE IF EXISTS `producto_contruccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producto_contruccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activo` tinyint(4) NOT NULL DEFAULT '1',
  `producto_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_producto_contruccion_producto1_idx` (`producto_id`),
  CONSTRAINT `fk_producto_contruccion_producto1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `producto_grafica`
--

DROP TABLE IF EXISTS `producto_grafica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producto_grafica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `promotor`
--

DROP TABLE IF EXISTS `promotor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promotor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `promotor_id` int(11) NOT NULL,
  `asesor_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_promomotor_asesor1_idx` (`promotor_id`),
  KEY `fk_promomotor_asesor2_idx` (`asesor_id`),
  CONSTRAINT `fk_promomotor_asesor1` FOREIGN KEY (`promotor_id`) REFERENCES `asesor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_promomotor_asesor2` FOREIGN KEY (`asesor_id`) REFERENCES `asesor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `propiedad_plantada`
--

DROP TABLE IF EXISTS `propiedad_plantada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `propiedad_plantada` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `venta_mantenimiento_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_propiedad_plantada_venta_mantenimiento1_idx` (`venta_mantenimiento_id`),
  CONSTRAINT `fk_propiedad_plantada_venta_mantenimiento1` FOREIGN KEY (`venta_mantenimiento_id`) REFERENCES `venta_mantenimiento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `proveedor`
--

DROP TABLE IF EXISTS `proveedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proveedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `rfc` varchar(45) DEFAULT NULL,
  `departamento_id` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_proveedor_departamento1_idx` (`departamento_id`),
  CONSTRAINT `fk_proveedor_departamento1` FOREIGN KEY (`departamento_id`) REFERENCES `departamento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `puesto`
--

DROP TABLE IF EXISTS `puesto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `puesto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `departamento_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_puesto_departamento1_idx` (`departamento_id`),
  CONSTRAINT `fk_puesto_departamento1` FOREIGN KEY (`departamento_id`) REFERENCES `departamento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `queja`
--

DROP TABLE IF EXISTS `queja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `queja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rubro_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `cerrada` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `aplica` tinyint(1) NOT NULL DEFAULT '0',
  `gravedad` tinyint(1) NOT NULL DEFAULT '0',
  `foto` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_queja_usuario1_idx` (`usuario_id`),
  KEY `fk_queja_rubro1_idx` (`rubro_id`),
  CONSTRAINT `fk_queja_rubro1` FOREIGN KEY (`rubro_id`) REFERENCES `rubro` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_queja_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `queja_seguimiento`
--

DROP TABLE IF EXISTS `queja_seguimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `queja_seguimiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `queja_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `observaciones` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `foto` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_seguimiento_queja1_idx` (`queja_id`),
  KEY `fk_seguimiento_usuario1_idx` (`usuario_id`),
  CONSTRAINT `fk_seguimiento_queja1` FOREIGN KEY (`queja_id`) REFERENCES `queja` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_seguimiento_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `recibo`
--

DROP TABLE IF EXISTS `recibo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recibo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `venta_id` int(11) NOT NULL,
  `fecha_limite` date NOT NULL,
  `monto` double NOT NULL,
  `cancelado` tinyint(1) NOT NULL DEFAULT '0',
  `pagado` tinyint(1) NOT NULL DEFAULT '0',
  `mensajero` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `facturado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `venta_id` (`venta_id`),
  CONSTRAINT `venta_id` FOREIGN KEY (`venta_id`) REFERENCES `venta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `recinto`
--

DROP TABLE IF EXISTS `recinto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recinto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sector_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_recinto_sector1_idx` (`sector_id`),
  CONSTRAINT `fk_recinto_sector1` FOREIGN KEY (`sector_id`) REFERENCES `sector` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `recubrimiento`
--

DROP TABLE IF EXISTS `recubrimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recubrimiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_recubrimiento_producto1_idx` (`producto_id`),
  CONSTRAINT `fk_recubrimiento_producto1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `recubrimiento_material`
--

DROP TABLE IF EXISTS `recubrimiento_material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recubrimiento_material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recubrimiento_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_recubrimiento_caracteristica_recubrimiento1_idx` (`recubrimiento_id`),
  KEY `fk_recubrimiento_material_material1_idx` (`material_id`),
  CONSTRAINT `fk_recubrimiento_caracteristica_recubrimiento1` FOREIGN KEY (`recubrimiento_id`) REFERENCES `recubrimiento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_recubrimiento_material_material1` FOREIGN KEY (`material_id`) REFERENCES `material_valor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `reposicion`
--

DROP TABLE IF EXISTS `reposicion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reposicion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `motivos` longtext NOT NULL,
  `material_baja_id` int(11) NOT NULL,
  `autoriza_usuario_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `autorizado` varchar(45) NOT NULL DEFAULT '0',
  `captura_usuario_id` int(11) NOT NULL,
  `precio_reposicion` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reposicion_material_baja1_idx` (`material_baja_id`),
  KEY `fk_reposicion_usuario1_idx` (`autoriza_usuario_id`),
  KEY `fk_reposicion_usuario2_idx` (`captura_usuario_id`),
  CONSTRAINT `fk_reposicion_material_baja1` FOREIGN KEY (`material_baja_id`) REFERENCES `material_baja` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_reposicion_usuario1` FOREIGN KEY (`autoriza_usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_reposicion_usuario2` FOREIGN KEY (`captura_usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(15) NOT NULL,
  `plantillas` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rubro`
--

DROP TABLE IF EXISTS `rubro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rubro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `departamento_id` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_rubro_departamento1_idx` (`departamento_id`),
  CONSTRAINT `fk_rubro_departamento1` FOREIGN KEY (`departamento_id`) REFERENCES `departamento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `salario`
--

DROP TABLE IF EXISTS `salario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `empleado_id` int(11) NOT NULL,
  `salario_diario` double NOT NULL,
  `salario_semanal` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_salario_diario_empleado1_idx` (`empleado_id`),
  CONSTRAINT `fk_salario_diario_empleado1` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sector`
--

DROP TABLE IF EXISTS `sector`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sector` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `seguimiento_venta`
--

DROP TABLE IF EXISTS `seguimiento_venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seguimiento_venta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `venta_id` int(11) NOT NULL,
  `medio_comunicacion_id` int(11) NOT NULL,
  `observaciones` text NOT NULL,
  `cita` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `fk_seguimiento_venta1_idx` (`venta_id`),
  KEY `fk_seguimiento_medio_de_cominicacion1_idx` (`medio_comunicacion_id`),
  CONSTRAINT `fk_seguimiento_medio_de_cominicacion1` FOREIGN KEY (`medio_comunicacion_id`) REFERENCES `medio_comunicacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_seguimiento_venta1` FOREIGN KEY (`venta_id`) REFERENCES `venta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `servicio_funeral`
--

DROP TABLE IF EXISTS `servicio_funeral`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servicio_funeral` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `monto_comisionable` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_servicio_funeral_producto1_idx` (`producto_id`),
  CONSTRAINT `fk_servicio_funeral_producto1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `precio_venta` double NOT NULL,
  `activo` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `material_baja_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_stock_material_baja1_idx` (`material_baja_id`),
  CONSTRAINT `fk_stock_material_baja1` FOREIGN KEY (`material_baja_id`) REFERENCES `material_baja` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `telefono`
--

DROP TABLE IF EXISTS `telefono`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `telefono` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) NOT NULL,
  `tipo_telefono_id` int(11) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `codigo_pais` char(2) NOT NULL DEFAULT '52',
  PRIMARY KEY (`id`),
  KEY `fk_telefono_tipo_telefono1_idx` (`tipo_telefono_id`),
  KEY `cliente_id` (`cliente_id`),
  CONSTRAINT `cliente_id` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tipo_telefono_id` FOREIGN KEY (`tipo_telefono_id`) REFERENCES `tipo_telefono` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `telefono_asesor`
--

DROP TABLE IF EXISTS `telefono_asesor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `telefono_asesor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `telefono` varchar(10) NOT NULL,
  `codigo_pais` varchar(2) NOT NULL DEFAULT '52',
  `asesor_id` int(11) NOT NULL,
  `tipo_telefono_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_telefono_asesor_asesor1_idx` (`asesor_id`),
  KEY `fk_telefono_asesor_tipo_telefono1_idx` (`tipo_telefono_id`),
  CONSTRAINT `fk_telefono_asesor_asesor1` FOREIGN KEY (`asesor_id`) REFERENCES `asesor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_telefono_asesor_tipo_telefono1` FOREIGN KEY (`tipo_telefono_id`) REFERENCES `tipo_telefono` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `terreno`
--

DROP TABLE IF EXISTS `terreno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `terreno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lote_id` int(11) NOT NULL,
  `sector_id` int(11) NOT NULL,
  `construccion_id` int(11) NOT NULL,
  `largo` double NOT NULL,
  `ancho` double NOT NULL,
  `fila` varchar(8) NOT NULL,
  `lote` varchar(8) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_terereno_lote1_idx` (`lote_id`),
  KEY `fk_terreno_sector1_idx` (`sector_id`),
  KEY `fk_terreno_construccion1_idx` (`construccion_id`),
  CONSTRAINT `fk_terereno_lote1` FOREIGN KEY (`lote_id`) REFERENCES `lote` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_terreno_construccion1` FOREIGN KEY (`construccion_id`) REFERENCES `construccion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_terreno_sector1` FOREIGN KEY (`sector_id`) REFERENCES `sector` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=266 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tipo_telefono`
--

DROP TABLE IF EXISTS `tipo_telefono`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_telefono` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `titular`
--

DROP TABLE IF EXISTS `titular`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `titular` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `persona_id` int(11) NOT NULL,
  `venta_lote_id` int(11) NOT NULL,
  `actual` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`,`persona_id`),
  KEY `fk_titular_persona1_idx` (`persona_id`),
  KEY `fk_titular_venta_lote1_idx` (`venta_lote_id`),
  CONSTRAINT `fk_titular_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_titular_venta_lote1` FOREIGN KEY (`venta_lote_id`) REFERENCES `venta_lote` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tramite`
--

DROP TABLE IF EXISTS `tramite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tramite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `construccion_id` int(11) NOT NULL,
  `sector_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tramite_producto1_idx` (`producto_id`),
  KEY `fk_tramite_construccion1_idx` (`construccion_id`),
  KEY `fk_tramite_sector1_idx` (`sector_id`),
  CONSTRAINT `fk_tramite_construccion1` FOREIGN KEY (`construccion_id`) REFERENCES `construccion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tramite_producto1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tramite_sector1` FOREIGN KEY (`sector_id`) REFERENCES `sector` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `unidad_medida`
--

DROP TABLE IF EXISTS `unidad_medida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unidad_medida` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `nombre_corto` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `persona_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `departamento_id` int(11) NOT NULL,
  `nombre` varchar(12) NOT NULL,
  `contrasenia` varchar(256) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `jefe` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`,`persona_id`),
  KEY `fk_usuario_rol1_idx` (`rol_id`),
  KEY `fk_usuario_persona1_idx` (`persona_id`),
  KEY `fk_usuario_departamento1_idx` (`departamento_id`),
  CONSTRAINT `fk_usuario_departamento1` FOREIGN KEY (`departamento_id`) REFERENCES `departamento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_rol1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `valor`
--

DROP TABLE IF EXISTS `valor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `valor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `venta`
--

DROP TABLE IF EXISTS `venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) NOT NULL,
  `folio_solicitud` varchar(10) DEFAULT NULL,
  `descuento` double NOT NULL DEFAULT '0',
  `total` double NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comentarios` text,
  `pagada` tinyint(1) NOT NULL DEFAULT '0',
  `cancelada` tinyint(1) NOT NULL DEFAULT '0',
  `cotizacion` tinyint(1) NOT NULL DEFAULT '0',
  `autorizado` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `asesor_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_venta_cliente1_idx` (`cliente_id`),
  KEY `fk_venta_asesor1_idx` (`asesor_id`),
  CONSTRAINT `fk_venta_asesor1` FOREIGN KEY (`asesor_id`) REFERENCES `asesor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_cliente1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4488 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `venta_construccion`
--

DROP TABLE IF EXISTS `venta_construccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_construccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `venta_producto_id` int(11) NOT NULL,
  `terreno_id` int(11) NOT NULL,
  `construido` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_venta_construccion_venta_producto1_idx` (`venta_producto_id`),
  KEY `fk_venta_construccion_terreno1_idx` (`terreno_id`),
  CONSTRAINT `fk_venta_construccion_terreno1` FOREIGN KEY (`terreno_id`) REFERENCES `terreno` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_construccion_venta_producto1` FOREIGN KEY (`venta_producto_id`) REFERENCES `venta_producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `venta_exhumacion`
--

DROP TABLE IF EXISTS `venta_exhumacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_exhumacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `venta_producto_id` int(11) NOT NULL,
  `inhumado_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `observaciones` text,
  PRIMARY KEY (`id`),
  KEY `fk_venta_exhumacion_venta_producto1_idx` (`venta_producto_id`),
  KEY `fk_venta_exhumacion_inhumado1_idx` (`inhumado_id`),
  CONSTRAINT `fk_venta_exhumacion_inhumado1` FOREIGN KEY (`inhumado_id`) REFERENCES `inhumado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_exhumacion_venta_producto1` FOREIGN KEY (`venta_producto_id`) REFERENCES `venta_producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `venta_inhumacion`
--

DROP TABLE IF EXISTS `venta_inhumacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_inhumacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `venta_producto_id` int(11) NOT NULL,
  `lote_id` int(11) NOT NULL,
  `inhumado_id` int(11) NOT NULL,
  `posicion` varchar(15) NOT NULL,
  `cenizas` tinyint(1) NOT NULL DEFAULT '0',
  `fecha` date NOT NULL,
  `observaciones` text,
  PRIMARY KEY (`id`),
  KEY `fk_venta_inhumacion_venta_producto1_idx` (`venta_producto_id`),
  KEY `fk_venta_inhumacion_lote1_idx` (`lote_id`),
  KEY `fk_venta_inhumacion_inhumado1_idx` (`inhumado_id`),
  CONSTRAINT `fk_venta_inhumacion_inhumado1` FOREIGN KEY (`inhumado_id`) REFERENCES `inhumado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_inhumacion_lote1` FOREIGN KEY (`lote_id`) REFERENCES `lote` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_inhumacion_venta_producto1` FOREIGN KEY (`venta_producto_id`) REFERENCES `venta_producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `venta_lote`
--

DROP TABLE IF EXISTS `venta_lote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_lote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `venta_producto_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_venta_lote_venta_producto1_idx` (`venta_producto_id`),
  CONSTRAINT `fk_venta_lote_venta_producto1` FOREIGN KEY (`venta_producto_id`) REFERENCES `venta_producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `venta_mantenimiento`
--

DROP TABLE IF EXISTS `venta_mantenimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_mantenimiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `venta_producto_id` int(11) NOT NULL,
  `empleado_id` int(11) NOT NULL,
  `lote_id` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `nuevo` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_venta_mantenimiento_venta_producto1_idx` (`venta_producto_id`),
  KEY `fk_venta_mantenimiento_jardinero1_idx` (`empleado_id`),
  KEY `fk_venta_mantenimiento_lote1_idx` (`lote_id`),
  CONSTRAINT `fk_venta_mantenimiento_jardinero1` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_mantenimiento_lote1` FOREIGN KEY (`lote_id`) REFERENCES `lote` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_mantenimiento_venta_producto1` FOREIGN KEY (`venta_producto_id`) REFERENCES `venta_producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `venta_material`
--

DROP TABLE IF EXISTS `venta_material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `folio` varchar(45) NOT NULL,
  `total_venta` double NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `venta_normal` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'SI LA VENTA NO ES NORMAL, PERTENECE A VENTA POR STOCK',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `venta_material_baja`
--

DROP TABLE IF EXISTS `venta_material_baja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_material_baja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `venta_material_id` int(11) NOT NULL,
  `material_baja_id` int(11) NOT NULL,
  `precio_pieza` double NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_venta_material_baja_venta_material1_idx` (`venta_material_id`),
  KEY `fk_venta_material_baja_material_baja1_idx` (`material_baja_id`),
  CONSTRAINT `fk_venta_material_baja_material_baja1` FOREIGN KEY (`material_baja_id`) REFERENCES `material_baja` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_material_baja_venta_material1` FOREIGN KEY (`venta_material_id`) REFERENCES `venta_material` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `venta_producto`
--

DROP TABLE IF EXISTS `venta_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `venta_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `total` double NOT NULL,
  `precio_unitario` double NOT NULL,
  `iva` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_venta_producto_venta_idx` (`venta_id`),
  KEY `fk_venta_producto_producto1_idx` (`producto_id`),
  CONSTRAINT `fk_venta_producto_producto1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_producto_venta` FOREIGN KEY (`venta_id`) REFERENCES `venta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=787 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `venta_producto_grafica`
--

DROP TABLE IF EXISTS `venta_producto_grafica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_producto_grafica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_grafica_id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `monto` double NOT NULL,
  PRIMARY KEY (`id`,`producto_grafica_id`),
  KEY `fk_venta_producto_grafica_producto_grafica1_idx` (`producto_grafica_id`)
) ENGINE=InnoDB AUTO_INCREMENT=558 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `venta_recubrimiento`
--

DROP TABLE IF EXISTS `venta_recubrimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_recubrimiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `venta_producto_id` int(11) NOT NULL,
  `costo_adicional` double NOT NULL,
  `observaciones` text,
  PRIMARY KEY (`id`),
  KEY `fk_venta_recubrimiento_venta_producto1_idx` (`venta_producto_id`),
  CONSTRAINT `fk_venta_recubrimiento_venta_producto1` FOREIGN KEY (`venta_producto_id`) REFERENCES `venta_producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `venta_tramite`
--

DROP TABLE IF EXISTS `venta_tramite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_tramite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `venta_producto_id` int(11) NOT NULL,
  `contrato_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_venta_tramite_venta_producto1_idx` (`venta_producto_id`),
  KEY `fk_venta_tramite_contrato1_idx` (`contrato_id`),
  CONSTRAINT `fk_venta_tramite_contrato1` FOREIGN KEY (`contrato_id`) REFERENCES `contrato` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_tramite_venta_producto1` FOREIGN KEY (`venta_producto_id`) REFERENCES `venta_producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary view structure for view `ventas_totales`
--

DROP TABLE IF EXISTS `ventas_totales`;
/*!50001 DROP VIEW IF EXISTS `ventas_totales`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `ventas_totales` AS SELECT 
 1 AS `total`,
 1 AS `cantidad`,
 1 AS `producto`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_abono_comision_periodo`
--

DROP TABLE IF EXISTS `vista_abono_comision_periodo`;
/*!50001 DROP VIEW IF EXISTS `vista_abono_comision_periodo`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vista_abono_comision_periodo` AS SELECT 
 1 AS `id`,
 1 AS `periodo_comision_id`,
 1 AS `comision_id`,
 1 AS `monto`,
 1 AS `fecha`,
 1 AS `cancelado`,
 1 AS `created_at`,
 1 AS `updated_at`,
 1 AS `pagado`,
 1 AS `asesor_id`,
 1 AS `folio_comision`,
 1 AS `fecha_inicio`,
 1 AS `fecha_fin`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_asesor_promotor`
--

DROP TABLE IF EXISTS `vista_asesor_promotor`;
/*!50001 DROP VIEW IF EXISTS `vista_asesor_promotor`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vista_asesor_promotor` AS SELECT 
 1 AS `persona_id`,
 1 AS `activo`,
 1 AS `asesor_id`,
 1 AS `promotor_id`,
 1 AS `fecha_ingreso`,
 1 AS `asesor`,
 1 AS `promotor`,
 1 AS `email`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_clientes`
--

DROP TABLE IF EXISTS `vista_clientes`;
/*!50001 DROP VIEW IF EXISTS `vista_clientes`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vista_clientes` AS SELECT 
 1 AS `id`,
 1 AS `nombres`,
 1 AS `apellido_paterno`,
 1 AS `apellido_materno`,
 1 AS `calle`,
 1 AS `numero_exterior`,
 1 AS `numero_interior`,
 1 AS `codigo_postal`,
 1 AS `colonia`,
 1 AS `referencias`,
 1 AS `municipio`,
 1 AS `estado`,
 1 AS `pais`,
 1 AS `email`,
 1 AS `estado_civil`,
 1 AS `latitud`,
 1 AS `longitud`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_colonia`
--

DROP TABLE IF EXISTS `vista_colonia`;
/*!50001 DROP VIEW IF EXISTS `vista_colonia`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vista_colonia` AS SELECT 
 1 AS `colonia_id`,
 1 AS `colonia`,
 1 AS `codigo_postal`,
 1 AS `estado_id`,
 1 AS `estado`,
 1 AS `municipio`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_comision`
--

DROP TABLE IF EXISTS `vista_comision`;
/*!50001 DROP VIEW IF EXISTS `vista_comision`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vista_comision` AS SELECT 
 1 AS `id`,
 1 AS `venta_id`,
 1 AS `folio_solicitud`,
 1 AS `producto_id`,
 1 AS `producto`,
 1 AS `cliente`,
 1 AS `asesor_id`,
 1 AS `vendedor`,
 1 AS `cancelada`,
 1 AS `pagada`,
 1 AS `numero_pagos`,
 1 AS `total`,
 1 AS `total_comisionable`,
 1 AS `pagado`,
 1 AS `por_pagar`,
 1 AS `porcentaje`,
 1 AS `nombre_corto`,
 1 AS `abonos`,
 1 AS `observaciones`,
 1 AS `advertencia`,
 1 AS `created_at`,
 1 AS `fecha_venta`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_detalle_factura`
--

DROP TABLE IF EXISTS `vista_detalle_factura`;
/*!50001 DROP VIEW IF EXISTS `vista_detalle_factura`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vista_detalle_factura` AS SELECT 
 1 AS `folio_factura`,
 1 AS `fecha_factura`,
 1 AS `fecha_alta`,
 1 AS `material`,
 1 AS `color`,
 1 AS `entrada`,
 1 AS `total_factura`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_detalle_mantenimiento`
--

DROP TABLE IF EXISTS `vista_detalle_mantenimiento`;
/*!50001 DROP VIEW IF EXISTS `vista_detalle_mantenimiento`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vista_detalle_mantenimiento` AS SELECT 
 1 AS `id`,
 1 AS `cliente_id`,
 1 AS `venta_id`,
 1 AS `lote_id`,
 1 AS `folio_solicitud`,
 1 AS `producto_id`,
 1 AS `fecha_inicio`,
 1 AS `fecha_fin`,
 1 AS `ubicacion`,
 1 AS `producto`,
 1 AS `cliente`,
 1 AS `persona_id`,
 1 AS `construccion_id`,
 1 AS `descripcion`,
 1 AS `construccion_id_contrato`,
 1 AS `construccion_mtto_contrato`,
 1 AS `meses_contratados`,
 1 AS `venta_mantenimiento_activo`,
 1 AS `verifica`,
 1 AS `total`,
 1 AS `plantada`,
 1 AS `fecha_plantacion`,
 1 AS `vencido`,
 1 AS `estatus`,
 1 AS `jardinero`,
 1 AS `cesped`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_detalle_venta_material`
--

DROP TABLE IF EXISTS `vista_detalle_venta_material`;
/*!50001 DROP VIEW IF EXISTS `vista_detalle_venta_material`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vista_detalle_venta_material` AS SELECT 
 1 AS `id`,
 1 AS `folio`,
 1 AS `inventario_recubrimientos_id`,
 1 AS `venta_material_id`,
 1 AS `folio_lamina`,
 1 AS `pieza`,
 1 AS `material_color`,
 1 AS `precio_pieza`,
 1 AS `observaciones`,
 1 AS `pieza_completa`,
 1 AS `medida_estandar`,
 1 AS `venta_abierta`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_empleado`
--

DROP TABLE IF EXISTS `vista_empleado`;
/*!50001 DROP VIEW IF EXISTS `vista_empleado`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vista_empleado` AS SELECT 
 1 AS `id`,
 1 AS `nombres`,
 1 AS `apellido_paterno`,
 1 AS `apellido_materno`,
 1 AS `puesto`,
 1 AS `departamento_id`,
 1 AS `departamento`,
 1 AS `fecha_ingreso`,
 1 AS `activo`,
 1 AS `salario_activo`,
 1 AS `salario_diario`,
 1 AS `salario_semanal`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_estadistico_color_material`
--

DROP TABLE IF EXISTS `vista_estadistico_color_material`;
/*!50001 DROP VIEW IF EXISTS `vista_estadistico_color_material`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vista_estadistico_color_material` AS SELECT 
 1 AS `material_color`,
 1 AS `movimientos`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_estadistico_movimiento_lamina`
--

DROP TABLE IF EXISTS `vista_estadistico_movimiento_lamina`;
/*!50001 DROP VIEW IF EXISTS `vista_estadistico_movimiento_lamina`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vista_estadistico_movimiento_lamina` AS SELECT 
 1 AS `lamina_alta_id`,
 1 AS `folio_lamina`,
 1 AS `material_color`,
 1 AS `costo_lamina`,
 1 AS `perdida_reposicion`,
 1 AS `ventas`,
 1 AS `stock`,
 1 AS `costo_produccion`,
 1 AS `movimientos`,
 1 AS `utilidad`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_estadisticos_lamina`
--

DROP TABLE IF EXISTS `vista_estadisticos_lamina`;
/*!50001 DROP VIEW IF EXISTS `vista_estadisticos_lamina`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vista_estadisticos_lamina` AS SELECT 
 1 AS `folio_lamina`,
 1 AS `inventario_recubrimientos_id`,
 1 AS `material_color`,
 1 AS `venta`,
 1 AS `stock`,
 1 AS `reposicion`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_extra`
--

DROP TABLE IF EXISTS `vista_extra`;
/*!50001 DROP VIEW IF EXISTS `vista_extra`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vista_extra` AS SELECT 
 1 AS `id`,
 1 AS `nombre`,
 1 AS `precio_extra`,
 1 AS `porcentaje_comision`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_factura`
--

DROP TABLE IF EXISTS `vista_factura`;
/*!50001 DROP VIEW IF EXISTS `vista_factura`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vista_factura` AS SELECT 
 1 AS `folio_factura`,
 1 AS `proveedor`,
 1 AS `fecha_factura`,
 1 AS `fecha_alta`,
 1 AS `factura_abierta`,
 1 AS `entrada`,
 1 AS `total_factura`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_inhumados_mtto`
--

DROP TABLE IF EXISTS `vista_inhumados_mtto`;
/*!50001 DROP VIEW IF EXISTS `vista_inhumados_mtto`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vista_inhumados_mtto` AS SELECT 
 1 AS `inhumado`,
 1 AS `posicion`,
 1 AS `fecha_servicio`,
 1 AS `fecha_nacimiento`,
 1 AS `fecha_deceso`,
 1 AS `ubicacion`,
 1 AS `lote_id`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_inventario_recub_general`
--

DROP TABLE IF EXISTS `vista_inventario_recub_general`;
/*!50001 DROP VIEW IF EXISTS `vista_inventario_recub_general`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vista_inventario_recub_general` AS SELECT 
 1 AS `id`,
 1 AS `inventario_recubrimientos_id`,
 1 AS `lamina_alta_id`,
 1 AS `folio_lamina`,
 1 AS `folio_factura`,
 1 AS `material_color`,
 1 AS `proveedor`,
 1 AS `area_total`,
 1 AS `area_usada`,
 1 AS `area_stock`,
 1 AS `precio_inicial`,
 1 AS `precio_stock`,
 1 AS `lamina_completa`,
 1 AS `porcentaje_restante`,
 1 AS `activo`,
 1 AS `costo_lamina`,
 1 AS `perdida_reposicion`,
 1 AS `ventas`,
 1 AS `stock`,
 1 AS `costo_produccion`,
 1 AS `movimientos`,
 1 AS `utilidad`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_inventario_recubrimiento`
--

DROP TABLE IF EXISTS `vista_inventario_recubrimiento`;
/*!50001 DROP VIEW IF EXISTS `vista_inventario_recubrimiento`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vista_inventario_recubrimiento` AS SELECT 
 1 AS `id`,
 1 AS `inventario_recubrimientos_id`,
 1 AS `lamina_alta_id`,
 1 AS `folio_lamina`,
 1 AS `folio_factura`,
 1 AS `material_color`,
 1 AS `proveedor`,
 1 AS `area_total`,
 1 AS `area_usada`,
 1 AS `updated_at`,
 1 AS `area_stock`,
 1 AS `precio_inicial`,
 1 AS `precio_stock`,
 1 AS `lamina_completa`,
 1 AS `porcentaje_restante`,
 1 AS `activo`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_lista_asistencia`
--

DROP TABLE IF EXISTS `vista_lista_asistencia`;
/*!50001 DROP VIEW IF EXISTS `vista_lista_asistencia`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vista_lista_asistencia` AS SELECT 
 1 AS `empleado`,
 1 AS `departamento`,
 1 AS `id`,
 1 AS `sa`,
 1 AS `do`,
 1 AS `lu`,
 1 AS `ma`,
 1 AS `mi`,
 1 AS `ju`,
 1 AS `vi`,
 1 AS `observaciones`,
 1 AS `lista_id`,
 1 AS `empleado_id`,
 1 AS `revisado`,
 1 AS `hora_extra`,
 1 AS `prima_dominical`,
 1 AS `vacaciones`,
 1 AS `festivo`,
 1 AS `semana_completa`,
 1 AS `dias_pago`,
 1 AS `revision_contabilidad`,
 1 AS `nomina`,
 1 AS `nomina_ss`,
 1 AS `dias_asistidos`,
 1 AS `faltas`,
 1 AS `prima`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_material_baja`
--

DROP TABLE IF EXISTS `vista_material_baja`;
/*!50001 DROP VIEW IF EXISTS `vista_material_baja`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vista_material_baja` AS SELECT 
 1 AS `baja_id`,
 1 AS `lamina`,
 1 AS `material_color`,
 1 AS `fecha`,
 1 AS `nombre`,
 1 AS `area_venta`,
 1 AS `fecha_captura`,
 1 AS `costo`,
 1 AS `tipo_baja`,
 1 AS `tipo_corte`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_material_color`
--

DROP TABLE IF EXISTS `vista_material_color`;
/*!50001 DROP VIEW IF EXISTS `vista_material_color`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vista_material_color` AS SELECT 
 1 AS `id`,
 1 AS `material_color`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_nomina`
--

DROP TABLE IF EXISTS `vista_nomina`;
/*!50001 DROP VIEW IF EXISTS `vista_nomina`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vista_nomina` AS SELECT 
 1 AS `id`,
 1 AS `sa`,
 1 AS `do`,
 1 AS `lu`,
 1 AS `ma`,
 1 AS `mi`,
 1 AS `ju`,
 1 AS `vi`,
 1 AS `observaciones`,
 1 AS `lista_id`,
 1 AS `empleado_id`,
 1 AS `revisado`,
 1 AS `hora_extra`,
 1 AS `prima_dominical`,
 1 AS `vacaciones`,
 1 AS `festivo`,
 1 AS `semana_completa`,
 1 AS `dias_pago`,
 1 AS `revision_contabilidad`,
 1 AS `nomina`,
 1 AS `nomina_ss`,
 1 AS `empleado`,
 1 AS `departamento_id`,
 1 AS `departamento`,
 1 AS `salario_diario`,
 1 AS `salario_semanal`,
 1 AS `bono_mtto`,
 1 AS `infonavit`,
 1 AS `abono_prestamo`,
 1 AS `otras_percepciones`,
 1 AS `motivo`,
 1 AS `dias_trabajados`,
 1 AS `dias_pagados`,
 1 AS `ss`,
 1 AS `salario_total`,
 1 AS `p_dominical`,
 1 AS `dias_real`,
 1 AS `h_extra`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_precios_mantenimiento`
--

DROP TABLE IF EXISTS `vista_precios_mantenimiento`;
/*!50001 DROP VIEW IF EXISTS `vista_precios_mantenimiento`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vista_precios_mantenimiento` AS SELECT 
 1 AS `descripcion`,
 1 AS `trimestre`,
 1 AS `semestre`,
 1 AS `anual`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_producto_construccion`
--

DROP TABLE IF EXISTS `vista_producto_construccion`;
/*!50001 DROP VIEW IF EXISTS `vista_producto_construccion`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vista_producto_construccion` AS SELECT 
 1 AS `id`,
 1 AS `nombre`,
 1 AS `precio_construccion`,
 1 AS `porcentaje_comision`,
 1 AS `activo`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_promotores`
--

DROP TABLE IF EXISTS `vista_promotores`;
/*!50001 DROP VIEW IF EXISTS `vista_promotores`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vista_promotores` AS SELECT 
 1 AS `id`,
 1 AS `Promotor`,
 1 AS `email`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_recubrimiento`
--

DROP TABLE IF EXISTS `vista_recubrimiento`;
/*!50001 DROP VIEW IF EXISTS `vista_recubrimiento`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vista_recubrimiento` AS SELECT 
 1 AS `id`,
 1 AS `nombre`,
 1 AS `precio_recubrimiento`,
 1 AS `porcentaje_comision`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_reposiciones`
--

DROP TABLE IF EXISTS `vista_reposiciones`;
/*!50001 DROP VIEW IF EXISTS `vista_reposiciones`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vista_reposiciones` AS SELECT 
 1 AS `created_at`,
 1 AS `inventario_recubrimientos_id`,
 1 AS `pieza`,
 1 AS `material_color`,
 1 AS `folio_lamina`,
 1 AS `motivos`,
 1 AS `usuario`,
 1 AS `precio_reposicion`,
 1 AS `costo_material_usado`,
 1 AS `area_venta`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_salarios_activos`
--

DROP TABLE IF EXISTS `vista_salarios_activos`;
/*!50001 DROP VIEW IF EXISTS `vista_salarios_activos`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vista_salarios_activos` AS SELECT 
 1 AS `id`,
 1 AS `created_at`,
 1 AS `updated_at`,
 1 AS `activo`,
 1 AS `empleado_id`,
 1 AS `salario_diario`,
 1 AS `salario_semanal`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_servicio_funeral`
--

DROP TABLE IF EXISTS `vista_servicio_funeral`;
/*!50001 DROP VIEW IF EXISTS `vista_servicio_funeral`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vista_servicio_funeral` AS SELECT 
 1 AS `id`,
 1 AS `nombre`,
 1 AS `precio_servicio`,
 1 AS `monto_comisionable`,
 1 AS `porcentaje_comision`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_stock`
--

DROP TABLE IF EXISTS `vista_stock`;
/*!50001 DROP VIEW IF EXISTS `vista_stock`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vista_stock` AS SELECT 
 1 AS `id`,
 1 AS `inventario_recubrimientos_id`,
 1 AS `material_baja_id`,
 1 AS `lamina_alta_id`,
 1 AS `folio`,
 1 AS `pieza`,
 1 AS `material_color`,
 1 AS `folio_lamina`,
 1 AS `costo_material_usado`,
 1 AS `precio_venta`,
 1 AS `created_at`,
 1 AS `area_requerida`,
 1 AS `stock_activo`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_terrenos_disponibles`
--

DROP TABLE IF EXISTS `vista_terrenos_disponibles`;
/*!50001 DROP VIEW IF EXISTS `vista_terrenos_disponibles`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vista_terrenos_disponibles` AS SELECT 
 1 AS `producto_id`,
 1 AS `sector_id`,
 1 AS `recinto_id`,
 1 AS `lote_id`,
 1 AS `id`,
 1 AS `sector`,
 1 AS `recinto`,
 1 AS `tipo`,
 1 AS `fila`,
 1 AS `columna`,
 1 AS `monto`,
 1 AS `porcentaje_comision`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_ventas_totales_lamina`
--

DROP TABLE IF EXISTS `vista_ventas_totales_lamina`;
/*!50001 DROP VIEW IF EXISTS `vista_ventas_totales_lamina`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vista_ventas_totales_lamina` AS SELECT 
 1 AS `id`,
 1 AS `folio`,
 1 AS `inventario_recubrimientos_id`,
 1 AS `venta_material_id`,
 1 AS `folio_lamina`,
 1 AS `pieza`,
 1 AS `material_color`,
 1 AS `precio_pieza`,
 1 AS `observaciones`,
 1 AS `pieza_completa`,
 1 AS `venta_abierta`,
 1 AS `piezas`,
 1 AS `total`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `advertencia_comision_activa`
--

/*!50001 DROP VIEW IF EXISTS `advertencia_comision_activa`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `advertencia_comision_activa` AS select `comision_advertencia`.`id` AS `id`,`comision_advertencia`.`comision_id` AS `comision_id`,`comision_advertencia`.`created_at` AS `created_at`,`comision_advertencia`.`motivos` AS `motivos`,`comision_advertencia`.`activo` AS `activo`,`comision_advertencia`.`updated_at` AS `updated_at` from `comision_advertencia` where (`comision_advertencia`.`activo` = 1) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `ventas_totales`
--

/*!50001 DROP VIEW IF EXISTS `ventas_totales`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `ventas_totales` AS select sum(`venta_producto`.`total`) AS `total`,sum(`venta_producto`.`cantidad`) AS `cantidad`,'Lotes Funerarios' AS `producto` from ((`lote` join `producto` on((`lote`.`producto_id` = `producto`.`id`))) join `venta_producto` on((`venta_producto`.`producto_id` = `producto`.`id`))) union all select sum(`venta_producto`.`total`) AS `total`,sum(`venta_producto`.`cantidad`) AS `cantidad`,'Mantenimientos' AS `producto` from ((`mantenimiento` join `producto` on((`mantenimiento`.`producto_id` = `producto`.`id`))) join `venta_producto` on((`venta_producto`.`producto_id` = `producto`.`id`))) union all select sum(`venta_producto`.`total`) AS `total`,sum(`venta_producto`.`cantidad`) AS `cantidad`,'Construcciones' AS `producto` from ((`construccion` join `producto` on((`construccion`.`producto_id` = `producto`.`id`))) join `venta_producto` on((`venta_producto`.`producto_id` = `producto`.`id`))) union all select sum(`venta_producto`.`total`) AS `total`,sum(`venta_producto`.`cantidad`) AS `cantidad`,'Servicios Funerales' AS `producto` from ((`servicio_funeral` join `producto` on((`servicio_funeral`.`producto_id` = `producto`.`id`))) join `venta_producto` on((`venta_producto`.`producto_id` = `producto`.`id`))) union all select sum(`venta_producto`.`total`) AS `total`,sum(`venta_producto`.`cantidad`) AS `cantidad`,'Trámites' AS `producto` from ((`tramite` join `producto` on((`tramite`.`producto_id` = `producto`.`id`))) join `venta_producto` on((`venta_producto`.`producto_id` = `producto`.`id`))) union all select sum(`venta_producto`.`total`) AS `total`,sum(`venta_producto`.`cantidad`) AS `cantidad`,'Inhumaciones' AS `producto` from ((`inhumacion` join `producto` on((`inhumacion`.`producto_id` = `producto`.`id`))) join `venta_producto` on((`venta_producto`.`producto_id` = `producto`.`id`))) union all select sum(`venta_producto`.`total`) AS `total`,sum(`venta_producto`.`cantidad`) AS `cantidad`,'Exhumaciones' AS `producto` from ((`exhumacion` join `producto` on((`exhumacion`.`producto_id` = `producto`.`id`))) join `venta_producto` on((`venta_producto`.`producto_id` = `producto`.`id`))) union all select sum(`venta_producto`.`total`) AS `total`,sum(`venta_producto`.`cantidad`) AS `cantidad`,'Extras' AS `producto` from ((`extra` join `producto` on((`extra`.`producto_id` = `producto`.`id`))) join `venta_producto` on((`venta_producto`.`producto_id` = `producto`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_abono_comision_periodo`
--

/*!50001 DROP VIEW IF EXISTS `vista_abono_comision_periodo`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_abono_comision_periodo` AS select `abono_comision`.`id` AS `id`,`abono_comision`.`periodo_comision_id` AS `periodo_comision_id`,`abono_comision`.`comision_id` AS `comision_id`,`abono_comision`.`monto` AS `monto`,`abono_comision`.`fecha` AS `fecha`,`abono_comision`.`cancelado` AS `cancelado`,`abono_comision`.`created_at` AS `created_at`,`abono_comision`.`updated_at` AS `updated_at`,`abono_comision`.`pagado` AS `pagado`,`abono_comision`.`asesor_id` AS `asesor_id`,`periodo_comision`.`folio` AS `folio_comision`,`periodo_comision`.`fecha_inicio` AS `fecha_inicio`,`periodo_comision`.`fecha_fin` AS `fecha_fin` from (`abono_comision` left join `periodo_comision` on((`abono_comision`.`periodo_comision_id` = `periodo_comision`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_asesor_promotor`
--

/*!50001 DROP VIEW IF EXISTS `vista_asesor_promotor`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_asesor_promotor` AS select `asesor`.`persona_id` AS `persona_id`,`asesor`.`activo` AS `activo`,`asesor`.`id` AS `asesor_id`,`asesor_promotor`.`id` AS `promotor_id`,`asesor`.`fecha_ingreso` AS `fecha_ingreso`,concat(`persona`.`nombres`,' ',`persona`.`apellido_paterno`,' ',`persona`.`apellido_materno`) AS `asesor`,ifnull(concat(`persona_promotor`.`nombres`,' ',`persona_promotor`.`apellido_paterno`,' ',`persona_promotor`.`apellido_materno`),'Independiente') AS `promotor`,ifnull(`asesor`.`email`,'0') AS `email` from ((((`asesor` left join `persona` on((`asesor`.`persona_id` = `persona`.`id`))) left join `promotor` on((`promotor`.`asesor_id` = `asesor`.`id`))) left join `asesor` `asesor_promotor` on((`promotor`.`promotor_id` = `asesor_promotor`.`id`))) left join `persona` `persona_promotor` on((`asesor_promotor`.`persona_id` = `persona_promotor`.`id`))) where (`asesor`.`activo` = 1) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_clientes`
--

/*!50001 DROP VIEW IF EXISTS `vista_clientes`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_clientes` AS select `cliente`.`id` AS `id`,`persona`.`nombres` AS `nombres`,`persona`.`apellido_paterno` AS `apellido_paterno`,`persona`.`apellido_materno` AS `apellido_materno`,`cliente`.`calle` AS `calle`,`cliente`.`numero_exterior` AS `numero_exterior`,`cliente`.`numero_interior` AS `numero_interior`,`colonia`.`codigo_postal` AS `codigo_postal`,`colonia`.`nombre` AS `colonia`,`cliente`.`referencias` AS `referencias`,`municipio`.`nombre` AS `municipio`,`estado`.`nombre` AS `estado`,`pais`.`nombre` AS `pais`,`cliente`.`email` AS `email`,`estado_civil`.`descripcion` AS `estado_civil`,`cliente`.`latitud` AS `latitud`,`cliente`.`longitud` AS `longitud` from ((((((`cliente` left join `persona` on((`cliente`.`persona_id` = `persona`.`id`))) left join `colonia` on((`cliente`.`colonia_id` = `colonia`.`id`))) left join `municipio` on((`colonia`.`municipio_id` = `municipio`.`id`))) left join `estado` on((`municipio`.`estado_id` = `estado`.`id`))) left join `pais` on((`estado`.`pais_id` = `pais`.`id`))) left join `estado_civil` on((`cliente`.`estado_civil_id` = `estado_civil`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_colonia`
--

/*!50001 DROP VIEW IF EXISTS `vista_colonia`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_colonia` AS select `colonia`.`id` AS `colonia_id`,`colonia`.`nombre` AS `colonia`,`colonia`.`codigo_postal` AS `codigo_postal`,`estado`.`id` AS `estado_id`,`estado`.`nombre` AS `estado`,`municipio`.`nombre` AS `municipio` from ((`colonia` left join `municipio` on((`colonia`.`municipio_id` = `municipio`.`id`))) left join `estado` on((`municipio`.`estado_id` = `estado`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_comision`
--

/*!50001 DROP VIEW IF EXISTS `vista_comision`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_comision` AS select `comision`.`id` AS `id`,`venta`.`id` AS `venta_id`,`venta`.`folio_solicitud` AS `folio_solicitud`,`producto`.`id` AS `producto_id`,`producto`.`nombre` AS `producto`,concat(`cli`.`nombres`,' ',`cli`.`apellido_paterno`,' ',`cli`.`apellido_materno`) AS `cliente`,`asesor`.`id` AS `asesor_id`,concat(`vendedor`.`nombres`,' ',`vendedor`.`apellido_paterno`,' ',`vendedor`.`apellido_materno`) AS `vendedor`,`comision`.`cancelada` AS `cancelada`,`comision`.`pagada` AS `pagada`,`comision`.`numero_pagos` AS `numero_pagos`,`venta`.`total` AS `total`,`comision`.`total_comisionable` AS `total_comisionable`,ifnull(sum(`abono_comision`.`monto`),0) AS `pagado`,ifnull((`comision`.`total_comisionable` - sum(`abono_comision`.`monto`)),`comision`.`total_comisionable`) AS `por_pagar`,`comision`.`porcentaje` AS `porcentaje`,`departamento`.`nombre_corto` AS `nombre_corto`,count(`abono_comision`.`id`) AS `abonos`,`comision`.`observaciones` AS `observaciones`,ifnull(`advertencia`.`motivos`,0) AS `advertencia`,`advertencia`.`created_at` AS `created_at`,`venta`.`fecha` AS `fecha_venta` from ((((((((((`comision` left join `venta` on((`comision`.`venta_id` = `venta`.`id`))) left join `asesor` on((`comision`.`asesor_id` = `asesor`.`id`))) left join `persona` `vendedor` on((`asesor`.`persona_id` = `vendedor`.`id`))) left join `cliente` on((`venta`.`cliente_id` = `cliente`.`id`))) left join `persona` `cli` on((`cli`.`id` = `cliente`.`persona_id`))) left join `venta_producto` on((`venta`.`id` = `venta_producto`.`venta_id`))) left join `producto` on((`venta_producto`.`producto_id` = `producto`.`id`))) left join `abono_comision` on((`comision`.`id` = `abono_comision`.`comision_id`))) left join `departamento` on((`producto`.`departamento_id` = `departamento`.`id`))) left join `advertencia_comision_activa` `advertencia` on((`comision`.`id` = `advertencia`.`comision_id`))) group by `comision`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_detalle_factura`
--

/*!50001 DROP VIEW IF EXISTS `vista_detalle_factura`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_detalle_factura` AS select `lamina_alta`.`folio_factura` AS `folio_factura`,`lamina_alta`.`fecha` AS `fecha_factura`,`lamina_alta`.`created_at` AS `fecha_alta`,`material`.`nombre` AS `material`,`color`.`nombre` AS `color`,count(`lamina_alta`.`material_color_id`) AS `entrada`,sum(`lamina_alta`.`precio_total`) AS `total_factura` from (((`lamina_alta` left join `material_color` on((`lamina_alta`.`material_color_id` = `material_color`.`id`))) left join `color` on((`material_color`.`color_id` = `color`.`id`))) left join `material` on((`material_color`.`material_id` = `material`.`id`))) group by `lamina_alta`.`folio_factura`,`lamina_alta`.`material_color_id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_detalle_mantenimiento`
--

/*!50001 DROP VIEW IF EXISTS `vista_detalle_mantenimiento`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_detalle_mantenimiento` AS select `venta_mantenimiento`.`id` AS `id`,`cliente`.`id` AS `cliente_id`,`venta`.`id` AS `venta_id`,`lote`.`id` AS `lote_id`,`venta`.`folio_solicitud` AS `folio_solicitud`,`p2`.`id` AS `producto_id`,`venta_mantenimiento`.`fecha_inicio` AS `fecha_inicio`,`venta_mantenimiento`.`fecha_fin` AS `fecha_fin`,`p1`.`nombre` AS `ubicacion`,`p2`.`nombre` AS `producto`,concat(`persona`.`nombres`,' ',`persona`.`apellido_paterno`,' ',`persona`.`apellido_materno`) AS `cliente`,`persona`.`id` AS `persona_id`,`construccion`.`id` AS `construccion_id`,`construccion`.`descripcion` AS `descripcion`,`mantenimiento`.`construccion_id` AS `construccion_id_contrato`,`c2`.`descripcion` AS `construccion_mtto_contrato`,`mantenimiento`.`meses` AS `meses_contratados`,`venta_mantenimiento`.`activo` AS `venta_mantenimiento_activo`,if((`mantenimiento`.`construccion_id` <> `construccion`.`id`),0,1) AS `verifica`,`venta_producto`.`total` AS `total`,if((count(`propiedad_plantada`.`id`) > 0),'Si','No') AS `plantada`,if((count(`propiedad_plantada`.`id`) > 0),`propiedad_plantada`.`fecha`,'Aun no se planta') AS `fecha_plantacion`,if((`venta_mantenimiento`.`fecha_fin` < curdate()),1,0) AS `vencido`,(case when (`venta_mantenimiento`.`fecha_fin` < curdate()) then 'vencido' when (curdate() between (`venta_mantenimiento`.`fecha_fin` - interval 15 day) and `venta_mantenimiento`.`fecha_fin`) then 'por vencer' else 'vigente' end) AS `estatus`,concat(`persona_empleado`.`nombres`,' ',`persona_empleado`.`apellido_paterno`) AS `jardinero`,`cesped`.`cantidad` AS `cesped` from ((((((((((((((`venta_mantenimiento` left join `venta_producto` on((`venta_mantenimiento`.`venta_producto_id` = `venta_producto`.`id`))) left join `lote` on((`venta_mantenimiento`.`lote_id` = `lote`.`id`))) left join `producto` `p1` on((`lote`.`producto_id` = `p1`.`id`))) left join `venta` on((`venta_producto`.`venta_id` = `venta`.`id`))) left join `producto` `p2` on((`venta_producto`.`producto_id` = `p2`.`id`))) left join `cliente` on((`venta`.`cliente_id` = `cliente`.`id`))) left join `persona` on((`cliente`.`persona_id` = `persona`.`id`))) left join `empleado` on((`venta_mantenimiento`.`empleado_id` = `empleado`.`id`))) left join `persona` `persona_empleado` on((`empleado`.`persona_id` = `persona_empleado`.`id`))) left join `cesped` on((`venta_mantenimiento`.`id` = `cesped`.`venta_mantenimiento_id`))) left join `propiedad_plantada` on((`venta_mantenimiento`.`id` = `propiedad_plantada`.`venta_mantenimiento_id`))) left join `construccion` on((`p1`.`id` = `construccion`.`producto_id`))) left join `mantenimiento` on((`p2`.`id` = `mantenimiento`.`producto_id`))) left join `construccion` `c2` on((`mantenimiento`.`construccion_id` = `c2`.`id`))) group by `venta_mantenimiento`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_detalle_venta_material`
--

/*!50001 DROP VIEW IF EXISTS `vista_detalle_venta_material`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_detalle_venta_material` AS select `venta_material_baja`.`id` AS `id`,`venta_material`.`folio` AS `folio`,`inventario_recubrimientos`.`id` AS `inventario_recubrimientos_id`,`venta_material`.`id` AS `venta_material_id`,`lamina_alta`.`folio_lamina` AS `folio_lamina`,`pieza_marmoleria`.`nombre` AS `pieza`,`vista_material_color`.`material_color` AS `material_color`,`venta_material_baja`.`precio_pieza` AS `precio_pieza`,`material_baja`.`observaciones` AS `observaciones`,`material_baja`.`pieza_completa` AS `pieza_completa`,`material_baja`.`medida_estandar` AS `medida_estandar`,if((`venta_material`.`created_at` < curdate()),'0','1') AS `venta_abierta` from ((((((`venta_material_baja` left join `venta_material` on((`venta_material_baja`.`venta_material_id` = `venta_material`.`id`))) left join `material_baja` on((`venta_material_baja`.`material_baja_id` = `material_baja`.`id`))) left join `pieza_marmoleria` on((`material_baja`.`pieza_marmoleria_id` = `pieza_marmoleria`.`id`))) left join `inventario_recubrimientos` on((`material_baja`.`inventario_recubrimientos_id` = `inventario_recubrimientos`.`id`))) left join `lamina_alta` on((`inventario_recubrimientos`.`lamina_alta_id` = `lamina_alta`.`id`))) left join `vista_material_color` on((`lamina_alta`.`material_color_id` = `vista_material_color`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_empleado`
--

/*!50001 DROP VIEW IF EXISTS `vista_empleado`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_empleado` AS select `empleado`.`id` AS `id`,`persona`.`nombres` AS `nombres`,`persona`.`apellido_paterno` AS `apellido_paterno`,`persona`.`apellido_materno` AS `apellido_materno`,`puesto`.`nombre` AS `puesto`,`departamento`.`id` AS `departamento_id`,`departamento`.`nombre` AS `departamento`,`empleado`.`fecha_ingreso` AS `fecha_ingreso`,`empleado`.`activo` AS `activo`,`s`.`activo` AS `salario_activo`,`s`.`salario_diario` AS `salario_diario`,`s`.`salario_semanal` AS `salario_semanal` from ((((`empleado` left join `persona` on((`empleado`.`persona_id` = `persona`.`id`))) left join `puesto` on((`empleado`.`puesto_id` = `puesto`.`id`))) left join `departamento` on((`puesto`.`departamento_id` = `departamento`.`id`))) left join `vista_salarios_activos` `s` on((`empleado`.`id` = `s`.`empleado_id`))) order by `empleado`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_estadistico_color_material`
--

/*!50001 DROP VIEW IF EXISTS `vista_estadistico_color_material`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_estadistico_color_material` AS select `vista_material_color`.`material_color` AS `material_color`,count(`material_baja`.`id`) AS `movimientos` from (((`material_baja` left join `inventario_recubrimientos` on((`material_baja`.`inventario_recubrimientos_id` = `inventario_recubrimientos`.`id`))) left join `lamina_alta` on((`inventario_recubrimientos`.`lamina_alta_id` = `lamina_alta`.`id`))) left join `vista_material_color` on((`lamina_alta`.`material_color_id` = `vista_material_color`.`id`))) where (date_format(`inventario_recubrimientos`.`updated_at`,'%Y-%m-%d') between (curdate() + interval -(1) month) and curdate()) group by `vista_material_color`.`material_color` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_estadistico_movimiento_lamina`
--

/*!50001 DROP VIEW IF EXISTS `vista_estadistico_movimiento_lamina`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_estadistico_movimiento_lamina` AS select `lamina_alta`.`id` AS `lamina_alta_id`,`lamina_alta`.`folio_lamina` AS `folio_lamina`,`vista_material_color`.`material_color` AS `material_color`,`lamina_alta`.`precio_total` AS `costo_lamina`,if((sum(`repo`.`precio_reposicion`) > 0),sum(`repo`.`precio_reposicion`),0) AS `perdida_reposicion`,if((sum(`venta_material_baja`.`precio_pieza`) > 0),sum(`venta_material_baja`.`precio_pieza`),0) AS `ventas`,if((sum(`vista_stock`.`precio_venta`) > 0),sum(`vista_stock`.`precio_venta`),0) AS `stock`,if((sum(`material_baja`.`costo_material_usado`) > 0),sum(`material_baja`.`costo_material_usado`),0) AS `costo_produccion`,count(`material_baja`.`id`) AS `movimientos`,((if((sum(`venta_material_baja`.`precio_pieza`) > 0),sum(`venta_material_baja`.`precio_pieza`),0) - if((sum(`repo`.`precio_reposicion`) > 0),sum(`repo`.`precio_reposicion`),0)) - `lamina_alta`.`precio_total`) AS `utilidad` from ((((((`material_baja` left join `inventario_recubrimientos` on((`material_baja`.`inventario_recubrimientos_id` = `inventario_recubrimientos`.`id`))) left join `lamina_alta` on((`inventario_recubrimientos`.`lamina_alta_id` = `lamina_alta`.`id`))) left join `vista_material_color` on((`lamina_alta`.`material_color_id` = `vista_material_color`.`id`))) left join `venta_material_baja` on((`material_baja`.`id` = `venta_material_baja`.`material_baja_id`))) left join `reposicion` `repo` on((`material_baja`.`id` = `repo`.`material_baja_id`))) left join `vista_stock` on((`material_baja`.`id` = `vista_stock`.`material_baja_id`))) group by `lamina_alta`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_estadisticos_lamina`
--

/*!50001 DROP VIEW IF EXISTS `vista_estadisticos_lamina`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_estadisticos_lamina` AS select `lamina_alta`.`folio_lamina` AS `folio_lamina`,`inventario_recubrimientos`.`id` AS `inventario_recubrimientos_id`,`vista_material_color`.`material_color` AS `material_color`,sum(`material_baja`.`venta`) AS `venta`,sum(`material_baja`.`stock`) AS `stock`,sum(`material_baja`.`reposicion`) AS `reposicion` from (((`material_baja` left join `inventario_recubrimientos` on((`material_baja`.`inventario_recubrimientos_id` = `inventario_recubrimientos`.`id`))) left join `lamina_alta` on((`inventario_recubrimientos`.`lamina_alta_id` = `lamina_alta`.`id`))) left join `vista_material_color` on((`lamina_alta`.`material_color_id` = `vista_material_color`.`id`))) where (date_format(`inventario_recubrimientos`.`updated_at`,'%Y-%m-%d') between (curdate() + interval -(1) month) and curdate()) group by `lamina_alta`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_extra`
--

/*!50001 DROP VIEW IF EXISTS `vista_extra`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_extra` AS select `producto`.`id` AS `id`,`producto`.`nombre` AS `nombre`,`precio`.`monto` AS `precio_extra`,`producto`.`porcentaje_comision` AS `porcentaje_comision` from ((`extra` left join `producto` on((`extra`.`producto_id` = `producto`.`id`))) left join `precio` on((`producto`.`id` = `precio`.`producto_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_factura`
--

/*!50001 DROP VIEW IF EXISTS `vista_factura`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_factura` AS select `lamina_alta`.`folio_factura` AS `folio_factura`,`proveedor`.`nombre` AS `proveedor`,`lamina_alta`.`fecha` AS `fecha_factura`,`lamina_alta`.`created_at` AS `fecha_alta`,if((`lamina_alta`.`created_at` < curdate()),'0','1') AS `factura_abierta`,count(`lamina_alta`.`material_color_id`) AS `entrada`,sum(`lamina_alta`.`precio_total`) AS `total_factura` from ((((`lamina_alta` left join `material_color` on((`lamina_alta`.`material_color_id` = `material_color`.`id`))) left join `color` on((`material_color`.`color_id` = `color`.`id`))) left join `material` on((`material_color`.`material_id` = `material`.`id`))) left join `proveedor` on((`lamina_alta`.`proveedor_id` = `proveedor`.`id`))) group by `lamina_alta`.`folio_factura` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_inhumados_mtto`
--

/*!50001 DROP VIEW IF EXISTS `vista_inhumados_mtto`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_inhumados_mtto` AS select concat(`persona`.`nombres`,' ',`persona`.`apellido_paterno`,' ',`persona`.`apellido_materno`) AS `inhumado`,`venta_inhumacion`.`posicion` AS `posicion`,`venta_inhumacion`.`fecha` AS `fecha_servicio`,`inhumado`.`fecha_nacimiento` AS `fecha_nacimiento`,`inhumado`.`fecha_deceso` AS `fecha_deceso`,`producto`.`nombre` AS `ubicacion`,`lote`.`id` AS `lote_id` from ((((`venta_inhumacion` left join `lote` on((`venta_inhumacion`.`lote_id` = `lote`.`id`))) left join `inhumado` on((`venta_inhumacion`.`inhumado_id` = `inhumado`.`id`))) left join `persona` on((`inhumado`.`persona_id` = `persona`.`id`))) left join `producto` on((`lote`.`producto_id` = `producto`.`id`))) order by `venta_inhumacion`.`posicion` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_inventario_recub_general`
--

/*!50001 DROP VIEW IF EXISTS `vista_inventario_recub_general`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_inventario_recub_general` AS select `vista_inventario_recubrimiento`.`id` AS `id`,`vista_inventario_recubrimiento`.`inventario_recubrimientos_id` AS `inventario_recubrimientos_id`,`vista_inventario_recubrimiento`.`lamina_alta_id` AS `lamina_alta_id`,`vista_inventario_recubrimiento`.`folio_lamina` AS `folio_lamina`,`vista_inventario_recubrimiento`.`folio_factura` AS `folio_factura`,`vista_inventario_recubrimiento`.`material_color` AS `material_color`,`vista_inventario_recubrimiento`.`proveedor` AS `proveedor`,`vista_inventario_recubrimiento`.`area_total` AS `area_total`,`vista_inventario_recubrimiento`.`area_usada` AS `area_usada`,`vista_inventario_recubrimiento`.`area_stock` AS `area_stock`,`vista_inventario_recubrimiento`.`precio_inicial` AS `precio_inicial`,`vista_inventario_recubrimiento`.`precio_stock` AS `precio_stock`,`vista_inventario_recubrimiento`.`lamina_completa` AS `lamina_completa`,`vista_inventario_recubrimiento`.`porcentaje_restante` AS `porcentaje_restante`,`vista_inventario_recubrimiento`.`activo` AS `activo`,ifnull(`vista_estadistico_movimiento_lamina`.`costo_lamina`,0) AS `costo_lamina`,ifnull(`vista_estadistico_movimiento_lamina`.`perdida_reposicion`,0) AS `perdida_reposicion`,ifnull(`vista_estadistico_movimiento_lamina`.`ventas`,0) AS `ventas`,ifnull(`vista_estadistico_movimiento_lamina`.`stock`,0) AS `stock`,ifnull(`vista_estadistico_movimiento_lamina`.`costo_produccion`,0) AS `costo_produccion`,ifnull(`vista_estadistico_movimiento_lamina`.`movimientos`,0) AS `movimientos`,ifnull(`vista_estadistico_movimiento_lamina`.`utilidad`,0) AS `utilidad` from (`vista_inventario_recubrimiento` left join `vista_estadistico_movimiento_lamina` on((`vista_inventario_recubrimiento`.`lamina_alta_id` = `vista_estadistico_movimiento_lamina`.`lamina_alta_id`))) where ((date_format(`vista_inventario_recubrimiento`.`updated_at`,'%Y-%m-%d') between (curdate() + interval -(1) month) and curdate()) or (`vista_inventario_recubrimiento`.`activo` = 1)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_inventario_recubrimiento`
--

/*!50001 DROP VIEW IF EXISTS `vista_inventario_recubrimiento`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_inventario_recubrimiento` AS select `inventario_recubrimientos`.`id` AS `id`,`inventario_recubrimientos`.`id` AS `inventario_recubrimientos_id`,`lamina_alta`.`id` AS `lamina_alta_id`,`lamina_alta`.`folio_lamina` AS `folio_lamina`,`lamina_alta`.`folio_factura` AS `folio_factura`,concat(`material`.`nombre`,' ',`color`.`nombre`) AS `material_color`,`proveedor`.`nombre` AS `proveedor`,`lamina_alta`.`area_total` AS `area_total`,`inventario_recubrimientos`.`area_usada` AS `area_usada`,`inventario_recubrimientos`.`updated_at` AS `updated_at`,`inventario_recubrimientos`.`area_stock` AS `area_stock`,`lamina_alta`.`precio_total` AS `precio_inicial`,`inventario_recubrimientos`.`precio_stock` AS `precio_stock`,`lamina_alta`.`lamina_completa` AS `lamina_completa`,round(((`inventario_recubrimientos`.`area_stock` * 100) / `lamina_alta`.`area_total`),2) AS `porcentaje_restante`,`inventario_recubrimientos`.`activo` AS `activo` from (((((`inventario_recubrimientos` left join `lamina_alta` on((`inventario_recubrimientos`.`lamina_alta_id` = `lamina_alta`.`id`))) left join `material_color` on((`lamina_alta`.`material_color_id` = `material_color`.`id`))) left join `material` on((`material_color`.`material_id` = `material`.`id`))) left join `color` on((`material_color`.`color_id` = `color`.`id`))) left join `proveedor` on((`lamina_alta`.`proveedor_id` = `proveedor`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_lista_asistencia`
--

/*!50001 DROP VIEW IF EXISTS `vista_lista_asistencia`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_lista_asistencia` AS select concat(`vista_empleado`.`nombres`,' ',`vista_empleado`.`apellido_paterno`) AS `empleado`,`vista_empleado`.`departamento` AS `departamento`,`asistencia`.`id` AS `id`,`asistencia`.`sa` AS `sa`,`asistencia`.`do` AS `do`,`asistencia`.`lu` AS `lu`,`asistencia`.`ma` AS `ma`,`asistencia`.`mi` AS `mi`,`asistencia`.`ju` AS `ju`,`asistencia`.`vi` AS `vi`,`asistencia`.`observaciones` AS `observaciones`,`asistencia`.`lista_id` AS `lista_id`,`asistencia`.`empleado_id` AS `empleado_id`,`asistencia`.`revisado` AS `revisado`,`asistencia`.`hora_extra` AS `hora_extra`,`asistencia`.`prima_dominical` AS `prima_dominical`,`asistencia`.`vacaciones` AS `vacaciones`,`asistencia`.`festivo` AS `festivo`,`asistencia`.`semana_completa` AS `semana_completa`,`asistencia`.`dias_pago` AS `dias_pago`,`asistencia`.`revision_contabilidad` AS `revision_contabilidad`,`asistencia`.`nomina` AS `nomina`,`asistencia`.`nomina_ss` AS `nomina_ss`,((((((`asistencia`.`sa` + `asistencia`.`do`) + `asistencia`.`lu`) + `asistencia`.`ma`) + `asistencia`.`mi`) + `asistencia`.`ju`) + `asistencia`.`vi`) AS `dias_asistidos`,if(((6 - ((((((`asistencia`.`sa` + `asistencia`.`do`) + `asistencia`.`lu`) + `asistencia`.`ma`) + `asistencia`.`mi`) + `asistencia`.`ju`) + `asistencia`.`vi`)) > 0),(6 - ((((((`asistencia`.`sa` + `asistencia`.`do`) + `asistencia`.`lu`) + `asistencia`.`ma`) + `asistencia`.`mi`) + `asistencia`.`ju`) + `asistencia`.`vi`)),0) AS `faltas`,if((`asistencia`.`do` = 1),1,0) AS `prima` from (`asistencia` left join `vista_empleado` on((`asistencia`.`empleado_id` = `vista_empleado`.`id`))) where (`vista_empleado`.`activo` = 1) order by `vista_empleado`.`departamento` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_material_baja`
--

/*!50001 DROP VIEW IF EXISTS `vista_material_baja`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_material_baja` AS select `material_baja`.`id` AS `baja_id`,`lamina_alta`.`folio_lamina` AS `lamina`,`vista_material_color`.`material_color` AS `material_color`,`material_baja`.`fecha` AS `fecha`,`pieza_marmoleria`.`nombre` AS `nombre`,`material_baja`.`area_venta` AS `area_venta`,`material_baja`.`created_at` AS `fecha_captura`,`material_baja`.`costo_material_usado` AS `costo`,if((`material_baja`.`venta` = 1),'Venta',if((`material_baja`.`reposicion` = 1),'Reposicion','Stock')) AS `tipo_baja`,concat(if((`material_baja`.`pieza_completa` = 1),'Pieza completa','Corte'),' ',if((`material_baja`.`medida_estandar` = 1),'medida estandar','medida especial')) AS `tipo_corte` from ((((`material_baja` left join `pieza_marmoleria` on((`material_baja`.`pieza_marmoleria_id` = `pieza_marmoleria`.`id`))) left join `inventario_recubrimientos` on((`material_baja`.`inventario_recubrimientos_id` = `inventario_recubrimientos`.`id`))) left join `lamina_alta` on((`inventario_recubrimientos`.`lamina_alta_id` = `lamina_alta`.`id`))) left join `vista_material_color` on((`lamina_alta`.`material_color_id` = `vista_material_color`.`id`))) order by `material_baja`.`fecha` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_material_color`
--

/*!50001 DROP VIEW IF EXISTS `vista_material_color`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_material_color` AS select `material_color`.`id` AS `id`,concat(`material`.`nombre`,' ',`color`.`nombre`) AS `material_color` from ((`material_color` join `material` on((`material_color`.`material_id` = `material`.`id`))) left join `color` on((`material_color`.`color_id` = `color`.`id`))) order by `material`.`nombre` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_nomina`
--

/*!50001 DROP VIEW IF EXISTS `vista_nomina`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_nomina` AS select `asistencia`.`id` AS `id`,`asistencia`.`sa` AS `sa`,`asistencia`.`do` AS `do`,`asistencia`.`lu` AS `lu`,`asistencia`.`ma` AS `ma`,`asistencia`.`mi` AS `mi`,`asistencia`.`ju` AS `ju`,`asistencia`.`vi` AS `vi`,`asistencia`.`observaciones` AS `observaciones`,`asistencia`.`lista_id` AS `lista_id`,`asistencia`.`empleado_id` AS `empleado_id`,`asistencia`.`revisado` AS `revisado`,`asistencia`.`hora_extra` AS `hora_extra`,`asistencia`.`prima_dominical` AS `prima_dominical`,`asistencia`.`vacaciones` AS `vacaciones`,`asistencia`.`festivo` AS `festivo`,`asistencia`.`semana_completa` AS `semana_completa`,`asistencia`.`dias_pago` AS `dias_pago`,`asistencia`.`revision_contabilidad` AS `revision_contabilidad`,`asistencia`.`nomina` AS `nomina`,`asistencia`.`nomina_ss` AS `nomina_ss`,concat(`vista_empleado`.`nombres`,' ',`vista_empleado`.`apellido_paterno`,' ',`vista_empleado`.`apellido_materno`) AS `empleado`,`vista_empleado`.`departamento_id` AS `departamento_id`,`vista_empleado`.`departamento` AS `departamento`,`salario`.`salario_diario` AS `salario_diario`,`salario`.`salario_semanal` AS `salario_semanal`,if((`bono_mtto`.`monto` > 0),`bono_mtto`.`monto`,0) AS `bono_mtto`,if((`infonavit`.`monto` > 0),`infonavit`.`monto`,0) AS `infonavit`,if((`abono_prestamo`.`monto` > 0),`abono_prestamo`.`monto`,0) AS `abono_prestamo`,if((`otras_percepciones`.`monto` > 0),`otras_percepciones`.`monto`,0) AS `otras_percepciones`,if((`otras_percepciones`.`monto` > 0),`otras_percepciones`.`motivo`,'') AS `motivo`,(case ((((((`asistencia`.`lu` + `asistencia`.`ma`) + `asistencia`.`mi`) + `asistencia`.`ju`) + `asistencia`.`vi`) + `asistencia`.`sa`) + `asistencia`.`do`) when 6 then 7 when 7 then 8 when 0 then 0 else ((((((`asistencia`.`lu` + `asistencia`.`ma`) + `asistencia`.`mi`) + `asistencia`.`ju`) + `asistencia`.`vi`) + `asistencia`.`sa`) + `asistencia`.`do`) end) AS `dias_trabajados`,(case ((((((`asistencia`.`lu` + `asistencia`.`ma`) + `asistencia`.`mi`) + `asistencia`.`ju`) + `asistencia`.`vi`) + `asistencia`.`sa`) + `asistencia`.`do`) when 6 then 7 when 7 then if((`asistencia`.`semana_completa` = 1),8,7) when 0 then 0 else ((((((`asistencia`.`lu` + `asistencia`.`ma`) + `asistencia`.`mi`) + `asistencia`.`ju`) + `asistencia`.`vi`) + `asistencia`.`sa`) + `asistencia`.`do`) end) AS `dias_pagados`,(case ((((((`asistencia`.`lu` + `asistencia`.`ma`) + `asistencia`.`mi`) + `asistencia`.`ju`) + `asistencia`.`vi`) + `asistencia`.`sa`) + `asistencia`.`do`) when 6 then round(((`salario`.`salario_semanal` / 7) * 7),0) when 7 then if((`asistencia`.`semana_completa` = 1),round(((`salario`.`salario_semanal` / 7) * 8),0),round(((`salario`.`salario_semanal` / 7) * 7),0)) when 0 then 0 else round(((`salario`.`salario_semanal` / 7) * ((((((`asistencia`.`lu` + `asistencia`.`ma`) + `asistencia`.`mi`) + `asistencia`.`ju`) + `asistencia`.`vi`) + `asistencia`.`sa`) + `asistencia`.`do`)),0) end) AS `ss`,(case ((((((`asistencia`.`lu` + `asistencia`.`ma`) + `asistencia`.`mi`) + `asistencia`.`ju`) + `asistencia`.`vi`) + `asistencia`.`sa`) + `asistencia`.`do`) when 6 then ((((((round(((`salario`.`salario_semanal` / 7) * 7),0) + if((`bono_mtto`.`monto` > 0),`bono_mtto`.`monto`,0)) + if((`asistencia`.`hora_extra` > 0),round((((`salario`.`salario_diario` / 8) * `asistencia`.`hora_extra`) * 2),0),0)) + if(((`asistencia`.`prima_dominical` > 0) and (`asistencia`.`do` = 1)),round(((`salario`.`salario_diario` * 0.25) * `asistencia`.`prima_dominical`),0),0)) + if((`otras_percepciones`.`monto` > 0),`otras_percepciones`.`monto`,0)) - if((`infonavit`.`monto` > 0),`infonavit`.`monto`,0)) - if((`abono_prestamo`.`monto` > 0),`abono_prestamo`.`monto`,0)) when 7 then ((((((if((`asistencia`.`semana_completa` = 1),round(((`salario`.`salario_semanal` / 7) * 8),0),round(((`salario`.`salario_semanal` / 7) * 7),0)) + if((`bono_mtto`.`monto` > 0),`bono_mtto`.`monto`,0)) + if((`asistencia`.`hora_extra` > 0),round((((`salario`.`salario_diario` / 8) * `asistencia`.`hora_extra`) * 2),0),0)) + if(((`asistencia`.`prima_dominical` > 0) and (`asistencia`.`do` = 1)),round(((`salario`.`salario_diario` * 0.25) * `asistencia`.`prima_dominical`),0),0)) + if((`otras_percepciones`.`monto` > 0),`otras_percepciones`.`monto`,0)) - if((`infonavit`.`monto` > 0),`infonavit`.`monto`,0)) - if((`abono_prestamo`.`monto` > 0),`abono_prestamo`.`monto`,0)) when 0 then 0 else ((((((round(((`salario`.`salario_semanal` / 7) * sum(((((((`asistencia`.`lu` + `asistencia`.`ma`) + `asistencia`.`mi`) + `asistencia`.`ju`) + `asistencia`.`vi`) + `asistencia`.`sa`) + `asistencia`.`do`))),0) + if((`bono_mtto`.`monto` > 0),`bono_mtto`.`monto`,0)) + if((`asistencia`.`hora_extra` > 0),round((((`salario`.`salario_diario` / 8) * `asistencia`.`hora_extra`) * 2),0),0)) + if(((`asistencia`.`prima_dominical` > 0) and (`asistencia`.`do` = 1)),round(((`salario`.`salario_diario` * 0.25) * `asistencia`.`prima_dominical`),0),0)) + if((`otras_percepciones`.`monto` > 0),`otras_percepciones`.`monto`,0)) - if((`infonavit`.`monto` > 0),`infonavit`.`monto`,0)) - if((`abono_prestamo`.`monto` > 0),`abono_prestamo`.`monto`,0)) end) AS `salario_total`,if(((`asistencia`.`prima_dominical` > 0) and (`asistencia`.`do` = 1)),round(((`salario`.`salario_diario` * 0.25) * `asistencia`.`prima_dominical`),0),0) AS `p_dominical`,((((((`asistencia`.`lu` + `asistencia`.`ma`) + `asistencia`.`mi`) + `asistencia`.`ju`) + `asistencia`.`vi`) + `asistencia`.`sa`) + `asistencia`.`do`) AS `dias_real`,if((`asistencia`.`hora_extra` > 0),round((((`salario`.`salario_diario` / 8) * `asistencia`.`hora_extra`) * 2),0),0) AS `h_extra` from ((((((`asistencia` left join `vista_empleado` on((`asistencia`.`empleado_id` = `vista_empleado`.`id`))) left join `salario` on((`asistencia`.`empleado_id` = `salario`.`empleado_id`))) left join `bono_mtto` on((`asistencia`.`id` = `bono_mtto`.`asistencia_id`))) left join `infonavit` on((`asistencia`.`empleado_id` = `infonavit`.`empleado_id`))) left join `abono_prestamo` on((`asistencia`.`id` = `abono_prestamo`.`asistencia_id`))) left join `otras_percepciones` on((`asistencia`.`id` = `otras_percepciones`.`asistencia_id`))) where (`vista_empleado`.`activo` = 1) group by `asistencia`.`id` order by `vista_empleado`.`departamento` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_precios_mantenimiento`
--

/*!50001 DROP VIEW IF EXISTS `vista_precios_mantenimiento`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_precios_mantenimiento` AS select `construccion`.`descripcion` AS `descripcion`,sum((case when (`mantenimiento`.`meses` = 3) then `precio`.`monto` end)) AS `trimestre`,sum((case when (`mantenimiento`.`meses` = 6) then `precio`.`monto` end)) AS `semestre`,sum((case when (`mantenimiento`.`meses` = 12) then `precio`.`monto` end)) AS `anual` from (((`mantenimiento` left join `producto` on((`mantenimiento`.`producto_id` = `producto`.`id`))) left join `precio` on((`producto`.`id` = `precio`.`producto_id`))) left join `construccion` on((`mantenimiento`.`construccion_id` = `construccion`.`id`))) group by `construccion`.`descripcion` order by `construccion`.`descripcion` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_producto_construccion`
--

/*!50001 DROP VIEW IF EXISTS `vista_producto_construccion`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_producto_construccion` AS select `producto`.`id` AS `id`,`producto`.`nombre` AS `nombre`,`precio`.`monto` AS `precio_construccion`,`producto`.`porcentaje_comision` AS `porcentaje_comision`,`producto_contruccion`.`activo` AS `activo` from ((`producto_contruccion` left join `producto` on((`producto_contruccion`.`producto_id` = `producto`.`id`))) left join `precio` on((`producto`.`id` = `precio`.`producto_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_promotores`
--

/*!50001 DROP VIEW IF EXISTS `vista_promotores`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_promotores` AS select `a`.`id` AS `id`,concat(ltrim(rtrim(`pe`.`nombres`)),' ',ltrim(rtrim(`pe`.`apellido_paterno`)),' ',ltrim(rtrim(`pe`.`apellido_materno`))) AS `Promotor`,`a`.`email` AS `email` from ((`promotor` `p` left join `asesor` `a` on((`p`.`promotor_id` = `a`.`id`))) left join `persona` `pe` on((`a`.`persona_id` = `pe`.`id`))) where (`p`.`promotor_id` = `p`.`asesor_id`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_recubrimiento`
--

/*!50001 DROP VIEW IF EXISTS `vista_recubrimiento`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_recubrimiento` AS select `producto`.`id` AS `id`,`producto`.`nombre` AS `nombre`,`precio`.`monto` AS `precio_recubrimiento`,`producto`.`porcentaje_comision` AS `porcentaje_comision` from ((`recubrimiento` left join `producto` on((`recubrimiento`.`producto_id` = `producto`.`id`))) left join `precio` on((`producto`.`id` = `precio`.`producto_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_reposiciones`
--

/*!50001 DROP VIEW IF EXISTS `vista_reposiciones`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_reposiciones` AS select `reposicion`.`created_at` AS `created_at`,`inventario_recubrimientos`.`id` AS `inventario_recubrimientos_id`,`pieza_marmoleria`.`nombre` AS `pieza`,`vista_material_color`.`material_color` AS `material_color`,`lamina_alta`.`folio_lamina` AS `folio_lamina`,`reposicion`.`motivos` AS `motivos`,`usuario`.`nombre` AS `usuario`,`reposicion`.`precio_reposicion` AS `precio_reposicion`,`material_baja`.`costo_material_usado` AS `costo_material_usado`,`material_baja`.`area_venta` AS `area_venta` from ((((((`reposicion` left join `material_baja` on((`reposicion`.`material_baja_id` = `material_baja`.`id`))) left join `inventario_recubrimientos` on((`material_baja`.`inventario_recubrimientos_id` = `inventario_recubrimientos`.`id`))) left join `lamina_alta` on((`inventario_recubrimientos`.`lamina_alta_id` = `lamina_alta`.`id`))) left join `vista_material_color` on((`lamina_alta`.`material_color_id` = `vista_material_color`.`id`))) left join `pieza_marmoleria` on((`material_baja`.`pieza_marmoleria_id` = `pieza_marmoleria`.`id`))) left join `usuario` on((`reposicion`.`captura_usuario_id` = `usuario`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_salarios_activos`
--

/*!50001 DROP VIEW IF EXISTS `vista_salarios_activos`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_salarios_activos` AS select `salario`.`id` AS `id`,`salario`.`created_at` AS `created_at`,`salario`.`updated_at` AS `updated_at`,`salario`.`activo` AS `activo`,`salario`.`empleado_id` AS `empleado_id`,`salario`.`salario_diario` AS `salario_diario`,`salario`.`salario_semanal` AS `salario_semanal` from `salario` where (`salario`.`activo` = 1) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_servicio_funeral`
--

/*!50001 DROP VIEW IF EXISTS `vista_servicio_funeral`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_servicio_funeral` AS select `producto`.`id` AS `id`,`producto`.`nombre` AS `nombre`,`precio`.`monto` AS `precio_servicio`,`servicio_funeral`.`monto_comisionable` AS `monto_comisionable`,`producto`.`porcentaje_comision` AS `porcentaje_comision` from ((`servicio_funeral` left join `producto` on((`servicio_funeral`.`producto_id` = `producto`.`id`))) left join `precio` on((`producto`.`id` = `precio`.`producto_id`))) where (`precio`.`activo` = 1) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_stock`
--

/*!50001 DROP VIEW IF EXISTS `vista_stock`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_stock` AS select `stock`.`id` AS `id`,`inventario_recubrimientos`.`id` AS `inventario_recubrimientos_id`,`material_baja`.`id` AS `material_baja_id`,`lamina_alta`.`id` AS `lamina_alta_id`,concat('S-',`lamina_alta`.`folio_lamina`,`stock`.`id`) AS `folio`,`pieza_marmoleria`.`nombre` AS `pieza`,`vista_material_color`.`material_color` AS `material_color`,`lamina_alta`.`folio_lamina` AS `folio_lamina`,`material_baja`.`costo_material_usado` AS `costo_material_usado`,`stock`.`precio_venta` AS `precio_venta`,`stock`.`created_at` AS `created_at`,`pieza_marmoleria`.`area_requerida` AS `area_requerida`,`stock`.`activo` AS `stock_activo` from (((((`stock` left join `material_baja` on((`stock`.`material_baja_id` = `material_baja`.`id`))) left join `inventario_recubrimientos` on((`material_baja`.`inventario_recubrimientos_id` = `inventario_recubrimientos`.`id`))) left join `lamina_alta` on((`inventario_recubrimientos`.`lamina_alta_id` = `lamina_alta`.`id`))) left join `vista_material_color` on((`lamina_alta`.`material_color_id` = `vista_material_color`.`id`))) left join `pieza_marmoleria` on((`material_baja`.`pieza_marmoleria_id` = `pieza_marmoleria`.`id`))) where (`stock`.`activo` = 1) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_terrenos_disponibles`
--

/*!50001 DROP VIEW IF EXISTS `vista_terrenos_disponibles`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_terrenos_disponibles` AS select `producto`.`id` AS `producto_id`,`sector`.`id` AS `sector_id`,`recinto`.`id` AS `recinto_id`,`lote`.`id` AS `lote_id`,`nicho`.`id` AS `id`,`sector`.`nombre` AS `sector`,`recinto`.`nombre` AS `recinto`,'Nicho' AS `tipo`,`nicho`.`fila` AS `fila`,`nicho`.`columna` AS `columna`,`precio`.`monto` AS `monto`,`producto`.`porcentaje_comision` AS `porcentaje_comision` from (((((`nicho` left join `lote` on((`lote`.`id` = `nicho`.`lote_id`))) left join `producto` on((`producto`.`id` = `lote`.`producto_id`))) left join `recinto` on((`nicho`.`recinto_id` = `recinto`.`id`))) left join `sector` on((`recinto`.`sector_id` = `sector`.`id`))) left join `precio` on((`precio`.`producto_id` = `producto`.`id`))) where ((`lote`.`disponible` = 1) and (`precio`.`activo` = 1)) union select `producto`.`id` AS `producto_id`,`sector`.`id` AS `sector_id`,NULL AS `recinto_id`,`lote`.`id` AS `lote_id`,`terreno`.`id` AS `id`,`sector`.`nombre` AS `sector`,'' AS `recinto`,'Terreno' AS `tipo`,`terreno`.`fila` AS `fila`,`terreno`.`lote` AS `lote`,`precio`.`monto` AS `monto`,`producto`.`porcentaje_comision` AS `porcentaje_comision` from ((((`terreno` left join `lote` on((`lote`.`id` = `terreno`.`lote_id`))) left join `producto` on((`producto`.`id` = `lote`.`producto_id`))) left join `sector` on((`terreno`.`sector_id` = `sector`.`id`))) left join `precio` on((`precio`.`producto_id` = `producto`.`id`))) where ((`lote`.`disponible` = 1) and (`precio`.`activo` = 1)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_ventas_totales_lamina`
--

/*!50001 DROP VIEW IF EXISTS `vista_ventas_totales_lamina`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_ventas_totales_lamina` AS select `vista_detalle_venta_material`.`id` AS `id`,`vista_detalle_venta_material`.`folio` AS `folio`,`vista_detalle_venta_material`.`inventario_recubrimientos_id` AS `inventario_recubrimientos_id`,`vista_detalle_venta_material`.`venta_material_id` AS `venta_material_id`,`vista_detalle_venta_material`.`folio_lamina` AS `folio_lamina`,`vista_detalle_venta_material`.`pieza` AS `pieza`,`vista_detalle_venta_material`.`material_color` AS `material_color`,`vista_detalle_venta_material`.`precio_pieza` AS `precio_pieza`,`vista_detalle_venta_material`.`observaciones` AS `observaciones`,`vista_detalle_venta_material`.`pieza_completa` AS `pieza_completa`,`vista_detalle_venta_material`.`venta_abierta` AS `venta_abierta`,count(`vista_detalle_venta_material`.`pieza`) AS `piezas`,sum(`vista_detalle_venta_material`.`precio_pieza`) AS `total` from `vista_detalle_venta_material` group by `vista_detalle_venta_material`.`inventario_recubrimientos_id`,`vista_detalle_venta_material`.`pieza` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-03-08  9:51:29
