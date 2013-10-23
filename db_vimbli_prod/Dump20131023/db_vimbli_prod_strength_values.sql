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
-- Table structure for table `strength_values`
--

DROP TABLE IF EXISTS `strength_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `strength_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `1` varchar(100) DEFAULT NULL,
  `2` varchar(100) DEFAULT NULL,
  `3` varchar(100) DEFAULT NULL,
  `4` varchar(100) DEFAULT NULL,
  `5` varchar(100) DEFAULT NULL,
  `6` varchar(100) DEFAULT NULL,
  `7` varchar(100) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `attachment` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `strength_values`
--

LOCK TABLES `strength_values` WRITE;
/*!40000 ALTER TABLE `strength_values` DISABLE KEYS */;
INSERT INTO `strength_values` VALUES (29,17,'Creativity','Curiosity','Open-mindedness','Love of learning','Perspective(wisdom)','Bravery(valor)','Persistence',4,'notes here',NULL,NULL,NULL),(30,152,'Understanding context and trends','Ability to influence through language/communications','Ability to build relationships and connect people','','','','',2,'',NULL,NULL,NULL),(31,260,'Creativity','Honesty','Open-mindedness','Humility','Perspective(wisdom)','Bravery(valor)','Persistence',3,'notes here',NULL,'2013-07-25 21:30:22','2013-07-25 21:30:22'),(32,245,'Earnestness','Likeability','Level-headedness','Positivity','Thorough','Energetic','Empathetic',2,'notes here',NULL,'2013-08-02 03:16:22','2013-08-02 03:16:22'),(33,204,'Earnestness','Likeability','Level-headedness','Positivity','Thorough','Energetic','Empathetic',2,'notes here',NULL,'2013-08-02 13:45:35','2013-08-02 13:45:35'),(41,178,'Curiosity','Love of learning','Perspective(wisdom)','Persistence','Love','Kindness','Affection',1,'say hello','SanJosedelCabo_ROW10219589830_1366x768_1380780173.jpg','2013-10-03 06:02:53','2013-10-03 06:02:53'),(36,313,'Curiosity','Love of learning','Perspective(wisdom)','Persistence','Love','Kindness','Social Intelligence',3,NULL,NULL,'2013-09-16 18:08:12','2013-09-16 18:08:12'),(37,313,'Curiosity','Love of learning','Perspective(wisdom)','Persistence','Love','Kindness','Social Intelligence',3,NULL,NULL,'2013-09-16 18:08:14','2013-09-16 18:08:14'),(38,313,'Curiosity','Love of learning','Perspective(wisdom)','Persistence','Love','Kindness','Social Intelligence',3,NULL,NULL,'2013-09-16 18:08:14','2013-09-16 18:08:14'),(42,178,'Value One','Love of learning','Perspective(wisdom)','Persistence','Love','Kindness','Affection',1,'say hello on Oct 07',NULL,'2013-10-07 07:10:20','2013-10-07 07:10:20'),(43,172,'love','Affection','Attraction','hate','try','anger','awesome',3,'testing','ChandBaori_ROW10767946511_1366x768_1381131859.jpg','2013-10-07 07:44:19','2013-10-07 07:44:19'),(40,178,'Curiosity','Love of learning','Perspective(wisdom)','Persistence','Love','Kindness','Social Intelligence',3,'say hello','ChandBaori_ROW10767946511_1366x768_1380777856.jpg','2013-10-03 05:24:16','2013-10-03 05:24:16'),(44,172,'love','Affection','Attraction','hate','try','anger','awesome and Fab',3,'testing Complete',NULL,'2013-10-07 08:48:21','2013-10-07 08:48:21'),(45,172,'Focus','Resilience','Care','Consideration',NULL,NULL,NULL,2,'Another test ... hms',NULL,'2013-10-07 17:55:42','2013-10-07 17:55:42');
/*!40000 ALTER TABLE `strength_values` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-10-23 11:22:45
