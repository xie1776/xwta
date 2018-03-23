/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : tpadmin

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2016-09-26 15:33:29
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for pa_access
-- ----------------------------
DROP TABLE IF EXISTS `pa_access`;
CREATE TABLE `pa_access` (
  `role_id` smallint(6) unsigned NOT NULL,
  `node_id` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) NOT NULL,
  `pid` smallint(6) DEFAULT NULL,
  `module` varchar(50) DEFAULT NULL,
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='权限分配表';

-- ----------------------------
-- Records of pa_access
-- ----------------------------
INSERT INTO `pa_access` VALUES ('2', '8', '3', '14', '');
INSERT INTO `pa_access` VALUES ('2', '14', '2', '1', '');
INSERT INTO `pa_access` VALUES ('2', '10', '3', '4', '');
INSERT INTO `pa_access` VALUES ('2', '4', '2', '1', '');
INSERT INTO `pa_access` VALUES ('2', '7', '3', '3', '');
INSERT INTO `pa_access` VALUES ('2', '3', '2', '1', '');
INSERT INTO `pa_access` VALUES ('2', '6', '3', '2', '');
INSERT INTO `pa_access` VALUES ('2', '5', '3', '2', '');
INSERT INTO `pa_access` VALUES ('2', '2', '2', '1', '');
INSERT INTO `pa_access` VALUES ('2', '1', '1', '0', '');
INSERT INTO `pa_access` VALUES ('3', '14', '2', '1', '');
INSERT INTO `pa_access` VALUES ('3', '13', '3', '4', '');
INSERT INTO `pa_access` VALUES ('3', '12', '3', '4', '');
INSERT INTO `pa_access` VALUES ('3', '11', '3', '4', '');
INSERT INTO `pa_access` VALUES ('3', '10', '3', '4', '');
INSERT INTO `pa_access` VALUES ('3', '4', '2', '1', '');
INSERT INTO `pa_access` VALUES ('3', '9', '3', '3', '');
INSERT INTO `pa_access` VALUES ('3', '8', '3', '3', '');
INSERT INTO `pa_access` VALUES ('3', '7', '3', '3', '');
INSERT INTO `pa_access` VALUES ('3', '3', '2', '1', '');
INSERT INTO `pa_access` VALUES ('3', '6', '3', '2', '');
INSERT INTO `pa_access` VALUES ('3', '5', '3', '2', '');
INSERT INTO `pa_access` VALUES ('3', '2', '2', '1', '');
INSERT INTO `pa_access` VALUES ('3', '1', '1', '0', '');
INSERT INTO `pa_access` VALUES ('2', '9', '3', '14', '');
INSERT INTO `pa_access` VALUES ('2', '15', '3', '14', '');
INSERT INTO `pa_access` VALUES ('2', '16', '3', '14', '');
INSERT INTO `pa_access` VALUES ('2', '17', '3', '14', '');
INSERT INTO `pa_access` VALUES ('2', '18', '3', '14', '');
INSERT INTO `pa_access` VALUES ('2', '19', '3', '14', '');
INSERT INTO `pa_access` VALUES ('2', '20', '3', '14', '');
INSERT INTO `pa_access` VALUES ('2', '21', '3', '14', '');
INSERT INTO `pa_access` VALUES ('2', '22', '3', '14', '');
INSERT INTO `pa_access` VALUES ('2', '23', '3', '14', '');
INSERT INTO `pa_access` VALUES ('2', '24', '3', '14', '');
INSERT INTO `pa_access` VALUES ('2', '25', '3', '14', '');
INSERT INTO `pa_access` VALUES ('2', '26', '2', '1', '');
INSERT INTO `pa_access` VALUES ('2', '27', '3', '26', '');
INSERT INTO `pa_access` VALUES ('2', '28', '3', '26', '');
INSERT INTO `pa_access` VALUES ('2', '29', '3', '26', '');
INSERT INTO `pa_access` VALUES ('2', '30', '3', '26', '');
INSERT INTO `pa_access` VALUES ('2', '31', '3', '26', '');
INSERT INTO `pa_access` VALUES ('2', '8', '3', '14', '');
INSERT INTO `pa_access` VALUES ('2', '14', '2', '1', '');
INSERT INTO `pa_access` VALUES ('2', '10', '3', '4', '');
INSERT INTO `pa_access` VALUES ('2', '4', '2', '1', '');
INSERT INTO `pa_access` VALUES ('2', '7', '3', '3', '');
INSERT INTO `pa_access` VALUES ('2', '3', '2', '1', '');
INSERT INTO `pa_access` VALUES ('2', '6', '3', '2', '');
INSERT INTO `pa_access` VALUES ('2', '5', '3', '2', '');
INSERT INTO `pa_access` VALUES ('2', '2', '2', '1', '');
INSERT INTO `pa_access` VALUES ('2', '1', '1', '0', '');
INSERT INTO `pa_access` VALUES ('3', '14', '2', '1', '');
INSERT INTO `pa_access` VALUES ('3', '13', '3', '4', '');
INSERT INTO `pa_access` VALUES ('3', '12', '3', '4', '');
INSERT INTO `pa_access` VALUES ('3', '11', '3', '4', '');
INSERT INTO `pa_access` VALUES ('3', '10', '3', '4', '');
INSERT INTO `pa_access` VALUES ('3', '4', '2', '1', '');
INSERT INTO `pa_access` VALUES ('3', '9', '3', '3', '');
INSERT INTO `pa_access` VALUES ('3', '8', '3', '3', '');
INSERT INTO `pa_access` VALUES ('3', '7', '3', '3', '');
INSERT INTO `pa_access` VALUES ('3', '3', '2', '1', '');
INSERT INTO `pa_access` VALUES ('3', '6', '3', '2', '');
INSERT INTO `pa_access` VALUES ('3', '5', '3', '2', '');
INSERT INTO `pa_access` VALUES ('3', '2', '2', '1', '');
INSERT INTO `pa_access` VALUES ('3', '1', '1', '0', '');
INSERT INTO `pa_access` VALUES ('2', '9', '3', '14', '');
INSERT INTO `pa_access` VALUES ('2', '15', '3', '14', '');
INSERT INTO `pa_access` VALUES ('2', '16', '3', '14', '');
INSERT INTO `pa_access` VALUES ('2', '17', '3', '14', '');
INSERT INTO `pa_access` VALUES ('2', '18', '3', '14', '');
INSERT INTO `pa_access` VALUES ('2', '19', '3', '14', '');
INSERT INTO `pa_access` VALUES ('2', '20', '3', '14', '');
INSERT INTO `pa_access` VALUES ('2', '21', '3', '14', '');
INSERT INTO `pa_access` VALUES ('2', '22', '3', '14', '');
INSERT INTO `pa_access` VALUES ('2', '23', '3', '14', '');
INSERT INTO `pa_access` VALUES ('2', '24', '3', '14', '');
INSERT INTO `pa_access` VALUES ('2', '25', '3', '14', '');
INSERT INTO `pa_access` VALUES ('2', '26', '2', '1', '');
INSERT INTO `pa_access` VALUES ('2', '27', '3', '26', '');
INSERT INTO `pa_access` VALUES ('2', '28', '3', '26', '');
INSERT INTO `pa_access` VALUES ('2', '29', '3', '26', '');
INSERT INTO `pa_access` VALUES ('2', '30', '3', '26', '');
INSERT INTO `pa_access` VALUES ('2', '31', '3', '26', '');
INSERT INTO `pa_access` VALUES ('2', '8', '3', '14', '');
INSERT INTO `pa_access` VALUES ('2', '14', '2', '1', '');
INSERT INTO `pa_access` VALUES ('2', '10', '3', '4', '');
INSERT INTO `pa_access` VALUES ('2', '4', '2', '1', '');
INSERT INTO `pa_access` VALUES ('2', '7', '3', '3', '');
INSERT INTO `pa_access` VALUES ('2', '3', '2', '1', '');
INSERT INTO `pa_access` VALUES ('2', '6', '3', '2', '');
INSERT INTO `pa_access` VALUES ('2', '5', '3', '2', '');
INSERT INTO `pa_access` VALUES ('2', '2', '2', '1', '');
INSERT INTO `pa_access` VALUES ('2', '1', '1', '0', '');
INSERT INTO `pa_access` VALUES ('3', '14', '2', '1', '');
INSERT INTO `pa_access` VALUES ('3', '13', '3', '4', '');
INSERT INTO `pa_access` VALUES ('3', '12', '3', '4', '');
INSERT INTO `pa_access` VALUES ('3', '11', '3', '4', '');
INSERT INTO `pa_access` VALUES ('3', '10', '3', '4', '');
INSERT INTO `pa_access` VALUES ('3', '4', '2', '1', '');
INSERT INTO `pa_access` VALUES ('3', '9', '3', '3', '');
INSERT INTO `pa_access` VALUES ('3', '8', '3', '3', '');
INSERT INTO `pa_access` VALUES ('3', '7', '3', '3', '');
INSERT INTO `pa_access` VALUES ('3', '3', '2', '1', '');
INSERT INTO `pa_access` VALUES ('3', '6', '3', '2', '');
INSERT INTO `pa_access` VALUES ('3', '5', '3', '2', '');
INSERT INTO `pa_access` VALUES ('3', '2', '2', '1', '');
INSERT INTO `pa_access` VALUES ('3', '1', '1', '0', '');
INSERT INTO `pa_access` VALUES ('2', '9', '3', '14', '');
INSERT INTO `pa_access` VALUES ('2', '15', '3', '14', '');
INSERT INTO `pa_access` VALUES ('2', '16', '3', '14', '');
INSERT INTO `pa_access` VALUES ('2', '17', '3', '14', '');
INSERT INTO `pa_access` VALUES ('2', '18', '3', '14', '');
INSERT INTO `pa_access` VALUES ('2', '19', '3', '14', '');
INSERT INTO `pa_access` VALUES ('2', '20', '3', '14', '');
INSERT INTO `pa_access` VALUES ('2', '21', '3', '14', '');
INSERT INTO `pa_access` VALUES ('2', '22', '3', '14', '');
INSERT INTO `pa_access` VALUES ('2', '23', '3', '14', '');
INSERT INTO `pa_access` VALUES ('2', '24', '3', '14', '');
INSERT INTO `pa_access` VALUES ('2', '25', '3', '14', '');
INSERT INTO `pa_access` VALUES ('2', '26', '2', '1', '');
INSERT INTO `pa_access` VALUES ('2', '27', '3', '26', '');
INSERT INTO `pa_access` VALUES ('2', '28', '3', '26', '');
INSERT INTO `pa_access` VALUES ('2', '29', '3', '26', '');
INSERT INTO `pa_access` VALUES ('2', '30', '3', '26', '');
INSERT INTO `pa_access` VALUES ('2', '31', '3', '26', '');
INSERT INTO `pa_access` VALUES ('4', '1', '1', '0', null);
INSERT INTO `pa_access` VALUES ('4', '2', '2', '1', null);
INSERT INTO `pa_access` VALUES ('4', '5', '3', '2', null);
INSERT INTO `pa_access` VALUES ('4', '6', '3', '2', null);
INSERT INTO `pa_access` VALUES ('4', '3', '2', '1', null);
INSERT INTO `pa_access` VALUES ('4', '7', '3', '3', null);
INSERT INTO `pa_access` VALUES ('4', '4', '2', '1', null);
INSERT INTO `pa_access` VALUES ('4', '10', '3', '4', null);
INSERT INTO `pa_access` VALUES ('4', '11', '3', '4', null);
INSERT INTO `pa_access` VALUES ('4', '12', '3', '4', null);
INSERT INTO `pa_access` VALUES ('4', '13', '3', '4', null);
INSERT INTO `pa_access` VALUES ('4', '14', '2', '1', null);
INSERT INTO `pa_access` VALUES ('4', '8', '3', '14', null);
INSERT INTO `pa_access` VALUES ('4', '9', '3', '14', null);
INSERT INTO `pa_access` VALUES ('4', '15', '3', '14', null);
INSERT INTO `pa_access` VALUES ('4', '16', '3', '14', null);
INSERT INTO `pa_access` VALUES ('4', '17', '3', '14', null);
INSERT INTO `pa_access` VALUES ('4', '18', '3', '14', null);
INSERT INTO `pa_access` VALUES ('4', '19', '3', '14', null);
INSERT INTO `pa_access` VALUES ('4', '20', '3', '14', null);
INSERT INTO `pa_access` VALUES ('4', '21', '3', '14', null);
INSERT INTO `pa_access` VALUES ('4', '22', '3', '14', null);
INSERT INTO `pa_access` VALUES ('4', '23', '3', '14', null);
INSERT INTO `pa_access` VALUES ('4', '24', '3', '14', null);
INSERT INTO `pa_access` VALUES ('4', '25', '3', '14', null);
INSERT INTO `pa_access` VALUES ('4', '26', '2', '1', null);
INSERT INTO `pa_access` VALUES ('4', '27', '3', '26', null);
INSERT INTO `pa_access` VALUES ('4', '28', '3', '26', null);
INSERT INTO `pa_access` VALUES ('4', '29', '3', '26', null);
INSERT INTO `pa_access` VALUES ('4', '30', '3', '26', null);
INSERT INTO `pa_access` VALUES ('4', '31', '3', '26', null);
INSERT INTO `pa_access` VALUES ('4', '76', '3', '26', null);
INSERT INTO `pa_access` VALUES ('4', '77', '3', '26', null);
INSERT INTO `pa_access` VALUES ('4', '32', '2', '1', null);
INSERT INTO `pa_access` VALUES ('4', '33', '3', '32', null);
INSERT INTO `pa_access` VALUES ('4', '34', '3', '32', null);
INSERT INTO `pa_access` VALUES ('4', '35', '3', '32', null);
INSERT INTO `pa_access` VALUES ('4', '36', '3', '32', null);
INSERT INTO `pa_access` VALUES ('4', '37', '3', '32', null);
INSERT INTO `pa_access` VALUES ('4', '38', '3', '32', null);
INSERT INTO `pa_access` VALUES ('4', '39', '3', '32', null);
INSERT INTO `pa_access` VALUES ('4', '40', '3', '32', null);
INSERT INTO `pa_access` VALUES ('4', '41', '3', '32', null);
INSERT INTO `pa_access` VALUES ('4', '42', '3', '32', null);
INSERT INTO `pa_access` VALUES ('4', '43', '3', '32', null);
INSERT INTO `pa_access` VALUES ('4', '44', '3', '32', null);
INSERT INTO `pa_access` VALUES ('4', '46', '2', '1', null);
INSERT INTO `pa_access` VALUES ('4', '47', '3', '46', null);
INSERT INTO `pa_access` VALUES ('4', '48', '3', '46', null);
INSERT INTO `pa_access` VALUES ('4', '49', '3', '46', null);
INSERT INTO `pa_access` VALUES ('4', '50', '3', '46', null);
INSERT INTO `pa_access` VALUES ('4', '51', '3', '46', null);
INSERT INTO `pa_access` VALUES ('4', '52', '3', '46', null);
INSERT INTO `pa_access` VALUES ('4', '53', '3', '46', null);
INSERT INTO `pa_access` VALUES ('4', '54', '3', '46', null);
INSERT INTO `pa_access` VALUES ('4', '55', '3', '46', null);
INSERT INTO `pa_access` VALUES ('4', '56', '3', '46', null);
INSERT INTO `pa_access` VALUES ('4', '57', '3', '46', null);
INSERT INTO `pa_access` VALUES ('4', '58', '3', '46', null);
INSERT INTO `pa_access` VALUES ('4', '59', '3', '46', null);
INSERT INTO `pa_access` VALUES ('4', '61', '3', '46', null);
INSERT INTO `pa_access` VALUES ('4', '62', '3', '46', null);
INSERT INTO `pa_access` VALUES ('4', '63', '3', '46', null);
INSERT INTO `pa_access` VALUES ('4', '64', '3', '46', null);
INSERT INTO `pa_access` VALUES ('4', '65', '3', '46', null);
INSERT INTO `pa_access` VALUES ('4', '66', '3', '46', null);
INSERT INTO `pa_access` VALUES ('4', '60', '2', '1', null);
INSERT INTO `pa_access` VALUES ('4', '67', '3', '60', null);
INSERT INTO `pa_access` VALUES ('4', '68', '3', '60', null);
INSERT INTO `pa_access` VALUES ('4', '69', '3', '60', null);
INSERT INTO `pa_access` VALUES ('4', '70', '3', '60', null);
INSERT INTO `pa_access` VALUES ('4', '71', '3', '60', null);
INSERT INTO `pa_access` VALUES ('4', '72', '3', '60', null);
INSERT INTO `pa_access` VALUES ('4', '73', '3', '60', null);
INSERT INTO `pa_access` VALUES ('4', '74', '3', '60', null);
INSERT INTO `pa_access` VALUES ('4', '75', '3', '60', null);
INSERT INTO `pa_access` VALUES ('4', '78', '2', '1', null);
INSERT INTO `pa_access` VALUES ('4', '79', '3', '78', null);
INSERT INTO `pa_access` VALUES ('4', '80', '3', '78', null);

-- ----------------------------
-- Table structure for pa_ad
-- ----------------------------
DROP TABLE IF EXISTS `pa_ad`;
CREATE TABLE `pa_ad` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `ad_name` varchar(60) NOT NULL DEFAULT '',
  `ad_link` varchar(255) NOT NULL DEFAULT '',
  `ad_img` varchar(255) NOT NULL,
  `position` char(10) NOT NULL DEFAULT '0',
  `sort` tinyint(1) unsigned NOT NULL DEFAULT '50',
  `lang` varchar(10) NOT NULL DEFAULT 'zh-cn',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pa_ad
-- ----------------------------
INSERT INTO `pa_ad` VALUES ('23', '首页1', 'http://www.2345.com/?kconist', '531e85f90bcc1.png', 'index', '10', 'zh-cn');
INSERT INTO `pa_ad` VALUES ('24', '首页2', 'http://www.2345.com/?kconist', '531e88216e887.png', 'index', '9', 'zh-cn');
INSERT INTO `pa_ad` VALUES ('25', '首页3', 'http://www.2345.com/?kconist', '531e88325b1c2.png', 'index', '8', 'zh-cn');

-- ----------------------------
-- Table structure for pa_admin
-- ----------------------------
DROP TABLE IF EXISTS `pa_admin`;
CREATE TABLE `pa_admin` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL COMMENT '登录账号',
  `pwd` char(32) DEFAULT NULL COMMENT '登录密码',
  `status` int(11) DEFAULT '1' COMMENT '账号状态',
  `remark` varchar(255) DEFAULT '' COMMENT '备注信息',
  `find_code` char(5) DEFAULT NULL COMMENT '找回账号验证码',
  `time` int(10) NOT NULL COMMENT '开通时间',
  `city` varchar(10) DEFAULT '',
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='网站后台管理员表';

-- ----------------------------
-- Records of pa_admin
-- ----------------------------
INSERT INTO `pa_admin` VALUES ('1', '超级管理员', 'admin@admin.com', '9bd7ac8a1ca033ce2ee7073c5f6f9280', '1', '我是超级管理员 哈哈~~', null, '1470316644', '');
INSERT INTO `pa_admin` VALUES ('2', null, 'test@test.com', '9bd7ac8a1ca033ce2ee7073c5f6f9280', '1', '测试1', null, '1473818456', '');

-- ----------------------------
-- Table structure for pa_category
-- ----------------------------
DROP TABLE IF EXISTS `pa_category`;
CREATE TABLE `pa_category` (
  `cid` int(5) NOT NULL AUTO_INCREMENT,
  `pid` int(5) DEFAULT NULL COMMENT 'parentCategory上级分类',
  `name` varchar(20) DEFAULT NULL COMMENT '分类名称',
  `type` char(2) NOT NULL DEFAULT 'n',
  `lang` varchar(10) NOT NULL DEFAULT 'zh-cn',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='新闻分类表';

-- ----------------------------
-- Records of pa_category
-- ----------------------------
INSERT INTO `pa_category` VALUES ('1', '0', '互联网', 'n', 'zh-cn');
INSERT INTO `pa_category` VALUES ('2', '1', '行业新闻', 'n', 'zh-cn');
INSERT INTO `pa_category` VALUES ('52', '0', '手机', 'p', 'zh-cn');
INSERT INTO `pa_category` VALUES ('54', '53', '666666666', 'n', 'zh-cn');
INSERT INTO `pa_category` VALUES ('57', '0', '散文', 'n', 'zh-cn');
INSERT INTO `pa_category` VALUES ('58', '0', '随笔', 'n', 'zh-cn');
INSERT INTO `pa_category` VALUES ('59', '0', '故事', 'n', 'zh-cn');

-- ----------------------------
-- Table structure for pa_city
-- ----------------------------
DROP TABLE IF EXISTS `pa_city`;
CREATE TABLE `pa_city` (
  `id` int(6) NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `pid` int(11) NOT NULL DEFAULT '1' COMMENT '父id',
  `code` varchar(20) NOT NULL DEFAULT '' COMMENT '城市简称',
  `name` varchar(80) NOT NULL DEFAULT '' COMMENT '城市名称',
  `status` tinyint(3) NOT NULL DEFAULT '1' COMMENT '城市状态 1：启用 0：下线',
  `area_code` varchar(25) NOT NULL DEFAULT '' COMMENT '城市电话区号',
  `citypy` varchar(50) NOT NULL DEFAULT '' COMMENT '城市名称拼音',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `add_time` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  UNIQUE KEY `name` (`name`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8 COMMENT='城市表';

-- ----------------------------
-- Records of pa_city
-- ----------------------------
INSERT INTO `pa_city` VALUES ('1', '0', 'all', '全国', '1', '', '', '0', '0');
INSERT INTO `pa_city` VALUES ('2', '1', 'ha', '哈尔滨', '0', '0451', 'ha er bin', '1456824145', '1456824145');
INSERT INTO `pa_city` VALUES ('3', '1', 'dq', '大庆', '0', '0459', 'daqing', '1446622364', '1446622364');
INSERT INTO `pa_city` VALUES ('4', '1', 'cc', '长春', '1', '0431', 'changchun', '1446708711', '1446708711');
INSERT INTO `pa_city` VALUES ('5', '1', 'jl', '吉林', '0', '0432', 'jilin', '1452152123', '1452152123');
INSERT INTO `pa_city` VALUES ('6', '1', 'sy', '沈阳', '0', '024', 'shenyang', '1468114462', '1468114462');
INSERT INTO `pa_city` VALUES ('7', '1', 'dl', '大连', '1', '0411', 'dalian', '1447296705', '1447296705');
INSERT INTO `pa_city` VALUES ('8', '1', 'bj', '北京', '1', '010', 'beijing', '1451033003', '1451033003');
INSERT INTO `pa_city` VALUES ('9', '1', 'tj', '天津', '1', '022', 'tianjin', '1446709250', '1446709250');
INSERT INTO `pa_city` VALUES ('10', '1', 'sj', '石家庄', '1', '0311', 'shijiazhuang', '1450237025', '1450237025');
INSERT INTO `pa_city` VALUES ('11', '1', 'ts', '唐山', '0', '0315', 'tangshan', '1451570973', '1451570973');
INSERT INTO `pa_city` VALUES ('12', '1', 'lf', '廊坊', '0', '0316', 'langfang', '1448249639', '1448249639');
INSERT INTO `pa_city` VALUES ('13', '1', 'hd', '邯郸', '0', '0310', 'handan', '1448249626', '1448249626');
INSERT INTO `pa_city` VALUES ('14', '1', 'bd', '保定', '1', '0312', 'baoding', '1457667238', '1457667238');
INSERT INTO `pa_city` VALUES ('15', '1', 'qi', '秦皇岛', '0', '0335', 'qinhuangdao', '1446709450', '1446709450');
INSERT INTO `pa_city` VALUES ('16', '1', 'ty', '太原', '1', '0351', 'taiyuan', '1468989269', '1468989269');
INSERT INTO `pa_city` VALUES ('17', '1', 'jc', '晋城', '1', '0356', 'jincheng', '1446709521', '1446709521');
INSERT INTO `pa_city` VALUES ('18', '1', 'dt', '大同', '0', '0352', 'datong', '1446709552', '1446709552');
INSERT INTO `pa_city` VALUES ('19', '1', 'hu', '呼和浩特', '0', '0471', 'huhehaote', '1451572269', '1451572269');
INSERT INTO `pa_city` VALUES ('20', '1', 'bt', '包头', '0', '0472', 'baotou', '1446709605', '1446709605');
INSERT INTO `pa_city` VALUES ('21', '1', 'sh', '上海', '1', '021', 'shanghai', '1446709626', '1446709626');
INSERT INTO `pa_city` VALUES ('22', '1', 'nj', '南京', '1', '025', 'nanjing', '1446709646', '1446709646');
INSERT INTO `pa_city` VALUES ('23', '1', 'cz', '常州', '1', '0519', 'changzhou', '1446709668', '1446709668');
INSERT INTO `pa_city` VALUES ('24', '1', 'su', '苏州', '1', '0512', 'suzhou', '1446710699', '1446710699');
INSERT INTO `pa_city` VALUES ('25', '1', 'wx', '无锡', '1', '0510', 'wuxi', '1446710726', '1446710726');
INSERT INTO `pa_city` VALUES ('26', '1', 'yd', '扬州', '1', '0514', 'yangzhou', '1446710745', '1446710745');
INSERT INTO `pa_city` VALUES ('27', '1', 'xz', '徐州', '1', '0516', 'xuzhou', '1457433036', '1457433036');
INSERT INTO `pa_city` VALUES ('28', '1', 'nt', '南通', '1', '0513', 'nantong', '1446712660', '1446712660');
INSERT INTO `pa_city` VALUES ('29', '1', 'hz', '杭州', '1', '0571', 'hangzhou', '1446712609', '1446712609');
INSERT INTO `pa_city` VALUES ('30', '1', 'nb', '宁波', '1', '0574', 'ningbo', '1451573663', '1451573663');
INSERT INTO `pa_city` VALUES ('31', '1', 'wz', '温州', '0', '0577', 'wenzhou', '1446712571', '1446712571');
INSERT INTO `pa_city` VALUES ('32', '1', 'so', '绍兴', '0', '0575', 'shaoxing', '1446712551', '1446712551');
INSERT INTO `pa_city` VALUES ('33', '1', 'tz', '台州', '0', '0576', 'taizhou', '1446712533', '1446712533');
INSERT INTO `pa_city` VALUES ('34', '1', 'hf', '合肥', '1', '0551', 'hefei', '1446712500', '1446712500');
INSERT INTO `pa_city` VALUES ('35', '1', 'fz', '福州', '1', '0591', 'fuzhou', '1453190219', '1453190219');
INSERT INTO `pa_city` VALUES ('36', '1', 'xm', '厦门', '1', '0592', 'xiamen', '1446712466', '1446712466');
INSERT INTO `pa_city` VALUES ('37', '1', 'qz', '泉州', '0', '0595', 'quanzhou', '1446712445', '1446712445');
INSERT INTO `pa_city` VALUES ('38', '1', 'nc', '南昌', '0', '0791', 'nanchang', '1446712425', '1446712425');
INSERT INTO `pa_city` VALUES ('39', '1', 'sd', '济南', '1', '0531', 'jinan', '1462955006', '1462955006');
INSERT INTO `pa_city` VALUES ('40', '1', 'qd', '青岛', '1', '0532', 'qingdao', '1446712093', '1446712093');
INSERT INTO `pa_city` VALUES ('41', '1', 'zb', '淄博', '1', '0533', 'zibo', '1446712073', '1446712073');
INSERT INTO `pa_city` VALUES ('42', '1', 'wf', '潍坊', '0', '0536', 'weifang', '1446711923', '1446711923');
INSERT INTO `pa_city` VALUES ('43', '1', 'yt', '烟台', '1', '0535', 'yantai', '1453189780', '1453189780');
INSERT INTO `pa_city` VALUES ('44', '1', 'ta', '泰安', '0', '0538', 'taian', '1446711873', '1446711873');
INSERT INTO `pa_city` VALUES ('45', '1', 'lb', '临沂', '0', '0539', 'linyi', '1469417935', '1469417935');
INSERT INTO `pa_city` VALUES ('46', '1', 'hn', '郑州', '1', '0371', 'zhengzhou', '1446711706', '1446711706');
INSERT INTO `pa_city` VALUES ('47', '1', 'ly', '洛阳', '1', '0379', 'luoyang', '1446711676', '1446711676');
INSERT INTO `pa_city` VALUES ('48', '1', 'kf', '开封', '0', '0378', 'kaifeng', '1446711659', '1446711659');
INSERT INTO `pa_city` VALUES ('49', '1', 'wh', '武汉', '1', '027', 'wuhan', '1446711639', '1446711639');
INSERT INTO `pa_city` VALUES ('50', '1', 'cs', '长沙', '1', '0731', 'changsha', '1446711624', '1446711624');
INSERT INTO `pa_city` VALUES ('51', '1', 'gz', '广州', '1', '020', 'guangzhou', '1446711607', '1446711607');
INSERT INTO `pa_city` VALUES ('52', '1', 'sz', '深圳', '1', '0755', 'shenzhen', '1446711577', '1446711577');
INSERT INTO `pa_city` VALUES ('53', '1', 'dg', '东莞', '1', '0769', 'dongguan', '1459130456', '1459130456');
INSERT INTO `pa_city` VALUES ('54', '1', 'zs', '中山', '1', '0760', 'zhongshan', '1458198023', '1458198023');
INSERT INTO `pa_city` VALUES ('55', '1', 'fs', '佛山', '1', '0757', 'foshan', '1446711520', '1446711520');
INSERT INTO `pa_city` VALUES ('56', '1', 'zh', '珠海', '1', '0756', 'zhuhai', '1447729567', '1447729567');
INSERT INTO `pa_city` VALUES ('57', '1', 'st', '汕头', '0', '0754', 'shantou', '1446711430', '1446711430');
INSERT INTO `pa_city` VALUES ('58', '1', 'nn', '南宁', '1', '0771', 'nanning', '1446711409', '1446711409');
INSERT INTO `pa_city` VALUES ('59', '1', 'la', '柳州', '1', '0772', 'liuzhou', '1459134205', '1459134205');
INSERT INTO `pa_city` VALUES ('60', '1', 'hk', '海口', '1', '0898', 'haikou', '1446711373', '1446711373');
INSERT INTO `pa_city` VALUES ('61', '1', 'cq', '重庆', '1', '023', 'chongqing', '1446711344', '1446711344');
INSERT INTO `pa_city` VALUES ('62', '1', 'cd', '成都', '1', '028', 'chengdu', '1446711271', '1446711271');
INSERT INTO `pa_city` VALUES ('63', '1', 'gy', '贵阳', '1', '0851', 'guiyang', '1446711233', '1446711233');
INSERT INTO `pa_city` VALUES ('64', '1', 'yn', '昆明', '1', '0871', 'kunming', '1446711212', '1446711212');
INSERT INTO `pa_city` VALUES ('65', '1', 'ls', '拉萨', '0', '0891', 'lasa', '1446711190', '1446711190');
INSERT INTO `pa_city` VALUES ('66', '1', 'sx', '西安', '1', '029', 'xian', '1447655069', '1447655069');
INSERT INTO `pa_city` VALUES ('67', '1', 'xy', '咸阳', '0', '0910', 'xianyang', '1451572989', '1451572989');
INSERT INTO `pa_city` VALUES ('68', '1', 'lz', '兰州', '0', '0931', 'lanzhou', '1446711067', '1446711067');
INSERT INTO `pa_city` VALUES ('69', '1', 'xn', '西宁', '0', '0971', 'xining', '1446711042', '1446711042');
INSERT INTO `pa_city` VALUES ('70', '1', 'yi', '银川', '0', '0951', 'yinchuan', '1446711021', '1446711021');
INSERT INTO `pa_city` VALUES ('71', '1', 'xj', '乌鲁木齐', '1', '0991', 'wulumuqi', '1446711003', '1446711003');
INSERT INTO `pa_city` VALUES ('72', '1', 'cj', '昌吉', '0', '0994', 'changji', '1448249650', '1448249650');
INSERT INTO `pa_city` VALUES ('73', '1', 'ak', '阿克苏', '0', '0997', 'akesu', '1446710945', '1446710945');
INSERT INTO `pa_city` VALUES ('74', '1', 'dyd', '钓鱼岛', '1', '888', 'diaoyudao', '1452152940', '1452152940');
INSERT INTO `pa_city` VALUES ('75', '1', 'jy', '江阴', '1', '0510_320281', 'jiangyin', '1447296604', '1447296604');
INSERT INTO `pa_city` VALUES ('76', '1', 'ya', '盐城', '0', '0515', 'yancheng', '1446710850', '1446710850');
INSERT INTO `pa_city` VALUES ('77', '1', 'tb', '泰州', '0', '0523', 'taizhou', '1451572692', '1451572692');
INSERT INTO `pa_city` VALUES ('78', '1', 'dy', '东营', '1', '0546', 'dongying', '1454640067', '1454640067');
INSERT INTO `pa_city` VALUES ('100', '1', 'my', '绵阳', '1', '0816', 'mianyang', '1446710792', '1446710792');
INSERT INTO `pa_city` VALUES ('101', '1', 'ny', '南阳', '0', '0377', 'nanyang', '1446710771', '1446710771');
INSERT INTO `pa_city` VALUES ('104', '1', 'jn', '济宁', '1', '0537', 'jining', '1446710752', '1446710752');
INSERT INTO `pa_city` VALUES ('106', '1', 'hp', '衡水', '1', '0318', 'hengshui', '1446710720', '1446710720');
INSERT INTO `pa_city` VALUES ('107', '1', 'fy', '阜阳', '1', '1558', 'fuyang', '1446710701', '1446710701');
INSERT INTO `pa_city` VALUES ('108', '1', 'ks', '昆山', '1', '0512_320583', 'kunshan', '1447296533', '1447296533');
INSERT INTO `pa_city` VALUES ('112', '1', 'ji', '焦作', '1', '0391', 'jiaozuo', '1446710649', '1446710649');
INSERT INTO `pa_city` VALUES ('113', '1', 'cb', '常熟', '0', '0512_320581', 'changshu', '1451572865', '1451572865');
INSERT INTO `pa_city` VALUES ('114', '1', 'gl', '桂林', '0', '0773', 'guilin', '1451572808', '1451572808');
INSERT INTO `pa_city` VALUES ('115', '1', 'hj', '淮安', '1', '0517', 'huaian', '1446710515', '1446710515');
INSERT INTO `pa_city` VALUES ('116', '1', 'tn', '通辽', '0', '0475', 'tongliao', '1461144971', '1461144971');
INSERT INTO `pa_city` VALUES ('117', '1', 'sa', '三亚', '0', '0899', 'sanya', '1451571491', '1451571491');
INSERT INTO `pa_city` VALUES ('119', '1', 'zk', '周口', '1', '0394', 'zhoukou', '1446709924', '1446709924');
INSERT INTO `pa_city` VALUES ('125', '1', 'aj', '宝鸡', '0', '0917', 'baoji', '1446709902', '1446709902');
INSERT INTO `pa_city` VALUES ('126', '1', 'co', '沧州', '1', '0317', 'cangzhou', '1446709881', '1446709881');
INSERT INTO `pa_city` VALUES ('127', '1', 'hv', '惠州', '1', '0752', 'huizhou', '1453196177', '1453196177');
INSERT INTO `pa_city` VALUES ('128', '1', 'jh', '金华', '1', '0579', 'jinhua', '1449020561', '1449020561');
INSERT INTO `pa_city` VALUES ('129', '1', 'we', '威海', '1', '0631', 'weihai', '1456388630', '1456388630');
INSERT INTO `pa_city` VALUES ('130', '1', 'xa', '邢台', '1', '0319', 'xingtai', '1454483849', '1454483849');
INSERT INTO `pa_city` VALUES ('133', '1', 'si', '十堰', '1', '0719', 'shiyan', '1460430498', '1460430498');
INSERT INTO `pa_city` VALUES ('134', '1', 'zy', '遵义', '1', '0852', 'zunyi', '1460528276', '1460528276');
INSERT INTO `pa_city` VALUES ('135', '1', 'jg', '张家港', '0', '0512-58105551', 'zhangjiagang', '1458182311', '1458182311');
INSERT INTO `pa_city` VALUES ('137', '1', 'yv', '岳阳', '1', '0730', 'yueyang', '1459221822', '1459221822');
INSERT INTO `pa_city` VALUES ('138', '1', 'kl', '凯里', '1', '0086', 'kaili', '1467362831', '1467362831');
INSERT INTO `pa_city` VALUES ('139', '1', 'ln', '临汾', '0', '0357', 'linfen', '1471836437', '1471836437');
INSERT INTO `pa_city` VALUES ('141', '38', 'jx', '进贤', '1', '0791', 'jinxian', '1474520352', '1474520352');

-- ----------------------------
-- Table structure for pa_images
-- ----------------------------
DROP TABLE IF EXISTS `pa_images`;
CREATE TABLE `pa_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catname` varchar(20) NOT NULL,
  `savename` varchar(100) NOT NULL,
  `savepath` varchar(255) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pa_images
-- ----------------------------
INSERT INTO `pa_images` VALUES ('33', 'news', '20140228021215_98055.jpg', '/newconist/Uploads/image/news/20140228/20140228021215_98055.jpg', '1394159259');
INSERT INTO `pa_images` VALUES ('34', 'product', '20140228021215_98055.jpg', '/newconist/Uploads/image/news/20140228/20140228021215_98055.jpg', '1394176319');
INSERT INTO `pa_images` VALUES ('37', 'product', '20140310073926_27245.jpg', '/newconist/Uploads/image/product/20140310/20140310073926_27245.jpg', '1394437177');
INSERT INTO `pa_images` VALUES ('39', 'product', '20140310074050_66596.jpg', '/newconist/Uploads/image/product/20140310/20140310074050_66596.jpg', '1394437252');
INSERT INTO `pa_images` VALUES ('40', 'news', '20140310073926_27245.jpg', '/newconist/Uploads/image/product/20140310/20140310073926_27245.jpg', '1394437811');
INSERT INTO `pa_images` VALUES ('42', 'product', '20140310074033_57603.jpg', '/newconist/Uploads/image/product/20140310/20140310074033_57603.jpg', '1394441436');
INSERT INTO `pa_images` VALUES ('49', 'product', '20140310074050_66596.jpg', '/newconist/Uploads/image/product/20140310/20140310074050_66596.jpg', '1395295064');
INSERT INTO `pa_images` VALUES ('50', 'product', '20140310074033_57603.jpg', '/newconist/Uploads/image/product/20140310/20140310074033_57603.jpg', '1395295064');
INSERT INTO `pa_images` VALUES ('51', 'product', '20140310073926_27245.jpg', '/newconist/Uploads/image/product/20140310/20140310073926_27245.jpg', '1395295064');

-- ----------------------------
-- Table structure for pa_link
-- ----------------------------
DROP TABLE IF EXISTS `pa_link`;
CREATE TABLE `pa_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) NOT NULL,
  `display` int(1) NOT NULL,
  `link` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL,
  `target` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pa_link
-- ----------------------------
INSERT INTO `pa_link` VALUES ('6', '来揭秘', '1', 'http://www.laijiemi.cn', '0', '2');

-- ----------------------------
-- Table structure for pa_member
-- ----------------------------
DROP TABLE IF EXISTS `pa_member`;
CREATE TABLE `pa_member` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `weibo_uid` varchar(15) DEFAULT NULL COMMENT '对应的新浪微博uid',
  `tencent_uid` varchar(20) DEFAULT NULL COMMENT '腾讯微博UID',
  `email` varchar(100) DEFAULT NULL COMMENT '邮箱地址',
  `nickname` varchar(20) DEFAULT NULL COMMENT '用户昵称',
  `pwd` char(32) DEFAULT NULL COMMENT '密码',
  `reg_date` int(10) DEFAULT NULL,
  `reg_ip` char(15) DEFAULT NULL COMMENT '注册IP地址',
  `verify_status` int(1) DEFAULT '0' COMMENT '电子邮件验证标示 0未验证，1已验证',
  `verify_code` varchar(32) DEFAULT NULL COMMENT '电子邮件验证随机码',
  `verify_time` int(10) DEFAULT NULL COMMENT '邮箱验证时间',
  `verify_exp_time` int(10) DEFAULT NULL COMMENT '验证邮件过期时间',
  `find_fwd_code` varchar(32) DEFAULT NULL COMMENT '找回密码验证随机码',
  `find_pwd_time` int(10) DEFAULT NULL COMMENT '找回密码申请提交时间',
  `find_pwd_exp_time` int(10) DEFAULT NULL COMMENT '找回密码验证随机码过期时间',
  `avatar` varchar(100) DEFAULT NULL COMMENT '用户头像',
  `birthday` int(10) DEFAULT NULL COMMENT '用户生日',
  `sex` int(1) DEFAULT NULL COMMENT '0女1男',
  `address` varchar(50) DEFAULT NULL COMMENT '地址',
  `province` varchar(100) DEFAULT NULL COMMENT '省份',
  `city` varchar(100) DEFAULT NULL COMMENT '城市',
  `intr` varchar(500) DEFAULT NULL COMMENT '个人介绍',
  `mobile` varchar(11) DEFAULT NULL COMMENT '手机号码',
  `phone` varchar(30) DEFAULT NULL COMMENT '电话',
  `fax` varchar(30) DEFAULT NULL,
  `qq` int(15) DEFAULT NULL,
  `msn` varchar(100) DEFAULT NULL,
  `login_ip` varchar(15) DEFAULT NULL COMMENT '登录ip',
  `login_time` int(10) DEFAULT NULL COMMENT '登录时间',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=352 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='网站前台会员表';

-- ----------------------------
-- Records of pa_member
-- ----------------------------
INSERT INTO `pa_member` VALUES ('351', null, null, 'zhibin3@qq.com', '是是非非', '76c2fed3b2ece2e2c56df34db830e86d', null, null, '0', null, null, null, null, null, null, null, null, null, null, null, 'bj', null, '15201412883', '', null, '448188161', '', null, null);

-- ----------------------------
-- Table structure for pa_nav
-- ----------------------------
DROP TABLE IF EXISTS `pa_nav`;
CREATE TABLE `pa_nav` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `module` varchar(20) NOT NULL,
  `nav_name` varchar(255) NOT NULL,
  `parent_id` smallint(5) NOT NULL DEFAULT '0',
  `guide` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `link` varchar(225) NOT NULL,
  `lang` varchar(10) NOT NULL DEFAULT 'zh-cn' COMMENT '语言',
  `sort` tinyint(1) unsigned NOT NULL DEFAULT '50',
  `target` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pa_nav
-- ----------------------------

-- ----------------------------
-- Table structure for pa_news
-- ----------------------------
DROP TABLE IF EXISTS `pa_news`;
CREATE TABLE `pa_news` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `cid` smallint(3) DEFAULT NULL COMMENT '所在分类',
  `title` varchar(200) DEFAULT NULL COMMENT '新闻标题',
  `keywords` varchar(50) DEFAULT NULL COMMENT '文章关键字',
  `description` mediumtext COMMENT '文章描述',
  `status` tinyint(1) DEFAULT '0',
  `summary` varchar(255) DEFAULT NULL COMMENT '文章摘要',
  `published` int(10) unsigned DEFAULT NULL COMMENT '发布时间',
  `update_time` int(10) unsigned DEFAULT NULL,
  `content` text,
  `click` int(11) NOT NULL DEFAULT '0',
  `aid` smallint(3) DEFAULT NULL COMMENT '发布者UID',
  `is_recommend` int(1) NOT NULL DEFAULT '0',
  `image_id` int(11) NOT NULL DEFAULT '0',
  `lang` varchar(5) NOT NULL DEFAULT 'zh-cn',
  `source` varchar(20) NOT NULL DEFAULT '' COMMENT '来源',
  `author` varchar(20) NOT NULL DEFAULT '' COMMENT '作者',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='新闻表';

-- ----------------------------
-- Records of pa_news
-- ----------------------------
INSERT INTO `pa_news` VALUES ('19', '1', 'html的用法', '新闻,测试', '新闻,测试', '-1', '新闻,测试', '1473660170', '1474530494', '&lt;p&gt;\n	&lt;span style=&quot;font-family:微软雅黑, Arial, 宋体;font-size:14px;line-height:1.5;background-color:#FFFFFF;&quot;&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;在设置DIV高度的时候，会用到一个height:100%的大小，来让div撑满浏览器高度。但是我们会发现，直接在div中上“style:&quot;height:100%;&quot;”是无效的。&lt;/span&gt;\n&lt;/p&gt;\n&lt;p style=&quot;text-indent:2em;font-family:微软雅黑, Arial, 宋体;font-size:14px;background:#FFFFFF;&quot;&gt;\n	那么如何才能让div的css height:100%生效呢？解决办法很简单，同时也能适配多个浏览器。\n&lt;/p&gt;\n&lt;p style=&quot;text-indent:2em;font-family:微软雅黑, Arial, 宋体;font-size:14px;background:#FFFFFF;&quot;&gt;\n	方法就是在css当中增加上：\n&lt;/p&gt;\n&lt;p style=&quot;text-indent:2em;font-family:微软雅黑, Arial, 宋体;font-size:14px;background:#FFFFFF;&quot;&gt;\n	html, body{ margin:0; height:100%; }\n&lt;/p&gt;\n&lt;p style=&quot;text-indent:2em;font-family:微软雅黑, Arial, 宋体;font-size:14px;background:#FFFFFF;&quot;&gt;\n	这样，在div中使用height:100%就能够正常显示了。\n&lt;/p&gt;\n&lt;p style=&quot;text-indent:2em;font-family:微软雅黑, Arial, 宋体;font-size:14px;background:#FFFFFF;&quot;&gt;\n	示例代码：\n&lt;/p&gt;\n&lt;p style=&quot;text-indent:2em;font-family:微软雅黑, Arial, 宋体;font-size:14px;background:#FFFFFF;&quot;&gt;\n	&lt;span style=&quot;line-height:1.5;&quot;&gt;&amp;lt;!DOCTYPE html PUBLIC &quot;-//W3C//DTD XHTML 1.0 Transitional//EN&quot; &quot;http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd&quot;&amp;gt;&lt;/span&gt; \n&lt;/p&gt;\n&lt;p style=&quot;text-indent:2em;font-family:微软雅黑, Arial, 宋体;font-size:14px;background:#FFFFFF;&quot;&gt;\n	&amp;lt;html xmlns=&quot;http://www.w3.org/1999/xhtml&quot;&amp;gt;&lt;br /&gt;\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;lt;head&amp;gt;&lt;br /&gt;\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;lt;meta http-equiv=&quot;Content-Type&quot; content=&quot;text/html; charset=utf-8&quot; /&amp;gt;&lt;br /&gt;\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;lt;title&amp;gt;无标题文档&amp;lt;/title&amp;gt;&lt;br /&gt;\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;lt;style&amp;gt;&lt;br /&gt;\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;html,body{ margin:0px; height:100%;}&amp;nbsp;&lt;br /&gt;\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;.container { height: 100%;}&lt;br /&gt;\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;.c2{ width:100%; background:#09F; font-size:36px;}&lt;br /&gt;\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;lt;/style&amp;gt;&lt;br /&gt;\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;lt;/head&amp;gt;\n&lt;/p&gt;\n&lt;p style=&quot;text-indent:2em;font-family:微软雅黑, Arial, 宋体;font-size:14px;background:#FFFFFF;&quot;&gt;\n	&amp;lt;body&amp;gt;&lt;br /&gt;\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;lt;div class=&quot;container c2&quot; &amp;gt;威易网 www.weste.net&amp;lt;/div&amp;gt;&lt;br /&gt;\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;lt;/body&amp;gt;&lt;br /&gt;\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;lt;/html&amp;gt;\n&lt;/p&gt;', '0', '1', '0', '0', 'zh-cn', '来揭秘', 'xie1776');
INSERT INTO `pa_news` VALUES ('20', '57', '背影', '', '', '1', '我与父亲不相见已二年余了，我最不能忘记的是他的背影。那年冬天，祖母死了，父亲的差使也交卸了，正是祸不单行的日子。我从北京到徐州，打算跟着父亲奔丧回家。到徐州见着父亲，看见满院狼藉的东西，又想起祖母，不禁簌簌地流下眼泪。父亲说：“事已如此，不必难过，好在天无绝人之路！”回家变卖典质，父亲还了亏空；又借钱办了丧事。这些日子，家中光景很是惨淡，一半为了丧事，一半为了父亲赋闲。丧事完毕，父亲要到南京谋事，…', '1474530645', '1474535533', '&lt;p style=&quot;color:#424B50;font-family:&quot; font-size:16px;&quot;=&quot;&quot;&gt;\n	&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;我与父亲不相见已二年余了，我最不能忘记的是他的背影。\n	&lt;/p&gt;\n&lt;p style=&quot;color:#424B50;font-family:&quot; font-size:16px;&quot;=&quot;&quot;&gt;\n	&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;那年冬天，祖母死了，父亲的差使也交卸了，正是祸不单行的日子。我从北京到徐州，打算跟着父亲奔丧回家。到徐州见着父亲，看见满院狼藉的东西，又想起祖母，不禁簌簌地流下眼泪。父亲说：“事已如此，不必难过，好在天无绝人之路！”\n&lt;/p&gt;\n&lt;p style=&quot;color:#424B50;font-family:&quot; font-size:16px;&quot;=&quot;&quot;&gt;\n	&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;回家变卖典质，父亲还了亏空；又借钱办了丧事。这些日子，家中光景很是惨淡，一半为了丧事，一半为了父亲赋闲。丧事完毕，父亲要到南京谋事，我也要回北京念书，我们便同行。\n	&lt;/p&gt;\n&lt;p style=&quot;color:#424B50;font-family:&quot; font-size:16px;&quot;=&quot;&quot;&gt;\n	&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;到南京时，有朋友约去游逛，勾留了一日；第二日上午便须渡江到浦口，下午上车北去。父亲因为事忙，本已说定不送我，叫旅馆里一个熟识的茶房陪我同去。他再三嘱咐茶房，甚是仔细。但他终于不放心，怕茶房不妥帖；颇踌躇了一会。其实我那年已二十岁，北京已来往过两三次，是没有什么要紧的了。他踌躇了一会，终于决定还是自己送我去。我两三回劝他不必去；他只说，“不要紧，他们去不好！”\n&lt;/p&gt;\n&lt;p style=&quot;color:#424B50;font-family:&quot; font-size:16px;&quot;=&quot;&quot;&gt;\n	&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;我们过了江，进了车站。我买票，他忙着照看行李。行李太多了，得向脚夫行些小费才可过去。他便又忙着和他们讲价钱。我那时真是聪明过分，总觉他说话不大漂亮，非自己插嘴不可，但他终于讲定了价钱；就送我上车。他给我拣定了靠车门的一张椅子；我将他给我做的紫毛大衣铺好坐位。他嘱我路上小心，夜里要警醒些，不要受凉。又嘱托茶房好好照应我。我心里暗笑他的迂；他们只认得钱，托他们只是白托！而且我这样大年纪的人，难道还不能料理自己么？唉，我现在想想，那时真是太聪明了！\n	&lt;/p&gt;\n&lt;p style=&quot;color:#424B50;font-family:&quot; font-size:16px;&quot;=&quot;&quot;&gt;\n	&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;我说道，“爸爸，你走吧。”他望车外看了看说：“我买几个橘子去。你就在此地，不要走动。”我看那边月台的栅栏外有几个卖东西的等着顾客。走到那边月台，须穿过铁道，须跳下去又爬上去。父亲是一个胖子，走过去自然要费事些。我本来要去的，他不肯，只好让他去。我看见他戴着黑布小帽，穿着黑布大马褂，深青布棉袍，蹒跚地走到铁道边，慢慢探身下去，尚不大难。可是他穿过铁道，要爬上那边月台，就不容易了。他用两手攀着上面，两脚再向上缩；他肥胖的身子向左微倾，显出努力的样子。这时我看见他的背影，我的泪很快地流下来了。我赶紧拭干了泪。怕他看见，也怕别人看见。我再向外看时，他已抱了朱红的橘子往回走了。过铁道时，他先将橘子散放在地上，自己慢慢爬下，再抱起橘子走。到这边时，我赶紧去搀他。他和我走到车上，将橘子一股脑儿放在我的皮大衣上。于是扑扑衣上的泥土，心里很轻松似的。过一会说：“我走了，到那边来信！”我望着他走出去。他走了几步，回过头看见我，说：“进去吧，里边没人。”等他的背影混入来来往往的人里，再找不着了，我便进来坐下，我的眼泪又来了。\n&lt;/p&gt;\n&lt;p style=&quot;color:#424B50;font-family:&quot; font-size:16px;&quot;=&quot;&quot;&gt;\n	&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;近几年来，父亲和我都是东奔西走，家中光景是一日不如一日。他少年出外谋生，独力支持，做了许多大事。哪知老境却如此颓唐！他触目伤怀，自然情不能自已。情郁于中，自然要发之于外；家庭琐屑便往往触他之怒。他待我渐渐不同往日。但最近两年的不见，他终于忘却我的不好，只是惦记着我，惦记着我的儿子。我北来后，他写了一信给我，信中说道：“我身体平安，惟膀子疼痛厉害，举箸提笔，诸多不便，大约大去之期不远矣。”我读到此处，在晶莹的泪光中，又看见那肥胖的、青布棉袍黑布马褂的背影。唉！我不知何时再能与他相见！\n	&lt;/p&gt;\n&lt;p style=&quot;color:#424B50;font-family:&quot; font-size:16px;&quot;=&quot;&quot;&gt;\n	——&amp;nbsp;朱自清\n&lt;/p&gt;', '0', '1', '0', '0', 'zh-cn', '书本', '朱自清');
INSERT INTO `pa_news` VALUES ('21', '1', '这是一个测试文章', '', '', '0', '这是一个测试文章', '1474536223', null, '<p>\n	这是一个测试文章\n</p>\n<p>\n	<img src=\"/Public/Uploads/image/20160922/20160922172339_71270.png\" alt=\"\" />\n</p>', '0', '1', '0', '0', 'zh-cn', '', '');

-- ----------------------------
-- Table structure for pa_node
-- ----------------------------
DROP TABLE IF EXISTS `pa_node`;
CREATE TABLE `pa_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `remark` varchar(255) DEFAULT NULL,
  `sort` smallint(6) unsigned DEFAULT NULL,
  `pid` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8 COMMENT='权限节点表';

-- ----------------------------
-- Records of pa_node
-- ----------------------------
INSERT INTO `pa_node` VALUES ('1', 'Admin', '后台管理', '1', '网站后台管理项目', '10', '0', '1');
INSERT INTO `pa_node` VALUES ('2', 'Index', '管理首页', '1', '', '1', '1', '2');
INSERT INTO `pa_node` VALUES ('3', 'Member', '注册会员管理', '1', '', '3', '1', '2');
INSERT INTO `pa_node` VALUES ('4', 'Webinfo', '系统管理', '1', '', '4', '1', '2');
INSERT INTO `pa_node` VALUES ('5', 'index', '默认页', '1', '', '5', '2', '3');
INSERT INTO `pa_node` VALUES ('6', 'myInfo', '我的个人信息', '1', '', '6', '2', '3');
INSERT INTO `pa_node` VALUES ('7', 'index', '会员首页', '1', '', '7', '3', '3');
INSERT INTO `pa_node` VALUES ('8', 'index', '管理员列表', '1', '', '8', '14', '3');
INSERT INTO `pa_node` VALUES ('9', 'addAdmin', '添加管理员', '1', '', '9', '14', '3');
INSERT INTO `pa_node` VALUES ('10', 'index', '系统设置首页', '1', '', '10', '4', '3');
INSERT INTO `pa_node` VALUES ('11', 'setEmailConfig', '设置系统邮件', '1', '', '12', '4', '3');
INSERT INTO `pa_node` VALUES ('12', 'testEmailConfig', '发送测试邮件', '1', '', '0', '4', '3');
INSERT INTO `pa_node` VALUES ('13', 'setSafeConfig', '系统安全设置', '1', '', '0', '4', '3');
INSERT INTO `pa_node` VALUES ('14', 'Access', '权限管理', '1', '权限管理，为系统后台管理员设置不同的权限', '0', '1', '2');
INSERT INTO `pa_node` VALUES ('15', 'nodeList', '查看节点', '1', '节点列表信息', '0', '14', '3');
INSERT INTO `pa_node` VALUES ('16', 'roleList', '角色列表查看', '1', '角色列表查看', '0', '14', '3');
INSERT INTO `pa_node` VALUES ('17', 'addRole', '添加角色', '1', '', '0', '14', '3');
INSERT INTO `pa_node` VALUES ('18', 'editRole', '编辑角色', '1', '', '0', '14', '3');
INSERT INTO `pa_node` VALUES ('19', 'opNodeStatus', '便捷开启禁用节点', '1', '', '0', '14', '3');
INSERT INTO `pa_node` VALUES ('20', 'opRoleStatus', '便捷开启禁用角色', '1', '', '0', '14', '3');
INSERT INTO `pa_node` VALUES ('21', 'editNode', '编辑节点', '1', '', '0', '14', '3');
INSERT INTO `pa_node` VALUES ('22', 'addNode', '添加节点', '1', '', '0', '14', '3');
INSERT INTO `pa_node` VALUES ('23', 'addAdmin', '添加管理员', '1', '', '0', '14', '3');
INSERT INTO `pa_node` VALUES ('24', 'editAdmin', '编辑管理员信息', '1', '', '0', '14', '3');
INSERT INTO `pa_node` VALUES ('25', 'changeRole', '权限分配', '1', '', '0', '14', '3');
INSERT INTO `pa_node` VALUES ('26', 'News', '资讯管理', '1', '', '0', '1', '2');
INSERT INTO `pa_node` VALUES ('27', 'index', '新闻列表', '1', '', '0', '26', '3');
INSERT INTO `pa_node` VALUES ('28', 'category', '新闻分类管理', '1', '', '0', '26', '3');
INSERT INTO `pa_node` VALUES ('29', 'add', '发布新闻', '1', '', '0', '26', '3');
INSERT INTO `pa_node` VALUES ('30', 'edit', '编辑新闻', '1', '', '0', '26', '3');
INSERT INTO `pa_node` VALUES ('31', 'del', '删除信息', '0', '', '0', '26', '3');
INSERT INTO `pa_node` VALUES ('32', 'SysData', '数据库管理', '1', '包含数据库备份、还原、打包等', '0', '1', '2');
INSERT INTO `pa_node` VALUES ('33', 'index', '查看数据库表结构信息', '1', '', '0', '32', '3');
INSERT INTO `pa_node` VALUES ('34', 'backup', '备份数据库', '1', '', '0', '32', '3');
INSERT INTO `pa_node` VALUES ('35', 'restore', '查看已备份SQL文件', '1', '', '0', '32', '3');
INSERT INTO `pa_node` VALUES ('36', 'restoreData', '执行数据库还原操作', '1', '', '0', '32', '3');
INSERT INTO `pa_node` VALUES ('37', 'delSqlFiles', '删除SQL文件', '1', '', '0', '32', '3');
INSERT INTO `pa_node` VALUES ('38', 'sendSql', '邮件发送SQL文件', '1', '', '0', '32', '3');
INSERT INTO `pa_node` VALUES ('39', 'zipSql', '打包SQL文件', '1', '', '0', '32', '3');
INSERT INTO `pa_node` VALUES ('40', 'zipList', '查看已打包SQL文件', '1', '', '0', '32', '3');
INSERT INTO `pa_node` VALUES ('41', 'unzipSqlfile', '解压缩ZIP文件', '1', '', '0', '32', '3');
INSERT INTO `pa_node` VALUES ('42', 'delZipFiles', '删除zip压缩文件', '1', '', '0', '32', '3');
INSERT INTO `pa_node` VALUES ('43', 'downFile', '下载备份的SQL,ZIP文件', '1', '', '0', '32', '3');
INSERT INTO `pa_node` VALUES ('44', 'repair', '数据库优化修复', '1', '', '0', '32', '3');
INSERT INTO `pa_node` VALUES ('46', 'Siteinfo', '网站功能', '1', '', '0', '1', '2');
INSERT INTO `pa_node` VALUES ('47', 'index', '菜单列表', '1', '', '0', '46', '3');
INSERT INTO `pa_node` VALUES ('48', 'add_nav', '添加/编辑菜单', '1', '', '0', '46', '3');
INSERT INTO `pa_node` VALUES ('49', 'adindex', '轮播列表', '1', '', '0', '46', '3');
INSERT INTO `pa_node` VALUES ('50', 'add_ad', '添加/编辑轮播', '1', '', '0', '46', '3');
INSERT INTO `pa_node` VALUES ('51', 'page', '单页列表', '1', '', '0', '46', '3');
INSERT INTO `pa_node` VALUES ('52', 'add_page', '添加/编辑单页', '1', '', '0', '46', '3');
INSERT INTO `pa_node` VALUES ('53', 'tag_index', '标签列表', '1', '', '0', '46', '3');
INSERT INTO `pa_node` VALUES ('54', 'add_tag', '添加/编辑标签', '1', '', '0', '46', '3');
INSERT INTO `pa_node` VALUES ('55', 'create_tag', '模版标签生成', '1', '', '0', '46', '3');
INSERT INTO `pa_node` VALUES ('56', 'file_index', '文件管理', '1', '', '0', '46', '3');
INSERT INTO `pa_node` VALUES ('57', 'link_index', '友情链接列表', '1', '', '0', '46', '3');
INSERT INTO `pa_node` VALUES ('58', 'add_link', '添加/编辑友情链接', '1', '', '0', '46', '3');
INSERT INTO `pa_node` VALUES ('59', 'message', '留言信息列表', '1', '', '0', '46', '3');
INSERT INTO `pa_node` VALUES ('60', 'Product', '产品管理', '1', '', '0', '1', '2');
INSERT INTO `pa_node` VALUES ('61', 'delpage', '删除单页', '1', '', '0', '46', '3');
INSERT INTO `pa_node` VALUES ('62', 'delad', '删除轮播', '1', '', '0', '46', '3');
INSERT INTO `pa_node` VALUES ('63', 'dellink', '删除友情链接', '1', '', '0', '46', '3');
INSERT INTO `pa_node` VALUES ('64', 'delmessage', '删除留言', '1', '', '0', '46', '3');
INSERT INTO `pa_node` VALUES ('65', 'deltag', '删除标签', '1', '', '0', '46', '3');
INSERT INTO `pa_node` VALUES ('66', 'selectCat', '文章分类', '1', '', '0', '46', '3');
INSERT INTO `pa_node` VALUES ('67', 'index', '产品列表', '1', '', '0', '60', '3');
INSERT INTO `pa_node` VALUES ('68', 'edit', '编辑产品', '1', '', '0', '60', '3');
INSERT INTO `pa_node` VALUES ('69', 'add', '添加产品', '1', '', '0', '60', '3');
INSERT INTO `pa_node` VALUES ('70', 'category', '分类列表', '1', '', '0', '60', '3');
INSERT INTO `pa_node` VALUES ('71', 'del', '删除产品', '1', '', '0', '60', '3');
INSERT INTO `pa_node` VALUES ('72', 'changeAttr', '快速推荐', '1', '', '0', '60', '3');
INSERT INTO `pa_node` VALUES ('73', 'changeStatus', '快速审核', '0', '', '0', '60', '3');
INSERT INTO `pa_node` VALUES ('74', 'changePhoneStatus', '手机推荐', '1', '', '0', '60', '3');
INSERT INTO `pa_node` VALUES ('75', 'checkProductTitle', '标题检查', '1', '', '0', '60', '3');
INSERT INTO `pa_node` VALUES ('76', 'changeAttr', '快速推荐', '1', '', '0', '26', '3');
INSERT INTO `pa_node` VALUES ('77', 'changeStatus', '快速审核', '1', '', '0', '26', '3');
INSERT INTO `pa_node` VALUES ('78', 'Models', '模型管理', '0', '', '0', '1', '2');
INSERT INTO `pa_node` VALUES ('79', 'index', '模型列表', '0', '', '0', '78', '3');
INSERT INTO `pa_node` VALUES ('80', 'add', '添加模型', '0', '', '0', '78', '3');

-- ----------------------------
-- Table structure for pa_product
-- ----------------------------
DROP TABLE IF EXISTS `pa_product`;
CREATE TABLE `pa_product` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `cid` smallint(3) DEFAULT NULL COMMENT '所在分类',
  `title` varchar(200) DEFAULT NULL COMMENT '产品标题',
  `price` double(10,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `psize` varchar(32) NOT NULL,
  `image_id` varchar(255) NOT NULL COMMENT '图片',
  `keywords` varchar(50) DEFAULT NULL COMMENT '产品关键字',
  `description` mediumtext COMMENT '产品描述',
  `status` tinyint(1) DEFAULT NULL,
  `summary` varchar(255) DEFAULT NULL COMMENT '产品摘要',
  `published` int(10) DEFAULT NULL,
  `update_time` int(10) DEFAULT NULL,
  `content` text,
  `lang` varchar(10) NOT NULL DEFAULT 'zh-cn',
  `aid` smallint(3) DEFAULT NULL COMMENT '发布者UID',
  `click` int(11) NOT NULL DEFAULT '0',
  `is_recommend` int(1) NOT NULL DEFAULT '0',
  `wap_display` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COMMENT='产品表';

-- ----------------------------
-- Records of pa_product
-- ----------------------------
INSERT INTO `pa_product` VALUES ('30', '52', '添加编辑产品', '43.00', '543', '37', '', '添加编辑产品', '1', '添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品', '1394159208', '1394437177', '<span style=\"&quot;\\&quot;color:#333333;font-family:Verdana,&quot;\" geneva,=\"&quot;&quot;\" sans-serif;line-height:22px;background-color:#f2f2f2;\\\"=\"&quot;&quot;\">添加编辑产品</span>', 'zh-cn', '1', '1', '1', '1');
INSERT INTO `pa_product` VALUES ('32', '56', '添加编辑产品', '43.00', '543', '42', '', '添加编辑产品', '1', '添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品', '1394437234', '1394441436', '<span style=\"&quot;&quot;&quot;\\&quot;color:#333333;font-family:Verdana,&quot;&quot;&quot;\" geneva,=\"&quot;&quot;&quot;&quot;&quot;&quot;\" sans-serif;line-height:22px;background-color:#f2f2f2;\\\"=\"&quot;&quot;&quot;&quot;&quot;&quot;\">添加编辑产品</span>', 'zh-cn', '1', '3', '1', '1');
INSERT INTO `pa_product` VALUES ('33', '52', '添加编辑产品', '43.00', '543', '39', '', '添加编辑产品', '1', '添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品', '1394437252', '0', '<span style=\"&quot;\\&quot;\\\\&quot;\\\\\\\\&quot;color:#333333;font-family:Verdana,\\\\&quot;\\&quot;&quot;\" geneva,=\"&quot;\\&quot;\\\\&quot;\\\\&quot;\\&quot;&quot;\" sans-serif;line-height:22px;background-color:#f2f2f2;\\\\\\\\\\\\\\\"=\"&quot;\\&quot;\\\\&quot;\\\\&quot;\\&quot;&quot;\">添加编辑产品</span>', 'zh-cn', '1', '31', '1', '1');
INSERT INTO `pa_product` VALUES ('34', '55', '添加编辑产品', '43.00', '543', '49,50,51', '', '添加编辑产品', '1', '添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品', '1394441422', '1395295064', '如果豆腐干豆腐干梵蒂冈', 'zh-cn', '1', '24', '1', '1');

-- ----------------------------
-- Table structure for pa_role
-- ----------------------------
DROP TABLE IF EXISTS `pa_role`;
CREATE TABLE `pa_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `pid` smallint(6) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='权限角色表';

-- ----------------------------
-- Records of pa_role
-- ----------------------------
INSERT INTO `pa_role` VALUES ('1', '超级管理员', '0', '1', '系统内置超级管理员组，不受权限分配账号限制');
INSERT INTO `pa_role` VALUES ('2', '管理员', '1', '1', '拥有系统仅此于超级管理员的权限');
INSERT INTO `pa_role` VALUES ('3', '领导', '1', '1', '拥有所有操作的读权限，无增加、删除、修改的权限');
INSERT INTO `pa_role` VALUES ('4', '测试组', '1', '1', '测试');

-- ----------------------------
-- Table structure for pa_role_user
-- ----------------------------
DROP TABLE IF EXISTS `pa_role_user`;
CREATE TABLE `pa_role_user` (
  `role_id` mediumint(9) unsigned DEFAULT NULL,
  `user_id` char(32) DEFAULT NULL,
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户角色表';

-- ----------------------------
-- Records of pa_role_user
-- ----------------------------
INSERT INTO `pa_role_user` VALUES ('3', '4');
INSERT INTO `pa_role_user` VALUES ('3', '4');
INSERT INTO `pa_role_user` VALUES ('3', '4');
INSERT INTO `pa_role_user` VALUES ('4', '2');

-- ----------------------------
-- Table structure for pa_tag
-- ----------------------------
DROP TABLE IF EXISTS `pa_tag`;
CREATE TABLE `pa_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL,
  `unique_id` char(20) NOT NULL,
  `content` text NOT NULL,
  `lang` varchar(10) NOT NULL DEFAULT 'zh-cn',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pa_tag
-- ----------------------------
INSERT INTO `pa_tag` VALUES ('6', '关于我们', 'aboutus', '<h3> <img src=\"/newconist/Uploads/image/product/20140303/20140303081406_87297.jpg\" width=\"100\" height=\"100\" align=\"left\" alt=\"\" /> </h3><p>  在此处输入内容覆盖多个地方官热风斯蒂芬<span>在此处输入内容覆盖多个地方官热风斯蒂芬<span>在此处输入内容覆盖多个地方官热风斯蒂芬<span>在此处输入内容覆盖多个地方官热风斯蒂芬<span>在此处输入内容覆盖多个地方官热风斯蒂芬<span>在此处输入内容覆盖多个地方官热风斯蒂芬<span>在此处输入内容覆盖多个地方官热风斯蒂芬<span>在此处输入内容覆盖多个地方官热风斯蒂芬<span>在此处输入内容覆盖多个地方官热风斯蒂芬<span>在此处输入内容覆盖多<span></span></span></span></span></span></span></span></span></span></span></p>', 'zh-cn');
