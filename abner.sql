/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : abner

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2021-01-06 22:15:15
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for a_admin_user
-- ----------------------------
DROP TABLE IF EXISTS `a_admin_user`;
CREATE TABLE `a_admin_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `username` varchar(100) NOT NULL COMMENT '用户名',
  `nickname` varchar(100) NOT NULL COMMENT '昵称',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `salf` char(6) NOT NULL COMMENT '密码盐',
  `status` tinyint(1) NOT NULL,
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '更新时间',
  `last_login_time` int(10) NOT NULL COMMENT '最后登录时间',
  `last_login_ip` varchar(30) NOT NULL COMMENT '最后登录IP',
  `operate_user` varchar(100) NOT NULL COMMENT '用户操作',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of a_admin_user
-- ----------------------------
INSERT INTO `a_admin_user` VALUES ('1', 'Abner', 'Abner', '564cd5b97b33b6947f69dae83c81b742', 'abner', '1', '0', '1608478551', '1608478551', '127.0.0.1', 'login');

-- ----------------------------
-- Table structure for a_user
-- ----------------------------
DROP TABLE IF EXISTS `a_user`;
CREATE TABLE `a_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL COMMENT '用户名',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `head` varchar(100) NOT NULL DEFAULT '' COMMENT '头像',
  `phone` varchar(20) NOT NULL,
  `ltype` tinyint(1) NOT NULL DEFAULT '0' COMMENT '登录方式：1.手机号2密码',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '会话天数1.七天，2.三十天',
  `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '性别0.保密，1.男，2女',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `last_time` int(11) NOT NULL COMMENT '最后登录时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态,1正常，2禁用',
  `operate_user` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE,
  KEY `phone` (`phone`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of a_user
-- ----------------------------
INSERT INTO `a_user` VALUES ('14', 'Abner133', '', '', '18801253542', '0', '0', '1', '1609677714', '1609680491', '1', '');
