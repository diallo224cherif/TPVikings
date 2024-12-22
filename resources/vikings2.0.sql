-- MariaDB dump 10.19  Distrib 10.11.5-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: vikings
-- ------------------------------------------------------
-- Server version	10.11.5-MariaDB-3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Weapon`
--

DROP TABLE IF EXISTS `Weapon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Weapon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `damage` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Weapon`
--

LOCK TABLES `Weapon` WRITE;
/*!40000 ALTER TABLE `Weapon` DISABLE KEYS */;
INSERT INTO `Weapon` VALUES
(2,'axe',60),
(6,'knife',42),
(7,'spear',55),
(8,'hager',25),
(9,'sword',55),
(10,'arrow',19);
/*!40000 ALTER TABLE `Weapon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `viking`
--

DROP TABLE IF EXISTS `viking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `viking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(16) NOT NULL,
  `attack` int(11) NOT NULL,
  `defense` int(11) NOT NULL,
  `health` int(11) NOT NULL,
  `weaponId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_weapon` (`weaponId`),
  CONSTRAINT `FK_weapon` FOREIGN KEY (`weaponId`) REFERENCES `Weapon` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `viking`
--

LOCK TABLES `viking` WRITE;
/*!40000 ALTER TABLE `viking` DISABLE KEYS */;
INSERT INTO `viking` VALUES
(1,'Ragnar',200,150,300,2),
(2,'Floki',150,80,350,2),
(3,'Lagertha',300,200,200,10),
(4,'Björn',350,200,100,6),
(5,'tobi',200,100,400,8),
(6,'thierry',200,100,400,NULL),
(7,'kozax',200,100,400,2),
(8,'atos',130,100,500,9);
/*!40000 ALTER TABLE `viking` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-22  2:39:44
