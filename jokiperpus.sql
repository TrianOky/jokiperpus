/*
 Navicat Premium Data Transfer

 Source Server         : local_konek
 Source Server Type    : MySQL
 Source Server Version : 100421
 Source Host           : localhost:3306
 Source Schema         : jokiperpus

 Target Server Type    : MySQL
 Target Server Version : 100421
 File Encoding         : 65001

 Date: 15/12/2021 11:31:21
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for anggota
-- ----------------------------
DROP TABLE IF EXISTS `anggota`;
CREATE TABLE `anggota`  (
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_anggota` int NOT NULL AUTO_INCREMENT,
  `id_kelas` int NOT NULL,
  `alamat` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_anggota`) USING BTREE,
  INDEX `id_kelas`(`id_kelas`) USING BTREE,
  CONSTRAINT `anggota_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of anggota
-- ----------------------------
INSERT INTO `anggota` VALUES ('Syahroful A', 1, 1, 'Dlanggu');
INSERT INTO `anggota` VALUES ('Trian Oky R', 2, 2, 'Dlanggu');

-- ----------------------------
-- Table structure for buku
-- ----------------------------
DROP TABLE IF EXISTS `buku`;
CREATE TABLE `buku`  (
  `id_buku` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pengarang` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `penerbit` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tahun` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_kategori` int NOT NULL,
  PRIMARY KEY (`id_buku`) USING BTREE,
  INDEX `id_kategori`(`id_kategori`) USING BTREE,
  CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of buku
-- ----------------------------
INSERT INTO `buku` VALUES (2, 'Buku BARU', 'Nubi', 'Nubi', '2003', 2);

-- ----------------------------
-- Table structure for kategori
-- ----------------------------
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori`  (
  `id_kategori` int NOT NULL AUTO_INCREMENT,
  `kategori` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_kategori`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kategori
-- ----------------------------
INSERT INTO `kategori` VALUES (1, 'Komik');
INSERT INTO `kategori` VALUES (2, 'Novel');
INSERT INTO `kategori` VALUES (3, 'Majalah');
INSERT INTO `kategori` VALUES (4, 'Cergam');
INSERT INTO `kategori` VALUES (6, 'Cerita Pendek');

-- ----------------------------
-- Table structure for kelas
-- ----------------------------
DROP TABLE IF EXISTS `kelas`;
CREATE TABLE `kelas`  (
  `id_kelas` int NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_kelas`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kelas
-- ----------------------------
INSERT INTO `kelas` VALUES (1, 'XII RPL 1');
INSERT INTO `kelas` VALUES (2, 'XII RPL 2');
INSERT INTO `kelas` VALUES (3, 'XI RPL 1');
INSERT INTO `kelas` VALUES (4, 'XI RPL 2');
INSERT INTO `kelas` VALUES (5, 'x RPL 1');
INSERT INTO `kelas` VALUES (6, 'X RPL 2');

-- ----------------------------
-- Table structure for peminjaman
-- ----------------------------
DROP TABLE IF EXISTS `peminjaman`;
CREATE TABLE `peminjaman`  (
  `id_peminjaman` int NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `id_buku` int NOT NULL,
  `id_anggota` int NOT NULL,
  `statuss` tinyint(1) NOT NULL,
  `tanggal_kembali` date NOT NULL,
  PRIMARY KEY (`id_peminjaman`) USING BTREE,
  INDEX `id_buku`(`id_buku`, `id_anggota`) USING BTREE,
  INDEX `id_anggota`(`id_anggota`) USING BTREE,
  CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of peminjaman
-- ----------------------------
INSERT INTO `peminjaman` VALUES (11, '2021-12-14', 2, 1, 1, '2021-12-16');
INSERT INTO `peminjaman` VALUES (13, '2021-12-15', 2, 2, 0, '2021-12-17');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `passsword` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_users` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_users`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('admin', '81dc9bdb52d04dc20036dbd8313ed055', 1);

SET FOREIGN_KEY_CHECKS = 1;
