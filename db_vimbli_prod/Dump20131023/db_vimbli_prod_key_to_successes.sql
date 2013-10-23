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
-- Table structure for table `key_to_successes`
--

DROP TABLE IF EXISTS `key_to_successes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `key_to_successes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mission_id` int(11) DEFAULT NULL,
  `description` text,
  `expected_hrs` varchar(100) DEFAULT NULL,
  `period` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `ranking` text,
  `sign_off_status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '''0''=>''Not signed off'' & ''1''=>''Signed off''',
  `progress_k2s` int(100) NOT NULL,
  `calculated_hrs` float DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=955 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `key_to_successes`
--

LOCK TABLES `key_to_successes` WRITE;
/*!40000 ALTER TABLE `key_to_successes` DISABLE KEYS */;
INSERT INTO `key_to_successes` VALUES (201,20,'Sleep','70',0,'2013-02-07','2013-02-16','Sleep','0',0,NULL,NULL),(193,18,'Sleep','80',0,'2013-02-08','2013-02-28','Sleep','0',0,NULL,NULL),(86,1,'keyDes1','30',1,'2013-02-01','2013-02-10','Run, Play, #Sleep','0',0,NULL,NULL),(87,2,'Plan','20',0,'2013-01-20','2013-02-08','#TECPLAN, BRAINSTORM','0',0,NULL,NULL),(88,2,'Do','20',0,'2013-01-28','2013-02-08','#DO','0',0,NULL,NULL),(89,3,'Test 1','30',0,'2013-02-04','2013-02-08','#TEC','0',60,NULL,NULL),(90,4,'Test 1','20',0,'2013-02-01','2013-02-15','#TEC','1',0,NULL,NULL),(96,5,'Meet my team','10',0,'2013-01-20','2013-02-08','#team','0',0,NULL,NULL),(95,5,'Write White Paper','30',0,'2013-01-28','2013-02-23','#WP','0',0,NULL,NULL),(94,5,'Attend Meetings','100',0,'2013-01-20','2013-02-23','#MTG','0',0,NULL,NULL),(97,6,'K2S 1','100',0,'2013-02-03','2013-02-15','#BS','0',0,NULL,NULL),(98,7,'TEST 1 ... ','10',2,'2013-02-01','2013-02-10','#TEST','0',0,NULL,NULL),(99,7,'Watch 1 ...','10',2,'2013-02-01','2013-02-10','#Watch','0',0,NULL,NULL),(100,7,'Calc for random term','10',2,'2013-02-01','2013-02-10','#TRX','0',0,NULL,NULL),(155,8,'Rest','56',0,'2013-02-01','2013-02-07','Sleep','0',0,NULL,NULL),(156,8,'TEST 1 ... ','10',2,'2013-02-01','2013-02-14','#Test','0',0,NULL,NULL),(157,8,'Random','10',0,'2013-02-01','2013-02-07','#TRX','0',0,NULL,NULL),(158,8,'Check ... watch','10',2,'2013-02-01','2013-02-14','#Watch','0',0,NULL,NULL),(177,9,'Something random','10',2,'2013-02-08','2013-02-21','#TRX','0',31,NULL,NULL),(176,9,'Do a little planning','80',1,'2013-02-01','2013-02-21','#PLN','0',57,NULL,NULL),(175,9,'Do some reflection','100',0,'2013-02-01','2013-02-21','#RFLCT','0',0,NULL,NULL),(178,9,'Sleep','63',0,'2013-02-01','2013-02-21','Sleep','0',0,NULL,NULL),(179,10,'Working reguler','30',0,'2013-02-20','2013-03-20','Run, Play, #Sleep','0',0,NULL,NULL),(180,11,'Key One','30',0,'2013-02-15','2013-03-15','one, two','0',0,NULL,NULL),(181,12,'Key One','30',0,'2013-02-20','2013-03-15','one, two','0',50,NULL,NULL),(182,12,'keyDes2','60',1,'2013-02-20','2013-03-06','Run, Play, #Sleep','0',35,NULL,NULL),(183,13,'Test K2S','40',2,'2013-02-13','2013-02-28','#PLN','0',0,NULL,NULL),(184,13,'Test 2','70',0,'2013-02-13','2013-02-28','Sleep','0',0,NULL,NULL),(185,14,'Sleep','50',0,'2013-02-08','2013-02-28','Sleep','0',0,NULL,NULL),(186,14,'Plan stuff','5',0,'2013-02-08','2013-02-28','#PLN','0',0,NULL,NULL),(187,15,'Sleep','60',0,'2013-02-08','2013-02-28','Sleep','0',0,NULL,NULL),(188,15,'Plan some stuff','10',0,'2013-02-08','2013-02-28','#PLN','0',0,NULL,NULL),(189,16,'Sleep','64',0,'2013-02-08','2013-02-28','Sleep','0',0,NULL,NULL),(190,16,'Plan some stuff','10',2,'2013-02-08','2013-02-28','#PLN','0',0,NULL,NULL),(191,17,'Sleep','64',0,'2013-02-08','2013-02-28','Sleep','0',0,NULL,NULL),(192,17,'Plan some stuff','10',0,'2013-02-08','2013-02-28','#PLN','0',24,NULL,NULL),(194,18,'Plan some stuff','60',2,'2013-02-08','2013-02-28','#PLN','0',76,NULL,NULL),(200,19,'Random stuff','50',2,'2013-02-07','2013-02-20','#TRX','0',0,NULL,NULL),(199,19,'Sleep','80',0,'2013-02-07','2013-02-20','Sleep','0',0,NULL,NULL),(198,19,'Plan some stuff','30',0,'2013-02-07','2013-02-20','#PLN','0',0,NULL,NULL),(202,20,'Planning','14',0,'2013-02-07','2013-02-16','#PLN','0',0,NULL,NULL),(203,20,'Just another K2S','4',2,'2013-02-07','2013-02-16','#TRX','0',0,NULL,NULL),(204,21,'Sleep','56',0,'2013-02-14','2013-02-16','Sleep','0',0,NULL,NULL),(205,22,'Sleep','56',0,'2013-02-14','2013-02-16','Sleep','0',0,NULL,NULL),(211,25,'sleep','70',0,'2013-02-15','2013-02-17','Sleep','0',0,NULL,NULL),(209,24,'Planning','14',0,'2013-02-15','2013-02-15','#PLN','0',0,NULL,NULL),(208,24,'Sleep','64',0,'2013-02-15','2013-02-15','Sleep','0',0,NULL,NULL),(212,26,'Sleep','70',0,'2013-02-16','2013-02-16','Sleep','0',0,NULL,NULL),(213,26,'Plannning','10',2,'2013-02-16','2013-02-16','#PLN','0',0,NULL,NULL),(217,27,'Review day and plan','7',0,'2013-02-16','2013-02-23','#PLN','0',0,NULL,NULL),(216,27,'Sleep','56',0,'2013-02-16','2013-02-23','Sleep','0',0,NULL,NULL),(226,28,'Sleep','56',0,'2013-02-15','2013-02-23','Sleep','0',0,NULL,NULL),(227,28,'Review day and plan','7',0,'2013-02-15','2013-02-23','#PLN','0',0,NULL,NULL),(230,29,'Sleep','10',2,'2013-02-17','2013-02-19','Sleep','0',0,NULL,NULL),(357,30,'Self-time','100',2,'2013-02-14','2013-04-04','#Self-time','0',38,NULL,NULL),(356,30,'Analysis','20',1,'2013-02-04','2013-04-04','#tm','0',88,NULL,NULL),(355,30,'Team Meeting','40',0,'2013-02-24','2013-04-04','#Analytics','0',64,NULL,NULL),(234,31,'Sleep','10',2,'2013-02-18','2013-02-18','#sleep','0',0,NULL,NULL),(273,32,'Sleep','70',0,'2013-02-08','2013-03-09','Sleep','0',0,NULL,NULL),(274,32,'Plan some stuff','7',2,'2013-02-08','2013-03-09','#PLN','0',0,NULL,NULL),(275,32,'Plan more stuff','7',0,'2013-02-08','2013-03-09','#PLN','0',0,NULL,NULL),(272,32,'Exercise','30',2,'2013-02-08','2013-03-09','Run','0',0,NULL,NULL),(364,33,'Exercise','4',2,'2013-02-19','2013-02-21','Run','0',0,NULL,NULL),(363,33,'Sleep (monthly)','300',1,'2013-02-19','2013-02-21','Sleep','0',0,NULL,NULL),(362,33,'Sleep (mission)','40',2,'2013-02-19','2013-02-21','Sleep','0',0,NULL,NULL),(361,33,'Plan and do','7',0,'2013-02-19','2013-02-21','#PLN','0',0,NULL,NULL),(360,33,'Sleep','70',0,'2013-02-19','2013-02-21','Sleep','0',0,NULL,NULL),(311,34,'Plan some stuff','7',0,'2013-02-18','2013-02-19','#PLN','0',0,NULL,NULL),(310,34,'Sleep','70',0,'2013-02-18','2013-02-19','Sleep','0',0,NULL,NULL),(506,43,'Finance Oversight','2',1,'2013-04-01','2013-06-28','finance, burton, accounts','0',0,NULL,NULL),(521,48,'12','',0,'2013-05-02','2013-06-02','','0',16,NULL,NULL),(520,47,'52','',0,'2013-05-02','2013-06-02','','0',0,NULL,NULL),(519,45,'Prospecting','10',0,'2013-04-19','2013-06-30','prospecting','0',0,NULL,NULL),(370,36,'Plan a little','14',0,'2013-02-21','2013-02-21','#PLN','0',0,NULL,NULL),(369,36,'Sleep a bit','70',0,'2013-02-21','2013-02-21','sleep','0',0,NULL,NULL),(379,37,'Plan a little','10',2,'2013-02-22','2013-02-23','#PLN','0',0,NULL,NULL),(380,37,'Sleep','70',0,'2013-02-22','2013-02-23','Sleep','0',0,NULL,NULL),(381,38,'Get your product / service in front of clients / prospects','24',0,'2013-02-24','2013-03-09','#UB, Demo','0',0,NULL,NULL),(382,38,'Plan the next dev sprint','8',0,'2013-02-24','2013-03-09','#SP','0',0,NULL,NULL),(383,38,'Make sessions with users more productive','16',0,'2013-02-24','2013-03-09','#Story','0',0,NULL,NULL),(384,38,'Contribute to the StartX community','8',0,'2013-02-24','2013-03-09','StartX, #SX','0',0,NULL,NULL),(410,39,'Plan the next dev sprint','8',0,'2013-02-20','2013-03-22','#SP','0',0,NULL,NULL),(411,39,'Get your product / service in front of clients / prospects','24',0,'2013-02-20','2013-03-22','#UB, Demo','0',0,NULL,NULL),(412,39,'Contribute to the StartX community','8',0,'2013-02-20','2013-03-22','StartX, #SX','0',0,NULL,NULL),(409,39,'Make sessions with users more productive','16',0,'2013-02-20','2013-03-22','#Story','0',0,NULL,NULL),(414,40,'Refine message to users','10',0,'2013-03-04','2013-03-22','Story','0',0,NULL,NULL),(415,41,'Fix Story','5',0,'2013-03-11','2013-03-17','Story','0',0,NULL,NULL),(416,42,'Tell My Story','10',0,'2013-03-13','2013-03-15','#Story','0',100,NULL,NULL),(509,43,'BNI ','3',1,'2013-04-01','2013-06-28','bni','0',0,NULL,NULL),(508,43,'Discovery','8',1,'2013-04-01','2013-06-28','networking, network, peer','0',0,NULL,NULL),(507,43,'Reflection','4',0,'2013-04-01','2013-06-28','reflection','0',0,NULL,NULL),(469,44,'Show work to others','6',0,'2013-02-19','2013-05-31','Demo, Show','0',0,NULL,NULL),(468,44,'Reflect and update weekly goals','1',0,'2013-02-19','2013-05-31','#Reflect','0',0,NULL,NULL),(467,44,'Plan for daily priorities','3',0,'2013-02-19','2013-05-31','#PLN, Plan','0',0,NULL,NULL),(510,43,'Writing','3',0,'2013-04-01','2013-06-28','write, blog, TCC, WTDTY, post','0',0,NULL,NULL),(511,43,'Acupuncture','2',1,'2013-04-01','2013-06-28','acupuncture, helen','0',0,NULL,NULL),(512,43,'Exercise','5',0,'2013-04-01','2013-06-28','run, gym, swim, bike, yoga','0',1,NULL,NULL),(513,43,'Biz Dev - Direct','5',1,'2013-04-01','2013-06-28','bizdev, consultation','0',0,NULL,NULL),(505,43,'Sleep','52',0,'2013-04-01','2013-06-28','sleep','0',0,NULL,NULL),(504,43,'Good times','3',0,'2013-04-01','2013-06-28','social, party, happy hour','0',0,NULL,NULL),(514,43,'Being Coached','2',1,'2013-04-01','2013-06-28','Keith','0',0,NULL,NULL),(554,46,'Content','10',0,'2013-05-16','2013-06-30','xvc, Blog, Write','0',1,NULL,NULL),(553,46,'Reflection','4',0,'2013-04-01','2013-06-30','xrf, Reflection, Prioritize','0',-103,NULL,NULL),(951,120,'exercise','3',0,'2013-10-22','2013-10-28','','0',0,0,'2013-10-21 19:46:42'),(573,50,'Stuff - many','20',2,'2013-05-22','2013-05-23','Plan, prioritize, #PLN, cpp','0',0,NULL,NULL),(572,50,'Sleep','70',0,'2013-05-22','2013-05-23','Sleep, run, plan','0',0,NULL,NULL),(555,46,'Clients','80',1,'2013-05-16','2013-06-30','xvb','0',0,NULL,NULL),(558,51,'Sleep','56',0,'2013-05-22','2013-05-23','Sleep','0',0,NULL,NULL),(574,50,'Run','21',0,'2013-05-22','2013-05-23','Run, jog','0',0,NULL,NULL),(575,53,'Sleep','70',0,'2013-05-22','2013-05-23','Sleep, run','0',0,NULL,NULL),(576,53,'Run','28',0,'2013-05-22','2013-05-23','Run, jog','0',0,NULL,NULL),(577,53,'Plan','',0,'2013-05-22','2013-05-23','Plan, prioritize, #PLN, cpp','0',0,NULL,NULL),(599,57,'Sleep','70',0,'2013-05-25','2013-05-28','Sleep, run','0',0,NULL,NULL),(596,54,'Sleep','70',0,'2013-05-25','2013-05-27','Sleep, run','0',1,NULL,NULL),(597,54,'Plan','90',1,'2013-05-25','2013-05-27','Plan, prioritize, #PLN, cpp','0',-1,NULL,NULL),(712,55,'Reflection','4',0,'2013-06-07','2013-06-13','Reflect, prioritize, reflection','0',0,NULL,NULL),(589,56,'Reflection','4',0,'2013-05-24','2013-05-30','Reflect, prioritize, reflection','0',0,NULL,NULL),(600,57,'Plan','16',2,'2013-05-25','2013-05-28','PLN, Plan, cpp','0',0,NULL,NULL),(598,54,'Run','8',2,'2013-05-25','2013-05-27','Run, jog','0',-2,NULL,NULL),(601,57,'Run','90',1,'2013-05-25','2013-05-28','Run, jog','0',0,NULL,NULL),(698,58,'Sleep','77',0,'2013-06-03','2013-06-06','Sleep, run','0',0,NULL,NULL),(697,58,'Plan','16',2,'2013-06-03','2013-06-06','PLN, Plan, cpp','0',0,NULL,NULL),(677,59,'toets','7',0,'2013-05-29','2013-05-30','toets, test','0',0,NULL,NULL),(794,60,'toets','2',0,'2013-06-05','2013-06-30','watwou, krieket','0',0,0,'2013-10-10 04:50:53'),(638,61,'Run','10',2,'2013-05-30','2013-06-01','run, jog, gym','0',1,NULL,NULL),(639,61,'Sleep','70',0,'2013-05-30','2013-06-01','sleep, run, plan','0',1,NULL,NULL),(640,62,'Sleep','70',0,'2013-05-30','2013-06-01','Sleep, run, plan','0',1,NULL,NULL),(641,62,'Exercise','12',2,'2013-05-30','2013-06-01','Run, jog, gym, lift','0',0,NULL,NULL),(642,62,'Plan stuff','90',1,'2013-05-30','2013-06-01','Plan, jog','0',-1,NULL,NULL),(648,63,'Exercise','28',0,'2013-05-25','2013-05-31','run, jog, gym','0',0,NULL,NULL),(647,63,'Slaap','70',0,'2013-05-25','2013-05-31','Plan, sleep, run','0',0,NULL,NULL),(678,65,'toets','7',0,'2013-05-29','2013-05-30','toets, test','0',0,NULL,NULL),(695,64,'Vimbli','10',0,'2013-06-03','2013-06-09','Call, Intro, VMBL','0',0,NULL,NULL),(694,64,'Exercise','70',0,'2013-06-03','2013-06-09','run, plan, jog, gym','0',0,NULL,NULL),(693,64,'Sleep','70',0,'2013-06-03','2013-06-09','Sleep, run, slaap, plan','0',0,NULL,NULL),(692,66,'Sleep','70',0,'2013-06-03','2013-06-09','Sleep','0',0,NULL,NULL),(696,68,'Exercise','14',0,'2013-06-03','2013-06-09','Run, gym, yoga, walk','0',0,NULL,NULL),(699,58,'Run','90',1,'2013-06-03','2013-06-06','Run, jog','0',0,NULL,NULL),(832,52,'Vimbli','30',0,'2013-07-01','2013-07-31','Vimbli, SD, intro','0',103,NULL,NULL),(706,69,'Organize clothes','2',0,'2013-06-07','2013-06-22','Organize clothes','0',0,NULL,NULL),(707,69,'exercise','5',0,'2013-06-07','2013-06-22','walk','0',0,NULL,NULL),(831,52,'SMS - time','12',0,'2013-07-01','2013-07-31','SMS','0',11,NULL,NULL),(944,116,'Exercise','7',0,'2013-10-01','2013-10-30','Run, exercise','0',6,0,'2013-10-23 02:10:12'),(717,71,'Oefen','4',0,'2013-06-13','2013-08-31','','0',5,NULL,NULL),(718,71,'Vitamiene','7',0,'2013-06-13','2013-08-31','','0',5,NULL,NULL),(719,71,'Gesond eet','7',0,'2013-06-13','2013-08-31','','0',0,NULL,NULL),(720,72,'aandete saam','7',0,'2013-06-13','2013-06-30','','0',1,NULL,NULL),(721,72,'oggend opstaan ritueel','5',0,'2013-06-13','2013-06-30','','0',1,NULL,NULL),(722,72,'Baas van die Bed stoei','3',0,'2013-06-13','2013-06-30','','0',0,NULL,NULL),(943,116,'Vimbli & Transitions','40',0,'2013-10-01','2013-10-30','Vimbli, 1:1','0',34,57,'2013-10-23 02:10:13'),(941,70,'Meetings','5',0,'2013-10-01','2013-12-31','','0',0,0,'2013-09-27 16:01:31'),(940,70,'Cold Call','5',0,'2013-10-01','2013-12-31','','0',0,0,'2013-09-27 16:01:31'),(939,70,'Create Script per company','1',0,'2013-10-01','2013-12-31','','0',0,0,'2013-09-27 16:01:31'),(740,74,'Reflection and prioritization','3',0,'2013-06-17','2013-07-16','Reflect, prioritize, reset, focus','0',0,NULL,NULL),(829,52,'Colton','14',0,'2013-07-01','2013-07-31','Colton','0',62,NULL,NULL),(830,52,'Prioritization/ Reflection','3',0,'2013-07-01','2013-07-31','Reflect, prioritize, reset, focus','0',5,NULL,NULL),(741,74,'Sample sessions','2',0,'2013-06-17','2013-07-16','','0',0,NULL,NULL),(742,74,'Networking events','2',0,'2013-06-17','2013-07-16','','0',0,NULL,NULL),(743,74,'Email netowrk','1',0,'2013-06-17','2013-07-16','','0',0,NULL,NULL),(827,75,'Reflection and prioritization','5',0,'2013-07-29','2014-01-31','Prioritize, reflection, plan','0',0,NULL,NULL),(761,76,'Reflection and prioritization','4',0,'2013-06-19','2013-06-30','Prioritize, reflection, plan','0',0,NULL,NULL),(747,79,'Running','2.5',0,'2013-06-23','2013-06-29','Prioritize, reflection, plan','0',0,NULL,NULL),(759,80,'Execute on my Core Value Add','20',0,'2013-06-20','2013-06-20','C1, Core','0',0,NULL,NULL),(758,80,'Reflection and prioritization','5',0,'2013-06-09','2013-06-26','Prioritize, reflection, plan','0',0,NULL,NULL),(763,81,'Sleep','56',0,'2013-06-20','2013-06-29','Sleep','0',-35,80,'2013-09-20 00:00:38'),(769,82,'Reflection and prioritization','5',0,'2013-06-20','2013-06-26','Prioritize, reflection, plan','0',0,NULL,NULL),(857,84,'Reflection and prioritization','5',0,'2013-06-17','2013-07-31','Prioritize, reflection, plan','0',0,NULL,NULL),(771,85,'Research careers that I\'m interested in','3',0,'2013-06-21','2013-07-03','advancement, business development, environment, education technology, entrepreneurship','0',0,NULL,NULL),(774,87,'Reflection','7',0,'2013-06-09','2013-06-30','Reflect, prioritize, reflection','0',0,0,'2013-09-30 17:09:29'),(793,60,'lekker','10',0,'2013-06-05','2013-06-30','koek, tee','0',0,0,'2013-10-10 04:50:53'),(858,84,'Sleep','220',1,'2013-06-17','2013-07-31','Sleep','0',0,NULL,NULL),(797,88,'Running','3 hours',0,'2013-06-24','2013-06-30','Running, Workout ','0',0,NULL,NULL),(798,89,'Meet 25 new people','10',0,'2013-06-24','2013-08-31','Event, events, networking, concerts','0',0,NULL,NULL),(799,90,'Advocacy Brochures','2',0,'2013-06-24','2013-06-30','Advocacy, Andrew Peterson','0',0,NULL,NULL),(800,90,'Turn in Brochures','1',0,'2013-06-24','2013-06-30','Office Meeting Andrew Peterson','0',0,NULL,NULL),(801,91,'Practice Speaking','15',2,'2013-06-24','2013-06-30','Speaking, practice speaking, memorize ','0',7,NULL,NULL),(828,52,'Exercise','4',0,'2013-07-01','2013-07-31','Run, gym','0',14,NULL,NULL),(885,86,'Research SCHOOGLE idea that I\'m interested in','3',0,'2013-06-21','2013-09-03','advancement, business development, environment, education technology, entrepreneurship','0',0,NULL,NULL),(816,92,'Reflection','4',0,'2013-06-07','2013-06-13','Reflect, prioritize, reflection','0',2,NULL,NULL),(822,93,'Reflection and prioritization','5',0,'2013-06-20','2013-07-13','Prioritize, reflection, plan','0',0,NULL,NULL),(825,94,'Reflection and prioritization','5',0,'2013-07-00','2013-07-10','Prioritize, reflection, plan','0',0,NULL,NULL),(904,95,'Idea and content generation - impactful contribution','2.5',0,'2013-07-29','2013-12-20','Research, mind dumps, mind maps','0',0,0,'2013-09-09 04:35:45'),(907,95,'Finish building a great contact management system','2.5',0,'2013-07-29','2013-12-20','Streamlined, focused, salesforce and contactually','0',0,0,'2013-09-09 04:35:45'),(906,95,'Series 7 and Series 63 Study','24',0,'2013-07-29','2013-08-15','Discipline, pre-blocked time, great notes','0',0,0,'2013-09-09 04:35:46'),(905,95,'Initiate two high-lever relationships per week','1',0,'2013-07-29','2013-12-20','Bold, confident, organized','0',0,0,'2013-09-09 04:35:46'),(909,102,'Test idea','10',0,'1970-08-19','2013-10-31','1:1, Discuss, (change / add terms to look for in calendar)','0',0,NULL,NULL),(852,97,'Informational interviews and other in person activity','16',0,'2013-07-21','2013-08-31','1:1, Info, Network','0',0,NULL,NULL),(851,97,'Reflection and prioritization','3',0,'2013-07-21','2013-08-31','Prioritize, reflection, plan','0',0,NULL,NULL),(853,98,'Reflection and prioritization','3',0,'2013-07-28','2013-08-31','Reflect, prioritize, plan, journal','0',0,NULL,NULL),(859,84,'Exercise','41',2,'2013-06-17','2013-07-31','Run, jog','0',0,NULL,NULL),(879,99,'Colton','20',0,'2013-08-01','2013-08-31','Colton, CHS','0',68,21,'2013-09-04 16:27:02'),(880,99,'Exercise','5',0,'2013-08-01','2013-08-31','run, gym, walk','0',14,3,'2013-09-04 16:27:17'),(881,99,'Prioritize & plan','5',0,'2013-08-01','2013-08-31','Prioritize, reflection, plan','0',3,22,'2013-09-04 16:27:36'),(882,99,'Career','40',0,'2013-08-01','2013-08-31','Interview, Resume, Job, Vimbli','0',122,58,'2013-09-04 16:27:52'),(878,99,'SMS','10',0,'2013-08-01','2013-08-31','Simone, hmsms, sms','0',24,25,'2013-09-04 16:28:27'),(886,86,'Seeking guidance- professionally and personally','4',1,'0000-00-00','2013-09-03','','0',0,NULL,NULL),(925,103,'sleep','42',1,'2013-08-01','2013-08-31','sleep','0',0,NULL,'2013-09-16 10:52:04'),(908,102,'Reflect on day / Plan tomorrow','4',0,'2013-08-19','2013-10-31','Reflect, Plan, Shape, (change/ add your own terms)','0',0,NULL,NULL),(947,105,'Reflect and prioritize','4',0,'2013-08-20','2013-11-30','Plan, reflect, <personalize with your own terms and time goals>','0',0,NULL,'2013-10-04 22:25:37'),(913,108,'Complete the CTI Training','21 hours',1,'0000-00-00','0000-00-00','Engage\"Learn\"Connect\"Study\" Open\"','0',0,NULL,NULL),(914,109,'Rest','56',0,'2013-08-23','2013-08-31','Sleep','0',0,NULL,NULL),(915,110,'Read in preparation','7',0,'2013-08-26','2013-12-31','Read, study, <change and/ or add terms to look for in your calendar>','0',0,NULL,NULL),(916,110,'Reflect on reading and discussions.','3',0,'2013-08-26','2013-12-31','Reflect, prioritize, reflection, plan','0',0,NULL,NULL),(917,111,'Test idea','10',0,'2013-08-26','2013-08-27','Idea','0',0,NULL,NULL),(935,104,'sleep','42',1,'2013-09-01','2013-09-30','sleep','0',-20,42,'2013-10-18 05:06:50'),(936,104,'Exercise ','7',1,'2013-09-01','2013-09-30','run, walk','0',2,0,'2013-10-18 05:06:51'),(930,113,'Colton time','7',0,'2013-09-01','2013-09-30','Colton, CHS','0',4,28,'2013-10-04 18:03:38'),(928,113,'Reflection','3',0,'2013-09-01','2013-09-30','Reflect, prioritize, reflection, plan','0',-1,13,'2013-10-04 18:03:39'),(929,113,'Simone time','10',0,'2013-09-01','2013-09-30','SMS, Simone','0',0,43,'2013-10-04 18:03:39'),(926,103,'Exercise ','7',0,'2013-08-01','2013-08-31','run, walk','0',0,NULL,'2013-09-16 10:52:04'),(932,113,'Vimbli / Transition content','40',0,'2013-09-01','2013-09-30','Vimbli, Transitions, 1:1, career, Transition','0',99,65,'2013-10-04 18:03:40'),(931,113,'Exercise','7',0,'2013-09-01','2013-09-30','Run, gym, walk','0',28,0,'2013-10-04 18:03:40'),(933,113,'HR Study','10',0,'2013-09-18','2013-09-30','Study, SHRM, HR','0',19,0,'2013-10-04 18:03:40'),(934,114,'Reflection and prioritization','4',0,'2013-08-20','2013-10-30','Reflect, prioritize, reflection, R56','0',9,0,'2013-10-10 12:55:36'),(937,115,'Reflect and prioritize','4',0,'2013-09-23','2013-12-31','Plan, reflect, do','0',0,0,'2013-10-04 19:09:10'),(942,116,'Prioritize','4',0,'2013-10-01','2013-10-30','Prioritize, reflect, plan','0',3,18,'2013-10-23 02:10:14'),(938,70,'ID Target Companies','1',0,'2013-10-01','2013-12-31','','0',0,0,'2013-09-27 16:01:31'),(945,116,'Simone time','15',0,'2013-10-01','2013-10-30','Simone','0',15,3,'2013-10-23 02:10:14'),(946,116,'Colton time','15',0,'2013-10-01','2013-10-30','Colton','0',15,21,'2013-10-23 02:10:14'),(948,117,'Review bookmarked content in Pocket','3',0,'2013-10-14','2013-10-25','blog, reading, news, articles, POV','0',-2,5,'2013-10-22 22:35:21'),(949,119,'sleep','42',1,'2013-08-01','2013-08-31','sleep','0',0,NULL,'2013-09-16 10:52:04'),(950,119,'Exercise ','7',0,'2013-08-01','2013-08-31','run, walk','0',0,NULL,'2013-09-16 10:52:04'),(952,121,'exercise','3',0,'2013-10-22','2013-10-28','','0',0,0,'2013-10-21 19:47:41'),(953,118,'office hours','7',0,'2013-10-01','2013-11-30','office, hours','0',0,0,'2013-10-22 07:35:31'),(954,118,'Run then sleep','30',1,'2013-10-01','2013-11-30','run, sleep','0',0,122,'2013-10-22 07:35:31');
/*!40000 ALTER TABLE `key_to_successes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-10-23 11:14:09
