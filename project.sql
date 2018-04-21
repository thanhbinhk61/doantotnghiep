-- MySQL dump 10.13  Distrib 5.7.20, for Linux (x86_64)
--
-- Host: localhost    Database: smartdevicevietnam
-- ------------------------------------------------------
-- Server version	5.7.20

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
-- Table structure for table `abilities`
--

DROP TABLE IF EXISTS `abilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `abilities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `entity_id` int(10) unsigned DEFAULT NULL,
  `entity_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `abilities_name_entity_id_entity_type_unique` (`name`,`entity_id`,`entity_type`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `abilities`
--

LOCK TABLES `abilities` WRITE;
/*!40000 ALTER TABLE `abilities` DISABLE KEYS */;
INSERT INTO `abilities` VALUES (1,'role-read',NULL,NULL,'2017-11-05 12:57:55','2017-11-05 12:57:55'),(2,'role-write',NULL,NULL,'2017-11-05 12:57:55','2017-11-05 12:57:55'),(3,'user-read',NULL,NULL,'2017-11-05 12:57:55','2017-11-05 12:57:55'),(4,'user-write',NULL,NULL,'2017-11-05 12:57:55','2017-11-05 12:57:55'),(5,'post-read',NULL,NULL,'2017-11-05 12:57:55','2017-11-05 12:57:55'),(6,'post-write',NULL,NULL,'2017-11-05 12:57:55','2017-11-05 12:57:55'),(7,'page-read',NULL,NULL,'2017-11-05 12:57:55','2017-11-05 12:57:55'),(8,'page-write',NULL,NULL,'2017-11-05 12:57:55','2017-11-05 12:57:55'),(9,'category-read',NULL,NULL,'2017-11-05 12:57:55','2017-11-05 12:57:55'),(10,'category-write',NULL,NULL,'2017-11-05 12:57:55','2017-11-05 12:57:55'),(11,'product-read',NULL,NULL,'2017-11-05 12:57:55','2017-11-05 12:57:55'),(12,'product-write',NULL,NULL,'2017-11-05 12:57:55','2017-11-05 12:57:55'),(13,'slide-read',NULL,NULL,'2017-11-05 12:57:55','2017-11-05 12:57:55'),(14,'slide-write',NULL,NULL,'2017-11-05 12:57:55','2017-11-05 12:57:55'),(15,'config-read',NULL,NULL,'2017-11-05 12:57:55','2017-11-05 12:57:55'),(16,'config-write',NULL,NULL,'2017-11-05 12:57:55','2017-11-05 12:57:55'),(17,'coupon-read',NULL,NULL,'2017-11-05 12:57:55','2017-11-05 12:57:55'),(18,'coupon-write',NULL,NULL,'2017-11-05 12:57:55','2017-11-05 12:57:55'),(19,'customer-read',NULL,NULL,'2017-11-05 12:57:55','2017-11-05 12:57:55'),(20,'customer-write',NULL,NULL,'2017-11-05 12:57:55','2017-11-05 12:57:55'),(21,'expense-read',NULL,NULL,'2017-11-05 12:57:55','2017-11-05 12:57:55'),(22,'expense-write',NULL,NULL,'2017-11-05 12:57:55','2017-11-05 12:57:55'),(23,'menu-read',NULL,NULL,'2017-11-05 12:57:55','2017-11-05 12:57:55'),(24,'menu-write',NULL,NULL,'2017-11-05 12:57:55','2017-11-05 12:57:55'),(25,'order-read',NULL,NULL,'2017-11-05 12:57:55','2017-11-05 12:57:55'),(26,'order-write',NULL,NULL,'2017-11-05 12:57:55','2017-11-05 12:57:55'),(27,'property-read',NULL,NULL,'2017-11-05 12:57:55','2017-11-05 12:57:55'),(28,'property-write',NULL,NULL,'2017-11-05 12:57:55','2017-11-05 12:57:55'),(29,'provider-read',NULL,NULL,'2017-11-05 12:57:55','2017-11-05 12:57:55'),(30,'provider-write',NULL,NULL,'2017-11-05 12:57:55','2017-11-05 12:57:55');
/*!40000 ALTER TABLE `abilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `addresses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expense_id` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `customer_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `addresses_expense_id_index` (`expense_id`),
  KEY `addresses_customer_id_index` (`customer_id`),
  CONSTRAINT `addresses_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addresses`
--

LOCK TABLES `addresses` WRITE;
/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cards`
--

DROP TABLE IF EXISTS `cards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cards` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bank` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cards_customer_id_index` (`customer_id`),
  CONSTRAINT `cards_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cards`
--

LOCK TABLES `cards` WRITE;
/*!40000 ALTER TABLE `cards` DISABLE KEYS */;
/*!40000 ALTER TABLE `cards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `icon_fa` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'fa-cog',
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `intro` text COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'product',
  `feature` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_parent_id_index` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Đầu Ghi Hình Camera','fa-cog','dau-ghi-hinh-camera','Đầu Ghi Hình Camera','','','','',0,1,'uploads/images/category/2017_11_09_10_44_15_270-ben-xvr1104c-1-1-533822.jpg','product',1,'2017-11-05 12:57:55','2017-11-09 15:50:46'),(2,'Camera Quan Sát','fa-cog','camera-quan-sat','Camera Quan Sát','Molestias odit dicta veniam repellendus amet voluptates et provident. Iure accusamus repellat occaecati a maiores odit. Nulla molestiae est corrupti. Quo amet sed ut maiores nihil ut nisi voluptatem.','','','',0,1,'uploads/images/category/2017_11_05_09_22_07_z772493856050-243f09e470b52e0e1bb58105dca3c651.jpg','product',1,'2017-11-05 12:57:55','2017-11-05 14:22:07'),(3,'Camera IP Wifi','fa-cog','camera-ip-wifi','Camera IP Wifi','Quos aspernatur numquam optio velit. Consequatur accusamus est harum cupiditate. Eius quibusdam enim facilis quam. Molestias assumenda iure perferendis excepturi.','','','',0,1,'uploads/images/category/2017_11_05_09_22_40_z772495152987-5af6501945b69b676f655144f24c1868.jpg','product',1,'2017-11-05 12:57:55','2017-11-05 14:22:40'),(4,'SmartBox TV','','smartbox-tv','SmartBox TV','','','','',0,0,'','product',1,'2017-11-05 14:25:12','2017-11-05 14:25:12');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_coupon`
--

DROP TABLE IF EXISTS `category_coupon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_coupon` (
  `category_id` int(10) unsigned NOT NULL,
  `coupon_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`category_id`,`coupon_id`),
  KEY `category_coupon_category_id_index` (`category_id`),
  KEY `category_coupon_coupon_id_index` (`coupon_id`),
  CONSTRAINT `category_coupon_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `category_coupon_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_coupon`
--

LOCK TABLES `category_coupon` WRITE;
/*!40000 ALTER TABLE `category_coupon` DISABLE KEYS */;
/*!40000 ALTER TABLE `category_coupon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_post`
--

DROP TABLE IF EXISTS `category_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_post` (
  `category_id` int(10) unsigned NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`category_id`,`post_id`),
  KEY `category_post_category_id_index` (`category_id`),
  KEY `category_post_post_id_index` (`post_id`),
  CONSTRAINT `category_post_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `category_post_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_post`
--

LOCK TABLES `category_post` WRITE;
/*!40000 ALTER TABLE `category_post` DISABLE KEYS */;
/*!40000 ALTER TABLE `category_post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_product`
--

DROP TABLE IF EXISTS `category_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_product` (
  `category_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`category_id`,`product_id`),
  KEY `category_product_category_id_index` (`category_id`),
  KEY `category_product_product_id_index` (`product_id`),
  CONSTRAINT `category_product_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `category_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_product`
--

LOCK TABLES `category_product` WRITE;
/*!40000 ALTER TABLE `category_product` DISABLE KEYS */;
INSERT INTO `category_product` VALUES (1,41),(1,42),(1,43),(1,44),(2,31),(2,32),(2,33),(2,34),(2,35),(2,36),(3,37),(3,38),(3,39),(3,40);
/*!40000 ALTER TABLE `category_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `vote` tinyint(4) NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_product_id_index` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,'','','','','',5,25,2,'2017-11-05 13:21:33','2017-11-05 13:21:33'),(2,'','','','','',2,25,2,'2017-11-05 13:21:45','2017-11-05 13:21:45'),(3,'','','','','',5,32,2,'2017-12-06 01:35:08','2017-12-06 01:35:08'),(4,'','','','','',5,44,2,'2018-02-19 01:22:18','2018-02-19 01:22:18');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configs`
--

DROP TABLE IF EXISTS `configs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `facebook` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `youtube` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `twitter` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timework` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `intro` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `banner_login` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `countdown` datetime NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `scripts` text COLLATE utf8_unicode_ci NOT NULL,
  `card_atm` text COLLATE utf8_unicode_ci NOT NULL,
  `label` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configs`
--

LOCK TABLES `configs` WRITE;
/*!40000 ALTER TABLE `configs` DISABLE KEYS */;
INSERT INTO `configs` VALUES (1,'Máy Tính DDH - Camera Giám Sát Benco','','','https://www.facebook.com/hai.dangminh.351','https://www.youtube.com/channel/UCvN_p_AUgmkb8xKtJZw6Keg?view_as=subscriber','https://twitter.com/','mrhaiit.pci@gmail.com','0912081319','Sóc Sơn - Hà Nội','Mọi ngày 8h Am đến 6h Pm','content','','uploads/images/config/2017_11_10_09_30_20_17410013-1201375699960046-1570289802-n.jpg','uploads/images/config/2017_11_09_10_01_32_17410013-1201375699960046-1570289802-n.jpg','uploads/images/config/2017_11_09_10_02_23_17410013-1201375699960046-1570289802-n.jpg','2017-11-05 07:57:55','','','','');
/*!40000 ALTER TABLE `configs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupon_codes`
--

DROP TABLE IF EXISTS `coupon_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coupon_codes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `coupon_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `coupon_codes_code_unique` (`code`),
  KEY `coupon_codes_coupon_id_index` (`coupon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupon_codes`
--

LOCK TABLES `coupon_codes` WRITE;
/*!40000 ALTER TABLE `coupon_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `coupon_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coupons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1',
  `value` int(11) NOT NULL,
  `min` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `expired_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_product`
--

DROP TABLE IF EXISTS `customer_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_product` (
  `customer_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`customer_id`,`product_id`),
  KEY `customer_product_customer_id_index` (`customer_id`),
  KEY `customer_product_product_id_index` (`product_id`),
  CONSTRAINT `customer_product_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `customer_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_product`
--

LOCK TABLES `customer_product` WRITE;
/*!40000 ALTER TABLE `customer_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `facebook_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `google_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` tinyint(4) NOT NULL DEFAULT '1',
  `age` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customers_category_id_index` (`category_id`),
  KEY `customers_provider_id_index` (`provider_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expenses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ship',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expenses`
--

LOCK TABLES `expenses` WRITE;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `section` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'head',
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'category',
  `parent_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menus_parent_id_index` (`parent_id`),
  KEY `menus_type_id_index` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (2,'Đầu Ghi Hình Camera','','left','category-product',0,1,'',1,'2017-11-05 14:23:50','2017-11-05 14:23:52'),(3,'Camera Quan Sát','','left','category-product',0,2,'',2,'2017-11-05 14:23:50','2017-11-05 14:23:52'),(4,'Camera IP Wifi','','left','category-product',0,3,'',3,'2017-11-05 14:23:50','2017-11-05 14:23:52'),(5,'SmartBox TV','','left','category-product',0,4,'',4,'2017-11-05 14:25:26','2017-11-05 14:25:27');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2016_01_25_104846_create_products_table',1),('2016_01_25_140347_create_categories_table',1),('2016_01_25_145126_create_posts_table',1),('2016_01_25_152016_create_category_post_pivot_table',1),('2016_01_25_163039_create_pages_table',1),('2016_01_25_170748_create_slides_table',1),('2016_01_25_181457_create_category_product_pivot_table',1),('2016_01_25_181922_create_product_images_table',1),('2016_01_26_033958_create_properties_table',1),('2016_01_26_045340_create_product_property_pivot_table',1),('2016_01_26_102130_create_configs_table',1),('2016_01_26_142941_create_menus_table',1),('2016_02_24_160129_create_providers_table',1),('2016_02_28_082921_create_comments_table',1),('2016_03_05_231417_create_contacts_table',1),('2016_03_13_095855_create_expenses_table',1),('2016_04_29_114807_create_customers_table',1),('2016_05_04_193204_create_customer_product_pivot_table',1),('2016_05_06_092057_create_coupons_table',1),('2016_05_06_112529_create_orders_table',1),('2016_05_06_114221_create_coupon_codes_table',1),('2016_05_07_002708_create_order_product_pivot_table',1),('2016_05_11_144042_create_addresses_table',1),('2016_05_17_100827_create_bouncer_tables',1),('2016_05_18_225612_create_category_coupon_pivot_table',1),('2016_05_30_234328_create_notifications_table',1),('2016_06_10_123252_create_cards_table',1),('2016_06_10_124510_create_ships_table',1),('2016_06_19_101132_create_registers_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sender_id` int(10) unsigned NOT NULL,
  `receiver_id` int(10) unsigned NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_sender_id_index` (`sender_id`),
  KEY `notifications_receiver_id_index` (`receiver_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_product`
--

DROP TABLE IF EXISTS `order_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_product` (
  `order_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `other` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`order_id`,`product_id`),
  KEY `order_product_order_id_index` (`order_id`),
  KEY `order_product_product_id_index` (`product_id`),
  KEY `order_product_provider_id_index` (`provider_id`),
  CONSTRAINT `order_product_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_product`
--

LOCK TABLES `order_product` WRITE;
/*!40000 ALTER TABLE `order_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `total` int(11) NOT NULL,
  `ship` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `card_id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `expense_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_code_unique` (`code`),
  KEY `orders_card_id_index` (`card_id`),
  KEY `orders_coupon_id_index` (`coupon_id`),
  KEY `orders_customer_id_index` (`customer_id`),
  KEY `orders_expense_id_index` (`expense_id`),
  KEY `orders_address_id_index` (`address_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pages_user_id_index` (`user_id`),
  CONSTRAINT `pages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `intro` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `tags` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_user_id_index` (`user_id`),
  CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_images_product_id_index` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_images`
--

LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
INSERT INTO `product_images` VALUES (1,'1488165544_img_6009.jpg','uploads/images/summernote/2017_11_09_08_33_09_1488165544-img-6009.jpg',0,1,'2017-11-09 13:33:09','2017-11-09 13:33:09'),(2,'1488165544_img_6009.jpg','uploads/images/summernote/2017_11_09_08_34_57_1488165544-img-6009.jpg',0,1,'2017-11-09 13:34:57','2017-11-09 13:34:57'),(3,'1488165544_img_6009.jpg','uploads/images/summernote/2017_11_09_08_35_00_1488165544-img-6009.jpg',0,2,'2017-11-09 13:35:00','2017-11-09 13:35:00');
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_property`
--

DROP TABLE IF EXISTS `product_property`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_property` (
  `property_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`property_id`,`product_id`),
  KEY `product_property_property_id_index` (`property_id`),
  KEY `product_property_product_id_index` (`product_id`),
  CONSTRAINT `product_property_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_property_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_property`
--

LOCK TABLES `product_property` WRITE;
/*!40000 ALTER TABLE `product_property` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_property` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `intro` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `tags` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `sale` tinyint(4) NOT NULL DEFAULT '1',
  `video` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price_sale` int(11) NOT NULL,
  `discount_price` int(11) NOT NULL DEFAULT '0',
  `discount_type` tinyint(4) NOT NULL DEFAULT '1',
  `quantity` int(11) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `brand_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `section` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_user_id_index` (`user_id`),
  KEY `products_brand_id_index` (`brand_id`),
  KEY `products_provider_id_index` (`provider_id`),
  CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (31,'0001','Camera  HD BEN-CVI1220BP','Camera quan sát HD BEN-CVI1220BP','','- Camera outdoor Full HD1080P, hồng ngoại 20m, IP67.\r\n- Cảm biến hình ảnh 1/2.7\" CMOS\r\n- Độ phân giải	1920(H)×1080(V), 2MP\r\n- Ống kính 3.6mm(6mm tùy chọn)\r\n- Góc mở hình ảnh H: 89.9°(59.4°)\r\n- Hồng ngoại	12 LED Microcrystalline','camera-hd-ben-cvi1220bp','uploads/images/product/2017_11_09_08_44_11_101-1120bp-720x720.jpg','- Camera outdoor Full HD1080P, hồng ngoại 20m, IP67.\r\n- Cảm biến hình ảnh 1/2.7\" CMOS\r\n- Độ phân giải	1920(H)×1080(V), 2MP\r\n- Ống kính 3.6mm(6mm tùy chọn)\r\n- Góc mở hình ảnh H: 89.9°(59.4°)\r\n- Hồng ngoại	12 LED Microcrystalline','<div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><strong>Camera quan sát HD BEN-CVI1220BP- CAMERA QUAN SÁT ĐƯỢC SẢN XUẤT ÁP DỤNG CÔNG NGHỆ HDCVI MỚI NHẤT !!!</strong><br><br>Camera quan sát HD BEN-CVI1220BP  là dòng camera quan sát thân hồng ngoại vỏ nhựa được thiết hiện đại và chắc chắn cho chất lượng hình ảnh nổi bật với độ phân giải cao, hỗ trợ chức năng chống chói sáng, hỗ trợ IP67 chống thời tiết xấu, bụi bẩn, quan sát ngày đêm tốt, phù hợp lắp đặt khu vực bên trong hoặc bên ngoài tại nhà ở, trường học, siêu thị, xí nghiệp, văn phòng, bệnh viện, trung tâm thương mại, v.v.....<br> </div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><img src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/27/03/14/1488164604_img_5783.jpg\" alt=\"Camera BEN-CVI1120BP\" width=\"1084\" height=\"722\" style=\"border-width: initial; border-style: none; max-width: 100%; height: auto;\"><br><em>                                                                                         </em></div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><em>                                                                                           Camera quan sát HD BEN-CVI1220BP</em></div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"> </div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><strong>- Góc quan sát rộng, chất lượng hình ảnh HD :</strong> Camera quan sát HD BEN-CVI1220BP có độ phân giải 2Mp sử dụng chip cảm biến CMOS thế hệ mới nhất.</div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><br><br> </div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><img src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/27/03/22/1488165139_img_5781.jpg\" alt=\"Bên ngoài hộp sản phẩm có dán tem sản xuất và thông số sản phẩm\" width=\"1082\" height=\"721\" style=\"border-width: initial; border-style: none; max-width: 100%; height: auto;\"><br><em>                                                   </em></div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><em>                                                                    Bên ngoài hộp sản phẩm có dán tem sản xuất và thông số sản phẩm</em><br> </div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><strong>- Thiết kế nhỏ gọn </strong>:Camera quan sát HD BEN-CVI1220BP được thiết kế nhỏ gọn tương đối bắt mắt với hình dáng đợn điệu nhưng không kém phần chắc chắn, thân hình trụ và phần chân đế hình tròn.</div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\">Chất liệu vỏ nhựa giúp camera giảm bớt khối lượng, nhẹ hơn khá nhiều so với các sản phẩm camera thân hồng ngoại khác trên thị trường. Phần vỏ ngoài bên trên mặt trước ống kính camera được</div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\">thiết kế nhô ra có chức năng giống như mái che của các sản phẩm camera ngoài trời khác giúp camera có thể hoạt động tốt không bị ảnh hưởng nhiều bởi các điều kiện thời tiết.<br> </div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><img src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/27/03/29/1488165544_img_6009.jpg\" alt=\"Camera thiết kế nhỏ gọn, đẹp mắt và khá chắc chắn\" width=\"1081\" height=\"720\" style=\"border-width: initial; border-style: none; max-width: 100%; height: auto;\"><br><em>                                                                 </em></div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><em>                                                                                 Camera thiết kế nhỏ gọn, đẹp mắt và khá chắc chắn</em><br><br><img src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/27/08/16/1488182754_img_5817.jpg\" alt=\"Mặt dưới camera có dán tem bảo hành chính hãng\" width=\"1084\" height=\"601\" style=\"border-width: initial; border-style: none; max-width: 100%; height: auto;\"><br><em>                                                                 </em></div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><em>                                                                                            Mặt dưới camera có dán tem bảo hành chính hãng</em></div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><br><strong>- Lắp đặt dễ dàng :</strong> Chân đế của Camera quan sát HD BEN-CVI1220BP có ba lỗ để bắt vít nở. Đặc biệt, phần chân đế có thể xoay ngang, dọc, lên xuống cho nhiều góc quan sát, đồng thời có thể ốp trần/tường với chân đế xoay 360 độ hoặc điều chỉnh lên xuống với góc xoay tới 90 độ. Cơ chế xoay linh hoạt của chân đế cho phép camera giám sát này có thể lắp đặt dễ dàng trên các bề mặt phẳng, cho các góc quan sát khác nhau.<br> </div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><img src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/27/08/06/1488182165_img_5807.jpg\" alt=\"Camera có thể điều chỉnh góc quay linh hoạt\" width=\"1083\" height=\"826\" style=\"border-width: initial; border-style: none; max-width: 100%; height: auto;\"><br><em>                                                                         </em></div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><em>                                                                                           Camera có thể điều chỉnh góc quay linh hoạt</em></div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><br><strong>- Chip cảm biến CMOS thế hệ mới nhất :</strong><strong> Camera quan sát HD BEN-CVI1220BP</strong> sở hữu ống kính quan sát 3.6mm – 6mm (tùy chọn), chip cảm biến hình ảnh CMOS của SONY độ phân giải 1MP và 12 đèn LED công nghệ Microcrystalline tiết kiệm điện năng và độ sáng gấp 2 lần đèn LED thường có thể quan sát ban đêm trong phạm vi 20 mét. <br> </div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><img src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/27/04/05/1488167681_img_6005.jpg\" alt=\"Mặt trước camera BEN-CVI1120BP\" width=\"1082\" height=\"721\" style=\"border-width: initial; border-style: none; max-width: 100%; height: auto;\"><br><em>                                                                         </em></div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><em>                                                                                     Mặt trước Camera HD 4K BEN-CVI 1220BP</em></div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><br><strong>- Chức năng DWDR : </strong>Nếu bạn bị gặp trở ngại về chất lượng hình ảnh quan sát tại lối ra vào bởi sự đối lập giữa ánh sáng và bóng râm rất rõ nét, dẫn đến việc nhận dạng khuôn mặt kém chất lượng. Với chức năng DWDR, Camera quan sát HD BEN-CVI1220BP  phù hợp cho các khu vực tiếp xúc ánh sáng quá nhiều và bóng râm, tăng sự nhận biết hình ảnh rõ nét và giảm tiếp xúc ánh sáng chói quá nhiều. Với đặc tính của DWDR, Bạn sẽ không bao giờ gặp phải những hình ảnh bị tối hay bị mờ.<br><br> </div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><img src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/27/04/26/1488168949_img_5568.jpg\" alt=\"Hình ảnh bộ phận cấu tạo bên trong camera BEN - CVI1120BP\" width=\"1084\" height=\"722\" style=\"border-width: initial; border-style: none; max-width: 100%; height: auto;\"><br><em>                                             </em></div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><em>                                                                 Hình ảnh bộ phận cấu tạo bên trong Camera quan sát HD BEN-CVI1220BP</em></div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"> </div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><img src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/27/04/07/1488167805_img_5562.jpg\" alt=\"Camera trang bị 12 LED công nghệ Microcrystalline \" width=\"1085\" height=\"723\" style=\"border-width: initial; border-style: none; max-width: 100%; height: auto;\"><br><em>                                                           </em></div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><em>                                                                             Camera trang bị 12 LED công nghệ cao Microcrystalline </em><br><br><img src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/27/04/09/1488167933_img_5557.jpg\" alt=\"Hình ảnh bo mạch camera BEN - CVI1120BP\" width=\"1082\" height=\"721\" style=\"border-width: initial; border-style: none; max-width: 100%; height: auto;\"><br><em>                                                                     </em></div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><em>                                                                                    Hình ảnh bo mạch Camera quan sát HD BEN-CVI1220BP</em></div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><br><br><strong>- Tính năng nổi bật :</strong> Camera HD 4K BEN-CVI 1220BP có độ phân giải HD720P, cho phân giải HD trên tín hiệu đường dây analog, khoảng cách truyền tải trên cáp đồng trục lên đến 800m. Camera quan sát HD BEN-CVI1220BP  hỗ trợ nhiều tính năng tốt như chế độ ngày đêm(ICR), tự động cân bằng trắng (AWB), tự động bù sáng (AGC), chống ngược sáng(BLC), chống nhiễu (3D-DNR). Công nghệ IR cut lọc ánh sáng hồng ngoại làm tăng độ thật của hình ảnh vào ban đêm, kểt hợp với tính năng BLC tự động gia tăng các chi tiết trong vùng tối hơn của hình ảnh khi nguồn sáng chiếu từ phía sau nó làm mờ vật quan sát giúp cho bạn quan sát mọi vật rõ nét hơn, tăng hiệu quả giám sát ngay cả vào ban đêm. Kết hợp cổng ra BNC cho hình ảnh sắc nét, đường truyền liên tục, không bị ngắt quãng.<br><br> </div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><img src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/27/08/21/1488183044_camera-1.jpg\" alt=\"Hình ảnh ban ngày trích xuất từ camera BEN - CVI1120BP\" width=\"1083\" height=\"609\" style=\"border-width: initial; border-style: none; max-width: 100%; height: auto;\"><br><em>                                                       </em></div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><em>                                                        Hình ảnh ban ngày trích xuất từ Camera quan sát HD BEN-CVI1220BP</em><br><br><img src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/27/08/22/1488183116_camera-2.jpg\" alt=\"Hình ảnh ban đêm trích xuất từ camera BEN - CVI1120BP\" width=\"809\" height=\"455\" style=\"border-width: initial; border-style: none; max-width: 100%; height: auto;\"><br><em>                                                         </em></div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><em>                                                                Hình ảnh ban đêm trích xuất từ Camera quan sát HD BEN-CVI1220BP</em></div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"> </div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><em>-</em> <strong>Ứng  dụng nổi bật của Camera quan sát HD BEN-CVI1220BP </strong>: Là sản phẩm được tích hợp nhiều ưu điểm, ứng dụng của Camera khá đa dạng cho nhiều địa điểm, bên ngoài căn hộ, chỗ để xe, cổng ra vào....</div>','',980000,1,'',0,0,1,5,2,0,0,1,1,'2017-11-09 13:37:14','2017-11-09 14:03:31'),(32,'0002','Camera 4K BEN-CVI1420BP','Camera 4K BEN-CVI1420BP','','CAMERA HDCVI BEN-CVI1420BP THÂN HỒNG NGOẠI ĐỘ PHÂN GIẢI 1/3’’ 4K , SẮC – NÉT ĐẾN TỪNG CHI TIẾT …','camera-4k-ben-cvi1420bp','uploads/images/product/2017_11_09_08_43_27_249-camera-4k-ben-cvi1420bp.jpg','CAMERA HDCVI BEN-CVI1420BP THÂN HỒNG NGOẠI ĐỘ PHÂN GIẢI 1/3’’ 4K , SẮC – NÉT ĐẾN TỪNG CHI TIẾT …','<p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><br></p>','',1550000,1,'',0,0,1,5,2,0,0,1,1,'2017-11-09 13:43:27','2017-11-09 13:43:27'),(33,'0003','Camera 4K BEN-CVI1420DP','Camera 4K BEN-CVI1420DP','','CAMERA QUAN SÁT HDCVI BEN-CVI1420DP CÔNG NGHỆ 4K, QUAN SÁT SẮC NÉT ĐẾN TỪNG CHI TIẾT …\r\n','camera-4k-ben-cvi1420dp','uploads/images/product/2017_11_09_08_46_32_250-camera-4k-ben-cvi1420dp-1-1-663860.jpg','CAMERA QUAN SÁT HDCVI BEN-CVI1420DP CÔNG NGHỆ 4K, QUAN SÁT SẮC NÉT ĐẾN TỪNG CHI TIẾT …\r\n','','',1550000,1,'',5,0,1,0,2,0,0,1,1,'2017-11-09 13:46:32','2017-11-09 13:46:32'),(34,'0004','Camera 4K BEN-CVI1430BM','Camera 4K BEN-CVI1430BM','','-Camera BEN-CVI1480BM được thiết kế liền khối có thể chống bụi/nước đạt chuẩn IP67.\r\n- vỏ được sơn tĩnh điện.\r\n','camera-4k-ben-cvi1430bm','uploads/images/product/2017_11_09_08_48_14_68-camera-4k-ben-cvi1430bm.jpg','-Camera BEN-CVI1480BM được thiết kế liền khối có thể chống bụi/nước đạt chuẩn IP67.\r\n- vỏ được sơn tĩnh điện.\r\n','<p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><strong>CAME HD 4K BEN-CVI 1480BM – CAMERA QUAN SÁT CHẤT LƯỢNG HD720, CỰ LI HỒNG NGOẠI LÊN TỚI&nbsp;80M !!!</strong></p><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\">Đây là camera giám sát nhắm đến đối tượng người dùng là văn phòng và nhà xưởng, nhà máy, doanh nghiệp lớn, bãi xe ,….vừa và lớn, được thiết kế sang trọng,</div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\">chắc chắn, có khả năng chống nước, chống bụi và chất lượng hình ảnh khá rõ 720HD.</div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><br>&nbsp;</div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><img src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/28/02/40/1488248961_12.jpg\" alt=\"Trọn bộ sản phẩm camera BEN-CVI1180BM\" width=\"871\" height=\"580\" style=\"border-width: initial; border-style: none; max-width: 100%; height: auto;\"></div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><em>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</em></div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><em>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Sản phẩm gồm: Camera HD 4K BEN-CVI1430BM&nbsp;, phiếu bảo hành, lục lăng và vít nơ để lắp đặt.</em></div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><br><strong>- Thiết kế sang trọng :</strong>&nbsp;<strong>BEN-CVI1480BM</strong>&nbsp;được thiết kế liền khối vỏ bằng chất liệu kim loại và phủ lớp sơn màu trắng bên ngoài.<br>Mặc dù có thiết kế chống bụi và nước nhưng hình thức của camera vẫn đảm bảo được tính thẩm mỹ để lắp đặt ở hầu hết các vị trí bên ngoài ngôi nhà.<br><br>&nbsp;</div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><img src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/28/02/48/1488249448_img_4918.jpg\" alt=\"Camera có màu trắng trông chắc chắn và sang trọng\" width=\"866\" height=\"577\" style=\"border-width: initial; border-style: none; max-width: 100%; height: auto;\"></div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><em>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</em></div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><em>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Camera HD 4K BEN-CVI1430BM&nbsp;&nbsp;có màu trắng trông chắc chắn và sang trọng</em></div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><br><strong>- Lắp đặt dễ dàng :</strong>&nbsp;&nbsp;Chân đế của&nbsp;<a href=\"http://benco.vn/ben-cvi-1180bm-1-1-533567.html\" style=\"color: rgb(51, 51, 51);\">camera HD 4K BEN-CVI 1480BM</a>&nbsp;có ba lỗ để bắt vít nở. Đặc biệt, phần chân đế có thể xoay ngang, dọc, lên xuống cho nhiều góc quan sát,</div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\">đồng thời có thể ốp trần/tường với chân đế xoay 360 độ hoặc điều chỉnh lên xuống với góc xoay tới 90 độ. Cơ chế xoay linh hoạt của chân đế cho phép&nbsp;</div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><a href=\"https://mtel.vn/camera-quan-sat.html\" style=\"color: rgb(51, 51, 51);\">camera giám sát</a>&nbsp;này có thể lắp đặt ở hầu hết các loại địa hình khác nhau.</div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\">&nbsp;</div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><img src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/28/01/54/1488246214_6.jpg\" alt=\"Chân đế xoay linh hoạt cho phép camera có thể lắp ráp ở hầu như mọi địa hình\" width=\"863\" height=\"627\" style=\"border-width: initial; border-style: none; max-width: 100%; height: auto;\"></div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><em>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</em></div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><em>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Chân đế xoay linh hoạt cho phép camera có thể lắp ráp ở hầu như mọi địa hình</em><br><br><img src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/28/02/58/1488250044_15.jpg\" alt=\"Khớp nối chân camera\" width=\"861\" height=\"634\" style=\"border-width: initial; border-style: none; max-width: 100%; height: auto;\"><br><em>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</em></div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><em>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Khớp nối chân cCamera HD 4K BEN-CVI1430BM&nbsp; được vít chặt chẽ và dễ dàng tháo lắp nhờ thiết bị tháo lắp chuyên dụng</em><br>&nbsp;</div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><strong>- Thiết kế đạt chuẩn IP67 :</strong>&nbsp;Camera HD 4K BEN-CVI1430BM&nbsp;&nbsp;được thiết kế liền khối có thể chống bụi/nước đạt chuẩn IP67 và vỏ được sơn tĩnh điện để chống lại các</div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\">điều kiện ngoài môi trường như: nắng nóng, bụi bẩn, chống nước, làm tăng khả năng chịu mòn bởi hóa chất hoặc bị ảnh hưởng của tác nhân hóa học hay thời tiết.<br>&nbsp;</div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><img src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/28/02/50/1488249574_13.jpg\" alt=\"Camera có mái che chống lại các tác nhân gây hại từ môi trường\" width=\"861\" height=\"556\" style=\"border-width: initial; border-style: none; max-width: 100%; height: auto;\"><br><em>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</em></div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><em>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Camera HD 4K BEN-CVI1430BM&nbsp; có mái che chống lại các tác nhân gây hại từ môi trường</em></div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\">&nbsp;</div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><strong>- Chip cảm biến CMOS thế hệ mới nhất&nbsp;</strong>&nbsp;: Camera HD 4K BEN-CVI1430BM&nbsp;&nbsp;được trang bị ống kính quan sát 3.6mm – (6mm, 8mm tùy chọn), chip cảm biến hình ảnh</div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\">CMOS của SONY độ phân giải 1MP và 2 đèn LED hồng ngoại LXIR để quan sát ban đêm trong phạm vi lên tới 80 m(262ft)<br>&nbsp;</div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><img src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/28/02/10/1488247164_img_5018.jpg\" alt=\"Camera sử dụng 2 đèn LED để quan sát hồng ngoại vào ban đêm\" width=\"860\" height=\"572\" style=\"border-width: initial; border-style: none; max-width: 100%; height: auto;\"></div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><em>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</em></div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><em>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Camera HD 4K BEN-CVI1430BM&nbsp;&nbsp;sử dụng 2 đèn LED để quan sát hồng ngoại vào ban đêm</em><br>&nbsp;</div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><strong>- Đặc điểm nổi bật :</strong>&nbsp;<strong>BEN-CVI1480BM</strong>&nbsp;hỗ trợ nhiều tính năng tốt như chế độ ngày đêm(ICR), khoảng cách nhìn đêm 80m(262ft) - góc quan sát 72.3độ (46/34.8 độ)</div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\">giúp quan sát dễ dàng và được trang bị thêm các tính năng DWDR tự động điều chỉnh cường độ hồng ngoại cho khả năng giám sát tốt, xử lý vấn đề chói hồng ngoại</div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\">ở cự ly gần, tự động bù sáng (AGC), chống ánh đèn pha cực mạnh vào ban đêm (HLC), chống ngược sáng(BLC)<br>&nbsp;</div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><img src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/28/03/45/1488252862_18.jpg\" alt=\"2 Đèn LED LXIR\" width=\"865\" height=\"584\" style=\"border-width: initial; border-style: none; max-width: 100%; height: auto;\"></div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\">&nbsp;</div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><strong>- Tính năng giảm nhiễu 2D:</strong>&nbsp;mang lại chất lượng hình ảnh rõ ràng hơn nhiều, đặc biệt là trong tình huống ánh sáng thấp, nơi nhiễu hình.</div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><br><img src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/28/03/45/1488252917_17.jpg\" alt=\"Bo mạch camera\" width=\"864\" height=\"552\" style=\"border-width: initial; border-style: none; max-width: 100%; height: auto;\"><br><em>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</em></div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><em>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Bo mạch&nbsp;Camera HD 4K BEN-CVI1430BM&nbsp;</em></div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><br>Sau khi lắp đặt, hình ảnh từ camera được truyền về đầu ghi và ổ cứng lưu trữ qua cáp đồng trục với phạm vi lên tới 500 mét. Người dùng có thể theo dõi và giám</div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\">sát căn hộ, cửa hàng, văn phòng… của mình cả ngày qua mạng Internet thông qua các thiết bị như smartphone, tablet, PC hay laptop không giới hạn khoảng cách,</div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\">chỉ cần có kết nối Internet ổn định. Nếu tốc độ mạng cao và ổn định, hình ảnh quan sát qua các thiết bị di động hiển thị mượt, không bị giật và trễ hình.<br><br><br>&nbsp;</div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><img src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/28/03/47/1488252987_19.jpg\" alt=\"Hình ảnh camera sau khi lắp đặt xong\" width=\"864\" height=\"576\" style=\"border-width: initial; border-style: none; max-width: 100%; height: auto;\"></div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\">&nbsp;</div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\">Trong thời đại smartphone, chúng ta đã quá quen với những độ phân giải 8, 13, 16 và 20MP nên con số 1MP của camera giám sát BEN-CVI1480BM có thể sẽ</div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\">khiến bạn lo ngại. Song thực tế, các camera quan sát đều có độ phân giải thấp, phổ biến là 1MP (HD) đến cao là 4MP (Full-HD). Với&nbsp;<a href=\"http://benco.vn/ben-cvi-1180bm-1-1-533567.html\" style=\"color: rgb(51, 51, 51);\">BEN-CVI 1480BM</a>, chất lượng</div><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\">hình ảnh vào ban ngày nhìn khá sắc nét, đủ thấy rõ khuôn mặt người và hình ảnh chuyển động với độ trễ thấp.</div>','',2550000,1,'',5,0,1,5,2,0,0,1,1,'2017-11-09 13:48:14','2017-11-09 13:48:52'),(35,'0005','Camera 4K BEN-CVI1430DM','Camera 4K BEN-CVI1430DM','','Camera HD-CVI thân hồng ngoại Độ phân giải 1/3\" 4K\r\n1/3\" CMOS 4K, hiển thị hình ảnh 3840x2160(V)\r\nThời gian thực không trễ hình.\r\nĐộ nhạy sáng tối thiểu 0.03Lux/F1.5, 0Lux IR on.\r\nChế độ ngày đêm(ICR)\r\nTự động cân bằng trắng (AWB)\r\nTự động bù sáng (AGC)\r\n','camera-4k-ben-cvi1430dm','uploads/images/product/2017_11_09_08_50_41_250-camera-4k-ben-cvi1420dp-1-1-663860.jpg','Camera HD-CVI thân hồng ngoại Độ phân giải 1/3\" 4K\r\n1/3\" CMOS 4K, hiển thị hình ảnh 3840x2160(V)\r\nThời gian thực không trễ hình.\r\nĐộ nhạy sáng tối thiểu 0.03Lux/F1.5, 0Lux IR on.\r\nChế độ ngày đêm(ICR)\r\nTự động cân bằng trắng (AWB)\r\nTự động bù sáng (AGC)\r\n','','',2550000,1,'',0,0,1,5,2,0,0,1,1,'2017-11-09 13:50:41','2017-11-09 13:50:41'),(36,'0006','Camera 4K BEN-CVi1480BM','Camera 4K BEN-CVi1480BM','','Camera HD-CVI thân hồng ngoại Độ phân giải 1/3\" 4K\r\n1/3\" CMOS 4K, hiển thị hình ảnh 3840x2160(V) \r\nThời gian thực không trễ hình.\r\nĐộ nhạy sáng tối thiểu 0.03Lux/F1.5, 0Lux IR on\r\nChế độ ngày đêm(ICR)\r\nTự động cân bằng trắng (AWB)\r\nTự động bù sáng (AGC)\r\n','camera-4k-ben-cvi1480bm','uploads/images/product/2017_11_09_08_53_06_246-camera-4k-ben-cvi1480bm.jpg','Camera HD-CVI thân hồng ngoại Độ phân giải 1/3\" 4K\r\n1/3\" CMOS 4K, hiển thị hình ảnh 3840x2160(V) \r\nThời gian thực không trễ hình.\r\nĐộ nhạy sáng tối thiểu 0.03Lux/F1.5, 0Lux IR on\r\nChế độ ngày đêm(ICR)\r\nTự động cân bằng trắng (AWB)\r\nTự động bù sáng (AGC)\r\n','','',2950000,1,'',0,0,1,5,2,0,0,1,1,'2017-11-09 13:53:06','2017-11-09 13:53:06'),(37,'0007','Benco BEN-IPC1110CHW 1.3Mp','Benco BEN-IPC1110CHW 1.3Mp','','','benco-ben-ipc1110chw-1-3mp','uploads/images/product/2017_11_09_09_08_12_ben-22222-600x600.jpg','','<p>\'Độ phân giải 1/3” 1.3Megapixel CMOS 25/30fps@1.3P(1280×960),&nbsp; độ nhạy sáng tối thiểu 1.96lux/F1.2(color),0lux/F1.2(IR on), chế độ ngày đêm(ICR), chống ngược sáng DWDR, tự động cân bằng trắng (AWB), tự động bù sáng (AGC), chống ngược sáng(BLC), Chống nhiễu (3D-DNR) , tầm xa hồng ngoại 10m với công nghệ hồng ngoại thông minh, ống kính cố định 2,3mm cho góc nhiền rộng lên đến 125 độ, tích hợp míc và loa với chuẩn âm thanh G.711a / G.711u / PCM , đàm thoại hai chiều, hỗ trợ khe cắm thẻ nhớ Micro SD, Max 128GB, tích hợp&nbsp; Wi-Fi(IEEE802.11b/g/n) hỗ trợ P2P,chuẩn tương thích ONVIF, điện áp DC5V 1A , công suất &lt;4,5W，chất liệu vỏ plastic， môi trường làm việc từ -30°C~+60°C，kích thước 76mm*65mm*107mm，trọng lượng 0.14KG&nbsp;<br></p>','',1960000,1,'',0,0,1,5,2,0,0,1,1,'2017-11-09 14:08:12','2017-11-09 14:08:12'),(38,'0008','Camera Wifi BEN-IPC1310CHW 3MP','Camera Wifi BEN-IPC1310CHW 3MP','','','camera-wifi-ben-ipc1310chw-3mp','uploads/images/product/2017_11_09_09_10_07_300-ben-ipc1310chw-1-1-533935.jpg','','<p><span style=\"font-family: &quot;Roboto Condensed&quot;, arial, Helvetica, sans-serif; font-size: 14px; text-align: justify;\">Đây là một trong số các sản phẩm camera giám sát không dây mới của BENCO Việt Nam vừa ra mắt thị trường Việt Nam.&nbsp;<a href=\"http://benco.vn/ben-ipc1310chw-1-1-533935.html\" class=\"current\" style=\"color: rgb(51, 51, 51);\">Camera BEN-IPC1310CHW</a>&nbsp;có thiết kế để lắp đặt dễ dàng, sử dụng mạng Wi-Fi và người dùng có thể tương tác 2 chiều trực tiếp ngay trên smartphone hoặc máy tính bảng để giám sát từ bất kỳ đâu. Sản phẩm hiện có giá bán trên thị trường rơi vào khoảng 2,3 triệu đồng, nhắm tới đối tượng khách hàng sử dụng lắp đặt tại các văn phòng, cửa hàng và hộ gia đình.</span><br style=\"color: rgb(102, 102, 102); font-family: &quot;Roboto Condensed&quot;, arial, Helvetica, sans-serif; font-size: 14px; text-align: justify;\"><span style=\"color: rgb(102, 102, 102); font-family: &quot;Roboto Condensed&quot;, arial, Helvetica, sans-serif; font-size: 14px; text-align: justify;\">&nbsp;</span><br></p>','',2300000,1,'',0,0,1,0,2,0,0,1,1,'2017-11-09 14:10:07','2017-11-09 14:10:07'),(39,'0009','Camera Wifi BEN-IPC1110DHPTW 1.3MP','Camera Wifi BEN-IPC1110DHPTW 1.3MP','','','camera-wifi-ben-ipc1110dhptw-1-3mp','uploads/images/product/2017_11_09_09_12_26_299-1110dhptw-720x720.png','','<p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif; text-align: justify;\"><span style=\"color: rgb(0, 0, 0);\"><span style=\"font-size: 18px;\"><strong>CAMERA HOME WIFI BEN-IPC1110DHPTW - CAMERA KHÔNG DÂY DÀNH CHO CÁC HỘ GIA ĐÌNH !!!</strong></span><br><br>Đây là một trong số các sản phẩm&nbsp;</span><a href=\"http://camera.pro.vn/\" style=\"box-sizing: inherit; color: rgb(0, 105, 163); outline: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; transition-property: background-color, border-color, color, opacity; transition-duration: 0.3s;\"><span style=\"color: rgb(0, 0, 0);\">camera giám sát</span></a><span style=\"color: rgb(0, 0, 0);\">&nbsp;không dây mới của thương hiệu&nbsp;camera BENCO vừa ra mắt thị trường Việt Nam. Camera&nbsp;</span><a href=\"http://benco.vn/ben-ipc1110dhptw-1-1-533937.html\" style=\"color: rgb(0, 105, 163); outline: 0px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; transition-property: background-color, border-color, color, opacity; transition-duration: 0.3s;\"><span style=\"color: rgb(0, 0, 0);\">BEN - IPC1110DHPTW</span></a><span style=\"color: rgb(0, 0, 0);\">&nbsp;là mẫu camera Dome Wifi trong nhà&nbsp;có thiết kế để lắp đặt đơn giản, sử dụng mạng Wi-Fi hoặc mạng dây và có thể điều khiển trực tiếp ngay trên smartphone và máy tính bảng để giám sát từ bất kỳ đâu.</span></p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif; text-align: center;\"><span style=\"color: rgb(0, 0, 0);\">&nbsp;<img alt=\"\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/13/02/41/1486953080_ben-ipc1110dhptw1.jpg.jpg\" style=\"max-width: 100%; height: 478px; width: 720px;\"></span></p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif; text-align: justify;\"><span style=\"color: rgb(0, 0, 0);\">Sản phẩm camera&nbsp;<strong>BEN-IPC1110DHPTW&nbsp;</strong>được sản xuất ra&nbsp;nhắm tới đối tượng khách hàng là các văn phòng, cửa hàng và hộ gia đình.&nbsp;Những chiếc camera phù hợp với hộ gia đình, cửa hàng nhỏ lẻ… thường là mẫu camera IP bởi ưu điểm nhỏ gọn, dễ lắp đặt, tiện sử dụng và khả năng tương tác hai chiều tốt.&nbsp;</span></p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif; text-align: center;\"><span style=\"color: rgb(0, 0, 0);\">&nbsp;<img alt=\"\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/13/02/42/1486953126_ben-ipc1110dhptw2.jpg.jpg\" style=\"max-width: 100%; height: 573px; width: 720px;\"></span><br>&nbsp;</p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif; text-align: justify;\"><span style=\"color: rgb(0, 0, 0);\">Camera IP (Internet Protocol) là loại camera có địa chỉ IP mạng để kết nối với mạng Internet và cho phép người dùng quan sát hình ảnh trực tiếp, ghi hình hoặc tương tác hai chiều.&nbsp;Camera&nbsp;<strong>BEN-IPC1110DHPTW&nbsp;</strong>có hình thức khá đẹp mắt với hai tông màu chủ đạo trắng, đen.&nbsp;Trọn bộ sản phẩm Camera này&nbsp;bao gồm camera, nguồn sạc, ốc vít và hướng dẫn sử dụng.</span></p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif; text-align: justify;\">&nbsp;</p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif; text-align: center;\"><span style=\"color: rgb(0, 0, 0);\">&nbsp;<img alt=\"Trọn bộ sản phẩm camera \" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/13/01/29/1486948782_img_5383.jpg\" style=\"max-width: 100%; height: 398px; width: 720px;\"><br><em>Trọn bộ sản phẩm&nbsp;Camera&nbsp;<strong>BEN-IPC1110DHPTW</strong></em></span></p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif; text-align: justify;\"><span style=\"color: rgb(0, 0, 0);\"><span style=\"font-size: 16px;\"><strong>- Thiết kế nhỏ gọn</strong>:</span>&nbsp;<strong>BEN-IPC1110DHPTW</strong>&nbsp;được thiết kế &nbsp;tổng thể tương đối giống như nhiều mẫu camera IP trên thị trường với phần thân bên trên tròn lắp ráp với phần đế bên dưới có mặt đáy phẳng. Kích thước của nó là 94×94 mm, trọng lượng 215g, nhỏ nhẹ hơn nhiều&nbsp;mẫu camera IP khác trên thị trường&nbsp;và có thể dễ dàng lắp đặt ở bất kì không gian nào. &nbsp;</span></p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif; text-align: justify;\">&nbsp;</p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif; text-align: center;\"><span style=\"color: rgb(0, 0, 0);\">&nbsp;<img alt=\"Camera BEN-IPC1110DHPTW được thiết kế nhỏ gọn và đẹp mắt\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/13/01/35/1486949134_img_5391.jpg\" style=\"max-width: 100%; height: 517px; width: 720px;\"><br>Camera BEN-IPC1110DHPTW được thiết kế nhỏ gọn và đẹp mắt</span></p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif; text-align: justify;\"><span style=\"color: rgb(0, 0, 0);\"><span style=\"font-size: 16px;\">-&nbsp;<strong>Chip cảm biến CMOS thế hệ mới nhất</strong></span>&nbsp;:&nbsp;<strong>BEN-IPC1110DHPTW</strong>&nbsp;có độ phân giản 1.3Mp dùng chip cảm biến CMOS của sonycho chất lượng hình ảnh HD720(1280x960). Sử dụng ống kinh 3.6mm tiêu cự F2.0 cho góc quan sát khá rộng, lên tới 77 độ.&nbsp; Nhờ sử dụng công nghệ IRC và được trang bị tính năng DWDR cho hình ảnh sắc nét, trong sạch vào ban ngày và rõ ràng vào ban đêm<br><span style=\"font-size: 16px;\">-<strong>&nbsp;Chuẩn nén hình ảnh H.264</strong></span>&nbsp;:&nbsp;Với cách nén và truyền thông tin bằng chuẩn H.264 giúp tiết kiệm đến 50% băng thông và kích thước file dữ liệu lưu trữ , do đó chi phí cho lưu trữ dữ liệu video giảm mọt nửa só với dùng hệ thống chuẩn nén thông thường.<br><span style=\"font-size: 16px;\"><strong>- Tính năng nổi bật</strong>&nbsp;:</span>&nbsp;<strong>BEN-IPC1110DHPTW</strong><span style=\"font-family: &quot;roboto condensed&quot;, arial, helvetica, sans-serif; font-size: 14px;\">&nbsp;có khả năng tự động chuyển đổi chế độ quan sát ngày /đêm(ICR), khoảng cách nhìn đêm lên tới 10m, cự li hồng ngoại lên tới 10m(33ft) quan sát rõ ràng và được trang bị thêm các tính năng DWDR tự động điều chỉnh cường độ hồng ngoại cho khả năng giám sát tốt, xử lý vấn đề chói hồng ngoại ở cự li gần (hiện tượng đèn hồng ngoại chiếu quá sáng ở phần giữa hình ảnh)&nbsp;</span></span></p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif; text-align: center;\"><span style=\"color: rgb(0, 0, 0);\">&nbsp;<img alt=\"\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/13/06/54/1486968279_1100-ip.jpg\" style=\"max-width: 100%; height: 398px; width: 720px;\"><br><em>Thông số kỹ thuật của camera BEN - IPC1110DHPTW</em></span></p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><span style=\"color: rgb(0, 0, 0);\"><span style=\"font-size: 16px;\"><strong>- &nbsp;Góc xoay quan sát dễ dàng</strong>&nbsp;</span>:Camera&nbsp;<strong>BEN-IPC1110DHPTW&nbsp;</strong>có góc xoay ngang 0-335 độ, Dọc lên tới 90 độ, có thể xoay tùy chỉnh, nhờ vậy bạn có thể quan sát được gần tất cả mọi thứ trong căn phòng của bạn.</span></p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif; text-align: center;\"><span style=\"color: rgb(0, 0, 0);\">&nbsp;<img alt=\"\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/13/02/44/1486953275_img_3377.jpg\" style=\"max-width: 100%; height: 480px; width: 720px;\"></span><br>&nbsp;</p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif; text-align: justify;\"><span style=\"color: rgb(0, 0, 0);\"><span style=\"font-size: 16px;\"><strong>- Hỗ trợ kết nối wifi :</strong></span>&nbsp;Phía sau của phần chân camera có cổng kết nối LAN, khe cắm thẻ nhớ microSD, giắc cắm nguồn điện. Không có sự xuất hiện của nút reset (trong thường hợp bị treo) ở khu vực này như một số mẫu camera khác. Camera quan sát&nbsp;<strong>BEN-IPC1110DHPTW</strong>&nbsp;hỗ trợ cả kết nối Wi-Fi không dây và có dây thuận tiện cho việc kết nối mạng để sử dụng.</span></p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif; text-align: justify;\">&nbsp;</p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif; text-align: center;\"><span style=\"color: rgb(0, 0, 0);\">&nbsp;<img alt=\"Mặt sau của Camera BEN-IPC1110DHPTW \" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/13/01/43/1486949609_img_5401.jpg\" style=\"max-width: 100%; height: 480px; width: 720px;\"><br><em>Mặt &nbsp;sau của Camera BEN-IPC1110DHPTW&nbsp;</em></span></p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif; text-align: justify;\"><span style=\"color: rgb(0, 0, 0);\"><span style=\"font-size: 16px;\"><strong>- Lắp đặt dễ dàng&nbsp;</strong></span>: người dùng có thể đặt trên mặt phẳng hoặc gắn tường. Nhà sản xuất cung cấp sẵn một chân đế cùng hai vít nở để gắn camera lên tường. Bản thân camera&nbsp;<strong>BEN-IPC1110DHPTW&nbsp;</strong>cũng rất linh hoạt, có thể điều khiển từ xa trên điện thoại để xoay ngang 355 độ và di chuyển lên xuống 90 độ giúp quan sát được nhiều hướng khi cần.&nbsp;</span></p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif; text-align: justify;\">&nbsp;</p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif; text-align: center;\"><span style=\"color: rgb(0, 0, 0);\">&nbsp;<img alt=\"Mặt đáy camera có dán tem sản phẩm\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/13/01/49/1486949946_img_5411.jpg\" style=\"max-width: 100%; height: 480px; width: 720px;\"><br><em>Mặt đáy camera có dán tem sản phẩm</em><br><br><img alt=\"Camera dễ dàng lắp đặt với chân đế và các vít nở \" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/13/01/57/1486950425_img_5383.jpg\" style=\"max-width: 100%; height: 480px; width: 720px;\"><br><em>Camera dễ dàng lắp đặt với chân đế và các vít nở&nbsp;</em></span><br>&nbsp;</p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif; text-align: center;\"><span style=\"color: rgb(0, 0, 0);\">&nbsp;<img alt=\"Camera sử dụng mạng dây để hoạt động\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/13/02/10/1486951220_img_5365.jpg\" style=\"max-width: 100%; height: 480px; width: 720px;\"><br><em>Camera&nbsp;kết nối bằng mạng dây</em></span><br>&nbsp;</p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><span style=\"color: rgb(0, 0, 0);\"><span style=\"font-size: 16px;\">-&nbsp;<strong>&nbsp;Hỗ trợ thẻ nhớ</strong>&nbsp;:</span>&nbsp;<strong>BEN-IPC1110DHPTW</strong>&nbsp;được hỗ trợ thẻ nhớ lên tới 128G giúp lưu trữ dữ liệu hình ảnh và video có thể lên tới 1 tuần .</span></p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif; text-align: center;\"><br><span style=\"color: rgb(0, 0, 0);\"><img alt=\"Camera kết nối với điện thoại qua wifi\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/13/02/11/1486951285_img_3352.jpg\" style=\"max-width: 100%; height: 480px; width: 720px;\"><br><em>Camera kết nối bằng wifi</em></span></p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><span style=\"color: rgb(0, 0, 0);\"><span style=\"font-size: 16px;\"><strong>- Đàm thoại hai chiều :</strong></span>&nbsp;Camera&nbsp;<strong>BEN-IPC1110DHPTW</strong>&nbsp;&nbsp;có địa chỉ IP mạng để kết nối với mạng Internet và cho phép người dùng quan sát hình ảnh trực tiếp, ghi hình hoặc tương tác hai chiều. Không những thế BEN-IPC1110DHPTW còn được trang bị&nbsp;mic và loa giúp bạn có thể vừa xem hình vừa trò chuyện trực tiếp với người thân, bạn bè trong gia đình một cách dễ dàng và tiện lợi.</span></p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif; text-align: center;\"><span style=\"color: rgb(0, 0, 0);\"><img alt=\"\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/13/06/54/1486968255_review-1110.jpg\" style=\"max-width: 100%; height: 398px; width: 720px;\"><br><br><em>Camera có thể đàm thoại 2 chiều</em></span></p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif; text-align: justify;\"><span style=\"color: rgb(0, 0, 0);\">Để xem hình ảnh từ camera giám sát qua các thiết bị di động và máy tính bảng, người dùng cần tải về ứng dụng xem camera qua điện thoại hiện có phiên bản miễn phí hỗ trợ Android&nbsp;và iOS. Việc cài đặt đơn giản giống như các ứng dụng thông thường, chỉ cần lên kho ứng dụng Google Play với Android hoặc App Store với iOS, tìm từ khoá phần mềm hỗ trợ Android (GDMSS LITE) và iOS (IDMSS LITE)&nbsp;để thấy ứng dụng cần cài đặt.<br><span style=\"font-size: 16px;\"><strong>- Thông số kỹ thuật cụ thể &nbsp;BEN-IPC1110DHPTW :</strong></span></span></p><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif; width: 371px;\"><tbody><tr><td style=\"height: 374px; width: 371px;\"><span style=\"color: rgb(0, 0, 0);\">Cảm biến hình ảnh: 1/3” 1.3Megapixel progresive CMOS<br>Độ phân giải:&nbsp; 1280(H) x960(V)<br>Chuẩn nén hình ảnh: H.264<br>Ống kính:2.3mm/F2.2<br>Góc quan sát lớn H:125°;V:89°<br>Hồng ngoại:1 IR LEDs<br>Độ xa hồng ngoại:10m (33ft)<br>Tính năng nổi bật: Smart IR,<br>BLC/HLC/DWDR;3D DNR;Day/Night ;White Balance;Digital Zoom16x<br>Tính năng P2P siêu nhanh ứng dụng công nghệ CDN<br>Audio: Đàm thoại âm thanh 2 chiều<br>Hỗ trợ thẻ nhớ: Micro SD hỗ trợ lên tới 128GB<br>Nguồn cấp:DC5V/1A.Max 4.7W<br>Nhiệt độ làm việc: -10°C~+45°C(14°F ~ +113°F)<br>Chất liệu: Plastic<br>Kích thước: 64.4mm*55.7mm*107mm<br>Khối lượng:135g<br>Hỗ trợ giám sát:<br>Web Viewer: IE, Chrome, Firefox, Safari<br>Phần mềm PC: Smart PSS<br>Smart Phone: Android,IOS,Blackberry,WindowsPhone</span></td></tr></tbody></table>','',3490000,1,'',0,0,1,5,2,0,0,1,1,'2017-11-09 14:12:26','2017-11-09 14:16:12'),(40,'0010','Camera WIFI BEN-IPC1310DHPTW','Camera WIFI BEN-IPC1310DHPTW','','- Chống nhiễu (3D-DNR),ống kính cố đinh 3.6mm, quay quét ngang (PAN) 355° tốc độ 100° /s, quay dọc lên xuống 90° 100° /s,\r\n- Hỗ trợ cài đặt trước 25 điểm, 8 hành trình (Tour), tích hợp míc và loa với chuẩn âm thanh G.711a;G.711Mu;AAC, hỡ trợ đàm thoại 2 c','camera-wifi-ben-ipc1310dhptw','uploads/images/product/2017_11_09_09_15_00_299-1110dhptw-720x720.png','- Chống nhiễu (3D-DNR),ống kính cố đinh 3.6mm, quay quét ngang (PAN) 355° tốc độ 100° /s, quay dọc lên xuống 90° 100° /s,\r\n- Hỗ trợ cài đặt trước 25 điểm, 8 hành trình (Tour), tích hợp míc và loa với chuẩn âm thanh G.711a;G.711Mu;AAC, hỡ trợ đàm thoại 2 c','<p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif; text-align: justify;\"><strong>Camera WIFI BEN-IPC1310DHPTW&nbsp;- CAMERA KHÔNG DÂY DÀNH CHO CÁC HỘ GIA ĐÌNH !!!</strong><br><br>Đây là một trong số các sản phẩm&nbsp;<a href=\"http://camera.pro.vn/\" style=\"color: rgb(51, 51, 51);\">camera giám sát</a>&nbsp;không dây mới của thương hiệu&nbsp;camera BENCO vừa ra mắt thị trường Việt Nam. Camera&nbsp;<a href=\"http://benco.vn/ben-ipc1110dhptw-1-1-533937.html\" style=\"color: rgb(51, 51, 51);\">BEN - IPC1310DHPTW</a>&nbsp;là mẫu camera Dome Wifi trong nhà&nbsp;có thiết kế để lắp đặt đơn giản, sử dụng mạng Wi-Fi hoặc mạng dây và có thể điều khiển trực tiếp ngay trên smartphone và máy tính bảng để giám sát từ bất kỳ đâu.</p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\">&nbsp;<img src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/13/02/41/1486953080_ben-ipc1110dhptw1.jpg.jpg\" alt=\"\" width=\"826\" height=\"548\" style=\"border-width: initial; border-style: none; max-width: 100%; height: auto;\"></p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\">&nbsp;</p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif; text-align: justify;\">Sản phẩm Camera WIFI BEN-IPC1310DHPTW<strong>&nbsp;</strong>được sản xuất ra&nbsp;nhắm tới đối tượng khách hàng là các văn phòng, cửa hàng và hộ gia đình.&nbsp;Những chiếc camera phù hợp với hộ gia đình, cửa hàng nhỏ lẻ… thường là mẫu camera IP bởi ưu điểm nhỏ gọn, dễ lắp đặt, tiện sử dụng và khả năng tương tác hai chiều tốt.&nbsp;</p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\">&nbsp;<img src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/13/02/42/1486953126_ben-ipc1110dhptw2.jpg.jpg\" alt=\"\" width=\"825\" height=\"656\" style=\"border-width: initial; border-style: none; max-width: 100%; height: auto;\"><br>&nbsp;</p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\">Camera IP (Internet Protocol) là loại camera có địa chỉ IP mạng để kết nối với mạng Internet và cho phép người dùng quan sát hình ảnh trực tiếp, ghi hình hoặc tương tác hai chiều.&nbsp;Camera&nbsp;<strong>BEN-IPC1310DHPTW&nbsp;</strong>có hình thức khá đẹp mắt với hai tông màu chủ đạo trắng, đen.&nbsp;Trọn bộ sản phẩm Camera này&nbsp;bao gồm camera, nguồn sạc, ốc vít và hướng dẫn sử dụng.</p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\">&nbsp;</p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\">&nbsp;<img src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/13/01/29/1486948782_img_5383.jpg\" alt=\"Trọn bộ sản phẩm camera \" width=\"823\" height=\"455\" style=\"border-width: initial; border-style: none; max-width: 100%; height: auto;\"></p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><em>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Trọn bộ sản phẩm&nbsp;Camera WIFI BEN-IPC1310DHPTW</em></p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\">&nbsp;</p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><strong>- Thiết kế nhỏ gọn</strong>:&nbsp;Camera WIFI BEN-IPC1310DHPTW&nbsp;được thiết kế &nbsp;tổng thể tương đối giống như nhiều mẫu camera IP trên thị trường với phần thân bên trên tròn lắp ráp với phần đế bên dưới có mặt đáy phẳng. Kích thước của nó là 94×94 mm, trọng lượng 215g, nhỏ nhẹ hơn nhiều&nbsp;mẫu camera IP khác trên thị trường&nbsp;và có thể dễ dàng lắp đặt ở bất kì không gian nào. &nbsp;</p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\">&nbsp;</p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\">&nbsp;<img src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/13/01/35/1486949134_img_5391.jpg\" alt=\"Camera BEN-IPC1110DHPTW được thiết kế nhỏ gọn và đẹp mắt\" width=\"820\" height=\"589\" style=\"border-width: initial; border-style: none; max-width: 100%; height: auto;\"></p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<em>Camera BEN-IPC1110DHPTW được thiết kế nhỏ gọn và đẹp mắt</em></p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><br><em><strong>-</strong></em><strong>&nbsp;Tính năng nổi bật</strong>&nbsp;:&nbsp;Camera WIFI BEN-IPC1310DHPTW&nbsp;có khả năng tự động chuyển đổi chế độ quan sát ngày /đêm(ICR).</p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\">&nbsp;<img src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/13/06/54/1486968279_1100-ip.jpg\" alt=\"\" width=\"820\" height=\"453\" style=\"border-width: initial; border-style: none; max-width: 100%; height: auto;\"></p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><em>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Thông số kỹ thuật của&nbsp;Camera WIFI BEN-IPC1310DHPTW</em></p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><strong>- &nbsp;Góc xoay quan sát dễ dàng</strong>&nbsp;:Camera WIFI BEN-IPC1310DHPTW<strong>&nbsp;</strong>có góc xoay ngang 0-335 độ, Dọc lên tới 90 độ, có thể xoay tùy chỉnh, nhờ vậy bạn có thể quan sát được gần tất cả mọi thứ trong căn phòng của bạn.</p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\">&nbsp;<img src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/13/02/44/1486953275_img_3377.jpg\" alt=\"\" width=\"822\" height=\"548\" style=\"border-width: initial; border-style: none; max-width: 100%; height: auto;\"><br>&nbsp;</p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><strong>- Hỗ trợ kết nối wifi :</strong>&nbsp;Phía sau của phần chân camera có cổng kết nối LAN, khe cắm thẻ nhớ microSD, giắc cắm nguồn điện. Không có sự xuất hiện của nút reset (trong thường hợp bị treo) ở khu vực này như một số mẫu camera khác. Camera quan sát&nbsp;<strong>BEN-IPC1110DHPTW</strong>&nbsp;hỗ trợ cả kết nối Wi-Fi không dây và có dây thuận tiện cho việc kết nối mạng để sử dụng.</p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\">&nbsp;</p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\">&nbsp;<img src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/13/01/43/1486949609_img_5401.jpg\" alt=\"Mặt sau của Camera BEN-IPC1110DHPTW \" width=\"821\" height=\"547\" style=\"border-width: initial; border-style: none; max-width: 100%; height: auto;\"></p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><em>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Mặt &nbsp;sau của Camera WIFI BEN-IPC1310DHPTW&nbsp;</em></p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><strong>- Lắp đặt dễ dàng&nbsp;</strong>: người dùng có thể đặt trên mặt phẳng hoặc gắn tường. Nhà sản xuất cung cấp sẵn một chân đế cùng hai vít nở để gắn camera lên tường. Bản thân camera&nbsp;<strong>BEN-IPC1310DHPTW&nbsp;</strong>cũng rất linh hoạt, có thể điều khiển từ xa trên điện thoại để xoay ngang 355 độ và di chuyển lên xuống 90 độ giúp quan sát được nhiều hướng khi cần.&nbsp;</p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\">&nbsp;</p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\">&nbsp;<img src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/13/01/49/1486949946_img_5411.jpg\" alt=\"Mặt đáy camera có dán tem sản phẩm\" width=\"821\" height=\"547\" style=\"border-width: initial; border-style: none; max-width: 100%; height: auto;\"></p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><em>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Mặt đáy camera có dán tem sản phẩm</em><br><br><img src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/13/01/57/1486950425_img_5383.jpg\" alt=\"Camera dễ dàng lắp đặt với chân đế và các vít nở \" width=\"819\" height=\"546\" style=\"border-width: initial; border-style: none; max-width: 100%; height: auto;\"></p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><em>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Camera dễ dàng lắp đặt với chân đế và các vít nở&nbsp;</em><br>&nbsp;</p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\">&nbsp;<img src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/13/02/10/1486951220_img_5365.jpg\" alt=\"Camera sử dụng mạng dây để hoạt động\" width=\"819\" height=\"546\" style=\"border-width: initial; border-style: none; max-width: 100%; height: auto;\"></p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><em>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Camera&nbsp;kết nối bằng mạng dây</em><br>&nbsp;</p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\">-&nbsp;<strong>&nbsp;Hỗ trợ thẻ nhớ</strong>&nbsp;:&nbsp;Camera WIFI BEN-IPC1310DHPTW&nbsp;được hỗ trợ thẻ nhớ lên tới 128G giúp lưu trữ dữ liệu hình ảnh và video có thể lên tới 1 tuần .</p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><br><img src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/13/02/11/1486951285_img_3352.jpg\" alt=\"Camera kết nối với điện thoại qua wifi\" width=\"818\" height=\"545\" style=\"border-width: initial; border-style: none; max-width: 100%; height: auto;\"></p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><em>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Camera kết nối bằng wifi</em></p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><strong>- Đàm thoại hai chiều :</strong>&nbsp;Camera WIFI BEN-IPC1310DHPTW&nbsp; có địa chỉ IP mạng để kết nối với mạng Internet và cho phép người dùng quan sát hình ảnh trực tiếp, ghi hình hoặc tương tác hai chiều. Không những thế BEN-IPC1110DHPTW còn được trang bị&nbsp;mic và loa giúp bạn có thể vừa xem hình vừa trò chuyện trực tiếp với người thân, bạn bè trong gia đình một cách dễ dàng và tiện lợi.</p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\">&nbsp;</p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\"><img src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/02/13/06/54/1486968255_review-1110.jpg\" alt=\"\" width=\"817\" height=\"452\" style=\"border-width: initial; border-style: none; max-width: 100%; height: auto;\"><br><br><em>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Camera có thể đàm thoại 2 chiều</em></p><p style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\">Để xem hình ảnh từ camera giám sát qua các thiết bị di động và máy tính bảng, người dùng cần tải về ứng dụng xem camera qua điện thoại hiện có phiên bản miễn phí hỗ trợ Android&nbsp;và iOS. Việc cài đặt đơn giản giống như các ứng dụng thông thường, chỉ cần lên kho ứng dụng Google Play với Android hoặc App Store với iOS, tìm từ khoá phần mềm hỗ trợ Android (GDMSS LITE) và iOS (IDMSS LITE)&nbsp;để thấy ứng dụng cần cài đặt.</p>','',4420000,1,'',0,0,1,5,2,0,0,1,1,'2017-11-09 14:15:00','2017-11-09 14:15:00'),(41,'0011','Đầu ghi hình 5in1 BEN-XVR1104C (4 kênh)','Đầu ghi hình 5in1 BEN-XVR1104C (4 kênh)','','Thông số kỹ thuật đầu ghi hình 5in1 BEN-XVR1104C\r\n- Đầu ghi hình 4 kênh\r\n- Hỗ trợ camera HDCVI/Analog/IP/TVI/AHD\r\n- Chuẩn nén hình ảnh H.264 với hai luồng dữ liệu với độ phân giải 1080N/720P/960H/D1(1-25fps)\r\n- Hỗ trợ ghi hình tất cả các kênh 720P\r\n- Cổng','dau-ghi-hinh-5in1-ben-xvr1104c-4-kenh','uploads/images/product/2017_11_09_09_46_29_270-ben-xvr1104c-1-1-533822.jpg','Thông số kỹ thuật đầu ghi hình 5in1 BEN-XVR1104C\r\n- Đầu ghi hình 4 kênh\r\n- Hỗ trợ camera HDCVI/Analog/IP/TVI/AHD\r\n- Chuẩn nén hình ảnh H.264 với hai luồng dữ liệu với độ phân giải 1080N/720P/960H/D1(1-25fps)\r\n- Hỗ trợ ghi hình tất cả các kênh 720P\r\n- Cổng','<p><span style=\"font-family: arial, Helvetica, sans-serif; text-align: justify;\">Sản phẩm hỗ trợ camera HDCVI/Analog/IP/TVI/AHD - Chuẩn nén hình ảnh H.264 với hai luồng dữ liệu với độ phân giải 1080N/720P/960H/D1(1-25fps), hỗ trợ ghi hình tất cả các kênh 720P, hỗ trợ 1 ổ cứng 6TB, 2 cổng usb 2.0. Tích hợp 1 cổng audio vào ra hỗ trợ đàm thoại hai chiều. Cung cấp hiệu suất mạng mạnh mẽ, vận hành dễ dàng, giao diện thân thiện và chất lượng hình ảnh cao cung cấp cho chúng ta một độ sắc nét và độ rõ nét màu sắc. Nó hỗ trợ độ phân giải 720p HD cung cấp mà không làm giảm chất lượng trên một khoảng cách dài một hình ảnh lên tới 700 mét với cáp đồng trục.<br><br>Sản phẩm đầu ghi hình HDCVI <strong>BEN-XVR1104C</strong> có 4 kênh, chuẩn H.264, xem đồng thời 4 camera độ phân giải 720P, hỗ trợ HDMI, VGA, BNC hỗ trợ 1 ổ cứng SATA HDD dung lượng đến 6TB.<br><br>Vỏ hộp của <strong>BEN-XVR1104C</strong> được thiết kế khá đẹp mắt, đường nét sắc xảo, các thông tin như logo BENCO, công nghệ, thông số kỹ thuật camera được hiển thị đầy đủ trên nền đỏ – trắng quen thuộc của thương hiệu BENCO.<br><br>Cũng như các dòng đầu ghi khác, bên trong hộp sản phẩm là đầu ghi hình và đầy đủ các phụ kiện bao gồm:<br>- Bộ đổi nguồn cho đầu ghi (12V-2A)<br>- Chuột USB<br>- Dây cáp SATA + Cáp nguồn<br>- Ốc vít ổ cứng<br>- Sách hướng dẫn.</span><br style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif; text-align: justify;\"><span style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif; text-align: justify;\"> </span></p><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif; text-align: center;\"><span style=\"color: rgb(0, 0, 0);\"><img alt=\"Trọn bộ đầu ghi và phụ kiện kèm theo\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/03/02/04/20/1488427789_img_5591.jpg\" style=\"border-width: initial; border-style: none; max-width: 100%; height: 480px; width: 720px;\"><br>Trọn bộ đầu ghi và phụ kiện kèm theo<br><br><img alt=\"Các phụ kiện đi kèm đầu ghi\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/03/02/04/24/1488428008_img_5598.jpg\" style=\"border-width: initial; border-style: none; max-width: 100%; height: 480px; width: 720px;\"><br>Các phụ kiện đi kèm đầu ghi</span><div style=\"text-align: justify;\"><br><span style=\"color: rgb(0, 0, 0);\">Về mặt sản phẩm, BEN-XVR1104C được thiết ké hình dạng khá mềm mại: Sản phẩm có vỏ nhựa cứng màu trắng cách điện, phần đế của sản phẩm bằng chất liệu kim loại để đảm bảo sự chắc chắn cho mainboard bên trong. Bên trên thân camera là 3 đèn led biểu thị tình trạng nguồn, ổ cứng và kết nối mạng, mặt sau vẫn là các cổng: Video in/out, Audio in/out, Cổng mạng, Cổng kết nối nguồn… </span><br> <div style=\"text-align: center;\"><span style=\"color: rgb(0, 0, 0);\"><img alt=\"Thiết kế đầu ghi BEN-XVR1104C khá đơn giản và đẹp mắt\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/03/02/03/46/1488425723_img_5616.jpg\" style=\"border-width: initial; border-style: none; max-width: 100%; height: 480px; width: 720px;\"><br>Thiết kế đầu ghi BEN-XVR1104C khá đơn giản và đẹp mắt<br><br><img alt=\"Mặt trên có 3 đèn led biểu thị tình trạng nguồn, ổ cứng và kết nối mạng\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/03/02/03/53/1488426168_img_5601.jpg\" style=\"border-width: initial; border-style: none; max-width: 100%; height: 480px; width: 720px;\"><br>Mặt trên có 3 đèn led biểu thị tình trạng nguồn, ổ cứng và kết nối mạng<br><br><img alt=\"Mặt sau đầu ghi có các cổng kết nối\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/03/02/03/58/1488426436_img_5621.jpg\" style=\"border-width: initial; border-style: none; max-width: 100%; height: 480px; width: 720px;\"><br>Mặt sau đầu ghi có các cổng kết nối<br><br><img alt=\"Hai bên thân đầu ghi được thiết kế các lỗ thoáng tản nhiệt\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/03/02/04/12/1488427330_img_6209.jpg\" style=\"border-width: initial; border-style: none; max-width: 100%; height: 486px; width: 720px;\"><br>Hai bên thân đầu ghi được thiết kế các lỗ thoáng tản nhiệt giúp đầu ghi không bị nóng khi hoạt động <br><br><img alt=\"Đầu ghi có thể lắp dặt ở các vị trí khác nhau\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/03/02/04/30/1488428413_img_5623.jpg\" style=\"border-width: initial; border-style: none; max-width: 100%; height: 480px; width: 720px;\"><br>Hình ảnh mặt dưới của đầu ghi<br><br><img alt=\"Cấu tạo bên trong của đầu ghi BEN-XVR1104C\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/03/02/04/37/1488428831_img_5635.jpg\" style=\"border-width: initial; border-style: none; max-width: 100%; height: 480px; width: 720px;\"><br>Cấu tạo bên trong của đầu ghi BEN-XVR1104C<br><br><img alt=\"Cấu tạo đầu ghi BEN-XVR1104C\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/03/02/04/41/1488429045_img_5629.jpg\" style=\"border-width: initial; border-style: none; max-width: 100%; height: 480px; width: 720px;\"><br>Cấu tạo đầu ghi BEN-XVR1104C</span><br> <div style=\"text-align: justify;\"><span style=\"color: rgb(0, 0, 0);\"><a href=\"https://mtel.vn/dau-ghi-5in1.html\" style=\"color: rgb(51, 51, 51);\">Đầu ghi hình 5in1</a> BEN-XVR1104C cho phép kết nối với camera HDCVI, AHD, TVI, IP và Analog thật dễ dàng, tiện lợi với hệ thống camera đã có sẵn trong gia đình bạn. Sản phẩm thân thiện với người dùng, dễ dàng cài đặt và sử dụng.</span></div></div></div></div>','',1990000,1,'',0,0,1,5,2,0,0,1,1,'2017-11-09 14:46:29','2017-11-09 14:47:11'),(42,'0012','Đầu ghi hình 5in1 BEN-XVR1108C (8 kênh)','Đầu ghi hình 5in1 BEN-XVR1108C (8 kênh)','','Đặc điểm nổi bậtThông số kỹ thuậtBình luận - Đánh giá (0)Hướng dẫn sử dụng\r\nĐặc điểm nổi bật\r\n\r\nĐầu ghi hình 5in1 BEN-XVR1108C cho phép kết nối với camera HDCVI, AHD, TVI, IP và Analog thật dễ dàng, tiện lợi với hệ thống camera đã có sẵn trong gia đình ','dau-ghi-hinh-5in1-ben-xvr1108c-8-kenh','uploads/images/product/2017_11_09_09_48_37_271-ben-xvr1108c-1-1-533825.jpg','Đặc điểm nổi bậtThông số kỹ thuậtBình luận - Đánh giá (0)Hướng dẫn sử dụng\r\nĐặc điểm nổi bật\r\n\r\nĐầu ghi hình 5in1 BEN-XVR1108C cho phép kết nối với camera HDCVI, AHD, TVI, IP và Analog thật dễ dàng, tiện lợi với hệ thống camera đã có sẵn trong gia đình ','<h2 class=\"h-title\" style=\"margin: 20px 0px 11px; padding: 0px 0px 6px; font-size: 19px; border-bottom: 1px solid rgb(221, 221, 221); color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif;\">Đặc điểm nổi bật</h2><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif; text-align: justify;\"><span style=\"color: rgb(0, 0, 0);\">Đầu ghi hình 5in1 BEN-XVR1108C cho phép kết nối với camera HDCVI, AHD, TVI, IP và Analog thật dễ dàng, tiện lợi với hệ thống camera đã có sẵn trong gia đình bạn. Cung cấp khả năng tương thích cũng như tính linh hoạt khi lưu trữ ở mức tốt nhất hiện nay. Chức năng P2P giúp người dùng dễ dàng sử dụng, thân thiện và thuận tiện. </span><br> <div style=\"text-align: center;\"><img alt=\"Đầu ghi hình BEN-XVR1108C\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/03/02/07/44/1488440036_img_6254.jpg\" style=\"border-width: initial; border-style: none; max-width: 100%; height: 480px; width: 720px;\"><br>Đầu ghi hình BEN-XVR1108C<div style=\"text-align: justify;\"><br><span style=\"color: rgb(0, 0, 0);\">Hỗ trợ camera HDCVI/Analog/IP/TVI/AHD ,Chuẩn nén hình ảnh H.264 với hai luồng dữ liệu với độ phân giải 1080N/720P/960H/D1(1-25fps). Đầu ghi hình BEN-XVR1108C hỗ trợ ghi hình tất cả các kênh 720P, cổng ra tín hiệu video đồng thời HDMI/VGA, hỗ trợ xem lại 4/8 kênh đồng thời với chế độ tìm kiếm thông minh. Đầu ghi có thể kết nối nhiều nhãn hiệu camera IP(4+1,8+2) hỗ trợ lên đến camera 2MP với chuẩn tương tích Onvif 2.4. Hỗ trợ 1 ổ cứng 6TB, 2 cổng usd 2.0, 1 cổng mạng RJ45(10/100M),1 cổng RS485, hỗ trợ điều kiển quay quét 3D thông minh.</span><br> <div style=\"text-align: center;\"><span style=\"color: rgb(0, 0, 0);\"><img alt=\"Trên mặt đầu ghi có các đèn Led biểu thị tình trạng hoạt động\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/03/02/08/53/1488444189_img_6263.jpg\" style=\"border-width: initial; border-style: none; max-width: 100%; height: 425px; width: 720px;\"></span><br>Trên mặt đầu ghi có các đèn Led biểu thị tình trạng hoạt động<br><br><img alt=\"Hình ảnh mặt dưới đầu ghi BEN-XVR1108C\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/03/02/08/55/1488444282_img_6271.jpg\" style=\"border-width: initial; border-style: none; max-width: 100%; height: 480px; width: 720px;\"><br>Hình ảnh mặt dưới đầu ghi BEN-XVR1108C<br><br><img alt=\"Mặt sau đầu ghi có các jack kết nối\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/03/02/08/56/1488444323_img_6269.jpg\" style=\"border-width: initial; border-style: none; max-width: 100%; height: 480px; width: 720px;\"><br>Mặt sau đầu ghi có các jack kết nối<br><br><img alt=\"Thân đầu ghi có các lỗ thoáng tản nhiệt giúp đầu ghi hoạt động tốt hơn\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/03/02/08/56/1488444368_img_6286.jpg\" style=\"border-width: initial; border-style: none; max-width: 100%; height: 480px; width: 720px;\"><br>Thân đầu ghi có các lỗ thoáng tản nhiệt giúp đầu ghi hoạt động tốt hơn<br><br><img alt=\"Cấu tạo bên trong của đầu ghi BEN-XVR1108C\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/03/02/08/58/1488444472_img_6334.jpg\" style=\"border-width: initial; border-style: none; max-width: 100%; height: 480px; width: 720px;\"><br>Cấu tạo bên trong của đầu ghi BEN-XVR1108C<br><br><img alt=\"Cấu tạo bên trong của đầu ghi BEN-XVR1108C\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/03/02/08/59/1488444542_img_6338.jpg\" style=\"border-width: initial; border-style: none; max-width: 100%; height: 480px; width: 720px;\"><br>Quạt tản nhiệt giúp đầu ghi hoạt động không bị nóng<br><br><img alt=\"Cấu tạo bên trong của đầu ghi BEN-XVR1108C\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/03/02/09/00/1488444576_img_6342.jpg\" style=\"border-width: initial; border-style: none; max-width: 100%; height: 480px; width: 720px;\"><br>Toàn bộ main xử lý của đầu ghi được gắn chặt chẽ với vỏ đầu ghi</div></div></div></div>','',2990000,1,'',0,0,1,5,2,0,0,1,1,'2017-11-09 14:48:37','2017-11-09 15:42:34'),(43,'0013','Đầu ghi hình BEN-XVR2104M','Đầu ghi hình BEN-XVR2104M','','Thông số kỹ thuật chi tiết của đầu ghi hình XVR 4 kênh BEN-XVR2104M:\r\n \r\nChuẩn nén hình ảnh H264+/H.264 với hai luồng dữ liệu giúp tăng lưu trữ và băng thông tới 50% với chuẩn nén hình ảnh mới.\r\nSố khung hình 1080N/720P/960H/D1(1-25fps),\r\nHỗ trợ ghi hình ','dau-ghi-hinh-ben-xvr2104m','uploads/images/product/2017_11_09_10_47_14_4-cong.jpg','Thông số kỹ thuật chi tiết của đầu ghi hình XVR 4 kênh BEN-XVR2104M:\r\n \r\nChuẩn nén hình ảnh H264+/H.264 với hai luồng dữ liệu giúp tăng lưu trữ và băng thông tới 50% với chuẩn nén hình ảnh mới.\r\nSố khung hình 1080N/720P/960H/D1(1-25fps),\r\nHỗ trợ ghi hình ','<p><span style=\"font-family: arial, Helvetica, sans-serif; text-align: justify;\">Một vài hình ảnh thực tế của đầu ghi BEN-XVR2104M:</span><span style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif; text-align: justify;\"></span></p><div style=\"color: rgb(34, 34, 34); font-family: arial, Helvetica, sans-serif; text-align: center;\"><br><span style=\"color: rgb(0, 0, 0);\"><img alt=\"Hình ảnh bóc hộp sản phẩm đầu ghi BEN-XVR2104M\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/03/04/08/48/1488616675_img_6368.jpg\" style=\"border-width: initial; border-style: none; max-width: 100%; height: 479px; width: 720px;\"><br>Hình ảnh bóc hộp sản phẩm đầu ghi BEN-XVR2104M</span><br> <div><span style=\"color: rgb(0, 0, 0);\"><img alt=\"Trọn bộ sản phẩm đầu ghi BEN-XVR2104M\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/03/04/08/28/1488615452_img_6475.jpg\" style=\"border-width: initial; border-style: none; max-width: 100%; height: 480px; width: 720px;\"><br>Trọn bộ sản phẩm đầu ghi BEN-XVR2104M<br><br><img alt=\"Các phụ kiện đi kèm sản phẩm\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/03/04/08/47/1488616607_img_6372.jpg\" style=\"border-width: initial; border-style: none; max-width: 100%; height: 495px; width: 720px;\"><br>Các phụ kiện đi kèm sản phẩm<br><br><img alt=\"Thiết kế hình dáng đẹp mắt, sang trọng \" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/03/04/08/50/1488616785_img_6404.jpg\" style=\"border-width: initial; border-style: none; max-width: 100%; height: 418px; width: 720px;\"><br>Đầu ghi có thiết kế đẹp mắt, sang trọng. Xung quanh thân đầu ghi có các lỗ thoáng tản nhiệt.<br><br><img alt=\"Mặt sau đầu ghi có các cổng kết nối\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/03/04/08/52/1488616918_img_6483.jpg\" style=\"border-width: initial; border-style: none; max-width: 100%; height: 445px; width: 720px;\"><br>Phía sau đầu ghi có các cổng chức năng<br><br><img alt=\"Vỏ ngoài đầu ghi được thiết kế tối ưu giúp sản phẩm hoạt động hiệu xuất cao\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/03/04/08/54/1488617009_img_6489.jpg\" style=\"border-width: initial; border-style: none; max-width: 100%; height: 504px; width: 720px;\"><br>Vỏ ngoài đầu ghi được thiết kế tối ưu giúp sản phẩm hoạt động hiệu xuất cao<br><br><img alt=\"Mặt trước đầu ghi có cổng USB và các đèn LED báo hiệu trạng thái hoạt động\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/03/04/09/00/1488617406_img_6173.jpg\" style=\"border-width: initial; border-style: none; max-width: 100%; height: 390px; width: 720px;\"><br>Mặt trước đầu ghi có cổng USB và các đèn LED báo hiệu trạng thái hoạt động</span></div></div>','',3200000,1,'',0,0,1,5,2,0,0,1,1,'2017-11-09 14:51:32','2017-11-09 15:47:14'),(44,'0014','Đầu ghi hình BEN-XVR2108M','Đầu ghi hình BEN-XVR2108M','','Chuẩn nén hình ảnh H264+/H.264 với hai luồng dữ liệu giúp tăng lưu trữ và băng thông tới 50% với chuẩn nén hình ảnh mới.\r\nSố khung hình 1080N/720P/960H/D1(1-25fps),\r\nHỗ trợ ghi hình camera 1080N/720P\r\nCổng ra tín hiệu video đồng thời HDMI/VGA,\r\nHỗ trợ 8 k','dau-ghi-hinh-ben-xvr2108m','uploads/images/product/2017_11_09_10_20_23_dau-ghi-hinh-8-kenh-ben-xvr2108m.jpg','Chuẩn nén hình ảnh H264+/H.264 với hai luồng dữ liệu giúp tăng lưu trữ và băng thông tới 50% với chuẩn nén hình ảnh mới.\r\nSố khung hình 1080N/720P/960H/D1(1-25fps),\r\nHỗ trợ ghi hình camera 1080N/720P\r\nCổng ra tín hiệu video đồng thời HDMI/VGA,\r\nHỗ trợ 8 k','<p><span style=\"font-family: \"Roboto Condensed\", arial, Helvetica, sans-serif; font-size: 14px; text-align: justify;\">Một vài hình ảnh thực tế của sản phẩm: </span><br style=\"color: rgb(49, 49, 49); font-family: \"Roboto Condensed\", arial, Helvetica, sans-serif; font-size: 14px; text-align: justify;\"><span style=\"color: rgb(49, 49, 49); font-family: \"Roboto Condensed\", arial, Helvetica, sans-serif; font-size: 14px; text-align: justify;\"> </span></p><div style=\"color: rgb(49, 49, 49); font-family: \"Roboto Condensed\", arial, Helvetica, sans-serif; font-size: 14px; text-align: center;\"><span style=\"color: rgb(0, 0, 0);\"> <img alt=\"Bên trong hộp sản phẩm đầu ghi BEN-XVR2108M\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/03/06/02/28/1488766671_img_6368.jpg\" style=\"border-width: initial; border-style: none; max-width: 100%; height: 479px; width: 720px;\"><br>Bên trong hộp sản phẩm đầu ghi BEN-XVR2108M<br><br><img alt=\"Trọn bộ sản phẩm và phụ kiện đi kèm\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/03/06/02/29/1488766720_img_6372.jpg\" style=\"border-width: initial; border-style: none; max-width: 100%; height: 495px; width: 720px;\"><br>Trọn bộ sản phẩm và phụ kiện đi kèm<br><br><img alt=\"Mặt trước đầu ghi được trang bị 1 cổng USB và 3 đèn LED báo hiệu tình trạng hoạt động\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/03/06/02/30/1488766757_img_6494.jpg\" style=\"border-width: initial; border-style: none; max-width: 100%; height: 480px; width: 720px;\"><br>Mặt trước đầu ghi được trang bị 1 cổng USB và 3 đèn LED báo hiệu tình trạng hoạt động<br><br><img alt=\"Mặt sau là các cổng kết nối với màn hình TV giúp người dùng có thể xem và điều khiển camera\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/03/06/02/31/1488766825_img_6497.jpg\" style=\"border-width: initial; border-style: none; max-width: 100%; height: 480px; width: 720px;\"><br>Mặt sau là các cổng kết nối với màn hình TV giúp người dùng có thể xem và điều khiển camera<br><br><img alt=\"Bên thân đầu ghi có trang bị các lỗ thoáng và quạt tản nhiệt giúp đâu ghi hoạt động không bị nóng\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/03/06/02/32/1488766904_img_6499.jpg\" style=\"border-width: initial; border-style: none; max-width: 100%; height: 480px; width: 720px;\"><br>Bên thân đầu ghi có trang bị các lỗ thoáng và quạt tản nhiệt giúp đâu ghi hoạt động không bị nóng<br><br><img alt=\"Các lỗ thoáng được thiết ké cân xứng hai bên thân đầu ghi\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/03/06/02/33/1488766963_img_6503.jpg\" style=\"border-width: initial; border-style: none; max-width: 100%; height: 480px; width: 720px;\"><br>Các lỗ thoáng được thiết ké cân xứng hai bên thân đầu ghi<br><br><img alt=\"Hình ảnh bên dưới đầu ghi\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/03/06/02/34/1488767038_img_6509.jpg\" style=\"border-width: initial; border-style: none; max-width: 100%; height: 493px; width: 720px;\"><br>Hình ảnh bên dưới đầu ghi<br><br><img alt=\"Hình ảnh đầu ghi và hộp sản phẩm\" src=\"https://cdn-img-v2.webbnc.net/uploadv2/web/20/2017/media/2017/03/06/02/40/1488767370_img_6470.jpg\" style=\"border-width: initial; border-style: none; max-width: 100%; height: 480px; width: 720px;\"><br>Hình ảnh đầu ghi và hộp sản phẩm</span></div>','',3750000,1,'',0,0,1,5,2,0,0,1,1,'2017-11-09 14:53:55','2017-11-09 15:20:23');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `properties`
--

DROP TABLE IF EXISTS `properties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `properties` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'color',
  `category_id` int(11) NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `properties_category_id_index` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `properties`
--

LOCK TABLES `properties` WRITE;
/*!40000 ALTER TABLE `properties` DISABLE KEYS */;
INSERT INTO `properties` VALUES (1,'Màu đỏ','color',0,'red','',1,'2017-11-05 12:57:55','2017-11-05 12:57:55'),(2,'Màu xanh','color',0,'green','',1,'2017-11-05 12:57:55','2017-11-05 12:57:55'),(3,'Màu vàng','color',0,'orange','',1,'2017-11-05 12:57:55','2017-11-05 12:57:55');
/*!40000 ALTER TABLE `properties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `providers`
--

DROP TABLE IF EXISTS `providers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `providers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `intro` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `providers`
--

LOCK TABLES `providers` WRITE;
/*!40000 ALTER TABLE `providers` DISABLE KEYS */;
/*!40000 ALTER TABLE `providers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registers`
--

DROP TABLE IF EXISTS `registers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `store_show` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_type` int(11) NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `district` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `number_register` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `brand` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registers`
--

LOCK TABLES `registers` WRITE;
/*!40000 ALTER TABLE `registers` DISABLE KEYS */;
/*!40000 ALTER TABLE `registers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_abilities`
--

DROP TABLE IF EXISTS `role_abilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_abilities` (
  `ability_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ability_id`,`role_id`),
  KEY `role_abilities_ability_id_index` (`ability_id`),
  KEY `role_abilities_role_id_index` (`role_id`),
  CONSTRAINT `role_abilities_ability_id_foreign` FOREIGN KEY (`ability_id`) REFERENCES `abilities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_abilities_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_abilities`
--

LOCK TABLES `role_abilities` WRITE;
/*!40000 ALTER TABLE `role_abilities` DISABLE KEYS */;
INSERT INTO `role_abilities` VALUES (1,1),(1,2),(2,1),(2,2),(3,1),(3,2),(4,1),(4,2),(5,1),(5,2),(5,4),(6,1),(6,2),(6,4),(7,1),(7,2),(7,4),(8,1),(8,2),(8,4),(9,1),(9,2),(9,3),(9,4),(10,1),(10,2),(10,3),(10,4),(11,1),(11,2),(11,3),(11,5),(12,1),(12,2),(12,3),(13,1),(13,2),(14,1),(14,2),(15,1),(15,2),(16,1),(16,2),(17,1),(17,2),(18,1),(18,2),(19,1),(19,2),(19,3),(19,5),(20,1),(20,2),(20,3),(20,5),(21,1),(21,2),(21,5),(22,1),(22,2),(23,1),(23,2),(24,1),(24,2),(25,1),(25,2),(25,5),(26,1),(26,2),(26,5),(27,1),(27,2),(28,1),(28,2),(28,3),(29,1),(29,2),(29,3),(30,1),(30,2),(30,3);
/*!40000 ALTER TABLE `role_abilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'system','2017-11-05 12:57:55','2017-11-05 12:57:55'),(2,'admin','2017-11-05 12:57:55','2017-11-05 12:57:55'),(3,'product_manager','2017-11-05 12:57:55','2017-11-05 12:57:55'),(4,'post_manager','2017-11-05 12:57:55','2017-11-05 12:57:55'),(5,'order_manager','2017-11-05 12:57:55','2017-11-05 12:57:55');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ships`
--

DROP TABLE IF EXISTS `ships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ships` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `info` text COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reply` text COLLATE utf8_unicode_ci NOT NULL,
  `total` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ships_customer_id_index` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ships`
--

LOCK TABLES `ships` WRITE;
/*!40000 ALTER TABLE `ships` DISABLE KEYS */;
/*!40000 ALTER TABLE `ships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slides`
--

DROP TABLE IF EXISTS `slides`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slides` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `section` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `category_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slides`
--

LOCK TABLES `slides` WRITE;
/*!40000 ALTER TABLE `slides` DISABLE KEYS */;
INSERT INTO `slides` VALUES (1,'','uploads/images/slide/2017_11_05_09_10_42_z772495056810-dcd31e2d02c5d4005254470e43f39ef6.jpg','','1',1,1,'2017-11-05 14:10:42','2017-11-05 14:10:42'),(2,'','uploads/images/slide/2017_11_05_09_11_00_z772493755591-179bc10da4f8d67ec09d932161f185f5.jpg','','1',1,1,'2017-11-05 14:11:00','2017-11-05 14:11:00'),(3,'','uploads/images/slide/2017_11_05_09_11_13_z772495263685-f75bcb854b804f07f6460cb65697bbbd.jpg','','1',1,1,'2017-11-05 14:11:13','2017-11-05 14:11:13'),(4,'','uploads/images/slide/2017_11_05_09_11_27_z772493734954-d3dab5311456a0ce5f1b4fd65fc0ad7f.jpg','','1',1,1,'2017-11-05 14:11:27','2017-11-05 14:11:27'),(5,'','uploads/images/slide/2017_11_05_09_12_01_z772493917482-c8ce1db584e2987205cd60e2770d2e8e.jpg','','1',1,1,'2017-11-05 14:12:01','2017-11-05 14:12:01'),(6,'','uploads/images/slide/2017_11_05_09_12_13_z772494876028-808cd284b4d97d9a78f158b1d30ef607.jpg','','1',1,1,'2017-11-05 14:12:13','2017-11-05 14:12:13'),(7,'','uploads/images/slide/2017_11_05_09_41_26_z772496087138-7ea4d2d56371230aff48b287d27182eb.jpg','','1',1,1,'2017-11-05 14:41:26','2017-11-05 14:41:26'),(8,'','uploads/images/slide/2017_11_09_10_03_12_z772495056810-dcd31e2d02c5d4005254470e43f39ef6.jpg','','1',1,1,'2017-11-09 15:03:12','2017-11-09 15:03:12');
/*!40000 ALTER TABLE `slides` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_abilities`
--

DROP TABLE IF EXISTS `user_abilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_abilities` (
  `ability_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ability_id`,`user_id`),
  KEY `user_abilities_ability_id_index` (`ability_id`),
  KEY `user_abilities_user_id_index` (`user_id`),
  CONSTRAINT `user_abilities_ability_id_foreign` FOREIGN KEY (`ability_id`) REFERENCES `abilities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_abilities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_abilities`
--

LOCK TABLES `user_abilities` WRITE;
/*!40000 ALTER TABLE `user_abilities` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_abilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`user_id`),
  KEY `user_roles_role_id_index` (`role_id`),
  KEY `user_roles_user_id_index` (`user_id`),
  CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_roles`
--

LOCK TABLES `user_roles` WRITE;
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
INSERT INTO `user_roles` VALUES (1,1),(2,2);
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Hệ thống','nobody','nobody@system.com','$2y$10$vKaEN9vSRIjur8YkRzoT7ujiCqaEvOeJXCeJP1ZfO34P8xNx/wVtG','',NULL,'2017-11-05 12:57:55','2017-11-05 12:57:55'),(2,'Quản trị','admin','mrhaiit.pci@gmail.com','$2y$10$FOVlggDDn/UG2D5/02Uja.7frPHlJWmsLBIWU6.3bbKrFKdg3gHf6','',NULL,'2017-11-05 12:57:55','2018-04-10 01:05:10');
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

-- Dump completed on 2018-04-09 11:11:12
