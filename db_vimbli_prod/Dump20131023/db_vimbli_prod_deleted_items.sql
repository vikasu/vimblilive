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
-- Table structure for table `deleted_items`
--

DROP TABLE IF EXISTS `deleted_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deleted_items` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `item_id` varchar(100) NOT NULL,
  `item_type` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deleted_items`
--

LOCK TABLES `deleted_items` WRITE;
/*!40000 ALTER TABLE `deleted_items` DISABLE KEYS */;
INSERT INTO `deleted_items` VALUES (1,178,'<937a7b4bbda6ddd506679afda1913abf@smartdatainc.net>','email'),(2,178,'0qcbr3fciabmepk5lt42o6lkug','calendar'),(3,178,'<360be71db2acd69fffcadca7eea9952a@smartdatainc.net>','email'),(4,178,'7hjtkcc64ut1592gbvmg4a3vng','calendar'),(5,193,'<1798578610.10061064.1370345873072.JavaMail.app@ela4-app3321.prod>','email'),(6,193,'<51adc8c5.e83f310a.1835.4fd7SMTPIN_ADDED_BROKEN@mx.google.com>','email'),(7,193,'<51adc8c3.476ae00a.1d67.55aaSMTPIN_ADDED_BROKEN@mx.google.com>','email'),(8,193,'<13090181410.1370322563802@dc1.prod>','email'),(9,193,'<556913196.627941370302835249.JavaMail.jboss@esproximityval-prd-01.24hourfit.com>','email'),(10,193,'<13085952358.1370288853673@dc1.prod>','email'),(11,193,'6g4mgj0do813shnpchv7fh41lg','calendar'),(12,193,'<CAOMKxUTzH-jVV0_NGozEvqNUg6rzO-YcKGo_0OmC5X5RkqufdQ@mail.gmail.com>','email'),(13,193,'6klnvvqcsenlmdk68do35f6rqk_20130603T153000Z','calendar'),(14,193,'g8qvr5l4p54517crdtqbl8e6r4_20130603T043000Z','calendar'),(15,193,'<51ac7745.46dbe00a.3407.fffffbe4SMTPIN_ADDED_BROKEN@mx.google.com>','email'),(16,193,'ghrdp5i9dobb1k1f53grp5oq3g_20130603T133000Z','calendar'),(17,193,'<51ac7743.6686310a.19d4.ffffc57dSMTPIN_ADDED_BROKEN@mx.google.com>','email'),(18,238,'14622','calendar'),(19,238,'14695','calendar'),(20,172,'14620','calendar'),(21,172,'14696','calendar'),(22,237,'<51d00fc6.491ce00a.4a7f.ffff80cdSMTPIN_ADDED_BROKEN@mx.google.com>','email'),(23,237,'<51cac9c5.0608e00a.5287.0c59SMTPIN_ADDED_BROKEN@mx.google.com>','email'),(24,172,'184','reflection'),(25,172,'157','reflection'),(26,172,'118','reflection'),(27,172,'fd7uhu4b7v3mbkj7s84s2v248s','calendar'),(28,237,'lcc5fvso3oiccav2i7du2n8v8c_20130729T070000Z','calendar'),(29,172,'<0.0.0.D25.1CEA8FC6B2899B2.0@omp.news.united.com>','email'),(30,172,'<A8.3E.07557.75376225@spruce-goose.twitter.com>','email'),(31,172,'<20130912105347468049.144298@mx.l2.cooleremail.net>','email');
/*!40000 ALTER TABLE `deleted_items` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-10-23 11:11:35
