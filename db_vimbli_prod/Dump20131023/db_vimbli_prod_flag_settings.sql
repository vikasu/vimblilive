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
-- Table structure for table `flag_settings`
--

DROP TABLE IF EXISTS `flag_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `flag_settings` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `active_mission` tinyint(1) NOT NULL DEFAULT '1',
  `active_sponsor` tinyint(1) NOT NULL DEFAULT '1',
  `days_remaining` int(100) NOT NULL,
  `last_reflection` int(100) NOT NULL,
  `total_reflection_in_30_days` int(11) NOT NULL,
  `last_contact_with_sponsor` int(100) NOT NULL,
  `active_sponsor_check` tinyint(4) NOT NULL DEFAULT '1',
  `days_remaining_check` tinyint(4) NOT NULL DEFAULT '1',
  `last_reflection_check` tinyint(4) NOT NULL DEFAULT '1',
  `total_reflection_check` tinyint(4) NOT NULL DEFAULT '1',
  `last_contact_with_sponsor_check` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flag_settings`
--

LOCK TABLES `flag_settings` WRITE;
/*!40000 ALTER TABLE `flag_settings` DISABLE KEYS */;
INSERT INTO `flag_settings` VALUES (1,204,1,1,7,7,1,0,1,1,1,1,0),(2,204,1,1,7,7,10,14,1,1,1,1,1),(3,9,1,1,7,7,10,14,1,1,1,1,1),(4,92,1,1,7,7,10,14,1,1,1,1,1),(5,172,1,1,7,7,10,14,1,1,1,1,1),(6,238,1,1,7,7,10,14,1,1,1,1,1),(7,178,1,1,7,7,10,14,1,1,1,1,1),(8,316,1,1,7,7,10,14,1,1,1,1,1);
/*!40000 ALTER TABLE `flag_settings` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-10-23 11:08:38
