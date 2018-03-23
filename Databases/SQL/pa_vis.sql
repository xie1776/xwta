/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : xwta

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2016-12-22 14:38:35
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for pa_vis
-- ----------------------------
DROP TABLE IF EXISTS `pa_vis`;
CREATE TABLE `pa_vis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_ip` varchar(15) NOT NULL DEFAULT '' COMMENT '客户端ip',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '访问时间',
  `user_agent` varchar(255) NOT NULL DEFAULT '' COMMENT '浏览器参数',
  `request_url` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COMMENT='页面访问表';
