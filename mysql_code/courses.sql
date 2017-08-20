CREATE TABLE courses (
  course_id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  course_name CHAR(7) NOT NULL UNIQUE,
  total_times_been_taught INT(11) UNSIGNED
);

CREATE TABLE sections (
  section_id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  section_seme CHAR(6) NOT NULL UNIQUE,
  section_name VARCHAR(30) NOT NULL
);

CREATE TABLE course_sections (
  course_id INT(11) UNSIGNED NOT NULL PRIMARY KEY,
  section_id INT(11) UNSIGNED NOT NULL PRIMARY KEY,
  times_been_taught INT(11) UNSIGNED,
  FOREIGN KEY (course_id) REFERENCES courses(course_id) ON UPDATE CASCADE,
  FOREIGN KEY (section_id) REFERENCES sections(section_id) ON UPDATE CASCADE
);


/*
CREATE TABLE Films
(
  id INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY(id),
  Title VARCHAR(255)
),

CREATE TABLE Genres
(
  id INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY(id),
  Name VARCHAR(255)
),

CREATE TABLE Films_Genres
(
  film_id INT NOT NULL,
  genre_id INT NOT NULL,
  PRIMARY KEY (film_id, genre_id),
  FOREIGN KEY (film_id) REFERENCES Films(id) ON UPDATE CASCADE,
  FOREIGN KEY (genre_id) REFERENCES Genres(id) ON UPDATE CASCADE
)

  INSERT INTO Films (Title) VALUES ('Title1');
SET @film_id = LAST_INSERT_ID();

INSERT INTO Genres (Name) VALUES ('Genre1');
SET @genre_id = LAST_INSERT_ID();

INSERT INTO Films_Genres (film_id, genre_id) VALUES(@film_id, @genre_id);



INSERT INTO Films (Title) VALUES ('Title2');
SET @film_id = LAST_INSERT_ID();
-- if you get ids of genre from your UI just use them
INSERT INTO Films_Genres (film_id, genre_id)
  SELECT @film_id, id
  FROM Genres
  WHERE id IN (2, 3, 4);

INSERT INTO Films (Title) VALUES ('Title3');
SET @film_id = LAST_INSERT_ID();
-- if you names of genres you can use them too
INSERT INTO Films_Genres (film_id, genre_id)
  SELECT @film_id, id
  FROM Genres
  WHERE Name IN ('Genre2', 'Genre4');
*/