/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : register

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2024-05-15 12:11:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `company`
-- ----------------------------
DROP TABLE IF EXISTS `company`;
CREATE TABLE `company` (
  `company_code` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `department_name` varchar(255) NOT NULL,
  PRIMARY KEY (`company_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of company
-- ----------------------------
INSERT INTO `company` VALUES ('001', 'Κ.Δ.ΜΠΑΚΑΛΑΡΟΣ AE ', '1: Αποθήκη Κεντρική', '');
INSERT INTO `company` VALUES ('002', 'ΘΑΝΑΣΟΥΛΑΣ Α.Ε.', '1: Αποθήκη Κεντρική', '');
INSERT INTO `company` VALUES ('005', 'ΜΠΑΚΑΡ Α.Ε.', '1: Αποθήκη Κεντρική', '');
INSERT INTO `company` VALUES ('006:003', 'ΔΗΠΕΙΡΟΣ Α.Ε.', '1: Κεντρική Άρτας', '');
INSERT INTO `company` VALUES ('006:004', 'ΔΗΠΕΙΡΟΣ Α.Ε.', '1: Κεντρική Θεσπρωτίας', '');
INSERT INTO `company` VALUES ('006:006', 'ΔΗΠΕΙΡΟΣ Α.Ε.', '1: Κεντρική Ιωαννίνων', '');
INSERT INTO `company` VALUES ('007', 'ΚΑΒΑ ΚΟΥΛΙΕΡΗΣ Α.Ε.', '1: Αποθήκη Κεντρική', '');
INSERT INTO `company` VALUES ('12334', '1234', '', '');
