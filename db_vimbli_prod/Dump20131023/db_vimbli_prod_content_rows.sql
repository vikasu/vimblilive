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
-- Table structure for table `content_rows`
--

DROP TABLE IF EXISTS `content_rows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `content_rows` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content_image` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `content_rows`
--

LOCK TABLES `content_rows` WRITE;
/*!40000 ALTER TABLE `content_rows` DISABLE KEYS */;
INSERT INTO `content_rows` VALUES (4,'goalsetting.png','http://wp.me/P3AAlx-7e','Create a personal plan for your transition! Improve your chance on success by 40% ...','1','2013-09-06 09:23:59','2013-10-08 22:03:44'),(15,'sponsorship.png','http://wp.me/P3AAlx-7g','Enter into a sponsorship agreement with a trusted adviser.  Add another 30% to the probability of a successful outcome for you ...','1','2013-09-16 08:00:15','2013-10-08 22:18:30'),(8,'share.png','http://wp.me/P3AAlx-7g','Communicate progress regularly, and with facts.  Drive home another 10% increase in your chance to achieve your goal ...','1','2013-09-06 09:35:46','2013-10-08 22:13:24');
/*!40000 ALTER TABLE `content_rows` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-10-23 11:21:19
