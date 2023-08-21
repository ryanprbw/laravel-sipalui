-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table app_palui_eksis.assistance_innovations
CREATE TABLE IF NOT EXISTS `assistance_innovations` (
  `assistance_innovation_id` int(11) NOT NULL AUTO_INCREMENT,
  `assistance_priority_id` int(11) NOT NULL,
  `assistance_innovation_name` varchar(255) NOT NULL,
  `assistance_innovation_status` int(11) NOT NULL DEFAULT '1',
  `assistance_innovation_alias` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`assistance_innovation_id`) USING BTREE,
  KEY `assistance_priority_id` (`assistance_priority_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table app_palui_eksis.assistance_priorities
CREATE TABLE IF NOT EXISTS `assistance_priorities` (
  `assistance_priority_id` int(11) NOT NULL AUTO_INCREMENT,
  `assistance_priority_name` varchar(255) NOT NULL,
  `assistance_priority_alias` varchar(25) NOT NULL,
  `assistance_priority_status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`assistance_priority_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table app_palui_eksis.budget_government
CREATE TABLE IF NOT EXISTS `budget_government` (
  `budget_government_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `government_id` int(11) NOT NULL,
  `category_strategy_id` int(11) NOT NULL,
  `urusan_code` char(5) NOT NULL,
  `bidang_code` char(5) NOT NULL,
  `program_code` char(10) NOT NULL,
  `kegiatan_code` char(15) NOT NULL,
  `subkegiatan_code` char(20) NOT NULL,
  `position` int(11) NOT NULL,
  `budget_government_year` year(4) NOT NULL,
  `budget_government_ceiling` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`budget_government_id`) USING BTREE,
  KEY `urusan_code` (`urusan_code`),
  KEY `bidang_code` (`bidang_code`),
  KEY `program_code` (`program_code`),
  KEY `kegiatan_code` (`kegiatan_code`),
  KEY `subkegiatan_code` (`subkegiatan_code`),
  KEY `government_id` (`government_id`),
  KEY `position` (`position`),
  KEY `category_strategy_id` (`category_strategy_id`),
  CONSTRAINT `FK_data_budget_poverty_government_local` FOREIGN KEY (`government_id`) REFERENCES `government_local` (`government_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table app_palui_eksis.data_families
CREATE TABLE IF NOT EXISTS `data_families` (
  `family_id` bigint(20) NOT NULL,
  `family_year` year(4) NOT NULL,
  `prov_code` int(2) unsigned zerofill NOT NULL,
  `city_code` int(2) unsigned zerofill NOT NULL,
  `district_code` int(2) unsigned zerofill NOT NULL,
  `village_code` int(4) unsigned zerofill NOT NULL,
  `desil_id` int(11) NOT NULL,
  `family_address` text NOT NULL,
  `population_nik` char(16) NOT NULL,
  `padan_dukcapil` varchar(50) NOT NULL,
  `family_house` varchar(50) NOT NULL,
  `family_facilitiy_other` varchar(50) NOT NULL,
  `family_facility_defecation` varchar(255) NOT NULL,
  `family_type_roof` varchar(50) NOT NULL,
  `family_type_wall` varchar(50) NOT NULL,
  `family_type_floor` varchar(50) NOT NULL,
  `family_type_lighting` varchar(255) NOT NULL,
  `family_type_cooking` varchar(50) NOT NULL,
  `family_type_drinking` varchar(50) NOT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `stunting_risk_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`family_id`),
  KEY `family_year` (`family_year`),
  KEY `prov_code` (`prov_code`),
  KEY `city_code` (`city_code`),
  KEY `district_code` (`district_code`),
  KEY `village_code` (`village_code`),
  KEY `desil_id` (`desil_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table app_palui_eksis.data_populations
CREATE TABLE IF NOT EXISTS `data_populations` (
  `population_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `population_year` year(4) NOT NULL,
  `family_id` bigint(20) NOT NULL,
  `prov_code` int(2) unsigned zerofill NOT NULL,
  `city_code` int(2) unsigned zerofill NOT NULL,
  `district_code` int(2) unsigned zerofill NOT NULL,
  `village_code` int(4) unsigned zerofill NOT NULL,
  `population_nik` char(16) NOT NULL,
  `population_name` varchar(255) NOT NULL,
  `population_address` text NOT NULL,
  `population_date_birth` date NOT NULL,
  `population_job` varchar(100) NOT NULL,
  `population_education` varchar(100) NOT NULL,
  `popolation_gender` enum('L','P') NOT NULL,
  `family_relation_id` int(11) NOT NULL,
  `desil_id` int(4) NOT NULL,
  `status_marry` varchar(50) NOT NULL,
  `padan_dukcapil` enum('Ya','Tidak') NOT NULL,
  `status_dtks` int(11) NOT NULL DEFAULT '0',
  `stunting_risk_id` int(11) DEFAULT '0',
  PRIMARY KEY (`population_id`) USING BTREE,
  KEY `family_id` (`family_id`),
  KEY `prov_code` (`prov_code`),
  KEY `city_code` (`city_code`),
  KEY `district_code` (`district_code`),
  KEY `village_code` (`village_code`)
) ENGINE=InnoDB AUTO_INCREMENT=963458 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table app_palui_eksis.government_agencies
CREATE TABLE IF NOT EXISTS `government_agencies` (
  `agency_id` int(11) NOT NULL AUTO_INCREMENT,
  `government_id` int(11) NOT NULL,
  `agency_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`agency_id`),
  KEY `government_id` (`government_id`),
  CONSTRAINT `FK_government_agencies_government_local` FOREIGN KEY (`government_id`) REFERENCES `government_local` (`government_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table app_palui_eksis.government_local
CREATE TABLE IF NOT EXISTS `government_local` (
  `government_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_code` int(2) unsigned zerofill DEFAULT NULL,
  `position` int(11) NOT NULL COMMENT '1 Provinsi, 2 Kab/kota',
  `government_name` varchar(255) NOT NULL,
  `government_alias` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`government_id`) USING BTREE,
  KEY `city_id` (`city_code`) USING BTREE,
  KEY `position` (`position`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table app_palui_eksis.menus
CREATE TABLE IF NOT EXISTS `menus` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(225) NOT NULL,
  `parent` int(11) NOT NULL,
  `link` varchar(225) NOT NULL,
  `sort` int(11) NOT NULL,
  `icon` varchar(50) NOT NULL,
  PRIMARY KEY (`menu_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.

-- Dumping structure for table app_palui_eksis.menus_role
CREATE TABLE IF NOT EXISTS `menus_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `action` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`role_id`),
  KEY `menu_id` (`menu_id`),
  KEY `level` (`level_id`),
  CONSTRAINT `FK_menus_role_menus` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`menu_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table app_palui_eksis.nomination_populations
CREATE TABLE IF NOT EXISTS `nomination_populations` (
  `nomination_id` int(11) NOT NULL AUTO_INCREMENT,
  `year` year(4) NOT NULL,
  `population_nik` char(16) NOT NULL,
  `category_strategy_id` int(11) NOT NULL,
  `agency_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`nomination_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table app_palui_eksis.p3ke_individu
CREATE TABLE IF NOT EXISTS `p3ke_individu` (
  `individu_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_keluarga_p3ke` varchar(50) NOT NULL,
  `provinsi` varchar(50) DEFAULT NULL,
  `kabupaten_kota` varchar(50) DEFAULT NULL,
  `kecamatan` varchar(50) DEFAULT NULL,
  `desa_kelurahan` varchar(50) DEFAULT NULL,
  `kode_kemdagri` varchar(50) DEFAULT NULL,
  `desil_kesejahteraan` int(11) DEFAULT NULL,
  `alamat` text,
  `id_individu` int(11) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `nik` varchar(16) DEFAULT NULL,
  `padan_dukcapil` varchar(50) DEFAULT NULL,
  `jenis_kelamin` varchar(50) DEFAULT NULL,
  `hubungan_dengan_kepala_keluarga` varchar(50) DEFAULT NULL,
  `tanggal_lahir` varchar(50) DEFAULT NULL,
  `status_kawin` varchar(50) DEFAULT NULL,
  `pekerjaan` varchar(50) DEFAULT NULL,
  `pendidikan` varchar(50) DEFAULT NULL,
  `usia_dibawah_7_tahun` varchar(50) DEFAULT NULL,
  `usia_7_sd_12` varchar(50) DEFAULT NULL,
  `usia_13_sd_15` varchar(50) DEFAULT NULL,
  `usia_16_sd_18` varchar(50) DEFAULT NULL,
  `usia_19_sd_21` varchar(50) DEFAULT NULL,
  `usia_22_sd_59` varchar(50) DEFAULT NULL,
  `usia _60_tahun_keatas` varchar(50) DEFAULT NULL,
  `penerima _bpnt` varchar(50) DEFAULT NULL,
  `penerima_bpum` varchar(50) DEFAULT NULL,
  `penerima_bst` varchar(50) DEFAULT NULL,
  `penerima_pkh` varchar(50) DEFAULT NULL,
  `penerima_sembako` varchar(50) DEFAULT NULL,
  `resiko_stunting` int(11) DEFAULT NULL,
  PRIMARY KEY (`individu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1419845 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table app_palui_eksis.p3ke_keluarga
CREATE TABLE IF NOT EXISTS `p3ke_keluarga` (
  `keluarga_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_keluarga_P3KE` varchar(50) NOT NULL,
  `provinsi` varchar(255) DEFAULT NULL,
  `kabupaten_kota` varchar(255) DEFAULT NULL,
  `kecamatan` varchar(255) NOT NULL,
  `desa_kelurahan` varchar(255) DEFAULT NULL,
  `kode_kemdagri` varchar(255) DEFAULT NULL,
  `desil_kesejahteraan` int(11) DEFAULT NULL,
  `alamat` text,
  `kepala_keluarga` varchar(255) DEFAULT NULL,
  `nik` varchar(16) DEFAULT NULL,
  `padan_dukcapil` varchar(50) DEFAULT NULL,
  `jenis_kelamin` varchar(50) DEFAULT NULL,
  `tanggal_lahir` varchar(50) DEFAULT NULL,
  `pekerjaan` varchar(255) DEFAULT NULL,
  `pendidikan` varchar(255) DEFAULT NULL,
  `kepemilikan_rumah` varchar(50) DEFAULT NULL,
  `memiliki_simpananuang_perhiasan_ternak_lainnya` varchar(50) DEFAULT NULL,
  `jenis_atap` varchar(50) DEFAULT NULL,
  `jenis_dinding` varchar(50) DEFAULT NULL,
  `jenis_lantai` varchar(50) DEFAULT NULL,
  `sumber_penerangan` varchar(255) DEFAULT NULL,
  `bahan_bakar_memasak` varchar(50) DEFAULT NULL,
  `sumber_air_minum` varchar(50) DEFAULT NULL,
  `memiliki_fasilitas_buang_air_besar` varchar(255) DEFAULT NULL,
  `penerima_bpnt` varchar(50) DEFAULT NULL,
  `penerima_bpum` varchar(50) DEFAULT NULL,
  `penerima_bst` varchar(50) DEFAULT NULL,
  `penerima_pkh` varchar(50) DEFAULT NULL,
  `penerima_sembako` varchar(50) DEFAULT NULL,
  `resiko_stunting` int(11) DEFAULT NULL,
  PRIMARY KEY (`keluarga_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=621528 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.

-- Dumping structure for table app_palui_eksis.receiver_priority
CREATE TABLE IF NOT EXISTS `receiver_priority` (
  `receiver_priority_id` int(11) NOT NULL AUTO_INCREMENT,
  `assistance_priority_id` int(11) NOT NULL,
  `agency_id` int(11) NOT NULL,
  `government_id` int(11) NOT NULL,
  `family_id` bigint(20) NOT NULL,
  `source_fund_id` int(11) NOT NULL,
  `year` year(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`receiver_priority_id`),
  KEY `assistance_priority_id` (`assistance_priority_id`),
  KEY `agency_id` (`agency_id`),
  KEY `government_id` (`government_id`),
  KEY `family_id` (`family_id`),
  KEY `source_fund_id` (`source_fund_id`)
) ENGINE=InnoDB AUTO_INCREMENT=448896 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table app_palui_eksis.ref_bidang_urusan
CREATE TABLE IF NOT EXISTS `ref_bidang_urusan` (
  `bidang_id` int(11) NOT NULL AUTO_INCREMENT,
  `urusan_code` char(5) NOT NULL,
  `bidang_code` varchar(50) NOT NULL,
  `bidang_name` varchar(255) NOT NULL,
  PRIMARY KEY (`bidang_id`),
  KEY `kd_urusan` (`urusan_code`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table app_palui_eksis.ref_cities
CREATE TABLE IF NOT EXISTS `ref_cities` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `prov_code` int(2) unsigned zerofill NOT NULL,
  `city_code` int(2) unsigned zerofill NOT NULL,
  `city_name` varchar(255) NOT NULL,
  `status_objek` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`city_id`) USING BTREE,
  KEY `city_code` (`city_code`),
  KEY `FK_ref_cities_ref_provinces` (`prov_code`),
  CONSTRAINT `FK_ref_cities_ref_provinces` FOREIGN KEY (`prov_code`) REFERENCES `ref_provinces` (`prov_code`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=356 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table app_palui_eksis.ref_districts
CREATE TABLE IF NOT EXISTS `ref_districts` (
  `district_id` int(11) NOT NULL AUTO_INCREMENT,
  `prov_code` int(2) unsigned zerofill NOT NULL,
  `city_code` int(2) unsigned zerofill NOT NULL,
  `district_code` int(2) unsigned zerofill NOT NULL,
  `district_name` varchar(255) NOT NULL,
  `status_objek` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`district_id`) USING BTREE,
  KEY `city_code` (`city_code`),
  KEY `district_code` (`district_code`),
  KEY `FK_ref_districts_ref_cities` (`prov_code`),
  CONSTRAINT `FK_ref_districts_ref_cities` FOREIGN KEY (`prov_code`) REFERENCES `ref_cities` (`prov_code`) ON UPDATE CASCADE,
  CONSTRAINT `FK_ref_districts_ref_cities_2` FOREIGN KEY (`city_code`) REFERENCES `ref_cities` (`city_code`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5064 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.

-- Dumping structure for table app_palui_eksis.ref_kegiatan
CREATE TABLE IF NOT EXISTS `ref_kegiatan` (
  `kegiatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `position` int(11) NOT NULL DEFAULT '2' COMMENT '1 Provinsi, 2 Kabupaten',
  `urusan_code` char(5) NOT NULL,
  `bidang_code` char(5) NOT NULL,
  `program_code` char(10) NOT NULL,
  `kegiatan_code` char(15) NOT NULL,
  `kegiatan_name` text NOT NULL,
  `kegiatan_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`kegiatan_id`),
  KEY `kd_program` (`program_code`) USING BTREE,
  KEY `kd_urusan` (`urusan_code`) USING BTREE,
  KEY `kd_bidang` (`bidang_code`) USING BTREE,
  KEY `position` (`position`)
) ENGINE=InnoDB AUTO_INCREMENT=1897 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.

-- Dumping structure for table app_palui_eksis.ref_program
CREATE TABLE IF NOT EXISTS `ref_program` (
  `program_id` int(11) NOT NULL AUTO_INCREMENT,
  `position` int(11) NOT NULL DEFAULT '2' COMMENT '1 Provinsi, 2 Kabupaten',
  `urusan_code` char(5) NOT NULL,
  `bidang_code` char(5) NOT NULL,
  `program_code` char(10) NOT NULL,
  `program_name` varchar(255) NOT NULL,
  `program_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`program_id`),
  KEY `kd_urusan` (`urusan_code`) USING BTREE,
  KEY `kd_bidang` (`bidang_code`) USING BTREE,
  KEY `position` (`position`)
) ENGINE=InnoDB AUTO_INCREMENT=584 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table app_palui_eksis.ref_provinces
CREATE TABLE IF NOT EXISTS `ref_provinces` (
  `prov_id` int(11) NOT NULL AUTO_INCREMENT,
  `prov_code` int(2) unsigned zerofill NOT NULL,
  `prov_name` varchar(255) NOT NULL,
  `status_objek` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`prov_id`),
  KEY `prov_kode` (`prov_code`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.

-- Dumping structure for table app_palui_eksis.ref_subkegiatan
CREATE TABLE IF NOT EXISTS `ref_subkegiatan` (
  `subkegiatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `position` int(11) NOT NULL DEFAULT '2' COMMENT '1 Provinsi, 2 Kabupaten',
  `urusan_code` char(5) NOT NULL,
  `bidang_code` char(5) NOT NULL,
  `program_code` char(10) NOT NULL,
  `kegiatan_code` char(15) NOT NULL,
  `subkegiatan_code` char(20) NOT NULL,
  `subkegiatan_name` text NOT NULL,
  `subkegiatan_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`subkegiatan_id`),
  KEY `urusan_code` (`urusan_code`),
  KEY `bidang_code` (`bidang_code`),
  KEY `kegiatan_code` (`kegiatan_code`),
  KEY `program_code` (`program_code`),
  KEY `position` (`position`)
) ENGINE=InnoDB AUTO_INCREMENT=4313 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.

-- Dumping structure for table app_palui_eksis.ref_urusan
CREATE TABLE IF NOT EXISTS `ref_urusan` (
  `urusan_id` int(11) NOT NULL AUTO_INCREMENT,
  `urusan_code` char(5) NOT NULL,
  `urusan_name` varchar(255) NOT NULL,
  PRIMARY KEY (`urusan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table app_palui_eksis.ref_villages
CREATE TABLE IF NOT EXISTS `ref_villages` (
  `village_id` int(11) NOT NULL AUTO_INCREMENT,
  `prov_code` int(2) unsigned zerofill NOT NULL,
  `city_code` int(2) unsigned zerofill NOT NULL,
  `district_code` int(2) unsigned zerofill NOT NULL,
  `village_code` int(4) unsigned zerofill NOT NULL,
  `village_name` varchar(255) NOT NULL,
  `status_objek` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`village_id`) USING BTREE,
  KEY `FK_ref_villages_ref_provinces` (`prov_code`),
  KEY `city_code` (`city_code`),
  KEY `district_code` (`district_code`),
  KEY `village_code` (`village_code`)
) ENGINE=InnoDB AUTO_INCREMENT=61609 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.

-- Dumping structure for table app_palui_eksis.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `government_id` int(11) DEFAULT NULL,
  `agency_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table app_palui_eksis.users_level
CREATE TABLE IF NOT EXISTS `users_level` (
  `level_id` int(11) NOT NULL,
  `level_name` varchar(50) NOT NULL,
  PRIMARY KEY (`level_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table app_palui_eksis.uti_category_strategies
CREATE TABLE IF NOT EXISTS `uti_category_strategies` (
  `category_strategy_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_strategy_name` varchar(255) NOT NULL,
  PRIMARY KEY (`category_strategy_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table app_palui_eksis.uti_desil
CREATE TABLE IF NOT EXISTS `uti_desil` (
  `desil_id` int(11) NOT NULL,
  `desil_name` varchar(100) NOT NULL,
  `desil_description` text NOT NULL,
  `desil_status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`desil_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table app_palui_eksis.uti_educations
CREATE TABLE IF NOT EXISTS `uti_educations` (
  `education_id` int(11) NOT NULL AUTO_INCREMENT,
  `education_name` varchar(200) NOT NULL,
  PRIMARY KEY (`education_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table app_palui_eksis.uti_facility_cooking
CREATE TABLE IF NOT EXISTS `uti_facility_cooking` (
  `facility_cooking_id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_cooking_name` varchar(200) NOT NULL,
  PRIMARY KEY (`facility_cooking_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table app_palui_eksis.uti_facility_defecations
CREATE TABLE IF NOT EXISTS `uti_facility_defecations` (
  `facility_defecation_id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_defecation_name` varchar(200) NOT NULL,
  PRIMARY KEY (`facility_defecation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table app_palui_eksis.uti_facility_drinkings
CREATE TABLE IF NOT EXISTS `uti_facility_drinkings` (
  `facility_drinking_id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_drinking_name` varchar(200) NOT NULL,
  PRIMARY KEY (`facility_drinking_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table app_palui_eksis.uti_facility_floors
CREATE TABLE IF NOT EXISTS `uti_facility_floors` (
  `facility_floor_id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_floor_name` varchar(200) NOT NULL,
  PRIMARY KEY (`facility_floor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table app_palui_eksis.uti_facility_lightings
CREATE TABLE IF NOT EXISTS `uti_facility_lightings` (
  `facility_lighting_id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_lighting_name` varchar(200) NOT NULL,
  PRIMARY KEY (`facility_lighting_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table app_palui_eksis.uti_facility_roofs
CREATE TABLE IF NOT EXISTS `uti_facility_roofs` (
  `facility_roof_id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_roof_name` varchar(200) NOT NULL,
  PRIMARY KEY (`facility_roof_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table app_palui_eksis.uti_facility_walls
CREATE TABLE IF NOT EXISTS `uti_facility_walls` (
  `facility_wall_id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_wall_name` varchar(200) NOT NULL,
  PRIMARY KEY (`facility_wall_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table app_palui_eksis.uti_family_house
CREATE TABLE IF NOT EXISTS `uti_family_house` (
  `family_house_id` int(11) NOT NULL AUTO_INCREMENT,
  `family_house_name` varchar(200) NOT NULL,
  PRIMARY KEY (`family_house_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table app_palui_eksis.uti_family_relations
CREATE TABLE IF NOT EXISTS `uti_family_relations` (
  `family_relation_id` int(11) NOT NULL AUTO_INCREMENT,
  `family_relation_name` varchar(50) NOT NULL,
  PRIMARY KEY (`family_relation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table app_palui_eksis.uti_job
CREATE TABLE IF NOT EXISTS `uti_job` (
  `job_id` int(11) NOT NULL AUTO_INCREMENT,
  `job_name` varchar(100) NOT NULL,
  PRIMARY KEY (`job_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table app_palui_eksis.uti_source_funds
CREATE TABLE IF NOT EXISTS `uti_source_funds` (
  `source_fund_id` int(11) NOT NULL AUTO_INCREMENT,
  `source_fund_name` varchar(100) NOT NULL,
  `source_fund_desc` text,
  PRIMARY KEY (`source_fund_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table app_palui_eksis.uti_status_marry
CREATE TABLE IF NOT EXISTS `uti_status_marry` (
  `marry_id` int(11) NOT NULL AUTO_INCREMENT,
  `marry_name` varchar(50) NOT NULL,
  PRIMARY KEY (`marry_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table app_palui_eksis.uti_stunting_risk
CREATE TABLE IF NOT EXISTS `uti_stunting_risk` (
  `stunting_risk_id` int(11) NOT NULL AUTO_INCREMENT,
  `stunting_risk_desc` varchar(100) NOT NULL,
  PRIMARY KEY (`stunting_risk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for trigger app_palui_eksis.menus_after_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `menus_after_insert` AFTER INSERT ON `menus` FOR EACH ROW BEGIN
insert menus_role (menu_id, level_id, action) values (new.menu_id, 1, 1);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
