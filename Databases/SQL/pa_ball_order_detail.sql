/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : xwta

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-09-11 14:39:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for pa_ball_order_detail
-- ----------------------------
DROP TABLE IF EXISTS `pa_ball_order_detail`;
CREATE TABLE `pa_ball_order_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_sn` varchar(20) NOT NULL DEFAULT '' COMMENT '订单表中的order_sn',
  `red` varchar(66) NOT NULL DEFAULT '' COMMENT '红球内容',
  `blue` varchar(32) NOT NULL DEFAULT '' COMMENT '篮球内容',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '投注时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='彩票下单详细表';
