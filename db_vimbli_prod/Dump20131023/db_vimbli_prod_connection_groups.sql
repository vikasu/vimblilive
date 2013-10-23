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
-- Table structure for table `connection_groups`
--

DROP TABLE IF EXISTS `connection_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `connection_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `is_default` enum('0','1') NOT NULL DEFAULT '1',
  `group_owner` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `connection_groups`
--

LOCK TABLES `connection_groups` WRITE;
/*!40000 ALTER TABLE `connection_groups` DISABLE KEYS */;
INSERT INTO `connection_groups` VALUES (1,'Default','This is the group who want me to be successful b/c it will help them be successful ...','1',0,'1','2012-11-22 13:13:16','2012-12-05 13:55:37'),(2,'Sponsors','This is the group who want me to be successful b/c it will help them be successful ...','1',0,'1','2012-11-22 13:13:16','2012-12-05 13:55:37'),(3,'Colleagues','This is a family group','1',0,'1','2012-11-22 13:17:24','2012-12-05 13:55:05'),(4,'Family','My close family, and friends like family','1',0,'1','2012-12-05 13:54:28','2012-12-12 14:05:17'),(5,'Cohort','Colleagues who started with me, or who are on the same program','1',0,'1','2012-12-05 13:56:07','2012-12-13 17:00:20'),(6,'Clients','People I serve, could be internal or external clients','1',0,'1','2012-12-05 13:56:51','2012-12-13 17:00:20'),(7,'Friends','People who I like to spend time with in a social setting','1',0,'1','2012-12-05 13:57:30','2012-12-05 13:57:30'),(15,'Web Developer','Group of all web developers.','1',2,'1','2012-12-19 11:20:14','2012-12-19 11:20:14'),(9,'Not Mine','asfd afa ','1',3,'1','2012-12-18 15:20:22','0000-00-00 00:00:00'),(14,'TEST capiTAlizaTION','Group of smart data.','1',2,'1','2012-12-19 11:14:58','2013-07-24 03:45:20'),(16,'Test Groups','fdsafsaf afs afs','1',2,'1','2012-12-19 11:29:45','2012-12-19 11:29:45'),(26,'Coaches','','1',145,'1','2013-04-02 02:19:00','2013-04-02 02:19:47'),(27,'HMS','Whatever','1',0,'1','2013-08-02 00:43:48','2013-08-02 00:43:48');
/*!40000 ALTER TABLE `connection_groups` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-10-23 11:22:07
