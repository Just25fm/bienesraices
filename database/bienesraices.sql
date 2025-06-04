-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: localhost    Database: bienesraices_crud
-- ------------------------------------------------------
-- Server version	8.0.39

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

--
-- Table structure for table `propiedades`
--

DROP TABLE IF EXISTS `propiedades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `propiedades` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  `descripcion` longtext,
  `habitaciones` int DEFAULT NULL,
  `wc` int DEFAULT NULL,
  `estacionamiento` int DEFAULT NULL,
  `creado` date DEFAULT NULL,
  `vendedorId` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `propiedades`
--

LOCK TABLES `propiedades` WRITE;
/*!40000 ALTER TABLE `propiedades` DISABLE KEYS */;
INSERT INTO `propiedades` VALUES (1,'Casa en la playa',100000.00,NULL,'Primera insercion!! Primera insercion!! Primera insercion!! Primera insercion!! Primera insercion!! Primera insercion!! Primera insercion!! Primera insercion!! Primera insercion!!',3,2,1,'2025-02-27',1),(2,'Casa en la playa 2',200000.00,NULL,'segunda insercion!! segunda insercion!! segunda insercion!! segunda insercion!! segunda insercion!! segunda insercion!! segunda insercion!! segunda insercion!! segunda insercion!!',4,2,2,'2025-02-27',2),(3,'Casa en la playa 2',200000.00,NULL,'segunda insercion!! segunda insercion!! segunda insercion!! segunda insercion!! segunda insercion!! segunda insercion!! segunda insercion!! segunda insercion!! segunda insercion!!',4,2,2,'2025-02-27',2),(4,'Casa en la playa 2',200000.00,NULL,'Segunda inserción!! Segunda inserción!! Segunda inserción!! Segunda inserción!! Segunda inserción!! Segunda inserción!! Segunda inserción!! Segunda inserción!! Segunda inserción!!',4,2,2,'2025-02-27',2),(5,'Casa en la playa 3',300000.00,NULL,'tercera insercion!! tercera insercion!! tercera insercion!! tercera insercion!! tercera insercion!! tercera insercion!! tercera insercion!! tercera insercion!! tercera insercion!! tercera insercion!!',4,4,2,'2025-02-27',1),(6,'Casa en la playa 4',300000.00,NULL,'cuarta inserción!! cuarta inserción!! cuarta inserción!! cuarta inserción!! cuarta inserción!! cuarta inserción!! cuarta inserción!! cuarta inserción!! cuarta inserción!! cuarta inserción!!',4,4,4,'2025-02-27',2),(7,'Casa en la playa 4',300000.00,NULL,'cuarta inserción!! cuarta inserción!! cuarta inserción!! cuarta inserción!! cuarta inserción!! cuarta inserción!! cuarta inserción!! cuarta inserción!! cuarta inserción!! cuarta inserción!!',4,4,4,'2025-02-27',2),(8,'Casa en la playa 5',200000.00,NULL,'quinta inserción!! quinta inserción!! quinta inserción!! quinta inserción!! quinta inserción!! quinta inserción!! quinta inserción!! quinta inserción!! quinta inserción!! quinta inserción!!',3,2,1,'2025-02-27',2),(9,'Casa en la playa 6',100000.00,NULL,'sexta inserción!! sexta inserción!! sexta inserción!! sexta inserción!! sexta inserción!! sexta inserción!! sexta inserción!! sexta inserción!! sexta inserción!! sexta inserción!!',3,2,1,'2025-02-27',1),(11,'Casa en la playa 10 Actualizado',200000.00,'d09cde06816be4285ee85d05f486222e.jpg',' Esto es una prueeba  Esto es una prueeba  Esto es una prueeba  Esto es una prueeba  Esto es una prueeba  Esto es una prueeba  Esto es una prueeba  Esto es una prueeba  Esto es una prueeba  Esto es una prueeba  Esto es una prueeba  Esto es una prueeba  Esto es una prueeba  Esto es una prueeba  Esto es una prueeba  Esto es una prueeba  Esto es una prueeba  Esto es una prueeba ',3,2,1,'2025-06-01',1),(12,'Casa en la playa 10',100000.00,'f508ff3ab23267973f28d284eaa41616.jpg',' Esto es una prueeba  Esto es una prueeba  Esto es una prueeba  Esto es una prueeba  Esto es una prueeba  Esto es una prueeba  Esto es una prueeba  Esto es una prueeba  Esto es una prueeba  Esto es una prueeba  Esto es una prueeba  Esto es una prueeba  Esto es una prueeba  Esto es una prueeba  Esto es una prueeba  Esto es una prueeba  Esto es una prueeba  Esto es una prueeba ',3,2,1,'2025-06-01',1),(13,'Casa en la playa 11',100000.00,'17946333827482ecb7f8573f6187ecdb.jpg','prueba 2 prueba 2 prueba 2 prueba 2 prueba 2 prueba 2 prueba 2 prueba 2 prueba 2 prueba 2 prueba 2 prueba 2 prueba 2 prueba 2 prueba 2 prueba 2 prueba 2 prueba 2 prueba 2 prueba 2 prueba 2 prueba 2 prueba 2 prueba 2 prueba 2 prueba 2 prueba 2 prueba 2 prueba 2 prueba 2 prueba 2 prueba 2 prueba 2 prueba 2 prueba 2 ',3,2,1,'2025-06-02',2);
/*!40000 ALTER TABLE `propiedades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendedores`
--

DROP TABLE IF EXISTS `vendedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendedores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendedores`
--

LOCK TABLES `vendedores` WRITE;
/*!40000 ALTER TABLE `vendedores` DISABLE KEYS */;
INSERT INTO `vendedores` VALUES (1,'Juan','Fierro','0984515368'),(2,'Judyth','Llanos','0948372834');
/*!40000 ALTER TABLE `vendedores` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-04 17:53:24
