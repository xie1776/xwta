/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-09-13 15:12:07
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for pa_goods_store
-- ----------------------------
DROP TABLE IF EXISTS `pa_goods_store`;
CREATE TABLE `pa_goods_store` (
  `id` int(11) NOT NULL,
  `spec_item_key` varchar(50) DEFAULT NULL COMMENT '规格详细id 多个id以（_）连接',
  `store` int(10) unsigned NOT NULL DEFAULT '99' COMMENT '库存',
  `price` decimal(10,2) DEFAULT NULL,
  `bar_code` varchar(30) NOT NULL,
  `good_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品库存表';

-- ----------------------------
-- Records of pa_goods_store
-- ----------------------------
INSERT INTO `pa_goods_store` VALUES ('1', '1_3', '99', '2499.00', 'A1586', null);
INSERT INTO `pa_goods_store` VALUES ('2', '1_4', '99', '3299.00', 'A1587', null);
INSERT INTO `pa_goods_store` VALUES ('3', '2_3', '99', '2499.00', 'A1588', null);
