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
-- Table structure for table `activity_types`
--

DROP TABLE IF EXISTS `activity_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `status` enum('0','1') NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_types`
--

LOCK TABLES `activity_types` WRITE;
/*!40000 ALTER TABLE `activity_types` DISABLE KEYS */;
INSERT INTO `activity_types` VALUES (1,'Exercise','Users can do verious exercises under this activity type','1','2013-01-02 12:44:36','2013-01-02 12:44:40'),(4,'Family And Friends','Time dedicated to friends and family','1','2013-02-16 17:34:09','2013-04-24 14:32:40'),(5,'Work','All work related activities','1','2013-02-16 17:34:39','2013-02-16 17:34:39'),(6,'Sleep','Sleep, including naps','1','2013-02-16 17:35:05','2013-02-16 17:35:05'),(7,'My Family (i.e. Household)','Husband, wife, children.  Folks in the same household.','1','2013-02-16 17:36:13','2013-02-16 17:36:13'),(8,'Reflection And Appreciation','Time to pause and take it all in. Make adjustments.  ','1','2013-02-16 17:37:15','2013-04-24 14:31:35'),(9,'Meals And Food Preparation','Time to fuel the body, and any time used to prepare the meal. ','1','2013-02-16 17:38:35','2013-02-16 17:38:35'),(10,'Chores','The stuff that needs to get done in around the home, and my life.','1','2013-02-16 17:39:33','2013-02-16 17:39:33'),(11,'Community','Things I do in the community, with the community and for the community.   ','1','2013-02-16 17:40:24','2013-02-16 17:40:24'),(12,'Hobbies And Interests','Things I like doing ... ','1','2013-02-16 17:41:09','2013-02-16 17:41:09');
/*!40000 ALTER TABLE `activity_types` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-10-23 11:09:09
