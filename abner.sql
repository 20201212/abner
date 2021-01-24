/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : abner

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2021-01-24 20:06:44
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
INSERT INTO `a_admin_user` VALUES ('1', 'Abner', 'Abner', '564cd5b97b33b6947f69dae83c81b742', 'abner', '1', '0', '1611485178', '1611485178', '127.0.0.1', 'login');

-- ----------------------------
-- Table structure for a_category
-- ----------------------------
DROP TABLE IF EXISTS `a_category`;
CREATE TABLE `a_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `pid` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL DEFAULT '' COMMENT '图标',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '路径1,2,3',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `poerate_user` varchar(100) NOT NULL DEFAULT '' COMMENT '操作人',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  `listorder` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of a_category
-- ----------------------------
INSERT INTO `a_category` VALUES ('33', '手机', '0', '', '', '1610170256', '1610875788', '', '0', '2');
INSERT INTO `a_category` VALUES ('34', '电脑', '0', '', '', '1610170265', '1610170265', '', '0', '0');
INSERT INTO `a_category` VALUES ('35', '家电', '0', '', '', '1610170271', '1610875706', '', '0', '4');
INSERT INTO `a_category` VALUES ('36', '书', '0', '', '', '1610207547', '1610264023', '', '1', '36');
INSERT INTO `a_category` VALUES ('37', '小米', '33', '', '', '1610264211', '1610264211', '', '1', '0');
INSERT INTO `a_category` VALUES ('38', 'apple', '33', '', '', '1610264231', '1610264231', '', '1', '0');
INSERT INTO `a_category` VALUES ('39', '华为', '33', '', '', '1610264239', '1610264239', '', '1', '0');
INSERT INTO `a_category` VALUES ('40', '小米11', '37', '', '', '1610271099', '1610271099', '', '1', '0');
INSERT INTO `a_category` VALUES ('43', 'test', '0', '', '', '1610870080', '1610876069', '', '1', '0');
INSERT INTO `a_category` VALUES ('44', 'test', '0', '', '', '1610870213', '1610875972', '', '1', '3');
INSERT INTO `a_category` VALUES ('45', 'test1', '0', '', '', '1610870220', '1610875959', '', '1', '3');
INSERT INTO `a_category` VALUES ('46', 'test1-1', '45', '', '', '1610871059', '1610871059', '', '1', '0');
INSERT INTO `a_category` VALUES ('47', 'test1-2', '45', '', '', '1610871180', '1610871180', '', '1', '0');
INSERT INTO `a_category` VALUES ('48', 'test1-2-1', '47', '', '', '1610878927', '1610878927', '', '1', '0');

-- ----------------------------
-- Table structure for a_goods
-- ----------------------------
DROP TABLE IF EXISTS `a_goods`;
CREATE TABLE `a_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '商品标题',
  `category_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品分类',
  `category_path_id` varchar(20) NOT NULL DEFAULT '' COMMENT '栏目ID path',
  `promotion_title` varchar(255) NOT NULL DEFAULT '' COMMENT '商品促销语',
  `goods_unit` varchar(20) NOT NULL DEFAULT '' COMMENT '商品单位',
  `keywords` varchar(100) NOT NULL DEFAULT '' COMMENT '关键词',
  `sub_title` varchar(100) NOT NULL DEFAULT '' COMMENT '副标题',
  `stock` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '库存',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '现价',
  `cost_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '原价',
  `sku_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品默认的sku_id',
  `is_show_stock` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否显示库存',
  `production_time` varchar(10) NOT NULL DEFAULT '0' COMMENT '生产日期',
  `goods_specs_type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '商品规则 1统一，2多规格',
  `big_image` varchar(255) NOT NULL DEFAULT '' COMMENT '大图',
  `recommend_image` varchar(255) NOT NULL DEFAULT '' COMMENT '商品推荐图',
  `carousel_image` varchar(500) NOT NULL DEFAULT '' COMMENT '详情页轮播图',
  `description` text NOT NULL COMMENT '商品详情',
  `is_index_recommend` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否首页推荐大图商品',
  `goods_specs_data` varchar(255) NOT NULL DEFAULT '' COMMENT '所有规则属性存放json',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `operate_user` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `listorder` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序字段',
  PRIMARY KEY (`id`),
  KEY `title` (`title`),
  KEY `category_path_id` (`category_path_id`)
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of a_goods
-- ----------------------------
INSERT INTO `a_goods` VALUES ('114', '商品名称', '48', '45,47,48', '商品促销语', '元', '关键词', '商品副标题', '300', '1.00', '10.00', '198', '1', '2021-01-30', '2', '/upload/images/20210124/27b81938d1ff67720d61f63563e63ca3.png', '/upload/images/20210124/e7b2df8bf559ace7b9832e688802ff52.jpg', '/upload/images/20210124/400d82ecb1585cced40483d91d29771b.png,/upload/images/20210124/2a21910ea5c21845b4b3730d5d2e9ec8.jpg', '哒哒哒哒哒哒多多多多多多<img src=\"/upload/images/20210124/b82f534801064360de92f28f19e26589.png\" alt=\"undefined\">', '0', '', '1611486910', '1611486910', '', '1', '0');
INSERT INTO `a_goods` VALUES ('115', '商品名称', '48', '45,47,48', '商品促销语', '元', '关键词', '商品副标题', '300', '1.00', '10.00', '200', '1', '2021-01-30', '2', '/upload/images/20210124/27b81938d1ff67720d61f63563e63ca3.png', '/upload/images/20210124/e7b2df8bf559ace7b9832e688802ff52.jpg', '/upload/images/20210124/400d82ecb1585cced40483d91d29771b.png,/upload/images/20210124/2a21910ea5c21845b4b3730d5d2e9ec8.jpg', '哒哒哒哒哒哒多多多多多多<img src=\"/upload/images/20210124/b82f534801064360de92f28f19e26589.png\" alt=\"undefined\">', '0', '', '1611486921', '1611486921', '', '1', '0');

-- ----------------------------
-- Table structure for a_goods_sku
-- ----------------------------
DROP TABLE IF EXISTS `a_goods_sku`;
CREATE TABLE `a_goods_sku` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品Id',
  `specs_value_ids` varchar(255) NOT NULL COMMENT '每行规则属性ID 按逗号连接',
  `price` decimal(10,2) unsigned NOT NULL COMMENT '现价',
  `cost_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '原价',
  `stock` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '库存',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=InnoDB AUTO_INCREMENT=202 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of a_goods_sku
-- ----------------------------
INSERT INTO `a_goods_sku` VALUES ('198', '114', '4,20', '1.00', '10.00', '100', '1', '1611486910', '1611486910');
INSERT INTO `a_goods_sku` VALUES ('199', '114', '4,21', '2.00', '20.00', '200', '1', '1611486910', '1611486910');
INSERT INTO `a_goods_sku` VALUES ('200', '115', '4,20', '1.00', '10.00', '100', '1', '1611486921', '1611486921');
INSERT INTO `a_goods_sku` VALUES ('201', '115', '4,21', '2.00', '20.00', '200', '1', '1611486921', '1611486921');

-- ----------------------------
-- Table structure for a_specs_value
-- ----------------------------
DROP TABLE IF EXISTS `a_specs_value`;
CREATE TABLE `a_specs_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `specs_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `create_time` int(10) NOT NULL,
  `update_time` int(10) NOT NULL,
  `poerate_user` varchar(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态,0禁用，1正常',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of a_specs_value
-- ----------------------------
INSERT INTO `a_specs_value` VALUES ('2', '1', '白色', '1610801403', '1611477795', '', '0');
INSERT INTO `a_specs_value` VALUES ('3', '1', '红色', '1610801424', '1611481220', '', '0');
INSERT INTO `a_specs_value` VALUES ('4', '1', '黑色', '1610801428', '1610801428', '', '1');
INSERT INTO `a_specs_value` VALUES ('5', '1', '蓝色', '1610801434', '1611415275', '', '0');
INSERT INTO `a_specs_value` VALUES ('6', '5', '小号', '1610801484', '1610801484', '', '1');
INSERT INTO `a_specs_value` VALUES ('7', '5', '中号', '1610801492', '1610801492', '', '1');
INSERT INTO `a_specs_value` VALUES ('8', '5', '大号', '1610801498', '1610801498', '', '1');
INSERT INTO `a_specs_value` VALUES ('9', '1', '紫色', '1610803803', '1611415257', '', '0');
INSERT INTO `a_specs_value` VALUES ('15', '1', '1', '1611415292', '1611415408', '', '0');
INSERT INTO `a_specs_value` VALUES ('16', '1', '2', '1611415298', '1611415323', '', '0');
INSERT INTO `a_specs_value` VALUES ('17', '1', '4', '1611415300', '1611415396', '', '0');
INSERT INTO `a_specs_value` VALUES ('18', '1', '1', '1611415473', '1611415481', '', '0');
INSERT INTO `a_specs_value` VALUES ('19', '1', '2', '1611415493', '1611415496', '', '0');
INSERT INTO `a_specs_value` VALUES ('20', '2', 'x', '1611415514', '1611415514', '', '1');
INSERT INTO `a_specs_value` VALUES ('21', '2', 'xx', '1611415522', '1611415522', '', '1');
INSERT INTO `a_specs_value` VALUES ('22', '2', 'xxx', '1611415526', '1611415526', '', '1');
INSERT INTO `a_specs_value` VALUES ('23', '3', '8G', '1611415537', '1611415537', '', '1');
INSERT INTO `a_specs_value` VALUES ('24', '3', '16G', '1611415541', '1611415541', '', '1');
INSERT INTO `a_specs_value` VALUES ('25', '3', '32G', '1611415544', '1611415544', '', '1');
INSERT INTO `a_specs_value` VALUES ('26', '3', '64G', '1611415547', '1611415547', '', '1');
INSERT INTO `a_specs_value` VALUES ('27', '3', '128G', '1611415550', '1611415550', '', '1');
INSERT INTO `a_specs_value` VALUES ('28', '4', '小寸', '1611415572', '1611415572', '', '1');
INSERT INTO `a_specs_value` VALUES ('29', '4', '大寸', '1611415576', '1611415576', '', '1');
INSERT INTO `a_specs_value` VALUES ('30', '4', '中大寸', '1611415580', '1611415580', '', '1');
INSERT INTO `a_specs_value` VALUES ('31', '1', '白色', '1611481227', '1611481227', '', '1');
INSERT INTO `a_specs_value` VALUES ('32', '1', '红色', '1611481231', '1611481231', '', '1');
INSERT INTO `a_specs_value` VALUES ('33', '1', '紫色', '1611481243', '1611481243', '', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of a_user
-- ----------------------------
INSERT INTO `a_user` VALUES ('16', 'Abner-18801253542', '', '', '18801253542', '0', '0', '0', '1610028750', '1610168273', '1', '');
