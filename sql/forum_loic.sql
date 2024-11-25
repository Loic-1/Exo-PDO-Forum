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
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- Listage des données de la table forum_loic.category : ~2 rows (environ)
INSERT INTO `category` (`id_category`, `name`) VALUES
	(30, 'Cat&eacute;gorie1'),
	(31, 'Cat&eacute;gorie2');

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
  CONSTRAINT `FK_post_topic` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`) ON DELETE CASCADE,
  CONSTRAINT `FK_post_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- Listage des données de la table forum_loic.post : ~4 rows (environ)
INSERT INTO `post` (`id_post`, `text`, `creationDate`, `topic_id`, `user_id`) VALUES
	(101, 'test1', '2024-11-25 08:50:53', 53, 32),
	(102, 'test2', '2024-11-25 08:51:02', 54, 32),
	(103, 'test3', '2024-11-25 08:51:38', 55, 33),
	(104, 'test4', '2024-11-25 08:51:46', 56, 33);

-- Listage de la structure de table forum_loic. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL DEFAULT '',
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `closed` tinyint DEFAULT '0',
  `category_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id_topic`),
  KEY `category_id` (`category_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `FK_topic_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`) ON DELETE CASCADE,
  CONSTRAINT `FK_topic_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- Listage des données de la table forum_loic.topic : ~4 rows (environ)
INSERT INTO `topic` (`id_topic`, `title`, `creationDate`, `closed`, `category_id`, `user_id`) VALUES
	(53, 'Topic1', '2024-11-25 08:50:53', 0, 30, 32),
	(54, 'Topic2', '2024-11-25 08:51:02', 0, 30, 32),
	(55, 'Topic3', '2024-11-25 08:51:38', 0, 31, 33),
	(56, 'Topic4', '2024-11-25 08:51:46', 0, 31, 33);

-- Listage de la structure de table forum_loic. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nickName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL DEFAULT '',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL DEFAULT '',
  `registrationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `roles` json DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci DEFAULT '',
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `isBanned` tinyint DEFAULT '0',
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `nickName` (`nickName`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- Listage des données de la table forum_loic.user : ~3 rows (environ)
INSERT INTO `user` (`id_user`, `nickName`, `password`, `registrationDate`, `roles`, `avatar`, `email`, `isBanned`) VALUES
	(32, 'user1', '$2y$10$CxbaxNb1m5.O9UwdUQt1mOwmvbcov3E4RCm4n9gC3r2OofT9xQRk.', '2024-11-25 08:47:08', '["ROLE_USER", "ROLE_ADMIN"]', '', 'user1@test.fr', 0),
	(33, 'user2', '$2y$10$gDtHbUKIUYRbN/Hpom221.3uMBM17mKGgSXX4JbqEdBwWMtDed4NO', '2024-11-25 08:47:29', '["ROLE_USER", "ROLE_ADMIN"]', '', 'user2@test.fr', 0),
	(34, 'user3', '$2y$10$GENoZEzmn0i/f6HRBPe1iePlLvB7VkETuNVHugx5IQ5xzDpKAi1hq', '2024-11-25 09:36:50', '["ROLE_USER"]', '', 'user3@test.fr', 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
