/*
 Navicat Premium Data Transfer

 Source Server         : mysql-local
 Source Server Type    : MySQL
 Source Server Version : 50723
 Source Host           : localhost:3306
 Source Schema         : yii-demo

 Target Server Type    : MySQL
 Target Server Version : 50723
 File Encoding         : 65001

 Date: 02/08/2018 18:33:13
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for migration
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration`  (
  `version` varchar(180) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `apply_time` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`version`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migration
-- ----------------------------
INSERT INTO `migration` VALUES ('m000000_000000_base', 1533019863);
INSERT INTO `migration` VALUES ('m130524_201442_init', 1533019865);

-- ----------------------------
-- Table structure for resource_list
-- ----------------------------
DROP TABLE IF EXISTS `resource_list`;
CREATE TABLE `resource_list`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `level` int(11) NULL DEFAULT 1,
  `parent_id` int(11) NULL DEFAULT 1,
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ctrl` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `act` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `disabled` int(11) NULL DEFAULT 1,
  `describe` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `is_menu` int(11) NULL DEFAULT 1,
  `create_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of resource_list
-- ----------------------------
INSERT INTO `resource_list` VALUES (6, 1, NULL, 'Dashboard', 'dashboard', '#', 'dashboard', 'index', 1, NULL, 1, '2018-08-02 15:05:46');
INSERT INTO `resource_list` VALUES (7, 1, NULL, '用户管理', 'users', '#', 'user', 'index', 1, NULL, 1, '2018-08-02 15:06:55');
INSERT INTO `resource_list` VALUES (8, 2, 7, '用户列表', 'list', '/user/index', 'user', 'index', 1, NULL, 1, '2018-08-02 15:08:37');
INSERT INTO `resource_list` VALUES (9, 2, 7, '创建用户', 'user-plus', '/user/create', 'user', 'create', 1, NULL, 1, '2018-08-02 15:09:52');
INSERT INTO `resource_list` VALUES (10, 2, 7, '更新用户', 'edit', '/user/update', 'user', 'update', 1, NULL, 0, '2018-08-02 15:11:33');
INSERT INTO `resource_list` VALUES (11, 2, 7, '删除用户', 'user-times', '/user/delete', 'user', 'delete', 1, NULL, 0, '2018-08-02 15:18:48');
INSERT INTO `resource_list` VALUES (12, 2, 6, 'Dashboard', 'dashboard', '/dashboard', 'dashboard', 'index', 1, NULL, 1, '2018-08-02 15:24:29');
INSERT INTO `resource_list` VALUES (13, 1, NULL, '资源管理', 'th-list', '#', 'resource', 'index', 1, NULL, 1, '2018-08-02 15:25:59');
INSERT INTO `resource_list` VALUES (14, 2, 13, '资源列表', 'th-list', '/resource/index', 'resource', 'index', 1, NULL, 1, '2018-08-02 15:26:46');
INSERT INTO `resource_list` VALUES (15, 2, 13, '创建资源', 'window-restore', '/resource/create', 'resource', 'create', 1, NULL, 1, '2018-08-02 15:27:35');
INSERT INTO `resource_list` VALUES (16, 2, 13, '禁用资源', 'window-minimize', '/resource/prohibit-resource', 'resource', 'prohibit-resource', 1, NULL, 0, '2018-08-02 15:34:01');
INSERT INTO `resource_list` VALUES (17, 2, 7, '用户组管理', 'users', '/user/user-group', 'user', 'user-group', 1, '用户组管理', 1, '2018-08-02 17:01:13');
INSERT INTO `resource_list` VALUES (18, 2, 7, '删除用户组', '', '/user/user-group-delete', 'user', 'user-group-delete', 1, '删除用户组', 0, '2018-08-02 18:01:05');
INSERT INTO `resource_list` VALUES (19, 2, 7, '用户分组配置', 'user-circle-o', '/user/user-group-conf', 'user', 'user-group-conf', 1, '用户用户组分配设置', 1, '2018-08-02 18:03:06');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `username`(`username`) USING BTREE,
  UNIQUE INDEX `email`(`email`) USING BTREE,
  UNIQUE INDEX `password_reset_token`(`password_reset_token`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'admin', '10R6Hn-w1WjTEQxruiEB3RRlfmHpaHyt', '$2y$13$wlzPOuibpX3S/nouqxWlY.IquH0Yy9F8x.sJtAXx4AwRSRyLgziYa', NULL, 'admin@163.com', 10, 1533030243, 1533030243);
INSERT INTO `user` VALUES (3, 'demo', 'pOKE_EK5QKQ5XGRjEKZLkCPCSf_0JZS3', '$2y$13$DmjQtLVERYrYdvGjbjJrguiiuVcYIQybHqedzOVf..B.PzhqYAE4e', NULL, 'demo@163.com', 10, 1533030183, 1533030183);

-- ----------------------------
-- Table structure for user_group
-- ----------------------------
DROP TABLE IF EXISTS `user_group`;
CREATE TABLE `user_group`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `describe` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `create_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_group
-- ----------------------------
INSERT INTO `user_group` VALUES (1, '教师', '教师用户组', '2018-08-02 17:39:15');
INSERT INTO `user_group` VALUES (2, '教务', '教务组的点点滴滴', '2018-08-02 17:47:46');

-- ----------------------------
-- Table structure for user_group_res
-- ----------------------------
DROP TABLE IF EXISTS `user_group_res`;
CREATE TABLE `user_group_res`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `res_id` int(11) NOT NULL,
  `user_group_id` int(11) NOT NULL,
  `create_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for user_group_user
-- ----------------------------
DROP TABLE IF EXISTS `user_group_user`;
CREATE TABLE `user_group_user`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_grout_id` int(11) NOT NULL,
  `create_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;