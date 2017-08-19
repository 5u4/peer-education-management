CREATE TABLE `peer_education`.`managers` (
  `manager_id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `section_time` INT NULL,
  PRIMARY KEY (`manager_id`),
  UNIQUE INDEX `member_id_UNIQUE` (`manager_id` ASC),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC));

