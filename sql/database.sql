SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `cas` ;
CREATE SCHEMA IF NOT EXISTS `cas` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `cas` ;

-- -----------------------------------------------------
-- Table `cas`.`cas_users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cas`.`cas_users` ;

CREATE  TABLE IF NOT EXISTS `cas`.`cas_users` (
  `user_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `user_name` VARCHAR(45) NULL ,
  `user_passwd` VARCHAR(32) NULL ,
  `user_passwd_key` VARCHAR(300) NULL ,
  `user_fname` VARCHAR(45) NULL ,
  `user_lname` VARCHAR(45) NULL ,
  `user_email` VARCHAR(45) NULL ,
  `user_curp` VARCHAR(18) NULL ,
  `user_usaer` VARCHAR(45) NULL ,
  `user_usaer_supervision_zone` VARCHAR(200) NULL ,
  `user_crosee` INT(1) NULL ,
  `user_type` VARCHAR(7) NULL DEFAULT 'teacher' ,
  `user_school_level` INT(1) NULL ,
  `user_date_created` DATETIME NULL ,
  `user_date_last_login` DATETIME NULL ,
  `user_date_updated` DATETIME NULL ,
  `user_from_last_login` VARCHAR(15) NULL DEFAULT '000.000.000.000' ,
  `user_from_registered` VARCHAR(15) NULL ,
  PRIMARY KEY (`user_id`) ,
  UNIQUE INDEX `user_name_UNIQUE` (`user_name` ASC) ,
  UNIQUE INDEX `user_email_UNIQUE` (`user_email` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cas`.`cas_schools_delegations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cas`.`cas_schools_delegations` ;

CREATE  TABLE IF NOT EXISTS `cas`.`cas_schools_delegations` (
  `del_id` INT NOT NULL AUTO_INCREMENT ,
  `del_name` VARCHAR(45) NULL ,
  `del_key` VARCHAR(5) NULL ,
  PRIMARY KEY (`del_id`) ,
  UNIQUE INDEX `del_key_UNIQUE` (`del_key` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cas`.`cas_schools`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cas`.`cas_schools` ;

CREATE  TABLE IF NOT EXISTS `cas`.`cas_schools` (
  `school_id` BIGINT NOT NULL AUTO_INCREMENT ,
  `school_delegation_id` INT NOT NULL ,
  `school_user_id` INT NULL ,
  `school_cct` VARCHAR(10) NOT NULL ,
  `school_crosee` TINYINT(1) NULL ,
  `school_usaer` VARCHAR(45) NULL ,
  `school_usaer_supervision_zone` VARCHAR(200) NULL ,
  `school_turn` VARCHAR(2) NULL ,
  `school_supervision_zone` VARCHAR(200) NULL ,
  `school_address` VARCHAR(300) NULL ,
  `school_colony` VARCHAR(200) NULL ,
  `school_zipcode` VARCHAR(15) NULL ,
  `school_level` INT(1) NULL ,
  `school_phone` VARCHAR(45) NULL ,
  `school_name` VARCHAR(100) NULL ,
  PRIMARY KEY (`school_id`, `school_cct`) ,
  UNIQUE INDEX `school_cct_UNIQUE` (`school_cct` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cas`.`cas_users_schools`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cas`.`cas_users_schools` ;

CREATE  TABLE IF NOT EXISTS `cas`.`cas_users_schools` (
  `cas_users_user_id` BIGINT UNSIGNED NOT NULL ,
  `cas_schools_school_id` BIGINT NOT NULL ,
  `cas_schools_school_cct` VARCHAR(10) NOT NULL ,
  PRIMARY KEY (`cas_users_user_id`, `cas_schools_school_id`, `cas_schools_school_cct`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cas`.`cas_schools_groups`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cas`.`cas_schools_groups` ;

CREATE  TABLE IF NOT EXISTS `cas`.`cas_schools_groups` (
  `group_id` BIGINT NOT NULL AUTO_INCREMENT ,
  `group_name` VARCHAR(2) NULL ,
  `group_grade` INT NULL ,
  `group_school_level` INT(1) NULL ,
  `group_user_id` BIGINT NOT NULL ,
  `group_school_id` BIGINT NOT NULL ,
  `group_school_cct` VARCHAR(10) NOT NULL ,
  PRIMARY KEY (`group_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cas`.`cas_schools_groups_students`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cas`.`cas_schools_groups_students` ;

CREATE  TABLE IF NOT EXISTS `cas`.`cas_schools_groups_students` (
  `student_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `student_fname` VARCHAR(50) NULL ,
  `student_lname` VARCHAR(50) NULL ,
  `student_curp` VARCHAR(18) NOT NULL ,
  `student_sex` VARCHAR(1) NULL ,
  `student_user_id` BIGINT NOT NULL ,
  `student_school_id` BIGINT NOT NULL ,
  `student_school_cct` VARCHAR(10) NOT NULL ,
  `student_grade` INT(1) NOT NULL DEFAULT 1 ,
  `student_group_id` BIGINT NOT NULL ,
  `student_school_level` INT(1) NULL ,
  `student_is_deleted` VARCHAR(5) NULL DEFAULT 'false' ,
  `student_end_app` VARCHAR(5) NULL DEFAULT 'false' ,
  `student_is_down` VARCHAR(5) NULL DEFAULT 'false' ,
  PRIMARY KEY (`student_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cas`.`cas_app_questions_type`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cas`.`cas_app_questions_type` ;

CREATE  TABLE IF NOT EXISTS `cas`.`cas_app_questions_type` (
  `type_id` INT NOT NULL AUTO_INCREMENT ,
  `type_name` VARCHAR(50) NULL ,
  `type_school_level` INT(1) NULL ,
  PRIMARY KEY (`type_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cas`.`cas_app_questions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cas`.`cas_app_questions` ;

CREATE  TABLE IF NOT EXISTS `cas`.`cas_app_questions` (
  `question_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `question_text` VARCHAR(300) NOT NULL ,
  `question_school_level` INT(1) NULL ,
  `question_user_id` BIGINT NOT NULL ,
  `question_counter` BIGINT NULL ,
  `question_number` INT NOT NULL ,
  `question_type_id` INT NOT NULL ,
  PRIMARY KEY (`question_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cas`.`cas_app_answers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cas`.`cas_app_answers` ;

CREATE  TABLE IF NOT EXISTS `cas`.`cas_app_answers` (
  `answer_id` INT NOT NULL AUTO_INCREMENT ,
  `answer_student_id` BIGINT NOT NULL ,
  `answer_user_id` BIGINT NOT NULL ,
  `answer_school_id` BIGINT NOT NULL ,
  `answer_school_cct` VARCHAR(10) NOT NULL ,
  `answer_group_id` BIGINT NOT NULL ,
  `answer_1` VARCHAR(20) NULL ,
  `answer_2` VARCHAR(20) NULL ,
  `answer_3` VARCHAR(20) NULL ,
  `answer_4` VARCHAR(20) NULL ,
  `answer_5` VARCHAR(20) NULL ,
  `answer_6` VARCHAR(20) NULL ,
  `answer_7` VARCHAR(20) NULL ,
  `answer_8` VARCHAR(20) NULL ,
  `answer_9` VARCHAR(20) NULL ,
  `answer_10` VARCHAR(20) NULL ,
  `answer_11` VARCHAR(20) NULL ,
  `answer_12` VARCHAR(20) NULL ,
  `answer_13` VARCHAR(20) NULL ,
  `answer_14` VARCHAR(20) NULL ,
  `answer_15` VARCHAR(20) NULL ,
  `answer_16` VARCHAR(20) NULL ,
  `answer_17` VARCHAR(20) NULL ,
  `answer_18` VARCHAR(20) NULL ,
  `answer_19` VARCHAR(20) NULL ,
  `answer_20` VARCHAR(20) NULL ,
  `answer_21` VARCHAR(20) NULL ,
  `answer_22` VARCHAR(20) NULL ,
  `answer_23` VARCHAR(20) NULL ,
  `answer_24` VARCHAR(20) NULL ,
  `answer_25` VARCHAR(20) NULL ,
  `answer_26` VARCHAR(20) NULL ,
  `answer_27` VARCHAR(20) NULL ,
  `answer_28` VARCHAR(20) NULL ,
  `answer_29` VARCHAR(20) NULL ,
  `answer_30` VARCHAR(20) NULL ,
  `answer_31` VARCHAR(20) NULL ,
  `answer_32` VARCHAR(20) NULL ,
  `answer_33` VARCHAR(20) NULL ,
  `answer_34` VARCHAR(20) NULL ,
  `answer_35` VARCHAR(20) NULL ,
  `answer_36` VARCHAR(20) NULL ,
  `answer_37` VARCHAR(20) NULL ,
  `answer_38` VARCHAR(20) NULL ,
  `answer_39` VARCHAR(20) NULL ,
  `answer_40` VARCHAR(20) NULL ,
  `answer_41` VARCHAR(20) NULL ,
  `answer_42` VARCHAR(20) NULL ,
  `answer_43` VARCHAR(20) NULL ,
  `answer_44` VARCHAR(20) NULL ,
  `answer_45` VARCHAR(20) NULL ,
  PRIMARY KEY (`answer_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cas`.`cas_app`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cas`.`cas_app` ;

CREATE  TABLE IF NOT EXISTS `cas`.`cas_app` (
  `app_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `app_user_id` BIGINT UNSIGNED NOT NULL ,
  `app_name` VARCHAR(45) NULL ,
  `app_description` VARCHAR(300) NULL ,
  `app_is_active` TINYINT(1) NULL ,
  `app_date_created` DATETIME NULL ,
  `app_school_level` VARCHAR(45) NULL ,
  `app_date_activated` INT NULL ,
  `app_date_started` DATETIME NULL ,
  PRIMARY KEY (`app_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

USE `cas` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `cas`.`cas_app`
-- -----------------------------------------------------
START TRANSACTION;
USE `cas`;
INSERT INTO `cas`.`cas_app` (`app_id`, `app_user_id`, `app_name`, `app_description`, `app_is_active`, `app_date_created`, `app_school_level`, `app_date_activated`, `app_date_started`) VALUES (1, 1, 'Aplicación de cuestionarios 1', 'Aplicación de cuestionarios 1', 1, '2013-04-17 00:00:00', '3', 1366293748, '2013-04-17 00:00:00');
INSERT INTO `cas`.`cas_app` (`app_id`, `app_user_id`, `app_name`, `app_description`, `app_is_active`, `app_date_created`, `app_school_level`, `app_date_activated`, `app_date_started`) VALUES (2, 1, 'Aplicacion de cuestionarios 2', 'Aplicación de cuestionarios 2', 0, '2013-04-17 00:00:00', '3', 1366293748, '2013-04-17 00:00:00');
INSERT INTO `cas`.`cas_app` (`app_id`, `app_user_id`, `app_name`, `app_description`, `app_is_active`, `app_date_created`, `app_school_level`, `app_date_activated`, `app_date_started`) VALUES (3, 1, 'Aplicacion de cuestionarios 3', 'Aplicación de cuestionarios 3', 0, '2013-04-17 00:00:00', '3', 1366293748, '2013-04-17 00:00:00');
INSERT INTO `cas`.`cas_app` (`app_id`, `app_user_id`, `app_name`, `app_description`, `app_is_active`, `app_date_created`, `app_school_level`, `app_date_activated`, `app_date_started`) VALUES (4, 1, 'Aplicación de cuestionarios 1 (preescolar)', 'Aplicación de cuestionarios 4 (preescolar)', 1, '2013-04-17 00:00:00', '1', 1366293748, '2013-04-17 00:00:00');

COMMIT;
