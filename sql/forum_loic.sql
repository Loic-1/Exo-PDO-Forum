-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour forum_loic
CREATE DATABASE IF NOT EXISTS `forum_loic` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `forum_loic`;

-- Listage de la structure de table forum_loic. category
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- Listage des données de la table forum_loic.category : ~0 rows (environ)
DELETE FROM `category`;
INSERT INTO `category` (`id_category`, `name`) VALUES
	(1, 'cat1'),
	(2, 'cat2'),
	(3, 'cat3'),
	(4, 'cat4'),
	(5, 'cat5');

-- Listage de la structure de table forum_loic. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `topic_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id_post`),
  KEY `topic_id` (`topic_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `FK_post_topic` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`),
  CONSTRAINT `FK_post_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- Listage des données de la table forum_loic.post : ~0 rows (environ)
DELETE FROM `post`;

-- Listage de la structure de table forum_loic. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL DEFAULT '',
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `closed` tinyint NOT NULL,
  `category_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id_topic`),
  KEY `category_id` (`category_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `FK_topic_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`),
  CONSTRAINT `FK_topic_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- Listage des données de la table forum_loic.topic : ~0 rows (environ)
DELETE FROM `topic`;
INSERT INTO `topic` (`id_topic`, `title`, `creationDate`, `closed`, `category_id`, `user_id`) VALUES
	(1, 'top1', '2024-10-29 14:21:21', 1, 1, 1),
	(2, 'top2', '2024-10-29 14:21:55', 1, 2, 2),
	(3, 'top3', '2024-10-29 14:23:56', 1, 3, 1),
	(4, 'top4', '2024-10-29 14:24:20', 1, 4, 2),
	(5, 'top5', '2024-10-29 14:24:39', 1, 5, 1),
	(6, 'top1', '2024-10-29 14:25:13', 1, 1, 2);

-- Listage de la structure de table forum_loic. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nickName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL DEFAULT '',
  `password` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL DEFAULT '',
  `registrationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `roles` json DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `isBanned` tinyint DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- Listage des données de la table forum_loic.user : ~0 rows (environ)
DELETE FROM `user`;
INSERT INTO `user` (`id_user`, `nickName`, `password`, `registrationDate`, `roles`, `avatar`, `email`, `isBanned`) VALUES
	(1, 'user1', '1', '2024-10-29 14:22:43', NULL, NULL, NULL, NULL),
	(2, 'user2', '2', '2024-10-29 14:23:00', NULL, NULL, NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
