CREATE TABLE Movie(
id   INT,
title         VARCHAR(100),
year          INT,
rating          VARCHAR(10),
company         VARCHAR(50),
PRIMARY KEY(id), -- id has to be UNIQUE and NOT NULL.
CHECK(id <= 4750) -- all movies id have to be less than maxmovieID.
) ENGINE=InnoDB;
CREATE TABLE Actor(
id             INT,
last           VARCHAR(20),
first          VARCHAR(20),
sex            VARCHAR(6),
dob            DATE,
dod            DATE,
PRIMARY KEY(id),-- id has to be UNIQUE and NOT NULL
CHECK(id <= 69000)) ENGINE=InnoDB;-- all persons' id have to be less than maxPersonID
CREATE TABLE Director(
id             INT,
last           VARCHAR(20),
first          VARCHAR(20),
dob            DATE,
dod            DATE,
PRIMARY KEY(id),-- id has to be UNIQUE and NOT NULL
CHECK(id <= 69000)) ENGINE=InnoDB;-- all persons' id have to be less than maxPersonID
CREATE TABLE MovieGenre(
mid            INT,
genre          VARCHAR(20),
FOREIGN KEY (mid) REFERENCES Movie(id)) ENGINE=InnoDB;-- all movie ID have to be existed in table Movie.
CREATE TABLE MovieDirector(
mid            INT,
did            INT,
FOREIGN KEY (mid) REFERENCES Movie(id),-- all movie ID have to be existed in table Movie.
FOREIGN KEY (did) REFERENCES Director(id)) ENGINE=InnoDB;-- all director ID have to be existed in table Director.
CREATE TABLE MovieActor(
mid            INT,
aid            INT,
role           VARCHAR(50),
FOREIGN KEY (mid) REFERENCES Movie(id),-- all movie ID have to be existed in table Movie.
FOREIGN KEY (aid) REFERENCES Actor(id)) ENGINE=InnoDB;-- all actor ID have to be existed in table Actor.
CREATE TABLE Review(
name           VARCHAR(20),
time           TIMESTAMP,
mid            INT,
rating         INT,
comment        VARCHAR(500),
FOREIGN KEY (mid) REFERENCES Movie(id)) ENGINE=InnoDB;-- all movie ID have to be existed in table Movie.
CREATE TABLE MaxPersonID(
id             INT) ENGINE=InnoDB;
CREATE TABLE MaxMovieID(
id             INT) ENGINE=InnoDB;
