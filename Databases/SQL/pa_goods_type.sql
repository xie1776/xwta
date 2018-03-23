/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-09-13 15:12:15
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for pa_goods_type
-- ----------------------------
DROP TABLE IF EXISTS `pa_goods_type`;
CREATE TABLE `pa_goods_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='商品类别';

-- ----------------------------
-- Records of pa_goods_type
-- ----------------------------
INSERT INTO `pa_goods_type` VALUES ('1', '笔记本');
INSERT INTO `pa_goods_type` VALUES ('2', '手机');
INSERT INTO `pa_goods_type` VALUES ('3', '鞋子');
