CREATE TABLE `peer_education`.`managers` (
  `manager_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `section_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`manager_id`),
  UNIQUE INDEX `manager_id_UNIQUE` (`manager_id` ASC),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC));



CREATE TABLE `peer_education`.`announcements` (
  `announcement_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `manager_id` INT NOT NULL,
  `content` LONGTEXT NOT NULL,
  `announcement_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`announcement_id`),
  UNIQUE INDEX `announcement_id_UNIQUE` (`announcement_id` ASC));



CREATE TABLE `peer_education`.`notes` (
  `note_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `manager_id` INT UNSIGNED NOT NULL,
  `peducator_id` INT UNSIGNED NOT NULL,
  `content` LONGTEXT NOT NULL,
  `note_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`note_id`),
  UNIQUE INDEX `note_id_UNIQUE` (`note_id` ASC));



CREATE TABLE `peer_education`.`sections` (
  `section_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `section_seme` CHAR(6) NOT NULL,
  `section_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`section_id`),
  UNIQUE INDEX `section_id_UNIQUE` (`section_id` ASC));



CREATE TABLE `peer_education`.`peducators` (
  `peducator_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `student_id` VARCHAR(20) NOT NULL,
  `preferred_name` VARCHAR(45) NOT NULL,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`peducator_id`),
  UNIQUE INDEX `peducator_id_UNIQUE` (`peducator_id` ASC),
  UNIQUE INDEX `student_id_UNIQUE` (`student_id` ASC));



CREATE TABLE `peer_education`.`courses` (
  `course_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `course_name` VARCHAR(20) NOT NULL,
  `total_times_been_taught` INT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`course_id`),
  UNIQUE INDEX `course_id_UNIQUE` (`course_id` ASC),
  UNIQUE INDEX `course_name_UNIQUE` (`course_name` ASC));



CREATE TABLE `peer_education`.`peducator_sections` (
  `peducator_id` INT UNSIGNED NOT NULL,
  `section_id` INT UNSIGNED NOT NULL,
  `week_number` INT UNSIGNED NOT NULL,
  `contributed_mins` INT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`peducator_id`, `section_id`, `week_number`));



CREATE TABLE `peer_education`.`course_sections` (
  `course_id` INT UNSIGNED NOT NULL,
  `section_id` INT UNSIGNED NOT NULL,
  `times_been_taught` INT UNSIGNED NOT NULL DEFAULT 0,
  `week_number` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`course_id`, `section_id`, `week_number`));



CREATE TABLE `peer_education`.`peducator_courses` (
  `peducator_id` INT UNSIGNED NOT NULL,
  `course_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`peducator_id`, `course_id`));

  ALTER TABLE `peer_education`.`managers`
  ADD INDEX `fk_managers_1_idx` (`section_id` ASC);
  ALTER TABLE `peer_education`.`managers`
  ADD CONSTRAINT `fk_managers_1`
    FOREIGN KEY (`section_id`)
    REFERENCES `peer_education`.`sections` (`section_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION;


  ALTER TABLE `peer_education`.`announcements`
  CHANGE COLUMN `manager_id` `manager_id` INT(11) UNSIGNED NOT NULL ;


  ALTER TABLE `peer_education`.`announcements`
  ADD INDEX `fk_announcements_1_idx` (`manager_id` ASC);
  ALTER TABLE `peer_education`.`announcements`
  ADD CONSTRAINT `fk_announcements_1`
    FOREIGN KEY (`manager_id`)
    REFERENCES `peer_education`.`managers` (`manager_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION;


  ALTER TABLE `peer_education`.`notes`
  ADD INDEX `fk_notes_1_idx` (`manager_id` ASC),
  ADD INDEX `fk_notes_2_idx` (`peducator_id` ASC);
  ALTER TABLE `peer_education`.`notes`
  ADD CONSTRAINT `fk_notes_1`
    FOREIGN KEY (`manager_id`)
    REFERENCES `peer_education`.`managers` (`manager_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notes_2`
    FOREIGN KEY (`peducator_id`)
    REFERENCES `peer_education`.`peducators` (`peducator_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION;


  ALTER TABLE `peer_education`.`peducator_sections`
  ADD INDEX `fk_peducator_sections_2_idx` (`section_id` ASC);
  ALTER TABLE `peer_education`.`peducator_sections`
  ADD CONSTRAINT `fk_peducator_sections_1`
    FOREIGN KEY (`peducator_id`)
    REFERENCES `peer_education`.`peducators` (`peducator_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_peducator_sections_2`
    FOREIGN KEY (`section_id`)
    REFERENCES `peer_education`.`sections` (`section_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION;


  ALTER TABLE `peer_education`.`course_sections`
  ADD INDEX `fk_course_sections_2_idx` (`section_id` ASC);
  ALTER TABLE `peer_education`.`course_sections`
  ADD CONSTRAINT `fk_course_sections_1`
    FOREIGN KEY (`course_id`)
    REFERENCES `peer_education`.`courses` (`course_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_course_sections_2`
    FOREIGN KEY (`section_id`)
    REFERENCES `peer_education`.`sections` (`section_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION;


  ALTER TABLE `peer_education`.`peducator_courses`
  ADD INDEX `fk_peducator_courses_2_idx` (`course_id` ASC);
  ALTER TABLE `peer_education`.`peducator_courses`
  ADD CONSTRAINT `fk_peducator_courses_1`
    FOREIGN KEY (`peducator_id`)
    REFERENCES `peer_education`.`peducators` (`peducator_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_peducator_courses_2`
    FOREIGN KEY (`course_id`)
    REFERENCES `peer_education`.`courses` (`course_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION;

ALTER TABLE `peer_education`.`peducators`
ADD COLUMN `is_current` INT UNSIGNED NOT NULL AFTER `last_name`;

ALTER TABLE `peer_education`.`peducators`
CHANGE COLUMN `is_current` `is_current` INT(10) UNSIGNED NOT NULL DEFAULT 1 ;


CREATE TABLE `peer_education`.`dates` (
  `date_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` DATE NOT NULL,
  PRIMARY KEY (`date_id`),
  UNIQUE INDEX `dates_id_UNIQUE` (`date_id` ASC),
  UNIQUE INDEX `date_UNIQUE` (`date` ASC));


ALTER TABLE `peer_education`.`dates`
  ADD COLUMN `semester` CHAR(6) NOT NULL AFTER `date`,
  ADD UNIQUE INDEX `semester_UNIQUE` (`semester` ASC);
