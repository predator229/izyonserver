-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.7.33 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour izystock
CREATE DATABASE IF NOT EXISTS `izystock` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `izystock`;

-- Listage de la structure de la table izystock. annexes
CREATE TABLE IF NOT EXISTS `annexes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nomAnnexe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresseAnnexe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephoneAnnexe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idEtablissement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table izystock.annexes : ~0 rows (environ)
DELETE FROM `annexes`;
/*!40000 ALTER TABLE `annexes` DISABLE KEYS */;
INSERT INTO `annexes` (`id`, `nomAnnexe`, `adresseAnnexe`, `telephoneAnnexe`, `idEtablissement`, `created_at`, `updated_at`) VALUES
	(2, 'Annexe principale', 'Parakou Benin', '0022960104599', '2', NULL, NULL);
/*!40000 ALTER TABLE `annexes` ENABLE KEYS */;

-- Listage de la structure de la table izystock. approvisonnements
CREATE TABLE IF NOT EXISTS `approvisonnements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idproduit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idannexe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nbre` int(11) NOT NULL,
  `idemploye` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table izystock.approvisonnements : ~0 rows (environ)
DELETE FROM `approvisonnements`;
/*!40000 ALTER TABLE `approvisonnements` DISABLE KEYS */;
INSERT INTO `approvisonnements` (`id`, `idproduit`, `idannexe`, `nbre`, `idemploye`, `created_at`, `updated_at`) VALUES
	(7, '3', '2', 1000, '12', '2022-01-15 08:45:00', '2022-01-15 08:45:00');
/*!40000 ALTER TABLE `approvisonnements` ENABLE KEYS */;

-- Listage de la structure de la table izystock. boutiques
CREATE TABLE IF NOT EXISTS `boutiques` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nomEtablissement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresseEtablissement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephoneEtablissement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table izystock.boutiques : ~0 rows (environ)
DELETE FROM `boutiques`;
/*!40000 ALTER TABLE `boutiques` DISABLE KEYS */;
INSERT INTO `boutiques` (`id`, `nomEtablissement`, `adresseEtablissement`, `telephoneEtablissement`, `created_at`, `updated_at`) VALUES
	(2, 'FuncodeS', 'Benin, Parakou, Tibona', '0022960104599', NULL, NULL);
/*!40000 ALTER TABLE `boutiques` ENABLE KEYS */;

-- Listage de la structure de la table izystock. categorie_produits
CREATE TABLE IF NOT EXISTS `categorie_produits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idannexe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table izystock.categorie_produits : ~0 rows (environ)
DELETE FROM `categorie_produits`;
/*!40000 ALTER TABLE `categorie_produits` DISABLE KEYS */;
INSERT INTO `categorie_produits` (`id`, `libelle`, `idannexe`, `created_at`, `updated_at`) VALUES
	(3, 'Logiciel informatique', '2', '2022-01-15 08:40:21', '2022-01-15 08:40:21');
/*!40000 ALTER TABLE `categorie_produits` ENABLE KEYS */;

-- Listage de la structure de la table izystock. clients
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table izystock.clients : ~0 rows (environ)
DELETE FROM `clients`;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` (`id`, `name`, `tel`, `created_at`, `updated_at`) VALUES
	(6, 'Client test', '888888888', '2022-01-15 08:49:28', '2022-01-15 08:49:28');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;

-- Listage de la structure de la table izystock. factures
CREATE TABLE IF NOT EXISTS `factures` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idclient` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant` double NOT NULL,
  `idemploye` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idannexe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table izystock.factures : ~0 rows (environ)
DELETE FROM `factures`;
/*!40000 ALTER TABLE `factures` DISABLE KEYS */;
INSERT INTO `factures` (`id`, `idclient`, `montant`, `idemploye`, `idannexe`, `created_at`, `updated_at`) VALUES
	(7, '6', 123000.00000000001, '13', '2', '2022-01-15 08:49:32', '2022-01-15 08:49:32');
/*!40000 ALTER TABLE `factures` ENABLE KEYS */;

-- Listage de la structure de la table izystock. migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table izystock.migrations : ~0 rows (environ)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Listage de la structure de la table izystock. password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table izystock.password_resets : ~0 rows (environ)
DELETE FROM `password_resets`;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Listage de la structure de la table izystock. produits
CREATE TABLE IF NOT EXISTS `produits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idcategorie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` int(11) NOT NULL,
  `seuil` int(11) NOT NULL,
  `imageProduit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idannexe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table izystock.produits : ~0 rows (environ)
DELETE FROM `produits`;
/*!40000 ALTER TABLE `produits` DISABLE KEYS */;
INSERT INTO `produits` (`id`, `libelle`, `idcategorie`, `description`, `prix`, `seuil`, `imageProduit`, `idannexe`, `created_at`, `updated_at`) VALUES
	(3, 'Izystock', '3', 'Izystock est un logiciel de gestion de stock adapte pour tous type d\'entrprise. Il comprend les modules suivants :\r\n-Gestion des aprovisionnement (entres)\r\n-Gestion des soties (ventes)\r\n-Gestion des stocks-marchandises\r\n-Gestion de la clientele\r\n-Gestion de la facturation\r\n-Gestion des registre (tres avancee)\r\n\r\nIzystock est l\'outil informatique adequat qu\'il vous faut, absolument avoir.', 150000, 10, 'storage/app/img/produit/RCaphANUTtm3tEcopE1dpO0uKIoOkSLNQNPO32tF.png', '2', '2022-01-15 08:45:00', '2022-01-15 08:45:00');
/*!40000 ALTER TABLE `produits` ENABLE KEYS */;

-- Listage de la structure de la table izystock. stocks
CREATE TABLE IF NOT EXISTS `stocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idproduit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idannexe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nbre` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table izystock.stocks : ~0 rows (environ)
DELETE FROM `stocks`;
/*!40000 ALTER TABLE `stocks` DISABLE KEYS */;
INSERT INTO `stocks` (`id`, `idproduit`, `idannexe`, `nbre`, `created_at`, `updated_at`) VALUES
	(3, '3', '2', 999, '2022-01-15 08:45:00', '2022-01-15 08:49:32');
/*!40000 ALTER TABLE `stocks` ENABLE KEYS */;

-- Listage de la structure de la table izystock. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idannexe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cheminImage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'img/friends/fr-02.jpg',
  `typeUtilisateur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'seller',
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delete` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `delet_motif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pas de motif',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table izystock.users : ~0 rows (environ)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `adresse`, `telephone`, `idannexe`, `cheminImage`, `typeUtilisateur`, `email`, `password`, `delete`, `delet_motif`, `remember_token`, `created_at`, `updated_at`) VALUES
	(12, 'Damien Padonou', 'Cluj-Napoca', '0736141740', '2', 'img/friends/fr-02.jpg', 'AdminSysteme', 'damien@funcodes.com', '$2y$10$aQbvXjzfBaJHtv3WZWeKkuHFHLO7YAk6.xwZGj1JJ8JCavVwgWRPO', 'no', 'Pas de motif', NULL, '2022-01-14 14:36:33', '2022-01-14 20:45:54'),
	(13, 'damien vendeur', 'Cluj-Napoca, Cluj Romania', '0736141740', '2', 'img/friends/fr-02.jpg', 'Vendeur', 'vendeur@funcodes.bj', '$2y$10$MSsy0jd8kPBpsbb7E/IrsO0JROQCxxM8tJTOJgFCQMNsAHmWXjsJm', 'no', 'Pas de motif', 'iWixKmHnIx54F8UbKEPPl9guhAJ2PTz7roN5MA4njvYc4iAawE0EUkIMyW6P', '2022-01-15 07:11:44', '2022-01-15 07:11:44'),
	(14, 'thuret gbg', 'Calavi,Benin', '022999870593', '2', 'img/friends/fr-02.jpg', 'Vendeur', 'thuret@funcodes.com', '$2y$10$jHNpEQfKOOjk9Py.99q5s.0DSJ.ossXKm.LEgGDkPjR5Qz7t9iXDy', 'no', 'Pas de motif', 'xbAuydb7PYSW8S2FRVEe9TyPpS7vvVIYPACYYwZ0lBnqvsWVwWWWHkYOh3TH', '2022-01-15 07:42:51', '2022-01-15 07:42:51');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Listage de la structure de la table izystock. ventes
CREATE TABLE IF NOT EXISTS `ventes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idclient` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idproduit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qte` double NOT NULL,
  `prixV` double NOT NULL,
  `idfacture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idemploye` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idannexe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table izystock.ventes : ~0 rows (environ)
DELETE FROM `ventes`;
/*!40000 ALTER TABLE `ventes` DISABLE KEYS */;
INSERT INTO `ventes` (`id`, `idclient`, `idproduit`, `qte`, `prixV`, `idfacture`, `idemploye`, `idannexe`, `created_at`, `updated_at`) VALUES
	(8, '6', '3', 1, 123000.00000000001, '7', '13', '2', '2022-01-15 08:49:32', '2022-01-15 08:49:32');
/*!40000 ALTER TABLE `ventes` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
