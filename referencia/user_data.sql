-- MySQL dump 10.13  Distrib 8.0.39, for Linux (x86_64)
--
-- Host: localhost    Database: user_data
-- ------------------------------------------------------
-- Server version	8.0.39-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `login` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_id` int NOT NULL,
  `access_type` enum('user','manager','admin') NOT NULL,
  PRIMARY KEY (`username`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `login_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES ('admin','$2y$10$3xQhvVO9ghkdutu3PbHF7u2SeCbJMkkh/gbRs2g6xE6KYOdz132.y',5,'admin'),('manager','$2y$10$PWjPTRgyQ9oHVbrl/7X/Eu7W1N9BAjQp2UiFYpl7LG2ehcy80tS.a',4,'manager'),('test','$2y$10$VcndfCvJ4DJlEEPRrvnQuODrq8jnTlMOBS7wD2jOaEEK.xLlFGbcW',6,'user'),('user','$2y$10$t65NuMLs6JTCc.dn20MdrObFat.eGSFSpWLT23tXyk65evq7NV1RO',3,'user');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (3,'Joao','1234-5678','123.456.789-10','joao@email.com','0001-01-01'),(4,'Pedro','8765-4321','111.222.333-10','pedro@email.com','2024-10-15'),(5,'Fantini','1212-3434','123.123.123-12','fantini@teiacoltec.com','1932-10-21'),(6,'ab','1','1','a@a','1111-01-11');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_new`
--

DROP TABLE IF EXISTS `users_new`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_new` (
  `nome` varchar(45) NOT NULL,
  `telefone` varchar(45) DEFAULT NULL,
  `cpf` varchar(45) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_new`
--

LOCK TABLES `users_new` WRITE;
/*!40000 ALTER TABLE `users_new` DISABLE KEYS */;
INSERT INTO `users_new` VALUES ('João Silva','555-1234','123.456.789-00','1994-10-13','joao@example.com',1),('Maria Oliveira','555-5678','987.654.321-00','1999-10-13','maria@example.com',2),('Carlos Souza','555-9101','111.222.333-44','1984-10-13','carlos@example.com',3),('Ana Pereira','555-1122','222.333.444-55','1989-10-13','ana@example.com',4),('Lucas Lima','555-3344','333.444.555-66','1996-10-13','lucas@example.com',5);
/*!40000 ALTER TABLE `users_new` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-10-21 20:21:18
