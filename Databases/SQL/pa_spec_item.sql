/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-09-13 15:12:29
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for pa_spec_item
-- ----------------------------
DROP TABLE IF EXISTS `pa_spec_item`;
CREATE TABLE `pa_spec_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `spec_id` int(10) unsigned DEFAULT '0' COMMENT '规格id',
  `item` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='规格详细';

-- ----------------------------
-- Records of pa_spec_item
-- ----------------------------
INSERT INTO `pa_spec_item` VALUES ('1', '1', '黑色');
INSERT INTO `pa_spec_item` VALUES ('2', '1', '白色');
INSERT INTO `pa_spec_item` VALUES ('3', '2', '16G');
INSERT INTO `pa_spec_item` VALUES ('4', '2', '64G');
