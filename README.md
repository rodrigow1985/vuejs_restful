# Proyecto ABM de personas usando Webpack, Vue js y Restful

## Links:
Pagina de donde saque info para configurar: [link](http://www.jc-mouse.net/proyectos/crea-un-servicio-web-rest-con-php-y-mysql)
## Utilicé el proyecto de webpack y vue js que está en Git Hub como base

## Funcionalidad:
### Frontend de un ABM de personas con datos sencillos
### Se utilizó la siguiente base de datos:
```
CREATE DATABASE  IF NOT EXISTS `restfulPrueba` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `restfulPrueba`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: restfulPrueba
-- ------------------------------------------------------
-- Server version	5.7.19-0ubuntu0.16.04.1

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
-- Table structure for table `personas`
--

DROP TABLE IF EXISTS `personas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personas` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `edad` int(11) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personas`
--

LOCK TABLES `personas` WRITE;
/*!40000 ALTER TABLE `personas` DISABLE KEYS */;
INSERT INTO `personas` VALUES (1,'Rodrigo','Weichert',32,'2017-10-03 22:27:50'),(2,'Alberto','Weichert',62,'2017-10-02 23:57:09'),(3,'Gonzalo','Weichert',24,'2017-09-28 00:11:52'),(4,'Blanca','Lastra',64,'2017-09-28 00:11:52'),(8,'Panza','Sancho',1,'2017-10-03 22:27:59');
/*!40000 ALTER TABLE `personas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-07  9:13:04

```
### El alta, baja y modificación de cada persona llama a los servicios web de restful creados en php para realizar las operaciones. El Frontend no realiza operaciones a la BD

### La carpeta Backend tiene los servicios en php que consume el Frontend
