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
-- Table structure for table `cohorts`
--

DROP TABLE IF EXISTS `cohorts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cohorts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `group_owner` int(11) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cohorts`
--

LOCK TABLES `cohorts` WRITE;
/*!40000 ALTER TABLE `cohorts` DISABLE KEYS */;
INSERT INTO `cohorts` VALUES (1,'Cohort One','Cohort One',9,'1','2013-01-17 00:00:00','0000-00-00 00:00:00'),(2,'Cohort Two','Cohort Two',9,'1','2013-01-15 00:00:00','0000-00-00 00:00:00'),(4,'Tec643-02','Pilot. Sacramento February 2013.',43,'1','2013-02-01 15:21:24','2013-02-01 15:21:24'),(5,'Vimbli - Vip Evaluators','Test',58,'1','2013-02-13 20:03:49','2013-02-13 20:03:49'),(6,'Usf Test Usa','Capitalization',80,'1','2013-02-22 18:53:07','2013-02-22 18:53:07'),(7,'Test','A cohort to test the functionality',92,'1','2013-05-29 19:05:19','2013-05-29 19:05:19'),(8,'Family','My direct family',204,'1','2013-06-11 14:30:21','2013-06-11 14:30:21'),(9,'Friends ','Just friends.  They are nice, and want to know what I do.',204,'1','2013-06-11 14:31:00','2013-06-11 14:31:00'),(10,'Fbi','Friends With Business Interest\\nFriends first, but they are interested in Vimbli as a business tool',204,'1','2013-06-11 14:31:45','2013-06-11 14:33:01'),(11,'Een','Toets',240,'1','2013-06-25 16:07:30','2013-06-25 16:07:30'),(12,'Twee','Toets 2',240,'1','2013-06-25 16:07:42','2013-06-25 16:07:42'),(13,'Summit','',204,'1','2013-08-20 15:57:56','2013-08-20 15:57:56'),(14,'HMS','',204,'1','2013-08-20 15:59:06','2013-08-20 15:59:06');
/*!40000 ALTER TABLE `cohorts` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-10-23 11:15:12
