-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: pedidos
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP DATABASE IF EXISTS pedidos;
CREATE DATABASE pedidos;
USE pedidos;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias` (
  `CodCat` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  PRIMARY KEY (`CodCat`),
  UNIQUE KEY `UN_NOM_CAT` (`Nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES
 (1,'TORNILLOS','Tornillos varias métricas y tipo'),
 (2,'TUERCAS','Tuercas hexagonales varias métricas'),
 (3,'TACOS','Tacos varias métricas y material');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedidos` (
  `CodPed` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha` datetime NOT NULL,
  `Enviado` int(11) NOT NULL,
  `ferreteria` int(11) NOT NULL,
  PRIMARY KEY (`CodPed`),
  KEY `ferreteria` (`ferreteria`),
  CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`ferreteria`) REFERENCES `ferreterias` (`CodRes`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` VALUES (79,'2018-12-20 15:50:33',0,1),(80,'2018-12-20 15:51:41',0,1),(81,'2018-12-20 16:41:13',0,1),(82,'2018-12-20 17:29:39',0,1),(83,'2018-12-20 23:13:23',0,1),(84,'2018-12-20 23:14:07',0,1),(85,'2018-12-20 23:15:02',0,1),(86,'2018-12-24 10:56:29',0,1),(87,'2024-10-18 11:44:49',0,1),(88,'2024-10-23 17:48:17',0,1),(89,'2024-10-24 18:01:06',0,1),(90,'2024-10-24 19:31:10',0,1),(91,'2024-10-24 19:32:20',0,1);
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidosproductos`
--

DROP TABLE IF EXISTS `pedidosproductos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedidosproductos` (
  `CodPedProd` int(11) NOT NULL AUTO_INCREMENT,
  `Pedido` int(11) NOT NULL,
  `Producto` int(11) NOT NULL,
  `Unidades` int(11) NOT NULL,
  PRIMARY KEY (`CodPedProd`),
  KEY `CodPed` (`Pedido`),
  KEY `CodProd` (`Producto`),
  CONSTRAINT `pedidosproductos_ibfk_1` FOREIGN KEY (`Pedido`) REFERENCES `pedidos` (`CodPed`),
  CONSTRAINT `pedidosproductos_ibfk_2` FOREIGN KEY (`Producto`) REFERENCES `productos` (`CodProd`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidosproductos`
--

LOCK TABLES `pedidosproductos` WRITE;
/*!40000 ALTER TABLE `pedidosproductos` DISABLE KEYS */;
INSERT INTO `pedidosproductos` VALUES (65,79,5,1),(66,79,2,4),(67,80,5,1),(68,81,3,1),(69,81,4,1),(70,82,6,1),(71,82,3,1),(72,83,5,1),(73,84,5,1),(74,85,3,1),(75,86,6,1),(76,87,3,3),(77,87,2,1),(78,88,3,1),(79,88,2,1),(80,89,1,1),(81,90,6,1),(82,91,4,1);
/*!40000 ALTER TABLE `pedidosproductos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `CodProd` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) DEFAULT NULL,
  `Descripcion` varchar(90) NOT NULL,
  `Peso` float NOT NULL,
  `Stock` int(11) NOT NULL,
  `Categoria` int(11) NOT NULL,
  PRIMARY KEY (`CodProd`),
  KEY `Categoria` (`Categoria`),
  CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`Categoria`) REFERENCES `categorias` (`CodCat`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES
 (1,'Aglomerado  0,5','5 cajas de 100 ud cada una',5,94,1),
 (2,'Tirafondos 1,5',' 5 cajas de 100 ud cada una',5,3,1),
 (3,'Tuercas 6"','10 cajas de 100 ud cada una',51,85,2),
 (4,'Tuercas 12"',' 10 cajas de 100 ud cada una',31,45,2),
 (5,'Plástico','5 cajas de 50 ud cada una',10,12,3),
 (6,'Quimico','5 cajas de 50 ud cada una',5.5,7,3);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ferreterias`
--

DROP TABLE IF EXISTS `ferreterias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ferreterias` (
  `CodRes` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(32) NOT NULL,
  `Correo` varchar(90) NOT NULL,
  `Clave` varchar(45) NOT NULL,
  `Pais` varchar(45) NOT NULL,
  `CP` int(5) DEFAULT NULL,
  `Ciudad` varchar(45) NOT NULL,
  `Direccion` varchar(200) NOT NULL,
  `Rol` int(11) NOT NULL,
  PRIMARY KEY (`CodRes`),
  UNIQUE KEY `UN_RES_COR` (`Correo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ferreterias`
--

LOCK TABLES `ferreterias` WRITE;
/*!40000 ALTER TABLE `ferreterias` DISABLE KEYS */;
INSERT INTO `ferreterias` VALUES (1,'MADRID-1','madrid01@acme.com','1234','España',28002,'Madrid','C/ Padre  Claret, 8',1),(2,'CADIZ-1','cadiz01@acme.com','1234','España',11001,'Cádiz','C/ Portales, 2 ',0);
/*!40000 ALTER TABLE `ferreterias` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-10-24 19:44:06
