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
-- Table structure for table `activity_attendies`
--

DROP TABLE IF EXISTS `activity_attendies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_attendies` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `attendy_display_name` varchar(255) DEFAULT NULL,
  `attendy_email` varchar(255) DEFAULT NULL,
  `connection_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=201 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_attendies`
--

LOCK TABLES `activity_attendies` WRITE;
/*!40000 ALTER TABLE `activity_attendies` DISABLE KEYS */;
INSERT INTO `activity_attendies` VALUES (15,155,'Manish K.','manishk@smartdatainc.net',16285),(11,156,'Simone Seeley','simoneseeley@hotmail.com',10860),(14,155,'Nakul Kumar','nakulk@smartdatainc.net',16284),(127,196,'Another Tester','admin@vimbli.com, anotheremail134125145@gmail.com',221590),(126,185,'Rakesh Pant','rakesh.pant@gmail.com',221613),(48,186,'Hennie Strydom','hennies@gmail.com',221509),(17,159,'Vimbli Hennie','hennie@vimbli.com',13574),(18,159,'Simone Seeley','simoneseeley@hotmail.com',13578),(19,160,'Simone Seeley','simoneseeley@hotmail.com',23772),(20,161,'Simone Seeley','simoneseeley@hotmail.com',29393),(21,162,'HMS SERVICE','hms007@gmail.com',29397),(49,188,'Vimbli Hennie','hennie@vimbli.com',221516),(23,163,'A.N. other','admin@vimbli.com',29398),(24,164,'Willie van der Westhuizen','willie.vanderwesthuizen@facebook.com',31272),(25,165,'Willie van der Westhuizen','willie.vanderwesthuizen@facebook.com',31272),(26,166,'Willie van der Westhuizen','willie.vanderwesthuizen@facebook.com',31272),(27,167,'Willie van der Westhuizen','willie.vanderwesthuizen@facebook.com',31272),(28,168,'Simone Seeley','simoneseeley@hotmail.com',29393),(29,169,'HMS SERVICE','hms007@gmail.com',36458),(30,170,'HMS SERVICE','hms007@gmail.com',36458),(31,171,'A.N. other','admin@vimbli.com',36459),(32,173,'Rakesh Pant','rakesh.pant@gmail.com',218262),(125,174,'Rakesh Pant','rakesh.pant@gmail.com',221613),(50,190,'Hennie Strydom','hennies@gmail.com',221525),(51,190,'Hennie Strydom','hms007@gmail.com',221539),(52,190,'Vimbli Hennie','hennie@vimbli.com',221532),(36,177,'Hennie Strydom','hennies@gmail.com',221509),(53,191,'Vimbli Hennie','hennie@vimbli.com',221532),(38,177,'Hennie Strydom','hms007@gmail.com',221524),(39,178,'Hennie Strydom','hennies@gmail.com',221509),(40,178,'Hennie Strydom','hms007@gmail.com',221524),(41,179,'Hennie Strydom','hennies@gmail.com',221509),(59,194,'Hennie Strydom','hennies@gmail.com',221525),(58,193,'Vimbli Hennie','hennie@vimbli.com',221532),(60,194,'Hennie Strydom','hms007@gmail.com',221540),(61,194,'Vimbli Hennie','hennie@vimbli.com',221532),(107,192,'Another Tester','admin@vimbli.com, anotheremail134125145@gmail.com',221530),(108,192,'Vimbli Hennie','hennie@vimbli.com',221532),(118,195,'Vimbli Hennie','hennie@vimbli.com',221592),(128,196,'Vimbli Hennie','hennie@vimbli.com',221592),(129,197,'Another Tester','admin@vimbli.com, anotheremail134125145@gmail.com',221590),(130,197,'Vimbli Hennie','hennie@vimbli.com',221592),(131,198,'Another Tester','admin@vimbli.com, anotheremail134125145@gmail.com',221590),(132,198,'Vimbli Hennie','hennie@vimbli.com',221592),(133,199,'Another Tester','admin@vimbli.com, anotheremail134125145@gmail.com',221590),(134,199,'Vimbli Hennie','hennie@vimbli.com',221592),(135,200,'Another Tester','admin@vimbli.com, anotheremail134125145@gmail.com',221590),(136,200,'Vimbli Hennie','hennie@vimbli.com',221592),(137,201,'Another Tester','admin@vimbli.com, anotheremail134125145@gmail.com',221590),(138,201,'Vimbli Hennie','hennie@vimbli.com',221592),(139,202,'Another Tester','admin@vimbli.com, anotheremail134125145@gmail.com',221590),(140,202,'Vimbli Hennie','hennie@vimbli.com',221592),(141,203,'Another Tester','admin@vimbli.com, anotheremail134125145@gmail.com',221590),(142,203,'Vimbli Hennie','hennie@vimbli.com',221592),(143,204,'Hennie Strydom','hennies@gmail.com',221585),(144,204,'Hennie Strydom','hms007@gmail.com',221589),(145,204,'Another Tester','admin@vimbli.com, anotheremail134125145@gmail.com',221590),(146,204,'Vimbli Hennie','hennie@vimbli.com',221592),(147,205,'Hennie Strydom','hennies@gmail.com',221585),(148,205,'Another Tester','admin@vimbli.com, anotheremail134125145@gmail.com',221590),(149,205,'Vimbli Hennie','hennie@vimbli.com',221592),(150,208,'Hennie Strydom','hennies@gmail.com',221644),(151,208,'Hennie Strydom','hms007@gmail.com',221648),(152,208,'Vimbli Hennie','hennie@vimbli.com',221651),(159,209,'Aastik Khanna','aastik_k@gmail.com',221616),(160,209,'Rakesh Pant','rakesh.pant@gmail.com',221613),(161,209,'Annie','anniek@gmail.com',221614),(162,210,'Hennie Strydom','hennies@gmail.com',221644),(163,210,'Hennie Strydom','hms007@gmail.com',221648),(164,210,'Another Tester','admin@vimbli.com, anotheremail134125145@gmail.com',221649),(165,210,'Vimbli Hennie','hennie@vimbli.com',221651),(166,211,'Hennie Strydom','hennies@gmail.com',221644),(167,211,'Vimbli Hennie','hennie@vimbli.com',221651),(194,212,'Another Tester','admin@vimbli.com, anotheremail134125145@gmail.com',221649),(195,212,'Vimbli Hennie','hennie@vimbli.com',221651),(196,213,'Another Tester','admin@vimbli.com, anotheremail134125145@gmail.com',221530),(197,213,'Super Fan','support@vimbli.com',221534),(198,216,'JenI','',221723),(199,219,'Vimbli Hennie','hennie@vimbli.com',253628),(200,241,'Annie','anniek@gmail.com',221614);
/*!40000 ALTER TABLE `activity_attendies` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-10-23 11:08:46
