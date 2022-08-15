-- MySQL dump 10.13  Distrib 8.0.29, for Win64 (x86_64)
--
-- Host: localhost    Database: hight_light
-- ------------------------------------------------------
-- Server version	8.0.30-0ubuntu0.20.04.2

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
-- Table structure for table `lrc_personal_access_tokens`
--

DROP TABLE IF EXISTS `lrc_personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lrc_personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lrc_personal_access_tokens_token_unique` (`token`),
  KEY `lrc_personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lrc_personal_access_tokens`
--

LOCK TABLES `lrc_personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `lrc_personal_access_tokens` DISABLE KEYS */;
INSERT INTO `lrc_personal_access_tokens` VALUES (68,'App\\Models\\Front\\ShopCustomer',1,'authToken','a346875799b1d75471b96428b3c33b83d4d6d4d851ab4fe25b49c43d0f354d58','[\"*\"]',NULL,'2022-07-18 20:57:26','2022-07-18 20:57:26'),(76,'App\\Models\\Admin\\User',3,'token-name','4db6bbec6e6cb1d87b587dd51acdb61fda5e121907b67b1bce71af3ef8a98b05','[\"server:full\"]','2022-07-19 15:41:32','2022-07-19 15:39:47','2022-07-19 15:41:32'),(83,'App\\Models\\Admin\\User',2,'token-name','626df5323d8c28ef0560797762b7614cf1002ea9686c866066c624ba546a7bad','[\"server:full\"]','2022-07-27 22:15:25','2022-07-27 22:15:23','2022-07-27 22:15:25'),(86,'App\\Models\\Admin\\User',1,'token-name','a1e7e101236c3b5735700f00d72c28cb889be5cfe7db37ed0504ec88f2da9fa2','[\"server:full\"]','2022-07-28 21:43:31','2022-07-28 21:41:09','2022-07-28 21:43:31');
/*!40000 ALTER TABLE `lrc_personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-29 14:15:58
