/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : register

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

<<<<<<< HEAD
Date: 2024-06-05 14:30:57
=======
Date: 2024-05-15 15:14:44
>>>>>>> fdcf3ac0bc7103ec101333d572ddae28c826284b
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `lastname` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `company_code` varchar(255) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT 0,
  `role_name` varchar(255) NOT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
<<<<<<< HEAD
) ENGINE=InnoDB AUTO_INCREMENT=180 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
=======
) ENGINE=InnoDB AUTO_INCREMENT=176 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
>>>>>>> fdcf3ac0bc7103ec101333d572ddae28c826284b

-- ----------------------------
-- Records of users
-- ----------------------------
<<<<<<< HEAD
INSERT INTO `users` VALUES ('178', 'user', 'test', 'username', '$2y$10$4GwCANvosiAmh1u5aZgWJ.uvSSdRGtdLZ9oX68aOkDIBLsnGD42qS', '001', 'IT', 'user@bakalaros.gr', '1234567890', '0', 'ΙΤ', '0');
INSERT INTO `users` VALUES ('179', 'Administrator', 'Administrator', 'admin', '$2y$10$jQEdSkNWLHm/Pv.ynDkDTOMqigBK9WU94wrsnYcAQV/bDcdlbmXF.', '001,002,005,006:003,006:004,006:006,007', 'IT', 'helpdesk@bakalaros.gr', '6936124333', '0', 'ΙΤ', '1');
=======
INSERT INTO `users` VALUES ('171', 'Vassiliki', 'Poupouza', 'vpoupouza', '$2y$10$dIEL55fd1y.xVYfQIF5Xo.ITm9LR4xwrZ1JNpCi8RRr.2lQsd9aoG', '001,002,005,006:003,006:004,006:006,007,008', 'IT', 'vpoupouza@bakalaros.gr', '6976500903', '0', 'ΙΤ', '0');
INSERT INTO `users` VALUES ('172', 'Σωτήριος', 'Σωτηρακόπουλος', 'ssotirakopoulos', '$2y$10$ymXJJyf01xUh/FVwrw8UC./IhqWPBor9nCA3iUQ/ERX58jNSOhOY2', '001,002,005,006:003,006:004,006:006,007,008', 'IT', 'ssotirakopoulos@bakalaros.gr', '6976236028', '0', 'ΙΤ', '1');
INSERT INTO `users` VALUES ('173', 'Ευάγγελος', 'Πετρόπουλος', 'vpetropoulos', '$2y$10$eBjwp17cW38S2mQlWGHpr.DP5/OuaG0NCXrQet1yo4fEHUEhdbLzy', '001,002,005,006:003,006:004,006:006,007,008', 'IT', 'vpetropoulos@bakalaros.gr', '6936124333', '0', 'ΙΤ', '1');
>>>>>>> fdcf3ac0bc7103ec101333d572ddae28c826284b
