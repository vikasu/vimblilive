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
-- Table structure for table `thoughts`
--

DROP TABLE IF EXISTS `thoughts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `thoughts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `thought_of_day` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '''1''=>''activate'', ''0''=>''deactivate''',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `thoughts`
--

LOCK TABLES `thoughts` WRITE;
/*!40000 ALTER TABLE `thoughts` DISABLE KEYS */;
INSERT INTO `thoughts` VALUES (6,'Today is all we have, tomorrow is a mirage that may never become reality. Louis L\'Amour',0,'2013-09-16 06:04:07','2013-10-23 01:47:04'),(8,'He never knew when he was whipped ... So he never was ... Louis L\'Amour',0,'2013-09-16 06:29:44','2013-10-23 01:50:09'),(10,'The more one learns, the more he understands his ignorance. Louis L\'Amour',0,'2013-09-20 09:46:07','2013-10-23 01:53:30'),(43,'A book is less important for what it says than for what it makes you think. Louis L\'Amour',0,'2013-10-08 05:15:28','2013-10-23 01:54:06'),(41,'Success is not final, failure is not fatal: it is the courage to continue that counts. Winston Ch',0,'2013-10-07 12:02:31','2013-10-23 02:00:44'),(42,'If you are going through hell, keep going.  Winston Churchill',0,'2013-10-08 05:15:08','2013-10-23 02:02:08'),(44,'Success is stumbling from failure to failure with no loss of enthusiasm. Winston Churchill',0,'2013-10-08 05:15:51','2013-10-23 02:02:55'),(45,'The price of greatness is responsibility. Winston Churchill',0,'2013-10-08 05:16:44','2013-10-23 02:04:39'),(46,'It is not enough that we do our best; sometimes we must do what is required. Winston Churchill',0,'2013-10-08 05:17:33','2013-10-23 02:03:32'),(47,'. . . What do you wish to be? What would you like to become? Louis L\'Amour',0,'2013-10-08 05:20:01','2013-10-23 01:48:20'),(49,'No one can \"get\" an education, for of necessity education is a continuing process. Louis L\'Amour',1,'2013-10-23 01:45:15','2013-10-23 01:45:30'),(50,'To improve is to change; to be perfect is to change often. Winston Churchill',0,'2013-10-23 02:06:24','2013-10-23 02:06:24');
/*!40000 ALTER TABLE `thoughts` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-10-23 11:23:23
