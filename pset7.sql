-- MySQL dump 10.13  Distrib 5.5.46, for debian-linux-gnu (x86_64)
--
-- Host: 0.0.0.0    Database: pset7
-- ------------------------------------------------------
-- Server version	5.5.46-0ubuntu0.14.04.2

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
-- Table structure for table `history`
--

DROP TABLE IF EXISTS `history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `transaction` varchar(255) NOT NULL,
  `time` varchar(30) NOT NULL,
  `symbol` varchar(255) NOT NULL,
  `shares` int(11) NOT NULL,
  `price` decimal(65,4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shares` (`shares`,`price`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `history`
--

LOCK TABLES `history` WRITE;
/*!40000 ALTER TABLE `history` DISABLE KEYS */;
INSERT INTO `history` VALUES (10,9,'BUY','12/17/16, 04:06pm','C',3,59.7500),(11,9,'SELL','12/17/16, 04:08pm','A',3,45.9100),(12,9,'SELL','12/17/16, 04:08pm','C',3,59.7500),(14,9,'SELL','12/17/16, 04:10pm','GOOG',3,790.8000),(15,9,'BUY','12/17/16, 04:11pm','MSFT',30,62.3000),(16,9,'SELL','12/17/16, 04:13pm','MSFT',30,62.3000),(17,9,'BUY','12/17/16, 04:15pm','AB',7,22.4000),(18,9,'SELL','12/17/16, 04:15pm','AB',7,22.4000),(19,13,'BUY','12/17/16, 09:00pm','A',10,45.9100),(20,13,'SELL','12/17/16, 09:01pm','A',10,45.9100),(21,14,'BUY','12/21/16, 08:46pm','A',1,46.0900),(22,14,'SELL','12/22/16, 02:26am','A',1,46.1400),(23,14,'BUY','12/22/16, 02:53am','A',3,46.0400),(24,14,'SELL','12/22/16, 02:53am','A',3,46.0400),(25,14,'BUY','12/22/16, 03:00am','TY',12,22.1000),(26,14,'SELL','12/22/16, 03:02am','TY',12,22.1000),(27,15,'BUY','12/23/16, 01:15am','A',45,45.9900),(28,15,'BUY','12/23/16, 01:16am','GOOG',4,790.9200),(29,14,'BUY','12/23/16, 01:23am','MSFT',3,63.6200),(30,14,'BUY','12/23/16, 01:27am','GOOG',1,791.1150),(31,14,'SELL','12/23/16, 01:29am','GOOG',1,791.4150);
/*!40000 ALTER TABLE `history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `portfolios`
--

DROP TABLE IF EXISTS `portfolios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `portfolios` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `symbol` varchar(255) NOT NULL,
  `shares` int(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`symbol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portfolios`
--

LOCK TABLES `portfolios` WRITE;
/*!40000 ALTER TABLE `portfolios` DISABLE KEYS */;
INSERT INTO `portfolios` VALUES (1,15,'A',45),(2,15,'GOOG',4),(3,14,'MSFT',3);
/*!40000 ALTER TABLE `portfolios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `cash` decimal(65,4) unsigned NOT NULL DEFAULT '0.0000',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'andi','$2y$10$c.e4DK7pVyLT.stmHxgAleWq4yViMmkwKz3x8XCo4b/u3r8g5OTnS',10000.0000),(2,'caesar','$2y$10$0p2dlmu6HnhzEMf9UaUIfuaQP7tFVDMxgFcVs0irhGqhOxt6hJFaa',10000.0000),(3,'eli','$2y$10$COO6EnTVrCPCEddZyWeEJeH9qPCwPkCS0jJpusNiru.XpRN6Jf7HW',10000.0000),(4,'hdan','$2y$10$o9a4ZoHqVkVHSno6j.k34.wC.qzgeQTBHiwa3rpnLq7j2PlPJHo1G',10000.0000),(5,'jason','$2y$10$ci2zwcWLJmSSqyhCnHKUF.AjoysFMvlIb1w4zfmCS7/WaOrmBnLNe',10000.0000),(6,'john','$2y$10$dy.LVhWgoxIQHAgfCStWietGdJCPjnNrxKNRs5twGcMrQvAPPIxSy',10000.0000),(7,'levatich','$2y$10$fBfk7L/QFiplffZdo6etM.096pt4Oyz2imLSp5s8HUAykdLXaz6MK',10000.0000),(8,'rob','$2y$10$3pRWcBbGdAdzdDiVVybKSeFq6C50g80zyPRAxcsh2t5UnwAkG.I.2',10000.0000),(9,'skroob','$2y$10$eFaTIoeq4Xxpb5kCMk6CH.xgtfUMloIyjRooI96bFIVWeB4abuONW',20926.7580),(10,'zamyla','$2y$10$UOaRF0LGOaeHG4oaEkfO4O7vfI34B1W23WqHr9zCpXL68hfQsS3/e',10000.0000),(13,'Vinayak','$2y$10$gft1M5h44qh09wrrgYvygOnrYLliAzzccQdn7Eo9BfKsifFnKbqE.',2156.2200),(14,'Vishu','$2y$10$s9E/gF2UBHFxRpBXrvwWTOwmUqIWi8eAT1F/iklRD4wSioch/4Ypu',11843.5900),(15,'Kon','$2y$10$mc.vgb458.eJ1MbHoUaSUetcIAkapTKTZiTaKe67ft/1f4KynkNUm',4766.7700);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-22 20:13:37
