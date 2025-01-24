/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 100427 (10.4.27-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : bell

 Target Server Type    : MySQL
 Target Server Version : 100427 (10.4.27-MariaDB)
 File Encoding         : 65001

 Date: 24/01/2025 19:23:32
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for activity_log
-- ----------------------------
DROP TABLE IF EXISTS `activity_log`;
CREATE TABLE `activity_log`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NULL DEFAULT NULL,
  `activity` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3392 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of activity_log
-- ----------------------------
INSERT INTO `activity_log` VALUES (3249, 1, 'Mengakses halaman user', '2025-01-23 19:58:39');
INSERT INTO `activity_log` VALUES (3250, 1, 'Mengakses form tambah user', '2025-01-23 19:59:04');
INSERT INTO `activity_log` VALUES (3251, 1, 'Menambah data user', '2025-01-23 19:59:17');
INSERT INTO `activity_log` VALUES (3252, 1, 'Mengakses halaman user', '2025-01-23 19:59:22');
INSERT INTO `activity_log` VALUES (3253, 1, 'Mengakses form edit user', '2025-01-23 19:59:45');
INSERT INTO `activity_log` VALUES (3254, 1, 'Mengubah data user', '2025-01-23 19:59:55');
INSERT INTO `activity_log` VALUES (3255, 1, 'Mengakses halaman user', '2025-01-23 20:00:00');
INSERT INTO `activity_log` VALUES (3256, 1, 'Mengakses form undo edit user', '2025-01-23 20:00:18');
INSERT INTO `activity_log` VALUES (3257, 1, 'Mengakses form undo edit user', '2025-01-23 20:00:24');
INSERT INTO `activity_log` VALUES (3258, 1, 'Undo edit data user', '2025-01-23 20:00:30');
INSERT INTO `activity_log` VALUES (3259, 1, 'Mengakses halaman user', '2025-01-23 20:00:36');
INSERT INTO `activity_log` VALUES (3260, 1, 'Mereset password user', '2025-01-23 20:00:46');
INSERT INTO `activity_log` VALUES (3261, 1, 'Mengakses halaman user', '2025-01-23 20:00:51');
INSERT INTO `activity_log` VALUES (3262, 1, 'Menghapus data user', '2025-01-23 20:01:04');
INSERT INTO `activity_log` VALUES (3263, 1, 'Mengakses halaman user', '2025-01-23 20:01:10');
INSERT INTO `activity_log` VALUES (3264, 1, 'Mengakses halaman event', '2025-01-23 20:01:26');
INSERT INTO `activity_log` VALUES (3265, 1, 'Mengakses form tambah event', '2025-01-23 20:01:44');
INSERT INTO `activity_log` VALUES (3266, 1, 'Menambah event', '2025-01-23 20:01:59');
INSERT INTO `activity_log` VALUES (3267, 1, 'Mengakses halaman event', '2025-01-23 20:02:05');
INSERT INTO `activity_log` VALUES (3268, 1, 'Mengakses form edit event', '2025-01-23 20:02:14');
INSERT INTO `activity_log` VALUES (3269, 1, 'Mengubah data event', '2025-01-23 20:02:23');
INSERT INTO `activity_log` VALUES (3270, 1, 'Mengakses halaman event', '2025-01-23 20:02:29');
INSERT INTO `activity_log` VALUES (3271, 1, 'Mengakses form undo edit event', '2025-01-23 20:02:37');
INSERT INTO `activity_log` VALUES (3272, 1, 'Undo edit data event', '2025-01-23 20:02:46');
INSERT INTO `activity_log` VALUES (3273, 1, 'Mengakses halaman event', '2025-01-23 20:02:51');
INSERT INTO `activity_log` VALUES (3274, 1, 'Menghapus data event', '2025-01-23 20:03:00');
INSERT INTO `activity_log` VALUES (3275, 1, 'Mengakses halaman event', '2025-01-23 20:03:06');
INSERT INTO `activity_log` VALUES (3276, 1, 'Mengakses halaman suara', '2025-01-23 20:03:16');
INSERT INTO `activity_log` VALUES (3277, 1, 'Mengakses form tambah suara', '2025-01-23 20:05:08');
INSERT INTO `activity_log` VALUES (3278, 1, 'Menambah data suara', '2025-01-23 20:05:36');
INSERT INTO `activity_log` VALUES (3279, 1, 'Mengakses halaman suara', '2025-01-23 20:05:42');
INSERT INTO `activity_log` VALUES (3280, 1, 'Mengakses form edit suara', '2025-01-23 20:05:54');
INSERT INTO `activity_log` VALUES (3281, 1, 'Mengubah data suara', '2025-01-23 20:06:10');
INSERT INTO `activity_log` VALUES (3282, 1, 'Mengakses halaman suara', '2025-01-23 20:06:16');
INSERT INTO `activity_log` VALUES (3283, 1, 'Mengakses form undo edit suara', '2025-01-23 20:06:26');
INSERT INTO `activity_log` VALUES (3284, 1, 'Undo edit data suara', '2025-01-23 20:06:38');
INSERT INTO `activity_log` VALUES (3285, 1, 'Mengakses halaman suara', '2025-01-23 20:06:44');
INSERT INTO `activity_log` VALUES (3286, 1, 'Menghapus data suara', '2025-01-23 20:06:54');
INSERT INTO `activity_log` VALUES (3287, 1, 'Mengakses halaman suara', '2025-01-23 20:07:00');
INSERT INTO `activity_log` VALUES (3288, 1, 'Mengakses halaman jadwal', '2025-01-23 20:07:44');
INSERT INTO `activity_log` VALUES (3289, 1, 'Mengakses form tambah jadwal', '2025-01-23 20:08:17');
INSERT INTO `activity_log` VALUES (3290, 1, 'Menambah data jadwal', '2025-01-23 20:11:29');
INSERT INTO `activity_log` VALUES (3291, 1, 'Mengakses halaman jadwal', '2025-01-23 20:11:35');
INSERT INTO `activity_log` VALUES (3292, 1, 'Mengakses form edit jadwal', '2025-01-23 20:11:45');
INSERT INTO `activity_log` VALUES (3293, 1, 'Mengubah data jadwal', '2025-01-23 20:11:55');
INSERT INTO `activity_log` VALUES (3294, 1, 'Mengakses halaman jadwal', '2025-01-23 20:12:00');
INSERT INTO `activity_log` VALUES (3295, 1, 'Mengakses form undo edit jadwal', '2025-01-23 20:12:10');
INSERT INTO `activity_log` VALUES (3296, 1, 'Undo edit data jadwal', '2025-01-23 20:12:19');
INSERT INTO `activity_log` VALUES (3297, 1, 'Mengakses halaman jadwal', '2025-01-23 20:12:24');
INSERT INTO `activity_log` VALUES (3298, 1, 'Menghapus data jadwal', '2025-01-23 20:13:01');
INSERT INTO `activity_log` VALUES (3299, 1, 'Mengakses halaman jadwal', '2025-01-23 20:13:07');
INSERT INTO `activity_log` VALUES (3300, 1, 'Mengakses halaman bell', '2025-01-23 20:13:17');
INSERT INTO `activity_log` VALUES (3301, 1, 'Mengakses halaman bell', '2025-01-23 20:14:02');
INSERT INTO `activity_log` VALUES (3302, 1, 'Mengakses halaman setting', '2025-01-23 20:15:41');
INSERT INTO `activity_log` VALUES (3303, 1, 'Mengakses halaman log aktivitas', '2025-01-23 20:15:49');
INSERT INTO `activity_log` VALUES (3304, 1, 'Mengakses halaman restore user', '2025-01-23 20:16:00');
INSERT INTO `activity_log` VALUES (3305, 1, 'Merestore data user', '2025-01-23 20:16:11');
INSERT INTO `activity_log` VALUES (3306, 1, 'Mengakses halaman restore user', '2025-01-23 20:16:16');
INSERT INTO `activity_log` VALUES (3307, 1, 'Mengakses halaman restore event', '2025-01-23 20:16:25');
INSERT INTO `activity_log` VALUES (3308, 1, 'Merestore data event', '2025-01-23 20:16:36');
INSERT INTO `activity_log` VALUES (3309, 1, 'Mengakses halaman restore event', '2025-01-23 20:16:41');
INSERT INTO `activity_log` VALUES (3310, 1, 'Mengakses halaman restore jadwal', '2025-01-23 20:16:50');
INSERT INTO `activity_log` VALUES (3311, 1, 'Mengakses halaman restore jadwal', '2025-01-23 20:17:39');
INSERT INTO `activity_log` VALUES (3312, 1, 'Merestore data jadwal', '2025-01-23 20:17:50');
INSERT INTO `activity_log` VALUES (3313, 1, 'Mengakses halaman restore jadwal', '2025-01-23 20:17:55');
INSERT INTO `activity_log` VALUES (3314, 1, 'Mengakses halaman restore suara', '2025-01-23 20:20:10');
INSERT INTO `activity_log` VALUES (3315, 1, 'Merestore data suara', '2025-01-23 20:20:24');
INSERT INTO `activity_log` VALUES (3316, 1, 'Mengakses halaman restore suara', '2025-01-23 20:20:29');
INSERT INTO `activity_log` VALUES (3317, 1, 'Mengakses halaman bell', '2025-01-23 20:21:05');
INSERT INTO `activity_log` VALUES (3318, 1, 'Mengakses halaman bell', '2025-01-23 20:21:29');
INSERT INTO `activity_log` VALUES (3319, 1, 'Mengakses halaman bell', '2025-01-23 20:23:17');
INSERT INTO `activity_log` VALUES (3320, 1, 'Mengakses halaman bell', '2025-01-23 20:23:30');
INSERT INTO `activity_log` VALUES (3321, 1, 'Mengakses halaman bell', '2025-01-23 20:24:21');
INSERT INTO `activity_log` VALUES (3322, 1, 'Mengakses halaman bell', '2025-01-23 20:25:13');
INSERT INTO `activity_log` VALUES (3323, 1, 'Mengakses halaman dashboard', '2025-01-23 20:26:53');
INSERT INTO `activity_log` VALUES (3324, 1, 'Mengakses halaman jadwal', '2025-01-23 20:45:41');
INSERT INTO `activity_log` VALUES (3325, 1, 'Mengakses halaman jadwal', '2025-01-23 20:49:48');
INSERT INTO `activity_log` VALUES (3326, 1, 'Mengakses halaman bell', '2025-01-23 20:50:01');
INSERT INTO `activity_log` VALUES (3327, 1, 'Mengakses halaman bell', '2025-01-23 20:51:11');
INSERT INTO `activity_log` VALUES (3328, 1, 'Mengakses halaman bell', '2025-01-23 20:51:21');
INSERT INTO `activity_log` VALUES (3329, 1, 'Mengakses halaman bell', '2025-01-23 21:02:23');
INSERT INTO `activity_log` VALUES (3330, 1, 'Mengakses halaman bell', '2025-01-23 21:04:48');
INSERT INTO `activity_log` VALUES (3331, 1, 'Mengakses halaman bell', '2025-01-23 21:07:04');
INSERT INTO `activity_log` VALUES (3332, 1, 'Mengakses halaman bell', '2025-01-23 21:07:18');
INSERT INTO `activity_log` VALUES (3333, 1, 'Mengakses halaman bell', '2025-01-23 21:10:05');
INSERT INTO `activity_log` VALUES (3334, 1, 'Mengakses halaman bell', '2025-01-23 21:12:32');
INSERT INTO `activity_log` VALUES (3335, 1, 'Mengakses halaman bell', '2025-01-23 21:12:45');
INSERT INTO `activity_log` VALUES (3336, 1, 'Mengakses halaman bell', '2025-01-23 21:13:17');
INSERT INTO `activity_log` VALUES (3337, 1, 'Mengakses halaman bell', '2025-01-23 21:15:50');
INSERT INTO `activity_log` VALUES (3338, 1, 'Mengakses halaman bell', '2025-01-23 21:16:32');
INSERT INTO `activity_log` VALUES (3339, 1, 'Mengakses halaman bell', '2025-01-24 09:59:48');
INSERT INTO `activity_log` VALUES (3340, 1, 'Mengakses halaman dashboard', '2025-01-24 18:52:03');
INSERT INTO `activity_log` VALUES (3341, 1, 'Mengakses halaman dashboard', '2025-01-24 18:54:26');
INSERT INTO `activity_log` VALUES (3342, 1, 'Mengakses halaman profile', '2025-01-24 18:54:48');
INSERT INTO `activity_log` VALUES (3343, 1, 'Mengakses halaman dashboard', '2025-01-24 18:57:33');
INSERT INTO `activity_log` VALUES (3344, 1, 'Mengakses halaman dashboard', '2025-01-24 19:00:11');
INSERT INTO `activity_log` VALUES (3345, 1, 'Mengakses halaman profile', '2025-01-24 19:00:28');
INSERT INTO `activity_log` VALUES (3346, 1, 'Mengakses halaman user', '2025-01-24 19:00:57');
INSERT INTO `activity_log` VALUES (3347, 1, 'Mengakses form tambah user', '2025-01-24 19:01:08');
INSERT INTO `activity_log` VALUES (3348, 1, 'Mengakses halaman user', '2025-01-24 19:01:21');
INSERT INTO `activity_log` VALUES (3349, 1, 'Mengakses form edit user', '2025-01-24 19:01:42');
INSERT INTO `activity_log` VALUES (3350, 1, 'Mengubah data user', '2025-01-24 19:01:53');
INSERT INTO `activity_log` VALUES (3351, 1, 'Mengubah data user', '2025-01-24 19:03:38');
INSERT INTO `activity_log` VALUES (3352, 1, 'Mengubah data user', '2025-01-24 19:06:00');
INSERT INTO `activity_log` VALUES (3353, 1, 'Mengakses halaman user', '2025-01-24 19:06:09');
INSERT INTO `activity_log` VALUES (3354, 1, 'Mengakses form undo edit user', '2025-01-24 19:06:44');
INSERT INTO `activity_log` VALUES (3355, 1, 'Undo edit data user', '2025-01-24 19:06:53');
INSERT INTO `activity_log` VALUES (3356, 1, 'Mengakses halaman user', '2025-01-24 19:07:00');
INSERT INTO `activity_log` VALUES (3357, 1, 'Mengakses halaman dashboard', '2025-01-24 19:09:27');
INSERT INTO `activity_log` VALUES (3358, 1, 'Mengakses halaman profile', '2025-01-24 19:09:49');
INSERT INTO `activity_log` VALUES (3359, 1, 'Mengakses halaman user', '2025-01-24 19:10:12');
INSERT INTO `activity_log` VALUES (3360, 1, 'Mengakses form tambah user', '2025-01-24 19:10:23');
INSERT INTO `activity_log` VALUES (3361, 1, 'Mengakses halaman user', '2025-01-24 19:10:36');
INSERT INTO `activity_log` VALUES (3362, 1, 'Mengakses form edit user', '2025-01-24 19:10:59');
INSERT INTO `activity_log` VALUES (3363, 1, 'Mengubah data user', '2025-01-24 19:11:09');
INSERT INTO `activity_log` VALUES (3364, 1, 'Mengakses halaman user', '2025-01-24 19:11:16');
INSERT INTO `activity_log` VALUES (3365, 1, 'Mengakses form undo edit user', '2025-01-24 19:11:28');
INSERT INTO `activity_log` VALUES (3366, 1, 'Undo edit data user', '2025-01-24 19:11:38');
INSERT INTO `activity_log` VALUES (3367, 1, 'Mengakses halaman user', '2025-01-24 19:11:44');
INSERT INTO `activity_log` VALUES (3368, 1, 'Mengakses halaman event', '2025-01-24 19:12:12');
INSERT INTO `activity_log` VALUES (3369, 1, 'Mengakses form tambah event', '2025-01-24 19:12:36');
INSERT INTO `activity_log` VALUES (3370, 1, 'Mengakses halaman event', '2025-01-24 19:12:48');
INSERT INTO `activity_log` VALUES (3371, 1, 'Mengakses halaman jadwal', '2025-01-24 19:13:08');
INSERT INTO `activity_log` VALUES (3372, 1, 'Mengakses form tambah jadwal', '2025-01-24 19:13:29');
INSERT INTO `activity_log` VALUES (3373, 1, 'Mengakses halaman jadwal', '2025-01-24 19:13:54');
INSERT INTO `activity_log` VALUES (3374, 1, 'Mengakses halaman suara', '2025-01-24 19:14:13');
INSERT INTO `activity_log` VALUES (3375, 1, 'Mengakses form tambah suara', '2025-01-24 19:14:23');
INSERT INTO `activity_log` VALUES (3376, 1, 'Mengakses halaman suara', '2025-01-24 19:14:38');
INSERT INTO `activity_log` VALUES (3377, 1, 'Mengakses halaman bell', '2025-01-24 19:15:05');
INSERT INTO `activity_log` VALUES (3378, 1, 'Mengakses halaman jadwal', '2025-01-24 19:16:34');
INSERT INTO `activity_log` VALUES (3379, 1, 'Mengakses form tambah jadwal', '2025-01-24 19:16:43');
INSERT INTO `activity_log` VALUES (3380, 1, 'Menambah data jadwal', '2025-01-24 19:17:20');
INSERT INTO `activity_log` VALUES (3381, 1, 'Mengakses halaman jadwal', '2025-01-24 19:17:26');
INSERT INTO `activity_log` VALUES (3382, 1, 'Mengakses halaman bell', '2025-01-24 19:17:39');
INSERT INTO `activity_log` VALUES (3383, 1, 'Mengakses halaman bell', '2025-01-24 19:18:20');
INSERT INTO `activity_log` VALUES (3384, 1, 'Mengakses halaman setting', '2025-01-24 19:20:23');
INSERT INTO `activity_log` VALUES (3385, 1, 'Mengakses halaman log aktivitas', '2025-01-24 19:20:44');
INSERT INTO `activity_log` VALUES (3386, 1, 'Mengakses halaman jadwal', '2025-01-24 19:21:15');
INSERT INTO `activity_log` VALUES (3387, 1, 'Menghapus data jadwal', '2025-01-24 19:21:27');
INSERT INTO `activity_log` VALUES (3388, 1, 'Mengakses halaman jadwal', '2025-01-24 19:21:34');
INSERT INTO `activity_log` VALUES (3389, 1, 'Mengakses halaman restore jadwal', '2025-01-24 19:21:45');
INSERT INTO `activity_log` VALUES (3390, 1, 'Merestore data jadwal', '2025-01-24 19:22:00');
INSERT INTO `activity_log` VALUES (3391, 1, 'Mengakses halaman restore jadwal', '2025-01-24 19:22:07');

-- ----------------------------
-- Table structure for backup_event
-- ----------------------------
DROP TABLE IF EXISTS `backup_event`;
CREATE TABLE `backup_event`  (
  `id_event` int NOT NULL AUTO_INCREMENT,
  `deskripsi_event` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `isdelete` int NOT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `deleted_by` int NULL DEFAULT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id_event`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of backup_event
-- ----------------------------

-- ----------------------------
-- Table structure for backup_jadwal
-- ----------------------------
DROP TABLE IF EXISTS `backup_jadwal`;
CREATE TABLE `backup_jadwal`  (
  `id_jadwal` int NOT NULL AUTO_INCREMENT,
  `id_suara` int NULL DEFAULT NULL,
  `id_event` int NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `hari` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `waktu` time NULL DEFAULT NULL,
  `isdelete` int NOT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `deleted_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_jadwal`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of backup_jadwal
-- ----------------------------

-- ----------------------------
-- Table structure for backup_suara
-- ----------------------------
DROP TABLE IF EXISTS `backup_suara`;
CREATE TABLE `backup_suara`  (
  `id_suara` int NOT NULL AUTO_INCREMENT,
  `keterangan_suara` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `file` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `isdelete` int NULL DEFAULT 0,
  `created_by` int NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_by` int NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_suara`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of backup_suara
-- ----------------------------

-- ----------------------------
-- Table structure for backup_user
-- ----------------------------
DROP TABLE IF EXISTS `backup_user`;
CREATE TABLE `backup_user`  (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `level` int NULL DEFAULT NULL,
  `isdelete` int NOT NULL,
  `created_by` int NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_by` int NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 37 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of backup_user
-- ----------------------------

-- ----------------------------
-- Table structure for event
-- ----------------------------
DROP TABLE IF EXISTS `event`;
CREATE TABLE `event`  (
  `id_event` int NOT NULL AUTO_INCREMENT,
  `deskripsi_event` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `isdelete` int NOT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `deleted_by` int NULL DEFAULT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id_event`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of event
-- ----------------------------
INSERT INTO `event` VALUES (1, 'Harian', 0, NULL, NULL, NULL, NULL, NULL, NULL, 0);
INSERT INTO `event` VALUES (2, 'P5', 0, NULL, NULL, NULL, NULL, NULL, NULL, 0);

-- ----------------------------
-- Table structure for jadwal
-- ----------------------------
DROP TABLE IF EXISTS `jadwal`;
CREATE TABLE `jadwal`  (
  `id_jadwal` int NOT NULL AUTO_INCREMENT,
  `id_suara` int NULL DEFAULT NULL,
  `id_event` int NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `hari` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `waktu` time NULL DEFAULT NULL,
  `isdelete` int NOT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `deleted_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_jadwal`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 90 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of jadwal
-- ----------------------------
INSERT INTO `jadwal` VALUES (7, 6, 1, 'Masuk Kelas', 'Senin', '07:15:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (8, 1, 1, 'Pelajaran Ke 1', 'Senin', '07:30:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (9, 2, 1, 'Pelajaran Ke 2', 'Senin', '08:50:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (10, 7, 1, 'Istirahat Pertama', 'Senin', '10:10:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (11, 3, 1, 'Pelajaran Ke 3', 'Senin', '10:40:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (12, 9, 1, 'Istirahat Kedua', 'Senin', '12:00:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (13, 4, 1, 'Pelajaran Ke 4', 'Senin', '12:30:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (14, 5, 1, 'Pelajaran Ke 5', 'Senin', '13:50:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (15, 11, 1, 'Pulang', 'Senin', '15:10:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (16, 6, 1, 'Masuk Kelas', 'Selasa', '07:15:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (17, 1, 1, 'Pelajaran Ke 1', 'Selasa', '07:30:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (18, 2, 1, 'Pelajaran Ke 2', 'Selasa', '08:50:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (19, 7, 1, 'Istirahat Pertama', 'Selasa', '10:10:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (20, 3, 1, 'Pelajaran Ke 3', 'Selasa', '10:40:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (21, 9, 1, 'Istirahat Kedua', 'Selasa', '12:00:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (22, 4, 1, 'Pelajaran Ke 4', 'Selasa', '12:30:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (23, 5, 1, 'Pelajaran Ke 5', 'Selasa', '13:50:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (24, 11, 1, 'Pulang', 'Selasa', '15:10:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (25, 6, 1, 'Masuk Kelas', 'Rabu', '07:15:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (26, 1, 1, 'Pelajaran Ke 1', 'Rabu', '07:30:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (27, 2, 1, 'Pelajaran Ke 2', 'Rabu', '08:50:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (28, 7, 1, 'Istirahat Pertama', 'Rabu', '10:10:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (29, 3, 1, 'Pelajaran Ke 3', 'Rabu', '10:40:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (30, 9, 1, 'Istirahat Kedua', 'Rabu', '12:00:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (31, 4, 1, 'Pelajaran Ke 4', 'Rabu', '12:30:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (32, 5, 1, 'Pelajaran Ke 5', 'Rabu', '13:50:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (33, 11, 1, 'Pulang', 'Rabu', '15:10:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (34, 6, 1, 'Masuk Kelas', 'Kamis', '07:15:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (35, 1, 1, 'Pelajaran Ke 1', 'Kamis', '07:30:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (36, 2, 1, 'Pelajaran Ke 2', 'Kamis', '08:50:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (37, 7, 1, 'Istirahat Pertama', 'Kamis', '10:10:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (38, 3, 1, 'Pelajaran Ke 3', 'Kamis', '10:40:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (39, 9, 1, 'Istirahat Kedua', 'Kamis', '12:00:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (40, 4, 1, 'Pelajaran Ke 4', 'Kamis', '12:30:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (41, 5, 1, 'Pelajaran Ke 5', 'Kamis', '13:50:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (42, 11, 1, 'Pulang', 'Kamis', '15:10:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (43, 6, 1, 'Masuk Kelas', 'Jumat', '07:15:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (44, 7, 1, 'Istirahat', 'Jumat', '09:30:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (45, 11, 1, 'Pulang', 'Jumat', '12:00:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (46, 6, 2, 'Masuk Kelas', 'Senin', '07:15:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (47, 1, 2, 'Pelajaran Ke 1', 'Senin', '07:30:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (48, 2, 2, 'Pelajaran Ke 2', 'Senin', '08:50:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (49, 7, 2, 'Istirahat Pertama', 'Senin', '10:10:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (50, 3, 2, 'Pelajaran Ke 3', 'Senin', '10:40:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (51, 9, 2, 'Istirahat Kedua', 'Senin', '12:00:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (52, 4, 2, 'Pelajaran Ke 4', 'Senin', '12:30:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (53, 5, 2, 'Pelajaran Ke 5', 'Senin', '13:50:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (54, 11, 2, 'Pulang', 'Senin', '15:10:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (55, 6, 2, 'Masuk Kelas', 'Selasa', '07:15:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (56, 1, 2, 'Pelajaran Ke 1', 'Selasa', '07:30:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (57, 2, 2, 'Pelajaran Ke 2', 'Selasa', '08:50:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (58, 7, 2, 'Istirahat Pertama', 'Selasa', '10:10:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (59, 3, 2, 'Pelajaran Ke 3', 'Selasa', '10:40:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (60, 9, 2, 'Istirahat Kedua', 'Selasa', '12:00:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (61, 4, 2, 'Pelajaran Ke 4', 'Selasa', '12:30:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (62, 5, 2, 'Pelajaran Ke 5', 'Selasa', '13:50:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (63, 11, 2, 'Pulang', 'Selasa', '15:10:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (64, 6, 2, 'Masuk Kelas', 'Rabu', '07:15:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (65, 1, 2, 'Pelajaran Ke 1', 'Rabu', '07:30:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (66, 2, 2, 'Pelajaran Ke 2', 'Rabu', '08:18:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (67, 7, 2, 'Istirahat Pertama', 'Rabu', '09:06:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (68, 3, 2, 'Pelajaran Ke 3', 'Rabu', '09:36:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (69, 4, 2, 'Pelajaran Ke 4', 'Rabu', '10:24:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (70, 5, 2, 'Pelajaran Ke 5', 'Rabu', '11:12:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (71, 9, 2, 'Istirahat Kedua', 'Rabu', '12:00:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (72, 12, 2, 'Pemadatan P5', 'Rabu', '12:30:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (73, 11, 2, 'Pulang', 'Rabu', '15:10:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (74, 6, 2, 'Masuk Kelas', 'Kamis', '07:15:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (75, 1, 2, 'Pelajaran Ke 1', 'Kamis', '07:30:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (76, 2, 2, 'Pelajaran Ke 2', 'Kamis', '08:18:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (77, 7, 2, 'Istirahat Pertama', 'Kamis', '09:06:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (78, 3, 2, 'Pelajaran Ke 3', 'Kamis', '09:36:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (79, 4, 2, 'Pelajaran Ke 4', 'Kamis', '10:24:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (80, 5, 2, 'Pelajaran Ke 5', 'Kamis', '11:12:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (81, 9, 2, 'Istirahat Kedua', 'Kamis', '12:00:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (82, 12, 2, 'Pemadatan P5', 'Kamis', '12:30:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (83, 11, 2, 'Pulang', 'Kamis', '15:10:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (84, 6, 2, 'Masuk Kelas', 'Jumat', '07:15:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (85, 7, 2, 'Istirahat', 'Jumat', '09:30:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jadwal` VALUES (86, 11, 2, 'Pulang', 'Jumat', '12:00:00', 0, NULL, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for setting
-- ----------------------------
DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting`  (
  `id_setting` int NOT NULL AUTO_INCREMENT,
  `nama_setting` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `logo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama_sekolah` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `nohp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_setting`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of setting
-- ----------------------------
INSERT INTO `setting` VALUES (1, 'Bell SPH', 'bell.png', 'Komp.Batu Batam Mas, Jl. Gajah Mada Blok D & E No.1,2,3, Baloi Indah, Kec. Lubuk Baja, Kota Batam, Kepulauan Riau 29444', 'SEKOLAH PERMATA HARAPAN', '(0778) 431318', 1, '2025-01-23 19:57:44');

-- ----------------------------
-- Table structure for suara
-- ----------------------------
DROP TABLE IF EXISTS `suara`;
CREATE TABLE `suara`  (
  `id_suara` int NOT NULL AUTO_INCREMENT,
  `keterangan_suara` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `file` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `isdelete` int NULL DEFAULT 0,
  `created_by` int NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_by` int NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_suara`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of suara
-- ----------------------------
INSERT INTO `suara` VALUES (1, 'Pelajaran Ke 1', 'Pelajaran ke 1.mp3', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `suara` VALUES (2, 'Pelajaran Ke 2', 'Pelajaran ke 2.mp3', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `suara` VALUES (3, 'Pelajaran Ke 3', 'Pelajaran ke 3.mp3', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `suara` VALUES (4, 'Pelajaran Ke 4', 'Pelajaran ke 4.mp3', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `suara` VALUES (5, 'Pelajaran Ke 5', 'Pelajaran ke 5.mp3', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `suara` VALUES (6, 'Masuk Kelas', 'MASUK KELASS.mp3', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `suara` VALUES (7, 'Istirahat Pertama', 'Istirahat Pertama.mp3', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `suara` VALUES (8, 'Masuk Istirahat Pertama', 'Masuk Stelah Istirahat1.mp3', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `suara` VALUES (9, 'Istirahat Kedua', 'Istirahat Kedua.mp3', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `suara` VALUES (10, 'Masuk Istirahat Kedua', 'Masuk Stelah Istirahat 2.mp3', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `suara` VALUES (11, 'Pulang', 'Pulang.mp3', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `suara` VALUES (12, 'Pemadatan P5', 'Bel 5 kali.mp3', 0, NULL, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `level` int NULL DEFAULT NULL,
  `isdelete` int NOT NULL,
  `created_by` int NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_by` int NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 37 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'admin', 'c4ca4238a0b923820dcc509a6f75849b', 1, 0, NULL, NULL, NULL, '2025-01-24 19:05:25', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
