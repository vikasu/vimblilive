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
-- Table structure for table `schedule_balances`
--

DROP TABLE IF EXISTS `schedule_balances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schedule_balances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `day` varchar(100) NOT NULL,
  `start` varchar(100) NOT NULL,
  `end` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=551 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedule_balances`
--

LOCK TABLES `schedule_balances` WRITE;
/*!40000 ALTER TABLE `schedule_balances` DISABLE KEYS */;
INSERT INTO `schedule_balances` VALUES (1,208,'Monday','08:00:00','17:00:00'),(2,208,'Tuesday','08:00:00','17:00:00'),(3,208,'Wednesday','08:00:00','17:00:00'),(4,208,'Thursday','08:00:00','17:00:00'),(5,208,'Friday','08:00:00','17:00:00'),(6,92,'Monday','08:00:00','17:00:00'),(7,92,'Tuesday','08:00:00','17:00:00'),(8,92,'Wednesday','08:00:00','17:00:00'),(9,92,'Thursday','08:00:00','17:00:00'),(10,92,'Friday','08:00:00','17:00:00'),(11,178,'Monday','08:00:00','17:00:00'),(12,178,'Tuesday','08:00:00','17:00:00'),(13,178,'Wednesday','08:00:00','17:00:00'),(14,178,'Thursday','08:00:00','17:00:00'),(15,178,'Friday','08:00:00','17:00:00'),(16,9,'Monday','08:00:00','17:00:00'),(17,9,'Tuesday','08:00:00','17:00:00'),(18,9,'Wednesday','08:00:00','17:00:00'),(19,9,'Thursday','08:00:00','17:00:00'),(20,9,'Friday','08:00:00','17:00:00'),(21,197,'Monday','08:00:00','17:00:00'),(22,197,'Tuesday','08:00:00','17:00:00'),(23,197,'Wednesday','08:00:00','17:00:00'),(24,197,'Thursday','08:00:00','17:00:00'),(25,197,'Friday','08:00:00','17:00:00'),(26,16,'Monday','08:00:00','17:00:00'),(27,16,'Tuesday','08:00:00','17:00:00'),(28,16,'Wednesday','08:00:00','17:00:00'),(29,16,'Thursday','08:00:00','17:00:00'),(30,16,'Friday','08:00:00','17:00:00'),(31,172,'Monday','08:00:00','17:00:00'),(32,172,'Tuesday','08:00:00','17:00:00'),(33,172,'Wednesday','08:00:00','17:00:00'),(34,172,'Thursday','08:00:00','17:00:00'),(35,172,'Friday','08:00:00','17:00:00'),(36,186,'Monday','08:00:00','17:00:00'),(37,186,'Tuesday','08:00:00','17:00:00'),(38,186,'Wednesday','08:00:00','17:00:00'),(39,186,'Thursday','08:00:00','17:00:00'),(40,186,'Friday','08:00:00','17:00:00'),(41,233,'Monday','08:00:00','17:00:00'),(42,233,'Tuesday','08:00:00','17:00:00'),(43,233,'Wednesday','08:00:00','17:00:00'),(44,233,'Thursday','08:00:00','17:00:00'),(45,233,'Friday','08:00:00','17:00:00'),(46,222,'Monday','08:00:00','17:00:00'),(47,222,'Tuesday','08:00:00','17:00:00'),(48,222,'Wednesday','08:00:00','17:00:00'),(49,222,'Thursday','08:00:00','17:00:00'),(50,222,'Friday','08:00:00','17:00:00'),(51,117,'Monday','08:00:00','17:00:00'),(52,117,'Tuesday','08:00:00','17:00:00'),(53,117,'Wednesday','08:00:00','17:00:00'),(54,117,'Thursday','08:00:00','17:00:00'),(55,117,'Friday','08:00:00','17:00:00'),(56,164,'Monday','08:00:00','17:00:00'),(57,164,'Tuesday','08:00:00','17:00:00'),(58,164,'Wednesday','08:00:00','17:00:00'),(59,164,'Thursday','08:00:00','17:00:00'),(60,164,'Friday','08:00:00','17:00:00'),(61,170,'Monday','08:00:00','17:00:00'),(62,170,'Tuesday','08:00:00','17:00:00'),(63,170,'Wednesday','08:00:00','17:00:00'),(64,170,'Thursday','08:00:00','17:00:00'),(65,170,'Friday','08:00:00','17:00:00'),(66,207,'Monday','08:00:00','17:00:00'),(67,207,'Tuesday','08:00:00','17:00:00'),(68,207,'Wednesday','08:00:00','17:00:00'),(69,207,'Thursday','08:00:00','17:00:00'),(70,207,'Friday','08:00:00','17:00:00'),(71,212,'Monday','08:00:00','17:00:00'),(72,212,'Tuesday','08:00:00','17:00:00'),(73,212,'Wednesday','08:00:00','17:00:00'),(74,212,'Thursday','08:00:00','17:00:00'),(75,212,'Friday','08:00:00','17:00:00'),(145,204,'Friday','05:00','17:00'),(144,204,'Thursday','05:00','17:00'),(143,204,'Wednesday','05:00','17:00'),(142,204,'Tuesday','05:00','17:00'),(141,204,'Monday','05:00','17:00'),(81,213,'Monday','08:00:00','17:00:00'),(82,213,'Tuesday','08:00:00','17:00:00'),(83,213,'Wednesday','08:00:00','17:00:00'),(84,213,'Thursday','08:00:00','17:00:00'),(85,213,'Friday','08:00:00','17:00:00'),(86,224,'Monday','08:00:00','17:00:00'),(87,224,'Tuesday','08:00:00','17:00:00'),(88,224,'Wednesday','08:00:00','17:00:00'),(89,224,'Thursday','08:00:00','17:00:00'),(90,224,'Friday','08:00:00','17:00:00'),(91,220,'Monday','08:00:00','17:00:00'),(92,220,'Tuesday','08:00:00','17:00:00'),(93,220,'Wednesday','08:00:00','17:00:00'),(94,220,'Thursday','08:00:00','17:00:00'),(95,220,'Friday','08:00:00','17:00:00'),(96,221,'Monday','08:00:00','17:00:00'),(97,221,'Tuesday','08:00:00','17:00:00'),(98,221,'Wednesday','08:00:00','17:00:00'),(99,221,'Thursday','08:00:00','17:00:00'),(100,221,'Friday','08:00:00','17:00:00'),(101,217,'Monday','08:00:00','17:00:00'),(102,217,'Tuesday','08:00:00','17:00:00'),(103,217,'Wednesday','08:00:00','17:00:00'),(104,217,'Thursday','08:00:00','17:00:00'),(105,217,'Friday','08:00:00','17:00:00'),(106,218,'Monday','08:00:00','17:00:00'),(107,218,'Tuesday','08:00:00','17:00:00'),(108,218,'Wednesday','08:00:00','17:00:00'),(109,218,'Thursday','08:00:00','17:00:00'),(110,218,'Friday','08:00:00','17:00:00'),(111,225,'Monday','08:00:00','17:00:00'),(112,225,'Tuesday','08:00:00','17:00:00'),(113,225,'Wednesday','08:00:00','17:00:00'),(114,225,'Thursday','08:00:00','17:00:00'),(115,225,'Friday','08:00:00','17:00:00'),(116,232,'Monday','08:00:00','17:00:00'),(117,232,'Tuesday','08:00:00','17:00:00'),(118,232,'Wednesday','08:00:00','17:00:00'),(119,232,'Thursday','08:00:00','17:00:00'),(120,232,'Friday','08:00:00','17:00:00'),(121,235,'Monday','08:00:00','17:00:00'),(122,235,'Tuesday','08:00:00','17:00:00'),(123,235,'Wednesday','08:00:00','17:00:00'),(124,235,'Thursday','08:00:00','17:00:00'),(125,235,'Friday','08:00:00','17:00:00'),(126,193,'Monday','08:00:00','17:00:00'),(127,193,'Tuesday','08:00:00','17:00:00'),(128,193,'Wednesday','08:00:00','17:00:00'),(129,193,'Thursday','08:00:00','17:00:00'),(130,193,'Friday','08:00:00','17:00:00'),(131,231,'Monday','08:00:00','17:00:00'),(132,231,'Tuesday','08:00:00','17:00:00'),(133,231,'Wednesday','08:00:00','17:00:00'),(134,231,'Thursday','08:00:00','17:00:00'),(135,231,'Friday','08:00:00','17:00:00'),(136,236,'Monday','08:00:00','17:00:00'),(137,236,'Tuesday','08:00:00','17:00:00'),(138,236,'Wednesday','08:00:00','17:00:00'),(139,236,'Thursday','08:00:00','17:00:00'),(140,236,'Friday','08:00:00','17:00:00'),(146,237,'Monday','08:00:00','17:00:00'),(147,237,'Tuesday','08:00:00','17:00:00'),(148,237,'Wednesday','08:00:00','17:00:00'),(149,237,'Thursday','08:00:00','17:00:00'),(150,237,'Friday','08:00:00','17:00:00'),(151,238,'Monday','08:00:00','17:00:00'),(152,238,'Tuesday','08:00:00','17:00:00'),(153,238,'Wednesday','08:00:00','17:00:00'),(154,238,'Thursday','08:00:00','17:00:00'),(155,238,'Friday','08:00:00','17:00:00'),(156,239,'Monday','08:00:00','17:00:00'),(157,239,'Tuesday','08:00:00','17:00:00'),(158,239,'Wednesday','08:00:00','17:00:00'),(159,239,'Thursday','08:00:00','17:00:00'),(160,239,'Friday','08:00:00','17:00:00'),(161,241,'Monday','08:00:00','17:00:00'),(162,241,'Tuesday','08:00:00','17:00:00'),(163,241,'Wednesday','08:00:00','17:00:00'),(164,241,'Thursday','08:00:00','17:00:00'),(165,241,'Friday','08:00:00','17:00:00'),(166,242,'Monday','08:00:00','17:00:00'),(167,242,'Tuesday','08:00:00','17:00:00'),(168,242,'Wednesday','08:00:00','17:00:00'),(169,242,'Thursday','08:00:00','17:00:00'),(170,242,'Friday','08:00:00','17:00:00'),(171,243,'Monday','08:00:00','17:00:00'),(172,243,'Tuesday','08:00:00','17:00:00'),(173,243,'Wednesday','08:00:00','17:00:00'),(174,243,'Thursday','08:00:00','17:00:00'),(175,243,'Friday','08:00:00','17:00:00'),(176,244,'Monday','08:00:00','17:00:00'),(177,244,'Tuesday','08:00:00','17:00:00'),(178,244,'Wednesday','08:00:00','17:00:00'),(179,244,'Thursday','08:00:00','17:00:00'),(180,244,'Friday','08:00:00','17:00:00'),(181,245,'Monday','08:00:00','17:00:00'),(182,245,'Tuesday','08:00:00','17:00:00'),(183,245,'Wednesday','08:00:00','17:00:00'),(184,245,'Thursday','08:00:00','17:00:00'),(185,245,'Friday','08:00:00','17:00:00'),(186,170,'Monday','08:00:00','17:00:00'),(187,170,'Tuesday','08:00:00','17:00:00'),(188,170,'Wednesday','08:00:00','17:00:00'),(189,170,'Thursday','08:00:00','17:00:00'),(190,170,'Friday','08:00:00','17:00:00'),(191,172,'Monday','08:00:00','17:00:00'),(192,172,'Tuesday','08:00:00','17:00:00'),(193,172,'Wednesday','08:00:00','17:00:00'),(194,172,'Thursday','08:00:00','17:00:00'),(195,172,'Friday','08:00:00','17:00:00'),(196,245,'Monday','08:00:00','17:00:00'),(197,245,'Tuesday','08:00:00','17:00:00'),(198,245,'Wednesday','08:00:00','17:00:00'),(199,245,'Thursday','08:00:00','17:00:00'),(200,245,'Friday','08:00:00','17:00:00'),(201,247,'Monday','08:00:00','17:00:00'),(202,247,'Tuesday','08:00:00','17:00:00'),(203,247,'Wednesday','08:00:00','17:00:00'),(204,247,'Thursday','08:00:00','17:00:00'),(205,247,'Friday','08:00:00','17:00:00'),(206,259,'Monday','08:00:00','17:00:00'),(207,259,'Tuesday','08:00:00','17:00:00'),(208,259,'Wednesday','08:00:00','17:00:00'),(209,259,'Thursday','08:00:00','17:00:00'),(210,259,'Friday','08:00:00','17:00:00'),(211,260,'Monday','08:00:00','17:00:00'),(212,260,'Tuesday','08:00:00','17:00:00'),(213,260,'Wednesday','08:00:00','17:00:00'),(214,260,'Thursday','08:00:00','17:00:00'),(215,260,'Friday','08:00:00','17:00:00'),(216,261,'Monday','08:00:00','17:00:00'),(217,261,'Tuesday','08:00:00','17:00:00'),(218,261,'Wednesday','08:00:00','17:00:00'),(219,261,'Thursday','08:00:00','17:00:00'),(220,261,'Friday','08:00:00','17:00:00'),(221,262,'Monday','08:00:00','17:00:00'),(222,262,'Tuesday','08:00:00','17:00:00'),(223,262,'Wednesday','08:00:00','17:00:00'),(224,262,'Thursday','08:00:00','17:00:00'),(225,262,'Friday','08:00:00','17:00:00'),(226,263,'Monday','08:00:00','17:00:00'),(227,263,'Tuesday','08:00:00','17:00:00'),(228,263,'Wednesday','08:00:00','17:00:00'),(229,263,'Thursday','08:00:00','17:00:00'),(230,263,'Friday','08:00:00','17:00:00'),(231,264,'Monday','08:00:00','17:00:00'),(232,264,'Tuesday','08:00:00','17:00:00'),(233,264,'Wednesday','08:00:00','17:00:00'),(234,264,'Thursday','08:00:00','17:00:00'),(235,264,'Friday','08:00:00','17:00:00'),(236,265,'Monday','08:00:00','17:00:00'),(237,265,'Tuesday','08:00:00','17:00:00'),(238,265,'Wednesday','08:00:00','17:00:00'),(239,265,'Thursday','08:00:00','17:00:00'),(240,265,'Friday','08:00:00','17:00:00'),(241,266,'Monday','08:00:00','17:00:00'),(242,266,'Tuesday','08:00:00','17:00:00'),(243,266,'Wednesday','08:00:00','17:00:00'),(244,266,'Thursday','08:00:00','17:00:00'),(245,266,'Friday','08:00:00','17:00:00'),(246,267,'Monday','08:00:00','17:00:00'),(247,267,'Tuesday','08:00:00','17:00:00'),(248,267,'Wednesday','08:00:00','17:00:00'),(249,267,'Thursday','08:00:00','17:00:00'),(250,267,'Friday','08:00:00','17:00:00'),(251,268,'Monday','08:00:00','17:00:00'),(252,268,'Tuesday','08:00:00','17:00:00'),(253,268,'Wednesday','08:00:00','17:00:00'),(254,268,'Thursday','08:00:00','17:00:00'),(255,268,'Friday','08:00:00','17:00:00'),(256,268,'Monday','08:00:00','17:00:00'),(257,268,'Tuesday','08:00:00','17:00:00'),(258,268,'Wednesday','08:00:00','17:00:00'),(259,268,'Thursday','08:00:00','17:00:00'),(260,268,'Friday','08:00:00','17:00:00'),(261,269,'Monday','08:00:00','17:00:00'),(262,269,'Tuesday','08:00:00','17:00:00'),(263,269,'Wednesday','08:00:00','17:00:00'),(264,269,'Thursday','08:00:00','17:00:00'),(265,269,'Friday','08:00:00','17:00:00'),(266,270,'Monday','08:00:00','17:00:00'),(267,270,'Tuesday','08:00:00','17:00:00'),(268,270,'Wednesday','08:00:00','17:00:00'),(269,270,'Thursday','08:00:00','17:00:00'),(270,270,'Friday','08:00:00','17:00:00'),(271,271,'Monday','08:00:00','17:00:00'),(272,271,'Tuesday','08:00:00','17:00:00'),(273,271,'Wednesday','08:00:00','17:00:00'),(274,271,'Thursday','08:00:00','17:00:00'),(275,271,'Friday','08:00:00','17:00:00'),(276,272,'Monday','08:00:00','17:00:00'),(277,272,'Tuesday','08:00:00','17:00:00'),(278,272,'Wednesday','08:00:00','17:00:00'),(279,272,'Thursday','08:00:00','17:00:00'),(280,272,'Friday','08:00:00','17:00:00'),(281,273,'Monday','08:00:00','17:00:00'),(282,273,'Tuesday','08:00:00','17:00:00'),(283,273,'Wednesday','08:00:00','17:00:00'),(284,273,'Thursday','08:00:00','17:00:00'),(285,273,'Friday','08:00:00','17:00:00'),(286,274,'Monday','08:00:00','17:00:00'),(287,274,'Tuesday','08:00:00','17:00:00'),(288,274,'Wednesday','08:00:00','17:00:00'),(289,274,'Thursday','08:00:00','17:00:00'),(290,274,'Friday','08:00:00','17:00:00'),(291,275,'Monday','08:00:00','17:00:00'),(292,275,'Tuesday','08:00:00','17:00:00'),(293,275,'Wednesday','08:00:00','17:00:00'),(294,275,'Thursday','08:00:00','17:00:00'),(295,275,'Friday','08:00:00','17:00:00'),(296,275,'Monday','08:00:00','17:00:00'),(297,275,'Tuesday','08:00:00','17:00:00'),(298,275,'Wednesday','08:00:00','17:00:00'),(299,275,'Thursday','08:00:00','17:00:00'),(300,275,'Friday','08:00:00','17:00:00'),(301,275,'Monday','08:00:00','17:00:00'),(302,275,'Tuesday','08:00:00','17:00:00'),(303,275,'Wednesday','08:00:00','17:00:00'),(304,275,'Thursday','08:00:00','17:00:00'),(305,275,'Friday','08:00:00','17:00:00'),(306,276,'Monday','08:00:00','17:00:00'),(307,276,'Tuesday','08:00:00','17:00:00'),(308,276,'Wednesday','08:00:00','17:00:00'),(309,276,'Thursday','08:00:00','17:00:00'),(310,276,'Friday','08:00:00','17:00:00'),(311,277,'Monday','08:00:00','17:00:00'),(312,277,'Tuesday','08:00:00','17:00:00'),(313,277,'Wednesday','08:00:00','17:00:00'),(314,277,'Thursday','08:00:00','17:00:00'),(315,277,'Friday','08:00:00','17:00:00'),(316,278,'Monday','08:00:00','17:00:00'),(317,278,'Tuesday','08:00:00','17:00:00'),(318,278,'Wednesday','08:00:00','17:00:00'),(319,278,'Thursday','08:00:00','17:00:00'),(320,278,'Friday','08:00:00','17:00:00'),(321,279,'Monday','08:00:00','17:00:00'),(322,279,'Tuesday','08:00:00','17:00:00'),(323,279,'Wednesday','08:00:00','17:00:00'),(324,279,'Thursday','08:00:00','17:00:00'),(325,279,'Friday','08:00:00','17:00:00'),(326,280,'Monday','08:00:00','17:00:00'),(327,280,'Tuesday','08:00:00','17:00:00'),(328,280,'Wednesday','08:00:00','17:00:00'),(329,280,'Thursday','08:00:00','17:00:00'),(330,280,'Friday','08:00:00','17:00:00'),(331,281,'Monday','08:00:00','17:00:00'),(332,281,'Tuesday','08:00:00','17:00:00'),(333,281,'Wednesday','08:00:00','17:00:00'),(334,281,'Thursday','08:00:00','17:00:00'),(335,281,'Friday','08:00:00','17:00:00'),(336,282,'Monday','08:00:00','17:00:00'),(337,282,'Tuesday','08:00:00','17:00:00'),(338,282,'Wednesday','08:00:00','17:00:00'),(339,282,'Thursday','08:00:00','17:00:00'),(340,282,'Friday','08:00:00','17:00:00'),(341,283,'Monday','08:00:00','17:00:00'),(342,283,'Tuesday','08:00:00','17:00:00'),(343,283,'Wednesday','08:00:00','17:00:00'),(344,283,'Thursday','08:00:00','17:00:00'),(345,283,'Friday','08:00:00','17:00:00'),(346,284,'Monday','08:00:00','17:00:00'),(347,284,'Tuesday','08:00:00','17:00:00'),(348,284,'Wednesday','08:00:00','17:00:00'),(349,284,'Thursday','08:00:00','17:00:00'),(350,284,'Friday','08:00:00','17:00:00'),(351,285,'Monday','08:00:00','17:00:00'),(352,285,'Tuesday','08:00:00','17:00:00'),(353,285,'Wednesday','08:00:00','17:00:00'),(354,285,'Thursday','08:00:00','17:00:00'),(355,285,'Friday','08:00:00','17:00:00'),(356,286,'Monday','08:00:00','17:00:00'),(357,286,'Tuesday','08:00:00','17:00:00'),(358,286,'Wednesday','08:00:00','17:00:00'),(359,286,'Thursday','08:00:00','17:00:00'),(360,286,'Friday','08:00:00','17:00:00'),(361,287,'Monday','08:00:00','17:00:00'),(362,287,'Tuesday','08:00:00','17:00:00'),(363,287,'Wednesday','08:00:00','17:00:00'),(364,287,'Thursday','08:00:00','17:00:00'),(365,287,'Friday','08:00:00','17:00:00'),(366,288,'Monday','08:00:00','17:00:00'),(367,288,'Tuesday','08:00:00','17:00:00'),(368,288,'Wednesday','08:00:00','17:00:00'),(369,288,'Thursday','08:00:00','17:00:00'),(370,288,'Friday','08:00:00','17:00:00'),(371,289,'Monday','08:00:00','17:00:00'),(372,289,'Tuesday','08:00:00','17:00:00'),(373,289,'Wednesday','08:00:00','17:00:00'),(374,289,'Thursday','08:00:00','17:00:00'),(375,289,'Friday','08:00:00','17:00:00'),(376,290,'Monday','08:00:00','17:00:00'),(377,290,'Tuesday','08:00:00','17:00:00'),(378,290,'Wednesday','08:00:00','17:00:00'),(379,290,'Thursday','08:00:00','17:00:00'),(380,290,'Friday','08:00:00','17:00:00'),(381,291,'Monday','08:00:00','17:00:00'),(382,291,'Tuesday','08:00:00','17:00:00'),(383,291,'Wednesday','08:00:00','17:00:00'),(384,291,'Thursday','08:00:00','17:00:00'),(385,291,'Friday','08:00:00','17:00:00'),(386,292,'Monday','08:00:00','17:00:00'),(387,292,'Tuesday','08:00:00','17:00:00'),(388,292,'Wednesday','08:00:00','17:00:00'),(389,292,'Thursday','08:00:00','17:00:00'),(390,292,'Friday','08:00:00','17:00:00'),(391,293,'Monday','08:00:00','17:00:00'),(392,293,'Tuesday','08:00:00','17:00:00'),(393,293,'Wednesday','08:00:00','17:00:00'),(394,293,'Thursday','08:00:00','17:00:00'),(395,293,'Friday','08:00:00','17:00:00'),(396,294,'Monday','08:00:00','17:00:00'),(397,294,'Tuesday','08:00:00','17:00:00'),(398,294,'Wednesday','08:00:00','17:00:00'),(399,294,'Thursday','08:00:00','17:00:00'),(400,294,'Friday','08:00:00','17:00:00'),(401,295,'Monday','08:00:00','17:00:00'),(402,295,'Tuesday','08:00:00','17:00:00'),(403,295,'Wednesday','08:00:00','17:00:00'),(404,295,'Thursday','08:00:00','17:00:00'),(405,295,'Friday','08:00:00','17:00:00'),(406,296,'Monday','08:00:00','17:00:00'),(407,296,'Tuesday','08:00:00','17:00:00'),(408,296,'Wednesday','08:00:00','17:00:00'),(409,296,'Thursday','08:00:00','17:00:00'),(410,296,'Friday','08:00:00','17:00:00'),(411,297,'Monday','08:00:00','17:00:00'),(412,297,'Tuesday','08:00:00','17:00:00'),(413,297,'Wednesday','08:00:00','17:00:00'),(414,297,'Thursday','08:00:00','17:00:00'),(415,297,'Friday','08:00:00','17:00:00'),(416,298,'Monday','08:00:00','17:00:00'),(417,298,'Tuesday','08:00:00','17:00:00'),(418,298,'Wednesday','08:00:00','17:00:00'),(419,298,'Thursday','08:00:00','17:00:00'),(420,298,'Friday','08:00:00','17:00:00'),(421,299,'Monday','08:00:00','17:00:00'),(422,299,'Tuesday','08:00:00','17:00:00'),(423,299,'Wednesday','08:00:00','17:00:00'),(424,299,'Thursday','08:00:00','17:00:00'),(425,299,'Friday','08:00:00','17:00:00'),(426,300,'Monday','08:00:00','17:00:00'),(427,300,'Tuesday','08:00:00','17:00:00'),(428,300,'Wednesday','08:00:00','17:00:00'),(429,300,'Thursday','08:00:00','17:00:00'),(430,300,'Friday','08:00:00','17:00:00'),(431,301,'Monday','08:00:00','17:00:00'),(432,301,'Tuesday','08:00:00','17:00:00'),(433,301,'Wednesday','08:00:00','17:00:00'),(434,301,'Thursday','08:00:00','17:00:00'),(435,301,'Friday','08:00:00','17:00:00'),(436,302,'Monday','08:00:00','17:00:00'),(437,302,'Tuesday','08:00:00','17:00:00'),(438,302,'Wednesday','08:00:00','17:00:00'),(439,302,'Thursday','08:00:00','17:00:00'),(440,302,'Friday','08:00:00','17:00:00'),(441,303,'Monday','08:00:00','17:00:00'),(442,303,'Tuesday','08:00:00','17:00:00'),(443,303,'Wednesday','08:00:00','17:00:00'),(444,303,'Thursday','08:00:00','17:00:00'),(445,303,'Friday','08:00:00','17:00:00'),(446,304,'Monday','08:00:00','17:00:00'),(447,304,'Tuesday','08:00:00','17:00:00'),(448,304,'Wednesday','08:00:00','17:00:00'),(449,304,'Thursday','08:00:00','17:00:00'),(450,304,'Friday','08:00:00','17:00:00'),(451,305,'Monday','08:00:00','17:00:00'),(452,305,'Tuesday','08:00:00','17:00:00'),(453,305,'Wednesday','08:00:00','17:00:00'),(454,305,'Thursday','08:00:00','17:00:00'),(455,305,'Friday','08:00:00','17:00:00'),(456,306,'Monday','08:00:00','17:00:00'),(457,306,'Tuesday','08:00:00','17:00:00'),(458,306,'Wednesday','08:00:00','17:00:00'),(459,306,'Thursday','08:00:00','17:00:00'),(460,306,'Friday','08:00:00','17:00:00'),(461,307,'Monday','08:00:00','17:00:00'),(462,307,'Tuesday','08:00:00','17:00:00'),(463,307,'Wednesday','08:00:00','17:00:00'),(464,307,'Thursday','08:00:00','17:00:00'),(465,307,'Friday','08:00:00','17:00:00'),(466,308,'Monday','08:00:00','17:00:00'),(467,308,'Tuesday','08:00:00','17:00:00'),(468,308,'Wednesday','08:00:00','17:00:00'),(469,308,'Thursday','08:00:00','17:00:00'),(470,308,'Friday','08:00:00','17:00:00'),(471,309,'Monday','08:00:00','17:00:00'),(472,309,'Tuesday','08:00:00','17:00:00'),(473,309,'Wednesday','08:00:00','17:00:00'),(474,309,'Thursday','08:00:00','17:00:00'),(475,309,'Friday','08:00:00','17:00:00'),(476,311,'Monday','08:00:00','17:00:00'),(477,311,'Tuesday','08:00:00','17:00:00'),(478,311,'Wednesday','08:00:00','17:00:00'),(479,311,'Thursday','08:00:00','17:00:00'),(480,311,'Friday','08:00:00','17:00:00'),(481,312,'Monday','08:00:00','17:00:00'),(482,312,'Tuesday','08:00:00','17:00:00'),(483,312,'Wednesday','08:00:00','17:00:00'),(484,312,'Thursday','08:00:00','17:00:00'),(485,312,'Friday','08:00:00','17:00:00'),(486,313,'Monday','08:00:00','17:00:00'),(487,313,'Tuesday','08:00:00','17:00:00'),(488,313,'Wednesday','08:00:00','17:00:00'),(489,313,'Thursday','08:00:00','17:00:00'),(490,313,'Friday','08:00:00','17:00:00'),(491,314,'Monday','08:00:00','17:00:00'),(492,314,'Tuesday','08:00:00','17:00:00'),(493,314,'Wednesday','08:00:00','17:00:00'),(494,314,'Thursday','08:00:00','17:00:00'),(495,314,'Friday','08:00:00','17:00:00'),(496,315,'Monday','08:00:00','17:00:00'),(497,315,'Tuesday','08:00:00','17:00:00'),(498,315,'Wednesday','08:00:00','17:00:00'),(499,315,'Thursday','08:00:00','17:00:00'),(500,315,'Friday','08:00:00','17:00:00'),(501,316,'Monday','08:00:00','17:00:00'),(502,316,'Tuesday','08:00:00','17:00:00'),(503,316,'Wednesday','08:00:00','17:00:00'),(504,316,'Thursday','08:00:00','17:00:00'),(505,316,'Friday','08:00:00','17:00:00'),(506,317,'Monday','08:00:00','17:00:00'),(507,317,'Tuesday','08:00:00','17:00:00'),(508,317,'Wednesday','08:00:00','17:00:00'),(509,317,'Thursday','08:00:00','17:00:00'),(510,317,'Friday','08:00:00','17:00:00'),(511,318,'Monday','08:00:00','17:00:00'),(512,318,'Tuesday','08:00:00','17:00:00'),(513,318,'Wednesday','08:00:00','17:00:00'),(514,318,'Thursday','08:00:00','17:00:00'),(515,318,'Friday','08:00:00','17:00:00'),(516,319,'Monday','08:00:00','17:00:00'),(517,319,'Tuesday','08:00:00','17:00:00'),(518,319,'Wednesday','08:00:00','17:00:00'),(519,319,'Thursday','08:00:00','17:00:00'),(520,319,'Friday','08:00:00','17:00:00'),(521,320,'Monday','08:00:00','17:00:00'),(522,320,'Tuesday','08:00:00','17:00:00'),(523,320,'Wednesday','08:00:00','17:00:00'),(524,320,'Thursday','08:00:00','17:00:00'),(525,320,'Friday','08:00:00','17:00:00'),(526,321,'Monday','08:00:00','17:00:00'),(527,321,'Tuesday','08:00:00','17:00:00'),(528,321,'Wednesday','08:00:00','17:00:00'),(529,321,'Thursday','08:00:00','17:00:00'),(530,321,'Friday','08:00:00','17:00:00'),(531,322,'Monday','08:00:00','17:00:00'),(532,322,'Tuesday','08:00:00','17:00:00'),(533,322,'Wednesday','08:00:00','17:00:00'),(534,322,'Thursday','08:00:00','17:00:00'),(535,322,'Friday','08:00:00','17:00:00'),(536,323,'Monday','08:00:00','17:00:00'),(537,323,'Tuesday','08:00:00','17:00:00'),(538,323,'Wednesday','08:00:00','17:00:00'),(539,323,'Thursday','08:00:00','17:00:00'),(540,323,'Friday','08:00:00','17:00:00'),(541,324,'Monday','08:00:00','17:00:00'),(542,324,'Tuesday','08:00:00','17:00:00'),(543,324,'Wednesday','08:00:00','17:00:00'),(544,324,'Thursday','08:00:00','17:00:00'),(545,324,'Friday','08:00:00','17:00:00'),(546,325,'Monday','08:00:00','17:00:00'),(547,325,'Tuesday','08:00:00','17:00:00'),(548,325,'Wednesday','08:00:00','17:00:00'),(549,325,'Thursday','08:00:00','17:00:00'),(550,325,'Friday','08:00:00','17:00:00');
/*!40000 ALTER TABLE `schedule_balances` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-10-23 11:08:54
