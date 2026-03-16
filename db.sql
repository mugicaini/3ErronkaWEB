-- MySQL dump 10.13  Distrib 8.0.43, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: erronka3
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bezero_subskripzioa`
--

DROP TABLE IF EXISTS `bezero_subskripzioa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bezero_subskripzioa` (
  `id_bezero_sub` int(11) NOT NULL AUTO_INCREMENT,
  `id_bezeroa` int(11) NOT NULL,
  `id_sub` int(11) NOT NULL,
  `hasiera_data` date DEFAULT NULL,
  `amaiera_data` date DEFAULT NULL,
  `egoera` enum('aktiboa','desaktibatuta') DEFAULT 'aktiboa',
  PRIMARY KEY (`id_bezero_sub`),
  KEY `id_bezeroa` (`id_bezeroa`),
  KEY `id_sub` (`id_sub`),
  CONSTRAINT `bezero_subskripzioa_ibfk_1` FOREIGN KEY (`id_bezeroa`) REFERENCES `bezeroak` (`id_bezeroa`) ON DELETE CASCADE,
  CONSTRAINT `bezero_subskripzioa_ibfk_2` FOREIGN KEY (`id_sub`) REFERENCES `subskripzioak` (`id_sub`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bezero_subskripzioa`
--

LOCK TABLES `bezero_subskripzioa` WRITE;
/*!40000 ALTER TABLE `bezero_subskripzioa` DISABLE KEYS */;
INSERT INTO `bezero_subskripzioa` VALUES (1,1,1,'2026-01-15','2026-02-14','aktiboa'),(2,2,2,'2026-02-01','2026-03-02','aktiboa'),(3,3,3,'2026-01-20','2027-01-19','aktiboa');
/*!40000 ALTER TABLE `bezero_subskripzioa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bezeroak`
--

DROP TABLE IF EXISTS `bezeroak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bezeroak` (
  `id_bezeroa` int(11) NOT NULL AUTO_INCREMENT,
  `izena` varchar(50) NOT NULL,
  `abizena` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pasahitza` varchar(255) NOT NULL,
  `telefonoa` varchar(20) DEFAULT NULL,
  `jaiotze_data` date DEFAULT NULL,
  `inskripzio_data` date DEFAULT NULL,
  `argazkia` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_bezeroa`),
  UNIQUE KEY `email` (`email`),
  KEY `idx_email_bezeroa` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bezeroak`
--

LOCK TABLES `bezeroak` WRITE;
/*!40000 ALTER TABLE `bezeroak` DISABLE KEYS */;
INSERT INTO `bezeroak` VALUES (1,'Aitor','Etxebarria','aitor.etxebarria@gmail.com','1MG3','600123456','1990-05-12','2026-01-15','img/pertsona1.jpg'),(2,'Nerea','Garmendia','nerea.garmendia@gmail.com','1MG3','600654321','1988-08-23','2026-02-01','img/pertsona2.jpg'),(3,'Mikel','Uribe','mikel.uribe@gmail.com','1MG3','601234567','1995-03-30','2026-01-20','img/persona3.jpg');
/*!40000 ALTER TABLE `bezeroak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `bezeroak_subskripzioak_bista`
--

DROP TABLE IF EXISTS `bezeroak_subskripzioak_bista`;
/*!50001 DROP VIEW IF EXISTS `bezeroak_subskripzioak_bista`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `bezeroak_subskripzioak_bista` AS SELECT 
 1 AS `id_bezeroa`,
 1 AS `izena`,
 1 AS `abizena`,
 1 AS `email`,
 1 AS `suscripcion`,
 1 AS `hasiera_data`,
 1 AS `amaiera_data`,
 1 AS `egoera`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `erreserba_zeinekegin_bista`
--

DROP TABLE IF EXISTS `erreserba_zeinekegin_bista`;
/*!50001 DROP VIEW IF EXISTS `erreserba_zeinekegin_bista`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `erreserba_zeinekegin_bista` AS SELECT 
 1 AS `id_erreserba`,
 1 AS `cliente`,
 1 AS `clase`,
 1 AS `data`,
 1 AS `sarrera_ordua`,
 1 AS `egoera`,
 1 AS `checkin`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `erreserbak`
--

DROP TABLE IF EXISTS `erreserbak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `erreserbak` (
  `id_erreserba` int(11) NOT NULL AUTO_INCREMENT,
  `id_bezeroa` int(11) NOT NULL,
  `id_klasea` int(11) NOT NULL,
  `erreserba_data` date DEFAULT NULL,
  `egoera` enum('konfirmatuta','kanzelatuta') DEFAULT 'konfirmatuta',
  `checkin` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id_erreserba`),
  KEY `id_bezeroa` (`id_bezeroa`),
  KEY `id_klasea` (`id_klasea`),
  KEY `idx_reserva_cliente` (`id_bezeroa`),
  CONSTRAINT `erreserbak_ibfk_1` FOREIGN KEY (`id_bezeroa`) REFERENCES `bezeroak` (`id_bezeroa`) ON DELETE CASCADE,
  CONSTRAINT `erreserbak_ibfk_2` FOREIGN KEY (`id_klasea`) REFERENCES `klaseak` (`id_klasea`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `erreserbak`
--

LOCK TABLES `erreserbak` WRITE;
/*!40000 ALTER TABLE `erreserbak` DISABLE KEYS */;
INSERT INTO `erreserbak` VALUES (4,1,1,'2026-04-01','konfirmatuta',1),(5,2,2,'2026-04-02','konfirmatuta',0),(6,3,3,'2026-04-03','konfirmatuta',1),(7,1,4,'2026-04-04','konfirmatuta',0),(8,2,5,'2026-04-05','konfirmatuta',1),(9,3,6,'2026-04-06','kanzelatuta',0),(10,1,7,'2026-04-07','konfirmatuta',1),(11,2,8,'2026-04-08','konfirmatuta',0),(12,1,9,'2026-03-13','konfirmatuta',0),(13,3,8,'2026-03-16','konfirmatuta',0);
/*!40000 ALTER TABLE `erreserbak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `intzidentzia`
--

DROP TABLE IF EXISTS `intzidentzia`;
/*!50001 DROP VIEW IF EXISTS `intzidentzia`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `intzidentzia` AS SELECT 
 1 AS `maquina`,
 1 AS `data`,
 1 AS `deskripzioa`,
 1 AS `tecnico`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `inzidentziak`
--

DROP TABLE IF EXISTS `inzidentziak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inzidentziak` (
  `id_inzidentziak` int(11) NOT NULL AUTO_INCREMENT,
  `id_makina` int(11) NOT NULL,
  `data` date DEFAULT NULL,
  `deskripzioa` text DEFAULT NULL,
  `egoera` enum('konponduta','matxuratuta','rebisatzeko') DEFAULT NULL,
  `id_langilea` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_inzidentziak`),
  KEY `id_makina` (`id_makina`),
  KEY `fk_langilea_mantenu` (`id_langilea`),
  KEY `idx_mantenu_makina` (`id_makina`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inzidentziak`
--

LOCK TABLES `inzidentziak` WRITE;
/*!40000 ALTER TABLE `inzidentziak` DISABLE KEYS */;
INSERT INTO `inzidentziak` VALUES (1,1,'2026-02-01','Olio aldaketa eta garbiketa','konponduta',NULL),(2,2,'2026-02-15','Frenatze sistema egiaztatu','konponduta',NULL),(3,3,'2026-03-01','Txirrindako kateak eta pisuak egiaztatu','konponduta',NULL),(4,1,'2026-03-10','Zinta lubrifikatu','konponduta',3),(5,2,'2026-03-12','Pedalak berrikusi','konponduta',3),(6,3,'2026-03-15','Torlojuak estutu','konponduta',7),(7,1,'2026-03-18','Motorra berrikusi','konponduta',7),(8,2,'2026-03-20','Pantaila garbitu','matxuratuta',3);
/*!40000 ALTER TABLE `inzidentziak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `klaseak`
--

DROP TABLE IF EXISTS `klaseak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `klaseak` (
  `id_klasea` int(11) NOT NULL AUTO_INCREMENT,
  `izena` varchar(50) DEFAULT NULL,
  `deskripzioa` text DEFAULT NULL,
  `sarrera_ordua` time DEFAULT NULL,
  `amaiera_ordua` time DEFAULT NULL,
  `kapazitatea` int(11) DEFAULT NULL,
  `eguna_semana` varchar(20) DEFAULT NULL,
  `id_langilea` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `egoera` enum('aktiboa','amaituta','kanzelatuta') DEFAULT 'aktiboa',
  PRIMARY KEY (`id_klasea`),
  KEY `id_langilea` (`id_langilea`),
  CONSTRAINT `klaseak_ibfk_1` FOREIGN KEY (`id_langilea`) REFERENCES `langileak` (`id_langilea`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `klaseak`
--

LOCK TABLES `klaseak` WRITE;
/*!40000 ALTER TABLE `klaseak` DISABLE KEYS */;
INSERT INTO `klaseak` VALUES (1,'Spinning','Bizikleta estatiko klasea','09:00:00','10:00:00',15,'Astelehena',1,'2026-04-01','aktiboa'),(2,'Yoga','Yoga erlaxazio klasea','10:00:00','11:00:00',20,'Asteartea',2,'2026-04-02','aktiboa'),(3,'Crossfit','Indar eta erresistentzia','18:00:00','19:00:00',12,'Asteazkena',1,'2026-04-03','aktiboa'),(4,'Pilates','Core lantzeko klasea','17:00:00','18:00:00',15,'Osteguna',6,'2026-04-04','aktiboa'),(5,'BodyPump','Pisuekin entrenamendua','19:00:00','20:00:00',18,'Ostirala',8,'2026-04-05','aktiboa'),(6,'HIIT','Intentsitate altuko entrenamendua','20:00:00','21:00:00',10,'Larunbata',5,'2026-04-06','aktiboa'),(7,'Stretching','Malgutasuna lantzeko','08:00:00','09:00:00',20,'Astelehena',2,'2026-04-07','aktiboa'),(8,'Funcional','Entrenamendu funtzionala','16:00:00','17:00:00',14,'Asteartea',1,'2026-04-08','aktiboa'),(9,'Spinning','Bizikleta estatiko klasea','09:00:00','10:00:00',15,'Astelehena',1,'2026-03-14','amaituta');
/*!40000 ALTER TABLE `klaseak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `langileak`
--

DROP TABLE IF EXISTS `langileak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `langileak` (
  `id_langilea` int(11) NOT NULL AUTO_INCREMENT,
  `izena` varchar(50) NOT NULL,
  `abizena` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefonoa` varchar(20) DEFAULT NULL,
  `rola` enum('teknikoa','entrenatzailea','admin') DEFAULT 'teknikoa',
  `espezializazioa` varchar(100) DEFAULT NULL,
  `argazkia` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_langilea`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `langileak`
--

LOCK TABLES `langileak` WRITE;
/*!40000 ALTER TABLE `langileak` DISABLE KEYS */;
INSERT INTO `langileak` VALUES (1,'Jon','Lopez','jon.lopez@gmail.com','600111111','entrenatzailea','Crossfit','img/entrenador1.jpg'),(2,'Ane','Martinez','ane.martinez@gmail.com','600222222','entrenatzailea','Yoga','img/entrenador2.jpg'),(3,'Iker','Santos','iker.santos@gmail.com','600333333','teknikoa','Makinen mantenua','img/entrenador3.jpg'),(4,'Maite','Garcia','maite.garcia@gmail.com','600444444','admin','Kudeaketa','img/entrenador4.jpg'),(5,'Unai','Perez','unai.perez@gmail.com','600555555','entrenatzailea','Spinning',NULL),(6,'Leire','Ruiz','leire.ruiz@gmail.com','600666666','entrenatzailea','Pilates',NULL),(7,'Asier','Morales','asier.morales@gmail.com','600777777','teknikoa','Elektronika',NULL),(8,'June','Navarro','june.navarro@gmail.com','600888888','entrenatzailea','BodyPump',NULL);
/*!40000 ALTER TABLE `langileak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `makinak`
--

DROP TABLE IF EXISTS `makinak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `makinak` (
  `id_makina` int(11) NOT NULL AUTO_INCREMENT,
  `izena` varchar(100) DEFAULT NULL,
  `mota` varchar(50) DEFAULT NULL,
  `egoera` enum('aktiboa','matxuratuta','rebisatzeko') DEFAULT 'aktiboa',
  `kokalekua` varchar(100) DEFAULT NULL,
  `erosketa_data` date DEFAULT NULL,
  PRIMARY KEY (`id_makina`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `makinak`
--

LOCK TABLES `makinak` WRITE;
/*!40000 ALTER TABLE `makinak` DISABLE KEYS */;
INSERT INTO `makinak` VALUES (1,'Treadmill Pro','Kardio','aktiboa','Gela 1','2024-05-10'),(2,'Bike Station','Kardio','aktiboa','Gela 2','2025-01-15'),(3,'Power Rack','Indarra','aktiboa','Gela 3','2023-11-20'),(4,'Chest Press Machine','Pecho','aktiboa','Zona Pecho','2023-01-10'),(5,'Incline Chest Press','Pecho','aktiboa','Zona Pecho','2023-02-15'),(6,'Decline Chest Press','Pecho','aktiboa','Zona Pecho','2023-03-12'),(7,'Pec Deck Butterfly','Pecho','aktiboa','Zona Pecho','2023-04-05'),(8,'Cable Chest Fly','Pecho','aktiboa','Zona Pecho','2023-05-10'),(9,'Smith Machine Bench Press','Pecho','aktiboa','Zona Pecho','2023-06-20'),(10,'Plate Loaded Chest Press','Pecho','aktiboa','Zona Pecho','2023-07-11'),(11,'Hammer Strength Chest Press','Pecho','aktiboa','Zona Pecho','2023-08-02'),(12,'Standing Cable Press','Pecho','aktiboa','Zona Pecho','2023-09-15'),(13,'Dip Machine','Pecho','aktiboa','Zona Pecho','2023-10-01'),(14,'Lat Pulldown Machine','Espalda','aktiboa','Zona Espalda','2023-01-20'),(15,'Seated Row Machine','Espalda','aktiboa','Zona Espalda','2023-02-10'),(16,'Hammer Strength Row','Espalda','aktiboa','Zona Espalda','2023-03-18'),(17,'T-Bar Row Machine','Espalda','aktiboa','Zona Espalda','2023-04-22'),(18,'Cable Row','Espalda','aktiboa','Zona Espalda','2023-05-30'),(19,'Assisted Pull-Up Machine','Espalda','aktiboa','Zona Espalda','2023-06-14'),(20,'Reverse Pec Deck','Espalda','aktiboa','Zona Espalda','2023-07-19'),(21,'Straight Arm Pulldown','Espalda','aktiboa','Zona Espalda','2023-08-25'),(22,'High Row Machine','Espalda','aktiboa','Zona Espalda','2023-09-10'),(23,'Low Row Machine','Espalda','aktiboa','Zona Espalda','2023-10-05'),(24,'Leg Press Machine','Piernas','aktiboa','Zona Piernas','2023-01-12'),(25,'Hack Squat Machine','Piernas','aktiboa','Zona Piernas','2023-02-08'),(26,'Leg Extension Machine','Piernas','aktiboa','Zona Piernas','2023-03-20'),(27,'Leg Curl Machine','Piernas','aktiboa','Zona Piernas','2023-04-11'),(28,'Standing Leg Curl','Piernas','aktiboa','Zona Piernas','2023-05-16'),(29,'Smith Machine Squat','Piernas','aktiboa','Zona Piernas','2023-06-09'),(30,'Hip Thrust Machine','Piernas','aktiboa','Zona Piernas','2023-07-04'),(31,'Glute Bridge Machine','Piernas','aktiboa','Zona Piernas','2023-08-12'),(32,'Adductor Machine','Piernas','aktiboa','Zona Piernas','2023-09-18'),(33,'Abductor Machine','Piernas','aktiboa','Zona Piernas','2023-10-03'),(34,'Shoulder Press Machine','Hombros','aktiboa','Zona Hombros','2023-01-14'),(35,'Smith Shoulder Press','Hombros','aktiboa','Zona Hombros','2023-02-21'),(36,'Lateral Raise Machine','Hombros','aktiboa','Zona Hombros','2023-03-15'),(37,'Cable Lateral Raise','Hombros','aktiboa','Zona Hombros','2023-04-18'),(38,'Rear Delt Machine','Hombros','aktiboa','Zona Hombros','2023-05-22'),(39,'Front Raise Machine','Hombros','aktiboa','Zona Hombros','2023-06-27'),(40,'Cable Face Pull','Hombros','aktiboa','Zona Hombros','2023-07-30'),(41,'Plate Loaded Shoulder Press','Hombros','aktiboa','Zona Hombros','2023-08-17'),(42,'Arnold Press Smith','Hombros','aktiboa','Zona Hombros','2023-09-07'),(43,'Cable Upright Row','Hombros','aktiboa','Zona Hombros','2023-10-12'),(44,'Biceps Curl Machine','Brazos','aktiboa','Zona Brazos','2023-01-05'),(45,'Preacher Curl Machine','Brazos','aktiboa','Zona Brazos','2023-02-11'),(46,'Cable Biceps Curl','Brazos','aktiboa','Zona Brazos','2023-03-09'),(47,'Triceps Pushdown','Brazos','aktiboa','Zona Brazos','2023-04-14'),(48,'Triceps Extension Machine','Brazos','aktiboa','Zona Brazos','2023-05-19'),(49,'Dip Machine Triceps','Brazos','aktiboa','Zona Brazos','2023-06-25'),(50,'Hammer Curl Cable','Brazos','aktiboa','Zona Brazos','2023-07-06'),(51,'Overhead Triceps Extension','Brazos','aktiboa','Zona Brazos','2023-08-13'),(52,'Reverse Curl Cable','Brazos','aktiboa','Zona Brazos','2023-09-21'),(53,'Single Arm Curl Machine','Brazos','aktiboa','Zona Brazos','2023-10-08'),(54,'Ab Crunch Machine','Core','aktiboa','Zona Core','2023-01-07'),(55,'Cable Crunch','Core','aktiboa','Zona Core','2023-02-17'),(56,'Roman Chair','Core','aktiboa','Zona Core','2023-03-22'),(57,'Hanging Leg Raise Station','Core','aktiboa','Zona Core','2023-04-26'),(58,'Decline Sit Up Bench','Core','aktiboa','Zona Core','2023-05-28'),(59,'Torso Rotation Machine','Core','aktiboa','Zona Core','2023-06-13'),(60,'Captain Chair','Core','aktiboa','Zona Core','2023-07-23'),(61,'Ab Roller Machine','Core','aktiboa','Zona Core','2023-08-28'),(62,'Plank Bench','Core','aktiboa','Zona Core','2023-09-14'),(63,'Oblique Twist Machine','Core','aktiboa','Zona Core','2023-10-20');
/*!40000 ALTER TABLE `makinak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ordainketak`
--

DROP TABLE IF EXISTS `ordainketak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ordainketak` (
  `id_ordainketa` int(11) NOT NULL AUTO_INCREMENT,
  `id_bezero_sub` int(11) NOT NULL,
  `ordainketa_data` date DEFAULT NULL,
  `ordainketa_metodoa` varchar(50) DEFAULT NULL,
  `zenbatekoa` decimal(8,2) DEFAULT NULL,
  `egoera` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_ordainketa`),
  KEY `id_bezero_sub` (`id_bezero_sub`),
  CONSTRAINT `ordainketak_ibfk_1` FOREIGN KEY (`id_bezero_sub`) REFERENCES `bezero_subskripzioa` (`id_bezero_sub`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordainketak`
--

LOCK TABLES `ordainketak` WRITE;
/*!40000 ALTER TABLE `ordainketak` DISABLE KEYS */;
INSERT INTO `ordainketak` VALUES (1,1,'2026-01-15','Txartela',30.00,'osatua'),(2,2,'2026-02-01','Transferentzia',50.00,'osatua'),(3,3,'2026-01-20','Txartela',500.00,'osatua');
/*!40000 ALTER TABLE `ordainketak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subskripzioak`
--

DROP TABLE IF EXISTS `subskripzioak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subskripzioak` (
  `id_sub` int(11) NOT NULL AUTO_INCREMENT,
  `izena` varchar(50) NOT NULL,
  `prezioa` decimal(8,2) NOT NULL,
  `iraupen_denbora` int(11) NOT NULL,
  `deskripzioa` text DEFAULT NULL,
  PRIMARY KEY (`id_sub`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subskripzioak`
--

LOCK TABLES `subskripzioak` WRITE;
/*!40000 ALTER TABLE `subskripzioak` DISABLE KEYS */;
INSERT INTO `subskripzioak` VALUES (1,'Oinarrizko',30.00,30,'Hilabete bateko oinarrizko subskripzioa gimnasioan.'),(2,'Aurreratua',50.00,30,'Gela guztiak eta klase bereziak barne.'),(3,'Urteko',500.00,365,'Urteko subskripzioa, hileko ordainketarik gabe.');
/*!40000 ALTER TABLE `subskripzioak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `bezeroak_subskripzioak_bista`
--

/*!50001 DROP VIEW IF EXISTS `bezeroak_subskripzioak_bista`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `bezeroak_subskripzioak_bista` AS select `b`.`id_bezeroa` AS `id_bezeroa`,`b`.`izena` AS `izena`,`b`.`abizena` AS `abizena`,`b`.`email` AS `email`,`s`.`izena` AS `suscripcion`,`bs`.`hasiera_data` AS `hasiera_data`,`bs`.`amaiera_data` AS `amaiera_data`,`bs`.`egoera` AS `egoera` from ((`bezeroak` `b` join `bezero_subskripzioa` `bs` on(`b`.`id_bezeroa` = `bs`.`id_bezeroa`)) join `subskripzioak` `s` on(`bs`.`id_sub` = `s`.`id_sub`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `erreserba_zeinekegin_bista`
--

/*!50001 DROP VIEW IF EXISTS `erreserba_zeinekegin_bista`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `erreserba_zeinekegin_bista` AS select `e`.`id_erreserba` AS `id_erreserba`,`b`.`izena` AS `cliente`,`k`.`izena` AS `clase`,`k`.`data` AS `data`,`k`.`sarrera_ordua` AS `sarrera_ordua`,`e`.`egoera` AS `egoera`,`e`.`checkin` AS `checkin` from ((`erreserbak` `e` join `bezeroak` `b` on(`e`.`id_bezeroa` = `b`.`id_bezeroa`)) join `klaseak` `k` on(`e`.`id_klasea` = `k`.`id_klasea`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `intzidentzia`
--

/*!50001 DROP VIEW IF EXISTS `intzidentzia`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `intzidentzia` AS select `m`.`izena` AS `maquina`,`i`.`data` AS `data`,`i`.`deskripzioa` AS `deskripzioa`,`l`.`izena` AS `tecnico` from ((`inzidentziak` `i` join `makinak` `m` on(`i`.`id_makina` = `m`.`id_makina`)) left join `langileak` `l` on(`i`.`id_langilea` = `l`.`id_langilea`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-03-16 11:39:01
