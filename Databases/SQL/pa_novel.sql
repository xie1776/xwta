/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : tpadmin

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2016-12-20 17:44:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for pa_novel
-- ----------------------------
DROP TABLE IF EXISTS `pa_novel`;
CREATE TABLE `pa_novel` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL DEFAULT '',
  `author` varchar(50) NOT NULL DEFAULT '',
  `type_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '小说类型id',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '小说状态 0未完结 1已完结',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0',
  `dir` varchar(255) NOT NULL DEFAULT '' COMMENT '小说的目录',
  PRIMARY KEY (`id`),
  UNIQUE KEY ` xi1` (`name`,`author`) COMMENT '名称和作者唯一索引'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='小说表';
