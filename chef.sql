/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50711
 Source Host           : localhost:3306
 Source Schema         : chef

 Target Server Type    : MySQL
 Target Server Version : 50711
 File Encoding         : 65001

 Date: 08/03/2018 14:53:07
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for chef
-- ----------------------------
DROP TABLE IF EXISTS `chef`;
CREATE TABLE `chef`  (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `cname` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `pic` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `phone` char(11) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `person_pic` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`cid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of chef
-- ----------------------------
INSERT INTO `chef` VALUES (1, '小明师傅', '擅长粤菜,粤菜因其选料严格、做工精细、中西结合、质鲜味美、养生保健等特点而名扬天下。', './images/6.jpg', '15735104507', './images/person-1.png');
INSERT INTO `chef` VALUES (2, '小白师傅', '擅长川菜,川菜取材广泛，调味多变，菜式多样，口味清鲜醇浓并重，以善用麻辣调味著称，并以其别具一格的烹调方法和浓郁的地方风味，融会了东南西北各方的特点，博采众家之长，善于吸收，善于创新，享誉中外。', './images/7.jpg', '15735104508', './images/person-2.png');
INSERT INTO `chef` VALUES (3, '小洪师傅', '擅长湘菜,湘菜制作精细，用料上比较广泛，口味多变，品种繁多；色泽上油重色浓，讲求实惠；品味上注重香辣、香鲜、软嫩；制法上以煨、炖、腊、蒸、炒诸法见称。', './images/8.jpg', '15735104509', './images/person-3.png');

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu`  (
  `cid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `mname` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `mpic` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`cid`, `mid`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES (1, 1, '可乐鸡翅', './images/menu-1.png');
INSERT INTO `menu` VALUES (1, 2, '蛋包饭', './images/menu-2.png');
INSERT INTO `menu` VALUES (1, 3, '皮蛋瘦肉粥', './images/menu-3.png');
INSERT INTO `menu` VALUES (1, 4, '菠萝咕咚肉', './images/menu-4.png');
INSERT INTO `menu` VALUES (1, 5, '时蔬大骨汤', './images/menu-5.png');
INSERT INTO `menu` VALUES (2, 1, '水煮鱼', './images/menu-6.png');
INSERT INTO `menu` VALUES (2, 2, '蛋包饭', './images/menu-2.png');
INSERT INTO `menu` VALUES (2, 3, '皮蛋瘦肉粥', './images/menu-3.png');
INSERT INTO `menu` VALUES (2, 4, '菠萝咕咚肉', './images/menu-4.png');
INSERT INTO `menu` VALUES (2, 5, '时蔬大骨汤', './images/menu-5.png');
INSERT INTO `menu` VALUES (3, 1, '水煮鱼', './images/menu-6.png');
INSERT INTO `menu` VALUES (3, 2, '蛋包饭', './images/menu-2.png');

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order`  (
  `oid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL,
  `uname` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `cname` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `uaddress` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `uphone` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `utime` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`oid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES (12, 2, 1, '薛雅芳', '小明师傅', '山西大学大东关校区', '15735104507', 84, '2017-06-08', 1);
INSERT INTO `order` VALUES (15, 2, 1, '小猫', '小明师傅', '山西大学大东关小区', '15735104507', 84, '2017-06-08', 1);
INSERT INTO `order` VALUES (14, 2, 1, '薛雅芳', '小明师傅', '小店区', '15735104507', 84, '2017-06-08', 1);
INSERT INTO `order` VALUES (16, 1, 1, '薛雅芳', '小明师傅', '太原市小店区', '18810216575', 84, '2017-10-31', 1);
INSERT INTO `order` VALUES (17, 8, 2, '王小姐', '小白师傅', '北京市昌平区', '18810216575', 84, '2017-10-31', 1);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`uid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'xiaobai', '123456');
INSERT INTO `user` VALUES (3, 'xiaohuang', '123456');
INSERT INTO `user` VALUES (4, 'dahuang', '123456');
INSERT INTO `user` VALUES (8, 'wan', '123456');
INSERT INTO `user` VALUES (9, 'lo', '123');
INSERT INTO `user` VALUES (10, 'xyf', '123456');
INSERT INTO `user` VALUES (11, 'xyf', '123456');

SET FOREIGN_KEY_CHECKS = 1;
