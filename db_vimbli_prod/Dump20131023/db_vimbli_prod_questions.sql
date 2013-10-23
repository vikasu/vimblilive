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
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `manager_id` int(11) DEFAULT NULL,
  `question` text,
  `frequency` enum('0','1') NOT NULL DEFAULT '0' COMMENT '''0=>Random'',''1=>Always Ask''',
  `rating_strength` enum('3','5') NOT NULL DEFAULT '3',
  `answer` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (1,0,'Are you clear on work expectations?','0','3','','0',NULL,NULL),(2,204,'Do you have everything to do your job right?','0','3','','1',NULL,'2013-06-19 20:23:50'),(3,204,'Are you doing what you do best often?','0','3','','1',NULL,'2013-08-19 17:49:42'),(6,0,'Does someone at work know you as a person?','0','3','','1',NULL,NULL),(7,0,'Is your development supported at work?','0','3','','0',NULL,NULL),(8,0,'Do your opinions count at work?','0','3','','0',NULL,'2013-09-12 20:53:51'),(9,0,'Is the company purpose important?','0','3','','0',NULL,NULL),(10,0,'Are your colleagues committed to high standards and service?','0','3','','0',NULL,NULL),(11,0,'Do you have a close friend(s) at work?','0','3','','0',NULL,NULL),(12,0,'When have you last discussed your progress with your sponsor?','0','3','','0',NULL,NULL),(13,0,'Do you have opportunities at work to learn and grow?','','3','','0',NULL,'2013-09-12 20:54:24'),(21,80,'I am excited about the course','1','3','','1','2013-02-16 16:55:44','2013-02-16 16:55:44'),(22,80,'I am adding value to the other course participants (class, blackboard, projects)','1','3','','1','2013-02-16 16:56:18','2013-02-16 16:56:18'),(23,80,'Course content supports the learning objectives','0','3','','1','2013-02-16 16:56:44','2013-02-16 16:56:44'),(24,80,'The instructor gives helpful feedback','0','3','','1','2013-02-16 16:57:21','2013-02-16 16:57:21'),(26,92,'How did you use your time today?','0','3','','1','2013-02-19 17:54:34','2013-03-22 13:44:59'),(27,92,'How well did you care of the people in your life today?','0','3','','1','2013-02-19 17:55:15','2013-03-22 13:44:46'),(30,92,'Have you created (and used!) opportunities to ask for help or support today?','0','3','','1','2013-03-22 13:48:21','2013-03-22 13:48:21'),(31,201,'How well did you support the people around you today?','0','3','','1','2013-06-07 21:04:25','2013-06-07 21:04:25'),(32,201,'How well did you take care of yourself today?','0','3','','1','2013-06-07 21:04:49','2013-06-07 21:06:52'),(33,201,'How well did you use your opportunities today?','0','3','','1','2013-06-07 21:05:59','2013-06-07 21:05:59'),(34,201,'How much did you smile today?','0','3','','1','2013-06-07 21:06:12','2013-06-07 21:06:12'),(35,201,'How much have you been yourself today?','0','3','','1','2013-06-07 21:07:46','2013-06-07 21:07:46'),(36,201,'How much have you been in the moment today?','0','3','','1','2013-06-07 21:08:24','2013-06-07 21:08:24'),(37,204,'How much joy have you created in the world?','0','3','','1','2013-06-10 20:45:03','2013-08-23 21:33:02'),(38,204,'How many people have you helped? (including yourself)','0','3','','1','2013-06-10 20:45:37','2013-08-19 17:51:04'),(39,204,'How much are you living in the moment?','0','3','','1','2013-06-10 20:46:11','2013-08-19 17:51:38'),(40,204,'How many actions have you taken towards your future?','0','3','','1','2013-06-10 20:47:52','2013-06-10 20:47:52'),(41,204,'How much have you learned about yourself recently?','0','3','','1','2013-06-10 20:48:37','2013-08-19 17:52:03'),(42,204,'How much have you learned about others recently?','0','3','','1','2013-06-10 20:48:58','2013-08-19 17:52:17'),(43,204,'How are your regular actions and interactions helping you towards where you want to be 5, 10, 15 years from now?','0','3','','1','2013-08-19 17:53:41','2013-08-19 17:53:41'),(44,204,'How have excuses impacted your performance (and relationships) recently?','0','3','','1','2013-08-19 17:55:23','2013-08-19 17:55:23'),(45,204,'How have the people around you impacted your journey recently?','0','3','','1','2013-08-19 17:56:51','2013-08-19 17:56:51');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-10-23 11:08:07
