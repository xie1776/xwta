/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : tpadmin

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2016-12-20 17:44:37
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for pa_chapter
-- ----------------------------
DROP TABLE IF EXISTS `pa_chapter`;
CREATE TABLE `pa_chapter` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL DEFAULT '' COMMENT '标题',
  `novel_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '小说所属',
  `up_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布时间',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '所在目录',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='小说章节表';
