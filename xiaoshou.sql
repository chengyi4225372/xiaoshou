/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50728
Source Host           : localhost:3306
Source Database       : xiaoshou

Target Server Type    : MYSQL
Target Server Version : 50728
File Encoding         : 65001

Date: 2020-05-23 12:24:47
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ab_card
-- ----------------------------
DROP TABLE IF EXISTS `ab_card`;
CREATE TABLE `ab_card` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gid` int(11) DEFAULT NULL COMMENT '商品id',
  `mid` int(11) DEFAULT NULL COMMENT '顾客id',
  `dan` decimal(10,2) DEFAULT NULL COMMENT '商品单价',
  `counts` varchar(255) DEFAULT NULL COMMENT '商品数量',
  `status` int(11) DEFAULT '1' COMMENT '0 del',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ab_card
-- ----------------------------
INSERT INTO `ab_card` VALUES ('1', '1', '5', '7.00', '2', '1');
INSERT INTO `ab_card` VALUES ('2', '1', '5', '7.00', '1', '1');

-- ----------------------------
-- Table structure for ab_daili
-- ----------------------------
DROP TABLE IF EXISTS `ab_daili`;
CREATE TABLE `ab_daili` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(255) DEFAULT NULL,
  `truename` varchar(255) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pwd` varchar(32) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL COMMENT '所在地区',
  `create_time` int(12) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ab_daili
-- ----------------------------

-- ----------------------------
-- Table structure for ab_goods
-- ----------------------------
DROP TABLE IF EXISTS `ab_goods`;
CREATE TABLE `ab_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(5) unsigned DEFAULT '1' COMMENT '商品类型',
  `title` varchar(255) DEFAULT NULL,
  `imgs` varchar(255) DEFAULT NULL,
  `dan` decimal(10,2) DEFAULT NULL,
  `counts` int(5) DEFAULT NULL,
  `status` int(2) DEFAULT '1' COMMENT '0 del ',
  `create_time` int(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ab_goods
-- ----------------------------
INSERT INTO `ab_goods` VALUES ('1', '1', 'n95 口罩', '/uploads/imgs/wen/20200522/ea534751b6210b981875b80eb03f3c39.jpg', '7.00', '100', '1', '1590162058');
INSERT INTO `ab_goods` VALUES ('2', '2', '口罩', '/uploads/imgs/wen/20200522/25f0e70ee6cc9e81879725e3b4a9c3f8.jpg', '5.00', '100', '1', '1590162207');
INSERT INTO `ab_goods` VALUES ('3', '3', 'n95', '/uploads/imgs/wen/20200522/49794e300cebef62a7296cc27d5e5671.jpg', '10.00', '100', '1', '1590162259');

-- ----------------------------
-- Table structure for ab_member
-- ----------------------------
DROP TABLE IF EXISTS `ab_member`;
CREATE TABLE `ab_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `users` varchar(255) DEFAULT NULL,
  `pwd` varchar(32) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `create_time` int(12) unsigned DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL COMMENT '顾客所在地区',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ab_member
-- ----------------------------
INSERT INTO `ab_member` VALUES ('5', '张三', 'e10adc3949ba59abbe56e057f20f883e', '463039155@qq.com', '18672536008', '1590149943', '安徽');

-- ----------------------------
-- Table structure for ab_order
-- ----------------------------
DROP TABLE IF EXISTS `ab_order`;
CREATE TABLE `ab_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cust_name` varchar(255) DEFAULT NULL COMMENT '下单顾客名',
  `gid` int(10) DEFAULT NULL COMMENT '商品类型',
  `good_name` varchar(255) DEFAULT NULL,
  `counts` varchar(255) DEFAULT NULL,
  `totals` varchar(255) DEFAULT NULL COMMENT '金额',
  `region` varchar(255) DEFAULT NULL,
  `status` int(5) DEFAULT '1' COMMENT '1 未支付 2已支付 3支付未发货',
  `create_time` int(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ab_order
-- ----------------------------

-- ----------------------------
-- Table structure for ab_users
-- ----------------------------
DROP TABLE IF EXISTS `ab_users`;
CREATE TABLE `ab_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `users` varchar(200) DEFAULT NULL,
  `pwd` varchar(32) DEFAULT NULL,
  `role` int(3) DEFAULT '1' COMMENT '角色',
  `rep_relname` varchar(255) DEFAULT NULL,
  `rep_email` varchar(255) DEFAULT NULL,
  `rep_region` varchar(255) DEFAULT NULL,
  `rep_tel` varchar(255) DEFAULT NULL,
  `status` int(3) DEFAULT '1' COMMENT '1 =>ok 0=>delete',
  `create_time` int(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ab_users
-- ----------------------------
INSERT INTO `ab_users` VALUES ('2', 'admin', '0192023a7bbd73250516f069df18b500', '1', null, null, null, null, '1', '1589519635');
INSERT INTO `ab_users` VALUES ('11', 'root', 'e10adc3949ba59abbe56e057f20f883e', '2', '里斯管', '546544@qq.com', '天津', '45678921', '1', '1590139806');
INSERT INTO `ab_users` VALUES ('12', 'huyidao', 'e10adc3949ba59abbe56e057f20f883e', '2', '张无忌', '546544@qq.com', '安徽', '45678921', '1', '1590139849');
INSERT INTO `ab_users` VALUES ('13', 'zhang', 'e10adc3949ba59abbe56e057f20f883e', '2', '张无忌', '546544@qq.com', '湖北', '45678921', '1', '1590139925');
INSERT INTO `ab_users` VALUES ('14', 'aaaa', 'e10adc3949ba59abbe56e057f20f883e', '2', null, null, null, null, '0', '1590139965');

-- ----------------------------
-- Table structure for banner
-- ----------------------------
DROP TABLE IF EXISTS `banner`;
CREATE TABLE `banner` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `imgs` varchar(255) DEFAULT NULL,
  `status` int(3) DEFAULT '1' COMMENT '0 del 1ok',
  `create_time` int(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of banner
-- ----------------------------
INSERT INTO `banner` VALUES ('11', '/uploads/imgs/fimgs/20200518/09844cde3d5bbab2c3f25b197d0de114.jpg', '1', '1589813856');
INSERT INTO `banner` VALUES ('12', '/uploads/imgs/fimgs/20200518/322a01813ad62d26a9a4e18da41d74bf.jpg', '1', '1589814042');
INSERT INTO `banner` VALUES ('13', '/uploads/imgs/fimgs/20200518/92a1629523a7daedc0456e5b86d2adf2.jpg', '1', '1589814090');
INSERT INTO `banner` VALUES ('14', '/uploads/imgs/fimgs/20200518/a5cf7653fd48719c58fe91053ecff8b1.jpg', '1', '1589814449');
INSERT INTO `banner` VALUES ('15', '/uploads/imgs/fimgs/20200519/d2b88f7f8e12305bae334d53b3b71cc8.jpg', '1', '1589875317');

-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `status` int(3) DEFAULT '1' COMMENT '1=>ok 0=>delete',
  `content` text,
  `create_time` int(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES ('1', '吞吞吐吐', '0', 'gggggggggg', '1589724722');
INSERT INTO `news` VALUES ('2', '这是个公告', '0', '这是个公告这是个公告这是个公告这是个公告这是个公告', '1589725636');
INSERT INTO `news` VALUES ('3', '财务管理', '1', '灌灌灌灌灌过过过过过过过过过过过过过过过过', '1589726043');
INSERT INTO `news` VALUES ('4', '更多丰富的丰富的', '1', '更多丰富的丰富的更多丰富的丰富的更多丰富的丰富的', '1589726182');
INSERT INTO `news` VALUES ('5', '吞吞吐吐拖', '1', '提供给过过过过过过过过过', '1589769494');

-- ----------------------------
-- Table structure for wen
-- ----------------------------
DROP TABLE IF EXISTS `wen`;
CREATE TABLE `wen` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `imgs` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` longtext,
  `status` int(3) DEFAULT '1' COMMENT '1 ok o delete',
  `create_time` int(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wen
-- ----------------------------
INSERT INTO `wen` VALUES ('1', '/uploads/imgs/wen/20200519/22ec4a1f133ac4c6a7d2cdd88d641a34.jpg', '企业文化', '回填土拖拖拖拖拖拖拖拖拖拖拖拖拖拖拖拖拖拖拖拖拖', '1', '1589853449');
INSERT INTO `wen` VALUES ('2', '/uploads/imgs/wen/20200519/2601757b93495618912aeb80af42fe8f.jpg', '经验管理', '的点点滴滴多多多多多多多多多', '1', '1589853490');
INSERT INTO `wen` VALUES ('3', '/uploads/imgs/wen/20200519/7a94a0547963bb83806200bf7053f4f6.png', '哈哈哈哈哈哈或或或', '很发达的', '1', '1589853509');
INSERT INTO `wen` VALUES ('4', '/uploads/imgs/wen/20200519/9d1dd3398b6efc7d734ac64305961091.png', '这一个视频', '', '0', '1589855929');
INSERT INTO `wen` VALUES ('6', '/uploads/imgs/wen/20200519/7e1c6fc3dfc2081695aa967a3cc3a1a1.jpg', '456546546', '', '0', '1589878825');
INSERT INTO `wen` VALUES ('7', '/uploads/imgs/wen/20200519/cff6450fcadcd16748627c6c90e40cea.png', '546546546456', '<p><embed src=\"/ueditor/php/upload/video/20200519/1589893252436686.mp4\" width=\"420\" height=\"280\" wmode=\"transparent\" play=\"true\" loop=\"false\" menu=\"false\" allowscriptaccess=\"never\" allowfullscreen=\"true\"/></p>', '1', '1589890606');
INSERT INTO `wen` VALUES ('8', '/uploads/imgs/wen/20200519/581d2f08e50dde67cff9c4af7b3fbad3.png', '灌灌灌灌', '<p><embed src=\"/ueditor/php/upload/video/20200519/1589892934627102.mp4\" width=\"420\" height=\"280\" wmode=\"transparent\" play=\"true\" loop=\"false\" menu=\"false\" allowscriptaccess=\"never\" allowfullscreen=\"true\"/></p>', '1', '1589890761');
