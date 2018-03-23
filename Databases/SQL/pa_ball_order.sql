/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : xwta

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-09-12 21:15:03
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for pa_ball_order
-- ----------------------------
DROP TABLE IF EXISTS `pa_ball_order`;
CREATE TABLE `pa_ball_order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_sn` varchar(20) NOT NULL DEFAULT '' COMMENT '订单号',
  `amount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '投注金额',
  `pay_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '支付状态',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '投注时间',
  `pay_time` int(11) NOT NULL DEFAULT '0' COMMENT '支付时间',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `issue` varchar(10) NOT NULL DEFAULT '' COMMENT '投注期数',
  `win_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '中奖金额',
  `win_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '中奖时间',
  `bet` varchar(1000) NOT NULL DEFAULT '' COMMENT '序列化的投注内容',
  `is_finish` tinyint(4) DEFAULT '1' COMMENT '是否已经开完奖',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='双色球投注表';
