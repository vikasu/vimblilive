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
-- Table structure for table `carousel_details`
--

DROP TABLE IF EXISTS `carousel_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carousel_details` (
  `id` int(121) NOT NULL AUTO_INCREMENT,
  `carousel_title` varchar(255) NOT NULL,
  `carousel_description` text NOT NULL,
  `carousel_image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carousel_details`
--

LOCK TABLES `carousel_details` WRITE;
/*!40000 ALTER TABLE `carousel_details` DISABLE KEYS */;
INSERT INTO `carousel_details` VALUES (37,'Congrats on Your New Opportunity ...','You have worked hard for the opportunity.         \r\nUse Vimbli to make the most of every day ...','slide-4.jpg',1),(44,'GET YOUR SPONSORS & HELPERS TO WORK','Hard work spotlights the character of people: some turn up their sleeves, some turn up their noses, and some don\'t turn up at all.','slide-5.jpg',0),(43,'STRETCH TO REACH YOUR GOAL','Perseverance is the hard work you do after you get tired of doing the hard work you already did.','slide-6.jpg',0),(42,'There are no secrets to success','Dictionary is the only place that success comes before work. Hard work is the price we must pay for success. I think you can accomplish anything if you\'re willing to pay the price.','slide-7.jpg',0),(49,'GET YOUR SPONSORS & HELPERS TO WORK','Hard work spotlights the character of people: some turn up their sleeves, some turn up their noses, and some don\'t turn up at all.','slide1374131804.jpg',0),(50,'LEARN BY DOING','Perseverance is the hard work you do after you get tired of doing the hard work you already did.','slide1374131819.jpg',0);
/*!40000 ALTER TABLE `carousel_details` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-10-23 11:12:22
