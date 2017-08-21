# --------------
# sections
# --------------
CREATE TABLE peer_education.sections (
  section_id           int UNSIGNED NOT NULL  AUTO_INCREMENT,
  section_seme         char(6)  NOT NULL  ,
  section_name         varchar(30)  NOT NULL  ,
  CONSTRAINT pk_sections PRIMARY KEY ( section_id ),
  CONSTRAINT unique_sections UNIQUE ( section_seme )
) engine=InnoDB;

# --------------
# peducators
# --------------
CREATE TABLE peer_education.peducators (
  peducator_id         int UNSIGNED NOT NULL  AUTO_INCREMENT,
  student_id           varchar(11)  NOT NULL  ,
  preferred_name       varchar(45)  NOT NULL  ,
  first_name           varchar(45)  NOT NULL  ,
  last_name            varchar(45)  NOT NULL  ,
  section_id           int    ,
  CONSTRAINT pk_peducators PRIMARY KEY ( peducator_id ),
  CONSTRAINT unique_peducators UNIQUE ( student_id )
) engine=InnoDB;

CREATE INDEX idx_peducators ON peer_education.peducators ( section_id );

# --------------
# courses
# --------------
CREATE TABLE peer_education.courses (
  course_id            int UNSIGNED NOT NULL  AUTO_INCREMENT,
  course_name          char(7)  NOT NULL  ,
  total_times_been_taught int UNSIGNED NOT NULL DEFAULT 0 ,
  CONSTRAINT pk_courses PRIMARY KEY ( course_id ),
  CONSTRAINT unique_courses UNIQUE ( course_name )
) engine=InnoDB;

# --------------
# managers
# --------------
CREATE TABLE peer_education.managers (
	manager_id           int UNSIGNED NOT NULL  AUTO_INCREMENT,
	username             varchar(45)  NOT NULL  ,
	password             varchar(45)  NOT NULL  ,
	first_name           varchar(45)  NOT NULL  ,
	last_name            varchar(45)  NOT NULL  ,
	section_id           int UNSIGNED   ,
	CONSTRAINT pk_managers PRIMARY KEY ( manager_id ),
	CONSTRAINT unique_managers UNIQUE ( username )
 ) engine=InnoDB;

CREATE INDEX idx_managers ON peer_education.managers ( section_id );

# --------------
# notes
# --------------
CREATE TABLE peer_education.notes (
	note_id              int UNSIGNED NOT NULL  AUTO_INCREMENT,
	manager_id           int UNSIGNED NOT NULL  ,
	peducator_id         int UNSIGNED NOT NULL  ,
	content              text  NOT NULL  ,
	note_time            timestamp  NOT NULL DEFAULT CURRENT_TIMESTAMP ,
	CONSTRAINT pk_notes_0 PRIMARY KEY ( note_id )
) engine=InnoDB;

CREATE INDEX idx_notes_0 ON peer_education.notes ( manager_id );
CREATE INDEX idx_notes_1 ON peer_education.notes ( peducator_id );

# --------------
# announcements
# --------------
CREATE TABLE peer_education.announcements (
	announcement_id      int UNSIGNED NOT NULL  AUTO_INCREMENT,
	manager_id           int UNSIGNED NOT NULL  ,
	content              text  NOT NULL  ,
	announcement_time    timestamp  NOT NULL DEFAULT CURRENT_TIMESTAMP ,
	CONSTRAINT pk_notes PRIMARY KEY ( announcement_id )
) engine=InnoDB;

CREATE INDEX idx_notes ON peer_education.announcements ( manager_id );

# --------------
# peducator_sections
# --------------
CREATE TABLE peer_education.peducator_sections (
	peducator_id         int UNSIGNED NOT NULL  ,
	section_id           int UNSIGNED NOT NULL  ,
	CONSTRAINT pk_peducator_sections PRIMARY KEY ( peducator_id, section_id ),
	CONSTRAINT pk_peducator_sections_0 UNIQUE ( peducator_id )
) engine=InnoDB;

CREATE INDEX idx_peducator_sections ON peer_education.peducator_sections ( section_id );

# --------------
# course_sections
# --------------
CREATE TABLE peer_education.course_sections (
	course_id            int UNSIGNED NOT NULL  ,
	section_id           int UNSIGNED NOT NULL  ,
	times_been_taught    int UNSIGNED NOT NULL DEFAULT 0 ,
	CONSTRAINT pk_course_sections PRIMARY KEY ( course_id, section_id )
) engine=InnoDB;

# --------------
# peducator_courses
# --------------
CREATE TABLE peer_education.peducator_courses (
	peducator_id         int UNSIGNED NOT NULL  ,
	course_id            int UNSIGNED NOT NULL  ,
	CONSTRAINT pk_peducator_courses PRIMARY KEY ( peducator_id, course_id )
) engine=InnoDB;

CREATE INDEX idx_peducator_courses ON peer_education.peducator_courses ( course_id );

# --------------
# add foreign keys
# --------------
ALTER TABLE peer_education.peducator_courses ADD CONSTRAINT fk_peducator_courses_courses FOREIGN KEY ( course_id ) REFERENCES peer_education.courses( course_id ) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE peer_education.announcements ADD CONSTRAINT fk_announcements_managers FOREIGN KEY ( manager_id ) REFERENCES peer_education.managers( manager_id ) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE peer_education.managers ADD CONSTRAINT fk_managers_sections FOREIGN KEY ( section_id ) REFERENCES peer_education.sections( section_id ) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE peer_education.notes ADD CONSTRAINT fk_notes_managers FOREIGN KEY ( manager_id ) REFERENCES peer_education.managers( manager_id ) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE peer_education.notes ADD CONSTRAINT fk_notes_peducators FOREIGN KEY ( peducator_id ) REFERENCES peer_education.peducators( peducator_id ) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE peer_education.peducator_sections ADD CONSTRAINT fk_peducator_sections FOREIGN KEY ( peducator_id ) REFERENCES peer_education.peducators( peducator_id ) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE peer_education.peducator_sections ADD CONSTRAINT fk_peducator_sections_sections FOREIGN KEY ( section_id ) REFERENCES peer_education.sections( section_id ) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE peer_education.course_sections ADD CONSTRAINT fk_course_sections_courses FOREIGN KEY ( course_id ) REFERENCES peer_education.courses( course_id ) ON DELETE CASCADE ON UPDATE CASCADE;
