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
-- Table structure for table `processes`
--

DROP TABLE IF EXISTS `processes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `processes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `processes`
--

LOCK TABLES `processes` WRITE;
/*!40000 ALTER TABLE `processes` DISABLE KEYS */;
INSERT INTO `processes` VALUES (1,117,'first_sync','0','2013-05-13 12:17:18'),(2,50,'first_sync','0','2013-05-03 06:35:16'),(3,50,'bg_con_sync','0','2013-05-03 06:33:44'),(4,117,'bg_con_sync','0','2013-05-07 08:11:20'),(5,176,'first_sync','0','2013-05-02 14:40:06'),(14,181,'bg_con_sync','0','2013-05-06 12:15:46'),(13,181,'first_sync','0','2013-05-06 12:13:36'),(8,178,'first_sync','0','2013-09-04 06:37:08'),(9,178,'bg_con_sync','0','2013-09-17 08:57:22'),(10,179,'first_sync','0','2013-05-03 16:43:57'),(11,179,'bg_con_sync','0','2013-05-03 16:47:48'),(12,180,'first_sync','0','2013-05-03 16:51:08'),(15,182,'first_sync','0','2013-05-06 14:55:19'),(16,183,'first_sync','0','2013-05-06 19:43:44'),(17,184,'first_sync','0','2013-05-06 19:48:40'),(18,185,'first_sync','0','2013-05-07 12:33:39'),(19,186,'first_sync','0','2013-05-08 13:40:30'),(20,187,'first_sync','0','2013-05-07 12:45:10'),(21,188,'first_sync','0','2013-05-07 14:39:21'),(22,172,'bg_con_sync','0','2013-10-04 18:16:52'),(23,172,'first_sync','0','2013-08-23 23:18:55'),(24,189,'first_sync','0','2013-05-21 18:17:19'),(25,193,'first_sync','0','2013-06-04 12:20:56'),(26,194,'first_sync','0','2013-05-24 17:46:04'),(27,194,'bg_con_sync','0','2013-05-24 18:06:44'),(28,196,'first_sync','0','2013-05-29 18:52:16'),(29,195,'first_sync','0','2013-05-29 20:43:16'),(30,197,'first_sync','0','2013-05-31 18:48:11'),(31,202,'first_sync','0','2013-06-08 00:49:21'),(32,203,'first_sync','0','2013-06-08 01:04:36'),(33,205,'first_sync','0','2013-06-08 14:54:22'),(34,207,'first_sync','1','2013-06-08 16:40:04'),(35,208,'first_sync','0','2013-06-08 21:27:38'),(36,211,'first_sync','0','2013-06-10 15:13:26'),(37,204,'first_sync','0','2013-07-25 21:06:39'),(38,218,'first_sync','0','2013-06-10 23:42:05'),(39,213,'first_sync','0','2013-06-11 05:12:33'),(40,221,'first_sync','0','2013-06-11 19:31:54'),(41,222,'first_sync','0','2013-06-13 01:24:26'),(42,225,'first_sync','1','2013-06-13 06:29:42'),(43,231,'first_sync','0','2013-09-27 16:01:28'),(44,232,'first_sync','0','2013-06-14 01:18:04'),(45,212,'first_sync','0','2013-06-17 16:07:53'),(46,234,'first_sync','1','2013-06-19 19:57:16'),(47,236,'first_sync','0','2013-06-20 16:41:24'),(48,237,'first_sync','0','2013-07-02 19:27:36'),(49,235,'first_sync','1','2013-07-20 17:58:27'),(50,238,'first_sync','1','2013-06-28 15:08:11'),(51,239,'first_sync','1','2013-07-05 18:48:42'),(52,244,'first_sync','0','2013-07-02 16:45:55'),(53,237,'bg_con_sync','0','2013-07-02 19:13:59'),(54,242,'first_sync','0','2013-07-02 19:29:07'),(55,261,'first_sync','0','2013-07-25 18:48:25'),(56,260,'first_sync','0','2013-07-25 21:38:19'),(57,262,'first_sync','0','2013-07-26 01:29:38'),(58,263,'first_sync','1','2013-08-01 13:28:33'),(59,265,'first_sync','0','2013-08-01 18:01:47'),(60,245,'first_sync','0','2013-08-07 14:45:45'),(61,267,'first_sync','0','2013-08-07 23:21:03'),(62,268,'first_sync','0','2013-08-09 12:45:41'),(63,273,'first_sync','0','2013-08-14 22:22:16'),(64,275,'first_sync','0','2013-08-19 18:13:58'),(65,278,'first_sync','0','2013-08-20 22:49:11'),(66,279,'first_sync','1','2013-08-21 22:27:38'),(67,285,'first_sync','0','2013-08-22 21:26:06'),(68,286,'first_sync','0','2013-08-22 21:30:16'),(69,287,'first_sync','0','2013-08-23 10:00:16'),(70,288,'first_sync','0','2013-08-23 10:16:49'),(71,289,'first_sync','0','2013-08-23 10:18:43'),(72,290,'first_sync','0','2013-08-23 10:31:53'),(73,291,'first_sync','0','2013-08-23 10:33:48'),(74,292,'first_sync','1','2013-08-23 14:44:18'),(75,296,'first_sync','1','2013-08-24 05:31:15'),(76,297,'first_sync','0','2013-08-24 05:52:15'),(77,299,'first_sync','0','2013-08-24 05:55:25'),(78,303,'first_sync','0','2013-08-26 18:18:06'),(79,309,'first_sync','1','2013-09-01 02:58:47'),(80,204,'bg_con_sync','0','2013-09-04 06:58:26'),(81,311,'first_sync','1','2013-09-09 16:18:10'),(82,312,'first_sync','0','2013-09-12 02:31:35'),(83,313,'first_sync','0','2013-09-16 18:08:48'),(84,314,'first_sync','0','2013-09-19 06:08:11'),(85,317,'first_sync','1','2013-10-02 09:51:05'),(86,319,'first_sync','1','2013-10-08 02:33:11'),(87,322,'first_sync','0','2013-10-08 21:53:15'),(88,325,'first_sync','1','2013-10-12 20:00:58');
/*!40000 ALTER TABLE `processes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-10-23 11:13:10
