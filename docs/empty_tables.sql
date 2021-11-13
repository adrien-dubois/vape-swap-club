-- Adminer 4.8.1 MySQL 8.0.27-0ubuntu0.20.04.1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `adress`;
CREATE TABLE `adress` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `number` int DEFAULT NULL,
  `adress` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `zip` varchar(64) NOT NULL,
  `city` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `phone` varchar(64) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `app_user_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_adress_app_user_idx` (`app_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `app_user`;
CREATE TABLE `app_user` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `password` varchar(60) NOT NULL,
  `picture` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `role` enum('Vaper','Hard Vaper','Great Seller','Admin') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `activation_code` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` enum('not verified','verified') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `otp` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `adress_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_adress_idx` (`adress_id`),
  CONSTRAINT `app_user_ibfk_2` FOREIGN KEY (`adress_id`) REFERENCES `adress` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


DROP TABLE IF EXISTS `brand`;
CREATE TABLE `brand` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL COMMENT 'Le nom de la marque',
  `picture` varchar(128) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'La date de création de la marque',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'La date de la dernière mise à jour de la marque',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL COMMENT 'Le nom de la catégorie',
  `subtitle` varchar(64) DEFAULT NULL,
  `home_order` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'L''ordre d''affichage de la catégorie sur la home (0=pas affichée en home)',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'La date de création de la catégorie',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'La date de la dernière mise à jour de la catégorie',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `app_user_id` int unsigned NOT NULL,
  `adress_id` int unsigned NOT NULL,
  `price` float NOT NULL,
  `status` tinyint unsigned NOT NULL DEFAULT '1' COMMENT '1 => En attente 2 => Payée',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `app_user_id` (`app_user_id`),
  KEY `adress_id` (`adress_id`),
  CONSTRAINT `order_ibfk_1` FOREIGN KEY (`app_user_id`) REFERENCES `app_user` (`id`),
  CONSTRAINT `order_ibfk_2` FOREIGN KEY (`adress_id`) REFERENCES `adress` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `order_has_product`;
CREATE TABLE `order_has_product` (
  `order_id` int unsigned NOT NULL,
  `product_id` int unsigned NOT NULL,
  PRIMARY KEY (`order_id`,`product_id`),
  KEY `fk_order_has_product_order1_idx` (`order_id`),
  KEY `fk_order_has_product_product1_idx` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `picture`;
CREATE TABLE `picture` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL COMMENT 'Le nom du produit',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'La description du produit',
  `subtitle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Mini description pour carousel',
  `picture` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'L''URL de l''image du produit',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Le prix du produit',
  `rate` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'L''avis sur le produit, de 1 à 5',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Le statut du produit (1=dispo, 2=pas dispo)',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'La date de création du produit',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'La date de la dernière mise à jour du produit',
  `brand_id` int unsigned DEFAULT NULL COMMENT 'La marque du produit',
  `category_id` int unsigned NOT NULL COMMENT 'La catégorie',
  `type_id` int unsigned NOT NULL COMMENT 'Le type',
  `app_user_id` int unsigned NOT NULL COMMENT 'Le vendeur',
  PRIMARY KEY (`id`),
  KEY `fk_product_brand_idx` (`brand_id`),
  KEY `fk_product_category1_idx` (`category_id`),
  KEY `fk_product_type1_idx` (`type_id`),
  KEY `app_user_id` (`app_user_id`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`app_user_id`) REFERENCES `app_user` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `product_has_picture`;
CREATE TABLE `product_has_picture` (
  `product_id` int unsigned NOT NULL,
  `picture_id` int unsigned NOT NULL,
  PRIMARY KEY (`product_id`,`picture_id`),
  KEY `fk_product_has_picture_product1_idx` (`product_id`),
  KEY `fk_product_has_picture_picture1_idx` (`picture_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `type`;
CREATE TABLE `type` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL COMMENT 'Le nom du type',
  `footer_order` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'L''ordre d''affichage du type dans le footer (0=pas affichée dans le footer)',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'La date de création de la catégorie',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'La date de la dernière mise à jour de la catégorie',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- 2021-11-13 19:52:12