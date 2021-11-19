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

INSERT INTO `adress` (`id`, `name`, `number`, `adress`, `message`, `zip`, `city`, `phone`, `created_at`, `updated_at`, `app_user_id`) VALUES
(3,	'Bruce Wayne',	164,	' Rue du Joker ',	'   ',	'789449',	'Gotham City',	'0665354481',	'2021-11-10 14:25:09',	'2021-11-10 14:25:09',	3);

DROP TABLE IF EXISTS `app_user`;
CREATE TABLE `app_user` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `password` varchar(60) NOT NULL,
  `picture` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `role` enum('Vaper','Vendor','Admin') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
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

INSERT INTO `app_user` (`id`, `email`, `firstname`, `lastname`, `password`, `picture`, `role`, `activation_code`, `status`, `otp`, `created_at`, `updated_at`, `adress_id`) VALUES
(3,	'adrien@vape-swap.io',	'Adrien',	'Dubois',	'$2y$10$38R6KFGZ7/u6hRd7SB2F6uKmT9.H67kp740ved69nbXHOIHoFT/aS',	'id.jpg',	'Admin',	'',	'verified',	0,	'2021-07-19 09:40:14',	NULL,	NULL),
(18,	'juicy.snoos@gmail.com',	'Jean Claude',	'DUSSE',	'$2y$10$hUi8cDTXGUUGyY/TTywpyOQgudoACSjbu.oGJuEsDLXBuVnIcBmHi',	'6179649debdad3.86830600.png',	'Vendor',	'57c3c7548c5d7114783e80a72b50f2eb',	'verified',	122145,	'2021-10-27 14:39:26',	'2021-10-27 14:41:31',	NULL),
(20,	'dubois.adrien.dev@gmail.com',	'John',	'Doe',	'$2y$10$wAyfUr16rumcQwCqHa19GuYnEGGZZiBXTw/x5tLUb34.4WfE9aVJK',	'6182f89ddc8755.80428918.png',	'Vendor',	'd0f33491f25a65e1e91ce27ed2169ce3',	'verified',	228390,	'2021-11-03 21:01:17',	'2021-11-03 21:01:59',	NULL);

DROP TABLE IF EXISTS `brand`;
CREATE TABLE `brand` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL COMMENT 'Le nom de la marque',
  `picture` varchar(128) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'La date de création de la marque',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'La date de la dernière mise à jour de la marque',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `brand` (`id`, `name`, `picture`, `created_at`, `updated_at`) VALUES
(1,	'Psyclone',	NULL,	'2021-10-22 09:47:50',	NULL),
(2,	'District F5ve',	NULL,	'2021-10-22 09:54:49',	NULL),
(3,	'CompLyfe',	NULL,	'2021-10-22 09:59:56',	NULL),
(4,	'528 Custom Vape',	NULL,	'2021-10-22 13:00:43',	NULL),
(5,	'Norbert',	NULL,	'2021-10-22 13:04:10',	NULL),
(6,	'Vicious Ant',	NULL,	'2021-10-22 13:14:06',	NULL),
(7,	'Purge Mods',	'',	'2021-10-22 14:20:09',	NULL),
(8,	'Immortal Modz',	NULL,	'2021-10-22 14:22:54',	NULL),
(10,	'Reload Vapor',	'',	'2021-11-11 17:19:43',	NULL);

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

INSERT INTO `category` (`id`, `name`, `subtitle`, `home_order`, `created_at`, `updated_at`) VALUES
(1,	'RDA',	'Dripper',	0,	'2021-10-22 09:48:25',	NULL),
(2,	'Deck',	'Plateau de montage pour Dripper',	0,	'2021-10-22 10:00:19',	NULL),
(3,	'RTA Single',	'Tank Reconstructible Single Coil',	0,	'2021-10-22 13:04:57',	NULL),
(4,	'Genesis',	'Tank Genesis Reconstructible',	0,	'2021-10-22 13:05:53',	NULL),
(5,	'Bottom Feeder',	'Mécanique',	0,	'2021-10-22 13:15:14',	NULL),
(6,	'Tube Mecha',	'Mode mécanique tubulaire',	0,	'2021-10-22 13:27:10',	NULL),
(7,	'RTA Dual',	'Tank Reconstructible Dual Coil',	0,	'2021-11-14 10:26:50',	NULL),
(8,	'Box Mod',	'Box éléctronique',	0,	'2021-11-14 10:27:44',	NULL),
(9,	'Para Mech Mod',	'Box mécanique avec accus en parallèles',	0,	'2021-11-14 10:29:34',	NULL),
(10,	'Serial Mech Mod',	'Box mécanique avec accus en séries',	0,	'2021-11-14 10:29:56',	NULL);

DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sender_id` int unsigned NOT NULL COMMENT 'La personne qui envoie',
  `recipient_id` int unsigned NOT NULL COMMENT 'La personne qui reçoit',
  `is_read` tinyint unsigned NOT NULL DEFAULT '0' COMMENT 'Non lu = 0 , Lu = 1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_message_app_user1_idx` (`sender_id`),
  KEY `fk_message_app_user2_idx` (`recipient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `message` (`id`, `title`, `message`, `sender_id`, `recipient_id`, `is_read`, `created_at`, `updated_at`) VALUES
(1,	'Essai',	'Ceci est un message d&#39;essai',	18,	3,	1,	'2021-11-14 22:55:49',	'2021-11-19 09:15:00'),
(3,	NULL,	'Comment vas tu ?',	3,	18,	0,	'2021-11-16 09:43:08',	NULL),
(17,	NULL,	'?',	3,	18,	0,	'2021-11-16 22:06:47',	NULL),
(18,	NULL,	'Nikel merci ',	18,	3,	1,	'2021-11-16 22:11:15',	'2021-11-19 09:15:00'),
(19,	NULL,	'Bon ben perfeto alors',	3,	18,	0,	'2021-11-16 22:34:11',	NULL),
(20,	NULL,	'Si tuto bene',	3,	18,	0,	'2021-11-16 22:34:18',	NULL),
(21,	NULL,	'Si si grazie',	18,	3,	1,	'2021-11-16 22:35:06',	'2021-11-19 09:15:00'),
(22,	NULL,	'Tuto bene',	18,	3,	1,	'2021-11-16 22:35:18',	'2021-11-19 09:15:00'),
(23,	NULL,	'Toutou beignet ?',	3,	18,	0,	'2021-11-16 22:35:36',	NULL),
(24,	NULL,	'Hmmmm wait',	3,	18,	0,	'2021-11-16 22:35:47',	NULL),
(25,	NULL,	'POUAP !!',	3,	18,	0,	'2021-11-16 22:41:20',	NULL),
(26,	NULL,	'Essai',	3,	18,	0,	'2021-11-17 09:36:10',	NULL),
(27,	NULL,	'Salut salut',	18,	3,	1,	'2021-11-17 09:36:41',	'2021-11-19 09:15:00'),
(28,	NULL,	'Joyeux Noël',	3,	18,	0,	'2021-11-17 21:07:53',	NULL),
(29,	NULL,	'Et joyeuses pâques',	3,	18,	0,	'2021-11-17 21:08:02',	NULL),
(30,	NULL,	'by the way',	3,	18,	0,	'2021-11-17 21:08:08',	NULL),
(31,	NULL,	'Hello',	3,	18,	0,	'2021-11-18 09:44:26',	NULL),
(32,	NULL,	'Hello to you too bro',	18,	3,	1,	'2021-11-18 09:45:30',	'2021-11-19 09:15:00'),
(33,	NULL,	'Bien le bonjour',	3,	18,	0,	'2021-11-18 10:01:56',	NULL),
(34,	NULL,	'Bonjour bonjour, comment allez-vous?',	18,	3,	1,	'2021-11-18 10:02:18',	'2021-11-19 09:15:00'),
(36,	NULL,	'test',	3,	18,	0,	'2021-11-18 17:37:49',	NULL),
(37,	NULL,	'How are U today ?',	18,	3,	0,	'2021-11-19 09:15:32',	NULL),
(38,	'Question sur le matériel',	'Bonjour, j\'aurais une question sur votre annonce',	20,	3,	1,	'2021-11-19 09:17:20',	'2021-11-19 10:11:35');

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

INSERT INTO `order` (`id`, `app_user_id`, `adress_id`, `price`, `status`, `created_at`, `updated_at`) VALUES
(8,	3,	3,	71,	2,	'2021-11-07 19:29:35',	'2021-11-07 22:09:33'),
(9,	3,	3,	478.4,	1,	'2021-11-08 15:36:39',	NULL),
(10,	3,	3,	259,	2,	'2021-11-10 14:24:45',	'2021-11-10 14:26:00'),
(11,	3,	3,	478.4,	1,	'2021-11-10 20:35:36',	NULL);

DROP TABLE IF EXISTS `order_has_product`;
CREATE TABLE `order_has_product` (
  `order_id` int unsigned NOT NULL,
  `product_id` int unsigned NOT NULL,
  PRIMARY KEY (`order_id`,`product_id`),
  KEY `fk_order_has_product_order1_idx` (`order_id`),
  KEY `fk_order_has_product_product1_idx` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `order_has_product` (`order_id`, `product_id`) VALUES
(8,	3),
(9,	8),
(10,	4),
(10,	6),
(11,	8),
(12,	8);

DROP TABLE IF EXISTS `picture`;
CREATE TABLE `picture` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `picture` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1,	'IMG-618ea0f565cc70.38582557.jpg',	'2021-11-12 17:14:29',	NULL),
(2,	'IMG-618ea0f56ce9a2.98790012.jpg',	'2021-11-12 17:14:29',	NULL),
(3,	'IMG-618ea0f5712e47.92417480.jpg',	'2021-11-12 17:14:29',	NULL),
(4,	'IMG-618f7b03dff384.72063678.jpg',	'2021-11-13 08:44:51',	NULL),
(5,	'IMG-618f7b03effe94.21438918.jpg',	'2021-11-13 08:44:51',	NULL),
(6,	'IMG-618f7b0401bf10.81598983.jpg',	'2021-11-13 08:44:52',	NULL),
(7,	'IMG-618ff6d285cdc6.86730351.jpg',	'2021-11-13 17:33:06',	NULL),
(8,	'IMG-618ff6d293c9f7.60989644.jpg',	'2021-11-13 17:33:06',	NULL),
(9,	'IMG-618ff6d29aafc2.43291989.jpg',	'2021-11-13 17:33:06',	NULL),
(10,	'IMG-618ff7b09b0bc5.09523038.jpg',	'2021-11-13 17:36:48',	NULL),
(11,	'IMG-618ff7b0a46298.90894366.jpg',	'2021-11-13 17:36:48',	NULL),
(12,	'IMG-618ff7b0abf810.60698949.png',	'2021-11-13 17:36:48',	NULL);

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

INSERT INTO `product` (`id`, `name`, `description`, `subtitle`, `picture`, `price`, `rate`, `status`, `created_at`, `updated_at`, `brand_id`, `category_id`, `type_id`, `app_user_id`) VALUES
(1,	'Hadaly RDA',	'Le Hadaly de Psyclone est un dripper aux minuscules dimensions et aux qualités immenses.\r\n\r\nL’un des principaux points forts du Hadaly est son rendu des saveurs tout bonnement stupéfiant. Petit mais costaud, il magnifie comme nul autre atomiseur les saveurs d’un eliquide.\r\n\r\nPsyclone a conçu l’architecture de ce dripper de sorte que les airflows captent les arômes sans que la moindre miette n’en soit égarée. Des coils jusqu\'aux papilles, la puissance aromatique des eliquides reste intacte.\r\n\r\nLe Hadaly RDA dispose en outre d’un plateau de montage simple et astucieux baptisé Coil Clamping System (CCS). Les coils y sont serrés par étaux et permettent ainsi l’utilisation de fils allant des plus fins aux plus épais.',	'Le mythique dripper single-coil saveurs de Psyclone mods. Un game changer',	'had.png',	40.00,	5,	1,	'2021-10-22 09:50:43',	NULL,	1,	1,	1,	3),
(2,	'C2MNT',	'Après le CSMNT / Cosmonaut RDA, un classique des RDA 24 un peu souvent oublié, D5 est de retour avec une V2 !\r\nIssu de la collaboration entre District5ve et Haus of zombi, ‘‘pi2 etc.. ‘’ le C2MNT se voudra sobre au visuel. Le très efficace plateau en acier inoxydable sera postless. Équipé de quatre vis de beau diamètre, il saura maintenir vos montages les plus gros ! En effet, l’utilisation de montages en double coils exotiques pour cet atomiseur est fortement recommandé ! Les airflows, réglables en tournant le top cap dans la cloche permettront une vape très aérienne en étant totalement ouverts. Le drip tip surplombant l’ensemble est de type 810 (sans joints) afin de parfaire l’aspect visuel de votre futur mod ! Ce C2MNT mesure 24mm ce qui le rend compatible visuellement) avec une majorité de mod. Le pin 510 classique qui vous sera fourni t , sera compatible avec une utilisation hybride de cet atomiseur. Dans le cadre d’une utilisation classique de ce dripper, sachez que la cuve mesure 4 mm, ce qui vous fera profiter d’une belle reserve de votre e-liquide préféré !',	'La fameuse V2 tant attendue de l\'un des meilleurs RDA 24 of all times qui nous viens du modder District F5ve, le C2MNT aka Cosmonaut V2.',	'd5.png',	45.00,	5,	1,	'2021-10-22 09:55:36',	NULL,	2,	1,	1,	3),
(3,	'Battle Deck',	'La base Battle Deck est destinée à s’associer aux caps de la marque, pour constituer des dripper de 24mm.ou plus, suivant le modèle de cap.\r\n\r\nComp Lyfe propose en effet un système à la carte pour ses drippers. La marque produit des pièces indépendantes, pour que chacun puisse concevoir son propre setup, selon ses besoins et ses goûts, parmi un large choix de designs et de matériaux : base (Battle Deck), top caps (Cap) et drip tips.\r\n\r\nLes Battle Decks sont conçus pour autoriser des montages puissants avec de gros fils, tout en facilitant le montage et en assurant une conductivité parfaite, véritable obsession chez Comp Lyfe.\r\n\r\nLeur conception est donc très simple, basée sur deux posts robustes, et c’est dans le choix des matériaux que Comp Lyfe offre de nombreuses options : acier, titane, laiton, cuivre, argent…\r\n\r\nSur ce modèle, la base est en acier, pour être légère. le pôle positif et le pin sont en argent, pour une conductivité parfaite, les vis sont en titane, avec des empreintes profondes, pour un serrage optimal.',	'Un deck de 20 mm en dual post pensé jusqu\'au bout des ongles pour accueillir vos plus beaux montages et l\'habiller avec un top cap de la marque!',	'cl.png',	60.00,	4,	1,	'2021-10-22 10:00:31',	'2021-11-07 22:09:33',	3,	2,	1,	3),
(4,	'Goon 25',	'Après un long moment d\'attente, le fabricant emblématique 528 Custom Vapes revient avec une toute nouvelle version du Goon, une troisième.\r\n\r\nAvec 25 mm de diamètre, ce dripper imposant offre un bel espace de montage de 25 mm. Deux post à clamp composé de 4 vis viennent fixer solidement vos coils. Le plateau de montage du Goon 25 RDA permet d\'envisager au choix un mono ou un dual coil. \r\n\r\nL\'air flow en ultem est situé légèrement en hauteur au niveau des coils permet une aération excellente mais également un système anti-fuite efficace. Ce dernier se règle par le haut en tournant le top cap du Goon 25 RDA.\r\n\r\n528 Custom Vapes n\'oublie pas les amateurs de bottom-feeder en offrant dans son pack un pin 510 BF pour tous ceux qui aiment squonker sur des mods BF.\r\n\r\nLe dripper Goon 25 RDA est un véritable réussite qui s\'adresse avant tout aux vapoteurs expérimentés à la recherche de vapeur !',	'Après le Best Seller du Goon V1 que le monde s\'est arraché, il reviens en version 25mm',	'go.png',	37.00,	4,	1,	'2021-10-22 13:03:50',	'2021-11-10 14:26:00',	4,	1,	1,	3),
(5,	'Origen V2 MK-II',	'L\'Origen Genesis V2 MKII est conçu en acier acier inoxydable, cet atomiseur reconstructible de montage genesis est muni d\'un système de flux d\'air réglable. Les trous d\'arrivés d\'airs de l\'Origen Genesis V2 sont aux nombres de quatre  et vous permettent d\'avoir un air flow réglable en simple ou dual coils. Pour se faire vous pouvez verrouillé la bague située sur le top cap. \r\n\r\nSur le plateau de l\'Origen Genesis V2 MKII nous retrouvons sur le plateau de travail, 2 pôles négatifs (clés Allen), 1 pôle positif, 2 trous pour Mesh d\'un diamètre de 4,5 mm, 2 trous pour le câble acier de 3,5 mm ainsi qu\'un trou de remplissage. Plusieurs type de montages sont possibles. \r\n\r\nL\'Origen Genesis V2 MKII possède un tank en Makrolon d\'une contenance de 6 ml. Le plot central ajustable est en laiton afin d\'assurer une conductivité sans faille.\r\n\r\nle rendu des saveurs est exceptionnelle et la production de vapeur est impressionnante pour le meilleur atomiseur Genesis du marché ! \r\n\r\nUn numéro de série unique est gravé sous Origen Genesis V2 MKII. ',	'Le meilleur du Genesis du très discret modder Norbert dans une version re-re-re-revisité.',	'origen.png',	90.00,	5,	1,	'2021-10-22 13:12:54',	NULL,	5,	4,	1,	3),
(6,	'Spade 18650',	'L\'un des mods les plus célèbres, les plus beaux et les plus désirables depuis un certain temps, la Spade . Fabriqué à partir de matériaux de qualité supérieure, ce mod ne manquera pas d\'attirer l\'attention de tous, tout en améliorant définitivement votre expérience de squonk. Tout est bien pensé, de A à Z. Chaque mod est unique',	'Vous aimez le BF? Cette box unique est faite pour vous. Le Philippin Vicious Ant fait toujours de plus en plus fort! Sacré fourmi',	'spade.png',	180.00,	5,	1,	'2021-10-22 13:21:04',	'2021-11-10 14:26:00',	6,	5,	2,	3),
(7,	'Bolt Mod',	'C’est un classique de chez Comp Lyfe, d\'abord usiné en 2016, puis réédité derrière sous pleins de designs.\r\nLa qualité de son usinage met en valeur ces matières nobles tout en lui assurant un look d’enfer.\r\n\r\nLe mod BOLT fonctionne avec des accus type 18650.',	'Un des nombreux mods de CompLyfe qui offre une prise en main extra, une conductivité monstrueuse, un switch court pour la compétition.',	'bolt.jpg',	150.00,	5,	1,	'2021-10-22 13:29:00',	NULL,	3,	6,	3,	3),
(8,	'Cobra Slam Piece',	'Le mod Cobra Slam Piece est doté d’un design unique, qui est une édition limitée du Slam Piece de Purge Mods, qui marque le retour du maître de la gravure de mods : Hagerman ! Cette gravure d\'une main de maître lui donne tout son charme. Le mécanisme de son switch est constitué d’une lamelle en ultem noir qui actionne un contact massif en cuivre pour assurer une conductivité redoutable. La conception du “Side Fire” unique à Purge mods est simple de fonctionnement et d’entretien et permet un ajustement des accus qui évitera tout “rattle”. Le poids et la précision des filetages des tubes Purge vous rappellera constamment la qualité des ces mods américains.',	'Le maître de la gravure sur mod reviens sur sa collaboration mythique avec Purge Mods pour un mod monstrueux avec un switch latéral.',	'cobra-slam.jpg',	400.00,	4,	1,	'2021-10-22 14:22:38',	NULL,	7,	6,	3,	3),
(9,	'Reckoning',	'Reckoning RDA de Immortal Modz, ex Armageddon est un dripper 25 mm équipé d\'un plateau de montage très original. Il est livré avec un pin BF pour les possesseurs de box mod bottom feeder.\r\n\r\nLe dripper Reckoning est conçu pour être monté en double coil. Son deck gigantesque permet de le monter avec du fil résistif exotiques de large diamètre ainsi que du mesh. Clairement orienté power vaping, le Reckoning BF RDA est une machine à clouds qui produit un maximum de vapeur.',	'Armeggedon reviens sous le nom d\'Immortal Modz avec un dripper intéressant permettant de nombreux montages, jusqu\'au mesh.',	'reckoning.jpg',	30.00,	4,	2,	'2021-10-22 14:25:08',	'2021-11-03 21:04:35',	8,	1,	1,	3),
(10,	'Battle Cry',	'Variante de l\'un de leurs mods les plus populaires, le Battle Cry MOD proposé par Comp Lyfe est une œuvre d\'art exceptionnellement usinée, parfaitement conçue et exécutée de manière experte. Les bords tranchants et ciselés symétriquement usinés à partir du châssis en laiton naval scintillent et brillent même dans la plus faible lumière. \r\n<br>\r\nCette édition de la série Battle de Comp Lyfe comprend un switch lowrider en laiton avec un contact de batterie en cuivre, un mécanisme magnétique et un bouton exclusif en laiton pour la série Collector.',	'Digne successeur du Battlefield dans une toute nouvelle version, le Battle Cry est une oeuvre d\'art de ceiselage et d\'usinage, avec un switch lowrider!',	'cl-stark.jpeg',	220.00,	5,	1,	'2021-10-23 11:14:28',	NULL,	3,	6,	3,	3),
(13,	'Reload V1.5',	'Reload Vapor propose une nouvelle version de son best seller, un dripper monstrueux, une vraie machine à vapeur, qui devrait ravir les adeptes des montages hors normes.\r\n\r\nLe Reload BF RDA 1,5 est un dripper bottom feeder de 24mm de diamètre conçu aux USA. Son plateau plaqué or est doté de 4 posts aux entrées assez larges pour accueillir tout type de câble.\r\n\r\nSes 4 airflows en bottom coil vont refroidir vos résistances et vous procurer un rendu saveur très riche.',	'Un dripper orienté pour les saveurs ainsi que pour le cloud chasing. Partant sur la base d&#39;un Kennedy, il est pourtant bien meilleur au niveau des performances.',	'618d50af237a02.88224698.jpeg',	35.00,	4,	1,	'2021-11-11 17:19:43',	NULL,	10,	1,	1,	3),
(14,	'Vital RDA',	'Reprenant les courbes de l&#39;apocalypse RDA, le Vital RDA est un bijou made in Armageddon MFG en collaboration avec Immortal Modz.\r\n\r\nReprenant toujours l&#39;esprit des premiers apocalypse, on se retrouve avec un topcap en acier inoxydable avec un drip-tip 810 rappelant les &#34;Apo&#34; Gen1/Gen2 avec ici une\r\n\r\nmagnifique gravure Vital ainsi qu&#39;une étoile avec une tête de mort en arrière plan.\r\nA l&#39;intérieur on reste également sur la même base des anciens apocalypse avec un système de fixation par clamp,cela respire la qualité et c&#39;est surtout taillé pour accepter des coils les plus fous !!',	'Amateur de l&#39;apocalypse ? Voici sa déclinaison by  Immortal Modz',	'IMG-618ea0eb77a5e5.79389947.png',	25.00,	3,	1,	'2021-11-12 17:14:19',	NULL,	8,	1,	1,	3);

DROP TABLE IF EXISTS `product_has_picture`;
CREATE TABLE `product_has_picture` (
  `product_id` int unsigned NOT NULL,
  `picture_id` int unsigned NOT NULL,
  PRIMARY KEY (`product_id`,`picture_id`),
  KEY `fk_product_has_picture_product1_idx` (`product_id`),
  KEY `fk_product_has_picture_picture1_idx` (`picture_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `product_has_picture` (`product_id`, `picture_id`) VALUES
(1,	10),
(1,	11),
(1,	12),
(4,	4),
(4,	5),
(4,	6),
(5,	7),
(5,	8),
(5,	9),
(14,	1),
(14,	2),
(14,	3);

DROP TABLE IF EXISTS `type`;
CREATE TABLE `type` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL COMMENT 'Le nom du type',
  `footer_order` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'L''ordre d''affichage du type dans le footer (0=pas affichée dans le footer)',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'La date de création de la catégorie',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'La date de la dernière mise à jour de la catégorie',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `type` (`id`, `name`, `footer_order`, `created_at`, `updated_at`) VALUES
(1,	'Atomiseurs',	0,	'2021-10-22 09:49:54',	NULL),
(2,	'Box',	0,	'2021-10-22 13:14:50',	NULL),
(3,	'Mod Mecha',	0,	'2021-10-22 13:28:25',	NULL);

-- 2021-11-19 13:53:48