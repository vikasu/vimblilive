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
-- Table structure for table `wp_usermeta`
--

DROP TABLE IF EXISTS `wp_usermeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_usermeta` (
  `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`umeta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_usermeta`
--

LOCK TABLES `wp_usermeta` WRITE;
/*!40000 ALTER TABLE `wp_usermeta` DISABLE KEYS */;
INSERT INTO `wp_usermeta` VALUES (1,1,'first_name','Hennie'),(2,1,'last_name','Strydom'),(3,1,'nickname','vimbli'),(4,1,'description',''),(5,1,'rich_editing','true'),(6,1,'comment_shortcuts','false'),(7,1,'admin_color','fresh'),(8,1,'use_ssl','0'),(9,1,'show_admin_bar_front','true'),(10,1,'wp_capabilities','a:1:{s:13:\"administrator\";s:1:\"1\";}'),(11,1,'wp_user_level','10'),(12,1,'dismissed_wp_pointers','wp330_toolbar,wp330_media_uploader,wp330_saving_widgets,wp340_choose_image_from_library,wp340_customize_current_theme_link,wp350_media'),(13,1,'show_welcome_panel','0'),(14,1,'wp_dashboard_quick_press_last_post_id','437'),(15,1,'managenav-menuscolumnshidden','a:4:{i:0;s:11:\"link-target\";i:1;s:11:\"css-classes\";i:2;s:3:\"xfn\";i:3;s:11:\"description\";}'),(16,1,'metaboxhidden_nav-menus','a:3:{i:0;s:8:\"add-post\";i:1;s:12:\"add-post_tag\";i:2;s:15:\"add-post_format\";}'),(17,1,'wp_user-settings','editor=tinymce&align=center&imgsize=full&hidetb=1&wplink=0&urlbutton=none'),(18,1,'wp_user-settings-time','1372045444'),(19,1,'aim',''),(20,1,'yim',''),(21,1,'jabber','hennies@gmail.com'),(22,2,'first_name','Admin'),(23,2,'last_name','Vimbli'),(24,2,'nickname','Admin - Vimbli'),(25,2,'description',''),(26,2,'rich_editing','true'),(27,2,'comment_shortcuts','false'),(28,2,'admin_color','fresh'),(29,2,'use_ssl','0'),(30,2,'show_admin_bar_front','true'),(31,2,'wp_capabilities','a:1:{s:13:\"administrator\";s:1:\"1\";}'),(32,2,'wp_user_level','10'),(33,2,'dismissed_wp_pointers','wp330_toolbar,wp330_media_uploader,wp330_saving_widgets,wp340_choose_image_from_library,wp340_customize_current_theme_link'),(34,1,'wysija_pref','YToyOntzOjE4OiJ3eXNpamFfc3Vic2NyaWJlcnMiO2E6MTp7czo3OiJkZWZhdWx0IjthOjE6e3M6ODoibGltaXRfcHAiO3M6MzoiNTAwIjt9fXM6MTY6Ind5c2lqYV9jYW1wYWlnbnMiO2E6MTp7czo5OiJ2aWV3c3RhdHMiO2E6MTp7czo4OiJsaW1pdF9wcCI7czozOiI1MDAiO319fQ=='),(35,2,'wp_dashboard_quick_press_last_post_id','436'),(36,2,'closedpostboxes_dashboard','a:0:{}'),(37,2,'metaboxhidden_dashboard','a:1:{i:0;s:21:\"dashboard_browser_nag\";}'),(38,2,'wysija_pref','YTowOnt9'),(39,2,'wp_user-settings','mfold=o'),(40,2,'wp_user-settings-time','1362651244'),(41,2,'aim',''),(42,2,'yim',''),(43,2,'jabber','vimbli'),(44,1,'closedpostboxes_post','a:1:{i:0;s:9:\"formatdiv\";}'),(45,1,'metaboxhidden_post','a:6:{i:0;s:11:\"postexcerpt\";i:1;s:13:\"trackbacksdiv\";i:2;s:10:\"postcustom\";i:3;s:16:\"commentstatusdiv\";i:4;s:7:\"slugdiv\";i:5;s:9:\"authordiv\";}'),(46,1,'AtD_options','Bias Language,Cliches,Complex Expression,Diacritical Marks,Double Negative,Hidden Verbs,Jargon Language,Passive voice,Phrases to Avoid,Redundant Expression'),(47,1,'AtD_check_when','onpublish,onupdate'),(48,1,'AtD_guess_lang',''),(49,1,'AtD_ignored_phrases','onboarding,Vimbli,Vimbli\'s'),(50,1,'closedpostboxes_editcss','a:0:{}'),(51,1,'metaboxhidden_editcss','a:0:{}'),(52,1,'closedpostboxes_dashboard','a:1:{i:0;s:15:\"dashboard_stats\";}'),(53,1,'metaboxhidden_dashboard','a:0:{}');
/*!40000 ALTER TABLE `wp_usermeta` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-10-23 11:23:00
