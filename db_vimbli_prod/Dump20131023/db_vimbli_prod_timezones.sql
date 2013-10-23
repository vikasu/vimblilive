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
-- Table structure for table `timezones`
--

DROP TABLE IF EXISTS `timezones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `timezones` (
  `id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `timezone_location` varchar(60) NOT NULL,
  `gmt` varchar(11) NOT NULL,
  `offset` tinyint(2) NOT NULL,
  `difference_in_seconds` int(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `timezones`
--

LOCK TABLES `timezones` WRITE;
/*!40000 ALTER TABLE `timezones` DISABLE KEYS */;
INSERT INTO `timezones` VALUES (1,'(GMT -12:00) Eniwetok, Kwajalein','GMT -12:00',-12,-43200),(2,'(GMT -11:00) Midway Island, Samoa','GMT -11:00',-11,-39600),(3,'(GMT -10:00) Hawaii','GMT -10:00',-10,-36000),(4,'(GMT -9:00) Alaska','GMT -9:00',-9,-32400),(5,'(GMT -7:00) Mountain Time (US & Canada)','GMT -7:00',-7,-25200),(6,'(GMT -8:00) Pacific Time (US & Canada)','GMT -8:00',-8,-28800),(7,'(GMT -6:00) Central Time (US & Canada), Mexico City','GMT -6:00',-6,-21600),(8,'(GMT -5:00) Eastern Time (US & Canada), Bogota, Lima','GMT -5:00',-5,-18000),(9,'(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz','GMT -4:00',-4,-14400),(10,'(GMT -3:30) Newfoundland','GMT -3:30',-3,-12600),(11,'(GMT -3:00) Brazil, Buenos Aires, Georgetown','GMT -3:00',-3,-10800),(12,'(GMT -2:00) Mid-Atlantic','GMT -2:00',-2,-7200),(13,'(GMT -1:00 hour) Azores, Cape Verde Islands','GMT -1:00 h',-1,-3600),(14,'(GMT) Western Europe Time, London, Lisbon, Casablanca','GMT',0,0),(15,'(GMT +1:00 hour) Brussels, Copenhagen, Madrid, Paris','GMT +1:00 h',1,3600),(16,'(GMT +2:00) Kaliningrad, South Africa','GMT +2:00',2,7200),(17,'(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg','GMT +3:00',3,10800),(18,'(GMT +3:30) Tehran','GMT +3:30',3,12600),(19,'(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi','GMT +4:00',4,14400),(20,'(GMT +4:30) Kabul','GMT +4:30',4,16200),(21,'(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent','GMT +5:00',5,18000),(22,'(GMT +5:30) Bombay, Calcutta, Madras, New Delhi','GMT +5:30',5,19800),(23,'(GMT +5:45) Kathmandu','GMT +5:45',5,20700),(24,'(GMT +6:00) Almaty, Dhaka, Colombo','GMT +6:00',6,21600),(25,'(GMT +7:00) Bangkok, Hanoi, Jakarta','GMT +7:00',7,25200),(26,'(GMT +8:00) Beijing, Perth, Singapore, Hong Kong','GMT +8:00',8,28800),(27,'(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk','GMT +9:00',9,32400),(28,'(GMT +9:30) Adelaide, Darwin','GMT +9:30',9,34200),(29,'(GMT +10:00) Eastern Australia, Guam, Vladivostok','GMT +10:00',10,36000),(30,'(GMT +11:00) Magadan, Solomon Islands, New Caledonia','GMT +11:00',11,39600),(31,'(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka','GMT +12:00',12,43200);
/*!40000 ALTER TABLE `timezones` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-10-23 11:15:23
