/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-09-13 15:12:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for pa_spec
-- ----------------------------
DROP TABLE IF EXISTS `pa_spec`;
CREATE TABLE `pa_spec` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(10) unsigned DEFAULT NULL COMMENT 'mall_goods_type 的id',
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='商品规格';

-- ----------------------------
-- Records of pa_spec
-- ----------------------------
INSERT INTO `pa_spec` VALUES ('1', '2', '颜色');
INSERT INTO `pa_spec` VALUES ('2', '2', '内存');
