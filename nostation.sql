-- MySQL dump 10.13  Distrib 5.5.25, for Linux (x86_64)
--
-- Host: localhost    Database: undimaya
-- ------------------------------------------------------
-- Server version	5.5.25-log

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
-- Table structure for table `candidates`
--

DROP TABLE IF EXISTS `candidates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `candidates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `picture` varchar(200) NOT NULL,
  `election_id` int(11) NOT NULL,
  `seat_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `election` (`election_id`),
  KEY `seat` (`seat_id`),
  CONSTRAINT `candidates_ibfk_1` FOREIGN KEY (`election_id`) REFERENCES `elections` (`id`),
  CONSTRAINT `candidates_ibfk_2` FOREIGN KEY (`seat_id`) REFERENCES `seats` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `candidates`
--

LOCK TABLES `candidates` WRITE;
/*!40000 ALTER TABLE `candidates` DISABLE KEYS */;
INSERT INTO `candidates` VALUES (4,'Ahmad','','images/profile/profile1.jpg',1,5),(5,'Kassim','','',1,5),(6,'Ehsan','','',1,5),(7,'Hassan','','',1,5),(8,'Abu','','',1,5),(9,'Manaf','','',1,4),(10,'Abd Hadi','','',1,4),(11,'Ali','','',1,4),(12,'Hafiz','','',1,4),(13,'Zamri','','',1,4),(14,'Hanafi','','',1,4),(15,'Mustaffa','','',1,4),(16,'Harlimi','','',1,4);
/*!40000 ALTER TABLE `candidates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `elections`
--

DROP TABLE IF EXISTS `elections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `elections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `voters_count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `elections`
--

LOCK TABLES `elections` WRITE;
/*!40000 ALTER TABLE `elections` DISABLE KEYS */;
INSERT INTO `elections` VALUES (1,'General Election','2012-03-19','2012-03-30',50);
/*!40000 ALTER TABLE `elections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seats`
--

DROP TABLE IF EXISTS `seats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  `candidate_amount` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `minimum_choice` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seats`
--

LOCK TABLES `seats` WRITE;
/*!40000 ALTER TABLE `seats` DISABLE KEYS */;
INSERT INTO `seats` VALUES (4,'Ahli Jemaah Pengarah Petaling Jaya','AJP',7,200,0),(5,'Perwakilan Ke Pusat Peladang Negeri','Negeri',3,100,0);
/*!40000 ALTER TABLE `seats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tokens`
--

DROP TABLE IF EXISTS `tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(30) NOT NULL,
  `election_id` int(11) NOT NULL,
  `done_vote` tinyint(1) NOT NULL,
  `date_vote` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `election` (`election_id`),
  CONSTRAINT `tokens_ibfk_1` FOREIGN KEY (`election_id`) REFERENCES `elections` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1573 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tokens`
--

LOCK TABLES `tokens` WRITE;
/*!40000 ALTER TABLE `tokens` DISABLE KEYS */;
INSERT INTO `tokens` VALUES (1523,'8693724',1,0,'2012-07-18 12:11:07'),(1524,'2768349',1,0,'2012-07-18 12:11:07'),(1525,'7382469',1,0,'2012-07-18 12:11:07'),(1526,'6379842',1,0,'2012-07-18 12:11:07'),(1527,'7243689',1,0,'2012-07-18 12:11:07'),(1528,'7683294',1,0,'2012-07-18 12:11:07'),(1529,'7428396',1,0,'2012-07-18 12:11:07'),(1530,'9367842',1,0,'2012-07-18 12:11:07'),(1531,'8462379',1,0,'2012-07-18 12:11:07'),(1532,'9684327',1,0,'2012-07-18 12:11:08'),(1533,'3492687',1,0,'2012-07-18 12:11:08'),(1534,'2374986',1,0,'2012-07-18 12:11:08'),(1535,'6249837',1,0,'2012-07-18 12:11:08'),(1536,'6987423',1,0,'2012-07-18 12:11:08'),(1537,'7963284',1,0,'2012-07-18 12:11:08'),(1538,'8327469',1,0,'2012-07-18 12:11:08'),(1539,'4826397',1,0,'2012-07-18 12:11:08'),(1540,'6829473',1,0,'2012-07-18 12:11:08'),(1541,'6384792',1,0,'2012-07-18 12:11:08'),(1542,'9264783',1,0,'2012-07-18 12:11:08'),(1543,'6783429',1,0,'2012-07-18 12:11:09'),(1544,'7369824',1,0,'2012-07-18 12:11:09'),(1545,'6428739',1,0,'2012-07-18 12:11:09'),(1546,'8762943',1,0,'2012-07-18 12:11:09'),(1547,'3672984',1,0,'2012-07-18 12:11:09'),(1548,'6843729',1,0,'2012-07-18 12:11:09'),(1549,'3892647',1,0,'2012-07-18 12:11:09'),(1550,'3942768',1,0,'2012-07-18 12:11:09'),(1551,'4736289',1,0,'2012-07-18 12:11:09'),(1552,'4236798',1,0,'2012-07-18 12:11:09'),(1553,'7248936',1,0,'2012-07-18 12:11:09'),(1554,'8934627',1,0,'2012-07-18 12:11:09'),(1555,'9382476',1,0,'2012-07-18 12:11:10'),(1556,'6429387',1,0,'2012-07-18 12:11:10'),(1557,'4689732',1,0,'2012-07-18 12:11:10'),(1558,'2496738',1,0,'2012-07-18 12:11:10'),(1559,'6324789',1,0,'2012-07-18 12:11:10'),(1560,'9873246',1,0,'2012-07-18 12:11:10'),(1561,'8462397',1,0,'2012-07-18 12:11:10'),(1562,'6839247',1,0,'2012-07-18 12:11:10'),(1563,'4793862',1,0,'2012-07-18 12:11:10'),(1564,'4327896',1,0,'2012-07-18 12:11:10'),(1565,'2497368',1,0,'2012-07-18 12:11:10'),(1566,'8763942',1,0,'2012-07-18 12:11:10'),(1567,'8943276',1,0,'2012-07-18 12:11:11'),(1568,'2784936',1,0,'2012-07-18 12:11:11'),(1569,'6789432',1,0,'2012-07-18 12:11:11'),(1570,'8362974',1,0,'2012-07-18 12:11:11'),(1571,'7346298',1,0,'2012-07-18 12:11:11'),(1572,'7632849',1,0,'2012-07-18 12:11:11');
/*!40000 ALTER TABLE `tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `votes`
--

DROP TABLE IF EXISTS `votes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `token` (`token_id`),
  KEY `candidate` (`candidate_id`),
  CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`token_id`) REFERENCES `tokens` (`id`),
  CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `votes`
--

LOCK TABLES `votes` WRITE;
/*!40000 ALTER TABLE `votes` DISABLE KEYS */;
/*!40000 ALTER TABLE `votes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-07-18 20:11:56
