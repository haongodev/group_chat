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
-- Table structure for table `lrc_admin_config`
--

DROP TABLE IF EXISTS `lrc_admin_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lrc_admin_config` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `group` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_id` int NOT NULL DEFAULT '0',
  `sort` int NOT NULL DEFAULT '0',
  `detail` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lrc_admin_config_key_store_id_unique` (`key`,`store_id`),
  KEY `lrc_admin_config_code_index` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lrc_admin_config`
--

LOCK TABLES `lrc_admin_config` WRITE;
/*!40000 ALTER TABLE `lrc_admin_config` DISABLE KEYS */;
INSERT INTO `lrc_admin_config` VALUES (1,'global','env_global','ADMIN_LOG','on',1,0,'lang::env.ADMIN_LOG'),(2,'global','env_global','ADMIN_LOG_EXP','',1,0,'lang::env.ADMIN_LOG_EXP'),(3,'global','env_global','ADMIN_FOOTER_OFF','0',1,0,'lang::env.ADMIN_FOOTER_OFF'),(4,'global','seo_config','url_seo_lang','0',1,1,'lang::seo.url_seo_lang'),(5,'global','webhook_config','LOG_SLACK_WEBHOOK_URL','',1,0,'lang::config.LOG_SLACK_WEBHOOK_URL'),(6,'global','webhook_config','GOOGLE_CHAT_WEBHOOK_URL','',1,0,'lang::config.GOOGLE_CHAT_WEBHOOK_URL'),(7,'global','webhook_config','CHATWORK_CHAT_WEBHOOK_URL','',1,0,'lang::config.CHATWORK_CHAT_WEBHOOK_URL'),(8,'global','api_config','api_connection_required','0',1,1,'lang::api_connection.api_connection_required'),(9,'global','cache','cache_status','0',1,0,'lang::cache.config_manager.cache_status'),(10,'global','cache','cache_time','600',1,0,'lang::cache.config_manager.cache_time'),(11,'global','cache','cache_category','0',1,3,'lang::cache.config_manager.cache_category'),(12,'global','cache','cache_product','0',1,4,'lang::cache.config_manager.cache_product'),(13,'global','cache','cache_news','0',1,5,'lang::cache.config_manager.cache_news'),(14,'global','cache','cache_category_cms','0',1,6,'lang::cache.config_manager.cache_category_cms'),(15,'global','cache','cache_content_cms','0',1,7,'lang::cache.config_manager.cache_content_cms'),(16,'global','cache','cache_page','0',1,8,'lang::cache.config_manager.cache_page'),(17,'global','cache','cache_country','0',1,10,'lang::cache.config_manager.cache_country'),(18,'global','env_mail','smtp_mode','',1,0,'lang::env.email.smtp_mode'),(19,'global','multiple_store','MultiStorePro','1',1,0,'lang::env.MULTI_STORE_PRO'),(20,'global','domain_strict','domain_strict','1',1,0,'lang::env.DOMAIN_STRICT'),(21,'Plugins','Payment','Cash','1',1,0,'Plugins/Payment/Cash::lang.title'),(22,'Plugins','Payment','BankTransfer','1',1,0,'Plugins/Payment/BankTransfer::lang.title'),(23,'Plugins','Shipping','ShippingStandard','1',1,0,'lang::Shipping Standard'),(24,'','product_config_attribute','product_brand','1',1,0,'lang::product.config_manager.brand'),(25,'','product_config_attribute_required','product_brand_required','0',1,0,''),(26,'','product_config_attribute','product_supplier','1',1,0,'lang::product.config_manager.supplier'),(27,'','product_config_attribute_required','product_supplier_required','0',1,0,''),(28,'','product_config_attribute','product_price','1',1,0,'lang::product.config_manager.price'),(29,'','product_config_attribute_required','product_price_required','1',1,0,''),(30,'','product_config_attribute','product_cost','1',1,0,'lang::product.config_manager.cost'),(31,'','product_config_attribute_required','product_cost_required','0',1,0,''),(32,'','product_config_attribute','product_promotion','1',1,0,'lang::product.config_manager.promotion'),(33,'','product_config_attribute_required','product_promotion_required','0',1,0,''),(34,'','product_config_attribute','product_stock','1',1,0,'lang::product.config_manager.stock'),(35,'','product_config_attribute_required','product_stock_required','0',1,0,''),(36,'','product_config_attribute','product_kind','1',1,0,'lang::product.config_manager.kind'),(37,'','product_config_attribute','product_property','1',1,0,'lang::product.config_manager.property'),(38,'','product_config_attribute_required','product_property_required','0',1,0,''),(39,'','product_config_attribute','product_attribute','1',1,0,'lang::product.config_manager.attribute'),(40,'','product_config_attribute_required','product_attribute_required','0',1,0,''),(41,'','product_config_attribute','product_available','1',1,0,'lang::product.config_manager.available'),(42,'','product_config_attribute_required','product_available_required','0',1,0,''),(43,'','product_config_attribute','product_weight','1',1,0,'lang::product.config_manager.weight'),(44,'','product_config_attribute_required','product_weight_required','0',1,0,''),(45,'','product_config_attribute','product_length','1',1,0,'lang::product.config_manager.length'),(46,'','product_config_attribute_required','product_length_required','0',1,0,''),(47,'','product_config','product_display_out_of_stock','1',1,19,'lang::admin.product_display_out_of_stock'),(48,'','product_config','show_date_available','1',1,21,'lang::admin.show_date_available'),(49,'','product_config','product_tax','1',1,0,'lang::product.config_manager.tax'),(50,'','customer_config_attribute','customer_lastname','1',1,1,'lang::customer.config_manager.lastname'),(51,'','customer_config_attribute_required','customer_lastname_required','1',1,1,''),(52,'','customer_config_attribute','customer_address1','1',1,2,'lang::customer.config_manager.address1'),(53,'','customer_config_attribute_required','customer_address1_required','1',1,2,''),(54,'','customer_config_attribute','customer_address2','1',1,2,'lang::customer.config_manager.address2'),(55,'','customer_config_attribute_required','customer_address2_required','1',1,2,''),(56,'','customer_config_attribute','customer_address3','0',1,2,'lang::customer.config_manager.address3'),(57,'','customer_config_attribute_required','customer_address3_required','0',1,2,''),(58,'','customer_config_attribute','customer_company','0',1,0,'lang::customer.config_manager.company'),(59,'','customer_config_attribute_required','customer_company_required','0',1,0,''),(60,'','customer_config_attribute','customer_postcode','0',1,0,'lang::customer.config_manager.postcode'),(61,'','customer_config_attribute_required','customer_postcode_required','0',1,0,''),(62,'','customer_config_attribute','customer_country','1',1,0,'lang::customer.config_manager.country'),(63,'','customer_config_attribute_required','customer_country_required','1',1,0,''),(64,'','customer_config_attribute','customer_group','0',1,0,'lang::customer.config_manager.group'),(65,'','customer_config_attribute_required','customer_group_required','0',1,0,''),(66,'','customer_config_attribute','customer_birthday','0',1,0,'lang::customer.config_manager.birthday'),(67,'','customer_config_attribute_required','customer_birthday_required','0',1,0,''),(68,'','customer_config_attribute','customer_sex','0',1,0,'lang::customer.config_manager.sex'),(69,'','customer_config_attribute_required','customer_sex_required','0',1,0,''),(70,'','customer_config_attribute','customer_phone','1',1,0,'lang::customer.config_manager.phone'),(71,'','customer_config_attribute_required','customer_phone_required','1',1,1,''),(72,'','customer_config_attribute','customer_name_kana','0',1,0,'lang::customer.config_manager.name_kana'),(73,'','customer_config_attribute_required','customer_name_kana_required','0',1,1,''),(74,'','admin_config','ADMIN_NAME','HLight Board',1,0,'lang::env.ADMIN_NAME'),(75,'','admin_config','ADMIN_TITLE','HLight',1,0,'lang::env.ADMIN_TITLE'),(76,'','admin_config','ADMIN_LOGO','api/system/getFile?disk=store&path=b_main.png',1,0,'lang::env.ADMIN_LOGO'),(77,'','display_config','product_top','8',1,0,'lang::admin.product_top'),(78,'','display_config','product_list','12',1,0,'lang::admin.list_product'),(79,'','display_config','product_relation','4',1,0,'lang::admin.relation_product'),(80,'','display_config','product_viewed','4',1,0,'lang::admin.viewed_product'),(81,'','display_config','item_list','12',1,0,'lang::admin.item_list'),(82,'','display_config','item_top','8',1,0,'lang::admin.item_top'),(83,'','display_config','product_sale','5',1,0,'lang::admin.sale_product'),(84,'','display_config','product_top_rated','8',1,0,'lang::admin.top_rated_product'),(85,'','display_config','product_most_buy','8',1,0,'lang::admin.most_buy_product'),(86,'','display_config','product_most_view','5',1,0,'lang::admin.most_buy_view'),(87,'','order_config','shop_allow_guest','1',1,11,'lang::order.admin.shop_allow_guest'),(88,'','order_config','product_preorder','1',1,18,'lang::order.admin.product_preorder'),(89,'','order_config','product_buy_out_of_stock','1',1,20,'lang::order.admin.product_buy_out_of_stock'),(90,'','order_config','shipping_off','0',1,20,'lang::order.admin.shipping_off'),(91,'','order_config','payment_off','0',1,20,'lang::order.admin.payment_off'),(92,'','email_action','email_action_mode','1',1,0,'lang::email.email_action.email_action_mode'),(93,'','email_action','email_action_queue','0',1,1,'lang::email.email_action.email_action_queue'),(94,'','email_action','order_success_to_admin','1',1,1,'lang::email.email_action.order_success_to_admin'),(95,'','email_action','order_success_to_customer','1',1,2,'lang::email.email_action.order_success_to_cutomer'),(96,'','email_action','order_success_to_customer_pdf','0',1,3,'lang::email.email_action.order_success_to_cutomer_pdf'),(97,'','email_action','customer_verify','0',1,4,'lang::email.email_action.customer_verify'),(98,'','email_action','welcome_customer','0',1,4,'lang::email.email_action.welcome_customer'),(99,'','email_action','contact_to_admin','1',1,6,'lang::email.email_action.contact_to_admin'),(100,'','smtp_config','smtp_host','',1,1,'lang::email.smtp_host'),(101,'','smtp_config','smtp_user','',1,2,'lang::email.smtp_user'),(102,'','smtp_config','smtp_password','',1,3,'lang::email.smtp_password'),(103,'','smtp_config','smtp_security','',1,4,'lang::email.smtp_security'),(104,'','smtp_config','smtp_port','',1,5,'lang::email.smtp_port'),(105,'','smtp_config','smtp_name','',1,6,'lang::email.smtp_name'),(106,'','smtp_config','smtp_from','',1,7,'lang::email.smtp_from'),(107,'','captcha_config','captcha_mode','0',1,20,'lang::captcha.captcha_mode'),(108,'','captcha_config','captcha_page','[]',1,10,'lang::captcha.captcha_page'),(109,'','captcha_config','captcha_method','',1,0,'lang::captcha.captcha_method'),(110,'','product_review','ProductReview','1',1,0,'lang::admin.product_review'),(112,'','display_config','product_latest','5',1,0,'lang::admin.product_latest');
/*!40000 ALTER TABLE `lrc_admin_config` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-29 14:16:01