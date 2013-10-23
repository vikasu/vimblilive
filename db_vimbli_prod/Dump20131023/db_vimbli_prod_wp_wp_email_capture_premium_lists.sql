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
-- Table structure for table `wp_wp_email_capture_premium_lists`
--

DROP TABLE IF EXISTS `wp_wp_email_capture_premium_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_wp_email_capture_premium_lists` (
  `listid` int(255) NOT NULL AUTO_INCREMENT,
  `listname` varchar(255) NOT NULL,
  `signupurl` mediumtext,
  `confirmurl` mediumtext,
  `listownername` varchar(255) DEFAULT NULL,
  `listownermail` varchar(255) DEFAULT NULL,
  `listsubject` varchar(255) DEFAULT NULL,
  `listemail` mediumtext,
  `listsignature` mediumtext,
  `listarsubject` varchar(255) DEFAULT NULL,
  `listredirecttype` varchar(255) DEFAULT 'same',
  `listredirecturl` varchar(255) DEFAULT NULL,
  `listautorespond` mediumtext,
  `listtype` int(255) NOT NULL DEFAULT '1',
  `listcode` mediumtext NOT NULL,
  `listerror1` varchar(255) NOT NULL DEFAULT 'Email Address Already Present',
  `listerror2` varchar(255) NOT NULL DEFAULT 'Not A Valid Email',
  `listerror3` varchar(255) NOT NULL DEFAULT 'Email Unable To Be Sent',
  `listerror4` varchar(255) NOT NULL DEFAULT 'Wrong Confirmation Code',
  `listerror5` varchar(255) NOT NULL DEFAULT 'Name is a required field',
  `defaultsubmittext` varchar(255) NOT NULL DEFAULT 'Subscribe',
  `namefield` varchar(255) NOT NULL DEFAULT 'Name',
  `requirednamefield` int(255) DEFAULT '0',
  `hidename` int(255) DEFAULT '0',
  PRIMARY KEY (`listid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_wp_email_capture_premium_lists`
--

LOCK TABLES `wp_wp_email_capture_premium_lists` WRITE;
/*!40000 ALTER TABLE `wp_wp_email_capture_premium_lists` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_wp_email_capture_premium_lists` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-10-23 11:11:59
