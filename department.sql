/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : register

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2024-05-15 12:39:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `department`
-- ----------------------------
DROP TABLE IF EXISTS `department`;
CREATE TABLE `department` (
  `department_name` varchar(255) NOT NULL DEFAULT '',
  `company_code` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `department_manager` varchar(255) NOT NULL,
  `department_description` varchar(255) NOT NULL,
  PRIMARY KEY (`department_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of department
-- ----------------------------
INSERT INTO `department` VALUES ('IT', '001', 'helpdesk@bakalaros.gr', 'Πετρόπουλος Βαγγέλης', 'Τμήμα Πληροφορικής');
INSERT INTO `department` VALUES ('Αγορές', '', '', '', '');
INSERT INTO `department` VALUES ('Αποθήκη', '', '', '', '');
INSERT INTO `department` VALUES ('Εξυπηρέτηση Πελατών', '', '', '', '');
INSERT INTO `department` VALUES ('Λογιστήριο', '', '', '', '');
INSERT INTO `department` VALUES ('ΜΑ', '', '', '', '');
INSERT INTO `department` VALUES ('Παροχές', '', '', '', '');
INSERT INTO `department` VALUES ('Πιστωτικός Έλεγχος', '', '', 'Πάνας Νικόλαος', '');
INSERT INTO `department` VALUES ('Πωλητές', '', '', '', '');
INSERT INTO `department` VALUES ('Τιμολόγηση', '', 'logistirio@bakalaros.gr', ' Κονιδάρης Νίκος', ' Εφoδιαστική Αλυσιδα και Νέες Τεχνολογίες');
INSERT INTO `department` VALUES ('Τμήμα Ανάλυσης δεδομένων', '', '', 'Θανάσης Κλαμπανάς', ' Εφoδιαστική Αλυσιδα και Νέες Τεχνολογίες');
