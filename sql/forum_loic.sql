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

-- Listage des données de la table forum_loic.category : ~2 rows (environ)
REPLACE INTO `category` (`id_category`, `name`) VALUES
	(1, 'category1'),
	(2, 'category2');

-- Listage des données de la table forum_loic.post : ~4 rows (environ)
REPLACE INTO `post` (`id_post`, `text`, `creationDate`, `topic_id`, `user_id`) VALUES
	(131, 'test1', '2024-11-21 13:24:14', 69, 33),
	(132, 'test2', '2024-11-21 13:24:30', 70, 33),
	(133, 'test3', '2024-11-21 13:24:40', 71, 33),
	(134, 'test4', '2024-11-21 13:24:47', 72, 33);

-- Listage des données de la table forum_loic.topic : ~4 rows (environ)
REPLACE INTO `topic` (`id_topic`, `title`, `creationDate`, `closed`, `category_id`, `user_id`) VALUES
	(69, 'Topic1', '2024-11-21 13:24:14', 0, 1, 33),
	(70, 'Topic2', '2024-11-21 13:24:30', 0, 1, 33),
	(71, 'Topic3', '2024-11-21 13:24:40', 0, 2, 33),
	(72, 'Topic4', '2024-11-21 13:24:47', 0, 2, 33);

-- Listage des données de la table forum_loic.user : ~1 rows (environ)
REPLACE INTO `user` (`id_user`, `nickName`, `password`, `registrationDate`, `roles`, `avatar`, `email`, `isBanned`) VALUES
	(33, 'user1', '$2y$10$aYHRzRcdK5V3GeXXEoFnc.dBIm9qG4uTjfJ75OepijWR6paPNEVou', '2024-11-21 08:18:20', '["ROLE_USER", "ROLE_ADMIN"]', '', 'user1@test.fr', 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
