CREATE DATABASE  IF NOT EXISTS `db_vimbli_prod` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_vimbli_prod`;
-- MySQL dump 10.13  Distrib 5.5.32, for debian-linux-gnu (i686)
--
-- Host: vimblidb.cvxwtu7q95t7.us-east-1.rds.amazonaws.com    Database: db_vimbli_prod
-- ------------------------------------------------------
-- Server version	5.5.25a-log

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
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ratings` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `rating` decimal(2,1) NOT NULL,
  `rating_quote` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ratings`
--

LOCK TABLES `ratings` WRITE;
/*!40000 ALTER TABLE `ratings` DISABLE KEYS */;
INSERT INTO `ratings` VALUES (1,0.0,'Oops ... no rating! Rate something ... ','2013-10-09 00:00:00','2013-10-15 13:57:30'),(2,1.0,'Hold on! Things will get better.','0000-00-00 00:00:00','2013-10-22 23:59:12'),(3,1.1,'Hold on. Things will get better.','0000-00-00 00:00:00','2013-10-22 23:59:48'),(4,1.2,'Look on the bright side','0000-00-00 00:00:00','2013-10-23 00:09:35'),(5,1.3,'Look on the bright side','0000-00-00 00:00:00','2013-10-23 00:10:35'),(6,1.4,'Some bumps and bruises','0000-00-00 00:00:00','2013-10-23 00:11:22'),(7,1.5,'Some bumps and bruises','0000-00-00 00:00:00','2013-10-23 01:42:29'),(8,1.6,'1.6 - Bumps and bruises','0000-00-00 00:00:00','2013-10-15 18:00:22'),(9,1.7,'1.7 - Bumps and bruises','0000-00-00 00:00:00','2013-10-15 18:01:01'),(10,1.8,'1.8 - Bumps and bruises','0000-00-00 00:00:00','2013-10-15 18:02:24'),(11,1.9,'1.9 - Looking up!','0000-00-00 00:00:00','2013-10-15 18:07:55'),(12,2.0,'2.0 - Looking up!','0000-00-00 00:00:00','2013-10-15 18:10:32'),(13,2.1,'2.1 - Looking up!','0000-00-00 00:00:00','2013-10-15 18:26:00'),(14,2.2,'2.2 - Looking up!','0000-00-00 00:00:00','2013-10-15 18:26:48'),(15,2.3,'2.3 - Looking up!','0000-00-00 00:00:00','2013-10-15 18:34:34'),(16,2.4,'2.4 - Looking up!','0000-00-00 00:00:00','2013-10-15 18:35:29'),(17,2.5,'2.5 - Looking up!','0000-00-00 00:00:00','2013-10-15 18:36:31'),(18,2.6,'2.6 - Looking up!','0000-00-00 00:00:00','2013-10-15 18:37:55'),(19,2.7,'2.7 fab','0000-00-00 00:00:00','2013-10-15 18:40:10'),(20,2.8,'2.8 marvellous','0000-00-00 00:00:00','2013-10-15 18:41:54'),(21,2.9,'2.9 no words','0000-00-00 00:00:00','2013-10-15 18:42:29'),(22,3.0,'3.0 excellent !','0000-00-00 00:00:00','2013-10-15 18:41:05');
/*!40000 ALTER TABLE `ratings` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-10-23 11:20:41
