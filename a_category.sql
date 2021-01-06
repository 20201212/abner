/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : abner

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2021-01-06 23:34:53
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for a_category
-- ----------------------------
DROP TABLE IF EXISTS `a_category`;
CREATE TABLE `a_category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `pid` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL COMMENT '图标',
  `path` varchar(255) NOT NULL COMMENT '路径1,2,3',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `poerate_user` varchar(100) NOT NULL COMMENT '操作人',
  `status` tinyint(1) NOT NULL,
  `listorder` int(10) NOT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
