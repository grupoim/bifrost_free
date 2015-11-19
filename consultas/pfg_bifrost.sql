CREATE DATABASE  IF NOT EXISTS `pfg_bifrost` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `pfg_bifrost`;
-- MySQL dump 10.13  Distrib 5.6.23, for Win64 (x86_64)
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
  `comision_id` int(11) NOT NULL,
  `monto` double NOT NULL,
  `fecha` date NOT NULL,
  `cancelado` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`,`comision_id`),
  KEY `fk_pago_comision_comision1_idx` (`comision_id`),
  CONSTRAINT `fk_pago_comision_comision1` FOREIGN KEY (`comision_id`) REFERENCES `comision` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `abono_comision`
--

LOCK TABLES `abono_comision` WRITE;
/*!40000 ALTER TABLE `abono_comision` DISABLE KEYS */;
/*!40000 ALTER TABLE `abono_comision` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `accion`
--

LOCK TABLES `accion` WRITE;
/*!40000 ALTER TABLE `accion` DISABLE KEYS */;
/*!40000 ALTER TABLE `accion` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `almacen`
--

LOCK TABLES `almacen` WRITE;
/*!40000 ALTER TABLE `almacen` DISABLE KEYS */;
/*!40000 ALTER TABLE `almacen` ENABLE KEYS */;
UNLOCK TABLES;

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
  PRIMARY KEY (`id`,`persona_id`),
  KEY `fk_asesor_persona1_idx` (`persona_id`),
  CONSTRAINT `fk_asesor_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asesor`
--

LOCK TABLES `asesor` WRITE;
/*!40000 ALTER TABLE `asesor` DISABLE KEYS */;
INSERT INTO `asesor` VALUES (1,50,'2015-01-06',1),(2,13,NULL,1),(3,14,NULL,1),(4,15,NULL,1),(5,16,NULL,1),(6,17,NULL,1),(7,18,NULL,1),(8,19,NULL,1),(9,20,NULL,1),(10,21,NULL,1),(11,22,NULL,1),(12,23,NULL,1),(13,24,NULL,1),(14,25,NULL,1),(15,26,NULL,1),(16,27,NULL,1),(17,28,NULL,1),(18,29,NULL,1),(19,30,NULL,1),(20,31,NULL,1),(21,32,NULL,1),(22,33,NULL,1),(23,34,NULL,1),(24,35,NULL,1),(25,36,NULL,1),(26,37,NULL,1),(27,38,NULL,1),(28,39,NULL,1),(29,40,NULL,1),(30,41,NULL,1),(31,42,NULL,1),(32,43,NULL,1),(33,44,NULL,1),(34,45,NULL,1),(35,46,NULL,1),(36,47,NULL,1),(37,48,NULL,1),(38,49,NULL,1),(39,50,NULL,1),(40,51,NULL,1),(41,52,NULL,1),(42,53,NULL,1),(43,54,NULL,1),(44,55,NULL,1),(45,56,NULL,1),(46,57,NULL,1),(47,58,NULL,1),(48,59,NULL,1),(49,60,NULL,1),(50,61,NULL,1),(51,62,NULL,1),(52,63,NULL,1),(53,64,NULL,1),(54,65,NULL,1),(55,66,NULL,1),(56,67,NULL,1),(57,68,NULL,1),(58,69,NULL,1),(59,70,NULL,1),(60,71,NULL,1),(61,72,NULL,1),(62,73,NULL,1),(63,74,NULL,1),(64,75,NULL,1),(65,76,NULL,1),(66,77,NULL,1),(67,78,NULL,1),(68,79,NULL,1),(69,80,NULL,1),(70,81,NULL,1),(71,82,NULL,1),(72,83,NULL,1),(73,84,NULL,1),(74,85,NULL,1),(75,86,NULL,1),(76,87,NULL,1),(77,88,NULL,1),(78,89,NULL,1),(79,90,NULL,1),(80,91,NULL,1),(81,92,NULL,1),(82,93,NULL,1),(83,94,NULL,1),(84,95,NULL,1),(85,97,NULL,1),(86,98,NULL,1),(87,99,NULL,1),(88,100,NULL,1),(89,101,NULL,1),(90,102,NULL,1),(91,103,NULL,1),(92,104,NULL,1),(93,105,NULL,1),(94,106,NULL,1),(95,107,NULL,1),(96,108,NULL,1),(97,109,NULL,1),(98,110,NULL,1),(99,111,NULL,1),(100,112,NULL,1),(101,113,NULL,1),(102,114,NULL,1),(103,115,NULL,1),(104,116,NULL,1),(105,117,NULL,1),(106,118,NULL,1),(107,119,NULL,1),(108,120,NULL,1),(109,121,NULL,1),(110,122,NULL,1),(111,123,NULL,1),(112,124,NULL,1),(113,125,NULL,1),(114,126,NULL,1),(115,127,NULL,1),(116,128,NULL,1),(117,129,NULL,1),(118,130,NULL,1),(119,131,NULL,1),(120,132,NULL,1),(121,133,NULL,1),(122,134,NULL,1),(123,135,NULL,1),(124,1,NULL,1);
/*!40000 ALTER TABLE `asesor` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `beneficiario`
--

LOCK TABLES `beneficiario` WRITE;
/*!40000 ALTER TABLE `beneficiario` DISABLE KEYS */;
/*!40000 ALTER TABLE `beneficiario` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=310 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `capacidad`
--

LOCK TABLES `capacidad` WRITE;
/*!40000 ALTER TABLE `capacidad` DISABLE KEYS */;
INSERT INTO `capacidad` VALUES (1,1,1,5),(2,1,2,4),(3,2,1,4),(4,2,2,0),(5,3,1,5),(6,3,2,4),(7,4,1,3),(8,5,1,3),(9,6,1,4),(10,7,1,4),(11,8,1,4),(12,9,1,4),(13,10,1,4),(14,11,1,4),(15,12,1,4),(16,13,1,4),(17,14,1,4),(18,15,1,2),(19,16,1,2),(20,17,1,2),(21,18,1,4),(22,19,1,4),(23,20,1,2),(24,21,1,2),(25,22,1,2),(26,23,1,2),(27,24,1,2),(28,25,1,2),(29,26,1,2),(30,27,1,2),(31,28,1,2),(32,29,1,2),(33,30,1,2),(34,31,1,2),(35,32,1,2),(36,33,1,2),(37,34,1,2),(38,35,1,2),(39,36,1,2),(40,37,1,2),(41,38,1,2),(42,39,1,2),(43,40,1,2),(44,41,1,2),(45,42,1,2),(46,43,1,2),(47,44,1,2),(48,45,1,2),(49,46,1,2),(50,47,1,2),(51,48,1,2),(52,49,1,2),(53,50,1,2),(54,51,1,2),(55,52,1,2),(56,53,1,2),(57,54,1,2),(58,55,1,2),(59,56,1,2),(60,57,1,2),(61,58,1,2),(62,59,1,3),(63,60,1,2),(64,61,1,2),(65,62,1,2),(66,63,1,2),(67,64,1,3),(68,65,1,2),(69,66,1,2),(70,67,1,2),(71,68,1,2),(72,69,1,2),(73,70,1,2),(74,71,1,2),(75,72,1,2),(76,73,1,2),(77,74,1,2),(78,75,1,2),(79,76,1,4),(80,77,1,4),(81,78,1,3),(82,79,1,3),(83,80,1,3),(84,81,1,3),(85,82,1,3),(86,83,1,3),(87,84,1,3),(88,85,1,3),(89,86,1,3),(90,87,1,3),(91,88,1,3),(92,89,1,3),(93,90,1,3),(94,91,1,3),(95,92,1,3),(96,93,1,3),(97,94,1,3),(98,95,1,3),(99,96,1,3),(100,97,1,3),(101,98,1,3),(102,99,1,3),(103,100,1,3),(104,101,1,3),(105,102,1,3),(106,103,1,3),(107,104,1,3),(108,105,1,3),(109,106,1,3),(110,107,1,3),(111,108,1,3),(112,109,1,3),(113,110,1,15),(114,110,2,8),(115,111,1,5),(116,111,2,4),(117,112,1,10),(118,112,2,8),(119,113,1,5),(120,113,2,4),(121,114,1,4),(122,115,1,4),(123,116,1,4),(124,117,1,4),(125,118,1,4),(126,119,1,4),(127,120,1,4),(128,121,1,4),(129,122,1,4),(130,123,1,4),(131,124,1,4),(132,125,1,4),(133,126,1,4),(134,127,1,4),(135,128,1,4),(136,129,1,4),(137,130,1,4),(138,131,1,4),(139,132,1,4),(140,133,1,4),(141,134,1,4),(142,135,1,4),(143,136,1,4),(144,137,1,4),(145,138,1,4),(146,139,1,4),(147,140,1,4),(148,141,1,4),(149,142,1,3),(150,143,1,3),(151,144,1,3),(152,145,1,3),(153,146,1,3),(154,147,1,3),(155,148,1,3),(156,149,1,3),(157,150,1,3),(158,151,1,3),(159,152,1,3),(160,153,1,3),(161,154,1,3),(162,155,1,3),(163,156,1,4),(164,157,1,4),(165,158,1,4),(166,159,1,4),(227,160,1,15),(228,160,2,8),(229,161,1,4),(230,162,1,4),(231,163,1,4),(232,164,1,4),(233,165,1,4),(234,166,1,4),(235,167,1,4),(236,168,1,4),(237,169,1,4),(238,170,1,4),(239,171,1,4),(240,172,1,4),(241,173,1,4),(242,174,1,4),(243,175,1,4),(244,176,1,4),(245,177,1,4),(246,178,1,4),(247,179,1,4),(248,180,1,4),(249,181,1,4),(250,182,1,4),(251,183,1,4),(252,184,1,4),(253,185,1,4),(254,186,1,4),(255,187,1,4),(256,188,1,4),(257,189,1,4),(258,190,1,4),(259,191,1,4),(260,192,1,4),(261,193,1,4),(262,194,1,4),(263,195,1,4),(264,196,1,4),(265,197,1,4),(266,198,1,4),(267,199,1,4),(268,200,1,3),(269,201,1,3),(270,202,1,3),(271,203,1,5),(272,203,2,4),(273,204,1,4),(274,204,2,0),(275,205,1,2),(276,206,1,10),(277,206,2,8),(278,207,1,10),(279,207,2,8),(280,208,1,10),(281,208,2,8),(282,209,1,10),(283,209,2,8),(284,210,1,10),(285,210,2,8),(286,211,1,2),(287,212,1,8),(288,212,2,4),(289,213,1,2),(290,214,1,10),(291,214,2,8),(292,215,1,5),(293,216,1,5),(294,217,1,5),(295,218,1,4),(296,219,1,4),(297,220,1,4),(298,221,1,4),(299,222,1,4),(300,223,1,4),(301,224,1,4),(302,225,1,4),(303,226,1,4),(304,227,1,4),(305,228,1,4),(306,229,1,4),(307,230,1,4),(308,231,1,4),(309,232,1,4);
/*!40000 ALTER TABLE `capacidad` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `caracteristica`
--

LOCK TABLES `caracteristica` WRITE;
/*!40000 ALTER TABLE `caracteristica` DISABLE KEYS */;
/*!40000 ALTER TABLE `caracteristica` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `cesped`
--

LOCK TABLES `cesped` WRITE;
/*!40000 ALTER TABLE `cesped` DISABLE KEYS */;
/*!40000 ALTER TABLE `cesped` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,7,584,2,'2015-04-23','Entre Isabel La Catolica y Juana de Arco','Aguanaval','660','38',NULL,NULL,'elnazavalderrama@gmail.com','M'),(2,2,584,1,'1986-05-03','Entre Hilario Martinez y Espino','Maria Curie','115','',NULL,NULL,'cruz.felipe@parquefuneralguadalupe.com.mx','M'),(3,3,584,1,'1983-03-09','Entre Hilario Martinez y Espino','Maria Curie','115-B','',NULL,NULL,'dsanchez@grupoim.mx','M'),(4,9,3207,3,'1981-03-01','Mandar al mensajero ya muy tarde.','Venustiano Carranza','23','1B',NULL,NULL,'ventas@parquefuneralguadalupe.com.mx','F'),(5,164,1147,1,'2007-07-06','Derechito por la banqueta.','Benito Juárez','1','',NULL,NULL,'adrian_iracheta@gmail.com','M'),(6,5,585,2,'2015-04-07','','c','','',NULL,NULL,'','M'),(7,4,976,2,'1963-06-05','','Prisciliano Romero','345','',NULL,NULL,'recub@parquefuneralguadalupe.com.mx','M'),(8,1,455,1,'1987-06-03','','Juana de Arco','345','',NULL,NULL,'cobranza@parquefuneralguadalupe.com.mx','F');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `colonia`
--

LOCK TABLES `colonia` WRITE;
/*!40000 ALTER TABLE `colonia` DISABLE KEYS */;
INSERT INTO `colonia` VALUES (1,40,'La Finca','64000'),(2,40,'Monterrey Centro','64000'),(3,40,'Amway','64004'),(4,40,'Consulado General de los Estados Unidos de Norteamérica','64006'),(5,40,'Secretaria de Hacienda y Crédito Publico','64007'),(6,40,'Palacio de Gobierno Del Estado de Nuevo Leon','64009'),(7,40,'Obrera','64010'),(8,40,'Desarrollo Urbano Reforma','64018'),(9,40,'Nuevo Centro Monterrey','64018'),(10,40,'Condominios Constitución','64019'),(11,40,'Mitras Sur','64020'),(12,40,'Gonzalitos','64020'),(13,40,'Lomas','64030'),(14,40,'Chepevera','64030'),(15,40,'Deportivo Obispado','64040'),(16,40,'Maria Luisa','64040'),(17,40,'Unidad Aldama','64040'),(18,40,'Exseminario','64049'),(19,40,'Jardín','64050'),(20,40,'Jardines del Cerro','64050'),(21,40,'Obispado','64060'),(22,40,'El Mirador Centro','64070'),(23,40,'San Bernabe','64100'),(24,40,'Privadas de Lincoln','64100'),(25,40,'Barrio Antiguo Cd. Solidaridad','64100'),(26,40,'Barrio San Carlos 1 Sector','64100'),(27,40,'Mirasol Sector 3 (San Felipe)','64102'),(28,40,'Las Plazas','64102'),(29,40,'Urbi Villa del Cedro 1er. Sector','64102'),(30,40,'Urbi Villa del Rey 2do Sector','64102'),(31,40,'Mirasol','64102'),(32,40,'Barrio Aztlán','64102'),(33,40,'Barrio Santa Isabel','64102'),(34,40,'Barrio San Luis 1 Sector','64102'),(35,40,'Urbi Villa Bonita 1er. Sector 2da. Etapa','64102'),(36,40,'Barrio San Carlos 3 Sector','64102'),(37,40,'Barrio San Carlos 4 Sector','64102'),(38,40,'Urbi Villa del Cedro 2do Sector','64102'),(39,40,'Barrio San Pedro 2 Sector','64102'),(40,40,'Barrio Puerta del Sol','64102'),(41,40,'Arcos del Sol 1 Sector','64102'),(42,40,'Arcos del Sol 4 Sector','64102'),(43,40,'Barrio del Parque 1 Sector 1 Etapa','64102'),(44,40,'Barrio Estrella Norte y Sur','64102'),(45,40,'Arcos del Sol Elite','64102'),(46,40,'Barrio de La Industria','64102'),(47,40,'Barrio del Parque 2 Etapa','64102'),(48,40,'Barrio del Parque','64102'),(49,40,'Barrio Chapultepec Sur','64102'),(50,40,'Las Estaciones','64102'),(51,40,'Arcos del Sol 7 Sector','64102'),(52,40,'Barrio Alameda','64102'),(53,40,'Barrio San Pedro 1 Sector','64102'),(54,40,'Villas de San Bernabe','64102'),(55,40,'Arcos del Sol 2 Sector','64102'),(56,40,'Arcos del Sol 5 Sector','64102'),(57,40,'Barrio San Carlos 2 Sector','64102'),(58,40,'Barrio Mirasol II','64102'),(59,40,'Barrio Moderna','64102'),(60,40,'Barrio del Prado','64102'),(61,40,'Barrio Margaritas 1 Sector 1 Etapa','64102'),(62,40,'Arcos del Sol 3 Sector','64102'),(63,40,'Barrio San Luis 2 Sector','64102'),(64,40,'Barrio Topo Chico','64102'),(65,40,'Barrio Acero','64102'),(66,40,'Barrio Chapultepec Norte','64102'),(67,40,'Urbi Villa del Rey 1er. Sector','64102'),(68,40,'Estrella Sector Elite','64102'),(69,40,'Jardines del Rey','64102'),(70,40,'Barrio Margaritas 1 Sector 2 Etapa','64102'),(71,40,'La Alianza P-128','64103'),(72,40,'Las Fuentes (P-53, 54, 134)','64103'),(73,40,'San Rodolfo I (P- 89, 139)','64103'),(74,40,'Hermenegildo Galeana','64103'),(75,40,'Jose Maria Pino Suárez','64103'),(76,40,'Jerónimo Treviño (P-35)','64103'),(77,40,'Santa Ana (P- 63)','64103'),(78,40,'El Palmar (P-96, 141)','64103'),(79,40,'La Alianza Trazo Rosario (P- 90)','64103'),(80,40,'La Alianza Sector O (P-67)','64103'),(81,40,'La Alianza Sector R (P-8-9)','64103'),(82,40,'Los Angeles (P-49, 50, 133)','64103'),(83,40,'Ignacio Manuel Altamirano','64103'),(84,40,'Valle de la Esperanza','64103'),(85,40,'San Gabriel','64103'),(86,40,'Urbi Villa Colonial','64103'),(87,40,'La Alianza Sector B','64103'),(88,40,'La Alianza Sector I (P-58,68)','64103'),(89,40,'La Alianza Sector J (P-79,137,87)','64103'),(90,40,'La Alianza Sector K (P-43,51)','64103'),(91,40,'La Alianza Sector V (P-68)','64103'),(92,40,'Periodistas de México 1 Etapa','64103'),(93,40,'Balcones de San Bernabé','64103'),(94,40,'Villas del Carmen','64103'),(95,40,'Josefa Ortiz de Dominguez','64103'),(96,40,'Madero','64103'),(97,40,'Prof. Miguel Ramos Arizpe','64103'),(98,40,'Valles de San Bernabé III','64103'),(99,40,'Los Nogales I y II (P-98, 109)','64103'),(100,40,'Arboledas de San Bernabe','64103'),(101,40,'Ampliación Nogales (P-87)','64103'),(102,40,'La Alianza Trazo de A (P-28)','64103'),(103,40,'Villas de San Sebastián','64103'),(104,40,'San David I (P- 33)','64103'),(105,40,'Eugenio Garza Sada','64103'),(106,40,'Martín de Zavala (P-34)','64103'),(107,40,'San Antonio (P-37)','64103'),(108,40,'Las Torres','64103'),(109,40,'La Alianza Sector M (P-61)','64103'),(110,40,'La Alianza Sector Q (P-90)','64103'),(111,40,'Homero López Ortiz','64103'),(112,40,'Villas de San Agustín','64103'),(113,40,'Aniceto Corpus (P-60)','64103'),(114,40,'Diego de Montemayor','64103'),(115,40,'Fray Servando Teresa de Mier','64103'),(116,40,'La Alianza Trazo Marco (P- 52)','64103'),(117,40,'Valles de San Bernabé','64103'),(118,40,'San Pedro (P-72, 76, 736)','64103'),(119,40,'La Alianza Trazo Barrón (P- 93)','64103'),(120,40,'Jardines de La Alianza','64103'),(121,40,'La Alianza Sector L (P-107)','64103'),(122,40,'La Alianza Sector P (P-88)','64103'),(123,40,'La Alianza Sector S (P-28)','64103'),(124,40,'Prados San Bernabé','64103'),(125,40,'La Alianza Sector C','64103'),(126,40,'Ignacio Altamirano','64103'),(127,40,'Aniceto Corpus II','64103'),(128,40,'Cuauhtémoc','64103'),(129,40,'Jose Maria Morelos','64103'),(130,40,'La Alianza Trazo Mao (P- 46)','64103'),(131,40,'Los Nogales III (P-102)','64103'),(132,40,'Portales de Valles de San Bernabé','64103'),(133,40,'Ing J. M. Maldonado T. (P-11, 19, 22, 23)','64103'),(134,40,'La Alianza Sector F (P-142)','64103'),(135,40,'Paseo de San Bernabé','64103'),(136,40,'Villas de La Alianza','64103'),(137,40,'Comercial Lincoln Poniente','64103'),(138,40,'Rómulo Lozano Morales','64103'),(139,40,'Lorenzo Garza (P-1)','64103'),(140,40,'Alfonso Reyes (P-38)','64103'),(141,40,'Arboledas de Escobedo (P-44)','64103'),(142,40,'Cerradas del Poniente','64103'),(143,40,'La Alianza Sector D (P-94)','64103'),(144,40,'La Alianza Sector E (P-47,48)','64103'),(145,40,'La Alianza Sector H (P-140,192)','64103'),(146,40,'La Alianza Sector T (P-24)','64103'),(147,40,'Venustiano Carranza','64103'),(148,40,'Vicente Suárez','64103'),(149,40,'San Isidro (P-108)','64103'),(150,40,'La Alianza Sector N (P-71,74)','64103'),(151,40,'Misión San Bernabé','64103'),(152,40,'La Alianza Trazo Marcelino (P-130)','64103'),(153,40,'Mejía Barrón','64103'),(154,40,'Periodistas','64103'),(155,40,'Unión Antorchista','64103'),(156,40,'San Bernabé II (F-120)','64104'),(157,40,'San Bernabé III','64104'),(158,40,'San Bernabé IV (F-124)','64104'),(159,40,'Ampliación Villa Bonita','64105'),(160,40,'San Bernabé XII (F-115)','64105'),(161,40,'San Bernabé IX  (F-112)','64105'),(162,40,'Villa Bonita 1 Sector','64105'),(163,40,'Fomerrey 114','64105'),(164,40,'San Bernabé X (F-113)','64105'),(165,40,'San Bernabé XIV (F-109)','64106'),(166,40,'San Bernabé XV (F-119)','64106'),(167,40,'Fomerrey 110','64106'),(168,40,'San Bernabé XIII (F-116)','64106'),(169,40,'Colina de San Bernabé (F-25)','64107'),(170,40,'Plutarco Elias Calles 1 - 2','64108'),(171,40,'San Bernabé (F-105)','64109'),(172,40,'3 de Febrero','64109'),(173,40,'San Bernabé (F-51)','64109'),(174,40,'Misión Lincoln 2 Sector','64110'),(175,40,'Misión Lincoln 3 Sector','64110'),(176,40,'Misión Lincoln 1 Sector','64110'),(177,40,'Madre Selva','64110'),(178,40,'Lomas de Cumbres 1 Sector','64116'),(179,40,'Cumbre Alta','64116'),(180,40,'Villa Cumbres 1 Sector','64116'),(181,40,'Villa de Cumbres 2 Sector','64116'),(182,40,'Lomas de Cumbres 2 Sector','64116'),(183,40,'Balcones de Las Mitras 2 Sector','64117'),(184,40,'Lomas de Villa Alegre','64117'),(185,40,'Balcones de las Mitras','64117'),(186,40,'Colinas de Valle Verde','64117'),(187,40,'Valle Verde 2 Sector','64117'),(188,40,'Balcones de Las Mitras 1 S. 1 Etapa','64117'),(189,40,'Colinas de Valle Verde 3 Sector','64117'),(190,40,'Paseo de las Mitras','64118'),(191,40,'Fidel Velázquez (S. N. A. T.)','64119'),(192,40,'Loma Linda','64120'),(193,40,'Villa Alegre','64130'),(194,40,'Valle de Santa Lucia (Granja Sanitaria)','64140'),(195,40,'Unidad Modelo','64140'),(196,40,'Lomas Modelo 2 Sector','64140'),(197,40,'Lomas Modelo','64140'),(198,40,'Paso del Águila','64145'),(199,40,'Genaro Rojas Vázquez','64148'),(200,40,'Álvaro Obregón','64150'),(201,40,'Villa Santa Cecilia','64150'),(202,40,'Santa Cecilia','64150'),(203,40,'Rincón Santa Cecilia','64157'),(204,40,'Valle Santa Cecilia','64157'),(205,40,'Lomas de Santa Cecilia','64158'),(206,40,'Mitra Dorada','64159'),(207,40,'Lomas Modelo Norte','64159'),(208,40,'Cerritos Modelo (F-76)','64159'),(209,40,'Nueva Modelo (F-8)','64160'),(210,40,'Jardín Modelo','64160'),(211,40,'16 de Septiembre','64160'),(212,40,'Nueva Galicia','64160'),(213,40,'15 de Marzo','64160'),(214,40,'Santa Cruz (F- 10)','64160'),(215,40,'Esperanza o Peña Elizondo','64160'),(216,40,'Residencial Raúl Rangel Frías','64165'),(217,40,'Casa Sol','64165'),(218,40,'Unión de Fierreros','64165'),(219,40,'Aztlán','64166'),(220,40,'Lomas de La Unidad Modelo','64167'),(221,40,'Abelardo Zapata','64168'),(222,40,'Condocasa Mitras','64170'),(223,40,'Felipe Angeles','64170'),(224,40,'San Francisco de Asís','64170'),(225,40,'Villa Mitras','64170'),(226,40,'Bortoní','64178'),(227,40,'Del Maestro','64180'),(228,40,'Torres Pravia','64180'),(229,40,'Nueva Morelos','64180'),(230,40,'Morelos','64180'),(231,40,'Privada Cumbres','64180'),(232,40,'Valle Morelos','64180'),(233,40,'5 de Mayo','64186'),(234,40,'Central','64190'),(235,40,'C. R. O. C.','64200'),(236,40,'CROC Infonavit','64200'),(237,40,'Valle de San Martín (F-24)','64204'),(238,40,'Lomas de Topo Chico','64205'),(239,40,'El Porvenir','64206'),(240,40,'Laderas del Topo Chico (F-23)','64206'),(241,40,'Conquistadores','64208'),(242,40,'Tierra Propia (F-35)','64209'),(243,40,'7 de Noviembre (F-82)','64210'),(244,40,'San Martín','64210'),(245,40,'Dif (F-15)','64210'),(246,40,'Fomerrey 1','64210'),(247,40,'Fomerrey 10','64210'),(248,40,'Articulo 27 (F-96)','64210'),(249,40,'Libertadores de América','64215'),(250,40,'René Álvarez','64215'),(251,40,'Balcones de Aztlán','64215'),(252,40,'23 de Marzo','64215'),(253,40,'San Bernabé VIII (F-125)','64217'),(254,40,'Pepenadores (F-87)','64217'),(255,40,'PROVILEON San Bernabé','64217'),(256,40,'Popular','64217'),(257,40,'Municipal Ampliación','64218'),(258,40,'Benito Juárez (Tiraderos de Basura)','64218'),(259,40,'Felipe Zambrano','64219'),(260,40,'Gloria Mendiola (Tierra Propia)','64219'),(261,40,'Lomas de San Martín','64220'),(262,40,'1 de Mayo (F-97)','64220'),(263,40,'5 de Mayo (F-93)','64225'),(264,40,'La Amistad','64226'),(265,40,'Villa San Ángel Topo Chico','64227'),(266,40,'Francisco Villa','64228'),(267,40,'19 de Abril','64229'),(268,40,'Oscar Herrera Hosking','64229'),(269,40,'San Ángel (F-78)','64230'),(270,40,'Fray Servando Teresa de Mier (F-6)','64233'),(271,40,'18 de Febrero','64234'),(272,40,'Las Pedreras (F-106)','64235'),(273,40,'Unidad Del Pueblo','64235'),(274,40,'Las Pedreras Ampliación (F-116)','64235'),(275,40,'Tierra y Libertad Sector Heroico','64236'),(276,40,'La Esperanza (Tierra Propia)','64237'),(277,40,'Fomerrey Sector Poniente','64237'),(278,40,'Predio Zapata','64238'),(279,40,'Los Dorados','64240'),(280,40,'Moctezuma','64240'),(281,40,'Francisco González Bocanegra','64240'),(282,40,'Rafael Buelna','64240'),(283,40,'Martires de San Cosme','64240'),(284,40,'21 de Marzo 2 Sector','64240'),(285,40,'Tierra y Libertad Sector Sur','64244'),(286,40,'Cnop','64245'),(287,40,'Tierra y Libertad Sector Centro','64246'),(288,40,'Plan de San Luis','64247'),(289,40,'Madero','64248'),(290,40,'Tierra y Libertad Sector Norte','64249'),(291,40,'Unidad Reforma Urbana','64249'),(292,40,'Pablo González','64250'),(293,40,'Josefa Ortiz de Dominguez','64250'),(294,40,'Loma Bonita','64250'),(295,40,'Ferrocarrilera','64250'),(296,40,'Valle del Topo Chico 6 Sector','64250'),(297,40,'Residencial Aztlán','64250'),(298,40,'Unión Benito Garza Cantú','64250'),(299,40,'Flores Magón 3 Sector','64250'),(300,40,'Loma Bonita 2 Sector','64250'),(301,40,'Carmen Serdan','64258'),(302,40,'Valle del Topo Chico','64259'),(303,40,'Constituyentes del 57','64260'),(304,40,'Luis Echeverría (F-75)','64260'),(305,40,'Hogares Ferrocarrileros Infonavit','64260'),(306,40,'Kennedy','64260'),(307,40,'Lomas de Anáhuac','64260'),(308,40,'Nogales Topo Chico','64260'),(309,40,'Monterrey Conjunto Habitacional','64260'),(310,40,'Héroe de Nacozari','64260'),(311,40,'Hogares Ferrocarrileros','64260'),(312,40,'Topo Chico','64260'),(313,40,'La Meseta','64264'),(314,40,'Avila Camacho','64265'),(315,40,'Unión Benito Juárez','64265'),(316,40,'Cándido Díaz','64265'),(317,40,'Belisario Domínguez','64266'),(318,40,'Nueva Topo Chico','64266'),(319,40,'Unión Cuauhtémoc','64268'),(320,40,'División del Norte','64268'),(321,40,'4 de Diciembre','64268'),(322,40,'Primero de Junio','64268'),(323,40,'10 de Junio','64268'),(324,40,'Lázaro Cárdenas','64269'),(325,40,'Santa Fe Nor Poniente','64270'),(326,40,'Simón Bolívar','64270'),(327,40,'Plaza Insurgentes','64270'),(328,40,'San José','64270'),(329,40,'Narciso Mendoza','64280'),(330,40,'Bernardo Reyes','64280'),(331,40,'Niño Artillero','64280'),(332,40,'Pueblo Quieto','64280'),(333,40,'Hidalgo','64290'),(334,40,'Popular','64290'),(335,40,'Regina','64290'),(336,40,'Predio Estrella','64299'),(337,40,'AKRA','64299'),(338,40,'Industrial','64299'),(339,40,'Jardín de las Mitras','64300'),(340,40,'Valle de las Mitras','64300'),(341,40,'Torres Lincoln','64310'),(342,40,'Premier Lincoln','64310'),(343,40,'Residencial Abraham Lincoln','64310'),(344,40,'Industrial Abraham Lincoln','64310'),(345,40,'Mitras Norte','64320'),(346,40,'Francisco García Naranjo (INDECO)','64330'),(347,40,'Francisco García Naranjo (PROVILEON)','64330'),(348,40,'San Jorge','64330'),(349,40,'Valle Verde 3er Sector','64339'),(350,40,'Valle Verde 4to Sector','64339'),(351,40,'Cumbres Platino','64340'),(352,40,'Cumbres Elite Sector Villas','64340'),(353,40,'Privadas de Cumbres','64340'),(354,40,'Hacienda Mitras 4 Sector','64340'),(355,40,'Hacienda Mitras 1 Etapa','64340'),(356,40,'Cumbres Elite Sector La Hacienda','64340'),(357,40,'Cumbres Le Fontaine','64340'),(358,40,'Hacienda Mitras 2 Etapa','64340'),(359,40,'Hacienda Mitras','64340'),(360,40,'Pedregal Cumbres 3-4  Sector','64344'),(361,40,'Pedregal Cumbres 1 Sector','64344'),(362,40,'Pedregal Cumbres 2 Sector','64344'),(363,40,'Cumbre Allegro','64345'),(364,40,'Cumbres Renacimiento','64346'),(365,40,'Cumbres Rodeo','64346'),(366,40,'Privada Cumbres Diamante','64346'),(367,40,'Cumbres del Sol Etapa 2','64346'),(368,40,'Cumbres Providencia','64346'),(369,40,'Cumbres San Ángel','64346'),(370,40,'Hacienda Santa Clara','64346'),(371,40,'Cumbres San Agustín','64346'),(372,40,'Mirador de Las Mitras 4 Sector 1 Etapa','64346'),(373,40,'Mirador de Las Mitras 3 Sector','64346'),(374,40,'Real de Cumbres','64346'),(375,40,'Paseo de Cumbres','64346'),(376,40,'Mirador de Las Mitras 2 Sector','64346'),(377,40,'Cima del Bosque','64346'),(378,40,'Portal de San Antonio 1 Sector 1 Etapa','64347'),(379,40,'Valle de las Cumbres','64347'),(380,40,'Cumbres Oro Residencial','64347'),(381,40,'Misión Cumbres 2 Sector','64347'),(382,40,'Portal de Cumbres 1 Sector 3a Etapa','64347'),(383,40,'Valle de Las Cumbres 2 Sector','64347'),(384,40,'Cumbres Oro Sector Regency','64347'),(385,40,'Portal de Cumbres 2 Sector 1 Etapa','64347'),(386,40,'Jardines de las Cumbres','64347'),(387,40,'Portal de Cumbres 2 Sector 2 Etapa','64347'),(388,40,'Cumbres Quinta Real','64347'),(389,40,'Mirador de Las Mitras 4 Sector 2 Etapa','64347'),(390,40,'Portal de Cumbres 3 Sector','64347'),(391,40,'Mirador de las Mitras','64348'),(392,40,'Portal de Cumbres','64348'),(393,40,'Misión de las Cumbres','64348'),(394,40,'Cumbres Elite','64349'),(395,40,'Puerta de Hierro','64349'),(396,40,'Privadas Cumbres Elite','64349'),(397,40,'Cerradas de Cumbres','64349'),(398,40,'Los Almendros','64349'),(399,40,'Cumbres Madeira','64349'),(400,40,'Cumbres las Palmas','64349'),(401,40,'Cumbres Santa Clara','64349'),(402,40,'Colonial Cumbres','64349'),(403,40,'Cumbres Callejuelas 1 Sector','64349'),(404,40,'Valle de INFONAVIT VI Sector','64350'),(405,40,'Valle del INFONAVIT San Bernabé 1-B','64350'),(406,40,'Valle de INFONAVIT I Sector','64350'),(407,40,'Valle de INFONAVIT IV Sector','64350'),(408,40,'Valle de INFONAVIT V Sector','64350'),(409,40,'Valle de INFONAVIT III Sector','64350'),(410,40,'Valle de INFONAVIT II Sector','64350'),(411,40,'Valle Verde 1 Sector','64360'),(412,40,'Villa Dorada','64360'),(413,40,'Cumbres Campanario','64360'),(414,40,'Patronato Cruz Verde','64365'),(415,40,'Condocasas Cumbres','64366'),(416,40,'Cima de las Cumbres','64366'),(417,40,'Cumbrescondido','64366'),(418,40,'Villa Dorada (Manzana 18-24)','64366'),(419,40,'Cumbres Sector La Esperanza','64367'),(420,40,'La Esperanza','64367'),(421,40,'La Escondida Centro Urbano','64367'),(422,40,'Rincón de las Cumbres','64368'),(423,40,'Valle de los Cedros','64369'),(424,40,'Los Cedros','64370'),(425,40,'Los Altos','64370'),(426,40,'Burócratas Federales','64380'),(427,40,'Adolfo Lopez Mateos','64380'),(428,40,'Burócratas del Estado','64380'),(429,40,'Zapata','64390'),(430,40,'Antonio I. Villarreal','64390'),(431,40,'UH.Lázaro Cárdenas','64390'),(432,40,'Estrella','64400'),(433,40,'Del Prado','64410'),(434,40,'Bella Vista','64410'),(435,40,'Pedro Lozano','64420'),(436,40,'Juárez','64420'),(437,40,'Progreso','64420'),(438,40,'Garza Nieto','64420'),(439,40,'Heriberto Jara','64429'),(440,40,'Urdiales','64430'),(441,40,'Ferrocarrilero (Predio 21)','64440'),(442,40,'Industrial','64440'),(443,40,'Cervecería Cuauhtémoc Sa','64442'),(444,40,'15 de Mayo (Larralde)','64450'),(445,40,'Tijerina','64460'),(446,40,'Mitras Centro','64460'),(447,40,'Obrerista','64470'),(448,40,'Talleres','64480'),(449,40,'10 de Marzo','64488'),(450,40,'Rubén Jaramillo','64489'),(451,40,'Sarabia','64490'),(452,40,'Del Norte','64500'),(453,40,'Residencial Vidriera','64508'),(454,40,'Unión Mariano Escobedo','64510'),(455,40,'Mariano Escobedo','64510'),(456,40,'Juana de Arco','64510'),(457,40,'Coyoacán','64510'),(458,40,'Industrial Benito Juárez','64517'),(459,40,'Centrika 2 Sector','64520'),(460,40,'Centrika Victoria','64520'),(461,40,'Centrika del Lago','64520'),(462,40,'Cementos','64520'),(463,40,'Vidriera','64520'),(464,40,'Centrika 1 Sector 1a. Etapa','64520'),(465,40,'Victoria','64520'),(466,40,'Centrika Crisoles','64520'),(467,40,'Las Flores','64530'),(468,40,'Moderna','64530'),(469,40,'Madero Norte','64530'),(470,40,'Jardines de la Moderna','64536'),(471,40,'Parque Industrial Regiomontano','64540'),(472,40,'Villas de Linda Vista','64540'),(473,40,'Fontanares Churubusco Sur','64540'),(474,40,'Los Fresnos','64540'),(475,40,'Santa Fe','64540'),(476,40,'Del Vidrio','64540'),(477,40,'Argentina (Unión F. Balero Sánchez)','64550'),(478,40,'MartÍnez','64550'),(479,40,'Reforma','64550'),(480,40,'Privada Pinos','64550'),(481,40,'Privada Pinos 1 Sector','64550'),(482,40,'Privada Pinos 3er Sector','64550'),(483,40,'Fabriles','64550'),(484,40,'Asarco','64550'),(485,40,'Cantú','64550'),(486,40,'Tampico','64550'),(487,40,'Argentina','64550'),(488,40,'U.C. Martínez','64550'),(489,40,'Jardines de Churubusco','64550'),(490,40,'Francisco I Madero','64560'),(491,40,'Nueva Madero','64560'),(492,40,'Venustiano Carranza','64560'),(493,40,'Almaguer','64568'),(494,40,'Treviño','64570'),(495,40,'Vidriera Monterrey Sa','64571'),(496,40,'Modelo','64580'),(497,40,'Pablo A. de la Garza','64580'),(498,40,'Terminal','64580'),(499,40,'Acero','64580'),(500,40,'Agrícola','64590'),(501,40,'Álamos Corregidora','64590'),(502,40,'Agrícola Acero','64590'),(503,40,'Churubusco','64590'),(504,40,'Fierro','64590'),(505,40,'Leones','64600'),(506,40,'Urdiales (F-58)','64600'),(507,40,'Las Cumbres 1 Sector','64610'),(508,40,'Las Cumbres 3 Sector','64610'),(509,40,'Las Cumbres 2 Sector','64610'),(510,40,'Llave de Oro','64618'),(511,40,'Cumbres Mediterráneo','64619'),(512,40,'Bosques de las Cumbres','64619'),(513,40,'Las Cumbres','64619'),(514,40,'Las Cumbres 71 HAS','64619'),(515,40,'Residencial Cumbres','64619'),(516,40,'Cumbres Paraíso','64619'),(517,40,'Colinas de las Cumbres','64619'),(518,40,'Vista Hermosa','64620'),(519,40,'Balcones de Galerias','64623'),(520,40,'Colinas de San Jerónimo','64630'),(521,40,'San Jemo 1 Sector','64630'),(522,40,'Jardines de San Jerónimo 1 Sector','64632'),(523,40,'Jardines de San Jerónimo 2 Sector','64632'),(524,40,'San Jemo Sector Tesoro','64633'),(525,40,'Rincón de las Colinas','64633'),(526,40,'Colinas de San Jerónimo 11 Sector','64633'),(527,40,'Colinas de San Jerónimo 4 Sector','64633'),(528,40,'Colinas de San Jerónimo 1 Sector','64633'),(529,40,'San Jemo 2 Sector','64633'),(530,40,'San Jemo Sector Cumbres','64633'),(531,40,'Villas de San Jerónimo','64634'),(532,40,'Colinas de Liverpool','64634'),(533,40,'Colinas de San Jerónimo 2 Sector 1 Etapa','64634'),(534,40,'Valle de San Jerónimo 2 Sector','64634'),(535,40,'Valle de San Jerónimo','64634'),(536,40,'Colonial San Francisco','64634'),(537,40,'Prados de San Jerónimo','64634'),(538,40,'Colinas de San Jerónimo','64634'),(539,40,'Real de San Jerónimo','64634'),(540,40,'Colinas de San Jerónimo 7 Sector','64634'),(541,40,'Colonial San Jerónimo 2 Sector 1 Etapa','64634'),(542,40,'La Vereda Privada Residencial','64634'),(543,40,'Lomas de San Jerónimo','64634'),(544,40,'Colonial San Jerónimo 1 Sector','64634'),(545,40,'Residencial San Jerónimo II','64635'),(546,40,'Colinas Diamante','64635'),(547,40,'Colinas de San Jerónimo 9 Sector','64636'),(548,40,'Colinas de San Jerónimo 10 Sector','64636'),(549,40,'Colinas de San Jerónimo Sector Lomas','64636'),(550,40,'Misión de San Jerónimo','64636'),(551,40,'Rincón de San Jemo','64637'),(552,40,'Hacienda San Jerónimo','64637'),(553,40,'Colinas de San Jerónimo Sector Panorama 2 Sector','64637'),(554,40,'San Jemo 4 Sector Ampliación','64637'),(555,40,'Villas de San Jerónimo','64637'),(556,40,'Rincón de San Jerónimo','64637'),(557,40,'Colinas de San Jerónimo 3 Sector','64637'),(558,40,'Riveras de San Jerónimo','64637'),(559,40,'San Jemo 4 Sector Panorama','64637'),(560,40,'Colinas de San Jerónimo 2 Sector','64637'),(561,40,'Colinas de San Gerardo','64638'),(562,40,'Balcones de Colinas de San Jerónimo','64638'),(563,40,'Las Lajas','64638'),(564,40,'Residencial Dinastía','64639'),(565,40,'Colinas de San Jerónimo 6 Sector','64639'),(566,40,'Residencial las Colinas','64639'),(567,40,'Colinas de San Jerónimo 5 Sector','64639'),(568,40,'Colinas de San Jerónimo 8 Sector','64639'),(569,40,'San Jemo 3 Sector','64639'),(570,40,'San Jerónimo','64640'),(571,40,'Residencial Galerías','64649'),(572,40,'Colinas del Valle 1 Sector','64650'),(573,40,'La Escondida','64650'),(574,40,'Rincón de Santa María','64650'),(575,40,'Colinas del Valle 2 Sector','64650'),(576,40,'Cooperativa Cuauhtémoc','64650'),(577,40,'Santa María','64650'),(578,40,'Cumbres del Valle','64650'),(579,40,'Sendero San Jerónimo','64659'),(580,40,'Rincón del Valle','64660'),(581,40,'Miravalle','64660'),(582,40,'Roma Sur','64700'),(583,40,'Nuevo Repueblo','64700'),(584,40,'Roma','64700'),(585,40,'Tecnológico','64700'),(586,40,'Balcones del Carmen','64710'),(587,40,'Nuevas Colonias','64710'),(588,40,'Unión Francisco I Madero','64710'),(589,40,'Comercial Ampliación Doctores','64710'),(590,40,'Loma Larga','64710'),(591,40,'Del Carmen','64710'),(592,40,'Los Doctores','64710'),(593,40,'Lomas de San Francisco','64710'),(594,40,'Pío X','64710'),(595,40,'Hacienda San Francisco','64710'),(596,40,'El Maguey','64710'),(597,40,'Los Magueyes','64715'),(598,40,'Loma Larga','64715'),(599,40,'Sertoma','64718'),(600,40,'Unión Miguel Barrera','64720'),(601,40,'Centro','64720'),(602,40,'Independencia','64720'),(603,40,'Benito Juárez (F-96)','64720'),(604,40,'Ancira','64720'),(605,40,'Unión de Colonos A Reyes','64720'),(606,40,'Unión Francisco Zarco','64723'),(607,40,'Predio Francisco Zarco','64723'),(608,40,'Unión Luis Echeverría','64723'),(609,40,'Unión J. Carlos Camacho','64723'),(610,40,'Unión Loma Larga','64723'),(611,40,'Arturo B. de la Garza','64730'),(612,40,'América No 2','64730'),(613,40,'Tanque de Guadalupe','64730'),(614,40,'Alfonso Reyes','64730'),(615,40,'La Pedrera','64730'),(616,40,'Roma Privada','64740'),(617,40,'Las Retamas','64740'),(618,40,'Jardines Roma','64740'),(619,40,'Arroyo Seco','64740'),(620,40,'México','64740'),(621,40,'Altavista Sur','64740'),(622,40,'Altamira','64750'),(623,40,'Altamira (Manz 20)','64750'),(624,40,'Las Canteras','64750'),(625,40,'Luis Echeverría Sur','64750'),(626,40,'La Boquilla','64750'),(627,40,'Haciendas de La Sierra','64750'),(628,40,'Valle del Mirador','64750'),(629,40,'Privanzas 5 Sector','64753'),(630,40,'Los Angeles','64753'),(631,40,'Las Privanzas 6 Sector','64753'),(632,40,'Alfareros','64753'),(633,40,'Jardín de las Torres','64754'),(634,40,'Jardín de Las Torres 2 Sector','64754'),(635,40,'Jardín de Las Torres 1er Sector','64754'),(636,40,'Burócratas Municipales 4 Sector','64760'),(637,40,'Ruíz Cortines','64760'),(638,40,'Cerro de la Campana','64760'),(639,40,'15 de Septiembre','64760'),(640,40,'Martínez Domínguez A. Unión ( La Campana )','64760'),(641,40,'Desarrollo Las Torres 91','64760'),(642,40,'Unión El Rinconcito','64760'),(643,40,'Los Rosales','64764'),(644,40,'Valparaíso','64764'),(645,40,'Laderas del Mirador (F-XXI)','64765'),(646,40,'Antigua','64765'),(647,40,'De las Flores','64765'),(648,40,'Burócratas Municipales 1 Sector','64769'),(649,40,'Altavista Lomas','64770'),(650,40,'Altavista Invernadero','64770'),(651,40,'Villa los Pinos','64770'),(652,40,'Alta Vista Sur Sector Lomas','64770'),(653,40,'Balcones de Altavista 2 Sector','64770'),(654,40,'Balcones de Altavista','64770'),(655,40,'Las Brisas','64780'),(656,40,'Mártires de Tlatelolco','64780'),(657,40,'18 de Marzo','64780'),(658,40,'Brisas La Punta','64780'),(659,40,'Mas Palomas (Valle de Santiago)','64780'),(660,40,'13 de Junio','64780'),(661,40,'Sierra Ventana','64780'),(662,40,'Brisas Diamante','64780'),(663,40,'25 de Marzo (Sierra Ventana)','64783'),(664,40,'Sierra Ventana (Revolución Proletaria)','64788'),(665,40,'Valle de las Brisas','64790'),(666,40,'Balcones del Mirador','64790'),(667,40,'Valle del Marquez','64790'),(668,40,'Torres Brisas','64790'),(669,40,'Paseos del Marquez','64798'),(670,40,'Buenos Aires','64800'),(671,40,'Buenos Aires','64800'),(672,40,'Cerro de la Silla','64810'),(673,40,'España','64810'),(674,40,'Caracol','64810'),(675,40,'Residencial La Florida','64810'),(676,40,'La Florida','64810'),(677,40,'Plaza Revolución','64810'),(678,40,'Villa Florida','64810'),(679,40,'Ex Hacienda el Ancón','64820'),(680,40,'Valle del Huajuco','64820'),(681,40,'Ancón del Huajuco','64820'),(682,40,'Nueva Española','64820'),(683,40,'Jardín Español','64820'),(684,40,'Residencial La Española','64820'),(685,40,'El Realito','64820'),(686,40,'Plaza Chapultepec','64820'),(687,40,'L. T. H','64830'),(688,40,'Estadio 2 Sector','64830'),(689,40,'La Primavera 3 Sector','64830'),(690,40,'Narvarte','64830'),(691,40,'Ladrillera','64830'),(692,40,'La Primavera 1 Sector','64830'),(693,40,'La Primavera 2o Sect','64830'),(694,40,'Estadio','64830'),(695,40,'Valle Primavera','64833'),(696,40,'Rincón de La Primavera 3 Sector','64834'),(697,40,'Rincón de la Primavera 1 Sector','64834'),(698,40,'Rincón de La Primavera 2 Sector','64834'),(699,40,'Industrial Comercial','64836'),(700,40,'Nueva España','64840'),(701,40,'Altavista','64840'),(702,40,'Rincón de Altavista','64844'),(703,40,'Jardines de Altavista Norte','64844'),(704,40,'Contry Lux','64845'),(705,40,'Jardines de Altavista','64846'),(706,40,'Instituto Tecnológico de Estudios Superiores de Monterrey','64849'),(707,40,'Torremolinos','64850'),(708,40,'Villa del Río','64850'),(709,40,'Contry Tesoro','64850'),(710,40,'Balcones de Satélite','64858'),(711,40,'Privadas del Río','64858'),(712,40,'Contry los Naranjos','64858'),(713,40,'Contry San Juanito','64859'),(714,40,'Pirul','64860'),(715,40,'Colonial La Silla','64860'),(716,40,'Rincón del Contry','64860'),(717,40,'Contry los Estanques','64860'),(718,40,'Villas de Lux','64860'),(719,40,'Jardines del Contry','64860'),(720,40,'Paseo del Contry','64860'),(721,40,'Contry','64860'),(722,40,'Contry Los Nogales','64865'),(723,40,'Los Remates','64878'),(724,40,'San Ángel','64878'),(725,40,'Unión Canoas Ángel Sur','64878'),(726,40,'La Condesa','64880'),(727,40,'Privadas del Sur','64890'),(728,40,'Residencial y Club de Golf la Herradura Etapa B','64890'),(729,40,'Cortijo del Río 3 Sector','64890'),(730,40,'Cortijo del Río 1 Sector','64890'),(731,40,'Lagos del Bosque','64890'),(732,40,'Residencial la Hacienda','64890'),(733,40,'Villa Las Fuentes 1 Sector','64890'),(734,40,'Villa Las Fuentes','64890'),(735,40,'Privadas de la Silla','64890'),(736,40,'Cortijo del Río 4 Sector','64890'),(737,40,'Residencial y Club de Golf La Herradura Etapa A','64890'),(738,40,'Villa Las Fuentes 5 Sector 2 Etapa','64893'),(739,40,'Villa Las Fuentes 4-5 Sector','64893'),(740,40,'Villa Las Fuentes 4 Sector','64893'),(741,40,'Villa Las Fuentes 5 Sector 1 Etapa','64893'),(742,40,'Privadas del Pedregal','64893'),(743,40,'Villa Las Fuentes 5 Sector 3 Etapa','64893'),(744,40,'Villa de las Fuentes 7 Sector','64893'),(745,40,'Palmares Residencial','64897'),(746,40,'Villas de La Hacienda','64898'),(747,40,'Residencial Vistalta','64898'),(748,40,'Santa Sofia','64898'),(749,40,'Pedregal de la Silla','64898'),(750,40,'Prados de la Silla 1 Sector','64898'),(751,40,'Cortijo del Río Sector La Silla','64899'),(752,40,'Jardines del Paseo 3 Sector','64900'),(753,40,'Jardines del Paseo 1 Sector','64900'),(754,40,'Del Paseo Residencia 5 B','64900'),(755,40,'Jardines del Paseo 2 Sector','64900'),(756,40,'Del Paseo Residencial 5 A','64900'),(757,40,'Del Paseo Residencial 5 Sector','64900'),(758,40,'Rincón del Paseo 2 Sector','64900'),(759,40,'La República','64900'),(760,40,'Del Paseo Residencial 6 Sector','64909'),(761,40,'Empleados SFEO','64909'),(762,40,'Lomas de Montecristo','64909'),(763,40,'Del Paseo Residencial 7 Sector','64909'),(764,40,'Mirador','64910'),(765,40,'Del Paseo Residencial','64920'),(766,40,'Las Torres 2 Sector','64920'),(767,40,'Del Paseo Residencial 3 Sector','64920'),(768,40,'Del Paseo Residencial 2 Sector','64920'),(769,40,'Del Paseo Residencial 4 Sector','64920'),(770,40,'Lomas del Paseo 2 Sector','64925'),(771,40,'Privadas del Paseo','64925'),(772,40,'Lomas del Paseo 3 Sector A','64925'),(773,40,'Lomas del Paseo 1 Sector','64925'),(774,40,'Renacimiento 1, 2, 3, 4 Sector','64925'),(775,40,'Lomas del Paseo 3 Sector B','64925'),(776,40,'Privada Fundadores 1 Sector','64926'),(777,40,'Las Torres','64930'),(778,40,'Eduardo A. Elizondo','64940'),(779,40,'Villa Sol','64949'),(780,40,'Torres de Satélite','64950'),(781,40,'Ciudad Satélite 4 Sector','64950'),(782,40,'Ciudad Satélite','64960'),(783,40,'Satélite 6 Sector Acueducto','64968'),(784,40,'Satélite Miradores 2 Etapa','64968'),(785,40,'Colinas del Sur','64968'),(786,40,'Satélite Miradores 1er Sector','64968'),(787,40,'Ciudad Satélite 5 Sector','64969'),(788,40,'Contry Sur','64969'),(789,40,'Lomas de Satélite','64969'),(790,40,'Campestre Mederos','64970'),(791,40,'Privada Villalta Residencial','64978'),(792,40,'Lomas Mederos','64978'),(793,40,'Cañada del Sur A. C.','64979'),(794,40,'Balcones de Mederos','64979'),(795,40,'Bosques de Satélite','64979'),(796,40,'Valle de Bosquencinos 1era. Etapa','64979'),(797,40,'Satélite Acueducto 7 Sector','64979'),(798,40,'Satélite 6 Sector Acueducto 2 Etapa','64979'),(799,40,'Ciudad Satélite 3 Sector','64979'),(800,40,'Rincón Colonial Mederos','64979'),(801,40,'Valle de Bosquecinos 2da Etapa','64979'),(802,40,'Coto San Carlos','64979'),(803,40,'Residencial Mederos','64979'),(804,40,'Bosquencinos 1er, 2da y 3ra Etapa','64979'),(805,40,'El Pinito','64980'),(806,40,'Manantiales del Diente','64980'),(807,40,'La Toscana','64983'),(808,40,'Las Estancias 2da Etapa','64983'),(809,40,'La Toscana 2 Sector','64983'),(810,40,'Palmares 2do Sector','64983'),(811,40,'Rincón del Vergel','64983'),(812,40,'El Refugio','64983'),(813,40,'Las Estancias 3er Sector','64983'),(814,40,'Antara','64983'),(815,40,'Palmares 1er Sector','64983'),(816,40,'Santa Lucia','64983'),(817,40,'Misión Canterías','64984'),(818,40,'San Pablo','64984'),(819,40,'Cerradas de Valle Alto','64984'),(820,40,'Villas de la Herradura','64984'),(821,40,'Residencial La Lagrima','64984'),(822,40,'El Sabino Cerrada Residencial','64984'),(823,40,'Brisas de Valle Alto','64984'),(824,40,'La Rioja Privada Residencial 2da Etapa','64984'),(825,40,'Canterias Norte','64984'),(826,40,'Ignacio Altamirano','64984'),(827,40,'Las Estancias 1er. Sector','64984'),(828,40,'Villas la Rioja','64984'),(829,40,'Vistancias 1er Sector','64984'),(830,40,'Vistancias 2 Sector','64984'),(831,40,'La Estanzuela Vieja','64984'),(832,40,'Los Cristales','64985'),(833,40,'Villa las Flores','64985'),(834,40,'La Joya Privada Residencial','64985'),(835,40,'El Uro Oriente','64985'),(836,40,'Villa Santa Isabel','64985'),(837,40,'Villa Murano','64985'),(838,40,'Villa Toledo','64985'),(839,40,'Soria','64986'),(840,40,'Privada Residencial Villas Del Uro','64986'),(841,40,'El Uro','64986'),(842,40,'Rancho La Bola','64986'),(843,40,'Montealbán Residencial','64986'),(844,40,'Bosques del Vergel','64987'),(845,40,'El Encino','64987'),(846,40,'Las Diligencias','64987'),(847,40,'Privadas la Herradura','64987'),(848,40,'El Vergel','64987'),(849,40,'Privada la Herradura','64987'),(850,40,'El Milagro','64988'),(851,40,'Colinas del Huajuco','64988'),(852,40,'Lomas del Vergel','64988'),(853,40,'Jardines de La Estanzuela','64988'),(854,40,'Rincón de la Escondida','64988'),(855,40,'Paraíso Residencial','64988'),(856,40,'Residencial el Encanto II','64988'),(857,40,'Sierra Escondida','64988'),(858,40,'Granja Postal','64988'),(859,40,'Bosques de la Estanzuela','64988'),(860,40,'Las Riveras','64988'),(861,40,'Privada el Vergel','64988'),(862,40,'Residencial la Escondida','64988'),(863,40,'Los Nogales','64988'),(864,40,'Las Callejas Residencial','64988'),(865,40,'Bosques de La Silla','64988'),(866,40,'Nogales de La Sierra','64988'),(867,40,'El Fortín del Huajuco','64988'),(868,40,'La Rioja Privada Residencial 1era. Etapa','64988'),(869,40,'Estanzuela Nueva','64988'),(870,40,'Encino Real','64988'),(871,40,'La Alhambra','64988'),(872,40,'Paseo del Vergel','64988'),(873,40,'La Estanzuela','64988'),(874,40,'La Estanzuela (F-45)','64988'),(875,40,'Misión Silla','64988'),(876,40,'Privadas de la Fuente','64988'),(877,40,'Residencial Encanto','64988'),(878,40,'Residencial de la Sierra','64988'),(879,40,'Hacienda Los Encinos','64989'),(880,40,'Lomas de Valle Alto','64989'),(881,40,'Lomas de Hípico','64989'),(882,40,'Pedregal de Valle Alto','64989'),(883,40,'Lagos del Vergel','64989'),(884,40,'Real de Valle Alto 2 Sector','64989'),(885,40,'Canterías 1 Sector','64989'),(886,40,'Bosques de Valle Alto 2 Etapa','64989'),(887,40,'Real de Valle Alto 3er Sector','64989'),(888,40,'Sierra Alta 6 Sector 2a Etapa','64989'),(889,40,'Valle del Vergel','64989'),(890,40,'Campestre Bugambilias','64989'),(891,40,'San Gabriel','64989'),(892,40,'San Michelle','64989'),(893,40,'El Portón de Valle Alto','64989'),(894,40,'Maestranzas Villas de Providencia','64989'),(895,40,'Natura','64989'),(896,40,'Rincón de las Montañas (Sierra Alta 8 Sector)','64989'),(897,40,'Sierra Alta 3er Sector','64989'),(898,40,'Sierra Alta 9o Sector','64989'),(899,40,'Sierra Alta 1era. Etapa','64989'),(900,40,'Flor de Piedra','64989'),(901,40,'Bosques de Valle Alto 2 Sector','64989'),(902,40,'Rincón de Valle Alto','64989'),(903,40,'Sierra Alta 6 Sector','64989'),(904,40,'Valle Alto','64989'),(905,40,'Sierra Alta 5 Sector','64989'),(906,40,'Lomas del Hipico 1 Sector','64989'),(907,40,'Bosques de Valle Alto 1er. Sector','64989'),(908,40,'Rincón de los Encinos','64989'),(909,40,'Las Jacarandas','64989'),(910,40,'Real de Valle Alto 1er. Sector','64989'),(911,40,'Los Milagros de Valle Alto 1 Sector','64989'),(912,40,'Sierra Alta 2  Sector','64989'),(913,40,'Rincón de los Ahuehuetes','64989'),(914,40,'Hacienda Codornices','64989'),(915,40,'Sierra Alta 4 Sector','64989'),(916,40,'Áurea Residencial','64989'),(917,40,'Los Milagros de Valle Alto 2 Sector','64989'),(918,40,'Portal del Huajuco','64989'),(919,40,'Villas de Canterias','64989'),(920,40,'Balcones de Valle Alto','64989'),(921,40,'Rincón de Sierra Alta','64989'),(922,40,'Los Cristales Fraccionamiento Campestre','64990'),(923,40,'Antigua Hacienda Santa Anita','64990'),(924,40,'Campestre los Cristales','64990'),(925,40,'Valles de Cristal','64990'),(926,40,'Las Jaras','64990'),(927,40,'Las Margaritas','64990'),(928,40,'Canterel','64990'),(929,40,'Campestre Sertoma','64990'),(930,40,'El Mirador','64990'),(931,40,'El Edén','64996'),(932,40,'Carolco','64996'),(933,40,'El Barro','64997'),(934,40,'Campestre El Barrio','64997'),(935,4,'Colombia','65000'),(936,4,'El Camarón','65001'),(937,4,'Rodriguez','65002'),(938,4,'Sifón Villanueva','65004'),(939,4,'Escuela Rural Federal 14','65008'),(940,4,'Kilómetro 34','65010'),(941,4,'Anáhuac y Rodriguez Centro','65030'),(942,4,'Revolución','65032'),(943,4,'Obrera','65033'),(944,4,'Progreso','65033'),(945,4,'Lázaro Cárdenas','65034'),(946,4,'Lomas de Anáhuac','65034'),(947,4,'Infonavit','65034'),(948,4,'Obrera','65034'),(949,4,'Fomerrey','65034'),(950,4,'Granja Experimental','65036'),(951,4,'Anáhuac','65040'),(952,4,'Independencia','65040'),(953,4,'Raul Caballero Escamilla','65042'),(954,4,'Chapultepec','65042'),(955,4,'Nuevo Camarón','65057'),(956,4,'Nuevo Anáhuac','65059'),(957,4,'Nuevo Rodriguez','65059'),(958,30,'Lampazos de Naranjo','65070'),(959,30,'Lampazos','65070'),(960,30,'Santa Elena','65075'),(961,30,'Horcones','65076'),(962,30,'El Nogal','65080'),(963,30,'Las Ranas','65088'),(964,30,'Golondrinas Estación','65090'),(965,30,'Las Presas','65092'),(966,38,'Mina','65100'),(967,38,'Los Guerra','65105'),(968,38,'San Jose de La Popa','65110'),(969,38,'Presa de La Mula','65118'),(970,38,'La Jarita','65120'),(971,38,'Espinazo Estación','65140'),(972,7,'Bustamante','65150'),(973,7,'El Valladito','65150'),(974,7,'El Pedregal','65150'),(975,44,'Sabinas Hidalgo Centro','65200'),(976,44,'El Aguacate','65200'),(977,44,'Sonora','65200'),(978,44,'El Dólar','65200'),(979,44,'Pablo Santos','65210'),(980,44,'El Nogalar','65220'),(981,44,'Las Misiones','65220'),(982,44,'Primavera','65220'),(983,44,'La Esperanza','65220'),(984,44,'La Noria','65220'),(985,44,'La Recta','65220'),(986,44,'Mirador','65230'),(987,44,'Plaza Mirador 2','65230'),(988,44,'Plaza Mirador','65230'),(989,44,'La Campiña','65230'),(990,44,'Martinez Dominguez Alfonso','65230'),(991,44,'Revolución','65230'),(992,44,'Valle Del Sol','65230'),(993,44,'Real de las Palmas','65230'),(994,44,'Los Ébanos','65230'),(995,44,'Los Chapa','65233'),(996,44,'Niños Héroes','65234'),(997,44,'Jardines de la Ermita','65234'),(998,44,'Hacienda Santa Cruz','65234'),(999,44,'Maria Luisa','65240'),(1000,44,'Reyes Eulagio','65240'),(1001,44,'Hacienda San Francisco','65240'),(1002,44,'Villa Francisco','65243'),(1003,44,'Caballero Escamilla Raul','65243'),(1004,44,'El Sendero','65243'),(1005,44,'Gonzalez Sáenz Leopoldo','65244'),(1006,44,'Miguel Hidalgo','65244'),(1007,44,'Industrial Sabinas','65249'),(1008,44,'La Santa Cruz','65250'),(1009,44,'Los Canteros','65250'),(1010,44,'Los Morales','65250'),(1011,44,'CROC','65250'),(1012,44,'La Turbina','65255'),(1013,44,'Fidel Velázquez','65256'),(1014,44,'Fovissste','65256'),(1015,44,'Quintana Nora','65256'),(1016,44,'Campestre Rivereño','65256'),(1017,44,'Venustiano Carranza','65257'),(1018,44,'Hacienda los Morales','65257'),(1019,44,'Industrial','65260'),(1020,44,'Bellavista','65270'),(1021,44,'Bortoni Urteaga Graciano','65272'),(1022,44,'Constitución','65272'),(1023,44,'San Francisco Javier','65276'),(1024,44,'Larraldeña','65276'),(1025,44,'Industrial Poniente','65276'),(1026,44,'Jose Ma Morelos','65280'),(1027,44,'Cárdenas Lázaro','65280'),(1028,44,'Benito Juárez','65288'),(1029,44,'17 de Septiembre','65288'),(1030,44,'Josefa Zozaya','65289'),(1031,44,'Enrique Lozano','65290'),(1032,44,'Rincón del Sabino','65290'),(1033,44,'Lomas Chula','65299'),(1034,44,'Lázaro Garza Ayala','65300'),(1035,44,'Carboneras','65302'),(1036,44,'El Ébano','65336'),(1037,44,'Sombreretillo','65340'),(1038,44,'Paso El Álamo','65347'),(1039,44,'Buenavista','65348'),(1040,51,'Villaldama Centro','65350'),(1041,51,'Santa Fe','65357'),(1042,51,'Independencia','65386'),(1043,51,'El Potrero','65390'),(1044,51,'Villaldama Estación','65390'),(1045,51,'El Álamo','65395'),(1046,50,'Vallecillo','65400'),(1047,50,'Los Garza','65410'),(1048,50,'San Carlos','65415'),(1049,50,'Aquiles Serdán','65419'),(1050,50,'Matatenas','65420'),(1051,50,'Los Colorados de Arriba','65429'),(1052,50,'Los Colorados de Abajo','65430'),(1053,50,'Fresnillo','65436'),(1054,50,'El Álamo','65440'),(1055,50,'Palo Alto','65449'),(1056,41,'Paras','65450'),(1057,41,'Rio Salado','65480'),(1058,41,'La Gloria','65480'),(1059,45,'León A. Flores','65500'),(1060,45,'Valle de las Salinas','65500'),(1061,45,'Paseo del Norte','65500'),(1062,45,'Valle de Salinas','65500'),(1063,45,'Salinas Victoria','65500'),(1064,45,'Los Maestros','65500'),(1065,45,'Gobernadores','65500'),(1066,45,'Mission','65503'),(1067,45,'Paseos San Isidro','65503'),(1068,45,'La Marranera','65503'),(1069,45,'Los Ángeles','65503'),(1070,45,'Raúl Caballero Escamilla','65503'),(1071,45,'San Juan','65503'),(1072,45,'Valle del Mirador','65503'),(1073,45,'Las Torres','65503'),(1074,45,'Las Gaviotas','65503'),(1075,45,'Predio San Isidro','65503'),(1076,45,'San Marcos','65503'),(1077,45,'Prolongación Juárez (Loma de la Cruz)','65504'),(1078,45,'Petrita','65504'),(1079,45,'Salinas (Avícola)','65504'),(1080,45,'San Isidro 1er. Sector','65504'),(1081,45,'El Pedregal (Salinas)','65504'),(1082,45,'Agrarista','65505'),(1083,45,'Brenda','65505'),(1084,45,'Quadro Residencial','65507'),(1085,45,'Emiliano Zapata','65510'),(1086,45,'Ciudad Satelite del Norte','65510'),(1087,45,'Santa Isabel','65513'),(1088,45,'Don Manuel','65513'),(1089,45,'Los Ponys','65513'),(1090,45,'Camino a los Gutiérrez','65513'),(1091,45,'Juanita','65513'),(1092,45,'Casa Linda','65513'),(1093,45,'El Charro','65513'),(1094,45,'Los Gutiérrez','65513'),(1095,45,'Carmen Flores','65513'),(1096,45,'La Amistad','65513'),(1097,45,'Don Cesáreo','65513'),(1098,45,'Los Ébanos','65513'),(1099,45,'Lerma (Fundición)','65513'),(1100,45,'El Mirador','65513'),(1101,45,'El Porvenir','65513'),(1102,45,'El Cortijo','65513'),(1103,45,'San Pedro','65513'),(1104,45,'Club de Leones','65513'),(1105,45,'Los Pinos','65513'),(1106,45,'Cuatro de Abril','65513'),(1107,45,'Miguel Mario','65513'),(1108,45,'El Ancón','65513'),(1109,45,'Los Morillos','65513'),(1110,45,'Cuatro Hermanos','65513'),(1111,45,'Las Lomas (Santa Teresita)','65513'),(1112,45,'San José (Santa Anita)','65513'),(1113,45,'San Benito','65513'),(1114,45,'Los Pinos','65514'),(1115,45,'Veintiocho de Marzo','65514'),(1116,45,'El Vergel','65514'),(1117,45,'Azafrán','65514'),(1118,45,'Cuatro de Octubre (Kilómetro Veintidós)','65514'),(1119,45,'Don Roque','65514'),(1120,45,'Los Dos Potrillos','65514'),(1121,45,'Andrea (Avícola)','65514'),(1122,45,'Nicolás Mederes','65514'),(1123,45,'Lázaro Cárdenas','65514'),(1124,45,'El Doce','65514'),(1125,45,'San José','65514'),(1126,45,'José Calderón','65514'),(1127,45,'Doña Lupita','65514'),(1128,45,'Quince de Abril','65514'),(1129,45,'Rancho del Norte','65514'),(1130,45,'San Francisco','65514'),(1131,45,'Salinas','65514'),(1132,45,'J. y R.','65514'),(1133,45,'Los Cuates','65514'),(1134,45,'El Antonio (Cárdenas)','65514'),(1135,45,'Los Fresnos','65515'),(1136,45,'Fuentes','65515'),(1137,45,'San Agustín','65515'),(1138,45,'Los Doctores','65515'),(1139,45,'San Miguel','65515'),(1140,45,'Emiliano Zapata (La Zapatita)','65515'),(1141,45,'Bosques de los Nogales','65515'),(1142,45,'Valle del Norte','65515'),(1143,45,'El Corralito','65515'),(1144,45,'San Roberto','65515'),(1145,45,'Los Pilares','65515'),(1146,45,'Santa Martha','65515'),(1147,45,'San Nicolás de los Garza','65516'),(1148,45,'Colectivo','65516'),(1149,45,'La Palapa (R Cuatro)','65516'),(1150,45,'Abel Arriaga','65516'),(1151,45,'Paseo Santa Isabel','65516'),(1152,45,'Cassandra','65516'),(1153,45,'Hermanos Dávila','65516'),(1154,45,'Sevilla','65516'),(1155,45,'El Porvenir','65517'),(1156,45,'El Aguante','65517'),(1157,45,'El Coyote','65517'),(1158,45,'El Leal (Predio Alfonso Martínez Domínguez)','65517'),(1159,45,'Comunal Huertas de San Mario','65517'),(1160,45,'Punta de la Loma (Rancho el Abuelo)','65520'),(1161,45,'Los Arados','65520'),(1162,45,'Los Torres','65520'),(1163,45,'El Faro (Porcícola)','65520'),(1164,45,'Omega Número Dos (Avícola)','65520'),(1165,45,'Ejidal Mamulique','65520'),(1166,45,'Fernando Hernández (San Bernardo)','65520'),(1167,45,'San Sebastián','65520'),(1168,45,'Santo Tomás','65520'),(1169,45,'Cimarrón Steel (Lavado de Acero)','65520'),(1170,45,'Cieneguitas','65520'),(1171,45,'Santa Elena','65520'),(1172,45,'Los Reyes','65520'),(1173,45,'Las Codornices','65520'),(1174,45,'El Encino','65520'),(1175,45,'Los Temporales','65520'),(1176,45,'De Rubén','65520'),(1177,45,'Omega Número Uno (Avícola)','65520'),(1178,45,'Nuevo Mamulique','65520'),(1179,45,'Cieneguitas','65520'),(1180,45,'Alfaro','65520'),(1181,45,'Omega Número Tres (La Esperanza) Avícola','65520'),(1182,45,'La Floreña','65520'),(1183,45,'Mamulique','65520'),(1184,45,'Mamulique','65520'),(1185,45,'La Joya (Los Burros)','65520'),(1186,45,'Colonia del Ejido','65520'),(1187,45,'Mariana','65520'),(1188,45,'San Paulo','65520'),(1189,45,'Las Palmas','65520'),(1190,45,'San Bernardo Dos','65520'),(1191,45,'El Aguaje','65523'),(1192,45,'San Benito (Santa Elena)','65523'),(1193,45,'Uña de Gato (Loma Blanca)','65523'),(1194,45,'Santa Teresa','65523'),(1195,45,'San José (La Engorda)','65523'),(1196,45,'El Terrero','65524'),(1197,45,'El Seis (San Francisco)','65524'),(1198,45,'El Lantrisco','65524'),(1199,45,'El Dique (El Viejo)','65524'),(1200,45,'El Guaje','65524'),(1201,45,'El Recodo','65524'),(1202,45,'Santa Isabel','65524'),(1203,45,'El Setenta (El Chilarito)','65525'),(1204,45,'La Puerta','65525'),(1205,45,'La Barrosa','65525'),(1206,45,'El Alto','65525'),(1207,45,'La Cuesta','65525'),(1208,45,'El Rincón','65525'),(1209,45,'El Veinte (San Joel)','65525'),(1210,45,'El Rincón','65525'),(1211,45,'Teresita (La Puerta)','65525'),(1212,45,'Los Pozos','65526'),(1213,45,'Pozo Nuevo','65526'),(1214,45,'La Esperanza (Porcícola)','65526'),(1215,45,'Quiroga (Merendero)','65526'),(1216,45,'La Leona','65526'),(1217,45,'Pocitos (La Paloma)','65526'),(1218,45,'La Paloma','65527'),(1219,45,'Los Lavaderos','65528'),(1220,45,'El Tule','65528'),(1221,45,'Viernes Santo','65528'),(1222,45,'Agropecuaria el Tule','65528'),(1223,45,'La Victoria (Rancho del Güero)','65528'),(1224,45,'Los Villarreales','65530'),(1225,45,'Las Lilas','65530'),(1226,45,'Verdiguel','65530'),(1227,45,'El Izotal','65530'),(1228,45,'El Chapote','65530'),(1229,45,'San Juan','65530'),(1230,45,'Salinas','65530'),(1231,45,'Puerto Chico','65530'),(1232,45,'El Detalle','65530'),(1233,45,'Mario Durón (El Rebozo)','65530'),(1234,45,'Kilómetro Tres','65530'),(1235,45,'El Encino','65530'),(1236,45,'Los Guajardo','65530'),(1237,45,'Los Alamitos','65530'),(1238,45,'Valle Alto','65530'),(1239,45,'La Agonía (El Hormiguero)','65530'),(1240,45,'Rubén Hinojosa (Arroyo la Negra)','65530'),(1241,45,'San Gerónimo','65530'),(1242,45,'Santa Elena (Las Encinas)','65530'),(1243,45,'Puerto Grande','65530'),(1244,45,'Halcones','65530'),(1245,45,'La Vidriera','65530'),(1246,45,'Santa Gertrudis','65530'),(1247,45,'San Ricardo','65530'),(1248,45,'Quiroga','65530'),(1249,45,'Plateritos','65530'),(1250,45,'Santa Teresa','65530'),(1251,45,'Los Villarreales','65530'),(1252,45,'Roquín','65530'),(1253,45,'El Ángel (Parcela Ochenta y Tres)','65530'),(1254,45,'Los Morales','65530'),(1255,45,'Raymundo Urrutia (Llano Blanco)','65530'),(1256,45,'La Cima','65530'),(1257,45,'Artemio y Hernán','65530'),(1258,45,'Los Cantú','65530'),(1259,45,'La Cima (Palos Blancos)','65530'),(1260,45,'Dos de Marzo','65530'),(1261,45,'Santa Elena','65530'),(1262,45,'El Mezquite (Kilómetro Treinta y Tres)','65530'),(1263,45,'Casa de Piedra','65530'),(1264,45,'La Sultana (Villa Alegre)','65530'),(1265,45,'Las Mercedes (Los García)','65530'),(1266,45,'Arroyo la Sandía','65530'),(1267,45,'Santa Mónica (La Ilusión)','65530'),(1268,45,'El Veintisiete (Las Catarinas)','65533'),(1269,45,'San Apolinar','65533'),(1270,45,'El Cenizo','65533'),(1271,45,'San Jorge','65533'),(1272,45,'Valle de Salinas','65533'),(1273,45,'Los Pujidos (Porcícola)','65533'),(1274,45,'Camino a los Villarreales (Kilómetro Uno)','65533'),(1275,45,'Liz (San Juan del Mezquital)','65533'),(1276,45,'Melisa','65533'),(1277,45,'Cuarenta y Cuatro','65533'),(1278,45,'El Deiby','65533'),(1279,45,'Keiko (Avícola)','65533'),(1280,45,'El Lindero','65533'),(1281,45,'El Ciervo','65533'),(1282,45,'Santa Clara','65533'),(1283,45,'El Atorón','65533'),(1284,45,'El Búfalo','65533'),(1285,45,'El Refugio','65533'),(1286,45,'La Morita','65533'),(1287,45,'Los Garza','65533'),(1288,45,'Rancho Nuevo','65533'),(1289,45,'San Pedro','65533'),(1290,45,'Dolores (Los Morales)','65533'),(1291,45,'Don Nicolás (Avícola)','65533'),(1292,45,'Kilómetro 39.9 (La Trinidad)','65533'),(1293,45,'El Norteño','65533'),(1294,45,'La Capilla','65533'),(1295,45,'Las Angustias','65533'),(1296,45,'El Papalote','65533'),(1297,45,'El Ancón (Avícola)','65533'),(1298,45,'El Granjeno','65534'),(1299,45,'Rey (Hielo)','65534'),(1300,45,'El Cuarenta y Cuatro','65534'),(1301,45,'La Luz','65534'),(1302,45,'La Agonía','65534'),(1303,45,'Primero de Mayo','65534'),(1304,45,'Hojacen','65534'),(1305,45,'Campestre el Palmar','65534'),(1306,45,'Mamulique','65534'),(1307,45,'La Nacagüita','65534'),(1308,45,'La Luz','65534'),(1309,45,'El Cerrito','65534'),(1310,45,'Los Cuarenta y Cinco','65534'),(1311,45,'La Copina','65534'),(1312,45,'El Cóndor (Avícola)','65534'),(1313,45,'Rey (Hielo)','65534'),(1314,45,'San Antonio','65535'),(1315,45,'Las Delicias','65535'),(1316,45,'La Purísima (Güémez)','65535'),(1317,45,'El Canelo','65535'),(1318,45,'El Recodo','65535'),(1319,45,'La Rosa','65535'),(1320,45,'Los Yuguitos','65535'),(1321,45,'Los Urrutias','65535'),(1322,45,'El Mezquital (San Juan del Mezquital)','65535'),(1323,45,'Sagitario (Las Delicias)','65535'),(1324,45,'La Rana','65535'),(1325,45,'Primero de Junio','65535'),(1326,45,'Dinastía','65535'),(1327,45,'San Ramón','65535'),(1328,45,'El Canelo','65535'),(1329,45,'El Argentino','65536'),(1330,45,'Las Abejas','65536'),(1331,45,'La Gloria','65536'),(1332,45,'San Martín','65536'),(1333,45,'Santa Eduviges','65536'),(1334,45,'Viejo','65536'),(1335,45,'Las Carretas (Rancho Tres)','65536'),(1336,45,'El Rebozo','65536'),(1337,45,'San Isidro','65536'),(1338,45,'Santa Ana','65536'),(1339,45,'Las Carretas','65536'),(1340,45,'Punta de la Loma','65536'),(1341,45,'Nuevo','65536'),(1342,45,'Labores Nuevas','65536'),(1343,45,'Siete de Abril','65536'),(1344,45,'Las Abejas','65536'),(1345,45,'Las Carretas','65536'),(1346,45,'Los Pérez','65536'),(1347,45,'El Ranchito','65536'),(1348,45,'Antorcha Campesina','65536'),(1349,45,'El Sinaí','65536'),(1350,45,'Veinte de Agosto (Porcícola)','65536'),(1351,45,'Morales','65536'),(1352,45,'Cuatro de Abril','65536'),(1353,45,'Las Palmas','65536'),(1354,45,'Guadalupe (Lienzo Charro)','65536'),(1355,45,'El Huizache','65536'),(1356,45,'La Pista (Las Carretas) Porcícola','65536'),(1357,45,'Los Pérez','65536'),(1358,45,'Santa Elena','65536'),(1359,45,'La Gloria','65536'),(1360,45,'Tierra Blanca','65536'),(1361,45,'Pedro Silva (Santa Elia)','65536'),(1362,45,'Las Carretas','65536'),(1363,45,'San Ignacio','65537'),(1364,45,'Nueva Salinas','65537'),(1365,45,'Veinte de Febrero','65537'),(1366,45,'La Victoria','65537'),(1367,45,'El Cuatro','65537'),(1368,45,'Quince de Diciembre (La Vidriera)','65537'),(1369,45,'La Estrella','65537'),(1370,45,'Santa Mónica','65537'),(1371,45,'Conchita','65537'),(1372,45,'Gilberto González','65537'),(1373,45,'Unión San Javier','65537'),(1374,45,'San Pablo','65537'),(1375,45,'San Gerardo (San Inés)','65537'),(1376,45,'El Milagro','65537'),(1377,45,'Arroyo la Negra','65537'),(1378,45,'El Coyote','65537'),(1379,45,'San Juan Pesquerineño','65543'),(1380,45,'Los Quiroga','65543'),(1381,45,'San Juan de Guadalupe','65543'),(1382,45,'Cuatro Emilios (La Concepción)','65543'),(1383,45,'El Mezquite','65543'),(1384,45,'Gomas y Mendiola (Rancho de Gomas)','65543'),(1385,45,'Guadalupe','65543'),(1386,45,'San Roberto','65543'),(1387,45,'El Bambú','65543'),(1388,45,'El Pedregal (El Guajiro)','65543'),(1389,45,'El Roble','65543'),(1390,45,'La Unión','65543'),(1391,45,'Peñitas','65543'),(1392,45,'Guadalupe','65543'),(1393,45,'Los Generales','65544'),(1394,45,'Las Coloradas','65544'),(1395,45,'San Juan (Palo Blanco)','65544'),(1396,45,'El Puerto','65544'),(1397,45,'La Rumorosa','65544'),(1398,45,'El Aguajito','65544'),(1399,45,'El Cortador','65544'),(1400,45,'El Jardín','65544'),(1401,45,'El Maguey','65545'),(1402,45,'Milpillas','65545'),(1403,45,'El Colmenar (Los Quiroga)','65545'),(1404,45,'Palo Blanco','65545'),(1405,45,'San Ignacio','65545'),(1406,45,'El Mesón','65545'),(1407,45,'San Manuel','65545'),(1408,45,'Santa Isabel','65545'),(1409,45,'La Agüita','65545'),(1410,45,'El Quemado','65546'),(1411,45,'Kilómetro Setenta y Seis','65546'),(1412,45,'Barranca Blanca','65546'),(1413,45,'El Cedro','65546'),(1414,45,'San Raymundo','65546'),(1415,45,'Los Treviño','65546'),(1416,45,'San Gregorio','65546'),(1417,45,'Palmeras','65546'),(1418,45,'Heleno Evelio Quiroga','65546'),(1419,45,'Lampazos','65546'),(1420,45,'El León','65547'),(1421,45,'El Nogal','65547'),(1422,45,'Las Nueces','65547'),(1423,45,'El Pedernal','65547'),(1424,45,'Arturo Quiroga','65547'),(1425,45,'Salsipuedes','65547'),(1426,45,'El Sarro','65547'),(1427,45,'Montelongo','65547'),(1428,45,'San Juan','65547'),(1429,45,'Los Martínez','65547'),(1430,45,'Doctor Ramón (Raíces)','65547'),(1431,45,'Picachos de los Abuelos','65548'),(1432,45,'El Orégano','65548'),(1433,11,'Ciénega de Flores Centro','65550'),(1434,11,'Tía Lencha','65554'),(1435,11,'Dibsa II','65554'),(1436,11,'Dibsa I','65554'),(1437,11,'Campestre Villas del Norte','65555'),(1438,11,'Los Héroes Monterrey','65555'),(1439,11,'Real del Sol 2 Sector','65555'),(1440,11,'Real del Sol','65555'),(1441,11,'Los Ruiseñores','65556'),(1442,11,'Portal de Las Salinas Residencial','65556'),(1443,11,'Villas Campestres','65556'),(1444,11,'Lomas de Ciénega','65558'),(1445,11,'Pedregal de Ciénega','65558'),(1446,11,'Conchita Velázco Sect 1','65558'),(1447,11,'La Crisis','65560'),(1448,11,'Valle de las Flores','65560'),(1449,11,'Los Lirios','65560'),(1450,11,'Conchita Velázco Sect 2','65560'),(1451,11,'Martinez Dominguez','65560'),(1452,11,'Fomerrey 5','65562'),(1453,11,'Progreso','65562'),(1454,11,'Valle del Progreso','65563'),(1455,11,'Emiliano Zapata','65563'),(1456,11,'Alianza Sector 3','65563'),(1457,11,'San Juan','65563'),(1458,11,'Valle de las Lomas','65563'),(1459,11,'Privadas del Valle','65563'),(1460,11,'Alianza Sector 1','65564'),(1461,11,'Alianza','65564'),(1462,11,'Alianza Sector 2','65564'),(1463,11,'Loma Linda','65564'),(1464,11,'Valle de Ciénega','65565'),(1465,11,'Hacienda las Flores','65567'),(1466,11,'Los Ruiseñores','65573'),(1467,11,'Paseos del Roble','65573'),(1468,11,'Parque Industrial Nexxus ADN','65580'),(1469,11,'Paseo del Roble','65580'),(1470,11,'Paseos del Roble','65580'),(1471,11,'Villas de Alcalá','65580'),(1472,11,'Parque Industrial Multiparque Aeropuerto','65583'),(1473,25,'Miguel Hidalgo','65600'),(1474,25,'Alfonso Hernandez','65600'),(1475,25,'Hidalgo Centro','65600'),(1476,25,'Cuauhtémoc','65600'),(1477,25,'Jose Alatorre Gámez','65600'),(1478,25,'Morelos','65600'),(1479,25,'Crescenciano Lozano','65600'),(1480,25,'Benito Juárez','65600'),(1481,25,'San Martin','65600'),(1482,25,'Lázaro Cárdenas','65600'),(1483,25,'Revolución','65600'),(1484,25,'Margarita Maza de Juárez','65600'),(1485,25,'San Andres','65600'),(1486,25,'Zaragoza','65600'),(1487,25,'Los Angeles','65600'),(1488,1,'Lázaro Cárdenas','65650'),(1489,1,'Voluntad y Trabajo','65650'),(1490,1,'Abasolo Centro','65650'),(1491,1,'Linda Vista','65650'),(1492,1,'Alberto Villareal','65650'),(1493,1,'El Mirador','65650'),(1494,1,'Los Pinos','65650'),(1495,1,'Seis de Enero (Bugambilias)','65653'),(1496,1,'Casa Rosa (Los Olivos)','65653'),(1497,1,'Los Diez (La Tripona)','65654'),(1498,1,'Cuatro Vientos','65660'),(1499,1,'La Gloria','65660'),(1500,1,'Los Ligeros','65663'),(1501,26,'Higueras','65700'),(1502,23,'Gral. Zuazua','65750'),(1503,23,'Real de Palmas','65760'),(1504,23,'Misión de Santa Elena','65760'),(1505,23,'Las Bugambilias','65760'),(1506,23,'Valle de Santa Elena','65776'),(1507,23,'Residencial Hacienda San Pedro','65780'),(1508,23,'Real San Pedro','65780'),(1509,23,'Portal del Norte','65780'),(1510,23,'Portal de Zuazua','65780'),(1511,2,'Jardín','65800'),(1512,2,'Prof. Jesús M. Lozano Treviño','65800'),(1513,2,'Agualeguas Centro','65800'),(1514,2,'Mira Sierra','65800'),(1515,2,'Olivia Olvera','65800'),(1516,2,'Del Norte','65800'),(1517,2,'Los Mogotes Tres','65803'),(1518,2,'La Gloria','65804'),(1519,2,'Santos Valadez (Piedra Parada)','65805'),(1520,2,'La Retama','65805'),(1521,2,'Los Vázquez','65806'),(1522,2,'Palo Blanco','65806'),(1523,2,'Puerta las Ovejas','65806'),(1524,2,'El Texano','65806'),(1525,2,'El Recuerdo','65807'),(1526,2,'El Roble','65807'),(1527,2,'José Luis Mayo','65807'),(1528,2,'San Vicente','65807'),(1529,2,'El Recodo','65807'),(1530,2,'San Cristóbal','65807'),(1531,2,'Tío Marío','65807'),(1532,2,'Chapa Ramos Dos','65808'),(1533,2,'Ojo de Agua','65808'),(1534,2,'Los Elizondo Número Uno','65810'),(1535,2,'Los Salazar','65810'),(1536,2,'El Derrame','65810'),(1537,2,'El Potrero','65810'),(1538,2,'Rancho Nuevo','65810'),(1539,2,'El Abuelo','65813'),(1540,2,'Tres Hermanos','65813'),(1541,2,'Dermi','65813'),(1542,2,'El Maguey','65813'),(1543,2,'Ramón Cantú','65813'),(1544,2,'Ojo de Agua','65813'),(1545,2,'Los Olmos','65814'),(1546,2,'El Nogal','65814'),(1547,2,'El Prieto','65815'),(1548,2,'La Purísima','65815'),(1549,2,'Cieneguitas','65815'),(1550,2,'Los Garza','65819'),(1551,2,'Alicia','65823'),(1552,2,'El Papalote','65826'),(1553,2,'La Ponderosa','65826'),(1554,2,'Pedrera Arroyo las Alazanas','65826'),(1555,2,'La Escondida','65830'),(1556,2,'Tío Chonito','65830'),(1557,2,'Rancho Seco','65830'),(1558,2,'San José','65833'),(1559,2,'El Corral','65834'),(1560,2,'Agua Blanca','65834'),(1561,2,'San Andrés (Marín de Porras)','65834'),(1562,2,'Los Nogales','65835'),(1563,2,'Ciriaco González','65835'),(1564,2,'La Conchita','65835'),(1565,2,'La Pau','65835'),(1566,2,'Los Martínez','65836'),(1567,2,'La Barreta','65836'),(1568,2,'Lagunillas','65836'),(1569,2,'Sagrado Corazón (Los Gutiérrez)','65836'),(1570,2,'San Pedro','65837'),(1571,2,'La Atravesada','65837'),(1572,2,'La Rosita','65837'),(1573,2,'San Roberto','65837'),(1574,21,'La Laguna','65850'),(1575,21,'Gral. Treviño','65850'),(1576,21,'San Javier','65880'),(1577,9,'Ciudad Cerralvo','65900'),(1578,9,'Arroyo de Piedra','65907'),(1579,9,'Juárez','65920'),(1580,9,'Los Nogales','65930'),(1581,9,'Uña de Gato','65936'),(1582,9,'Martinitos','65940'),(1583,36,'Melchor Ocampo','65950'),(1584,17,'Los Aljibes','66000'),(1585,17,'Centro Villa de Garcia (casco)','66000'),(1586,17,'Héroes de Capellanía','66003'),(1587,17,'Mirador de Garcia','66003'),(1588,17,'Hacienda del Sol','66003'),(1589,17,'Los Nogales','66003'),(1590,17,'Praderas de Lincoln','66003'),(1591,17,'Paseo de las Minas','66003'),(1592,17,'Villas del Alcali','66003'),(1593,17,'Rincón del Fraile','66003'),(1594,17,'Privadas de las Villas','66003'),(1595,17,'Real de Capellanía','66004'),(1596,17,'Privalia García','66004'),(1597,17,'Paseo Del Nogal','66004'),(1598,17,'Paseo de las Torres','66004'),(1599,17,'Las Villas','66004'),(1600,17,'Valle de San Jose','66004'),(1601,17,'Valle de San José 2do Sector','66004'),(1602,17,'Sierra Real','66004'),(1603,17,'Las Arboledas','66004'),(1604,17,'Villas de los Nogales','66004'),(1605,17,'Urbi Villa del Prado','66004'),(1606,17,'Villas de San Martin','66005'),(1607,17,'Real de Villas de Garcia','66005'),(1608,17,'Torres de Garcia','66005'),(1609,17,'Cedral','66005'),(1610,17,'Las Palmas','66005'),(1611,17,'Fraile I','66005'),(1612,17,'El Fraile II','66005'),(1613,17,'Real de San Martin','66005'),(1614,17,'San Martin','66005'),(1615,17,'Morelos','66005'),(1616,17,'Benito Juárez','66005'),(1617,17,'Infonavit los Nogales','66005'),(1618,17,'Emiliano Zapata','66005'),(1619,17,'Nuevo Amanecer','66005'),(1620,17,'Fomorrey Sobrevilla','66005'),(1621,17,'San Jose','66005'),(1622,17,'Las Bugambilias','66006'),(1623,17,'Martin Gonzalez','66006'),(1624,17,'Colinas Del Rio','66006'),(1625,17,'Fomorrey Nogales I','66006'),(1626,17,'Balcones de García','66006'),(1627,17,'Misión del Norte','66006'),(1628,17,'División del Norte','66006'),(1629,17,'Valles del Mirador','66006'),(1630,17,'Alfonzo Martinez Dominguez','66006'),(1631,17,'Nogales II','66006'),(1632,17,'Paseo de Capellanía','66007'),(1633,17,'Riberas de Capellania','66007'),(1634,17,'Avance Popular','66007'),(1635,17,'Real de Minas','66008'),(1636,17,'Miguel Hidalgo','66008'),(1637,17,'La Cruz','66008'),(1638,17,'Nuevo Renacimiento','66008'),(1639,17,'Popular Jose Páez Garcia','66008'),(1640,17,'Valle San Felipe','66008'),(1641,17,'San Juan Bautista','66009'),(1642,17,'Los Encinos Residencial','66009'),(1643,17,'Rinconada','66010'),(1644,17,'Joya del Carrizal','66012'),(1645,17,'Residencial Santa Mónica','66012'),(1646,17,'Residencial Santa Elena','66012'),(1647,17,'Villazul','66012'),(1648,17,'Paseo de Lincoln','66013'),(1649,17,'Parque Industrial POLITEK','66017'),(1650,17,'Libramiento Arco Vial','66017'),(1651,17,'Emiliano Zapata','66020'),(1652,17,'La Soledad Estación','66020'),(1653,17,'La Gruta','66022'),(1654,17,'Mitras Poniente','66023'),(1655,17,'Mitras Poniente Bicentenario','66023'),(1656,17,'Parques Diamante','66023'),(1657,17,'Mitras Bicentenario Sector Reforma','66023'),(1658,17,'Rancho Mitras','66023'),(1659,17,'Villas Del Poniente','66023'),(1660,17,'Lomas de Garcia','66023'),(1661,17,'Arco Vial','66023'),(1662,17,'Paraje San José','66023'),(1663,17,'Ciudad Industrial Mitras','66023'),(1664,17,'Misión San Juan','66023'),(1665,17,'Valle de las Grutas','66023'),(1666,17,'Valle de Lincoln San José','66023'),(1667,17,'Los Parques Residencial','66023'),(1668,17,'Valle de Lincoln San Agustín','66023'),(1669,17,'Las Lomas','66024'),(1670,17,'Valle de San Blas','66025'),(1671,17,'Valle de Lincoln','66026'),(1672,17,'Santa Sofia','66027'),(1673,17,'Grutas de Villa de Garcia','66030'),(1674,17,'Las Brisas Residencial 1er Sector','66033'),(1675,17,'Cumbres Elite Premier','66035'),(1676,17,'Valle de Cumbres','66035'),(1677,17,'Ciudad Cumbres','66036'),(1678,17,'Cumbres Provenza','66036'),(1679,17,'Santa María','66037'),(1680,17,'La Cruz','66040'),(1681,17,'Icamole','66042'),(1682,19,'Villa Alta','66050'),(1683,19,'Miravista II','66050'),(1684,19,'Miravista 3er Sector','66050'),(1685,19,'Jardines Del Canada','66050'),(1686,19,'Ricardo Flores Magón Infonavit I','66050'),(1687,19,'Rinconada Flores Magón Infonavit II','66050'),(1688,19,'Encinas las Piedra','66050'),(1689,19,'Miravista I','66050'),(1690,19,'La Cuchilla','66050'),(1691,19,'Don Lalo','66050'),(1692,19,'Gral. Escobedo Centro','66050'),(1693,19,'Rincón de Miravista','66050'),(1694,19,'Del Valle','66050'),(1695,19,'Los Saldañas','66050'),(1696,19,'Privadas Diamante','66050'),(1697,19,'Los Elizondo','66050'),(1698,19,'Jardines de Escobedo II','66050'),(1699,19,'Shalom','66050'),(1700,19,'Torres Diamante','66050'),(1701,19,'Los Eucaliptos','66050'),(1702,19,'Ricardo Flores Magón Infonavit III','66050'),(1703,19,'Las Encinas','66050'),(1704,19,'Residencial Encinas','66050'),(1705,19,'Residencial las Quintas','66050'),(1706,19,'Jardines Escobedo I','66051'),(1707,19,'Plaza Sol','66051'),(1708,19,'Los Altos','66052'),(1709,19,'Niños Héroes','66052'),(1710,19,'Unión de Alfareros','66052'),(1711,19,'Rio Pesquería Poniente','66052'),(1712,19,'Portal de la Hacienda','66052'),(1713,19,'Jardines de la Reyna','66052'),(1714,19,'Fernando Amilpa Predio','66052'),(1715,19,'Balcones Del Norte 2do Sector','66052'),(1716,19,'Sócrates Rizzo Unión Comerciantes','66052'),(1717,19,'Los Olivos','66052'),(1718,19,'Puerta de Anáhuac','66052'),(1719,19,'Rio Pesquería Nuevas Puentes','66052'),(1720,19,'Balcones Del Norte 1er Sector','66052'),(1721,19,'Nueva Castilla','66052'),(1722,19,'Desarrollo Industrial GP Tecnocentro','66052'),(1723,19,'Rio Pesquería Norte','66052'),(1724,19,'Arboledas de Escobedo','66052'),(1725,19,'Rio Pesquería','66052'),(1726,19,'Ébanos y Nueva Esperanza','66052'),(1727,19,'Los Girasoles II','66053'),(1728,19,'Raul Caballero','66053'),(1729,19,'Belisario Dominguez','66053'),(1730,19,'Privadas de San José','66053'),(1731,19,'Los Nogales','66053'),(1732,19,'Privadas del Los Sauces','66053'),(1733,19,'Agropecuaria','66053'),(1734,19,'Chamizal','66053'),(1735,19,'Valle de Escobedo','66053'),(1736,19,'Rincón de Las Encinas','66053'),(1737,19,'Los Arcos','66053'),(1738,19,'San Jose de los Sauces','66053'),(1739,19,'Lázaro Cárdenas Agropecuaria Sur','66053'),(1740,19,'Anáhuac la Pergola','66054'),(1741,19,'Rancho El 15','66054'),(1742,19,'Haciendas del Canada','66054'),(1743,19,'La Encomienda','66054'),(1744,19,'Anáhuac Campoamor','66054'),(1745,19,'Puerta del Norte Fraccionamiento Residencial','66054'),(1746,19,'Ex Hacienda el Canada','66054'),(1747,19,'Roble Nuevo','66055'),(1748,19,'Lázaro Cárdenas Ampliación','66055'),(1749,19,'Felipe Carrillo Puerto II','66055'),(1750,19,'Felipe Carrillo Puerto','66055'),(1751,19,'California Fraccionamiento Primer Sector','66055'),(1752,19,'Privada Del Angel','66055'),(1753,19,'California 2do Sector','66055'),(1754,19,'Nexxus Residencial Sector Esmeralda','66055'),(1755,19,'Celestino Gasca','66055'),(1756,19,'Nexxus Residencial Sector Rubí','66055'),(1757,19,'Joyas de Anáhuac Sector Florencia','66055'),(1758,19,'Los Pinos','66055'),(1759,19,'Felipe Carrillo Puerto IV','66055'),(1760,19,'Villas de Escobedo II','66055'),(1761,19,'Nexxus Residencial Sector Platino','66055'),(1762,19,'Residencial Pinos','66055'),(1763,19,'Privadas Bougambilias','66055'),(1764,19,'Haciendas de Anáhuac I','66055'),(1765,19,'Felipe Carrillo Puerto III','66055'),(1766,19,'Insurgentes Infonavit','66055'),(1767,19,'Topo Grande IV','66055'),(1768,19,'Nexxus Residencial Sector Diamante','66055'),(1769,19,'Jolla de Anáhuac Sector Nápoles','66055'),(1770,19,'Villas Del Parque','66055'),(1771,19,'Parque Industrial Nexxus XXI','66055'),(1772,19,'Haciendas de Anáhuac II','66055'),(1773,19,'Jolla de Anáhuac Sector Venecia','66055'),(1774,19,'Nexxus Residencial Sector Zafiro','66055'),(1775,19,'Nexxus Residencial Sector Cristal','66055'),(1776,19,'Balcones de Anáhuac II','66056'),(1777,19,'Monterreal II','66056'),(1778,19,'Monterreal I','66056'),(1779,19,'Monterreal IV','66056'),(1780,19,'Monterreal VI','66056'),(1781,19,'Topo Grande','66056'),(1782,19,'Monterreal IX','66056'),(1783,19,'Guadalupe Victoria','66056'),(1784,19,'Hilario Ayala Predio','66056'),(1785,19,'Monterreal V','66056'),(1786,19,'Riberas de Girasoles 1 Sector','66056'),(1787,19,'Lomas de Escobedo I','66056'),(1788,19,'Valle de Girasoles','66056'),(1789,19,'Monterreal XI','66056'),(1790,19,'Monterreal XII','66056'),(1791,19,'Los Girasoles I','66056'),(1792,19,'Villas de Escobedo','66056'),(1793,19,'Balcones de Anáhuac I','66056'),(1794,19,'El Topito','66056'),(1795,19,'Monterreal III','66056'),(1796,19,'Lomas de Escobedo II','66056'),(1797,19,'Praderas de Girasoles','66056'),(1798,19,'Monterreal X','66056'),(1799,19,'Bosques Quebec','66056'),(1800,19,'Hacienda Escobedo','66057'),(1801,19,'Residencial Escobedo','66057'),(1802,19,'Monterreal Infonavit','66057'),(1803,19,'Novus Sendero','66057'),(1804,19,'Fuentes de Escobedo','66057'),(1805,19,'Nuestra Señora de Fátima','66057'),(1806,19,'La Loma','66058'),(1807,19,'Ex Hacienda Infonavit','66058'),(1808,19,'Lázaro Cárdenas','66058'),(1809,19,'Ucam','66058'),(1810,19,'Jardines de Escobedo III','66058'),(1811,19,'16 de Septiembre','66058'),(1812,19,'24 de Febrero','66058'),(1813,19,'Solidaridad','66058'),(1814,19,'Dirona Aduana Interior','66058'),(1815,19,'Los Girasoles III','66058'),(1816,19,'Las Hadas','66058'),(1817,19,'El Canadá','66058'),(1818,19,'Martires 36','66058'),(1819,19,'Las Malvinas','66058'),(1820,19,'Praderas de Topo Grande','66058'),(1821,19,'Lázaro Cárdenas','66058'),(1822,19,'Privadas de Anáhuac Sector Inglés','66059'),(1823,19,'Hacienda los Cantu 1er Sector','66059'),(1824,19,'Quintas de Anáhuac','66059'),(1825,19,'La Cantera Privada Residencial','66059'),(1826,19,'Cerradas de Anáhuac Sector Premier','66059'),(1827,19,'Paraje Anáhuac','66059'),(1828,19,'Valle Del Canada','66059'),(1829,19,'Privadas de Anáhuac Sector Irlandes','66059'),(1830,19,'La Cantera','66059'),(1831,19,'Privadas de Lindora','66059'),(1832,19,'Villas de Anáhuac Sector Alpes','66059'),(1833,19,'Hacienda los Cantu 2do Sector','66059'),(1834,19,'Himalaya Sector Niza','66059'),(1835,19,'El Centenario','66059'),(1836,19,'Misión de Anáhuac 1er Sector','66059'),(1837,19,'Cerradas de Anáhuac','66059'),(1838,19,'Privadas de Anáhuac Sector Francés','66059'),(1839,19,'Privadas del Canada','66059'),(1840,19,'Nexxus Residencial Sector Dorado','66059'),(1841,19,'Villas de Anáhuac','66059'),(1842,19,'Himalaya','66059'),(1843,19,'Privadas de Anáhuac Sector  Mediterráneo','66059'),(1844,19,'Privadas de Anáhuac Sector Español','66059'),(1845,19,'Calzadas Anáhuac','66059'),(1846,19,'Cerradas de Anáhuac Sector Contemporáneo','66059'),(1847,19,'Parque Industrial III','66061'),(1848,19,'Parque Industrial II','66061'),(1849,19,'Lomas de San Genaro','66061'),(1850,19,'Jardines de San Martin','66061'),(1851,19,'Fomerrey 52 Pedregal del Topo','66061'),(1852,19,'Pedregal de Escobedo','66061'),(1853,19,'San Martin','66061'),(1854,19,'La Isla','66062'),(1855,19,'Parque Industrial Periférico','66062'),(1856,19,'Gloria Mendiola','66062'),(1857,19,'Parque Industrial I','66062'),(1858,19,'Villas de San Francisco','66062'),(1859,19,'Paso Cucharas','66062'),(1860,19,'Nueva Escobedo Ampliación','66063'),(1861,19,'Balcones Del Rio','66063'),(1862,19,'5 de Mayo','66063'),(1863,19,'19 de Julio','66063'),(1864,19,'San Isidro','66063'),(1865,19,'Valle de San Francisco','66064'),(1866,19,'Nuevo Escobedo','66064'),(1867,19,'Portal del Fraile 1er Sector','66064'),(1868,19,'Las Flores','66064'),(1869,19,'La Concordia','66064'),(1870,19,'Los Vergeles','66064'),(1871,19,'Privadas de Camino Real','66064'),(1872,19,'Fomerrey La Unidad','66064'),(1873,19,'Nueva Esperanza Mzas 117 y 120','66064'),(1874,19,'18 de Octubre','66064'),(1875,19,'Nuevo Escobedo','66064'),(1876,19,'Ciudad San Marcos Sector Pionero','66064'),(1877,19,'Villas de San Martín 1er Etapa','66064'),(1878,19,'Villas de San Martín 2da Etapa','66064'),(1879,19,'Vida','66064'),(1880,19,'Fomerrey Santa Martha','66064'),(1881,19,'Portal del Fraile 4ta Sector','66064'),(1882,19,'Riveras de los Naranjos','66064'),(1883,19,'Colinas del Topo Ampliación','66065'),(1884,19,'Fomerrey 49 \"Colinas del Topo\"','66065'),(1885,19,'Eulalio Villarreal Ayala','66065'),(1886,19,'La Ilusión','66065'),(1887,19,'Serranías 2do Sector','66065'),(1888,19,'Eulalio Villarreal Ayala','66065'),(1889,19,'Fomerrey Santa Lucia','66065'),(1890,19,'Serranías 1er Sector','66065'),(1891,19,'Portal Valle de San Bernabe','66067'),(1892,19,'Los Nogales','66067'),(1893,19,'Los Angeles','66067'),(1894,19,'Alianza','66067'),(1895,19,'El Rosario','66067'),(1896,19,'Arcos Del Sol','66067'),(1897,19,'Naranjos','66067'),(1898,19,'Alianza','66067'),(1899,19,'San Gabriel','66067'),(1900,19,'Villas de San Bernabe','66067'),(1901,19,'Pedregal de San Agustín','66068'),(1902,19,'Los Alebrijes','66068'),(1903,19,'Santaluz','66070'),(1904,19,'Lomas de San Genaro 3er Sector','66070'),(1905,19,'Provileon','66070'),(1906,19,'Monte Horeb','66070'),(1907,19,'Villa de los Ayala','66070'),(1908,19,'Puerta Del Sol','66070'),(1909,19,'Bosques de Escobedo','66072'),(1910,19,'Progreso Paso Cucharas','66072'),(1911,19,'Hacienda los  Vergeles','66072'),(1912,19,'Brianzzas Residencial','66072'),(1913,19,'Hacienda Del Topo II','66072'),(1914,19,'Paso Cucharas II','66072'),(1915,19,'Cortijo los Ayala','66072'),(1916,19,'5to. Centenario','66072'),(1917,19,'Hacienda los Ayala','66072'),(1918,19,'Paseo Real','66072'),(1919,19,'Renacimiento','66072'),(1920,19,'Hacienda Del Topo I','66072'),(1921,19,'Lomas I','66073'),(1922,19,'San Genaro I','66073'),(1923,19,'Santa Julia','66073'),(1924,19,'San Genaro 3er Sector','66073'),(1925,19,'Lomas II','66073'),(1926,19,'San Genaro II','66073'),(1927,19,'Adelitas de Villa','66073'),(1928,19,'Los Girasoles IV','66073'),(1929,19,'Colinas de Anáhuac','66073'),(1930,19,'Fomerrey 9 Solidaridad','66073'),(1931,19,'Fomerrey Lomas de Aztlán','66073'),(1932,19,'Mira Sur 1','66074'),(1933,19,'Mira Sur','66074'),(1934,19,'Fomerrey 36 Raul Caballero','66075'),(1935,19,'Andres Caballero Moreno Agrop','66080'),(1936,19,'Zona Industrial','66083'),(1937,19,'Lázaro Cárdenas Agropecuaria del Norte','66084'),(1938,19,'Alianza Real','66084'),(1939,19,'Palmiras','66084'),(1940,19,'Arco Vial Fomerrey Agropecuaria','66084'),(1941,19,'Alianza Real Sector Yucatán','66084'),(1942,19,'Alianza Real Sector Oaxaca','66084'),(1943,19,'San Miguel','66085'),(1944,19,'Ampliación Monclova','66085'),(1945,19,'Praderas de San Francisco Sector 2','66085'),(1946,19,'San Miguel de los Garza (La Luz)','66085'),(1947,19,'Praderas de San Francisco','66085'),(1948,19,'Monclova','66085'),(1949,19,'Monclovita','66085'),(1950,19,'Valle de San Miguel','66085'),(1951,19,'Portal de Piedra','66085'),(1952,48,'Privada La Bolita','66100'),(1953,48,'Privada Antigua','66100'),(1954,48,'La Fama','66100'),(1955,48,'Privada Acueducto','66100'),(1956,48,'Cimas del Pte','66110'),(1957,48,'Raul Salinas','66114'),(1958,48,'Cima de las Mitras','66114'),(1959,48,'Raul Salinas','66114'),(1960,48,'Cerro de las Mitras','66114'),(1961,48,'Jardín de las Mitras','66115'),(1962,48,'La Fama 4','66115'),(1963,48,'Fama V','66116'),(1964,48,'Fama II','66116'),(1965,48,'Fama IV','66116'),(1966,48,'La Fama 1','66117'),(1967,48,'Fama III','66118'),(1968,48,'Eugenio Canavati CTM','66118'),(1969,48,'Carlos Salinas de Gortari','66119'),(1970,48,'Lomas de La Fama','66119'),(1971,48,'Lomas Del Mirador','66119'),(1972,48,'Arboledas de las Mitras','66119'),(1973,48,'San Humberto','66120'),(1974,48,'Los Portales II','66120'),(1975,48,'Los Portales','66120'),(1976,48,'Los Portales I','66120'),(1977,48,'Balcones de San Humberto','66120'),(1978,48,'Villas de San Humberto','66120'),(1979,48,'Villas los Portales','66120'),(1980,48,'Provivienda del Pte 1 Sec','66129'),(1981,48,'Privadas del Poniente','66129'),(1982,48,'Unión','66129'),(1983,48,'Prados de San Jorge','66129'),(1984,48,'Provivienda del Pte 2 Sec','66129'),(1985,48,'Coop la Unión','66129'),(1986,48,'La Ermita','66129'),(1987,48,'Prov del Pte 3 Sec','66129'),(1988,48,'Prados de San Jose','66129'),(1989,48,'Indeco','66130'),(1990,48,'Fomerrey 2','66139'),(1991,48,'Rincón de las Mitras','66139'),(1992,48,'Jose Lopez Portillo','66140'),(1993,48,'Industrial Monte de los Olivos','66143'),(1994,48,'Residencial Cuauhtémoc','66144'),(1995,48,'Hacienda los Portales','66145'),(1996,48,'Santa Magdalena','66147'),(1997,48,'Trabajadores','66149'),(1998,48,'Parques la Fama','66150'),(1999,48,'Los Treviño','66150'),(2000,48,'Privada Treviño','66150'),(2001,48,'Cooperativa Del Norte','66159'),(2002,48,'Benito Juárez','66160'),(2003,48,'Valle de La Sierra','66165'),(2004,48,'Jardines de La Fama','66165'),(2005,48,'Campania I','66165'),(2006,48,'Privadas Ondara','66165'),(2007,48,'Campania','66166'),(2008,48,'La Española','66167'),(2009,48,'La Concordia','66168'),(2010,48,'Efimex','66169'),(2011,48,'Protexa','66170'),(2012,48,'Montenegro','66179'),(2013,48,'Jesús M Garza','66180'),(2014,48,'Las Palmas','66187'),(2015,48,'La Fraternidad','66188'),(2016,48,'Residencial Olinca','66188'),(2017,48,'Cantizal','66188'),(2018,48,'La Barrica','66189'),(2019,48,'Lomas de San Isidro','66190'),(2020,48,'San Isidro','66190'),(2021,48,'Nueva Fortaleza','66195'),(2022,48,'Los Cenizos','66196'),(2023,48,'Valle Poniente Sector Olinca','66196'),(2024,48,'Residencial Cordillera','66196'),(2025,48,'Hacienda La Banda','66196'),(2026,48,'La Banda','66196'),(2027,48,'Vía Cordillera','66196'),(2028,48,'Miguel Hidalgo','66196'),(2029,48,'El Aguacatal','66197'),(2030,48,'Loma Blanca','66197'),(2031,48,'Las Montañas','66197'),(2032,48,'Huasteca Real','66197'),(2033,48,'La Fortaleza','66198'),(2034,48,'Idelfonso Vázquez','66199'),(2035,47,'San Pedro Garza Garcia Centro','66200'),(2036,47,'San Pedro 400','66210'),(2037,47,'San Pedro 400 Ampliación Norte','66210'),(2038,47,'Unidad Habitacional San Pedro','66210'),(2039,47,'La Leona','66210'),(2040,47,'El Obispo','66214'),(2041,47,'El Obispo 2','66214'),(2042,47,'Villa del Obispo','66214'),(2043,47,'San Pedro','66215'),(2044,47,'Vista Montaña 1er Sector','66216'),(2045,47,'Vista Montaña 2 Sector','66216'),(2046,47,'Vista Montaña 3 Sector','66216'),(2047,47,'Zona Clouhtier','66216'),(2048,47,'El Obispo','66216'),(2049,47,'Zona Industrial','66217'),(2050,47,'Plan de Ayala','66217'),(2051,47,'Lucio Blanco 1er Sector','66218'),(2052,47,'Valle del Seminario 1 Sector','66218'),(2053,47,'Lucio Blanco 2do Sector','66218'),(2054,47,'Echeverría','66218'),(2055,47,'Valle del Seminario 2 Sector','66218'),(2056,47,'Revolución 3er Sector','66219'),(2057,47,'Revolución 2do Sector','66219'),(2058,47,'Revolución 4to Sector','66219'),(2059,47,'Revolución 1er Sector','66219'),(2060,47,'Revolución 5to Sector','66219'),(2061,47,'Zona Revolución','66219'),(2062,47,'Jardines Del Valle','66220'),(2063,47,'Del Valle','66220'),(2064,47,'Zona los Sabinos','66224'),(2065,47,'Fuentes del David','66224'),(2066,47,'Zona Fuentes del Valle','66224'),(2067,47,'Zona Santa Bárbara Poniente','66224'),(2068,47,'Fuentes del Valle','66224'),(2069,47,'Fuentes del Valle Sector Colinas','66224'),(2070,47,'Residencial Santa Barbara la Cripta','66224'),(2071,47,'Zona del Valle','66225'),(2072,47,'La Joya','66225'),(2073,47,'Valle Del Mezquite','66226'),(2074,47,'Bugambilias','66226'),(2075,47,'Las Capillas','66227'),(2076,47,'San Francisco','66227'),(2077,47,'Los Olivos','66227'),(2078,47,'Residencial San Carlos','66228'),(2079,47,'Zona de Los Callejones','66228'),(2080,47,'La Cima 1er Sector','66230'),(2081,47,'Villa Campanario','66230'),(2082,47,'Zona la Cima','66230'),(2083,47,'Codornices Aldama','66230'),(2084,47,'La Ventana','66230'),(2085,47,'Jardines Coloniales 2 Sector','66230'),(2086,47,'Zona Rosario','66230'),(2087,47,'Las Codornices','66230'),(2088,47,'Zona Palo Blanco','66230'),(2089,47,'La Cúspide','66230'),(2090,47,'San José','66230'),(2091,47,'Jardines Coloniales 1er Sector','66230'),(2092,47,'San Gabriel','66230'),(2093,47,'Prados de La Sierra','66230'),(2094,47,'Rincón Colonial','66230'),(2095,47,'La Finca','66230'),(2096,47,'Privada Versalles','66230'),(2097,47,'Jardines Coloniales 3er Sector','66230'),(2098,47,'San Pedro','66230'),(2099,47,'Condominio','66230'),(2100,47,'Las Uvas','66230'),(2101,47,'Misión Del Valle','66230'),(2102,47,'Zona Hacienda San Francisco','66230'),(2103,47,'Las Verandas','66230'),(2104,47,'Residencial Los Cubos','66230'),(2105,47,'Morelos','66230'),(2106,47,'Zona Valle Poniente','66233'),(2107,47,'Las Sendas Andalucía','66233'),(2108,47,'Misión del Valle 3','66233'),(2109,47,'Santa Elena','66233'),(2110,47,'Las Sendas Galicias','66233'),(2111,47,'Villa Montaña Campestre','66234'),(2112,47,'La Cima 3er Sector','66235'),(2113,47,'La Cima 2do Sector','66235'),(2114,47,'Villa Montaña 2 Sector','66235'),(2115,47,'Los Olmos','66235'),(2116,47,'Villa Montaña 1er Sector','66235'),(2117,47,'Residencial Palo Blanco','66236'),(2118,47,'Jardines de Mirasierra','66236'),(2119,47,'Palo Blanco','66236'),(2120,47,'Villas de Santa Bárbara','66236'),(2121,47,'Palo Blanco Sector El Edén','66236'),(2122,47,'Los Sauces 1er Sector','66237'),(2123,47,'Los Sauces 2 Sector','66237'),(2124,47,'Mirador de Vasconcelos','66238'),(2125,47,'Lucio Blanco 3er Sector','66238'),(2126,47,'Rincón de San Francisco','66238'),(2127,47,'Zona los Sauces','66238'),(2128,47,'Jesús M Garza','66238'),(2129,47,'Valle de Vasconcelos','66238'),(2130,47,'Lindavista','66238'),(2131,47,'Lázaro Garza Ayala','66238'),(2132,47,'Zona Mirador Vazconcelos','66238'),(2133,47,'Volkswagen','66239'),(2134,47,'Rincón de Corregidora','66239'),(2135,47,'Hacienda de los Callejones','66239'),(2136,47,'Los Pinos 2 Sector (Asentamiento Irregular)','66239'),(2137,47,'Residencial las Amapas','66239'),(2138,47,'Los Pinos 1er Sector','66239'),(2139,47,'Nemesio Garcia Naranjo','66239'),(2140,47,'Mirasierra 1er Sector','66240'),(2141,47,'Mirasierra 2do Sector','66240'),(2142,47,'Zona La Ventana','66240'),(2143,47,'La Montaña','66240'),(2144,47,'Provivienda','66240'),(2145,47,'Tampiquito','66240'),(2146,47,'La Cooperativa','66240'),(2147,47,'Mirasierra 5to Sector','66240'),(2148,47,'Rincón de la Montaña 2 Sector','66240'),(2149,47,'Lomas de Tampiquito','66240'),(2150,47,'La Barranca','66240'),(2151,47,'Olímpico','66240'),(2152,47,'Privada San Andrés','66240'),(2153,47,'Rincón de La Montaña 1er Sector','66240'),(2154,47,'Mirasierra 4to Sector','66240'),(2155,47,'Rincón de la Montaña 3 Sector','66240'),(2156,47,'Zona Mirasierra','66240'),(2157,47,'Mirasierra 3er Sector','66240'),(2158,47,'Zona Valle del Mezquite','66240'),(2159,47,'Lomas del Bosque','66244'),(2160,47,'Capistrano','66244'),(2161,47,'Privada 20 de Noviembre','66244'),(2162,47,'Los Fresnos','66244'),(2163,47,'Lomas Valle Sector Convento','66244'),(2164,47,'Barranca Del Pedregal','66245'),(2165,47,'Hacienda Del Valle','66246'),(2166,47,'Hacienda El Rosario','66247'),(2167,47,'Tampiquito','66247'),(2168,47,'La Parvada','66247'),(2169,47,'Mansión Del Rosario','66247'),(2170,47,'Hacienda las Campanas','66247'),(2171,47,'Cerrada Moralillo','66249'),(2172,47,'Villas de Terrasol','66249'),(2173,47,'Moralillo','66249'),(2174,47,'Bosques del Valle 1er Sector','66250'),(2175,47,'Bosques del Valle 3er Sector','66250'),(2176,47,'Privada Río Ebro','66250'),(2177,47,'Privada Sierra Madre','66250'),(2178,47,'Zona Privada Río Tamazunchale','66250'),(2179,47,'Fátima','66250'),(2180,47,'Valle de Chipinque','66250'),(2181,47,'Bosques del Valle 5to Sector','66250'),(2182,47,'Bosques del Valle Ampliación 5 Sector','66250'),(2183,47,'Jerónimo Siller','66250'),(2184,47,'Bosques del Valle 2do Sector','66250'),(2185,47,'Bosques del Valle 4to Sector','66250'),(2186,47,'Zona Jerónimo Siller','66250'),(2187,47,'Carrizalejo','66254'),(2188,47,'Lomas Del Valle','66256'),(2189,47,'Del Valle Sector Fátima','66257'),(2190,47,'Zona Fátima','66257'),(2191,47,'Cortijo Del Valle','66259'),(2192,47,'Gómez Morin','66259'),(2193,47,'Zona la Alianza','66259'),(2194,47,'Zona Antigua Exhacienda Carrizalejo','66259'),(2195,47,'Zona Carrizalejo','66259'),(2196,47,'La Cañada','66259'),(2197,47,'Rincón de Carrizalejo','66259'),(2198,47,'Corporativo Proser','66260'),(2199,47,'Residencial San Agustín 2 Sector','66260'),(2200,47,'Residencial Canteras','66260'),(2201,47,'Residencial San Agustin 1 Sector','66260'),(2202,47,'Jardines de Campestre','66260'),(2203,47,'Ampliación Canteras','66260'),(2204,47,'Portal de Santa Engracia','66260'),(2205,47,'San Mateo','66260'),(2206,47,'Del Valle Oriente','66260'),(2207,47,'Hacienda de La Sierra','66260'),(2208,47,'Ampliación Valle del Mirador','66260'),(2209,47,'Zona San Agustín','66260'),(2210,47,'Zona Campestre','66263'),(2211,47,'Zona Santa Engracia','66263'),(2212,47,'Jardines del Campestre','66264'),(2213,47,'Valle Del Campestre','66265'),(2214,47,'Zona la Diana','66265'),(2215,47,'Residencial Santa Bárbara 1 Sector','66266'),(2216,47,'Mirador Del Campestre','66266'),(2217,47,'Zona Loma Larga Oriente','66266'),(2218,47,'Residencial Frida Kahalo','66266'),(2219,47,'Verona','66266'),(2220,47,'La Admiranza','66266'),(2221,47,'Zona Loma Blanca Poniente','66266'),(2222,47,'Vista Real','66266'),(2223,47,'Zona Valle Oriente Norte','66266'),(2224,47,'Residencial Santa Bárbara 2 Sector','66266'),(2225,47,'Los Arcángeles','66266'),(2226,47,'La Diana','66266'),(2227,47,'Villas de San Agustin','66266'),(2228,47,'Cojunto Habitacional Renzo','66266'),(2229,47,'Santa Engracia','66267'),(2230,47,'Privada Santa Engracia','66268'),(2231,47,'Del Valle Sect Norte','66268'),(2232,47,'Valle de Santa Engracia','66268'),(2233,47,'Villas de Santa Engracia','66268'),(2234,47,'Zona Valle Santa Engracia','66268'),(2235,47,'Del Valle Sect Oriente','66269'),(2236,47,'San Patricio 1 Sector','66270'),(2237,47,'Zona Tampiquito','66270'),(2238,47,'Zona Lomas de San Agustín','66270'),(2239,47,'Colinas de San Agustin','66270'),(2240,47,'Colorines 3er Sector','66270'),(2241,47,'Veredalta','66270'),(2242,47,'Zona San Patricio 4 Sector','66270'),(2243,47,'Colorines 1er Sector','66270'),(2244,47,'San Patricio 4 Sector','66270'),(2245,47,'Residencial Galeana','66270'),(2246,47,'Colorines 4to Sector','66270'),(2247,47,'San Patricio 2 Sector','66270'),(2248,47,'San Patricio 3 Sector','66270'),(2249,47,'San Agustin Campestre','66270'),(2250,47,'Colorines 5to Sector','66270'),(2251,47,'Misión San Patricio','66270'),(2252,47,'Colorines 2do Sector','66270'),(2253,47,'Zona San Patricio 3 Sector','66270'),(2254,47,'Villas de Aragón','66273'),(2255,47,'Privada Gruta','66273'),(2256,47,'Corporativo Santa Engracia 2 Sector','66273'),(2257,47,'Corporativo Santa Engracia 1 Sector','66273'),(2258,47,'Zona Montebello','66273'),(2259,47,'Jardines de San Agustin 1 Sector','66274'),(2260,47,'Zona Antigua Exhacienda San Agustín','66274'),(2261,47,'El Secreto','66274'),(2262,47,'Jardines de San Agustín 2 Sector','66274'),(2263,47,'Ampliación Jardines de San Agustín 3er Sector','66274'),(2264,47,'Jardines de San Agustín 3 Sector','66274'),(2265,47,'Mesa de la Corona','66275'),(2266,47,'Vistas del Valle','66275'),(2267,47,'Villa las Palmas','66276'),(2268,47,'Hacienda San Agustin','66276'),(2269,47,'Zona Hacienda San Agustín','66276'),(2270,47,'Zona Lomas del Campestre','66276'),(2271,47,'La Encantada','66277'),(2272,47,'Santa Cruz','66277'),(2273,47,'Las Ceibas','66277'),(2274,47,'Privada Real de San Agustín','66277'),(2275,47,'Turquesa','66277'),(2276,47,'Privada San Roberto','66277'),(2277,47,'Balcones de San Agustin','66278'),(2278,47,'Las Privanzas Primero','66278'),(2279,47,'Lomas de San Agustín 2 Sector','66278'),(2280,47,'Misión de San Agustín','66278'),(2281,47,'Privanzas','66278'),(2282,47,'Privanzas Pamplona','66278'),(2283,47,'Real de San Agustin','66278'),(2284,47,'Corporativo Prodesa','66278'),(2285,47,'Privanza Fundadores','66278'),(2286,47,'Las Querenzas','66278'),(2287,47,'Lomas del Campestre 2 Sector','66278'),(2288,47,'Privanza Alicante','66278'),(2289,47,'Privanzas Burdeos','66278'),(2290,47,'Flor de Mayo','66278'),(2291,47,'Las Privanzas 3 Sector Segunda Etapa','66278'),(2292,47,'Lomas de San Agustín 1er Sector','66278'),(2293,47,'Rincón de las Garzas','66278'),(2294,47,'Privanzas Martinica','66278'),(2295,47,'Rincón del Campestre','66278'),(2296,47,'Los Amates','66278'),(2297,47,'Valle de San Agustin','66278'),(2298,47,'Parque Corporativo Uccaly','66278'),(2299,47,'Los Quetzales','66278'),(2300,47,'Alto Eucalipto','66278'),(2301,47,'Zona San Agustín Campestre','66278'),(2302,47,'Privanza Venecia','66278'),(2303,47,'Privanzas 4 Sector 1 Etapa','66278'),(2304,47,'Privanzas Córcega','66278'),(2305,47,'Privanzas Marsella','66278'),(2306,47,'Privanzas Niza','66278'),(2307,47,'La Muralla','66278'),(2308,47,'Real Del Valle','66278'),(2309,47,'Las Privanzas Segundo','66278'),(2310,47,'El Refugio','66278'),(2311,47,'Balcones Del Campestre','66278'),(2312,47,'Alto Jazmín','66278'),(2313,47,'Zona Valle Oriente Sur','66278'),(2314,47,'Los Rincones','66278'),(2315,47,'Privanzas Alejandría','66278'),(2316,47,'Lomas del Campestre 1er Sector','66278'),(2317,47,'Santa Fe','66278'),(2318,47,'Colonial San Agustin','66278'),(2319,47,'Ampliación Lomas del Campestre','66278'),(2320,47,'Privanza Toledo','66278'),(2321,47,'Villas Carmel','66278'),(2322,47,'Las Calzadas','66278'),(2323,47,'Colonia Valle Oriente Sur','66278'),(2324,47,'Privanzas Mónaco','66278'),(2325,47,'Antigua Hacienda San Agustin','66278'),(2326,47,'Privada Lomas de San Agustin','66278'),(2327,47,'Lomas de San Agustín 3 Sector','66278'),(2328,47,'Punto Central','66279'),(2329,47,'Villa Del Pedregal','66280'),(2330,47,'Bosques de La Sierra 2do Sector','66280'),(2331,47,'Pedregal Del Valle','66280'),(2332,47,'Bosques de La Sierra 1er Sector','66280'),(2333,47,'Bosques de La Sierra 3er Sector','66280'),(2334,47,'Colinas de La Sierra Madre','66280'),(2335,47,'Balcones Del Valle','66280'),(2336,47,'Zona Bosques de la Sierra','66280'),(2337,47,'Villas Del Pedregal','66280'),(2338,47,'Villas Crisantemo','66280'),(2339,47,'Sierra Nevada','66285'),(2340,47,'Villas del Valle','66285'),(2341,47,'Zona Colinas Sierra Madre','66285'),(2342,47,'Zona Valle San Ángel','66285'),(2343,47,'Zona Bosques del Valle','66285'),(2344,47,'El Santuario','66286'),(2345,47,'Colonial La Sierra','66286'),(2346,47,'Residencial Sierra Del Valle','66286'),(2347,47,'Zona el Santuario','66286'),(2348,47,'Zona Pedregal del Valle','66287'),(2349,47,'Lomas Del Rosario','66287'),(2350,47,'Valle de San Ángel Sect Jardines','66290'),(2351,47,'Valle de San Ángel Sect Español','66290'),(2352,47,'Bosques de San Ángel Sector Palmillas','66290'),(2353,47,'Valle de San Angel Sect Frances','66290'),(2354,47,'Valle de San Ángel Sect Mexicano','66290'),(2355,47,'Olinalá','66290'),(2356,47,'Loma Blanca','66290'),(2357,47,'Valle de San Ángel Rincón Francés','66290'),(2358,47,'Joya del Venado','66295'),(2359,47,'Zona Alpino','66295'),(2360,47,'Hacienda de Carrizalejo','66295'),(2361,47,'Lomas de San Angel','66295'),(2362,47,'Comercial Alpino Chipinque','66295'),(2363,47,'Colinas de San Ángel 2do Sector','66296'),(2364,47,'Colinas de San Angel 1er Sector','66296'),(2365,47,'Villa Chipinque','66297'),(2366,47,'Villas La Rivera','66297'),(2367,47,'La Joya de La Corona','66297'),(2368,47,'Residencial Chipinque 4 Sector','66297'),(2369,47,'Las Alondras','66297'),(2370,47,'Zona Loma Blanca','66297'),(2371,47,'Los Encinos','66297'),(2372,47,'Residencial Chipinque 1 Sector','66297'),(2373,47,'Residencial Chipinque 3 Sector','66297'),(2374,47,'Residencial Chipinque 2 Sector','66297'),(2375,47,'Zona Residencia Chipinque','66297'),(2376,48,'Santa Catarina Centro','66350'),(2377,48,'El Castillo','66350'),(2378,48,'Res. Panorámica','66350'),(2379,48,'Santa Martha I','66350'),(2380,48,'Santa Martha II','66350'),(2381,48,'Cerrada del Valle','66350'),(2382,48,'Lázaro Cárdenas','66350'),(2383,48,'Mirador de Santa Catarina','66350'),(2384,48,'Cerrada del Valle Plus','66350'),(2385,48,'Nueva Santa Catarina','66350'),(2386,48,'Real del Valle 1 Sector','66350'),(2387,48,'Real del Valle 2 Sector','66350'),(2388,48,'El Paraíso','66353'),(2389,48,'Residencial la Huasteca','66353'),(2390,48,'Priv San Patricio','66353'),(2391,48,'Infonavit La Huasteca Sexta Sección','66354'),(2392,48,'Privadas la Huasteca','66354'),(2393,48,'Ventanas de La Huasteca','66354'),(2394,48,'Enrique Rangel','66354'),(2395,48,'Inf Santa Catarina','66354'),(2396,48,'Misión de la Huasteca','66354'),(2397,48,'Loma Pelona','66354'),(2398,48,'Inf la Huasteca','66354'),(2399,48,'La Huasteca 2o Sect','66354'),(2400,48,'Mirador de la Huasteca','66354'),(2401,48,'La Huasteca Infonavit 4o Sect','66354'),(2402,48,'Los Vitrales','66354'),(2403,48,'Bosques de La Huasteca','66354'),(2404,48,'La Huasteca 1er Sect','66354'),(2405,48,'La Huasteca 3','66354'),(2406,48,'Infonavit La Huasteca Quinta Sección','66354'),(2407,48,'Infonavit La Huasteca Séptima Sección','66354'),(2408,48,'Pedregal de La Huasteca','66354'),(2409,48,'Priv Sierra Madre','66354'),(2410,48,'Parque Industrial Atlas','66355'),(2411,48,'Privada 10 de Mayo','66356'),(2412,48,'Alfonso Martinez Dominguez','66356'),(2413,48,'Praderas Del Castillo','66356'),(2414,48,'Paseo de La Sierra','66357'),(2415,48,'Balcones de Santa Catarina (fomerrey 134)','66357'),(2416,48,'Fomerrey 134','66357'),(2417,48,'Hacienda de Santa Catarina','66357'),(2418,48,'Cumbres de Santa Catarina','66358'),(2419,48,'Puerta Del Sol','66358'),(2420,48,'Cumbres de Santa Catarina 2 Sec','66358'),(2421,48,'Luis Echeverría Alvarez','66358'),(2422,48,'Zimex','66358'),(2423,48,'Paseo de Santa Catarina','66358'),(2424,48,'Gral Naranjo','66358'),(2425,48,'Las Catarinas','66358'),(2426,48,'Zimix Sección Leones','66358'),(2427,48,'Zimix Sur','66358'),(2428,48,'Zimix Norte','66358'),(2429,48,'Cumbres de Santa Catarina 3 Sec','66358'),(2430,48,'Pedregal de Santa Catarina','66358'),(2431,48,'Cumbres de Santa Catarina 1 Sec','66358'),(2432,48,'Residencial de La Sierra','66358'),(2433,48,'Cordilleras Del Virrey','66358'),(2434,48,'Zimix Amp','66358'),(2435,48,'Portal de Santa Catarina','66358'),(2436,48,'Torres de Santa Catarina','66359'),(2437,48,'Privadas de La Montaña','66359'),(2438,48,'Mirador de las Mitras','66359'),(2439,48,'Inf Lomas de Santa Catarina','66359'),(2440,48,'Universidad Tecnológica de Santa Catarina','66359'),(2441,48,'Residencial Santa Cecilia I','66359'),(2442,48,'Las Anacuas','66359'),(2443,48,'Lomas Altas','66359'),(2444,48,'Bosques de Santa Catarina','66359'),(2445,48,'Lomas de Santa Catarina','66359'),(2446,48,'Prados de Santa Catarina','66359'),(2447,48,'La Puerta de La Huasteca','66359'),(2448,48,'Residencial Santa Cecilia II','66359'),(2449,48,'Robles de Santa Catarina','66359'),(2450,48,'Inf. Adolfo López Mateos','66360'),(2451,48,'Ind Unidad Nacional','66360'),(2452,48,'Industrial Monte de los Olivos','66360'),(2453,48,'Hacienda San Jose','66360'),(2454,48,'Industrial Fico','66360'),(2455,48,'Adolfo Lopez Mateos','66360'),(2456,48,'La Joya','66360'),(2457,48,'Misión Santa Catarina','66360'),(2458,48,'Inf Cuauhtémoc Infonavit','66360'),(2459,48,'Residencial Cuauhtémoc','66360'),(2460,48,'Colinas de Santa Catarina','66360'),(2461,48,'El Obispo JOMYCO','66360'),(2462,48,'Jardines de Santa Catarina 1','66362'),(2463,48,'Paseo del Parque','66362'),(2464,48,'Privada 5 de Mayo','66362'),(2465,48,'Paseo Del Prado','66362'),(2466,48,'Jardines de Santa Catarina 2','66362'),(2467,48,'El Molino','66362'),(2468,48,'Indalecio Vázquez','66362'),(2469,48,'Jardines de Santa Catarina','66362'),(2470,48,'Rincón de las Huertas','66362'),(2471,48,'Bosques del Poniente','66362'),(2472,48,'Ex Hacienda los Arredondos','66362'),(2473,48,'Pio XII','66362'),(2474,48,'Villas del Poniente Las Granadas','66362'),(2475,48,'Valle de Santa Cruz','66362'),(2476,48,'Residencial Arvore','66362'),(2477,48,'Mercado de Abastos Poniente','66362'),(2478,48,'Labores Nuevas','66363'),(2479,48,'El Escorial','66363'),(2480,48,'Senderos','66363'),(2481,48,'Praderas de Santa Catarina','66364'),(2482,48,'Unión del Noreste','66364'),(2483,48,'Villas Del Mirador','66365'),(2484,48,'Rincón de La Huasteca','66365'),(2485,48,'Prados Del Sol','66365'),(2486,48,'Mártires de Cananea','66365'),(2487,48,'Prados Del Rey','66365'),(2488,48,'Tepeyac','66366'),(2489,48,'Provivienda Tepeyac','66366'),(2490,48,'Huasteca del Valle I','66367'),(2491,48,'Residencial de Santa Catarina','66367'),(2492,48,'El Frutal','66367'),(2493,48,'Del Poniente','66367'),(2494,48,'Parque Industrial Milenium','66367'),(2495,48,'El Obispo','66367'),(2496,48,'Parque Ind del Pte Kalos','66367'),(2497,48,'T.A.D. Pemex Refineria','66367'),(2498,48,'Parque Industrial Pedreras','66367'),(2499,48,'Industrial Martel de Santa Catarina','66367'),(2500,48,'Parque Industrial La Esperanza','66367'),(2501,48,'Bosques la Huasteca','66367'),(2502,48,'Norberto Aguirre','66367'),(2503,48,'La Puerta','66367'),(2504,48,'Industrial Marfer','66367'),(2505,48,'Privadas de Santa Catarina Sector Elite','66367'),(2506,48,'Unidad Nacional II','66367'),(2507,48,'Privadas de Santa Catarina','66367'),(2508,48,'Los Viñedos','66367'),(2509,48,'Hacienda el Palmar','66367'),(2510,48,'Industrial Santa Catarina','66367'),(2511,48,'Puerta de las Mitras','66367'),(2512,48,'Parque Industrial los Nogales','66367'),(2513,48,'Industrial las Anacuas','66367'),(2514,48,'Rincón de las Palmas','66368'),(2515,48,'Industrial las Palmas','66368'),(2516,48,'Rincón Del Poniente','66368'),(2517,48,'San Francisco','66368'),(2518,48,'Micro Empresarios','66368'),(2519,48,'Rincón de La Villa','66368'),(2520,48,'Real de Santa Catarina','66368'),(2521,48,'Lomas del Pte','66369'),(2522,48,'Visión de la Huasteca','66369'),(2523,48,'La Conquista','66369'),(2524,48,'San Gilberto','66369'),(2525,48,'Las Sombrillas','66369'),(2526,48,'Las Almenas','66369'),(2527,48,'Misión de las Villas','66369'),(2528,48,'Industrias del Poniente','66370'),(2529,48,'27 de Mayo','66373'),(2530,48,'Virginia Tafich','66374'),(2531,48,'Vista a la Sierra','66375'),(2532,48,'29 de Julio','66375'),(2533,48,'El Lechugal','66376'),(2534,48,'Santa Julia','66376'),(2535,48,'Santa Catalina','66376'),(2536,48,'Las Sierras','66377'),(2537,48,'San Gregorio','66377'),(2538,48,'Aurora','66378'),(2539,48,'Aurorita','66378'),(2540,48,'Desarrollo Industrial Monterrey','66390'),(2541,48,'Parque Industrial Milimex','66390'),(2542,46,'San Nicolás de los Garza Centro','66400'),(2543,46,'Secretaria de Hacienda y Crédito Publico 141','66409'),(2544,46,'Las Alamedas','66410'),(2545,46,'México Lindo','66410'),(2546,46,'Miraflores Sector 3','66410'),(2547,46,'Nicolás Bravo Sect 2','66410'),(2548,46,'Ignacio Ramirez','66410'),(2549,46,'Constituyentes Del 17','66410'),(2550,46,'Miraflores Sector 1','66410'),(2551,46,'La Enramada','66410'),(2552,46,'Benito Juárez','66410'),(2553,46,'Nicolás Bravo','66410'),(2554,46,'Miraflores Sector 2','66410'),(2555,46,'Privada Sendero Anáhuac','66410'),(2556,46,'Centro de Desarrollo Comunitario CEDECO','66412'),(2557,46,'San Bartolo','66413'),(2558,46,'Bosques Del Roble','66413'),(2559,46,'El Naranjal','66413'),(2560,46,'Bosques del Roble Sector 2','66413'),(2561,46,'Rincón del Roble','66413'),(2562,46,'Huertas de San Bartolo','66413'),(2563,46,'San Isidro','66413'),(2564,46,'Roble San Nicolás Sector 2','66414'),(2565,46,'Roble San Nicolás Sector 3','66414'),(2566,46,'El Fundador','66414'),(2567,46,'Residencial El Roble','66414'),(2568,46,'Roble San Nicolás Sector 4','66414'),(2569,46,'Roble San Nicolás','66414'),(2570,46,'Jardines de San Nicolás','66414'),(2571,46,'Residencial San Nicolás','66414'),(2572,46,'Fomerrey 4 Mujeres Ilustres','66415'),(2573,46,'Villa Luz','66415'),(2574,46,'Héroes de México','66415'),(2575,46,'Héroes de México Sector 3','66415'),(2576,46,'Héroes de México Sector 2','66415'),(2577,46,'La Nogalera','66417'),(2578,46,'Portal del Roble','66417'),(2579,46,'La Nogalera Sector 3','66417'),(2580,46,'La Nogalera Sector 2','66417'),(2581,46,'Anáhuac Sendero','66417'),(2582,46,'Valle de Las Alamedas','66417'),(2583,46,'Hacienda del Roble Sector 2','66417'),(2584,46,'Hacienda El Roble','66417'),(2585,46,'Villas Del Roble','66417'),(2586,46,'Residencial los Nogales','66417'),(2587,46,'Valle Del Roble','66417'),(2588,46,'Viejo Roble Sector 2','66418'),(2589,46,'Viejo Roble Sector 3','66418'),(2590,46,'Viejo Roble','66418'),(2591,46,'Centenario II','66418'),(2592,46,'Valle Dorado','66418'),(2593,46,'Valle Sol','66418'),(2594,46,'Residencial Roble Sector 2','66418'),(2595,46,'Residencial Periférico Sector 3','66420'),(2596,46,'Iturbide','66420'),(2597,46,'Residencial Periférico Sector 2','66420'),(2598,46,'Villazul','66420'),(2599,46,'Residencial Periférico','66420'),(2600,46,'Las Villas','66420'),(2601,46,'Villa Universidad','66420'),(2602,46,'Iturbide Sector 2','66420'),(2603,46,'Iturbide Sector 3','66420'),(2604,46,'Cerradas Del Roble','66420'),(2605,46,'Paraíso de Anáhuac','66422'),(2606,46,'Balcones de Anáhuac','66422'),(2607,46,'Reserva de Anahuac','66422'),(2608,46,'Villas de Anáhuac','66422'),(2609,46,'El Mirador de San Nicolás (fomerrey 129)','66422'),(2610,46,'Rincón de Anáhuac','66422'),(2611,46,'Residencial Anáhuac Zona Norte','66422'),(2612,46,'Villas Anáhuac Sector 2','66422'),(2613,46,'Hacienda de Anáhuac','66422'),(2614,46,'Nuevo Periférico Sector 3','66423'),(2615,46,'Nuevo Periférico Sector 2','66423'),(2616,46,'Nuevo Periférico Sector 1','66423'),(2617,46,'Periférico Norte','66424'),(2618,46,'Privada Residencia Hacienda Anáhuac','66425'),(2619,46,'Colinas de Anahuac','66425'),(2620,46,'Stiva','66425'),(2621,46,'Barragán','66425'),(2622,46,'Getsemani','66425'),(2623,46,'Tabachines','66425'),(2624,46,'Estación Ramon Treviño','66425'),(2625,46,'Villa Real Sector 2','66427'),(2626,46,'Villarreal','66427'),(2627,46,'Las Misiones','66428'),(2628,46,'Casa Bella Sector 2 2a Etapa','66428'),(2629,46,'Casa Bella Sector 1','66428'),(2630,46,'Casa Bella Sector 2 1a Etapa','66428'),(2631,46,'Privada Casa Bella','66428'),(2632,46,'Casa Bella Sector 3','66428'),(2633,46,'El Refugio Sector 1','66430'),(2634,46,'San Antonio','66430'),(2635,46,'Miraflores Sector 4','66430'),(2636,46,'Francisco Villa','66430'),(2637,46,'El Refugio Sector 2','66430'),(2638,46,'Los Álamos','66430'),(2639,46,'Los Nogales','66430'),(2640,46,'Betel','66430'),(2641,46,'Congregación Mariano Escobedo','66430'),(2642,46,'Santa Maria','66430'),(2643,46,'Portal Del Roble','66430'),(2644,46,'Rincón de los Álamos','66430'),(2645,46,'La Gloria','66430'),(2646,46,'San Ignacio','66430'),(2647,46,'Rivera San Nicolás','66434'),(2648,46,'Rincón de los Cedros','66435'),(2649,46,'Praderas de Santo Domingo','66436'),(2650,46,'Las Nuevas Puente','66436'),(2651,46,'Vicente Guerrero (fomerrey 46)','66437'),(2652,46,'Poblado de Santo Domingo','66437'),(2653,46,'Valle de San Carlos','66437'),(2654,46,'Los Nogales','66437'),(2655,46,'Villas Santo Domingo','66437'),(2656,46,'Valle de las Flores','66438'),(2657,46,'Villas de Santo Domingo Sector 2','66438'),(2658,46,'Valle de Santo Domingo 1er Sector','66438'),(2659,46,'Valle de Las Flores Sector 2','66438'),(2660,46,'Valle de Santo Domingo Sector 3','66438'),(2661,46,'Los Nogales (Fomerrey 44)','66440'),(2662,46,'Los Morales','66440'),(2663,46,'Nuevo Mezquital','66440'),(2664,46,'Los Morales Sector 2','66440'),(2665,46,'Ciudad Mezquital','66440'),(2666,46,'Torres de Santo Domingo','66440'),(2667,46,'Unidad Laboral Sector 2','66440'),(2668,46,'Unidad Laboral 1er. Sector','66440'),(2669,46,'Sin Nombre','66443'),(2670,46,'Santo Domingo','66444'),(2671,46,'Pedregal de Santo Domingo Sector 3','66444'),(2672,46,'Paseo de Los Andes Sector 2 Sección A y B','66444'),(2673,46,'Pedregal de Santo Domingo Sector 2','66444'),(2674,46,'Pedregal de Santo Domingo','66444'),(2675,46,'Paseo de los Andes Sector 1','66444'),(2676,46,'Paseo de Los Andes Sector 3','66444'),(2677,46,'Carmen Romano de Lopez Portillo (fomerrey 27)','66444'),(2678,46,'Fuentes de Anáhuac','66444'),(2679,46,'Prados de Santo Domingo Sector 1','66444'),(2680,46,'Estación Lagrange','66444'),(2681,46,'Valle del Mezquital (Fomerrey 30)','66445'),(2682,46,'Los Parques','66445'),(2683,46,'Jardines Del Mezquital','66445'),(2684,46,'Balcones de Santo Domingo','66446'),(2685,46,'Paseo  San Nicolás','66446'),(2686,46,'Paseo San Nicolás','66446'),(2687,46,'Real Anáhuac','66446'),(2688,46,'Anáhuac la Escondida','66446'),(2689,46,'Santo Domingo (Fom. 34)','66447'),(2690,46,'Industrial los Parques','66448'),(2691,46,'Los Naranjos Sect 4','66448'),(2692,46,'Arboledas de Santo Domingo','66448'),(2693,46,'Los Naranjos Sector 2','66448'),(2694,46,'Los Naranjos Sector 1','66448'),(2695,46,'Residencial Santo Domingo','66448'),(2696,46,'Los Naranjos Sector 3','66448'),(2697,46,'Aquiles Serdán (fom. 33)','66449'),(2698,46,'Arboledas Del Mezquital','66449'),(2699,46,'Fomerrey 118','66449'),(2700,46,'Unidad Habitacional Torres de Santo Domingo','66449'),(2701,46,'Parques de Santo Domingo','66449'),(2702,46,'Residencial Santo Domingo Sector 2','66449'),(2703,46,'Colonial','66449'),(2704,46,'Fomerrey 119','66449'),(2705,46,'Hacienda de Santo Domingo','66449'),(2706,46,'Anáhuac','66450'),(2707,46,'El Roble','66450'),(2708,46,'Valle de Anáhuac','66450'),(2709,46,'Prival de Anahuac','66450'),(2710,46,'Pedregal de Anáhuac 2 Sector','66450'),(2711,46,'Viejo Anáhuac','66450'),(2712,46,'Lomas del Roble Sector 2','66450'),(2713,46,'Cuauhtémoc Sector 2','66450'),(2714,46,'Pedregal de Anáhuac 1 Sector','66450'),(2715,46,'El Roble Sector 2','66450'),(2716,46,'Cuauhtémoc Sector 3','66450'),(2717,46,'Avita Anahuac','66450'),(2718,46,'Cuauhtémoc','66450'),(2719,46,'Chapultepec','66450'),(2720,46,'Lomas del Roble Sector 1','66450'),(2721,46,'Hojalata y Lamina Sa','66452'),(2722,46,'Ciudad Universitaria','66455'),(2723,46,'Potrero Anáhuac','66456'),(2724,46,'Villa las Puentes','66456'),(2725,46,'Ancestra','66456'),(2726,46,'Parque Anáhuac','66456'),(2727,46,'Potrero de Anáhuac Sector 2','66456'),(2728,46,'Potrero de Anáhuac Sector 3','66456'),(2729,46,'Residencial Anáhuac Sector 2','66457'),(2730,46,'Residencial Anáhuac Sector 1','66457'),(2731,46,'Residencial Anáhuac Sector 3','66457'),(2732,46,'Residencial Anáhuac Sector 4','66457'),(2733,46,'Residencial Anáhuac Sector 5','66457'),(2734,46,'Roble Norte','66458'),(2735,46,'Nuevo Laredo','66459'),(2736,46,'Royal','66459'),(2737,46,'La Joroba','66459'),(2738,46,'Año de Juárez (fomerrey 86)','66460'),(2739,46,'Las Puentes Sector 8','66460'),(2740,46,'Las Puentes Sector 9','66460'),(2741,46,'Rincón de las Puentes','66460'),(2742,46,'Las Puentes Sector 12','66460'),(2743,46,'Las Puentes Sector 4','66460'),(2744,46,'Las Puentes Sector 10','66460'),(2745,46,'Las Puentes Sector 14','66460'),(2746,46,'Paseo de las Puentes','66460'),(2747,46,'Las Puentes Sector 1','66460'),(2748,46,'Las Puentes Sector 6','66460'),(2749,46,'Las Puentes Sector 11','66460'),(2750,46,'Las Puentes Sector 2','66460'),(2751,46,'Las Puentes Sector 7','66460'),(2752,46,'Las Puentes Sector 15','66460'),(2753,46,'Residencial las Puentes Sector 1 Sección A','66460'),(2754,46,'Valle de las Puentes','66460'),(2755,46,'Jardín de las Puentes','66460'),(2756,46,'Las Puentes Sector 3','66460'),(2757,46,'Las Puentes Sector 5','66460'),(2758,46,'Rincón de los Andes','66460'),(2759,46,'Villa las Puentes','66460'),(2760,46,'Bosques de Anáhuac','66463'),(2761,46,'Jardines de Anáhuac Sector 1','66463'),(2762,46,'Jardines de Anáhuac Sector 2','66463'),(2763,46,'Jardines de Anáhuac Sector 3','66463'),(2764,46,'Residencial Nova','66464'),(2765,46,'Residencial Nova Sector 3','66464'),(2766,46,'Residencial Nova Sector 2','66464'),(2767,46,'Colonial las Puentes','66465'),(2768,46,'Hacienda las Puentes','66465'),(2769,46,'Riveras de Las Puentes Sector 2','66465'),(2770,46,'Residencial Las Palmas Sector 1','66465'),(2771,46,'Residencial Las Palmas Sector 3','66465'),(2772,46,'Arboledas de San Jorge','66465'),(2773,46,'Quinta las Puentes','66465'),(2774,46,'Residencial Las Palmas Sector 2','66465'),(2775,46,'Riveras de las Puentes','66465'),(2776,46,'Balcones de las Puentes','66466'),(2777,46,'Residencial Las Puentes Sector 1 Sección B','66467'),(2778,46,'Residencial Las Puentes Sector 4 Sección B','66467'),(2779,46,'Residencial Las Puentes Sector 2 Sección A','66467'),(2780,46,'Residencial Las Puentes Sector 2 Sección B','66467'),(2781,46,'Residencial Las Puentes Sector 5 Sección B','66467'),(2782,46,'Residencial Las Puentes Sector 1 Sección C','66467'),(2783,46,'Residencial Las Puentes Sector 3 Sección B','66467'),(2784,46,'Jardines de Santo Domingo','66468'),(2785,46,'Julio Camelo Treviño','66469'),(2786,46,'Las Esperanzas','66469'),(2787,46,'Villa Esperanza','66469'),(2788,46,'Industrias Del Vidrio Oriente','66470'),(2789,46,'Villa Luis','66470'),(2790,46,'Villas de Oriente Sector 3','66470'),(2791,46,'Del Lago Sect 2','66470'),(2792,46,'Paseo de los Angeles','66470'),(2793,46,'Residencial los Morales','66470'),(2794,46,'Del Vidrio Oriente Sect 5','66470'),(2795,46,'Residencial Paseo de los Angeles','66470'),(2796,46,'Costa del Sol 1er Sector','66470'),(2797,46,'Miguel Aleman','66470'),(2798,46,'Alcatraces Residencial','66470'),(2799,46,'Los Laureles','66470'),(2800,46,'San Benito Del Lago','66470'),(2801,46,'Rincón Del Oriente','66470'),(2802,46,'Tacuba','66470'),(2803,46,'Villas de Oriente Sector 1','66470'),(2804,46,'Costa del Sol Sector 2','66470'),(2805,46,'Del Vidrio Oriente Sect 4','66470'),(2806,46,'Andalucía','66470'),(2807,46,'Del Vidrio Oriente Sect 3','66470'),(2808,46,'Villas de Oriente Sector 2','66470'),(2809,46,'La Talaverna','66473'),(2810,46,'Villas de San Miguel','66473'),(2811,46,'Los Olivos','66473'),(2812,46,'La Talaverna CROC','66473'),(2813,46,'Bosques de Lindavista','66473'),(2814,46,'Bosques de Lindavista Sector Diamante','66473'),(2815,46,'Blas Chumacero CTM','66473'),(2816,46,'Los Cipreses','66473'),(2817,46,'Parque La Talaverna','66473'),(2818,46,'Blas Chumacero 2 Sector','66473'),(2819,46,'Bosques de Lindavista 2 Sector','66473'),(2820,46,'Cipreses Residencial 5 Sector','66474'),(2821,46,'Cipreses Residencial 3 Sector','66474'),(2822,46,'Cipreses Residencial 4 Sector','66474'),(2823,46,'Cipreses Residencial 2 Sector','66474'),(2824,46,'Los Ángeles Sect 8','66475'),(2825,46,'Villas de Casa Blanca Sector 2','66475'),(2826,46,'Jardines de Casa Blanca Sector 2','66475'),(2827,46,'Casa Blanca','66475'),(2828,46,'Villas de Casa Blanca Sector 3','66475'),(2829,46,'Jardines de Casa Blanca','66475'),(2830,46,'Los Ángeles Sector 7','66475'),(2831,46,'San Ángel Casa Blanca','66475'),(2832,46,'Villas de Casa Blanca','66475'),(2833,46,'La Estancia Sector 2','66476'),(2834,46,'La Estancia Sector 1','66476'),(2835,46,'Los Reales Sector 1','66476'),(2836,46,'Los Reales Sector 2','66476'),(2837,46,'Ciudad Minera','66476'),(2838,46,'La Estancia Sector 4','66476'),(2839,46,'La Estancia Sector 3','66476'),(2840,46,'Ideal Minera','66476'),(2841,46,'Del Lago Sector 1','66477'),(2842,46,'Hacienda las Fuentes','66477'),(2843,46,'Residencial Santa Fé','66477'),(2844,46,'Hacienda los Angeles','66477'),(2845,46,'La Fe','66477'),(2846,46,'Los Angeles Sector 3','66477'),(2847,46,'Los Angeles Sector 4','66478'),(2848,46,'Misión de San Cristóbal','66478'),(2849,46,'Los Pinos','66478'),(2850,46,'Misión de Casa Blanca 2do Sector','66478'),(2851,46,'Palmas Diamante','66478'),(2852,46,'Arboledas de San Cristóbal','66478'),(2853,46,'Rincón de los Ángeles','66478'),(2854,46,'Fresnos del Lago','66478'),(2855,46,'Privadas de Casa Blanca','66478'),(2856,46,'Residencial los Angeles Sect 2','66478'),(2857,46,'Valle Casa Blanca','66478'),(2858,46,'Misión de Casa Blanca','66478'),(2859,46,'Rincón de Casa Blanca Sector 2','66478'),(2860,46,'Villas de San Cristóbal Sector 2','66478'),(2861,46,'Residencial San Cristóbal Sector 2','66478'),(2862,46,'Los Angeles Sector 5','66478'),(2863,46,'Rincón de Casa Blanca 1er Sector','66478'),(2864,46,'Cerradas de Casa Blanca','66478'),(2865,46,'Residencial los Angeles Sect 1','66478'),(2866,46,'Residencial San Cristóbal Sector 1','66478'),(2867,46,'Villas San Cristóbal 1er Sector','66478'),(2868,46,'Residencial San Cristóbal Sector 3','66478'),(2869,46,'Quinta Montecarlo','66478'),(2870,46,'Margarita Salazar','66479'),(2871,46,'Deportivo Lagrange','66480'),(2872,46,'Bosques Del Nogalar','66480'),(2873,46,'Diaz Ordaz','66480'),(2874,46,'INFONAVIT Conductores','66480'),(2875,46,'Garza Cantu','66480'),(2876,46,'Jose Lopez Portillo','66480'),(2877,46,'Nogalar','66480'),(2878,46,'Prados Del Nogalar (fomerrey 11)','66480'),(2879,46,'Residencial Nogalar','66480'),(2880,46,'Valle de las Granjas (fomerrey 13)','66480'),(2881,46,'Bosques del Nogalar 2 Sector','66480'),(2882,46,'Futuro Nogalar Sector 2','66480'),(2883,46,'Azteca Fomerrey 11','66480'),(2884,46,'Valle Azteca (fomerrey 12)','66480'),(2885,46,'Valle Del Nogalar','66480'),(2886,46,'Mercado de Abastos Estrella','66482'),(2887,46,'Predio Aldape','66482'),(2888,46,'Futuro Nogalar Sector 1','66484'),(2889,46,'Industrial Nogalar','66484'),(2890,46,'Antiguo Nogalar','66484'),(2891,46,'Rincón Del Nogalar','66485'),(2892,46,'Bosques de Santo Domingo (fomerrey 92)','66485'),(2893,46,'4 de Octubre Fomerrey 72','66486'),(2894,46,'La Morena (fomerrey 65)','66486'),(2895,46,'Nogalar Infonavit','66486'),(2896,46,'Hacienda Nogalar','66486'),(2897,46,'Jardines Del Nogalar (fomerrey 28)','66486'),(2898,46,'Salvador Allende','66486'),(2899,46,'Privada Nogalar','66486'),(2900,46,'Floridos Bosques Del Nogalar (fomerrey 90)','66488'),(2901,46,'El Agarron','66488'),(2902,46,'Luis M Farias','66488'),(2903,46,'27 de Julio','66488'),(2904,46,'Lagos de Chapultepec (fomerrey 69)','66489'),(2905,46,'Constituyentes de Queretaro Sector 2','66490'),(2906,46,'Residencial Riviera Sector 1','66490'),(2907,46,'Industrias del Vidrio Ampliación Norte Sector 4','66490'),(2908,46,'Colonial Lagrange','66490'),(2909,46,'Francisco Garza Sada','66490'),(2910,46,'Nuevo Mundo','66490'),(2911,46,'Constituyentes de Queretaro Sector 3','66490'),(2912,46,'Constituyentes de Queretaro Sector 4','66490'),(2913,46,'Constituyentes de Queretaro Sector 6','66490'),(2914,46,'Constituyentes de Queretaro Sector 5','66490'),(2915,46,'Industrias del Vidrio Ampliación Norte Sector 1','66490'),(2916,46,'Industrias del Vidrio Amp. Oriente Sector 2','66490'),(2917,46,'Antiguo Corral de Piedra 2 Sector','66490'),(2918,46,'Residencial Rivera Sector 2','66490'),(2919,46,'Ciudad Ideal','66490'),(2920,46,'Ciudad Ideal Sector 4','66490'),(2921,46,'Industrias del Vidrio Ampliación Norte Sector 2','66490'),(2922,46,'Constituyentes de Queretaro Sector 1','66490'),(2923,46,'Antiguo Corral de Piedra 1er Sector','66490'),(2924,46,'Del Vidrio','66490'),(2925,46,'Industrias del Vidrio Sector 1','66490'),(2926,46,'Peña Guerra','66490'),(2927,46,'Ciudad Ideal Sector 3','66490'),(2928,46,'Industrias del Vidrio Ampliación Norte Sector 3','66490'),(2929,46,'Industrias Del Vidrio','66492'),(2930,46,'Del Vidrio','66492'),(2931,46,'Conductores Monterrey Sa','66493'),(2932,46,'Central de Carga','66494'),(2933,46,'Hacienda los Morales Sector 1','66495'),(2934,46,'Industrias del Vidrio Amp. Oriente Sector 3','66496'),(2935,46,'Industrias del Vidrio Sector 4','66496'),(2936,46,'Fidel Velázquez Sánchez Sector 1','66496'),(2937,46,'Industrias del Vidrio Ampliación Oriente Sector 5','66496'),(2938,46,'Hacienda los Morales Sector 3','66496'),(2939,46,'Fidel Velázquez Sect 2','66496'),(2940,46,'Hacienda los Morales Sector 4','66496'),(2941,46,'Valle de los Morales','66496'),(2942,46,'Vivenza','66496'),(2943,46,'Hacienda los Morales Sector 2','66496'),(2944,46,'Hacienda Lagrange','66499'),(2945,46,'Los Mezquites','66499'),(2946,46,'Residencial San Felipe','66499'),(2947,15,'El Mirador','66550'),(2948,15,'El Carmen Centro','66550'),(2949,15,'Villas de los Arcos 1er Sector','66550'),(2950,15,'Rincón del Carmen','66553'),(2951,15,'Alianza Real','66553'),(2952,15,'Parque Industrial el Carmen','66556'),(2953,15,'Paseo del Carmen','66557'),(2954,15,'Privadas del Carmen','66557'),(2955,15,'El Jaral','66559'),(2956,15,'Los González','66563'),(2957,15,'Privadas El Jaral','66580'),(2958,15,'El Jaral','66580'),(2959,15,'Villas del Jaral','66580'),(2960,15,'Buena Vista','66583'),(2961,5,'Futuro Apodaca','66600'),(2962,5,'Apodaca Centro','66600'),(2963,5,'Moderno Apodaca II','66600'),(2964,5,'Moderno Apodaca I','66600'),(2965,5,'Homero Sepúlveda','66600'),(2966,5,'Presidentes Municipales','66600'),(2967,5,'Santa Rosa II','66600'),(2968,5,'San Francisco','66600'),(2969,5,'Parque Industrial Kuadrum','66600'),(2970,5,'Manuel Villarreal','66600'),(2971,5,'Parque Industrial Elicán','66603'),(2972,5,'Parque Industrial Monterrey','66603'),(2973,5,'Parque Industrial Kalos','66603'),(2974,5,'Parque Industrial Kronos','66603'),(2975,5,'Residencial San Francisco','66603'),(2976,5,'Radica','66603'),(2977,5,'Casas Reales','66604'),(2978,5,'Santa Rosa','66604'),(2979,5,'Los Castaños Privada Rsidencial','66604'),(2980,5,'Misión los Olivos','66604'),(2981,5,'Burócratas Municipales','66604'),(2982,5,'Bosque de Agua','66604'),(2983,5,'San Francisco Sector Norte','66604'),(2984,5,'Los Molinos San Francisco','66604'),(2985,5,'Teresita','66605'),(2986,5,'Interamerican','66605'),(2987,5,'Benito Juárez','66605'),(2988,5,'Pedregal de Apodaca','66605'),(2989,5,'Nova Apodaca','66605'),(2990,5,'Rinconada Colonial 1 Camp.','66606'),(2991,5,'Rinconada Colonial 2 URB','66606'),(2992,5,'Rinconada Colonial 2 Camp.','66606'),(2993,5,'Rinconada Colonial 1 Urb','66606'),(2994,5,'Rinconada Colonial 7 Urb','66606'),(2995,5,'Rinconada Colonial 3 Camp.','66606'),(2996,5,'Rinconada Colonial 8 URB','66606'),(2997,5,'Residencial Apodaca','66606'),(2998,5,'Residencial Apodaca 2 Sector','66606'),(2999,5,'Rinconada Colonial 1 Urb','66606'),(3000,5,'Rinconada Colonial 6 Urb','66606'),(3001,5,'Rinconada Colonial 7 Ampliación','66606'),(3002,5,'Rinconada Colonial 9 Urb','66606'),(3003,5,'Rinconada','66606'),(3004,5,'Rinconada Colonial 5 Urb','66606'),(3005,5,'Rinconada Colonial 10 URB','66606'),(3006,5,'Rinconada Colonial 3 URB','66606'),(3007,5,'Paraje Santa Rosa Sector Norte','66607'),(3008,5,'Santa Rosa de Lima','66607'),(3009,5,'Quinta Real','66607'),(3010,5,'Valle de Salduero','66607'),(3011,5,'Paseo de los Nogales Santa Rosa','66607'),(3012,5,'Hacienda los Guajardo','66607'),(3013,5,'Paraje Santa Rosa','66607'),(3014,5,'Privalia Concordia','66609'),(3015,5,'Sierra la Esperanza','66610'),(3016,5,'Ébanos XII','66610'),(3017,5,'Balcones de Santa Rosa 1','66610'),(3018,5,'Rincón de Santa Rosa','66610'),(3019,5,'Pedregal del Valle','66610'),(3020,5,'Bonaterra','66610'),(3021,5,'Ébanos VIII','66610'),(3022,5,'Ex Hacienda Santa Rosa','66610'),(3023,5,'Los Soles','66610'),(3024,5,'Ébanos X','66610'),(3025,5,'Villas de Santa Rosa','66610'),(3026,5,'Bosques de Santa Rosa','66610'),(3027,5,'Quinta Colonial Apodaca 1 Sector','66610'),(3028,5,'Ébanos IX','66610'),(3029,5,'Antigua Santa Rosa','66610'),(3030,5,'Privadas de Santa Rosa','66610'),(3031,5,'Ventura de Santa Rosa','66610'),(3032,5,'Prados de Santa Rosa','66610'),(3033,5,'Las Palmas','66610'),(3034,5,'Ébanos XI','66610'),(3035,5,'Ébanos VII','66610'),(3036,5,'Valle de Los Nogales 1E','66610'),(3037,5,'Valle de Los Nogales 2E','66610'),(3038,5,'Prados Del Virrey','66612'),(3039,5,'Metroplex 2','66612'),(3040,5,'Cortijo las Palmas','66612'),(3041,5,'Bosque Real I','66612'),(3042,5,'Bosque Real III','66612'),(3043,5,'Jardines de las Palmas','66612'),(3044,5,'Hacienda las Yucas','66612'),(3045,5,'Ébanos Norte 2','66612'),(3046,5,'Los Encinos','66612'),(3047,5,'Nueva las Puentes III','66612'),(3048,5,'Manantial I','66612'),(3049,5,'Bosque Real II','66612'),(3050,5,'Ébanos III','66612'),(3051,5,'Los Lirios','66612'),(3052,5,'Prados de los Pinos III','66612'),(3053,5,'Nuevas las Puentes II','66612'),(3054,5,'Ébanos VI','66612'),(3055,5,'Misión Fundadores','66612'),(3056,5,'Misión San Jose','66612'),(3057,5,'Real de San Andres','66612'),(3058,5,'Jardines de San Andres IV NT','66612'),(3059,5,'Misión San José 2 Sector','66612'),(3060,5,'Nuevo las Puentes VI','66612'),(3061,5,'Santa Alicia','66612'),(3062,5,'Ébanos II','66612'),(3063,5,'Valle de Apodaca III','66612'),(3064,5,'Valle de Apodaca I','66612'),(3065,5,'Valle de las Palmas II','66612'),(3066,5,'Prados de los Pinos II','66612'),(3067,5,'Jardines de San Andres II','66612'),(3068,5,'Nuevo las Puentes V','66612'),(3069,5,'Las Huertas 1er y 2o Sector','66612'),(3070,5,'Valle de Apodaca II','66612'),(3071,5,'Manantial II','66612'),(3072,5,'Ébanos V','66612'),(3073,5,'Valle de las Palmas III','66612'),(3074,5,'Nueva las Puentes IV','66612'),(3075,5,'Misión Fundadores II','66612'),(3076,5,'Villas Premier','66612'),(3077,5,'Valle de las Palmas V','66612'),(3078,5,'Jardines de San Andres I','66612'),(3079,5,'Las Estancias','66612'),(3080,5,'Valle San Andres III','66612'),(3081,5,'Andalucía','66612'),(3082,5,'Prados de los Pinos I','66612'),(3083,5,'Villa las Puentes','66612'),(3084,5,'Valle San Andres IV','66612'),(3085,5,'Insurgentes','66612'),(3086,5,'Nueva las Puentes','66612'),(3087,5,'Ébanos IV','66612'),(3088,5,'Hacienda Santa Isabel','66612'),(3089,5,'Jardines de San Andres V','66612'),(3090,5,'Ébano Norte 3','66612'),(3091,5,'Cosmópolis','66612'),(3092,5,'Ébanos I','66612'),(3093,5,'Valle de San Andres I','66612'),(3094,5,'Valle San Andres II','66612'),(3095,5,'Valle de las Bugambilias','66612'),(3096,5,'Metroplex 1','66612'),(3097,5,'Valle de las Palmas IV','66612'),(3098,5,'El Molino','66612'),(3099,5,'Ébanos Norte 1','66612'),(3100,5,'Jardines de San Andres VI','66612'),(3101,5,'Ébano Norte IV','66612'),(3102,5,'San Agustín','66612'),(3103,5,'Valle de Apodaca IV','66612'),(3104,5,'Valle de las Palmas VI','66612'),(3105,5,'Privadas del Rey','66612'),(3106,5,'Jardines de Monterrey I','66613'),(3107,5,'Jardines de Monterrey III','66613'),(3108,5,'Mirador del Topo','66613'),(3109,5,'Santa Elena','66613'),(3110,5,'Jardines de Monterrey II','66613'),(3111,5,'Los Amarantos','66613'),(3112,5,'Parque Industrial Jardín de Monterrey I','66613'),(3113,5,'El Vergel','66613'),(3114,5,'Moisés Sáenz','66613'),(3115,5,'Paseo de Apodaca','66613'),(3116,5,'Los Amarantos II','66613'),(3117,5,'Fundadores','66613'),(3118,5,'Balcones del Norte III','66613'),(3119,5,'Residencial Moisés Sáenz','66613'),(3120,5,'Cosmópolis 8vo. Sector','66614'),(3121,5,'Renaceres','66614'),(3122,5,'Parque Industrial Azteca','66614'),(3123,5,'Los Altos','66614'),(3124,5,'Paseo de Santa Rosa','66614'),(3125,5,'Portal de Santa Rosa','66614'),(3126,5,'Milimex Santa Rosa','66614'),(3127,5,'Arboledas de Santa Rosa','66614'),(3128,5,'Los Cenizos','66614'),(3129,5,'Cuartel General 7a. Z. M.','66616'),(3130,5,'Parque Industrial Aeropuerto 1er Sector','66616'),(3131,5,'Entronque Laredo-Salinas Victoria','66616'),(3132,5,'Agua Fría','66620'),(3133,5,'Triana','66620'),(3134,5,'Cerritos de Agua Fría','66620'),(3135,5,'Residencial Valle Azul','66620'),(3136,5,'Artemio Treviño','66623'),(3137,5,'Ciudad Natura','66623'),(3138,5,'Pimsa Oriente','66624'),(3139,5,'Parque Industrial Villacero','66626'),(3140,5,'Parque Industrial Milenium','66626'),(3141,5,'Parque Industrial Stiva','66626'),(3142,5,'ProLogis Park','66627'),(3143,5,'Technology Park','66627'),(3144,5,'Parque de Investigación e Inovación Tecnológica','66628'),(3145,5,'Monterrey (Gral. Mariano Escobedo)','66629'),(3146,5,'Garcia Mireles','66630'),(3147,5,'Hacienda Del Moro','66630'),(3148,5,'Privada 103','66630'),(3149,5,'Francisco Elizondo','66630'),(3150,5,'El Mezquital','66630'),(3151,5,'Las Américas','66630'),(3152,5,'Ejido Mezquital','66630'),(3153,5,'Hacienda los Nogales','66630'),(3154,5,'Viejo Mezquital','66630'),(3155,5,'Francisco Martinez','66630'),(3156,5,'Arboledas Del Mezquital','66630'),(3157,5,'Cantizales','66630'),(3158,5,'Balcones Del Mezquital','66632'),(3159,5,'Const. Casa Bella','66632'),(3160,5,'Valle Del Mezquital','66632'),(3161,5,'Cerradas de Santa Rosa 1S 1E','66632'),(3162,5,'Villas del Mezquital','66632'),(3163,5,'Cantu','66632'),(3164,5,'Ex Hacienda San Francisco','66632'),(3165,5,'José María García Ponce','66632'),(3166,5,'Rincón de la Moraleja','66632'),(3167,5,'Desarrollo Industrial GP Apodaca 2','66632'),(3168,5,'Hacienda Del Mezquital','66632'),(3169,5,'Nuevo Mezquital','66632'),(3170,5,'Los Álamos III','66633'),(3171,5,'Titán','66633'),(3172,5,'Parque Industrial Omolap','66633'),(3173,5,'Deportivo Huinalá','66633'),(3174,5,'Rincón de la Gloria','66633'),(3175,5,'Deportivo Huinalá Mundialista','66633'),(3176,5,'Kalos la Encarnación','66633'),(3177,5,'Mirador Huinalá','66633'),(3178,5,'Los Arrecifes','66633'),(3179,5,'Torre de Campo','66633'),(3180,5,'Álamos Del Parque','66633'),(3181,5,'Noria Sur','66633'),(3182,5,'Parque Industrial Apodaca','66633'),(3183,5,'Alianza','66633'),(3184,5,'Parque Industrial México','66633'),(3185,5,'Noria Norte','66633'),(3186,5,'Valle de los Álamos','66633'),(3187,5,'Fresnos del Lago','66633'),(3188,5,'Privadas Del Parque','66633'),(3189,5,'Multipark Parque','66633'),(3190,5,'Regio Parque Industrial','66633'),(3191,5,'Parque Industrial J.M.','66633'),(3192,5,'La Encarnación','66633'),(3193,5,'Los Álamos','66633'),(3194,5,'Business Park Monterrey','66633'),(3195,5,'Jardines de San Jorge','66633'),(3196,5,'Hacienda Santa Fe','66633'),(3197,5,'Privada Antigua Huinalá','66633'),(3198,5,'Valle de Huinalá','66634'),(3199,5,'Jacarandas Sector 1','66634'),(3200,5,'Privadas Premier','66634'),(3201,5,'Independencia','66634'),(3202,5,'Misión de San Patricio','66634'),(3203,5,'Residencial las Provincias','66634'),(3204,5,'Iltamarindo','66634'),(3205,5,'Villas de Huinalá','66634'),(3206,5,'Privadas Santa Fe','66634'),(3207,5,'Encinos Residencial','66634'),(3208,5,'Privada la Castaña','66634'),(3209,5,'Axis Mty','66634'),(3210,5,'El Milagro','66634'),(3211,5,'Campestre CTM','66634'),(3212,5,'Fresnos III','66635'),(3213,5,'Magnolias II','66635'),(3214,5,'Jardines de Apodaca','66635'),(3215,5,'Enramada I','66635'),(3216,5,'Enramada V','66635'),(3217,5,'Mujeres Ilustres','66635'),(3218,5,'Paseo Palmas II','66635'),(3219,5,'Hacienda los Pinos III','66635'),(3220,5,'Pinos IV','66635'),(3221,5,'Jardines de La Enramada','66635'),(3222,5,'Paseo Palmas IV','66635'),(3223,5,'Paseo Palmas III','66635'),(3224,5,'Magnolias','66635'),(3225,5,'Nueva Democracia','66635'),(3226,5,'Villa Luz','66635'),(3227,5,'Valle de las Palmas I','66635'),(3228,5,'Paseo Palmas I','66635'),(3229,5,'Portal Anáhuac','66635'),(3230,5,'Enramada IV','66635'),(3231,5,'Praderas I','66635'),(3232,5,'Villa Sol','66635'),(3233,5,'Hacienda las Palmas II','66635'),(3234,5,'Enramada VII','66635'),(3235,5,'Enramada III','66635'),(3236,5,'Enramada II','66635'),(3237,5,'Enramada VI','66635'),(3238,5,'Praderas II','66635'),(3239,5,'Pinos III','66635'),(3240,5,'Hacienda las Palmas','66635'),(3241,5,'Hacienda los Encinos','66635'),(3242,5,'Pinos V','66635'),(3243,5,'Fresnos II','66635'),(3244,5,'Jardines de los Pinos I','66636'),(3245,5,'Fresnos I','66636'),(3246,5,'Hacienda los Pinos','66636'),(3247,5,'Fresnos Norte','66636'),(3248,5,'Pinos I','66636'),(3249,5,'Nuevo Amanecer 1','66636'),(3250,5,'Los Robles','66636'),(3251,5,'Santa Cecilia II','66636'),(3252,5,'Prados de La Cieneguita','66636'),(3253,5,'Fresnos IX','66636'),(3254,5,'Jardín de los Pinos II','66636'),(3255,5,'Santa Cecilia IV','66636'),(3256,5,'Residencial Las Palmas 2 Sector','66636'),(3257,5,'Santa Cecilia I','66636'),(3258,5,'Fresnos VI','66636'),(3259,5,'Santa Cecilia VII','66636'),(3260,5,'Cerrada Providencia','66636'),(3261,5,'Fresnos X','66636'),(3262,5,'Arboledas Del Virrey','66636'),(3263,5,'Pinos II','66636'),(3264,5,'Fresnos VIII','66636'),(3265,5,'Santa Cecilia III','66636'),(3266,5,'Fresnos IV','66636'),(3267,5,'Pradreras de La Enramada','66636'),(3268,5,'La Hacienda','66636'),(3269,5,'Hacienda los Pinos II','66636'),(3270,5,'Paseo de los Pinos II','66636'),(3271,5,'Paseo de los Nogales','66636'),(3272,5,'Santa Cecilia VIII','66636'),(3273,5,'Nuevo Amanecer 2','66636'),(3274,5,'Fresnos V','66636'),(3275,5,'Residencial Palmas 1 S','66636'),(3276,5,'Santa Cecilia VI','66636'),(3277,5,'La Hacienda II','66636'),(3278,5,'Santa Cecilia V','66636'),(3279,5,'Industrial Martel','66637'),(3280,5,'Parque Industrial Milimex','66637'),(3281,5,'Almacentro','66637'),(3282,5,'Prados Residencial','66640'),(3283,5,'Alberta Escamilla','66640'),(3284,5,'Jardines de Huinalá','66640'),(3285,5,'Balcones de Huinalá','66640'),(3286,5,'Parque Industrial San Andrés','66640'),(3287,5,'Fraccionamiento San Andres','66640'),(3288,5,'Reforma','66640'),(3289,5,'Hacienda San Gerardo','66640'),(3290,5,'Colonial de Huinalá','66640'),(3291,5,'San Miguel Golondrinas','66640'),(3292,5,'Misión Real','66640'),(3293,5,'Huinalá','66640'),(3294,5,'Lomas de Huinalá II','66640'),(3295,5,'Real de Apodaca','66640'),(3296,5,'Hacienda El Campanario','66643'),(3297,5,'Portal Del Valle 2S','66643'),(3298,5,'Los Olmos','66643'),(3299,5,'Paseo de las Flores 2do. Sector','66643'),(3300,5,'Paseo de las Flores 1er Sector','66643'),(3301,5,'Hacienda el Campanario III','66643'),(3302,5,'Paseo de las Flores 3er. Sector','66643'),(3303,5,'Misión San Pablo I','66643'),(3304,5,'Misión San Pablo 2','66643'),(3305,5,'Portal del Valle 1S','66643'),(3306,5,'Santa Anita','66643'),(3307,5,'Santa Mónica','66644'),(3308,5,'Parque Industrial San Carlos','66644'),(3309,5,'Rincón de Huinalá','66644'),(3310,5,'Villas de San Carlos','66644'),(3311,5,'Bugambilias Huinalá','66644'),(3312,5,'Treviño Elizondo','66644'),(3313,5,'Real Hacienda de Huinalá','66644'),(3314,5,'Parque Industrial Huinalá','66645'),(3315,5,'Parque Industrial las Americas','66645'),(3316,5,'Padilla','66645'),(3317,5,'Jardines Del Virrey','66645'),(3318,5,'Bosques de Huinalá','66645'),(3319,5,'Parque Industrial el Sabinal','66645'),(3320,5,'Hacienda Del Carmen','66645'),(3321,5,'Bosques de Huinalá 2 Sector','66645'),(3322,5,'Pueblo Nuevo 2','66646'),(3323,5,'Portal de Huinalá','66646'),(3324,5,'Privada Dominio','66646'),(3325,5,'Pueblo Nuevo 1','66646'),(3326,5,'Misión de Huinalá 1S 1E','66646'),(3327,5,'Mision de San Javier','66646'),(3328,5,'Residencial San Benito','66646'),(3329,5,'Pueblo Nuevo V','66646'),(3330,5,'Riveras de Huinalá','66646'),(3331,5,'Pueblo Nuevo IV','66646'),(3332,5,'Los Colibries','66646'),(3333,5,'Estancia Castaño','66646'),(3334,5,'Pueblo Nuevo III','66646'),(3335,5,'San Isidro II','66646'),(3336,5,'San Isidro I','66646'),(3337,5,'Privadas Canteras','66646'),(3338,5,'Misión de Huinalá 1S 2E','66646'),(3339,5,'Milenium Residencial','66646'),(3340,5,'Lomas de San Isidro','66646'),(3341,5,'Misión de Huinalá 2S','66646'),(3342,5,'San Javier','66646'),(3343,5,'Tréboles','66646'),(3344,5,'Privalia Huinalá','66646'),(3345,5,'Los Vitrales','66647'),(3346,5,'Lomas de la Paz','66647'),(3347,5,'El Rosario','66647'),(3348,5,'Los Puertos','66647'),(3349,5,'Paseo de las Fuentes','66647'),(3350,5,'Los Candiles','66647'),(3351,5,'Jardines de San Patricio','66647'),(3352,5,'Fuentes de Santa Lucia','66647'),(3353,5,'Bosques de San Miguel','66647'),(3354,5,'Los Olivos Residencial','66647'),(3355,5,'Lomas de San Miguel','66647'),(3356,5,'Praderas de Huinalá','66647'),(3357,5,'Valle de las Flores','66647'),(3358,5,'Bosque del Sol','66647'),(3359,5,'Acanto Residencial','66647'),(3360,5,'Vivienda Digna','66647'),(3361,5,'Paseo de la Loma','66647'),(3362,5,'American Industries Apodaca','66647'),(3363,5,'Los Pinceles','66647'),(3364,5,'Mirasol Residencial','66647'),(3365,5,'Campestre Huinalá','66647'),(3366,5,'Hacienda las Margaritas','66647'),(3367,5,'Valle de San Miguel','66648'),(3368,5,'Roberto Espinoza','66648'),(3369,5,'Joyas Del Pedregal','66648'),(3370,5,'Parque Industrial la Silla','66648'),(3371,5,'Los Tres Nogales','66648'),(3372,5,'Valle Del Pedregal','66648'),(3373,5,'Santa Fé','66648'),(3374,5,'Misión de Las Flores','66648'),(3375,5,'Lomas Del Pedregal','66648'),(3376,5,'Misión de San Miguel','66648'),(3377,5,'Lomas de Huinalá I','66648'),(3378,5,'Monte Alban II','66648'),(3379,5,'Colinas de San Miguel','66648'),(3380,5,'Cerrada la Toscana','66648'),(3381,5,'San Miguel','66648'),(3382,5,'Rincón de San Miguel','66648'),(3383,5,'El Campanario','66648'),(3384,5,'Altaria Residencial','66649'),(3385,5,'San Miguel','66649'),(3386,5,'San Miguelito','66649'),(3387,5,'San Ignacio','66649'),(3388,5,'Misión San Pablo','66649'),(3389,5,'Sebastián Elizondo I','66649'),(3390,5,'Ventura de Asís II','66649'),(3391,5,'Rincón de los Cristales','66649'),(3392,5,'Mixcoac','66649'),(3393,5,'Golondrinas','66649'),(3394,5,'Ventura de Asís','66649'),(3395,5,'Villas de Loreto','66649'),(3396,5,'Sebastián Elizondo II','66649'),(3397,5,'Nueva Mixcoac','66649'),(3398,5,'Privada San Miguelito','66649'),(3399,5,'Monte Albán','66649'),(3400,5,'Miguel Hidalgo','66649'),(3401,42,'Pesquería','66650'),(3402,42,'Villas Regina','66653'),(3403,42,'Zacatecas','66655'),(3404,42,'Santa Engracia','66655'),(3405,42,'Las Haciendas','66655'),(3406,42,'Residencial Floresta','66655'),(3407,42,'Colinas del Aeropuerto','66655'),(3408,42,'Las Aves Residencial and Golf Resort','66660'),(3409,42,'Las Escobas','66670'),(3410,42,'Misión Dulces Nombres','66670'),(3411,42,'Valle de Santa María','66670'),(3412,42,'Dulces Nombres','66670'),(3413,42,'Las Águilas','66670'),(3414,42,'Paseo San Javier','66672'),(3415,42,'Lomas de San Martín','66673'),(3416,42,'Jesús María','66674'),(3417,42,'La Arena','66679'),(3418,42,'Santa Maria La Floreña','66680'),(3419,42,'La Providencia','66683'),(3420,42,'Milpa','66690'),(3421,42,'Santa Maria Pesquería','66693'),(3422,35,'Marin','66700'),(3423,35,'Guadalupe','66708'),(3424,14,'Dr. Gonzalez','66750'),(3425,14,'Nuevo Repueblo','66770'),(3426,14,'La Venadera O San Antonio','66790'),(3427,14,'Los Peña','66793'),(3428,34,'Los Ramones','66800'),(3429,34,'Hidalgo','66810'),(3430,34,'El Peine','66812'),(3431,34,'Garza Gonzalez','66820'),(3432,34,'La Loma','66824'),(3433,34,'Repueblo de Oriente','66825'),(3434,34,'San Benito','66825'),(3435,34,'Los Angeles','66826'),(3436,34,'El Saucito','66827'),(3437,34,'San Isidro','66830'),(3438,34,'Ayancual','66835'),(3439,34,'El Carrizo','66840'),(3440,34,'El Carrizo','66842'),(3441,34,'Las Enramadas','66847'),(3442,34,'La Conquista','66848'),(3443,34,'El Porvenir','66849'),(3444,33,'Los Herreras','66850'),(3445,33,'San Vicente','66860'),(3446,33,'Guadalupe','66861'),(3447,33,'San Jose de La Laja','66865'),(3448,33,'Los Herreras','66870'),(3449,33,'San Agustin','66872'),(3450,33,'Barretosa','66880'),(3451,32,'Los Aldamas','66900'),(3452,32,'Los Aldamas','66910'),(3453,32,'Los Aldamas','66930'),(3454,32,'San Pedro','66940'),(3455,32,'La Palmita','66945'),(3456,13,'Dr. Coss','66950'),(3457,13,'Hacienda de Guadalupe','66953'),(3458,13,'Norte','66953'),(3459,13,'Francisco I Madero','66955'),(3460,13,'La Lajilla','66960'),(3461,13,'La Ceja','66963'),(3462,13,'Serafín','66964'),(3463,13,'Cantu','66980'),(3464,18,'Gral. Bravo','67000'),(3465,18,'Tijerina','67000'),(3466,18,'Las Tranquitas','67002'),(3467,18,'Las 3 Caídas','67003'),(3468,18,'Conferín Arizpe','67004'),(3469,18,'Jardínes del Bravo','67004'),(3470,18,'Esquina Del Potrero','67010'),(3471,18,'Santa Teresa','67012'),(3472,18,'El Mantillo','67030'),(3473,10,'China','67050'),(3474,10,'Valles de Cadereyta','67050'),(3475,10,'Valle de San Felipe','67050'),(3476,10,'La Laguna','67050'),(3477,10,'El Maestro','67050'),(3478,10,'Santa Mónica','67052'),(3479,10,'San Isidro','67053'),(3480,10,'Revolución','67055'),(3481,10,'La Barranca','67060'),(3482,10,'El Cuchillo','67066'),(3483,10,'Paso de La Loma','67066'),(3484,10,'San Juanito','67087'),(3485,10,'San Fernando','67093'),(3486,10,'San Pablo','67093'),(3487,10,'La Barreta','67097'),(3488,10,'Dr. Ignacio Morones Prieto','67099'),(3489,24,'Ciudad Guadalupe Centro','67100'),(3490,24,'Centro SCT Nuevo León','67102'),(3491,24,'Pedregal de Lindavista','67110'),(3492,24,'San Rafael','67110'),(3493,24,'La Victoria','67110'),(3494,24,'Villa San Antonio','67110'),(3495,24,'Rincón Lindavista','67110'),(3496,24,'Arboledas de San Miguel','67110'),(3497,24,'Jardines la Victoria','67110'),(3498,24,'Bosques del Oriente','67110'),(3499,24,'Plaza San Antonio','67110'),(3500,24,'Los Olivos','67110'),(3501,24,'La Amistad','67110'),(3502,24,'Villa de San Miguel','67110'),(3503,24,'Paseo San Miguel','67110'),(3504,24,'Talaberna','67110'),(3505,24,'Pedregal de Linda Vista II','67112'),(3506,24,'Provivienda','67112'),(3507,24,'Hacienda los Encinos','67112'),(3508,24,'Las Dalias','67112'),(3509,24,'Villas del Río','67112'),(3510,24,'Residencial Santa Fé','67112'),(3511,24,'Almendros','67112'),(3512,24,'Provivienda la Esperanza','67112'),(3513,24,'Valle de San Antonio','67112'),(3514,24,'Residencial San Antonio','67112'),(3515,24,'Privadas de Lindavista','67112'),(3516,24,'Real de San Miguel Sector 4','67113'),(3517,24,'INFONAVIT Benito Juárez','67113'),(3518,24,'Lomas de San Miguel','67113'),(3519,24,'Mixcoac','67113'),(3520,24,'Coloniales San Miguel Sector 1','67113'),(3521,24,'Hacienda San Miguel','67113'),(3522,24,'Privada San Fernando','67113'),(3523,24,'Balcones de San Miguel','67113'),(3524,24,'Real de San Miguel Sector I','67113'),(3525,24,'Policía Auxiliar','67113'),(3526,24,'Arboledas de Acapulco','67113'),(3527,24,'Real de San Miguel Sector 2','67113'),(3528,24,'Real de San Miguel Sector 3','67113'),(3529,24,'Residencial Avante','67113'),(3530,24,'Valle San Miguel','67113'),(3531,24,'Fuentes de San Miguel','67113'),(3532,24,'Torres de San Miguel','67113'),(3533,24,'Coloniales San Miguel','67113'),(3534,24,'Pedregal de Oriente','67115'),(3535,24,'Viga','67115'),(3536,24,'San Miguel','67115'),(3537,24,'Maya','67115'),(3538,24,'Nuevo Milenio','67115'),(3539,24,'Benito Juárez','67116'),(3540,24,'Jardines de Casa Blanca','67116'),(3541,24,'Jardines Guadalupe','67116'),(3542,24,'Riveras de la Silla (Fomerrey 31)','67116'),(3543,24,'Jardines del Río','67116'),(3544,24,'Jardines de San Miguel','67116'),(3545,24,'Nuevo San Miguel','67116'),(3546,24,'Los Cristales','67117'),(3547,24,'Raúl Caballero','67117'),(3548,24,'Residencial Torremolinos','67117'),(3549,24,'Los Cristales 3er. Sector','67117'),(3550,24,'Cañada Blanca','67117'),(3551,24,'Misión de Guadalupe','67117'),(3552,24,'Valle Torremolinos','67117'),(3553,24,'Zozayita','67117'),(3554,24,'Eduardo Caballero','67117'),(3555,24,'Arboledas del Oriente','67117'),(3556,24,'Torremolinos la Fé','67117'),(3557,24,'Josefa Zozaya','67117'),(3558,24,'Centroamérica','67117'),(3559,24,'Misión del Valle','67118'),(3560,24,'Valle San Rafael','67118'),(3561,24,'Villa Española','67118'),(3562,24,'Nuevo San Rafael','67118'),(3563,24,'Emiliano Zapata (Fomerrey 18)','67118'),(3564,24,'La Floresta','67118'),(3565,24,'Jardines de San Rafael','67119'),(3566,24,'San Rafael','67119'),(3567,24,'Industrial Jardines San Rafael','67119'),(3568,24,'Praderas de San Rafael','67119'),(3569,24,'Adolfo Prieto Sector 3','67120'),(3570,24,'América Obrera','67120'),(3571,24,'Residencial Minerva','67120'),(3572,24,'Adolfo Prieto','67120'),(3573,24,'Adolfo Prieto Sector 2','67120'),(3574,24,'La Luz','67120'),(3575,24,'Hércules','67120'),(3576,24,'Leon XIII','67120'),(3577,24,'Nueva Libertad','67120'),(3578,24,'Arboledas de Corregidora','67123'),(3579,24,'Jardines de Lindavista','67123'),(3580,24,'Libertad','67123'),(3581,24,'Lindavista','67123'),(3582,24,'10 de Mayo','67123'),(3583,24,'Real de Minas','67124'),(3584,24,'Adolfo Prieto Sector 4','67124'),(3585,24,'Escamilla','67124'),(3586,24,'Aragonés','67124'),(3587,24,'Vista Sol','67125'),(3588,24,'Privada Purísima','67125'),(3589,24,'Lolyta','67125'),(3590,24,'América','67125'),(3591,24,'Condocasa Lindavista','67125'),(3592,24,'Valle de Lindavista','67125'),(3593,24,'Cerradas de Lindavista','67125'),(3594,24,'Torres Lindavista','67126'),(3595,24,'Dr. Ángel Martinez Villarreal','67126'),(3596,24,'18 de Marzo','67126'),(3597,24,'Rivera de Linda Vista','67126'),(3598,24,'Riveras de la Purísima','67126'),(3599,24,'Las Américas','67128'),(3600,24,'Arboledas Nueva Lindavista','67129'),(3601,24,'Nueva Lindavista','67129'),(3602,24,'Rincón de la Purísima','67129'),(3603,24,'La Talaverna Modulo Social FOVISSSTE','67129'),(3604,24,'Jardines Nueva Lindavista','67129'),(3605,24,'La Purísima','67129'),(3606,24,'Serena','67129'),(3607,24,'Central de Carga','67129'),(3608,24,'San Roberto','67130'),(3609,24,'Privada San Miguel','67130'),(3610,24,'La Condesa','67130'),(3611,24,'Valle Soleado','67130'),(3612,24,'Nexxus','67130'),(3613,24,'FINSA','67132'),(3614,24,'Bello Amanecer Residencial','67132'),(3615,24,'Regio Parque Industrial Guadalupe','67132'),(3616,24,'Las Escobas','67133'),(3617,24,'Santa Clara','67134'),(3618,24,'Arboledas de Santa Cecilia','67134'),(3619,24,'Riberas de Dos Ríos','67134'),(3620,24,'Dos Ríos','67134'),(3621,24,'Privada San Carlos','67134'),(3622,24,'Polanco','67140'),(3623,24,'Residencial Cerro de la Silla','67140'),(3624,24,'La Herradura','67140'),(3625,24,'Paraíso','67140'),(3626,24,'Revolución','67140'),(3627,24,'Chinameca','67140'),(3628,24,'La Pastora','67140'),(3629,24,'Valle de Chapultepec','67140'),(3630,24,'Los Sauces','67140'),(3631,24,'Rivera de la Pastora','67140'),(3632,24,'Las Plazas 3','67140'),(3633,24,'Esmeralda','67140'),(3634,24,'Polanco Oriente','67140'),(3635,24,'Santa Margarita','67140'),(3636,24,'Cóndor','67140'),(3637,24,'Las Plazas 1','67140'),(3638,24,'Juan Álvarez','67140'),(3639,24,'Central de Abastos','67140'),(3640,24,'Del Maestro','67140'),(3641,24,'Ignacio Altamirano','67140'),(3642,24,'Jardines la Pastora','67140'),(3643,24,'Las Plazas 2','67140'),(3644,24,'Guerra','67144'),(3645,24,'Riviera del Contry','67144'),(3646,24,'El Bajío','67144'),(3647,24,'La Huerta','67144'),(3648,24,'Marte','67144'),(3649,24,'Benito Juárez','67144'),(3650,24,'Venus','67144'),(3651,24,'Azteca INFONAVIT','67150'),(3652,24,'José María Morelos','67150'),(3653,24,'Azteca','67150'),(3654,24,'Las Canteras','67150'),(3655,24,'Nueva Exposición','67150'),(3656,24,'Rincón de la Azteca','67150'),(3657,24,'Residencial Azteca','67150'),(3658,24,'Privada Laura','67153'),(3659,24,'Privada Chapultepec','67153'),(3660,24,'Exposición Modelo','67154'),(3661,24,'La Fuente','67154'),(3662,24,'El Sabino','67154'),(3663,24,'San Diego','67154'),(3664,24,'Exposición','67155'),(3665,24,'Alamedas de la Hacienda','67155'),(3666,24,'Guadalupe Zitoon','67155'),(3667,24,'La Hacienda','67155'),(3668,24,'Expo Ganadera','67155'),(3669,24,'La Joya INFONAVIT 1er. Sector','67160'),(3670,24,'Riberas del Río','67160'),(3671,24,'La Joya INFONAVIT 2do. Sector','67160'),(3672,24,'La Joya INFONAVIT 3er. Sector','67160'),(3673,24,'Vicente Guerrero','67163'),(3674,24,'Ignacio Zaragoza','67163'),(3675,24,'San Agustín','67163'),(3676,24,'Río','67164'),(3677,24,'21 de Enero','67164'),(3678,24,'Unión','67164'),(3679,24,'Valle Hermoso Sector 3','67164'),(3680,24,'Valle Hermoso Sector 2','67164'),(3681,24,'Unión Modelo','67165'),(3682,24,'Los Encinos','67165'),(3683,24,'Residencial las Quintas','67165'),(3684,24,'Valle Hermoso','67165'),(3685,24,'Nueva Rosita','67166'),(3686,24,'Orizaba','67167'),(3687,24,'La Joya INFONAVIT 5to. Sector','67167'),(3688,24,'La Joya INFONAVIT 4to. Sector','67167'),(3689,24,'La Joyita','67167'),(3690,24,'Rosita','67167'),(3691,24,'Rincón de la Hacienda','67168'),(3692,24,'Portal de la Hacienda','67168'),(3693,24,'Hacienda los Lerma 1er. Sector','67168'),(3694,24,'Simuplade','67168'),(3695,24,'Hacienda los Lerma 2do. Sector','67168'),(3696,24,'Las Sabinas (Solidaridad Fomerrey)','67168'),(3697,24,'Valle de las Sabinas','67168'),(3698,24,'Nueva Joya','67168'),(3699,24,'Sabinitas','67169'),(3700,24,'Los Faisanes','67169'),(3701,24,'Faisanes Sur','67169'),(3702,24,'Libertadores de América','67169'),(3703,24,'El Quetzal','67169'),(3704,24,'Los Faisanes Sector el Dorado','67169'),(3705,24,'Camino Real','67170'),(3706,24,'Progreso','67170'),(3707,24,'15 de Mayo','67170'),(3708,24,'20 de Noviembre','67170'),(3709,24,'Mirasol','67170'),(3710,24,'Punta Contry','67173'),(3711,24,'Contry los Nogales','67173'),(3712,24,'Contry la Escondida','67173'),(3713,24,'Contry la Costa','67173'),(3714,24,'Pedregal Contry','67173'),(3715,24,'Rincón Colonial la Silla','67173'),(3716,24,'Rincón de la Primavera','67173'),(3717,24,'Contry la Silla','67173'),(3718,24,'Rincón del Contry','67174'),(3719,24,'Atoyac de Álvarez','67174'),(3720,24,'Bosques de la Pastora','67174'),(3721,24,'Villa Pastora','67174'),(3722,24,'25 de Noviembre','67174'),(3723,24,'Puesta del Sol','67174'),(3724,24,'Contry Sol','67174'),(3725,24,'Valle del Contry','67174'),(3726,24,'Riberas del Contry','67174'),(3727,24,'Bosques del Contry','67174'),(3728,24,'Las Águilas','67174'),(3729,24,'Las Villas','67175'),(3730,24,'La Quinta','67175'),(3731,24,'Plan del Río','67175'),(3732,24,'Felipe Ángeles','67175'),(3733,24,'Tolteca','67175'),(3734,24,'Vivienda Popular','67176'),(3735,24,'Ruiz Cortínes','67176'),(3736,24,'Mirador de la Silla','67176'),(3737,24,'Fresnos la Silla','67176'),(3738,24,'Lomas de la Silla (Fomerrey 14)','67177'),(3739,24,'Galerías del Camino Real 2o. Sector','67177'),(3740,24,'Valle de Guadalupe','67177'),(3741,24,'Galerías del Camino Real 1er. Sector','67177'),(3742,24,'Residencial Real de la Silla','67177'),(3743,24,'Cerro de la Silla','67177'),(3744,24,'Altos San Roque (Fomerrey 26)','67177'),(3745,24,'Camino Real FOVISSSTE','67177'),(3746,24,'Privadas de Contry','67178'),(3747,24,'Alfonso Martinez Domínguez','67178'),(3748,24,'Contry los Encinos','67178'),(3749,24,'Lomas de Tolteca','67178'),(3750,24,'Jardines de Tolteca','67178'),(3751,24,'Granjitas la Silla','67178'),(3752,24,'Los Canelos','67178'),(3753,24,'Residencial Mira Loma','67179'),(3754,24,'Ignacio Allende','67179'),(3755,24,'Privada los Sabinos','67179'),(3756,24,'Zertuche 2do. Sector','67180'),(3757,24,'Burócratas Municipales','67180'),(3758,24,'Villa de los Reyes','67180'),(3759,24,'La Playa','67180'),(3760,24,'La Playita','67180'),(3761,24,'Miguel Hidalgo (Fomerrey 19)','67180'),(3762,24,'Valles de la Silla','67180'),(3763,24,'Parque San Andrés','67180'),(3764,24,'Díaz Ordaz','67180'),(3765,24,'Fomerrey 20 (2 de Mayo)','67180'),(3766,24,'Colinas de la Silla','67182'),(3767,24,'Cañón de la Silla','67182'),(3768,24,'Privada Vicente Ferrer','67182'),(3769,24,'Morenita Guajardo','67182'),(3770,24,'El Peñón','67182'),(3771,24,'23 de Noviembre','67182'),(3772,24,'Arboledas de la Silla','67182'),(3773,24,'Almaguer','67182'),(3774,24,'Guadalupe Chávez','67182'),(3775,24,'Encino de la Silla','67182'),(3776,24,'Colinas de Guadalupe','67182'),(3777,24,'Garza Melo','67183'),(3778,24,'Los Delfines','67183'),(3779,24,'La Alianza de Ruteros','67183'),(3780,24,'Miguel de la Madrid','67183'),(3781,24,'Bosques de la Silla','67183'),(3782,24,'Luis Donaldo Colosio','67183'),(3783,24,'Nuevo México','67183'),(3784,24,'Guajardo','67183'),(3785,24,'Villa Olímpica','67183'),(3786,24,'Campestre la Silla','67183'),(3787,24,'Ampliación México Nuevo','67183'),(3788,24,'San Cristóbal','67184'),(3789,24,'Tacubaya','67184'),(3790,24,'San Sebastián','67184'),(3791,24,'Valle de San Andrés','67184'),(3792,24,'Insurgentes','67184'),(3793,24,'Zertuche 1er. Sector','67184'),(3794,24,'Jardines de Santa Clara','67184'),(3795,24,'Villa San Sebastián','67184'),(3796,24,'Pablo Livas','67184'),(3797,24,'Valle San Roque','67184'),(3798,24,'Condado de Santa Lucía','67184'),(3799,24,'La Comedia','67184'),(3800,24,'Santa Isabel','67184'),(3801,24,'Colibrí 3','67184'),(3802,24,'Agua Nueva','67185'),(3803,24,'Parques de Guadalupe','67185'),(3804,24,'Cerradas de la Silla','67185'),(3805,24,'La Roca','67185'),(3806,24,'El Milagro','67185'),(3807,24,'Rafael Ramírez Sector II','67185'),(3808,24,'13 de Mayo','67185'),(3809,24,'Fomerrey 32','67185'),(3810,24,'Santa Clara','67185'),(3811,24,'Las Avenidas','67185'),(3812,24,'Guadalupe Victoria','67185'),(3813,24,'José Luis Mora','67185'),(3814,24,'Rafael Ramírez','67185'),(3815,24,'Cuesta Verde','67186'),(3816,24,'San Eduardo','67186'),(3817,24,'Praderas de la Silla','67186'),(3818,24,'Collados de Guadalupe','67186'),(3819,24,'Valle la Silla','67186'),(3820,24,'Nuevo Almaguer','67186'),(3821,24,'Collados de Guadalupe 2do. Sector','67186'),(3822,24,'Loma Verde','67186'),(3823,24,'Vicente Ferrer','67186'),(3824,24,'Lomas de San Roque','67186'),(3825,24,'Unidad Piloto','67186'),(3826,24,'Lucio Blanco','67186'),(3827,24,'Gloria Mendiola','67186'),(3828,24,'Josefa Ortiz de Dominguez','67186'),(3829,24,'Cerradas de Bugambilias','67188'),(3830,24,'Melchor Ocampo','67188'),(3831,24,'Nuevo San Sebastián','67188'),(3832,24,'Los Lermas','67188'),(3833,24,'Chula Vista','67188'),(3834,24,'Rosalinda','67188'),(3835,24,'Santa Elena','67189'),(3836,24,'Los Ángeles','67189'),(3837,24,'Solidaridad','67189'),(3838,24,'Colibrí 1','67189'),(3839,24,'2 de Junio','67189'),(3840,24,'Colibrí 2','67189'),(3841,24,'Guadalupe la Silla','67190'),(3842,24,'Las Flores','67190'),(3843,24,'Cerro de la Silla UC','67190'),(3844,24,'División del Norte','67190'),(3845,24,'Reynosa','67190'),(3846,24,'Guadalupe Avante','67190'),(3847,24,'Residencial Guadalupe','67190'),(3848,24,'3 Caminos','67190'),(3849,24,'3 Caminos Norte','67190'),(3850,24,'Roble Santa María','67190'),(3851,24,'Niños Héroes','67190'),(3852,24,'Cerro Azul','67190'),(3853,24,'Rancho Viejo Sector 1','67192'),(3854,24,'Valle de San Roque','67192'),(3855,24,'Bugambilias de la Sierra','67192'),(3856,24,'Nueva Aurora','67192'),(3857,24,'Rancho Viejo Sector 2','67192'),(3858,24,'Las Colinas','67192'),(3859,24,'Las Palmas','67192'),(3860,24,'Jardines de Andalucía','67193'),(3861,24,'Sierra Morena','67193'),(3862,24,'Acueducto Guadalupe','67193'),(3863,24,'Misión Santa Fé','67193'),(3864,24,'Colinas del Rey','67194'),(3865,24,'Privadas del Rey','67194'),(3866,24,'Bosques del Rey','67194'),(3867,24,'Rincón de la Sierra','67194'),(3868,24,'México 86','67194'),(3869,24,'Portales de la Silla','67194'),(3870,24,'Molino del Rey','67194'),(3871,24,'Portales de la Silla 2do. Sector','67194'),(3872,24,'Ciudad CROC','67195'),(3873,24,'Villa Alegre','67195'),(3874,24,'Pedregal de Guadalupe','67195'),(3875,24,'La Silla','67195'),(3876,24,'Valles de Guadalupe','67195'),(3877,24,'Rincón la Silla','67196'),(3878,24,'Valle del Sol','67196'),(3879,24,'Xochimilco','67196'),(3880,24,'Hacienda las Escobas','67196'),(3881,24,'Privadas de la Silla','67196'),(3882,24,'Santa Bárbara','67196'),(3883,24,'Jardines de Xochimilco','67196'),(3884,24,'Portal de Xochimilco','67196'),(3885,24,'Valle de los Encinos','67197'),(3886,24,'Cortijo la Silla','67197'),(3887,24,'Misión de la Silla','67197'),(3888,24,'Tierra Propia Sector 2','67197'),(3889,24,'Tierra Propia Sector 1','67197'),(3890,24,'Hacienda de Guadalupe','67197'),(3891,24,'Acapulco','67198'),(3892,24,'Scop','67198'),(3893,24,'Rincón de Guadalupe','67198'),(3894,24,'Fomerrey 3','67198'),(3895,24,'Santa María','67198'),(3896,24,'Carmen Serdán','67198'),(3897,24,'Nuevo Santa María','67198'),(3898,24,'SCT','67199'),(3899,24,'Los Independientes','67199'),(3900,24,'Hacienda la Silla','67199'),(3901,24,'Paseo de Guadalupe','67199'),(3902,24,'Puerta del Sol','67200'),(3903,24,'31 de Diciembre','67200'),(3904,24,'Ciudad Cnop','67200'),(3905,24,'Evolución','67200'),(3906,24,'Tamaulipas','67200'),(3907,24,'Nuevo Tamaulipas','67200'),(3908,24,'Miguel Hidalgo','67202'),(3909,24,'La Trinidad','67202'),(3910,24,'Nuevo León','67202'),(3911,24,'5 de Enero','67202'),(3912,24,'Residencial Santa María','67202'),(3913,24,'Sandra Saavedra','67202'),(3914,24,'Vaquerías','67203'),(3915,24,'Praderas de Guadalupe','67203'),(3916,24,'Hacienda San Sebastián','67203'),(3917,24,'María Teresa','67203'),(3918,24,'David Cavazos','67204'),(3919,24,'Huerta de Guadalupe','67204'),(3920,24,'Industrial la Silla','67204'),(3921,24,'Crispín Treviño','67204'),(3922,24,'Los Manantiales','67204'),(3923,24,'Villas del Río','67204'),(3924,24,'Misión Santa Cruz','67205'),(3925,24,'Santa Cruz','67205'),(3926,24,'Kalos','67205'),(3927,24,'Rincón de los Sabinos','67205'),(3928,24,'29 de Julio','67205'),(3929,24,'Fuentes de Guadalupe','67205'),(3930,29,'Hacienda San José','67250'),(3931,29,'Hacienda Santa Lucia','67250'),(3932,29,'Benito Juárez Centro','67250'),(3933,29,'Riberas de Santa Maria','67253'),(3934,29,'Benito Juárez Infonavit','67253'),(3935,29,'Real de San Jose','67254'),(3936,29,'Villas de San Juan','67254'),(3937,29,'Los Alcatraces','67254'),(3938,29,'Riberas de la Morena','67254'),(3939,29,'La Ciudadela Sector Real San José','67254'),(3940,29,'Lomas Del Sol','67254'),(3941,29,'Villas de San Jose','67254'),(3942,29,'Rinconada San Juan','67254'),(3943,29,'Mirador de la Montaña','67254'),(3944,29,'Valle de La Victoria Infonavit','67255'),(3945,29,'URBI Villa del Real','67256'),(3946,29,'Juárez','67256'),(3947,29,'Coahuila','67257'),(3948,29,'Valle las Sabinas','67257'),(3949,29,'Monte Verde','67257'),(3950,29,'Colinas Del Sol','67257'),(3951,29,'Valle Del Virrey','67257'),(3952,29,'Reforma','67257'),(3953,29,'Las Sabinas','67257'),(3954,29,'Santa Lucia','67257'),(3955,29,'Las Sabinitas','67257'),(3956,29,'Quintas las Sabinas','67257'),(3957,29,'Residencial Punta Esmeralda','67257'),(3958,29,'Calderón','67257'),(3959,29,'El Sabinal','67257'),(3960,29,'Gardenias 5 Etapa','67257'),(3961,29,'Reforma Guadalupe','67257'),(3962,29,'Las Águilas','67257'),(3963,29,'Anzures','67258'),(3964,29,'San Antonio','67259'),(3965,29,'Paseo de las Lomas','67260'),(3966,29,'Hacienda Santa Lucia II','67260'),(3967,29,'20 de Septiembre','67260'),(3968,29,'Fomerrey 131','67260'),(3969,29,'Libertadores de América','67260'),(3970,29,'Paseo Andaluz','67260'),(3971,29,'Paseo Santa Fe','67260'),(3972,29,'Santa Lidia','67262'),(3973,29,'El Nido','67262'),(3974,29,'Residencial la Morena','67262'),(3975,29,'San Jose','67262'),(3976,29,'Santa Maria','67262'),(3977,29,'La Luz','67262'),(3978,29,'Colinas de San Juan','67262'),(3979,29,'Ismael Flores','67262'),(3980,29,'Las Lomas','67265'),(3981,29,'Los Huertos','67265'),(3982,29,'Colinas Del Vergel','67265'),(3983,29,'La Ciudadela','67265'),(3984,29,'Paseo de Santa Fe','67265'),(3985,29,'Hacienda La Morena','67265'),(3986,29,'Las Quintas Residencial','67265'),(3987,29,'Praderas de Oriente','67265'),(3988,29,'Privadas los Cyranos','67265'),(3989,29,'Paraje Juárez','67265'),(3990,29,'Privadas de San Mateo','67265'),(3991,29,'El Mirador','67266'),(3992,29,'San Miguelito','67266'),(3993,29,'Portal de Juárez','67266'),(3994,29,'Hacienda Real','67266'),(3995,29,'La Paz','67266'),(3996,29,'Vistas de San Juan','67266'),(3997,29,'INFONAVIT Francisco Villa','67267'),(3998,29,'La Escondida','67267'),(3999,29,'Lomas Del Sol','67267'),(4000,29,'El Ancon','67267'),(4001,29,'Praderas de San Juan','67267'),(4002,29,'Vistas del Río','67267'),(4003,29,'Garza y Garza','67267'),(4004,29,'INFONAVIT Benito Juárez','67267'),(4005,29,'Hacienda San Benito','67267'),(4006,29,'Villas de Oriente','67267'),(4007,29,'La Ciudadela Sector Villas San Juan','67267'),(4008,29,'Residencial Terranova','67267'),(4009,29,'Hacienda de Juárez','67267'),(4010,29,'Jardines de Villa Juárez','67267'),(4011,29,'Fuentes de Juárez','67267'),(4012,29,'Villa del Real','67267'),(4013,29,'Paseo de las Margaritas','67269'),(4014,29,'Colinas Del Sol','67269'),(4015,29,'Las Margaritas','67269'),(4016,29,'Rincón del Río','67269'),(4017,29,'Colinas Del Rio','67269'),(4018,29,'Los Ebanitos','67270'),(4019,29,'Monte Kristal','67275'),(4020,29,'La Esperanza','67275'),(4021,29,'Paseo Del Prado','67275'),(4022,29,'Riviera del Sol','67275'),(4023,29,'Hector Caballero Escamilla','67275'),(4024,29,'Lomas del Huajuco','67275'),(4025,29,'Los Encinos','67275'),(4026,29,'Villa Luz','67275'),(4027,29,'San Juan','67275'),(4028,29,'Hacienda San Marcos','67276'),(4029,29,'Cerro de La Silla','67276'),(4030,29,'Gardenias','67276'),(4031,29,'Cardel','67276'),(4032,29,'Burócratas de Guadalupe','67276'),(4033,29,'Villa San Francisco','67276'),(4034,29,'Zirandaro','67277'),(4035,29,'Hacienda San Marcos','67277'),(4036,29,'Prados de San Roque','67277'),(4037,29,'Los Reyes','67277'),(4038,29,'Cerradas del Rey','67277'),(4039,29,'Balcones de Zirandaro','67277'),(4040,29,'Reserva de San Roque','67277'),(4041,29,'Portal de San Roque','67277'),(4042,29,'América Unida','67277'),(4043,29,'Vaquerías','67279'),(4044,29,'Villa los Arcos','67279'),(4045,29,'Los Arcos','67279'),(4046,29,'Rancho Viejo','67280'),(4047,29,'Monte Bello','67280'),(4048,29,'Arboledas de los Naranjos','67280'),(4049,29,'Monte Kristal 4o Sector','67280'),(4050,29,'Real Valle Sur','67280'),(4051,29,'Arboledas de San Roque','67280'),(4052,29,'Los Cometas','67280'),(4053,29,'Valle Real','67280'),(4054,29,'Santa Ana','67280'),(4055,29,'Portal de Vaquerías','67280'),(4056,29,'Valle de Vaquerías','67280'),(4057,29,'Viviendas Magdalena','67280'),(4058,29,'Jardines de los Pinos','67280'),(4059,29,'Monte Kristal','67280'),(4060,29,'Los Valles','67280'),(4061,29,'San Roque','67280'),(4062,29,'Campestre Monte Bello','67280'),(4063,29,'Hacienda Rancho Viejo','67280'),(4064,29,'Valle Sur','67280'),(4065,29,'Rancho Viejo','67280'),(4066,29,'La Maestranza','67286'),(4067,29,'San Pedro','67286'),(4068,29,'La Trinidad','67286'),(4069,29,'Los Reguiletes','67286'),(4070,29,'Las Espinas','67286'),(4071,29,'Riberas de Santa Mónica','67286'),(4072,29,'Arcadia','67286'),(4073,29,'Santa Mónica 14 Sector','67286'),(4074,29,'Bosques de San Pedro','67286'),(4075,29,'10 de Mayo','67286'),(4076,29,'Hacienda San Roque','67286'),(4077,29,'Pedregal Santa Mónica','67286'),(4078,29,'Santa Mónica 12 Sector','67286'),(4079,29,'Lomas de Santa Mónica I','67286'),(4080,29,'Lomas de Santa Mónica II','67286'),(4081,29,'Jardines de La Silla','67286'),(4082,29,'Salvador Chavez Mora','67286'),(4083,29,'Santa Mónica','67286'),(4084,29,'Hacienda los Laureles','67286'),(4085,29,'Santa Monica 13 Sector','67286'),(4086,29,'Jardines de La Silla','67287'),(4087,29,'Privadas Jardines Residencial','67287'),(4088,29,'Ricardo Flores Magón','67287'),(4089,29,'Los Naranjos','67288'),(4090,29,'Lomas de los Naranjos','67288'),(4091,29,'Héroe de Nacozari','67288'),(4092,29,'Los Laureles','67288'),(4093,29,'Sierra Vista','67288'),(4094,29,'Ex Hacienda el Rosario','67288'),(4095,29,'Villa los Naranjos','67288'),(4096,29,'Villas de la Hacienda','67288'),(4097,29,'Paseo de Acueducto Juárez','67288'),(4098,29,'Monte Kristal','67289'),(4099,29,'Punta Esmeralda Sur','67289'),(4100,29,'Diana Laura Rioja de Colosio','67289'),(4101,29,'Privada Vía Siete','67289'),(4102,29,'Valle de Juárez','67289'),(4103,29,'Santa Ana de Arriba','67290'),(4104,29,'Santa Beatriz','67290'),(4105,29,'Palos Altos','67290'),(4106,29,'Misión San Mateo','67296'),(4107,29,'San Mateo','67296'),(4108,29,'Los Canelos','67296'),(4109,29,'La Ciénega','67298'),(4110,29,'Carricitos','67298'),(4111,29,'El Campanario','67298'),(4112,29,'Bosques de La Silla','67298'),(4113,29,'La Lobita','67298'),(4114,49,'Huajuquito O los Cavazos','67300'),(4115,49,'Los Rodriguez','67300'),(4116,49,'Las Misiones','67302'),(4117,49,'Yerbaniz','67302'),(4118,49,'El Barro','67303'),(4119,49,'El Barrial','67303'),(4120,49,'El Cerrito','67303'),(4121,49,'San Andres','67303'),(4122,49,'El Ranchito','67303'),(4123,49,'La Boca','67304'),(4124,49,'Bosques de San José','67307'),(4125,49,'Piedra de Fierro','67307'),(4126,49,'San Jose Del Norte','67307'),(4127,49,'San Pedro','67307'),(4128,49,'La Esperanza','67307'),(4129,49,'San Jose Sur','67307'),(4130,49,'Cieneguilla','67308'),(4131,49,'Potrero de Serna','67308'),(4132,49,'San Francisco','67308'),(4133,49,'Cola de Caballo','67308'),(4134,49,'Santiago Centro','67310'),(4135,49,'El Pueblito de Santiago','67310'),(4136,49,'Villa Rosario','67310'),(4137,49,'Del Maestro','67312'),(4138,49,'Aserradero','67312'),(4139,49,'San Francisco','67312'),(4140,49,'Jardines de Santiago','67313'),(4141,49,'Valle Escondido','67314'),(4142,49,'Valle Del Barreal','67314'),(4143,49,'San Jorge','67314'),(4144,49,'Condado de Asturias','67315'),(4145,49,'Viento Libre','67315'),(4146,49,'Valles de Santiago','67315'),(4147,49,'Las Huertas','67316'),(4148,49,'Hector Caballero','67316'),(4149,49,'La Boca','67317'),(4150,49,'Punta la Boca','67317'),(4151,49,'Las Cristalinas','67317'),(4152,49,'Santa Rosalía','67318'),(4153,49,'Arturo Cavazos','67318'),(4154,49,'Aldabas de Cavazzo','67318'),(4155,49,'Huajuquito','67318'),(4156,49,'Concepción Salazar','67318'),(4157,49,'Las Cristalinas','67318'),(4158,49,'El Cercado Centro','67320'),(4159,49,'15 de Mayo','67320'),(4160,49,'San Javier','67322'),(4161,49,'Terrero','67322'),(4162,49,'Alameda','67322'),(4163,49,'S R H','67322'),(4164,49,'Lomas Del Cercado','67322'),(4165,49,'Los Pescadores','67322'),(4166,49,'Jardines de La Boca','67323'),(4167,49,'Los Nísperos','67323'),(4168,49,'Salto Del Café','67323'),(4169,49,'Las Hadas','67323'),(4170,49,'Antonio Villalón','67323'),(4171,49,'Alonso Chavez','67324'),(4172,49,'Campestre Santa Clara','67324'),(4173,49,'Bosques de las Lomas','67324'),(4174,49,'R Garza Madero','67324'),(4175,49,'Las Margaritas','67325'),(4176,49,'Piedra de Fierro','67327'),(4177,49,'Los Fierros','67327'),(4178,49,'Santa Tais','67328'),(4179,49,'Raul Caballero Escamilla','67328'),(4180,49,'Bosque de San Pedro','67328'),(4181,49,'San Pedro El Álamo','67328'),(4182,49,'San Jose Sur','67328'),(4183,49,'San Jose Norte','67329'),(4184,49,'Cieneguilla','67329'),(4185,49,'La Plazuela','67329'),(4186,49,'Melchor Ocampo','67329'),(4187,49,'Blas Chumacero','67329'),(4188,49,'Valle Alto','67329'),(4189,49,'Residencial Hacienda Santiago','67329'),(4190,49,'La Ciénega de González','67330'),(4191,49,'Potrero Redondo','67334'),(4192,49,'El Tejocote','67337'),(4193,49,'Laguna de Sanchez','67338'),(4194,49,'Bosque Residencial','67340'),(4195,49,'San Juan Bautista','67340'),(4196,49,'San Jose de las Boquillas','67344'),(4197,3,'Nuevo Repueblo','67350'),(4198,3,'Sección Diego Lopez','67350'),(4199,3,'San Javier','67350'),(4200,3,'Los Barros Sección','67350'),(4201,3,'Alfonso Martinez Dominguez','67350'),(4202,3,'Independencia','67350'),(4203,3,'Sócrates Rizo (Valle de los Duraznos)','67350'),(4204,3,'Santa Engracia','67350'),(4205,3,'Sección los Álamos','67350'),(4206,3,'Hacienda Valle Real','67350'),(4207,3,'Baudilio Silva','67350'),(4208,3,'Sección Zaragoza','67350'),(4209,3,'Sección Juárez','67350'),(4210,3,'Eduardo Livas Villareal','67350'),(4211,3,'Rio Ramos','67350'),(4212,3,'Colinas de Allende','67350'),(4213,3,'Sección Buenavista','67350'),(4214,3,'Sección Centro','67350'),(4215,3,'Valle Dorado','67350'),(4216,3,'Los Encinos','67350'),(4217,3,'El Vergel','67350'),(4218,3,'Los Perales','67350'),(4219,3,'Raul Caballero','67350'),(4220,3,'Eduardo A Elizondo','67350'),(4221,3,'Benito Juárez','67350'),(4222,3,'Popular','67350'),(4223,3,'Valle los Naranjos','67350'),(4224,3,'Valle de los Álamos','67350'),(4225,3,'Los Maestros','67350'),(4226,3,'Elverdin Azahares','67350'),(4227,3,'Los Sabinos','67353'),(4228,3,'Paso Hondo','67353'),(4229,3,'El Porvenir','67353'),(4230,3,'El Cerrito','67353'),(4231,3,'Jáuregui','67354'),(4232,3,'Atongo de Allende','67362'),(4233,3,'Los Terreros','67363'),(4234,3,'Los Aguirre','67363'),(4235,3,'Los Guzmán','67370'),(4236,3,'San Antonio','67372'),(4237,3,'Hacienda San Antonio','67373'),(4238,3,'Lazarillos de Abajo','67374'),(4239,3,'Las Cruces (Carretera Nacional Kilómetro 236)','67374'),(4240,3,'Las Raíces','67380'),(4241,3,'Lazarillos de Arriba','67382'),(4242,3,'Las Boquillas','67383'),(4243,3,'La Colmena de Abajo','67383'),(4244,3,'La Colmena de Arriba','67383'),(4245,20,'Progreso','67400'),(4246,20,'Alegres de Terán','67400'),(4247,20,'El Granjenal','67400'),(4248,20,'Los Naranjos','67400'),(4249,20,'Gral. Terán','67400'),(4250,20,'Citricultores','67400'),(4251,20,'California','67403'),(4252,20,'Ramirez','67405'),(4253,20,'Ojo de Agua','67405'),(4254,20,'La Purísima','67406'),(4255,20,'Las Anacuas','67413'),(4256,20,'Las Anacuas','67413'),(4257,20,'La Unión','67413'),(4258,20,'Las Anacuitas','67414'),(4259,20,'La Corona','67415'),(4260,20,'Las Brisas','67416'),(4261,20,'Santa Engracia','67416'),(4262,20,'Encadenado','67416'),(4263,20,'Encadenado','67417'),(4264,20,'Guadalupe de La Joya','67423'),(4265,20,'San Julián','67430'),(4266,20,'San Pedro','67440'),(4267,20,'Buenavista de Jimenez','67448'),(4268,8,'Lázaro Cárdenas','67451'),(4269,8,'Santa Fe','67453'),(4270,8,'Las Nutrias','67454'),(4271,8,'San Juan','67454'),(4272,8,'El Castillo','67456'),(4273,8,'Chihuahua','67456'),(4274,8,'San Bartolo','67456'),(4275,8,'Valle del Roble','67456'),(4276,8,'San Bartolo','67456'),(4277,8,'El Mezcal','67457'),(4278,8,'San Juan de los Garza','67459'),(4279,8,'Atongo de Abajo','67460'),(4280,8,'San Rafael','67462'),(4281,8,'La Trinidad','67462'),(4282,8,'El Refugio','67463'),(4283,8,'El Alamito','67463'),(4284,8,'La Ceja','67463'),(4285,8,'Santa Isabel','67464'),(4286,8,'San Lorenzo','67464'),(4287,8,'La Esperanza','67465'),(4288,8,'Los Palmitos','67465'),(4289,8,'Los Palmitos','67465'),(4290,8,'El Barranquito','67467'),(4291,8,'San Isidro','67467'),(4292,8,'Lajitas de Arriba','67467'),(4293,8,'La Unión','67467'),(4294,8,'Las Palmas','67467'),(4295,8,'Las Adjuntas','67469'),(4296,8,'Las Palomitas (La Fragua)','67470'),(4297,8,'San Juan','67470'),(4298,8,'Rancho Viejo','67473'),(4299,8,'El Calvario','67473'),(4300,8,'Estación Cadereyta','67473'),(4301,8,'Las Trancas','67474'),(4302,8,'El Refugio (el Nopalito)','67474'),(4303,8,'La Chueca','67474'),(4304,8,'Sabarado','67474'),(4305,8,'Casas Viejas (la Florida)','67474'),(4306,8,'San Miguelito','67474'),(4307,8,'Santa Efigenia','67474'),(4308,8,'La Soledad Herrera','67475'),(4309,8,'Soledad Herrera','67475'),(4310,8,'Cadereyta Jiménez Centro','67480'),(4311,8,'Graciano Sanchez','67483'),(4312,8,'Jerónimo Treviño 1er Sec.','67483'),(4313,8,'Nueva Cadereyta','67483'),(4314,8,'Rafael de Leon','67483'),(4315,8,'San Juan','67483'),(4316,8,'Candelaria Ríos','67483'),(4317,8,'Fidel Velázquez','67483'),(4318,8,'Lázaro Cárdenas 2do Sec.','67483'),(4319,8,'Nueva Cadereyta','67483'),(4320,8,'Veteranos','67483'),(4321,8,'Pedregal de Cadereyta','67483'),(4322,8,'Alfredo V. Bonfil','67483'),(4323,8,'PEMEX','67483'),(4324,8,'Las Misiones','67483'),(4325,8,'Lázaro Cárdenas 1er Sec.','67483'),(4326,8,'Lázaro Cárdenas 3er Sec.','67483'),(4327,8,'La Capilla','67483'),(4328,8,'Gloria Mendiola','67483'),(4329,8,'Jerónimo Treviño 2do Sec.','67483'),(4330,8,'Burócratas Municipales','67483'),(4331,8,'Ignacio Allende','67484'),(4332,8,'Praderas de Cadereyta','67484'),(4333,8,'Jose Luis Lozano','67484'),(4334,8,'San Moisés','67484'),(4335,8,'Residencial Paraíso','67484'),(4336,8,'INFONAVIT Jerónimo Treviño','67484'),(4337,8,'José O. Martinez Secc. A','67484'),(4338,8,'Residencial Jardines de Compostela','67484'),(4339,8,'Alberos','67484'),(4340,8,'Marin','67484'),(4341,8,'Villa Luz','67484'),(4342,8,'Jardines de Capellania','67484'),(4343,8,'Salinas de Gortari','67484'),(4344,8,'Santa Cecilia','67484'),(4345,8,'Valle de Cadereyta','67484'),(4346,8,'Fidel Velázquez','67484'),(4347,8,'INFONAVIT Arboledas','67484'),(4348,8,'José O. Martinez Secc. B','67484'),(4349,8,'Valles Del Rey','67484'),(4350,8,'Galindo','67485'),(4351,8,'López Mateos 2do Sec.','67485'),(4352,8,'La Rioja','67485'),(4353,8,'Privadas San Juan','67485'),(4354,8,'Santa Liliana','67485'),(4355,8,'El Rosario','67485'),(4356,8,'Santa Lucia','67485'),(4357,8,'Real de Cadereyta','67485'),(4358,8,'Bella Vista 4to Sector','67485'),(4359,8,'San Ignacio 1er Sec.','67485'),(4360,8,'Casa Blanca','67485'),(4361,8,'Las Espigas','67485'),(4362,8,'Emiliano Zapata 1er Sec','67485'),(4363,8,'Framboyanes','67485'),(4364,8,'Las Norias','67485'),(4365,8,'Nueva Madero','67485'),(4366,8,'Emiliano Zapata 3er Sec','67485'),(4367,8,'Santa Maria','67485'),(4368,8,'Padilla','67485'),(4369,8,'Bellavista','67485'),(4370,8,'Las Espigas 2do Sector','67485'),(4371,8,'Fomerrey Cadereyta','67485'),(4372,8,'Emiliano Zapata 2do Sec','67485'),(4373,8,'Galindo','67485'),(4374,8,'Garza Cantu','67485'),(4375,8,'San Genaro 1er Sector','67485'),(4376,8,'Las Palmas','67485'),(4377,8,'Jardines de Cadereyta','67485'),(4378,8,'Cadereyta','67485'),(4379,8,'López Mateos 1er Sec.','67485'),(4380,8,'INFONAVIT Sabinitos','67485'),(4381,8,'Delia','67485'),(4382,8,'Lomas de Los Pilares 3er Sec.','67486'),(4383,8,'Lomas de los Pilares 1er Sec.','67486'),(4384,8,'Lomas de los Pilares 2do Sec.','67486'),(4385,8,'PEMEX Refinería','67488'),(4386,8,'El Tepehuaje','67490'),(4387,8,'La Concepción','67490'),(4388,8,'Pueblo Nuevo','67490'),(4389,8,'La Haciendita','67492'),(4390,8,'El Tepehuaje','67493'),(4391,8,'Dolores','67493'),(4392,8,'Santa Isabel y Dolores','67493'),(4393,8,'Vaqueros','67496'),(4394,8,'El Matorral','67497'),(4395,8,'El Barco','67498'),(4396,8,'Valle Hidalgo','67498'),(4397,39,'Montemorelos Centro','67500'),(4398,39,'Matamoros','67510'),(4399,39,'El Maestro','67510'),(4400,39,'Las Palmas','67512'),(4401,39,'Zambrano','67512'),(4402,39,'Maranatha','67515'),(4403,39,'Real del Valle','67515'),(4404,39,'Los Sabinos','67515'),(4405,39,'Del Bosque','67515'),(4406,39,'Los Fresnos','67515'),(4407,39,'Los Nogales','67515'),(4408,39,'El Fresno','67515'),(4409,39,'Paras','67520'),(4410,39,'Cruz Verde','67528'),(4411,39,'Hacienda los Naranjos','67528'),(4412,39,'Zaragoza','67530'),(4413,39,'Alfonso Martinez Dominguez','67535'),(4414,39,'La Fé','67535'),(4415,39,'Morelos II','67535'),(4416,39,'1ro de Mayo','67535'),(4417,39,'Mendivil','67540'),(4418,39,'Anita','67541'),(4419,39,'Panteones','67542'),(4420,39,'Infonavit 2do Sector','67543'),(4421,39,'Jose Maria Morelos y Pavón','67543'),(4422,39,'Monumento','67543'),(4423,39,'Infonavit 3er Sector','67543'),(4424,39,'Valeriano Garcia Galvan','67543'),(4425,39,'Lázaro Cárdenas','67543'),(4426,39,'Raul Caballero','67543'),(4427,39,'Infonavit 1er Sector','67543'),(4428,39,'Hortencia Gonzalez','67543'),(4429,39,'Burócratas Municipales','67544'),(4430,39,'Infonavit 4to Sector','67544'),(4431,39,'Morelos I','67544'),(4432,39,'Mexiquito','67550'),(4433,39,'El Consuelo','67554'),(4434,39,'Naranjos','67560'),(4435,39,'Gil de Leyva','67560'),(4436,39,'Padre Mier','67560'),(4437,39,'Monte Real','67560'),(4438,39,'Las Alamedas','67563'),(4439,39,'Zaragoza','67563'),(4440,39,'Lerdo de Tejada','67570'),(4441,39,'La Ladrillera','67580'),(4442,39,'Francisco Villa','67587'),(4443,39,'Miguel Hidalgo','67588'),(4444,39,'Jose Maria Paras','67588'),(4445,39,'6 de Abril','67588'),(4446,39,'Emiliano Zapata','67589'),(4447,39,'Garza Garcia','67590'),(4448,39,'Jose Lopez Portillo','67590'),(4449,39,'Jalisco','67599'),(4450,39,'San Miguel','67600'),(4451,39,'El Fraile','67600'),(4452,39,'Los Arroyos','67604'),(4453,39,'Valle de Hidalgo','67606'),(4454,39,'Tierras Coloradas','67606'),(4455,39,'Rancho Escondido','67607'),(4456,39,'Calles','67608'),(4457,39,'Canoas','67610'),(4458,39,'Loma Prieta','67610'),(4459,39,'El Desagüe','67611'),(4460,39,'El Bajío','67612'),(4461,39,'Buenavista','67613'),(4462,39,'Ojo de Agua','67614'),(4463,39,'Chihuahua','67614'),(4464,39,'San Vicente','67615'),(4465,39,'Las Puentes','67616'),(4466,39,'El Pastor','67617'),(4467,39,'Gral. Escobedo','67618'),(4468,39,'El Terrero','67619'),(4469,39,'El Nogalito','67619'),(4470,39,'Las Raíces','67619'),(4471,39,'Los Adobes','67619'),(4472,39,'La Unión 2','67637'),(4473,39,'El Toro','67637'),(4474,39,'Huertas Estación','67639'),(4475,39,'Las Adjuntas','67640'),(4476,43,'Rayones','67650'),(4477,43,'Santa Rosa','67670'),(4478,43,'El Barreal','67680'),(4479,43,'Pedro Carrizales','67690'),(4480,31,'Linares Centro','67700'),(4481,31,'INFONAVIT Rodrigo Gómez','67710'),(4482,31,'Alvarado','67710'),(4483,31,'Las Palmas','67710'),(4484,31,'La Amistad','67713'),(4485,31,'América','67714'),(4486,31,'Los Nogales','67714'),(4487,31,'Las Brisas','67714'),(4488,31,'San Felipe','67714'),(4489,31,'Gloria Mendiola','67715'),(4490,31,'INFONAVIT Río Verde','67716'),(4491,31,'San Luisito','67716'),(4492,31,'INFONAVIT Dr. Ignacio Morones Prieto','67716'),(4493,31,'Benito Juárez','67720'),(4494,31,'Los Noriega','67720'),(4495,31,'San Joaquín','67730'),(4496,31,'FOMERREY Ignacio Zaragoza','67730'),(4497,31,'Ignacio Zaragoza','67730'),(4498,31,'INFONAVIT Jardines de Linares','67730'),(4499,31,'Camacho','67730'),(4500,31,'Ciudad Industrial','67735'),(4501,31,'Arboledas del Valle','67735'),(4502,31,'Villegas','67740'),(4503,31,'Sócrates Rizzo','67750'),(4504,31,'Buenos Aires','67750'),(4505,31,'La Petaca','67750'),(4506,31,'Ricardo Cantu','67750'),(4507,31,'Fomerrey 53 las Huertas','67754'),(4508,31,'Residencial Nogalar','67754'),(4509,31,'Provileon','67755'),(4510,31,'Linares IV Fovissste','67755'),(4511,31,'Residencial Hacienda los Nogales','67755'),(4512,31,'INFONAVIT El Cerrito','67755'),(4513,31,'El Cerrito','67755'),(4514,31,'INFONAVIT La Petaca','67756'),(4515,31,'INFONAVIT Constituyentes de 1857','67756'),(4516,31,'INFONAVIT San Gerardo','67756'),(4517,31,'Las Bugambilias','67756'),(4518,31,'Fidel Velázquez','67756'),(4519,31,'Moderna','67760'),(4520,31,'Las Palmas (Camachito)','67767'),(4521,31,'Camachito','67767'),(4522,31,'San Francisco','67768'),(4523,31,'Alejandro Cano','67769'),(4524,31,'Los Naranjos','67769'),(4525,31,'Miguel Hidalgo','67770'),(4526,31,'Porfirio Diaz','67770'),(4527,31,'Niños Héroes','67778'),(4528,31,'Marco Antonio','67778'),(4529,31,'Misión de San Gerardo','67778'),(4530,31,'El Vergel','67778'),(4531,31,'Las Alamedas','67778'),(4532,31,'El Roble','67779'),(4533,31,'La Bohemia','67779'),(4534,31,'Solidaridad','67780'),(4535,31,'Villaseca','67780'),(4536,31,'Zaragoza','67780'),(4537,31,'Lomas de Villaseca','67790'),(4538,31,'Riveras de San Antonio','67790'),(4539,31,'Tepeyac','67790'),(4540,31,'San Carlos','67790'),(4541,31,'San Antonio','67790'),(4542,31,'Lázaro Dimas','67790'),(4543,31,'San Rafael','67800'),(4544,31,'Caja Pinta','67800'),(4545,31,'San Felipe','67800'),(4546,31,'Dr. Ignacio Morones Prieto','67800'),(4547,31,'La Loma','67800'),(4548,31,'San Francisco Del Tenamaxtle','67800'),(4549,31,'El Popote','67802'),(4550,31,'El 10','67802'),(4551,31,'La Morita','67802'),(4552,31,'Santa Rosa','67803'),(4553,31,'Benitez','67804'),(4554,31,'El Refugio','67804'),(4555,31,'El Perico','67805'),(4556,31,'Jesús Maria Del Puerto','67805'),(4557,31,'La Soledad','67806'),(4558,31,'La Reforma','67806'),(4559,31,'Ranchería','67808'),(4560,31,'Los Fresnos','67808'),(4561,31,'Los Álamos','67809'),(4562,31,'San Jose','67809'),(4563,31,'San Isidro','67812'),(4564,31,'Gatos Gueros','67812'),(4565,31,'El Porvenir','67815'),(4566,31,'San Jacinto','67815'),(4567,31,'Dolores de San Julián','67816'),(4568,31,'El Carmen de los Elizondo','67816'),(4569,31,'Guadalupe','67817'),(4570,31,'Los Leones','67817'),(4571,31,'Cerro Prieto','67817'),(4572,31,'San Pedro Garza Garcia','67819'),(4573,31,'El Petril','67819'),(4574,31,'Loma Alta','67824'),(4575,31,'La Estrella','67824'),(4576,31,'Guadalupe Victoria','67824'),(4577,31,'Huerta Santa Teresa','67825'),(4578,31,'Emiliano Zapata','67825'),(4579,31,'Lampazos','67825'),(4580,31,'La Escondida','67825'),(4581,31,'Rio Verde Km. 3','67826'),(4582,31,'Brasil','67828'),(4583,31,'Vista Hermosa','67828'),(4584,31,'Ojo de Agua','67828'),(4585,28,'Iturbide','67830'),(4586,28,'Cuevas','67842'),(4587,28,'La Luz','67844'),(4588,28,'Camarones','67845'),(4589,28,'El Madroño','67846'),(4590,28,'Buenavista','67847'),(4591,28,'Santa Inés','67849'),(4592,28,'San Francisco de las Adjuntas','67849'),(4593,16,'Jose Salazar Reyna','67850'),(4594,16,'Del Maestro 2o Sector','67850'),(4595,16,'Barrio de Jalisco','67850'),(4596,16,'Labradores','67850'),(4597,16,'El Potosí','67850'),(4598,16,'El Potrero Prieto de Arriba','67850'),(4599,16,'Sócrates Rizo','67850'),(4600,16,'Mariano Escobedo','67850'),(4601,16,'El Mirador','67850'),(4602,16,'Galeana','67850'),(4603,16,'El Cristal','67850'),(4604,16,'Laguna de Labradores','67850'),(4605,16,'Santa Rita','67850'),(4606,16,'El Potrero Prieto de Abajo','67850'),(4607,16,'Jalisco','67850'),(4608,16,'El Chamizal','67850'),(4609,16,'El Peñuelo','67853'),(4610,16,'San Antonio de Gonzalez','67853'),(4611,16,'El Barrocito','67853'),(4612,16,'El Canelito','67853'),(4613,16,'San Isidro de Berlanga','67853'),(4614,16,'San Juan de Dios','67853'),(4615,16,'El Carmen','67854'),(4616,16,'Puerto Pastores','67854'),(4617,16,'La Primavera','67855'),(4618,16,'Santo Domingo','67855'),(4619,16,'Los Magueyes','67855'),(4620,16,'San Roberto','67855'),(4621,16,'Santa Cruz de Sauces','67856'),(4622,16,'Los Nogales','67856'),(4623,16,'El Derramadero','67856'),(4624,16,'San Francisco de los Blancos','67856'),(4625,16,'18 de Marzo','67856'),(4626,16,'San Jose de La Hoya','67857'),(4627,16,'San Lucas','67857'),(4628,16,'Los Llanitos','67857'),(4629,16,'El Orito','67857'),(4630,16,'San Juan de Mimbres','67858'),(4631,16,'Los Mimbres','67858'),(4632,16,'San Francisco Javier','67858'),(4633,16,'San Ildefonso','67858'),(4634,16,'La Lagunita','67860'),(4635,16,'Puerto México','67860'),(4636,16,'El Herial','67860'),(4637,16,'La Providencia','67860'),(4638,16,'Ciénega Del Toro','67860'),(4639,16,'La Casita','67860'),(4640,16,'Navidad','67860'),(4641,16,'El Cuije','67860'),(4642,16,'El Prado','67860'),(4643,16,'Santa Cruz Ciénega Del Toro','67860'),(4644,16,'San Juan Del Prado','67860'),(4645,16,'La Esperanza','67860'),(4646,16,'Hediondilla','67863'),(4647,16,'La Carbonera','67863'),(4648,16,'Las Delicias','67863'),(4649,16,'La Trinidad','67864'),(4650,16,'San Joaquín','67864'),(4651,16,'La Paz','67864'),(4652,16,'Santa Maria de Ramos','67864'),(4653,16,'Los Adobes','67864'),(4654,16,'San Rafael','67865'),(4655,16,'Boca Del Refugio','67865'),(4656,16,'San Pablo','67866'),(4657,16,'Tanquecillos','67866'),(4658,16,'Santa Maria Del Socorro','67866'),(4659,16,'Estados Unidos','67867'),(4660,16,'San Jose de La Martha','67867'),(4661,16,'Santa Clara de Ciénega','67867'),(4662,16,'El Castillo','67868'),(4663,16,'San Jose de Raíces 2','67870'),(4664,16,'San Pablo de Raíces','67870'),(4665,16,'San Jorge','67870'),(4666,16,'San Jose de Raíces','67870'),(4667,16,'El Tepozan','67870'),(4668,16,'La Leona','67870'),(4669,16,'Presita de Berlanga','67870'),(4670,16,'San Francisco de Berlanga','67872'),(4671,16,'Las Margaritas','67872'),(4672,16,'Calabacillas','67873'),(4673,16,'San Ignacio de Texas','67873'),(4674,16,'El Refugio de los Ibarra','67874'),(4675,16,'Jesús Maria de Aguirre','67874'),(4676,16,'San Antonio Del Salero','67874'),(4677,16,'Joyas de Agua Fría','67875'),(4678,16,'Rio de San Jose','67875'),(4679,16,'Texas','67875'),(4680,16,'Pablillo','67875'),(4681,16,'San Pablo de Mitras','67876'),(4682,16,'San Jose de Gonzalez','67876'),(4683,16,'La Nueva Primavera','67877'),(4684,16,'Tokio','67877'),(4685,16,'La Poza','67878'),(4686,16,'Minas de San Jose','67878'),(4687,16,'San Marcos','67878'),(4688,16,'El Palmito','67878'),(4689,16,'San Pablo de Tranquitas','67878'),(4690,16,'Santa Clara de Gonzalez','67878'),(4691,16,'Santa Fe','67878'),(4692,27,'La Laja','67880'),(4693,27,'Maguiras','67881'),(4694,27,'El Cangrejo','67884'),(4695,27,'El Pinto','67885'),(4696,27,'Santa Rosa','67885'),(4697,27,'Hualahuises Centro','67890'),(4698,27,'CTM 1er Sector','67893'),(4699,27,'Raul Caballero Sector II','67893'),(4700,27,'CTM 2do Sector','67893'),(4701,27,'Raul Caballero Sector I','67893'),(4702,27,'Santa Rosa','67895'),(4703,27,'Emiliano Zapata','67895'),(4704,27,'La Esperanza','67895'),(4705,27,'Nueva Esperanza','67895'),(4706,27,'Potrerillos','67896'),(4707,27,'Magueyera','67897'),(4708,27,'CROC','67898'),(4709,27,'Presidente Juárez','67898'),(4710,27,'San Cristóbal','67899'),(4711,27,'San Cristóbal','67899'),(4712,12,'Martinez Dominguez','67900'),(4713,12,'Sócrates Rizzo','67900'),(4714,12,'Pintores Mexicanos','67900'),(4715,12,'Las Brisas','67900'),(4716,12,'J Treviño','67900'),(4717,12,'Dr. Arroyo Centro','67900'),(4718,12,'Acuña','67902'),(4719,12,'Capaderito','67902'),(4720,12,'Presa de San Carlos','67904'),(4721,12,'Palma Gorda','67904'),(4722,12,'Panales de Arriba','67904'),(4723,12,'El Carmen de Castaño','67904'),(4724,12,'San Isidro de Fernandez','67905'),(4725,12,'San Jose de Flores','67905'),(4726,12,'Boquillas','67905'),(4727,12,'San Vicente de La Puerta','67905'),(4728,12,'Cerrito Del Aire','67905'),(4729,12,'Puerto de Dolores','67906'),(4730,12,'Lagunita de Castillo','67907'),(4731,12,'Laguna de Castillo','67907'),(4732,12,'Tapona de Camarillo','67907'),(4733,12,'Puerto Del Aire','67908'),(4734,12,'La Concepción','67908'),(4735,12,'Presa de Maltos','67908'),(4736,12,'Las 14','67908'),(4737,12,'El Leoncito','67912'),(4738,12,'El Canelo','67913'),(4739,12,'El Tajo','67913'),(4740,12,'Mesa de Gonzalez','67914'),(4741,12,'Lagunita y Ranchos Nuevos','67915'),(4742,12,'San Pablo de los Rueda','67916'),(4743,12,'Estanque Nuevo','67917'),(4744,12,'El Tecolote','67920'),(4745,12,'San Juan Del Palmar','67920'),(4746,12,'Los Medina','67920'),(4747,12,'Santa Rita','67920'),(4748,12,'La Yerba','67920'),(4749,12,'Santa Ana','67921'),(4750,12,'Amaro','67923'),(4751,12,'El Pequeño','67923'),(4752,12,'El Refugio de los Cedillos','67923'),(4753,12,'El Rucio','67924'),(4754,12,'El Charco de La Granja','67925'),(4755,12,'San Cayetano de Vacas','67925'),(4756,12,'Jesús Maria de Berrones','67926'),(4757,12,'La Unión y Cardonal','67926'),(4758,12,'Tanquecillos','67926'),(4759,12,'Coloradas','67926'),(4760,12,'Santa Gertrudis','67926'),(4761,12,'La Aguita','67926'),(4762,12,'Cerritos de Vacas','67928'),(4763,12,'La Escondida de Arzola','67928'),(4764,12,'San Miguelito','67928'),(4765,12,'El Represadero','67928'),(4766,12,'El Jarro','67930'),(4767,12,'Los Cuartos','67930'),(4768,12,'El Carmen de La Laja','67930'),(4769,12,'El Charquillo','67930'),(4770,12,'La Lajita','67930'),(4771,12,'Mesa Del Traidor','67931'),(4772,12,'San Ramon de Martinez','67931'),(4773,12,'Puerta de Aguilar','67932'),(4774,12,'Santa Teresa','67932'),(4775,12,'San Francisco Del Yugo','67933'),(4776,12,'Guadalupe de Silva','67933'),(4777,12,'La Cruz de Elorza','67933'),(4778,12,'San Pedro de Gonzalez','67934'),(4779,12,'El Álamo','67934'),(4780,12,'Santa Maria','67934'),(4781,12,'San Francisco de los Desmontes','67935'),(4782,12,'Albercones','67935'),(4783,12,'Las Jarillas','67935'),(4784,12,'El Consuelo','67936'),(4785,12,'Álvaro Obregón','67936'),(4786,12,'La Chiripa','67936'),(4787,12,'San Miguel de los Aguirre','67936'),(4788,12,'La Balsa','67937'),(4789,12,'Santa Lucia','67937'),(4790,12,'Presita de Rueda','67937'),(4791,12,'San Antonio de Peña Nevada','67937'),(4792,12,'La Bolsa','67937'),(4793,12,'San Juan de La Cruz','67937'),(4794,12,'El Reparo','67938'),(4795,12,'San Gregorio','67938'),(4796,12,'San Ignacio de Torres','67938'),(4797,6,'Aramberri Centro','67940'),(4798,6,'Emiliano Zapata','67940'),(4799,6,'Rancho Nuevo (Las Hornillas)','67940'),(4800,6,'Sección Sur','67940'),(4801,6,'Sección Norte','67940'),(4802,6,'Brownsville','67940'),(4803,6,'El Calichal','67940'),(4804,6,'La Tijera','67940'),(4805,6,'Jesús María','67943'),(4806,6,'Agua Adentro','67943'),(4807,6,'La Peña','67943'),(4808,6,'La Vieja','67943'),(4809,6,'Santa Teresa','67943'),(4810,6,'Agua Fría','67943'),(4811,6,'El Nogalar (La Pita)','67943'),(4812,6,'Poblado el Río (El Sabinito)','67943'),(4813,6,'Callejón de los Vázquez','67943'),(4814,6,'Potrero del Padre (Lagunita de González)','67943'),(4815,6,'Salitrillo','67943'),(4816,6,'La Hoya de los Nogales','67943'),(4817,6,'El Rosario','67943'),(4818,6,'Fraccionamiento del Río (Fracción del Río)','67943'),(4819,6,'Garza','67943'),(4820,6,'Marmolejo','67943'),(4821,6,'Chaloa (San Mauricio)','67943'),(4822,6,'La Paila','67943'),(4823,6,'Las Higueritas','67943'),(4824,6,'Las Veredas','67943'),(4825,6,'La Escondida','67944'),(4826,6,'El Callejón de la Cueva','67944'),(4827,6,'El Gato','67944'),(4828,6,'La Lobera','67944'),(4829,6,'Las Mancuernas','67944'),(4830,6,'Milpillas','67944'),(4831,6,'Los Nogales','67944'),(4832,6,'Agua Delgada','67944'),(4833,6,'El Olmo','67944'),(4834,6,'El Realito (La Parrita)','67944'),(4835,6,'El Rincón','67944'),(4836,6,'Potrero de Zamora','67944'),(4837,6,'Rancho Nuevo','67944'),(4838,6,'El Muerto','67944'),(4839,6,'La Florida','67944'),(4840,6,'El Molino','67944'),(4841,6,'El Pitacoche (La Tinaja)','67944'),(4842,6,'El Talco','67944'),(4843,6,'La Carpintería','67944'),(4844,6,'Salitrillo','67944'),(4845,6,'El Pitacoche','67944'),(4846,6,'Granjenal','67944'),(4847,6,'Ojo de Agua','67944'),(4848,6,'Las Ánimas','67944'),(4849,6,'Puerto Carretas','67944'),(4850,6,'El Cedrito','67944'),(4851,6,'La Lagunita (Lagunita de los Vázquez)','67944'),(4852,6,'Lagunita (Lagunita de los Cerda)','67944'),(4853,6,'San Isidro','67944'),(4854,6,'Santa Cruz','67944'),(4855,6,'La Aldea','67944'),(4856,6,'El Alamar','67944'),(4857,6,'El Monal','67944'),(4858,6,'El Refugio','67944'),(4859,6,'Los Nogales (El Mezquital)','67944'),(4860,6,'La Soledad (Rusia)','67945'),(4861,6,'El Tepozán','67945'),(4862,6,'El Carrizalillo','67945'),(4863,6,'La Nueva Reforma (Buenos Aires)','67945'),(4864,6,'La Sabanilla','67945'),(4865,6,'Sandia el Chico','67945'),(4866,6,'El Tigre','67945'),(4867,6,'La Sabanilla','67946'),(4868,6,'La Víbora','67946'),(4869,6,'Cedritos','67946'),(4870,6,'Pozo Dos','67947'),(4871,6,'San Juan de Avilés','67947'),(4872,6,'Puentes (San Juan y Puentes)','67947'),(4873,6,'La Rosita (Los Llanitos)','67947'),(4874,6,'Dolores Palmita','67947'),(4875,6,'La Trinidad','67947'),(4876,6,'El Pinalito','67947'),(4877,6,'La Peña','67947'),(4878,6,'San Juanito de Reséndiz','67948'),(4879,6,'San Rafael de los Cortez','67948'),(4880,6,'San Rafael de los Cortez (La Cuesta)','67948'),(4881,6,'Santa Rita','67948'),(4882,6,'Agua de Mata','67948'),(4883,6,'La Esperanza','67948'),(4884,6,'Aranjuez','67948'),(4885,6,'Las Virgenes','67948'),(4886,6,'El Calichal','67948'),(4887,6,'El Tejón','67948'),(4888,6,'Ojo de Agua','67948'),(4889,6,'Hoya de Bocacelly','67948'),(4890,6,'Pedregosa','67948'),(4891,6,'San Rafael de los Cortes (Las Cruces)','67948'),(4892,6,'Los Cuartitos','67948'),(4893,6,'El Porvenir','67948'),(4894,6,'Joyas y Anteojitos','67948'),(4895,6,'Santa Ana','67948'),(4896,6,'Cuartitos y Marmolejo (Parada Marmolejo)','67948'),(4897,6,'El Anillo','67948'),(4898,6,'El Mezquital','67948'),(4899,6,'El Porvenir','67948'),(4900,6,'La Palmita','67948'),(4901,6,'Laguna de Bocacelly','67948'),(4902,6,'San Juan','67948'),(4903,6,'La Ascensión','67950'),(4904,6,'El Derramadero','67953'),(4905,6,'San Rafael del Llano','67953'),(4906,6,'La Ascensión (Esteban Salazar)','67953'),(4907,6,'Presa de Anteojitos','67953'),(4908,6,'Puerto de Anteojitos','67953'),(4909,6,'La Laguna','67953'),(4910,6,'La Reforma','67953'),(4911,6,'El Coyote','67953'),(4912,6,'Milpa Vieja (San Manuel)','67953'),(4913,6,'San Joaquín de Soto','67953'),(4914,6,'Sandia (Sandi el Grande)','67954'),(4915,6,'Las Presas','67954'),(4916,6,'El Puerto','67954'),(4917,6,'La Victoria (Los Ángeles)','67954'),(4918,6,'Erasmo Vázquez','67954'),(4919,6,'El Sauz','67954'),(4920,6,'El Jilguero','67955'),(4921,6,'La Angostura','67955'),(4922,6,'El Rucio','67955'),(4923,6,'La Muralla','67955'),(4924,6,'San Rafael de la Angostura (La Cueva)','67955'),(4925,6,'Milpillas','67955'),(4926,6,'Guadalupe de los Navarro','67955'),(4927,6,'Juan Méndez Castro','67955'),(4928,6,'La Atarjea (El Pinal)','67955'),(4929,6,'La Canoa','67955'),(4930,6,'La Colorada','67955'),(4931,6,'La Mesa de Alcocer','67955'),(4932,6,'Vista Hermosa','67955'),(4933,6,'San Jose Del Jilguero','67955'),(4934,6,'Puerto Bajo','67955'),(4935,6,'La Caballada','67955'),(4936,6,'Agua de Enmedio (Los Pocitos)','67955'),(4937,6,'Guadalupe Victoria','67955'),(4938,6,'Presa de las Animas','67956'),(4939,6,'Puerto Piñones','67956'),(4940,6,'San Enrique (Los Mendoza)','67956'),(4941,6,'La Majada','67956'),(4942,6,'Rancho Nuevo','67956'),(4943,6,'San Juanito de Solís','67956'),(4944,6,'San Isidro','67956'),(4945,6,'Centro Caprino','67956'),(4946,6,'Las Juanas','67956'),(4947,6,'El Cuervo Uno','67957'),(4948,6,'El Rodeo','67957'),(4949,6,'Hoya de Bocacil','67957'),(4950,6,'Cañón de Vacas (El Jardín)','67957'),(4951,6,'Las Joyitas','67957'),(4952,6,'El Astillero','67957'),(4953,6,'Las Delicias','67957'),(4954,6,'El Jardín (Cañón de Vacas)','67957'),(4955,6,'El Saucillo','67957'),(4956,6,'La Reforma','67957'),(4957,6,'San Francisco de Leos','67957'),(4958,6,'El Leoncito','67957'),(4959,6,'Las Palmas','67957'),(4960,6,'El Paraíso (San Antonio Mesa de las Piedras)','67957'),(4961,6,'El Yerbaniz','67957'),(4962,6,'La Boquilla','67957'),(4963,6,'El Cuervo Dos','67957'),(4964,6,'El Nacimiento','67957'),(4965,6,'El Refugio (Refugio de Texas)','67957'),(4966,6,'San Antonio','67957'),(4967,6,'Lampacitos','67957'),(4968,6,'La Corona','67957'),(4969,6,'Las Higueritas','67957'),(4970,6,'Yerbaniz','67957'),(4971,6,'Las Mulas','67958'),(4972,6,'Monillal','67958'),(4973,6,'Duraznillos','67958'),(4974,6,'El Naranjo','67958'),(4975,6,'El Puerto','67958'),(4976,6,'La Tinaja','67958'),(4977,6,'Ibarrilla (Rincón de Ibarrilla)','67958'),(4978,6,'Álamos','67958'),(4979,6,'Esquivel','67958'),(4980,6,'Ignacio Zaragoza','67958'),(4981,6,'Lagunitas','67958'),(4982,6,'Los Laureles','67958'),(4983,6,'Ojo de Agua','67958'),(4984,6,'Ballenitas','67958'),(4985,6,'Puerto Rincón de Jesús','67958'),(4986,6,'El Divisadero','67958'),(4987,6,'El Rincón de Jesús','67958'),(4988,6,'El Sauz','67958'),(4989,6,'La Gota','67958'),(4990,6,'El Tejocote','67959'),(4991,22,'Dulces Nombres','67960'),(4992,22,'General Zaragoza','67960'),(4993,22,'El Charco','67965'),(4994,22,'El Refugio','67965'),(4995,22,'Tepozanes','67965'),(4996,22,'Maravillas','67966'),(4997,22,'San Josecito','67972'),(4998,22,'San Francisco','67973'),(4999,22,'El Baral','67974'),(5000,22,'La Joya de Alardin','67974'),(5001,22,'El Salitre','67975'),(5002,22,'Encantada','67976'),(5003,22,'Joya de San Diego','67977'),(5004,22,'La Cieneguita','67977'),(5005,22,'Siberia','67978'),(5006,37,'Cerros Blancos','67980'),(5007,37,'Presita de Cerros Blancos','67980'),(5008,37,'Tapona Morena','67980'),(5009,37,'San Isidro','67980'),(5010,37,'La Cardona','67980'),(5011,37,'San Rafael de Martinez','67980'),(5012,37,'Mier y Noriega','67980'),(5013,37,'Las Palomas','67982'),(5014,37,'Dolores','67983'),(5015,37,'El Gallito','67984'),(5016,37,'Jesús Maria Del Terrero','67985'),(5017,37,'San Jose de Medina','67986'),(5018,37,'El Refugio','67990'),(5019,37,'San Antonio de Alamitos','67996');
/*!40000 ALTER TABLE `colonia` ENABLE KEYS */;
UNLOCK TABLES;

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
  PRIMARY KEY (`id`),
  KEY `fk_venta_asesor_asesor1_idx` (`asesor_id`),
  KEY `fk_venta_asesor_venta1_idx` (`venta_id`),
  CONSTRAINT `fk_venta_asesor_asesor1` FOREIGN KEY (`asesor_id`) REFERENCES `asesor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_asesor_venta1` FOREIGN KEY (`venta_id`) REFERENCES `venta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comision`
--

LOCK TABLES `comision` WRITE;
/*!40000 ALTER TABLE `comision` DISABLE KEYS */;
INSERT INTO `comision` VALUES (13,1,25,'2015-05-21 01:48:45','2015-05-21 01:48:45',14685,0,0);
/*!40000 ALTER TABLE `comision` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `concepto_capacidad`
--

LOCK TABLES `concepto_capacidad` WRITE;
/*!40000 ALTER TABLE `concepto_capacidad` DISABLE KEYS */;
INSERT INTO `concepto_capacidad` VALUES (1,'Gaveta'),(2,'Osario');
/*!40000 ALTER TABLE `concepto_capacidad` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=233 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `construccion`
--

LOCK TABLES `construccion` WRITE;
/*!40000 ALTER TABLE `construccion` DISABLE KEYS */;
INSERT INTO `construccion` VALUES (1,1,'Bajo pasto Sencilla'),(2,2,'Bajo pasto Sencilla'),(3,3,'Capilla Elevada'),(4,4,'Bajo Pasto Sencilla'),(5,5,'Bajo Pasto Sencilla'),(6,6,'Bajo Pasto Doble'),(7,7,'Bajo Pasto Doble'),(8,8,'Bajo Pasto Doble'),(9,9,'Bajo Pasto Doble'),(10,10,'Bajo Pasto Doble'),(11,11,'Bajo Pasto Doble'),(12,12,'Bajo Pasto Doble'),(13,13,'Bajo Pasto Doble'),(14,14,'Bajo Pasto Doble'),(15,15,'Bajo Pasto Sencilla'),(16,16,'Bajo Pasto Sencilla'),(17,17,'Bajo Pasto Sencilla'),(18,18,'Bajo Pasto Doble'),(19,19,'Bajo Pasto Doble'),(20,20,'Bajo Pasto Sencilla'),(21,21,'Bajo Pasto Sencilla'),(22,22,'Bajo Pasto Sencilla'),(23,23,'Bajo Pasto Sencilla'),(24,24,'Bajo Pasto Sencilla'),(25,25,'Bajo Pasto Sencilla'),(26,26,'Bajo Pasto Sencilla'),(27,27,'Bajo Pasto Sencilla'),(28,28,'Bajo Pasto Sencilla'),(29,29,'Bajo Pasto Sencilla'),(30,30,'Bajo Pasto Sencilla'),(31,31,'Bajo Pasto Sencilla'),(32,32,'Bajo Pasto Sencilla'),(33,33,'Bajo Pasto Sencilla'),(34,34,'Bajo Pasto Sencilla'),(35,35,'Bajo Pasto Sencilla'),(36,36,'Bajo Pasto Sencilla'),(37,37,'Bajo Pasto Sencilla'),(38,38,'Bajo Pasto Sencilla'),(39,39,'Bajo Pasto Sencilla'),(40,40,'Bajo Pasto Sencilla'),(41,41,'Bajo Pasto Sencilla'),(42,42,'Bajo Pasto Sencilla'),(43,43,'Bajo Pasto Sencilla'),(44,44,'Bajo Pasto Sencilla'),(45,45,'Bajo Pasto Sencilla'),(46,46,'Bajo Pasto Sencilla'),(47,47,'Bajo Pasto Sencilla'),(48,48,'Bajo Pasto Sencilla'),(49,49,'Bajo Pasto Sencilla'),(50,50,'Bajo Pasto Sencilla'),(51,51,'Bajo Pasto Sencilla'),(52,52,'Bajo Pasto Sencilla'),(53,53,'Bajo Pasto Sencilla'),(54,54,'Bajo Pasto Sencilla'),(55,55,'Bajo Pasto Sencilla'),(56,56,'Bajo Pasto Sencilla'),(57,57,'Bajo Pasto Sencilla'),(58,58,'Bajo Pasto Sencilla'),(59,59,'Bajo Pasto Sencilla'),(60,60,'Bajo Pasto Sencilla'),(61,61,'Bajo Pasto Sencilla'),(62,62,'Bajo Pasto Sencilla'),(63,63,'Bajo Pasto Sencilla'),(64,64,'Bajo Pasto Sencilla'),(65,65,'Bajo Pasto Sencilla'),(66,66,'Bajo Pasto Sencilla'),(67,67,'Bajo Pasto Sencilla'),(68,68,'Bajo Pasto Sencilla'),(69,69,'Bajo Pasto Sencilla'),(70,70,'Bajo Pasto Sencilla'),(71,71,'Bajo Pasto Sencilla'),(72,72,'Bajo Pasto Sencilla'),(73,73,'Bajo Pasto Sencilla'),(74,74,'Bajo Pasto Sencilla'),(75,75,'Bajo Pasto Sencilla'),(76,76,'Bajo Pasto Sencilla'),(77,77,'Bajo Pasto Sencilla'),(78,78,'Bajo Pasto Sencilla'),(79,79,'Bajo Pasto Sencilla'),(80,80,'Bajo Pasto Sencilla'),(81,81,'Bajo Pasto Sencilla'),(82,82,'Bajo Pasto Sencilla'),(83,83,'Bajo Pasto Sencilla'),(84,84,'Bajo Pasto Sencilla'),(85,85,'Bajo Pasto Sencilla'),(86,86,'Bajo Pasto Sencilla'),(87,87,'Bajo Pasto Sencilla'),(88,88,'Bajo Pasto Sencilla'),(89,89,'Bajo Pasto Sencilla'),(90,90,'Bajo Pasto Sencilla'),(91,91,'Bajo Pasto Sencilla'),(92,92,'Bajo Pasto Sencilla'),(93,93,'Bajo Pasto Sencilla'),(94,94,'Bajo Pasto Sencilla'),(95,95,'Bajo Pasto Sencilla'),(96,96,'Bajo Pasto Sencilla'),(97,97,'Bajo Pasto Sencilla'),(98,98,'Bajo Pasto Sencilla'),(99,99,'Bajo Pasto Sencilla'),(100,100,'Bajo Pasto Sencilla'),(101,101,'Bajo Pasto Sencilla'),(102,102,'Bajo Pasto Sencilla'),(103,103,'Bajo Pasto Sencilla'),(104,104,'Bajo Pasto Sencilla'),(105,105,'Bajo Pasto Sencilla'),(106,106,'Bajo Pasto Sencilla'),(107,107,'Bajo Pasto Sencilla'),(108,108,'Bajo Pasto Sencilla'),(109,109,'Bajo Pasto Sencilla'),(110,111,'Capilla Elevada'),(111,112,'Capilla Elevada'),(112,113,'Capilla Elevada'),(113,114,'Capilla Elevada'),(114,115,'Bajo Pasto Sencilla'),(115,116,'Bajo Pasto Sencilla'),(116,117,'Bajo Pasto Sencilla'),(117,118,'Bajo Pasto Sencilla'),(118,119,'Bajo Pasto Sencilla'),(119,120,'Bajo Pasto Sencilla'),(120,121,'Bajo Pasto Sencilla'),(121,122,'Bajo Pasto Sencilla'),(122,123,'Bajo Pasto Sencilla'),(123,124,'Bajo Pasto Sencilla'),(124,125,'Bajo Pasto Sencilla'),(125,126,'Bajo Pasto Sencilla'),(126,127,'Bajo Pasto Sencilla'),(127,128,'Bajo Pasto Sencilla'),(128,129,'Bajo Pasto Sencilla'),(129,130,'Bajo Pasto Sencilla'),(130,131,'Bajo Pasto Sencilla'),(131,132,'Bajo Pasto Sencilla'),(132,133,'Bajo Pasto Sencilla'),(133,134,'Bajo Pasto Sencilla'),(134,135,'Bajo Pasto Sencilla'),(135,136,'Bajo Pasto Sencilla'),(136,137,'Bajo Pasto Sencilla'),(137,138,'Bajo Pasto Sencilla'),(138,139,'Bajo Pasto Sencilla'),(139,140,'Bajo Pasto Sencilla'),(140,141,'Bajo Pasto Sencilla'),(141,142,'Bajo Pasto Sencilla'),(142,143,'Bajo Pasto Sencilla'),(143,144,'Bajo Pasto Sencilla'),(144,145,'Bajo Pasto Sencilla'),(145,146,'Bajo Pasto Sencilla'),(146,147,'Bajo Pasto Sencilla'),(147,148,'Bajo Pasto Sencilla'),(148,149,'Bajo Pasto Sencilla'),(149,150,'Bajo Pasto Sencilla'),(150,151,'Bajo Pasto Sencilla'),(151,152,'Bajo Pasto Sencilla'),(152,153,'Bajo Pasto Sencilla'),(153,154,'Bajo Pasto Sencilla'),(154,155,'Bajo Pasto Sencilla'),(155,156,'Bajo Pasto Sencilla'),(156,157,'Bajo Pasto Sencilla'),(157,158,'Bajo Pasto Sencilla'),(158,159,'Bajo Pasto Doble'),(159,160,'Bajo Pasto Sencilla'),(160,161,'Capilla Elevada'),(161,162,'Bajo Pasto Sencilla'),(162,163,'Bajo Pasto Sencilla'),(163,164,'Bajo Pasto Sencilla'),(164,165,'Bajo Pasto Sencilla'),(165,166,'Bajo Pasto Sencilla'),(166,167,'Bajo Pasto Sencilla'),(167,168,'Bajo Pasto Sencilla'),(168,169,'Bajo Pasto Sencilla'),(169,170,'Bajo Pasto Sencilla'),(170,171,'Bajo Pasto Sencilla'),(171,172,'Bajo Pasto Sencilla'),(172,173,'Bajo Pasto Sencilla'),(173,174,'Bajo Pasto Sencilla'),(174,175,'Bajo Pasto Sencilla'),(175,176,'Bajo Pasto Sencilla'),(176,177,'Bajo Pasto Sencilla'),(177,178,'Bajo Pasto Sencilla'),(178,179,'Bajo Pasto Sencilla'),(179,180,'Bajo Pasto Sencilla'),(180,181,'Bajo Pasto Sencilla'),(181,182,'Bajo Pasto Sencilla'),(182,183,'Bajo Pasto Sencilla'),(183,184,'Bajo Pasto Sencilla'),(184,185,'Bajo Pasto Sencilla'),(185,186,'Bajo Pasto Sencilla'),(186,187,'Bajo Pasto Sencilla'),(187,188,'Bajo Pasto Sencilla'),(188,189,'Bajo Pasto Sencilla'),(189,190,'Bajo Pasto Sencilla'),(190,191,'Bajo Pasto Sencilla'),(191,192,'Bajo Pasto Sencilla'),(192,193,'Bajo Pasto Sencilla'),(193,194,'Bajo Pasto Sencilla'),(194,195,'Bajo Pasto Sencilla'),(195,196,'Bajo Pasto Sencilla'),(196,197,'Bajo Pasto Sencilla'),(197,198,'Bajo Pasto Sencilla'),(198,199,'Bajo Pasto Sencilla'),(199,200,'Bajo Pasto Sencilla'),(200,201,'Bajo Pasto Sencilla'),(201,202,'Bajo Pasto Sencilla'),(202,203,'Bajo Pasto Sencilla'),(203,204,'Jardin privado Doble'),(204,205,'Bajo pasto Sencilla'),(205,206,'Bajo pasto Sencilla'),(206,207,'Capilla Elevada'),(207,208,'Capilla Elevada'),(208,209,'Capilla Elevada'),(209,210,'Capilla Elevada'),(210,211,'Bajo pasto Sencilla'),(211,212,'Bajo pasto Sencilla'),(212,213,'Capilla Elevada'),(213,214,'Bajo pasto Sencilla'),(214,215,'Tradicional Triple'),(215,216,'Tradicional Sencilla'),(216,217,'Tradicional Sencilla'),(217,218,'Tradicional Sencilla'),(218,219,'Bajo pasto Sencilla'),(219,220,'Bajo Pasto Sencilla'),(220,221,'Bajo Pasto Sencilla'),(221,222,'Bajo Pasto Sencilla'),(222,223,'Bajo Pasto Sencilla'),(223,224,'Bajo Pasto Sencilla'),(224,225,'Bajo Pasto Sencilla'),(225,226,'Bajo Pasto Sencilla'),(226,227,'Bajo Pasto Sencilla'),(227,228,'Bajo Pasto Sencilla'),(228,229,'Bajo Pasto Sencilla'),(229,230,'Bajo Pasto Sencilla'),(230,231,'Bajo Pasto Sencilla'),(231,232,'Bajo Pasto Sencilla'),(232,233,'Bajo Pasto Sencilla');
/*!40000 ALTER TABLE `construccion` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `contrato`
--

LOCK TABLES `contrato` WRITE;
/*!40000 ALTER TABLE `contrato` DISABLE KEYS */;
INSERT INTO `contrato` VALUES (1,1,'abc123','creado solo con fines de relleno');
/*!40000 ALTER TABLE `contrato` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `contrato_venta_producto`
--

LOCK TABLES `contrato_venta_producto` WRITE;
/*!40000 ALTER TABLE `contrato_venta_producto` DISABLE KEYS */;
/*!40000 ALTER TABLE `contrato_venta_producto` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cupon`
--

LOCK TABLES `cupon` WRITE;
/*!40000 ALTER TABLE `cupon` DISABLE KEYS */;
INSERT INTO `cupon` VALUES (1,2,2000,'La placa del cliente salió dañada, por lo que se le hace una bonificación.',0,1),(2,3,5000,'Por puro gusto',0,1),(3,4,0,'Dia del taco',50,1),(4,4,300,'prueba',5,1),(5,1,5000,'cambio de material de recubrimiento',0,1),(6,4,1,'2 x 1 compra 3 urnas y te regalamos 1',8,1);
/*!40000 ALTER TABLE `cupon` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `cupon_venta`
--

LOCK TABLES `cupon_venta` WRITE;
/*!40000 ALTER TABLE `cupon_venta` DISABLE KEYS */;
/*!40000 ALTER TABLE `cupon_venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departamento`
--

DROP TABLE IF EXISTS `departamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamento`
--

LOCK TABLES `departamento` WRITE;
/*!40000 ALTER TABLE `departamento` DISABLE KEYS */;
INSERT INTO `departamento` VALUES (1,'Sistemas'),(2,'Mantenimiento'),(3,'Recubrimientos'),(4,'Operaciones'),(5,'Ventas'),(6,'Administracion'),(7,'Tramites');
/*!40000 ALTER TABLE `departamento` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleado`
--

LOCK TABLES `empleado` WRITE;
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
INSERT INTO `empleado` VALUES (1,136,1,'2015-02-12',0),(2,137,1,'1989-03-31',1),(3,138,1,'2015-02-02',1),(4,139,4,'2015-02-03',1),(5,140,1,'2015-02-02',1),(6,141,1,'2015-08-14',1),(7,142,1,'2015-02-14',1),(8,143,1,'2015-02-24',1),(9,144,1,'2015-02-08',1),(10,145,1,'2015-02-02',1),(11,146,4,'0000-00-00',1),(12,147,2,'0000-00-00',1),(13,148,2,'0000-00-00',1),(14,149,2,'0000-00-00',1),(15,150,2,'0000-00-00',1),(16,151,2,'2015-02-24',1),(17,152,3,'0000-00-00',1),(18,153,3,'0000-00-00',1),(19,154,3,'0000-00-00',1),(20,155,3,'0000-00-00',1),(21,156,5,'0000-00-00',1),(22,166,2,'2015-05-07',1);
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `empresa`
--

LOCK TABLES `empresa` WRITE;
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
INSERT INTO `empresa` VALUES (1,'Parque Funeral Guadalupe','INVERSIONES PFG S.A. DE C.V.','IPF060209STA','8357-2875 y 8357-6865','Ex-Ejido Mederos S/N Col. La Estanzuela',64988,40,1,'virgen.png');
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `estado`
--

LOCK TABLES `estado` WRITE;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
INSERT INTO `estado` VALUES (1,1,'Aguascalientes'),(2,1,'Baja California'),(3,1,'Baja California Sur'),(4,1,'Campeche'),(5,1,'Chiapas'),(6,1,'Chihuahua'),(7,1,'Coahuila'),(8,1,'Colima'),(9,1,'Distrito Federal'),(10,1,'Durango'),(11,1,'Estado de México'),(12,1,'Guanajuato'),(13,1,'Guerrero'),(14,1,'Hidalgo'),(15,1,'Jalisco'),(16,1,'Michoacán'),(17,1,'Morelos'),(18,1,'Nayarit'),(19,1,'Nuevo León'),(20,1,'Oaxaca'),(21,1,'Puebla'),(22,1,'Querétaro'),(23,1,'Quintana Roo'),(24,1,'San Luis Potosí'),(25,1,'Sinaloa'),(26,1,'Sonora'),(27,1,'Tabasco'),(28,1,'Tamaulipas'),(29,1,'Tlaxcala'),(30,1,'Veracruz'),(31,1,'Yucatán'),(32,1,'Zacatecas');
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_civil`
--

LOCK TABLES `estado_civil` WRITE;
/*!40000 ALTER TABLE `estado_civil` DISABLE KEYS */;
INSERT INTO `estado_civil` VALUES (1,'Soltero'),(2,'Casado'),(3,'Divorciado'),(4,'Viudo ');
/*!40000 ALTER TABLE `estado_civil` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `estatus`
--

LOCK TABLES `estatus` WRITE;
/*!40000 ALTER TABLE `estatus` DISABLE KEYS */;
/*!40000 ALTER TABLE `estatus` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `etapa`
--

LOCK TABLES `etapa` WRITE;
/*!40000 ALTER TABLE `etapa` DISABLE KEYS */;
/*!40000 ALTER TABLE `etapa` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `exhumacion`
--

LOCK TABLES `exhumacion` WRITE;
/*!40000 ALTER TABLE `exhumacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `exhumacion` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `extra`
--

LOCK TABLES `extra` WRITE;
/*!40000 ALTER TABLE `extra` DISABLE KEYS */;
/*!40000 ALTER TABLE `extra` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forma_pago`
--

LOCK TABLES `forma_pago` WRITE;
/*!40000 ALTER TABLE `forma_pago` DISABLE KEYS */;
INSERT INTO `forma_pago` VALUES (1,'EFECTIVO'),(2,'TARJETA DE CREDITO'),(3,'TRANSFERENCIA BANCARIA'),(4,'CHEQUE');
/*!40000 ALTER TABLE `forma_pago` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `formato`
--

LOCK TABLES `formato` WRITE;
/*!40000 ALTER TABLE `formato` DISABLE KEYS */;
INSERT INTO `formato` VALUES (1,'Contrato de lote funerario',1,1,'2015-02-24 22:34:56','0000-00-00 00:00:00','');
/*!40000 ALTER TABLE `formato` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `funeraria`
--

LOCK TABLES `funeraria` WRITE;
/*!40000 ALTER TABLE `funeraria` DISABLE KEYS */;
INSERT INTO `funeraria` VALUES (1,'Capillas Parque Funeral Guadalupe'),(2,'Capillas Marianas'),(3,'Capillas Benito M. Flores');
/*!40000 ALTER TABLE `funeraria` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `funeraria_venta_inhumacion`
--

LOCK TABLES `funeraria_venta_inhumacion` WRITE;
/*!40000 ALTER TABLE `funeraria_venta_inhumacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `funeraria_venta_inhumacion` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `inhumacion`
--

LOCK TABLES `inhumacion` WRITE;
/*!40000 ALTER TABLE `inhumacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `inhumacion` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `inhumado`
--

LOCK TABLES `inhumado` WRITE;
/*!40000 ALTER TABLE `inhumado` DISABLE KEYS */;
INSERT INTO `inhumado` VALUES (1,32,'2012-08-12','1976-03-23'),(2,98,'2013-09-12',NULL);
/*!40000 ALTER TABLE `inhumado` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `inventario`
--

LOCK TABLES `inventario` WRITE;
/*!40000 ALTER TABLE `inventario` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventario` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=234 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lote`
--

LOCK TABLES `lote` WRITE;
/*!40000 ALTER TABLE `lote` DISABLE KEYS */;
INSERT INTO `lote` VALUES (1,1,1,NULL,NULL),(2,2,1,NULL,NULL),(3,3,1,NULL,NULL),(4,4,1,NULL,NULL),(5,5,1,NULL,NULL),(6,6,1,NULL,NULL),(7,7,1,NULL,NULL),(8,8,1,NULL,NULL),(9,9,1,NULL,NULL),(10,10,1,NULL,NULL),(11,11,1,NULL,NULL),(12,12,1,NULL,NULL),(13,13,1,NULL,NULL),(14,14,1,NULL,NULL),(15,15,1,NULL,NULL),(16,16,1,NULL,NULL),(17,17,1,NULL,NULL),(18,18,1,NULL,NULL),(19,19,1,NULL,NULL),(20,20,1,NULL,NULL),(21,21,1,NULL,NULL),(22,22,1,NULL,NULL),(23,23,1,NULL,NULL),(24,24,1,NULL,NULL),(25,25,1,NULL,NULL),(26,26,1,NULL,NULL),(27,27,1,NULL,NULL),(28,28,1,NULL,NULL),(29,29,1,NULL,NULL),(30,30,1,NULL,NULL),(31,31,1,NULL,NULL),(32,32,1,NULL,NULL),(33,33,1,NULL,NULL),(34,34,1,NULL,NULL),(35,35,1,NULL,NULL),(36,36,1,NULL,NULL),(37,37,1,NULL,NULL),(38,38,1,NULL,NULL),(39,39,1,NULL,NULL),(40,40,1,NULL,NULL),(41,41,1,NULL,NULL),(42,42,1,NULL,NULL),(43,43,1,NULL,NULL),(44,44,1,NULL,NULL),(45,45,1,NULL,NULL),(46,46,1,NULL,NULL),(47,47,1,NULL,NULL),(48,48,1,NULL,NULL),(49,49,1,NULL,NULL),(50,50,1,NULL,NULL),(51,51,1,NULL,NULL),(52,52,1,NULL,NULL),(53,53,1,NULL,NULL),(54,54,1,NULL,NULL),(55,55,1,NULL,NULL),(56,56,1,NULL,NULL),(57,57,1,NULL,NULL),(58,58,1,NULL,NULL),(59,59,1,NULL,NULL),(60,60,1,NULL,NULL),(61,61,1,NULL,NULL),(62,62,1,NULL,NULL),(63,63,1,NULL,NULL),(64,64,1,NULL,NULL),(65,65,1,NULL,NULL),(66,66,1,NULL,NULL),(67,67,1,NULL,NULL),(68,68,1,NULL,NULL),(69,69,1,NULL,NULL),(70,70,1,NULL,NULL),(71,71,1,NULL,NULL),(72,72,1,NULL,NULL),(73,73,1,NULL,NULL),(74,74,1,NULL,NULL),(75,75,1,NULL,NULL),(76,76,1,NULL,NULL),(77,77,1,NULL,NULL),(78,78,1,NULL,NULL),(79,79,1,NULL,NULL),(80,80,1,NULL,NULL),(81,81,1,NULL,NULL),(82,82,1,NULL,NULL),(83,83,1,NULL,NULL),(84,84,1,NULL,NULL),(85,85,1,NULL,NULL),(86,86,1,NULL,NULL),(87,87,1,NULL,NULL),(88,88,1,NULL,NULL),(89,89,1,NULL,NULL),(90,90,1,NULL,NULL),(91,91,1,NULL,NULL),(92,92,1,NULL,NULL),(93,93,1,NULL,NULL),(94,94,1,NULL,NULL),(95,95,1,NULL,NULL),(96,96,1,NULL,NULL),(97,97,1,NULL,NULL),(98,98,1,NULL,NULL),(99,99,1,NULL,NULL),(100,100,1,NULL,NULL),(101,101,1,NULL,NULL),(102,102,1,NULL,NULL),(103,103,1,NULL,NULL),(104,104,1,NULL,NULL),(105,105,1,NULL,NULL),(106,106,1,NULL,NULL),(107,107,1,NULL,NULL),(108,108,1,NULL,NULL),(109,109,1,NULL,NULL),(110,111,1,NULL,NULL),(111,111,1,NULL,NULL),(112,112,1,NULL,NULL),(113,113,1,NULL,NULL),(114,114,1,NULL,NULL),(115,115,1,NULL,NULL),(116,116,1,NULL,NULL),(117,117,1,NULL,NULL),(118,118,1,NULL,NULL),(119,119,1,NULL,NULL),(120,120,1,NULL,NULL),(121,121,1,NULL,NULL),(122,122,1,NULL,NULL),(123,123,1,NULL,NULL),(124,124,1,NULL,NULL),(125,125,1,NULL,NULL),(126,126,1,NULL,NULL),(127,127,1,NULL,NULL),(128,128,1,NULL,NULL),(129,129,1,NULL,NULL),(130,130,1,NULL,NULL),(131,131,1,NULL,NULL),(132,132,1,NULL,NULL),(133,133,1,NULL,NULL),(134,134,1,NULL,NULL),(135,135,1,NULL,NULL),(136,136,1,NULL,NULL),(137,137,1,NULL,NULL),(138,138,1,NULL,NULL),(139,139,1,NULL,NULL),(140,140,1,NULL,NULL),(141,141,1,NULL,NULL),(142,142,1,NULL,NULL),(143,143,1,NULL,NULL),(144,144,1,NULL,NULL),(145,145,1,NULL,NULL),(146,146,1,NULL,NULL),(147,147,1,NULL,NULL),(148,148,1,NULL,NULL),(149,149,1,NULL,NULL),(150,150,1,NULL,NULL),(151,151,1,NULL,NULL),(152,152,1,NULL,NULL),(153,153,1,NULL,NULL),(154,154,1,NULL,NULL),(155,155,1,NULL,NULL),(156,156,1,NULL,NULL),(157,157,1,NULL,NULL),(158,158,1,NULL,NULL),(159,159,1,NULL,NULL),(160,160,1,NULL,NULL),(161,161,1,NULL,NULL),(162,162,1,NULL,NULL),(163,163,1,NULL,NULL),(164,164,1,NULL,NULL),(165,165,1,NULL,NULL),(166,166,1,NULL,NULL),(167,167,1,NULL,NULL),(168,168,1,NULL,NULL),(169,169,1,NULL,NULL),(170,170,1,NULL,NULL),(171,171,1,NULL,NULL),(172,172,1,NULL,NULL),(173,173,1,NULL,NULL),(174,174,1,NULL,NULL),(175,175,1,NULL,NULL),(176,176,1,NULL,NULL),(177,177,1,NULL,NULL),(178,178,1,NULL,NULL),(179,179,1,NULL,NULL),(180,180,1,NULL,NULL),(181,181,1,NULL,NULL),(182,182,1,NULL,NULL),(183,183,1,NULL,NULL),(184,184,1,NULL,NULL),(185,185,1,NULL,NULL),(186,186,1,NULL,NULL),(187,187,1,NULL,NULL),(188,188,1,NULL,NULL),(189,189,1,NULL,NULL),(190,190,1,NULL,NULL),(191,191,1,NULL,NULL),(192,192,1,NULL,NULL),(193,193,1,NULL,NULL),(194,194,1,NULL,NULL),(195,195,1,NULL,NULL),(196,196,1,NULL,NULL),(197,197,1,NULL,NULL),(198,198,1,NULL,NULL),(199,199,1,NULL,NULL),(200,200,1,NULL,NULL),(201,201,1,NULL,NULL),(202,202,1,NULL,NULL),(203,203,1,NULL,NULL),(204,204,1,NULL,NULL),(205,205,1,NULL,NULL),(206,206,1,NULL,NULL),(207,207,1,NULL,NULL),(208,208,1,NULL,NULL),(209,209,1,NULL,NULL),(210,210,1,NULL,NULL),(211,211,1,NULL,NULL),(212,212,1,NULL,NULL),(213,213,1,NULL,NULL),(214,214,1,NULL,NULL),(215,215,1,NULL,NULL),(216,216,1,NULL,NULL),(217,217,1,NULL,NULL),(218,218,1,NULL,NULL),(219,219,1,NULL,NULL),(220,220,1,NULL,NULL),(221,221,1,NULL,NULL),(222,222,1,NULL,NULL),(223,223,1,NULL,NULL),(224,224,1,NULL,NULL),(225,225,1,NULL,NULL),(226,226,1,NULL,NULL),(227,227,1,NULL,NULL),(228,228,1,NULL,NULL),(229,229,1,NULL,NULL),(230,230,1,NULL,NULL),(231,231,1,NULL,NULL),(232,232,1,NULL,NULL),(233,233,1,NULL,NULL);
/*!40000 ALTER TABLE `lote` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mantenimiento`
--

LOCK TABLES `mantenimiento` WRITE;
/*!40000 ALTER TABLE `mantenimiento` DISABLE KEYS */;
/*!40000 ALTER TABLE `mantenimiento` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `mantenimiento_queja`
--

LOCK TABLES `mantenimiento_queja` WRITE;
/*!40000 ALTER TABLE `mantenimiento_queja` DISABLE KEYS */;
/*!40000 ALTER TABLE `mantenimiento_queja` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `material_valor`
--

LOCK TABLES `material_valor` WRITE;
/*!40000 ALTER TABLE `material_valor` DISABLE KEYS */;
/*!40000 ALTER TABLE `material_valor` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `medio_comunicacion`
--

LOCK TABLES `medio_comunicacion` WRITE;
/*!40000 ALTER TABLE `medio_comunicacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `medio_comunicacion` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `movimiento`
--

LOCK TABLES `movimiento` WRITE;
/*!40000 ALTER TABLE `movimiento` DISABLE KEYS */;
/*!40000 ALTER TABLE `movimiento` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `municipio`
--

LOCK TABLES `municipio` WRITE;
/*!40000 ALTER TABLE `municipio` DISABLE KEYS */;
INSERT INTO `municipio` VALUES (1,19,'Abasolo'),(2,19,'Agualeguas'),(3,19,'Allende'),(4,19,'Anáhuac'),(5,19,'Apodaca'),(6,19,'Aramberri'),(7,19,'Bustamante'),(8,19,'Cadereyta Jiménez'),(9,19,'Cerralvo'),(10,19,'China'),(11,19,'Ciénega de Flores'),(12,19,'Doctor Arroyo'),(13,19,'Doctor Coss'),(14,19,'Doctor González'),(15,19,'El Carmen'),(16,19,'Galeana'),(17,19,'García'),(18,19,'General Bravo'),(19,19,'General Escobedo'),(20,19,'General Terán'),(21,19,'General Treviño'),(22,19,'General Zaragoza'),(23,19,'General Zuazua'),(24,19,'Guadalupe'),(25,19,'Hidalgo'),(26,19,'Higueras'),(27,19,'Hualahuises'),(28,19,'Iturbide'),(29,19,'Juárez'),(30,19,'Lampazos de Naranjo'),(31,19,'Linares'),(32,19,'Los Aldamas'),(33,19,'Los Herreras'),(34,19,'Los Ramones'),(35,19,'Marín'),(36,19,'Melchor Ocampo'),(37,19,'Mier y Noriega'),(38,19,'Mina'),(39,19,'Montemorelos'),(40,19,'Monterrey'),(41,19,'Parás'),(42,19,'Pesquería'),(43,19,'Rayones'),(44,19,'Sabinas Hidalgo'),(45,19,'Salinas Victoria'),(46,19,'San Nicolás de los Garza'),(47,19,'San Pedro Garza García'),(48,19,'Santa Catarina'),(49,19,'Santiago'),(50,19,'Vallecillo'),(51,19,'Villaldama');
/*!40000 ALTER TABLE `municipio` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nicho`
--

LOCK TABLES `nicho` WRITE;
/*!40000 ALTER TABLE `nicho` DISABLE KEYS */;
/*!40000 ALTER TABLE `nicho` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `pago`
--

LOCK TABLES `pago` WRITE;
/*!40000 ALTER TABLE `pago` DISABLE KEYS */;
/*!40000 ALTER TABLE `pago` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `pais`
--

LOCK TABLES `pais` WRITE;
/*!40000 ALTER TABLE `pais` DISABLE KEYS */;
INSERT INTO `pais` VALUES (1,'México','mx'),(2,'Estados Unidos','us');
/*!40000 ALTER TABLE `pais` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `panteon`
--

LOCK TABLES `panteon` WRITE;
/*!40000 ALTER TABLE `panteon` DISABLE KEYS */;
/*!40000 ALTER TABLE `panteon` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `panteon_venta_exhumacion`
--

LOCK TABLES `panteon_venta_exhumacion` WRITE;
/*!40000 ALTER TABLE `panteon_venta_exhumacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `panteon_venta_exhumacion` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paquete`
--

LOCK TABLES `paquete` WRITE;
/*!40000 ALTER TABLE `paquete` DISABLE KEYS */;
/*!40000 ALTER TABLE `paquete` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=167 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persona`
--

LOCK TABLES `persona` WRITE;
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` VALUES (1,'Ana Cecilia','Galván','García'),(2,'Cruz Felipe','Rodríguez','López'),(3,'Daniel','Sánchez','Inda'),(4,'Felipe de Jesús','Díaz','Llamas'),(5,'Julio Hilario','Peña','Carmona'),(6,'Moises','Mora','Martinez'),(7,'Nazaret','Llanos','Valderrama'),(8,'Ofelia Guadalupe','Puga','Torres'),(9,'Patricia','Garza','González'),(10,'Rosalinda','González','Guerra'),(11,'Sofía','Coronado','González'),(12,'CYNTHIA','NAVARRO','SANCHEZ'),(13,'ESTHELA','MEDELLIN','RANGEL'),(14,'ESTHER','GARCÍA','CASTRO'),(15,'GENOVEVA','TORRES','RODRIGUEZ'),(16,'ROSARIO','MATA','MARTÍNEZ'),(17,'DOLORES','SÁNCHEZ','VILLANUEVA'),(18,'JUANY','NAJERA','OLVERA'),(19,'AURELIA','RODRIGUEZ','RIOS'),(20,'LETICIA','OJEDA','ZACARIAS'),(21,'IRMA','CANTU','RIVERA'),(22,'SONIA','ARANDA','CANTÚ'),(23,'LAURA','RUBIO','GONZALEZ'),(24,'FRANCISCO','CORTEZ','M.'),(25,'LUPITA','SEGURA','  '),(26,'MARIA DE LUZ','AGUILAR ','ESPINOZA'),(27,'JOAQUIN','REYNA','SANTILLAN'),(28,'ALONSO','DÍAZ','HERNANDEZ'),(29,'MARTHA','VEGA','  '),(30,'LETICIA','GUERRERO','  '),(31,'JUAN','MANUEL','RANGEL'),(32,'SOCORRO','CONTRERAS','  '),(33,'DAVID','AZAHEL','GALVAN'),(34,'MARTHA','RAMIREZ','CASTAÑON'),(35,'YOLANDA','REYES','SALAS'),(36,'JONATHAN G.','NAVARRO','SANCHEZ'),(37,'RAMIRO','DAVILA','RODRIGUEZ'),(38,'JONATHAN GIOVANI','NAVARRO','  '),(39,'HUMBERTO','REYES','  '),(40,'JUANITA','CHAVEZ','  '),(41,'RAMONA','HURTADO','  '),(42,'MA. ELISA','RUBIO','  '),(43,'BRENDA','CHAVEZ','  '),(44,'SUSANA','RODRIGUEZ','  '),(45,'LUCILA','GONZALEZ','HERNANDEZ'),(46,'BEATRIZ','SOLORIO','  '),(47,'SANDRA','GONZALEZ','  '),(48,'FRANCIS','RAMOS','  '),(49,'DORA','GONZALEZ','  '),(50,'NICOLAS','MARTINEZ','CASTILLO'),(51,'RUBEN','BECERRA','  '),(52,'CARLOS','TREVIÑO','RODRIGUEZ'),(53,'BLANCA','CORTEZ','AYALA'),(54,'NELLY','ESPINOZA','MARTINEZ'),(55,'OFELIA','MARTINEZ','  '),(56,'RAUL','REYES','REYNA'),(57,'LOURDES','AREVALO','GAZPAR'),(58,'MIREYA','AGUAYO','TORRES'),(59,'OBDULIO','LUGO','MARTINEZ'),(60,'TERESA','CORTEZ','  '),(61,'AURORA','DIPP','MARTINEZ'),(62,'FABIAN','FONSECA','DIPP'),(63,'NATALIA','RUBIO','RANGEL'),(64,'LEONARDO','MEDINA','ESCAREÑO'),(65,'MONICA','RODRIGUEZ','GARCIA'),(66,'JULIANA','CERVANTEZ','  '),(67,'ALMA ROSA','ROBLEDO','  '),(68,'MARISOL','GARCIA','PRUNEDA'),(69,'AGUSTIN','DIPP','MARTINEZ'),(70,'MARGARITA','RODRIGUEZ','C'),(71,'CONCEPCION','CHAVEZ','  '),(72,'DELIA','JAIME','JAUREGUI'),(73,'FRANCISCO','CORTES','  '),(74,'BERNARDO','REYES','NUÑEZ'),(75,'ROSARIO','ZAPATA','  '),(76,'LAURA ALICIA','JUAREZ','GONZALEZ'),(77,'CARMEN','C.','  '),(78,'JOSE MANUEL','TAMEZ','GZZ.'),(79,'ERNESTO','CAMPANO','PEREZ'),(80,'HERMELINDA','SALAZAR','D.'),(81,'LEONARDO ','MEDINA','ESCAREÑO'),(82,'GUADALUPE','TORRES','  '),(83,'JOSE GUADALUPE','ROMO','  '),(84,'MARTHA ORALIA','SANCHEZ','VILLANUEVA'),(85,'MAGDALENA','PEREZ','CONDE'),(86,'EVERADO HECTOR','CAVAZOS','LEAL'),(87,'GUILLERMINA','MORENO','OBIEDO'),(88,'JOSE RICARDO','AMAYA','GARCIA'),(89,'MIZAEL','MORENO','TORRES'),(90,'JESUS','BARRIENTOS','REYNA'),(91,'JULIO CESAR','LOPEZ','ACEVEDO'),(92,'FRANCKO JAVIER','SOTO','GARCIA'),(93,'ANGELICA ESMERALDA','VILLA','TOVAR'),(94,'IMELDA GUADALUPE','PEREZ','JAIME'),(95,'MARGARITO','CHARCO','VERA'),(97,'JOSE PABLO','AGUINAGA','GUERRA'),(98,'ALEJANDRO','MARISCAL','CAMARILLO'),(99,'JULIA','ESPINOZA','CARDONA'),(100,'ANA MARIA','AGUIRRE','HERNANDEZ'),(101,'MARIA GUADALUPE','GALINDO','FLORES'),(102,'GERENCIA','  ','  '),(103,'VICTOR','TOSTADO','  '),(104,'MARIA DEL SOCORRO','GARCIA','DIAZ'),(105,'ZAYRA MERCEDES','PACHUCA','AGUILAR'),(106,'JUAN','SOSA','CORTEZ'),(107,'EDELMIRA','LOPEZ','SANCHEZ'),(108,'NORA MARIA','SOSA','BARRAGAN'),(109,'MARTHA GLORIA','RODRIGUEZ','SANCHEZ'),(110,'MARIA DEL ROSARIO','LOREDO','CERVANTES'),(111,'ANAHI','ESCAMILLA','RAMIREZ'),(112,'LIZETH','BETANCOURT','ESPINOZA'),(113,'LOURDES','GUEVARA','TORRES'),(114,'PABLO','DE LA ROSA','  '),(115,'RAQUEL','VAZQUEZ','BARRERA'),(116,'HOMERO ELIO','MORALES','GARZA'),(117,'MOISES','M.','FLORES'),(118,'MARIA GUADALAUPE ','ROJAS',''),(119,'MARIA ESPERANZA','VELEZ','CAMARILLO'),(120,'MARIA LETICIA','QUINTANILLA','DE LEON'),(121,'MAYRA ','GONZALEZ','QUINTERO'),(122,'MA. TERESA','ARRATIA',''),(123,'LINO MARIO','ALVAREZ ','VAZQUEZ'),(124,'EDGAR RICARDO','ZAVALA','CARDONA'),(125,'EDMUNDO','RICO','CANIZALES'),(126,'ANTONIO ','ALMAZAN','NULL'),(127,'JONATHAN GIOVANI ','NAVARRO',' SÁNCHEZ'),(128,'ELIDA','MEZA',''),(129,'CYNTHIA LUCILA','GARCIA','LEAL'),(130,'FELICITAS','BASORIA',''),(131,'JUAN PEDRO','QUINTANILLA',''),(132,'JENIFER SELINA','RAMIREZ',''),(133,'JOSE ANTONIO','FLORES',''),(134,'MARCELA','ALVARADO',''),(135,'OSCAR MARIO','GONZALEZ','MARTINEZ'),(136,'EZEQUIEL','MATA','AGUILLON'),(137,'JOSUE ISRAEL','LIMON','CAMARILLO'),(138,'GILBERTO','ALVAREZ','RIVERA'),(139,'MARIA GUADALUPE','GOMEZ','MARTINEZ'),(140,'RAFAEL','FLORES','CANTERO'),(141,'ANTONIO','MARTINEZ','HERNANDEZ'),(142,'GASPAR','ALVAREZ','LEIJA'),(143,'JACINTO','RUBIO','CANO'),(144,'VICTOR MANUEL','MONREAL','CARRANZA'),(145,'LEONARDO','SANTIAGO','PASCUAL'),(146,'APOLINAR','MARTINEZ','GONZALEZ'),(147,'FELIPE','LIMON','CAMARILLO'),(148,'FRANCISCO','GUADALUPE','RUIZ'),(149,'JOSE','CAZARES','BUSTOS'),(150,'RAMIRO','FLORES','SALDIVAR'),(151,'FRANCISCO','CASTRO','CANGAS'),(152,'JAVIER','CORRAL','LOZANO'),(153,'ALBERTO','HERNANDEZ','ALVARADO'),(154,'FRANCISCO JAVIER','MENDIETA','MTZ.'),(155,'CARLOS','FLORES','CANTERO'),(156,'DOMINGO','HERNANDEZ','CARRIZALES'),(157,'FRANCISCO','LARA','CARREON'),(158,'JOSE','ACEVEDO','MARTINEZ'),(159,'DOMINGO ALBERTO','HERNANDEZ','SEGUNDO'),(160,'MIGUEL ANGEL','VAZQUEZ','MARTINEZ'),(161,'ABEL','RIVERA','SILBA'),(162,'ANDRES','MONTOYA','MARTINEZ'),(163,'Cruz Felipe Rodríguez López','',''),(164,'Adrián Isaí','Irocheta','Galván'),(165,'Adrián Isaí','Irocheta','Galván'),(166,'JUAN','topo','MARTINEZ');
/*!40000 ALTER TABLE `persona` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `personalizacion_venta_recubrimiento`
--

LOCK TABLES `personalizacion_venta_recubrimiento` WRITE;
/*!40000 ALTER TABLE `personalizacion_venta_recubrimiento` DISABLE KEYS */;
/*!40000 ALTER TABLE `personalizacion_venta_recubrimiento` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plan_pago`
--

LOCK TABLES `plan_pago` WRITE;
/*!40000 ALTER TABLE `plan_pago` DISABLE KEYS */;
INSERT INTO `plan_pago` VALUES (1,'30% de enganche y 24 meses sin intereses',30,1,24,0,1,0,'2015-04-27 20:59:52','2015-05-08 23:21:08'),(2,'36 meses sin enganche',0,1,36,2,10,1,'2015-04-27 20:59:52','2015-04-30 03:48:10'),(3,'Contado',100,1,1,0,1,1,'2015-04-27 20:59:52','2015-04-29 03:20:28'),(12,'test',6,7,9,0,0,1,'2015-04-30 03:13:50','2015-04-30 03:48:00');
/*!40000 ALTER TABLE `plan_pago` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plan_pago_venta`
--

LOCK TABLES `plan_pago_venta` WRITE;
/*!40000 ALTER TABLE `plan_pago_venta` DISABLE KEYS */;
INSERT INTO `plan_pago_venta` VALUES (7,25,2,'2015-05-21 01:48:44',0,3154.55555556,'2015-05-21 01:48:44','2015-05-21 01:48:44',1);
/*!40000 ALTER TABLE `plan_pago_venta` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=235 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `precio`
--

LOCK TABLES `precio` WRITE;
/*!40000 ALTER TABLE `precio` DISABLE KEYS */;
INSERT INTO `precio` VALUES (2,1,245336.3,1,'2015-05-18 23:04:31','2015-05-18 23:04:31'),(3,2,131098,1,'2015-05-18 23:06:49','2015-05-18 23:06:49'),(4,3,715000,1,'2015-05-18 23:09:03','2015-05-18 23:09:03'),(5,4,86900,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(6,5,86900,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(7,6,97900,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(8,7,97900,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(9,8,97900,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(10,9,97900,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(11,10,97900,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(12,11,97900,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(13,12,97900,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(14,13,97900,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(15,14,97900,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(16,15,68750,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(17,16,68750,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(18,17,68728,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(19,18,97900,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(20,19,97900,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(21,20,68728,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(22,21,75075,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(23,22,75075,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(24,23,68728,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(25,24,68728,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(26,25,68728,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(27,26,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(28,27,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(29,28,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(30,29,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(31,30,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(32,31,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(33,32,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(34,33,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(35,34,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(36,35,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(37,36,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(38,37,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(39,38,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(40,39,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(41,40,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(42,41,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(43,42,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(44,43,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(45,44,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(46,45,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(47,46,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(48,47,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(49,48,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(50,49,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(51,50,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(52,51,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(53,52,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(54,53,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(55,54,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(56,55,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(57,56,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(58,57,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(59,58,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(60,59,75075,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(61,60,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(62,61,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(63,62,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(64,63,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(65,64,75075,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(66,65,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(67,66,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(68,67,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(69,68,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(70,69,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(71,70,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(72,71,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(73,72,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(74,73,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(75,74,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(76,75,65450,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(77,76,91828,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(78,77,91828,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(79,78,80278,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(80,79,80278,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(81,80,80278,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(82,81,80278,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(83,82,80278,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(84,83,80278,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(85,84,80278,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(86,85,80278,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(87,86,80278,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(88,87,80278,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(89,88,80278,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(90,89,80278,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(91,90,80278,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(92,91,80278,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(93,92,80278,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(94,93,80278,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(95,94,80278,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(96,95,80278,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(97,96,80278,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(98,97,80278,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(99,98,80278,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(100,99,80278,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(101,100,80278,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(102,101,80278,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(103,102,80278,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(104,103,80278,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(105,104,80278,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(106,105,80278,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(107,106,80278,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(108,107,80278,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(109,108,80278,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(110,109,80278,1,'2015-05-18 23:09:02','2015-05-18 23:09:02'),(111,111,1212750,1,'2015-05-19 21:08:40','2015-05-19 21:08:40'),(112,112,715000,1,'2015-05-20 14:20:40','2015-05-20 14:20:40'),(113,113,935000,1,'2015-05-20 14:25:18','2015-05-20 14:25:18'),(114,114,715000,1,'2015-05-20 14:47:31','2015-05-20 14:47:31'),(115,115,110938,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(116,116,110938,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(117,117,110938,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(118,118,110938,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(119,119,110938,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(120,120,110938,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(121,121,110938,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(122,122,110938,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(123,123,110938,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(124,124,110938,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(125,125,110938,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(126,126,110938,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(127,127,110938,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(128,128,110938,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(129,129,110938,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(130,130,110938,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(131,131,110938,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(132,132,110938,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(133,133,110938,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(134,134,110938,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(135,135,110938,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(136,136,110938,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(137,137,110938,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(138,138,110938,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(139,139,110938,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(140,140,110938,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(141,141,110938,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(142,142,119988,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(143,143,119988,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(144,144,119988,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(145,145,119988,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(146,146,119988,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(147,147,119988,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(148,148,119988,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(149,149,119988,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(150,150,119988,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(151,151,119988,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(152,152,119988,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(153,153,119988,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(154,154,119988,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(155,155,119988,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(156,156,119988,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(157,157,133584,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(158,158,132308,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(159,159,225225,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(160,160,142934,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(161,161,715000,1,'2015-05-20 21:24:39','2015-05-20 21:24:39'),(162,162,144903,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(163,163,144903,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(164,164,144903,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(165,165,144903,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(166,166,144903,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(167,167,144903,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(168,168,144903,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(169,169,144903,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(170,170,144903,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(171,171,144903,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(172,172,144903,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(173,173,144903,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(174,174,144903,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(175,175,144903,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(176,176,144903,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(177,177,144903,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(178,178,144903,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(179,179,144903,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(180,180,144903,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(181,181,144903,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(182,182,144903,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(183,183,144903,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(184,184,144903,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(185,185,144903,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(186,186,144903,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(187,187,144903,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(188,188,144903,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(189,189,144903,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(190,190,144903,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(191,191,144903,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(192,192,144903,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(193,193,144903,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(194,194,144903,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(195,195,144903,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(196,196,144903,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(197,197,144903,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(198,198,144903,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(199,199,144903,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(200,200,142934,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(201,201,109901,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(202,202,109901,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(203,203,109901,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(204,204,451000,1,'2015-05-21 18:02:06','2015-05-21 18:02:06'),(205,205,97900,1,'2015-05-21 18:04:15','2015-05-21 18:04:15'),(206,206,70000,1,'2015-05-21 18:07:41','2015-05-21 18:07:41'),(207,207,1186900,1,'2015-05-21 18:10:49','2015-05-21 18:10:49'),(208,208,1186900,1,'2015-05-21 19:19:55','2015-05-21 19:19:55'),(209,209,1186900,1,'2015-05-21 19:35:47','2015-05-21 19:35:47'),(210,210,1186900,1,'2015-05-21 19:38:42','2015-05-21 19:38:42'),(211,211,1186900,1,'2015-05-21 19:40:25','2015-05-21 19:40:25'),(212,212,68728,1,'2015-05-21 19:41:14','2015-05-21 19:41:14'),(213,213,750750,1,'2015-05-21 19:41:49','2015-05-21 19:41:49'),(214,214,68728,1,'2015-05-21 19:42:48','2015-05-21 19:42:48'),(215,215,522493.4,1,'2015-05-21 19:44:14','2015-05-21 19:44:14'),(216,216,225225,1,'2015-05-21 19:46:35','2015-05-21 19:46:35'),(217,217,228690,1,'2015-05-21 19:47:25','2015-05-21 19:47:25'),(218,218,228629,1,'2015-05-21 19:48:09','2015-05-21 19:48:09'),(219,219,215100,1,'2015-05-21 19:49:07','2015-05-21 19:49:07'),(220,220,142934,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(221,221,142934,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(222,222,142934,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(223,223,142934,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(224,224,142934,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(225,225,142934,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(226,226,142934,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(227,227,142934,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(228,228,142934,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(229,229,142934,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(230,230,142934,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(231,231,142934,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(232,232,142934,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(233,233,142934,1,'2015-05-20 17:31:02','2015-05-20 17:31:02'),(234,234,525,1,'2015-05-21 22:46:54','2015-05-21 22:46:54');
/*!40000 ALTER TABLE `precio` ENABLE KEYS */;
UNLOCK TABLES;

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
  PRIMARY KEY (`id`),
  KEY `fk_producto_departamento1_idx` (`departamento_id`),
  CONSTRAINT `fk_producto_departamento1` FOREIGN KEY (`departamento_id`) REFERENCES `departamento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=235 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (1,5,1,0,1,'Cipreses Fila 16 Lote 8',15),(2,5,1,0,1,'Cipreses Fila K Lote 34',15),(3,5,1,0,1,'Colinas Norte Elevadas Fila - Lote Q/17',8),(4,5,1,0,1,'Colinas Sur Fila - Lote 3/502EC',15),(5,5,1,0,1,'Colinas Sur Fila - Lote 3/563EB',15),(6,5,1,0,1,'Colinas Sur Fila - Lote 6/548',15),(7,5,1,0,1,'Colinas Sur Fila - Lote 6/548/A',15),(8,5,1,0,1,'Colinas Sur Fila - Lote 6/548/B',15),(9,5,1,0,1,'Colinas Sur Fila - Lote 6/550',15),(10,5,1,0,1,'Colinas Sur Fila - Lote 6/550/A',15),(11,5,1,0,1,'Colinas Sur Fila - Lote 6/550/B',15),(12,5,1,0,1,'Colinas Sur Fila - Lote 6/556',15),(13,5,1,0,1,'Colinas Sur Fila - Lote 6/556/A',15),(14,5,1,0,1,'Colinas Sur Fila - Lote 6/556/B',15),(15,5,1,0,1,'Colinas Sur Fila - Lote 6/693',15),(16,5,1,0,1,'Colinas Sur Fila - Lote 6/693A',15),(17,5,1,0,1,'Colinas Sur Fila - Lote 6/826/C',15),(18,5,1,0,1,'Colinas Sur Fila - Lote 6/827/CD',15),(19,5,1,0,1,'Colinas Sur Fila - Lote 6/869',15),(20,5,1,0,1,'Colinas Sur Fila - Lote 6/869/A',15),(21,5,1,0,1,'Colinas Sur Fila - Lote 6/875/A',15),(22,5,1,0,1,'Colinas Sur Fila - Lote 6/875/B',15),(23,5,1,0,1,'Colinas Sur Fila - Lote 6/8C/E1',15),(24,5,1,0,1,'Colinas Sur Fila - Lote 6/8C/E2',15),(25,5,1,0,1,'Colinas Sur Fila - Lote 6/921A',15),(26,5,1,0,1,'Colinas Sur Fila 1 Lote B',15),(27,5,1,0,1,'Colinas Sur Fila 11 Lote A',15),(28,5,1,0,1,'Colinas Sur Fila 11 Lote B',15),(29,5,1,0,1,'Colinas Sur Fila 12 Lote A',15),(30,5,1,0,1,'Colinas Sur Fila 12 Lote B',15),(31,5,1,0,1,'Colinas Sur Fila 13 Lote A',15),(32,5,1,0,1,'Colinas Sur Fila 13 Lote B',15),(33,5,1,0,1,'Colinas Sur Fila 14 Lote A',15),(34,5,1,0,1,'Colinas Sur Fila 14 Lote B',15),(35,5,1,0,1,'Colinas Sur Fila 15 Lote B',15),(36,5,1,0,1,'Colinas Sur Fila 16 Lote A',15),(37,5,1,0,1,'Colinas Sur Fila 16 Lote B',15),(38,5,1,0,1,'Colinas Sur Fila 17 Lote A',15),(39,5,1,0,1,'Colinas Sur Fila 17 Lote B',15),(40,5,1,0,1,'Colinas Sur Fila 18 Lote A',15),(41,5,1,0,1,'Colinas Sur Fila 18 Lote B',15),(42,5,1,0,1,'Colinas Sur Fila 2 Lote B',15),(43,5,1,0,1,'Colinas Sur Fila 20 Lote A',15),(44,5,1,0,1,'Colinas Sur Fila 20 Lote B',15),(45,5,1,0,1,'Colinas Sur Fila 21 Lote A',15),(46,5,1,0,1,'Colinas Sur Fila 21 Lote B',15),(47,5,1,0,1,'Colinas Sur Fila 22 Lote A',15),(48,5,1,0,1,'Colinas Sur Fila 22 Lote B',15),(49,5,1,0,1,'Colinas Sur Fila 23 Lote A',15),(50,5,1,0,1,'Colinas Sur Fila 23 Lote B',15),(51,5,1,0,1,'Colinas Sur Fila 24 Lote A',15),(52,5,1,0,1,'Colinas Sur Fila 24 Lote B',15),(53,5,1,0,1,'Colinas Sur Fila 25 Lote A',15),(54,5,1,0,1,'Colinas Sur Fila 25 Lote B',15),(55,5,1,0,1,'Colinas Sur Fila 26 Lote A',15),(56,5,1,0,1,'Colinas Sur Fila 26 Lote B',15),(57,5,1,0,1,'Colinas Sur Fila 27 Lote A',15),(58,5,1,0,1,'Colinas Sur Fila 27 Lote B',15),(59,5,1,0,1,'Colinas Sur Fila 28 Lote 68A',15),(60,5,1,0,1,'Colinas Sur Fila 28 Lote A',15),(61,5,1,0,1,'Colinas Sur Fila 28 Lote B',15),(62,5,1,0,1,'Colinas Sur Fila 29 Lote A',15),(63,5,1,0,1,'Colinas Sur Fila 29 Lote B',15),(64,5,1,0,1,'Colinas Sur Fila 30 Lote 45/A',15),(65,5,1,0,1,'Colinas Sur Fila 30 Lote A',15),(66,5,1,0,1,'Colinas Sur Fila 30 Lote B',15),(67,5,1,0,1,'Colinas Sur Fila 4 Lote A',15),(68,5,1,0,1,'Colinas Sur Fila 5 Lote A',15),(69,5,1,0,1,'Colinas Sur Fila 5 Lote B',15),(70,5,1,0,1,'Colinas Sur Fila 6 Lote A',15),(71,5,1,0,1,'Colinas Sur Fila 6 Lote B',15),(72,5,1,0,1,'Colinas Sur Fila 7 Lote A',15),(73,5,1,0,1,'Colinas Sur Fila 8 Lote A',15),(74,5,1,0,1,'Colinas Sur Fila 9 Lote A',15),(75,5,1,0,1,'Colinas Sur Fila 9 Lote B',15),(76,5,1,0,1,'Colonial Fila 55 Lote A',15),(77,5,1,0,1,'Colonial Fila 55 Lote E',15),(78,5,1,0,1,'Colonial Fila 56 Lote 1',15),(79,5,1,0,1,'Colonial Fila 56 Lote 3',15),(80,5,1,0,1,'Colonial Fila 58 Lote 8',15),(81,5,1,0,1,'Colonial Fila 58 Lote 9',15),(82,5,1,0,1,'Colonial Fila 59 Lote 20',15),(83,5,1,0,1,'Colonial Fila 60 Lote 13',15),(84,5,1,0,1,'Colonial Fila 60 Lote 14',15),(85,5,1,0,1,'Colonial Fila 60 Lote 15',15),(86,5,1,0,1,'Colonial Fila 60 Lote 16',15),(87,5,1,0,1,'Colonial Fila 60 Lote 17',15),(88,5,1,0,1,'Colonial Fila 60 Lote 18',15),(89,5,1,0,1,'Colonial Fila 60 Lote 19',15),(90,5,1,0,1,'Colonial Fila 60 Lote 20',15),(91,5,1,0,1,'Colonial Fila 60 Lote 21',15),(92,5,1,0,1,'Colonial Fila 60 Lote 22',15),(93,5,1,0,1,'Colonial Fila 60 Lote 23',15),(94,5,1,0,1,'Colonial Fila 60 Lote 24',15),(95,5,1,0,1,'Colonial Fila 61 Lote 15',15),(96,5,1,0,1,'Colonial Fila 61 Lote 16',15),(97,5,1,0,1,'Colonial Fila 61 Lote 17',15),(98,5,1,0,1,'Colonial Fila 61 Lote 18',15),(99,5,1,0,1,'Colonial Fila 61 Lote 22',15),(100,5,1,0,1,'Colonial Fila 61 Lote 23',15),(101,5,1,0,1,'Colonial Fila 61 Lote 24',15),(102,5,1,0,1,'Colonial Fila 61 Lote 25',15),(103,5,1,0,1,'Colonial Fila 62 Lote 17',15),(104,5,1,0,1,'Colonial Fila 62 Lote 18',15),(105,5,1,0,1,'Colonial Fila 62 Lote 19',15),(106,5,1,0,1,'Colonial Fila 62 Lote 20',15),(107,5,1,0,1,'Colonial Fila 62 Lote 21',15),(108,5,1,0,1,'Colonial Fila 62 Lote 22',15),(109,5,1,0,1,'Colonial Fila 62 Lote 23',15),(111,5,1,0,1,'Elevadas De La Paz Fila - Lote 4/T',8),(112,5,1,0,1,'Elevadas Jardín Del Recuerdo 1 Fila - Lote D8',8),(113,5,1,0,1,'Elevadas Jardín Del Recuerdo 1 Fila - Lote T5',8),(114,5,1,0,1,'Elevadas Jardín Del Recuerdo 1 Fila 1 Lote 6',8),(115,5,1,0,1,'Estrellas Fila A OTE Lote 18',15),(116,5,1,0,1,'Estrellas Fila A OTE Lote 19',15),(117,5,1,0,1,'Estrellas Fila A OTE Lote 23',15),(118,5,1,0,1,'Estrellas Fila A OTE Lote 24',15),(119,5,1,0,1,'Estrellas Fila A OTE Lote 25',15),(120,5,1,0,1,'Estrellas Fila A OTE Lote 27',15),(121,5,1,0,1,'Estrellas Fila B OTE Lote 23',15),(122,5,1,0,1,'Estrellas Fila B OTE Lote 24',15),(123,5,1,0,1,'Estrellas Fila B OTE Lote 25',15),(124,5,1,0,1,'Estrellas Fila B OTE Lote 26',15),(125,5,1,0,1,'Estrellas Fila B OTE Lote 27',15),(126,5,1,0,1,'Estrellas Fila I OTE Lote 11',15),(127,5,1,0,1,'Estrellas Fila I OTE Lote 13',15),(128,5,1,0,1,'Estrellas Fila I OTE Lote 14',15),(129,5,1,0,1,'Estrellas Fila I OTE Lote 15',15),(130,5,1,0,1,'Estrellas Fila I OTE Lote 16',15),(131,5,1,0,1,'Estrellas Fila I OTE Lote 18',15),(132,5,1,0,1,'Estrellas Fila I OTE Lote 19',15),(133,5,1,0,1,'Estrellas Fila I OTE Lote 2',15),(134,5,1,0,1,'Estrellas Fila I OTE Lote 26',15),(135,5,1,0,1,'Estrellas Fila I OTE Lote 3',15),(136,5,1,0,1,'Estrellas Fila II OTE Lote 12',15),(137,5,1,0,1,'Estrellas Fila II OTE Lote 14',15),(138,5,1,0,1,'Estrellas Fila II OTE Lote 16',15),(139,5,1,0,1,'Estrellas Fila II OTE Lote 17',15),(140,5,1,0,1,'Estrellas Fila II OTE Lote 25',15),(141,5,1,0,1,'Estrellas Fila II OTE Lote 26',15),(142,5,1,0,1,'Europeo Fila 22 Lote 2',15),(143,5,1,0,1,'Europeo Fila H/BIS Lote 1',15),(144,5,1,0,1,'Europeo Fila H/BIS Lote 10',15),(145,5,1,0,1,'Europeo Fila H/BIS Lote 11',15),(146,5,1,0,1,'Europeo Fila H/BIS Lote 12',15),(147,5,1,0,1,'Europeo Fila H/BIS Lote 13',15),(148,5,1,0,1,'Europeo Fila H/BIS Lote 14',15),(149,5,1,0,1,'Europeo Fila H/BIS Lote 15',15),(150,5,1,0,1,'Europeo Fila H/BIS Lote 16',15),(151,5,1,0,1,'Europeo Fila H/BIS Lote 2',15),(152,5,1,0,1,'Europeo Fila H/BIS Lote 3',15),(153,5,1,0,1,'Europeo Fila H/BIS Lote 4',15),(154,5,1,0,1,'Europeo Fila H/BIS Lote 6',15),(155,5,1,0,1,'Europeo Fila H/BIS Lote 8',15),(156,5,1,0,1,'Europeo Fila H/BIS Lote 9',15),(157,5,1,0,1,'Europeo Fila VI Lote 14/A',15),(158,5,1,0,1,'Europeo Fila XXII Lote 6',15),(159,5,1,0,1,'Exclusivo Estrellas Fila - Lote A',15),(160,5,1,0,1,'Jardín de la Cruz Fila I Lote 0',15),(161,5,1,0,1,'Jardín Exclusivo Vii Fila - Lote A/7',8),(162,5,1,0,1,'Jardín I Fila 0 Lote 2',15),(163,5,1,0,1,'Jardín I Fila 0 Lote 3',15),(164,5,1,0,1,'Jardín I Fila 0 Lote 4',15),(165,5,1,0,1,'Jardín I Fila 0 Lote 5',15),(166,5,1,0,1,'Jardín I Fila 0 Lote 7',15),(167,5,1,0,1,'Jardín I Fila 0 Lote 8',15),(168,5,1,0,1,'Jardín I Fila 0 Lote 9',15),(169,5,1,0,1,'Jardín I Fila 0 Lote 10',15),(170,5,1,0,1,'Jardín I Fila 0 Lote 12',15),(171,5,1,0,1,'Jardín I Fila 0 Lote 13',15),(172,5,1,0,1,'Jardín I Fila 0 Lote 14',15),(173,5,1,0,1,'Jardín I Fila 0 Lote 15',15),(174,5,1,0,1,'Jardín I Fila 0 Lote 18',15),(175,5,1,0,1,'Jardín I Fila 0 Lote 19',15),(176,5,1,0,1,'Jardín I Fila 0 Lote 20',15),(177,5,1,0,1,'Jardín I Fila 0 Lote 21',15),(178,5,1,0,1,'Jardín I Fila 0 Lote 22',15),(179,5,1,0,1,'Jardín I Fila 0 Lote 23',15),(180,5,1,0,1,'Jardín I Fila 0 Lote 24',15),(181,5,1,0,1,'Jardín I Fila 0 Lote 25',15),(182,5,1,0,1,'Jardín I Fila 0 Lote 26',15),(183,5,1,0,1,'Jardín I Fila 0 Lote 27',15),(184,5,1,0,1,'Jardín I Fila 0 Lote 28',15),(185,5,1,0,1,'Jardín I Fila 0 Lote 29',15),(186,5,1,0,1,'Jardín I Fila 0 Lote 30',15),(187,5,1,0,1,'Jardín I Fila 0 Lote 31',15),(188,5,1,0,1,'Jardín I Fila 0 Lote 32',15),(189,5,1,0,1,'Jardín I Fila 0 Lote 33',15),(190,5,1,0,1,'Jardín I Fila 0 Lote 34',15),(191,5,1,0,1,'Jardín I Fila 0 Lote 35',15),(192,5,1,0,1,'Jardín I Fila 0 Lote 36',15),(193,5,1,0,1,'Jardín I Fila 0 Lote 37',15),(194,5,1,0,1,'Jardín I Fila 0 Lote 38',15),(195,5,1,0,1,'Jardín I Fila 0 Lote 39',15),(196,5,1,0,1,'Jardín I Fila 0 Lote 40',15),(197,5,1,0,1,'Jardín I Fila 0 Lote 41',15),(198,5,1,0,1,'Jardín I Fila 0 Lote 42',15),(199,5,1,0,1,'Jardín I Fila 0 Lote 83',15),(200,5,1,0,1,'Jardín II Fila 8 Lote 0',15),(201,5,1,0,1,'Jardín IV Fila 18 Lote 39',15),(202,5,1,0,1,'Jardín IV Fila IX Lote 54',15),(203,5,1,0,1,'Jardín IV Fila VII Lote 22',15),(204,5,1,0,1,'Jardín Privado Guadalupe Fila - Lote 11',15),(205,5,1,0,1,'Prado Fila - Lote 57A',15),(206,5,1,0,1,'Prado Fila - Lote 65C',15),(207,5,1,0,1,'Rotonda Del Recuerdo Fila A Lote 10',8),(208,5,1,0,1,'Rotonda Del Recuerdo Fila A Lote 11',8),(209,5,1,0,1,'Rotonda Del Recuerdo Fila A Lote 12',8),(210,5,1,0,1,'Rotonda Del Recuerdo Fila A Lote 8',8),(211,5,1,0,1,'Rotonda Del Recuerdo Fila A Lote 9',8),(212,5,1,0,1,'Sagitario Fila - Lote 148',15),(213,5,1,0,1,'Sagitario Fila - Lote K-9',8),(214,5,1,0,1,'Sagitario Fila 1 Lote 161/A',15),(215,5,1,0,1,'Tradicional B Fila 5 Lote 4',15),(216,5,1,0,1,'Tradicional Sur Fila B Lote 21',15),(217,5,1,0,1,'Tradicional Sur Fila H Lote 5',15),(218,5,1,0,1,'Tradicional Sur Fila H Lote 5A',15),(219,5,1,0,1,'Tradicional Sur Fila W Lote 9A',15),(220,5,1,0,1,'Vergel II Fila 0 Lote 1',15),(221,5,1,0,1,'Vergel II Fila 0 Lote 2',15),(222,5,1,0,1,'Vergel II Fila 0 Lote 10',15),(223,5,1,0,1,'Vergel II Fila 0 Lote 14A',15),(224,5,1,0,1,'Vergel II Fila 0 Lote 15A',15),(225,5,1,0,1,'Vergel II Fila 0 Lote 16',15),(226,5,1,0,1,'Vergel II Fila 0 Lote 16A',15),(227,5,1,0,1,'Vergel III Fila IX Lote 1',15),(228,5,1,0,1,'Vergel III Fila IX Lote 2',15),(229,5,1,0,1,'Vergel III Fila IX Lote 3',15),(230,5,1,0,1,'Vergel III Fila IX Lote 4',15),(231,5,1,0,1,'Vergel III Fila IX Lote 5',15),(232,5,1,0,1,'Vergel III Fila V Lote 7',15),(233,5,1,0,1,'Vergel III Fila IX Lote 10',15),(234,2,1,0,1,'Mantenimiento trimestral 1',0);
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promotor`
--

LOCK TABLES `promotor` WRITE;
/*!40000 ALTER TABLE `promotor` DISABLE KEYS */;
INSERT INTO `promotor` VALUES (1,6,1),(2,6,2),(3,6,3),(4,50,5),(5,6,6),(6,50,50),(7,29,29),(8,49,49),(9,39,39);
/*!40000 ALTER TABLE `promotor` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `puesto`
--

LOCK TABLES `puesto` WRITE;
/*!40000 ALTER TABLE `puesto` DISABLE KEYS */;
INSERT INTO `puesto` VALUES (1,'Jardinero',2),(2,'Servicios',4),(3,'Marmolero',3),(4,'Limpieza General',2),(5,'Contruccion',4),(6,'Mensajero',6),(7,'Velador',6);
/*!40000 ALTER TABLE `puesto` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `queja`
--

LOCK TABLES `queja` WRITE;
/*!40000 ALTER TABLE `queja` DISABLE KEYS */;
INSERT INTO `queja` VALUES (1,5,10,'Acomodar placa en Jardin 2 fila 13 lote 10',1,'2015-05-21 16:28:01','2015-05-21 16:28:05',0,0,NULL),(2,6,10,'Florero despegado en Jardín IV fila 10 lote 10',1,'2015-05-21 16:26:01','2015-05-21 16:26:04',0,0,NULL),(3,7,10,'Bajar pieza para correccion Aurora fila 11 lote 12',0,'2015-05-10 19:08:29','2015-05-10 23:58:23',0,0,NULL),(4,18,10,'Checar una pieza faltante Colonial L-202',1,'2015-05-21 16:24:50','2015-05-21 16:24:54',0,0,NULL),(5,18,10,'Retoque de letras por garantía en Vergel fila 3 lote 27',1,'2015-05-21 16:24:01','2015-05-21 16:24:04',0,0,NULL),(6,7,10,'Cabecera despegada en Cipreces fila C lote 42',1,'2015-05-21 16:32:15','2015-05-21 16:32:18',0,0,NULL),(7,6,10,'Pegar Florero Jardin exclusivo VI Fila 4 lote 3',1,'2015-05-21 16:21:39','2015-05-21 16:21:42',0,0,NULL),(8,18,10,'Garantía del mantenimiento, evaluar y checar lo que hace falta en Jardín 1 fila 6 lote 12',1,'2015-05-21 16:31:28','2015-05-21 16:31:31',0,0,NULL),(9,22,10,'Nivelar bien pieza en la propiedad Aurora fila 4 lote 5',1,'2015-05-21 16:19:12','2015-05-21 16:19:15',0,0,NULL),(10,18,10,'Floreros despegados en Colinas Sur L6/660',1,'2015-05-21 16:18:14','2015-05-21 16:18:17',0,0,NULL),(11,22,10,'Poner base inclinada de concreto en Jardin Exclusivo Fila 4 lote 6',1,'2015-05-20 20:26:33','2015-05-20 18:43:18',0,0,NULL),(12,7,6,'Cabecera despegada',1,'2015-05-21 17:48:11','2015-05-21 16:34:40',0,0,NULL);
/*!40000 ALTER TABLE `queja` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `queja_seguimiento`
--

LOCK TABLES `queja_seguimiento` WRITE;
/*!40000 ALTER TABLE `queja_seguimiento` DISABLE KEYS */;
INSERT INTO `queja_seguimiento` VALUES (1,11,2,'Nótese que pueden adjuntar una fotografía como evidencia para éste tipo de queja.','2015-05-15 04:09:08','2015-05-15 04:09:08',NULL),(2,8,11,'Referir esta queja a recubrimientos y al realizar el acomodo del monolito se plantara el césped en los contornos del mismo se checo con don Toño.','2015-05-16 19:47:13','2015-05-16 18:21:35',NULL),(3,8,7,'Queja movida al departamento de Recubrimientos, al realizar el acomodo del monolito por parte del personal de Recubrimientos, se cerrará la queja.','2015-05-16 19:47:13','2015-05-16 19:41:08',NULL),(6,11,6,'Ya se instaló','2015-05-20 18:49:54','2015-05-20 18:43:18',NULL),(8,9,6,'YA QUEDO NIVELADA','2015-05-21 16:19:15','2015-05-21 16:19:15',NULL),(9,7,6,'VARIAS VECES SE HA QUEJADO EL CLIENTE Y FLOREROS ESTAN','2015-05-21 16:21:42','2015-05-21 16:21:42',NULL),(10,5,6,'YA QUEDO TERMINADO EL TRABAJO','2015-05-21 16:24:04','2015-05-21 16:24:04',NULL),(11,4,6,'YA QUEDO SE REPUSO PIEZA FALTANTE DE FLORERO','2015-05-21 16:24:54','2015-05-21 16:24:54',NULL),(12,2,6,'SE PEGO FLORERO ','2015-05-21 16:26:04','2015-05-21 16:26:04',NULL),(13,1,6,'YA QUEDO ESTA PIEZA SUFRE DESIVEL DEBIDO A MAL RELLENO DE CONSTRUCCION ','2015-05-21 16:28:05','2015-05-21 16:28:05',NULL),(14,8,6,'YA QUEDO SE LE DIO LIMPIEZA A MONOLITO','2015-05-21 16:31:31','2015-05-21 16:31:31',NULL),(15,6,6,'YA QUEDO SE PEGO CABECERA ','2015-05-21 16:32:18','2015-05-21 16:32:18',NULL),(16,12,6,'YA QUEDO SE PEGO CABECERA ','2015-05-21 16:35:06','2015-05-21 16:35:06',NULL);
/*!40000 ALTER TABLE `queja_seguimiento` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recibo`
--

LOCK TABLES `recibo` WRITE;
/*!40000 ALTER TABLE `recibo` DISABLE KEYS */;
INSERT INTO `recibo` VALUES (10,25,'2015-05-20',0,0,0,0,'2015-05-21 01:49:11','2015-05-21 01:49:11',0);
/*!40000 ALTER TABLE `recibo` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recinto`
--

LOCK TABLES `recinto` WRITE;
/*!40000 ALTER TABLE `recinto` DISABLE KEYS */;
INSERT INTO `recinto` VALUES (1,22,'San Miguel'),(2,22,'San Juan'),(3,45,'San Pedro'),(4,45,'San Francisco'),(5,45,'San Martín'),(6,22,'San Rodrigo');
/*!40000 ALTER TABLE `recinto` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recubrimiento`
--

LOCK TABLES `recubrimiento` WRITE;
/*!40000 ALTER TABLE `recubrimiento` DISABLE KEYS */;
/*!40000 ALTER TABLE `recubrimiento` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `recubrimiento_material`
--

LOCK TABLES `recubrimiento_material` WRITE;
/*!40000 ALTER TABLE `recubrimiento_material` DISABLE KEYS */;
/*!40000 ALTER TABLE `recubrimiento_material` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` VALUES (1,'ADMINISTRADOR','1'),(2,'USUARIO','2');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rubro`
--

LOCK TABLES `rubro` WRITE;
/*!40000 ALTER TABLE `rubro` DISABLE KEYS */;
INSERT INTO `rubro` VALUES (1,2,'Césped'),(2,2,'Limpieza'),(3,2,'Atención Jardinero'),(4,2,'Garantía'),(5,3,'Placa'),(6,3,'Florero'),(7,3,'Monolito'),(8,3,'Recubrimiento'),(9,3,'Tiempo de entrega'),(10,3,'Instalación y limpieza'),(11,3,'Material Solicitado'),(12,5,'Atención al cliente'),(13,5,'Vendedor'),(14,4,'Servicio de Inhumación'),(15,4,'Servicio de Exhumación'),(16,7,'Atención al Cliente'),(17,4,'Personal Operativo'),(18,3,'Garantía'),(19,4,'Otros'),(20,6,'General'),(21,5,'Otros'),(22,3,'Otros'),(23,2,'Otros');
/*!40000 ALTER TABLE `rubro` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `sector`
--

LOCK TABLES `sector` WRITE;
/*!40000 ALTER TABLE `sector` DISABLE KEYS */;
INSERT INTO `sector` VALUES (1,'Aurora'),(2,'Balcón de la Tranquilidad'),(3,'Colonial'),(4,'Colonial Elevadas'),(5,'Colinas Sur'),(6,'Colonial Tradicional'),(7,'Colinas Norte'),(8,'Colinas Norte Elevadas'),(9,'Cipreses'),(10,'Capilla'),(11,'Colinas Sur Talud 2'),(12,'Colinas Sur Elevadas'),(13,'Colinas Sur Tradicional Talud'),(14,'Eternidad'),(15,'Eternidad Bajo Pasto'),(16,'Elevadas De La Paz'),(17,'Encino'),(18,'Elevadas Jardín Del Recuerdo 1'),(19,'Estrellas'),(20,'Eternidad Sur 2'),(22,'Estrellas Interior'),(23,'Eternidad Sur'),(24,'Europeo'),(25,'Exclusivo Estrellas'),(26,'Exclusivo Estrellas A'),(27,'Exclusivo Estrellas B'),(28,'Galerías Lomas'),(29,'Gavetas De La Paz 1'),(30,'Gavetas De La Paz 2'),(31,'Jardín Privado Guadalupe'),(32,'Jardín I'),(33,'Jardín II'),(34,'Jardín III'),(35,'Jardín IV'),(36,'Jardín V'),(37,'Jardín VI'),(38,'Jardín VII'),(39,'Jardín VIII'),(40,'Jardín De La Cruz'),(41,'Jardín Fátima'),(42,'Jardín De La Paz'),(43,'Jardín Del Recuerdo S/U'),(44,'Lomas'),(45,'Estrellas Exterior'),(46,'Nichos'),(47,'Nicho Capilla S/U'),(48,'Prado'),(49,'Prado Tradicional'),(50,'Jardín Del Recuerdo 1 Ampliación'),(51,'Jardín Del Recuerdo 1'),(52,'Jardín Del Recuerdo 2'),(53,'Jardín Del Recuerdo 3'),(54,'Jardín Del Recuerdo 4'),(55,'Rotonda Guadalupe'),(56,'Rotonda Del Recuerdo'),(57,'Sagitario'),(58,'Elevadas De Sagitario'),(59,'Tradicional A'),(60,'Tradicional B'),(61,'Tradicional Sur'),(62,'Vergel I'),(63,'Vergel II'),(64,'Vergel III'),(65,'Jardín Exclusivo I'),(66,'Jardín Exclusivo II'),(67,'Jardín Exclusivo III'),(68,'Jardín Exclusivo IV'),(69,'Jardín Exclusivo V'),(70,'Jardín Exclusivo VI'),(71,'Jardín Exclusivo VII'),(72,'Exclusivo Elevadas'),(73,'Jardín Exclusivo Privado');
/*!40000 ALTER TABLE `sector` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `seguimiento_venta`
--

LOCK TABLES `seguimiento_venta` WRITE;
/*!40000 ALTER TABLE `seguimiento_venta` DISABLE KEYS */;
/*!40000 ALTER TABLE `seguimiento_venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicio_funeral`
--

DROP TABLE IF EXISTS `servicio_funeral`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servicio_funeral` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`producto_id`),
  KEY `fk_servicio_funeral_producto1_idx` (`producto_id`),
  CONSTRAINT `fk_servicio_funeral_producto1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicio_funeral`
--

LOCK TABLES `servicio_funeral` WRITE;
/*!40000 ALTER TABLE `servicio_funeral` DISABLE KEYS */;
/*!40000 ALTER TABLE `servicio_funeral` ENABLE KEYS */;
UNLOCK TABLES;

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
  `telefono` varchar(10) NOT NULL,
  `codigo_pais` char(2) NOT NULL DEFAULT '52',
  PRIMARY KEY (`id`),
  KEY `fk_telefono_tipo_telefono1_idx` (`tipo_telefono_id`),
  KEY `cliente_id` (`cliente_id`),
  CONSTRAINT `cliente_id` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tipo_telefono_id` FOREIGN KEY (`tipo_telefono_id`) REFERENCES `tipo_telefono` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `telefono`
--

LOCK TABLES `telefono` WRITE;
/*!40000 ALTER TABLE `telefono` DISABLE KEYS */;
INSERT INTO `telefono` VALUES (1,1,1,'8112258265','52'),(2,1,2,'3192322735','52');
/*!40000 ALTER TABLE `telefono` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=234 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `terreno`
--

LOCK TABLES `terreno` WRITE;
/*!40000 ALTER TABLE `terreno` DISABLE KEYS */;
INSERT INTO `terreno` VALUES (1,1,9,1,2.5,1,'16','8'),(2,2,9,2,2.5,1,'K','34'),(3,3,8,3,2.5,1,'-','Q/17'),(4,4,5,4,2.5,3,'-','3/502EC'),(5,5,5,5,2.5,3,'-','3/563EB'),(6,6,5,6,2.5,1.75,'-','6/548'),(7,7,5,7,2.5,1.75,'-','6/548/A'),(8,8,5,8,2.5,1.75,'-','6/548/B'),(9,9,5,9,2.5,1.75,'-','6/550'),(10,10,5,10,2.5,1.75,'-','6/550/A'),(11,11,5,11,2.5,1.75,'-','6/550/B'),(12,12,5,12,2.5,1.75,'-','6/556'),(13,13,5,13,2.5,1.75,'-','6/556/A'),(14,14,5,14,2.5,1.75,'-','6/556/B'),(15,15,5,15,2.5,1,'-','6/693'),(16,16,5,16,2.5,1,'-','6/693A'),(17,17,5,17,2.5,1,'-','6/826/C'),(18,18,5,18,2.5,1.75,'-','6/827/CD'),(19,19,5,19,2.5,1.75,'-','6/869'),(20,20,5,20,2.5,1,'-','6/869/A'),(21,21,5,21,2.5,1,'-','6/875/A'),(22,22,5,22,2.5,1,'-','6/875/B'),(23,23,5,23,2.5,1,'-','6/8C/E1'),(24,24,5,24,2.5,1,'-','6/8C/E2'),(25,25,5,25,2.5,1,'-','6/921A'),(26,26,5,26,2.5,1,'1','B'),(27,27,5,27,2.5,1,'11','A'),(28,28,5,28,2.5,1,'11','B'),(29,29,5,29,2.5,1,'12','A'),(30,30,5,30,2.5,1,'12','B'),(31,31,5,31,2.5,1,'13','A'),(32,32,5,32,2.5,1,'13','B'),(33,33,5,33,2.5,1,'14','A'),(34,34,5,34,2.5,1,'14','B'),(35,35,5,35,2.5,1,'15','B'),(36,36,5,36,2.5,1,'16','A'),(37,37,5,37,2.5,1,'16','B'),(38,38,5,38,2.5,1,'17','A'),(39,39,5,39,2.5,1,'17','B'),(40,40,5,40,2.5,1,'18','A'),(41,41,5,41,2.5,1,'18','B'),(42,42,5,42,2.5,1,'2','B'),(43,43,5,43,2.5,1,'20','A'),(44,44,5,44,2.5,1,'20','B'),(45,45,5,45,2.5,1,'21','A'),(46,46,5,46,2.5,1,'21','B'),(47,47,5,47,2.5,1,'22','A'),(48,48,5,48,2.5,1,'22','B'),(49,49,5,49,2.5,1,'23','A'),(50,50,5,50,2.5,1,'23','B'),(51,51,5,51,2.5,1,'24','A'),(52,52,5,52,2.5,1,'24','B'),(53,53,5,53,2.5,1,'25','A'),(54,54,5,54,2.5,1,'25','B'),(55,55,5,55,2.5,1,'26','A'),(56,56,5,56,2.5,1,'26','B'),(57,57,5,57,2.5,1,'27','A'),(58,58,5,58,2.5,1,'27','B'),(59,59,5,59,2.5,1,'28','68A'),(60,60,5,60,2.5,1,'28','A'),(61,61,5,61,2.5,1,'28','B'),(62,62,5,62,2.5,1,'29','A'),(63,63,5,63,2.5,1,'29','B'),(64,64,5,64,2.5,1,'30','45/A'),(65,65,5,65,2.5,1,'30','A'),(66,66,5,66,2.5,1,'30','B'),(67,67,5,67,2.5,1,'4','A'),(68,68,5,68,2.5,1,'5','A'),(69,69,5,69,2.5,1,'5','B'),(70,70,5,70,2.5,1,'6','A'),(71,71,5,71,2.5,1,'6','B'),(72,72,5,72,2.5,1,'7','A'),(73,73,5,73,2.5,1,'8','A'),(74,74,5,74,2.5,1,'9','A'),(75,75,5,75,2.5,1,'9','B'),(76,76,3,76,2.5,1,'55','A'),(77,77,3,77,2.5,1,'55','E'),(78,78,3,78,2.5,1,'56','1'),(79,79,3,79,2.5,1,'56','3'),(80,80,3,80,2.5,1,'58','8'),(81,81,3,81,2.5,1,'58','9'),(82,82,3,82,2.5,1,'59','20'),(83,83,3,83,2.5,1,'60','13'),(84,84,3,84,2.5,1,'60','14'),(85,85,3,85,2.5,1,'60','15'),(86,86,3,86,2.5,1,'60','16'),(87,87,3,87,2.5,1,'60','17'),(88,88,3,88,2.5,1,'60','18'),(89,89,3,89,2.5,1,'60','19'),(90,90,3,90,2.5,1,'60','20'),(91,91,3,91,2.5,1,'60','21'),(92,92,3,92,2.5,1,'60','22'),(93,93,3,93,2.5,1,'60','23'),(94,94,3,94,2.5,1,'60','24'),(95,95,3,95,2.5,1,'61','15'),(96,96,3,96,2.5,1,'61','16'),(97,97,3,97,2.5,1,'61','17'),(98,98,3,98,2.5,1,'61','18'),(99,99,3,99,2.5,1,'61','22'),(100,100,3,100,2.5,1,'61','23'),(101,101,3,101,2.5,1,'61','24'),(102,102,3,102,2.5,1,'61','25'),(103,103,3,103,2.5,1,'62','17'),(104,104,3,104,2.5,1,'62','18'),(105,105,3,105,2.5,1,'62','19'),(106,106,3,106,2.5,1,'62','20'),(107,107,3,107,2.5,1,'62','21'),(108,108,3,108,2.5,1,'62','22'),(109,109,3,109,2.5,1,'62','23'),(111,111,16,110,0,0,'-','4/T'),(112,112,18,111,0,0,'-','D8'),(113,113,18,112,0,0,'-','T5'),(114,114,18,113,0,0,'1','6'),(115,115,19,114,2.5,1,'A OTE','18'),(116,116,19,115,2.5,1,'A OTE','19'),(117,117,19,116,2.5,1,'A OTE','23'),(118,118,19,117,2.5,1,'A OTE','24'),(119,119,19,118,2.5,1,'A OTE','25'),(120,120,19,119,2.5,1,'A OTE','27'),(121,121,19,120,2.5,1,'B OTE','23'),(122,122,19,121,2.5,1,'B OTE','24'),(123,123,19,122,2.5,1,'B OTE','25'),(124,124,19,123,2.5,1,'B OTE','26'),(125,125,19,124,2.5,1,'B OTE','27'),(126,126,19,125,2.5,1,'I OTE','11'),(127,127,19,126,2.5,1,'I OTE','13'),(128,128,19,127,2.5,1,'I OTE','14'),(129,129,19,128,2.5,1,'I OTE','15'),(130,130,19,129,2.5,1,'I OTE','16'),(131,131,19,130,2.5,1,'I OTE','18'),(132,132,19,131,2.5,1,'I OTE','19'),(133,133,19,132,2.5,1,'I OTE','2'),(134,134,19,133,2.5,1,'I OTE','26'),(135,135,19,134,2.5,1,'I OTE','3'),(136,136,19,135,2.5,1,'II OTE','12'),(137,137,19,136,2.5,1,'II OTE','14'),(138,138,19,137,2.5,1,'II OTE','16'),(139,139,19,138,2.5,1,'II OTE','17'),(140,140,19,139,2.5,1,'II OTE','25'),(141,141,19,140,2.5,1,'II OTE','26'),(142,142,24,141,2.5,1,'22','2'),(143,143,24,142,2.5,1,'H/BIS','1'),(144,144,24,143,2.5,1,'H/BIS','10'),(145,145,24,144,2.5,1,'H/BIS','11'),(146,146,24,145,2.5,1,'H/BIS','12'),(147,147,24,146,2.5,1,'H/BIS','13'),(148,148,24,147,2.5,1,'H/BIS','14'),(149,149,24,148,2.5,1,'H/BIS','15'),(150,150,24,149,2.5,1,'H/BIS','16'),(151,151,24,150,2.5,1,'H/BIS','2'),(152,152,24,151,2.5,1,'H/BIS','3'),(153,153,24,152,2.5,1,'H/BIS','4'),(154,154,24,153,2.5,1,'H/BIS','6'),(155,155,24,154,2.5,1,'H/BIS','8'),(156,156,24,155,2.5,1,'H/BIS','9'),(157,157,24,156,2.5,1,'VI','14/A'),(158,158,24,157,2.5,1,'XXII','6'),(159,159,25,158,2.75,2,'-','A'),(160,160,40,159,2.5,1,'I','0'),(161,161,71,160,0,0,'-','A/7'),(162,162,32,161,2.5,1,'0','2'),(163,163,32,162,2.5,1,'0','3'),(164,164,32,163,2.5,1,'0','4'),(165,165,32,164,2.5,1,'0','5'),(166,166,32,165,2.5,1,'0','7'),(167,167,32,166,2.5,1,'0','8'),(168,168,32,167,2.5,1,'0','9'),(169,169,32,168,2.5,1,'0','10'),(170,170,32,169,2.5,1,'0','12'),(171,171,32,170,2.5,1,'0','13'),(172,172,32,171,2.5,1,'0','14'),(173,173,32,172,2.5,1,'0','15'),(174,174,32,173,2.5,1,'0','18'),(175,175,32,174,2.5,1,'0','19'),(176,176,32,175,2.5,1,'0','20'),(177,177,32,176,2.5,1,'0','21'),(178,178,32,177,2.5,1,'0','22'),(179,179,32,178,2.5,1,'0','23'),(180,180,32,179,2.5,1,'0','24'),(181,181,32,180,2.5,1,'0','25'),(182,182,32,181,2.5,1,'0','26'),(183,183,32,182,2.5,1,'0','27'),(184,184,32,183,2.5,1,'0','28'),(185,185,32,184,2.5,1,'0','29'),(186,186,32,185,2.5,1,'0','30'),(187,187,32,186,2.5,1,'0','31'),(188,188,32,187,2.5,1,'0','32'),(189,189,32,188,2.5,2,'0','33'),(190,190,32,189,2.5,1,'0','34'),(191,191,32,190,2.5,1,'0','35'),(192,192,32,191,2.5,1,'0','36'),(193,193,32,192,2.5,1,'0','37'),(194,194,32,193,2.5,1,'0','38'),(195,195,32,194,2.5,1,'0','39'),(196,196,32,195,2.5,1,'0','40'),(197,197,32,196,2.5,1,'0','41'),(198,198,32,197,2.5,1,'0','42'),(199,199,32,198,2.5,1,'0','83'),(200,200,33,199,2.5,1,'8','0'),(201,201,35,200,2.5,1,'18','39'),(202,202,35,201,2.5,1,'IX','54'),(203,203,35,202,2.5,1,'VII','22'),(204,204,31,203,2.5,1.75,'-','11'),(205,205,48,204,2.5,1,'-','57/A'),(206,206,48,205,2.5,1,'-','65C'),(207,207,56,206,0,0,'A','10'),(208,208,56,207,0,0,'A','11'),(209,209,56,208,0,0,'A','12'),(210,210,56,209,0,0,'A','8'),(211,211,56,210,0,0,'A','9'),(212,212,57,211,2.5,1,'-','148'),(213,213,57,212,0,0,'-','K-9'),(214,214,57,213,2.5,1,'1','161/A'),(215,215,60,214,2.5,3,'5','4'),(216,216,61,215,2.5,1,'B','21'),(217,217,61,216,2.5,1,'H','5'),(218,218,61,217,2.5,1,'H','5A'),(219,219,61,218,2.5,1,'W','9A'),(220,220,35,219,2.5,1,'0','1'),(221,221,35,220,2.5,1,'0','2'),(222,222,35,221,2.5,1,'0','10'),(223,223,35,222,2.5,1,'0','14A'),(224,224,35,223,2.5,1,'0','15A'),(225,225,35,224,2.5,1,'0','16'),(226,226,35,225,2.5,1,'0','16A'),(227,227,35,226,2.5,1,'IX','1'),(228,228,35,227,2.5,1,'IX','2'),(229,229,35,228,2.5,1,'IX','3'),(230,230,35,229,2.5,1,'IX','4'),(231,231,35,230,2.5,1,'IX','5'),(232,232,35,231,2.5,1,'V','7'),(233,233,35,232,2.5,1,'IX','10');
/*!40000 ALTER TABLE `terreno` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `tipo_telefono`
--

LOCK TABLES `tipo_telefono` WRITE;
/*!40000 ALTER TABLE `tipo_telefono` DISABLE KEYS */;
INSERT INTO `tipo_telefono` VALUES (1,'Celular'),(2,'Casa'),(3,'Trabajo'),(4,'Recados');
/*!40000 ALTER TABLE `tipo_telefono` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `titular`
--

LOCK TABLES `titular` WRITE;
/*!40000 ALTER TABLE `titular` DISABLE KEYS */;
/*!40000 ALTER TABLE `titular` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `tramite`
--

LOCK TABLES `tramite` WRITE;
/*!40000 ALTER TABLE `tramite` DISABLE KEYS */;
/*!40000 ALTER TABLE `tramite` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `unidad_medida`
--

LOCK TABLES `unidad_medida` WRITE;
/*!40000 ALTER TABLE `unidad_medida` DISABLE KEYS */;
/*!40000 ALTER TABLE `unidad_medida` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,1,2,2,'Cecilia','$2y$10$85nYJGs9bBAAgcVOxQbsfuJzYBW7GxWgDLTMcGkhodjR78rKXL9Tq',1,0,'d346ptGzEjKSWkBBSQV8h2KZ2loS7bzsiLjdpzQeUANzvsdiEmHwdgBzVwKF','cecy.jpg'),(2,2,1,1,'Felipe V','$2y$10$85nYJGs9bBAAgcVOxQbsfuJzYBW7GxWgDLTMcGkhodjR78rKXL9Tq',1,1,'De3EHrwAJq4zRhZTaINVmKhOM5QpmuPim6L7U8zFyCNMFHOnrcBqSmX7jVcT','felipe5.jpg'),(3,3,1,1,'Daniel','$2y$10$85nYJGs9bBAAgcVOxQbsfuJzYBW7GxWgDLTMcGkhodjR78rKXL9Tq',1,1,'gEv9WVCQ20NJVC5CGBZtymQfRNq6iDbvwC19IIrR5DWmTrwdrLOHj73eJ7Od','px.png'),(4,4,1,3,'Felipe','$2y$10$85nYJGs9bBAAgcVOxQbsfuJzYBW7GxWgDLTMcGkhodjR78rKXL9Tq',1,1,'gumfyuEVH51ds9N3OdQbgorGw9mhGm2w35dcmVD5RAwyWYonCQiRUVEWIU25','felipe.jpg'),(5,5,1,4,'Julio','$2y$10$85nYJGs9bBAAgcVOxQbsfuJzYBW7GxWgDLTMcGkhodjR78rKXL9Tq',1,1,'pRGcnRW1cY1p7kvA0kSiAzRsHea4TgEa1f6if0JqqtkOoN0mlo4LFIc4x1xw','julio.jpg'),(6,6,2,3,'Moisés','$2y$10$85nYJGs9bBAAgcVOxQbsfuJzYBW7GxWgDLTMcGkhodjR78rKXL9Tq',1,1,'HsOUZwK1FyPPvh6DGpJMdrdlCEmHMuKUsX805y99WCCVVOOmlyV2jrF0SOxg','p.png'),(7,7,1,1,'Nazaret','$2y$10$85nYJGs9bBAAgcVOxQbsfuJzYBW7GxWgDLTMcGkhodjR78rKXL9Tq',1,1,'BE0ecDvj7q3m1jHgJYb24al6Bm4Gdyvaad9Fwi3nMmphi4VqfuIqIKaNnMBq','naza.jpg'),(8,8,1,7,'Ofelia','$2y$10$85nYJGs9bBAAgcVOxQbsfuJzYBW7GxWgDLTMcGkhodjR78rKXL9Tq',1,1,'ah3LQkljvlgvyApgEYzZKJPqFfTuDC6YVZTgO4AbkXrI9Je7sNs9r8L42RyO','ofe.jpg'),(9,9,2,5,'Patricia','$2y$10$85nYJGs9bBAAgcVOxQbsfuJzYBW7GxWgDLTMcGkhodjR78rKXL9Tq',1,1,'2p1IkuwTD7Jc6KsNK5rTrOxK4CR8lVCVIeaQ3XwWOTCGPXHz33JZuxrLA76a','tisha.png'),(10,10,1,6,'Rosalinda','$2y$10$85nYJGs9bBAAgcVOxQbsfuJzYBW7GxWgDLTMcGkhodjR78rKXL9Tq',1,1,'YGtKFH6ICC6ivdIggit7RObVGsRShL1u3KDXiJ3gg3LCR0hRDwq2rl8fPVWv','female2.png'),(11,11,1,2,'Sofía','$2y$10$85nYJGs9bBAAgcVOxQbsfuJzYBW7GxWgDLTMcGkhodjR78rKXL9Tq',1,1,'1vISGgDRIN4EcI2CRtVdlFQjVpbLue6WKTx253JtD4CuikUEl1iRRA60Icv5','sofia.jpg');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `valor`
--

LOCK TABLES `valor` WRITE;
/*!40000 ALTER TABLE `valor` DISABLE KEYS */;
/*!40000 ALTER TABLE `valor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta`
--

DROP TABLE IF EXISTS `venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) NOT NULL,
  `folio_solicitud` varchar(10) NOT NULL,
  `descuento` double NOT NULL DEFAULT '0',
  `total` double NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comentarios` text,
  `pagada` tinyint(1) NOT NULL DEFAULT '0',
  `cancelada` tinyint(1) NOT NULL DEFAULT '0',
  `cotizacion` tinyint(1) NOT NULL DEFAULT '1',
  `autorizado` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_venta_cliente1_idx` (`cliente_id`),
  CONSTRAINT `fk_venta_cliente1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta`
--

LOCK TABLES `venta` WRITE;
/*!40000 ALTER TABLE `venta` DISABLE KEYS */;
INSERT INTO `venta` VALUES (25,1,'2218',300,113264,'2015-05-20 20:49:11',' Mandar al mensajero preferentemente para el cobro de la mensualidad.',0,0,0,1,'2015-05-21 01:48:44','2015-05-21 01:49:11');
/*!40000 ALTER TABLE `venta` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `venta_construccion`
--

LOCK TABLES `venta_construccion` WRITE;
/*!40000 ALTER TABLE `venta_construccion` DISABLE KEYS */;
/*!40000 ALTER TABLE `venta_construccion` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `venta_exhumacion`
--

LOCK TABLES `venta_exhumacion` WRITE;
/*!40000 ALTER TABLE `venta_exhumacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `venta_exhumacion` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `venta_inhumacion`
--

LOCK TABLES `venta_inhumacion` WRITE;
/*!40000 ALTER TABLE `venta_inhumacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `venta_inhumacion` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `venta_lote`
--

LOCK TABLES `venta_lote` WRITE;
/*!40000 ALTER TABLE `venta_lote` DISABLE KEYS */;
/*!40000 ALTER TABLE `venta_lote` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `venta_mantenimiento`
--

LOCK TABLES `venta_mantenimiento` WRITE;
/*!40000 ALTER TABLE `venta_mantenimiento` DISABLE KEYS */;
/*!40000 ALTER TABLE `venta_mantenimiento` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_producto`
--

LOCK TABLES `venta_producto` WRITE;
/*!40000 ALTER TABLE `venta_producto` DISABLE KEYS */;
INSERT INTO `venta_producto` VALUES (25,25,6,1,113564,97900,16);
/*!40000 ALTER TABLE `venta_producto` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `venta_recubrimiento`
--

LOCK TABLES `venta_recubrimiento` WRITE;
/*!40000 ALTER TABLE `venta_recubrimiento` DISABLE KEYS */;
/*!40000 ALTER TABLE `venta_recubrimiento` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `venta_tramite`
--

LOCK TABLES `venta_tramite` WRITE;
/*!40000 ALTER TABLE `venta_tramite` DISABLE KEYS */;
/*!40000 ALTER TABLE `venta_tramite` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Temporary view structure for view `vista_asesor_promotor`
--

DROP TABLE IF EXISTS `vista_asesor_promotor`;
/*!50001 DROP VIEW IF EXISTS `vista_asesor_promotor`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vista_asesor_promotor` AS SELECT 
 1 AS `id_persona_asesor`,
 1 AS `id_asesor`,
 1 AS `Asesor`,
 1 AS `fecha_ingreso`,
 1 AS `activo`,
 1 AS `id_persona_promotor`,
 1 AS `id_promotor`,
 1 AS `Promotor`*/;
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
 1 AS `departamento`,
 1 AS `fecha_ingreso`,
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
 1 AS `Promotor`*/;
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
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_asesor_promotor` AS select `pe`.`id` AS `id_persona_asesor`,`p`.`asesor_id` AS `id_asesor`,concat(rtrim(ltrim(`pe`.`nombres`)),' ',rtrim(ltrim(`pe`.`apellido_paterno`)),' ',rtrim(ltrim(`pe`.`apellido_materno`))) AS `Asesor`,`s`.`fecha_ingreso` AS `fecha_ingreso`,`s`.`activo` AS `activo`,`pe1`.`id` AS `id_persona_promotor`,`p`.`promotor_id` AS `id_promotor`,concat(rtrim(ltrim(`pe1`.`nombres`)),' ',rtrim(ltrim(`pe1`.`apellido_paterno`)),' ',rtrim(ltrim(`pe1`.`apellido_materno`))) AS `Promotor` from ((((`promotor` `p` left join `asesor` `s` on((`p`.`asesor_id` = `s`.`id`))) left join `asesor` `s1` on((`p`.`promotor_id` = `s1`.`id`))) left join `persona` `pe` on((`s`.`persona_id` = `pe`.`id`))) left join `persona` `pe1` on((`s1`.`persona_id` = `pe1`.`id`))) */;
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
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_clientes` AS select `cliente`.`id` AS `id`,`persona`.`nombres` AS `nombres`,`persona`.`apellido_paterno` AS `apellido_paterno`,`persona`.`apellido_materno` AS `apellido_materno`,`cliente`.`calle` AS `calle`,`cliente`.`numero_exterior` AS `numero_exterior`,`cliente`.`numero_interior` AS `numero_interior`,`colonia`.`codigo_postal` AS `codigo_postal`,`cliente`.`referencias` AS `referencias`,`municipio`.`nombre` AS `municipio`,`estado`.`nombre` AS `estado`,`pais`.`nombre` AS `pais`,`cliente`.`email` AS `email`,`estado_civil`.`descripcion` AS `estado_civil`,`cliente`.`latitud` AS `latitud`,`cliente`.`longitud` AS `longitud` from ((((((`cliente` left join `persona` on((`cliente`.`persona_id` = `persona`.`id`))) left join `colonia` on((`cliente`.`colonia_id` = `colonia`.`id`))) left join `municipio` on((`colonia`.`municipio_id` = `municipio`.`id`))) left join `estado` on((`municipio`.`estado_id` = `estado`.`id`))) left join `pais` on((`estado`.`pais_id` = `pais`.`id`))) left join `estado_civil` on((`cliente`.`estado_civil_id` = `estado_civil`.`id`))) */;
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
/*!50001 VIEW `vista_empleado` AS select `empleado`.`id` AS `id`,`persona`.`nombres` AS `nombres`,`persona`.`apellido_paterno` AS `apellido_paterno`,`persona`.`apellido_materno` AS `apellido_materno`,`puesto`.`nombre` AS `puesto`,`departamento`.`nombre` AS `departamento`,`empleado`.`fecha_ingreso` AS `fecha_ingreso`,`empleado`.`activo` AS `activo` from (((`empleado` left join `persona` on((`empleado`.`persona_id` = `persona`.`id`))) left join `puesto` on((`empleado`.`puesto_id` = `puesto`.`id`))) left join `departamento` on((`puesto`.`departamento_id` = `departamento`.`id`))) order by `empleado`.`id` */;
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
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_promotores` AS select `a`.`id` AS `id`,concat(ltrim(rtrim(`pe`.`nombres`)),' ',ltrim(rtrim(`pe`.`apellido_paterno`)),' ',ltrim(rtrim(`pe`.`apellido_materno`))) AS `Promotor` from ((`promotor` `p` left join `asesor` `a` on((`p`.`promotor_id` = `a`.`id`))) left join `persona` `pe` on((`a`.`persona_id` = `pe`.`id`))) where (`p`.`promotor_id` = `p`.`asesor_id`) */;
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
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_terrenos_disponibles` AS select `producto`.`id` AS `producto_id`,`sector`.`id` AS `sector_id`,`recinto`.`id` AS `recinto_id`,`lote`.`id` AS `lote_id`,`nicho`.`id` AS `id`,`sector`.`nombre` AS `sector`,`recinto`.`nombre` AS `recinto`,'Nicho' AS `tipo`,`nicho`.`fila` AS `fila`,`nicho`.`columna` AS `columna`,`precio`.`monto` AS `monto`,`producto`.`porcentaje_comision` AS `porcentaje_comision` from (((((`nicho` left join `lote` on((`lote`.`id` = `nicho`.`lote_id`))) left join `producto` on((`producto`.`id` = `lote`.`producto_id`))) left join `recinto` on((`nicho`.`recinto_id` = `recinto`.`id`))) left join `sector` on((`recinto`.`sector_id` = `sector`.`id`))) left join `precio` on((`precio`.`producto_id` = `producto`.`id`))) where ((`lote`.`disponible` = 1) and (`precio`.`activo` = 1)) union select `producto`.`id` AS `producto_id`,`sector`.`id` AS `sector_id`,NULL AS `recinto_id`,`lote`.`id` AS `lote_id`,`terreno`.`id` AS `id`,`sector`.`nombre` AS `sector`,'' AS `recinto`,'Terreno' AS `tipo`,`terreno`.`fila` AS `fila`,`terreno`.`lote` AS `lote`,`precio`.`monto` AS `monto`,`producto`.`porcentaje_comision` AS `porcentaje_comision` from ((((`terreno` left join `lote` on((`lote`.`id` = `terreno`.`lote_id`))) left join `producto` on((`producto`.`id` = `lote`.`producto_id`))) left join `sector` on((`terreno`.`sector_id` = `sector`.`id`))) left join `precio` on((`precio`.`producto_id` = `producto`.`id`))) where ((`lote`.`disponible` = 1) and (`precio`.`activo` = 1)) */;
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

-- Dump completed on 2015-05-22 15:48:04
