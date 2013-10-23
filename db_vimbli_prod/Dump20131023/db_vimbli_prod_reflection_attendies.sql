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
-- Table structure for table `reflection_attendies`
--

DROP TABLE IF EXISTS `reflection_attendies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reflection_attendies` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `reflection_id` int(11) NOT NULL,
  `attendy_display_name` varchar(255) DEFAULT NULL,
  `attendy_email` varchar(255) DEFAULT NULL,
  `connection_id` int(11) DEFAULT NULL,
  `shared_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reflection_attendies`
--

LOCK TABLES `reflection_attendies` WRITE;
/*!40000 ALTER TABLE `reflection_attendies` DISABLE KEYS */;
INSERT INTO `reflection_attendies` VALUES (1,169,'Hennie Strydom','hennie@henniestrydom.com, hennies@gmail.com, hennie@mapmytime.co, hennie@vimbli.com, hennies@kindle.com, hennies@stanfordalumni.org, hennies@outlook.com, hennies72@yahoo.com',224331,'2013-06-20 09:50:00'),(2,170,'Vimbli Hennie','hennie@vimbli.com',253628,'2013-06-20 10:05:00'),(3,171,'Vimbli Hennie','hennie@vimbli.com',253628,'2013-06-20 12:37:00'),(4,171,'Vimbli Hennie','hennie@vimbli.com',253635,'2013-06-20 12:37:00'),(5,173,'Support Vimbli','support@vimbli.com',67306,'2013-06-21 05:24:00'),(6,174,'Support Vimbli','support@vimbli.com',67306,'2013-06-21 05:24:00'),(7,175,'Support Vimbli','support@vimbli.com',67306,'2013-06-21 07:46:00'),(8,177,'Smartian','smaartdatatest@gmail.com',221615,'2013-06-22 14:29:00'),(9,178,'Smartian','smaartdatatest@gmail.com',221615,'2013-06-22 14:38:00'),(10,182,'Support Vimbli','support@vimbli.com',67306,'2013-06-24 10:40:00'),(11,183,'Support Vimbli','support@vimbli.com',67306,'2013-06-24 12:03:00'),(12,184,'Support Vimbli','support@vimbli.com',67306,'2013-06-25 17:51:00'),(13,185,'Support Vimbli','support@vimbli.com',67306,'2013-06-25 17:51:00'),(14,189,'Support Vimbli','support@vimbli.com',67306,'2013-06-26 21:01:00'),(15,192,'Colton Strydom','coltonstrydom@gmail.com',261550,'2013-06-29 15:04:00'),(16,192,'Colton Strydom','coltonstrydom@gmail.com',261888,'2013-06-29 15:04:00'),(17,192,'Colton Strydom','coltonstrydom@gmail.com',261947,'2013-06-29 15:04:00'),(18,193,'Colton Strydom','coltonstrydom@gmail.com',261550,'2013-06-29 15:04:00'),(19,193,'Colton Strydom','coltonstrydom@gmail.com',261888,'2013-06-29 15:04:00'),(20,193,'Colton Strydom','coltonstrydom@gmail.com',261947,'2013-06-29 15:04:00'),(26,194,'Support Vimbli','support@vimbli.com',254861,'2013-06-30 23:59:59'),(25,194,'Support Vimbli','support@vimbli.com',255077,'2013-06-30 23:59:59'),(24,194,'Support Vimbli','support@vimbli.com',255113,'2013-06-30 23:59:59'),(27,199,'Colton Strydom','coltonstrydom@gmail.com',264876,'2013-07-04 18:42:45'),(28,199,'Simone Seeley','simoneseeley@hotmail.com, simone.seeley@clorox.com, simoneseeley415@gmail.com',264318,'2013-07-04 18:42:45'),(29,200,'Support Vimbli','support@vimbli.com',262597,'2013-07-05 03:20:07'),(30,202,'Colton Strydom','coltonstrydom@gmail.com',264876,'2013-07-05 08:03:45'),(31,202,'Support Vimbli','support@vimbli.com',262597,'2013-07-05 08:03:45'),(32,205,'Colton Strydom','coltonstrydom@gmail.com',264876,'2013-07-06 00:45:10'),(33,205,'Support Vimbli','support@vimbli.com',262597,'2013-07-06 00:45:10'),(34,207,'hennies@gmail.com','hennies@gmail.com',245971,'2013-07-06 21:22:51'),(35,207,'hennies@gmail.com','hennies@gmail.com',246179,'2013-07-06 21:22:51'),(36,207,'hennies@gmail.com','hennies@gmail.com',246401,'2013-07-06 21:22:51'),(37,209,'Colton Strydom','coltonstrydom@gmail.com',264876,'2013-07-09 18:39:02'),(38,209,'Simone Seeley','simoneseeley@hotmail.com, simone.seeley@clorox.com, simoneseeley415@gmail.com',264318,'2013-07-09 18:39:02'),(39,211,'Colton Strydom','coltonstrydom@gmail.com',264876,'2013-07-13 04:19:45'),(40,212,'Colton Strydom','coltonstrydom@gmail.com',264876,'2013-07-17 20:35:09'),(41,212,'Support Vimbli','support@vimbli.com',262597,'2013-07-17 20:35:09'),(42,218,'Colton Strydom','coltonstrydom@gmail.com',264876,'2013-07-20 20:40:18'),(43,218,'Admin Vimbli','admin@vimbli.com',262453,'2013-07-20 20:40:18'),(44,219,'Colton Strydom','coltonstrydom@gmail.com',264876,'2013-07-21 15:42:54'),(45,219,'Support Vimbli','support@vimbli.com',262597,'2013-07-21 15:42:54'),(46,220,'Colton Strydom','coltonstrydom@gmail.com',264876,'2013-07-23 04:18:51'),(47,220,'Support Vimbli','support@vimbli.com',262597,'2013-07-23 04:18:51'),(48,221,'Colton Strydom','coltonstrydom@gmail.com',264876,'2013-07-24 14:06:40'),(49,221,'Tom Rikert','tomrikert@gmail.com, tom.rikert@gmail.com, trikert@mba2006.hbs.edu, tom@a16z.com, tom@vimbli.com',264310,'2013-07-24 14:06:40'),(50,221,'Support Vimbli','support@vimbli.com',262597,'2013-07-24 14:06:40'),(51,222,'Mike Scahill','mdscahill@gmail.com',223328,'2013-07-24 22:03:11'),(52,222,'Support Vimbli','support@vimbli.com',223658,'2013-07-24 22:03:11'),(53,223,'Support Vimbli','support@vimbli.com',223658,'2013-07-24 23:07:27'),(54,223,'Hank Ritchie','htritchie@aol.com, henry.t.ritchie@gmail.com',224048,'2013-07-24 23:07:27'),(55,226,'Simone Seeley','simoneseeley@hotmail.com, simone.seeley@clorox.com, simoneseeley415@gmail.com',264318,'2013-07-28 02:51:09'),(56,226,'Support Vimbli','support@vimbli.com',262597,'2013-07-28 02:51:09'),(58,227,'Super Fan','support@vimbli.com',253630,'2013-07-28 23:59:59'),(59,230,'Colton Strydom','coltonstrydom@gmail.com',264876,'2013-07-31 23:59:59'),(60,230,'Simone Seeley','simoneseeley@hotmail.com, simone.seeley@clorox.com, simoneseeley415@gmail.com',264318,'2013-07-31 23:59:59'),(61,238,'Support Vimbli','support@vimbli.com',262597,'2013-08-06 15:54:12'),(62,240,'Support Vimbli','support@vimbli.com',262597,'2013-08-06 23:09:44'),(63,248,'hennies@gmail.com','hennies@gmail.com',245971,'2013-08-13 02:36:57'),(64,248,'hennies@gmail.com','hennies@gmail.com',246179,'2013-08-13 02:36:57'),(65,248,'hennies@gmail.com','hennies@gmail.com',246401,'2013-08-13 02:36:57'),(66,257,'Support Vimbli','support@vimbli.com',262597,'2013-08-20 16:36:33'),(67,288,'Colton Strydom','coltonstrydom@gmail.com',289487,'2013-10-08 16:52:53'),(68,288,'Simone Seeley','simoneseeley@hotmail.com, simone.seeley@clorox.com, simoneseeley415@gmail.com',288920,'2013-10-08 16:52:53'),(69,288,'Support Vimbli','support@vimbli.com',287155,'2013-10-08 16:52:53'),(70,291,'Colton Strydom','coltonstrydom@gmail.com',289487,'2013-10-18 14:53:41'),(71,291,'Simone Seeley','simoneseeley@hotmail.com, simone.seeley@clorox.com, simoneseeley415@gmail.com',288920,'2013-10-18 14:53:41'),(72,295,'Colton Strydom','coltonstrydom@gmail.com',289487,'2013-10-21 15:23:41'),(73,295,'Simone Seeley','simoneseeley@hotmail.com, simone.seeley@clorox.com, simoneseeley415@gmail.com',288920,'2013-10-21 15:23:41'),(74,295,'Support Vimbli','support@vimbli.com',287155,'2013-10-21 15:23:41');
/*!40000 ALTER TABLE `reflection_attendies` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-10-23 11:21:14
