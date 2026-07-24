/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : register

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2024-05-13 16:26:08
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `answers`
-- ----------------------------
DROP TABLE IF EXISTS `answers`;
CREATE TABLE `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `answer` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of answers
-- ----------------------------

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
INSERT INTO `company` VALUES ('008', 'FDRINK ΑΕ', '1: Αποθήκη Κεντρική', '');
INSERT INTO `company` VALUES ('10', '010- ΚΔ Μ', '', '');

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
INSERT INTO `department` VALUES ('Παροχές', '', '', '', '');
INSERT INTO `department` VALUES ('Πιστωτικός Έλεγχος', '', '', 'Πάνας Νικόλαος', '');
INSERT INTO `department` VALUES ('Πωλητές', '', '', '', '');
INSERT INTO `department` VALUES ('Τιμολόγηση', '', 'logistirio@bakalaros.gr', ' Κονιδάρης Νίκος', ' Εφoδιαστική Αλυσιδα και Νέες Τεχνολογίες');
INSERT INTO `department` VALUES ('Τμήμα Ανάλυσης δεδομένων', '', '', 'Θανάσης Κλαμπανάς', ' Εφoδιαστική Αλυσιδα και Νέες Τεχνολογίες');

-- ----------------------------
-- Table structure for `requests`
-- ----------------------------
DROP TABLE IF EXISTS `requests`;
CREATE TABLE `requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `request` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `title` text NOT NULL,
  `answer` text DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `completed` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of requests
-- ----------------------------
INSERT INTO `requests` VALUES ('20', 'Βασιλική Πούπουζα', 'vpoupouza@bakalaros.gr', '171', '1234', '2024-05-10 15:46:03', '1234', null, '2024-05-10 15:46:03', null);
INSERT INTO `requests` VALUES ('21', 'Βασιλική Πούπουζα', 'vpoupouza1@bakalaros.gr', '174', '123\r\n', '2024-05-10 15:59:35', '15466543', 'NAI', '2024-05-10 16:44:16', null);
INSERT INTO `requests` VALUES ('22', 'Βασιλική Πούπουζα', 'vpoupouza@bakalaros.gr', '171', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur? [33] At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', '2024-05-10 17:05:02', 'test', '\"Η εκπαίδευση αποτελεί το θεμέλιο για την ανάπτυξη της κοινωνίας. Μέσω της συνεχούς μάθησης και της ανοιχτής διανόησης, διαμορφώνουμε ένα μέλλον γεμάτο ευκαιρίες και προοπτικές. Ας ενθαρρύνουμε την εκπαίδευση σε κάθε επίπεδο και ας δημιουργήσουμε έναν κόσμο όπου η γνώση είναι προσβάσιμη για όλους.\"', '2024-05-13 13:56:11', null);

-- ----------------------------
-- Table structure for `roles`
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `role_name` varchar(255) NOT NULL,
  `role_description` varchar(255) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  PRIMARY KEY (`role_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('Εξυπηρέτηση Πελατών ', '', '');
INSERT INTO `roles` VALUES ('ΙΤ', '', '');
INSERT INTO `roles` VALUES ('Λογιστήριο', '', '');
INSERT INTO `roles` VALUES ('Οικονομικός Διευθυντής', '', '');
INSERT INTO `roles` VALUES ('Πωλητής', '', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=175 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('171', 'Vassiliki', 'Poupouza', 'vpoupouza', '$2y$10$dIEL55fd1y.xVYfQIF5Xo.ITm9LR4xwrZ1JNpCi8RRr.2lQsd9aoG', '001,002,005,006:003,006:004,006:006,007,008', 'IT', 'vpoupouza@bakalaros.gr', '6976500903', '0', 'ΙΤ', '0');
INSERT INTO `users` VALUES ('172', 'Σωτήριος', 'Σωτηρακόπουλος', 'ssotirakopoulos', '$2y$10$ymXJJyf01xUh/FVwrw8UC./IhqWPBor9nCA3iUQ/ERX58jNSOhOY2', '001,002,005,006:003,006:004,006:006,007,008', 'IT', 'ssotirakopoulos@bakalaros.gr', '6976236028', '0', 'ΙΤ', '1');
INSERT INTO `users` VALUES ('173', 'Ευάγγελος', 'Πετρόπουλος', 'vpetropoulos', '$2y$10$eBjwp17cW38S2mQlWGHpr.DP5/OuaG0NCXrQet1yo4fEHUEhdbLzy', '001,002,005,006:003,006:004,006:006,007,008', 'IT', 'vpetropoulos@bakalaros.gr', '6936124333', '0', 'ΙΤ', '1');
