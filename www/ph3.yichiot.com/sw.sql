/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : sw

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-01-16 18:10:25
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sw_ layer
-- ----------------------------
DROP TABLE IF EXISTS `sw_ layer`;
CREATE TABLE `sw_ layer` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `layer` varchar(100) NOT NULL COMMENT '层 ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sw_ layer
-- ----------------------------
INSERT INTO `sw_ layer` VALUES ('1', '1');

-- ----------------------------
-- Table structure for sw_admin
-- ----------------------------
DROP TABLE IF EXISTS `sw_admin`;
CREATE TABLE `sw_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '管理员ID',
  `username` varchar(100) NOT NULL COMMENT '管理员账号',
  `password` varchar(100) NOT NULL COMMENT '管理员密码',
  `time` int(11) unsigned NOT NULL COMMENT '添加时间',
  `phone` varchar(100) NOT NULL COMMENT '电话',
  `status` int(1) NOT NULL COMMENT '状态：0可用，1禁用',
  `identity` int(1) NOT NULL DEFAULT '1' COMMENT '身份证明',
  `mail` varchar(255) DEFAULT NULL,
  `custom` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sw_admin
-- ----------------------------
INSERT INTO `sw_admin` VALUES ('3', 'admin', 'admin', '0', '18888887777', '1', '1', null, null);
INSERT INTO `sw_admin` VALUES ('4', 'zhaozilong', '60c23700993d48a5ecc93eecf68b6057', '0', '1666888888', '1', '1', null, null);

-- ----------------------------
-- Table structure for sw_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `sw_auth_group`;
CREATE TABLE `sw_auth_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` text COMMENT '规则id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='用户组表';

-- ----------------------------
-- Records of sw_auth_group
-- ----------------------------
INSERT INTO `sw_auth_group` VALUES ('1', '系统管理员', '1', '1,14,143,144,6,2,3,15,16,17,18,4,20,21,7,8,10,19,150,152,147,155,156,148,157,158,159');
INSERT INTO `sw_auth_group` VALUES ('2', '客户', '1', '1,14,143,144,6,2,3,15,16,17,18,4,20,21,10,19,152,154,147,155,153');
INSERT INTO `sw_auth_group` VALUES ('3', '维护工', '1', '1,14,143,144,154,147');

-- ----------------------------
-- Table structure for sw_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `sw_auth_group_access`;
CREATE TABLE `sw_auth_group_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `group_id` int(11) unsigned NOT NULL COMMENT '用户组id',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COMMENT='用户组明细表';

-- ----------------------------
-- Records of sw_auth_group_access
-- ----------------------------
INSERT INTO `sw_auth_group_access` VALUES ('1', '3', '1');
INSERT INTO `sw_auth_group_access` VALUES ('2', '4', '1');
INSERT INTO `sw_auth_group_access` VALUES ('3', '88', '1');
INSERT INTO `sw_auth_group_access` VALUES ('4', '500000', '2');
INSERT INTO `sw_auth_group_access` VALUES ('5', '500001', '2');
INSERT INTO `sw_auth_group_access` VALUES ('6', '1000000', '3');
INSERT INTO `sw_auth_group_access` VALUES ('7', '1000001', '3');
INSERT INTO `sw_auth_group_access` VALUES ('8', '1000002', '3');
INSERT INTO `sw_auth_group_access` VALUES ('9', '1000003', '3');
INSERT INTO `sw_auth_group_access` VALUES ('10', '1000004', '3');
INSERT INTO `sw_auth_group_access` VALUES ('11', '1000005', '3');
INSERT INTO `sw_auth_group_access` VALUES ('12', '1000006', '3');
INSERT INTO `sw_auth_group_access` VALUES ('13', '1000007', '3');
INSERT INTO `sw_auth_group_access` VALUES ('14', '1000008', '3');
INSERT INTO `sw_auth_group_access` VALUES ('15', '500002', '2');
INSERT INTO `sw_auth_group_access` VALUES ('16', '1000012', '3');
INSERT INTO `sw_auth_group_access` VALUES ('17', '500003', '2');
INSERT INTO `sw_auth_group_access` VALUES ('18', '500005', '2');
INSERT INTO `sw_auth_group_access` VALUES ('19', '500013', '2');
INSERT INTO `sw_auth_group_access` VALUES ('20', '1000013', '3');
INSERT INTO `sw_auth_group_access` VALUES ('21', '1000016', '3');
INSERT INTO `sw_auth_group_access` VALUES ('22', '1000017', '3');

-- ----------------------------
-- Table structure for sw_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `sw_auth_rule`;
CREATE TABLE `sw_auth_rule` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父级id',
  `name` char(80) NOT NULL DEFAULT '' COMMENT '规则唯一标识',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '规则中文名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：为1正常，为0禁用',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '' COMMENT '规则表达式，为空表示存在就验证，不为空表示按照条件验证',
  `state` int(1) NOT NULL DEFAULT '0' COMMENT '导航是否显示：0显示，1隐藏',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=160 DEFAULT CHARSET=utf8 COMMENT='规则表';

-- ----------------------------
-- Records of sw_auth_rule
-- ----------------------------
INSERT INTO `sw_auth_rule` VALUES ('1', '0', 'Admin/Index/index', '控制台', '1', '1', '', '0');
INSERT INTO `sw_auth_rule` VALUES ('2', '6', 'Admin/Rule/rule_list', '权限管理', '1', '1', '', '0');
INSERT INTO `sw_auth_rule` VALUES ('3', '6', 'Admin/Rule/rule_group', '角色管理', '1', '1', '', '0');
INSERT INTO `sw_auth_rule` VALUES ('4', '6', 'Admin/User/index', '用户管理', '1', '1', '', '0');
INSERT INTO `sw_auth_rule` VALUES ('6', '0', 'Admin/Rule/', '权限控制台', '1', '1', '', '0');
INSERT INTO `sw_auth_rule` VALUES ('7', '6', 'Admin/Rule/add', '添加权限', '1', '1', '', '1');
INSERT INTO `sw_auth_rule` VALUES ('8', '6', 'Admin/Rule/edit', '修改权限', '1', '1', '', '1');
INSERT INTO `sw_auth_rule` VALUES ('10', '6', 'Admin/ShowNav/posts', '退出登录', '1', '1', '', '0');
INSERT INTO `sw_auth_rule` VALUES ('14', '1', 'index/index', '测试权限', '1', '1', '', '0');
INSERT INTO `sw_auth_rule` VALUES ('15', '3', 'Admin/Rule/rule_distribution', '角色分配权限', '1', '1', '', '0');
INSERT INTO `sw_auth_rule` VALUES ('16', '3', 'Admin/Rule/add_group', '添加角色', '1', '1', '', '0');
INSERT INTO `sw_auth_rule` VALUES ('17', '3', 'Admin/Rule/edit_group', '修改角色', '1', '1', '', '0');
INSERT INTO `sw_auth_rule` VALUES ('18', '3', 'Admin/Rule/delete_group', '删除角色', '1', '1', '', '0');
INSERT INTO `sw_auth_rule` VALUES ('19', '10', 'Admin/Index/logout', '退出登录', '1', '1', '', '0');
INSERT INTO `sw_auth_rule` VALUES ('20', '4', 'Admin/User/add_user', '添加用户（管理员）', '1', '1', '', '0');
INSERT INTO `sw_auth_rule` VALUES ('21', '4', 'Admin/User/edit_user', '修改用户', '1', '1', '', '0');
INSERT INTO `sw_auth_rule` VALUES ('143', '1', 'Admin/User/my_center', '个人中心', '1', '1', '', '0');
INSERT INTO `sw_auth_rule` VALUES ('144', '143', 'Admin/User/change_msg', '修改个人资料', '1', '1', '', '0');
INSERT INTO `sw_auth_rule` VALUES ('147', '0', 'Admin/Equipment/index', '设备列表', '1', '1', '', '0');
INSERT INTO `sw_auth_rule` VALUES ('148', '0', 'Admin/Company/index', '系统管理', '1', '1', '', '0');
INSERT INTO `sw_auth_rule` VALUES ('150', '6', 'Admin/Rule/delete', '删除权限', '1', '1', '', '1');
INSERT INTO `sw_auth_rule` VALUES ('152', '6', 'Admin/Company/login', '返回管理账户', '1', '1', '', '1');
INSERT INTO `sw_auth_rule` VALUES ('153', '0', 'Admin/Swuser/index', '用户管理', '1', '1', '', '0');
INSERT INTO `sw_auth_rule` VALUES ('154', '6', 'Admin/Swuser/login', '返回客户账户', '1', '1', '', '1');
INSERT INTO `sw_auth_rule` VALUES ('155', '147', 'Admin/Equipment/dataadd', '添加设备', '1', '1', '', '1');
INSERT INTO `sw_auth_rule` VALUES ('156', '147', 'Admin/Equipment/ajax', '设备列表', '1', '1', '', '1');
INSERT INTO `sw_auth_rule` VALUES ('157', '0', 'Admin/Cycle/add', 'POST', '1', '1', '', '0');
INSERT INTO `sw_auth_rule` VALUES ('158', '0', 'Admin/Cycle/updateDevice', '接口', '1', '1', '', '0');
INSERT INTO `sw_auth_rule` VALUES ('159', '0', 'Admin/Cycle/index', '数据展示', '1', '1', '', '0');

-- ----------------------------
-- Table structure for sw_category
-- ----------------------------
DROP TABLE IF EXISTS `sw_category`;
CREATE TABLE `sw_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(100) NOT NULL COMMENT '栏目标题',
  `identity` int(1) NOT NULL DEFAULT '0' COMMENT '0可显示，1管理员禁用，2客户禁用，3用禁用',
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sw_category
-- ----------------------------
INSERT INTO `sw_category` VALUES ('1', '设备列表', '0', 'Index/index');
INSERT INTO `sw_category` VALUES ('2', '地图地理', '3', 'Indexaaaa/index');

-- ----------------------------
-- Table structure for sw_company
-- ----------------------------
DROP TABLE IF EXISTS `sw_company`;
CREATE TABLE `sw_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '代理商ID',
  `username` varchar(100) NOT NULL COMMENT '代理商账号',
  `password` varchar(100) NOT NULL COMMENT '代理商密码',
  `examine` int(1) NOT NULL DEFAULT '0' COMMENT '代理商审核:0未审核，1已审核',
  `time` int(11) unsigned NOT NULL COMMENT '添加代理商时间',
  `position` varchar(255) NOT NULL COMMENT '地址',
  `phone` varchar(100) NOT NULL COMMENT '电话',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '状态：0可用，1禁用',
  `identity` int(1) NOT NULL DEFAULT '2' COMMENT '商家身份认证2',
  `mail` varchar(255) DEFAULT NULL,
  `custom` varchar(255) DEFAULT NULL,
  `device_topnum` int(11) DEFAULT '0',
  `user_topnum` int(11) DEFAULT '0',
  `user_year_topnum` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=500014 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sw_company
-- ----------------------------
INSERT INTO `sw_company` VALUES ('500000', 'company', 'company', '0', '0', '', '15210034978', '0', '2', '1123@qq.com', 'sss', null, null, null);
INSERT INTO `sw_company` VALUES ('500001', 'caocao', '1abb3521ceb70ef277bec804912287ff', '0', '0', '', '155555555555', '0', '2', null, null, null, null, null);
INSERT INTO `sw_company` VALUES ('500002', 'fgddfgg', '698d51a19d8a121ce581499d7b701668', '0', '0', '', '15210034977', '0', '2', '11@qq.com', 'sss', null, null, null);
INSERT INTO `sw_company` VALUES ('500003', 'fgddfgg33', '698d51a19d8a121ce581499d7b701668', '0', '0', '', '15210034974', '0', '2', '11@qq.com', 'sss', null, null, null);
INSERT INTO `sw_company` VALUES ('500005', 'aaaaaa', '698d51a19d8a121ce581499d7b701668', '0', '0', '', '15535003773', '0', '2', '1111@qq.com', '', null, null, null);
INSERT INTO `sw_company` VALUES ('500013', 'aaaaaaas', '062997f352f6331d086f2d87369b99f7', '0', '0', '', '13131110106', '0', '2', '1123@qq.com', '', null, null, null);

-- ----------------------------
-- Table structure for sw_cycle
-- ----------------------------
DROP TABLE IF EXISTS `sw_cycle`;
CREATE TABLE `sw_cycle` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '采集ID',
  `device_sn` varchar(100) NOT NULL COMMENT '设备编码',
  `concentration` varchar(100) CHARACTER SET latin1 NOT NULL DEFAULT '--' COMMENT '气体浓度',
  `electricity` varchar(100) CHARACTER SET latin1 NOT NULL DEFAULT '--' COMMENT '设备电量',
  `temperature` varchar(100) CHARACTER SET latin1 NOT NULL DEFAULT '--' COMMENT '设备温度',
  `humidity` varchar(100) CHARACTER SET latin1 NOT NULL DEFAULT '--' COMMENT '设备湿度',
  `time` int(11) unsigned NOT NULL COMMENT '采集设备时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sw_cycle
-- ----------------------------
INSERT INTO `sw_cycle` VALUES ('1', '861358037968401', '10', '1', '1', '1', '1514739600');
INSERT INTO `sw_cycle` VALUES ('2', 'B1', '20', '1', '--', '1', '1514754000');
INSERT INTO `sw_cycle` VALUES ('4', 'B1', '30', '100', '--', '100', '1514768400');
INSERT INTO `sw_cycle` VALUES ('5', 'B2', '40', '100', '--', '100', '1514782800');
INSERT INTO `sw_cycle` VALUES ('6', 'B2', '50', '122', '122', '122', '1514797200');
INSERT INTO `sw_cycle` VALUES ('7', 'B2', '60', '80', '70', '70', '1514811600');
INSERT INTO `sw_cycle` VALUES ('9', 'B2', '100', '--', '--', '--', '1514736000');
INSERT INTO `sw_cycle` VALUES ('10', 'B5', '200', '--', '--', '--', '1514750400');
INSERT INTO `sw_cycle` VALUES ('11', 'B5', '300', '--', '--', '--', '1514764800');
INSERT INTO `sw_cycle` VALUES ('12', 'B5', '400', '--', '--', '--', '1514779200');
INSERT INTO `sw_cycle` VALUES ('13', 'B5', '500', '--', '--', '--', '1514793600');
INSERT INTO `sw_cycle` VALUES ('14', 'B5', '600', '--', '--', '--', '1514808000');
INSERT INTO `sw_cycle` VALUES ('15', 'B5', '700', '--', '--', '--', '1514822400');
INSERT INTO `sw_cycle` VALUES ('16', '', '--', '--', '--', '--', '1515398696');
INSERT INTO `sw_cycle` VALUES ('17', 'B2', '23', '--', '--', '--', '1516067083');
INSERT INTO `sw_cycle` VALUES ('18', 'B2', '23', '--', '--', '--', '1516067085');
INSERT INTO `sw_cycle` VALUES ('19', 'B2', '23', '--', '--', '--', '1516067122');

-- ----------------------------
-- Table structure for sw_equipment
-- ----------------------------
DROP TABLE IF EXISTS `sw_equipment`;
CREATE TABLE `sw_equipment` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `company_id` int(11) DEFAULT NULL COMMENT '客户ID',
  `device_sn` varchar(100) NOT NULL COMMENT '设备编码',
  `custom` varchar(100) NOT NULL COMMENT '自定义信息',
  `time` int(10) unsigned NOT NULL COMMENT '添加设备时间',
  `telephone` text NOT NULL COMMENT '设备关联人电话，多以逗号隔开',
  `warehouse_id` int(11) NOT NULL COMMENT '库区ID',
  `floor_id` int(11) NOT NULL COMMENT '楼区ID',
  `layer_id` int(11) NOT NULL COMMENT '层区ID',
  `ph3` int(100) NOT NULL COMMENT 'ph3气体浓度',
  `co` int(100) DEFAULT NULL COMMENT 'co气体浓度',
  `electricity` int(100) NOT NULL COMMENT '设备电量',
  `temperature` int(100) NOT NULL COMMENT '设备温度',
  `humidity` int(100) NOT NULL COMMENT '设备湿度',
  `lamp` int(1) NOT NULL DEFAULT '0' COMMENT '设备呼叫 （灯闪）:0关灯，1开灯',
  `state` int(1) NOT NULL DEFAULT '1' COMMENT '开机状态：0关机，1开机',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`device_sn`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sw_equipment
-- ----------------------------
INSERT INTO `sw_equipment` VALUES ('1', '500001', '861358037968401', 'A1', '1513159133', '1000003,1000005', '0', '0', '0', '10', '20', '20', '30', '40', '0', '1');
INSERT INTO `sw_equipment` VALUES ('2', '500001', 'A2', 'A2', '1513159168', '1000004,1000005,1000006', '0', '0', '0', '11', '22', '21', '31', '41', '0', '1');
INSERT INTO `sw_equipment` VALUES ('3', '500001', 'A3', 'A3', '1513159209', '', '0', '0', '0', '80', '25', '80', '70', '70', '0', '1');
INSERT INTO `sw_equipment` VALUES ('4', '500001', 'A4', 'A4', '1513159227', '1000003,1000004,1000006', '0', '0', '0', '13', '23', '23', '20', '12', '0', '1');
INSERT INTO `sw_equipment` VALUES ('5', '500001', 'A5', 'A5', '1513159252', '', '0', '0', '0', '14', '21', '0', '23', '50', '0', '1');
INSERT INTO `sw_equipment` VALUES ('6', '500001', 'A6', 'A6', '1513159267', '1000003,1000004,1000005,1000006', '0', '0', '0', '29', '22', '0', '34', '30', '0', '1');
INSERT INTO `sw_equipment` VALUES ('7', '500001', 'A7', 'A7', '1513159345', '1000003', '0', '0', '0', '18', '26', '0', '12', '45', '0', '1');
INSERT INTO `sw_equipment` VALUES ('8', '500001', 'A8', 'A8', '1513159381', '1000003,1000004,1000005,1000006', '0', '0', '0', '30', '27', '0', '25', '55', '0', '1');
INSERT INTO `sw_equipment` VALUES ('9', '500000', 'B1', 'B1', '1513159630', '1000008', '0', '0', '0', '32', '28', '0', '30', '60', '0', '1');
INSERT INTO `sw_equipment` VALUES ('10', '500000', 'B2', 'B2', '1516067122', '1000007,1000008', '0', '0', '0', '33', '29', '0', '25', '70', '0', '1');
INSERT INTO `sw_equipment` VALUES ('12', '500002', '', '', '1515398696', '', '0', '0', '0', '20', '21', '0', '15', '80', '0', '1');

-- ----------------------------
-- Table structure for sw_floor
-- ----------------------------
DROP TABLE IF EXISTS `sw_floor`;
CREATE TABLE `sw_floor` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '楼ID',
  `floor` varchar(11) NOT NULL COMMENT '楼',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sw_floor
-- ----------------------------
INSERT INTO `sw_floor` VALUES ('1', '1');

-- ----------------------------
-- Table structure for sw_journal
-- ----------------------------
DROP TABLE IF EXISTS `sw_journal`;
CREATE TABLE `sw_journal` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user_id` int(11) NOT NULL COMMENT '维护工ID',
  `company_id` int(11) NOT NULL COMMENT '所属公司ID',
  `content` varchar(255) CHARACTER SET latin1 NOT NULL COMMENT '操作内容',
  `time` int(11) unsigned NOT NULL COMMENT '操作时间',
  `state` int(1) NOT NULL COMMENT '是否操作成功：0失败，1成功',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sw_journal
-- ----------------------------
INSERT INTO `sw_journal` VALUES ('1', '1', '1', '1', '1497427270', '1');

-- ----------------------------
-- Table structure for sw_lose
-- ----------------------------
DROP TABLE IF EXISTS `sw_lose`;
CREATE TABLE `sw_lose` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '失联ID',
  `equipment_id` int(11) NOT NULL COMMENT '设备ID',
  `time` int(11) unsigned NOT NULL COMMENT '失联时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sw_lose
-- ----------------------------
INSERT INTO `sw_lose` VALUES ('1', '1', '1');

-- ----------------------------
-- Table structure for sw_move
-- ----------------------------
DROP TABLE IF EXISTS `sw_move`;
CREATE TABLE `sw_move` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '移机ID',
  `user_id` int(11) NOT NULL COMMENT '维护工ID',
  `once_ warehouse` varchar(100) NOT NULL COMMENT '原始位置',
  `once_ floor` varchar(100) NOT NULL COMMENT '原始楼',
  `once_ layer` varchar(100) NOT NULL COMMENT '原始层',
  `present_ warehouse` varchar(100) NOT NULL COMMENT '移至位置',
  `present_ floor` varchar(100) NOT NULL COMMENT '移至楼',
  `present_ layer` varchar(100) NOT NULL COMMENT '移至层',
  `time` int(11) unsigned NOT NULL COMMENT '移至时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sw_move
-- ----------------------------
INSERT INTO `sw_move` VALUES ('1', '1', '1', '1', '1', '11', '1', '1', '1497427270');

-- ----------------------------
-- Table structure for sw_prompt
-- ----------------------------
DROP TABLE IF EXISTS `sw_prompt`;
CREATE TABLE `sw_prompt` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '报警ID',
  `equipment_id` int(11) NOT NULL COMMENT '设备ID',
  `high_ concentration` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT '最高气体浓度报警值',
  `high_ electricity` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT '最高设备电量报警值',
  `high_ temperature` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT '最高设备温度报警值',
  `high_ humidity` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT '最高设备湿度报警值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sw_prompt
-- ----------------------------
INSERT INTO `sw_prompt` VALUES ('1', '1', '1', '1', '1', '1');

-- ----------------------------
-- Table structure for sw_user
-- ----------------------------
DROP TABLE IF EXISTS `sw_user`;
CREATE TABLE `sw_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '维护工ID',
  `company_id` int(11) NOT NULL COMMENT '所属公司ID ',
  `equipment_id` varchar(255) NOT NULL COMMENT '设备ID ，多个以逗号隔开',
  `username` varchar(255) NOT NULL COMMENT '维护工账号',
  `password` varchar(255) NOT NULL COMMENT '维护工密码',
  `phone` char(11) NOT NULL COMMENT '维护工电话',
  `mail` varchar(255) NOT NULL COMMENT '维护工邮件',
  `time` int(11) unsigned NOT NULL COMMENT '添加时间',
  `identity` int(1) NOT NULL DEFAULT '3' COMMENT '维护工身份认证3',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '状态：0可用，1禁用',
  `custom` varchar(255) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=1000019 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sw_user
-- ----------------------------
INSERT INTO `sw_user` VALUES ('1000006', '500001', '1,2,4,6,8', 'userc', 'cc558eab13f85d21d1f2395bb7799076', '18888888883', '', '0', '3', '0', null);
INSERT INTO `sw_user` VALUES ('1000007', '500000', '10', 'Luser', '1111', '15210039744', '1123@qq.com', '0', '3', '0', 'sf');
INSERT INTO `sw_user` VALUES ('1000008', '500000', '9,10', 'Lusera', '698d51a19d8a121ce581499d7b701668', '15210034977', '', '0', '3', '0', null);
INSERT INTO `sw_user` VALUES ('1000012', '500002', '', 'dsgdf11', '698d51a19d8a121ce581499d7b701668', '15210034979', '112@qq.com', '0', '3', '0', 'sdfs');
INSERT INTO `sw_user` VALUES ('1000013', '0', '', 'df22222', '111', '13131110100', '11@qq.com', '0', '3', '0', 'sss');
INSERT INTO `sw_user` VALUES ('1000016', '0', '', 'dsgdf12', '111', '13131110101', '1123@qq.com', '0', '3', '0', 'sss');
INSERT INTO `sw_user` VALUES ('1000017', '500002', '', 'admin1123', '111', '13131110102', '1123@qq.com', '0', '3', '0', 'sss');

-- ----------------------------
-- Table structure for sw_warehouse
-- ----------------------------
DROP TABLE IF EXISTS `sw_warehouse`;
CREATE TABLE `sw_warehouse` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '库表 ID',
  `name` varchar(100) NOT NULL COMMENT '库区名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sw_warehouse
-- ----------------------------
INSERT INTO `sw_warehouse` VALUES ('1', '1');
