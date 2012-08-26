-- -----------------------------------------------------
-- Table `#__trackit_config`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `#__trackit_config` (
  `config_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `config_name` VARCHAR(255) NOT NULL ,
  `value` TEXT NOT NULL ,
  PRIMARY KEY (`config_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


CREATE TABLE IF NOT EXISTS `#__trackit_items` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`object_id` int NOT NULL,
	`name` varchar(255) NOT NULL,
	`file` varchar(255),
	`url` varchar(255),
	`viewed` int,
	`played` int,
	`createdate` datetime,
	`lastmodified` datetime,
	PRIMARY KEY (`id`)
);