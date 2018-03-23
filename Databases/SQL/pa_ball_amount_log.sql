/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : xwta

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-09-11 14:39:11
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for pa_ball_amount_log
-- ----------------------------
DROP TABLE IF EXISTS `pa_ball_amount_log`;
CREATE TABLE `pa_ball_amount_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '支出或者收入金额',
  `type` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '类型 1收入 2支出',
  `remark` varchar(50) NOT NULL DEFAULT '' COMMENT '收入说明',
  `issue` varchar(10) NOT NULL DEFAULT '' COMMENT '对应的期数',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='积分日志表';
