/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : register

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2024-05-31 15:37:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `requests`
-- ----------------------------
DROP TABLE IF EXISTS `requests`;
CREATE TABLE `requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `request` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `completed` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of requests
-- ----------------------------
INSERT INTO `requests` VALUES ('69', 'test', 'user test', '', 'user@bakalaros.gr', '178', '1234', '2024-05-23 15:15:46', '2024-05-23 15:15:46', '0');
INSERT INTO `requests` VALUES ('71', 'Test', 'Βασιλική Πούπουζα', '', 'vpoupouza@bakalaros.gr', '171', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2024-05-29 14:54:04', '2024-05-29 14:54:04', '0');
INSERT INTO `requests` VALUES ('72', 'Entersoft', 'Βασιλική Πούπουζα', '', 'vpoupouza@bakalaros.gr', '178', 'Έχω πρόβλημα με το Entersoft.', '2024-05-29 15:04:15', '2024-05-29 15:04:15', null);
INSERT INTO `requests` VALUES ('73', 'αιτημα', 'Βασιλική Πούπουζα', '', 'vpoupouza@bakalaros.gr', '171', 'κανω αιτημα', '2024-05-29 17:03:33', '2024-05-29 17:03:33', null);
INSERT INTO `requests` VALUES ('75', 'Anydesk', 'user test', '', 'user@gmail.gr', '178', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2024-05-30 09:59:07', '2024-05-30 09:59:07', '1');
INSERT INTO `requests` VALUES ('80', '1', 'user test', '', 'user@bakalaros.gr', '178', '1', '2024-05-30 16:35:39', '2024-05-30 16:35:39', null);
INSERT INTO `requests` VALUES ('81', '2', 'Βασιλική Πούπουζα', '', 'vpoupouza@bakalaros.gr', '171', '2', '2024-05-30 16:35:59', '2024-05-30 16:35:59', null);
INSERT INTO `requests` VALUES ('82', '3', 'Βασιλική Πούπουζα', '', 'vpoupouza@bakalaros.gr', '171', '3', '2024-05-30 16:36:07', '2024-05-30 16:36:07', null);
INSERT INTO `requests` VALUES ('83', '4', 'Βασιλική Πούπουζα', '', 'vpoupouza@bakalaros.gr', '171', '4', '2024-05-30 16:36:18', '2024-05-30 16:36:18', '1');
INSERT INTO `requests` VALUES ('84', '5', 'Βασιλική Πούπουζα', '', 'vpoupouza@bakalaros.gr', '171', '5', '2024-05-30 16:36:27', '2024-05-30 16:36:27', '1');
INSERT INTO `requests` VALUES ('85', '6', 'Βασιλική Πούπουζα', '', 'vpoupouza@bakalaros.gr', '178', '6', '2024-05-30 16:36:45', '2024-05-30 16:36:45', '1');
INSERT INTO `requests` VALUES ('86', '7', 'user', '', 'user@bakalaros.gr', '178', '7', '2024-05-30 16:36:56', '2024-05-30 16:36:56', '1');
INSERT INTO `requests` VALUES ('90', 'δοκιμαστικο', 'Βασιλική Πούπουζα', '', 'vpoupouza@bakalaros.gr', '178', '123444', '2024-05-31 15:34:31', '2024-05-31 15:34:31', null);
